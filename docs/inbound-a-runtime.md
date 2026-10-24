# Senior 1(a) Work admission runtime evidence — 24 October 2026

Result: READY for independent evidence review. No implementation failure observed in 173 actual manual curl calls. This certifies Work admission only; no matching, option lookup, asset write, background processing, Change capture, correction completion or full product flow is certified.

Deployment: only reviewed inbound-a candidate inc/work.class.php copied to assetsync2-glpib:/var/www/glpi/plugins/agentbdmosassetsync/inc/work.class.php. Target http://localhost:8081/api.php/v1, existing GLPI 11.0.7 installation. No other file deployed. No repository edit or commit/push.

Operator used ad-hoc interactive curl invocations with request headers and session tokens held only in memory. No automated test assertions, runner or regression harness was created. Complete exact request bodies and responses are below; credentials and session tokens are redacted. GET has no body. Common headers: Accept: application/json; Content-Type: application/json; App-Token: [REDACTED]. Login also has Authorization: user_token [REDACTED]; all other calls have Session-Token: [REDACTED]. Five created sessions closed with HTTP200 true: first service, second independent service concurrency session, outside, denied, containment service.

Accounts: service user12/profile14/entity0 nonrecursive, Work READ|CREATE=5, no Work UPDATE/DELETE/PURGE; child actor user14/profile14/entity5 nonrecursive; no-rights actor user13/profile15/entity0. Service profile and entity were read back at beginning. Child entity read back; persisted child metadata confirms user14/profile14. No existing profile/account privilege changed.

WA01 PASS: singleton201; stored default Sync and handled[], Accepted; derived user12/profile14/a_items_id910001; all B link/processing/result/error/completed fields null. Exact-ID readback unchanged after duplicate and PUT denial. Native date_creation/date_mod persisted (2026-10-24 14:46:32), distinct from genuine +08:00 field evidence.
WA02 PASS: one-element and multi-element arrays201; string/integer/finite decimal/boolean/null scalar values and empty times round-tripped unchanged. Identity null B and serial accepted, pending later holding.
WA03 PASS: every declared B-owned key individually rejected, including nullable/default/current values. No forged row in final inventories.
WA04 PASS: _add/_no_history/_from_api/_agentbdmosassetsync_internal and unknown properties rejected; missing entities_id rejected before trusting API defaults. Owned+unknown+missing prioritizes owned; unknown keys lexical order; required missing has stable prefix.
WA05 PASS observed cases: every required key omitted individually; uint type/bounds/zero rules; work/route invalid/empty/overlength; itemtype invalid/empty/overlength. Some unauthorized target entities (negative/float/overflow) fail native permission check before plugin shape validation, correctly not claimed as ASB shape proof. Opaque A entity float/bool/negative/overflow fail plugin uint validation.
WA06 PASS observed cases: every JSON_TEXT field nested/malformed/null/wrong inner root rejected; identity exact keys, A/B zero/string IDs and empty/numeric serial rejected; valid null B/serial and positive claimed B link accepted as unverified input only.
WA07 PASS: scalar/null map accepted; invalid/overlength mapping key, array/object value and overflow numeric JSON1e400 rejected. Valid unmapped scalar keys saved for later worker to ignore; no processing occurred.
WA08 PASS: valid exact +08:00 accepted; empty/missing/null/unreliable evidence retained. Missing/extra evidence properties, string/integer reliability, numeric timestamp, Z/other offset/fraction/no offset/invalid day/month/leap/hour/second/text rejected. No winner chosen.
WA09 PASS admission: Sync default and explicit, Suspend, Resume accepted; operation null/lowercase/unknown/number/object rejected. Both control types reject nonempty values/times/handled IDs and wrong inner object shapes. Accepted controls still have null link_state, no control execution claimed.
WA10 PASS admission: omitted/[] and distinct positive integer handled IDs accepted; nested/malformed/null/object/duplicate/zero/negative/string/float/overflow rejected. Change collection remains empty, so actual existing-row acknowledgement is NOT RUN.
WA11 PASS: identical and changed-payload/route duplicates rejected; duplicate across authorized child entity rejected globally. Two manual concurrent curl clients using separate native sessions: one201 id22, one400 ASB_WORK_EXISTS; exact-key readback has one row. CaseDistinct and casedistinct persisted separately.
WA12 PASS: mixed4-row array207 ERROR_GLPI_PARTIAL_ADD with valid id20, duplicate false, B-owned false, malformed false. All-valid array201 and all-invalid array400 ERROR_GLPI_ADD with false per-row IDs. Exact native wrappers retained below.
WA13 PASS admission boundary, later behavior NOT RUN: unknown route/type, disabled type/route, stale version, no usable identifiers accepted structurally for later holding. Available root Computer collection identical before/after; Change[] identical. No cron/background action invoked. Asset History baseline/after and absent-submit-user/profile native local context NOT RUN; source admission is bounded with no asset write, but runtime History proof is not claimed.
WA14 PASS: saved Work PUT denied400 ERROR_GLPI_UPDATE/native permission message; original row unchanged. Unauthorized entity create denied400 and cross-entity reads403; no-rights create400/read403. No destructive request sent; delete/purge remain source/rights proof.

Containment authorized by coordinator after admission: Setting1 route foundation-20261024-root was the only enabled route used. It is now disabled with settings_version3 through normal PUT and readback (calls170–173). Settings3 foundation-20261024-array and4 foundation-20261024-child were already disabled from foundation. Work11 names nonexistent route inbound-a-20261024-no-route. Thus no part-a Accepted fixture names a currently enabled existing route; future processor must hold these without asset writes. Do not reenable these routes for future runtime fixtures without considering these Accepted rows. No Work status was changed or deletion attempted.

