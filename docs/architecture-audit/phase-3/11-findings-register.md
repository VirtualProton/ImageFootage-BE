# Phase 3 findings register

The machine-readable version is `security-findings.csv`.

## Highest-impact verified source findings

1. **P3-001 — payment side effects before/without visible idempotency**: payment callbacks can invoice/email before or alongside status/cart updates; no processed-callback guard or transaction is visible. High, source-only.
2. **P3-002 — download proxy destination/TLS/resource controls**: user URL, redirects, TLS verification disabled, no visible timeout/size/destination validation. High, source-only; not exploited.
3. **P3-003 — cart ownership predicate not visible on delete**: submitted cart ID is looked up/deleted without an observable owner condition. High pending runtime authorization context, source-only.
4. **P3-004 — download history identity supplied by request**: `reDownload` uses submitted user/media/type values in lookup. High pending middleware/controller identity context, source-only.
5. **P3-005 — request-derived monetary fields**: checkout uses request/cart values for amount/discount/tax base. High financial-integrity review item, source-only.
6. **P3-006 — state-changing GET admin routes**: destructive/status operations use GET. Medium, verified route design.
7. **P3-007 — provider/maintenance route exposure**: visible routes lack explicit auth middleware in route definitions. High pending deployment controls.
8. **P3-008 — default/trait auth activity behavior**: normal login does not show an explicit inactive-user check; guard/provider/runtime behavior needs verification. Medium, source-only.
9. **P3-009 — test baseline failure**: feature example `/` expects 200 but receives 404. Low/Medium quality finding, tested.

No finding is reported as a confirmed exploit. Runtime verification is required for ownership, database constraints, duplicate callbacks, and deployed endpoint reachability.
