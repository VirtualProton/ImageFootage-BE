# Project progress

## 2026-10-29 — Phase 1: baseline, recovery, and compatibility audit

Status: **PARTIAL — local audit finished; Phase 1 acceptance NOT complete**. Preparation only; no runtime, dependency, schema, API, or business logic changes were made. Work stops at Phase 1.

- [x] Read the complete Phase 1 request and current upgrade plan.
- [x] Verify initial Git status: clean; existing quotation changes are preserved in commit `a461926a4`.
- [x] Confirm user-reported deployment: Coolify using the existing Dockerfile. Live settings remain unverified.
- [x] Repository structure inspected: 60 controller files, 65 model files, 3 jobs, 5 command files, 165 migrations; source inventory excludes vendor assets.
- [x] Local runtime and locked dependency inventory captured; production inventory remains PENDING.
- [x] Safe baseline diagnostics and local build/test assessment; clean Docker build remains BLOCKED locally.
- [x] Compatibility matrix covering all 29 direct PHP and 12 direct frontend packages, target candidate declarations, current intermediate constraints and unresolved replacements.
- [x] Critical business flow inventory and coverage gaps across 14 flow groups.
- [x] Coolify staging isolation plan documented; live provisioning/isolation verification PENDING.
- [x] Backup/restore and rollback procedures documented with exact commands and safety boundaries.
- [ ] Actual backup retrieval, decryption, restore rehearsal and application-read verification: PENDING operator access and disposable targets.
- [x] Risk register and final Phase 1 report.
- [x] All ten requested documents, supporting evidence and final integrity verification created.

Current findings: PHP CLI 7.4.33, Laravel lock version 5.8.38, Docker PHP 7.4.33/Node 14.21.3. Production runtime and recovery have not been verified. Only example tests were found in the initial inspection.

Interim verification: Composer 2.2.25; local Node 24.12.0/npm 11.6.2; MongoDB PHP extension 1.16.2; Docker CLI unavailable. `composer validate --no-check-publish` and `composer check-platform-reqs` passed with plugins/scripts disabled. Installed vendor metadata matches all 160 locked PHP packages (125 runtime, 35 development). PHP lint passed for 413 PHP files. `composer audit` is unavailable on this Composer; a read-only Packagist advisory query with Composer Semver filtering matched 77 advisory/package records across 21 locked packages. Full advisory details and limitations will be documented. PHP 8.5/Laravel 13 prohibits diagnostics completed and report blockers; exit zero does not indicate target compatibility.

Additional findings: local Vue 2.7.14 differs from locked 2.7.16; AngularJS is locked but missing locally. Docker Node 14 and the v3 npm lockfile need a clean-build check. Credential-like literals/defaults occur in tracked configuration; values are withheld. Isolation must also cover SMS, Atom payments, external media APIs, Browserless, S3, and Elasticsearch, beyond email/Razorpay/PayU.

Files created: root `progress.md`; all ten documents under `docs/php-upgrade/phase-1/` (`01_BASELINE.md` through `10_PHASE_1_REPORT.md`); supporting `evidence/` containing hashes, command results, route inventory, dependency metadata/inventory, matched advisories, npm audit and integrity verification. Existing UPGRADE_PLAN.md, application code, Dockerfile and dependency manifests/locks were not modified.

Safety: no production connections, migrations, payment requests, mail delivery, or scheduled jobs run. `.env` values must not appear in audit output. Application bootstrap and frontend build safety are being assessed before execution.

## Final executed checks and results

- PASS: Composer validation and installed-platform requirements, with scripts/plugins disabled; installed metadata matches all 160 locked PHP packages.
- PASS: PHP 7.4 syntax lint for 413 first-party PHP files.
- PASS: isolated Laravel version (5.8.38) and route inspection; no route handlers invoked by enumeration.
- FAIL (existing baseline suite under disposable settings): PHPUnit 7.5.20, 2 tests/2 assertions, 1 passed and 1 failed. Feature ExampleTest GET / expects 200 and receives 404 with repository-default log path. No business regression tests exist.
- FAIL (existing frontend build on local Node 24.12.0): npm run production reports webpack ERR_OSSL_EVP_UNSUPPORTED. Build ran in a temporary copy; original assets/lockfiles were untouched.
- SECURITY FINDINGS: lock-only npm audit exit 1, 127 vulnerable package entries (6 low, 67 moderate, 47 high, 7 critical). Public PHP advisory fallback matched 77 records across 21 locked packages; applicability/exposure is not verified.
- DIAGNOSTICS: both Composer prohibits commands ran and printed target blockers. Exit 0 means diagnostic completion, not compatibility.
- BLOCKED: native Composer audit not defined in Composer 2.2.25; no Composer upgrade done. Docker CLI unavailable; no clean image build or production runtime verification done.
- PASS: all protected SHA-256 hashes unchanged (composer.json/lock, package.json/lock, Dockerfile, Common.php, custom quotation HTML); no tracked-file modifications from the audit. All new files are scoped to docs/php-upgrade/phase-1 and progress.md. All audit JSON parsed, direct dependencies are represented, ten requested documents exist and relative documentation links resolve.

