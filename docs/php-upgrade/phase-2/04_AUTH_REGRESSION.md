# Authentication and authorization

Tests: `tests/Feature/AuthRegressionTest.php`, `JwtRegressionTest.php`, `tests/Unit/PermissionRegressionTest.php`, `tests/KnownFailures/SecurityInvariantTest.php`. Actual routes come from routes/web.php and routes/api.php; no route was added or modified.

| Layer | Exercised behavior | Status |
| --- | --- | --- |
| Admin HTTP | `/admin/authenticate` validation, correct/wrong password, admin session creation, guard separation, `/admin/logout`, guest `/admin/dashboard` redirect | PASS with synthetic SELECT persistence |
| API HTTP | `/api/login` required fields (legacy HTTP 200), incorrect credentials (401/error text), successful response field names/misspellings and expiry field | PASS with synthetic SELECT persistence |
| JWT primitive | Real signing, required claims, TTL relationship, signature tampering, expiry, refresh/blacklist | PASS; array blacklist cache only |
| JWT HTTP | Protected normal-header requests, malformed/missing/expired token errors, `/api/refresh` nested contract, `/api/logout` revocation | PASS with the stated mocks |
| Permissions | URL/module/action classification, unauthenticated denial, super-admin branch, cached subadmin view/edit permissions and 403 shape | PASS; real permissions table/ownership integration BLOCKED |
| Security invariants | Missing Login-Type, disabled admin guard, password hash serialization | FAIL; three distinct defect IDs |

The obsolete `GET /` 200 example was unsupported by the route file: there is no unconditional root route, and the configurable log path can affect route placement. Under the isolated nonroot log route with debug disabled, root is absent. `ExampleTest` now checks the real `/admin/login` public form and separately checks the absent root. No dummy route or production behavior was introduced.

`ReadFixtureConnection` returns only invented users/admins; actual Eloquent providers, hashing, guards, middleware and controller serialization execute. This is a request-contract layer, not proof of successful login against MySQL. Role mappings are supplied through independent cache fixtures; cross-user ownership, persistent revocation, real account states and SQL role relations remain BLOCKED. Google/Facebook token verification is not exercised and cannot access live services.

Do not approve legacy `expires_in=21` as seconds or change payload fields here. The tests preserve its observed value while real JWT TTL is tested separately. The password field defect is independently asserted as a failed security invariant. See [known defects](13_KNOWN_LEGACY_DEFECTS.md); none were fixed in this phase.
