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

ALTER TABLE `imagefootage_performa_invoices` ADD `expiry_due_date` INT NULL AFTER `end_client`;
ALTER TABLE `imagefootage_packages` ADD `package_expiry_quarterly` INT NULL AFTER `home_view`;
ALTER TABLE `imagefootage_packages` ADD `package_expiry_half_yearly` INT NULL AFTER `package_expiry_quarterly`;
ALTER TABLE `imagefootage_performa_invoice_items` CHANGE `licence_type` `licence_type` LONGTEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;
ALTER TABLE `imagefootage_performa_invoices` ADD `cancelled_by` INT NULL COMMENT 'cancelled by user id, if null then cancelled by cron' AFTER `expiry_due_date`;
ALTER TABLE `imagefootage_performa_invoices` ADD `cancelled_on` DATETIME NULL AFTER `cancelled_by`;

--  imagefootage_performa_invoices
ALTER TABLE `imagefootage_performa_invoices`  ADD `promo_code_id` INT NULL  AFTER `invoice_name`;

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