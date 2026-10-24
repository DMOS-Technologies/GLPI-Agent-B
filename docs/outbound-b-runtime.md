# Senior 2(b) acknowledgement runtime evidence — 24 October 2026

READY for independent evidence review and completion of this acknowledgement stage. 70 actual manual curl calls and 5 local native-method operator invocations; no implementation defect observed. Only approved inc/change.class.php from outbound-b deployed, including reviewed global competing-route scope guard. Existing capture, admission and processor files retained. GLPI11.0.7, localhost:8081/api.php/v1.

No automated tests/regression harness, raw DML, delete/purge/uninstall, repository edit, commit, push or custom HTTP endpoint. Tokens/session IDs remain in memory and are redacted. Common headers Accept/Content-Type application/json; App-Token [REDACTED]; login Authorization user_token [REDACTED], other calls Session-Token [REDACTED]. GET body null means none. Five native sessions created and closed successfully (second57, readonly60, denied63, outside66, primary70).

Acknowledging snapshots below explicitly simulates A having completely handled those immutable saved edits; this does not certify A's real saving implementation. Existing genuine captured OC/IB snapshots used; no fabricated queue or Work links.

## Results

| Case | Runtime evidence |
|---|---|
| OB01 | PASS singleton Pending3 -> Done returns200 [{3:true,message:''}]; readback4 sets native done_at/date_mod and retains all business columns byte-for-byte. |
| OB02 | PASS bulk separate Fields4/native5 snapshots -> Done, native200 true per ID. Newer13 remains Pending exact; final10–13 unselected Pending. Snapshot coverage independent, no inferred completion. |
| OB03 | PASS Pending->Pending/lowercase/unknown and Done->Done/Done->Pending reject400 ASB_CHANGE_TRANSITION. Null/number/bool/object status rejects ASB_INVALID_FIELD. Missing status rejects ASB_REQUIRED_FIELD. Row2 remains unchanged until legitimate ack67. |
| OB04 | PASS every declared B-owned column individually rejected even null/default values: route/version/entities/type/identity/changed fields/retry/error/native timestamps/done_at. Client bypass keys reject; owned > unknown > required and lexical unknown ordering observed. |
| OB05 | PASS actual native boundaries recorded: string ID2 reaches plugin and rejects ASB_INVALID_FIELD. ID0/float2.5 on URL2 return400 ERROR_GLPI_UPDATE/null before effective plugin update. Collection PUT object without ID returns200 [[]], no row changes. No invented required-ID response promised. |
| OB06 | PASS mixed6 valid,3 already Done,7 forbidden error ->207 ERROR_GLPI_PARTIAL_UPDATE with exact per-ID booleans;6 persists Done despite sibling errors. All-invalid array ->400 ERROR_GLPI_UPDATE per-ID false. |
| OB07 | PASS installed missing-ID caveat: valid7 + absent2147483647 ->207 ERROR_GLPI_PARTIAL_UPDATE with only one result {7:true,message:''}; absent ID omitted. All-absent ->400 ERROR_GLPI_UPDATE/[]; GET absent404 ERROR_ITEM_NOT_FOUND. Reconcile by submitted/returned IDs, not positions or HTTP alone; forcedisplay is not used on PUT. |
| OB08 | PASS genuine unlinked rows3/4/5/6/7/8/2 acknowledged with route6 disabled and current version6 newer than snapshots. Old enabled state/version alone does not block completion. |
| OB09 | PASS genuine known Active identity snapshot14 acknowledges under disabled/current-version5 route10. Targeted cross-route fix actual fixture: historical unlinked15 under route11, later normal Work58 establishes verified Active ownership of same B152 by route12/A933101. Ack15 rejects400 ASB_CHANGE_IDENTITY_AMBIGUOUS: reason=competing_route; exact Pending readback. Latest Suspended, competing same-route IDs, known missing/mismatch links or missing/wrong-entity asset variants NOT RUN: no destructive/fake fixtures or unavailable controls. |
| OB10 | PASS fresh actual sessions for Change read-only profile, no-rights user13, outside entity5 user14 each fail400 native permission message on row2. Test profile14 Change rights temporarily1 then restored3; no old profile/account alteration. |
| OB11 | PASS two manual independent native sessions acknowledge row8 concurrently: one200 success, one400 ASB_CHANGE_TRANSITION Done->Done. Row remains one immutable Done snapshot. No concurrent stress harness or simulated lost response. |
| OB12 | PASS changed helper path markQueueRowsDone([3,2147483647,9]) gives already-Done3 false, missing false, exact9 true; unselected10 remains exact Pending. Failure injection NOT RUN without an approved safe hook. |

