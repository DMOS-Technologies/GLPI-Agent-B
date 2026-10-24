# Agent-B-DMOS-AssetSync: GLPI B API contract

**Target:** GLPI 11, built-in REST API **V1** (the legacy, low-level API).
**Scope:** B only. A initiates every request. No custom routes, authentication,
HTTP responses, or outbound calls from B. This file describes the records that
B must implement; there is no plugin implementation yet.

## Contract status and sources

The confirmed requirements below come from [the B spec](../spec-b-agent.md),
[the A-starts flowchart](asset-sync-starts-in-glpi-a.png), and
[the B-starts flowchart](asset-sync-starts-in-glpi-b.png). The requested
`docs/spec-b-agent.md` is absent; the root `spec-b-agent.md` was read instead.

The user selected GLPI 11, the display name, and the deployment name below.
Column names and wire schemas are defined by this contract. Decisions that the
spec leaves open are explicitly marked **proposed** and collected in section 7.
They are not silently treated as approved. This document is ready for contract
review; A and B must resolve the blocking questions before implementing the
affected behavior. No live GLPI instance was supplied or called.

GLPI protocol details were researched against the official **11.0.0 tag**,
not inferred from the older guide. The installed 11.x patch is still a question.
The relevant sources are linked beside the protocol sections. The normative
rules for this plugin are the schemas and validation rules in this document;
examples use illustrative IDs and values.

## 1. Names, storage, and record ownership (deliverable 1)

### 1.1 Plugin identity

| Name | Exact value |
|---|---|
| Display name | `Agent-B-DMOS-AssetSync` |
| Repository directory, retained | `/Users/kiran/Documents/DMOS/GLPI-Agent-B` |
| Installed GLPI plugin directory/key, approved by user | `agentbdmosassetsync` |
| Deployment location | `<GLPI_ROOT>/plugins/agentbdmosassetsync/` |
| Class convention | GLPI legacy global classes, prefix `PluginAgentbdmosassetsync` |
| PHP namespace | Global namespace; no PHP `namespace` declaration for these classes |
| Setting class / REST itemtype | `PluginAgentbdmosassetsyncSetting` |
| Work class / REST itemtype | `PluginAgentbdmosassetsyncWork` |
| Change class / REST itemtype | `PluginAgentbdmosassetsyncChange` |
| Setting table | `glpi_plugin_agentbdmosassetsync_settings` |
| Work table | `glpi_plugin_agentbdmosassetsync_works` |
| Change table | `glpi_plugin_agentbdmosassetsync_changes` |

