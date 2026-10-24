# Agent-B-DMOS-AssetSync setup (GLPI 11.0.7)

The plugin key is `agentbdmosassetsync`; its display name is
**Agent-B-DMOS-AssetSync**. It accepts controller requests only through GLPI's
built-in Legacy REST API V1. It has no custom routes, authentication, or
outbound requests.

## Deploy and enable

1. Copy `setup.php`, `hook.php`, and `inc/` into
   `<GLPI_ROOT>/plugins/agentbdmosassetsync/`. The repository directory name
   `GLPI-Agent-B` is not the installed directory name. Keep any old plugins
   separate; do not copy their classes or settings into this plugin.
2. In **Setup > Plugins**, install and enable **Agent-B-DMOS-AssetSync** using
   an administrator account. Installation creates exactly three plugin tables:
   `glpi_plugin_agentbdmosassetsync_settings`,
   `glpi_plugin_agentbdmosassetsync_works`, and
   `glpi_plugin_agentbdmosassetsync_changes`. It registers plugin rights and
   the background task. It grants no service-account rights automatically.
3. Uninstall is implemented and deletes those three tables, their plugin
   rights, and the registered task. Export any required evidence first and
   obtain explicit approval before uninstalling. Do not use uninstall as an
   upgrade or reset procedure.

The implementation was based on the installed GLPI 11.0.7 source. GLPI's
legacy autoloader loads `PluginAgentbdmosassetsyncSetting`,
`PluginAgentbdmosassetsyncWork`, and `PluginAgentbdmosassetsyncChange` from
their `inc/*.class.php` files. Each extends `CommonDBTM`; the native V1
resource resolver exposes these itemtypes without plugin HTTP endpoints.

## Enable Legacy REST API V1

1. As administrator, open **Setup > General > API** and the **Legacy API**
   settings. Enable the REST API and login with an external/user token.
2. Create an API client restricted to the controller's source addresses where
   practical. Generate its application token. Use GLPI's displayed Legacy API
   URL as the base URL and configure HTTPS for the deployment.
3. Create a dedicated normal user for the controller, generate its API/user
   token, and assign the restricted profile below. Store both tokens only in
   the controller's secret store; never add credentials or session tokens to
   this repository.
4. Authenticate with native `GET <base>/initSession`, supplying `App-Token`
   and `Authorization: user_token <token>`. Subsequent calls use `App-Token`
   and the returned `Session-Token`. GET requests have no body.

For the local Docker review deployment, GLPI is at `http://localhost:8081`
and container `assetsync2-glpib` has its GLPI root at `/var/www/glpi`.
Use the API base actually exposed by that installation (`/api.php/v1` or
`/apirest.php`); this local HTTP address is for review only.

## Service account profile and entities

Create a **Standard interface** profile. Open its
**Agent-B-DMOS-AssetSync** profile tab and grant exactly:

| Record | Profile right key | Grant |
|---|---|---|
| Setting | `plugin_agentbdmosassetsync_setting` | Read, Create, Update |
| Work | `plugin_agentbdmosassetsync_work` | Read, Create |
| Change | `plugin_agentbdmosassetsync_change` | Read, Update |

Assign that profile only in the routed B entities. Choose recursion explicitly
when needed; the plugin does not grant access to unrelated entities. Native
collection reads apply entity filtering and individual record operations use
GLPI entity checks. Setting route IDs and their A/B entity pair are immutable;
disable an old route and create a new route if its destination changes.
Every Setting replacement must include all replaceable content and a version
strictly larger than the saved version.

No record allows deletion or purge. Work grants no caller update right;
Change grants no caller create right. Setting input rejects unknown fields,
client bookkeeping/bypass flags, and caller-supplied generated IDs. JSON
columns contain JSON strings on the outer REST wire; see
[the API contract](api-contract.md) for exact payloads.

Plugin-record rights do not grant ordinary asset, dropdown, or Fields-plugin
rights. When the processor is added, grant only the read/create/update rights
needed by enabled types/mappings. Never grant Super-Admin as a workaround.
Fields-selector shapes can be configured without the Fields plugin, but
processing must report unavailable metadata or writers visibly.

## Background task

Installation registers native automatic action `processWork` on itemtype
`PluginAgentbdmosassetsyncWork`, scheduled every 60 seconds in CLI/external
mode. In **Setup > Automatic actions**, locate that action and verify it is
scheduled. Configure the host's normal GLPI CLI cron invocation, running as
the web-service account, for example once per minute:

```sh
php <GLPI_ROOT>/front/cron.php
```

The foundation task is intentionally empty and returns no processed work.
It makes no asset or queue changes. This stage also rejects Work admission,
Change capture, and external Change acknowledgements until their assigned
validators/processors are installed; it never saves unvalidated partial
records. Setting and read APIs are available for foundation review.

Local correction code may call `markQueueRowsDone($ids)` only after proving
the exact snapshots were fully covered. The helper validates positive integer
IDs before doing any work, updates only those Pending rows through local
GLPI `update()`, rereads each result, and leaves Done/missing/other rows alone.
Its internal access is a PHP method boundary, never a caller payload flag.
It does not prove scope or field coverage on behalf of its caller.

Genuine field timestamps use RFC 3339 Brunei `+08:00` times and trustworthy
server clocks. GLPI-owned metadata is not genuine field-edit evidence. No
manual-edit cooldown is applied.

## Manual review after installation

Use the native V1 record URLs for the three global class names above. The
reviewer should check Setting creation/readback, unique routes, immutable
entity pairs, increasing/stale versions, mapping enum/shape errors, unknown
fields and bypass flags, and entity restrictions. Check forbidden Work update,
Change create, and every delete/purge. Validate Work admission and Change
acknowledgements after those separate parts are implemented. No automated
tests or destructive uninstall checks are included in the foundation stage.
