# Phase 2.2 - real database and business integration testing

Current Phase 2.3: scoped auth/admin/secrecy/payment-state/cross-store fixes verified; financial amount/currency policy remains unresolved. Final suite twice: **251 tests, 229 PASS, 6 FAIL, 16 BLOCKED, 1,419 assertions, zero errors**; separate three real concurrent callback scenarios pass twice. See [current remediation report](17_CRITICAL_REMEDIATION_REPORT.md). Content below is the preserved earlier phase snapshot.

Date: 29 October 2026. **PARTIAL: integration coverage expanded and executed, suite remains failing.** No production business fixes, version/dependency upgrades, schema changes, Dockerfile edits, deployment or Phase 3 work were performed. Prior uncommitted Phase 1/2 work is preserved.

## Execution and baseline comparison

| Result | Full run 1 | Full run 2 |
| --- | --- | --- |
| Cases | 233 | 233 |
| PASS | 190 | 190 |
| FAIL | 27 | 27 |
| BLOCKED via PHPUnit skip | 16 | 16 |
| Errors | 0 | 0 |
| Assertions | 1301 | 1301 |
| PHPUnit time | 38.8 s | 39.12 s |
| Peak reported memory | 166 MB | 166 MB |
| Exit | 1 | 1 |

Both complete runs match by scenario name/status. This is **not a successful/green suite**. The original 154 passing cases remain passing; all 21 original failed invariants remain failed. Fourteen formerly blocked real-engine tests now pass. Two empty coverage gates were replaced with actual Product cross-store write/failure/retry and filter/category/keyword/pagination tests; sixteen named gates remain blocked. Added 28 meaningful cases: 22 PASS and 6 FAIL. Six additional failures reproduce known AUTH-02/PAY-01/PAY-02 with real persistence (five cases) plus a newly demonstrated cross-store retry integrity failure (one case, LEGACY-DATA-01).

Evidence: [structured runs and baseline comparison](evidence/phase-2.2/execution-results.json), [run 1](evidence/phase-2.2/full-run-1.txt), [run 2](evidence/phase-2.2/full-run-2.txt), [JUnit 1](evidence/phase-2.2/full-run-1.xml), [JUnit 2](evidence/phase-2.2/full-run-2.xml), [scenario traceability](evidence/phase-2.2/test-traceability.csv), [class results](evidence/phase-2.2/class-results.json).

## Dependency-ordered plan and actual work

1. Read previous audit/reports/tests and identify the 14 database cases plus all 18 gates; capture source hashes.
2. Locate installed MySQL binary; create separate authenticated runtimes, data directories and loopback listeners without using existing services/data.
3. Provision scoped empty schema from compatible historical migrations and synthetic-only current-code columns; create least-privilege test accounts; verify runtime identity.
4. Execute original engine tests, correct the test fixture clock assumption, then establish shared customer/admin/location/product/quotation fixtures.
5. Exercise actual SQL/Mongo import/search and injected failures, quotation/invoice/PDF/mail, payment signatures/fulfillment/persistence/replay, real database queue/failed-job handling, scheduled credit/expiry and SQL two-connection locks.
6. Map every gate to executed evidence or a precise remaining dependency/policy. Do not use cloud/gateway/network calls to close unavailable integrations.
7. Execute full suite twice, preserve all known failures, compare baseline cases, verify cleanup/integrity and stop only the owned temporary services.

## Local runtime and isolation

