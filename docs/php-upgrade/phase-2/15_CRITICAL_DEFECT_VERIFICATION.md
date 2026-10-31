# Phase 2.1 - critical defect verification and remediation preparation

Current Phase 2.3: scoped auth/admin/secrecy/payment-state/cross-store fixes verified; financial amount/currency policy remains unresolved. Final suite twice: **251 tests, 229 PASS, 6 FAIL, 16 BLOCKED, 1,419 assertions, zero errors**; separate three real concurrent callback scenarios pass twice. See [current remediation report](17_CRITICAL_REMEDIATION_REPORT.md). Content below is the preserved earlier phase snapshot.

Date: 29 October 2026. **Preparation complete within the authorized scope. No application fix is implemented or approved.** Overall Phase 2 remains PARTIAL because real-engine, concurrency and acceptance gates remain open. PHP 7.4.33, Laravel 5.8.38 and dependencies are unchanged. No production, Coolify, deployment or Phase 3 work occurred.

## Evidence and interpretation

All original seven invariant cases were reproduced before test changes: 7 cases, 56 assertions, seven failures. Test-only changes then improved evidence fidelity and added 21 cases. The full suite now reports **207 cases: 154 PASS, 21 FAIL, 32 BLOCKED via PHPUnit skips, 746 assertions, zero errors, exit 1**. All original 147 passing cases remain PASS, all original seven failures remain FAIL, and all 32 blockers remain skipped. Fourteen additional failed assertions expand evidence for the same findings; they are not fourteen additional vulnerabilities.

Reproduce safely:

```powershell
php tests/run.php --testsuite KnownFailures --verbose
php tests/run.php --verbose --log-junit docs/php-upgrade/phase-2/evidence/phase-2.1/verification-run.xml
```

See [original reproduction](evidence/phase-2.1/original-findings.txt), [full output](evidence/phase-2.1/verification-run.txt), [structured results and baseline comparison](evidence/phase-2.1/results.json), [source locations](evidence/phase-2.1/source-evidence.json) and [test delta traceability](evidence/phase-2.1/test-delta.csv).

External credentials, mail, queues, gateways and native processes retain the existing isolation controls. Request routing, middleware, guards, bcrypt, JWT signing/decoding, Eloquent serialization, callback HMAC and controller decisions execute without replacement. DB rows and outgoing SDK fetches are synthetic boundaries. Invoice creation is a side-effect observation sink, not an emulated financial validator. No test mocks the decision it is asserting.

CallbackStore previously ignored row predicates and SELECT projections. It now respects explicit equality predicates, selected columns and no-match writes, and rejects unconfigured tables/operators. A control verifies this. It remains a one-row fixture, not SQL, transaction, uniqueness, race or locking evidence. Production source was not corrected to satisfy tests.

## Findings at a glance

| Finding | Verified scope and impact | Confidence limitation |
| --- | --- | --- |
| LEGACY-AUTH-01 | Missing/unknown header and a valid token with missing local identity can reach an actual jwt.verify-protected controller without authentication | Not every API route is bypassed; controller-level auth can still deny. No customer data access demonstrated |
| LEGACY-AUTH-02 | Disabled login leaves admins authenticated; an existing session loading an inactive row passes Admin middleware | Synthetic persistence, real guard/middleware; no production session inspection. Admin JWT issuance not found |
| LEGACY-AUTH-03 | Actual authenticated /api/me includes a password field; loaded nested User/Admin models serialize password fields | Nested serialization demonstrated, but a public nested-Admin route is not established; no real hash exposed |
| LEGACY-PAY-01 | Valid signed callback with a fetched amount/currency/reference mismatch still writes paid state and delegates invoice creation | SDK response is synthetic. No evidence an attacker can control a real authenticated provider response |
| LEGACY-PAY-02 | A consistently signed/fetched unpaid/failed response overwrites explicitly completed local payment state | Non-monotonic branch verified; provider backward-state reachability and manual-payment reconciliation policy are unverified |

## AUTH-01 - authentication fall-through

