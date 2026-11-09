# Post-upgrade recovery assessments — Agent B 0.7.3

This additive extension implements the approved **B assessment and A handoff**.
B automatically examines existing requests after a native plugin upgrade. It
does not replay their payloads, reopen terminal Works, change historical
certainty, or write assets. A uses fresh current values and the existing
[version 2 reconciliation contract](reconciliation-contract.md) when another
operation is needed. Controller A support for consuming these assessments is
required and is not implemented by this B change.

## Compatibility and installation

Minimum B version: **0.7.3**, with its administrator-run additive native plugin
upgrade. The sole new column is nullable LONGTEXT
`glpi_plugin_agentbdmosassetsync_works.recovery_json`, default SQL NULL. It is
B-owned and hidden from ordinary native single/collection GET responses.
Clients cannot supply it at creation or update it. Existing Work request,
`result_json`, statuses, ownership, rights and exact Change acknowledgements
are unchanged. No endpoint, authentication, public itemtype, mode or additional
profile right is introduced.

The versioned assessment is projected only through a new native Work Search
option **9**, `recovery_assessment`. Options 1–8 keep their current identities;
option 1 is the B row ID and option 2 is opaque `work_id`. Option 9 is a text
computation of the hidden column, not a new physical `recovery_assessment`
column. It cannot be used as a search criterion or sort key. Explicit selection
opts the reader into this extension; legacy result/default raw shapes stay
unchanged. Discovery uses the standard
`GET /listSearchOptions/PluginAgentbdmosassetsyncWork` resource. A must verify
the option's name/metadata and installation boundary, rather than assume that
any server's column 9 has this meaning.

Native GLPI 11.0.7 source masks undisclosed physical columns even in Search.
The implementation therefore uses the supported computed virtual option with
field `recovery_assessment`, computation `TABLE.recovery_json` and datatype
`text`. It does not override API filtering or expose the physical column.
Full, untruncated Search JSON and default-shape compatibility are explicit
manual verification requirements, not assumptions about another GLPI patch.

## Background scheduling and durability

The native installer schedules a small B-owned Config record only. It captures
the current highest Work row ID and does no per-asset assessment or writes.
The record lives in Config context `plugin:agentbdmosassetsync`, name
`recovery_assessment`, and contains exactly these scheduling members:

```json
{"version":1,"build":"0.7.3","cursor":0,"high_work_id":600,"state":"Pending","next_build":null,"next_high_work_id":null}
```

The existing `processWork` action performs at most 20 assessment rows after its
ordinary bounded Work batch, under the existing worker lock. The stable primary
key cursor advances only after the separate sidecar and its original-record
fingerprint are independently visible. New Works above the captured high-water
mark are outside that upgrade generation and retain normal processing.
Assessment counts are native Cron messages; they are not counted as asset
synchronizations in the task's ordinary Work volume.

Same-build installation preserves the current cursor. A later build arriving
while a generation is Pending queues one next build/high-water mark without
discarding current progress. Completing that generation starts the queued scan
from zero. Repeated process invocations and upgrades do not reopen or recreate
requests. `Complete` means the scheduled assessment scan finished; it does not
mean all assets have converged or all incidents have been repaired.

Fresh configured writer/observer sessions reuse the existing database isolation
mechanisms while the original connection retains the worker lock. Separate
job/nonce guards serialize assessment metadata and installer scheduling. Live
ownership checks precede persistence. Sidecar storage locks the original row,
compares its fingerprint, writes only `recovery_json`, commits and checks an
independent observer. Original request/result/status/error/link, timestamps and
all other original columns remain unchanged. Cursor persistence is separately
verified. A missing response never permits advancing on an unverified save.

Unavailable assessment storage leaves the job Pending and produces a safe
native Cron message; ordinary Work processing is not reclassified as failed.
Uncertain transaction, visibility or lock/session cleanup stops the worker
instead of continuing through a possibly unsafe database session. No code
resets Running tasks, clears upgrade markers, repairs old journals, or creates
another recovery framework.

## Assessment semantics

Every assessment is an advisory observation. **A freshness is always Unknown.**
B cannot know whether an old A value has since changed. Current equality is
not proof that an earlier Work succeeded, and a saved provisional `verified:true`
marker is not a final public success receipt.

| State | Meaning |
|---|---|
| `NoAction` | No new B scalar repair is recommended by this assessment: normal unstarted processing, an out-of-scope operation, or a structurally complete historical scalar receipt. It does not certify A finalization, ReturnToA application, participation, Notes or Change acknowledgements. |
| `FreshARequired` | A terminal original request identifies a currently permitted, verified Active parent and no overlapping Accepted request was observed. A may investigate a distinct fresh v2 request. This is a candidate observation, not authorization to skip admission or live checks. |
| `Unresolved` | Identity, scope, permissions, journal/execution accounting or another safe condition remains unresolved. Never replay the old payload. |

