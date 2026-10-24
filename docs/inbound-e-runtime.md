# Agent B final inbound Both (e) manual runtime evidence

2026-10-24 Asia/Brunei (+08:00), GLPI11.0.7, Fields1.24.4. **40 manual curls +18 native CLI PHP invocations**, one bounded pass, no implementation defect or source retry. Approved deployment only inc/process.php, inc/write.php, inc/results.php, inc/fields.php, inc/firstcopy.php, inc/both.php from agentb-inbound-e; later separately approved root hook.php description-only integration. Kept current setup/capture/Work/Change/scope. No repository edits/commit, automated regression harness, new HTTP endpoint, raw DML, delete/purge, old plugin or unrelated asset operations.

## Actual fixtures and scope

Fresh Computer157 (AGENTB-IE-MAIN), Fields container11 agentbiex fields69/70 text and71 number, generated storage PluginFieldsComputeragentbiex row1. Native number field here is actually Fields varchar(255), raw1.00; do not call it a physical SQL DECIMAL column. Fresh custom definition5 Glpi\CustomAsset\AgentBIE20261024Asset, text definition18 and NumberType19 (default integer step1), fixture asset6 (AGENTB-IE-CUSTOM), precision firstcopy asset7 (AGENTB-IE-SEED). New Manufacturer8 label AgentB IE Maker B; existing permitted option7 used for winning lookup. Setting15 route inbound-e-20261024-main A9600/B0; Setting16 isolated seed route A9601/B0, both finish disabled/version2. New Fields association defaults immediately restricted to0 for every profile except14 right4 before HTTP fixtures.

Works90–111:12 Done,9 Held,1 Failed. Native/Fields/custom equality90/91 confirms1 versus rawJSON1.0/1.00 without field times; all AlreadyEqual, no winner time/return invented, no field save/echo (History at that stage contains only initial native add/storage creation). Queue baseline30.

## Genuine times, independent winners and rights

Simulated A earlier event16:51:44+08 recorded before real B native/Fields/custom saves31–33 at16:52:02+08; later simulated A event16:52:37+08 recorded after actual wait. No database timestamps edited. Work92 independently writes newer A native name and Fields text, returns newer B comment/Fields text/dropdown original16:52:02 evidence, preserves equal text/number, and Conflicts unequal no-B-clock field. Work Held retains honest partial writes and returns. Original multi-field snapshots31/32 not fully represented, covered IDs empty. Work93 custom A write Done. All sync writes stay guarded; queue remains33.

Work94 uses current sync-written name/Fields values which differ from latest genuine saved evidence; unequal Both Conflicts with unknown clock, never uses sync/Work time. This exercises actual current/latest mismatch; an additional older-coincidentally-equal snapshot was not fabricated. Real native/Fields tie saves34/35 at16:52:38; Work95 supplies exact same trustworthy second for unequal A values and handled34/35: Conflict/Held, both Pending retry1 with explicit coverage errors. Work96 missing/null/unreliable A times conflicts. No-genuine B time conflict already92. Explicit unreliable persisted B rows were not fabricated.

Fresh Computer profile14 right7→READ1, Fields11 right4→READ1 and actual custom definition5 profile14 right7→READ1. Work97 B winners and equal native/Fields comparisons succeed Done under READ, losing A dropdown label absent locally still ReturnToA label8 (no attempt to resolve losing option). Work99 actual custom READ-only B winner Done covers Pending36; native/Fields A winner98 and custom A winner100 Held with current write permission reason and no save. Exact masks restored Computer7/Fields4/custom7. Whole asset gets unrelated contact edit37 at16:53:27; disputed clocks remain16:52:38 and supplied A16:53:26 is earlier than whole asset but newer than field. Work101 correctly applies A native/Fields and completes exact34/35 retry2. No whole-asset clock arbitration.

## Corrections, exact rows and numeric precision

Work102 B-return correction36 returns current genuine B winner, covered[36] but handled_done[]; A still differs, so row36 Pending retry1 visible reason. Work106 after simulated A saves returned value supplies same value and AlreadyEqual, exact36 Done retry2. Work103 operator helper accidentally carried initial default values, so correctly Held missing-time conflicts; no writes/terminal reset. This REPL helper-default error is preserved, not a product defect. Fresh105 supplies explicit current values: all AlreadyEqual, Done handled[34,35,37]; Done34/35 retain retry2/original done_at, genuine Pending37 completes retry2 (first attempt103 was validated but uncovered).

Native readonly numeric helper records exact raw innerJSON9007199254740993.0 and9.007199254740993e15 becoming exact PHP int9007199254740993. Duplicate final keys align with json_decode (final numeric selects exactint; final1 selects1; final numeric-looking string remains string). True strings stay strings; bool/string rejected numeric comparison; neighboring >2^53 ints compare unequal. Descriptor-level saved decimal text1.00 canonicalizes faithfully equal to JSON1/1.0; actual physical SQL DECIMAL asset column was not added for this pass.

Work104 representative new first-copy uses original raw decimal literal9007199254740993.0: Done creates custom7 with exact stored NumberType string9007199254740993, verified canonical reread and durable link. Work107 original raw exponent9.007199254740993e15 AlreadyEqual Done reuses7/no reseed; Work108 neighboring9007199254740992.0 Conflicts (unknown B time) rather than collapsing to equality. Raw curl request/response and native stdout below are authoritative; parsed JS objects may round large numeric primitives and are not used as exact precision evidence. Duplicate-final-member proof is readonly helper-level, not extra HTTP variations.

Work109 newer A missing winning option skips with Destination dropdown label has no permitted exact match; no option creation or false AppliedToB. Work111 newer A valid label resolves existing7 and applies native comment A winner; handled[40] only, original newer unlisted41 remains Pending0. Genuine multi-field31/32 and unrelated33 likewise stay Pending. While seed route16 briefly overlapped custom6, real numeric edit2 captured main38 and independent unlinked seed-route39;39 is a genuine route snapshot, preserved Pending0, no fabricated link/identity. Seed route disabled before later edits.

Work110 actually attempts A numeric12.75 against configured NumberType integer step1; native reread does not match expected, field Failed Save failed: local write or reread did not confirm intended value, Work Failed with no handled Done. Native readback confirms rollback to2, not12/12.75, Pending38 retry1 visible correction reason. Subsequent genuine numeric3 captures42 normally; guard false. This preserves earlier IB loss detection under changed canonical helpers. No automatic retry or false rollback beyond actual readback.

## Guard, History, integration and containment

Queue30→42 consists exactly12 actual genuine snapshots31–42; native/Fields/custom sync saves and precision creation/corrections add zero echo rows. Genuine native/Fields edits after successful sync34/35 and genuine custom edit42 after failed save prove guard release; History native/Fields sync updates name service user12. Custom History attribution is not additionally certified by this pass. All scoped CronTask51 workers restore caller user2/profile4/cron and ready state1; Accepted count0. No full cron/all-plugin command.

After functional cases, root-approved description-only hook.php deployed. Native CronTask getFromDB51 verified itemtype PluginAgentbdmosassetsyncWork/name processWork before update; update only comment to Process accepted Agent B synchronization and scope-control work. and reread. Actual changed columns comment/date_mod only, all scheduling/identity/state fields unchanged. No reinstall or unrelated task touched.

Setting15/16 disabledv2 with exact GET readback; native/Fields/custom rights restored, new-container other-profile rights0; all fixtures preserved, one API session closed curl40. No outbound calls/A code.

## Bounded matrix classification

| Case | Result | Actual evidence and limits |
|---|---|---|
| IE01 | PASS representative | Mixed92 native/Fields A newer applies, custom93 applies, reread/History/guard;101 correction applies. |
| IE02 | PASS representative |92/97 native/Fields/dropdown returns original B evidence; custom99/102 exact covered36 remains Pending until106 matched handling. Multi-field31/32 not falsely covered. No new external ack needed to duplicate prior ID/OB proof. |
| IE03 | PASS |90/91 numeric/text equality no clocks;105/106 no-op correction; all AlreadyEqual no field time fabricated. Helper bool/string distinguish numeric type. |
| IE04 | PASS |95 exact native+Fields trustworthy second tie Conflicts, no winner,34/35 remain Pending firstattempt1. |
| IE05 | PASS representative |92 no genuine B clock;96 null/unreliable A time;94 current mismatch. Explicit fake unreliable B snapshot NOT RUN. |
| IE06 | PASS current/latest mismatch representative |94 uses previous real sync changed value with genuine latest different; unknown B clock. Older coincidental-equality variation source-only. |
| IE07 | PASS | Original disputed16:52:38 versus A16:53:26 versus unrelated whole-asset16:53:27:101 A wins disputed field clock. |
| IE08 | PASS representative | Losing absent label under Bwinner97 succeeds without lookup; winning absent109 skips honestly; winning present111 resolves permitted7. Duplicate label fixture not added. |
| IE09 | PASS representative | Actual native/Fields READ1 and fresh custom profileREAD1 Bwinner/equal work; Awrite denied98/100; exact rights restored. Hidden field variants source/prior, not guessed. |
| IE10 | PASS Fields/custom + helper | Real raw Fields1.00/varchar and custom JSON1.0/1.00 numeric equality; helper physical-decimal transport1.00 canonical. Actual writable native SQL DECIMAL column NOT RUN; zero/negative/range permutations not broadly certified. |
| IE11 | PASS targeted | Exact decimal/exponent and duplicate tokens readonly helper; actual104 seed exact9007199254740993,107 exponent equal,108 neighbor distinct;110 real12.75 loss Failed/rollback. Exact representable tested values only. |
| IE12 | PASS |92 Awrite/Breturn/equal/Conflict coexist in Held, per-field outcomes and partial evidence preserved; no blanket coverage. |
| IE13 | PASS representative |95 tie Pending attempts1;101 exact Awinning34/35 Done attempts2;102 returned36 stays Pending1;105/106 AlreadyEqual exact completions; Done rows unchanged, validated operator103 attempt preserved. |
| IE14 | PASS | Mixed31/32 remain independent; exact40 completed111 while newer unlisted41 Pending0; unrelated genuine39 Pending0; no broad done IDs. Poll/wrong-scope mutation prior ID proof retained not repeated. |
| IE15 | PASS representative | Native/Fields/custom guard success, actual failed custom save and subsequent genuine42; no echo; correct native/Fields History. No cooldown. |
| IE16 | PASS exercised required Both behavior; source-reviewed boundaries | Actual execution supersedes stage Hold via writes/returns/equality/conflicts; integrated representative firstcopy/A-start/B-return/correction confirmed. No blanket every installed type/field claim. Unsafe moved entity/concrete/Fields owner race and transaction-failure injections NOT RUN/source-only. Prior scope controls/REST permission matrices retained, not blanket rerun. |

## Exact reconciliation

```json
{
  "curlCount": 40,
  "nativeCalls": 18,
  "workCount": 22,
  "statuses": {
    "Done": 12,
    "Held": 9,
    "Failed": 1
  },
  "immutableWorkInputMismatches": [],
  "originalSnapshotMismatches": [],
  "queueStart": 30,
  "queueEnd": 42,
  "genuineSnapshotIDs": [
    31,
    32,
    33,
    34,
    35,
    36,
    37,
    38,
    39,
    40,
    41,
    42
  ],
  "guardEchoRows": 0,
  "task51ChangedFields": [
    "comment",
    "date_mod"
  ],
  "allNativeExitZero": true,
  "snapshots": [
    {
      "id": 31,
      "status": "Pending",
      "retry_count": 0,
      "error": null
    },
    {
      "id": 32,
      "status": "Pending",
      "retry_count": 0,
      "error": null
    },
    {
      "id": 33,
      "status": "Pending",
      "retry_count": 0,
      "error": null
    },
    {
      "id": 34,
      "status": "Done",
      "retry_count": 2,
      "error": null
    },
    {
      "id": 35,
      "status": "Done",
      "retry_count": 2,
      "error": null
    },
    {
      "id": 36,
      "status": "Done",
      "retry_count": 2,
      "error": null
    },
    {
      "id": 37,
      "status": "Done",
      "retry_count": 2,
      "error": null
    },
    {
      "id": 38,
      "status": "Pending",
      "retry_count": 1,
      "error": "Snapshot 38: Both snapshot still awaits matching A handling: ie_custom_number"
    },
    {
      "id": 39,
      "status": "Pending",
      "retry_count": 0,
      "error": null
    },
    {
      "id": 40,
      "status": "Done",
      "retry_count": 1,
      "error": null
    },
    {
      "id": 41,
      "status": "Pending",
      "retry_count": 0,
      "error": null
    },
    {
      "id": 42,
      "status": "Pending",
      "retry_count": 0,
      "error": null
    }
  ]
}
```

## REST and native protocol

All curl headers Accept: application/json, Content-Type: application/json, App-Token:[REDACTED]. Login Authorization:user_token[REDACTED]; remaining Session-Token:[REDACTED]. User12/profile14/entity0 nonrecursive. Every exact raw request body/response retained below (login session redacted). Native bootstrap vendor/autoload→Kernel boot→Auth specified user→Session::init→Plugin::init. Local stdout is retained verbatim; never parse/reserialize numeric precision evidence through JS.

## Approved deployments

```json
{
  "functional": [
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
      "file": "results.php",
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
      "file": "firstcopy.php",
      "code": 0,
      "out": "",
      "err": ""
    },
    {
      "file": "both.php",
      "code": 0,
      "out": "",
      "err": ""
    }
  ],
  "hookDescriptionOnly": {
    "code": 0,
    "out": "",
    "err": ""
  }
}
```

## Complete raw curl ledger

### Curl 1 — IE restricted session after fixture rights initialization

GET http://localhost:8081/api.php/v1/initSession

Account user12/profile14/entity0; HTTP 200

Exact request body:
```json
null
```

Exact response:
```json
{"session_token":"[REDACTED]"}
```

### Curl 2 — IE native asset fixture before active route

POST http://localhost:8081/api.php/v1/Computer

Account user12/profile14/entity0; HTTP 201

Exact request body:
```json
{"input":{"entities_id":0,"name":"IE native initial","serial":"AGENTB-IE-MAIN","comment":"IE B initial","contact":"IE equal","contact_num":"IE no clock","manufacturers_id":7}}
```

Exact response:
```json
{"id":157,"message":"Item successfully added: IE native initial"}
```

### Curl 3 — IE Fields initial scalar row

POST http://localhost:8081/api.php/v1/PluginFieldsComputeragentbiex

Account user12/profile14/entity0; HTTP 201

Exact request body:
```json
{"input":{"entities_id":0,"items_id":157,"itemtype":"Computer","plugin_fields_containers_id":11,"ietextafield":"IE Fields A initial","ietextbfield":"IE Fields B initial","ienumericfield":"1.00"}}
```

Exact response:
```json
{"id":1,"message":"Item successfully added: General - ID 1"}
```

### Curl 4 — IE fresh custom representative

POST http://localhost:8081/api.php/v1/Glpi%5CCustomAsset%5CAgentBIE20261024Asset

Account user12/profile14/entity0; HTTP 201

Exact request body:
```json
{"input":{"entities_id":0,"name":"IE custom initial","serial":"AGENTB-IE-CUSTOM","custom_ie_text":"IE custom initial","custom_ie_number":1}}
```

Exact response:
```json
{"id":6,"message":"Item successfully added: IE custom initial"}
```

### Curl 5 — IE route with generic Both mappings

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting

Account user12/profile14/entity0; HTTP 201

Exact request body:
```json
{"input":{"route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"route_enabled":1,"settings_version":1,"enabled_itemtypes_json":"[\"Computer\",\"Glpi\\\\CustomAsset\\\\AgentBIE20261024Asset\"]","field_mappings_json":"[{\"mapping_id\":\"ie_native_a\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_native_b\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"comment\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_equal\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_unknown\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact_num\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"manufacturers_id\"},\"source\":\"Both\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"ie_fields_a\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbiex\",\"name\":\"ietextafield\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_fields_b\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbiex\",\"name\":\"ietextbfield\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_number\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbiex\",\"name\":\"ienumericfield\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_custom_text\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIE20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ie_text\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_custom_number\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIE20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ie_number\"},\"source\":\"Both\",\"value_mode\":\"direct\"}]"}}
```

Exact response:
```json
{"id":15,"message":""}
```

### Curl 6 — IE canonical equals without times establishes verified links

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account user12/profile14/entity0; HTTP 201

Exact request body:
```json
{"input":[{"work_id":"inbound-e-20261024-equal-no-time","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE native initial\",\"ie_native_b\":\"IE B initial\",\"ie_equal\":\"IE equal\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IC Maker\",\"ie_fields_a\":\"IE Fields A initial\",\"ie_fields_b\":\"IE Fields B initial\",\"ie_number\":1.0}","a_change_times_json":"{}","settings_version":1},{"work_id":"inbound-e-20261024-custom-equal-no-time","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":null,\"serial\":\"AGENTB-IE-CUSTOM\"}","a_values_json":"{\"ie_custom_text\":\"IE custom initial\",\"ie_custom_number\":1.00}","a_change_times_json":"{}","settings_version":1}]}
```

Exact response:
```json
[{"id":90,"message":""},{"id":91,"message":""}]
```

### Curl 7 — IE genuine native clocks for independent Both outcomes

PUT http://localhost:8081/api.php/v1/Computer/157

Account user12/profile14/entity0; HTTP 200

Exact request body:
```json
{"input":{"id":157,"name":"IE native genuine B","comment":"IE B genuine newer","manufacturers_id":8}}
```

Exact response:
```json
[{"157":true,"message":""}]
```

### Curl 8 — IE genuine Fields A and B clocks

PUT http://localhost:8081/api.php/v1/PluginFieldsComputeragentbiex/1

