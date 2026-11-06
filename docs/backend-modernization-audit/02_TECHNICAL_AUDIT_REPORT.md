# Technical Audit Report

**Evidence baseline:** Git `441f7d89d`  
**Audit date:** 1 November 2026  
**Classification:** repository evidence; production deployment is not verified.

## Evidence status

- **VERIFIED:** directly present in the legacy Git snapshot or dependency lock file.
- **INFERRED:** supported by source references but not proven to be active in production.
- **UNKNOWN / REQUIRES PRODUCTION VERIFICATION:** cannot be established from the repository.

## Verified baseline

| Item | Evidence | Assessment |
|---|---|---|
| PHP | `composer.json:11` requires `^7.4.33`; `Dockerfile` uses `php:7.4.33-fpm` | VERIFIED; upstream EOL |
| Laravel | `composer.json:20` requires `5.8.*`; lock has `v5.8.38` | VERIFIED; security support ended |
| Node | `Dockerfile` frontend stage is `node:14.21.3` | VERIFIED; Node 14 EOL |
| Composer | `Dockerfile` copies Composer from unpinned `composer:2` | VERIFIED; build reproducibility gap |
| Build | `package.json`, `webpack.mix.js` use Laravel Mix 4 / Webpack | VERIFIED |
| Frontend assets | `resources/js/app.js`, `resources/js/bootstrap.js`, compiled `public/js`, `public/dist/js`, `public/new` | VERIFIED in repository; production usage UNKNOWN |
| Tests | Original snapshot contains four test files and PHPUnit 7.5 constraint | VERIFIED; coverage is insufficient for financial/integration scope |
| Deployment | Docker includes Nginx, PHP-FPM, FFmpeg, Chromium, MySQL PDO, GD, Redis and MongoDB extensions | VERIFIED in image recipe; actual production image UNKNOWN |

## Repository inventory

The snapshot contains 60 controller files, 65 model files, 165 migrations, 3 SMS service files, 3 jobs, no `app/Events` or `app/Listeners` classes, five route files and four original test files. Controller responsibilities span authentication, users, contributors, catalog, products, filters, search, media, packages, orders, quotations, invoices, payments, promotions and administration.

Route evidence is concentrated in `routes/api.php` and `routes/web.php`. The API has public auth/search/catalog/payment endpoints, JWT-protected cart/order/download/profile routes, v2/v3 groups, Elasticsearch routes and external-ingestion/cron routes. Web routes include admin login, permission-protected administration, invoice/quotation preview endpoints and resource routes. There are duplicate route declarations such as `verifyOtp`, and a log viewer route whose path is generated from configuration; production access control requires verification.

## Business and technical findings

| Flow | Evidence | Modernization risk | Required verification |
|---|---|---|---|
| Authentication | `routes/api.php`; `AuthController`, `AdminController`, `app/Http/Middleware/JwtMiddleware.php`, `tymon/jwt-auth 1.0.2` | Middleware signatures, guards, serialization and JWT package support can change | Public/protected route matrix, token refresh, disabled-admin behavior, password reset |
| Marketplace catalog/search | `ProductController`, `ProductApiController`, `SearchController`, `ElasticSearchController`, product/filter models | Pagination, query casting, MongoDB namespace/driver behavior, Elasticsearch client compatibility | Search/filter/category/pagination and index contract tests |
| Media | `MediaController`, `ProductController`, `ProductApiController`; S3 multipart upload; FFmpeg wrapper; GD/Intervention | Stream handling, filesystem adapters, image metadata, FFmpeg process paths and permissions | Upload, thumbnail, orientation, video/music preview, download authorization |
| Packages/downloads | `PackageApiController`, `MediaController`, package/download models | Credit/limit and duplicate-download semantics can silently change | Purchase, subscription, credit exhaustion and re-download tests |
| Quotations/invoices | `PaymentController`, `app/Models/Common.php`, invoice views/templates | PDF renderer differences, date/currency/rounding and email attachment behavior | Golden PDF comparisons, totals/GST/discount/currency and attachment tests |
| Payments | `PaymentController`, Razorpay 2.9.2, PayUMoney 1.0.4, Atom-style callbacks | SDK APIs, callback validation, retries and transaction ordering | Signed/unsigned, duplicate, out-of-order, mismatched amount/currency/reference tests |
| Storage/email/SMS | AWS SDK Laravel 3.8.1, direct `S3Client`, Laravel Mail, `SmsService`/`TnnraoSms` | Credentials, stream semantics, mail transport and provider contracts | Private fake sinks, no production sends, upload/delete/email/SMS contract tests |
| Background work | `app/Jobs/SendEmail.php`, `SendPlanEmail.php`, `FetchThirdPartyData.php`; `routes/console.php`; `CronController` | Queue payload serialization, worker retry/failure persistence, scheduler syntax | Queue isolation, retries, failed jobs and cron idempotency |

