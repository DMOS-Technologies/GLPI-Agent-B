# Senior 1(b) existing-asset processor runtime evidence — 24 October 2026

READY for independent evidence review and completion of this processor stage. 48 actual manual curl calls and 31 native local operator invocations. No implementation change was needed during this pass. One intentionally incompatible custom number produced a verified Failed field with rollback and honest partial evidence, as required.

Deployment: ONLY inc/work.class.php, inc/process.php, inc/write.php from reviewed inbound-b candidate. Shared deployed outbound-a capture/field helpers retained. No schema/install, automated tests, regression harness, raw DML, delete/purge/uninstall, custom HTTP route, repository edit, commit or push. GLPI11.0.7, Fields1.24.4, localhost:8081/api.php/v1.

All API requests use the existing restricted service user12/profile14/entity0 nonrecursive. Tokens stayed in memory and are redacted. Common headers Accept/Content-Type application/json; App-Token [REDACTED]; login Authorization user_token [REDACTED], other calls Session-Token [REDACTED]. GET body null means none. All three created native API sessions closed successfully (calls3,21,48). Local scoped CronTask51 starts/ends only Agent B processWork, never all-GLPI cron or old plugin tasks. Cron caller user2/profile4 and cron flag restored after successful and held/failed jobs. Exact volumes/states/IDs are in local ledger.

## Matrix results and limits

| Case | Runtime result |
|---|---|
| IB01 | PASS: Work23 admitted Accepted before write; existing unique serial resolves Computer149; native runner writes/rereads name, Done/AppliedToB with Active verified link149 and completed_at. History attributes service user12. |
| IB02 | PASS representative: Work24 AlreadyEqual leaves History2->2 and Change13->13. Missing values explicitly Skipped; disabled/unmapped values unchanged. Work55 B/Both held with explicit not-installed field reasons, no false return/winner. |
| IB03 | PASS retained reuse after genuine serial change (Work25); claimed mismatch26, unverified B ID27 and competing A source33 Held. Linked missing/deleted/template/wrong-entity and multiple retained B IDs NOT RUN; no destructive or invented link fixtures. |
| IB04 | PASS exact serial23, duplicate28, absent29, zero30, case31 and whitespace32 Held without creation. No-serial asset type and inaccessible lookup variants source-only/NOT RUN. |
| IB05 | PASS old contained Work1–22 held under disabled/missing routes; unknown route35, type36, version37, wrong A entity34 Held; Work42 route version changed after acceptance Held. Concurrent mid-field settings change and wrong B entity source-only/NOT RUN. |
| IB06 | PASS Work CREATE revoked after admission41 -> Held; asset read revoked53 -> Held; Fields write revoked54 -> Done with explicit Skipped permission reason and unchanged field. Cron-admin cannot bypass. Only new test profile14/new container7 altered, exact prior rights restored: Work5, Computer7, container4. User inactive/expired, authorization removal/entity change and active Session bypass injection NOT RUN. |
| IB07 | PASS first old backlog limited to20 ascending IDs then2 (volumes20/2). Global advisory lock held on a second native connection leaves Work57 Accepted/start null/volume0; after release it processes once. Safe before-write marker via local saveProcessorFields causes56 Held/uncertain without replay. Terminal rows never reselected in subsequent logged batches. Actual crash after a partial committed field NOT RUN. |
| IB08 | PASS partial evidence47: text and later permitted custom fields succeed, numeric reread fails and rolls back only that field to2; overall Failed retains Active link and all outcomes. Work50 applies valid native name while invalid sibling values are explicitly Skipped. Uncertain process interruption injection NOT RUN. |
| IB09 | PASS native text and Monitor boolean; Fields finite number/boolean/date/datetime; custom integer/boolean/date/datetime. Canonical native date formats separate from +08 field evidence. Invalid number/bool/date/datetime/null, text overlength52 skipped unchanged. Custom default NumberType min0/step1 makes12.75 lossy:47 Failed at reread, rollback confirms old2; compatible integer49 writes12 Done. Floating custom step metadata variant and exhaustive range/nullable combinations NOT RUN. |
| IB10 | PASS dropdown label->text native comment, text->dropdown native Manufacturer and Fields choice, dropdown->dropdown custom Manufacturer. Local IDs reread (native3/custom6/Fields2). Absent label50 and duplicate label51 visibly skipped, no option creation. Native Location has profile right0 and skipped unreadable; no false AppliedToB. Hierarchy/out-of-scope/all empty variants source-only/NOT RUN. |
| IB11 | PASS real Fields local writer preserves unrelated textarea and multiple JSON [1,2] while mapped scalars change. Current container denial54 skips unchanged. Missing/ambiguous storage and status-specific override variants source-only/NOT RUN. |
| IB12 | PASS actual custom definition2/asset2 generic core and virtual text, number, bool, date, datetime, dropdown; raw JSON siblings remain intact. Compatible integer49 is actual success, not inferred from definitions. Hidden/readonly/multiple/richtext negative variants source-only/prior outbound admission evidence, not rerun. |
| IB13 | PASS no worker echo: final Change count14, only new row14 is the immediate genuine service edit after prior sync; native/Fields/custom worker writes create none. Guard reset after definite numeric rollback implied by later successful writes with unchanged queue; no cooldown. |
| IB14 | PASS Suspend/Resume38/39 Held not installed; correction40 Held with no done IDs and referenced Change2 still Pending. B/Both55 held with unchanged contact values; verified Active links survive later Held work. |
| IB15 | PASS actual definite save/reread failure47 with confirmed rollback and partial outcomes. Commit/rollback/lock-release uncertainty injection NOT RUN: no safe approved fail hook, no code/DB damage to induce one. Those explicit Hold paths are source-review evidence only. |

Work43–45 were operator fixtures carrying stale settings_version1 after route became3; all correctly Held before writes. They are retained. Actual first valid conversion execution used new reconciled Work46–48 with version3; no same-ID replay or hidden overwrite. GLPI default custom number field7 has native options min0/step1; the12.75 failure is truthful compatibility failure, not a silent stored truncation. Later49 supplies compatible12.

Initial independent-ledger setup retained the two first IB requests from the prior persistent helper and closed that initial session as third request; reconstructed entries1–3 preserve their exact sanitized results. Remaining requests use separate IB helper. No curl call omitted. Native scoped invocations are manual operator actions, not a persisted test runner.

## Preserved fixtures and final state

Fresh assets: Computers149(primary),150/151(duplicate serial), Monitor2, custom type Glpi\CustomAsset\AgentBIB20261024Asset asset2, custom definition2/fields6–12. New Fields container7 agentbibx, scalar fields54–60 plus unmapped multiple61, storage PluginFieldsComputeragentbibx row1. New Manufacturer options3–6, Fields IB options and Location1. Only these new metadata/asset fixtures changed. No OC145–148 assets or old AssetSync records touched.

Setting10 inbound-b-20261024-main now disabled/version5, readback47. OC Setting6–9 remain untouched disabled. Old admission settings remain disabled. No Accepted Work remains. All old Work1–22 now Held, no asset/link writes. New Work23–57 are preserved with exact final results in request39. Change1 remains previously Done; Changes2–14 Pending. Change14 is genuine captured name edit with confirmed A922001/B149 identity and original +08 time. No new asset created by processor; final Computer rows above148 are exactly authorized149–151, no serial AGENTB-IB-NO-ASSET exists. Native task state returns1.

Fields final values: text IB fields written by worker, number12.5, yesno1, date2026-10-26, datetime2026-10-26 14:15:16, dropdown2; unrelated textarea IB unrelated scalar stays and multiple [1,2] retained. Custom final numeric12 with independent text/bool/date/datetime/dropdown/name and unmapped sibling preserved. User12 attributed native/Fields History. No first copy, B return, Both winner, Suspend/Resume execution, correction completion or full product flow claimed.

## Exact actual curl ledger

### 1 — IB restricted service login

Account service; GET http://localhost:8081/api.php/v1/initSession; HTTP 200.

Request:

```json
null
```

Response:

```json
{
  "session_token": "[REDACTED]"
}
```

### 2 — IB preprocessor admission Accepted inventory

Account service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork?searchText%5Bstatus%5D=%5EAccepted%24&range=0-99&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request:

```json
null
```

Response:

```json
[
  {
    "id": 1,
    "work_id": "inbound-a-20261024-accepted-default",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 910001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": null,
    "status": "Accepted",
    "result_json": null,
    "error": null,
    "date_creation": "2026-10-24 14:46:32",
    "date_mod": "2026-10-24 14:46:32",
    "completed_at": null
  },
  {
    "id": 2,
    "work_id": "inbound-a-20261024-accepted-array-scalars",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910002,\"b_items_id\":null,\"serial\":null}",
    "a_values_json": "{\"text\":\"Test\",\"integer\":4,\"decimal\":1.5,\"boolean\":false,\"empty\":null}",
    "a_change_times_json": "{}",
    "settings_version": 2,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 910002,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": null,
    "status": "Accepted",
    "result_json": null,
    "error": null,
    "date_creation": "2026-10-24 14:46:59",
    "date_mod": "2026-10-24 14:46:59",
    "completed_at": null
  },
  {
    "id": 3,
    "work_id": "inbound-a-20261024-accepted-time-null",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":null,\"reliable\":true}}",
    "settings_version": 2,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 910001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": null,
    "status": "Accepted",
    "result_json": null,
    "error": null,
    "date_creation": "2026-10-24 14:46:59",
    "date_mod": "2026-10-24 14:46:59",
    "completed_at": null
  },
  {
    "id": 4,
    "work_id": "inbound-a-20261024-accepted-time-unreliable",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T12:00:00+08:00\",\"reliable\":false}}",
    "settings_version": 2,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 910001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": null,
    "status": "Accepted",
    "result_json": null,
    "error": null,
    "date_creation": "2026-10-24 14:46:59",
    "date_mod": "2026-10-24 14:46:59",
    "completed_at": null
  },
  {
    "id": 5,
    "work_id": "inbound-a-20261024-accepted-time-missing",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{}",
    "settings_version": 2,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 910001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": null,
    "status": "Accepted",
    "result_json": null,
    "error": null,
    "date_creation": "2026-10-24 14:46:59",
    "date_mod": "2026-10-24 14:46:59",
    "completed_at": null
  },
  {
    "id": 6,
    "work_id": "inbound-a-20261024-accepted-sync",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "handled_change_ids_json": "[910101,910102]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 910001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": null,
    "status": "Accepted",
    "result_json": null,
    "error": null,
    "date_creation": "2026-10-24 14:46:59",
    "date_mod": "2026-10-24 14:46:59",
    "completed_at": null
  },
  {
    "id": 7,
    "work_id": "inbound-a-20261024-accepted-suspend",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 2,
    "handled_change_ids_json": "[]",
    "operation": "Suspend",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 910001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": null,
    "status": "Accepted",
    "result_json": null,
    "error": null,
    "date_creation": "2026-10-24 14:46:59",
    "date_mod": "2026-10-24 14:46:59",
    "completed_at": null
  },
  {
    "id": 8,
    "work_id": "inbound-a-20261024-accepted-resume",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 2,
    "handled_change_ids_json": "[]",
    "operation": "Resume",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 910001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": null,
    "status": "Accepted",
    "result_json": null,
    "error": null,
    "date_creation": "2026-10-24 14:47:12",
    "date_mod": "2026-10-24 14:47:12",
    "completed_at": null
  },
  {
    "id": 9,
    "work_id": "inbound-a-20261024-accepted-null-unreliable",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":null,\"reliable\":false}}",
    "settings_version": 2,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 910001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": null,
    "status": "Accepted",
    "result_json": null,
    "error": null,
    "date_creation": "2026-10-24 14:48:20",
    "date_mod": "2026-10-24 14:48:20",
    "completed_at": null
  },
  {
    "id": 10,
    "work_id": "inbound-a-20261024-accepted-identity-link",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910003,\"b_items_id\":910203,\"serial\":null}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 910003,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": null,
    "status": "Accepted",
    "result_json": null,
    "error": null,
    "date_creation": "2026-10-24 14:48:20",
    "date_mod": "2026-10-24 14:48:20",
    "completed_at": null
  },
  {
    "id": 11,
    "work_id": "inbound-a-20261024-accepted-unknown-route",
    "route_id": "inbound-a-20261024-no-route",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 910001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": null,
    "status": "Accepted",
    "result_json": null,
    "error": null,
    "date_creation": "2026-10-24 14:48:20",
    "date_mod": "2026-10-24 14:48:20",
    "completed_at": null
  },
  {
    "id": 12,
    "work_id": "inbound-a-20261024-accepted-unknown-type",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "ImaginaryAssetType",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 910001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": null,
    "status": "Accepted",
    "result_json": null,
    "error": null,
    "date_creation": "2026-10-24 14:48:20",
    "date_mod": "2026-10-24 14:48:20",
    "completed_at": null
  },
  {
    "id": 13,
    "work_id": "inbound-a-20261024-accepted-disabled-type",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Printer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 910001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": null,
    "status": "Accepted",
    "result_json": null,
    "error": null,
    "date_creation": "2026-10-24 14:48:20",
    "date_mod": "2026-10-24 14:48:20",
    "completed_at": null
  },
  {
    "id": 14,
    "work_id": "inbound-a-20261024-accepted-disabled-route",
    "route_id": "foundation-20261024-array",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 910001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": null,
    "status": "Accepted",
    "result_json": null,
    "error": null,
    "date_creation": "2026-10-24 14:48:20",
    "date_mod": "2026-10-24 14:48:20",
    "completed_at": null
  },
  {
    "id": 15,
    "work_id": "inbound-a-20261024-accepted-old-version",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 910001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": null,
    "status": "Accepted",
    "result_json": null,
    "error": null,
    "date_creation": "2026-10-24 14:48:20",
    "date_mod": "2026-10-24 14:48:20",
    "completed_at": null
  },
  {
    "id": 16,
    "work_id": "inbound-a-20261024-CaseDistinct",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 910001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": null,
    "status": "Accepted",
    "result_json": null,
    "error": null,
    "date_creation": "2026-10-24 14:48:20",
    "date_mod": "2026-10-24 14:48:20",
    "completed_at": null
  },
  {
    "id": 17,
    "work_id": "inbound-a-20261024-casedistinct",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 910001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": null,
    "status": "Accepted",
    "result_json": null,
    "error": null,
    "date_creation": "2026-10-24 14:48:20",
    "date_mod": "2026-10-24 14:48:20",
    "completed_at": null
  },
  {
    "id": 18,
    "work_id": "inbound-a-20261024-valid-bulk-1",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 910001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": null,
    "status": "Accepted",
    "result_json": null,
    "error": null,
    "date_creation": "2026-10-24 14:48:20",
    "date_mod": "2026-10-24 14:48:20",
    "completed_at": null
  },
  {
    "id": 19,
    "work_id": "inbound-a-20261024-valid-bulk-2",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 2,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 910001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": null,
    "status": "Accepted",
    "result_json": null,
    "error": null,
    "date_creation": "2026-10-24 14:48:20",
    "date_mod": "2026-10-24 14:48:20",
    "completed_at": null
  },
  {
    "id": 20,
    "work_id": "inbound-a-20261024-mixed-valid",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 910001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": null,
    "status": "Accepted",
    "result_json": null,
    "error": null,
    "date_creation": "2026-10-24 14:48:20",
    "date_mod": "2026-10-24 14:48:20",
    "completed_at": null
  },
  {
    "id": 22,
    "work_id": "inbound-a-20261024-concurrent",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 910001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": null,
    "status": "Accepted",
    "result_json": null,
    "error": null,
    "date_creation": "2026-10-24 14:48:52",
    "date_mod": "2026-10-24 14:48:52",
    "completed_at": null
  }
]
```

### 3 — IB close initial session before independent part ledger

Account service; GET http://localhost:8081/api.php/v1/killSession; HTTP 200.

Request:

```json
null
```

Response:

```json
true
```

### 4 — IB independent restricted session login

Account service; GET http://localhost:8081/api.php/v1/initSession; HTTP 200.

Request:

```json
null
```

Response:

```json
{
  "session_token": "[REDACTED]"
}
```

### 5 — create fresh IB primary existing Computer

Account service; POST http://localhost:8081/api.php/v1/Computer; HTTP 201.

Request:

```json
{
  "input": {
    "name": "AgentB IB primary before",
    "serial": "AGENTB-IB-PRIMARY",
    "entities_id": 0
  }
}
```

Response:

```json
{
  "id": 149,
  "message": "Item successfully added: AgentB IB primary before"
}
```

### 6 — create fresh IB duplicate serial fixture one

Account service; POST http://localhost:8081/api.php/v1/Computer; HTTP 201.

Request:

```json
{
  "input": {
    "name": "AgentB IB duplicate one",
    "serial": "AGENTB-IB-DUP",
    "entities_id": 0
  }
}
```

Response:

```json
{
  "id": 150,
  "message": "Item successfully added: AgentB IB duplicate one"
}
```

### 7 — create fresh IB duplicate serial fixture two

Account service; POST http://localhost:8081/api.php/v1/Computer; HTTP 201.

Request:

```json
{
  "input": {
    "name": "AgentB IB duplicate two",
    "serial": "AGENTB-IB-DUP",
    "entities_id": 0
  }
}
```

Response:

```json
{
  "id": 151,
  "message": "Item successfully added: AgentB IB duplicate two"
}
```

### 8 — create fresh IB main A-owned name route

Account service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting; HTTP 201.

Request:

```json
{
  "input": {
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "route_enabled": 1,
    "settings_version": 1,
    "enabled_itemtypes_json": "[\"Computer\"]",
    "field_mappings_json": "[{\"mapping_id\":\"ib_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
  }
}
```

Response:

```json
{
  "id": 10,
  "message": ""
}
```

### 9 — IB01 accept existing serial name write

Account service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork; HTTP 201.

Request:

```json
{
  "input": {
    "work_id": "inbound-b-20261024-existing-name",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1
  }
}
```

Response:

```json
{
  "id": 23,
  "message": ""
}
```

### 10 — IB01 Accepted proves no immediate write

Account service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork/23?get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request:

```json
null
```

Response:

