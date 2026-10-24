# Foundation runtime evidence — 24 October 2026

Target: http://localhost:8081/api.php/v1, Docker assetsync2-glpib, GLPI 11.0.7 (installed source src/autoload/constants.php:43). New plugin agentbdmosassetsync version 0.1.0. No old AssetSync resource/configuration was used.

Candidate: reviewed foundation worktree /Users/kiran/.codex/worktrees/agentb-foundation/GLPI-Agent-B, setup.php + hook.php + inc/ only. Native glpi:plugin:install and glpi:plugin:activate --no-interaction agentbdmosassetsync both exited 0. One bounded manual foundation pass found F05; approved corrected inc/setting.class.php alone was then deployed. Only changed-guard cases and legal control mapping were selectively checked afterward. No automated tests or regression harness.

## Result

READY for foundation commit/merge. The sole implementation failure (unsafe target accepted) was fixed and selectively verified. Later inbound/outbound behavior remains NOT RUN and intentionally unavailable at this stage.

72 actual curl calls are listed below in execution order, with full redacted request/response records in the appendix. These 72 are the installation-stage foundation pass, separate from the earlier 21 preimplementation exploratory calls already reported. No curl calls are omitted from this pass. All three sessions were closed successfully (200 true).

## Accounts and fixtures

- Service: user12, name agentb-rest-service-20261024, profile14, entity0 nonrecursive. Plugin rights Setting7 (READ|CREATE|UPDATE), Work5 (READ|CREATE), Change3 (READ|UPDATE); Computer7 for future disposable asset cases; other core rights0. No DELETE/PURGE.
- Child fixture actor: user14, profile14, entity5 nonrecursive.
- No-rights actor: user13, profile15, entity0 nonrecursive; all new plugin rights0.
- New child entity5: Agent-B out-of-scope fixture 20261024.
- Existing profiles1–13: all three new plugin rights0. Existing users/profiles were not changed.
- Private credentials outside repositories: /Users/kiran/.codex/private/agentbdmosassetsync-local-credentials.json (mode0600). No credentials appear in this report. Session tokens were kept in process memory and closed.

Final Setting fixtures (all preserved, no deletion):

| ID | Route | Entity | Enabled | Version |
|---|---|---|---|---|
| 1 | foundation-20261024-root | 0 | 1 | 2 |
| 2 | foundation-invalid-target | 0 | 0 | 2 |
| 3 | foundation-20261024-array | 0 | 0 | 2 |
| 4 | foundation-20261024-child | 5 | 0 | 1 |
| 5 | foundation-fix-legal | 0 | 0 | 1 |

Setting2 originally demonstrated F05: native b_field=id mapping was wrongly accepted201. Readback confirmed it; the unique fixture was then disabled and both mapping/type arrays emptied using normal Setting PUT version2, followed by readback. No Work had been admitted and no asset was touched. Approved guard now rejects B id/date_creation/date_mod/entities_id/is_deleted and reverse A protected targets for source B/Both with 400 ASB_UNSUPPORTED_MAPPING. Legal Both name mapping still creates/readbacks Setting5. Call69 is an exact literal-prefix query yielding []; it alone is not proof for all rejected routes. The final metadata inventory confirms only these five Setting rows exist.

## Foundation observations

- F01 PASS: plugin installs/activates; three exact contract tables are present. Required/null/default and indexed columns inspected through native DB read APIs. JSON columns are LONGTEXT; JSON_TEXT returns strings through API. Route/work keys have UNIQUE indexes and ascii_bin collation; settings_version is INT UNSIGNED; entity indexes present. Work also has status/route and composite (route_id,itemtype,a_items_id) indexes. Change has status/route indexes.
- Settings columns: id INT UNSIGNED AUTO_INCREMENT PK; route_id VARCHAR128 ascii_bin UNIQUE NOT NULL; a_entities_id and entities_id INT UNSIGNED NOT NULL; route_enabled TINYINT UNSIGNED NOT NULL; settings_version INT UNSIGNED NOT NULL; enabled_itemtypes_json and field_mappings_json LONGTEXT NOT NULL.
- Work columns: id PK; work_id unique ascii_bin; route_id; a_entities_id; entities_id; itemtype VARCHAR255; identity_json/a_values_json/a_change_times_json/handled_change_ids_json LONGTEXT NOT NULL; settings_version INT UNSIGNED; operation VARCHAR16 NOT NULL default Sync; submitted_users_id/submitted_profiles_id/a_items_id INT UNSIGNED NOT NULL default0; b_items_id INT UNSIGNED NULL; link_state VARCHAR16 NULL; processing_started_at DATETIME NULL; status VARCHAR16 NOT NULL default Accepted; result_json LONGTEXT NULL; error TEXT NULL; date_creation/date_mod DATETIME NOT NULL; completed_at DATETIME NULL.
- Change columns: id PK; route_id ascii_bin VARCHAR128; settings_version/a_entities_id/entities_id INT UNSIGNED; itemtype VARCHAR255; identity_json/changed_fields_json LONGTEXT NOT NULL; status VARCHAR16 NOT NULL default Pending; retry_count INT UNSIGNED NOT NULL default0; error TEXT NULL; date_creation/date_mod DATETIME NOT NULL; done_at DATETIME NULL.
- F02 PASS for native persisted rights/account context: rights assigned via Profile::add/ProfileRight::updateProfileRights/User::add and verified via API + read-only authorization metadata. Plugin profile UI tab was source-reviewed, not driven through UI.
- F03 PASS: native V1 resource exposure, singleton reads, raw-array collections, missing Setting ID404 ERROR_ITEM_NOT_FOUND.
- F04/F05/F06 PASS after targeted fix: Setting singleton/one-element-array creation and update, exact JSON-string readback, version increase, stale/equal versions rejected, immutable route rejected, duplicates/malformed JSON/nested JSON arrays/wrong scalar/enums/duplicate mappings/types/unknown selectors/missing fields/extra properties/B-owned generated ID/underscore bypass keys rejected. Complete bodies/results in appendix.
- F07 PASS empty-task execution: CronTask51, itemtype PluginAgentbdmosassetsyncWork, name processWork, frequency60, state1, mode2, allowmode2. The exact fetched CronTask object was started with native start(), cronProcessWork(task) invoked once, return0, then native end(0). Final state1; lastrun 2026-10-24 14:33:00 (GLPI native convention); lastcode null. This was a scoped local invocation, not an HTTP endpoint or worker implementation. Work/Change counts remained0.
- F08 PASS available foundation fixtures: service user12 cannot read child Setting4 (403), child excluded from root collection, forbidden-entity create/update denied with native400 wrappers; owner readback confirms unchanged version1. No-rights user13 cannot read singleton or any record collection (403). Both granted authorizations are nonrecursive. Work/Change out-of-entity real-row checks remain NOT RUN because no such fixtures can exist at foundation stage.
- F09 Source/rights reviewed: no DELETE/PURGE rights, record canDelete/canPurge and predelete/prepurge guards deny. No DELETE/PURGE/uninstall request was sent.
- F10 PASS: local reader exact saved route returns complete Setting1 version2 unchanged; unused valid route returns null; invalid route syntax throws ASB_INVALID_FIELD: field=route_id.
- F11 PASS empty/invalid inputs only: markQueueRowsDone([]) returns[]; [0], ['1'], [-1] each reject ASB_INVALID_FIELD: field=ids before writes. Actual Pending-to-Done and nonselected row proof explicitly NOT RUN until genuine outbound-captured fixtures exist.
- Work bulk POST fails400 ERROR_GLPI_ADD with ASB_WORK_ADMISSION_UNAVAILABLE: foundation_stage; exact-work-ID readback empty. Work PUT on absent ID fails400 ERROR_GLPI_UPDATE/null (no existing-row immutable proof claimed).
- External Change POST denied400 by rights. Missing-ID bulk Change ack returns400 ERROR_GLPI_UPDATE/[]; no existing-row transition proof claimed. Local Change::add and Change::update each throw the intended foundation-stage unavailable message without creating rows.
- Native missing App/session and invalid App headers return their exact native400 errors.
- Final counts: Settings5, Work0, Change0. No asset creation/update, History mutation, or genuine field-capture check occurred.