Temporary harness attempts with an unsupported PHPUnit option and a malformed inventory/version command were corrected without application changes. The final successful diagnostics/failures above are the authoritative results; no failed check was silently fixed.

## Remaining manual Coolify/operations actions

1. Run the read-only production inventory in 03_RUNTIME_INVENTORY.md: actual image/runtime/service versions, mounts, network, active deploy hooks and worker/scheduler launchers. Share sanitized evidence only.
2. Privately review credential-like config defaults and tracked environment-like files entering the Docker context. Prove safe builder/image access and notification/provider egress isolation before staging deployment; scope any remediation separately.
3. Build baseline commit a461926a4 on a trusted isolated Docker builder without production variables/volumes; retain image digests and clean build results.
4. Provision independent staging application/domain/MySQL/MongoDB/Redis/search/storage and sandbox/sink integrations; keep workers, schedules, SQL events and cron-like endpoints disabled until validated.
5. Agree RPO/RTO and cross-store consistency; retrieve/decrypt and restore SQL/Mongo/media backups into disposable resources; verify indexes, relationships, encrypted fields, file checksums and application reads. Record actual durations/results and operator approval.
6. Repeat native lock audit using approved audit-capable tooling and triage advisories. Confirm unsupported wrapper replacement and target/bridge package feasibility before implementation.

## Risks, acceptance and next phase

Principal risks: unsupported current stack; Payumoney/CKEditor/HTML wrapper blockers; MongoDB id/query/driver changes; payment replay/concurrency and fulfillment coupling; sparse/failing baseline tests; frontend drift/build failure; credential-like defaults/build-context inclusion; unverified persistent storage/backups; unknown live service versions and task launchers. See 09_RISK_REGISTER.md for evidence, gates and proposed owners.

Acceptance: **PARTIAL / NOT ACCEPTED AS COMPLETE**. Live production inventory, clean Docker reproduction, staging isolation and a successful restore rehearsal remain unverified. A written runbook does not satisfy recovery verification. No production changes or Phase 2 work were performed, and no audit commit/push was made.

Recommended Phase 2 starting point, only after Phase 1 acceptance and explicit authorization: characterize unchanged-baseline authentication/data flows and quotation → sandbox payment → invoice → PDF/email behavior, including duplicate/concurrent callbacks, expiry, taxes and rounding, using isolated sanitized fixtures. Then implement reviewable per-major upgrades using the compatibility matrix.

## 2026-10-29 — Phase 2: business regression testing

Status: **PARTIAL — implementation and local assessment finished; acceptance incomplete**, explicitly requested by the user despite the outstanding Phase 1 operational gates. Coolify, production inventory, staging deployment and recovery tasks above remain deferred and unverified.

- [x] Read the Phase 2 request, Phase 1 documents, upgrade plan, existing tests and dependency baseline.
- [x] Preserve existing Phase 1 documentation and progress. Capture hashes of application/config/routes/resources/custom templates/manifests/locks/Dockerfile and the environment file without recording contents.
- [x] Fail-closed test runner, environment validation, temporary storage and external-service isolation; six safety checks passed.
- [x] Evidence-based replacement for obsolete root status example using existing login/absent-root routes.
- [x] Authentication/JWT/permissions contract tests and three failing security invariants; real SQL/ownership coverage still blocked.
- [x] Real MySQL/MongoDB test bodies implemented, with explicit infrastructure blockers; none were falsely marked executed.
- [x] Quotation/invoice/pricing/payment characterization and separate invariant failures; full lifecycle/concurrency/policy gaps documented.
- [x] PDF/email/media/storage/search/queue/scheduler boundary tests and explicit remaining integration/acceptance gates.
- [x] All fourteen requested documents, scenario traceability, repeated full-run results and known-defect report.
- [ ] Execute real MySQL/MongoDB tests on verified empty dedicated fixtures.
- [ ] Implement/execute the eighteen blocked full-workflow/integration/acceptance gates.
- [ ] Obtain business acceptance for quantity/currency/tax policy and branded artifact outputs; separately authorize known-defect repairs.

No PHP/Laravel/dependency upgrade, production configuration change, schema migration or business-logic change is authorized or planned. Tests must never load real environment credentials or make real gateway/mail/SMS calls. Critical infrastructure and acceptance gaps will keep Phase 2 PARTIAL.

