# Security Checklist

| Control | Status | Evidence / next action |
|---|---|---|
| PHP runtime is supported and patched | POTENTIAL VULNERABILITY | Baseline is PHP 7.4.33; inventory and patch runtime. |
| Critical PHP advisories assessed | POTENTIAL VULNERABILITY | Correlate CVE-2026-109618/109619 with deployed runtime; CVE-2026-115560 remains not verified. |
| Secrets are absent from repository artifacts | CONFIRMED VULNERABILITY | Credential-like AWS material found; revoke/rotate and review history. |
| Database consoles are absent from public release | CONFIRMED VULNERABILITY | `public/dbc.php` and generic PHP execution rule require containment. |
| Passwords are hashed | CONFIRMED VULNERABILITY | User reset assigns raw password; isolated regression test required after remediation. |
| Sensitive model fields are hidden | CONFIRMED VULNERABILITY | `/api/me` and commented `$hidden` need response assertion. |
| Object authorization is enforced | POTENTIAL VULNERABILITY | Two-user matrix for IDs, user fields, and downloads. |
| Function authorization is enforced | POTENTIAL VULNERABILITY | Anonymous/low-privilege cron and product mutation tests. |
| Payment totals are server-derived | POTENTIAL VULNERABILITY | Tampered amount/discount/tax fixtures. |
| Payment callbacks are replay-safe | POTENTIAL VULNERABILITY | Duplicate/stale/concurrent callback fixtures. |
| Upload limits/content are enforced | POTENTIAL VULNERABILITY | ASVS V5.2.1 and V5.2.2 evidence required. |
| Compressed upload limits are enforced | NOT VERIFIED | ASVS V5.2.3 fixture/evidence required. |
| SSRF and outbound egress are controlled | POTENTIAL VULNERABILITY | Non-routable URL and PDF asset tests. |
| OTP/reset abuse controls exist | POTENTIAL VULNERABILITY | Rate-limit, expiry, retry, and enumeration tests. |
| HTTPS and response headers are enforced | NOT VERIFIED | Inspect deployed edge and response headers. |
| Dependency CVE inventory is complete | NOT VERIFIED | Run supported Composer audit; triage npm findings. |
| Audit evidence and release decision are recorded | VERIFIED SECURE | This audit bundle and progress entry are present; production evidence remains required. |

## Exact standards used

Exact mapped controls in this checklist are OWASP ASVS 5.0 upload controls V5.2.1, V5.2.2, and V5.2.3, plus OWASP API Security Top 10 categories API1, API2, API4, API5, API6, API7, and API8. CWE mappings are recorded in the findings CSV. No unsupported ASVS identifiers are invented.
