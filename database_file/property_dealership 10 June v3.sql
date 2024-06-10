-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2024 at 07:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `property_dealership`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `permissions` varchar(255) DEFAULT NULL,
  `type` tinyint(4) DEFAULT 1 COMMENT '0= super_admin, 1 = staff user',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 = inactive, 1 = active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `email`, `password`, `phone_no`, `permissions`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$12$3a8mjCQxD54t89r/w7STAOl3xBFdmmByfEj70DV92knLbkdNfaLU6', NULL, NULL, 0, 1, '2022-04-15 12:25:42', '2023-12-26 12:03:02');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1: Interior Feature, 2: Exterior Finish, 3: Featured Amenities, 4: Appliances, 5: Views, 6: Heating, 7: Cooling, 8: Roof, 9: Sewer-Water Systems, 10: Extra Features',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: Inactive, 1: Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `title`, `slug`, `type`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Breakfast Nook', 'breakfast-nook', 1, 1, '2024-06-04 02:49:09', '2024-06-04 02:49:09'),
(4, 'Brick', 'brick', 2, 1, '2024-06-04 02:49:25', '2024-06-04 02:49:25'),
(5, 'Stucco', 'stucco', 2, 1, '2024-06-04 02:49:37', '2024-06-04 02:49:37'),
(6, 'Laundry Room', 'laundry-room', 1, 1, '2024-06-04 02:49:51', '2024-06-04 02:49:51'),
(7, 'Landscaped', 'landscaped', 3, 1, '2024-06-04 02:50:01', '2024-06-04 06:39:04'),
(8, 'Tennis Court', 'tennis-court', 3, 1, '2024-06-07 01:58:51', '2024-06-07 01:58:51'),
(9, 'Garbage Disposal', 'garbage-disposal', 4, 1, '2024-06-07 01:59:04', '2024-06-07 01:59:04'),
(10, 'Dishwasher', 'dishwasher', 4, 1, '2024-06-07 01:59:13', '2024-06-07 01:59:13'),
(11, 'City Lights', 'city-lights', 5, 1, '2024-06-07 01:59:28', '2024-06-07 01:59:28'),
(12, 'Mountain View', 'mountain-view', 5, 1, '2024-06-07 01:59:39', '2024-06-07 01:59:39'),
(13, 'Central Electric', 'central-electric', 6, 1, '2024-06-07 01:59:48', '2024-06-07 01:59:48'),
(14, 'Central Air', 'central-air', 7, 1, '2024-06-07 01:59:56', '2024-06-07 01:59:56'),
(15, 'Public', 'public', 9, 1, '2024-06-07 02:00:19', '2024-06-07 02:00:19'),
(16, 'City Water', 'city-water', 9, 1, '2024-06-07 02:00:44', '2024-06-07 02:00:44'),
(17, 'Tiled', 'tiled', 8, 1, '2024-06-07 02:00:52', '2024-06-07 02:00:52'),
(18, 'Security Guard on Duty', 'security-guard-on-duty', 10, 1, '2024-06-07 02:01:01', '2024-06-07 02:01:01'),
(19, 'Cable TV Available', 'cable-tv-available', 10, 1, '2024-06-07 02:01:11', '2024-06-07 02:01:11'),
(20, 'Public Transportation', 'public-transportation', 10, 1, '2024-06-07 02:01:39', '2024-06-07 02:01:39'),
(21, 'Reserved Parking', 'reserved-parking', 10, 1, '2024-06-07 02:01:46', '2024-06-07 02:01:46'),
(22, 'Wheelchair Access', 'wheelchair-access', 10, 1, '2024-06-07 02:01:51', '2024-06-07 02:01:51'),
(23, 'Lobby', 'lobby', 10, 1, '2024-06-07 02:02:10', '2024-06-07 02:02:10'),
(24, 'Fitness Center', 'fitness-center', 10, 1, '2024-06-07 02:02:20', '2024-06-07 02:02:20'),
(25, 'Furnished', 'furnished', 10, 1, '2024-06-07 02:02:28', '2024-06-07 02:02:28');

-- --------------------------------------------------------

--
-- Table structure for table `neighborhoods`
--

