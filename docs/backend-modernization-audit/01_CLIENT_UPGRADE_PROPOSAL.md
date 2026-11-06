# ImageFootage — Existing Backend Technology Modernization and Security Risk Reduction

**Prepared:** 1 November 2026  
**Audit baseline:** Git commit `441f7d89d` (legacy application snapshot)  
**Scope:** Laravel backend repository only; standalone Angular 10 frontend excluded.

## Executive summary

ImageFootage is an existing media marketplace and CRM backend, not a greenfield project. The audited snapshot is a Laravel 5.8.38 application constrained to PHP 7.4.33, with a Node 14.21.3 frontend build stage. It contains substantial business behavior: customer and administrator authentication, catalog and media workflows, search, downloads, packages, quotations, invoices, multiple payment gateways, S3 uploads, Elasticsearch, MongoDB, PDF generation, email, SMS, queues and scheduled/cron-style ingestion.

The urgent issue is the runtime. PHP 7.4 reached upstream end of life on 28 November 2022. PHP published two critical request-handling RCE advisories on 21 October 2026: CVE-2026-109618 and CVE-2026-109619. PHP’s fixed public branches are 8.2.35, 8.3.36, 8.4.27 and 8.5.12. This audit does not establish which runtime is deployed or whether ImageFootage has been exploited; that requires production inventory and log review.

The recommended destination is a supported PHP 8.5 branch with Laravel 13, reached through reviewable Laravel-major checkpoints. Laravel 5.8 → 13 is a compatibility program because the repository uses old authentication middleware, a legacy MongoDB integration, direct SDK calls, hand-built PDF/email flows, custom S3 code, old JavaScript tooling and sparse original tests.

## Before and proposed destination

| Area | Verified legacy baseline | Proposed direction | Status / risk |
|---|---|---|---|
| PHP | 7.4.33 in `composer.json` and `php:7.4.33-fpm` in `Dockerfile` | PHP 8.5 latest fixed patch | High; runtime and extensions must be tested together |
| Laravel | 5.8.38 in `composer.lock` | Laravel 13 latest supported patch | High; eight major checkpoints |
| Node | 14.21.3 Docker build stage | Node 26 LTS, subject to Laravel Mix compatibility test | Medium; build-only, not backend runtime |
| Composer | Composer binary copied from `composer:2` without a pinned digest | Current Composer 2.x, pinned in build/release process | Medium; reproducibility gap |
| JavaScript | Laravel Mix 4, Webpack, Vue 2.7, AngularJS 1.7, Axios, jQuery, Sass, Lodash | Keep the smallest compatible build change; audit active bundles before modernization | Medium/high; do not mix with Angular 10 project |
| Data/integrations | MySQL, MongoDB 3.5.3, Elasticsearch 7.17.3, Redis extension, S3 SDK, FFmpeg, Chromium/Dompdf | Upgrade adapters only after contract tests and environment fixtures | High |

## Why the work takes multiple weeks

The work is not a `composer update` or PHP image change. The repository has roughly 60 controllers, 65 models and 165 migrations, plus route groups for public API, JWT-protected API, admin operations, v2/v3 APIs and ingestion endpoints. Payment callbacks write financial state and also trigger invoice/quotation finalization, PDF rendering, email and storage. A small framework or SDK change can therefore affect money, customer access and evidence required for accounting.

The safe approach is to freeze observable contracts, add characterization tests, upgrade one Laravel major at a time, resolve package replacements deliberately, and accept each checkpoint before continuing. Existing behavior—not new features—is the acceptance target.

## Indicative schedule and investment

Under the stated lean staffing assumption, an optimistic plan is **12–16 calendar weeks** with approximately **520–700 engineering hours** including QA/security allowance. A risk-adjusted plan is **16–22 weeks** and **700–950 hours** if production differences, unavailable integration environments, abandoned packages or payment/PDF regressions appear.

Indicative India commercial range, excluding new features and taxes: **INR 5.0–8.5 lakh + applicable GST** for full backend modernization. A narrowly scoped security/compatibility engagement is approximately **INR 1.5–2.5 lakh + GST**, but it is not equivalent to Laravel 13 modernization.

Suggested options:

| Option | Includes | Indicative range |
|---|---|---:|
| A — Essential security and compatibility | Runtime inventory, fixed PHP deployment, dependency triage, critical smoke/regression tests, emergency rollback | INR 1.5–2.5 lakh |
| B — Full backend modernization | Laravel checkpoints through 13, PHP 8.5, package replacements, regression suite, integrations, staging and deployment runbook | INR 5.0–8.5 lakh |
| C — Phased modernization | Paid checkpoint milestones, each with acceptance evidence and rollback point | INR 5.5–9.0 lakh |

Rates used for planning: INR 1,200–1,800 per engineering hour, or INR 9,600–14,400 per eight-hour day; QA/security and contingency are included in the ranges. Final pricing requires confirmed production topology, credentials-free integration test access, data-volume assumptions and client acceptance criteria.

## Deliverables and exclusions

Deliverables are the audit package, dependency and risk matrices, regression/contract test plan, incremental upgrade branches, updated deployment runbook, staging acceptance evidence and rollback procedure. Excluded are standalone Angular 10 modernization, UI redesign, new marketplace/CRM features, new payment rules, unapproved schema redesign and unrelated infrastructure work.

## Immediate decision

Start a separate runtime exposure assessment immediately; it should not wait for the full Laravel project. Confirm every PHP-FPM/CLI/worker version, patch source, image digest, WAF/proxy controls and logs. Apply a supported fixed PHP release as the first complete remediation, with temporary controls treated only as risk reduction.

## References

- PHP security release: https://www.php.net/archive/2026.php#2026-10-21-5
- PHP supported versions: https://www.php.net/supported-versions.php
- Laravel support policy: https://laravel.com/docs/13.x/releases
- AWS PHP runtime bulletin: https://aws.amazon.com/security/security-bulletins/2026-143-aws/
