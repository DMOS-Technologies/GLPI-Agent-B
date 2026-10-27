# AssetSync 2.0: GLPI B (Agent) Spec

**Scope:** this repo is ONLY the GLPI B (Agent) plugin. GLPI A (Controller) is a separate repo. Do not write controller code.

**This is a new project built from scratch.** There is no existing code to build on.

**Sources:** the two flowcharts (A-starts and B-starts) and "AssetSync End-to-End Guide" (21 Oct 2026), used as the design reference. Ignore the guide's "what works today" status, because it describes an older implementation. Where the sources disagree or are silent, see section 11 (Open Questions). Do not guess.

## Decisions already made

- **A reaches B only through GLPI's built-in REST API, on plugin records.** B adds no custom HTTP routes and no custom authentication. A creates, reads, and updates records that B's plugin defines. B's behavior comes from validation inside those record classes and from a background task.
- **All asset types must be supported by B.** The controller (A) chooses which asset types sync for each route. B never chooses. B only enforces the list of enabled types in its saved settings.
- **First-copy creation is required for the next release.**

---

## 1. Ground rules for B

1. **B is passive.** A sends every request. B never calls A. B keeps SQL tables, runs an `item_update` hook, and runs a background task.
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

## 2. What B stores (three plugin record types)

Exact class names, table names, field names, approved implementation decisions, and Sync/Suspend/Resume Work operations are defined in `docs/api-contract.md`. Use that contract for the REST wire schema.

### 2.1 Setting record (A writes)
- Entity Route (A entity to B entity), enabled asset types per route, enabled field mappings, per-field source (A / B / Both), and a settings version.
- Only A changes it. B never edits it.
- Work that does not match the current settings (version, route, entity, type, mapping) must not keep writing. Hold it with a visible status.

### 2.2 Work record (A creates, B completes)

**A writes, at creation only:** work ID (unique), route ID, A and B entities, asset type, asset identity (confirmed link, serial, or other permitted identifiers), mapped A values, A's change times, settings version, and optionally `handled_change_ids` (used for correction work).

**B writes:** status, result (B values A may apply, covered queue IDs, new B asset ID, per-field outcomes), error, timestamps.

- A reads the result later with a normal GET.
- The same work ID retried must not write again (see Open Question 15).

### 2.3 Change record (B creates, A acknowledges)
**B writes:** queue ID, route ID, settings version, asset type, serial and link IDs, changed fields and values, original per-field change time, status, retry count, error.

**A may write only one thing:** change status from Pending to Done, through the acknowledgement call.

- New row status: **Pending**.
- A row becomes **Done** only in two cases: A acknowledges it, or a successful correction work covers it.
- Failed or conflicted rows stay available for retry or review.
- Edits made after A reads a batch become new rows.
- One user save may produce separate native-field and Fields-plugin Change rows, each captured immediately for its genuine underlying storage save. The user approved this GLPI 11.0.7 compatibility rule; never defer a necessary capture to shutdown or mutate an already exposed snapshot.

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

The background task picks up Work records that are waiting, in a bounded batch. For each record:

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
6. **Save the result on the Work record** and mark the work complete only after the local save succeeds. The result includes:
   - B values that A may apply,
   - the queue IDs of Pending Change records that those values cover.
   Keep those Change records Pending until A acknowledges them.
7. **Correction work (B-starts flow):** same pipeline. It also carries `handled_change_ids`. Recheck route, type, mapping, and field times. Mark the covered Change records Done only after the update succeeds. If it fails, they stay Pending.

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
6. Each queued field stores the **original change time of the genuine edit**: the moment a person changed that field. Do not store a whole-asset timestamp, and do not store the time of a sync write.

---

## 6. Field rules (existing, linked asset)

| Source | Rule |
|---|---|
| **A** | B receives A's value. A stays unchanged, even if B was edited more recently. |
| **B** | B stays unchanged. A receives B's value (returned in the Work result). Starting the sync from A does not reverse this. |
| **Both** | The newer genuine field change wins. Compare per-field change times only. |

Additional rules:
- **Both, cannot decide:** values differ and change times are equal, missing, or unreliable. Keep both values unchanged and record a visible field conflict.
- **Values already match:** no write.
- **Unmapped fields:** unchanged.
- **Fields differ per asset type.** Write only mapped fields that exist on that asset type. A mapped field that does not exist or is not safely writable on that type is skipped with a visible reason (Open Question 11).
- **Dropdown mapped to text:** A sends the readable label, and B stores it as text.
- **Dropdown to dropdown:** B looks up the destination option itself, because IDs differ between A and B. Option not found means no write and a visible reason.
- **Text to dropdown:** required. B looks up the text as an exact, unique permitted local option and writes its B ID. No match or ambiguous match means no write and a visible reason; never create an option automatically.
- **Field support:** native fields and Fields-plugin custom fields. Each field kind needs explicit support. A field showing in GLPI search options is not proof it is safe to write. Unsupported enabled B mappings are rejected at Setting admission for explicit review/fix. A mapping becoming unavailable during normal-save capture is skipped and logged under section 5; it must not block GLPI saves or fabricate change evidence.
- **Mapped date/time values:** date uses `YYYY-MM-DD`; datetime uses `YYYY-MM-DD HH:MM:SS` already in the destination GLPI native convention. These values are separate from Brunei-offset genuine edit timestamps.

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

---

## 10. Foundations needed (build these first)

1. Plugin skeleton for the target GLPI version (Open Question 13), including install and uninstall.
2. The three record classes (Setting, Work, Change) with their SQL tables and GLPI profile rights.
3. Validation rules from section 3 inside the record classes (including "A may write only what A owns").
4. A function that reads the Setting record.
5. `markQueueRowsDone(ids)`: marks exactly those Change records Done and leaves all others unchanged.
6. Registration of an empty background task.
7. `docs/setup.md`: steps to enable the REST API on B and create the service account with the rights in section 3.

**Known hard areas (from the design guide):** reliable per-field change tracking for "Both", acknowledgements, asset creation, and large-scale testing.

---

## 11. Original questions and decision record

The original defaults below are retained for traceability. The user approved
the recommendations on 24 October 2026; `docs/api-contract.md` section 7 is the
current decision record and supersedes defaults where it provides an answer.

1. **ANSWERED:** correction work is a normal Work record with an optional `handled_change_ids` field.
2. **Status names.** Default: Work = Accepted, Done, Held, Failed. Change = Pending, Done. The contract step may refine them.
3. **Several edits to one field before A reads?** Default: one Change record per genuine save. No merging.
4. **ANSWERED:** genuine field evidence uses Brunei RFC 3339 `+08:00` timestamps; clocks are trusted. Compare instants. No manual-edit cooldown; equal/missing/unreliable differing values conflict. Native GLPI metadata follows its installed convention.
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
