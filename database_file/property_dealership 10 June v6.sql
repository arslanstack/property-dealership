-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2024 at 03:01 PM
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
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `name`, `designation`, `phone`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Heather Turner', 'Listing Agent', '+1 456 432 2019', '1718021135.jpg', 'Our leading agent specialized in requirements gathering and property management.', '2024-06-10 07:04:41', '2024-06-10 07:05:35'),
(3, 'Helen Turing', 'Secret Agent', '+1 456 432 1892', '1718021204.jpg', 'Our Secret Agent Handling Property Matters of MI6', '2024-06-10 07:06:44', '2024-06-10 07:06:44');

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
(1, 'Hot Tub-Spa', 'hot-tub-spa', 1, 1, '2024-06-10 07:51:33', '2024-06-10 07:51:33'),
(2, 'Kitchen Island', 'kitchen-island', 1, 1, '2024-06-10 07:51:40', '2024-06-10 07:51:40'),
(3, 'Laundry Room', 'laundry-room', 1, 1, '2024-06-10 07:51:48', '2024-06-10 07:51:48'),
(4, 'Cement', 'cement', 2, 1, '2024-06-10 07:51:55', '2024-06-10 07:51:55'),
(5, 'Concrete Block', 'concrete-block', 2, 1, '2024-06-10 07:52:02', '2024-06-10 07:52:02'),
(6, 'Clubhouse', 'clubhouse', 3, 1, '2024-06-10 07:52:11', '2024-06-10 07:52:11'),
(7, 'Outdoor Grill', 'outdoor-grill', 4, 1, '2024-06-10 07:52:21', '2024-06-10 07:52:21'),
(8, 'City Lights', 'city-lights', 5, 1, '2024-06-10 07:52:30', '2024-06-10 07:52:30'),
(9, 'Central Electric', 'central-electric', 6, 1, '2024-06-10 07:52:38', '2024-06-10 07:52:38'),
(10, 'Air Vents', 'air-vents', 7, 1, '2024-06-10 07:52:46', '2024-06-10 07:52:59'),
(11, 'Tiles', 'tiles', 8, 1, '2024-06-10 07:53:15', '2024-06-10 07:53:15'),
(12, 'Public', 'public', 9, 1, '2024-06-10 07:53:22', '2024-06-10 07:53:22'),
(13, 'Security Guard on Duty', 'security-guard-on-duty', 10, 1, '2024-06-10 07:53:30', '2024-06-10 07:53:30'),
(14, 'Wheelchair Access', 'wheelchair-access', 10, 1, '2024-06-10 07:53:40', '2024-06-10 07:53:40');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2024_06_03_112734_create_neighborhoods_table', 1),
(3, '2024_06_03_113828_create_features_table', 1),
(4, '2024_06_03_122537_create_types_table', 1),
(5, '2024_06_03_122834_create_properties_table', 1),
(6, '2024_06_04_053629_create_property_features_table', 1),
(7, '2024_06_04_053907_create_property_types_table', 1),
(8, '2024_06_04_111142_add_code_field_to_neighborhoods_table', 1),
(9, '2024_06_04_115901_add_fields_to_neighborhoods_table', 1),
(10, '2024_06_07_052015_add_fields_to_properties_table', 1),
(11, '2024_06_09_202726_add_fields_to_neighborhoods_table', 1),
(12, '2024_06_10_064724_add_banner_field_to_types_table', 1),
(13, '2024_06_10_070540_add_isfeatured_to_properties_table', 1),
(14, '2024_06_10_111105_create_testimonials_table', 1),
(15, '2024_06_10_114806_create_agents_table', 2),
(16, '2024_06_10_123615_add_short_description_to_properties_table', 3);

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
(1, 'La Jolla Excellence', 'la-jolla-excellence19', 'LJE34', 'LJE341718023710.webp', '11501', 'Mexico', 'Baja California', 'Rosarito', NULL, '-117.06203790795904', '32.36560077011573', '\"[\\\"7841718023701.webp\\\",\\\"451718023701.jpg\\\",\\\"8201718023701.webp\\\",\\\"1011718023701.webp\\\"]\"', '<p>Known as the “Jewels” of Rosarito Beach, La Jolla residents enjoy fine dining, boutiques, &amp; art galleries all surrounded by beautiful ocean coastline views.</p><p>La Jolla Excellence is a highly esteemed oceanfront gated community celebrated for its luxury, quality &amp; prestige.<br>Real estate opportunities here are diverse, ranging from upscale moderately priced condos to luxurious 7 figure townhouses nestled right off a year round sandy beach.</p>', 1, '2024-06-10 07:48:30', '2024-06-10 07:48:30');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `short_description` varchar(255) DEFAULT NULL,
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
  `is_featured` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1: No, 2: Yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `listing_type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Sale, 1=Rent',
  `lattitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `code`, `title`, `slug`, `price`, `neighborhood_id`, `listing_status`, `size`, `bedrooms`, `bathrooms`, `parking_spaces`, `banner`, `gallery`, `map`, `description`, `short_description`, `address`, `country`, `state`, `city`, `dev_lvl`, `year_built`, `property_tax`, `hoa_fees`, `rent_cycle`, `date_available`, `status`, `is_featured`, `created_at`, `updated_at`, `listing_type`, `lattitude`, `longitude`) VALUES