## Remaining NOT RUN

Inbound acceptance/unique Work IDs/ownership/background matching/writes/first copy/recovery, outbound capture/field evidence/real-row acknowledgement, dropdown conversion execution, Fields scalar execution, core/custom-type processing, native mixed present+missing ack behavior, and full end-to-end flow belong to later parts. Fields dependency metadata alone: installed active1.24.4, declared GLPI >=11.0.2 and <11.0.99, compatible with current11.0.7. No processing support is certified by foundation evidence.

## Operator execution notes

No repository files changed, no commits/pushes, no uninstall/drop/delete/purge, no raw database DML, and no existing asset/user/profile data changed. Native core account/profile/entity creation and normal new-plugin fixture writes were authorized. Schema and authorization queries were read-only.

Two local operator inspection attempts failed before their intended remaining checks: raw SQL passed to DB->request is prohibited by installed GLPI, corrected to native read-only doQuery; Session::init after prior CLI output triggered a session-start error, corrected by initializing the fresh local helper context before output. The empty CronTask had already run once in that second attempt and was not rerun. A speculative task:run --help lookup returned command-not-defined; no task ran through it. These were operator invocations, not plugin failures, and caused no duplicate business operations.

## Actual curl ledger

Common request headers: Accept: application/json; Content-Type: application/json; App-Token: [REDACTED], except deliberately omitted/invalid App cases. Login uses Authorization: user_token [REDACTED]; other calls use Session-Token: [REDACTED], except deliberately missing-session case. All exact bodies are in the appendix; no passwords/custom authentication. GETs have no body.

