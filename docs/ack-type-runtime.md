# Agent B acknowledgement concrete-type runtime

2026-10-24 Asia/Brunei. GLPI11.0.7. Isolated source-approved deployment: only inc/change.class.php from agentb-ack-type-fix, after IC completed. **7 manual curls +2 read-only native PHP calls**, no failures/retries. Account user12/profile14/entity0. No asset/Setting/permission mutation, no fabricated Change identities, no raw DML/delete/purge. Session closed call7.

| Matrix | Result | Evidence |
|---|---|---|
| AT01 | PASS | Real IC definitions3/4 share glpi_assets_assets. Exact qualified ID + actual getSystemSQLCriteria(table): requested type finds ID4, rejects ID3; other type finds ID3, rejects ID4. Native read-only calls1/2. |
| AT02 | PASS | Existing genuinely captured Pending Change12, Glpi\CustomAsset\AgentBOC20261024Asset, B1/definition1. Simulated A fully handles original snapshot then PUT exact12 id/statusDone returns HTTP200 [{"12":true,"message":""}]. GET Done with original identity/payload/creation/evidence times unchanged; only status,date_mod,done_at changed. Pending13 and every other unselected Pending unchanged. Assets unchanged; queried custom History rows empty both times, so no positive custom History population claim. Queue count16 unchanged. |
| AT03 | NOT RUN / source only | No safe naturally wrong-concrete genuine snapshot exists. No external invalid acknowledgement attempted; criteria proof is not counted as invalid HTTP-path proof. Source rejects asset_identity before link checks; not runtime asserted. |

Reconciled exact comparisons:

```json
{
  "changedSelectedFields": [
    "status",
    "date_mod",
    "done_at"
  ],
  "selectedAssetUnchanged": true,
  "sharedAssetsUnchanged": true,
  "queriedHistoryUnchanged": true,
  "unselectedPendingUnchanged": true,
  "siblingUnchanged": true,
  "queueCountBefore": 16,
  "queueCountAfter": 16
}
```

Every curl used Accept/Content-Type application/json, App-Token redacted. initSession Authorization:user_token redacted; remaining requests Session-Token redacted. Native bootstrap vendor/autoload → Kernel boot → Auth user12 → Session::init → Plugin::init, then exact source below.

## Complete curl ledger

### Curl 1 — AT restricted session

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

### Curl 2 — AT genuine custom Pending12 before exact acknowledgement

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/12?get_hateoas=false

Account user12/profile14/entity0; HTTP 200

Body:
```json
null
```

Response:
```json
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
}
```

### Curl 3 — AT unselected genuine custom Pending13 baseline

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/13?get_hateoas=false

Account user12/profile14/entity0; HTTP 200

Body:
```json
null
```

Response:
```json
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
}
```

### Curl 4 — AT fully handled exact genuine Pending12 acknowledgement

PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/12

Account user12/profile14/entity0; HTTP 200

Body:
```json
{
  "input": {
    "id": 12,
    "status": "Done"
  }
}
```

Response:
```json
[
  {
    "12": true,
    "message": ""
  }
]
```

### Curl 5 — AT selected row final Done and immutable payload

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/12?get_hateoas=false

Account user12/profile14/entity0; HTTP 200

Body:
```json
null
```

Response:
```json
{
  "id": 12,
  "route_id": "outbound-a-20261024-main",
  "settings_version": 4,
  "a_entities_id": 9100,
  "entities_id": 0,
  "itemtype": "Glpi\\CustomAsset\\AgentBOC20261024Asset",
  "identity_json": "{\"a_items_id\":null,\"b_items_id\":1,\"serial\":\"AGENTB-OC-CUSTOM\"}",
  "changed_fields_json": "{\"virtual_oc_text\":{\"value\":\"OC09 after fix text\",\"changed_at\":\"2026-10-24T15:16:50+08:00\",\"reliable\":true},\"virtual_oc_other\":{\"value\":\"OC09 sibling changed once\",\"changed_at\":\"2026-10-24T15:16:50+08:00\",\"reliable\":true},\"virtual_oc_datetime\":{\"value\":\"2026-10-26 14:15:16\",\"changed_at\":\"2026-10-24T15:16:50+08:00\",\"reliable\":true},\"virtual_oc_option\":{\"value\":\"AgentB OC Manufacturer Two\",\"changed_at\":\"2026-10-24T15:16:50+08:00\",\"reliable\":true}}",
  "status": "Done",
  "retry_count": 0,
  "error": null,
  "date_creation": "2026-10-24 15:16:50",
  "date_mod": "2026-10-24 16:03:00",
  "done_at": "2026-10-24 16:03:00"
}
```

