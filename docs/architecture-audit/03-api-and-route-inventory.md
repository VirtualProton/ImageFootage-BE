# API and route inventory

## Runtime inventory

`php artisan route:list --json` executed successfully with local PHP 7.4.33 and Laravel 5.8.38. It reported 426 registered entries and 426 unique method/path pairs at audit time:

| Surface | Count | Typical middleware |
|---|---:|---|
| `/api/*` | 136 | `api`, `CORS`, sometimes `jwt.verify` or `auth:api` |
| `/admin/*` | 268 | `web`, `admin`, `check.permission` except login/authentication routes |
| Other/web | 22 | `web`, `guest`, or no additional auth |

`routes.csv` is generated from this runtime route list and includes method, URI, name, action, and middleware. It is the authoritative endpoint-level inventory for this checkout; request validation and business side effects are summarized by controller/module in this document and the workflow documents.

## API categories

- Authentication: signup, login, refresh, logout, social login, OTP, verification, password reset.
- Catalog/search: home, product detail/listing, category products, filters, trending words, Elasticsearch search, editorial content.
- Customer state: profile, address, plan, purchase history, cart, wishlist, contact us.
- Commerce: payment initiation, PayU/Razorpay/Atom callbacks, order details, invoices, promo-code validation.
- Downloads/media: sample download, multiple download, re-download, licence details.
- Provider/import maintenance: Panther Media and Pond5 upload/import routes under `CronController`.

## Authorization observations

JWT-protected API routes explicitly use `jwt.verify`; some routes use Laravel `auth:api`. Admin routes use a session guard plus permission middleware. Public callbacks and some provider/maintenance endpoints are route-registered with only `api,CORS` or `api`, so provider authentication must be established from code/provider configuration rather than assumed.

## Edge cases and route findings

- Resource routes create multiple entries for accounts, users, promo codes, editorials, and price administration.
- There are legacy routes with inconsistent spelling and whitespace, for example `add_product_orientations ` in `routes/web.php`.
- Several destructive/status operations are exposed as GET routes in admin controllers.
- The route list contains a log-viewer route whose generated URI is an opaque token; its exposure depends on the registered provider/configuration.
- Dynamic route usage is limited in the inspected files; `RouteServiceProvider` maps the two main route files and `routes/console.php` is loaded by the console kernel.
