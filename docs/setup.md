# Agent-B-DMOS-AssetSync setup (GLPI 11.0.7)

The installed plugin key is `agentbdmosassetsync`; its display name is
**Agent-B-DMOS-AssetSync**. B accepts controller requests through GLPI's
built-in Legacy REST API V1 on Setting, Work and Change records. It performs
asset and native Notes operations locally and makes no outbound requests.
There are no custom HTTP routes, authentication methods or log files.

The reviewed deployment uses GLPI **11.0.7** and active Fields **1.24.4**.
The plugin declares GLPI 11.0.7 through 11.0.x compatibility; other patches have
not been exercised by these manual passes. See [the evidence index](manual-tests.md#current-evidence-index)
for observed behavior and explicit unrun variants. Final Asset Both source and
scoped runtime evidence have been reviewed. Version **0.2.0** adds native Notes
in source; Notes installation, upgrade and runtime behavior have not been
certified. The [Notes contract](notes-contract.md) extends the API contract;
the existing flowcharts remain the baseline Asset flows.

## Deploy and enable

1. Copy `setup.php`, `hook.php`, and the complete `inc/` directory into
   `<GLPI_ROOT>/plugins/agentbdmosassetsync/`. The repository directory name
   `GLPI-Agent-B` is not the installed plugin key. Keep old plugins/resources
   separate from this new plugin.
2. In **Setup > Plugins**, install and enable **Agent-B-DMOS-AssetSync** using
   an administrator account. Installation creates the three public record tables:
   `glpi_plugin_agentbdmosassetsync_settings`,
   `glpi_plugin_agentbdmosassetsync_works`, and
   `glpi_plugin_agentbdmosassetsync_changes`, plus the internal
   `glpi_plugin_agentbdmosassetsync_notelinks` association/evidence table.
   Only the original three record classes are exposed through REST.
   It registers plugin profile
   rights and the native automatic action. Service rights are not granted
   automatically.
3. For an existing installation, deploy the complete version 0.2.0 source and
   perform GLPI's plugin upgrade as an administrator before enabling Notes.
   The upgrade adds missing columns and the internal table without replacing
   existing Work/Change payloads. Existing Work/Change rows become subject Asset
   with null `note_json`; Settings start with Notes disabled (`[]`). This source
   implementation did not run installation, upgrade, deployment or database writes.
4. Uninstall removes all four tables, rights and registered task. It requires
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
revisions remain independent. Notes runtime coverage and lifecycle checks remain
unrun; use the [Notes manual checklist](manual-tests.md#native-notes-source-only-candidate--28-october-2026)
before a pilot.

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
That existing runtime evidence covers the Asset workflows. Native Notes are a
source-only addition pending their own manual installation/upgrade, rights,
capture, identity, content, conflict, cursor and acknowledgement checks. No Notes
runtime certification follows from the earlier Asset passes.
