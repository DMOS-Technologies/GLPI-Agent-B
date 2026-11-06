# Automatic scalar-null discovery — 0.7.1 source candidate

Normative additive extension to the API, field-sync and reconciliation contracts.
No new endpoints, authentication, modes or write probes. Uses GLPI REST V1 only.
Source candidate: not deployed or runtime verified. A implementation is separate.

## Setting support declaration

Add nullable B-owned `scalar_null_support_json` LONGTEXT DEFAULT NULL to Setting.
The database value remains NULL. Current code computes its JSON_TEXT value during
native REST serialization, after normal record/entity READ authorization, only
for a complete Setting row and a ready additive schema. Never persist a positive
capability: older code reading the same database returns NULL, not stale support.
A cannot supply this field on POST/PUT; use the existing B-owned-field rejection.
A-owned Setting publication/version/content equality must exclude this field.

The readiness predicate requires a fresh current plugin-init completion marker,
the plugin active, loaded Work and Change
policy constants strictly2 (the same constants used for admission/capture),
all five plugin tables present, and the required extension columns present:
Setting support/evidence/participation; Work policy/field-sync/participation
input and progress; Change policy/subject/note; scalar-state state_json and
Note-link state. Missing metadata or any readiness-query exception yields NULL.
The declaration does not validate every mapping or guarantee database health
against a later failure. Normal operations retain their own validation/receipts.

Authoritative read: `GET /apirest.php/PluginAgentbdmosassetsyncSetting/42`, normal
App-Token and Session-Token headers. No body. Example additional response member:

```json
{"scalar_null_support_json":"{\"version\":1,\"ready\":true,\"work_policy\":2,\"change_capture_policy\":2,\"change_policy_field\":\"capture_policy\",\"historical_change_policy\":null,\"settings_id\":42,\"route_id\":\"example-route\",\"settings_version\":9,\"a_entities_id\":0,\"entities_id\":1}"}
```

These IDs are examples, not configured identities. Scope fields must exactly
match the actual returned Setting and A's intended connection/route. Itemtype
applicability still comes from the existing enabled types and mappings.
Native full-row collections also serialize support. Search/id-only/filter or
incomplete field fragments do not acquire invented row keys/capability. The
stored support member must actually be NULL and the full persisted Setting
shape must be present. Search/filter maps are not capability responses or an
authoritative discovery mechanism, even when caller-shaped like full rows. Locate
the Setting through normal discovery, then use its authoritative individual GET.
Missing/NULL/unreadable/malformed support is unavailable, never implicit policy2.
Normal native GET success/error status and permission responses remain unchanged.
This declaration reports support, not permission to modify a particular field,
proof of uninterrupted binding continuity, or success of a previous Work.

## Immutable Change capture classification

Add B-owned `capture_policy` TINYINT UNSIGNED NULL DEFAULT NULL to Change.
New Asset snapshots captured by a proven fresh current initialization stamp2
inside the trusted capture creation transaction and verify it with the saved
snapshot. An old/unproven bootstrap that autoloads the new Change class stamps
NULL instead, without blocking capture or certifying its semantics. New Notes use NULL;
Notes behavior is unchanged. A cannot set/update the marker. The existing
acknowledgement remains exactly `{"input":{"id":77,"status":"Done"}}`.

`GET /apirest.php/PluginAgentbdmosassetsyncChange/77` returns the additional
`"capture_policy":2` (native V1 integer/decimal integer string). Historical
rows return `"capture_policy":null`. No existing snapshot or result is backfilled,
rewritten, acknowledged or reclassified. NULL means UNKNOWN, not proven legacy0.
It includes older general-null captures without durable classification. Never
infer their semantics from values, timestamps, IDs, current capability or a newer
Work. Already staged A policy0/1/2 pins and valid historical declarations remain
historical evidence; fetching a new capability never repins those records.

A first-stage Asset Change may pin2 only from its immutable marker2 and valid
current support/scope. Missing/NULL/unsupported markers use conservative existing
handling; they cannot gain new clock-free equality or clear permissions. Current
convergence is distinct from historical completion. Exact mixed-snapshot ACK
rules, immutable original IDs and receipts remain unchanged.

## Admission and upgrade

Minimum automatic-discovery build: this actual 0.7.1 revision plus its additive
upgrade. No manual hash, Change ID or Scalar null compatibility option is needed
in aligned A. A reads support in background or existing explicit connection Test,
not during asset saves or ordinary page loads. It validates scope and pins new
preparations from support. Existing prepared/submitted requests retain their
immutable policy and payload; old unsent requests must not cross changed admission
semantics by blind submission. Original-ID readback stays available.

Existing hidden Work `dropdown_empty_version` remains private and unchanged:
old0/1/2 rows are never migrated; new Asset Sync admissions retain2. It is not a
REST capability switch. Setting versions remain strictly increasing publication
versions, not value-policy negotiation. Client Setting payloads remain unchanged.

Use ordinary coordinated backup/drain/additive upgrade and fresh PHP contexts.
Do not uninstall/reset queues, reset Running tasks or restore trust generations.
Support from one runtime cannot certify mixed old/new application nodes or stale
PHP workers; deploy consistently before restarting synchronization. Previous0.6
upgrade helpers are not certified for0.7.1. Native lifecycle may conservatively
invalidate binding trust; this extension does not repair or bypass that fact.

History, A/B/Both authority, supported native clear limitations, locked current
reads, durable uncertainty, first-copy proof gates, sibling progress and origin
suppression are unchanged. No uncertain Work is replayed, reopened or declared
successful. Notes, billing and UUID are outside this extension.