Account user12/profile14/entity0; HTTP 200

Exact request body:
```json
{"input":{"id":1,"items_id":157,"itemtype":"Computer","plugin_fields_containers_id":11,"ietextafield":"IE Fields A genuine B","ietextbfield":"IE Fields B genuine newer"}}
```

Exact response:
```json
[{"1":true,"message":""}]
```

### Curl 9 — IE genuine custom text clock

PUT http://localhost:8081/api.php/v1/Glpi%5CCustomAsset%5CAgentBIE20261024Asset/6

Account user12/profile14/entity0; HTTP 200

Exact request body:
```json
{"input":{"id":6,"custom_ie_text":"IE custom genuine B"}}
```

Exact response:
```json
[{"6":true,"message":""}]
```

### Curl 10 — IE original genuine times baseline

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?searchText%5Broute_id%5D=%5Einbound-e-20261024-main%24&range=0-99&sort=id&order=ASC&get_hateoas=false

Account user12/profile14/entity0; HTTP 200

Exact request body:
```json
null
```

Exact response:
```json
[{"id":31,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":157,\"serial\":\"AGENTB-IE-MAIN\"}","changed_fields_json":"{\"ie_native_a\":{\"value\":\"IE native genuine B\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true},\"ie_native_b\":{\"value\":\"IE B genuine newer\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true},\"ie_option\":{\"value\":\"AgentB IE Maker B\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:52:02","date_mod":"2026-10-24 16:52:02","done_at":null},{"id":32,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":157,\"serial\":\"AGENTB-IE-MAIN\"}","changed_fields_json":"{\"ie_fields_a\":{\"value\":\"IE Fields A genuine B\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true},\"ie_fields_b\":{\"value\":\"IE Fields B genuine newer\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:52:02","date_mod":"2026-10-24 16:52:02","done_at":null},{"id":33,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":6,\"serial\":\"AGENTB-IE-CUSTOM\"}","changed_fields_json":"{\"ie_custom_text\":{\"value\":\"IE custom genuine B\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:52:02","date_mod":"2026-10-24 16:52:02","done_at":null}]
```

### Curl 11 — IE independent native Fields A wins B wins equal unknown mixed

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account user12/profile14/entity0; HTTP 201

Exact request body:
```json
{"input":[{"work_id":"inbound-e-20261024-mixed-winners","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE A newer winner\",\"ie_native_b\":\"IE A older losing value\",\"ie_equal\":\"IE equal\",\"ie_unknown\":\"IE unequal no B clock\",\"ie_option\":\"IE missing losing option\",\"ie_fields_a\":\"IE Fields A newer winner\",\"ie_fields_b\":\"IE Fields B older A\",\"ie_number\":1}","a_change_times_json":"{\"ie_native_a\":{\"changed_at\":\"2026-10-24T16:52:37+08:00\",\"reliable\":true},\"ie_native_b\":{\"changed_at\":\"2026-10-24T16:51:44+08:00\",\"reliable\":true},\"ie_unknown\":{\"changed_at\":\"2026-10-24T16:52:37+08:00\",\"reliable\":true},\"ie_option\":{\"changed_at\":\"2026-10-24T16:51:44+08:00\",\"reliable\":true},\"ie_fields_a\":{\"changed_at\":\"2026-10-24T16:52:37+08:00\",\"reliable\":true},\"ie_fields_b\":{\"changed_at\":\"2026-10-24T16:51:44+08:00\",\"reliable\":true}}","settings_version":1},{"work_id":"inbound-e-20261024-custom-A-newer","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":null,\"serial\":\"AGENTB-IE-CUSTOM\"}","a_values_json":"{\"ie_custom_text\":\"IE custom A winner\",\"ie_custom_number\":1.0}","a_change_times_json":"{\"ie_custom_text\":{\"changed_at\":\"2026-10-24T16:52:37+08:00\",\"reliable\":true}}","settings_version":1}]}
```

Exact response:
```json
[{"id":92,"message":""},{"id":93,"message":""}]
```

### Curl 12 — IE latest genuine differs from current sync value no borrowed clock

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account user12/profile14/entity0; HTTP 201

Exact request body:
```json
{"input":{"work_id":"inbound-e-20261024-current-mismatch-no-borrow","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE another unequal A\",\"ie_native_b\":\"IE B genuine newer\",\"ie_equal\":\"IE equal\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IE Maker B\",\"ie_fields_a\":\"IE another unequal Fields A\",\"ie_fields_b\":\"IE Fields B genuine newer\",\"ie_number\":1}","a_change_times_json":"{\"ie_native_a\":{\"changed_at\":\"2026-10-24T16:52:37+08:00\",\"reliable\":true},\"ie_fields_a\":{\"changed_at\":\"2026-10-24T16:52:37+08:00\",\"reliable\":true}}","settings_version":1}}
```

Exact response:
```json
{"id":94,"message":""}
```

### Curl 13 — IE fresh native tie and unrelated mapped later field clock

PUT http://localhost:8081/api.php/v1/Computer/157

Account user12/profile14/entity0; HTTP 200

Exact request body:
```json
{"input":{"id":157,"name":"IE native tie B"}}
```

Exact response:
```json
[{"157":true,"message":""}]
```

### Curl 14 — IE fresh Fields tie clock

PUT http://localhost:8081/api.php/v1/PluginFieldsComputeragentbiex/1

Account user12/profile14/entity0; HTTP 200

Exact request body:
```json
{"input":{"id":1,"items_id":157,"itemtype":"Computer","plugin_fields_containers_id":11,"ietextafield":"IE Fields tie B"}}
```

Exact response:
```json
[{"1":true,"message":""}]
```

### Curl 15 — IE exact second tie evidence

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?searchText%5Broute_id%5D=%5Einbound-e-20261024-main%24&range=0-99&sort=id&order=ASC&get_hateoas=false

Account user12/profile14/entity0; HTTP 200

Exact request body:
```json
null
```

Exact response:
```json
[{"id":31,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":157,\"serial\":\"AGENTB-IE-MAIN\"}","changed_fields_json":"{\"ie_native_a\":{\"value\":\"IE native genuine B\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true},\"ie_native_b\":{\"value\":\"IE B genuine newer\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true},\"ie_option\":{\"value\":\"AgentB IE Maker B\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:52:02","date_mod":"2026-10-24 16:52:02","done_at":null},{"id":32,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":157,\"serial\":\"AGENTB-IE-MAIN\"}","changed_fields_json":"{\"ie_fields_a\":{\"value\":\"IE Fields A genuine B\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true},\"ie_fields_b\":{\"value\":\"IE Fields B genuine newer\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:52:02","date_mod":"2026-10-24 16:52:02","done_at":null},{"id":33,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":6,\"serial\":\"AGENTB-IE-CUSTOM\"}","changed_fields_json":"{\"ie_custom_text\":{\"value\":\"IE custom genuine B\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:52:02","date_mod":"2026-10-24 16:52:02","done_at":null},{"id":34,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":157,\"serial\":\"AGENTB-IE-MAIN\"}","changed_fields_json":"{\"ie_native_a\":{\"value\":\"IE native tie B\",\"changed_at\":\"2026-10-24T16:52:38+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:52:38","date_mod":"2026-10-24 16:52:38","done_at":null},{"id":35,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":157,\"serial\":\"AGENTB-IE-MAIN\"}","changed_fields_json":"{\"ie_fields_a\":{\"value\":\"IE Fields tie B\",\"changed_at\":\"2026-10-24T16:52:38+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:52:38","date_mod":"2026-10-24 16:52:38","done_at":null}]
```

### Curl 16 — IE exact second native and Fields ties plus missing unreliable A evidence

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account user12/profile14/entity0; HTTP 201

Exact request body:
```json
{"input":[{"work_id":"inbound-e-20261024-tie-both","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE tie unequal A\",\"ie_native_b\":\"IE B genuine newer\",\"ie_equal\":\"IE equal\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IE Maker B\",\"ie_fields_a\":\"IE Fields tie unequal A\",\"ie_fields_b\":\"IE Fields B genuine newer\",\"ie_number\":1}","a_change_times_json":"{\"ie_native_a\":{\"changed_at\":\"2026-10-24T16:52:38+08:00\",\"reliable\":true},\"ie_fields_a\":{\"changed_at\":\"2026-10-24T16:52:38+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[34,35]"},{"work_id":"inbound-e-20261024-missing-unreliable-A","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE missing A clock\",\"ie_native_b\":\"IE B genuine newer\",\"ie_equal\":\"IE equal\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IE Maker B\",\"ie_fields_a\":\"IE unreliable A clock\",\"ie_fields_b\":\"IE Fields B genuine newer\",\"ie_number\":1}","a_change_times_json":"{\"ie_native_a\":{\"changed_at\":null,\"reliable\":false},\"ie_fields_a\":{\"changed_at\":\"2026-10-24T16:52:37+08:00\",\"reliable\":false}}","settings_version":1}]}
```

Exact response:
```json
[{"id":95,"message":""},{"id":96,"message":""}]
```

### Curl 17 — IE genuine custom B clock for independent readonly proof

PUT http://localhost:8081/api.php/v1/Glpi%5CCustomAsset%5CAgentBIE20261024Asset/6

Account user12/profile14/entity0; HTTP 200

Exact request body:
```json
{"input":{"id":6,"custom_ie_text":"IE custom genuine newer B"}}
```

Exact response:
```json
[{"6":true,"message":""}]
```

### Curl 18 — IE READ-only native Fields dropdown B wins and A writes denied

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account user12/profile14/entity0; HTTP 201

Exact request body:
```json
{"input":[{"work_id":"inbound-e-20261024-readonly-B-winners","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE native tie B\",\"ie_native_b\":\"IE readonly A old losing\",\"ie_equal\":\"IE equal\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"IE nonexistent losing dropdown\",\"ie_fields_a\":\"IE Fields tie B\",\"ie_fields_b\":\"IE readonly Fields A old losing\",\"ie_number\":1}","a_change_times_json":"{\"ie_native_b\":{\"changed_at\":\"2026-10-24T16:51:44+08:00\",\"reliable\":true},\"ie_fields_b\":{\"changed_at\":\"2026-10-24T16:51:44+08:00\",\"reliable\":true},\"ie_option\":{\"changed_at\":\"2026-10-24T16:51:44+08:00\",\"reliable\":true}}","settings_version":1},{"work_id":"inbound-e-20261024-readonly-A-denied","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"MUST NOT WRITE READONLY NATIVE\",\"ie_native_b\":\"IE B genuine newer\",\"ie_equal\":\"IE equal\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IE Maker B\",\"ie_fields_a\":\"MUST NOT WRITE READONLY FIELDS\",\"ie_fields_b\":\"IE Fields B genuine newer\",\"ie_number\":1}","a_change_times_json":"{\"ie_native_a\":{\"changed_at\":\"2026-10-24T16:53:26+08:00\",\"reliable\":true},\"ie_fields_a\":{\"changed_at\":\"2026-10-24T16:53:26+08:00\",\"reliable\":true}}","settings_version":1},{"work_id":"inbound-e-20261024-custom-readonly-B-winner","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":null,\"serial\":\"AGENTB-IE-CUSTOM\"}","a_values_json":"{\"ie_custom_text\":\"IE old losing custom A\",\"ie_custom_number\":1}","a_change_times_json":"{\"ie_custom_text\":{\"changed_at\":\"2026-10-24T16:51:44+08:00\",\"reliable\":true}}","settings_version":1},{"work_id":"inbound-e-20261024-custom-readonly-A-denied","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":null,\"serial\":\"AGENTB-IE-CUSTOM\"}","a_values_json":"{\"ie_custom_text\":\"MUST NOT WRITE READONLY CUSTOM\",\"ie_custom_number\":1}","a_change_times_json":"{\"ie_custom_text\":{\"changed_at\":\"2026-10-24T16:53:26+08:00\",\"reliable\":true}}","settings_version":1}]}
```

Exact response:
```json
[{"id":97,"message":""},{"id":98,"message":""},{"id":99,"message":""},{"id":100,"message":""}]
```

### Curl 19 — IE unrelated mapped field changes whole asset date later

PUT http://localhost:8081/api.php/v1/Computer/157

Account user12/profile14/entity0; HTTP 200

Exact request body:
```json
{"input":{"id":157,"contact":"IE unrelated later field"}}
```

Exact response:
```json
[{"157":true,"message":""}]
```

### Curl 20 — IE later asset clock never replaces disputed field clock

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account user12/profile14/entity0; HTTP 201

Exact request body:
```json
{"input":{"work_id":"inbound-e-20261024-independent-field-clock","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE A after disputed before unrelated\",\"ie_native_b\":\"IE B genuine newer\",\"ie_equal\":\"IE unrelated later field\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IE Maker B\",\"ie_fields_a\":\"IE Fields A after disputed\",\"ie_fields_b\":\"IE Fields B genuine newer\",\"ie_number\":1}","a_change_times_json":"{\"ie_native_a\":{\"changed_at\":\"2026-10-24T16:53:26+08:00\",\"reliable\":true},\"ie_fields_a\":{\"changed_at\":\"2026-10-24T16:53:26+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[34,35]"}}
```

Exact response:
```json
{"id":101,"message":""}
```

### Curl 21 — IE exact correction tie attempts and B-winner Pending before handling

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?searchText%5Broute_id%5D=%5Einbound-e-20261024-main%24&range=0-99&sort=id&order=ASC&get_hateoas=false

Account user12/profile14/entity0; HTTP 200

Exact request body:
```json
null
```

Exact response:
```json
[{"id":31,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":157,\"serial\":\"AGENTB-IE-MAIN\"}","changed_fields_json":"{\"ie_native_a\":{\"value\":\"IE native genuine B\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true},\"ie_native_b\":{\"value\":\"IE B genuine newer\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true},\"ie_option\":{\"value\":\"AgentB IE Maker B\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:52:02","date_mod":"2026-10-24 16:52:02","done_at":null},{"id":32,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":157,\"serial\":\"AGENTB-IE-MAIN\"}","changed_fields_json":"{\"ie_fields_a\":{\"value\":\"IE Fields A genuine B\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true},\"ie_fields_b\":{\"value\":\"IE Fields B genuine newer\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:52:02","date_mod":"2026-10-24 16:52:02","done_at":null},{"id":33,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":6,\"serial\":\"AGENTB-IE-CUSTOM\"}","changed_fields_json":"{\"ie_custom_text\":{\"value\":\"IE custom genuine B\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:52:02","date_mod":"2026-10-24 16:52:02","done_at":null},{"id":34,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":157,\"serial\":\"AGENTB-IE-MAIN\"}","changed_fields_json":"{\"ie_native_a\":{\"value\":\"IE native tie B\",\"changed_at\":\"2026-10-24T16:52:38+08:00\",\"reliable\":true}}","status":"Done","retry_count":2,"error":null,"date_creation":"2026-10-24 16:52:38","date_mod":"2026-10-24 16:53:27","done_at":"2026-10-24 16:53:27"},{"id":35,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":157,\"serial\":\"AGENTB-IE-MAIN\"}","changed_fields_json":"{\"ie_fields_a\":{\"value\":\"IE Fields tie B\",\"changed_at\":\"2026-10-24T16:52:38+08:00\",\"reliable\":true}}","status":"Done","retry_count":2,"error":null,"date_creation":"2026-10-24 16:52:38","date_mod":"2026-10-24 16:53:27","done_at":"2026-10-24 16:53:27"},{"id":36,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":6,\"serial\":\"AGENTB-IE-CUSTOM\"}","changed_fields_json":"{\"ie_custom_text\":{\"value\":\"IE custom genuine newer B\",\"changed_at\":\"2026-10-24T16:53:10+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:53:10","date_mod":"2026-10-24 16:53:10","done_at":null},{"id":37,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":157,\"serial\":\"AGENTB-IE-MAIN\"}","changed_fields_json":"{\"ie_equal\":{\"value\":\"IE unrelated later field\",\"changed_at\":\"2026-10-24T16:53:27+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:53:27","date_mod":"2026-10-24 16:53:27","done_at":null}]
```

### Curl 22 — IE B-return correction cannot complete until A matches returned winner

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account user12/profile14/entity0; HTTP 201

Exact request body:
```json
{"input":[{"work_id":"inbound-e-20261024-custom-B-return-pending","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":null,\"serial\":\"AGENTB-IE-CUSTOM\"}","a_values_json":"{\"ie_custom_text\":\"IE still old A value\",\"ie_custom_number\":1}","a_change_times_json":"{\"ie_custom_text\":{\"changed_at\":\"2026-10-24T16:51:44+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[36]"},{"work_id":"inbound-e-20261024-already-equal-exact-correction","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE native initial\",\"ie_native_b\":\"IE B initial\",\"ie_equal\":\"IE equal\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IC Maker\",\"ie_fields_a\":\"IE Fields A initial\",\"ie_fields_b\":\"IE Fields B initial\",\"ie_number\":1}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[34,35,37]"}]}
```

Exact response:
```json
[{"id":102,"message":""},{"id":103,"message":""}]
```

### Curl 23 — IE isolated representative precision first-copy route

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting

Account user12/profile14/entity0; HTTP 201

Exact request body:
```json
{"input":{"route_id":"inbound-e-20261024-seed","a_entities_id":9601,"entities_id":0,"route_enabled":1,"settings_version":1,"enabled_itemtypes_json":"[\"Glpi\\\\CustomAsset\\\\AgentBIE20261024Asset\"]","field_mappings_json":"[{\"mapping_id\":\"ie_seed_serial\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIE20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"serial\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_seed_text\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIE20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ie_text\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_seed_number\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIE20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ie_number\"},\"source\":\"Both\",\"value_mode\":\"direct\"}]"}}
```

Exact response:
```json
{"id":16,"message":""}
```