The repository folder is not the deployment folder. GLPI allows only
alphanumeric characters in the installed plugin directory name; the user
approved `agentbdmosassetsync` after this constraint was explained. The global
class convention avoids a namespaced itemtype and backslash encoding in REST
URLs. These are three record classes, not per-asset-type classes. Each must
inherit GLPI's `CommonDBTM` so the V1 resource resolver can expose it.
[GLPI plugin directory rules](https://glpi-developer-documentation.readthedocs.io/en/latest/plugins/guidelines.html),
[GLPI 11 V1 resource resolver, `APIRest::getItemtype()`](https://github.com/glpi-project/glpi/blob/11.0.0/src/Glpi/Api/APIRest.php),
[GLPI table-name derivation, `DbUtils::getExpectedTableNameForClass()`](https://github.com/glpi-project/glpi/blob/11.0.0/src/DbUtils.php).

### 1.2 Types and wire representation

- `ID`: SQL `INT UNSIGNED`; JSON integer, positive except an entity ID may be
  `0` (the GLPI root entity). A must not confuse A's IDs with B's IDs.
- `VERSION`: SQL `INT UNSIGNED`; JSON integer, at least `1`.
- `KEY128`: SQL `VARCHAR(128)` with ASCII, case-sensitive/binary comparison;
  JSON string matching `[A-Za-z0-9][A-Za-z0-9.-]{0,127}`. Used for A's opaque
  work and route IDs. No `%`, `^`, `$`, spaces, or backslashes. Work IDs are
  unique across this B installation, not just within a route.
- `ITEMTYPE`: SQL `VARCHAR(255)`; JSON nonempty string containing the actual
  GLPI itemtype, such as `Computer`. It is never an integer type code.
- `JSON_TEXT`: SQL `LONGTEXT` containing valid UTF-8 JSON. **On the REST wire it
  is a JSON string**, not a nested object. A encodes the inner value once, then
  its HTTP JSON encoder escapes the containing string. GET returns that string;
  A decodes it separately. This avoids assuming automatic JSON decoding by
  GLPI V1 or the database. `null` in a nullable column is outer JSON `null`.
- `TIME`: SQL `DATETIME`, B-owned metadata, shown as `YYYY-MM-DD HH:MM:SS`.
  **Proposed UTC** storage. Genuine field times inside JSON use RFC 3339 UTC
  strings with seconds, e.g. `2026-10-24T04:00:00Z`, or explicit `null`.
  Precision and clock trust require Q3. Metadata times are never evidence of
  a genuine field edit.
- `TEXT`: SQL `TEXT`, JSON string; nullable where stated.
- Boolean settings use SQL `TINYINT UNSIGNED`, JSON integer `0` or `1`.

Field ownership applies to values supplied by A, even when the supplied value
matches the saved value. Supplying a B-owned field is an error, not a request
for B to ignore it. For updates, `id` only selects the row; A never changes it.
GLPI's own internal bookkeeping is not an A-writable record field.

**Proposed setting scope (Q1): one Setting row per immutable `route_id`, with a
version counter per route.** This makes entity restrictions explicit using
GLPI's ordinary `entities_id` column. No separate `b_entities_id` column exists:
`entities_id` is always the destination B entity. A's entity is
`a_entities_id`. Both field names are used consistently in all three types.

### 1.3 Setting fields

B persists A's settings but must never revise their content itself. No status,
result, error, B-managed timestamp, delete marker, or archive marker is defined
on Setting.

| Field | SQL / REST type | Required/default | Who may supply/change it |
|---|---|---|---|
| `id` | `ID` | Generated on create; required as update selector | B/GLPI generates; A may address it on PUT only |
| `route_id` | `KEY128` | Required; unique | A on create; immutable afterward |
| `a_entities_id` | `ID`, allowing `0` | Required | A on create/update, subject to Q2 |
| `entities_id` | `ID`, allowing `0` | Required; B entity | A on create/update, subject to Q2 and entity rights |
| `route_enabled` | `TINYINT UNSIGNED` / integer `0` or `1` | Required | A |
| `settings_version` | `VERSION` | Required | A; strictly increases, proposed Q4 |
| `enabled_itemtypes_json` | `JSON_TEXT`, inner array of unique `ITEMTYPE` strings | Required; `[]` permits disabling all types | A |
| `field_mappings_json` | `JSON_TEXT`, inner array of mapping objects | Required; `[]` permits no mappings | A |

A mapping object has exactly these properties (selectors are contract data,
not GLPI API routes):

| Property | Inner JSON type | Meaning |
|---|---|---|
| `mapping_id` | string, `[a-z][a-z0-9_]{0,63}` | Stable identifier, unique within this route/version; used in all values/results |
| `itemtype` | `ITEMTYPE` string | Asset type to which this mapping applies |
| `enabled` | boolean | Whether this mapping participates |
| `a_field` | field-selector object | Source field in A |
| `b_field` | field-selector object | Destination field in B |
| `source` | string enum `A`, `B`, `Both` | Existing-asset ownership rule |
| `value_mode` | string enum `direct`, `dropdown_label_to_text`, `text_to_dropdown`, `dropdown_label_to_dropdown` | A-to-B value interpretation; see below for reverse application |

Field-selector objects:

- Native: `{"kind":"native","name":"name"}`. `name` is the actual field,
  not a numeric search-option ID.
- Fields plugin, **proposed selector requiring Q7**:
  `{"kind":"fields","container":"assetextra","name":"customcode"}`.
  Both strings identify configured Fields-plugin metadata; their exact
  correspondence to that plugin's installed version must be confirmed.

`direct` carries a native scalar value (string, number, boolean, or null),
subject to the destination field's supported type. `dropdown_label_to_text`
carries the readable option label as a string, never the source option ID
converted to text. `text_to_dropdown` carries source text that B resolves to
one permitted destination option. `dropdown_label_to_dropdown` also carries
the source label; B resolves its own option ID locally. A never supplies a
foreign dropdown ID as though it were a B ID. No option is created
automatically. Ambiguous/missing matches produce a visible field reason.
Supported field kinds and selectors require Q7; a search option alone is not
proof that a field is writable.

The user explicitly requires text-to-dropdown lookup as well as the spec's
dropdown-to-text and dropdown-to-dropdown conversions. These are required
contract capabilities, not reasons to call a field unsupported. Their
implementation is still pending, as is all plugin code.

### Field support and conversion boundary

| Source -> destination | Required behavior | `value_mode` for A -> B |
|---|---|---|
| Text -> text | Save the text subject to the destination's validation and length | `direct` |
| Dropdown -> text | Resolve the source option to its readable label; save that string | `dropdown_label_to_text` |
| Text -> dropdown | Look up the text in the destination field's own option set; save the uniquely matched local ID | `text_to_dropdown` |
| Dropdown -> dropdown | Resolve the source label, then look up the destination's own option ID | `dropdown_label_to_dropdown` |
| Compatible number, Yes/No, date, or datetime -> same field kind | Preserve the typed value and validate the supported field kind; datetime follows the agreed time policy | `direct` |

For example, source dropdown ID `17` with label `Dell` becomes text `Dell`.
Source text `Dell` mapped to a destination Manufacturer dropdown becomes that
destination's ID, for example `83`. These IDs are illustrative and unrelated.

Resolve destination options locally, within the destination field's actual
option type, entity applicability, and service-account permissions. Require
one unambiguous match. Zero matches or several matches means no write to that
field, a visible reason, and no acknowledgement of the affected snapshot as
fully handled. Never choose the first result, copy a remote ID, silently
truncate text, or fall back to an empty/default option. Label language,
case/whitespace matching, hierarchical paths, and null/empty handling remain
explicit Q7 decisions. A hierarchical or duplicate label needs enough agreed
context to identify one option.

The conversion describes A -> B. If field source `B` or `Both` makes B's
value the winner, the side saving the result must apply the conversion for
the reverse direction. For example, an A-dropdown/B-text mapping requires
text-to-dropdown lookup when returning B's winning text to A. B returns a
readable value; A resolves its own option ID locally. Conversion never changes
the A/B/Both ownership rule, and comparisons must not compare unrelated
dropdown IDs from the two installations.

The following classification replaces an unspecified blanket list of
"unsupported fields". It is a sync-contract restriction, not a claim that
GLPI itself cannot write these fields:

| Classification | Fields or conditions | Treatment |
|---|---|---|
| Generated identity and bookkeeping | Asset `id`, `date_creation`, `date_mod`, and equivalent generated technical fields where present | May be read as evidence where appropriate; never ordinary mapped write targets. GLPI maintains its own values. |
| Entity/scope control | Asset `entities_id` and equivalent scope-control fields | Set the B entity from the route during first copy only. Never use a field mapping to transfer an existing asset. |
| Destructive/lifecycle operations | Deletion markers such as `is_deleted`, or any field write that deletes, archives, or clears an asset | Prohibited by the spec; not an ordinary field conversion. |
| Calculated, aggregate, or presentation-only values | Counts, joined search results without a verified writable target, display headers | Not direct mapped write targets. A Fields Header has no asset value to sync. |
| Unavailable or unwritable target | Field absent on this type; required plugin/container unavailable; field read-only; service account cannot write it | Report the exact condition. This does not make the whole field kind unsupported. |
| Complex value format not yet defined in this contract | Multi-selects, lists of linked users/groups, relationship collections, files/documents, or nested values requiring more than a scalar | Require an explicit payload, identity resolution, and verified local save behavior under Q7 before enabling. Do not flatten to arbitrary text or call all references ordinary dropdowns. |
| Invalid value for a supported conversion | Destination option missing/ambiguous, invalid number/date, text exceeding destination limits | Visible per-field validation/conversion failure; leave the target unchanged. |
| Unmapped or disabled field | No enabled mapping for this route/type | Leave unchanged; this is excluded by configuration, not an unsupported field. |

Ordinary asset dropdown fields must not be confused with plugin bookkeeping.
For example, an asset's Status dropdown is a business field subject to its
mapping and permitted operation; Work `status` is B-owned processing state.
Native and Fields-plugin values both need explicit field-kind support.
Fields also defines container rights, read-only fields, and presentation
headers, so a displayed field is not automatically a writable scalar.
[Fields field kinds and permissions](https://glpi-plugins.readthedocs.io/en/latest/fields/index.html),
[GLPI search options describe displayed/queryable columns](https://glpi-developer-documentation.readthedocs.io/en/latest/devapi/search.html).

An exhaustive installed-field list cannot be inferred from the three plugin
record schemas. It requires the actual asset types, GLPI patch, installed
plugins, field definitions, and permissions. No such live inventory has been
supplied. Q8 concerns what happens when individual fields cannot complete;
contract Q11 concerns durable links and per-asset suspension/resumption, not
a second list of unsupported field types. Spec section 11 question 11, by
contrast, concerns a mapping naming an absent field.

Settings must explicitly describe mapping direction. There is no per-field
settings GET and no remote lookup by B.

### 1.4 Work fields

| Field | SQL / REST type | Required/default | Who may supply/change it |
|---|---|---|---|
| `id` | `ID` | Generated | B/GLPI only |
| `work_id` | `KEY128` | Required; unique, immutable | A at creation only |
| `route_id` | `KEY128` | Required | A at creation only |
| `a_entities_id` | `ID`, allowing `0` | Required | A at creation only |
| `entities_id` | `ID`, allowing `0` | Required; B entity | A at creation only |
| `itemtype` | `ITEMTYPE` | Required | A at creation only |
| `identity_json` | `JSON_TEXT`, identity object below | Required | A at creation only |
| `a_values_json` | `JSON_TEXT`, object from mapping ID to scalar/label | Required | A at creation only |
| `a_change_times_json` | `JSON_TEXT`, object from mapping ID to time-evidence object | Required; `{}` explicitly represents no supplied evidence | A at creation only |
| `settings_version` | `VERSION` | Required | A at creation only |
| `handled_change_ids_json` | `JSON_TEXT`, array of distinct positive B Change IDs | Optional; inner default `[]` | A at creation only |
| `status` | `VARCHAR(16)` / string enum below | B initializes `Accepted` | B only |
| `result_json` | nullable `JSON_TEXT`, result object below | Initially `null` | B only |
| `error` | nullable `TEXT` | Initially `null` | B only |
| `date_creation` | `TIME` | Set on acceptance | B/GLPI only |
| `date_mod` | `TIME` | Set on acceptance and B updates | B/GLPI only |
| `completed_at` | nullable `TIME` | Initially `null`; set only on `Done` | B only |

Identity object (no additional keys):

| Property | Inner JSON type | Rule |
|---|---|---|
| `a_items_id` | positive integer | Required on Work; A asset ID, never a B lookup ID |
| `b_items_id` | positive integer or `null` | Required key; non-null represents a confirmed existing link |
| `serial` | nonempty string or `null` | Required key; identifier only where the type actually has a usable serial |

A link claim must be checked against B's saved link evidence, itemtype, route,
and entity. An arbitrary integer from A is not proof of a confirmed link.
Durable link evidence and scope-stop signaling are unresolved in Q11.
For Change identities, `a_items_id` may also be `null` when no A link is known;
`b_items_id` must be positive.

A time-evidence object is exactly
`{"changed_at":"2026-10-24T04:00:00Z","reliable":true}`. `changed_at` may
be `null`; `reliable` is a boolean. Missing mapping entries mean missing
evidence. A whole-asset modification time or a sync-write time must never be
presented as a genuine field time. Missing/unreliable evidence is not grounds
to choose an arbitrary winner for `Both`.

#### Work status vocabulary and transitions

The four names come from the spec's proposed default; this contract supplies
the following meanings. Partial-field completion and retries need Q8/Q9.

| Stored string | Meaning |
|---|---|
| `Accepted` | Request saved, not proof of any asset write. Waiting or being handled by B's background task. |
| `Done` | B completed the permitted processing and reread/verified the local outcome. Read `result_json` for per-field results and any queue IDs still requiring A acknowledgement. |
| `Held` | B cannot safely proceed or finish: settings/scope mismatch, ambiguous identity, conflict, unavailable field evidence, or uncertain write outcome. Reason remains visible. Never blindly create/retry. |
| `Failed` | A definite processing failure, such as a denied local write or unsuccessful save/verification, is visible. A previous partial write is still possible; inspect the result. |

Only B may make `Accepted -> Done`, `Accepted -> Held`, or
`Accepted -> Failed`. No status transition is exposed to A. `Done` is final.
No automatic `Held/Failed -> Accepted` transition is authorized by this
contract while Q9 remains unanswered. A duplicate POST never reopens work.
A background task needs a durable concurrency/recovery rule (Q9); the absence
of a public `Processing` status does not permit two workers to apply it twice.

#### Work result object

`result_json` is `null` until B has evidence to report. When present, it has
exactly these properties:

| Property | Inner JSON type | Meaning |
|---|---|---|
| `b_items_id` | positive integer or `null` | Verified linked/existing B ID, if known |
| `created_b_items_id` | positive integer or `null` | New B asset ID only if first copy was confirmed |
| `b_values_for_a` | object from mapping ID to value/time object | B values A may apply under current field rules |
| `covered_change_ids` | array of positive B Change IDs | Exact Pending queue snapshots represented by returned B values; remain Pending until A saves and acknowledges |
| `handled_change_ids_done` | array of positive B Change IDs | Exact correction snapshots B successfully covered and marked Done |
| `field_outcomes` | array of field-outcome objects | Explicit result for every considered enabled mapping |

A value/time object is exactly
`{"value":"B's value","changed_at":"2026-10-24T03:50:00Z","reliable":true}`;
`value` follows the mapping's scalar/label type, and `changed_at` may be null.
A field-outcome object is exactly
`{"mapping_id":"asset_name","outcome":"AppliedToB","reason":null}`.
`reason` is null or a nonempty visible reason string. The complete outcome
vocabulary is:

| Outcome | Meaning |
|---|---|
| `AppliedToB` | B saved A's winning value and reread it successfully |
| `ReturnToA` | B's winning value is in `b_values_for_a`; B was unchanged |
| `AlreadyEqual` | No write needed; compared values already match |
| `Conflict` | `Both` values differ and a winner cannot be established; neither value changed |
| `Skipped` | Field absent/unsupported/not safely writable, or dropdown label unresolved; reason required |
| `Failed` | A definite field write or verification failed; reason required |

These are result labels, not additional Work statuses. Any verified partial
success must be reported honestly. An uncertain first-copy result must not
claim `created_b_items_id` is confirmed. Corrections may mark only fully
covered queue snapshots Done; no blanket acknowledgement of input IDs.

### 1.5 Change fields

The logical **queue ID is the GLPI row `id`**. There is no separate `queue_id`
column and no A-generated queue identifier.

| Field | SQL / REST type | Required/default | Who may supply/change it |
|---|---|---|---|
| `id` | `ID` | Generated; exact ID A acknowledges | B/GLPI generates; A uses as PUT selector only |
| `route_id` | `KEY128` | Required | B only |
| `settings_version` | `VERSION` | Required; version at genuine edit | B only |
| `a_entities_id` | `ID`, allowing `0` | Required | B only |
| `entities_id` | `ID`, allowing `0` | Required; B entity | B only |
| `itemtype` | `ITEMTYPE` | Required | B only |
| `identity_json` | `JSON_TEXT`, identity object above | Required | B only |
| `changed_fields_json` | `JSON_TEXT`, nonempty object from mapping ID to value/time object | Required | B only |
| `status` | `VARCHAR(16)` / string enum below | Initially `Pending` | B on create; A may change only `Pending -> Done`; B may do that after successful correction |
| `retry_count` | `INT UNSIGNED` / nonnegative integer | Initially `0` | B only; increment policy needs Q9 |
| `error` | nullable `TEXT` | Initially `null` | B only |
| `date_creation` | `TIME` | Set when queued | B/GLPI only |
| `date_mod` | `TIME` | Set on create/update | B/GLPI only |
| `done_at` | nullable `TIME` | Initially `null`; set when Done | B only, including after A's valid status update |

| Stored status string | Meaning |
|---|---|
| `Pending` | Genuine B edit awaiting A handling or a successful B correction; includes failures/conflicts still needing retry/review |
| `Done` | A acknowledged its completed local handling, or B successfully applied correction work covering this exact snapshot |

The only status transition is `Pending -> Done`. `Done -> Done` is rejected
under the literal spec rule; after a lost acknowledgement response A reads
back the IDs instead of assuming a repeat PUT is accepted. `Done -> Pending`
and every other value are forbidden. There is no `Failed` Change status:
failed/conflicted rows remain Pending with a reason.

**Proposed Q5:** one immutable snapshot per genuine asset save per route, with
all eligible changed fields and their original per-field times. A later edit
creates another row; B must not overwrite a row A may already have read.
Sync writes never create a Change row.

## 2. A service account profile rights (deliverable 2)

These are **plugin-defined rights**, to be registered and exposed by B's
future profile UI. The right keys below are contract identifiers; they are
not pre-existing GLPI core rights.

| Record type | Profile right key | Grant | Do not grant |
|---|---|---|---|
| Setting | `plugin_agentbdmosassetsync_setting` | `READ`, `CREATE`, `UPDATE` | `DELETE`, `PURGE` and other rights |
| Work | `plugin_agentbdmosassetsync_work` | `READ`, `CREATE` | `UPDATE`, `DELETE`, `PURGE` and other rights |
| Change | `plugin_agentbdmosassetsync_change` | `READ`, `UPDATE` | `CREATE`, `DELETE`, `PURGE` and other rights |

Use a standard-interface GLPI profile and assign it only to authorized routed
B entities. Recursion is an explicit administrator choice, not implicit
access to all entities. The three record classes must enforce entity scope
on both collection reads and individual reads/writes. Update permission on
Change does not permit editing B-owned fields; validation further restricts it.
[GLPI profile rights model](https://glpi-developer-documentation.readthedocs.io/en/latest/devapi/rights.html).

Plugin-record rights do not imply asset write rights. The spec also requires
B to respect the submitting service account's permissions when the background
task performs a local asset add/update. Do not grant Super-Admin to solve this.
The required asset read/create/update and dropdown/Fields permissions depend
on the enabled types/mappings, and the authorization context must be resolved
in Q10. No asset delete, purge, transfer, or archive rights are required for
this integration. There is no separate API-wide entitlement that replaces
profile and entity checks.

## 3. GLPI V1 transport and native response rules

### 3.1 Base URL and headers

Use the HTTPS URL displayed under GLPI 11's **Legacy API** settings. GLPI
11.0.0 advertises `https://b.example/glpi/api.php/v1`. Its legacy documentation
also uses `apirest.php`. This contract uses `/glpi/api.php/v1` as the exact
example base; replace `/glpi` with the configured installation prefix.
Do not use `/api.php/v2` or add a plugin HTTP route. If B's deployment exposes
only `apirest.php`, resolve Q13 and substitute that whole base consistently.
[GLPI 11 advertised versions, `Router::getAPIVersions()`](https://github.com/glpi-project/glpi/blob/11.0.0/src/Glpi/Api/HL/Router.php).

Every authenticated call below carries these headers, called **H**:

```http
Content-Type: application/json
Accept: application/json
App-Token: <B_API_CLIENT_APP_TOKEN>
Session-Token: <B_SERVICE_ACCOUNT_SESSION_TOKEN>
```

Login uses the headers shown in section 4.1 instead of H. A GET has **no
request body**, not even `{}`. Query parameters belong in the URL. Square
brackets and anchors in the examples are percent-encoded. Integer IDs in
URLs are B row IDs. `work_id` is A's separate immutable correlation key.
[Official GLPI V1 conventions](https://github.com/glpi-project/glpi/blob/11.0.0/apirest.md#important).

### 3.2 Responses are GLPI responses

Every JSON response uses GLPI's `Content-Type: application/json` (an optional
charset suffix is equivalent). Whitespace, JSON property order, hostnames,
assigned IDs, timestamps, and translated GLPI message strings are not fixed
bytes. Examples fix the **shape and machine values**, not runtime data.
Successful mutation `message` is the GLPI-generated string; `""` in an
example is an illustrative valid value, not a promise of an empty message.
A must use IDs/booleans/error codes, not English success text.

The verified GLPI 11.0.0 shapes are:

| Request shape / outcome | HTTP | Exact JSON structure |
|---|---|---|
| POST `input` is one object, saved | `201` | `{"id":<new_id>,"message":<GLPI_string>}` |
| POST `input` is an array, all saved | `201` | `[{"id":<new_id>,"message":<GLPI_string>}, ...]` |
| POST one object, validation denied | `400` | `["ERROR_GLPI_ADD",<validation_message>]` |
| POST array, all denied | `400` | `["ERROR_GLPI_ADD",[{"id":false,"message":<validation_message>}, ...]]` |
| POST array, mixed | `207` | `["ERROR_GLPI_PARTIAL_ADD",[{"id":<new_id_or_false>,"message":<string>}, ...]]` |
| PUT, all rows updated, including a single-object input | `200` | `[{"<B_id>":true,"message":<GLPI_string>}, ...]` |
| PUT one-object input denied | `400` | `["ERROR_GLPI_UPDATE",<validation_message>]` |
| PUT array, all denied | `400` | `["ERROR_GLPI_UPDATE",[{"<B_id>":false,"message":<validation_message>}, ...]]` |
| PUT array, mixed | `207` | `["ERROR_GLPI_PARTIAL_UPDATE",[{"<B_id>":<boolean>,"message":<string>}, ...]]` |
| GET one existing visible row | `200` | Raw row object, field names as section 1 |
| GET collection | `200` or `206` | Raw array of row objects; **no `data` envelope** |

For mutations, array input stays bulk even if it contains just one object.
A batch is not atomic: successes remain saved if another row fails. `207` is
not an all-success response. Failed records are not persisted as Work rows;
processing failures after acceptance appear on the saved Work instead.
Single POST success also has a `Location` header; bulk creation can have GLPI's
`Link` header. A should use returned IDs, not parse those links.
[GLPI 11 native mutation/error implementation, `API::createItems()`,
`updateItems()`, `returnError()`](https://github.com/glpi-project/glpi/blob/11.0.0/src/Glpi/Api/API.php).

**Missing-ID exception:** in GLPI 11.0.0 `API::updateItems()`, the nonexistent-ID
branch increments the failure count then `continue`s before appending the
failure result. For example, acknowledging IDs `301` (valid Pending) and
`999999` (absent) can return:

```http
HTTP/1.1 207 Multi-Status
Content-Type: application/json

["ERROR_GLPI_PARTIAL_UPDATE",[{"301":true,"message":""}]]
```

If all submitted IDs are absent, that implementation returns
`400 ["ERROR_GLPI_UPDATE",[]]`. B cannot promise one result for every missing
ID without changing GLPI. A compares returned **ID keys** against submitted
IDs, treats omitted results as unresolved, then GETs each unresolved ID.
Never map PUT results by array position or treat an absent result as success.
The installed patch behavior remains Q12.

`forcedisplay[0]=1&forcedisplay[1]=2` is a valid **search GET** column selection
when those search options exist. On Computer they conventionally identify
Name and ID, respectively. Plugin classes define their own search options;
A must discover them with `GET .../listSearchOptions/<itemtype>` before using
`/search/<itemtype>`. `forcedisplay` does not affect PUT, cannot repair the
missing-ID branch, and is unnecessary for the full-row collection GETs below.
Collection `sort=id` uses a **column name**; search `sort` and `forcedisplay`
use **numeric search-option IDs**. Do not mix the two APIs.
[GLPI search and update source](https://github.com/glpi-project/glpi/blob/11.0.0/src/Glpi/Api/API.php).

### 3.3 Common GLPI errors (apply to every purpose)

Native error responses are two-element arrays `[<code>,<message>]`. A must
match the first element. Translated messages, the configured documentation
URL suffix, and IP addresses vary. Where shown as `D` below, the message is
the native message plus GLPI's documentation suffix. No custom error envelope
or invented HTTP `409`/`422` is introduced.

| Condition | HTTP | Native JSON body / code |
|---|---|---|
| Invalid user token on login | `401` | `["ERROR_GLPI_LOGIN_USER_TOKEN","parameter user_token seems invalid"]` in English |
| Login credentials/token absent | `400` | `["ERROR_LOGIN_PARAMETERS_MISSING", D]` |
| Missing app token when required | `400` | `["ERROR_APP_TOKEN_PARAMETERS_MISSING", D]` |
| Wrong app token | `400` | `["ERROR_WRONG_APP_TOKEN_PARAMETER", D]` |
| Source IP not allowed | `400` | `["ERROR_NOT_ALLOWED_IP",<native_message_with_IP>]` |
| Missing session token | `400` | `["ERROR_SESSION_TOKEN_MISSING", D]` |
| Invalid/expired session token | `401` | `["ERROR_SESSION_TOKEN_INVALID","session_token seems invalid"]` in English |
| GET row absent | `404` | `["ERROR_ITEM_NOT_FOUND","Item not found"]` in English |
| Read permission denied | `403` | `["ERROR_RIGHT_MISSING",<native_permission_message>]` |
| Unknown/non-CommonDBTM itemtype | `400` | `["ERROR_RESOURCE_NOT_FOUND_NOR_COMMONDBTM", D]` |
| Missing/malformed `input` | `400` | `["ERROR_BAD_ARRAY", D]` for the standard input-shape check |
| Invalid JSON syntax | `400` | `["ERROR_JSON_PAYLOAD_INVALID","JSON payload seems not valid"]` |
| GET has a body | `400` | `["ERROR_JSON_PAYLOAD_FORBIDDEN", D]` |
| Unknown collection `searchText` field | `400` | `["ERROR_FIELD_NOT_FOUND", D]` |
| Collection start exceeds current count | `400` | `["ERROR_RANGE_EXCEED_TOTAL", D]` |

Mutation permission failures can be **per-record mutation failures** inside
`ERROR_GLPI_ADD`/`UPDATE`/partial wrappers, rather than a top-level 403. A
must handle both native access checks and per-row failures. A server/proxy
failure or timeout may return no GLPI JSON at all; the outcome is unknown.
Do not invent a successful Work result or retry a new creation blindly.
[GLPI 11 V1 error helpers and auth](https://github.com/glpi-project/glpi/blob/11.0.0/src/Glpi/Api/API.php),
[GLPI 11 request parsing](https://github.com/glpi-project/glpi/blob/11.0.0/src/Glpi/Api/APIRest.php).

## 4. Exact calls for every purpose in spec section 3 (deliverable 3)

### 4.1 Login

```http
GET /glpi/api.php/v1/initSession HTTP/1.1
Host: b.example
Content-Type: application/json
Accept: application/json
App-Token: <B_API_CLIENT_APP_TOKEN>
Authorization: user_token <B_SERVICE_ACCOUNT_USER_TOKEN>
```

Body: **none**. Success:

```http
HTTP/1.1 200 OK
Content-Type: application/json

{"session_token":"<B_SERVICE_ACCOUNT_SESSION_TOKEN>"}
```

Invalid token: `401` with the `ERROR_GLPI_LOGIN_USER_TOKEN` body in section
3.3. Missing/wrong app token, missing login parameters, or disallowed source
IP: the corresponding `400` response in section 3.3. No custom login.
[GLPI V1 login documentation](https://github.com/glpi-project/glpi/blob/11.0.0/apirest.md#init-session).

The active profile and entities determine accessible rows. Configure one
default service profile with the required entities. If selection is needed,
use GLPI's normal session resources with H, never plugin records:

```http
GET /glpi/api.php/v1/getMyProfiles
GET /glpi/api.php/v1/getActiveProfile
POST /glpi/api.php/v1/changeActiveProfile
```

The POST body is `{"profiles_id":<authorized_profile_id>}`. Entity equivalents
are `GET .../getMyEntities`, `GET .../getActiveEntities`, and
`POST .../changeActiveEntities` with
`{"entities_id":<authorized_B_entity>,"is_recursive":false}`.
Successful changes return `200`; standard session/access errors apply. Do
not assume login selects all routes' entities. Optional logout is
`GET .../killSession` with H and no body. These are session management calls,
not part of the flowcharts' minimum batch request counts.

### 4.2 Settings write: create

Headers: **H**. Body is one object inside `input`:

```http
POST /glpi/api.php/v1/PluginAgentbdmosassetsyncSetting
```

```json
{
  "input": {
    "route_id": "route-12",
    "a_entities_id": 12,
    "entities_id": 5,
    "route_enabled": 1,
    "settings_version": 7,
    "enabled_itemtypes_json": "[\"Computer\"]",
    "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
  }
}
```

Success, illustrative assigned ID:

```http
HTTP/1.1 201 Created
Content-Type: application/json
Location: https://b.example/glpi/api.php/v1/PluginAgentbdmosassetsyncSetting/1

{"id":1,"message":""}
```

For a duplicate route, the plugin's validation message is defined as:

```http
HTTP/1.1 400 Bad Request
Content-Type: application/json

["ERROR_GLPI_ADD","ASB_ROUTE_EXISTS: route_id=route-12"]
```

Other validation errors use the same native wrapper and the message catalog
in section 5. Common auth/access/format errors are in section 3.3. If a
creation times out, read the existing route instead of creating a second row:

```http
GET /glpi/api.php/v1/PluginAgentbdmosassetsyncSetting?searchText%5Broute_id%5D=%5Eroute-12%24&range=0-1&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false
```

H, no body; success is `200` with `[]` or an array containing the full Setting
row. There must be at most one exact matching route.

### 4.3 Settings write: update

Headers: **H**. Use the same row, the full replaceable settings content, and a
strictly higher version (**proposed Q4**). For example, disable its route:

```http
PUT /glpi/api.php/v1/PluginAgentbdmosassetsyncSetting/1
```

```json
{
  "input": {
    "id": 1,
    "route_id": "route-12",
    "a_entities_id": 12,
    "entities_id": 5,
    "route_enabled": 0,
    "settings_version": 8,
    "enabled_itemtypes_json": "[\"Computer\"]",
    "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
  }
}
```

Success:

```http
HTTP/1.1 200 OK
Content-Type: application/json

[{"1":true,"message":""}]
```

If the stored version is already `8`, that request instead produces:

```http
HTTP/1.1 400 Bad Request
Content-Type: application/json

["ERROR_GLPI_UPDATE","ASB_SETTINGS_VERSION_NOT_NEWER: submitted=8 stored=8"]
```

Read `GET .../PluginAgentbdmosassetsyncSetting/1?get_hateoas=false&expand_dropdowns=false`
after success or an uncertain reply and compare saved settings/version.
A stale settings failure does not mean previously accepted work was undone.

### 4.4 POST work batch

Headers: **H**. Use array input even for one work item. This example presumes
route `route-12` is enabled and its current version is `7` (the create example,
not the subsequent disabled-route update example).

```http
POST /glpi/api.php/v1/PluginAgentbdmosassetsyncWork
```

```json
{
  "input": [
    {
      "work_id": "A-20261024-000001",
      "route_id": "route-12",
      "a_entities_id": 12,
      "entities_id": 5,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":42,\"b_items_id\":null,\"serial\":\"SN-0042\"}",
      "a_values_json": "{\"asset_name\":\"Finance PC\"}",
      "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T04:00:00Z\",\"reliable\":true}}",
      "settings_version": 7,
      "handled_change_ids_json": "[]"
    }
  ]
}
```

Success is acceptance only; the response does not contain the Work result:

```http
HTTP/1.1 201 Created
Content-Type: application/json

[{"id":101,"message":""}]
```

A second POST of that work ID is rejected, even if its body is identical:

```http
HTTP/1.1 400 Bad Request
Content-Type: application/json

["ERROR_GLPI_ADD",[{"id":false,"message":"ASB_WORK_EXISTS: work_id=A-20261024-000001"}]]
```

For a batch containing one newly saved item followed by that duplicate:

```http
HTTP/1.1 207 Multi-Status
Content-Type: application/json

["ERROR_GLPI_PARTIAL_ADD",[{"id":102,"message":""},{"id":false,"message":"ASB_WORK_EXISTS: work_id=A-20261024-000001"}]]
```

Other schema/ownership errors use the same wrapper and section 5's exact
validation messages. Structurally valid work that later fails current
settings/identity checks must become visibly Held, not silently disappear.
The accept-versus-hold policy for arrival mismatches remains Q6.

After a timeout or duplicate error, find the same `work_id` using section
4.5 and inspect it. Do not substitute a new work ID to evade idempotency.
A successful POST does not make an asset or queue acknowledgement successful.

### 4.5 GET work result, by B ID, A work ID, or status

Headers: **H**. Bodies: **none**.

By known B row ID:

```http
GET /glpi/api.php/v1/PluginAgentbdmosassetsyncWork/101?get_hateoas=false&expand_dropdowns=false
```

Example verified completion of first copy:

```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "id": 101,
  "work_id": "A-20261024-000001",
  "route_id": "route-12",
  "a_entities_id": 12,
  "entities_id": 5,
  "itemtype": "Computer",
  "identity_json": "{\"a_items_id\":42,\"b_items_id\":null,\"serial\":\"SN-0042\"}",
  "a_values_json": "{\"asset_name\":\"Finance PC\"}",
  "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T04:00:00Z\",\"reliable\":true}}",
  "settings_version": 7,
  "handled_change_ids_json": "[]",
  "status": "Done",
  "result_json": "{\"b_items_id\":845,\"created_b_items_id\":845,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"asset_name\",\"outcome\":\"AppliedToB\",\"reason\":null}]}",
  "error": null,
  "date_creation": "2026-10-24 04:01:00",
  "date_mod": "2026-10-24 04:02:00",
  "completed_at": "2026-10-24 04:02:00"
}
```

While accepted, the same complete row has `status: "Accepted"`,
`result_json: null`, `error: null`, and `completed_at: null`. An asset-level
failure is still a **200 GET of the saved row**, e.g. `status: "Held"`,
`error: "ASB_SETTINGS_MISMATCH: submitted=7 current=8"`, and
`completed_at: null`. It is not a custom HTTP error from GET.

By exact A work ID (including timeout reconciliation):

```http
GET /glpi/api.php/v1/PluginAgentbdmosassetsyncWork?searchText%5Bwork_id%5D=%5EA-20261024-000001%24&range=0-1&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false
```

Success: `200`, body `[<the full Work row above>]`,
`Content-Range: 0-0/1`. No match: `200`, body `[]`, no Content-Range.
An absent row in a collection is not a 404. A must verify the returned
`work_id` exactly; database text search is not a substitute for ID equality.
More than one exact match violates the unique-key requirement; stop.

By status:

```http
GET /glpi/api.php/v1/PluginAgentbdmosassetsyncWork?searchText%5Bstatus%5D=%5EDone%24&range=0-49&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false
```

Success: `200` if the returned page covers all matching rows, otherwise
`206`; body is an array of full Work rows. `Content-Range` describes the
page. Substitute `Accepted`, `Held`, or `Failed` for other statuses. A may
also add `searchText%5Broute_id%5D=%5Eroute-12%24` to restrict a route.
A collection query's multiple `searchText` column filters are combined.

A direct ID read of a nonexistent row returns the `404 ERROR_ITEM_NOT_FOUND`
body in section 3.3. Read rights/session errors apply to both forms.

### 4.6 GET Pending change batch

Headers: **H**. Body: **none**. This is GLPI's ordinary collection text filter,
not an invented `?status=Pending` query or a custom queue endpoint.

```http
GET /glpi/api.php/v1/PluginAgentbdmosassetsyncChange?searchText%5Bstatus%5D=%5EPending%24&range=0-49&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false
```

Illustrative one-row page:

```http
HTTP/1.1 200 OK
Content-Type: application/json
Content-Range: 0-0/1
Accept-Range: PluginAgentbdmosassetsyncChange <GLPI_configured_limit>

[
  {
    "id": 301,
    "route_id": "route-12",
    "settings_version": 7,
    "a_entities_id": 12,
    "entities_id": 5,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":42,\"b_items_id\":845,\"serial\":\"SN-0042\"}",
    "changed_fields_json": "{\"asset_name\":{\"value\":\"Renamed in B\",\"changed_at\":\"2026-10-24T04:10:00Z\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 04:10:00",
    "date_mod": "2026-10-24 04:10:00",
    "done_at": null
  }
]
```

With 120 matching rows and a 50-row first page: `206 Partial Content`,
`Content-Range: 0-49/120`, and an array of 50 full rows. Empty queue: `200`,
`[]`, no Content-Range. The Accept-Range limit is supplied by GLPI, not a
plugin-defined hard-coded batch size. A request beyond the current count can
produce the native `400 ERROR_RANGE_EXCEED_TOTAL` response.

`range` is an inclusive **offset range**, not a queue-ID range or a snapshot
cursor. Exact-match anchors `^...$` suppress the implicit contains search;
the examples URL-encode those anchors. GLPI applies these through its normal
text-search conversion.
[GLPI collection filters, `API::getItems()`](https://github.com/glpi-project/glpi/blob/11.0.0/src/Glpi/Api/API.php),
[GLPI text-search anchors, `SQLProvider::makeTextSearchValue()`](https://github.com/glpi-project/glpi/blob/11.0.0/src/Glpi/Search/Provider/SQLProvider.php).

A should read/process/acknowledge a bounded first page, then request `0-49`
again after those rows leave Pending. Incrementing to `50-99` after removing
the first page would skip rows. If collecting several pages before updating
any statuses, offsets are still not a transaction snapshot; another consumer
may change the set. Keep exact IDs, deduplicate, and reread on uncertainty.
Rows that remain Pending because of conflict must not be acknowledged simply
to advance pagination; the starvation/concurrency policy is Q14.

Session/permission/filter/range failures are the native bodies in section 3.3.
GET changes does not claim, mutate, or automatically mark anything Done.

### 4.7 PUT acknowledgements

Headers: **H**. Use array input and only `id` plus `status`:

```http
PUT /glpi/api.php/v1/PluginAgentbdmosassetsyncChange
```

```json
{
  "input": [
    {"id": 301, "status": "Done"},
    {"id": 302, "status": "Done"}
  ]
}
```

All submitted rows were Pending and updated:

```http
HTTP/1.1 200 OK
Content-Type: application/json

[{"301":true,"message":""},{"302":true,"message":""}]
```

If 301 was Pending and 302 was already Done:

```http
HTTP/1.1 207 Multi-Status
Content-Type: application/json

["ERROR_GLPI_PARTIAL_UPDATE",[{"301":true,"message":""},{"302":false,"message":"ASB_CHANGE_TRANSITION: from=Done to=Done"}]]
```

If both rows were already Done:

```http
HTTP/1.1 400 Bad Request
Content-Type: application/json

["ERROR_GLPI_UPDATE",[{"301":false,"message":"ASB_CHANGE_TRANSITION: from=Done to=Done"},{"302":false,"message":"ASB_CHANGE_TRANSITION: from=Done to=Done"}]]
```

If an input row contains `error`, its row result instead has `false` and
`"message":"ASB_B_OWNED_FIELD: field=error"`, in the appropriate wrapper.
Read rights do not permit updates; update permission failures use GLPI's
native mutation wrappers. Missing IDs follow the section 3.2 exception.

A sends acknowledgement only after its own local handling/save succeeds.
The response is in this same HTTP exchange; there is no second response call
and no callback from B. B sets `date_mod` and `done_at` itself. A supplies
neither timestamp. After uncertain or incomplete responses, read each ID:

```http
GET /glpi/api.php/v1/PluginAgentbdmosassetsyncChange/301?get_hateoas=false&expand_dropdowns=false
```

`200` returns the full Change row; only `status: "Done"` confirms completion.
`404` means that ID is absent, not acknowledged. Never replace IDs with serial
numbers, work IDs, or array positions.

### 4.8 Correction work uses the same POST and GET

No additional REST purpose or endpoint is introduced. For an A-owned field
edited in B, A posts a new Work with its winning A value:

```http
POST /glpi/api.php/v1/PluginAgentbdmosassetsyncWork
```

Headers: **H**. Example body:

```json
{
  "input": [
    {
      "work_id": "A-20261024-000002",
      "route_id": "route-12",
      "a_entities_id": 12,
      "entities_id": 5,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":42,\"b_items_id\":845,\"serial\":\"SN-0042\"}",
      "a_values_json": "{\"asset_name\":\"Finance PC\"}",
      "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T04:00:00Z\",\"reliable\":true}}",
      "settings_version": 7,
      "handled_change_ids_json": "[301]"
    }
  ]
}
```

Success: `201 [{"id":103,"message":""}]`, still acceptance only. Validation
errors and duplicates use section 4.4's native responses. Poll with:

```http
GET /glpi/api.php/v1/PluginAgentbdmosassetsyncWork/103?get_hateoas=false&expand_dropdowns=false
```

H, no body. After successful correction, the `200` Work row has `status:
"Done"` and a JSON string in `result_json` whose decoded content is:

```json
{
  "b_items_id": 845,
  "created_b_items_id": null,
  "b_values_for_a": {},
  "covered_change_ids": [],
  "handled_change_ids_done": [301],
  "field_outcomes": [
    {"mapping_id": "asset_name", "outcome": "AppliedToB", "reason": null}
  ]
}
```

B may mark 301 Done only after checking the snapshot's route, entities,
itemtype, identity, settings/mappings, original field times, and successful
verified correction. If that correction fails/conflicts, 301 remains Pending;
GET still returns `200` with the Work's Held/Failed status and reason. A does
not PUT a second acknowledgement for IDs confirmed in
`handled_change_ids_done`. A newer edit is a separate Pending row and is not
covered just because it concerns the same asset/field.

## 5. Validation and state rules (deliverable 4)

### 5.1 General admission rules

1. Honor standard GLPI session, profile, entity, and record rights first.
   Never trust an A-supplied flag to grant internal/B write access.
2. Reject A's B-owned fields before accepting the record. Reject unknown
   record properties; do not silently drop them. `id` is allowed only as an
   update selector. Any `id` in a create is B-owned and rejected.
3. Validate every row independently in a bulk request. Reject an invalid row
   without saving it or mutating its asset/queue. Do not promise batch rollback.
4. Enforce the declared types, required keys, nonempty IDs, enum values,
   inner JSON object/array shapes, and integer bounds. A nested object in a
   `*_json` column is rejected: it must be a JSON string of the declared shape.
5. Native API-injected bookkeeping (e.g. `_add`) and GLPI internal fields must
   be handled without making client-supplied bypass flags legal. The exact
   early validation hook/handling in the selected patch must be confirmed
   during implementation (Q15); it must not weaken the ownership rule.
6. A may not DELETE or PURGE any of these records. B has no automatic cleanup
   of Done rows. No mutation automatically moves, archives, clears, or deletes
   an asset.

### 5.2 Setting validation

- Require all A-owned Setting fields on creation and all replaceable content
  on update. On update require selector `id`; if `route_id` is repeated it
  must equal the stored immutable value. The examples repeat it for clarity.
- Enforce a database unique key on `route_id`, as well as friendly validation,
  under the proposed one-row-per-route model (Q1). Duplicate creation is an
  error, not an upsert.
- Enforce authorized B entity scope, both old and new entity if retargeting is
  approved. A entity IDs are opaque remote IDs: B cannot verify their existence
  by making an outbound request. Retargeting still requires Q2.
- Proposed version rule (Q4): create requires version >=1; an update requires
  `submitted > stored`, including a byte-identical retry. Check/replace
  atomically so concurrent stale versions cannot overwrite newer settings.
- Reject duplicate type names and duplicate mapping IDs, invalid field
  selectors, invalid source/value-mode enums, and multiple enabled mappings
  targeting the same B field for the same itemtype. An enabled mapping must
  refer to an enabled itemtype.
- `itemtype` is data. B validates recognized/supported types generically; it
  does not add a per-type code path. Unknown or unsupported configured types
  and unsupported field kinds must be rejected visibly. The type boundary
  and Fields behavior require Q7.
- A field missing or not safely writable on an otherwise supported asset type
  receives a visible per-field outcome when work is processed; the proposed
  skip policy and where support is validated need Q7/Q8. Do not erase mappings
  or silently pretend they were applied.
- No B-owned Setting business fields exist; B must never advance the version
  or revise mappings itself. Setting has no status transition.

### 5.3 Work validation and processing boundary

- Required creation fields are exactly those marked Required in section 1.4.
  Do not require `status`, results, error, or timestamps from A.
- Reject every supplied B-owned field, including `status: "Accepted"` and
  `result_json: null`. Reject all A updates to existing Work records.
- Enforce a database unique key on `work_id`, case-sensitive and covering the
  whole B installation. Concurrent duplicate requests must not create two
  records. Proposed duplicate rule (Q4): reject the second record and let A
  read the first; never overwrite the payload or repeat its completed write.
- Require `itemtype` to be a nonempty string. Structurally valid unknown or
  disabled arriving types must cause a visible hold under the proposed
  arrival policy (Q6), never an arbitrary class invocation or asset creation.
- `identity_json` requires all three keys and a positive `a_items_id`.
  Missing usable B identifiers (`b_items_id` and usable serial both null) can
  be recorded, but must hold in the background: no guessing and no first copy.
  Default proposed lookup order is confirmed link, then serial (Q7).
- `a_values_json` values must have the declared scalar/label shape. Process
  **only enabled mappings** for this type in the current settings. Extra
  unmapped values are ignored as required by spec section 4, never written;
  this is different from forbidden extra top-level record fields.
- `a_change_times_json` must have the specified evidence shape. Missing or
  explicitly unreliable evidence is permitted so conflicts can stay visible.
  A malformed timestamp is a schema error; missing evidence is not a license
  to invent a winning time.
- `handled_change_ids_json`, when present, is an array of distinct positive
  integers. Receiving it never acknowledges anything. B must validate every
  referred snapshot's scope/coverage again when processing the correction.
- Admission is bounded validation and saving only. Matching assets, dropdown
  lookups, add/update, reread verification, and correction completion happen
  in the local background task.
- Before **each local write**, recheck current route enabled state, settings
  version, entities, allowed type, mapping, identity, field rules, and service
  permissions. Hold mismatches without further writes. Previously completed
  writes are not undone.
- A confirmed linked B asset in the wrong entity is Held, never moved or
  silently relinked. Lookup errors, denial, duplicates, or incomplete evidence
  are Holds, never proof of no match. First copy requires a complete,
  unambiguous lookup that positively found nothing.
- Existing-asset rule `A`: apply A to B. Rule `B`: leave B and return its value
  to A. Rule `Both`: later genuine per-field time wins; unequal values with
  equal/missing/unreliable times conflict without changing either field.
  Equal values need no write. Unmapped fields remain unchanged.
- First copy seeds all enabled mapped A fields once regardless of source,
  respects the routed B entity/type, saves verified link evidence, and returns
  the confirmed new ID. It does not excuse unsupported/unsafe fields or an
  uncertain prior creation. B uses local GLPI `add()`/`update()` with History,
  rereads writes, and applies a loop guard so sync writes never queue to A.
- `Done` requires the evidence described in section 1.4. Held/Failed results
  remain readable; A has no status reset endpoint. Partial success, crash
  recovery, and resumption are Q8/Q9, not speculative retry behavior.

### 5.4 Change validation

- A cannot create a Change. B creates the required fields from a genuine,
  eligible local edit, initially Pending. Only mapped enabled fields of an
  enabled routed type are captured; an A-owned field edit is captured too.
- A's update body must contain exactly `id` and `status`. Both are required.
  Reject other business fields even if unchanged/null. `status` must be the
  exact case-sensitive string `Done`; the saved status must be `Pending`.
- Reject transitions from Done, transitions to Pending, unknown status names,
  and any attempt to edit identity, times, retry count, error, or changed data.
- B's successful correction may perform the same `Pending -> Done` transition
  for **exactly** the covered snapshot IDs. No input list, asset match, or HTTP
  POST success is sufficient by itself. Newer queue rows remain independent.
- Acknowledging a row is an all-fields snapshot acknowledgement. If only some
  fields were safely handled, leave the row Pending; partial-row completion
  and already-handled snapshots in a correction need Q8/Q9.
- Pending failures/conflicts stay available with a reason. A never increments
  `retry_count`, writes `error`, or clears a queue record. No field times are
  replaced with poll, ack, or sync execution time.

### 5.5 Plugin validation message catalog

These are **specified plugin validation messages**, to be implemented inside
record validation and carried by the native mutation wrappers in section 3.2.
They are not new GLPI top-level error codes or custom HTTP responses. Literal
prefixes are stable, ASCII, and untranslated. Placeholder values are replaced
with the rejected field/value; credentials are never included.

| Condition | Exact message template |
|---|---|
| A supplies a B-owned field | `ASB_B_OWNED_FIELD: field=<field>` |
| Unknown top-level field | `ASB_UNKNOWN_FIELD: field=<field>` |
| Missing required field | `ASB_REQUIRED_FIELD: field=<field>` |
| Wrong scalar/JSON type or shape | `ASB_INVALID_FIELD: field=<field>` |
| Invalid mapping configuration | `ASB_INVALID_MAPPING: mapping_id=<mapping_id>` |
| Unsupported settings itemtype | `ASB_UNSUPPORTED_ITEMTYPE: itemtype=<itemtype>` |
| Unsupported mapping kind/selector | `ASB_UNSUPPORTED_MAPPING: mapping_id=<mapping_id>` |
| Duplicate route | `ASB_ROUTE_EXISTS: route_id=<route_id>` |
| Immutable route changed | `ASB_IMMUTABLE_FIELD: field=route_id` |
| Non-increasing settings version | `ASB_SETTINGS_VERSION_NOT_NEWER: submitted=<version> stored=<version>` |
| Duplicate work ID | `ASB_WORK_EXISTS: work_id=<work_id>` |
| A attempts Work update if validation is reached | `ASB_WORK_IMMUTABLE` |
| Invalid Change transition | `ASB_CHANGE_TRANSITION: from=<stored_status> to=<submitted_status>` |

GLPI rights checks may reject a request before plugin validation; those native
permission messages take precedence. For several plugin validation faults in
one row, report one fault: B-owned field first, unknown field second, missing
field third, type/shape fourth, then business constraints. Within a category,
use field-name lexical order. An invalid submitted status type uses
`ASB_INVALID_FIELD: field=status`, not an interpolated arbitrary object.

Background errors appear in stored `error`/field `reason`, not as HTTP errors
from a GET. Required visible categories include settings mismatch, scope
mismatch/out of scope, disabled/unknown type, missing/ambiguous identity,
permission failure, field conflict/unsupported field, missing/ambiguous
option, save/verification failure, stale work, and uncertain creation. The
result must explain the actual condition; it must not fabricate evidence.
The spec has no stale-work threshold or recovery policy (Q9).

## 6. Enable GLPI V1 and create the service account (deliverable 5)

These are administrator setup instructions, not actions performed by this
documentation task. The administrator account is separate from A's restricted
service account.

1. Confirm the exact GLPI 11.x patch, HTTPS base URL, and routed B entities.
   Install/enable the future plugin under `plugins/agentbdmosassetsync`; the
   three resource classes, tables, entity checks, and profile rights must exist
   before the record examples can work. This file does not implement them.
2. In **Setup/Configuration > General > API**, use the **Legacy API** section.
   Set **Enable Legacy REST API** to Yes and accept GLPI's built-in warning.
   Save. Enabling only the newer API does not enable V1. Copy the displayed
   **URL of the API** from the Legacy section. These labels and switches are
   present in the official GLPI 11.0.0 template.
   [GLPI 11 API settings UI](https://github.com/glpi-project/glpi/blob/11.0.0/templates/pages/setup/general/api_setup.html.twig).
3. Enable **login with external token** for the Legacy API. This contract uses
   a user token, so password-based API login is unnecessary. Do not configure
   OAuth/V2 credentials for these calls.
4. Add an active **API client** for A. Give it a descriptive name, configure
   the source IPv4 range/IPv6 address actually seen by B, generate/copy its
   application token, and save. Proxies/NAT must be reflected in the allowed
   address. Use GLPI's normal API-client settings; add no custom auth. This
   integration requires the App-Token header even though V1 can be configured
   to allow clients without a token. Do not enable an additional API log file
   for this plugin. No custom log file is required.
5. In **Administration > Profiles**, create a dedicated standard-interface
   profile such as `Agent-B AssetSync service`. After plugin rights are
   available, grant exactly the per-record operations in section 2. Deny all
   Delete/Purge permissions; do not use Super-Admin. Configure any necessary
   ordinary asset/field rights only after resolving Q10.
6. In **Administration > Users**, create a dedicated active user such as
   `assetsync-a-service`. Use the normal GLPI account mechanism. Assign the
   dedicated profile in its **Authorizations** for the routed B entities;
   choose recursive scope only where intended. Make that profile/default
   entity the service account's default and avoid unrelated authorizations.
7. In that user's **Settings** tab, generate/copy its **Remote access key**
   (API token, `api_token`). This is the **user token**, distinct from the API
   client's app token. An administrator with appropriate user rights may need
   to generate it, depending on local policy. Supply both tokens securely to
   A's operator; they never go into a Setting or Work record.
   [GLPI V1 user-token documentation](https://github.com/glpi-project/glpi/blob/11.0.0/apirest.md#init-session),
   [GLPI 11 token generation](https://github.com/glpi-project/glpi/blob/11.0.0/src/User.php).
8. Use section 4.1's login and GLPI's profile/entity session resources to
   confirm the intended context. An expired session is replaced by normal
   login; an app token alone does not identify the service user. Preserve
   object IDs/work IDs when reconciling an interrupted mutation.
9. Configure B's normal GLPI automatic-action runner for the future background
   task. POST acceptance will otherwise remain Accepted. B must process locally
   and check the submitting service permissions (Q10), never call itself/A
   over HTTP. Reliable UTC clock/time configuration is required if Q3 is
   approved. No asset deletion/purge command is part of setup.

### Manual curl checklist for the reviewer (not executed here)

Use a disposable development GLPI B and the actual Legacy base URL. Commands
below expect shell variables already populated privately; the values are not
shown. Fixtures `setting-create.json`, `work-batch.json`, and `ack-batch.json`
contain the corresponding section 4 bodies with development IDs.

```sh
curl --silent --show-error --include \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" \
  -H "Authorization: user_token ${B_USER_TOKEN}" \
  "${B_V1_BASE}/initSession"

curl --silent --show-error --include \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  "${B_V1_BASE}/getActiveProfile"

curl --silent --show-error --include --request POST \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  --data-binary @setting-create.json \
  "${B_V1_BASE}/PluginAgentbdmosassetsyncSetting"

curl --silent --show-error --include --request POST \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  --data-binary @work-batch.json \
  "${B_V1_BASE}/PluginAgentbdmosassetsyncWork"

curl --silent --show-error --include \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  "${B_V1_BASE}/PluginAgentbdmosassetsyncChange?searchText%5Bstatus%5D=%5EPending%24&range=0-49&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false"

curl --silent --show-error --include --request PUT \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  --data-binary @ack-batch.json \
  "${B_V1_BASE}/PluginAgentbdmosassetsyncChange"
```

Reviewer observations required after implementation:

- Read Setting back; check increasing and stale versions, route uniqueness,
  entity restrictions, and unsupported mappings. Never test route retargeting
  until Q2 is resolved.
- Confirm valid work saves Accepted without immediate asset mutation. POST the
  same work ID twice, including a mixed batch; check exact wrappers and a
  single saved row. Send a B-owned status/result field and verify rejection.
- After the background task, read the Work by ID and work ID, inspect the
  verified local asset/History, and confirm sync writes queued no Change.
- Create a genuine B edit; read a Pending batch and preserve its exact IDs.
  Acknowledge only completed rows, test forbidden fields/statuses, read Done
  back, and verify newer edits remain Pending.
- Send a mixed acknowledgement with a known absent development ID. Compare
  returned ID keys and readback against section 3.2's missing-ID caveat;
  record the actual selected patch behavior. `forcedisplay` is not a PUT fix.
- Verify denied operations/profile scope by inspecting the restricted profile
  and safe read/admission attempts. Do not run DELETE/PURGE or destructive
  database commands for this checklist.

No automated tests, live calls, database commands, commit, or push were run
for this documentation task.

## 7. Questions requiring explicit decisions

These questions are part of the contract deliverable. Proposed choices below
are not authorization to guess in implementation. Blocking questions must be
answered before A relies on the affected schemas/behavior. Spec question
numbers refer to section 11 of the root spec.

| ID | Question and proposed choice | Impact |
|---|---|---|
| Q1 | Is one Setting per immutable route, with a per-route increasing version, correct, or should B store one connection-wide snapshot/version containing several routes? This draft proposes per-route records. How many A controllers/connections may share one B? | Blocks final Setting scope, uniqueness, and version semantics. |
| Q2 | May a route's A or B entity change in place? If so, how are the old link/evidence and pending rows preserved without silently relinking/moving assets? Proposed safe choice: create a distinct route identity for a different entity pair, keep old evidence. | Blocks route update validation beyond version/mappings/enabled state. |
| Q3 | Approve UTC, second precision, and the evidence format in section 1.4? Are both servers' clocks trustworthy, and how is unreliable evidence detected rather than merely asserted? If subsecond edits matter, what shared precision is required? (Spec Q4.) | Blocks dependable `Both` comparisons and final timestamp policy. |
| Q4 | Approve rejecting duplicate work IDs and rejecting settings versions <= stored, including identical retries? Approve the bounded case-sensitive ID formats and atomic unique/version checks? (Spec Q15/Q16.) | Blocks retry behavior A must depend on. Proposed native errors are documented; no custom 409. |
| Q5 | Approve one Change row per genuine save per route, no merging, and no cleanup of Done rows? (Spec Q3/Q10.) | Fixes queue snapshot granularity and retention. |
| Q6 | For structurally valid arriving work with mismatched settings/route/type, approve saving Accepted then holding visibly in the background, instead of admission rejection? (Spec Q7.) | Fixes whether A receives a row to poll or a failed POST. No asset write in either case. |
| Q7 | Which GLPI asset classes count as all supported types: core only, or also GLPI 11 custom/non-core assets? Approve confirmed link then serial only, and holding types without usable identifiers? Which Fields-plugin version/selector metadata is supported, and should unavailable/unsupported custom mappings be rejected at settings write or held at work time? For the required text/dropdown conversions, what label language, case/whitespace rules, hierarchy context, and null/empty behavior apply? Which complex field kinds need explicit non-scalar formats? (Spec Q8/Q9/Q12.) | Blocks exact type/support boundary, option matching details, and custom/complex field formats. Text-to-dropdown itself is now an explicit user requirement. No invented GLPI metadata APIs. |
| Q8 | Using section 1.3's field/conversion classification, approve skipping absent/unwritable fields with a specific reason while processing supported fields? If some fields conflict/fail, is the Work Held/Failed rather than Done? Can a queue row be Done only when every field in that snapshot is covered, as proposed here? Dropdown/text conversions are required; an absent or ambiguous option is a conversion failure, not a blanket unsupported dropdown type. (Spec Q11 and partial-result ambiguity.) | Blocks partial completion and queue acknowledgement semantics, not the required dropdown/text conversion support. |
| Q9 | How are Held/Failed work resumed and retries counted? What makes work stale? How are durable worker ownership, per-field completion, crash recovery after add/update, and link persistence handled so a timeout never duplicates a write or first-copy asset? What happens if correction IDs were already Done? | Blocks safe background/retry implementation; duplicate IDs alone do not solve crash recovery. |
| Q10 | How does the background task identify and recheck the original service account/profile/entity rights without storing its session token or trusting an A-supplied user ID? Which ordinary asset/dropdown/Fields rights must that account hold? | Blocks the spec's background authorization requirement. Plugin rights in section 2 remain exact. |
| Q11 | Where is confirmed durable link evidence stored, and how does A signal that a single asset has left scope while a route stays enabled? How is return-to-scope distinguished from a first copy? The three record descriptions supply no explicit per-asset stop operation. | Blocks full transfer/stop/reuse semantics; no speculative fourth record or custom endpoint has been added. |
| Q12 | Which exact GLPI 11.x patch is deployed, and does its native PUT missing-ID behavior still omit results as 11.0.0 does? Must A support that omission or is a fixed core patch required? | Native protocol compatibility question; no plugin HTTP override promised. |
| Q13 | What is B's actual HTTPS Legacy API base URL and installation prefix? Is `/api.php/v1` exposed as advertised in 11.0.0, or must this deployment use `/apirest.php`? | Needed to substitute executable deployment URLs; V1 method/body conventions are researched, not guessed. |
| Q14 | Can multiple A consumers read/ack the same queue, and how should paging avoid starvation when the earliest Pending rows remain unresolved? | No snapshot/claim/cursor capability has been assumed for GLPI offset ranges. |
| Q15 | In the selected GLPI patch, which record validation stage sees client fields before GLPI filtering/defaults, and how will native bookkeeping be handled while rejecting all client-supplied bypass/B-owned fields? Verify the three real CommonDBTM classes through the built-in V1 API after the skeleton exists. | Implementation/version uncertainty; sources confirm the generic resolver, not these unimplemented classes. |

Already resolved: target major version **GLPI 11**; display name
**Agent-B-DMOS-AssetSync**; installed directory **agentbdmosassetsync**; global
class prefix **PluginAgentbdmosassetsync**; current repository path retained;
correction work is an ordinary Work with handled IDs; first-copy creation is
required. No custom route, custom authentication, outbound B call, or A-side
code is authorized by this contract.
