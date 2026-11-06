# Project overview

## Stack and bootstrap

The project is a Laravel 5.8 application (`composer.json`, `composer.lock`; locked framework `v5.8.38`) targeting PHP `^7.4.33`. `public/index.php` is the HTTP entry point and `artisan` is the CLI entry point. `bootstrap/app.php` creates the Laravel application; `App\Providers\RouteServiceProvider` maps `routes/web.php` with the `web` middleware and `routes/api.php` with the `api` middleware and `/api` prefix.

`App\Providers\AppServiceProvider` registers `SmsService` as a singleton, forces URL schemes based on environment/host, configures the default schema string length, registers the `@canPermission` Blade conditional, and populates the admin layout with active modules. `ElasticsearchServiceProvider` binds the Elasticsearch client using `ELASTICSEARCH_HOSTS`.

## Important directories

| Directory | Responsibility |
|---|---|
| `app/Http/Controllers` | Public API, frontend, payment, search, media, admin, and cron-style request handlers |
| `app/Models` | Eloquent models, relationships, query helpers, and one MongoDB-connected model |
| `app/Services` | SMS abstraction and Msg91 provider |
| `app/Http/PantherMedia`, `app/Http/Pond5` | Media-provider API wrappers |
| `app/Jobs`, `app/Mail` | Queued work and email messages |
| `app/Console/Commands` | Scheduled/operational Artisan commands |
| `app/Helpers` | Global helper functions and permission logic |
| `config` | Laravel and integration configuration |
| `database/migrations` | 165 schema creation/alteration migrations |
| `routes` | Web, API, broadcast, console, and route-local Apache configuration |
| `resources/views` | Blade frontend/admin/email/PDF views |
| `resources/js`, `resources/sass` | Laravel Mix frontend entry assets |
| `public` | Published static assets and bundled/bower dependencies |
| `docker`, `Dockerfile`, `appspec.yml`, `scripts` | Container and CodeDeploy-style deployment material |

## Application structure

The codebase combines a customer-facing marketplace, an admin panel, and integration/maintenance endpoints in one Laravel application. The admin routes are grouped under `/admin` and use `admin` plus `check.permission`; the API uses `CORS` and selectively `jwt.verify`; browser authentication uses session guards.

## Evidence and unknowns

Verified: repository files and `php artisan route:list --json` on local PHP 7.4.33. Unknown: exact production web-server topology, active environment values, live database schema/data, and whether every legacy route remains used by clients.