Phase 2 interim results: fail-closed runner and temporary application environment implemented; external PHP network/process functions disabled before bootstrap, HTTP/FTP wrappers removed, mail/queue/SMS/search boundaries faked, and Razorpay SDK transport replaced with an in-memory expectation queue. Existing root example replaced by tests for the real /admin/login route and the deliberately absent root under isolated log-route configuration.

Implemented characterization/feature tests for admin/API auth and JWT lifecycle, permissions, quotation validation/status/cancellation, pricing/GST/discounts, payment-link creation/signatures/callback states/replays, Atom signatures, actual Dompdf fallback with synthetic multi-page HTML, mail jobs, local storage/image library, search controller and expiry/scheduling/dispatch. Added executable opt-in real MySQL/MongoDB tests with strict loopback-only identity/empty-fixture guards. No SQLite substitution is used.

Development full run: **184 tests, 145 PASS, 7 FAIL, 32 SKIPPED/BLOCKED, 540 assertions**, about 5 seconds on local PHP 7.4.33/PHPUnit 7.5.20. Seven deliberately unsuppressed failures represent five defect IDs: missing Login-Type bypasses JWT middleware; disabled admin remains authenticated; /api/me exposes password hash field; signed link callbacks do not compare amount/currency/reference (three cases); stale pending callback downgrades paid status. These are reproduced against synthetic boundary fixtures, not claims about live exploitability. Real persistence/concurrency/renderer/acceptance coverage remains blocked or pending as individually recorded.

Test-harness corrections during development included PHP 7.4 disabled-function semantics, SDK JSON/trailing-slash handling, actual UserPackage method naming, Common's explicit Kolkata timezone side effect, and Dompdf compressed output parsing. An empty User fixture initially triggered recursive same-named relationships; explicitly null schema attributes fixed the fixture without modifying User or business logic. Final validation and fourteen Phase 2 documents are in progress. Phase 1 operational gates remain deferred.

### Final Phase 2 results and delivered files

Two final full runs on 29 October 2026 used:

```text
php tests/run.php --verbose --log-junit docs/php-upgrade/phase-2/evidence/full-run-1.xml
php tests/run.php --verbose --log-junit docs/php-upgrade/phase-2/evidence/full-run-2.xml
```

Both: **186 cases, 147 PASS, 7 FAIL, 32 PHPUnit skips with explicit BLOCKED reasons, 560 assertions, zero errors; exit 1**. Run durations including the runner: 4.609 s and 4.422 s. Names/statuses match. The 32 blocked cases consist of 8 real MySQL tests, 6 real MongoDB tests and 18 explicit coverage gates; the latter are missing coverage, not implemented business tests. KnownFailures remains included in the default run. Development 184-case/subset counts above are historical checkpoints, not final acceptance evidence.

Six safety checks passed: refuse direct PHPUnit; refuse unsafe MySQL host; refuse enabled DB without test password; refuse bootstrap override; refuse attached -c configuration override; discard inherited production-like variables while safe environment assertions pass. No live endpoint was probed.

Modified only existing test files `phpunit.xml`, `tests/CreatesApplication.php`, `tests/TestCase.php`, `tests/Feature/ExampleTest.php`, plus this progress history. Added runner/bootstrap/support helpers, six Unit, seven Feature, three Integration and two KnownFailures files, and one synthetic HTML fixture. Created fourteen Phase 2 documents and structured/raw execution, safety, traceability and integrity evidence under docs/php-upgrade/phase-2. Earlier Phase 1 files are preserved.

Confirmed synthetic-boundary defects remain: LEGACY-AUTH-01 missing Login-Type bypass; AUTH-02 disabled admin guard retention; AUTH-03 password-hash field exposure; LEGACY-PAY-01 amount/currency/reference validation (three failures); PAY-02 stale callback paid-state downgrade. No fixes or API changes were made. No claims about live exploitation or real merchant behavior are implied.

Remaining regression risks: no executed real DB/cross-store/ownership tests; incomplete full quotation/invoice/customer/creator/numbering/artifact fixtures; no true concurrent payment/worker exactly-once proof; no PayU/Atom/order-plan fulfillment fixtures; no real search/S3/video/browser/worker sandbox; quantity/currency/tax/branding acceptance missing. Setup requirements and each blocker are explicit in phase-2/02_TEST_ENVIRONMENT.md and 11_TEST_TRACEABILITY_MATRIX.md.

Phase 2 acceptance: **PARTIAL / NOT COMPLETE**. Local characterization is repeatable; critical integration and acceptance coverage remains blocked. No application/config/routes/custom-template/manifest/lock/Dockerfile/environment changes, schema migrations, notifications, live gateway calls, production changes, deployment, commit or push occurred. Phase 1 operational and recovery status remains unchanged.

