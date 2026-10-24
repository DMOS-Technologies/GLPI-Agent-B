# Agent B first-copy (c) manual runtime evidence

Date: 2026-10-24, Asia/Brunei (+08:00). GLPI B 11.0.7, Fields 1.24.4, localhost:8081. One bounded manual pass: **23 curl requests and 10 local native PHP invocations**. No code defect or retry occurred. Deployed only approved candidate inc/process.php, inc/write.php, inc/work.class.php, inc/firstcopy.php from agentb-inbound-c. No schema/install/other deployment.

## Outcome and fixtures

Ten admitted Works 59–68: Done 59,60,65; Failed64; Held61,62,63,66,67,68. All ten immutable submitted input sets were reconciled with final GET (call17): zero mismatches. Fresh Setting13 route inbound-c-20261024-main A9400/B0 finished disabled/version3 (call22). Computers153 and154 are the only new native assets. Custom requested definition3 (Glpi\CustomAsset\AgentBICReq20261024Asset) asset4 was created despite same serial AGENTB-IC-SHARED existing solely in other definition4 (Glpi\CustomAsset\AgentBICOther20261024Asset) asset3. Other asset3 unchanged and unlinked. New custom virtual field IDs13–17; Manufacturer7; Fields containers8/9 with fields62–66.

First-copy seeded all enabled supported supplied A/B/Both mappings. Work59 grouped two mandatory Fields values in initial container8 and mandatory later-container9 value, all verified; Work60 seeded generic virtual text/dropdown/datetime fields, virtual local datetime 2026-10-24 17:18:19 with raw UTC09:18:19. Optional Fields metadata default strings are not claimed applied: omitted raw storage columns are null; no fabricated default values. Sources B/Both were seeded once regardless unreliable/null time evidence. Disabled/unmapped payloads did not write and absent mapped value reported Skipped.

Work61 reused asset153 and did not reseed. After genuine native serial/name edit (curl10), Work63 reused retained asset153 despite old identity serial; native A name changed, created_b_items_id null, original B/Both/native/Fields seeds survived. Both Works honestly Held because later B-return/Both existing-asset processing is not yet installed. Work62 competing source Held with no verified link/create. Work66 claimed other-definition B3 Held for missing retained evidence. Direct read-only helper check (local10) confirms core getFromDB(3) can load wrong definition4 through requested class, and plugin check_asset rejects it: Asset concrete itemtype does not match requested type. No persistent identities were forged.

Work64 omitted a mandatory first-container Fields input: real native add declined, Failed with Save failed: GLPI declined first-copy creation; final inventory confirms no failure serial asset or orphan Fields rows. No b_items_id/link/created ID claimed. Work65 missing dropdown option Skipped with exact reason, valid siblings created Computer154, manufacturers_id remained0; no dropdown option created. Work67 admitted under CREATE, then only fresh profile14 Computer mask changed7→3 before native worker: Held lacks current asset CREATE permission, no asset; restored7. Work68 admitted version1, route moved version2 before processing: Held current route/version mismatch, no asset.

Guard/History: queue baseline15; all sync first-copy/Fields/custom/update operations added zero rows. Only genuine native edit added Pending Change16 linked A944001/B153, immutable original edit values retained even after later sync name change. Prior Pending10–13/15 unchanged. Native creation/Fields/update History identifies service user12; exact concrete custom-type Log query returned no rows, so this pass does not claim a custom History row. Native worker context user2/profile4/cron restored after success and failure; scoped task volumes4,4,1,1, task ready state1.

Containment: Setting13 disabledv3; Computer right7 restored. Only new Fields container associations initialized: all profiles0 except profile14 right4, exact readback local10. All fixtures preserved; no delete/purge/raw DML/old plugin operations. Session created call1 closed call23. Prior routes and Work fixtures untouched.

## Matrix boundaries

| Case | Result | Evidence / limit |
|---|---|---|
| IC01 | PASS | Fresh positive zero native/requested concrete lookup local2, Accepted before runner call5, actual creates59/60 and verified results. |
| IC02 | PASS | All A/B/Both enabled supplied values once; disabled/unmapped ignored; absent mapping Skipped; immutable inputs unchanged. |
| IC03 | PASS representative | Native text/dropdown, virtual text/dropdown/datetime, two actual grouped mandatory Fields containers. Not all scalar permutations. |
| IC04 | PASS representative | Work65 nonexistent destination option skipped and siblings succeed; mandatory rejection64 honest rollback. Prior Setting admission metadata coverage retained, not repeated. |
| IC05 | PASS representative + prior IB | Work62 competing source; Work66 claimed B ID; real two-definition shared-table proof; wrong loaded type helper rejects. Missing/duplicate/incomplete general lookups already IB; not repeated. |
| IC06 | PASS representative | Current CREATE revoked after admission67; current settings changed68; zero forbidden assets. Other existing IB scope coverage not repeated. |
| IC07 | PASS | Works61/63 reuse153, serial genuinely changed, no reseed/no second add; later B/Both remains Held. |
| IC08 | PASS sequential boundary; concurrency SOURCE ONLY | Same-source59→61 creates once; different-source62 holds. No extra concurrent create race injection performed; one-worker/route lock source reviewed. |
| IC09 | PASS definite rejection | Mandatory Fields add rejection64; actual inventory no rolled-back asset/storage, honest Failed and no confirmed ID. Later batches never reopen terminal Works. |
| IC10 | NOT RUN / source only | No safe real after-add interruption hook or commit-failure injector. No destructive injection or false uncertainty proof. Prior durable-start boundary IB remains separate evidence. |
| IC11 | PASS representative | Native/custom/Fields guard and queue count; genuine edit Change16; native History user12; restored worker context. Concrete custom History query empty, no claim. |
| IC12 | PASS stage boundary / future variants NOT RUN | B/Both Held61/63; empty returned/covered/handled outputs, Pending rows unchanged. Suspend/Resume and correction completion not implemented in this part, not exercised. |

## Request protocol

Every curl used Accept: application/json, Content-Type: application/json and App-Token: [REDACTED]. initSession used Authorization: user_token [REDACTED]; remaining calls used Session-Token: [REDACTED]. Account user12/profile14/entity0 nonrecursive. Exact native wrappers below are actual responses. Local PHP invokes real GLPI kernel/Auth/Session/Plugin initialization as specified user, no HTTP route or regression harness; local worker only CronTask51, not full GLPI cron.

## Complete curl ledger

### Curl 1 — IC restricted login after new definition rights initialization

GET http://localhost:8081/api.php/v1/initSession

Account: service (user12/profile14/entity0). HTTP 200

Body:
```json
null
```

Response:
```json
{
  "session_token": "[REDACTED]"
}
```

### Curl 2 — IC03 real other concrete definition same shared-table serial fixture

POST http://localhost:8081/api.php/v1/Glpi%5CCustomAsset%5CAgentBICOther20261024Asset

Account: service (user12/profile14/entity0). HTTP 201

Body:
```json
{
  "input": {
    "name": "AgentB IC other definition must stay",
    "serial": "AGENTB-IC-SHARED",
    "entities_id": 0
  }
}
```

Response:
```json
{
  "id": 3,
  "message": "Item successfully added: AgentB IC other definition must stay"
}
```

### Curl 3 — IC supported first-copy native Fields and custom mappings route

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting

Account: service (user12/profile14/entity0). HTTP 201

Body:
```json
{
  "input": {
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "route_enabled": 1,
    "settings_version": 1,
    "enabled_itemtypes_json": "[\"Computer\",\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\"]",
    "field_mappings_json": "[{\"mapping_id\":\"ic_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_serial\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"serial\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_b_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"comment\"},\"source\":\"B\",\"value_mode\":\"dropdown_label_to_text\"},{\"mapping_id\":\"ic_both_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"manufacturers_id\"},\"source\":\"B\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"ic_absent\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"otherserial\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_disabled\",\"itemtype\":\"Computer\",\"enabled\":false,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact_num\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_fields_one\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbicx\",\"name\":\"icreqonefield\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_fields_two\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbicx\",\"name\":\"icreqtwofield\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_fields_later\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbicy\",\"name\":\"iclaterreqfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_custom_name\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_custom_serial\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"serial\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_custom_a\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_a\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_custom_b\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_b\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_custom_both\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_both\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_custom_option\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_option\"},\"source\":\"Both\",\"value_mode\":\"dropdown_label_to_dropdown\"},{\"mapping_id\":\"ic_custom_datetime\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_datetime\"},\"source\":\"B\",\"value_mode\":\"direct\"}]"
  }
}
```

Response:
```json
{
  "id": 13,
  "message": ""
}
```

### Curl 4 — IC01 IC02 IC03 IC08 first-copy and same-source ownership batch

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account: service (user12/profile14/entity0). HTTP 201

Body:
```json
{
  "input": [
    {
      "work_id": "inbound-c-20261024-native-grouped-first",
      "route_id": "inbound-c-20261024-main",
      "a_entities_id": 9400,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":944001,\"b_items_id\":null,\"serial\":\"AGENTB-IC-NATIVE\"}",
      "a_values_json": "{\"ic_name\":\"AgentB IC native first copy\",\"ic_serial\":\"AGENTB-IC-NATIVE\",\"ic_b_text\":\"AgentB IC B owned label seed\",\"ic_both_text\":\"AgentB IC Both seed\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
      "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
      "settings_version": 1
    },
    {
      "work_id": "inbound-c-20261024-custom-concrete-first",
      "route_id": "inbound-c-20261024-main",
      "a_entities_id": 9400,
      "entities_id": 0,
      "itemtype": "Glpi\\CustomAsset\\AgentBICReq20261024Asset",
      "identity_json": "{\"a_items_id\":944101,\"b_items_id\":null,\"serial\":\"AGENTB-IC-SHARED\"}",
      "a_values_json": "{\"ic_custom_name\":\"AgentB IC requested concrete first copy\",\"ic_custom_serial\":\"AGENTB-IC-SHARED\",\"ic_custom_a\":\"IC A source seed\",\"ic_custom_b\":\"IC B source seed\",\"ic_custom_both\":\"IC Both source seed\",\"ic_custom_option\":\"AgentB IC Maker\",\"ic_custom_datetime\":\"2026-10-24 17:18:19\"}",
      "a_change_times_json": "{}",
      "settings_version": 1
    },
    {
      "work_id": "inbound-c-20261024-same-source-second",
      "route_id": "inbound-c-20261024-main",
      "a_entities_id": 9400,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":944001,\"b_items_id\":null,\"serial\":\"AGENTB-IC-NATIVE\"}",
      "a_values_json": "{\"ic_name\":\"AgentB IC native first copy\",\"ic_serial\":\"AGENTB-IC-NATIVE\",\"ic_b_text\":\"MUST NOT RESEED B\",\"ic_both_text\":\"MUST NOT RESEED BOTH\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
      "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
      "settings_version": 1
    },
    {
      "work_id": "inbound-c-20261024-competing-source",
      "route_id": "inbound-c-20261024-main",
      "a_entities_id": 9400,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":944002,\"b_items_id\":null,\"serial\":\"AGENTB-IC-NATIVE\"}",
      "a_values_json": "{\"ic_name\":\"AgentB IC native first copy\",\"ic_serial\":\"AGENTB-IC-NATIVE\",\"ic_b_text\":\"AgentB IC B owned label seed\",\"ic_both_text\":\"AgentB IC Both seed\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
      "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
      "settings_version": 1
    }
  ]
}
```

Response:
```json
[
  {
    "id": 59,
    "message": ""
  },
  {
    "id": 60,
    "message": ""
  },
  {
    "id": 61,
    "message": ""
  },
  {
    "id": 62,
    "message": ""
  }
]
```

### Curl 5 — IC Accepted rows before background add

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork?searchText%5Bwork_id%5D=%5Einbound-c-20261024-&range=0-99&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false

Account: service (user12/profile14/entity0). HTTP 200

Body:
```json
null
```

Response:
```json
[
  {
    "id": 59,
    "work_id": "inbound-c-20261024-native-grouped-first",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":944001,\"b_items_id\":null,\"serial\":\"AGENTB-IC-NATIVE\"}",
    "a_values_json": "{\"ic_name\":\"AgentB IC native first copy\",\"ic_serial\":\"AGENTB-IC-NATIVE\",\"ic_b_text\":\"AgentB IC B owned label seed\",\"ic_both_text\":\"AgentB IC Both seed\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
    "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 944001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": null,
    "status": "Accepted",
    "result_json": null,
    "error": null,
    "date_creation": "2026-10-24 15:55:41",
    "date_mod": "2026-10-24 15:55:41",
    "completed_at": null
  },
  {
    "id": 60,
    "work_id": "inbound-c-20261024-custom-concrete-first",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBICReq20261024Asset",
    "identity_json": "{\"a_items_id\":944101,\"b_items_id\":null,\"serial\":\"AGENTB-IC-SHARED\"}",
    "a_values_json": "{\"ic_custom_name\":\"AgentB IC requested concrete first copy\",\"ic_custom_serial\":\"AGENTB-IC-SHARED\",\"ic_custom_a\":\"IC A source seed\",\"ic_custom_b\":\"IC B source seed\",\"ic_custom_both\":\"IC Both source seed\",\"ic_custom_option\":\"AgentB IC Maker\",\"ic_custom_datetime\":\"2026-10-24 17:18:19\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 944101,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": null,
    "status": "Accepted",
    "result_json": null,
    "error": null,
    "date_creation": "2026-10-24 15:55:41",
    "date_mod": "2026-10-24 15:55:41",
    "completed_at": null
  },
  {
    "id": 61,
    "work_id": "inbound-c-20261024-same-source-second",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":944001,\"b_items_id\":null,\"serial\":\"AGENTB-IC-NATIVE\"}",
    "a_values_json": "{\"ic_name\":\"AgentB IC native first copy\",\"ic_serial\":\"AGENTB-IC-NATIVE\",\"ic_b_text\":\"MUST NOT RESEED B\",\"ic_both_text\":\"MUST NOT RESEED BOTH\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
    "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 944001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": null,
    "status": "Accepted",
    "result_json": null,
    "error": null,
    "date_creation": "2026-10-24 15:55:41",
    "date_mod": "2026-10-24 15:55:41",
    "completed_at": null
  },
  {
    "id": 62,
    "work_id": "inbound-c-20261024-competing-source",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":944002,\"b_items_id\":null,\"serial\":\"AGENTB-IC-NATIVE\"}",
    "a_values_json": "{\"ic_name\":\"AgentB IC native first copy\",\"ic_serial\":\"AGENTB-IC-NATIVE\",\"ic_b_text\":\"AgentB IC B owned label seed\",\"ic_both_text\":\"AgentB IC Both seed\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
    "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 944002,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": null,
    "status": "Accepted",
    "result_json": null,
    "error": null,
    "date_creation": "2026-10-24 15:55:41",
    "date_mod": "2026-10-24 15:55:41",
    "completed_at": null
  }
]
```

