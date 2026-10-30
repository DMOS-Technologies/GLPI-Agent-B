# Scalar field History timestamps — Agent B 0.6.0

Status: deployed to localhost:8081 as 0.6.0. Administrative installation and
record-preservation readback passed; functional H01–H12 checks are NOT RUN.
This approved policy replaces the older genuine-human-edit/copy-provenance
timestamp rule for scalar Asset Sync. Notes retain their separate policy.

## Decision rule

Read the currently permitted mapped values under the existing storage/route
locks. Equal values return AlreadyEqual without an asset write. For different
Both values, compare the latest recorded GLPI History instant for each specific
field, including History created by synchronization, imports and other native
writers. Do not inspect who edited it or classify the write as human/copied.

| A field History | B field History | Outcome |
|---|---|---|
| Present | Present, older | AppliedToB |
| Present, older | Present | ReturnToA |
| Absent | Present | ReturnToA |
| Present | Absent | AppliedToB |
| Absent | Absent | Conflict; no timestamp is invented |
| Same instant, different values | Same instant | Conflict |

The one-sided rule applies to confirmed missing History, not a permission,
query or field-resolution failure. Such failures retain the existing safe
field rejection/Held behavior. A newer timestamp means a later recorded field
write; it does not mean that its author was a human or that its original source
content was newer. The user explicitly selected this simpler policy.

## Blank text comparison — local patch after 0.6.0