### Curl 24 — IE original raw decimal above 2pow53 first-copy seed

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account user12/profile14/entity0; HTTP 201

Exact request body:
```json
{"input":{"work_id":"inbound-e-20261024-precision-first-copy","route_id":"inbound-e-20261024-seed","a_entities_id":9601,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966199,\"b_items_id\":null,\"serial\":\"AGENTB-IE-SEED\"}","a_values_json":"{\"ie_seed_serial\":\"AGENTB-IE-SEED\",\"ie_seed_text\":\"IE exact precision seed\",\"ie_seed_number\":9007199254740993.0}","a_change_times_json":"{}","settings_version":1}}
```

Exact response:
```json
{"id":104,"message":""}
```

### Curl 25 — IE fresh explicit current values no-op correction and B-handling reconciliation

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account user12/profile14/entity0; HTTP 201

Exact request body:
```json
{"input":[{"work_id":"inbound-e-20261024-equal-current-exact-correction","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE A after disputed before unrelated\",\"ie_native_b\":\"IE B genuine newer\",\"ie_equal\":\"IE unrelated later field\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IE Maker B\",\"ie_fields_a\":\"IE Fields A after disputed\",\"ie_fields_b\":\"IE Fields B genuine newer\",\"ie_number\":1}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[34,35,37]"},{"work_id":"inbound-e-20261024-custom-after-A-saves-B-winner","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":null,\"serial\":\"AGENTB-IE-CUSTOM\"}","a_values_json":"{\"ie_custom_text\":\"IE custom genuine newer B\",\"ie_custom_number\":1}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[36]"},{"work_id":"inbound-e-20261024-precision-exponent-equal","route_id":"inbound-e-20261024-seed","a_entities_id":9601,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966199,\"b_items_id\":null,\"serial\":\"AGENTB-IE-SEED\"}","a_values_json":"{\"ie_seed_serial\":\"AGENTB-IE-SEED\",\"ie_seed_text\":\"IE exact precision seed\",\"ie_seed_number\":9.007199254740993e15}","a_change_times_json":"{}","settings_version":1},{"work_id":"inbound-e-20261024-precision-neighbor-distinct","route_id":"inbound-e-20261024-seed","a_entities_id":9601,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966199,\"b_items_id\":null,\"serial\":\"AGENTB-IE-SEED\"}","a_values_json":"{\"ie_seed_serial\":\"AGENTB-IE-SEED\",\"ie_seed_text\":\"IE exact precision seed\",\"ie_seed_number\":9007199254740992.0}","a_change_times_json":"{}","settings_version":1}]}
```

Exact response:
```json
[{"id":105,"message":""},{"id":106,"message":""},{"id":107,"message":""},{"id":108,"message":""}]
```

### Curl 26 — IE genuine custom numeric clock for definite loss validation

PUT http://localhost:8081/api.php/v1/Glpi%5CCustomAsset%5CAgentBIE20261024Asset/6

Account user12/profile14/entity0; HTTP 200

Exact request body:
```json
{"input":{"id":6,"custom_ie_number":2}}
```

Exact response:
```json
[{"6":true,"message":""}]
```

### Curl 27 — IE genuine selected Both correction edit

PUT http://localhost:8081/api.php/v1/Computer/157

Account user12/profile14/entity0; HTTP 200

Exact request body:
```json
{"input":{"id":157,"comment":"IE selected correction B"}}
```

Exact response:
```json
[{"157":true,"message":""}]
```

### Curl 28 — IE genuine newer same-field unselected snapshot

PUT http://localhost:8081/api.php/v1/Computer/157

Account user12/profile14/entity0; HTTP 200

Exact request body:
```json
{"input":{"id":157,"comment":"IE newer unselected B"}}
```

Exact response:
```json
[{"157":true,"message":""}]
```

### Curl 29 — IE actual original correction and number clock baseline

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?searchText%5Broute_id%5D=%5Einbound-e-20261024-main%24&range=0-99&sort=id&order=ASC&get_hateoas=false

Account user12/profile14/entity0; HTTP 200

Exact request body:
```json
null
```

Exact response:
```json
[{"id":31,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":157,\"serial\":\"AGENTB-IE-MAIN\"}","changed_fields_json":"{\"ie_native_a\":{\"value\":\"IE native genuine B\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true},\"ie_native_b\":{\"value\":\"IE B genuine newer\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true},\"ie_option\":{\"value\":\"AgentB IE Maker B\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:52:02","date_mod":"2026-10-24 16:52:02","done_at":null},{"id":32,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":157,\"serial\":\"AGENTB-IE-MAIN\"}","changed_fields_json":"{\"ie_fields_a\":{\"value\":\"IE Fields A genuine B\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true},\"ie_fields_b\":{\"value\":\"IE Fields B genuine newer\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:52:02","date_mod":"2026-10-24 16:52:02","done_at":null},{"id":33,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":6,\"serial\":\"AGENTB-IE-CUSTOM\"}","changed_fields_json":"{\"ie_custom_text\":{\"value\":\"IE custom genuine B\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:52:02","date_mod":"2026-10-24 16:52:02","done_at":null},{"id":34,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":157,\"serial\":\"AGENTB-IE-MAIN\"}","changed_fields_json":"{\"ie_native_a\":{\"value\":\"IE native tie B\",\"changed_at\":\"2026-10-24T16:52:38+08:00\",\"reliable\":true}}","status":"Done","retry_count":2,"error":null,"date_creation":"2026-10-24 16:52:38","date_mod":"2026-10-24 16:53:27","done_at":"2026-10-24 16:53:27"},{"id":35,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":157,\"serial\":\"AGENTB-IE-MAIN\"}","changed_fields_json":"{\"ie_fields_a\":{\"value\":\"IE Fields tie B\",\"changed_at\":\"2026-10-24T16:52:38+08:00\",\"reliable\":true}}","status":"Done","retry_count":2,"error":null,"date_creation":"2026-10-24 16:52:38","date_mod":"2026-10-24 16:53:27","done_at":"2026-10-24 16:53:27"},{"id":36,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":6,\"serial\":\"AGENTB-IE-CUSTOM\"}","changed_fields_json":"{\"ie_custom_text\":{\"value\":\"IE custom genuine newer B\",\"changed_at\":\"2026-10-24T16:53:10+08:00\",\"reliable\":true}}","status":"Done","retry_count":2,"error":null,"date_creation":"2026-10-24 16:53:10","date_mod":"2026-10-24 16:54:52","done_at":"2026-10-24 16:54:52"},{"id":37,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":157,\"serial\":\"AGENTB-IE-MAIN\"}","changed_fields_json":"{\"ie_equal\":{\"value\":\"IE unrelated later field\",\"changed_at\":\"2026-10-24T16:53:27+08:00\",\"reliable\":true}}","status":"Done","retry_count":2,"error":null,"date_creation":"2026-10-24 16:53:27","date_mod":"2026-10-24 16:54:52","done_at":"2026-10-24 16:54:52"},{"id":38,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":6,\"serial\":\"AGENTB-IE-CUSTOM\"}","changed_fields_json":"{\"ie_custom_number\":{\"value\":2,\"changed_at\":\"2026-10-24T16:54:53+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:54:53","date_mod":"2026-10-24 16:54:53","done_at":null},{"id":40,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":157,\"serial\":\"AGENTB-IE-MAIN\"}","changed_fields_json":"{\"ie_native_b\":{\"value\":\"IE selected correction B\",\"changed_at\":\"2026-10-24T16:54:53+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:54:53","date_mod":"2026-10-24 16:54:53","done_at":null},{"id":41,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":157,\"serial\":\"AGENTB-IE-MAIN\"}","changed_fields_json":"{\"ie_native_b\":{\"value\":\"IE newer unselected B\",\"changed_at\":\"2026-10-24T16:54:53+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:54:53","date_mod":"2026-10-24 16:54:53","done_at":null}]
```

### Curl 30 — IE contain completed precision seed route before remaining genuine edits

PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/16

Account user12/profile14/entity0; HTTP 200

Exact request body:
```json
{"input":{"id":16,"route_id":"inbound-e-20261024-seed","a_entities_id":9601,"entities_id":0,"route_enabled":0,"settings_version":2,"enabled_itemtypes_json":"[\"Glpi\\\\CustomAsset\\\\AgentBIE20261024Asset\"]","field_mappings_json":"[{\"mapping_id\":\"ie_seed_serial\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIE20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"serial\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_seed_text\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIE20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ie_text\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_seed_number\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIE20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ie_number\"},\"source\":\"Both\",\"value_mode\":\"direct\"}]"}}
```

Exact response:
```json
[{"16":true,"message":""}]
```

### Curl 31 — IE newer A missing winning dropdown option skips visibly

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account user12/profile14/entity0; HTTP 201

Exact request body:
```json
{"input":{"work_id":"inbound-e-20261024-winning-option-missing","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE A after disputed before unrelated\",\"ie_native_b\":\"IE newer unselected B\",\"ie_equal\":\"IE unrelated later field\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"IE missing winning option\",\"ie_fields_a\":\"IE Fields A after disputed\",\"ie_fields_b\":\"IE Fields B genuine newer\",\"ie_number\":1}","a_change_times_json":"{\"ie_option\":{\"changed_at\":\"2026-10-24T16:55:24+08:00\",\"reliable\":true}}","settings_version":1}}
```

Exact response:
```json
{"id":109,"message":""}
```

### Curl 32 — IE exact numeric loss and unlisted newer snapshot correction

POST http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork

Account user12/profile14/entity0; HTTP 201

Exact request body:
```json
{"input":[{"work_id":"inbound-e-20261024-custom-number-loss","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":null,\"serial\":\"AGENTB-IE-CUSTOM\"}","a_values_json":"{\"ie_custom_text\":\"IE custom genuine newer B\",\"ie_custom_number\":12.75}","a_change_times_json":"{\"ie_custom_number\":{\"changed_at\":\"2026-10-24T16:55:24+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[38]"},{"work_id":"inbound-e-20261024-exact-selected-newer-unlisted","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE A after disputed before unrelated\",\"ie_native_b\":\"IE A latest correction winner\",\"ie_equal\":\"IE unrelated later field\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IC Maker\",\"ie_fields_a\":\"IE Fields A after disputed\",\"ie_fields_b\":\"IE Fields B genuine newer\",\"ie_number\":1}","a_change_times_json":"{\"ie_native_b\":{\"changed_at\":\"2026-10-24T16:55:24+08:00\",\"reliable\":true},\"ie_option\":{\"changed_at\":\"2026-10-24T16:55:24+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[40]"}]}
```

Exact response:
```json
[{"id":110,"message":""},{"id":111,"message":""}]
```

### Curl 33 — IE genuine custom edit after failed sync still queues

PUT http://localhost:8081/api.php/v1/Glpi%5CCustomAsset%5CAgentBIE20261024Asset/6

Account user12/profile14/entity0; HTTP 200

Exact request body:
```json
{"input":{"id":6,"custom_ie_number":3}}
```

Exact response:
```json
[{"6":true,"message":""}]
```

### Curl 34 — IE preserve genuine second-route snapshot created during seed route overlap

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange/39?get_hateoas=false

Account user12/profile14/entity0; HTTP 200

Exact request body:
```json
null
```

Exact response:
```json
{"id":39,"route_id":"inbound-e-20261024-seed","settings_version":1,"a_entities_id":9601,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":null,\"b_items_id\":6,\"serial\":\"AGENTB-IE-CUSTOM\"}","changed_fields_json":"{\"ie_seed_number\":{\"value\":2,\"changed_at\":\"2026-10-24T16:54:53+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:54:53","date_mod":"2026-10-24 16:54:53","done_at":null}
```

### Curl 35 — IE final exact durable Work outcomes and immutable raw inputs

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncWork?searchText%5Bwork_id%5D=%5Einbound-e-20261024-&range=0-99&sort=id&order=ASC&get_hateoas=false

Account user12/profile14/entity0; HTTP 200

Exact request body:
```json
null
```

