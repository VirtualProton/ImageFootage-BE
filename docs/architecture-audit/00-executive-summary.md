# Executive summary

## Audit status

**COMPLETE for the available repository; PARTIAL for live-system behavior.** The source, configuration, migrations, routes, dependency manifests, tests, Docker/deployment files, and existing documentation were inspected. Live database contents, production queue workers, external API credentials, provider-side webhooks, and production infrastructure remain unverifiable.

## What the application is

ImageFootage is a Laravel 5.8 marketplace/backend for images, footage, music, editorial content, subscriptions/packages, orders, invoices, downloads, wishlists, promotions, and administrator operations. It exposes a large browser/admin surface and a JSON API under `/api`.

## Key measured facts

| Metric | Repository result |
|---|---:|
| Laravel | 5.8.38 locked |
| PHP | `^7.4.33`; local CLI 7.4.33 |
| Registered routes | 426 |
| Unique method/path routes | 426 in the inspected route list |
| API/admin/other routes | 136 / 268 / 22 |
| Controller files | 60 |
| Model files | 65 |
| Migrations | 165 |
| Jobs | 3 |
| Scheduled commands | 2 active, 3 commented |
| Composer packages | 125 production + 35 development locked packages |
| JavaScript lock entries | 1,191 package entries, lockfile v3 |
| Test methods discovered | 2; no test execution was performed against external systems |

## System shape

```mermaid
flowchart LR
  Browser[Browser / admin UI] --> Web[Laravel web routes]
  Client[Frontend/API clients] --> API[/api routes]
  Web --> Controllers[Controllers]
  API --> Controllers
  Controllers --> Models[Eloquent models]
  Controllers --> Providers[Payment, media, search, SMS, mail]
  Models --> MySQL[(MySQL configured)]
  Models --> Mongo[(MongoDB model configured)]
  Jobs[Queue jobs] --> Providers
  Scheduler[Laravel scheduler] --> Commands[Artisan commands]
  Commands --> Models
```

The application is predominantly controller/model driven. Dedicated service code exists for SMS; payment, search, media-provider, and invoice behavior is largely implemented in controllers, models, helpers, and provider wrapper classes.

## Most important limitations

- `config/database.php` contains non-secret fallback database credentials; environment values are expected to override them.
- Payment callbacks are route-visible and provider verification/reconciliation behavior must be checked in the live provider configuration.
- Several state-changing admin actions use GET routes, and provider/import maintenance endpoints are publicly route-registered with only API/CORS middleware.
- The source contains legacy duplicate model/table families and both SQL and MongoDB configuration; the live schema cannot be inferred solely from migrations.
- The default sample queue is synchronous, while jobs implement `ShouldQueue`; production queue operation is therefore environment-dependent.
