-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2024 at 08:29 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `slug`, `state`, `country`, `created_at`, `updated_at`) VALUES
(1, 'Rosarito', 'rosarito', 'Baja California', 'Mexico', '2024-06-13 01:15:52', '2024-06-13 01:15:52');

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
(1, 'Central Cooling', 'central-cooling', 7, 1, '2024-06-13 02:43:26', '2024-06-13 02:43:26'),
(2, 'Security Guard', 'security-guard', 10, 1, '2024-06-13 04:30:00', '2024-06-13 04:30:00'),
(3, 'CCTV Cameras', 'cctv-cameras', 10, 1, '2024-06-13 04:30:09', '2024-06-13 04:30:09'),
(4, 'Sanitation Tanks', 'sanitation-tanks', 9, 1, '2024-06-13 04:30:21', '2024-06-13 04:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `home_evals`
--

CREATE TABLE `home_evals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `year_built` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `bedroom` varchar(255) DEFAULT NULL,
  `bathroom` varchar(255) DEFAULT NULL,
  `half_bathroom` varchar(255) DEFAULT NULL,
  `has_suite` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: No, 2: Yes, 3: Potential',
  `garage` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: N/A, 1: 1, 2: 2, 3: 3, 4: 4, 5: 5+',
  `garage_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: Attached, 2: Detached',
  `basement_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: None, 2: Full, 3: Partial, 4: Crawl, 5: Walkout',
  `dev_lvl` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: None, 2: 25%, 3: 50%, 4: 75%, 5: Complete',
  `move_plan` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: 1 Month, 2: 3 Month, 3: 6 Month, 4: 1 Year, 5: 2+ Years',
  `notes` mediumtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: New, 2: Contacted, 3: Closed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(25, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(26, '2024_06_03_112734_create_neighborhoods_table', 1),
(27, '2024_06_03_113828_create_features_table', 1),
(28, '2024_06_03_122537_create_types_table', 1),
(29, '2024_06_03_122834_create_properties_table', 1),
(30, '2024_06_04_053629_create_property_features_table', 1),
(31, '2024_06_04_053907_create_property_types_table', 1),
(32, '2024_06_04_111142_add_code_field_to_neighborhoods_table', 1),
(33, '2024_06_04_115901_add_fields_to_neighborhoods_table', 1),
(34, '2024_06_07_052015_add_fields_to_properties_table', 1),
(35, '2024_06_09_202726_add_fields_to_neighborhoods_table', 1),
(36, '2024_06_10_064724_add_banner_field_to_types_table', 1),
(37, '2024_06_10_070540_add_isfeatured_to_properties_table', 1),
(38, '2024_06_10_111105_create_testimonials_table', 1),
(39, '2024_06_10_114806_create_agents_table', 1),
(40, '2024_06_10_123615_add_short_description_to_properties_table', 1),
(41, '2024_06_10_131450_create_home_evals_table', 1),
(42, '2024_06_11_045819_add_views_column_to_properties_table', 1),
(43, '2024_06_11_085327_create_cities_table', 1),
(44, '2024_06_11_193516_create_search_saves_table', 1),
(45, '2024_06_12_135144_add_fields_to_neighborhoods_table', 1);

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
  `images` text DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: Inactive, 1: Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `amenity_icon1` varchar(255) DEFAULT NULL,
  `amenity_icon2` varchar(255) DEFAULT NULL,
  `amenity_icon3` varchar(255) DEFAULT NULL,
  `amenity_title1` varchar(255) DEFAULT NULL,
  `amenity_title2` varchar(255) DEFAULT NULL,
  `amenity_title3` varchar(255) DEFAULT NULL,
  `amenity_desc1` text DEFAULT NULL,
  `amenity_desc2` text DEFAULT NULL,
  `amenity_desc3` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `neighborhoods`
--

INSERT INTO `neighborhoods` (`id`, `title`, `slug`, `code`, `banner`, `zip`, `country`, `state`, `city`, `map`, `longitude`, `latitude`, `images`, `description`, `status`, `created_at`, `updated_at`, `amenity_icon1`, `amenity_icon2`, `amenity_icon3`, `amenity_title1`, `amenity_title2`, `amenity_title3`, `amenity_desc1`, `amenity_desc2`, `amenity_desc3`) VALUES
(7, 'La Jolla Excellence', 'la-jolla-excellence81', 'LJE76', 'LJE311718267824.webp', '22710', 'Mexico', 'Baja California', 'Rosarito', NULL, '-117.0590719955315', '32.353059306809776', '\"[\\\"7691718267797.webp\\\",\\\"6351718267797.webp\\\"]\"', '<p>La Jolla Excellence is a premier residential development situated in Playas de Rosarito, Baja California, Mexico.</p><p>This opulent community boasts an extensive selection of premium villas and condos for sale that ensure unparalleled comfort and convenience for homeowners.</p><p>With breathtaking ocean vistas, top-of-the-line amenities, and convenient access to local attractions, La Jolla Excellence stands out as the ideal destination for those seeking a sophisticated lifestyle in a stunning seaside location.</p><p>Explore our range of Rosarito Real Estate options today!</p><h2><strong>Real Estate Options in La Jolla Excellence Villas</strong></h2><p>La Jolla Excellence offers 105 villas, each boasting a private garage and ranging in size from 2,500 to 4,200 square feet.&nbsp;</p><p>These spacious and elegant homes are designed to cater to the needs of discerning homeowners, with high-quality construction and premium finishes throughout.&nbsp;</p><p>With ample living space and breathtaking views, these villas provide the perfect setting for a luxurious lifestyle in Rosarito.</p><h2><strong>Condos</strong></h2><p>In addition to the villas, La Jolla Excellence features five high-rise condominium complexes with units ranging from two to four bedrooms.&nbsp;</p><p>These condos offer a more affordable option for those seeking a stylish and comfortable home in the Rosarito area.&nbsp;</p><p>With a variety of configurations and sizes to choose from, buyers are sure to find the perfect condo to suit their needs and preferences.</p>', 1, '2024-06-13 03:37:04', '2024-06-13 06:32:23', 'LJE3111718267824.webp', 'LJE3121718267824.webp', 'LJE3131718267824.webp', 'Gym', 'Indoor Games', 'Sunset', 'Residents of La Jolla Excellence enjoy access to two pristine, private sand beaches, perfect for sunbathing, swimming, or simply enjoying the stunning ocean views. These beaches provide a peaceful and exclusive retreat for homeowners, away from the crowds and noise of public beaches.', 'Residents of La Jolla Excellence enjoy access to two pristine, private sand beaches, perfect for sunbathing, swimming, or simply enjoying the stunning ocean views. These beaches provide a peaceful and exclusive retreat for homeowners, away from the crowds and noise of public beaches.', 'Residents of La Jolla Excellence enjoy access to two pristine, private sand beaches, perfect for sunbathing, swimming, or simply enjoying the stunning ocean views. These beaches provide a peaceful and exclusive retreat for homeowners, away from the crowds and noise of public beaches.');

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
  `price` double(20,2) DEFAULT NULL,
  `views` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `neighborhood_id` bigint(20) UNSIGNED NOT NULL,
  `listing_status` tinyint(4) NOT NULL COMMENT '1: For Sale, 2: For Rent, 3: Rented, 4: Sale Pending, 5: Sold',
  `size` varchar(255) NOT NULL,
  `bedrooms` int(11) NOT NULL,
  `bathrooms` int(11) NOT NULL,
  `parking_spaces` int(11) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `gallery` text NOT NULL,
  `map` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL,
  `short_description` text DEFAULT NULL,
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
  `is_featured` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: No, 2: Yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `listing_type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Sale, 1=Rent',
  `lattitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `code`, `title`, `slug`, `price`, `views`, `neighborhood_id`, `listing_status`, `size`, `bedrooms`, `bathrooms`, `parking_spaces`, `banner`, `gallery`, `map`, `description`, `short_description`, `address`, `country`, `state`, `city`, `dev_lvl`, `year_built`, `property_tax`, `hoa_fees`, `rent_cycle`, `date_available`, `status`, `is_featured`, `created_at`, `updated_at`, `listing_type`, `lattitude`, `longitude`) VALUES
(1, 'LJE31R7989', 'La Jolla Excellence Suite 3', 'la-jolla-excellence-suite-389', 3000.00, 0, 7, 2, '1211', 5, 8, 4, 'LJE31R43671718274468.webp', '[\"2421718275891.jpg\",\"61718275891.webp\",\"871718275891.gif\",\"4361718275891.jpg\"]', NULL, '<p>Those looking for unmatched rental property with an outstanding location, beach access and the ultimate in resort living need look no further! On the sands of the artesanal Boulevard of Popotla, one of Rosarito Beach’s most beautiful and exclusive stretches of beachfront, sits La Jolla Excellence —a new distinctive residential housing development that sparkles among its peers.</p><p>Award-winning architectural firm DECASA has partnered with world-class designers to create a residence that is in complete harmony with its surroundings. Every aspect of the design—including the use of materials, the soft undulating façade, the flow of its interiors—is in constant dialogue with the harmony and tranquility of the Pacific Ocean.</p><p>THE SIZE AND LAYOUT</p><figure class=\"image image-style-align-right image_resized\" style=\"width:50%;\"><img style=\"aspect-ratio:1024/683;\" src=\"https://localhost/property-dealership/public/ckeditor-uploads/La_Jolla_Excellence_42-1-1024x683_1718274448.webp\" width=\"1024\" height=\"683\"></figure><p>This exquisitely furnished 3 Bed 2 Bath unit is by far not your everyday cookie cutter condo. The owner’s were fully involved in the design and furnishing of the unit, making every inch of the 1,937 Square Feet flow effortlessly and elegantly to the cadence of the Pacific Ocean setting the pace for a life lived in full.<br>They went above and beyond with the finishes for this condo as it was meant to be for personal use only. High ceilings, stand alone oven, cook top and many other extras make this condo a unique and exclusive piece of property.</p><p>Its perfect location will allow you to enjoy white water and the immense pacific ocean as well as the Coronado islands without being too low or too high up on the 10 floor tower.</p><p>THE COMMUNITY</p><p>One of the most sought out communities in the area not only for the two beach accesses but also for the various entertainment/dining experiences all within walking distance.</p><p>Among the many countless features the development includes are:</p><figure class=\"image image-style-align-left\"><img style=\"aspect-ratio:276/183;\" src=\"https://localhost/property-dealership/public/ckeditor-uploads/images_1718274461.jpg\" width=\"276\" height=\"183\"></figure><p>– Access to 2 semi-private beaches – Multiple Jacuzzis<br>– Multiple Pools – 3 of the pools indoor/covered<br>– Steam rooms – Saunas<br>– 2 ocean view gyms – Restaurant-Bar<br>– Boardwalk &amp; jogging trails – Kid’s playground<br>– Indoor cinema room – 3 Multiple sports courts<br>– Multi-use clubhouses for events; equipped with fully functional kitchens</p><p>THE LOCATION</p><p>Located less than 3 minutes south of downtown Rosarito, yet worlds apart from the loud hustle and bustle of the tourist-centric nightlife; La Jolla Excellence is only about a 35-minute straight shot south of the San Ysidro border crossing.</p><p>It is also conveniently located within a 3 block radius of over 12 restaurants with different cuisines, convenience stores &amp; gas stations.</p><p>If that weren’t enough, more than 300 different wineries, microbreweries, and remarkable first-rate restaurants are located only 45 minutes away in Baja’s very own Napa Valley; better known around the world as “Valle de Guadalupe” or locals simply call it “Valle”.</p><figure class=\"image image_resized\" style=\"width:50%;\"><img style=\"aspect-ratio:1024/576;\" src=\"https://localhost/property-dealership/public/ckeditor-uploads/La_Jolla_Excellence_25-1-1024x576_1718275915.webp\" width=\"1024\" height=\"576\"><figcaption>Sun of the beach</figcaption></figure><p>RENTAL TERMS</p><p>This is a long term rental only meaning it requires at least a 1yr lease.</p><p>VIEWING THIS CONDO</p><p>This property is viewed by appointment only.<br>We ask that you do your best to coordinate a viewing with at least 48 hours notice to set you up for an exclusive and private showing.</p><p>&nbsp;</p><p><strong>Disclaimer: Information is deemed to be correct but not guaranteed.</strong></p>', 'hose looking for unmatched rental property with an outstanding location, beach access and the ultimate in resort living need look no further! On the sands of the artesanal Boulevard of Popotla, one of Rosarito Beach’s most beautiful and exclusive stretches of beachfront, sits La Jolla Excellence —a new distinctive residential housing development that sparkles among its peers.', 'Baker Street London Gali', 'Mexico', 'Baja California', 'Rosarito', 2, '2024', '567', '7876', 0, '2024-06-21 00:00:00', 1, 1, '2024-06-13 05:27:48', '2024-06-13 05:52:10', 2, '32.35476368140969', '-117.05072092229003'),
(3, 'LJE76R9622', 'Sammple Property', 'sammple-property96', 25000000.00, 0, 7, 3, '124', 5, 7, 6, 'LJE76R96221718954084.png', '[]', NULL, '<p>asadasd</p>', 'asdadasd', 'affdfa', 'Mexico', 'Baja California', 'Rosarito', 2, '2020', '', '', 1, '2024-06-21 07:14:44', 1, 1, '2024-06-21 02:14:44', '2024-06-21 02:52:26', 2, '32.359083278739696', '-117.02029394322508'),
(4, 'LJE76S2700', 'sadasd', 'sadasd24', 1235.00, 0, 7, 1, '1111', 5, 6, 7, 'LJE76S27001718954135.jpg', '[\"7341718954131.jpg\"]', NULL, '<p>sadda</p>', 'sadad', 'sdaadasd', 'Mexico', 'Baja California', 'Rosarito', 3, '2019', '123', '12', 1, '2024-06-21 07:15:35', 1, 1, '2024-06-21 02:15:35', '2024-06-21 02:15:35', 1, '32.356250033769705', '-117.0187489908325');

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
(2, 1, 1, '2024-06-13 05:52:10', '2024-06-13 05:52:10'),
(3, 1, 3, '2024-06-13 05:52:10', '2024-06-13 05:52:10'),
(4, 1, 4, '2024-06-13 05:52:11', '2024-06-13 05:52:11'),
(21, 3, 1, '2024-06-21 02:14:44', '2024-06-21 02:14:44'),
(22, 3, 2, '2024-06-21 02:14:44', '2024-06-21 02:14:44'),
(23, 3, 3, '2024-06-21 02:14:44', '2024-06-21 02:14:44'),
(24, 3, 4, '2024-06-21 02:14:44', '2024-06-21 02:14:44'),
(25, 4, 1, '2024-06-21 02:15:35', '2024-06-21 02:15:35'),
(26, 4, 2, '2024-06-21 02:15:35', '2024-06-21 02:15:35'),
(27, 4, 3, '2024-06-21 02:15:35', '2024-06-21 02:15:35'),
(28, 4, 4, '2024-06-21 02:15:35', '2024-06-21 02:15:35');

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
(2, 1, 5, '2024-06-13 05:52:11', '2024-06-13 05:52:11'),
(3, 1, 6, '2024-06-13 05:52:11', '2024-06-13 05:52:11'),
(4, 1, 7, '2024-06-13 05:52:11', '2024-06-13 05:52:11'),
(13, 3, 5, '2024-06-21 02:14:44', '2024-06-21 02:14:44'),
(14, 4, 5, '2024-06-21 02:15:35', '2024-06-21 02:15:35'),
(15, 4, 6, '2024-06-21 02:15:35', '2024-06-21 02:15:35');

-- --------------------------------------------------------

--
-- Table structure for table `search_saves`
--

CREATE TABLE `search_saves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `search_query` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(5, 'House', 'house', '1718264570.webp', 1, '2024-06-13 02:42:50', '2024-06-13 02:42:50'),
(6, 'Residential', 'residential', '1718264583.webp', 1, '2024-06-13 02:43:03', '2024-06-13 02:43:03'),
(7, 'Commercial', 'commercial', '1718264592.jpg', 1, '2024-06-13 02:43:12', '2024-06-13 02:43:12');

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
(92, 'John', 'Doe', 'john@gmail.com', '$2y$12$A1kHkTc5TnFL7swEQMr/KuUvw5jkP7OnoHV.xxe.7Wyg2sGvyIJ9i', '+923394008600', 'user.png', 1, 0, '2023-12-29 09:49:14', '2024-06-11 18:09:27'),
(100, 'John', 'Watson', 'johnwatson@gmail.com', '$2y$12$tVVuRZbLZAv36sWQBectvOcVUrNpsaFfvGKsHK4GJITmvcO/JUGwq', '+1456712347', '1718180371.webp', 0, 1, '2024-06-12 08:09:41', '2024-06-13 12:47:36');

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
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_evals`
--
ALTER TABLE `home_evals`
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
-- Indexes for table `search_saves`
--
ALTER TABLE `search_saves`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `home_evals`
--
ALTER TABLE `home_evals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `neighborhoods`
--
ALTER TABLE `neighborhoods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `property_features`
--
ALTER TABLE `property_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `search_saves`
--
ALTER TABLE `search_saves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

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