```json
{
  "id": 23,
  "work_id": "inbound-b-20261024-existing-name",
  "route_id": "inbound-b-20261024-main",
  "a_entities_id": 9200,
  "entities_id": 0,
  "itemtype": "Computer",
  "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
  "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
  "a_change_times_json": "{}",
  "settings_version": 1,
  "handled_change_ids_json": "[]",
  "operation": "Sync",
  "submitted_users_id": 12,
  "submitted_profiles_id": 14,
  "a_items_id": 922001,
  "b_items_id": null,
  "link_state": null,
  "processing_started_at": null,
  "status": "Accepted",
  "result_json": null,
  "error": null,
  "date_creation": "2026-10-24 15:26:22",
  "date_mod": "2026-10-24 15:26:22",
  "completed_at": null
}
```

### 11 — IB01 asset unchanged before background task

Account service; GET http://localhost:8081/api.php/v1/Computer/149?get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request:

```json
null
```

Response:

```json
{
  "id": 149,
  "entities_id": 0,
  "name": "AgentB IB primary before",
  "serial": "AGENTB-IB-PRIMARY",
  "otherserial": null,
  "contact": null,
  "contact_num": null,
  "users_id_tech": 0,
  "comment": null,
  "date_mod": "2026-10-24 15:26:22",
  "autoupdatesystems_id": 0,
  "locations_id": 0,
  "networks_id": 0,
  "computermodels_id": 0,
  "computertypes_id": 0,
  "is_template": 0,
  "template_name": null,
  "manufacturers_id": 0,
  "is_deleted": 0,
  "is_dynamic": 0,
  "users_id": 0,
  "states_id": 0,
  "ticket_tco": "0.0000",
  "uuid": null,
  "date_creation": "2026-10-24 15:26:22",
  "is_recursive": 0,
  "last_inventory_update": null,
  "last_boot": null,
  "groups_id": [],
  "groups_id_tech": []
}
```

### 12 — IB01 completed result readback

Account service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork/23?get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request:

```json
null
```

Response:

```json
{
  "id": 23,
  "work_id": "inbound-b-20261024-existing-name",
  "route_id": "inbound-b-20261024-main",
  "a_entities_id": 9200,
  "entities_id": 0,
  "itemtype": "Computer",
  "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
  "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
  "a_change_times_json": "{}",
  "settings_version": 1,
  "handled_change_ids_json": "[]",
  "operation": "Sync",
  "submitted_users_id": 12,
  "submitted_profiles_id": 14,
  "a_items_id": 922001,
  "b_items_id": 149,
  "link_state": "Active",
  "processing_started_at": "2026-10-24 15:26:22",
  "status": "Done",
  "result_json": "{\"b_items_id\":149,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_name\",\"outcome\":\"AppliedToB\",\"reason\":null}]}",
  "error": null,
  "date_creation": "2026-10-24 15:26:22",
  "date_mod": "2026-10-24 15:26:22",
  "completed_at": "2026-10-24 15:26:22"
}
```

### 13 — IB01 asset confirmed saved value

Account service; GET http://localhost:8081/api.php/v1/Computer/149?get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request:

```json
null
```

Response:

```json
{
  "id": 149,
  "entities_id": 0,
  "name": "AgentB IB applied by worker",
  "serial": "AGENTB-IB-PRIMARY",
  "otherserial": null,
  "contact": null,
  "contact_num": null,
  "users_id_tech": 0,
  "comment": null,
  "date_mod": "2026-10-24 15:26:22",
  "autoupdatesystems_id": 0,
  "locations_id": 0,
  "networks_id": 0,
  "computermodels_id": 0,
  "computertypes_id": 0,
  "is_template": 0,
  "template_name": null,
  "manufacturers_id": 0,
  "is_deleted": 0,
  "is_dynamic": 0,
  "users_id": 0,
  "states_id": 0,
  "ticket_tco": "0.0000",
  "uuid": null,
  "date_creation": "2026-10-24 15:26:22",
  "is_recursive": 0,
  "last_inventory_update": null,
  "last_boot": null,
  "groups_id": [],
  "groups_id_tech": []
}
```

### 14 — IB02 already equal fresh Work

Account service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork; HTTP 201.

Request:

```json
{
  "input": {
    "work_id": "inbound-b-20261024-already-equal",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1
  }
}
```

Response:

```json
{
  "id": 24,
  "message": ""
}
```

### 15 — IB13 immediate genuine name and serial edit after sync

Account service; PUT http://localhost:8081/api.php/v1/Computer/149; HTTP 200.

Request:

```json
{
  "input": {
    "id": 149,
    "name": "AgentB IB genuine immediate edit",
    "serial": "AGENTB-IB-RENAMED"
  }
}
```

Response:

```json
[
  {
    "149": true,
    "message": ""
  }
]
```

### 16 — IB03 IB04 IB05 IB14 bounded identity scope and stage batch

Account service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork; HTTP 201.

Request:

```json
{
  "input": [
    {
      "work_id": "inbound-b-20261024-retained-link-reuse",
      "route_id": "inbound-b-20261024-main",
      "a_entities_id": 9200,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
      "a_values_json": "{\"ib_name\":\"AgentB IB retained link write\"}",
      "a_change_times_json": "{}",
      "settings_version": 1
    },
    {
      "work_id": "inbound-b-20261024-claimed-mismatch",
      "route_id": "inbound-b-20261024-main",
      "a_entities_id": 9200,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":922001,\"b_items_id\":150,\"serial\":null}",
      "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
      "a_change_times_json": "{}",
      "settings_version": 1
    },
    {
      "work_id": "inbound-b-20261024-unverified-claim",
      "route_id": "inbound-b-20261024-main",
      "a_entities_id": 9200,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":922099,\"b_items_id\":149,\"serial\":null}",
      "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
      "a_change_times_json": "{}",
      "settings_version": 1
    },
    {
      "work_id": "inbound-b-20261024-duplicate-serial",
      "route_id": "inbound-b-20261024-main",
      "a_entities_id": 9200,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":922010,\"b_items_id\":null,\"serial\":\"AGENTB-IB-DUP\"}",
      "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
      "a_change_times_json": "{}",
      "settings_version": 1
    },
    {
      "work_id": "inbound-b-20261024-missing-serial",
      "route_id": "inbound-b-20261024-main",
      "a_entities_id": 9200,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":922011,\"b_items_id\":null,\"serial\":null}",
      "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
      "a_change_times_json": "{}",
      "settings_version": 1
    },
    {
      "work_id": "inbound-b-20261024-zero-match",
      "route_id": "inbound-b-20261024-main",
      "a_entities_id": 9200,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":922012,\"b_items_id\":null,\"serial\":\"AGENTB-IB-NO-ASSET\"}",
      "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
      "a_change_times_json": "{}",
      "settings_version": 1
    },
    {
      "work_id": "inbound-b-20261024-case-mismatch",
      "route_id": "inbound-b-20261024-main",
      "a_entities_id": 9200,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":922013,\"b_items_id\":null,\"serial\":\"agentb-ib-renamed\"}",
      "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
      "a_change_times_json": "{}",
      "settings_version": 1
    },
    {
      "work_id": "inbound-b-20261024-space-mismatch",
      "route_id": "inbound-b-20261024-main",
      "a_entities_id": 9200,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":922014,\"b_items_id\":null,\"serial\":\"AGENTB-IB-RENAMED \"}",
      "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
      "a_change_times_json": "{}",
      "settings_version": 1
    },
    {
      "work_id": "inbound-b-20261024-competing-a-owner",
      "route_id": "inbound-b-20261024-main",
      "a_entities_id": 9200,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":922015,\"b_items_id\":null,\"serial\":\"AGENTB-IB-RENAMED\"}",
      "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
      "a_change_times_json": "{}",
      "settings_version": 1
    },
    {
      "work_id": "inbound-b-20261024-wrong-a-entity",
      "route_id": "inbound-b-20261024-main",
      "a_entities_id": 9201,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
      "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
      "a_change_times_json": "{}",
      "settings_version": 1
    },
    {
      "work_id": "inbound-b-20261024-missing-route",
      "route_id": "inbound-b-20261024-missing",
      "a_entities_id": 9200,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
      "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
      "a_change_times_json": "{}",
      "settings_version": 1
    },
    {
      "work_id": "inbound-b-20261024-disabled-type",
      "route_id": "inbound-b-20261024-main",
      "a_entities_id": 9200,
      "entities_id": 0,
      "itemtype": "Monitor",
      "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
      "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
      "a_change_times_json": "{}",
      "settings_version": 1
    },
    {
      "work_id": "inbound-b-20261024-wrong-version",
      "route_id": "inbound-b-20261024-main",
      "a_entities_id": 9200,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
      "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
      "a_change_times_json": "{}",
      "settings_version": 2
    },
    {
      "work_id": "inbound-b-20261024-suspend-stage",
      "route_id": "inbound-b-20261024-main",
      "a_entities_id": 9200,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
      "a_values_json": "{}",
      "a_change_times_json": "{}",
      "settings_version": 1,
      "operation": "Suspend"
    },
    {
      "work_id": "inbound-b-20261024-resume-stage",
      "route_id": "inbound-b-20261024-main",
      "a_entities_id": 9200,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
      "a_values_json": "{}",
      "a_change_times_json": "{}",
      "settings_version": 1,
      "operation": "Resume"
    },
    {
      "work_id": "inbound-b-20261024-correction-stage",
      "route_id": "inbound-b-20261024-main",
      "a_entities_id": 9200,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
      "a_values_json": "{}",
      "a_change_times_json": "{}",
      "settings_version": 1,
      "handled_change_ids_json": "[2]"
    }
  ]
}
```

Response:

```json
[
  {
    "id": 25,
    "message": ""
  },
  {
    "id": 26,
    "message": ""
  },
  {
    "id": 27,
    "message": ""
  },
  {
    "id": 28,
    "message": ""
  },
  {
    "id": 29,
    "message": ""
  },
  {
    "id": 30,
    "message": ""
  },
  {
    "id": 31,
    "message": ""
  },
  {
    "id": 32,
    "message": ""
  },
  {
    "id": 33,
    "message": ""
  },
  {
    "id": 34,
    "message": ""
  },
  {
    "id": 35,
    "message": ""
  },
  {
    "id": 36,
    "message": ""
  },
  {
    "id": 37,
    "message": ""
  },
  {
    "id": 38,
    "message": ""
  },
  {
    "id": 39,
    "message": ""
  },
  {
    "id": 40,
    "message": ""
  }
]
```

### 17 — IB identity scope stage exact result readback

Account service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork?searchText%5Bwork_id%5D=%5Einbound-b-20261024-&range=0-99&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request:

```json
null
```

Response:

```json
[
  {
    "id": 23,
    "work_id": "inbound-b-20261024-existing-name",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": 149,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:26:22",
    "status": "Done",
    "result_json": "{\"b_items_id\":149,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_name\",\"outcome\":\"AppliedToB\",\"reason\":null}]}",
    "error": null,
    "date_creation": "2026-10-24 15:26:22",
    "date_mod": "2026-10-24 15:26:22",
    "completed_at": "2026-10-24 15:26:22"
  },
  {
    "id": 24,
    "work_id": "inbound-b-20261024-already-equal",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": 149,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Done",
    "result_json": "{\"b_items_id\":149,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_name\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}",
    "error": null,
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": "2026-10-24 15:27:27"
  },
  {
    "id": 25,
    "work_id": "inbound-b-20261024-retained-link-reuse",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB retained link write\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": 149,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Done",
    "result_json": "{\"b_items_id\":149,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_name\",\"outcome\":\"AppliedToB\",\"reason\":null}]}",
    "error": null,
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": "2026-10-24 15:27:27"
  },
  {
    "id": 26,
    "work_id": "inbound-b-20261024-claimed-mismatch",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":150,\"serial\":null}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Claimed B ID differs from retained verified link",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 27,
    "work_id": "inbound-b-20261024-unverified-claim",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922099,\"b_items_id\":149,\"serial\":null}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922099,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Claimed B ID has no retained verified link evidence",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 28,
    "work_id": "inbound-b-20261024-duplicate-serial",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922010,\"b_items_id\":null,\"serial\":\"AGENTB-IB-DUP\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922010,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Serial match is ambiguous in routed B entity",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 29,
    "work_id": "inbound-b-20261024-missing-serial",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922011,\"b_items_id\":null,\"serial\":null}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922011,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "No usable supported serial and no verified link",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 30,
    "work_id": "inbound-b-20261024-zero-match",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922012,\"b_items_id\":null,\"serial\":\"AGENTB-IB-NO-ASSET\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922012,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Complete serial lookup found no asset; first-copy processing is not installed yet",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 31,
    "work_id": "inbound-b-20261024-case-mismatch",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922013,\"b_items_id\":null,\"serial\":\"agentb-ib-renamed\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922013,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Complete serial lookup found no asset; first-copy processing is not installed yet",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 32,
    "work_id": "inbound-b-20261024-space-mismatch",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922014,\"b_items_id\":null,\"serial\":\"AGENTB-IB-RENAMED \"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922014,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Complete serial lookup found no asset; first-copy processing is not installed yet",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 33,
    "work_id": "inbound-b-20261024-competing-a-owner",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922015,\"b_items_id\":null,\"serial\":\"AGENTB-IB-RENAMED\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922015,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "B asset has competing retained source ownership",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 34,
    "work_id": "inbound-b-20261024-wrong-a-entity",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9201,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 35,
    "work_id": "inbound-b-20261024-missing-route",
    "route_id": "inbound-b-20261024-missing",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 36,
    "work_id": "inbound-b-20261024-disabled-type",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Monitor",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Disabled or unavailable asset type",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 37,
    "work_id": "inbound-b-20261024-wrong-version",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 2,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 38,
    "work_id": "inbound-b-20261024-suspend-stage",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Suspend",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Suspend/Resume processing is not installed yet",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 39,
    "work_id": "inbound-b-20261024-resume-stage",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Resume",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Suspend/Resume processing is not installed yet",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 40,
    "work_id": "inbound-b-20261024-correction-stage",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[2]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": 149,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":149,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_name\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"}]}",
    "error": "Correction snapshot processing is not installed yet; queue remains Pending",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  }
]
```

### 18 — IB06 admit before test profile Work CREATE revoked

Account service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork; HTTP 201.

Request:

```json
{
  "input": {
    "work_id": "inbound-b-20261024-permission-revoked",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"MUST NOT APPLY REVOKED\"}",
    "a_change_times_json": "{}",
    "settings_version": 1
  }
}
```

Response:

```json
{
  "id": 41,
  "message": ""
}
```

### 19 — IB05 admit before route version changes

Account service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork; HTTP 201.

Request:

```json
{
  "input": {
    "work_id": "inbound-b-20261024-settings-changed-after-accept",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1
  }
}
```

Response:

```json
{
  "id": 42,
  "message": ""
}
```

### 20 — IB05 bump only fresh route version before runner

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/10; HTTP 200.

Request:

```json
{
  "input": {
    "id": 10,
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "route_enabled": 1,
    "settings_version": 2,
    "enabled_itemtypes_json": "[\"Computer\"]",
    "field_mappings_json": "[{\"mapping_id\":\"ib_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
  }
}
```

Response:

```json
[
  {
    "10": true,
    "message": ""
  }
]
```

### 21 — IB close session before new custom right context

Account service; GET http://localhost:8081/api.php/v1/killSession; HTTP 200.

Request:

```json
null
```

Response:

```json
true
```

### 22 — IB new session with custom asset rights initialized

Account service; GET http://localhost:8081/api.php/v1/initSession; HTTP 200.

Request:

```json
null
```

Response:

```json
{
  "session_token": "[REDACTED]"
}
```

### 23 — create fresh IB custom asset existing before processing

Account service; POST http://localhost:8081/api.php/v1/Glpi%5CCustomAsset%5CAgentBIB20261024Asset; HTTP 201.

Request:

```json
{
  "input": {
    "name": "AgentB IB custom original",
    "serial": "AGENTB-IB-CUSTOM",
    "entities_id": 0,
    "custom_ib_text": "IB custom initial",
    "custom_ib_number": 2,
    "custom_ib_bool": false,
    "custom_ib_date": "2026-10-24",
    "custom_ib_datetime": "2026-10-24 10:00:00",
    "custom_ib_option": 3,
    "custom_ib_sibling": "IB sibling must stay"
  }
}
```

Response:

```json
{
  "id": 2,
  "message": "Item successfully added: AgentB IB custom original"
}
```

### 24 — create fresh IB second native Monitor

Account service; POST http://localhost:8081/api.php/v1/Monitor; HTTP 201.

Request:

```json
{
  "input": {
    "name": "AgentB IB monitor original",
    "serial": "AGENTB-IB-MONITOR",
    "entities_id": 0,
    "is_global": 0
  }
}
```

Response:

```json
{
  "id": 2,
  "message": "Item successfully added: AgentB IB monitor original"
}
```

### 25 — IB09 IB10 IB11 IB12 admit actual native Fields custom scalar mappings

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/10; HTTP 200.

Request:

```json
{
  "input": {
    "id": 10,
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "route_enabled": 1,
    "settings_version": 3,
    "enabled_itemtypes_json": "[\"Computer\",\"Monitor\",\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\"]",
    "field_mappings_json": "[{\"mapping_id\":\"ib_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_label_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"comment\"},\"source\":\"A\",\"value_mode\":\"dropdown_label_to_text\"},{\"mapping_id\":\"ib_text_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"manufacturers_id\"},\"source\":\"A\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"ib_dropdown_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"locations_id\"},\"source\":\"A\",\"value_mode\":\"dropdown_label_to_dropdown\"},{\"mapping_id\":\"ib_disabled\",\"itemtype\":\"Computer\",\"enabled\":false,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"otherserial\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_monitor_name\",\"itemtype\":\"Monitor\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_monitor_bool\",\"itemtype\":\"Monitor\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"is_global\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibtextfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_textarea\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibtextareafield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_number\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibnumberfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_yesno\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibyesnofield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_date\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibdatefield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_datetime\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibdatetimefield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_dropdown\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibdropdownfield\"},\"source\":\"A\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"ib_custom_text\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ib_text\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_custom_number\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ib_number\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_custom_bool\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ib_bool\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_custom_date\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ib_date\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_custom_datetime\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ib_datetime\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_custom_option\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ib_option\"},\"source\":\"A\",\"value_mode\":\"dropdown_label_to_dropdown\"},{\"mapping_id\":\"ib_custom_name\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
  }
}
```

