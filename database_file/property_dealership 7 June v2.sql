-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2024 at 04:18 PM
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
(3, '2024_06_03_113828_create_features_table', 2),
(5, '2024_06_03_122537_create_types_table', 3),
(6, '2024_06_03_122834_create_properties_table', 4),
(7, '2024_06_04_053629_create_property_features_table', 5),
(8, '2024_06_04_053907_create_property_types_table', 6),
(9, '2024_06_04_111142_add_code_field_to_neighborhoods_table', 7),
(10, '2024_06_04_115901_add_fields_to_neighborhoods_table', 8),
(11, '2024_06_07_052015_add_fields_to_properties_table', 9);

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
  `images` varchar(255) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: Inactive, 1: Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `neighborhoods`
--

INSERT INTO `neighborhoods` (`id`, `title`, `slug`, `code`, `banner`, `zip`, `country`, `state`, `city`, `map`, `images`, `description`, `status`, `created_at`, `updated_at`) VALUES
(7, 'La Jolla Excellence', 'la-jolla-excellence32', 'LJE', 'LJEBM1717677826.webp', '11501', 'Mexico', 'Baja California', 'Rosarito', 'https://maps.app.goo.gl/csQgnFBzaKadEs947', '\"[\\\"LJEBM40.webp\\\"]\"', '<p>La Jolla Excellence is a premier residential development situated in Playas de Rosarito, Baja California, Mexico.</p><p>This opulent community boasts an extensive selection of premium villas and condos for sale that ensure unparalleled comfort and convenience for homeowners.</p><p>With breathtaking ocean vistas, top-of-the-line amenities, and convenient access to local attractions, La Jolla Excellence stands out as the ideal destination for those seeking a sophisticated lifestyle in a stunning seaside location.</p><p>Explore our range of Rosarito Real Estate options today!</p>', 1, '2024-06-06 06:07:35', '2024-06-06 08:33:01'),
(8, 'Las Olas One', 'las-olas-one79', 'LOO', 'LOOBM1717757817.webp', '22710', 'Mexico', 'Baja California', 'Rosarito', 'https://maps.app.goo.gl/TTyXeGtNk3ebEDTi6', '\"[\\\"LOOBM228.webp\\\",\\\"LOOBM365.webp\\\"]\"', '<p>If you’re seeking a slice of paradise in the heart of Rosarito Beach, Mexico, look no further than Las Olas One Development.&nbsp;</p><p>Nestled along the stunning Baja coastline, this premier residential development offers luxurious oceanfront condos for sale that will captivate both your heart and your senses.&nbsp;</p><p>With its prime location, impeccable amenities, and breathtaking views, Las Olas One Development is the epitome of Rosarito real estate at its finest.</p><p>If you’re seeking a slice of paradise in the heart of Rosarito Beach, Mexico, look no further than Las Olas One Development.&nbsp;</p><p>Nestled along the stunning Baja coastline, this premier residential development offers luxurious oceanfront condos for sale that will captivate both your heart and your senses.&nbsp;</p><p>With its prime location, impeccable amenities, and breathtaking views, Las Olas One Development is the epitome of Rosarito real estate at its finest.</p><h2><strong>A Coastal Haven</strong></h2><p>Situated just south of the iconic Rosarito Beach Hotel, Las Olas One Development stands proudly as a beacon of elegance and tranquility.&nbsp;</p><p>This exclusive development is part of the renowned Las Olas Communities, a trio of oceanfront towers that have been enchanting residents and visitors alike for over a decade.&nbsp;</p><p>With its prime position along the Free Road at KM 28, Las Olas One Development offers convenient access to all that Rosarito has to offer, from its vibrant nightlife to its exquisite dining scene.</p><h2><strong>The Perfect Location</strong></h2><p>Las Olas One Development’s ideal location allows you to experience the best of Rosarito and its surrounding areas.&nbsp;</p><p>Within walking distance, you’ll find the iconic Rosarito Beach Hotel, where you can indulge in delicious local cuisine and vibrant nightlife.&nbsp;</p><p>Visit Baja Juniors Tacos, just half a block from the gate, to savor authentic Mexican flavors.&nbsp;</p><p>The nearby Convention Center offers a variety of events and exhibitions throughout the year, ensuring there’s always something exciting happening in the area.</p><p>Situated just south of the iconic Rosarito Beach Hotel, Las Olas One Development stands proudly as a beacon of elegance and tranquility.&nbsp;</p><p>This exclusive development is part of the renowned Las Olas Communities, a trio of oceanfront towers that have been enchanting residents and visitors alike for over a decade.&nbsp;</p><p>With its prime position along the Free Road at KM 28, Las Olas One Development offers convenient access to all that Rosarito has to offer, from its vibrant nightlife to its exquisite dining scene.</p><h2><strong>The Perfect Location</strong></h2><p>Las Olas One Development’s ideal location allows you to experience the best of Rosarito and its surrounding areas.&nbsp;</p><p>Within walking distance, you’ll find the iconic Rosarito Beach Hotel, where you can indulge in delicious local cuisine and vibrant nightlife.&nbsp;</p><p>Visit Baja Juniors Tacos, just half a block from the gate, to savor authentic Mexican flavors.&nbsp;</p><p>The nearby Convention Center offers a variety of events and exhibitions throughout the year, ensuring there’s always something exciting happening in the area.</p>', 1, '2024-06-07 05:56:57', '2024-06-07 05:56:57'),
(9, 'Rancho del Mar', 'rancho-del-mar62', 'RDM68', 'RDM681717761102.jpg', '22000', 'Mexico', 'Baja California', 'Tijuana', 'https://maps.app.goo.gl/BYowfqvKzzhpkCkj9', '\"[\\\"RDM68928.jpeg\\\",\\\"RDM68224.jpg\\\"]\"', '<p>Are you looking for a slice of paradise in Baja California? Look no further than Rancho Del Mar, a residential community nestled just steps away from the Pacific Ocean.&nbsp;</p><p>With its stunning ocean views, convenient location, and commitment to quality, Rancho Del Mar offers an unparalleled lifestyle in the heart of Rosarito Beach. Whether you’re looking for a permanent residence or an investment opportunity, this neighborhood has it all.&nbsp;</p><p>In this article, we’ll explore the highlights of Rancho Del Mar and why it’s the perfect place to call home in the vibrant city of Rosarito Beach.</p><h2><strong>Location and Accessibility</strong></h2><p>Rancho Del Mar boasts a prime location, making it easily accessible to both local amenities and international borders.&nbsp;</p><p>Situated just 5 minutes from Rosarito Beach and 10 minutes from Playas de Tijuana, residents can enjoy the best of both worlds.</p><p>&nbsp;Additionally, the neighborhood is only 30 minutes away from downtown San Diego, providing a seamless connection to the United States.&nbsp;</p><p>Located at kilometer 24.5 of the Scenic Highway that connects Tijuana with Rosarito, Rancho Del Mar offers a convenient and well-connected lifestyle.</p><p>&nbsp;</p><h2><strong>Rancho del Mar Amenities</strong></h2><h2>&nbsp;</h2><p>&nbsp;</p><h4>Embrace the Lifestyle</h4><p><strong>One of the most enthralling aspects of Rancho Del Mar is the lifestyle it offers.</strong></p><p><strong>With fantastic weather, and mesmerizing ocean views, it truly embodies the art of living.</strong></p><p>&nbsp;</p><h4>Strategic Location</h4><p><strong>Just 5 minutes from Rosarito Beach and Playas de Tijuana, and a mere 30 minutes from downtown San Diego, Rancho Del Mar is strategically located for both leisure and work.</strong></p><p>&nbsp;</p><h4>Nearby Attractions</h4><p><strong>The Pabellon Shopping Mall, just a five-minute drive away, offers a variety of dining, shopping, and entertainment options.</strong></p><p><strong>For golf enthusiasts, the Real del Mar Golf Course is just 10 minutes away.</strong></p>', 1, '2024-06-07 06:51:42', '2024-06-07 06:51:42');

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
  `map` varchar(255) NOT NULL,
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
(7, 'LOOBMS1271', 'Las Olas One, Suite 20', 'las-olas-one-suite-2085', '289000', 8, 1, '1250', 2, 3, 2, 'LOOBMS12711717760710.webp', '[\"LOOBMS1271925.webp\",\"LOOBMS1271152.webp\"]', 'https://maps.app.goo.gl/csQgnFBzaKadEs947', '<p>One of a kind money making machine or a private piece paradise!</p><p>This is not only an Oceanfront Condo with all the bells and whistles of Rosarito but also a rare corner unit that offers incredible 270 degree views.</p><p>Las Olas One sits just 3 minutes away from downtown Rosarito, allowing you access to one the most exclusive and beautiful stretches of beachfront.</p><p>This is a unique opportunity to own a rare corner unit with resort type style condo, beach access and just a short beautiful beach walk from downtown Rosarito for under $300K. This incredible condo has an infinity pool and jacuzzi that sit as close as possible to the Pacific Ocean not only allowing for incredible ocean views, majestic sunsets but also allowing you to relish the indisputably best views to the Coronado islands, Rosarito Pier and Rosarito Downtown.</p><p>THE SIZE AND LAYOUT</p><p>This 1,250 square feet, 2 Bed 2 Bath unit is ready for you to move in, sold as is and completely furnished allowing you to start enjoying it or continue its money making track as it is a short term rental dream.- As you enter you walk into the open concept kitchen/dining and living area. All allowing spectacular Ocean views from anywhere you decide to be. The master bedroom although not oceanfront also offers striking Ocean views.</p><p>This condo sits on the 5th floor and offers a nice size balcony to enjoy a unique 270 degree view not only allowing unobstructed views to the Pacific Ocean, Coronado Island but also views to downtown Rosarito and hills.</p><p>If you are looking for that perfect mix of a vacation home and an income property all in one without such a big investment this is the place for you as it is very popular amongst renters because it offers all the bells and whistles of the bigger developments while also allowing direct access to a sandy beach and still managing to be close enough to downtown yet far enough to not be in the busy party scene.</p><p>THE COMMUNITY</p><p>Las Olas One is a small community that consists of only one tower that sits directly on the OceanFront offering as close to the water as possible living.<br>This community offers alluring amenities, direct Beach access to a sandy beach and ample entertainment/dining experiences all within walking distance.</p><p>Amenities include:</p><p>– Secured direct beach access<br>– Infinity pool<br>– Infinity jacuzzi<br>– Ocean view gym<br>– 24 hr security<br>– Gated community<br>– Elevator</p><p>THE LOCATION</p><p>It’s only about a 35-minute straight shot south of the San Ysidro border crossing, yet worlds apart from the tourist-centric nightlife of downtown Rosarito.</p><p>Over 2 dozen restaurants with different cuisines, convenience stores, and gas stations are within a 3-block radius.</p><p>Moreover, Baja’s Napa Valley is only 45 minutes away with more than 300 wineries, microbreweries, and first-rate restaurants; also known as “Valle de Guadalupe”, or simply “Valle” to locals.</p><p>TITLE</p><p>The property is free and clear of all liens and encumbrances ready for the new Buyer to obtain clear title in the way of a “Bank Trust” (Fideicomiso) for foreign buyers transfer or Escritura (Fee Simple Title) for Mexican nationals.</p><p>TERMS</p><p>This is a cash sale only. No financing is considered. Please arrange all financing approvals with your lender prior to setting up a showing as proof of funds may be requested to schedule.</p><p>VIEWING THIS CONDO</p><p>This property is viewed by appointment only.<br>Because this property is currently being rented short term, we ask that you do your best to coordinate a viewing with at least 48 hours notice to set you up for an exclusive and private showing, however we are flexible to schedule on a case by case basis.</p><p>*Condo is sold AS IS and furnished*</p><p>*Disclaimer: Information is deemed to be correct but not guaranteed*</p><p>*PRICE IS DISPLAYED IN U.S. DOLLARS BUT PURCHASE WILL BE REGISTERED IN MEXICAN PESOS AT THE CURRENT EXCHANGE RATE AT THE TIME OF CLOSING*</p>', 'Las Olas One, Suite 20', 'Mexico', 'Baja California', 'Rosarito', 2, '2003', '254', '', 1, '2024-06-07 00:00:00', 1, '2024-06-07 06:45:10', '2024-06-07 06:45:10', 1, NULL, NULL),
(8, 'RDM68R9584', 'Rented Real del Mar , La Cañada', 'rented-real-del-mar-la-ca-ada91', '2400', 9, 2, '2000', 3, 3, 1, 'RDM68R95841717761256.jpg', '[\"RDM68R9584526.jpeg\",\"RDM68R9584512.jpeg\",\"RDM68R9584258.jpg\"]', 'https://maps.app.goo.gl/BYowfqvKzzhpkCkj9', '<p>THE SIZE AND LAYOUT</p><p>Get ready to be in awe of this incredibly roomy three-bedroom, three-and-a-half-bathroom home in a top-notch community with breathtaking views! The open floor plan is defined by the amazing carved ceilings and wide windows that let in an abundance of natural light. The well-kept interior boasts a modern kitchen and appliances, a unique ceiling, and several other thoughtfully designed features. The spacious, well-maintained home includes stainless steel appliances, air conditioning units in the living room and two bedrooms, and a whole-house heater. This home features a modest third bedroom with an ensuite bathroom in addition to two spacious main bedrooms. Additionally, there is a large garage that is ideal for storage and organized. This house’s backyard is its primary feature. With a spacious jacuzzi, a pizza oven, and an outdoor kitchen, this area is perfect for entertaining. The house is available unfurnished, but for an extra monthly fee, you may arrange for a furnished space if that’s what you’re after. This house is close to the community private school and in a very safe neighborhood. This is the ideal family house in a highly sought-after neighborhood.</p><p>THE COMMUNITY</p><p>With stand-alone homes, this is one of the most sought-after communities. To make this your ideal location, the community offers a private school, dining options, lodging, a golf course, an equestrian club, and many other attractions.</p><p>THE LOCATION</p><p>The distance to the south of the San Ysidro border crossing is only roughly twenty minutes straight; it takes five minutes to go to Rosarito and five minutes to get to Playas de Tijuana.</p><p>TERMS</p><p>This is a long term rental only. Asking is $2,750 USD per month</p><p>VIEWING THIS PROPERTY</p><p>This property is occupied and may viewed by appointment only.</p><p>We ask that you do your best to coordinate a viewing with at least 48 hours notice to set you up for an exclusive and private showing, however we are flexible to schedule&nbsp; on a case by case basis.</p><p>*PRICE IS DISPLAYED IN U.S. DOLLARS *</p><p>Disclaimer: Information is deemed to be correct but not guaranteed.</p>', 'Rented Real del Mar , La Cañada', 'Mexico', 'Baja California', 'Tijuana', 2, '2002', '', '', 1, '2024-06-28 00:00:00', 1, '2024-06-07 06:54:16', '2024-06-07 06:54:16', 2, NULL, NULL);

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
(136, 7, 3, '2024-06-07 06:45:10', '2024-06-07 06:45:10'),
(137, 7, 4, '2024-06-07 06:45:10', '2024-06-07 06:45:10'),
(138, 7, 5, '2024-06-07 06:45:10', '2024-06-07 06:45:10'),
(139, 7, 6, '2024-06-07 06:45:10', '2024-06-07 06:45:10'),
(140, 7, 7, '2024-06-07 06:45:11', '2024-06-07 06:45:11'),
(141, 7, 8, '2024-06-07 06:45:11', '2024-06-07 06:45:11'),
(142, 7, 9, '2024-06-07 06:45:11', '2024-06-07 06:45:11'),
(143, 7, 10, '2024-06-07 06:45:11', '2024-06-07 06:45:11'),
(144, 7, 11, '2024-06-07 06:45:11', '2024-06-07 06:45:11'),
(145, 7, 12, '2024-06-07 06:45:11', '2024-06-07 06:45:11'),
(148, 7, 15, '2024-06-07 06:45:11', '2024-06-07 06:45:11'),
(149, 7, 16, '2024-06-07 06:45:11', '2024-06-07 06:45:11'),
(150, 7, 17, '2024-06-07 06:45:11', '2024-06-07 06:45:11'),
(151, 7, 18, '2024-06-07 06:45:11', '2024-06-07 06:45:11'),
(152, 7, 19, '2024-06-07 06:45:11', '2024-06-07 06:45:11'),
(153, 7, 20, '2024-06-07 06:45:11', '2024-06-07 06:45:11'),
(154, 7, 21, '2024-06-07 06:45:12', '2024-06-07 06:45:12'),
(155, 7, 22, '2024-06-07 06:45:12', '2024-06-07 06:45:12'),
(156, 7, 23, '2024-06-07 06:45:12', '2024-06-07 06:45:12'),
(157, 7, 24, '2024-06-07 06:45:12', '2024-06-07 06:45:12'),
(158, 7, 25, '2024-06-07 06:45:12', '2024-06-07 06:45:12'),
(159, 8, 3, '2024-06-07 06:54:16', '2024-06-07 06:54:16'),
(160, 8, 4, '2024-06-07 06:54:16', '2024-06-07 06:54:16'),
(161, 8, 5, '2024-06-07 06:54:16', '2024-06-07 06:54:16'),
(162, 8, 6, '2024-06-07 06:54:16', '2024-06-07 06:54:16'),
(163, 8, 7, '2024-06-07 06:54:17', '2024-06-07 06:54:17'),
(164, 8, 8, '2024-06-07 06:54:17', '2024-06-07 06:54:17'),
(165, 8, 9, '2024-06-07 06:54:17', '2024-06-07 06:54:17'),
(166, 8, 10, '2024-06-07 06:54:17', '2024-06-07 06:54:17'),
(167, 8, 11, '2024-06-07 06:54:17', '2024-06-07 06:54:17'),
(168, 8, 12, '2024-06-07 06:54:17', '2024-06-07 06:54:17'),
(169, 8, 13, '2024-06-07 06:54:17', '2024-06-07 06:54:17'),
(170, 8, 14, '2024-06-07 06:54:17', '2024-06-07 06:54:17'),
(171, 8, 15, '2024-06-07 06:54:17', '2024-06-07 06:54:17'),
(172, 8, 16, '2024-06-07 06:54:17', '2024-06-07 06:54:17'),
(173, 8, 17, '2024-06-07 06:54:17', '2024-06-07 06:54:17'),
(174, 8, 18, '2024-06-07 06:54:17', '2024-06-07 06:54:17'),
(175, 8, 19, '2024-06-07 06:54:17', '2024-06-07 06:54:17'),
(178, 8, 22, '2024-06-07 06:54:17', '2024-06-07 06:54:17'),
(179, 8, 23, '2024-06-07 06:54:17', '2024-06-07 06:54:17'),
(180, 8, 24, '2024-06-07 06:54:17', '2024-06-07 06:54:17'),
(181, 8, 25, '2024-06-07 06:54:17', '2024-06-07 06:54:17');

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
(13, 7, 2, '2024-06-07 06:45:12', '2024-06-07 06:45:12'),
(14, 7, 4, '2024-06-07 06:45:12', '2024-06-07 06:45:12'),
(15, 8, 3, '2024-06-07 06:54:18', '2024-06-07 06:54:18'),
(16, 8, 4, '2024-06-07 06:54:18', '2024-06-07 06:54:18');

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `neighborhoods`
--
ALTER TABLE `neighborhoods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `property_features`
--
ALTER TABLE `property_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