## Exact native caveats

- Collection missing ID body {input:{status:'Done'}} -> HTTP200 body [[]]. This confirms A cannot treat a successful HTTP response as proof of acknowledgement.
- Mixed body {input:[{id:7,status:'Done'},{id:2147483647,status:'Done'}]} -> HTTP207 [ERROR_GLPI_PARTIAL_UPDATE,[{7:true,message:''}]]. Missing result must remain unresolved.
- All absent body -> HTTP400 [ERROR_GLPI_UPDATE,[]]. GET2147483647 ->404 [ERROR_ITEM_NOT_FOUND,Item not found].
- Forbidden singleton uses scalar message in native ERROR_GLPI_UPDATE wrapper; array failures retain per-ID false entries. No custom HTTP responses added.

## Fixtures, immutability and final state

Original Changes1–14 were actual prior captures. Final immutable-column comparison shows every prior row retains route/settings/entity/type/identity/value/original times/retry/error/date_creation byte-for-byte; only status/date_mod/done_at can change. Final Done1–9 and14; Pending10–13 and15. Change1 was already Done before this pass. No acknowledgement created another queue row. Exactly one new Change15 came from explicitly authorized genuine edit on new Computer152 for scope fixture.

Only fresh scope asset152 created/edited. New Setting11 outbound-b-20261024-history and12 outbound-b-20261024-owner both disabled/version2 at end. Normal scoped Agent B worker51 establishes real Work58 Done/Active B152/A933101 for owner route without asset update (History2->2); no raw SQL link fabrication. Snapshot15 remains Pending due competing route even when both routes disabled. No unrelated asset moves. Earlier OC/IB fixture settings stay disabled.

Native acknowledgements wrote no asset: final Computer149 equals IB final values with identical History count29; fresh152 remains genuine-edit value with History2 unchanged by worker/ack attempts. Queue count15 equals14 baseline +1 real scope capture. Test profile14 Change permission restored3. Scope/control execution, correction coverage, A's saves and full product flow remain unclaimed. Safe persistence/verification failure injection NOT RUN; no code/database damage induced.

## Exact actual curl ledger

### 1 — OB service login

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

### 2 — OB baseline captured immutable snapshots

Account service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?range=0-99&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request:

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
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:13:27",
    "date_mod": "2026-10-24 15:13:27",
    "done_at": null
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
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:13:27",
    "date_mod": "2026-10-24 15:13:27",
    "done_at": null
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
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:13:27",
    "date_mod": "2026-10-24 15:13:27",
    "done_at": null
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
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:13:27",
    "date_mod": "2026-10-24 15:13:27",
    "done_at": null
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
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:14:23",
    "date_mod": "2026-10-24 15:14:23",
    "done_at": null
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
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:14:23",
    "date_mod": "2026-10-24 15:14:23",
    "done_at": null
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
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:14:23",
    "date_mod": "2026-10-24 15:14:23",
    "done_at": null
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
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:15:38",
    "date_mod": "2026-10-24 15:15:38",
    "done_at": null
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
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:27:27",
    "date_mod": "2026-10-24 15:27:27",
    "done_at": null
  }
]
```

### 3 — OB01 singleton handled Pending snapshot3 -> Done

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/3; HTTP 200.

Request:

```json
{
  "input": {
    "id": 3,
    "status": "Done"
  }
}
```

Response:

```json
[
  {
    "3": true,
    "message": ""
  }
]
```

### 4 — OB01 singleton immutable readback

Account service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/3?get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request:

```json
null
```

Response:

```json
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
}
```

### 5 — OB03 Pending to Pending rejected

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2,
    "status": "Pending"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_CHANGE_TRANSITION: from=Pending to=Pending"
]
```

