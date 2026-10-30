#!/usr/bin/env python3
"""Offline, evidence-preserving upgrade for the reviewed single-app Docker layout."""

import argparse
import hashlib
import json
import os
from pathlib import Path
import subprocess
import sys
import time
import uuid


def command(args, timeout=60, output=None, success=(0,)):
    result = subprocess.run(args, capture_output=True, timeout=timeout)
    if output is not None:
        Path(output).write_bytes(result.stdout + result.stderr)
    if result.returncode not in success:
        raise RuntimeError("Command failed; consult the private operation evidence")
    return result.stdout


def inspect(name):
    return json.loads(command(["docker", "inspect", name]))[0]


def save(path, value):
    temporary = Path(str(path) + ".writing")
    descriptor = os.open(temporary, os.O_WRONLY | os.O_CREAT | os.O_EXCL, 0o600)
    with os.fdopen(descriptor, "w") as stream:
        stream.write(json.dumps(value, indent=2))
    os.replace(temporary, path)


def wait_file(container, path, process, timeout):
    end = time.monotonic() + timeout
    while time.monotonic() < end:
        ready = subprocess.run(["docker", "exec", "--user", "0", container, "cat", path], capture_output=True)
        if ready.returncode == 0:
            return json.loads(ready.stdout)
        if process.poll() is not None:
            raise RuntimeError("The guard exited before publishing readiness")
        time.sleep(0.1)
    raise RuntimeError("Timed out waiting for the database guard")


