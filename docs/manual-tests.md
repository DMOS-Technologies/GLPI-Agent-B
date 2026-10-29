# GLPI B manual curl review checklist

## Mapping-version and first-copy local runtime verification — 29 October 2026

The user authorized the **0.4.1** candidate deployment/additive upgrade on
`http://localhost:8081` and manual MV01–MV16 plus direct first-copy checks using
new disposable fixtures. This current ledger records actual observations only.
The preparation sections below retain their original cases and historical
NOT RUN labels. Source review and PHP syntax are not runtime passes. No
Controller A or hosted-environment changes are authorized by this run.

**Final bounded B-side result:** MV01–MV16 have **12 PASS and 4 PARTIAL**;
FCP01–FCP08 have **8 PASS**. Each partial row identifies its unrun variant.
The initial provisional-created-ID diagnostic failure was fixed and verified
with fresh requests; its earlier terminal evidence remains unchanged. These
results do not certify Controller A or full A/B integration.

Private evidence and recoverable backups are under
`/tmp/agentb-firstcopy-mv-20261029.fPFhUh/`. CORE uses localhost:8081; FAULT uses
the isolated local B clone at localhost:8082. Paths below are relative to that
root. Credentials/raw backups remain private and are not copied into this file.

### Deployment, backup and protected baseline

- Main target: Docker `assetsync2-glpib`, GLPI **11.0.7**, active Fields
  **1.24.4**, active plugin path `/var/glpi/marketplace/agentbdmosassetsync`.
  The previous deployed plugin was 0.4.0. Root used native update detection,
  additive installation without force, and activation for the 0.4.1 candidate;
  no uninstall/reinstall or table erasure occurred.
- Backup: `backup/glpi-before.sql`, `backup/deployed-plugin/` and
  `backup/repository-candidate-before.tar`; hashes are in `backup/manifest.json`.
  The database backup is 41,211,386 bytes, SHA256
  `64bae80eb66b228c069c3575ae80c983dfe9fa21132c438639fd06c51a0a974a`.
- Root's immediate post-upgrade and final post-fixture comparisons found all original columns of
  **1,036 Works, 188 Changes, 41 Settings and 49 Note links unchanged**, including
  Works 1–7. The new hidden Setting metadata/internal scalar store are additive.
  The final comparison also preserves every original plugin-right row.
- Initial main/clone and final MAIN hashes match all **20 PHP files** in the
  reviewed candidate. Docker PHP syntax passed for the original deployment and
  the four finalization files changed afterward. These are static checks.
- Root paused only the idle B `processWork` native task through supported GLPI
  methods. Prior task state was Waiting, external mode, 60 seconds. Fixture
  processing selected only newly owned Work IDs; no broad worker processed
  existing recovery requests. Native task51 was restored to state1/Waiting,
  external mode2/frequency60. The operator confirmed the original external
  scheduler command remained alive (PID1325); no Running task was reset.

Evidence: `deployment/target-info.json`, `deployment/upgrade-preservation.json`,
`deployment/hash-comparison.json`, `deployment/php-syntax.json`,
`deployment/finalization-syntax.json`, `deployment/closure-hash-comparison.json`,
`deployment/final-target-info.json`, `deployment/task-restoration.json`,
`protected-record-comparison.json`, native upgrade/activation logs and
`task-before.json`. The clone is a separate B database/files
environment; clone fault results must not be represented as localhost:8081 writes.

### MV01–MV16 observed results

| Case | Result | Actual evidence and remaining subvariants |
|---|---|---|
| MV01 | PARTIAL | MAIN native additive upgrade preserved every original column of1036 Works/188 Changes/41 Settings/49 Note links, initialized hidden binding metadata, and added an empty scalar store without historical backfill. FRESH localhost:8083 had no Agent tables/catalog row: authenticated native control GET succeeded, missing Work resource returned400 without asset changes, native first install/activate produced empty REST resources, and fresh Work1 Done created258/two original-time proofs/zero Changes. Actual prior-version schema with candidate source before upgrade remains NOT RUN. `deployment/upgrade-preservation.json`, `before-summary.json`, `after-upgrade-summary.json`; `fresh/evidence.md`, `before-install-read.log`, `before-install-work.body`, `installed-empty-*.body`, `fresh-work-read.body`, `final-read.log`. |
| MV02 | PASS | MAIN genuine Change189 at version1 survived an unrelated m_text publication to version2; Work1044 returned Name with the exact original B time, without overwriting it. Version3 cosmetic/unchanged publication and separate worker processes preserved current copied proof in1050. CLONE Notes-only publication25 kept exact scalar states/times/History/Changes unchanged, also unchanged after the bounded Notes run. `core/human-b-one.jsonl`, `setting-v2*`, `setting-v3*`, `published-b-newer.worker`, `copied-after-v3.worker`; `fault/mv02-{before,after}-notes-publication.snapshot.json`, `mv14-after-notes.snapshot.json`. |
| MV03 | PASS | MAIN1045 applied genuinely newer A under version2, with VerifiedApplied and copied original A time.1050 later returned that copied time under version3 against an older differing A revision. History9→10, Change189 remained the sole captured human row. `core/published-a-newer.worker`, `after-a-newer.jsonl`, `copied-after-v3.worker`. |
| MV04 | PASS | MAIN1040/1041/1042 exercised v1/legacy/v2 equal values: no native History change8→8, zero feedback Changes, and original proof unchanged.1051 equal on missing-proof Computer246 stayed unreliable/null;1052's later differing request Held Conflict. `core/equal-*.worker`, `after-firstcopy.jsonl`, `after-equalities.jsonl`, `equal-unproven.worker`, `after-unproven-equal.jsonl`, `still-unproven.worker`. |
| MV05 | PASS | CLONE1038 preserved reliable proof after cosmetic object order. Changed A selector1039, B selector1040, authority1041/1042, conversion1043, mapping ID1044, remove/re-add1045 and itemtype publication/admission denial/restore1046 prevented old-generation inheritance. B-authority1041 returned the live value with unreliable time rather than inventing a timestamp; restoring Both conflicted. Unaffected proof retained its original time. `fault/mv05-*.response.json`, worker logs and snapshots. |
| MV06 | PASS | CLONE route disable/re-enable with actual human away/back gave1047 Conflict; type gap1048 Conflict; mapping gap1049 Conflict while unaffected ftext still returned reliable genuine evidence. No configuration exclusion cleared an asset value or silently removed a saved mapping. `fault/mv06-route.snapshot.json`, `mv06-type.snapshot.json`, `mv06-map.snapshot.json`, matching request/readback/worker/native files. |
| MV07 | PASS | CLONE Fields field92 disable/re-enable, container17 cycle, text→textarea→text and same-name recreation92→96 each rejected prior proof in1050–1053. Missing manifest after recreation had an unestablished cause; valid publication22 plus fresh genuine edit restored reliable ReturnToA1057 without changing1053. Separate native custom-type route: semantic default change/revert1073/1074 invalidated only custom proof; type disable/enable1075 invalidated affected bindings; valid publication/fresh custom edit1085 returned its genuine time while unproven native Name still conflicted. Actual Fields same-name recreation and native custom semantic/lifecycle variants passed; native custom-field delete/recreate itself was not performed. `fault/mv07-*`; `custom/evidence.md`, `read-1071/1072/1073/1074/1075/1085*`, `summary.json`, lifecycle logs. |
| MV08 | PASS | CLONE Fields disable/enable1054/1056 retained reliable native n proof but invalidated Fields proof;1056 began with a positively established fresh reliable Fields proof. Agent B disable, actual human away/back, then activate1055 invalidated both mappings. Ordinary separate-process readback retained continuity. Final Agent/Fields active; clone automatic task remains disabled. `fault/mv08-*.snapshot.json`, lifecycle/native files and exact Work readbacks. |
| MV09 | PASS | MAIN1046–1049 Held Conflict/EVIDENCE_CONFLICT for tied, missing A, unreliable A and missing B times;1039 also conflicted on explicitly unreliable copied B evidence. Native History10 and the one genuine Change stayed unchanged through the conflict group. These are genuine field-evidence comparisons, not Work/date_mod ordering. `core/tied.worker`, `missing-a.worker`, `unreliable-a.worker`, `missing-b.worker`, `unreliable-copy.worker`, `after-conflicts.jsonl`. |
| MV10 | PARTIAL | CLONE1082 copied newer A after genuine Local capture; a fixture-only sync-guard return to the old Local value did not revive its old time, and1083 Held Conflict. Actual Change INSERT refusal allowed the human save, retained17 immutable Changes and left current n proof unreliable; restoring its old value did not revive proof. Unreadable dropdown0 plus healthy text saved normally, captured only healthy text and retained the dropdown barrier; guarded option restoration stayed unreliable. Existing native log retained explicit queue/field capture errors. Invalid stored-date variant remains NOT RUN; no unsafe SQL-mode/direct invalid-date setup was used. `fault/mv10-aba-*`, `mv10-before-queue.snapshot.json`, `mv10-after-queue-{fail,restore}.snapshot.json`, `mv10-{choice-reliable,unreadable-choice,choice-restore}.snapshot.json`, actor log evidence. |
| MV11 | PASS | CLONE first-copy proof/verification/commit/rollback/observer faults and actual SIGKILL retained effective uncertainty/no replay; the initial provisional-created-ID defect was corrected and fresh1095–1101 verified the changed boundaries (FCP07). Linked1084 preserved spare VerifiedApplied while n became Unknown/JOURNAL_UNCERTAIN;1086 real COMMIT/return-loss remained Unknown/COMMIT_UNCERTAIN. Fresh1087 VerifiedEqual made no rewrite or invented time, retaining1086's exact row. Final-source1102 was actually killed after the durable barrier before native write: original value unchanged, restart Held/Unknown/INTERRUPTED. Distinct v2 catch-up1103 Applied spare/Equal n and retained original1102 unchanged. `fault/mv11-proof-sibling.snapshot.json`, `mv11-linked-*`, `mv11-final-*`, `fcp-final-*`. |
| MV12 | PASS | MAIN1062 was admitted before genuine B edit/Change190 and returned its newer time without overwrite. CLONE1089 positively waited on the owned Fields storage row, then returned the holder's genuine10:10:42 edit.1090 positively waited on native parent245, then returned genuine10:11:09. Both holders used actual REPEATABLE READ snapshots before the barrier; observed SQL LOCK WAIT and positive completion exclude a timeout-only pass. All sessions exited. `core/queued-window.worker`, `human-queued.jsonl`; `fault/mv12-{native,fields}-actual-wait.tsv`, `mv12-native-observed-read.response.json`, `mv12-fields-lock-read.response.json`, holder/worker logs. |
| MV13 | PASS | MAIN1053 invalid date,1054 missing dropdown,1055 invalid numeric,1056 read-only field and1061 real ambiguous Fields options each rejected only that mapping/NotAttempted while healthy Both Name VerifiedApplied.1057 repaired a field through a distinct Work.1059 actual parent UPDATE denial,1060 inactive account and1083 queued route disable Held with PARENT_SCOPE/ACCOUNT_DENIED/SETTING_SCOPE.1082 excluded an inactive Fields definition while Name succeeded. All owned rights/user/definition state restored. Native State uniqueness prevented1058's intended duplicate fixture, so1058 legitimately applied a unique option and is not ambiguity-denial evidence. `core/siblings-*.worker`, `repair-text.worker`, `parent-denied.worker`, `account-denied.worker`, `excluded-unavailable.worker`, `queued-disable.worker`, corresponding native before/restored files. |
| MV14 | PASS | MAIN1063 cleared supported nullable native Comment while rejecting Fields date/dropdown nulls;1064 returned B despite differing A;1065 selected no fields.1071 first-copied Monitor7 with A/B/Both seeds/proofs;1072 returned original B/Both evidence. All sync writes suppressed feedback. Bounded CLONE Notes regression:1091 Inventory,1092 formatted Created/original A time,1093 AlreadyEqual/exact native row unchanged, genuine edit then1094 ReturnToA, scalar proof unchanged. This is the named policy regression, not the full31-case Notes suite. `core/native-clear.worker`, `b-authority.worker`, `empty-selection.worker`, `firstcopy-monitor.worker`, `monitor-return.worker`; `fault/mv14-notes-*-read.response.json`, `mv14-{created,equal}-note-native.response.json`, `mv14-after-notes.snapshot.json`. |
| MV15 | PARTIAL | MAIN old-version Change189 was not auto-covered;1077 Held SNAPSHOT_INVALID. Full correction1078 completed193/retry1. Mixed194 stayed Pending/retry0 after1079's verified Name/INCOMPLETE_SNAPSHOT and1080's Contact return;1081 retained the Held Work's verified sibling proof. Exact external ACK194+absent2147483647 returned native207 with only194true; GET194Done,195Pending/retry0, absent404. Actual A handling was forbidden: `simulated-a-coverage.json` is explicitly simulation, not A-save proof. `core/old-version-correction.worker`, `full-correction.worker`, `after-full-correction.jsonl`, `mixed-name.worker`, `after-mixed-name.jsonl`, `mixed-contact.worker`, `held-sibling-return.worker`, `mixed-ack.body`, `mixed-ack-read.body`, `later-change-read.body`, `missing-change-read.body`. |
| MV16 | PARTIAL | MAIN Suspend1066 invalidated proof, suppressed capture during a successful native edit and blocked1067. Resume1068 retained245;1069 stayed unproven until fresh genuine edit/1070. Moving the owned parent caused1074 and ACK190 scope denial; return did not revive old proof1075, while fresh edit1076 did.1085 on parent246 and another route's1086 could not borrow245's proof/link. Alias route disabled afterward. Arbitrary hook effects, bypassed capture and simultaneous total invalidation-store failure are not certified by these scope tests. `core/suspend*.worker`, `resume.worker`, `resumed-*.worker`, `moved-scope.worker`, `moved-ack.body`, `restored-*.worker`, `separate-parent-proof.worker`, `otherroute-*.worker`, `final-summary.json`. |

### Direct first-copy observed results

