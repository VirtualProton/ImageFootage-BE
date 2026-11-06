# Database relationships

The following relationship map is limited to relationships observable in model methods and migration foreign-key/index declarations. It is not a live ERD.

```mermaid
erDiagram
  imagefootage_users ||--o{ imagefootage_usercart : owns
  imagefootage_users ||--o{ imagefootage_orders : places
  imagefootage_orders ||--o{ imagefootage_order_items : contains
  imagefootage_products ||--o{ imagefootage_order_items : sold_as
  imagefootage_products ||--o{ imagefootage_productimages : has
  imagefootage_products }o--o{ imagefootage_filters : filtered_by
  imagefootage_users ||--o{ imagefootage_users_products_download : authorizes
  imagefootage_products ||--o{ imagefootage_users_products_download : downloaded
  imagefootage_users ||--o{ imagefootage_wishlists : owns
  imagefootage_wishlists ||--o{ imagefootage_wishlist_products : contains
  imagefootage_products ||--o{ imagefootage_wishlist_products : saved
  imagefootage_users ||--o{ imagefootage_user_package : subscribes
  imagefootage_packages ||--o{ imagefootage_user_package : sold
  imagefootage_performa_invoices ||--o{ imagefootage_performa_invoice_items : contains
  imagefootage_roles ||--o{ imagefootage_roles_modules_mapping : grants
  imagefootage_modules ||--o{ imagefootage_roles_modules_mapping : secures
```

The database entity CSV names the migration files, model mappings, and relationship evidence. Foreign-key completeness is unknown because migrations use both explicit constraints and application-level identifiers, and the live schema was not inspected.