### 6 — OB03 lowercase status rejected

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2,
    "status": "done"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_CHANGE_TRANSITION: from=Pending to=done"
]
```

### 7 — OB03 unknown status rejected

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2,
    "status": "Other"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_CHANGE_TRANSITION: from=Pending to=Other"
]
```

### 8 — OB03 Done to Done rejected

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/3; HTTP 400.

Request:

```json
{
  "input": {
    "id": 3,
    "status": "Done"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_CHANGE_TRANSITION: from=Done to=Done"
]
```

### 9 — OB03 Done to Pending rejected

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/3; HTTP 400.

Request:

```json
{
  "input": {
    "id": 3,
    "status": "Pending"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_CHANGE_TRANSITION: from=Done to=Pending"
]
```

### 10 — OB03 null status rejected

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2,
    "status": null
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_INVALID_FIELD: field=status"
]
```

### 11 — OB03 numeric status rejected

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2,
    "status": 1
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_INVALID_FIELD: field=status"
]
```

### 12 — OB03 boolean status rejected

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2,
    "status": true
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_INVALID_FIELD: field=status"
]
```

### 13 — OB03 object status rejected

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2,
    "status": {}
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_INVALID_FIELD: field=status"
]
```

### 14 — OB03 missing status rejected

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_REQUIRED_FIELD: field=status"
]
```

### 15 — OB04 reject owned route_id

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2,
    "status": "Done",
    "route_id": null
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_B_OWNED_FIELD: field=route_id"
]
```

### 16 — OB04 reject owned settings_version

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2,
    "status": "Done",
    "settings_version": null
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_B_OWNED_FIELD: field=settings_version"
]
```

### 17 — OB04 reject owned a_entities_id

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2,
    "status": "Done",
    "a_entities_id": null
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_B_OWNED_FIELD: field=a_entities_id"
]
```

### 18 — OB04 reject owned entities_id

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2,
    "status": "Done",
    "entities_id": null
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_B_OWNED_FIELD: field=entities_id"
]
```

### 19 — OB04 reject owned itemtype

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2,
    "status": "Done",
    "itemtype": null
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_B_OWNED_FIELD: field=itemtype"
]
```

### 20 — OB04 reject owned identity_json

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2,
    "status": "Done",
    "identity_json": null
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_B_OWNED_FIELD: field=identity_json"
]
```

### 21 — OB04 reject owned changed_fields_json

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2,
    "status": "Done",
    "changed_fields_json": null
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_B_OWNED_FIELD: field=changed_fields_json"
]
```

### 22 — OB04 reject owned retry_count

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2,
    "status": "Done",
    "retry_count": 0
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_B_OWNED_FIELD: field=retry_count"
]
```

### 23 — OB04 reject owned error

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2,
    "status": "Done",
    "error": null
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_B_OWNED_FIELD: field=error"
]
```

### 24 — OB04 reject owned date_creation

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2,
    "status": "Done",
    "date_creation": null
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_B_OWNED_FIELD: field=date_creation"
]
```

### 25 — OB04 reject owned date_mod

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2,
    "status": "Done",
    "date_mod": null
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_B_OWNED_FIELD: field=date_mod"
]
```

### 26 — OB04 reject owned done_at

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2,
    "status": "Done",
    "done_at": null
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_B_OWNED_FIELD: field=done_at"
]
```

### 27 — OB04 unknown bypass add

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2,
    "status": "Done",
    "_add": true
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_UNKNOWN_FIELD: field=_add"
]
```

### 28 — OB04 unknown internal flag

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2,
    "status": "Done",
    "_agentbdmosassetsync_internal": true
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_UNKNOWN_FIELD: field=_agentbdmosassetsync_internal"
]
```

### 29 — OB04 owned precedes unknown and missing status

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2,
    "route_id": null,
    "z_unknown": true
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_B_OWNED_FIELD: field=route_id"
]
```