Next: provision/verify empty isolated DB fixtures, execute existing real tests, implement the eighteen named coverage gates and obtain policy/output acceptance. Review the five defect IDs for separately authorized repair. Only after acceptance and explicit authorization, start Phase 3 with the isolated Laravel 5.8 → 6 checkpoint on PHP 7.4 and run this baseline suite plus real integration tests; do not begin that work automatically.

Final integrity/documentation verification passed: all 436 protected files unchanged (including environment and custom quotation source), all 33 test PHP files lint successfully, PHPUnit XML and audit JSON parse, fourteen Phase 2 documents exist, relative document links resolve and git diff whitespace checks pass. Changed/new Phase 2 paths are listed in phase-2/evidence/file-inventory.json. No commit or push was made. Work stopped after Phase 2.

## 2026-10-29 - Phase 2.1: critical defect verification and remediation preparation

Status: **PREPARATION COMPLETE within authorized scope; remediation not approved or implemented.** Overall Phase 2 remains PARTIAL. User authorization is investigation, test-only improvements and minimal remediation proposals; it does not authorize production business-logic fixes. PHP/Laravel/dependencies, production infrastructure and Phase 3 remain unchanged/deferred.

- [x] Read the Phase 1/2 artifacts, upgrade plan/progress and current failing tests/helpers.
- [x] Preserve existing uncommitted Phase 1/2 work and capture starting hashes without exposing source/environment secrets.
- [x] Reproduce and validate each of the five findings, including actual route/guard paths and fixture limitations.
- [x] Strengthen test fidelity without weakening or suppressing failed invariants.
- [x] Document explicit acceptance rules, owner policy decisions and five minimal fix/rollback proposals.
- [x] Execute full suite, record known/new failures and unchanged integration blockers, update Phase 2 reports and this history.

Initial evidence review: the original payment helper ignores SELECT projections/WHERE predicates, so it cannot by itself demonstrate SQL selection correctness. Original paid-downgrade input also combines a signed paid callback with a created provider response; provider reachability/policy is unverified. Both need stronger controls. The existing root/middleware-only authentication test does not establish that every routed endpoint is vulnerable; additional downstream checks must be traced. No findings are being labeled live exploits.

Phase 2.1 investigation checkpoint: all original seven failures reproduced (7 cases/56 assertions, exit 1). CallbackStore now honors equality filters and SELECT projections and rejects unconfigured tables; existing passing cases remain passing. Added actual protected-route checks, missing local JWT identity, previously issued disabled-admin session, nested User/Admin serialization, routed unconverted-quotation fulfillment observation for the three mismatches, and consistently signed/fetched nonpaid status cases. Seven independent positive/boundary controls were added; no behavior under investigation is mocked.

Full verification now reports **207 cases: 154 PASS, 21 FAIL, 32 BLOCKED/SKIPPED, 746 assertions, zero errors**, exit 1. All original 147 passing scenarios remain PASS and all original seven failing scenarios remain FAIL. The additional fourteen failures strengthen the same findings, not fourteen new vulnerabilities. Controls show /api/me retains independent controller auth, and invalid callback signatures cannot fetch/write/fulfill. Nested Admin exposure is a serialization primitive risk; a public nested-Admin route has not been proven. Paid-to-pending is a verified non-monotonic branch; actual provider backwards-state delivery remains unverified, and status=1 alone is not sufficient proof of financial settlement. Minimal proposals/approval decisions are being finalized without application changes.

### Phase 2.1 closeout

Canonical report: `docs/php-upgrade/phase-2/15_CRITICAL_DEFECT_VERIFICATION.md`. It contains exact source/function/route paths, evidence scope, acceptance rules, five minimal change proposals, compatibility/security/rollback considerations, explicit approval requirements and Phase 2.2 next steps. Updated existing Phase 2 fixture/payment/traceability/execution/known-defect/final reports; preserved the original baseline evidence. Corrected replacement question marks in the Phase 2 report's dash/range/arrow text for readability.

Root causes verified: JwtMiddleware falls through on unrecognized/missing Login-Type and does not require an existing identity; inactive-login logout targets api instead of admins and Admin middleware ignores inactive status; User serialization lacks secret hiding; payment callback fails to bind fetched financial identity before writes/fulfillment; nonpaid branches do not protect completed local payment state. No original code gap was disproved. Universal API bypass, public nested-Admin disclosure, admin JWT issuance, live gateway mismatch exploitability and provider backward-state reachability were NOT established and remain explicitly limited/unverified.

