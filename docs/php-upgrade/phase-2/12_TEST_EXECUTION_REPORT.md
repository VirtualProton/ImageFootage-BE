# Test execution report

Current Phase 2.3: scoped auth/admin/secrecy/payment-state/cross-store fixes verified; financial amount/currency policy remains unresolved. Final suite twice: **251 tests, 229 PASS, 6 FAIL, 16 BLOCKED, 1,419 assertions, zero errors**; separate three real concurrent callback scenarios pass twice. See [current remediation report](17_CRITICAL_REMEDIATION_REPORT.md). Content below is the preserved earlier phase snapshot.

Latest execution is **Phase 2.2: 233 cases / 190 PASS / 27 FAIL / 16 BLOCKED via skip / 1301 assertions / zero errors / exit 1** in both full runs (38.8 s and 39.12 s, 166 MB). The full suite is failing. Fourteen previously blocked MySQL/Mongo cases pass; all original 21 known failures remain. Six added failed cases comprise five real-persistence confirmations of prior defects and one new cross-store retry identity invariant. Two gates now have meaningful replacement tests; sixteen remain. [Structured comparison](evidence/phase-2.2/execution-results.json), [run 1](evidence/phase-2.2/full-run-1.txt), [run 2](evidence/phase-2.2/full-run-2.txt), [current report](16_REAL_DATABASE_INTEGRATION_REPORT.md). Prior results below are historical snapshots.

Latest verification: **Phase 2.1 - 207 cases, 154 PASS, 21 FAIL, 32 BLOCKED via PHPUnit skips, 746 assertions, zero errors, exit 1**. All original 147 PASS and seven FAIL cases retain their status; seven new controls pass and fourteen new invariant cases fail. See [verification results](evidence/phase-2.1/results.json), [full output](evidence/phase-2.1/verification-run.txt) and [investigation](15_CRITICAL_DEFECT_VERIFICATION.md). No production code was changed. The 32 fixture/integration blockers are unchanged. The execution snapshot below is the preserved original Phase 2 baseline, not the latest count.

Final status: **PARTIAL**. Executed twice on 29 October 2026, local PHP **7.4.33**, Laravel **5.8.38**, PHPUnit **7.5.20** on Windows. No versions or dependencies changed.

| Metric | Run 1 | Run 2 |
| --- | --- | --- |
| Total PHPUnit cases | 186 | 186 |
| PASS | 147 | 147 |
| FAIL | 7 | 7 |
| Errors | 0 | 0 |
| PHPUnit skipped | 32 | 32 |
| Skipped cases with explicit BLOCKED reason | 32 | 32 |
| Other SKIPPED | 0 | 0 |
| Assertions | 560 | 560 |
| Wall time including runner | 4.609 s | 4.422 s |
| Exit status | 1 | 1 |

Commands:

```powershell
php tests/run.php --verbose --log-junit docs/php-upgrade/phase-2/evidence/full-run-1.xml
php tests/run.php --verbose --log-junit docs/php-upgrade/phase-2/evidence/full-run-2.xml
```

Evidence: [structured execution results](evidence/execution-results.json), [run 1 output](evidence/full-run-1.txt), [run 2 output](evidence/full-run-2.txt), [run 1 JUnit](evidence/full-run-1.xml), [run 2 JUnit](evidence/full-run-2.xml). Names/statuses match across runs; varying durations, JWT identifiers, password hashes and PDF metadata are not compared byte-for-byte. These timings are not a benchmark.

## Interpretation

The 147 PASS cases are helper/contract/local-library tests, including a retained trivial unit example. Seven unsuppressed FAIL cases are in KnownFailures (five defect IDs). Thirty-two PHPUnit skips are operationally BLOCKED: 8 real MySQL tests, 6 real MongoDB tests, and 18 explicit unimplemented critical-flow/acceptance gates. The gates are transparent missing coverage, not implemented business tests or integration successes. No risky/incomplete/error result was relabeled as PASS.

No dedicated SQL/Mongo service/credentials/schema fixture was provided or enabled; therefore no database integration write or cleanup ran. Real Elasticsearch, S3, queue workers, concurrent callbacks, Browserless, Chromium processes, FFmpeg, PayU/Atom/order-plan end-to-end fulfillment and full business artifact generation were not exercised. Host FFmpeg was found but is intentionally process-blocked.

## Safety verification

[Six negative/environment guard checks](evidence/safety-checks.json) passed: direct PHPUnit refused; unsafe DB host refused; enabled DB without password refused; explicit bootstrap override refused; attached -c override refused; inherited production-like APP/DB variables discarded while isolated environment assertions passed. No real secret values are included.

Production paths, environment, manifests, lockfiles and business/custom-template source are checked by hashes in [integrity verification](evidence/integrity-verification.json). Test-source PHP lint and XML/JSON/document link checks are recorded there. No production, deployment or Phase 3 work was done.

Historical initial/development outputs record corrected harness errors; they are not final acceptance results. See the development notes in [known defects](13_KNOWN_LEGACY_DEFECTS.md). Remaining fixture setup is documented in [02_TEST_ENVIRONMENT.md](02_TEST_ENVIRONMENT.md).
