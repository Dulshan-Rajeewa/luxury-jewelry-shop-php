-- Create database
CREATE DATABASE IF NOT EXISTS luxurious_legacy_store;
USE luxurious_legacy_store;

-- --------------------------------------------------------

-- Table structure for `users`
CREATE TABLE `users` (
  `user_id` INT(11) NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(100) NOT NULL,
  `last_name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `phone_number` VARCHAR(20),
  `address` TEXT,
  `password_hash` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- Table structure for `products`
CREATE TABLE `products` (
  `product_id` INT(11) NOT NULL AUTO_INCREMENT,
  `product_name` VARCHAR(255) NOT NULL,
  `product_price` DECIMAL(10,2) NOT NULL,
  `product_image_url` VARCHAR(255),
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- Table structure for `cart`
CREATE TABLE `cart` (
  `cart_id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11),
  `product_id` INT(11),
  `quantity` INT(11) DEFAULT 1,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cart_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- Sample data for `products`
INSERT INTO `products` (`product_name`, `product_price`, `product_image_url`, `created_at`, `updated_at`) VALUES
('Rolex Man Made Watch', 545.00, 'img/Rolex_Watch.jpg', NOW(), NOW()),
('Archetype Caspian Automatic Rose Gold Black Brown', 179.99, 'img/Archetype Caspian Automatic Rose Gold Black Brown.png', NOW(), NOW()),
('Archetype Loyalist Automatic All Black', 279.99, 'img/Archetype Loyalist Automatic All Black.png', NOW(), NOW()),
('Archetype Rogue Automatic Silver Black', 279.99, 'img/Archetype Rogue Automatic Silver Black.png', NOW(), NOW()),
('Graduated Link Necklace', 19400.00, 'img/Graduated Link Necklace.png', NOW(), NOW()),
('Small Wrap Necklace', 27000.00, 'img/Small Wrap Necklace.png', NOW(), NOW()),
('Full Heart Toggle Necklace', 47900.99, 'img/Full Heart Toggle Necklace.png', NOW(), NOW()),
('X Link Necklace', 225000.00, 'img/X Link Necklace.png', NOW(), NOW()),
('Esme Platinum 2.00ct F SI1 Brilliant Cut Diamond Solitaire Ring', 34075.00, 'img/Esme Platinum 2.00ct F SI1 Brilliant Cut Diamond Solitaire Ring.png', NOW(), NOW()),
('Platinum 3.00ct Brilliant Cut Diamond Solitaire Ring', 99500.00, 'img/Platinum 3.00ct Brilliant Cut Diamond Solitaire Ring.png', NOW(), NOW()),
('Platinum 1.40ct Fancy Intense Yellow Diamond & 0.16 White Diamond Ring', 16750.00, 'img/Platinum 1.40ct Fancy Intense Yellow Diamond & 0.16 White Diamond Ring.png', NOW(), NOW()),
('Platinum Evie 3.70ct Sapphire and 0.68ct Diamond Halo Engagement Ring', 15500.00, 'img/Platinum Evie 3.70ct Sapphire and 0.68ct Diamond Halo Engagement Ring.png', NOW(), NOW()),
('LOVE bracelet, classic model', 7350.00, 'img/LOVE bracelet, classic model.png', NOW(), NOW()),
('Juste un Clou bracelet, small model, diamonds', 5050.00, 'img/Juste un Clou bracelet, small model, diamonds.png', NOW(), NOW()),
('LOVE bracelet, on chain, 2 diamonds', 2280.00, 'img/LOVE bracelet, on chain, 2 diamonds.png', NOW(), NOW()),
('LOVE bracelet, on chain', 1910.00, 'img/LOVE bracelet, on chain.png', NOW(), NOW());