Response:

```json
[
  {
    "10": true,
    "message": ""
  }
]
```

### 26 — IB generic native Fields custom and second-type work batch

Account service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork; HTTP 201.

Request:

```json
{
  "input": [
    {
      "work_id": "inbound-b-20261024-generic-native-fields",
      "route_id": "inbound-b-20261024-main",
      "a_entities_id": 9200,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
      "a_values_json": "{\"ib_name\":\"AgentB IB generic native result\",\"ib_label_text\":\"AgentB IB readable source label\",\"ib_text_option\":\"AgentB IB Maker\",\"ib_dropdown_option\":\"AgentB IB Location\",\"ib_disabled\":\"MUST NOT APPLY DISABLED\",\"unmapped_scalar\":\"MUST NOT APPLY UNMAPPED\",\"ib_fields_text\":\"IB fields written by worker\",\"ib_fields_number\":12.5,\"ib_fields_yesno\":true,\"ib_fields_date\":\"2026-10-26\",\"ib_fields_datetime\":\"2026-10-26 14:15:16\",\"ib_fields_dropdown\":\"AgentB IB Choice Two\"}",
      "a_change_times_json": "{}",
      "settings_version": 1
    },
    {
      "work_id": "inbound-b-20261024-generic-custom",
      "route_id": "inbound-b-20261024-main",
      "a_entities_id": 9200,
      "entities_id": 0,
      "itemtype": "Glpi\\CustomAsset\\AgentBIB20261024Asset",
      "identity_json": "{\"a_items_id\":922101,\"b_items_id\":null,\"serial\":\"AGENTB-IB-CUSTOM\"}",
      "a_values_json": "{\"ib_custom_name\":\"AgentB IB custom processed\",\"ib_custom_text\":\"IB custom worker text\",\"ib_custom_number\":12.75,\"ib_custom_bool\":true,\"ib_custom_date\":\"2026-10-26\",\"ib_custom_datetime\":\"2026-10-26 14:15:16\",\"ib_custom_option\":\"AgentB IB Maker Two\"}",
      "a_change_times_json": "{}",
      "settings_version": 1
    },
    {
      "work_id": "inbound-b-20261024-generic-monitor",
      "route_id": "inbound-b-20261024-main",
      "a_entities_id": 9200,
      "entities_id": 0,
      "itemtype": "Monitor",
      "identity_json": "{\"a_items_id\":922201,\"b_items_id\":null,\"serial\":\"AGENTB-IB-MONITOR\"}",
      "a_values_json": "{\"ib_monitor_name\":\"AgentB IB monitor worker result\",\"ib_monitor_bool\":true}",
      "a_change_times_json": "{}",
      "settings_version": 1
    }
  ]
}
```

Response:

```json
[
  {
    "id": 43,
    "message": ""
  },
  {
    "id": 44,
    "message": ""
  },
  {
    "id": 45,
    "message": ""
  }
]
```

### 27 — IB generic writer Work outcomes readback

Account service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork?searchText%5Bwork_id%5D=%5Einbound-b-20261024-&range=0-99&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request:

```json
null
```

Response:

```json
[
  {
    "id": 23,
    "work_id": "inbound-b-20261024-existing-name",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": 149,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:26:22",
    "status": "Done",
    "result_json": "{\"b_items_id\":149,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_name\",\"outcome\":\"AppliedToB\",\"reason\":null}]}",
    "error": null,
    "date_creation": "2026-10-24 15:26:22",
    "date_mod": "2026-10-24 15:26:22",
    "completed_at": "2026-10-24 15:26:22"
  },
  {
    "id": 24,
    "work_id": "inbound-b-20261024-already-equal",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": 149,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Done",
    "result_json": "{\"b_items_id\":149,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_name\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}",
    "error": null,
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": "2026-10-24 15:27:27"
  },
  {
    "id": 25,
    "work_id": "inbound-b-20261024-retained-link-reuse",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB retained link write\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": 149,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Done",
    "result_json": "{\"b_items_id\":149,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_name\",\"outcome\":\"AppliedToB\",\"reason\":null}]}",
    "error": null,
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": "2026-10-24 15:27:27"
  },
  {
    "id": 26,
    "work_id": "inbound-b-20261024-claimed-mismatch",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":150,\"serial\":null}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Claimed B ID differs from retained verified link",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 27,
    "work_id": "inbound-b-20261024-unverified-claim",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922099,\"b_items_id\":149,\"serial\":null}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922099,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Claimed B ID has no retained verified link evidence",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 28,
    "work_id": "inbound-b-20261024-duplicate-serial",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922010,\"b_items_id\":null,\"serial\":\"AGENTB-IB-DUP\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922010,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Serial match is ambiguous in routed B entity",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 29,
    "work_id": "inbound-b-20261024-missing-serial",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922011,\"b_items_id\":null,\"serial\":null}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922011,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "No usable supported serial and no verified link",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 30,
    "work_id": "inbound-b-20261024-zero-match",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922012,\"b_items_id\":null,\"serial\":\"AGENTB-IB-NO-ASSET\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922012,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Complete serial lookup found no asset; first-copy processing is not installed yet",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 31,
    "work_id": "inbound-b-20261024-case-mismatch",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922013,\"b_items_id\":null,\"serial\":\"agentb-ib-renamed\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922013,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Complete serial lookup found no asset; first-copy processing is not installed yet",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 32,
    "work_id": "inbound-b-20261024-space-mismatch",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922014,\"b_items_id\":null,\"serial\":\"AGENTB-IB-RENAMED \"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922014,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Complete serial lookup found no asset; first-copy processing is not installed yet",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 33,
    "work_id": "inbound-b-20261024-competing-a-owner",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922015,\"b_items_id\":null,\"serial\":\"AGENTB-IB-RENAMED\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922015,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "B asset has competing retained source ownership",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 34,
    "work_id": "inbound-b-20261024-wrong-a-entity",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9201,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 35,
    "work_id": "inbound-b-20261024-missing-route",
    "route_id": "inbound-b-20261024-missing",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 36,
    "work_id": "inbound-b-20261024-disabled-type",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Monitor",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Disabled or unavailable asset type",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 37,
    "work_id": "inbound-b-20261024-wrong-version",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 2,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 38,
    "work_id": "inbound-b-20261024-suspend-stage",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Suspend",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Suspend/Resume processing is not installed yet",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 39,
    "work_id": "inbound-b-20261024-resume-stage",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Resume",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Suspend/Resume processing is not installed yet",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 40,
    "work_id": "inbound-b-20261024-correction-stage",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[2]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": 149,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":149,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_name\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"}]}",
    "error": "Correction snapshot processing is not installed yet; queue remains Pending",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 41,
    "work_id": "inbound-b-20261024-permission-revoked",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"MUST NOT APPLY REVOKED\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:28:25",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Hold: Submitting profile lacks current Work authorization",
    "date_creation": "2026-10-24 15:28:24",
    "date_mod": "2026-10-24 15:28:25",
    "completed_at": null
  },
  {
    "id": 42,
    "work_id": "inbound-b-20261024-settings-changed-after-accept",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:28:25",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 15:28:25",
    "date_mod": "2026-10-24 15:28:25",
    "completed_at": null
  },
  {
    "id": 43,
    "work_id": "inbound-b-20261024-generic-native-fields",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB generic native result\",\"ib_label_text\":\"AgentB IB readable source label\",\"ib_text_option\":\"AgentB IB Maker\",\"ib_dropdown_option\":\"AgentB IB Location\",\"ib_disabled\":\"MUST NOT APPLY DISABLED\",\"unmapped_scalar\":\"MUST NOT APPLY UNMAPPED\",\"ib_fields_text\":\"IB fields written by worker\",\"ib_fields_number\":12.5,\"ib_fields_yesno\":true,\"ib_fields_date\":\"2026-10-26\",\"ib_fields_datetime\":\"2026-10-26 14:15:16\",\"ib_fields_dropdown\":\"AgentB IB Choice Two\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:30:26",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 15:30:25",
    "date_mod": "2026-10-24 15:30:26",
    "completed_at": null
  },
  {
    "id": 44,
    "work_id": "inbound-b-20261024-generic-custom",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBIB20261024Asset",
    "identity_json": "{\"a_items_id\":922101,\"b_items_id\":null,\"serial\":\"AGENTB-IB-CUSTOM\"}",
    "a_values_json": "{\"ib_custom_name\":\"AgentB IB custom processed\",\"ib_custom_text\":\"IB custom worker text\",\"ib_custom_number\":12.75,\"ib_custom_bool\":true,\"ib_custom_date\":\"2026-10-26\",\"ib_custom_datetime\":\"2026-10-26 14:15:16\",\"ib_custom_option\":\"AgentB IB Maker Two\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922101,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:30:26",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 15:30:25",
    "date_mod": "2026-10-24 15:30:26",
    "completed_at": null
  },
  {
    "id": 45,
    "work_id": "inbound-b-20261024-generic-monitor",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Monitor",
    "identity_json": "{\"a_items_id\":922201,\"b_items_id\":null,\"serial\":\"AGENTB-IB-MONITOR\"}",
    "a_values_json": "{\"ib_monitor_name\":\"AgentB IB monitor worker result\",\"ib_monitor_bool\":true}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922201,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:30:26",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 15:30:25",
    "date_mod": "2026-10-24 15:30:26",
    "completed_at": null
  }
]
```

### 28 — Correct operator generic fixtures to actual settings_version3 with new Work IDs

Account service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork; HTTP 201.

Request:

```json
{
  "input": [
    {
      "work_id": "inbound-b-20261024-generic-native-fields-version3",
      "route_id": "inbound-b-20261024-main",
      "a_entities_id": 9200,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
      "a_values_json": "{\"ib_name\":\"AgentB IB generic native result\",\"ib_label_text\":\"AgentB IB readable source label\",\"ib_text_option\":\"AgentB IB Maker\",\"ib_dropdown_option\":\"AgentB IB Location\",\"ib_disabled\":\"MUST NOT APPLY DISABLED\",\"unmapped_scalar\":\"MUST NOT APPLY UNMAPPED\",\"ib_fields_text\":\"IB fields written by worker\",\"ib_fields_number\":12.5,\"ib_fields_yesno\":true,\"ib_fields_date\":\"2026-10-26\",\"ib_fields_datetime\":\"2026-10-26 14:15:16\",\"ib_fields_dropdown\":\"AgentB IB Choice Two\"}",
      "a_change_times_json": "{}",
      "settings_version": 3
    },
    {
      "work_id": "inbound-b-20261024-generic-custom-version3",
      "route_id": "inbound-b-20261024-main",
      "a_entities_id": 9200,
      "entities_id": 0,
      "itemtype": "Glpi\\CustomAsset\\AgentBIB20261024Asset",
      "identity_json": "{\"a_items_id\":922101,\"b_items_id\":null,\"serial\":\"AGENTB-IB-CUSTOM\"}",
      "a_values_json": "{\"ib_custom_name\":\"AgentB IB custom processed\",\"ib_custom_text\":\"IB custom worker text\",\"ib_custom_number\":12.75,\"ib_custom_bool\":true,\"ib_custom_date\":\"2026-10-26\",\"ib_custom_datetime\":\"2026-10-26 14:15:16\",\"ib_custom_option\":\"AgentB IB Maker Two\"}",
      "a_change_times_json": "{}",
      "settings_version": 3
    },
    {
      "work_id": "inbound-b-20261024-generic-monitor-version3",
      "route_id": "inbound-b-20261024-main",
      "a_entities_id": 9200,
      "entities_id": 0,
      "itemtype": "Monitor",
      "identity_json": "{\"a_items_id\":922201,\"b_items_id\":null,\"serial\":\"AGENTB-IB-MONITOR\"}",
      "a_values_json": "{\"ib_monitor_name\":\"AgentB IB monitor worker result\",\"ib_monitor_bool\":true}",
      "a_change_times_json": "{}",
      "settings_version": 3
    }
  ]
}
```

Response:

```json
[
  {
    "id": 46,
    "message": ""
  },
  {
    "id": 47,
    "message": ""
  },
  {
    "id": 48,
    "message": ""
  }
]
```

### 29 — Correctly versioned generic conversion outcomes

Account service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork?range=23-99&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false; HTTP 206.

Request:

```json
null
```

Response:

```json
[
  {
    "id": 25,
    "work_id": "inbound-b-20261024-retained-link-reuse",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB retained link write\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": 149,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Done",
    "result_json": "{\"b_items_id\":149,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_name\",\"outcome\":\"AppliedToB\",\"reason\":null}]}",
    "error": null,
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": "2026-10-24 15:27:27"
  },
  {
    "id": 26,
    "work_id": "inbound-b-20261024-claimed-mismatch",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":150,\"serial\":null}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Claimed B ID differs from retained verified link",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 27,
    "work_id": "inbound-b-20261024-unverified-claim",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922099,\"b_items_id\":149,\"serial\":null}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922099,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Claimed B ID has no retained verified link evidence",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 28,
    "work_id": "inbound-b-20261024-duplicate-serial",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922010,\"b_items_id\":null,\"serial\":\"AGENTB-IB-DUP\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922010,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Serial match is ambiguous in routed B entity",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 29,
    "work_id": "inbound-b-20261024-missing-serial",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922011,\"b_items_id\":null,\"serial\":null}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922011,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "No usable supported serial and no verified link",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 30,
    "work_id": "inbound-b-20261024-zero-match",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922012,\"b_items_id\":null,\"serial\":\"AGENTB-IB-NO-ASSET\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922012,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Complete serial lookup found no asset; first-copy processing is not installed yet",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 31,
    "work_id": "inbound-b-20261024-case-mismatch",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922013,\"b_items_id\":null,\"serial\":\"agentb-ib-renamed\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922013,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Complete serial lookup found no asset; first-copy processing is not installed yet",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 32,
    "work_id": "inbound-b-20261024-space-mismatch",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922014,\"b_items_id\":null,\"serial\":\"AGENTB-IB-RENAMED \"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922014,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Complete serial lookup found no asset; first-copy processing is not installed yet",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 33,
    "work_id": "inbound-b-20261024-competing-a-owner",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922015,\"b_items_id\":null,\"serial\":\"AGENTB-IB-RENAMED\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922015,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "B asset has competing retained source ownership",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 34,
    "work_id": "inbound-b-20261024-wrong-a-entity",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9201,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 35,
    "work_id": "inbound-b-20261024-missing-route",
    "route_id": "inbound-b-20261024-missing",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 36,
    "work_id": "inbound-b-20261024-disabled-type",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Monitor",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Disabled or unavailable asset type",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 37,
    "work_id": "inbound-b-20261024-wrong-version",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 2,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 38,
    "work_id": "inbound-b-20261024-suspend-stage",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Suspend",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Suspend/Resume processing is not installed yet",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 39,
    "work_id": "inbound-b-20261024-resume-stage",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Resume",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Suspend/Resume processing is not installed yet",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 40,
    "work_id": "inbound-b-20261024-correction-stage",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[2]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": 149,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":149,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_name\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"}]}",
    "error": "Correction snapshot processing is not installed yet; queue remains Pending",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 41,
    "work_id": "inbound-b-20261024-permission-revoked",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"MUST NOT APPLY REVOKED\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:28:25",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Hold: Submitting profile lacks current Work authorization",
    "date_creation": "2026-10-24 15:28:24",
    "date_mod": "2026-10-24 15:28:25",
    "completed_at": null
  },
  {
    "id": 42,
    "work_id": "inbound-b-20261024-settings-changed-after-accept",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:28:25",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 15:28:25",
    "date_mod": "2026-10-24 15:28:25",
    "completed_at": null
  },
  {
    "id": 43,
    "work_id": "inbound-b-20261024-generic-native-fields",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB generic native result\",\"ib_label_text\":\"AgentB IB readable source label\",\"ib_text_option\":\"AgentB IB Maker\",\"ib_dropdown_option\":\"AgentB IB Location\",\"ib_disabled\":\"MUST NOT APPLY DISABLED\",\"unmapped_scalar\":\"MUST NOT APPLY UNMAPPED\",\"ib_fields_text\":\"IB fields written by worker\",\"ib_fields_number\":12.5,\"ib_fields_yesno\":true,\"ib_fields_date\":\"2026-10-26\",\"ib_fields_datetime\":\"2026-10-26 14:15:16\",\"ib_fields_dropdown\":\"AgentB IB Choice Two\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:30:26",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 15:30:25",
    "date_mod": "2026-10-24 15:30:26",
    "completed_at": null
  },
  {
    "id": 44,
    "work_id": "inbound-b-20261024-generic-custom",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBIB20261024Asset",
    "identity_json": "{\"a_items_id\":922101,\"b_items_id\":null,\"serial\":\"AGENTB-IB-CUSTOM\"}",
    "a_values_json": "{\"ib_custom_name\":\"AgentB IB custom processed\",\"ib_custom_text\":\"IB custom worker text\",\"ib_custom_number\":12.75,\"ib_custom_bool\":true,\"ib_custom_date\":\"2026-10-26\",\"ib_custom_datetime\":\"2026-10-26 14:15:16\",\"ib_custom_option\":\"AgentB IB Maker Two\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922101,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:30:26",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 15:30:25",
    "date_mod": "2026-10-24 15:30:26",
    "completed_at": null
  },
  {
    "id": 45,
    "work_id": "inbound-b-20261024-generic-monitor",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Monitor",
    "identity_json": "{\"a_items_id\":922201,\"b_items_id\":null,\"serial\":\"AGENTB-IB-MONITOR\"}",
    "a_values_json": "{\"ib_monitor_name\":\"AgentB IB monitor worker result\",\"ib_monitor_bool\":true}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922201,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:30:26",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 15:30:25",
    "date_mod": "2026-10-24 15:30:26",
    "completed_at": null
  },
  {
    "id": 46,
    "work_id": "inbound-b-20261024-generic-native-fields-version3",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB generic native result\",\"ib_label_text\":\"AgentB IB readable source label\",\"ib_text_option\":\"AgentB IB Maker\",\"ib_dropdown_option\":\"AgentB IB Location\",\"ib_disabled\":\"MUST NOT APPLY DISABLED\",\"unmapped_scalar\":\"MUST NOT APPLY UNMAPPED\",\"ib_fields_text\":\"IB fields written by worker\",\"ib_fields_number\":12.5,\"ib_fields_yesno\":true,\"ib_fields_date\":\"2026-10-26\",\"ib_fields_datetime\":\"2026-10-26 14:15:16\",\"ib_fields_dropdown\":\"AgentB IB Choice Two\"}",
    "a_change_times_json": "{}",
    "settings_version": 3,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": 149,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:31:01",
    "status": "Done",
    "result_json": "{\"b_items_id\":149,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_name\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_label_text\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_text_option\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_dropdown_option\",\"outcome\":\"Skipped\",\"reason\":\"Destination dropdown options are not readable\"},{\"mapping_id\":\"ib_fields_text\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_fields_textarea\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_number\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_fields_yesno\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_fields_date\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_fields_datetime\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_fields_dropdown\",\"outcome\":\"AppliedToB\",\"reason\":null}]}",
    "error": null,
    "date_creation": "2026-10-24 15:31:00",
    "date_mod": "2026-10-24 15:31:01",
    "completed_at": "2026-10-24 15:31:01"
  },
  {
    "id": 47,
    "work_id": "inbound-b-20261024-generic-custom-version3",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBIB20261024Asset",
    "identity_json": "{\"a_items_id\":922101,\"b_items_id\":null,\"serial\":\"AGENTB-IB-CUSTOM\"}",
    "a_values_json": "{\"ib_custom_name\":\"AgentB IB custom processed\",\"ib_custom_text\":\"IB custom worker text\",\"ib_custom_number\":12.75,\"ib_custom_bool\":true,\"ib_custom_date\":\"2026-10-26\",\"ib_custom_datetime\":\"2026-10-26 14:15:16\",\"ib_custom_option\":\"AgentB IB Maker Two\"}",
    "a_change_times_json": "{}",
    "settings_version": 3,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922101,
    "b_items_id": 2,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:31:01",
    "status": "Failed",
    "result_json": "{\"b_items_id\":2,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_custom_text\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_custom_number\",\"outcome\":\"Failed\",\"reason\":\"Save failed: local write or reread did not confirm the intended value\"},{\"mapping_id\":\"ib_custom_bool\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_custom_date\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_custom_datetime\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_custom_option\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_custom_name\",\"outcome\":\"AppliedToB\",\"reason\":null}]}",
    "error": "Save failed: local write or reread did not confirm the intended value",
    "date_creation": "2026-10-24 15:31:00",
    "date_mod": "2026-10-24 15:31:01",
    "completed_at": null
  },
  {
    "id": 48,
    "work_id": "inbound-b-20261024-generic-monitor-version3",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Monitor",
    "identity_json": "{\"a_items_id\":922201,\"b_items_id\":null,\"serial\":\"AGENTB-IB-MONITOR\"}",
    "a_values_json": "{\"ib_monitor_name\":\"AgentB IB monitor worker result\",\"ib_monitor_bool\":true}",
    "a_change_times_json": "{}",
    "settings_version": 3,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922201,
    "b_items_id": 2,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:31:01",
    "status": "Done",
    "result_json": "{\"b_items_id\":2,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_monitor_name\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_monitor_bool\",\"outcome\":\"AppliedToB\",\"reason\":null}]}",
    "error": null,
    "date_creation": "2026-10-24 15:31:00",
    "date_mod": "2026-10-24 15:31:01",
    "completed_at": "2026-10-24 15:31:01"
  }
]
```

