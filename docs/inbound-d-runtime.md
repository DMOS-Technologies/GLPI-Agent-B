# Agent B inbound part(d) manual runtime evidence

2026-10-24 Asia/Brunei (+08:00), GLPI11.0.7, Fields1.24.4, localhost:8081/api.php/v1. **53 manual curl requests +19 native CLI PHP invocations** in one bounded pass. No implementation defect or source retry. Approved deployment only six candidate files: inc/process.php, inc/write.php, inc/fields.php, inc/change.class.php, inc/results.php, inc/scope.php from agentb-inbound-d. Preserved deployed Work/firstcopy/setup/capture. No repository edits, commit, automated tests, custom endpoint, fabricated records/identities/links, raw DML, delete/purge or old plugin operations.

## Operator setup correction preserved

Curl6 incorrectly used dropdown_label_to_text for B dropdown destinations. Setting correctly rejected HTTP400 ERROR_GLPI_ADD / ASB_UNSUPPORTED_MAPPING: mapping_id=id_b_option. I had batched subsequent admission69/70, which then Held unavailable route with no asset writes/links. This is an operator fixture error, not a product defect. Corrected destination modes to text_to_dropdown (curl8), created valid Setting14 and admitted fresh71/72; no terminal record reset or broad rerun. All original calls retained below.

## Fixtures and observed behavior

Fresh Computers155 main /156 other, custom requested definition3 asset5, Fields container10 agentbidx fields67(idbtextfield)/68(idatextfield), generated storage PluginFieldsComputeragentbidx row1. Existing permitted Manufacturer7 used as option label AgentB IC Maker. New Fields container native initialization briefly defaults associations then immediately locks only new associations: every profile0 except14 right4 before any HTTP fixture use. Setting14 route inbound-d-20261024-main A9500/B0; version1 for return/correction/control evidence, version2 adds Both-stage mapping, final disabled/version3. New Works69–89: eight Done, thirteen Held. No asset was created by a Work in this pass. Native fixture creation itself used ordinary core REST.

Works71/72 return current native/Fields/custom values with honest null/false time when genuine evidence absent. Native dropdown/custom dropdown return permitted labels, not B IDs. Genuine sequential native edits17/18/19 preserve older/mixed/current rows. Standalone Fields20 and custom21 are separate real saves. With Computer and new Fields rights reduced to READ1, Work73 Done returns current B text/Fields with original +08 evidence, exact coverage19/20 only; older17/mixed18 excluded. Equal supplied B values still ReturnToA and make no redundant save: exact native History/queue unchanged. Work74 covers custom21 with genuine original time; option/no-evidence fields remain null/false. All covered rows remain Pending attempts0 until simulated A save plus exact external ack19/20 (curl21). Work poll changes no queue metadata. Rights then restored Computer7/Fields4.

Correction Works75–78 mix valid23 with missing2147483647, old-route16, custom-type21, or other-identity22. All Held before writes or any attempt/error mutation; exact entire snapshot baseline unchanged, native name unchanged. Work79 valid handled[23,24,26] writes A name and Fields value, native/Fields rereads verify, exact24/26 Done retry1. Multi-field23 lacks A contact handling: stays Pending retry1 with visible Snapshot23: Snapshot field was not fully handled: id_a_contact; Work Held with honest partial outcomes. Newer unselected25 and unrelated rows remain Pending attempts0. Fresh Work80 after explicit reconciliation includes name/contact/Fields and already Done24/26; Done, handled IDs exactly[23,24,26]. Row23 retry2 clears error/Done; already Done24/26 unchanged retry1 and original done_at. Ordinary equal A mappings AlreadyEqual. No sync echo from native/Fields corrections; every original saved value/time/identity remains exact.

Work81 Suspend Done retains155/Suspended with empty values/times/handled and no asset/storage/History/queue change (exact native snapshots before/after). No-link Suspend82 and claimed-but-unverified Resume83 Held without creating. While suspended, genuine native and Fields edits changed fixture data but produced no Change for155; independent Active custom5 still captures row28. Exact external ack27 rejected HTTP400 [ERROR_GLPI_UPDATE,ASB_CHANGE_LINK_SUSPENDED], row27 unchanged attempts0. Sync84/correction85 Held Retained link is Suspended; Sync cannot reactivate it, no asset write or correction attempt. Resume86 after these Held records Done retains155/Active and makes no asset/storage/History/queue change. Sync87 reuses155, returns suspended-period current values with honest null/false time (no captured evidence), no reseed. Immediate genuine native/Fields edits queue29/30, no cooldown. Stale Suspend88 after version bump Held and does not change effective Active state; Work89 reads same asset Active and Holds Both conflict processing is not installed yet. contact_num remains null, no invented Both winner.

History/native guard: native/Fields corrections attributed service user12. Scoped native CronTask51 only, volumes2,2,2,4,1,1,3,2,1,1,2 across21 Works, caller user2/profile4/cron restored after each; no cron-admin bypass. Queue16→30 consists exactly14 genuine captures17–30; suspended native/Fields edits and every worker correction/control/return add zero rows. Terminal old Works not reopened. Final Accepted count0.

Containment: Setting14 disabledv3 via standard PUT + GET. Computer profile14 restored7, container10 only14 right4/all others0. New routes/assets/records preserved; no existing assets or unrelated profiles changed. One session opened curl1 and closed curl53.

## Matrix classification

| Case | Result | Evidence / explicit boundary |
|---|---|---|
| ID01 | PASS representative | Work71–74 native/Fields/custom returns, label conversions, genuine field times; READ-only native/Fields Work73, equal values ReturnToA/no save. |
| ID02 | PASS representative | Initial values/no snapshot null,false; unmapped whole-asset modification time not borrowed. Foreign/unreadable option variants not newly injected. |
| ID03 | PASS | Work73 covered exactly19/20; mixed18 excluded; Work74 covers21; all Pending until explicit simulated A ack19/20. |
| ID04 | PASS | Distinct genuine17/18/19 retain original evidence, only current full row19 covered; poll queue byte-for-byte unchanged. |
| ID05 | PASS | Real native and Fields correction79/80 reread; exact eligible IDs; attempt0→1; no sync echo. |
| ID06 | PASS representative | Missing/wrong-route/type/identity sets75–78 reject all before writes/attempt/error mutation. Separate wrong-entity mismatch not additionally constructed. |
| ID07 | PASS representative | Missing winning contact on genuine multi-field23 stays Pending with exact visible reason/attempt1; Work79 partial writes preserved honestly. Disabled-mapping variant not repeated. |
| ID08 | PASS | Selected23 partial vs24/26 full; newer25 unselected. Fresh80 finishes23 and reports already Done24/26 with no rewrite/extra attempt; external Done→Done prior OB evidence retained, not rerun. |
| ID09 | NOT RUN / source only | No safe correction persistence/native false-save injector available in this bounded pass. Coverage failure79 is real but is not falsely called a native save failure. Prior IB/IC native failures remain separate evidence. |
| ID10 | PASS | Suspend81 exact retained asset155/Suspended, no asset/storage/History/queue mutation. |
| ID11 | PASS representative | Actual suspended native/Fields capture suppressed; Sync84 and correction85 Held; external ack27 rejects with unchanged row/attempt; independent active custom5 captures28. |
| ID12 | PASS | Resume86 same asset Active/no value exchange; Sync87 same ID no reseed, honest unavailable evidence, immediate genuine captures29/30. |
| ID13 | PASS representative | No retained link82, claimed unverified83, stale route88 Held. Destructive deletion/movement, account-right revocation and competing-control variants not added. |
| ID14 | PASS | Suspend81 → Held84/85 remains suspended; Resume86 → Sync87 Active; stale control88 cannot override;89 retains Active. Disabled-setting historical acknowledgement prior OB/AT evidence retained, not rerun. |
| ID15 | NOT RUN transfer variants | No new entity-pair transfer/many-to-one route variation constructed in this bounded part. Prior IB/IC global competing ownership/concrete-type and AT acknowledgement evidence unchanged. No automatic asset move/relink performed. |
| ID16 | PASS observed boundaries; remaining variants source/prior | Current submitter rights enforced; context restored; immutable results/evidence, terminal records unchanged; actual Both-stage89 Held. Duplicate POST/global admission prior pass not rerun. Unsafe failure injection not performed. |

## Exact evidence reconciliation

```json
{
  "curlCount": 53,
  "localCalls": 19,
  "workCount": 21,
  "workStatuses": {
    "Held": 13,
    "Done": 8
  },
  "immutableWorkInputMismatches": [],
  "originalSnapshotMismatches": [],
  "pollQueueExactUnchanged": true,
  "invalidReferenceBatchQueueExactUnchanged": true,
  "readOnlyHistoryExactUnchanged": true,
  "suspendNoAssetHistoryQueueChanges": true,
  "resumeNoAssetHistoryQueueChanges": true,
  "allLocalExitZero": true,
  "finalSnapshotStatuses": [
    {
      "id": 17,
      "status": "Pending",
      "retry_count": 0,
      "error": null
    },
    {
      "id": 18,
      "status": "Pending",
      "retry_count": 0,
      "error": null
    },
    {
      "id": 19,
      "status": "Done",
      "retry_count": 0,
      "error": null
    },
    {
      "id": 20,
      "status": "Done",
      "retry_count": 0,
      "error": null
    },
    {
      "id": 21,
      "status": "Pending",
      "retry_count": 0,
      "error": null
    },
    {
      "id": 22,
      "status": "Pending",
      "retry_count": 0,
      "error": null
    },
    {
      "id": 23,
      "status": "Done",
      "retry_count": 2,
      "error": null
    },
    {
      "id": 24,
      "status": "Done",
      "retry_count": 1,
      "error": null
    },
    {
      "id": 25,
      "status": "Pending",
      "retry_count": 0,
      "error": null
    },
    {
      "id": 26,
      "status": "Done",
      "retry_count": 1,
      "error": null
    },
    {
      "id": 27,
      "status": "Pending",
      "retry_count": 0,
      "error": null
    },
    {
      "id": 28,
      "status": "Pending",
      "retry_count": 0,
      "error": null
    },
    {
      "id": 29,
      "status": "Pending",
      "retry_count": 0,
      "error": null
    },
    {
      "id": 30,
      "status": "Pending",
      "retry_count": 0,
      "error": null
    }
  ]
}
```

## REST protocol and account

Every curl uses Accept: application/json, Content-Type: application/json, App-Token: [REDACTED]. initSession uses Authorization: user_token [REDACTED]; remaining calls Session-Token: [REDACTED]. Account user12/profile14/entity0 nonrecursive. Actual V1 response bodies below, including native error wrappers. Native CLI bootstraps vendor/autoload→Kernel boot→Auth user→Session::init→Plugin::init; fixture permission setup user2, worker user2 restoring captured user12 for actions, reads user12. No full GLPI cron command.

## Approved deployment results

```json
[
  {
    "file": "process.php",
    "code": 0,
    "out": "",
    "err": ""
  },
  {
    "file": "write.php",
    "code": 0,
    "out": "",
    "err": ""
  },
  {
    "file": "fields.php",
    "code": 0,
    "out": "",
    "err": ""
  },
  {
    "file": "change.class.php",
    "code": 0,
    "out": "",
    "err": ""
  },
  {
    "file": "results.php",
    "code": 0,
    "out": "",
    "err": ""
  },
  {
    "file": "scope.php",
    "code": 0,
    "out": "",
    "err": ""
  }
]
```

## Complete curl ledger

### Curl 1 — ID restricted session

GET http://localhost:8081/api.php/v1/initSession

Account user12/profile14/entity0; HTTP 200

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

### Curl 2 — ID fresh main Computer before route activation

POST http://localhost:8081/api.php/v1/Computer

Account user12/profile14/entity0; HTTP 201

Body:
```json
{
  "input": {
    "entities_id": 0,
    "name": "AgentB ID initial A name",
    "serial": "AGENTB-ID-MAIN",
    "comment": "ID initial B text",
    "contact": "ID initial A contact",
    "otherserial": "ID no genuine evidence",
    "manufacturers_id": 7
  }
}
```

Response:
```json
{
  "id": 155,
  "message": "Item successfully added: AgentB ID initial A name"
}
```

### Curl 3 — ID fresh second Computer for genuine wrong-identity snapshot

POST http://localhost:8081/api.php/v1/Computer

Account user12/profile14/entity0; HTTP 201

Body:
```json
{
  "input": {
    "entities_id": 0,
    "name": "AgentB ID other initial",
    "serial": "AGENTB-ID-OTHER",
    "comment": "ID other initial B"
  }
}
```

Response:
```json
{
  "id": 156,
  "message": "Item successfully added: AgentB ID other initial"
}
```

### Curl 4 — ID initialize fresh Fields scalar storage before route

POST http://localhost:8081/api.php/v1/PluginFieldsComputeragentbidx

Account user12/profile14/entity0; HTTP 201

Body:
```json
{
  "input": {
    "items_id": 155,
    "itemtype": "Computer",
    "plugin_fields_containers_id": 10,
    "entities_id": 0,
    "idbtextfield": "ID Fields B initial",
    "idatextfield": "ID Fields A initial"
  }
}
```

Response:
```json
{
  "id": 1,
  "message": "Item successfully added: General - ID 1"
}
```

### Curl 5 — ID fresh custom representative before route

POST http://localhost:8081/api.php/v1/Glpi%5CCustomAsset%5CAgentBICReq20261024Asset

Account user12/profile14/entity0; HTTP 201

Body:
```json
{
  "input": {
    "entities_id": 0,
    "name": "AgentB ID fresh custom",
    "serial": "AGENTB-ID-CUSTOM",
    "custom_ic_b": "ID custom B initial",
    "custom_ic_option": 7
  }
}
```

Response:
```json
{
  "id": 5,
  "message": "Item successfully added: AgentB ID fresh custom"
}
```

### Curl 6 — ID fresh immutable route and generic mappings

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting

Account user12/profile14/entity0; HTTP 400

Body:
```json
{
  "input": {
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "route_enabled": 1,
    "settings_version": 1,
    "enabled_itemtypes_json": "[\"Computer\",\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\"]",
    "field_mappings_json": "[{\"mapping_id\":\"id_a_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_a_contact\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_b_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"comment\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_b_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"manufacturers_id\"},\"source\":\"B\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"id_b_no_evidence\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"otherserial\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_fields_b\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbidx\",\"name\":\"idbtextfield\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_fields_a\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbidx\",\"name\":\"idatextfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_custom_b\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_b\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_custom_option\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_option\"},\"source\":\"B\",\"value_mode\":\"text_to_dropdown\"}]"
  }
}
```

Response:
```json
[
  "ERROR_GLPI_ADD",
  "ASB_UNSUPPORTED_MAPPING: mapping_id=id_b_option"
]
```

### Curl 7 — ID initial native and custom B returns without field evidence

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account user12/profile14/entity0; HTTP 201

Body:
```json
{
  "input": [
    {
      "work_id": "inbound-d-20261024-initial-native-return",
      "route_id": "inbound-d-20261024-main",
      "a_entities_id": 9500,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
      "a_values_json": "{}",
      "a_change_times_json": "{}",
      "settings_version": 1
    },
    {
      "work_id": "inbound-d-20261024-initial-custom-return",
      "route_id": "inbound-d-20261024-main",
      "a_entities_id": 9500,
      "entities_id": 0,
      "itemtype": "Glpi\\CustomAsset\\AgentBICReq20261024Asset",
      "identity_json": "{\"a_items_id\":955101,\"b_items_id\":null,\"serial\":\"AGENTB-ID-CUSTOM\"}",
      "a_values_json": "{}",
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
    "id": 69,
    "message": ""
  },
  {
    "id": 70,
    "message": ""
  }
]
```

### Curl 8 — ID correct fixture destination dropdown modes and create route

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting

Account user12/profile14/entity0; HTTP 201