### Curl 6 — AT unselected Pending13 unchanged

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/13?get_hateoas=false

Account user12/profile14/entity0; HTTP 200

Body:
```json
null
```

Response:
```json
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
}
```

### Curl 7 — AT close created session

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

## Native read-only ledger

### Local 1 — AT actual two-definition exact criteria and asset/history baseline

User12; exit 0

```php
$type='Glpi\\CustomAsset\\AgentBICReq20261024Asset';$other='Glpi\\CustomAsset\\AgentBICOther20261024Asset'; $proof=[];foreach([[$type,4],[$type,3],[$other,3],[$other,4]]as[$cl,$id]){$a=new $cl();$criteria=[$cl::getTable().'.'.$cl::getIndexName()=>$id]+$cl::getSystemSQLCriteria($cl::getTable());$ok=$a->getFromDBByCrit($criteria);$proof[]=['type'=>$cl,'table'=>$cl::getTable(),'id'=>$id,'criteria'=>$criteria,'found'=>$ok,'definition'=>$ok?$a->fields['assets_assetdefinitions_id']:null];}$oc='Glpi\\CustomAsset\\AgentBOC20261024Asset';$a=new $oc();$a->getFromDB(1); echo json_encode(['criteriaProof'=>$proof,'selectedAsset'=>$a->fields,'sharedCustomAssets'=>iterator_to_array($DB->request(['FROM'=>$type::getTable(),'ORDER'=>'id ASC'])),'assetHistory'=>iterator_to_array($DB->request(['FROM'=>Log::getTable(),'WHERE'=>['itemtype'=>[$oc,'Glpi\\Asset\\Asset',$type,$other]],'ORDER'=>'id ASC'])),'pending'=>(new PluginAgentbdmosassetsyncChange())->find(['status'=>'Pending']),'queueCount'=>countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[])]);
```

