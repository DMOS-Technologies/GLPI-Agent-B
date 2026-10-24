# GLPI B manual curl review checklist

## Execution status and review boundary

Prepared for `Agent-B-DMOS-AssetSync`, installed key `agentbdmosassetsync`.
Target supplied by the build coordinator: Docker `assetsync2-glpib`, GLPI
**11.0.7**, development origin `http://localhost:8081`. Only the new plugin
resources below are in scope. Ignore OLD AssetSync plugins/resources.
Production transport must use HTTPS; localhost HTTP is the supplied isolated
review target. No curl or runtime case in this checklist has been executed by the reviewer.
The complete eight-file foundation and updated primary contract/spec were
submitted for source review; review found no actionable foundation blocker.
Runtime evidence remains pending and no processing feature is certified.

Read sources: root [spec-b-agent.md](../spec-b-agent.md),
[api-contract.md](api-contract.md), and both flowchart images in this directory.
`docs/spec-b-agent.md` is absent. The private build guide was not read.
The approved task overrides the draft UTC proposal with Brunei GMT+8,
trustworthy clocks, and **no manual-edit cooldown**. Approved evidence uses
RFC 3339 seconds with `+08:00`; compare normalized
instants and treat ties as conflicts. GLPI-maintained native asset/metadata
dates keep installed conventions; do not change GLPI's global timezone.

The user also approved per-route increasing versions, duplicate Work rejection,
per-field skips with reasons, conflicts/uncertain writes Held, one background
worker with no blind retries, B-recorded submitting user/profile, exact unique
option label lookup without creating options, core/custom asset registry support,
optional Fields scalar support, and no autonomous cleanup. Complex relationship
or list fields remain visibly rejected until their payload is defined.
Scope controls are ordinary Work operations `Sync` (default), `Suspend` and
`Resume`, retaining durable links, with no fourth record type. The revised
contract defines link state as `Active` or `Suspended`; use its final
section 4.9 fixtures for scope operations. A checklist expectation is not a runtime result.

| Stage | Availability | Actual result |
|---|---|---|
| Foundation installation, rights, Setting validation | Complete candidate source reviewed; awaiting runtime evidence | NOT RUN |
| Background matching, writes, recovery | Await complete worker candidate | NOT RUN |
| Edit capture, field evidence, acknowledgements | Await complete capture candidate | NOT RUN |
| Native/Fields scalars and dropdown conversions | Await complete field candidate and installed metadata | NOT RUN |
| Full flow and generic/custom-type evidence | Await integrated candidate | NOT RUN |

The runtime operator executes relevant cases once per completed candidate.
The reviewer reads that complete candidate's diff once, then inspects the
operator's redacted evidence. Record failures without broadening the task.
No automated tests, shell test harness, database mutation, delete, purge,
uninstall, or cleanup command is authorized by this checklist.

## Evidence and private environment

Populate these variables privately in the operator's shell; angle-bracket
values are redacted placeholders, not credentials or commands to paste.
Do not put tokens in committed fixtures, output files, screenshots, or notes.

| Variable | Private value / purpose |
|---|---|
| `B_V1_BASE` | Supplied local base `http://localhost:8081/api.php/v1`; production uses its configured HTTPS Legacy base |
| `B_APP_TOKEN` | `<REDACTED_APP_TOKEN>` |
| `B_USER_TOKEN` | `<REDACTED_SERVICE_USER_TOKEN>` |
| `B_SESSION_TOKEN` | `<REDACTED_SESSION_TOKEN_FROM_LOGIN>` |
| `SETTING_ID`, `WORK_ID`, `CHANGE_ID` | Actual numeric B row IDs returned/read for that case |
| `B_ASSET_ID`, `B_ENTITY_ID` | Actual disposable asset/entity fixture IDs |

Use the supplied local `/api.php/v1` base; record the actual deployed HTTPS base separately.
All itemtype suffixes below are exact contract identifiers. GETs have no
body. Run individual curl commands manually. Fixtures are JSON documents,
not a generated test suite; examples below use illustrative IDs 12/5/42.
Replace them consistently with authorized development IDs before execution.
Use separate unused work/route IDs for independent cases; reuse the same
work ID deliberately only for retry/idempotency cases.

For each executed case record: case ID, completed candidate commit/diff,
GLPI patch, service profile/entity context, fixture body without secrets,
HTTP status/headers/body with tokens removed, before/after asset values,
Work/Change readbacks, History evidence when relevant, and PASS/FAIL/BLOCKED.
Record actual field mapping/type/plugin inventory. No successful request
alone proves a write, coverage, authorization, or generic type support.

## Manual curl commands

### C1. Login and authorization context

```sh
curl --silent --show-error --include \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" \
  -H "Authorization: user_token ${B_USER_TOKEN}" \
  "${B_V1_BASE}/initSession"
```

Privately take `session_token` from the response; redact it in evidence.
Login must use native GLPI authentication, with no plugin login route.

```sh
curl --silent --show-error --include \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  "${B_V1_BASE}/getActiveProfile"

curl --silent --show-error --include \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  "${B_V1_BASE}/getActiveEntities"
```

Use normal `getMyProfiles`, `getMyEntities`, `changeActiveProfile`, and
`changeActiveEntities` only if needed for the authorized fixture context.
Do not substitute a Super-Admin session for permission tests.

### C2. Setting creation and readback

Save this fixture as `setting-create.json`, with actual route/entity IDs:

```json
{"input":{"route_id":"review-route-01","a_entities_id":12,"entities_id":5,"route_enabled":1,"settings_version":1,"enabled_itemtypes_json":"[\"Computer\"]","field_mappings_json":"[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"}}
```

```sh
curl --silent --show-error --include --request POST \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  --data-binary @setting-create.json \
  "${B_V1_BASE}/PluginAgentbdmosassetsyncSetting"

curl --silent --show-error --include \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  "${B_V1_BASE}/PluginAgentbdmosassetsyncSetting/${SETTING_ID}?get_hateoas=false&expand_dropdowns=false"

curl --silent --show-error --include \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  "${B_V1_BASE}/PluginAgentbdmosassetsyncSetting?searchText%5Broute_id%5D=%5Ereview-route-01%24&range=0-1&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false"
```

Save the full updated replaceable settings as `setting-update.json`, including
`input.id`, unchanged route, and a higher version; use the following for each
Setting update case. Read back with C2 after the mutation.

```sh
curl --silent --show-error --include --request PUT \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  --data-binary @setting-update.json \
  "${B_V1_BASE}/PluginAgentbdmosassetsyncSetting/${SETTING_ID}"
```

### C3. Work acceptance and result polling

Save as `work-batch.json`. JSON_TEXT columns are escaped JSON **strings**,
not nested objects. The time example is the approved Brunei timezone;
use seconds and `+08:00` for evidence without changing native GLPI dates.

```json
{"input":[{"work_id":"review-work-01","route_id":"review-route-01","a_entities_id":12,"entities_id":5,"itemtype":"Computer","identity_json":"{\"a_items_id\":42,\"b_items_id\":null,\"serial\":\"REVIEW-SN-01\"}","a_values_json":"{\"asset_name\":\"Review A name\"}","a_change_times_json":"{\"asset_name\":{\"changed_at\":\"2026-10-24T12:00:00+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[]"}]}
```

```sh
curl --silent --show-error --include --request POST \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  --data-binary @work-batch.json \
  "${B_V1_BASE}/PluginAgentbdmosassetsyncWork"

curl --silent --show-error --include \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  "${B_V1_BASE}/PluginAgentbdmosassetsyncWork/${WORK_ID}?get_hateoas=false&expand_dropdowns=false"

curl --silent --show-error --include \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  "${B_V1_BASE}/PluginAgentbdmosassetsyncWork?searchText%5Bwork_id%5D=%5Ereview-work-01%24&range=0-1&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false"

curl --silent --show-error --include \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  "${B_V1_BASE}/PluginAgentbdmosassetsyncWork?searchText%5Bstatus%5D=%5EDone%24&range=0-49&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false"
```

Substitute `Accepted`, `Held`, or `Failed` in the status filter as relevant.
Use B's normal GLPI automatic-action runner only after acceptance checks;
record the actual registered action and bounded processing result. No HTTP
worker endpoint and no B-to-B REST call may be introduced for execution.
For a known fixture itemtype, read its before/after values using the same
native V1 base and its actual GLPI itemtype, e.g.:

```sh
curl --silent --show-error --include \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  "${B_V1_BASE}/Computer/${B_ASSET_ID}?get_hateoas=false&expand_dropdowns=false"
```

Perform genuine fixture edits with normal GLPI UI, or its built-in asset PUT
using the fixture's actual writable fields. Record that body and real edit
time. Do not insert Change rows or fake timestamps directly in the database.
Work operation defaults to Sync;
use explicit Suspend/Resume only for scope cases after exact contract fields
and link-state values are aligned.

