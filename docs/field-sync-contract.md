# Opt-in scalar field isolation — contract version 1

This extension to [api-contract.md](api-contract.md) requires Agent B **0.3.0**
and its additive plugin upgrade. It applies only to a new `subject=Asset`,
`operation=Sync` Work for an already verified **Active** retained relationship.
It never permits first copy, linking by serial, Resume, asset movement or replay.
Notes, first-copy creation and scope-control operations retain their legacy paths.
No endpoint, authentication, outbound request or public record class is added.

On B >=0.6.0 the [History policy](history-contract.md) supersedes the older
genuine-only scalar comparison rule for legacy, v1 and v2 paths. It changes
timestamp meaning, not request/result keys or field selection. One side with
confirmed History wins over a side without it; unreadable History is not absence.
Native `logs` READ and Controller A timestamp alignment are required.

This document defines **version 1**. Version 2 automatic current-state
reconciliation is defined separately in
[reconciliation-contract.md](reconciliation-contract.md) and requires 0.4.0.
Its explicit terminal Work reference permits a new operation after unknown or
damaged prior evidence. It does not rewrite this version's recovery policy,
wire/result shape or dedicated-CLI durability precondition.

The local post-0.6.0 [blank text patch](history-contract.md#blank-text-comparison--local-patch-after-060)
applies to legacy/v1/v2 concrete text comparisons. It is not in the original
0.6.0 release. A/B/Both NULL/empty pairs become AlreadyEqual/VerifiedEqual only
after permitted locked reads, with no History requirement, native write or B
return tuple. Missing optional source-B A input is not a blank. Other source-B
values still return B's actual tuple; other types and exact ACKs stay unchanged.

## Request and compatibility

The optional A-owned, creation-only Work property `field_sync_json` is a JSON
**string** containing exactly:

```json
{"version":1,"mapping_ids":["asset_name","asset_serial"]}
```

It is stored unchanged in a nullable LONGTEXT Work column (upgrade default null).
Native GLPI's undisclosed-fields mechanism hides this column from single,
collection and search record responses. The opted-in result echoes its parsed
contents for reconciliation. No new raw-row keys are exposed to legacy clients.

- Omitted or explicit null: legacy request and legacy result behavior, unchanged.
- Non-null: explicit opt-in; unsupported versions or malformed/extra keys reject.
  A version 2 object follows the separate reconciliation schema; it is not a
  version 1 request with extra keys silently ignored.
- `mapping_ids` is required: a distinct array of enabled mapping IDs for the
  exact route, itemtype and current settings version. No wildcard or duplicate.
- `[]` selects no fields. B still checks account, route, parent and Active link;
  no mapped value is read, arbitrated, returned or written.
- Values and time entries outside the selection reject, rather than being
  silently included. A selected B-source mapping need not supply an A value.
- Missing selected A/Both values become field-level `Rejected`/`VALUE_REQUIRED`
  without a writer attempt. Siblings can proceed. Both **time** handling follows
  the deployed B version: on 0.6.0 one side with confirmed History wins over
  absence on the other; both absent or tied remain Conflict. No time is invented.
- `identity_json.b_items_id` must be positive and must match retained evidence.
  Admission validates the options against the Setting; processing rechecks the
  current Setting, retained link, concrete parent, entity and permissions.
- A never changes an accepted request. Repair/catch-up uses a distinct new Work,
  fresh current A values and genuine evidence after earlier effects are accounted
  for. Settings versions do not negotiate this capability. Older B rejecting
  `field_sync_json` must never cause an automatic fallback to an unselected Sync.

Exclusion is independent of authority: A/B/Both excluded mappings receive an
`Excluded` outcome without field-descriptor lookup, conversion, comparison,
return or explicit write. Exclusion does not clear a field or edit its mapping.
An explicit null value remains a separately validated clear request only where
the existing scalar writer supports it; dropdown null/empty does not clear.

| Authority | Selected mapping | Excluded mapping |
|---|---|---|
| A | Require A value; validate/convert, compare, then verified local write or AlreadyEqual. | Excluded/NotAttempted; no mapped value processing. |
| B | Read and ReturnToA/NotAttempted with B's current value/evidence; A value is optional and never authorizes a local write. Existing B-source return behavior is preserved except a supplied logical text-blank pair under the local blank patch becomes AlreadyEqual/VerifiedEqual without a tuple. | Excluded/NotAttempted; no B value returned. |
| Both | Require A value; equal becomes AlreadyEqual/VerifiedEqual without write. On B >=0.6.0 differing values use field History: newer wins, or the side with History wins over confirmed absence. Both absent/tied conflict. B-win returns B; A-win uses the verified writer. Equal Both adds no B observation. Older versions use genuine-only arbitration. | Excluded/NotAttempted; no comparison, conflict or B return. |

This extension preserves authority and follows the server-version timestamp
policy; it does not add a
new source-specific equal-observation protocol. Legacy result shapes remain
unchanged unless a new non-null opt-in is explicitly submitted.

Agent B **0.4.1** corrects scalar evidence continuity across unchanged Setting
publications without changing this wire format. The normative
[API section 5.6](api-contract.md#56-scalar-genuine-evidence-across-setting-versions-041)
defines internal binding generations, current-value versus local-human history,
capture/uncertain-write invalidation and the non-retrospective upgrade boundary.
An older genuine edit may remain valid while the **new Work** still must use the
current Setting version. Snapshot correction/coverage rules remain exact;
cross-version field evidence alone never completes a Change. The
[29 October local runtime ledger](manual-tests.md#mapping-version-and-first-copy-local-runtime-verification--29-october-2026)
records twelve MV passes, four partial cases and eight direct first-copy passes;
it distinguishes localhost:8081 observations from clone faults and unrun variants.

First-copy requests remain outside explicit field selection. The completed
0.4.1 first-copy integration initializes the same current-value provenance only
after verified seeding/association, with a final-Done trust gate and original
genuine A times. It does not change selected linked Work shapes, permit v1
creation, or initialize reliable proof from historical matching values.

## Extended result and certainty

The separate optional [participation contract](participation-contract.md)
(0.5.0) adds `participation` only when immutable Work `participation_json` opts
in. Its two boolean targets are disjoint from enabled ordinary mappings and
outside `mapping_ids`; no synthetic scalar values are needed. An empty explicit
selection on a verified Active link can be used in a fresh marker catch-up.
Ordinary certainty, whole-snapshot coverage and acknowledgement rules are
unchanged. Flag target outcomes never count as scalar snapshot coverage.

Only opted-in Work uses the extended shape. The six legacy business members
remain and `field_sync` is added:

```json
{
  "b_items_id":231,
  "created_b_items_id":null,
  "b_values_for_a":{},
  "covered_change_ids":[],
  "handled_change_ids_done":[],
  "field_outcomes":[
    {"mapping_id":"asset_name","outcome":"AppliedToB","certainty":"VerifiedApplied","error_code":null,"reason":null},
    {"mapping_id":"asset_status","outcome":"Excluded","certainty":"NotAttempted","error_code":null,"reason":"Mapping not selected for this Work"},
    {"mapping_id":"asset_serial","outcome":"Rejected","certainty":"NotAttempted","error_code":"INVALID_VALUE","reason":"Selected field was rejected before a native writer was called"}
  ],
  "field_sync":{
    "version":1,
    "mapping_ids":["asset_name","asset_serial"],
    "in_flight":null,
    "error_code":null,
    "reason":null,
    "snapshot_outcomes":[]
  }
}
```

All enabled mappings receive an outcome in the admission journal and its readable
successors. If that journal is missing or unreadable, the exceptional recovery
rule below applies; B cannot safely reconstruct its original excluded mappings
or earlier verified siblings from a later Setting. Additional opted-in outcomes are
`Pending`, `Excluded`, `Rejected` and `Unknown`; existing `AppliedToB`,
`AlreadyEqual`, `ReturnToA`, `Conflict` remain. `Pending` is a lifecycle state
before that mapping is processed, not a success. Legacy field-outcome objects
remain exactly mapping_id/outcome/reason and never gain these extra properties.

| Certainty | Exact meaning |
|---|---|
| `NotAttempted` | This Work did not call a native writer for this mapping. This includes excluded/pending/rejected fields, read-only B returns and no-write conflicts. It is not a universal guarantee about incidental hook effects. |
| `VerifiedApplied` | Under the supported dedicated-CLI execution boundary below, the native save was reread as intended; its provisional proof and field data committed together on checked transactional storage, route lock release and final journal persistence completed. It describes this operation, not an assurance that no later human edit exists. |
| `VerifiedEqual` | Locked current value compared equal and no native writer was called; completion was recorded. |
| `Unknown` | Mutation may have occurred, or completion/cleanup could not be confirmed. This is never automatically downgraded to NotAttempted after a rollback, restart or new Work. |

Use certainty and structured error categories, never English-prefix parsing or
Work Failed/Skipped as a no-effects predicate. Codes identify the safe stage or
condition; **certainty and outcome must also be read**. A broad native-stage
code must not imply a more precise cause established only by parsing prose.
Reasons are mapping-specific safe conditions, without raw SQL, credentials,
exception diagnostics or rejected business values.

| Field code | Meaning and evidence |
|---|---|
| `VALUE_REQUIRED` | Selected A/Both mapping has no supplied A value; Rejected/NotAttempted. |
| `INVALID_VALUE` | Exact supported scalar representation, destination conversion or selected native validation rejected before writer; normally Rejected/NotAttempted. |
| `DROPDOWN_UNRESOLVED` | Nonempty incoming label could not be represented by one permitted destination option; Rejected/NotAttempted. Native metadata may not safely distinguish missing, ambiguous or denied options more narrowly. |
| `FIELD_UNAVAILABLE` | Selected descriptor/current value is unavailable or cannot be safely read; Rejected/NotAttempted before writer. |
| `FIELD_PERMISSION` | Selected field/container permission denies the operation before writer while parent authorization remains valid; Rejected/NotAttempted. Parent UPDATE denial is a work-context PARENT_SCOPE failure, not this field rejection. |
| `STORAGE_UNSUPPORTED` | Safe partial native storage/update or checked transactional storage could not be established before writer; Rejected/NotAttempted. |
| `EVIDENCE_CONFLICT` | Selected Both comparison cannot establish a winner; Conflict/NotAttempted and Work Held. On 0.6.0 this covers both History timestamps absent or tied with different values; one-sided confirmed absence alone is not a conflict. |
| `FIELD_BINDING_UNAVAILABLE` (0.5.2) | In 0.5.2 this identifies missing/invalid/changed bindings or an incomplete upgrade. On 0.6.0 History arbitration no longer requires the internal manifest; this code is retained for the incomplete-upgrade fence. Conflict/NotAttempted; aggregate `EVIDENCE_CONFLICT`. Historical receipts stay unchanged. |
| `SAVE_UNCONFIRMED` | Native writer was invoked but did not confirm save; Unknown. A native false return is not a no-effects proof. |
| `VERIFICATION_FAILED` | Writer was invoked but reread did not establish intended saved value; Unknown. |
| `WRITE_UNCERTAIN` | Durable in-flight marker or possible native mutation lacks confirmed completion; Unknown. |
| `COMMIT_UNCERTAIN` | Transaction commit/acknowledgement could not be established; Unknown, including a no-write comparison if transaction completion is unresolved. |
| `JOURNAL_UNCERTAIN` | Provisional/final evidence persistence is unresolved; retain Unknown or the last durable evidence and Hold. |
| `LOCK_RELEASE_UNCERTAIN` | Route-lock cleanup is unresolved; Unknown until sufficient durable completion evidence exists. |
| `INTERRUPTED` | Started Work has a readable retained journal but was not safely completed; no replay. Its in-flight mapping remains Unknown. Missing/unreadable journal instead uses the status/error-only exception below. |

For example, 0.5.2 may return this existing-shape per-field receipt:

```json
{"mapping_id":"shared_contact","outcome":"Conflict","certainty":"NotAttempted","error_code":"FIELD_BINDING_UNAVAILABLE","reason":"Current field binding is uninitialized; a valid Setting publication is required before fresh edit evidence can be established"}
```

This additional field code does not replace the aggregate `EVIDENCE_CONFLICT`.
It adds no legacy result member and does not certify a previous edit after repair.

Work-context failures use `field_sync.error_code/reason`, separate from
mapping rejection. The emitted codes are `ACCOUNT_DENIED` (captured account or
Work authorization), `SETTING_SCOPE` (current route/version/type/mapping),
`PARENT_SCOPE` (retained Active relationship/parent/entity or required parent
READ/UPDATE authorization), `ROUTE_BUSY` (route
lock acquisition), `SNAPSHOT_INVALID` (handled snapshot scope/permission/evidence),
`INCOMPLETE_SNAPSHOT` (whole snapshot remains uncovered), `EVIDENCE_CONFLICT`
(selected Both comparison unresolved), `JOURNAL_UNCERTAIN` and `INTERRUPTED`.
Mapping uncertainty codes may also propagate to this work-context
member. Context failures leave unprocessed selected fields Pending/NotAttempted
unless mutation/completion uncertainty requires Unknown; they are not evidence
that one mapping can safely be quarantined while bypassing the failed context.

The only per-snapshot code is `SNAPSHOT_NOT_SELECTED`, with the exact shape
below. On a rollback exception the connection's transaction state is unknown:
B stops the worker, retaining the previously committed Unknown marker rather
than attempting another potentially unsafe save to emit a new
`ROLLBACK_UNCERTAIN` code. A later restart reports `INTERRUPTED` with that marker.
Do not require a code that this implementation cannot safely persist.

`Done` may contain Rejected/Excluded fields. Conflict or unknown effects make
the opted-in Work Held; safe earlier field outcomes remain. No new Work status
is introduced and no terminal Work is reopened. A must not treat a top-level
Done as proof that every mapping was applied or every snapshot acknowledged.

## Durable journal and interruption

Admission initializes this result only for opt-in Work, including Pending and
Excluded entries and the exact request selection. Legacy Accepted result stays
null. Under the supported execution boundary below, before any possible
selected native mutation B separately commits an
in-flight marker and an Unknown outcome. This marker is not merely a savepoint
inside the mutation transaction.

`field_sync.in_flight` is null or an object with exactly `mapping_id` (selected
string ID) and `verified` (boolean), initially
`{"mapping_id":"asset_name","verified":false}`. When native save+reread
succeed, B atomically stores `verified:true` with the native field transaction
on checked InnoDB field/Work storage. The public field remains Unknown while
in flight, even if verified is true: commit/cleanup may still be unresolved.
Only confirmed commit, route-lock release and final journal save clear the
marker and publish VerifiedApplied. No private DB transaction accessor is used.
Opted-in Work and Change metadata helpers propagate transaction begin/rollback
uncertainty and stop the worker before further journal/snapshot work or a
same-connection readback could mistake uncommitted metadata for durable proof.
Exact readback can resolve a lost metadata response only after the helper has
left a known clean transaction boundary. The independently durable-marker and
atomic-completion claims require a fresh dedicated CLI
`php front/cron.php processWork` invocation, source-verified to have no native
outer transaction, and supported transactional native behavior. Generic reused
cron connections and third-party hooks leaving transactions open are not proven
clean by a public GLPI transaction-state API. No portable ambient-transaction
guard or enforcement is implemented here, and no independently committed-marker
guarantee is made for arbitrary ambient transactions. Native hooks leaking their
own transaction boundaries remain a limitation; the native transaction/fault
manual cases remain unrun.

For example, these are the relevant decoded members while one writer is in
flight; omitted ordinary members in this fragment still exist in the full
result:

```json
{
  "field_outcomes":[
    {"mapping_id":"asset_name","outcome":"AppliedToB","certainty":"VerifiedApplied","error_code":null,"reason":null},
    {"mapping_id":"asset_status","outcome":"Excluded","certainty":"NotAttempted","error_code":null,"reason":"Mapping not selected for this Work"},
    {"mapping_id":"asset_serial","outcome":"Unknown","certainty":"Unknown","error_code":"WRITE_UNCERTAIN","reason":"Field processing has not yet confirmed completion"}
  ],
  "field_sync":{
    "version":1,
    "mapping_ids":["asset_name","asset_serial"],
    "in_flight":{"mapping_id":"asset_serial","verified":true},
    "error_code":null,
    "reason":null,
    "snapshot_outcomes":[]
  }
}
```

`verified:true` records provisional reread proof, not public completion. The
earlier sibling remains VerifiedApplied. A normal GET still returns a Work row
and JSON-string result, never this decoded fragment as a custom endpoint body.

After a writer was invoked, false returns, exceptions, reread failures or
rollback uncertainty remain Unknown unless adequate restoration evidence exists;
this implementation does not claim universal hook rollback certification.
On uncertainty B stops further selected writes and retains earlier verified
siblings. Failure to save a newer outcome leaves the previously durable marker
as evidence. Restart Holds a started Work without replay, preserving known
outcomes and any in-flight uncertainty. If the journal is missing or unreadable,
B changes only status/error, retaining the exact original `result_json` bytes
and the immutable request. Work `error` is the stable machine code
`ASB_FIELD_JOURNAL_UNREADABLE`. There is no reconstructed result or per-field
certainty in this exceptional case: A must treat every selected field's missing
evidence as unresolved and reconcile it. B neither reconstructs the original
enabled set from the current Setting nor infers NotAttempted or permits automatic
version 1 catch-up. A separately opted-in version 2 Work can reconcile current
state after this Work is terminal, under its own scope and execution rules;
the damaged prior bytes remain untouched. The normal structured `INTERRUPTED` result applies only when the
retained journal can be read safely.
The hidden original selection remains stored unchanged, but a damaged parsed
echo cannot be recovered from native REST through that hidden column. A uses
its own retained immutable request for reconciliation; this exception adds no
endpoint or invented replacement evidence.

GET Work exposes the original ordinary request fields and stored journal through
the existing REST resource. It cannot certify every external/native hook effect
or automatically resolve an unknown write. Such fields require reconciliation
before A schedules a distinct current-state catch-up request. Safe automatic
version 1 field catch-up requires the **original Work to be terminal** and that mapping's
stored outcome to be `Rejected` with `certainty=NotAttempted`, while the account,
parent, route and Setting remain valid. Accepted/Pending readback describes only
that instant: the worker may still run, so it does not authorize a concurrent
fresh request. After actual repair A reads fresh current values/evidence and
uses a new Work ID. Unknown, in-flight and even provisional `verified:true`
evidence do not become safe to retry merely because a suspected cause was fixed.
There is no blind
creation, resubmission, old-Work reset or automatic transition out of Held/Failed.
For automatic state convergence after a terminal Unknown/damaged Work, use the
explicit version 2 reference and fresh intent from the reconciliation contract;
a successful new result never upgrades the old Work's historical certainty.

## Change snapshots

Receiving handled IDs never acknowledges them. B validates exact snapshot
scope/identity and mapping keys before native field work. A snapshot containing
an excluded mapping is not read through that mapping's descriptor, attempted
or completed. Selected siblings may still proceed; the Work remains Held with
`INCOMPLETE_SNAPSHOT`. The row remains Pending and its attempt count unchanged.
Its Work entry in `field_sync.snapshot_outcomes` is exactly:

```json
{"id":301,"error_code":"SNAPSHOT_NOT_SELECTED","reason":"Snapshot contains mappings not selected by this Work"}
```

Other missing/wrong-scope references Hold before native mutation. Fully selected
snapshots retain the existing whole-revision coverage/permission checks and
increment attempts only on actual validated processing. A rejection, conflict
or Unknown field never makes its mixed snapshot Done. Exact completed IDs alone
appear in handled_change_ids_done. Unknown native outcomes prevent automatic
queue completion. External acknowledgement remains the exact id/status PUT.

## Native and Fields limits

The new writer does not merge a whole Fields row back into the native save.
It uses source-verified partial native validation/save/history methods for the
selected scalar, requires existing generated storage, and never creates missing
storage/defaults as a side effect. A writer that cannot avoid explicit excluded
value resubmission must reject before mutation rather than claim isolation.

Loading parent/storage rows and permission/status metadata can physically read
columns belonging to excluded mappings. That is not explicit mapping-value
processing. Native GLPI and other plugin hooks may still change sibling values;
History and native metadata may change. This contract does not promise physical
column-read isolation or universal native-hook sibling immutability. The entire
native save remains inside the sync guard. Human-save hooks are unchanged.
The GLPI custom-asset backend may serialize shared JSON storage even when B
supplies only one selected virtual field; this is a native backend effect,
not a promise of physical column isolation.

## Verification status

The original 0.3.0 source-only implementation and FI01–FI35 checklist are
historical. The user later authorized a bounded local Docker 0.4.0 deployment
and disposable-fixture reconciliation run, including representative version 1
and legacy regressions. Its observed results and unrun variants are in the
[local runtime ledger](manual-tests.md#automatic-scalar-reconciliation-local-runtime-verification--29-october-2026).
That run does not mean every FI case ran, every native hook is certified or
Controller A integration is ready. Other deployments need their own checks.

## Exact REST calls and examples

These are the native V1 wrappers from API contract sections 3–4, not custom
responses. Example IDs/values/times are illustrative. Mapping IDs are opaque
Setting keys; their names do not imply a GLPI column or field type. Assume
`route-12`, A entity 12, B entity 5, `Computer`, Setting version 7, and retained
Active pair A 42/B 231. Its enabled mappings include `asset_name`, `asset_status`
and `asset_serial`. All request JSON columns below are **strings**, not nested
objects. The configured deployment's HTTPS API prefix replaces `/glpi`; local
checks, when authorized, use `http://localhost:8081/api.php/v1`.

For every authenticated request:

```http
Content-Type: application/json
Accept: application/json
App-Token: <B_API_CLIENT_APP_TOKEN>
Session-Token: <B_SERVICE_ACCOUNT_SESSION_TOKEN>
```

Session creation remains `GET /glpi/api.php/v1/initSession` with `App-Token`
and `Authorization: user_token <B_SERVICE_ACCOUNT_USER_TOKEN>`. GET has no body.
No credentials belong in any Work/Setting/Change JSON.

### Select Name and Serial, exclude Status

```http
POST /glpi/api.php/v1/PluginAgentbdmosassetsyncWork
```

```json
{
  "input":[{
    "work_id":"A-field-isolation-20261028-001",
    "subject":"Asset",
    "operation":"Sync",
    "route_id":"route-12",
    "a_entities_id":12,
    "entities_id":5,
    "itemtype":"Computer",
    "identity_json":"{\"a_items_id\":42,\"b_items_id\":231,\"serial\":\"SN-0042\"}",
    "a_values_json":"{\"asset_name\":\"Finance PC\",\"asset_serial\":\"SN-0042\"}",
    "a_change_times_json":"{\"asset_serial\":{\"changed_at\":\"2026-10-28T12:00:00+08:00\",\"reliable\":true}}",
    "settings_version":7,
    "handled_change_ids_json":"[]",
    "field_sync_json":"{\"version\":1,\"mapping_ids\":[\"asset_name\",\"asset_serial\"]}"
  }]
}
```

Accepted (bulk input remains bulk even for one row):

```http
HTTP/1.1 201 Created
Content-Type: application/json

[{"id":401,"message":""}]
```

This confirms only admission. At admission the decoded `result_json` has the
six ordinary members with null B IDs and empty return/Change-ID collections,
one `Pending`/`NotAttempted` entry for each selected mapping and one
`Excluded`/`NotAttempted` entry for each other enabled mapping. The `field_sync`
member already echoes version and exact ordered selection, with null in-flight,
error/reason and an empty snapshot-outcomes array. Workers resolve the concrete
parent/Active relationship and current permissions later.

Poll the saved record with no request body:

```http
GET /glpi/api.php/v1/PluginAgentbdmosassetsyncWork/401
```

Success is HTTP 200 and the normal raw Work row, including status, error and
JSON-**string** `result_json`. It does **not** contain a `field_sync_json` row
key. Decode `result_json` once to obtain the versioned object. The earlier
extended-result example shows a terminal result with one verified sibling,
one excluded mapping and one rejected field; it is a possible `Done`, not a
POST validation error. Reasons are explanatory strings; codes/certainty carry
the machine meaning.

For a lost POST response or duplicate rejection, locate the **same** Work ID:

```http
GET /glpi/api.php/v1/PluginAgentbdmosassetsyncWork?searchText%5Bwork_id%5D=%5EA-field-isolation-20261028-001%24&sort=id&order=ASC&range=0-49
```

This returns the native 200/206 raw collection array, with the same hidden
column behavior. Confirm the exact `work_id` and ordinary immutable request
fields plus the echoed selection. A search endpoint uses discovered numeric
search-option IDs; `forcedisplay` cannot expose an undisclosed request field or
repair mutation acknowledgement omissions.

### Empty, absent, missing and clear are different

For a deliberately empty selection, use a distinct `work_id` and these exact
request values with the same positive linked identity:

```json
{
  "field_sync_json":"{\"version\":1,\"mapping_ids\":[]}",
  "a_values_json":"{}",
  "a_change_times_json":"{}",
  "handled_change_ids_json":"[]"
}
```

These are replacement properties inside the complete Work input above, not a
separate partial Work API. No selected fields are processed; with valid scope
and no unresolved handled snapshots, Done reports each enabled mapping Excluded.
An empty selection does not bypass the parent/account/route checks.

Omitting `field_sync_json` or setting its outer value to null uses the legacy
path. With legacy omission of Status from `a_values_json`, source A skips it,
source B still reads/returns B's value, and source Both conflicts; the new
selection does not silently change those rules. A selected A/Both value omitted
under opt-in is a `VALUE_REQUIRED` rejection, while a selected B mapping may
legitimately return its current value without an incoming value.

A supported explicit clear includes the selected ID and the mapping value null
inside its JSON string, for example:

```json
{
  "field_sync_json":"{\"version\":1,\"mapping_ids\":[\"installed_date\"]}",
  "a_values_json":"{\"installed_date\":null}",
  "a_change_times_json":"{\"installed_date\":{\"changed_at\":\"2026-10-28T12:05:00+08:00\",\"reliable\":true}}"
}
```

This requires an enabled `installed_date` mapping with an actual nullable,
supported destination scalar. It never implies deletion, a default dropdown
choice or a clear of any other mapping. Empty string and null remain distinct
stored/wire representations. Only the local blank-text comparison patch treats
them as equal for supported text no-ops; it does not add nullable writers, change
date/dropdown rules or normalize arbitrary invalid input into a clear.

### Admission rejection and immutable storage

For the version 1 shape, a version other than integer 1, unknown options, duplicate/unknown/disabled or
wrong-type mapping IDs, route/version mismatch, non-Asset/Sync use or malformed
selection returns the native bulk denial shape:

```http
HTTP/1.1 400 Bad Request
Content-Type: application/json

["ERROR_GLPI_ADD",[{"id":false,"message":"ASB_INVALID_FIELD: field=field_sync_json"}]]
```

Values/time keys outside the selection use the same response with
`ASB_INVALID_FIELD: field=a_values_json` or
`ASB_INVALID_FIELD: field=a_change_times_json`. Missing/nonpositive linked B ID
uses `ASB_INVALID_FIELD: field=identity_json` when other identity validation has
passed. Base required/type validation and native rights checks can reject
first; the existing error ordering and authentication responses still apply.
An object-form POST uses the native non-bulk denial wrapper instead.

B records the authenticated submitter, exact supplied JSON text and initial
journal; A cannot edit them. PUT of an existing Work is denied by native rights
or, if record validation is reached, `ASB_WORK_IMMUTABLE` inside the native
`ERROR_GLPI_UPDATE` wrapper. Duplicate `work_id` remains `ASB_WORK_EXISTS`; it
never updates, restarts or reapplies the original request.

### Repair and distinct current-state catch-up

After the original Work is terminal and its mapping is explicitly
`Rejected`/`NotAttempted`, the actual cause is repaired and current account,
route, Setting and parent checks are valid, A reads fresh current values and
genuine evidence, safely accounts for the prior operation and sends a new ID:

```json
{
  "input":[{
    "work_id":"A-field-isolation-20261028-002",
    "subject":"Asset",
    "operation":"Sync",
    "route_id":"route-12",
    "a_entities_id":12,
    "entities_id":5,
    "itemtype":"Computer",
    "identity_json":"{\"a_items_id\":42,\"b_items_id\":231,\"serial\":\"SN-0042\"}",
    "a_values_json":"{\"asset_serial\":\"SN-0042-repaired\"}",
    "a_change_times_json":"{\"asset_serial\":{\"changed_at\":\"2026-10-28T12:10:00+08:00\",\"reliable\":true}}",
    "settings_version":7,
    "handled_change_ids_json":"[]",
    "field_sync_json":"{\"version\":1,\"mapping_ids\":[\"asset_serial\"]}"
  }]
}
```

The same POST path/headers/201 wrapper applies. This is a new current-state
operation, not a replay of saved stale values. Source Both still compares genuine
current evidence; repair does not force A to win. Previously successful/excluded
fields remain unselected. After Unknown, do not use this example as permission
to retry blindly: reconcile the old Work/in-flight/native effects first. A lost
GET response is read-only and may be read again; a lost POST response requires
lookup of its original identity, not automatic creation under a fresh ID.
An Accepted Work or a Pending mapping is not terminal refusal evidence; it may
still process later. Work-wide account/parent/route/Setting errors must be fixed
as context errors, rather than classified as one bad field for automatic catch-up.

### Exact whole-snapshot acknowledgement

A correction may submit `[301]` in `handled_change_ids_json` only as a reference,
not an acknowledgement. If immutable Change 301 contains Name and Status while
Status is excluded, 301 stays Pending and its attempt count stays unchanged.
Selected Name may complete, but the Work is Held, contains
`field_sync.error_code=INCOMPLETE_SNAPSHOT`, the documented snapshot-outcome
entry, and no `301` in `handled_change_ids_done`. It must not claim a partial
snapshot complete. A later fresh full correction or complete external handling
must account for the entire snapshot.

After A has actually completed the whole exact snapshot, the existing native
acknowledgement remains:

```http
PUT /glpi/api.php/v1/PluginAgentbdmosassetsyncChange
```

```json
{"input":[{"id":301,"status":"Done"}]}
```

```http
HTTP/1.1 200 OK
Content-Type: application/json

[{"301":true,"message":""}]
```

Reconcile by actual returned ID, then GET that exact Change for uncertain or
missing results; native mixed update responses can omit absent IDs. A cannot
write snapshot fields, retry counters, errors or timestamps. No selection flag
weakens the existing scope, complete-snapshot or exact-ack rules.