22 Work fixtures preserved: root IDs1–20 and22; child ID21. All Accepted, b_items_id/link_state/processing_started_at/result/error/completed_at null; root submitter12/profile14, child14/profile14. Identity claims are synthetic A IDs910001–910003, mostly no B ID; Work10 inner identity claims B910203 only (not verified or touched). No fixture used a real B asset ID. ID22 concurrency winner. No Change fixtures created.

Limitations: no automated/concurrent stress test, no lock-busy timeout induced, no missing authenticated context forced, no asset/history mutation, no cron invocation. Future processor/matching/first copy/field conversions/time comparisons/controls/recovery/Change/helper/ack/corrections/end-to-end all NOT RUN. Existing passed foundation checks were not rerun, apart from necessary session/profile/entity/Setting context for these new Work calls.

Operator note: one initial large interactive input was locally corrupted and raised Python SyntaxError before its two intended calls (Resume and owned-id). Those were subsequently submitted once each, recorded35/36. No HTTP request or plugin defect resulted. Concurrent completion order is ledger order; console display was abbreviated, but both requests/responses are preserved in the ledger.

## Fixture inventory

| ID | Work ID | Route | Entity | Operation | Itemtype |
|---|---|---|---|---|---|
| 1 | inbound-a-20261024-accepted-default | foundation-20261024-root | 0 | Sync | Computer |
| 2 | inbound-a-20261024-accepted-array-scalars | foundation-20261024-root | 0 | Sync | Computer |
| 3 | inbound-a-20261024-accepted-time-null | foundation-20261024-root | 0 | Sync | Computer |
| 4 | inbound-a-20261024-accepted-time-unreliable | foundation-20261024-root | 0 | Sync | Computer |
| 5 | inbound-a-20261024-accepted-time-missing | foundation-20261024-root | 0 | Sync | Computer |
| 6 | inbound-a-20261024-accepted-sync | foundation-20261024-root | 0 | Sync | Computer |
| 7 | inbound-a-20261024-accepted-suspend | foundation-20261024-root | 0 | Suspend | Computer |
| 8 | inbound-a-20261024-accepted-resume | foundation-20261024-root | 0 | Resume | Computer |
| 9 | inbound-a-20261024-accepted-null-unreliable | foundation-20261024-root | 0 | Sync | Computer |
| 10 | inbound-a-20261024-accepted-identity-link | foundation-20261024-root | 0 | Sync | Computer |
| 11 | inbound-a-20261024-accepted-unknown-route | inbound-a-20261024-no-route | 0 | Sync | Computer |
| 12 | inbound-a-20261024-accepted-unknown-type | foundation-20261024-root | 0 | Sync | ImaginaryAssetType |
| 13 | inbound-a-20261024-accepted-disabled-type | foundation-20261024-root | 0 | Sync | Printer |
| 14 | inbound-a-20261024-accepted-disabled-route | foundation-20261024-array | 0 | Sync | Computer |
| 15 | inbound-a-20261024-accepted-old-version | foundation-20261024-root | 0 | Sync | Computer |
| 16 | inbound-a-20261024-CaseDistinct | foundation-20261024-root | 0 | Sync | Computer |
| 17 | inbound-a-20261024-casedistinct | foundation-20261024-root | 0 | Sync | Computer |
| 18 | inbound-a-20261024-valid-bulk-1 | foundation-20261024-root | 0 | Sync | Computer |
| 19 | inbound-a-20261024-valid-bulk-2 | foundation-20261024-root | 0 | Sync | Computer |
| 20 | inbound-a-20261024-mixed-valid | foundation-20261024-root | 0 | Sync | Computer |
| 21 | inbound-a-20261024-outside-child | foundation-20261024-child | 5 | Sync | Computer |
| 22 | inbound-a-20261024-concurrent | foundation-20261024-root | 0 | Sync | Computer |

## Exact actual curl ledger

### 1 — restricted service login

Account: service; method: GET; URL: `http://localhost:8081/api.php/v1/initSession`; HTTP 200.

Request body:

```json
null
```

Response:

```json
{
  "session_token": "[REDACTED]"
}
```

### 2 — restricted profile readback

Account: service; method: GET; URL: `http://localhost:8081/api.php/v1/getActiveProfile`; HTTP 200.

Request body:

```json
null
```

Response:

```json
{
  "active_profile": {
    "id": 14,
    "name": "Agent-B REST service 20261024",
    "interface": "central",
    "is_default": 0,
    "helpdesk_hardware": 0,
    "helpdesk_item_type": [],
    "use_mentions": 1,
    "ticket_status": null,
    "date_mod": "2026-10-24 14:29:13",
    "comment": null,
    "problem_status": null,
    "create_ticket_on_login": 0,
    "tickettemplates_id": 0,
    "changetemplates_id": 0,
    "problemtemplates_id": 0,
    "change_status": null,
    "managed_domainrecordtypes": [],
    "date_creation": "2026-10-24 14:29:13",
    "2fa_enforced": 0,
    "last_rights_update": "2026-10-24 14:29:13",
    "agent": 0,
    "appliance": 0,
    "backup": 0,
    "bookmark_public": 0,
    "budget": 0,
    "cable_management": 0,
    "calendar": 0,
    "cartridge": 0,
    "certificate": 0,
    "change": 0,
    "changevalidation": 0,
    "cluster": 0,
    "computer": 7,
    "config": 0,
    "consumable": 0,
    "contact_enterprise": 0,
    "contract": 0,
    "dashboard": 0,
    "database": 0,
    "datacenter": 0,
    "device": 0,
    "devicesimcard_pinpuk": 0,
    "document": 0,
    "domain": 0,
    "dropdown": 0,
    "entity": 0,
    "externalevent": 0,
    "followup": 0,
    "form": 0,
    "global_validation": 0,
    "group": 0,
    "infocom": 0,
    "internet": 0,
    "inventory": 0,
    "itilcategory": 0,
    "itilfollowuptemplate": 0,
    "itiltemplate": 0,
    "itilvalidationtemplate": 0,
    "knowbase": 0,
    "knowbasecategory": 0,
    "license": 0,
    "line": 0,
    "lineoperator": 0,
    "link": 0,
    "location": 0,
    "locked_field": 0,
    "logs": 0,
    "monitor": 0,
    "networking": 0,
    "notification": 0,
    "oauth_client": 0,
    "password_update": 0,
    "pendingreason": 0,
    "peripheral": 0,
    "personalization": 0,
    "phone": 0,
    "planning": 0,
    "plugin_agentbdmosassetsync_change": 3,
    "plugin_agentbdmosassetsync_setting": 7,
    "plugin_agentbdmosassetsync_work": 5,
    "printer": 0,
    "problem": 0,
    "profile": 0,
    "project": 0,
    "projecttask": 0,
    "queuednotification": 0,
    "recurrentchange": 0,
    "refusedequipment": 0,
    "reminder_public": 0,
    "reports": 0,
    "reservation": 0,
    "rssfeed_public": 0,
    "rule_asset": 0,
    "rule_change": 0,
    "rule_dictionnary_dropdown": 0,
    "rule_dictionnary_printer": 0,
    "rule_dictionnary_software": 0,
    "rule_import": 0,
    "rule_ldap": 0,
    "rule_location": 0,
    "rule_mailcollector": 0,
    "rule_problem": 0,
    "rule_softwarecategories": 0,
    "rule_ticket": 0,
    "search_config": 0,
    "show_group_hardware": 0,
    "slm": 0,
    "snmpcredential": 0,
    "software": 0,
    "solutiontemplate": 0,
    "state": 0,
    "statistic": 0,
    "system_logs": 0,
    "task": 0,
    "taskcategory": 0,
    "tasktemplate": 0,
    "ticket": 0,
    "ticketcost": 0,
    "ticketrecurrent": 0,
    "ticketvalidation": 0,
    "transfer": 0,
    "typedoc": 0,
    "unmanaged": 0,
    "user": 0,
    "entities": [
      {
        "id": 0,
        "name": "Root entity",
        "is_recursive": 0
      }
    ]
  }
}
```

### 3 — restricted entity readback

Account: service; method: GET; URL: `http://localhost:8081/api.php/v1/getActiveEntities`; HTTP 200.

Request body:

```json
null
```

Response:

```json
{
  "active_entity": {
    "id": 0,
    "active_entity_recursive": 0,
    "active_entities": [
      {
        "id": 0
      }
    ]
  }
}
```

### 4 — existing disposable root route context

Account: service; method: GET; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/1?get_hateoas=false&expand_dropdowns=false`; HTTP 200.

Request body:

```json
null
```

Response:

```json
{
  "id": 1,
  "route_id": "foundation-20261024-root",
  "a_entities_id": 0,
  "entities_id": 0,
  "route_enabled": 1,
  "settings_version": 2,
  "enabled_itemtypes_json": "[\"Computer\"]",
  "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
}
```

### 5 — accepted-default

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 201.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-accepted-default",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
{
  "id": 1,
  "message": ""
}
```

### 6 — accepted default metadata readback

Account: service; method: GET; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork/1?get_hateoas=false&expand_dropdowns=false`; HTTP 200.

Request body:

```json
null
```

Response:

```json
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
}
```

### 7 — admission Computer baseline

Account: service; method: GET; URL: `http://localhost:8081/api.php/v1/Computer?range=0-999&get_hateoas=false&expand_dropdowns=false`; HTTP 200.

Request body:

```json
null
```

Response:

```json
[
  {
    "id": 137,
    "entities_id": 0,
    "name": "HMNS Test 1",
    "serial": "HMNS Test 1",
    "otherserial": "HMNS Test 1",
    "contact": "",
    "contact_num": "",
    "users_id_tech": 0,
    "comment": "",
    "date_mod": "2026-10-13 20:56:38",
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
    "uuid": "",
    "date_creation": "2026-10-13 20:56:38",
    "is_recursive": 0,
    "last_inventory_update": null,
    "last_boot": null
  }
]
```

### 8 — admission Change baseline

Account: service; method: GET; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?range=0-999&get_hateoas=false&expand_dropdowns=false`; HTTP 200.

Request body:

```json
null
```

Response:

```json
[]
```

### 9 — accepted-array-scalars

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 201.

Request body:

```json
{
  "input": [
    {
      "work_id": "inbound-a-20261024-accepted-array-scalars",
      "route_id": "foundation-20261024-root",
      "a_entities_id": 0,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":910002,\"b_items_id\":null,\"serial\":null}",
      "a_values_json": "{\"text\":\"Test\",\"integer\":4,\"decimal\":1.5,\"boolean\":false,\"empty\":null}",
      "a_change_times_json": "{}",
      "settings_version": 2
    }
  ]
}
```

Response:

```json
[
  {
    "id": 2,
    "message": ""
  }
]
```

### 10 — accepted-time-null

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 201.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-accepted-time-null",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":null,\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
{
  "id": 3,
  "message": ""
}
```

