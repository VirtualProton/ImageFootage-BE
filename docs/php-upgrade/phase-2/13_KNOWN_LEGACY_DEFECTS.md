# Known legacy defects and acceptance questions

## Current Phase 2.3 register

| ID | Current status | Evidence / remaining limit |
| --- | --- | --- |
| LEGACY-AUTH-01 | FIXED for application-JWT middleware/local identity | Missing/unknown/malformed/expired/absent-user reject; valid supported header controls pass. Raw-provider-token contract/client exchange remains a compatibility gate. |
| LEGACY-AUTH-02 | FIXED for login and session-status middleware | Correct admins logout and real previously issued session after SQL deactivation pass; API isolation preserved. Remember-cookie lifecycle remains unverified. |
| LEGACY-AUTH-03 | FIXED for demonstrated Eloquent direct/nested/collection paths | User/Admin hidden password/remember_token; User provider/OTP/verification secrets hidden. Raw queries, explicit exposure and error-log inventories are separate limits. |
| LEGACY-PAY-01 | PARTIAL - reference/link fixed; monetary checks OPEN | Fetched/signed/stored identity negatives pass. Six amount/currency invariants still FAIL; authoritative baseline/missing-history policy requires owner decision. |
| LEGACY-PAY-02 | FIXED for recorded Razorpay payment success and ordinary callbacks | Sequential and actual SQL downgrades pass; row-locked concurrent paid/pending/failed controls pass twice. Manual settlement/refunds/crash delivery are not redefined. |
| LEGACY-DATA-01 | FIXED for existing-SQL retry identity | Real BSON failure + valid retry restores SQL product_id/Image; no duplicate on tested sequential retry. No distributed atomicity/first-import concurrency claim. |

Final suite twice: **251 cases, 229 PASS, 6 FAIL, 16 BLOCKED, 1,419 assertions, zero errors**. All original passing scenarios remain passing. Three overlapping callback scenarios pass twice separately. See [root causes, exact changes, approval decisions, compatibility and rollback](17_CRITICAL_REMEDIATION_REPORT.md) and [execution evidence](evidence/phase-2.3/execution-results.json). Phase 2.3 is PARTIAL; no upgrade/deployment/commit/push.

## Historical Phase 2 / 2.1 / 2.2 snapshots

The prior status/authorization/results below describe their original phase, not current acceptance.


Phase 2.2 update: **27 failed invariant cases**, including all original 21, across six defect categories. Real MySQL tests confirm inactive-admin retention and payment financial-identity/downgrade behavior. New **LEGACY-DATA-01**: Product::savePantherMediaImage inserts SQL before Mongo; actual BSON write failure leaves SQL, and retry's updateOrCreate omits product_id/product_main_type when recreating the missing Mongo document. The independent identity invariant fails; no fix is authorized. Reproduction: CrossStoreBusinessIntegrationTest::testRetryMustRestoreCompleteCrossStoreProductIdentity. See [real integration report](16_REAL_DATABASE_INTEGRATION_REPORT.md). Valid sequential converted-payment replay passes for the tested path; concurrent exactly-once effects remain unverified. No live exploitability or provider backward-state behavior is asserted.

Current status: Phase 2.1 preparation is complete; business fixes are not authorized or implemented. The strengthened suite has **207 cases: 154 PASS, 21 FAIL, 32 BLOCKED/skipped, 746 assertions**. All original passing and failing scenarios are preserved. The 21 failures are evidence for the same five IDs, not 21 vulnerabilities. See the [critical investigation and five remediation proposals](15_CRITICAL_DEFECT_VERIFICATION.md) for acceptance requirements, impact limits, approvals and rollback.

The original Phase 2 snapshot had seven default-suite invariant failures across the five IDs below. These execute current application methods using synthetic request, guard and persistence boundaries; no production exposure, attack or real payment state is asserted. Business/security invariants are deliberately separate from passing legacy characterization. No business code was fixed.

| ID | Reproduction / current behavior | Intended invariant | Tests / result |
| --- | --- | --- | --- |
| LEGACY-AUTH-01 | JwtMiddleware handles only specific Login-Type branches; missing header reaches next with no token | JWT-protected middleware must reject an unauthenticated request regardless of optional provider header | SecurityInvariantTest::testMissingLoginTypeMustNotBypassJwtProtection â€” FAIL (200 vs 401) |
| LEGACY-AUTH-02 | AdminController::authenticate authenticates admins, then disabled-user branch calls default Auth::logout; admin guard remains authenticated | Disabled admin cannot retain an authenticated admin session | SecurityInvariantTest::testDisabledAdminMustNotRetainAdminSession â€” FAIL |
| LEGACY-AUTH-03 | User hidden fields are commented; AuthController::me serializes the synthetic user's password hash field | Authentication API must not expose password hashes | SecurityInvariantTest::testAuthenticatedMeResponseMustNotExposePasswordHash â€” FAIL |
| LEGACY-PAY-01 | razorpayInvoiceResponse verifies callback HMAC and fetched paid status but does not compare fetched amount/currency/reference with local invoice | Financial identity must match before marking paid or fulfilling | PaymentInvariantTest::testPaidCallbackMustValidateFinancialIdentity â€” three FAIL cases |
| LEGACY-PAY-02 | Provider-created/pending branch overwrites status to 0 even when local invoice is already paid | Out-of-order pending response must not regress confirmed paid state | PaymentInvariantTest::testOutOfOrderPendingCallbackMustNotDowngradePaidInvoice â€” FAIL |

