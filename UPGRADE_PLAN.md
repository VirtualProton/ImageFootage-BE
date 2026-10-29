# PHP and Laravel upgrade plan

Prepared: 29 October 2026. Scope: upgrade the existing backend while preserving API contracts, admin workflows, quotations, invoices, payments, email, and media processing.

## Target and approach

- Target PHP **8.5**, latest stable patched release. PHP's current announcement is **8.5.12**; recheck the patch version when implementation begins. Use the same tested version for CLI, FPM, workers, scheduler, CI, and local development.
- Target **Laravel 13**, latest compatible stable patch. Laravel's support table explicitly includes PHP 8.3–8.5 for Laravel 13.
- Upgrade through each Laravel major in a separate reviewable checkpoint. Intermediate unsupported versions are migration environments only, never production destinations.
- Resolve package support before selecting final constraints. A successful Composer resolution alone does not prove application compatibility.
- Deliver the backend upgrade first. Modernize the asset build as needed for deployment; keep a broader Vue/Angular/UI rewrite as a separate project.

Official references: [PHP announcements](https://www.php.net/index.php), [PHP support policy](https://www.php.net/supported-versions.php), [Laravel release/support table](https://laravel.com/docs/13.x/releases).

## Verified project baseline

| Component | Current evidence | Required work |
| --- | --- | --- |
| PHP | Local CLI 7.4.33; Dockerfile uses `php:7.4.33-fpm`; Composer requires `^7.4.33` | Upgrade runtime and PHP extensions together |
| Laravel | `composer.lock`: 5.8.38 | Apply every intervening major upgrade guide |
| MongoDB | Integration 3.5.3; `Jenssegers\\Mongodb` namespace still in application/config | Upgrade integration, namespace, driver, and query behavior |
| Auth | `tymon/jwt-auth` 1.0.2 and custom JWT middleware | Verify supported package path and preserve token behavior |
| Payments | Razorpay 2.9.2; Payumoney wrapper 1.0.4 | Validate SDK support, callbacks, signatures, and duplicate processing |
| PDF/image/media | Dompdf wrapper 0.8.7, Intervention Image 2.7.2, FFmpeg wrapper 4.1.0; Chromium PDF path | Upgrade APIs and verify output visually |
| HTTP/storage/search | Guzzle 6.5.8, AWS Laravel integration 3.8.1, Elasticsearch client 7.17.3 | Resolve compatible packages and verify external service versions |
| Admin/forms/editor | LaravelCollective HTML 5.8.1; UniSharp CKEditor 4.7.2 | Verify target support; replace wrappers if necessary |
| Frontend build | Node 14.21.3 in Docker, Mix 4, Vue 2, AngularJS | Establish a build on a supported Node release; estimate UI migration separately |
| Tests | PHPUnit constraint 7.5; two example tests | Establish business regression coverage before framework changes |
| Deployment | Docker uses Nginx/FPM; CodeDeploy scripts install/start Apache | Confirm active production path and update all active entry points |

Production PHP/FPM, database, search, Redis, OS, queue topology, and deployment versions have not been verified. Repository configuration is not proof of what production currently runs.

## Phase 1 — baseline, recovery, and compatibility inventory

1. Preserve current in-progress changes and create an isolated upgrade branch/worktree from an agreed baseline. Existing local edits in `app/Models/Common.php` and the custom quotation HTML must be preserved.
2. Capture the active runtime topology: web servers, CLI, workers, cron, MySQL, MongoDB, Redis, Elasticsearch, FFmpeg, Chromium, and storage. Record versions without copying credentials into documentation.
3. Build the existing application reproducibly from its lockfiles. Record existing failures, route behavior, representative timings, and PDF/email output.
4. Prepare sanitized staging data. Back up SQL, MongoDB, uploaded assets, and deployment configuration; perform a restore rehearsal. Preserve `APP_KEY` and JWT signing secrets.
5. Create a package matrix for every direct dependency: current lock version, target candidate, PHP/Laravel constraints, maintenance status, breaking API changes, external server compatibility, and replacement decision. Include dev tools.
6. Inspect Composer validation/audit output. Use `composer prohibits php 8.5` and `composer prohibits laravel/framework ^13.0` as diagnostic input, then reassess after each dependency change. Do not bypass platform checks or disable security checks to force installation.

Exit: reproducible baseline, known deployment path, successful restore rehearsal, and a feasible upgrade/replacement decision for every package.

## Phase 2 — protect business behavior

Add meaningful characterization/integration tests using isolated databases, fake mail/storage where appropriate, and payment sandboxes:

- Admin and API login, permissions, JWT issue/refresh/expiry/logout, and unauthorized responses.
- Search/filter/pagination, MongoDB reads/writes, MySQL relationships, and product imports.
- Custom quotation create/edit/replace/cancel/expire; invoice totals, tax, rounding, and status transitions.
- Razorpay payment links, callback/signature verification, PayU success/failure, replayed callbacks, and late payment after quotation expiry. A repeated event must not create duplicate payment records or emails.
- PDF browser rendering and Dompdf fallback: logos, fonts, tables, page breaks, totals, payment links, and attachments. Keep representative reference PDFs/screenshots.
- Email recipients, subjects, custom HTML, attachment content, and queued delivery through a staging mail sink.
- Uploads, image transformations, video processing, S3 downloads, third-party media fetching, scheduler expiry jobs, retries, and failed jobs.

Exit: critical flows pass on the baseline; external services cannot receive real customer emails or charge customers during tests.

## Phase 3 — dependency replacements and framework checkpoints

Use each version's latest suitable patch, with a separate lockfile and passing regression suite at every checkpoint. Adjust bridge runtimes if actual package constraints require it.

| Checkpoint | Migration runtime | Main review focus |
| --- | --- | --- |
| 5.8 → 6 | PHP 7.4 | Removed helpers, package support, authentication changes |
| 6 → 7 | PHP 7.4 | Symfony changes, exception handler signatures, serialization changes |
| 7 → 8 | PHP 7.4 initially | Controller namespace routing, factories/seeders, pagination, job behavior |
| Latest 8 → 9 | PHP 8.0/8.1 bridge supported by selected dependencies | PHP 8 changes, Symfony Mailer, Flysystem 3, proxy middleware |
| 9 → 10 | PHP 8.1 bridge | Monolog 3, model dates/casts, compatible tooling |
| 10 → 11 | PHP 8.2 bridge | Schema changes, database minimums, authentication contracts |
| 11 → 12 | PHP 8.3 bridge | Package constraints, Carbon/date behavior, framework regressions |
| 12 → 13 | PHP 8.3 initially, then PHP 8.5 | Request forgery protection, cache/session behavior, final PHP compatibility |

These bridge versions are isolated build/test tools. Do not expose them publicly. Preserve existing application structure where supported; a new Laravel skeleton is not a prerequisite for upgrading.

Specific work identified in this repository:

- Replace the `str_random(64)` call in `app/Http/Controllers/Admin/ContributorController.php` with the supported `Str::random` API; scan for other removed helpers and PHP APIs.
- Review `app/Providers/RouteServiceProvider.php` to preserve controller namespace resolution and API prefixes. Review custom CORS, JWT, permissions, maintenance, proxy, and CSRF middleware in `app/Http/Kernel.php` at each affected checkpoint.
- Upgrade MongoDB integration using its official guide. Replace `Jenssegers\Mongodb` references with `MongoDB\Laravel` at the appropriate checkpoint; validate ObjectId/date serialization, `id`/`_id`, filters, sorting, and aggregation against real fixtures. Confirm driver/library/server compatibility before changing PECL versions.
- Find and migrate any active SwiftMailer-specific APIs when crossing Laravel 9. Verify mail configuration and embedded images, especially quotation and invoice messages.
- Review S3/Flysystem paths, visibility, URLs, missing-file handling, and stream behavior at Laravel 9.
- Select a JWT package release or replacement proven compatible with Laravel 13/PHP 8.5. Preserve claims, guards, expiry, blacklist behavior, and existing client contracts; test already-issued tokens.
- Treat Payumoney, HTML/form helpers, and CKEditor wrappers as early compatibility investigations. If a wrapper blocks the target, replace its integration with a maintained approach and regression-test affected forms/payment endpoints.
- Select compatible Dompdf, image, FFmpeg, Excel/PhpSpreadsheet, AWS, Google, location, and log-viewer releases. Image package major upgrades may require application API changes. Remove unused direct dependencies only after checking application usage.
- Do not upgrade the Elasticsearch client major independently of the cluster. Check the vendor compatibility matrix and create a separate cluster migration plan if required.
- Upgrade PHPUnit, Mockery, Collision, and Tinker with the framework; migrate PHPUnit XML. Replace obsolete development utilities where necessary, including evaluating `fakerphp/faker` for the current Faker package. Review DBAL and the migrations generator for actual need.
- At the final target, change Composer's PHP/framework constraints to the agreed PHP 8.5 and Laravel 13 ranges, prefer stable packages, and commit the resolved lockfile.

For PHP 8.0 through 8.5, review migration guides for removed APIs, stricter argument/type errors, null passed to internal functions, dynamic properties, return type compatibility, and deprecations. Use PHPCompatibility/static analysis on application code and review proposed automated edits.

Exit per checkpoint: Composer resolves without platform overrides, application boots, routes and commands load, meaningful tests pass, and the lockfile/checkpoint is committed.

## Phase 4 — runtime and build

1. Build a PHP 8.5 FPM image using the latest patched version and a supported base OS; pin the tested image digest for releases. Replace the old Debian snapshot workaround with repositories appropriate for that base.
2. Rebuild required extensions, including MongoDB and Redis. The existing `mongodb-1.16.1` and `redis-5.3.7` pins must be replaced with versions explicitly compatible with PHP 8.5 and selected libraries. Verify all Laravel and package-specific extensions with `composer check-platform-reqs` inside the final image.
3. Verify FFmpeg, Chromium, fonts, certificates, timezone, writable storage, upload limits, memory/timeouts, and queue retry/timeout configuration.
4. Move the asset build to a currently supported Node LTS version after checking its official support schedule. Try the smallest viable build migration; evaluate Mix upgrade versus Vite using actual Vue 2/AngularJS integration requirements. Preserve asset URLs and browser behavior.
5. Update Docker and the active deployment scripts; retire or clearly mark inactive alternatives after confirming production usage. Ensure FPM, workers, and scheduler use the same PHP release and application build.
6. Build assets and install dependencies in CI, then deploy the immutable artifact. Run Composer audit, platform checks, application tests, build checks, and staging integration checks.

Exit: clean build from lockfiles on PHP 8.5, passing platform checks, working assets, and staging workers/scheduler running the target release.

## Phase 5 — staging acceptance and production rollout

1. Test a sanitized production-sized dataset and representative traffic. Compare search results, API shapes, latency, memory, PDF output, and queue throughput with the baseline.
2. Obtain business acceptance for quotation/invoice emails and PDFs, admin forms, payments, search, and media downloads. Run scheduled quotation expiry and long-running jobs explicitly.
3. Keep schema changes backward compatible where possible. Separate destructive schema/data changes from the runtime rollout. Review queue payload compatibility; drain or migrate incompatible jobs before switching consumers.
4. Rehearse deployment and rollback. Record the previous artifact/image, database compatibility, worker stop/start steps, and callback handling. Pause consumption or use a controlled maintenance window if mixed versions cannot operate safely.
5. Deploy the new release, run reviewed migrations if needed, refresh supported configuration caches, and restart FPM/workers/scheduler. Use route caching only if this project's closure routes have been addressed and the cache command passes.
6. Smoke-test login, search, quotation/PDF/email, sandbox payment processing, downloads, and background jobs. Monitor error rate, failed payments, duplicate callbacks, failed jobs, and latency against agreed thresholds through at least a full scheduled-job cycle.
7. Roll back the application artifact on failed acceptance thresholds only while schema/job formats remain compatible. Handle irreversible writes through a reviewed recovery/reconciliation procedure; do not blindly restore an old database over new customer payments/orders.

Final acceptance: all critical tests and business checks pass on PHP 8.5/Laravel 13, deploy/rollback is rehearsed, no unresolved runtime errors or relevant deprecations remain, and dependency security findings are resolved or explicitly assessed with owners.

## Effort and remaining decisions

Planning estimate: **6–10 engineer-weeks**, plus business acceptance and operational scheduling. This is provisional, not a delivery commitment; re-estimate after Phase 1. Payment wrapper replacement, MongoDB behavior changes, limited existing test coverage, and frontend build compatibility are the largest uncertainties.

Suggested allocation: baseline/package investigation 1 week; business regression coverage 1–2 weeks; framework/package checkpoints 2–4 weeks; runtime/build and staging/rollout 2–3 weeks. Some work can overlap.

Before implementation, confirm the production deployment path, external service versions, staging/sandbox availability, required browser support, rollout window, and the owner who accepts payment/quotation behavior.

## Reference guides

- [Laravel 6 upgrade](https://laravel.com/docs/6.x/upgrade)
- [Laravel 7 upgrade](https://laravel.com/docs/7.x/upgrade)
- [Laravel 8 upgrade](https://laravel.com/docs/8.x/upgrade)
- [Laravel 9 upgrade: mail and storage](https://laravel.com/docs/9.x/upgrade)
- [Laravel 10 upgrade](https://laravel.com/docs/10.x/upgrade)
- [Laravel 11 upgrade](https://laravel.com/docs/11.x/upgrade)
- [Laravel 12 upgrade](https://laravel.com/docs/12.x/upgrade)
- [Laravel 13 upgrade](https://laravel.com/docs/13.x/upgrade)
- [MongoDB Laravel integration upgrade](https://www.mongodb.com/docs/drivers/php/laravel-mongodb/current/upgrade/)
- [PHP 8 migration guide](https://www.php.net/manual/en/migration80.php) — follow the subsequent version guides through PHP 8.5.

This document is an implementation plan. No application dependencies, runtime versions, deployment settings, or business code were changed to prepare it.