### 11 — accepted-time-unreliable

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 201.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-accepted-time-unreliable",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T12:00:00+08:00\",\"reliable\":false}}",
    "settings_version": 2
  }
}
```

Response:

```json
{
  "id": 4,
  "message": ""
}
```

### 12 — accepted-time-missing

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 201.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-accepted-time-missing",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{}",
    "settings_version": 2
  }
}
```

Response:

```json
{
  "id": 5,
  "message": ""
}
```

### 13 — accepted-sync

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 201.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-accepted-sync",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "operation": "Sync",
    "handled_change_ids_json": "[910101,910102]"
  }
}
```

Response:

```json
{
  "id": 6,
  "message": ""
}
```

### 14 — accepted-suspend

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 201.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-accepted-suspend",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 2,
    "operation": "Suspend"
  }
}
```

Response:

```json
{
  "id": 7,
  "message": ""
}
```

### 15 — owned-user

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-owned-user",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "submitted_users_id": 12
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_B_OWNED_FIELD: field=submitted_users_id"
]
```

### 16 — owned-profile

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-owned-profile",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "submitted_profiles_id": 14
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_B_OWNED_FIELD: field=submitted_profiles_id"
]
```

### 17 — owned-a-id

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-owned-a-id",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "a_items_id": 910001
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_B_OWNED_FIELD: field=a_items_id"
]
```

### 18 — owned-b-id

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-owned-b-id",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "b_items_id": null
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_B_OWNED_FIELD: field=b_items_id"
]
```

### 19 — owned-link

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-owned-link",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "link_state": null
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_B_OWNED_FIELD: field=link_state"
]
```

### 20 — owned-processing

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-owned-processing",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "processing_started_at": null
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_B_OWNED_FIELD: field=processing_started_at"
]
```

### 21 — owned-status

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-owned-status",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "status": "Accepted"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_B_OWNED_FIELD: field=status"
]
```

### 22 — owned-result

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-owned-result",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "result_json": null
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_B_OWNED_FIELD: field=result_json"
]
```

### 23 — owned-error

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-owned-error",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "error": null
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_B_OWNED_FIELD: field=error"
]
```

### 24 — owned-created

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-owned-created",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "date_creation": null
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_B_OWNED_FIELD: field=date_creation"
]
```

### 25 — owned-mod

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-owned-mod",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "date_mod": null
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_B_OWNED_FIELD: field=date_mod"
]
```

### 26 — owned-completed

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-owned-completed",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "completed_at": null
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_B_OWNED_FIELD: field=completed_at"
]
```

### 27 — unknown-add

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-unknown-add",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "_add": true
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_UNKNOWN_FIELD: field=_add"
]
```

### 28 — unknown-history

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-unknown-history",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "_no_history": true
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_UNKNOWN_FIELD: field=_no_history"
]
```

### 29 — unknown-api

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-unknown-api",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "_from_api": true
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_UNKNOWN_FIELD: field=_from_api"
]
```

### 30 — unknown-internal

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-unknown-internal",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "_agentbdmosassetsync_internal": true
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_UNKNOWN_FIELD: field=_agentbdmosassetsync_internal"
]
```

### 31 — unknown-field

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-unknown-field",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "unexpected": null
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_UNKNOWN_FIELD: field=unexpected"
]
```

### 32 — precedence-owned

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-precedence-owned",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "status": null,
    "unexpected": true
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_B_OWNED_FIELD: field=status"
]
```

### 33 — precedence-unknown

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-precedence-unknown",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "z_unknown": true,
    "a_unknown": false
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_UNKNOWN_FIELD: field=a_unknown"
]
```

### 34 — precedence-required

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-precedence-required",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_REQUIRED_FIELD: field=itemtype"
]
```

### 35 — accepted-resume

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 201.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-accepted-resume",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 2,
    "operation": "Resume",
    "handled_change_ids_json": "[]"
  }
}
```

Response:

```json
{
  "id": 8,
  "message": ""
}
```

### 36 — owned-id

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-owned-id",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "id": null
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_B_OWNED_FIELD: field=id"
]
```

### 37 — missing-work

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_REQUIRED_FIELD: field=work_id"
]
```

### 38 — missing-route

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-missing-route",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_REQUIRED_FIELD: field=route_id"
]
```

### 39 — missing-a-entity

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-missing-a-entity",
    "route_id": "foundation-20261024-root",
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_REQUIRED_FIELD: field=a_entities_id"
]
```

### 40 — missing-b-entity

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-missing-b-entity",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_REQUIRED_FIELD: field=entities_id"
]
```

### 41 — missing-identity

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-missing-identity",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_REQUIRED_FIELD: field=identity_json"
]
```

### 42 — missing-values

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-missing-values",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_REQUIRED_FIELD: field=a_values_json"
]
```

### 43 — missing-times

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-missing-times",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_REQUIRED_FIELD: field=a_change_times_json"
]
```

### 44 — missing-version

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-missing-version",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_REQUIRED_FIELD: field=settings_version"
]
```

### 45 — entity-string

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-entity-string",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": "0",
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=entities_id"
]
```

### 46 — entity-float

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-entity-float",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0.5,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "You don't have permission to perform this action."
]
```

### 47 — entity-bool

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-entity-bool",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": false,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=entities_id"
]
```

### 48 — entity-negative

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-entity-negative",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": -1,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "You don't have permission to perform this action."
]
```

### 49 — entity-overflow

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-entity-overflow",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 4294967296,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "You don't have permission to perform this action."
]
```

### 50 — aentity-string

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-aentity-string",
    "route_id": "foundation-20261024-root",
    "a_entities_id": "0",
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_entities_id"
]
```

### 51 — version-string

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-version-string",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": "2"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=settings_version"
]
```

### 52 — version-zero

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-version-zero",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 0
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=settings_version"
]
```