| `a_action` | Required handling |
|---|---|
| `None` | Continue normal existing processing/accounting; no recovery mutation is requested by this report. |
| `FreshV2` | Recheck the exact original terminal Work, current relationship, permissions and overlapping execution. A then supplies fresh current values/History/current Setting in a distinct v2 Work. |
| `AccountOriginal` | Read the original Work and establish execution/identity/scope/evidence first. Do not send overlapping or blind replacement requests. |
| `ResolveIdentity` | The original first-copy/null identity cannot authorize v2 or another creation. Account for its actual association/creation outcome through the existing safeguards. |

Observation executes under the original submitting user/profile with current
Work, route, parent, field and History permissions. It uses existing route and
native current-storage locks. Failed/denied History reads are failures, never
confirmed absence. No fresh scalar values, History contents, credentials or raw
diagnostics are included in the report.

Verified earlier field receipts remain historical and are not repeated. An old
Unknown remains Unknown. Tied or missing History is not repaired by the upgrade.
Uncertain creation is never repeated. The assessor never calls native asset or
Fields writers, inserts feedback Changes or acknowledges snapshots.

A structurally valid legacy receipt may have null parent IDs, particularly an
uncertain first copy. It remains Legacy evidence with its original Skipped
outcomes and no invented certainty; null does not by itself mean a damaged
journal. Completed/NoAction classification separately requires a positive,
consistent parent. A valid null original identity needing recovery produces
`FIRST_COPY_IDENTITY_UNRESOLVED` and `ResolveIdentity` without a native parent
lookup, v2 authorization or creation attempt.

Only original terminal Asset/Sync requests with a positive immutable B identity
can be candidates for FreshV2. Current route/entity/type/Active association,
actual rights and absence of overlapping Accepted execution must be observed.
Started Accepted requests remain execution-accounting cases. Unstarted Accepted
requests retain the existing queue path. Notes, Inventory, Suspend/Resume,
billing and UUID are outside scalar recovery assessment.

The report contains at most 50 mapping observations. IDs come from the retained
original selection/validated receipt/payload, not a reconstructed later Setting.
Advanced settings or an unavailable concrete binding do not authorize comparison
against a substituted definition. Same-version comparison describes a current
permitted descriptor versus historical input only: Works do not pin enough
metadata to prove that every old field definition remained continuous. It is
never proof of original binding continuity or historical success.

## Exact sidecar schema

Option 9 returns SQL null when no assessment has been stored, otherwise a JSON
**string**, decoded once to this version 1 object:

```json
{
  "version":1,
  "build":"0.7.3",
  "assessed_at":"2026-11-09T16:00:00+08:00",
  "original_status":"Held",
  "original_fingerprint":"0000000000000000000000000000000000000000000000000000000000000000",
  "state":"FreshARequired",
  "reason_code":"FRESH_CURRENT_STATE_REQUIRED",
  "b_items_id":231,
  "current_settings_version":8,
  "a_action":"FreshV2",
  "original_processing":"Terminal",
  "journal_state":"Valid",
  "settings_relation":"Same",
  "fields":[{
    "mapping_id":"asset_status",
    "prior_outcome":"Conflict",
    "prior_certainty":"NotAttempted",
    "state":"CurrentDifferentFromOriginal",
    "reason_code":"CURRENT_PAYLOAD_COMPARISON_ONLY"
  }],
  "fields_truncated":false,
  "a_freshness":"Unknown"
}
```

The example fingerprint is illustrative. B computes its consistency token as
SHA256 of PHP JSON encoding of the canonical full original DB row excluding
only `recovery_json`, using `JSON_THROW_ON_ERROR | JSON_PRESERVE_ZERO_FRACTION`.
This retains original JSON strings and nullable values; it is not a normalized
scalar/value hash, client authentication or proof of A's current state. A treats
it as an opaque correlation token, not permission to acknowledge a snapshot.

`original_processing` is `Unstarted`, `Started`, `Terminal` or `Unsupported`.
`journal_state` is `Valid`, `Damaged`, `Legacy` or `Unsupported`.
`settings_relation` is `Same`, `Advanced` or `Unavailable`;
`current_settings_version` and `b_items_id` are positive integers or null.
`fields_truncated` reports only the 50-entry cap. Neither false nor any
assessment list proves the full original selection is recoverable: damaged or
legacy evidence may lack original B-source mapping IDs. A must use its retained
request/configuration. It is never a completeness assertion about A's future
selection or historical field handling.

