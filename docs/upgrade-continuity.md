# Evidence-safe controlled upgrade and binding initialization (0.5.2)

**0.6.0 deployment boundary:** the current local operator tool targets 0.6.0 and
also accepts 0.5.2 as a reviewed source format. Its offline fence, independent
observer and record-preservation rules remain required; historical proof is not
rewritten. The [History comparison policy](history-contract.md) is a deliberate
timestamp-semantic change, not a claim that 0.5.2 tests verified 0.6.0. The
authorized local 0.5.2→0.6.0 guarded upgrade completed with administrative
readback: all21 PHP source hashes and original1179 Works/204 Changes/46 Settings/
50 Note links/82 scalarstates/rights remained exact, including Works1–7. All75
binding entries were retained; no new generation was needed. Private backups
and evidence: `/tmp/agentb-history-deploy-20261029.ipjx2vbg/`. Original idle task
configuration and dedicated scheduler were restored. H01–H12 remain NOT RUN.
The status and counts in the following paragraph are historical 0.5.2 evidence.

Status: 0.5.2 deployed to localhost:8081 through the guarded native procedure.
Administrative readback verified 16 retained and 59 freshly initialized bindings,
with zero unavailable active bindings; historical proofs and records were unchanged.
Functional BI checks remain NOT RUN for the user to execute. The previous 0.5.1
guarded native upgrade preserved its pre-upgrade record/evidence
baseline; those actual affected-case results and unrun variants are recorded in
[the PF01 follow-up ledger](manual-tests.md#controlled-upgrade-evidence-continuity--pf01-follow-up).
The preserving path addresses PF01; 0.5.2 additionally initializes missing
bindings without manufacturing current-value evidence. Ordinary native
activation remains conservative. No A wire key,
REST resource, endpoint, authentication method or Work status is added.

## Safety boundary

An unchanged value, timestamp, package version, maintenance flag or named lock
alone does not prove capture continuity. GLPI can unload B when a new version is
detected, before its deactivate hook runs. A PHP process booted during that gap
can later save without capture hooks, even after a database table lock releases.

The preserving path therefore requires an operator-enforced **offline Docker
upgrade**, not an HTTP checkbox or a generic promise that no one edited data:

1. Confirm the existing package/catalog is active, loadable, capture-compatible
   and not suspended. An already inactive/unknown installation cannot qualify.
2. Pause only an idle B automatic action through supported GLPI methods. Stop
   and drain the entire B application container, including PHP/background
   entrypoints. Do not reset a Running task. Controller A is untouched.
3. Verify the B database has no published port and no normal network peers
   other than that B application and database. Refuse an unknown/shared topology.
   Disconnect its normal networks and use a fresh internal maintenance network
   containing only B's database and the dedicated maintenance runtimes. No web
   server or scheduler runs in those runtimes. This prevents old inactive PHP
   contexts from waiting through the upgrade and writing afterward.
4. Acquire the existing worker/route locks and dedicated database READ guards
   before publishing the new source/version. The separate guard connection is
   restricted to its reviewed read-only protocol after locking; it must never
   begin a transaction, run DDL, reconnect, or unlock early. Validate its original
   connection identity and unique named-lock ownership throughout.
5. Save a durable B-owned pending marker before a possible capture gap. Keep raw
   snapshots private; the native Config marker contains only correlation,
   hashes, phase/version and guard identity, never customer field values.
6. Use a fresh single-purpose PHP runtime for native version detection,
   additive installation and activation. Verify current routes, definitions,
   bindings and durable active state while the guard and network fence remain.
7. Complete the pending marker only after those checks succeed. Release guards,
   restore the original database network, and start fresh B application contexts.
   Restore the original B task/scheduler configuration only after success.

The wrapper is a trusted Docker-administrator operation. Privileged direct SQL,
additional containers deliberately attached by another administrator, or a
second unregistered B runtime bypassing this fence are outside its guarantee.
Native-host/shared-database deployments do not gain automatic preservation from
this Docker path; use conservative activation unless an equivalently enforced
and reviewed fence is provided. No Controller A scheduler/configuration change
is required or authorized by this procedure.

## What may survive

The compatibility scope is current scalar evidence format 1 from Agent B
0.4.1/0.5.0/0.5.1 to this 0.5.2 implementation. It is not a blanket promise for future
changes to capture, conversion or arbitration semantics.

Snapshot only the **current** Setting manifests, route scope/version/mapping
content, concrete binding metadata and stored evidence. Retain an existing
opaque binding only when identity and meaning remain verified and unchanged.
Keep original valid entries unchanged. Unlike the historical 0.5.1 preserving-only
path, this explicit 0.5.2 procedure may initialize previously absent bindings
after verifying current metadata under the offline guard. Each receives a fresh
operation-specific generation; neither old values nor timestamps determine it.
Existing invalid or mismatched entries are not revived. Exact original manifest
bytes remain when no repair/removal is needed. Changed/unavailable/unverifiable bindings must lose trust,
including change-and-revert or disabled-period cases. Definition metadata reads
use real metadata permissions and do not read asset values or pretend a parent
ID exists. Ordinary scalar/participation permission policies remain unchanged.

No Work, Change, association or scalar-state payload is rewritten to restore
trust. Genuine original A/B times remain original; missing/unreliable evidence
remains so. The already-invalid generations from the earlier PF01 failure are
**not restored**, even when their old values match. A Setting publication,
activation or successful upgrade is never a human edit.

Binding initialization uses the existing metadata-only resolver with real
configuration/entity authorization. Normal Setting publication and asset saves
retain their actual write checks; service accounts need no new right. An
unauthenticated lifecycle cannot silently initialize empty bindings as ready.
Conservative invalidation can remove trust without manufacturing replacement
proof. No administrator is automatically impersonated. Unavailable definitions
remain unproven and unequal Both results expose `FIELD_BINDING_UNAVAILABLE` in
opted-in field receipts; the aggregate remains `EVIDENCE_CONFLICT`.

A repaired binding does not retroactively certify any old Change, including an
edit captured before the binding existed. It permits a subsequent genuine change
to establish current proof under that new binding. An unchanged save creates no
edit time. Missing or tied current proof still needs valid new evidence or an
explicitly approved resolution; the upgrade does not pick a winner.

The 29 October 0.5.2 administrative deployment used private backups/readback in
`/tmp/agentb-bindings-20261029.w1qyi_yj/`. It preserved all original columns of
1176 Works, 203 Changes, 50 Note links, 82 scalarstates and original rights;
all 46 Settings retained A-owned content/version. Only planned hidden manifests
changed. All 16 original binding entries remained exact. Setting32 gained its
22 previously missing active bindings. This is registration verification, not a
runtime arbitration or Controller A integration pass. The original idle task
configuration and dedicated scheduler were restored after deployment readback.

Both arbitration still uses fresh locked values and reliable genuine per-field
times: strictly newer wins; equal values need no update; ties/missing evidence
remain unresolved. Flags, field isolation, first-copy receipts, exact Change
acknowledgements, Notes, billing and UUID policies are unchanged.

## Failure and recovery

The preservation capability is CLI/process-local and bound to a live guard and
the exact pending operation. A persisted marker, user-supplied flag or stale
token cannot independently authorize preservation. Ordinary activation and real
deactivation retain evidence invalidation; Fields/definition lifecycle gaps
continue to invalidate the affected bindings.

A pending, malformed or unreadable upgrade marker blocks reliable current-proof
lookup. Do not turn a marker-read failure into permission to reuse evidence.
Ordinary human saves must still proceed; no new save-hook exception or user
cooldown is introduced.

Interruption, lost guard/connection, uncertain commit/cleanup, source/binding
mismatch or unexpected topology leaves B stopped/fenced. Before successful
certification the durable marker remains pending. The Ready write is permitted
only after independently verified active state, exact evidence/bindings and live
guard proof; its commit may succeed even if its acknowledgement is lost. Do not
overwrite an already committed Ready merely to manufacture a pending result.
An unconfirmed operator result still cannot automatically restore service.
Do not automatically restart the application, restore old generations, replay
Works or clear the marker merely because activation returned. Recovery must
explicitly invalidate uncertain continuity through the supported native
lifecycle, verify the reset and active state, and then restore service. Failure
during recovery remains blocked. Keep original request and recovery evidence.

## Operator entry point

`tools/guarded-upgrade.py` is the enforcing host wrapper;
`tools/guarded-upgrade.php` supplies the bounded native maintenance/guard roles.
They are administrative CLI tools, not HTTP endpoints or background services.
The preserving wrapper is scoped to the reviewed GLPI 11.0.7 / MySQL 8.4 Docker
layout with one GLPI variable-data volume and a private database bridge. It
refuses unsupported topology rather than assuming another deployment is safe.
For the authorized local target, with a fresh private evidence directory:

```bash
python3 tools/guarded-upgrade.py \
  --app assetsync2-glpib \
  --database assetsync2-glpib-db \
  --source /Users/kiran/Documents/DMOS/GLPI-Agent-B \
  --evidence-dir /tmp/agentb-guarded-upgrade-PRIVATE \
  --username glpi
```

Use `--help` for explicit GLPI/variable-directory overrides and timeout. The
source path above is B only; no Controller A repository is read or modified.
The operation may replace B's external scheduler process with a fresh PID while
restoring its recorded command, user and task configuration. Never reset a
Running task. Never use uninstall/reinstall to obtain this
upgrade, and never run a broad worker just to verify disposable fixtures.

Take recoverable private database and deployed-plugin backups first. Preserve
all existing requests, particularly Works 1–7. The local verification ledger
must distinguish preserving upgrades from conservative fallback, exact retained
storage from usable proof, and source checks from real runtime observations.

## Required affected manual checks

- PF01: actual guarded native version upgrade preserves all pre-existing
  request/result/association/evidence/right columns and unchanged binding bytes.
- New reliable B and copied A evidence remain usable after the upgrade; newer B
  returns to A, newer A applies, equality has no redundant update or feedback.
- Missing/unreliable/tied evidence is not promoted. Previously invalid PF01
  generations remain invalid. No historical recovery Work is reopened.
- Changed/replaced/disabled definitions, route gaps, real B/Fields disable-enable
  and ordinary uncontrolled activation remain conservative.
- Guard loss and interruption before/after source publication, installation,
  activation and final verification cannot leave falsely trusted evidence.
- The database fence prevents an inactive-context client from bootstrapping;
  resumption uses only fresh B contexts, and subsequent genuine capture works.
- Representative first-copy, flag, scalar-isolation and exact acknowledgement
  behavior remains unchanged. Restore idle B task/scheduler settings and retain
  clone fault evidence. No full A/B readiness follows from B-only checks.