| # | Account | Method | Exact path/query | Body category | HTTP | Result |
|---|---|---|---|---|---|---|
| 1 | service | GET | `/api.php/v1/initSession` | F03 restricted service login | 200 | session token redacted |
| 2 | service | GET | `/api.php/v1/getActiveProfile` | F02 restricted rights readback | 200 | object |
| 3 | service | GET | `/api.php/v1/getActiveEntities` | F03 entity context | 200 | object |
| 4 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | F04 valid singleton Setting create | 201 | id=1 |
| 5 | service | GET | `/api.php/v1/PluginAgentbdmosassetsyncSetting/1?get_hateoas=false&expand_dropdowns=false` | F04 saved Setting readback | 200 | id=1 |
| 6 | service | GET | `/api.php/v1/PluginAgentbdmosassetsyncSetting?searchText%5Broute_id%5D=%5Efoundation-20261024-root%24&range=0-1&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false` | F03 exact route collection | 200 | array (1) |
| 7 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | F05 duplicate route | 400 | ERROR_GLPI_ADD / ASB_ROUTE_EXISTS: route_id=foundation-20261024-root |
| 8 | service | PUT | `/api.php/v1/PluginAgentbdmosassetsyncSetting/1` | F05 valid higher version singleton update | 200 | array (1) |
| 9 | service | GET | `/api.php/v1/PluginAgentbdmosassetsyncSetting/1?get_hateoas=false&expand_dropdowns=false` | F05 higher version readback | 200 | id=1 |
| 10 | service | PUT | `/api.php/v1/PluginAgentbdmosassetsyncSetting/1` | F05 equal version rejected | 400 | ERROR_GLPI_UPDATE / ASB_SETTINGS_VERSION_NOT_NEWER: submitted=2 stored=2 |
| 11 | service | PUT | `/api.php/v1/PluginAgentbdmosassetsyncSetting/1` | F05 lower version rejected | 400 | ERROR_GLPI_UPDATE / ASB_SETTINGS_VERSION_NOT_NEWER: submitted=1 stored=2 |
| 12 | service | PUT | `/api.php/v1/PluginAgentbdmosassetsyncSetting/1` | F05 immutable route rejected | 400 | ERROR_GLPI_UPDATE / ASB_IMMUTABLE_FIELD: field=route_id |
| 13 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | F05 malformed JSON_TEXT | 400 | ERROR_GLPI_ADD / ASB_INVALID_FIELD: field=field_mappings_json |
| 14 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | F05 nested array instead JSON_TEXT string | 400 | ERROR_GLPI_ADD / ASB_INVALID_FIELD: field=field_mappings_json |
| 15 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | F05 invalid source enum | 400 | ERROR_GLPI_ADD / ASB_INVALID_MAPPING: mapping_id=asset_name |
| 16 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | F05 invalid value_mode enum | 400 | ERROR_GLPI_ADD / ASB_INVALID_MAPPING: mapping_id=asset_name |
| 17 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | F05 duplicate mapping IDs | 400 | ERROR_GLPI_ADD / ASB_INVALID_MAPPING: mapping_id=asset_name |
| 18 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | F05 duplicate itemtypes | 400 | ERROR_GLPI_ADD / ASB_INVALID_FIELD: field=enabled_itemtypes_json |
| 19 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | F05 unsafe mapped identity target | 201 | id=2 |
| 20 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | F05 unsupported selector | 400 | ERROR_GLPI_ADD / ASB_UNSUPPORTED_MAPPING: mapping_id=asset_name |
| 21 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | F05 unsupported itemtype | 400 | ERROR_GLPI_ADD / ASB_UNSUPPORTED_ITEMTYPE: itemtype=ImaginaryAssetType |
| 22 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | F05 missing required field | 400 | ERROR_GLPI_ADD / ASB_REQUIRED_FIELD: field=a_entities_id |
| 23 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | F05 wrong scalar boolean | 400 | ERROR_GLPI_ADD / ASB_INVALID_FIELD: field=route_enabled |
| 24 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | F05 extra mapping property | 400 | ERROR_GLPI_ADD / ASB_INVALID_MAPPING: mapping_id=asset_name |
| 25 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | V04 B-owned generated ID rejected | 400 | ERROR_GLPI_ADD / ASB_B_OWNED_FIELD: field=id |
| 26 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | V04 client GLPI bypass key rejected | 400 | ERROR_GLPI_ADD / ASB_UNKNOWN_FIELD: field=_add |
| 27 | service | PUT | `/api.php/v1/PluginAgentbdmosassetsyncSetting/1` | V04 update bypass key rejected | 400 | ERROR_GLPI_UPDATE / ASB_UNKNOWN_FIELD: field=_agentbdmosassetsync_internal |
| 28 | service | GET | `/api.php/v1/PluginAgentbdmosassetsyncSetting/1?get_hateoas=false&expand_dropdowns=false` | F05 rejected updates preserved version2 | 200 | id=1 |
| 29 | service | GET | `/api.php/v1/PluginAgentbdmosassetsyncSetting/2?get_hateoas=false&expand_dropdowns=false` | F05 unexpected unsafe mapping persisted readback | 200 | id=2 |
| 30 | service | PUT | `/api.php/v1/PluginAgentbdmosassetsyncSetting/2` | Contain failed fixture by disabling route and mappings | 200 | array (1) |
| 31 | service | GET | `/api.php/v1/PluginAgentbdmosassetsyncSetting/2?get_hateoas=false&expand_dropdowns=false` | Disabled failure fixture readback | 200 | id=2 |
| 32 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | F06 one-element array Setting create | 201 | array (1) |
| 33 | service | GET | `/api.php/v1/PluginAgentbdmosassetsyncSetting/3?get_hateoas=false&expand_dropdowns=false` | F06 array-created Setting readback | 200 | id=3 |
| 34 | service | PUT | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | F06 one-element array Setting update | 200 | array (1) |
| 35 | service | GET | `/api.php/v1/PluginAgentbdmosassetsyncSetting/3?get_hateoas=false&expand_dropdowns=false` | F06 array-updated disabled Setting readback | 200 | id=3 |
| 36 | service | GET | `/api.php/v1/PluginAgentbdmosassetsyncWork?range=0-49&get_hateoas=false&expand_dropdowns=false` | F03 Work collection available and empty | 200 | array (0) |
| 37 | service | GET | `/api.php/v1/PluginAgentbdmosassetsyncChange?searchText%5Bstatus%5D=%5EPending%24&range=0-49&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false` | F03 Pending Change collection available and empty | 200 | array (0) |
| 38 | service | GET | `/api.php/v1/PluginAgentbdmosassetsyncSetting/2147483647?get_hateoas=false&expand_dropdowns=false` | F03 native missing ID | 404 | ERROR_ITEM_NOT_FOUND / Item not found |
| 39 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncWork` | Foundation Work admission intentionally unavailable | 400 | ERROR_GLPI_ADD |
| 40 | service | PUT | `/api.php/v1/PluginAgentbdmosassetsyncWork/2147483647` | Foundation Work update forbidden | 400 | ERROR_GLPI_UPDATE |
| 41 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncChange` | Foundation external Change creation forbidden | 400 | ERROR_GLPI_ADD / You don't have permission to perform this action. |
| 42 | service | PUT | `/api.php/v1/PluginAgentbdmosassetsyncChange` | Foundation absent Change ack transport only | 400 | ERROR_GLPI_UPDATE |
| 43 | service | GET | `/api.php/v1/PluginAgentbdmosassetsyncWork?searchText%5Bwork_id%5D=%5Efoundation-20261024-work%24&range=0-1&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false` | Readback proves failed Work not stored | 200 | array (0) |
| 44 | outside | GET | `/api.php/v1/initSession` | F08 child-entity fixture actor login | 200 | session token redacted |
| 45 | outside | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | F08 create authorized child entity Setting | 201 | id=4 |
| 46 | outside | GET | `/api.php/v1/PluginAgentbdmosassetsyncSetting/4?get_hateoas=false&expand_dropdowns=false` | F08 child Setting owner readback | 200 | id=4 |
| 47 | service | GET | `/api.php/v1/PluginAgentbdmosassetsyncSetting/4?get_hateoas=false&expand_dropdowns=false` | F08 root nonrecursive cannot read child Setting | 403 | ERROR_RIGHT_MISSING / You don't have permission to perform this action. |
| 48 | service | GET | `/api.php/v1/PluginAgentbdmosassetsyncSetting?searchText%5Broute_id%5D=%5Efoundation-20261024-child%24&range=0-1&get_hateoas=false&expand_dropdowns=false` | F08 child record excluded from root collection | 200 | array (0) |
| 49 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | F08 create in forbidden child entity denied | 400 | ERROR_GLPI_ADD / You don't have permission to perform this action. |
| 50 | service | PUT | `/api.php/v1/PluginAgentbdmosassetsyncSetting/4` | F08 update foreign Setting denied | 400 | ERROR_GLPI_UPDATE / You don't have permission to perform this action. |
| 51 | outside | GET | `/api.php/v1/PluginAgentbdmosassetsyncSetting/4?get_hateoas=false&expand_dropdowns=false` | F08 denied update preserved foreign Setting version1 | 200 | id=4 |
| 52 | denied | GET | `/api.php/v1/initSession` | F08 no-rights account login | 200 | session token redacted |
| 53 | denied | GET | `/api.php/v1/PluginAgentbdmosassetsyncSetting/1?get_hateoas=false&expand_dropdowns=false` | F08 no-rights direct Setting denied | 403 | ERROR_RIGHT_MISSING / You don't have permission to perform this action. |
| 54 | denied | GET | `/api.php/v1/PluginAgentbdmosassetsyncSetting?range=0-49&get_hateoas=false` | F08 no-rights Setting collection denied | 403 | ERROR_RIGHT_MISSING / You don't have permission to perform this action. |
| 55 | denied | GET | `/api.php/v1/PluginAgentbdmosassetsyncWork?range=0-49&get_hateoas=false` | F08 no-rights Work collection denied | 403 | ERROR_RIGHT_MISSING / You don't have permission to perform this action. |
| 56 | denied | GET | `/api.php/v1/PluginAgentbdmosassetsyncChange?range=0-49&get_hateoas=false` | F08 no-rights Change collection denied | 403 | ERROR_RIGHT_MISSING / You don't have permission to perform this action. |
| 57 | service | GET | `/api.php/v1/PluginAgentbdmosassetsyncSetting?range=0-49&get_hateoas=false` | V06 missing App-Token | 400 | ERROR_APP_TOKEN_PARAMETERS_MISSING / missing parameter app_token; view documentation in your browser at http://localhost/api.php/v1/#ERROR_APP_TOKEN_PARAMETERS_MISSING |
| 58 | service | GET | `/api.php/v1/PluginAgentbdmosassetsyncSetting?range=0-49&get_hateoas=false` | V06 missing Session-Token | 400 | ERROR_SESSION_TOKEN_MISSING / parameter session_token is missing or empty; view documentation in your browser at http://localhost/api.php/v1/#ERROR_SESSION_TOKEN_MISSING |
| 59 | service | GET | `/api.php/v1/PluginAgentbdmosassetsyncSetting?range=0-49&get_hateoas=false` | V06 deliberate invalid App-Token | 400 | ERROR_WRONG_APP_TOKEN_PARAMETER / parameter app_token seems wrong; view documentation in your browser at http://localhost/api.php/v1/#ERROR_WRONG_APP_TOKEN_PARAMETER |
| 60 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | F05 corrected B ID target rejection | 400 | ERROR_GLPI_ADD / ASB_UNSUPPORTED_MAPPING: mapping_id=asset_name |
| 61 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | F05 corrected B date_creation target rejection | 400 | ERROR_GLPI_ADD / ASB_UNSUPPORTED_MAPPING: mapping_id=asset_name |
| 62 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | F05 corrected B date_mod target rejection | 400 | ERROR_GLPI_ADD / ASB_UNSUPPORTED_MAPPING: mapping_id=asset_name |
| 63 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | F05 corrected B entity target rejection | 400 | ERROR_GLPI_ADD / ASB_UNSUPPORTED_MAPPING: mapping_id=asset_name |
| 64 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | F05 corrected B destructive target rejection | 400 | ERROR_GLPI_ADD / ASB_UNSUPPORTED_MAPPING: mapping_id=asset_name |
| 65 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | F05 corrected reverse A target B ownership | 400 | ERROR_GLPI_ADD / ASB_UNSUPPORTED_MAPPING: mapping_id=asset_name |
| 66 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | F05 corrected reverse A target Both ownership | 400 | ERROR_GLPI_ADD / ASB_UNSUPPORTED_MAPPING: mapping_id=asset_name |
| 67 | service | POST | `/api.php/v1/PluginAgentbdmosassetsyncSetting` | F05 corrected guard keeps legal Both business mapping | 201 | id=5 |
| 68 | service | GET | `/api.php/v1/PluginAgentbdmosassetsyncSetting/5?get_hateoas=false&expand_dropdowns=false` | F05 legal mapping guard readback | 200 | id=5 |
| 69 | service | GET | `/api.php/v1/PluginAgentbdmosassetsyncSetting?searchText%5Broute_id%5D=%5Efoundation-fix-%24&range=0-49&get_hateoas=false&expand_dropdowns=false` | F05 rejected guard fixture no exact invalid route persisted | 200 | array (0) |
| 70 | outside | GET | `/api.php/v1/killSession` | Close child fixture session | 200 | true |
| 71 | denied | GET | `/api.php/v1/killSession` | Close no-rights fixture session | 200 | true |
| 72 | service | GET | `/api.php/v1/killSession` | Close restricted service session | 200 | true |