### 30 — IB custom partial failure readback before any correction

Account service; GET http://localhost:8081/api.php/v1/Glpi%5CCustomAsset%5CAgentBIB20261024Asset/2?get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request:

```json
null
```

Response:

```json
{
  "id": 2,
  "assets_assetdefinitions_id": 2,
  "assets_assetmodels_id": 0,
  "assets_assettypes_id": 0,
  "name": "AgentB IB custom processed",
  "uuid": null,
  "comment": null,
  "serial": "AGENTB-IB-CUSTOM",
  "otherserial": null,
  "contact": null,
  "contact_num": null,
  "users_id": 0,
  "users_id_tech": 0,
  "locations_id": 0,
  "manufacturers_id": 0,
  "states_id": 0,
  "entities_id": 0,
  "is_recursive": 0,
  "is_deleted": 0,
  "is_template": 0,
  "is_dynamic": 0,
  "template_name": null,
  "autoupdatesystems_id": 0,
  "date_creation": "2026-10-24 15:29:45",
  "date_mod": "2026-10-24 15:31:01",
  "last_inventory_update": null,
  "custom_fields": "{\"6\": \"IB custom worker text\", \"7\": \"2\", \"8\": true, \"9\": \"2026-10-26\", \"10\": \"2026-10-26 06:15:16\", \"11\": 6, \"12\": \"IB sibling must stay\"}",
  "groups_id": [],
  "groups_id_tech": [],
  "custom_ib_bool": true,
  "custom_ib_date": "2026-10-26",
  "custom_ib_datetime": "2026-10-26 14:15:16",
  "custom_ib_number": "2",
  "custom_ib_option": 6,
  "custom_ib_sibling": "IB sibling must stay",
  "custom_ib_text": "IB custom worker text"
}
```

### 31 — IB Fields siblings and multiple values verified after worker

Account service; GET http://localhost:8081/api.php/v1/PluginFieldsComputeragentbibx/1?get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request:

```json
null
```

Response:

```json
{
  "id": 1,
  "items_id": 149,
  "itemtype": "Computer",
  "plugin_fields_containers_id": 7,
  "entities_id": 0,
  "ibtextfield": "IB fields written by worker",
  "ibtextareafield": "IB unrelated scalar stays",
  "ibnumberfield": "12.5",
  "ibyesnofield": 1,
  "ibdatefield": "2026-10-26",
  "ibdatetimefield": "2026-10-26 14:15:16",
  "plugin_fields_ibdropdownfielddropdowns_id": 2,
  "plugin_fields_ibmultiplesiblingfielddropdowns_id": "[1,2]"
}
```

### 32 — IB08 IB09 IB10 compatible integer and definite validation skips

Account service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork; HTTP 201.

Request:

```json
{
  "input": [
    {
      "work_id": "inbound-b-20261024-custom-compatible-integer",
      "route_id": "inbound-b-20261024-main",
      "a_entities_id": 9200,
      "entities_id": 0,
      "itemtype": "Glpi\\CustomAsset\\AgentBIB20261024Asset",
      "identity_json": "{\"a_items_id\":922101,\"b_items_id\":null,\"serial\":\"AGENTB-IB-CUSTOM\"}",
      "a_values_json": "{\"ib_custom_number\":12}",
      "a_change_times_json": "{}",
      "settings_version": 3
    },
    {
      "work_id": "inbound-b-20261024-partial-invalid-fields",
      "route_id": "inbound-b-20261024-main",
      "a_entities_id": 9200,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
      "a_values_json": "{\"ib_name\":\"AgentB IB partial valid sibling\",\"ib_label_text\":17,\"ib_text_option\":\"AgentB IB no such label\",\"ib_fields_text\":null,\"ib_fields_number\":\"not a number\",\"ib_fields_yesno\":1,\"ib_fields_date\":\"2026-02-30\",\"ib_fields_datetime\":\"2026-10-26T14:15:16+08:00\"}",
      "a_change_times_json": "{}",
      "settings_version": 3
    },
    {
      "work_id": "inbound-b-20261024-ambiguous-dropdown",
      "route_id": "inbound-b-20261024-main",
      "a_entities_id": 9200,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
      "a_values_json": "{\"ib_text_option\":\"AgentB IB Duplicate Maker\"}",
      "a_change_times_json": "{}",
      "settings_version": 3
    },
    {
      "work_id": "inbound-b-20261024-overlong-text",
      "route_id": "inbound-b-20261024-main",
      "a_entities_id": 9200,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
      "a_values_json": "{\"ib_name\":\"xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx\"}",
      "a_change_times_json": "{}",
      "settings_version": 3
    }
  ]
}
```

Response:

```json
[
  {
    "id": 49,
    "message": ""
  },
  {
    "id": 50,
    "message": ""
  },
  {
    "id": 51,
    "message": ""
  },
  {
    "id": 52,
    "message": ""
  }
]
```

### 33 — IB06 admit before Computer read permission revoked

Account service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork; HTTP 201.

Request:

```json
{
  "input": {
    "work_id": "inbound-b-20261024-asset-read-revoked",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"MUST NOT APPLY ASSET DENIED\"}",
    "a_change_times_json": "{}",
    "settings_version": 3
  }
}
```

Response:

```json
{
  "id": 53,
  "message": ""
}
```

### 34 — IB11 admit before fresh Fields container write revoked

Account service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork; HTTP 201.

Request:

```json
{
  "input": {
    "work_id": "inbound-b-20261024-fields-write-revoked",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_fields_text\":\"MUST NOT SAVE FIELDS DENIED\"}",
    "a_change_times_json": "{}",
    "settings_version": 3
  }
}
```

Response:

```json
{
  "id": 54,
  "message": ""
}
```

### 35 — IB02 IB14 configure genuine B and Both stage mappings

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/10; HTTP 200.

Request:

```json
{
  "input": {
    "id": 10,
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "route_enabled": 1,
    "settings_version": 4,
    "enabled_itemtypes_json": "[\"Computer\",\"Monitor\",\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\"]",
    "field_mappings_json": "[{\"mapping_id\":\"ib_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_label_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"comment\"},\"source\":\"A\",\"value_mode\":\"dropdown_label_to_text\"},{\"mapping_id\":\"ib_text_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"manufacturers_id\"},\"source\":\"A\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"ib_dropdown_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"locations_id\"},\"source\":\"A\",\"value_mode\":\"dropdown_label_to_dropdown\"},{\"mapping_id\":\"ib_disabled\",\"itemtype\":\"Computer\",\"enabled\":false,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"otherserial\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_monitor_name\",\"itemtype\":\"Monitor\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_monitor_bool\",\"itemtype\":\"Monitor\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"is_global\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibtextfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_textarea\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibtextareafield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_number\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibnumberfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_yesno\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibyesnofield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_date\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibdatefield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_datetime\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibdatetimefield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_dropdown\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibdropdownfield\"},\"source\":\"A\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"ib_custom_text\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ib_text\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_custom_number\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ib_number\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_custom_bool\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ib_bool\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_custom_date\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ib_date\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_custom_datetime\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ib_datetime\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_custom_option\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ib_option\"},\"source\":\"A\",\"value_mode\":\"dropdown_label_to_dropdown\"},{\"mapping_id\":\"ib_custom_name\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_b_source\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"contact\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_both_source\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"contact_num\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact_num\"},\"source\":\"Both\",\"value_mode\":\"direct\"}]"
  }
}
```

Response:

```json
[
  {
    "10": true,
    "message": ""
  }
]
```

### 36 — IB02 IB14 B and Both source work stays unchanged Held

Account service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork; HTTP 201.

Request:

```json
{
  "input": {
    "work_id": "inbound-b-20261024-b-both-stage",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_b_source\":\"MUST NOT APPLY B\",\"ib_both_source\":\"MUST NOT APPLY BOTH\"}",
    "a_change_times_json": "{}",
    "settings_version": 4
  }
}
```

Response:

```json
{
  "id": 55,
  "message": ""
}
```

### 37 — IB07 fresh accepted fixture for interrupted-before-write marker

Account service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork; HTTP 201.

Request:

```json
{
  "input": {
    "work_id": "inbound-b-20261024-already-started",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"MUST NOT REPLAY STARTED\"}",
    "a_change_times_json": "{}",
    "settings_version": 4
  }
}
```

Response:

```json
{
  "id": 56,
  "message": ""
}
```

### 38 — IB07 pending job for occupied global worker lock

Account service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork; HTTP 201.

Request:

```json
{
  "input": {
    "work_id": "inbound-b-20261024-worker-lock",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 4
  }
}
```

Response:

```json
{
  "id": 57,
  "message": ""
}
```

### 39 — IB final all exact Work outcomes and preserved partial evidence

Account service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork?searchText%5Bwork_id%5D=%5Einbound-b-20261024-&range=0-99&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request:

```json
null
```

Response:

```json
[
  {
    "id": 23,
    "work_id": "inbound-b-20261024-existing-name",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": 149,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:26:22",
    "status": "Done",
    "result_json": "{\"b_items_id\":149,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_name\",\"outcome\":\"AppliedToB\",\"reason\":null}]}",
    "error": null,
    "date_creation": "2026-10-24 15:26:22",
    "date_mod": "2026-10-24 15:26:22",
    "completed_at": "2026-10-24 15:26:22"
  },
  {
    "id": 24,
    "work_id": "inbound-b-20261024-already-equal",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": 149,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Done",
    "result_json": "{\"b_items_id\":149,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_name\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}",
    "error": null,
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": "2026-10-24 15:27:27"
  },
  {
    "id": 25,
    "work_id": "inbound-b-20261024-retained-link-reuse",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB retained link write\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": 149,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Done",
    "result_json": "{\"b_items_id\":149,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_name\",\"outcome\":\"AppliedToB\",\"reason\":null}]}",
    "error": null,
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": "2026-10-24 15:27:27"
  },
  {
    "id": 26,
    "work_id": "inbound-b-20261024-claimed-mismatch",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":150,\"serial\":null}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Claimed B ID differs from retained verified link",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 27,
    "work_id": "inbound-b-20261024-unverified-claim",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922099,\"b_items_id\":149,\"serial\":null}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922099,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Claimed B ID has no retained verified link evidence",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 28,
    "work_id": "inbound-b-20261024-duplicate-serial",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922010,\"b_items_id\":null,\"serial\":\"AGENTB-IB-DUP\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922010,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Serial match is ambiguous in routed B entity",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 29,
    "work_id": "inbound-b-20261024-missing-serial",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922011,\"b_items_id\":null,\"serial\":null}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922011,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "No usable supported serial and no verified link",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 30,
    "work_id": "inbound-b-20261024-zero-match",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922012,\"b_items_id\":null,\"serial\":\"AGENTB-IB-NO-ASSET\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922012,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Complete serial lookup found no asset; first-copy processing is not installed yet",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 31,
    "work_id": "inbound-b-20261024-case-mismatch",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922013,\"b_items_id\":null,\"serial\":\"agentb-ib-renamed\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922013,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Complete serial lookup found no asset; first-copy processing is not installed yet",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 32,
    "work_id": "inbound-b-20261024-space-mismatch",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922014,\"b_items_id\":null,\"serial\":\"AGENTB-IB-RENAMED \"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922014,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Complete serial lookup found no asset; first-copy processing is not installed yet",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 33,
    "work_id": "inbound-b-20261024-competing-a-owner",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922015,\"b_items_id\":null,\"serial\":\"AGENTB-IB-RENAMED\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922015,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "B asset has competing retained source ownership",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 34,
    "work_id": "inbound-b-20261024-wrong-a-entity",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9201,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 35,
    "work_id": "inbound-b-20261024-missing-route",
    "route_id": "inbound-b-20261024-missing",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 36,
    "work_id": "inbound-b-20261024-disabled-type",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Monitor",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Disabled or unavailable asset type",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 37,
    "work_id": "inbound-b-20261024-wrong-version",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 2,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 38,
    "work_id": "inbound-b-20261024-suspend-stage",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Suspend",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Suspend/Resume processing is not installed yet",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 39,
    "work_id": "inbound-b-20261024-resume-stage",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Resume",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Suspend/Resume processing is not installed yet",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 40,
    "work_id": "inbound-b-20261024-correction-stage",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[2]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": 149,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:27:27",
    "status": "Held",
    "result_json": "{\"b_items_id\":149,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_name\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"}]}",
    "error": "Correction snapshot processing is not installed yet; queue remains Pending",
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "completed_at": null
  },
  {
    "id": 41,
    "work_id": "inbound-b-20261024-permission-revoked",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"MUST NOT APPLY REVOKED\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:28:25",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Hold: Submitting profile lacks current Work authorization",
    "date_creation": "2026-10-24 15:28:24",
    "date_mod": "2026-10-24 15:28:25",
    "completed_at": null
  },
  {
    "id": 42,
    "work_id": "inbound-b-20261024-settings-changed-after-accept",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB applied by worker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:28:25",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 15:28:25",
    "date_mod": "2026-10-24 15:28:25",
    "completed_at": null
  },
  {
    "id": 43,
    "work_id": "inbound-b-20261024-generic-native-fields",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB generic native result\",\"ib_label_text\":\"AgentB IB readable source label\",\"ib_text_option\":\"AgentB IB Maker\",\"ib_dropdown_option\":\"AgentB IB Location\",\"ib_disabled\":\"MUST NOT APPLY DISABLED\",\"unmapped_scalar\":\"MUST NOT APPLY UNMAPPED\",\"ib_fields_text\":\"IB fields written by worker\",\"ib_fields_number\":12.5,\"ib_fields_yesno\":true,\"ib_fields_date\":\"2026-10-26\",\"ib_fields_datetime\":\"2026-10-26 14:15:16\",\"ib_fields_dropdown\":\"AgentB IB Choice Two\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:30:26",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 15:30:25",
    "date_mod": "2026-10-24 15:30:26",
    "completed_at": null
  },
  {
    "id": 44,
    "work_id": "inbound-b-20261024-generic-custom",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBIB20261024Asset",
    "identity_json": "{\"a_items_id\":922101,\"b_items_id\":null,\"serial\":\"AGENTB-IB-CUSTOM\"}",
    "a_values_json": "{\"ib_custom_name\":\"AgentB IB custom processed\",\"ib_custom_text\":\"IB custom worker text\",\"ib_custom_number\":12.75,\"ib_custom_bool\":true,\"ib_custom_date\":\"2026-10-26\",\"ib_custom_datetime\":\"2026-10-26 14:15:16\",\"ib_custom_option\":\"AgentB IB Maker Two\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922101,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:30:26",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 15:30:25",
    "date_mod": "2026-10-24 15:30:26",
    "completed_at": null
  },
  {
    "id": 45,
    "work_id": "inbound-b-20261024-generic-monitor",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Monitor",
    "identity_json": "{\"a_items_id\":922201,\"b_items_id\":null,\"serial\":\"AGENTB-IB-MONITOR\"}",
    "a_values_json": "{\"ib_monitor_name\":\"AgentB IB monitor worker result\",\"ib_monitor_bool\":true}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922201,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:30:26",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 15:30:25",
    "date_mod": "2026-10-24 15:30:26",
    "completed_at": null
  },
  {
    "id": 46,
    "work_id": "inbound-b-20261024-generic-native-fields-version3",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB generic native result\",\"ib_label_text\":\"AgentB IB readable source label\",\"ib_text_option\":\"AgentB IB Maker\",\"ib_dropdown_option\":\"AgentB IB Location\",\"ib_disabled\":\"MUST NOT APPLY DISABLED\",\"unmapped_scalar\":\"MUST NOT APPLY UNMAPPED\",\"ib_fields_text\":\"IB fields written by worker\",\"ib_fields_number\":12.5,\"ib_fields_yesno\":true,\"ib_fields_date\":\"2026-10-26\",\"ib_fields_datetime\":\"2026-10-26 14:15:16\",\"ib_fields_dropdown\":\"AgentB IB Choice Two\"}",
    "a_change_times_json": "{}",
    "settings_version": 3,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": 149,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:31:01",
    "status": "Done",
    "result_json": "{\"b_items_id\":149,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_name\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_label_text\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_text_option\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_dropdown_option\",\"outcome\":\"Skipped\",\"reason\":\"Destination dropdown options are not readable\"},{\"mapping_id\":\"ib_fields_text\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_fields_textarea\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_number\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_fields_yesno\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_fields_date\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_fields_datetime\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_fields_dropdown\",\"outcome\":\"AppliedToB\",\"reason\":null}]}",
    "error": null,
    "date_creation": "2026-10-24 15:31:00",
    "date_mod": "2026-10-24 15:31:01",
    "completed_at": "2026-10-24 15:31:01"
  },
  {
    "id": 47,
    "work_id": "inbound-b-20261024-generic-custom-version3",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBIB20261024Asset",
    "identity_json": "{\"a_items_id\":922101,\"b_items_id\":null,\"serial\":\"AGENTB-IB-CUSTOM\"}",
    "a_values_json": "{\"ib_custom_name\":\"AgentB IB custom processed\",\"ib_custom_text\":\"IB custom worker text\",\"ib_custom_number\":12.75,\"ib_custom_bool\":true,\"ib_custom_date\":\"2026-10-26\",\"ib_custom_datetime\":\"2026-10-26 14:15:16\",\"ib_custom_option\":\"AgentB IB Maker Two\"}",
    "a_change_times_json": "{}",
    "settings_version": 3,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922101,
    "b_items_id": 2,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:31:01",
    "status": "Failed",
    "result_json": "{\"b_items_id\":2,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_custom_text\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_custom_number\",\"outcome\":\"Failed\",\"reason\":\"Save failed: local write or reread did not confirm the intended value\"},{\"mapping_id\":\"ib_custom_bool\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_custom_date\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_custom_datetime\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_custom_option\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_custom_name\",\"outcome\":\"AppliedToB\",\"reason\":null}]}",
    "error": "Save failed: local write or reread did not confirm the intended value",
    "date_creation": "2026-10-24 15:31:00",
    "date_mod": "2026-10-24 15:31:01",
    "completed_at": null
  },
  {
    "id": 48,
    "work_id": "inbound-b-20261024-generic-monitor-version3",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Monitor",
    "identity_json": "{\"a_items_id\":922201,\"b_items_id\":null,\"serial\":\"AGENTB-IB-MONITOR\"}",
    "a_values_json": "{\"ib_monitor_name\":\"AgentB IB monitor worker result\",\"ib_monitor_bool\":true}",
    "a_change_times_json": "{}",
    "settings_version": 3,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922201,
    "b_items_id": 2,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:31:01",
    "status": "Done",
    "result_json": "{\"b_items_id\":2,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_monitor_name\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_monitor_bool\",\"outcome\":\"AppliedToB\",\"reason\":null}]}",
    "error": null,
    "date_creation": "2026-10-24 15:31:00",
    "date_mod": "2026-10-24 15:31:01",
    "completed_at": "2026-10-24 15:31:01"
  },
  {
    "id": 49,
    "work_id": "inbound-b-20261024-custom-compatible-integer",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBIB20261024Asset",
    "identity_json": "{\"a_items_id\":922101,\"b_items_id\":null,\"serial\":\"AGENTB-IB-CUSTOM\"}",
    "a_values_json": "{\"ib_custom_number\":12}",
    "a_change_times_json": "{}",
    "settings_version": 3,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922101,
    "b_items_id": 2,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:33:13",
    "status": "Done",
    "result_json": "{\"b_items_id\":2,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_custom_text\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_custom_number\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_custom_bool\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_custom_date\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_custom_datetime\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_custom_option\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_custom_name\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"}]}",
    "error": null,
    "date_creation": "2026-10-24 15:33:13",
    "date_mod": "2026-10-24 15:33:13",
    "completed_at": "2026-10-24 15:33:13"
  },
  {
    "id": 50,
    "work_id": "inbound-b-20261024-partial-invalid-fields",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"AgentB IB partial valid sibling\",\"ib_label_text\":17,\"ib_text_option\":\"AgentB IB no such label\",\"ib_fields_text\":null,\"ib_fields_number\":\"not a number\",\"ib_fields_yesno\":1,\"ib_fields_date\":\"2026-02-30\",\"ib_fields_datetime\":\"2026-10-26T14:15:16+08:00\"}",
    "a_change_times_json": "{}",
    "settings_version": 3,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": 149,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:33:13",
    "status": "Done",
    "result_json": "{\"b_items_id\":149,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_name\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ib_label_text\",\"outcome\":\"Skipped\",\"reason\":\"Conversion does not match destination field kind\"},{\"mapping_id\":\"ib_text_option\",\"outcome\":\"Skipped\",\"reason\":\"Destination dropdown label has no permitted exact match\"},{\"mapping_id\":\"ib_dropdown_option\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_text\",\"outcome\":\"Skipped\",\"reason\":\"Destination does not have a verified nullable local writer\"},{\"mapping_id\":\"ib_fields_textarea\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_number\",\"outcome\":\"Skipped\",\"reason\":\"Destination requires a compatible finite number\"},{\"mapping_id\":\"ib_fields_yesno\",\"outcome\":\"Skipped\",\"reason\":\"Destination Yes\\/No requires a boolean\"},{\"mapping_id\":\"ib_fields_date\",\"outcome\":\"Skipped\",\"reason\":\"Destination requires a real canonical native date\\/datetime\"},{\"mapping_id\":\"ib_fields_datetime\",\"outcome\":\"Skipped\",\"reason\":\"Destination requires a real canonical native date\\/datetime\"},{\"mapping_id\":\"ib_fields_dropdown\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"}]}",
    "error": null,
    "date_creation": "2026-10-24 15:33:13",
    "date_mod": "2026-10-24 15:33:13",
    "completed_at": "2026-10-24 15:33:13"
  },
  {
    "id": 51,
    "work_id": "inbound-b-20261024-ambiguous-dropdown",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_text_option\":\"AgentB IB Duplicate Maker\"}",
    "a_change_times_json": "{}",
    "settings_version": 3,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": 149,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:33:13",
    "status": "Done",
    "result_json": "{\"b_items_id\":149,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_name\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_label_text\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_text_option\",\"outcome\":\"Skipped\",\"reason\":\"Destination dropdown label is ambiguous\"},{\"mapping_id\":\"ib_dropdown_option\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_text\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_textarea\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_number\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_yesno\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_date\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_datetime\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_dropdown\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"}]}",
    "error": null,
    "date_creation": "2026-10-24 15:33:13",
    "date_mod": "2026-10-24 15:33:13",
    "completed_at": "2026-10-24 15:33:13"
  },
  {
    "id": 52,
    "work_id": "inbound-b-20261024-overlong-text",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx\"}",
    "a_change_times_json": "{}",
    "settings_version": 3,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": 149,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:33:13",
    "status": "Done",
    "result_json": "{\"b_items_id\":149,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_name\",\"outcome\":\"Skipped\",\"reason\":\"Text exceeds destination column length\"},{\"mapping_id\":\"ib_label_text\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_text_option\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_dropdown_option\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_text\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_textarea\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_number\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_yesno\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_date\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_datetime\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_dropdown\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"}]}",
    "error": null,
    "date_creation": "2026-10-24 15:33:13",
    "date_mod": "2026-10-24 15:33:13",
    "completed_at": "2026-10-24 15:33:13"
  },
  {
    "id": 53,
    "work_id": "inbound-b-20261024-asset-read-revoked",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"MUST NOT APPLY ASSET DENIED\"}",
    "a_change_times_json": "{}",
    "settings_version": 3,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:33:13",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Asset read permission denied or no entity scope metadata",
    "date_creation": "2026-10-24 15:33:13",
    "date_mod": "2026-10-24 15:33:13",
    "completed_at": null
  },
  {
    "id": 54,
    "work_id": "inbound-b-20261024-fields-write-revoked",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_fields_text\":\"MUST NOT SAVE FIELDS DENIED\"}",
    "a_change_times_json": "{}",
    "settings_version": 3,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": 149,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:34:10",
    "status": "Done",
    "result_json": "{\"b_items_id\":149,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_name\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_label_text\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_text_option\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_dropdown_option\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_text\",\"outcome\":\"Skipped\",\"reason\":\"Fields container write permission denied\"},{\"mapping_id\":\"ib_fields_textarea\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_number\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_yesno\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_date\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_datetime\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_dropdown\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"}]}",
    "error": null,
    "date_creation": "2026-10-24 15:34:09",
    "date_mod": "2026-10-24 15:34:10",
    "completed_at": "2026-10-24 15:34:10"
  },
  {
    "id": 55,
    "work_id": "inbound-b-20261024-b-both-stage",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_b_source\":\"MUST NOT APPLY B\",\"ib_both_source\":\"MUST NOT APPLY BOTH\"}",
    "a_change_times_json": "{}",
    "settings_version": 4,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": 149,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:34:10",
    "status": "Held",
    "result_json": "{\"b_items_id\":149,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_name\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_label_text\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_text_option\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_dropdown_option\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_text\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_textarea\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_number\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_yesno\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_date\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_datetime\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_dropdown\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_b_source\",\"outcome\":\"Skipped\",\"reason\":\"B return processing is not installed yet\"},{\"mapping_id\":\"ib_both_source\",\"outcome\":\"Skipped\",\"reason\":\"Both conflict processing is not installed yet\"}]}",
    "error": "Both conflict processing is not installed yet",
    "date_creation": "2026-10-24 15:34:10",
    "date_mod": "2026-10-24 15:34:10",
    "completed_at": null
  },
  {
    "id": 56,
    "work_id": "inbound-b-20261024-already-started",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{\"ib_name\":\"MUST NOT REPLAY STARTED\"}",
    "a_change_times_json": "{}",
    "settings_version": 4,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:34:10",
    "status": "Held",
    "result_json": null,
    "error": "Uncertain previous processing: reconcile saved outcomes before issuing new Work",
    "date_creation": "2026-10-24 15:34:10",
    "date_mod": "2026-10-24 15:34:10",
    "completed_at": null
  },
  {
    "id": 57,
    "work_id": "inbound-b-20261024-worker-lock",
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 4,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 922001,
    "b_items_id": 149,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:34:37",
    "status": "Held",
    "result_json": "{\"b_items_id\":149,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ib_name\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_label_text\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_text_option\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_dropdown_option\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_text\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_textarea\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_number\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_yesno\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_date\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_datetime\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_fields_dropdown\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ib_b_source\",\"outcome\":\"Skipped\",\"reason\":\"B return processing is not installed yet\"},{\"mapping_id\":\"ib_both_source\",\"outcome\":\"Skipped\",\"reason\":\"Both conflict processing is not installed yet\"}]}",
    "error": "Both conflict processing is not installed yet",
    "date_creation": "2026-10-24 15:34:36",
    "date_mod": "2026-10-24 15:34:37",
    "completed_at": null
  }
]
```

### 40 — IB final native primary values and no forbidden mutations

Account service; GET http://localhost:8081/api.php/v1/Computer/149?get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request:

```json
null
```

Response:

```json
{
  "id": 149,
  "entities_id": 0,
  "name": "AgentB IB partial valid sibling",
  "serial": "AGENTB-IB-RENAMED",
  "otherserial": null,
  "contact": null,
  "contact_num": null,
  "users_id_tech": 0,
  "comment": "AgentB IB readable source label",
  "date_mod": "2026-10-24 15:33:13",
  "autoupdatesystems_id": 0,
  "locations_id": 0,
  "networks_id": 0,
  "computermodels_id": 0,
  "computertypes_id": 0,
  "is_template": 0,
  "template_name": null,
  "manufacturers_id": 3,
  "is_deleted": 0,
  "is_dynamic": 0,
  "users_id": 0,
  "states_id": 0,
  "ticket_tco": "0.0000",
  "uuid": null,
  "date_creation": "2026-10-24 15:26:22",
  "is_recursive": 0,
  "last_inventory_update": null,
  "last_boot": null,
  "groups_id": [],
  "groups_id_tech": []
}
```

### 41 — IB final custom compatible integer and sibling preservation

Account service; GET http://localhost:8081/api.php/v1/Glpi%5CCustomAsset%5CAgentBIB20261024Asset/2?get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request:

```json
null
```

Response:

```json
{
  "id": 2,
  "assets_assetdefinitions_id": 2,
  "assets_assetmodels_id": 0,
  "assets_assettypes_id": 0,
  "name": "AgentB IB custom processed",
  "uuid": null,
  "comment": null,
  "serial": "AGENTB-IB-CUSTOM",
  "otherserial": null,
  "contact": null,
  "contact_num": null,
  "users_id": 0,
  "users_id_tech": 0,
  "locations_id": 0,
  "manufacturers_id": 0,
  "states_id": 0,
  "entities_id": 0,
  "is_recursive": 0,
  "is_deleted": 0,
  "is_template": 0,
  "is_dynamic": 0,
  "template_name": null,
  "autoupdatesystems_id": 0,
  "date_creation": "2026-10-24 15:29:45",
  "date_mod": "2026-10-24 15:33:13",
  "last_inventory_update": null,
  "custom_fields": "{\"6\": \"IB custom worker text\", \"7\": \"12\", \"8\": true, \"9\": \"2026-10-26\", \"10\": \"2026-10-26 06:15:16\", \"11\": 6, \"12\": \"IB sibling must stay\"}",
  "groups_id": [],
  "groups_id_tech": [],
  "custom_ib_bool": true,
  "custom_ib_date": "2026-10-26",
  "custom_ib_datetime": "2026-10-26 14:15:16",
  "custom_ib_number": "12",
  "custom_ib_option": 6,
  "custom_ib_sibling": "IB sibling must stay",
  "custom_ib_text": "IB custom worker text"
}
```

### 42 — IB final second native name boolean values

Account service; GET http://localhost:8081/api.php/v1/Monitor/2?get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request:

```json
null
```

Response:

```json
{
  "id": 2,
  "entities_id": 0,
  "name": "AgentB IB monitor worker result",
  "date_mod": "2026-10-24 15:31:01",
  "contact": null,
  "contact_num": null,
  "users_id_tech": 0,
  "comment": null,
  "serial": "AGENTB-IB-MONITOR",
  "otherserial": null,
  "size": "0.00",
  "have_micro": 0,
  "have_speaker": 0,
  "have_subd": 0,
  "have_bnc": 0,
  "have_dvi": 0,
  "have_pivot": 0,
  "have_hdmi": 0,
  "have_displayport": 0,
  "locations_id": 0,
  "monitortypes_id": 0,
  "monitormodels_id": 0,
  "manufacturers_id": 0,
  "is_global": 1,
  "is_deleted": 0,
  "is_template": 0,
  "template_name": null,
  "users_id": 0,
  "states_id": 0,
  "ticket_tco": "0.0000",
  "is_dynamic": 0,
  "autoupdatesystems_id": 0,
  "uuid": null,
  "date_creation": "2026-10-24 15:29:45",
  "is_recursive": 0,
  "groups_id": [],
  "groups_id_tech": []
}
```

### 43 — IB final Fields scalar and multiple sibling preservation

Account service; GET http://localhost:8081/api.php/v1/PluginFieldsComputeragentbibx/1?get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request:

```json
null
```

Response:

```json
{
  "id": 1,
  "items_id": 149,
  "itemtype": "Computer",
  "plugin_fields_containers_id": 7,
  "entities_id": 0,
  "ibtextfield": "IB fields written by worker",
  "ibtextareafield": "IB unrelated scalar stays",
  "ibnumberfield": "12.5",
  "ibyesnofield": 1,
  "ibdatefield": "2026-10-26",
  "ibdatetimefield": "2026-10-26 14:15:16",
  "plugin_fields_ibdropdownfielddropdowns_id": 2,
  "plugin_fields_ibmultiplesiblingfielddropdowns_id": "[1,2]"
}
```

### 44 — IB only genuine edit queued despite all worker writes

Account service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?searchText%5Broute_id%5D=%5Einbound-b-20261024-main%24&range=0-99&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request:

```json
null
```

Response:

```json
[
  {
    "id": 14,
    "route_id": "inbound-b-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":149,\"serial\":\"AGENTB-IB-RENAMED\"}",
    "changed_fields_json": "{\"ib_name\":{\"value\":\"AgentB IB genuine immediate edit\",\"changed_at\":\"2026-10-24T15:27:27+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "done_at": null
  }
]
```

### 45 — IB correction stage leaves exact referenced snapshot Pending

Account service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2?get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request:

```json
null
```

Response:

```json
{
  "id": 2,
  "route_id": "outbound-a-20261024-main",
  "settings_version": 1,
  "a_entities_id": 9100,
  "entities_id": 0,
  "itemtype": "Computer",
  "identity_json": "{\"a_items_id\":null,\"b_items_id\":145,\"serial\":\"AGENTB-OC-MAIN\"}",
  "changed_fields_json": "{\"native_name\":{\"value\":\"AgentB OC native edit two\",\"changed_at\":\"2026-10-24T15:13:27+08:00\",\"reliable\":true}}",
  "status": "Pending",
  "retry_count": 0,
  "error": null,
  "date_creation": "2026-10-24 15:13:27",
  "date_mod": "2026-10-24 15:13:27",
  "done_at": null
}
```