def main():
    os.umask(0o077)
    parser = argparse.ArgumentParser(description=__doc__, epilog=(
        "This is an offline Docker administrator operation, not an online/GUI "
        "upgrade. Supports reviewed GLPI 11.0.7/MySQL 8.4, one persistent B data "
        "mount and an unshared private database. Take private database/plugin "
        "backups first. Failures after stopping B leave it stopped/fenced. "
        "Never resume an incomplete operation by restoring old evidence."))
    parser.add_argument("--app", required=True, help="Only the GLPI B app container")
    parser.add_argument("--database", required=True, help="Only its MySQL container")
    parser.add_argument("--source", required=True, type=Path, help="Reviewed Agent B package")
    parser.add_argument("--evidence-dir", required=True, type=Path, help="New private operation directory")
    parser.add_argument("--glpi-root", default="/var/www/glpi")
    parser.add_argument("--var-dir", default="/var/glpi")
    parser.add_argument("--username", default="glpi", help="Existing native GLPI administrator")
    parser.add_argument("--timeout", type=int, default=180)
    args = parser.parse_args()
    source = args.source.resolve()
    helper = Path(__file__).with_suffix(".php").resolve()
    for name in ("setup.php", "hook.php", "inc/evidence.php"):
        if not (source / name).is_file():
            raise RuntimeError("The candidate package is incomplete")
    if args.app == args.database or args.timeout < 30:
        raise RuntimeError("Distinct B containers and a bounded timeout are required")
    root = args.evidence_dir.resolve()
    root.mkdir(mode=0o700, parents=False, exist_ok=False)
    work = root / "operation"
    work.mkdir(mode=0o700)
    state = {"version": 1, "phase": "preflight", "app": args.app, "database": args.database}
    save(root / "state.json", state)
    app, database = inspect(args.app), inspect(args.database)
    if not app["State"]["Running"] or not database["State"]["Running"]:
        raise RuntimeError("Both original B containers must be running for preflight")
    if any(database["NetworkSettings"]["Ports"].values()):
        raise RuntimeError("The database must have no published port")
    database_image = json.loads(command(["docker", "image", "inspect", database["Image"]]))[0]
    image_names = [database["Config"]["Image"], *(database_image.get("RepoTags") or [])]
    if not any(name == "mysql:8.4" or name.startswith("mysql:8.4.") for name in image_names):
        raise RuntimeError("This preserving wrapper is reviewed only for MySQL 8.4")
    var_mounts = [m for m in app["Mounts"] if m["Destination"] == args.var_dir and m["RW"]]
    if len(var_mounts) != 1 or var_mounts[0]["Type"] not in ("volume", "bind"):
        raise RuntimeError("A single writable persistent GLPI B data mount is required")
    networks = []
    for name, endpoint in database["NetworkSettings"]["Networks"].items():
        network = json.loads(command(["docker", "network", "inspect", name]))[0]
        peers = set(network.get("Containers", {}))
        if network["Driver"] != "bridge" or not peers.issubset({app["Id"], database["Id"]}):
            raise RuntimeError("Refusing a shared or unsupported database network")
        networks.append({"name": name, "aliases": endpoint.get("Aliases") or []})
    if not networks:
        raise RuntimeError("The database has no supported private network")
    state["original_networks"] = networks
    state["app_image"] = app["Image"]
    nonce = uuid.uuid4().hex
    temporary = "/tmp/agentb-upgrade-" + nonce
    maintenance = "agentb-upgrade-" + nonce[:12]
    network = maintenance + "-net"
    request = {"glpi_root": args.glpi_root, "var_dir": args.var_dir,
               "username": args.username, "operation_dir": temporary, "timeout": args.timeout}
    save(work / "request.json", request)
    command(["docker", "exec", args.app, "mkdir", "-p", temporary])
    command(["docker", "cp", str(helper), args.app + ":" + temporary + "/helper.php"])
    command(["docker", "cp", str(work / "request.json"), args.app + ":" + temporary + "/request.json"])
    app_user = app["Config"]["User"] or "www-data"
    app_group = command(["docker", "exec", args.app, "id", "-g"]).decode().strip()
    if not app_group.isdecimal():
        raise RuntimeError("The original application group could not be established")
    command(["docker", "exec", "--user", "0", args.app, "chown", app_user,
             temporary + "/request.json"])
    preflight = json.loads(command(["docker", "exec", args.app, "php", temporary + "/helper.php",
                                    "preflight", temporary + "/request.json"], output=root / "preflight.log"))
    save(root / "preflight.json", preflight)
    active_path = preflight["active_path"]
    if not active_path.startswith(args.var_dir.rstrip("/") + "/"):
        raise RuntimeError("The active B plugin is outside its isolated persistent data mount")
    if preflight["database_host"] not in {database["Name"].lstrip("/"), *sum([n["aliases"] for n in networks], [])}:
        raise RuntimeError("Configured database host is not a verified container DNS alias")
    pause = json.loads(command(["docker", "exec", args.app, "php", temporary + "/helper.php",
                               "pause", temporary + "/request.json"], output=root / "pause.log"))
    save(root / "task-before.json", pause["task_before"])
    state["task_before"] = pause["task_before"]
    state["preflight"] = preflight
    state["maintenance_container"] = maintenance
    state["maintenance_network"] = network
    state["phase"] = "stopping-app"
    save(root / "state.json", state)
    guard = None
    guard_log = None
    try:
        command(["docker", "stop", "--time", "30", args.app], timeout=45, output=root / "app-stop.log")
        if inspect(args.app)["State"]["Running"]:
            raise RuntimeError("The complete B runtime did not stop")
        for endpoint in networks:
            command(["docker", "network", "disconnect", endpoint["name"], args.database])
        command(["docker", "network", "create", "--internal", network], output=root / "network-create.log")
        aliases = ["--alias", preflight["database_host"]]
        command(["docker", "network", "connect", *aliases, network, args.database])
        mount = var_mounts[0]
        mount_source = mount.get("Name") if mount["Type"] == "volume" else mount["Source"]
        command(["docker", "run", "--detach", "--name", maintenance, "--network", network,
                 "--user", app["Config"]["User"] or "www-data",
                 "--mount", "type=" + mount["Type"] + ",source=" + mount_source + ",target=" + args.var_dir,
                 "--mount", "type=bind,source=" + str(work) + ",target=/operation",
                 "--mount", "type=bind,source=" + str(helper.parent) + ",target=/upgrade-tools,readonly",
                 "--entrypoint", "/bin/sleep", app["Image"], "infinity"], output=root / "maintenance-create.log")
        # Keep the host owner for atomic replacement; only the app group can create private evidence.
        command(["docker", "exec", "--user", "0", maintenance, "chgrp", app_group, "/operation"])
        command(["docker", "exec", "--user", "0", maintenance, "chmod", "0770", "/operation"])
        fenced = json.loads(command(["docker", "network", "inspect", network]))[0]
        if set(fenced.get("Containers", {})) != {database["Id"], inspect(maintenance)["Id"]}:
            raise RuntimeError("The maintenance network is not exclusive")
        if set(inspect(args.database)["NetworkSettings"]["Networks"]) != {network}:
            raise RuntimeError("The database retains an unfenced network")
        request.update({"operation_dir": "/operation", "preflight": preflight,
                        "target_version": "0.6.0"})
        save(work / "request.json", request)
        command(["docker", "exec", "--user", "0", maintenance, "chown", app_user,
                 "/operation/request.json"])
        state["phase"] = "guarding"
        save(root / "state.json", state)
        guard_log = (root / "guard.log").open("wb")
        guard = subprocess.Popen(["docker", "exec", maintenance, "php", "/upgrade-tools/guarded-upgrade.php",
                                  "guard", "/operation/request.json"], stdout=guard_log, stderr=subprocess.STDOUT)
        context = wait_file(maintenance, "/operation/guard-ready.json", guard, min(args.timeout, 60))
        state["phase"] = "publishing-source"
        save(root / "state.json", state)
        # Publish the version marker last; partially copied code must never advertise readiness.
        for name in ("inc", "hook.php", "setup.php"):
            candidate = str(source / name) + ("/." if name == "inc" else "")
            command(["docker", "cp", candidate, maintenance + ":" + active_path + "/" + name])
        command(["docker", "exec", "--user", "0", maintenance, "chown", "-R", "www-data:www-data", active_path])
        expected = {str(path.relative_to(source)): hashlib.sha256(path.read_bytes()).hexdigest()
                    for path in (source / "setup.php", source / "hook.php", *(source / "inc").glob("*.php"))}
        actual = json.loads(command(["docker", "exec", maintenance, "php", "/upgrade-tools/guarded-upgrade.php",
                                     "hashes", "/operation/request.json"], output=root / "deployed-hashes.json"))
        save(root / "candidate-hashes.json", expected)
        if actual != expected:
            raise RuntimeError("The published PHP package does not match the reviewed candidate")
        save(work / "context.json", context)
        command(["docker", "exec", "--user", "0", maintenance, "chown", app_user,
                 "/operation/context.json"])
        state["phase"] = "native-upgrade"
        save(root / "state.json", state)
        result = json.loads(command(["docker", "exec", maintenance, "php", "/upgrade-tools/guarded-upgrade.php",
                                     "upgrade", "/operation/request.json"], timeout=args.timeout,
                                    output=root / "native-upgrade.log"))
        if result.get("state") != "ready":
            raise RuntimeError("Native completion did not certify the guarded upgrade")
        save(root / "completion.json", result)
        command(["docker", "exec", maintenance, "touch", "/operation/release"])
        if guard.wait(timeout=15) != 0:
            raise RuntimeError("The database guard did not release cleanly")
        command(["docker", "stop", maintenance], timeout=40, output=root / "maintenance-stop.log")
        command(["docker", "network", "disconnect", network, args.database])
        for endpoint in networks:
            alias_args = []
            for alias in dict.fromkeys(endpoint["aliases"]):
                alias_args += ["--alias", alias]
            command(["docker", "network", "connect", *alias_args, endpoint["name"], args.database])
        command(["docker", "start", args.app], timeout=45, output=root / "app-start.log")
        control = preflight.get("supervisor_control")
        if control:
            time.sleep(1)
            current = command(["docker", "exec", "--user", "0", args.app, "supervisorctl", "-c", control, "status"], success=(0, 3))
            current_states = {line.split()[0]: line.split()[1] for line in current.decode().splitlines() if line.split()}
            for name, expected in preflight["supervisor_programs"].items():
                action = "start" if expected == "RUNNING" else "stop"
                actual = current_states.get(name)
                if (expected == "RUNNING" and actual != "RUNNING") or (expected == "STOPPED" and actual != "STOPPED"):
                    command(["docker", "exec", "--user", "0", args.app, "supervisorctl", "-c", control, action, name])
        running = json.loads(command(["docker", "exec", args.app, "php", temporary + "/helper.php",
                                      "processes", temporary + "/request.json"]))
        for scheduler in preflight["schedulers"]:
            if not any(p["argv"] == scheduler["argv"] and p["uid"] == scheduler["uid"] for p in running):
                command(["docker", "exec", "--detach", "--user", str(scheduler["uid"]), args.app, *scheduler["argv"]])
        request["task_before"] = pause["task_before"]
        request["operation_dir"] = temporary
        save(work / "request.json", request)
        command(["docker", "cp", str(work / "request.json"), args.app + ":" + temporary + "/request.json"])
        command(["docker", "exec", "--user", "0", args.app, "chown", app_user,
                 temporary + "/request.json"])
        restored = json.loads(command(["docker", "exec", args.app, "php", temporary + "/helper.php",
                                      "restore-task", temporary + "/request.json"], output=root / "restore-task.log"))
        save(root / "restored.json", restored)
        state["phase"] = "complete"
        save(root / "state.json", state)
        print(json.dumps({"state": "ready", "version": "0.6.0", "evidence_dir": str(root),
                          "bindings": result.get("bindings")}))
    except Exception:
        # Keep partial/new PHP contexts from running after any unsuccessful operation.
        for container in (args.app, maintenance):
            try:
                if inspect(container)["State"]["Running"]:
                    command(["docker", "stop", "--time", "15", container], timeout=25)
            except Exception:
                pass
        try:
            for attached in inspect(args.database)["NetworkSettings"]["Networks"]:
                if attached != network:
                    command(["docker", "network", "disconnect", attached, args.database])
            if network not in inspect(args.database)["NetworkSettings"]["Networks"]:
                command(["docker", "network", "connect", "--alias", preflight["database_host"], network, args.database])
        except Exception:
            pass
        state["failed_phase"] = state["phase"]
        state["phase"] = "failed-requires-verification"
        observed = {}
        try:
            observed["app_running"] = inspect(args.app)["State"]["Running"]
            maintenance_state = subprocess.run(["docker", "inspect", maintenance], capture_output=True)
            observed["maintenance_running"] = (json.loads(maintenance_state.stdout)[0]["State"]["Running"]
                                                if maintenance_state.returncode == 0 else None)
            observed["database_networks"] = list(inspect(args.database)["NetworkSettings"]["Networks"])
            isolated = json.loads(command(["docker", "network", "inspect", network]))[0]
            observed["maintenance_network_internal"] = isolated["Internal"]
            allowed = {database["Id"]}
            if maintenance_state.returncode == 0:
                allowed.add(json.loads(maintenance_state.stdout)[0]["Id"])
            observed["unexpected_network_peers"] = list(set(isolated.get("Containers", {})) - allowed)
            if (observed["app_running"] is False and observed["maintenance_running"] is False
                    and observed["database_networks"] == [network] and isolated["Internal"]
                    and not observed["unexpected_network_peers"]):
                state["phase"] = "failed-stopped-fenced"
        except Exception:
            observed["inspection_incomplete"] = True
        state["observed_failure_state"] = observed
        state["recovery_requires_actual_state_verification"] = True
        save(root / "state.json", state)
        print("Upgrade failed. Keep B stopped/fenced; inspect private state/evidence before conservative recovery.", file=sys.stderr)
        raise
    finally:
        if guard_log is not None:
            guard_log.close()


if __name__ == "__main__":
    try:
        main()
    except Exception as error:
        print(str(error), file=sys.stderr)
        sys.exit(1)
