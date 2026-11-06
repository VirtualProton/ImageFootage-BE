# Audit Evidence, Commands and Limitations

## Baseline and method

The audit used Git commit `441f7d89d` as the original legacy snapshot. This is before the later upgrade-plan/remediation work and before the current branch’s audit documents. No application source, Composer constraint, Dockerfile, schema or JavaScript was changed for this audit.

Representative read-only inspection commands:

```text
git ls-tree -r --name-only 441f7d89d
git show 441f7d89d:composer.json
git show 441f7d89d:composer.lock
git show 441f7d89d:Dockerfile
git show 441f7d89d:package.json
git grep -n 'Route::' 441f7d89d -- routes
git ls-tree -r --name-only 441f7d89d -- app/Http/Controllers app/Models database/migrations tests
```

## Evidence summary

| Finding | Source reference | Status |
|---|---|---|
| PHP constraint 7.4.33 | `composer.json:11` | VERIFIED |
| Laravel constraint 5.8.* | `composer.json:20` | VERIFIED |
| Laravel lock 5.8.38 | `composer.lock` package `laravel/framework` | VERIFIED |
| Node 14.21.3 build stage | `Dockerfile` first `FROM` | VERIFIED |
| PHP-FPM 7.4.33 | `Dockerfile` second `FROM` | VERIFIED |
| Mix/Webpack build | `package.json`, `webpack.mix.js` | VERIFIED |
| Vue 2.7 / AngularJS 1.7 | `package.json` | VERIFIED |
| 60 controllers / 65 models / 165 migrations | Git tree counts at baseline | VERIFIED |
| 3 jobs, no events/listeners | Git tree counts at baseline | VERIFIED |
| MySQL/MongoDB/Redis/Elasticsearch/S3/media/PDF | Docker extensions and source references | VERIFIED capability; production use INFERRED |
| Production PHP patch level | Not present in repository | UNKNOWN / REQUIRES PRODUCTION VERIFICATION |
| Production integrations, volumes, queue workers and schedules | Not safely verifiable locally | UNKNOWN / REQUIRES PRODUCTION VERIFICATION |
| Compromise or exploitation | No production logs/hosts inspected | UNKNOWN; no claim of compromise |

## Source map

- `app/Http/Controllers/`: authentication, users, catalog, search, media, payment, invoice, admin and ingestion behavior.
- `app/Models/Common.php`: payment links, PDF generation, S3 upload, email and quotation/invoice orchestration.
- `app/Http/Controllers/PaymentController.php`: payment callbacks, invoice/quotation responses, PDF/email paths.
- `app/Http/Controllers/MediaController.php`: media details, downloads, re-download and authorization-sensitive delivery.
- `app/Http/Controllers/ProductController.php` and `ProductApiController.php`: catalog administration, uploads and S3 operations.
- `app/Http/Middleware/`: admin and JWT middleware requiring route/guard regression tests.
- `routes/api.php`, `routes/web.php`, `routes/console.php`: public/protected APIs, admin routes, previews and scheduled command definitions.
- `database/migrations/`: 165 historical schema changes; no schema redesign is proposed.
- `app/Jobs/`: email and third-party fetch jobs; queue behavior requires worker tests.
- `Dockerfile`: PHP extensions, FFmpeg, Chromium, Redis/MongoDB, Nginx and build stages.
- `resources/js/`, `public/js/`, `public/dist/js/`, `public/new/`: backend-repository JavaScript assets; standalone Angular 10 upgrade is out of scope.

## Official references reviewed

1. PHP security advisory and release notes: https://www.php.net/archive/2026.php#2026-10-21-5
2. GHSA-w8hw-w9fx-j79w: https://github.com/php/php-src/security/advisories/GHSA-w8hw-w9fx-j79w
3. GHSA-6wmf-4rv5-p3rp: https://github.com/php/php-src/security/advisories/GHSA-6wmf-4rv5-p3rp
4. AWS bulletin 2026-143: https://aws.amazon.com/security/security-bulletins/2026-143-aws/
5. PHP support policy: https://www.php.net/supported-versions.php
6. Laravel release/support table: https://laravel.com/docs/13.x/releases
7. Node.js release schedule: https://nodejs.org/en/about/previous-releases
8. Composer downloads and maintenance: https://getcomposer.org/download/

## Limitations and blocked checks

No production network calls, payment charges, real emails/SMS, customer data access, database writes, queue processing against live services or infrastructure changes were performed. A complete vulnerability/package audit of the deployed artifact remains blocked until the owner supplies a sanitized runtime inventory and isolated staging access. The reports intentionally do not turn repository configuration into a claim about production.