### 53 — version-overflow

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-version-overflow",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 4294967296
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=settings_version"
]
```

### 54 — work-empty

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=work_id"
]
```

### 55 — work-invalid

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "invalid space",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=work_id"
]
```

### 56 — work-long

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=work_id"
]
```

### 57 — route-empty

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-route-empty",
    "route_id": "",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=route_id"
]
```

### 58 — route-invalid

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-route-invalid",
    "route_id": "route space",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=route_id"
]
```

### 59 — route-long

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-route-long",
    "route_id": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=route_id"
]
```

### 60 — itemtype-empty

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-itemtype-empty",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=itemtype"
]
```

### 61 — itemtype-number

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-itemtype-number",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": 4,
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=itemtype"
]
```

### 62 — itemtype-long

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-itemtype-long",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=itemtype"
]
```

### 63 — identity-nested

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-identity-nested",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": {
      "a_items_id": 1,
      "b_items_id": null,
      "serial": null
    },
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=identity_json"
]
```

### 64 — identity-malformed

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-identity-malformed",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=identity_json"
]
```

### 65 — identity-null

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-identity-null",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": null,
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=identity_json"
]
```

### 66 — identity-array

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-identity-array",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "[]",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=identity_json"
]
```

### 67 — identity-missing

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-identity-missing",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":1,\"b_items_id\":null}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=identity_json"
]
```

### 68 — identity-extra

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-identity-extra",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":1,\"b_items_id\":null,\"serial\":null,\"extra\":true}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=identity_json"
]
```

### 69 — identity-a-zero

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-identity-a-zero",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":0,\"b_items_id\":null,\"serial\":null}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=identity_json"
]
```

### 70 — identity-a-string

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-identity-a-string",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":\"1\",\"b_items_id\":null,\"serial\":null}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=identity_json"
]
```

### 71 — identity-b-zero

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-identity-b-zero",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":1,\"b_items_id\":0,\"serial\":null}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=identity_json"
]
```

### 72 — identity-b-string

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-identity-b-string",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":1,\"b_items_id\":\"1\",\"serial\":null}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=identity_json"
]
```

### 73 — identity-serial-empty

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-identity-serial-empty",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":1,\"b_items_id\":null,\"serial\":\"\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=identity_json"
]
```

### 74 — identity-serial-number

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-identity-serial-number",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":1,\"b_items_id\":null,\"serial\":1}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=identity_json"
]
```

### 75 — values-nested

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-values-nested",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": {
      "asset_name": "test"
    },
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_values_json"
]
```

### 76 — values-malformed

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-values-malformed",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_values_json"
]
```

### 77 — values-null

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-values-null",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": null,
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_values_json"
]
```

### 78 — values-array

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-values-array",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "[]",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_values_json"
]
```

### 79 — values-object-value

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-values-object-value",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":{}}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_values_json"
]
```

### 80 — values-array-value

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-values-array-value",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":[]}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_values_json"
]
```

### 81 — values-key

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-values-key",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"Bad\":\"x\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_values_json"
]
```

### 82 — values-long-key

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-values-long-key",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\": \"x\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_values_json"
]
```

### 83 — values-overflow-number

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-values-overflow-number",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":1e400}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_values_json"
]
```

### 84 — times-nested

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-times-nested",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": {},
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_change_times_json"
]
```

### 85 — times-malformed

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-times-malformed",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_change_times_json"
]
```

### 86 — times-null

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-times-null",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": null,
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_change_times_json"
]
```

### 87 — times-array

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-times-array",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "[]",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_change_times_json"
]
```

### 88 — times-missing-key

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-times-missing-key",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":null}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_change_times_json"
]
```

### 89 — times-extra-key

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-times-extra-key",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":null,\"reliable\":false,\"extra\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_change_times_json"
]
```

### 90 — time-reliable-string

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-time-reliable-string",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\": {\"changed_at\": null, \"reliable\": \"true\"}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_change_times_json"
]
```

### 91 — time-reliable-number

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-time-reliable-number",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\": {\"changed_at\": null, \"reliable\": 1}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_change_times_json"
]
```

### 92 — time-number

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-time-number",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\": {\"changed_at\": 42, \"reliable\": true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_change_times_json"
]
```

### 93 — time-utc

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-time-utc",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\": {\"changed_at\": \"2026-10-24T12:00:00Z\", \"reliable\": true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_change_times_json"
]
```

### 94 — time-offset

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-time-offset",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\": {\"changed_at\": \"2026-10-24T12:00:00+09:00\", \"reliable\": true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_change_times_json"
]
```

### 95 — time-fraction

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-time-fraction",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\": {\"changed_at\": \"2026-10-24T12:00:00.123+08:00\", \"reliable\": true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_change_times_json"
]
```

### 96 — time-no-offset

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-time-no-offset",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\": {\"changed_at\": \"2026-10-24T12:00:00\", \"reliable\": true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_change_times_json"
]
```

### 97 — time-day

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-time-day",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\": {\"changed_at\": \"2026-10-32T12:00:00+08:00\", \"reliable\": true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_change_times_json"
]
```

### 98 — time-month

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-time-month",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\": {\"changed_at\": \"2026-13-24T12:00:00+08:00\", \"reliable\": true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_change_times_json"
]
```

### 99 — time-leap

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-time-leap",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\": {\"changed_at\": \"2026-02-29T12:00:00+08:00\", \"reliable\": true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_change_times_json"
]
```

### 100 — time-hour

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-time-hour",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\": {\"changed_at\": \"2026-10-24T24:00:00+08:00\", \"reliable\": true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_change_times_json"
]
```