### Curl 6 — IC first-copy exact created IDs and seed outcomes

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork?searchText%5Bwork_id%5D=%5Einbound-c-20261024-&range=0-99&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false

Account: service (user12/profile14/entity0). HTTP 200

Body:
```json
null
```

Response:
```json
[
  {
    "id": 59,
    "work_id": "inbound-c-20261024-native-grouped-first",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":944001,\"b_items_id\":null,\"serial\":\"AGENTB-IC-NATIVE\"}",
    "a_values_json": "{\"ic_name\":\"AgentB IC native first copy\",\"ic_serial\":\"AGENTB-IC-NATIVE\",\"ic_b_text\":\"AgentB IC B owned label seed\",\"ic_both_text\":\"AgentB IC Both seed\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
    "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 944001,
    "b_items_id": 153,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:55:41",
    "status": "Done",
    "result_json": "{\"b_items_id\":153,\"created_b_items_id\":153,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ic_absent\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled first-copy mapping\"},{\"mapping_id\":\"ic_name\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_serial\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_b_text\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_both_text\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_option\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_fields_one\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_fields_two\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_fields_later\",\"outcome\":\"AppliedToB\",\"reason\":null}]}",
    "error": null,
    "date_creation": "2026-10-24 15:55:41",
    "date_mod": "2026-10-24 15:55:41",
    "completed_at": "2026-10-24 15:55:41"
  },
  {
    "id": 60,
    "work_id": "inbound-c-20261024-custom-concrete-first",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBICReq20261024Asset",
    "identity_json": "{\"a_items_id\":944101,\"b_items_id\":null,\"serial\":\"AGENTB-IC-SHARED\"}",
    "a_values_json": "{\"ic_custom_name\":\"AgentB IC requested concrete first copy\",\"ic_custom_serial\":\"AGENTB-IC-SHARED\",\"ic_custom_a\":\"IC A source seed\",\"ic_custom_b\":\"IC B source seed\",\"ic_custom_both\":\"IC Both source seed\",\"ic_custom_option\":\"AgentB IC Maker\",\"ic_custom_datetime\":\"2026-10-24 17:18:19\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 944101,
    "b_items_id": 4,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:55:41",
    "status": "Done",
    "result_json": "{\"b_items_id\":4,\"created_b_items_id\":4,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ic_custom_name\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_custom_serial\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_custom_a\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_custom_b\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_custom_both\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_custom_option\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_custom_datetime\",\"outcome\":\"AppliedToB\",\"reason\":null}]}",
    "error": null,
    "date_creation": "2026-10-24 15:55:41",
    "date_mod": "2026-10-24 15:55:41",
    "completed_at": "2026-10-24 15:55:41"
  },
  {
    "id": 61,
    "work_id": "inbound-c-20261024-same-source-second",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":944001,\"b_items_id\":null,\"serial\":\"AGENTB-IC-NATIVE\"}",
    "a_values_json": "{\"ic_name\":\"AgentB IC native first copy\",\"ic_serial\":\"AGENTB-IC-NATIVE\",\"ic_b_text\":\"MUST NOT RESEED B\",\"ic_both_text\":\"MUST NOT RESEED BOTH\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
    "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 944001,
    "b_items_id": 153,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:55:41",
    "status": "Held",
    "result_json": "{\"b_items_id\":153,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ic_name\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ic_serial\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ic_b_text\",\"outcome\":\"Skipped\",\"reason\":\"B return processing is not installed yet\"},{\"mapping_id\":\"ic_both_text\",\"outcome\":\"Skipped\",\"reason\":\"Both conflict processing is not installed yet\"},{\"mapping_id\":\"ic_option\",\"outcome\":\"Skipped\",\"reason\":\"B return processing is not installed yet\"},{\"mapping_id\":\"ic_absent\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ic_fields_one\",\"outcome\":\"Skipped\",\"reason\":\"B return processing is not installed yet\"},{\"mapping_id\":\"ic_fields_two\",\"outcome\":\"Skipped\",\"reason\":\"Both conflict processing is not installed yet\"},{\"mapping_id\":\"ic_fields_later\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}",
    "error": "Both conflict processing is not installed yet",
    "date_creation": "2026-10-24 15:55:41",
    "date_mod": "2026-10-24 15:55:41",
    "completed_at": null
  },
  {
    "id": 62,
    "work_id": "inbound-c-20261024-competing-source",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":944002,\"b_items_id\":null,\"serial\":\"AGENTB-IC-NATIVE\"}",
    "a_values_json": "{\"ic_name\":\"AgentB IC native first copy\",\"ic_serial\":\"AGENTB-IC-NATIVE\",\"ic_b_text\":\"AgentB IC B owned label seed\",\"ic_both_text\":\"AgentB IC Both seed\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
    "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 944002,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:55:41",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "B asset has competing retained source ownership",
    "date_creation": "2026-10-24 15:55:41",
    "date_mod": "2026-10-24 15:55:41",
    "completed_at": null
  }
]
```

### Curl 7 — IC native first-copy values all-source seed readback

GET http://localhost:8081/api.php/v1/Computer/153?get_hateoas=false&expand_dropdowns=false

Account: service (user12/profile14/entity0). HTTP 200

Body:
```json
null
```

Response:
```json
{
  "id": 153,
  "entities_id": 0,
  "name": "AgentB IC native first copy",
  "serial": "AGENTB-IC-NATIVE",
  "otherserial": null,
  "contact": "AgentB IC Both seed",
  "contact_num": null,
  "users_id_tech": 0,
  "comment": "AgentB IC B owned label seed",
  "date_mod": "2026-10-24 15:55:41",
  "autoupdatesystems_id": 0,
  "locations_id": 0,
  "networks_id": 0,
  "computermodels_id": 0,
  "computertypes_id": 0,
  "is_template": 0,
  "template_name": null,
  "manufacturers_id": 7,
  "is_deleted": 0,
  "is_dynamic": 0,
  "users_id": 0,
  "states_id": 0,
  "ticket_tco": "0.0000",
  "uuid": null,
  "date_creation": "2026-10-24 15:55:41",
  "is_recursive": 0,
  "last_inventory_update": null,
  "last_boot": null,
  "groups_id": [],
  "groups_id_tech": []
}
```

### Curl 8 — IC requested concrete custom values raw and virtual readback

GET http://localhost:8081/api.php/v1/Glpi%5CCustomAsset%5CAgentBICReq20261024Asset/4?get_hateoas=false&expand_dropdowns=false

Account: service (user12/profile14/entity0). HTTP 200

Body:
```json
null
```

Response:
```json
{
  "id": 4,
  "assets_assetdefinitions_id": 3,
  "assets_assetmodels_id": 0,
  "assets_assettypes_id": 0,
  "name": "AgentB IC requested concrete first copy",
  "uuid": null,
  "comment": null,
  "serial": "AGENTB-IC-SHARED",
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
  "date_creation": "2026-10-24 15:55:41",
  "date_mod": "2026-10-24 15:55:41",
  "last_inventory_update": null,
  "custom_fields": "{\"13\": \"IC A source seed\", \"14\": \"IC B source seed\", \"15\": \"IC Both source seed\", \"16\": 7, \"17\": \"2026-10-24 09:18:19\"}",
  "groups_id": [],
  "groups_id_tech": [],
  "custom_ic_a": "IC A source seed",
  "custom_ic_b": "IC B source seed",
  "custom_ic_both": "IC Both source seed",
  "custom_ic_datetime": "2026-10-24 17:18:19",
  "custom_ic_option": 7
}
```

### Curl 9 — IC other concrete same-serial asset unchanged and distinct

GET http://localhost:8081/api.php/v1/Glpi%5CCustomAsset%5CAgentBICOther20261024Asset/3?get_hateoas=false&expand_dropdowns=false

Account: service (user12/profile14/entity0). HTTP 200

Body:
```json
null
```

Response:
```json
{
  "id": 3,
  "assets_assetdefinitions_id": 4,
  "assets_assetmodels_id": 0,
  "assets_assettypes_id": 0,
  "name": "AgentB IC other definition must stay",
  "uuid": null,
  "comment": null,
  "serial": "AGENTB-IC-SHARED",
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
  "date_creation": "2026-10-24 15:54:53",
  "date_mod": "2026-10-24 15:54:53",
  "last_inventory_update": null,
  "custom_fields": "[]",
  "groups_id": [],
  "groups_id_tech": []
}
```

### Curl 10 — IC07 IC11 immediate genuine edit and serial change after first-copy guard

PUT http://localhost:8081/api.php/v1/Computer/153

Account: service (user12/profile14/entity0). HTTP 200

Body:
```json
{
  "input": {
    "id": 153,
    "name": "AgentB IC genuine after creation",
    "serial": "AGENTB-IC-NATIVE-CHANGED"
  }
}
```

Response:
```json
[
  {
    "153": true,
    "message": ""
  }
]
```

### Curl 11 — IC07 next ordinary Sync uses retained link despite old identity serial

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account: service (user12/profile14/entity0). HTTP 201

Body:
```json
{
  "input": {
    "work_id": "inbound-c-20261024-reuse-after-serial-change",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":944001,\"b_items_id\":null,\"serial\":\"AGENTB-IC-NATIVE\"}",
    "a_values_json": "{\"ic_name\":\"AgentB IC regular Sync after first copy\",\"ic_serial\":\"AGENTB-IC-NATIVE-CHANGED\",\"ic_b_text\":\"MUST NOT RESEED B AFTER SERIAL\",\"ic_both_text\":\"MUST NOT RESEED BOTH AFTER SERIAL\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"MUST NOT RESEED B FIELD\",\"ic_fields_two\":\"MUST NOT RESEED BOTH FIELD\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
    "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
    "settings_version": 1
  }
}
```

Response:
```json
{
  "id": 63,
  "message": ""
}
```

### Curl 12 — IC04 IC05 IC09 bounded mandatory rollback option skip and wrong concrete claim

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account: service (user12/profile14/entity0). HTTP 201

Body:
```json
{
  "input": [
    {
      "work_id": "inbound-c-20261024-mandatory-firstcopy-failure",
      "route_id": "inbound-c-20261024-main",
      "a_entities_id": 9400,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":944003,\"b_items_id\":null,\"serial\":\"AGENTB-IC-MANDATORY-FAIL\"}",
      "a_values_json": "{\"ic_name\":\"AgentB IC mandatory failure must rollback\",\"ic_serial\":\"AGENTB-IC-MANDATORY-FAIL\",\"ic_b_text\":\"AgentB IC B owned label seed\",\"ic_both_text\":\"AgentB IC Both seed\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
      "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
      "settings_version": 1
    },
    {
      "work_id": "inbound-c-20261024-missing-option-skip",
      "route_id": "inbound-c-20261024-main",
      "a_entities_id": 9400,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":944004,\"b_items_id\":null,\"serial\":\"AGENTB-IC-SKIP-OPTION\"}",
      "a_values_json": "{\"ic_name\":\"AgentB IC skipped option first copy\",\"ic_serial\":\"AGENTB-IC-SKIP-OPTION\",\"ic_b_text\":\"AgentB IC B owned label seed\",\"ic_both_text\":\"AgentB IC Both seed\",\"ic_option\":\"AgentB IC nonexistent option\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
      "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
      "settings_version": 1
    },
    {
      "work_id": "inbound-c-20261024-unverified-other-concrete-claim",
      "route_id": "inbound-c-20261024-main",
      "a_entities_id": 9400,
      "entities_id": 0,
      "itemtype": "Glpi\\CustomAsset\\AgentBICReq20261024Asset",
      "identity_json": "{\"a_items_id\":944199,\"b_items_id\":3,\"serial\":\"AGENTB-IC-SHARED\"}",
      "a_values_json": "{\"ic_custom_name\":\"AgentB IC requested concrete first copy\",\"ic_custom_serial\":\"AGENTB-IC-SHARED\",\"ic_custom_a\":\"IC A source seed\",\"ic_custom_b\":\"IC B source seed\",\"ic_custom_both\":\"IC Both source seed\",\"ic_custom_option\":\"AgentB IC Maker\",\"ic_custom_datetime\":\"2026-10-24 17:18:19\"}",
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
    "id": 64,
    "message": ""
  },
  {
    "id": 65,
    "message": ""
  },
  {
    "id": 66,
    "message": ""
  }
]
```

### Curl 13 — IC exact reuse definite failure skip and concrete-claim outcomes

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork?searchText%5Bwork_id%5D=%5Einbound-c-20261024-&range=0-99&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false

Account: service (user12/profile14/entity0). HTTP 200

Body:
```json
null
```

