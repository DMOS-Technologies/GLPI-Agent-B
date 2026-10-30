# Optional A→B participation flags

Minimum Agent B version: **0.5.0**, with its additive upgrade. This is a local
implementation candidate; the authorized
[PF runtime ledger](manual-tests.md#optional-participation-flags-local-runtime-verification--29-october-2026)
records actual checks, failures/corrections and remaining gaps. Controller A support is
not implemented or certified by this repository. This extends the existing
native REST API V1 Setting/Work resources; it adds no endpoint, mode or right.

## Configuration and identity

Optional A-owned Setting `participation_flags_json` is a JSON-text array. Create
omission defaults to `[]`; replacement omission preserves the stored selection.
An explicit `[]` disables all flags; removing one itemtype group disables that
type. Disabling/removing a selection never writes No or alters old Works.
Groups must be a subset of `enabled_itemtypes_json`; disabling a parent type
requires removing its group in that same publication. A disabled route may
retain a valid selection but cannot process a participating request.
Null, malformed JSON and unknown object keys are rejected. Each enabled parent
itemtype has at most one group and exactly two targets:

```json
[
  {
    "itemtype":"Computer",
    "targets":[
      {"target_id":"service_marker","b_field":{"kind":"fields","container":"assetdetails","name":"serviceflag"},"definition":{"fields_container_id":17,"fields_field_id":92}},
      {"target_id":"asset_marker","b_field":{"kind":"fields","container":"assetdetails","name":"assetflag"},"definition":{"fields_container_id":17,"fields_field_id":93}}
    ]
  }
]
```

Names/IDs above are illustrative discovery results. Customer labels are never
selectors or special code paths. `target_id` matches `[a-z][a-z0-9_]{0,63}` and
is unique within its group. `b_field` uses the existing native/Fields selector
schema. `definition` is an exact object with positive integer identifiers:

- Ordinary native field: `{}`.
- Native GLPI custom field: `custom_field_definition_id`.
- Fields field: `fields_container_id` and `fields_field_id`.
- Every field on a GLPI custom asset parent also requires `asset_definition_id`.

Definitions must match the actual applicable boolean storage. Text values,
dropdown labels, multiple fields, generated/scope/lifecycle fields and unsupported
storage are rejected. No fuzzy label matching or implicit rebind after recreation.
Two selectors resolving to the same storage are duplicates. Any selected target
overlapping an **enabled** ordinary B scalar mapping is rejected, regardless of
A/B/Both authority. Admission compares concrete logical storage. Runtime rechecks
canonical case-normalized selectors, exact Setting version and pinned actual
target definitions/stored keys; it does not resolve excluded mapping descriptors
or read their values. Supported selectors cannot silently rebind an alias to a
different pinned target. Flags are separate from
ordinary mappings and require no A counterpart or synthetic A values.

Publication uses the existing full Setting replacement and strictly increasing
`settings_version`. An enabled nonempty configuration is returned as its exact
stored JSON text by native Setting GET. Disabled `[]`/legacy null is omitted
from native responses to preserve disabled-client row shapes: A compares absence
as the documented disabled state `[]`, together with exact current version and
existing Setting contents. No search option is added for this configuration.

Example native call (normal App-Token and Session-Token headers):

```http
PUT /api.php/v1/PluginAgentbdmosassetsyncSetting/42
Content-Type: application/json
App-Token: <application-token>
Session-Token: <session-token>

{"input":{"id":42,"a_entities_id":18,"entities_id":19,"route_enabled":1,"settings_version":7,"enabled_itemtypes_json":"[\"Computer\"]","field_mappings_json":"[]","participation_flags_json":"[{\"itemtype\":\"Computer\",\"targets\":[{\"target_id\":\"service_marker\",\"b_field\":{\"kind\":\"fields\",\"container\":\"assetdetails\",\"name\":\"serviceflag\"},\"definition\":{\"fields_container_id\":17,\"fields_field_id\":92}},{\"target_id\":\"asset_marker\",\"b_field\":{\"kind\":\"fields\",\"container\":\"assetdetails\",\"name\":\"assetflag\"},\"definition\":{\"fields_container_id\":17,\"fields_field_id\":93}}]}]"}}
```

Native V1 success/error envelopes remain those in API section 3; POST/PUT
acceptance is never proof of asset participation. GET the Setting and compare
the exact version/configuration before submitting a Work. No auto-upgrade or
schema migration runs in a REST request.

Invalid participation configuration uses the existing validation mechanism:
`ASB_INVALID_FIELD: field=participation_flags_json`. Invalid/unavailable Work
opt-in uses `ASB_INVALID_FIELD: field=participation_json`. These are GLPI native
add/update error envelopes, not custom HTTP responses; existing stale-version,
immutable/B-owned-field and permission errors keep their normal conventions.

## Explicit request and trigger

Optional immutable A-owned Work `participation_json` is either omitted/null
(disabled for that Work) or JSON text exactly `{"version":1}`. Unknown keys,
other versions, non-Asset subjects and operations other than Sync are rejected.
Opt-in requires current configuration for that route/itemtype and exact current
Setting version. The request field and B-owned `participation_state_json` journal
are hidden from native raw responses/search, like `field_sync_json`; public
progress is in `result_json.participation` only for opted-in Works.

A supplies this opt-in **only for actual A→B Asset Sync**, never for polling or
a Sync used solely to collect B values. The existing Work schema has no direction
discriminator; without this opt-in B cannot infer the purpose from HTTP origin
or field authority. This is a feature option, not another Work mode. Configuration
alone does not opt existing clients or requests into the new result shape.

```http
POST /api.php/v1/PluginAgentbdmosassetsyncWork
Content-Type: application/json
App-Token: <application-token>
Session-Token: <session-token>

{"input":{"work_id":"participation-example-0001","route_id":"example-route","a_entities_id":18,"entities_id":19,"itemtype":"Computer","settings_version":7,"identity_json":"{\"a_items_id\":401,\"b_items_id\":501,\"serial\":\"EXAMPLE-SERIAL\"}","a_values_json":"{}","a_change_times_json":"{}","field_sync_json":"{\"version\":1,\"mapping_ids\":[]}","participation_json":"{\"version\":1}"}}
```

The example is a distinct current marker catch-up on an already verified Active
link; the existing field-selection eligibility rules still apply. First-copy
uses its ordinary legacy Asset Sync path with this optional participation key,
not v1/v2 creation or synthetic fields.

Participation becomes eligible only after ordinary Asset processing establishes
a verified permitted current parent/link, route/type/entity/Setting scope and
durable ordinary completion receipt. AlreadyEqual and independent ordinary field
rejections can qualify. Parent/account/route failure, unverified first-copy or
uncertain ordinary transaction completion cannot qualify. Eligible does not mean
all scalar fields synchronized or any Change is fully handled.

Legacy scalar results do not encode sufficient certainty for Held/Failed writes:
only ordinary legacy Done qualifies. Opted-in scalar v1/v2 can also qualify after
known independent rejections/conflicts or incomplete snapshot coverage when their
journal proves no Unknown/in-flight write and no parent/account/Setting failure.
Legacy Held/Failed can use a distinct current v1 empty-selection request after
safe accounting; B never infers no-write certainty from those statuses or prose.

An Active indexed association alone is not sufficient. B also checks its earliest
scoped positive association: a completed Done original null-B-identity request
must establish verified creation or adoption with matching result/parent IDs.
A later positive-linked Work cannot certify an earlier Accepted/Held/Failed
origin merely by reaching Done. Historical adoption that might have been safe
but lacks this completed origin receipt is conservatively ineligible
(`PARENT_SCOPE`); this extension does not rewrite that history or invent a repair
endpoint. A successful current original first-copy/adoption can establish its
own verified origin through its independently completed ordinary receipt.

The worker finalizes the ordinary receipt first, including first-copy's independent
final-Done verification. It then processes flags separately during that same
initial invocation, rechecking current authorization and scope. The ordinary
Work status/completion and ordinary result members are never rewritten to recover
a flag. Native Work Done therefore describes ordinary processing; A also reads
the separate participation target outcomes. A terminal Work may temporarily have
pending marker progress if its initial worker has not completed this phase.

No opt-in means no flag reads/writes/result extension. B→A Changes, reads, ACKs,
Setting publication, Notes/Inventory and Suspend/Resume never trigger flags.

## Independent outcomes and durability

The opted-in result adds exactly this member (two target entries in configured
order; nullable safe reason/error code):

```json
{
  "participation":{
    "version":1,
    "eligible":true,
    "error_code":null,
    "reason":null,
    "targets":[
      {"target_id":"service_marker","outcome":"SetToYes","certainty":"VerifiedApplied","error_code":null,"reason":null},
      {"target_id":"asset_marker","outcome":"AlreadyYes","certainty":"VerifiedEqual","error_code":null,"reason":null}
    ]
  }
}
```

| Outcome | Certainty | Meaning |
|---|---|---|
| Pending | NotAttempted | No native flag writer has been entered; processing may not have reached this target. |
| Rejected | NotAttempted | Validation/permission/scope/storage rejected this target before a native flag write. |
| AlreadyYes | VerifiedEqual | Locked native reread found Yes; no update. |
| SetToYes | VerifiedApplied | Native save and reread verified Yes with durable completion evidence. |
| Unknown | Unknown | A durable intention precedes possible mutation; verified completion is unavailable. |

Stable group/target error codes (null on success/Pending):

| Code | Meaning |
|---|---|
| NOT_ELIGIBLE | Ordinary processing did not establish eligible verified participation. |
| ACCOUNT_DENIED | Current submitting account/profile authorization is unavailable. |
| ROUTE_BUSY | The route lock was positively busy before this target's native write; no permission denial is inferred. |
| SETTING_SCOPE | Current route/type/entity configuration/version no longer authorizes this request. |
| PARENT_SCOPE | The verified parent/link/entity relationship is unavailable or changed. |
| TARGET_UNAVAILABLE | Selector/type/definition pin is unavailable, changed or overlaps an enabled mapping. |
| TARGET_PERMISSION | Actual target/container/generated-row write permission or native enforced readonly denies the operation. |
| STORAGE_UNSUPPORTED | Safe supported transactional selected-target storage/validation is unavailable, including unsatisfied required siblings during new Fields-row creation. |
| WRITE_UNCERTAIN | Durable intention exists; completion of a possible native mutation is not established. |
| VERIFY_UNCERTAIN | An attempted save could not be verified as the intended Yes value. |
| JOURNAL_UNCERTAIN | Target completion evidence could not be confirmed durably. |
| COMMIT_UNCERTAIN | A transaction completion could not be confirmed. |
| INTERRUPTED | Processing stopped without a confirmed terminal target receipt. |

Codes describe the boundary B can establish, not causes inferred from English
exceptions. Anything after a possible native mutation remains Unknown unless
verified durable evidence establishes completion.
If the connection cannot safely persist a more specific cause, readback retains
the earlier durable `WRITE_UNCERTAIN` intention. A must not infer the precise
internal failure stage from the absence of a more specific error code.

Before eligibility, `eligible:false` means not yet established or rejected; use
the Work state plus safe group `error_code`/`reason` to distinguish those cases.
The admission journal snapshots the exact configuration. Before any possible
flag mutation, its target is durably Unknown; absence of completion cannot later
become NotAttempted. Native writes, reread and target receipts share a checked
transaction where source-supported; independent observation rejects leaked
nested transactions. Commit/rollback/persistence/lock uncertainty stops further
mutations and retains the durable unknown evidence.

A narrowly constrained B-only metadata operation may advance **only** the
participation journal/result subtree during the initial flag phase after ordinary
completion. It cannot change request fields, ordinary outcomes/status, link,
completed timestamp, scalar evidence or acknowledged IDs. Old terminal Works
are never selected again to recover flags. An interrupted Pending/Unknown receipt
remains on its original Work; A reads it before issuing a distinct request.

For each target, actual parent/container/generated-storage permissions and live
definition identity are checked. Writes use native GLPI methods, locking, sync
guards and selected-field input. Already Yes is a no-op. Flags never supply a
genuine edit timestamp or write scalar provenance. A known rejection of one
target does not prevent the other or roll back ordinary field progress.

Fields 1.24.4 Yes/No form readonly metadata is not native write authorization:
its public validation skips Yes/No values. The marker-only path can ignore that
form restriction while enforcing actual parent/container/generated-row UPDATE
rights. Core GLPI custom-profile readonly is enforced in native preparation and
remains a denial. Ordinary scalar readonly policy is unchanged.

If a Fields row exists, use the existing selected-field native update, never a
merged resubmission of stored siblings. If absent, lock its native unique
itemtype/parent/container key under repeatable-read/serializable isolation and
use generated native `add()` under explicit `can(-1, CREATE, input)` plus actual
parent UPDATE/container rights. Input is only parent/type/container/entity
metadata and the selected Yes value; native defaults apply. Full native Fields
validation (not partial massive-action validation) must succeed, including all
mandatory sibling requirements. Missing required sibling input is a visible
prewrite rejection; do not invent it or bypass validation. Require a positive
native row ID, exact typed/scoped storage reread and Yes verification before
receipt completion. Native History and the target receipt share the checked
transaction. No ordinary mapping/A value is needed for a marker-only container.
Native defaults here mean SQL initial values, not the form's configured default
values. A new row may initially have the other boolean at its native default
until that target is processed; no existing stored value is reset. Live-status
mandatory requirements are checked in addition to native full validation,
because Fields tab validation does not load the actual parent's status.
Other native hooks may affect siblings; this is not a universal side-effect
isolation guarantee.

Source basis is GLPI 11.0.7 `Glpi\Asset\Asset::prepareInputForUpdate()` /
`handleReadonlyFieldUpdate()` and Fields 1.24.4
`PluginFieldsContainer::validateValues()`, generated `AbstractContainerInstance`
permissions and native update/history methods. This is source evidence, not a
runtime permission or History pass for the new marker path.

## Failure, changes and catch-up

- Pending/Rejected targets may be caught up by a **new** current A→B opted-in
  Sync after repair, with a verified Active link and empty explicit scalar
  selection if no scalar work is needed. Never replay the old ordinary writes.
- Unknown requires reading the original Work and live native target first. A new
  request rechecks fresh locked actual state before possible mutation: Yes yields
  AlreadyYes; No permits a new Yes attempt under the new Work. This establishes
  current desired state, never rewrites the old uncertain outcome.
- The existing global worker lock and route/parent/storage locks serialize a
  fresh catch-up behind an initial worker still finishing its marker phase.
  Ordinary Work Done alone does not prove that phase has stopped. Do not bypass
  the worker/locks by writing these targets directly through A.
- Stale Setting, removed/replaced targets, changed definitions or lost scope
  cannot authorize writes against the old target. A publishes a newer validated
  selection and submits a fresh current Work if appropriate; no automatic rebind.
- Flag failures stay visible in `participation` safe machine errors/reasons;
  English text is not certainty evidence. No credentials/raw diagnostics enter
  the result. Participation does not complete a mixed Change snapshot. Existing
  exact whole-snapshot/external exact-ID acknowledgement rules are unchanged.
- Flags never automatically become No, including after mapping/type/route
  disable, uninstall, Suspend/Resume or removal from the selection.

## Controller A integration and discovery

A must first verify deployed B>=0.5.0 plus additive upgrade and implement this
contract. It must not assume its present client supports it. Present the full
**discovered** B-native/core-custom/Fields catalog with label, stored key,
itemtype, plugin/container context and concrete definition IDs. Search all that
metadata; distinguish duplicate labels. Mark nonboolean/unsupported/unreadable
entries incompatible. Do not use ordinary mapped fields as the catalog.

Use native `listSearchOptions/<itemtype>` plus permitted native definition
resources (`Glpi\Asset\AssetDefinition`, `Glpi\Asset\CustomFieldDefinition`,
`PluginFieldsContainer`, `PluginFieldsField`) as applicable. Search
options alone do not expose every writable field or pin custom definition
identity. Metadata resources need their own native read permissions; A must
report unavailable discovery rather than invent selectors or ask B to enable
capabilities. B admission/runtime validation is authoritative for applicability
and actual writes. There is no new B discovery endpoint.

For namespaced native resources use the actual PHP itemtype in one URL segment
(backslashes encoded as `%5C`), for example
`/api.php/v1/Glpi%5CAsset%5CCustomFieldDefinition`. The GLPI V1 resolver accepts
CommonDBTM class names; acceptance of encoded backslashes by the actual HTTP
server was verified in the authorized localhost GLPI 11.0.7 PF run for the
fixture custom asset/definition resources. This does not certify another HTTP
server or GLPI patch. The fixture service profile had explicit native definition
READ permissions; ordinary asset rights alone do not imply metadata access.
The local normal service profile used `config=READ` for those definition reads,
plus its routed asset and Fields-container rights; it was not Super-Admin.
Search-option IDs are discovery data, not fixed universal
field IDs. API credentials must have the applicable metadata-resource read
permissions, and A must show discovery failure rather than claim a complete list.

A publishes/readbacks exact selection/version, opts in only actual A→B Sync,
then shows ordinary completion separately from eligibility and each target's
certainty/error. A records failures in its Sync problems UI, retains original
correlation and uses new current requests for catch-up. Controller A code/UI,
scheduling and its integration verification are outside this implementation.

## Upgrade and verification boundary

Additive storage: nullable Setting `participation_flags_json`; nullable immutable
Work `participation_json`; hidden B-owned Work `participation_state_json`. Legacy
rows are null/disabled, without history backfill or existing request rewrites.
Public resources/rights remain Setting READ/CREATE/UPDATE, Work READ/CREATE,
Change READ/UPDATE; never DELETE/PURGE. Upgrade through native administrator
plugin upgrade; never reinstall to obtain columns.

The current ledger in `docs/manual-tests.md` distinguishes executed manual cases
from remaining unrun variants and localhost results from isolated clone faults.
Source inspection/syntax checks cannot certify
permissions, History, hooks, restart recovery or Controller A integration.