| Case | Result | Actual evidence and remaining subvariants |
|---|---|---|
| FCP01 | PASS | MAIN1037 Done/new Computer245 had ten copied seeds/proofs with original A time and zero feedback. After the final receipt/observer correction, fresh MAIN1087 Done/new Computer247 again had ten exact-parent copied proofs, original reliable2026-10-28T11:10:00+08:00, positive confirmed created ID and zero feedback. CLONE1037 independently passed seven seeds. `core/firstcopy-read.body`, `firstcopy-proof-summary.json`, `after-firstcopy.jsonl`, `postfinal-firstcopy-read.body`, `postfinal-firstcopy.worker`, `postfinal-summary.json`; `fault/seed-read.response.json`, `seed.snapshot.json`. |
| FCP02 | PASS | MAIN1037 stored explicitly unreliable Contact proof as false/null;1039 later conflicted. MAIN1043/new Computer246 omitted Name/Contact times: proofs stayed false/null, and1049 Held Conflict. Final-source CLONE1095 likewise retained intentionally unreliable ftext as null/false while reliable siblings kept original08:00. No copy/creation/Work/date_mod time was substituted. `core/firstcopy-proof-summary.json`, `unreliable-copy.worker`, `firstcopy-missing.worker`, `after-firstcopy-missing.jsonl`, `missing-b.worker`; `fault/fcp-final-success-after-process.snapshot.json`. |
| FCP03 | PASS | MAIN genuine native Name edit produced Change189/local proof; current-version1044 returned its newer B value/time without overwrite. The earlier copied proof was replaced by real Local origin, not promoted by publication. `core/human-b-one.jsonl`, `published-b-newer.worker`. |
| FCP04 | PASS | MAIN1045 saved the later reliable A revision and stored Copied origin with its original A time. No new human Change/feedback was emitted; Change189 stayed retained. `core/published-a-newer.worker`, `after-a-newer.jsonl`. |
| FCP05 | PASS | MAIN Setting version1→2 changed only independent m_text; retained Name proof correctly selected newer B in1044 and newer A in1045 using current-version requests. `core/setting-initial.json`, `setting-v2.json`, `published-b-newer.worker`, `published-a-newer.worker`. |
| FCP06 | PASS | MAIN v1/legacy/v2 equal1040–1042 produced AlreadyEqual with unchanged History8/Changes0 and copied proof, including unreliable sibling. After the final patch, fresh1088 VerifiedEqual again left all ten proof rows, native History8/date_mod, zero parent Changes and original1087 completed row exactly unchanged. `core/equal-*.worker`, `after-firstcopy.jsonl`, `after-equalities.jsonl`, `postfinal-equal-read.body`, `postfinal-before-equal.json`, `postfinal-after-equal.json`, `postfinal-summary.json`. |
| FCP07 | PASS | Initial CLONE1058–1070 verification/proof/commit/rollback/observer faults and actual kills preserved effective uncertainty, but1061/1065/1066/1070 exposed a false positive pending created-ID claim: initial diagnostic FAIL, retained unchanged. The correction leaves pending created ID null, strictly persists/independently observes final Done and downgrades provisional Applied outcomes only on a marked restart. Fresh final-source1096 native COMMIT/return-loss,1097 final-save refusal,1098 actual nested final save and actual postcommit kill1101 restarted Held/null/Skipped/untrusted without replay. Final-Done COMMIT return-loss1099 and observer cleanup failure1100 independently read back genuine durable Done/positive created ID/trusted proof; no false Hold was forced. Normal1095 retained reliable and explicitly unreliable evidence correctly. `fault/fcp-final-*.snapshot.json`, exact original readbacks, worker/events and real `.kill.json`; earlier `fcp-*` failure evidence retained. Method-return loss is not actual network packet loss. |
| FCP08 | PASS | CLONE1067 blocked a fresh-ID attempt after1058's uncertain unassociated creation;1068's fresh linked Both request left1061 unchanged and conflicted on untrusted proof.1076 positively failed before native CREATE; after restoring CREATE, distinct1077 Done created once with original reliable proofs. Unmapped-serial uncertain1078 could not be bypassed by1079. Newly owned unmarked-history simulation1080 blocked1081;1080's complete REST row remained identical. A later NOT_APPLIED guard does not resolve an older uncertain operation. No old recovery request was reset/reopened. `fault/fcp-new-id-creation-guard.snapshot.json`, `fcp-committed-fresh-both.snapshot.json`, `fcp-known-no-attempt.snapshot.json`, `fcp-distinct-repaired.snapshot.json`, `fcp-unmapped-serial-{fault,guard}.snapshot.json`, `fcp-unmarked-history-{before,after}.response.json`. |

### Closure and remaining limits

CORE is frozen: **52 new Works1037–1088:35 Done,17 Held,zero Accepted**; eight
Changes189–196:193 Done through correction/retry1,194 Done through exact ACK/
retry0, six Pending retained. Computers245/246/247 and Monitor7 remain in the new
entity18. Setting42 is enabled/version6; alias43 disabled/version2. Fields92–95
are active/read-write and owned service user22/Computer rights restored.
First-copy1037's final REST row matches its original completed row. These IDs
refer to MAIN only; clone IDs may overlap in its separate database.
`core/final-summary.json`, `final-manifest.json`, `firstcopy-final-read.body`,
`postfinal-summary.json`. The last two requests confirm the final narrow patch
on MAIN without replaying any earlier operation.

FAULT is frozen: its dedicated route has **61 Works:18 Done,43 Held,zero
Accepted**, 28 Changes and Setting42/version25. The separate CLONE custom-type
route has six Works/two Done/four Held; all clone fixture Works are terminal.
No owned paused process or advisory lock remains. Agent0.4.1 and Fields1.24.4
are active; clone task51 is disabled and the clone has no scheduler. Final
comparison preserved all original columns of imported1,036 Works/188 Changes/
41 Settings/49 Note links, including Works1–7. Separately, all47 pre-correction
terminal fault fixture rows remain identical; no historical result was repaired
to hide the initial created-ID failure. `fault/final-summary.json`,
`protected-after-final-summary.json`, `old-fault-receipt-preservation.json`,
`custom/evidence.md`.

At closure the isolated clone web/database containers and both fresh-install
web containers were stopped; their private databases, files and backups were
retained. This did not stop or reconfigure MAIN's scheduler.

Final MAIN preservation comparison confirms every original column/right row
above unchanged, including exact Works1–7. MAIN now has1,088 Works
(831 Done/254 Held/3 Failed/zero Accepted),196 Changes,43 Settings and49 Note
links. Existing Failed/Held rows remain historical; none was repaired/reset.
The final active0.4.1 source matches all20 repository PHP hashes, and native
task51 is restored as described above. `protected-record-comparison.json`,
`deployment/closure-hash-comparison.json`, `deployment/final-target-info.json`,
`deployment/task-restoration.json`.

B-only observations
cannot certify Controller A scheduling, ReturnToA saves, exact coverage ledger
or full A/B end-to-end readiness. Historical provenance is not backfilled; old
recovery requests are never reset/reopened or used as fixtures.

FRESH localhost:8083 was a separate clean schema/files namespace on the isolated
clone backend. Its native first installation and Work1 success precede the
narrow provisional-created-ID correction; Work1 was never replayed. Both fresh
web containers are now stopped, with schemas/files retained and no scheduler
ever started. FRESH Work1 is unrelated to protected MAIN Works1–7.

Unrun variants remain explicit: actual old-version-schema use before upgrade
(MV01); genuinely invalid stored-date capture (MV10); real Controller A save/
coverage handling (MV15); arbitrary native-hook effects, bypassed capture and
simultaneous total invalidation-store failure (MV16). No actual network-packet
fault was injected: real server commit plus lost method return and real process
kill were tested separately. Native custom-field delete/recreate itself was
not run; actual Fields recreation and native custom semantic/lifecycle paths
were exercised. A recreated Fields binding may remain unavailable until a valid
publication/fresh capture; its exact same-request missing-metadata cause is
unestablished. Historical current-value evidence is not reconstructed from a
matching old value. No Controller A, hosted environment, billing or UUID change,
automated test, commit or push occurred; Notes source was unchanged and only the
bounded named regression ran.

## Mapping-version scalar evidence candidate — 29 October 2026

**Historical preparation:** this section describes the earlier source-only
implementation task. The subsequent authorization and actual observations are
recorded in the current local runtime ledger above; the cases remain unchanged.

