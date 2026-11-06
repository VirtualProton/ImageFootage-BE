# Database architecture

## Configured technologies

`config/database.php` defines MySQL as the default, plus SQLite, PostgreSQL, SQL Server, MongoDB, and Redis configuration. The local `.env-sample` selects MySQL. `ImageFilterValue` explicitly uses the `mongodb` connection; the remaining inspected models are standard Eloquent models unless otherwise configured.

The repository contains 165 migrations. They create or alter a legacy mixture of `imagefootage_*` tables and generic tables. Migrations establish the observable schema history; they do not prove which migrations have run in a deployed database.

## Main entity groups

- Identity/admin: `imagefootage_users`, `imagefootage_userinfo`, `imagefootage_admins`, `imgf_adminusers`, roles, modules, departments, permissions.
- Catalog: `imagefootage_products`, product images, categories/subcategories, filters/options, image attributes, editorial records, licence types.
- Commerce: `imagefootage_usercart`, `imagefootage_orders`, order items, performa invoices/invoice items, payments, packages, user packages, plans/subscriptions, promo codes, promotions, prices.
- Customer engagement: wishlists/lightboxes, comments, contact requests, search/trending words, newsletter/subscribers.
- Operations: jobs, failed jobs, settings, currencies, geographic tables, verification records.

## ORM evidence

Models explicitly declare table names throughout `app/Models`. Relationships are implemented in models such as `Product`, `User`, `Package`, `Orders`, `Invoice`, `Wishlist`, and `Modules`. There are legacy duplicate naming families (`orders` versus `imagefootage_orders`, `products` versus `imagefootage_products`) in migrations; the active model mapping is the source of truth for each model.

Transactions, raw queries, casts, accessors, mutators, soft deletes, and indexes are documented in `database-entities.csv` where statically detectable. No live schema introspection was performed.
