# AssetSync 2.0: GLPI B (Agent) Spec

**Scope:** this repo is ONLY the GLPI B (Agent) plugin. GLPI A (Controller) is a separate repo. Do not write controller code.

**This is a new project built from scratch.** There is no existing code to build on.

**Sources:** the two flowcharts (A-starts and B-starts) and "AssetSync End-to-End Guide" (21 Oct 2026), used as the design reference. Ignore the guide's "what works today" status, because it describes an older implementation. Where the sources disagree or are silent, see section 11 (Open Questions). Do not guess.

The flowcharts remain the baseline asset flows. The approved native Notes
extension is specified in [docs/notes-contract.md](docs/notes-contract.md),
which extends [docs/api-contract.md](docs/api-contract.md). Notes are implemented
in version 0.2.0; bounded local Notes runtime evidence and remaining variants
are recorded in [docs/manual-tests.md](docs/manual-tests.md#native-notes-local-runtime-verification--28-october-2026).
The opt-in scalar field-isolation extension requires version 0.3.0 and the
additive upgrade; [docs/field-sync-contract.md](docs/field-sync-contract.md) is
normative. Its original FI source checklist is preserved as a historical plan;
the later local run covers representative regressions, not every FI variant.
Version 0.4.0 adds explicit version 2 scalar current-state reconciliation in
[docs/reconciliation-contract.md](docs/reconciliation-contract.md). The prior
Work stays immutable, including Unknown or damaged evidence; a distinct Work
can verify or repair the current state. A later authorized bounded local Docker
run records RC01–RC22 results and remaining variants in
[docs/manual-tests.md](docs/manual-tests.md#automatic-scalar-reconciliation-local-runtime-verification--29-october-2026).
The original source-only FI/RC checklists remain historical plans, not claims
that every variant or Controller A integration has passed.
Version 0.4.1 adds binding continuity and first-copy current-value provenance
under [API section 5.6](docs/api-contract.md#56-scalar-genuine-evidence-across-setting-versions-041),
without new wire keys. Its authorized
[local runtime ledger](docs/manual-tests.md#mapping-version-and-first-copy-local-runtime-verification--29-october-2026)
records twelve MV passes, four partial cases and eight direct first-copy passes,
with clone fault checks distinguished from localhost:8081 and explicit remaining
limits. B-only verification does not certify Controller A integration.

## Decisions already made

The local patch after 0.6.0 commit `61795e5` implements the approved scalar
text blank rule: SQL NULL and exact empty string mean the same unfilled value
for supported concrete text metadata. After permitted locked current reads,
A/B/Both two-blank pairs are AlreadyEqual, with VerifiedEqual on v1/v2, before
History or writes. Source B requires a supplied A blank; omitted input retains
ordinary ReturnToA. No B tuple, timestamp, nullable writer or stored replacement
is invented. Nonempty text/whitespace, other scalar kinds, Notes, exact save
verification and immutable whole-snapshot/ACK identity remain unchanged. This
local build is not the original 0.6.0 release. It is deployed only to localhost;
the bounded BT runtime results and remaining variants are recorded in
[the manual ledger](docs/manual-tests.md#blank-text-localhost-deployment-and-bt-runtime--31-october-2026). [The precise contract](docs/history-contract.md#blank-text-comparison--local-patch-after-060)
defines Controller A returned-value and snapshot-accounting requirements.

Version 0.6.0 uses native field-specific GLPI History time for scalar comparison,
regardless of who or what wrote the field. The later time wins; a side with
confirmed History wins over one without it. Both absent or tied different values
remain unresolved. This explicitly supersedes genuine-human/copy-provenance
timestamp arbitration, while leaving durable save certainty, sync capture
suppression and exact acknowledgement rules intact. See
[docs/history-contract.md](docs/history-contract.md). The authorized localhost
deployment has administrative preservation/readback evidence; functional H01–H12
are NOT RUN. No Controller A code changes were performed.

Version 0.5.2 separates lifecycle binding metadata initialization from asset-write
permissions and adds explicit unavailable-binding diagnostics. Its controlled
offline upgrade can establish fresh missing bindings, preserving valid existing
ones and all historical evidence without certifying old values. No worker or
human-save hook repairs configuration implicitly. Current genuine evidence is
still required after repair. The user will perform the new manual sync checks;
installation/readback is not an integration pass.

Version 0.5.1 adds an optional
[controlled offline upgrade](docs/upgrade-continuity.md) for unchanged compatible
current evidence. Positive runtime/database fencing and live guard verification
are required. Ordinary activation, real disable/capture gaps and unknown
completion still invalidate or block trust. Existing invalid history is never
retroactively certified, and no A wire change or human-save blocking is added.

The optional 0.5.0 A→B participation extension is specified in
[docs/participation-contract.md](docs/participation-contract.md). A selects two
actual B boolean targets per route/parent type, independently of scalar mappings,
and explicitly opts an A→B Asset Sync Work into marker processing. B sets Yes
only after ordinary processing establishes a verified permitted parent and
durable completion, including AlreadyEqual/independent scalar failures. Flags
never mean whole-asset success, never reset to No, never acknowledge Changes and
never create false human evidence. Non-opted requests, Notes and controls retain
existing behavior. This remains a candidate; its authorized
[local PF ledger](docs/manual-tests.md#optional-participation-flags-local-runtime-verification--29-october-2026)
records actual verification outcomes and remaining gaps, not Controller A readiness.

- **A reaches B only through GLPI's built-in REST API, on plugin records.** B adds no custom HTTP routes and no custom authentication. A creates, reads, and updates records that B's plugin defines. B's behavior comes from validation inside those record classes and from a background task.
- **All asset types must be supported by B.** The controller (A) chooses which asset types sync for each route. B never chooses. B only enforces the list of enabled types in its saved settings.
- **First-copy creation is required for the next release.**

---

## 1. Ground rules for B

1. **B is passive.** A sends every request. B never calls A. B keeps SQL tables, observes asset and native Notepad saves, and runs a background task.
2. **Accepted is not synced.** A successful POST of a work record only means B saved the request. It does not mean any asset changed.
3. **Heavy work runs in the background task**, not inside the REST request.
4. **Inside B, use GLPI's own local methods** (find, `add()`, `update()`). B makes no REST calls to itself.
5. **Verify every write.** After `add()` or `update()`, reread the saved values and confirm them. An HTTP success is not proof.
6. **Writes go through `add()` / `update()`** so GLPI creates normal History entries.
7. **Never guess.** Missing, ambiguous, or unreliable evidence means: change nothing, record a visible status and reason.
8. **Never delete, archive, clear, or move an asset automatically.**
9. **Loop guard:** changes B makes itself while syncing must never be queued as new changes for A.
10. **Respect B's service account permissions.** If a write is not permitted, reject that work with a visible reason.
11. **A timeout means the outcome is unknown**, not that nothing happened. Work IDs must make retries safe (no repeated writes, no duplicate assets).
12. **One generic code path for all asset types.** The asset type is data (GLPI's item type name), not a class. No per-type classes and no per-type switch statements. Which types are active comes only from the settings copy.
13. **No custom HTTP routes.** Everything A does is a standard REST call on a plugin record.
14. **A may write only what A owns.** The record classes must reject any attempt by A to write a B-owned field (status, result, error) or to change a record in a way not allowed in section 3.

---

## 2. What B stores (three public plugin record types)

Exact class names, table names, field names, approved implementation decisions, and Sync/Suspend/Resume Work operations are defined in `docs/api-contract.md`. Use that contract for the REST wire schema.

The Notes extension retains exactly these three public record types. The
approved fourth SQL table, `glpi_plugin_agentbdmosassetsync_notelinks`, stores
only B-owned Note associations, reservations and value evidence. It has no
public API itemtype and does not duplicate complete Note bodies.

### 2.1 Setting record (A writes)
- Entity Route (A entity to B entity), enabled asset types per route, enabled field mappings, per-field source (A / B / Both), and a settings version.
- Only A changes it. B never edits it.
- Work that does not match the current settings (version, route, entity, type, mapping) must not keep writing. Hold it with a visible status.
- `notes_itemtypes_json` separately opts enabled parent types into native Notes.
  It defaults to `[]`; omitting it from a replacement preserves the selection.
  Selection requires native Notes capability and parent READ, READNOTE and
  UPDATENOTE rights. The plugin never enables GLPI Notes capabilities itself.

### 2.2 Work record (A creates, B completes)

**A writes, at creation only:** work ID (unique), route ID, A and B entities, asset type, asset identity (confirmed link, serial, or other permitted identifiers), mapped A values, A's change times, settings version, and optionally `handled_change_ids` (used for correction work).

**B writes:** status, result (B values A may apply, covered queue IDs, new B asset ID, per-field outcomes), error, timestamps.

- A reads the result later with a normal GET.
- The same work ID retried must not write again (see Open Question 15).
- `subject` defaults to `Asset`. Subject `Note` carries its own `note_json`,
  empty scalar values/times objects, and operation `Sync` or `Inventory`.
  Suspend/Resume remain Asset-only. A Note Work requires a verified existing
  Asset link and never creates, links or resumes the parent asset.
- A may create a new linked Asset Sync Work with non-null `field_sync_json`
  to request versioned explicit field selection and structured certainty.
  The exact request is immutable and hidden from native raw-row GET fields;
  its parsed selection is echoed in opted-in results. Omission/null keeps the
  legacy request and result shapes. There is no update/reset/replay operation.

### 2.3 Change record (B creates, A acknowledges)
**B writes:** queue ID, route ID, settings version, asset type, serial and link IDs, changed fields and values, original per-field change time, status, retry count, error.

**A may write only one thing:** change status from Pending to Done, through the acknowledgement call.

- New row status: **Pending**.
- A row becomes **Done** only in two cases: A acknowledges it, or a successful correction work covers it.
- Failed or conflicted rows stay available for retry or review.
- Edits made after A reads a batch become new rows.
- One user save may produce separate native-field and Fields-plugin Change rows, each captured immediately for its genuine underlying storage save. The user approved this GLPI 11.0.7 compatibility rule; never defer a necessary capture to shutdown or mutate an already exposed snapshot.
- A Note Change has subject `Note`, empty `changed_fields_json`, and an immutable
  per-note `note_json` snapshot. Its ordinary identity/entity columns identify
  the parent. Acknowledgement remains exactly `id` and `status`.

---

## 3. How A talks to B (GLPI REST API on plugin records)

All calls use HTTPS. A logs in with GLPI's standard session login (app token plus the service account's user token) and sends the session token on every call. The service account is a normal GLPI user whose profile has only the rights below.

| Purpose | A's REST call | What B does |
|---|---|---|
| Login | Standard GLPI session login | Standard GLPI. Nothing custom. |
| Settings write | Create or update a **Setting** record | Validate. Reject a settings version older than or equal to the stored one (Open Question 16). Save. |
| POST work batch | Create **Work** records (bulk input) | Validate every record (required fields, unique work ID, no B-owned fields, asset type is a string). Save with the initial status. Do nothing heavy. |
| GET work result | Read **Work** records (by work ID or status) | Nothing custom. Return the stored status and result. |
| GET change batch | Search **Change** records with status Pending, using the API's range for batching | Nothing custom. Return rows with their exact IDs. |
| PUT acknowledgements | Update **Change** records (bulk input of IDs with status Done) | Allow ONLY Pending to Done. Reject any other field or status change. Return the standard per-record result in the same HTTP response. |

**Correction work** (B-starts flow) is a normal Work record that also carries `handled_change_ids`.

**Profile rights for A's service account:**
- Setting: create, read, update
- Work: create, read
- Change: read, update
- No delete or purge on anything

Verify in the target GLPI version that plugin classes are exposed through the built-in REST API this way (Open Question 13).

---

## 4. Inbound: processing work from A (background task)

The background task picks up Work records that are waiting, in a bounded batch.
The following steps describe subject Asset; subject Note follows section 6.1
and the Notes contract. For each Asset record:

1. **Check against the settings copy:** settings version, route, target B entity, and whether the asset type is enabled for this route. Mismatch or unknown type means hold with a visible status. Do not write.
2. **Only use mapped fields** that are enabled in the saved mapping. Ignore everything else in the work.
3. **Find the asset in the routed B entity:**
   - Confirmed link exists: use it. If the linked asset is in the wrong entity for the route, hold and report a scope mismatch.
   - No link: do a complete, unambiguous match by permitted identifiers (serial, etc.). Use only identifiers that this asset type actually has. If the type has none available and there is no link, hold. Do not create.
   - Lookup failed, permission denied, or duplicate matches: hold and report. This is **never** permission to create.
   - Complete check finds nothing: go to first copy (step 5).
4. **Existing asset:** apply the per-field rules (section 6) with local `update()`, then reread and verify.
5. **First copy (new B asset only):**
   - Local `add()` in the routed B entity with the allowed asset type.
   - Copy all enabled mapped A fields once, ignoring per-field source.
   - Save the new B ID, confirm the link, verify values.
   - If the creation outcome is uncertain, keep it visible. Never blindly create again.
   - Initialize current-value Copied provenance in the same checked transaction
     after verified native values and the durable association/field receipt.
     Preserve reliable original A times; missing evidence stays unreliable.
     Trust first-copy proof only after final Done, never from an interrupted
     provisional receipt. Sync copies create no human Change.
   - A durable creation marker prevents a fresh Work ID bypassing an earlier
     unassociated uncertain creation. Keep supported restart Held/readback;
     no old Work backfill, automatic reopen or duplicate creation. See API 5.6
     for exact existing error-field machine categories and historical limits.
6. **Save the result on the Work record** and mark the work complete only after the local save succeeds. The result includes:
   - B values that A may apply,
   - the queue IDs of Pending Change records that those values cover.
   Keep those Change records Pending until A acknowledges them.
7. **Correction work (B-starts flow):** same pipeline. It also carries `handled_change_ids`. Recheck route, type, mapping, and field times. Mark the covered Change records Done only after the update succeeds. If it fails, they stay Pending.

### 4.1 Explicit scalar selection and durable certainty (opt in)

Only an already-linked asset with a verified retained Active relationship may
use `field_sync_json={"version":1,"mapping_ids":[...]}` (encoded as an outer
JSON string). IDs refer to enabled mappings for the exact route, itemtype and
current settings version. Empty selection processes no mapped fields but still
checks account, parent and scope. Values/times outside the selection reject.
The property is forbidden on Notes and Suspend/Resume; it cannot first-copy,
serial-match, relink, resume or move an asset. Without it, all legacy omission
and processing rules above remain unchanged.

An excluded mapping is not explicitly described, read, converted, arbitrated,
returned or written, regardless of A/B/Both source. It remains configured and
is not cleared. Selected A/Both mappings missing a value receive a structured
prewrite rejection; selected siblings can still proceed. Both timestamp handling
follows the 0.6.0 History policy (or genuine-only rules on older versions).
Supported explicit scalar null
clears remain distinct from omission/exclusion; dropdown null/empty is rejected.

Opted-in field outcomes identify a prewrite rejection (`NotAttempted`), verified
save (`VerifiedApplied`), equal no-write observation (`VerifiedEqual`) or possible
mutation/completion uncertainty (`Unknown`) without parsing prose. Under the
dedicated-CLI boundary below, B commits an
in-flight mapping marker before mutation and atomically stores provisional
verified evidence with the field on supported transactional storage. Commit,
rollback, journal or lock-release uncertainty stays durable and Holds the Work;
it never turns into a claim that no writer was called after restart. Verified
siblings are preserved. Native save methods and the sync guard remain mandatory;
ordinary human-save capture is unchanged and non-blocking.
An unreadable/missing started journal is retained unchanged; B Holds with
`ASB_FIELD_JOURNAL_UNREADABLE`, without fabricating prior per-field outcomes.
Its selected fields require reconciliation, not automatic catch-up.
That restriction describes version 1 recovery; section 4.2 defines the separate
version 2 current-state operation after this Work becomes terminal.
Opted-in metadata/snapshot work stops if its transaction boundary becomes
uncertain; same-connection uncommitted readback is never durable evidence.
Atomicity assumes a fresh dedicated `php front/cron.php processWork` invocation,
source-verified to have no native outer transaction, and supported native
behavior. Generic reused cron connections and third-party hooks leaving
transactions open are not proven clean through public GLPI APIs. No portable
ambient-transaction guard is implemented, nor is independently committed-marker
durability promised for arbitrary ambient transactions.

Change snapshots remain whole snapshots. One containing an excluded mapping
stays Pending with its attempt count unchanged; selected siblings may proceed,
but that Work is Held and cannot acknowledge the unresolved mixed snapshot.
Other invalid handled IDs Hold before mapped mutation. No field failure,
selection or HTTP success substitutes for exact complete-snapshot coverage.

After the original Work is terminal, its mapping is Rejected/NotAttempted,
current scope is valid and the actual cause is repaired, A may submit a distinct
Work with fresh current values and genuine evidence. Accepted/Pending is not
permission for concurrent catch-up. Unknown outcomes require reconciliation
first; B does not automatically retry or reopen Held/Failed Work. Existing REST
Work readback exposes stored journal/verified siblings but cannot prove every
native-hook effect. Native storage loads may physically include excluded columns,
and hooks may change sibling fields. The new Fields writer uses selected-only
partial updates on existing generated storage, never a merged-container save or
implicit storage creation. See the extension for precise limits and examples.

### 4.2 Automatic scalar current-state reconciliation (version 2)

A may submit a new linked Asset Sync Work with the JSON-string option
`field_sync_json={"version":2,"mapping_ids":[...],"reconcile_work_id":401}`.
The reference is the B row ID of a readable terminal Done/Held/Failed Asset Sync
Work for the same route, itemtype, A/B entities and original positive A/B asset
identity. Its immutable request must establish an existing B link; a first-copy
request with null B ID, serial-only adoption, Notes, controls and Accepted Work
cannot authorize this path. The old result may be missing or damaged. B must
not repair, reinterpret or replace its payload, result, status or history.

The new Work validates the current Setting and its enabled selected mappings;
the old settings version may be older after repair but cannot exceed the new
request's version. The reference records
lineage, never authority to reuse stale values, old field bindings or old edit
times. A supplies fresh current intent and the current policy's field timestamps. There
is no B field named source_timestamp or parent_change_id, and a whole asset's
date_mod or reconciliation time must never replace a field-specific timestamp.

B rechecks the terminal reference and retained Active link in the worker, then
compares only selected live values under the normal locks. A-owned differences
may be saved, B-owned values return to A, and Both uses the 0.6.0 History
policy (genuine-only evidence on older versions). Equal values require no native save. Structured outcomes describe
this new operation only; VerifiedEqual now is not proof that the old Work
succeeded or that every prior native-hook effect is resolved. A records incidents
and schedules further fresh attempts; B adds no orchestration or callback.

Version 2 owns a new configured database object/session for its work and restores
the original global connection afterward. The original connection retains the
worker lock; B does not close/reopen it or rollback unrelated work. Independent
committed visibility checks use a fresh native observer per check, an advisory
challenge verifies the same backend, and worker-lock ownership is rechecked.
An interrupted version 2 Work crosses the route-lock barrier before B Holds it,
so an earlier owned writer cannot still mutate after terminal evidence appears.
Another Accepted Asset Work in the same pair/route/type causes RECONCILE_PENDING;
invalid reference identity/scope/version causes RECONCILE_SCOPE. Uncertain
native save, commit, observation or cleanup must retain uncertainty and stop
further selected writes. This version-specific mechanism does not change the
version 1 execution precondition or promise universal hook side-effect rollback.

A can durably account for exact snapshot fields/revisions across separate
targeted Works, then acknowledge the entire exact Change ID after all are safely
handled. ReturnToA requires A's own verified handling. B's correction path does
not merge partial Work receipts; a mixed excluded/unresolved snapshot remains
Pending. The existing id/status acknowledgement trusts A's completed handling
and cannot independently prove A's saves. No partial-row acknowledgement is added.

Legacy, version 1, Notes, first-copy and Suspend/Resume keep their previous
paths. Supported explicit clears and selected-only Fields writes are unchanged;
null is not a universal clear. Read the normative reconciliation contract for
the exact wire/result schemas, safe conditions and remaining verification limits.

---

## 5. Outbound: capturing B edits (`item_update` hook)

**Normal-save decision, 27 October 2026:** capture is observational. Agent B
must not rewrite GLPI/Fields save inputs, reject a normal save, or replace
GLPI's own validation. Before-save hooks keep read-only snapshots; post-save
capture queues only verified supported values. Unsupported/unreadable values
are skipped and logged with their route/mapping in GLPI's existing PHP log;
valid sibling fields can still queue. Route/identity or queue persistence
failures are logged without interrupting the save or retrying automatically.
No empty/error-only Change or invented field evidence is created. Omitted
edits require manual review/reconciliation; successful asset saves do not
guarantee complete capture. Setting admission and Work processing stay strict.

GLPI registers plugin hooks per asset type. Register the hook for every supported asset type (verify how in the installed GLPI version). Then:

1. **First, a cheap local check:** is this asset type enabled in the settings copy? No: stop. This runs on every asset edit in B, so it must read only local data and make no network calls.
2. If the change was made by sync, stop (loop guard).
3. Is the asset in a routed B entity? No: stop.
4. Queue only changes to **enabled mapped fields**. Queue an edit to an A-owned field too, because B may need correcting.
5. Nothing eligible: stop. Create no Change record.
6. Each queued field stores its underlying save time, never a whole-asset timestamp. Scalar 0.6.0 capture uses the same native GLPI session clock as History, converted to +08:00; actual History is read separately for arbitration. Sync-origin suppression above still prevents feedback Changes. Older scalar captures used a separate genuine-save clock; historical rows are unchanged.

---

## 6. Field rules (existing, linked asset)

| Source | Rule |
|---|---|
| **A** | B receives A's value. A stays unchanged, even if B was edited more recently. |
| **B** | B stays unchanged. A receives B's value (returned in the Work result). Starting the sync from A does not reverse this. |
| **Both** | On B >=0.6.0 compare native field History, regardless of actor: newer wins, or the only side with History wins. Earlier versions compare genuine-edit evidence. |

Additional rules:
- **Both, cannot decide:** on 0.6.0 values differ and both History times are absent or tied. Keep both values unchanged and record a visible conflict. Unreadable History is an error, not absence. Older versions also conflict on one-sided missing genuine evidence.
- **Historical provenance (0.4.1–0.5.2, retained for receipts/recovery):** preserve reliable original
  scalar evidence across an unchanged continuously enabled mapping using actual
  binding identity, route/typed-parent/entity scope and internal continuity
  metadata. A version increase alone must not discard a newer genuine edit.
  Changed selectors/authority/conversion/definitions and disabled/capture gaps
  must not inherit old proof. Current-value/copied provenance is distinct from
  immutable local human Change history; sync/equality/publication never creates
  a human edit. Decide using fresh locked values. Old matching values alone
  cannot backfill missing provenance. See API section 5.6 for the additive
  upgrade, exact boundaries and recorded MV manual results; no wire key changes.
- **Values already match:** no write.
- **Unmapped fields:** unchanged.
- **Fields differ per asset type.** Write only mapped fields that exist on that asset type. A mapped field that does not exist or is not safely writable on that type is skipped with a visible reason (Open Question 11).
- **Dropdown mapped to text:** A sends the readable label, and B stores it as text.
- **Dropdown to dropdown:** B looks up the destination option itself, because IDs differ between A and B. Option not found means no write and a visible reason.
- **Text to dropdown:** required. B looks up the text as an exact, unique permitted local option and writes its B ID. No match or ambiguous match means no write and a visible reason; never create an option automatically.
- **Field support:** native fields and Fields-plugin custom fields. Each field kind needs explicit support. A field showing in GLPI search options is not proof it is safe to write. Unsupported enabled B mappings are rejected at Setting admission for explicit review/fix. A mapping becoming unavailable during normal-save capture is skipped and logged under section 5; it must not block GLPI saves or fabricate change evidence.
- **Mapped date/time values:** date uses `YYYY-MM-DD`; datetime uses `YYYY-MM-DD HH:MM:SS` already in the destination GLPI native convention. These values are separate from Brunei-offset genuine edit timestamps.

### 6.1 Native Notes

Existing notes, newly added notes and later content edits use one generic native
Notepad path for all selected capable parent types. Notes are text and formatting,
separate from scalar field mappings. Each durable A/B Note pair uses Both
authority: newer reliable genuine per-note evidence wins; differing values with
equal, missing or unreliable times Hold. Historical native dates alone are not
reliable human-edit evidence. Copied-value evidence remains separate from B's
last genuine local content edit.

An existing association fixes the Note's parent and identity. For initial pairing,
an exact same-parent content match is linked without updating its content. A
unique unpaired match is required; ambiguous, denied or incomplete matching Holds.
Only a complete zero-match lookup permits a reserved creation. Missing linked
notes or uncertain creation never permit blind recreation through a fresh Work
ID. Empty content is an edit, not deletion. Inventory provides bounded live
keyset backfill; normal capture must be enabled before inventory begins.

Genuine native Notepad additions/content edits queue immutable snapshots per
eligible route; metadata-only edits and sync writes do not. Capture is passive
and non-blocking. Embedded files/media and native document references are
unsupported: skip/log capture, skip Inventory rows, or Hold Sync. Preserve
formatting and ordinary hyperlinks; never fetch files or silently strip content.
Local writes use the actual local author/updater, preserve existing visibility,
and use visibility 0 for new copies. No reparenting, author/date spoofing or
automatic deletion is permitted.

Before enabling Notes, A must understand/filter `subject`; older Asset consumers
must explicitly filter Asset rows. A settings version alone does not negotiate
client capability. See the Notes contract for exact input/result shapes,
per-note coverage and acknowledgements. This repository implements only B.

---

## 7. Transfers and scope (B's side only)

- B never moves, deletes, or archives assets because A transferred something.
- If an A asset leaves scope for this connection: stop updates in both directions. Keep the old B copy, its link, and its sync evidence.
- Recheck pending work against the current settings before each write. A write that already completed cannot be undone.
- Asset returns to the same client later: verify and reuse the existing link. Do not create another copy. Do not repeat first-copy seeding.
- Existing linked B asset in the wrong entity for a route: hold, report scope mismatch. **Automatic B-entity transfer is not supported.** Do not silently move, relink, or duplicate.

---

## 8. Failures and visibility

- Unavailable server, stale work, permission failure, conflict, scope mismatch, and settings mismatch must stay visible with a reason.
- A retry of the same work ID must not repeat a completed write.
- Unclear matches and failures stay available for retry or checking.

---

## 9. Non-goals (YAGNI)

- No A-side code, no billing calculations, no UUID/billing integration unless explicitly asked.
- No outbound HTTP from B.
- No custom HTTP routes and no custom authentication.
- No automatic deletion, archiving, clearing, or B-entity transfer.
- No per-asset-type classes or switch statements.
- No new log files, no cleanup jobs for Done rows, no extra abstraction layers.
- No native Note file/media transfer, reparenting, remote-author impersonation
  or automatic Note deletion.

---

## 10. Foundations needed (build these first)

1. Plugin skeleton for the target GLPI version (Open Question 13), including install and uninstall.
2. The three public record classes (Setting, Work, Change), their SQL tables and GLPI profile rights, plus the approved internal Note-association table.
3. Validation rules from section 3 inside the record classes (including "A may write only what A owns").
4. A function that reads the Setting record.
5. `markQueueRowsDone(ids)`: marks exactly those Change records Done and leaves all others unchanged.
6. Registration of an empty background task.
7. `docs/setup.md`: steps to enable the REST API on B and create the service account with the rights in section 3.

Version 0.2.0 adds Notes through an additive installation/upgrade: retained
Work/Change payloads remain unchanged, existing rows default to Asset, and Notes
remain disabled in Settings. An administrator must perform the GLPI plugin
upgrade before enabling Notes. The later local 0.2.0 Notes run is recorded in the
manual ledger with bounded PASS/PARTIAL coverage. Version 0.3.0 adds nullable
Work `field_sync_json` without rewriting existing payloads; omission/null retains
legacy behavior. Its source implementation has not run installation, upgrade or
runtime verification at the original 0.3.0 implementation stage; the later
0.4.0 runtime ledger records the bounded upgrade and representative checks.
Version 0.4.0 reuses the hidden field_sync_json column for explicit version 2
reconciliation; no new schema column, record type, profile right or Work status
is added. Its bounded local runtime ledger includes owned-session processing
and fresh catch-up checks, with remaining variants and actual A/B integration
still unverified. No real-environment deployment follows from that local run.

**Known hard areas (from the design guide):** reliable per-field change tracking for "Both", acknowledgements, asset creation, and large-scale testing.

---

## 11. Original questions and decision record

The original defaults below are retained for traceability. The user approved
the recommendations on 24 October 2026; `docs/api-contract.md` section 7 is the
current decision record and supersedes defaults where it provides an answer.

1. **ANSWERED:** correction work is a normal Work record with an optional `handled_change_ids` field.
2. **Status names.** Default: Work = Accepted, Done, Held, Failed. Change = Pending, Done. The contract step may refine them.
3. **Several edits to one field before A reads?** Default: one Change record per genuine save. No merging.
4. **ANSWERED:** field timestamps use Brunei RFC3339 `+08:00`; clocks are trusted and there is no edit cooldown. Scalar 0.6.0 uses actor-independent field History with one-sided fallback; both absent/tied different values conflict. Older scalar versions and Notes retain their genuine-edit policy. Native GLPI metadata follows its installed convention.
5. **ANSWERED:** all asset types must be supported. The controller selects which types sync.
6. **ANSWERED:** first-copy creation is required for the next release.
7. **Settings version mismatch on arriving work.** Default: hold with a visible status. Do not write.
8. **Fields plugin on every customer B?** Default: custom field support only when the Fields plugin is installed. Otherwise reject visibly.
9. **Permitted identifiers for matching** besides confirmed link and serial. Default: link first, then serial. Nothing else.
10. **Cleanup of old Done rows.** Default: none (YAGNI).
11. **A mapping names a field the asset type does not have.** Default: skip that field with a visible reason and process the rest of the work.
12. **Does "all asset types" include GLPI 11 custom assets or non-core types?** Default: GLPI's core asset types only.
13. **Which GLPI version(s) must B support?** Plugin structure and the REST API differ between GLPI 10 and 11, and exposing plugin records through the built-in API must be checked in that version. **You decide.**
14. **Plugin name, directory name, and code namespace.** **You decide.** A needs these to build its REST URLs.
15. **Duplicate work ID on POST.** Default: reject it with a clear "already exists" error. A then reads the existing record.
16. **Stale settings version on write.** Default: reject a version that is not higher than the stored one.