Stdout:
```json
{"criteriaProof":[{"type":"Glpi\\CustomAsset\\AgentBICReq20261024Asset","table":"glpi_assets_assets","id":4,"criteria":{"glpi_assets_assets.id":4,"1567796397":{"glpi_assets_assets.assets_assetdefinitions_id":3}},"found":true,"definition":3},{"type":"Glpi\\CustomAsset\\AgentBICReq20261024Asset","table":"glpi_assets_assets","id":3,"criteria":{"glpi_assets_assets.id":3,"1567796397":{"glpi_assets_assets.assets_assetdefinitions_id":3}},"found":false,"definition":null},{"type":"Glpi\\CustomAsset\\AgentBICOther20261024Asset","table":"glpi_assets_assets","id":3,"criteria":{"glpi_assets_assets.id":3,"1480440360":{"glpi_assets_assets.assets_assetdefinitions_id":4}},"found":true,"definition":4},{"type":"Glpi\\CustomAsset\\AgentBICOther20261024Asset","table":"glpi_assets_assets","id":4,"criteria":{"glpi_assets_assets.id":4,"1480440360":{"glpi_assets_assets.assets_assetdefinitions_id":4}},"found":false,"definition":null}],"selectedAsset":{"id":1,"assets_assetdefinitions_id":1,"assets_assetmodels_id":0,"assets_assettypes_id":0,"name":"AgentB OC custom core after fix","uuid":null,"comment":null,"serial":"AGENTB-OC-CUSTOM","otherserial":null,"contact":null,"contact_num":null,"users_id":0,"users_id_tech":0,"locations_id":0,"manufacturers_id":0,"states_id":0,"entities_id":0,"is_recursive":0,"is_deleted":0,"is_template":0,"is_dynamic":0,"template_name":null,"autoupdatesystems_id":0,"date_creation":"2026-10-24 15:13:02","date_mod":"2026-10-24 15:17:25","last_inventory_update":null,"custom_fields":"{\"1\": \"OC09 only text changes now\", \"2\": \"OC09 sibling changed once\", \"3\": \"2026-10-25\", \"4\": \"2026-10-26 06:15:16\", \"5\": 2}","groups_id":[],"groups_id_tech":[],"custom_oc_date":"2026-10-25","custom_oc_datetime":"2026-10-26 14:15:16","custom_oc_option":2,"custom_oc_other":"OC09 sibling changed once","custom_oc_text":"OC09 only text changes now"},"sharedCustomAssets":{"1":{"id":1,"assets_assetdefinitions_id":1,"assets_assetmodels_id":0,"assets_assettypes_id":0,"name":"AgentB OC custom core after fix","uuid":null,"comment":null,"serial":"AGENTB-OC-CUSTOM","otherserial":null,"contact":null,"contact_num":null,"users_id":0,"users_id_tech":0,"locations_id":0,"manufacturers_id":0,"states_id":0,"entities_id":0,"is_recursive":0,"is_deleted":0,"is_template":0,"is_dynamic":0,"template_name":null,"autoupdatesystems_id":0,"date_creation":"2026-10-24 15:13:02","date_mod":"2026-10-24 15:17:25","last_inventory_update":null,"custom_fields":"{\"1\": \"OC09 only text changes now\", \"2\": \"OC09 sibling changed once\", \"3\": \"2026-10-25\", \"4\": \"2026-10-26 06:15:16\", \"5\": 2}"},"2":{"id":2,"assets_assetdefinitions_id":2,"assets_assetmodels_id":0,"assets_assettypes_id":0,"name":"AgentB IB custom processed","uuid":null,"comment":null,"serial":"AGENTB-IB-CUSTOM","otherserial":null,"contact":null,"contact_num":null,"users_id":0,"users_id_tech":0,"locations_id":0,"manufacturers_id":0,"states_id":0,"entities_id":0,"is_recursive":0,"is_deleted":0,"is_template":0,"is_dynamic":0,"template_name":null,"autoupdatesystems_id":0,"date_creation":"2026-10-24 15:29:45","date_mod":"2026-10-24 15:33:13","last_inventory_update":null,"custom_fields":"{\"6\": \"IB custom worker text\", \"7\": \"12\", \"8\": true, \"9\": \"2026-10-26\", \"10\": \"2026-10-26 06:15:16\", \"11\": 6, \"12\": \"IB sibling must stay\"}"},"3":{"id":3,"assets_assetdefinitions_id":4,"assets_assetmodels_id":0,"assets_assettypes_id":0,"name":"AgentB IC other definition must stay","uuid":null,"comment":null,"serial":"AGENTB-IC-SHARED","otherserial":null,"contact":null,"contact_num":null,"users_id":0,"users_id_tech":0,"locations_id":0,"manufacturers_id":0,"states_id":0,"entities_id":0,"is_recursive":0,"is_deleted":0,"is_template":0,"is_dynamic":0,"template_name":null,"autoupdatesystems_id":0,"date_creation":"2026-10-24 15:54:53","date_mod":"2026-10-24 15:54:53","last_inventory_update":null,"custom_fields":"[]"},"4":{"id":4,"assets_assetdefinitions_id":3,"assets_assetmodels_id":0,"assets_assettypes_id":0,"name":"AgentB IC requested concrete first copy","uuid":null,"comment":null,"serial":"AGENTB-IC-SHARED","otherserial":null,"contact":null,"contact_num":null,"users_id":0,"users_id_tech":0,"locations_id":0,"manufacturers_id":0,"states_id":0,"entities_id":0,"is_recursive":0,"is_deleted":0,"is_template":0,"is_dynamic":0,"template_name":null,"autoupdatesystems_id":0,"date_creation":"2026-10-24 15:55:41","date_mod":"2026-10-24 15:55:41","last_inventory_update":null,"custom_fields":"{\"13\": \"IC A source seed\", \"14\": \"IC B source seed\", \"15\": \"IC Both source seed\", \"16\": 7, \"17\": \"2026-10-24 09:18:19\"}"}},"assetHistory":[],"pending":{"10":{"id":10,"route_id":"outbound-a-20261024-main","settings_version":4,"a_entities_id":9100,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":null,\"b_items_id\":145,\"serial\":\"AGENTB-OC-MAIN\"}","changed_fields_json":"{\"native_name\":{\"value\":\"AgentB OC two route save\",\"changed_at\":\"2026-10-24T15:16:39+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 15:16:39","date_mod":"2026-10-24 15:16:39","done_at":null},"11":{"id":11,"route_id":"outbound-a-20261024-second-route","settings_version":1,"a_entities_id":9101,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":null,\"b_items_id\":145,\"serial\":\"AGENTB-OC-MAIN\"}","changed_fields_json":"{\"second_name\":{\"value\":\"AgentB OC two route save\",\"changed_at\":\"2026-10-24T15:16:39+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 15:16:39","date_mod":"2026-10-24 15:16:39","done_at":null},"12":{"id":12,"route_id":"outbound-a-20261024-main","settings_version":4,"a_entities_id":9100,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBOC20261024Asset","identity_json":"{\"a_items_id\":null,\"b_items_id\":1,\"serial\":\"AGENTB-OC-CUSTOM\"}","changed_fields_json":"{\"virtual_oc_text\":{\"value\":\"OC09 after fix text\",\"changed_at\":\"2026-10-24T15:16:50+08:00\",\"reliable\":true},\"virtual_oc_other\":{\"value\":\"OC09 sibling changed once\",\"changed_at\":\"2026-10-24T15:16:50+08:00\",\"reliable\":true},\"virtual_oc_datetime\":{\"value\":\"2026-10-26 14:15:16\",\"changed_at\":\"2026-10-24T15:16:50+08:00\",\"reliable\":true},\"virtual_oc_option\":{\"value\":\"AgentB OC Manufacturer Two\",\"changed_at\":\"2026-10-24T15:16:50+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 15:16:50","date_mod":"2026-10-24 15:16:50","done_at":null},"13":{"id":13,"route_id":"outbound-a-20261024-main","settings_version":5,"a_entities_id":9100,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBOC20261024Asset","identity_json":"{\"a_items_id\":null,\"b_items_id\":1,\"serial\":\"AGENTB-OC-CUSTOM\"}","changed_fields_json":"{\"virtual_oc_text\":{\"value\":\"OC09 only text changes now\",\"changed_at\":\"2026-10-24T15:17:25+08:00\",\"reliable\":true},\"custom_native_name\":{\"value\":\"AgentB OC custom core after fix\",\"changed_at\":\"2026-10-24T15:17:25+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 15:17:25","date_mod":"2026-10-24 15:17:25","done_at":null},"15":{"id":15,"route_id":"outbound-b-20261024-history","settings_version":1,"a_entities_id":9300,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":null,\"b_items_id\":152,\"serial\":\"AGENTB-OB-HISTORY\"}","changed_fields_json":"{\"ob_name\":{\"value\":\"AgentB OB history genuine edit\",\"changed_at\":\"2026-10-24T15:39:55+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 15:39:55","date_mod":"2026-10-24 15:39:55","done_at":null},"16":{"id":16,"route_id":"inbound-c-20261024-main","settings_version":1,"a_entities_id":9400,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":944001,\"b_items_id\":153,\"serial\":\"AGENTB-IC-NATIVE-CHANGED\"}","changed_fields_json":"{\"ic_name\":{\"value\":\"AgentB IC genuine after creation\",\"changed_at\":\"2026-10-24T15:57:19+08:00\",\"reliable\":true},\"ic_serial\":{\"value\":\"AGENTB-IC-NATIVE-CHANGED\",\"changed_at\":\"2026-10-24T15:57:19+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 15:57:19","date_mod":"2026-10-24 15:57:19","done_at":null}},"queueCount":16}
```