### C4. Pending reads and exact acknowledgements

```sh
curl --silent --show-error --include \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  "${B_V1_BASE}/PluginAgentbdmosassetsyncChange?searchText%5Bstatus%5D=%5EPending%24&range=0-49&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false"
```

Preserve the exact IDs and snapshots from this response. An acknowledgement
fixture `ack-batch.json` contains **only** IDs actually handled, e.g.:

```json
{"input":[{"id":301,"status":"Done"},{"id":302,"status":"Done"}]}
```

```sh
curl --silent --show-error --include --request PUT \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  --data-binary @ack-batch.json \
  "${B_V1_BASE}/PluginAgentbdmosassetsyncChange"

curl --silent --show-error --include \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  "${B_V1_BASE}/PluginAgentbdmosassetsyncChange/${CHANGE_ID}?get_hateoas=false&expand_dropdowns=false"
```

The allowed single-record form is `input:{"id":301,"status":"Done"}`
with PUT to `/PluginAgentbdmosassetsyncChange/301`. Read each submitted ID
back; do not infer its state from another row or array position.

## 1. Foundation acceptance checklist

The completed foundation provides Setting writes/reads, record schema/rights,
the local settings reader, the exact-ID queue helper, and an empty registered
cron action. It deliberately rejects Work admission, Change creation/capture,
and external Change acknowledgement until their separately assigned parts.
C3 acceptance cases and C4 successful ack cases below are later-stage cases;
at foundation stage expect native denial wrappers with
`ASB_WORK_ADMISSION_UNAVAILABLE: foundation_stage`,
`ASB_CHANGE_CAPTURE_UNAVAILABLE: foundation_stage`, or
`ASB_CHANGE_ACKNOWLEDGEMENT_UNAVAILABLE: foundation_stage` where class validation
is reached. Profile denial may occur before those messages. No invalid or
partially validated Work/Change row may be persisted.

| ID | Manual action and expected evidence | Result |
|---|---|---|
| F01 | Record GLPI 11.0.7 and new plugin identity/version; install/enable through normal GLPI plugin UI on the designated fixture. Confirm install entry points, dependencies, registered empty automatic action `processWork` on `PluginAgentbdmosassetsyncWork` (60 seconds, CLI/external), and setup instructions exist. Inspect schema/read-only metadata for the three exact contract tables/columns, JSON string storage, required/null defaults, entity indexes, case-sensitive unique work/route keys, and version storage. Do not mutate schema directly. | NOT RUN |
| F02 | After install inspect all existing profile rows: plugin rights start at 0 and no service privileges are automatically granted. Open the plugin profile tab and explicitly save the dedicated standard profile; log in again before checking its active rights. Inspect that profile: Setting READ/CREATE/UPDATE, Work READ/CREATE, Change READ/UPDATE; no DELETE/PURGE and no Change CREATE/Work UPDATE. Inspect uninstall source for declared cleanup without running uninstall against fixture data. | NOT RUN |
| F03 | C1 login, context, then C2/C3/C4 resources resolve as real CommonDBTM records through V1. Confirm no old plugin resource or custom route is involved. GET missing ID returns native not-found; collections return raw arrays. | NOT RUN |
| F04 | C2 valid setting save/read: fields are preserved, JSON_TEXT returns as strings, correct routed entity and version. The local settings-reader function returns this saved content unchanged; empty enabled-type/mapping arrays disable work rather than enabling defaults. | NOT RUN |
| F05 | Duplicate route POST; same/lower version PUT; different immutable route ID/A entity/B entity PUT; malformed JSON_TEXT; nested object in JSON_TEXT; invalid source/value_mode; duplicate mapping IDs/enabled type names; duplicate enabled B targets; enabled mapping on disabled type; unsupported selector kind/itemtype; protected native B targets `id`, `date_creation`, `date_mod`, `entities_id`, `is_deleted`; missing required fields; wrong scalar types; extra mapping properties. Protected targets must reject with `ASB_UNSUPPORTED_MAPPING` and no saved row; ordinary business fields must remain eligible. Detailed installed metadata/safe-write capability is exercised in later T09/D07 checks. | Initial unsafe-target subcase FAIL; fix/retest pending |
| F06 | Use one-object and one-element-array Setting POST/PUT bodies separately. Check native wrappers below; no custom 409/422 envelope. Do not equate bulk success/failure with atomicity. | NOT RUN |
| F07 | Run the registered empty action once after foundation install: return/volume show no processed work and no asset/queue changes. Work admission remains failclosed, not Accepted, until its later part. Do not expect the empty action to implement worker deliverables. | NOT RUN |
| F08 | C2/C3/C4 direct-ID and collection reads under out-of-entity and read-denied profiles expose no unauthorized rows; safe create/update attempts in forbidden entity are rejected without writes. Inspect recursive authorization separately. | NOT RUN |
| F10 | Call `plugin_agentbdmosassetsync_read_setting(routeId)` locally in GLPI context for the created exact route and an unused valid route; compare full stored content versus null. Invalid route syntax rejects. Settings never advance version or alter mappings themselves. This is a manual local helper check, not an HTTP helper endpoint. | NOT RUN |
| F11 | Call local `markQueueRowsDone([])` in GLPI context: empty result, no rows touched. Invalid/nonpositive/noninteger IDs reject before any write. Pending-to-Done/nonselected-row proof requires real captured fixtures after the later Change part; do not fabricate production queue rows or claim empty-input proof covers actual transitions. | NOT RUN |
| F09 | Inspect exposed rights and delete/purge guards/source for all three record types. Do not send DELETE/PURGE, add a destructive field, run destructive SQL, or erase fixtures. Confirm no setup instruction requires those operations. | NOT RUN |

## 2. Native response and record ownership checklist

For each malformed fixture, use C2/C3/C4 with a separate document containing
that one fault. Where multiple validation categories are deliberately combined,
assert deterministic priority: B-owned, unknown, missing, shape, business;
within a category, lexical field order. Native rights denial can occur first.

| ID | Manual action and expected evidence | Result |
|---|---|---|
| V01 | Work single-object POST accepted: 201 object `{id,message}`. One-element-array POST: 201 array. Immediately read Accepted with null result/error/completed_at, no asset mutation, no ack. Array of invalid rows: 400 `ERROR_GLPI_ADD` with per-row false IDs. | NOT RUN |
| V02 | Mixed Work POST: valid unique row, duplicate work ID, invalid itemtype scalar, B-owned status. Expect 207 `ERROR_GLPI_PARTIAL_ADD`, correct per-row success/failure, only valid rows persisted. Reconcile each exact work ID. | NOT RUN |
| V03 | Attempt Work create with each B-owned key (`id`, `status`, `result_json`, `error`, `date_creation`, `date_mod`, `completed_at`, `a_items_id`, `b_items_id`, `link_state`, `submitted_users_id`, `submitted_profiles_id`, `processing_started_at`), even null/unchanged; each must fail visibly. Attempt Work PUT: denied by profile or `ASB_WORK_IMMUTABLE` if validation is reached. | NOT RUN |
| V04 | Attempt unknown/GLPI bookkeeping/bypass keys on record input, including `_` control keys; ensure no client-controlled bypass of ownership, entity or internal-write guard. Do not accept silent filtering as proof of rejection. Validate behavior against actual GLPI 11.0.7 admission stage. | NOT RUN |
| V05 | A cannot create Change. Change PUT cannot alter route/version/entity/type/identity, changed fields/times, retry_count, error, date metadata or done_at, even with original values. Setting rejects unknown/B-owned fields. | NOT RUN |
| V06 | Missing app/session token and deliberately invalid non-secret token use native API errors. No password/custom auth or credential storage in Setting/Work/Change. GET with body and malformed outer input use native errors, not plugin routes. | NOT RUN |
| V07 | Valid singleton and bulk Change PUT: 200 array keyed by submitted B IDs. Invalid one-object input: 400 native update wrapper. Mixed valid Pending and invalid transition/forbidden field: 207; successes persist, rejected rows unchanged. All invalid array: 400 with per-ID failures. | NOT RUN |
| V08 | Mixed valid Pending ID plus known absent development ID: record GLPI 11.0.7 missing-ID behavior. Compare returned ID keys to submitted IDs and GET omissions; 11.0.0 can omit missing IDs. All absent IDs may yield an empty error result array. Never assume positional matching or use forcedisplay on PUT. | NOT RUN |
| V09 | Work IDs and route IDs obey bounded ASCII case-sensitive formats; invalid spaces/anchors/overflow reject. Distinct case-sensitive valid keys stay distinct. Same work ID across two routes remains duplicate globally. | NOT RUN |

## 3. Identity, scope, permissions, and idempotency

