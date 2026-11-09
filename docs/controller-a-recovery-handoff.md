# Controller A handoff — B 0.7.3 recovery assessments

Read Controller A's AGENTS.md and the updated B
[recovery contract](recovery-assessment-contract.md),
[History contract](history-contract.md) and
[v2 reconciliation contract](reconciliation-contract.md) first.
This document requests future A work; no A implementation is included or claimed.

Use parallel programmers with separate ownership for discovery/polling and
current-state catch-up/accounting, plus independent review. Preserve existing
A/B Works, History, receipts, links and uncertain-write safeguards. Do not edit
B, hosted systems, n8n or existing localhost installations to implement A.

Implement automatic consumption of B's advisory recovery reports:

1. Discover native Work Search option 9 named `recovery_assessment` on a matching
   B 0.7.3+ additive upgrade. Poll using existing authenticated REST V1 search,
   explicitly selecting ID column 1 and assessment column 9. Use stable ID
   pagination; validate and decode the complete JSON string, never a display
   preview. Null means not assessed. Default B Work GET/result shapes are unchanged.
2. Match the exact original B Work to A's durable operation. Read its actual
   current status/result and retain immutable historical evidence. Reports can
   immediately become stale. `a_freshness=Unknown`, a matching current B value
   or `FreshARequired` never proves the old write succeeded or authorizes replay.
3. Treat `NoAction` as no new B scalar repair recommendation only. Finish any
   normal A-local ReturnToA/finalization/acknowledgement obligations using the
   original evidence. Never infer them from B's assessment state.
4. For `FreshV2`, recheck the terminal original positive linked identity,
   current route/entity/type/Setting/mapping and permissions. Account for all
   overlapping Accepted operations. Reread current A values and actual
   field-specific History; never copy the old request payload or a scheduled time.
5. Select only fields requiring fresh current-state reconciliation, preserving
   verified sibling progress and newer edits. Follow current A/B/Both authority,
   logical null/blank rules, native permissions and exact saved-value checks.
   The at-most-50 report fields are hints: truncated or missing observations
   do not reconstruct the original selection or mean omitted fields succeeded.
   Unavailable old-manifest observations are not a new sync gate: do not wait
   for every observation to become Available. Verify the current concrete
   mapping and let ordinary admission/native-History checks decide the fresh
   request.
6. Deduplicate fresh catch-up intent with A's existing durable mechanisms.
   Submit a distinct immutable v2 Work with the exact terminal B row reference.
   Preserve original Work IDs and receipts. A lost POST response requires
   exact original-ID lookup/readback; never blindly resend or overlap writes.
7. Keep `AccountOriginal` and `ResolveIdentity` visible in Sync problems with
   safe condition codes and the original correlation. Never automatically
   recreate an uncertain first copy or send v2 using an old null B identity.
   New trustworthy current evidence can support a later eligible request;
   it cannot manufacture historical certainty.
   In particular, a positive created ID in an old first-copy result does not
   change its null immutable request identity into an eligible v2 reference.
   Account for the original completion/association through the existing
   first-copy and retained-link rules before choosing any fresh linked flow;
   this extension does not add automatic first-copy repair.
8. Consume the new operation's actual receipts through existing guards. Keep
   old Unknown/Conflict/partial records historical. Acknowledge only exact whole
   Change snapshots after every field/revision and local A obligation is accounted
   for. An assessment never acknowledges or completes a Change.

Verify in fresh disposable Docker: pre-upgrade blocked and partially successful
requests; newer A/B edits; already equal and explicit empty values; Unknown and
uncertain first copy; stale/truncated reports; repeated polling/restarts and
upgrade generations; lost responses and overlapping Accepted execution. Confirm
no duplicate assets/native writes, feedback Changes, old receipt rewrites or
premature acknowledgements. Use a finite manual ledger; do not add automated
tests or deploy/commit without the relevant authorization.
