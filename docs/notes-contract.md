# Native Notes extension — 28 October 2026

This extends [api-contract.md](api-contract.md). The user approved existing-note
backfill, new notes and later edits, text/formatting only, per-note Both authority,
an internal association table, and leaving matching notes unchanged while linking
their identities. Ambiguous matches remain unchanged for review. No deletion,
files, Controller implementation, custom route/authentication or B outbound call
is authorized. All standard V1 headers and response wrappers remain unchanged.

## Settings and compatibility

Setting gains `notes_itemtypes_json`: LONGTEXT containing a JSON array of distinct
enabled parent itemtype strings. It defaults to `[]` on creation/upgrade. Omission
on a Setting replacement preserves the current Notes selection; an explicit `[]`
disables Notes. Selected types must be in `enabled_itemtypes_json`, available in
the installed registry and support native GLPI Notes. Admission checks the local
profile's parent READ, READNOTE and UPDATENOTE, not ordinary asset UPDATE as a
substitute. Route and settings-version checks still apply. Notes authority is
Both; no additional A/B mode is introduced in this extension.

Work and Change gain `subject`: VARCHAR(16), `Asset` by default, or `Note`.
Work/Change gain nullable LONGTEXT `note_json`. Notes never enter the scalar
mapping payloads. Existing Asset rows and clients retain their original behavior.
An Asset request must omit `note_json` or supply null. A must understand/filter
`subject` before enabling Notes; a settings version alone is not client capability
negotiation. The old queue GET otherwise returns Note rows too.

## Note Work input

The existing required Work fields are retained: work_id, route_id, entity pair,
parent itemtype, parent identity_json, settings_version, a_values_json and
a_change_times_json. For subject Note, both scalar JSON objects must be `{}`.
The parent identity is the original asset identity schema. A parent must already
have a verified Asset Work link; a Note Work never creates, links or resumes an
asset. Its B-owned `b_items_id` and `link_state` stay null; confirmed parent IDs
are returned in result_json. A's `a_items_id` still identifies the parent.

Note supports operation `Sync` (default) and `Inventory`. Suspend/Resume remain
Asset-only. Delete/purge/move operations do not exist. Work IDs remain globally
unique; a new Work ID for the same note must reuse the same association.

For Sync, note_json is a JSON string containing exactly:

```json
{"a_notes_id":12,"b_notes_id":null,"content":"<p>Replaced battery</p>","changed_at":"2026-10-28T10:00:00+08:00","reliable":true}
```

`a_notes_id` is a required positive A-local Note ID. `b_notes_id` is null or a
positive expected B-local Note ID; it is a guard, never an instruction to reparent
or fall back to creation. `content` is a UTF-8 string, including its formatting;
no trimming, flattening, reformatting or body-based hash identity is performed.
Empty content is an explicit content edit, not deletion. `changed_at` is null or
second-precision RFC3339 with +08:00; reliable is boolean and true requires a
valid time. Missing/unreliable evidence cannot win a differing-value conflict.
No remote user ID, parent link, visibility, file/upload input or GLPI-maintained
date is a client-writable Note property.

For Inventory, note_json contains exactly:

```json
{"after_id":0,"limit":50}
```

after_id is a nonnegative B Note ID; limit is 1..50. handled_change_ids_json must
be empty. Results are ascending IDs on the verified parent, bounded to limit,
with an extra-row lookahead. Continue using the returned next_after_id until
has_more is false. This is a live keyset pass, not an immutable snapshot. Enable
capture before inventory and deduplicate inventory/events by their note IDs.
Inventory never fabricates a new genuine edit time or creates a Change.

Sync handled_change_ids_json may contain exact distinct Note Change IDs for
this same note, parent, route and entity pair. Asset Changes, other notes, stale
scope or newer/uncertain evidence are not covered by an incoming revision.
Receiving IDs never acknowledges them. B records an actual correction attempt
only after all references validate; original snapshots remain immutable.

## Identity and equality

The association is a pair of A/B note IDs scoped to the route and verified
parent. B-native notes can initially have a_notes_id null. A retains its own
association after copying them; a subsequent Sync can confirm the A note ID.
B capture returns the known A ID when linked and always returns its actual B ID.
The ID pair avoids generating customer UUIDs or a separate transport identity.

For an existing A association, reread its B note and verify its exact parent.
A supplied expected B ID must agree. A missing linked note or uncertain prior
creation is Held; never recreate automatically, including under a new Work ID.

Without an A association, an expected B ID must identify a permitted Note on
this exact verified parent and not be paired to another A note. Without an
expected B ID, read all permitted same-parent exact-content candidates. A unique
unpaired match is associated and returned AlreadyEqual without a Note update.
Multiple matches, a candidate already paired elsewhere, an incomplete lookup or
denied match is Held for review, never proof that creation is safe. If a complete
lookup finds zero matches, reserve the A identity before creating one B Note.
An equal body is only an initial pairing rule; later edits follow the durable
association. Existing unrelated notes are never replaced as a collection.