Each asset-changing case requires C3 Work result plus local asset/History
readback. Confirm settings, identity, field/time rules and original submitting
service permissions are rechecked immediately before writes. No permission
or matching error is evidence that an asset does not exist.

| ID | Manual action and expected evidence | Result |
|---|---|---|
| I01 | Confirmed durable link in correct type/route/entity uses the existing asset, including after its serial changes. An arbitrary supplied b_items_id without saved link evidence cannot hijack an asset. A IDs never become B lookup IDs. | NOT RUN |
| I02 | No link, one complete serial match in routed entity uses that asset. Duplicate serial matches, lookup failure, permission denial, missing serial, and type with no usable serial all hold visibly without create/update. Types use only identifiers they actually possess. | NOT RUN |
| I03 | Linked asset in wrong entity, wrong type/route/A identity, or missing/unreadable linked asset: hold with exact reason. No move, relink, duplicate, archive, delete, or identity fallback that evades an invalid confirmed link. | NOT RUN |
| I04 | Structurally valid Work with old settings_version, unknown route, disabled route/type, unknown type, wrong A or B entity: valid authorized payload saves Accepted, then becomes visibly Held in the background; no asset write. Entity permission denial may reject earlier. Change settings after acceptance and before runner; current settings win. | NOT RUN |
| I05 | Disable or alter mapping between admission and write; only currently enabled authorized mapped fields may write. Unmapped input values stay ignored; forbidden top-level input stays rejected. If settings change during multi-field work, no subsequent invalidated write occurs. | NOT RUN |
| I06 | Service may create plugin Work but lacks underlying asset read/update/create or dropdown/Fields rights: no privilege escalation by cron. Recheck original service/profile/entity rights after admission, including rights revoked before execution; visible definite failure/hold as approved. Record durable author-context mechanism without session secrets. | NOT RUN |
| I07 | Repeat identical completed Work POST; repeat with different content but same ID; read existing row after a simulated lost POST response. Same row/result, no second update/History entry/asset. Retry never resets Done or seeds existing assets again. | NOT RUN |
| I08 | Submit same unused work ID concurrently from two manual clients; then confirm the approved single-worker rule prevents overlapping normal runners from writing the same Work. One accepted row and at most one local operation. Capture unique-key/worker ownership evidence; do not claim concurrency from sequential requests alone. | NOT RUN |
| I09 | Use contract section 4.9 ordinary Work Suspend with empty value/time objects and no handled IDs. Done requires the same verified B ID and link_state Suspended; no asset update. Future Sync holds and genuine B edits do not queue; preexisting Pending snapshots remain visible but cannot be acknowledged/corrected. Resume rechecks link/permissions and records Active, with no seeding or asset update; a fresh Sync exchanges current values. Missing verified link holds; retain original link/evidence across return. A different B entity requires a different immutable route and never causes automatic transfer. | NOT RUN |

## 4. First copy and uncertain outcome recovery

| ID | Manual action and expected evidence | Result |
|---|---|---|
| N01 | Complete permitted identity lookup positively finds no match: local add in routed B entity and enabled type, with every enabled supported A mapping seeded once even source B/Both. Verify reread values, normal GLPI History, durable link, confirmed created_b_items_id and per-field outcomes. No Change from sync. | NOT RUN |
| N02 | Unsupported/unwritable/invalid field during creation follows approved partial policy, with honest outcomes; add denial, validation/save failure and reread mismatch are visible. No Done or confirmed created ID without saved evidence. | NOT RUN |
| N03 | Approved controlled interruption after add but before Work/link completion: recovery reconciles durable evidence and does not blindly add a second asset. Unknown outcome stays visible; do not simulate by destructive SQL or improvise an unapproved failure-injection path. | NOT RUN |
| N04 | Approved controlled interruption after existing-asset update but before Work completion: leave unknown outcome visibly Held without blind retry or rewritten genuine evidence. Read durable result/link evidence and inspect exact History and queue counts; do not claim automatic recovery if only manual inspection is supported. | NOT RUN |
| N05 | Definite Held/Failed, worker ownership expiration, stale work, retry count and already-Done correction IDs follow approved recovery policy. No undocumented reset/retry endpoint or stale threshold. If no safe interruption mechanism exists, mark recovery NOT DEMONSTRATED rather than PASS. | NOT RUN |

## 5. Existing-asset field and time matrix

Use distinct fields or fixtures so genuine evidence is not overwritten by
another case. Set `source` in saved Setting, bump its version, and submit
matching Work. Keep field times separate from whole-asset modification time.
The runner must neither impose a cooldown nor treat recent genuine edits as
sync edits. For every enabled mapping, inspect mapping_id, outcome, reason,
value/time return, and resulting Work status. `AppliedToB`, `ReturnToA`,
`AlreadyEqual`, `Conflict`, `Skipped`, `Failed` are exact contract outcomes.

| ID | Fixture and expected outcome | Result |
|---|---|---|
| T01 | Source A: values differ and B genuine edit is newer. Apply A to B, A remains unchanged; AppliedToB after reread, no returned winning B value. | NOT RUN |
| T02 | Source B: A starts work with newer A time. B unchanged; ReturnToA with B value and original genuine field time/reliability. | NOT RUN |
| T03 | Both: reliable later A field time applies A; reliable later B field time returns B. Compare each field independently when two fields have opposite winners. | NOT RUN |
| T04 | Both unequal values: equal time, missing A time, missing B time, null time, or explicitly unreliable evidence each leaves field unchanged and reports Conflict/reason. Malformed timestamp/evidence shape rejects at admission; no invented winner. | NOT RUN |
| T05 | Values already equal under each source (including missing time evidence): AlreadyEqual, no redundant update/History/Change. Compare normalized values, never unrelated dropdown IDs. | NOT RUN |
| T06 | Genuine edit to field X, later edit to unrelated field Y, later sync write: X retains its own genuine time. Both comparison never uses whole-asset date_mod, Work timestamps, poll/ack times or sync save time. | NOT RUN |
| T07 | Back-to-back genuine edits inside one second or directly after sync: exercise approved precision/equality policy; no cooldown drops either edit. Each genuine underlying storage save produces its own snapshot; native and Fields storage saves within one UI action are separate snapshots under the revised approved policy. Record actual clock/timezone evidence without fabricated times. | NOT RUN |
| T08 | Native text/number/Yes-No/date/datetime scalars and supported Fields counterparts preserve typed values and obey validation/length. Invalid values/overlong text leave targets unchanged with reason, no silent truncation/default. Verify +08:00 wire versus DATETIME storage/read semantics against agreed policy. | NOT RUN |
| T09 | Unmapped/disabled input and fields absent on this type stay unchanged. Unsupported/not writable mapping receives Skipped with exact reason; valid sibling fields still process according to approved partial status. Mapping cannot change generated IDs, entity, delete/archive/clear fields or presentation/relationship-only values. | NOT RUN |
| T10 | Work with successful, equal, return, conflict, skipped and failed fields has truthful per-field results and approved overall Held/Failed/Done semantics; completed_at only when Done. Definite failure and uncertain write are distinguishable; no false completed queue coverage. | NOT RUN |

## 6. Required conversion and field support matrix

Use actual installed scalar/option metadata and record selectors, Fields
version/container, local option IDs, labels and scope. Fixture source option
IDs must differ from B's IDs to prove labels are used. Repeat applicable rows
for A-owned writes, Both A-winner and B/ Both B-winner returned values.
The B-only result checks do not certify A's saving implementation.

| ID | Mapping and expected evidence | Result |
|---|---|---|
| D01 | Native dropdown -> native text, `dropdown_label_to_text`: incoming readable label is stored, never remote numeric ID/string ID. B-winning return is readable and suitable for A's reverse option lookup. | NOT RUN |
| D02 | Native text -> native dropdown, `text_to_dropdown`: unique permissible local label resolves to B option ID, reread proves correct ID. Reverse B-winning return resolves B's ID to label/text. | NOT RUN |
| D03 | Dropdown -> dropdown, `dropdown_label_to_dropdown`: resolve label in destination field's actual option type/entity; source 17 and B 83 with same label prove no foreign-ID copy. Reverse return is label, not B option ID. | NOT RUN |
| D04 | Zero matches, duplicate/hierarchical ambiguous label, wrong option family, out-of-entity option and unreadable option: unchanged field with specific reason; no first-result choice, option creation or fallback empty value. | NOT RUN |
| D05 | Approved label language, case, whitespace, hierarchy, null and empty behavior each has explicit fixtures; confirm exact matching without trimming/case folding, unique locally configured labels or full metadata-defined hierarchy paths, and no implicit empty/null default/clear. Direct scalar null remains subject to field validation. Do not infer it from one successful English label. | NOT RUN |
| D06 | Runtime preparation reports active compatible Fields **1.24.4**; processing is still untested. Fields installed: native -> Fields and Fields -> native scalar text/number/boolean/date/datetime, plus dropdown/text and dropdown/dropdown where defined, use verified container/field metadata and rights. Reread actual Fields storage/UI; top-level asset read alone may not show it. | NOT RUN / installed metadata required |
| D07 | Fields absent/inactive, wrong container/field, Header/presentation field, read-only/container right denied or unsupported complex field: visible rejection/skip per approved admission/partial policy. Native mappings continue where permitted. Search-option presence alone is not field-write evidence. | NOT RUN |
| D08 | Dropdown conversion on a mapped business Status field succeeds if permitted; plugin Work/Change status remains protected bookkeeping. No blanket rejection of ordinary dropdown types as unsupported. | NOT RUN |

