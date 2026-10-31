# Test traceability matrix

Current Phase 2.3: scoped auth/admin/secrecy/payment-state/cross-store fixes verified; financial amount/currency policy remains unresolved. Final suite twice: **251 tests, 229 PASS, 6 FAIL, 16 BLOCKED, 1,419 assertions, zero errors**; separate three real concurrent callback scenarios pass twice. See [current remediation report](17_CRITICAL_REMEDIATION_REPORT.md). Content below is the preserved earlier phase snapshot.

Latest Phase 2.2 mapping: **233 cases / 190 PASS / 27 FAIL / 16 BLOCKED**, 1301 assertions, zero errors. All original 21 failed invariants and 154 passes are preserved; fourteen old engine blockers now pass, two named gates are superseded by actual Product integration cases, and 28 new cases execute. Use the [current 233-scenario mapping](evidence/phase-2.2/test-traceability.csv), [18 original gate decisions](evidence/phase-2.2/coverage-gates.json), [class totals](evidence/phase-2.2/class-results.json) and [real integration report](16_REAL_DATABASE_INTEGRATION_REPORT.md). Earlier Phase 2/2.1 mappings below are preserved snapshots.

Phase 2.1 adds 21 cases: seven passing controls and fourteen unsuppressed invariant failures. Current totals are 207/154 PASS/21 FAIL/32 BLOCKED. Original scenario statuses below are preserved. The [delta mapping](evidence/phase-2.1/test-delta.csv) links every new route/model/helper/test to its expected requirement and actual result; [current results](evidence/phase-2.1/results.json) includes all 207 cases. See [critical investigation](15_CRITICAL_DEFECT_VERIFICATION.md) for the distinction between verified code gaps and conditional reachability/policy. No real-engine/concurrency blocker was cleared.

The complete scenario-level mapping is in [test-traceability.csv](evidence/test-traceability.csv) and [JSON](evidence/test-traceability.json): business flow ? route/controller ? service/model ? test file/scenario ? expected result ? actual execution status and blocker/failure. Statuses come from the final full run, with PHPUnit skipped cases labeled BLOCKED only where verbose output supplies the explicit BLOCKED reason. The two final runs have identical names/statuses.

## All fourteen Phase 1 critical flow groups