### 46 — IB contain only fresh route after bounded processor pass

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/10; HTTP 200.

Request:

```json
{
  "input": {
    "id": 10,
    "route_id": "inbound-b-20261024-main",
    "a_entities_id": 9200,
    "entities_id": 0,
    "route_enabled": 0,
    "settings_version": 5,
    "enabled_itemtypes_json": "[\"Computer\",\"Monitor\",\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\"]",
    "field_mappings_json": "[{\"mapping_id\":\"ib_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_label_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"comment\"},\"source\":\"A\",\"value_mode\":\"dropdown_label_to_text\"},{\"mapping_id\":\"ib_text_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"manufacturers_id\"},\"source\":\"A\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"ib_dropdown_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"locations_id\"},\"source\":\"A\",\"value_mode\":\"dropdown_label_to_dropdown\"},{\"mapping_id\":\"ib_disabled\",\"itemtype\":\"Computer\",\"enabled\":false,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"otherserial\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_monitor_name\",\"itemtype\":\"Monitor\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_monitor_bool\",\"itemtype\":\"Monitor\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"is_global\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibtextfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_textarea\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibtextareafield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_number\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibnumberfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_yesno\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibyesnofield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_date\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibdatefield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_datetime\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibdatetimefield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_dropdown\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibdropdownfield\"},\"source\":\"A\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"ib_custom_text\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ib_text\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_custom_number\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ib_number\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_custom_bool\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ib_bool\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_custom_date\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ib_date\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_custom_datetime\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ib_datetime\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_custom_option\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ib_option\"},\"source\":\"A\",\"value_mode\":\"dropdown_label_to_dropdown\"},{\"mapping_id\":\"ib_custom_name\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_b_source\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"contact\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_both_source\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"contact_num\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact_num\"},\"source\":\"Both\",\"value_mode\":\"direct\"}]"
  }
}
```

Response:

```json
[
  {
    "10": true,
    "message": ""
  }
]
```

### 47 — IB fresh route disabled readback

Account service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/10?get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request:

```json
null
```

Response:

```json
{
  "id": 10,
  "route_id": "inbound-b-20261024-main",
  "a_entities_id": 9200,
  "entities_id": 0,
  "route_enabled": 0,
  "settings_version": 5,
  "enabled_itemtypes_json": "[\"Computer\",\"Monitor\",\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\"]",
  "field_mappings_json": "[{\"mapping_id\":\"ib_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_label_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"comment\"},\"source\":\"A\",\"value_mode\":\"dropdown_label_to_text\"},{\"mapping_id\":\"ib_text_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"manufacturers_id\"},\"source\":\"A\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"ib_dropdown_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"locations_id\"},\"source\":\"A\",\"value_mode\":\"dropdown_label_to_dropdown\"},{\"mapping_id\":\"ib_disabled\",\"itemtype\":\"Computer\",\"enabled\":false,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"otherserial\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_monitor_name\",\"itemtype\":\"Monitor\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_monitor_bool\",\"itemtype\":\"Monitor\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"is_global\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibtextfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_textarea\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibtextareafield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_number\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibnumberfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_yesno\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibyesnofield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_date\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibdatefield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_datetime\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibdatetimefield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_fields_dropdown\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbibx\",\"name\":\"ibdropdownfield\"},\"source\":\"A\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"ib_custom_text\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ib_text\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_custom_number\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ib_number\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_custom_bool\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ib_bool\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_custom_date\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ib_date\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_custom_datetime\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ib_datetime\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_custom_option\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ib_option\"},\"source\":\"A\",\"value_mode\":\"dropdown_label_to_dropdown\"},{\"mapping_id\":\"ib_custom_name\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIB20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_b_source\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"contact\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ib_both_source\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"contact_num\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact_num\"},\"source\":\"Both\",\"value_mode\":\"direct\"}]"
}
```

### 48 — IB close final service session

Account service; GET http://localhost:8081/api.php/v1/killSession; HTTP 200.

Request:

```json
null
```

Response:

```json
true
```

## Native local operator ledger

### Local 1 — Drain old admission fixtures first bounded batch20 under disabled or missing routes

User context 2; exit 0.

```php
$_SESSION['glpicronuserrunning']='AgentB scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status','error','processing_started_at','b_items_id','link_state'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC']));$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Result:

```text
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"1":{"id":1,"work_id":"inbound-a-20261024-accepted-default","status":"Accepted"},"2":{"id":2,"work_id":"inbound-a-20261024-accepted-array-scalars","status":"Accepted"},"3":{"id":3,"work_id":"inbound-a-20261024-accepted-time-null","status":"Accepted"},"4":{"id":4,"work_id":"inbound-a-20261024-accepted-time-unreliable","status":"Accepted"},"5":{"id":5,"work_id":"inbound-a-20261024-accepted-time-missing","status":"Accepted"},"6":{"id":6,"work_id":"inbound-a-20261024-accepted-sync","status":"Accepted"},"7":{"id":7,"work_id":"inbound-a-20261024-accepted-suspend","status":"Accepted"},"8":{"id":8,"work_id":"inbound-a-20261024-accepted-resume","status":"Accepted"},"9":{"id":9,"work_id":"inbound-a-20261024-accepted-null-unreliable","status":"Accepted"},"10":{"id":10,"work_id":"inbound-a-20261024-accepted-identity-link","status":"Accepted"},"11":{"id":11,"work_id":"inbound-a-20261024-accepted-unknown-route","status":"Accepted"},"12":{"id":12,"work_id":"inbound-a-20261024-accepted-unknown-type","status":"Accepted"},"13":{"id":13,"work_id":"inbound-a-20261024-accepted-disabled-type","status":"Accepted"},"14":{"id":14,"work_id":"inbound-a-20261024-accepted-disabled-route","status":"Accepted"},"15":{"id":15,"work_id":"inbound-a-20261024-accepted-old-version","status":"Accepted"},"16":{"id":16,"work_id":"inbound-a-20261024-CaseDistinct","status":"Accepted"},"17":{"id":17,"work_id":"inbound-a-20261024-casedistinct","status":"Accepted"},"18":{"id":18,"work_id":"inbound-a-20261024-valid-bulk-1","status":"Accepted"},"19":{"id":19,"work_id":"inbound-a-20261024-valid-bulk-2","status":"Accepted"},"20":{"id":20,"work_id":"inbound-a-20261024-mixed-valid","status":"Accepted"},"21":{"id":21,"work_id":"inbound-a-20261024-outside-child","status":"Accepted"},"22":{"id":22,"work_id":"inbound-a-20261024-concurrent","status":"Accepted"}},"after":{"1":{"id":1,"work_id":"inbound-a-20261024-accepted-default","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:25:50","b_items_id":null,"link_state":null},"2":{"id":2,"work_id":"inbound-a-20261024-accepted-array-scalars","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:25:50","b_items_id":null,"link_state":null},"3":{"id":3,"work_id":"inbound-a-20261024-accepted-time-null","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:25:50","b_items_id":null,"link_state":null},"4":{"id":4,"work_id":"inbound-a-20261024-accepted-time-unreliable","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:25:50","b_items_id":null,"link_state":null},"5":{"id":5,"work_id":"inbound-a-20261024-accepted-time-missing","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:25:50","b_items_id":null,"link_state":null},"6":{"id":6,"work_id":"inbound-a-20261024-accepted-sync","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:25:50","b_items_id":null,"link_state":null},"7":{"id":7,"work_id":"inbound-a-20261024-accepted-suspend","status":"Held","error":"Suspend\/Resume processing is not installed yet","processing_started_at":"2026-10-24 15:25:50","b_items_id":null,"link_state":null},"8":{"id":8,"work_id":"inbound-a-20261024-accepted-resume","status":"Held","error":"Suspend\/Resume processing is not installed yet","processing_started_at":"2026-10-24 15:25:50","b_items_id":null,"link_state":null},"9":{"id":9,"work_id":"inbound-a-20261024-accepted-null-unreliable","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:25:50","b_items_id":null,"link_state":null},"10":{"id":10,"work_id":"inbound-a-20261024-accepted-identity-link","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:25:50","b_items_id":null,"link_state":null},"11":{"id":11,"work_id":"inbound-a-20261024-accepted-unknown-route","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:25:50","b_items_id":null,"link_state":null},"12":{"id":12,"work_id":"inbound-a-20261024-accepted-unknown-type","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:25:50","b_items_id":null,"link_state":null},"13":{"id":13,"work_id":"inbound-a-20261024-accepted-disabled-type","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:25:50","b_items_id":null,"link_state":null},"14":{"id":14,"work_id":"inbound-a-20261024-accepted-disabled-route","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:25:50","b_items_id":null,"link_state":null},"15":{"id":15,"work_id":"inbound-a-20261024-accepted-old-version","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:25:50","b_items_id":null,"link_state":null},"16":{"id":16,"work_id":"inbound-a-20261024-CaseDistinct","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:25:50","b_items_id":null,"link_state":null},"17":{"id":17,"work_id":"inbound-a-20261024-casedistinct","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:25:50","b_items_id":null,"link_state":null},"18":{"id":18,"work_id":"inbound-a-20261024-valid-bulk-1","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:25:50","b_items_id":null,"link_state":null},"19":{"id":19,"work_id":"inbound-a-20261024-valid-bulk-2","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:25:50","b_items_id":null,"link_state":null},"20":{"id":20,"work_id":"inbound-a-20261024-mixed-valid","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:25:50","b_items_id":null,"link_state":null},"21":{"id":21,"work_id":"inbound-a-20261024-outside-child","status":"Accepted","error":null,"processing_started_at":null,"b_items_id":null,"link_state":null},"22":{"id":22,"work_id":"inbound-a-20261024-concurrent","status":"Accepted","error":null,"processing_started_at":null,"b_items_id":null,"link_state":null}},"logs":{"213":{"id":213,"crontasks_id":51,"crontasklogs_id":212,"date":"2026-10-24 15:25:50","state":2,"elapsed":0.068733,"volume":20,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}

```

### Local 2 — Drain remaining old admission fixtures second bounded batch2

User context 2; exit 0.

```php
$_SESSION['glpicronuserrunning']='AgentB scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status','error','processing_started_at','b_items_id','link_state'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC']));$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Result:

```text
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"21":{"id":21,"work_id":"inbound-a-20261024-outside-child","status":"Accepted"},"22":{"id":22,"work_id":"inbound-a-20261024-concurrent","status":"Accepted"}},"after":{"21":{"id":21,"work_id":"inbound-a-20261024-outside-child","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:25:51","b_items_id":null,"link_state":null},"22":{"id":22,"work_id":"inbound-a-20261024-concurrent","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:25:51","b_items_id":null,"link_state":null}},"logs":{"215":{"id":215,"crontasks_id":51,"crontasklogs_id":214,"date":"2026-10-24 15:25:51","state":2,"elapsed":0.014652,"volume":2,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}

```

### Local 3 — IB01 scoped existing A-owned name processing

User context 2; exit 0.

```php
$_SESSION['glpicronuserrunning']='AgentB scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status','error','processing_started_at','b_items_id','link_state'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC']));$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Result:

```text
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"23":{"id":23,"work_id":"inbound-b-20261024-existing-name","status":"Accepted"}},"after":{"23":{"id":23,"work_id":"inbound-b-20261024-existing-name","status":"Done","error":null,"processing_started_at":"2026-10-24 15:26:22","b_items_id":149,"link_state":"Active"}},"logs":{"217":{"id":217,"crontasks_id":51,"crontasklogs_id":216,"date":"2026-10-24 15:26:22","state":2,"elapsed":0.0482841,"volume":1,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}

```

### Local 4 — IB02 exact same-value History and queue baseline

User context 12; exit 0.

```php
echo json_encode(['asset_history'=>countElementsInTable(Log::getTable(),['itemtype'=>'Computer','items_id'=>149]),'change_count'=>countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[])]);
```

Result:

```text
{"asset_history":2,"change_count":13}

```

### Local 5 — IB02 same-value work must avoid redundant save

User context 2; exit 0.

```php
$_SESSION['glpicronuserrunning']='AgentB scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status','error','processing_started_at','b_items_id','link_state'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC']));$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Result:

```text
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"24":{"id":24,"work_id":"inbound-b-20261024-already-equal","status":"Accepted"}},"after":{"24":{"id":24,"work_id":"inbound-b-20261024-already-equal","status":"Done","error":null,"processing_started_at":"2026-10-24 15:27:27","b_items_id":149,"link_state":"Active"}},"logs":{"219":{"id":219,"crontasks_id":51,"crontasklogs_id":218,"date":"2026-10-24 15:27:27","state":2,"elapsed":0.041153,"volume":1,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}

```

### Local 6 — IB02 same-value History and queue unchanged plus submitting user attribution

User context 12; exit 0.

```php
echo json_encode(['asset_history'=>countElementsInTable(Log::getTable(),['itemtype'=>'Computer','items_id'=>149]),'change_count'=>countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[]),'history'=>iterator_to_array($DB->request(['FROM'=>Log::getTable(),'WHERE'=>['itemtype'=>'Computer','items_id'=>149],'ORDER'=>'id ASC']))]);
```

Result:

```text
{"asset_history":2,"change_count":13,"history":{"139071":{"id":139071,"itemtype":"Computer","items_id":149,"itemtype_link":"0","linked_action":20,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:26:22","id_search_option":0,"old_value":"","new_value":"","old_id":null,"new_id":null},"139074":{"id":139074,"itemtype":"Computer","items_id":149,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:26:22","id_search_option":1,"old_value":"AgentB IB primary before","new_value":"AgentB IB applied by worker","old_id":null,"new_id":null}}}

```

### Local 7 — Process one bounded16-row identity scope and stage batch

User context 2; exit 0.