Exact response:
```json
[{"id":90,"work_id":"inbound-e-20261024-equal-no-time","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE native initial\",\"ie_native_b\":\"IE B initial\",\"ie_equal\":\"IE equal\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IC Maker\",\"ie_fields_a\":\"IE Fields A initial\",\"ie_fields_b\":\"IE Fields B initial\",\"ie_number\":1.0}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966001,"b_items_id":157,"link_state":"Active","processing_started_at":"2026-10-24 16:50:50","status":"Done","result_json":"{\"b_items_id\":157,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_native_a\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_native_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_equal\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_unknown\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_option\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_fields_a\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_fields_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:50:50","date_mod":"2026-10-24 16:50:50","completed_at":"2026-10-24 16:50:50"},{"id":91,"work_id":"inbound-e-20261024-custom-equal-no-time","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":null,\"serial\":\"AGENTB-IE-CUSTOM\"}","a_values_json":"{\"ie_custom_text\":\"IE custom initial\",\"ie_custom_number\":1.00}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966101,"b_items_id":6,"link_state":"Active","processing_started_at":"2026-10-24 16:50:50","status":"Done","result_json":"{\"b_items_id\":6,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_custom_text\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_custom_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:50:50","date_mod":"2026-10-24 16:50:50","completed_at":"2026-10-24 16:50:50"},{"id":92,"work_id":"inbound-e-20261024-mixed-winners","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE A newer winner\",\"ie_native_b\":\"IE A older losing value\",\"ie_equal\":\"IE equal\",\"ie_unknown\":\"IE unequal no B clock\",\"ie_option\":\"IE missing losing option\",\"ie_fields_a\":\"IE Fields A newer winner\",\"ie_fields_b\":\"IE Fields B older A\",\"ie_number\":1}","a_change_times_json":"{\"ie_native_a\":{\"changed_at\":\"2026-10-24T16:52:37+08:00\",\"reliable\":true},\"ie_native_b\":{\"changed_at\":\"2026-10-24T16:51:44+08:00\",\"reliable\":true},\"ie_unknown\":{\"changed_at\":\"2026-10-24T16:52:37+08:00\",\"reliable\":true},\"ie_option\":{\"changed_at\":\"2026-10-24T16:51:44+08:00\",\"reliable\":true},\"ie_fields_a\":{\"changed_at\":\"2026-10-24T16:52:37+08:00\",\"reliable\":true},\"ie_fields_b\":{\"changed_at\":\"2026-10-24T16:51:44+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966001,"b_items_id":157,"link_state":"Active","processing_started_at":"2026-10-24 16:52:38","status":"Held","result_json":"{\"b_items_id\":157,\"created_b_items_id\":null,\"b_values_for_a\":{\"ie_native_b\":{\"value\":\"IE B genuine newer\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true},\"ie_option\":{\"value\":\"AgentB IE Maker B\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true},\"ie_fields_b\":{\"value\":\"IE Fields B genuine newer\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true}},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_native_a\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ie_native_b\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"ie_equal\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_unknown\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values lack two reliable genuine field times\"},{\"mapping_id\":\"ie_option\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"ie_fields_a\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ie_fields_b\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"ie_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":"Unequal Both values lack two reliable genuine field times","date_creation":"2026-10-24 16:52:38","date_mod":"2026-10-24 16:52:38","completed_at":null},{"id":93,"work_id":"inbound-e-20261024-custom-A-newer","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":null,\"serial\":\"AGENTB-IE-CUSTOM\"}","a_values_json":"{\"ie_custom_text\":\"IE custom A winner\",\"ie_custom_number\":1.0}","a_change_times_json":"{\"ie_custom_text\":{\"changed_at\":\"2026-10-24T16:52:37+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966101,"b_items_id":6,"link_state":"Active","processing_started_at":"2026-10-24 16:52:38","status":"Done","result_json":"{\"b_items_id\":6,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_custom_text\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ie_custom_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:52:38","date_mod":"2026-10-24 16:52:38","completed_at":"2026-10-24 16:52:38"},{"id":94,"work_id":"inbound-e-20261024-current-mismatch-no-borrow","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE another unequal A\",\"ie_native_b\":\"IE B genuine newer\",\"ie_equal\":\"IE equal\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IE Maker B\",\"ie_fields_a\":\"IE another unequal Fields A\",\"ie_fields_b\":\"IE Fields B genuine newer\",\"ie_number\":1}","a_change_times_json":"{\"ie_native_a\":{\"changed_at\":\"2026-10-24T16:52:37+08:00\",\"reliable\":true},\"ie_fields_a\":{\"changed_at\":\"2026-10-24T16:52:37+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966001,"b_items_id":157,"link_state":"Active","processing_started_at":"2026-10-24 16:52:38","status":"Held","result_json":"{\"b_items_id\":157,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_native_a\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values lack two reliable genuine field times\"},{\"mapping_id\":\"ie_native_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_equal\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_unknown\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_option\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_fields_a\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values lack two reliable genuine field times\"},{\"mapping_id\":\"ie_fields_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":"Unequal Both values lack two reliable genuine field times","date_creation":"2026-10-24 16:52:38","date_mod":"2026-10-24 16:52:38","completed_at":null},{"id":95,"work_id":"inbound-e-20261024-tie-both","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE tie unequal A\",\"ie_native_b\":\"IE B genuine newer\",\"ie_equal\":\"IE equal\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IE Maker B\",\"ie_fields_a\":\"IE Fields tie unequal A\",\"ie_fields_b\":\"IE Fields B genuine newer\",\"ie_number\":1}","a_change_times_json":"{\"ie_native_a\":{\"changed_at\":\"2026-10-24T16:52:38+08:00\",\"reliable\":true},\"ie_fields_a\":{\"changed_at\":\"2026-10-24T16:52:38+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[34,35]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966001,"b_items_id":157,"link_state":"Active","processing_started_at":"2026-10-24 16:53:10","status":"Held","result_json":"{\"b_items_id\":157,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_native_a\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values have equal genuine field times\"},{\"mapping_id\":\"ie_native_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_equal\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_unknown\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_option\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_fields_a\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values have equal genuine field times\"},{\"mapping_id\":\"ie_fields_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":"Snapshot 34: Both snapshot still awaits matching A handling: ie_native_a; Snapshot 35: Both snapshot still awaits matching A handling: ie_fields_a","date_creation":"2026-10-24 16:53:10","date_mod":"2026-10-24 16:53:10","completed_at":null},{"id":96,"work_id":"inbound-e-20261024-missing-unreliable-A","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE missing A clock\",\"ie_native_b\":\"IE B genuine newer\",\"ie_equal\":\"IE equal\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IE Maker B\",\"ie_fields_a\":\"IE unreliable A clock\",\"ie_fields_b\":\"IE Fields B genuine newer\",\"ie_number\":1}","a_change_times_json":"{\"ie_native_a\":{\"changed_at\":null,\"reliable\":false},\"ie_fields_a\":{\"changed_at\":\"2026-10-24T16:52:37+08:00\",\"reliable\":false}}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966001,"b_items_id":157,"link_state":"Active","processing_started_at":"2026-10-24 16:53:10","status":"Held","result_json":"{\"b_items_id\":157,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_native_a\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values lack two reliable genuine field times\"},{\"mapping_id\":\"ie_native_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_equal\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_unknown\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_option\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_fields_a\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values lack two reliable genuine field times\"},{\"mapping_id\":\"ie_fields_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":"Unequal Both values lack two reliable genuine field times","date_creation":"2026-10-24 16:53:10","date_mod":"2026-10-24 16:53:10","completed_at":null},{"id":97,"work_id":"inbound-e-20261024-readonly-B-winners","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE native tie B\",\"ie_native_b\":\"IE readonly A old losing\",\"ie_equal\":\"IE equal\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"IE nonexistent losing dropdown\",\"ie_fields_a\":\"IE Fields tie B\",\"ie_fields_b\":\"IE readonly Fields A old losing\",\"ie_number\":1}","a_change_times_json":"{\"ie_native_b\":{\"changed_at\":\"2026-10-24T16:51:44+08:00\",\"reliable\":true},\"ie_fields_b\":{\"changed_at\":\"2026-10-24T16:51:44+08:00\",\"reliable\":true},\"ie_option\":{\"changed_at\":\"2026-10-24T16:51:44+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966001,"b_items_id":157,"link_state":"Active","processing_started_at":"2026-10-24 16:53:26","status":"Done","result_json":"{\"b_items_id\":157,\"created_b_items_id\":null,\"b_values_for_a\":{\"ie_native_b\":{\"value\":\"IE B genuine newer\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true},\"ie_option\":{\"value\":\"AgentB IE Maker B\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true},\"ie_fields_b\":{\"value\":\"IE Fields B genuine newer\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true}},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_native_a\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_native_b\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"ie_equal\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_unknown\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_option\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"ie_fields_a\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_fields_b\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"ie_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:53:26","date_mod":"2026-10-24 16:53:26","completed_at":"2026-10-24 16:53:26"},{"id":98,"work_id":"inbound-e-20261024-readonly-A-denied","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"MUST NOT WRITE READONLY NATIVE\",\"ie_native_b\":\"IE B genuine newer\",\"ie_equal\":\"IE equal\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IE Maker B\",\"ie_fields_a\":\"MUST NOT WRITE READONLY FIELDS\",\"ie_fields_b\":\"IE Fields B genuine newer\",\"ie_number\":1}","a_change_times_json":"{\"ie_native_a\":{\"changed_at\":\"2026-10-24T16:53:26+08:00\",\"reliable\":true},\"ie_fields_a\":{\"changed_at\":\"2026-10-24T16:53:26+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966001,"b_items_id":157,"link_state":"Active","processing_started_at":"2026-10-24 16:53:26","status":"Held","result_json":"{\"b_items_id\":157,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_native_a\",\"outcome\":\"Skipped\",\"reason\":\"Hold: A won Both but the current B write is not permitted: Submitting user lacks current asset permission\"},{\"mapping_id\":\"ie_native_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_equal\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_unknown\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_option\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_fields_a\",\"outcome\":\"Skipped\",\"reason\":\"Hold: A won Both but the current B write is not permitted: Submitting user lacks current asset permission\"},{\"mapping_id\":\"ie_fields_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":"Hold: A won Both but the current B write is not permitted: Submitting user lacks current asset permission","date_creation":"2026-10-24 16:53:26","date_mod":"2026-10-24 16:53:26","completed_at":null},{"id":99,"work_id":"inbound-e-20261024-custom-readonly-B-winner","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":null,\"serial\":\"AGENTB-IE-CUSTOM\"}","a_values_json":"{\"ie_custom_text\":\"IE old losing custom A\",\"ie_custom_number\":1}","a_change_times_json":"{\"ie_custom_text\":{\"changed_at\":\"2026-10-24T16:51:44+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966101,"b_items_id":6,"link_state":"Active","processing_started_at":"2026-10-24 16:53:26","status":"Done","result_json":"{\"b_items_id\":6,\"created_b_items_id\":null,\"b_values_for_a\":{\"ie_custom_text\":{\"value\":\"IE custom genuine newer B\",\"changed_at\":\"2026-10-24T16:53:10+08:00\",\"reliable\":true}},\"covered_change_ids\":[36],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_custom_text\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"ie_custom_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:53:26","date_mod":"2026-10-24 16:53:26","completed_at":"2026-10-24 16:53:26"},{"id":100,"work_id":"inbound-e-20261024-custom-readonly-A-denied","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":null,\"serial\":\"AGENTB-IE-CUSTOM\"}","a_values_json":"{\"ie_custom_text\":\"MUST NOT WRITE READONLY CUSTOM\",\"ie_custom_number\":1}","a_change_times_json":"{\"ie_custom_text\":{\"changed_at\":\"2026-10-24T16:53:26+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966101,"b_items_id":6,"link_state":"Active","processing_started_at":"2026-10-24 16:53:26","status":"Held","result_json":"{\"b_items_id\":6,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_custom_text\",\"outcome\":\"Skipped\",\"reason\":\"Hold: A won Both but the current B write is not permitted: Submitting user lacks current asset permission\"},{\"mapping_id\":\"ie_custom_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":"Hold: A won Both but the current B write is not permitted: Submitting user lacks current asset permission","date_creation":"2026-10-24 16:53:26","date_mod":"2026-10-24 16:53:26","completed_at":null},{"id":101,"work_id":"inbound-e-20261024-independent-field-clock","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE A after disputed before unrelated\",\"ie_native_b\":\"IE B genuine newer\",\"ie_equal\":\"IE unrelated later field\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IE Maker B\",\"ie_fields_a\":\"IE Fields A after disputed\",\"ie_fields_b\":\"IE Fields B genuine newer\",\"ie_number\":1}","a_change_times_json":"{\"ie_native_a\":{\"changed_at\":\"2026-10-24T16:53:26+08:00\",\"reliable\":true},\"ie_fields_a\":{\"changed_at\":\"2026-10-24T16:53:26+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[34,35]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966001,"b_items_id":157,"link_state":"Active","processing_started_at":"2026-10-24 16:53:27","status":"Done","result_json":"{\"b_items_id\":157,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[34,35],\"field_outcomes\":[{\"mapping_id\":\"ie_native_a\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ie_native_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_equal\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_unknown\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_option\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_fields_a\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ie_fields_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:53:27","date_mod":"2026-10-24 16:53:27","completed_at":"2026-10-24 16:53:27"},{"id":102,"work_id":"inbound-e-20261024-custom-B-return-pending","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":null,\"serial\":\"AGENTB-IE-CUSTOM\"}","a_values_json":"{\"ie_custom_text\":\"IE still old A value\",\"ie_custom_number\":1}","a_change_times_json":"{\"ie_custom_text\":{\"changed_at\":\"2026-10-24T16:51:44+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[36]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966101,"b_items_id":6,"link_state":"Active","processing_started_at":"2026-10-24 16:54:03","status":"Held","result_json":"{\"b_items_id\":6,\"created_b_items_id\":null,\"b_values_for_a\":{\"ie_custom_text\":{\"value\":\"IE custom genuine newer B\",\"changed_at\":\"2026-10-24T16:53:10+08:00\",\"reliable\":true}},\"covered_change_ids\":[36],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_custom_text\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"ie_custom_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":"Snapshot 36: Both snapshot still awaits matching A handling: ie_custom_text","date_creation":"2026-10-24 16:54:03","date_mod":"2026-10-24 16:54:03","completed_at":null},{"id":103,"work_id":"inbound-e-20261024-already-equal-exact-correction","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE native initial\",\"ie_native_b\":\"IE B initial\",\"ie_equal\":\"IE equal\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IC Maker\",\"ie_fields_a\":\"IE Fields A initial\",\"ie_fields_b\":\"IE Fields B initial\",\"ie_number\":1}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[34,35,37]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966001,"b_items_id":157,"link_state":"Active","processing_started_at":"2026-10-24 16:54:03","status":"Held","result_json":"{\"b_items_id\":157,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_native_a\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values lack two reliable genuine field times\"},{\"mapping_id\":\"ie_native_b\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values lack two reliable genuine field times\"},{\"mapping_id\":\"ie_equal\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values lack two reliable genuine field times\"},{\"mapping_id\":\"ie_unknown\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_option\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values lack two reliable genuine field times\"},{\"mapping_id\":\"ie_fields_a\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values lack two reliable genuine field times\"},{\"mapping_id\":\"ie_fields_b\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values lack two reliable genuine field times\"},{\"mapping_id\":\"ie_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":"Snapshot 34: Both snapshot still awaits matching A handling: ie_native_a; Snapshot 35: Both snapshot still awaits matching A handling: ie_fields_a; Snapshot 37: Both snapshot still awaits matching A handling: ie_equal","date_creation":"2026-10-24 16:54:03","date_mod":"2026-10-24 16:54:03","completed_at":null},{"id":104,"work_id":"inbound-e-20261024-precision-first-copy","route_id":"inbound-e-20261024-seed","a_entities_id":9601,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966199,\"b_items_id\":null,\"serial\":\"AGENTB-IE-SEED\"}","a_values_json":"{\"ie_seed_serial\":\"AGENTB-IE-SEED\",\"ie_seed_text\":\"IE exact precision seed\",\"ie_seed_number\":9007199254740993.0}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966199,"b_items_id":7,"link_state":"Active","processing_started_at":"2026-10-24 16:54:03","status":"Done","result_json":"{\"b_items_id\":7,\"created_b_items_id\":7,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_seed_serial\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ie_seed_text\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ie_seed_number\",\"outcome\":\"AppliedToB\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:54:03","date_mod":"2026-10-24 16:54:03","completed_at":"2026-10-24 16:54:03"},{"id":105,"work_id":"inbound-e-20261024-equal-current-exact-correction","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE A after disputed before unrelated\",\"ie_native_b\":\"IE B genuine newer\",\"ie_equal\":\"IE unrelated later field\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IE Maker B\",\"ie_fields_a\":\"IE Fields A after disputed\",\"ie_fields_b\":\"IE Fields B genuine newer\",\"ie_number\":1}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[34,35,37]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966001,"b_items_id":157,"link_state":"Active","processing_started_at":"2026-10-24 16:54:52","status":"Done","result_json":"{\"b_items_id\":157,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[34,35,37],\"field_outcomes\":[{\"mapping_id\":\"ie_native_a\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_native_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_equal\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_unknown\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_option\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_fields_a\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_fields_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:54:52","date_mod":"2026-10-24 16:54:52","completed_at":"2026-10-24 16:54:52"},{"id":106,"work_id":"inbound-e-20261024-custom-after-A-saves-B-winner","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":null,\"serial\":\"AGENTB-IE-CUSTOM\"}","a_values_json":"{\"ie_custom_text\":\"IE custom genuine newer B\",\"ie_custom_number\":1}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[36]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966101,"b_items_id":6,"link_state":"Active","processing_started_at":"2026-10-24 16:54:52","status":"Done","result_json":"{\"b_items_id\":6,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[36],\"field_outcomes\":[{\"mapping_id\":\"ie_custom_text\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_custom_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:54:52","date_mod":"2026-10-24 16:54:52","completed_at":"2026-10-24 16:54:52"},{"id":107,"work_id":"inbound-e-20261024-precision-exponent-equal","route_id":"inbound-e-20261024-seed","a_entities_id":9601,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966199,\"b_items_id\":null,\"serial\":\"AGENTB-IE-SEED\"}","a_values_json":"{\"ie_seed_serial\":\"AGENTB-IE-SEED\",\"ie_seed_text\":\"IE exact precision seed\",\"ie_seed_number\":9.007199254740993e15}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966199,"b_items_id":7,"link_state":"Active","processing_started_at":"2026-10-24 16:54:52","status":"Done","result_json":"{\"b_items_id\":7,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_seed_serial\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_seed_text\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_seed_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:54:52","date_mod":"2026-10-24 16:54:52","completed_at":"2026-10-24 16:54:52"},{"id":108,"work_id":"inbound-e-20261024-precision-neighbor-distinct","route_id":"inbound-e-20261024-seed","a_entities_id":9601,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966199,\"b_items_id\":null,\"serial\":\"AGENTB-IE-SEED\"}","a_values_json":"{\"ie_seed_serial\":\"AGENTB-IE-SEED\",\"ie_seed_text\":\"IE exact precision seed\",\"ie_seed_number\":9007199254740992.0}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966199,"b_items_id":7,"link_state":"Active","processing_started_at":"2026-10-24 16:54:52","status":"Held","result_json":"{\"b_items_id\":7,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_seed_serial\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_seed_text\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_seed_number\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values lack two reliable genuine field times\"}]}","error":"Unequal Both values lack two reliable genuine field times","date_creation":"2026-10-24 16:54:52","date_mod":"2026-10-24 16:54:52","completed_at":null},{"id":109,"work_id":"inbound-e-20261024-winning-option-missing","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE A after disputed before unrelated\",\"ie_native_b\":\"IE newer unselected B\",\"ie_equal\":\"IE unrelated later field\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"IE missing winning option\",\"ie_fields_a\":\"IE Fields A after disputed\",\"ie_fields_b\":\"IE Fields B genuine newer\",\"ie_number\":1}","a_change_times_json":"{\"ie_option\":{\"changed_at\":\"2026-10-24T16:55:24+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966001,"b_items_id":157,"link_state":"Active","processing_started_at":"2026-10-24 16:55:24","status":"Done","result_json":"{\"b_items_id\":157,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_native_a\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_native_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_equal\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_unknown\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_option\",\"outcome\":\"Skipped\",\"reason\":\"Destination dropdown label has no permitted exact match\"},{\"mapping_id\":\"ie_fields_a\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_fields_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:55:24","date_mod":"2026-10-24 16:55:24","completed_at":"2026-10-24 16:55:24"},{"id":110,"work_id":"inbound-e-20261024-custom-number-loss","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":null,\"serial\":\"AGENTB-IE-CUSTOM\"}","a_values_json":"{\"ie_custom_text\":\"IE custom genuine newer B\",\"ie_custom_number\":12.75}","a_change_times_json":"{\"ie_custom_number\":{\"changed_at\":\"2026-10-24T16:55:24+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[38]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966101,"b_items_id":6,"link_state":"Active","processing_started_at":"2026-10-24 16:55:24","status":"Failed","result_json":"{\"b_items_id\":6,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_custom_text\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_custom_number\",\"outcome\":\"Failed\",\"reason\":\"Save failed: local write or reread did not confirm the intended value\"}]}","error":"Snapshot 38: Both snapshot still awaits matching A handling: ie_custom_number","date_creation":"2026-10-24 16:55:24","date_mod":"2026-10-24 16:55:24","completed_at":null},{"id":111,"work_id":"inbound-e-20261024-exact-selected-newer-unlisted","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE A after disputed before unrelated\",\"ie_native_b\":\"IE A latest correction winner\",\"ie_equal\":\"IE unrelated later field\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IC Maker\",\"ie_fields_a\":\"IE Fields A after disputed\",\"ie_fields_b\":\"IE Fields B genuine newer\",\"ie_number\":1}","a_change_times_json":"{\"ie_native_b\":{\"changed_at\":\"2026-10-24T16:55:24+08:00\",\"reliable\":true},\"ie_option\":{\"changed_at\":\"2026-10-24T16:55:24+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[40]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966001,"b_items_id":157,"link_state":"Active","processing_started_at":"2026-10-24 16:55:24","status":"Done","result_json":"{\"b_items_id\":157,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[40],\"field_outcomes\":[{\"mapping_id\":\"ie_native_a\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_native_b\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ie_equal\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_unknown\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_option\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ie_fields_a\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_fields_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:55:24","date_mod":"2026-10-24 16:55:24","completed_at":"2026-10-24 16:55:24"}]
```

### Curl 36 — IE final exact snapshots evidence attempts and independent Pending rows

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncChange?searchText%5Broute_id%5D=%5Einbound-e-20261024-&range=0-99&sort=id&order=ASC&get_hateoas=false

Account user12/profile14/entity0; HTTP 200

Exact request body:
```json
null
```