For paired equal content, do not call update(). Preserve evidence belonging to
the current value; equal input does not invent a human edit or a winning time.
For differing content, compare reliable genuine per-note instants: newer A is
applied locally; newer B is returned to A; equal/missing/unreliable times Hold
without a Note update. A must preserve B's evidence when copying to A and vice
versa. Copied-value evidence and B's last genuine human content edit are stored
separately. Native date_mod alone is not proof of a human content edit.

## Result and Change payloads

Note Sync result_json contains exactly these business members (ordinary Work
status/error/timestamps remain in their existing columns):

```json
{"b_items_id":231,"note_outcome":"AlreadyEqual","note":{"a_notes_id":12,"b_notes_id":45,"content":"<p>Replaced battery</p>","changed_at":null,"reliable":false},"covered_change_ids":[],"handled_change_ids_done":[]}
```

note_outcome is Created, AppliedToB, AlreadyEqual, ReturnToA or Held. note is a
verified B snapshot or null when none can be safely returned. Created/AppliedToB
require a verified save and durable association/evidence; equal content has no
redundant asset/note write. Definite failed saves may use Work Failed; unknown
outcomes/conflicts use Held. Held/Failed never automatically reopen.

Note Inventory result_json:

```json
{"b_items_id":231,"notes":[{"a_notes_id":null,"b_notes_id":45,"content":"<p>Replaced battery</p>","changed_at":null,"reliable":false}],"skipped_notes":[{"b_notes_id":46,"reason":"Unsupported embedded file content"}],"has_more":false,"next_after_id":46}
```

Skipped notes consume cursor positions and remain unchanged. Inventory has no
covered/handled IDs. Original native author/updater IDs and date metadata may be
read locally but are not transferred into B's local author fields. Historical
notes lacking verified current-value evidence return null/false time evidence.

A Note Change uses the existing scope/identity columns for its parent,
subject Note, changed_fields_json `{}`, and note_json containing exactly the
snapshot shape above (a_notes_id may be null; b_notes_id is positive). Genuine
captured content edits require reliable true/+08:00 time; metadata-only changes
create no Note Change. One actual Note save creates one immutable snapshot per
eligible route. New revisions never mutate old snapshots. Acknowledgement stays
the exact standard `{"input":{"id":99,"status":"Done"}}` PUT; all other fields
remain B-owned. Completing one snapshot does not complete later ones.
An acknowledgement checks current Note identity, parent, association and read
permissions, but does not reject that immutable snapshot because the Note's
current content has subsequently changed or gained unsupported media.

ReturnToA leaves exact covered snapshots Pending until A applies and acknowledges
them. A successful correction may finish only supplied same-note snapshots
whose full content revision is demonstrably covered: equal content, or a newer
reliable winning revision. A differing later snapshot or missing evidence stays
Pending with a reason; no other queue rows change. Already Done references are
reported as covered without rewriting them. retry_count follows actual attempts.

## Local behavior and internal persistence

Use one generic native Notepad path and parent itemtype data. Check parent
concrete type, entity, verified Asset link, suspension and service-account
READ/READNOTE/UPDATENOTE as applicable before every local write, under the
existing captured-submitter context. Never inherit cron privileges or require
ordinary asset UPDATE just to substitute for Notes-specific rights.

Native author/updater is the actual local account. Preserve existing
visible_from_ticket explicitly on edits (GLPI otherwise defaults it to 0);
new copies use 0. The payload cannot reparent a Note, alter native authors/dates,
enable Notes capabilities or purge a Note. Missing native Notes capacity Holds.

Text and formatting are in scope. Media, uploads, inline images and native
document references are unsupported: omit/log local capture and report an
Inventory skip or Held Sync rather than strip content or fetch/copy files.
External ordinary hyperlinks remain text/formatting. Match and verify the actual
supported content without silently losing formatting. Unsupported-content
handling must not block a human's normal GLPI save.

Wrap the entire native add/update in the existing sync guard, including nested
GLPI work. Capture snapshots are read-only and all capture/queue failures use
the existing GLPI PHP log without escaping into the save. No shutdown-only
capture, automatic retry or extra log file is introduced. Metadata-only native
edits are ignored. Native add captures existing assets' new Notes, not a sync
or nested asset-creation echo.

After a skipped or failed capture, B attempts to invalidate the effective edit
time for that route's existing Note association. It must not assert an older
value's time for a newly saved value. If both capture and evidence invalidation
fail, B logs `ASB_NOTE_CAPTURE_MANUAL_RECONCILIATION_REQUIRED` in GLPI's existing
PHP log. The human save still succeeds; an operator must reconcile the Note and
its association before trusting further conflict decisions. This is a known
persistence-failure boundary, not a promise that every saved edit was queued.