## 7. B edit capture, acknowledgements and correction flow

| ID | Manual action and expected evidence | Result |
|---|---|---|
| Q01 | Genuine local edit on enabled mapped/routed type: new Pending snapshot contains exact route/version/entities/type/link/serial, eligible mapped values and original per-field times; A-owned field edits are included. retry_count defaults 0; no A-supplied data. | NOT RUN |
| Q02 | Disabled type/route, out-of-route entity, unmapped-only edit or no actual eligible value change produces no Change. Hook uses cheap local cached settings before heavy work and no outbound call. | NOT RUN |
| Q03 | Read batch snapshot S1 with C4, make genuine edit S2, then acknowledge only S1. S2 remains separate Pending with its own original time. No row overwrite/merge under the approved snapshot policy. | NOT RUN |
| Q04 | Valid exact Pending -> Done updates only submitted IDs and sets B-owned done_at. Pending -> Pending, unknown/case-varied status, Done -> Pending and Done -> Done reject; non-string status uses ASB_INVALID_FIELD. No default status or extra business field allowed. | NOT RUN |
| Q05 | markQueueRowsDone(ids) reviewed source accepts exact IDs only: with two eligible snapshots and an unrelated/newer row, successful controlled correction marks only fully covered IDs Done. Empty IDs change nothing. Missing/out-of-scope IDs cannot broaden coverage. | NOT RUN |
| Q06 | A-start Work returns winning B fields plus covered_change_ids: rows remain Pending after Work Done. A-side local save is operator-simulated only, then C4 acknowledgement; B never acknowledges merely because it returned a value. | NOT RUN |
| Q07 | B-start correction C3 carries handled_change_ids_json from read snapshots. Revalidate route/type/version/asset/mapping/times, apply allowed fields, reread, then mark exactly fully covered rows Done and return handled_change_ids_done. Mere POST acceptance must leave them Pending. | NOT RUN |
| Q08 | Correction fails, conflicts, lacks coverage for one field, references foreign route/type/asset/version/newer snapshot, or includes already-Done ID: no blanket acknowledgement. Affected Pending snapshots remain Pending unless fully covered under the approved whole-snapshot coverage rules; existing Done snapshots never reopen and follow the final contract's correction policy. Reasons stay visible. Partially covered multi-field row is never Done just because one field succeeded. | NOT RUN |
| Q09 | After every worker add/update and correction, compare Change IDs/counts: sync writes produce no new Change. Immediately subsequent genuine human edit still queues; guard is reliably released after failure as well as success, with no cooldown. | NOT RUN |
| Q10 | Pending range batches return full rows, exact IDs and native Content-Range (200/206). Multiple pages and unresolved earliest rows follow approved consumer policy; edits during paging are not claimed to be a stable snapshot. Only completed exact IDs are acknowledged. | NOT RUN |

## 8. Generic implementation and complete-flow proof

| ID | Required source/runtime evidence | Result |
|---|---|---|
| G01 | Source review: one generic itemtype-data path for hook, local lookup/add/update, field handling and background work. No per-asset classes or itemtype switch. Inventory the installed GLPI registry and enabled settings; do not certify “all types” from Computer alone. | NOT REVIEWED |
| G02 | Runtime fixtures: at least two distinct native asset types, a type without usable serial/link case, and an installed GLPI 11 custom asset type (as required by the approved core/custom registry boundary). For each record actual itemtype, fields, add/update, hook, entity rights, result and loop evidence. Unavailable type/fixture remains NOT DEMONSTRATED. | NOT RUN |
| G03 | Optional Fields support has both installed-supported and unavailable-plugin evidence. A missing plugin cannot silently erase custom values or block unrelated native values contrary to approved policy. List unsupported complex kinds explicitly; never claim every Fields kind from scalar proof. | NOT RUN |
| G04 | A-start: manual C3 batch POST then C3 result GET(s); B processing local only. If returned queue rows need A handling, C4 ack adds one request after simulated A save. No initial B-change GET required for an A-only job and no remote serial/settings lookup. | NOT RUN |
| G05 | B-start no B correction: genuine edit, C4 GET, simulated A local handling, C4 PUT; no Work needed. B-start correction: C4 GET, C3 correction POST, C3 result GET; successfully handled exact IDs Done without a second PUT. Poll/login/setup extra calls are recorded separately. | NOT RUN |
| G06 | Source and available runtime evidence: no B outbound HTTP/A calls/self-REST, custom route/auth, extra log files, per-type architecture, automatic delete/archive/clear/entity transfer, speculative cleanup job or A controller code. Use existing normal GLPI History only. Absence of observed traffic alone is not complete source proof. | NOT REVIEWED |

## Native wrapper reference

Compare actual 11.0.7 responses with contract section 3.2; record deviations
instead of promising the 11.0.0 implementation unchanged. Messages may be
translated; match machine code, per-row boolean/ID and stable `ASB_` prefix.

| Mutation | All success | All denied | Mixed |
|---|---|---|---|
| POST one object | 201 `{id,message}` | 400 `["ERROR_GLPI_ADD",message]` | N/A |
| POST array | 201 `[{id,message},...]` | 400 `["ERROR_GLPI_ADD",[{id:false,message},...]]` | 207 `["ERROR_GLPI_PARTIAL_ADD",[{id:new_id_or_false,message},...]]` |
| PUT one object | 200 `[{"id":true,message}]` | 400 `["ERROR_GLPI_UPDATE",message]` | N/A |
| PUT array | 200 `[{"id":true,message},...]` | 400 `["ERROR_GLPI_UPDATE",[{"id":false,message},...]]` | 207 `["ERROR_GLPI_PARTIAL_UPDATE",[{"id":boolean,message},...]]` |

In PUT shapes, `"id"` denotes the actual B numeric ID as an object key,
not the literal text `id`. Missing-ID omission caveat is V08.

## Blocking decisions and final review record

The primary [api-contract.md](api-contract.md) and root spec updates were read
as the authoritative candidate, separately from the foundation worktree's
staged implementation. Final scope vocabulary is `Active`/`Suspended` and
`operation` is `Sync` (default), `Suspend`, or `Resume`. B owns normalized Work
`a_items_id`, `b_items_id`, `link_state`, `submitted_users_id`,
`submitted_profiles_id` and `processing_started_at`. V03 checks rejection of
all these B-owned client inputs; I06 checks their source is authenticated GLPI
context; I09 checks the complete control semantics. Sync cannot reactivate a
Suspended link, and later Held/Failed field work must not erase link evidence.

Source review checked relevant installed 11.0.7 native V1 mutation, entity
filtering, CommonDBTM writes/rights, profile rights UI, cron registration,
transaction and custom-asset registry behavior. No actionable implementation
blocker was found in the complete foundation candidate. One nonblocking
contract wording issue was reported to the coordinator: line 149 prematurely
said conversions were delivered and verified before their parts were complete.
The coordinator corrected it to “must be delivered and verified” in approved
documentation commit `0eed6be`.
The supplied local base is `/api.php/v1`; actual missing-ID responses,
postinstall rights, Setting round trips, safe helper results and Fields scalar
save metadata still need runtime evidence. Installed Fields 1.24.4 availability
alone does not prove mapped writes.

| Completed part | Candidate | Source review | Runtime evidence inspected | Defects / residual limits |
|---|---|---|---|---|
| Initial checklist | Documentation only | Reread after authoring | None; no calls executed | No feature certification |
| Contract/spec decisions | Primary doc diff supplied 24 Oct 2026; approved docs commit `0eed6be` | Full candidate read | None by reviewer | P3 wording reported and coordinator confirmed corrected |
| Foundation initial candidate | Eight staged new files in foundation worktree supplied 24 Oct 2026 | Full candidate read; installed core source consulted; protected-target admission gap missed in source review | Operator reports F05 unsafe native `b_field.name=id` accepted HTTP 201 | FAIL: generated target accepted; saved Setting 2 retained disabled, not deleted. Other executed results await evidence |
| Foundation targeted F05 fix | Completed `Setting::validateMappings` protected-target change | Changed validation reviewed once: protected native B targets always reject; protected A targets reject when source B/Both can write A; ordinary business fields remain eligible | Focused failed-case retest pending; passed cases are not rerun | Source fix approved; runtime result pending |

