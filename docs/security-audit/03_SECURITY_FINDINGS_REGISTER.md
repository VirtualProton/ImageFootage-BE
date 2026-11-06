# Security Findings Register

Status vocabulary follows `02_DETAILED_SECURITY_AUDIT.md`. IDs are stable across the companion CSV.

| ID | Severity | Classification | Finding | Primary evidence |
|---|---|---|---|---|
| SEC-001 | Critical | POTENTIAL VULNERABILITY | PHP 7.4.33 runtime may be exposed to CVE-2026-109618 and CVE-2026-109619. | `Dockerfile`; `composer.json` |
| SEC-002 | Critical | CONFIRMED VULNERABILITY | Credential-like AWS material is tracked in repository artifacts; validity/rotation unknown. | `- Copy.env:34`; `config/aws.php:20-21` |
| SEC-003 | High | CONFIRMED VULNERABILITY | Public Adminer artifact is present under a generic PHP execution rule. | `public/dbc.php`; `docker/nginx.conf` |
| SEC-004 | Critical | CONFIRMED VULNERABILITY | User password reset writes the submitted password without hashing. | `ChangePasswordController.php:31`; `User.php:258-260` |
| SEC-005 | High | CONFIRMED VULNERABILITY | `/api/me` may serialize password and remember-token attributes because model hiding is commented out. | `AuthController.php:309`; `User.php:26-28,74-76` |
| SEC-006 | High | POTENTIAL VULNERABILITY | Object-level authorization/IDOR risk in profile, plan, address, and download flows. | `routes/api.php`; `UserController.php`; `MediaController.php` |
| SEC-007 | Critical | POTENTIAL VULNERABILITY | Payment amount, discount, tax, and ownership inputs are client-controlled. | `PaymentController.php:440+`; `/api/payment` |
| SEC-008 | High | POTENTIAL VULNERABILITY | Callback finalization lacks visible idempotency, ordering, and transaction safeguards. | `PaymentController.php:1609+` |
| SEC-009 | High | POTENTIAL VULNERABILITY | Cron/ingestion endpoints are in a public API group and can trigger external work and writes. | `routes/api.php:270-284` |
| SEC-010 | High | POTENTIAL VULNERABILITY | Product mutation routes are in the public group and controllers lack visible authorization middleware. | `routes/api.php`; `ProductController.php`; `ProductApiController.php` |
| SEC-011 | High | POTENTIAL VULNERABILITY | Upload validation and filename handling are weak or commented out. | `ProductController.php`; `ProductApiController.php`; `UserContactusController.php:140-189` |
| SEC-012 | High | POTENTIAL VULNERABILITY | Request/media-derived remote reads and PDF assets may enable SSRF or resource exhaustion. | `ProductController.php:1052`; `MediaController.php:792`; `Support/BrowserPdf.php` |
| SEC-013 | Medium | NOT VERIFIED | HTTPS enforcement and security headers are not visible in the repository deployment config. | `docker/nginx.conf`; `Kernel.php` |
| SEC-014 | Medium | POTENTIAL VULNERABILITY | OTP and reset flows use predictable `rand()` values and lack visible endpoint-specific controls. | `AuthController.php:477,580,671` |
| SEC-015 | Medium | POTENTIAL VULNERABILITY | Administrative state changes use GET, creating CSRF/cache/link-trigger risk. | `routes/web.php` |
| SEC-016 | High | CONFIRMED VULNERABILITY | `npm audit` reports 127 locked-tree vulnerabilities, including direct package advisories. | `package.json`; `package-lock.json`; audit output |
| SEC-017 | High | NOT VERIFIED | Composer dependency CVE status could not be verified because Composer 2.2.25 lacks `audit`. | `composer.lock`; command result |

## Required validation

No production exploitation is authorized by this report. Validate the potential findings with synthetic users, isolated payment fixtures, non-routable test URLs, and disposable storage/database resources. Do not use live payment, email, SMS, or customer data.