Test changes: corrected only `tests/Support/CallbackStore.php` to honor equality predicates/projection/no-match writes; added `tests/Feature/CriticalDefectControlsTest.php`, `tests/KnownFailures/CriticalDefectVerificationTest.php`, `tests/KnownFailures/PaymentDefectVerificationTest.php`. Added 21 cases: seven PASS controls, fourteen intentionally failing invariant cases. Existing passing tests and failed invariants were neither deleted nor disabled; no exact decision under investigation was mocked. Created `evidence/phase-2.1/` source locations, original/full reproduction outputs, structured results, delta traceability and integrity evidence. Original Phase 2 files are the historical baseline; current results are linked from the updated reports.

Actual commands: original `php tests/run.php --testsuite KnownFailures --verbose --log-junit docs/php-upgrade/phase-2/evidence/phase-2.1/original-findings.xml` reproduced seven failures. Final `php tests/run.php --verbose --log-junit docs/php-upgrade/phase-2/evidence/phase-2.1/verification-run.xml` produced **207 cases / 154 PASS / 21 FAIL / 32 BLOCKED via skips / 746 assertions / zero errors**, exit 1, PHPUnit time 5.24 seconds and 102 MB. No original baseline scenarios are missing or regressed. Report generation normalized Windows console text encoding/line endings; this did not change test results.

Remaining blockers: unchanged 14 real-engine tests and 18 workflow/acceptance gates; real DB row locking/unique effects/concurrent payments; immutable expected attempt amount/currency/reference source; manual/refund/partial/replaced-link reconciliation policy; valid social identity mapping and header compatibility; remembered-admin session integration; full public nested/raw serialization inventory. Phase 1 restore/runtime work remains deferred. No live service or production account was used.

Approval boundary: the Phase 2.1 request explicitly withholds business-fix authorization. Phase 2.2 must name the approved middleware/guard/model/payment corrections and resolve the policy choices recorded in the canonical report. Keep financial mismatch and no-downgrade invariants firm while defining legitimate reversals/partial settlements. No production fix, framework/dependency upgrade, schema change, deployment, commit or push occurred. Stop after Phase 2.1; Phase 3 is not started.

Phase 2.1 final verification passed: 437 protected business/environment/build/dependency/upgrade-plan files unchanged, all 36 test PHP files lint cleanly, PHPUnit XML/evidence JSON valid and Phase 2 relative links resolve. Starting existing files changed are CallbackStore and progress.md; Phase 2 documentation changes and three new test files are the remaining scoped changes. Integrity evidence is linked from the investigation. Preparation is complete; remediation/integration approval and fixtures remain pending.

## 2026-10-29 - Phase 2.2: real database and business integration testing

Status: **PARTIAL - local integration implementation and execution finished; acceptance incomplete**. Scope explicitly permits disposable local database provisioning and test-only schemas/fixtures; production business fixes, dependency/runtime upgrades, Dockerfile/deployment changes and Phase 3 remain unauthorized.

- [x] Read the request, prior reports and current 14 real-engine tests/18 coverage gates; preserve all prior uncommitted work and capture starting hashes.
- [x] Discover installed MySQL 8.0.44 binary; do not reuse or change the existing MySQL80 service or data.
- [x] Provision new positively identified loopback-only MySQL/MongoDB runtimes, credentials and schema fixtures.
- [x] Execute existing real-engine tests and investigate actual engine/fixture discrepancies; fourteen PASS.
- [x] Extend actual business persistence, cross-store failure/retry, payment/idempotency and queue/expiry coverage in dependency order.
- [x] Resolve two individual gates with executed meaningful assertions; retain sixteen explicit service/policy/coverage gates.
- [x] Run full suite twice, compare all 207 baseline cases/21 known failures, update traceability/evidence/reports and closeout.
- [x] Verify all fixture tables/collections are empty after runs and shut down only the owned disposable database instances.

Implementation order: isolated runtime identity and least-privilege accounts -> scoped schema from compatible historical migrations -> baseline engine tests -> shared synthetic customer/admin/product/quotation fixtures -> cross-store/product and quotation/invoice/payment/expiry/queue flows -> external renderer/media/search/storage coverage as independently safe -> repeated full regression and acceptance assessment. No production credentials/data are used.

Phase 2.2 checkpoint: private local MySQL 8.0.44 and MongoDB 6.0.26 runtimes provisioned in a new restricted temporary directory, bound to 127.0.0.1:3307/27018, with independent test-only principals. Existing MySQL80 service/data are untouched. The MongoDB mongod binary was extracted from the official vendor ZIP; PHP extension/package versions remain unchanged. Existing 14 engine cases now PASS (115 assertions). The first real run found the Mongo fixture incorrectly assumed Carbon freezes legacy freshTimestamp(), which calls native time(); fixed only the fixture to supply explicit dates. No product timestamp behavior changed.