Response:
```json
[
  {
    "id": 59,
    "work_id": "inbound-c-20261024-native-grouped-first",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":944001,\"b_items_id\":null,\"serial\":\"AGENTB-IC-NATIVE\"}",
    "a_values_json": "{\"ic_name\":\"AgentB IC native first copy\",\"ic_serial\":\"AGENTB-IC-NATIVE\",\"ic_b_text\":\"AgentB IC B owned label seed\",\"ic_both_text\":\"AgentB IC Both seed\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
    "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 944001,
    "b_items_id": 153,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:55:41",
    "status": "Done",
    "result_json": "{\"b_items_id\":153,\"created_b_items_id\":153,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ic_absent\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled first-copy mapping\"},{\"mapping_id\":\"ic_name\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_serial\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_b_text\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_both_text\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_option\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_fields_one\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_fields_two\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_fields_later\",\"outcome\":\"AppliedToB\",\"reason\":null}]}",
    "error": null,
    "date_creation": "2026-10-24 15:55:41",
    "date_mod": "2026-10-24 15:55:41",
    "completed_at": "2026-10-24 15:55:41"
  },
  {
    "id": 60,
    "work_id": "inbound-c-20261024-custom-concrete-first",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBICReq20261024Asset",
    "identity_json": "{\"a_items_id\":944101,\"b_items_id\":null,\"serial\":\"AGENTB-IC-SHARED\"}",
    "a_values_json": "{\"ic_custom_name\":\"AgentB IC requested concrete first copy\",\"ic_custom_serial\":\"AGENTB-IC-SHARED\",\"ic_custom_a\":\"IC A source seed\",\"ic_custom_b\":\"IC B source seed\",\"ic_custom_both\":\"IC Both source seed\",\"ic_custom_option\":\"AgentB IC Maker\",\"ic_custom_datetime\":\"2026-10-24 17:18:19\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 944101,
    "b_items_id": 4,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:55:41",
    "status": "Done",
    "result_json": "{\"b_items_id\":4,\"created_b_items_id\":4,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ic_custom_name\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_custom_serial\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_custom_a\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_custom_b\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_custom_both\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_custom_option\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_custom_datetime\",\"outcome\":\"AppliedToB\",\"reason\":null}]}",
    "error": null,
    "date_creation": "2026-10-24 15:55:41",
    "date_mod": "2026-10-24 15:55:41",
    "completed_at": "2026-10-24 15:55:41"
  },
  {
    "id": 61,
    "work_id": "inbound-c-20261024-same-source-second",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":944001,\"b_items_id\":null,\"serial\":\"AGENTB-IC-NATIVE\"}",
    "a_values_json": "{\"ic_name\":\"AgentB IC native first copy\",\"ic_serial\":\"AGENTB-IC-NATIVE\",\"ic_b_text\":\"MUST NOT RESEED B\",\"ic_both_text\":\"MUST NOT RESEED BOTH\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
    "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 944001,
    "b_items_id": 153,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:55:41",
    "status": "Held",
    "result_json": "{\"b_items_id\":153,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ic_name\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ic_serial\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ic_b_text\",\"outcome\":\"Skipped\",\"reason\":\"B return processing is not installed yet\"},{\"mapping_id\":\"ic_both_text\",\"outcome\":\"Skipped\",\"reason\":\"Both conflict processing is not installed yet\"},{\"mapping_id\":\"ic_option\",\"outcome\":\"Skipped\",\"reason\":\"B return processing is not installed yet\"},{\"mapping_id\":\"ic_absent\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ic_fields_one\",\"outcome\":\"Skipped\",\"reason\":\"B return processing is not installed yet\"},{\"mapping_id\":\"ic_fields_two\",\"outcome\":\"Skipped\",\"reason\":\"Both conflict processing is not installed yet\"},{\"mapping_id\":\"ic_fields_later\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}",
    "error": "Both conflict processing is not installed yet",
    "date_creation": "2026-10-24 15:55:41",
    "date_mod": "2026-10-24 15:55:41",
    "completed_at": null
  },
  {
    "id": 62,
    "work_id": "inbound-c-20261024-competing-source",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":944002,\"b_items_id\":null,\"serial\":\"AGENTB-IC-NATIVE\"}",
    "a_values_json": "{\"ic_name\":\"AgentB IC native first copy\",\"ic_serial\":\"AGENTB-IC-NATIVE\",\"ic_b_text\":\"AgentB IC B owned label seed\",\"ic_both_text\":\"AgentB IC Both seed\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
    "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 944002,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:55:41",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "B asset has competing retained source ownership",
    "date_creation": "2026-10-24 15:55:41",
    "date_mod": "2026-10-24 15:55:41",
    "completed_at": null
  },
  {
    "id": 63,
    "work_id": "inbound-c-20261024-reuse-after-serial-change",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":944001,\"b_items_id\":null,\"serial\":\"AGENTB-IC-NATIVE\"}",
    "a_values_json": "{\"ic_name\":\"AgentB IC regular Sync after first copy\",\"ic_serial\":\"AGENTB-IC-NATIVE-CHANGED\",\"ic_b_text\":\"MUST NOT RESEED B AFTER SERIAL\",\"ic_both_text\":\"MUST NOT RESEED BOTH AFTER SERIAL\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"MUST NOT RESEED B FIELD\",\"ic_fields_two\":\"MUST NOT RESEED BOTH FIELD\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
    "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 944001,
    "b_items_id": 153,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:57:19",
    "status": "Held",
    "result_json": "{\"b_items_id\":153,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ic_name\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_serial\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ic_b_text\",\"outcome\":\"Skipped\",\"reason\":\"B return processing is not installed yet\"},{\"mapping_id\":\"ic_both_text\",\"outcome\":\"Skipped\",\"reason\":\"Both conflict processing is not installed yet\"},{\"mapping_id\":\"ic_option\",\"outcome\":\"Skipped\",\"reason\":\"B return processing is not installed yet\"},{\"mapping_id\":\"ic_absent\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ic_fields_one\",\"outcome\":\"Skipped\",\"reason\":\"B return processing is not installed yet\"},{\"mapping_id\":\"ic_fields_two\",\"outcome\":\"Skipped\",\"reason\":\"Both conflict processing is not installed yet\"},{\"mapping_id\":\"ic_fields_later\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}",
    "error": "Both conflict processing is not installed yet",
    "date_creation": "2026-10-24 15:57:19",
    "date_mod": "2026-10-24 15:57:19",
    "completed_at": null
  },
  {
    "id": 64,
    "work_id": "inbound-c-20261024-mandatory-firstcopy-failure",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":944003,\"b_items_id\":null,\"serial\":\"AGENTB-IC-MANDATORY-FAIL\"}",
    "a_values_json": "{\"ic_name\":\"AgentB IC mandatory failure must rollback\",\"ic_serial\":\"AGENTB-IC-MANDATORY-FAIL\",\"ic_b_text\":\"AgentB IC B owned label seed\",\"ic_both_text\":\"AgentB IC Both seed\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
    "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 944003,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:57:19",
    "status": "Failed",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ic_absent\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled first-copy mapping\"},{\"mapping_id\":\"ic_fields_two\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled first-copy mapping\"},{\"mapping_id\":\"ic_name\",\"outcome\":\"Failed\",\"reason\":\"First-copy transaction was rolled back\"},{\"mapping_id\":\"ic_serial\",\"outcome\":\"Failed\",\"reason\":\"First-copy transaction was rolled back\"},{\"mapping_id\":\"ic_b_text\",\"outcome\":\"Failed\",\"reason\":\"First-copy transaction was rolled back\"},{\"mapping_id\":\"ic_both_text\",\"outcome\":\"Failed\",\"reason\":\"First-copy transaction was rolled back\"},{\"mapping_id\":\"ic_option\",\"outcome\":\"Failed\",\"reason\":\"First-copy transaction was rolled back\"},{\"mapping_id\":\"ic_fields_one\",\"outcome\":\"Failed\",\"reason\":\"First-copy transaction was rolled back\"},{\"mapping_id\":\"ic_fields_later\",\"outcome\":\"Failed\",\"reason\":\"First-copy transaction was rolled back\"}]}",
    "error": "Save failed: GLPI declined first-copy creation",
    "date_creation": "2026-10-24 15:57:19",
    "date_mod": "2026-10-24 15:57:19",
    "completed_at": null
  },
  {
    "id": 65,
    "work_id": "inbound-c-20261024-missing-option-skip",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":944004,\"b_items_id\":null,\"serial\":\"AGENTB-IC-SKIP-OPTION\"}",
    "a_values_json": "{\"ic_name\":\"AgentB IC skipped option first copy\",\"ic_serial\":\"AGENTB-IC-SKIP-OPTION\",\"ic_b_text\":\"AgentB IC B owned label seed\",\"ic_both_text\":\"AgentB IC Both seed\",\"ic_option\":\"AgentB IC nonexistent option\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
    "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 944004,
    "b_items_id": 154,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:57:19",
    "status": "Done",
    "result_json": "{\"b_items_id\":154,\"created_b_items_id\":154,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ic_option\",\"outcome\":\"Skipped\",\"reason\":\"Destination dropdown label has no permitted exact match\"},{\"mapping_id\":\"ic_absent\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled first-copy mapping\"},{\"mapping_id\":\"ic_name\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_serial\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_b_text\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_both_text\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_fields_one\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_fields_two\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_fields_later\",\"outcome\":\"AppliedToB\",\"reason\":null}]}",
    "error": null,
    "date_creation": "2026-10-24 15:57:19",
    "date_mod": "2026-10-24 15:57:19",
    "completed_at": "2026-10-24 15:57:19"
  },
  {
    "id": 66,
    "work_id": "inbound-c-20261024-unverified-other-concrete-claim",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBICReq20261024Asset",
    "identity_json": "{\"a_items_id\":944199,\"b_items_id\":3,\"serial\":\"AGENTB-IC-SHARED\"}",
    "a_values_json": "{\"ic_custom_name\":\"AgentB IC requested concrete first copy\",\"ic_custom_serial\":\"AGENTB-IC-SHARED\",\"ic_custom_a\":\"IC A source seed\",\"ic_custom_b\":\"IC B source seed\",\"ic_custom_both\":\"IC Both source seed\",\"ic_custom_option\":\"AgentB IC Maker\",\"ic_custom_datetime\":\"2026-10-24 17:18:19\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 944199,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:57:19",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Claimed B ID has no retained verified link evidence",
    "date_creation": "2026-10-24 15:57:19",
    "date_mod": "2026-10-24 15:57:19",
    "completed_at": null
  }
]
```

### Curl 14 — IC current CREATE boundary admission

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account: service (user12/profile14/entity0). HTTP 201

Body:
```json
{
  "input": {
    "work_id": "inbound-c-20261024-create-denied",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":944005,\"b_items_id\":null,\"serial\":\"AGENTB-IC-CREATE-DENIED\"}",
    "a_values_json": "{\"ic_name\":\"AgentB IC denied creation\",\"ic_serial\":\"AGENTB-IC-CREATE-DENIED\",\"ic_b_text\":\"AgentB IC B owned label seed\",\"ic_both_text\":\"AgentB IC Both seed\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
    "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
    "settings_version": 1
  }
}
```

Response:
```json
{
  "id": 67,
  "message": ""
}
```

### Curl 15 — IC old-version admission before route change

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account: service (user12/profile14/entity0). HTTP 201

Body:
```json
{
  "input": {
    "work_id": "inbound-c-20261024-stale-settings",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":944006,\"b_items_id\":null,\"serial\":\"AGENTB-IC-VERSION\"}",
    "a_values_json": "{\"ic_name\":\"AgentB IC stale route must not create\",\"ic_serial\":\"AGENTB-IC-VERSION\",\"ic_b_text\":\"AgentB IC B owned label seed\",\"ic_both_text\":\"AgentB IC Both seed\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
    "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
    "settings_version": 1
  }
}
```

Response:
```json
{
  "id": 68,
  "message": ""
}
```

### Curl 16 — IC raise fresh route version before processing

PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/13

Account: service (user12/profile14/entity0). HTTP 200

Body:
```json
{
  "input": {
    "id": 13,
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "route_enabled": 1,
    "settings_version": 2,
    "enabled_itemtypes_json": "[\"Computer\",\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\"]",
    "field_mappings_json": "[{\"mapping_id\":\"ic_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_serial\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"serial\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_b_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"comment\"},\"source\":\"B\",\"value_mode\":\"dropdown_label_to_text\"},{\"mapping_id\":\"ic_both_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"manufacturers_id\"},\"source\":\"B\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"ic_absent\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"otherserial\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_disabled\",\"itemtype\":\"Computer\",\"enabled\":false,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact_num\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_fields_one\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbicx\",\"name\":\"icreqonefield\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_fields_two\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbicx\",\"name\":\"icreqtwofield\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_fields_later\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbicy\",\"name\":\"iclaterreqfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_custom_name\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_custom_serial\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"serial\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_custom_a\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_a\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_custom_b\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_b\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_custom_both\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_both\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_custom_option\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_option\"},\"source\":\"Both\",\"value_mode\":\"dropdown_label_to_dropdown\"},{\"mapping_id\":\"ic_custom_datetime\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_datetime\"},\"source\":\"B\",\"value_mode\":\"direct\"}]"
  }
}
```

Response:
```json
[
  {
    "13": true,
    "message": ""
  }
]
```

### Curl 17 — IC final all Work and immutable input readback

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork?searchText%5Bwork_id%5D=%5Einbound-c-20261024-&range=0-99&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false

Account: service (user12/profile14/entity0). HTTP 200

Body:
```json
null
```

