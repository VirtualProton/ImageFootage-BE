# Test environment and execution

Phase 2.2 executed dedicated MySQL 8.0.44/MongoDB 6.0.26 fixtures and added `tests/run-real.php <private-runtime-manifest>` with positive data-directory checks. The 14 original engine cases now pass. See [real integration report](16_REAL_DATABASE_INTEGRATION_REPORT.md) for schema provenance, executed commands, safe setup and cleanup. The normal runner still blocks unavailable real fixtures; the child has a test-only 512 MB budget for full business PDFs. Earlier instructions below describe manual setup, not a claim that services remain running after tests.

Verified execution baseline: PHP CLI 7.4.33, Laravel 5.8.38, PHPUnit 7.5.20 on Windows. No new packages were installed. Existing vendor metadata/lock versions were retained. No SQLite substitutions, migrations, Coolify tasks, production queue workers or live gateway calls are used.

## Mandatory entry point

```powershell
php tests/run.php --verbose
php tests/run.php --testsuite Unit,Feature
php tests/run.php --testsuite Integration --verbose
php tests/run.php --testsuite KnownFailures --verbose
php tests/run.php --verbose --log-junit docs/php-upgrade/phase-2/evidence/local-results.xml
```

`tests/run.php` launches a fresh PHP process with URL fopen and cURL/socket/mail/process functions disabled. The child inherits only OS process essentials and explicitly named `PHASE2_*` options; application/database/AWS/mail/provider environment settings from the parent are discarded. Custom PHP INI extensions are still the installed local baseline. Bootstrap/configuration/environment/process-isolation overrides are refused. Direct PHPUnit invocation fails closed before application bootstrap; use this runner, including in an IDE's test configuration.

`tests/bootstrap.php` verifies the restrictions before application creation. `tests/CreatesApplication.php` uses a generated private `.env.testing` directory, separate cache paths, temporary storage/public paths and test-only configuration applied after Laravel LoadConfiguration and before providers. The real `.env`, tracked backup env files, cached production config and uploaded/customer data are not loaded. Request context is not faked globally: actual configured guards/routes/middleware remain available.

Mail/queue fakes and SMS/search mocks are recreated per test. Razorpay uses actual SDK/cryptographic code with a strict in-memory Requests transport expectation queue, not a socket. Unexpected gateway operations are refused. Remote HTTP/FTP wrappers are removed. All configured data stores are loopback-only; disabled stores use refused port 1. PHP's native PDO/MongoDB extensions are not an OS network sandbox, so retain host/container-level egress restrictions when adding new integrations or running on other machines. Do not run arbitrary new tests that instantiate unreviewed native network clients.

## MySQL fixture setup — NOT performed here

An operator must provision a **new dedicated local MySQL instance**, listening only on `127.0.0.1:3307`, with no links to production. Do not repoint an existing production instance, import customer dumps, disable FK constraints or run application migrations as part of this suite. Prepare a reviewed schema-only fixture matching the existing baseline, initially empty and containing no SQL events or triggers. The current executable tests need `promo_codes`, `imagefootage_performa_invoices`, `imagefootage_performa_invoice_items`; invoice tables must match current model columns. Copying the complete reviewed empty baseline schema is preferable before adding lifecycle tests.

On that independently verified instance, using an operator account and interactive password (example commands only):

```sh
mysql --protocol=TCP --host=127.0.0.1 --port=3307 --user=fixture_admin --password
```

Then provision the isolated schema/principal through the local administration process:

```sql
CREATE DATABASE imagefootage_phase2_test CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'phase2_test'@'127.0.0.1' IDENTIFIED BY '<new-test-only-password>';
GRANT SELECT, INSERT, UPDATE, DELETE ON imagefootage_phase2_test.* TO 'phase2_test'@'127.0.0.1';
```

Use your server's verified host-principal matching rules; test login must resolve `CURRENT_USER()` to `phase2_test`, never root. The principal needs read visibility for metadata on its own schema. The examples are operator setup, not commands executed by this phase or a request to edit production schemas.

Import only the reviewed empty schema artifact, with no embedded production database names, `USE`, DEFINER, events, triggers, data or external routines:

```sh
mysql --protocol=TCP --host=127.0.0.1 --port=3307 --user=fixture_admin --password \
  --database=imagefootage_phase2_test < /secure/reviewed-baseline-schema-only.sql
```

Supply `PHASE2_MYSQL_ENABLED=1` and `PHASE2_MYSQL_PASSWORD` through a private local process/secret mechanism, then run the Integration suite. Do not put real passwords in command history, `.env`, Git or reports. Host/port/database/user defaults are exactly the values above; optional `PHASE2_MYSQL_HOST/PORT/DATABASE/USERNAME` are validated against those exact values, not arbitrary overrides. An enabled fixture with an empty password or invalid endpoint is rejected before application boot.

MySqlTestCase checks the selected database/principal, absence of events/triggers, empty required tables and InnoDB engines before beginning a transaction. Every test rolls back; it never creates/drops tables, truncates, resets AUTO_INCREMENT or migrates. If the service or schema fixture is unavailable, the test reports BLOCKED via PHPUnit skip. Schema/behavior assertion failures after setup remain failures. Schema matching and clean rollback have **not yet been demonstrated against a real server**.

## MongoDB fixture setup — NOT performed here

Provision a separate authenticated local MongoDB at `127.0.0.1:27018` with a new independent data directory. Use database `imagefootage_phase2_test`, user `phase2_test`, credentials valid only there. Precreate empty `image_filter_values`; the suite does not create/drop collections or databases.

With the operator's dedicated local MongoDB principal:

```sh
mongosh --host 127.0.0.1 --port 27018 --username fixture_admin \
  --authenticationDatabase admin --password
```

Within that disposable instance only:

```javascript
const fixture = db.getSiblingDB('imagefootage_phase2_test');
fixture.createCollection('image_filter_values');
fixture.createUser({ user: 'phase2_test', pwd: passwordPrompt(),
  roles: [{ role: 'readWrite', db: 'imagefootage_phase2_test' }] });
```

Privately supply `PHASE2_MONGO_ENABLED=1` and `PHASE2_MONGO_PASSWORD`. The validated host/port/database/user cannot point elsewhere. Tests ping, check database/collection names and refuse nonempty collections before writing synthetic documents. Cleanup deletes only explicitly recorded test ObjectIds, never broad filters or the database. Test credentials authenticate against the test database using the legacy driver's documented config shape. Mongo fixture/server compatibility remains unexecuted and BLOCKED here.

Do not enable either database until its identity, grants and empty synthetic fixture have been independently verified. Native database drivers use the approved loopback sockets even though PHP socket stream functions are disabled. There is no automatic service installation or deployment script.

## Other integration prerequisites

Real Elasticsearch/S3 emulator/worker/concurrent callback/video/Chromium integration is not enabled by a flag: those require separately reviewed fixtures and, for processes, a stronger process/network sandbox. Never remove the runner restrictions just to make a renderer or worker execute. The blocked coverage gates list the precise remaining fixture/policy need. Refer to [safety-check evidence](evidence/safety-checks.json) for six executed negative/inherited-environment checks.