Stderr:
```text

```

### Local 2 — AT unchanged assets History unselected Pending and queue

User12; exit 0

```php
$type='Glpi\\CustomAsset\\AgentBICReq20261024Asset';$other='Glpi\\CustomAsset\\AgentBICOther20261024Asset'; $proof=[];foreach([[$type,4],[$type,3],[$other,3],[$other,4]]as[$cl,$id]){$a=new $cl();$criteria=[$cl::getTable().'.'.$cl::getIndexName()=>$id]+$cl::getSystemSQLCriteria($cl::getTable());$ok=$a->getFromDBByCrit($criteria);$proof[]=['type'=>$cl,'table'=>$cl::getTable(),'id'=>$id,'criteria'=>$criteria,'found'=>$ok,'definition'=>$ok?$a->fields['assets_assetdefinitions_id']:null];}$oc='Glpi\\CustomAsset\\AgentBOC20261024Asset';$a=new $oc();$a->getFromDB(1); echo json_encode(['criteriaProof'=>$proof,'selectedAsset'=>$a->fields,'sharedCustomAssets'=>iterator_to_array($DB->request(['FROM'=>$type::getTable(),'ORDER'=>'id ASC'])),'assetHistory'=>iterator_to_array($DB->request(['FROM'=>Log::getTable(),'WHERE'=>['itemtype'=>[$oc,'Glpi\\Asset\\Asset',$type,$other]],'ORDER'=>'id ASC'])),'pending'=>(new PluginAgentbdmosassetsyncChange())->find(['status'=>'Pending']),'queueCount'=>countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[])]);
```