## Dependency assessment

| Package / current lock | Finding | Proposed action |
|---|---|---|
| `laravel/framework 5.8.38` | EOL major; blocks current PHP/Laravel destination | Upgrade one major at a time |
| `mongodb/laravel-mongodb 3.5.3` | Old integration and legacy namespaces are visible | Select supported MongoDB Laravel driver after query contract inventory |
| `tymon/jwt-auth 1.0.2` | Authentication-critical, old package line | Verify maintained fork/version and preserve token claims/guards |
| `fideloper/proxy` (constraint `^4.0`) | Legacy Laravel package absorbed by framework in newer versions | Remove only at the relevant checkpoint after trusted-proxy tests |
| `barryvdh/laravel-dompdf 0.8.7` | Old PDF wrapper; custom HTML and browser fallback exist | Upgrade/replacement only after golden-output tests |
| `pbmedia/laravel-ffmpeg 4.1.0` | Process and filesystem integration | Verify PHP/framework support and binary behavior |
| `guzzle 6.5.8`, `doctrine/dbal 2.13.9` | Old compatibility lines | Upgrade with SDK and schema-operation tests |
| `elasticsearch 7.17.3` | Client/service compatibility must be checked separately | Preserve index/mapping/query contract; do not assume server upgrade |
| `aws/aws-sdk-php-laravel 3.8.1` | Direct AWS SDK calls occur in controllers/models | Prefer stable adapter boundary; test S3-compatible behavior |
| `razorpay 2.9.2`, `riazxrazor/payumoney 1.0.4` | Financial integrations are high risk; PayUMoney maintenance requires review | Pin compatible versions or replace adapter without changing policy |
| `unisharp/laravel-ckeditor 4.7.2` | Admin editor asset dependency | Confirm admin usage and browser/build compatibility |
| `rap2hpoutre/laravel-log-viewer 2.3.0` | Operational and potentially sensitive route | Restrict/remove only after owner decision and access review |

Composer/npm vulnerability output and actual vendor deployment state require a controlled, credential-free audit environment. The repository lock files alone do not prove production exposure.

## Security findings

PHP’s official 21 October advisory states that CVE-2026-109618 is an out-of-memory corruption path involving partially initialized request data, and CVE-2026-109619 is stale request-owned global state after backing memory is freed. Both can allow unauthenticated RCE in applicable web-worker paths. Fixed releases are PHP 8.2.35, 8.3.36, 8.4.27 and 8.5.12. PHP 7.4 is EOL and is not an upstream supported branch; PHP supplied minimal source backports for EOL builders, while vendors may provide their own backports.

This repository’s PHP 7.4.33 declaration makes it **known affected software at the source-baseline level**, but it does not prove the deployed binary is vulnerable. Production must verify the exact binary, distro package/backport, FPM mode, web server, worker recycling and exposed endpoints. There is no evidence in this audit that ImageFootage was compromised.

Application-level Laravel changes cannot repair a memory-corruption defect in the PHP engine. Emergency controls can reduce particular attack paths, but PHP states that updating is the only complete fix.

## Migration requirements

1. Create a read-only production inventory and backup/rollback rehearsal.
2. Add contract tests before changing framework behavior.
3. Upgrade `5.8 → 6 → 7 → 8 → 9 → 10 → 11 → 12 → 13` in isolated branches.
4. Treat MongoDB, JWT, payment, PDF, media, S3 and Elasticsearch as explicit workstreams.
5. Keep the Laravel Mix/JavaScript track separate from the standalone Angular 10 project.
6. Require checkpoint acceptance: dependency resolution, PHP lint, unit/feature tests, integration fixtures, API snapshots, financial assertions and operational rollback evidence.

## Top risks

| ID | Risk | Likelihood / impact | Mitigation |
|---|---|---|---|
| R1 | Production PHP differs from Docker | High / critical | Runtime inventory and image digest verification |
| R2 | Payment callback or financial total changes | Medium / critical | Provider fakes, signed fixtures, duplicate/out-of-order tests |
| R3 | MongoDB/Elasticsearch adapter incompatibility | High / high | Query inventory and isolated service fixtures |
| R4 | PDF/media output or uploads change | Medium / high | Golden artifacts, synthetic media, S3 emulator |
| R5 | Missing coverage hides API regressions | High / high | Characterization suite and client acceptance matrix |
| R6 | Old packages cannot resolve on PHP 8.5/Laravel 13 | High / high | Replacement decisions per package, not blanket updates |

## Limitations

No production servers, credentials, customer data, payment gateway, SMS, email, S3, MongoDB, Elasticsearch or Redis were contacted. No application code was modified for this audit. The report therefore distinguishes repository capability from verified production behavior.