**Path:** `routes/api.php:190` jwt.verify group -> `app/Http/Kernel.php:jwt.verify` -> `JwtMiddleware::handle` (23-114) -> `/api/download-proxy` -> `MediaController::downloadProxy`. The actual route returns 400 for a missing URL when no Login-Type or an unknown/case-variant value is supplied; it should first reject an unauthenticated protected request. The same route with `Login-Type: normal` and no token returns 401. No URL is fetched.

**Root cause:** recognized header values enter selected authentication branches; unrecognized/missing values fall through to `$next`. The normal branch also does not require a truthy local identity after authenticate returns. A correctly signed synthetic token for a nonexistent local subject reaches the same controller. Cryptographic validity alone is insufficient authentication.

**Validity and impact:** the rejection invariant is valid for a route explicitly marked jwt.verify. Passing the middleware is an authorization-boundary failure, but downstream consequences depend on the controller and data checks. `/api/me`, in the public route group, remains protected by `AuthController`'s separate `auth:api` middleware and returns 401 without a token. No claim of universal API bypass, account takeover, cross-user download or live exposure is made.

**Smallest viable proposal:** change `app/Http/Middleware/JwtMiddleware.php::handle` only initially: dispatch recognized authentication modes explicitly, reject unsupported modes, and call next only after an existing valid local identity is established. Missing Login-Type may default to local JWT verification to preserve legitimate bearer clients, but must never mean anonymous access. Require the JWT authenticate result to be an actual identity. Keep current normal invalid/expired error shapes where safe.

**Compatibility / decisions:** confirm whether valid JWT clients omit the header or use uppercase values; decide normalization versus rejection. Verify how Google/Facebook identities map to local users before changing those branches; current fallback validation is not proof of a bound local identity. Do not silently remove social login or allow a verified external token to authorize an unrelated local account. Protected-route denial is required; exact unknown-mode status/body and social identity mapping need owner acceptance.

**Regression/rollback:** existing JwtRegressionTest/AuthRegressionTest plus real-route/missing-identity cases and new controls must run. Add valid local JWT with omitted header and social adapter contract tests when policy is approved, using fake provider responses. Rollback must not reintroduce anonymous fall-through; use a reviewed forward correction/temporary route restriction if necessary. No operational rollback action is performed here.

## AUTH-02 - inactive administrator guard/session retention

**Path:** POST `/admin/authenticate` (`routes/web.php:459`) -> `AdminController::authenticate` (24-44) -> `Auth::guard('admins')->attempt` -> inactive branch calling unqualified `Auth::logout`. Default guard is **api**, backed by User; the authenticated admin uses **admins**, backed by Admin (`config/auth.php:17,43-50,75-77`). Protected admin groups apply Admin then CheckPermission (`routes/web.php:469`).

**Root causes:** (1) wrong guard logout after an inactive admin authenticates, leaving the admin session; (2) `app/Http/Middleware/Admin.php::handle` checks only `admins->check()`, not account status. CheckPermission likewise does not add an inactive-account check. Fixing only the login branch does not handle an account disabled after its session was issued.

**Verification:** original actual login test still fails. A new test seeds the authentic admins session key, lets the actual SessionGuard/Eloquent provider load an `admin_status=I` fixture and calls the real Admin middleware. It reaches next (200) instead of denying. Baseline schema defines A/I, and the controller explicitly treats I as unauthorized. The denial invariant is valid; exact session invalidation UX is separate policy.

**Smallest viable proposal:** in `AdminController::authenticate`, explicitly log out the admins guard on inactive rejection. In `Admin::handle`, resolve the current admin and deny/revoke its guard session when the current row is inactive. Preserve existing enabled-admin login, guest redirect and success session behavior. A middleware check on every protected request is necessary for already-issued sessions/remember cookies; do not trust a status captured at login.

**Compatibility / token scope:** Admin does not implement JWTSubject and the configured API provider uses User, not Admin. No admin JWT issuer was found; do not invent or claim a demonstrated admin-token revocation failure. If other clients map admin privileges onto User JWTs, identify that path first and require an active-account check there too. Confirm HTML redirect/flash versus JSON denial contract. Avoid globally flushing unrelated guards/cart state without approval; rotating session/CSRF or revoking other sessions must be explicitly scoped.