Response:
```json
[
  {
    "id": 59,
    "work_id": "inbound-c-20261024-native-grouped-first",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":944001,\"b_items_id\":null,\"serial\":\"AGENTB-IC-NATIVE\"}",
    "a_values_json": "{\"ic_name\":\"AgentB IC native first copy\",\"ic_serial\":\"AGENTB-IC-NATIVE\",\"ic_b_text\":\"AgentB IC B owned label seed\",\"ic_both_text\":\"AgentB IC Both seed\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
    "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 944001,
    "b_items_id": 153,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:55:41",
    "status": "Done",
    "result_json": "{\"b_items_id\":153,\"created_b_items_id\":153,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ic_absent\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled first-copy mapping\"},{\"mapping_id\":\"ic_name\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_serial\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_b_text\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_both_text\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_option\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_fields_one\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_fields_two\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_fields_later\",\"outcome\":\"AppliedToB\",\"reason\":null}]}",
    "error": null,
    "date_creation": "2026-10-24 15:55:41",
    "date_mod": "2026-10-24 15:55:41",
    "completed_at": "2026-10-24 15:55:41"
  },
  {
    "id": 60,
    "work_id": "inbound-c-20261024-custom-concrete-first",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBICReq20261024Asset",
    "identity_json": "{\"a_items_id\":944101,\"b_items_id\":null,\"serial\":\"AGENTB-IC-SHARED\"}",
    "a_values_json": "{\"ic_custom_name\":\"AgentB IC requested concrete first copy\",\"ic_custom_serial\":\"AGENTB-IC-SHARED\",\"ic_custom_a\":\"IC A source seed\",\"ic_custom_b\":\"IC B source seed\",\"ic_custom_both\":\"IC Both source seed\",\"ic_custom_option\":\"AgentB IC Maker\",\"ic_custom_datetime\":\"2026-10-24 17:18:19\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 944101,
    "b_items_id": 4,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:55:41",
    "status": "Done",
    "result_json": "{\"b_items_id\":4,\"created_b_items_id\":4,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ic_custom_name\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_custom_serial\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_custom_a\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_custom_b\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_custom_both\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_custom_option\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_custom_datetime\",\"outcome\":\"AppliedToB\",\"reason\":null}]}",
    "error": null,
    "date_creation": "2026-10-24 15:55:41",
    "date_mod": "2026-10-24 15:55:41",
    "completed_at": "2026-10-24 15:55:41"
  },
  {
    "id": 61,
    "work_id": "inbound-c-20261024-same-source-second",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":944001,\"b_items_id\":null,\"serial\":\"AGENTB-IC-NATIVE\"}",
    "a_values_json": "{\"ic_name\":\"AgentB IC native first copy\",\"ic_serial\":\"AGENTB-IC-NATIVE\",\"ic_b_text\":\"MUST NOT RESEED B\",\"ic_both_text\":\"MUST NOT RESEED BOTH\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
    "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 944001,
    "b_items_id": 153,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:55:41",
    "status": "Held",
    "result_json": "{\"b_items_id\":153,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ic_name\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ic_serial\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ic_b_text\",\"outcome\":\"Skipped\",\"reason\":\"B return processing is not installed yet\"},{\"mapping_id\":\"ic_both_text\",\"outcome\":\"Skipped\",\"reason\":\"Both conflict processing is not installed yet\"},{\"mapping_id\":\"ic_option\",\"outcome\":\"Skipped\",\"reason\":\"B return processing is not installed yet\"},{\"mapping_id\":\"ic_absent\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ic_fields_one\",\"outcome\":\"Skipped\",\"reason\":\"B return processing is not installed yet\"},{\"mapping_id\":\"ic_fields_two\",\"outcome\":\"Skipped\",\"reason\":\"Both conflict processing is not installed yet\"},{\"mapping_id\":\"ic_fields_later\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}",
    "error": "Both conflict processing is not installed yet",
    "date_creation": "2026-10-24 15:55:41",
    "date_mod": "2026-10-24 15:55:41",
    "completed_at": null
  },
  {
    "id": 62,
    "work_id": "inbound-c-20261024-competing-source",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":944002,\"b_items_id\":null,\"serial\":\"AGENTB-IC-NATIVE\"}",
    "a_values_json": "{\"ic_name\":\"AgentB IC native first copy\",\"ic_serial\":\"AGENTB-IC-NATIVE\",\"ic_b_text\":\"AgentB IC B owned label seed\",\"ic_both_text\":\"AgentB IC Both seed\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
    "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 944002,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:55:41",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "B asset has competing retained source ownership",
    "date_creation": "2026-10-24 15:55:41",
    "date_mod": "2026-10-24 15:55:41",
    "completed_at": null
  },
  {
    "id": 63,
    "work_id": "inbound-c-20261024-reuse-after-serial-change",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":944001,\"b_items_id\":null,\"serial\":\"AGENTB-IC-NATIVE\"}",
    "a_values_json": "{\"ic_name\":\"AgentB IC regular Sync after first copy\",\"ic_serial\":\"AGENTB-IC-NATIVE-CHANGED\",\"ic_b_text\":\"MUST NOT RESEED B AFTER SERIAL\",\"ic_both_text\":\"MUST NOT RESEED BOTH AFTER SERIAL\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"MUST NOT RESEED B FIELD\",\"ic_fields_two\":\"MUST NOT RESEED BOTH FIELD\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
    "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 944001,
    "b_items_id": 153,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:57:19",
    "status": "Held",
    "result_json": "{\"b_items_id\":153,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ic_name\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_serial\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ic_b_text\",\"outcome\":\"Skipped\",\"reason\":\"B return processing is not installed yet\"},{\"mapping_id\":\"ic_both_text\",\"outcome\":\"Skipped\",\"reason\":\"Both conflict processing is not installed yet\"},{\"mapping_id\":\"ic_option\",\"outcome\":\"Skipped\",\"reason\":\"B return processing is not installed yet\"},{\"mapping_id\":\"ic_absent\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ic_fields_one\",\"outcome\":\"Skipped\",\"reason\":\"B return processing is not installed yet\"},{\"mapping_id\":\"ic_fields_two\",\"outcome\":\"Skipped\",\"reason\":\"Both conflict processing is not installed yet\"},{\"mapping_id\":\"ic_fields_later\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}",
    "error": "Both conflict processing is not installed yet",
    "date_creation": "2026-10-24 15:57:19",
    "date_mod": "2026-10-24 15:57:19",
    "completed_at": null
  },
  {
    "id": 64,
    "work_id": "inbound-c-20261024-mandatory-firstcopy-failure",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":944003,\"b_items_id\":null,\"serial\":\"AGENTB-IC-MANDATORY-FAIL\"}",
    "a_values_json": "{\"ic_name\":\"AgentB IC mandatory failure must rollback\",\"ic_serial\":\"AGENTB-IC-MANDATORY-FAIL\",\"ic_b_text\":\"AgentB IC B owned label seed\",\"ic_both_text\":\"AgentB IC Both seed\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
    "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 944003,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:57:19",
    "status": "Failed",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ic_absent\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled first-copy mapping\"},{\"mapping_id\":\"ic_fields_two\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled first-copy mapping\"},{\"mapping_id\":\"ic_name\",\"outcome\":\"Failed\",\"reason\":\"First-copy transaction was rolled back\"},{\"mapping_id\":\"ic_serial\",\"outcome\":\"Failed\",\"reason\":\"First-copy transaction was rolled back\"},{\"mapping_id\":\"ic_b_text\",\"outcome\":\"Failed\",\"reason\":\"First-copy transaction was rolled back\"},{\"mapping_id\":\"ic_both_text\",\"outcome\":\"Failed\",\"reason\":\"First-copy transaction was rolled back\"},{\"mapping_id\":\"ic_option\",\"outcome\":\"Failed\",\"reason\":\"First-copy transaction was rolled back\"},{\"mapping_id\":\"ic_fields_one\",\"outcome\":\"Failed\",\"reason\":\"First-copy transaction was rolled back\"},{\"mapping_id\":\"ic_fields_later\",\"outcome\":\"Failed\",\"reason\":\"First-copy transaction was rolled back\"}]}",
    "error": "Save failed: GLPI declined first-copy creation",
    "date_creation": "2026-10-24 15:57:19",
    "date_mod": "2026-10-24 15:57:19",
    "completed_at": null
  },
  {
    "id": 65,
    "work_id": "inbound-c-20261024-missing-option-skip",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":944004,\"b_items_id\":null,\"serial\":\"AGENTB-IC-SKIP-OPTION\"}",
    "a_values_json": "{\"ic_name\":\"AgentB IC skipped option first copy\",\"ic_serial\":\"AGENTB-IC-SKIP-OPTION\",\"ic_b_text\":\"AgentB IC B owned label seed\",\"ic_both_text\":\"AgentB IC Both seed\",\"ic_option\":\"AgentB IC nonexistent option\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
    "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 944004,
    "b_items_id": 154,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 15:57:19",
    "status": "Done",
    "result_json": "{\"b_items_id\":154,\"created_b_items_id\":154,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ic_option\",\"outcome\":\"Skipped\",\"reason\":\"Destination dropdown label has no permitted exact match\"},{\"mapping_id\":\"ic_absent\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled first-copy mapping\"},{\"mapping_id\":\"ic_name\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_serial\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_b_text\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_both_text\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_fields_one\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_fields_two\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_fields_later\",\"outcome\":\"AppliedToB\",\"reason\":null}]}",
    "error": null,
    "date_creation": "2026-10-24 15:57:19",
    "date_mod": "2026-10-24 15:57:19",
    "completed_at": "2026-10-24 15:57:19"
  },
  {
    "id": 66,
    "work_id": "inbound-c-20261024-unverified-other-concrete-claim",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBICReq20261024Asset",
    "identity_json": "{\"a_items_id\":944199,\"b_items_id\":3,\"serial\":\"AGENTB-IC-SHARED\"}",
    "a_values_json": "{\"ic_custom_name\":\"AgentB IC requested concrete first copy\",\"ic_custom_serial\":\"AGENTB-IC-SHARED\",\"ic_custom_a\":\"IC A source seed\",\"ic_custom_b\":\"IC B source seed\",\"ic_custom_both\":\"IC Both source seed\",\"ic_custom_option\":\"AgentB IC Maker\",\"ic_custom_datetime\":\"2026-10-24 17:18:19\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 944199,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 15:57:19",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Claimed B ID has no retained verified link evidence",
    "date_creation": "2026-10-24 15:57:19",
    "date_mod": "2026-10-24 15:57:19",
    "completed_at": null
  },
  {
    "id": 67,
    "work_id": "inbound-c-20261024-create-denied",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":944005,\"b_items_id\":null,\"serial\":\"AGENTB-IC-CREATE-DENIED\"}",
    "a_values_json": "{\"ic_name\":\"AgentB IC denied creation\",\"ic_serial\":\"AGENTB-IC-CREATE-DENIED\",\"ic_b_text\":\"AgentB IC B owned label seed\",\"ic_both_text\":\"AgentB IC Both seed\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
    "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 944005,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 16:00:16",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Hold: submitting user lacks current asset CREATE permission",
    "date_creation": "2026-10-24 16:00:16",
    "date_mod": "2026-10-24 16:00:16",
    "completed_at": null
  },
  {
    "id": 68,
    "work_id": "inbound-c-20261024-stale-settings",
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":944006,\"b_items_id\":null,\"serial\":\"AGENTB-IC-VERSION\"}",
    "a_values_json": "{\"ic_name\":\"AgentB IC stale route must not create\",\"ic_serial\":\"AGENTB-IC-VERSION\",\"ic_b_text\":\"AgentB IC B owned label seed\",\"ic_both_text\":\"AgentB IC Both seed\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}",
    "a_change_times_json": "{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 944006,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 16:00:25",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 16:00:25",
    "date_mod": "2026-10-24 16:00:25",
    "completed_at": null
  }
]
```

### Curl 18 — IC native retained asset after regular Sync

GET http://localhost:8081/api.php/v1/Computer/153?get_hateoas=false

Account: service (user12/profile14/entity0). HTTP 200

Body:
```json
null
```

Response:
```json
{
  "id": 153,
  "entities_id": 0,
  "name": "AgentB IC regular Sync after first copy",
  "serial": "AGENTB-IC-NATIVE-CHANGED",
  "otherserial": null,
  "contact": "AgentB IC Both seed",
  "contact_num": null,
  "users_id_tech": 0,
  "comment": "AgentB IC B owned label seed",
  "date_mod": "2026-10-24 15:57:19",
  "autoupdatesystems_id": 0,
  "locations_id": 0,
  "networks_id": 0,
  "computermodels_id": 0,
  "computertypes_id": 0,
  "is_template": 0,
  "template_name": null,
  "manufacturers_id": 7,
  "is_deleted": 0,
  "is_dynamic": 0,
  "users_id": 0,
  "states_id": 0,
  "ticket_tco": "0.0000",
  "uuid": null,
  "date_creation": "2026-10-24 15:55:41",
  "is_recursive": 0,
  "last_inventory_update": null,
  "last_boot": null,
  "groups_id": [],
  "groups_id_tech": []
}
```

### Curl 19 — IC skipped dropdown option native default

GET http://localhost:8081/api.php/v1/Computer/154?get_hateoas=false

Account: service (user12/profile14/entity0). HTTP 200

Body:
```json
null
```

Response:
```json
{
  "id": 154,
  "entities_id": 0,
  "name": "AgentB IC skipped option first copy",
  "serial": "AGENTB-IC-SKIP-OPTION",
  "otherserial": null,
  "contact": "AgentB IC Both seed",
  "contact_num": null,
  "users_id_tech": 0,
  "comment": "AgentB IC B owned label seed",
  "date_mod": "2026-10-24 15:57:19",
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
  "date_creation": "2026-10-24 15:57:19",
  "is_recursive": 0,
  "last_inventory_update": null,
  "last_boot": null,
  "groups_id": [],
  "groups_id_tech": []
}
```

### Curl 20 — IC genuine queue row and no sync echoes

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?range=0-99&sort=id&order=ASC&get_hateoas=false

Account: service (user12/profile14/entity0). HTTP 200

Body:
```json
null
```