| Flow | Route/controller and model/service | Automated boundary coverage | Execution / remaining requirement |
| --- | --- | --- | --- |
| 1. Admin/API auth | /admin/authenticate, /api/login; AdminController/AuthController, guards | AuthRegressionTest | PASS with synthetic SELECT persistence; real DB/account integration BLOCKED |
| 2. JWT | /api/refresh, /api/logout, protected API; JwtMiddleware, JWT manager | JwtRegressionTest; SecurityInvariantTest | PASS crypto/lifecycle/contracts; FAIL missing-header invariant; real persistent blacklist/provider integration BLOCKED |
| 3. Roles/permissions | /admin/*; CheckPermission, PermissionHelper | PermissionRegressionTest | PASS mappings/cached-role middleware; cross-user/SQL ownership BLOCKED |
| 4. SQL/Mongo | PromoCode, Invoice/InvoiceItem, ImageFilterValue | MySqlRegressionTest; MongoRegressionTest | BLOCKED: 14 real-engine cases not enabled; cross-store business partial failure gate BLOCKED |
| 5. Quotations/invoices | Admin/InvoiceController; Common | QuotationRegressionTest, InvoiceDatesRegressionTest | PASS validation/status/date/delegation; create/edit/replace/joins/numbering lifecycle BLOCKED |
| 6. Money/tax | Common pricing and payment-link payload | PricingRegressionTest; PaymentLinkRegressionTest | PASS synthetic arithmetic; actual currency/tax/quantity policy PENDING ACCEPTANCE |
| 7. Gateway callbacks | PaymentController; Razorpay SDK/Atom verifier | PaymentRegressionTest, AtomSignatureTest | PASS signed-link branch/primitive contracts; FAIL financial identity; PayU/Atom/order-plan fulfillment BLOCKED |
| 8. Duplicate payments | razorpayInvoiceResponse; conversion helper | PaymentRegressionTest; PaymentInvariantTest | PASS already-converted sequential delegation guard; FAIL stale paid downgrade; real exactly-once/concurrency BLOCKED |
| 9. PDF | Common, BrowserPdf, Dompdf, CP HTML | PdfEmailRegressionTest | PASS real synthetic Dompdf fallback; Chromium/Browserless/fonts/branded references BLOCKED/PENDING ACCEPTANCE |
| 10. Emails/attachments | SendEmail/SendPlanEmail, Mail builders | PdfEmailRegressionTest | PASS fake recipients/subjects/data/failure propagation; full templates/attachments/worker retry BLOCKED |
| 11. Image/video | Media/admin controllers; Intervention/FFmpeg | SearchMediaRegressionTest | PASS GD resize/invalid image; upload/orientation/watermark/video integration BLOCKED |
| 12. Storage/downloads | MediaController, filesystem, license/history models | SearchMediaRegressionTest | PASS local IO/protocol validation; S3/ownership/history/limits BLOCKED |
| 13. Search/filter | ElasticSearchController, SearchController/FiltersController, ImageFilterValue | SearchMediaRegressionTest; MongoRegressionTest | PASS mocked Elasticsearch query/response/errors; real mappings/filter/product consistency BLOCKED |
| 14. Queue/scheduler | Console/Kernel, QuotationDeactive, jobs, UserPackage | QueueSchedulerRegressionTest; InvoiceDatesRegressionTest; mail tests | PASS dispatch/registration/query/delegation; real retries/credits/duplicate scheduling BLOCKED |

A PASS in this table applies only to the named layer. No mocked persistence result is labeled a real integration pass. ?PENDING ACCEPTANCE? is a policy/reference gap, not a suppressed failed assertion. Eighteen coverage-gate rows explicitly identify work still unimplemented; they do not inflate claims of business coverage.

## Test class execution totals

| Test class | PASS | FAIL | BLOCKED | Scope |
| --- | --- | --- | --- | --- |
| AtomSignatureTest | 2 | 0 | 0 | Characterization/contract |
| ExampleTest | 3 | 0 | 0 | Characterization/contract |
| InvoiceDatesRegressionTest | 10 | 0 | 0 | Characterization/contract |
| IsolationTest | 9 | 0 | 0 | Characterization/contract |
| PaymentLinkRegressionTest | 13 | 0 | 0 | Characterization/contract |
| PermissionRegressionTest | 19 | 0 | 0 | Characterization/contract |
| PricingRegressionTest | 23 | 0 | 0 | Characterization/contract |
| AuthRegressionTest | 9 | 0 | 0 | Characterization/contract |
| JwtRegressionTest | 9 | 0 | 0 | Characterization/contract |
| PaymentRegressionTest | 16 | 0 | 0 | Characterization/contract |
| PdfEmailRegressionTest | 6 | 0 | 0 | Characterization/contract |
| QueueSchedulerRegressionTest | 5 | 0 | 0 | Characterization/contract |
| QuotationRegressionTest | 13 | 0 | 0 | Characterization/contract |
| SearchMediaRegressionTest | 10 | 0 | 0 | Characterization/contract |
| MongoRegressionTest | 0 | 0 | 6 | Real engine; fixture unavailable |
| MySqlRegressionTest | 0 | 0 | 8 | Real engine; fixture unavailable |
| UnavailableFlowsTest | 0 | 0 | 18 | Coverage gates only |
| PaymentInvariantTest | 0 | 4 | 0 | Intended invariants |
| SecurityInvariantTest | 0 | 3 | 0 | Intended invariants |

## Known failure scenarios

See [13_KNOWN_LEGACY_DEFECTS.md](13_KNOWN_LEGACY_DEFECTS.md) for independent intended invariants and current observations. Their seven failed cases remain in the default suite. The complete CSV retains scenario-specific messages, and links test paths to the checked-in assertions/providers for exact expected numeric/status values.