No feature is certified until both the relevant complete source and required
runtime evidence have been reviewed. No local commit or merge was made while
preparing this checklist; the coordinator will request those separately.


## Foundation executed results preserved by coordinator

Foundation source commit `127326e` was reviewed and merged as `a6649ad`.
The operator completed one foundation pass plus selective F05 correction
checks: **72 curl calls**, all listed with redacted request/response details in
[foundation runtime evidence](foundation-runtime.md). The coordinator read the
operator result/fixture summary and preserved the complete ledger. The
independent reviewer approved the source and F05 fix before runtime checks,
but could not perform its planned final ledger review because agent execution
returned a workspace-credit error. Do not attribute that final evidence review
to the independent reviewer. Earlier pending cells above are checklist history;
the execution ledger states exactly which foundation checks passed and which
remain NOT RUN.

The installed foundation has no remaining reported runtime blocker. Work
admission/processing and Change capture/acknowledgement remain intentionally
unavailable. No end-to-end product completion is claimed. Real Pending row
helper transitions await outbound fixtures. Both subsequent build parts were
interrupted before implementation; their worktrees were preserved.

## Senior 1(a): Work admission candidate review and focused runtime matrix

Complete candidate: staged `inc/work.class.php` in the inbound-a worktree,
reviewed against baseline `3de7950` and the approved contract. Source review
found no actionable blocker. This part implements admission only: the normal
cron remains empty; matching, asset writes, controls, coverage and correction
completion belong to later parts. Accepted scope operations have not yet
suspended/resumed anything. No existing foundation curl case is repeated for
this candidate; use fresh Work IDs and record this part's evidence separately.

Use C3's exact Work POST/GET URLs and headers, with authorized entity IDs and
a fresh key prefix such as `review-wa-`. For negative cases, submit the stated
single fault in an otherwise valid fixture. Check both response and exact
work-ID readback; rejected rows must not exist. JSON_TEXT remains an outer
JSON string. Test operators populate credentials privately and redact responses.
These are manual fixture variations, not a shell test harness.

| ID | Targeted manual fixture / required evidence | Result |
|---|---|---|
| WA01 | POST one valid Work object with optional `operation` and `handled_change_ids_json` omitted. Expect native 201 singleton object; GET by returned ID and exact work ID has `operation=Sync`, handled `[]`, status Accepted, normalized A ID derived from identity, B ID/link_state/processing_started_at/result/error/completed_at null. Verify B-owned submitter user/profile match the authenticated active session; date metadata uses native GLPI conventions. | PASS — calls 5–6,159,162–163 |
| WA02 | POST one-element array and multi-element all-valid array. Use A values of string, integer, finite decimal, boolean and null; `{}` times; null B identity and serial. Expect native 201 array, exact saved JSON strings and distinct IDs. Missing usable identity evidence is accepted for later background holding, not guessed during POST. | PASS — calls 9,142,162–163 |
| WA03 | Add each B-owned top-level key individually, including id, date_creation/date_mod, submitted_users_id/submitted_profiles_id, a_items_id/b_items_id, link_state, processing_started_at, status, result_json, error and completed_at. Even null/unchanged/default values reject `ASB_B_OWNED_FIELD`; verify none can forge internal state or credentials. Nested identity's A/B ID keys remain the declared A-owned identity input, not the normalized top-level fields. | PASS — calls 15–26,36,162 |
| WA04 | Client `_add`, `_no_history`, `_from_api`, other bypass/unknown key; missing entities_id; owned+unknown+missing combined. Require original-client validation, no acceptance of native injected defaults as supplied required content. Expected categories are owned first, unknown second, required third, then shape/business; within category lexical order. Native profile/entity denial can occur before plugin validation. | PASS observed precedence/bypass cases — calls 27–34,40 |
| WA05 | Required keys omitted individually; string/float/bool/negative/out-of-uint IDs/version; version zero; empty or invalid/overlength route/work key; nonstring/empty/over-255-character itemtype. Expect stable `ASB_REQUIRED_FIELD` or `ASB_INVALID_FIELD` in the native wrapper with no saved row. Preserve distinct valid case-sensitive keys; do not rerun foundation Setting-key cases. | PASS observed cases — calls 37–62,127–130; native permission precedes shape for some target entities |
| WA06 | Each JSON_TEXT field as nested object/array, malformed JSON string, outer null or wrong inner root shape. `identity_json`, values and times require inner objects; handled IDs require an inner array. Identity requires exactly a_items_id, b_items_id and serial: missing/additional keys, zero/string A/B IDs and empty/nonstring serial reject; null B ID/serial are accepted. | PASS observed cases — calls 63–78,84–87,116–120,132 |
| WA07 | Values object: valid mapping IDs and scalar/null values accept; invalid/overlength mapping key, array/object value or non-finite numeric JSON decode result reject. Unmapped but structurally valid scalar entries are admitted unchanged for the later worker to ignore. No POST-time option lookup, metadata matching or asset mutation. | PASS — calls 9,79–83,162 |
| WA08 | Times object accepts missing mapping evidence, `{}`, `changed_at:null` with boolean reliability, and reliable false. Reject missing/additional time-object keys, string/integer reliability and nonstring/non-null timestamp. Valid exact `2026-10-24T12:00:00+08:00` accepts; UTC Z, another offset, fractions, absent offset, bad day/month/leap day/hour/second or malformed text rejects. No timestamp is invented or compared during admission. | PASS — calls 5,10–12,88–102,131,162 |
| WA09 | Explicit Sync/Suspend/Resume exact case accepted; omitted defaults Sync. Null, lowercase, unknown, scalar other than string and structured operation reject `field=operation`. Suspend and Resume must have values/times exactly `{}` and omitted/empty handled IDs; nonempty values, nonempty times, `[]` object substitutes, or handled IDs reject the relevant field. Successful POST remains Accepted and link_state null until later control processing. | PASS admission — calls 13–14,35,103–115,162; control execution NOT RUN |
| WA10 | Handled IDs omitted/`[]` or distinct positive integer array accept under Sync; duplicate IDs, zero/negative/string/float/overflow ID, inner object or null reject. Admission never acknowledges any referenced row, even when the IDs exist. | PASS admission — calls 13,35,116–126; existing-row ack side effects NOT RUN |
| WA11 | Repeat the same accepted Work ID with identical payload, then changed payload/route under that ID. Expect `ASB_WORK_EXISTS` and one unchanged saved row. Submit the same new ID from two manual clients concurrently: one accepted row, other duplicate/busy as observed, no overwrite. Read exact ID after an uncertain response; do not replace correlation key to hide a retry. | PASS — calls 138–141,155–160; one concurrent pair, lock-busy timeout NOT RUN |
| WA12 | Mixed bulk: valid unique row + duplicate + B-owned field + malformed JSON. Expect 207 ERROR_GLPI_PARTIAL_ADD with one native result per submitted row; only valid row persists. All-invalid array uses 400 ERROR_GLPI_ADD with false IDs. Single invalid object uses its native scalar-message wrapper. | PASS — calls 142–144,162 |
| WA13 | Well-formed unknown route/type, disabled type, old settings version or identity lacking usable B identifiers: authorized schema-valid payload stays Accepted for later worker holding. Before/after asset values, Change IDs/count and ordinary asset History remain unchanged after admission and empty cron. Missing submitter/profile context fails visibly if safely available through a local GLPI manual context; do not forge a REST account context or claim unexecuted proof. | PASS admission/collection boundary — calls 7–8,133–137,164–165; History, cron, missing-auth-context and later Holds NOT RUN |
| WA14 | A PUT to the saved Work stays denied by rights or ASB_WORK_IMMUTABLE if validation is reached, including attempted status/result/payload changes. Read original row unchanged. Verify unauthorized entity or absent Work CREATE right rejects admission with native permission behavior. Delete/purge remains source/rights proof; no destructive request. | PASS rights/unchanged row — calls 148–154,159; deletion/purge NOT RUN |

The reviewer performed no curl calls, runtime mutations, automated tests or
implementation edits for Senior 1(a). Source approval and the independently reviewed runtime evidence both support
this admission part. The result cells above reference exact calls in
[inbound-a-runtime.md](inbound-a-runtime.md), which preserves the complete
redacted 173-call request/response ledger. Unexecuted subcases remain explicit. Foundation evidence remains
in [foundation-runtime.md](foundation-runtime.md), including its initial F05
failure and focused fix results; real Pending helper transitions are still
NOT RUN until outbound fixtures exist.


### Senior 1(a) executed evidence review