Response:
```json
[
  {
    "id": 1,
    "route_id": "outbound-a-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9100,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":null,\"b_items_id\":145,\"serial\":\"AGENTB-OC-MAIN\"}",
    "changed_fields_json": "{\"native_name\":{\"value\":\"AgentB OC native edit one\",\"changed_at\":\"2026-10-24T15:13:27+08:00\",\"reliable\":true},\"native_comment\":{\"value\":\"Captured comment\",\"changed_at\":\"2026-10-24T15:13:27+08:00\",\"reliable\":true},\"native_option\":{\"value\":\"AgentB OC Manufacturer\",\"changed_at\":\"2026-10-24T15:13:27+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:13:27",
    "date_mod": "2026-10-24 15:16:16",
    "done_at": "2026-10-24 15:16:16"
  },
  {
    "id": 2,
    "route_id": "outbound-a-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9100,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":null,\"b_items_id\":145,\"serial\":\"AGENTB-OC-MAIN\"}",
    "changed_fields_json": "{\"native_name\":{\"value\":\"AgentB OC native edit two\",\"changed_at\":\"2026-10-24T15:13:27+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:13:27",
    "date_mod": "2026-10-24 15:41:04",
    "done_at": "2026-10-24 15:41:04"
  },
  {
    "id": 3,
    "route_id": "outbound-a-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9100,
    "entities_id": 0,
    "itemtype": "Monitor",
    "identity_json": "{\"a_items_id\":null,\"b_items_id\":1,\"serial\":\"AGENTB-OC-MONITOR\"}",
    "changed_fields_json": "{\"monitor_name\":{\"value\":\"AgentB OC monitor edited\",\"changed_at\":\"2026-10-24T15:13:27+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:13:27",
    "date_mod": "2026-10-24 15:38:35",
    "done_at": "2026-10-24 15:38:35"
  },
  {
    "id": 4,
    "route_id": "outbound-a-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9100,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":null,\"b_items_id\":145,\"serial\":\"AGENTB-OC-MAIN\"}",
    "changed_fields_json": "{\"fields_text\":{\"value\":\"OC text initial\",\"changed_at\":\"2026-10-24T15:13:27+08:00\",\"reliable\":true},\"fields_textarea\":{\"value\":\"OC multiline initial\",\"changed_at\":\"2026-10-24T15:13:27+08:00\",\"reliable\":true},\"fields_url\":{\"value\":\"https:\\/\\/example.com\\/oc\",\"changed_at\":\"2026-10-24T15:13:27+08:00\",\"reliable\":true},\"fields_number\":{\"value\":12.5,\"changed_at\":\"2026-10-24T15:13:27+08:00\",\"reliable\":true},\"fields_yesno\":{\"value\":true,\"changed_at\":\"2026-10-24T15:13:27+08:00\",\"reliable\":true},\"fields_date\":{\"value\":\"2026-10-24\",\"changed_at\":\"2026-10-24T15:13:27+08:00\",\"reliable\":true},\"fields_datetime\":{\"value\":\"2026-10-24 12:34:56\",\"changed_at\":\"2026-10-24T15:13:27+08:00\",\"reliable\":true},\"fields_dropdown\":{\"value\":\"AgentB OC Choice\",\"changed_at\":\"2026-10-24T15:13:27+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:13:27",
    "date_mod": "2026-10-24 15:39:10",
    "done_at": "2026-10-24 15:39:10"
  },
  {
    "id": 5,
    "route_id": "outbound-a-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9100,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":null,\"b_items_id\":145,\"serial\":\"AGENTB-OC-MAIN\"}",
    "changed_fields_json": "{\"native_name\":{\"value\":\"AgentB OC nested native\",\"changed_at\":\"2026-10-24T15:13:27+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:13:27",
    "date_mod": "2026-10-24 15:39:10",
    "done_at": "2026-10-24 15:39:10"
  },
  {
    "id": 6,
    "route_id": "outbound-a-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9100,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":null,\"b_items_id\":145,\"serial\":\"AGENTB-OC-MAIN\"}",
    "changed_fields_json": "{\"fields_text\":{\"value\":\"Standalone Fields edit\",\"changed_at\":\"2026-10-24T15:14:23+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:14:23",
    "date_mod": "2026-10-24 15:39:10",
    "done_at": "2026-10-24 15:39:10"
  },
  {
    "id": 7,
    "route_id": "outbound-a-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9100,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":null,\"b_items_id\":145,\"serial\":\"AGENTB-OC-MAIN\"}",
    "changed_fields_json": "{\"fields_text\":{\"value\":\"Fields-only parent save\",\"changed_at\":\"2026-10-24T15:14:23+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:14:23",
    "date_mod": "2026-10-24 15:39:10",
    "done_at": "2026-10-24 15:39:10"
  },
  {
    "id": 8,
    "route_id": "outbound-a-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9100,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":null,\"b_items_id\":146,\"serial\":\"AGENTB-OC-FIRST\"}",
    "changed_fields_json": "{\"fields_text\":{\"value\":\"First storage row edit\",\"changed_at\":\"2026-10-24T15:14:23+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:14:23",
    "date_mod": "2026-10-24 15:40:30",
    "done_at": "2026-10-24 15:40:30"
  },
  {
    "id": 9,
    "route_id": "outbound-a-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9100,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":null,\"b_items_id\":145,\"serial\":\"AGENTB-OC-MAIN\"}",
    "changed_fields_json": "{\"native_name\":{\"value\":\"AgentB OC genuine after guard\",\"changed_at\":\"2026-10-24T15:15:38+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:15:38",
    "date_mod": "2026-10-24 15:40:30",
    "done_at": "2026-10-24 15:40:30"
  },
  {
    "id": 10,
    "route_id": "outbound-a-20261024-main",
    "settings_version": 4,
    "a_entities_id": 9100,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":null,\"b_items_id\":145,\"serial\":\"AGENTB-OC-MAIN\"}",
    "changed_fields_json": "{\"native_name\":{\"value\":\"AgentB OC two route save\",\"changed_at\":\"2026-10-24T15:16:39+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:16:39",
    "date_mod": "2026-10-24 15:16:39",
    "done_at": null
  },
  {
    "id": 11,
    "route_id": "outbound-a-20261024-second-route",
    "settings_version": 1,
    "a_entities_id": 9101,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":null,\"b_items_id\":145,\"serial\":\"AGENTB-OC-MAIN\"}",
    "changed_fields_json": "{\"second_name\":{\"value\":\"AgentB OC two route save\",\"changed_at\":\"2026-10-24T15:16:39+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:16:39",
    "date_mod": "2026-10-24 15:16:39",
    "done_at": null
  },
  {
    "id": 12,
    "route_id": "outbound-a-20261024-main",
    "settings_version": 4,
    "a_entities_id": 9100,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBOC20261024Asset",
    "identity_json": "{\"a_items_id\":null,\"b_items_id\":1,\"serial\":\"AGENTB-OC-CUSTOM\"}",
    "changed_fields_json": "{\"virtual_oc_text\":{\"value\":\"OC09 after fix text\",\"changed_at\":\"2026-10-24T15:16:50+08:00\",\"reliable\":true},\"virtual_oc_other\":{\"value\":\"OC09 sibling changed once\",\"changed_at\":\"2026-10-24T15:16:50+08:00\",\"reliable\":true},\"virtual_oc_datetime\":{\"value\":\"2026-10-26 14:15:16\",\"changed_at\":\"2026-10-24T15:16:50+08:00\",\"reliable\":true},\"virtual_oc_option\":{\"value\":\"AgentB OC Manufacturer Two\",\"changed_at\":\"2026-10-24T15:16:50+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:16:50",
    "date_mod": "2026-10-24 15:16:50",
    "done_at": null
  },
  {
    "id": 13,
    "route_id": "outbound-a-20261024-main",
    "settings_version": 5,
    "a_entities_id": 9100,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBOC20261024Asset",
    "identity_json": "{\"a_items_id\":null,\"b_items_id\":1,\"serial\":\"AGENTB-OC-CUSTOM\"}",
    "changed_fields_json": "{\"virtual_oc_text\":{\"value\":\"OC09 only text changes now\",\"changed_at\":\"2026-10-24T15:17:25+08:00\",\"reliable\":true},\"custom_native_name\":{\"value\":\"AgentB OC custom core after fix\",\"changed_at\":\"2026-10-24T15:17:25+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:17:25",
    "date_mod": "2026-10-24 15:17:25",
    "done_at": null
  },
  {
    "id": 14,
    "route_id": "inbound-b-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9200,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":922001,\"b_items_id\":149,\"serial\":\"AGENTB-IB-RENAMED\"}",
    "changed_fields_json": "{\"ib_name\":{\"value\":\"AgentB IB genuine immediate edit\",\"changed_at\":\"2026-10-24T15:27:27+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:39:10",
    "done_at": "2026-10-24 15:39:10"
  },
  {
    "id": 15,
    "route_id": "outbound-b-20261024-history",
    "settings_version": 1,
    "a_entities_id": 9300,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":null,\"b_items_id\":152,\"serial\":\"AGENTB-OB-HISTORY\"}",
    "changed_fields_json": "{\"ob_name\":{\"value\":\"AgentB OB history genuine edit\",\"changed_at\":\"2026-10-24T15:39:55+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:39:55",
    "date_mod": "2026-10-24 15:39:55",
    "done_at": null
  },
  {
    "id": 16,
    "route_id": "inbound-c-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9400,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":944001,\"b_items_id\":153,\"serial\":\"AGENTB-IC-NATIVE-CHANGED\"}",
    "changed_fields_json": "{\"ic_name\":{\"value\":\"AgentB IC genuine after creation\",\"changed_at\":\"2026-10-24T15:57:19+08:00\",\"reliable\":true},\"ic_serial\":{\"value\":\"AGENTB-IC-NATIVE-CHANGED\",\"changed_at\":\"2026-10-24T15:57:19+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:57:19",
    "date_mod": "2026-10-24 15:57:19",
    "done_at": null
  }
]
```

### Curl 21 — IC contain only fresh route after evidence

PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/13

Account: service (user12/profile14/entity0). HTTP 200

Body:
```json
{
  "input": {
    "id": 13,
    "route_id": "inbound-c-20261024-main",
    "a_entities_id": 9400,
    "entities_id": 0,
    "route_enabled": 0,
    "settings_version": 3,
    "enabled_itemtypes_json": "[\"Computer\",\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\"]",
    "field_mappings_json": "[{\"mapping_id\":\"ic_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_serial\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"serial\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_b_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"comment\"},\"source\":\"B\",\"value_mode\":\"dropdown_label_to_text\"},{\"mapping_id\":\"ic_both_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"manufacturers_id\"},\"source\":\"B\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"ic_absent\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"otherserial\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_disabled\",\"itemtype\":\"Computer\",\"enabled\":false,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact_num\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_fields_one\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbicx\",\"name\":\"icreqonefield\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_fields_two\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbicx\",\"name\":\"icreqtwofield\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_fields_later\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbicy\",\"name\":\"iclaterreqfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_custom_name\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_custom_serial\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"serial\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_custom_a\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_a\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_custom_b\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_b\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_custom_both\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_both\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_custom_option\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_option\"},\"source\":\"Both\",\"value_mode\":\"dropdown_label_to_dropdown\"},{\"mapping_id\":\"ic_custom_datetime\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_datetime\"},\"source\":\"B\",\"value_mode\":\"direct\"}]"
  }
}
```

Response:
```json
[
  {
    "13": true,
    "message": ""
  }
]
```

### Curl 22 — IC contained route exact readback

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/13?get_hateoas=false

Account: service (user12/profile14/entity0). HTTP 200

Body:
```json
null
```

Response:
```json
{
  "id": 13,
  "route_id": "inbound-c-20261024-main",
  "a_entities_id": 9400,
  "entities_id": 0,
  "route_enabled": 0,
  "settings_version": 3,
  "enabled_itemtypes_json": "[\"Computer\",\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\"]",
  "field_mappings_json": "[{\"mapping_id\":\"ic_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_serial\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"serial\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_b_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"comment\"},\"source\":\"B\",\"value_mode\":\"dropdown_label_to_text\"},{\"mapping_id\":\"ic_both_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"manufacturers_id\"},\"source\":\"B\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"ic_absent\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"otherserial\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_disabled\",\"itemtype\":\"Computer\",\"enabled\":false,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact_num\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_fields_one\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbicx\",\"name\":\"icreqonefield\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_fields_two\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbicx\",\"name\":\"icreqtwofield\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_fields_later\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbicy\",\"name\":\"iclaterreqfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_custom_name\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_custom_serial\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"serial\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_custom_a\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_a\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_custom_b\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_b\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_custom_both\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_both\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ic_custom_option\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_option\"},\"source\":\"Both\",\"value_mode\":\"dropdown_label_to_dropdown\"},{\"mapping_id\":\"ic_custom_datetime\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_datetime\"},\"source\":\"B\",\"value_mode\":\"direct\"}]"
}
```

### Curl 23 — IC close session created for this bounded pass

GET http://localhost:8081/api.php/v1/killSession

Account: service (user12/profile14/entity0). HTTP 200

Body:
```json
null
```

Response:
```json
true
```

## Complete local native operator ledger

### Local 1 — Create fresh IC grouped mandatory Fields containers and two concrete custom definitions

Native CLI user 2; exit 0. Bootstrap: vendor/autoload.php → Kernel boot → Auth user → Session::init → Plugin::init.

```php
Session::changeProfile(4);$containers=[];$defs=[];foreach([['AgentB IC X',['IC req one','IC req two']],['AgentB IC Y',['IC later req']]]as[$label,$labels]){$c=new PluginFieldsContainer();$cid=$c->add(['label'=>$label,'itemtypes'=>['Computer'],'type'=>'tab','subtype'=>'','entities_id'=>0,'is_recursive'=>0,'is_active'=>1]);$p=new PluginFieldsProfile();$rights=[];foreach($p->find(['plugin_fields_containers_id'=>$cid])as$r){$rights[(int)$r['profiles_id']]=(int)$r['profiles_id']===14?CREATE:0;}PluginFieldsProfile::updateProfile(['plugin_fields_containers_id'=>$cid,'rights'=>$rights]);$fields=[];foreach($labels as$flabel){$f=new PluginFieldsField();$f->add(['plugin_fields_containers_id'=>$cid,'label'=>$flabel,'type'=>'text','is_active'=>1,'is_readonly'=>0,'multiple'=>0,'mandatory'=>1]);$fields[]=$f->fields;}$f=new PluginFieldsField();$f->add(['plugin_fields_containers_id'=>$cid,'label'=>$label.' default','type'=>'text','is_active'=>1,'is_readonly'=>0,'multiple'=>0,'mandatory'=>0,'default_value'=>'IC untouched default']);$containers[]=['container'=>$c->fields,'required_fields'=>$fields,'default_field'=>$f->fields,'rights'=>array_values($p->find(['plugin_fields_containers_id'=>$cid]))];}foreach(['AgentBICReq20261024','AgentBICOther20261024']as$name){$d=new \Glpi\Asset\AssetDefinition();$id=$d->add(['system_name'=>$name,'label'=>$name,'is_active'=>1,'profiles'=>[14=>7]]);$defs[]=['id'=>$id,'class'=>$d->getCustomObjectClassName()];}$fields=[];foreach([['ic_a','StringType'],['ic_b','StringType'],['ic_both','StringType'],['ic_option','DropdownType'],['ic_datetime','DateTimeType']]as[$name,$kind]){$f=new \Glpi\Asset\CustomFieldDefinition();$f->add(['assets_assetdefinitions_id'=>$defs[0]['id'],'system_name'=>$name,'label'=>$name,'type'=>'Glpi\\Asset\\CustomFieldType\\'.$kind,'itemtype'=>$kind==='DropdownType'?'Manufacturer':null,'field_options'=>[]]);$fields[]=$f->fields;}$m=new Manufacturer();$mid=$m->add(['name'=>'AgentB IC Maker']);echo json_encode(['containers'=>$containers,'definitions'=>$defs,'custom_fields'=>$fields,'manufacturer'=>$mid]);
```