Field objects contain exactly `mapping_id`, nullable original `prior_outcome`
and `prior_certainty`, `state` and nullable safe `reason_code`. No certainty is
invented for legacy receipts or damaged evidence. Field state is
`CurrentEqualToOriginal`, `CurrentDifferentFromOriginal`, `NotSupplied` or
`Unavailable`. Neither equality state changes the original receipt. Missing A
input is `NotSupplied`, never an inferred clear/null. Existing field-aware
blank/null comparison rules remain; History, write verification and immutable
snapshot identity are not weakened.

Safe reasons are condition codes, not English-message parsing. Version 1 emits:
`ORIGINAL_STARTED`, `OUT_OF_SCOPE`, `SCOPE_UNAVAILABLE`,
`UNSUPPORTED_ORIGINAL_CONTRACT`, `ORIGINAL_COMPLETED`,
`NORMAL_QUEUE_PROCESSING`, `ACCOUNT_UNAVAILABLE`,
`FIRST_COPY_IDENTITY_UNRESOLVED`, `PARENT_UNAVAILABLE`,
`FRESH_CURRENT_STATE_REQUIRED`, `OVERLAPPING_ACCEPTED_WORK`, `ROUTE_BUSY`,
`ORIGINAL_PAYLOAD_UNAVAILABLE`, `ORIGINAL_VALUE_NOT_SUPPLIED`,
`FIELD_UNAVAILABLE`, `MAPPING_UNAVAILABLE`, `HISTORY_UNAVAILABLE` and
`CURRENT_PAYLOAD_COMPARISON_ONLY`. Unknown codes must remain visible and
unresolved to A, never be interpreted as successful execution or no effects.

An unavailable old manifest can limit an advisory field observation without
blocking ordinary native-History synchronization. This is **not a new gate**:
A must not require every assessment field to be Available before creating an
otherwise eligible fresh current-state request. Its current permitted concrete
mapping and B's ordinary admission/live processing checks remain authoritative.

## REST readback and A handoff

Use the configured native V1 base with ordinary App-Token, Session-Token and
Accept headers; no request body. For illustrative B Work row 401:

```http
GET /api.php/v1/search/PluginAgentbdmosassetsyncWork?criteria[0][field]=1&criteria[0][searchtype]=equals&criteria[0][value]=401&forcedisplay[0]=1&forcedisplay[1]=9&range=0-0
App-Token: <B_APP_TOKEN>
Session-Token: <B_SESSION_TOKEN>
Accept: application/json
```

Read the native search envelope's `data` and column `9`; validate column `1`
against the exact original row ID. Native search/range/error wrappers remain
GLPI's. Read the original with the ordinary
`GET /PluginAgentbdmosassetsyncWork/401` and retain its exact status/result.
HTTP success, an assessment or a null column is not proof of synchronization.
After a lost read response, repeating the read is safe; no mutation is implied.

Before any new operation, A checks its own original identity/result/accounting,
the current route/Setting/mappings and fresh A field values/History. A waits for
all overlapping Accepted execution to be accounted for. It deduplicates catch-up
intent in its own ledger and uses a distinct work_id; a timeout requires exact
original-ID readback before another mutation. Original successful siblings are
not blindly resubmitted. Sidecar field lists can be truncated and are not a
replacement for A's retained selection/current configuration.

The existing version 2 request remains exactly
`{"version":2,"mapping_ids":["asset_status"],"reconcile_work_id":401}` encoded
as Work `field_sync_json`, with fresh current values/History in the existing
properties. B re-evaluates current authority and native permissions. The new
operation's receipts describe that new operation only. Old terminal Works,
Unknowns and partial outcomes remain unchanged. A alone completes its own
finalization and exact whole-snapshot acknowledgement after all obligations
are handled. See [the Controller A handoff](controller-a-recovery-handoff.md).

## Verification boundary

The finite UR checklist was prepared before runtime. The
[actual UR01–UR16 ledger](manual-tests.md) records fourteen bounded/B-side PASS
cases and two PARTIAL groups, including the retained initial
UR05 diagnostic failure and its independently reviewed fresh-fixture correction.
Native upgrade, Search/default compatibility, old sibling/Unknown preservation,
metadata/ownership faults and controlled fresh requests were exercised in three
separate disposable copies. The ledger identifies exact unrun variants; source
review is not counted as a runtime pass. A's automatic consumer and guarded
B-to-A application were not implemented/tested here. B assessment support alone
is not automatic A/B recovery readiness; A must adopt the handoff.
