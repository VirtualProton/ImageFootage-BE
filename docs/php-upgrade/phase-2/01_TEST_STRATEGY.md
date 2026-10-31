# Phase 2 test strategy

Status: **PARTIAL**. Phase 2 was explicitly requested while Phase 1 recovery/deployment gates remain outstanding. Work is limited to tests, fixtures, test-only configuration and documentation. No framework/dependency upgrade, business change, database migration, production access or deployment work is included.

Three layers are intentionally distinguished:

1. **Characterization and contract tests** execute existing calculation helpers, guards, JWT library, controllers, SQL compilation, SDK signature code, templates, jobs and local rendering/storage. Persistence and external services are replaced at explicit boundaries. A PASS means the named layer behaved as asserted, not that the complete workflow is correct.
2. **Business/security invariants** in `tests/KnownFailures` express protection requirements independently of observed behavior. They run in the default full suite and remain visibly failing. Nothing is blanket-skipped to hide a defect. Acceptance of a characterization is not acceptance of these defects.
3. **Real integration tests and coverage gates** require dedicated MySQL/MongoDB and other named fixtures. Fourteen executable database tests are opt-in. Eighteen additional scenarios are explicitly blocked coverage gates, not implemented integration workflows. Mocks are not substituted for SQL engine behavior or real cross-store/concurrent processing.

Run `php tests/run.php --verbose` for the full assessment. The full suite intentionally exits nonzero while invariant failures exist. `--testsuite Unit,Feature` is useful for checking the characterization layer, but its green result must never be presented as complete Phase 2 acceptance. See [execution report](12_TEST_EXECUTION_REPORT.md) and [traceability](11_TEST_TRACEABILITY_MATRIX.md).

Monetary assertions use independently specified synthetic examples and two-decimal string comparison, not an epsilon that can hide a cent difference. Test policy fixes GST at 18% without asserting that every real transaction should use that rate. Quantity semantics, currency conversion, commercial tax policy, branding and full quotation/invoice outputs remain **PENDING ACCEPTANCE**.

Tests control Carbon time, use synthetic identities, restrict database endpoints/principals, and keep caches/files under a new private temporary directory per run. PHP `time()`/`date()` inside legacy code are not monkey-patched: tests avoid asserting their wall-clock values. `Common` explicitly changes PHP timezone to Asia/Kolkata; expiry tests characterize that behavior rather than editing it.

Scope preservation is verified through hashes of application/config/routes/resources/custom templates/manifests/locks/Dockerfile/environment. No production credentials or customer fixtures are copied into test data. Phase 1 documentation/history is preserved. Phase 3 is not started automatically.