Real business work executed: custom quotation creation, customer/creator/item joins, replacement/edit retrieval, invoice conversion with unchanged CP templates, actual Dompdf PDF attachments and local Swift array sink; SDK/gateway/cloud boundaries remain synthetic. Product importer executed against both engines with SQL/BSON failure injection and retry/duplicate checks; observed SQL survives Mongo failure and retry omits Mongo product identity (new LEGACY-DATA-01 invariant added). Real SQL payment conversion/replay tests exercise Common, PDFs and mail; known amount/currency/reference and state-downgrade defects reproduce with real persistence (four added failures, no fixes). Two-connection row-lock timeout/release, real database queue reserve/release/retry/ack and failed-job persistence, and actual carry-forward synthetic balance command tests pass. Exactly-once concurrent application fulfillment remains unproven.

Phase 2.2 first full execution: **233 cases / 190 PASS / 27 FAIL / 16 BLOCKED / 1301 assertions / zero errors**, exit 1. All 21 original invariant failures remain visible. Six added real-engine failures consist of five additional reproductions of existing AUTH-02/PAY-01/PAY-02 and one new cross-store retry invariant (LEGACY-DATA-01). Two gate cases were replaced by executed cross-store Product import/filter tests; sixteen explicit full-workflow/service/policy gate cases remain. A second complete run is in progress.

Harness-only corrections: test schema bootstrap needed a Laravel 5.8 schema facade connection adapter; local MySQL skip-name-resolve prevented initial localhost-root bootstrap and was removed only from the owned test instance; CloudClient/MultipartUploader construction is replaced by strict local sinks; Swift attachment bytes are materialized at send time before application cleanup; payment helper was renamed to avoid PHPUnit callback() name collision. Full combined PDF suite exceeded PHP's default 128 MB; the test child now has a documented 512 MB limit, without changing application/deployment PHP settings. Aborted development evidence is retained and not reported as successful execution.

### Phase 2.2 final results

Two complete executions of `php tests/run-real.php <private-runtime-manifest> --verbose --log-junit <phase-2.2/full-run-N.xml>` produced **233 cases, 190 PASS, 27 FAIL, 16 BLOCKED via skip, 1301 assertions, zero errors, exit 1**. PHPUnit times 38.8 s / 39.12 s, reported peak memory 166 MB. Names/statuses match. Original 154 passes and 21 failures preserved; 14 old DB blockers become PASS; two gate placeholders are intentionally superseded by real Product tests (not silently deleted), and 28 new cases comprise 22 PASS/6 FAIL. All twenty-one prior failures were individually compared and remain the same five categories; the only additional defect category is LEGACY-DATA-01.

Delivered: real MySQL/Mongo runner and private runtime verification/provisioning helpers; test-only schema from nineteen selected historical migrations plus five explicit Product columns; BusinessFixtures, real materialized Swift sink and strict cloud boundary sinks; six new integration files (authentication, cross-store Product/filter, quotation/invoice/output, payment persistence/replay, SQL locking/queue and carry-forward). Modified tests/run.php memory budget, MongoTestCase explicit dates, MySqlRegressionTest uniqueness case and two resolved/narrowed UnavailableFlows gates. Updated existing Phase 2 environment/fixture/database/business/output/search/queue/traceability/execution/defect/final reports and added 16_REAL_DATABASE_INTEGRATION_REPORT.md. Added structured/raw repeated execution, schema, gate, traceability, cleanup and integrity evidence under evidence/phase-2.2/.

MySQL results: original eight cases pass; actual PK uniqueness, legacy absence of invoice_name uniqueness, two independent connections/row-lock timeout/release, customer/creator/item relations, quotation creation/replacement/edit retrieval/conversion/expiry, valid admin/API guard separation, queue reservation/retry/ack/failed records and carry-forward sequential duplicates exercised. MongoDB results: original six pass; actual Product import, nested filter/category/keyword/pagination, duplicate processing and SQL/BSON failure/retry executed. SQL survives Mongo failure and retry leaves missing Mongo identity; passing characterization plus failing DATA-01 invariant record both observation and intended requirement.

Payment results: real HMAC/route -> actual SQL/Common/PDF/Swift flow tested using synthetic SDK fetch/link responses and cloud sink. Valid paid conversion/sequential replay pass without a second invoice/mail/PDF in the converted path; invalid signature and expired quotation cases pass. Three mismatch cases and paid-to-pending invariant FAIL with real SQL. Two-connection lock test is engine evidence, NOT actual simultaneous callback fulfillment proof. Full exactly-once concurrency/payment-record ledger/notifications remain blocked.

