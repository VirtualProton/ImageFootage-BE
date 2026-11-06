# ImageFootage Detailed Security Audit

## 1. Audit basis

The primary target is Git commit `441f7d89d`. Evidence was read from that commit with `git show`; the current mixed checkout was inspected only as a separate comparison. No source code, dependency file, lockfile, infrastructure, database, or remote was modified.

The review covered authentication, authorization, API exposure, payment workflows, media/download flows, uploads, storage, external requests, PDF generation, deployment files, secrets, dependencies, tests, and operational routes.

## 2. Classification definitions

- **VERIFIED SECURE:** Evidence and an appropriate safe check support the control for the reviewed scope.
- **CONFIRMED VULNERABILITY:** The source or artifact deterministically demonstrates a security weakness; production reachability may still be unknown.
- **POTENTIAL VULNERABILITY:** A credible weakness is visible, but exploitability, data flow, deployment reachability, or business impact needs isolated validation.
- **NOT VERIFIED:** Evidence was insufficient or the required runtime/service was unavailable.
- **NOT APPLICABLE:** The control does not apply to the reviewed component.

## 3. Application and runtime

| Area | Classification | Evidence and impact |
|---|---|---|
| PHP runtime | POTENTIAL VULNERABILITY | Baseline Dockerfile uses `php:7.4.33-fpm`; PHP 7.4 is EOL and production runtime/backports are unknown. See `04_PHP_CVE_EXPOSURE_ASSESSMENT.md`. |
| Laravel framework | POTENTIAL VULNERABILITY | Baseline is Laravel 5.8.38, outside current security-support expectations. This is a lifecycle risk, not a claim of a specific Laravel CVE. |
| Debug setting | NOT VERIFIED | `config/app.php` defaults debug to false, but deployed environment values were not inspected. |
| Transport and headers | NOT VERIFIED | Nginx listens on port 80 and no local HSTS/CSP/frame headers were identified; an upstream TLS/security-header proxy may exist. |
| Trust proxy | NOT VERIFIED | Private proxy ranges are trusted; the actual proxy chain and forwarded-header behavior were not exercised. |
| CORS | NOT VERIFIED | Fixed origins and credentialed CORS are configured; browser behavior and production origin set were not verified. |

## 4. Authentication and authorization

The API uses JWT middleware and has separate admin authentication. The source shows authentication primitives, but multiple target identifiers are accepted from requests and several routes are public or operationally sensitive.

Confirmed or high-confidence issues are listed in the findings register as SEC-004 and SEC-005. The broader object/function authorization concerns are SEC-006, SEC-009, and SEC-010.

The admin middleware checks the admin guard but does not itself enforce account status or a role matrix. `CheckPermission` permits access when no module identifier is resolved. These controls require an explicit route-to-permission matrix and synthetic account tests.

## 5. Input, output, and injection review

- No `eval`, `exec`, `shell_exec`, `system`, `passthru`, `proc_open`, or `unserialize` sink was found in the reviewed application scan.
- A request-derived product list is interpolated into a `FIND_IN_SET` expression in `FrontuserController.php:415`; safe parameterization and input constraints need fixture validation.
- Remote or request-derived values reach `file_get_contents` in product/media flows and remote PDF asset handling. These are potential SSRF/resource-exhaustion paths, not confirmed exploitable SSRF.
- HTML/PDF generation supports remote assets. The browser process has a timeout, but request size, asset count, network policy, and worker isolation were not verified.

## 6. File upload and media handling

The baseline accepts files with weak or commented validation in several paths. Names are derived from client original names/extensions in product and contact flows. Product and contact uploads therefore require content, size, extension, storage-key, authorization, and malware-handling tests. See SEC-011.

Download/re-download flows derive ownership and target identifiers from fields such as `userData.Utype`, `user_id`, and `id_media`. See SEC-006.

## 7. Payment and business logic

The protected payment endpoint accepts client-derived cart totals, discount values, tax inputs, billing fields, and user token data. Razorpay invoice callbacks include signature verification, which is a positive control, but visible state transitions lack an obvious idempotency/ordering/transaction boundary. See `05_AUTH_AND_PAYMENT_SECURITY.md`.

## 8. Deployment and operational exposure

`public/dbc.php` is tracked and the generic Nginx PHP location would execute any `.php` file under the public root. Public cron/ingestion routes can trigger external work and database writes. Administrative destructive actions use GET in multiple places. These are release-blocking until deployment reachability and authorization are proven safe.

## 9. Positive controls observed

- JWT blacklist is enabled by default in the baseline configuration.
- Razorpay invoice callback code invokes provider signature verification.
- API throttling is present in the Laravel API middleware group, although endpoint-specific limits and authentication coverage are not verified.
- Some database expressions use bound parameters, including the editorial `FIND_IN_SET` query.
- No generic shell execution sink was found in the reviewed application scan.

These positives do not offset the confirmed and potential issues in the register.