## Phase 2.1 verification and classification refinements

| ID | Additional verification | Current confidence / outstanding question |
| --- | --- | --- |
| AUTH-01 | Actual `/api/download-proxy` route with missing/unknown/case-variant headers and a valid token for an absent local user reaches controller validation | Verified fail-open boundary; `/api/me` independently denies unauthenticated requests. No universal endpoint/data-access claim |
| AUTH-02 | Actual SessionGuard reloads an inactive account from an existing session and Admin middleware reaches next | Verified inactive-session denial gap in addition to wrong-guard logout. No Admin JWT issuer found; remember-cookie integration remains pending |
| AUTH-03 | Actual direct /api/me plus real nested User/Admin model serialization | Direct User hash-field exposure verified. Nested-model risk verified as a primitive; public nested-Admin route not established |
| PAY-01 | Actual routed signed callback, stricter query fixture, unconverted quotation and mismatched fetched amount/currency/reference each cause write and fulfillment delegation | Verified missing financial binding; provider response is synthetic, not attacker-controlled evidence. Wrong/unknown local reference now correctly matches no row |
| PAY-02 | Explicit successful local payment plus consistently signed/fetched created/pending/expired/cancelled statuses is downgraded | Verified non-monotonic branch; provider backward-state reachability conditional. Original status=1 alone is not proof of settlement |

No original code gap was disproved. Earlier fixture/reachability assumptions were narrowed: CallbackStore now honors selected fields/equality filters; the original paid-versus-created payload was not a realistic-event proof; protected routes can have independent controller auth; nested Admin serialization is not itself proof of a public disclosure endpoint. Exact financial snapshot, partial payments, currencies, completed/reversal policy and social identity mapping need owner decisions.

Do not equate GET callback signature verification with raw-body webhook validation or infer backward fetched states from webhook ordering. All provider/account behavior, concurrent exactly-once effects and real SQL locking remain unverified. The [investigation](15_CRITICAL_DEFECT_VERIFICATION.md) is the canonical current analysis; the original reproduction table above remains historical evidence.

Mitigation/repair decisions are outside Phase 2 and require a separately authorized business/security change. Keep the full suite red until a reviewed fix satisfies these tests; do not change assertions to approve defective behavior or exclude KnownFailures from an acceptance run.

## Observed behavior requiring business acceptance

- API required-field validation returns HTTP 200 and field-error arrays; successful token response exposes `expires_in=21`, while JWT TTL behavior is separately configured/tested. Existing misspelled download fields are preserved. Do not silently reinterpret or rename them.
- Item-subtotal helper sums price entries without multiplying quantity. A fixture documents that fact; approved quantity/price semantics were not provided, so this is PENDING ACCEPTANCE, not automatically a confirmed pricing defect.
- Current CP template contains the fixed company/address and recent creator/client-code logic. No visual/business approval was invented and those files remain unchanged.
- Common changes global timezone to Kolkata; native date/time in business code is not Carbon-frozen. Date-only expiry characterization accounts for that; system timezone/business policy needs approval.
- Sequential callback characterization observes repeated status writes and skips invoice-creator delegation only when persistence reports already-converted. Actual duplicate invoices/payments/notifications under concurrency remain BLOCKED, not proven absent.
- SQL item foreign keys are absent in the initial migration, but live/fixture schema behavior is unverified. Do not claim referential protection without the real integration test.
- Source-only media proxy host/TLS concerns are recorded in the media document; no internal URL probe or network exploit test was executed.

## Baseline and test-development failures

Original feature ExampleTest expected GET / 200 without an unconditional route. Test-only correction now checks the real login page and absent root in the controlled configuration. No application route was added.

Development harness failures were corrected, not relabeled as product defects: PHP 7.4 disabled functions remain discoverable, SDK JSON payload/trailing slash handling, calling the actual UserPackage expiry method, honoring Common's timezone mutation, using one transient Dompdf wrapper and decompressing its saved streams. An empty User fixture without null schema attributes recursively resolved same-named relations and exhausted the 128 MB test process; explicit null attributes corrected the fixture. No memory limit increase or model change was used. Final runs complete without harness errors.

`development-*`, `initial-junit.xml` and early characterization artifacts are historical work logs. Final authoritative outcomes are `evidence/full-run-1.*`, `full-run-2.*` and `execution-results.json`. Do not count corrected harness failures as additional legacy defects or treat early subset counts as the final suite.