All eighteen original gate decisions are recorded in evidence/phase-2.2/coverage-gates.json. Remaining sixteen cases explicitly cover concurrency, reviewed PayU/Atom/legacy order-plan fixtures, approved renderer/branding/CC/BCC/quantity/currency/tax/credit policies, upload/video/download-entitlement matrices, S3 emulator, Elasticsearch mappings and full application worker retry/idempotency. Partially executed gates remain blocked for their missing acceptance/full-matrix dependency; no mocks are labeled real external-service integration.

Cleanup: after both runs, every table in the disposable SQL schema and Mongo image_filter_values was verified empty; own-runtime paths were rechecked, and graceful shutdown was requested only for those instances. No 3307/27018 listeners remained on verification. Private random credentials remain only in the restricted temporary runtime directory, never in Git/.env/reports. Existing MySQL80 service/data were not touched. No source fix, production/schema change, dependency/runtime upgrade, Dockerfile edit, notification/payment call, deployment, commit or push occurred.

Acceptance: **PARTIAL, suite intentionally nonzero**. Review/authorize remediation of the six defect categories separately, obtain outstanding business policy/output acceptance, implement remaining provider/service/concurrency fixtures and close Phase 1 recovery/runtime gates independently. Only after accepted coverage and explicit authorization consider staged Laravel 5.8 -> 6 work. Stop after Phase 2.2; Phase 3 is not started.

Phase 2.2 final integrity verification: all 437 protected application/environment/build/dependency/upgrade-plan files remain unchanged; all 47 test PHP files lint successfully; PHPUnit XML/evidence JSON parse and Phase 2 relative links resolve. Graceful shutdown confirmed no 127.0.0.1:3307/27018 listeners; all fixture rows/documents empty. Exact changed/new test paths and runtime provenance are recorded in evidence/phase-2.2. No commit/push performed. Work stopped after Phase 2.2.

## 2026-10-29 - Phase 2.3: scoped critical defect remediation

Status: **PARTIAL - final verification recorded below**. User explicitly authorizes minimal production-source corrections for verified auth, inactive-admin, serialization, payment identity/state and cross-store retry defects where safe behavior is unambiguous. Policy-dependent amount snapshots, partial payments, reversals, currency conversion and external social identity binding must not be invented. No schema, dependency, PHP/Laravel, template, deployment or Phase 3 change is authorized.

- [x] Read request, prior reports/evidence/tests and preserve existing uncommitted work with starting hashes.
- [x] Correct JWT identity/header fall-through, admins guard/status handling and secret serialization; add legitimate-path/rejection tests.
- [x] Repair cross-store retry identity without assuming distributed transactions.
- [x] Implement unambiguous signed/stored/fetched payment identity checks and terminal-state concurrency guards; document unresolved monetary authority policy.
- [x] Add sequential and concurrent regression coverage without suppressing existing invariants.
- [x] Restart only previously verified empty disposable runtimes, execute full suite twice, compare all passing baseline cases, update reports/progress and shut down own services.

Requested owner clarification asynchronously: whether stored link-creation amount/currency or edited invoice values are authoritative. Independent auth/data/state remediation proceeds while the question is open; no timeout is treated as approval.

### Phase 2.3 final status and evidence

Status: **PARTIAL - scoped remediation implemented and verified; six monetary invariants and sixteen acceptance gates remain open.** Phase 2.3 stops here; Phase 3 is not started.

Defects fixed in tested scope: AUTH-01 local JWT identity/header fall-through; AUTH-02 admins guard logout plus active-state checks/session rejection after real SQL deactivation; AUTH-03 direct/nested/collection Eloquent secrecy (password/remember_token, and User gmail_idtoken/fb_token/otp/email_verify_token); PAY-02 recorded-success terminal protection with row-locked callbacks; DATA-01 retry restores SQL product_id/Image in absent/incomplete Mongo document. PAY-01 is PARTIAL: fetched/signed/stored link/reference comparison is fixed; amount/currency comparison remains OPEN pending authoritative baseline and missing/edited history policy. No approval answer was received and no assumption implemented.

Both final full runs: **251 tests, 229 PASS, 6 FAIL, 16 BLOCKED/skipped, 1,419 assertions, zero errors, exit 1**. All 233 baseline names remain present; all 190 old passes remain passing; 21 of 27 old failing invariants now pass; no old failing invariant deleted/skipped/weakened. Added 18 default-suite cases. Actual integration counts: 41 PASS, 2 monetary FAIL, 16 BLOCKED; original fourteen engine cases remain passing. Separate concurrency harness twice: three PASS scenarios each, with both PHP callback connections observed simultaneously in SQL LOCK WAIT. Duplicate paid callbacks perform one Common conversion, notification and artifact; completed paid/pending and failed/paid pairs preserve success without new delivery. This proves normal completed-process concurrency, not crash-safe exactly-once delivery or a durable payment ledger.