Agent B **0.4.1** is a local source candidate for
[API section 5.6](api-contract.md#56-scalar-genuine-evidence-across-setting-versions-041).
**MV01–MV16: NOT RUN.** This task authorizes implementation/source review only;
no deployment, upgrade, fixture writes, Work submission or runtime verification
has been performed. The 0.4.0 ledger below predates this patch and cannot certify
its new persistence or arbitration behavior. No automated tests were added/run.

Source review completed with two programmers and an independent reviewer, all
reading AGENTS.md. Review corrections covered stale predecessor/CAS races,
human invalidation after a race, profile-dependent custom-definition hashes,
definition lifecycle gaps and actual GLPI pre-hook timing. No remaining source
blocker was found within the documented capture/persistence boundaries.
Local `php -l` passed for all ten changed PHP files; `git diff --check` passed.
Installed GLPI 11.0.7 Plugin/CommonDBTM/CustomFieldDefinition/Hook source was
read without executing saves. These are static checks, not manual runtime
passes. Total invalidation-store failure, bypassed capture, hook side effects,
no-completion-hook conservative unknowns and unavailable historical provenance
remain explicit limitations; none is certified by the earlier RC run.

Use separately authorized disposable fixtures only: a new route, scoped service
profile/user, native and Fields/custom scalar mappings, linked parents and new
Work IDs. Record source/version, actual GLPI/Fields patches, table engines,
fixture IDs, full requests/responses, before/after native values/History,
Change snapshots and internal proof state. Keep credentials out of the report.
Keep Works 1–7 and all pre-existing recovery jobs unchanged. Do not reset/reopen
a test Work; a repeated attempt uses a distinct newly prepared current request.
Fault/kill/permission cases require an explicitly bounded fixture environment.

### Prepared manual curl sequence

Set private operator-supplied `B_API_BASE`, `B_APP_TOKEN`, `B_SESSION_TOKEN` and
fresh fixture IDs. These are instructions, not an executed script. Log in with
the normal `GET /initSession` flow if a session is needed. Use the current
contract's complete request bodies; all `*_json` values are JSON strings.

1. POST a disposable Setting using the main contract section 4.2, with a native
   text mapping `asset_name` configured Both, plus an independent sibling.
   Establish a verified Active linked parent through separately approved native
   fixture setup and the existing legacy first-copy/link protocol. No first-copy
   result is evidence of a newly made human edit.
2. Make a genuine B edit in its normal GLPI form; GET the new Pending Asset
   Change. Save its exact `changed_at`, mapping/value and settings version.
3. Save a **full replacement** Setting JSON in `setting-next.json`. Increase
   settings_version, changing only the unrelated sibling or Notes selection;
   preserve the Both mapping exactly, including its ID/selectors/conversion.

```sh
curl --silent --show-error --request PUT \
  "$B_API_BASE/PluginAgentbdmosassetsyncSetting/$FIXTURE_SETTING_ID" \
  --header "App-Token: $B_APP_TOKEN" \
  --header "Session-Token: $B_SESSION_TOKEN" \
  --header 'Content-Type: application/json' --header 'Accept: application/json' \
  --data-binary @setting-next.json
```

Expect native HTTP 200 with the exact Setting ID true; GET the Setting to verify
the new version and complete public content. No new human Change should appear
for the publication. Hidden `evidence_bindings_json` must not be returned.

4. Prepare `both-next.json` as a new linked Sync request at that current version,
   selecting asset_name with v1 (or v2 and an eligible newly owned terminal
   reference). Supply a different A value and its genuine older reliable time.
   Use `handled_change_ids_json:"[]"` for the first arbitration check: the
   prior-version Change is not automatically a current correction snapshot.

```json
"field_sync_json":"{\"version\":1,\"mapping_ids\":[\"asset_name\"]}"
```

```sh
curl --silent --show-error --request POST \
  "$B_API_BASE/PluginAgentbdmosassetsyncWork" \
  --header "App-Token: $B_APP_TOKEN" \
  --header "Session-Token: $B_SESSION_TOKEN" \
  --header 'Content-Type: application/json' --header 'Accept: application/json' \
  --data-binary @both-next.json
curl --silent --show-error \
  "$B_API_BASE/PluginAgentbdmosassetsyncWork/$NEW_WORK_ID?get_hateoas=false&expand_dropdowns=false" \
  --header "App-Token: $B_APP_TOKEN" \
  --header "Session-Token: $B_SESSION_TOKEN" --header 'Accept: application/json'
```

POST 201 means admission only. Let only the authorized fixture worker execute,
then poll the newly returned exact Work ID. Decode result_json; expect
ReturnToA/NotAttempted with the unchanged original genuine B time and value,
no native save/History/feedback Change, and no automatic old-version coverage.
Repeat the variants below with new current requests and genuine evidence.

### Prepared cases and evidence to retain

| Case | Manual check and required outcome | Result |
|---|---|---|
| MV01 | Fresh install and additive upgrade from 0.4.0: new hidden Setting metadata/internal scalarstates only, no old Work/Change/Notes payload alteration. Current definitions initialize without a new A key. No reliable backfill from pre-upgrade matching Changes; missing definition/permission stays unproven. Verify unsupported unupgraded use fails safely. | NOT RUN |
| MV02 | Capture newer B genuine edit at version N, publish N+1 changing only an unrelated mapping, then differing A older → ReturnToA with the original B changed_at; B value/History unchanged. Repeat a Notes-only publication and several unchanged versions/restart. | NOT RUN |
| MV03 | Same publication boundary, differing A with genuinely newer reliable field time → AppliedToB/VerifiedApplied, exact native value and copied original A time; no synthetic B human edit/feedback. Later differing older A must lose to that copied proof without treating it as a B human edit. | NOT RUN |
| MV04 | Equal Both values after publication → AlreadyEqual/VerifiedEqual, no asset update/History/Change and no new evidence time. Equality without valid prior evidence must not bootstrap a later differing winner. Exercise legacy/v1/v2 result shapes. | NOT RUN |
| MV05 | Individually change mapping ID, selector A/B, authority, conversion or itemtype; remove/re-add a mapping; change then revert it in separate publications → no old-generation proof inherited. Equivalent JSON property order alone should preserve continuity. | NOT RUN |
| MV06 | Disable/re-enable route, itemtype or mapping through Settings; edit during gap, including away-and-back to an old value → old proof invalid; differing Both conflicts until fresh valid proof. Unrelated still-enabled mappings retain their own continuity. | NOT RUN |
| MV07 | Delete/recreate a disposable Fields/custom definition with the same names, and separately disable/re-enable its definition/container or change/revert semantic options. New ID/observed lifecycle must defeat old proof; no hardcoded customer selectors. | NOT RUN |
| MV08 | Agent B disable/re-enable and Fields plugin disable/re-enable with separately authorized fixture edits during gaps. Old affected proof invalidated; unrelated native proof survives a Fields-only plugin gap. Ordinary process restart without a capture gap preserves proof. | NOT RUN |
| MV09 | Differing Both with absent, unreliable or exactly tied times → Held Conflict/EVIDENCE_CONFLICT without save. Use equivalent instants/offset rules permitted by the existing contract; never compare Work IDs/date_mod/queue order. | NOT RUN |
| MV10 | Genuine local edit → sync copy → a later value coincidentally matching the old local value: never resurrect its old local edit time. Repeat with unreadable dropdown/date, capture skip or queue failure, retaining explicit logged failure and old immutable Change history. | NOT RUN |
| MV11 | Interrupt after durable pre-mutation barrier, after native write before proof, after real commit before final receipt, and on proof/commit/rollback uncertainty. Restart preserves Unknown/unreliable proof and original Work; no replay. Fresh separately accounted reconciliation never invents historical success. | NOT RUN |
| MV12 | Queue a Work, then make a newer genuine B edit before worker execution; B uses locked current value/time. Exercise a concurrent native/Fields save during lock wait in isolated fixtures: stale prior proof/token must not replace newer capture; timeout is not proof of a successful concurrent decision. | NOT RUN |
| MV13 | Select healthy Both plus invalid format, missing/ambiguous dropdown and field-denied siblings in separate requests. Healthy field resolves, rejected siblings retain NotAttempted, no evidence leak between mappings. Account/parent/route failure remains work-context failure. Excluded fields are not explicitly processed. | NOT RUN |
| MV14 | A/B authority and supported null clears unchanged; sync-origin capture suppression remains; first-copy and Notes creation/edit/Inventory policies unchanged. A newly copied asset without scalar proof must not acquire invented human evidence. | NOT RUN |
| MV15 | Prior-version reliable time may decide Both but does not auto-cover/complete its old Change. Current-version mixed/excluded snapshots remain whole Pending until fully accounted; exact external ID/status ACK only after actual A handling, with existing scope/link checks. | NOT RUN |
| MV16 | Suspend → genuine edit during gap → Resume retains link but invalidates current scalar proof. Moved/other parent/entity/route or reused mapping names cannot read another row's proof. Native-hook side effects, total evidence-store failure and bypassed capture must be reported precisely, not treated as universally covered. | NOT RUN |

Actual Controller A integration, its genuine evidence/physical definition
identity, ReturnToA handling and whole-snapshot ledger require fresh A/B checks.
The table above is preparation, not an integration-readiness claim.

### First-copy evidence integration — prepared direct checks

The subsequent local verification authorization includes the following fresh
fixture checks in addition to the unchanged MV01–MV16 cases above. They are
NOT RUN at preparation time. Use legacy first-copy requests (no field_sync_json)
and distinct serial/A IDs in the dedicated disposable route. Poll exact Work
IDs; read actual native values and internal proof rows independently. No
historical recovery Work may be reused as a test fixture.

| Case | Required check | Preparation |
|---|---|---|
| FCP01 | Reliable A genuine evidence is retained byte-for-byte after verified first copy and final Done; current proof references the exact origin/parent/binding/storage. No human Change or feedback is created. | NOT RUN |
| FCP02 | Missing and explicitly unreliable A evidence remain unreliable; copy/creation/Work/date_mod times never replace it. A later differing Both request remains Conflict without two reliable times. | NOT RUN |
| FCP03 | Later genuine B edit newer than copied A → ReturnToA; preserve B's original genuine time and native value. | NOT RUN |
| FCP04 | Later reliable genuine A edit newer than copied current evidence → AppliedToB with that A time, not a synthetic B edit. | NOT RUN |
| FCP05 | Publish unrelated higher Setting version after first copy → original proof remains valid; exercise B-newer and A-newer decisions under current Work version. | NOT RUN |
| FCP06 | Equal values → AlreadyEqual without redundant native History/update, new human evidence or feedback. | NOT RUN |
| FCP07 | In an isolated clone inject verification/provenance failure, pre-commit interruption, real-commit-before-final-Done interruption, lost commit return and leaked nested transaction. No failed/interrupted first-copy proof is trusted; original Work retains uncertainty/restart Holds without replay. Exact committed Done readback may establish completion after a lost response. | NOT RUN |
| FCP08 | Unassociated uncertain creation cannot be bypassed through a fresh Work ID, including when serial is not mapped. Positive no-native-attempt NOT_APPLIED may allow a distinct repaired request; unmarked historical-stage fixtures remain unresolved. Preserve all original request/result/evidence bytes except the normal new fixture's own processing transitions. | NOT RUN |

## Automatic scalar reconciliation local runtime verification — 29 October 2026

The user subsequently authorized deploying **0.4.0** to local Docker B
`http://localhost:8081` and running RC01–RC22 with disposable fixtures. This
ledger records that bounded run. The source-only RC/FI sections below remain
historical preparation, not a statement that these later observations did not
occur. No real-environment deployment or Controller A runtime was exercised.
PASS means the described B-side scope passed; PARTIAL identifies additional
unrun subvariants. A source argument or simulated A ledger is not a runtime PASS.

Private raw evidence is retained under
`/tmp/agentb-reconciliation-20261029.DGBzh5/`. Its CORE ledger is
`core/evidence.md`; its FAULT ledger is `fault/evidence.md`, with clone raw
proofs under `fault/clone/`. Paths below are relative to that root. Token-bearing
files remain private and are not committed or reproduced here.
In a table row, subsequent CORE basenames share its `core/` prefix and clone
basenames share `fault/clone/`; the actor ledgers index every exact filename.

### Deployment, execution boundary and protected records

- Main runtime: Docker `assetsync2-glpib`, GLPI **11.0.7**, active Fields
  **1.24.4**. Root deployed the complete source, used native CLI installation
  and activation from 0.2.0 to 0.4.0, compared all 18 PHP hashes and restarted
  Apache. Deployment evidence: `deployment/source-hashes.json`,
  `after-upgrade.json`, `after-activation.json` and
  `deployment/upgrade-comparison.json`.
  After all three reviewed fixes, `deployment/final-source-hashes.json` matched
  all18 repository/deployed PHP files and `deployment/final-php-syntax.log`
  recorded Docker PHP syntax success for all18. These are existing root-run
  checks read by this documentation reviewer, not another test pass.
- The scheduler wrapper PID1325 was SIGSTOP-paused for the run. No unrestricted
  cron/worker invocation was used. A temporary procedural driver called the
  real `plugin_agentbdmosassetsync_process_batch` with a new unpersisted
  CronTask. Only its initial Accepted-row selection was narrowed to explicit
  owned IDs greater than967 plus the exact `rc-core-20261029-` or
  `rc-fault-20261029-` route/work namespace. Native processing, submitter rights,
  locks, version 2 fresh DB sessions, observers and writes were product code.
- Before deployment, main B had **967 Works, 175 Changes, 38 Settings and
  48 Note links**. The upgrade comparison found no original-column differences,
  all 967 old Works received null field_sync_json, and original rights and cron
  rows were unchanged. Final `protected-record-comparison.json` again found
  **no original-column or old plugin-right differences**, an unchanged cron row
  before scheduler restoration, and exact preservation of **Works1–7**. These
  checks compare every original row, not counts alone.
- Final main fixture totals: **57 new Works:41 Done,16 Held,0 Accepted**;
  **11 new Changes:4 Done,7 Pending**; two new Settings and one new Note link.
  CORE owns53 Works (38 Done/15 Held), while FAULT owns main IDs970,971,973,974.
  Main is frozen. Deliberately unresolved Changes and terminal failures remain
  as evidence; none was reset, reopened, deleted or acknowledged for cleanup.
- CORE fixtures: entities15/16, profile20, user20, Computer242/A50001, Monitor6/
  A60001, Setting39, own Fields container16/fields88–91 and native Note82.
  Final Setting39 is enabled/version5, user20 active, computer right103
  (no Delete/Purge), Field88 read-only0 and last control Resume1018/Active on
  Computer242. `core/final-manifest.json`, `core/final-work-summary.json` and
  `core/final-native.jsonl` retain the exact manifest/results.
- Native fixture creation added new profile-right rows2091–2200 for profile20,
  and Fields profile rows209–228 for the new container16. Rows209–227 add
  right4 for old profiles1–19; row228 grants right7 to new profile20. These are
  **additive rows**, explicitly authorized as native derived fixture rights;
  no existing right value changed. See `core/new-rights-manifest.json`.
- Fault/install work used a separate no-host-port MySQL8.4 container
  `rc-fault-20261029-db` and schemas `rc_fault_20261029`, `rc_fresh_20261029`
  and `rc_upgrade_20261029`. No old Work/Change data was copied into them.
  Every new DB session asserted its clone DATABASE(). Clone numeric Work IDs
  therefore do **not** identify main Work rows or protected main Works1–7.
  The upgrade clone contains its own deliberately unprocessed old-version
  Work1/Change1; these are not the protected main records.
- Final clone fault schema:27 owned Works988–1014,14 Done/13 Held/0 Accepted,
  Changes0; fresh-install schema Works0/Changes0; upgrade schema its own
  Work1 Accepted/Change1 Pending. `fault/clone/final-*.json` records each
  namespace. At closure root gracefully stopped the owned clone container,
  retaining its container, volumes and evidence; no DROP or hard purge ran.
  Root resumed original scheduler1325 with its original command; Apache was
  RUNNING and the two old Supervisor cron/worker entries remained STOPPED as
  initially found. `deployment/scheduler-restoration.log` records restoration.

### RC01–RC22 observed results

All22 named cases were addressed: **8 PASS,14 PARTIAL,0 FAIL** at the documented
scope after fixes. PARTIAL is not a claim of a failed tested path; its row lists
the unrun variants or missing actual Controller verification.

| Case | Result | Observed evidence and remaining limits |
|---|---|---|
| RC01 — capability and shapes | PASS | Native main 0.2→0.4 upgrade/activation retained all original columns and old null defaults; absent977, outer-null978, version1 Work976 and version2 Works972/975 retained their distinct result shapes. Native GET/collection/search/listSearchOptions did not expose hidden field_sync_json. Isolated fresh 0.4 install and actual old HEAD0.2 installer/classes→0.4 clone upgrade preserved the own old Work/Change columns and new null default (`fault/clone/upgrade-retention-summary.json`). Evidence: deployment comparisons, `core/*row-shape*`, `work-collection-shape.*`, `work-search-shape.*`, `work-search-options.*`, clone `fresh-install.log`, `old-02-install.log`, `upgrade-04-install.log`. Other GLPI patches are not certified. |
| RC02 — exact option validation | PASS | Twenty-five initial invalid requests plus current disabled/wrong-itemtype/stale-version denials returned native400/idfalse without saved invalid Works. Matrix covers missing/zero/negative/string/float/nonexistent reference, extra option, duplicate/unknown/wrong-type mapping, unsupported version, malformed/nested JSON, outside-selection values/times, unknown top-level source_timestamp/parent_change_id and wrong identity/type/nonSync. `core/invalid-cases.json`, `invalid-bulk.*`, `current-mapping-denials.*`. |
| RC03 — prior reference eligibility | PARTIAL | Missing/Accepted refs, original null-B firstcopy968, wrong A/B/route/type, Note1020, Suspend1016 and Resume1018 references denied; no fallback creation. Unreadable-reference POST, wrong entity-pair POST and a separate serial-only null-B variant were not exercised independently. A peer970 GET403 is not evidence of POST reference authorization. `core/invalid-bulk.*`, `control-ref-denials.*`, `note-ref-denial.*`. |
| RC04 — damaged historical journal | PASS | Newly owned eligible references997/998 were made Held with missing/malformed journals through B-native fixture setup; fresh999/1000 converged. All original columns, timestamps, request/result/error bytes stayed identical, including final comparison. Actual uncertain clone writes also retained their prior journals during fresh catch-up. The malformed/null references are synthetic fixtures, not proof they previously attempted a native save. `core/damaged-reference-comparison.json`, `final-manifest.json`, `old-*-repair.worker`; clone `hook-leak.*`, `catchup-after-leak.*`, `lost-commit.*`, `equal-after-lost-commit.*`. |
| RC05 — version repair and fresh intent | PARTIAL | Setting39 advanced1→2; current-version Work1001 referenced older997 and was admitted. After the locked-read defect fix, fresh1006/ref1001 applied the current date. Real dropdown addition983→988 and permission repair989→990 used distinct targeted Works. Stale new-version admission denied; queued1023 under version3 then Held SETTING_SCOPE after disable/version4, with asset/Fields unchanged and History57→57; route restored at version5. A stored reference greater than the current version and every possible mapping-schema repair were not injected. `core/setting-v2.*`, `current-version.*`, `date-after-fix.*`, `current-mapping-denials.*`, `queued-disable-comparison.json`. |
| RC06 — terminal/quiescent execution | PARTIAL | Main Accepted references denied. Clone pending/concurrent and lost-owner cases exercise worker exclusion, route barrier and restart without early terminalization while an owned writer can still run. A separately queued control-operation conflict was not an independent concurrency variant. See clone `pending-first/second.*`, `pause-marker.*`, `ownerloss-after-fix.*`; terminal main control behavior is recorded under RC21. No overlapping Controller A scheduling was exercised. |
| RC07 — source A convergence/equality | PASS | New current intent972/999/1000/1006/1021 applied on existing identity242;975 returned AlreadyEqual/VerifiedEqual with unchanged History9/date_mod/Change0. Clone actual Unknown→fresh catch-up/equal cases retained the old Work and avoided duplicate native writes. Current proof never changed the old operation to success. `core/reconcile-initial.worker`, `equal.worker`, `after-initial-native.jsonl`, `after-equal-native.jsonl`, `old-*-repair.worker`, `date-after-fix.worker`; clone catch-up/equal readbacks. |
| RC08 — source B return | PARTIAL |981/1008/1011 returned the live Status label/evidence without writing Status. Evidence was unreliable after sync-only seed and reliable after genuine native State editing. A supplied differing value for a B-owned selected field was not a separate case. Actual Controller save/equality/ledger remains unrun; temporary JSON coverage is simulation only. `core/b-return.worker`, `mixed-status.worker`, `filtered-status.worker`, `simulated-a-*-coverage.json`. |
| RC09 — Both authority and evidence | PARTIAL |991 A-newer Applied,992 B-newer ReturnToA,993 equal VerifiedEqual; missing994/tied995/unreliable996 Held EVIDENCE_CONFLICT without overwrite. Genuine Contact saves/Changes177/178 supplied B evidence. Queued-window1024 preserved a newer B edit after admission and returned its value/evidence. The mid-execution pause attempt1022 timed out before field processing and Held PARENT_SCOPE; it proves safe timeout, not successful simultaneous-edit arbitration. `core/both-*.worker`, `human-both-one/two.jsonl`, `both-queued-window.worker`, `human-queued-new.jsonl`, `both-concurrent.worker`. |
| RC10 — format/dropdown/permission siblings | PARTIAL | Invalid date979, missing dropdown983, ambiguous dropdown1015 and read-only Fields989 each rejected only the affected field with NotAttempted and stable INVALID_VALUE/DROPDOWN_UNRESOLVED/FIELD_PERMISSION; valid siblings VerifiedApplied. Inactive account1004 Held ACCOUNT_DENIED; actual parent UPDATE removal1005 Held PARENT_SCOPE without a native attempt. Invalid numeric format and a readable but permission-denied dropdown option were not separate cases. `core/siblings-format.worker`, `dropdown-bad.worker`, `dropdown-ambiguous.worker`, `readonly.worker`, `account-denied.worker`, `parent-denied-real.worker`. |
| RC11 — repair and next distinct attempt | PASS | Actual cause repair followed by fresh targeted Work:979→982 valid date;983→988 newly added permitted option;989→990 restored own Field88 permission;1001→1006 corrected locked-read behavior. Successful sibling fields were not resubmitted. All terminal originals retained; B did not invent an option or silently grant rights. `core/date-repair.*`, `dropdown-repair-native.jsonl`, `readonly-restored.jsonl`, `readonly-repair.*`, `date-after-fix-native.jsonl`. |
| RC12 — exclusion, clearing and Fields storage | PARTIAL | Selected-only processing, empty980, missing selected value987, supported nullable native Comment clear984, rejected Fields date/dropdown null985, and text/number updates986 passed; excluded siblings stayed unchanged. Genuine human Fields empty-date saves succeeded/captured null without expanding sync clear support. Missing generated storage, every unsupported clear kind and arbitrary third-party hook/container interference were not independently injected. `core/empty.worker`, `missing-value.worker`, `native-clear.worker`, `unsupported-clears.worker`, `fields-write.worker`, `human-fields-empty.jsonl`. |
| RC13 — owned connection start/read policy | PASS | Clone990 used distinct owner/writer/fresh-observer IDs on its asserted backend.991 preserved unrelated original-owner pending Computer244 data while independently committing target243; fixture rollback later restored244. Read-policy0 fresh1012 returned native literal values and VerifiedApplied Contact JSON; policy1 upgraded-encoding1014 used actual legacy numeric entities and native decoding, including quotes/backslashes/ampersand and dropdown labels. Own profile lacked State READ for1010/1011; those setup rejections were retained, then only the clone profile was repaired. Main v1/legacy shape regressions passed. `fault/clone/ambient-session.*`, `read-policy-0-right.*`, `read-policy-0.repaired-seed.log`, `read-policy-profile-repair.log`, `read-policy-1-decoded.*`, final schema readbacks. No Controller application is inferred. |
| RC14 — worker and route locks | PASS | A competing real worker returned0 while the original clone owner held its global lock. Killing only that owner released the global lock but restart could not terminalize the still-live owned writer across the route barrier. Resumed writer refused further mutation; fresh post-fix1007 preserved9101 and restarted Held. Global connection restoration is recorded for process summaries; no duplicate native save was observed. `fault/clone/pause-marker.*`, `pending-first/second.*`, `ownerloss-after-fix.*`. These are bounded owner/route cases, not proof of every external hook. |
| RC15 — independent progress visibility | PASS | Hook-leak992 left a nested transaction: independent observer could not see exact provisional proof, product stopped9101, asset/proof rolled back on owned close and Contact stayed Pending. Fresh993 converged while old992 remained byte-identical. Actual server-COMMIT then injected return-loss994 saved Name but kept Unknown/verifiedtrue;995 verified equal with History8→8 and old994 byte-identical. Every observer used a fresh native DB object/server ID. True wire packet loss is an RC17 gap, not claimed by this bounded proof. `fault/clone/hook-leak.*`, `catchup-after-leak.*`, `lost-commit.*`, `equal-after-lost-commit.*`, `final-evidence-comparison.json`. |
| RC16 — interruption and restart | PARTIAL | Actual SIGKILL clone1008 occurred before native transaction commit and1009 after actual commit but before final completion. Both restarted Held with no replay; current values/evidence were read back separately. Other listed interruptions use bounded process-local exceptions and are identified as injections. The complete set of possible machine/network/hook interruption points is not certified. Clone `crash-provisional.*`, `crash-after-commit.*`, `pause-marker.final-restart.log`. |
| RC17 — commit/rollback/cleanup uncertainty | PARTIAL | Actual server COMMIT followed by an injected return exception before GLPI bookkeeping left994 Unknown;995 independently returned equal without duplicate History.996/997 retained earlier Name proof and Contact Unknown on rollback-before-server/actual-rollback-then-return-loss;999/1001 observer construction/close faults stopped before mutation;1002 route RELEASE succeeded then lost its injected return and stayed Unknown;1003 provisional save fault preserved earlier sibling.998 writer construction refused before durable start and later had its first actual execution.1000 actual writer close succeeded but reported false: worker stopped while independently persisted Done proof stayed intact. No real broken-wire COMMIT/ROLLBACK acknowledgement, failure before actual close, exact final-journal refusal or MySQL power failure was performed. `fault/clone/lost-commit.*`, `rollback-before/after.*`, `writer-construction.*`, `observer-construction.*`, `writer-close.*`, `observer-close.*`, `route-release.*`, `provisional-save.*`, `ownerloss-after-fix.*`. |
| RC18 — lost HTTP/result responses and raw context | PARTIAL | Main1021 POST response was deliberately captured/discarded; exact work_id lookup found one row and duplicate POST400 ASB_WORK_EXISTS caused no new operation. Repeated GET and immutable/B-owned-field denials passed. Full1009 raw `[ 180 ]` and filtered1010 raw `[ 181, 182 ]` preserved original request bytes and verified eligible completion181 while excluded182 stayed Pending. Actual network transport loss/lost GET was not injected; the tested lost-response case is client discard. `core/lost-response*`, `immutable-put.*`, `owned-field-denials.*`, `full-correction.*`, `filtered-correction.*`. |
| RC19 — mixed snapshot across targeted Works | PARTIAL | Change179 Name+Status:1007 retained verified Name but Held INCOMPLETE_SNAPSHOT;179 stayed Pending/retry0 with immutable snapshot.1008 returned Status;182 behaved similarly through1010/1011. Exact ACK occurred only after explicit simulated full A coverage. B did not aggregate partial receipts or prematurely acknowledge. Actual A durable coverage/save/equality was not exercised. `core/mixed-change-before.json`, `mixed-after-targets.jsonl`, `mixed-name.worker`, `mixed-status.worker`, `simulated-a-*-coverage.json`. |
| RC20 — whole coverage and exact ACK | PARTIAL | Full1009 marked180 Done/retry1; filtered1010 marked181 Done/retry1 and left182 Pending/retry0. New183 remained Pending.179 ACK followed simulated coverage; mixed PUT182 plus absent2147483647 returned native207 with only182 success and missing GET404. Actual A-side aggregation/ReturnToA handling and a separate old revision mismatch remain unrun. `core/full-change-read.*`, `mixed-ack.*`, `mixed-missing-ack.*`, `missing-change-read.*`, final Changes. |
| RC21 — scope/identity/permission regressions | PARTIAL | Queued route disable1023 Held SETTING_SCOPE with unchanged asset/Fields/History; restored Setting5. Actual account/parent/field revocation and Computer/Monitor legacy first-copy, positive link and v2 paths passed. Suspend1016 blocked1017 and ACK183; native human save still succeeded without capture while suspended. Resume1018 retained identity242;1019 applied. Note Inventory1020 returned Note82 formatting; Note/control/firstcopy references denied. Mid-field Setting changes, moved entity/parent, competing claimant and every Notes operation were not tested here. `core/queued-disable*`, `monitor-*`, `suspend.*`, `while-suspended.*`, `resume.*`, `note-inventory.worker`, control/note denials. |
| RC22 — human saves, feedback and readiness | PARTIAL | Genuine native/Fields saves, including empty mapped Fields dates, succeeded and captured eligible values with real edit times. Sync-only writes produced no feedback Changes. Observed reasons/codes omitted raw sensitive diagnostics and rejected values. Controller Sync problems, scheduling, actual A/B convergence and unrestricted cron were not exercised. Arbitrary third-party hooks and all installed asset/field kinds remain outside this finite sample. `core/human-*.jsonl`, `after-*.jsonl`, `final-native.jsonl`, final fixture manifests. |

### Defects found, repaired and rechecked

1. **Active parent lookup assumed sequential iterator keys.** Work969 Held
   PARENT_SCOPE after native seed968 established Active Computer242 because
   `field_sync_parent()` read `$links[0]` from an ID-keyed iterator. Independent
   reproduction/review replaced that assumption with the ordered first row.
   Root deployed `inc/fieldisolation.php` SHA256
   `ed23ed4414dd4adf388bebc938ad804cf085b5ed926983ad9f4ab0bac8a08db2`.
   Fresh972 passed;969/peer971 retained their original failures. Evidence:
   `core/diagnostic-parent.jsonl`, `linked.worker`, `reconcile-initial.worker`,
   `deployment/active-link-fix-hashes.json`.
2. **Locked Fields reread omitted the existing empty-value normalization.**
   Genuine human date clearing succeeded and stored exact empty string;1001
   then rejected a valid repopulation as FIELD_UNAVAILABLE. The narrow
   `locked_value()` correction applies the existing ordinary-read rule only to
   exact `''` in nullable Fields date/datetime/number storage. Arbitrary invalid
   values, dropdowns and clear writers remain unchanged. Root deployed
   `inc/results.php` SHA256
   `44052e4b98d9eeabdda54b42b72dcc2899f8f0e9b0c46aac81ce19004a41aa8d`.
   Fresh1006/ref1001 VerifiedApplied;1001 kept its rejection. Evidence:
   `core/human-fields-empty.jsonl`, `current-version.worker`, `date-after-fix.*`,
   `deployment/locked-read-fix-hashes.json`.
3. **Dead owner cleanup masked the primary fatal transaction signal.**
   A clone lost-owner fault made final worker-lock RELEASE on the dead owner
   replace the existing9101 failure. The narrow process_batch finalizer now
   preserves an already-propagating9101; standalone/legacy release failures
   still throw. Independent review and fresh clone1007 closed that case while
   the earlier clone1006 remained intact. Root deployed `inc/process.php`
   SHA256 `668c97e312efcacf3941b2248c3255ab1b8ef15ab10816b92fdf2e8a601615b7`.
   Evidence: clone `ownerloss-after-fix.*`,
   `deployment/cleanup-fix-hashes.json`.

Initial fixture mistakes remain in the private ledgers: encrypted token use
caused setup401; direct Profile::update did not remove the intended computer
right for1002, so1002 is not denial evidence. Correct ProfileRight mutation
produced1005 Held/PARENT_SCOPE; rights were restored and a fresh session used.
The1022 pause timeout was retained as a safe prewrite timeout, not reported as a
successful concurrent newer-edit test. Root deployed only independently
reviewed bounded fixes; no existing Work was reset to manufacture a pass.

### Remaining gaps and interpretation

The new loop has bounded B-side runtime evidence, not complete integration
certification. Actual Controller A scheduling, Sync problems, durable coverage,
local ReturnToA saves and automatic end-to-end reconciliation remain unrun.
True wire-level COMMIT/HTTP response loss, successful mid-execution newer-human
arbitration, separately listed permission/reference/storage variants, moved
scope/competing identity, unrestricted cron and exhaustive native-hook/type
coverage remain explicit gaps. A finite hook fault does not prove rollback or
idempotence of arbitrary external effects. Nothing here changes authority,
null semantics, exact whole-snapshot rules or preserved historical Unknowns.

The method/path/status inventory is `core/curl-calls.jsonl`. Runtime exercised
native V1 GET initSession; Setting POST/PUT; Work POST, exact/collection/search
GET and immutable PUT denial; Change GET and exact/mixed/denied PUT. Fixture
asset/Fields/dropdown/profile/account changes used native PHP model methods,
not direct asset SQL. Procedural injections, separate clone schemas and each
source/runtime limitation are recorded in the private actor ledgers. No
automated test framework or permanent test harness was introduced.

## Automatic scalar reconciliation source-only candidate — 29 October 2026

**Historical preparation:** the NOT RUN entries and source-only statements in
this section describe the earlier implementation turn. The user later
authorized the bounded run recorded in the local runtime ledger above; this
plan is retained unchanged so its unperformed subvariants remain visible.

Version **0.4.0** adds the explicit version 2 policy in
[reconciliation-contract.md](reconciliation-contract.md). This is a prepared
manual checklist, not a runtime ledger: **RC01–RC22 are all NOT RUN**. No current
implementation task deployed the plugin, upgraded a database, changed live
configuration/data, submitted/retried/reset/deleted a Work or performed a native
write. No automated tests were added or run. Works 1–7 and every existing Work
must remain untouched. Historical scalar/Notes evidence and the version 1 FI
checklist do not establish version 2 runtime behavior or A/B integration readiness.

Use separately approved disposable assets, route/Setting, account/profile and
new Work/Change fixtures. Retain their evidence and never reopen or reset an old
Work for repetition. Create reference fixtures through authorized native/plugin
paths; fault cases require separately bounded permission. Record the deployed
source/version, GLPI/Fields patches, table engines, B row IDs and A work IDs,
actual requests/results, original-reference bytes, selected native inputs,
before/after values and exact Change coverage. Use fresh API sessions after
rights changes. A's scheduling/problem ledger tests belong to Controller A;
this checklist specifies their B-side contract expectations.

### Prepared version 2 request and curl sequence

The IDs, labels and timestamps below are illustrative, not existing test targets.
Assume an authorized current route-12/version 8, Computer A42/B231, and a newly
created terminal linked Asset Sync reference at B Work row 401. Work 401's
immutable request must already contain positive B identity 231. Its journal may
be a separately authorized damaged/missing fixture; it must remain unchanged.
The current enabled mappings include asset_name and asset_status, and only
asset_status is selected. Save this complete JSON as `reconcile-request.json`:

```json
{
  "input":[{
    "work_id":"A-reconcile-20261029-001",
    "subject":"Asset",
    "operation":"Sync",
    "route_id":"route-12",
    "a_entities_id":12,
    "entities_id":5,
    "itemtype":"Computer",
    "identity_json":"{\"a_items_id\":42,\"b_items_id\":231,\"serial\":\"SN-0042\"}",
    "a_values_json":"{\"asset_status\":\"On Hold\"}",
    "a_change_times_json":"{\"asset_status\":{\"changed_at\":\"2026-10-29T10:00:00+08:00\",\"reliable\":true}}",
    "settings_version":8,
    "handled_change_ids_json":"[]",
    "field_sync_json":"{\"version\":2,\"mapping_ids\":[\"asset_status\"],\"reconcile_work_id\":401}"
  }]
}
```

Use private operator-supplied tokens and the newly returned disposable row ID:

```sh
B_API_BASE='http://localhost:8081/api.php/v1'
B_APP_TOKEN='<fixture application token>'
B_SESSION_TOKEN='<fixture service session token>'
B_RECONCILE_ROW_ID='<newly returned disposable Work row ID>'

curl --globoff --silent --show-error --include \
  --request POST "$B_API_BASE/PluginAgentbdmosassetsyncWork" \
  --header "App-Token: $B_APP_TOKEN" \
  --header "Session-Token: $B_SESSION_TOKEN" \
  --header 'Content-Type: application/json' \
  --header 'Accept: application/json' \
  --data-binary @reconcile-request.json

curl --globoff --silent --show-error --include \
  "$B_API_BASE/PluginAgentbdmosassetsyncWork/$B_RECONCILE_ROW_ID" \
  --header "App-Token: $B_APP_TOKEN" \
  --header "Session-Token: $B_SESSION_TOKEN" \
  --header 'Accept: application/json'

curl --globoff --silent --show-error --include \
  "$B_API_BASE/PluginAgentbdmosassetsyncWork?searchText%5Bwork_id%5D=%5EA-reconcile-20261029-001%24&sort=id&order=ASC&range=0-49" \
  --header "App-Token: $B_APP_TOKEN" \
  --header "Session-Token: $B_SESSION_TOKEN" \
  --header 'Accept: application/json'
```

POST array acceptance remains native 201 `[{"id":<B id>,"message":<string>}]`:
it does not prove asset completion. Poll the same original ID after a lost POST
response; duplicate work_id must reject without a second write. GET is the raw
Work row with JSON-string result_json; hidden field_sync_json adds no raw-row
key. Decode the result and require field_sync.version 2 plus the exact
reconcile_work_id and ordered selection. Reasons are descriptive; machine codes,
certainty and exact IDs determine handling. No source_timestamp or parent_change_id
top-level Work field exists.

For acknowledgement only after every field/revision of the newly created exact
fixture Change is verified handled, save `{"input":[{"id":301,"status":"Done"}]}`
as `reconcile-ack.json`, replace 301 with that fixture ID, and use:

```sh
curl --globoff --silent --show-error --include \
  --request PUT "$B_API_BASE/PluginAgentbdmosassetsyncChange" \
  --header "App-Token: $B_APP_TOKEN" \
  --header "Session-Token: $B_SESSION_TOKEN" \
  --header 'Content-Type: application/json' \
  --header 'Accept: application/json' \
  --data-binary @reconcile-ack.json
```

Compare actual returned ID keys with submitted IDs and GET each missing or
uncertain exact Change. Native success is `[{"301":true,"message":<string>}]`
for that illustrative ID. B's direct PUT validates scope/rights/transition and
trusts A's completed handling; it does not prove A saved every field. Do not use
this command to conceal unresolved fields or acknowledge the same Done ID again.

### Named reconciliation checks — all NOT RUN

| Case | Manual procedure and required evidence | Result |
|---|---|---|
| RC01 — capability and shapes | On approved pre-0.3/fresh disposable installations, verify deployed 0.4.0 and existing additive field_sync_json upgrade; no further schema column/status/right/resource. Compare raw GET/collection/search keys. Absent/null stays legacy, version 1 has no reconciliation key, version 2 echoes exact version/selection/reference. Retained old requests/results remain byte-identical. | NOT RUN |
| RC02 — exact option validation | Distinct new IDs: version 2 with valid reference; missing/noninteger/nonpositive reference, extra option, duplicate/unknown/disabled/wrong-type mapping, values/times outside selection, malformed/nested JSON and unsupported version. Require native denial wrappers and documented field_sync_json/a_values_json/a_change_times_json errors; no saved invalid Work or native write. | NOT RUN |
| RC03 — prior reference eligibility | Missing/unreadable/wrong route/type/A asset/B asset/entity pair, nonterminal Accepted, Note, Suspend/Resume and original null-B/serial-only first-copy references deny. Old result content must never turn an ineligible reference into a linked recovery. Record reference bytes and asset counts. | NOT RUN |
| RC04 — damaged historical journal | Reference a newly created eligible terminal Held/Failed Work whose result is missing/damaged under separately authorized fixture setup. Fresh version 2 may compare/repair current selected state without parsing or replacing old result/status/error/request/timestamps. Compare every old column before/after, including original Unknown evidence when readable. | NOT RUN |
| RC05 — version repair and fresh intent | Advance the disposable Setting after repairing an option/mapping. Reference older terminal same-link Work; new request must use exact current version and current enabled mappings. Old values, bindings and edit times are never replayed. Stale new version or a reference with a greater settings version Holds/rejects as documented. The old reference supplies lineage only; old-version Changes retain their existing exact coverage/ACK rules. | NOT RUN |
| RC06 — terminal/quiescent execution | Bound a prior owned writer still processing, loss of its original lock-owner session, and another Accepted Asset Work in the same pair/route/type (Sync/control). Recheck terminal reference, worker ownership and retained Active identity; cross the route barrier before restart terminalizes a started Work. RECONCILE_PENDING prevents overlap; RECONCILE_SCOPE covers invalid reference/scope/version. Notes are outside this Asset conflict scan. Accepted/Pending is not refusal evidence and a later scope-control operation retains normal ordering. | NOT RUN |
| RC07 — source A convergence | With old write outcome unknown and current A authority valid, select only a different current scalar. B writes/rereads/verifies the new intent; old Work remains unchanged. Equal current values produce AlreadyEqual/VerifiedEqual without a native save or duplicated History; current proof never certifies the old operation. | NOT RUN |
| RC08 — source B return | Select B-owned scalar with/without supplied A value. B does not write it; ReturnToA carries current readable value/evidence. A's approved end-to-end check must verify its own save/equality before accounting for that field or acknowledging a Change. Merely receiving the result is insufficient. | NOT RUN |
| RC09 — Both authority and evidence | Test A-newer, B-newer, equal values, missing/unreliable/tied times and a newer genuine B edit during reconciliation. Apply current per-field genuine evidence only; no global date_mod/poll time/A-wins fallback. Differing unresolved evidence remains Conflict/Held, without overwriting either side. | NOT RUN |
| RC10 — format/dropdown/permission siblings | Select valid Name, invalid date/number or unresolved/ambiguous/denied dropdown label, and valid Serial. Only confirmed prewriter Rejected/NotAttempted fields are quarantinable; valid siblings progress. Field/container denial differs from account, parent READ/required UPDATE, route/entity and Setting failures. Inspect structured codes, not prose or HTTP alone. | NOT RUN |
| RC11 — repair and next distinct attempt | After terminal field rejection, repair the real cause, read fresh authoritative values/evidence and create a new targeted Work/ref. Previously converged fields remain unselected; cause repair cannot replay the old payload or turn old Unknown into success. Missing option/permissions are not repaired automatically by B. | NOT RUN |
| RC12 — exclusion, clearing and Fields storage | Test A/B/Both exclusions, mapping_ids empty, explicit supported nullable native clear, omitted value versus null/empty, and unsupported dropdown/Fields/custom null clears. Selected-only Fields update requires existing native storage and never resubmits excluded container values or creates defaults/storage. Record native hook/shared-storage limits separately. | NOT RUN |
| RC13 — owned connection start | With separately approved process-local instrumentation, demonstrate a genuinely new configured DB object/session with fresh GLPI bookkeeping for each version 2 Work, including durable processing start. Keep the original ambient session untouched; do not close/reconnect it or rollback unrelated work. On authorized fresh/upgraded disposable databases covering both core must_unsanitize_db_data flag states, verify writer and every observer use native PostBoot read policy consistently with ordinary API reads for quotes, backslashes, JSON and dropdown labels, without changing configuration. Demonstrate version 1/legacy paths retain their previous boundary. | NOT RUN |
| RC14 — worker and route locks | Run approved bounded concurrent workers. The original connection retains its worker lock through version 2 owned-session creation/close; route locks use their intended session. Verify no lock loss midloop, no duplicate processing, restoration of the original global connection and no competing writer after a failed owned connection. | NOT RUN |
| RC15 — independent progress visibility | Bound savepoint/commit-response and native-hook transaction-leak cases. A fresh independent native observer for each check must prove the same backend via the advisory challenge and see exact newly persisted Work metadata/marker/provisional proof/final journal before B trusts completion; same-connection visibility, a reused observer snapshot or a coincidentally matching asset value is insufficient. Unconfirmed observations/ownership must not publish VerifiedApplied or authorize later siblings. | NOT RUN |
| RC16 — interruption and restart | Interrupt after durable start, before/after mapping marker, native save/reread, provisional proof, commit and final persistence. Restart retains original identity and known sibling proof, Holds started uncertain Work without replay, preserves damaged evidence, and allows only a distinct eligible version 2 operation later. | NOT RUN |
| RC17 — commit/rollback/cleanup uncertainty | Bound owned DB construction, observer, commit, rollback, result save and lock/session close failures/lost acknowledgements. Preserve durable uncertainty and prior siblings; stop before later writes when boundaries are unsafe. Cleanup must restore original connection and preserve the original exception/evidence. Never mark Failed/Skipped as no effects. | NOT RUN |
| RC18 — lost HTTP/result responses | Lose POST response and locate exact original work_id, then poll it; do not create a fresh operation blindly. Lose GET safely repeat. Native false/mixed batch outcomes and HTTP201/200 are not processing proof. Use raw handled_change_ids_json whitespace such as `[ 301 ]` and mixed eligible/excluded snapshot references: immutable-request guards must compare original bytes while filtered execution context handles only eligible IDs, without losing durable completion proof. Read exact stored versioned outcomes and preserve earlier Unknown history after new convergence. | NOT RUN |
| RC19 — mixed snapshot across targeted Works | New Change contains Name/Status. Separate targeted Works may handle them; B does not aggregate partial receipts and each partial mixed correction leaves the whole row Pending/attempt count unchanged where excluded. A durably tracks exact field/revision coverage and sends one full ACK only after all fields are independently handled; one success or equal-now alone is insufficient. | NOT RUN |
| RC20 — whole coverage and exact ACK | Test one fully selected B correction, A-side aggregation across fresh Works, ReturnToA requiring A handling, newer separate Changes and older revisions. Only exact fully covered IDs become Done. Compare per-ID PUT results, omitted/missing IDs and exact GET readback; B never acknowledges unrelated/newer snapshots automatically. | NOT RUN |
| RC21 — scope/identity/permissions and regressions | During new processing disable/advance Setting, suspend or move the linked fixture, revoke captured submitter/parent/field rights and create competing identity ownership. Hold/reject with safe context categories before further writes, no fallback/relink/create/move. Repeat representative legacy/version 1, first-copy, Notes and Suspend/Resume cases on separate fixtures; do not alter their semantics. | NOT RUN |
| RC22 — ordinary saves, feedback and readiness | Human native/Fields saves remain non-blocking; sync writes stay under origin guard and queue no feedback Change. Results/loggable reasons contain no raw sensitive diagnostics/credentials/rejected values. A Sync problems/scheduling behavior is verified in its own authorized checks. Document incidental hook effects and unsupported evidence; no integration-ready claim before relevant B/A cases actually pass. | NOT RUN |

Every RC runtime case remains pending. Fault/concurrency cases need separately
authorized disposable fixtures and bounded instrumentation; this document does
not authorize them. The implementation does not promise reconstruction of lost
history or reversal of arbitrary native-hook effects. Source review and PHP
syntax checks cannot certify database/session behavior, fault recovery or A/B
integration. Preserve all earlier ledgers below unchanged.

## Scalar field isolation source-only candidate — 28 October 2026

**Historical preparation:** this original FI01–FI35 plan is retained below.
The later 0.4.0 RC run exercised representative version 1/legacy regressions;
it did not execute or certify all35 FI cases.

Version **0.3.0** adds the opt-in scalar contract in
[field-sync-contract.md](field-sync-contract.md). This section is a **prepared
manual checklist, not a runtime result**. Every FI case is **NOT RUN**. No
plugin deployment/upgrade, live configuration/data change, Work submission,
retry/reset/delete, native write or fault injection was performed for this
implementation task. No automated tests or harness were added or run. Works
1–7 and all other existing Works must remain untouched. Historical scalar and
0.2.0 Notes runs below do not establish this extension's behavior or A/B
integration readiness.

Use separately authorized disposable assets, entities, route/Setting and service
profile. Retain test Works/Changes as evidence; do not reset them to repeat an
operation. Record the actual deployed source/version, native GLPI/Fields patch,
field storage engine, fixture IDs, request IDs, HTTP/result readbacks, native
before/after values and exact Change IDs. Use fresh service sessions after
permission changes; prior Notes evidence found session rights caching. Never
assume a process-local permission check proves immediate API-session revocation.

### Manual curl shapes (prepared, not executed)

Use the full linked-asset request from [the exact protocol
examples](field-sync-contract.md#exact-rest-calls-and-examples), adapted only to
the authorized fixture's actual IDs/Setting/version. Save that complete outer
JSON as a local review payload; JSON columns remain JSON **strings**. Obtain a
native session through the existing login procedure. The variables below are
placeholders for operator-supplied fixture/session values, never credentials to
commit:

```sh
B_API_BASE='http://localhost:8081/api.php/v1'
B_APP_TOKEN='<fixture application token>'
B_SESSION_TOKEN='<fixture service session token>'
B_WORK_ROW_ID='<returned disposable Work row ID>'

curl --globoff --silent --show-error --include \
  --request POST "$B_API_BASE/PluginAgentbdmosassetsyncWork" \
  --header "App-Token: $B_APP_TOKEN" \
  --header "Session-Token: $B_SESSION_TOKEN" \
  --header 'Accept: application/json' \
  --header 'Content-Type: application/json' \
  --data-binary @field-sync-request.json

curl --globoff --silent --show-error --include \
  "$B_API_BASE/PluginAgentbdmosassetsyncWork/$B_WORK_ROW_ID" \
  --header "App-Token: $B_APP_TOKEN" \
  --header "Session-Token: $B_SESSION_TOKEN" \
  --header 'Accept: application/json'

curl --globoff --silent --show-error --include \
  "$B_API_BASE/PluginAgentbdmosassetsyncWork?searchText%5Bwork_id%5D=%5EA-field-isolation-20261028-001%24&sort=id&order=ASC&range=0-49" \
  --header "App-Token: $B_APP_TOKEN" \
  --header "Session-Token: $B_SESSION_TOKEN" \
  --header 'Accept: application/json'
```

POST array acceptance is 201 `[{"id":<B id>,"message":<native string>}]`;
acceptance is not completion. Poll only the same Work until its terminal
Done/Held/Failed evidence is known. Decode `result_json` once; it is an outer
JSON string. The optional request column is hidden from all raw Work GET forms;
the parsed immutable selection is echoed in `result_json.field_sync`.
Admission denial uses native 400/207 bulk wrappers, not an invented custom
422/409/error envelope. See the contract for exact messages and safe codes.

For exact acknowledgement **only after the entire fixture snapshot has actually
been handled**, send this body to the existing Change collection PUT, using the
same headers as POST:

```json
{"input":[{"id":301,"status":"Done"}]}
```

Expect the native `[{"301":true,"message":<native string>}]` success entry and
read back that exact Change if any result is omitted/uncertain. A supplied ID
or HTTP 200 alone is not proof. Missing IDs can be omitted by GLPI 11.0.7.
Do not use a mixed snapshot in this command to hide an unresolved field.

### Named checks — all NOT RUN

| Case | Manual procedure and required evidence | Result |
|---|---|---|
| FI01 — additive install/upgrade | On separately approved fresh and pre-0.3 disposable installations, verify 0.3.0, nullable Work `field_sync_json` with existing-row null default, no changed retained request/result bytes, no new public class/right/endpoint and existing Setting/Change/Notes defaults preserved. Record actual engines and upgrade behavior. | NOT RUN |
| FI02 — legacy strict-parser compatibility | Submit otherwise valid Asset requests with property absent and outer null. Verify existing omission/first-copy/authority behavior, Accepted result null and exact six legacy result keys/three field-outcome keys with no new certainty/error/member. Compare unfiltered native GET/collection/search row keys to pre-upgrade; no `field_sync_json` leak. | NOT RUN |
| FI03 — opt-in admission/readback | Supply version 1 and two selected enabled IDs. Confirm 201 only saves immutable request plus Pending/Excluded initial journal, no native asset write. GET the single row, collection and native search with discovered options: hidden raw property, same parsed version/ordered selection in result. Original supplied JSON text is unchanged in database read-only evidence. | NOT RUN |
| FI04 — selection schema/scope denial | Separate new IDs: malformed JSON, nested object instead of JSON string, noninteger/unknown version, extra option, nonarray/missing IDs, duplicates, unknown/disabled/wrong-itemtype mapping, wrong route/entity/version. Expect documented native denial/message and no saved Work/asset mutation. Base-validation and native-rights precedence remain valid. | NOT RUN |
| FI05 — outside-selection values/times | Select Name/Serial but send Status value or Status time, including a B-source mapping. Expect `ASB_INVALID_FIELD` for the appropriate JSON column; no silent inclusion. Empty objects with empty selection remain valid. | NOT RUN |
| FI06 — explicit exclusion, source A | Valid linked Active fixture: select Name/Serial, exclude enabled A-source Status that differs. Only selected fields are described/converted/compared/returned/written; Status outcome Excluded/NotAttempted, no Status value in return and no explicit native Status input. Saved Setting/mapping remains enabled and unchanged. Inspect native explicit input as well as final value. | NOT RUN |
| FI07 — explicit exclusion, source B | Repeat FI06 with Status B-owned, including an unreadable/invalid stored Status. Exclusion must avoid descriptor/label/value processing and B return; a bad excluded mapping must not reject selected siblings. Record physical row-load/native-hook limits separately. | NOT RUN |
| FI08 — explicit exclusion, source Both | Repeat FI06 with Both Status, differing values and missing/tied evidence. No excluded arbitration/conflict/return/write; selected siblings progress. A later selected request still uses the saved Both authority. | NOT RUN |
| FI09 — empty selection | Use `mapping_ids:[]`, empty values/times, valid positive linked identity and no handled IDs. Check normal account/route/parent/Active checks, no logical mapped reads or native writes, every enabled mapping Excluded, Done only if all scope checks succeed. | NOT RUN |
| FI10 — legacy omission versus selection | Without opt-in omit Status under A/B/Both separately: preserve old A skip, B read/return and Both conflict. With opt-in exclude it: Excluded for all. With opt-in select A/Both but omit value: Rejected/VALUE_REQUIRED/NotAttempted; selected B without A value still returns B. | NOT RUN |
| FI11 — explicit clear | For actual nullable supported date/text/scalar fixtures, select the mapping and send explicit inner null; verify saved clear/reread/correct genuine value evidence. Omission/exclusion never clear. Dropdown null/empty and genuinely invalid scalar values reject before native writer; no invented zero/default/NULL conversion. | NOT RUN |
| FI12 — selected authority/equality | Verify A applies winning value without borrowing B edit time; B returns current value without native write; Both uses only reliable genuine instants, missing/tied evidence conflicts, equal values need no write. Preserve current source-specific return/evidence behavior; no sync timestamp becomes a human edit. | NOT RUN |
| FI13 — format rejection plus siblings | Select good Name, invalid date/number and good Serial. Terminal result retains verified successful siblings and invalid mapping Rejected/NotAttempted/INVALID_VALUE (or documented FIELD_UNAVAILABLE where descriptor itself fails). Prove invalid mapping's native writer was not called; Done may contain rejection. No prose parsing is required. | NOT RUN |
| FI14 — dropdown rejection plus siblings | Missing, ambiguous or denied exact readable label must produce the appropriate safe structured field rejection before writer. Other selected valid fields complete. No automatic option creation, case folding, default choice or conversion of bad input into clear. | NOT RUN |
| FI15 — field permission versus account/scope | Under fresh captured submitter context deny one writable field/Fields container while leaving parent/account/scope valid; that field rejects FIELD_PERMISSION and siblings can complete. Separately revoke account/Work access, parent READ/required UPDATE or entity access, or route/Setting validity; Hold with work-context code (parent denial PARENT_SCOPE), stop further processing and do not classify global failure as a quarantinable mapping. | NOT RUN |
| FI16 — repaired fresh catch-up | Wait for original Work terminal. After proving target mapping Rejected/NotAttempted, fix cause, read fresh current A/B evidence and send distinct new ID selecting only that mapping. Check preserved earlier siblings, current A/B/Both authority, original Work immutable and no blind replay of its old payload. Accepted/Pending is not retry authorization. | NOT RUN |
| FI17 — first-copy/link guard | Non-null opt-in without positive B ID is admission denial. Positive B ID with absent, Suspended, wrong pair/type/entity or unverified retained Active link Holds before mapped work; no serial fallback, asset create/relink/resume/move. Record guard and asset counts. | NOT RUN |
| FI18 — legacy first copy and control/Notes regression | On approved separate fixtures, repeat legacy first-copy seeding of all supplied enabled sources; Suspend/Resume ordering/link retention; representative Note Sync/Inventory. Non-null field_sync_json on controls/Notes denies. Absent/null retains previous request/result behavior and no Notes behavior changes. No existing Work is reopened. | NOT RUN |
| FI19 — native selected-only input/hooks | Inspect normal native explicit input for selected mapping only, including native/custom virtual scalar. Verify no explicit excluded-value resubmission; native history/metadata may change. Add only separately approved bounded hook instrumentation to determine incidental sibling effects; document them honestly, never promise universal hook immutability. | NOT RUN |
| FI20 — Fields partial existing storage | With two mappings in one existing Fields container, select one, including unrelated malformed/unreadable excluded storage value. Verify selected-only validation, generated-storage update and history, no merged-container resubmission/default/add, no excluded mapped processing. Absent generated row or unsupported safe path rejects before mutation; no implicit row creation. | NOT RUN |
| FI21 — human saves and feedback | Ordinary native/Fields saves remain governed by GLPI/Fields and never blocked by capture. Sync native writes and nested Fields/history work stay under sync guard, producing no feedback Change. Later genuine human save captures normally; exclusions do not disable configured capture. | NOT RUN |
| FI22 — mixed excluded Change snapshot | Supply exact Pending snapshot with selected Name plus excluded Status. Selected Name may finish but Work Holds INCOMPLETE_SNAPSHOT with exact SNAPSHOT_NOT_SELECTED entry; whole row remains Pending with original attempt count/payload. It is absent from handled_change_ids_done and never silently acknowledged. | NOT RUN |
| FI23 — invalid handled references | Missing, other subject/asset/pair/route/entity/type/version and malformed mapping-key snapshot references Hold before any selected native mutation; preserve Pending rows/attempts. Already Done handling follows existing rules without rewriting immutable snapshot. | NOT RUN |
| FI24 — selected snapshot with rejected/conflicted sibling | Fully select a mixed snapshot but reject/conflict one field. Verify actual validated attempt accounting only, no whole-snapshot Done or premature covered/completed IDs for unresolved revisions, even when another field is VerifiedApplied. Unknown never completes any unresolved snapshot. | NOT RUN |
| FI25 — full correction and exact external ACK | Fully selected exact same-scope snapshots complete only under existing full-revision/time/permission coverage. Test older/newer snapshots and newly captured sibling rows. Reconcile exact handled_change_ids_done and external ID-key acknowledgements; later/unrelated rows stay Pending. A polling read or supplied ID is never an attempt/ACK. | NOT RUN |
| FI26 — durable marker before native call | With separately approved disposable process interruption after committed mapping marker and before native writer, retain original Work identity, mapping Unknown/in_flight verified=false and earlier verified siblings. Restart Holds without replay; never infer NotAttempted from missing completion evidence. | NOT RUN |
| FI27 — save false/throw and reread failure | Separately bound native save refusal/exception and verification mismatch/failure after writer invocation. Unknown with documented SAVE_UNCONFIRMED/WRITE_UNCERTAIN/VERIFICATION_FAILED is conservative even if the observed current value looks unchanged; stop further selected writes, preserve prior verified siblings and no auto-ACK. | NOT RUN |
| FI28 — field/provisional-evidence transaction | On checked supported transactional storage, interrupt after native save+reread and provisional journal save before commit, and after commit before cleanup. Record native values and durable in-flight verified=false/true states. Public certainty stays Unknown until confirmed commit, lock release and final journal; never claim a provisional marker is final applied proof. | NOT RUN |
| FI29 — commit/rollback uncertainty | With separately approved disposable fault boundaries, make commit and rollback outcome/acknowledgement uncertain. Commit uncertainty retains Unknown/COMMIT_UNCERTAIN where safely persisted. A rollback exception stops the worker with the earlier durable Unknown marker; restart reports INTERRUPTED, without requiring a newly saved ROLLBACK_UNCERTAIN code on an uncertain connection. Do not replay, downgrade certainty or reopen terminal Work even if a later read happens to equal input. | NOT RUN |
| FI30 — journal/lock cleanup uncertainty | Bound result persistence and route lock release failures/lost acknowledgements before/after their actual effects. Keep prior durable marker if new save fails; unresolved cleanup stays Unknown and Held. Uncertain metadata begin/rollback stops the worker before further Work/Change saves or same-connection readback; only a known clean helper boundary permits exact lost-response readback. GET may later establish committed completion metadata, but absent response alone proves neither failure nor no effect. | NOT RUN |
| FI31 — restart/missing journal | Restart a started opted Work at each durable boundary. Readable journals Hold without native replay, preserving known siblings and in-flight uncertainty. Missing/unreadable journals Hold with stable error ASB_FIELD_JOURNAL_UNREADABLE and preserve exact original result_json bytes/request; do not reconstruct excluded entries or fabricate per-field certainty. Missing selected evidence is unresolved, never NotAttempted or automatic catch-up permission. Accepted initial Pending before a durable start remains admission evidence only. | NOT RUN |
| FI32 — lost HTTP responses/readback | Lose POST response after save and find exact original Work ID/echoed request; do not submit a new operation blindly. Lose GET response and safely repeat GET. Read current Work/native state for Unknown but do not claim that current value alone proves native history/hooks/evidence completed or permits automatic retry. | NOT RUN |
| FI33 — storage/native transaction limits | On separately approved disposable nontransactional/unsupported field or Work storage, require prewrite STORAGE_UNSUPPORTED rejection. Use the deployment precondition of a fresh dedicated `php front/cron.php processWork` invocation, source-verified to have no native outer transaction. Inspect GLPI nested transaction/savepoint/public-void semantics, History/field boundaries and a separately bounded hook leaving an outer transaction open. Generic reused cron connections/third-party leaks are not proven clean by public GLPI APIs and no portable guard enforces this assumption; do not infer independent durability from same-connection visibility or savepoint release. No private accessor or success from a void return. | NOT RUN |
| FI34 — concurrency/current scope | Queue distinct requests on same valid route/link; verify single worker/route lock, setting/scope recheck and current Both evidence protect against stale overwrite. Denied/busy route or later scope change produces work-context outcome and no further native writes. Do not interpret prior field rejection as permission to overlap an Accepted/started Work. | NOT RUN |
| FI35 — safe results and integration boundary | Every enabled mapping has correct selected Pending/terminal or Excluded entry in the readable journal; only opt-in adds exact machine fields/field_sync. The documented damaged-journal exception retains raw evidence and grants no per-field certainty. Reasons contain no credentials/raw SQL/exception diagnostics/rejected business values. Held/Failed never imply no writes. Run corresponding A end-to-end selection/quarantine/fresh-current catch-up only after authorization; no integration-ready claim before these real checks pass. | NOT RUN |

### Remaining verification gaps

All FI01–FI35 runtime cases are pending. Source inspection can establish intended
request shapes, branches and journal ordering; it cannot establish actual native
save/hook transaction effects, fault acknowledgements, deployed schema behavior
or Controller A's interpretation. Crash/fault cases require separately authorized
bounded disposable fixtures; do not use this checklist as authorization to alter
live data/configuration, existing Works or the real B environment. Do not infer
that a cause repair resolves older Unknown Works or native recovery jobs.


## Native Notes local runtime verification — 28 October 2026

The user subsequently authorized deployment of the Notes candidate to
`http://localhost:8081` and manual NT01–NT31 checks with disposable fixtures.
This section records that later run; the source-only section below is historical
and its NOT RUN statements describe the preceding implementation turn. No
Controller A or real-environment deployment is part of this run. No commit or
push is authorized. Results distinguish observed passes from cases whose wider
subvariants remain unverified; a source review does not turn an unrun variant
into a runtime PASS.

Deployment upgraded and activated plugin version **0.2.0** in the local Docker B.
Pre-upgrade counts were 860 Works, 111 Changes and 34 Settings. Comparison of
every pre-existing column after the additive upgrade matched the before export;
new Work/Change defaults are `subject=Asset` and `note_json=null`, existing
Settings have `notes_itemtypes_json="[]"`, and the internal association table and
unique indexes exist. The operator retained full before/after XML exports and
a separate complete before snapshot of Works 1–7. Final comparison passed for
all original columns of **all 860 Works, 111 Changes and 34 Settings**, including
every original column of all seven protected Works 1–7. Their statuses and
payloads were not changed. Old Work 860 remained Accepted/unstarted; no new
fixture Work remained Accepted. All 17 deployed PHP files matched the repository
by SHA-256 and version 0.2.0 was active. No plugin PHP source was changed during
this runtime-verification turn.

The fresh plugin-install branch was also exercised on a new disposable database
`agentb_notes_fresh_20261028`, cloned from the local GLPI base while excluding
the four Agent-B tables and its registration/right/task rows. The native install
hook returned true, created four empty tables, registered 57 profile-right rows
and external waiting 60-second task 52, and established the expected defaults
and both Note identity unique keys. The original database context was restored.
This proves fresh **plugin-hook** installation on that GLPI base, not a clean
GLPI installer or a separate production CLI deployment. No DROP/delete/reset
was used.

An unrelated pre-existing Accepted Work was present. To leave existing jobs
untouched, operators did **not** run an unrestricted cron batch. Each disposable
Work was selected explicitly and passed through the same worker lock, durable
start marker and `plugin_agentbdmosassetsync_process_existing()` processing path.
That establishes the exercised processor behavior, not a global cron-dispatch
test. Native fixtures use GLPI methods; plugin admission and acknowledgement
use native REST V1. A-side handling is simulated for B-side acknowledgement
checks and does not establish Controller end-to-end behavior.

Shared new fixtures: entity **13**, profile **18** and user **18**; no existing
profile rights were changed. Main route `notes-main-20261028`, Setting **36**,
uses versions 1–7. Version 5 omitted Notes and preserved `["Computer"]`, version
6 explicitly disabled it with `[]`, and version 7 re-enabled it. Computer **234**
has verified parent Work **871** (`Done`, `Active`, default Asset subject).
Native Note **62** created immutable Note Change **113**. Adoption Work **878**
was first `Accepted` with no processing marker/result, then `Done/AlreadyEqual`:
the parent remained 234, the Note Work link columns remained null, and the
captured genuine value evidence was preserved.

Local raw evidence is retained outside the repository at
`/tmp/agentb-notes-20261028.DR68R2` for this operator session. Credential/session
files in that directory are not report artifacts and must not be committed or
shared. This ledger includes only redacted request shapes, IDs and outcomes.
Temporary evidence paths are not a promise of durable archival.

Confirmed admission evidence:

- Duplicate/non-subset Notes selections returned HTTP 400 with
  `ASB_INVALID_FIELD: field=notes_itemtypes_json`; unknown and non-Notes types
  returned `ASB_UNSUPPORTED_ITEMTYPE` in the native `ERROR_GLPI_ADD` wrapper.
- A 27-entry all-invalid Work bulk request returned HTTP 400
  `ERROR_GLPI_ADD`, with every entry `id=false`. It covered subject/operation,
  scalar separation, malformed/extra Note fields, IDs, content, time/offset,
  reliability, Inventory bounds/handled IDs, duplicate handled IDs, B-owned and
  unknown fields, missing `note_json`, and duplicate `work_id`.
- The internal Note-link name was rejected as an API resource with
  `ERROR_RESOURCE_NOT_FOUND_NOR_COMMONDBTM`; it is not a fourth public itemtype.

### Executed NT01–NT31 results

Final tally: **27 PASS (including explicitly bounded/representative passes),
4 PARTIAL**: NT16, NT17, NT22 and NT27. All 31 cases were exercised; this is
not a claim that all 31 full variant sets passed.

PASS means the stated representative behavior was observed on the local GLPI
11.0.7 fixture. PARTIAL preserves concrete unrun variants or a verified runtime
limitation. The cases do not certify every registered type, every HTML construct,
all storage failures, real Controller application or unrestricted cron dispatch.

| Case | Result | Actual local evidence and remaining boundary |
|---|---|---|
| NT01 — additive install/upgrade | PASS, bounded | Upgrade comparison preserved every pre-existing payload column across 860 Works/111 Changes/34 Settings. New defaults/indexes verified. Separate cloned-base fresh plugin hook created four empty tables, rights and task. Clean GLPI installation and production CLI deployment are outside this result. |
| NT02 — Setting capability/compatibility | PASS | Main Setting 36 omitted Notes at v5 and retained Computer, explicitly disabled at v6, re-enabled at v7. New Setting 38 omitted Notes and defaulted to `[]`. Duplicate/non-subset/unknown/Software/Unmanaged selections, same-version replacement and preserved Notes with an empty enabled-type set returned their exact native 400 errors. Main Setting stayed v7. Core Setting 35 retained scalar mappings and ended enabled at v5; no request enabled a native capability. |
| NT03 — three-record REST surface | PASS | Single/bulk Work admission and ordinary GET/Change PUT used the native wrappers; Work 878 was Accepted before explicit processing. Internal Note-link API name was denied. Mixed admission returned native 207 with independent good/bad results, not an atomic batch. No custom endpoint or callback was used. |
| NT04 — strict admission | PASS | All 27 invalid bulk entries returned `id=false`/HTTP 400: invalid subject/operations, scalar contamination, malformed/object/array/extra Note payloads, IDs/content/time/offset/reliability, Inventory limits/cursor/handled IDs, duplicate IDs, owned/unknown/missing fields and duplicate Work ID. Work 893 separately proved empty content is valid and not deletion. |
| NT05 — live keyset Inventory | PASS | Work 869 returned 49 supported rows plus image skip 5, `has_more=true`, cursor 50. After genuine concurrent-pass edit/add, 888 returned 10 supported rows through cursor 63 and `has_more=false`; historical evidence stayed unknown. Work 908 skipped native Document_Item-bearing Note 6 at limit 1 and advanced cursor 6. Inventory created no Change. |
| NT06 — new A Note | PASS | Work 863 Created Note 60/parent Computer 233 with exact Unicode/HTML/link content, creator/updater 18, visibility 0, durable association 1/reservation 863 and copied effective evidence. No Note echo or scalar/asset mutation was observed. |
| NT07 — unique equal adoption | PASS | Work 864 adopted historical Note 1 without changing native content, dates, author or visibility; evidence remained null/false. Work 922 with different leading whitespace created separate Note 69 rather than normalizing/adopting Note 1. |
| NT08 — unsafe initial match | PASS, bounded | 865 held duplicate exact Notes 2/3; 891/892 held explicit/implicit already-paired matches. Native ITEM_CAN READ denial 920 and candidate-auth exception 952 Held without creation. Work 956 encountered a real read-only MySQL 1054 error within the exact Note 75 candidate callback and Held without fallback; the Note and null A association stayed unchanged, then normal 960 adopted AlreadyEqual. A database wire disconnect was not simulated. |
| NT09 — expected B identity/parent | PASS | 866 adopted explicit same-parent Note 4. Wrong-parent Note 59 (867), conflicting paired ID (890), and nonexistent expected ID 999999 (921) Held without fallback creation, reparenting or native alteration. Parent movement variants are listed under NT16. |
| NT10 — durable identity/idempotence | PASS | Fresh Works for A Note 12 repeatedly reused B Note 60; duplicate original Work ID returned 400 `ASB_WORK_EXISTS`. Restart cases 894/895 retained one Reserved association and could not recreate; 896/897 reused committed Note 66 after reconciliation. |
| NT11 — equal content/evidence | PASS | 879 newer, 880 older, 881 tied and 882 unreliable incoming evidence all returned AlreadyEqual, retained B's genuine 15:37:31+08:00 evidence and left native metadata unchanged. Covered Change 115 was reported without acknowledgement. |
| NT12 — later A wins/clear | PASS | 889 applied later A content to Note 60, recording effective A time separately from last local human time. 893 applied empty content to the same Note, preserved visibility 1 and did not delete or echo. 924 preserved existing creator 2 while updater became actual local service 18. |
| NT13 — later B wins | PASS | 883 and main correction 904/928 returned B's current revision/evidence as ReturnToA without a native update. Covered Pending snapshots stayed Pending; ReturnToA alone did not acknowledge them. A-side application was simulated, not exercised in Controller A. |
| NT14 — tie/missing/unreliable | PASS | 884 tied differing content, 885 unreliable A, 886 missing A and 887 unknown historical B evidence all Held without content writes. Equal-value variants remained AlreadyEqual under NT11. |
| NT15 — content/media boundary | PASS, bounded | Unicode, formatting, ordinary link and empty clear round-tripped. Image Sync 868 Held; native image 5 skipped/no human-save blockage. Document 1/Document_Item 1 on Note 6 caused successful save/no Change, Held 907 and skip 908. Actual `_filename` text upload on 74 created native Document/file/relation 2 while save succeeded/no new Change/evidence invalidated; 951 Held. Native audio 78/video 79 saved without Changes; Sync 954/955 Held and Inventory 953 skipped 74/78/79. No file was transferred by Agent B or content stripped. This is representative supported formatting, not every HTML construct. |
| NT16 — parent/suspension/scope | PARTIAL | No link 909, wrong pair 910, suspended 912, stale version 915, disabled Notes 916 and disabled route 925 Held without Note writes. Suspend 911/Resume 913 retained identity; suspended human save succeeded/no Change/evidence invalidated; resumed save captured 137. Native move of 237 to entity 14, reversible soft-delete of 238 and process-local READ denial of 239 caused 948–950 Held; restored fixtures yielded 957–959 AlreadyEqual. Capacity removal remains unrun: native GLPI `onCapacityDisabled` hard-purges Notes/history/preferences, outside the non-destructive test boundary. |
| NT17 — Notes rights/submitter | PARTIAL | Own profile/user 19: rights 97 (READ+READNOTE+UPDATENOTE, no ordinary UPDATE) allowed 874 Created Note 61 with author/updater 19. Removing READ/READNOTE/UPDATENOTE made 875–877 Held with no Note writes. Read-only Inventory 917 succeeded; no READNOTE 918 and Work-CREATE revoked after admission 919 Held. Authentication context restored in all checked calls. Existing API-session rights caching is a separate limitation described below. |
| NT18 — native metadata | PASS | Copied new Note visibility 0/local authors observed; metadata-only and repeated same-body saves created no content Change or new genuine time. Existing visibility 1 survived clear/update. Admin-created Note 70 retained creator 2 after Work 924 and recorded actual updater 18. Invalid extra metadata properties were denied at admission. |
| NT19 — genuine immutable capture | PASS | Native edit 60 captured 115; new Note 63 captured 118; a later resumed edit created 137 without mutating 118. Known/unpaired A IDs, actual B IDs, parent identity, subject Note, `{}` scalar snapshot and genuine second-precision +08:00 evidence were read back. Metadata-only/repeated saves added none. Separate eligible routes' snapshots were counted separately. |
| NT20 — feedback/nested suppression | PASS | Sync seed/add/update emitted no own Note Changes. A guarded Monitor save followed by a deliberate fixture exception released the guard; the next genuine edit captured 134. A process-local Computer ITEM_ADD callback created nested Computer 236/Note 67 while the parent-add stack was active and produced no Note echo. Later Monitor Work 906 updated normally without feedback. |
| NT21 — nonblocking failure | PASS, bounded | Exact-route Change pre-add exception left human Note 61 save successful/no new row and invalidated association 5 evidence. After good baseline 125, a 20-second exact-link lock plus writer timeout 1 caused queue/invalidation failure: save succeeded in 2.03 seconds/no new Change, with `ASB_NOTE_CAPTURE_MANUAL_RECONCILIATION_REQUIRED` in the existing PHP log. A request-local ITEM_CAN exception during fresh Note 61 capture-read plus a throwing PHPLOGGER.warning() still left save true/no Change/evidence 0/null; fallback `ASB_CAPTURE_SKIPPED` stderr was observed by the operator. Callbacks/logger were restored in finally. Filesystem-full/unwritable-sink behavior itself was not simulated. |
| NT22 — restart/unknown outcome | PARTIAL | Killed 894 after native add but before commit: durable reservation 19 remained, uncommitted Note 65 did not, recovery 894 Held and fresh 895 Held without creation. Killed 896 after committed Note 66/Linked association 20 but before Work finalization: recovery Held; reconciled fresh 897 AlreadyEqual reused 66 with metadata unchanged. Wire-lost COMMIT acknowledgement, explicit rollback failure and upload-lifecycle interruption were not injected. |
| NT23 — supported worker concurrency | PASS, bounded | Paused native add in 898 while holding the worker lock. Overlapping second worker received GET_LOCK=0 and left 899 Accepted/unstarted. After resume, 898 Created Note 68; next 899 AlreadyEqual reused 68 and association 21. Unique A/B keys were verified. This proves supported-worker exclusion/reuse, not unsupported bypass-worker duelling writers or every transaction failure. |
| NT24 — correction references/attempts | PASS | 900 missing, 901 other Note, 902 other route and 903 other parent Held with no coverage. 927 combined Pending Note 140 and Asset 144 and Held on scope; complete XML readbacks for both rows stayed identical, proving no premature retry/error/payload change. Original snapshots remained immutable. |
| NT25 — exact successful correction | PASS | 905 AppliedToB reported covered `[113,132]` but completed only supplied 113, leaving 132 Pending. 914 AlreadyEqual completed supplied 132 and reported already-Done 113 without rewriting it. Retry metadata followed actual valid correction attempts. Other Note 129 remained separate until its later explicit acknowledgement. |
| NT26 — newer snapshot independence | PASS, bounded | 928 returned current B/ReturnToA and left supplied newer 140 Pending; 905 left unsupplied 132 Pending. In 947, A's native write committed before a controlled pause in the correction scan. A concurrent genuine B edit created 171. Resumed 947 Held with `handled_change_ids_done=[]`; supplied 165 stayed Pending with a reason/retry 2, and new 171 stayed Pending/retry 0/error null. Current native B retained the later human body. The result honestly preserved its earlier AppliedToB outcome despite the final Held status. |
| NT27 — exact native acknowledgement | PARTIAL | Old 129 PUT returned 200 true; full readback changed only status/date_mod/done_at. Repeat Done and B-owned snapshot update were denied. Bulk 140 valid plus 129 already Done returned native 207 with `140:true`, `129:false`; missing-ID bulk returned 207 with only `167:true`, and GET absent 999999999 returned 404. Anchored/exact GETs confirmed actual statuses. Fresh no-READNOTE session denied own Pending 125 with 400 and byte-identical readback. A pre-existing authenticated API session still retained cached rights after database revocation and could acknowledge 142; see limitation below. |
| NT28 — result/column shape | PASS | All 50 core Note Works retained null native Work `b_items_id`/`link_state`; all 70 core Works were terminal at the final readback. Sync/Inventory business members and Note snapshot shapes matched the contract; Held results returned a safe verified Note or null. Native GET/anchored collections returned standard record/array shapes, and a one-row range returned native 206. Unknown outcomes did not falsely claim creation; 947 retained an actual committed application despite later completion failure. |
| NT29 — Asset regression/filters | PASS, representative | Genuine Computer comment edit captured Asset 144 with null note_json. Work 923 omitted subject/operation/note_json, defaulted Asset/Sync/null and applied the mapped native Both comment; Notes/associations/core Changes were byte-equivalent before/after without echo. Exact Asset 144 acknowledgement later returned 200 true, changed only three status/date columns and left all 19 core Note Changes unchanged. Anchored Note collection returned nine Note rows, Asset filter only 144, unfiltered both. Earlier full Asset/Fields coverage is not silently repeated by this pass. |
| NT30 — second generic type | PASS, representative | Monitor 5 used the same Setting/Notepad path: parent link 862, AlreadyEqual 870, genuine Change 134 and AppliedToB 906 with evidence preserved/no feedback. Computer and Monitor passed; other registered/custom capable types are not runtime-certified by these two fixtures. No per-type handler or new public endpoint was introduced. |
| NT31 — older ACK after media edit | PASS, bounded | Native Note 64 later gained media: save succeeded and Change count stayed five. Earlier supported snapshot 129 was acknowledged successfully while immediate readback of later 142 remained Pending and byte-identical. The distinct later cached-session rights-negative exercise subsequently made 142 Done; it was retained and never reset. Fresh-session permission denial passed on 125. Do not misreport 142 as still Pending at final teardown or infer immediate database-right revocation from this test. |

### Verified limitations and interpretation

**GLPI V1 API rights are cached in an authenticated session.** The original
fixture user 19 session had Computer rights 97. After its profile's database
rights became 65 (READNOTE removed), that already-open session could still
acknowledge snapshot 142 (HTTP 200); a newly initialized session reported 65,
denied exact Pending 125 with HTTP 400 `ASB_CHANGE_SCOPE_MISMATCH`, and left its
whole row unchanged. The database rights were restored afterward. The worker's
separate captured-submitter checks did observe database revocations before
processing. This run therefore does not establish immediate revocation of an
existing API session. When withdrawing API permissions, the operator must also
end/reinitialize affected API sessions; neither client settings-version changes
nor the worker's fresh authorization checks invalidate an old REST session.
No custom authentication or unrequested code change was added to hide this
native-session boundary.

The curl requests exercised these native V1 operations, with redacted fixture
bodies represented by the request examples in the historical checklist below:
Setting POST/PUT; Work single/bulk POST, exact GET and anchored collection GET;
Change anchored subject/status/route collection GET, exact GET and single/bulk
id/status PUT; denial of the internal Note-link resource; and a native Computer
POST used only to create main fixture 234. Actual plugin admission
used 201/400/207 wrappers; exact/collection reads used 200/206/404 as applicable;
acknowledgement used 200/400/207 with native per-ID results. Other native asset
fixtures, Note lifecycle saves and fault injection used local GLPI methods.
Fixture creation is not a claim that A uses native asset/Note REST resources on
B. Raw request/response artifacts are
kept separately under `main/`, `core/` and `fault-*`; protected-record comparison
is `protected-record-comparison.json`, deployment comparison is
`deployed-source-hashes.json`.

Failures were injected only in process-local fixture hooks, by pausing/killing
the explicitly selected fixture processor, or with a rolled-back exact-link
row lock and session-local timeout. No persistent source patch, destructive SQL,
database reset or hard purge was used. Only the owned parent 238 was temporarily
soft-deleted and restored through native GLPI methods. A simulated exception/kill is not
proof of every storage/network failure. Actual filesystem logging-sink failure,
wire-lost COMMIT acknowledgement, rollback/release failure and all custom asset
capacities remain explicit gaps. Native capacity removal was intentionally not
executed: GLPI `HasNotepadCapacity::onCapacityDisabled()` force-purges Notes,
history and preferences. The global cron batch was intentionally not run while
unrelated old Accepted work existed. Fixtures, including terminal/Held Works and
the separate fresh-install database, were retained rather than reset or purged.

The rights fixture's initial `actor_restored:false` output compared the entire
session against a checkpoint before a native ProfileRight update; it included
that operation's message/session changes. A later per-call authentication check
compared user/profile/entity/cron/inventory context and returned
`context_restored:true`. The initial full-session measurement is not evidence
of an authentication restoration defect. Similarly, an initial clone-install
attempt reused native schema cache after switching database context and failed
before table creation; clearing the public schema cache and rerunning on the
new empty plugin schema produced the successful fresh-hook result above.

## Native Notes source-only candidate — 28 October 2026

Source: [notes-contract.md](notes-contract.md), extending the standard V1
[api-contract.md](api-contract.md). This section covers existing/new native
Notes and later content edits, text/formatting only, with per-note Both
authority. Every runtime case below is **NOT RUN**. This source-only task does
not authorize curl execution, runtime probes, fixtures, deployment, upgrade,
worker startup, database mutation, commit or push. Earlier runtime ledgers
below describe earlier candidates and do not establish any Notes result.

Source review: **COMPLETE — source only**. The complete PHP diff and new
`inc/notes.php` / `inc/notecapture.php` files were reviewed once against the
Notes contract, with necessary existing helper context. One P2 was identified:
exact acknowledgement of an older supported snapshot also validated the Note's
current content/media, so a later unsupported media edit could block that old
snapshot's acknowledgement despite unchanged identity and rights. The narrow
follow-up in `plugin_agentbdmosassetsync_notes_check_acknowledgement()` was
reread once: it now locks the actual Note and checks parent/type, native READ
and association, without consulting current content/media. Existing retained
ownership, entity, suspension and parent Notes-right checks remain. The P2 is
**resolved in source**; no other demonstrated P1/P2 or project-rule violation
was identified in this review. NT31 below remains NOT RUN.

The coordinator executed static checks using host **PHP 8.2.31 CLI**: `php -l`
passed for all **17 runtime PHP files**, and `git diff --check` passed before
the narrow follow-up. Those are syntax/patch-whitespace checks, with no GLPI
bootstrap or runtime writes. Final follow-up static-check status is recorded
by the coordinator: affected `inc/notes.php` passed `php -l` again after the
acknowledgement fix; no other runtime PHP changed after the all-file syntax pass.

Native Note lifecycle, attachment handling, transaction behavior, uncertain
creation recovery and target-version Notes rights still require a separately
authorized operator before a pilot readiness claim. No Docker container was
started and no deployment, migration, database write, Controller work, commit
or push was performed in this source-only task. No automated harness or
additional test software is proposed.

### Manual request fixtures and native REST shapes

For a future authorized run, use an isolated disposable route and a parent
already linked by verified Asset Work. Replace every illustrative ID/version
with an operator-owned fixture and the actual current Setting. Enable capture
before Inventory and retain actual IDs for deduplication. The examples do not
establish that route, parent, Notes or rights. Use genuine observed timestamps
for conflict cases; copied/current `date_mod` is not evidence of a human edit.
The Legacy base is deployment-configured; do not assume another GLPI API
generation or add a Note REST endpoint.

```sh
export B_V1_BASE='http://localhost:8081/api.php/v1'
export B_APP_TOKEN='<B_APP_TOKEN>'
export B_SESSION_TOKEN='<B_SESSION_TOKEN>'
export NOTE_ROUTE='notes-review-20261028'
export A_ENTITY_ID=1
export B_ENTITY_ID=12
export A_PARENT_ID=77
export B_PARENT_ID=231
export NOTE_SETTING_VERSION=2
export NOTE_SETTING_ID='<returned Setting ID>'
export NOTE_WORK_ID='<returned single Work ID>'
export B_NOTE_ID='<verified B Note ID returned after processing>'
export NOTE_CHANGE_ID='<exact Pending Note Change ID>'
export NEXT_NOTE_CHANGE_ID='<another exact Pending Note Change ID>'

# These variables are outer JSON-string contents: keep the backslashes.
# note_json is a JSON string in the REST request, never an inner object.
export NOTE_JSON_STRING='{\"a_notes_id\":12,\"b_notes_id\":null,\"content\":\"<p>Replaced battery</p>\",\"changed_at\":\"2026-10-28T10:00:00+08:00\",\"reliable\":true}'
export INVENTORY_JSON_STRING='{\"after_id\":0,\"limit\":50}'
```

Setting create uses all original required fields; its Notes selection is a
JSON string and a subset of enabled types. This fixture has no scalar mappings.
If replacing an existing operator-owned Setting instead, use its exact ID,
immutable route/entity pair and all current replaceable fields, with a strictly
higher version. Omitting `notes_itemtypes_json` preserves the selection;
explicit `"[]"` disables it. Do not replace an unrelated route's mappings.

```sh
cat > notes-setting.json <<JSON
{"input":{"route_id":"${NOTE_ROUTE}","a_entities_id":${A_ENTITY_ID},"entities_id":${B_ENTITY_ID},"route_enabled":1,"settings_version":${NOTE_SETTING_VERSION},"enabled_itemtypes_json":"[\"Computer\"]","field_mappings_json":"[]","notes_itemtypes_json":"[\"Computer\"]"}}
JSON
curl --silent --show-error --include \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  --request POST --data-binary @notes-setting.json \
  "${B_V1_BASE}/PluginAgentbdmosassetsyncSetting"
```

Single Note Sync creates only an Accepted Work. It must not save a Note inside
the POST. Keep the returned Work ID and GET it after the separately authorized
normal worker processes it. Its `b_items_id`/`link_state` columns remain null;
the verified parent ID belongs in `result_json`. Asset scalar payloads are `{}`.

```sh
cat > notes-sync-single.json <<JSON
{"input":{"work_id":"notes-review-single-20261028-1","route_id":"${NOTE_ROUTE}","a_entities_id":${A_ENTITY_ID},"entities_id":${B_ENTITY_ID},"itemtype":"Computer","identity_json":"{\"a_items_id\":${A_PARENT_ID},\"b_items_id\":${B_PARENT_ID},\"serial\":null}","a_values_json":"{}","a_change_times_json":"{}","settings_version":${NOTE_SETTING_VERSION},"handled_change_ids_json":"[]","subject":"Note","operation":"Sync","note_json":"${NOTE_JSON_STRING}"}}
JSON
curl --silent --show-error --include \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  --request POST --data-binary @notes-sync-single.json \
  "${B_V1_BASE}/PluginAgentbdmosassetsyncWork"

curl --silent --show-error --include \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  "${B_V1_BASE}/PluginAgentbdmosassetsyncWork/${NOTE_WORK_ID}?get_hateoas=false&expand_dropdowns=false"
```

For a later same-note Sync, retain A Note 12, replace the expected B ID with
the verified ID from the first result and use a fresh Work ID. This bulk body
shows a later Sync plus the first Inventory page; retain each returned Work
ID independently. Bulk order is not a processing-order guarantee. A later
Inventory page uses a fresh Work ID and the previous `next_after_id`, stopping
when `has_more` is false; do not use the collection `range` as that cursor.

```sh
export NOTE_JSON_STRING='{\"a_notes_id\":12,\"b_notes_id\":'"${B_NOTE_ID}"',\"content\":\"<p>Replaced battery</p>\",\"changed_at\":\"2026-10-28T10:00:00+08:00\",\"reliable\":true}'
cat > notes-work-bulk.json <<JSON
{"input":[{"work_id":"notes-review-bulk-sync-20261028-2","route_id":"${NOTE_ROUTE}","a_entities_id":${A_ENTITY_ID},"entities_id":${B_ENTITY_ID},"itemtype":"Computer","identity_json":"{\"a_items_id\":${A_PARENT_ID},\"b_items_id\":${B_PARENT_ID},\"serial\":null}","a_values_json":"{}","a_change_times_json":"{}","settings_version":${NOTE_SETTING_VERSION},"handled_change_ids_json":"[]","subject":"Note","operation":"Sync","note_json":"${NOTE_JSON_STRING}"},{"work_id":"notes-review-inventory-20261028-page-1","route_id":"${NOTE_ROUTE}","a_entities_id":${A_ENTITY_ID},"entities_id":${B_ENTITY_ID},"itemtype":"Computer","identity_json":"{\"a_items_id\":${A_PARENT_ID},\"b_items_id\":${B_PARENT_ID},\"serial\":null}","a_values_json":"{}","a_change_times_json":"{}","settings_version":${NOTE_SETTING_VERSION},"handled_change_ids_json":"[]","subject":"Note","operation":"Inventory","note_json":"${INVENTORY_JSON_STRING}"}]}
JSON
curl --silent --show-error --include \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  --request POST --data-binary @notes-work-bulk.json \
  "${B_V1_BASE}/PluginAgentbdmosassetsyncWork"

curl --silent --show-error --include \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  "${B_V1_BASE}/PluginAgentbdmosassetsyncChange?searchText%5Bsubject%5D=%5ENote%24&searchText%5Bstatus%5D=%5EPending%24&searchText%5Broute_id%5D=%5E${NOTE_ROUTE}%24&range=0-49&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false"
```

Expected native shapes: single create `201 {"id":1234,"message":<string>}`;
bulk create `201 [{"id":1234,"message":<string>},...]`; single validation
failure `400 ["ERROR_GLPI_ADD",<message>]`; all-denied bulk
`400 ["ERROR_GLPI_ADD",[{"id":false,"message":<message>},...]]`; mixed bulk
`207 ["ERROR_GLPI_PARTIAL_ADD",[{"id":<id-or-false>,"message":<string>},...]]`.
The batch is not atomic. GET returns a raw record/array, never a custom
envelope. Queue collection paging is inclusive offset `range`, with native
200/206/Content-Range rules; after acknowledged rows leave Pending, request
the first page again. GET and receipt of handled IDs never acknowledge a row.

Only after A's actual handling succeeds, acknowledge exact IDs with the
unchanged native PUT. These are alternative single/bulk forms, not two calls
to apply to the same IDs. Omit every B-owned field, including dates/error.

```sh
cat > notes-ack-single.json <<JSON
{"input":{"id":${NOTE_CHANGE_ID},"status":"Done"}}
JSON
curl --silent --show-error --include \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  --request PUT --data-binary @notes-ack-single.json \
  "${B_V1_BASE}/PluginAgentbdmosassetsyncChange"

cat > notes-ack-bulk.json <<JSON
{"input":[{"id":${NOTE_CHANGE_ID},"status":"Done"},{"id":${NEXT_NOTE_CHANGE_ID},"status":"Done"}]}
JSON
curl --silent --show-error --include \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  --request PUT --data-binary @notes-ack-bulk.json \
  "${B_V1_BASE}/PluginAgentbdmosassetsyncChange"

curl --silent --show-error --include \
  -H 'Content-Type: application/json' -H 'Accept: application/json' \
  -H "App-Token: ${B_APP_TOKEN}" -H "Session-Token: ${B_SESSION_TOKEN}" \
  "${B_V1_BASE}/PluginAgentbdmosassetsyncChange/${NOTE_CHANGE_ID}?get_hateoas=false&expand_dropdowns=false"
```

Successful PUT is the standard `200 [{"<id>":true,"message":<string>},...]`,
including single input. Native partial/all-denied wrappers still apply.
Compare returned ID keys, then GET unresolved/exact IDs: only their actual
`status: "Done"` confirms completion. Missing/native-omitted IDs and HTTP 200
alone are not proof. A second acknowledgement of Done remains denied.

### Named manual checks — all NOT RUN

Record actual request headers/body (tokens redacted), native response, Work
before/after and exact parent/Note/association/Change readbacks for each case.
Use normal native lifecycle operations only when separately authorized. Any
fault/race/migration exercise needs its own bounded disposable-environment
authorization; this checklist does not authorize direct database mutation.

| Case | Manual verification and required result | Actual result |
|---|---|---|
| NT01 — additive install/upgrade | On separately authorized fresh/upgrade fixtures, verify Notes-disabled `[]` default, Work/Change `subject=Asset` and null `note_json` for existing rows, internal association table/unique keys and required evidence columns. Compare all pre-existing payloads unchanged; an upgrade must not clear/rewrite them. No install/upgrade/uninstall is run in this task. | NOT RUN |
| NT02 — Setting capability and compatibility | Create valid enabled Notes subset; omit Notes on a full later replacement and verify preservation, then explicitly disable with `[]`. Duplicate/non-subset selections use `ASB_INVALID_FIELD: field=notes_itemtypes_json`; unavailable/non-Notes types use `ASB_UNSUPPORTED_ITEMTYPE: itemtype=<type>`, inside the native wrapper. Prove no payload enables a GLPI capability. Existing scalar mappings and increasing-version rules remain in force. | NOT RUN |
| NT03 — unchanged three-record REST surface | Exercise full single/bulk bodies above, Accepted before processing, normal GET and exact acknowledgement. Verify only Setting/Work/Change are public plugin records; internal `notelinks` is unavailable as an API itemtype. No custom route/auth, callback or B outbound call exists. | NOT RUN |
| NT04 — strict admission | Reject unknown subject/operation, Note Suspend/Resume, Asset with non-null `note_json`, Note nonempty scalar objects, malformed inner JSON/types, extra note keys, invalid IDs/time/reliable combinations, Inventory handled IDs and invalid bounds, duplicate handled IDs, and supplied B-owned Work fields. Empty Note content remains valid content, not deletion. Invalid Note fields use `ASB_INVALID_FIELD: field=<field>`; missing/unknown top-level and B-owned fields retain their existing field-specific validation messages, all inside the standard native wrapper. | NOT RUN |
| NT05 — Inventory paging and skipped positions | Before backfill, enable capture. Inventory more than 50 same-parent notes including unsupported media between supported IDs; follow ascending keyset `next_after_id`, extra-row lookahead and `has_more`. A skip consumes its ID/cursor, remains unchanged and returns a reason. Deduplicate live inventory/events by IDs; no fabricated edit times, Change rows or immutable-snapshot claim. | NOT RUN |
| NT06 — first new A Note | With complete readable same-parent lookup proving zero exact matches, Sync reserves A identity before native add. Created requires one actual B Note, verified unchanged formatting/parent, durable association and effective evidence; new visibility is 0 and actual local account owns native author fields. No scalar/asset write or feedback Change. | NOT RUN |
| NT07 — unique equal existing Note adoption | With exactly one unpaired same-parent exact-content Note, Sync returns AlreadyEqual, associates IDs and leaves content/native metadata/visibility unchanged without `update()`. Preserve unknown historical evidence as null/false. Ordinary whitespace/markup differences are not equal. | NOT RUN |
| NT08 — ambiguous or unsafe match | Two exact-content candidates, an exact match paired to another A Note, denied/incomplete lookup, expected B ID already paired elsewhere, or unpermitted candidate all Hold unchanged. None proves creation safe. Do not replace unrelated notes as a collection. | NOT RUN |
| NT09 — explicit B identity and parent guard | An unpaired supplied expected B ID adopts only a permitted Note on the exact verified parent. Wrong B ID, wrong parent/concrete type/entity or disagreement with an existing association Holds without reparenting, fallback creation or alteration of another note. | NOT RUN |
| NT10 — two Work IDs, one durable Note | Process two fresh Work IDs for the same A Note/parent/route, including changed content after pairing. Both reuse one internal association and one B Note even when content changes. Same Work ID is globally rejected with `ASB_WORK_EXISTS`; a new Work ID cannot bypass missing/Uncertain prior creation. | NOT RUN |
| NT11 — equal paired current content | Send paired equal content with newer, older, tied or unreliable incoming evidence. AlreadyEqual performs no Note update, preserves evidence belonging to the stored value and does not create a genuine edit/winning time. Leave content, native metadata and unrelated Notes unchanged. | NOT RUN |
| NT12 — Both, later A wins | With differing content and A's genuine reliable instant later than B's, apply only the paired Note through native Notepad. AppliedToB requires verified save/association/evidence; preserve formatting and copied A evidence separately from B's last genuine human edit. Native date_mod alone must not decide. | NOT RUN |
| NT13 — Both, later B wins | With B's genuine reliable instant later than A's, return ReturnToA with verified B snapshot/evidence, without local Note update. Exact covered Pending Changes stay Pending until A successfully copies and acknowledges them; no automatic completion on return. | NOT RUN |
| NT14 — Both, tie/missing/unreliable evidence | Differing content with equal instants, missing/null evidence, reliable=false or unknown current-value evidence Holds without update. A newer-looking native date_mod or incoming unreliable time cannot win. Equal content remains NT11. | NOT RUN |
| NT15 — supported content and file skips | Round-trip formatting, Unicode, empty content and ordinary external hyperlinks exactly. Inline images, uploads, media and native document references cause Held Sync, Inventory skip and local capture log/omit; no stripping, fetching, copying files or deletion. Unsupported content must not block a human's normal native save. | NOT RUN |
| NT16 — verified parent and suspension | Without a verified Asset link, with Suspended link, moved/deleted/unreadable parent, stale pair/scope/settings or disabled route/Notes, hold before any Note write. Note Work never creates/links/resumes an asset and keeps Work `b_items_id`/`link_state` null. Recheck current parent and scope before each write. | NOT RUN |
| NT17 — real Notes rights and submitter | Under captured submitting user/profile, test parent READ, READNOTE and UPDATENOTE separately, including revocation after acceptance. Missing capability/rights Holds; cron privileges cannot substitute. A profile that has required Note rights but lacks ordinary asset UPDATE must not be rejected solely for that missing asset UPDATE. Inventory/read-only operations require their applicable rights. | NOT RUN |
| NT18 — native metadata boundaries | Edit an existing visible-from-ticket Note and verify its existing visibility survives explicitly. New copied Notes use 0. Reject remote author/updater/date/parent/visibility/file properties; native local account provides author/updater. Metadata-only native saves produce no content Change or human-content time. | NOT RUN |
| NT19 — genuine native save capture | On an already eligible existing parent, native add/edit creates one immutable Note snapshot per eligible route with exact actual B ID, known A ID or null, parent identity, `{}` changed_fields, genuine reliable second-precision +08:00 time. Repeated/metadata-only saves add none; later edits create separate rows without mutating earlier snapshots. | NOT RUN |
| NT20 — nested/sync feedback suppression | Native Note add/update under the full sync guard, including nested lifecycle work and nested asset creation, creates no feedback Change. Guard releases normally/on exceptions; a later genuine save captures. B never queues its own applied sync content back to A. | NOT RUN |
| NT21 — nonblocking capture and queue failure | With separately approved bounded failures in lookup/evidence/queue persistence/logging, a normal native Note save still succeeds; capture snapshots are read-only, no save-input mutation escapes, existing PHP log reports omission, and no false Change exists. Missed capture best-effort invalidates older asserted current-value evidence; if that evidence update also cannot persist, the existing log reports `ASB_NOTE_CAPTURE_MANUAL_RECONCILIATION_REQUIRED`. No shutdown-only capture, auto retry or extra log. | NOT RUN |
| NT22 — uncertain creation and reservation | With approved interruptions at reservation, native add, verification and association/evidence confirmation, do not claim Created without a verified save/durable state. Preserve committed reservation on unknown outcome; Held/Uncertain and a new Work ID cannot automatically create again. Definitive failed save may Failed. Held/Failed never reopen automatically. | NOT RUN |
| NT23 — atomicity/concurrent identities | In an approved disposable lifecycle/transaction/race exercise, verify A reservation is durable before creation, native Note plus linked evidence confirm in a local transaction where supported, uniqueness prevents competing A/B pairing and concurrent fresh Work IDs do not duplicate a Note. Record real lifecycle/rollback limits; reservation alone is never success. | NOT RUN |
| NT24 — correction reference validation | Use exact supplied distinct same-note Note Change IDs. Asset/other-note/other-parent/route/entity/stale-scope references deny correction without completing any row or recording a premature attempt. Original snapshots stay immutable; receiving IDs is never acknowledgement. | NOT RUN |
| NT25 — exact successful correction coverage | After valid references and an actual correction attempt, successful equal content or a newer reliable winning content revision completes only demonstrably covered supplied IDs. Return exact `covered_change_ids`/`handled_change_ids_done`; already Done references are covered without rewriting them. retry_count follows actual attempts. Unrelated rows stay unchanged. | NOT RUN |
| NT26 — newer/uncertain snapshot remains Pending | Supply an older correction with a differing later snapshot or missing evidence. That snapshot stays Pending with a reason; a valid older supplied snapshot may be covered only under full-content revision rules. A later snapshot created during processing stays separate; no broad parent/note acknowledgement or mutable snapshot. | NOT RUN |
| NT27 — exact acknowledgement | After successful external handling, PUT only id/status using the single/bulk forms above. Verify each exact row Done, timestamps B-owned, later same-note snapshots still Pending, and denied/absent/already Done IDs do not count as success. Reject attempts to alter Note snapshot/scope/error fields. | NOT RUN |
| NT28 — result shape and failure state | Sync result has exactly `b_items_id`, `note_outcome`, `note`, `covered_change_ids`, `handled_change_ids_done`; Inventory has exactly parent ID, notes/skips, cursor/has_more. Snapshot has only A/B Note IDs, content and value evidence. Held may safely return verified snapshot or null; unknown outcome never reports Created/AppliedToB. No redundant asset write. | NOT RUN |
| NT29 — old Asset behavior and subject filters | Repeat relevant existing Asset admission/processing/capture/ack manual cases with omitted/default Asset subject and null/omitted note_json. Setting omission preserves Notes as specified. Unfiltered old Change GET can include Note rows: clients must understand/filter subject before enabling Notes; settings_version alone is not capability negotiation. Verify anchored Asset/Note collection filters and native pagination. | NOT RUN |
| NT30 — generic path and scope of implementation | Review/operate a second registered Notes-capable parent type through the same data-driven native Notepad path when authorized. No per-type class, speculative abstraction, Controller code, custom auth/routes, file support, delete/purge/move, automatic retry, unrelated cleanup or outbound B call. Uninstall is separate explicit administrator authorization. | NOT RUN |
| NT31 — old snapshot acknowledgement after a later media edit | Capture a supported Note snapshot and have A successfully handle that exact revision. Before its acknowledgement, make a later normal native edit containing unsupported media; that human save survives and capture skips/logs it. Exact id/status acknowledgement of the earlier immutable supported snapshot must still succeed when Note identity, retained parent/link, entity/suspension and current READ/READNOTE/native READ permissions remain valid. Missing/wrong-parent/unpermitted/reassociated Notes still deny acknowledgement. Existing later supported snapshots remain Pending; the skipped media value is neither transferred nor silently acknowledged. | NOT RUN |

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
| Mapping-version continuity and first-copy current proof (0.4.1) | [Current MV/FCP local ledger](#mapping-version-and-first-copy-local-runtime-verification--29-october-2026), private `agentb-firstcopy-mv-20261029.fPFhUh` evidence | Independent source/evidence review; 12 MV cases PASS/4 PARTIAL, all8 FCP cases PASS. Initial created-ID diagnostic failure retained; correction/fresh boundary verification and final protected comparison/scheduler restoration complete. |
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
