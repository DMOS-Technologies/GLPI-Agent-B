# Agent-B-DMOS-AssetSync v0.7.2-rc.1

Test candidate, 8 November 2026. Plugin metadata: **0.7.2**. Target GLPI
11.0.7 through 11.0.x. No Controller A contract update is required for these
two fixes. Existing REST V1 resources, authentication, payloads, statuses,
ownership, History and recovery rules remain unchanged.

## Included fixes

- `inc/write.php::plugin_agentbdmosassetsync_write_fields_nulls()` supplies
  Fields' required third `validateValues()` argument, `false`, for merged
  full-container validation. Sparse selected validation still uses `true`.
  This fixes a demonstrated argument-count exception for valid empty/null
  Fields input without bypassing native validation or exact reread.
- `hook.php::plugin_agentbdmosassetsync_install_work_lookup_index()` adds one
  nonunique full-column BTREE index `b_asset_link (itemtype, b_items_id, subject)`
  to B's Work table. Fresh installation includes it; additive installation
  checks it. A conflicting same-name definition fails without destructive
  replacement. Processing SQL, competing-owner checks and locking calls are
  unchanged; physical Work lock ranges are narrower.

## Safe installation boundary

This release is an additive upgrade, never uninstall/reinstall or queue reset.
It does not retry or resolve old Held/Failed/Unknown requests.

1. Privately back up B's database and complete installed plugin. Record current
   version, active source path, task configuration and retained-record
   fingerprints, including protected Works and evidence.
2. Coordinate a maintenance fence for A submissions and all B human/API/CLI
   writes. Drain active execution; pause only an idle task through supported
   GLPI methods. Never reset Running or kill an uncertain write to force an
   upgrade. Drain old PHP contexts before replacing source.
3. Verify the downloaded ZIP against SHA256SUMS.txt. Its single top-level
   directory is `agentbdmosassetsync/`, containing only `setup.php`, `hook.php`
   and `inc/`. Keep that deployment directory name and the correct GLPI
   filesystem owner. Do not replace GLPI configuration or data directories.
4. Perform GLPI's native plugin upgrade under actual administrator permissions,
   then start fresh consistent PHP contexts. Plugin metadata changes to 0.7.2;
   version detection can unload an older installation before upgrade. The
   index-only helper is not a substitute for this version/schema transition.
5. Read back exact native version/active state and the nonunique, usable,
   full-column `b_asset_link` definition in the stated order. Compare retained
   Work/Change payloads/results, links, evidence and rights with the backup
   fingerprints. Do not write historical outcomes to make checks pass.
6. Inspect current binding/capture readiness before restoring submissions and
   the prior scheduler configuration. Verify with separately approved fresh
   disposable fixtures, not old recovery Works. After a lost response, read
   the exact original ID before another mutation.

DDL implicitly commits and can wait for metadata locks. Run administrative
schema work in a fresh session without an active transaction, never inside a
worker or save hook. If an index definition conflicts or an upgrade check
fails, retain the fence and investigate; do not drop data/indexes or blindly
repeat application operations.

**Upgrade verification limit:** the data-plane patches were tested with 0.7.1
metadata. The 0.7.1 to 0.7.2 native version/activation transition itself has NOT
RUN runtime verification. Native lifecycle conservatively handles capture gaps
and can invalidate binding trust. Retaining rows is not uninterrupted evidence
continuity. The old 0.6.x guarded-upgrade helpers are not certified for 0.7.2;
do not merely change their target version. Do not restore old trust generations
or downgrade over new requests to bypass a failed check.

## Verification and limits

The manual ledger retains the detailed FN and LQ results. FN01–FN06 passed;
FN07–FN09 remain partial. All seven scoped LQ checks passed, including exact
retained rows, index idempotency, conflicting-index rejection and bounded
repeatable-read locking probes in disposable MySQL 8.4.8.

A fresh disposable latest-A/patched-B integration run independently passed
1,000 assets per Computer/Monitor/Peripheral type, 63,000 exact scalar values,
3,000 formatted Notes, 6,000 actual Yes flags, copied evidence, current A
accounting and journals. Subsequent additions/edits/equal Notes in both
directions passed without feedback or flag History changes. Main convergence
was 2h23m12.5s, including observer pauses; it was slower than the separate
earlier optimized-A run. This does not prove an index-only full-sync speedup
or production scheduler throughput. See [the evidence summary](manual-tests.md).

Existing recovery records remain historical. This release does not diagnose
the original hosted nonempty Computer Name save failure, certify every field
or SQL version, attachments, crash/commit uncertainty, production concurrency
or a fully preserving operational upgrade. No runtime tests or deployment
were performed for packaging. ZIP integrity and exact committed-file checks
are packaging checks, not runtime passes.