(1, 'LJE34S2837', 'La Jolla Excellence Villa Todo Santos, Suite 68', 'la-jolla-excellence-villa-todo-santos-suite-6862', '450000', 1, 1, '1890', 6, 4, 2, 'LJE34S87961718024135.jpeg', '[\"591718024093.webp\",\"8041718024093.webp\",\"8441718024093.webp\"]', NULL, '<p>Known as the “Jewels” of Rosarito Beach, La Jolla residents enjoy fine dining, boutiques, &amp; art galleries all surrounded by beautiful ocean coastline views.</p><p>La Jolla Excellence is a highly esteemed oceanfront gated community celebrated for its luxury, quality &amp; prestige.<br>Real estate opportunities here are diverse, ranging from upscale moderately priced condos to luxurious 7 figure townhouses nestled right off a year round sandy beach.</p><p><strong>THE SIZE AND LAYOUT OF THE PROPERTY</strong><br>If it’s space you’re looking for in a home while still enjoying the best a condominium community offers, then you’ve found the right place.<br>This true single-story home expertly tailors contemporary luxuries &amp; modern conveniences across a whopping 2,500 SqFt that include 3 abundant sized bedrooms, a voluminous sized kitchen, &amp; a spacious two car garage. The best part is its oversized balcony where you can doze off in the neverending Pacific Ocean views.</p><p>What makes this even better is that if you hurry you can still be in time to select your color floors, quartz, cabinetry amongst other things. You may also be in time to customize to your very own liking.</p><p><strong>INSIDE THE GATED COMMUNITY</strong><br>Lush gardens, access to 2 semi private beaches &amp; 5 star resort amenities liven up this gated oceanfront development. The privileged residential resort was engineered to accommodate refined construction in a key strategic location, thereby enabling effortless comforts &amp; imaginable unperturbed luxuries.<br>Among the countless features the development offers:<br>– Access to 2 semi-private beaches<br>– Indoor &amp; Outdoor pools<br>– Jacuzzis<br>– Saunas<br>– Ocean view gym<br>– Clubhouse for events; equipped with fully functional kitchens<br>– Multiple sports courts<br>– Lush gardens<br>– Secure gated access<br>– 24 / 7 round the clock manned security</p><p><strong>LOCATION</strong><br>Located less than 3 minutes from downtown Rosarito, yet worlds apart from the busy hustle and bustle of the tourist-centric nightlife…<br>Outside the 24 hour secure gated community there are over a dozen stores and restaurants within a 3 block walking distance radius.<br>As well as round the clock convenience stores &amp; multiple gas stations. This area pampers you with all commodities one could desire.</p><p>La Jolla Excellence is only a 35-minute straight shot south of the San Diego border if crossing by car.<br>Or breeze on through the express border crossing at the Tijuana airport and UBER or Taxi over to your home in less than 45 minutes.</p><p>A picturesque 45 minute drive south down Baja’s golden coast will land you down in Mexico’s very own Napa valley. Known around the world as “Valle de Guadalupe” *Pronounced (Va-Ye) in Spanish.</p><p><strong>TITLE OF THE PROPERTY</strong><br>This property is not yet constructed &amp; is anticipated for delivery in late 2024.<br>This villa will be sold new and unfurnished It will include all new stainless steel kitchen appliances.<br>This sale is through a cession of rights.</p><p><strong>TERMS OF THE SALE</strong><br>Financing is not available for this property at this time.<br>If you require financing please contact your preferred lender prior to scheduling a viewing.</p><p><strong>VIEWING THIS PROPERTY</strong><br>A similar property is available to view by appointment only.<br>We ask that you do your best to coordinate a viewing with at least 24 hours notice to set you up for an exclusive and private showing, however we are flexible to schedule on a case by case basis and we may ask for proof of funds before a showing.</p><p><strong>** Please note all pictures of villa are for illustration purposes only and the villa shown has upgrades**</strong></p><p><strong>*PRICE IS DISPLAYED IN U.S. DOLLARS BUT PURCHASE WILL BE REGISTERED IN MEXICAN PESOS AT THE CURRENT EXCHANGE RATE AT THE TIME OF CLOSING*</strong></p><p><strong>*Disclaimer: Information is deemed to be correct but not guaranteed*</strong></p>', 'Known as the “Jewels” of Rosarito Beach, La Jolla residents enjoy fine dining, boutiques, & art galleries .', 'Suite 68, La Jolla Excellence Villa Todo Santos', 'Mexico', 'Baja California', 'Rosarito', 2, '2019', '450', '220', 1, '2024-06-10 00:00:00', 1, 0, '2024-06-10 07:55:35', '2024-06-10 07:56:39', 1, '32.3669343638614', '-117.06189782610755');

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
(15, 1, 1, '2024-06-10 07:56:41', '2024-06-10 07:56:41'),
(16, 1, 2, '2024-06-10 07:56:41', '2024-06-10 07:56:41'),
(17, 1, 3, '2024-06-10 07:56:41', '2024-06-10 07:56:41'),
(18, 1, 4, '2024-06-10 07:56:41', '2024-06-10 07:56:41'),
(19, 1, 5, '2024-06-10 07:56:42', '2024-06-10 07:56:42'),
(20, 1, 6, '2024-06-10 07:56:42', '2024-06-10 07:56:42'),
(21, 1, 7, '2024-06-10 07:56:42', '2024-06-10 07:56:42'),
(22, 1, 8, '2024-06-10 07:56:42', '2024-06-10 07:56:42'),
(23, 1, 9, '2024-06-10 07:56:42', '2024-06-10 07:56:42'),
(24, 1, 10, '2024-06-10 07:56:42', '2024-06-10 07:56:42'),
(25, 1, 11, '2024-06-10 07:56:42', '2024-06-10 07:56:42'),
(26, 1, 12, '2024-06-10 07:56:42', '2024-06-10 07:56:42'),
(27, 1, 13, '2024-06-10 07:56:42', '2024-06-10 07:56:42'),
(28, 1, 14, '2024-06-10 07:56:42', '2024-06-10 07:56:42');

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
(3, 1, 1, '2024-06-10 07:56:42', '2024-06-10 07:56:42'),
(4, 1, 2, '2024-06-10 07:56:42', '2024-06-10 07:56:42');

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
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `designation` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `content`, `designation`, `location`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Ortega Jenna', 'Thank you very much. I\'m impressed with your service. I\'ve already told my friends about your company and your quick response, thanks again!', 'Painter', 'San Diego', '1718019651.jpg', '2024-06-10 06:36:58', '2024-06-10 06:40:51'),
(3, 'Chandler Bing', 'Thank you for your prompt response and the help that you gave me. You always have a quick solution to any problem. What an excellent level of customer service!', 'Data Analyst', 'Poughkeepsie', '1718019701.jpg', '2024-06-10 06:41:41', '2024-06-10 06:41:41');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: Inactive, 1: Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `title`, `slug`, `banner`, `status`, `created_at`, `updated_at`) VALUES
(1, 'House', 'house', '1718023842.jpeg', 1, '2024-06-10 07:50:42', '2024-06-10 07:50:42'),
(2, 'Condo', 'condo', '1718023850.webp', 1, '2024-06-10 07:50:50', '2024-06-10 07:50:50'),
(3, 'Residential', 'residential', '1718023863.webp', 1, '2024-06-10 07:51:03', '2024-06-10 07:51:03'),
(4, 'Commercial', 'commercial', '1718023875.webp', 1, '2024-06-10 07:51:15', '2024-06-10 07:51:15');

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
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `neighborhoods`
--
ALTER TABLE `neighborhoods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
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
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `neighborhoods`
--
ALTER TABLE `neighborhoods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `property_features`
--
ALTER TABLE `property_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
