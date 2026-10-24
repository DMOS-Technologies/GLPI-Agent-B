# Senior 2(a) outbound capture runtime evidence — 24 October 2026

Status: READY for independent evidence review and part completion. Both observed implementation failures were corrected by approved targeted fixes and selectively verified. 62 actual manual curl calls and 23 local native-method operator invocations recorded. Full request/response ledger and local operation source/output follow. No automated regression harness, raw DML, delete, purge, uninstall, repository edit, commit or push.

Deployment: only approved setup.php, inc/capture.php, inc/fields.php, inc/change.class.php, inc/setting.class.php from outbound-a were deployed. Existing Work admission class retained. Later only approved custom capture fix inc/capture.php and approved custom restriction fix inc/fields.php were selectively deployed. No schema change or install command. Target localhost:8081/api.php/v1, GLPI 11.0.7, Fields 1.24.4.

Accounts: service user12/profile14/root0 nonrecursive. Fixture-only Monitor rights7, dropdown READ1, custom asset right7 added only to profile14. New Fields container6 initialized its native default associations then immediately set every new association0 except profile14=4; exact before/after are local operation4. No existing container rights or unrelated core profile masks modified. Local metadata setup used native request context of administrator user2/profile4; actual genuine local guard edits used user12/profile14, outside edit user14/entity5. CLI operations initialize real GLPI Kernel and Session, then Plugin::init where hooks are required.

Fresh retained fixtures: Computers145(main),146(first Fields row),147(nested creation),148(outside entity5); Monitor1; custom definition1/type Glpi\CustomAsset\AgentBOC20261024Asset/asset1; custom fields1–5; Fields container6 agentbocx, fields46–53, storage PluginFieldsComputeragentbocx rows1–3; Manufacturer options1/2; Fields dropdown option1. No existing assets or old AssetSync records changed. All fixture setup used native GLPI add/update methods or standard REST.

Capture results:

- OC01–OC04: native Computer and second native Monitor captured. A-owned name is included. First multi-field save produced Change1; second same-second edit Change2. Independent same-entity routes produced Changes10/11. Disabled route/type, unmapped contact and outside-entity save produced no row. Exact route/type/value/time evidence is in calls9–24,33–40 and local17.
- OC05/OC08: native dropdown row1 uses readable Manufacturer label. Fields row4 captures text, textarea, URL, number12.5, boolean true, date YYYY-MM-DD, datetime YYYY-MM-DD HH:MM:SS and readable dropdown label. Final storage values prove rejected date/readonly attempts did not persist. No claim that every unsupported complex kind or unavailable-plugin state was exercised.
- OC06/OC07: combined native+Fields save creates separate immediate rows4(Fields)/5(native). Standalone generated-storage update row6; Fields-only parent request row7; first storage row on existing Computer146 row8. Nested asset147 creation and unmapped contact produce no edit rows. No shutdown flush.
- OC09 initial FAIL: custom virtual write call13 saved values200 but no Change. Readback17 confirmed saved virtual text/date/datetime with sibling retained. Canonical type exactly matches Setting6. After approved capture fix, targeted retry41 produced Change12 with exactly changed text/other/datetime/dropdown; retry44 produced Change13 with exactly changed text plus native name, other JSON siblings excluded. Correct local datetime14:15:16 is returned despite UTC-backed06:15:16 storage. Initial failed event was not retroactively fabricated in queue. Custom date-only capture after fix was not independently exercised.
- OC09/OC15 second FAIL: custom field2 raw field_options readonly:[14] saved by native method, but Setting POST46 unexpectedly accepted enabled selector as Setting8. Installed ProfileRestrictOption::getValue returns effective bool; candidate helper only checked arrays. Field options restored to[], Setting8 contained disabled version5. No restricted field edit attempted. Approved fields.php restriction fix was then deployed: current-profile readonly request58 and all-profiles sentinel request59 each reject400 ASB_UNSUPPORTED_MAPPING. Effective-false control request60 admits201 Setting9, already disabled, confirmed61. Fixture field2 options restored to[]. Initial unexpected Setting8 stays preserved disabled.
- OC10 representative native guard PASS: nested guard saves leave count8 unchanged; false return and thrown exception release guard; immediately genuine save increments9. Fields/custom guard-specific saves not repeated; shared generic path is source evidence only.
- OC11 Active/Suspended/competing verified links NOT RUN: deployed admission Work has no trusted completion boundary. No fake links or raw DB writes.
- OC12 trusted entry rejects empty changed_fields_json, no row. External Change create denial remains prior foundation evidence, not rerun; ack validator not deployed/tested.
- OC13 presave rejection PASS for malformed mapped Fields date and changed readonly field metadata (native/Fields values unchanged); safe post-save queue/reread failure injection NOT RUN because no approved local fail hook exists and DB/code were not altered for injection. No empty error Changes created.
- OC14 PASS: native markQueueRowsDone([1]) returns true only for1. Change1 Done with done_at, changed snapshot unchanged; Change2 remains Pending unchanged. Empty/invalid helper inputs were already covered at foundation and not repeated.
- OC15 compatible supported mappings admitted; missing native/container, readonly Fields and three incompatible text/dropdown/number mode-kind combinations rejected400 ASB_UNSUPPORTED_MAPPING. Custom readonly initial failure above was fixed and selectively verified by requests58–61; no remaining observed runtime defect. Hidden and other complex metadata variants source-only, not falsely marked runtime PASS.

Final retained queue after62 calls: Changes1–13, Change1 Done and2–13 Pending; all exact rows in call51. Current OC routes contained: Setting6 main disabled/version6; Setting7 second route disabled/version2; Setting8 accidental custom-readonly disabled/version5 (call55 supersedes stale enabled row in call50). Setting9 effective-false control is disabled/version1 (request61). Earlier Work1–22 and their disabled admission routes were not changed; no processor/cron invoked. No external acknowledgement sent.

Session handling: all session tokens stayed in memory; every created API session was closed200 true (calls2,52,56,62). Common headers: Accept/Content-Type application/json; App-Token [REDACTED]; login Authorization user_token [REDACTED], otherwise Session-Token [REDACTED]. GET body null below means no body sent.

Operator corrections before intended mutations: initial CLI includes.php-only bootstrap raised Auth not found; corrected native Kernel bootstrap. One readonly setup used PHP id colon instead of => and failed parse before mutation. One helper invocation used an invented prefixed name and failed before changing a queue row; corrected to actual declared markQueueRowsDone. These are preserved local operations1/10/12, not plugin runtime failures. CLI Kernel boot alone did not initialize plugin hook registry; read-only inspection then called native Plugin::init.

No end-to-end processing/first copy/Both arbitration/correction/control execution/acknowledgement/failure recovery certification.

## Actual curl ledger

### 1 — service login

Account: service; GET http://localhost:8081/api.php/v1/initSession; HTTP 200.

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

### 2 — refresh previous service session logout

Account: service; GET http://localhost:8081/api.php/v1/killSession; HTTP 200.

Request body:

```json
null
```

Response:

```json
true
```

### 3 — service login after fixture rights initialization

Account: service; GET http://localhost:8081/api.php/v1/initSession; HTTP 200.

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

### 4 — create fresh native Computer

Account: service; POST http://localhost:8081/api.php/v1/Computer; HTTP 201.

Request body:

```json
{
  "input": {
    "name": "AgentB OC 20261024 main",
    "serial": "AGENTB-OC-MAIN",
    "entities_id": 0
  }
}
```

Response:

```json
{
  "id": 145,
  "message": "Item successfully added: AgentB OC 20261024 main"
}
```

### 5 — create fresh Computer without Fields storage

Account: service; POST http://localhost:8081/api.php/v1/Computer; HTTP 201.

Request body:

```json
{
  "input": {
    "name": "AgentB OC 20261024 first-fields",
    "serial": "AGENTB-OC-FIRST",
    "entities_id": 0
  }
}
```

Response:

```json
{
  "id": 146,
  "message": "Item successfully added: AgentB OC 20261024 first-fields"
}
```

### 6 — create second native asset Monitor

Account: service; POST http://localhost:8081/api.php/v1/Monitor; HTTP 201.

Request body:

```json
{
  "input": {
    "name": "AgentB OC 20261024 monitor",
    "serial": "AGENTB-OC-MONITOR",
    "entities_id": 0
  }
}
```

Response:

```json
{
  "id": 1,
  "message": "Item successfully added: AgentB OC 20261024 monitor"
}
```

### 7 — create fresh custom asset

Account: service; POST http://localhost:8081/api.php/v1/Glpi%5CCustomAsset%5CAgentBOC20261024Asset; HTTP 201.

Request body:

```json
{
  "input": {
    "name": "AgentB OC 20261024 custom",
    "serial": "AGENTB-OC-CUSTOM",
    "entities_id": 0,
    "custom_oc_text": "Initial",
    "custom_oc_other": "Sibling",
    "custom_oc_date": "2026-10-24",
    "custom_oc_datetime": "2026-10-24 12:00:00",
    "custom_oc_option": 1
  }
}
```

Response:

```json
{
  "id": 1,
  "message": "Item successfully added: AgentB OC 20261024 custom"
}
```