### 101 — time-second

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-time-second",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\": {\"changed_at\": \"2026-10-24T12:00:60+08:00\", \"reliable\": true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_change_times_json"
]
```

### 102 — time-text

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-time-text",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\": {\"changed_at\": \"yesterday\", \"reliable\": true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_change_times_json"
]
```

### 103 — operation-null

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-operation-null",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "operation": null
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=operation"
]
```

### 104 — operation-lower

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-operation-lower",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "operation": "sync"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=operation"
]
```

### 105 — operation-unknown

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-operation-unknown",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "operation": "Other"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=operation"
]
```

### 106 — operation-number

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-operation-number",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "operation": 1
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=operation"
]
```

### 107 — operation-structured

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-operation-structured",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "operation": {}
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=operation"
]
```

### 108 — suspend-values

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-suspend-values",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{}",
    "settings_version": 2,
    "operation": "Suspend"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_values_json"
]
```

### 109 — suspend-times

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-suspend-times",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "operation": "Suspend"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_change_times_json"
]
```

### 110 — suspend-handled

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-suspend-handled",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 2,
    "operation": "Suspend",
    "handled_change_ids_json": "[1]"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=handled_change_ids_json"
]
```

### 111 — suspend-array-object

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-suspend-array-object",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "[]",
    "a_change_times_json": "{}",
    "settings_version": 2,
    "operation": "Suspend"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_values_json"
]
```

### 112 — resume-values

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-resume-values",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{}",
    "settings_version": 2,
    "operation": "Resume"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_values_json"
]
```

### 113 — resume-times

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-resume-times",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "operation": "Resume"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_change_times_json"
]
```

### 114 — resume-handled

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-resume-handled",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 2,
    "operation": "Resume",
    "handled_change_ids_json": "[1]"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=handled_change_ids_json"
]
```

### 115 — resume-array-object

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-resume-array-object",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{}",
    "a_change_times_json": "[]",
    "settings_version": 2,
    "operation": "Resume"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_change_times_json"
]
```

### 116 — handled-nested

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-handled-nested",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "handled_change_ids_json": [
      1
    ]
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=handled_change_ids_json"
]
```

### 117 — handled-malformed

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-handled-malformed",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "handled_change_ids_json": "["
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=handled_change_ids_json"
]
```

### 118 — handled-outer-null

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-handled-outer-null",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "handled_change_ids_json": null
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=handled_change_ids_json"
]
```

### 119 — handled-object

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-handled-object",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "handled_change_ids_json": "{}"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=handled_change_ids_json"
]
```

### 120 — handled-inner-null

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-handled-inner-null",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "handled_change_ids_json": "null"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=handled_change_ids_json"
]
```

### 121 — handled-duplicate

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-handled-duplicate",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "handled_change_ids_json": "[1,1]"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=handled_change_ids_json"
]
```

### 122 — handled-zero

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-handled-zero",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "handled_change_ids_json": "[0]"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=handled_change_ids_json"
]
```

### 123 — handled-negative

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-handled-negative",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "handled_change_ids_json": "[-1]"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=handled_change_ids_json"
]
```

### 124 — handled-string

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-handled-string",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "handled_change_ids_json": "[\"1\"]"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=handled_change_ids_json"
]
```

### 125 — handled-float

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-handled-float",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "handled_change_ids_json": "[1.0]"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=handled_change_ids_json"
]
```

### 126 — handled-overflow

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-handled-overflow",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "handled_change_ids_json": "[4294967296]"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=handled_change_ids_json"
]
```

### 127 — aentity-float

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-aentity-float",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 1.0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_entities_id"
]
```

### 128 — aentity-bool

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-aentity-bool",
    "route_id": "foundation-20261024-root",
    "a_entities_id": true,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_entities_id"
]
```

### 129 — aentity-negative

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-aentity-negative",
    "route_id": "foundation-20261024-root",
    "a_entities_id": -1,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_entities_id"
]
```

### 130 — aentity-overflow

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-aentity-overflow",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 4294967296,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_INVALID_FIELD: field=a_entities_id"
]
```

### 131 — accepted-null-unreliable

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 201.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-accepted-null-unreliable",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":null,\"reliable\":false}}",
    "settings_version": 2
  }
}
```

Response:

```json
{
  "id": 9,
  "message": ""
}
```

### 132 — accepted-identity-link

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 201.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-accepted-identity-link",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910003,\"b_items_id\":910203,\"serial\":null}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
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

### 133 — accepted-unknown-route

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 201.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-accepted-unknown-route",
    "route_id": "inbound-a-20261024-no-route",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
{
  "id": 11,
  "message": ""
}
```

### 134 — accepted-unknown-type

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 201.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-accepted-unknown-type",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "ImaginaryAssetType",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
{
  "id": 12,
  "message": ""
}
```

### 135 — accepted-disabled-type

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 201.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-accepted-disabled-type",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Printer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
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

### 136 — accepted-disabled-route

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 201.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-accepted-disabled-route",
    "route_id": "foundation-20261024-array",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
{
  "id": 14,
  "message": ""
}
```

### 137 — accepted-old-version

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 201.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-accepted-old-version",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 1
  }
}
```

Response:

```json
{
  "id": 15,
  "message": ""
}
```

### 138 — CaseDistinct

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 201.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-CaseDistinct",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
{
  "id": 16,
  "message": ""
}
```

### 139 — casedistinct

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 201.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-casedistinct",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
{
  "id": 17,
  "message": ""
}
```

### 140 — accepted-default

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-accepted-default",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_WORK_EXISTS: work_id=inbound-a-20261024-accepted-default"
]
```