CREATE TABLE `neighborhoods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `map` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: Inactive, 1: Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `neighborhoods`
--

INSERT INTO `neighborhoods` (`id`, `title`, `slug`, `code`, `banner`, `zip`, `country`, `state`, `city`, `map`, `longitude`, `latitude`, `images`, `description`, `status`, `created_at`, `updated_at`) VALUES
(13, 'La Jolla Excellence', 'la-jolla-excellence20', 'LJE7', 'LJE71717998724.webp', '11501', 'Mexico', 'Baja California', 'Rosarito', NULL, '-117.06248545745179', '32.36587819193149', '\"[\\\"751717998671.jpg\\\",\\\"7191717998671.webp\\\",\\\"7121717998672.webp\\\",\\\"1791717998672.webp\\\",\\\"9821717998672.webp\\\"]\"', '<p>La Jolla Excellence is a premier residential development situated in Playas de Rosarito, Baja California, Mexico.</p><p>This opulent community boasts an extensive selection of premium villas and condos for sale that ensure unparalleled comfort and convenience for homeowners.</p><p>With breathtaking ocean vistas, top-of-the-line amenities, and convenient access to local attractions, La Jolla Excellence stands out as the ideal destination for those seeking a sophisticated lifestyle in a stunning seaside location.</p><p>Explore our range of Rosarito Real Estate options today!</p><h2><strong>Real Estate Options in La Jolla Excellence Vill</strong>as</h2><p>La Jolla Excellence offers 105 villas, each boasting a private garage and ranging in size from 2,500 to 4,200 square feet.&nbsp;</p><p>These spacious and elegant homes are designed to cater to the needs of discerning homeowners, with high-quality construction and premium finishes throughout.&nbsp;</p><p>With ample living space and breathtaking views, these villas provide the perfect setting for a luxurious lifestyle in Rosarito.</p><h2><strong>Condos</strong></h2><p>In addition to the villas, La Jolla Excellence features five high-rise condominium complexes with units ranging from two to four bedrooms.&nbsp;</p><p>These condos offer a more affordable option for those seeking a stylish and comfortable home in the Rosarito area.&nbsp;</p><p>With a variety of configurations and sizes to choose from, buyers are sure to find the perfect condo to suit their needs and preferences.</p><p><img src=\"https://mybajaproperty.com/wp-content/uploads/2023/12/La_Jolla_Excellence_43.webp\" alt=\"\"></p><h2><strong>La Jolla Excellence Amenities</strong></h2><p>La Jolla Excellence is known for its exceptional amenities, available exclusively to residents and their guests. These amenities cater to a variety of interests and preferences, ensuring that everyone in the community can enjoy a fulfilling and enjoyable lifestyle.</p><p>&nbsp;</p><h4>Beach</h4><p>Residents of La Jolla Excellence enjoy access to two pristine, private sand beaches, perfect for sunbathing, swimming, or simply enjoying the stunning ocean views. These beaches provide a peaceful and exclusive retreat for homeowners, away from the crowds and noise of public beaches.</p><p>&nbsp;</p><h4>Restaurant and Bar</h4><p>The community features an on-site restaurant and bar, offering delicious dining options and refreshing beverages within the comfort of the development. Residents can enjoy a leisurely meal or a casual drink without ever leaving the community.</p><p>&nbsp;</p><h4>Multiple Pools and Jacuzzis</h4><p>Pools – 2 of them indoor/covered<br>10 Jacuzzis<br>Saunas<br>Steam rooms</p>', 1, '2024-06-10 00:52:04', '2024-06-10 00:52:04');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `neighborhood_id` bigint(20) UNSIGNED NOT NULL,
  `listing_status` tinyint(4) NOT NULL COMMENT '1: For Sale, 2: For Rent, 3: Rented, 4: Sale Pending, 5: Sold',
  `size` varchar(255) NOT NULL,
  `bedrooms` int(11) NOT NULL,
  `bathrooms` int(11) NOT NULL,
  `parking_spaces` int(11) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `gallery` varchar(255) NOT NULL,
  `map` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `dev_lvl` tinyint(4) NOT NULL COMMENT '1: Under Construction, 2: Built, 3: Under Renovation, 4: Renovated',
  `year_built` varchar(255) NOT NULL,
  `property_tax` varchar(255) NOT NULL,
  `hoa_fees` varchar(255) NOT NULL,
  `rent_cycle` tinyint(4) NOT NULL COMMENT '1: Monthly, 2: Quarterly, 3: Semi-Annually, 4: Annually',
  `date_available` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: Inactive, 1: Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `listing_type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=Sale, 2=Rent',
  `lattitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `code`, `title`, `slug`, `price`, `neighborhood_id`, `listing_status`, `size`, `bedrooms`, `bathrooms`, `parking_spaces`, `banner`, `gallery`, `map`, `description`, `address`, `country`, `state`, `city`, `dev_lvl`, `year_built`, `property_tax`, `hoa_fees`, `rent_cycle`, `date_available`, `status`, `created_at`, `updated_at`, `listing_type`, `lattitude`, `longitude`) VALUES
(12, 'LJE7S9705', 'La Jolla Excellence Suite 204 Tower 4', 'la-jolla-excellence-suite-204-tower-484', '284000', 13, 1, '560', 5, 3, 1, 'LJE7S70341717998817.jpg', '[\"5791717998799.webp\",\"8311717998800.webp\",\"1311717998800.webp\",\"8181717998836.webp\"]', NULL, '<p>This single-story condo oasis of luxury and elegance is skillfully designed and boasts 3 bedrooms, 2 bathrooms, and a spacious 1,863 square feet, ensuring ample space for a comfortable stay.<br>Prepare to be enchanted by the rich allure that permeates every corner of this property, as it cleverly captivates your senses and immerses you in the euphoric tranquility of the Pacific Ocean.<br>Indulge in the ultimate indoor-outdoor living experience, made even more fulfilling by the oversized oceanfront balcony. This expansive space is perfect for entertaining guests or simply unwinding on a lazy Sunday morning, while enjoying a front-row seat to the mesmerizing sea views.<br>Let the soothing sounds of the ocean and the gentle sea breeze whisk you away into a state of pure relaxation. This condo offers a truly enchanting retreat, where you can savor the beauty of nature and create cherished memories with friends and family.</p><p>INSIDE THE GATED COMMUNITY<br>Lush gardens, access to 2 semi private beaches &amp; 5 star resort amenities liven up this gated oceanfront development. The privileged residential resort was engineered to accommodate refined construction in a key strategic location, thereby enabling effortless comforts &amp; imaginable unperturbed luxuries.<br>Among the countless features the development offers:<br>– Access to 2 semi-private beaches<br>– Indoor &amp; Outdoor pools<br>– Jacuzzis<br>– Saunas<br>– Multiple sports courts<br>– Lush gardens<br>– Secure gated access<br>– 24 / 7 round the clock manned security</p><p>LOCATION, LOCATION, LOCATION<br>Located less than 3 minutes from downtown Rosarito, yet worlds apart from the busy hustle and bustle of the tourist-centric nightlife…<br>La Jolla Excellence is only a 35-minute straight shot south of the San Diego border if crossing by car.<br>Or breeze on through the express border crossing at the Tijuana airport and UBER or Taxi over to your home in less than 45 minutes.</p><p>A picturesque 45 minute drive south down Baja’s golden coast will land you down in Mexico’s very own Napa valley. Known around the world as “Valle de Guadalupe” *Pronounced (Va-Ye) in Spanish.<br>Outside the 24 hour secure gated community there are over a dozen stores and restaurants within a 3 block walking distance radius.<br>As well as round the clock convenience stores &amp; multiple gas stations. This area pampers you with all commodities one could desire.</p><p>TERMS OF RENTALS<br>There is a $75 USD cleaning fee, a $25 registration fee and a $2 per person bracelet fee to be added to the rental.<br>A minimum of 2 night rental is required and there are special discounts for week or longer rentals.</p><p>*PRICE IS DISPLAYED IN U.S. DOLLARS*</p><p><strong>Disclaimer: Information is deemed to be correct but not guaranteed.</strong></p>', 'Suite 204 Tower 4 La Jolla Excellence', 'Mexico', 'Baja California', 'Rosarito', 2, '2003', '250', '120', 1, '2024-06-10 00:00:00', 1, '2024-06-10 00:53:37', '2024-06-10 00:53:59', 1, '32.36529824942238', '-117.06831077373022');

-- --------------------------------------------------------

--
-- Table structure for table `property_features`
--

CREATE TABLE `property_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `feature_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_features`
--