**Regression/rollback:** test active/wrong-password/inactive login, current disabled session, remembered session and post-disable next request on real isolated persistence. Keep existing login/logout/guard-separation passes. Rollback must not restore inactive-account access; isolate any session UX compatibility issue from the active-status check.

## AUTH-03 - password fields in serialization

**Path:** POST `/api/me` (`routes/api.php:118`) -> controller `auth:api` -> `AuthController::me` (307-309) -> `response()->json(auth()->user())` -> Eloquent User serialization. `app/Models/User.php` has commented `$hidden` blocks (26,74); the actual model has no password hiding. `app/Models/Admin.php` also lacks secret hiding.

**Verification:** a valid synthetic JWT and actual route produce a password field from the provider fixture. New model-boundary tests attach a User or Admin as a loaded relation to an Invoice and JSON-serialize the enclosing response; nested password fields remain visible. These tests use the actual models/serializer, not preconstructed output arrays. A public endpoint serving the nested Admin example has not been established; its result is a serialization risk, not an additional confirmed public disclosure endpoint.

**Validity and impact:** passwords/hashes and remember tokens are not public profile data. Disclosure of a hash can increase offline credential-guessing risk, but no real hash, credential recovery or account compromise was demonstrated. The original route exposure is confirmed in the synthetic request. Do not classify every field or relation as sensitive merely because it appears in a model.

**Smallest viable proposal:** declare `password` and `remember_token` hidden in User and Admin, then audit direct/nested public serialization. Hiding affects array/JSON output; it does not remove the stored value or prevent the auth provider reading it for bcrypt. Use explicit allowed response fields where query-builder arrays/manual raw attributes bypass model hiding. Do not assume those additional paths are fixed by `$hidden` alone. Inspect other identity models/raw returns before certifying the public-API-wide requirement.

**Compatibility / decisions:** safe identity fields and existing JWT/login field names must remain. Removing secret response fields is an intentional security-related contract change and must be accepted by the API owner; legitimate clients must not depend on them. Audit admin exports/UI that call toArray and any use of makeVisible/raw attributes. Nested Admin routing remains PENDING verification, not a reason to weaken model-level secret exclusion.

**Regression/rollback:** original /api/me failure, both nested model cases, valid non-secret identity control and auth/JWT passes. Future tests must recursively scan representative public nested responses for password/remember-token fields and synthetic secret values, while allowing unrelated noncredential fields. Rollback must not restore public secret fields to solve an unrelated UI issue.

## PAY-01 - financial identity is not bound to fulfillment

**Path:** public GET `/api/razorpayInvoiceResponse` (`routes/api.php:164`) -> `PaymentController::razorpayInvoiceResponse` (1615-1723) -> SDK Utility::verifyPaymentSignature (1639) -> authenticated SDK paymentLink fetch (1644) -> invoice lookup by reference stripped to invoice_name -> paid update -> `finalizePaidQuotationOrInvoice` (1175+) -> Common invoice creator.

**Root cause:** signature verification is present and is not itself bypassed. The application trusts fetched `status=paid` without comparing fetched amount/currency/reference, binding the returned/stored link ID to the expected local attempt, or selecting expected financial values (lookup selects id/status/proforma_type/cancelled_on only). Successful HMAC establishes callback authenticity, not local financial consistency.

**Verification:** all three original cases remain red with the stricter query fixture. New cases use an unconverted quotation, matching link ID, actual GET route and real SDK HMAC, then change only fetched amount, currency or reference. Each writes paid state and delegates invoice creation; the test records both effects without mocking validation. Controls show matching values delegate normally, bad signature causes no fetch/write/delegation, and an unknown local reference matches no invoice/write. Arbitrary rows are no longer returned by the fixture.

**Validity and impact:** financial binding before fulfillment is a valid invariant. Potential impact is incorrect reconciliation/fulfillment if local and provider identities diverge, including stale/replaced payment attempts. A synthetic provider response is not proof an external caller can forge or manipulate a real authenticated fetch; no free-purchase exploit or real loss was demonstrated.

