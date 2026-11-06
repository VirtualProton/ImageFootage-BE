# Full database design from migrations

This document is generated from the 165 migration files and explicit model mappings in the current checkout. It describes the repository-declared schema, not necessarily the live database. It records 113 migration-observed table names and schema operations.

## Reading this document

- Column types, nullability, defaults, indexes, keys, and foreign-key references are copied or normalized from migration calls.
- A table may appear in multiple migrations because later migrations alter it.
- Empty or unknown values mean the migration source did not establish that property.
- The full machine-readable version is [database-schema.csv](database-schema.csv).
- Model mappings are based on explicit `protected $table` declarations; implicit/default Eloquent names are marked in the model matrix.

## `admin_sites`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_admin_sites_table.php:16, database/migrations/2023_08_08_051827_create_admin_sites_table.php:17, database/migrations/2023_08_08_051827_create_admin_sites_table.php:18, database/migrations/2023_08_08_051827_create_admin_sites_table.php:19, database/migrations/2023_08_08_051827_create_admin_sites_table.php:20, database/migrations/2023_08_08_051827_create_admin_sites_table.php:21, database/migrations/2023_08_08_051827_create_admin_sites_table.php:22, database/migrations/2023_08_08_051827_create_admin_sites_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `username` | `string(255)` | no |  | username |  |  |
| `password` | `string(255)` | no |  | password |  |  |
| `status` | `integer` | no |  | status |  |  |
| `firstname` | `string(255)` | no |  |  |  |  |
| `lastname` | `string(255)` | no |  |  |  |  |
| `email` | `string(255)` | no |  |  |  |  |

## `admins`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_admins_table.php:16, database/migrations/2023_08_08_051827_create_admins_table.php:17, database/migrations/2023_08_08_051827_create_admins_table.php:18, database/migrations/2023_08_08_051827_create_admins_table.php:19, database/migrations/2023_08_08_051827_create_admins_table.php:20, database/migrations/2023_08_08_051827_create_admins_table.php:21, database/migrations/2023_08_08_051827_create_admins_table.php:22, database/migrations/2023_08_08_051827_create_admins_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `username` | `string(255)` | no |  | username |  |  |
| `password` | `string(255)` | no |  | password |  |  |
| `type` | `enum(['SITE', 'CRMUSERS', 'ADMIN', 'SALES'])` | no | 'SITE' |  |  |  |
| `status` | `integer` | no |  | status |  |  |
| `firstname` | `string(255)` | no |  |  |  |  |
| `lastname` | `string(255)` | no |  |  |  |  |
| `email` | `string(255)` | no |  |  |  |  |
| `add_crm_user` | `integer` | no |  |  |  |  |
| `add_products` | `integer` | no |  |  |  |  |
| `transaction` | `integer` | no |  |  |  |  |
| `abandond_cart_list` | `integer` | no |  |  |  |  |
| `advance_member_search` | `integer` | no |  |  |  |  |
| `search_client_information` | `integer` | no |  |  |  |  |
| `transaction_search` | `integer` | no |  |  |  |  |
| `sale_n_transactions` | `integer` | no |  |  |  |  |
| `performa_invoice_search` | `integer` | no |  |  |  |  |
| `recent_cancelled_transaction` | `integer` | no |  |  |  |  |
| `clientResigestred_list` | `integer` | no |  |  |  |  |
| `download_facility` | `integer` | no |  |  |  |  |
| `download_on_behalf` | `integer` | no |  |  |  |  |
| `low_remaning_credit` | `integer` | no |  |  |  |  |
| `daily_tasks` | `integer` | no |  |  |  |  |
| `add_potential_user` | `integer` | no |  |  |  |  |
| `state` | `string(255)` | no |  |  |  |  |
| `country` | `string(50)` | no |  |  |  |  |
| `countryAcess` | `integer` | no |  |  |  |  |
| `buyerAcess` | `integer` | no |  |  |  |  |
| `contributorAcess` | `integer` | no |  |  |  |  |

## `banners`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_banners_table.php:16, database/migrations/2023_08_08_051827_create_banners_table.php:17, database/migrations/2023_08_08_051827_create_banners_table.php:18, database/migrations/2023_08_08_051827_create_banners_table.php:19, database/migrations/2023_08_08_051827_create_banners_table.php:20, database/migrations/2023_08_08_051827_create_banners_table.php:21, database/migrations/2023_08_08_051827_create_banners_table.php:22, database/migrations/2023_08_08_051827_create_banners_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `title` | `string(255)` | yes |  | title |  |  |
| `banner_image` | `string(255)` | yes |  |  |  |  |
| `url_link` | `string(255)` | yes |  |  |  |  |
| `sort` | `integer` | yes | 0 | sort |  |  |
| `active` | `tinyInteger` | yes | 0 | active |  |  |
| `created` | `dateTime` | yes |  |  |  |  |
| `modified` | `dateTime` | yes |  |  |  |  |

## `categories`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_categories_table.php:16, database/migrations/2023_08_08_051827_create_categories_table.php:17, database/migrations/2023_08_08_051827_create_categories_table.php:18, database/migrations/2023_08_08_051827_create_categories_table.php:19, database/migrations/2023_08_08_051827_create_categories_table.php:20, database/migrations/2023_08_08_051827_create_categories_table.php:21, database/migrations/2023_08_08_051827_create_categories_table.php:22, database/migrations/2023_08_08_051827_create_categories_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `parent_id` | `integer` | yes | 0 | parent_id |  |  |
| `name` | `string(255)` | yes |  | name |  |  |
| `image` | `string(255)` | yes |  |  |  |  |
| `position` | `integer` | yes | 0 | position |  |  |
| `active` | `tinyInteger` | yes | 0 | active |  |  |
| `created` | `dateTime` | yes |  |  |  |  |
| `modified` | `dateTime` | yes |  |  |  |  |