INSERT INTO `property_features` (`id`, `property_id`, `feature_id`, `created_at`, `updated_at`) VALUES
(339, 12, 3, '2024-06-10 00:54:00', '2024-06-10 00:54:00'),
(340, 12, 4, '2024-06-10 00:54:00', '2024-06-10 00:54:00'),
(341, 12, 5, '2024-06-10 00:54:00', '2024-06-10 00:54:00'),
(342, 12, 6, '2024-06-10 00:54:00', '2024-06-10 00:54:00'),
(343, 12, 7, '2024-06-10 00:54:00', '2024-06-10 00:54:00'),
(344, 12, 8, '2024-06-10 00:54:00', '2024-06-10 00:54:00'),
(345, 12, 9, '2024-06-10 00:54:00', '2024-06-10 00:54:00'),
(346, 12, 10, '2024-06-10 00:54:00', '2024-06-10 00:54:00'),
(347, 12, 11, '2024-06-10 00:54:00', '2024-06-10 00:54:00'),
(348, 12, 12, '2024-06-10 00:54:00', '2024-06-10 00:54:00'),
(349, 12, 13, '2024-06-10 00:54:00', '2024-06-10 00:54:00'),
(350, 12, 14, '2024-06-10 00:54:00', '2024-06-10 00:54:00'),
(351, 12, 15, '2024-06-10 00:54:00', '2024-06-10 00:54:00'),
(352, 12, 16, '2024-06-10 00:54:00', '2024-06-10 00:54:00'),
(353, 12, 17, '2024-06-10 00:54:00', '2024-06-10 00:54:00'),
(354, 12, 18, '2024-06-10 00:54:01', '2024-06-10 00:54:01'),
(355, 12, 19, '2024-06-10 00:54:01', '2024-06-10 00:54:01'),
(356, 12, 21, '2024-06-10 00:54:01', '2024-06-10 00:54:01'),
(357, 12, 23, '2024-06-10 00:54:01', '2024-06-10 00:54:01'),
(358, 12, 24, '2024-06-10 00:54:01', '2024-06-10 00:54:01'),
(359, 12, 25, '2024-06-10 00:54:01', '2024-06-10 00:54:01');

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE `property_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `type_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `property_id`, `type_id`, `created_at`, `updated_at`) VALUES
(34, 12, 3, '2024-06-10 00:54:01', '2024-06-10 00:54:01'),
(35, 12, 4, '2024-06-10 00:54:01', '2024-06-10 00:54:01');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `meta_tag` varchar(255) DEFAULT NULL,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `meta_tag`, `meta_key`, `meta_value`) VALUES
(1, 'project', 'site_title', 'My Baja Property'),
(2, 'project', 'short_site_title', 'MBP'),
(3, 'project', 'site_logo', 'logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: Inactive, 1: Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `title`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Condo', 'condo', 1, '2024-06-04 04:09:15', '2024-06-04 04:09:15'),
(3, 'House', 'house', 1, '2024-06-04 04:10:05', '2024-06-04 04:10:05'),
(4, 'Residential', 'residential', 1, '2024-06-04 04:10:18', '2024-06-04 04:10:18'),
(5, 'Commercial', 'commercial', 1, '2024-06-04 04:10:29', '2024-06-04 04:10:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `image_name` varchar(255) DEFAULT 'user.png',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=inactive or del by user, 1=active',
  `is_blocked` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `phone_no`, `image_name`, `status`, `is_blocked`, `created_at`, `updated_at`) VALUES
