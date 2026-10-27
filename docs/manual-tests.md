# GLPI B manual curl review checklist

## Execution status and review boundary

Prepared for `Agent-B-DMOS-AssetSync`, installed key `agentbdmosassetsync`.
Target supplied by the build coordinator: Docker `assetsync2-glpib`, GLPI
**11.0.7**, development origin `http://localhost:8081`. Only the new plugin
resources below are in scope. Ignore OLD AssetSync plugins/resources.
Production transport must use HTTPS; localhost HTTP is the supplied isolated
review target. No curl or runtime case in this checklist has been executed by the reviewer.
Foundation and completed admission/capture/worker/acknowledgement parts were
source reviewed and their scoped operator evidence reviewed as recorded below.
Final Both source and scoped runtime evidence are reviewed. Historical
findings and unrun variants are preserved. The additional R0/R1/R2 review
found a **P2 Fields status-readonly diagnostic defect**. The user-authorized
narrow fix and affected RF retest now supersede that failure for the exercised
A/Both/correction paths; Work173 and its original failure remain historical.
Other pilot-critical gaps below remain open.

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
| Foundation installation, rights, Setting validation | Reviewed and exercised | Preserved foundation results/ledger below |
| Background matching, writes, recovery | Worker, first copy and bounded R1/R2 cases reviewed/exercised | Historical IB/IC/ID/IE passes retained; R1 interruptions/recovery and R2 current authorization pass within their exact boundaries; critical unrun fault/race limits remain |
| Edit capture, field evidence, acknowledgements | Capture, acknowledgement and bounded failure/scope evidence reviewed | OC/OB history retained; R1 real queue INSERT denial and R2 moved-scope rejection/date captures proved; further fault/metadata variants remain unrun |
| Native/Fields scalars and dropdown conversions | Representative metadata, conversions, dates and physical DECIMAL exercised | R2 adds real DECIMAL/hierarchy/custom History evidence; historical readonly diagnostic FAIL superseded by bounded RF fix PASS; exhaustive type/field coverage NOT RUN |
| Full flow and generic/custom-type evidence | Integrated representative B workflows source/evidence reviewed | A implementation/exhaustive installed-type proof NOT RUN |

The runtime operator executes relevant cases once per completed candidate.
The reviewer reads that complete candidate's diff once, then inspects the
operator's redacted evidence. Record failures without broadening the task.
Earlier implementation-stage checklists did not authorize automated tests,
shell test harnesses, arbitrary database mutation, delete/purge, uninstall or
cleanup. For the current R0/R1/R2 readiness pass, the user authorized disposable
fixtures through normal GLPI native/API methods and bounded process-local
failure injection. This does not authorize raw destructive database commands,
delete/purge/uninstall, product edits, new test software or a reusable harness.
The reviewer performs evidence review/docs only and makes no commits this pass.

## Passive normal-save capture — 27 October 2026

The user explicitly required Agent B to leave normal GLPI/Fields saves alone,
including saves containing an empty or unreadable mapped dropdown. This decision
supersedes the earlier capture-preflight rejection expectations in CF07–CF08,
LCF06–LCF07, NLN08, OC08/OC11/OC13 and BR05. Their original observations below
remain historical evidence; they are not the current expected save behavior.
Setting admission, Work processing/recovery, Change schemas and acknowledgement
rules are unchanged. Works 1–7 and all pre-existing Work/Change records are
protected during this local verification.

The completed source diff was reviewed once. `capture_before()` now takes a
read-only snapshot without mapping validation or input assignments, and capture
no longer forces hook ordering. `capture_after()` isolates capture exceptions;
`capture_collect()` logs/omits unavailable field values while retaining verified
siblings; `capture_flush()` logs individual route persistence failures without
retrying or rejecting the GLPI save. Capture normalization uses copies and an
independent storage reread. The strict `field_value()` validator is unchanged;
the follow-up `field_read()` adjustment described below normalizes only actual
nullable Fields date/datetime/number `''` clears on a local value copy.
No demonstrated P1/P2 defect was found in that initial source review. The
subsequent runtime pass exposed a cleared-Fields readback compatibility issue,
which was corrected by the narrow read follow-up and verified below. Native
browser, standalone Fields/native-method and protected-record checks are now
complete for the bounded cases recorded here.

Standalone target: `assetsync2-glpib`, GLPI 11.0.7/Fields 1.24.4. One new
disposable Computer **232** in entity **11** uses existing Fields container
**14** (`localcfreview`), storage row **4**, Setting **33** and route
`local-capture-review-20261027`. No existing asset, mapping or container
configuration was changed by this operator. Manual invocations used the normal
Fields `updateFieldsValues()` / native `Computer::update()` lifecycle, with
independent storage/Change readbacks; they were not direct calls to capture
helpers or claims about browser POSTs.

Skipped mappings appear as `ASB_CAPTURE_SKIPPED` in GLPI's existing
`php-errors.log`, with stage, itemtype, asset, route and mapping when available.
There is no invented dropdown label, empty/error-only Change or new failure
resource. A snapshot covers only the fields actually captured in that row;
omitted edits or a failed queue INSERT require manual reconciliation. A normal
GLPI success response does not prove complete capture.

| Case | Manual verification | Actual result |
|---|---|---|
| PS01 — native form with empty mappings | Use the actual localhost native Computer tab. Save an unrelated field with empty mapped date, number and dropdown, then save unchanged. Check normal response, exact storage and no spurious Change. | PASS browser on Computer **231**, entity **12**/container **15**/Setting **34**: normal native form saves with blank mappings returned the normal success alert. Unrelated and unchanged repeats added no Change. A preparation number clear was separately captured as Change **99**, JSON null. |
| PS02 — standalone Fields empty mappings | Save unrelated/unchanged values through the normal Fields storage path with mapped empty dates/dropdown. B must introduce neither an exception nor an input rewrite. | PASS native methods: the new row saved all three dates as `''`, dropdown 0 and an unrelated text value, with no Change. Repeating it and editing an unmapped native contact both returned true with no Change. |
| PS03 — dropdown selection and clear | Save a valid positive option and read its captured label. Then change it to GLPI's empty ID 0 with a valid sibling edit. GLPI decides persistence; B logs/omits the uncapturable dropdown while the valid sibling may queue. | PASS standalone Fields: selecting option 2 produced readable `Laptop` in Change **100**. The 2→0 clear succeeded; Change **101** contained only three date clears, with the dropdown omitted and `ASB_CAPTURE_SKIPPED` logged for `cf_dropdown`. PASS native browser: valid selection entered Change **104** as `Laptop`; a later dropdown 1→0 and native comment edit in one save succeeded, producing only Change **107** for the comment. The standard log named asset 231/`local_native_dropdown` at stage `field`. No label/default/clear was fabricated. |
| PS04 — date/number set and clear | Populate mapped scalar fields, then explicitly clear them through normal GLPI/Fields methods/forms. Read actual persisted representations and exact JSON-null capture where supported. Arbitrary invalid values must not become capture nulls. | PASS standalone dates: `2026-11-20`, `2026-11-21` and `2026-11-20 12:34:56` saved exactly in Change **100**. Clearing them stored `''` and produced exactly three JSON nulls in Change **101**, with `2026-10-27T22:17:10+08:00` evidence. PASS native browser: Change **104** captured number 12.5/date `2026-10-28`/`Laptop`; Change **106** captured number/date clears as JSON null while Fields retained its own raw `''` representation. Native-method number comma `1,5`, zero and clear saved successfully as Changes **108**, **109**, **110**, respectively. |
| PS05 — genuine change/no duplicates | Repeat the same saved values and inspect exact queue IDs. A real subsequent edit produces its own immutable snapshot with genuine `+08:00` evidence; unchanged values produce none. | PASS standalone: repeating populated values and repeating clears each added no row. Genuine subsequent date/dropdown edits produced Change **103**, `2026-10-27T22:18:41+08:00`. Earlier rows stayed separate. Native browser populated/clear repeats also added no duplicate. |
| PS06 — genuine invalid input | Submit malformed dates/numbers and an absent dropdown option through the normal local methods. Record GLPI/Fields' actual return and storage behavior, without claiming these are browser-widget submissions. Agent B must not add a blocking capture exception or fabricate a value. | PASS bounded standalone Fields: `not-a-date`, datetime hour 25 and absent dropdown 987654 were accepted by Fields and remained exactly stored, with return true and no B exception. Only the valid sibling date `2026-11-22` entered Change **102**. Existing PHP log identified `cf_date1` invalid date, `cf_datetime` invalid datetime and `cf_dropdown` missing/unreadable option. These invalid values were restored through a guarded native save afterward. Native-method number `not-a-number` returned false from GLPI, left storage unchanged and raised no B exception. No invalid-to-null coercion was claimed. |
| PS07 — queue INSERT denial | For only the owned disposable asset/route, use the existing bounded process-local READ ONLY transaction injection. Restore the session to READ WRITE in `finally`. The native asset save survives, no false Change is reported, the standard log names queue capture failure, and a later same-request save proceeds. | PASS: actual Change INSERT denial was scoped to Computer 232/its route. First native comment save returned true/no exception and reread `Passive capture saved despite queue INSERT denial`; it created no Change. Existing PHP log recorded `ASB_CAPTURE_SKIPPED`, stage `queue`, asset 232, reason `RuntimeException`. After READ WRITE restoration in `finally`, the next same-request save returned true and only Change **105** captured `Passive capture next same-request save succeeded`, reliable `2026-10-27T22:19:20+08:00`. |
| PS08 — sync suppression | A guarded synthetic native/Fields save produces no feedback row; the guard is released and a subsequent genuine edit captures normally. No Work processor invocation is needed. | PASS standalone Fields: guarded valid date/dropdown restoration added no row and released the guard. The next genuine date `2026-12-02`/dropdown 2 save created only Change **103**. No Work was involved. |
| PS09 — protected records and deployment | Compare exact Works 1–7, all existing Works and pre-existing Changes before/after. Confirm deployed file hash/lint and both cron/old worker STOPPED. Do not retry, reset, resend, acknowledge or process existing records. | PASS: all **860** existing Works, Works **1–7**, and all **98** pre-existing Changes compared byte-identical before/after. Exactly **13 new Pending Changes 99–111** belong to Computers 231/232. The final native browser comment save returned a normal success alert and produced only Change **111**, `Passive Agent B final local native save verified`. Both deployed PHP files passed lint and matched the candidate hashes below. Apache stayed RUNNING; cron and old worker stayed STOPPED. |
| PS10 — shared read compatibility for GLPI-owned clears | Read actual nullable Fields date/datetime/number storage `''` through `field_read()` and verify JSON null. Confirm malformed values, native/text/dropdown cases retain their strict behavior. Do not process any Work as a substitute for this bounded read check. | PASS bounded read checks: Computer 231's actual Fields date/number descriptors returned null/null while raw storage remained `''`/`''`. Computer 232's actual Setting33 datetime selector returned null from raw `''`. Its scalar validator still rejected impossible date `2026-02-30` and number `not-a-number`; an actual empty dropdown read still rejected the absent selection. Native/text and non-nullable exclusions are source-reviewed; no full Work lifecycle was run. |