Exact response:
```json
[{"id":31,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":157,\"serial\":\"AGENTB-IE-MAIN\"}","changed_fields_json":"{\"ie_native_a\":{\"value\":\"IE native genuine B\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true},\"ie_native_b\":{\"value\":\"IE B genuine newer\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true},\"ie_option\":{\"value\":\"AgentB IE Maker B\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:52:02","date_mod":"2026-10-24 16:52:02","done_at":null},{"id":32,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":157,\"serial\":\"AGENTB-IE-MAIN\"}","changed_fields_json":"{\"ie_fields_a\":{\"value\":\"IE Fields A genuine B\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true},\"ie_fields_b\":{\"value\":\"IE Fields B genuine newer\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:52:02","date_mod":"2026-10-24 16:52:02","done_at":null},{"id":33,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":6,\"serial\":\"AGENTB-IE-CUSTOM\"}","changed_fields_json":"{\"ie_custom_text\":{\"value\":\"IE custom genuine B\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:52:02","date_mod":"2026-10-24 16:52:02","done_at":null},{"id":34,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":157,\"serial\":\"AGENTB-IE-MAIN\"}","changed_fields_json":"{\"ie_native_a\":{\"value\":\"IE native tie B\",\"changed_at\":\"2026-10-24T16:52:38+08:00\",\"reliable\":true}}","status":"Done","retry_count":2,"error":null,"date_creation":"2026-10-24 16:52:38","date_mod":"2026-10-24 16:53:27","done_at":"2026-10-24 16:53:27"},{"id":35,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":157,\"serial\":\"AGENTB-IE-MAIN\"}","changed_fields_json":"{\"ie_fields_a\":{\"value\":\"IE Fields tie B\",\"changed_at\":\"2026-10-24T16:52:38+08:00\",\"reliable\":true}}","status":"Done","retry_count":2,"error":null,"date_creation":"2026-10-24 16:52:38","date_mod":"2026-10-24 16:53:27","done_at":"2026-10-24 16:53:27"},{"id":36,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":6,\"serial\":\"AGENTB-IE-CUSTOM\"}","changed_fields_json":"{\"ie_custom_text\":{\"value\":\"IE custom genuine newer B\",\"changed_at\":\"2026-10-24T16:53:10+08:00\",\"reliable\":true}}","status":"Done","retry_count":2,"error":null,"date_creation":"2026-10-24 16:53:10","date_mod":"2026-10-24 16:54:52","done_at":"2026-10-24 16:54:52"},{"id":37,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":157,\"serial\":\"AGENTB-IE-MAIN\"}","changed_fields_json":"{\"ie_equal\":{\"value\":\"IE unrelated later field\",\"changed_at\":\"2026-10-24T16:53:27+08:00\",\"reliable\":true}}","status":"Done","retry_count":2,"error":null,"date_creation":"2026-10-24 16:53:27","date_mod":"2026-10-24 16:54:52","done_at":"2026-10-24 16:54:52"},{"id":38,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":6,\"serial\":\"AGENTB-IE-CUSTOM\"}","changed_fields_json":"{\"ie_custom_number\":{\"value\":2,\"changed_at\":\"2026-10-24T16:54:53+08:00\",\"reliable\":true}}","status":"Pending","retry_count":1,"error":"Snapshot 38: Both snapshot still awaits matching A handling: ie_custom_number","date_creation":"2026-10-24 16:54:53","date_mod":"2026-10-24 16:55:24","done_at":null},{"id":39,"route_id":"inbound-e-20261024-seed","settings_version":1,"a_entities_id":9601,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":null,\"b_items_id\":6,\"serial\":\"AGENTB-IE-CUSTOM\"}","changed_fields_json":"{\"ie_seed_number\":{\"value\":2,\"changed_at\":\"2026-10-24T16:54:53+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:54:53","date_mod":"2026-10-24 16:54:53","done_at":null},{"id":40,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":157,\"serial\":\"AGENTB-IE-MAIN\"}","changed_fields_json":"{\"ie_native_b\":{\"value\":\"IE selected correction B\",\"changed_at\":\"2026-10-24T16:54:53+08:00\",\"reliable\":true}}","status":"Done","retry_count":1,"error":null,"date_creation":"2026-10-24 16:54:53","date_mod":"2026-10-24 16:55:24","done_at":"2026-10-24 16:55:24"},{"id":41,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":157,\"serial\":\"AGENTB-IE-MAIN\"}","changed_fields_json":"{\"ie_native_b\":{\"value\":\"IE newer unselected B\",\"changed_at\":\"2026-10-24T16:54:53+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:54:53","date_mod":"2026-10-24 16:54:53","done_at":null},{"id":42,"route_id":"inbound-e-20261024-main","settings_version":1,"a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":6,\"serial\":\"AGENTB-IE-CUSTOM\"}","changed_fields_json":"{\"ie_custom_number\":{\"value\":3,\"changed_at\":\"2026-10-24T16:55:25+08:00\",\"reliable\":true}}","status":"Pending","retry_count":0,"error":null,"date_creation":"2026-10-24 16:55:25","date_mod":"2026-10-24 16:55:25","done_at":null}]
```

### Curl 37 — IE disable only fresh main route after evidence

PUT http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/15

Account user12/profile14/entity0; HTTP 200

Exact request body:
```json
{"input":{"id":15,"route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"route_enabled":0,"settings_version":2,"enabled_itemtypes_json":"[\"Computer\",\"Glpi\\\\CustomAsset\\\\AgentBIE20261024Asset\"]","field_mappings_json":"[{\"mapping_id\":\"ie_native_a\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_native_b\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"comment\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_equal\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_unknown\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact_num\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"manufacturers_id\"},\"source\":\"Both\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"ie_fields_a\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbiex\",\"name\":\"ietextafield\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_fields_b\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbiex\",\"name\":\"ietextbfield\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_number\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbiex\",\"name\":\"ienumericfield\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_custom_text\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIE20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ie_text\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_custom_number\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIE20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ie_number\"},\"source\":\"Both\",\"value_mode\":\"direct\"}]"}}
```

Exact response:
```json
[{"15":true,"message":""}]
```

### Curl 38 — IE fresh main route disabled readback

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/15?get_hateoas=false

Account user12/profile14/entity0; HTTP 200

Exact request body:
```json
null
```

Exact response:
```json
{"id":15,"route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"route_enabled":0,"settings_version":2,"enabled_itemtypes_json":"[\"Computer\",\"Glpi\\\\CustomAsset\\\\AgentBIE20261024Asset\"]","field_mappings_json":"[{\"mapping_id\":\"ie_native_a\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_native_b\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"comment\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_equal\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_unknown\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"contact_num\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_option\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"manufacturers_id\"},\"source\":\"Both\",\"value_mode\":\"text_to_dropdown\"},{\"mapping_id\":\"ie_fields_a\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbiex\",\"name\":\"ietextafield\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_fields_b\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbiex\",\"name\":\"ietextbfield\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_number\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"fields\",\"container\":\"agentbiex\",\"name\":\"ienumericfield\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_custom_text\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIE20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ie_text\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_custom_number\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIE20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ie_number\"},\"source\":\"Both\",\"value_mode\":\"direct\"}]"}
```

### Curl 39 — IE fresh precision route disabled readback

GET http://localhost:8081/api.php/v1/PluginAgentbdmosassetsyncSetting/16?get_hateoas=false

Account user12/profile14/entity0; HTTP 200

Exact request body:
```json
null
```

Exact response:
```json
{"id":16,"route_id":"inbound-e-20261024-seed","a_entities_id":9601,"entities_id":0,"route_enabled":0,"settings_version":2,"enabled_itemtypes_json":"[\"Glpi\\\\CustomAsset\\\\AgentBIE20261024Asset\"]","field_mappings_json":"[{\"mapping_id\":\"ie_seed_serial\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIE20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"serial\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_seed_text\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIE20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ie_text\"},\"source\":\"Both\",\"value_mode\":\"direct\"},{\"mapping_id\":\"ie_seed_number\",\"itemtype\":\"Glpi\\\\CustomAsset\\\\AgentBIE20261024Asset\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"custom_ie_number\"},\"source\":\"Both\",\"value_mode\":\"direct\"}]"}
```

### Curl 40 — IE close created session

GET http://localhost:8081/api.php/v1/killSession

Account user12/profile14/entity0; HTTP 200

Exact request body:
```json
null
```

Exact response:
```json
true
```

## Complete native operator ledger

### Local 1 — IE fresh Fields scalar container custom definition and option

User2; exit 0. Native bootstrap as above.

```php
Session::changeProfile(4);$c=new PluginFieldsContainer();$cid=$c->add(['label'=>'AgentB IE X','itemtypes'=>['Computer'],'type'=>'tab','subtype'=>'','entities_id'=>0,'is_recursive'=>0,'is_active'=>1]);$p=new PluginFieldsProfile();$rights=[];foreach($p->find(['plugin_fields_containers_id'=>$cid])as$r){$rights[(int)$r['profiles_id']]=(int)$r['profiles_id']===14?CREATE:0;}PluginFieldsProfile::updateProfile(['plugin_fields_containers_id'=>$cid,'rights'=>$rights]);$ff=[];foreach([['IE text A','text'],['IE text B','text'],['IE numeric','number']]as[$label,$kind]){$f=new PluginFieldsField();$f->add(['plugin_fields_containers_id'=>$cid,'label'=>$label,'type'=>$kind,'is_active'=>1,'is_readonly'=>0,'multiple'=>0,'mandatory'=>0]);$ff[]=$f->fields;}$d=new \Glpi\Asset\AssetDefinition();$d->add(['system_name'=>'AgentBIE20261024','label'=>'AgentB IE','is_active'=>1,'profiles'=>[14=>7]]);$cf=[];foreach([['ie_text','StringType'],['ie_number','NumberType']]as[$n,$k]){$f=new \Glpi\Asset\CustomFieldDefinition();$f->add(['assets_assetdefinitions_id'=>$d->getID(),'system_name'=>$n,'label'=>$n,'type'=>'Glpi\\Asset\\CustomFieldType\\'.$k,'field_options'=>[]]);$cf[]=$f->fields;}$m=new Manufacturer();$m->add(['name'=>'AgentB IE Maker B']);$cl=PluginFieldsContainer::getClassname('Computer',$c->fields['name']);echo json_encode(['container'=>$c->fields,'fields'=>$ff,'rights'=>array_values($p->find(['plugin_fields_containers_id'=>$cid])),'storage'=>$cl,'schema'=>$DB->listFields($cl::getTable()),'definition'=>$d->fields,'class'=>$d->getCustomObjectClassName(),'customFields'=>$cf,'manufacturer'=>$m->getID()]);
```

Exact stdout:
```json
{"container":{"id":11,"name":"agentbiex","label":"AgentB IE X","itemtypes":"[\"Computer\"]","type":"tab","subtype":"","entities_id":0,"is_recursive":0,"is_active":1},"fields":[{"id":69,"name":"ietextafield","label":"IE text A","type":"text","plugin_fields_containers_id":11,"ranking":1,"default_value":null,"is_active":1,"is_readonly":0,"mandatory":0,"multiple":0,"allowed_values":null},{"id":70,"name":"ietextbfield","label":"IE text B","type":"text","plugin_fields_containers_id":11,"ranking":1,"default_value":null,"is_active":1,"is_readonly":0,"mandatory":0,"multiple":0,"allowed_values":null},{"id":71,"name":"ienumericfield","label":"IE numeric","type":"number","plugin_fields_containers_id":11,"ranking":1,"default_value":null,"is_active":1,"is_readonly":0,"mandatory":0,"multiple":0,"allowed_values":null}],"rights":[{"id":125,"profiles_id":1,"plugin_fields_containers_id":11,"right":"0"},{"id":126,"profiles_id":2,"plugin_fields_containers_id":11,"right":"0"},{"id":127,"profiles_id":3,"plugin_fields_containers_id":11,"right":"0"},{"id":128,"profiles_id":4,"plugin_fields_containers_id":11,"right":"0"},{"id":129,"profiles_id":5,"plugin_fields_containers_id":11,"right":"0"},{"id":130,"profiles_id":6,"plugin_fields_containers_id":11,"right":"0"},{"id":131,"profiles_id":7,"plugin_fields_containers_id":11,"right":"0"},{"id":132,"profiles_id":8,"plugin_fields_containers_id":11,"right":"0"},{"id":133,"profiles_id":9,"plugin_fields_containers_id":11,"right":"0"},{"id":134,"profiles_id":10,"plugin_fields_containers_id":11,"right":"0"},{"id":135,"profiles_id":11,"plugin_fields_containers_id":11,"right":"0"},{"id":136,"profiles_id":12,"plugin_fields_containers_id":11,"right":"0"},{"id":137,"profiles_id":13,"plugin_fields_containers_id":11,"right":"0"},{"id":138,"profiles_id":14,"plugin_fields_containers_id":11,"right":"4"},{"id":139,"profiles_id":15,"plugin_fields_containers_id":11,"right":"0"}],"storage":"PluginFieldsComputeragentbiex","schema":{"id":{"Field":"id","Type":"int unsigned","Null":"NO","Key":"PRI","Default":null,"Extra":"auto_increment"},"items_id":{"Field":"items_id","Type":"int unsigned","Null":"NO","Key":"","Default":null,"Extra":""},"itemtype":{"Field":"itemtype","Type":"varchar(255)","Null":"YES","Key":"MUL","Default":"Computer","Extra":""},"plugin_fields_containers_id":{"Field":"plugin_fields_containers_id","Type":"int unsigned","Null":"NO","Key":"","Default":"11","Extra":""},"entities_id":{"Field":"entities_id","Type":"int unsigned","Null":"NO","Key":"MUL","Default":"0","Extra":""},"ietextafield":{"Field":"ietextafield","Type":"varchar(255)","Null":"YES","Key":"","Default":null,"Extra":""},"ietextbfield":{"Field":"ietextbfield","Type":"varchar(255)","Null":"YES","Key":"","Default":null,"Extra":""}},"definition":{"id":5,"system_name":"AgentBIE20261024","label":"AgentB IE","icon":null,"picture":null,"comment":null,"is_active":1,"capacities":"[]","profiles":"{\"14\": 7}","translations":"[]","fields_display":"[]","date_creation":"2026-10-24 16:50:31","date_mod":"2026-10-24 16:50:31"},"class":"Glpi\\CustomAsset\\AgentBIE20261024Asset","customFields":[{"id":18,"assets_assetdefinitions_id":5,"system_name":"ie_text","label":"ie_text","type":"Glpi\\Asset\\CustomFieldType\\StringType","field_options":[],"itemtype":null,"default_value":null,"translations":"[]","date_creation":"2026-10-24 16:50:31","date_mod":"2026-10-24 16:50:31"},{"id":19,"assets_assetdefinitions_id":5,"system_name":"ie_number","label":"ie_number","type":"Glpi\\Asset\\CustomFieldType\\NumberType","field_options":[],"itemtype":null,"default_value":null,"translations":"[]","date_creation":"2026-10-24 16:50:31","date_mod":"2026-10-24 16:50:31"}],"manufacturer":8}
```

Stderr:
```text

```

### Local 2 — IE equal numeric scalars and all Both no-write baseline

User2; exit 0. Native bootstrap as above.

```php
$_SESSION['glpicronuserrunning']='IE scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=$before?iterator_to_array($DB->request(['FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC'])):[];$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','contextAfter')+['task_state'=>$t->fields['state'],'queue_count'=>countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[])]);
```

Exact stdout:
```json
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"90":{"id":90,"work_id":"inbound-e-20261024-equal-no-time","status":"Accepted"},"91":{"id":91,"work_id":"inbound-e-20261024-custom-equal-no-time","status":"Accepted"}},"after":{"90":{"id":90,"work_id":"inbound-e-20261024-equal-no-time","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE native initial\",\"ie_native_b\":\"IE B initial\",\"ie_equal\":\"IE equal\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IC Maker\",\"ie_fields_a\":\"IE Fields A initial\",\"ie_fields_b\":\"IE Fields B initial\",\"ie_number\":1.0}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966001,"b_items_id":157,"link_state":"Active","processing_started_at":"2026-10-24 16:50:50","status":"Done","result_json":"{\"b_items_id\":157,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_native_a\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_native_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_equal\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_unknown\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_option\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_fields_a\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_fields_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:50:50","date_mod":"2026-10-24 16:50:50","completed_at":"2026-10-24 16:50:50"},"91":{"id":91,"work_id":"inbound-e-20261024-custom-equal-no-time","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":null,\"serial\":\"AGENTB-IE-CUSTOM\"}","a_values_json":"{\"ie_custom_text\":\"IE custom initial\",\"ie_custom_number\":1.00}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966101,"b_items_id":6,"link_state":"Active","processing_started_at":"2026-10-24 16:50:50","status":"Done","result_json":"{\"b_items_id\":6,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_custom_text\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_custom_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:50:50","date_mod":"2026-10-24 16:50:50","completed_at":"2026-10-24 16:50:50"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1,"queue_count":30}
```

Stderr:
```text

```

### Local 3 — IE metadata raw numeric storage and equality History queue baseline

User12; exit 0. Native bootstrap as above.

```php
echo json_encode(['storage'=>(new PluginFieldsComputeragentbiex())->find(['items_id'=>157]),'schema'=>$DB->listFields(PluginFieldsComputeragentbiex::getTable()),'asset'=>(new Computer())->find(['id'=>157]),'history'=>iterator_to_array($DB->request(['FROM'=>Log::getTable(),'WHERE'=>['itemtype'=>'Computer','items_id'=>157],'ORDER'=>'id ASC'])),'queue_count'=>countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[])]);
```