**VERIFIED executed:** MySQL Community Server **8.0.44**, using the installed executable with a newly initialized temporary mysql-data directory; MongoDB **6.0.26**, extracting only mongod.exe from the official [vendor ZIP](https://fastdl.mongodb.org/windows/mongodb-windows-x86_64-6.0.26.zip). PHP remains **7.4.33**, Laravel **5.8.38**, PHPUnit **7.5.20**, MongoDB PHP extension **1.16.2**. These server versions are compatibility fixtures, not verified production versions or upgrade recommendations.

Services bind only `127.0.0.1:3307` and `127.0.0.1:27018`. The pre-existing MySQL80 service/data were not reused, stopped, configured or queried. The new directory has restricted owner permissions. Random test/admin credentials reside only in its private manifest; they are never copied into the repository, `.env`, reports, CLI arguments or customer settings. Runtime admin credentials are used only for bootstrap/identity inspection/shutdown; application tests use `phase2_test`.

`tests/run-real.php` requires explicit private-manifest opt-in. It verifies MySQL @@datadir and MongoDB startup dbPath/bindIp against the new disposable directory, then passes test-only passwords to the existing restrictive child runner. It does not enable live outbound HTTP or processes. Configured database names/users/ports/loopback restrictions remain enforced by Isolation. Fixtures never connect to remote/shared databases. SQL test principal has SELECT/INSERT/UPDATE/DELETE only on `imagefootage_phase2_test`; no schema/trigger/event privileges. Mongo test principal has readWrite only on the dedicated database; admin root is not used by the test application.

The child runner's **test-only** PHP memory limit is now 512 MB. The first combined real-PDF suite exhausted the local default 128 MB (aborted output retained); subsequent complete runs peak at 166 MB. No production PHP setting or renderer code changed. URL wrappers, gateway HTTP, mail delivery and process launches remain blocked/faked. `run-real.php`/provisioning execute outside that child only for verified local DB setup/identity; they do not load application .env.

## Schema and fixture provenance

`tests/Support/prepare-real-databases.php` executes **19 explicitly selected historical migration up methods** on the new empty schema, never `artisan migrate` against an application environment. See [schema provenance](evidence/phase-2.2/schema-provenance.json) for exact filenames. Tables include actual imagefootage invoice/item, users/admins, API/products, promo, country/state/city, user_package, email_templates, jobs and failed_jobs schemas. No production migration file was edited.

Historical product migrations include unrelated data rewrites; five current-code Product columns (`adult_content`, `slug`, `is_premium`, `search_terms`, `expired_date`) are therefore added explicitly to this fixture schema, with nullable types stated in the provisioning script. This is a **scoped test schema**, not proof of production schema parity. Selected later currency/discount/extra-detail/vendor-code/extended-expiry migrations are applied. No missing uniqueness or FK is invented, no FK checks are disabled and no database validation is bypassed to make assertions pass. Invoice-item's absence of a declared FK and invoice_name's lack of uniqueness are observed explicitly. Primary-key uniqueness is tested against actual MySQL error 1062.

The database baseline uses the application's legacy non-strict SQL setting. Required column defaults are filled by a fixture builder using actual column metadata, with explicit IDs/customer fields/business values overriding the synthetic defaults. The suite checks empty prerequisite tables, expected database/principal, InnoDB, no events/triggers, and rolls transactions back. One two-connection case commits only its own inserted invoice then deletes only that ID in finally; no broad reset/truncate/drop is run from tests.

`prepare-real-databases.php --reset-disposable` permits an explicitly named SQL fixture reset only after exact temp-directory/datadir verification. It does not reset or drop any production database. Its Mongo bootstrap is intended for a fresh empty Mongo runtime; for a fresh full repro create a new private runtime rather than rerun Mongo root-user bootstrap on an existing instance. No automatic Mongo drop/reset is provided.

Mongo fixtures precreate only `image_filter_values`; tests insert synthetic ObjectIds and remove only recorded IDs or the one fixed importer api_product_id they own. Real CRUD/ObjectId/filter/sort/aggregation/missing/serialization cases execute. Initial timestamp test failed because the installed legacy model's `freshTimestamp()` calls native `time()`, not Carbon's frozen clock. The fixture now supplies explicit created_at/updated_at instants. This is a corrected test assumption, not a changed product timestamp implementation or ignored date assertion.

## Business integration results and limits

| Area | Actual executed assertions | Result / limits |
| --- | --- | --- |
| Original engine cases | 8 MySQL + 6 MongoDB cases, including transactions/precision/relations/pagination, ObjectId/dates/aggregation | All 14 PASS after explicit timestamp fixture correction; original isolated run 115 assertions |
| SQL uniqueness/locking | Actual PK duplicate rejection; duplicate invoice_name observation; independent connections/lock-wait error 1205/release/successful update | PASS primitives; handler does not automatically acquire this tested lock |
| Real authentication | Real SQL users, actual admin/API guards and bcrypt, guard separation | Valid auth PASS; disabled-admin invariant FAIL confirms AUTH-02 |
| Cross-store Product | Actual savePantherMediaImage SQL/Mongo create, duplicate import, SQL failure, BSON driver failure, partial SQL persistence/retry | Characterizations PASS; complete retry identity invariant FAIL (DATA-01). No shared transaction assumed |
| Search/filter | Actual getProductsData Mongo orientation filter -> SQL keyword/category -> pagination, encrypted output IDs and empty results | PASS; does not cover every SearchController/FiltersController algorithm or Elasticsearch cluster |
| CP quotation | Actual Common save_proforma with customer/creator/location/item joins; generated seven-digit number; money; persisted metadata; edit retrieval; replacement/cancellation | PASS synthetic cases; owner-approved branding/number/quantity/tax policies and full HTTP auth matrix remain pending |
| Invoice | Actual Common create_invoice preserves number/total, changes proforma type, creates PDF and mail attachment; missing data returns 422 | PASS synthetic cases; all other invoice types/gateway policies not claimed |
| Expiry/credits | Real scheduled command due-quotation cancellation and sequential repeat; actual carry-forward remainder 10-3=7 and one sequential credit | PASS characterization; concurrent credits, year/month/timezone policy still pending |
| Payments | Actual routed HMAC/fetched link -> real invoice writes/Common/PDF/mail; sequential replay, invalid signature, expired quotation | Valid/replay/invalid/expiry PASS; 3 financial mismatch + 1 downgrade FAIL confirm prior PAY findings |
| Mail/PDF/storage | Unchanged CP/invoice HTML -> actual Dompdf -> real Swift in-memory message/attachment bytes; synthetic logos; subject/recipient; artifact sink; storage failure partial side effects | PASS named fixtures; not approved visual output, real SMTP, Chromium, Browserless or S3 |
| Queue | Actual DatabaseQueue reserve/release/attempt increment/fixture handle/delete; DatabaseFailedJobProvider writes/reads failed_jobs | PASS in-process queue primitives; not production job worker orchestration or exactly-once notification proof |

### External boundary fidelity

SDK payment transport remains the strict in-memory GatewayTransport; HMAC and controller/fulfillment/persistence are real. `UploadSink` replaces concrete S3Client and MultipartUploader construction because production code instantiates them directly without an injectable custom HTTP handler. This is explicitly a cloud boundary **fake**, not a running S3-compatible service or SDK/network compatibility result. Unexpected client operations throw. SDK credentials/provider calls never escape.

`MaterializedMailSink` extends Laravel's array transport and reads actual Swift attachment streams at send time, before business cleanup unlinks the local PDF. This mirrors the file-read boundary of a real sender while retaining bytes privately in memory. It neither opens SMTP nor fabricates recipient/subject/body/attachment output. Dompdf is real; Chromium/Browserless/process integration remains blocked. No existing HTML template is edited and no customer PDF is used.

## Payment concurrency and idempotency

Valid payment-link conversion and a subsequent identical successful callback leave one invoice row/item and no additional generated PDF/upload/mail in the **sequential converted-invoice path tested**. Invalid signatures cause no fetch/mutation/new mail. A paid response for an already locally cancelled quotation stays cancelled and does not fulfill again. Three mismatched financial identities still convert and send a second mail; the pending-state conflict still downgrades SQL paid state. These are failed invariants, not acceptable legacy behavior or proof of a live provider exploit.

The two-connection test proves MySQL row locking works with the test fixture; it is not an application callback concurrency test. There is no evidence the current handler uses that lock. True simultaneous callbacks, one durable payment record, uniqueness/outbox delivery, full retry after DB interruption and exactly-once customer notifications remain BLOCKED. No payment-record table coverage is inferred from counting invoice rows. The no-unique-invoice_name observation increases the need for a separately approved idempotency design but does not by itself prove a concurrent duplicate event occurred.

## New cross-store defect

**LEGACY-DATA-01**: `Product::savePantherMediaImage` inserts SQL product first, then saves its Mongo filter document. Actual BSON serialization failure leaves the SQL insert. On retry, the existing-SQL branch invokes Mongo updateOrCreate with only attributes/options, omitting product_id/product_main_type when the Mongo document does not exist. The new invariant compares Mongo identity with the actual SQL row and fails (both Mongo fields null). A separate passing characterization records this partial state. No business correction or cross-store atomicity is invented. Driver serialization failure was deterministic/synthetic; an actual server outage/write-concern matrix is not claimed.

## All eighteen gate decisions

The exhaustive [gate map](evidence/phase-2.2/coverage-gates.json) retains the original names, executed replacement tests, status and exact remaining fixture/policy. Two are resolved by meaningful integration tests: Product cross-store import/failure/retry and Product Mongo/SQL filter combinations. Sixteen remain as explicit BLOCKED PHPUnit gate cases. Some have partial executed coverage (quotation/output/credits/queues) but retain missing acceptance/worker/full-matrix requirements.

Still unavailable: full concurrent callback harness; reviewed PayU merchant/hash/order and legacy Razorpay order/plan fulfillment fixtures; active Atom path confirmation; isolated Chromium/Browserless/video process sandbox/approved outputs; upload/watermark/orientation/download entitlement matrices; local S3 emulator; Elasticsearch cluster/index mappings; approved currency/quantity/partial/reversal/tax/annual-credit policies; full worker retry/idempotency and ownership matrix. No blocked case is converted to an empty pass. No real external service is contacted as a shortcut.

## Reproduction and lifecycle

The earlier manual fixture instructions in 02_TEST_ENVIRONMENT remain valid for separately provisioned services. This phase's executed setup uses a new private temp directory, installed MySQL executable, official mongod binary, loopback ports and random credentials. Privately create a manifest with `workspace`, `root_password`, `mysql_password`, `mongo_admin_password`, `mongo_password`; retain owner-only filesystem permissions. Do not commit it. Start both executables with the exact private data directories, the specified loopback ports, Mongo auth and MySQL X protocol disabled; never reuse an existing instance's data directory or service.

```powershell
# Only after creating/verifying the NEW private local runtime and loopback listeners:
php tests/Support/prepare-real-databases.php <private-runtime-manifest>
php tests/run-real.php <private-runtime-manifest> --filter 'MySqlRegressionTest|MongoRegressionTest' --verbose
php tests/run-real.php <private-runtime-manifest> --verbose --log-junit docs/php-upgrade/phase-2/evidence/phase-2.2/full-run-1.xml
php tests/run-real.php <private-runtime-manifest> --verbose --log-junit docs/php-upgrade/phase-2/evidence/phase-2.2/full-run-2.xml
```

`tests/run.php` without the opt-in continues to block real-engine cases safely. The manifest is an explicit resource selection, not production credential discovery. A missing/unsafe local service aborts with credentials withheld. [Runtime identity/cleanup evidence](evidence/phase-2.2/runtime-cleanup.json) records empty fixture state and shutdown; temporary fixture services are not left as permanent background services. Full operational reinstall automation, Docker Compose and GitHub Actions were not introduced.

## Files and acceptance

Test-only changes: MongoTestCase explicit timestamps; run.php test-child memory budget; MySqlRegressionTest uniqueness assertion; UnavailableFlowsTest two resolved gates and narrowed partial requirements. Added runtime preparation/opt-in runner, synthetic BusinessFixtures/materialized mail/cloud sinks, six integration test files and a synthetic queue fixture job. Existing business code/templates, .env, manifests/locks, Dockerfile and prior tests/invariants are preserved. Detailed [file/integrity evidence](evidence/phase-2.2/integrity-verification.json) lists exact paths and hash checks. progress.md and related Phase 2 reports link current results while keeping historical snapshots.

**Phase 2.2 acceptance remains PARTIAL**: core local engines/business integration now executes, but 27 invariant failures and sixteen coverage/policy gates remain. Failures were investigated: 21 existing failures preserved, five stronger real-persistence reproductions of existing defects, one cross-store retry gap. Fix authorization remains absent. Next: review the six defect categories for separately authorized corrections; prepare missing concurrency/provider/service fixtures and obtain business policies/output acceptance; close remaining Phase 1 recovery/runtime gates separately. Do not start PHP/Laravel upgrades, Phase 3 or deployment automatically.

Final verification: all **437 protected application/environment/build/dependency/upgrade-plan files unchanged**; **47 test PHP files pass syntax lint**; PHPUnit XML/evidence JSON valid; Phase 2 relative links resolve. Empty fixture data and absent loopback listeners after graceful shutdown are recorded. Runtime source/version/binary hash evidence is in [runtime provenance](evidence/phase-2.2/runtime-provenance.json). No audit/test commit or push was made.
