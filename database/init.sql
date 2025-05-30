CREATE TABLE IF NOT EXISTS `products` (
                            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                            `code` VARCHAR(255)    NOT NULL,
                            `name` VARCHAR(255)   NOT NULL,
                            `category_level1` VARCHAR(255) NOT NULL,
                            `category_level2` VARCHAR(255) DEFAULT NULL,
                            `category_level3` VARCHAR(255) DEFAULT NULL,
                            `price` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
                            `price_sp` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
                            `quantity` INT        NOT NULL DEFAULT 0,
                            `property_fields` TEXT,
                            `joint_purchases` TEXT,
                            `unit` TEXT    NOT NULL,
                            `image_path` VARCHAR(512) DEFAULT NULL,
                            `show_on_main` TINYINT(1) NOT NULL DEFAULT 0,
                            `description` TEXT,
                            `created_at` TIMESTAMP   NULL DEFAULT NULL,
                            `updated_at` TIMESTAMP   NULL DEFAULT NULL,
                            PRIMARY KEY (`id`),
                            UNIQUE KEY `uniq_code` (`code`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;