(92, 'John', 'Doe', 'john@gmail.com', '$2y$12$A1kHkTc5TnFL7swEQMr/KuUvw5jkP7OnoHV.xxe.7Wyg2sGvyIJ9i', '+923394008600', 'user.png', 1, 0, '2023-12-29 09:49:14', '2024-06-03 07:41:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `neighborhoods`
--
ALTER TABLE `neighborhoods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `properties_code_unique` (`code`),
  ADD KEY `properties_neighborhood_id_foreign` (`neighborhood_id`);

--
-- Indexes for table `property_features`
--
ALTER TABLE `property_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_features_property_id_foreign` (`property_id`),
  ADD KEY `property_features_feature_id_foreign` (`feature_id`);

--
-- Indexes for table `property_types`
--
ALTER TABLE `property_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_types_property_id_foreign` (`property_id`),
  ADD KEY `property_types_type_id_foreign` (`type_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `neighborhoods`
--
ALTER TABLE `neighborhoods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `property_features`
--
ALTER TABLE `property_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=360;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_neighborhood_id_foreign` FOREIGN KEY (`neighborhood_id`) REFERENCES `neighborhoods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_features`
--
ALTER TABLE `property_features`
  ADD CONSTRAINT `property_features_feature_id_foreign` FOREIGN KEY (`feature_id`) REFERENCES `features` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `property_features_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_types`
--
ALTER TABLE `property_types`
  ADD CONSTRAINT `property_types_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `property_types_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