### 141 — duplicate-changed

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-accepted-default",
    "route_id": "different-valid-route",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"MUST NOT OVERWRITE\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_WORK_EXISTS: work_id=inbound-a-20261024-accepted-default"
]
```

### 142 — all-valid multiple array

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 201.

Request body:

```json
{
  "input": [
    {
      "work_id": "inbound-a-20261024-valid-bulk-1",
      "route_id": "foundation-20261024-root",
      "a_entities_id": 0,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
      "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
      "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
      "settings_version": 2
    },
    {
      "work_id": "inbound-a-20261024-valid-bulk-2",
      "route_id": "foundation-20261024-root",
      "a_entities_id": 0,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
      "a_values_json": "{}",
      "a_change_times_json": "{}",
      "settings_version": 2
    }
  ]
}
```

Response:

```json
[
  {
    "id": 18,
    "message": ""
  },
  {
    "id": 19,
    "message": ""
  }
]
```

### 143 — mixed four-row array

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 207.

Request body:

```json
{
  "input": [
    {
      "work_id": "inbound-a-20261024-mixed-valid",
      "route_id": "foundation-20261024-root",
      "a_entities_id": 0,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
      "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
      "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
      "settings_version": 2
    },
    {
      "work_id": "inbound-a-20261024-accepted-default",
      "route_id": "foundation-20261024-root",
      "a_entities_id": 0,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
      "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
      "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
      "settings_version": 2
    },
    {
      "work_id": "inbound-a-20261024-mixed-owned",
      "route_id": "foundation-20261024-root",
      "a_entities_id": 0,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
      "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
      "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
      "settings_version": 2,
      "status": null
    },
    {
      "work_id": "inbound-a-20261024-mixed-json",
      "route_id": "foundation-20261024-root",
      "a_entities_id": 0,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{",
      "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
      "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
      "settings_version": 2
    }
  ]
}
```

Response:

```json
[
  "ERROR_GLPI_PARTIAL_ADD",
  [
    {
      "id": 20,
      "message": ""
    },
    {
      "id": false,
      "message": "ASB_WORK_EXISTS: work_id=inbound-a-20261024-accepted-default"
    },
    {
      "id": false,
      "message": "ASB_B_OWNED_FIELD: field=status"
    },
    {
      "id": false,
      "message": "ASB_INVALID_FIELD: field=identity_json"
    }
  ]
]
```

### 144 — all-invalid array

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": [
    {
      "work_id": "inbound-a-20261024-allinvalid-owned",
      "route_id": "foundation-20261024-root",
      "a_entities_id": 0,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
      "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
      "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
      "settings_version": 2,
      "status": null
    },
    {
      "work_id": "inbound-a-20261024-allinvalid-json",
      "route_id": "foundation-20261024-root",
      "a_entities_id": 0,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
      "a_values_json": "[",
      "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
      "settings_version": 2
    }
  ]
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  [
    {
      "id": false,
      "message": "ASB_B_OWNED_FIELD: field=status"
    },
    {
      "id": false,
      "message": "ASB_INVALID_FIELD: field=a_values_json"
    }
  ]
]
```

### 145 — outside login

Account: outside; method: GET; URL: `http://localhost:8081/api.php/v1/initSession`; HTTP 200.

Request body:

```json
null
```

Response:

```json
{
  "session_token": "[REDACTED]"
}
```

### 146 — outside entity context

Account: outside; method: GET; URL: `http://localhost:8081/api.php/v1/getActiveEntities`; HTTP 200.

Request body:

```json
null
```

Response:

```json
{
  "active_entity": {
    "id": 5,
    "active_entity_recursive": 0,
    "active_entities": [
      {
        "id": 5
      }
    ]
  }
}
```

### 147 — outside-child

Account: outside; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 201.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-outside-child",
    "route_id": "foundation-20261024-child",
    "a_entities_id": 0,
    "entities_id": 5,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 1
  }
}
```

Response:

```json
{
  "id": 21,
  "message": ""
}
```

### 148 — forbidden-entity

Account: service; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-forbidden-entity",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 5,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "You don't have permission to perform this action."
]
```

### 149 — service cannot read child Work

Account: service; method: GET; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork/21?get_hateoas=false&expand_dropdowns=false`; HTTP 403.

Request body:

```json
null
```

Response:

```json
[
  "ERROR_RIGHT_MISSING",
  "You don't have permission to perform this action."
]
```

### 150 — outside cannot read root Work

Account: outside; method: GET; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork/1?get_hateoas=false&expand_dropdowns=false`; HTTP 403.

Request body:

```json
null
```

Response:

```json
[
  "ERROR_RIGHT_MISSING",
  "You don't have permission to perform this action."
]
```

### 151 — denied login

Account: denied; method: GET; URL: `http://localhost:8081/api.php/v1/initSession`; HTTP 200.

Request body:

```json
null
```

Response:

```json
{
  "session_token": "[REDACTED]"
}
```

### 152 — denied-create

Account: denied; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-denied-create",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "You don't have permission to perform this action."
]
```

### 153 — denied read Work

Account: denied; method: GET; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork/1?get_hateoas=false&expand_dropdowns=false`; HTTP 403.

Request body:

```json
null
```

Response:

```json
[
  "ERROR_RIGHT_MISSING",
  "You don't have permission to perform this action."
]
```

### 154 — immutable Work update