The independent reviewer inspected the operator's report, every recorded
request/response (with repetitive request/row data compacted for reading),
exact-ID/collection readbacks and limitations. No implementation failure was
observed in this admission pass. The full operator ledger is preserved verbatim
in [inbound-a-runtime.md](inbound-a-runtime.md); its opening “READY” is the
operator's status before this evidence review. The reviewer made no curl calls
and did not repeat any source or runtime check.

The 173 calls created 22 Accepted Work fixtures: root IDs 1–20 and 22 have
submitter user 12/profile 14, child ID 21 has user 14/profile 14. All verified
B-link, processing, result/error and completion columns remain null. The
concurrent pair used independent sessions: calls 156–157 yielded one 201
(Work 22) and one duplicate error; call 160 confirmed one exact matching row.
Calls 143–144 demonstrated native mixed/all-denied wrappers and final fixture
inventories showed no rejected Work rows. Calls 164–165 showed the visible
Computer collection and empty Change collection unchanged from calls 7–8.
This proves the observed admission boundary, not all assets or asset History.

WA05's negative/float/overflow B entity requests encountered native permission
denial before plugin validation. Those are safe denials, not proof of the
plugin's shape message for those inputs. Other recorded uint cases reached
plugin validation. Actual existing Change-row handling, missing authenticated
user/profile context, lock-busy timeout, concurrent stress, cron execution,
History before/after, background Holds and all matching/creation/conversion/
control/recovery/correction/full-flow behavior are **NOT RUN**. No delete,
purge, destructive database command, automatic cleanup or automated test ran.

Containment: calls 171–172 disabled only disposable Setting 1 using native PUT
at version 3. Settings 3/4 were already disabled; the other named route is
absent. Preserve all 22 Accepted fixtures and do not reenable their old routes
for later processing checks. No Work status was altered and no asset/Change
fixture was created. All five new sessions were closed.

| Completed part | Source result | Runtime result | Remaining scope |
|---|---|---|---|
| Senior 1(a), Work admission | Complete changed file reviewed; no actionable blocker | Independent evidence review PASS for the observed WA01–WA14 admission subcases; 173-call ledger preserved | Explicit NOT RUN subcases above; later worker and outbound parts pending |

## Senior 2(a): outbound capture source review and manual matrix

Complete four-file candidate reviewed: `setup.php`, `inc/change.class.php`,
`inc/capture.php`, and `inc/fields.php` in the outbound-a worktree. Installed
GLPI 11.0.7 CommonDBTM/custom-asset behavior and Fields 1.24.4 hook ordering,
generated storage, field metadata and container rights were consulted. No
runtime deployment or curl was performed by this reviewer.

Initial source approval was **WITHHELD** for a material failure-visibility gap:
`capture_collect` catches unsupported/unreadable/changed-before-verification
mapped values and emits only a session redirect message; `capture_flush`
discards in-memory capture state before queue creation and converts a queue
save/verification failure to the same message channel. REST/CLI/shutdown paths
can therefore save a genuine edit with no durable record of its failed field
or reason. A's normal Change GET cannot see or retry it. The user subsequently chose rejection of unsupported enabled B mappings,
without empty/error Change rows, and immediate separate snapshots per real
storage save. The completed targeted fix rejects unsupported metadata before
saving, propagates post-save failures as explicit uncertain outcomes and
retains saved fields/updates plus unsaved route rows in request-local state;
there is no shutdown retry. That resolves the original P1 in source. Runtime
must demonstrate the observed rejection/uncertain paths rather than promise
durable evidence when the database itself cannot persist.

One P2 admission gap remains in the new Setting capability gate: the descriptor
is checked but its destination kind is not compared with value_mode. Text with
text_to_dropdown, or dropdown with direct/dropdown_label_to_text, can still be
enabled even though the existing writer rejects those known incompatibilities.
Reject these with ASB_UNSUPPORTED_MAPPING without assuming remote A metadata.
The completed compatibility fix was reviewed once: dropdown destinations allow
text_to_dropdown/dropdown_label_to_dropdown, text allows direct/dropdown_label_to_text,
and other supported scalar kinds allow direct only. Unsupported combinations
reject ASB_UNSUPPORTED_MAPPING. No actionable source blocker remains; the
first focused OC runtime pass is approved.

These manual cases use fresh disposable routed assets and exact C4 Pending
collection reads. Preserve IDs/field times and before/after asset/Fields values.
Use a normal GLPI UI/native asset PUT for genuine saves and approved local GLPI
calls for guarded saves/helper checks; never fabricate queue rows with SQL.
Old Work admission routes remain disabled and their 22 Accepted fixtures stay
untouched. This part still denies external Change creation/acknowledgement;
external successful acknowledgements/corrections remain later-part cases.

| ID | Manual operation and required evidence | Result |
|---|---|---|
| OC01 | Genuine native mapped-field save on a routed enabled type yields one Pending row per applicable route for that underlying native storage save, with exact entities/type/identity/settings version, retry_count 0, null error/done_at and original +08:00-second field time. A-owned mapped field edits queue too; source choice does not exclude capture. Read local saved value and row back. | PASS observed Computer/Monitor — curl 9–16,51 |
| OC02 | Disabled route/type, outside entity, unmapped-only save, unchanged submitted value, or ordinary asset add yields no outbound Change. Capture starts with the cheap local enabled-type check. Do not certify all types from one Computer fixture. | PASS observed disable/unmapped/outside/add — curl 22–24,33–37; local 17; unchanged-value variant NOT RUN |
| OC03 | Two genuine saves of the same field create separate immutable rows; later unrelated field save does not replace earlier field evidence. Back-to-back/same-second saves remain captured with no cooldown. Reading earlier row then editing again preserves the earlier snapshot and new Pending ID. | PASS observed separate same-second snapshots — curl 10–11,14,51; later unrelated-field time variant source-only |
| OC04 | A save changing multiple native fields creates one snapshot for that route containing only actually changed enabled mappings. Multiple routes to the same B entity produce independent per-route snapshots, without merging distinct A links. | PASS native multi-field and two routes — curl 10,14,38–40,51 |
| OC05 | Native dropdown change returns its readable local label/full metadata-defined hierarchy path, never a foreign/raw option ID. Native text/number/boolean/date/datetime values retain supported scalar types. Empty/unreadable/missing option and unsupported kinds follow durable failure handling, without a false reliable value. | PASS observed native dropdown and Fields scalars — curl 14,16,47; option failure variants NOT RUN |
| OC06 | Existing-asset nested Fields save with native change creates separate immediate Pending snapshots for the real Fields storage save and real native save, per route. A UI save need not map to one queue row. Fields-only save with unchanged native columns/same-second date_mod still captures immediately, exactly once for that Fields save. No shutdown staging or aggregation. Verify both saved storage values and exact queue IDs; each snapshot requires its own full coverage/acknowledgement. | PASS separate immediate rows 4/5 and Fields-only row 7 — curl 15–16,20,24 |
| OC07 | Standalone Fields tab/generated-storage update captures immediately once per real storage save. First generated storage-row add for an existing asset captures eligible submitted fields; asset creation with nested Fields storage does not queue an asset edit. Record actual hook/save boundary evidence. | PASS standalone row 6, existing first storage row 8, no nested-add echo — curl 19–24 |
| OC08 | Fields scalar text/textarea/url/number/yesno/date/datetime and single dropdown/native-reference dropdown capture real saved values and labels. Container inactive/missing/ambiguous/out-of-entity/read denied/write denied, readonly/multiple/Header/complex definitions never become falsely supported scalar snapshots; unsupported enabled mappings are rejected at admission, and later unavailable metadata rejects visibly before saving where possible. Verify effective installed metadata/permissions, not search display alone. | PASS eight observed Fields scalar/dropdown kinds and readonly/date rejection — curl 15–18,30–32,47; broader metadata/permission variants NOT RUN |
| OC09 | Registered custom asset: core column and virtual custom_* scalar changes capture independently, and only changed JSON-backed field mappings queue when several custom values share custom_fields. Record real definition/type/options and reread virtual value. Include custom dropdown label and profile readonly/hidden restrictions; unavailable fixture remains NOT DEMONSTRATED. | Initial FAIL curl 13/17; targeted fix PASS curl 41–45,48,51; custom date-only/number/boolean/hidden variants NOT RUN |
| OC10 | Approved local sync_guard around native/Fields/custom saves yields no outbound rows; nested guards stay active until outer exit. A thrown/false save releases guard through finally; immediately following genuine edit queues normally. No REST payload flag may activate internal guard. | PASS representative native nested guard/finally — local 9; Fields/custom guarded saves source-only |
| OC11 | Retained verified Work Active link provides correct A identity; Suspended suppresses genuine edit capture. Most recent successful control determines scope, ordinary Sync does not reactivate. Competing verified A identities for one B asset reject visibly with a reason before saving where possible, not arbitrary linking or silent omission. Control-processing fixtures require later worker support or an explicitly authorized local GLPI fixture; no raw DML. | NOT RUN — no trusted worker link/control completion boundary deployed |
| OC12 | Normal A Change POST is denied by rights/add entry point; client internal/bypass flags cannot call trusted createCapturedChange. Local trusted entry rejects invalid scope/identity/empty or malformed changed fields/times, initializes Pending and rereads every saved field. Guard resets after failure. Use a controlled real capture rather than pretending external POST creates a trusted fixture. | PASS empty trusted snapshot rejection — local 16; other malformed trusted inputs NOT RUN, external create denial from foundation only |
| OC13 | Induce an approved safe unsupported/changed-metadata preflight failure: operation rejects before saving where possible. Induce approved post-save queue persistence/reread failure: response explicitly reports unknown asset/capture outcome, saved fields/updates/original edit time and unsaved route rows stay in request state, further eligible capture mutations reject, and no automatic retry occurs. Never claim asset rollback or durable failed row without proof; no empty/error snapshot. Session-only message does not pass. | PASS presave date/readonly rejection — curl 30–32,47; post-save queue/reread failure injection NOT RUN (no safe approved hook) |
| OC14 | Once genuine Pending rows exist, manually call exact-ID markQueueRowsDone with approved fully handled fixture IDs plus leave another Pending/newer row unselected. Verify exact transitions/readback, untouched fields/unselected rows, empty/invalid input behavior and no sync echo. This fills the foundation's deferred helper-transition proof without enabling the later external ack validator. | PASS exact selected helper row 1 Done/row 2 unchanged — local 11 and curl 51; external ack/correction NOT RUN |