Internal table `glpi_plugin_agentbdmosassetsync_notelinks` is not an API itemtype.
Its fields are B-owned: id INT UNSIGNED primary key; route_id VARCHAR(128) ASCII;
itemtype VARCHAR(255); a_entities_id/entities_id INT UNSIGNED;
a_items_id/a_notes_id nullable INT UNSIGNED; b_items_id INT UNSIGNED;
b_notes_id nullable INT UNSIGNED; state VARCHAR(16) (Reserved/Linked/Uncertain);
reservation_works_id nullable INT UNSIGNED; content_hash nullable CHAR(64) ASCII;
value_changed_at nullable VARCHAR(32); value_reliable TINYINT UNSIGNED default0;
last_local_changed_at nullable VARCHAR(32). Unique keys cover
(route_id,itemtype,a_items_id,a_notes_id) and
(route_id,itemtype,b_items_id,b_notes_id); nulls permit not-yet-paired sides.
Keep only required association/evidence, not duplicate complete note bodies.

Commit an A identity reservation before a possible Note creation. Confirm Note
creation plus the association/effective evidence in a local transaction where
supported. Preserve the durable reservation on uncertain outcome, so a new Work
cannot bypass it. A reservation never means success. Native Note/attachment
lifecycle and transaction failures require verification before claiming a pilot
ready; do not promise rollback or exactly-once behavior without evidence.

Additive installation/upgrade must create the internal table and add missing
columns without clearing or rewriting existing Work/Change payloads. Existing
rows get subject Asset and null note_json; Settings get Notes disabled. Do not
run upgrade/deployment against an existing environment as part of source-only
implementation. Uninstall remains a separate explicitly approved destructive
administrator action and must account for the internal table.

## Standard REST examples

All paths are relative to the deployment's configured Legacy base, e.g.
`http://localhost:8081/api.php/v1`. Use Content-Type: application/json,
Accept: application/json, App-Token and Session-Token as in the parent contract.

With illustrative current Setting version 2, parent A Computer 77 already linked
to B Computer 231 in route route-12, the exact Sync POST body is:

```json
{
  "input": {
    "work_id": "note-12-revision-1",
    "route_id": "route-12",
    "a_entities_id": 1,
    "entities_id": 12,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":77,\"b_items_id\":231,\"serial\":null}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 2,
    "handled_change_ids_json": "[]",
    "subject": "Note",
    "operation": "Sync",
    "note_json": "{\"a_notes_id\":12,\"b_notes_id\":null,\"content\":\"<p>Replaced battery</p>\",\"changed_at\":\"2026-10-28T10:00:00+08:00\",\"reliable\":true}"
  }
}
```

Use POST `<base>/PluginAgentbdmosassetsyncWork` with these headers:

```http
Content-Type: application/json
Accept: application/json
App-Token: <B_APP_TOKEN>
Session-Token: <B_SESSION_TOKEN>
```

Success uses the unchanged native `201 {"id":1234,"message":<native_message>}`
single-record wrapper; GET of that ID initially shows Accepted, null result and
null completion. A later Done/Held/Failed result is obtained by GET, not by a
custom callback. The API does not run this Note save inside the POST.

For the first Inventory page, use the same POST body with a fresh work_id,
operation `Inventory`, and note_json `"{\"after_id\":0,\"limit\":50}"`.
Subsequent pages use fresh Work IDs and the previous next_after_id. To edit a
paired Note later, use fresh work_id, the same a_notes_id and the verified
b_notes_id, new content and its actual genuine evidence. Duplicate work_id is
still rejected with `ASB_WORK_EXISTS: work_id=<id>` in the native error wrapper.

- POST `/PluginAgentbdmosassetsyncSetting`: include `notes_itemtypes_json` as a
  JSON string alongside the existing required Setting fields. Success is the
  unchanged native 201 ID/message wrapper.
- POST `/PluginAgentbdmosassetsyncWork`: include subject Note, operation
  Sync/Inventory and note_json as a JSON string alongside the existing required
  fields. Success is the unchanged native 201 ID/message wrapper with Accepted;
  no immediate Note mutation.
- GET `/PluginAgentbdmosassetsyncWork/<id>?get_hateoas=false`: unchanged 200
  record shape, with the Notes result JSON string after processing.
- GET `/PluginAgentbdmosassetsyncChange?searchText[subject]=%5ENote%24&searchText[status]=%5EPending%24&range=0-49&sort=id&order=ASC&get_hateoas=false`:
  standard collection response and range rules. Encode brackets in actual URLs.
- PUT `/PluginAgentbdmosassetsyncChange`: exact existing id/status
  acknowledgement and native per-record wrapper; no extra Note REST endpoint.

Unknown subject/operation or malformed note payloads use the parent's
`ASB_INVALID_FIELD: field=<field>` validation message inside the native wrapper.
Unsupported Notes Setting capability uses `ASB_UNSUPPORTED_ITEMTYPE: itemtype=<type>`.
B-owned fields remain rejected as before. Runtime Notes failures appear in
stored Work error/result or Pending Change error, never a custom HTTP envelope.
