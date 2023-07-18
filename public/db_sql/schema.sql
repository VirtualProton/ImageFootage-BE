-- Table : promo_codes

CREATE TABLE `promo_codes` (
 `id` int NOT NULL AUTO_INCREMENT,
 `name` varchar(255) DEFAULT NULL,
 `type` varchar(255) DEFAULT NULL,
 `max_usage` varchar(255) DEFAULT NULL,
 `valid_upto_type` varchar(255) DEFAULT NULL,
 `valid_till_date` date DEFAULT NULL,
 `status` enum('1','0') NOT NULL DEFAULT '1',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