Account: service; method: PUT; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork/1`; HTTP 400.

Request body:

```json
{
  "input": {
    "id": 1,
    "status": "Done",
    "result_json": "{}",
    "a_values_json": "{}"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "You don't have permission to perform this action."
]
```

### 155 — second independent service session for concurrent pair

Account: service; method: GET; URL: `http://localhost:8081/api.php/v1/initSession`; HTTP 200.

Request body:

```json
null
```

Response:

```json
{
  "session_token": "[REDACTED]"
}
```

### 156 — concurrent client B

Account: race2; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 201.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-concurrent",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
{
  "id": 22,
  "message": ""
}
```

### 157 — concurrent client A

Account: race1; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-concurrent",
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_WORK_EXISTS: work_id=inbound-a-20261024-concurrent"
]
```

### 158 — global-duplicate-child

Account: outside; method: POST; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork`; HTTP 400.

Request body:

```json
{
  "input": {
    "work_id": "inbound-a-20261024-accepted-default",
    "route_id": "foundation-20261024-child",
    "a_entities_id": 0,
    "entities_id": 5,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 1
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_WORK_EXISTS: work_id=inbound-a-20261024-accepted-default"
]
```

### 159 — exact original Work ID readback after rejected mutations

Account: service; method: GET; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork?searchText%5Bwork_id%5D=%5Einbound-a-20261024-accepted-default%24&range=0-1&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false`; HTTP 200.

Request body:

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
  }
]
```

### 160 — concurrent exact key readback

Account: service; method: GET; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork?searchText%5Bwork_id%5D=%5Einbound-a-20261024-concurrent%24&range=0-9&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false`; HTTP 200.

Request body:

```json
null
```

Response:

```json
[
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

### 161 — Accepted status collection readback

Account: service; method: GET; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork?searchText%5Bstatus%5D=%5EAccepted%24&range=0-999&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false`; HTTP 200.

Request body:

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

### 162 — final exact prefix root inventory rejected IDs absent and accepted metadata

Account: service; method: GET; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork?searchText%5Bwork_id%5D=%5Einbound-a-20261024-&range=0-999&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false`; HTTP 200.

Request body:

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

### 163 — final child fixture inventory

Account: outside; method: GET; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork?searchText%5Bwork_id%5D=%5Einbound-a-20261024-&range=0-999&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false`; HTTP 200.

Request body:

```json
null
```

Response:

```json
[
  {
    "id": 21,
    "work_id": "inbound-a-20261024-outside-child",
    "route_id": "foundation-20261024-child",
    "a_entities_id": 0,
    "entities_id": 5,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":910001,\"b_items_id\":null,\"serial\":\"INBOUND-A-20261024-BASE\"}",
    "a_values_json": "{\"asset_name\":\"Inbound admission only\"}",
    "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T19:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 14,
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
  }
]
```

### 164 — final unchanged Computer collection

Account: service; method: GET; URL: `http://localhost:8081/api.php/v1/Computer?range=0-999&get_hateoas=false&expand_dropdowns=false`; HTTP 200.

Request body:

```json
null
```

Response:

```json
[
  {
    "id": 137,
    "entities_id": 0,
    "name": "HMNS Test 1",
    "serial": "HMNS Test 1",
    "otherserial": "HMNS Test 1",
    "contact": "",
    "contact_num": "",
    "users_id_tech": 0,
    "comment": "",
    "date_mod": "2026-10-13 20:56:38",
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
    "uuid": "",
    "date_creation": "2026-10-13 20:56:38",
    "is_recursive": 0,
    "last_inventory_update": null,
    "last_boot": null
  }
]
```

### 165 — final unchanged Change collection

Account: service; method: GET; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?range=0-999&get_hateoas=false&expand_dropdowns=false`; HTTP 200.

Request body:

```json
null
```

Response:

```json
[]
```

### 166 — second concurrent session logout

Account: race2; method: GET; URL: `http://localhost:8081/api.php/v1/killSession`; HTTP 200.

Request body:

```json
null
```

Response:

```json
true
```

### 167 — outside session logout

Account: outside; method: GET; URL: `http://localhost:8081/api.php/v1/killSession`; HTTP 200.

Request body:

```json
null
```

Response:

```json
true
```

### 168 — denied session logout

Account: denied; method: GET; URL: `http://localhost:8081/api.php/v1/killSession`; HTTP 200.

Request body:

```json
null
```

Response:

```json
true
```

### 169 — service session logout

Account: service; method: GET; URL: `http://localhost:8081/api.php/v1/killSession`; HTTP 200.

Request body:

```json
null
```

Response:

```json
true
```

### 170 — containment service login

Account: service; method: GET; URL: `http://localhost:8081/api.php/v1/initSession`; HTTP 200.

Request body:

```json
null
```

Response:

```json
{
  "session_token": "[REDACTED]"
}
```

### 171 — contain admission fixtures disable only disposable enabled Setting1 version3

Account: service; method: PUT; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/1`; HTTP 200.

Request body:

```json
{
  "input": {
    "id": 1,
    "route_id": "foundation-20261024-root",
    "a_entities_id": 0,
    "entities_id": 0,
    "route_enabled": 0,
    "settings_version": 3,
    "enabled_itemtypes_json": "[\"Computer\"]",
    "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
  }
}
```

Response:

```json
[
  {
    "1": true,
    "message": ""
  }
]
```

### 172 — containment disabled Setting1 readback

Account: service; method: GET; URL: `http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/1?get_hateoas=false&expand_dropdowns=false`; HTTP 200.

Request body:

```json
null
```

Response:

```json
{
  "id": 1,
  "route_id": "foundation-20261024-root",
  "a_entities_id": 0,
  "entities_id": 0,
  "route_enabled": 0,
  "settings_version": 3,
  "enabled_itemtypes_json": "[\"Computer\"]",
  "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
}
```

### 173 — containment session logout

Account: service; method: GET; URL: `http://localhost:8081/api.php/v1/killSession`; HTTP 200.

Request body:

```json
null
```

Response:

```json
true
```