## `categories_products`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_categories_products_table.php:16, database/migrations/2023_08_08_051827_create_categories_products_table.php:17, database/migrations/2023_08_08_051827_create_categories_products_table.php:18, database/migrations/2023_08_08_051827_create_categories_products_table.php:19, database/migrations/2023_08_08_051827_create_categories_products_table.php:21

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigInteger(true)` | no |  |  |  |  |
| `category_id` | `integer` | yes |  | category_id |  |  |
| `product_id` | `integer` | yes |  | product_id |  |  |
| `['category_id` | `constraint:unique` |  |  |  |  |  |

## `cities`

Models: `City`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_cities_table.php:16, database/migrations/2023_08_08_051827_create_cities_table.php:17, database/migrations/2023_08_08_051827_create_cities_table.php:18, database/migrations/2023_08_08_051827_create_cities_table.php:19

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `name` | `string(30)` | no |  |  |  |  |
| `state_id` | `integer` | no |  |  |  |  |

## `client_description`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_061326_create_client_description_table.php:16, database/migrations/2023_08_08_061326_create_client_description_table.php:17, database/migrations/2023_08_08_061326_create_client_description_table.php:18, database/migrations/2023_08_08_061326_create_client_description_table.php:19, database/migrations/2023_08_08_061326_create_client_description_table.php:20

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `user_id` | `integer` | no |  |  |  |  |
| `description` | `text` | no |  |  |  |  |
| `date` | `date` | no |  |  |  |  |

## `company_infos`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_company_infos_table.php:16, database/migrations/2023_08_08_051827_create_company_infos_table.php:17, database/migrations/2023_08_08_051827_create_company_infos_table.php:18, database/migrations/2023_08_08_051827_create_company_infos_table.php:19, database/migrations/2023_08_08_051827_create_company_infos_table.php:20, database/migrations/2023_08_08_051827_create_company_infos_table.php:21, database/migrations/2023_08_08_051827_create_company_infos_table.php:22, database/migrations/2023_08_08_051827_create_company_infos_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `title` | `string(250)` | no | '' |  |  |  |
| `address1` | `string(250)` | no | '' |  |  |  |
| `address2` | `string(250)` | no | '' |  |  |  |
| `twitter` | `string(250)` | no | '' |  |  |  |
| `facebook` | `string(250)` | no | '' |  |  |  |
| `linkedin` | `string(250)` | no | '' |  |  |  |
| `youtube` | `string(250)` | no | '' |  |  |  |
| `pinterest` | `string(250)` | yes |  |  |  |  |
| `googleplus` | `string(250)` | no | '' |  |  |  |
| `fax` | `string(250)` | no | '' |  |  |  |
| `contact` | `string(250)` | no | '' |  |  |  |
| `landline` | `string(50)` | no |  |  |  |  |
| `contactemail` | `string(50)` | no |  |  |  |  |
| `alternateemail` | `string(200)` | no | '' |  |  |  |
| `logo` | `string(255)` | no |  |  |  |  |
| `icon` | `string(255)` | no |  |  |  |  |
| `created` | `dateTime` | yes |  |  |  |  |
| `modified` | `dateTime` | yes |  |  |  |  |
| `insta` | `string(250)` | yes |  |  |  |  |

## `contents`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_contents_table.php:16, database/migrations/2023_08_08_051827_create_contents_table.php:17, database/migrations/2023_08_08_051827_create_contents_table.php:18, database/migrations/2023_08_08_051827_create_contents_table.php:19, database/migrations/2023_08_08_051827_create_contents_table.php:20, database/migrations/2023_08_08_051827_create_contents_table.php:21, database/migrations/2023_08_08_051827_create_contents_table.php:22, database/migrations/2023_08_08_051827_create_contents_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `category_type` | `integer` | yes |  |  |  |  |
| `name` | `string(255)` | yes |  | name |  |  |
| `permalink` | `string(255)` | yes |  | permalink |  |  |
| `description` | `text` | yes |  |  |  |  |
| `meta_title` | `string(255)` | yes |  |  |  |  |
| `meta_description` | `text` | yes |  |  |  |  |
| `meta_keywords` | `text` | yes |  |  |  |  |
| `sort` | `integer` | yes |  | sort |  |  |
| `active` | `integer` | yes | 0 | active |  |  |
| `created` | `dateTime` | yes |  |  |  |  |
| `modified` | `dateTime` | yes |  |  |  |  |

## `countries`

Models: `Country`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_countries_table.php:16, database/migrations/2023_08_08_051827_create_countries_table.php:17, database/migrations/2023_08_08_051827_create_countries_table.php:18, database/migrations/2023_08_08_051827_create_countries_table.php:19, database/migrations/2023_08_08_051827_create_countries_table.php:20

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `code` | `string(3)` | no |  |  |  |  |
| `name` | `string(150)` | no |  |  |  |  |
| `phonecode` | `integer` | no |  |  |  |  |

## `coupons`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_coupons_table.php:16, database/migrations/2023_08_08_051827_create_coupons_table.php:17, database/migrations/2023_08_08_051827_create_coupons_table.php:18, database/migrations/2023_08_08_051827_create_coupons_table.php:19, database/migrations/2023_08_08_051827_create_coupons_table.php:20, database/migrations/2023_08_08_051827_create_coupons_table.php:21, database/migrations/2023_08_08_051827_create_coupons_table.php:22, database/migrations/2023_08_08_051827_create_coupons_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `code` | `string(255)` | no |  |  |  |  |
| `from_date` | `string(255)` | no |  |  |  |  |
| `to_date` | `string(255)` | no |  |  |  |  |
| `coupon_value` | `string(255)` | no |  |  |  |  |
| `maximum_uses` | `integer` | yes |  |  |  |  |
| `number_of_uses` | `integer` | yes |  |  |  |  |
| `coupon_type` | `string(255)` | no |  |  |  |  |
| `description` | `text` | no |  |  |  |  |
| `active` | `string(255)` | no |  |  |  |  |
| `used_by_users` | `string(255)` | yes |  |  |  |  |

## `crm_products`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_crm_products_table.php:16, database/migrations/2023_08_08_051827_create_crm_products_table.php:17, database/migrations/2023_08_08_051827_create_crm_products_table.php:18, database/migrations/2023_08_08_051827_create_crm_products_table.php:19, database/migrations/2023_08_08_051827_create_crm_products_table.php:20, database/migrations/2023_08_08_051827_create_crm_products_table.php:21, database/migrations/2023_08_08_051827_create_crm_products_table.php:22, database/migrations/2023_08_08_051827_create_crm_products_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `product_code` | `string(100)` | no |  |  |  |  |
| `name` | `string(100)` | no |  |  |  |  |
| `keywords` | `string(100)` | no |  |  |  |  |
| `description` | `text` | yes |  |  |  |  |
| `product_type` | `string(50)` | no |  |  |  |  |
| `subscription_type` | `integer` | no |  |  |  |  |
| `type` | `string(50)` | no |  |  |  |  |
| `video_type` | `string(50)` | no |  |  |  |  |
| `product_image` | `string(250)` | no |  |  |  |  |
| `product_video` | `string(250)` | no |  |  |  |  |
| `thumbnail_image` | `string(100)` | yes |  |  |  |  |
| `featured_product` | `integer` | no |  |  |  |  |
| `new_product` | `integer` | no |  |  |  |  |
| `popular_product` | `integer` | no |  |  |  |  |
| `rating` | `double(10, 1)` | no |  |  |  |  |
| `active` | `integer` | no |  |  |  |  |
| `small_size` | `string(50)` | no |  |  |  |  |
| `medium_size` | `string(50)` | no |  |  |  |  |
| `large_size` | `string(50)` | no |  |  |  |  |
| `x-large_size` | `string(50)` | no |  |  |  |  |
| `user_post` | `string(100)` | no |  |  |  |  |
| `user_id` | `string(100)` | no |  |  |  |  |
| `created` | `dateTime` | no |  |  |  |  |
| `modified` | `dateTime` | no |  |  |  |  |

## `currency_convertes`

Models: `Currency`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_currency_convertes_table.php:16, database/migrations/2023_08_08_051827_create_currency_convertes_table.php:17, database/migrations/2023_08_08_051827_create_currency_convertes_table.php:18, database/migrations/2023_08_08_051827_create_currency_convertes_table.php:19, database/migrations/2023_08_08_051827_create_currency_convertes_table.php:20

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `name` | `string(30)` | no |  |  |  |  |
| `cur_value` | `string(100)` | yes |  |  |  |  |
| `markup` | `integer` | no |  |  |  |  |

## `discount_messages`

Models: `DiscountMessage`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_discount_messages_table.php:16, database/migrations/2023_08_08_051827_create_discount_messages_table.php:17, database/migrations/2023_08_08_051827_create_discount_messages_table.php:18, database/migrations/2023_08_08_051827_create_discount_messages_table.php:19, database/migrations/2023_08_08_051827_create_discount_messages_table.php:20, database/migrations/2023_08_08_051827_create_discount_messages_table.php:21, database/migrations/2023_08_08_051827_create_discount_messages_table.php:22, database/migrations/2023_08_08_051827_create_discount_messages_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigInteger(true)` | no |  |  |  |  |
| `page_type` | `string(255)` | no |  |  |  |  |
| `title` | `string(255)` | no |  |  |  |  |
| `description` | `text` | yes |  |  |  |  |
| `link` | `string(255)` | no |  |  |  |  |
| `button_text` | `string(255)` | no |  |  |  |  |
| `status` | `integer` | no |  |  |  |  |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |

## `email_templates`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_email_templates_table.php:16, database/migrations/2023_08_08_051827_create_email_templates_table.php:17, database/migrations/2023_08_08_051827_create_email_templates_table.php:18, database/migrations/2023_08_08_051827_create_email_templates_table.php:19, database/migrations/2023_08_08_051827_create_email_templates_table.php:20, database/migrations/2023_08_08_051827_create_email_templates_table.php:21, database/migrations/2023_08_08_051827_create_email_templates_table.php:22, database/migrations/2023_08_08_051827_create_email_templates_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `draft_name` | `string(255)` | yes |  |  |  |  |
| `from_email` | `string(255)` | yes |  |  |  |  |
| `from_name` | `string(255)` | yes |  |  |  |  |
| `subject` | `string(255)` | yes |  |  |  |  |
| `content` | `longText` | yes |  |  |  |  |
| `logo` | `string(100)` | yes |  |  |  |  |
| `type` | `enum(['1', '2', '3'])` | yes |  |  |  | '1->Registration ,2->Invoice,3->Orders' |

## `failed_jobs`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2024_03_22_104400_create_failed_jobs_table.php:16, database/migrations/2024_03_22_104400_create_failed_jobs_table.php:17, database/migrations/2024_03_22_104400_create_failed_jobs_table.php:18, database/migrations/2024_03_22_104400_create_failed_jobs_table.php:19, database/migrations/2024_03_22_104400_create_failed_jobs_table.php:20, database/migrations/2024_03_22_104400_create_failed_jobs_table.php:21, database/migrations/2024_03_22_104400_create_failed_jobs_table.php:22

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigIncrements` | no |  |  |  |  |
| `connection` | `text` | no |  |  |  |  |
| `queue` | `text` | no |  |  |  |  |
| `payload` | `longText` | no |  |  |  |  |
| `exception` | `longText` | no |  |  |  |  |
| `failed_at` | `timestamp` | no |  |  |  |  |

## `imagefootage_accounts`

Models: `Account`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_accounts_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_accounts_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_accounts_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_accounts_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_accounts_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_accounts_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_accounts_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_accounts_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigInteger(true)` | no |  |  |  |  |
| `account_name` | `string(100)` | no |  |  |  |  |
| `phone` | `string(20)` | no |  |  |  |  |
| `email` | `string(100)` | no |  |  |  |  |
| `website` | `string(200)` | yes |  |  |  |  |
| `bill_address` | `text` | yes |  |  |  |  |
| `bill_city` | `integer` | yes |  |  |  |  |
| `bill_state` | `integer` | yes |  |  |  |  |
| `bill_country` | `integer` | yes |  |  |  |  |
| `bill_postal` | `bigInteger` | yes |  |  |  |  |
| `industry_type_id` | `integer` | yes |  |  |  |  |
| `curruncy_id` | `integer` | yes |  |  |  |  |
| `global_region` | `enum(['AS', 'UAE', 'US', 'AU', 'UK'])` | yes |  |  |  |  |
| `status` | `integer` | yes | 1 |  |  |  |
| `domestic_region` | `enum(['IN'])` | yes |  |  |  |  |
| `created_at` | `dateTime` | yes |  |  |  |  |
| `updated_at` | `timestamp` | no |  |  |  |  |
| `contact_name` | `string` | yes |  |  |  |  |
| `title` | `string` | yes |  |  |  |  |
| `mobile` | `string` | yes |  |  |  |  |
| `bank_name` | `string` | yes |  |  |  |  |
| `account_holder_name` | `string` | yes |  |  |  |  |
| `account_number` | `string` | yes |  |  |  |  |
| `ifsc` | `string` | yes |  |  |  |  |

## `imagefootage_admins`

Models: `Admin`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_admins_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_admins_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_admins_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_admins_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_admins_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_admins_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_admins_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_admins_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigIncrements` | no |  |  |  |  |
| `name` | `string` | yes |  |  |  |  |
| `password` | `string` | no |  |  |  |  |
| `email` | `string` | no |  |  |  |  |
| `mobile` | `string` | yes |  |  |  |  |
| `address` | `string` | yes |  |  |  |  |
| `lastlogin` | `dateTime` | yes |  |  |  |  |
| `department_id` | `integer` | no |  |  |  |  |
| `role_id` | `integer` | no |  |  |  |  |
| `admin_status` | `enum(['A', 'I'])` | no | 'A' |  |  |  |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |
| `country` | `string` | yes |  |  |  |  |
| `state` | `string` | yes |  |  |  |  |

## `imagefootage_adminusers_old`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_adminusers_old_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_adminusers_old_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_adminusers_old_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_adminusers_old_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_adminusers_old_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_adminusers_old_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_adminusers_old_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_adminusers_old_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `admin_id` | `bigIncrements` | no |  |  |  |  |
| `admin_name` | `string(255)` | yes |  |  |  |  |
| `admin_password` | `string(255)` | yes |  |  |  |  |
| `admin_email` | `string(255)` | yes |  |  |  |  |
| `admin_mobile` | `string(255)` | yes |  |  |  |  |
| `admin_address` | `string(255)` | yes |  |  |  |  |
| `admin_created_at` | `dateTime` | yes |  |  |  |  |
| `admin_lastlogin` | `dateTime` | yes |  |  |  |  |
| `admin_type` | `enum(['Super', 'Sub', 'Agent'])` | no | 'Agent' |  |  |  |
| `admin_status` | `enum(['Active', 'Inactive'])` | no | 'Active' |  |  |  |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |

## `imagefootage_api`

Models: `Api`, `ApiQuota`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_api_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_api_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_api_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_api_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_api_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_api_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_api_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_api_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `api_id` | `integer(true)` | no |  |  |  |  |
| `api_provider` | `string(100)` | yes |  |  |  |  |
| `detail` | `string(100)` | yes |  |  |  |  |
| `api_slug` | `string(255)` | yes |  |  |  |  |
| `api_amount` | `integer` | yes |  |  |  |  |
| `api_flag` | `string(5)` | yes |  |  |  |  |
| `created_at` | `dateTime` | no |  |  |  |  |
| `updated_at` | `dateTime` | no |  |  |  |  |

## `imagefootage_comments`

Models: `Comment`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_comments_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_comments_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_comments_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_comments_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_comments_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_comments_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_comments_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_comments_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigIncrements` | no |  |  |  |  |
| `user_id` | `integer` | yes |  |  |  |  |
| `agent_id` | `integer` | yes |  |  |  |  |
| `status` | `string` | yes |  |  |  |  |
| `subject` | `string` | yes |  |  |  |  |
| `comment` | `string` | yes |  |  |  |  |
| `expiry` | `date` | yes |  |  |  |  |
| `created_by` | `integer` | yes |  |  |  |  |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |

## `imagefootage_contributor`

Models: `Contributor`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_contributor_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_contributor_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_contributor_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_contributor_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_contributor_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_contributor_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_contributor_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_contributor_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `contributor_id` | `bigIncrements` | no |  |  |  |  |
| `contributor_memberid` | `string` | yes |  |  |  |  |
| `contributor_name` | `string` | yes |  |  |  |  |
| `contributor_email` | `string` | yes |  |  |  |  |
| `contributor_otp` | `string(225)` | yes |  |  |  |  |
| `contributor_password` | `string` | yes |  |  |  |  |
| `contributor_idproof` | `string(225)` | yes |  |  |  |  |
| `contributor_type` | `enum(['Donor', 'For Sale'])` | no | 'For Sale' |  |  |  |
| `contributor_last_login` | `dateTime` | yes |  |  |  |  |
| `contributor_added_on` | `dateTime` | yes |  |  |  |  |
| `contributor_status` | `enum(['Active', 'Inactive'])` | no | 'Inactive' |  |  |  |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |
| `contributor_addedby` | `string(225)` | yes |  |  |  |  |
| `contributor_accountholder` | `string(300)` | yes |  |  |  |  |
| `contributor_banknumber` | `string(300)` | yes |  |  |  |  |
| `contributor_ifsc` | `string(300)` | yes |  |  |  |  |
| `contributor_bank` | `string(300)` | yes |  |  |  |  |
| `contributor_mobile` | `string(250)` | yes |  |  |  |  |
| `email_verification` | `string(255)` | yes |  |  |  |  |
| `is_mobile_verified` | `integer` | yes | 0 |  |  |  |
| `is_email_verified` | `integer` | yes | 0 |  |  |  |

## `imagefootage_crm_products`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_crm_products_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_crm_products_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_crm_products_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_crm_products_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_crm_products_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_crm_products_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_crm_products_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_crm_products_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `product_code` | `string(100)` | no |  |  |  |  |
| `api_product_id` | `bigInteger` | yes |  |  |  |  |
| `name` | `string(100)` | no |  |  |  |  |
| `keywords` | `string(100)` | no |  |  |  |  |
| `description` | `text` | yes |  |  |  |  |
| `product_type` | `string(50)` | no |  |  |  |  |
| `subscription_type` | `integer` | no |  |  |  |  |
| `type` | `string(50)` | no |  |  |  |  |
| `video_type` | `string(50)` | no |  |  |  |  |
| `product_image` | `string(250)` | no |  |  |  |  |
| `product_video` | `string(250)` | no |  |  |  |  |
| `thumbnail_image` | `string(100)` | yes |  |  |  |  |
| `featured_product` | `integer` | no |  |  |  |  |
| `new_product` | `integer` | no |  |  |  |  |
| `popular_product` | `integer` | no |  |  |  |  |
| `rating` | `double(10, 1)` | no |  |  |  |  |
| `active` | `integer` | no |  |  |  |  |
| `small_size` | `string(50)` | no |  |  |  |  |
| `medium_size` | `string(50)` | no |  |  |  |  |
| `large_size` | `string(50)` | no |  |  |  |  |
| `x_large_size` | `string(50)` | no |  |  |  |  |
| `user_post` | `string(100)` | no |  |  |  |  |
| `user_id` | `string(100)` | no |  |  |  |  |
| `created` | `dateTime` | no |  |  |  |  |
| `modified` | `dateTime` | no |  |  |  |  |
| `product_web` | `integer` | yes |  |  |  |  |

## `imagefootage_departments`

Models: `Department`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_departments_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_departments_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_departments_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_departments_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_departments_table.php:20

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigIncrements` | no |  |  |  |  |
| `department` | `string` | no |  |  |  |  |
| `status` | `enum(['A', 'I'])` | no | 'A' |  |  | 'A=>Active,I=>Inactiive' |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |

## `imagefootage_description`

Models: `Description`  
Migration operations: create, table  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_description_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_description_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_description_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_description_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_description_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_description_table.php:21, database/migrations/2023_10_09_094056_change_id_column_type_to_imagefootage_description_table.php:16, database/migrations/2023_10_09_094056_change_id_column_type_to_imagefootage_description_table.php:28

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer` | no |  |  |  |  |
| `user_id` | `integer` | no |  |  |  |  |
| `description` | `text` | no |  |  |  |  |
| `created_at` | `timestamp` | no |  |  |  |  |
| `updated_at` | `timestamp` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `` | `` |  |  |  |  |  |

## `imagefootage_editorials`

Models: `Editorial`  
Migration operations: create  
Evidence: database/migrations/2023_08_21_142648_create_imagefootage_editorials_table.php:11, database/migrations/2023_08_21_142648_create_imagefootage_editorials_table.php:12, database/migrations/2023_08_21_142648_create_imagefootage_editorials_table.php:13, database/migrations/2023_08_21_142648_create_imagefootage_editorials_table.php:14, database/migrations/2023_08_21_142648_create_imagefootage_editorials_table.php:15, database/migrations/2023_08_21_142648_create_imagefootage_editorials_table.php:16, database/migrations/2023_08_21_142648_create_imagefootage_editorials_table.php:17, database/migrations/2023_08_21_142648_create_imagefootage_editorials_table.php:18

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `title` | `string` | yes |  |  |  |  |
| `type` | `enum(['story', 'collection'])` | no |  |  |  |  |
| `search_term` | `string` | yes |  |  |  |  |
| `selected_values` | `text` | yes |  |  |  |  |
| `main_image_id` | `string(50)` | yes |  |  |  |  |
| `main_image_selected_values` | `text` | yes |  |  |  |  |
| `main_image_upload` | `string` | yes |  |  |  |  |
| `status` | `tinyInteger` | no | 0 |  |  |  |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |

## `imagefootage_filters`

Models: `ImageFootageFilter`  
Migration operations: create, table  
Evidence: database/migrations/2023_09_04_072817_create_imagefootage_filters_table.php:16, database/migrations/2023_09_04_072817_create_imagefootage_filters_table.php:17, database/migrations/2023_09_04_072817_create_imagefootage_filters_table.php:18, database/migrations/2023_09_04_072817_create_imagefootage_filters_table.php:19, database/migrations/2023_09_04_072817_create_imagefootage_filters_table.php:20, database/migrations/2023_09_04_072817_create_imagefootage_filters_table.php:21, database/migrations/2023_09_04_072817_create_imagefootage_filters_table.php:22, database/migrations/2023_09_04_072817_create_imagefootage_filters_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigIncrements` | no |  |  |  |  |
| `name` | `string` | no |  |  |  |  |
| `value` | `string` | no |  | value |  |  |
| `type` | `string` | no |  | type |  | 'image, footage, music, editorial (page type |
| `sort_order` | `integer` | no | 1 |  |  |  |
| `status` | `enum(['active', 'inactive'])` | no | 'active' |  |  |  |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |
| `` | `` |  |  |  |  |  |
| `filter_type` | `integer` | yes | 1 |  |  | '1->single,2->multiple' |
| `` | `` |  |  |  |  |  |
| `filter_type` | `dropColumn` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `default_filter_type` | `integer` | yes | 0 |  |  | '1->default filter,0->not default' |
| `` | `` |  |  |  |  |  |
| `default_filter_type` | `dropColumn` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `has_multiple_values` | `boolean` | no | false |  |  |  |
| `` | `` |  |  |  |  |  |
| `has_multiple_values` | `dropColumn` | no |  |  |  |  |

## `imagefootage_filters_options`

Models: `ImageFootageFilterOption`  
Migration operations: create, table  
Evidence: database/migrations/2023_09_04_072835_create_imagefootage_filters_options_table.php:16, database/migrations/2023_09_04_072835_create_imagefootage_filters_options_table.php:17, database/migrations/2023_09_04_072835_create_imagefootage_filters_options_table.php:18, database/migrations/2023_09_04_072835_create_imagefootage_filters_options_table.php:19, database/migrations/2023_09_04_072835_create_imagefootage_filters_options_table.php:20, database/migrations/2023_09_04_072835_create_imagefootage_filters_options_table.php:21, database/migrations/2023_09_04_072835_create_imagefootage_filters_options_table.php:22, database/migrations/2023_09_04_072835_create_imagefootage_filters_options_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigIncrements` | no |  |  |  |  |
| `filter_id` | `unsignedBigInteger` | no |  |  |  |  |
| `option_name` | `string` | no |  |  |  |  |
| `value` | `string` | no |  |  |  |  |
| `sort_order` | `integer` | no | 1 |  |  |  |
| `status` | `enum(['active', 'inactive'])` | no | 'active' |  |  |  |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |
| `filter_id` | `constraint:foreign` |  |  | id |  |  |
| `` | `` |  |  |  |  |  |
| `is_group_value` | `string(50)` | yes |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `is_group_value` | `dropColumn` | no |  |  |  |  |

## `imagefootage_keywords`

Models: `Keywords`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_keywords_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_keywords_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_keywords_table.php:18

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `name` | `string(255)` | no |  |  |  |  |

## `imagefootage_modules`

Models: `Modules`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_modules_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_modules_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_modules_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_modules_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_modules_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_modules_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_modules_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_modules_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigIncrements` | no |  |  |  |  |
| `module_name` | `string` | no |  |  |  |  |
| `url` | `string(200)` | yes |  |  |  |  |
| `parent_module_id` | `integer` | no |  |  |  |  |
| `status` | `enum(['A', 'I'])` | no | 'A' |  |  | '1=>Active,0=>Inactiive' |
| `sort_order` | `integer` | yes |  |  |  |  |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |
| `module_icon` | `string(250)` | yes |  |  |  |  |

## `imagefootage_modules_old20082020`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_modules_old20082020_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_modules_old20082020_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_modules_old20082020_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_modules_old20082020_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_modules_old20082020_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_modules_old20082020_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_modules_old20082020_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_modules_old20082020_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigIncrements` | no |  |  |  |  |
| `module_name` | `string` | no |  |  |  |  |
| `url` | `string(200)` | yes |  |  |  |  |
| `parent_module_id` | `integer` | no |  |  |  |  |
| `status` | `enum(['A', 'I'])` | no | 'A' |  |  | '1=>Active,0=>Inactiive' |
| `sort_order` | `integer` | yes |  |  |  |  |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |
| `module_icon` | `string(250)` | yes |  |  |  |  |

## `imagefootage_order_items`

Models: `OrderItem`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_order_items_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_order_items_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_order_items_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_order_items_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_order_items_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_order_items_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_order_items_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_order_items_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigIncrements` | no |  |  |  |  |
| `order_id` | `bigInteger` | yes |  |  |  |  |
| `product_id` | `string` | yes |  |  |  |  |
| `product_type` | `string` | yes |  |  |  |  |
| `standard_type` | `string(255)` | yes |  |  |  |  |
| `standard_size` | `string(255)` | yes |  |  |  |  |
| `standard_price` | `decimal(10, 2)` | yes |  |  |  |  |
| `extended_name` | `string(255)` | yes |  |  |  |  |
| `extended_price` | `decimal(10, 2)` | yes |  |  |  |  |
| `total` | `decimal(10, 2)` | yes |  |  |  |  |
| `product_name` | `string(255)` | yes |  |  |  |  |
| `product_thumb` | `string(255)` | yes |  |  |  |  |
| `product_desc` | `text` | yes |  |  |  |  |
| `selected_product` | `text` | yes |  |  |  |  |
| `product_json` | `text` | yes |  |  |  |  |
| `footage_tier` | `integer` | yes |  |  |  |  |
| `product_web` | `integer` | yes |  |  |  |  |
| `token` | `text` | yes |  |  |  |  |
| `cart_added_by` | `string` | yes |  |  |  |  |
| `cart_added_on` | `dateTime` | yes |  |  |  |  |

## `imagefootage_orders`

Models: `Orders`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_orders_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_orders_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_orders_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_orders_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_orders_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_orders_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_orders_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_orders_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `user_id` | `integer` | yes |  |  |  |  |
| `txn_id` | `bigInteger` | yes |  |  |  |  |
| `plan_id` | `integer` | yes |  |  |  |  |
| `invoice` | `string(100)` | yes |  |  |  |  |
| `download_plan_id` | `string(50)` | yes |  |  |  |  |
| `download_plan_title` | `string(50)` | yes |  |  |  |  |
| `tax` | `decimal(10, 2)` | yes |  |  |  |  |
| `tax_selected` | `text` | yes |  |  |  |  |
| `coupon_code` | `string(100)` | yes |  |  |  |  |
| `coupon_type` | `string(50)` | yes |  |  |  |  |
| `coupon_value` | `double` | yes |  |  |  |  |
| `coupon_discount` | `double` | yes |  |  |  |  |
| `order_total` | `decimal(10, 2)` | yes |  |  |  |  |
| `order_date` | `date` | yes |  |  |  |  |
| `order_status` | `text` | yes |  |  |  |  |
| `order_title` | `string(100)` | yes |  |  |  |  |
| `order_cancel_status` | `string(100)` | yes |  |  |  |  |
| `order_type` | `integer` | yes |  |  |  |  |
| `order_email` | `string(100)` | yes |  |  |  |  |
| `ip` | `string(100)` | yes |  |  |  |  |
| `payment_mode` | `string(100)` | yes |  |  |  |  |
| `order_comments` | `text` | yes |  |  |  |  |
| `bill_firstname` | `string(100)` | yes |  |  |  |  |
| `bill_lastname` | `string(100)` | yes |  |  |  |  |
| `bill_address1` | `string(100)` | yes |  |  |  |  |
| `bill_address2` | `string(100)` | yes |  |  |  |  |
| `bill_city` | `string(100)` | yes |  |  |  |  |
| `bill_state` | `string(100)` | yes |  |  |  |  |
| `bill_zip` | `string(100)` | yes |  |  |  |  |
| `bill_country` | `string(100)` | yes |  |  |  |  |
| `bill_phone` | `string(100)` | yes |  |  |  |  |
| `created_at` | `dateTime` | no |  |  |  |  |
| `updated_at` | `dateTime` | no |  |  |  |  |
| `invoice_type` | `string(100)` | yes |  |  |  |  |
| `expiry_invoices` | `integer` | yes |  |  |  |  |
| `deletion_date` | `string(200)` | yes |  |  |  |  |
| `invoice_closed` | `integer` | yes |  |  |  |  |
| `paymentgatway` | `string(100)` | yes |  |  |  |  |
| `response_payment` | `text` | yes |  |  |  |  |
| `rozor_pay_id` | `string(255)` | yes |  |  |  |  |

## `imagefootage_packages`

Models: `Package`  
Migration operations: create, table  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_packages_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_packages_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_packages_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_packages_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_packages_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_packages_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_packages_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_packages_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `package_id` | `bigIncrements` | no |  |  |  |  |
| `package_name` | `string` | yes |  |  |  |  |
| `package_price` | `decimal(10, 2)` | yes |  |  |  |  |
| `package_description` | `string` | yes |  |  |  |  |
| `package_products_count` | `integer` | yes |  |  |  |  |
| `package_type` | `string` | yes |  |  |  |  |
| `package_added_on` | `dateTime` | yes |  |  |  |  |
| `package_expiry` | `integer` | yes |  |  |  |  |
| `package_addedby` | `string` | yes |  |  |  |  |
| `package_status` | `enum(['Active', 'Inactive'])` | no | 'Inactive' |  |  |  |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |
| `package_plan` | `string(225)` | yes |  |  |  |  |
| `package_permonth_download` | `integer` | yes |  |  |  |  |
| `package_pcarry_forward` | `string(225)` | yes |  |  |  |  |
| `package_expiry_yearly` | `string(225)` | yes |  |  |  |  |
| `pacage_size` | `integer` | yes | 0 |  |  | '0->all,1->HD,2->4k' |
| `footage_tier` | `integer` | yes |  |  |  | '1->Commercial,2-> Non Commercial,3->Web,4->Full RF Licence' |
| `home_view` | `tinyInteger` | no | 1 |  |  |  |
| `package_expiry_quarterly` | `integer` | yes |  |  |  |  |
| `package_expiry_half_yearly` | `integer` | yes |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `display_for` | `tinyInteger` | yes |  |  |  | '1=Frontend,2=Backend,3=All' |
| `` | `` |  |  |  |  |  |
| `display_for` | `dropColumn` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `currency` | `string` | yes | 'INR' |  |  | 'Currency: INR or USD' |
| `` | `` |  |  |  |  |  |
| `currency` | `dropColumn` | no |  |  |  |  |

## `imagefootage_performa_invoice_items`

Models: `InvoiceItem`  
Migration operations: create, table  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_performa_invoice_items_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_performa_invoice_items_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_performa_invoice_items_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_performa_invoice_items_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_performa_invoice_items_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_performa_invoice_items_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_performa_invoice_items_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_performa_invoice_items_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `invoice_id` | `integer` | yes |  |  |  |  |
| `user_id` | `string(50)` | yes |  |  |  |  |
| `product_id` | `string(100)` | yes |  |  |  |  |
| `type` | `string` | yes |  |  |  |  |
| `product_type` | `string(50)` | yes |  |  |  |  |
| `product_size` | `string(50)` | yes |  |  |  |  |
| `product_image` | `string(255)` | yes |  |  |  |  |
| `subtotal` | `decimal(10, 2)` | yes |  |  |  |  |
| `product_subscription` | `integer` | yes |  |  |  |  |
| `plan_id` | `string(50)` | yes |  |  |  |  |
| `status` | `integer` | yes |  |  |  |  |
| `product_web` | `string(100)` | yes |  |  |  |  |
| `action` | `string(100)` | yes |  |  |  |  |
| `catTitle1` | `string(100)` | yes | '' |  |  |  |
| `catTitle2` | `string(100)` | yes |  |  |  |  |
| `catTitle3` | `string(100)` | yes |  |  |  |  |
| `catTitle4` | `string(100)` | yes |  |  |  |  |
| `catTitle5` | `string(100)` | yes |  |  |  |  |
| `catTitle6` | `string(100)` | yes |  |  |  |  |
| `catTitle7` | `string(100)` | yes |  |  |  |  |
| `catValue1` | `string(100)` | yes |  |  |  |  |
| `catValue2` | `string(100)` | yes |  |  |  |  |
| `catValue3` | `string(100)` | yes |  |  |  |  |
| `catValue4` | `string(100)` | yes |  |  |  |  |
| `catValue5` | `string(100)` | yes |  |  |  |  |
| `catValue6` | `string(100)` | yes |  |  |  |  |
| `catValue7` | `string(100)` | yes |  |  |  |  |
| `duration` | `string(100)` | yes |  |  |  |  |
| `start_date` | `string(100)` | yes |  |  |  |  |
| `end_date` | `string(100)` | yes |  |  |  |  |
| `teritery_type` | `string(100)` | yes |  |  |  |  |
| `teritery1` | `string(100)` | yes |  |  |  |  |
| `teritery2` | `string(100)` | yes |  |  |  |  |
| `teritery3` | `string(100)` | yes |  |  |  |  |
| `userindustry` | `string(100)` | yes |  |  |  |  |
| `username` | `string(100)` | yes |  |  |  |  |
| `created_at` | `dateTime` | yes |  |  |  |  |
| `modified_at` | `dateTime` | yes |  |  |  |  |
| `purchase_product` | `integer` | yes |  |  |  |  |
| `licence_type` | `longText` | yes |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `extra_details` | `text` | yes |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `extra_details` | `dropColumn` | no |  |  |  |  |

## `imagefootage_performa_invoices`

Models: `Invoice`  
Migration operations: create, table  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_performa_invoices_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_performa_invoices_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_performa_invoices_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_performa_invoices_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_performa_invoices_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_performa_invoices_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_performa_invoices_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_performa_invoices_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `user_id` | `integer` | no |  |  |  |  |
| `email_id` | `string(100)` | yes |  |  |  |  |
| `invoice_name` | `string(100)` | yes |  |  |  |  |
| `promo_code_id` | `integer` | yes |  |  |  |  |
| `package_id` | `integer` | yes |  |  |  |  |
| `created` | `dateTime` | no |  |  |  |  |
| `modified` | `dateTime` | no |  |  |  |  |
| `status` | `integer` | no | 0 |  |  | '(0-pending,1-approve,2-purched,3-cancel' |
| `mode` | `string(100)` | yes |  |  |  |  |
| `job_number` | `string(100)` | yes |  |  |  |  |
| `promo_code` | `string(100)` | yes |  |  |  |  |
| `tax` | `decimal(10, 2)` | yes |  |  |  |  |
| `tax_selected` | `text` | yes |  |  |  |  |
| `total` | `decimal(10, 2)` | yes |  |  |  |  |
| `quotation_id` | `integer` | yes |  |  |  |  |
| `invoice_type` | `integer` | yes |  |  |  | '(1-subscriber,2-download,3-custom |
| `proforma_type` | `integer` | yes |  |  |  | '(1-quotation,2-invoice |
| `expiry_invoices` | `integer` | yes |  |  |  |  |
| `address` | `string(100)` | yes |  |  |  |  |
| `address1` | `string(100)` | yes |  |  |  |  |
| `country` | `string(110)` | yes |  |  |  |  |
| `state` | `string(110)` | yes |  |  |  |  |
| `city` | `string(110)` | yes |  |  |  |  |
| `zipcode` | `string(50)` | yes |  |  |  |  |
| `cancel_date` | `dateTime` | yes |  |  |  |  |
| `invoice_closed` | `integer` | yes |  |  |  |  |
| `po_detail` | `string(100)` | yes |  |  |  |  |
| `po_image` | `string(100)` | yes |  |  |  |  |
| `date_close` | `dateTime` | yes |  |  |  |  |
| `action_comment` | `text` | yes |  |  |  |  |
| `quotation_url` | `text` | yes |  |  |  |  |
| `invoice_url` | `text` | yes |  |  |  |  |
| `payment_status` | `string(50)` | yes |  |  |  |  |
| `payment_method` | `string(50)` | yes |  |  |  |  |
| `payment_response` | `text` | yes |  |  |  |  |
| `payment_mode` | `string(50)` | yes |  |  |  |  |
| `invoice_created` | `dateTime` | yes |  |  |  |  |
| `payment_date` | `dateTime` | yes |  |  |  |  |
| `created_by` | `bigInteger` | yes |  |  |  |  |
| `created_at` | `dateTime` | yes |  |  |  |  |
| `updated_at` | `dateTime` | yes |  |  |  |  |
| `flag` | `integer` | yes |  |  |  |  |
| `end_client` | `string(255)` | yes |  |  |  |  |
| `expiry_due_date` | `integer` | yes |  |  |  |  |
| `cancelled_by` | `integer` | yes |  |  |  | 'cancelled by user id, if null then cancelled by cron' |
| `cancelled_on` | `dateTime` | yes |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `payment_by` | `integer` | no | '1' |  |  | 'payment by 1- frontend 0- backend' |
| `` | `` |  |  |  |  |  |
| `payment_by` | `dropColumn` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `currency` | `string` | yes | 'INR' |  |  | 'Currency: INR or USD' |
| `` | `` |  |  |  |  |  |
| `currency` | `dropColumn` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `user_id` | `constraint:index` |  |  |  |  |  |
| `invoice_type` | `constraint:index` |  |  |  |  |  |
| `proforma_type` | `constraint:index` |  |  |  |  |  |
| `payment_status` | `constraint:index` |  |  |  |  |  |
| `cancelled_by` | `constraint:index` |  |  |  |  |  |
| `['user_id` | `constraint:index` |  |  |  |  |  |
| `['user_id` | `constraint:index` |  |  |  |  |  |
| `['user_id` | `constraint:index` |  |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `idx_performa_user_id` | `dropIndex` | no |  |  |  |  |
| `idx_performa_invoice_type` | `dropIndex` | no |  |  |  |  |
| `idx_performa_proforma_type` | `dropIndex` | no |  |  |  |  |
| `idx_performa_payment_status` | `dropIndex` | no |  |  |  |  |
| `idx_performa_cancelled_by` | `dropIndex` | no |  |  |  |  |
| `idx_performa_user_proforma` | `dropIndex` | no |  |  |  |  |
| `idx_performa_user_type` | `dropIndex` | no |  |  |  |  |
| `idx_performa_user_flag_type` | `dropIndex` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `expiry_due_date` | `dateTime` | yes |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `expiry_due_date` | `integer` | yes |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `discount_amount` | `float` | yes | null |  |  |  |
| `` | `` |  |  |  |  |  |
| `discount_amount` | `dropColumn` | no |  |  |  |  |

## `imagefootage_prices`

Models: `Price`  
Migration operations: create  
Evidence: database/migrations/2025_12_13_000000_create_imagefootage_prices_table.php:20, database/migrations/2025_12_13_000000_create_imagefootage_prices_table.php:21, database/migrations/2025_12_13_000000_create_imagefootage_prices_table.php:22, database/migrations/2025_12_13_000000_create_imagefootage_prices_table.php:23, database/migrations/2025_12_13_000000_create_imagefootage_prices_table.php:24, database/migrations/2025_12_13_000000_create_imagefootage_prices_table.php:25, database/migrations/2025_12_13_000000_create_imagefootage_prices_table.php:26, database/migrations/2025_12_13_000000_create_imagefootage_prices_table.php:27

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigIncrements` | no |  |  |  |  |
| `license_type` | `unsignedBigInteger` | no |  |  |  | 'License Type' |
| `product_type` | `string(255)` | no |  |  |  | 'Product Type' |
| `small_image_price` | `decimal(10, 2)` | yes |  |  |  | 'Price for small image' |
| `medium_image_price` | `decimal(10, 2)` | yes |  |  |  | 'Price for medium image' |
| `large_image_price` | `decimal(10, 2)` | yes |  |  |  | 'Price for large image' |
| `extra_large_image_price` | `decimal(10, 2)` | yes |  |  |  | 'Price for extra large image' |
| `music_price` | `decimal(10, 2)` | yes |  |  |  | 'Price for music' |
| `high_resolution_footage_price` | `decimal(10, 2)` | yes |  |  |  | 'Price for high resolution footage' |
| `4k_footage_price` | `decimal(10, 2)` | yes |  |  |  | 'Price for 4K footage' |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |

## `imagefootage_product_age_wises`

Models: `ProductAgeWises`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_product_age_wises_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_product_age_wises_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_product_age_wises_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_product_age_wises_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_product_age_wises_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_product_age_wises_table.php:21

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigInteger(true)` | no |  |  |  |  |
| `name` | `string(100)` | yes |  |  |  |  |
| `status` | `enum(['0', '1'])` | yes | '1' |  |  |  |
| `created_at` | `dateTime` | yes |  |  |  |  |
| `updated_at` | `timestamp` | no |  |  |  |  |

## `imagefootage_product_colors`

Models: `ProductColors`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_product_colors_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_product_colors_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_product_colors_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_product_colors_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_product_colors_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_product_colors_table.php:21

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigInteger(true)` | no |  |  |  |  |
| `name` | `string(100)` | yes |  |  |  |  |
| `status` | `enum(['0', '1'])` | yes | '1' |  |  |  |
| `created_at` | `dateTime` | yes |  |  |  |  |
| `updated_at` | `timestamp` | no |  |  |  |  |

## `imagefootage_product_ethinicities`

Models: `ProductEthinicities`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_product_ethinicities_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_product_ethinicities_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_product_ethinicities_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_product_ethinicities_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_product_ethinicities_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_product_ethinicities_table.php:21

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigInteger(true)` | no |  |  |  |  |
| `name` | `string(100)` | yes |  |  |  |  |
| `status` | `enum(['0', '1'])` | yes | '1' |  |  |  |
| `created_at` | `dateTime` | yes |  |  |  |  |
| `updated_at` | `timestamp` | no |  |  |  |  |

## `imagefootage_product_genders`

Models: `ProductGenders`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_product_genders_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_product_genders_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_product_genders_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_product_genders_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_product_genders_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_product_genders_table.php:21

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigInteger(true)` | no |  |  |  |  |
| `name` | `string(100)` | yes |  |  |  |  |
| `status` | `enum(['0', '1'])` | yes | '1' |  |  |  |
| `created_at` | `dateTime` | yes |  |  |  |  |
| `updated_at` | `timestamp` | no |  |  |  |  |

## `imagefootage_product_image_resolutions`

Models: `ImageResolution`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_product_image_resolutions_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_product_image_resolutions_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_product_image_resolutions_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_product_image_resolutions_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_product_image_resolutions_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_product_image_resolutions_table.php:21

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigInteger(true)` | no |  |  |  |  |
| `name` | `string(100)` | yes |  |  |  |  |
| `status` | `enum(['0', '1'])` | yes | '1' |  |  |  |
| `created_at` | `dateTime` | yes |  |  |  |  |
| `updated_at` | `timestamp` | no |  |  |  |  |

## `imagefootage_product_image_sizes`

Models: `ProductImageSizes`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_product_image_sizes_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_product_image_sizes_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_product_image_sizes_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_product_image_sizes_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_product_image_sizes_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_product_image_sizes_table.php:21

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigInteger(true)` | no |  |  |  |  |
| `name` | `string(100)` | yes |  |  |  |  |
| `status` | `enum(['0', '1'])` | yes | '1' |  |  |  |
| `created_at` | `dateTime` | yes |  |  |  |  |
| `updated_at` | `timestamp` | no |  |  |  |  |

## `imagefootage_product_image_types`

Models: `ProductImageTypes`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_product_image_types_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_product_image_types_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_product_image_types_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_product_image_types_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_product_image_types_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_product_image_types_table.php:21

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigInteger(true)` | no |  |  |  |  |
| `name` | `string(100)` | yes |  |  |  |  |
| `status` | `enum(['0', '1'])` | yes | '1' |  |  |  |
| `created_at` | `dateTime` | yes |  |  |  |  |
| `updated_at` | `timestamp` | no |  |  |  |  |

## `imagefootage_product_locations`

Models: `ProductLocations`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_product_locations_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_product_locations_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_product_locations_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_product_locations_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_product_locations_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_product_locations_table.php:21

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigInteger(true)` | no |  |  |  |  |
| `name` | `string(100)` | yes |  |  |  |  |
| `status` | `enum(['0', '1'])` | yes | '1' |  |  |  |
| `created_at` | `dateTime` | yes |  |  |  |  |
| `updated_at` | `timestamp` | no |  |  |  |  |

## `imagefootage_product_orientations`

Models: `ProductOrientations`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_product_orientations_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_product_orientations_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_product_orientations_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_product_orientations_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_product_orientations_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_product_orientations_table.php:21

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigInteger(true)` | no |  |  |  |  |
| `name` | `string(100)` | yes |  |  |  |  |
| `status` | `enum(['0', '1'])` | yes | '1' |  |  |  |
| `created_at` | `dateTime` | yes |  |  |  |  |
| `updated_at` | `timestamp` | no |  |  |  |  |

## `imagefootage_product_peoples`

Models: `ProductPeoples`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_product_peoples_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_product_peoples_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_product_peoples_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_product_peoples_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_product_peoples_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_product_peoples_table.php:21

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigInteger(true)` | no |  |  |  |  |
| `name` | `string(100)` | yes |  |  |  |  |
| `status` | `enum(['0', '1'])` | yes | '1' |  |  |  |
| `created_at` | `dateTime` | yes |  |  |  |  |
| `updated_at` | `timestamp` | no |  |  |  |  |

## `imagefootage_product_sort_types`

Models: `ImageSortTypes`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_product_sort_types_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_product_sort_types_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_product_sort_types_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_product_sort_types_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_product_sort_types_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_product_sort_types_table.php:21

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigInteger(true)` | no |  |  |  |  |
| `name` | `string(100)` | yes |  |  |  |  |
| `status` | `enum(['0', '1'])` | yes | '1' |  |  |  |
| `created_at` | `dateTime` | yes |  |  |  |  |
| `updated_at` | `timestamp` | no |  |  |  |  |

## `imagefootage_productcategory`

Models: `ProductCategory`  
Migration operations: create, table  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_productcategory_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_productcategory_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_productcategory_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_productcategory_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_productcategory_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_productcategory_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_productcategory_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_productcategory_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `category_id` | `bigIncrements` | no |  |  |  |  |
| `category_name` | `string` | yes |  |  |  |  |
| `category_order` | `integer` | yes |  |  |  |  |
| `category_added_by` | `string` | yes |  |  |  |  |
| `is_display_home` | `integer` | yes | 0 |  |  |  |
| `category_status` | `enum(['Active', 'Inactive'])` | no | 'Inactive' |  |  |  |
| `category_added_on` | `dateTime` | yes |  |  |  |  |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |
| `category_keywords` | `string(300)` | yes |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `product_id` | `string(50)` | no |  |  |  |  |
| `image_path` | `string(255)` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `product_id` | `dropColumn` | no |  |  |  |  |
| `image_path` | `dropColumn` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `category_slug` | `longText` | yes |  |  |  |  |
| `type` | `integer` | no | 1 |  |  | "1=>image, 2=>footage, 3=>music" |
| `` | `` |  |  |  |  |  |
| `category_slug` | `dropColumn` | no |  |  |  |  |
| `type` | `dropColumn` | no |  |  |  |  |

## `imagefootage_productfilters`

Models: `ProductFilters`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_productfilters_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_productfilters_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_productfilters_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_productfilters_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_productfilters_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_productfilters_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_productfilters_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_productfilters_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `filter_id` | `bigIncrements` | no |  |  |  |  |
| `filter_product_id` | `integer` | yes |  |  |  |  |
| `filter_type` | `string` | yes |  |  |  |  |
| `filter_type_id` | `string` | yes |  |  |  |  |
| `filter_added_by` | `string` | yes |  |  |  |  |
| `filter_added_on` | `dateTime` | yes |  |  |  |  |
| `filter_updated_on` | `dateTime` | yes |  |  |  |  |

## `imagefootage_productimages`

Models: `ProductImages`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_productimages_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_productimages_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_productimages_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_productimages_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_productimages_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_productimages_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_productimages_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_productimages_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `image_id` | `bigIncrements` | no |  |  |  |  |
| `image_name` | `string` | yes |  |  |  |  |
| `image_product_id` | `string(225)` | yes |  |  |  |  |
| `image_added_on` | `dateTime` | yes |  |  |  |  |
| `image_added_by` | `integer` | yes |  |  |  |  |
| `image_status` | `enum(['Active', 'Inactive'])` | no | 'Inactive' |  |  |  |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |

## `imagefootage_products`

Models: `Product`  
Migration operations: create, table  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_products_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_products_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_products_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_products_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_products_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_products_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_products_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_products_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigIncrements` | no |  |  |  |  |
| `product_id` | `string` | yes |  |  |  |  |
| `api_product_id` | `bigInteger` | yes |  | api_product_id |  |  |
| `product_category` | `bigInteger` | yes |  |  |  |  |
| `product_subcategory` | `string` | yes |  |  |  |  |
| `product_owner` | `string(255)` | yes |  |  |  |  |
| `product_title` | `text` | yes |  |  |  |  |
| `product_vertical` | `string` | yes |  |  |  |  |
| `product_keywords` | `text` | yes |  |  |  |  |
| `product_description` | `text` | yes |  |  |  |  |
| `product_thumbnail` | `string(255)` | yes |  |  |  |  |
| `product_main_image` | `string(255)` | yes |  |  |  |  |
| `product_release_details` | `string` | yes |  |  |  |  |
| `product_price_small` | `decimal(10, 2)` | yes |  |  |  |  |
| `product_price_medium` | `decimal(10, 2)` | yes |  |  |  |  |
| `product_price_large` | `decimal(10, 2)` | yes |  |  |  |  |
| `product_price_extralarge` | `decimal(10, 2)` | yes |  |  |  |  |
| `product_size` | `string` | yes |  |  |  |  |
| `product_added_by` | `string` | yes |  |  |  |  |
| `product_status` | `enum(['Active', 'Inactive'])` | no | 'Inactive' |  |  |  |
| `product_main_type` | `enum(['Image', 'Footage', 'Editorial'])` | no | 'Image' |  |  |  |
| `product_sub_type` | `enum(['Footage', 'Vector', 'Photo', 'Illustrator'])` | no | 'Photo' |  |  |  |
| `product_added_on` | `dateTime` | yes |  |  |  |  |
| `product_verification` | `string(225)` | yes |  |  |  |  |
| `product_rejectod_reason` | `string(225)` | yes |  |  |  |  |
| `product_editedby` | `string(300)` | yes |  |  |  |  |
| `product_web` | `integer` | yes | 1 |  |  | '1->imagefootage,2->panthermedia,3->pond5' |
| `license_type` | `string(225)` | yes | 'standard' |  |  |  |
| `width_thumb` | `integer` | yes |  |  |  |  |
| `height_thumb` | `integer` | yes |  |  |  |  |
| `thumb_update_status` | `integer` | yes | 1 |  |  |  |
| `created_at` | `timestamp` | yes |  |  |  |  |
| `updated_at` | `timestamp` | yes |  |  |  |  |
| `['product_id` | `constraint:index` |  |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `product_main_type` | `enum(array('Image', 'Footage', 'Editorial', 'Music')` | no |  |  |  |  |
| `product_sub_type` | `enum(array('Footage', 'Vector', 'Photo', 'Illustrator', 'Music')` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `music_sound_bpm` | `string` | yes |  |  |  |  |
| `music_duration` | `string` | yes |  |  |  |  |
| `music_fileType` | `string` | yes |  |  |  |  |
| `music_price` | `decimal(10, 2)` | yes |  |  |  |  |
| `music_size` | `string` | yes |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `music_sound_bpm` | `dropColumn` | no |  |  |  |  |
| `music_duration` | `dropColumn` | no |  |  |  |  |
| `music_fileType` | `dropColumn` | no |  |  |  |  |
| `music_price` | `dropColumn` | no |  |  |  |  |
| `music_size` | `dropColumn` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `auther_name` | `string` | yes |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `auther_name` | `dropColumn` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `adult_content` | `string` | yes | 'no' |  |  |  |
| `` | `` |  |  |  |  |  |
| `adult_content` | `dropColumn` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `music_sound_bpm` | `dropColumn` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `music_sound_bpm` | `string` | yes |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `slug` | `longText` | yes |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `slug` | `dropColumn` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `is_premium` | `enum([0, 1])` | no | 0 |  |  | '1=>for premium product, 0=>regular product' |
| `` | `` |  |  |  |  |  |
| `is_premium` | `dropColumn` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `product_server_activation` | `enum(['active', 'inactive'])` | no | 'active' |  |  |  |
| `` | `` |  |  |  |  |  |
| `product_server_activation` | `dropColumn` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `view_count` | `integer` | no | 0 |  |  |  |
| `` | `` |  |  |  |  |  |
| `view_count` | `dropColumn` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `search_terms` | `text` | yes |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `search_terms` | `dropColumn` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `expired_date` | `dateTime` | yes |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `expired_date` | `dropColumn` | no |  |  |  |  |

## `imagefootage_productsubcategory`

Models: `ProductSubCategory`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_productsubcategory_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_productsubcategory_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_productsubcategory_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_productsubcategory_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_productsubcategory_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_productsubcategory_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_productsubcategory_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_productsubcategory_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `subcategory_id` | `bigIncrements` | no |  |  |  |  |
| `category_id` | `string` | yes |  |  |  |  |
| `subcategory_name` | `string` | yes |  |  |  |  |
| `subcategory_order` | `string` | yes |  |  |  |  |
| `subcategory_added_by` | `string` | yes |  |  |  |  |
| `subcategory_added_on` | `dateTime` | yes |  |  |  |  |
| `subcategory_status` | `enum(['Active', 'Inactive'])` | no | 'Inactive' |  |  |  |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |

## `imagefootage_promotion`

Models: `Promotion`  
Migration operations: create, table  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_promotion_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_promotion_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_promotion_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_promotion_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_promotion_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_promotion_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_promotion_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_promotion_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer` | no |  |  |  |  |
| `event_name` | `string(255)` | no |  |  |  |  |
| `media_url` | `text` | no |  |  |  |  |
| `event_des` | `text` | no |  |  |  |  |
| `status` | `enum(['1', '0'])` | no | '1' |  |  |  |
| `created_at` | `timestamp` | yes |  |  |  |  |
| `updated_at` | `timestamp` | yes |  |  |  |  |
| `page_type` | `string(20)` | yes |  |  |  |  |
| `desktop_banner_image` | `string(255)` | yes |  |  |  |  |
| `mobile_banner_image` | `string(255)` | yes |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `media_type` | `string(255)` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `product_name` | `string(255)` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `media_type` | `dropColumn(255)` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `product_name` | `dropColumn(255)` | no |  |  |  |  |

## `imagefootage_roles`

Models: `Roles`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_roles_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_roles_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_roles_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_roles_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_roles_table.php:20

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigIncrements` | no |  |  |  |  |
| `role` | `string` | no |  |  |  |  |
| `status` | `enum(['A', 'I'])` | no | 'A' |  |  | '1=>Active,0=>Inactiive' |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |

## `imagefootage_roles_modules_mapping`

Models: `RolesModulesMapping`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_roles_modules_mapping_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_roles_modules_mapping_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_roles_modules_mapping_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_roles_modules_mapping_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_roles_modules_mapping_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_roles_modules_mapping_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_roles_modules_mapping_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_roles_modules_mapping_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigIncrements` | no |  |  |  |  |
| `department_id` | `integer` | yes |  |  |  |  |
| `role_id` | `integer` | no |  |  |  |  |
| `module_id` | `integer` | no |  |  |  |  |
| `can_add` | `smallInteger` | no |  |  |  |  |
| `can_edit` | `smallInteger` | no |  |  |  |  |
| `can_view` | `smallInteger` | no |  |  |  |  |
| `can_delete` | `smallInteger` | no |  |  |  |  |
| `status` | `enum(['A', 'I'])` | no | 'A' |  |  | '1=>Active,0=>Inactiive' |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |

## `imagefootage_shared_wishlists_logs`

Models: `ImagefootageSharedWishlistsLog`  
Migration operations: create  
Evidence: database/migrations/2023_08_23_033310_create_imagefootage_shared_wishlists_logs_table.php:16, database/migrations/2023_08_23_033310_create_imagefootage_shared_wishlists_logs_table.php:17, database/migrations/2023_08_23_033310_create_imagefootage_shared_wishlists_logs_table.php:18, database/migrations/2023_08_23_033310_create_imagefootage_shared_wishlists_logs_table.php:19, database/migrations/2023_08_23_033310_create_imagefootage_shared_wishlists_logs_table.php:20, database/migrations/2023_08_23_033310_create_imagefootage_shared_wishlists_logs_table.php:21, database/migrations/2023_08_23_033310_create_imagefootage_shared_wishlists_logs_table.php:22, database/migrations/2023_08_23_033310_create_imagefootage_shared_wishlists_logs_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigIncrements` | no |  |  |  |  |
| `shared_by_user_id` | `unsignedBigInteger` | no |  |  |  |  |
| `shared_wishlist_id` | `unsignedBigInteger` | no |  |  |  |  |
| `shared_with_user_id` | `unsignedBigInteger` | no |  |  |  |  |
| `new_wishlist_id` | `unsignedBigInteger` | no |  |  |  |  |
| `shared_product_ids` | `text` | yes |  |  |  |  |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |
| `shared_by_user_id` | `constraint:foreign` |  |  | id |  |  |
| `shared_wishlist_id` | `constraint:foreign` |  |  | id |  |  |
| `shared_with_user_id` | `constraint:foreign` |  |  | id |  |  |
| `new_wishlist_id` | `constraint:foreign` |  |  | id |  |  |

## `imagefootage_staticpages`

Models: `StaticPages`  
Migration operations: create, table  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_staticpages_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_staticpages_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_staticpages_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_staticpages_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_staticpages_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_staticpages_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_staticpages_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_staticpages_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `page_id` | `bigIncrements` | no |  |  |  |  |
| `page_title` | `string` | yes |  |  |  |  |
| `page_url` | `string` | yes |  |  |  |  |
| `page_meta_desc` | `string` | yes |  |  |  |  |
| `page_meta_keywords` | `string` | yes |  |  |  |  |
| `page_slug` | `string(255)` | yes |  |  |  |  |
| `page_content` | `string` | yes |  |  |  |  |
| `page_added_on` | `dateTime` | yes |  |  |  |  |
| `page_added_by` | `integer` | yes |  |  |  |  |
| `image_status` | `enum(['Active', 'Inactive'])` | no | 'Inactive' |  |  |  |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |
| `` | `` |  |  |  |  |  |
| `page_content` | `text` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `page_content` | `string` | no |  |  |  |  |

## `imagefootage_user_package`

Models: `UserPackage`  
Migration operations: create, table  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_user_package_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_user_package_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_user_package_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_user_package_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_user_package_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_user_package_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_user_package_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_user_package_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigInteger(true)` | no |  |  |  |  |
| `transaction_id` | `bigInteger` | yes |  |  |  |  |
| `user_id` | `bigInteger` | no |  |  |  |  |
| `package_id` | `bigInteger` | no |  |  |  |  |
| `package_name` | `string` | yes |  |  |  |  |
| `package_price` | `decimal(10, 2)` | yes |  |  |  |  |
| `package_description` | `string` | yes |  |  |  |  |
| `package_products_count` | `integer` | yes |  |  |  |  |
| `package_type` | `string` | yes |  |  |  |  |
| `package_expiry` | `integer` | yes |  |  |  |  |
| `package_plan` | `string(225)` | yes |  |  |  |  |
| `package_permonth_download` | `integer` | yes |  |  |  |  |
| `package_pcarry_forward` | `string(225)` | yes |  |  |  |  |
| `invoice` | `text` | yes |  |  |  |  |
| `package_expiry_yearly` | `string(225)` | yes |  |  |  |  |
| `package_expiry_date_from_purchage` | `dateTime` | yes |  |  |  |  |
| `downloaded_product` | `integer` | yes | 0 |  |  |  |
| `pacage_size` | `integer` | yes |  |  |  |  |
| `payment_status` | `string(255)` | yes |  |  |  |  |
| `payment_mode` | `string(255)` | yes |  |  |  |  |
| `payment_gatway_provider` | `string(255)` | yes |  |  |  |  |
| `response_payment` | `text` | yes |  |  |  |  |
| `status` | `integer` | yes | 1 |  |  | '(0->Inactive, 1-Active |
| `order_type` | `integer` | yes | 1 |  |  | '(1->online, 2-offline |
| `footage_tier` | `integer` | yes |  |  |  |  |
| `created_at` | `dateTime` | yes |  |  |  |  |
| `updated_at` | `dateTime` | yes |  |  |  |  |
| `rozor_pay_id` | `string(255)` | yes |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `package_expiry_quarterly` | `integer` | yes |  |  |  |  |
| `package_expiry_half_yearly` | `integer` | yes |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `package_expiry_quarterly` | `dropColumn` | no |  |  |  |  |
| `package_expiry_half_yearly` | `dropColumn` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `package_extended_expiry_data` | `dropColumn` | no |  |  |  |  |

## `imagefootage_user_types`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_user_types_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_user_types_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_user_types_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_user_types_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_user_types_table.php:20

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigIncrements` | no |  |  |  |  |
| `user_type` | `string` | no |  |  |  |  |
| `status` | `enum(['A', 'I'])` | no | 'A' |  |  | '1=>Active,0=>Inactiive' |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |

## `imagefootage_usercart`

Models: `Usercart`  
Migration operations: create, table  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_usercart_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_usercart_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_usercart_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_usercart_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_usercart_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_usercart_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_usercart_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_usercart_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `cart_id` | `bigIncrements` | no |  |  |  |  |
| `cart_product_id` | `string` | yes |  |  |  |  |
| `cart_product_type` | `string` | yes |  |  |  |  |
| `standard_type` | `string(255)` | yes |  |  |  |  |
| `standard_size` | `string(255)` | yes |  |  |  |  |
| `standard_price` | `decimal(10, 2)` | yes |  |  |  |  |
| `extended_name` | `string(255)` | yes |  |  |  |  |
| `extended_price` | `decimal(10, 2)` | yes |  |  |  |  |
| `total` | `decimal(10, 2)` | yes |  |  |  |  |
| `product_name` | `string(255)` | yes |  |  |  |  |
| `product_main_footage` | `string(255)` | yes |  |  |  |  |
| `product_thumb` | `string(255)` | yes |  |  |  |  |
| `product_desc` | `text` | yes |  |  |  |  |
| `product_json` | `text` | yes |  |  |  |  |
| `selected_product` | `text` | yes |  |  |  |  |
| `product_web` | `integer` | yes |  |  |  |  |
| `token` | `text` | yes |  |  |  |  |
| `pricing_tier` | `integer` | yes |  |  |  |  |
| `cart_added_by` | `string` | yes |  |  |  |  |
| `cart_added_on` | `dateTime` | yes |  |  |  |  |
| `status` | `tinyInteger` | no | 1 |  |  |  |
| `` | `` |  |  |  |  |  |
| `version_data` | `text` | yes |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `version_data` | `dropColumn` | no |  |  |  |  |

## `imagefootage_usercontactus`

Models: `Usercontactus`  
Migration operations: create, table  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_usercontactus_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_usercontactus_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_usercontactus_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_usercontactus_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_usercontactus_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_usercontactus_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_usercontactus_table.php:22, database/migrations/2023_08_08_054624_add_column_to_imagefootage_usercontactus_table.php:16

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `contactus_id` | `bigIncrements` | no |  |  |  |  |
| `contactus_name` | `string` | yes |  |  |  |  |
| `contactus_mobileno` | `string` | yes |  |  |  |  |
| `contactus_emailid` | `string` | yes |  |  |  |  |
| `contactus_message` | `string` | yes |  |  |  |  |
| `cart_added_on` | `dateTime` | yes |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `contactus_subject` | `string(255)` | yes |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `contactus_subject` | `dropColumn` | no |  |  |  |  |

## `imagefootage_userinfo`

Models: `UserInfo`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_userinfo_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_userinfo_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_userinfo_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_userinfo_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_userinfo_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_userinfo_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_userinfo_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_userinfo_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer` | no |  |  |  |  |
| `user_id` | `integer` | no |  |  |  |  |
| `partner` | `string(245)` | yes |  |  |  |  |
| `whitelist` | `string(245)` | yes |  |  |  |  |
| `blacklist` | `string(245)` | yes |  |  |  |  |
| `frozen` | `string(245)` | yes |  |  |  |  |
| `allow_certi` | `string(245)` | yes |  |  |  |  |
| `enable_subs_multi` | `string(245)` | yes |  |  |  |  |
| `preferred_contact_method` | `string(245)` | yes |  |  |  |  |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |

## `imagefootage_users`

Models: `User`  
Migration operations: create, table  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_users_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_users_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_users_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_users_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_users_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_users_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_users_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_users_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigIncrements` | no |  |  |  |  |
| `first_name` | `string(100)` | yes |  |  |  |  |
| `last_name` | `string` | yes |  |  |  |  |
| `title` | `string(100)` | yes |  |  |  |  |
| `user_name` | `string(200)` | yes |  |  |  |  |
| `contact_owner` | `string(100)` | yes |  |  |  |  |
| `account_manager_id` | `integer` | yes |  |  |  |  |
| `mobile` | `string(100)` | yes |  |  |  |  |
| `phone` | `bigInteger` | yes |  |  |  |  |
| `company` | `string(300)` | yes |  |  |  |  |
| `occupation` | `string(300)` | yes |  |  |  |  |
| `email` | `string` | no |  | UNIQUE |  |  |
| `extension` | `integer` | yes |  |  |  |  |
| `password` | `string` | no |  |  |  |  |
| `remember_token` | `text` | yes |  |  |  |  |
| `address` | `text` | yes |  |  |  |  |
| `city` | `integer` | yes |  |  |  |  |
| `state` | `integer` | yes |  |  |  |  |
| `country` | `integer` | yes |  |  |  |  |
| `postal_code` | `bigInteger` | yes |  |  |  |  |
| `type` | `enum(['L', 'U', 'C'])` | yes |  |  |  | '(L=>Leads,U=>User,C=>Contact |
| `status` | `enum(['1', '0'])` | yes | '1' |  |  |  |
| `description` | `text` | yes |  |  |  |  |
| `gmail_idtoken` | `text` | yes |  |  |  |  |
| `profile_photo` | `text` | yes |  |  |  |  |
| `provider` | `string(100)` | yes |  |  |  |  |
| `fb_token` | `text` | yes |  |  |  |  |
| `notes` | `text` | yes |  |  |  |  |
| `created_at` | `dateTime` | yes |  |  |  |  |
| `updated_at` | `timestamp` | yes |  |  |  |  |
| `otp` | `string(225)` | yes |  |  |  |  |
| `gst` | `string` | yes |  |  |  |  |
| `pan` | `string` | yes |  |  |  |  |
| `address2` | `text` | yes |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `email_verify_token` | `string(255)` | yes |  |  |  |  |
| `token_valid_date` | `dateTime` | yes |  |  |  |  |
| `otp_valid_date` | `dateTime` | yes |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `email_verify_token` | `dropColumn` | no |  |  |  |  |
| `token_valid_date` | `dropColumn` | no |  |  |  |  |
| `otp_valid_date` | `dropColumn` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `vendor_code` | `string` | yes |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `vendor_code` | `dropColumn` | no |  |  |  |  |

## `imagefootage_users_products_download`

Models: `ProductsDownload`, `UserProductDownload`  
Migration operations: create, table  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_users_products_download_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_users_products_download_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_users_products_download_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_users_products_download_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_users_products_download_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_users_products_download_table.php:21, database/migrations/2023_08_08_051827_create_imagefootage_users_products_download_table.php:22, database/migrations/2023_08_08_051827_create_imagefootage_users_products_download_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `user_id` | `integer` | yes |  |  |  |  |
| `package_id` | `integer` | yes |  |  |  |  |
| `product_id` | `string(255)` | yes |  |  |  |  |
| `product_id_api` | `string(20)` | yes |  |  |  |  |
| `id_media` | `integer` | yes |  |  |  |  |
| `id_download` | `integer` | yes |  |  |  |  |
| `queue_hash` | `text` | yes |  |  |  |  |
| `mimetype` | `string(255)` | yes |  |  |  |  |
| `status` | `string(255)` | yes |  |  |  |  |
| `download_url` | `text` | yes |  |  |  |  |
| `downloaded_date` | `dateTime` | yes |  |  |  |  |
| `redownloded_date` | `dateTime` | yes |  |  |  |  |
| `product_name` | `string(255)` | yes |  |  |  |  |
| `product_desc` | `string(255)` | yes |  |  |  |  |
| `product_url` | `string(255)` | yes |  |  |  |  |
| `product_size` | `string(255)` | yes |  |  |  |  |
| `product_price` | `decimal(10, 2)` | yes |  |  |  |  |
| `web_type` | `integer` | yes |  |  |  |  |
| `product_poster` | `string(255)` | yes |  |  |  |  |
| `product_thumb` | `string(255)` | yes |  |  |  |  |
| `selected_product` | `text` | yes |  |  |  |  |
| `created_at` | `dateTime` | yes |  |  |  |  |
| `updated_at` | `timestamp` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `licence_type` | `string` | yes |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `licence_type` | `dropColumn` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `product_type` | `string` | yes |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `product_type` | `dropColumn` | no |  |  |  |  |

## `imagefootage_users_wishlist`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_21_134505_create_imagefootage_users_wishlist_table.php:16, database/migrations/2023_08_21_134505_create_imagefootage_users_wishlist_table.php:17, database/migrations/2023_08_21_134505_create_imagefootage_users_wishlist_table.php:18, database/migrations/2023_08_21_134505_create_imagefootage_users_wishlist_table.php:19, database/migrations/2023_08_21_134505_create_imagefootage_users_wishlist_table.php:20, database/migrations/2023_08_21_134505_create_imagefootage_users_wishlist_table.php:23, database/migrations/2023_08_21_134505_create_imagefootage_users_wishlist_table.php:24

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigIncrements` | no |  |  |  |  |
| `user_id` | `unsignedBigInteger` | no |  |  |  |  |
| `wishlist_id` | `unsignedBigInteger` | no |  |  |  |  |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |
| `user_id` | `constraint:foreign` |  |  | id |  |  |
| `wishlist_id` | `constraint:foreign` |  |  | id |  |  |

## `imagefootage_verifications`

Models: `Verification`  
Migration operations: create  
Evidence: database/migrations/2025_12_19_191842_create_imagefootage_verifications_table.php:16, database/migrations/2025_12_19_191842_create_imagefootage_verifications_table.php:17, database/migrations/2025_12_19_191842_create_imagefootage_verifications_table.php:18, database/migrations/2025_12_19_191842_create_imagefootage_verifications_table.php:19, database/migrations/2025_12_19_191842_create_imagefootage_verifications_table.php:20, database/migrations/2025_12_19_191842_create_imagefootage_verifications_table.php:21, database/migrations/2025_12_19_191842_create_imagefootage_verifications_table.php:22, database/migrations/2025_12_19_191842_create_imagefootage_verifications_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigIncrements` | no |  |  |  |  |
| `user_id` | `unsignedBigInteger` | no |  |  |  | 'User ID' |
| `otp_type` | `string(32)` | yes |  |  |  | 'OTP Type' |
| `one_time_password` | `string(32)` | yes |  |  |  | 'One Time Password' |
| `otp_token` | `string(255)` | yes |  |  |  | 'OTP Token' |
| `token_valid_date` | `dateTime` | yes |  |  |  | 'Token Valid Date' |
| `max_otp_attempts` | `integer` | no | 0 |  |  | 'Max OTP Attempts' |
| `unsuccessful_verification_attempts` | `integer` | no | 0 |  |  | 'Maximum Unsuccessful Verification Attempts' |
| `last_failed_attempt_at` | `dateTime` | yes |  |  |  | 'Last Failed Attempt At' |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |
| `user_id` | `constraint:foreign` |  |  | id |  |  |

## `imagefootage_wishlist`

Models: `UserWishlist`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imagefootage_wishlist_table.php:16, database/migrations/2023_08_08_051827_create_imagefootage_wishlist_table.php:17, database/migrations/2023_08_08_051827_create_imagefootage_wishlist_table.php:18, database/migrations/2023_08_08_051827_create_imagefootage_wishlist_table.php:19, database/migrations/2023_08_08_051827_create_imagefootage_wishlist_table.php:20, database/migrations/2023_08_08_051827_create_imagefootage_wishlist_table.php:21

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `wishlist_id` | `integer(true)` | no |  |  |  |  |
| `wishlist_product` | `string(45)` | no |  |  |  |  |
| `wishlist_user_id` | `integer` | yes |  |  |  |  |
| `folder_name` | `string(50)` | yes |  |  |  |  |
| `wishlist_added_on` | `dateTime` | yes |  |  |  |  |

## `imagefootage_wishlist_products`

Models: No explicit model table mapping found  
Migration operations: create, table  
Evidence: database/migrations/2023_08_21_134651_create_imagefootage_wishlist_products_table.php:16, database/migrations/2023_08_21_134651_create_imagefootage_wishlist_products_table.php:17, database/migrations/2023_08_21_134651_create_imagefootage_wishlist_products_table.php:18, database/migrations/2023_08_21_134651_create_imagefootage_wishlist_products_table.php:19, database/migrations/2023_08_21_134651_create_imagefootage_wishlist_products_table.php:20, database/migrations/2023_08_21_134651_create_imagefootage_wishlist_products_table.php:21, database/migrations/2023_08_21_134651_create_imagefootage_wishlist_products_table.php:24, database/migrations/2023_08_21_134651_create_imagefootage_wishlist_products_table.php:25

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigIncrements` | no |  |  |  |  |
| `wishlist_id` | `unsignedBigInteger` | no |  |  |  |  |
| `product_id` | `unsignedBigInteger` | no |  |  |  |  |
| `type` | `enum(['image', 'footage', 'music'])` | no |  |  |  |  |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |
| `wishlist_id` | `constraint:foreign` |  |  | id |  |  |
| `product_id` | `constraint:foreign` |  |  | id |  |  |
| `` | `` |  |  |  |  |  |
| `product_path_id` | `string(191)` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `product_path_id` | `dropColumn` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `pond5_product_response` | `text` | yes |  |  |  |  |
| `imagefootage_wishlist_products_ibfk_2` | `dropForeign` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `pond5_product_response` | `dropColumn` | no |  |  |  |  |
| `product_id` | `constraint:foreign` |  |  | id |  |  |

## `imagefootage_wishlists`

Models: `ImageFootageWishlist`  
Migration operations: create  
Evidence: database/migrations/2023_08_21_133856_create_image_footage_wishlists_table.php:16, database/migrations/2023_08_21_133856_create_image_footage_wishlists_table.php:17, database/migrations/2023_08_21_133856_create_image_footage_wishlists_table.php:18, database/migrations/2023_08_21_133856_create_image_footage_wishlists_table.php:19, database/migrations/2023_08_21_133856_create_image_footage_wishlists_table.php:20

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigIncrements` | no |  |  |  |  |
| `name` | `mediumText(512)` | yes |  |  |  |  |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |
| `deleted_at` | `timestamp` |  | nullable |  |  |  |

## `imgf_adminusers`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_imgf_adminusers_table.php:16, database/migrations/2023_08_08_051827_create_imgf_adminusers_table.php:17, database/migrations/2023_08_08_051827_create_imgf_adminusers_table.php:18, database/migrations/2023_08_08_051827_create_imgf_adminusers_table.php:19, database/migrations/2023_08_08_051827_create_imgf_adminusers_table.php:20, database/migrations/2023_08_08_051827_create_imgf_adminusers_table.php:21, database/migrations/2023_08_08_051827_create_imgf_adminusers_table.php:22, database/migrations/2023_08_08_051827_create_imgf_adminusers_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `admin_id` | `bigIncrements` | no |  |  |  |  |
| `admin_name` | `string` | yes |  |  |  |  |
| `admin_password` | `string` | yes |  |  |  |  |
| `admin_email` | `string` | yes |  |  |  |  |
| `admin_mobile` | `string` | yes |  |  |  |  |
| `admin_address` | `string` | yes |  |  |  |  |
| `admin_created_at` | `dateTime` | yes |  |  |  |  |
| `admin_lastlogin` | `dateTime` | yes |  |  |  |  |
| `admin_type` | `enum(['Super', 'Sub', 'Agent'])` | no | 'Agent' |  |  |  |
| `admin_status` | `enum(['Active', 'Inactive'])` | no | 'Active' |  |  |  |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |

## `industry_types`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_industry_types_table.php:16, database/migrations/2023_08_08_051827_create_industry_types_table.php:17, database/migrations/2023_08_08_051827_create_industry_types_table.php:18

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `name` | `string(50)` | no |  |  |  |  |

## `jobs`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_jobs_table.php:16, database/migrations/2023_08_08_051827_create_jobs_table.php:17, database/migrations/2023_08_08_051827_create_jobs_table.php:18, database/migrations/2023_08_08_051827_create_jobs_table.php:19, database/migrations/2023_08_08_051827_create_jobs_table.php:20, database/migrations/2023_08_08_051827_create_jobs_table.php:21, database/migrations/2023_08_08_051827_create_jobs_table.php:22, database/migrations/2023_08_08_051827_create_jobs_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigIncrements` | no |  |  |  |  |
| `queue` | `string` | no |  | yes |  |  |
| `payload` | `longText` | no |  |  |  |  |
| `attempts` | `unsignedTinyInteger` | no |  |  |  |  |
| `reserved_at` | `unsignedInteger` | yes |  |  |  |  |
| `available_at` | `unsignedInteger` | no |  |  |  |  |
| `created_at` | `unsignedInteger` | no |  |  |  |  |

## `licence_type`

Models: `LicenceType`  
Migration operations: create  
Evidence: database/migrations/2023_12_29_074956_create_licence_type_table.php:16, database/migrations/2023_12_29_074956_create_licence_type_table.php:17, database/migrations/2023_12_29_074956_create_licence_type_table.php:18, database/migrations/2023_12_29_074956_create_licence_type_table.php:19, database/migrations/2023_12_29_074956_create_licence_type_table.php:20, database/migrations/2023_12_29_074956_create_licence_type_table.php:21, database/migrations/2023_12_29_074956_create_licence_type_table.php:22, database/migrations/2023_12_29_074956_create_licence_type_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigIncrements` | no |  |  |  |  |
| `licence_name` | `text` | no |  |  |  |  |
| `description` | `text` | yes |  |  |  |  |
| `product_type` | `string` | no |  |  |  | '1=>Image,2=>Footage,3=>Music' |
| `version` | `string` | yes |  |  |  |  |
| `slug` | `string` | no |  |  |  |  |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |

## `lightboxes`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_lightboxes_table.php:16, database/migrations/2023_08_08_051827_create_lightboxes_table.php:17, database/migrations/2023_08_08_051827_create_lightboxes_table.php:18, database/migrations/2023_08_08_051827_create_lightboxes_table.php:19, database/migrations/2023_08_08_051827_create_lightboxes_table.php:20

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `product_id` | `integer` | no |  |  |  |  |
| `user_id` | `integer` | no |  |  |  |  |
| `product_web` | `string(100)` | yes |  |  |  |  |

## `manage_banners`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_manage_banners_table.php:16, database/migrations/2023_08_08_051827_create_manage_banners_table.php:17, database/migrations/2023_08_08_051827_create_manage_banners_table.php:18, database/migrations/2023_08_08_051827_create_manage_banners_table.php:19, database/migrations/2023_08_08_051827_create_manage_banners_table.php:20, database/migrations/2023_08_08_051827_create_manage_banners_table.php:21, database/migrations/2023_08_08_051827_create_manage_banners_table.php:22, database/migrations/2023_08_08_051827_create_manage_banners_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `name` | `string(255)` | yes |  | name |  |  |
| `banner_image` | `string(255)` | yes |  |  |  |  |
| `banner_link` | `string(255)` | yes |  |  |  |  |
| `short_description` | `string(250)` | yes |  |  |  |  |
| `sort` | `integer` | yes | 0 | sort |  |  |
| `active` | `tinyInteger` | yes | 0 | active |  |  |
| `created` | `dateTime` | yes |  |  |  |  |
| `modified` | `dateTime` | yes |  |  |  |  |

## `newsletter_subscribers`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_newsletter_subscribers_table.php:16, database/migrations/2023_08_08_051827_create_newsletter_subscribers_table.php:17, database/migrations/2023_08_08_051827_create_newsletter_subscribers_table.php:18, database/migrations/2023_08_08_051827_create_newsletter_subscribers_table.php:19, database/migrations/2023_08_08_051827_create_newsletter_subscribers_table.php:20, database/migrations/2023_08_08_051827_create_newsletter_subscribers_table.php:21, database/migrations/2023_08_08_051827_create_newsletter_subscribers_table.php:22, database/migrations/2023_08_08_051827_create_newsletter_subscribers_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `subscriber_email` | `string(255)` | yes |  | UNIQUE |  |  |
| `firstname` | `string(255)` | yes |  |  |  |  |
| `lastname` | `string(255)` | yes |  |  |  |  |
| `is_subscribed` | `boolean` | yes | true |  |  |  |
| `created` | `dateTime` | yes |  |  |  |  |
| `modified` | `dateTime` | yes |  |  |  |  |

## `newsletters`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_newsletters_table.php:16, database/migrations/2023_08_08_051827_create_newsletters_table.php:17, database/migrations/2023_08_08_051827_create_newsletters_table.php:18, database/migrations/2023_08_08_051827_create_newsletters_table.php:19, database/migrations/2023_08_08_051827_create_newsletters_table.php:20, database/migrations/2023_08_08_051827_create_newsletters_table.php:21, database/migrations/2023_08_08_051827_create_newsletters_table.php:22, database/migrations/2023_08_08_051827_create_newsletters_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `title` | `string(255)` | yes |  |  |  |  |
| `subject` | `string(255)` | yes |  |  |  |  |
| `message` | `text` | yes |  |  |  |  |
| `active` | `tinyInteger` | yes | 1 |  |  |  |
| `created` | `dateTime` | yes |  |  |  |  |
| `modified` | `dateTime` | yes |  |  |  |  |

## `ngos`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_ngos_table.php:16, database/migrations/2023_08_08_051827_create_ngos_table.php:17, database/migrations/2023_08_08_051827_create_ngos_table.php:18, database/migrations/2023_08_08_051827_create_ngos_table.php:19

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `organization` | `string(255)` | no |  |  |  |  |
| `status` | `integer` | no | 0 |  |  |  |

## `order_invoices`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_order_invoices_table.php:16, database/migrations/2023_08_08_051827_create_order_invoices_table.php:17, database/migrations/2023_08_08_051827_create_order_invoices_table.php:18, database/migrations/2023_08_08_051827_create_order_invoices_table.php:19, database/migrations/2023_08_08_051827_create_order_invoices_table.php:20, database/migrations/2023_08_08_051827_create_order_invoices_table.php:21

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `user_id` | `string(100)` | no |  |  |  |  |
| `order_id` | `string(100)` | no |  |  |  |  |
| `type` | `string(50)` | no |  |  |  |  |
| `created` | `string(100)` | no |  |  |  |  |

## `order_items`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_order_items_table.php:16, database/migrations/2023_08_08_051827_create_order_items_table.php:17, database/migrations/2023_08_08_051827_create_order_items_table.php:18, database/migrations/2023_08_08_051827_create_order_items_table.php:19, database/migrations/2023_08_08_051827_create_order_items_table.php:20, database/migrations/2023_08_08_051827_create_order_items_table.php:21, database/migrations/2023_08_08_051827_create_order_items_table.php:22, database/migrations/2023_08_08_051827_create_order_items_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `order_id` | `string(50)` | yes |  |  |  |  |
| `order_title` | `string(255)` | yes |  |  |  |  |
| `subtotal` | `decimal(10, 2)` | yes |  |  |  |  |
| `user_id` | `string(100)` | yes |  |  |  |  |
| `product_id` | `string(100)` | yes |  |  |  |  |
| `product_type` | `string(100)` | yes |  |  |  |  |
| `product_size` | `string(100)` | no |  |  |  |  |
| `usageType` | `string(50)` | yes |  |  |  |  |
| `type_of_usage` | `string(50)` | yes |  |  |  |  |
| `catDisplay2` | `string(50)` | yes |  |  |  |  |
| `catDisplay3` | `string(100)` | yes |  |  |  |  |
| `catDisplay4` | `string(100)` | yes |  |  |  |  |
| `catDisplay5` | `string(100)` | yes |  |  |  |  |
| `catDisplay6` | `string(100)` | yes |  |  |  |  |
| `catDisplay7` | `string(100)` | yes |  |  |  |  |
| `territoryType` | `string(100)` | yes |  |  |  |  |
| `Territory` | `string(100)` | yes |  |  |  |  |
| `Territory1` | `string(100)` | yes |  |  |  |  |
| `Territory2` | `string(100)` | yes |  |  |  |  |
| `Duration` | `string(100)` | yes |  |  |  |  |
| `StartYear` | `string(100)` | yes |  |  |  |  |
| `endDate` | `string(100)` | no |  |  |  |  |
| `Industry` | `string(100)` | yes |  |  |  |  |
| `catTitle1_name` | `string(100)` | yes |  |  |  |  |
| `catTitle2_name` | `string(100)` | yes |  |  |  |  |
| `catTitle3_name` | `string(100)` | yes |  |  |  |  |
| `catTitle4_name` | `string(100)` | yes |  |  |  |  |
| `catTitle5_name` | `string(100)` | yes |  |  |  |  |
| `catTitle6_name` | `string(100)` | yes |  |  |  |  |
| `catTitle7_name` | `string(100)` | yes |  |  |  |  |
| `action` | `string(100)` | no |  |  |  |  |
| `created` | `dateTime` | no |  |  |  |  |
| `modified` | `dateTime` | no |  |  |  |  |
| `status` | `integer` | yes |  |  |  |  |
| `product_web` | `string(100)` | yes |  |  |  |  |

## `orders`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_orders_table.php:16, database/migrations/2023_08_08_051827_create_orders_table.php:17, database/migrations/2023_08_08_051827_create_orders_table.php:18, database/migrations/2023_08_08_051827_create_orders_table.php:19, database/migrations/2023_08_08_051827_create_orders_table.php:20, database/migrations/2023_08_08_051827_create_orders_table.php:21, database/migrations/2023_08_08_051827_create_orders_table.php:22, database/migrations/2023_08_08_051827_create_orders_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `user_id` | `string(100)` | yes |  |  |  |  |
| `txn_id` | `string(255)` | yes |  |  |  |  |
| `plan_id` | `integer` | yes |  |  |  |  |
| `invoice` | `string(100)` | yes |  |  |  |  |
| `download_plan_id` | `string(50)` | yes |  |  |  |  |
| `download_plan_title` | `string(50)` | no |  |  |  |  |
| `tax` | `decimal(10)` | yes |  |  |  |  |
| `tax_selected` | `text` | yes |  |  |  |  |
| `coupon_code` | `string(100)` | yes |  |  |  |  |
| `coupon_type` | `string(50)` | yes |  |  |  |  |
| `coupon_value` | `double` | yes |  |  |  |  |
| `coupon_discount` | `double` | yes |  |  |  |  |
| `order_total` | `decimal(10)` | yes |  |  |  |  |
| `order_date` | `date` | yes |  |  |  |  |
| `order_status` | `integer` | yes | 0 |  |  |  |
| `order_title` | `string(100)` | no |  |  |  |  |
| `order_cancel_status` | `string(100)` | no |  |  |  |  |
| `order_type` | `integer` | yes |  |  |  |  |
| `order_email` | `string(100)` | yes |  |  |  |  |
| `ip` | `string(100)` | yes |  |  |  |  |
| `payment_mode` | `string(100)` | yes |  |  |  |  |
| `cc_number` | `string(100)` | yes |  |  |  |  |
| `cc_expiry_date` | `string(100)` | yes |  |  |  |  |
| `job_number` | `string(100)` | yes |  |  |  |  |
| `po_detail` | `string(100)` | yes |  |  |  |  |
| `po_image` | `string(100)` | yes |  |  |  |  |
| `order_comments` | `text` | yes |  |  |  |  |
| `bill_firstname` | `string(100)` | yes |  |  |  |  |
| `bill_lastname` | `string(100)` | yes |  |  |  |  |
| `bill_address1` | `string(100)` | yes |  |  |  |  |
| `bill_address2` | `string(100)` | yes |  |  |  |  |
| `bill_city` | `string(100)` | yes |  |  |  |  |
| `bill_state` | `string(100)` | yes |  |  |  |  |
| `bill_zip` | `string(100)` | yes |  |  |  |  |
| `bill_country` | `string(100)` | yes |  |  |  |  |
| `bill_phone` | `string(100)` | yes |  |  |  |  |
| `created` | `dateTime` | no |  |  |  |  |
| `modified` | `dateTime` | no |  |  |  |  |
| `invoice_type` | `string(100)` | yes |  |  |  |  |
| `expiry_invoices` | `integer` | yes |  |  |  |  |
| `deletion_date` | `string(200)` | yes |  |  |  |  |
| `invoice_closed` | `integer` | yes |  |  |  |  |

## `password_resets`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_password_resets_table.php:16, database/migrations/2023_08_08_051827_create_password_resets_table.php:17, database/migrations/2023_08_08_051827_create_password_resets_table.php:18, database/migrations/2023_08_08_051827_create_password_resets_table.php:19

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `email` | `string` | no |  | yes |  |  |
| `token` | `string` | no |  |  |  |  |
| `created_at` | `timestamp` | yes |  |  |  |  |

## `payments`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_payments_table.php:16, database/migrations/2023_08_08_051827_create_payments_table.php:17, database/migrations/2023_08_08_051827_create_payments_table.php:18, database/migrations/2023_08_08_051827_create_payments_table.php:19, database/migrations/2023_08_08_051827_create_payments_table.php:20, database/migrations/2023_08_08_051827_create_payments_table.php:21, database/migrations/2023_08_08_051827_create_payments_table.php:22, database/migrations/2023_08_08_051827_create_payments_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `order_id` | `string(50)` | yes |  |  |  |  |
| `payer_id` | `string(222)` | no |  |  |  |  |
| `amount` | `decimal(10, 2)` | no |  |  |  |  |
| `currency` | `string(50)` | no |  |  |  |  |
| `paymentStatus` | `integer` | no | 0 |  |  |  |
| `payment_mode` | `string(50)` | no |  |  |  |  |
| `comment` | `string(100)` | no |  |  |  |  |
| `createDate` | `dateTime` | no |  |  |  |  |
| `updatedStatus` | `string(250)` | no |  |  |  |  |

## `performa_invoice_items`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_performa_invoice_items_table.php:16, database/migrations/2023_08_08_051827_create_performa_invoice_items_table.php:17, database/migrations/2023_08_08_051827_create_performa_invoice_items_table.php:18, database/migrations/2023_08_08_051827_create_performa_invoice_items_table.php:19, database/migrations/2023_08_08_051827_create_performa_invoice_items_table.php:20, database/migrations/2023_08_08_051827_create_performa_invoice_items_table.php:21, database/migrations/2023_08_08_051827_create_performa_invoice_items_table.php:22, database/migrations/2023_08_08_051827_create_performa_invoice_items_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `invoice_id` | `integer` | no |  |  |  |  |
| `user_id` | `string(50)` | no |  |  |  |  |
| `product_id` | `string(100)` | no |  |  |  |  |
| `product_type` | `string(50)` | no |  |  |  |  |
| `product_size` | `string(50)` | no |  |  |  |  |
| `subtotal` | `decimal(10, 2)` | no |  |  |  |  |
| `product_subscription` | `integer` | no |  |  |  |  |
| `plan_id` | `string(50)` | no |  |  |  |  |
| `status` | `integer` | no |  |  |  |  |
| `product_web` | `string(100)` | yes |  |  |  |  |
| `action` | `string(100)` | no |  |  |  |  |
| `catTitle1` | `string(100)` | no | '' |  |  |  |
| `catTitle2` | `string(100)` | no |  |  |  |  |
| `catTitle3` | `string(100)` | no |  |  |  |  |
| `catTitle4` | `string(100)` | no |  |  |  |  |
| `catTitle5` | `string(100)` | no |  |  |  |  |
| `catTitle6` | `string(100)` | no |  |  |  |  |
| `catTitle7` | `string(100)` | no |  |  |  |  |
| `catValue1` | `string(100)` | no |  |  |  |  |
| `catValue2` | `string(100)` | no |  |  |  |  |
| `catValue3` | `string(100)` | no |  |  |  |  |
| `catValue4` | `string(100)` | no |  |  |  |  |
| `catValue5` | `string(100)` | no |  |  |  |  |
| `catValue6` | `string(100)` | no |  |  |  |  |
| `catValue7` | `string(100)` | no |  |  |  |  |
| `duration` | `string(100)` | no |  |  |  |  |
| `start_date` | `string(100)` | no |  |  |  |  |
| `end_date` | `string(100)` | no |  |  |  |  |
| `teritery_type` | `string(100)` | no |  |  |  |  |
| `teritery1` | `string(100)` | no |  |  |  |  |
| `teritery2` | `string(100)` | no |  |  |  |  |
| `teritery3` | `string(100)` | no |  |  |  |  |
| `userindustry` | `string(100)` | no |  |  |  |  |
| `username` | `string(100)` | no |  |  |  |  |
| `created` | `dateTime` | no |  |  |  |  |
| `modified` | `dateTime` | no |  |  |  |  |
| `purchase_product` | `integer` | no |  |  |  |  |

## `performa_invoices`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_performa_invoices_table.php:16, database/migrations/2023_08_08_051827_create_performa_invoices_table.php:17, database/migrations/2023_08_08_051827_create_performa_invoices_table.php:18, database/migrations/2023_08_08_051827_create_performa_invoices_table.php:19, database/migrations/2023_08_08_051827_create_performa_invoices_table.php:20, database/migrations/2023_08_08_051827_create_performa_invoices_table.php:21, database/migrations/2023_08_08_051827_create_performa_invoices_table.php:22, database/migrations/2023_08_08_051827_create_performa_invoices_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `user_id` | `string(100)` | no |  |  |  |  |
| `email_id` | `string(100)` | no |  |  |  |  |
| `invoice_name` | `string(100)` | no |  |  |  |  |
| `created` | `date` | no |  |  |  |  |
| `modified` | `dateTime` | no |  |  |  |  |
| `status` | `integer` | no |  |  |  |  |
| `mode` | `string(100)` | no |  |  |  |  |
| `job_number` | `string(100)` | no |  |  |  |  |
| `promo_code` | `string(100)` | no |  |  |  |  |
| `tax` | `decimal(10, 2)` | no |  |  |  |  |
| `tax_selected` | `text` | yes |  |  |  |  |
| `total` | `decimal(10, 2)` | no |  |  |  |  |
| `invoice_type` | `string(100)` | no |  |  |  |  |
| `expiry_invoices` | `integer` | no |  |  |  |  |
| `address` | `string(100)` | no |  |  |  |  |
| `address1` | `string(100)` | no |  |  |  |  |
| `country` | `string(110)` | no |  |  |  |  |
| `state` | `string(110)` | no |  |  |  |  |
| `city` | `string(110)` | no |  |  |  |  |
| `zipcode` | `string(50)` | no |  |  |  |  |
| `deletion_date` | `string(100)` | no |  |  |  |  |
| `invoice_closed` | `integer` | no |  |  |  |  |
| `po_detail` | `string(100)` | no |  |  |  |  |
| `po_image` | `string(100)` | no |  |  |  |  |
| `date_close` | `dateTime` | no |  |  |  |  |
| `action` | `string(100)` | no |  |  |  |  |

## `plan_subscriptions`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_plan_subscriptions_table.php:16, database/migrations/2023_08_08_051827_create_plan_subscriptions_table.php:17, database/migrations/2023_08_08_051827_create_plan_subscriptions_table.php:18, database/migrations/2023_08_08_051827_create_plan_subscriptions_table.php:19, database/migrations/2023_08_08_051827_create_plan_subscriptions_table.php:20, database/migrations/2023_08_08_051827_create_plan_subscriptions_table.php:21, database/migrations/2023_08_08_051827_create_plan_subscriptions_table.php:22, database/migrations/2023_08_08_051827_create_plan_subscriptions_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `plan_id` | `integer` | yes |  |  |  |  |
| `user_id` | `string(100)` | yes |  |  |  |  |
| `order_id` | `integer` | no |  |  |  |  |
| `plan_title` | `string(11)` | yes |  |  |  |  |
| `maximage_download` | `integer` | yes |  |  |  |  |
| `maxvectors_download` | `integer` | yes |  |  |  |  |
| `maxfootage_download` | `integer` | yes |  |  |  |  |
| `plan_price` | `decimal(10, 2)` | no |  |  |  |  |
| `plan_validity` | `string(255)` | yes |  |  |  |  |
| `start_date` | `date` | no |  |  |  |  |
| `end_date` | `date` | no |  |  |  |  |
| `status` | `integer` | no | 0 |  |  |  |
| `payment_status` | `integer` | no | 0 |  |  |  |
| `payment_type` | `integer` | yes |  |  |  |  |
| `action` | `string(100)` | no |  |  |  |  |
| `created` | `dateTime` | no |  |  |  |  |
| `modified` | `dateTime` | no |  |  |  |  |

## `plans`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_plans_table.php:16, database/migrations/2023_08_08_051827_create_plans_table.php:17, database/migrations/2023_08_08_051827_create_plans_table.php:18, database/migrations/2023_08_08_051827_create_plans_table.php:19, database/migrations/2023_08_08_051827_create_plans_table.php:20, database/migrations/2023_08_08_051827_create_plans_table.php:21, database/migrations/2023_08_08_051827_create_plans_table.php:22, database/migrations/2023_08_08_051827_create_plans_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `title` | `string(255)` | no |  |  |  |  |
| `description` | `text` | no |  |  |  |  |
| `monthly_price` | `decimal(10)` | no | 0 |  |  |  |
| `yearly_price` | `decimal(10)` | no | 0 |  |  |  |
| `duration` | `integer` | no |  |  |  |  |
| `maximage_download` | `integer` | yes |  |  |  |  |
| `maxvectors_download` | `integer` | yes |  |  |  |  |
| `maxfootage_download` | `integer` | yes |  |  |  |  |
| `maxaudio_download` | `integer` | yes |  |  |  |  |
| `image_download` | `integer` | no |  |  |  |  |
| `vector_download` | `integer` | no |  |  |  |  |
| `plan_type` | `string(50)` | no |  |  |  |  |
| `active` | `integer` | no | 0 |  |  |  |
| `created` | `dateTime` | no |  |  |  |  |
| `modified` | `dateTime` | no |  |  |  |  |

## `potential_users`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_potential_users_table.php:16, database/migrations/2023_08_08_051827_create_potential_users_table.php:17, database/migrations/2023_08_08_051827_create_potential_users_table.php:18, database/migrations/2023_08_08_051827_create_potential_users_table.php:19, database/migrations/2023_08_08_051827_create_potential_users_table.php:20, database/migrations/2023_08_08_051827_create_potential_users_table.php:21, database/migrations/2023_08_08_051827_create_potential_users_table.php:22, database/migrations/2023_08_08_051827_create_potential_users_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `increments` | no |  | PRIMARY |  |  |
| `fbid` | `string(255)` | yes |  |  |  |  |
| `google_id` | `string(255)` | no |  |  |  |  |
| `email` | `string(255)` | yes |  | email |  |  |
| `firstname` | `string(255)` | yes |  |  |  |  |
| `lastname` | `string(255)` | yes |  |  |  |  |
| `job_title` | `string(255)` | no |  |  |  |  |
| `business_type` | `string(255)` | no |  |  |  |  |
| `company` | `string(255)` | no |  |  |  |  |
| `address` | `string(255)` | yes |  |  |  |  |
| `phone` | `string(50)` | yes |  |  |  |  |
| `mobile` | `string(50)` | yes |  |  |  |  |
| `city` | `string(100)` | yes |  |  |  |  |
| `state` | `string(100)` | yes |  |  |  |  |
| `zipcode` | `string(50)` | yes |  |  |  |  |
| `description` | `string(255)` | no |  |  |  |  |
| `country` | `string(255)` | yes |  |  |  |  |
| `created` | `dateTime` | yes |  |  |  |  |
| `modified` | `dateTime` | yes |  |  |  |  |
| `ip_addr` | `string(50)` | no |  |  |  |  |
| `user_id` | `string(50)` | no |  |  |  |  |

## `product_attribute_relations`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_product_attribute_relations_table.php:16, database/migrations/2023_08_08_051827_create_product_attribute_relations_table.php:17, database/migrations/2023_08_08_051827_create_product_attribute_relations_table.php:18, database/migrations/2023_08_08_051827_create_product_attribute_relations_table.php:19, database/migrations/2023_08_08_051827_create_product_attribute_relations_table.php:20, database/migrations/2023_08_08_051827_create_product_attribute_relations_table.php:21, database/migrations/2023_08_08_051827_create_product_attribute_relations_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `product_id` | `integer` | yes |  |  |  |  |
| `attribute_id` | `integer` | yes |  | attribute_id |  |  |
| `attribute_value_id` | `integer` | yes |  | prod_att_rel_attrbval |  |  |
| `quantity` | `string(255)` | yes |  |  |  |  |
| `['product_id` | `constraint:unique` |  |  |  |  |  |

## `product_attribute_values`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_product_attribute_values_table.php:16, database/migrations/2023_08_08_051827_create_product_attribute_values_table.php:17, database/migrations/2023_08_08_051827_create_product_attribute_values_table.php:18, database/migrations/2023_08_08_051827_create_product_attribute_values_table.php:19, database/migrations/2023_08_08_051827_create_product_attribute_values_table.php:20, database/migrations/2023_08_08_051827_create_product_attribute_values_table.php:21, database/migrations/2023_08_08_051827_create_product_attribute_values_table.php:22, database/migrations/2023_08_08_051827_create_product_attribute_values_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `attribute_id` | `integer` | yes |  | attribute_id |  |  |
| `name` | `string(255)` | yes |  |  |  |  |
| `color_code` | `string(100)` | yes |  |  |  |  |
| `active` | `integer` | yes | 1 | pav_active |  |  |
| `sort_order` | `integer` | yes |  |  |  |  |
| `created` | `dateTime` | yes |  | created |  |  |
| `modified` | `dateTime` | yes |  |  |  |  |

## `products`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_products_table.php:16, database/migrations/2023_08_08_051827_create_products_table.php:17, database/migrations/2023_08_08_051827_create_products_table.php:18, database/migrations/2023_08_08_051827_create_products_table.php:19, database/migrations/2023_08_08_051827_create_products_table.php:20, database/migrations/2023_08_08_051827_create_products_table.php:21, database/migrations/2023_08_08_051827_create_products_table.php:22, database/migrations/2023_08_08_051827_create_products_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigInteger(true)` | no |  |  |  |  |
| `product_code` | `string(100)` | no |  |  |  |  |
| `download_code` | `string(100)` | no |  |  |  |  |
| `name` | `string(100)` | yes |  |  |  |  |
| `keywords` | `text` | yes |  |  |  |  |
| `description` | `text` | yes |  |  |  |  |
| `subscription_type` | `integer` | yes |  |  |  |  |
| `small_price` | `decimal(10)` | yes | 0 | price |  |  |
| `medium_price` | `decimal(10)` | yes | 0 |  |  |  |
| `large_price` | `decimal(10)` | yes | 0 |  |  |  |
| `xlarge_price` | `decimal(10)` | yes | 0 |  |  |  |
| `img_small_size` | `string(255)` | no |  |  |  |  |
| `img_medium_size` | `string(255)` | no |  |  |  |  |
| `img_large_size` | `string(255)` | no |  |  |  |  |
| `img_xlarge_size` | `string(255)` | no |  |  |  |  |
| `active` | `integer` | yes | 0 |  |  |  |
| `product_type` | `string(10)` | yes |  |  |  |  |
| `video_type` | `integer` | no | 0 |  |  |  |
| `thumbnail_image` | `string(255)` | no |  |  |  |  |
| `product_video` | `string(255)` | no |  |  |  |  |
| `youtube_video` | `text` | no |  |  |  |  |
| `product_image` | `string(255)` | yes |  |  |  |  |
| `download_path` | `text` | yes |  |  |  |  |
| `new_product` | `integer` | no | 0 |  |  |  |
| `featured_product` | `integer` | yes | 0 |  |  |  |
| `popular_product` | `integer` | yes | 0 |  |  |  |
| `user_post` | `string(255)` | no |  |  |  |  |
| `user_id` | `string(25)` | yes |  |  |  |  |
| `type` | `string(255)` | yes |  |  |  |  |
| `status` | `integer` | no | 0 |  |  |  |
| `ngo_id` | `integer` | yes | 0 |  |  |  |
| `donor_status` | `integer` | yes | 0 |  |  |  |
| `reason` | `string(255)` | yes |  |  |  |  |
| `other_reason` | `string(50)` | yes |  |  |  |  |
| `rating` | `double(10, 1)` | no | 0 |  |  |  |
| `created` | `dateTime` | yes |  |  |  |  |
| `modified` | `dateTime` | yes |  |  |  |  |
| `check_thumb` | `integer` | yes | 0 |  |  |  |
| `extension` | `string(100)` | yes |  |  |  |  |
| `ungraded_vid_price` | `decimal(10, 2)` | yes |  |  |  |  |
| `4k_vid_price` | `decimal(10, 2)` | yes |  |  |  |  |

## `promo_codes`

Models: `PromoCode`  
Migration operations: create, table  
Evidence: database/migrations/2023_08_08_052444_create_promo_codes_table.php:16, database/migrations/2023_08_08_052444_create_promo_codes_table.php:17, database/migrations/2023_08_08_052444_create_promo_codes_table.php:18, database/migrations/2023_08_08_052444_create_promo_codes_table.php:19, database/migrations/2023_08_08_052444_create_promo_codes_table.php:20, database/migrations/2023_08_08_052444_create_promo_codes_table.php:21, database/migrations/2023_08_08_052444_create_promo_codes_table.php:22, database/migrations/2023_08_08_052444_create_promo_codes_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `name` | `string(255)` | yes |  |  |  |  |
| `type` | `string(255)` | yes |  |  |  |  |
| `max_usage` | `integer` | yes |  |  |  |  |
| `total_applied_code` | `integer` | yes |  |  |  |  |
| `discount` | `string(255)` | yes |  |  |  |  |
| `valid_upto_type` | `string(255)` | yes |  |  |  |  |
| `valid_start_date` | `date` | yes |  |  |  |  |
| `valid_till_date` | `date` | yes |  |  |  |  |
| `status` | `enum(['1', '0'])` | no | '1' |  |  |  |
| `will_apply_by` | `enum(['1', '2', '3'])` | yes |  |  |  | '1- frontend, 2- backend, 3- all' |
| `` | `` |  |  |  |  |  |
| `asset_type` | `string(50)` | yes |  |  |  | 'Product Type' |
| `` | `` |  |  |  |  |  |
| `asset_type` | `dropColumn` | no |  |  |  |  |

## `ratings`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_ratings_table.php:16, database/migrations/2023_08_08_051827_create_ratings_table.php:17, database/migrations/2023_08_08_051827_create_ratings_table.php:18, database/migrations/2023_08_08_051827_create_ratings_table.php:19, database/migrations/2023_08_08_051827_create_ratings_table.php:20, database/migrations/2023_08_08_051827_create_ratings_table.php:21, database/migrations/2023_08_08_051827_create_ratings_table.php:22, database/migrations/2023_08_08_051827_create_ratings_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `user_id` | `integer` | yes |  | user_id |  |  |
| `product_id` | `integer` | yes |  | product_id |  |  |
| `overall` | `integer` | no | 0 |  |  |  |
| `comfort` | `integer` | no | 0 |  |  |  |
| `style` | `integer` | no | 0 |  |  |  |
| `name` | `string(255)` | yes |  |  |  |  |
| `email` | `string(150)` | yes |  |  |  |  |
| `review` | `text` | yes |  |  |  |  |
| `active` | `boolean` | no | true | active |  |  |
| `created` | `dateTime` | yes |  |  |  |  |
| `modified` | `dateTime` | yes |  |  |  |  |

## `reason_of_rejections`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_reason_of_rejections_table.php:16, database/migrations/2023_08_08_051827_create_reason_of_rejections_table.php:17, database/migrations/2023_08_08_051827_create_reason_of_rejections_table.php:18, database/migrations/2023_08_08_051827_create_reason_of_rejections_table.php:19, database/migrations/2023_08_08_051827_create_reason_of_rejections_table.php:20

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `title` | `string(50)` | yes |  |  |  |  |
| `status` | `integer` | yes |  |  |  |  |
| `position` | `integer` | no | 0 |  |  |  |

## `rm_fileds`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_rm_fileds_table.php:16, database/migrations/2023_08_08_051827_create_rm_fileds_table.php:17, database/migrations/2023_08_08_051827_create_rm_fileds_table.php:18, database/migrations/2023_08_08_051827_create_rm_fileds_table.php:19, database/migrations/2023_08_08_051827_create_rm_fileds_table.php:20, database/migrations/2023_08_08_051827_create_rm_fileds_table.php:21

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `label` | `string(100)` | no |  |  |  |  |
| `value` | `string(100)` | no |  |  |  |  |
| `heading_id` | `integer` | no |  | heading_id |  |  |
| `main_cat_id` | `integer` | no |  |  |  |  |

## `rm_heading_fields`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_rm_heading_fields_table.php:16, database/migrations/2023_08_08_051827_create_rm_heading_fields_table.php:17, database/migrations/2023_08_08_051827_create_rm_heading_fields_table.php:18

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer` | no |  | PRIMARY |  |  |
| `heading` | `string(100)` | no |  |  |  |  |

## `rm_values`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_rm_values_table.php:16, database/migrations/2023_08_08_051827_create_rm_values_table.php:17, database/migrations/2023_08_08_051827_create_rm_values_table.php:18, database/migrations/2023_08_08_051827_create_rm_values_table.php:19

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `value` | `string(50)` | no |  |  |  |  |
| `name` | `string(100)` | no |  |  |  |  |

## `search_histories`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_search_histories_table.php:16, database/migrations/2023_08_08_051827_create_search_histories_table.php:17, database/migrations/2023_08_08_051827_create_search_histories_table.php:18, database/migrations/2023_08_08_051827_create_search_histories_table.php:19, database/migrations/2023_08_08_051827_create_search_histories_table.php:20, database/migrations/2023_08_08_051827_create_search_histories_table.php:21, database/migrations/2023_08_08_051827_create_search_histories_table.php:22

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `seach_keyword` | `text` | no |  |  |  |  |
| `user_id` | `string(255)` | no |  |  |  |  |
| `product_id` | `string(100)` | no |  |  |  |  |
| `product_web` | `string(100)` | no |  |  |  |  |
| `datetime` | `string(255)` | no |  |  |  |  |

## `settings`

Models: `Setting`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_054342_create_settings_table.php:16, database/migrations/2023_08_08_054342_create_settings_table.php:17, database/migrations/2023_08_08_054342_create_settings_table.php:18, database/migrations/2023_08_08_054342_create_settings_table.php:19, database/migrations/2023_08_08_054342_create_settings_table.php:20

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `key` | `string(255)` | no |  |  |  |  |
| `value` | `string(255)` | no |  |  |  |  |
| `status` | `tinyInteger` | no |  |  |  |  |

## `shopping_carts`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_shopping_carts_table.php:16, database/migrations/2023_08_08_051827_create_shopping_carts_table.php:17, database/migrations/2023_08_08_051827_create_shopping_carts_table.php:18, database/migrations/2023_08_08_051827_create_shopping_carts_table.php:19, database/migrations/2023_08_08_051827_create_shopping_carts_table.php:20, database/migrations/2023_08_08_051827_create_shopping_carts_table.php:21, database/migrations/2023_08_08_051827_create_shopping_carts_table.php:22, database/migrations/2023_08_08_051827_create_shopping_carts_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `session_id` | `string(255)` | yes |  | session_id |  |  |
| `product_id` | `string(100)` | yes |  | product_id |  |  |
| `quantity` | `integer` | yes |  |  |  |  |
| `price` | `decimal(10, 2)` | yes |  |  |  |  |
| `status` | `string(50)` | no |  |  |  |  |
| `attribute_id` | `string(255)` | yes |  |  |  |  |
| `attribute_value_id` | `string(255)` | yes |  |  |  |  |
| `attribute_name` | `string(255)` | yes |  |  |  |  |
| `created` | `dateTime` | yes |  |  |  |  |
| `modified` | `dateTime` | yes |  |  |  |  |
| `size` | `string(255)` | yes |  |  |  |  |
| `user_id` | `string(100)` | yes |  |  |  |  |
| `product_type` | `string(50)` | yes |  |  |  |  |
| `usageType` | `string(50)` | yes |  |  |  |  |
| `type_of_usage` | `string(50)` | yes |  |  |  |  |
| `catDisplay2` | `string(50)` | yes |  |  |  |  |
| `catDisplay3` | `string(100)` | yes |  |  |  |  |
| `catDisplay4` | `string(100)` | yes |  |  |  |  |
| `catDisplay5` | `string(100)` | yes |  |  |  |  |
| `catDisplay6` | `string(100)` | yes |  |  |  |  |
| `catDisplay7` | `string(100)` | yes |  |  |  |  |
| `territoryType` | `string(100)` | yes |  |  |  |  |
| `Territory` | `string(100)` | yes |  |  |  |  |
| `Territory1` | `string(100)` | yes |  |  |  |  |
| `Territory2` | `string(100)` | yes |  |  |  |  |
| `Duration` | `string(100)` | yes |  |  |  |  |
| `StartYear` | `string(100)` | yes |  |  |  |  |
| `Industry` | `string(100)` | yes |  |  |  |  |
| `catTitle1_name` | `string(100)` | yes |  |  |  |  |
| `catTitle2_name` | `string(100)` | yes |  |  |  |  |
| `catTitle3_name` | `string(100)` | yes |  |  |  |  |
| `catTitle4_name` | `string(100)` | yes |  |  |  |  |
| `catTitle5_name` | `string(100)` | yes |  |  |  |  |
| `catTitle6_name` | `string(100)` | yes |  |  |  |  |
| `catTitle7_name` | `string(100)` | yes |  |  |  |  |
| `endDate` | `string(100)` | no |  |  |  |  |
| `product_web` | `string(100)` | yes |  |  |  |  |
| `pond_cart_data` | `text` | yes |  |  |  |  |

## `states`

Models: `State`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_states_table.php:16, database/migrations/2023_08_08_051827_create_states_table.php:17, database/migrations/2023_08_08_051827_create_states_table.php:18, database/migrations/2023_08_08_051827_create_states_table.php:19

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `state` | `string(30)` | no |  |  |  |  |
| `country_id` | `integer` | no | 1 |  |  |  |

## `taxes`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_taxes_table.php:16, database/migrations/2023_08_08_051827_create_taxes_table.php:17, database/migrations/2023_08_08_051827_create_taxes_table.php:18, database/migrations/2023_08_08_051827_create_taxes_table.php:19, database/migrations/2023_08_08_051827_create_taxes_table.php:20, database/migrations/2023_08_08_051827_create_taxes_table.php:21, database/migrations/2023_08_08_051827_create_taxes_table.php:22

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `tax_name` | `string(255)` | no |  |  |  |  |
| `tax_code` | `string(50)` | yes |  |  |  |  |
| `tax_rate` | `string(255)` | no |  |  |  |  |
| `status` | `string(255)` | no |  |  |  |  |
| `country` | `string(50)` | yes |  |  |  |  |

## `tredings_words`

Models: No explicit model table mapping found  
Migration operations: table  
Evidence: database/migrations/2024_01_25_091021_add_column_is_processing_keyword_in_tredings_words.php:30, database/migrations/2024_01_25_091021_add_column_is_processing_keyword_in_tredings_words.php:31

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `is_processing_keyword` | `dropColumn` | no |  |  |  |  |

## `trending_words`

Models: `TrendingWord`  
Migration operations: create, table  
Evidence: database/migrations/2023_08_08_054848_create_trending_words_table.php:16, database/migrations/2023_08_08_054848_create_trending_words_table.php:17, database/migrations/2023_08_08_054848_create_trending_words_table.php:18, database/migrations/2023_08_08_054848_create_trending_words_table.php:19, database/migrations/2024_01_25_091021_add_column_is_processing_keyword_in_tredings_words.php:17, database/migrations/2024_01_25_091021_add_column_is_processing_keyword_in_tredings_words.php:18, database/migrations/2024_03_21_063728_add_third_party_data_count_to_trending_words_table.php:16, database/migrations/2024_03_21_063728_add_third_party_data_count_to_trending_words_table.php:17

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `bigInteger(true)` | no |  |  |  |  |
| `name` | `string(255)` | no |  |  |  |  |
| `count` | `bigInteger` | no |  |  |  |  |
| `` | `` |  |  |  |  |  |
| `is_processing_keyword` | `tinyInteger` | no | 0 |  |  |  |
| `` | `` |  |  |  |  |  |
| `total_records` | `integer` | no | 0 |  |  |  |
| `total_fetched` | `integer` | no | 0 |  |  |  |
| `total_run_remain` | `integer` | no | 0 |  |  |  |
| `` | `` |  |  |  |  |  |
| `total_records` | `dropColumn` | no |  |  |  |  |
| `total_fetched` | `dropColumn` | no |  |  |  |  |
| `total_run_remain` | `dropColumn` | no |  |  |  |  |

## `user_paid_payments`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_user_paid_payments_table.php:16, database/migrations/2023_08_08_051827_create_user_paid_payments_table.php:17, database/migrations/2023_08_08_051827_create_user_paid_payments_table.php:18, database/migrations/2023_08_08_051827_create_user_paid_payments_table.php:19, database/migrations/2023_08_08_051827_create_user_paid_payments_table.php:20, database/migrations/2023_08_08_051827_create_user_paid_payments_table.php:21, database/migrations/2023_08_08_051827_create_user_paid_payments_table.php:22

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `user_id` | `string(100)` | no |  |  |  |  |
| `payment_paid_mode` | `string(50)` | no |  |  |  |  |
| `payment_paid` | `integer` | no |  |  |  |  |
| `payment_date` | `string(50)` | no |  |  |  |  |
| `payment_status` | `integer` | no |  |  |  |  |

## `user_payment_infos`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_user_payment_infos_table.php:16, database/migrations/2023_08_08_051827_create_user_payment_infos_table.php:17, database/migrations/2023_08_08_051827_create_user_payment_infos_table.php:18, database/migrations/2023_08_08_051827_create_user_payment_infos_table.php:19, database/migrations/2023_08_08_051827_create_user_payment_infos_table.php:20, database/migrations/2023_08_08_051827_create_user_payment_infos_table.php:21, database/migrations/2023_08_08_051827_create_user_payment_infos_table.php:22, database/migrations/2023_08_08_051827_create_user_payment_infos_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `payment_type` | `string(50)` | yes |  |  |  |  |
| `payment_limit` | `integer` | yes |  |  |  |  |
| `user_id` | `string(100)` | yes |  |  |  |  |
| `payment_mode` | `string(50)` | yes |  |  |  |  |
| `account_id` | `string(100)` | no |  |  |  |  |
| `bank_details` | `string(100)` | no |  |  |  |  |
| `payment_date` | `dateTime` | no |  |  |  |  |

## `usercomments`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_usercomments_table.php:16, database/migrations/2023_08_08_051827_create_usercomments_table.php:17, database/migrations/2023_08_08_051827_create_usercomments_table.php:18, database/migrations/2023_08_08_051827_create_usercomments_table.php:19, database/migrations/2023_08_08_051827_create_usercomments_table.php:20, database/migrations/2023_08_08_051827_create_usercomments_table.php:21, database/migrations/2023_08_08_051827_create_usercomments_table.php:22, database/migrations/2023_08_08_051827_create_usercomments_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `subject` | `string(100)` | no |  |  |  |  |
| `user_id` | `string(100)` | no |  |  |  |  |
| `message` | `text` | no |  |  |  |  |
| `status` | `string(50)` | no |  |  |  |  |
| `agent` | `string(100)` | no |  |  |  |  |
| `seen_by_agent` | `integer` | yes | 0 |  |  |  |
| `sent_by` | `integer` | no |  |  |  |  |
| `hashtag` | `string(100)` | no |  |  |  |  |
| `expiry` | `string(100)` | no |  |  |  |  |
| `created` | `dateTime` | no |  |  |  |  |

## `users`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_users_table.php:16, database/migrations/2023_08_08_051827_create_users_table.php:17, database/migrations/2023_08_08_051827_create_users_table.php:18, database/migrations/2023_08_08_051827_create_users_table.php:19, database/migrations/2023_08_08_051827_create_users_table.php:20, database/migrations/2023_08_08_051827_create_users_table.php:21, database/migrations/2023_08_08_051827_create_users_table.php:22, database/migrations/2023_08_08_051827_create_users_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `increments` | no |  | PRIMARY |  |  |
| `user_id` | `string(50)` | no |  |  |  |  |
| `fbid` | `string(255)` | yes |  |  |  |  |
| `google_id` | `string(255)` | no |  |  |  |  |
| `email` | `string(255)` | yes |  | email |  |  |
| `password` | `string(255)` | yes |  |  |  |  |
| `username` | `string(255)` | no |  |  |  |  |
| `firstname` | `string(255)` | yes |  |  |  |  |
| `lastname` | `string(255)` | yes |  |  |  |  |
| `job_title` | `string(255)` | no |  |  |  |  |
| `business_type` | `string(255)` | no |  |  |  |  |
| `company` | `string(255)` | no |  |  |  |  |
| `address` | `string(255)` | yes |  |  |  |  |
| `phone` | `string(50)` | yes |  |  |  |  |
| `mobile` | `string(50)` | yes |  |  |  |  |
| `city` | `string(100)` | yes |  |  |  |  |
| `state` | `string(100)` | yes |  |  |  |  |
| `zipcode` | `string(50)` | yes |  |  |  |  |
| `country` | `string(255)` | yes |  |  |  |  |
| `newsletter` | `integer` | no | 0 |  |  |  |
| `activation_key` | `string(255)` | yes |  |  |  |  |
| `user_type` | `enum(['buyer', 'contributor', 'donor', 'potential'])` | yes |  |  |  |  |
| `document_type` | `string(255)` | yes |  |  |  |  |
| `document_file` | `string(255)` | yes |  |  |  |  |
| `payment_option` | `string(255)` | yes |  |  |  |  |
| `bank_name` | `string(255)` | yes |  |  |  |  |
| `bank_account` | `string(255)` | yes |  |  |  |  |
| `swift_code` | `string(255)` | yes |  |  |  |  |
| `rtgs_neft_code` | `string(255)` | yes |  |  |  |  |
| `iban_no` | `string(255)` | yes |  |  |  |  |
| `intermeditary_bank_name` | `string(255)` | yes |  |  |  |  |
| `intermeditary_bank_acc` | `string(255)` | yes |  |  |  |  |
| `paypalID` | `string(250)` | yes |  |  |  |  |
| `active` | `integer` | no | 0 | active |  |  |
| `created` | `dateTime` | yes |  |  |  |  |
| `modified` | `dateTime` | yes |  |  |  |  |
| `ip_addr` | `string(50)` | no |  |  |  |  |
| `block_invoice` | `integer` | no | 0 |  |  |  |

## `wish_lists`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_wish_lists_table.php:16, database/migrations/2023_08_08_051827_create_wish_lists_table.php:17, database/migrations/2023_08_08_051827_create_wish_lists_table.php:18, database/migrations/2023_08_08_051827_create_wish_lists_table.php:19, database/migrations/2023_08_08_051827_create_wish_lists_table.php:20, database/migrations/2023_08_08_051827_create_wish_lists_table.php:21, database/migrations/2023_08_08_051827_create_wish_lists_table.php:22, database/migrations/2023_08_08_051827_create_wish_lists_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `session_id` | `string(255)` | yes |  | session_id |  |  |
| `product_id` | `string(100)` | yes |  | product_id |  |  |
| `quantity` | `integer` | yes |  |  |  |  |
| `price` | `decimal(10, 2)` | yes |  |  |  |  |
| `status` | `string(50)` | no |  |  |  |  |
| `attribute_id` | `string(255)` | yes |  |  |  |  |
| `attribute_value_id` | `string(255)` | yes |  |  |  |  |
| `attribute_name` | `string(255)` | yes |  |  |  |  |
| `created` | `dateTime` | yes |  |  |  |  |
| `modified` | `dateTime` | yes |  |  |  |  |
| `size` | `string(255)` | yes |  |  |  |  |
| `user_id` | `string(100)` | yes |  |  |  |  |
| `product_type` | `string(50)` | yes |  |  |  |  |
| `usageType` | `string(50)` | yes |  |  |  |  |
| `type_of_usage` | `string(50)` | yes |  |  |  |  |
| `catDisplay2` | `string(50)` | yes |  |  |  |  |
| `catDisplay3` | `string(100)` | yes |  |  |  |  |
| `catDisplay4` | `string(100)` | yes |  |  |  |  |
| `catDisplay5` | `string(100)` | yes |  |  |  |  |
| `catDisplay6` | `string(100)` | yes |  |  |  |  |
| `catDisplay7` | `string(100)` | yes |  |  |  |  |
| `territoryType` | `string(100)` | yes |  |  |  |  |
| `Territory` | `string(100)` | yes |  |  |  |  |
| `Territory1` | `string(100)` | yes |  |  |  |  |
| `Territory2` | `string(100)` | yes |  |  |  |  |
| `Duration` | `string(100)` | yes |  |  |  |  |
| `StartYear` | `string(100)` | yes |  |  |  |  |
| `Industry` | `string(100)` | yes |  |  |  |  |
| `catTitle1_name` | `string(100)` | yes |  |  |  |  |
| `catTitle2_name` | `string(100)` | yes |  |  |  |  |
| `catTitle3_name` | `string(100)` | yes |  |  |  |  |
| `catTitle4_name` | `string(100)` | yes |  |  |  |  |
| `catTitle5_name` | `string(100)` | yes |  |  |  |  |
| `catTitle6_name` | `string(100)` | yes |  |  |  |  |
| `catTitle7_name` | `string(100)` | yes |  |  |  |  |
| `endDate` | `string(100)` | no |  |  |  |  |
| `product_web` | `string(100)` | yes |  |  |  |  |
| `pond_cart_data` | `text` | yes |  |  |  |  |

## `wishlist_folder`

Models: `Wishlist`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_061229_create_wishlist_folder_table.php:16, database/migrations/2023_08_08_061229_create_wishlist_folder_table.php:17, database/migrations/2023_08_08_061229_create_wishlist_folder_table.php:18, database/migrations/2023_08_08_061229_create_wishlist_folder_table.php:19, database/migrations/2023_08_08_061229_create_wishlist_folder_table.php:20

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `user_id` | `integer` | no |  |  |  |  |
| `folder_name` | `string(255)` | no |  |  |  |  |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |

## `wishlist_folder_itmes`

Models: `WishlistItem`  
Migration operations: create  
Evidence: database/migrations/2023_08_08_061251_create_wishlist_folder_itmes_table.php:16, database/migrations/2023_08_08_061251_create_wishlist_folder_itmes_table.php:17, database/migrations/2023_08_08_061251_create_wishlist_folder_itmes_table.php:18, database/migrations/2023_08_08_061251_create_wishlist_folder_itmes_table.php:19, database/migrations/2023_08_08_061251_create_wishlist_folder_itmes_table.php:20

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `wishlist_folder_id` | `integer` | no |  |  |  |  |
| `item` | `string(255)` | no |  |  |  |  |
| `created_at` | `timestamp` |  | nullable |  |  |  |
| `updated_at` | `timestamp` |  | nullable |  |  |  |

## `zip_codes`

Models: No explicit model table mapping found  
Migration operations: create  
Evidence: database/migrations/2023_08_08_051827_create_zip_codes_table.php:16, database/migrations/2023_08_08_051827_create_zip_codes_table.php:17, database/migrations/2023_08_08_051827_create_zip_codes_table.php:18, database/migrations/2023_08_08_051827_create_zip_codes_table.php:19, database/migrations/2023_08_08_051827_create_zip_codes_table.php:20, database/migrations/2023_08_08_051827_create_zip_codes_table.php:21, database/migrations/2023_08_08_051827_create_zip_codes_table.php:22, database/migrations/2023_08_08_051827_create_zip_codes_table.php:23

| Column/constraint | Type | Null | Default | Key/index | Foreign key | Comment |
|---|---|---|---|---|---|---|
| `` | `` |  |  |  |  |  |
| `id` | `integer(true)` | no |  |  |  |  |
| `zip_code` | `string(5)` | no |  | zip_code |  |  |
| `lat` | `decimal(10, 2)` | no |  |  |  |  |
| `lon` | `decimal(10, 2)` | no |  |  |  |  |
| `city` | `string(100)` | no |  | city |  |  |
| `state_prefix` | `string(100)` | no |  |  |  |  |
| `county` | `string(100)` | no |  |  |  |  |
| `z_type` | `string(100)` | no |  |  |  |  |
| `xaxis` | `decimal(10, 2)` | no |  |  |  |  |
| `yaxis` | `decimal(10, 2)` | no |  |  |  |  |
| `zaxis` | `decimal(10, 2)` | no |  |  |  |  |
| `z_primary` | `string(100)` | no |  |  |  |  |
| `country` | `string(100)` | no |  | country |  |  |
| `state_name` | `string(255)` | no |  |  |  | 'US State Name' |
| `['state_prefix` | `constraint:index` |  |  |  |  |  |

