# Automatic scalar reconciliation — field-sync version 2

This normative extension requires Agent B **0.4.0** and the existing 0.3.0
plugin upgrade. It extends [the API contract](api-contract.md) and
[field-sync version 1](field-sync-contract.md). It introduces no column,
record type, profile right, endpoint, authentication or outbound call.
Version 1 and absent/null `field_sync_json` retain their existing behavior.

B >=0.6.0 applies the [native field History policy](history-contract.md) to
new scalar comparisons, retaining existing request/result shapes and recovery
rules. A must send its latest field History time, including sync writes, rather
than original copied-content time. Confirmed one-sided absence selects the side
with History. Failed/denied History lookup is not absence. A code changes and
runtime integration have not been performed for this policy.

On 0.5.2 an unavailable current binding is identified by the mapping receipt's
`FIELD_BINDING_UNAVAILABLE` code; the aggregate remains `EVIDENCE_CONFLICT`.
A fresh reconciliation request cannot repair that configuration by retrying.
After an authorized binding repair, old proof remains untrusted until genuine
current-value evidence exists. See [API section 5.6](api-contract.md#56-scalar-genuine-evidence-across-setting-versions-041).
The 0.6.0 History policy above supersedes that arbitration dependency; retained
binding/provenance receipts still do not certify an old operation's completion.

The local post-0.6.0 [blank text patch](history-contract.md#blank-text-comparison--local-patch-after-060)
adds permitted locked NULL/empty-string no-op equality for concrete text fields
under A/B/Both. It changes neither v2 admission nor History timestamp meaning.
VerifiedEqual describes current logical convergence, not exact old values or
an earlier Unknown write. No B tuple is synthesized and exact whole-snapshot
coverage still applies. Original 0.6.0 lacks this patch; verify deployed build,
aligned A returned-value handling and snapshot accounting before relying on it.
The candidate is deployed only to localhost; [the BT runtime ledger](manual-tests.md#blank-text-localhost-deployment-and-bt-runtime--31-october-2026)
records actual bounded results and remaining variants. Hosted deployment and
Controller A integration are not certified.

## Purpose and boundary

The optional [participation contract](participation-contract.md) (0.5.0) is a
separate Work opt-in, usable with a fresh current v1/v2 Asset Sync. Its outcomes
do not resolve prior scalar Unknown receipts or cover any Change snapshot.
Flags cannot authorize creation or replay; first-copy and terminal original Work
rules remain intact. A must not opt B→A-only readback requests into participation.

A may automatically start a **new current-state operation** after a terminal
linked Asset Sync Work, including one whose result is Unknown, missing or
unreadable. The old Work stays unchanged. This is not a replay, reset or a
claim that the old operation succeeded. Matching values now establish current
convergence, not the history or side effects of an earlier write.

The policy permits fresh assignments through the existing supported scalar
writers, under current authority, scope and permissions. A supplies fresh
current values and their genuine field evidence, not a copied old request or
the time the reconciliation was scheduled. A selects the fields requiring a
fresh decision; B performs the final live read/compare under its locks.

Only an existing verified **Active** relationship is eligible. First-copy or
serial-adoption uncertainty, asset creation, Notes, Suspend/Resume, moves,
billing and UUID are outside this extension. The original referenced request
must itself positively identify an existing linked B asset; a null original
`identity_json.b_items_id` is not eligible, even if a later result mentions an
asset. An unreadable result never licenses creation, linking or fallback.

Native hooks can change related data or cause effects beyond mapped scalar
values. This policy repairs current mapped state; it does not certify or
reconstruct those earlier effects. Unsupported values, missing permissions and
unresolved Both evidence remain visible conditions. A revisits them after
repair or new trustworthy evidence; B does not run an orchestration loop.

## Exact request

`field_sync_json` remains an A-owned creation-only JSON **string** in the
existing hidden nullable Work column. Version 2 contains exactly:

```json
{"version":2,"mapping_ids":["asset_status"],"reconcile_work_id":401}
```

`reconcile_work_id` is the positive **B Work row ID**, not A's opaque `work_id`,
an asset ID or a Change ID. The reference is correlation and eligibility
evidence only. B never takes desired values, authority or field times from the
old result. There is no new top-level `source_timestamp` or `parent_change_id`.
A may keep parent/correlation identifiers in its own durable ledger.

All version 1 selection rules still apply: distinct current enabled mapping
IDs for the exact route/itemtype/current Setting version, no values or time
entries outside the selection, empty selection selects none, and positive
linked identity is required. Exclusion does not clear or disable a mapping.
Explicit null is a separately validated clear only where the existing writer
supports it; dropdown, Fields and GLPI custom-field null clears are not added
by this extension. Dropdown transport uses readable labels resolved to one
permitted destination-local option, never foreign IDs.

The referenced Work must be readable under the authenticated submitting user,
have subject Asset and operation Sync, and have terminal status Done, Held or
Failed. Its immutable request must have the same route, itemtype, A asset ID,
A/B entity pair and positive B asset ID as the new request. Accepted is not
eligible, even when its last visible field outcome looks complete. B rechecks
the reference and retained Active relationship during processing.

The old Setting version may be older after an actual mapping or permission
repair; it must not be newer than the new request's version. The **new**
request must use the current Setting version;
its selected IDs and current authority apply. Selected IDs need not equal the
old selection. This is explicit fresh intent, not an assertion that old
mapping bindings or old snapshots are now covered. References to old-version
Changes still follow the unchanged exact snapshot rules.

Malformed options or an unavailable, nonterminal, incompatible or ineligible
reference reject at admission with the existing native validation wrapper and
`ASB_INVALID_FIELD: field=field_sync_json`. Rights and base schema validation
can reject first. A duplicate `work_id` remains `ASB_WORK_EXISTS`; no upsert,
reapplication or modification occurs.

## Processing and execution isolation

Version 2 runs each Work, including its durable start marker, on a newly
constructed native configured GLPI DB object/session. It does not close and
reconnect the old object or force rollback of another task's transaction.
The original database connection remains open and retains the global worker
lock. B restores the original global connection afterwards and closes only its
owned session. No fresh PHP process is required per version 2 Work.
Both fresh writer and observer apply GLPI's existing database read-decoding
policy through its public setter, after backend verification. They read the
existing core `must_unsanitize_db_data` configuration with GLPI's native
default; they do not change that configuration or reinterpret upgraded data.

The owned writer and independent observer must positively establish that they
use the same database backend as the lock owner. Independently visible Work
evidence, rather than a same-connection read of uncommitted data, establishes
durability. A committed in-flight marker precedes a possible native mutation.
The field and provisional proof use checked transactional storage; completion
must be visible independently before publishing a verified result. A leaked
nested transaction, observer failure, missing proof or uncertain cleanup stops
processing and retains the last independently established evidence. Before
native completion this is the durable start/Unknown marker. If final completion
was already committed and verified before a later cleanup/lost-response error,
B does not erase or downgrade it; a later GET can establish that stored result.
No uncertain write is automatically replayed by B.

The worker/route lock checks and interrupted-Work handling must establish that
the referenced execution cannot still mutate the asset. A terminal Work alone
is not permission for A to overlap another Accepted operation. A serializes
overlapping work for a route/asset and waits for terminal evidence. If the
reference or its execution scope is no longer valid, the new Work Holds with
the safe work-context code `RECONCILE_SCOPE`. Another Accepted Asset Work for
the same route/type/A-B pair gives `RECONCILE_PENDING`; it must be accounted for
before a distinct fresh operation. Selected fields do not gain invented write
certainty. The processor also rechecks its own Accepted state under the write
lock, so an interrupted old owner cannot keep writing after becoming terminal.

These execution guarantees apply only to version 2. Version 1 retains its
documented dedicated fresh CLI boundary. Native hooks or external systems may
have other effects; independent mapped-value/proof visibility is not a
certificate for arbitrary external actions. Runtime fault and concurrency
checks remain required before deployment or an integration-readiness claim.

## Authority and results

| Mapping source | Fresh reconciliation |
|---|---|
| A | Compare the supported current A value to B's locked live value. AlreadyEqual needs no write; a difference uses the native writer and verified reread. |
| B | Leave B unchanged and return its current value/evidence. A must verify its own local handling before considering a Change covered. |
| Both | Equal values need no write. On B >=0.6.0 compare recorded per-field History: newer wins; a known time wins over confirmed absence; both absent/tied with different values conflict. Earlier versions use genuine-only evidence. |

GLPI's whole-asset `date_mod`, Work execution/poll times and reconciliation
times are never substitutes for field History. In 0.6.0 an actual sync write's
native field History does count, regardless of the original content's older time;
an observation alone creates no new timestamp. B rechecks current values and authority
immediately before a possible native save. Ordinary human saves remain
unchanged, and sync-origin guards continue to suppress feedback Changes.

The **0.4.1** internal evidence-continuity fix is specified in
[API section 5.6](api-contract.md#56-scalar-genuine-evidence-across-setting-versions-041).
It preserves trustworthy current-value proof across an unchanged continuously
enabled binding, rather than requiring the human edit to have occurred at the
new Work's settings version. Changed bindings/gaps/uncertain writes do not inherit
trust, and copied original times remain separate from B's human Change history.
No version 3 option or Controller A wire key is introduced. The separate
[0.4.1 local runtime ledger](manual-tests.md#mapping-version-and-first-copy-local-runtime-verification--29-october-2026)
records the additive upgrade, bounded MV/first-copy checks and precise remaining
gaps. Earlier 0.4.0 evidence below applies to that earlier deployment.

The first-copy evidence integration described in API section 5.6 does not widen
version 2 eligibility. An original first-copy request with null B identity still
cannot authorize reconciliation. Its provisional created-value proof requires
the originating Work's final Done; uncertainty/started recovery never becomes
reliable merely because current values match. Existing original-ID readback and
verified-link/serial lookup remain distinct from any permission to create again.

The six ordinary extended result members and field outcome/certainty pairs
are unchanged. The `field_sync` member has the version 1 keys plus the exact
reference, and `version` is 2:

```json
{
  "b_items_id":231,
  "created_b_items_id":null,
  "b_values_for_a":{},
  "covered_change_ids":[],
  "handled_change_ids_done":[],
  "field_outcomes":[
    {"mapping_id":"asset_name","outcome":"Excluded","certainty":"NotAttempted","error_code":null,"reason":"Mapping not selected for this Work"},
    {"mapping_id":"asset_status","outcome":"AlreadyEqual","certainty":"VerifiedEqual","error_code":null,"reason":null}
  ],
  "field_sync":{
    "version":2,
    "mapping_ids":["asset_status"],
    "reconcile_work_id":401,
    "in_flight":null,
    "error_code":null,
    "reason":null,
    "snapshot_outcomes":[]
  }
}
```

This is decoded `result_json`, not the HTTP body of a custom endpoint. Native
GET returns the normal Work row with this object encoded as a JSON string.
`field_sync_json` remains hidden from raw single, collection and search rows;
A retains its own original request if the parsed echo is later damaged.
Version 1 results never gain `reconcile_work_id`.

`AppliedToB/VerifiedApplied` or `AlreadyEqual/VerifiedEqual` describe the new
operation only. `ReturnToA/NotAttempted` still needs A's save/equality proof.
Rejected fields can coexist with verified siblings. Conflict or uncertainty
Holds the new Work. Existing safe field codes are unchanged; new reference
context codes do not classify a problem as an independently rejected field.
The old Work is neither reclassified nor updated when convergence succeeds.

## Controller loop and whole Change acknowledgements

1. After a lost POST response, locate the original exact `work_id`. Poll that
   Work; never create a replacement merely because the network failed.
2. Wait until the original linked Sync is terminal. Retain its request and
   evidence, including damaged or Unknown evidence. Repair any actual cause.
3. Prepare fresh current desired values, genuine field times and current
   Setting version. Submit a distinct v2 Work selecting fields that require
   current-state reconciliation. Do not resubmit saved stale payloads.
4. Poll the new Work and consume field outcomes/certainty. Keep successful
   siblings; A records per-field/revision coverage and incidents in its own
   durable storage/Sync problems. B does not schedule later attempts or log A's
   local failures.
5. Revisit remaining rejected/conflicted fields only with valid current scope
   and a repaired cause or new evidence. New uncertainty follows the same
   original-ID/readback/terminal-reference process, without reopening a Work.

A can combine coverage from several targeted Works in its own ledger. B's
correction processing evaluates the current Work, not an aggregate of earlier
receipts. A Change remains an immutable whole snapshot: one excluded,
rejected, conflicted or unknown field prevents completion of that snapshot.
Matching current values do not automatically acknowledge historical revisions.
Each field must be demonstrably handled or superseded under its authority and
genuine revision rules, and ReturnToA values must actually be handled by A.

`handled_change_ids_json` references exact B Change IDs; it does not acknowledge
them on receipt. Fully selected corrections retain existing coverage checks.
Mixed partially selected snapshots stay Pending, with unchanged attempt count
for excluded snapshots and no premature `handled_change_ids_done` entry.
After A has accounted for the entire exact snapshot, it uses the existing
id/status PUT. B validates rights, identity, scope and transition; B cannot
independently prove A's local save. A must not send a full acknowledgement
merely to clear an unresolved field or advance pagination.

## Exact REST example

Use the configured HTTPS V1 base. Local disposable verification, only when
authorized, uses `http://localhost:8081/api.php/v1`. IDs are illustrative.
Reference Work 401 is terminal linked Asset Sync for the same A 42/B 231 pair;
its result may be unreadable. Current route version 8 may follow version 7
used by 401.

```http
POST /glpi/api.php/v1/PluginAgentbdmosassetsyncWork
Content-Type: application/json
Accept: application/json
App-Token: <B_API_CLIENT_APP_TOKEN>
Session-Token: <B_SERVICE_ACCOUNT_SESSION_TOKEN>
```

```json
{"input":[{
  "work_id":"A-reconcile-20261029-001",
  "subject":"Asset",
  "operation":"Sync",
  "route_id":"route-12",
  "a_entities_id":12,
  "entities_id":5,
  "itemtype":"Computer",
  "identity_json":"{\"a_items_id\":42,\"b_items_id\":231,\"serial\":\"SN-0042\"}",
  "a_values_json":"{\"asset_status\":\"On Hold\"}",
  "a_change_times_json":"{\"asset_status\":{\"changed_at\":\"2026-10-29T10:00:00+08:00\",\"reliable\":true}}",
  "settings_version":8,
  "handled_change_ids_json":"[]",
  "field_sync_json":"{\"version\":2,\"mapping_ids\":[\"asset_status\"],\"reconcile_work_id\":401}"
}]}
```

```http
HTTP/1.1 201 Created
Content-Type: application/json

[{"id":402,"message":""}]
```

This is admission only. Poll with the same App/Session/Accept headers and no
body:

```http
GET /glpi/api.php/v1/PluginAgentbdmosassetsyncWork/402
```

HTTP 200 returns the saved row; inspect `status` and decode `result_json`.
Native messages/IDs vary as defined in the main contract. All-invalid bulk
admission of an incompatible reference or malformed v2 option uses:

```http
HTTP/1.1 400 Bad Request
Content-Type: application/json

["ERROR_GLPI_ADD",[{"id":false,"message":"ASB_INVALID_FIELD: field=field_sync_json"}]]
```

Mixed inputs use the normal 207 wrapper. Runtime Held/Unknown is a 200 read of
a saved Work, not a new custom HTTP error. For lost POST responses, use the
existing exact work-ID collection lookup. After actual full snapshot handling,
the existing Change collection PUT remains `{"input":[{"id":301,"status":"Done"}]}`.
Read back exact uncertain/missing acknowledgement IDs; never assume HTTP 200,
array position or `covered_change_ids` alone proves completion.

## Verification status

The user subsequently authorized deployment to local Docker B and bounded
manual RC01–RC22 checks with disposable fixtures. The
[runtime ledger](manual-tests.md#automatic-scalar-reconciliation-local-runtime-verification--29-october-2026)
records observed results, retained original evidence, narrow fixes and remaining
subvariants. Main-environment protected records were compared separately; clone
fault/upgrade fixtures use isolated database namespaces. No Controller A runtime
or real-environment deployment was exercised. Partial variants, including actual
wire-response loss and A-side scheduling/coverage, remain explicit gaps rather
than source-derived passes. The run does not establish A/B integration readiness.