Stdout:
```json
{"containers":[{"container":{"id":8,"name":"agentbicx","label":"AgentB IC X","itemtypes":"[\"Computer\"]","type":"tab","subtype":"","entities_id":0,"is_recursive":0,"is_active":1},"required_fields":[{"id":62,"name":"icreqonefield","label":"IC req one","type":"text","plugin_fields_containers_id":8,"ranking":1,"default_value":null,"is_active":1,"is_readonly":0,"mandatory":1,"multiple":0,"allowed_values":null},{"id":63,"name":"icreqtwofield","label":"IC req two","type":"text","plugin_fields_containers_id":8,"ranking":1,"default_value":null,"is_active":1,"is_readonly":0,"mandatory":1,"multiple":0,"allowed_values":null}],"default_field":{"id":64,"name":"agentbicxdefaultfield","label":"AgentB IC X default","type":"text","plugin_fields_containers_id":8,"ranking":1,"default_value":"IC untouched default","is_active":1,"is_readonly":0,"mandatory":0,"multiple":0,"allowed_values":null},"rights":[{"id":80,"profiles_id":1,"plugin_fields_containers_id":8,"right":"0"},{"id":81,"profiles_id":2,"plugin_fields_containers_id":8,"right":"0"},{"id":82,"profiles_id":3,"plugin_fields_containers_id":8,"right":"0"},{"id":83,"profiles_id":4,"plugin_fields_containers_id":8,"right":"0"},{"id":84,"profiles_id":5,"plugin_fields_containers_id":8,"right":"0"},{"id":85,"profiles_id":6,"plugin_fields_containers_id":8,"right":"0"},{"id":86,"profiles_id":7,"plugin_fields_containers_id":8,"right":"0"},{"id":87,"profiles_id":8,"plugin_fields_containers_id":8,"right":"0"},{"id":88,"profiles_id":9,"plugin_fields_containers_id":8,"right":"0"},{"id":89,"profiles_id":10,"plugin_fields_containers_id":8,"right":"0"},{"id":90,"profiles_id":11,"plugin_fields_containers_id":8,"right":"0"},{"id":91,"profiles_id":12,"plugin_fields_containers_id":8,"right":"0"},{"id":92,"profiles_id":13,"plugin_fields_containers_id":8,"right":"0"},{"id":93,"profiles_id":14,"plugin_fields_containers_id":8,"right":"4"},{"id":94,"profiles_id":15,"plugin_fields_containers_id":8,"right":"0"}]},{"container":{"id":9,"name":"agentbicy","label":"AgentB IC Y","itemtypes":"[\"Computer\"]","type":"tab","subtype":"","entities_id":0,"is_recursive":0,"is_active":1},"required_fields":[{"id":65,"name":"iclaterreqfield","label":"IC later req","type":"text","plugin_fields_containers_id":9,"ranking":1,"default_value":null,"is_active":1,"is_readonly":0,"mandatory":1,"multiple":0,"allowed_values":null}],"default_field":{"id":66,"name":"agentbicydefaultfield","label":"AgentB IC Y default","type":"text","plugin_fields_containers_id":9,"ranking":1,"default_value":"IC untouched default","is_active":1,"is_readonly":0,"mandatory":0,"multiple":0,"allowed_values":null},"rights":[{"id":95,"profiles_id":1,"plugin_fields_containers_id":9,"right":"0"},{"id":96,"profiles_id":2,"plugin_fields_containers_id":9,"right":"0"},{"id":97,"profiles_id":3,"plugin_fields_containers_id":9,"right":"0"},{"id":98,"profiles_id":4,"plugin_fields_containers_id":9,"right":"0"},{"id":99,"profiles_id":5,"plugin_fields_containers_id":9,"right":"0"},{"id":100,"profiles_id":6,"plugin_fields_containers_id":9,"right":"0"},{"id":101,"profiles_id":7,"plugin_fields_containers_id":9,"right":"0"},{"id":102,"profiles_id":8,"plugin_fields_containers_id":9,"right":"0"},{"id":103,"profiles_id":9,"plugin_fields_containers_id":9,"right":"0"},{"id":104,"profiles_id":10,"plugin_fields_containers_id":9,"right":"0"},{"id":105,"profiles_id":11,"plugin_fields_containers_id":9,"right":"0"},{"id":106,"profiles_id":12,"plugin_fields_containers_id":9,"right":"0"},{"id":107,"profiles_id":13,"plugin_fields_containers_id":9,"right":"0"},{"id":108,"profiles_id":14,"plugin_fields_containers_id":9,"right":"4"},{"id":109,"profiles_id":15,"plugin_fields_containers_id":9,"right":"0"}]}],"definitions":[{"id":3,"class":"Glpi\\CustomAsset\\AgentBICReq20261024Asset"},{"id":4,"class":"Glpi\\CustomAsset\\AgentBICOther20261024Asset"}],"custom_fields":[{"id":13,"assets_assetdefinitions_id":3,"system_name":"ic_a","label":"ic_a","type":"Glpi\\Asset\\CustomFieldType\\StringType","field_options":[],"itemtype":null,"default_value":null,"translations":"[]","date_creation":"2026-10-24 15:54:53","date_mod":"2026-10-24 15:54:53"},{"id":14,"assets_assetdefinitions_id":3,"system_name":"ic_b","label":"ic_b","type":"Glpi\\Asset\\CustomFieldType\\StringType","field_options":[],"itemtype":null,"default_value":null,"translations":"[]","date_creation":"2026-10-24 15:54:53","date_mod":"2026-10-24 15:54:53"},{"id":15,"assets_assetdefinitions_id":3,"system_name":"ic_both","label":"ic_both","type":"Glpi\\Asset\\CustomFieldType\\StringType","field_options":[],"itemtype":null,"default_value":null,"translations":"[]","date_creation":"2026-10-24 15:54:53","date_mod":"2026-10-24 15:54:53"},{"id":16,"assets_assetdefinitions_id":3,"system_name":"ic_option","label":"ic_option","type":"Glpi\\Asset\\CustomFieldType\\DropdownType","field_options":[],"itemtype":"Manufacturer","default_value":null,"translations":"[]","date_creation":"2026-10-24 15:54:53","date_mod":"2026-10-24 15:54:53"},{"id":17,"assets_assetdefinitions_id":3,"system_name":"ic_datetime","label":"ic_datetime","type":"Glpi\\Asset\\CustomFieldType\\DateTimeType","field_options":[],"itemtype":null,"default_value":null,"translations":"[]","date_creation":"2026-10-24 15:54:53","date_mod":"2026-10-24 15:54:53"}],"manufacturer":7}
```

Stderr:
```text

```

### Local 2 — IC01 IC03 permitted concrete zero-match and queue baseline read-only

Native CLI user 12; exit 0. Bootstrap: vendor/autoload.php → Kernel boot → Auth user → Session::init → Plugin::init.

```php
$t='Glpi\\CustomAsset\\AgentBICReq20261024Asset';$o='Glpi\\CustomAsset\\AgentBICOther20261024Asset';echo json_encode(['native_zero'=>count($DB->request(['FROM'=>Computer::getTable(),'WHERE'=>['entities_id'=>0,'serial'=>'AGENTB-IC-NATIVE']])),'requested_type_zero'=>count($DB->request(['FROM'=>$t::getTable(),'WHERE'=>['entities_id'=>0,'serial'=>'AGENTB-IC-SHARED']+$t::getSystemSQLCriteria()])),'other_type_one'=>count($DB->request(['FROM'=>$o::getTable(),'WHERE'=>['entities_id'=>0,'serial'=>'AGENTB-IC-SHARED']+$o::getSystemSQLCriteria()])),'queue_count'=>countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[])]);
```

Stdout:
```json
{"native_zero":0,"requested_type_zero":0,"other_type_one":1,"queue_count":15}
```

Stderr:
```text

```

### Local 3 — IC first native grouped mandatory and custom concrete creation batch

Native CLI user 2; exit 0. Bootstrap: vendor/autoload.php → Kernel boot → Auth user → Session::init → Plugin::init.