```php
$_SESSION['glpicronuserrunning']='AgentB scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status','error','processing_started_at','b_items_id','link_state'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC']));$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Result:

```text
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"25":{"id":25,"work_id":"inbound-b-20261024-retained-link-reuse","status":"Accepted"},"26":{"id":26,"work_id":"inbound-b-20261024-claimed-mismatch","status":"Accepted"},"27":{"id":27,"work_id":"inbound-b-20261024-unverified-claim","status":"Accepted"},"28":{"id":28,"work_id":"inbound-b-20261024-duplicate-serial","status":"Accepted"},"29":{"id":29,"work_id":"inbound-b-20261024-missing-serial","status":"Accepted"},"30":{"id":30,"work_id":"inbound-b-20261024-zero-match","status":"Accepted"},"31":{"id":31,"work_id":"inbound-b-20261024-case-mismatch","status":"Accepted"},"32":{"id":32,"work_id":"inbound-b-20261024-space-mismatch","status":"Accepted"},"33":{"id":33,"work_id":"inbound-b-20261024-competing-a-owner","status":"Accepted"},"34":{"id":34,"work_id":"inbound-b-20261024-wrong-a-entity","status":"Accepted"},"35":{"id":35,"work_id":"inbound-b-20261024-missing-route","status":"Accepted"},"36":{"id":36,"work_id":"inbound-b-20261024-disabled-type","status":"Accepted"},"37":{"id":37,"work_id":"inbound-b-20261024-wrong-version","status":"Accepted"},"38":{"id":38,"work_id":"inbound-b-20261024-suspend-stage","status":"Accepted"},"39":{"id":39,"work_id":"inbound-b-20261024-resume-stage","status":"Accepted"},"40":{"id":40,"work_id":"inbound-b-20261024-correction-stage","status":"Accepted"}},"after":{"25":{"id":25,"work_id":"inbound-b-20261024-retained-link-reuse","status":"Done","error":null,"processing_started_at":"2026-10-24 15:27:27","b_items_id":149,"link_state":"Active"},"26":{"id":26,"work_id":"inbound-b-20261024-claimed-mismatch","status":"Held","error":"Claimed B ID differs from retained verified link","processing_started_at":"2026-10-24 15:27:27","b_items_id":null,"link_state":null},"27":{"id":27,"work_id":"inbound-b-20261024-unverified-claim","status":"Held","error":"Claimed B ID has no retained verified link evidence","processing_started_at":"2026-10-24 15:27:27","b_items_id":null,"link_state":null},"28":{"id":28,"work_id":"inbound-b-20261024-duplicate-serial","status":"Held","error":"Serial match is ambiguous in routed B entity","processing_started_at":"2026-10-24 15:27:27","b_items_id":null,"link_state":null},"29":{"id":29,"work_id":"inbound-b-20261024-missing-serial","status":"Held","error":"No usable supported serial and no verified link","processing_started_at":"2026-10-24 15:27:27","b_items_id":null,"link_state":null},"30":{"id":30,"work_id":"inbound-b-20261024-zero-match","status":"Held","error":"Complete serial lookup found no asset; first-copy processing is not installed yet","processing_started_at":"2026-10-24 15:27:27","b_items_id":null,"link_state":null},"31":{"id":31,"work_id":"inbound-b-20261024-case-mismatch","status":"Held","error":"Complete serial lookup found no asset; first-copy processing is not installed yet","processing_started_at":"2026-10-24 15:27:27","b_items_id":null,"link_state":null},"32":{"id":32,"work_id":"inbound-b-20261024-space-mismatch","status":"Held","error":"Complete serial lookup found no asset; first-copy processing is not installed yet","processing_started_at":"2026-10-24 15:27:27","b_items_id":null,"link_state":null},"33":{"id":33,"work_id":"inbound-b-20261024-competing-a-owner","status":"Held","error":"B asset has competing retained source ownership","processing_started_at":"2026-10-24 15:27:27","b_items_id":null,"link_state":null},"34":{"id":34,"work_id":"inbound-b-20261024-wrong-a-entity","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:27:27","b_items_id":null,"link_state":null},"35":{"id":35,"work_id":"inbound-b-20261024-missing-route","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:27:27","b_items_id":null,"link_state":null},"36":{"id":36,"work_id":"inbound-b-20261024-disabled-type","status":"Held","error":"Disabled or unavailable asset type","processing_started_at":"2026-10-24 15:27:27","b_items_id":null,"link_state":null},"37":{"id":37,"work_id":"inbound-b-20261024-wrong-version","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:27:27","b_items_id":null,"link_state":null},"38":{"id":38,"work_id":"inbound-b-20261024-suspend-stage","status":"Held","error":"Suspend\/Resume processing is not installed yet","processing_started_at":"2026-10-24 15:27:27","b_items_id":null,"link_state":null},"39":{"id":39,"work_id":"inbound-b-20261024-resume-stage","status":"Held","error":"Suspend\/Resume processing is not installed yet","processing_started_at":"2026-10-24 15:27:27","b_items_id":null,"link_state":null},"40":{"id":40,"work_id":"inbound-b-20261024-correction-stage","status":"Held","error":"Correction snapshot processing is not installed yet; queue remains Pending","processing_started_at":"2026-10-24 15:27:27","b_items_id":149,"link_state":"Active"}},"logs":{"221":{"id":221,"crontasks_id":51,"crontasklogs_id":220,"date":"2026-10-24 15:27:27","state":2,"elapsed":0.0898869,"volume":16,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}

```

### Local 8 — Revoke only test profile14 current Work CREATE after admission

User context 2; exit 0.

```php
ProfileRight::updateProfileRights(14,['plugin_agentbdmosassetsync_work'=>READ]);echo json_encode(['work_right'=>READ]);
```

Result:

```text
{"work_right":1}

```

### Local 9 — IB06 submitter current Work permission revoked must Hold

User context 2; exit 0.

```php
$_SESSION['glpicronuserrunning']='AgentB scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status','error','processing_started_at','b_items_id','link_state'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC']));$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Result:

```text
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"41":{"id":41,"work_id":"inbound-b-20261024-permission-revoked","status":"Accepted"}},"after":{"41":{"id":41,"work_id":"inbound-b-20261024-permission-revoked","status":"Held","error":"Hold: Submitting profile lacks current Work authorization","processing_started_at":"2026-10-24 15:28:25","b_items_id":null,"link_state":null}},"logs":{"223":{"id":223,"crontasks_id":51,"crontasklogs_id":222,"date":"2026-10-24 15:28:25","state":2,"elapsed":0.00953293,"volume":1,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}

```

### Local 10 — Restore only test profile14 exact Work rights5

User context 2; exit 0.

```php
ProfileRight::updateProfileRights(14,['plugin_agentbdmosassetsync_work'=>READ|CREATE]);echo json_encode(['work_right'=>READ|CREATE]);
```

Result:

```text
{"work_right":5}

```

### Local 11 — IB05 changed settings after acceptance must Hold

User context 2; exit 0.

```php
$_SESSION['glpicronuserrunning']='AgentB scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status','error','processing_started_at','b_items_id','link_state'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC']));$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Result:

```text
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"42":{"id":42,"work_id":"inbound-b-20261024-settings-changed-after-accept","status":"Accepted"}},"after":{"42":{"id":42,"work_id":"inbound-b-20261024-settings-changed-after-accept","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:28:25","b_items_id":null,"link_state":null}},"logs":{"225":{"id":225,"crontasks_id":51,"crontasklogs_id":224,"date":"2026-10-24 15:28:25","state":2,"elapsed":0.0114141,"volume":1,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}

```

### Local 12 — Create isolated IB Fields container and scalar preservation fixtures plus custom definition

User context 2; exit 0.

```php
Session::changeProfile(4);$c=new PluginFieldsContainer();$cid=$c->add(['label'=>'AgentB IB X','itemtypes'=>['Computer'],'type'=>'tab','subtype'=>'','entities_id'=>0,'is_recursive'=>0,'is_active'=>1]);$rights=[];$p=new PluginFieldsProfile();foreach($p->find(['plugin_fields_containers_id'=>$cid])as$r){$rights[(int)$r['profiles_id']]=(int)$r['profiles_id']===14?CREATE:0;}PluginFieldsProfile::updateProfile(['plugin_fields_containers_id'=>$cid,'rights'=>$rights]);$defs=[];foreach(['text','textarea','number','yesno','date','datetime','dropdown']as$type){$f=new PluginFieldsField();$id=$f->add(['plugin_fields_containers_id'=>$cid,'label'=>'IB '.$type,'type'=>$type,'is_active'=>1,'is_readonly'=>0,'multiple'=>0,'mandatory'=>0]);$defs[]=$f->fields;}$f=new PluginFieldsField();$f->add(['plugin_fields_containers_id'=>$cid,'label'=>'IB multiple sibling','type'=>'dropdown','is_active'=>1,'is_readonly'=>0,'multiple'=>1,'mandatory'=>0]);$multi=$f->fields;$oType=PluginFieldsDropdown::getClassname($multi['name']);$o=new $oType();$multiId1=$o->add(['name'=>'AgentB IB Multi One','entities_id'=>0,'is_recursive'=>0]);$multiId2=$o->add(['name'=>'AgentB IB Multi Two','entities_id'=>0,'is_recursive'=>0]);$choice=array_values(array_filter($defs,fn($x)=>$x['type']==='dropdown'))[0];$oType=PluginFieldsDropdown::getClassname($choice['name']);$o=new $oType();$choiceId=$o->add(['name'=>'AgentB IB Choice','entities_id'=>0,'is_recursive'=>0]);$m=new Manufacturer();$mid=$m->add(['name'=>'AgentB IB Maker']);$d=new \Glpi\Asset\AssetDefinition();$did=$d->add(['system_name'=>'AgentBIB20261024','label'=>'AgentB IB 20261024','is_active'=>1,'profiles'=>[14=>7]]);$customDefs=[];foreach([['ib_text','StringType'],['ib_number','NumberType'],['ib_bool','BooleanType'],['ib_date','DateType'],['ib_datetime','DateTimeType'],['ib_option','DropdownType'],['ib_sibling','StringType']]as[$name,$kind]){$f=new \Glpi\Asset\CustomFieldDefinition();$f->add(['assets_assetdefinitions_id'=>$did,'system_name'=>$name,'label'=>$name,'type'=>'Glpi\\Asset\\CustomFieldType\\'.$kind,'itemtype'=>$kind==='DropdownType'?'Manufacturer':null,'field_options'=>[]]);$customDefs[]=$f->fields;}echo json_encode(['container'=>$c->fields,'rights'=>array_values($p->find(['plugin_fields_containers_id'=>$cid])),'fields'=>$defs,'multiple'=>$multi,'multiple_ids'=>[$multiId1,$multiId2],'choice_id'=>$choiceId,'manufacturer'=>$mid,'definition_id'=>$did,'custom_class'=>$d->getCustomObjectClassName(),'custom_fields'=>$customDefs]);
```

Result:

```text
{"container":{"id":7,"name":"agentbibx","label":"AgentB IB X","itemtypes":"[\"Computer\"]","type":"tab","subtype":"","entities_id":0,"is_recursive":0,"is_active":1},"rights":[{"id":65,"profiles_id":1,"plugin_fields_containers_id":7,"right":"0"},{"id":66,"profiles_id":2,"plugin_fields_containers_id":7,"right":"0"},{"id":67,"profiles_id":3,"plugin_fields_containers_id":7,"right":"0"},{"id":68,"profiles_id":4,"plugin_fields_containers_id":7,"right":"0"},{"id":69,"profiles_id":5,"plugin_fields_containers_id":7,"right":"0"},{"id":70,"profiles_id":6,"plugin_fields_containers_id":7,"right":"0"},{"id":71,"profiles_id":7,"plugin_fields_containers_id":7,"right":"0"},{"id":72,"profiles_id":8,"plugin_fields_containers_id":7,"right":"0"},{"id":73,"profiles_id":9,"plugin_fields_containers_id":7,"right":"0"},{"id":74,"profiles_id":10,"plugin_fields_containers_id":7,"right":"0"},{"id":75,"profiles_id":11,"plugin_fields_containers_id":7,"right":"0"},{"id":76,"profiles_id":12,"plugin_fields_containers_id":7,"right":"0"},{"id":77,"profiles_id":13,"plugin_fields_containers_id":7,"right":"0"},{"id":78,"profiles_id":14,"plugin_fields_containers_id":7,"right":"4"},{"id":79,"profiles_id":15,"plugin_fields_containers_id":7,"right":"0"}],"fields":[{"id":54,"name":"ibtextfield","label":"IB text","type":"text","plugin_fields_containers_id":7,"ranking":1,"default_value":null,"is_active":1,"is_readonly":0,"mandatory":0,"multiple":0,"allowed_values":null},{"id":55,"name":"ibtextareafield","label":"IB textarea","type":"textarea","plugin_fields_containers_id":7,"ranking":1,"default_value":null,"is_active":1,"is_readonly":0,"mandatory":0,"multiple":0,"allowed_values":null},{"id":56,"name":"ibnumberfield","label":"IB number","type":"number","plugin_fields_containers_id":7,"ranking":1,"default_value":null,"is_active":1,"is_readonly":0,"mandatory":0,"multiple":0,"allowed_values":null},{"id":57,"name":"ibyesnofield","label":"IB yesno","type":"yesno","plugin_fields_containers_id":7,"ranking":1,"default_value":null,"is_active":1,"is_readonly":0,"mandatory":0,"multiple":0,"allowed_values":null},{"id":58,"name":"ibdatefield","label":"IB date","type":"date","plugin_fields_containers_id":7,"ranking":1,"default_value":null,"is_active":1,"is_readonly":0,"mandatory":0,"multiple":0,"allowed_values":null},{"id":59,"name":"ibdatetimefield","label":"IB datetime","type":"datetime","plugin_fields_containers_id":7,"ranking":1,"default_value":null,"is_active":1,"is_readonly":0,"mandatory":0,"multiple":0,"allowed_values":null},{"id":60,"name":"ibdropdownfield","label":"IB dropdown","type":"dropdown","plugin_fields_containers_id":7,"ranking":1,"default_value":null,"is_active":1,"is_readonly":0,"mandatory":0,"multiple":0,"allowed_values":null}],"multiple":{"id":61,"name":"ibmultiplesiblingfield","label":"IB multiple sibling","type":"dropdown","plugin_fields_containers_id":7,"ranking":1,"default_value":"[]","is_active":1,"is_readonly":0,"mandatory":0,"multiple":1,"allowed_values":null},"multiple_ids":[1,2],"choice_id":1,"manufacturer":3,"definition_id":2,"custom_class":"Glpi\\CustomAsset\\AgentBIB20261024Asset","custom_fields":[{"id":6,"assets_assetdefinitions_id":2,"system_name":"ib_text","label":"ib_text","type":"Glpi\\Asset\\CustomFieldType\\StringType","field_options":[],"itemtype":null,"default_value":null,"translations":"[]","date_creation":"2026-10-24 15:28:59","date_mod":"2026-10-24 15:28:59"},{"id":7,"assets_assetdefinitions_id":2,"system_name":"ib_number","label":"ib_number","type":"Glpi\\Asset\\CustomFieldType\\NumberType","field_options":[],"itemtype":null,"default_value":null,"translations":"[]","date_creation":"2026-10-24 15:28:59","date_mod":"2026-10-24 15:28:59"},{"id":8,"assets_assetdefinitions_id":2,"system_name":"ib_bool","label":"ib_bool","type":"Glpi\\Asset\\CustomFieldType\\BooleanType","field_options":[],"itemtype":null,"default_value":null,"translations":"[]","date_creation":"2026-10-24 15:28:59","date_mod":"2026-10-24 15:28:59"},{"id":9,"assets_assetdefinitions_id":2,"system_name":"ib_date","label":"ib_date","type":"Glpi\\Asset\\CustomFieldType\\DateType","field_options":[],"itemtype":null,"default_value":null,"translations":"[]","date_creation":"2026-10-24 15:28:59","date_mod":"2026-10-24 15:28:59"},{"id":10,"assets_assetdefinitions_id":2,"system_name":"ib_datetime","label":"ib_datetime","type":"Glpi\\Asset\\CustomFieldType\\DateTimeType","field_options":[],"itemtype":null,"default_value":null,"translations":"[]","date_creation":"2026-10-24 15:28:59","date_mod":"2026-10-24 15:28:59"},{"id":11,"assets_assetdefinitions_id":2,"system_name":"ib_option","label":"ib_option","type":"Glpi\\Asset\\CustomFieldType\\DropdownType","field_options":[],"itemtype":"Manufacturer","default_value":null,"translations":"[]","date_creation":"2026-10-24 15:28:59","date_mod":"2026-10-24 15:28:59"},{"id":12,"assets_assetdefinitions_id":2,"system_name":"ib_sibling","label":"ib_sibling","type":"Glpi\\Asset\\CustomFieldType\\StringType","field_options":[],"itemtype":null,"default_value":null,"translations":"[]","date_creation":"2026-10-24 15:28:59","date_mod":"2026-10-24 15:28:59"}]}

```

### Local 13 — Initialize only fresh IB Fields storage and fresh local lookup options

User context 12; exit 0.

```php
$c=new PluginFieldsContainer();$c->getFromDB(7);$data=['plugin_fields_containers_id'=>7,'items_id'=>149,'itemtype'=>'Computer','entities_id'=>0,'ibtextfield'=>'IB original text','ibtextareafield'=>'IB unrelated scalar stays','ibnumberfield'=>2.5,'ibyesnofield'=>0,'ibdatefield'=>'2026-10-24','ibdatetimefield'=>'2026-10-24 10:00:00','plugin_fields_ibdropdownfielddropdowns_id'=>1,'plugin_fields_ibmultiplesiblingfielddropdowns_id'=>[1,2]];$saved=$c->updateFieldsValues($data,'Computer');$cls=PluginFieldsContainer::getClassname('Computer',$c->fields['name']);$s=new $cls();$s->getFromDBByCrit(['items_id'=>149]);echo json_encode(['saved'=>$saved,'storage_class'=>$cls,'storage'=>$s->fields]);
```

Result:

```text
{"saved":true,"storage_class":"PluginFieldsComputeragentbibx","storage":{"id":1,"items_id":149,"itemtype":"Computer","plugin_fields_containers_id":7,"entities_id":0,"ibtextfield":"IB original text","ibtextareafield":"IB unrelated scalar stays","ibnumberfield":"2.5","ibyesnofield":0,"ibdatefield":"2026-10-24","ibdatetimefield":"2026-10-24 10:00:00","plugin_fields_ibdropdownfielddropdowns_id":1,"plugin_fields_ibmultiplesiblingfielddropdowns_id":"[1,2]"}}

```

### Local 14 — Create fresh IB exact-match dropdown options only

User context 2; exit 0.

```php
Session::changeProfile(4);$l=new Location();$id=$l->add(['name'=>'AgentB IB Location','entities_id'=>0,'is_recursive'=>0]);$m=new Manufacturer();$d1=$m->add(['name'=>'AgentB IB Duplicate Maker']);$d2=$m->add(['name'=>'AgentB IB Duplicate Maker']);echo json_encode(['location_id'=>$id,'location'=>$l->fields,'duplicate_manufacturer_ids'=>[$d1,$d2]]);
```

Result:

```text
{"location_id":1,"location":{"id":1,"entities_id":0,"is_recursive":0,"name":"AgentB IB Location","code":null,"alias":null,"locations_id":0,"completename":"AgentB IB Location","comment":null,"level":1,"ancestors_cache":null,"sons_cache":null,"address":null,"postcode":null,"town":null,"state":null,"country":null,"building":null,"room":null,"latitude":null,"longitude":null,"altitude":null,"date_mod":"2026-10-24 15:29:44","date_creation":"2026-10-24 15:29:44"},"duplicate_manufacturer_ids":[4,5]}

```

### Local 15 — Create second fresh IB options to prove changed local dropdown IDs

User context 2; exit 0.

```php
Session::changeProfile(4);$m=new Manufacturer();$mid=$m->add(['name'=>'AgentB IB Maker Two']);$f=new PluginFieldsField();$f->getFromDB(60);$cl=PluginFieldsDropdown::getClassname($f->fields['name']);$o=new $cl();$oid=$o->add(['name'=>'AgentB IB Choice Two','entities_id'=>0,'is_recursive'=>0]);echo json_encode(['manufacturer'=>$mid,'fields_option'=>$oid]);
```

Result:

```text
{"manufacturer":6,"fields_option":2}

```

### Local 16 — IB generic batch queue and main History baseline

User context 12; exit 0.

```php
echo json_encode(['changes'=>countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[]),'main_history'=>countElementsInTable(Log::getTable(),['itemtype'=>'Computer','items_id'=>149])]);
```

Result:

```text
{"changes":14,"main_history":13}

```

### Local 17 — IB generic scalar conversion and Fields preservation processing

User context 2; exit 0.

```php
$_SESSION['glpicronuserrunning']='AgentB scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status','error','processing_started_at','b_items_id','link_state'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC']));$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Result:

```text
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"43":{"id":43,"work_id":"inbound-b-20261024-generic-native-fields","status":"Accepted"},"44":{"id":44,"work_id":"inbound-b-20261024-generic-custom","status":"Accepted"},"45":{"id":45,"work_id":"inbound-b-20261024-generic-monitor","status":"Accepted"}},"after":{"43":{"id":43,"work_id":"inbound-b-20261024-generic-native-fields","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:30:26","b_items_id":null,"link_state":null},"44":{"id":44,"work_id":"inbound-b-20261024-generic-custom","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:30:26","b_items_id":null,"link_state":null},"45":{"id":45,"work_id":"inbound-b-20261024-generic-monitor","status":"Held","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","processing_started_at":"2026-10-24 15:30:26","b_items_id":null,"link_state":null}},"logs":{"227":{"id":227,"crontasks_id":51,"crontasklogs_id":226,"date":"2026-10-24 15:30:26","state":2,"elapsed":0.055392,"volume":3,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}

```

### Local 18 — First actual correctly versioned generic scalar conversion execution

User context 2; exit 0.

