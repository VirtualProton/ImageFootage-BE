-- Note: Use CREATE TABLE IF NOT EXISTS, Remove After column name

-- Table : promo_codes

CREATE TABLE IF NOT EXISTS `promo_codes` (
 `id` int NOT NULL AUTO_INCREMENT,
 `name` varchar(255) DEFAULT NULL,
 `type` varchar(255) DEFAULT NULL,
 `max_usage` varchar(255) DEFAULT NULL,
 `discount` varchar(255) DEFAULT NULL,
 `valid_upto_type` varchar(255) DEFAULT NULL,
 `valid_start_date` date DEFAULT NULL,
 `valid_till_date` date DEFAULT NULL,
 `status` enum('1','0') NOT NULL DEFAULT '1',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

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

-- Page type / slug
ALTER TABLE `imagefootage_promotion` ADD `page_type` VARCHAR(20) NULL DEFAULT NULL;
-- Desktop screen banner image
ALTER TABLE `imagefootage_promotion` ADD `desktop_banner_image` VARCHAR(255) NULL DEFAULT NULL;
-- Mobile screen banner image
ALTER TABLE `imagefootage_promotion` ADD `mobile_banner_image` VARCHAR(255) NULL DEFAULT NULL;

-- Verify registration use token and expiry datetime
ALTER TABLE `imagefootage_users` ADD `email_verify_token` VARCHAR(255) NULL, ADD `token_valid_date` DATETIME NULL;