Exact stdout:
```json
{"storage":{"1":{"id":1,"items_id":157,"itemtype":"Computer","plugin_fields_containers_id":11,"entities_id":0,"ietextafield":"IE Fields A initial","ietextbfield":"IE Fields B initial","ienumericfield":"1.00"}},"schema":{"id":{"Field":"id","Type":"int unsigned","Null":"NO","Key":"PRI","Default":null,"Extra":"auto_increment"},"items_id":{"Field":"items_id","Type":"int unsigned","Null":"NO","Key":"","Default":null,"Extra":""},"itemtype":{"Field":"itemtype","Type":"varchar(255)","Null":"YES","Key":"MUL","Default":"Computer","Extra":""},"plugin_fields_containers_id":{"Field":"plugin_fields_containers_id","Type":"int unsigned","Null":"NO","Key":"","Default":"11","Extra":""},"entities_id":{"Field":"entities_id","Type":"int unsigned","Null":"NO","Key":"MUL","Default":"0","Extra":""},"ietextafield":{"Field":"ietextafield","Type":"varchar(255)","Null":"YES","Key":"","Default":null,"Extra":""},"ietextbfield":{"Field":"ietextbfield","Type":"varchar(255)","Null":"YES","Key":"","Default":null,"Extra":""},"ienumericfield":{"Field":"ienumericfield","Type":"varchar(255)","Null":"YES","Key":"","Default":null,"Extra":""}},"asset":{"157":{"id":157,"entities_id":0,"name":"IE native initial","serial":"AGENTB-IE-MAIN","otherserial":null,"contact":"IE equal","contact_num":"IE no clock","users_id_tech":0,"comment":"IE B initial","date_mod":"2026-10-24 16:50:31","autoupdatesystems_id":0,"locations_id":0,"networks_id":0,"computermodels_id":0,"computertypes_id":0,"is_template":0,"template_name":null,"manufacturers_id":7,"is_deleted":0,"is_dynamic":0,"users_id":0,"states_id":0,"ticket_tco":"0.0000","uuid":null,"date_creation":"2026-10-24 16:50:31","is_recursive":0,"last_inventory_update":null,"last_boot":null}},"history":{"141379":{"id":141379,"itemtype":"Computer","items_id":157,"itemtype_link":"0","linked_action":20,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:50:31","id_search_option":0,"old_value":"","new_value":"","old_id":null,"new_id":null},"141380":{"id":141380,"itemtype":"Computer","items_id":157,"itemtype_link":"PluginFieldsComputeragentbiex","linked_action":17,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:50:31","id_search_option":0,"old_value":"","new_value":"N\/A (1)","old_id":null,"new_id":null}},"queue_count":30}
```

Stderr:
```text

```

### Local 4 — IE exact numeric literal duplicate member and typed comparison readonly proof

User12; exit 0. Native bootstrap as above.

```php
require_once '/var/www/glpi/plugins/agentbdmosassetsync/inc/fields.php';require_once '/var/www/glpi/plugins/agentbdmosassetsync/inc/both.php';$rows=[];foreach(['{"x":9007199254740993.0}','{"x":9.007199254740993e15}','{"x":1,"x":9007199254740993.0}','{"x":9007199254740993.0,"x":1}','{"x":9007199254740993.0,"x":"9007199254740993.0"}','{"x":"1"}','{"x":true}']as$json){$d=json_decode($json);try{$v=plugin_agentbdmosassetsync_exact_work_value(['a_values_json'=>$json],'x',$d->x);$rows[]=['raw'=>$json,'value'=>$v,'phpType'=>get_debug_type($v)];}catch(Throwable $e){$rows[]=['raw'=>$json,'error'=>$e->getMessage()];}}$m=(object)['value_mode'=>'direct'];$typed=[];foreach([true,'1',1,1.0]as$v){try{$typed[]=['input'=>$v,'canonical'=>plugin_agentbdmosassetsync_comparison_value(['kind'=>'number'],$m,$v)];}catch(Throwable $e){$typed[]=['input'=>$v,'error'=>$e->getMessage()];}}echo json_encode(['exact'=>$rows,'types'=>$typed,'neighborEquality'=>plugin_agentbdmosassetsync_scalar_equal(9007199254740992,9007199254740993),'decimalSQLCanonical'=>plugin_agentbdmosassetsync_field_value(['kind'=>'number'],'1.00'),'decimalSQLsame'=>plugin_agentbdmosassetsync_scalar_equal(plugin_agentbdmosassetsync_field_value(['kind'=>'number'],'1.00'),1.0)]);
```

Exact stdout:
```json
{"exact":[{"raw":"{\"x\":9007199254740993.0}","value":9007199254740993,"phpType":"int"},{"raw":"{\"x\":9.007199254740993e15}","value":9007199254740993,"phpType":"int"},{"raw":"{\"x\":1,\"x\":9007199254740993.0}","value":9007199254740993,"phpType":"int"},{"raw":"{\"x\":9007199254740993.0,\"x\":1}","value":1,"phpType":"int"},{"raw":"{\"x\":9007199254740993.0,\"x\":\"9007199254740993.0\"}","value":"9007199254740993.0","phpType":"string"},{"raw":"{\"x\":\"1\"}","value":"1","phpType":"string"},{"raw":"{\"x\":true}","value":true,"phpType":"bool"}],"types":[{"input":true,"error":"A value has no compatible scalar comparison type"},{"input":"1","error":"A value has no compatible scalar comparison type"},{"input":1,"canonical":1},{"input":1,"canonical":1}],"neighborEquality":false,"decimalSQLCanonical":1,"decimalSQLsame":true}
```

Stderr:
```text

```

### Local 5 — IE actual independent winners and custom A save with guard

User2; exit 0. Native bootstrap as above.

```php
$_SESSION['glpicronuserrunning']='IE scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=$before?iterator_to_array($DB->request(['FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC'])):[];$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','contextAfter')+['task_state'=>$t->fields['state'],'queue_count'=>countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[])]);
```

Exact stdout:
```json
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"92":{"id":92,"work_id":"inbound-e-20261024-mixed-winners","status":"Accepted"},"93":{"id":93,"work_id":"inbound-e-20261024-custom-A-newer","status":"Accepted"}},"after":{"92":{"id":92,"work_id":"inbound-e-20261024-mixed-winners","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE A newer winner\",\"ie_native_b\":\"IE A older losing value\",\"ie_equal\":\"IE equal\",\"ie_unknown\":\"IE unequal no B clock\",\"ie_option\":\"IE missing losing option\",\"ie_fields_a\":\"IE Fields A newer winner\",\"ie_fields_b\":\"IE Fields B older A\",\"ie_number\":1}","a_change_times_json":"{\"ie_native_a\":{\"changed_at\":\"2026-10-24T16:52:37+08:00\",\"reliable\":true},\"ie_native_b\":{\"changed_at\":\"2026-10-24T16:51:44+08:00\",\"reliable\":true},\"ie_unknown\":{\"changed_at\":\"2026-10-24T16:52:37+08:00\",\"reliable\":true},\"ie_option\":{\"changed_at\":\"2026-10-24T16:51:44+08:00\",\"reliable\":true},\"ie_fields_a\":{\"changed_at\":\"2026-10-24T16:52:37+08:00\",\"reliable\":true},\"ie_fields_b\":{\"changed_at\":\"2026-10-24T16:51:44+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966001,"b_items_id":157,"link_state":"Active","processing_started_at":"2026-10-24 16:52:38","status":"Held","result_json":"{\"b_items_id\":157,\"created_b_items_id\":null,\"b_values_for_a\":{\"ie_native_b\":{\"value\":\"IE B genuine newer\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true},\"ie_option\":{\"value\":\"AgentB IE Maker B\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true},\"ie_fields_b\":{\"value\":\"IE Fields B genuine newer\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true}},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_native_a\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ie_native_b\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"ie_equal\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_unknown\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values lack two reliable genuine field times\"},{\"mapping_id\":\"ie_option\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"ie_fields_a\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ie_fields_b\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"ie_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":"Unequal Both values lack two reliable genuine field times","date_creation":"2026-10-24 16:52:38","date_mod":"2026-10-24 16:52:38","completed_at":null},"93":{"id":93,"work_id":"inbound-e-20261024-custom-A-newer","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":null,\"serial\":\"AGENTB-IE-CUSTOM\"}","a_values_json":"{\"ie_custom_text\":\"IE custom A winner\",\"ie_custom_number\":1.0}","a_change_times_json":"{\"ie_custom_text\":{\"changed_at\":\"2026-10-24T16:52:37+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966101,"b_items_id":6,"link_state":"Active","processing_started_at":"2026-10-24 16:52:38","status":"Done","result_json":"{\"b_items_id\":6,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_custom_text\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ie_custom_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:52:38","date_mod":"2026-10-24 16:52:38","completed_at":"2026-10-24 16:52:38"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1,"queue_count":33}
```

Stderr:
```text

```

### Local 6 — IE current-value mismatch yields honest conflicts

User2; exit 0. Native bootstrap as above.

```php
$_SESSION['glpicronuserrunning']='IE scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=$before?iterator_to_array($DB->request(['FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC'])):[];$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','contextAfter')+['task_state'=>$t->fields['state'],'queue_count'=>countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[])]);
```

Exact stdout:
```json
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"94":{"id":94,"work_id":"inbound-e-20261024-current-mismatch-no-borrow","status":"Accepted"}},"after":{"94":{"id":94,"work_id":"inbound-e-20261024-current-mismatch-no-borrow","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE another unequal A\",\"ie_native_b\":\"IE B genuine newer\",\"ie_equal\":\"IE equal\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IE Maker B\",\"ie_fields_a\":\"IE another unequal Fields A\",\"ie_fields_b\":\"IE Fields B genuine newer\",\"ie_number\":1}","a_change_times_json":"{\"ie_native_a\":{\"changed_at\":\"2026-10-24T16:52:37+08:00\",\"reliable\":true},\"ie_fields_a\":{\"changed_at\":\"2026-10-24T16:52:37+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966001,"b_items_id":157,"link_state":"Active","processing_started_at":"2026-10-24 16:52:38","status":"Held","result_json":"{\"b_items_id\":157,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_native_a\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values lack two reliable genuine field times\"},{\"mapping_id\":\"ie_native_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_equal\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_unknown\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_option\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_fields_a\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values lack two reliable genuine field times\"},{\"mapping_id\":\"ie_fields_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":"Unequal Both values lack two reliable genuine field times","date_creation":"2026-10-24 16:52:38","date_mod":"2026-10-24 16:52:38","completed_at":null}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1,"queue_count":33}
```

Stderr:
```text

```

### Local 7 — IE trustworthy ties and unavailable A times remain unresolved

User2; exit 0. Native bootstrap as above.

```php
$_SESSION['glpicronuserrunning']='IE scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=$before?iterator_to_array($DB->request(['FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC'])):[];$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','contextAfter')+['task_state'=>$t->fields['state'],'queue_count'=>countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[])]);
```

Exact stdout:
```json
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"95":{"id":95,"work_id":"inbound-e-20261024-tie-both","status":"Accepted"},"96":{"id":96,"work_id":"inbound-e-20261024-missing-unreliable-A","status":"Accepted"}},"after":{"95":{"id":95,"work_id":"inbound-e-20261024-tie-both","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE tie unequal A\",\"ie_native_b\":\"IE B genuine newer\",\"ie_equal\":\"IE equal\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IE Maker B\",\"ie_fields_a\":\"IE Fields tie unequal A\",\"ie_fields_b\":\"IE Fields B genuine newer\",\"ie_number\":1}","a_change_times_json":"{\"ie_native_a\":{\"changed_at\":\"2026-10-24T16:52:38+08:00\",\"reliable\":true},\"ie_fields_a\":{\"changed_at\":\"2026-10-24T16:52:38+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[34,35]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966001,"b_items_id":157,"link_state":"Active","processing_started_at":"2026-10-24 16:53:10","status":"Held","result_json":"{\"b_items_id\":157,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_native_a\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values have equal genuine field times\"},{\"mapping_id\":\"ie_native_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_equal\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_unknown\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_option\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_fields_a\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values have equal genuine field times\"},{\"mapping_id\":\"ie_fields_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":"Snapshot 34: Both snapshot still awaits matching A handling: ie_native_a; Snapshot 35: Both snapshot still awaits matching A handling: ie_fields_a","date_creation":"2026-10-24 16:53:10","date_mod":"2026-10-24 16:53:10","completed_at":null},"96":{"id":96,"work_id":"inbound-e-20261024-missing-unreliable-A","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE missing A clock\",\"ie_native_b\":\"IE B genuine newer\",\"ie_equal\":\"IE equal\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IE Maker B\",\"ie_fields_a\":\"IE unreliable A clock\",\"ie_fields_b\":\"IE Fields B genuine newer\",\"ie_number\":1}","a_change_times_json":"{\"ie_native_a\":{\"changed_at\":null,\"reliable\":false},\"ie_fields_a\":{\"changed_at\":\"2026-10-24T16:52:37+08:00\",\"reliable\":false}}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966001,"b_items_id":157,"link_state":"Active","processing_started_at":"2026-10-24 16:53:10","status":"Held","result_json":"{\"b_items_id\":157,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_native_a\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values lack two reliable genuine field times\"},{\"mapping_id\":\"ie_native_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_equal\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_unknown\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_option\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_fields_a\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values lack two reliable genuine field times\"},{\"mapping_id\":\"ie_fields_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":"Unequal Both values lack two reliable genuine field times","date_creation":"2026-10-24 16:53:10","date_mod":"2026-10-24 16:53:10","completed_at":null}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1,"queue_count":35}
```

Stderr:
```text

```

### Local 8 — IE restrict only fresh test asset Fields and custom rights to READ

User2; exit 0. Native bootstrap as above.

```php
ProfileRight::updateProfileRights(14,['computer'=>READ]);PluginFieldsProfile::updateProfile(['plugin_fields_containers_id'=>11,'rights'=>[14=>READ]]);$d=new \Glpi\Asset\AssetDefinition();$ok=$d->update(['id'=>5,'profiles'=>[14=>READ]]);echo json_encode(['computer'=>(new ProfileRight())->find(['profiles_id'=>14,'name'=>'computer']),'fields'=>(new PluginFieldsProfile())->find(['profiles_id'=>14,'plugin_fields_containers_id'=>11]),'customUpdate'=>$ok,'definition'=>$d->fields]);
```

Exact stdout:
```json
{"computer":{"1354":{"id":1354,"profiles_id":14,"name":"computer","rights":1}},"fields":{"138":{"id":138,"profiles_id":14,"plugin_fields_containers_id":11,"right":"1"}},"customUpdate":true,"definition":{"id":5,"system_name":"AgentBIE20261024","label":"AgentB IE","icon":null,"picture":null,"comment":null,"is_active":1,"capacities":"[]","profiles":"{\"14\":1}","translations":"[]","fields_display":"[]","date_creation":"2026-10-24 16:50:31","date_mod":"2026-10-24 16:53:10"}}
```

Stderr:
```text

```

### Local 9 — IE actual READ-only winner decisions current UPDATE enforced only on A save

User2; exit 0. Native bootstrap as above.

```php
$_SESSION['glpicronuserrunning']='IE scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=$before?iterator_to_array($DB->request(['FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC'])):[];$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','contextAfter')+['task_state'=>$t->fields['state'],'queue_count'=>countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[])]);
```

Exact stdout:
```json
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"97":{"id":97,"work_id":"inbound-e-20261024-readonly-B-winners","status":"Accepted"},"98":{"id":98,"work_id":"inbound-e-20261024-readonly-A-denied","status":"Accepted"},"99":{"id":99,"work_id":"inbound-e-20261024-custom-readonly-B-winner","status":"Accepted"},"100":{"id":100,"work_id":"inbound-e-20261024-custom-readonly-A-denied","status":"Accepted"}},"after":{"97":{"id":97,"work_id":"inbound-e-20261024-readonly-B-winners","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE native tie B\",\"ie_native_b\":\"IE readonly A old losing\",\"ie_equal\":\"IE equal\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"IE nonexistent losing dropdown\",\"ie_fields_a\":\"IE Fields tie B\",\"ie_fields_b\":\"IE readonly Fields A old losing\",\"ie_number\":1}","a_change_times_json":"{\"ie_native_b\":{\"changed_at\":\"2026-10-24T16:51:44+08:00\",\"reliable\":true},\"ie_fields_b\":{\"changed_at\":\"2026-10-24T16:51:44+08:00\",\"reliable\":true},\"ie_option\":{\"changed_at\":\"2026-10-24T16:51:44+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966001,"b_items_id":157,"link_state":"Active","processing_started_at":"2026-10-24 16:53:26","status":"Done","result_json":"{\"b_items_id\":157,\"created_b_items_id\":null,\"b_values_for_a\":{\"ie_native_b\":{\"value\":\"IE B genuine newer\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true},\"ie_option\":{\"value\":\"AgentB IE Maker B\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true},\"ie_fields_b\":{\"value\":\"IE Fields B genuine newer\",\"changed_at\":\"2026-10-24T16:52:02+08:00\",\"reliable\":true}},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_native_a\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_native_b\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"ie_equal\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_unknown\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_option\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"ie_fields_a\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_fields_b\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"ie_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:53:26","date_mod":"2026-10-24 16:53:26","completed_at":"2026-10-24 16:53:26"},"98":{"id":98,"work_id":"inbound-e-20261024-readonly-A-denied","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"MUST NOT WRITE READONLY NATIVE\",\"ie_native_b\":\"IE B genuine newer\",\"ie_equal\":\"IE equal\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IE Maker B\",\"ie_fields_a\":\"MUST NOT WRITE READONLY FIELDS\",\"ie_fields_b\":\"IE Fields B genuine newer\",\"ie_number\":1}","a_change_times_json":"{\"ie_native_a\":{\"changed_at\":\"2026-10-24T16:53:26+08:00\",\"reliable\":true},\"ie_fields_a\":{\"changed_at\":\"2026-10-24T16:53:26+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966001,"b_items_id":157,"link_state":"Active","processing_started_at":"2026-10-24 16:53:26","status":"Held","result_json":"{\"b_items_id\":157,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_native_a\",\"outcome\":\"Skipped\",\"reason\":\"Hold: A won Both but the current B write is not permitted: Submitting user lacks current asset permission\"},{\"mapping_id\":\"ie_native_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_equal\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_unknown\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_option\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_fields_a\",\"outcome\":\"Skipped\",\"reason\":\"Hold: A won Both but the current B write is not permitted: Submitting user lacks current asset permission\"},{\"mapping_id\":\"ie_fields_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":"Hold: A won Both but the current B write is not permitted: Submitting user lacks current asset permission","date_creation":"2026-10-24 16:53:26","date_mod":"2026-10-24 16:53:26","completed_at":null},"99":{"id":99,"work_id":"inbound-e-20261024-custom-readonly-B-winner","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":null,\"serial\":\"AGENTB-IE-CUSTOM\"}","a_values_json":"{\"ie_custom_text\":\"IE old losing custom A\",\"ie_custom_number\":1}","a_change_times_json":"{\"ie_custom_text\":{\"changed_at\":\"2026-10-24T16:51:44+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966101,"b_items_id":6,"link_state":"Active","processing_started_at":"2026-10-24 16:53:26","status":"Done","result_json":"{\"b_items_id\":6,\"created_b_items_id\":null,\"b_values_for_a\":{\"ie_custom_text\":{\"value\":\"IE custom genuine newer B\",\"changed_at\":\"2026-10-24T16:53:10+08:00\",\"reliable\":true}},\"covered_change_ids\":[36],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_custom_text\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"ie_custom_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:53:26","date_mod":"2026-10-24 16:53:26","completed_at":"2026-10-24 16:53:26"},"100":{"id":100,"work_id":"inbound-e-20261024-custom-readonly-A-denied","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":null,\"serial\":\"AGENTB-IE-CUSTOM\"}","a_values_json":"{\"ie_custom_text\":\"MUST NOT WRITE READONLY CUSTOM\",\"ie_custom_number\":1}","a_change_times_json":"{\"ie_custom_text\":{\"changed_at\":\"2026-10-24T16:53:26+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966101,"b_items_id":6,"link_state":"Active","processing_started_at":"2026-10-24 16:53:26","status":"Held","result_json":"{\"b_items_id\":6,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_custom_text\",\"outcome\":\"Skipped\",\"reason\":\"Hold: A won Both but the current B write is not permitted: Submitting user lacks current asset permission\"},{\"mapping_id\":\"ie_custom_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":"Hold: A won Both but the current B write is not permitted: Submitting user lacks current asset permission","date_creation":"2026-10-24 16:53:26","date_mod":"2026-10-24 16:53:26","completed_at":null}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1,"queue_count":36}
```