```php
$_SESSION['glpicronuserrunning']='AgentB scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status','error','processing_started_at','b_items_id','link_state'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC']));$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Result:

```text
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"46":{"id":46,"work_id":"inbound-b-20261024-generic-native-fields-version3","status":"Accepted"},"47":{"id":47,"work_id":"inbound-b-20261024-generic-custom-version3","status":"Accepted"},"48":{"id":48,"work_id":"inbound-b-20261024-generic-monitor-version3","status":"Accepted"}},"after":{"46":{"id":46,"work_id":"inbound-b-20261024-generic-native-fields-version3","status":"Done","error":null,"processing_started_at":"2026-10-24 15:31:01","b_items_id":149,"link_state":"Active"},"47":{"id":47,"work_id":"inbound-b-20261024-generic-custom-version3","status":"Failed","error":"Save failed: local write or reread did not confirm the intended value","processing_started_at":"2026-10-24 15:31:01","b_items_id":2,"link_state":"Active"},"48":{"id":48,"work_id":"inbound-b-20261024-generic-monitor-version3","status":"Done","error":null,"processing_started_at":"2026-10-24 15:31:01","b_items_id":2,"link_state":"Active"}},"logs":{"229":{"id":229,"crontasks_id":51,"crontasklogs_id":228,"date":"2026-10-24 15:31:01","state":2,"elapsed":0.170293,"volume":3,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}

```

### Local 19 — Process compatible custom integer and bounded invalid value cases

User context 2; exit 0.

```php
$_SESSION['glpicronuserrunning']='AgentB scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status','error','processing_started_at','b_items_id','link_state'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC']));$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Result:

```text
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"49":{"id":49,"work_id":"inbound-b-20261024-custom-compatible-integer","status":"Accepted"},"50":{"id":50,"work_id":"inbound-b-20261024-partial-invalid-fields","status":"Accepted"},"51":{"id":51,"work_id":"inbound-b-20261024-ambiguous-dropdown","status":"Accepted"},"52":{"id":52,"work_id":"inbound-b-20261024-overlong-text","status":"Accepted"}},"after":{"49":{"id":49,"work_id":"inbound-b-20261024-custom-compatible-integer","status":"Done","error":null,"processing_started_at":"2026-10-24 15:33:13","b_items_id":2,"link_state":"Active"},"50":{"id":50,"work_id":"inbound-b-20261024-partial-invalid-fields","status":"Done","error":null,"processing_started_at":"2026-10-24 15:33:13","b_items_id":149,"link_state":"Active"},"51":{"id":51,"work_id":"inbound-b-20261024-ambiguous-dropdown","status":"Done","error":null,"processing_started_at":"2026-10-24 15:33:13","b_items_id":149,"link_state":"Active"},"52":{"id":52,"work_id":"inbound-b-20261024-overlong-text","status":"Done","error":null,"processing_started_at":"2026-10-24 15:33:13","b_items_id":149,"link_state":"Active"}},"logs":{"231":{"id":231,"crontasks_id":51,"crontasklogs_id":230,"date":"2026-10-24 15:33:13","state":2,"elapsed":0.122688,"volume":4,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}

```

### Local 20 — Revoke only test profile14 Computer rights for pending asset job

User context 2; exit 0.

```php
ProfileRight::updateProfileRights(14,['computer'=>0]);echo json_encode(['computer'=>0]);
```

Result:

```text
{"computer":0}

```

### Local 21 — IB06 current asset read permission prevents cron-admin escalation

User context 2; exit 0.

```php
$_SESSION['glpicronuserrunning']='AgentB scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status','error','processing_started_at','b_items_id','link_state'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC']));$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Result:

```text
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"53":{"id":53,"work_id":"inbound-b-20261024-asset-read-revoked","status":"Accepted"}},"after":{"53":{"id":53,"work_id":"inbound-b-20261024-asset-read-revoked","status":"Held","error":"Asset read permission denied or no entity scope metadata","processing_started_at":"2026-10-24 15:33:13","b_items_id":null,"link_state":null}},"logs":{"233":{"id":233,"crontasks_id":51,"crontasklogs_id":232,"date":"2026-10-24 15:33:13","state":2,"elapsed":0.00977397,"volume":1,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}

```

### Local 22 — Restore only test profile14 Computer rights7

User context 2; exit 0.

```php
ProfileRight::updateProfileRights(14,['computer'=>READ|CREATE|UPDATE]);echo json_encode(['computer'=>READ|CREATE|UPDATE]);
```

Result:

```text
{"computer":7}

```

### Local 23 — Revoke only new IB container7 profile14 write permission

User context 2; exit 0.

```php
PluginFieldsProfile::updateProfile(['plugin_fields_containers_id'=>7,'rights'=>[14=>READ]]);echo json_encode(['container'=>7,'profile'=>14,'right'=>PluginFieldsProfile::getRightOnContainer(14,7)]);
```

Result:

```text
{"container":7,"profile":14,"right":1}

```

### Local 24 — IB11 container current permission rejects field write with visible outcome

User context 2; exit 0.

```php
$_SESSION['glpicronuserrunning']='AgentB scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status','error','processing_started_at','b_items_id','link_state'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC']));$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Result:

```text
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"54":{"id":54,"work_id":"inbound-b-20261024-fields-write-revoked","status":"Accepted"}},"after":{"54":{"id":54,"work_id":"inbound-b-20261024-fields-write-revoked","status":"Done","error":null,"processing_started_at":"2026-10-24 15:34:10","b_items_id":149,"link_state":"Active"}},"logs":{"235":{"id":235,"crontasks_id":51,"crontasklogs_id":234,"date":"2026-10-24 15:34:10","state":2,"elapsed":0.027034,"volume":1,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}

```

### Local 25 — Restore only new IB container7 profile14 write permission4

User context 2; exit 0.

```php
PluginFieldsProfile::updateProfile(['plugin_fields_containers_id'=>7,'rights'=>[14=>CREATE]]);echo json_encode(['container'=>7,'profile'=>14,'right'=>PluginFieldsProfile::getRightOnContainer(14,7)]);
```

Result:

```text
{"container":7,"profile":14,"right":4}

```

### Local 26 — IB07 mark safe before-write interrupted fixture using actual local processor boundary

User context 12; exit 0.

```php
$w=new PluginAgentbdmosassetsyncWork();$ok=$w->saveProcessorFields(56,['processing_started_at'=>Session::getCurrentTime()]);$w->getFromDB(56);echo json_encode(['saved'=>$ok,'work'=>$w->fields]);
```

Result:

```text
{"saved":true,"work":{"id":56,"work_id":"inbound-b-20261024-already-started","route_id":"inbound-b-20261024-main","a_entities_id":9200,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":922001,\"b_items_id\":null,\"serial\":\"AGENTB-IB-PRIMARY\"}","a_values_json":"{\"ib_name\":\"MUST NOT REPLAY STARTED\"}","a_change_times_json":"{}","settings_version":4,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":922001,"b_items_id":null,"link_state":null,"processing_started_at":"2026-10-24 15:34:10","status":"Accepted","result_json":null,"error":null,"date_creation":"2026-10-24 15:34:10","date_mod":"2026-10-24 15:34:10","completed_at":null}}

```

### Local 27 — IB02 IB07 IB14 stage holds and interrupted fixture must not replay

User context 2; exit 0.

```php
$_SESSION['glpicronuserrunning']='AgentB scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status','error','processing_started_at','b_items_id','link_state'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC']));$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Result:

```text
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"55":{"id":55,"work_id":"inbound-b-20261024-b-both-stage","status":"Accepted"},"56":{"id":56,"work_id":"inbound-b-20261024-already-started","status":"Accepted"}},"after":{"55":{"id":55,"work_id":"inbound-b-20261024-b-both-stage","status":"Held","error":"Both conflict processing is not installed yet","processing_started_at":"2026-10-24 15:34:10","b_items_id":149,"link_state":"Active"},"56":{"id":56,"work_id":"inbound-b-20261024-already-started","status":"Held","error":"Uncertain previous processing: reconcile saved outcomes before issuing new Work","processing_started_at":"2026-10-24 15:34:10","b_items_id":null,"link_state":null}},"logs":{"237":{"id":237,"crontasks_id":51,"crontasklogs_id":236,"date":"2026-10-24 15:34:10","state":2,"elapsed":0.0257199,"volume":2,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}

```

### Local 28 — IB07 second native connection holds only global worker advisory lock until released

User context null; exit 0.

```php
require '/var/www/glpi/vendor/autoload.php';$k=new \Glpi\Kernel\Kernel();$k->boot();$r=$DB->fetchAssoc($DB->doQuery("SELECT GET_LOCK('agentbdmosassetsync-worker',0) AS acquired"));echo json_encode($r).PHP_EOL;fflush(STDOUT);if((int)$r['acquired']===1){fgets(STDIN);$r=$DB->fetchAssoc($DB->doQuery("SELECT RELEASE_LOCK('agentbdmosassetsync-worker') AS released"));echo json_encode($r).PHP_EOL;}
```

Result:

```text
{"acquired":1}
{"released":1}


```

### Local 29 — IB07 occupied worker lock skips pending job and volume stays0

User context 2; exit 0.

```php
$_SESSION['glpicronuserrunning']='AgentB scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status','error','processing_started_at','b_items_id','link_state'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC']));$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Result:

```text
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":0,"before":{"57":{"id":57,"work_id":"inbound-b-20261024-worker-lock","status":"Accepted"}},"after":{"57":{"id":57,"work_id":"inbound-b-20261024-worker-lock","status":"Accepted","error":null,"processing_started_at":null,"b_items_id":null,"link_state":null}},"logs":{"239":{"id":239,"crontasks_id":51,"crontasklogs_id":238,"date":"2026-10-24 15:34:36","state":2,"elapsed":0.00698495,"volume":0,"content":"Action completed, no processing required"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}

```

### Local 30 — IB07 released worker lock processes exact pending job once

User context 2; exit 0.

```php
$_SESSION['glpicronuserrunning']='AgentB scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status','error','processing_started_at','b_items_id','link_state'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC']));$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Result:

```text
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"57":{"id":57,"work_id":"inbound-b-20261024-worker-lock","status":"Accepted"}},"after":{"57":{"id":57,"work_id":"inbound-b-20261024-worker-lock","status":"Held","error":"Both conflict processing is not installed yet","processing_started_at":"2026-10-24 15:34:37","b_items_id":149,"link_state":"Active"}},"logs":{"241":{"id":241,"crontasks_id":51,"crontasklogs_id":240,"date":"2026-10-24 15:34:37","state":2,"elapsed":0.0253551,"volume":1,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}

```

### Local 31 — IB final read-only inventory no first copy, rights restored, History attribution and queue

User context 12; exit 0.

```php
echo json_encode(['new_computers'=>iterator_to_array($DB->request(['SELECT'=>['id','name','serial'],'FROM'=>Computer::getTable(),'WHERE'=>['id'=>['>',148]],'ORDER'=>'id ASC'])),'no_first_copy'=>countElementsInTable(Computer::getTable(),['serial'=>'AGENTB-IB-NO-ASSET']),'queue_count'=>countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[]),'computer_history'=>iterator_to_array($DB->request(['FROM'=>Log::getTable(),'WHERE'=>['itemtype'=>'Computer','items_id'=>149],'ORDER'=>'id ASC'])),'new_profile_rights'=>iterator_to_array($DB->request(['FROM'=>ProfileRight::getTable(),'WHERE'=>['profiles_id'=>14,'name'=>['computer','plugin_agentbdmosassetsync_work']]])),'new_container_right'=>PluginFieldsProfile::getRightOnContainer(14,7),'accepted_work_count'=>countElementsInTable(PluginAgentbdmosassetsyncWork::getTable(),['status'=>'Accepted'])]);
```

Result:

```text
{"new_computers":{"149":{"id":149,"name":"AgentB IB partial valid sibling","serial":"AGENTB-IB-RENAMED"},"150":{"id":150,"name":"AgentB IB duplicate one","serial":"AGENTB-IB-DUP"},"151":{"id":151,"name":"AgentB IB duplicate two","serial":"AGENTB-IB-DUP"}},"no_first_copy":0,"queue_count":14,"computer_history":{"139071":{"id":139071,"itemtype":"Computer","items_id":149,"itemtype_link":"0","linked_action":20,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:26:22","id_search_option":0,"old_value":"","new_value":"","old_id":null,"new_id":null},"139074":{"id":139074,"itemtype":"Computer","items_id":149,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:26:22","id_search_option":1,"old_value":"AgentB IB primary before","new_value":"AgentB IB applied by worker","old_id":null,"new_id":null},"139098":{"id":139098,"itemtype":"Computer","items_id":149,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:27:27","id_search_option":1,"old_value":"AgentB IB applied by worker","new_value":"AgentB IB genuine immediate edit","old_id":null,"new_id":null},"139099":{"id":139099,"itemtype":"Computer","items_id":149,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:27:27","id_search_option":5,"old_value":"AGENTB-IB-PRIMARY","new_value":"AGENTB-IB-RENAMED","old_id":null,"new_id":null},"139100":{"id":139100,"itemtype":"Computer","items_id":149,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:27:27","id_search_option":1,"old_value":"AgentB IB genuine immediate edit","new_value":"AgentB IB retained link write","old_id":null,"new_id":null},"139195":{"id":139195,"itemtype":"Computer","items_id":149,"itemtype_link":"PluginFieldsComputeragentbibx","linked_action":17,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:29:44","id_search_option":0,"old_value":"","new_value":"N\/A (1)","old_id":null,"new_id":null},"139196":{"id":139196,"itemtype":"Computer","items_id":149,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:29:44","id_search_option":76719,"old_value":"N\/A","new_value":"IB original text","old_id":null,"new_id":null},"139197":{"id":139197,"itemtype":"Computer","items_id":149,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:29:44","id_search_option":76720,"old_value":"N\/A","new_value":"IB unrelated scalar stays","old_id":null,"new_id":null},"139198":{"id":139198,"itemtype":"Computer","items_id":149,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:29:44","id_search_option":76721,"old_value":"N\/A","new_value":"2.5","old_id":null,"new_id":null},"139199":{"id":139199,"itemtype":"Computer","items_id":149,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:29:44","id_search_option":76723,"old_value":"N\/A","new_value":"2026-10-24","old_id":null,"new_id":null},"139200":{"id":139200,"itemtype":"Computer","items_id":149,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:29:44","id_search_option":76724,"old_value":"N\/A","new_value":"2026-10-24 10:00:00","old_id":null,"new_id":null},"139201":{"id":139201,"itemtype":"Computer","items_id":149,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:29:44","id_search_option":76725,"old_value":"","new_value":"AgentB IB Choice","old_id":null,"new_id":null},"139202":{"id":139202,"itemtype":"Computer","items_id":149,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:29:44","id_search_option":0,"old_value":"N\/A","new_value":"","old_id":null,"new_id":null},"139246":{"id":139246,"itemtype":"Computer","items_id":149,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:31:01","id_search_option":1,"old_value":"AgentB IB retained link write","new_value":"AgentB IB generic native result","old_id":null,"new_id":null},"139247":{"id":139247,"itemtype":"Computer","items_id":149,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:31:01","id_search_option":16,"old_value":"","new_value":"AgentB IB readable source label","old_id":null,"new_id":null},"139248":{"id":139248,"itemtype":"Computer","items_id":149,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:31:01","id_search_option":23,"old_value":" (0)","new_value":"AgentB IB Maker (3)","old_id":0,"new_id":3},"139249":{"id":139249,"itemtype":"Computer","items_id":149,"itemtype_link":"PluginFieldsComputeragentbibx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:31:01","id_search_option":0,"old_value":"IB original text","new_value":"IB fields written by worker","old_id":null,"new_id":null},"139250":{"id":139250,"itemtype":"Computer","items_id":149,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:31:01","id_search_option":76719,"old_value":"IB original text","new_value":"IB fields written by worker","old_id":null,"new_id":null},"139251":{"id":139251,"itemtype":"Computer","items_id":149,"itemtype_link":"PluginFieldsComputeragentbibx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:31:01","id_search_option":0,"old_value":"2.5","new_value":"12.5","old_id":null,"new_id":null},"139252":{"id":139252,"itemtype":"Computer","items_id":149,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:31:01","id_search_option":76721,"old_value":"2.5","new_value":"12.5","old_id":null,"new_id":null},"139253":{"id":139253,"itemtype":"Computer","items_id":149,"itemtype_link":"PluginFieldsComputeragentbibx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:31:01","id_search_option":0,"old_value":"0","new_value":"1","old_id":null,"new_id":null},"139254":{"id":139254,"itemtype":"Computer","items_id":149,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:31:01","id_search_option":76722,"old_value":"No","new_value":"Yes","old_id":null,"new_id":null},"139255":{"id":139255,"itemtype":"Computer","items_id":149,"itemtype_link":"PluginFieldsComputeragentbibx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:31:01","id_search_option":0,"old_value":"2026-10-24","new_value":"2026-10-26","old_id":null,"new_id":null},"139256":{"id":139256,"itemtype":"Computer","items_id":149,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:31:01","id_search_option":76723,"old_value":"2026-10-24","new_value":"2026-10-26","old_id":null,"new_id":null},"139257":{"id":139257,"itemtype":"Computer","items_id":149,"itemtype_link":"PluginFieldsComputeragentbibx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:31:01","id_search_option":0,"old_value":"2026-10-24 10:00:00","new_value":"2026-10-26 14:15:16","old_id":null,"new_id":null},"139258":{"id":139258,"itemtype":"Computer","items_id":149,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:31:01","id_search_option":76724,"old_value":"2026-10-24 10:00:00","new_value":"2026-10-26 14:15:16","old_id":null,"new_id":null},"139259":{"id":139259,"itemtype":"Computer","items_id":149,"itemtype_link":"PluginFieldsComputeragentbibx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:31:01","id_search_option":0,"old_value":"1","new_value":"2","old_id":null,"new_id":null},"139260":{"id":139260,"itemtype":"Computer","items_id":149,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:31:01","id_search_option":76725,"old_value":"AgentB IB Choice","new_value":"AgentB IB Choice Two","old_id":null,"new_id":null},"139316":{"id":139316,"itemtype":"Computer","items_id":149,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:33:13","id_search_option":1,"old_value":"AgentB IB generic native result","new_value":"AgentB IB partial valid sibling","old_id":null,"new_id":null}},"new_profile_rights":{"1354":{"id":1354,"profiles_id":14,"name":"computer","rights":7},"1401":{"id":1401,"profiles_id":14,"name":"plugin_agentbdmosassetsync_work","rights":5}},"new_container_right":4,"accepted_work_count":0}

```