```php
$_SESSION['glpicronuserrunning']='IC scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=$before?iterator_to_array($DB->request(['FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC'])):[];$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Stdout:
```json
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"59":{"id":59,"work_id":"inbound-c-20261024-native-grouped-first","status":"Accepted"},"60":{"id":60,"work_id":"inbound-c-20261024-custom-concrete-first","status":"Accepted"},"61":{"id":61,"work_id":"inbound-c-20261024-same-source-second","status":"Accepted"},"62":{"id":62,"work_id":"inbound-c-20261024-competing-source","status":"Accepted"}},"after":{"59":{"id":59,"work_id":"inbound-c-20261024-native-grouped-first","route_id":"inbound-c-20261024-main","a_entities_id":9400,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":944001,\"b_items_id\":null,\"serial\":\"AGENTB-IC-NATIVE\"}","a_values_json":"{\"ic_name\":\"AgentB IC native first copy\",\"ic_serial\":\"AGENTB-IC-NATIVE\",\"ic_b_text\":\"AgentB IC B owned label seed\",\"ic_both_text\":\"AgentB IC Both seed\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}","a_change_times_json":"{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":944001,"b_items_id":153,"link_state":"Active","processing_started_at":"2026-10-24 15:55:41","status":"Done","result_json":"{\"b_items_id\":153,\"created_b_items_id\":153,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ic_absent\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled first-copy mapping\"},{\"mapping_id\":\"ic_name\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_serial\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_b_text\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_both_text\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_option\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_fields_one\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_fields_two\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_fields_later\",\"outcome\":\"AppliedToB\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 15:55:41","date_mod":"2026-10-24 15:55:41","completed_at":"2026-10-24 15:55:41"},"60":{"id":60,"work_id":"inbound-c-20261024-custom-concrete-first","route_id":"inbound-c-20261024-main","a_entities_id":9400,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBICReq20261024Asset","identity_json":"{\"a_items_id\":944101,\"b_items_id\":null,\"serial\":\"AGENTB-IC-SHARED\"}","a_values_json":"{\"ic_custom_name\":\"AgentB IC requested concrete first copy\",\"ic_custom_serial\":\"AGENTB-IC-SHARED\",\"ic_custom_a\":\"IC A source seed\",\"ic_custom_b\":\"IC B source seed\",\"ic_custom_both\":\"IC Both source seed\",\"ic_custom_option\":\"AgentB IC Maker\",\"ic_custom_datetime\":\"2026-10-24 17:18:19\"}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":944101,"b_items_id":4,"link_state":"Active","processing_started_at":"2026-10-24 15:55:41","status":"Done","result_json":"{\"b_items_id\":4,\"created_b_items_id\":4,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ic_custom_name\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_custom_serial\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_custom_a\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_custom_b\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_custom_both\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_custom_option\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_custom_datetime\",\"outcome\":\"AppliedToB\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 15:55:41","date_mod":"2026-10-24 15:55:41","completed_at":"2026-10-24 15:55:41"},"61":{"id":61,"work_id":"inbound-c-20261024-same-source-second","route_id":"inbound-c-20261024-main","a_entities_id":9400,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":944001,\"b_items_id\":null,\"serial\":\"AGENTB-IC-NATIVE\"}","a_values_json":"{\"ic_name\":\"AgentB IC native first copy\",\"ic_serial\":\"AGENTB-IC-NATIVE\",\"ic_b_text\":\"MUST NOT RESEED B\",\"ic_both_text\":\"MUST NOT RESEED BOTH\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}","a_change_times_json":"{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":944001,"b_items_id":153,"link_state":"Active","processing_started_at":"2026-10-24 15:55:41","status":"Held","result_json":"{\"b_items_id\":153,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ic_name\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ic_serial\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ic_b_text\",\"outcome\":\"Skipped\",\"reason\":\"B return processing is not installed yet\"},{\"mapping_id\":\"ic_both_text\",\"outcome\":\"Skipped\",\"reason\":\"Both conflict processing is not installed yet\"},{\"mapping_id\":\"ic_option\",\"outcome\":\"Skipped\",\"reason\":\"B return processing is not installed yet\"},{\"mapping_id\":\"ic_absent\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ic_fields_one\",\"outcome\":\"Skipped\",\"reason\":\"B return processing is not installed yet\"},{\"mapping_id\":\"ic_fields_two\",\"outcome\":\"Skipped\",\"reason\":\"Both conflict processing is not installed yet\"},{\"mapping_id\":\"ic_fields_later\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":"Both conflict processing is not installed yet","date_creation":"2026-10-24 15:55:41","date_mod":"2026-10-24 15:55:41","completed_at":null},"62":{"id":62,"work_id":"inbound-c-20261024-competing-source","route_id":"inbound-c-20261024-main","a_entities_id":9400,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":944002,\"b_items_id\":null,\"serial\":\"AGENTB-IC-NATIVE\"}","a_values_json":"{\"ic_name\":\"AgentB IC native first copy\",\"ic_serial\":\"AGENTB-IC-NATIVE\",\"ic_b_text\":\"AgentB IC B owned label seed\",\"ic_both_text\":\"AgentB IC Both seed\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}","a_change_times_json":"{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":944002,"b_items_id":null,"link_state":null,"processing_started_at":"2026-10-24 15:55:41","status":"Held","result_json":"{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}","error":"B asset has competing retained source ownership","date_creation":"2026-10-24 15:55:41","date_mod":"2026-10-24 15:55:41","completed_at":null}},"logs":{"245":{"id":245,"crontasks_id":51,"crontasklogs_id":244,"date":"2026-10-24 15:55:41","state":2,"elapsed":0.087687,"volume":4,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}
```

Stderr:
```text

```

### Local 4 — IC grouped mandatory Fields raw storage, defaults, History and guard proof

Native CLI user 12; exit 0. Bootstrap: vendor/autoload.php → Kernel boot → Auth user → Session::init → Plugin::init.

```php
$x=new Computer();$x->getFromDB(153);$rows=[];foreach([8,9]as$cid){$c=new PluginFieldsContainer();$c->getFromDB($cid);$cl=PluginFieldsContainer::getClassname('Computer',$c->fields['name']);$s=new $cl();$s->getFromDBByCrit(['items_id'=>153]);$rows[$cid]=['class'=>$cl,'storage'=>$s->fields];}echo json_encode(['fields'=>$rows,'queue_count'=>countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[]),'history'=>iterator_to_array($DB->request(['FROM'=>Log::getTable(),'WHERE'=>['itemtype'=>'Computer','items_id'=>153],'ORDER'=>'id ASC'])),'same_serial_native_count'=>countElementsInTable(Computer::getTable(),['serial'=>'AGENTB-IC-NATIVE'])]);
```

Stdout:
```json
{"fields":{"8":{"class":"PluginFieldsComputeragentbicx","storage":{"id":1,"items_id":153,"itemtype":"Computer","plugin_fields_containers_id":8,"entities_id":0,"icreqonefield":"IC mandatory first","icreqtwofield":"IC mandatory second","agentbicxdefaultfield":null}},"9":{"class":"PluginFieldsComputeragentbicy","storage":{"id":1,"items_id":153,"itemtype":"Computer","plugin_fields_containers_id":9,"entities_id":0,"iclaterreqfield":"IC mandatory later container","agentbicydefaultfield":null}}},"queue_count":15,"history":{"139937":{"id":139937,"itemtype":"Computer","items_id":153,"itemtype_link":"0","linked_action":20,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:55:41","id_search_option":0,"old_value":"","new_value":"","old_id":null,"new_id":null},"139938":{"id":139938,"itemtype":"Computer","items_id":153,"itemtype_link":"PluginFieldsComputeragentbicx","linked_action":17,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:55:41","id_search_option":0,"old_value":"","new_value":"N\/A (1)","old_id":null,"new_id":null},"139939":{"id":139939,"itemtype":"Computer","items_id":153,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:55:41","id_search_option":76727,"old_value":"N\/A","new_value":"IC mandatory first","old_id":null,"new_id":null},"139940":{"id":139940,"itemtype":"Computer","items_id":153,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:55:41","id_search_option":76728,"old_value":"N\/A","new_value":"IC mandatory second","old_id":null,"new_id":null},"139941":{"id":139941,"itemtype":"Computer","items_id":153,"itemtype_link":"PluginFieldsComputeragentbicy","linked_action":17,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:55:41","id_search_option":0,"old_value":"","new_value":"N\/A (1)","old_id":null,"new_id":null},"139942":{"id":139942,"itemtype":"Computer","items_id":153,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:55:41","id_search_option":76730,"old_value":"N\/A","new_value":"IC mandatory later container","old_id":null,"new_id":null}},"same_serial_native_count":1}
```

Stderr:
```text

```

### Local 5 — IC retained reuse, actual mandatory rejection and safe skip processing

Native CLI user 2; exit 0. Bootstrap: vendor/autoload.php → Kernel boot → Auth user → Session::init → Plugin::init.

```php
$_SESSION['glpicronuserrunning']='IC scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=$before?iterator_to_array($DB->request(['FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC'])):[];$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Stdout:
```json
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"63":{"id":63,"work_id":"inbound-c-20261024-reuse-after-serial-change","status":"Accepted"},"64":{"id":64,"work_id":"inbound-c-20261024-mandatory-firstcopy-failure","status":"Accepted"},"65":{"id":65,"work_id":"inbound-c-20261024-missing-option-skip","status":"Accepted"},"66":{"id":66,"work_id":"inbound-c-20261024-unverified-other-concrete-claim","status":"Accepted"}},"after":{"63":{"id":63,"work_id":"inbound-c-20261024-reuse-after-serial-change","route_id":"inbound-c-20261024-main","a_entities_id":9400,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":944001,\"b_items_id\":null,\"serial\":\"AGENTB-IC-NATIVE\"}","a_values_json":"{\"ic_name\":\"AgentB IC regular Sync after first copy\",\"ic_serial\":\"AGENTB-IC-NATIVE-CHANGED\",\"ic_b_text\":\"MUST NOT RESEED B AFTER SERIAL\",\"ic_both_text\":\"MUST NOT RESEED BOTH AFTER SERIAL\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"MUST NOT RESEED B FIELD\",\"ic_fields_two\":\"MUST NOT RESEED BOTH FIELD\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}","a_change_times_json":"{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":944001,"b_items_id":153,"link_state":"Active","processing_started_at":"2026-10-24 15:57:19","status":"Held","result_json":"{\"b_items_id\":153,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ic_name\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_serial\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ic_b_text\",\"outcome\":\"Skipped\",\"reason\":\"B return processing is not installed yet\"},{\"mapping_id\":\"ic_both_text\",\"outcome\":\"Skipped\",\"reason\":\"Both conflict processing is not installed yet\"},{\"mapping_id\":\"ic_option\",\"outcome\":\"Skipped\",\"reason\":\"B return processing is not installed yet\"},{\"mapping_id\":\"ic_absent\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"ic_fields_one\",\"outcome\":\"Skipped\",\"reason\":\"B return processing is not installed yet\"},{\"mapping_id\":\"ic_fields_two\",\"outcome\":\"Skipped\",\"reason\":\"Both conflict processing is not installed yet\"},{\"mapping_id\":\"ic_fields_later\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":"Both conflict processing is not installed yet","date_creation":"2026-10-24 15:57:19","date_mod":"2026-10-24 15:57:19","completed_at":null},"64":{"id":64,"work_id":"inbound-c-20261024-mandatory-firstcopy-failure","route_id":"inbound-c-20261024-main","a_entities_id":9400,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":944003,\"b_items_id\":null,\"serial\":\"AGENTB-IC-MANDATORY-FAIL\"}","a_values_json":"{\"ic_name\":\"AgentB IC mandatory failure must rollback\",\"ic_serial\":\"AGENTB-IC-MANDATORY-FAIL\",\"ic_b_text\":\"AgentB IC B owned label seed\",\"ic_both_text\":\"AgentB IC Both seed\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}","a_change_times_json":"{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":944003,"b_items_id":null,"link_state":null,"processing_started_at":"2026-10-24 15:57:19","status":"Failed","result_json":"{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ic_absent\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled first-copy mapping\"},{\"mapping_id\":\"ic_fields_two\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled first-copy mapping\"},{\"mapping_id\":\"ic_name\",\"outcome\":\"Failed\",\"reason\":\"First-copy transaction was rolled back\"},{\"mapping_id\":\"ic_serial\",\"outcome\":\"Failed\",\"reason\":\"First-copy transaction was rolled back\"},{\"mapping_id\":\"ic_b_text\",\"outcome\":\"Failed\",\"reason\":\"First-copy transaction was rolled back\"},{\"mapping_id\":\"ic_both_text\",\"outcome\":\"Failed\",\"reason\":\"First-copy transaction was rolled back\"},{\"mapping_id\":\"ic_option\",\"outcome\":\"Failed\",\"reason\":\"First-copy transaction was rolled back\"},{\"mapping_id\":\"ic_fields_one\",\"outcome\":\"Failed\",\"reason\":\"First-copy transaction was rolled back\"},{\"mapping_id\":\"ic_fields_later\",\"outcome\":\"Failed\",\"reason\":\"First-copy transaction was rolled back\"}]}","error":"Save failed: GLPI declined first-copy creation","date_creation":"2026-10-24 15:57:19","date_mod":"2026-10-24 15:57:19","completed_at":null},"65":{"id":65,"work_id":"inbound-c-20261024-missing-option-skip","route_id":"inbound-c-20261024-main","a_entities_id":9400,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":944004,\"b_items_id\":null,\"serial\":\"AGENTB-IC-SKIP-OPTION\"}","a_values_json":"{\"ic_name\":\"AgentB IC skipped option first copy\",\"ic_serial\":\"AGENTB-IC-SKIP-OPTION\",\"ic_b_text\":\"AgentB IC B owned label seed\",\"ic_both_text\":\"AgentB IC Both seed\",\"ic_option\":\"AgentB IC nonexistent option\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}","a_change_times_json":"{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":944004,"b_items_id":154,"link_state":"Active","processing_started_at":"2026-10-24 15:57:19","status":"Done","result_json":"{\"b_items_id\":154,\"created_b_items_id\":154,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ic_option\",\"outcome\":\"Skipped\",\"reason\":\"Destination dropdown label has no permitted exact match\"},{\"mapping_id\":\"ic_absent\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled first-copy mapping\"},{\"mapping_id\":\"ic_name\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_serial\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_b_text\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_both_text\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_fields_one\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_fields_two\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ic_fields_later\",\"outcome\":\"AppliedToB\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 15:57:19","date_mod":"2026-10-24 15:57:19","completed_at":"2026-10-24 15:57:19"},"66":{"id":66,"work_id":"inbound-c-20261024-unverified-other-concrete-claim","route_id":"inbound-c-20261024-main","a_entities_id":9400,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBICReq20261024Asset","identity_json":"{\"a_items_id\":944199,\"b_items_id\":3,\"serial\":\"AGENTB-IC-SHARED\"}","a_values_json":"{\"ic_custom_name\":\"AgentB IC requested concrete first copy\",\"ic_custom_serial\":\"AGENTB-IC-SHARED\",\"ic_custom_a\":\"IC A source seed\",\"ic_custom_b\":\"IC B source seed\",\"ic_custom_both\":\"IC Both source seed\",\"ic_custom_option\":\"AgentB IC Maker\",\"ic_custom_datetime\":\"2026-10-24 17:18:19\"}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":944199,"b_items_id":null,"link_state":null,"processing_started_at":"2026-10-24 15:57:19","status":"Held","result_json":"{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}","error":"Claimed B ID has no retained verified link evidence","date_creation":"2026-10-24 15:57:19","date_mod":"2026-10-24 15:57:19","completed_at":null}},"logs":{"247":{"id":247,"crontasks_id":51,"crontasklogs_id":246,"date":"2026-10-24 15:57:19","state":2,"elapsed":0.104049,"volume":4,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}
```

Stderr:
```text

```

### Local 6 — IC temporarily remove CREATE only on fresh profile14

Native CLI user 2; exit 0. Bootstrap: vendor/autoload.php → Kernel boot → Auth user → Session::init → Plugin::init.

```php
ProfileRight::updateProfileRights(14,['computer'=>READ|UPDATE]); echo json_encode(['computer'=>(new ProfileRight())->find(['profiles_id'=>14,'name'=>'computer'])]);
```

Stdout:
```json
{"computer":{"1354":{"id":1354,"profiles_id":14,"name":"computer","rights":3}}}
```

Stderr:
```text

```

### Local 7 — IC denied current CREATE must not create

Native CLI user 2; exit 0. Bootstrap: vendor/autoload.php → Kernel boot → Auth user → Session::init → Plugin::init.

```php
$_SESSION['glpicronuserrunning']='IC scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=$before?iterator_to_array($DB->request(['FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC'])):[];$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Stdout:
```json
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"67":{"id":67,"work_id":"inbound-c-20261024-create-denied","status":"Accepted"}},"after":{"67":{"id":67,"work_id":"inbound-c-20261024-create-denied","route_id":"inbound-c-20261024-main","a_entities_id":9400,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":944005,\"b_items_id\":null,\"serial\":\"AGENTB-IC-CREATE-DENIED\"}","a_values_json":"{\"ic_name\":\"AgentB IC denied creation\",\"ic_serial\":\"AGENTB-IC-CREATE-DENIED\",\"ic_b_text\":\"AgentB IC B owned label seed\",\"ic_both_text\":\"AgentB IC Both seed\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}","a_change_times_json":"{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":944005,"b_items_id":null,"link_state":null,"processing_started_at":"2026-10-24 16:00:16","status":"Held","result_json":"{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}","error":"Hold: submitting user lacks current asset CREATE permission","date_creation":"2026-10-24 16:00:16","date_mod":"2026-10-24 16:00:16","completed_at":null}},"logs":{"249":{"id":249,"crontasks_id":51,"crontasklogs_id":248,"date":"2026-10-24 16:00:16","state":2,"elapsed":0.013114,"volume":1,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}
```

Stderr:
```text

```

### Local 8 — IC restore fresh profile14 Computer mask

Native CLI user 2; exit 0. Bootstrap: vendor/autoload.php → Kernel boot → Auth user → Session::init → Plugin::init.

```php
ProfileRight::updateProfileRights(14,['computer'=>READ|UPDATE|CREATE]); echo json_encode(['computer'=>(new ProfileRight())->find(['profiles_id'=>14,'name'=>'computer'])]);
```

Stdout:
```json
{"computer":{"1354":{"id":1354,"profiles_id":14,"name":"computer","rights":7}}}
```

Stderr:
```text

```

### Local 9 — IC stale route prevents first-copy create

Native CLI user 2; exit 0. Bootstrap: vendor/autoload.php → Kernel boot → Auth user → Session::init → Plugin::init.

```php
$_SESSION['glpicronuserrunning']='IC scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=$before?iterator_to_array($DB->request(['FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC'])):[];$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Stdout:
```json
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"68":{"id":68,"work_id":"inbound-c-20261024-stale-settings","status":"Accepted"}},"after":{"68":{"id":68,"work_id":"inbound-c-20261024-stale-settings","route_id":"inbound-c-20261024-main","a_entities_id":9400,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":944006,\"b_items_id\":null,\"serial\":\"AGENTB-IC-VERSION\"}","a_values_json":"{\"ic_name\":\"AgentB IC stale route must not create\",\"ic_serial\":\"AGENTB-IC-VERSION\",\"ic_b_text\":\"AgentB IC B owned label seed\",\"ic_both_text\":\"AgentB IC Both seed\",\"ic_option\":\"AgentB IC Maker\",\"ic_fields_one\":\"IC mandatory first\",\"ic_fields_two\":\"IC mandatory second\",\"ic_fields_later\":\"IC mandatory later container\",\"ic_disabled\":\"MUST NOT SEED DISABLED\",\"unmapped\":\"MUST NOT SEED UNMAPPED\"}","a_change_times_json":"{\"ic_both_text\":{\"changed_at\":null,\"reliable\":false}}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":944006,"b_items_id":null,"link_state":null,"processing_started_at":"2026-10-24 16:00:25","status":"Held","result_json":"{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","date_creation":"2026-10-24 16:00:25","date_mod":"2026-10-24 16:00:25","completed_at":null}},"logs":{"251":{"id":251,"crontasks_id":51,"crontasklogs_id":250,"date":"2026-10-24 16:00:25","state":2,"elapsed":0.00902414,"volume":1,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}
```

Stderr:
```text

```

### Local 10 — IC final native inventory rollback storage concrete identity History and rights

Native CLI user 12; exit 0. Bootstrap: vendor/autoload.php → Kernel boot → Auth user → Session::init → Plugin::init.

```php
require_once '/var/www/glpi/plugins/agentbdmosassetsync/inc/process.php'; $type='Glpi\\CustomAsset\\AgentBICReq20261024Asset'; $other='Glpi\\CustomAsset\\AgentBICOther20261024Asset'; $w=new PluginAgentbdmosassetsyncWork();$w->getFromDB(60);$wrong=new $type();$loaded=$wrong->getFromDB(3);try{plugin_agentbdmosassetsync_check_asset($wrong,$w->fields,READ);$wrongResult='UNEXPECTED ALLOWED';}catch(Throwable $e){$wrongResult=$e->getMessage();}$rows=[];foreach([8,9]as$cid){$c=new PluginFieldsContainer();$c->getFromDB($cid);$cl=PluginFieldsContainer::getClassname('Computer',$c->fields['name']);$rows[$cid]=['class'=>$cl,'rows'=>(new $cl())->find([])];}$counts=[];foreach(['AGENTB-IC-MANDATORY-FAIL','AGENTB-IC-CREATE-DENIED','AGENTB-IC-VERSION']as$sn){$counts[$sn]=countElementsInTable(Computer::getTable(),['serial'=>$sn]);} echo json_encode(['negativeSerialCounts'=>$counts,'freshComputers'=>(new Computer())->find(['id'=>['>',152]]),'customShared'=>iterator_to_array($DB->request(['FROM'=>$type::getTable(),'WHERE'=>['serial'=>'AGENTB-IC-SHARED']])),'requestedCriteria'=>$type::getSystemSQLCriteria(),'otherCriteria'=>$other::getSystemSQLCriteria(),'wrongLoadedID3'=>$loaded,'wrongLoadedDefinition'=>$wrong->fields['assets_assetdefinitions_id'],'wrongConcreteGuard'=>$wrongResult,'fieldsStorage'=>$rows,'nativeHistory'=>iterator_to_array($DB->request(['FROM'=>Log::getTable(),'WHERE'=>['itemtype'=>'Computer','items_id'=>[153,154]],'ORDER'=>'id ASC'])),'customHistory'=>iterator_to_array($DB->request(['FROM'=>Log::getTable(),'WHERE'=>['itemtype'=>$type,'items_id'=>4],'ORDER'=>'id ASC'])),'queueCount'=>countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[]),'computerRights'=>(new ProfileRight())->find(['profiles_id'=>14,'name'=>'computer']),'containerRights'=>(new PluginFieldsProfile())->find(['plugin_fields_containers_id'=>[8,9]])]);
```

Stdout:
```json
{"negativeSerialCounts":{"AGENTB-IC-MANDATORY-FAIL":0,"AGENTB-IC-CREATE-DENIED":0,"AGENTB-IC-VERSION":0},"freshComputers":{"153":{"id":153,"entities_id":0,"name":"AgentB IC regular Sync after first copy","serial":"AGENTB-IC-NATIVE-CHANGED","otherserial":null,"contact":"AgentB IC Both seed","contact_num":null,"users_id_tech":0,"comment":"AgentB IC B owned label seed","date_mod":"2026-10-24 15:57:19","autoupdatesystems_id":0,"locations_id":0,"networks_id":0,"computermodels_id":0,"computertypes_id":0,"is_template":0,"template_name":null,"manufacturers_id":7,"is_deleted":0,"is_dynamic":0,"users_id":0,"states_id":0,"ticket_tco":"0.0000","uuid":null,"date_creation":"2026-10-24 15:55:41","is_recursive":0,"last_inventory_update":null,"last_boot":null},"154":{"id":154,"entities_id":0,"name":"AgentB IC skipped option first copy","serial":"AGENTB-IC-SKIP-OPTION","otherserial":null,"contact":"AgentB IC Both seed","contact_num":null,"users_id_tech":0,"comment":"AgentB IC B owned label seed","date_mod":"2026-10-24 15:57:19","autoupdatesystems_id":0,"locations_id":0,"networks_id":0,"computermodels_id":0,"computertypes_id":0,"is_template":0,"template_name":null,"manufacturers_id":0,"is_deleted":0,"is_dynamic":0,"users_id":0,"states_id":0,"ticket_tco":"0.0000","uuid":null,"date_creation":"2026-10-24 15:57:19","is_recursive":0,"last_inventory_update":null,"last_boot":null}},"customShared":{"3":{"id":3,"assets_assetdefinitions_id":4,"assets_assetmodels_id":0,"assets_assettypes_id":0,"name":"AgentB IC other definition must stay","uuid":null,"comment":null,"serial":"AGENTB-IC-SHARED","otherserial":null,"contact":null,"contact_num":null,"users_id":0,"users_id_tech":0,"locations_id":0,"manufacturers_id":0,"states_id":0,"entities_id":0,"is_recursive":0,"is_deleted":0,"is_template":0,"is_dynamic":0,"template_name":null,"autoupdatesystems_id":0,"date_creation":"2026-10-24 15:54:53","date_mod":"2026-10-24 15:54:53","last_inventory_update":null,"custom_fields":"[]"},"4":{"id":4,"assets_assetdefinitions_id":3,"assets_assetmodels_id":0,"assets_assettypes_id":0,"name":"AgentB IC requested concrete first copy","uuid":null,"comment":null,"serial":"AGENTB-IC-SHARED","otherserial":null,"contact":null,"contact_num":null,"users_id":0,"users_id_tech":0,"locations_id":0,"manufacturers_id":0,"states_id":0,"entities_id":0,"is_recursive":0,"is_deleted":0,"is_template":0,"is_dynamic":0,"template_name":null,"autoupdatesystems_id":0,"date_creation":"2026-10-24 15:55:41","date_mod":"2026-10-24 15:55:41","last_inventory_update":null,"custom_fields":"{\"13\": \"IC A source seed\", \"14\": \"IC B source seed\", \"15\": \"IC Both source seed\", \"16\": 7, \"17\": \"2026-10-24 09:18:19\"}"}},"requestedCriteria":{"2253998382":{"assets_assetdefinitions_id":3}},"otherCriteria":{"2199281579":{"assets_assetdefinitions_id":4}},"wrongLoadedID3":true,"wrongLoadedDefinition":4,"wrongConcreteGuard":"Asset concrete itemtype does not match requested type","fieldsStorage":{"8":{"class":"PluginFieldsComputeragentbicx","rows":{"1":{"id":1,"items_id":153,"itemtype":"Computer","plugin_fields_containers_id":8,"entities_id":0,"icreqonefield":"IC mandatory first","icreqtwofield":"IC mandatory second","agentbicxdefaultfield":null},"2":{"id":2,"items_id":154,"itemtype":"Computer","plugin_fields_containers_id":8,"entities_id":0,"icreqonefield":"IC mandatory first","icreqtwofield":"IC mandatory second","agentbicxdefaultfield":null}}},"9":{"class":"PluginFieldsComputeragentbicy","rows":{"1":{"id":1,"items_id":153,"itemtype":"Computer","plugin_fields_containers_id":9,"entities_id":0,"iclaterreqfield":"IC mandatory later container","agentbicydefaultfield":null},"2":{"id":2,"items_id":154,"itemtype":"Computer","plugin_fields_containers_id":9,"entities_id":0,"iclaterreqfield":"IC mandatory later container","agentbicydefaultfield":null}}}},"nativeHistory":{"139937":{"id":139937,"itemtype":"Computer","items_id":153,"itemtype_link":"0","linked_action":20,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:55:41","id_search_option":0,"old_value":"","new_value":"","old_id":null,"new_id":null},"139938":{"id":139938,"itemtype":"Computer","items_id":153,"itemtype_link":"PluginFieldsComputeragentbicx","linked_action":17,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:55:41","id_search_option":0,"old_value":"","new_value":"N\/A (1)","old_id":null,"new_id":null},"139939":{"id":139939,"itemtype":"Computer","items_id":153,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:55:41","id_search_option":76727,"old_value":"N\/A","new_value":"IC mandatory first","old_id":null,"new_id":null},"139940":{"id":139940,"itemtype":"Computer","items_id":153,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:55:41","id_search_option":76728,"old_value":"N\/A","new_value":"IC mandatory second","old_id":null,"new_id":null},"139941":{"id":139941,"itemtype":"Computer","items_id":153,"itemtype_link":"PluginFieldsComputeragentbicy","linked_action":17,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:55:41","id_search_option":0,"old_value":"","new_value":"N\/A (1)","old_id":null,"new_id":null},"139942":{"id":139942,"itemtype":"Computer","items_id":153,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:55:41","id_search_option":76730,"old_value":"N\/A","new_value":"IC mandatory later container","old_id":null,"new_id":null},"139975":{"id":139975,"itemtype":"Computer","items_id":153,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:57:19","id_search_option":1,"old_value":"AgentB IC native first copy","new_value":"AgentB IC genuine after creation","old_id":null,"new_id":null},"139976":{"id":139976,"itemtype":"Computer","items_id":153,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:57:19","id_search_option":5,"old_value":"AGENTB-IC-NATIVE","new_value":"AGENTB-IC-NATIVE-CHANGED","old_id":null,"new_id":null},"139978":{"id":139978,"itemtype":"Computer","items_id":153,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:57:19","id_search_option":1,"old_value":"AgentB IC genuine after creation","new_value":"AgentB IC regular Sync after first copy","old_id":null,"new_id":null},"139979":{"id":139979,"itemtype":"Computer","items_id":154,"itemtype_link":"0","linked_action":20,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:57:19","id_search_option":0,"old_value":"","new_value":"","old_id":null,"new_id":null},"139980":{"id":139980,"itemtype":"Computer","items_id":154,"itemtype_link":"PluginFieldsComputeragentbicx","linked_action":17,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:57:19","id_search_option":0,"old_value":"","new_value":"N\/A (2)","old_id":null,"new_id":null},"139981":{"id":139981,"itemtype":"Computer","items_id":154,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:57:19","id_search_option":76727,"old_value":"N\/A","new_value":"IC mandatory first","old_id":null,"new_id":null},"139982":{"id":139982,"itemtype":"Computer","items_id":154,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:57:19","id_search_option":76728,"old_value":"N\/A","new_value":"IC mandatory second","old_id":null,"new_id":null},"139983":{"id":139983,"itemtype":"Computer","items_id":154,"itemtype_link":"PluginFieldsComputeragentbicy","linked_action":17,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:57:19","id_search_option":0,"old_value":"","new_value":"N\/A (2)","old_id":null,"new_id":null},"139984":{"id":139984,"itemtype":"Computer","items_id":154,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 15:57:19","id_search_option":76730,"old_value":"N\/A","new_value":"IC mandatory later container","old_id":null,"new_id":null}},"customHistory":[],"queueCount":16,"computerRights":{"1354":{"id":1354,"profiles_id":14,"name":"computer","rights":7}},"containerRights":{"80":{"id":80,"profiles_id":1,"plugin_fields_containers_id":8,"right":"0"},"81":{"id":81,"profiles_id":2,"plugin_fields_containers_id":8,"right":"0"},"82":{"id":82,"profiles_id":3,"plugin_fields_containers_id":8,"right":"0"},"83":{"id":83,"profiles_id":4,"plugin_fields_containers_id":8,"right":"0"},"84":{"id":84,"profiles_id":5,"plugin_fields_containers_id":8,"right":"0"},"85":{"id":85,"profiles_id":6,"plugin_fields_containers_id":8,"right":"0"},"86":{"id":86,"profiles_id":7,"plugin_fields_containers_id":8,"right":"0"},"87":{"id":87,"profiles_id":8,"plugin_fields_containers_id":8,"right":"0"},"88":{"id":88,"profiles_id":9,"plugin_fields_containers_id":8,"right":"0"},"89":{"id":89,"profiles_id":10,"plugin_fields_containers_id":8,"right":"0"},"90":{"id":90,"profiles_id":11,"plugin_fields_containers_id":8,"right":"0"},"91":{"id":91,"profiles_id":12,"plugin_fields_containers_id":8,"right":"0"},"92":{"id":92,"profiles_id":13,"plugin_fields_containers_id":8,"right":"0"},"93":{"id":93,"profiles_id":14,"plugin_fields_containers_id":8,"right":"4"},"94":{"id":94,"profiles_id":15,"plugin_fields_containers_id":8,"right":"0"},"95":{"id":95,"profiles_id":1,"plugin_fields_containers_id":9,"right":"0"},"96":{"id":96,"profiles_id":2,"plugin_fields_containers_id":9,"right":"0"},"97":{"id":97,"profiles_id":3,"plugin_fields_containers_id":9,"right":"0"},"98":{"id":98,"profiles_id":4,"plugin_fields_containers_id":9,"right":"0"},"99":{"id":99,"profiles_id":5,"plugin_fields_containers_id":9,"right":"0"},"100":{"id":100,"profiles_id":6,"plugin_fields_containers_id":9,"right":"0"},"101":{"id":101,"profiles_id":7,"plugin_fields_containers_id":9,"right":"0"},"102":{"id":102,"profiles_id":8,"plugin_fields_containers_id":9,"right":"0"},"103":{"id":103,"profiles_id":9,"plugin_fields_containers_id":9,"right":"0"},"104":{"id":104,"profiles_id":10,"plugin_fields_containers_id":9,"right":"0"},"105":{"id":105,"profiles_id":11,"plugin_fields_containers_id":9,"right":"0"},"106":{"id":106,"profiles_id":12,"plugin_fields_containers_id":9,"right":"0"},"107":{"id":107,"profiles_id":13,"plugin_fields_containers_id":9,"right":"0"},"108":{"id":108,"profiles_id":14,"plugin_fields_containers_id":9,"right":"4"},"109":{"id":109,"profiles_id":15,"plugin_fields_containers_id":9,"right":"0"}}}
```

Stderr:
```text

```