**Smallest viable proposal:** keep the existing SDK signature check. Load the expected local attempt/invoice, its persisted link ID/reference and expected amount/currency; validate required callback and fetched IDs/fields against that record before any status write or fulfillment. Reject or quarantine missing/mismatched financial identity. Use validated integer minor units from an approved expected transaction snapshot; avoid float equality and silent currency/default-reference fallbacks. Keep the current signin redirect if compatible, while recording a safe rejection/reconciliation reason. Do not add user JWT auth to a provider callback as a substitute for financial binding.

`Common::persistRazorpayPaymentLinkMetadata` (254) already stores link metadata in payment_response, but callback processing overwrites that field. Verify that an immutable expected snapshot exists before selecting it as authority. Do not blindly compare an old link against a newly edited invoice total or assume every currency uses two decimal subunits. No new table/column/dependency is authorized in this phase; if immutable attempt identity cannot be safely represented by existing data, return for a separate design/schema approval.

**Owner decisions required:** authoritative amount at link creation versus edited invoice, supported currencies/minor units/rounding, full versus partial amount_paid, refunds/overpayments, replaced/expired links, missing historical metadata and safe reconciliation of already-accepted mismatches. The test's INR 118.00/11800 example is synthetic policy, not universal currency guidance. Fail-closed mismatches must not fulfill while these decisions are pending.

**Regression/rollback:** existing real-signature controls, all six mismatch cases, matched route, no local record and no-write/no-delegation assertions; add real SQL/attempt persistence/partial payment fixtures. A production correction changes previously accepted bad callbacks; update those characterization fixtures only in the authorized remediation change, preserving legitimate callback structure. Reverting validation can reaccept mismatches; prefer forward repair/quarantine rather than historical database restore. No refunds, reconciliation writes or rollback are performed here.

## PAY-02 - completed payment can be downgraded

**Path:** same callback -> branches at 1687 and 1697 -> unconditional UPDATE by invoice_name to Pending/status 0 or Failed/status 3. Terminal local completion is not checked/locked before these writes. `finalizePaidQuotationOrInvoice` has an already-converted guard for invoice creation, but that does not protect the earlier status transition.

**Fixture correction/uncertainty:** the original test uses local status 1 and a signed paid callback with fetched created state. Initial schema labels status 1 as approved, so status 1 alone is not independent proof of financial settlement, and that input does not prove a provider sends backward states. The new four cases explicitly set local payment_status `Transction Success`, status 1, converted invoice metadata and consistently signed/fetched created/pending/expired/cancelled statuses. They still overwrite completed local state. The original failed case remains visible, with its evidential limitation documented.

**Classification:** verified missing monotonic-state protection under a local-completed/provider-nonpaid conflict. Reachability in the real provider lifecycle, old/replaced links or manual/offline settlement is conditional and requires owner/provider integration evidence. Do not equate this GET browser callback with a webhook or claim webhook reordering proves a freshly fetched link regresses.

**Smallest viable proposal:** after signature and financial identity validation, read/recheck the approved completed-payment state in a transaction/row lock before writing. Ignore/quarantine pending/failed responses for a legitimately completed attempt; preserve successful financial fields and existing fulfillment. A duplicate confirmed success should not repeat business effects. Treat refunds/reversals as a distinct explicitly authorized business path, not as an unsigned/ordinary pending downgrade. Use a conditional write as an additional concurrency guard when appropriate.

**Owner decisions required:** define financial completion using payment/attempt fields, not conversion metadata or status 1 alone; decide how manual payments, reopened invoices, refunds/disputes and replaced links reconcile. State precedence and audit/notification behavior must be accepted. The general no-downgrade invariant is fixed; legitimate reversal policy is not guessed.

**Regression/rollback:** all existing/new nonpaid conflict cases, matched paid and retry controls, legacy paid/pending mappings for genuinely unsettled attempts. Real two-connection tests must prove the guard survives concurrent callbacks. Preventing a downgrade alone does not guarantee one invoice/payment/email; the existing read-then-create conversion is not an exactly-once proof. Scope any durable idempotency/outbox/uniqueness design separately if existing schema cannot guarantee it. Rollback must preserve completed-state integrity and reconcile forward writes, never overwrite new payments with an old database.

## Acceptance requirements and approval gates

