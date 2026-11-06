# ImageFootage Security Audit - Executive Summary

Date: 1 November 2026  
Audit target: immutable legacy baseline `441f7d89d`  
Method: read-only static review, dependency metadata review, and configuration review

## Scope and conclusion

This is a source-level security assessment of the legacy Laravel backend. It is not a penetration test, production assessment, or proof of compromise. The current checkout contains later upgrade/remediation work; that mixed state was not used as the legacy security baseline.

The baseline should be treated as release-blocked until the PHP runtime is verified and the critical findings below are contained. The highest-risk issues are:

- PHP 7.4.33 is declared in the baseline Dockerfile and is end-of-life. It is exposed to the PHP 2026 critical runtime advisories unless a vendor-supported backport is proven.
- Repository-controlled AWS credential-like material and default credential values are present. Validity and rotation status were not tested.
- `public/dbc.php` is an Adminer database console under a generic PHP execution rule. Production reachability was not tested.
- A user password-reset path writes the submitted password directly because the relevant password mutator is commented out.
- Several authenticated API operations derive the target user, download ownership, or payment totals from client-controlled request fields.
- Public cron/ingestion and product mutation routes require an explicit authorization review.
- `npm audit` reports 127 vulnerabilities in the locked frontend tree, including direct-package advisories. Composer audit could not run because the installed Composer 2.2.25 does not expose the `audit` command.

## Finding summary

The detailed register contains 17 findings: five confirmed entries (four source-level vulnerabilities/exposures and one dependency-advisory inventory result), ten potential vulnerabilities requiring isolated runtime or fixture validation, and two not-verified controls. Production reachability, credential validity, exploitability, and compromise were not established.

Severity priority:

- Critical: PHP runtime exposure, repository secret exposure, and payment/account-impact paths requiring immediate containment review.
- High: Adminer exposure, plaintext password storage, object-level authorization gaps, public operational routes, upload/SSRF concerns, and dependency advisories.
- Medium: rate limiting, state-changing GET actions, and missing deployment security controls.

## Immediate containment priorities

1. Inventory every deployed PHP binary and FPM/mod_php/Caddy/FrankenPHP/LiteSpeed mode. Move affected internet-reachable runtimes to a fixed supported release and preserve relevant logs.
2. Treat all repository credential-like material as potentially compromised: revoke/rotate through the secret owner, then review access logs. No credential was used by this audit.
3. Remove or deny public access to `public/dbc.php`; verify that the deployed image does not include it.
4. Disable the user password-reset path until passwords are stored with the framework password hasher and reset tokens are protected and rate-limited.
5. Put payment, download, user-profile, cron, and product-mutation routes behind explicit authorization and server-side ownership/amount checks.
6. Build a sanitized staging environment and execute the required payment, authorization, upload, and callback fixtures without contacting live providers.

## Assurance statement

The audit used OWASP ASVS 5.0, OWASP API Security Top 10, CWE mappings, PHP/AWS/GitHub advisory material, and Laravel security guidance. Controls are labeled VERIFIED SECURE, CONFIRMED VULNERABILITY, POTENTIAL VULNERABILITY, NOT VERIFIED, or NOT APPLICABLE in the detailed documents.
