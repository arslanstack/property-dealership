-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2024 at 11:54 AM
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
(14, 'La Jolla Excellence', 'la-jolla-excellence57', 'LJE71', 'LJE711718003517.webp', '11501', 'Mexico', 'Baja California', 'Rosarito', NULL, '-117.06160165053741', '32.365283845631986', '\"[\\\"6391718003496.webp\\\",\\\"1531718003497.webp\\\",\\\"5491718003497.webp\\\",\\\"2551718003497.webp\\\"]\"', '<p><strong>La Jolla Excellence is a premier residential development situated in Playas de Rosarito, Baja California, Mexico.</strong></p><p><strong>This opulent community boasts an extensive selection of premium villas and condos for sale that ensure unparalleled comfort and convenience for homeowners.</strong></p><p><strong>With breathtaking ocean vistas, top-of-the-line amenities, and convenient access to local attractions, La Jolla Excellence stands out as the ideal destination for those seeking a sophisticated lifestyle in a stunning seaside location.</strong></p><p><strong>Explore our range of Rosarito Real Estate options today!</strong></p><h2>Real Estate Options in La Jolla Excellence</h2><h2>Villas</h2><p><strong>La Jolla Excellence offers 105 villas, each boasting a private garage and ranging in size from 2,500 to 4,200 square feet.&nbsp;</strong></p><p><strong>These spacious and elegant homes are designed to cater to the needs of discerning homeowners, with high-quality construction and premium finishes throughout.&nbsp;</strong></p><p><strong>With ample living space and breathtaking views, these villas provide the perfect setting for a luxurious lifestyle in Rosarito.</strong></p><h2>Condos</h2><p><strong>In addition to the villas, La Jolla Excellence features five high-rise condominium complexes with units ranging from two to four bedrooms.&nbsp;</strong></p><p><strong>These condos offer a more affordable option for those seeking a stylish and comfortable home in the Rosarito area.&nbsp;</strong></p><p><strong>With a variety of configurations and sizes to choose from, buyers are sure to find the perfect condo to suit their needs and preferences.</strong></p><p><img src=\"https://mybajaproperty.com/wp-content/uploads/2023/12/La_Jolla_Excellence_43.webp\" alt=\"\"></p><h2>La Jolla Excellence Amenities</h2><p style=\"text-align:center;\">La Jolla Excellence is known for its exceptional amenities, available exclusively to residents and their guests. These amenities cater to a variety of interests and preferences, ensuring that everyone in the community can enjoy a fulfilling and enjoyable lifestyle.</p><p>&nbsp;</p><h4>Beach</h4><p><strong>Residents of La Jolla Excellence enjoy access to two pristine, private sand beaches, perfect for sunbathing, swimming, or simply enjoying the stunning ocean views. These beaches provide a peaceful and exclusive retreat for homeowners, away from the crowds and noise of public beaches.</strong></p><p>&nbsp;</p><h4>Restaurant and Bar</h4><p><strong>The community features an on-site restaurant and bar, offering delicious dining options and refreshing beverages within the comfort of the development. Residents can enjoy a leisurely meal or a casual drink without ever leaving the community.</strong></p><p>&nbsp;</p><h4>Multiple Pools and Jacuzzis</h4><p><strong>Pools – 2 of them indoor/covered</strong><br><strong>10 Jacuzzis</strong><br><strong>Saunas</strong><br><strong>Steam rooms</strong></p>', 1, '2024-06-10 02:11:57', '2024-06-10 02:11:57');

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
  `is_featured` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: No, 2: Yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `listing_type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=Sale, 2=Rent',
  `lattitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `code`, `title`, `slug`, `price`, `neighborhood_id`, `listing_status`, `size`, `bedrooms`, `bathrooms`, `parking_spaces`, `banner`, `gallery`, `map`, `description`, `address`, `country`, `state`, `city`, `dev_lvl`, `year_built`, `property_tax`, `hoa_fees`, `rent_cycle`, `date_available`, `status`, `is_featured`, `created_at`, `updated_at`, `listing_type`, `lattitude`, `longitude`) VALUES