| Requirement | Acceptance evidence required | Decision boundary |
| --- | --- | --- |
| No Login-Type bypass | Missing/unknown headers and absent local identity cannot reach protected next; valid supported auth retains safe response contracts | Unknown-mode body/case policy and social identity mapping need API owner acceptance |
| Inactive admin denied | Inactive login and previously issued/remembered session cannot pass protected access after status change | Session UX/invalidation scope; establish any separate admin-token path first |
| No serialized secrets | Direct /api/me and representative nested identity output exclude password/hash/remember-token fields and values | Accept secret-field removal; inventory raw-array/other identity-model paths |
| Callback authenticity | Missing/invalid HMAC produces no fetch/financial mutation/fulfillment; correct HMAC alone does not fulfill mismatched data | Preserve callback versus webhook signing contracts |
| Financial identity match | Expected stored link/reference/currency/integer amount and fetched identity match before status/fulfillment | Snapshot, currency, partial payment and legacy-metadata policies |
| Monotonic completion | Legitimately completed attempt cannot be overwritten by ordinary pending/failed callback | Explicit completed/reversal/manual-payment definitions |
| Duplicate effects prevented | Replays/concurrency create no extra payment/invoice/notification/fulfillment or second business transition | Real DB/two-process/outbox evidence; currently BLOCKED |
| Invalid callback cannot fulfill | Real-route negative controls record zero payment writes and zero creator delegation | Mocked creator is not actual SQL/notification delivery proof |

**Implementation approval is not present.** The user's Phase 2.1 instruction explicitly limits authorization to investigation, test corrections and preparation. It says: "Do not modify production business logic without explicit authorization for those fixes." Phase 2.2 should explicitly name the approved AUTH and PAY changes and resolve the policy cells above. This document is the concrete proposal to review; no permission question or production action is needed to finish preparation.

For future review, split AUTH-01, AUTH-02, AUTH-03 and coordinated PAY-01/PAY-02 corrections into small reviewable changes. Do not bundle a PHP/Laravel upgrade, schema design, UI rewrite, deployment or secret rotation. A payment guard fix and complete exactly-once fulfillment may need separate scopes. Existing 147 passing tests were preserved here; future security fixes can intentionally alter unsafe legacy characterizations only with explicit expected-contract updates and rationale.

## Provider references and remaining blockers

Only public documentation was read; no payment API/dashboard/account was contacted. Razorpay's [callback guide](https://raw.githubusercontent.com/razorpay/markdown-docs/master/payments/payment-links/apis.md) describes the callback fields, HMAC input and storing link identity against the local order. Its [webhook validation guide](https://razorpay.com/docs/webhooks/validate-test/) documents duplicate/out-of-order webhook handling and a distinct raw-body signature contract. Those webhook properties do not establish the reachability of an unpaid response in this GET callback. Local installed SDK Utility code is the direct evidence for this application's signature verification.

The 32 existing integration/acceptance gates are unchanged: 14 real MySQL/MongoDB tests without approved fixtures, plus 18 named workflow/renderer/provider/storage/search/worker/concurrency/policy gates. Real SQL row locks, exact duplicate financial/notification effects, real provider state semantics, remembered sessions and the full public nested serialization inventory remain unverified. Phase 1 runtime/restore gates stay deferred. See [test environment](02_TEST_ENVIRONMENT.md) and [traceability](11_TEST_TRACEABILITY_MATRIX.md).

Phase 2.2 next steps: obtain explicit scoped remediation authorization and policy decisions; prepare verified empty synthetic SQL fixtures and missing provider/identity contracts; implement the smallest approved guards/model secrecy changes; retain every failed invariant until the corresponding correction passes; run the full suite plus real integration tests. No Phase 3 or deployment starts automatically.

Final integrity checks: all **437 protected application/environment/build/dependency/upgrade-plan files** are unchanged; all **36 test PHP files** pass syntax lint; PHPUnit XML and evidence JSON parse; Phase 2 relative documentation links resolve. The only previously existing test file changed in Phase 2.1 is CallbackStore; three verification/control test files were added. See [integrity evidence](evidence/phase-2.1/integrity-verification.json). Previous uncommitted Phase 1/2 work remains preserved; nothing was committed or pushed.