The local candidate built after released commit `61795e5` adds an equality-only
rule for supported scalar **text** descriptors: actual SQL NULL and exact `""`
are both unfilled. This patch is not included in the original 0.6.0 release;
its version metadata is unchanged. Verify the deployed source/build includes
`plugin_agentbdmosassetsync_blank_text_equal()` and its legacy/v1/v2 call sites
before relying on it. The authorized localhost deployment and bounded BT manual
results are recorded in [the runtime ledger](manual-tests.md#blank-text-localhost-deployment-and-bt-runtime--31-october-2026);
hosted deployment and full A/B readiness are not claimed. No new wire key, option
version, schema column or timestamp meaning is introduced.

After current parent/scope/field permissions and locked storage reads, two
text blanks are `AlreadyEqual` (`VerifiedEqual` on opted-in v1/v2 Work), before
History lookup or a native write. This applies under A, B and Both authority.
Both stored representations and all existing History stay unchanged. Ordinary
source-A prewrite permission checks remain; a no-op does not authorize clearing
an otherwise unsupported nullable destination. Source B needs an actually
supplied A comparison value; omission is not a blank. When that optional value
and current B text are both blank, B emits AlreadyEqual with no return tuple.
Otherwise source B retains ReturnToA with B's actual value and History evidence.
Nonblank A/B/Both behavior is unchanged.

The text kind comes from the actual native search/storage metadata, Fields
scalar text/textarea/URL definition or supported core custom String/Text/URL
field descriptor. Whitespace-only text is nonempty and remains byte-for-byte
significant. The rule does not treat false, numeric zero, dates, dropdowns,
Notes, multiple/rich-text core custom fields or unsupported bindings as blank
text. Read/permission/storage-column failures are failures, not NULL. Existing
explicit-clear validation still applies when the current value differs.

For example, an enabled direct text mapping named `shared_contact`, selected
in a fresh v1/v2 Work, can supply these existing-shaped properties:

```json
{
  "a_values_json":"{\"shared_contact\":\"\"}",
  "a_change_times_json":"{\"shared_contact\":{\"changed_at\":null,\"reliable\":false}}"
}
```

If the locked permitted B value is SQL NULL, its field receipt is:

```json
{"mapping_id":"shared_contact","outcome":"AlreadyEqual","certainty":"VerifiedEqual","error_code":null,"reason":null}
```

The reverse NULL/empty-string pair has the same no-write outcome. These are
properties inside the existing complete Work schema, not a new partial endpoint.
A legacy outcome retains only `mapping_id`, `outcome` and `reason`. AlreadyEqual
adds no `b_values_for_a` tuple; A must not invent B's representation or infer it
from an older Conflict. A must use verified concrete field metadata to apply the
same equality-only rule when handling actual returned values/current A reads,
without coercing another type or rewriting either stored representation.

Exact nonblank save verification, immutable snapshots, returned snapshot values
and whole-snapshot acknowledgement predicates are unchanged. Logical blank
convergence alone does **not** cover an exact NULL-versus-empty snapshot or
supply missing/timely returned evidence. Mixed unresolved snapshots remain
Pending/Held as before; A must account for every exact field/revision before its
normal exact-ID acknowledgement. A must preserve old Unknown/Conflict receipts.
After original terminal readback and normal Active parent/scope/Accepted guards,
a distinct contracted fresh current-state operation can establish convergence;
it cannot certify that an earlier write succeeded. A's corresponding code and
integration have not been changed or verified by this B patch.

## Existing GLPI storage and permissions

B reads native `glpi_logs` for the typed asset, exact parent ID and actual
field search-option ID, using the same field identification as installed
GLPI11.0.7/Fields1.24.4 History writers. Native dropdown IDs, container-scoped
Fields options and core custom-field definitions are resolved generically.
Only ordinary field-change entries (`linked_action=0`) qualify; general asset,
subitem and unrelated-field events do not. Actual parent/field READ and native
`Log::canView()` (`logs` READ) are required. No profile is granted rights by B.

Read the timestamp as a database Unix instant, then expose RFC3339 in +08:00
Brunei time. The querying user's display timezone must not shift that instant.
History values can be truncated or formatted; they are not used as timestamp
evidence. The asset's general `date_mod`, polling time, Work IDs and queue order
are not substitutes for a field History row. Only a successful exact-field
History query returning zero rows establishes absence, including purged History.
An unsupported identifier, malformed timestamp or unreadable History is a
failure. GLPI's timestamp precision applies, so ties remain possible.

This uses recorded native History as it exists at the locked current read. It
does not make GLPI's separate value save and History insertion atomic, certify
an interrupted write or reconstruct purged History.

## REST compatibility and Controller A requirements

There are still only native V1 Setting, Work and Change resources. No endpoint,
column, authentication method or request/result member is added. The existing
`a_change_times_json` and `b_values_for_a` entries keep exactly these keys:

```json
{"changed_at":"2026-10-29T22:42:09+08:00","reliable":true}
```

For 0.6.0 scalar comparisons, reliable means that the latest field-specific
History timestamp was successfully read. A confirmed missing History entry is:

```json
{"changed_at":null,"reliable":false}
```

This is a semantic policy change for legacy, v1 and v2 scalar paths, not a new
`field_sync_json` version. Clients must check deployed B version >=0.6.0 and
align timestamp meaning before using this policy. Historical Works/results stay
immutable; their old timestamps retain the meaning used when they were produced.

A must read its own latest field-specific GLPI History, including sync writes,
and send that timestamp for the value it rereads. It must not send the original
copied-content time as though it were the latest local History time. It must
use null/false only for confirmed absence, and handle permission/read failures
locally instead of labelling them missing. B cannot independently establish why
A sent null/false. Controller A has not been inspected or changed for this work;
its existing support for this policy is not claimed.

Source A/B authority, selected-field exclusion, explicit clears, identity/scope
and actual native save permissions remain unchanged. Missing internal binding
manifests no longer block History-time arbitration; an incomplete upgrade still
does. Existing binding/current-proof records remain stored for save/recovery
accounting, but do not determine the new comparison timestamp. No historical
proof or outcome is rewritten or promoted.

## Recovery, capture and verification

Keep the existing durable in-flight markers, field certainty, restart and
unknown-write handling. A History timestamp alone does not prove a particular
Work succeeded. Do not replay old Works, uncertain first copies or historical
Held requests. First-copy identity/association/receipt verification remains
unchanged. Exact whole-snapshot Change acknowledgement is still required.

Native sync writes continue to create normal GLPI History. B's existing origin
guard still suppresses feedback Changes; the timestamp lookup itself does not
write an asset, Change, proof or log. Equality prevents a redundant sync write.
New Asset Change captures use GLPI's native session clock in the same database
timezone as `Log::history()`, then convert to +08:00. This avoids a separate
capture clock making a completed field's snapshot appear newer than its native
History row. It does not manufacture a History row or prove that one exists;
arbitration still reads the actual log. Historical Change timestamps and Notes
capture are unchanged, and whole-snapshot acknowledgement checks are not relaxed.
Notes, billing, UUID and Controller A changes are outside this work.

The H01–H12 plan in [manual-tests.md](manual-tests.md) is NOT RUN. Native/Fields/
custom-field resolution, both one-sided cases, permissions, timezone, equality,
concurrency, A alignment and exact acknowledgements require manual verification
before claiming integration readiness.