### 8 — create supported native Fields custom mappings route

Account: service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting; HTTP 201.

Request body:

```json
{
  "input": {
    "route_id": "outbound-a-20261024-main",
    "a_entities_id": 9100,
    "entities_id": 0,
    "route_enabled": 1,
    "settings_version": 1,
    "enabled_itemtypes_json": "[\"Computer\",\"Monitor\",\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\"]",
    "field_mappings_json": "[{\"mapping_id\":\"native_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"native_comment\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"comment\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"native_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"manufacturers_id\"},\"source\":\"A\",\"value_mode\":\"dropdown_label_to_dropdown\"},{\"mapping_id\":\"monitor_name\",\"itemtype\":\"Monitor\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"octextfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_textarea\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"octextareafield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_url\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocurlfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_number\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocnumberfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_yesno\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocyesnofield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_date\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocdatefield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_datetime\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocdatetimefield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_dropdown\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocdropdownfield\"},\"source\":\"A\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"virtual_oc_text\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_text\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_other\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_other\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_date\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_date\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_datetime\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_datetime\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_option\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_option\"},\"source\":\"A\",\"value_mode\":\"text_to_dropdown\"}]"
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

### 9 — capture baseline before genuine edits

Account: service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?searchText%5Broute_id%5D=%5Eoutbound-a-20261024-main%24&range=0-99&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request body:

```json
null
```

Response:

```json
[]
```

### 10 — genuine multi-field native save includes A-owned name

Account: service; PUT http://localhost:8081/api.php/v1/Computer/145; HTTP 200.

Request body:

```json
{
  "input": {
    "id": 145,
    "name": "AgentB OC native edit one",
    "comment": "Captured comment",
    "manufacturers_id": 1
  }
}
```

Response:

```json
[
  {
    "145": true,
    "message": ""
  }
]
```

### 11 — second genuine name save creates independent snapshot

Account: service; PUT http://localhost:8081/api.php/v1/Computer/145; HTTP 200.

Request body:

```json
{
  "input": {
    "id": 145,
    "name": "AgentB OC native edit two"
  }
}
```

Response:

```json
[
  {
    "145": true,
    "message": ""
  }
]
```

### 12 — second native Monitor genuine edit

Account: service; PUT http://localhost:8081/api.php/v1/Monitor/1; HTTP 200.

Request body:

```json
{
  "input": {
    "id": 1,
    "name": "AgentB OC monitor edited"
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

### 13 — custom JSON virtual fields genuine update preserves sibling

Account: service; PUT http://localhost:8081/api.php/v1/Glpi%5CCustomAsset%5CAgentBOC20261024Asset/1; HTTP 200.

Request body:

```json
{
  "input": {
    "id": 1,
    "custom_oc_text": "Changed virtual text",
    "custom_oc_date": "2026-10-25",
    "custom_oc_datetime": "2026-10-25 13:14:15"
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

### 14 — native Monitor custom snapshots exact IDs and field values

Account: service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?searchText%5Broute_id%5D=%5Eoutbound-a-20261024-main%24&range=0-99&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request body:

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
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:13:27",
    "date_mod": "2026-10-24 15:13:27",
    "done_at": null
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
  }
]
```

### 15 — nested native plus Fields underlying saves

Account: service; PUT http://localhost:8081/api.php/v1/Computer/145; HTTP 200.

Request body:

```json
{
  "input": {
    "id": 145,
    "c_id": 6,
    "name": "AgentB OC nested native",
    "octextfield": "OC text initial",
    "octextareafield": "OC multiline initial",
    "ocurlfield": "https://example.com/oc",
    "ocnumberfield": 12.5,
    "ocyesnofield": 1,
    "ocdatefield": "2026-10-24",
    "ocdatetimefield": "2026-10-24 12:34:56",
    "plugin_fields_ocdropdownfielddropdowns_id": 1
  }
}
```

Response:

```json
[
  {
    "145": true,
    "message": ""
  }
]
```

### 16 — immediate separate native and Fields snapshots

Account: service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?searchText%5Broute_id%5D=%5Eoutbound-a-20261024-main%24&range=0-99&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request body:

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
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:13:27",
    "date_mod": "2026-10-24 15:13:27",
    "done_at": null
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
  }
]
```

### 17 — custom asset saved virtual value readback after missing snapshot

Account: service; GET http://localhost:8081/api.php/v1/Glpi%5CCustomAsset%5CAgentBOC20261024Asset/1?get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request body:

```json
null
```

Response:

```json
{
  "id": 1,
  "assets_assetdefinitions_id": 1,
  "assets_assetmodels_id": 0,
  "assets_assettypes_id": 0,
  "name": "AgentB OC 20261024 custom",
  "uuid": null,
  "comment": null,
  "serial": "AGENTB-OC-CUSTOM",
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
  "date_creation": "2026-10-24 15:13:02",
  "date_mod": "2026-10-24 15:13:27",
  "last_inventory_update": null,
  "custom_fields": "{\"1\": \"Changed virtual text\", \"2\": \"Sibling\", \"3\": \"2026-10-25\", \"4\": \"2026-10-25 05:14:15\", \"5\": 1}",
  "groups_id": [],
  "groups_id_tech": [],
  "custom_oc_date": "2026-10-25",
  "custom_oc_datetime": "2026-10-25 13:14:15",
  "custom_oc_option": 1,
  "custom_oc_other": "Sibling",
  "custom_oc_text": "Changed virtual text"
}
```

### 18 — generated Fields storage resource readback

Account: service; GET http://localhost:8081/api.php/v1/PluginFieldsComputeragentbocx?range=0-9&get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request body:

```json
null
```

Response:

```json
[
  {
    "id": 1,
    "items_id": 145,
    "itemtype": "Computer",
    "plugin_fields_containers_id": 6,
    "entities_id": 0,
    "octextfield": "OC text initial",
    "octextareafield": "OC multiline initial",
    "ocurlfield": "https://example.com/oc",
    "ocnumberfield": "12.5",
    "ocyesnofield": 1,
    "ocdatefield": "2026-10-24",
    "ocdatetimefield": "2026-10-24 12:34:56",
    "plugin_fields_ocdropdownfielddropdowns_id": 1
  }
]
```

### 19 — standalone generated Fields text edit

Account: service; PUT http://localhost:8081/api.php/v1/PluginFieldsComputeragentbocx/1; HTTP 200.

Request body:

```json
{
  "input": {
    "id": 1,
    "octextfield": "Standalone Fields edit"
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

### 20 — Fields-only native request same save boundary

Account: service; PUT http://localhost:8081/api.php/v1/Computer/145; HTTP 200.

Request body:

```json
{
  "input": {
    "id": 145,
    "c_id": 6,
    "octextfield": "Fields-only parent save"
  }
}
```

Response:

```json
[
  {
    "145": true,
    "message": ""
  }
]
```

### 21 — first Fields storage save on existing asset

Account: service; PUT http://localhost:8081/api.php/v1/Computer/146; HTTP 200.

Request body:

```json
{
  "input": {
    "id": 146,
    "c_id": 6,
    "octextfield": "First storage row edit"
  }
}
```

Response:

```json
[
  {
    "146": true,
    "message": ""
  }
]
```

### 22 — asset creation with nested Fields must not queue edit

Account: service; POST http://localhost:8081/api.php/v1/Computer; HTTP 201.

Request body:

```json
{
  "input": {
    "name": "AgentB OC 20261024 nested create",
    "serial": "AGENTB-OC-CREATED",
    "entities_id": 0,
    "c_id": 6,
    "octextfield": "OC text initial",
    "octextareafield": "OC multiline initial",
    "ocurlfield": "https://example.com/oc",
    "ocnumberfield": 12.5,
    "ocyesnofield": 1,
    "ocdatefield": "2026-10-24",
    "ocdatetimefield": "2026-10-24 12:34:56",
    "plugin_fields_ocdropdownfielddropdowns_id": 1
  }
}
```

Response:

```json
{
  "id": 147,
  "message": "Item successfully added: AgentB OC 20261024 nested create"
}
```

### 23 — unmapped-only genuine native edit

Account: service; PUT http://localhost:8081/api.php/v1/Computer/145; HTTP 200.

Request body:

```json
{
  "input": {
    "id": 145,
    "contact": "Unmapped fixture contact"
  }
}
```

Response:

```json
[
  {
    "145": true,
    "message": ""
  }
]
```

### 24 — Fields boundary and no-create or unmapped capture readback

Account: service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?searchText%5Broute_id%5D=%5Eoutbound-a-20261024-main%24&range=0-99&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request body:

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
    "status": "Pending",
    "retry_count": 0,
    "error": null,
    "date_creation": "2026-10-24 15:13:27",
    "date_mod": "2026-10-24 15:13:27",
    "done_at": null
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
  }
]
```

### 25 — reject-text-dropdown-mode

Account: service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting; HTTP 400.

Request body:

```json
{
  "input": {
    "route_id": "outbound-a-20261024-reject-text-dropdown-mode",
    "a_entities_id": 9100,
    "entities_id": 0,
    "route_enabled": 1,
    "settings_version": 1,
    "enabled_itemtypes_json": "[\"Computer\"]",
    "field_mappings_json": "[{\"mapping_id\":\"bad_mode\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"text_to_dropdown\"}]"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_UNSUPPORTED_MAPPING: mapping_id=bad_mode"
]
```

### 26 — reject-dropdown-direct-mode

Account: service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting; HTTP 400.

Request body:

```json
{
  "input": {
    "route_id": "outbound-a-20261024-reject-dropdown-direct-mode",
    "a_entities_id": 9100,
    "entities_id": 0,
    "route_enabled": 1,
    "settings_version": 1,
    "enabled_itemtypes_json": "[\"Computer\"]",
    "field_mappings_json": "[{\"mapping_id\":\"bad_mode\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"manufacturers_id\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_UNSUPPORTED_MAPPING: mapping_id=bad_mode"
]
```

### 27 — reject-number-label-mode

Account: service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting; HTTP 400.

Request body:

```json
{
  "input": {
    "route_id": "outbound-a-20261024-reject-number-label-mode",
    "a_entities_id": 9100,
    "entities_id": 0,
    "route_enabled": 1,
    "settings_version": 1,
    "enabled_itemtypes_json": "[\"Computer\"]",
    "field_mappings_json": "[{\"mapping_id\":\"bad_mode\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocnumberfield\"},\"source\":\"A\",\"value_mode\":\"dropdown_label_to_text\"}]"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_UNSUPPORTED_MAPPING: mapping_id=bad_mode"
]
```

### 28 — reject-missing-native

Account: service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting; HTTP 400.

Request body:

```json
{
  "input": {
    "route_id": "outbound-a-20261024-reject-missing-native",
    "a_entities_id": 9100,
    "entities_id": 0,
    "route_enabled": 1,
    "settings_version": 1,
    "enabled_itemtypes_json": "[\"Computer\"]",
    "field_mappings_json": "[{\"mapping_id\":\"absent\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"nonexistent_oc_field\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_UNSUPPORTED_MAPPING: mapping_id=absent"
]
```

### 29 — reject-missing-container

Account: service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting; HTTP 400.

Request body:

```json
{
  "input": {
    "route_id": "outbound-a-20261024-reject-missing-container",
    "a_entities_id": 9100,
    "entities_id": 0,
    "route_enabled": 1,
    "settings_version": 1,
    "enabled_itemtypes_json": "[\"Computer\"]",
    "field_mappings_json": "[{\"mapping_id\":\"absent\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"missing_oc_container\",\"name\":\"text\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_UNSUPPORTED_MAPPING: mapping_id=absent"
]
```

### 30 — reject malformed mapped Fields date before asset save

Account: service; PUT http://localhost:8081/api.php/v1/Computer/145; HTTP 400.

Request body:

```json
{
  "input": {
    "id": 145,
    "c_id": 6,
    "ocdatefield": "2026-02-30"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_CAPTURE_REJECTED: mapping_id=fields_date reason=Invalid stored date format"
]
```

### 31 — reject-readonly-fields

Account: service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting; HTTP 400.

Request body:

```json
{
  "input": {
    "route_id": "outbound-a-20261024-reject-readonly-fields",
    "a_entities_id": 9100,
    "entities_id": 0,
    "route_enabled": 1,
    "settings_version": 1,
    "enabled_itemtypes_json": "[\"Computer\"]",
    "field_mappings_json": "[{\"mapping_id\":\"readonly\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"octextfield\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_UNSUPPORTED_MAPPING: mapping_id=readonly"
]
```

### 32 — changed metadata blocks mapped edit before native or Fields save

Account: service; PUT http://localhost:8081/api.php/v1/Computer/145; HTTP 400.

Request body:

```json
{
  "input": {
    "id": 145,
    "c_id": 6,
    "octextfield": "MUST NOT SAVE READONLY",
    "name": "MUST NOT SAVE NATIVE"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_UPDATE",
  "ASB_CAPTURE_REJECTED: mapping_id=fields_text reason=Fields definition is read-only or multiple"
]
```

### 33 — temporarily disable only new outbound fixture route

Account: service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/6; HTTP 200.

Request body:

```json
{
  "input": {
    "id": 6,
    "route_id": "outbound-a-20261024-main",
    "a_entities_id": 9100,
    "entities_id": 0,
    "route_enabled": 0,
    "settings_version": 2,
    "enabled_itemtypes_json": "[\"Computer\",\"Monitor\",\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\"]",
    "field_mappings_json": "[{\"mapping_id\":\"native_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"native_comment\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"comment\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"native_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"manufacturers_id\"},\"source\":\"A\",\"value_mode\":\"dropdown_label_to_dropdown\"},{\"mapping_id\":\"monitor_name\",\"itemtype\":\"Monitor\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"octextfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_textarea\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"octextareafield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_url\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocurlfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_number\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocnumberfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_yesno\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocyesnofield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_date\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocdatefield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_datetime\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocdatetimefield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_dropdown\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocdropdownfield\"},\"source\":\"A\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"virtual_oc_text\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_text\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_other\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_other\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_date\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_date\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_datetime\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_datetime\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_option\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_option\"},\"source\":\"A\",\"value_mode\":\"text_to_dropdown\"}]"
  }
}
```

Response:

```json
[
  {
    "6": true,
    "message": ""
  }
]
```

### 34 — disabled-route mapped native edit does not capture

Account: service; PUT http://localhost:8081/api.php/v1/Computer/145; HTTP 200.

Request body:

```json
{
  "input": {
    "id": 145,
    "name": "AgentB OC disabled route save"
  }
}
```

Response:

```json
[
  {
    "145": true,
    "message": ""
  }
]
```

### 35 — enable route with Monitor type disabled

Account: service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/6; HTTP 200.

Request body:

```json
{
  "input": {
    "id": 6,
    "route_id": "outbound-a-20261024-main",
    "a_entities_id": 9100,
    "entities_id": 0,
    "route_enabled": 1,
    "settings_version": 3,
    "enabled_itemtypes_json": "[\"Computer\",\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\"]",
    "field_mappings_json": "[{\"mapping_id\":\"native_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"native_comment\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"comment\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"native_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"manufacturers_id\"},\"source\":\"A\",\"value_mode\":\"dropdown_label_to_dropdown\"},{\"mapping_id\":\"monitor_name\",\"itemtype\":\"Monitor\",\"enabled\":false,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"octextfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_textarea\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"octextareafield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_url\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocurlfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_number\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocnumberfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_yesno\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocyesnofield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_date\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocdatefield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_datetime\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocdatetimefield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_dropdown\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocdropdownfield\"},\"source\":\"A\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"virtual_oc_text\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_text\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_other\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_other\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_date\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_date\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_datetime\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_datetime\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_option\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_option\"},\"source\":\"A\",\"value_mode\":\"text_to_dropdown\"}]"
  }
}
```

Response:

```json
[
  {
    "6": true,
    "message": ""
  }
]
```

### 36 — disabled-type Monitor save does not capture

Account: service; PUT http://localhost:8081/api.php/v1/Monitor/1; HTTP 200.

Request body:

```json
{
  "input": {
    "id": 1,
    "name": "AgentB OC disabled type save"
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

### 37 — restore only new outbound fixture full mappings

Account: service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/6; HTTP 200.

Request body:

```json
{
  "input": {
    "id": 6,
    "route_id": "outbound-a-20261024-main",
    "a_entities_id": 9100,
    "entities_id": 0,
    "route_enabled": 1,
    "settings_version": 4,
    "enabled_itemtypes_json": "[\"Computer\",\"Monitor\",\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\"]",
    "field_mappings_json": "[{\"mapping_id\":\"native_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"native_comment\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"comment\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"native_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"manufacturers_id\"},\"source\":\"A\",\"value_mode\":\"dropdown_label_to_dropdown\"},{\"mapping_id\":\"monitor_name\",\"itemtype\":\"Monitor\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"octextfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_textarea\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"octextareafield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_url\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocurlfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_number\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocnumberfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_yesno\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocyesnofield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_date\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocdatefield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_datetime\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocdatetimefield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_dropdown\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocdropdownfield\"},\"source\":\"A\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"virtual_oc_text\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_text\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_other\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_other\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_date\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_date\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_datetime\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_datetime\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_option\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_option\"},\"source\":\"A\",\"value_mode\":\"text_to_dropdown\"}]"
  }
}
```

Response:

```json
[
  {
    "6": true,
    "message": ""
  }
]
```

### 38 — create independent second route for same B entity

Account: service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting; HTTP 201.

Request body:

```json
{
  "input": {
    "route_id": "outbound-a-20261024-second-route",
    "a_entities_id": 9101,
    "entities_id": 0,
    "route_enabled": 1,
    "settings_version": 1,
    "enabled_itemtypes_json": "[\"Computer\"]",
    "field_mappings_json": "[{\"mapping_id\":\"second_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
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

### 39 — one native save yields independent per-route snapshots

Account: service; PUT http://localhost:8081/api.php/v1/Computer/145; HTTP 200.

Request body:

```json
{
  "input": {
    "id": 145,
    "name": "AgentB OC two route save"
  }
}
```

Response:

```json
[
  {
    "145": true,
    "message": ""
  }
]
```

### 40 — disable only fresh second route after per-route proof

Account: service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/7; HTTP 200.

Request body:

```json
{
  "input": {
    "id": 7,
    "route_id": "outbound-a-20261024-second-route",
    "a_entities_id": 9101,
    "entities_id": 0,
    "route_enabled": 0,
    "settings_version": 2,
    "enabled_itemtypes_json": "[\"Computer\"]",
    "field_mappings_json": "[{\"mapping_id\":\"second_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
  }
}
```

Response:

```json
[
  {
    "7": true,
    "message": ""
  }
]
```

### 41 — OC09 targeted retry after custom virtual update fix

Account: service; PUT http://localhost:8081/api.php/v1/Glpi%5CCustomAsset%5CAgentBOC20261024Asset/1; HTTP 200.

Request body:

```json
{
  "input": {
    "id": 1,
    "custom_oc_text": "OC09 after fix text",
    "custom_oc_other": "OC09 sibling changed once",
    "custom_oc_datetime": "2026-10-26 14:15:16",
    "custom_oc_option": 2
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

### 42 — OC09 changed custom scalars and native date format readback

Account: service; GET http://localhost:8081/api.php/v1/Glpi%5CCustomAsset%5CAgentBOC20261024Asset/1?get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request body:

```json
null
```

Response:

```json
{
  "id": 1,
  "assets_assetdefinitions_id": 1,
  "assets_assetmodels_id": 0,
  "assets_assettypes_id": 0,
  "name": "AgentB OC 20261024 custom",
  "uuid": null,
  "comment": null,
  "serial": "AGENTB-OC-CUSTOM",
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
  "date_creation": "2026-10-24 15:13:02",
  "date_mod": "2026-10-24 15:16:50",
  "last_inventory_update": null,
  "custom_fields": "{\"1\": \"OC09 after fix text\", \"2\": \"OC09 sibling changed once\", \"3\": \"2026-10-25\", \"4\": \"2026-10-26 06:15:16\", \"5\": 2}",
  "groups_id": [],
  "groups_id_tech": [],
  "custom_oc_date": "2026-10-25",
  "custom_oc_datetime": "2026-10-26 14:15:16",
  "custom_oc_option": 2,
  "custom_oc_other": "OC09 sibling changed once",
  "custom_oc_text": "OC09 after fix text"
}
```

### 43 — add actual custom core-name selector for targeted OC09 proof

Account: service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/6; HTTP 200.

Request body:

```json
{
  "input": {
    "id": 6,
    "route_id": "outbound-a-20261024-main",
    "a_entities_id": 9100,
    "entities_id": 0,
    "route_enabled": 1,
    "settings_version": 5,
    "enabled_itemtypes_json": "[\"Computer\",\"Monitor\",\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\"]",
    "field_mappings_json": "[{\"mapping_id\":\"native_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"native_comment\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"comment\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"native_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"manufacturers_id\"},\"source\":\"A\",\"value_mode\":\"dropdown_label_to_dropdown\"},{\"mapping_id\":\"monitor_name\",\"itemtype\":\"Monitor\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"octextfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_textarea\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"octextareafield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_url\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocurlfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_number\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocnumberfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_yesno\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocyesnofield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_date\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocdatefield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_datetime\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocdatetimefield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_dropdown\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocdropdownfield\"},\"source\":\"A\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"virtual_oc_text\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_text\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_other\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_other\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_date\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_date\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_datetime\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_datetime\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_option\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_option\"},\"source\":\"A\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"custom_native_name\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
  }
}
```

Response:

```json
[
  {
    "6": true,
    "message": ""
  }
]
```

### 44 — OC09 targeted custom native and one virtual save preserves other virtual fields

Account: service; PUT http://localhost:8081/api.php/v1/Glpi%5CCustomAsset%5CAgentBOC20261024Asset/1; HTTP 200.

Request body:

```json
{
  "input": {
    "id": 1,
    "name": "AgentB OC custom core after fix",
    "custom_oc_text": "OC09 only text changes now"
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

### 45 — OC09 exact new snapshot fields after targeted fix

Account: service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?searchText%5Broute_id%5D=%5Eoutbound-a-20261024-main%24&range=0-99&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request body:

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
  }
]
```

### 46 — reject custom readonly B selector at Setting admission

Account: service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting; HTTP 201.

Request body:

```json
{
  "input": {
    "route_id": "outbound-a-20261024-reject-custom-readonly",
    "a_entities_id": 9100,
    "entities_id": 0,
    "route_enabled": 1,
    "settings_version": 4,
    "enabled_itemtypes_json": "[\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\"]",
    "field_mappings_json": "[{\"mapping_id\":\"readonly_custom\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_other\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
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

### 47 — final Fields saved values after rejected date and readonly edits

Account: service; GET http://localhost:8081/api.php/v1/PluginFieldsComputeragentbocx?range=0-9&get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request body:

```json
null
```

Response:

```json
[
  {
    "id": 1,
    "items_id": 145,
    "itemtype": "Computer",
    "plugin_fields_containers_id": 6,
    "entities_id": 0,
    "octextfield": "Fields-only parent save",
    "octextareafield": "OC multiline initial",
    "ocurlfield": "https://example.com/oc",
    "ocnumberfield": "12.5",
    "ocyesnofield": 1,
    "ocdatefield": "2026-10-24",
    "ocdatetimefield": "2026-10-24 12:34:56",
    "plugin_fields_ocdropdownfielddropdowns_id": 1
  },
  {
    "id": 2,
    "items_id": 146,
    "itemtype": "Computer",
    "plugin_fields_containers_id": 6,
    "entities_id": 0,
    "octextfield": "First storage row edit",
    "octextareafield": null,
    "ocurlfield": null,
    "ocnumberfield": null,
    "ocyesnofield": 0,
    "ocdatefield": null,
    "ocdatetimefield": null,
    "plugin_fields_ocdropdownfielddropdowns_id": 0
  },
  {
    "id": 3,
    "items_id": 147,
    "itemtype": "Computer",
    "plugin_fields_containers_id": 6,
    "entities_id": 0,
    "octextfield": "OC text initial",
    "octextareafield": "OC multiline initial",
    "ocurlfield": "https://example.com/oc",
    "ocnumberfield": "12.5",
    "ocyesnofield": 1,
    "ocdatefield": "2026-10-24",
    "ocdatetimefield": "2026-10-24 12:34:56",
    "plugin_fields_ocdropdownfielddropdowns_id": 1
  }
]
```

### 48 — final custom siblings and native values readback

Account: service; GET http://localhost:8081/api.php/v1/Glpi%5CCustomAsset%5CAgentBOC20261024Asset/1?get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request body:

```json
null
```

Response:

```json
{
  "id": 1,
  "assets_assetdefinitions_id": 1,
  "assets_assetmodels_id": 0,
  "assets_assettypes_id": 0,
  "name": "AgentB OC custom core after fix",
  "uuid": null,
  "comment": null,
  "serial": "AGENTB-OC-CUSTOM",
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
  "date_creation": "2026-10-24 15:13:02",
  "date_mod": "2026-10-24 15:17:25",
  "last_inventory_update": null,
  "custom_fields": "{\"1\": \"OC09 only text changes now\", \"2\": \"OC09 sibling changed once\", \"3\": \"2026-10-25\", \"4\": \"2026-10-26 06:15:16\", \"5\": 2}",
  "groups_id": [],
  "groups_id_tech": [],
  "custom_oc_date": "2026-10-25",
  "custom_oc_datetime": "2026-10-26 14:15:16",
  "custom_oc_option": 2,
  "custom_oc_other": "OC09 sibling changed once",
  "custom_oc_text": "OC09 only text changes now"
}
```

### 49 — contain only fresh OC main route after bounded pass

Account: service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/6; HTTP 200.

Request body:

```json
{
  "input": {
    "id": 6,
    "route_id": "outbound-a-20261024-main",
    "a_entities_id": 9100,
    "entities_id": 0,
    "route_enabled": 0,
    "settings_version": 6,
    "enabled_itemtypes_json": "[\"Computer\",\"Monitor\",\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\"]",
    "field_mappings_json": "[{\"mapping_id\":\"native_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"native_comment\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"comment\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"native_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"manufacturers_id\"},\"source\":\"A\",\"value_mode\":\"dropdown_label_to_dropdown\"},{\"mapping_id\":\"monitor_name\",\"itemtype\":\"Monitor\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"octextfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_textarea\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"octextareafield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_url\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocurlfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_number\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocnumberfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_yesno\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocyesnofield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_date\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocdatefield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_datetime\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocdatetimefield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_dropdown\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocdropdownfield\"},\"source\":\"A\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"virtual_oc_text\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_text\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_other\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_other\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_date\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_date\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_datetime\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_datetime\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_option\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_option\"},\"source\":\"A\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"custom_native_name\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
  }
}
```

Response:

```json
[
  {
    "6": true,
    "message": ""
  }
]
```

### 50 — readback all OC routes disabled with retained mappings

Account: service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting?searchText%5Broute_id%5D=%5Eoutbound-a-20261024-&range=0-99&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request body:

```json
null
```

Response:

```json
[
  {
    "id": 6,
    "route_id": "outbound-a-20261024-main",
    "a_entities_id": 9100,
    "entities_id": 0,
    "route_enabled": 0,
    "settings_version": 6,
    "enabled_itemtypes_json": "[\"Computer\",\"Monitor\",\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\"]",
    "field_mappings_json": "[{\"mapping_id\":\"native_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"native_comment\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"comment\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"native_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"manufacturers_id\"},\"source\":\"A\",\"value_mode\":\"dropdown_label_to_dropdown\"},{\"mapping_id\":\"monitor_name\",\"itemtype\":\"Monitor\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_text\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"octextfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_textarea\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"octextareafield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_url\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocurlfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_number\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocnumberfield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_yesno\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocyesnofield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_date\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocdatefield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_datetime\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocdatetimefield\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"fields_dropdown\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbocx\",\"name\":\"ocdropdownfield\"},\"source\":\"A\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"virtual_oc_text\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_text\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_other\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_other\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_date\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_date\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_datetime\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_datetime\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"virtual_oc_option\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_option\"},\"source\":\"A\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"custom_native_name\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
  },
  {
    "id": 7,
    "route_id": "outbound-a-20261024-second-route",
    "a_entities_id": 9101,
    "entities_id": 0,
    "route_enabled": 0,
    "settings_version": 2,
    "enabled_itemtypes_json": "[\"Computer\"]",
    "field_mappings_json": "[{\"mapping_id\":\"second_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
  },
  {
    "id": 8,
    "route_id": "outbound-a-20261024-reject-custom-readonly",
    "a_entities_id": 9100,
    "entities_id": 0,
    "route_enabled": 1,
    "settings_version": 4,
    "enabled_itemtypes_json": "[\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\"]",
    "field_mappings_json": "[{\"mapping_id\":\"readonly_custom\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_other\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
  }
]
```

### 51 — final all OC snapshots retain exact IDs and selected helper status

Account: service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?searchText%5Broute_id%5D=%5Eoutbound-a-20261024-&range=0-99&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request body:

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
  }
]
```

### 52 — close service session after outbound capture pass

Account: service; GET http://localhost:8081/api.php/v1/killSession; HTTP 200.

Request body:

```json
null
```

Response:

```json
true
```

### 53 — containment login for unexpected readonly fixture

Account: service; GET http://localhost:8081/api.php/v1/initSession; HTTP 200.

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

### 54 — disable only unexpected custom readonly fixture Setting8

Account: service; PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/8; HTTP 200.

Request body:

```json
{
  "input": {
    "id": 8,
    "route_id": "outbound-a-20261024-reject-custom-readonly",
    "a_entities_id": 9100,
    "entities_id": 0,
    "route_enabled": 0,
    "settings_version": 5,
    "enabled_itemtypes_json": "[\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\"]",
    "field_mappings_json": "[{\"mapping_id\":\"readonly_custom\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_other\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
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

### 55 — unexpected custom readonly fixture disabled readback

Account: service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/8?get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request body:

```json
null
```

Response:

```json
{
  "id": 8,
  "route_id": "outbound-a-20261024-reject-custom-readonly",
  "a_entities_id": 9100,
  "entities_id": 0,
  "route_enabled": 0,
  "settings_version": 5,
  "enabled_itemtypes_json": "[\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\"]",
  "field_mappings_json": "[{\"mapping_id\":\"readonly_custom\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_other\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
}
```

### 56 — containment session logout

Account: service; GET http://localhost:8081/api.php/v1/killSession; HTTP 200.

Request body:

```json
null
```

Response:

```json
true
```

### 57 — OC15 targeted fix service login

Account: service; GET http://localhost:8081/api.php/v1/initSession; HTTP 200.

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

### 58 — OC15 targeted current-profile readonly selector rejected

Account: service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting; HTTP 400.

Request body:

```json
{
  "input": {
    "route_id": "outbound-a-20261024-oc15-current",
    "a_entities_id": 9100,
    "entities_id": 0,
    "route_enabled": 0,
    "settings_version": 1,
    "enabled_itemtypes_json": "[\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\"]",
    "field_mappings_json": "[{\"mapping_id\":\"readonly_custom\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_other\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_UNSUPPORTED_MAPPING: mapping_id=readonly_custom"
]
```

### 59 — OC15 targeted all-profiles readonly selector rejected

Account: service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting; HTTP 400.

Request body:

```json
{
  "input": {
    "route_id": "outbound-a-20261024-oc15-all",
    "a_entities_id": 9100,
    "entities_id": 0,
    "route_enabled": 0,
    "settings_version": 1,
    "enabled_itemtypes_json": "[\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\"]",
    "field_mappings_json": "[{\"mapping_id\":\"readonly_custom\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_other\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
  }
}
```

Response:

```json
[
  "ERROR_GLPI_ADD",
  "ASB_UNSUPPORTED_MAPPING: mapping_id=readonly_custom"
]
```

### 60 — OC15 false effective restriction control admitted already disabled

Account: service; POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting; HTTP 201.

Request body:

```json
{
  "input": {
    "route_id": "outbound-a-20261024-oc15-false-control",
    "a_entities_id": 9100,
    "entities_id": 0,
    "route_enabled": 0,
    "settings_version": 1,
    "enabled_itemtypes_json": "[\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\"]",
    "field_mappings_json": "[{\"mapping_id\":\"readonly_custom\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_other\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
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

### 61 — OC15 false control disabled readback

Account: service; GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/9?get_hateoas=false&expand_dropdowns=false; HTTP 200.

Request body:

```json
null
```

Response:

```json
{
  "id": 9,
  "route_id": "outbound-a-20261024-oc15-false-control",
  "a_entities_id": 9100,
  "entities_id": 0,
  "route_enabled": 0,
  "settings_version": 1,
  "enabled_itemtypes_json": "[\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\"]",
  "field_mappings_json": "[{\"mapping_id\":\"readonly_custom\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBOC20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_oc_other\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
}
```

### 62 — OC15 targeted session logout

Account: service; GET http://localhost:8081/api.php/v1/killSession; HTTP 200.

Request body:

```json
null
```

Response:

```json
true
```

## Local native-method operator ledger

### Local 1 — Create fresh custom asset definition and initialize only new test profile rights

User context: 2; exit 255.

```php
Session::changeProfile(4); $d=new \Glpi\Asset\AssetDefinition(); $id=$d->add(['system_name'=>'AgentBOC20261024','label'=>'AgentB OC 20261024','is_active'=>1,'profiles'=>[14=>7]]); echo json_encode(['definition_id'=>$id,'classname'=>$id?$d->getCustomObjectClassName():null,'profile'=>$_SESSION['glpiactiveprofile']['id']]); if($id){ProfileRight::updateProfileRights(14,['monitor'=>7,'dropdown'=>1]);}
```

Result:

```text

PHP Fatal error:  Uncaught Error: Class "Auth" not found in Standard input code:1
Stack trace:
#0 {main}
  thrown in Standard input code on line 1

```

### Local 2 — Create fresh custom asset definition and initialize only new test profile rights after correcting CLI bootstrap

User context: 2; exit 0.

```php
Session::changeProfile(4); $d=new \Glpi\Asset\AssetDefinition(); $id=$d->add(['system_name'=>'AgentBOC20261024','label'=>'AgentB OC 20261024','is_active'=>1,'profiles'=>[14=>7]]); if($id){ProfileRight::updateProfileRights(14,['monitor'=>7,'dropdown'=>1]);} echo json_encode(['definition_id'=>$id,'classname'=>$id?$d->getCustomObjectClassName():null,'profile'=>$_SESSION['glpiactiveprofile']['id']]);
```

Result:

```text
{"definition_id":1,"classname":"Glpi\\CustomAsset\\AgentBOC20261024Asset","profile":4}

```

### Local 3 — Create fresh custom scalar definitions

User context: 2; exit 0.

```php
$d=new \Glpi\Asset\AssetDefinition();$d->getFromDB(1);$rows=[];foreach([['oc_text','StringType'],['oc_other','StringType'],['oc_date','DateType'],['oc_datetime','DateTimeType'],['oc_option','DropdownType']] as [$name,$type]){$f=new \Glpi\Asset\CustomFieldDefinition();$id=$f->add(['assets_assetdefinitions_id'=>1,'system_name'=>$name,'label'=>$name,'type'=>'Glpi\\Asset\\CustomFieldType\\'.$type,'itemtype'=>$type==='DropdownType'?'Manufacturer':null,'field_options'=>[]]);$rows[]=['id'=>$id,'system_name'=>$name,'saved'=>$id?$f->fields:null];}echo json_encode($rows);
```

Result:

```text
[{"id":1,"system_name":"oc_text","saved":{"id":1,"assets_assetdefinitions_id":1,"system_name":"oc_text","label":"oc_text","type":"Glpi\\Asset\\CustomFieldType\\StringType","field_options":[],"itemtype":null,"default_value":null,"translations":"[]","date_creation":"2026-10-24 15:12:07","date_mod":"2026-10-24 15:12:07"}},{"id":2,"system_name":"oc_other","saved":{"id":2,"assets_assetdefinitions_id":1,"system_name":"oc_other","label":"oc_other","type":"Glpi\\Asset\\CustomFieldType\\StringType","field_options":[],"itemtype":null,"default_value":null,"translations":"[]","date_creation":"2026-10-24 15:12:07","date_mod":"2026-10-24 15:12:07"}},{"id":3,"system_name":"oc_date","saved":{"id":3,"assets_assetdefinitions_id":1,"system_name":"oc_date","label":"oc_date","type":"Glpi\\Asset\\CustomFieldType\\DateType","field_options":[],"itemtype":null,"default_value":null,"translations":"[]","date_creation":"2026-10-24 15:12:07","date_mod":"2026-10-24 15:12:07"}},{"id":4,"system_name":"oc_datetime","saved":{"id":4,"assets_assetdefinitions_id":1,"system_name":"oc_datetime","label":"oc_datetime","type":"Glpi\\Asset\\CustomFieldType\\DateTimeType","field_options":[],"itemtype":null,"default_value":null,"translations":"[]","date_creation":"2026-10-24 15:12:07","date_mod":"2026-10-24 15:12:07"}},{"id":5,"system_name":"oc_option","saved":{"id":5,"assets_assetdefinitions_id":1,"system_name":"oc_option","label":"oc_option","type":"Glpi\\Asset\\CustomFieldType\\DropdownType","field_options":[],"itemtype":"Manufacturer","default_value":null,"translations":"[]","date_creation":"2026-10-24 15:12:07","date_mod":"2026-10-24 15:12:07"}}]

```

### Local 4 — Create fresh Fields tab container and immediately restrict its new profile associations

User context: 2; exit 0.

```php
Session::changeProfile(4);$c=new PluginFieldsContainer();$id=$c->add(['label'=>'AgentB OC X','itemtypes'=>['Computer'],'type'=>'tab','subtype'=>'','entities_id'=>0,'is_recursive'=>0,'is_active'=>1]);$before=$after=[];if($id){$fp=new PluginFieldsProfile();$before=array_values($fp->find(['plugin_fields_containers_id'=>$id]));$rights=[];foreach($before as $r){$rights[(int)$r['profiles_id']]=(int)$r['profiles_id']===14?CREATE:0;}PluginFieldsProfile::updateProfile(['plugin_fields_containers_id'=>$id,'rights'=>$rights]);$after=array_values($fp->find(['plugin_fields_containers_id'=>$id]));}echo json_encode(['id'=>$id,'container'=>$c->fields,'new_associations_before'=>$before,'new_associations_after'=>$after]);
```

Result:

```text
{"id":6,"container":{"id":6,"name":"agentbocx","label":"AgentB OC X","itemtypes":"[\"Computer\"]","type":"tab","subtype":"","entities_id":0,"is_recursive":0,"is_active":1},"new_associations_before":[{"id":50,"profiles_id":1,"plugin_fields_containers_id":6,"right":"4"},{"id":51,"profiles_id":2,"plugin_fields_containers_id":6,"right":"4"},{"id":52,"profiles_id":3,"plugin_fields_containers_id":6,"right":"4"},{"id":53,"profiles_id":4,"plugin_fields_containers_id":6,"right":"4"},{"id":54,"profiles_id":5,"plugin_fields_containers_id":6,"right":"4"},{"id":55,"profiles_id":6,"plugin_fields_containers_id":6,"right":"4"},{"id":56,"profiles_id":7,"plugin_fields_containers_id":6,"right":"4"},{"id":57,"profiles_id":8,"plugin_fields_containers_id":6,"right":"4"},{"id":58,"profiles_id":9,"plugin_fields_containers_id":6,"right":"4"},{"id":59,"profiles_id":10,"plugin_fields_containers_id":6,"right":"4"},{"id":60,"profiles_id":11,"plugin_fields_containers_id":6,"right":"4"},{"id":61,"profiles_id":12,"plugin_fields_containers_id":6,"right":"4"},{"id":62,"profiles_id":13,"plugin_fields_containers_id":6,"right":"4"},{"id":63,"profiles_id":14,"plugin_fields_containers_id":6,"right":"4"},{"id":64,"profiles_id":15,"plugin_fields_containers_id":6,"right":"4"}],"new_associations_after":[{"id":50,"profiles_id":1,"plugin_fields_containers_id":6,"right":"0"},{"id":51,"profiles_id":2,"plugin_fields_containers_id":6,"right":"0"},{"id":52,"profiles_id":3,"plugin_fields_containers_id":6,"right":"0"},{"id":53,"profiles_id":4,"plugin_fields_containers_id":6,"right":"0"},{"id":54,"profiles_id":5,"plugin_fields_containers_id":6,"right":"0"},{"id":55,"profiles_id":6,"plugin_fields_containers_id":6,"right":"0"},{"id":56,"profiles_id":7,"plugin_fields_containers_id":6,"right":"0"},{"id":57,"profiles_id":8,"plugin_fields_containers_id":6,"right":"0"},{"id":58,"profiles_id":9,"plugin_fields_containers_id":6,"right":"0"},{"id":59,"profiles_id":10,"plugin_fields_containers_id":6,"right":"0"},{"id":60,"profiles_id":11,"plugin_fields_containers_id":6,"right":"0"},{"id":61,"profiles_id":12,"plugin_fields_containers_id":6,"right":"0"},{"id":62,"profiles_id":13,"plugin_fields_containers_id":6,"right":"0"},{"id":63,"profiles_id":14,"plugin_fields_containers_id":6,"right":"4"},{"id":64,"profiles_id":15,"plugin_fields_containers_id":6,"right":"0"}]}

```

### Local 5 — Create scalar and dropdown fields only in fresh Fields container

User context: 2; exit 0.

```php
Session::changeProfile(4);$rows=[];foreach(['text','textarea','url','number','yesno','date','datetime','dropdown'] as $type){$f=new PluginFieldsField();$id=$f->add(['plugin_fields_containers_id'=>6,'label'=>'OC '.$type,'type'=>$type,'is_active'=>1,'is_readonly'=>0,'multiple'=>0,'mandatory'=>0]);$rows[]=$id?$f->fields:['id'=>false,'type'=>$type];}echo json_encode($rows);
```

Result:

```text
[{"id":46,"name":"octextfield","label":"OC text","type":"text","plugin_fields_containers_id":6,"ranking":1,"default_value":null,"is_active":1,"is_readonly":0,"mandatory":0,"multiple":0,"allowed_values":null},{"id":47,"name":"octextareafield","label":"OC textarea","type":"textarea","plugin_fields_containers_id":6,"ranking":1,"default_value":null,"is_active":1,"is_readonly":0,"mandatory":0,"multiple":0,"allowed_values":null},{"id":48,"name":"ocurlfield","label":"OC url","type":"url","plugin_fields_containers_id":6,"ranking":1,"default_value":null,"is_active":1,"is_readonly":0,"mandatory":0,"multiple":0,"allowed_values":null},{"id":49,"name":"ocnumberfield","label":"OC number","type":"number","plugin_fields_containers_id":6,"ranking":1,"default_value":null,"is_active":1,"is_readonly":0,"mandatory":0,"multiple":0,"allowed_values":null},{"id":50,"name":"ocyesnofield","label":"OC yesno","type":"yesno","plugin_fields_containers_id":6,"ranking":1,"default_value":null,"is_active":1,"is_readonly":0,"mandatory":0,"multiple":0,"allowed_values":null},{"id":51,"name":"ocdatefield","label":"OC date","type":"date","plugin_fields_containers_id":6,"ranking":1,"default_value":null,"is_active":1,"is_readonly":0,"mandatory":0,"multiple":0,"allowed_values":null},{"id":52,"name":"ocdatetimefield","label":"OC datetime","type":"datetime","plugin_fields_containers_id":6,"ranking":1,"default_value":null,"is_active":1,"is_readonly":0,"mandatory":0,"multiple":0,"allowed_values":null},{"id":53,"name":"ocdropdownfield","label":"OC dropdown","type":"dropdown","plugin_fields_containers_id":6,"ranking":1,"default_value":null,"is_active":1,"is_readonly":0,"mandatory":0,"multiple":0,"allowed_values":null}]

```

### Local 6 — Create fresh readable option fixtures and inspect generated Fields resource

User context: 2; exit 0.

```php
Session::changeProfile(4);$m=new Manufacturer();$mid=$m->add(['name'=>'AgentB OC Manufacturer']);$f=new PluginFieldsField();$f->getFromDB(53);$cls=PluginFieldsDropdown::getClassname($f->fields['name']);$o=new $cls();$oid=$o->add(['name'=>'AgentB OC Choice','entities_id'=>0,'is_recursive'=>0]);$c=new PluginFieldsContainer();$c->getFromDB(6);echo json_encode(['manufacturer'=>$mid,'fields_option'=>$oid,'dropdown_class'=>$cls,'storage_class'=>PluginFieldsContainer::getClassname('Computer',$c->fields['name']),'container'=>$c->fields]);
```

Result:

```text
{"manufacturer":1,"fields_option":1,"dropdown_class":"PluginFieldsOcdropdownfieldDropdown","storage_class":"PluginFieldsComputeragentbocx","container":{"id":6,"name":"agentbocx","label":"AgentB OC X","itemtypes":"[\"Computer\"]","type":"tab","subtype":"","entities_id":0,"is_recursive":0,"is_active":1}}

```

### Local 7 — Read custom asset registration and capture hook metadata only

User context: 12; exit 0.

```php
$type='Glpi\\CustomAsset\\AgentBOC20261024Asset';$x=new $type();$x->getFromDB(1);echo json_encode(['type'=>$type,'registered'=>in_array($type,$CFG_GLPI['asset_types'],true),'prehook'=>$PLUGIN_HOOKS['pre_item_update']['agentbdmosassetsync'][$type]??null,'posthook'=>$PLUGIN_HOOKS['item_update']['agentbdmosassetsync'][$type]??null,'fields'=>$x->fields]);
```

Result:

```text
{"type":"Glpi\\CustomAsset\\AgentBOC20261024Asset","registered":true,"prehook":null,"posthook":null,"fields":{"id":1,"assets_assetdefinitions_id":1,"assets_assetmodels_id":0,"assets_assettypes_id":0,"name":"AgentB OC 20261024 custom","uuid":null,"comment":null,"serial":"AGENTB-OC-CUSTOM","otherserial":null,"contact":null,"contact_num":null,"users_id":0,"users_id_tech":0,"locations_id":0,"manufacturers_id":0,"states_id":0,"entities_id":0,"is_recursive":0,"is_deleted":0,"is_template":0,"is_dynamic":0,"template_name":null,"autoupdatesystems_id":0,"date_creation":"2026-10-24 15:13:02","date_mod":"2026-10-24 15:13:27","last_inventory_update":null,"custom_fields":"{\"1\": \"Changed virtual text\", \"2\": \"Sibling\", \"3\": \"2026-10-25\", \"4\": \"2026-10-25 05:14:15\", \"5\": 1}","groups_id":[],"groups_id_tech":[],"custom_oc_date":"2026-10-25","custom_oc_datetime":"2026-10-25 13:14:15","custom_oc_option":1,"custom_oc_other":"Sibling","custom_oc_text":"Changed virtual text"}}

```

### Local 8 — Read hook registry after native Plugin init, no writes

User context: 12; exit 0.

```php
(new Plugin())->init();$type='Glpi\\CustomAsset\\AgentBOC20261024Asset';$x=new $type();echo json_encode(['asked_type'=>$type,'actual_class'=>get_class($x),'type_method'=>$x::getType(),'registered'=>in_array($type,$CFG_GLPI['asset_types'],true),'canonical_registered'=>in_array(get_class($x),$CFG_GLPI['asset_types'],true),'pre_keys'=>array_keys($PLUGIN_HOOKS['pre_item_update']['agentbdmosassetsync']??[]),'post_keys'=>array_keys($PLUGIN_HOOKS['item_update']['agentbdmosassetsync']??[])]);
```

Result:

```text
{"asked_type":"Glpi\\CustomAsset\\AgentBOC20261024Asset","actual_class":"Glpi\\CustomAsset\\AgentBOC20261024Asset","type_method":"Glpi\\CustomAsset\\AgentBOC20261024Asset","registered":true,"canonical_registered":true,"pre_keys":["Computer","Monitor","NetworkEquipment","Peripheral","Phone","Printer","SoftwareLicense","Certificate","Unmanaged","Appliance","PluginFieldsComputerdmosasset","PluginFieldsComputerworkshopagentvalue","PluginFieldsComputercedarcomputervalue","PluginFieldsPrintercedarprintervalue","PluginFieldsComputernativerestqascalarsb","PluginFieldsComputeragentbocx","Glpi\\CustomAsset\\AgentBOC20261024Asset"],"post_keys":["Computer","Monitor","NetworkEquipment","Peripheral","Phone","Printer","SoftwareLicense","Certificate","Unmanaged","Appliance","PluginFieldsComputerdmosasset","PluginFieldsComputerworkshopagentvalue","PluginFieldsComputercedarcomputervalue","PluginFieldsPrintercedarprintervalue","PluginFieldsComputernativerestqascalarsb","PluginFieldsComputeragentbocx","Glpi\\CustomAsset\\AgentBOC20261024Asset"]}

```

### Local 9 — Nested sync guard, false return and exception release, then immediate genuine capture

User context: 12; exit 0.

```php
(new Plugin())->init(); $x=new Computer();$x->getFromDB(145);$before=countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),['route_id'=>'outbound-a-20261024-main']);$r=plugin_agentbdmosassetsync_sync_guard(function()use($x){$x->update(['id'=>145,'name'=>'AgentB OC guarded name']);return plugin_agentbdmosassetsync_sync_guard(fn()=>$x->update(['id'=>145,'comment'=>'Guarded comment']));});$afterGuard=countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),['route_id'=>'outbound-a-20261024-main']);try{plugin_agentbdmosassetsync_sync_guard(fn()=>throw new RuntimeException('fixture guard failure'));}catch(RuntimeException $e){}$false=plugin_agentbdmosassetsync_sync_guard(fn()=>false);$released=!plugin_agentbdmosassetsync_is_sync_write();$genuine=$x->update(['id'=>145,'name'=>'AgentB OC genuine after guard']);$afterGenuine=countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),['route_id'=>'outbound-a-20261024-main']);echo json_encode(compact('before','r','afterGuard','false','released','genuine','afterGenuine'));
```

Result:

```text
{"before":8,"r":true,"afterGuard":8,"false":false,"released":true,"genuine":true,"afterGenuine":9}

```

### Local 10 — Prove exact selected genuine Pending helper transition preserving unselected snapshot

User context: 12; exit 255.

```php
(new Plugin())->init(); $before=[];foreach([1,2] as $id){$c=new PluginAgentbdmosassetsyncChange();$c->getFromDB($id);$before[$id]=$c->fields;}$done=plugin_agentbdmosassetsync_markQueueRowsDone([1]);$after=[];foreach([1,2] as $id){$c=new PluginAgentbdmosassetsyncChange();$c->getFromDB($id);$after[$id]=$c->fields;}echo json_encode(compact('before','done','after'));
```

Result:

```text
Symfony\Component\ErrorHandler\Error\UndefinedFunctionError {#174
  #message: "Attempted to call function "plugin_agentbdmosassetsync_markQueueRowsDone" from the global namespace."
  #code: 0
  #file: "Standard input code"
  #line: 1
}


```

### Local 11 — Exact selected genuine Pending helper transition using actual declared helper name

User context: 12; exit 0.

```php
(new Plugin())->init(); $before=[];foreach([1,2] as $id){$c=new PluginAgentbdmosassetsyncChange();$c->getFromDB($id);$before[$id]=$c->fields;}$done=markQueueRowsDone([1]);$after=[];foreach([1,2] as $id){$c=new PluginAgentbdmosassetsyncChange();$c->getFromDB($id);$after[$id]=$c->fields;}echo json_encode(compact('before','done','after'));
```

Result:

```text
{"before":{"1":{"id":1,"route_id":"outbound-a-20261024-main","settings_version":1,"a_entities_id":9100,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":null,\"b_items_id\":145,\"serial\":\"AGENTB-OC-MAIN\"}","changed_fields_json":"{\"native_name\":{\"value\":\"AgentB OC native edit one\",\"changed_at\":\"2026-10-24T15:13:27+08:00\",\"reliable\":true},\"native_comment\":{\"value\":\"Captured comment\",\"changed_at\":\"2026-10-24T15:13:27+08:00\",\"reliable\":true},\"native_option\":{\"value\":\"AgentB OC Manufacturer\",\"changed_at\":\"2026-10-24T15:13:27+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 15:13:27","date_mod":"2026-10-24 15:13:27","done_at":null},"2":{"id":2,"route_id":"outbound-a-20261024-main","settings_version":1,"a_entities_id":9100,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":null,\"b_items_id\":145,\"serial\":\"AGENTB-OC-MAIN\"}","changed_fields_json":"{\"native_name\":{\"value\":\"AgentB OC native edit two\",\"changed_at\":\"2026-10-24T15:13:27+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 15:13:27","date_mod":"2026-10-24 15:13:27","done_at":null}},"done":{"1":true},"after":{"1":{"id":1,"route_id":"outbound-a-20261024-main","settings_version":1,"a_entities_id":9100,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":null,\"b_items_id\":145,\"serial\":\"AGENTB-OC-MAIN\"}","changed_fields_json":"{\"native_name\":{\"value\":\"AgentB OC native edit one\",\"changed_at\":\"2026-10-24T15:13:27+08:00\",\"reliable\":true},\"native_comment\":{\"value\":\"Captured comment\",\"changed_at\":\"2026-10-24T15:13:27+08:00\",\"reliable\":true},\"native_option\":{\"value\":\"AgentB OC Manufacturer\",\"changed_at\":\"2026-10-24T15:13:27+08:00\",\"reliable\":true}}","status":"Done","retry_count":0,"error":null,"date_creation":"2026-10-24 15:13:27","date_mod":"2026-10-24 15:16:16","done_at":"2026-10-24 15:16:16"},"2":{"id":2,"route_id":"outbound-a-20261024-main","settings_version":1,"a_entities_id":9100,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":null,\"b_items_id\":145,\"serial\":\"AGENTB-OC-MAIN\"}","changed_fields_json":"{\"native_name\":{\"value\":\"AgentB OC native edit two\",\"changed_at\":\"2026-10-24T15:13:27+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 15:13:27","date_mod":"2026-10-24 15:13:27","done_at":null}}}

```

### Local 12 — Temporarily make only fresh text field readonly for metadata gate proof

User context: 2; exit 255.

```php
(new Plugin())->init(); $f=new PluginFieldsField();$ok=$f->update(['id':46,'is_readonly'=>1]);$f->getFromDB(46);echo json_encode(['saved'=>$ok,'field'=>$f->fields]);
```

Result:

```text

PHP Parse error:  syntax error, unexpected token ":", expecting "]" in Standard input code on line 1

```

### Local 13 — Temporarily make only fresh text field readonly after correcting local PHP syntax

User context: 2; exit 0.

```php
(new Plugin())->init(); $f=new PluginFieldsField();$ok=$f->update(['id'=>46,'is_readonly'=>1]);$f->getFromDB(46);echo json_encode(['saved'=>$ok,'field'=>$f->fields]);
```

Result:

```text
{"saved":true,"field":{"id":46,"name":"octextfield","label":"OC text","type":"text","plugin_fields_containers_id":6,"ranking":1,"default_value":null,"is_active":1,"is_readonly":1,"mandatory":0,"multiple":0,"allowed_values":null}}

```

### Local 14 — Restore writable metadata only on fresh text field

User context: 2; exit 0.

```php
(new Plugin())->init(); $f=new PluginFieldsField();$ok=$f->update(['id'=>46,'is_readonly'=>0]);$f->getFromDB(46);echo json_encode(['saved'=>$ok,'field'=>$f->fields]);
```

Result:

```text
{"saved":true,"field":{"id":46,"name":"octextfield","label":"OC text","type":"text","plugin_fields_containers_id":6,"ranking":1,"default_value":null,"is_active":1,"is_readonly":0,"mandatory":0,"multiple":0,"allowed_values":null}}

```

### Local 15 — Create second fresh Manufacturer option for custom dropdown changed-value proof

User context: 2; exit 0.

```php
(new Plugin())->init(); Session::changeProfile(4);$m=new Manufacturer();$id=$m->add(['name'=>'AgentB OC Manufacturer Two']);echo json_encode(['id'=>$id]);
```

Result:

```text
{"id":2}

```

### Local 16 — Local trusted capture rejects empty changed fields without creating row

User context: 12; exit 0.

```php
(new Plugin())->init(); $c=new PluginAgentbdmosassetsyncChange();try{$c->createCapturedChange(['route_id'=>'outbound-a-20261024-main','settings_version'=>5,'a_entities_id'=>9100,'entities_id'=>0,'itemtype'=>'Computer','identity_json'=>'{"a_items_id":null,"b_items_id":145,"serial":"AGENTB-OC-MAIN"}','changed_fields_json'=>'{}']);echo json_encode(['unexpected'=>'accepted']);}catch(Throwable $e){echo json_encode(['rejected'=>$e->getMessage()]);}
```

Result:

```text
{"rejected":"ASB_INVALID_FIELD: field=changed_fields_json"}

```

### Local 17 — Fresh out-of-route entity Computer creation and native edit produce no capture

User context: 14; exit 0.

```php
(new Plugin())->init(); $x=new Computer();$id=$x->add(['name'=>'AgentB OC outside entity','serial'=>'AGENTB-OC-OUTSIDE','entities_id'=>5]);$before=countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[]);$changed=$x->update(['id'=>$id,'name'=>'AgentB OC outside entity edited']);$after=countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[]);$x->getFromDB($id);echo json_encode(['id'=>$id,'before'=>$before,'changed'=>$changed,'after'=>$after,'asset'=>$x->fields]);
```

Result:

```text
{"id":148,"before":13,"changed":true,"after":13,"asset":{"id":148,"entities_id":5,"name":"AgentB OC outside entity edited","serial":"AGENTB-OC-OUTSIDE","otherserial":null,"contact":null,"contact_num":null,"users_id_tech":0,"comment":null,"date_mod":"2026-10-24 15:17:25","autoupdatesystems_id":0,"locations_id":0,"networks_id":0,"computermodels_id":0,"computertypes_id":0,"is_template":0,"template_name":null,"manufacturers_id":0,"is_deleted":0,"is_dynamic":0,"users_id":0,"states_id":0,"ticket_tco":"0.0000","uuid":null,"date_creation":"2026-10-24 15:17:25","is_recursive":0,"last_inventory_update":null,"last_boot":null,"groups_id":[],"groups_id_tech":[]}}

```

### Local 18 — Temporarily restrict only fresh custom sibling field for capability admission proof

User context: 2; exit 0.

```php
(new Plugin())->init(); $f=new \Glpi\Asset\CustomFieldDefinition();$ok=$f->update(['id'=>2,'field_options'=>['readonly'=>[14]]]);$f->getFromDB(2);echo json_encode(['saved'=>$ok,'field'=>$f->fields]);
```

Result:

```text
{"saved":true,"field":{"id":2,"assets_assetdefinitions_id":1,"system_name":"oc_other","label":"oc_other","type":"Glpi\\Asset\\CustomFieldType\\StringType","field_options":{"readonly":[14]},"itemtype":null,"default_value":null,"translations":"[]","date_creation":"2026-10-24 15:12:07","date_mod":"2026-10-24 15:18:33"}}

```

### Local 19 — Restore only fresh custom field writable options

User context: 2; exit 0.

```php
(new Plugin())->init(); $f=new \Glpi\Asset\CustomFieldDefinition();$ok=$f->update(['id'=>2,'field_options'=>[]]);$f->getFromDB(2);echo json_encode(['saved'=>$ok,'field'=>$f->fields]);
```

Result:

```text
{"saved":true,"field":{"id":2,"assets_assetdefinitions_id":1,"system_name":"oc_other","label":"oc_other","type":"Glpi\\Asset\\CustomFieldType\\StringType","field_options":[],"itemtype":null,"default_value":null,"translations":"[]","date_creation":"2026-10-24 15:12:07","date_mod":"2026-10-24 15:18:33"}}

```

### Local 20 — OC15 restrict fresh custom field to current profile14

User context: 2; exit 0.

```php
(new Plugin())->init(); $f=new \Glpi\Asset\CustomFieldDefinition();$f->update(['id'=>2,'field_options'=>['readonly'=>[14]]]);$f->getFromDB(2);echo json_encode($f->fields);
```

Result:

```text
{"id":2,"assets_assetdefinitions_id":1,"system_name":"oc_other","label":"oc_other","type":"Glpi\\Asset\\CustomFieldType\\StringType","field_options":{"readonly":[14]},"itemtype":null,"default_value":null,"translations":"[]","date_creation":"2026-10-24 15:12:07","date_mod":"2026-10-24 15:20:48"}

```

### Local 21 — OC15 restrict fresh custom field to all profiles sentinel

User context: 2; exit 0.

```php
(new Plugin())->init(); $f=new \Glpi\Asset\CustomFieldDefinition();$f->update(['id'=>2,'field_options'=>['readonly'=>[-1]]]);$f->getFromDB(2);echo json_encode($f->fields);
```

Result:

```text
{"id":2,"assets_assetdefinitions_id":1,"system_name":"oc_other","label":"oc_other","type":"Glpi\\Asset\\CustomFieldType\\StringType","field_options":{"readonly":[-1]},"itemtype":null,"default_value":null,"translations":"[]","date_creation":"2026-10-24 15:12:07","date_mod":"2026-10-24 15:20:48"}

```

### Local 22 — OC15 false restriction control uses only other profile15

User context: 2; exit 0.

```php
(new Plugin())->init(); $f=new \Glpi\Asset\CustomFieldDefinition();$f->update(['id'=>2,'field_options'=>['readonly'=>[15]]]);$f->getFromDB(2);echo json_encode($f->fields);
```

Result:

```text
{"id":2,"assets_assetdefinitions_id":1,"system_name":"oc_other","label":"oc_other","type":"Glpi\\Asset\\CustomFieldType\\StringType","field_options":{"readonly":[15]},"itemtype":null,"default_value":null,"translations":"[]","date_creation":"2026-10-24 15:12:07","date_mod":"2026-10-24 15:20:48"}

```

### Local 23 — OC15 restore only fresh custom field options after targeted cases

User context: 2; exit 0.

```php
(new Plugin())->init(); $f=new \Glpi\Asset\CustomFieldDefinition();$f->update(['id'=>2,'field_options'=>[]]);$f->getFromDB(2);echo json_encode($f->fields);
```

Result:

```text
{"id":2,"assets_assetdefinitions_id":1,"system_name":"oc_other","label":"oc_other","type":"Glpi\\Asset\\CustomFieldType\\StringType","field_options":[],"itemtype":null,"default_value":null,"translations":"[]","date_creation":"2026-10-24 15:12:07","date_mod":"2026-10-24 15:20:48"}

```

