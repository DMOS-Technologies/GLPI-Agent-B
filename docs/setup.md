# Agent-B-DMOS-AssetSync setup (GLPI 11.0.7)

The installed plugin key is `agentbdmosassetsync`; its display name is
**Agent-B-DMOS-AssetSync**. B accepts controller requests through GLPI's
built-in Legacy REST API V1 on Setting, Work and Change records. It performs
asset and native Notes operations locally and makes no outbound requests.
There are no custom HTTP routes, authentication methods or log files.

**Blank-text patch deployed to localhost only:** the post-`61795e5` candidate treats
NULL and exact empty string as equal only for verified supported scalar text
bindings, before a native write or History arbitration. Original 0.6.0 release
and its version string do not prove this support. Confirm the exact deployed
build contains the field-aware comparison call sites; do not replay old Works
to test it. No additive schema or rights change is required by this patch.
Controller A must align concrete-text returned-value/current-state comparison,
preserve actual values and old receipts, and retain exact whole-snapshot
accounting. See the [precise contract and build boundary](history-contract.md#blank-text-comparison--local-patch-after-060).
The authorized disposable-fixture [BT runtime ledger](manual-tests.md#blank-text-localhost-deployment-and-bt-runtime--31-october-2026)
records results and remaining gaps. The separate hosted nonempty native Name
save failure is not a blank pair;
read the relevant runtime logs/permissions/native rules before attributing it.

The reviewed deployment uses GLPI **11.0.7** and active Fields **1.24.4**.
The plugin declares GLPI 11.0.7 through 11.0.x compatibility; other patches have
not been exercised by these manual passes. See [the evidence index](manual-tests.md#current-evidence-index)
for observed behavior and explicit unrun variants. Final Asset Both source and
scoped runtime evidence have been reviewed. Version **0.2.0** Notes has a bounded
[local manual run](manual-tests.md#native-notes-local-runtime-verification--28-october-2026)
with remaining PARTIAL variants. Version **0.3.0** adds opt-in scalar selection
and durable field certainty; the original FI source checklist remains historical,
with representative regressions later exercised by the 0.4.0 local run. The [Notes contract](notes-contract.md) and
[field-sync contract](field-sync-contract.md) extend the API contract; existing
flowcharts remain the baseline Asset flows.
Version **0.4.0** adds version 2 automatic scalar current-state reconciliation
in [reconciliation-contract.md](reconciliation-contract.md). Its authorized
[bounded local Docker run](manual-tests.md#automatic-scalar-reconciliation-local-runtime-verification--29-october-2026)
records deployment, owned-session/catch-up observations and remaining gaps;
it does not certify Controller A integration or the real environment.

Version **0.4.1** adds scalar mapping-version evidence continuity and verified
first-copy provenance. It needs an additive administrator upgrade: hidden
B-only Setting
`evidence_bindings_json` and internal `glpi_plugin_agentbdmosassetsync_scalarstates`
storage. There are still only three public REST resources, unchanged rights and
unchanged request/result formats. Read
[API section 5.6](api-contract.md#56-scalar-genuine-evidence-across-setting-versions-041)
before deployment. Old matching Change values are not backfilled as reliable
current provenance. Fresh verified capture/copy proof is required; unavailable
definitions/permissions during initialization remain unproven until repaired and
validly republished. Normal process restarts preserve stored evidence; supported
plugin/definition capture gaps invalidate it. The authorized
[29 October local runtime run](manual-tests.md#mapping-version-and-first-copy-local-runtime-verification--29-october-2026)
upgraded localhost:8081 from 0.4.0, preserving all original record columns and
rights, including Works 1–7. Twelve MV cases passed, four were partial and eight
direct first-copy checks passed. Fault/lifecycle checks on a separate local
clone and the exact unrun variants are labelled in that ledger. This is not
verification of Controller A or another deployment.

The completed first-copy integration uses this same internal store and adds no
schema or wire keys beyond the 0.4.1 additive upgrade. It atomically saves copied
proof with verified creation/association, then requires final Done before that
proof is trusted. Existing recovery records are never backfilled/replayed.
Started unassociated historical operations without positive no-write evidence
block another creation for that identity; an administrator must account for
their actual outcome rather than reset or resend them. New machine error
categories use the existing Work.error field; API section 5.6 defines them.

## Deploy and enable

Version **0.6.0 is deployed to localhost:8081, with functional checks NOT RUN**, for the
[native field History policy](history-contract.md). It requires native `logs`
READ and actual parent/field READ on the worker's account. A must align its
`a_change_times_json` semantics with the latest recorded field History, including
sync writes. No Controller A code, profile, scheduler or deployment was changed
by this B task. Do not count old 0.5.2 evidence or the 0.6.0 administrative
deployment readback as a functional 0.6.0 pass. The existing guarded upgrade tool
targets 0.6.0 only when an operator explicitly authorizes a deployment.

Version **0.5.2** repairs missing binding initialization through the existing
[guarded offline procedure](upgrade-continuity.md). Use an explicitly authorized
native administrator; the plugin does not create a privileged session itself.
Existing valid generations survive; newly initialized bindings start fresh and
do not certify older values, Change rows or Held Works. The user will run the
BI manual checklist. A new unequal Both comparison can report the additive
`FIELD_BINDING_UNAVAILABLE` mapping code; its aggregate remains `EVIDENCE_CONFLICT`.
Controller A has not been changed to interpret this code.
The authorized localhost deployment installed 0.5.2 and verified binding
registration and preservation; functional BI cases remain NOT RUN. For an
existing unresolved Both value, a real intended subsequent human edit can now
establish proof under the fresh binding. An unchanged save cannot manufacture
an edit timestamp. Do not force away/back edits or replay historical Works.

For evidence-compatible 0.5.1 upgrades, follow
[upgrade-continuity.md](upgrade-continuity.md). Its enforcing offline wrapper
is the preserving path; ordinary GLPI install/activate still closes possible
capture gaps by invalidating continuity. Do not restore old binding generations
from a backup to bypass the earlier PF01 failure. Pending/failed controlled
upgrades must remain offline until safely invalidated or completed.
The authorized localhost:8081 follow-up deployed **0.5.1** through that wrapper;
all pre-upgrade request/evidence columns and unchanged manifests survived exactly.
See the [PF01 follow-up ledger](manual-tests.md#controlled-upgrade-evidence-continuity--pf01-follow-up)
for actual arbitration checks, clone lifecycle checks and unrun fault variants.
The historical 0.5.0 PF01 failure is retained and its invalidated proof is not repaired.

The **0.5.0 local candidate** adds the optional
[participation extension](participation-contract.md): nullable Setting
`participation_flags_json` and nullable Work `participation_json`/
`participation_state_json`. Obtain these through an additive administrator
upgrade; existing rows stay disabled and existing recovery requests are not
rewritten. The authorized
[local PF run](manual-tests.md#optional-participation-flags-local-runtime-verification--29-october-2026)
records the localhost:8081 deployment and bounded verification, including actual
failures and remaining variants. This is not verification of another deployment.
A must implement the new contract before enabling it. Configuration alone does not
change existing clients' Work result shape; only explicit A→B Work opt-in does.

1. Copy `setup.php`, `hook.php`, and the complete `inc/` directory into
   `<GLPI_ROOT>/plugins/agentbdmosassetsync/`. The repository directory name
   `GLPI-Agent-B` is not the installed plugin key. Keep old plugins/resources
   separate from this new plugin.
2. In **Setup > Plugins**, install and enable **Agent-B-DMOS-AssetSync** using
   an administrator account. Installation creates the three public record tables:
   `glpi_plugin_agentbdmosassetsync_settings`,
   `glpi_plugin_agentbdmosassetsync_works`, and
   `glpi_plugin_agentbdmosassetsync_changes`, plus the internal
   `glpi_plugin_agentbdmosassetsync_notelinks` association/evidence table and,
   from 0.4.1, internal `glpi_plugin_agentbdmosassetsync_scalarstates` table.
   Only the original three record classes are exposed through REST.
   It registers plugin profile
   rights and the native automatic action. Service rights are not granted
   automatically.
3. For an existing installation, deploy the complete reviewed source and
   perform GLPI's plugin upgrade as an administrator before opting into the
   new scalar protocol (and before enabling Notes on a pre-0.2 installation).
   The upgrade adds missing columns and the internal table without replacing
   existing Work/Change payloads. Existing Work/Change rows become subject Asset
   with null `note_json`; Settings start with Notes disabled (`[]`). The 0.3.0
   upgrade adds nullable `field_sync_json` to Work, default null, without changing
   retained requests/results or adding a public record class. Native Work
   GET/collection/search hide that column. The original 0.3.0 implementation task did
   not run installation, upgrade, deployment or database writes.
   Version 0.4.0 reuses that column for version 2; it adds no further schema
   column and does not rewrite existing Work/result evidence. A subsequently
   authorized local Docker upgrade and separate fresh/old-version clone checks
   are recorded in the current runtime ledger; other deployments remain manual.
   Version 0.4.1 initializes new binding continuity at the current Setting
   without revising A's mappings/version or historical Work/Change payloads;
   it cannot reconstruct unrecorded earlier definitions or capture gaps.
4. Uninstall removes all five tables, rights and registered task. It requires
   explicit approval and is not an upgrade/reset procedure. Preserve required
   Work/Change evidence; there is no autonomous cleanup of terminal records.

GLPI's native autoloader exposes the global CommonDBTM itemtypes
`PluginAgentbdmosassetsyncSetting`, `PluginAgentbdmosassetsyncWork`, and
`PluginAgentbdmosassetsyncChange` from `inc/*.class.php`. Use these exact names
in the native API; there is no plugin-specific HTTP endpoint.

## Enable Legacy REST API V1

1. Open **Setup > General > API**, then **Legacy API**. Enable the REST API
   and login with an external/user token. Enabling only API V2 is insufficient.
2. Configure a native API client for A's observed source addresses and generate
   its application token. Use the displayed Legacy API base with HTTPS for
   the deployment.
3. Create a dedicated normal service user and its API/user token. Store both
   tokens in A's secret store, never in this repository, Setting or Work.
4. Authenticate with `GET <base>/initSession`, `App-Token`, and
   `Authorization: user_token <token>`. Subsequent calls use `App-Token` and
   `Session-Token`. GET requests have no body; close sessions with `killSession`.

The supplied isolated Docker review deployment is `assetsync2-glpib`, GLPI
root `/var/www/glpi`, exact native base `http://localhost:8081/api.php/v1`.
This local HTTP base is the recorded test target. Deployment examples and
headers are in [the API contract](api-contract.md#3-glpi-v1-transport-and-native-response-rules).

## Service account profile and entities

Create a **Standard interface** profile. Its
**Agent-B-DMOS-AssetSync** tab exposes these plugin rights:

| Record | Profile right key | Grant |
|---|---|---|
| Setting | `plugin_agentbdmosassetsync_setting` | Read, Create, Update |
| Work | `plugin_agentbdmosassetsync_work` | Read, Create |
| Change | `plugin_agentbdmosassetsync_change` | Read, Update |

Assign the profile only to routed B entities; choose recursion explicitly.
No record grants Delete/Purge. A cannot update a Work or create a Change.
Change Update permits only exact `id`/`status` Pending-to-Done acknowledgement.
Native entity restrictions apply to individual and collection operations.

Grant underlying asset READ and the CREATE/UPDATE operations needed by the
configured workflows, plus READ of referenced dropdown options. Fields
containers have their own profile rights. B-return and Both comparison/B-win
paths use READ; an A-winning local update requires current UPDATE, and first
copy requires CREATE plus the actual field/container permissions. Setting
admission validates safe B mapping capability, including first-copy seeding
regardless of source. A read-only runtime return is not permission to enable
an unsupported/unwritable first-copy mapping. Never grant Super-Admin or a
cron bypass to compensate for missing service rights.

For each selected Notes parent type, grant parent **READ**, **READNOTE** and
**UPDATENOTE** in the service profile and routed entity scope. Ordinary asset
UPDATE does not replace Notes-specific rights. Notes checks use the captured
submitter's current permissions for local processing. All installed capable
asset types may be selected, including capable concrete custom types; selection
does not enable a missing native GLPI Notes capability.

Work records capture submitting user/profile IDs, not credentials. Before
local processing B rebuilds that account's current authorization and verifies
route/entity, type, asset and field rights. Account/profile/permission changes
can therefore Hold accepted Work. The cron caller's administrator privileges
do not authorize these actions; its context is restored afterwards.

## Routes, mappings and fields

Create one Setting per immutable A/B entity pair. To change a pair, use a
new route identity and preserve the old asset/link/evidence. Every Setting
replacement includes all replaceable content and a strictly newer version.
The optional `notes_itemtypes_json` defaults to `[]` on creation; omission from
a replacement preserves its current value, while explicit `[]` disables Notes.
JSON columns are strings containing JSON on the outer REST wire; use the
exact schemas and examples in [the API contract](api-contract.md).

Types come from GLPI's installed asset registry, including concrete custom
asset definitions. One generic path uses actual type system criteria and
entity scope. Identity lookup uses a retained verified link, then a complete
exact permitted serial lookup where the type supports it. Missing identifiers,
denied/incomplete lookup, ambiguity or competing ownership Hold; only a
positive zero-match result permits first copy. Remote A IDs are never B IDs.

Enabled B mappings must have actual safe scalar metadata, storage and
permissions. Generated identity/timestamps, scope/lifecycle fields, computed
values and complex relationship/list payloads are not ordinary mapped targets.
Unavailable/unsupported enabled mappings are rejected at Setting admission.
A mapping that becomes unavailable during Work processing remains visibly
skipped/Held as applicable. Normal-save capture follows the non-blocking rule
below and reports omitted mappings in GLPI's existing PHP log.

Fields scalar mappings require an active Fields plugin with usable actual
container/field metadata and rights. Version 1.24.4 was exercised; this is not
an exhaustive certification of every Fields version or field option. Native,
custom virtual and Fields scalar writes, plus direct text and required
text/dropdown label conversions, have representative evidence. Labels resolve
exactly and uniquely within permitted destination options; no option is
created, trimmed or case-folded automatically. Unsupported complex/multiple
fields stay rejected until a payload/save contract is defined.

## Scalar field isolation (opt in, version 0.3.0)

Confirm the deployed plugin version and completed upgrade before A sends
`field_sync_json`. A Setting's increasing version does not negotiate a protocol
capability. There is no custom discovery endpoint; do not silently retry with
legacy behavior if an older B rejects the property. Grant the existing Work
Read/Create and underlying parent/field/container permissions; this feature adds
no profile right and grants no Delete/Purge.

Only new Asset Sync Work on a verified retained Active relationship can select
mapping IDs. Omission/null retains all legacy behavior; `[]` deliberately selects
none. The selection applies equally to A/B/Both, does not clear or disable
mappings, and cannot create/link a parent, Resume it or alter Notes. A serial
alone cannot authorize this path. Use the exact request/result examples in
[field-sync-contract.md](field-sync-contract.md).

The opted-in Fields path requires existing generated storage and source-supported
selected-only validation/update/history. It does not resubmit a merged Fields
container. Unsupported/nontransactional field/Work storage must reject before a
native writer rather than claim atomic evidence. Preserve native GLPI hooks;
they may still change sibling fields, while parent/storage row reads may load
excluded columns. These are explicit limits to logical mapping isolation.
Opted-in metadata helpers stop the worker on uncertain transaction boundaries;
they do not read back on that same uncertain connection to infer durability.
For version 1's supported durability boundary, configure a fresh dedicated
CLI invocation of `php <GLPI_ROOT>/front/cron.php processWork`; source review
established that this entry point has no native outer transaction. Generic
reused cron connections and third-party hooks leaving transactions open are
not proven clean through a public GLPI transaction-state API. There is no
portable ambient-transaction guard/enforcement here and no universal independent
marker guarantee for arbitrary ambient transactions. Native/plugin hooks leaking
transaction boundaries remain a limitation, with runtime cases unrun. This is a
deployment/manual-verification precondition, not a deployment performed here.

Read per-field certainty and machine codes in addition to Work status. Done can
include rejected/excluded fields; Unknown remains unresolved and Held, with no
automatic replay or Work reset. Once the original Work is terminal and the
mapping is Rejected/NotAttempted, its cause is repaired and current scope remains
valid, A may send a distinct fresh current-state request. Accepted/Pending is
not retry authorization. For Unknown, first reconcile the
existing Work journal and native current state; native readback alone does not
prove all hook effects. If the retained journal is damaged/missing, B Holds with
Work error `ASB_FIELD_JOURNAL_UNREADABLE`, preserving its exact result bytes and
request. There is no safe reconstructed field certainty; A must retain its own
original request and reconcile all selected missing effects. No automatic
version 1 catch-up/replay follows that error. A separately opted-in version 2
operation is described below. Exact mixed Change snapshots stay Pending until fully
covered. Run the [new disposable-fixture checklist](manual-tests.md#scalar-field-isolation-source-only-candidate--28-october-2026)
after separate authorization; historical passes do not certify this feature.

## Automatic scalar reconciliation (opt in, version 0.4.0)

Confirm deployed 0.4.0 and the existing additive upgrade before A sends version 2
of field_sync_json. There is no automatic fallback to version 1 or legacy after
an unsupported-version response. The exact schema, examples and recovery limits
are in [reconciliation-contract.md](reconciliation-contract.md).

A creates a distinct targeted Work referencing a terminal same-link Asset Sync
row with an original positive B identity. It retains its original request and
problem ledger. Missing/damaged earlier result evidence remains unchanged;
current convergence does not certify the earlier operation. A uses current
Setting/mappings and genuine values/evidence, even if the Setting advanced after
repair; the referenced settings version cannot exceed the new version. B rechecks
current permissions, Active identity, terminal reference and
field authority before native processing. It never first-copies, reopens the old
Work or invents a winning Both timestamp.

The version 2 worker uses a new configured DB object/session for its own work,
retaining the original lock-owning connection. It restores that connection and
closes only its owned session. Independent committed visibility checks are
required before progress is trusted: each uses a fresh native observer on the
same positively verified backend and compares exact Work metadata/journal.
Both the owned writer and each fresh observer apply GLPI's native PostBoot read
policy through public `setMustUnsanitizeData`, using the existing
`glpi_configs` core `must_unsanitize_db_data` value with native fallback true;
this reads configuration and does not change it.
Worker-lock ownership checks and the restart route barrier protect against an
older owned writer still running. Another Accepted same-pair Asset Work is a
RECONCILE_PENDING context failure, not a field rejection; invalid references use
RECONCILE_SCOPE. Closing/reconnecting an existing DB object
is not equivalent because GLPI retains private transaction bookkeeping and
connection-owned locks. This version-specific behavior avoids requiring a new
PHP process for every version 2 Work. It does not change version 1's documented
boundary or prove arbitrary external hook effects harmless. Connection loss,
unverified evidence or unsafe native effects remain structured uncertainty.

A polls the Work; POST success is admission only. AppliedToB/VerifiedApplied and
AlreadyEqual/VerifiedEqual describe the new Work. ReturnToA requires A's actual
verified save/equality. A may aggregate exact field/revision coverage in its own
ledger, leaving mixed snapshots Pending until fully handled, then acknowledge
only the exact Change IDs. B does not aggregate partial Work receipts or verify
A's local saves. Root-cause repair and scheduling live in Controller A; no B
option creation, permission grant or automatic configuration repair is added
by this feature.

Review RC01–RC22 in the
[local runtime ledger](manual-tests.md#automatic-scalar-reconciliation-local-runtime-verification--29-october-2026)
and its remaining variants. The source-only checklist below it is the historical
plan. New fault/write verification still requires authorized disposable fixtures;
existing Works, including Works 1–7, must remain untouched.

## Native Notes (opt in)

Before enabling capture, ensure the A consumer understands `subject` and can
handle Note Work/Change payloads. Older Asset consumers must filter for
`subject=Asset`: an unfiltered standard queue GET also returns Note rows.
Settings-version changes alone do not establish client capability.

Set `notes_itemtypes_json` to a JSON-string array of distinct types already in
`enabled_itemtypes_json`. Setting admission checks registry membership, actual
native Notes capability and the Notes rights above. Do not put Notes into scalar
field mappings. The extension keeps Setting, Work and Change as its only REST
record classes; the internal association table has no separate endpoint.

Subject `Note` Work uses operation `Sync` (default) or `Inventory`, carries
`note_json`, and sends `{}` for both scalar values/times JSON strings. Its
ordinary identity and entity fields describe the parent asset. Establish that
parent's verified Asset Work link first: Note processing cannot create, link,
resume or move a parent. B's Note Work `b_items_id` and `link_state` remain null;
confirmed parent IDs appear in the result. Suspend/Resume remain Asset operations
and retained suspension also blocks Notes for that relationship.

Enable the selected Notes capture before running Inventory for existing notes.
Inventory uses ascending B Note IDs, a limit of 1..50 and returned `next_after_id`
until `has_more` is false. It is a live keyset pass; inventory and capture may
overlap, so A must reconcile by note IDs. Skipped unsupported notes consume
cursor positions and remain unchanged. Historical native dates are not promoted
into reliable genuine-edit evidence. Exact request/result and REST examples are
in [the Notes contract](notes-contract.md).

Sync reuses durable A/B Note associations on the verified parent. Initial exact
content matches are linked without an update; multiple matches, paired-elsewhere
candidates, denied or incomplete lookups Hold. A complete zero-match lookup
reserves the A Note identity before attempting creation. Missing linked notes
or uncertain creations Hold even under a fresh Work ID. Reservations are not
success, and source implementation does not promise exactly-once native creation
or proven rollback across attachment lifecycle work.

Each note uses Both authority. Equal content causes no native update. For
differing content, a newer reliable genuine per-note revision wins; equal,
missing or unreliable times Hold without overwriting content. Preserve the
winning revision's evidence when copying it between installations. B stores
copied-value evidence separately from its last genuine local content-edit time.
Empty content is an explicit edit and never means deletion.

Only text and formatting, including ordinary external hyperlinks, are supported.
Embedded images, uploads, native document references and other media are skipped
and logged during local capture, reported as Inventory skips, or Held in Sync;
they are never fetched or silently stripped. Native authors/updaters are actual
local accounts. Existing `visible_from_ticket` is preserved on edits and new
copies use 0. A payload cannot reparent a Note, spoof authors/dates, enable a
GLPI capability, or delete/purge a Note. Unrelated local notes remain unchanged.

Passive native Notepad capture observes genuine additions and content edits,
including notes on existing linked assets. Metadata-only changes produce no
Note Change. The sync guard spans the native save and its nested work, so B's
own copies do not queue back to A. Capture/queue failures use GLPI's existing
PHP log and never block a person's normal save. One eligible save produces an
immutable Note snapshot per route; no shutdown-only capture or automatic retry
is introduced.

Note Changes use `changed_fields_json` `{}` and a full `note_json` snapshot.
Acknowledgement remains exactly `id` and `status=Done`. Correction work validates
all referenced snapshots before counting an attempt and completes only supplied
same-note snapshots demonstrably covered by the verified result. ReturnToA
snapshots stay Pending until A handles and acknowledges them; newer or uncertain
revisions remain independent. Review the bounded [Notes local results](manual-tests.md#native-notes-local-runtime-verification--28-october-2026)
and remaining PARTIAL variants before a pilot; do not infer that the new scalar
selection/journal path was exercised by that run.

## Background processing and scope controls

Installation registers automatic action **processWork** on itemtype
`PluginAgentbdmosassetsyncWork`, frequency **60 seconds**, CLI/external mode,
initially waiting. In **Setup > Automatic actions**, locate that action and
configure the host's normal GLPI cron invocation as the web-service OS account,
for example once per minute:

```sh
php <GLPI_ROOT>/front/cron.php
```

The action processes at most 20 Accepted Work records per pass in ascending ID
order under one worker lock. POST acceptance performs no asset or Note write. A durable
start marker precedes asset actions; interrupted started Work becomes Held
rather than replaying blindly. Done/Held/Failed records do not automatically
reopen. Reconcile a genuinely uncertain outcome before issuing any necessary
fresh Work ID. Polling is not a retry or a processing attempt.

First copy adds locally in the routed entity, seeds all enabled supported
supplied A mappings once regardless of A/B/Both source, verifies the asset and
saves confirmed link evidence atomically. Reuse never repeats first-copy
seeding. Existing A fields apply locally; B fields return B values; Both
compares canonical values and reliable genuine per-field instants. Equal
values require no write. Unequal equal/missing/unreliable times conflict and
Hold; partial verified outcomes remain visible.

Use ordinary Work operations `Suspend`/`Resume` with empty values/times/handled
IDs for an existing verified link. Suspend retains asset/link/queue evidence,
blocks Sync/correction/acknowledgement and suppresses genuine capture for that
relationship. Resume verifies and records Active with no asset write/reseed;
submit a fresh Sync to exchange values. No control moves, deletes or archives
assets, and ordinary Sync cannot reactivate Suspended scope.

## Genuine changes and exact completion

Genuine mapped local edits queue immutable Pending snapshots immediately, one
per real underlying storage save and applicable route. A single action may
produce separate native and Fields rows. Each keeps its exact identity, saved
values and original field times. Sync writes never queue back to A.

Capture does not rewrite or validate GLPI's save input. GLPI and Fields decide
whether a normal save is valid. Capture failures never reject that save:
unreadable/empty dropdowns and other unsupported values are omitted, while
verified sibling fields may still queue. Check GLPI's existing `php-errors.log`
for `ASB_CAPTURE_SKIPPED` entries identifying the stage, asset, route and mapping
when available. Failed queue writes are logged without automatic retries or
new failure records. A missing field or Change requires manual reconciliation;
an asset-save success does not prove capture succeeded. This normal-save policy
was requested on 27 October 2026 and does not relax Setting/Work validation.

Returned `covered_change_ids` stay Pending until A handles them and sends exact
native acknowledgement. Correction Work prevalidates all handled references,
records an actual Pending attempt, verifies every field of each snapshot and
completes only fully covered exact IDs. Partial coverage stays Pending with
visible error; an already Done row is not rewritten. The local helper
`markQueueRowsDone($ids)` is caller-coverage controlled and is not a REST
endpoint or substitute for scope/coverage validation.

Reconcile native responses by actual ID keys and exact GET readback. Installed
GLPI 11.0.7 omits absent IDs from mixed PUT results, and a collection PUT without
an ID returns 200 `[[]]` with no mutation. HTTP success alone is insufficient proof of an exact
acknowledgement; see [native caveats](api-contract.md#32-responses-are-glpi-responses).

Genuine edit evidence uses RFC3339 seconds with Brunei `+08:00` and trustworthy
clocks. No manual-edit cooldown applies. GLPI-owned metadata follows its native
conventions; mapped date/datetime values use `YYYY-MM-DD` and
`YYYY-MM-DD HH:MM:SS` in destination-native convention. Do not replace genuine
field times with Work, sync, poll, acknowledgement or whole-asset metadata time.

## Manual review and evidence

Use [the manual checklist and evidence index](manual-tests.md#current-evidence-index)
for each completed part, exact curl ledgers, initial failures/selective fixes
and explicit NOT RUN variants. Verification covered representative native,
custom and Fields fixtures, not every installed type/field or unsafe fault
injection. Future deployment changes require their own scoped manual checks;
there are no automated tests or destructive reset/delete/purge steps here.
The later Notes and reconciliation runs have their own scoped PASS/PARTIAL
evidence. Neither earlier Asset/Notes passes nor the bounded 0.4.0 reconciliation
run certifies every field, hook, fault variant or actual Controller A catch-up.
Use the current ledger's remaining gaps; historical source-only checklists are
preserved and must not be interpreted as later runtime results.