Stdout:
```json
{"criteriaProof":[{"type":"Glpi\\CustomAsset\\AgentBICReq20261024Asset","table":"glpi_assets_assets","id":4,"criteria":{"glpi_assets_assets.id":4,"1567796397":{"glpi_assets_assets.assets_assetdefinitions_id":3}},"found":true,"definition":3},{"type":"Glpi\\CustomAsset\\AgentBICReq20261024Asset","table":"glpi_assets_assets","id":3,"criteria":{"glpi_assets_assets.id":3,"1567796397":{"glpi_assets_assets.assets_assetdefinitions_id":3}},"found":false,"definition":null},{"type":"Glpi\\CustomAsset\\AgentBICOther20261024Asset","table":"glpi_assets_assets","id":3,"criteria":{"glpi_assets_assets.id":3,"1480440360":{"glpi_assets_assets.assets_assetdefinitions_id":4}},"found":true,"definition":4},{"type":"Glpi\\CustomAsset\\AgentBICOther20261024Asset","table":"glpi_assets_assets","id":4,"criteria":{"glpi_assets_assets.id":4,"1480440360":{"glpi_assets_assets.assets_assetdefinitions_id":4}},"found":false,"definition":null}],"selectedAsset":{"id":1,"assets_assetdefinitions_id":1,"assets_assetmodels_id":0,"assets_assettypes_id":0,"name":"AgentB OC custom core after fix","uuid":null,"comment":null,"serial":"AGENTB-OC-CUSTOM","otherserial":null,"contact":null,"contact_num":null,"users_id":0,"users_id_tech":0,"locations_id":0,"manufacturers_id":0,"states_id":0,"entities_id":0,"is_recursive":0,"is_deleted":0,"is_template":0,"is_dynamic":0,"template_name":null,"autoupdatesystems_id":0,"date_creation":"2026-10-24 15:13:02","date_mod":"2026-10-24 15:17:25","last_inventory_update":null,"custom_fields":"{\"1\": \"OC09 only text changes now\", \"2\": \"OC09 sibling changed once\", \"3\": \"2026-10-25\", \"4\": \"2026-10-26 06:15:16\", \"5\": 2}","groups_id":[],"groups_id_tech":[],"custom_oc_date":"2026-10-25","custom_oc_datetime":"2026-10-26 14:15:16","custom_oc_option":2,"custom_oc_other":"OC09 sibling changed once","custom_oc_text":"OC09 only text changes now"},"sharedCustomAssets":{"1":{"id":1,"assets_assetdefinitions_id":1,"assets_assetmodels_id":0,"assets_assettypes_id":0,"name":"AgentB OC custom core after fix","uuid":null,"comment":null,"serial":"AGENTB-OC-CUSTOM","otherserial":null,"contact":null,"contact_num":null,"users_id":0,"users_id_tech":0,"locations_id":0,"manufacturers_id":0,"states_id":0,"entities_id":0,"is_recursive":0,"is_deleted":0,"is_template":0,"is_dynamic":0,"template_name":null,"autoupdatesystems_id":0,"date_creation":"2026-10-24 15:13:02","date_mod":"2026-10-24 15:17:25","last_inventory_update":null,"custom_fields":"{\"1\": \"OC09 only text changes now\", \"2\": \"OC09 sibling changed once\", \"3\": \"2026-10-25\", \"4\": \"2026-10-26 06:15:16\", \"5\": 2}"},"2":{"id":2,"assets_assetdefinitions_id":2,"assets_assetmodels_id":0,"assets_assettypes_id":0,"name":"AgentB IB custom processed","uuid":null,"comment":null,"serial":"AGENTB-IB-CUSTOM","otherserial":null,"contact":null,"contact_num":null,"users_id":0,"users_id_tech":0,"locations_id":0,"manufacturers_id":0,"states_id":0,"entities_id":0,"is_recursive":0,"is_deleted":0,"is_template":0,"is_dynamic":0,"template_name":null,"autoupdatesystems_id":0,"date_creation":"2026-10-24 15:29:45","date_mod":"2026-10-24 15:33:13","last_inventory_update":null,"custom_fields":"{\"6\": \"IB custom worker text\", \"7\": \"12\", \"8\": true, \"9\": \"2026-10-26\", \"10\": \"2026-10-26 06:15:16\", \"11\": 6, \"12\": \"IB sibling must stay\"}"},"3":{"id":3,"assets_assetdefinitions_id":4,"assets_assetmodels_id":0,"assets_assettypes_id":0,"name":"AgentB IC other definition must stay","uuid":null,"comment":null,"serial":"AGENTB-IC-SHARED","otherserial":null,"contact":null,"contact_num":null,"users_id":0,"users_id_tech":0,"locations_id":0,"manufacturers_id":0,"states_id":0,"entities_id":0,"is_recursive":0,"is_deleted":0,"is_template":0,"is_dynamic":0,"template_name":null,"autoupdatesystems_id":0,"date_creation":"2026-10-24 15:54:53","date_mod":"2026-10-24 15:54:53","last_inventory_update":null,"custom_fields":"[]"},"4":{"id":4,"assets_assetdefinitions_id":3,"assets_assetmodels_id":0,"assets_assettypes_id":0,"name":"AgentB IC requested concrete first copy","uuid":null,"comment":null,"serial":"AGENTB-IC-SHARED","otherserial":null,"contact":null,"contact_num":null,"users_id":0,"users_id_tech":0,"locations_id":0,"manufacturers_id":0,"states_id":0,"entities_id":0,"is_recursive":0,"is_deleted":0,"is_template":0,"is_dynamic":0,"template_name":null,"autoupdatesystems_id":0,"date_creation":"2026-10-24 15:55:41","date_mod":"2026-10-24 15:55:41","last_inventory_update":null,"custom_fields":"{\"13\": \"IC A source seed\", \"14\": \"IC B source seed\", \"15\": \"IC Both source seed\", \"16\": 7, \"17\": \"2026-10-24 09:18:19\"}"}},"assetHistory":[],"pending":{"10":{"id":10,"route_id":"outbound-a-20261024-main","settings_version":4,"a_entities_id":9100,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":null,\"b_items_id\":145,\"serial\":\"AGENTB-OC-MAIN\"}","changed_fields_json":"{\"native_name\":{\"value\":\"AgentB OC two route save\",\"changed_at\":\"2026-10-24T15:16:39+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 15:16:39","date_mod":"2026-10-24 15:16:39","done_at":null},"11":{"id":11,"route_id":"outbound-a-20261024-second-route","settings_version":1,"a_entities_id":9101,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":null,\"b_items_id\":145,\"serial\":\"AGENTB-OC-MAIN\"}","changed_fields_json":"{\"second_name\":{\"value\":\"AgentB OC two route save\",\"changed_at\":\"2026-10-24T15:16:39+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 15:16:39","date_mod":"2026-10-24 15:16:39","done_at":null},"13":{"id":13,"route_id":"outbound-a-20261024-main","settings_version":5,"a_entities_id":9100,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBOC20261024Asset","identity_json":"{\"a_items_id\":null,\"b_items_id\":1,\"serial\":\"AGENTB-OC-CUSTOM\"}","changed_fields_json":"{\"virtual_oc_text\":{\"value\":\"OC09 only text changes now\",\"changed_at\":\"2026-10-24T15:17:25+08:00\",\"reliable\":true},\"custom_native_name\":{\"value\":\"AgentB OC custom core after fix\",\"changed_at\":\"2026-10-24T15:17:25+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 15:17:25","date_mod":"2026-10-24 15:17:25","done_at":null},"15":{"id":15,"route_id":"outbound-b-20261024-history","settings_version":1,"a_entities_id":9300,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":null,\"b_items_id\":152,\"serial\":\"AGENTB-OB-HISTORY\"}","changed_fields_json":"{\"ob_name\":{\"value\":\"AgentB OB history genuine edit\",\"changed_at\":\"2026-10-24T15:39:55+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 15:39:55","date_mod":"2026-10-24 15:39:55","done_at":null},"16":{"id":16,"route_id":"inbound-c-20261024-main","settings_version":1,"a_entities_id":9400,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":944001,\"b_items_id\":153,\"serial\":\"AGENTB-IC-NATIVE-CHANGED\"}","changed_fields_json":"{\"ic_name\":{\"value\":\"AgentB IC genuine after creation\",\"changed_at\":\"2026-10-24T15:57:19+08:00\",\"reliable\":true},\"ic_serial\":{\"value\":\"AGENTB-IC-NATIVE-CHANGED\",\"changed_at\":\"2026-10-24T15:57:19+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 15:57:19","date_mod":"2026-10-24 15:57:19","done_at":null}},"queueCount":16}
```

Stderr:
```text

```
