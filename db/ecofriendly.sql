-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 22, 2024 at 02:11 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecofriendly`
--

-- --------------------------------------------------------

--
-- Table structure for table `businesses`
--

DROP TABLE IF EXISTS `businesses`;
CREATE TABLE IF NOT EXISTS `businesses` (
  `business_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `description` text,
  `image_url` varchar(30) NOT NULL,
  `category_id` int DEFAULT NULL,
  `address` varchar(75) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `owner_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`business_id`),
  KEY `category_id` (`category_id`),
  KEY `owner_id` (`owner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `businesses`
--

INSERT INTO `businesses` (`business_id`, `name`, `description`, `image_url`, `category_id`, `address`, `latitude`, `longitude`, `owner_id`, `created_at`) VALUES
(1, 'Pela Case', 'Sells eco-friendly household products.', 'pela-logo-new-grey.webp', 1, 'Unit 2 Blackfriars Rd, Nailsea, Bristol BS48 4DJ, United Kingdom', 51.42586900, -2.78209700, 1, '2024-03-27 16:13:31'),
(2, 'EcoFlow', 'Organic food products and snacks.', 'ecoflow-logo-vector.png', 2, 'EcoFlow UK Services Limited', 51.12022680, -2.49860750, 2, '2024-03-27 16:13:31'),
(3, 'Oakywood', 'Renewable energy gadgets and accessories.', 'Oakywood.jpg', 3, 'WH82+98 Derby, United Kingdom', 52.91593930, -6.72260940, 3, '2024-03-27 16:13:31'),
(4, 'Wigglywoos', 'Eco-friendly packaging materials.', 'wigglywoo.webp', 4, '60 Salehurst Rd, Ipswich IP3 8SD, United Kingdom', 52.68144950, -6.72332940, 4, '2024-03-27 16:13:31'),
(5, 'Harry Barker', 'Sustainable fashion clothing line.', 'HarryBarker_Logo.webp', 5, 'Wrey Villa, Wreyland Path, Lustleigh, Newton Abbot TQ13 9TS, United Kingdom', 50.93180010, -4.19613440, 5, '2024-03-27 16:13:31');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `description` text,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`) VALUES
(1, 'Recycling', 'Products designed to be recycled or used in recycling processes'),
(2, 'Organic', 'Goods produced using organically farmed ingredients'),
(3, 'Renewable Energy', 'Products that utilize or support renewable energy sources'),
(4, 'Eco-friendly Pa', 'Packaging solutions that reduce environmental impact'),
(5, 'Sustainable Fas', 'Clothing made from eco-friendly materials and practices');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `img_id` int NOT NULL,
  `img_name` varchar(35) NOT NULL,
  `img_price` decimal(6,2) NOT NULL,
  `img_url` varchar(12) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`img_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`img_id`, `img_name`, `img_price`, `img_url`, `product_id`) VALUES
(1, 'Stonehenge, Windsor Castle, and Bat', 10.00, '1.jpg', 1),
(2, 'Big Bus London Hop-On Hop-Off Tour ', 15.00, '2.webp', 2),
(3, 'Stonehenge, Windsor Castle and Bath', 25.00, '3.webp', 3),
(4, 'Cutty Sark', 35.00, '4.webp', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `order_date` date NOT NULL,
  `cost_total` decimal(7,2) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10038 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `cost_total`) VALUES
(1, 1, '2024-10-01', 0.00),
(2, 2, '2024-10-02', 0.00),
(3, 3, '2024-10-03', 0.00),
(4, 4, '2024-10-04', 0.00),
(5, 5, '2024-10-05', 0.00),
(2100, 854, '2024-04-02', 170.00),
(7160, 0, '2024-04-02', 0.00),
(10037, 854, '2024-04-02', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `order_details_id` int NOT NULL AUTO_INCREMENT,
  `quantity` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`order_details_id`),
  KEY `order_id` (`order_id`),
  KEY `img_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_details_id`, `quantity`, `order_id`, `product_id`) VALUES
