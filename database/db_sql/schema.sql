-- Note: Use CREATE TABLE IF NOT EXISTS, Remove After column name

-- Table : promo_codes

CREATE TABLE IF NOT EXISTS `promo_codes` (
 `id` int NOT NULL AUTO_INCREMENT,
 `name` varchar(255) DEFAULT NULL,
 `type` varchar(255) DEFAULT NULL,
 `max_usage` int DEFAULT NULL,
 `total_applied_code` int DEFAULT NULL,
 `discount` varchar(255) DEFAULT NULL,
 `valid_upto_type` varchar(255) DEFAULT NULL,
 `valid_start_date` date DEFAULT NULL,
 `valid_till_date` date DEFAULT NULL,
 `status` enum('1','0') NOT NULL DEFAULT '1',
 `will_apply_by` enum('1','2','3') DEFAULT NULL COMMENT '1- frontend, 2- backend, 3- all',
 PRIMARY KEY (`id`)
);

-- If terms granted selected, then enable one options for ""how many days"" due date like: 7 days, 15 days, 30 days and 45 days
ALTER TABLE `imagefootage_performa_invoices` ADD `expiry_due_date` INT NULL;
ALTER TABLE `imagefootage_packages` ADD `package_expiry_quarterly` INT NULL;
ALTER TABLE `imagefootage_packages` ADD `package_expiry_half_yearly` INT NULL;

-- For licence_type now use ckeditor instead of textbox
ALTER TABLE `imagefootage_performa_invoice_items` CHANGE `licence_type` `licence_type` LONGTEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;

-- Store cancelled by user id, if null then cancelled by cron
ALTER TABLE `imagefootage_performa_invoices` ADD `cancelled_by` INT NULL COMMENT 'cancelled by user id, if null then cancelled by cron';

-- Quotation cancelled on date
ALTER TABLE `imagefootage_performa_invoices` ADD `cancelled_on` DATETIME NULL;

--  imagefootage_performa_invoices
ALTER TABLE `imagefootage_performa_invoices`  ADD `promo_code_id` INT NULL;


-- Discount message module for display discount in frontend page wise
CREATE TABLE IF NOT EXISTS `discount_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `page_type` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NULL,
  `link` varchar(255) NOT NULL,
  `button_text` varchar(255) NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL,
  `updated_at` timestamp NULL,
   PRIMARY KEY (`id`)
);

-- Display new module "discount message" in sidemenu
INSERT INTO `imagefootage_modules` (`id`, `module_name`, `url`, `parent_module_id`, `status`, `sort_order`, `created_at`, `updated_at`, `module_icon`) VALUES
(100, 'List Discount Messages', 'list_discount_message', 101, 'A', NULL, NULL, NULL, NULL),
(101, 'Discount Messages', NULL, 0, 'A', 93, NULL, NULL, 'fa fa-tag'),
(102, 'Add Discount Message', 'add_discount_message', 101, 'A', NULL, NULL, NULL, NULL);

-- User profile page add new field address2
ALTER TABLE `imagefootage_users` ADD `address2` TEXT NULL;

-- Page type / slug
ALTER TABLE `imagefootage_promotion` ADD `page_type` VARCHAR(20) NULL DEFAULT NULL;

-- Desktop screen banner image
ALTER TABLE `imagefootage_promotion` ADD `desktop_banner_image` VARCHAR(255) NULL DEFAULT NULL;

-- Mobile screen banner image
ALTER TABLE `imagefootage_promotion` ADD `mobile_banner_image` VARCHAR(255) NULL DEFAULT NULL;

-- Verify registration use token and expiry datetime
ALTER TABLE `imagefootage_users` ADD `email_verify_token` VARCHAR(255) NULL, ADD `token_valid_date` DATETIME NULL;

-- Verify registration use otp expiry datetime
ALTER TABLE `imagefootage_users` ADD `otp_valid_date` DATETIME NULL;

-- Static pages page slug value store
ALTER TABLE `imagefootage_staticpages` ADD `page_slug` VARCHAR(255) NULL DEFAULT NULL;

-- Settings table
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `status` tinyint NOT NULL,
  PRIMARY KEY (`id`)
);

ALTER TABLE `imagefootage_usercontactus` ADD `contactus_subject` VARCHAR(255) NULL;

CREATE TABLE IF NOT EXISTS `trending_words` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `count` bigint NOT NULL,
  PRIMARY KEY (`id`)
);


-- Table : imagefootage_performa_invoices
ALTER TABLE `imagefootage_performa_invoices`  ADD `payment_by` INT NOT NULL DEFAULT '1' COMMENT 'payment by 1- frontend 0- backend'  AFTER `status`;

-- Add column for display package in api or backend
ALTER TABLE `imagefootage_packages`  ADD `display_for` 	tinyint NULL COMMENT '1=Frontend,2=Backend,3=All';

CREATE TABLE IF NOT EXISTS `imagefootage_wishlists` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` MEDIUMTEXT DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `imagefootage_users_wishlist` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_id` BIGINT UNSIGNED,
    `wishlist_id` BIGINT UNSIGNED,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES imagefootage_users(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`wishlist_id`) REFERENCES imagefootage_wishlists(`id`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `imagefootage_wishlist_products` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `wishlist_id` BIGINT UNSIGNED,
    `product_id` BIGINT UNSIGNED,
    `type` ENUM('image', 'footage', 'music') NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`wishlist_id`) REFERENCES imagefootage_wishlists(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`product_id`) REFERENCES imagefootage_products(`id`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `imagefootage_shared_wishlists_logs` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `shared_by_user_id` BIGINT UNSIGNED,
    `shared_wishlist_id` BIGINT UNSIGNED,
    `shared_with_user_id` BIGINT UNSIGNED,
    `new_wishlist_id` BIGINT UNSIGNED,
    `shared_product_ids` TEXT,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`shared_by_user_id`) REFERENCES imagefootage_users(`id`),
    FOREIGN KEY (`shared_wishlist_id`) REFERENCES imagefootage_wishlists(`id`),
    FOREIGN KEY (`shared_with_user_id`) REFERENCES imagefootage_users(`id`),
    FOREIGN KEY (`new_wishlist_id`) REFERENCES imagefootage_wishlists(`id`)
);

CREATE TABLE IF NOT EXISTS `imagefootage_editorials` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) DEFAULT NULL,
  `type` ENUM('story', 'collection') NOT NULL,
  `search_term` VARCHAR(255) DEFAULT NULL,
  `selected_values` TEXT NULL,  
  `main_image_id` VARCHAR(50) DEFAULT NULL,
  `main_image_selected_values` TEXT NULL, 
  `main_image_upload` VARCHAR(255) DEFAULT NULL, 
  `status` TINYINT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT NULL,
  `updated_at` TIMESTAMP DEFAULT NULL,
  PRIMARY KEY (`id`)
);