Tests added: tests/Feature/RemediationRegressionTest.php (17 cases); actual SQL previous-session deactivation case (1). Added tests/run-concurrent.php and explicitly invoked tests/Fixtures/ConcurrentCallbackWorkerTest.php outside default discovery. Updated CallbackStore transaction/lock boundary support; BusinessFixtures supports sink-only workers; positive provider fixtures now carry actual resource id/reference. Corrected the original paid fixture to explicitly record financial success rather than approval alone. Existing replay characterization asserts one write and cross-store historical characterization asserts repaired identity instead of unsafe omissions; baseline names retained. All financial negatives remain enabled.

Production files modified: app/Http/Middleware/JwtMiddleware.php; app/Http/Middleware/Admin.php; app/Http/Controllers/Admin/AdminController.php; app/Http/Controllers/PaymentController.php; app/Models/User.php; app/Models/Admin.php; app/Models/Product.php. Existing tests modified: tests/Feature/PaymentRegressionTest.php; tests/Integration/AuthenticationPersistenceIntegrationTest.php; tests/Integration/CrossStoreBusinessIntegrationTest.php; tests/Integration/UnavailableFlowsTest.php; tests/KnownFailures/PaymentInvariantTest.php; tests/Support/BusinessFixtures.php; tests/Support/CallbackStore.php. Updated Phase 2 traceability/execution/register/report/investigation/integration documents, added 17_CRITICAL_REMEDIATION_REPORT.md and phase-2.3 evidence. Exact phase-relative inventory is evidence/phase-2.3/file-inventory.json; earlier uncommitted work is preserved.

Compatibility: valid application JWT claims/login/refresh/logout and supported header modes pass; raw social provider tokens no longer suffice for protected middleware. Legacy Facebook login returns a provider token and needs reviewed local-JWT exchange/client acceptance; real provider flows are not claimed compatible. Public identity fields remain, secret fields disappear by design. Callback redirect/status mapping remains; absent/malformed stored link identity fails closed and requires historical reconciliation/reissue. status=1 approval alone is not treated as financial completion; existing payment_status Transction Success is protected. No refund/FX/manual settlement/partial payment policy was invented. Row locks span existing conversion I/O; crash/commit failure, swallowed conversion errors, duplicate invoice_name data and durable delivery remain limits. Mongo failure still propagates, SQL survives and caller retry repairs; no distributed transaction/automatic detector is claimed.

Owned disposable MySQL 8.0.44/MongoDB 6.0.26 runtimes were positively identified and restarted, all fixture rows/documents verified empty after both full and concurrency runs, then only those instances received graceful shutdown. Ports 3307/27018 have no listeners afterward. Existing MySQL80 service was not touched. Random credentials stayed outside the repository. PHP 7.4.33, Laravel 5.8.38, PHPUnit 7.5.20, Composer/npm dependencies/locks, schema, .env, templates and infrastructure remain unchanged. No live payment, real notification, Coolify, Docker Compose, GitHub Actions, deployment, commit or push.

Remaining blockers: six amount/currency failures (boundary/routed/real SQL); owner monetary baseline/missing-history and edited/replaced-link decisions; Facebook token exchange acceptance; remembered-session/raw serialization/error-log inventory; crash-safe ledger/notification compensation and invoice-name uniqueness policy. All sixteen prior gates remain open wholly or partly: quotation auth/branding/tax/quantity, numbering/ownership, crash/delivery concurrency, PayU, Atom, legacy Razorpay order/plan, browser rendering, complete email matrix, image/video/download entitlement paths, S3, Elasticsearch, carry-forward and worker idempotency, FX/quantity. Phase 1 recovery/runtime gates remain deferred.

Next steps within an explicitly authorized follow-up: obtain monetary policy; implement minimal amount/currency checks and rerun all six invariants plus valid/edited/replaced-link cases; review social-client/secret inventory compatibility and remaining integration fixtures. Any new durable ledger/schema/outbox design requires separate approval. See docs/php-upgrade/phase-2/17_CRITICAL_REMEDIATION_REPORT.md for root causes, security limits, rollback and actual evidence. Stop after Phase 2.3.

Phase 2.3 integrity verification: 431 protected non-test files outside the seven authorized application changes remain byte-identical to starting hashes; all 57 test/changed application PHP files lint successfully; JSON/XML parse, documentation links resolve and git diff --check passes. Private runtime password values were checked against Phase 2.3 outputs with zero matches. Final machine-readable evidence, inventory and cleanup are under docs/php-upgrade/phase-2/evidence/phase-2.3/.