## Full redacted request/response appendix

```json
{
  "target": "http://localhost:8081",
  "glpi": "11.0.7",
  "candidate": "foundation with approved F05 native protected-target guard",
  "accounts": {
    "service": {
      "user_id": 12,
      "profile_id": 14,
      "entity_id": 0,
      "recursive": 0
    },
    "outside": {
      "user_id": 14,
      "profile_id": 14,
      "entity_id": 5,
      "recursive": 0
    },
    "denied": {
      "user_id": 13,
      "profile_id": 15,
      "entity_id": 0,
      "recursive": 0
    }
  },
  "calls": [
    {
      "number": 1,
      "method": "GET",
      "path": "/api.php/v1/initSession",
      "actor": "service",
      "purpose": "F03 restricted service login",
      "request_body": null,
      "http_status": 200,
      "response": {
        "session_token": "[REDACTED]"
      }
    },
    {
      "number": 2,
      "method": "GET",
      "path": "/api.php/v1/getActiveProfile",
      "actor": "service",
      "purpose": "F02 restricted rights readback",
      "request_body": null,
      "http_status": 200,
      "response": {
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
    },
    {
      "number": 3,
      "method": "GET",
      "path": "/api.php/v1/getActiveEntities",
      "actor": "service",
      "purpose": "F03 entity context",
      "request_body": null,
      "http_status": 200,
      "response": {
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
    },
    {
      "number": 4,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "F04 valid singleton Setting create",
      "request_body": {
        "input": {
          "route_id": "foundation-20261024-root",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 1,
          "settings_version": 1,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
        }
      },
      "http_status": 201,
      "response": {
        "id": 1,
        "message": ""
      }
    },
    {
      "number": 5,
      "method": "GET",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting/1?get_hateoas=false&expand_dropdowns=false",
      "actor": "service",
      "purpose": "F04 saved Setting readback",
      "request_body": null,
      "http_status": 200,
      "response": {
        "id": 1,
        "route_id": "foundation-20261024-root",
        "a_entities_id": 0,
        "entities_id": 0,
        "route_enabled": 1,
        "settings_version": 1,
        "enabled_itemtypes_json": "[\"Computer\"]",
        "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
      }
    },
    {
      "number": 6,
      "method": "GET",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting?searchText%5Broute_id%5D=%5Efoundation-20261024-root%24&range=0-1&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false",
      "actor": "service",
      "purpose": "F03 exact route collection",
      "request_body": null,
      "http_status": 200,
      "response": [
        {
          "id": 1,
          "route_id": "foundation-20261024-root",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 1,
          "settings_version": 1,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
        }
      ]
    },
    {
      "number": 7,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "F05 duplicate route",
      "request_body": {
        "input": {
          "route_id": "foundation-20261024-root",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 1,
          "settings_version": 1,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_ADD",
        "ASB_ROUTE_EXISTS: route_id=foundation-20261024-root"
      ]
    },
    {
      "number": 8,
      "method": "PUT",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting/1",
      "actor": "service",
      "purpose": "F05 valid higher version singleton update",
      "request_body": {
        "input": {
          "route_id": "foundation-20261024-root",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 1,
          "settings_version": 2,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]",
          "id": 1
        }
      },
      "http_status": 200,
      "response": [
        {
          "1": true,
          "message": ""
        }
      ]
    },
    {
      "number": 9,
      "method": "GET",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting/1?get_hateoas=false&expand_dropdowns=false",
      "actor": "service",
      "purpose": "F05 higher version readback",
      "request_body": null,
      "http_status": 200,
      "response": {
        "id": 1,
        "route_id": "foundation-20261024-root",
        "a_entities_id": 0,
        "entities_id": 0,
        "route_enabled": 1,
        "settings_version": 2,
        "enabled_itemtypes_json": "[\"Computer\"]",
        "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
      }
    },
    {
      "number": 10,
      "method": "PUT",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting/1",
      "actor": "service",
      "purpose": "F05 equal version rejected",
      "request_body": {
        "input": {
          "route_id": "foundation-20261024-root",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 1,
          "settings_version": 2,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]",
          "id": 1
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_UPDATE",
        "ASB_SETTINGS_VERSION_NOT_NEWER: submitted=2 stored=2"
      ]
    },
    {
      "number": 11,
      "method": "PUT",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting/1",
      "actor": "service",
      "purpose": "F05 lower version rejected",
      "request_body": {
        "input": {
          "route_id": "foundation-20261024-root",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 1,
          "settings_version": 1,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]",
          "id": 1
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_UPDATE",
        "ASB_SETTINGS_VERSION_NOT_NEWER: submitted=1 stored=2"
      ]
    },
    {
      "number": 12,
      "method": "PUT",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting/1",
      "actor": "service",
      "purpose": "F05 immutable route rejected",
      "request_body": {
        "input": {
          "route_id": "foundation-retarget-invalid",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 1,
          "settings_version": 3,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]",
          "id": 1
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_UPDATE",
        "ASB_IMMUTABLE_FIELD: field=route_id"
      ]
    },
    {
      "number": 13,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "F05 malformed JSON_TEXT",
      "request_body": {
        "input": {
          "route_id": "foundation-invalid-json",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 1,
          "settings_version": 1,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "["
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_ADD",
        "ASB_INVALID_FIELD: field=field_mappings_json"
      ]
    },
    {
      "number": 14,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "F05 nested array instead JSON_TEXT string",
      "request_body": {
        "input": {
          "route_id": "foundation-invalid-nested",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 1,
          "settings_version": 1,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": []
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_ADD",
        "ASB_INVALID_FIELD: field=field_mappings_json"
      ]
    },
    {
      "number": 15,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "F05 invalid source enum",
      "request_body": {
        "input": {
          "route_id": "foundation-invalid-source",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 1,
          "settings_version": 1,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"BAD\",\"value_mode\":\"direct\"}]"
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_ADD",
        "ASB_INVALID_MAPPING: mapping_id=asset_name"
      ]
    },
    {
      "number": 16,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "F05 invalid value_mode enum",
      "request_body": {
        "input": {
          "route_id": "foundation-invalid-mode",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 1,
          "settings_version": 1,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"BAD\"}]"
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_ADD",
        "ASB_INVALID_MAPPING: mapping_id=asset_name"
      ]
    },
    {
      "number": 17,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "F05 duplicate mapping IDs",
      "request_body": {
        "input": {
          "route_id": "foundation-invalid-mapdup",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 1,
          "settings_version": 1,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"},{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_ADD",
        "ASB_INVALID_MAPPING: mapping_id=asset_name"
      ]
    },
    {
      "number": 18,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "F05 duplicate itemtypes",
      "request_body": {
        "input": {
          "route_id": "foundation-invalid-typedup",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 1,
          "settings_version": 1,
          "enabled_itemtypes_json": "[\"Computer\",\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_ADD",
        "ASB_INVALID_FIELD: field=enabled_itemtypes_json"
      ]
    },
    {
      "number": 19,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "F05 unsafe mapped identity target",
      "request_body": {
        "input": {
          "route_id": "foundation-invalid-target",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 1,
          "settings_version": 1,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"id\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
        }
      },
      "http_status": 201,
      "response": {
        "id": 2,
        "message": ""
      }
    },
    {
      "number": 20,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "F05 unsupported selector",
      "request_body": {
        "input": {
          "route_id": "foundation-invalid-selector",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 1,
          "settings_version": 1,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"unknown\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_ADD",
        "ASB_UNSUPPORTED_MAPPING: mapping_id=asset_name"
      ]
    },
    {
      "number": 21,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "F05 unsupported itemtype",
      "request_body": {
        "input": {
          "route_id": "foundation-invalid-type",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 1,
          "settings_version": 1,
          "enabled_itemtypes_json": "[\"ImaginaryAssetType\"]",
          "field_mappings_json": "[]"
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_ADD",
        "ASB_UNSUPPORTED_ITEMTYPE: itemtype=ImaginaryAssetType"
      ]
    },
    {
      "number": 22,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "F05 missing required field",
      "request_body": {
        "input": {
          "route_id": "foundation-invalid-missing",
          "entities_id": 0,
          "route_enabled": 1,
          "settings_version": 1,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_ADD",
        "ASB_REQUIRED_FIELD: field=a_entities_id"
      ]
    },
    {
      "number": 23,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "F05 wrong scalar boolean",
      "request_body": {
        "input": {
          "route_id": "foundation-invalid-scalar",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": true,
          "settings_version": 1,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_ADD",
        "ASB_INVALID_FIELD: field=route_enabled"
      ]
    },
    {
      "number": 24,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "F05 extra mapping property",
      "request_body": {
        "input": {
          "route_id": "foundation-invalid-extra",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 1,
          "settings_version": 1,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\",\"extra\":\"not-permitted\"}]"
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_ADD",
        "ASB_INVALID_MAPPING: mapping_id=asset_name"
      ]
    },
    {
      "number": 25,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "V04 B-owned generated ID rejected",
      "request_body": {
        "input": {
          "route_id": "foundation-invalid-owned",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 1,
          "settings_version": 1,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]",
          "id": 123
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_ADD",
        "ASB_B_OWNED_FIELD: field=id"
      ]
    },
    {
      "number": 26,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "V04 client GLPI bypass key rejected",
      "request_body": {
        "input": {
          "route_id": "foundation-invalid-bypass",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 1,
          "settings_version": 1,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]",
          "_add": 1
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_ADD",
        "ASB_UNKNOWN_FIELD: field=_add"
      ]
    },
    {
      "number": 27,
      "method": "PUT",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting/1",
      "actor": "service",
      "purpose": "V04 update bypass key rejected",
      "request_body": {
        "input": {
          "route_id": "foundation-20261024-root",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 1,
          "settings_version": 3,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]",
          "id": 1,
          "_agentbdmosassetsync_internal": true
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_UPDATE",
        "ASB_UNKNOWN_FIELD: field=_agentbdmosassetsync_internal"
      ]
    },
    {
      "number": 28,
      "method": "GET",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting/1?get_hateoas=false&expand_dropdowns=false",
      "actor": "service",
      "purpose": "F05 rejected updates preserved version2",
      "request_body": null,
      "http_status": 200,
      "response": {
        "id": 1,
        "route_id": "foundation-20261024-root",
        "a_entities_id": 0,
        "entities_id": 0,
        "route_enabled": 1,
        "settings_version": 2,
        "enabled_itemtypes_json": "[\"Computer\"]",
        "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
      }
    },
    {
      "number": 29,
      "method": "GET",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting/2?get_hateoas=false&expand_dropdowns=false",
      "actor": "service",
      "purpose": "F05 unexpected unsafe mapping persisted readback",
      "request_body": null,
      "http_status": 200,
      "response": {
        "id": 2,
        "route_id": "foundation-invalid-target",
        "a_entities_id": 0,
        "entities_id": 0,
        "route_enabled": 1,
        "settings_version": 1,
        "enabled_itemtypes_json": "[\"Computer\"]",
        "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"id\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
      }
    },
    {
      "number": 30,
      "method": "PUT",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting/2",
      "actor": "service",
      "purpose": "Contain failed fixture by disabling route and mappings",
      "request_body": {
        "input": {
          "id": 2,
          "route_id": "foundation-invalid-target",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 0,
          "settings_version": 2,
          "enabled_itemtypes_json": "[]",
          "field_mappings_json": "[]"
        }
      },
      "http_status": 200,
      "response": [
        {
          "2": true,
          "message": ""
        }
      ]
    },
    {
      "number": 31,
      "method": "GET",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting/2?get_hateoas=false&expand_dropdowns=false",
      "actor": "service",
      "purpose": "Disabled failure fixture readback",
      "request_body": null,
      "http_status": 200,
      "response": {
        "id": 2,
        "route_id": "foundation-invalid-target",
        "a_entities_id": 0,
        "entities_id": 0,
        "route_enabled": 0,
        "settings_version": 2,
        "enabled_itemtypes_json": "[]",
        "field_mappings_json": "[]"
      }
    },
    {
      "number": 32,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "F06 one-element array Setting create",
      "request_body": {
        "input": [
          {
            "route_id": "foundation-20261024-array",
            "a_entities_id": 0,
            "entities_id": 0,
            "route_enabled": 0,
            "settings_version": 1,
            "enabled_itemtypes_json": "[]",
            "field_mappings_json": "[]"
          }
        ]
      },
      "http_status": 201,
      "response": [
        {
          "id": 3,
          "message": ""
        }
      ]
    },
    {
      "number": 33,
      "method": "GET",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting/3?get_hateoas=false&expand_dropdowns=false",
      "actor": "service",
      "purpose": "F06 array-created Setting readback",
      "request_body": null,
      "http_status": 200,
      "response": {
        "id": 3,
        "route_id": "foundation-20261024-array",
        "a_entities_id": 0,
        "entities_id": 0,
        "route_enabled": 0,
        "settings_version": 1,
        "enabled_itemtypes_json": "[]",
        "field_mappings_json": "[]"
      }
    },
    {
      "number": 34,
      "method": "PUT",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "F06 one-element array Setting update",
      "request_body": {
        "input": [
          {
            "route_id": "foundation-20261024-array",
            "a_entities_id": 0,
            "entities_id": 0,
            "route_enabled": 0,
            "settings_version": 2,
            "enabled_itemtypes_json": "[]",
            "field_mappings_json": "[]",
            "id": 3
          }
        ]
      },
      "http_status": 200,
      "response": [
        {
          "3": true,
          "message": ""
        }
      ]
    },
    {
      "number": 35,
      "method": "GET",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting/3?get_hateoas=false&expand_dropdowns=false",
      "actor": "service",
      "purpose": "F06 array-updated disabled Setting readback",
      "request_body": null,
      "http_status": 200,
      "response": {
        "id": 3,
        "route_id": "foundation-20261024-array",
        "a_entities_id": 0,
        "entities_id": 0,
        "route_enabled": 0,
        "settings_version": 2,
        "enabled_itemtypes_json": "[]",
        "field_mappings_json": "[]"
      }
    },
    {
      "number": 36,
      "method": "GET",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncWork?range=0-49&get_hateoas=false&expand_dropdowns=false",
      "actor": "service",
      "purpose": "F03 Work collection available and empty",
      "request_body": null,
      "http_status": 200,
      "response": []
    },
    {
      "number": 37,
      "method": "GET",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncChange?searchText%5Bstatus%5D=%5EPending%24&range=0-49&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false",
      "actor": "service",
      "purpose": "F03 Pending Change collection available and empty",
      "request_body": null,
      "http_status": 200,
      "response": []
    },
    {
      "number": 38,
      "method": "GET",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting/2147483647?get_hateoas=false&expand_dropdowns=false",
      "actor": "service",
      "purpose": "F03 native missing ID",
      "request_body": null,
      "http_status": 404,
      "response": [
        "ERROR_ITEM_NOT_FOUND",
        "Item not found"
      ]
    },
    {
      "number": 39,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncWork",
      "actor": "service",
      "purpose": "Foundation Work admission intentionally unavailable",
      "request_body": {
        "input": [
          {
            "work_id": "foundation-20261024-work",
            "route_id": "foundation-20261024-root",
            "a_entities_id": 0,
            "entities_id": 0,
            "itemtype": "Computer",
            "identity_json": "{\"a_items_id\":42,\"b_items_id\":null,\"serial\":\"FOUNDATION-UNUSED\"}",
            "a_values_json": "{\"asset_name\":\"Foundation unused\"}",
            "a_change_times_json": "{\"asset_name\":{\"changed_at\":\"2026-10-24T14:30:00+08:00\",\"reliable\":true}}",
            "settings_version": 2,
            "handled_change_ids_json": "[]"
          }
        ]
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_ADD",
        [
          {
            "id": false,
            "message": "ASB_WORK_ADMISSION_UNAVAILABLE: foundation_stage"
          }
        ]
      ]
    },
    {
      "number": 40,
      "method": "PUT",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncWork/2147483647",
      "actor": "service",
      "purpose": "Foundation Work update forbidden",
      "request_body": {
        "input": {
          "id": 2147483647,
          "status": "Done"
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_UPDATE",
        null
      ]
    },
    {
      "number": 41,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncChange",
      "actor": "service",
      "purpose": "Foundation external Change creation forbidden",
      "request_body": {
        "input": {
          "route_id": "foundation-20261024-root",
          "entities_id": 0
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_ADD",
        "You don't have permission to perform this action."
      ]
    },
    {
      "number": 42,
      "method": "PUT",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncChange",
      "actor": "service",
      "purpose": "Foundation absent Change ack transport only",
      "request_body": {
        "input": [
          {
            "id": 2147483647,
            "status": "Done"
          }
        ]
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_UPDATE",
        []
      ]
    },
    {
      "number": 43,
      "method": "GET",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncWork?searchText%5Bwork_id%5D=%5Efoundation-20261024-work%24&range=0-1&sort=id&order=ASC&get_hateoas=false&expand_dropdowns=false",
      "actor": "service",
      "purpose": "Readback proves failed Work not stored",
      "request_body": null,
      "http_status": 200,
      "response": []
    },
    {
      "number": 44,
      "method": "GET",
      "path": "/api.php/v1/initSession",
      "actor": "outside",
      "purpose": "F08 child-entity fixture actor login",
      "request_body": null,
      "http_status": 200,
      "response": {
        "session_token": "[REDACTED]"
      }
    },
    {
      "number": 45,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "outside",
      "purpose": "F08 create authorized child entity Setting",
      "request_body": {
        "input": {
          "route_id": "foundation-20261024-child",
          "a_entities_id": 0,
          "entities_id": 5,
          "route_enabled": 0,
          "settings_version": 1,
          "enabled_itemtypes_json": "[]",
          "field_mappings_json": "[]"
        }
      },
      "http_status": 201,
      "response": {
        "id": 4,
        "message": ""
      }
    },
    {
      "number": 46,
      "method": "GET",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting/4?get_hateoas=false&expand_dropdowns=false",
      "actor": "outside",
      "purpose": "F08 child Setting owner readback",
      "request_body": null,
      "http_status": 200,
      "response": {
        "id": 4,
        "route_id": "foundation-20261024-child",
        "a_entities_id": 0,
        "entities_id": 5,
        "route_enabled": 0,
        "settings_version": 1,
        "enabled_itemtypes_json": "[]",
        "field_mappings_json": "[]"
      }
    },
    {
      "number": 47,
      "method": "GET",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting/4?get_hateoas=false&expand_dropdowns=false",
      "actor": "service",
      "purpose": "F08 root nonrecursive cannot read child Setting",
      "request_body": null,
      "http_status": 403,
      "response": [
        "ERROR_RIGHT_MISSING",
        "You don't have permission to perform this action."
      ]
    },
    {
      "number": 48,
      "method": "GET",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting?searchText%5Broute_id%5D=%5Efoundation-20261024-child%24&range=0-1&get_hateoas=false&expand_dropdowns=false",
      "actor": "service",
      "purpose": "F08 child record excluded from root collection",
      "request_body": null,
      "http_status": 200,
      "response": []
    },
    {
      "number": 49,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "F08 create in forbidden child entity denied",
      "request_body": {
        "input": {
          "route_id": "foundation-invalid-entity",
          "a_entities_id": 0,
          "entities_id": 5,
          "route_enabled": 0,
          "settings_version": 1,
          "enabled_itemtypes_json": "[]",
          "field_mappings_json": "[]"
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_ADD",
        "You don't have permission to perform this action."
      ]
    },
    {
      "number": 50,
      "method": "PUT",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting/4",
      "actor": "service",
      "purpose": "F08 update foreign Setting denied",
      "request_body": {
        "input": {
          "route_id": "foundation-20261024-child",
          "a_entities_id": 0,
          "entities_id": 5,
          "route_enabled": 0,
          "settings_version": 2,
          "enabled_itemtypes_json": "[]",
          "field_mappings_json": "[]",
          "id": 4
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_UPDATE",
        "You don't have permission to perform this action."
      ]
    },
    {
      "number": 51,
      "method": "GET",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting/4?get_hateoas=false&expand_dropdowns=false",
      "actor": "outside",
      "purpose": "F08 denied update preserved foreign Setting version1",
      "request_body": null,
      "http_status": 200,
      "response": {
        "id": 4,
        "route_id": "foundation-20261024-child",
        "a_entities_id": 0,
        "entities_id": 5,
        "route_enabled": 0,
        "settings_version": 1,
        "enabled_itemtypes_json": "[]",
        "field_mappings_json": "[]"
      }
    },
    {
      "number": 52,
      "method": "GET",
      "path": "/api.php/v1/initSession",
      "actor": "denied",
      "purpose": "F08 no-rights account login",
      "request_body": null,
      "http_status": 200,
      "response": {
        "session_token": "[REDACTED]"
      }
    },
    {
      "number": 53,
      "method": "GET",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting/1?get_hateoas=false&expand_dropdowns=false",
      "actor": "denied",
      "purpose": "F08 no-rights direct Setting denied",
      "request_body": null,
      "http_status": 403,
      "response": [
        "ERROR_RIGHT_MISSING",
        "You don't have permission to perform this action."
      ]
    },
    {
      "number": 54,
      "method": "GET",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting?range=0-49&get_hateoas=false",
      "actor": "denied",
      "purpose": "F08 no-rights Setting collection denied",
      "request_body": null,
      "http_status": 403,
      "response": [
        "ERROR_RIGHT_MISSING",
        "You don't have permission to perform this action."
      ]
    },
    {
      "number": 55,
      "method": "GET",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncWork?range=0-49&get_hateoas=false",
      "actor": "denied",
      "purpose": "F08 no-rights Work collection denied",
      "request_body": null,
      "http_status": 403,
      "response": [
        "ERROR_RIGHT_MISSING",
        "You don't have permission to perform this action."
      ]
    },
    {
      "number": 56,
      "method": "GET",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncChange?range=0-49&get_hateoas=false",
      "actor": "denied",
      "purpose": "F08 no-rights Change collection denied",
      "request_body": null,
      "http_status": 403,
      "response": [
        "ERROR_RIGHT_MISSING",
        "You don't have permission to perform this action."
      ]
    },
    {
      "number": 57,
      "method": "GET",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting?range=0-49&get_hateoas=false",
      "actor": "service",
      "purpose": "V06 missing App-Token",
      "request_body": null,
      "http_status": 400,
      "response": [
        "ERROR_APP_TOKEN_PARAMETERS_MISSING",
        "missing parameter app_token; view documentation in your browser at http://localhost/api.php/v1/#ERROR_APP_TOKEN_PARAMETERS_MISSING"
      ]
    },
    {
      "number": 58,
      "method": "GET",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting?range=0-49&get_hateoas=false",
      "actor": "service",
      "purpose": "V06 missing Session-Token",
      "request_body": null,
      "http_status": 400,
      "response": [
        "ERROR_SESSION_TOKEN_MISSING",
        "parameter session_token is missing or empty; view documentation in your browser at http://localhost/api.php/v1/#ERROR_SESSION_TOKEN_MISSING"
      ]
    },
    {
      "number": 59,
      "method": "GET",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting?range=0-49&get_hateoas=false",
      "actor": "service",
      "purpose": "V06 deliberate invalid App-Token",
      "request_body": null,
      "http_status": 400,
      "response": [
        "ERROR_WRONG_APP_TOKEN_PARAMETER",
        "parameter app_token seems wrong; view documentation in your browser at http://localhost/api.php/v1/#ERROR_WRONG_APP_TOKEN_PARAMETER"
      ]
    },
    {
      "number": 60,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "F05 corrected B ID target rejection",
      "request_body": {
        "input": {
          "route_id": "foundation-fix-id",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 0,
          "settings_version": 1,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"id\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_ADD",
        "ASB_UNSUPPORTED_MAPPING: mapping_id=asset_name"
      ]
    },
    {
      "number": 61,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "F05 corrected B date_creation target rejection",
      "request_body": {
        "input": {
          "route_id": "foundation-fix-datecreation",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 0,
          "settings_version": 1,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"date_creation\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_ADD",
        "ASB_UNSUPPORTED_MAPPING: mapping_id=asset_name"
      ]
    },
    {
      "number": 62,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "F05 corrected B date_mod target rejection",
      "request_body": {
        "input": {
          "route_id": "foundation-fix-datemod",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 0,
          "settings_version": 1,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"date_mod\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_ADD",
        "ASB_UNSUPPORTED_MAPPING: mapping_id=asset_name"
      ]
    },
    {
      "number": 63,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "F05 corrected B entity target rejection",
      "request_body": {
        "input": {
          "route_id": "foundation-fix-entity",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 0,
          "settings_version": 1,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"entities_id\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_ADD",
        "ASB_UNSUPPORTED_MAPPING: mapping_id=asset_name"
      ]
    },
    {
      "number": 64,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "F05 corrected B destructive target rejection",
      "request_body": {
        "input": {
          "route_id": "foundation-fix-delete",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 0,
          "settings_version": 1,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"is_deleted\"},\"source\":\"A\",\"value_mode\":\"direct\"}]"
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_ADD",
        "ASB_UNSUPPORTED_MAPPING: mapping_id=asset_name"
      ]
    },
    {
      "number": 65,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "F05 corrected reverse A target B ownership",
      "request_body": {
        "input": {
          "route_id": "foundation-fix-reverse-b",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 0,
          "settings_version": 1,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"id\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"B\",\"value_mode\":\"direct\"}]"
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_ADD",
        "ASB_UNSUPPORTED_MAPPING: mapping_id=asset_name"
      ]
    },
    {
      "number": 66,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "F05 corrected reverse A target Both ownership",
      "request_body": {
        "input": {
          "route_id": "foundation-fix-reverse-both",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 0,
          "settings_version": 1,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"entities_id\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"Both\",\"value_mode\":\"direct\"}]"
        }
      },
      "http_status": 400,
      "response": [
        "ERROR_GLPI_ADD",
        "ASB_UNSUPPORTED_MAPPING: mapping_id=asset_name"
      ]
    },
    {
      "number": 67,
      "method": "POST",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting",
      "actor": "service",
      "purpose": "F05 corrected guard keeps legal Both business mapping",
      "request_body": {
        "input": {
          "route_id": "foundation-fix-legal",
          "a_entities_id": 0,
          "entities_id": 0,
          "route_enabled": 0,
          "settings_version": 1,
          "enabled_itemtypes_json": "[\"Computer\"]",
          "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"Both\",\"value_mode\":\"direct\"}]"
        }
      },
      "http_status": 201,
      "response": {
        "id": 5,
        "message": ""
      }
    },
    {
      "number": 68,
      "method": "GET",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting/5?get_hateoas=false&expand_dropdowns=false",
      "actor": "service",
      "purpose": "F05 legal mapping guard readback",
      "request_body": null,
      "http_status": 200,
      "response": {
        "id": 5,
        "route_id": "foundation-fix-legal",
        "a_entities_id": 0,
        "entities_id": 0,
        "route_enabled": 0,
        "settings_version": 1,
        "enabled_itemtypes_json": "[\"Computer\"]",
        "field_mappings_json": "[{\"mapping_id\":\"asset_name\",\"itemtype\":\"Computer\",\"enabled\":true,\"a_field\":{\"kind\":\"native\",\"name\":\"name\"},\"b_field\":{\"kind\":\"native\",\"name\":\"name\"},\"source\":\"Both\",\"value_mode\":\"direct\"}]"
      }
    },
    {
      "number": 69,
      "method": "GET",
      "path": "/api.php/v1/PluginAgentbdmosassetsyncSetting?searchText%5Broute_id%5D=%5Efoundation-fix-%24&range=0-49&get_hateoas=false&expand_dropdowns=false",
      "actor": "service",
      "purpose": "F05 rejected guard fixture no exact invalid route persisted",
      "request_body": null,
      "http_status": 200,
      "response": []
    },
    {
      "number": 70,
      "method": "GET",
      "path": "/api.php/v1/killSession",
      "actor": "outside",
      "purpose": "Close child fixture session",
      "request_body": null,
      "http_status": 200,
      "response": true
    },
    {
      "number": 71,
      "method": "GET",
      "path": "/api.php/v1/killSession",
      "actor": "denied",
      "purpose": "Close no-rights fixture session",
      "request_body": null,
      "http_status": 200,
      "response": true
    },
    {
      "number": 72,
      "method": "GET",
      "path": "/api.php/v1/killSession",
      "actor": "service",
      "purpose": "Close restricted service session",
      "request_body": null,
      "http_status": 200,
      "response": true
    }
  ]
}
```