### 30 — OB04 unknown lexical order precedes missing status

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2,
    "z_unknown": true,
    "a_unknown": true
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_UNKNOWN_FIELD: field=a_unknown"
]
```

### 31 — OB05 id zero on ID URL

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 0,
    "status": "Done"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  null
]
```

### 32 — OB05 id string on ID URL

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": "2",
    "status": "Done"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_INVALID_FIELD: field=id"
]
```

### 33 — OB05 id float on ID URL

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2.5,
    "status": "Done"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  null
]
```

### 34 — OB05 missing ID on collection URL native boundary

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange; HTTP 200.

Request:

```json
{
  "input": {
    "status": "Done"
  }
}
```

Response:

```json
[
  []
]
```

### 35 — OB02 handled separate Fields and native snapshots bulk acknowledge4 and5

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange; HTTP 200.

Request:

```json
{
  "input": [
    {
      "id": 4,
      "status": "Done"
    },
    {
      "id": 5,
      "status": "Done"
    }
  ]
}
```

Response:

```json
[
  {
    "4": true,
    "message": ""
  },
  {
    "5": true,
    "message": ""
  }
]
```

### 36 — OB06 mixed valid6 Done3 forbidden7

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange; HTTP 207.

Request:

```json
{
  "input": [
    {
      "id": 6,
      "status": "Done"
    },
    {
      "id": 3,
      "status": "Done"
    },
    {
      "id": 7,
      "status": "Done",
      "error": null
    }
  ]
}
```

Response:

```json
[
  "ERROR_GLPI_PARTIAL_UPDATE",
  [
    {
      "6": true,
      "message": ""
    },
    {
      "3": false,
      "message": "ASB_CHANGE_TRANSITION: from=Done to=Done"
    },
    {
      "7": false,
      "message": "ASB_B_OWNED_FIELD: field=error"
    }
  ]
]
```

### 37 — OB06 all-invalid array

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange; HTTP 400.

Request:

```json
{
  "input": [
    {
      "id": 3,
      "status": "Done"
    },
    {
      "id": 2,
      "status": "Done",
      "error": null
    }
  ]
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  [
    {
      "3": false,
      "message": "ASB_CHANGE_TRANSITION: from=Done to=Done"
    },
    {
      "2": false,
      "message": "ASB_B_OWNED_FIELD: field=error"
    }
  ]
]
```

### 38 — OB07 valid7 plus known absent ID native omission

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange; HTTP 207.

Request:

```json
{
  "input": [
    {
      "id": 7,
      "status": "Done"
    },
    {
      "id": 2147483647,
      "status": "Done"
    }
  ]
}
```

Response:

```json
[
  "ERROR_GLPI_PARTIAL_UPDATE",
  [
    {
      "7": true,
      "message": ""
    }
  ]
]
```

### 39 — OB07 all absent native acknowledgement batch

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange; HTTP 400.

Request:

```json
{
  "input": [
    {
      "id": 2147483647,
      "status": "Done"
    }
  ]
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  []
]
```

### 40 — OB07 unresolved absent ID readback is404 not acknowledgement

Account service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2147483647?get_hateoas=false&expand_dropdowns=false; HTTP 404.

Request:

```json
null
```

Response:

```json
[
  "ERROR_ITEM_NOT_FOUND",
  "Item not found"
]
```

### 41 — OB09 verified Active known snapshot14 acknowledges disabled old route

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/14; HTTP 200.

Request:

```json
{
  "input": {
    "id": 14,
    "status": "Done"
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

### 42 — OB02 unselected newer snapshot13 unchanged

Account service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/13?get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request:

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

### 43 — OB09 create fresh historical-unlinked scope fixture asset

Account service; POST http://localhost:8081/api.php/v1/Computer; HTTP 201.

Request:

```json
{
  "input": {
    "name": "AgentB OB history initial",
    "serial": "AGENTB-OB-HISTORY",
    "entities_id": 0
  }
}
```

Response:

```json
{
  "id": 152,
  "message": "Item successfully added: AgentB OB history initial"
}
```

### 44 — OB09 create fresh history route before genuine edit

Account service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting; HTTP 201.

Request:

```json
{
  "input": {
    "route_id": "outbound-b-20261024-history",
    "a_entities_id": 9300,
    "entities_id": 0,
    "route_enabled": 1,
    "settings_version": 1,
    "enabled_itemtypes_json": "[\"Computer\"]",
    "field_mappings_json": "[{\"mapping_id\":\"ob_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
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

### 45 — OB09 genuine edit creates actual historical unlinked snapshot

Account service; PUT http://localhost:8081/api.php/v1/Computer/152; HTTP 200.

Request:

```json
{
  "input": {
    "id": 152,
    "name": "AgentB OB history genuine edit"
  }
}
```

Response:

```json
[
  {
    "152": true,
    "message": ""
  }
]
```

### 46 — OB09 read genuine historical unlinked snapshot exact ID

Account service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?searchText%5Broute_id%5D=%5Eoutbound-b-20261024-history%24&range=0-9&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request:

```json
null
```

Response:

```json
[
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
  }
]
```

### 47 — OB09 disable only fresh history route preserving evidence

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/11; HTTP 200.

Request:

```json
{
  "input": {
    "id": 11,
    "route_id": "outbound-b-20261024-history",
    "a_entities_id": 9300,
    "entities_id": 0,
    "route_enabled": 0,
    "settings_version": 2,
    "enabled_itemtypes_json": "[\"Computer\"]",
    "field_mappings_json": "[{\"mapping_id\":\"ob_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
  }
}
```

Response:

```json
[
  {
    "11": true,
    "message": ""
  }
]
```

### 48 — OB09 create distinct owner route for verified worker evidence

Account service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting; HTTP 201.

Request:

```json
{
  "input": {
    "route_id": "outbound-b-20261024-owner",
    "a_entities_id": 9301,
    "entities_id": 0,
    "route_enabled": 1,
    "settings_version": 1,
    "enabled_itemtypes_json": "[\"Computer\"]",
    "field_mappings_json": "[{\"mapping_id\":\"ob_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
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

### 49 — OB09 normal Work establishes distinct verified ownership without asset write

Account service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork; HTTP 201.

Request:

```json
{
  "input": {
    "work_id": "outbound-b-20261024-owner-evidence",
    "route_id": "outbound-b-20261024-owner",
    "a_entities_id": 9301,
    "entities_id": 0,
    "itemtype": "Computer",
    "identity_json": "{\"a_items_id\":933101,\"b_items_id\":null,\"serial\":\"AGENTB-OB-HISTORY\"}",
    "a_values_json": "{}",
    "a_change_times_json": "{}",
    "settings_version": 1
  }
}
```

Response:

```json
{
  "id": 58,
  "message": ""
}
```

### 50 — OB09 historical unlinked snapshot rejects competing route ownership

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/15; HTTP 400.

Request:

```json
{
  "input": {
    "id": 15,
    "status": "Done"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_CHANGE_IDENTITY_AMBIGUOUS: reason=competing_route"
]
```

### 51 — OB09 rejected historical snapshot remains exact Pending

Account service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/15?get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request:

```json
null
```

Response:

```json
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
}
```

### 52 — OB09 contain only fresh verified owner fixture route

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/12; HTTP 200.

Request:

```json
{
  "input": {
    "id": 12,
    "route_id": "outbound-b-20261024-owner",
    "a_entities_id": 9301,
    "entities_id": 0,
    "route_enabled": 0,
    "settings_version": 2,
    "enabled_itemtypes_json": "[\"Computer\"]",
    "field_mappings_json": "[{\"mapping_id\":\"ob_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
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

### 53 — OB11 second independent service session login

Account second; GET http://localhost:8081/api.php/v1/initSession; HTTP 200.

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

### 54 — OB11 concurrent client B acknowledges8

Account second; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/8; HTTP 200.

Request:

```json
{
  "input": {
    "id": 8,
    "status": "Done"
  }
}
```

Response:

```json
[
  {
    "8": true,
    "message": ""
  }
]
```

### 55 — OB11 concurrent client A acknowledges8

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/8; HTTP 400.

Request:

```json
{
  "input": {
    "id": 8,
    "status": "Done"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_CHANGE_TRANSITION: from=Done to=Done"
]
```

### 56 — OB11 concurrent exact row8 readback

Account service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/8?get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request:

```json
null
```

Response:

```json
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
}
```

### 57 — OB11 close second independent session

Account second; GET http://localhost:8081/api.php/v1/killSession; HTTP 200.

Request:

```json
null
```

Response:

```json
true
```

### 58 — OB10 read-only restricted session login

Account readonly; GET http://localhost:8081/api.php/v1/initSession; HTTP 200.

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

### 59 — OB10 read-only profile cannot acknowledge2

Account readonly; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2,
    "status": "Done"
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

### 60 — OB10 read-only session logout

Account readonly; GET http://localhost:8081/api.php/v1/killSession; HTTP 200.

Request:

```json
null
```

Response:

```json
true
```

### 61 — OB10 no-rights user login

Account denied; GET http://localhost:8081/api.php/v1/initSession; HTTP 200.

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

### 62 — OB10 no-rights user cannot acknowledge2

Account denied; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2,
    "status": "Done"
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

### 63 — OB10 denied session logout

Account denied; GET http://localhost:8081/api.php/v1/killSession; HTTP 200.

Request:

```json
null
```

Response:

```json
true
```

### 64 — OB10 outside-entity user login

Account outside; GET http://localhost:8081/api.php/v1/initSession; HTTP 200.

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

### 65 — OB10 outside entity cannot acknowledge root2

Account outside; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 400.

Request:

```json
{
  "input": {
    "id": 2,
    "status": "Done"
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

### 66 — OB10 outside session logout

Account outside; GET http://localhost:8081/api.php/v1/killSession; HTTP 200.

Request:

```json
null
```

Response:

```json
true
```

### 67 — OB08 legitimate unlinked snapshot2 ack after all rejected mutations and rights restore

Account service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/2; HTTP 200.

Request:

```json
{
  "input": {
    "id": 2,
    "status": "Done"
  }
}
```

Response:

```json
[
  {
    "2": true,
    "message": ""
  }
]
```

### 68 — OB final immutable snapshots and untouched newer rows

Account service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?range=0-99&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request:

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
  }
]
```

### 69 — OB fresh fixture routes disabled readback

Account service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting?searchText%5Broute_id%5D=%5Eoutbound-b-20261024-&range=0-9&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request:

```json
null
```

Response:

```json
[
  {
    "id": 11,
    "route_id": "outbound-b-20261024-history",
    "a_entities_id": 9300,
    "entities_id": 0,
    "route_enabled": 0,
    "settings_version": 2,
    "enabled_itemtypes_json": "[\"Computer\"]",
    "field_mappings_json": "[{\"mapping_id\":\"ob_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
  },
  {
    "id": 12,
    "route_id": "outbound-b-20261024-owner",
    "a_entities_id": 9301,
    "entities_id": 0,
    "route_enabled": 0,
    "settings_version": 2,
    "enabled_itemtypes_json": "[\"Computer\"]",
    "field_mappings_json": "[{\"mapping_id\":\"ob_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
  }
]
```

### 70 — OB final service session logout

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

### Local 1 — OB09 only scoped native Agent B worker establishes actual verified link

User context 2; exit 0.

```php
$_SESSION['glpicronuserrunning']='OB fixture scoped runner';$t=new CronTask();$t->getFromDB(51);$before=countElementsInTable(Log::getTable(),['itemtype'=>'Computer','items_id'=>152]);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$w=new PluginAgentbdmosassetsyncWork();$w->getFromDB(58);echo json_encode(['started'=>$started,'ret'=>$ret,'work'=>$w->fields,'history_before'=>$before,'history_after'=>countElementsInTable(Log::getTable(),['itemtype'=>'Computer','items_id'=>152])]);
```

Result:

```text
{"started":true,"ret":1,"work":{"id":58,"work_id":"outbound-b-20261024-owner-evidence","route_id":"outbound-b-20261024-owner","a_entities_id":9301,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":933101,\"b_items_id\":null,\"serial\":\"AGENTB-OB-HISTORY\"}","a_values_json":"{}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":933101,"b_items_id":152,"link_state":"Active","processing_started_at":"2026-10-24 15:39:55","status":"Done","result_json":"{\"b_items_id\":152,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ob_name\",\"outcome\":\"Skipped\",\"reason\":\"A supplied no value for this enabled mapping\"}]}","error":null,"date_creation":"2026-10-24 15:39:55","date_mod":"2026-10-24 15:39:55","completed_at":"2026-10-24 15:39:55"},"history_before":2,"history_after":2}

```

### Local 2 — OB12 changed helper path missing and already Done false then exact selected9 success

User context 12; exit 0.

```php
$before=[];foreach([3,9,10]as$id){$x=new PluginAgentbdmosassetsyncChange();$x->getFromDB($id);$before[$id]=$x->fields;}$results=markQueueRowsDone([3,2147483647,9]);$after=[];foreach([3,9,10]as$id){$x=new PluginAgentbdmosassetsyncChange();$x->getFromDB($id);$after[$id]=$x->fields;}echo json_encode(compact('before','results','after'));
```

Result:

```text
{"before":{"3":{"id":3,"route_id":"outbound-a-20261024-main","settings_version":1,"a_entities_id":9100,"entities_id":0,"itemtype":"Monitor","identity_json":"{\"a_items_id\":null,\"b_items_id\":1,\"serial\":\"AGENTB-OC-MONITOR\"}","changed_fields_json":"{\"monitor_name\":{\"value\":\"AgentB OC monitor edited\",\"changed_at\":\"2026-10-24T15:13:27+08:00\",\"reliable\":true}}","status":"Done","retry_count":0,"error":null,"date_creation":"2026-10-24 15:13:27","date_mod":"2026-10-24 15:38:35","done_at":"2026-10-24 15:38:35"},"9":{"id":9,"route_id":"outbound-a-20261024-main","settings_version":1,"a_entities_id":9100,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":null,\"b_items_id\":145,\"serial\":\"AGENTB-OC-MAIN\"}","changed_fields_json":"{\"native_name\":{\"value\":\"AgentB OC genuine after guard\",\"changed_at\":\"2026-10-24T15:15:38+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 15:15:38","date_mod":"2026-10-24 15:15:38","done_at":null},"10":{"id":10,"route_id":"outbound-a-20261024-main","settings_version":4,"a_entities_id":9100,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":null,\"b_items_id\":145,\"serial\":\"AGENTB-OC-MAIN\"}","changed_fields_json":"{\"native_name\":{\"value\":\"AgentB OC two route save\",\"changed_at\":\"2026-10-24T15:16:39+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 15:16:39","date_mod":"2026-10-24 15:16:39","done_at":null}},"results":{"3":false,"2147483647":false,"9":true},"after":{"3":{"id":3,"route_id":"outbound-a-20261024-main","settings_version":1,"a_entities_id":9100,"entities_id":0,"itemtype":"Monitor","identity_json":"{\"a_items_id\":null,\"b_items_id\":1,\"serial\":\"AGENTB-OC-MONITOR\"}","changed_fields_json":"{\"monitor_name\":{\"value\":\"AgentB OC monitor edited\",\"changed_at\":\"2026-10-24T15:13:27+08:00\",\"reliable\":true}}","status":"Done","retry_count":0,"error":null,"date_creation":"2026-10-24 15:13:27","date_mod":"2026-10-24 15:38:35","done_at":"2026-10-24 15:38:35"},"9":{"id":9,"route_id":"outbound-a-20261024-main","settings_version":1,"a_entities_id":9100,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":null,\"b_items_id\":145,\"serial\":\"AGENTB-OC-MAIN\"}","changed_fields_json":"{\"native_name\":{\"value\":\"AgentB OC genuine after guard\",\"changed_at\":\"2026-10-24T15:15:38+08:00\",\"reliable\":true}}","status":"Done","retry_count":0,"error":null,"date_creation":"2026-10-24 15:15:38","date_mod":"2026-10-24 15:40:30","done_at":"2026-10-24 15:40:30"},"10":{"id":10,"route_id":"outbound-a-20261024-main","settings_version":4,"a_entities_id":9100,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":null,\"b_items_id\":145,\"serial\":\"AGENTB-OC-MAIN\"}","changed_fields_json":"{\"native_name\":{\"value\":\"AgentB OC two route save\",\"changed_at\":\"2026-10-24T15:16:39+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 15:16:39","date_mod":"2026-10-24 15:16:39","done_at":null}}}

```

### Local 3 — OB10 temporarily make only test profile14 Change read-only

User context 2; exit 0.

```php
ProfileRight::updateProfileRights(14,['plugin_agentbdmosassetsync_change'=>READ]);echo json_encode(['change_right'=>READ]);
```

Result:

```text
{"change_right":1}

```

### Local 4 — OB10 restore only test profile14 Change rights3

User context 2; exit 0.

```php
ProfileRight::updateProfileRights(14,['plugin_agentbdmosassetsync_change'=>READ|UPDATE]);echo json_encode(['change_right'=>READ|UPDATE]);
```

Result:

```text
{"change_right":3}

```

### Local 5 — OB final read-only asset History queue rights inventory

User context 12; exit 0.

```php
$a=new Computer();$a->getFromDB(149);$b=new Computer();$b->getFromDB(152);echo json_encode(['computer149'=>$a->fields,'computer152'=>$b->fields,'computer149_history'=>countElementsInTable(Log::getTable(),['itemtype'=>'Computer','items_id'=>149]),'computer152_history'=>countElementsInTable(Log::getTable(),['itemtype'=>'Computer','items_id'=>152]),'queue_count'=>countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[]),'change_right'=>iterator_to_array($DB->request(['FROM'=>ProfileRight::getTable(),'WHERE'=>['profiles_id'=>14,'name'=>'plugin_agentbdmosassetsync_change']]))]);
```

Result:

```text
{"computer149":{"id":149,"entities_id":0,"name":"AgentB IB partial valid sibling","serial":"AGENTB-IB-RENAMED","otherserial":null,"contact":null,"contact_num":null,"users_id_tech":0,"comment":"AgentB IB readable source label","date_mod":"2026-10-24 15:33:13","autoupdatesystems_id":0,"locations_id":0,"networks_id":0,"computermodels_id":0,"computertypes_id":0,"is_template":0,"template_name":null,"manufacturers_id":3,"is_deleted":0,"is_dynamic":0,"users_id":0,"states_id":0,"ticket_tco":"0.0000","uuid":null,"date_creation":"2026-10-24 15:26:22","is_recursive":0,"last_inventory_update":null,"last_boot":null,"groups_id":[],"groups_id_tech":[]},"computer152":{"id":152,"entities_id":0,"name":"AgentB OB history genuine edit","serial":"AGENTB-OB-HISTORY","otherserial":null,"contact":null,"contact_num":null,"users_id_tech":0,"comment":null,"date_mod":"2026-10-24 15:39:55","autoupdatesystems_id":0,"locations_id":0,"networks_id":0,"computermodels_id":0,"computertypes_id":0,"is_template":0,"template_name":null,"manufacturers_id":0,"is_deleted":0,"is_dynamic":0,"users_id":0,"states_id":0,"ticket_tco":"0.0000","uuid":null,"date_creation":"2026-10-24 15:39:55","is_recursive":0,"last_inventory_update":null,"last_boot":null,"groups_id":[],"groups_id_tech":[]},"computer149_history":29,"computer152_history":2,"queue_count":15,"change_right":{"1399":{"id":1399,"profiles_id":14,"name":"plugin_agentbdmosassetsync_change","rights":3}}}

```