Manual readback only, if a native V1 session is already available (replace the
fixture ID and route with the operator's actual disposable values):

```sh
curl --silent --show-error --include \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" \
  -H "Session-Token: ${B_SESSION_TOKEN}" \
  "${B_V1_BASE}/Computer/${B_FIXTURE_ID}?get_hateoas=false"

curl --silent --show-error --include \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" \
  -H "Session-Token: ${B_SESSION_TOKEN}" \
  "${B_V1_BASE}/PluginAgentbdmosassetsyncChange?searchText%5Broute_id%5D=${B_FIXTURE_ROUTE}&range=0-49&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false"
```

These commands are a checklist, not executed results. No Work mutation or
Change acknowledgement is part of this pass. The real site's original request
and every GLPI/plugin version are outside this localhost verification; this
patch makes no claim to resolve existing recovery jobs.

The standalone operator created exactly five Pending rows **100, 101, 102,
103 and 105**, selected by Computer 232 identity because other local browser
checks ran concurrently. Final Fields row 4 has date1 `2026-12-02`, date2 `''`,
datetime `''`, dropdown 2 (`Laptop`), and the unrelated text retained. The
coordinator's native browser/method cases created **99, 104, 106–110** and the
final native comment check **111**. No Change was acknowledged.

Only the two reviewed runtime files were copied into
`/var/glpi/marketplace/agentbdmosassetsync/inc/`; each passed deployed PHP lint
and matched its local SHA-256:

- `capture.php`: `d8ba15cd74b7c1ede2d5ce28b5ab9ce8c18222217bd8974e2dbe1764b646dd8c`.
- `fields.php`: `b5bf1e4b91908bca0e7bcc7a7b1e13fdda5de55ecc177b6c4c1b6e79d54736b0`.

Installed plugin metadata remains **0.1.0**, as before this runtime-only patch;
the repository `setup.php` remains 0.1.2 and was not deployed by this pass.
No installation, migration, worker startup or real-environment operation took
place. The source change introduces no new tables, statuses or REST routes.

Protected snapshots were identical before and after. These fingerprints use
this pass's PHP JSON snapshots, retaining DB-iterator ID keys for whole-table
sets and `array_values` for Works 1–7; they are not a comparison with older
ledgers' different serialization formats:

- All 860 existing Works: `1ba8f78565a8804bbdb0a82973495986ad0ea6f9f5798b57fef61e5b236998ef`.
- Works 1–7: `3539e76a6c0d0dcc6baeb5fd1595dd309eaa937da2c0632a773a05aa00211f4c`.
- Existing Changes 1–98: `37cd761214f85cdc11c623b1b320d4dcc84e6259f64db675768d3cddc3a28903`.

Verification-discovered read boundary: GLPI/Fields stores a valid local date
clear as `''` now that B no longer rewrites save input. Initial capture-only
verification emitted JSON null, but unchanged strict shared `field_read()`
would reject the raw stored date representation. The reviewed follow-up adds
one narrow read normalization: exact stored `''`, an actual Fields descriptor,
kind date/datetime/number, and SQL `Null = YES` become null on a local copy
before calling the unchanged strict validator. No save input, asset value,
Work processing/recovery policy, schema or record is changed. The follow-up
diff was reviewed once with no P1/P2 finding, and PS10 establishes the actual
read behavior, closing this discovered compatibility issue. An initial
read-only datetime probe used the wrong fixture selector and failed metadata
lookup before writes; the corrected probe used Setting33's actual selector.
A complete Work lifecycle, other asset types, changed-metadata and
logger-outage/race/transaction variants remain unrun. Existing recovery jobs
are outside scope and remain untouched.

## Normal-save capture input handling — 27 October 2026

Scope: local review patch for `inc/capture.php`; no Controller changes, production
deployment, production POST, or Work processing/recovery changes. Existing Works
1–7 are outside this patch and must not be retried, reset, resent or edited.

Read-only inspection of the affected B identified GLPI **11.0.8** and active
Fields **1.24.4**. Its current Computer form renders both reported empty date
controls as enabled hidden inputs with value `""`; the reported dropdown renders
selected value `"2"`, label `Laptop`. These are current DOM observations, not a
record of the older failed POST. The original rejected POST values remain unknown.

GLPI's `CommonDBTM::update()` runs `pre_item_update` before `filterValues()`.
Date/datetime form inputs use canonical populated strings and `""` when empty;
native-date filtering converts the supported empty date representations to
literal `"NULL"` before SQL writes. The saved object can still contain this
sentinel in the post-save hook, while a fresh DB read returns actual `null`.
Fields uses the same GLPI widgets and generated CommonDBTM storage add/update
path, but its generated date columns are nullable `varchar(255)` and the storage
class has no date search option: core filtering alone leaves `""` unchanged.
The hook therefore normalizes at the actual storage boundary before persistence,
as well as for its comparison/validation view. Its outer
`populateData()` checks `isset()`, so replacing the original form input with PHP
null before Fields runs would silently drop an explicit clear; the patch must
preserve that outer input until Fields forwards it to the storage object.

The hook-only normalizer recognizes exact empty date forms (`""`, `"NULL"`, actual
null, subject to the actual storage/custom-field boundary) and unsigned dropdown
IDs. It does not convert arbitrary invalid values to null. Saved-value validation
in `field_value()` remains unchanged; capture verifies against a fresh strict DB
read. Unchanged empty dropdown ID 0 may pass without a Change row. Changing a
populated mapped dropdown to 0 remains an explicit pre-save rejection under the
existing readable-option boundary; no empty option/label or clear operation is
invented. A broader dropdown-clear payload would require a contract decision.

Manual verification must use a fresh isolated GLPI 11.0.8/Fields 1.24.4 database,
synthetic assets/options/mappings, and no production connection or restored
production data. Use the real Fields `updateFieldsValues()`/asset save paths and
independent raw-storage/Change readbacks; do not call the capture helper alone
and label that a form-save pass. Check exact eligible snapshot contents, genuine
`+08:00` times, immutable older rows and zero Work activity after each case.

Executed on 27 October 2026 in disposable containers
`agentb-capture-20261027-5053a8-app` / `-db`, using the official GLPI 11.0.8 image,
PHP 8.5.10, MySQL 8.4 and Fields 1.24.4. Both containers use fresh tmpfs data on an
internal Docker network. No previous B database was restored, and no cron/Work
worker was started. Synthetic Computers 1–3, container 1, two date fields, one
datetime, one dropdown (Desktop 1 / Laptop 2), an unmapped text field and a native
comment mapping were created only there. The three date/Fields mappings exercised
sources A, Both and B. Each manual PHP invocation booted GLPI, authenticated its
synthetic local user, initialized the installed plugins, and invoked
`PluginFieldsContainer::updateFieldsValues()` or `Computer::update()` with normal
form-shaped input. The latter also exercised Fields' nested pre-update save.
These are native save-path checks, not a replay of the browser HTTP POST/redirect.
The disposable app had no published HTTP port; a browser connection attempt to
127.0.0.1:18081 was refused. The affected site's forms were inspected read-only.

Baseline was repository HEAD `0178d8d`. An initial candidate-copy command used the
wrong plugin path and failed, so the following attempted checks still exercised
baseline: empty dates continued to reject; valid populated dates and a dropdown
change created synthetic Changes 1–2. Those rows were retained. Candidate results
below begin only after copying into the actual marketplace path and confirming
the local/container SHA-256 matched:
`b1cfdc366b108d1656afc0f4acdf6fdde52d06a8dbd674931bb9baafb45ecfa1`.

| Case | Manual operation and required observation | Result |
|---|---|---|
| CF01 | Reproduce baseline rejection using the rendered empty-date and ID-string inputs, recording exact PHP input types and hook stage. | REPRODUCED: `""` dates against SQL null threw `ASB_CAPTURE_REJECTED ... Invalid stored date format` in the generated-storage pre-save hook. Dropdown string `"0"` against stored integer 0 threw `Dropdown has no readable selected option`. String `"2"` / Laptop saved successfully. Rejected calls changed neither storage nor queue; Works remained 0. This establishes the mechanism, not the original failed POST. |
| CF02 | Edit an unrelated native/Fields field while mapped dates remain SQL null and the dropdown remains selected. Save succeeds; only genuinely changed mapped fields queue. | PASS: unmapped Fields text changed with all date inputs `""`; dates reread as null, dropdown retained, Change count stayed 3. Unmapped native name changed on Computer 2 while mapped dates were null; no queue addition. |
| CF03 | Save unchanged empty dates using the confirmed widget representation and supported core sentinel. No date Change or duplicate row. | PASS: normal Fields saves with `""` and, separately, exact `"NULL"` returned true; all dates stayed SQL null and Change count stayed 3. |
| CF04 | Set each mapped date/datetime to a valid canonical value. Reread the exact stored value and one eligible snapshot with genuine time. | PASS: `2026-11-01`, `2026-11-02`, `2026-11-01 14:25:30` reread exactly; Change 4 contained only the three matching mapping entries, each reliable with `2026-10-27T17:50:40+08:00`. |
| CF05 | Explicitly clear a populated nullable date/datetime through the normal Fields path. SQL becomes actual null; exactly one eligible snapshot contains JSON null; no post-save sentinel exception. | PASS: empty-string clears of all three populated values returned true, reread as actual null and created only Change 3, with three JSON-null values. A combined outer asset/Fields save later cleared them again in Change 6, confirming Fields' `isset()` forwarding was preserved. |
| CF06 | Save an unchanged positive dropdown ID string, then select another valid local option. No false unchanged capture; changed snapshot contains the actual readable label. | PASS: unchanged string `"1"` produced no row. Selecting string `"2"` stored integer 2 and produced only Change 5, value `Laptop`. |
| CF07 | Save an unchanged empty dropdown ID 0. No exception or empty Change; a populated-to-0 change is visibly rejected before saving under the existing contract. | PASS: Computer 2 saved empty dates, string `"0"` and an unrelated text edit without a new Change. Computer 1's 2→0 attempt raised `ASB_CAPTURE_REJECTED ... Dropdown has no readable selected option`; the entire Fields storage row and queue stayed unchanged. |
| CF08 | Submit malformed/impossible dates, invalid scalar shapes, malformed or nonexistent dropdown IDs. Explicit pre-save rejection; no target/queue mutation; no invalid-to-null conversion. | PASS: date `not-a-date`, `2026-02-30`, space, integer 0, false and array; datetime hour 25; dropdown `"2x"`, `"-1"`, array and absent option `"987654"` each raised mapping-specific `ASB_CAPTURE_REJECTED`. Independent storage/queue readbacks after each attempt were unchanged. No invalid value became null. |
| CF09 | Repeat an unchanged save and edit native plus Fields values in one real save. No duplicate snapshots; separate native/Fields rows remain permitted. | PASS: one `Computer::update()` with native comment plus Fields clears produced exactly Changes 6 (three null dates) and 7 (comment). Repeating the same save added zero rows. Creating the first Fields row on existing Computer 3 with blank dates/default 0 added zero rows; its later real date edit added only Change 9. Earlier Changes 1–5 compared byte-for-byte unchanged after later saves. |
| CF10 | Perform a guarded synthetic local save, followed by a genuine save. Zero sync feedback rows; guard releases and the genuine edit queues normally. | PASS: guarded Fields date save to `2026-12-01` added zero rows; guard read false afterward. Genuine edit to `2026-12-02` produced only Change 8 with that value. No Work execution was involved. |
| CF11 | Read strict stored-value validator behavior and final isolated Work/Change state. Invalid stored date strings remain rejected; no Work processing or recovery claim. | PASS: unchanged `field_value()` rejected stored `""`, `"NULL"`, impossible date and arbitrary text; actual null and canonical date remained accepted. Final synthetic state: 9 Pending Changes (2 baseline, 7 candidate), 0 Works, guard false. Production Works 1–7 were never accessed or changed. |

Remaining limits: the historical rejected request was not recovered; the older
dropdown exception cannot identify today's valid Laptop selection as invalid.
The matching Fields version was available locally, but the deployed site's PHP
source was not downloaded/hash-verified. No production save or browser-level
HTTP replay, other GLPI/Fields versions, exhaustive asset/custom-asset variants,
concurrent-save fault injection, queue-failure recovery or existing Work recovery
was tested. The patch retains the existing exception outcome for genuinely
invalid input, including its mapping-specific log reason; it does not redesign
GLPI's generic error page. Extending mapped dropdown clears beyond the existing
readable-option boundary remains a separate contract decision.

## Localhost deployment and save verification — 27 October 2026

User explicitly approved deploying the capture patch to **localhost:8081** and
verifying it there, keeping Works 1–7 untouched and excluding the real environment,
commits and pushes. Target: `assetsync2-glpib`, GLPI **11.0.7**, active Fields
**1.24.4**. Only `inc/capture.php` was copied into
`/var/glpi/marketplace/agentbdmosassetsync/inc/capture.php`; no installation,
migration or Work/recovery code change was needed. All 15 runtime PHP files
(`setup.php`, `hook.php`, `inc/*.php`) compared byte-identical to the local
candidate after deployment. Capture SHA-256:
`b1cfdc366b108d1656afc0f4acdf6fdde52d06a8dbd674931bb9baafb45ecfa1`.
Deployed-file PHP lint passed.

The local app/database were stopped initially. Before starting the app, its local
Supervisor configuration was backed up and `glpi-cron` autostart was disabled;
the old worker already had autostart disabled. Apache was started, with both
`glpi-cron` and the old worker confirmed **STOPPED / Not started**. No worker,
cron runner, retry, resend, reset, Work update, acknowledgement or recovery call
was executed. The local app/database remain running for review, with workers
intentionally stopped. This local startup safeguard was not applied elsewhere;
the database CronTask configuration was not changed.

Disposable fixtures were created through normal GLPI/Fields methods in new entity
**11**, outside the existing enabled route's entity **2**: Computers **228–230**,
Fields container **14** (`localcfreview`), definitions **78–82**, Desktop/Laptop
options **1/2**, Setting **33**, route `local-capture-review-20261027`. Only the new
container's profile associations were configured for these checks. The initial
long numeric container label returned false; the existing new fixture assets
were reused with the shorter label, without changing the patch. Fixtures and
their evidence remain available; nothing was deleted or purged.

Native manual invocations booted GLPI, logged in its existing local administrator,
initialized plugins, selected fixture entity 11, and exercised real
`PluginFieldsContainer::updateFieldsValues()` / `Computer::update()` paths.
Browser checks additionally used the actual Fields form on Computer **229**:
`GET /front/computer.form.php?id=229`, then the Local CF review tab and normal
`POST /plugins/fields/front/container.form.php` submissions with GLPI's own CSRF
handling. The only curl was a read-only `GET /` availability check (HTTP 200).
No REST Work calls were made.

| Case | Observed localhost result |
|---|---|
| LCF01 — unrelated native/Fields edits with empty dates | PASS: Fields text saved with all three date inputs `""` and valid dropdown `"2"`; dates reread as SQL null, no Change. Unmapped native name edit also added no Change. A browser text edit with blank dates and empty dropdown `"0"` saved and reread exactly, with no Change. |
| LCF02 — unchanged empty inputs | PASS: `""` and exact supported `"NULL"` date saves returned true, retained SQL null and added zero rows. A final unchanged browser save also succeeded; fixture queue remained nine rows. |
| LCF03 — populated dates/datetime | PASS: `2026-11-04`, `2026-11-05`, `2026-11-04 10:11:12` reread exactly; Change **83** contained precisely those three reliable mapping values with genuine `2026-10-27T18:06:31+08:00` evidence. Browser calendar selection/saving of `2026-10-28` produced only Change **86**. |
| LCF04 — explicit clears | PASS: clearing all three populated Fields inputs with `""` stored actual SQL null and produced only Change **84**, with three JSON-null values. Clearing the populated browser date, blurring the widget (hidden input observed `""`) and saving produced only Change **87**, `cf_date1.value = null`, at `2026-10-27T18:08:18+08:00`. The browser returned to the normal form without an unexpected-error page. |
| LCF05 — positive dropdown IDs | PASS: unchanged string `"2"` created no row; changing to string `"1"` persisted ID 1 and produced only Change **85**, label `Desktop`. |
| LCF06 — empty dropdown boundary | PASS: the browser's unchanged `"0"` selection allowed unrelated and unchanged saves without capture. A positive→0 attempt raised mapping-specific `ASB_CAPTURE_REJECTED ... Dropdown has no readable selected option`; full Fields row and queue stayed unchanged. Existing contract policy was retained. |
| LCF07 — invalid inputs | PASS: arbitrary/impossible date text, space, integer 0, false, array, invalid datetime hour, dropdown `"2x"`, negative ID, array and nonexistent ID each raised explicit mapping-specific pre-save errors. Independent readbacks after each attempt showed unchanged Fields storage and zero queue additions. No invalid-to-null conversion. |
| LCF08 — combined saves and duplicates | PASS: one outer `Computer::update()` with native comment and a Fields date produced exactly Changes **88** (date) and **89** (comment). Repeating it added zero rows. Separate native/Fields storage snapshots remain permitted. |
| LCF09 — sync suppression | PASS: guarded synthetic Fields date save to `2026-12-01` added zero rows and released its guard. A subsequent genuine edit to `2026-12-02` produced only Change **90**. No Work was involved. |
| LCF10 — first Fields storage row on existing asset | PASS: Computer 230's first row with empty dates/default dropdown 0 produced no Change; its subsequent real date edit produced only Change **91**. |
| LCF11 — strict stored validation | PASS: unchanged `field_value()` rejected stored `""`, `"NULL"` and impossible date, and accepted actual null. Storage validation was not relaxed. |
| LCF12 — protected evidence | PASS: all seven Works **1–7** compared byte-for-byte identical before/after. The entire **859-row Work table** also compared identical; no new Works. All **82 pre-existing Changes** compared identical. Exactly nine new fixture Changes **83–91** remained Pending; none were acknowledged. |

Protected snapshot SHA-256 values, identical before and after:

- Works 1–7: `205d2fc02640902378b364b82707cb78c82f5fd3d13821a391cf01a1a6f9e3b1`.
- All 859 Works: `50d5a13c2cec3b64077dce14f03e1de390515698966f37160add7fb5fea7dce2`.
- Existing Changes 1–82: `34862138c771acb50ac193923faeafd1e716dd2d0552a745db7a4010b9239d6f`.

This closes the browser-POST verification gap for the exercised **local 11.0.7**
forms. It does not establish the historical failed production POST, deployed-site
source equality, every field/type/plugin version, concurrent/fault outcomes or
existing Work recovery. No real-environment requests, deployment or data/config
changes occurred during this deployment pass. No automated tests, commit or push.

## Native-tab inserted Fields number investigation — 27 October 2026

This follow-up to v0.1.1 was implemented locally for review. The affected site's plugin
listing was inspected read-only and reported Agent B **0.1.1**, Fields **1.24.4**.
Its native Computer form embeds an insertion-style Fields block and submits an
optional blank numeric control, as well as dates/dropdowns. Whether that number
is enabled in the affected route, its stored value, and the latest server
exception remain unavailable. **The current production failure is not yet
attributed to this defect.** No live save, configuration change or deployment
was performed. The user was given the usual `php-errors.log` locations and asked
for the exception/stack, with credentials omitted.

Two agents traced native input handling and post-save capture independently;
a builder changed only `capture_input_value()` and its storage-boundary comment
in `inc/capture.php`; the reviewer approved that narrow source diff. No Controller
code was read or changed. Neither Work processing/recovery nor schema, version,
API contract or stored-value validation changed.

Confirmed source mechanism: GLPI 11.0.8 calls `pre_item_update` before input
filtering. B's pre-hook runs before Fields. Fields 1.24.4 `populateData()` forwards
values using `isset()` and replaces decimal commas in numbers with periods;
`validateValues()` permits an optional empty number. Its migration defines number
storage as nullable `VARCHAR(255)`. B previously supplied raw `""` or `"1,5"` to
the strict stored-number validator first, raising `Invalid stored number`.
The new capture-only normalization recognizes exact empty string/actual null
for nullable Fields-number storage and mirrors Fields' comma replacement.
It preserves strings such as `"0"`; it leaves the outer input available to
Fields and changes persistence input only on the actual storage object.
The unchanged strict DB reread still rejects invalid saved representations.

Manual checks used fresh GLPI **11.0.8**, Fields **1.24.4**, PHP **8.5.10** and
MySQL **8.4** in `agentb-native-7febac35-app-web` / `-db-web`. No original B data
was restored, no volume was shared with localhost:8081, and no cron/worker ran.
HTTP was exposed only on loopback port **18083**. Disposable Computers 1–2,
an insertion (`dom`) Fields container, number/date/dropdown/boolean mappings,
a native-comment mapping and restricted editor profile 9 were created through
normal GLPI methods. An initial fixture Setting add returned false until the
fixture administrator's plugin Setting rights were granted in this fresh DB;
that setup correction did not change the patch or any original account.

The manual invocations below booted GLPI, logged in the fixture account,
initialized plugins, and called the real `Computer::update()` path with native
form-shaped scalar strings and the inserted Fields inputs. Nested Fields saves
were not replaced by direct capture-helper calls. Independent asset, Fields and
Change readbacks were inspected. Candidate host/container capture hashes matched:
`6daefd5e88f4489f5c923ffb7f47b9eba7eaad759840fb9a08255e9307fefd8b`.

| Case | Observed result |
|---|---|
| NR01 — v0.1.1 baseline | REPRODUCED: optional number SQL null plus native form input `""` raised `ASB_CAPTURE_REJECTED: mapping_id=native_number reason=Invalid stored number`. `"1,5"` likewise rejected before Fields' normalization. The attempted unrelated native edit did not persist; number stayed SQL null, Changes 0, Works 0. This is an isolated mechanism reproduction, not the site's recovered request. |
| NR02 — unrelated native save with blank number | PASS candidate: native name saved, optional number remained SQL null, zero Change additions. |
| NR03 — unchanged blank | PASS: normal native/Fields save returned true, actual SQL null retained, zero rows. |
| NR04 — blank to zero and unchanged zero | PASS: browser-shaped string `"0"` persisted as stored `"0"`, Change 1 contained JSON number 0 with reliable genuine `+08:00` time. Repeating string `"0"` added zero rows. No `empty()` coercion or integer conversion was used. |
| NR05 — zero to explicit blank | PASS: input `""` stored actual SQL null; only Change 2, number value JSON null. |
| NR06 — decimal and clear | PASS: `"12.5"` stored exactly and created Change 3 with numeric 12.5; clearing created Change 4 with null and SQL null. |
| NR07 — Fields decimal comma | PASS: native outer input `"1,5"` passed, Fields stored `"1.5"`, Change 5 carried number 1.5. Repeating canonical `"1.5"` added zero rows. |
| NR08 — invalid inputs | PASS: `bad`, space, `1,2,3`, literal `NULL`, `NaN`, non-finite `1e999`, false and array each raised mapping-specific pre-save rejection. Asset, complete Fields row and queue remained unchanged after each attempt. None became null. |
| NR09 — sync guard | PASS: guarded native/Fields number save to `"18"` added zero rows and released the guard. The next genuine value was captured in NR12. |
| NR10 — first inserted storage row on existing asset | PARTIAL / separate pre-existing finding: number/date null and dropdown default 0 caused no spurious entries, but a mapped boolean at default 0 created Change 6 with false. Source: `capture_changed()` compares SQL default string `"0"` with saved integer 0. This does not cause the number rejection and is outside this patch; it was not concealed or fixed. |
| NR11 — strict stored-value validation | PASS: unchanged `field_value()` rejected stored `""`, `"1,5"` and `"NULL"`; accepted actual null, stored `"0"` as JSON 0, and `"1.5"` as JSON 1.5. |
| NR12 — ordinary editor | PASS: profile 9 had Computer UPDATE but no Change READ/UPDATE or Setting CREATE. A genuine number `"19"` plus native comment save succeeded and produced exactly Changes 7 (number) and 8 (comment). No plugin rights were added to that editor. |
| NR13 — mixed existing scalar regression | PASS: native comment plus number `"20"`, canonical date, valid dropdown and boolean produced exactly Changes 9 (four Fields values) and 10 (native comment). Number/date clears and boolean true→false produced Change 11 with null/null/false. Sibling text and dropdown selection were preserved. Final fresh state: Works 0, 11 Pending Changes, guard false. |
| NR14 — full native browser POST | PASS: after Chrome ceased blocking automation, the actual native Computer form was submitted through `POST /front/computer.form.php`, including its inserted Fields controls and GLPI CSRF/read-date handling, under profile 9. An unrelated Name edit with number blank saved and reread exactly, kept SQL null and left the queue at 11. Browser string `"0"` stored `"0"` and produced only Change 12 (JSON number 0, `21:02:31+08:00`). Clearing the number stored actual SQL null and produced only Change 13 (JSON null, `21:02:48+08:00`). An unchanged full form save added no row; final queue 13, Works 0. Each returned to the normal asset form. The initial password-manager panel interruption required no extension setting changes. |

Isolated candidate PHP lint and repository whitespace check passed. The disposable
verification containers were stopped afterward. The original
localhost:8081 database and all original Works, including Works 1–7, were not
accessed or changed by this investigation. No commit, push, release update or
real-environment deployment was performed.

Other source findings remain separate: capture currently resolves retained-link
identity before checking whether a route has any eligible mapped candidate, so
competing links can reject even an unrelated save. Production involvement is
unknown without its exception. No change to link handling or recovery is part
of this patch. Direct-method typed integer zero also needs separate verification;
the zero results above cover actual form-shaped strings, not arbitrary callers.

## Localhost native-tab deployment — 27 October 2026

User explicitly authorized deploying the reviewed Fields-number fix to
**localhost:8081** and verifying native-tab saves, keeping Works 1–7 unchanged
and excluding commits, pushes and the real environment. Target
`assetsync2-glpib`: GLPI **11.0.7**, Fields **1.24.4**, Agent B active.
Only `inc/capture.php` was replaced; its local/container SHA-256 matched:
`6daefd5e88f4489f5c923ffb7f47b9eba7eaad759840fb9a08255e9307fefd8b`.
Installed plugin version metadata remains **0.1.0** as before this deployment;
this was a capture-file patch, with no plugin installation, metadata update,
migration, Work/recovery change or worker invocation. The initial non-root
staging command could not preserve the existing file owner and stopped before
replacement. Container root then completed the atomic replacement, preserving
the original mode/owner; the failed staging file was removed.

GLPI cron and the old worker were **STOPPED / Not started** before and after;
Apache remained running. Before any fixture writes, read-only snapshots of
Works 1–7, all 860 existing Works and all 92 existing Changes were retained.
No Work records were created, retried, reset, resent or updated. No Change
acknowledgements or correction jobs were submitted.

New disposable fixtures, created with normal GLPI/Fields methods: entity **12**,
Computer **231**, insertion (`dom`) Fields container **15** (`nativelocalreview`),
definitions **83–87**, dropdown option **1**, Setting **34**, route
`native-local-review-20261027`. The route is confined to entity 12; existing
enabled routes target entities 2 and 11. Only the new container's profile
associations were configured. The fixture already had a Fields storage row
before the Setting was enabled; no first-row default-boolean pass is implied.

Browser cases used the actual native **Computer** tab, not the separate Fields
tab: `GET /front/computer.form.php?id=231`, then ordinary
`POST /front/computer.form.php` submissions with the inserted Fields controls
and GLPI's CSRF/read-date handling. DOM input observations confirmed optional
number `""`, date `""` and empty dropdown `"0"`. Independent native/Fields/Change
readbacks were inspected after the cases. Additional native-method checks
booted GLPI and used `Computer::update()` through the same insertion hooks;
no reusable harness or automated tests were added.

| Case | Observed localhost result |
|---|---|
| NLN01 — unrelated native save with blank mapped number | PASS browser: Name changed to `Local native unrelated save passed`; number/date stayed SQL null and fixture Change count stayed 0. Returned to normal native form. |
| NLN02 — unchanged blank form | PASS browser: complete native form saved unchanged, number remained SQL null, zero new snapshots. |
| NLN03 — blank to zero | PASS browser: string `"0"` persisted as `"0"`; only Change **93**, numeric value 0, reliable `2026-10-27T21:13:12+08:00`. |
| NLN04 — unchanged zero | PASS browser: repeating the full native save retained zero and left fixture Change count 1. |
| NLN05 — explicitly clear zero | PASS browser: blanking the number persisted actual SQL null; only Change **94**, JSON-null value, `2026-10-27T21:13:45+08:00`. |
| NLN06 — mixed native and inserted Fields edit | PASS browser: number `12.5`, native comment and an unmapped inserted note saved and reread exactly. Exactly Changes **95** (number 12.5) and **96** (native comment), both with genuine `+08:00` time. The note was preserved and was not included in a snapshot. |
| NLN07 — Fields comma normalization | PASS native method: outer input `"1,5"` saved as `"1.5"`; only Change **97**, numeric value 1.5. This is source-verified Fields normalization, not a claim about browser locale entry. |
| NLN08 — invalid number inputs | PASS native method: `bad`, space, `1,2,3`, literal `NULL`, false and array each raised mapping-specific `ASB_CAPTURE_REJECTED ... Invalid stored number`. Full native asset, Fields row and queue were unchanged after each rejection; no invalid-to-null coercion. |
| NLN09 — guard and next genuine edit | PASS native method: guarded number `"30"` saved with zero queue additions and guard false afterward. Genuine edit to `"31"` produced only Change **98**. No Work was involved. |
| NLN10 — protected records and runtime | PASS: all seven Works **1–7**, all **860 pre-existing Work rows**, and all **92 pre-existing Changes** compared byte-for-byte identical before/after. Final fixture queue: exactly **six Pending Changes 93–98**, with no acknowledgement. Deployed PHP lint passed; capture file matched the reviewed local candidate; both workers stayed stopped. |

Identical protected snapshot SHA-256 values:

- Works 1–7: `205d2fc02640902378b364b82707cb78c82f5fd3d13821a391cf01a1a6f9e3b1`.
- Existing Works 1–860: `1997d0ab6c1c98e066dfa616d1aa3e02a714893a98d116bb05a1f4d604627c6c`.
- Existing Changes 1–92: `9ee39d1872e740064e1877ab8783468e7f35e30563f8e9d58a76deda3f01e999`.

Local B remains online with cron/workers stopped and disposable fixtures retained
for review. Final fixture number is `"31"`, date SQL null, empty dropdown 0,
boolean 0, and the sibling note remains intact. No Controller access, commit,
push, release update, real-environment request or deployment occurred in this
pass. The real site's current error still requires its server exception; this
localhost pass does not resolve existing recovery jobs or the separate findings
recorded above.

## Current evidence index

The ledger for each part records the deployed scope, exact manual requests,
operator fixture mistakes, initial failures/selective fixes and unrun variants.
Historical stage Holds describe that stage; they are not current product
placeholders. The reviewer inspected operator evidence without replaying curl.
Final Both source and scoped IE runtime are approved after targeted source fixes.
No exhaustive installed-type/field, unrun fault-injection or other-patch
certification is implied by representative passes. Bounded additional fault
and concurrency evidence is separately indexed in the R0/R1/R2 section.

| Completed scope | Preserved evidence | Review status |
|---|---|---|
| Install, schema, profile rights, Setting | [foundation-runtime.md](foundation-runtime.md) | Coordinator-preserved initial foundation pass; protected-target initial failure and fix retained |
| Work admission | [inbound-a-runtime.md](inbound-a-runtime.md) | Independently reviewed 173 curl entries |
| Genuine capture and capability gate | [outbound-a-runtime.md](outbound-a-runtime.md) | Independently reviewed 62 curl/23 local entries; custom hook/readonly initial failures retained |
| Existing A-owned local writes | [inbound-b-runtime.md](inbound-b-runtime.md) | Independently reviewed 48 curl/31 local entries |
| External exact acknowledgements | [outbound-b-runtime.md](outbound-b-runtime.md) | Independently reviewed 70 curl/5 local entries |
| First copy and concrete custom types | [inbound-c-runtime.md](inbound-c-runtime.md) | Independently reviewed 23 curl/10 local entries |
| Custom-type acknowledgement integration | [ack-type-runtime.md](ack-type-runtime.md) | Independently reviewed 7 curl/2 read-only local entries |
| B returns, correction coverage, Suspend/Resume | [inbound-d-runtime.md](inbound-d-runtime.md) | Independently reviewed 53 curl/19 local entries |
| Both arbitration and faithful numeric equality | [inbound-e-runtime.md](inbound-e-runtime.md) | Independently reviewed 40 curl/18 native entries; targeted source fixes and limits retained |
| Additional local B readiness gaps | [b-side-readiness-runtime.md](b-side-readiness-runtime.md) with full R0/R1/R2 ledgers | Independently reviewed 4/55/105 curls and 2/41/67 local entries, plus 15 owned R1 PHP processes; R2-11 historical safety PASS / diagnostic FAIL; later RF fix PASS; critical unrun boundaries remain |
| Fields status-readonly diagnostic correction | [fields-readonly-fix-runtime.md](fields-readonly-fix-runtime.md) | Completed source review and independent review of30 curl invocations (27 HTTP/3 local syntax failures) plus34 native invocations; RF01a–RF06 bounded PASS, historical173 retained |

Current setup is in [setup.md](setup.md); exact schemas, the five original API
contract deliverables and native wrappers remain in [api-contract.md](api-contract.md).

## Remaining B-side readiness review — R0/R1/R2

This consolidation uses the main AGENTS/spec/approved contract, both flowcharts
and all historical ledgers above. It records additional local Docker tests
requested after implementation. It is not a blanket pilot approval. Historical
NOT RUN labels remain as records of their original pass; a later result closes
only the exact variant its actual evidence proves. Real A integration and
remote HTTPS/network behavior are outside this local B certification.

Statuses: **CLOSED PRIOR** means scoped evidence already exists; **OPEN** means
required new evidence is pending; **SOURCE ONLY** is not a runtime pass;
**CONDITIONAL** applies before enabling the named mapping/deployment feature.
An observed failure is a blocker until explicitly resolved/retested. Missing
safe crash/commit/capture-persistence proof remains pilot-critical; it is not
automatically moved into a before-scale bucket because injection is difficult.
R0/R1/R2 exact behavioral ledgers are independently reviewed. The runtime
lease passed from R1 to R2 serially; both runs are finished. R2 used fresh
entity/service/asset/metadata fixtures, recorded rights restoration and retained
fixture-only move/return evidence. Natural session expiry was not repeated as
though R0 had proved it. The P2 diagnostic failure below is historical; the
subsequent RF pass closes only its exercised variant.

| Gap ID | Timing / boundary | Prior exact evidence and remaining proof | Current result / new owner |
|---|---|---|---|
| BR01 | Before any pilot — authentication/session invalidation | Foundation/native login and restricted profile recorded. R0 creates its own session, reads profile, kills it, then attempts Setting GET with that invalidated session. This proves invalidation only, not natural idle expiry or lost network transport. | PASS R0:200/200/200/401 ERROR_SESSION_TOKEN_INVALID; full ledger in b-side-readiness-runtime.md |
| BR02 | Before any pilot — current account/profile authorization | IB revoked Work CREATE/asset READ and exact caller restoration; ID/IE READ-only comparisons and denied A writes. Inactive/expired submitter and removed profile/entity authorization after admission still need real current-account proof, without cron-admin inheritance. | PASS bounded — R2-06–09 actual post-admission inactive, expired2000, future2030, removed-profile, disjoint-entity and recursion-withdrawal conditions Hold without target/History/queue changes. Fresh162 succeeds after restoration. Invalid2099 fixture156 Done is preserved, not a validity pass. |
| BR03 | Before any pilot — routed entity/concrete-type/ownership | IB/IC/AT actual global conflicts and custom definition isolation; ID Suspend/Resume. Add safe actual wrong-entity linked asset, separate immutable route topology/return-to-original-link and correction/ack scope proof. No automatic move/relink/duplicate. | PASS bounded — R2-02/03 real 1:many and many:1 entities preserve163/164/165; coincident owned serial148 Held. R2-04 moved163 causes Sync150/correction151 Held before writes/attempts and ack47 rejected asset_entity; restore153 reuses163 with no reseed. Deletion/trash and adverse type/owner lock races remain unrun. |
| BR04 | Before any pilot — scope controls after permission/scope change | ID no-link/unverified/stale control and actual Suspended ack/capture/write rejection pass. Additional current-authorization/changed-entity/competing control variants are unrun; failed controls cannot override prior successful state. | PASS bounded — R2-05 moved Suspend152, revoked-entity Suspend159 and moved Resume164 Held; earlier successful state retained. Suspend163/returned Resume165 Done without mapped write/reseed. Other competing-control permutations not exhaustively exercised. |
| BR05 | Before any pilot — preflight and post-save capture persistence | OC real capture/gates and no-echo passes; visible queue-persistence failure path source-reviewed only. Safely prove changed metadata preflight rejection and actual queue-persistence failure visibility/retained evidence without false successful capture or silent retry. | PARTIAL — R1-06 actual queue INSERT denial1792 leaves genuine save visible, throws ASB_CAPTURE_OUTCOME_UNKNOWN, creates no empty Change and blocks same-request retry. Changed-capture-metadata preflight and further persistence failure windows NOT RUN; R2 status override proves worker safety separately in BC02. |
| BR06 | Before any pilot — interrupted first copy after real add | IC atomically confirmed create+link and definite mandatory-add rollback; IB only safe before-write started marker. Need safe after-add/pre-link-or-completion interrupted outcome proof, reconcile no second add and no confirmed created ID without evidence. | PASS bounded — R1-02/03 actual SIGKILL before and after first-copy commit; uncommitted159 absent, committed160/link/result retained, both recover Held without another creation. Other uncertainty branches remain BR08. |
| BR07 | Before any pilot — interrupted existing update/partial progress | IB actual definite numeric rollback/partial evidence; IE preserves it. Need actual after-save/pre-Work-completion interruption/recovery proof: Held/visible uncertainty, preserved evidence and no blind repeat/terminal reset. | PASS bounded — R1-01 actual SIGKILL after first mapping/result commit; Work115 Held with saved first effect and no second write/replay. Initial helper Works112–114 are excluded. |
| BR08 | Before any pilot — commit/rollback/lock-release uncertainty | IB/IC/e targeted source fixes classify uncertain completion; actual definite failures pass. Commit/rollback/release/queue-completion uncertainty must not become false Done, Failed-with-guessed-rollback or automatic replay. Distinguish each safely exercised boundary from unrun ones. | PARTIAL / pilot-critical gaps remain — R1-04 killed after correction write before exact Done leaves43 Pending/attempt1; R1-05 real lock timeout1205 Holds. Wire COMMIT/lost-COMMIT-ack, ROLLBACK and RELEASE_LOCK failures NOT RUN; these are not closed by SIGKILL or a normal rollback. |
| BR09 | Before any pilot — lost response/idempotent reconciliation | WA actual duplicate and concurrent admission; OB concurrent ack/Done-to-Done rejection; IC sequential create reuse. Add lost POST/ack response reconciliation by exact saved IDs rather than a new creation or positional/HTTP-only assumption. | PASS simulation only — R1-10 discards successful POST/ack response bodies, reconciles exact saved identity, rejects duplicate Work/Done→Done. Actual packet loss/server response timeout/transport interruption NOT RUN; real A network remains outside local proof. |
| BR10 | Before any pilot — actual automatic action/worker concurrency | Native scoped task51 bounded20+2/global lock/context restoration pass; task registration60s/external state confirmed. Actual scheduled single-action invocation, overlapping worker/write/first-copy boundaries and no duplicate asset/History/link require exact new evidence. | PARTIAL — R1-07 real second worker returns0 while first creates only161, competing121 Held; R1-08 current-setting change and concurrent versions serialize correctly. R1-09 exact nonforced native CLI processes20 then scoped remainder1. Recurring OS scheduler tick NOT RUN. |
| BR11 | Before any pilot — exact whole-snapshot correction and return coverage | ID/IE actual partial/full/missing/foreign refs, attempts, exact Done and newer Pending pass. Current-lock scope/ownership changes while waiting remain source-only; safe real fixtures must prove no stale scope authorizes writes/Done, or remain pilot-critical unproved. | PARTIAL / pilot-critical adverse races remain — R1-11 thread4132 waits on current asset FOR UPDATE; committed entity move yields145 Held/no mapped write. R2-04 moved correction151 and ack47 reject before attempts/completion. Concrete-definition and Fields owner/container changes during lock wait remain NOT RUN. |
| BC01 | Conditional before enabling actual mappings — type/field capability inventory | Computer/Monitor and multiple real custom definitions/Fields scalars passed. Validate each pilot's actual selected type/selector/mandatory/default/identifier metadata; a search option or representative custom fixture is not exhaustive support proof. Type with no serial and no verified link must Hold. | CONDITIONAL — R2 new configured custom dates/History, Fields dates and native business Status/Monitor DECIMAL gates pass; this is no exhaustive inventory. Each actual pilot mapping/type/mandatory/default/identifier combination still requires validation; no-serial/no-link type variant NOT RUN. |
| BC02 | Conditional before Fields mappings — active/absent plugin, status readonly, storage ambiguity | OC/IB native/Fields scalar/container denial/preserved multiple siblings pass. Inactive/unavailable plugin, status-specific override, missing/ambiguous storage and metadata changing after Setting need bounded actual proof where safely constructible. | HISTORICAL safety PASS / diagnostic FAIL P2 at173; bounded RF01a/02a/03b now PASS with exact readonly field reason and unchanged target/History/queue. The diagnostic blocker is closed for exercised A/Both/correction paths. Plugin inactive/absent and missing/ambiguous storage variants remain NOT RUN. |
| BC03 | Conditional before dropdown mappings — exact label boundaries | IB all required conversions, missing/duplicate label and denied option; IE losing missing-label bypass/winning lookup pass. Add case/whitespace/full hierarchy/wrong family/out-of-scope/empty/null as real configured option metadata permits. No option creation/default clear. | PASS bounded R2-12 — full hierarchy and exact saved label apply; wrong case, ambiguous leaf-only, outside entity, whitespace mismatch, empty/null labels skip without clearing/option creation. Case-only duplicate fixture refused by native collation. Other dropdown families/metadata combinations remain conditional. |
| BC04 | Conditional before nullable/numeric/date mappings | IB/IC/IE actual scalar types, canonical dates, large decimal/exponent tokens, varchar1.00 and true lossy rollback pass. Physical SQL DECIMAL writes, boundaries/nullability, additional native/custom date cases are not inferred from helpers or varchar storage. | PASS bounded R2-10/12 — actual custom/Fields date+datetime writes, impossible dates/times and256-character rejection; physical Monitor.size DECIMAL(5,2):1.00 versus JSON1.0 AlreadyEqual,12.75 Applied,1000 skipped range. Negative/other widths/direct nullability/exact255 acceptance remain conditional unrun variants. |
| BC05 | Conditional before custom-asset deployment — native History capability | Real local custom add/update/reread/guard passed, but queried custom History was empty. Determine actual configured GLPI history capability and prove attributable normal History when required/enabled; do not claim custom History from native/Fields evidence. | PASS configured History-enabled custom fixture — R2-10 definition6 HasHistoryCapacity, asset8 creation/genuine date-only save/worker updates carry user15 History; typed dates/rereads and siblings correct. Old empty custom History query remains historical; validate each actual custom capacity/configuration. |
| BC06 | Conditional before recursive or multi-entity deployment | Foundation/OB restricted root and outside-entity denial; concrete type/global ownership proven. Actual recursion,1:many/many:1 separate route identities, service child access and return-to-original-link need scoped fixtures. | PASS bounded R2-01–05/09 — actual recursive7→8/9, separate 1:many/many:1 identities, competing-source Hold, revoked recursion child GET403 and restored162 Done, move/return reuses original link. Other deployment entity trees remain conditional. |
| BC07 | Conditional deployment convention — natural expiry/clock/HTTPS | Invalidated session R0 is closed; natural expiry and target-specific TTL remain unrun. Local evidence uses trusted Brunei genuine times and native mapped date conventions. Confirm deployment clock policy and exact transport configuration where changed; remote HTTPS/A is outside local B proof. | CONDITIONAL; no invented policy question or expiry pass |
| BS01 | Before scale — large queue/range behavior | Bounded worker batch20 and collection200/206 exist; no immutable offset-page promise. Add Pending pagination while new edits/Done transitions occur, preserve unresolved earliest IDs and reconcile exact IDs. A consumer fairness belongs to A integration. | PASS bounded local — R1-09 real Pending keyset206/200 pages43/44→45/46 across44 Done and46 insertion; new pass revisits43. Large/sustained queue behavior remains BS02; actual A consumer fairness remains outside local proof. |
| BS02 | Before scale — sustained volume/contention | Single concurrent admission/ack/global lock tests are scoped evidence. Long-running load, many routes/types/fields, sustained overlapping genuine edits and operational latency are not established by one batch. | NOT RUN; before-scale capacity/reliability evidence needed |
| BS03 | Before scale — crash/fault stress beyond bounded functional proof | Any pilot-critical BR05–08 window stays critical until resolved. Repeated stress across database/server restarts and resource exhaustion is additional capacity/reliability work, not a substitute for those basic windows. | NOT RUN; distinguish from critical functional gaps |
| BX01 | Outside local B certification — real A workflow | B-side flows simulate A fully handling returned snapshots. Actual A local save, durable progress, reverse option lookup, timeout reconciliation and fair consumption require integration evidence in A's project. | OUTSIDE LOCAL — not claimed passed |
| BX02 | Outside local B certification — remote HTTPS/network deployment | Supplied target is isolated localhost HTTP. Remote certificate/proxy/source-IP/firewall/timeouts/network-loss behavior is not proved by local curl or explicit session invalidation. | OUTSIDE LOCAL — not claimed passed |

### Historical results superseded only within their exact scope

The original broad F/V/I/N/T/D/Q/G tables were prepared before implementation;
their NOT RUN cells are historical planning labels, not a command to rerun
all prior successes. Foundation/WA/OC/IB/OB/IC/AT/ID/IE ledgers are the actual
stage evidence. In particular, F11 real helper transitions are later proved
by OC14/OB12; I09 and the old OC/OB Suspended gap are proved by ID10–14;
old B/Both stage Holds are superseded by actual ID/IE execution; no type-wide
claim follows from those representative fixtures. R0 now supersedes only the
invalidated-session portion of V06. R1 now supersedes bounded native interruption/first-copy/correction-before-ack,
queue-insert-denial, timeout, concurrent-worker/settings, named CLI batching,
keyset pagination and entity-lock-wait variants as stated above. R2 now adds actual current-account/profile/entity/recursion rejection, topology,
move/return/control/correction/ack scope, History-enabled custom dates, Fields
dates, physical DECIMAL and precise label boundaries. These results supersede
only those historical variants; other variants remain open until exact evidence
proves them. R2-11 diagnostic failure remains historical and is superseded only
by the subsequent bounded RF source/runtime pass. All original failures, operator mistakes,
source findings and terminal Work/Change fixtures are retained.

### Additional run evidence and readiness conclusion

**Finding R2-11 / P2 — historical failure; bounded fix verified.** At baseline
main2dc0b16, Work173 safely skipped the readonly Fields target but incorrectly
reported generic write uncertainty. The specific pre-save refusal was hidden by
[inc/write.php](../inc/write.php#L204), contrary to contract Q8's exact skipped-field
reasons. Its terminal row and original R2 raw ledger remain unchanged.

The user then authorized the narrow actual-save-attempt marker correction.
Completed source review and RF01a/02a/03b now verify exact
`Fields value is read-only for the asset current status` reasons, without target
value/History/queue mutation. Readonly equality and B-winning returns still avoid
writes; allowed writes, exact correction coverage and grouped first copy pass.
RF05 genuinely saved an attempted value inside the transaction, then its
process-local hook threw the same readonly wording:193 remained generic uncertain
Held and an independent reread confirmed value/History rollback. Thus the fix
distinguishes pre-save refusal from actual attempted-save uncertainty without
matching exception wording. The exercised diagnostic blocker is closed; this
is not evidence for the other unrun failure windows. See the affected matrix
below and [full exact RF ledger](fields-readonly-fix-runtime.md).

Full reviewed evidence is in [b-side-readiness-runtime.md](b-side-readiness-runtime.md)
and its exact R0/R1/R2 ledger links. R0 has4 curls plus2 read-only metadata
invocations; R1 has55 curls,41 synchronous local entries and15 owned PHP
processes (four deliberately killed exit137); R2 has105 curls and67 native PHP
entries, plus3 separately documented read-only source inspections. The reviewer
independently compared all34 R1 and38 R2 submitted Work
input payloads to final records: no differences. Change43 retains its original
snapshot with only attempt0→1; R2 Changes47–50 retain every original column,
Pending/attempt0. Initial helper errors, the unsupported2099 timestamp fixture,
unverified claimed IDs, unreadable State options and failed route20 containment
attempts remain in the raw evidence with their actual corrected interpretations.
The final route20 disable succeeds; all new routes are disabled and sessions
closed, zero Accepted Work remains, task51 is ready, and disposable fixtures
are retained. No broad replay, deletion or source edit occurred.

**Pilot-critical unproved boundaries remain:** wire-level lost COMMIT reply,
server COMMIT exception, ROLLBACK failure, RELEASE_LOCK failure, adverse concrete
definition/Fields owner-container changes during lock wait, and changed-capture
metadata preflight/further persistence-failure windows. Do not replace these
with the passing native entity race, normal rollback, timeout or four bounded
kill cases. Actual transport interruption, natural session expiry, recurring OS
scheduler tick, conditional mapping/storage variants and scale evidence also
remain explicit limits. Real A integration/remote HTTPS are outside local B.
The coordinator separately reports15 installed PHP SHA-256 reads matching
main2dc0b16, preserved in the evidence index as source integrity, not additional
behavioral passes. This review does not certify pilot readiness or say all
tests pass. No commits were made by the reviewer this pass.


## Fields status-readonly diagnostic correction — affected manual checks

The user authorized a narrow correction of R2-11/P2, independent source review,
affected local Docker retests and these narrative updates. Source and full
operator evidence have now been independently reviewed; the bounded RF cases
below pass, closing this specific diagnostic variant. The historical R2
raw ledgers and terminal Work173 remain unchanged. The reviewer owns only this
checklist, the readiness narrative and the new exact fix-run ledger; code and
runtime belong to separate agents. The completed narrow source diff was independently reviewed before deployment;
the result column below records the actual affected runtime evidence. No automated test software, commit,
push, new route/authentication mechanism or outbound A implementation is added.

Use native GLPI REST `/api.php/v1/PluginAgentbdmosassetsyncWork` POST and exact
Work GET, normal native fixture/metadata methods, and real genuine Change rows.
Use redacted `B_APP_TOKEN`/`B_SESSION_TOKEN` variables from this checklist and
fresh `work_id` values. Confirm the current service profile/entity context,
verified link or complete serial match, actual State2 readonly override, full
asset/Fields/History/queue baseline and recorded original Change values first.
The specific readonly refusal must occur before a storage write. A mere HTTP
201 means Accepted; inspect terminal field outcomes and actual readbacks.

| ID | Bounded request / evidence | Required result | Execution status |
|---|---|---|---|
| RF01a | Existing linked asset, source A text mapping. Actual current State2 makes the Fields target readonly; POST fresh Work with a different text value, then bounded native worker and exact Work GET. | Specific status-readonly field reason; skipped target unchanged, no target History/queue echo, siblings unchanged. Do not call this known pre-save refusal an uncertain attempted save. | PASS —185 Done, rf_text Skipped with exact status-readonly reason; natives5/8 exact asset/storage/History/queue equal. |
| RF01b | Same actual readonly owner, A value equals current Fields value. | AlreadyEqual with no write/History/echo; no unnecessary readonly failure for a no-op. | PASS —186 Done/AlreadyEqual; same exact no-write evidence. |
| RF02a | Source Both with genuine B value/time evidence and a differing A value with a trustworthy later RFC3339 seconds+08 time, so A actually wins under current State2. | Specific readonly refusal before save, no false AppliedToB/coverage, no target History/echo; preserve genuine B evidence. | PASS —187 Done, exact readonly Skipped reason after genuine52 time18:41:24+08 and later A18:41:25+08; natives10/13 unchanged. |
| RF02b | Source Both with actual B-winning genuine field evidence under the same readonly state. | ReturnToA/current B value and original genuine time; no write or unnecessary writer preflight. | PASS —188 Done/ReturnToA, original genuine52 value/time and covered52; Pending snapshot and target unchanged. |
| RF03a | Allowed-state positive control supplies changed valid native and Fields values through the same local writer. | Verified AppliedToB, exact native/Fields rereads and submitting-user History, siblings preserved, no sync Change. | PASS —189 both values AppliedToB; native16 exact readback, History142302–142304 user17, siblings/queue preserved. |
| RF03b | Fresh correction carries the exact ID of a genuine Pending snapshot whose target is currently readonly. | Target stays unchanged, snapshot stays Pending with visible failed coverage and exact cause; attempts increment only for actual processing. No false handled/full coverage or payload/time mutation. | PASS —190 Held; exact readonly field reason,53 Pending/attempt1 with specific coverage refusal; natives18/23 target/History/queue equal. |
| RF03c | After restoring the fixture's permitted state, new correction Work handles the same exact snapshot. | Verified save then only fully covered selected snapshot Done with correct attempt progression; newer/unselected rows unchanged, no sync echo. | PASS —191 Done/handled_done[53],53 Done/attempt2 after verified save;51/52 unchanged. Original snapshot payload/time retained. |
| RF04 | Representative grouped first copy spans configured containers, including a new container with two mandatory text fields; unchanged firstcopy caller omits the new optional by-reference marker. | Complete grouped mandatory values saved/verified, confirmed asset/link/result atomic evidence, siblings/defaults preserved, normal submitting-user History and no sync echo. | PASS —192 Done/new168; both mandatory fields in new container13 saved together after container12 native-add seed, omitted optional marker compatible; all A/B/Both seeds verified, no echo. |
| RF05 | Process-local exact-fixture post-save hook throws the same readonly message after a real save-call boundary. Independent current-value/History/queue readbacks follow. | Generic uncertain-write Held remains; no message-based exemption masquerades as pre-save validation. Confirm normal rollback outcome separately; commit/rollback/release failures remain source-only/unrun. | PASS —native31 reads actual attempted storage value/user17/guardtrue then same-text exception;193 generic uncertain Held. Native30/32 exact value/History/queue equal after normal rollback, guardfalse/locksfree. |
| RF06 | Final exact Work/Change/asset/History readbacks, route disable, own-session closure, guard/task status and permission restoration. | Historical173 unchanged; fresh inputs immutable; only authorized result/attempt/completion fields change. No Accepted left, actual final containment succeeds. | PASS —normal genuine post-fault edit creates54;10 inputs and old173/47–50 unchanged; routes25/26 disabled, new13 inactive/user17 inactive, session closed, Accepted0/task ready. |

Completed source review: only `inc/write.php` changes. The marker starts false,
is forwarded by reference through the guarded Fields writer and switches true
immediately before the actual local update call. Native `update()` sets it at
its call boundary. Pre-save readonly validation therefore keeps its exact
message; post-attempt exceptions retain generic uncertainty. Commit, rollback
and lock-release handling stay unchanged. The sole scalar helper caller passes
the marker; grouped firstcopy omits its new optional argument compatibly. Runtime
RF04 verifies that changed shared-helper signature. No executable source
was edited by the reviewer; the builder's one PHP lint passed.

The complete exact report is [fields-readonly-fix-runtime.md](fields-readonly-fix-runtime.md).
Only approved `inc/write.php` was deployed, with matching host/container SHA-256
`96739770d1958838d277a96c4789fc6cf070138e3e3ec988d1ba51a0f389703d`.
There were30 curl invocations:27 HTTP requests and3 local bad-range syntax
failures, not30 HTTP requests.34 native PHP invocations include one failed
undefined-ID operator diagnostic. Incorrect `handled_change_ids` was rejected400
without a Work; corrected contract input admitted190. These setup mistakes remain
in the ledger, not as product failures or successful HTTP readback proof. Exact
native record readbacks independently supply the required evidence.

The reviewer directly compared all10 admitted immutable Work inputs, old173,
old47–50 and profile16 rights: unchanged. Original51/52 full rows remain unchanged;
53 changes only permitted completion/attempt metadata. Native31's real post-save
value precedes the exception; native30/32 exact rollback comparison and genuine54
after guard release prove the specific boundary. Ordinary rollback succeeded;
COMMIT/ROLLBACK/RELEASE_LOCK failures and adverse metadata/ownership races were
not newly tested. Credential-bearing stored User values in the full report are
redacted as well as clear tokens. No new implementation defect was found in
this bounded pass. No runtime replay, automated tests, product edits or commits
were performed by the reviewer. BR05/BR08/BR11 and all other remaining readiness
limits retain their prior scope; no blanket pilot-readiness claim follows.

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
approved after these fixes; the dependency and subsequent IB runtime evidence are now reviewed below.

Use new disposable enabled routes and already-existing assets, fresh C3 Work
IDs prefixed `review-ib-`, and the normal registered automatic action. Old
admission fixture routes remain disabled; their Accepted rows may become Held
when encountered, without asset writes. Record the exact processed batch IDs.
Do not repeat earlier admission/schema/auth tests. Local failure injection or
control-link fixtures require coordinator approval and normal GLPI methods;
no raw DML, destructive commands or fake production evidence.

| ID | Bounded manual scenario and required evidence | Result |
|---|---|---|
| IB01 | Existing unique serial in routed entity, A-source native text mapping: Accepted before runner; runner locally updates intended field, rereads, records AppliedToB and verified B link Active, then Done/completed_at. Asset History attributes the original submitting user. No asset creation, Change echo, or outbound/self REST. | PASS observed — curl 9–13; local 3,6; Work23 Done/Active with submitter History |
| IB02 | A-source already-equal value yields AlreadyEqual with no redundant update/History. Unmapped, disabled and absent A values leave other asset fields unchanged, with exact enabled-mapping outcomes/reasons. Source B/Both mappings remain unchanged and make this stage visibly Held with not-installed reason; no fabricated return/winner. | PASS observed — Work24 AlreadyEqual, local 4–6 History/Change unchanged; Work46,50 skips; Work55 stage Held |
| IB03 | Verify retained confirmed link is reused after serial changes; arbitrary claimed B ID with no evidence, mismatching retained ID, multiple retained B IDs, linked missing/wrong-entity/deleted/template asset, or competing route/A source ownership all hold visibly without writes. Valid A ID never becomes B lookup ID. | PASS retained reuse/claimed mismatch/unverified claim/competing A source — Work25–27,33; multiple retained IDs and missing/deleted/template/wrong-entity linked asset NOT RUN |
| IB04 | No link: one exact permitted serial match inside routed entity is eligible. Duplicate serial, absent/blank serial, no serial field, inaccessible lookup and zero matches each Hold without create. Case/whitespace-different serial never silently identifies an asset. First-copy zero-match reason explicitly states later-stage unavailability. | PASS exact/duplicate/absent/zero/case/whitespace — Work23,28–32; no-serial type and inaccessible lookup NOT RUN |
| IB05 | Disabled/missing route/type, stale version, wrong A/B entity or settings changed after acceptance Hold before write. Before each subsequent mapping current route/version/mapping/identity are checked again; previous verified writes remain honest partial evidence. | PASS disabled/missing routes, unknown type, stale version, wrong A entity and post-admission setting bump — old1–22, Work34–37,42; wrong B entity/mid-field race NOT RUN |
| IB06 | Worker invoked from normal cron rebuilds captured user/profile from current database authorization, clears cron/inventory privileges and requires current Work READ/CREATE, routed entity and asset rights. Revoke profile/entity/asset/Fields permission after admission: no cron-admin escalation. Inactive/deleted/expired user and active permission-bypass context Hold. Context restores after both success and exception. | PASS Work CREATE and asset READ revocation Holds41/53; Fields write54 Skipped unchanged; caller context and exact rights restored — local 8–10,20–25,31; remaining user/profile/entity/bypass variants NOT RUN |
| IB07 | Single worker lock prevents overlap; at most 20 Accepted rows per pass, ascending IDs, volume reflects processed rows. Already started Accepted Work becomes Held as uncertain with its previous partial evidence and never replays. Held/Failed/Done rows are not reopened by another runner. Use approved safe interrupted fixture; do not change Work processing columns through REST/SQL. | PASS bounded ascending20+2 batches, separate-connection occupied lock volume0 then once, safe before-write started56 Held — local 1–2,26–30; real crash after committed field NOT RUN |
| IB08 | Multiple A mappings with successful and invalid/skipped fields: save per-field verified result as processing progresses; final status reflects actual definite failure/uncertainty and preserves earlier link/outcomes. Interrupt after one verified field only through an approved safe mechanism; later pass Holds instead of rewriting it. | PASS Work47 definite field failure with partial outcomes and confirmed rollback; Work50 valid sibling applied/invalid siblings Skipped — curl 29–30,39; interrupted partial commit NOT RUN |
| IB09 | Native text/finite number/integer/boolean/date/datetime destination writes validate actual bounds/precision/nullable support before save. Date YYYY-MM-DD and datetime YYYY-MM-DD HH:MM:SS are native destination values, separate from +08:00 edit evidence. Invalid/overflow/lossy/overlong values or unsupported null writer leave field unchanged with specific reason, never silent truncation/default. | PASS representative native/Fields/custom scalars and invalid/overlong values — Work46–52, curl 30–31,40–43; incompatible custom12.75 Failed/rollback old2, compatible12 Done49; exhaustive bounds/nullable/custom fractional-step variants NOT RUN |
| IB10 | Required dropdown-label-to-text, text-to-dropdown and dropdown-to-dropdown mappings resolve actual local option labels/IDs; source ID deliberately differs from B ID. Exact unique permitted label/path succeeds; absent/duplicate/wrong-family/out-of-scope/unreadable/empty/null label skips visibly without option creation, trimming/case folding or default clear. Reread actual B ID/value. | PASS three conversions and local IDs native3/custom6/Fields2; missing/duplicate labels Skipped50/51, unreadable Location Skipped46; hierarchy/out-of-scope/all empty variants NOT RUN |
| IB11 | Fields single scalar writer uses real installed metadata/container rights and normal local Fields methods/asset History. Change one mapped scalar while retaining all unrelated scalar and multiple values byte/semantically equivalent after reread; no data loss when whole container normalizes. Current status readonly override denies mapped write. Missing/ambiguous storage and changed metadata stay visible. | PASS Fields scalar writes preserve unrelated textarea and multiple [1,2] — curl31,43; container denial54 Skipped unchanged; ambiguous/missing storage/status override NOT RUN |
| IB12 | Registered custom asset native/virtual custom_* text/number/boolean/date/datetime/dropdown uses generic path and actual field formatter; hidden/readonly/multiple/richtext unsupported mappings never become false AppliedToB. Only intended JSON-backed custom value changes; sibling values remain intact. Record actual type/metadata and readback rather than claiming all types from Computer. | PASS actual custom definition2/asset2 core+virtual scalar writes and siblings, compatible number49 — curl30,41; hidden/readonly/multiple/richtext worker negatives source-only/NOT RUN |
| IB13 | Every local native/Fields/custom update is inside sync guard; no new Pending row. A genuine edit immediately afterwards queues normally once outbound capture is available. Guard releases on thrown/failed save, without cooldown. Verify queue IDs/counts around both operations. | PASS observed worker native/Fields/custom no echo and immediate genuine edit Change14 — local4,6,16,31, curl44; rollback guard recovery inferred from subsequent successful writes/no queue increase |
| IB14 | Suspend/Resume operations and correction handled IDs are explicitly Held/not installed in this stage; controls do not execute, queue stays Pending and no handled IDs are claimed Done. B-owned mappings have no return result yet; Both has no field-time winner yet. Existing verified link evidence survives later Held/Failed processing. | PASS stage boundaries — Suspend/Resume38/39, correction40, B/Both55 Held; Change2 Pending curl45; Active links retained; execution of future operations NOT RUN |
| IB15 | Safely induce local save/reread failure versus transaction commit/rollback uncertainty after an attempted write. Definite failed save is Failed; unknown commit outcome is Held with reason, started marker/partial evidence retained and no blind retry/false Done. No rollback claim is made without proof. | PASS definite reread failure47 with rollback/partial evidence; commit/rollback/lock-release uncertainty source-approved only, runtime injection NOT RUN (no approved safe hook) |

The manual matrix is limited to this completed part. First copy, B returns,
Both arbitration, control execution, correction completion and full flows
remain future-stage requirements, not passing results. The reviewed shared Senior 2(a)
capability/failure-path changes were integrated before this runtime pass.


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
| Senior 1(b), existing-asset worker | Source approved after transaction/finally fixes; dependency integrated | PASS observed stage cases; 48 curl + 31 local invocations independently reviewed | Exact IB01–15 limits; first copy/B returns/Both/controls/correction and uncertainty injections NOT RUN |

## Final product documentation reconciliation

After the complete source and IE runtime review, setup.md and api-contract.md
were reconciled with the implemented processor/admission, current permissions,
installed Fields 1.24.4 capability gate and representative evidence. Obsolete
foundation-only setup claims were removed. Exact wire schemas, five original
contract deliverables, historical reports, initial failures and explicit
verification limits remain intact. Unknown conventions must be explicit
questions; unrun fault injections are limits rather than invented failures.

## Senior 2(b): external Change acknowledgement review and bounded matrix

The complete staged `inc/change.class.php` acknowledgement diff in outbound-b
was read after the builder's ready notice. Source approval: no actionable
blocker found. New validation admits only exact `id`/`status`, rejects owned
fields first, then locks/rereads the Pending row, rechecks current record rights
and entity, verifies immutable route pair and actual asset entity, checks
retained link scope, and performs local GLPI update/reread. The shared local
helper retains its false-on-missing/already-Done behavior. Native V1 wrappers
and missing-ID omission behavior are unchanged. This is source approval only.

Use C4's exact native PUT/GET resources and private service headers. Preserve
submitted queue IDs, pre/post full rows and responses. Use actual genuine
captured snapshots whose local handling is explicitly simulated as complete;
no fake queue/link SQL. Fresh dedicated fixture rows can be created by the
normal approved capture path. Do not repeat completed outbound capture or
admission tests. An old disabled route/newer settings version alone is not a
reason to refuse a completed immutable snapshot's acknowledgement; per-asset
Suspended or actual scope mismatch still blocks it. Successful ack must not
write the asset or create another Change.

| ID | Bounded manual acknowledgement case | Result |
|---|---|---|
| OB01 | Exact Pending row, input object `{id,status:Done}` to ID URL: native 200 array keyed by actual B ID, then GET Done with native done_at/date_mod set. Compare all other saved columns byte-for-byte; original values/times/identity/retry_count/error never change. Asset and queue count unchanged. | PASS curl3–4,68 — exact3 Done; other columns unchanged |
| OB02 | Bulk two explicitly handled Pending IDs: native 200 per-ID true results, read both Done, leave an unselected/newer Pending ID unchanged. Rows from separate native/Fields underlying snapshots require independent full coverage; never infer completion from same asset/field. | PASS curl35,42,68 — separate4/5 Done; newer13 and unselected10–13 Pending |
| OB03 | Pending->Pending, lowercase done, unknown status, Done->Done and Done->Pending reject ASB_CHANGE_TRANSITION; null/number/bool/object status rejects ASB_INVALID_FIELD. Missing status rejects required. Rejected rows retain exact original state; native rights may reject before validation. | PASS curl5–14,67–68 — exact transitions/type/required failures, row2 later legitimate Done only |
| OB04 | Each B-owned field supplied even unchanged/null (route/version/A+B entities/type/identity/changed_fields/retry_count/error/date_creation/date_mod/done_at) rejects ASB_B_OWNED_FIELD. Unknown/bypass keys reject ASB_UNKNOWN_FIELD. Combined owned+unknown+missing status prioritizes owned, then unknown, then required; lexical key ordering within category. | PASS curl15–30,68 — every declared owned column, bypass and priority/order failures; immutable payloads retained |
| OB05 | Malformed/nonpositive/string/float id rejects where plugin validation is reached. Missing ID in a native collection PUT can be skipped by V1 before class validation; record actual wrapper/omission, not an invented plugin required-message guarantee. Same native boundary applies to known absent development ID. Compare result ID keys and GET unresolved IDs. | PASS curl31–34,68 — string ID reaches plugin invalid; zero/float native400/null, collection no-ID200[[]] no mutation; other malformed ID shapes NOT RUN |
| OB06 | Mixed bulk valid Pending + Done transition failure + forbidden field gives native 207 ERROR_GLPI_PARTIAL_UPDATE and per-ID booleans; only valid rows change. All invalid array gives native 400 ERROR_GLPI_UPDATE; singleton denial scalar message shape. Preserve success despite sibling failure; no batch rollback assumed. | PASS curl36–37,68 — exact207 mixed per-ID true/false and400 all-invalid array; valid6 persists |
| OB07 | Mixed real Pending plus known absent ID and all-absent batch: record installed 11.0.7 missing-ID omission exactly. Do not map results by array position or use forcedisplay on PUT; omitted IDs unresolved, GET404 is not an acknowledgement. | PASS curl38–40,68 — mixed7+absent207 only7 entry; all-absent400/[]; absent GET404; no PUT forcedisplay |
| OB08 | Genuine unlinked snapshot `identity.a_items_id=null` can be acknowledged when actual B asset is still in routed entity and no conflicting/suspended retained link exists. Disable its route/bump version/type settings through normal saved settings first; old snapshot still acknowledges if route pair/current B scope remain valid. Preserve settings and asset unchanged by ack. | PASS observed genuine unlinked3/4/5/6/7/8/2 under disabled route6/newer version6 — curl3,35–38,54–55,67 |
| OB09 | Known verified link Active permits scope check; latest retained Suspended, competing identities, mismatching known link, missing linked evidence or actual B asset missing/wrong entity reject while Pending remains unchanged. Use trusted normal worker/control evidence only; unsupported fixture states stay NOT RUN until those parts exist. No raw DML or unrelated asset moves. | PASS known Active14 and cross-route historical unlinked15 rejected after real Work58 — curl41,43–52/local1; Suspended, same-route competing/missing/mismatched links and missing/wrong-entity asset NOT RUN |
| OB10 | Restricted Change read-only/no-update and out-of-entity users cannot acknowledge. Record native access/per-row wrapper, GET permitted state as authorized actor afterwards. Check profile/entity rights under actual API session, not admin privilege. No deletion/purge requests. | PASS actual read-only/no-rights/outside sessions curl58–66; exact profile14 Change rights restored3 local3–5 |
| OB11 | Two manual independent sessions concurrently acknowledge the same Pending row: exactly one transition succeeds, second rejects after locked reread, exact row remains Done with one immutable payload. Lost response reconciliation reads IDs before retrying; no automatic Done->Done success. | PASS two independent concurrent sessions curl53–57 — one200, one400 Done transition; row8 exact Done; lost-response/stress variants NOT RUN |
| OB12 | Local markQueueRowsDone remains exact-ID and caller-coverage controlled after refactor: selected handled Pending changes, missing/already-Done return false, unrelated Pending row unchanged; internal guard releases after rejected save. Do not duplicate completed helper proof unless this refactor requires the changed-path observation. Safe persistence/verification failure injection remains NOT RUN absent an approved local hook. | PASS local2 — Done3 false, missing false, selected9 true; exact unselected10 unchanged; persistence/verification injection NOT RUN without safe hook |

No automated test, runtime curl, deployment or implementation edit was performed
by the reviewer. External acknowledgement completion does not certify A's save,
correction coverage, control processing or full product flow. Record executed
OB evidence and unexercised cases separately before any documentation commit.

### Outbound (b) scoped ownership review clarification

Follow-up source review of the specific cross-route case found a P2 gap:
`checkAcknowledgementLink` queries only same-route/type retained Work, so a
historical unlinked snapshot in route R1 could become Done even after the same
B asset has verified ownership by another A source under route R2. The contract
at section 1.2/Q1 requires distinct source identities and visibly held competing
links/ownership across many-to-one entity routing; it provides no acknowledgement
exception. Inbound matching already rejects that contradictory ownership.
Add the same current-B-asset cross-route ownership guard before Done. This does
not mean R1 is implicitly Suspended and does not authorize relinking. The normal
unlinked/no-conflict acknowledgement must remain allowed. Initial source approval
did not cover this contradictory cross-route case; approval of that path is
withheld pending the targeted guard. OB09 must include this specific historical
unlinked-snapshot/later-foreign-route-link case using trusted worker evidence,
or remain NOT RUN if that fixture is unavailable.

Final documentation assignment also includes current api-contract.md status:
replace future-plugin/task and absent-live-inventory wording after final code,
with actual Fields 1.24.4/representative evidence and explicit non-exhaustive
installed-field limits. Preserve wire schemas and historical runtime claims.

Outbound (b) targeted cross-route fix reviewed once: the locked retained Work
query now includes the same itemtype with either the snapshot route or its
current B asset ID, limited to verified Active/Suspended evidence. A different
route for that B asset rejects ASB_CHANGE_IDENTITY_AMBIGUOUS before same-route
latest-state checks. Same-route Suspended/missing-known-link checks and the
ordinary unlinked/no-conflict/disabled-route allowances remain. No actionable
finding in the changed function. Source approval is restored for the first OB
runtime pass after IB; cross-route runtime proof remains NOT RUN until a trusted
fixture is available. The original P2 and its targeted fix are both retained.

### Senior 1(b) executed evidence review

The independent reviewer inspected the complete redacted operator ledger and
its actual Work/asset/Fields/custom/History/queue readbacks. No implementation
blocker was found in this stage's observed execution. The full 48 manual curl
requests/responses and 31 native local operations are preserved verbatim in
[inbound-b-runtime.md](inbound-b-runtime.md). The reviewer performed no runtime
request, mutation or repeated source check during this evidence review.

Work23–57 end as 10 Done, 24 Held and 1 Failed; no Accepted remains. The Failed
Work47 is the deliberately incompatible custom NumberType decimal12.75:
reread did not confirm the intended value, rollback preserved prior2, and
successful sibling writes plus the verified Active link remain recorded.
Fresh Work49 later applies compatible integer12; no failed Work was replayed.
Operator fixtures43–45 used stale version1 after the route reached3 and
correctly Held; fresh46–48 executed with reconciled version3. Preserve these
fixture mistakes and truthful failures rather than replacing their history.

Existing lookup uses retained links after serial change and rejects the tested
ambiguous/unverified/competing-source cases. History and current permission
revocation evidence show captured service user12/profile14 rather than cron
administrator rights. Bounded20+2 execution and the second-connection advisory
lock are actual runtime observations. The interrupted fixture56 was marked at
the safe before-write local processor boundary: it proves started-Work Hold,
not recovery after a partially committed crash. Commit/rollback/release failure
injection remains source-only because no safe approved fail hook exists.

Fields container7 scalar writes preserve the unrelated textarea and multiple
JSON [1,2]. Computer149, Monitor2 and custom definition2/asset2 provide actual
representative generic writes; this does not certify every installed type,
field kind, metadata option or permission combination. Only genuine immediate
edit Change14 is new: all worker native/Fields/custom writes produce no echo.
Change2 remains Pending after the explicitly Held correction-stage Work.

Final Setting10 is disabled/version5; exact Work/Computer/container permissions
are restored to5/7/4, native task state returns1, and all three API sessions
were closed. Old admission Work1–22 are now Held under contained routes with
no asset/link writes. Changes1 Done and2–14 Pending are preserved. First copy,
B returns, Both arbitration, Suspend/Resume execution, exact correction
completion and full end-to-end flow remain later-stage requirements. The
unrun variants in IB01–15 remain explicit; no passing claim extends to them.

## Senior 1(c): first-copy candidate bounded manual matrix

Prepared from approved spec section 4 and contract sections 1.4/5.3/Q8–Q10.
This is a future candidate checklist, not source approval or executed evidence.
Review only the completed first-copy diff when ready. Keep IB's historical
zero-match Held result; the new stage changes fresh eligible zero-match Work
only. Reuse the approved native REST Work POST/GET path and bounded local
processor; no direct asset-create shortcut or fake retained-link SQL.

Use disposable routes/types and new permitted serials verified absent inside
the exact routed B entity under the captured submitting account. Record
pre/post asset IDs, native History, queue IDs/count, current mapping/version,
and full Work result. Fields/custom metadata and generated columns must be
actual installed descriptors. Do not repeat passed admission/IB/OC tests.

| ID | Bounded first-copy scenario and required evidence | Result |
|---|---|---|
| IC01 | Complete permitted exact-serial lookup positively finds no B asset; fresh Work is Accepted before execution. Background local add creates exactly one asset of enabled type in routed entity, reread confirms intended values, verified Active link and confirmed positive b_items_id/created_b_items_id, correct completed status/outcomes and submitter History. No sync Change. | PASS observed — local2 positive native/requested-type zero, curl5 Accepted, Work59/60 Done with confirmed153/4 and verified Active; native History user12 |
| IC02 | First copy seeds enabled supported supplied A mappings once for source A, B and Both; equal/missing/unreliable time evidence never selects an existing-value winner for a new asset. Disabled/unmapped/absent A values do not fabricate writes, and missing supported values have specific outcomes. All original Work input remains immutable. | PASS observed — Work59/60 seed A/B/Both despite unreliable/absent times; disabled/unmapped ignored, absent Skipped; all10 immutable inputs reconciled curl17 |
| IC03 | Native text/scalar/dropdown, actual custom asset virtual scalar and installed Fields scalar destinations use generic descriptors/local methods. Required label conversions resolve unique permitted B options, with local IDs distinct from A. Reread raw/virtual custom values and Fields storage; unrelated defaults/siblings survive. Record representative types, not “all types.” | PASS representative — native text/dropdown, custom text/dropdown/datetime and grouped mandatory Fields containers8/9; actual two-definition shared serial assets3/4 distinct; other scalar permutations NOT RUN |
| IC04 | Definite invalid/unsafe/unwritable supplied mapping or missing/duplicate/unreadable dropdown option follows approved per-field skip/failure policy with exact reason. Supported sibling values may succeed honestly. No option creation, generated bookkeeping/entity/deletion mapped write, silent truncation/default or false AppliedToB. Metadata rejection already covered by Setting admission is not rerun. | PASS observed — missing option65 Skipped with siblings created154, mandatory64 Failed; optional omitted Fields default columns remain null (no default-application claim); other invalid combinations prior IB/source-only |
| IC05 | Missing usable identifier, duplicate serial, inaccessible/incomplete lookup, unverified claimed B ID or contradictory retained ownership Hold and create zero assets. Use only new first-copy boundary variants not already proved by IB, and retain IB results as prior evidence. A remote ID never becomes a local B ID. | PASS competing source62 and unverified claimed B3 Work66; local10 wrong-concrete helper rejects; two-definition lookup isolates requested type. Missing/duplicate/general denial prior IB; no fabricated retained link |
| IC06 | Current route/version/type/entity or submitting Work/asset CREATE/field rights change after admission: Hold/skip as specified before the affected action, with no cron-admin bypass or forbidden creation. Restore only new test-profile rights through normal GLPI methods. Do not move an existing asset or infer no match from denied READ. | PASS current CREATE67 and stale settings68 Held/no assets — local6–10, curl17; other after-admission field/profile/entity variants NOT RUN/prior IB |
| IC07 | After confirmed creation, a fresh ordinary Sync with same route/A identity verifies/reuses the retained asset even if serial changed: no second add, created_b_items_id null on reuse, no repeated first-copy seeding. Source B/Both existing-asset processing remains explicitly outside this part until implemented. | PASS actual reuse61/63 asset153 after genuine serial change, created ID null, B/Both seeds unchanged — curl10–13,18; stage Held remains honest |
| IC08 | Two fresh A identities or routes try the same destination identity: verified competing ownership Holds visibly, never silently links both to one asset. Two eligible fresh Works for the same source/serial cannot create duplicate assets through the one-worker/route-identity locking boundary. Use real concurrent native connections only if separately authorized/needed. | PASS sequential source boundary59→61 creates once, other source62 Held; concurrent creation SOURCE ONLY/NOT RUN |
| IC09 | Definite local add rejection/false save or reread verification failure reports Failed or Held according to actual certainty, never Done/confirmed created ID without proof. Confirm rollback only from actual readback. Preserve any verified asset/link/partial field outcomes honestly; later runner does not reopen terminal Work. | PASS definite mandatory add rejection64 with no asset/orphan Fields storage — local10; no confirmed link/created ID. Other add/reread/transaction failure injections NOT RUN |
| IC10 | Safe approved interruption after add but before Work/link completion, if a real hook exists: durable started marker and any confirmed partial evidence survive; next runner Holds uncertain instead of blindly creating again. Lost response is reconciled by original Work ID and actual asset/link reads. No destructive SQL, code damage or invented injection; absent safe hook record NOT RUN/source-only. | NOT RUN/source-only — no safe after-add interruption or commit-failure hook; prior IB before-write started-marker proof does not establish after-add crash recovery |
| IC11 | Every native/custom/Fields first-copy save runs inside sync guard, including later seed updates. Queue count/IDs remain unchanged; immediate genuine edit afterwards queues normally with original evidence. History identifies captured submitting user; caller cron context restored after success and failure. | PASS representative no sync echoes, immediate genuine Change16, native/Fields History user12 and restored worker context — curl20/local3–5,7,9–10; concrete custom History query empty, attribution unproved |
| IC12 | Suspend/Resume, returned B values/Both arbitration and correction completion remain explicitly Held/not installed if absent in this part. Existing Pending Changes stay unchanged and no handled IDs are claimed Done. First-copy completion alone does not certify full product flows. Preserve all fixtures and disable only new test routes after readback; no delete/purge/cleanup. | PASS observed B/Both stage Held61/63, empty returned/covered/handled outputs, earlier Pending unchanged; Suspend/Resume/correction execution NOT RUN |

Source approval and actual IC evidence will be appended separately after the
completed candidate and operator report. Unsafe recovery injection, unsupported
metadata combinations and unexercised types remain explicitly unrun.

### Senior 2(b) executed evidence review

Independent review of all 70 manual curl entries and 5 native local operations
found no implementation blocker in the observed acknowledgement stage. The
complete redacted ledger is preserved verbatim in
[outbound-b-runtime.md](outbound-b-runtime.md). Comparison of baseline call2
with final call68 confirms original Changes1–14 retain every column except
allowed status/date_mod/done_at byte-for-byte. No reviewer runtime request,
deployment, implementation edit or repeated source check was performed.

Exact singleton/bulk completion, owned-field priority, invalid transitions,
profile/entity denial and actual two-session acknowledgement are observed.
The native absent-ID omission and no-ID200[[]] boundaries are documented in
api-contract section 3.2; HTTP success alone does not prove completion.
Unlinked genuine snapshots under a disabled/newer route still acknowledge.
The P2 cross-route fix has actual proof: genuine historical unlinked15 under
route11 remains Pending after normal Work58 confirms Active B152/A933101
ownership under route12, and ack rejects competing_route. Worker and ack
leave the fresh asset's History count2 unchanged; existing Computer149's
History remains29. No fabricated link/queue fixture was used.

Final Done IDs are1–9 and14; Pending10–13 and15. Change1 was already Done.
Only the explicitly authorized genuine scope edit created new Change15;
acknowledgements created no asset or queue row. New routes11/12 are disabled
at version2, profile14 Change rights restored3, and all five sessions closed.
A's complete handling was explicitly simulated for these acknowledgements;
this does not certify A's actual save or full product flow. Suspended-link
execution, destructive missing/wrong-entity asset fixtures, other contradictory
same-route link variants and unsafe persistence/verification failure injection
remain NOT RUN, as specified in OB01–12. Source and observed runtime are
approved for this part; the original P2 finding and targeted fix stay visible.

### Senior 1(c) initial source review

The complete four-file staged candidate (`process.php`, `write.php`,
`work.class.php`, new `firstcopy.php`) was read. Atomic asset/link evidence,
all-source seed planning, grouped Fields writes, local History/loop guard,
explicit transaction uncertainty and no-replay start marker are present.
Approval is withheld for a concrete custom-type identity scope defect.

**P1:** `firstcopy.php` lines31–35 and the shared serial lookup in
`process.php` query the physical table by entity/serial without the concrete
asset type's system criteria. Installed GLPI11.0.7
`CustomObjectTrait::getTable()` returns the shared base asset table, while
`getSystemSQLCriteria()` adds the concrete definition foreign key.
`CommonDBTM::getFromDB()` does not add that criterion itself. A different
custom definition with the same serial can incorrectly prevent requested-type
first copy, or the existing path can retain a wrong-type link before a later
update rejects the definition mismatch. The complete/locking lookup must
respect the requested type's real system criteria, and reread/retained asset
identity must verify the concrete definition. Do not add per-type architecture.

IC03/IC05 must include a fresh requested custom type whose serial exists only
under a different custom definition: the other asset stays unchanged and is
never linked, while the correct type's complete zero-match proof allows its
own first copy. A retained wrong-concrete-type asset must Hold, not become
verified under the requested type. Until fixed and reviewed, do not deploy
this candidate or claim the prepared IC matrix passed. No reviewer runtime
request or implementation change was performed.

Senior 1(c) targeted custom-type fix reviewed once after the completed ready
notice. Shared `serial_criteria()` now includes the requested type's actual
`getSystemSQLCriteria()` in both normal complete lookup and the locking
FOR UPDATE query. Central `check_asset()` checks the exact requested class
and a physical row matching its system criteria before retained/result link
verification or writes. This uses installed generic GLPI APIs with no per-type
branch. No actionable defect remains in these affected changes. Source approval
is restored for the first IC runtime pass; the two-definition same-serial
runtime case remains required and NOT RUN until the operator records it.
The original P1 finding is preserved above. No deployment, curl or implementation
edit was performed by this reviewer.

## Acknowledgement integration: concrete custom-type scope fix

The completed isolated `inc/change.class.php::checkAcknowledgementScope()`
change was reviewed once. Its lookup now combines the table-qualified actual
index with the requested type's installed `getSystemSQLCriteria(table)` via
`getFromDBByCrit()`. A missing/mismatched concrete asset rejects with
`ASB_CHANGE_SCOPE_MISMATCH: reason=asset_identity` before link validation;
entity, retained scope and exact Pending-to-Done rules are unchanged. No
source blocker found. This source approval alone is not runtime evidence.

| ID | Bounded manual proof | Result |
|---|---|---|
| AT01 | Using two real installed custom definitions/assets already authorized for IC, inspect their definition IDs/shared physical table and generated system criteria read-only. The right type+actual ID lookup succeeds; the other type+same ID lookup returns no row with the new criteria. No persisted snapshot identity is changed. | PASS read-only local1/2 — actual definitions3/4 share table; requestedID4/otherID3 found and crossIDs rejected by qualified system criteria |
| AT02 | A genuine captured Pending snapshot for the correct custom type is explicitly fully handled by simulated A; native exact-ID acknowledgement succeeds and GET confirms Done with all payload/identity/original times unchanged. Asset/History and unselected Pending rows stay unchanged. Use a new eligible real snapshot or one existing unhandled fixture, and record exact type/ID. | PASS curl2–6/local1–2 — genuine custom Change12 exact200 then Done; only status/date_mod/done_at changed, Pending13/assets/queue16 unchanged; custom History query empty, no population claim |
| AT03 | Wrong-concrete-type snapshot acknowledgement must reject asset_identity if a safe genuine fixture naturally exists. Do not fabricate a persistent Change identity, move/redefine an existing asset, or use raw SQL to reach it. If no real fixture exists, the external rejection path remains source-only/NOT RUN; AT01 read-only criteria evidence does not count as an actual invalid acknowledgement. | NOT RUN/source-only — no safe genuine mismatched snapshot; no invalid external acknowledgement attempted or inferred from read-only criteria proof |

The earlier OB ledger and P2 ownership finding remain historical evidence.
Deploy/run this isolated fix only when the coordinator schedules it after the
ongoing IC pass. No runtime/deploy, implementation edit or commit by reviewer.

### Senior 1(c) executed evidence review

The independent reviewer inspected the complete 23 manual curl requests and 10
native local operations, including Work/asset/custom/Fields/History/queue
readbacks. No implementation blocker was found in observed execution. The
full redacted ledger is preserved verbatim in
[inbound-c-runtime.md](inbound-c-runtime.md). All 10 submitted Work inputs match
final call17 byte-for-byte. No reviewer runtime request, mutation or source
replay was performed during evidence review.

Work59/60/65 are Done with confirmed new IDs153/4/154; Work64 is Failed after
mandatory Fields input caused native add rejection, with no failure-serial
asset or orphan Fields storage. Work61/63 reused153 without reseeding and
remain Held for later B-return/Both processing; Work62 competing source,
66 unverified B claim,67 revoked CREATE and68 stale settings are Held.
The requested custom definition3's true zero-match lookup creates asset4
while other definition4 same-serial asset3 remains unchanged/unlinked.
The read-only wrong-loaded-type helper check rejects actual definition4
loaded through requested definition3's class, providing focused P1 fix proof.
It does not fabricate or certify a persisted contradictory retained link.

Two actual mandatory Fields containers seed together within their own local
saves, including grouped initial-container values. Native/custom A/B/Both
mappings seed once regardless missing/unreliable times. Omitted optional
Fields storage remains null; metadata default text is not claimed applied.
Representative custom datetime raw UTC09:18:19 rereads virtual native
17:18:19 as intended. This proves the exercised metadata, not every type,
scalar permutation or installation option.

Queue count15 becomes16 solely from the immediate genuine native name/serial
edit, linked A944001/B153; later sync does not rewrite its original evidence.
Native/Fields History identifies user12. The exact custom-type Log query is
empty, so custom History attribution remains unproved by this pass. Worker
caller user2/profile4/cron is restored after success and rejection; volumes
are 4/4/1/1 and task ready state1. Setting13 is disabled/version3, Computer
rights restored7, fresh container rights restricted to profile14 with4, and
the one session closed. Fixtures and all historical ledgers are preserved.

Source and observed runtime are approved for first-copy(c). No safe after-add
interruption/uncertain-commit injection was available and no concurrent-create
race was executed; those paths remain source-only/NOT RUN. First-copy success
does not certify B returns, Both arbitration, scope controls, correction
completion, exhaustive generic support or full product flows.

### Acknowledgement concrete-type fix executed evidence review

The independent reviewer read all 7 actual curl requests/responses and 2
read-only native operations in [ack-type-runtime.md](ack-type-runtime.md),
preserved verbatim. No implementation blocker was found in the observed
integration pass. Real definition3/4 criteria find each correct ID and reject
cross-definition IDs. This is read-only lookup proof; it does not certify an
invalid external acknowledgement that was never attempted.

Genuine custom Pending12 under definition1 was explicitly fully handled by
simulated A, acknowledged with native200 exact-ID true, and read back Done.
Only status/date_mod/done_at differ; original snapshot identity, payload,
creation and field-evidence times remain exact. Pending13 and all other
unselected Pending rows, selected/shared custom assets and queue count16
remain unchanged. The selected custom History query stays empty, so no
positive History population claim is made. The session closed successfully.

Source and observed AT01/AT02 runtime are approved. AT03 remains source-only:
no naturally invalid genuine snapshot was available, and none was fabricated.
No reviewer runtime request, implementation edit, deployment or repeated
source check occurred. Historical OB/IC results and their limits remain intact.

## Senior 1(d): B returns, corrections and scope controls bounded matrix

Prepared from approved spec sections4–7 and contract result/scope/Change rules.
This checklist was prepared before part(d) source review; the completed review
and actual results are recorded below. Both arbitration remains part(e). Use fresh Work IDs and
real retained links/genuine immutable Pending snapshots; preserve historical
IB/IC stage Holds rather than replaying their terminal records. Use the same
native Work POST/GET and exact Change GET/PUT resources defined above, plus
the approved scoped local worker. No direct metadata SQL or fake queue/link
identities. A's handling is explicitly simulated where an acknowledgement is
needed; no A implementation or outbound connection is exercised.

The coordinator clarified `retry_count` as actual correction processing
attempts: the first validated correction attempt counts1. Polling, missing
IDs and wrong-scope references do not mutate attempts/errors. Failed coverage
on an actual validated attempt leaves a visible Pending reason. Record exact
per-row before/after metadata, payload and original field times to separate
attempt bookkeeping from immutable genuine edit evidence.

| ID | Bounded part(d) manual scenario and required evidence | Result |
|---|---|---|
| ID01 | Existing verified Active asset with source B fields different from A: B remains unchanged; Work Done returns exact current scalar/label values in b_values_for_a and ReturnToA outcomes. Genuine per-field evidence uses original captured +08:00 seconds, never Work/poll/sync time. Native/Fields/custom representatives and dropdown label conversions use actual metadata; equal supplied values cause no redundant local save. Record the actual return/equality outcome and returned evidence. | PASS representative Work71–74 native/Fields/custom values/labels/times; Computer+Fields READ1 Work73/equal returns no save; custom read-only-right reduction NOT RUN |
| ID02 | B-source return without a reliable genuine field snapshot still follows B ownership; changed_at/reliable honestly represent unavailable evidence without inventing a timestamp. Genuine saved evidence for unrelated fields or whole asset date_mod is not borrowed. Invalid/unreadable field/option returns a visible field reason rather than foreign option ID or false reliable value. | PASS initial absent evidence null/false and no borrowed asset timestamp — Work71/72/87; unreadable/foreign option variants NOT RUN in this pass |
| ID03 | A-start return covers only exact Pending snapshots whose every saved field value/time is represented by the Work's returned B values under current route/type/entity/identity/mapping rules. Verify covered_change_ids, leave those rows Pending until simulated A save+exact ack. A snapshot mixing returned and uncovered fields stays outside coverage; separate native/Fields snapshots are independent. | PASS Work73 covered exactly19/20, mixed18 excluded; Work74 covers21; Pending/attempt0 until simulated A ack19/20 curl21 |
| ID04 | Two genuine sequential edits to same field give separate immutable IDs. Current return must not claim a stale older value/time or a newer/unseen snapshot merely because asset/mapping matches. Preserve original snapshots even if no longer covered; exact returned coverage and current value/time are reread. Work polling changes neither rows nor attempts. | PASS actual17/18/19 immutable distinct edits, current19 only full coverage, poll exact queue unchanged — curl16/18/20 |
| ID05 | Valid correction Work with handled_change_ids for a genuine A-owned edited snapshot: prevalidate all referred route/entities/type/identity/current settings/mappings/scope and original times before any asset write, apply A value locally with reread, then complete exactly fully covered IDs. Work reports exact handled_change_ids_done; no second external acknowledgement required and no sync echo. First validated attempt increments retry_count0→1. | PASS native/Fields corrections79/80 verify actual local values, exact eligible Done IDs, validated attempt0→1, no sync echo |
| ID06 | Mixed handled IDs containing valid plus missing/wrong-route/wrong-entity/wrong-type/wrong-identity reference Hold before asset writes or attempt/error mutation on any unrelated row. Use genuine available mismatches; nonexistent harmless ID is allowed. Omitted/Done references follow current approved correction semantics; do not fabricate snapshots or relink assets. | PASS missing/wrong-route/type/identity mixed references75–78 Held before writes/attempt/error mutation — curl27–29/local7; separate wrong-entity fixture NOT RUN |
| ID07 | One correction snapshot contains multiple fields but Work omits one required winning value, mapping becomes disabled/unavailable, or a field fails/skips: row remains Pending with visible actual coverage failure, no false whole-row Done. Verified partial writes/outcomes remain honest. retry_count reflects only actual validated attempt; original snapshot values/times/identity stay immutable. New fresh Work is needed after reconciliation; no terminal Work reset. | PASS missing contact on multi-field23 Pending/error/retry1, Work79 partial evidence — curl30–31; newly disabled/unavailable mapping variants NOT RUN |
| ID08 | Multiple selected snapshots with independent full/partial coverage: only fully verified eligible snapshots may become Done, unselected/newer rows remain Pending. Already Done IDs may be reported as covered by a successful correction without rewrite or extra attempt; ordinary external Done→Done still rejects. Record exact response/readbacks, not inferred batch completion. | PASS partial23 vs full24/26, unselected25; fresh80 finishes23 retry2, already Done24/26 exact unchanged retry1 — curl31/33; external Done→Done prior OB |
| ID09 | Actual definite save/reread failure or safe correction-completion persistence failure leaves Pending evidence and visible Work Failed/Held according to certainty; no handled ID reported Done without confirmed transition. No automatic retry or fabricated rollback. Unsafe injection stays NOT RUN unless an approved real hook exists; prior IB/IC failures are separate evidence. | NOT RUN/source-only — no safe save/persistence failure injector; actual missing-field coverage79 is not a false-save proof; prior IB/IC failures remain separate |
| ID10 | Valid Suspend Work on existing verified Active link uses empty values/times/handled IDs: Done records same b_items_id with Suspended, no asset move/update/add/reseed, no queue acknowledgement or payload mutation. Retained Work remains durable. Asset History and queue count unchanged by control. | PASS Suspend81 same155/Suspended with no asset/storage/History/queue changes — local10–12, curl49 |
| ID11 | After Suspend, ordinary Sync Holds without asset writes/first copy and cannot reactivate; a genuine mapped native/Fields/custom edit for that relationship creates no Change. Existing Pending rows remain readable, but external ack and correction reject while Suspended without invalid attempt mutations. Other independent active routes remain scoped to their own links. | PASS suspended native/Fields captures suppressed, Sync84/correction85 Held, ack27 native400 ASB_CHANGE_LINK_SUSPENDED/attempt0; independent custom5 captures28 |
| ID12 | Valid Resume rechecks link/current route/type/entity/submitter rights, records same verified asset Active and Done with no asset save/reseed or immediate value exchange. Fresh subsequent Sync reuses link; immediate genuine edit queues again with original evidence. No cooldown. | PASS Resume86 same155 Active/no writes or exchange; Sync87 reuses, unavailable evidence honest; immediate genuine29/30 — local14–17/curl42–45 |
| ID13 | Suspend/Resume with no retained verified link, unverified claimed B ID, competing ownership, unavailable/deleted/wrong-entity asset, stale/disabled route/type or revoked current rights Holds with visible reason and no asset/queue mutation. Use safe real cases; destructive asset movement/deletion or fake retained records NOT RUN. Failed control cannot change effective prior Active/Suspended state. | PASS no-link82/unverified83/stale88 Holds; deletion/movement/revoked-control-rights/competing-control variants NOT RUN |
| ID14 | Latest successful control determines state across intervening Sync/Held/Failed records. Suspend then later Sync cannot reactivate; Resume then ordinary Sync retains Active. Historical queue completion under merely disabled/newer settings remains compatible with OB, while actual Suspended scope blocks it. Retained links survive all outcomes. | PASS Suspend81→Held84/85 remains suspended, Resume86→Sync87 Active, stale88 cannot override; historical disabled ack prior OB/AT not rerun |
| ID15 | Changed A/B entity pair uses separate immutable route; no move/delete/archive or automatic relink. Returning to original pair verifies/reuses original B copy without first-copy seed. Distinct A identities routed many-to-one do not share a B asset, and custom-type system criteria plus acknowledgement guard remain intact. Reuse existing safe scope fixtures; unexercised transfer variants stay NOT RUN. | NOT RUN new transfer/entity-pair/many-to-one variants; prior competing ownership/custom type scope evidence retained, no automatic move/relink observed |
| ID16 | Single bounded worker uses captured current user/profile and restores caller context for returns, corrections and controls. Results/attempts are durable and terminal records never reopen on polls or duplicate POST. Both mappings remain visibly Held/not installed in this part; no invented time winner. No queue time replaced by sync/ack/attempt metadata. | PASS observed captured context restoration, immutable inputs/evidence and terminal records; Both89 stage Held; duplicate/global admission prior evidence, unsafe injection NOT RUN |

This matrix adds only new part(d) boundaries. Earlier admission, first-copy,
scalar-writer and external acknowledgement successes are not scheduled for
blanket reruns. Record source approval and full operator ledger separately;
source-only/unsafe/unavailable fixture variants must remain visibly unrun.

### Senior 1(d) completed source review

The completed six-file staged candidate was read: `process.php`, `write.php`,
`fields.php`, `change.class.php`, new `results.php` and `scope.php`. No actionable
source blocker was found. Existing first-copy/Work code and the separately
merged concrete custom-type acknowledgement guard are retained. No unfinished
candidate, runtime request, deployment or implementation edit was involved.

The new read descriptor mode checks current asset and Fields-container READ
rights while retaining hidden/entity/scalar restrictions; default writer
permission/readonly behavior remains unchanged. B-return values use local
scalar/label reread and the latest applicable genuine field snapshot, without
falling back to an older coincidentally matching value or inventing evidence.
Returned coverage checks every field in each exact Pending snapshot.

Correction references are fully scoped and permission-checked before asset
writes and revalidated before each mapped write. Actual Pending attempts use
trusted local metadata methods; polls and already Done rows do not increment.
Whole-snapshot completion rereads current locked asset/field storage, confirms
every winning field outcome, then saves the exact Done transition and Work
progress within the transaction. Partial/failure reasons stay visible; input
ID lists alone never prove completion. Current Change READ/UPDATE and entity
checks precede trusted metadata/completion actions. Unsafe persistence failure
injection remains a runtime limitation to record honestly, not a source pass.

Suspend/Resume requires retained verified link evidence and current scope/
permissions; control state and Work Done save together with no asset save.
Latest successful control takes precedence for normal Sync, so a newer Held
Sync does not reactivate Suspended state. Both arbitration remains visibly
Held/not installed for part(e). Source is approved for the first bounded
ID01–ID16 runtime pass; all actual matrix results remain NOT RUN until the
operator ledger is independently reviewed. No code or runtime commit by reviewer.

### Senior 1(d) executed evidence review

The independent reviewer inspected all 53 manual curl entries and 19 native
operator invocations in [inbound-d-runtime.md](inbound-d-runtime.md), copied
verbatim with redacted credentials. No implementation blocker was found in
observed execution. All 21 submitted Work inputs and original immutable
snapshot columns reconcile exactly. The reviewer performed no runtime replay,
deployment or code edit. Source and observed part(d) runtime are approved.

The operator's invalid dropdown destination mode was correctly rejected at
curl6; admitted69/70 then Held unavailable route with no write/link. Corrected
Setting14 and fresh71/72 provide actual return proof. These fixture mistakes
are preserved. Native/Fields/custom current B values and readable labels are
returned, with original genuine field times where available and honest
null/false otherwise. Computer and new Fields rights were reduced to READ1
for Work73, with exact History/queue unchanged; custom return was exercised
under its existing rights, not a custom-readonly runtime claim. Work73 covers
exactly19/20 and Work74 covers21, with mixed/older snapshots excluded. Polls
leave queue bytes unchanged and returned coverage stays Pending until A's
explicit simulated save and exact acknowledgement.

Mixed invalid correction references75–78 Hold before writes or attempt/error
mutation. Actual79 applies native/Fields A values, keeps partial23 Pending
with visible missing-contact error/retry1, and completes exact24/26 retry1.
Fresh80 reconciles and completes23 retry2 while already Done24/26 preserve
all bytes including original done_at/retry1. Newer unselected25 stays Pending.
No immutable snapshot payload, identity or genuine field time is rewritten.

Suspend81 records retained155/Suspended without asset/storage/History/queue
mutation; no-link82 and unverified83 Hold. Genuine suspended native/Fields
edits create no snapshot, independent Active custom5 still captures28, and
ack27 returns exact ASB_CHANGE_LINK_SUSPENDED with unchanged Pending/attempt0.
Sync84/correction85 cannot reactivate. Resume86 retains155/Active with no
asset/value exchange, Sync87 reuses without reseeding, and immediate genuine
edits queue29/30. Stale88 cannot override Active;89 honestly Holds at the
future Both boundary. These real controls fill previously unrun suspension
boundaries in OC/OB without retroactively changing those historical ledgers.

Final Works69–89 are 8 Done/13 Held, zero Accepted. Exactly 14 genuine captures
add17–30; every worker return/correction/control and suspended native/Fields
edit adds no echo. Setting14 is disabled/version3, Computer rights restored7,
new Fields associations restricted to profile14 right4, caller context restored
and the session closed. No Work created an asset in this pass. Unsafe native/
persistence failure injection, new entity transfers, destructive scope/control
fixtures and remaining ID variants stay explicitly NOT RUN/source-only.
Both arbitration and full product flows still await part(e).

## Senior 1(e): Both arbitration and numeric equality bounded matrix

Prepared for the final implementation part from approved per-field rules and
Q3/Q8/Q9 before source review. Completed review and actual runtime results
are recorded below.
Use fresh Work IDs, existing permitted/native/Fields/custom fixtures or fresh
authorized mapped scalar fixtures, genuine local edits and exact queue IDs.
No prior terminal Work replay, fabricated timestamp/identity SQL, custom API,
clock manipulation, automated harness or blanket rerun of completed stages.
A's supplied field evidence uses canonical RFC3339 seconds/+08:00; native
mapped date/datetime values keep their separate destination format. Compare
normalized instants without whole-asset timestamps or an edit cooldown.

| ID | Bounded final-part manual scenario and required evidence | Result |
|---|---|---|
| IE01 | Both native field differs and trustworthy supplied A time is newer than its latest genuine B-field time: under current locks/route/identity/permissions, write A locally, reread exact canonical value, AppliedToB and Done. Original queue evidence remains immutable and sync creates no echo. Include a real Fields scalar representative of the same rule. | PASS representative mixed92 native/Fields A newer and custom93, reread/History/no echo; exact correction101 also applies |
| IE02 | Latest genuine B-field time is newer: B remains unchanged and returns exact current canonical scalar/label plus its original time/reliability, ReturnToA. Only fully represented exact Pending snapshots enter covered_change_ids and remain Pending until simulated A save+ack. | PASS B returns92/97/99 original genuine time, custom36 exact covered/Pending102 until matching106; mixed31/32 excluded |
| IE03 | Values already canonically equal: AlreadyEqual, no asset/storage/History/queue write even when times are equal/missing/unreliable. Do not claim an edit time from equality alone. Equal scalar versus unrelated typed value remains distinguishable. | PASS90/91 text+numeric equality without clocks,105/106 no-op corrections; typed helper bool/string remain distinct; no invented time |
| IE04 | Unequal values with exactly equal trustworthy second-precision instants: Conflict/Held with visible field reason, no field write or returned winner. Separate native and Fields representatives; never use queue order/Work arrival to break timestamp tie. | PASS native/Fields exact reliable second tie95 Conflict/Held,34/35 Pending attempt1; no tie winner |
| IE05 | Unequal values with missing/null A time, reliable=false A evidence, no genuine B evidence or unreliable/mismatching latest B evidence: Conflict/Held, no fabricated time/winner. Malformed admission timestamps remain earlier schema tests, not this worker pass. | PASS representative92 no B clock,96 null/unreliable A,94 current/latest mismatch; fake unreliable persisted B snapshot NOT RUN |
| IE06 | Latest genuine edit for the same mapping has a different value from current saved value (for example a previous sync changed it): never borrow an older coincidentally matching snapshot time. Return/compare evidence stays unknown and unequal Both conflicts. Use an approved normal guard/local writer if necessary, not raw timestamp SQL; unsafe fixture remains NOT RUN. | PASS actual current/latest mismatch94 after previous sync; older coincidentally matching variation source-only/NOT RUN |
| IE07 | Genuine later edit to another mapped field/whole asset changes date_mod but not the disputed field: arbitration uses disputed field's original genuine clock only. Untouched fields retain independent times and outcomes; Work/sync/poll times do not win. | PASS actual disputed16:52:38 < A16:53:26 < unrelated asset16:53:27;101 applies A using field clock |
| IE08 | Both dropdown/text conversions compare readable destination labels canonically before resolving a losing A label to a B option. Newer B succeeds even if A's losing label has no local option. Newer A resolves only its own winning unique permitted label; missing/duplicate winning option skips with reason/no option creation. Never compare foreign/raw IDs. | PASS losing absent label97 Bwinner no lookup; winning absent109 Skipped, winning permitted111 resolves7; duplicate winning label prior IB, no new Both duplicate fixture |
| IE09 | Reduce only the fresh test profile asset/Fields rights to READ: B-winner and equal comparison/return still work; A-winner requires current UPDATE/field permissions and cannot write. Hidden/unreadable fields fail visibly. Restore exact rights; custom read-only rights require actual separate fixture proof, not inference from Computer. | PASS actual Computer/Fields/custom READ1 Bwinner/equal97/99; Awrite98/100 Held, exact masks restored; hidden variants source/prior |
| IE10 | Faithful numeric JSON1 versus1.0 and saved SQL decimal1.00 compare equal without writes. Native/Fields/custom representative where actual metadata supports it; preserve integer/finite-float semantics and reject bool/string loose equality. Zero/negative/fractional values stay faithful to actual field constraints. | PASS actual Fields varchar raw1.00 and custom JSON1.0/1.00 equality plus descriptor helper; physical writable SQL DECIMAL column NOT RUN, other numeric ranges limited |
| IE11 | Large integers and precision-sensitive numbers do not collapse through float conversion: distinguish exact >2^53 neighboring integers when supported, and retain existing custom12.75→12 loss rejection/rollback rather than normalizing it away. Unsupported exact representation skips/Holds visibly. No broad unsupported range certification from one value. | PASS raw decimal/exponent/last-duplicate helper;104 exact firstcopy9007199254740993,107 exponentAlreadyEqual,108 neighborConflict;110 actual12.75 Failed/rollback2; exact tested values only |
| IE12 | Mixed mapped fields choose independently: newer A AppliedToB, newer B ReturnToA, equal AlreadyEqual and unresolved Conflict may coexist; Work Held preserves verified partial writes, returned values and explicit per-field outcomes. Only eligible full snapshots are covered, never blanket all IDs because one field succeeded. | PASS92 mixed Awrite/Breturn/AlreadyEqual/Conflict with Held partial outcomes; multi-field31/32 no blanket coverage |
| IE13 | Both correction with exact handled IDs prevalidates every reference, compares original field evidence and actual current value under lock, then marks only fully covered snapshots Done. A-winning verified correction and already-equal coverage count actual Pending attempts; unresolved tie/missing evidence leaves Pending with visible error. Already Done snapshots unchanged; fresh Work after reconciliation only. | PASS tie95 attempts1, winning101 exact34/35 Done2;102 returned36 Pending1 then106 equalDone2;105 equal completion with prior Done unchanged; operator103 bad-default attempt preserved |
| IE14 | Separate/newer genuine snapshot for same field or one multi-field snapshot with uncovered/conflicted field stays independent Pending; returned coverage and handled_change_ids_done identify exact snapshots, not all asset/mapping rows. Attempt count reflects validated correction processing only; polls/wrong-scope references remain no mutation per prior ID proof. | PASS independent mixed31/32/unrelated39;111 only40 Done, newer41 Pending0; prior wrongscope/poll proof not rerun |
| IE15 | Native/Fields/custom Both writes release nested sync guard after success/failure, create no Change echo and do not overwrite original evidence. Immediate genuine mapped edit afterwards queues normally. No cooldown, remote call, resumption/reseed or scope-control regression inferred from unrelated tests. | PASS native/Fields/custom no echo, genuine34/35 aftersuccess and42 after actualFailed110, guardfalse; native/Fields Historyuser12, custom History attribution not additionally certified |
| IE16 | Final source review finds actual Both execution replacing the previous stage Hold, with no executable stage-unavailable placeholder for required behavior. Representative native/Fields/custom behavior and exact integrated A-start/B-start/correction flows are evidenced within this pass or prior ledgers. Unrun unsafe failure/race/type variants remain limits; full “all installed types/fields” certification is not inferred. | PASS exercised required Both behaviors/source reviewed boundaries; integrated representative flows across ledgers; unsafe moved-scope/transaction failure races source-only, no exhaustive type/field claim |

Finish only after the entire candidate is built, one independent complete
source review and the bounded operator pass. Record any initial failure and
selective fix/retest; do not overwrite historical stage-boundary evidence.
Final setup/current-contract wording cleanup follows source/runtime approval,
with known facts stated as facts and genuine unresolved conventions phrased
as explicit questions. Unrun fault injections are verification limits, not
new deployment questions or evidence of failure.

### Senior 1(e) initial completed source review

All six staged files were read: new `both.php`, `process.php`, `write.php`,
`results.php`, `fields.php`, and the approved narrow `firstcopy.php` numeric
input dependency. Both dispatch/strict typed comparison, current-read genuine
field evidence, READ-first comparison/B winner, UPDATE-only A winner, and
full-snapshot Both coverage are implemented. Approval is withheld for two P1
issues found in the completed candidate; no runtime or code edit by reviewer.

1. `fields.php::exact_work_value()` lines253–260 validates original precision
   only when JSON_BIGINT_AS_STRING converts an integer literal into a string.
   Raw inner numeric literal9007199254740993.0 or9.007199254740993e15 becomes
   float9007199254740992 in both decode modes, bypasses that guard, and can
   become false AlreadyEqual or a successful rounded write. Validate the
   original numeric token across decimal/exponent/integer representations;
   canonicalizing only the already-rounded decoded value is insufficient.
   IE11 must include these distinct raw syntaxes and preserve type strictness.
2. `results.php::locked_value()` lines311–324 reads the current locked row but
   consumes only its value, not current entity/concrete type/Fields ownership.
   `finish_corrections()` lines257–264 starts its RR transaction and reads
   route/asset before waiting for the actual asset lock; later getFromDB and
   check_asset can remain on the pre-wait consistent snapshot. A current row
   moved to another entity/definition while waiting must never authorize Done
   from stale old scope. Validate/hydrate actual current locked asset scope,
   concrete type and current rights, plus current Fields owner/container/entity,
   before arbitration/write/completion. Do not require destructive movement or
   fabricated invalid identities for runtime proof; unsafe race fixtures remain
   source-only unless the coordinator approves a real safe mechanism.

Custom locked-value raw JSON lookup/default/formatValueFromDB follows the
installed GLPI virtual-field read shape in the completed source. No additional
actionable defect was found in this read. Preserve both initial findings and
review only completed targeted fixes before the first IE runtime deployment.

Senior 1(e) completed targeted fixes reviewed once: `exact_work_value()` now
reads original raw numeric scalar tokens across integer/decimal/exponent
syntax and normalizes that token before comparison/write. Actual JSON strings
stay strings. The coordinator caught an intermediate duplicate-key selection
mismatch before this targeted review; the final parser selects the last
matching raw member, consistent with validated json_decode semantics. Include
raw large decimal/exponent and duplicate-final-member variants in IE11.

Current asset locking now constrains concrete type criteria and hydrates the
actual SELECT FOR UPDATE result through installed getFromResultSet plus
post_getFromDB before entity/lifecycle/current-right checks. Retained ownership
is checked by locking current rows. Current Fields storage checks actual
owner/itemtype/container/entity and actual container availability/type/scope;
the writer preserves that locked full storage row. Correction completion and
current genuine-time permission checks use hydrated locked rows, and required
call signatures were read. No actionable defect remains in these affected
changes. Both P1 source findings are resolved for the first IE runtime pass;
unsafe scope-race/persistence injection remains explicitly unrun unless a
real safe fixture is authorized. No reviewer runtime, code edit or deployment.

### Senior 1(e) executed evidence review and final documentation status

The independent reviewer inspected the complete 40 raw curl requests and 18
native invocations in [inbound-e-runtime.md](inbound-e-runtime.md), preserved
verbatim. No implementation blocker was found in observed final-part runtime.
All 22 immutable Work inputs and original snapshot columns reconcile exactly;
credential fields are redacted. Large precision evidence uses original raw
bodies/native PHP stdout, not rounded JavaScript projections. No reviewer
runtime replay, deployment, code edit or automated test was performed.

Work90–111 finish 12 Done/9 Held/1 expected Failed. Both executes actual native,
Fields and custom writes/returns/equality/conflicts. Trusted field times, exact
second ties, null/unreliable evidence, genuine current/latest mismatch and an
unrelated later whole-asset edit select no invented clock. READ-only Computer,
Fields and actual custom rights allow B winners/equality; A winners require
UPDATE. Losing missing dropdown labels do not trigger lookup; missing winning
label skips, and valid winning label resolves permitted7.

The numeric fix has real helper proof for decimal/exponent/final-duplicate
members and strict scalar types. Actual first-copy104 stores exact
9007199254740993, exponent107 reuses the same asset with equality, and adjacent
108 stays distinct. Actual configured custom integer-step12.75 save110 fails
reread and rolls back to2; Pending38 retains attempt1/error. The following
genuine numeric3 edit queues42 and guard is false. Actual Fields number raw
1.00 uses varchar storage, not physical SQL DECIMAL; only descriptor-level
DECIMAL-style text canonicalization was exercised. Other precision/range and
physical DECIMAL write variants remain explicitly unrun.

Exact Both corrections cover34/35,36/37 and40 only after verified winning or
matching handling. Partial mixed31/32 remain Pending; returned36 stays Pending
until simulated A matches it, then106 completes it. Newer unlisted41 remains
Pending0, as does independent genuine overlapping-route39. Operator103 carried
old helper defaults and correctly Held; fresh105 is the real no-op completion.
That mistake/validated attempt remains visible, with no reset/replay. Prior
Done rows retain original attempts/done_at.

Exactly 12 genuine rows31–42 increase the queue; sync/firstcopy/correction adds
no echo. Rights are restored, routes15/16 disabled/version2, session closed
and Accepted count0. The separately approved hook description-only integration
changes task51 comment/date_mod only; itemtype/name/frequency/external mode/
state remain exact. All scheduling facts in setup reflect the implemented task.

Source and observed runtime are approved for the final part. Unsafe moved-
entity/concrete-type/Fields-owner races, transaction/crash injection, exhaustive
installed-type/field combinations, custom History attribution and physical
DECIMAL writes are limits, not asserted failures. Setup and API-contract
current-status wording now match implemented/reviewed behavior while preserving
all five contract deliverables, schemas, native caveats, historical ledgers and
initial findings. A remains outside this B-only project; its real saves are not
certified by local simulated handling.