(13, 'LJE71S6052', 'La Jolla Excellence Suite 204 Tower 4', 'la-jolla-excellence-suite-204-tower-414', '284000', 14, 1, '1280', 5, 4, 2, 'LJE71S60521718003752.jpg', '[\"6341718003741.webp\",\"1601718003741.webp\",\"11718003742.webp\"]', NULL, '<p>This single-story condo oasis of luxury and elegance is skillfully designed and boasts 3 bedrooms, 2 bathrooms, and a spacious 1,863 square feet, ensuring ample space for a comfortable stay.<br>Prepare to be enchanted by the rich allure that permeates every corner of this property, as it cleverly captivates your senses and immerses you in the euphoric tranquility of the Pacific Ocean.<br>Indulge in the ultimate indoor-outdoor living experience, made even more fulfilling by the oversized oceanfront balcony. This expansive space is perfect for entertaining guests or simply unwinding on a lazy Sunday morning, while enjoying a front-row seat to the mesmerizing sea views.<br>Let the soothing sounds of the ocean and the gentle sea breeze whisk you away into a state of pure relaxation. This condo offers a truly enchanting retreat, where you can savor the beauty of nature and create cherished memories with friends and family.</p><p>INSIDE THE GATED COMMUNITY<br>Lush gardens, access to 2 semi private beaches &amp; 5 star resort amenities liven up this gated oceanfront development. The privileged residential resort was engineered to accommodate refined construction in a key strategic location, thereby enabling effortless comforts &amp; imaginable unperturbed luxuries.<br>Among the countless features the development offers:<br>– Access to 2 semi-private beaches<br>– Indoor &amp; Outdoor pools<br>– Jacuzzis<br>– Saunas<br>– Multiple sports courts<br>– Lush gardens<br>– Secure gated access<br>– 24 / 7 round the clock manned security</p><p>LOCATION, LOCATION, LOCATION<br>Located less than 3 minutes from downtown Rosarito, yet worlds apart from the busy hustle and bustle of the tourist-centric nightlife…<br>La Jolla Excellence is only a 35-minute straight shot south of the San Diego border if crossing by car.<br>Or breeze on through the express border crossing at the Tijuana airport and UBER or Taxi over to your home in less than 45 minutes.</p><p>A picturesque 45 minute drive south down Baja’s golden coast will land you down in Mexico’s very own Napa valley. Known around the world as “Valle de Guadalupe” *Pronounced (Va-Ye) in Spanish.<br>Outside the 24 hour secure gated community there are over a dozen stores and restaurants within a 3 block walking distance radius.<br>As well as round the clock convenience stores &amp; multiple gas stations. This area pampers you with all commodities one could desire.</p><p>TERMS OF RENTALS<br>There is a $75 USD cleaning fee, a $25 registration fee and a $2 per person bracelet fee to be added to the rental.<br>A minimum of 2 night rental is required and there are special discounts for week or longer rentals.</p><p>*PRICE IS DISPLAYED IN U.S. DOLLARS*</p><p><strong>Disclaimer: Information is deemed to be correct but not guaranteed.</strong></p>', 'Suite 204 Tower 4 La Jolla Excellence', 'Mexico', 'Baja California', 'Rosarito', 2, '2001', '250', '120', 1, '2024-06-10 00:00:00', 1, 2, '2024-06-10 02:15:52', '2024-06-10 03:07:38', 1, '32.36562540674719', '-117.06226876768861'),
(14, 'LJE71S5351', 'La Jolla Excellence Villa Todo Santos, Suite 68', 'la-jolla-excellence-villa-todo-santos-suite-6868', '548000', 14, 1, '2528', 8, 7, 2, 'LJE71S53511718010495.webp', '[\"5241718010464.webp\",\"2551718010465.webp\",\"4681718010465.webp\"]', NULL, '<p>Known as the “Jewels” of Rosarito Beach, La Jolla residents enjoy fine dining, boutiques, &amp; art galleries all surrounded by beautiful ocean coastline views.</p><p>La Jolla Excellence is a highly esteemed oceanfront gated community celebrated for its luxury, quality &amp; prestige.<br>Real estate opportunities here are diverse, ranging from upscale moderately priced condos to luxurious 7 figure townhouses nestled right off a year round sandy beach.</p><p><strong>THE SIZE AND LAYOUT OF THE PROPERTY</strong><br>If it’s space you’re looking for in a home while still enjoying the best a condominium community offers, then you’ve found the right place.<br>This true single-story home expertly tailors contemporary luxuries &amp; modern conveniences across a whopping 2,500 SqFt that include 3 abundant sized bedrooms, a voluminous sized kitchen, &amp; a spacious two car garage. The best part is its oversized balcony where you can doze off in the neverending Pacific Ocean views.</p><p>What makes this even better is that if you hurry you can still be in time to select your color floors, quartz, cabinetry amongst other things. You may also be in time to customize to your very own liking.</p><p><strong>INSIDE THE GATED COMMUNITY</strong><br>Lush gardens, access to 2 semi private beaches &amp; 5 star resort amenities liven up this gated oceanfront development. The privileged residential resort was engineered to accommodate refined construction in a key strategic location, thereby enabling effortless comforts &amp; imaginable unperturbed luxuries.<br>Among the countless features the development offers:<br>– Access to 2 semi-private beaches<br>– Indoor &amp; Outdoor pools<br>– Jacuzzis<br>– Saunas<br>– Ocean view gym<br>– Clubhouse for events; equipped with fully functional kitchens<br>– Multiple sports courts<br>– Lush gardens<br>– Secure gated access<br>– 24 / 7 round the clock manned security</p><p><strong>LOCATION, LOCATION, LOCATION</strong><br>Located less than 3 minutes from downtown Rosarito, yet worlds apart from the busy hustle and bustle of the tourist-centric nightlife…<br>Outside the 24 hour secure gated community there are over a dozen stores and restaurants within a 3 block walking distance radius.<br>As well as round the clock convenience stores &amp; multiple gas stations. This area pampers you with all commodities one could desire.</p><p>La Jolla Excellence is only a 35-minute straight shot south of the San Diego border if crossing by car.<br>Or breeze on through the express border crossing at the Tijuana airport and UBER or Taxi over to your home in less than 45 minutes.</p><p>A picturesque 45 minute drive south down Baja’s golden coast will land you down in Mexico’s very own Napa valley. Known around the world as “Valle de Guadalupe” *Pronounced (Va-Ye) in Spanish.</p><p><strong>TITLE OF THE PROPERTY</strong><br>This property is not yet constructed &amp; is anticipated for delivery in late 2024.<br>This villa will be sold new and unfurnished It will include all new stainless steel kitchen appliances.<br>This sale is through a cession of rights.</p><p><strong>TERMS OF THE SALE</strong><br>Financing is not available for this property at this time.<br>If you require financing please contact your preferred lender prior to scheduling a viewing.</p><p><strong>VIEWING THIS PROPERTY</strong><br>A similar property is available to view by appointment only.<br>We ask that you do your best to coordinate a viewing with at least 24 hours notice to set you up for an exclusive and private showing, however we are flexible to schedule on a case by case basis and we may ask for proof of funds before a showing.</p><p><strong>** Please note all pictures of villa are for illustration purposes only and the villa shown has upgrades**</strong></p><p><strong>*PRICE IS DISPLAYED IN U.S. DOLLARS BUT PURCHASE WILL BE REGISTERED IN MEXICAN PESOS AT THE CURRENT EXCHANGE RATE AT THE TIME OF CLOSING*</strong></p><p><strong>*Disclaimer: Information is deemed to be correct but not guaranteed*</strong></p>', 'Suite 68, La Jolla Excellence Villa Todo Santos', 'Mexico', 'Baja California', 'Rosarito', 2, '2018', '560', '290', 1, '2024-06-10 00:00:00', 1, 1, '2024-06-10 04:08:15', '2024-06-10 04:18:41', 1, '32.36615851208922', '-117.06252085466235');

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
(360, 13, 3, '2024-06-10 02:15:52', '2024-06-10 02:15:52'),
(361, 13, 4, '2024-06-10 02:15:52', '2024-06-10 02:15:52'),
(362, 13, 5, '2024-06-10 02:15:52', '2024-06-10 02:15:52'),
(363, 13, 7, '2024-06-10 02:15:52', '2024-06-10 02:15:52'),
(364, 13, 8, '2024-06-10 02:15:53', '2024-06-10 02:15:53'),
(365, 13, 9, '2024-06-10 02:15:53', '2024-06-10 02:15:53'),
(366, 13, 10, '2024-06-10 02:15:53', '2024-06-10 02:15:53'),
(367, 13, 11, '2024-06-10 02:15:53', '2024-06-10 02:15:53'),
(368, 13, 13, '2024-06-10 02:15:53', '2024-06-10 02:15:53'),
(369, 13, 14, '2024-06-10 02:15:53', '2024-06-10 02:15:53'),
(370, 13, 15, '2024-06-10 02:15:53', '2024-06-10 02:15:53'),
(371, 13, 16, '2024-06-10 02:15:53', '2024-06-10 02:15:53'),
(372, 13, 17, '2024-06-10 02:15:53', '2024-06-10 02:15:53'),
(373, 13, 18, '2024-06-10 02:15:53', '2024-06-10 02:15:53'),
(374, 13, 19, '2024-06-10 02:15:53', '2024-06-10 02:15:53'),
(375, 13, 21, '2024-06-10 02:15:53', '2024-06-10 02:15:53'),
(376, 13, 23, '2024-06-10 02:15:53', '2024-06-10 02:15:53'),
(377, 13, 24, '2024-06-10 02:15:53', '2024-06-10 02:15:53'),
(378, 13, 25, '2024-06-10 02:15:53', '2024-06-10 02:15:53'),
(379, 14, 3, '2024-06-10 04:08:16', '2024-06-10 04:08:16'),
(380, 14, 4, '2024-06-10 04:08:16', '2024-06-10 04:08:16'),
(381, 14, 5, '2024-06-10 04:08:16', '2024-06-10 04:08:16'),
(382, 14, 6, '2024-06-10 04:08:16', '2024-06-10 04:08:16'),
(383, 14, 7, '2024-06-10 04:08:16', '2024-06-10 04:08:16'),
(384, 14, 8, '2024-06-10 04:08:16', '2024-06-10 04:08:16'),
(385, 14, 9, '2024-06-10 04:08:16', '2024-06-10 04:08:16'),
(386, 14, 10, '2024-06-10 04:08:16', '2024-06-10 04:08:16'),
(387, 14, 11, '2024-06-10 04:08:16', '2024-06-10 04:08:16'),
(388, 14, 13, '2024-06-10 04:08:16', '2024-06-10 04:08:16'),
(389, 14, 14, '2024-06-10 04:08:16', '2024-06-10 04:08:16'),
(390, 14, 15, '2024-06-10 04:08:16', '2024-06-10 04:08:16'),
(391, 14, 16, '2024-06-10 04:08:16', '2024-06-10 04:08:16'),
(392, 14, 17, '2024-06-10 04:08:16', '2024-06-10 04:08:16'),
(393, 14, 18, '2024-06-10 04:08:16', '2024-06-10 04:08:16'),
(394, 14, 19, '2024-06-10 04:08:16', '2024-06-10 04:08:16'),
(395, 14, 21, '2024-06-10 04:08:16', '2024-06-10 04:08:16'),
(396, 14, 22, '2024-06-10 04:08:16', '2024-06-10 04:08:16'),
(397, 14, 23, '2024-06-10 04:08:16', '2024-06-10 04:08:16'),
(398, 14, 24, '2024-06-10 04:08:16', '2024-06-10 04:08:16'),
(399, 14, 25, '2024-06-10 04:08:17', '2024-06-10 04:08:17');

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
(36, 13, 7, '2024-06-10 02:15:53', '2024-06-10 02:15:53'),
(37, 13, 8, '2024-06-10 02:15:53', '2024-06-10 02:15:53'),
(38, 14, 8, '2024-06-10 04:08:17', '2024-06-10 04:08:17'),
(39, 14, 9, '2024-06-10 04:08:17', '2024-06-10 04:08:17');

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
  `banner` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: Inactive, 1: Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `title`, `slug`, `banner`, `status`, `created_at`, `updated_at`) VALUES
(7, 'House', 'house', '1718002947.jpeg', 1, '2024-06-10 02:02:27', '2024-06-10 02:02:27'),
(8, 'Residential', 'residential', '1718002968.jpeg', 1, '2024-06-10 02:02:48', '2024-06-10 02:02:48'),
(9, 'Condo', 'condo', '1718002976.webp', 1, '2024-06-10 02:02:56', '2024-06-10 02:02:56'),
(10, 'Commercial', 'commercial', '1718002990.jpg', 1, '2024-06-10 02:03:10', '2024-06-10 02:03:10');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `property_features`
--
ALTER TABLE `property_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=400;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