Body:
```json
{
  "input": {
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "route_enabled": 1,
    "settings_version": 1,
    "enabled_itemtypes_json": "[\"Computer\",\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\"]",
    "field_mappings_json": "[{\"mapping_id\":\"id_a_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_a_contact\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_b_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"comment\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_b_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"manufacturers_id\"},\"source\":\"B\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"id_b_no_evidence\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"otherserial\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_fields_b\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbidx\",\"name\":\"idbtextfield\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_fields_a\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbidx\",\"name\":\"idatextfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_custom_b\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_b\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_custom_option\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_option\"},\"source\":\"B\",\"value_mode\":\"text_to_dropdown\"}]"
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

### Curl 9 — ID fresh initial B return Works after valid route creation

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account user12/profile14/entity0; HTTP 201

Body:
```json
{
  "input": [
    {
      "work_id": "inbound-d-20261024-native-return-no-evidence",
      "route_id": "inbound-d-20261024-main",
      "a_entities_id": 9500,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
      "a_values_json": "{}",
      "a_change_times_json": "{}",
      "settings_version": 1
    },
    {
      "work_id": "inbound-d-20261024-custom-return-no-evidence",
      "route_id": "inbound-d-20261024-main",
      "a_entities_id": 9500,
      "entities_id": 0,
      "itemtype": "Glpi\\CustomAsset\\AgentBICReq20261024Asset",
      "identity_json": "{\"a_items_id\":955101,\"b_items_id\":null,\"serial\":\"AGENTB-ID-CUSTOM\"}",
      "a_values_json": "{}",
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
    "id": 71,
    "message": ""
  },
  {
    "id": 72,
    "message": ""
  }
]
```

### Curl 10 — ID genuine old B text edit

PUT http://localhost:8081/api.php/v1/Computer/155

Account user12/profile14/entity0; HTTP 200

Body:
```json
{
  "input": {
    "id": 155,
    "comment": "ID B older"
  }
}
```

Response:
```json
[
  {
    "155": true,
    "message": ""
  }
]
```

### Curl 11 — ID genuine mixed A plus B snapshot

PUT http://localhost:8081/api.php/v1/Computer/155

Account user12/profile14/entity0; HTTP 200

Body:
```json
{
  "input": {
    "id": 155,
    "name": "ID genuine A edit for correction",
    "comment": "ID B mixed old"
  }
}
```

Response:
```json
[
  {
    "155": true,
    "message": ""
  }
]
```

### Curl 12 — ID genuine current B text snapshot

PUT http://localhost:8081/api.php/v1/Computer/155

Account user12/profile14/entity0; HTTP 200

Body:
```json
{
  "input": {
    "id": 155,
    "comment": "ID B current"
  }
}
```

Response:
```json
[
  {
    "155": true,
    "message": ""
  }
]
```

### Curl 13 — ID genuine standalone Fields B snapshot

PUT http://localhost:8081/api.php/v1/PluginFieldsComputeragentbidx/1

Account user12/profile14/entity0; HTTP 200

Body:
```json
{
  "input": {
    "id": 1,
    "items_id": 155,
    "itemtype": "Computer",
    "plugin_fields_containers_id": 10,
    "idbtextfield": "ID Fields B current"
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

### Curl 14 — ID genuine custom B snapshot

PUT http://localhost:8081/api.php/v1/Glpi%5CCustomAsset%5CAgentBICReq20261024Asset/5

Account user12/profile14/entity0; HTTP 200

Body:
```json
{
  "input": {
    "id": 5,
    "custom_ic_b": "ID custom B current"
  }
}
```

Response:
```json
[
  {
    "5": true,
    "message": ""
  }
]
```

### Curl 15 — ID genuine other identity snapshot

PUT http://localhost:8081/api.php/v1/Computer/156

Account user12/profile14/entity0; HTTP 200

Body:
```json
{
  "input": {
    "id": 156,
    "comment": "ID wrong identity genuine B"
  }
}
```

Response:
```json
[
  {
    "156": true,
    "message": ""
  }
]
```

### Curl 16 — ID genuine immutable snapshot baseline

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?searchText%5Broute_id%5D=%5Einbound-d-20261024-main%24&range=0-99&sort=id&order=ASC&get_hateoas=false

Account user12/profile14/entity0; HTTP 200

Body:
```json
null
```

Response:
```json
[
  {
    "id": 17,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID B older\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:00",
    "done_at": null
  },
  {
    "id": 18,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_name\":{\"value\":\"ID genuine A edit for correction\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true},\"id_b_text\":{\"value\":\"ID B mixed old\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:00",
    "done_at": null
  },
  {
    "id": 19,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:00",
    "done_at": null
  },
  {
    "id": 20,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_fields_b\":{\"value\":\"ID Fields B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:00",
    "done_at": null
  },
  {
    "id": 21,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBICReq20261024Asset",
    "identity_json": "{\"a_items_id\":955101,\"b_items_id\":5,\"serial\":\"AGENTB-ID-CUSTOM\"}",
    "changed_fields_json": "{\"id_custom_b\":{\"value\":\"ID custom B current\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:01",
    "date_mod": "2026-10-24 16:20:01",
    "done_at": null
  },
  {
    "id": 22,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":null,\"b_items_id\":156,\"serial\":\"AGENTB-ID-OTHER\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID wrong identity genuine B\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:01",
    "date_mod": "2026-10-24 16:20:01",
    "done_at": null
  }
]
```

### Curl 17 — ID equal current B values with READ only asset and Fields rights

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account user12/profile14/entity0; HTTP 201

Body:
```json
{
  "input": [
    {
      "work_id": "inbound-d-20261024-read-only-current-return",
      "route_id": "inbound-d-20261024-main",
      "a_entities_id": 9500,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
      "a_values_json": "{\"id_b_text\":\"ID B current\",\"id_fields_b\":\"ID Fields B current\",\"id_b_option\":\"AgentB IC Maker\"}",
      "a_change_times_json": "{}",
      "settings_version": 1
    },
    {
      "work_id": "inbound-d-20261024-custom-current-return",
      "route_id": "inbound-d-20261024-main",
      "a_entities_id": 9500,
      "entities_id": 0,
      "itemtype": "Glpi\\CustomAsset\\AgentBICReq20261024Asset",
      "identity_json": "{\"a_items_id\":955101,\"b_items_id\":null,\"serial\":\"AGENTB-ID-CUSTOM\"}",
      "a_values_json": "{}",
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
    "id": 73,
    "message": ""
  },
  {
    "id": 74,
    "message": ""
  }
]
```

### Curl 18 — ID returned covered IDs remain Pending with zero attempts

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?searchText%5Broute_id%5D=%5Einbound-d-20261024-main%24&range=0-99&sort=id&order=ASC&get_hateoas=false

Account user12/profile14/entity0; HTTP 200

Body:
```json
null
```

Response:
```json
[
  {
    "id": 17,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID B older\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:00",
    "done_at": null
  },
  {
    "id": 18,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_name\":{\"value\":\"ID genuine A edit for correction\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true},\"id_b_text\":{\"value\":\"ID B mixed old\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:00",
    "done_at": null
  },
  {
    "id": 19,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:00",
    "done_at": null
  },
  {
    "id": 20,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_fields_b\":{\"value\":\"ID Fields B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:00",
    "done_at": null
  },
  {
    "id": 21,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBICReq20261024Asset",
    "identity_json": "{\"a_items_id\":955101,\"b_items_id\":5,\"serial\":\"AGENTB-ID-CUSTOM\"}",
    "changed_fields_json": "{\"id_custom_b\":{\"value\":\"ID custom B current\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:01",
    "date_mod": "2026-10-24 16:20:01",
    "done_at": null
  },
  {
    "id": 22,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":null,\"b_items_id\":156,\"serial\":\"AGENTB-ID-OTHER\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID wrong identity genuine B\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:01",
    "date_mod": "2026-10-24 16:20:01",
    "done_at": null
  }
]
```

### Curl 19 — ID poll completed return Work without mutation

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork/73?get_hateoas=false

Account user12/profile14/entity0; HTTP 200

Body:
```json
null
```

Response:
```json
{
  "id": 73,
  "work_id": "inbound-d-20261024-read-only-current-return",
  "route_id": "inbound-d-20261024-main",
  "a_entities_id": 9500,
  "entities_id": 0,
  "itemtype": "Computer",
  "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
  "a_values_json": "{\"id_b_text\":\"ID B current\",\"id_fields_b\":\"ID Fields B current\",\"id_b_option\":\"AgentB IC Maker\"}",
  "a_change_times_json": "{}",
  "settings_version": 1,
  "handled_change_ids_json": "[]",
  "operation": "Sync",
  "submitted_users_id": 12,
  "submitted_profiles_id": 14,
  "a_items_id": 955001,
  "b_items_id": 155,
  "link_state": "Active",
  "processing_started_at": "2026-10-24 16:20:01",
  "status": "Done",
  "result_json": "{\"b_items_id\":155,\"created_b_items_id\":null,\"b_values_for_a\":{\"id_b_text\":{\"value\":\"ID B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true},\"id_b_option\":{\"value\":\"AgentB IC Maker\",\"changed_at\":null,\"reliable\":false},\"id_b_no_evidence\":{\"value\":\"ID no genuine evidence\",\"changed_at\":null,\"reliable\":false},\"id_fields_b\":{\"value\":\"ID Fields B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}},\"covered_change_ids\":[19,20],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"id_a_name\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"id_a_contact\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"id_b_text\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_b_option\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_b_no_evidence\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_fields_b\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_fields_a\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"}]}",
  "error": null,
  "date_creation": "2026-10-24 16:20:01",
  "date_mod": "2026-10-24 16:20:01",
  "completed_at": "2026-10-24 16:20:01"
}
```

### Curl 20 — ID queue after Work poll no attempts or errors

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?searchText%5Broute_id%5D=%5Einbound-d-20261024-main%24&range=0-99&sort=id&order=ASC&get_hateoas=false

Account user12/profile14/entity0; HTTP 200

Body:
```json
null
```

Response:
```json
[
  {
    "id": 17,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID B older\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:00",
    "done_at": null
  },
  {
    "id": 18,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_name\":{\"value\":\"ID genuine A edit for correction\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true},\"id_b_text\":{\"value\":\"ID B mixed old\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:00",
    "done_at": null
  },
  {
    "id": 19,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:00",
    "done_at": null
  },
  {
    "id": 20,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_fields_b\":{\"value\":\"ID Fields B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:00",
    "done_at": null
  },
  {
    "id": 21,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBICReq20261024Asset",
    "identity_json": "{\"a_items_id\":955101,\"b_items_id\":5,\"serial\":\"AGENTB-ID-CUSTOM\"}",
    "changed_fields_json": "{\"id_custom_b\":{\"value\":\"ID custom B current\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:01",
    "date_mod": "2026-10-24 16:20:01",
    "done_at": null
  },
  {
    "id": 22,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":null,\"b_items_id\":156,\"serial\":\"AGENTB-ID-OTHER\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID wrong identity genuine B\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:01",
    "date_mod": "2026-10-24 16:20:01",
    "done_at": null
  }
]
```

### Curl 21 — ID simulate A saved returned values then exact ack covered native and Fields

PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange

Account user12/profile14/entity0; HTTP 200

Body:
```json
{
  "input": [
    {
      "id": 19,
      "status": "Done"
    },
    {
      "id": 20,
      "status": "Done"
    }
  ]
}
```

Response:
```json
[
  {
    "19": true,
    "message": ""
  },
  {
    "20": true,
    "message": ""
  }
]
```

### Curl 22 — ID genuine two A fields correction snapshot

PUT http://localhost:8081/api.php/v1/Computer/155

Account user12/profile14/entity0; HTTP 200

Body:
```json
{
  "input": {
    "id": 155,
    "name": "ID human A name snapshot",
    "contact": "ID human A contact snapshot"
  }
}
```

Response:
```json
[
  {
    "155": true,
    "message": ""
  }
]
```

### Curl 23 — ID genuine independent A name snapshot

PUT http://localhost:8081/api.php/v1/Computer/155

Account user12/profile14/entity0; HTTP 200

Body:
```json
{
  "input": {
    "id": 155,
    "name": "ID human A name newer"
  }
}
```

Response:
```json
[
  {
    "155": true,
    "message": ""
  }
]
```

### Curl 24 — ID genuine newer unselected A contact snapshot

PUT http://localhost:8081/api.php/v1/Computer/155

Account user12/profile14/entity0; HTTP 200

Body:
```json
{
  "input": {
    "id": 155,
    "contact": "ID human unselected newer contact"
  }
}
```

Response:
```json
[
  {
    "155": true,
    "message": ""
  }
]
```

### Curl 25 — ID genuine Fields A correction snapshot

PUT http://localhost:8081/api.php/v1/PluginFieldsComputeragentbidx/1

Account user12/profile14/entity0; HTTP 200

Body:
```json
{
  "input": {
    "id": 1,
    "items_id": 155,
    "itemtype": "Computer",
    "plugin_fields_containers_id": 10,
    "idatextfield": "ID human Fields A edit"
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

### Curl 26 — ID correction original snapshot baseline

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?searchText%5Broute_id%5D=%5Einbound-d-20261024-main%24&range=0-99&sort=id&order=ASC&get_hateoas=false

Account user12/profile14/entity0; HTTP 200

Body:
```json
null
```

Response:
```json
[
  {
    "id": 17,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID B older\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:00",
    "done_at": null
  },
  {
    "id": 18,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_name\":{\"value\":\"ID genuine A edit for correction\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true},\"id_b_text\":{\"value\":\"ID B mixed old\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:00",
    "done_at": null
  },
  {
    "id": 19,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:26",
    "done_at": "2026-10-24 16:20:26"
  },
  {
    "id": 20,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_fields_b\":{\"value\":\"ID Fields B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:26",
    "done_at": "2026-10-24 16:20:26"
  },
  {
    "id": 21,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBICReq20261024Asset",
    "identity_json": "{\"a_items_id\":955101,\"b_items_id\":5,\"serial\":\"AGENTB-ID-CUSTOM\"}",
    "changed_fields_json": "{\"id_custom_b\":{\"value\":\"ID custom B current\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:01",
    "date_mod": "2026-10-24 16:20:01",
    "done_at": null
  },
  {
    "id": 22,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":null,\"b_items_id\":156,\"serial\":\"AGENTB-ID-OTHER\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID wrong identity genuine B\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:01",
    "date_mod": "2026-10-24 16:20:01",
    "done_at": null
  },
  {
    "id": 23,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_name\":{\"value\":\"ID human A name snapshot\",\"changed_at\":\"2026-10-24T16:20:26+08:00\",\"reliable\":true},\"id_a_contact\":{\"value\":\"ID human A contact snapshot\",\"changed_at\":\"2026-10-24T16:20:26+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:26",
    "date_mod": "2026-10-24 16:20:26",
    "done_at": null
  },
  {
    "id": 24,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_name\":{\"value\":\"ID human A name newer\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:27",
    "date_mod": "2026-10-24 16:20:27",
    "done_at": null
  },
  {
    "id": 25,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_contact\":{\"value\":\"ID human unselected newer contact\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:27",
    "date_mod": "2026-10-24 16:20:27",
    "done_at": null
  },
  {
    "id": 26,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_fields_a\":{\"value\":\"ID human Fields A edit\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:27",
    "date_mod": "2026-10-24 16:20:27",
    "done_at": null
  }
]
```

### Curl 27 — ID all-reference prevalidation rejects missing route type identity before writes

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account user12/profile14/entity0; HTTP 201

Body:
```json
{
  "input": [
    {
      "work_id": "inbound-d-20261024-invalid-missing",
      "route_id": "inbound-d-20261024-main",
      "a_entities_id": 9500,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
      "a_values_json": "{\"id_a_name\":\"MUST NOT WRITE MISSING\"}",
      "a_change_times_json": "{}",
      "settings_version": 1,
      "handled_change_ids_json": "[23,2147483647]"
    },
    {
      "work_id": "inbound-d-20261024-invalid-route",
      "route_id": "inbound-d-20261024-main",
      "a_entities_id": 9500,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
      "a_values_json": "{\"id_a_name\":\"MUST NOT WRITE ROUTE\"}",
      "a_change_times_json": "{}",
      "settings_version": 1,
      "handled_change_ids_json": "[23,16]"
    },
    {
      "work_id": "inbound-d-20261024-invalid-type",
      "route_id": "inbound-d-20261024-main",
      "a_entities_id": 9500,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
      "a_values_json": "{\"id_a_name\":\"MUST NOT WRITE TYPE\"}",
      "a_change_times_json": "{}",
      "settings_version": 1,
      "handled_change_ids_json": "[23,21]"
    },
    {
      "work_id": "inbound-d-20261024-invalid-identity",
      "route_id": "inbound-d-20261024-main",
      "a_entities_id": 9500,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
      "a_values_json": "{\"id_a_name\":\"MUST NOT WRITE IDENTITY\"}",
      "a_change_times_json": "{}",
      "settings_version": 1,
      "handled_change_ids_json": "[23,22]"
    }
  ]
}
```

Response:
```json
[
  {
    "id": 75,
    "message": ""
  },
  {
    "id": 76,
    "message": ""
  },
  {
    "id": 77,
    "message": ""
  },
  {
    "id": 78,
    "message": ""
  }
]
```

### Curl 28 — ID correction snapshots unchanged after invalid references

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?searchText%5Broute_id%5D=%5Einbound-d-20261024-main%24&range=0-99&sort=id&order=ASC&get_hateoas=false

Account user12/profile14/entity0; HTTP 200

Body:
```json
null
```

Response:
```json
[
  {
    "id": 17,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID B older\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:00",
    "done_at": null
  },
  {
    "id": 18,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_name\":{\"value\":\"ID genuine A edit for correction\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true},\"id_b_text\":{\"value\":\"ID B mixed old\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:00",
    "done_at": null
  },
  {
    "id": 19,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:26",
    "done_at": "2026-10-24 16:20:26"
  },
  {
    "id": 20,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_fields_b\":{\"value\":\"ID Fields B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:26",
    "done_at": "2026-10-24 16:20:26"
  },
  {
    "id": 21,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBICReq20261024Asset",
    "identity_json": "{\"a_items_id\":955101,\"b_items_id\":5,\"serial\":\"AGENTB-ID-CUSTOM\"}",
    "changed_fields_json": "{\"id_custom_b\":{\"value\":\"ID custom B current\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:01",
    "date_mod": "2026-10-24 16:20:01",
    "done_at": null
  },
  {
    "id": 22,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":null,\"b_items_id\":156,\"serial\":\"AGENTB-ID-OTHER\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID wrong identity genuine B\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:01",
    "date_mod": "2026-10-24 16:20:01",
    "done_at": null
  },
  {
    "id": 23,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_name\":{\"value\":\"ID human A name snapshot\",\"changed_at\":\"2026-10-24T16:20:26+08:00\",\"reliable\":true},\"id_a_contact\":{\"value\":\"ID human A contact snapshot\",\"changed_at\":\"2026-10-24T16:20:26+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:26",
    "date_mod": "2026-10-24 16:20:26",
    "done_at": null
  },
  {
    "id": 24,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_name\":{\"value\":\"ID human A name newer\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:27",
    "date_mod": "2026-10-24 16:20:27",
    "done_at": null
  },
  {
    "id": 25,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_contact\":{\"value\":\"ID human unselected newer contact\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:27",
    "date_mod": "2026-10-24 16:20:27",
    "done_at": null
  },
  {
    "id": 26,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_fields_a\":{\"value\":\"ID human Fields A edit\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:27",
    "date_mod": "2026-10-24 16:20:27",
    "done_at": null
  }
]
```

### Curl 29 — ID no asset writes from invalid correction batch

GET http://localhost:8081/api.php/v1/Computer/155?get_hateoas=false

Account user12/profile14/entity0; HTTP 200

Body:
```json
null
```

Response:
```json
{
  "id": 155,
  "entities_id": 0,
  "name": "ID human A name newer",
  "serial": "AGENTB-ID-MAIN",
  "otherserial": "ID no genuine evidence",
  "contact": "ID human unselected newer contact",
  "contact_num": null,
  "users_id_tech": 0,
  "comment": "ID B current",
  "date_mod": "2026-10-24 16:20:27",
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
  "date_creation": "2026-10-24 16:18:58",
  "is_recursive": 0,
  "last_inventory_update": null,
  "last_boot": null,
  "groups_id": [],
  "groups_id_tech": []
}
```

### Curl 30 — ID valid mixed full partial and Fields correction admission

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account user12/profile14/entity0; HTTP 201

Body:
```json
{
  "input": {
    "work_id": "inbound-d-20261024-partial-and-full-correction",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
    "a_values_json": "{\"id_a_name\":\"ID A winner name\",\"id_fields_a\":\"ID A Fields winner\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[23,24,26]"
  }
}
```

Response:
```json
{
  "id": 79,
  "message": ""
}
```

### Curl 31 — ID actual attempt counts partial error and full completion

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?searchText%5Broute_id%5D=%5Einbound-d-20261024-main%24&range=0-99&sort=id&order=ASC&get_hateoas=false

Account user12/profile14/entity0; HTTP 200

Body:
```json
null
```

Response:
```json
[
  {
    "id": 17,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID B older\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:00",
    "done_at": null
  },
  {
    "id": 18,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_name\":{\"value\":\"ID genuine A edit for correction\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true},\"id_b_text\":{\"value\":\"ID B mixed old\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:00",
    "done_at": null
  },
  {
    "id": 19,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:26",
    "done_at": "2026-10-24 16:20:26"
  },
  {
    "id": 20,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_fields_b\":{\"value\":\"ID Fields B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:26",
    "done_at": "2026-10-24 16:20:26"
  },
  {
    "id": 21,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBICReq20261024Asset",
    "identity_json": "{\"a_items_id\":955101,\"b_items_id\":5,\"serial\":\"AGENTB-ID-CUSTOM\"}",
    "changed_fields_json": "{\"id_custom_b\":{\"value\":\"ID custom B current\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:01",
    "date_mod": "2026-10-24 16:20:01",
    "done_at": null
  },
  {
    "id": 22,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":null,\"b_items_id\":156,\"serial\":\"AGENTB-ID-OTHER\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID wrong identity genuine B\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:01",
    "date_mod": "2026-10-24 16:20:01",
    "done_at": null
  },
  {
    "id": 23,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_name\":{\"value\":\"ID human A name snapshot\",\"changed_at\":\"2026-10-24T16:20:26+08:00\",\"reliable\":true},\"id_a_contact\":{\"value\":\"ID human A contact snapshot\",\"changed_at\":\"2026-10-24T16:20:26+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 1,
    "error": "Snapshot 23: Snapshot field was not fully handled: id_a_contact",
    "date_creation": "2026-10-24 16:20:26",
    "date_mod": "2026-10-24 16:20:38",
    "done_at": null
  },
  {
    "id": 24,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_name\":{\"value\":\"ID human A name newer\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 1,
    "error": null,
    "date_creation": "2026-10-24 16:20:27",
    "date_mod": "2026-10-24 16:20:38",
    "done_at": "2026-10-24 16:20:38"
  },
  {
    "id": 25,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_contact\":{\"value\":\"ID human unselected newer contact\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:27",
    "date_mod": "2026-10-24 16:20:27",
    "done_at": null
  },
  {
    "id": 26,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_fields_a\":{\"value\":\"ID human Fields A edit\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 1,
    "error": null,
    "date_creation": "2026-10-24 16:20:27",
    "date_mod": "2026-10-24 16:20:38",
    "done_at": "2026-10-24 16:20:38"
  }
]
```

### Curl 32 — ID fresh correction reconciles partial row and includes already Done IDs

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account user12/profile14/entity0; HTTP 201

Body:
```json
{
  "input": {
    "work_id": "inbound-d-20261024-complete-after-reconciliation",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
    "a_values_json": "{\"id_a_name\":\"ID A winner name\",\"id_a_contact\":\"ID A winner contact\",\"id_fields_a\":\"ID A Fields winner\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[23,24,26]"
  }
}
```

Response:
```json
{
  "id": 80,
  "message": ""
}
```

### Curl 33 — ID completed correction row counts and untouched newer row

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?searchText%5Broute_id%5D=%5Einbound-d-20261024-main%24&range=0-99&sort=id&order=ASC&get_hateoas=false

Account user12/profile14/entity0; HTTP 200

Body:
```json
null
```

Response:
```json
[
  {
    "id": 17,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID B older\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:00",
    "done_at": null
  },
  {
    "id": 18,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_name\":{\"value\":\"ID genuine A edit for correction\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true},\"id_b_text\":{\"value\":\"ID B mixed old\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:00",
    "done_at": null
  },
  {
    "id": 19,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:26",
    "done_at": "2026-10-24 16:20:26"
  },
  {
    "id": 20,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_fields_b\":{\"value\":\"ID Fields B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:26",
    "done_at": "2026-10-24 16:20:26"
  },
  {
    "id": 21,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBICReq20261024Asset",
    "identity_json": "{\"a_items_id\":955101,\"b_items_id\":5,\"serial\":\"AGENTB-ID-CUSTOM\"}",
    "changed_fields_json": "{\"id_custom_b\":{\"value\":\"ID custom B current\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:01",
    "date_mod": "2026-10-24 16:20:01",
    "done_at": null
  },
  {
    "id": 22,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":null,\"b_items_id\":156,\"serial\":\"AGENTB-ID-OTHER\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID wrong identity genuine B\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:01",
    "date_mod": "2026-10-24 16:20:01",
    "done_at": null
  },
  {
    "id": 23,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_name\":{\"value\":\"ID human A name snapshot\",\"changed_at\":\"2026-10-24T16:20:26+08:00\",\"reliable\":true},\"id_a_contact\":{\"value\":\"ID human A contact snapshot\",\"changed_at\":\"2026-10-24T16:20:26+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 2,
    "error": null,
    "date_creation": "2026-10-24 16:20:26",
    "date_mod": "2026-10-24 16:21:23",
    "done_at": "2026-10-24 16:21:23"
  },
  {
    "id": 24,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_name\":{\"value\":\"ID human A name newer\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 1,
    "error": null,
    "date_creation": "2026-10-24 16:20:27",
    "date_mod": "2026-10-24 16:20:38",
    "done_at": "2026-10-24 16:20:38"
  },
  {
    "id": 25,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_contact\":{\"value\":\"ID human unselected newer contact\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:27",
    "date_mod": "2026-10-24 16:20:27",
    "done_at": null
  },
  {
    "id": 26,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_fields_a\":{\"value\":\"ID human Fields A edit\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 1,
    "error": null,
    "date_creation": "2026-10-24 16:20:27",
    "date_mod": "2026-10-24 16:20:38",
    "done_at": "2026-10-24 16:20:38"
  }
]
```

### Curl 34 — ID suspended-scope snapshot fixture genuine B edit

PUT http://localhost:8081/api.php/v1/Computer/155

Account user12/profile14/entity0; HTTP 200

Body:
```json
{
  "input": {
    "id": 155,
    "comment": "ID Pending before suspend"
  }
}
```

Response:
```json
[
  {
    "155": true,
    "message": ""
  }
]
```

### Curl 35 — ID suspend retained native link and no-link controls

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account user12/profile14/entity0; HTTP 201

Body:
```json
{
  "input": [
    {
      "work_id": "inbound-d-20261024-suspend-main",
      "route_id": "inbound-d-20261024-main",
      "a_entities_id": 9500,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
      "a_values_json": "{}",
      "a_change_times_json": "{}",
      "settings_version": 1,
      "operation": "Suspend"
    },
    {
      "work_id": "inbound-d-20261024-suspend-no-link",
      "route_id": "inbound-d-20261024-main",
      "a_entities_id": 9500,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":955999,\"b_items_id\":null,\"serial\":\"AGENTB-ID-NO-LINK\"}",
      "a_values_json": "{}",
      "a_change_times_json": "{}",
      "settings_version": 1,
      "operation": "Suspend"
    },
    {
      "work_id": "inbound-d-20261024-resume-unverified",
      "route_id": "inbound-d-20261024-main",
      "a_entities_id": 9500,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":955998,\"b_items_id\":156,\"serial\":\"AGENTB-ID-OTHER\"}",
      "a_values_json": "{}",
      "a_change_times_json": "{}",
      "settings_version": 1,
      "operation": "Resume"
    }
  ]
}
```

Response:
```json
[
  {
    "id": 81,
    "message": ""
  },
  {
    "id": 82,
    "message": ""
  },
  {
    "id": 83,
    "message": ""
  }
]
```

### Curl 36 — ID genuine native edit while relationship Suspended

PUT http://localhost:8081/api.php/v1/Computer/155

Account user12/profile14/entity0; HTTP 200

Body:
```json
{
  "input": {
    "id": 155,
    "comment": "ID native while suspended"
  }
}
```

Response:
```json
[
  {
    "155": true,
    "message": ""
  }
]
```

### Curl 37 — ID genuine Fields edit while relationship Suspended

PUT http://localhost:8081/api.php/v1/PluginFieldsComputeragentbidx/1

Account user12/profile14/entity0; HTTP 200

Body:
```json
{
  "input": {
    "id": 1,
    "items_id": 155,
    "itemtype": "Computer",
    "plugin_fields_containers_id": 10,
    "idbtextfield": "ID Fields while suspended"
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

### Curl 38 — ID separate active custom relationship still captures

PUT http://localhost:8081/api.php/v1/Glpi%5CCustomAsset%5CAgentBICReq20261024Asset/5

Account user12/profile14/entity0; HTTP 200

Body:
```json
{
  "input": {
    "id": 5,
    "custom_ic_b": "ID custom still active during native suspension"
  }
}
```

Response:
```json
[
  {
    "5": true,
    "message": ""
  }
]
```

### Curl 39 — ID existing Pending external ack rejects actual Suspended scope

PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/27

Account user12/profile14/entity0; HTTP 400

Body:
```json
{
  "input": {
    "id": 27,
    "status": "Done"
  }
}
```

Response:
```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_CHANGE_LINK_SUSPENDED"
]
```

### Curl 40 — ID suspended Sync and correction must not reactivate or attempt

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account user12/profile14/entity0; HTTP 201

Body:
```json
{
  "input": [
    {
      "work_id": "inbound-d-20261024-sync-while-suspended",
      "route_id": "inbound-d-20261024-main",
      "a_entities_id": 9500,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
      "a_values_json": "{\"id_a_name\":\"MUST NOT APPLY DURING SUSPEND\"}",
      "a_change_times_json": "{}",
      "settings_version": 1
    },
    {
      "work_id": "inbound-d-20261024-correction-while-suspended",
      "route_id": "inbound-d-20261024-main",
      "a_entities_id": 9500,
      "entities_id": 0,
      "itemtype": "Computer",
      "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
      "a_values_json": "{\"id_b_text\":\"ID Pending before suspend\"}",
      "a_change_times_json": "{}",
      "settings_version": 1,
      "handled_change_ids_json": "[27]"
    }
  ]
}
```

Response:
```json
[
  {
    "id": 84,
    "message": ""
  },
  {
    "id": 85,
    "message": ""
  }
]
```

### Curl 41 — ID suppressed native Fields capture preserved Pending and attempts

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?searchText%5Broute_id%5D=%5Einbound-d-20261024-main%24&range=0-99&sort=id&order=ASC&get_hateoas=false

Account user12/profile14/entity0; HTTP 200

Body:
```json
null
```

Response:
```json
[
  {
    "id": 17,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID B older\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:00",
    "done_at": null
  },
  {
    "id": 18,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_name\":{\"value\":\"ID genuine A edit for correction\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true},\"id_b_text\":{\"value\":\"ID B mixed old\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:00",
    "done_at": null
  },
  {
    "id": 19,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:26",
    "done_at": "2026-10-24 16:20:26"
  },
  {
    "id": 20,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_fields_b\":{\"value\":\"ID Fields B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:26",
    "done_at": "2026-10-24 16:20:26"
  },
  {
    "id": 21,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBICReq20261024Asset",
    "identity_json": "{\"a_items_id\":955101,\"b_items_id\":5,\"serial\":\"AGENTB-ID-CUSTOM\"}",
    "changed_fields_json": "{\"id_custom_b\":{\"value\":\"ID custom B current\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:01",
    "date_mod": "2026-10-24 16:20:01",
    "done_at": null
  },
  {
    "id": 22,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":null,\"b_items_id\":156,\"serial\":\"AGENTB-ID-OTHER\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID wrong identity genuine B\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:01",
    "date_mod": "2026-10-24 16:20:01",
    "done_at": null
  },
  {
    "id": 23,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_name\":{\"value\":\"ID human A name snapshot\",\"changed_at\":\"2026-10-24T16:20:26+08:00\",\"reliable\":true},\"id_a_contact\":{\"value\":\"ID human A contact snapshot\",\"changed_at\":\"2026-10-24T16:20:26+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 2,
    "error": null,
    "date_creation": "2026-10-24 16:20:26",
    "date_mod": "2026-10-24 16:21:23",
    "done_at": "2026-10-24 16:21:23"
  },
  {
    "id": 24,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_name\":{\"value\":\"ID human A name newer\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 1,
    "error": null,
    "date_creation": "2026-10-24 16:20:27",
    "date_mod": "2026-10-24 16:20:38",
    "done_at": "2026-10-24 16:20:38"
  },
  {
    "id": 25,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_contact\":{\"value\":\"ID human unselected newer contact\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:27",
    "date_mod": "2026-10-24 16:20:27",
    "done_at": null
  },
  {
    "id": 26,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_fields_a\":{\"value\":\"ID human Fields A edit\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 1,
    "error": null,
    "date_creation": "2026-10-24 16:20:27",
    "date_mod": "2026-10-24 16:20:38",
    "done_at": "2026-10-24 16:20:38"
  },
  {
    "id": 27,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID Pending before suspend\",\"changed_at\":\"2026-10-24T16:21:23+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:21:23",
    "date_mod": "2026-10-24 16:21:23",
    "done_at": null
  },
  {
    "id": 28,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBICReq20261024Asset",
    "identity_json": "{\"a_items_id\":955101,\"b_items_id\":5,\"serial\":\"AGENTB-ID-CUSTOM\"}",
    "changed_fields_json": "{\"id_custom_b\":{\"value\":\"ID custom still active during native suspension\",\"changed_at\":\"2026-10-24T16:21:47+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:21:47",
    "date_mod": "2026-10-24 16:21:47",
    "done_at": null
  }
]
```

### Curl 42 — ID retained Resume control after intervening Held Sync

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account user12/profile14/entity0; HTTP 201

Body:
```json
{
  "input": {
    "work_id": "inbound-d-20261024-resume-main",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "operation": "Resume"
  }
}
```

Response:
```json
{
  "id": 86,
  "message": ""
}
```

### Curl 43 — ID fresh ordinary Sync reuses resumed asset no cooldown

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account user12/profile14/entity0; HTTP 201

Body:
```json
{
  "input": {
    "work_id": "inbound-d-20261024-sync-after-resume",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1
  }
}
```

Response:
```json
{
  "id": 87,
  "message": ""
}
```

### Curl 44 — ID immediate genuine native edit after Resume queues again

PUT http://localhost:8081/api.php/v1/Computer/155

Account user12/profile14/entity0; HTTP 200

Body:
```json
{
  "input": {
    "id": 155,
    "comment": "ID native genuine after Resume"
  }
}
```

Response:
```json
[
  {
    "155": true,
    "message": ""
  }
]
```

### Curl 45 — ID immediate genuine Fields edit after Resume queues again

PUT http://localhost:8081/api.php/v1/PluginFieldsComputeragentbidx/1

Account user12/profile14/entity0; HTTP 200

Body:
```json
{
  "input": {
    "id": 1,
    "items_id": 155,
    "itemtype": "Computer",
    "plugin_fields_containers_id": 10,
    "idbtextfield": "ID Fields genuine after Resume"
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

### Curl 46 — ID stale control admitted before version changes

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account user12/profile14/entity0; HTTP 201

Body:
```json
{
  "input": {
    "work_id": "inbound-d-20261024-stale-suspend",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "operation": "Suspend"
  }
}
```

Response:
```json
{
  "id": 88,
  "message": ""
}
```

### Curl 47 — ID new version includes explicit future Both boundary

PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/14

Account user12/profile14/entity0; HTTP 200

Body:
```json
{
  "input": {
    "id": 14,
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "route_enabled": 1,
    "settings_version": 2,
    "enabled_itemtypes_json": "[\"Computer\",\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\"]",
    "field_mappings_json": "[{\"mapping_id\":\"id_a_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_a_contact\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_b_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"comment\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_b_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"manufacturers_id\"},\"source\":\"B\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"id_b_no_evidence\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"otherserial\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_fields_b\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbidx\",\"name\":\"idbtextfield\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_fields_a\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbidx\",\"name\":\"idatextfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_custom_b\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_b\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_custom_option\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_option\"},\"source\":\"B\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"id_both_stage\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact_num\"},\"source\":\"Both\",\"value_mode\":\"direct\"}]"
  }
}
```

Response:
```json
[
  {
    "14": true,
    "message": ""
  }
]
```

### Curl 48 — ID unequal Both stays Held until next part

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account user12/profile14/entity0; HTTP 201

Body:
```json
{
  "input": {
    "work_id": "inbound-d-20261024-both-stage-boundary",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
    "a_values_json": "{\"id_both_stage\":\"MUST NOT SELECT WINNER YET\"}",
    "a_change_times_json": "{\"id_both_stage\":{\"changed_at\":\"2026-10-24T16:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2
  }
}
```

Response:
```json
{
  "id": 89,
  "message": ""
}
```

### Curl 49 — ID final durable Work outcomes and exact inputs

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork?searchText%5Bwork_id%5D=%5Einbound-d-20261024-&range=0-99&sort=id&order=ASC&get_hateoas=false

Account user12/profile14/entity0; HTTP 200

Body:
```json
null
```

Response:
```json
[
  {
    "id": 69,
    "work_id": "inbound-d-20261024-initial-native-return",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 955001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 16:19:15",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 16:19:15",
    "date_mod": "2026-10-24 16:19:15",
    "completed_at": null
  },
  {
    "id": 70,
    "work_id": "inbound-d-20261024-initial-custom-return",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBICReq20261024Asset",
    "identity_json": "{\"a_items_id\":955101,\"b_items_id\":null,\"serial\":\"AGENTB-ID-CUSTOM\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 955101,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 16:19:15",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 16:19:15",
    "date_mod": "2026-10-24 16:19:15",
    "completed_at": null
  },
  {
    "id": 71,
    "work_id": "inbound-d-20261024-native-return-no-evidence",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 955001,
    "b_items_id": 155,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 16:19:42",
    "status": "Done",
    "result_json": "{\"b_items_id\":155,\"created_b_items_id\":null,\"b_values_for_a\":{\"id_b_text\":{\"value\":\"ID initial B text\",\"changed_at\":null,\"reliable\":false},\"id_b_option\":{\"value\":\"AgentB IC Maker\",\"changed_at\":null,\"reliable\":false},\"id_b_no_evidence\":{\"value\":\"ID no genuine evidence\",\"changed_at\":null,\"reliable\":false},\"id_fields_b\":{\"value\":\"ID Fields B initial\",\"changed_at\":null,\"reliable\":false}},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"id_a_name\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"id_a_contact\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"id_b_text\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_b_option\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_b_no_evidence\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_fields_b\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_fields_a\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"}]}",
    "error": null,
    "date_creation": "2026-10-24 16:19:41",
    "date_mod": "2026-10-24 16:19:42",
    "completed_at": "2026-10-24 16:19:42"
  },
  {
    "id": 72,
    "work_id": "inbound-d-20261024-custom-return-no-evidence",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBICReq20261024Asset",
    "identity_json": "{\"a_items_id\":955101,\"b_items_id\":null,\"serial\":\"AGENTB-ID-CUSTOM\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 955101,
    "b_items_id": 5,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 16:19:42",
    "status": "Done",
    "result_json": "{\"b_items_id\":5,\"created_b_items_id\":null,\"b_values_for_a\":{\"id_custom_b\":{\"value\":\"ID custom B initial\",\"changed_at\":null,\"reliable\":false},\"id_custom_option\":{\"value\":\"AgentB IC Maker\",\"changed_at\":null,\"reliable\":false}},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"id_custom_b\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_custom_option\",\"outcome\":\"ReturnToA\",\"reason\":null}]}",
    "error": null,
    "date_creation": "2026-10-24 16:19:41",
    "date_mod": "2026-10-24 16:19:42",
    "completed_at": "2026-10-24 16:19:42"
  },
  {
    "id": 73,
    "work_id": "inbound-d-20261024-read-only-current-return",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
    "a_values_json": "{\"id_b_text\":\"ID B current\",\"id_fields_b\":\"ID Fields B current\",\"id_b_option\":\"AgentB IC Maker\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 955001,
    "b_items_id": 155,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 16:20:01",
    "status": "Done",
    "result_json": "{\"b_items_id\":155,\"created_b_items_id\":null,\"b_values_for_a\":{\"id_b_text\":{\"value\":\"ID B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true},\"id_b_option\":{\"value\":\"AgentB IC Maker\",\"changed_at\":null,\"reliable\":false},\"id_b_no_evidence\":{\"value\":\"ID no genuine evidence\",\"changed_at\":null,\"reliable\":false},\"id_fields_b\":{\"value\":\"ID Fields B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}},\"covered_change_ids\":[19,20],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"id_a_name\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"id_a_contact\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"id_b_text\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_b_option\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_b_no_evidence\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_fields_b\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_fields_a\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"}]}",
    "error": null,
    "date_creation": "2026-10-24 16:20:01",
    "date_mod": "2026-10-24 16:20:01",
    "completed_at": "2026-10-24 16:20:01"
  },
  {
    "id": 74,
    "work_id": "inbound-d-20261024-custom-current-return",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBICReq20261024Asset",
    "identity_json": "{\"a_items_id\":955101,\"b_items_id\":null,\"serial\":\"AGENTB-ID-CUSTOM\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 955101,
    "b_items_id": 5,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 16:20:01",
    "status": "Done",
    "result_json": "{\"b_items_id\":5,\"created_b_items_id\":null,\"b_values_for_a\":{\"id_custom_b\":{\"value\":\"ID custom B current\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true},\"id_custom_option\":{\"value\":\"AgentB IC Maker\",\"changed_at\":null,\"reliable\":false}},\"covered_change_ids\":[21],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"id_custom_b\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_custom_option\",\"outcome\":\"ReturnToA\",\"reason\":null}]}",
    "error": null,
    "date_creation": "2026-10-24 16:20:01",
    "date_mod": "2026-10-24 16:20:01",
    "completed_at": "2026-10-24 16:20:01"
  },
  {
    "id": 75,
    "work_id": "inbound-d-20261024-invalid-missing",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
    "a_values_json": "{\"id_a_name\":\"MUST NOT WRITE MISSING\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[23,2147483647]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 955001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 16:20:38",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Correction snapshot missing or not permitted: 2147483647",
    "date_creation": "2026-10-24 16:20:38",
    "date_mod": "2026-10-24 16:20:38",
    "completed_at": null
  },
  {
    "id": 76,
    "work_id": "inbound-d-20261024-invalid-route",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
    "a_values_json": "{\"id_a_name\":\"MUST NOT WRITE ROUTE\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[23,16]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 955001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 16:20:38",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Correction snapshot route/type/entity/settings mismatch: 16",
    "date_creation": "2026-10-24 16:20:38",
    "date_mod": "2026-10-24 16:20:38",
    "completed_at": null
  },
  {
    "id": 77,
    "work_id": "inbound-d-20261024-invalid-type",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
    "a_values_json": "{\"id_a_name\":\"MUST NOT WRITE TYPE\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[23,21]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 955001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 16:20:38",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Correction snapshot route/type/entity/settings mismatch: 21",
    "date_creation": "2026-10-24 16:20:38",
    "date_mod": "2026-10-24 16:20:38",
    "completed_at": null
  },
  {
    "id": 78,
    "work_id": "inbound-d-20261024-invalid-identity",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
    "a_values_json": "{\"id_a_name\":\"MUST NOT WRITE IDENTITY\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[23,22]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 955001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 16:20:38",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Correction snapshot identity mismatch: 22",
    "date_creation": "2026-10-24 16:20:38",
    "date_mod": "2026-10-24 16:20:38",
    "completed_at": null
  },
  {
    "id": 79,
    "work_id": "inbound-d-20261024-partial-and-full-correction",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
    "a_values_json": "{\"id_a_name\":\"ID A winner name\",\"id_fields_a\":\"ID A Fields winner\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[23,24,26]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 955001,
    "b_items_id": 155,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 16:20:38",
    "status": "Held",
    "result_json": "{\"b_items_id\":155,\"created_b_items_id\":null,\"b_values_for_a\":{\"id_b_text\":{\"value\":\"ID B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true},\"id_b_option\":{\"value\":\"AgentB IC Maker\",\"changed_at\":null,\"reliable\":false},\"id_b_no_evidence\":{\"value\":\"ID no genuine evidence\",\"changed_at\":null,\"reliable\":false},\"id_fields_b\":{\"value\":\"ID Fields B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}},\"covered_change_ids\":[],\"handled_change_ids_done\":[24,26],\"field_outcomes\":[{\"mapping_id\":\"id_a_name\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"id_a_contact\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"id_b_text\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_b_option\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_b_no_evidence\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_fields_b\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_fields_a\",\"outcome\":\"AppliedToB\",\"reason\":null}]}",
    "error": "Snapshot 23: Snapshot field was not fully handled: id_a_contact",
    "date_creation": "2026-10-24 16:20:38",
    "date_mod": "2026-10-24 16:20:38",
    "completed_at": null
  },
  {
    "id": 80,
    "work_id": "inbound-d-20261024-complete-after-reconciliation",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
    "a_values_json": "{\"id_a_name\":\"ID A winner name\",\"id_a_contact\":\"ID A winner contact\",\"id_fields_a\":\"ID A Fields winner\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[23,24,26]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 955001,
    "b_items_id": 155,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 16:21:23",
    "status": "Done",
    "result_json": "{\"b_items_id\":155,\"created_b_items_id\":null,\"b_values_for_a\":{\"id_b_text\":{\"value\":\"ID B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true},\"id_b_option\":{\"value\":\"AgentB IC Maker\",\"changed_at\":null,\"reliable\":false},\"id_b_no_evidence\":{\"value\":\"ID no genuine evidence\",\"changed_at\":null,\"reliable\":false},\"id_fields_b\":{\"value\":\"ID Fields B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}},\"covered_change_ids\":[],\"handled_change_ids_done\":[23,24,26],\"field_outcomes\":[{\"mapping_id\":\"id_a_name\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"id_a_contact\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"id_b_text\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_b_option\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_b_no_evidence\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_fields_b\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_fields_a\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}",
    "error": null,
    "date_creation": "2026-10-24 16:21:23",
    "date_mod": "2026-10-24 16:21:23",
    "completed_at": "2026-10-24 16:21:23"
  },
  {
    "id": 81,
    "work_id": "inbound-d-20261024-suspend-main",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Suspend",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 955001,
    "b_items_id": 155,
    "link_state": "Suspended",
    "processing_started_at": "2026-10-24 16:21:24",
    "status": "Done",
    "result_json": "{\"b_items_id\":155,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": null,
    "date_creation": "2026-10-24 16:21:23",
    "date_mod": "2026-10-24 16:21:24",
    "completed_at": "2026-10-24 16:21:24"
  },
  {
    "id": 82,
    "work_id": "inbound-d-20261024-suspend-no-link",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955999,\"b_items_id\":null,\"serial\":\"AGENTB-ID-NO-LINK\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Suspend",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 955999,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 16:21:24",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Scope control requires an existing verified retained link",
    "date_creation": "2026-10-24 16:21:23",
    "date_mod": "2026-10-24 16:21:24",
    "completed_at": null
  },
  {
    "id": 83,
    "work_id": "inbound-d-20261024-resume-unverified",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955998,\"b_items_id\":156,\"serial\":\"AGENTB-ID-OTHER\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Resume",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 955998,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 16:21:24",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Scope control requires an existing verified retained link",
    "date_creation": "2026-10-24 16:21:23",
    "date_mod": "2026-10-24 16:21:24",
    "completed_at": null
  },
  {
    "id": 84,
    "work_id": "inbound-d-20261024-sync-while-suspended",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
    "a_values_json": "{\"id_a_name\":\"MUST NOT APPLY DURING SUSPEND\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 955001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 16:21:47",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Retained link is Suspended; Sync cannot reactivate it",
    "date_creation": "2026-10-24 16:21:47",
    "date_mod": "2026-10-24 16:21:47",
    "completed_at": null
  },
  {
    "id": 85,
    "work_id": "inbound-d-20261024-correction-while-suspended",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
    "a_values_json": "{\"id_b_text\":\"ID Pending before suspend\"}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[27]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 955001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 16:21:47",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Retained link is Suspended; Sync cannot reactivate it",
    "date_creation": "2026-10-24 16:21:47",
    "date_mod": "2026-10-24 16:21:47",
    "completed_at": null
  },
  {
    "id": 86,
    "work_id": "inbound-d-20261024-resume-main",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Resume",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 955001,
    "b_items_id": 155,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 16:21:48",
    "status": "Done",
    "result_json": "{\"b_items_id\":155,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": null,
    "date_creation": "2026-10-24 16:21:48",
    "date_mod": "2026-10-24 16:21:48",
    "completed_at": "2026-10-24 16:21:48"
  },
  {
    "id": 87,
    "work_id": "inbound-d-20261024-sync-after-resume",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 955001,
    "b_items_id": 155,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 16:21:48",
    "status": "Done",
    "result_json": "{\"b_items_id\":155,\"created_b_items_id\":null,\"b_values_for_a\":{\"id_b_text\":{\"value\":\"ID native while suspended\",\"changed_at\":null,\"reliable\":false},\"id_b_option\":{\"value\":\"AgentB IC Maker\",\"changed_at\":null,\"reliable\":false},\"id_b_no_evidence\":{\"value\":\"ID no genuine evidence\",\"changed_at\":null,\"reliable\":false},\"id_fields_b\":{\"value\":\"ID Fields while suspended\",\"changed_at\":null,\"reliable\":false}},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"id_a_name\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"id_a_contact\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"id_b_text\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_b_option\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_b_no_evidence\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_fields_b\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_fields_a\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"}]}",
    "error": null,
    "date_creation": "2026-10-24 16:21:48",
    "date_mod": "2026-10-24 16:21:48",
    "completed_at": "2026-10-24 16:21:48"
  },
  {
    "id": 88,
    "work_id": "inbound-d-20261024-stale-suspend",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1,
    "handled_change_ids_json": "[]",
    "operation": "Suspend",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 955001,
    "b_items_id": null,
    "link_state": null,
    "processing_started_at": "2026-10-24 16:22:37",
    "status": "Held",
    "result_json": "{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}",
    "error": "Settings or route/entity mismatch, disabled route, or route unavailable",
    "date_creation": "2026-10-24 16:22:37",
    "date_mod": "2026-10-24 16:22:37",
    "completed_at": null
  },
  {
    "id": 89,
    "work_id": "inbound-d-20261024-both-stage-boundary",
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}",
    "a_values_json": "{\"id_both_stage\":\"MUST NOT SELECT WINNER YET\"}",
    "a_change_times_json": "{\"id_both_stage\":{\"changed_at\":\"2026-10-24T16:00:00+08:00\",\"reliable\":true}}",
    "settings_version": 2,
    "handled_change_ids_json": "[]",
    "operation": "Sync",
    "submitted_users_id": 12,
    "submitted_profiles_id": 14,
    "a_items_id": 955001,
    "b_items_id": 155,
    "link_state": "Active",
    "processing_started_at": "2026-10-24 16:22:37",
    "status": "Held",
    "result_json": "{\"b_items_id\":155,\"created_b_items_id\":null,\"b_values_for_a\":{\"id_b_text\":{\"value\":\"ID native genuine after Resume\",\"changed_at\":null,\"reliable\":false},\"id_b_option\":{\"value\":\"AgentB IC Maker\",\"changed_at\":null,\"reliable\":false},\"id_b_no_evidence\":{\"value\":\"ID no genuine evidence\",\"changed_at\":null,\"reliable\":false},\"id_fields_b\":{\"value\":\"ID Fields genuine after Resume\",\"changed_at\":null,\"reliable\":false}},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"id_a_name\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"id_a_contact\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"id_b_text\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_b_option\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_b_no_evidence\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_fields_b\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_fields_a\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"id_both_stage\",\"outcome\":\"Skipped\",\"reason\":\"Both conflict processing is not installed yet\"}]}",
    "error": "Both conflict processing is not installed yet",
    "date_creation": "2026-10-24 16:22:37",
    "date_mod": "2026-10-24 16:22:37",
    "completed_at": null
  }
]
```

### Curl 50 — ID final immutable snapshots status attempts and renewed capture

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?searchText%5Broute_id%5D=%5Einbound-d-20261024-main%24&range=0-99&sort=id&order=ASC&get_hateoas=false

Account user12/profile14/entity0; HTTP 200

Body:
```json
null
```

Response:
```json
[
  {
    "id": 17,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID B older\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:00",
    "done_at": null
  },
  {
    "id": 18,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_name\":{\"value\":\"ID genuine A edit for correction\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true},\"id_b_text\":{\"value\":\"ID B mixed old\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:00",
    "done_at": null
  },
  {
    "id": 19,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:26",
    "done_at": "2026-10-24 16:20:26"
  },
  {
    "id": 20,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_fields_b\":{\"value\":\"ID Fields B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:00",
    "date_mod": "2026-10-24 16:20:26",
    "done_at": "2026-10-24 16:20:26"
  },
  {
    "id": 21,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBICReq20261024Asset",
    "identity_json": "{\"a_items_id\":955101,\"b_items_id\":5,\"serial\":\"AGENTB-ID-CUSTOM\"}",
    "changed_fields_json": "{\"id_custom_b\":{\"value\":\"ID custom B current\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:01",
    "date_mod": "2026-10-24 16:20:01",
    "done_at": null
  },
  {
    "id": 22,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":null,\"b_items_id\":156,\"serial\":\"AGENTB-ID-OTHER\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID wrong identity genuine B\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:01",
    "date_mod": "2026-10-24 16:20:01",
    "done_at": null
  },
  {
    "id": 23,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_name\":{\"value\":\"ID human A name snapshot\",\"changed_at\":\"2026-10-24T16:20:26+08:00\",\"reliable\":true},\"id_a_contact\":{\"value\":\"ID human A contact snapshot\",\"changed_at\":\"2026-10-24T16:20:26+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 2,
    "error": null,
    "date_creation": "2026-10-24 16:20:26",
    "date_mod": "2026-10-24 16:21:23",
    "done_at": "2026-10-24 16:21:23"
  },
  {
    "id": 24,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_name\":{\"value\":\"ID human A name newer\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 1,
    "error": null,
    "date_creation": "2026-10-24 16:20:27",
    "date_mod": "2026-10-24 16:20:38",
    "done_at": "2026-10-24 16:20:38"
  },
  {
    "id": 25,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_a_contact\":{\"value\":\"ID human unselected newer contact\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:20:27",
    "date_mod": "2026-10-24 16:20:27",
    "done_at": null
  },
  {
    "id": 26,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_fields_a\":{\"value\":\"ID human Fields A edit\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}",
    "status": "Done",
    "retry_count": 1,
    "error": null,
    "date_creation": "2026-10-24 16:20:27",
    "date_mod": "2026-10-24 16:20:38",
    "done_at": "2026-10-24 16:20:38"
  },
  {
    "id": 27,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID Pending before suspend\",\"changed_at\":\"2026-10-24T16:21:23+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:21:23",
    "date_mod": "2026-10-24 16:21:23",
    "done_at": null
  },
  {
    "id": 28,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Glpi\\CustomAsset\\AgentBICReq20261024Asset",
    "identity_json": "{\"a_items_id\":955101,\"b_items_id\":5,\"serial\":\"AGENTB-ID-CUSTOM\"}",
    "changed_fields_json": "{\"id_custom_b\":{\"value\":\"ID custom still active during native suspension\",\"changed_at\":\"2026-10-24T16:21:47+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:21:47",
    "date_mod": "2026-10-24 16:21:47",
    "done_at": null
  },
  {
    "id": 29,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_b_text\":{\"value\":\"ID native genuine after Resume\",\"changed_at\":\"2026-10-24T16:21:48+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:21:48",
    "date_mod": "2026-10-24 16:21:48",
    "done_at": null
  },
  {
    "id": 30,
    "route_id": "inbound-d-20261024-main",
    "settings_version": 1,
    "a_entities_id": 9500,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}",
    "changed_fields_json": "{\"id_fields_b\":{\"value\":\"ID Fields genuine after Resume\",\"changed_at\":\"2026-10-24T16:21:48+08:00\",\"reliable\":true}}",
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 16:21:48",
    "date_mod": "2026-10-24 16:21:48",
    "done_at": null
  }
]
```

### Curl 51 — ID disable only new route after bounded pass

PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/14

Account user12/profile14/entity0; HTTP 200

Body:
```json
{
  "input": {
    "id": 14,
    "route_id": "inbound-d-20261024-main",
    "a_entities_id": 9500,
    "entities_id": 0,
    "route_enabled": 0,
    "settings_version": 3,
    "enabled_itemtypes_json": "[\"Computer\",\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\"]",
    "field_mappings_json": "[{\"mapping_id\":\"id_a_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_a_contact\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_b_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"comment\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_b_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"manufacturers_id\"},\"source\":\"B\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"id_b_no_evidence\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"otherserial\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_fields_b\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbidx\",\"name\":\"idbtextfield\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_fields_a\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbidx\",\"name\":\"idatextfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_custom_b\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_b\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_custom_option\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_option\"},\"source\":\"B\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"id_both_stage\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact_num\"},\"source\":\"Both\",\"value_mode\":\"direct\"}]"
  }
}
```

Response:
```json
[
  {
    "14": true,
    "message": ""
  }
]
```

### Curl 52 — ID disabled new route exact final readback

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/14?get_hateoas=false

Account user12/profile14/entity0; HTTP 200

Body:
```json
null
```

Response:
```json
{
  "id": 14,
  "route_id": "inbound-d-20261024-main",
  "a_entities_id": 9500,
  "entities_id": 0,
  "route_enabled": 0,
  "settings_version": 3,
  "enabled_itemtypes_json": "[\"Computer\",\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\"]",
  "field_mappings_json": "[{\"mapping_id\":\"id_a_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_a_contact\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_b_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"comment\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_b_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"manufacturers_id\"},\"source\":\"B\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"id_b_no_evidence\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"otherserial\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_fields_b\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbidx\",\"name\":\"idbtextfield\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_fields_a\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbidx\",\"name\":\"idatextfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_custom_b\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_b\"},\"source\":\"B\",\"value_mode\":\"direct\"},{\"mapping_id\":\"id_custom_option\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBICReq20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ic_option\"},\"source\":\"B\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"id_both_stage\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact_num\"},\"source\":\"Both\",\"value_mode\":\"direct\"}]"
}
```

### Curl 53 — ID close this pass created session

GET http://localhost:8081/api.php/v1/killSession

Account user12/profile14/entity0; HTTP 200

Body:
```json
null
```

Response:
```json
true
```

## Complete native operator ledger

### Local 1 — ID fresh native Fields fixture metadata and restrict only new associations

User2; exit 0. Kernel/Auth/Session/Plugin native bootstrap as above.

```php
Session::changeProfile(4);$c=new PluginFieldsContainer();$cid=$c->add(['label'=>'AgentB ID X','itemtypes'=>['Computer'],'type'=>'tab','subtype'=>'','entities_id'=>0,'is_recursive'=>0,'is_active'=>1]);$rights=[];$p=new PluginFieldsProfile();foreach($p->find(['plugin_fields_containers_id'=>$cid])as$r){$rights[(int)$r['profiles_id']]=(int)$r['profiles_id']===14?CREATE:0;}PluginFieldsProfile::updateProfile(['plugin_fields_containers_id'=>$cid,'rights'=>$rights]);$fields=[];foreach(['ID B text','ID A text']as$label){$f=new PluginFieldsField();$f->add(['plugin_fields_containers_id'=>$cid,'label'=>$label,'type'=>'text','is_active'=>1,'is_readonly'=>0,'multiple'=>0,'mandatory'=>0]);$fields[]=$f->fields;}echo json_encode(['container'=>$c->fields,'fields'=>$fields,'rights'=>array_values($p->find(['plugin_fields_containers_id'=>$cid]))]);
```

Stdout:
```json
{"container":{"id":10,"name":"agentbidx","label":"AgentB ID X","itemtypes":"[\"Computer\"]","type":"tab","subtype":"","entities_id":0,"is_recursive":0,"is_active":1},"fields":[{"id":67,"name":"idbtextfield","label":"ID B text","type":"text","plugin_fields_containers_id":10,"ranking":1,"default_value":null,"is_active":1,"is_readonly":0,"mandatory":0,"multiple":0,"allowed_values":null},{"id":68,"name":"idatextfield","label":"ID A text","type":"text","plugin_fields_containers_id":10,"ranking":1,"default_value":null,"is_active":1,"is_readonly":0,"mandatory":0,"multiple":0,"allowed_values":null}],"rights":[{"id":110,"profiles_id":1,"plugin_fields_containers_id":10,"right":"0"},{"id":111,"profiles_id":2,"plugin_fields_containers_id":10,"right":"0"},{"id":112,"profiles_id":3,"plugin_fields_containers_id":10,"right":"0"},{"id":113,"profiles_id":4,"plugin_fields_containers_id":10,"right":"0"},{"id":114,"profiles_id":5,"plugin_fields_containers_id":10,"right":"0"},{"id":115,"profiles_id":6,"plugin_fields_containers_id":10,"right":"0"},{"id":116,"profiles_id":7,"plugin_fields_containers_id":10,"right":"0"},{"id":117,"profiles_id":8,"plugin_fields_containers_id":10,"right":"0"},{"id":118,"profiles_id":9,"plugin_fields_containers_id":10,"right":"0"},{"id":119,"profiles_id":10,"plugin_fields_containers_id":10,"right":"0"},{"id":120,"profiles_id":11,"plugin_fields_containers_id":10,"right":"0"},{"id":121,"profiles_id":12,"plugin_fields_containers_id":10,"right":"0"},{"id":122,"profiles_id":13,"plugin_fields_containers_id":10,"right":"0"},{"id":123,"profiles_id":14,"plugin_fields_containers_id":10,"right":"4"},{"id":124,"profiles_id":15,"plugin_fields_containers_id":10,"right":"0"}]}
```

Stderr:
```text

```

### Local 2 — ID initial current B returns and durable links

User2; exit 0. Kernel/Auth/Session/Plugin native bootstrap as above.

```php
$_SESSION['glpicronuserrunning']='ID scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=$before?iterator_to_array($DB->request(['FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC'])):[];$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Stdout:
```json
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"69":{"id":69,"work_id":"inbound-d-20261024-initial-native-return","status":"Accepted"},"70":{"id":70,"work_id":"inbound-d-20261024-initial-custom-return","status":"Accepted"}},"after":{"69":{"id":69,"work_id":"inbound-d-20261024-initial-native-return","route_id":"inbound-d-20261024-main","a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}","a_values_json":"{}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":955001,"b_items_id":null,"link_state":null,"processing_started_at":"2026-10-24 16:19:15","status":"Held","result_json":"{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","date_creation":"2026-10-24 16:19:15","date_mod":"2026-10-24 16:19:15","completed_at":null},"70":{"id":70,"work_id":"inbound-d-20261024-initial-custom-return","route_id":"inbound-d-20261024-main","a_entities_id":9500,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBICReq20261024Asset","identity_json":"{\"a_items_id\":955101,\"b_items_id\":null,\"serial\":\"AGENTB-ID-CUSTOM\"}","a_values_json":"{}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":955101,"b_items_id":null,"link_state":null,"processing_started_at":"2026-10-24 16:19:15","status":"Held","result_json":"{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","date_creation":"2026-10-24 16:19:15","date_mod":"2026-10-24 16:19:15","completed_at":null}},"logs":{"253":{"id":253,"crontasks_id":51,"crontasklogs_id":252,"date":"2026-10-24 16:19:15","state":2,"elapsed":0.0137949,"volume":2,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}
```

Stderr:
```text

```

### Local 3 — ID native Fields custom current B returns without genuine evidence

User2; exit 0. Kernel/Auth/Session/Plugin native bootstrap as above.

```php
$_SESSION['glpicronuserrunning']='ID scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=$before?iterator_to_array($DB->request(['FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC'])):[];$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Stdout:
```json
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"71":{"id":71,"work_id":"inbound-d-20261024-native-return-no-evidence","status":"Accepted"},"72":{"id":72,"work_id":"inbound-d-20261024-custom-return-no-evidence","status":"Accepted"}},"after":{"71":{"id":71,"work_id":"inbound-d-20261024-native-return-no-evidence","route_id":"inbound-d-20261024-main","a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}","a_values_json":"{}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":955001,"b_items_id":155,"link_state":"Active","processing_started_at":"2026-10-24 16:19:42","status":"Done","result_json":"{\"b_items_id\":155,\"created_b_items_id\":null,\"b_values_for_a\":{\"id_b_text\":{\"value\":\"ID initial B text\",\"changed_at\":null,\"reliable\":false},\"id_b_option\":{\"value\":\"AgentB IC Maker\",\"changed_at\":null,\"reliable\":false},\"id_b_no_evidence\":{\"value\":\"ID no genuine evidence\",\"changed_at\":null,\"reliable\":false},\"id_fields_b\":{\"value\":\"ID Fields B initial\",\"changed_at\":null,\"reliable\":false}},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"id_a_name\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"id_a_contact\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"id_b_text\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_b_option\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_b_no_evidence\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_fields_b\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_fields_a\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"}]}","error":null,"date_creation":"2026-10-24 16:19:41","date_mod":"2026-10-24 16:19:42","completed_at":"2026-10-24 16:19:42"},"72":{"id":72,"work_id":"inbound-d-20261024-custom-return-no-evidence","route_id":"inbound-d-20261024-main","a_entities_id":9500,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBICReq20261024Asset","identity_json":"{\"a_items_id\":955101,\"b_items_id\":null,\"serial\":\"AGENTB-ID-CUSTOM\"}","a_values_json":"{}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":955101,"b_items_id":5,"link_state":"Active","processing_started_at":"2026-10-24 16:19:42","status":"Done","result_json":"{\"b_items_id\":5,\"created_b_items_id\":null,\"b_values_for_a\":{\"id_custom_b\":{\"value\":\"ID custom B initial\",\"changed_at\":null,\"reliable\":false},\"id_custom_option\":{\"value\":\"AgentB IC Maker\",\"changed_at\":null,\"reliable\":false}},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"id_custom_b\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_custom_option\",\"outcome\":\"ReturnToA\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:19:41","date_mod":"2026-10-24 16:19:42","completed_at":"2026-10-24 16:19:42"}},"logs":{"255":{"id":255,"crontasks_id":51,"crontasklogs_id":254,"date":"2026-10-24 16:19:42","state":2,"elapsed":0.059083,"volume":2,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}
```

Stderr:
```text

```

### Local 4 — ID native readonly rights and history baseline before B returns

User2; exit 0. Kernel/Auth/Session/Plugin native bootstrap as above.

```php
ProfileRight::updateProfileRights(14,['computer'=>READ]);PluginFieldsProfile::updateProfile(['plugin_fields_containers_id'=>10,'rights'=>[14=>READ]]);echo json_encode(['computer'=>(new ProfileRight())->find(['profiles_id'=>14,'name'=>'computer']),'fields'=>(new PluginFieldsProfile())->find(['profiles_id'=>14,'plugin_fields_containers_id'=>10]),'history'=>iterator_to_array($DB->request(['FROM'=>Log::getTable(),'WHERE'=>['itemtype'=>'Computer','items_id'=>155],'ORDER'=>'id ASC'])),'queue'=>countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[])]);
```

Stdout:
```json
{"computer":{"1354":{"id":1354,"profiles_id":14,"name":"computer","rights":1}},"fields":{"123":{"id":123,"profiles_id":14,"plugin_fields_containers_id":10,"right":"1"}},"history":{"140533":{"id":140533,"itemtype":"Computer","items_id":155,"itemtype_link":"0","linked_action":20,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:18:58","id_search_option":0,"old_value":"","new_value":"","old_id":null,"new_id":null},"140551":{"id":140551,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":17,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:19:15","id_search_option":0,"old_value":"","new_value":"N\/A (1)","old_id":null,"new_id":null},"140584":{"id":140584,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":16,"old_value":"ID initial B text","new_value":"ID B older","old_id":null,"new_id":null},"140585":{"id":140585,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":1,"old_value":"AgentB ID initial A name","new_value":"ID genuine A edit for correction","old_id":null,"new_id":null},"140586":{"id":140586,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":16,"old_value":"ID B older","new_value":"ID B mixed old","old_id":null,"new_id":null},"140590":{"id":140590,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":16,"old_value":"ID B mixed old","new_value":"ID B current","old_id":null,"new_id":null},"140591":{"id":140591,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":0,"old_value":"ID Fields B initial","new_value":"ID Fields B current","old_id":null,"new_id":null}},"queue":22}
```

Stderr:
```text

```

### Local 5 — ID readonly native Fields and custom genuine return coverage

User2; exit 0. Kernel/Auth/Session/Plugin native bootstrap as above.

```php
$_SESSION['glpicronuserrunning']='ID scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=$before?iterator_to_array($DB->request(['FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC'])):[];$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Stdout:
```json
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"73":{"id":73,"work_id":"inbound-d-20261024-read-only-current-return","status":"Accepted"},"74":{"id":74,"work_id":"inbound-d-20261024-custom-current-return","status":"Accepted"}},"after":{"73":{"id":73,"work_id":"inbound-d-20261024-read-only-current-return","route_id":"inbound-d-20261024-main","a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}","a_values_json":"{\"id_b_text\":\"ID B current\",\"id_fields_b\":\"ID Fields B current\",\"id_b_option\":\"AgentB IC Maker\"}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":955001,"b_items_id":155,"link_state":"Active","processing_started_at":"2026-10-24 16:20:01","status":"Done","result_json":"{\"b_items_id\":155,\"created_b_items_id\":null,\"b_values_for_a\":{\"id_b_text\":{\"value\":\"ID B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true},\"id_b_option\":{\"value\":\"AgentB IC Maker\",\"changed_at\":null,\"reliable\":false},\"id_b_no_evidence\":{\"value\":\"ID no genuine evidence\",\"changed_at\":null,\"reliable\":false},\"id_fields_b\":{\"value\":\"ID Fields B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}},\"covered_change_ids\":[19,20],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"id_a_name\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"id_a_contact\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"id_b_text\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_b_option\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_b_no_evidence\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_fields_b\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_fields_a\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"}]}","error":null,"date_creation":"2026-10-24 16:20:01","date_mod":"2026-10-24 16:20:01","completed_at":"2026-10-24 16:20:01"},"74":{"id":74,"work_id":"inbound-d-20261024-custom-current-return","route_id":"inbound-d-20261024-main","a_entities_id":9500,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBICReq20261024Asset","identity_json":"{\"a_items_id\":955101,\"b_items_id\":null,\"serial\":\"AGENTB-ID-CUSTOM\"}","a_values_json":"{}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":955101,"b_items_id":5,"link_state":"Active","processing_started_at":"2026-10-24 16:20:01","status":"Done","result_json":"{\"b_items_id\":5,\"created_b_items_id\":null,\"b_values_for_a\":{\"id_custom_b\":{\"value\":\"ID custom B current\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true},\"id_custom_option\":{\"value\":\"AgentB IC Maker\",\"changed_at\":null,\"reliable\":false}},\"covered_change_ids\":[21],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"id_custom_b\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_custom_option\",\"outcome\":\"ReturnToA\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:20:01","date_mod":"2026-10-24 16:20:01","completed_at":"2026-10-24 16:20:01"}},"logs":{"257":{"id":257,"crontasks_id":51,"crontasklogs_id":256,"date":"2026-10-24 16:20:01","state":2,"elapsed":0.059392,"volume":2,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}
```

Stderr:
```text

```

### Local 6 — ID verify readonly return made no local saves then restore only test rights

User2; exit 0. Kernel/Auth/Session/Plugin native bootstrap as above.

```php
echo json_encode(['history'=>iterator_to_array($DB->request(['FROM'=>Log::getTable(),'WHERE'=>['itemtype'=>'Computer','items_id'=>155],'ORDER'=>'id ASC'])),'queue'=>countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[])]);ProfileRight::updateProfileRights(14,['computer'=>READ|UPDATE|CREATE]);PluginFieldsProfile::updateProfile(['plugin_fields_containers_id'=>10,'rights'=>[14=>CREATE]]);
```

Stdout:
```json
{"history":{"140533":{"id":140533,"itemtype":"Computer","items_id":155,"itemtype_link":"0","linked_action":20,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:18:58","id_search_option":0,"old_value":"","new_value":"","old_id":null,"new_id":null},"140551":{"id":140551,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":17,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:19:15","id_search_option":0,"old_value":"","new_value":"N\/A (1)","old_id":null,"new_id":null},"140584":{"id":140584,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":16,"old_value":"ID initial B text","new_value":"ID B older","old_id":null,"new_id":null},"140585":{"id":140585,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":1,"old_value":"AgentB ID initial A name","new_value":"ID genuine A edit for correction","old_id":null,"new_id":null},"140586":{"id":140586,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":16,"old_value":"ID B older","new_value":"ID B mixed old","old_id":null,"new_id":null},"140590":{"id":140590,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":16,"old_value":"ID B mixed old","new_value":"ID B current","old_id":null,"new_id":null},"140591":{"id":140591,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":0,"old_value":"ID Fields B initial","new_value":"ID Fields B current","old_id":null,"new_id":null}},"queue":22}
```

Stderr:
```text

```

### Local 7 — ID prevalidate every correction reference before writes and attempts

User2; exit 0. Kernel/Auth/Session/Plugin native bootstrap as above.

```php
$_SESSION['glpicronuserrunning']='ID scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=$before?iterator_to_array($DB->request(['FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC'])):[];$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Stdout:
```json
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"75":{"id":75,"work_id":"inbound-d-20261024-invalid-missing","status":"Accepted"},"76":{"id":76,"work_id":"inbound-d-20261024-invalid-route","status":"Accepted"},"77":{"id":77,"work_id":"inbound-d-20261024-invalid-type","status":"Accepted"},"78":{"id":78,"work_id":"inbound-d-20261024-invalid-identity","status":"Accepted"}},"after":{"75":{"id":75,"work_id":"inbound-d-20261024-invalid-missing","route_id":"inbound-d-20261024-main","a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}","a_values_json":"{\"id_a_name\":\"MUST NOT WRITE MISSING\"}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[23,2147483647]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":955001,"b_items_id":null,"link_state":null,"processing_started_at":"2026-10-24 16:20:38","status":"Held","result_json":"{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}","error":"Correction snapshot missing or not permitted: 2147483647","date_creation":"2026-10-24 16:20:38","date_mod":"2026-10-24 16:20:38","completed_at":null},"76":{"id":76,"work_id":"inbound-d-20261024-invalid-route","route_id":"inbound-d-20261024-main","a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}","a_values_json":"{\"id_a_name\":\"MUST NOT WRITE ROUTE\"}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[23,16]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":955001,"b_items_id":null,"link_state":null,"processing_started_at":"2026-10-24 16:20:38","status":"Held","result_json":"{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}","error":"Correction snapshot route\/type\/entity\/settings mismatch: 16","date_creation":"2026-10-24 16:20:38","date_mod":"2026-10-24 16:20:38","completed_at":null},"77":{"id":77,"work_id":"inbound-d-20261024-invalid-type","route_id":"inbound-d-20261024-main","a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}","a_values_json":"{\"id_a_name\":\"MUST NOT WRITE TYPE\"}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[23,21]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":955001,"b_items_id":null,"link_state":null,"processing_started_at":"2026-10-24 16:20:38","status":"Held","result_json":"{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}","error":"Correction snapshot route\/type\/entity\/settings mismatch: 21","date_creation":"2026-10-24 16:20:38","date_mod":"2026-10-24 16:20:38","completed_at":null},"78":{"id":78,"work_id":"inbound-d-20261024-invalid-identity","route_id":"inbound-d-20261024-main","a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}","a_values_json":"{\"id_a_name\":\"MUST NOT WRITE IDENTITY\"}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[23,22]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":955001,"b_items_id":null,"link_state":null,"processing_started_at":"2026-10-24 16:20:38","status":"Held","result_json":"{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}","error":"Correction snapshot identity mismatch: 22","date_creation":"2026-10-24 16:20:38","date_mod":"2026-10-24 16:20:38","completed_at":null}},"logs":{"259":{"id":259,"crontasks_id":51,"crontasklogs_id":258,"date":"2026-10-24 16:20:38","state":2,"elapsed":0.041122,"volume":4,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}
```

Stderr:
```text

```

### Local 8 — ID validated attempts and exact full coverage completion only

User2; exit 0. Kernel/Auth/Session/Plugin native bootstrap as above.

```php
$_SESSION['glpicronuserrunning']='ID scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=$before?iterator_to_array($DB->request(['FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC'])):[];$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Stdout:
```json
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"79":{"id":79,"work_id":"inbound-d-20261024-partial-and-full-correction","status":"Accepted"}},"after":{"79":{"id":79,"work_id":"inbound-d-20261024-partial-and-full-correction","route_id":"inbound-d-20261024-main","a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}","a_values_json":"{\"id_a_name\":\"ID A winner name\",\"id_fields_a\":\"ID A Fields winner\"}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[23,24,26]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":955001,"b_items_id":155,"link_state":"Active","processing_started_at":"2026-10-24 16:20:38","status":"Held","result_json":"{\"b_items_id\":155,\"created_b_items_id\":null,\"b_values_for_a\":{\"id_b_text\":{\"value\":\"ID B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true},\"id_b_option\":{\"value\":\"AgentB IC Maker\",\"changed_at\":null,\"reliable\":false},\"id_b_no_evidence\":{\"value\":\"ID no genuine evidence\",\"changed_at\":null,\"reliable\":false},\"id_fields_b\":{\"value\":\"ID Fields B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}},\"covered_change_ids\":[],\"handled_change_ids_done\":[24,26],\"field_outcomes\":[{\"mapping_id\":\"id_a_name\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"id_a_contact\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"id_b_text\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_b_option\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_b_no_evidence\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_fields_b\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_fields_a\",\"outcome\":\"AppliedToB\",\"reason\":null}]}","error":"Snapshot 23: Snapshot field was not fully handled: id_a_contact","date_creation":"2026-10-24 16:20:38","date_mod":"2026-10-24 16:20:38","completed_at":null}},"logs":{"261":{"id":261,"crontasks_id":51,"crontasklogs_id":260,"date":"2026-10-24 16:20:38","state":2,"elapsed":0.07743,"volume":1,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}
```

Stderr:
```text

```

### Local 9 — ID reconciled correction exact Done and no repeat attempts on Done

User2; exit 0. Kernel/Auth/Session/Plugin native bootstrap as above.

```php
$_SESSION['glpicronuserrunning']='ID scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=$before?iterator_to_array($DB->request(['FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC'])):[];$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Stdout:
```json
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"80":{"id":80,"work_id":"inbound-d-20261024-complete-after-reconciliation","status":"Accepted"}},"after":{"80":{"id":80,"work_id":"inbound-d-20261024-complete-after-reconciliation","route_id":"inbound-d-20261024-main","a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}","a_values_json":"{\"id_a_name\":\"ID A winner name\",\"id_a_contact\":\"ID A winner contact\",\"id_fields_a\":\"ID A Fields winner\"}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[23,24,26]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":955001,"b_items_id":155,"link_state":"Active","processing_started_at":"2026-10-24 16:21:23","status":"Done","result_json":"{\"b_items_id\":155,\"created_b_items_id\":null,\"b_values_for_a\":{\"id_b_text\":{\"value\":\"ID B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true},\"id_b_option\":{\"value\":\"AgentB IC Maker\",\"changed_at\":null,\"reliable\":false},\"id_b_no_evidence\":{\"value\":\"ID no genuine evidence\",\"changed_at\":null,\"reliable\":false},\"id_fields_b\":{\"value\":\"ID Fields B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}},\"covered_change_ids\":[],\"handled_change_ids_done\":[23,24,26],\"field_outcomes\":[{\"mapping_id\":\"id_a_name\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"id_a_contact\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"id_b_text\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_b_option\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_b_no_evidence\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_fields_b\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_fields_a\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:21:23","date_mod":"2026-10-24 16:21:23","completed_at":"2026-10-24 16:21:23"}},"logs":{"263":{"id":263,"crontasks_id":51,"crontasklogs_id":262,"date":"2026-10-24 16:21:23","state":2,"elapsed":0.0728352,"volume":1,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}
```

Stderr:
```text

```

### Local 10 — ID control baseline asset History and queue

User12; exit 0. Kernel/Auth/Session/Plugin native bootstrap as above.

```php
echo json_encode(['asset'=>(new Computer())->find(['id'=>155]),'storage'=>(new PluginFieldsComputeragentbidx())->find(['items_id'=>155]),'history'=>iterator_to_array($DB->request(['FROM'=>Log::getTable(),'WHERE'=>['itemtype'=>'Computer','items_id'=>155],'ORDER'=>'id ASC'])),'queue'=>(new PluginAgentbdmosassetsyncChange())->find(['route_id'=>'inbound-d-20261024-main'])]);
```

Stdout:
```json
{"asset":{"155":{"id":155,"entities_id":0,"name":"ID A winner name","serial":"AGENTB-ID-MAIN","otherserial":"ID no genuine evidence","contact":"ID A winner contact","contact_num":null,"users_id_tech":0,"comment":"ID Pending before suspend","date_mod":"2026-10-24 16:21:23","autoupdatesystems_id":0,"locations_id":0,"networks_id":0,"computermodels_id":0,"computertypes_id":0,"is_template":0,"template_name":null,"manufacturers_id":7,"is_deleted":0,"is_dynamic":0,"users_id":0,"states_id":0,"ticket_tco":"0.0000","uuid":null,"date_creation":"2026-10-24 16:18:58","is_recursive":0,"last_inventory_update":null,"last_boot":null}},"storage":{"1":{"id":1,"items_id":155,"itemtype":"Computer","plugin_fields_containers_id":10,"entities_id":0,"idbtextfield":"ID Fields B current","idatextfield":"ID A Fields winner"}},"history":{"140533":{"id":140533,"itemtype":"Computer","items_id":155,"itemtype_link":"0","linked_action":20,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:18:58","id_search_option":0,"old_value":"","new_value":"","old_id":null,"new_id":null},"140551":{"id":140551,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":17,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:19:15","id_search_option":0,"old_value":"","new_value":"N\/A (1)","old_id":null,"new_id":null},"140584":{"id":140584,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":16,"old_value":"ID initial B text","new_value":"ID B older","old_id":null,"new_id":null},"140585":{"id":140585,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":1,"old_value":"AgentB ID initial A name","new_value":"ID genuine A edit for correction","old_id":null,"new_id":null},"140586":{"id":140586,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":16,"old_value":"ID B older","new_value":"ID B mixed old","old_id":null,"new_id":null},"140590":{"id":140590,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":16,"old_value":"ID B mixed old","new_value":"ID B current","old_id":null,"new_id":null},"140591":{"id":140591,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":0,"old_value":"ID Fields B initial","new_value":"ID Fields B current","old_id":null,"new_id":null},"140606":{"id":140606,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:26","id_search_option":1,"old_value":"ID genuine A edit for correction","new_value":"ID human A name snapshot","old_id":null,"new_id":null},"140607":{"id":140607,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:26","id_search_option":7,"old_value":"ID initial A contact","new_value":"ID human A contact snapshot","old_id":null,"new_id":null},"140608":{"id":140608,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:27","id_search_option":1,"old_value":"ID human A name snapshot","new_value":"ID human A name newer","old_id":null,"new_id":null},"140609":{"id":140609,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:27","id_search_option":7,"old_value":"ID human A contact snapshot","new_value":"ID human unselected newer contact","old_id":null,"new_id":null},"140610":{"id":140610,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:27","id_search_option":0,"old_value":"ID Fields A initial","new_value":"ID human Fields A edit","old_id":null,"new_id":null},"140618":{"id":140618,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:38","id_search_option":1,"old_value":"ID human A name newer","new_value":"ID A winner name","old_id":null,"new_id":null},"140619":{"id":140619,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:38","id_search_option":0,"old_value":"ID human Fields A edit","new_value":"ID A Fields winner","old_id":null,"new_id":null},"140620":{"id":140620,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:38","id_search_option":76733,"old_value":"ID human Fields A edit","new_value":"ID A Fields winner","old_id":null,"new_id":null},"140644":{"id":140644,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:21:23","id_search_option":7,"old_value":"ID human unselected newer contact","new_value":"ID A winner contact","old_id":null,"new_id":null},"140645":{"id":140645,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:21:23","id_search_option":16,"old_value":"ID B current","new_value":"ID Pending before suspend","old_id":null,"new_id":null}},"queue":{"17":{"id":17,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_b_text\":{\"value\":\"ID B older\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:00","date_mod":"2026-10-24 16:20:00","done_at":null},"18":{"id":18,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_a_name\":{\"value\":\"ID genuine A edit for correction\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true},\"id_b_text\":{\"value\":\"ID B mixed old\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:00","date_mod":"2026-10-24 16:20:00","done_at":null},"19":{"id":19,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_b_text\":{\"value\":\"ID B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}","status":"Done","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:00","date_mod":"2026-10-24 16:20:26","done_at":"2026-10-24 16:20:26"},"20":{"id":20,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_fields_b\":{\"value\":\"ID Fields B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}","status":"Done","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:00","date_mod":"2026-10-24 16:20:26","done_at":"2026-10-24 16:20:26"},"21":{"id":21,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBICReq20261024Asset","identity_json":"{\"a_items_id\":955101,\"b_items_id\":5,\"serial\":\"AGENTB-ID-CUSTOM\"}","changed_fields_json":"{\"id_custom_b\":{\"value\":\"ID custom B current\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:01","date_mod":"2026-10-24 16:20:01","done_at":null},"22":{"id":22,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":null,\"b_items_id\":156,\"serial\":\"AGENTB-ID-OTHER\"}","changed_fields_json":"{\"id_b_text\":{\"value\":\"ID wrong identity genuine B\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:01","date_mod":"2026-10-24 16:20:01","done_at":null},"23":{"id":23,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_a_name\":{\"value\":\"ID human A name snapshot\",\"changed_at\":\"2026-10-24T16:20:26+08:00\",\"reliable\":true},\"id_a_contact\":{\"value\":\"ID human A contact snapshot\",\"changed_at\":\"2026-10-24T16:20:26+08:00\",\"reliable\":true}}","status":"Done","retry_count":2,"error":null,"date_creation":"2026-10-24 16:20:26","date_mod":"2026-10-24 16:21:23","done_at":"2026-10-24 16:21:23"},"24":{"id":24,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_a_name\":{\"value\":\"ID human A name newer\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}","status":"Done","retry_count":1,"error":null,"date_creation":"2026-10-24 16:20:27","date_mod":"2026-10-24 16:20:38","done_at":"2026-10-24 16:20:38"},"25":{"id":25,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_a_contact\":{\"value\":\"ID human unselected newer contact\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:27","date_mod":"2026-10-24 16:20:27","done_at":null},"26":{"id":26,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_fields_a\":{\"value\":\"ID human Fields A edit\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}","status":"Done","retry_count":1,"error":null,"date_creation":"2026-10-24 16:20:27","date_mod":"2026-10-24 16:20:38","done_at":"2026-10-24 16:20:38"},"27":{"id":27,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_b_text\":{\"value\":\"ID Pending before suspend\",\"changed_at\":\"2026-10-24T16:21:23+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:21:23","date_mod":"2026-10-24 16:21:23","done_at":null}}}
```

Stderr:
```text

```

### Local 11 — ID retained Suspend and no-link controls

User2; exit 0. Kernel/Auth/Session/Plugin native bootstrap as above.

```php
$_SESSION['glpicronuserrunning']='ID scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=$before?iterator_to_array($DB->request(['FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC'])):[];$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Stdout:
```json
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"81":{"id":81,"work_id":"inbound-d-20261024-suspend-main","status":"Accepted"},"82":{"id":82,"work_id":"inbound-d-20261024-suspend-no-link","status":"Accepted"},"83":{"id":83,"work_id":"inbound-d-20261024-resume-unverified","status":"Accepted"}},"after":{"81":{"id":81,"work_id":"inbound-d-20261024-suspend-main","route_id":"inbound-d-20261024-main","a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}","a_values_json":"{}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[]","operation":"Suspend","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":955001,"b_items_id":155,"link_state":"Suspended","processing_started_at":"2026-10-24 16:21:24","status":"Done","result_json":"{\"b_items_id\":155,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}","error":null,"date_creation":"2026-10-24 16:21:23","date_mod":"2026-10-24 16:21:24","completed_at":"2026-10-24 16:21:24"},"82":{"id":82,"work_id":"inbound-d-20261024-suspend-no-link","route_id":"inbound-d-20261024-main","a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955999,\"b_items_id\":null,\"serial\":\"AGENTB-ID-NO-LINK\"}","a_values_json":"{}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[]","operation":"Suspend","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":955999,"b_items_id":null,"link_state":null,"processing_started_at":"2026-10-24 16:21:24","status":"Held","result_json":"{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}","error":"Scope control requires an existing verified retained link","date_creation":"2026-10-24 16:21:23","date_mod":"2026-10-24 16:21:24","completed_at":null},"83":{"id":83,"work_id":"inbound-d-20261024-resume-unverified","route_id":"inbound-d-20261024-main","a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955998,\"b_items_id\":156,\"serial\":\"AGENTB-ID-OTHER\"}","a_values_json":"{}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[]","operation":"Resume","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":955998,"b_items_id":null,"link_state":null,"processing_started_at":"2026-10-24 16:21:24","status":"Held","result_json":"{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}","error":"Scope control requires an existing verified retained link","date_creation":"2026-10-24 16:21:23","date_mod":"2026-10-24 16:21:24","completed_at":null}},"logs":{"265":{"id":265,"crontasks_id":51,"crontasklogs_id":264,"date":"2026-10-24 16:21:24","state":2,"elapsed":0.0157812,"volume":3,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}
```

Stderr:
```text

```

### Local 12 — ID control no asset storage History or queue mutation

User12; exit 0. Kernel/Auth/Session/Plugin native bootstrap as above.

```php
echo json_encode(['asset'=>(new Computer())->find(['id'=>155]),'storage'=>(new PluginFieldsComputeragentbidx())->find(['items_id'=>155]),'history'=>iterator_to_array($DB->request(['FROM'=>Log::getTable(),'WHERE'=>['itemtype'=>'Computer','items_id'=>155],'ORDER'=>'id ASC'])),'queue'=>(new PluginAgentbdmosassetsyncChange())->find(['route_id'=>'inbound-d-20261024-main'])]);
```

Stdout:
```json
{"asset":{"155":{"id":155,"entities_id":0,"name":"ID A winner name","serial":"AGENTB-ID-MAIN","otherserial":"ID no genuine evidence","contact":"ID A winner contact","contact_num":null,"users_id_tech":0,"comment":"ID Pending before suspend","date_mod":"2026-10-24 16:21:23","autoupdatesystems_id":0,"locations_id":0,"networks_id":0,"computermodels_id":0,"computertypes_id":0,"is_template":0,"template_name":null,"manufacturers_id":7,"is_deleted":0,"is_dynamic":0,"users_id":0,"states_id":0,"ticket_tco":"0.0000","uuid":null,"date_creation":"2026-10-24 16:18:58","is_recursive":0,"last_inventory_update":null,"last_boot":null}},"storage":{"1":{"id":1,"items_id":155,"itemtype":"Computer","plugin_fields_containers_id":10,"entities_id":0,"idbtextfield":"ID Fields B current","idatextfield":"ID A Fields winner"}},"history":{"140533":{"id":140533,"itemtype":"Computer","items_id":155,"itemtype_link":"0","linked_action":20,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:18:58","id_search_option":0,"old_value":"","new_value":"","old_id":null,"new_id":null},"140551":{"id":140551,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":17,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:19:15","id_search_option":0,"old_value":"","new_value":"N\/A (1)","old_id":null,"new_id":null},"140584":{"id":140584,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":16,"old_value":"ID initial B text","new_value":"ID B older","old_id":null,"new_id":null},"140585":{"id":140585,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":1,"old_value":"AgentB ID initial A name","new_value":"ID genuine A edit for correction","old_id":null,"new_id":null},"140586":{"id":140586,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":16,"old_value":"ID B older","new_value":"ID B mixed old","old_id":null,"new_id":null},"140590":{"id":140590,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":16,"old_value":"ID B mixed old","new_value":"ID B current","old_id":null,"new_id":null},"140591":{"id":140591,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":0,"old_value":"ID Fields B initial","new_value":"ID Fields B current","old_id":null,"new_id":null},"140606":{"id":140606,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:26","id_search_option":1,"old_value":"ID genuine A edit for correction","new_value":"ID human A name snapshot","old_id":null,"new_id":null},"140607":{"id":140607,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:26","id_search_option":7,"old_value":"ID initial A contact","new_value":"ID human A contact snapshot","old_id":null,"new_id":null},"140608":{"id":140608,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:27","id_search_option":1,"old_value":"ID human A name snapshot","new_value":"ID human A name newer","old_id":null,"new_id":null},"140609":{"id":140609,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:27","id_search_option":7,"old_value":"ID human A contact snapshot","new_value":"ID human unselected newer contact","old_id":null,"new_id":null},"140610":{"id":140610,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:27","id_search_option":0,"old_value":"ID Fields A initial","new_value":"ID human Fields A edit","old_id":null,"new_id":null},"140618":{"id":140618,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:38","id_search_option":1,"old_value":"ID human A name newer","new_value":"ID A winner name","old_id":null,"new_id":null},"140619":{"id":140619,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:38","id_search_option":0,"old_value":"ID human Fields A edit","new_value":"ID A Fields winner","old_id":null,"new_id":null},"140620":{"id":140620,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:38","id_search_option":76733,"old_value":"ID human Fields A edit","new_value":"ID A Fields winner","old_id":null,"new_id":null},"140644":{"id":140644,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:21:23","id_search_option":7,"old_value":"ID human unselected newer contact","new_value":"ID A winner contact","old_id":null,"new_id":null},"140645":{"id":140645,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:21:23","id_search_option":16,"old_value":"ID B current","new_value":"ID Pending before suspend","old_id":null,"new_id":null}},"queue":{"17":{"id":17,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_b_text\":{\"value\":\"ID B older\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:00","date_mod":"2026-10-24 16:20:00","done_at":null},"18":{"id":18,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_a_name\":{\"value\":\"ID genuine A edit for correction\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true},\"id_b_text\":{\"value\":\"ID B mixed old\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:00","date_mod":"2026-10-24 16:20:00","done_at":null},"19":{"id":19,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_b_text\":{\"value\":\"ID B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}","status":"Done","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:00","date_mod":"2026-10-24 16:20:26","done_at":"2026-10-24 16:20:26"},"20":{"id":20,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_fields_b\":{\"value\":\"ID Fields B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}","status":"Done","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:00","date_mod":"2026-10-24 16:20:26","done_at":"2026-10-24 16:20:26"},"21":{"id":21,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBICReq20261024Asset","identity_json":"{\"a_items_id\":955101,\"b_items_id\":5,\"serial\":\"AGENTB-ID-CUSTOM\"}","changed_fields_json":"{\"id_custom_b\":{\"value\":\"ID custom B current\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:01","date_mod":"2026-10-24 16:20:01","done_at":null},"22":{"id":22,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":null,\"b_items_id\":156,\"serial\":\"AGENTB-ID-OTHER\"}","changed_fields_json":"{\"id_b_text\":{\"value\":\"ID wrong identity genuine B\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:01","date_mod":"2026-10-24 16:20:01","done_at":null},"23":{"id":23,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_a_name\":{\"value\":\"ID human A name snapshot\",\"changed_at\":\"2026-10-24T16:20:26+08:00\",\"reliable\":true},\"id_a_contact\":{\"value\":\"ID human A contact snapshot\",\"changed_at\":\"2026-10-24T16:20:26+08:00\",\"reliable\":true}}","status":"Done","retry_count":2,"error":null,"date_creation":"2026-10-24 16:20:26","date_mod":"2026-10-24 16:21:23","done_at":"2026-10-24 16:21:23"},"24":{"id":24,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_a_name\":{\"value\":\"ID human A name newer\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}","status":"Done","retry_count":1,"error":null,"date_creation":"2026-10-24 16:20:27","date_mod":"2026-10-24 16:20:38","done_at":"2026-10-24 16:20:38"},"25":{"id":25,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_a_contact\":{\"value\":\"ID human unselected newer contact\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:27","date_mod":"2026-10-24 16:20:27","done_at":null},"26":{"id":26,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_fields_a\":{\"value\":\"ID human Fields A edit\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}","status":"Done","retry_count":1,"error":null,"date_creation":"2026-10-24 16:20:27","date_mod":"2026-10-24 16:20:38","done_at":"2026-10-24 16:20:38"},"27":{"id":27,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_b_text\":{\"value\":\"ID Pending before suspend\",\"changed_at\":\"2026-10-24T16:21:23+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:21:23","date_mod":"2026-10-24 16:21:23","done_at":null}}}
```

Stderr:
```text

```

### Local 13 — ID actual Suspended boundary holds Sync and corrections

User2; exit 0. Kernel/Auth/Session/Plugin native bootstrap as above.

```php
$_SESSION['glpicronuserrunning']='ID scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=$before?iterator_to_array($DB->request(['FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC'])):[];$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Stdout:
```json
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"84":{"id":84,"work_id":"inbound-d-20261024-sync-while-suspended","status":"Accepted"},"85":{"id":85,"work_id":"inbound-d-20261024-correction-while-suspended","status":"Accepted"}},"after":{"84":{"id":84,"work_id":"inbound-d-20261024-sync-while-suspended","route_id":"inbound-d-20261024-main","a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}","a_values_json":"{\"id_a_name\":\"MUST NOT APPLY DURING SUSPEND\"}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":955001,"b_items_id":null,"link_state":null,"processing_started_at":"2026-10-24 16:21:47","status":"Held","result_json":"{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}","error":"Retained link is Suspended; Sync cannot reactivate it","date_creation":"2026-10-24 16:21:47","date_mod":"2026-10-24 16:21:47","completed_at":null},"85":{"id":85,"work_id":"inbound-d-20261024-correction-while-suspended","route_id":"inbound-d-20261024-main","a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}","a_values_json":"{\"id_b_text\":\"ID Pending before suspend\"}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[27]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":955001,"b_items_id":null,"link_state":null,"processing_started_at":"2026-10-24 16:21:47","status":"Held","result_json":"{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}","error":"Retained link is Suspended; Sync cannot reactivate it","date_creation":"2026-10-24 16:21:47","date_mod":"2026-10-24 16:21:47","completed_at":null}},"logs":{"267":{"id":267,"crontasks_id":51,"crontasklogs_id":266,"date":"2026-10-24 16:21:47","state":2,"elapsed":0.017271,"volume":2,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}
```

Stderr:
```text

```

### Local 14 — ID resume asset storage History baseline after genuine edits

User12; exit 0. Kernel/Auth/Session/Plugin native bootstrap as above.

```php
echo json_encode(['asset'=>(new Computer())->find(['id'=>155]),'storage'=>(new PluginFieldsComputeragentbidx())->find(['items_id'=>155]),'history'=>iterator_to_array($DB->request(['FROM'=>Log::getTable(),'WHERE'=>['itemtype'=>'Computer','items_id'=>155],'ORDER'=>'id ASC'])),'queue'=>(new PluginAgentbdmosassetsyncChange())->find(['route_id'=>'inbound-d-20261024-main'])]);
```

Stdout:
```json
{"asset":{"155":{"id":155,"entities_id":0,"name":"ID A winner name","serial":"AGENTB-ID-MAIN","otherserial":"ID no genuine evidence","contact":"ID A winner contact","contact_num":null,"users_id_tech":0,"comment":"ID native while suspended","date_mod":"2026-10-24 16:21:47","autoupdatesystems_id":0,"locations_id":0,"networks_id":0,"computermodels_id":0,"computertypes_id":0,"is_template":0,"template_name":null,"manufacturers_id":7,"is_deleted":0,"is_dynamic":0,"users_id":0,"states_id":0,"ticket_tco":"0.0000","uuid":null,"date_creation":"2026-10-24 16:18:58","is_recursive":0,"last_inventory_update":null,"last_boot":null}},"storage":{"1":{"id":1,"items_id":155,"itemtype":"Computer","plugin_fields_containers_id":10,"entities_id":0,"idbtextfield":"ID Fields while suspended","idatextfield":"ID A Fields winner"}},"history":{"140533":{"id":140533,"itemtype":"Computer","items_id":155,"itemtype_link":"0","linked_action":20,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:18:58","id_search_option":0,"old_value":"","new_value":"","old_id":null,"new_id":null},"140551":{"id":140551,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":17,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:19:15","id_search_option":0,"old_value":"","new_value":"N\/A (1)","old_id":null,"new_id":null},"140584":{"id":140584,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":16,"old_value":"ID initial B text","new_value":"ID B older","old_id":null,"new_id":null},"140585":{"id":140585,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":1,"old_value":"AgentB ID initial A name","new_value":"ID genuine A edit for correction","old_id":null,"new_id":null},"140586":{"id":140586,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":16,"old_value":"ID B older","new_value":"ID B mixed old","old_id":null,"new_id":null},"140590":{"id":140590,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":16,"old_value":"ID B mixed old","new_value":"ID B current","old_id":null,"new_id":null},"140591":{"id":140591,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":0,"old_value":"ID Fields B initial","new_value":"ID Fields B current","old_id":null,"new_id":null},"140606":{"id":140606,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:26","id_search_option":1,"old_value":"ID genuine A edit for correction","new_value":"ID human A name snapshot","old_id":null,"new_id":null},"140607":{"id":140607,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:26","id_search_option":7,"old_value":"ID initial A contact","new_value":"ID human A contact snapshot","old_id":null,"new_id":null},"140608":{"id":140608,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:27","id_search_option":1,"old_value":"ID human A name snapshot","new_value":"ID human A name newer","old_id":null,"new_id":null},"140609":{"id":140609,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:27","id_search_option":7,"old_value":"ID human A contact snapshot","new_value":"ID human unselected newer contact","old_id":null,"new_id":null},"140610":{"id":140610,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:27","id_search_option":0,"old_value":"ID Fields A initial","new_value":"ID human Fields A edit","old_id":null,"new_id":null},"140618":{"id":140618,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:38","id_search_option":1,"old_value":"ID human A name newer","new_value":"ID A winner name","old_id":null,"new_id":null},"140619":{"id":140619,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:38","id_search_option":0,"old_value":"ID human Fields A edit","new_value":"ID A Fields winner","old_id":null,"new_id":null},"140620":{"id":140620,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:38","id_search_option":76733,"old_value":"ID human Fields A edit","new_value":"ID A Fields winner","old_id":null,"new_id":null},"140644":{"id":140644,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:21:23","id_search_option":7,"old_value":"ID human unselected newer contact","new_value":"ID A winner contact","old_id":null,"new_id":null},"140645":{"id":140645,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:21:23","id_search_option":16,"old_value":"ID B current","new_value":"ID Pending before suspend","old_id":null,"new_id":null},"140653":{"id":140653,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:21:47","id_search_option":16,"old_value":"ID Pending before suspend","new_value":"ID native while suspended","old_id":null,"new_id":null},"140654":{"id":140654,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:21:47","id_search_option":0,"old_value":"ID Fields B current","new_value":"ID Fields while suspended","old_id":null,"new_id":null}},"queue":{"17":{"id":17,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_b_text\":{\"value\":\"ID B older\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:00","date_mod":"2026-10-24 16:20:00","done_at":null},"18":{"id":18,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_a_name\":{\"value\":\"ID genuine A edit for correction\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true},\"id_b_text\":{\"value\":\"ID B mixed old\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:00","date_mod":"2026-10-24 16:20:00","done_at":null},"19":{"id":19,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_b_text\":{\"value\":\"ID B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}","status":"Done","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:00","date_mod":"2026-10-24 16:20:26","done_at":"2026-10-24 16:20:26"},"20":{"id":20,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_fields_b\":{\"value\":\"ID Fields B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}","status":"Done","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:00","date_mod":"2026-10-24 16:20:26","done_at":"2026-10-24 16:20:26"},"21":{"id":21,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBICReq20261024Asset","identity_json":"{\"a_items_id\":955101,\"b_items_id\":5,\"serial\":\"AGENTB-ID-CUSTOM\"}","changed_fields_json":"{\"id_custom_b\":{\"value\":\"ID custom B current\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:01","date_mod":"2026-10-24 16:20:01","done_at":null},"22":{"id":22,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":null,\"b_items_id\":156,\"serial\":\"AGENTB-ID-OTHER\"}","changed_fields_json":"{\"id_b_text\":{\"value\":\"ID wrong identity genuine B\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:01","date_mod":"2026-10-24 16:20:01","done_at":null},"23":{"id":23,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_a_name\":{\"value\":\"ID human A name snapshot\",\"changed_at\":\"2026-10-24T16:20:26+08:00\",\"reliable\":true},\"id_a_contact\":{\"value\":\"ID human A contact snapshot\",\"changed_at\":\"2026-10-24T16:20:26+08:00\",\"reliable\":true}}","status":"Done","retry_count":2,"error":null,"date_creation":"2026-10-24 16:20:26","date_mod":"2026-10-24 16:21:23","done_at":"2026-10-24 16:21:23"},"24":{"id":24,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_a_name\":{\"value\":\"ID human A name newer\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}","status":"Done","retry_count":1,"error":null,"date_creation":"2026-10-24 16:20:27","date_mod":"2026-10-24 16:20:38","done_at":"2026-10-24 16:20:38"},"25":{"id":25,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_a_contact\":{\"value\":\"ID human unselected newer contact\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:27","date_mod":"2026-10-24 16:20:27","done_at":null},"26":{"id":26,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_fields_a\":{\"value\":\"ID human Fields A edit\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}","status":"Done","retry_count":1,"error":null,"date_creation":"2026-10-24 16:20:27","date_mod":"2026-10-24 16:20:38","done_at":"2026-10-24 16:20:38"},"27":{"id":27,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_b_text\":{\"value\":\"ID Pending before suspend\",\"changed_at\":\"2026-10-24T16:21:23+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:21:23","date_mod":"2026-10-24 16:21:23","done_at":null},"28":{"id":28,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBICReq20261024Asset","identity_json":"{\"a_items_id\":955101,\"b_items_id\":5,\"serial\":\"AGENTB-ID-CUSTOM\"}","changed_fields_json":"{\"id_custom_b\":{\"value\":\"ID custom still active during native suspension\",\"changed_at\":\"2026-10-24T16:21:47+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:21:47","date_mod":"2026-10-24 16:21:47","done_at":null}}}
```

Stderr:
```text

```

### Local 15 — ID Resume same retained asset Active no save or value exchange

User2; exit 0. Kernel/Auth/Session/Plugin native bootstrap as above.

```php
$_SESSION['glpicronuserrunning']='ID scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=$before?iterator_to_array($DB->request(['FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC'])):[];$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Stdout:
```json
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"86":{"id":86,"work_id":"inbound-d-20261024-resume-main","status":"Accepted"}},"after":{"86":{"id":86,"work_id":"inbound-d-20261024-resume-main","route_id":"inbound-d-20261024-main","a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}","a_values_json":"{}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[]","operation":"Resume","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":955001,"b_items_id":155,"link_state":"Active","processing_started_at":"2026-10-24 16:21:48","status":"Done","result_json":"{\"b_items_id\":155,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}","error":null,"date_creation":"2026-10-24 16:21:48","date_mod":"2026-10-24 16:21:48","completed_at":"2026-10-24 16:21:48"}},"logs":{"269":{"id":269,"crontasks_id":51,"crontasklogs_id":268,"date":"2026-10-24 16:21:48","state":2,"elapsed":0.010294,"volume":1,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}
```

Stderr:
```text

```

### Local 16 — ID resumed control has no asset or queue changes

User12; exit 0. Kernel/Auth/Session/Plugin native bootstrap as above.

```php
echo json_encode(['asset'=>(new Computer())->find(['id'=>155]),'storage'=>(new PluginFieldsComputeragentbidx())->find(['items_id'=>155]),'history'=>iterator_to_array($DB->request(['FROM'=>Log::getTable(),'WHERE'=>['itemtype'=>'Computer','items_id'=>155],'ORDER'=>'id ASC'])),'queue'=>(new PluginAgentbdmosassetsyncChange())->find(['route_id'=>'inbound-d-20261024-main'])]);
```

Stdout:
```json
{"asset":{"155":{"id":155,"entities_id":0,"name":"ID A winner name","serial":"AGENTB-ID-MAIN","otherserial":"ID no genuine evidence","contact":"ID A winner contact","contact_num":null,"users_id_tech":0,"comment":"ID native while suspended","date_mod":"2026-10-24 16:21:47","autoupdatesystems_id":0,"locations_id":0,"networks_id":0,"computermodels_id":0,"computertypes_id":0,"is_template":0,"template_name":null,"manufacturers_id":7,"is_deleted":0,"is_dynamic":0,"users_id":0,"states_id":0,"ticket_tco":"0.0000","uuid":null,"date_creation":"2026-10-24 16:18:58","is_recursive":0,"last_inventory_update":null,"last_boot":null}},"storage":{"1":{"id":1,"items_id":155,"itemtype":"Computer","plugin_fields_containers_id":10,"entities_id":0,"idbtextfield":"ID Fields while suspended","idatextfield":"ID A Fields winner"}},"history":{"140533":{"id":140533,"itemtype":"Computer","items_id":155,"itemtype_link":"0","linked_action":20,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:18:58","id_search_option":0,"old_value":"","new_value":"","old_id":null,"new_id":null},"140551":{"id":140551,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":17,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:19:15","id_search_option":0,"old_value":"","new_value":"N\/A (1)","old_id":null,"new_id":null},"140584":{"id":140584,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":16,"old_value":"ID initial B text","new_value":"ID B older","old_id":null,"new_id":null},"140585":{"id":140585,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":1,"old_value":"AgentB ID initial A name","new_value":"ID genuine A edit for correction","old_id":null,"new_id":null},"140586":{"id":140586,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":16,"old_value":"ID B older","new_value":"ID B mixed old","old_id":null,"new_id":null},"140590":{"id":140590,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":16,"old_value":"ID B mixed old","new_value":"ID B current","old_id":null,"new_id":null},"140591":{"id":140591,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":0,"old_value":"ID Fields B initial","new_value":"ID Fields B current","old_id":null,"new_id":null},"140606":{"id":140606,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:26","id_search_option":1,"old_value":"ID genuine A edit for correction","new_value":"ID human A name snapshot","old_id":null,"new_id":null},"140607":{"id":140607,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:26","id_search_option":7,"old_value":"ID initial A contact","new_value":"ID human A contact snapshot","old_id":null,"new_id":null},"140608":{"id":140608,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:27","id_search_option":1,"old_value":"ID human A name snapshot","new_value":"ID human A name newer","old_id":null,"new_id":null},"140609":{"id":140609,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:27","id_search_option":7,"old_value":"ID human A contact snapshot","new_value":"ID human unselected newer contact","old_id":null,"new_id":null},"140610":{"id":140610,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:27","id_search_option":0,"old_value":"ID Fields A initial","new_value":"ID human Fields A edit","old_id":null,"new_id":null},"140618":{"id":140618,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:38","id_search_option":1,"old_value":"ID human A name newer","new_value":"ID A winner name","old_id":null,"new_id":null},"140619":{"id":140619,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:38","id_search_option":0,"old_value":"ID human Fields A edit","new_value":"ID A Fields winner","old_id":null,"new_id":null},"140620":{"id":140620,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:38","id_search_option":76733,"old_value":"ID human Fields A edit","new_value":"ID A Fields winner","old_id":null,"new_id":null},"140644":{"id":140644,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:21:23","id_search_option":7,"old_value":"ID human unselected newer contact","new_value":"ID A winner contact","old_id":null,"new_id":null},"140645":{"id":140645,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:21:23","id_search_option":16,"old_value":"ID B current","new_value":"ID Pending before suspend","old_id":null,"new_id":null},"140653":{"id":140653,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:21:47","id_search_option":16,"old_value":"ID Pending before suspend","new_value":"ID native while suspended","old_id":null,"new_id":null},"140654":{"id":140654,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:21:47","id_search_option":0,"old_value":"ID Fields B current","new_value":"ID Fields while suspended","old_id":null,"new_id":null}},"queue":{"17":{"id":17,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_b_text\":{\"value\":\"ID B older\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:00","date_mod":"2026-10-24 16:20:00","done_at":null},"18":{"id":18,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_a_name\":{\"value\":\"ID genuine A edit for correction\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true},\"id_b_text\":{\"value\":\"ID B mixed old\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:00","date_mod":"2026-10-24 16:20:00","done_at":null},"19":{"id":19,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_b_text\":{\"value\":\"ID B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}","status":"Done","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:00","date_mod":"2026-10-24 16:20:26","done_at":"2026-10-24 16:20:26"},"20":{"id":20,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_fields_b\":{\"value\":\"ID Fields B current\",\"changed_at\":\"2026-10-24T16:20:00+08:00\",\"reliable\":true}}","status":"Done","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:00","date_mod":"2026-10-24 16:20:26","done_at":"2026-10-24 16:20:26"},"21":{"id":21,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBICReq20261024Asset","identity_json":"{\"a_items_id\":955101,\"b_items_id\":5,\"serial\":\"AGENTB-ID-CUSTOM\"}","changed_fields_json":"{\"id_custom_b\":{\"value\":\"ID custom B current\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:01","date_mod":"2026-10-24 16:20:01","done_at":null},"22":{"id":22,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":null,\"b_items_id\":156,\"serial\":\"AGENTB-ID-OTHER\"}","changed_fields_json":"{\"id_b_text\":{\"value\":\"ID wrong identity genuine B\",\"changed_at\":\"2026-10-24T16:20:01+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:01","date_mod":"2026-10-24 16:20:01","done_at":null},"23":{"id":23,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_a_name\":{\"value\":\"ID human A name snapshot\",\"changed_at\":\"2026-10-24T16:20:26+08:00\",\"reliable\":true},\"id_a_contact\":{\"value\":\"ID human A contact snapshot\",\"changed_at\":\"2026-10-24T16:20:26+08:00\",\"reliable\":true}}","status":"Done","retry_count":2,"error":null,"date_creation":"2026-10-24 16:20:26","date_mod":"2026-10-24 16:21:23","done_at":"2026-10-24 16:21:23"},"24":{"id":24,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_a_name\":{\"value\":\"ID human A name newer\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}","status":"Done","retry_count":1,"error":null,"date_creation":"2026-10-24 16:20:27","date_mod":"2026-10-24 16:20:38","done_at":"2026-10-24 16:20:38"},"25":{"id":25,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_a_contact\":{\"value\":\"ID human unselected newer contact\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:20:27","date_mod":"2026-10-24 16:20:27","done_at":null},"26":{"id":26,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_fields_a\":{\"value\":\"ID human Fields A edit\",\"changed_at\":\"2026-10-24T16:20:27+08:00\",\"reliable\":true}}","status":"Done","retry_count":1,"error":null,"date_creation":"2026-10-24 16:20:27","date_mod":"2026-10-24 16:20:38","done_at":"2026-10-24 16:20:38"},"27":{"id":27,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":155,\"serial\":\"AGENTB-ID-MAIN\"}","changed_fields_json":"{\"id_b_text\":{\"value\":\"ID Pending before suspend\",\"changed_at\":\"2026-10-24T16:21:23+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:21:23","date_mod":"2026-10-24 16:21:23","done_at":null},"28":{"id":28,"route_id":"inbound-d-20261024-main","settings_version":1,"a_entities_id":9500,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBICReq20261024Asset","identity_json":"{\"a_items_id\":955101,\"b_items_id\":5,\"serial\":\"AGENTB-ID-CUSTOM\"}","changed_fields_json":"{\"id_custom_b\":{\"value\":\"ID custom still active during native suspension\",\"changed_at\":\"2026-10-24T16:21:47+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:21:47","date_mod":"2026-10-24 16:21:47","done_at":null}}}
```

Stderr:
```text

```

### Local 17 — ID ordinary Sync after Resume remains Active

User2; exit 0. Kernel/Auth/Session/Plugin native bootstrap as above.

```php
$_SESSION['glpicronuserrunning']='ID scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=$before?iterator_to_array($DB->request(['FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC'])):[];$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Stdout:
```json
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"87":{"id":87,"work_id":"inbound-d-20261024-sync-after-resume","status":"Accepted"}},"after":{"87":{"id":87,"work_id":"inbound-d-20261024-sync-after-resume","route_id":"inbound-d-20261024-main","a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}","a_values_json":"{}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":955001,"b_items_id":155,"link_state":"Active","processing_started_at":"2026-10-24 16:21:48","status":"Done","result_json":"{\"b_items_id\":155,\"created_b_items_id\":null,\"b_values_for_a\":{\"id_b_text\":{\"value\":\"ID native while suspended\",\"changed_at\":null,\"reliable\":false},\"id_b_option\":{\"value\":\"AgentB IC Maker\",\"changed_at\":null,\"reliable\":false},\"id_b_no_evidence\":{\"value\":\"ID no genuine evidence\",\"changed_at\":null,\"reliable\":false},\"id_fields_b\":{\"value\":\"ID Fields while suspended\",\"changed_at\":null,\"reliable\":false}},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"id_a_name\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"id_a_contact\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"id_b_text\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_b_option\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_b_no_evidence\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_fields_b\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_fields_a\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"}]}","error":null,"date_creation":"2026-10-24 16:21:48","date_mod":"2026-10-24 16:21:48","completed_at":"2026-10-24 16:21:48"}},"logs":{"271":{"id":271,"crontasks_id":51,"crontasklogs_id":270,"date":"2026-10-24 16:21:48","state":2,"elapsed":0.0493591,"volume":1,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}
```

Stderr:
```text

```

### Local 18 — ID stale control cannot suspend and Both remains explicit stage Hold

User2; exit 0. Kernel/Auth/Session/Plugin native bootstrap as above.

```php
$_SESSION['glpicronuserrunning']='ID scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=$before?iterator_to_array($DB->request(['FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC'])):[];$logs=iterator_to_array($DB->request(['FROM'=>CronTaskLog::getTable(),'WHERE'=>['crontasks_id'=>51],'ORDER'=>'id DESC','LIMIT'=>1]));$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','logs','contextAfter')+['task_state'=>$t->fields['state']]);
```

Stdout:
```json
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"88":{"id":88,"work_id":"inbound-d-20261024-stale-suspend","status":"Accepted"},"89":{"id":89,"work_id":"inbound-d-20261024-both-stage-boundary","status":"Accepted"}},"after":{"88":{"id":88,"work_id":"inbound-d-20261024-stale-suspend","route_id":"inbound-d-20261024-main","a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}","a_values_json":"{}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[]","operation":"Suspend","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":955001,"b_items_id":null,"link_state":null,"processing_started_at":"2026-10-24 16:22:37","status":"Held","result_json":"{\"b_items_id\":null,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[]}","error":"Settings or route\/entity mismatch, disabled route, or route unavailable","date_creation":"2026-10-24 16:22:37","date_mod":"2026-10-24 16:22:37","completed_at":null},"89":{"id":89,"work_id":"inbound-d-20261024-both-stage-boundary","route_id":"inbound-d-20261024-main","a_entities_id":9500,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":955001,\"b_items_id\":null,\"serial\":\"AGENTB-ID-MAIN\"}","a_values_json":"{\"id_both_stage\":\"MUST NOT SELECT WINNER YET\"}","a_change_times_json":"{\"id_both_stage\":{\"changed_at\":\"2026-10-24T16:00:00+08:00\",\"reliable\":true}}","settings_version":2,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":955001,"b_items_id":155,"link_state":"Active","processing_started_at":"2026-10-24 16:22:37","status":"Held","result_json":"{\"b_items_id\":155,\"created_b_items_id\":null,\"b_values_for_a\":{\"id_b_text\":{\"value\":\"ID native genuine after Resume\",\"changed_at\":null,\"reliable\":false},\"id_b_option\":{\"value\":\"AgentB IC Maker\",\"changed_at\":null,\"reliable\":false},\"id_b_no_evidence\":{\"value\":\"ID no genuine evidence\",\"changed_at\":null,\"reliable\":false},\"id_fields_b\":{\"value\":\"ID Fields genuine after Resume\",\"changed_at\":null,\"reliable\":false}},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"id_a_name\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"id_a_contact\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"id_b_text\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_b_option\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_b_no_evidence\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_fields_b\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"id_fields_a\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"},{\"mapping_id\":\"id_both_stage\",\"outcome\":\"Skipped\",\"reason\":\"Both conflict processing is not installed yet\"}]}","error":"Both conflict processing is not installed yet","date_creation":"2026-10-24 16:22:37","date_mod":"2026-10-24 16:22:37","completed_at":null}},"logs":{"273":{"id":273,"crontasks_id":51,"crontasklogs_id":272,"date":"2026-10-24 16:22:37","state":2,"elapsed":0.072778,"volume":2,"content":"Action completed, fully processed"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1}
```

Stderr:
```text

```

### Local 19 — ID final assets storage History permissions no-create and worker scope inventory

User12; exit 0. Kernel/Auth/Session/Plugin native bootstrap as above.

```php
$type='Glpi\\CustomAsset\\AgentBICReq20261024Asset';echo json_encode(['native'=>(new Computer())->find(['id'=>[155,156]]),'storage'=>(new PluginFieldsComputeragentbidx())->find(['items_id'=>155]),'custom'=>(new $type())->find(['id'=>5]),'nativeHistory'=>iterator_to_array($DB->request(['FROM'=>Log::getTable(),'WHERE'=>['itemtype'=>'Computer','items_id'=>155],'ORDER'=>'id ASC'])),'noLinkSerialCount'=>countElementsInTable(Computer::getTable(),['serial'=>'AGENTB-ID-NO-LINK']),'queueCount'=>countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[]),'computerRights'=>(new ProfileRight())->find(['profiles_id'=>14,'name'=>'computer']),'fieldsRights'=>(new PluginFieldsProfile())->find(['plugin_fields_containers_id'=>10]),'acceptedCount'=>countElementsInTable(PluginAgentbdmosassetsyncWork::getTable(),['status'=>'Accepted'])]);
```

Stdout:
```json
{"native":{"155":{"id":155,"entities_id":0,"name":"ID A winner name","serial":"AGENTB-ID-MAIN","otherserial":"ID no genuine evidence","contact":"ID A winner contact","contact_num":null,"users_id_tech":0,"comment":"ID native genuine after Resume","date_mod":"2026-10-24 16:21:48","autoupdatesystems_id":0,"locations_id":0,"networks_id":0,"computermodels_id":0,"computertypes_id":0,"is_template":0,"template_name":null,"manufacturers_id":7,"is_deleted":0,"is_dynamic":0,"users_id":0,"states_id":0,"ticket_tco":"0.0000","uuid":null,"date_creation":"2026-10-24 16:18:58","is_recursive":0,"last_inventory_update":null,"last_boot":null},"156":{"id":156,"entities_id":0,"name":"AgentB ID other initial","serial":"AGENTB-ID-OTHER","otherserial":null,"contact":null,"contact_num":null,"users_id_tech":0,"comment":"ID wrong identity genuine B","date_mod":"2026-10-24 16:20:01","autoupdatesystems_id":0,"locations_id":0,"networks_id":0,"computermodels_id":0,"computertypes_id":0,"is_template":0,"template_name":null,"manufacturers_id":0,"is_deleted":0,"is_dynamic":0,"users_id":0,"states_id":0,"ticket_tco":"0.0000","uuid":null,"date_creation":"2026-10-24 16:18:58","is_recursive":0,"last_inventory_update":null,"last_boot":null}},"storage":{"1":{"id":1,"items_id":155,"itemtype":"Computer","plugin_fields_containers_id":10,"entities_id":0,"idbtextfield":"ID Fields genuine after Resume","idatextfield":"ID A Fields winner"}},"custom":{"5":{"id":5,"assets_assetdefinitions_id":3,"assets_assetmodels_id":0,"assets_assettypes_id":0,"name":"AgentB ID fresh custom","uuid":null,"comment":null,"serial":"AGENTB-ID-CUSTOM","otherserial":null,"contact":null,"contact_num":null,"users_id":0,"users_id_tech":0,"locations_id":0,"manufacturers_id":0,"states_id":0,"entities_id":0,"is_recursive":0,"is_deleted":0,"is_template":0,"is_dynamic":0,"template_name":null,"autoupdatesystems_id":0,"date_creation":"2026-10-24 16:19:15","date_mod":"2026-10-24 16:21:47","last_inventory_update":null,"custom_fields":"{\"14\": \"ID custom still active during native suspension\", \"16\": 7}"}},"nativeHistory":{"140533":{"id":140533,"itemtype":"Computer","items_id":155,"itemtype_link":"0","linked_action":20,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:18:58","id_search_option":0,"old_value":"","new_value":"","old_id":null,"new_id":null},"140551":{"id":140551,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":17,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:19:15","id_search_option":0,"old_value":"","new_value":"N\/A (1)","old_id":null,"new_id":null},"140584":{"id":140584,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":16,"old_value":"ID initial B text","new_value":"ID B older","old_id":null,"new_id":null},"140585":{"id":140585,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":1,"old_value":"AgentB ID initial A name","new_value":"ID genuine A edit for correction","old_id":null,"new_id":null},"140586":{"id":140586,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":16,"old_value":"ID B older","new_value":"ID B mixed old","old_id":null,"new_id":null},"140590":{"id":140590,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":16,"old_value":"ID B mixed old","new_value":"ID B current","old_id":null,"new_id":null},"140591":{"id":140591,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:00","id_search_option":0,"old_value":"ID Fields B initial","new_value":"ID Fields B current","old_id":null,"new_id":null},"140606":{"id":140606,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:26","id_search_option":1,"old_value":"ID genuine A edit for correction","new_value":"ID human A name snapshot","old_id":null,"new_id":null},"140607":{"id":140607,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:26","id_search_option":7,"old_value":"ID initial A contact","new_value":"ID human A contact snapshot","old_id":null,"new_id":null},"140608":{"id":140608,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:27","id_search_option":1,"old_value":"ID human A name snapshot","new_value":"ID human A name newer","old_id":null,"new_id":null},"140609":{"id":140609,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:27","id_search_option":7,"old_value":"ID human A contact snapshot","new_value":"ID human unselected newer contact","old_id":null,"new_id":null},"140610":{"id":140610,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:27","id_search_option":0,"old_value":"ID Fields A initial","new_value":"ID human Fields A edit","old_id":null,"new_id":null},"140618":{"id":140618,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:38","id_search_option":1,"old_value":"ID human A name newer","new_value":"ID A winner name","old_id":null,"new_id":null},"140619":{"id":140619,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:38","id_search_option":0,"old_value":"ID human Fields A edit","new_value":"ID A Fields winner","old_id":null,"new_id":null},"140620":{"id":140620,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:20:38","id_search_option":76733,"old_value":"ID human Fields A edit","new_value":"ID A Fields winner","old_id":null,"new_id":null},"140644":{"id":140644,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:21:23","id_search_option":7,"old_value":"ID human unselected newer contact","new_value":"ID A winner contact","old_id":null,"new_id":null},"140645":{"id":140645,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:21:23","id_search_option":16,"old_value":"ID B current","new_value":"ID Pending before suspend","old_id":null,"new_id":null},"140653":{"id":140653,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:21:47","id_search_option":16,"old_value":"ID Pending before suspend","new_value":"ID native while suspended","old_id":null,"new_id":null},"140654":{"id":140654,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:21:47","id_search_option":0,"old_value":"ID Fields B current","new_value":"ID Fields while suspended","old_id":null,"new_id":null},"140655":{"id":140655,"itemtype":"Computer","items_id":155,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:21:48","id_search_option":16,"old_value":"ID native while suspended","new_value":"ID native genuine after Resume","old_id":null,"new_id":null},"140656":{"id":140656,"itemtype":"Computer","items_id":155,"itemtype_link":"PluginFieldsComputeragentbidx","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:21:48","id_search_option":0,"old_value":"ID Fields while suspended","new_value":"ID Fields genuine after Resume","old_id":null,"new_id":null}},"noLinkSerialCount":0,"queueCount":30,"computerRights":{"1354":{"id":1354,"profiles_id":14,"name":"computer","rights":7}},"fieldsRights":{"110":{"id":110,"profiles_id":1,"plugin_fields_containers_id":10,"right":"0"},"111":{"id":111,"profiles_id":2,"plugin_fields_containers_id":10,"right":"0"},"112":{"id":112,"profiles_id":3,"plugin_fields_containers_id":10,"right":"0"},"113":{"id":113,"profiles_id":4,"plugin_fields_containers_id":10,"right":"0"},"114":{"id":114,"profiles_id":5,"plugin_fields_containers_id":10,"right":"0"},"115":{"id":115,"profiles_id":6,"plugin_fields_containers_id":10,"right":"0"},"116":{"id":116,"profiles_id":7,"plugin_fields_containers_id":10,"right":"0"},"117":{"id":117,"profiles_id":8,"plugin_fields_containers_id":10,"right":"0"},"118":{"id":118,"profiles_id":9,"plugin_fields_containers_id":10,"right":"0"},"119":{"id":119,"profiles_id":10,"plugin_fields_containers_id":10,"right":"0"},"120":{"id":120,"profiles_id":11,"plugin_fields_containers_id":10,"right":"0"},"121":{"id":121,"profiles_id":12,"plugin_fields_containers_id":10,"right":"0"},"122":{"id":122,"profiles_id":13,"plugin_fields_containers_id":10,"right":"0"},"123":{"id":123,"profiles_id":14,"plugin_fields_containers_id":10,"right":"4"},"124":{"id":124,"profiles_id":15,"plugin_fields_containers_id":10,"right":"0"}},"acceptedCount":0}
```

Stderr:
```text

```
