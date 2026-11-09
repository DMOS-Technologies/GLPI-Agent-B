# Agent-B-DMOS-AssetSync v0.7.3-rc.1

Prepared local integration candidate, 9 November 2026 (Asia/Brunei).
Plugin metadata: **0.7.3**. Installed directory: **agentbdmosassetsync**.
The accompanying SOURCE-MANIFEST.json identifies the exact source commit,
tree, runtime file hashes and ZIP checksum. No remote tag/release, push or
deployment is performed by preparing this package.

This build is prepared for Controller A integration. It does **not** establish
that A's automatic recovery-report consumer or subsequent B-to-A application
has passed. A must adopt docs/controller-a-recovery-handoff.md and the exact
docs/recovery-assessment-contract.md before claiming automatic recovery.

## Included behavior

- Includes blocker fix commit
  `3bc468a37d75d6b241f126eea7e78611d0c9cd22`: linked native-History decisions
  no longer depend on the old upgrade marker or obsolete scalarstate writes.
  Current History, actual permissions, locks and uncertain-write evidence remain.
- Native additive installation adds hidden nullable Work `recovery_json` and
  schedules bounded recovery assessments. Installation performs no asset
  recovery writes. Existing `processWork` assesses at most 20 rows after its
  ordinary batch; these observations do not inflate ordinary sync volume.
- Explicit native Work Search option 9, `recovery_assessment`, exposes a
  versioned advisory report. Default Work single/collection/result shapes and
  existing authentication/profile rights remain unchanged.
- Reports preserve original request/result/status/error/timestamp bytes and
  historical certainty. They never replay old payloads, reopen terminal Works,
  recreate uncertain first copies or acknowledge Changes. A supplies fresh
  current values/History through a distinct existing-shape v2 request.
- Includes the reviewed nullable legacy first-copy reporting correction:
  valid null-parent receipts retain their original Skipped outcomes instead
  of being called Damaged. They remain ResolveIdentity, never creation/v2
  authorization or fabricated historical success.

## Compatibility and dependencies

The plugin declares GLPI **11.0.7 through 11.0.99**; its prerequisite check
requires at least 11.0.7 and excludes 11.1.0. Use PHP/database versions and
extensions supported by that GLPI installation. Recovery fixtures used GLPI
11.0.7, MySQL 8.4 and Fields **1.24.2**, with A 0.2.9. Other combinations are
not certified by this release's bounded run.

Fields is needed only for mappings/targets using that plugin. It is not bundled
or made a mandatory dependency for native-only mappings. Native save/History,
current profile/entity/field permissions and the existing transactional/owned
session prerequisites still apply. There are no new public record types,
custom endpoints, authentication, B-to-A calls or profile rights.

## Safe additive installation

These are instructions for a later separately authorized installation; packaging
does not execute them or authorize changes to an existing installation.

1. Privately back up B's database and complete deployed plugin. Record actual
   active path/version, task configuration and retained request/result/link/
   evidence fingerprints, including protected Works. Keep credentials and
   database backups outside distributable files.
2. Coordinate a maintenance fence for A submissions and all B human/API/CLI
   writes. Drain active execution and old PHP contexts; pause only an idle
   task through supported GLPI methods. Never reset Running, kill an uncertain
   write, uninstall/reinstall, truncate tables or clear queues.
3. Verify the ZIP with SHA256SUMS.txt. Extract its single top-level
   `agentbdmosassetsync/` directory to the existing active plugins/marketplace
   location, preserving the correct filesystem owner. The ZIP contains only
   setup.php, hook.php and inc/; it replaces no GLPI configuration/data.
4. In a fresh consistent PHP context, perform GLPI's native plugin upgrade as
   an actual administrator, then verify version 0.7.3 and Active state. DDL
   can implicitly commit or wait for locks; do not run installation inside
   a worker/save-hook transaction. Old 0.6.x guarded-upgrade tools are not
   certified for this version and are not included in the runtime ZIP.
5. Confirm the additive nullable recovery_json column, native Work Search
   option 9 and bounded assessment scheduling. Compare every original Work
   request/result/status/error/timestamp and protected data/evidence row with
   its retained fingerprint, excluding only the new sidecar. Config, plugin
   catalog, Cron and Setting continuity metadata may legitimately change.
   Retained proof rows do not establish uninterrupted old trust.
6. After successful checks, restore the prior idle scheduling configuration
   and submissions. Observe assessment progress through native Cron messages
   and explicit REST Search. A completed scan is not proof of asset convergence.
   No manual History/assessment approval switch is added.
7. Test only with separately authorized fresh disposable fixtures. Preserve
   original Works and receipts. A lost POST response requires exact original-ID
   lookup/readback before another mutation; do not blindly resend or reopen.
   On an uncertain/failed upgrade, retain the fence and account for native
   installation state; never restore old trust or replay work to force success.

## Verification and remaining limits

The committed UR01–UR16 ledger records **14 PASS and 2 PARTIAL groups** from
three isolated disposable pairs. It includes native additive upgrade, exact
legacy/default REST compatibility, complete Search JSON, 600 advisory reports
(500 NoAction/100 FreshARequired), old sibling/Unknown preservation, metadata
persistence and lock-loss faults, fresh equality/newer-A/newer-B requests and
an exact mixed snapshot remaining Pending. Initial UR05 diagnostic failure is
retained; its correction passed a separate fresh first-copy fault/upgrade.

Unrun variants remain explicit: recreated definitions; the 51-field detail cap;
control variants; different-build queued generations; actual interrupted native
installation/process death; every commit/lost-response window; other GLPI,
Fields and SQL combinations. Injected metadata failures are not every database
outage. A automatic report consumption and guarded B-to-A application remain
unimplemented/unverified here. See docs/manual-tests.md and the recovery/History/
field-sync/reconciliation contracts for exact boundaries.

Release preparation uses archive/static checks only. Existing localhost:8081,
n8n, hosted systems and Works are untouched. No additional runtime pass or
end-to-end readiness is claimed by the committed ZIP or its checksum.