This source review does not certify safe local mapped writers, A-side saves,
field winner comparisons, correction coverage or product completion. No source
or runtime check already passed in foundation/Work admission is rerun here.

## Senior 1(b): existing-asset A-source worker source review and manual matrix

Complete staged candidate read in inbound-b: `inc/work.class.php`,
`inc/process.php`, `inc/write.php`. It depends on the separately reviewed
shared field descriptors/capture guard from Senior 2(a); do not deploy it
until that dependency's complete fix has passed review. Source review checked
actual GLPI 11.0.7 Session profile/entity rebuilding, current rights and
CommonDBTM behavior, plus installed Fields local update behavior. No runtime
calls or implementation edits were performed by this reviewer.

Initial source approval was **WITHHELD** for transaction failure classification:
`write.php` commits after a local save at line 181; commit/rollback exceptions
escape without the `Save failed:` or `Hold:` prefix used by `process.php`
lines 215–224. That per-field catch otherwise keeps the default Skipped
outcome and can finish the Work Done. An attempted write with uncertain
transaction completion must instead be Held with a visible reason and retained
partial evidence. A confirmed field validation skip must remain distinguishable
from a possible committed write. No further actionable source finding was
identified in this completed three-file candidate. The completed targeted fix
was reviewed: transaction start/completion, rollback, unexpected save and final
route-lock release failures now propagate explicit Hold reasons instead of
becoming default skips. Confirmed false-save/reread failure remains Failed
only after successful rollback. The final lock-release guard was reviewed
separately after the first fix left that escape path. Senior 1(b) source is
approved after these fixes; runtime approval still awaits the shared dependency.

Use new disposable enabled routes and already-existing assets, fresh C3 Work
IDs prefixed `review-ib-`, and the normal registered automatic action. Old
admission fixture routes remain disabled; their Accepted rows may become Held
when encountered, without asset writes. Record the exact processed batch IDs.
Do not repeat earlier admission/schema/auth tests. Local failure injection or
control-link fixtures require coordinator approval and normal GLPI methods;
no raw DML, destructive commands or fake production evidence.

| ID | Bounded manual scenario and required evidence | Result |
|---|---|---|
| IB01 | Existing unique serial in routed entity, A-source native text mapping: Accepted before runner; runner locally updates intended field, rereads, records AppliedToB and verified B link Active, then Done/completed_at. Asset History attributes the original submitting user. No asset creation, Change echo, or outbound/self REST. | NOT RUN |
| IB02 | A-source already-equal value yields AlreadyEqual with no redundant update/History. Unmapped, disabled and absent A values leave other asset fields unchanged, with exact enabled-mapping outcomes/reasons. Source B/Both mappings remain unchanged and make this stage visibly Held with not-installed reason; no fabricated return/winner. | NOT RUN |
| IB03 | Verify retained confirmed link is reused after serial changes; arbitrary claimed B ID with no evidence, mismatching retained ID, multiple retained B IDs, linked missing/wrong-entity/deleted/template asset, or competing route/A source ownership all hold visibly without writes. Valid A ID never becomes B lookup ID. | NOT RUN |
| IB04 | No link: one exact permitted serial match inside routed entity is eligible. Duplicate serial, absent/blank serial, no serial field, inaccessible lookup and zero matches each Hold without create. Case/whitespace-different serial never silently identifies an asset. First-copy zero-match reason explicitly states later-stage unavailability. | NOT RUN |
| IB05 | Disabled/missing route/type, stale version, wrong A/B entity or settings changed after acceptance Hold before write. Before each subsequent mapping current route/version/mapping/identity are checked again; previous verified writes remain honest partial evidence. | NOT RUN |
| IB06 | Worker invoked from normal cron rebuilds captured user/profile from current database authorization, clears cron/inventory privileges and requires current Work READ/CREATE, routed entity and asset rights. Revoke profile/entity/asset/Fields permission after admission: no cron-admin escalation. Inactive/deleted/expired user and active permission-bypass context Hold. Context restores after both success and exception. | NOT RUN |
| IB07 | Single worker lock prevents overlap; at most 20 Accepted rows per pass, ascending IDs, volume reflects processed rows. Already started Accepted Work becomes Held as uncertain with its previous partial evidence and never replays. Held/Failed/Done rows are not reopened by another runner. Use approved safe interrupted fixture; do not change Work processing columns through REST/SQL. | NOT RUN |
| IB08 | Multiple A mappings with successful and invalid/skipped fields: save per-field verified result as processing progresses; final status reflects actual definite failure/uncertainty and preserves earlier link/outcomes. Interrupt after one verified field only through an approved safe mechanism; later pass Holds instead of rewriting it. | NOT RUN |
| IB09 | Native text/finite number/integer/boolean/date/datetime destination writes validate actual bounds/precision/nullable support before save. Date YYYY-MM-DD and datetime YYYY-MM-DD HH:MM:SS are native destination values, separate from +08:00 edit evidence. Invalid/overflow/lossy/overlong values or unsupported null writer leave field unchanged with specific reason, never silent truncation/default. | NOT RUN |
| IB10 | Required dropdown-label-to-text, text-to-dropdown and dropdown-to-dropdown mappings resolve actual local option labels/IDs; source ID deliberately differs from B ID. Exact unique permitted label/path succeeds; absent/duplicate/wrong-family/out-of-scope/unreadable/empty/null label skips visibly without option creation, trimming/case folding or default clear. Reread actual B ID/value. | NOT RUN |
| IB11 | Fields single scalar writer uses real installed metadata/container rights and normal local Fields methods/asset History. Change one mapped scalar while retaining all unrelated scalar and multiple values byte/semantically equivalent after reread; no data loss when whole container normalizes. Current status readonly override denies mapped write. Missing/ambiguous storage and changed metadata stay visible. | NOT RUN |
| IB12 | Registered custom asset native/virtual custom_* text/number/boolean/date/datetime/dropdown uses generic path and actual field formatter; hidden/readonly/multiple/richtext unsupported mappings never become false AppliedToB. Only intended JSON-backed custom value changes; sibling values remain intact. Record actual type/metadata and readback rather than claiming all types from Computer. | NOT RUN |
| IB13 | Every local native/Fields/custom update is inside sync guard; no new Pending row. A genuine edit immediately afterwards queues normally once outbound capture is available. Guard releases on thrown/failed save, without cooldown. Verify queue IDs/counts around both operations. | NOT RUN |
| IB14 | Suspend/Resume operations and correction handled IDs are explicitly Held/not installed in this stage; controls do not execute, queue stays Pending and no handled IDs are claimed Done. B-owned mappings have no return result yet; Both has no field-time winner yet. Existing verified link evidence survives later Held/Failed processing. | NOT RUN |
| IB15 | Safely induce local save/reread failure versus transaction commit/rollback uncertainty after an attempted write. Definite failed save is Failed; unknown commit outcome is Held with reason, started marker/partial evidence retained and no blind retry/false Done. No rollback claim is made without proof. | Source fix approved; runtime uncertainty cases NOT RUN |

The manual matrix is limited to this completed part. First copy, B returns,
Both arbitration, control execution, correction completion and full flows
remain future-stage requirements, not passing results. Shared Senior 2(a)
capability/failure-path changes must be integrated before this runtime pass.