(5, 1, 2100, 1),
(6, 1, 2100, 2),
(7, 1, 2100, 3),
(8, 1, 2100, 4);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `description` text,
  `product_price` decimal(6,2) NOT NULL,
  `business_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`),
  KEY `business_id` (`business_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `product_price`, `business_id`, `category_id`, `created_at`) VALUES
(1, 'Compostable audio accesso', 'Pela Case sells compostable cases for phones and AirPods, and the brand’s site boasts that the production of its products produces 30% fewer carbon emissions and uses 34% less water than production of conventional cases. ', 40.00, 1, 1, '2024-03-27 16:13:31'),
(2, 'Solar energy devices', 'EcoFlow manufactures clean generators, portable solar panels, and power chargers that use renewable energy to keep gadgets running on the go. ', 50.00, 2, 2, '2024-03-27 16:13:31'),
(3, 'Sustainable office access', 'Oakywood is a maker of home office tech accessories created using natural materials like wood, cork, and wool. For every handcrafted item the brand sells, one tree is planted. At the time of publication, Oakywood has planted more than 87,000 trees.', 50.00, 3, 3, '2024-03-27 16:13:31'),
(4, 'Vegan pet accessories', 'Wigglywoos is a pet brand that’s committed to using animal-free products to produce its products. That includes hemp- and cork-based vegan leather. All products are made sustainably in small batches in the Wigglywoos home studio.', 30.00, 4, 4, '2024-03-27 16:13:31'),
(5, 'Pet toys made from recycl', 'Harry Barker is known for its designer dog toys and accessories. But there’s more than meets the eye: Many of its products are made sustainably. From recycled yarn toys to leashes made from recycled plastic bottles, Harry Barker blends high-end design with earth-friendly materials, while reducing plastic waste. ', 20.00, 5, 5, '2024-03-27 16:13:31');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `review_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `business_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `comment` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`review_id`),
  KEY `user_id` (`user_id`),
  KEY `business_id` (`business_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `business_id`, `product_id`, `rating`, `comment`, `created_at`) VALUES
(1, 1, 1, 1, 4.5, 'Great quality and eco-friendly!', '2024-03-27 16:13:50'),
(2, 2, 2, 2, 4, 'Tasty and organic, but a bit pricey.', '2024-03-27 16:13:50'),
(3, 3, 3, 3, 5, 'Very efficient and easy to use.', '2024-03-27 16:13:50'),
(4, 4, 4, 4, 4.5, 'Strong and durable packaging.', '2024-03-27 16:13:50'),
(5, 5, 5, 5, 5, 'Comfortable and stylish, love the sustainability aspect.', '2024-03-27 16:13:50');

-- --------------------------------------------------------

--
-- Table structure for table `temp_cart`
--

DROP TABLE IF EXISTS `temp_cart`;
CREATE TABLE IF NOT EXISTS `temp_cart` (
  `session` char(50) NOT NULL,
  `product_id` int NOT NULL,
  `qty` int UNSIGNED NOT NULL,
  PRIMARY KEY (`session`,`product_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `temp_cart`
--

INSERT INTO `temp_cart` (`session`, `product_id`, `qty`) VALUES
('hn9idnckbnvmv2pu2g6qmhk0gr', 1, 1),
('hn9idnckbnvmv2pu2g6qmhk0gr', 2, 1),
('hn9idnckbnvmv2pu2g6qmhk0gr', 3, 1),
('hn9idnckbnvmv2pu2g6qmhk0gr', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(12) NOT NULL,
  `last_name` varchar(12) NOT NULL,
  `email` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone_number` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` varchar(75) NOT NULL,
  `zip_code` char(5) NOT NULL,
  `state` varchar(12) NOT NULL,
  `password_hash` varchar(55) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone_number` (`phone_number`)
) ENGINE=MyISAM AUTO_INCREMENT=11887 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `phone_number`, `address`, `zip_code`, `state`, `password_hash`, `created_at`) VALUES
(1, 'John', 'George', 'john.george@gmail.com', '+4434567890', '1234 Elm Street, Springfield, UK', '', '', '5347079dd43a48d37fbd03d2174b1724c4e66ba3618ca9c306c6bc1', '2024-03-27 16:13:31'),
(2, 'Frank', 'Lampard', 'frank.lampard@gmail.com', '+4487654321', '5678 Oak Street, Springfield, UK', '', '', '7a1a85baecf46c24b51fe1549ee2586771f9eff4d60fe10229d169f', '2024-03-27 16:13:31'),
(3, 'John', 'Terk', 'john.terk@gmail.com', '+4445678901', '91011 Pine Street, Springfield, UK', '', '', 'c268c7653738f603c8ed1ee5584e2755413341fd9113553eac4120e', '2024-03-27 16:13:31'),
(4, 'Rakesh', 'Ramia', 'rakesh.ramia@gmail.com', '+4476543210', '1213 Maple Street, Springfield, UK', '', '', 'c268c7653738f603c8ed1ee5584e2755413341fd9113553eac4120e', '2024-03-27 16:13:31'),
(5, 'Mary', 'Jackson', 'mark.jackson@gmail.com', '+4498765432', '1415 Cedar Street, Springfield, UK', '', '', '8f17d9812607e6956b04e1a4f1721479dc8c07741a4ff5fbbb10941', '2024-03-27 16:13:31'),
(854, 'Joseph', 'Karuri', 'UVJZRmtlbFhqZnk0YTgzRnJvcFRNeVBPOXNEU0wwMTgyZFRKZHhubXBnZz0=', 'eUFzdTNzRTNzTlZIcTY3TEl6Zzd5dz09', 'London,UK', '1234', 'Karuma Stree', 'dzgvZFFiWVZMNDVZc0g2My9FK1hWdz09', '2024-04-02 09:37:53');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