Stderr:
```text

```

### Local 10 — IE restore exact fresh asset custom and Fields masks

User2; exit 0. Native bootstrap as above.

```php
ProfileRight::updateProfileRights(14,['computer'=>READ|UPDATE|CREATE]);PluginFieldsProfile::updateProfile(['plugin_fields_containers_id'=>11,'rights'=>[14=>CREATE]]);$d=new \Glpi\Asset\AssetDefinition();$d->update(['id'=>5,'profiles'=>[14=>7]]);echo json_encode(['computer'=>(new ProfileRight())->find(['profiles_id'=>14,'name'=>'computer']),'fields'=>(new PluginFieldsProfile())->find(['profiles_id'=>14,'plugin_fields_containers_id'=>11]),'custom'=>$d->fields['profiles']]);
```

Exact stdout:
```json
{"computer":{"1354":{"id":1354,"profiles_id":14,"name":"computer","rights":7}},"fields":{"138":{"id":138,"profiles_id":14,"plugin_fields_containers_id":11,"right":"4"}},"custom":"{\"14\":7}"}
```

Stderr:
```text

```

### Local 11 — IE A wins original disputed clock and exact correction rows

User2; exit 0. Native bootstrap as above.

```php
$_SESSION['glpicronuserrunning']='IE scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=$before?iterator_to_array($DB->request(['FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC'])):[];$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','contextAfter')+['task_state'=>$t->fields['state'],'queue_count'=>countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[])]);
```

Exact stdout:
```json
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"101":{"id":101,"work_id":"inbound-e-20261024-independent-field-clock","status":"Accepted"}},"after":{"101":{"id":101,"work_id":"inbound-e-20261024-independent-field-clock","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE A after disputed before unrelated\",\"ie_native_b\":\"IE B genuine newer\",\"ie_equal\":\"IE unrelated later field\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IE Maker B\",\"ie_fields_a\":\"IE Fields A after disputed\",\"ie_fields_b\":\"IE Fields B genuine newer\",\"ie_number\":1}","a_change_times_json":"{\"ie_native_a\":{\"changed_at\":\"2026-10-24T16:53:26+08:00\",\"reliable\":true},\"ie_fields_a\":{\"changed_at\":\"2026-10-24T16:53:26+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[34,35]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966001,"b_items_id":157,"link_state":"Active","processing_started_at":"2026-10-24 16:53:27","status":"Done","result_json":"{\"b_items_id\":157,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[34,35],\"field_outcomes\":[{\"mapping_id\":\"ie_native_a\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ie_native_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_equal\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_unknown\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_option\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_fields_a\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ie_fields_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:53:27","date_mod":"2026-10-24 16:53:27","completed_at":"2026-10-24 16:53:27"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1,"queue_count":37}
```

Stderr:
```text

```

### Local 12 — IE B winner remains Pending while AlreadyEqual selected snapshots complete

User2; exit 0. Native bootstrap as above.

```php
$_SESSION['glpicronuserrunning']='IE scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=$before?iterator_to_array($DB->request(['FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC'])):[];$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','contextAfter')+['task_state'=>$t->fields['state'],'queue_count'=>countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[])]);
```

Exact stdout:
```json
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"102":{"id":102,"work_id":"inbound-e-20261024-custom-B-return-pending","status":"Accepted"},"103":{"id":103,"work_id":"inbound-e-20261024-already-equal-exact-correction","status":"Accepted"}},"after":{"102":{"id":102,"work_id":"inbound-e-20261024-custom-B-return-pending","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":null,\"serial\":\"AGENTB-IE-CUSTOM\"}","a_values_json":"{\"ie_custom_text\":\"IE still old A value\",\"ie_custom_number\":1}","a_change_times_json":"{\"ie_custom_text\":{\"changed_at\":\"2026-10-24T16:51:44+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[36]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966101,"b_items_id":6,"link_state":"Active","processing_started_at":"2026-10-24 16:54:03","status":"Held","result_json":"{\"b_items_id\":6,\"created_b_items_id\":null,\"b_values_for_a\":{\"ie_custom_text\":{\"value\":\"IE custom genuine newer B\",\"changed_at\":\"2026-10-24T16:53:10+08:00\",\"reliable\":true}},\"covered_change_ids\":[36],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_custom_text\",\"outcome\":\"ReturnToA\",\"reason\":null},{\"mapping_id\":\"ie_custom_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":"Snapshot 36: Both snapshot still awaits matching A handling: ie_custom_text","date_creation":"2026-10-24 16:54:03","date_mod":"2026-10-24 16:54:03","completed_at":null},"103":{"id":103,"work_id":"inbound-e-20261024-already-equal-exact-correction","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE native initial\",\"ie_native_b\":\"IE B initial\",\"ie_equal\":\"IE equal\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IC Maker\",\"ie_fields_a\":\"IE Fields A initial\",\"ie_fields_b\":\"IE Fields B initial\",\"ie_number\":1}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[34,35,37]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966001,"b_items_id":157,"link_state":"Active","processing_started_at":"2026-10-24 16:54:03","status":"Held","result_json":"{\"b_items_id\":157,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_native_a\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values lack two reliable genuine field times\"},{\"mapping_id\":\"ie_native_b\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values lack two reliable genuine field times\"},{\"mapping_id\":\"ie_equal\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values lack two reliable genuine field times\"},{\"mapping_id\":\"ie_unknown\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_option\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values lack two reliable genuine field times\"},{\"mapping_id\":\"ie_fields_a\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values lack two reliable genuine field times\"},{\"mapping_id\":\"ie_fields_b\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values lack two reliable genuine field times\"},{\"mapping_id\":\"ie_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":"Snapshot 34: Both snapshot still awaits matching A handling: ie_native_a; Snapshot 35: Both snapshot still awaits matching A handling: ie_fields_a; Snapshot 37: Both snapshot still awaits matching A handling: ie_equal","date_creation":"2026-10-24 16:54:03","date_mod":"2026-10-24 16:54:03","completed_at":null}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1,"queue_count":37}
```

Stderr:
```text

```

### Local 13 — IE first-copy exact token preparation and confirmed native numeric reread

User2; exit 0. Native bootstrap as above.

```php
$_SESSION['glpicronuserrunning']='IE scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=$before?iterator_to_array($DB->request(['FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC'])):[];$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','contextAfter')+['task_state'=>$t->fields['state'],'queue_count'=>countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[])]);
```

Exact stdout:
```json
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"104":{"id":104,"work_id":"inbound-e-20261024-precision-first-copy","status":"Accepted"}},"after":{"104":{"id":104,"work_id":"inbound-e-20261024-precision-first-copy","route_id":"inbound-e-20261024-seed","a_entities_id":9601,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966199,\"b_items_id\":null,\"serial\":\"AGENTB-IE-SEED\"}","a_values_json":"{\"ie_seed_serial\":\"AGENTB-IE-SEED\",\"ie_seed_text\":\"IE exact precision seed\",\"ie_seed_number\":9007199254740993.0}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966199,"b_items_id":7,"link_state":"Active","processing_started_at":"2026-10-24 16:54:03","status":"Done","result_json":"{\"b_items_id\":7,\"created_b_items_id\":7,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_seed_serial\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ie_seed_text\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ie_seed_number\",\"outcome\":\"AppliedToB\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:54:03","date_mod":"2026-10-24 16:54:03","completed_at":"2026-10-24 16:54:03"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1,"queue_count":37}
```

Stderr:
```text

```

### Local 14 — IE exact no-op corrections exponent equality and adjacent integer distinction

User2; exit 0. Native bootstrap as above.

```php
$_SESSION['glpicronuserrunning']='IE scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=$before?iterator_to_array($DB->request(['FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC'])):[];$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','contextAfter')+['task_state'=>$t->fields['state'],'queue_count'=>countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[])]);
```

Exact stdout:
```json
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"105":{"id":105,"work_id":"inbound-e-20261024-equal-current-exact-correction","status":"Accepted"},"106":{"id":106,"work_id":"inbound-e-20261024-custom-after-A-saves-B-winner","status":"Accepted"},"107":{"id":107,"work_id":"inbound-e-20261024-precision-exponent-equal","status":"Accepted"},"108":{"id":108,"work_id":"inbound-e-20261024-precision-neighbor-distinct","status":"Accepted"}},"after":{"105":{"id":105,"work_id":"inbound-e-20261024-equal-current-exact-correction","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE A after disputed before unrelated\",\"ie_native_b\":\"IE B genuine newer\",\"ie_equal\":\"IE unrelated later field\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IE Maker B\",\"ie_fields_a\":\"IE Fields A after disputed\",\"ie_fields_b\":\"IE Fields B genuine newer\",\"ie_number\":1}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[34,35,37]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966001,"b_items_id":157,"link_state":"Active","processing_started_at":"2026-10-24 16:54:52","status":"Done","result_json":"{\"b_items_id\":157,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[34,35,37],\"field_outcomes\":[{\"mapping_id\":\"ie_native_a\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_native_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_equal\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_unknown\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_option\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_fields_a\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_fields_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:54:52","date_mod":"2026-10-24 16:54:52","completed_at":"2026-10-24 16:54:52"},"106":{"id":106,"work_id":"inbound-e-20261024-custom-after-A-saves-B-winner","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":null,\"serial\":\"AGENTB-IE-CUSTOM\"}","a_values_json":"{\"ie_custom_text\":\"IE custom genuine newer B\",\"ie_custom_number\":1}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[36]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966101,"b_items_id":6,"link_state":"Active","processing_started_at":"2026-10-24 16:54:52","status":"Done","result_json":"{\"b_items_id\":6,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[36],\"field_outcomes\":[{\"mapping_id\":\"ie_custom_text\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_custom_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:54:52","date_mod":"2026-10-24 16:54:52","completed_at":"2026-10-24 16:54:52"},"107":{"id":107,"work_id":"inbound-e-20261024-precision-exponent-equal","route_id":"inbound-e-20261024-seed","a_entities_id":9601,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966199,\"b_items_id\":null,\"serial\":\"AGENTB-IE-SEED\"}","a_values_json":"{\"ie_seed_serial\":\"AGENTB-IE-SEED\",\"ie_seed_text\":\"IE exact precision seed\",\"ie_seed_number\":9.007199254740993e15}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966199,"b_items_id":7,"link_state":"Active","processing_started_at":"2026-10-24 16:54:52","status":"Done","result_json":"{\"b_items_id\":7,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_seed_serial\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_seed_text\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_seed_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:54:52","date_mod":"2026-10-24 16:54:52","completed_at":"2026-10-24 16:54:52"},"108":{"id":108,"work_id":"inbound-e-20261024-precision-neighbor-distinct","route_id":"inbound-e-20261024-seed","a_entities_id":9601,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966199,\"b_items_id\":null,\"serial\":\"AGENTB-IE-SEED\"}","a_values_json":"{\"ie_seed_serial\":\"AGENTB-IE-SEED\",\"ie_seed_text\":\"IE exact precision seed\",\"ie_seed_number\":9007199254740992.0}","a_change_times_json":"{}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966199,"b_items_id":7,"link_state":"Active","processing_started_at":"2026-10-24 16:54:52","status":"Held","result_json":"{\"b_items_id\":7,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_seed_serial\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_seed_text\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_seed_number\",\"outcome\":\"Conflict\",\"reason\":\"Unequal Both values lack two reliable genuine field times\"}]}","error":"Unequal Both values lack two reliable genuine field times","date_creation":"2026-10-24 16:54:52","date_mod":"2026-10-24 16:54:52","completed_at":null}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1,"queue_count":37}
```

Stderr:
```text

```

### Local 15 — IE missing winning option definite numeric loss and exact selected completion

User2; exit 0. Native bootstrap as above.

```php
$_SESSION['glpicronuserrunning']='IE scoped manual runner';$contextBefore=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$before=iterator_to_array($DB->request(['SELECT'=>['id','work_id','status'],'FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['status'=>'Accepted'],'ORDER'=>'id ASC']));$t=new CronTask();$t->getFromDB(51);$started=$t->start();$ret=null;if($started){try{$ret=PluginAgentbdmosassetsyncWork::cronProcessWork($t);}finally{$t->end($ret??-1);}}$after=$before?iterator_to_array($DB->request(['FROM'=>PluginAgentbdmosassetsyncWork::getTable(),'WHERE'=>['id'=>array_column($before,'id')],'ORDER'=>'id ASC'])):[];$contextAfter=['user'=>Session::getLoginUserID(),'profile'=>$_SESSION['glpiactiveprofile']['id']??null,'cron'=>Session::isCron()];$t->getFromDB(51);echo json_encode(compact('contextBefore','started','ret','before','after','contextAfter')+['task_state'=>$t->fields['state'],'queue_count'=>countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[])]);
```

Exact stdout:
```json
{"contextBefore":{"user":2,"profile":4,"cron":true},"started":true,"ret":1,"before":{"109":{"id":109,"work_id":"inbound-e-20261024-winning-option-missing","status":"Accepted"},"110":{"id":110,"work_id":"inbound-e-20261024-custom-number-loss","status":"Accepted"},"111":{"id":111,"work_id":"inbound-e-20261024-exact-selected-newer-unlisted","status":"Accepted"}},"after":{"109":{"id":109,"work_id":"inbound-e-20261024-winning-option-missing","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE A after disputed before unrelated\",\"ie_native_b\":\"IE newer unselected B\",\"ie_equal\":\"IE unrelated later field\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"IE missing winning option\",\"ie_fields_a\":\"IE Fields A after disputed\",\"ie_fields_b\":\"IE Fields B genuine newer\",\"ie_number\":1}","a_change_times_json":"{\"ie_option\":{\"changed_at\":\"2026-10-24T16:55:24+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966001,"b_items_id":157,"link_state":"Active","processing_started_at":"2026-10-24 16:55:24","status":"Done","result_json":"{\"b_items_id\":157,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_native_a\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_native_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_equal\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_unknown\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_option\",\"outcome\":\"Skipped\",\"reason\":\"Destination dropdown label has no permitted exact match\"},{\"mapping_id\":\"ie_fields_a\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_fields_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:55:24","date_mod":"2026-10-24 16:55:24","completed_at":"2026-10-24 16:55:24"},"110":{"id":110,"work_id":"inbound-e-20261024-custom-number-loss","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Glpi\\CustomAsset\\AgentBIE20261024Asset","identity_json":"{\"a_items_id\":966101,\"b_items_id\":null,\"serial\":\"AGENTB-IE-CUSTOM\"}","a_values_json":"{\"ie_custom_text\":\"IE custom genuine newer B\",\"ie_custom_number\":12.75}","a_change_times_json":"{\"ie_custom_number\":{\"changed_at\":\"2026-10-24T16:55:24+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[38]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966101,"b_items_id":6,"link_state":"Active","processing_started_at":"2026-10-24 16:55:24","status":"Failed","result_json":"{\"b_items_id\":6,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[],\"field_outcomes\":[{\"mapping_id\":\"ie_custom_text\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_custom_number\",\"outcome\":\"Failed\",\"reason\":\"Save failed: local write or reread did not confirm the intended value\"}]}","error":"Snapshot 38: Both snapshot still awaits matching A handling: ie_custom_number","date_creation":"2026-10-24 16:55:24","date_mod":"2026-10-24 16:55:24","completed_at":null},"111":{"id":111,"work_id":"inbound-e-20261024-exact-selected-newer-unlisted","route_id":"inbound-e-20261024-main","a_entities_id":9600,"entities_id":0,"itemtype":"Computer","identity_json":"{\"a_items_id\":966001,\"b_items_id\":null,\"serial\":\"AGENTB-IE-MAIN\"}","a_values_json":"{\"ie_native_a\":\"IE A after disputed before unrelated\",\"ie_native_b\":\"IE A latest correction winner\",\"ie_equal\":\"IE unrelated later field\",\"ie_unknown\":\"IE no clock\",\"ie_option\":\"AgentB IC Maker\",\"ie_fields_a\":\"IE Fields A after disputed\",\"ie_fields_b\":\"IE Fields B genuine newer\",\"ie_number\":1}","a_change_times_json":"{\"ie_native_b\":{\"changed_at\":\"2026-10-24T16:55:24+08:00\",\"reliable\":true},\"ie_option\":{\"changed_at\":\"2026-10-24T16:55:24+08:00\",\"reliable\":true}}","settings_version":1,"handled_change_ids_json":"[40]","operation":"Sync","submitted_users_id":12,"submitted_profiles_id":14,"a_items_id":966001,"b_items_id":157,"link_state":"Active","processing_started_at":"2026-10-24 16:55:24","status":"Done","result_json":"{\"b_items_id\":157,\"created_b_items_id\":null,\"b_values_for_a\":{},\"covered_change_ids\":[],\"handled_change_ids_done\":[40],\"field_outcomes\":[{\"mapping_id\":\"ie_native_a\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_native_b\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ie_equal\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_unknown\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_option\",\"outcome\":\"AppliedToB\",\"reason\":null},{\"mapping_id\":\"ie_fields_a\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_fields_b\",\"outcome\":\"AlreadyEqual\",\"reason\":null},{\"mapping_id\":\"ie_number\",\"outcome\":\"AlreadyEqual\",\"reason\":null}]}","error":null,"date_creation":"2026-10-24 16:55:24","date_mod":"2026-10-24 16:55:24","completed_at":"2026-10-24 16:55:24"}},"contextAfter":{"user":2,"profile":4,"cron":true},"task_state":1,"queue_count":41}
```