Senior 1(b) targeted review history: initial transaction classification P1
reported; first fix covered commit/rollback/save errors but left unprefixed
RELEASE_LOCK failure after the action; second fix guarded that finally query
with an explicit Hold reason. No source blocker remains in this part after
targeted review. No runtime failure injection or other curl was performed.


### Approved outbound snapshot-boundary revision

The user explicitly approved separate immediate Pending rows for each real
underlying native/Fields storage save. A single user action can therefore
produce a native snapshot and a Fields snapshot for the same asset/route.
Each retains its genuine per-field save time and immutable exact queue ID;
coverage/acknowledgement applies independently to every snapshot. A parent
asset update with unchanged native columns does not postpone its completed
Fields capture until shutdown or a future request. Earlier combined-snapshot
wording in the initial source review records the superseded candidate, not
the revised acceptance rule. The metadata rejection and visible uncertain
queue persistence requirements remain unchanged; no empty Change/error-row
schema was approved. The completed simplified capture fix was reviewed as documented below; no
unfinished implementation was inspected.


Senior 2(a) targeted P1 review: completed new capture callbacks/Setting gate,
shared descriptor permission/native date-value checks and transactional trusted
Change creation were read. Immediate per-storage capture and explicit uncertain
failure propagation satisfy the approved replacement for the original P1.
OC13 now tests that approved behavior; the earlier durable-error-row proposal
was rejected by the user and is not an acceptance requirement.

| ID | Additional capability admission case | Result |
|---|---|---|
| OC15 | Enable actual supported native/Fields/custom scalar selectors with compatible destination modes. Missing/inactive/readonly/out-of-entity/unwritable/complex B mappings reject ASB_UNSUPPORTED_MAPPING. Known mode-kind incompatibilities (text plus text_to_dropdown/dropdown_label_to_dropdown; dropdown plus direct/dropdown_label_to_text; nontext scalar plus dropdown_label_to_text) must reject at Setting admission, not wait for Work skips. A remote selector's availability is not invented or verified over HTTP. Disabled unsupported mapping staging follows contract shape rules without enabling it. | Initial FAIL curl 46; targeted fix PASS curl 58–61 plus local 20–23; mode/missing/Fields readonly rejects curl 25–29,31; hidden/complex variants source-only |


Senior 2(a) targeted P2 review: the completed destination-kind/value-mode gate
was read once and matches the supported conversion contract. Source approval
is granted after P1/P2 fixes. OC01–OC15 are ready for the first focused runtime
pass, with separate immediate native/Fields snapshot IDs, admission rejection
and explicit post-save uncertain outcomes as the acceptance rules. No runtime
case has been executed or certified by this source approval.


### Senior 2(a) initial OC09 runtime failure

The operator reports OC09 failed for custom itemtype
`Glpi\CustomAsset\AgentBOC20261024Asset`, asset ID 1, route/Setting ID 6.
Native API PUT returned 200 and GET confirmed changed custom text/date/datetime
values with sibling fields unchanged, but no Change row was captured. This is
an implementation failure, not proof of custom-asset capture support. Native
Computer/Monitor and the tested Fields values/separate immediate native row
have independently reported success; full operator evidence is still pending.
The builder is diagnosing the custom registry/hook/canonical class/change
path. No unfinished fix was reviewed and the failed case has not been rerun.
Retain the initial failure separately from its eventual targeted fix/retest.

OC09 targeted source fix reviewed: `register_capture` now supplements the
pre-custom-boot asset registry with exact class-name strings derived from
active AssetDefinition rows, using the installed getFromResultSet and
getCustomObjectClassName APIs without early custom-class autoloading. The
complete list also filters Fields container hook registrations. Installed
11.0.7 listener priorities confirm InitializePlugins 110 runs before
CustomObjectsBoot 100, explaining the missing initial custom hooks. No
additional finding in this changed registration function; the focused OC09
runtime retry is approved. Preserve initial FAIL and record retest separately;
source approval alone does not turn OC09 into PASS.

### Senior 2(a) initial OC15 custom readonly admission failure

Final OC15 readback found a separate GLPI custom-asset readonly gate failure:
custom field definition 2 was saved/read back with `readonly:[14]`, then the
restricted Setting POST unexpectedly returned 201 and created Setting 8,
route `outbound-a-20261024-reject-custom-readonly`. This concerns GLPI custom
asset field options, distinct from the separately tested Fields-plugin 1.24.4
custom fields. Do not infer custom readonly enforcement from those Fields
passes or prior source approval.

The operator restored definition options to `[]` and is disabling Setting 8
through a higher-version normal PUT/readback; main OC routes 6/7 were already
confirmed disabled. The builder is investigating effective getOptionValues
handling. No unfinished fix was reviewed and no failed-case retry occurred.
Preserve this initial FAIL separately from eventual fix/retest evidence.

OC15 targeted source fix reviewed: `custom_options` now rejects effective
boolean true readonly/hidden restrictions as returned by installed GLPI
getOptionValues, and raw profile arrays containing the current profile or
all-profiles marker `-1`; effective false remains allowed. This addresses the
confirmed initial failure, where only arrays were checked and true passed.
No additional finding in this changed function. Selective current-profile,
all-profile and permitted-false runtime retries are approved; previously
passed Fields checks are not rerun. Setting 8 was confirmed disabled at
version 5 and associated sessions closed; retain initial failure separately
from pending retest results. No runtime PASS is inferred from this source fix.


### Senior 2(a) completed independent runtime evidence review

The independent reviewer inspected the complete operator report, all 62 curl
request/response records and all 23 local native-method invocation scripts and
outputs (compacting repeated data for reading). The full redacted ledger is
preserved verbatim in [outbound-a-runtime.md](outbound-a-runtime.md); its
opening READY reflects the operator's status before this independent review.
No runtime call or source check was replayed by the reviewer. Evidence review
passes for the observed OC cases after the two approved selective fixes.

Keep both original failures visible: OC09's initial custom virtual save returned
200 and persisted values without capture; the registry fix was then verified
by curl 41/44 and exact snapshots 12/13. OC15's restricted custom mapping was
initially accepted as Setting 8; the effective boolean/profile restriction fix
was then verified by current-profile/all-profile rejection 58/59 and allowed
false control 60/61. The missing initial custom event was not retroactively
fabricated. Custom date-only capture after the registration fix was not
independently exercised; Fields date/datetime capture was exercised.

Representative coverage includes Computer/Monitor plus one registered GLPI
custom asset and a separate Fields 1.24.4 container with eight scalar/dropdown
kinds. This is not an exhaustive “all asset types/all fields” certification.
The combined UI save yielded immediate separate Fields/native snapshots 4/5;
standalone/Fields-only/first generated storage saves yielded 6/7/8. Original
+08:00 times stayed on immutable rows, including distinct same-second edits.
Native guard nesting/finally passed; Fields/custom guarded runtime variants
remain source evidence. Presave malformed date and later readonly metadata
rejected with actual saved values unchanged. No approved safe post-save
queue/reread failure hook existed, so that uncertainty injection is NOT RUN.
Active/Suspended/competing verified link behavior is NOT RUN until the worker
provides trusted completion evidence; no fake links or raw DML were used.

The exact-ID helper's formerly deferred real-row proof now passes: local 11
marked only genuine snapshot 1 Done and preserved its payload/times; snapshot
2 remained unchanged Pending. Final curl 51 shows Change 1 Done and 2–13
Pending. This local helper proof does not certify external acknowledgements,
correction coverage or partial-row completion. Broad unsupported/hidden/
plugin-unavailable/permission variants not actually exercised remain NOT RUN.

Containment is confirmed by later readbacks: Setting 6 disabled/version 6,
Setting 7 disabled/version 2, initially unexpected Setting 8 disabled/version 5,
and allowed false-control Setting 9 disabled/version 1. Curl 55 supersedes the
older enabled Setting 8 shown in curl 50. Custom fixture options were restored
to []; new Fields associations were restricted to service profile 14, and
only explicit fixture profile rights were added. All API sessions were closed.
Admission Work 1–22 were not changed and no processor/cron ran. No deletion,
purge, uninstall, raw DML, automatic cleanup or automated regression harness
was run. Native local fixture bootstrap/parse/helper-name operator errors
occurred before their intended mutations and are preserved, not hidden.

| Completed part | Source result | Runtime result | Remaining scope |
|---|---|---|---|
| Senior 2(a), outbound capture and capability gate | Complete candidate and targeted P1/P2/OC09/OC15 fixes reviewed | PASS for observed cases; 62 curl + 23 local invocations preserved, including initial FAIL then selective PASS | Explicit NOT RUN variants above; external ack, worker/control/correction/full flow pending |
| Senior 1(b), existing-asset worker | Source approved after transaction/finally fixes; shared dependency now reviewed | NOT RUN | First focused IB pass can begin after integration; no runtime completion claimed |