Stderr:
```text

```

### Local 16 — IE actual custom numeric rollback raw precision storage and guard state

User12; exit 0. Native bootstrap as above.

```php
$type='Glpi\\CustomAsset\\AgentBIE20261024Asset';$a=new $type();$a->getFromDB(6);$seed=new $type();$seed->getFromDB(7);echo json_encode(['customRaw'=>$a->fields,'seedRaw'=>$seed->fields,'storage'=>(new PluginFieldsComputeragentbiex())->find(['items_id'=>157]),'asset'=>(new Computer())->find(['id'=>157]),'queue_count'=>countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[]),'guard'=>plugin_agentbdmosassetsync_is_sync_write()]);
```

Exact stdout:
```json
{"customRaw":{"id":6,"assets_assetdefinitions_id":5,"assets_assetmodels_id":0,"assets_assettypes_id":0,"name":"IE custom initial","uuid":null,"comment":null,"serial":"AGENTB-IE-CUSTOM","otherserial":null,"contact":null,"contact_num":null,"users_id":0,"users_id_tech":0,"locations_id":0,"manufacturers_id":0,"states_id":0,"entities_id":0,"is_recursive":0,"is_deleted":0,"is_template":0,"is_dynamic":0,"template_name":null,"autoupdatesystems_id":0,"date_creation":"2026-10-24 16:50:31","date_mod":"2026-10-24 16:54:53","last_inventory_update":null,"custom_fields":"{\"18\": \"IE custom genuine newer B\", \"19\": \"2\"}","groups_id":[],"groups_id_tech":[],"custom_ie_number":"2","custom_ie_text":"IE custom genuine newer B"},"seedRaw":{"id":7,"assets_assetdefinitions_id":5,"assets_assetmodels_id":0,"assets_assettypes_id":0,"name":null,"uuid":null,"comment":null,"serial":"AGENTB-IE-SEED","otherserial":null,"contact":null,"contact_num":null,"users_id":0,"users_id_tech":0,"locations_id":0,"manufacturers_id":0,"states_id":0,"entities_id":0,"is_recursive":0,"is_deleted":0,"is_template":0,"is_dynamic":0,"template_name":null,"autoupdatesystems_id":0,"date_creation":"2026-10-24 16:54:03","date_mod":"2026-10-24 16:54:03","last_inventory_update":null,"custom_fields":"{\"18\": \"IE exact precision seed\", \"19\": \"9007199254740993\"}","groups_id":[],"groups_id_tech":[],"custom_ie_number":"9007199254740993","custom_ie_text":"IE exact precision seed"},"storage":{"1":{"id":1,"items_id":157,"itemtype":"Computer","plugin_fields_containers_id":11,"entities_id":0,"ietextafield":"IE Fields A after disputed","ietextbfield":"IE Fields B genuine newer","ienumericfield":"1.00"}},"asset":{"157":{"id":157,"entities_id":0,"name":"IE A after disputed before unrelated","serial":"AGENTB-IE-MAIN","otherserial":null,"contact":"IE unrelated later field","contact_num":"IE no clock","users_id_tech":0,"comment":"IE A latest correction winner","date_mod":"2026-10-24 16:55:24","autoupdatesystems_id":0,"locations_id":0,"networks_id":0,"computermodels_id":0,"computertypes_id":0,"is_template":0,"template_name":null,"manufacturers_id":7,"is_deleted":0,"is_dynamic":0,"users_id":0,"states_id":0,"ticket_tco":"0.0000","uuid":null,"date_creation":"2026-10-24 16:50:31","is_recursive":0,"last_inventory_update":null,"last_boot":null}},"queue_count":41,"guard":false}
```

Stderr:
```text

```

### Local 17 — IE final History precision raw storage restored rights guard and no accepted Work

User12; exit 0. Native bootstrap as above.

```php
$type='Glpi\\CustomAsset\\AgentBIE20261024Asset'; $d=new \Glpi\Asset\AssetDefinition();$d->getFromDB(5);echo json_encode(['computer'=>(new Computer())->find(['id'=>157]),'fields'=>(new PluginFieldsComputeragentbiex())->find(['items_id'=>157]),'customRows'=>(new $type())->find(['id'=>[6,7]]),'history'=>iterator_to_array($DB->request(['FROM'=>Log::getTable(),'WHERE'=>['itemtype'=>'Computer','items_id'=>157],'ORDER'=>'id ASC'])),'computerRights'=>(new ProfileRight())->find(['profiles_id'=>14,'name'=>'computer']),'fieldsRights'=>(new PluginFieldsProfile())->find(['plugin_fields_containers_id'=>11]),'customProfiles'=>$d->fields['profiles'],'guard'=>plugin_agentbdmosassetsync_is_sync_write(),'queueCount'=>countElementsInTable(PluginAgentbdmosassetsyncChange::getTable(),[]),'accepted'=>countElementsInTable(PluginAgentbdmosassetsyncWork::getTable(),['status'=>'Accepted'])]);
```

Exact stdout:
```json
{"computer":{"157":{"id":157,"entities_id":0,"name":"IE A after disputed before unrelated","serial":"AGENTB-IE-MAIN","otherserial":null,"contact":"IE unrelated later field","contact_num":"IE no clock","users_id_tech":0,"comment":"IE A latest correction winner","date_mod":"2026-10-24 16:55:24","autoupdatesystems_id":0,"locations_id":0,"networks_id":0,"computermodels_id":0,"computertypes_id":0,"is_template":0,"template_name":null,"manufacturers_id":7,"is_deleted":0,"is_dynamic":0,"users_id":0,"states_id":0,"ticket_tco":"0.0000","uuid":null,"date_creation":"2026-10-24 16:50:31","is_recursive":0,"last_inventory_update":null,"last_boot":null}},"fields":{"1":{"id":1,"items_id":157,"itemtype":"Computer","plugin_fields_containers_id":11,"entities_id":0,"ietextafield":"IE Fields A after disputed","ietextbfield":"IE Fields B genuine newer","ienumericfield":"1.00"}},"customRows":{"6":{"id":6,"assets_assetdefinitions_id":5,"assets_assetmodels_id":0,"assets_assettypes_id":0,"name":"IE custom initial","uuid":null,"comment":null,"serial":"AGENTB-IE-CUSTOM","otherserial":null,"contact":null,"contact_num":null,"users_id":0,"users_id_tech":0,"locations_id":0,"manufacturers_id":0,"states_id":0,"entities_id":0,"is_recursive":0,"is_deleted":0,"is_template":0,"is_dynamic":0,"template_name":null,"autoupdatesystems_id":0,"date_creation":"2026-10-24 16:50:31","date_mod":"2026-10-24 16:55:25","last_inventory_update":null,"custom_fields":"{\"18\": \"IE custom genuine newer B\", \"19\": \"3\"}"},"7":{"id":7,"assets_assetdefinitions_id":5,"assets_assetmodels_id":0,"assets_assettypes_id":0,"name":null,"uuid":null,"comment":null,"serial":"AGENTB-IE-SEED","otherserial":null,"contact":null,"contact_num":null,"users_id":0,"users_id_tech":0,"locations_id":0,"manufacturers_id":0,"states_id":0,"entities_id":0,"is_recursive":0,"is_deleted":0,"is_template":0,"is_dynamic":0,"template_name":null,"autoupdatesystems_id":0,"date_creation":"2026-10-24 16:54:03","date_mod":"2026-10-24 16:54:03","last_inventory_update":null,"custom_fields":"{\"18\": \"IE exact precision seed\", \"19\": \"9007199254740993\"}"}},"history":{"141379":{"id":141379,"itemtype":"Computer","items_id":157,"itemtype_link":"0","linked_action":20,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:50:31","id_search_option":0,"old_value":"","new_value":"","old_id":null,"new_id":null},"141380":{"id":141380,"itemtype":"Computer","items_id":157,"itemtype_link":"PluginFieldsComputeragentbiex","linked_action":17,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:50:31","id_search_option":0,"old_value":"","new_value":"N\/A (1)","old_id":null,"new_id":null},"141443":{"id":141443,"itemtype":"Computer","items_id":157,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:52:02","id_search_option":1,"old_value":"IE native initial","new_value":"IE native genuine B","old_id":null,"new_id":null},"141444":{"id":141444,"itemtype":"Computer","items_id":157,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:52:02","id_search_option":16,"old_value":"IE B initial","new_value":"IE B genuine newer","old_id":null,"new_id":null},"141445":{"id":141445,"itemtype":"Computer","items_id":157,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:52:02","id_search_option":23,"old_value":"AgentB IC Maker (7)","new_value":"AgentB IE Maker B (8)","old_id":7,"new_id":8},"141446":{"id":141446,"itemtype":"Computer","items_id":157,"itemtype_link":"PluginFieldsComputeragentbiex","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:52:02","id_search_option":0,"old_value":"IE Fields A initial","new_value":"IE Fields A genuine B","old_id":null,"new_id":null},"141447":{"id":141447,"itemtype":"Computer","items_id":157,"itemtype_link":"PluginFieldsComputeragentbiex","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:52:02","id_search_option":0,"old_value":"IE Fields B initial","new_value":"IE Fields B genuine newer","old_id":null,"new_id":null},"141464":{"id":141464,"itemtype":"Computer","items_id":157,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:52:38","id_search_option":1,"old_value":"IE native genuine B","new_value":"IE A newer winner","old_id":null,"new_id":null},"141465":{"id":141465,"itemtype":"Computer","items_id":157,"itemtype_link":"PluginFieldsComputeragentbiex","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:52:38","id_search_option":0,"old_value":"IE Fields A genuine B","new_value":"IE Fields A newer winner","old_id":null,"new_id":null},"141466":{"id":141466,"itemtype":"Computer","items_id":157,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:52:38","id_search_option":76734,"old_value":"IE Fields A genuine B","new_value":"IE Fields A newer winner","old_id":null,"new_id":null},"141467":{"id":141467,"itemtype":"Computer","items_id":157,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:52:38","id_search_option":1,"old_value":"IE A newer winner","new_value":"IE native tie B","old_id":null,"new_id":null},"141468":{"id":141468,"itemtype":"Computer","items_id":157,"itemtype_link":"PluginFieldsComputeragentbiex","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:52:38","id_search_option":0,"old_value":"IE Fields A newer winner","new_value":"IE Fields tie B","old_id":null,"new_id":null},"141496":{"id":141496,"itemtype":"Computer","items_id":157,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:53:27","id_search_option":7,"old_value":"IE equal","new_value":"IE unrelated later field","old_id":null,"new_id":null},"141497":{"id":141497,"itemtype":"Computer","items_id":157,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:53:27","id_search_option":1,"old_value":"IE native tie B","new_value":"IE A after disputed before unrelated","old_id":null,"new_id":null},"141498":{"id":141498,"itemtype":"Computer","items_id":157,"itemtype_link":"PluginFieldsComputeragentbiex","linked_action":18,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:53:27","id_search_option":0,"old_value":"IE Fields tie B","new_value":"IE Fields A after disputed","old_id":null,"new_id":null},"141499":{"id":141499,"itemtype":"Computer","items_id":157,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:53:27","id_search_option":76734,"old_value":"IE Fields tie B","new_value":"IE Fields A after disputed","old_id":null,"new_id":null},"141532":{"id":141532,"itemtype":"Computer","items_id":157,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:54:53","id_search_option":16,"old_value":"IE B genuine newer","new_value":"IE selected correction B","old_id":null,"new_id":null},"141533":{"id":141533,"itemtype":"Computer","items_id":157,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:54:53","id_search_option":16,"old_value":"IE selected correction B","new_value":"IE newer unselected B","old_id":null,"new_id":null},"141541":{"id":141541,"itemtype":"Computer","items_id":157,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:55:24","id_search_option":16,"old_value":"IE newer unselected B","new_value":"IE A latest correction winner","old_id":null,"new_id":null},"141542":{"id":141542,"itemtype":"Computer","items_id":157,"itemtype_link":"","linked_action":0,"user_name":"agentb-rest-service-20261024 (12)","date_mod":"2026-10-24 16:55:24","id_search_option":23,"old_value":"AgentB IE Maker B (8)","new_value":"AgentB IC Maker (7)","old_id":8,"new_id":7}},"computerRights":{"1354":{"id":1354,"profiles_id":14,"name":"computer","rights":7}},"fieldsRights":{"125":{"id":125,"profiles_id":1,"plugin_fields_containers_id":11,"right":"0"},"126":{"id":126,"profiles_id":2,"plugin_fields_containers_id":11,"right":"0"},"127":{"id":127,"profiles_id":3,"plugin_fields_containers_id":11,"right":"0"},"128":{"id":128,"profiles_id":4,"plugin_fields_containers_id":11,"right":"0"},"129":{"id":129,"profiles_id":5,"plugin_fields_containers_id":11,"right":"0"},"130":{"id":130,"profiles_id":6,"plugin_fields_containers_id":11,"right":"0"},"131":{"id":131,"profiles_id":7,"plugin_fields_containers_id":11,"right":"0"},"132":{"id":132,"profiles_id":8,"plugin_fields_containers_id":11,"right":"0"},"133":{"id":133,"profiles_id":9,"plugin_fields_containers_id":11,"right":"0"},"134":{"id":134,"profiles_id":10,"plugin_fields_containers_id":11,"right":"0"},"135":{"id":135,"profiles_id":11,"plugin_fields_containers_id":11,"right":"0"},"136":{"id":136,"profiles_id":12,"plugin_fields_containers_id":11,"right":"0"},"137":{"id":137,"profiles_id":13,"plugin_fields_containers_id":11,"right":"0"},"138":{"id":138,"profiles_id":14,"plugin_fields_containers_id":11,"right":"4"},"139":{"id":139,"profiles_id":15,"plugin_fields_containers_id":11,"right":"0"}},"customProfiles":"{\"14\": 7}","guard":false,"queueCount":42,"accepted":0}
```

Stderr:
```text

```

### Local 18 — IE approved task51 comment-only metadata integration

User2; exit 0. Native bootstrap as above.

```php
$t=new CronTask();if(!$t->getFromDB(51)||$t->fields['itemtype']!=='PluginAgentbdmosassetsyncWork'||$t->fields['name']!=='processWork'){throw new RuntimeException('Unexpected task51 identity; no update');}$before=$t->fields;$ok=$t->update(['id'=>51,'comment'=>'Process accepted Agent B synchronization and scope-control work.']);$t->getFromDB(51);echo json_encode(['before'=>$before,'updated'=>$ok,'after'=>$t->fields]);
```

Exact stdout:
```json
{"before":{"id":51,"itemtype":"PluginAgentbdmosassetsyncWork","name":"processWork","frequency":60,"param":null,"state":1,"mode":2,"allowmode":2,"hourmin":0,"hourmax":24,"logs_lifetime":30,"lastrun":"2026-10-24 16:55:00","lastcode":null,"comment":"Foundation task; no work processor is installed yet.","date_mod":"2026-10-24 14:28:05","date_creation":"2026-10-24 14:28:05"},"updated":true,"after":{"id":51,"itemtype":"PluginAgentbdmosassetsyncWork","name":"processWork","frequency":60,"param":null,"state":1,"mode":2,"allowmode":2,"hourmin":0,"hourmax":24,"logs_lifetime":30,"lastrun":"2026-10-24 16:55:00","lastcode":null,"comment":"Process accepted Agent B synchronization and scope-control work.","date_mod":"2026-10-24 16:56:05","date_creation":"2026-10-24 14:28:05"}}
```

Stderr:
```text

```
