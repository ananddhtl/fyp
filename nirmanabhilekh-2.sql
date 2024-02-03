-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 03, 2024 at 06:16 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nirmanabhilekh-2`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `activities_title` text NOT NULL,
  `activities_subtitle` varchar(255) DEFAULT NULL,
  `activities_cat_ID` smallint(6) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `unit` varchar(255) NOT NULL,
  `rate` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `activities_title`, `activities_subtitle`, `activities_cat_ID`, `status`, `unit`, `rate`, `created_at`, `updated_at`) VALUES
(1, 'Earth Work In Excavation In Soft Soil Using Machine', NULL, 1, 0, 'MC', NULL, '2023-03-10 04:49:34', '2023-03-10 04:49:34'),
(2, 'Earth Work In Excavation In Soft Rock Using Machine', NULL, 1, 0, 'MC', 140.73, '2023-03-10 04:51:33', '2023-03-10 04:51:33'),
(3, 'Deep Foundation Excavation Manually', NULL, 1, 0, 'MC', 1872.8, '2023-03-10 04:52:32', '2023-03-10 04:52:32'),
(4, 'Bolder Soiling', NULL, 1, 0, 'MC', 3788.04, '2023-03-10 04:53:26', '2023-03-10 04:53:26'),
(5, 'PCC IN Foundation M 10', NULL, 1, 0, 'CM', 14536.5, '2023-03-10 04:56:49', '2023-03-10 04:56:49'),
(6, 'PCC M15 For Supper Structure', NULL, 1, 0, 'MC', 19741.5, '2023-03-10 04:59:33', '2023-03-10 04:59:33'),
(7, 'PCC M 20 Super Structure', NULL, 1, 0, 'MC', 21575, '2023-03-10 05:01:43', '2023-03-10 05:01:43'),
(8, 'Brick Machinery 1:5', NULL, 1, 0, 'MC', 21465.1, '2023-03-10 05:04:00', '2023-03-10 05:04:00'),
(9, '16 MM Thick Plaster 1:6', NULL, 1, 0, 'SQ METER', 472.64, '2023-03-10 05:06:58', '2023-03-10 05:06:58'),
(10, '38 MM Thich Local Wood Panel Door', NULL, 1, 0, 'SQ METER', 9915.91, '2023-03-10 05:14:31', '2023-03-10 05:14:31'),
(11, '4 MM Thick Glazed Wood Shutter With Sal Wood Frame', NULL, 1, 0, 'SQ METER', 12874, '2023-03-10 05:19:20', '2023-03-10 05:19:20'),
(12, '4 MM Thick Glass Fixing With Listi on Wooden Frame', NULL, 1, 0, 'SQ METER', 1414.83, '2023-03-10 05:24:08', '2023-03-10 05:24:08'),
(13, 'Earth Work In Excavation Manual', 'Earth Work', 1, 0, 'CUM', 1655, '2023-06-20 01:03:17', '2023-06-20 01:03:17'),
(14, 'Stone Machinery 1:4', 'Structure', 1, 0, 'CUM', NULL, '2023-06-20 01:29:04', '2023-06-20 01:29:04'),
(15, 'Pcc M10', 'Concreetee', 1, 0, 'Cum', 10249, '2023-10-08 01:15:14', '2023-10-08 01:15:14'),
(16, 'brick Massonary', 'Wall Str', 1, 0, 'Cum', 14761, '2023-10-08 01:17:18', '2023-10-08 01:17:18');

-- --------------------------------------------------------

--
-- Table structure for table `activity_catagories`
--

CREATE TABLE `activity_catagories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `activity_catagories_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_catagories`
--

INSERT INTO `activity_catagories` (`id`, `activity_catagories_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Construction', '0', '2023-03-08 00:32:33', '2023-03-08 00:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `add_users`
--

CREATE TABLE `add_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_users`
--

INSERT INTO `add_users` (`id`, `username`, `password`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Surya Poudel', '$2y$10$KGMiaqT0PK/NEvuBFsSukuOmd1.bFzL/4RTcOqTjw5iTcZ/hxyn8q', 'admin@gmail.com', '2023-03-09 01:02:24', '2023-03-09 01:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_phonenumber` bigint(20) NOT NULL,
  `dob` date DEFAULT NULL,
  `customer_profession` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `customer_address`, `customer_email`, `customer_phonenumber`, `dob`, `customer_profession`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Surya Poudel', 'Srijanachowk 08', 'poudel.surya98@gmail.com', 9846513373, '2023-03-09', 'Engineer', 0, '2023-03-08 00:30:10', '2023-03-08 00:30:10'),
(2, 'Ajay Yadav', 'Pokhara 14 Chauthe', 'test@gmail.com', 9846921808, '2023-11-29', 'Developer', 0, '2023-11-29 06:20:55', '2023-11-29 06:20:55');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `equipment_name` varchar(255) NOT NULL,
  `equipment_cat_id` smallint(6) NOT NULL,
  `purchase_rate` bigint(20) NOT NULL,
  `cancel` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_catagories`
--

CREATE TABLE `equipment_catagories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `equipment_catagories_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses_from_equipment`
--

CREATE TABLE `expenses_from_equipment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `equipment_id` smallint(6) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `cancel` varchar(255) NOT NULL DEFAULT '0',
  `narration` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `customer_id` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses_staff`
--

CREATE TABLE `expenses_staff` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` bigint(20) NOT NULL,
  `cancel` varchar(255) NOT NULL DEFAULT '0',
  `narration` varchar(255) DEFAULT NULL,
  `staff_id` smallint(6) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `income_from_equipment`
--

CREATE TABLE `income_from_equipment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `equipment_id` smallint(6) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `cancel` varchar(255) NOT NULL DEFAULT '0',
  `narration` varchar(255) DEFAULT NULL,
  `customer_id` smallint(6) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `company_contactnumber` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `itemName` varchar(255) NOT NULL,
  `itemUnit` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `itemName`, `itemUnit`, `created_at`, `updated_at`) VALUES
(1, 'Excavator', 'HR', '2023-03-10 04:08:20', '2023-03-10 04:08:20'),
(2, 'Diesel', 'Litter', '2023-03-10 04:11:49', '2023-03-10 04:11:49'),
(3, 'Skilled Labour', 'MD', '2023-03-10 04:12:02', '2023-03-10 04:12:02'),
(4, 'Unskilled Labour', 'MD', '2023-03-10 04:12:16', '2023-03-10 04:12:16'),
(5, 'Bolder Stone', 'MC', '2023-03-10 04:12:29', '2023-03-10 04:12:29'),
(6, 'Stone', 'MC', '2023-03-10 04:12:39', '2023-03-10 04:12:39'),
(7, 'Fine Sand', 'MC', '2023-03-10 04:12:54', '2023-03-10 04:12:54'),
(8, 'Aggregate 40 MM', 'MC', '2023-03-10 04:13:22', '2023-03-10 04:13:22'),
(9, 'Aggregate 20 MM', 'MC', '2023-03-10 04:13:38', '2023-03-10 04:13:38'),
(10, 'Aggregate 10 MM', 'MC', '2023-03-10 04:13:59', '2023-03-10 04:13:59'),
(11, 'Course sand', 'MC', '2023-03-10 04:14:13', '2023-03-10 04:14:13'),
(12, 'OPC Cement', 'MT', '2023-03-10 04:14:26', '2023-03-10 04:14:26'),
(13, 'PPC Cement', 'MT', '2023-03-10 04:14:38', '2023-03-10 04:14:38'),
(14, 'Bick', 'NOS', '2023-03-10 04:14:51', '2023-03-10 04:14:51'),
(15, 'Local Wood', 'MC', '2023-03-10 04:15:01', '2023-03-10 04:15:01'),
(16, 'Sall Wood', 'MC', '2023-03-10 04:15:13', '2023-03-10 04:15:13'),
(17, 'Hinge 3 inch', 'NOS', '2023-03-10 04:15:34', '2023-03-10 04:15:34'),
(18, 'Hinge 4 inch', 'NOS', '2023-03-10 04:15:52', '2023-03-10 04:15:52'),
(19, 'Towerbolt', 'NOS', '2023-03-10 04:16:08', '2023-03-10 04:16:08'),
(20, 'Screw Nail', 'LS', '2023-03-10 04:16:26', '2023-03-10 04:16:26'),
(21, 'Locking Set', 'NOS', '2023-03-10 04:16:38', '2023-03-10 04:16:38'),
(22, '4 MM Glass', 'MS', '2023-03-10 04:16:53', '2023-03-10 04:16:53'),
(23, 'Water', 'Litre', '2023-03-10 04:18:44', '2023-03-10 04:18:44'),
(24, 'Handle 4 inch', 'NOS', '2023-03-10 05:11:10', '2023-03-10 05:11:10'),
(25, 'Sal Wood Listi', 'RM', '2023-03-10 05:20:40', '2023-03-10 05:20:40');

-- --------------------------------------------------------

--
-- Table structure for table `item_categories`
--

CREATE TABLE `item_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `s_id` varchar(255) NOT NULL,
  `status` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_categories`
--

INSERT INTO `item_categories` (`id`, `cat_name`, `s_id`, `status`, `created_at`, `updated_at`) VALUES
(4, 'test', 'WwiHlfUL2B0Ln6jP3C8F202309841257', 0, '2023-10-10 04:20:23', '2023-10-10 04:56:22'),
(5, 'Test', 'qS2QdEr8lPNwQlcEURo2202309823808', 0, '2023-10-10 04:47:06', '2023-10-10 04:47:06'),
(6, 'test category', 'tRUW9KRP7qTmDG9ORCgh202310009774', 0, '2023-10-10 04:53:02', '2023-10-10 04:53:02');

-- --------------------------------------------------------

--
-- Table structure for table `item_settings`
--

CREATE TABLE `item_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `s_id` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_details` text NOT NULL,
  `cat_id` bigint(20) NOT NULL,
  `normal_rate` double(8,2) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `equal` int(11) NOT NULL,
  `subunit` varchar(60) NOT NULL,
  `equal_value` decimal(20,2) NOT NULL,
  `vatable` bigint(20) DEFAULT NULL,
  `stockable` int(25) DEFAULT NULL,
  `cancel` bigint(20) DEFAULT NULL,
  `cover_image` text DEFAULT NULL,
  `discount_in_percent` bigint(20) DEFAULT NULL,
  `sellrate` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_settings`
--

INSERT INTO `item_settings` (`id`, `s_id`, `item_name`, `item_details`, `cat_id`, `normal_rate`, `unit`, `equal`, `subunit`, `equal_value`, `vatable`, `stockable`, `cancel`, `cover_image`, `discount_in_percent`, `sellrate`, `created_at`, `updated_at`) VALUES
(25, 'e3Uw3xZiAsOMS6CELmEb202306061053', 'Clasberg Beer', 'Beer', 9, 450.00, 'bottle', 1, 'bottle', 1.00, 1, 0, 1, NULL, NULL, 500, '2023-06-16 04:25:15', '2023-08-09 05:43:25'),
(26, 'YyByxwoz1QZDuYqtQwbp202306123354', 'Black Label', 'Hard Drinks', 1, 8000.00, 'bottle', 1, 'ml', 750.00, 1, 0, 0, NULL, NULL, 12000, '2023-06-16 04:26:27', '2023-06-23 05:50:42'),
(27, 'nxuLe5Qthzezz61NXpFb202306149181', 'Budwiser Beer', 'Soft Drinks', 9, 300.00, 'bottle', 1, 'bottle', 1.00, 1, 1, 0, NULL, NULL, 450, '2023-06-21 00:15:32', '2023-06-21 00:15:32'),
(28, '2ZTFFg7vRo8amlfioGSB202306264889', 'Chamal', 'Basmati Chamal', 1, 3000.00, 'sack', 1, 'sack', 25.00, 0, 0, 0, NULL, NULL, 120, '2023-06-27 05:49:59', '2023-06-27 05:51:27'),
(29, 'W0O4YStc35oS7sjtsIiF202306537628', 'Item Name 1', 'Item Details 1', 9, 1000.00, 'kg', 1, 'pics', 200.00, 1, 1, 1, NULL, 12, 200, '2023-07-05 00:23:56', '2023-07-05 00:26:18'),
(30, 'jJrn29reN7o5Yh7oxXcm202306499801', 'Item Name 1', 'Item Details 1', 9, 1000.00, 'kg', 1, 'pics', 100.00, 1, 1, 0, NULL, 12, 200, '2023-07-05 00:31:27', '2023-07-05 00:31:27'),
(32, 'NG9cZY962NtKFWWHwU3Z202308059493', 'Item Name 1', 'Item Details 1', 1, 1200.00, 'kg', 12, 'pics', 100.00, 1, 0, 0, NULL, NULL, 100, '2023-08-11 01:44:11', '2023-10-10 03:30:06'),
(33, 'nJahemjhZdarAM3BzsFk202309726749', 'Update Item Name 1', 'Update Item Details 1', 2, 12000.00, 'updatebox', 1, 'updatekg', 100.00, 1, 1, 0, '/uploads/itemsettings/coverimage/1779353063606910.jpeg', 12, 2000, '2023-10-10 01:50:16', '2023-10-10 03:22:17'),
(34, 'Bq9I24HBsTsqqY8eL6yG202309643427', 'Bricks', 'Bricks 1', 1, 11200.00, 'kg', 1, 'pics', 1000.00, 1, 1, 0, '/uploads/itemsettings/coverimage/1779359486675262.jpeg', 0, 12000, '2023-10-10 03:32:22', '2023-10-10 04:16:06'),
(36, 'deZDt3zGmvXfGe06EWL2202309326875', '20mm Brick', '20mm', 2, 20.00, '1 truck', 1, 'pics', 1000.00, 0, 0, 1, NULL, NULL, 25, '2023-10-10 04:04:41', '2023-10-10 04:10:43'),
(37, 'ZRi7tS7QUeL8QLaALEAa202310080338', 'Item Name 1', 'Item Details 1', 5, 1200.00, 'box', 1, 'kg', 10.00, 0, 0, 0, NULL, NULL, 2000, '2023-10-15 05:16:16', '2023-10-15 05:16:16');

-- --------------------------------------------------------

--
-- Table structure for table `management_users`
--

CREATE TABLE `management_users` (
  `UserId` int(11) DEFAULT NULL,
  `options` text DEFAULT NULL,
  `fullOrPartial` smallint(6) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `management_users`
--

INSERT INTO `management_users` (`UserId`, `options`, `fullOrPartial`, `created_at`, `updated_at`) VALUES
(1, '0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,', 0, '2022-11-17 01:16:23', '2022-11-17 01:16:23'),
(NULL, '0,1,,3,,5,,,,,10,11,,13,,,,,,', 0, '2023-01-12 02:07:53', '2023-01-12 02:07:53'),
(1, '0,1,2,3,4,5,6,7,8,9,10,11,12,13,,,16,,,', 0, '2023-02-23 04:25:21', '2023-02-23 04:25:21'),
(1, '0,1,2,3,4,5,6,7,8,9,10,11,12,,,,,,,', 0, '2023-02-23 04:25:41', '2023-02-23 04:25:41'),
(2, '0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,', 0, '2023-02-23 06:05:13', '2023-02-23 06:05:13'),
(2, '0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,', 0, '2023-02-23 06:05:20', '2023-02-23 06:05:20');

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
(35, '2014_10_12_000000_create_users_table', 1),
(36, '2014_10_12_100000_create_password_resets_table', 1),
(37, '2019_08_19_000000_create_failed_jobs_table', 1),
(38, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(39, '2022_08_26_073242_create_services_table', 1),
(40, '2022_08_26_073337_create_service_billing_amounts_table', 1),
(41, '2022_08_26_073415_create_projects_table', 1),
(42, '2022_08_26_073453_create_project_leaders_table', 1),
(43, '2022_08_26_073519_create_project_activities_table', 1),
(44, '2022_08_26_073602_create_activities_table', 1),
(45, '2022_08_26_073704_create_service_bill_items_table', 1),
(46, '2022_08_26_073734_create_service_catagories_table', 1),
(47, '2022_08_28_092808_create_customers_table', 1),
(48, '2022_08_31_122523_create_activity_catagories_table', 1),
(49, '2022_10_23_055426_create_add_users_table', 1),
(50, '2022_10_30_054722_create_equipment_table', 2),
(51, '2022_10_30_054847_create_equipment_catagories_table', 2),
(52, '2022_10_30_054935_create_income_from_equipment_table', 2),
(53, '2022_10_30_054956_create_expenses_from_equipment_table', 2),
(54, '2022_11_03_093103_create_tools_table', 3),
(55, '2022_11_03_093154_create_tool_catagories_table', 3),
(56, '2022_11_08_101846_create_invoices_table', 4),
(59, '2022_11_14_110549_create_management_users_table', 5),
(60, '2022_11_17_113947_create_staff_controllers_table', 6),
(61, '2022_11_17_114707_create_staff_table', 7),
(62, '2022_11_18_074138_create_expenses_staff_table', 8),
(63, '2022_12_18_074637_create_suppliers_table', 9),
(64, '2023_02_07_085003_create_project_estimations_table', 10),
(65, '2023_02_20_093031_create_nepali_currancy_formats_table', 11),
(66, '2023_03_01_060336_create_sub_activities_table', 11),
(67, '2023_03_08_095136_create_projectestimationsubitems_table', 12),
(68, '2023_03_10_093652_create_items_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `nepali_currancy_formats`
--

CREATE TABLE `nepali_currancy_formats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `primaryInventoryStore`
--

CREATE TABLE `primaryInventoryStore` (
  `inventoryID` varchar(255) NOT NULL,
  `instock` double(8,2) NOT NULL,
  `outstock` double(8,2) NOT NULL,
  `tCode` varchar(255) NOT NULL,
  `cancel` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `unitEqualsTo` varchar(255) NOT NULL,
  `unit_cost_rate` decimal(8,2) NOT NULL DEFAULT 0.00,
  `vat` float NOT NULL,
  `amount` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `primaryInventoryStore`
--

INSERT INTO `primaryInventoryStore` (`inventoryID`, `instock`, `outstock`, `tCode`, `cancel`, `status`, `unitEqualsTo`, `unit_cost_rate`, `vat`, `amount`, `created_at`, `updated_at`) VALUES
('25', 10.00, 0.00, 'gkdDrr1OdGGJo1GoM4v5202310142344', '0', 'received', 'bottle', 450.00, 585, 5085, '2023-10-16 00:07:58', '2023-10-16 00:07:58'),
('26', 1.00, 0.00, 'gkdDrr1OdGGJo1GoM4v5202310142344', '0', 'received', 'bottle', 8000.00, 1040, 9040, '2023-10-16 00:07:58', '2023-10-16 00:07:58'),
('25', 0.00, 10.00, 'pC2JjQtEGjD1VEzcIO7v202310079558', '0', 'return', 'bottle', 450.00, 585, 4500, '2023-10-16 00:08:33', '2023-10-16 00:08:33');

-- --------------------------------------------------------

--
-- Table structure for table `projectestimationsubitems`
--

CREATE TABLE `projectestimationsubitems` (
  `project_id` smallint(6) NOT NULL,
  `activities_id` smallint(6) NOT NULL,
  `qty` float NOT NULL,
  `rate` float NOT NULL,
  `tCode` varchar(255) NOT NULL,
  `sub_activity_id` int(11) NOT NULL,
  `cancel` int(1) NOT NULL DEFAULT 0,
  `is_estimated` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projectestimationsubitems`
--

INSERT INTO `projectestimationsubitems` (`project_id`, `activities_id`, `qty`, `rate`, `tCode`, `sub_activity_id`, `cancel`, `is_estimated`, `created_at`, `updated_at`) VALUES
(4, 1, 37.49, 2650, 'b1FAFM3vscwO5gx389Tg2023025342414', 1, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 1, 299.92, 154, 'b1FAFM3vscwO5gx389Tg2023025342414', 2, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 2, 19.39, 2650, 'b1FAFM3vscwO5gx389Tg2023025342414', 1, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 2, 155.12, 154, 'b1FAFM3vscwO5gx389Tg2023025342414', 2, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 3, 636, 880, 'b1FAFM3vscwO5gx389Tg2023025342414', 4, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 4, 180, 880, 'b1FAFM3vscwO5gx389Tg2023025342414', 4, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 4, 132, 1450, 'b1FAFM3vscwO5gx389Tg2023025342414', 5, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 5, 30, 1140, 'b1FAFM3vscwO5gx389Tg2023025342414', 3, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 5, 120, 880, 'b1FAFM3vscwO5gx389Tg2023025342414', 4, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 5, 6.6, 17000, 'b1FAFM3vscwO5gx389Tg2023025342414', 12, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 5, 19.5, 2000, 'b1FAFM3vscwO5gx389Tg2023025342414', 8, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 5, 7.2, 2080, 'b1FAFM3vscwO5gx389Tg2023025342414', 9, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 5, 14.1, 2100, 'b1FAFM3vscwO5gx389Tg2023025342414', 11, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 5, 3600, 1, 'b1FAFM3vscwO5gx389Tg2023025342414', 23, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 6, 40, 1140, 'b1FAFM3vscwO5gx389Tg2023025342414', 3, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 6, 350, 880, 'b1FAFM3vscwO5gx389Tg2023025342414', 4, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 6, 16, 17000, 'b1FAFM3vscwO5gx389Tg2023025342414', 12, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 6, 26, 2000, 'b1FAFM3vscwO5gx389Tg2023025342414', 8, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 6, 11, 2080, 'b1FAFM3vscwO5gx389Tg2023025342414', 9, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 6, 5.5, 2250, 'b1FAFM3vscwO5gx389Tg2023025342414', 10, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 6, 22.25, 2100, 'b1FAFM3vscwO5gx389Tg2023025342414', 11, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 7, 64, 1140, 'b1FAFM3vscwO5gx389Tg2023025342414', 3, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 7, 560, 880, 'b1FAFM3vscwO5gx389Tg2023025342414', 4, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 7, 32, 17000, 'b1FAFM3vscwO5gx389Tg2023025342414', 12, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 7, 45.6, 2080, 'b1FAFM3vscwO5gx389Tg2023025342414', 9, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 7, 23.2, 2250, 'b1FAFM3vscwO5gx389Tg2023025342414', 10, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 7, 34, 2100, 'b1FAFM3vscwO5gx389Tg2023025342414', 11, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 8, 45, 1140, 'b1FAFM3vscwO5gx389Tg2023025342414', 3, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 8, 66, 880, 'b1FAFM3vscwO5gx389Tg2023025342414', 4, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 8, 3, 17000, 'b1FAFM3vscwO5gx389Tg2023025342414', 12, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 8, 16800, 18.9, 'b1FAFM3vscwO5gx389Tg2023025342414', 14, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 8, 8.4, 2100, 'b1FAFM3vscwO5gx389Tg2023025342414', 11, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 9, 600, 1140, 'b1FAFM3vscwO5gx389Tg2023025342414', 3, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 9, 800, 880, 'b1FAFM3vscwO5gx389Tg2023025342414', 4, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 9, 19.1, 15000, 'b1FAFM3vscwO5gx389Tg2023025342414', 13, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 9, 78.5, 1835, 'b1FAFM3vscwO5gx389Tg2023025342414', 7, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 10, 141, 1140, 'b1FAFM3vscwO5gx389Tg2023025342414', 3, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 10, 14.1, 880, 'b1FAFM3vscwO5gx389Tg2023025342414', 4, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 10, 1.191, 39000, 'b1FAFM3vscwO5gx389Tg2023025342414', 15, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 10, 85.2, 36, 'b1FAFM3vscwO5gx389Tg2023025342414', 18, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 10, 14.19, 180, 'b1FAFM3vscwO5gx389Tg2023025342414', 21, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 10, 14.1, 73, 'b1FAFM3vscwO5gx389Tg2023025342414', 19, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 10, 28.38, 28, 'b1FAFM3vscwO5gx389Tg2023025342414', 24, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 11, 161.2, 1140, 'b1FAFM3vscwO5gx389Tg2023025342414', 3, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 11, 16.12, 880, 'b1FAFM3vscwO5gx389Tg2023025342414', 4, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 11, 0.88, 200000, 'b1FAFM3vscwO5gx389Tg2023025342414', 16, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 11, 143.2, 25, 'b1FAFM3vscwO5gx389Tg2023025342414', 17, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 11, 71.6, 54, 'b1FAFM3vscwO5gx389Tg2023025342414', 19, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 11, 35.84, 28, 'b1FAFM3vscwO5gx389Tg2023025342414', 24, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 11, 19.44, 699.4, 'b1FAFM3vscwO5gx389Tg2023025342414', 22, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 12, 2.4, 1140, 'b1FAFM3vscwO5gx389Tg2023025342414', 3, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 12, 0.24, 880, 'b1FAFM3vscwO5gx389Tg2023025342414', 4, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 12, 162, 65.6, 'b1FAFM3vscwO5gx389Tg2023025342414', 25, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 12, 40, 699.4, 'b1FAFM3vscwO5gx389Tg2023025342414', 22, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 12, 0.8, 50, 'b1FAFM3vscwO5gx389Tg2023025342414', 20, 0, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(4, 5, 1000, 1140, 'YGUP9QlmKtILoW2fiKMm2023029429124', 3, 1, 1, '2023-03-10 09:40:28', '2023-03-10 11:11:03'),
(4, 5, 4000, 880, 'YGUP9QlmKtILoW2fiKMm2023029429124', 4, 1, 1, '2023-03-10 09:40:28', '2023-03-10 11:11:03'),
(4, 5, 220, 17000, 'YGUP9QlmKtILoW2fiKMm2023029429124', 12, 1, 1, '2023-03-10 09:40:28', '2023-03-10 11:11:03'),
(4, 5, 650, 2000, 'YGUP9QlmKtILoW2fiKMm2023029429124', 8, 1, 1, '2023-03-10 09:40:28', '2023-03-10 11:11:03'),
(4, 5, 240, 2080, 'YGUP9QlmKtILoW2fiKMm2023029429124', 9, 1, 1, '2023-03-10 09:40:28', '2023-03-10 11:11:03'),
(4, 5, 470, 2100, 'YGUP9QlmKtILoW2fiKMm2023029429124', 11, 1, 1, '2023-03-10 09:40:28', '2023-03-10 11:11:03'),
(4, 5, 120000, 1, 'YGUP9QlmKtILoW2fiKMm2023029429124', 23, 1, 1, '2023-03-10 09:40:28', '2023-03-10 11:11:03'),
(4, 1, 16.3, 2650, 'YGUP9QlmKtILoW2fiKMm2023029429124', 1, 1, 1, '2023-03-10 09:40:28', '2023-03-10 11:11:03'),
(4, 1, 130.4, 154, 'YGUP9QlmKtILoW2fiKMm2023029429124', 2, 1, 1, '2023-03-10 09:40:28', '2023-03-10 11:11:03'),
(4, 2, 5.54, 2650, 'YGUP9QlmKtILoW2fiKMm2023029429124', 1, 1, 1, '2023-03-10 09:40:28', '2023-03-10 11:11:03'),
(4, 2, 44.32, 154, 'YGUP9QlmKtILoW2fiKMm2023029429124', 2, 1, 1, '2023-03-10 09:40:28', '2023-03-10 11:11:03'),
(4, 5, 10, 1140, 'YGUP9QlmKtILoW2fiKMm2023029429124', 3, 1, 1, '2023-03-10 09:40:28', '2023-03-10 11:11:03'),
(4, 5, 40, 880, 'YGUP9QlmKtILoW2fiKMm2023029429124', 4, 1, 1, '2023-03-10 09:40:28', '2023-03-10 11:11:03'),
(4, 5, 2.2, 17000, 'YGUP9QlmKtILoW2fiKMm2023029429124', 12, 1, 1, '2023-03-10 09:40:28', '2023-03-10 11:11:03'),
(4, 5, 6.5, 2000, 'YGUP9QlmKtILoW2fiKMm2023029429124', 8, 1, 1, '2023-03-10 09:40:28', '2023-03-10 11:11:03'),
(4, 5, 2.4, 2080, 'YGUP9QlmKtILoW2fiKMm2023029429124', 9, 1, 1, '2023-03-10 09:40:28', '2023-03-10 11:11:03'),
(4, 5, 4.7, 2100, 'YGUP9QlmKtILoW2fiKMm2023029429124', 11, 1, 1, '2023-03-10 09:40:28', '2023-03-10 11:11:03'),
(4, 5, 1200, 1, 'YGUP9QlmKtILoW2fiKMm2023029429124', 23, 1, 1, '2023-03-10 09:40:28', '2023-03-10 11:11:03'),
(4, 5, 1000, 1140, 'YGUP9QlmKtILoW2fiKMm2023029429124', 3, 1, 1, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(4, 5, 4000, 880, 'YGUP9QlmKtILoW2fiKMm2023029429124', 4, 1, 1, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(4, 5, 220, 17000, 'YGUP9QlmKtILoW2fiKMm2023029429124', 12, 1, 1, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(4, 5, 650, 2000, 'YGUP9QlmKtILoW2fiKMm2023029429124', 8, 1, 1, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(4, 5, 240, 2080, 'YGUP9QlmKtILoW2fiKMm2023029429124', 9, 1, 1, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(4, 5, 470, 2100, 'YGUP9QlmKtILoW2fiKMm2023029429124', 11, 1, 1, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(4, 5, 120000, 1, 'YGUP9QlmKtILoW2fiKMm2023029429124', 23, 1, 1, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(4, 1, 16.3, 2650, 'YGUP9QlmKtILoW2fiKMm2023029429124', 1, 1, 1, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(4, 1, 130.4, 154, 'YGUP9QlmKtILoW2fiKMm2023029429124', 2, 1, 1, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(4, 2, 5.54, 2650, 'YGUP9QlmKtILoW2fiKMm2023029429124', 1, 1, 1, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(4, 2, 44.32, 154, 'YGUP9QlmKtILoW2fiKMm2023029429124', 2, 1, 1, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(4, 5, 10, 1140, 'YGUP9QlmKtILoW2fiKMm2023029429124', 3, 1, 1, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(4, 5, 40, 880, 'YGUP9QlmKtILoW2fiKMm2023029429124', 4, 1, 1, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(4, 5, 2.2, 17000, 'YGUP9QlmKtILoW2fiKMm2023029429124', 12, 1, 1, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(4, 5, 6.5, 2000, 'YGUP9QlmKtILoW2fiKMm2023029429124', 8, 1, 1, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(4, 5, 2.4, 2080, 'YGUP9QlmKtILoW2fiKMm2023029429124', 9, 1, 1, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(4, 5, 4.7, 2100, 'YGUP9QlmKtILoW2fiKMm2023029429124', 11, 1, 1, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(4, 5, 1200, 1, 'YGUP9QlmKtILoW2fiKMm2023029429124', 23, 1, 1, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(4, 5, 10, 1140, 'YGUP9QlmKtILoW2fiKMm2023029429124', 3, 1, 1, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(4, 5, 40, 880, 'YGUP9QlmKtILoW2fiKMm2023029429124', 4, 1, 1, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(4, 5, 2.2, 17000, 'YGUP9QlmKtILoW2fiKMm2023029429124', 12, 1, 1, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(4, 5, 6.5, 2000, 'YGUP9QlmKtILoW2fiKMm2023029429124', 8, 1, 1, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(4, 5, 2.4, 2080, 'YGUP9QlmKtILoW2fiKMm2023029429124', 9, 1, 1, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(4, 5, 4.7, 2100, 'YGUP9QlmKtILoW2fiKMm2023029429124', 11, 1, 1, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(4, 5, 1200, 1, 'YGUP9QlmKtILoW2fiKMm2023029429124', 23, 1, 1, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(4, 5, 1000, 1140, 'YGUP9QlmKtILoW2fiKMm2023029429124', 3, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 4000, 880, 'YGUP9QlmKtILoW2fiKMm2023029429124', 4, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 220, 17000, 'YGUP9QlmKtILoW2fiKMm2023029429124', 12, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 650, 2000, 'YGUP9QlmKtILoW2fiKMm2023029429124', 8, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 240, 2080, 'YGUP9QlmKtILoW2fiKMm2023029429124', 9, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 470, 2100, 'YGUP9QlmKtILoW2fiKMm2023029429124', 11, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 120000, 1, 'YGUP9QlmKtILoW2fiKMm2023029429124', 23, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 1, 16.3, 2650, 'YGUP9QlmKtILoW2fiKMm2023029429124', 1, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 1, 130.4, 154, 'YGUP9QlmKtILoW2fiKMm2023029429124', 2, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 2, 5.54, 2650, 'YGUP9QlmKtILoW2fiKMm2023029429124', 1, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 2, 44.32, 154, 'YGUP9QlmKtILoW2fiKMm2023029429124', 2, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 10, 1140, 'YGUP9QlmKtILoW2fiKMm2023029429124', 3, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 40, 880, 'YGUP9QlmKtILoW2fiKMm2023029429124', 4, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 2.2, 17000, 'YGUP9QlmKtILoW2fiKMm2023029429124', 12, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 6.5, 2000, 'YGUP9QlmKtILoW2fiKMm2023029429124', 8, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 2.4, 2080, 'YGUP9QlmKtILoW2fiKMm2023029429124', 9, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 4.7, 2100, 'YGUP9QlmKtILoW2fiKMm2023029429124', 11, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 1200, 1, 'YGUP9QlmKtILoW2fiKMm2023029429124', 23, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 10, 1140, 'YGUP9QlmKtILoW2fiKMm2023029429124', 3, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 40, 880, 'YGUP9QlmKtILoW2fiKMm2023029429124', 4, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 2.2, 17000, 'YGUP9QlmKtILoW2fiKMm2023029429124', 12, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 6.5, 2000, 'YGUP9QlmKtILoW2fiKMm2023029429124', 8, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 2.4, 2080, 'YGUP9QlmKtILoW2fiKMm2023029429124', 9, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 4.7, 2100, 'YGUP9QlmKtILoW2fiKMm2023029429124', 11, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 1200, 1, 'YGUP9QlmKtILoW2fiKMm2023029429124', 23, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 10, 1140, 'YGUP9QlmKtILoW2fiKMm2023029429124', 3, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 40, 880, 'YGUP9QlmKtILoW2fiKMm2023029429124', 4, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 2.2, 17000, 'YGUP9QlmKtILoW2fiKMm2023029429124', 12, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 6.5, 2000, 'YGUP9QlmKtILoW2fiKMm2023029429124', 8, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 2.4, 2080, 'YGUP9QlmKtILoW2fiKMm2023029429124', 9, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 4.7, 2100, 'YGUP9QlmKtILoW2fiKMm2023029429124', 11, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 1200, 1, 'YGUP9QlmKtILoW2fiKMm2023029429124', 23, 1, 1, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(4, 5, 10, 1140, 'YGUP9QlmKtILoW2fiKMm2023029429124', 3, 0, 1, '2023-03-10 11:11:03', '2023-03-10 11:11:03'),
(4, 5, 40, 880, 'YGUP9QlmKtILoW2fiKMm2023029429124', 4, 0, 1, '2023-03-10 11:11:03', '2023-03-10 11:11:03'),
(4, 5, 2.2, 17000, 'YGUP9QlmKtILoW2fiKMm2023029429124', 12, 0, 1, '2023-03-10 11:11:03', '2023-03-10 11:11:03'),
(4, 5, 6.5, 2000, 'YGUP9QlmKtILoW2fiKMm2023029429124', 8, 0, 1, '2023-03-10 11:11:03', '2023-03-10 11:11:03'),
(4, 5, 2.4, 2080, 'YGUP9QlmKtILoW2fiKMm2023029429124', 9, 0, 1, '2023-03-10 11:11:03', '2023-03-10 11:11:03'),
(4, 5, 4.7, 2100, 'YGUP9QlmKtILoW2fiKMm2023029429124', 11, 0, 1, '2023-03-10 11:11:03', '2023-03-10 11:11:03'),
(4, 5, 1200, 1, 'YGUP9QlmKtILoW2fiKMm2023029429124', 23, 0, 1, '2023-03-10 11:11:03', '2023-03-10 11:11:03'),
(4, 1, 16.3, 2650, 'YGUP9QlmKtILoW2fiKMm2023029429124', 1, 0, 1, '2023-03-10 11:11:03', '2023-03-10 11:11:03'),
(4, 1, 130.4, 154, 'YGUP9QlmKtILoW2fiKMm2023029429124', 2, 0, 1, '2023-03-10 11:11:03', '2023-03-10 11:11:03'),
(4, 2, 13.85, 2650, 'YGUP9QlmKtILoW2fiKMm2023029429124', 1, 0, 1, '2023-03-10 11:11:03', '2023-03-10 11:11:03'),
(4, 2, 110.8, 154, 'YGUP9QlmKtILoW2fiKMm2023029429124', 2, 0, 1, '2023-03-10 11:11:03', '2023-03-10 11:11:03'),
(5, 5, 10, 1140, 'emktjREEtLcIuAIF9z892023032774585', 3, 0, 0, '2023-03-29 04:12:42', '2023-03-29 04:12:42'),
(5, 5, 40, 880, 'emktjREEtLcIuAIF9z892023032774585', 4, 0, 0, '2023-03-29 04:12:42', '2023-03-29 04:12:42'),
(5, 5, 2.2, 17000, 'emktjREEtLcIuAIF9z892023032774585', 12, 0, 0, '2023-03-29 04:12:42', '2023-03-29 04:12:42'),
(5, 5, 6.5, 2000, 'emktjREEtLcIuAIF9z892023032774585', 8, 0, 0, '2023-03-29 04:12:42', '2023-03-29 04:12:42'),
(5, 5, 2.4, 2080, 'emktjREEtLcIuAIF9z892023032774585', 9, 0, 0, '2023-03-29 04:12:42', '2023-03-29 04:12:42'),
(5, 5, 4.7, 2100, 'emktjREEtLcIuAIF9z892023032774585', 11, 0, 0, '2023-03-29 04:12:42', '2023-03-29 04:12:42'),
(5, 5, 1200, 1, 'emktjREEtLcIuAIF9z892023032774585', 23, 0, 0, '2023-03-29 04:12:42', '2023-03-29 04:12:42'),
(5, 5, 2, 1140, 'm3Gg1pVh2Ss3n4149PSG2023032566445', 3, 0, 1, '2023-03-29 04:13:20', '2023-03-29 04:13:20'),
(5, 5, 8, 880, 'm3Gg1pVh2Ss3n4149PSG2023032566445', 4, 0, 1, '2023-03-29 04:13:20', '2023-03-29 04:13:20'),
(5, 5, 0.44, 17000, 'm3Gg1pVh2Ss3n4149PSG2023032566445', 12, 0, 1, '2023-03-29 04:13:20', '2023-03-29 04:13:20'),
(5, 5, 1.3, 2000, 'm3Gg1pVh2Ss3n4149PSG2023032566445', 8, 0, 1, '2023-03-29 04:13:20', '2023-03-29 04:13:20'),
(5, 5, 0.48, 2080, 'm3Gg1pVh2Ss3n4149PSG2023032566445', 9, 0, 1, '2023-03-29 04:13:20', '2023-03-29 04:13:20'),
(5, 5, 0.94, 2100, 'm3Gg1pVh2Ss3n4149PSG2023032566445', 11, 0, 1, '2023-03-29 04:13:20', '2023-03-29 04:13:20'),
(5, 5, 240, 1, 'm3Gg1pVh2Ss3n4149PSG2023032566445', 23, 0, 1, '2023-03-29 04:13:20', '2023-03-29 04:13:20'),
(7, 1, 2.445, 2650, 'wV3oCBEgfcctyBS8qXye2023061200567', 1, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 1, 19.56, 154, 'wV3oCBEgfcctyBS8qXye2023061200567', 2, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 4, 75, 880, 'wV3oCBEgfcctyBS8qXye2023061200567', 4, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 4, 55, 1450, 'wV3oCBEgfcctyBS8qXye2023061200567', 5, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 5, 50, 1140, 'wV3oCBEgfcctyBS8qXye2023061200567', 3, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 5, 200, 880, 'wV3oCBEgfcctyBS8qXye2023061200567', 4, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 5, 11, 17000, 'wV3oCBEgfcctyBS8qXye2023061200567', 12, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 5, 32.5, 2000, 'wV3oCBEgfcctyBS8qXye2023061200567', 8, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 5, 12, 2080, 'wV3oCBEgfcctyBS8qXye2023061200567', 9, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 5, 23.5, 2100, 'wV3oCBEgfcctyBS8qXye2023061200567', 11, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 5, 6000, 1, 'wV3oCBEgfcctyBS8qXye2023061200567', 23, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 6, 24, 1140, 'wV3oCBEgfcctyBS8qXye2023061200567', 3, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 6, 210, 880, 'wV3oCBEgfcctyBS8qXye2023061200567', 4, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 6, 9.6, 17000, 'wV3oCBEgfcctyBS8qXye2023061200567', 12, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 6, 15.6, 2000, 'wV3oCBEgfcctyBS8qXye2023061200567', 8, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 6, 6.6, 2080, 'wV3oCBEgfcctyBS8qXye2023061200567', 9, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 6, 3.3, 2250, 'wV3oCBEgfcctyBS8qXye2023061200567', 10, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 6, 13.35, 2100, 'wV3oCBEgfcctyBS8qXye2023061200567', 11, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 6, 24, 1140, 'wV3oCBEgfcctyBS8qXye2023061200567', 3, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 6, 210, 880, 'wV3oCBEgfcctyBS8qXye2023061200567', 4, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 6, 9.6, 17000, 'wV3oCBEgfcctyBS8qXye2023061200567', 12, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 6, 15.6, 2000, 'wV3oCBEgfcctyBS8qXye2023061200567', 8, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 6, 6.6, 2080, 'wV3oCBEgfcctyBS8qXye2023061200567', 9, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 6, 3.3, 2250, 'wV3oCBEgfcctyBS8qXye2023061200567', 10, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 6, 13.35, 2100, 'wV3oCBEgfcctyBS8qXye2023061200567', 11, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 7, 24, 1140, 'wV3oCBEgfcctyBS8qXye2023061200567', 3, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 7, 210, 880, 'wV3oCBEgfcctyBS8qXye2023061200567', 4, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 7, 12, 17000, 'wV3oCBEgfcctyBS8qXye2023061200567', 12, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 7, 17.1, 2080, 'wV3oCBEgfcctyBS8qXye2023061200567', 9, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 7, 8.7, 2250, 'wV3oCBEgfcctyBS8qXye2023061200567', 10, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 7, 12.75, 2100, 'wV3oCBEgfcctyBS8qXye2023061200567', 11, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 7, 24, 1140, 'wV3oCBEgfcctyBS8qXye2023061200567', 3, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 7, 210, 880, 'wV3oCBEgfcctyBS8qXye2023061200567', 4, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 7, 12, 17000, 'wV3oCBEgfcctyBS8qXye2023061200567', 12, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 7, 17.1, 2080, 'wV3oCBEgfcctyBS8qXye2023061200567', 9, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 7, 8.7, 2250, 'wV3oCBEgfcctyBS8qXye2023061200567', 10, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 7, 12.75, 2100, 'wV3oCBEgfcctyBS8qXye2023061200567', 11, 0, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(7, 1, 0.815, 2650, '3bRP5AuNEkZYnYrGW2nf2023061890237', 1, 0, 1, '2023-06-20 01:36:15', '2023-06-20 01:36:15'),
(7, 1, 6.52, 154, '3bRP5AuNEkZYnYrGW2nf2023061890237', 2, 0, 1, '2023-06-20 01:36:15', '2023-06-20 01:36:15'),
(7, 4, 30, 880, '3bRP5AuNEkZYnYrGW2nf2023061890237', 4, 0, 1, '2023-06-20 01:36:15', '2023-06-20 01:36:15'),
(7, 4, 22, 1450, '3bRP5AuNEkZYnYrGW2nf2023061890237', 5, 0, 1, '2023-06-20 01:36:15', '2023-06-20 01:36:15'),
(7, 1, 0.815, 5000, 'P4FVRYxW1oVEleCvIsLF2023061167557', 1, 0, 1, '2023-06-20 01:42:22', '2023-06-20 01:42:22'),
(7, 1, 6.52, 154, 'P4FVRYxW1oVEleCvIsLF2023061167557', 2, 0, 1, '2023-06-20 01:42:22', '2023-06-20 01:42:22'),
(1, 1, 0.1956, 26500, 'TlTDiVaTG52gOwrKW7K32023122049471', 1, 0, 0, '2023-12-26 06:26:43', '2023-12-26 06:26:43'),
(1, 1, 1.5648, 154, 'TlTDiVaTG52gOwrKW7K32023122049471', 2, 0, 0, '2023-12-26 06:26:43', '2023-12-26 06:26:43'),
(1, 4, 1.5, 1000, 'TlTDiVaTG52gOwrKW7K32023122049471', 4, 0, 0, '2023-12-26 06:26:43', '2023-12-26 06:26:43'),
(1, 4, 1.1, 1450, 'TlTDiVaTG52gOwrKW7K32023122049471', 5, 0, 0, '2023-12-26 06:26:43', '2023-12-26 06:26:43'),
(3, 1, 0.1956, 2600, 'm8Tr6SunOwGj0KJMxcYz2023122296843', 1, 0, 1, '2023-12-26 06:28:25', '2023-12-26 06:28:25'),
(3, 1, 1.5648, 15, 'm8Tr6SunOwGj0KJMxcYz2023122296843', 2, 0, 1, '2023-12-26 06:28:25', '2023-12-26 06:28:25');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` smallint(6) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_address` varchar(255) NOT NULL,
  `project_city` varchar(255) NOT NULL,
  `project_fiscal_year` date NOT NULL,
  `project_duration` text NOT NULL,
  `project_costestimation` bigint(20) DEFAULT NULL,
  `project_leader_id` smallint(6) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `customer_id`, `project_name`, `project_address`, `project_city`, `project_fiscal_year`, `project_duration`, `project_costestimation`, `project_leader_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Adhikjola Hydro Power Construction', '08 Syajgya Nepal', 'Syanjgya', '2023-03-09', '2 years', 45675674, 1, 1, '2023-03-08 00:30:55', '2023-10-09 00:04:44'),
(2, 1, 'Road PCC', 'Pokhara', 'Pokhara', '2023-03-10', '1 year', 45, 1, 0, '2023-03-09 01:03:40', '2023-03-09 01:03:40'),
(3, 1, 'Pawan House Construction', 'Pokhara', 'Pokhara', '2023-03-11', '1', 8515971, 1, 0, '2023-03-10 05:25:30', '2023-03-10 05:25:30'),
(4, 1, 'Tuki Soft Building', 'Pokhara', 'Pokhara', '2023-03-11', '3', 10000000, 1, 0, '2023-03-10 05:56:55', '2023-03-10 05:56:55'),
(5, 1, 'Pokahra Hotel Building', 'Pokhara', 'Pokhara', '2023-03-30', '4', 5343, 1, 0, '2023-03-29 04:11:59', '2023-03-29 04:11:59'),
(6, 1, 'School Building', 'Pokhara Nepal', 'Pokhara', '2023-06-21', '1 year', 20000000, 1, 0, '2023-06-20 00:53:53', '2023-06-20 00:53:53'),
(7, 1, 'Tuki Soft New Building', 'Pokhara Nepal', 'Pokhara', '2023-06-21', '2 years', 30000000, 1, 0, '2023-06-20 01:23:03', '2023-06-20 01:23:03'),
(8, 1, 'Pawans House Construction', 'Malepatan', 'Pokhara', '2023-10-08', '12 Months', 1000000, 1, 0, '2023-10-08 01:09:12', '2023-10-08 01:09:12'),
(9, 2, 'House Construction', 'Pokhara', 'Pokhara 14 Chauthe', '2023-11-29', '2', 1200000, 2, 0, '2023-11-29 06:21:34', '2023-11-29 06:21:34');

-- --------------------------------------------------------

--
-- Table structure for table `project_activities`
--

CREATE TABLE `project_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` smallint(6) NOT NULL,
  `activities_id` smallint(6) NOT NULL,
  `debit` double NOT NULL,
  `credit` double NOT NULL,
  `cancel` varchar(255) NOT NULL,
  `qty` double NOT NULL,
  `suppliers_id` int(11) NOT NULL,
  `fiscal_year` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `tCode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_estimations`
--

CREATE TABLE `project_estimations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` smallint(6) NOT NULL,
  `activities_id` smallint(6) NOT NULL,
  `suppliers_id` int(11) DEFAULT NULL,
  `quantity_in` float NOT NULL,
  `cancel` varchar(255) NOT NULL,
  `fiscal_year` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `tCode` varchar(255) NOT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `quantity_out` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_estimations`
--

INSERT INTO `project_estimations` (`id`, `project_id`, `activities_id`, `suppliers_id`, `quantity_in`, `cancel`, `fiscal_year`, `status`, `tCode`, `amount`, `quantity_out`, `created_at`, `updated_at`) VALUES
(1, 3, 1, NULL, 2300, '0', '2023-03-10', 0, 'Iy4ICHvLAiB0Z75CDOeU2023023412673', 145536, 0, '2023-03-10 05:48:36', '2023-03-10 05:48:36'),
(2, 3, 2, NULL, 700, '0', '2023-03-10', 0, 'Iy4ICHvLAiB0Z75CDOeU2023023412673', 75272, 0, '2023-03-10 05:48:36', '2023-03-10 05:48:36'),
(3, 3, 3, NULL, 400, '0', '2023-03-10', 0, 'Iy4ICHvLAiB0Z75CDOeU2023023412673', 559680, 0, '2023-03-10 05:48:36', '2023-03-10 05:48:36'),
(4, 3, 4, NULL, 120, '0', '2023-03-10', 0, 'Iy4ICHvLAiB0Z75CDOeU2023023412673', 349800, 0, '2023-03-10 05:48:36', '2023-03-10 05:48:36'),
(5, 3, 5, NULL, 30, '0', '2023-03-10', 0, 'Iy4ICHvLAiB0Z75CDOeU2023023412673', 339186, 0, '2023-03-10 05:48:36', '2023-03-10 05:48:36'),
(6, 3, 6, NULL, 50, '0', '2023-03-10', 0, 'Iy4ICHvLAiB0Z75CDOeU2023023412673', 759580, 0, '2023-03-10 05:48:36', '2023-03-10 05:48:36'),
(7, 3, 7, NULL, 80, '0', '2023-03-10', 0, 'Iy4ICHvLAiB0Z75CDOeU2023023412673', 1328210, 0, '2023-03-10 05:48:36', '2023-03-10 05:48:36'),
(8, 3, 8, NULL, 30, '0', '2023-03-10', 0, 'Iy4ICHvLAiB0Z75CDOeU2023023412673', 495540, 0, '2023-03-10 05:48:36', '2023-03-10 05:48:36'),
(9, 3, 9, NULL, 5000, '0', '2023-03-10', 0, 'Iy4ICHvLAiB0Z75CDOeU2023023412673', 1818550, 0, '2023-03-10 05:48:36', '2023-03-10 05:48:36'),
(10, 3, 10, NULL, 30, '0', '2023-03-10', 0, 'Iy4ICHvLAiB0Z75CDOeU2023023412673', 227042, 0, '2023-03-10 05:48:36', '2023-03-10 05:48:36'),
(11, 3, 11, NULL, 40, '0', '2023-03-10', 0, 'Iy4ICHvLAiB0Z75CDOeU2023023412673', 396000, 0, '2023-03-10 05:48:36', '2023-03-10 05:48:36'),
(12, 3, 12, NULL, 40, '0', '2023-03-10', 0, 'Iy4ICHvLAiB0Z75CDOeU2023023412673', 41590.4, 0, '2023-03-10 05:48:36', '2023-03-10 05:48:36'),
(15, 4, 1, NULL, 2300, '0', '2023-03-10', 0, 'b1FAFM3vscwO5gx389Tg2023025342414', 145536, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(16, 4, 2, NULL, 700, '0', '2023-03-10', 0, 'b1FAFM3vscwO5gx389Tg2023025342414', 75272, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(17, 4, 3, NULL, 400, '0', '2023-03-10', 0, 'b1FAFM3vscwO5gx389Tg2023025342414', 559680, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(18, 4, 4, NULL, 120, '0', '2023-03-10', 0, 'b1FAFM3vscwO5gx389Tg2023025342414', 349800, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(19, 4, 5, NULL, 30, '0', '2023-03-10', 0, 'b1FAFM3vscwO5gx389Tg2023025342414', 339186, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(20, 4, 6, NULL, 50, '0', '2023-03-10', 0, 'b1FAFM3vscwO5gx389Tg2023025342414', 759580, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(21, 4, 7, NULL, 80, '0', '2023-03-10', 0, 'b1FAFM3vscwO5gx389Tg2023025342414', 1328210, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(22, 4, 8, NULL, 30, '0', '2023-03-10', 0, 'b1FAFM3vscwO5gx389Tg2023025342414', 495540, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(23, 4, 9, NULL, 5000, '0', '2023-03-10', 0, 'b1FAFM3vscwO5gx389Tg2023025342414', 1818550, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(24, 4, 10, NULL, 30, '0', '2023-03-10', 0, 'b1FAFM3vscwO5gx389Tg2023025342414', 227042, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(25, 4, 11, NULL, 40, '0', '2023-03-10', 0, 'b1FAFM3vscwO5gx389Tg2023025342414', 396000, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(26, 4, 12, NULL, 40, '0', '2023-03-10', 0, 'b1FAFM3vscwO5gx389Tg2023025342414', 41590.4, 0, '2023-03-10 06:35:32', '2023-03-10 06:35:32'),
(27, 4, 1, NULL, 0, '1', '2023-03-10', 0, 'YGUP9QlmKtILoW2fiKMm2023029429124', 11369500, 1000, '2023-03-10 09:40:28', '2023-03-10 11:11:03'),
(28, 4, 2, NULL, 0, '1', '2023-03-10', 0, 'YGUP9QlmKtILoW2fiKMm2023029429124', 21506.3, 200, '2023-03-10 09:40:28', '2023-03-10 11:11:03'),
(29, 4, 5, NULL, 0, '1', '2023-03-10', 0, 'YGUP9QlmKtILoW2fiKMm2023029429124', 113062, 10, '2023-03-10 09:40:28', '2023-03-10 11:11:03'),
(30, 4, 1, NULL, 0, '1', '2023-03-10', 0, 'YGUP9QlmKtILoW2fiKMm2023029429124', 11369500, 1000, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(31, 4, 2, NULL, 0, '1', '2023-03-10', 0, 'YGUP9QlmKtILoW2fiKMm2023029429124', 21506.3, 200, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(32, 4, 5, NULL, 0, '1', '2023-03-10', 0, 'YGUP9QlmKtILoW2fiKMm2023029429124', 113062, 10, '2023-03-10 09:49:13', '2023-03-10 11:11:03'),
(33, 4, 1, NULL, 0, '1', '2023-03-10', 0, 'YGUP9QlmKtILoW2fiKMm2023029429124', 11369500, 1000, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(34, 4, 2, NULL, 0, '1', '2023-03-10', 0, 'YGUP9QlmKtILoW2fiKMm2023029429124', 21506.3, 200, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(35, 4, 5, NULL, 0, '1', '2023-03-10', 0, 'YGUP9QlmKtILoW2fiKMm2023029429124', 113062, 10, '2023-03-10 09:54:50', '2023-03-10 11:11:03'),
(36, 4, 5, NULL, 0, '0', '2023-03-10', 0, 'YGUP9QlmKtILoW2fiKMm2023029429124', 113062, 10, '2023-03-10 11:11:03', '2023-03-10 11:11:03'),
(37, 4, 1, NULL, 0, '0', '2023-03-10', 0, 'YGUP9QlmKtILoW2fiKMm2023029429124', 63276.6, 1000, '2023-03-10 11:11:03', '2023-03-10 11:11:03'),
(38, 4, 2, NULL, 0, '0', '2023-03-10', 0, 'YGUP9QlmKtILoW2fiKMm2023029429124', 53765.7, 500, '2023-03-10 11:11:03', '2023-03-10 11:11:03'),
(39, 5, 5, NULL, 10, '0', '2023-03-29', 0, 'emktjREEtLcIuAIF9z892023032774585', 113062, 0, '2023-03-29 04:12:42', '2023-03-29 04:12:42'),
(40, 5, 5, NULL, 0, '0', '2023-03-29', 0, 'm3Gg1pVh2Ss3n4149PSG2023032566445', 22612.4, 2, '2023-03-29 04:13:20', '2023-03-29 04:13:20'),
(41, 7, 1, NULL, 150, '0', '2023-06-20', 0, 'wV3oCBEgfcctyBS8qXye2023061200567', 9491.49, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(42, 7, 4, NULL, 50, '0', '2023-06-20', 0, 'wV3oCBEgfcctyBS8qXye2023061200567', 145750, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(43, 7, 5, NULL, 50, '0', '2023-06-20', 0, 'wV3oCBEgfcctyBS8qXye2023061200567', 565310, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(44, 7, 6, NULL, 30, '0', '2023-06-20', 0, 'wV3oCBEgfcctyBS8qXye2023061200567', 455748, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(45, 7, 7, NULL, 30, '0', '2023-06-20', 0, 'wV3oCBEgfcctyBS8qXye2023061200567', 498078, 0, '2023-06-20 01:33:42', '2023-06-20 01:33:42'),
(46, 7, 1, NULL, 0, '0', '2023-06-20', 0, '3bRP5AuNEkZYnYrGW2nf2023061890237', 3163.83, 50, '2023-06-20 01:36:14', '2023-06-20 01:36:14'),
(47, 7, 4, NULL, 0, '0', '2023-06-20', 0, '3bRP5AuNEkZYnYrGW2nf2023061890237', 58300, 20, '2023-06-20 01:36:15', '2023-06-20 01:36:15'),
(48, 7, 1, NULL, 0, '0', '2023-06-20', 0, 'P4FVRYxW1oVEleCvIsLF2023061167557', 5079.08, 50, '2023-06-20 01:42:22', '2023-06-20 01:42:22'),
(49, 1, 1, NULL, 12, '0', '2023-12-26', 0, 'TlTDiVaTG52gOwrKW7K32023122049471', 5424.38, 0, '2023-12-26 06:26:43', '2023-12-26 06:26:43'),
(50, 1, 4, NULL, 1, '0', '2023-12-26', 0, 'TlTDiVaTG52gOwrKW7K32023122049471', 3095, 0, '2023-12-26 06:26:43', '2023-12-26 06:26:43'),
(51, 3, 1, NULL, 0, '0', '2023-12-26', 0, 'm8Tr6SunOwGj0KJMxcYz2023122296843', 532.032, 12, '2023-12-26 06:28:25', '2023-12-26 06:28:25');

-- --------------------------------------------------------

--
-- Table structure for table `project_leaders`
--

CREATE TABLE `project_leaders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_leader_name` varchar(255) NOT NULL,
  `project_leader_mobilenumber` bigint(20) NOT NULL,
  `project_leader_address` varchar(255) NOT NULL,
  `project_leader_profession` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_leaders`
--

INSERT INTO `project_leaders` (`id`, `project_leader_name`, `project_leader_mobilenumber`, `project_leader_address`, `project_leader_profession`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Er. Pawan Gautam', 9846513373, 'Srijanachowk 08', 'Engineer', 0, '2023-03-08 00:29:25', '2023-03-08 00:29:25'),
(2, 'Ananda Dhital', 9846921808, 'Pokhara 14 Chauthe', 'Engineer', 0, '2023-11-29 06:20:05', '2023-11-29 06:20:05');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_records`
--

CREATE TABLE `purchase_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Sid` text NOT NULL,
  `transactionCode` text NOT NULL,
  `cancel` bigint(20) NOT NULL DEFAULT 0,
  `modOfPayment` text NOT NULL,
  `partyBillNo` int(11) DEFAULT NULL,
  `userId` bigint(20) DEFAULT NULL,
  `discount` double(8,2) NOT NULL,
  `quantity` float NOT NULL,
  `vat` double(8,2) NOT NULL,
  `date` date NOT NULL,
  `gtotal` double(8,2) NOT NULL,
  `accNo` text DEFAULT NULL,
  `paymentNote` text DEFAULT NULL,
  `taxable` double(8,2) NOT NULL,
  `nontaxable` double(8,2) NOT NULL,
  `cancelation_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_records`
--

INSERT INTO `purchase_records` (`id`, `Sid`, `transactionCode`, `cancel`, `modOfPayment`, `partyBillNo`, `userId`, `discount`, `quantity`, `vat`, `date`, `gtotal`, `accNo`, `paymentNote`, `taxable`, `nontaxable`, `cancelation_note`, `created_at`, `updated_at`) VALUES
(1, '1', 'gkdDrr1OdGGJo1GoM4v5202310142344', 0, '1', 1021, NULL, 1.00, 11, 1625.00, '2023-10-16', 14125.00, NULL, NULL, 1.00, 1.00, NULL, '2023-10-16 00:07:58', '2023-10-16 00:07:58');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_record_returns`
--

CREATE TABLE `purchase_record_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` text NOT NULL,
  `transactionCode` text NOT NULL,
  `date` date NOT NULL,
  `cancel` bigint(20) NOT NULL DEFAULT 0,
  `modOfPayment` text NOT NULL,
  `partyBillNo` text DEFAULT NULL,
  `userId` bigint(20) DEFAULT NULL,
  `discount` double(8,2) NOT NULL,
  `vat` double(8,2) NOT NULL,
  `gtotal` double(8,2) NOT NULL,
  `accNo` text DEFAULT NULL,
  `quantity` float NOT NULL,
  `paymentNote` text DEFAULT NULL,
  `taxable` double(8,2) NOT NULL,
  `nontaxable` double(8,2) NOT NULL,
  `cr_notenumber` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cancellation_note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_record_returns`
--

INSERT INTO `purchase_record_returns` (`id`, `project_id`, `transactionCode`, `date`, `cancel`, `modOfPayment`, `partyBillNo`, `userId`, `discount`, `vat`, `gtotal`, `accNo`, `quantity`, `paymentNote`, `taxable`, `nontaxable`, `cr_notenumber`, `created_at`, `updated_at`, `cancellation_note`) VALUES
(1, '1', 'pC2JjQtEGjD1VEzcIO7v202310079558', '2023-10-16', 0, '1', '1021', NULL, 1.00, 585.00, 5085.00, NULL, 10, NULL, 1.00, 1.00, NULL, '2023-10-16 00:08:33', '2023-10-16 00:08:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `secondary_inventory_store`
--

CREATE TABLE `secondary_inventory_store` (
  `inventoryID` varchar(255) NOT NULL,
  `instock` double(8,2) NOT NULL,
  `outstock` double(8,2) NOT NULL,
  `tCode` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `unit_cost_rate` float NOT NULL DEFAULT 0,
  `vat` double(8,2) NOT NULL,
  `unitEqualsTo` text NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cancel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `secondary_inventory_store`
--

INSERT INTO `secondary_inventory_store` (`inventoryID`, `instock`, `outstock`, `tCode`, `status`, `unit_cost_rate`, `vat`, `unitEqualsTo`, `amount`, `created_at`, `updated_at`, `cancel`) VALUES
('25', 12.00, 0.00, '18c9nAZEyLWelNJLN3jH202309125898', 'issue', 450, 702.00, 'bottle', 5400.00, '2023-09-21 05:13:10', '2023-09-21 05:13:10', 1),
('25', 0.00, 10.00, 'ViYMcn9SYFOrwZ8VcIGS202309194137', 'issuereturn', 450, 585.00, 'bottle', 4500.00, '2023-09-21 05:22:23', '2023-09-21 05:22:23', 1),
('26', 0.00, 9000.00, 'ViYMcn9SYFOrwZ8VcIGS202309194137', 'issuereturn', 8000, 12480.00, 'bottle', 96000.00, '2023-09-21 05:22:23', '2023-09-21 05:22:23', 1),
('25', 12.00, 0.00, 'ufNNfzo0IMJnAKUbq1qn202309136202', 'issue', 450, 702.00, 'bottle', 5400.00, '2023-09-21 05:42:56', '2023-09-21 05:42:56', 0),
('25', 12.00, 0.00, 'UsugS9LtzKpZ4Moag1dw202309770453', 'issue', 450, 702.00, 'bottle', 5400.00, '2023-10-09 03:16:05', '2023-10-09 03:16:05', 0),
('26', 750.00, 0.00, 'UsugS9LtzKpZ4Moag1dw202309770453', 'issue', 8000, 1040.00, 'bottle', 8000.00, '2023-10-09 03:16:05', '2023-10-09 03:16:05', 0),
('25', 12.00, 0.00, 'YQHMa4lQlcp2eIIfqJ7X202309550051', 'issue', 450, 702.00, 'bottle', 5400.00, '2023-10-09 03:17:32', '2023-10-09 03:17:32', 0),
('26', 750.00, 0.00, 'YQHMa4lQlcp2eIIfqJ7X202309550051', 'issue', 8000, 1040.00, 'bottle', 8000.00, '2023-10-09 03:17:32', '2023-10-09 03:17:32', 0),
('25', 12.00, 0.00, '6BAWK6QYVBT7f9VA9ACz202309799184', 'issue', 450, 702.00, 'bottle', 5400.00, '2023-10-09 03:17:56', '2023-10-09 03:17:56', 1),
('26', 750.00, 0.00, '6BAWK6QYVBT7f9VA9ACz202309799184', 'issue', 8000, 1040.00, 'bottle', 8000.00, '2023-10-09 03:17:56', '2023-10-09 03:17:56', 1),
('25', 0.00, 12.00, 'fpJ1eeJmIafsNNzKONwY202309555007', 'issuereturn', 450, 702.00, 'bottle', 5400.00, '2023-10-09 04:36:21', '2023-10-09 04:36:21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `secondary_records`
--

CREATE TABLE `secondary_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transactionCode` text NOT NULL,
  `project_id` int(11) NOT NULL,
  `cancel` bigint(20) NOT NULL DEFAULT 0,
  `userId` bigint(20) DEFAULT NULL,
  `discount` double(8,2) NOT NULL,
  `vat` double(8,2) NOT NULL,
  `gtotal` double(8,2) NOT NULL,
  `quantity` float NOT NULL,
  `date` date NOT NULL,
  `status` text DEFAULT NULL,
  `cancelation_note` text DEFAULT NULL,
  `demand_sheet_number` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `service_rate` double NOT NULL,
  `service_category_id` smallint(6) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name`, `service_rate`, `service_category_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Base Digging', 1200, 1, 0, '2023-11-29 06:19:11', '2023-11-29 06:19:11');

-- --------------------------------------------------------

--
-- Table structure for table `service_billing_amounts`
--

CREATE TABLE `service_billing_amounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tCode` varchar(255) NOT NULL,
  `totalamount` double NOT NULL,
  `discount` double DEFAULT NULL,
  `alltotalamount` double NOT NULL,
  `cancel` varchar(255) NOT NULL DEFAULT '0',
  `billDate` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `customer_id` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_billing_amounts`
--

INSERT INTO `service_billing_amounts` (`id`, `tCode`, `totalamount`, `discount`, `alltotalamount`, `cancel`, `billDate`, `status`, `customer_id`, `created_at`, `updated_at`) VALUES
(1, 'HnRHiJOiGUDFeJMLLwrk202311192565', 1200, 200, 1000, '0', '2023-11-29', 0, 2, '2023-11-29 06:22:21', '2023-11-29 06:22:21');

-- --------------------------------------------------------

--
-- Table structure for table `service_bill_items`
--

CREATE TABLE `service_bill_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` smallint(6) NOT NULL,
  `quantity` double NOT NULL,
  `service_rate` double NOT NULL,
  `tCode` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_bill_items`
--

INSERT INTO `service_bill_items` (`id`, `service_id`, `quantity`, `service_rate`, `tCode`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1200, 'HnRHiJOiGUDFeJMLLwrk202311192565', 0, '2023-11-29 06:22:21', '2023-11-29 06:22:21');

-- --------------------------------------------------------

--
-- Table structure for table `service_catagories`
--

CREATE TABLE `service_catagories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_catagory_name` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_catagories`
--

INSERT INTO `service_catagories` (`id`, `service_catagory_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Service Category', 0, '2023-11-29 06:18:56', '2023-11-29 06:18:56');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `staff_name` varchar(255) NOT NULL,
  `staff_address` varchar(255) NOT NULL,
  `staff_email` varchar(255) DEFAULT NULL,
  `staff_phonenumber` bigint(20) NOT NULL,
  `staff_position` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL,
  `staff_profession` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_activities`
--

CREATE TABLE `sub_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `activity_id` bigint(20) NOT NULL,
  `rate` float NOT NULL,
  `qty` float NOT NULL,
  `status` int(11) DEFAULT NULL,
  `itemId` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_activities`
--

INSERT INTO `sub_activities` (`id`, `activity_id`, `rate`, `qty`, `status`, `itemId`, `created_at`, `updated_at`) VALUES
(1, 1, 2650, 0.0163, NULL, 1, '2023-03-10 04:49:34', '2023-03-10 04:49:34'),
(2, 1, 154, 0.1304, NULL, 2, '2023-03-10 04:49:34', '2023-03-10 04:49:34'),
(3, 2, 2650, 0.0277, NULL, 1, '2023-03-10 04:51:33', '2023-03-10 04:51:33'),
(4, 2, 154, 0.2216, NULL, 2, '2023-03-10 04:51:33', '2023-03-10 04:51:33'),
(5, 3, 880, 1.59, NULL, 4, '2023-03-10 04:52:32', '2023-03-10 04:52:32'),
(6, 4, 880, 1.5, NULL, 4, '2023-03-10 04:53:26', '2023-03-10 04:53:26'),
(7, 4, 1450, 1.1, NULL, 5, '2023-03-10 04:53:26', '2023-03-10 04:53:26'),
(8, 5, 1140, 1, NULL, 3, '2023-03-10 04:56:49', '2023-03-10 04:56:49'),
(9, 5, 880, 4, NULL, 4, '2023-03-10 04:56:49', '2023-03-10 04:56:49'),
(10, 5, 17000, 0.22, NULL, 12, '2023-03-10 04:56:49', '2023-03-10 04:56:49'),
(11, 5, 2000, 0.65, NULL, 8, '2023-03-10 04:56:49', '2023-03-10 04:56:49'),
(12, 5, 2080, 0.24, NULL, 9, '2023-03-10 04:56:49', '2023-03-10 04:56:49'),
(13, 5, 2100, 0.47, NULL, 11, '2023-03-10 04:56:49', '2023-03-10 04:56:49'),
(14, 5, 1, 120, NULL, 23, '2023-03-10 04:56:49', '2023-03-10 04:56:49'),
(15, 6, 1140, 0.8, NULL, 3, '2023-03-10 04:59:33', '2023-03-10 04:59:33'),
(16, 6, 880, 7, NULL, 4, '2023-03-10 04:59:33', '2023-03-10 04:59:33'),
(17, 6, 17000, 0.32, NULL, 12, '2023-03-10 04:59:33', '2023-03-10 04:59:33'),
(18, 6, 2000, 0.52, NULL, 8, '2023-03-10 04:59:33', '2023-03-10 04:59:33'),
(19, 6, 2080, 0.22, NULL, 9, '2023-03-10 04:59:33', '2023-03-10 04:59:33'),
(20, 6, 2250, 0.11, NULL, 10, '2023-03-10 04:59:33', '2023-03-10 04:59:33'),
(21, 6, 2100, 0.445, NULL, 11, '2023-03-10 04:59:33', '2023-03-10 04:59:33'),
(22, 7, 1140, 0.8, NULL, 3, '2023-03-10 05:01:43', '2023-03-10 05:01:43'),
(23, 7, 880, 7, NULL, 4, '2023-03-10 05:01:43', '2023-03-10 05:01:43'),
(24, 7, 17000, 0.4, NULL, 12, '2023-03-10 05:01:43', '2023-03-10 05:01:43'),
(25, 7, 2080, 0.57, NULL, 9, '2023-03-10 05:01:43', '2023-03-10 05:01:43'),
(26, 7, 2250, 0.29, NULL, 10, '2023-03-10 05:01:43', '2023-03-10 05:01:43'),
(27, 7, 2100, 0.425, NULL, 11, '2023-03-10 05:01:43', '2023-03-10 05:01:43'),
(28, 8, 1140, 1.5, NULL, 3, '2023-03-10 05:04:00', '2023-03-10 05:04:00'),
(29, 8, 880, 2.2, NULL, 4, '2023-03-10 05:04:00', '2023-03-10 05:04:00'),
(30, 8, 17000, 0.1, NULL, 12, '2023-03-10 05:04:00', '2023-03-10 05:04:00'),
(31, 8, 18.9, 560, NULL, 14, '2023-03-10 05:04:00', '2023-03-10 05:04:00'),
(32, 8, 2100, 0.28, NULL, 11, '2023-03-10 05:04:00', '2023-03-10 05:04:00'),
(33, 9, 1140, 0.12, NULL, 3, '2023-03-10 05:06:58', '2023-03-10 05:06:58'),
(34, 9, 880, 0.16, NULL, 4, '2023-03-10 05:06:58', '2023-03-10 05:06:58'),
(35, 9, 15000, 0.00382, NULL, 13, '2023-03-10 05:06:58', '2023-03-10 05:06:58'),
(36, 9, 1835, 0.0157, NULL, 7, '2023-03-10 05:06:58', '2023-03-10 05:06:58'),
(37, 10, 1140, 4.7, NULL, 3, '2023-03-10 05:14:31', '2023-03-10 05:14:31'),
(38, 10, 880, 0.47, NULL, 4, '2023-03-10 05:14:31', '2023-03-10 05:14:31'),
(39, 10, 39000, 0.0397, NULL, 15, '2023-03-10 05:14:31', '2023-03-10 05:14:31'),
(40, 10, 36, 2.84, NULL, 18, '2023-03-10 05:14:31', '2023-03-10 05:14:31'),
(41, 10, 180, 0.473, NULL, 21, '2023-03-10 05:14:31', '2023-03-10 05:14:31'),
(42, 10, 73, 0.47, NULL, 19, '2023-03-10 05:14:31', '2023-03-10 05:14:31'),
(43, 10, 28, 0.946, NULL, 24, '2023-03-10 05:14:31', '2023-03-10 05:14:31'),
(44, 11, 1140, 4.03, NULL, 3, '2023-03-10 05:19:20', '2023-03-10 05:19:20'),
(45, 11, 880, 0.403, NULL, 4, '2023-03-10 05:19:20', '2023-03-10 05:19:20'),
(46, 11, 200000, 0.022, NULL, 16, '2023-03-10 05:19:20', '2023-03-10 05:19:20'),
(47, 11, 25, 3.58, NULL, 17, '2023-03-10 05:19:20', '2023-03-10 05:19:20'),
(48, 11, 54, 1.79, NULL, 19, '2023-03-10 05:19:20', '2023-03-10 05:19:20'),
(49, 11, 28, 0.896, NULL, 24, '2023-03-10 05:19:20', '2023-03-10 05:19:20'),
(50, 11, 699.4, 0.486, NULL, 22, '2023-03-10 05:19:20', '2023-03-10 05:19:20'),
(51, 12, 1140, 0.06, NULL, 3, '2023-03-10 05:24:08', '2023-03-10 05:24:08'),
(52, 12, 880, 0.006, NULL, 4, '2023-03-10 05:24:08', '2023-03-10 05:24:08'),
(53, 12, 65.6, 4.05, NULL, 25, '2023-03-10 05:24:08', '2023-03-10 05:24:08'),
(54, 12, 699.4, 1, NULL, 22, '2023-03-10 05:24:08', '2023-03-10 05:24:08'),
(55, 12, 50, 0.02, NULL, 20, '2023-03-10 05:24:08', '2023-03-10 05:24:08'),
(56, 13, 880, 1.59, NULL, 4, '2023-06-20 01:03:17', '2023-06-20 01:03:17'),
(57, 14, 1140, 1.5, NULL, 3, '2023-06-20 01:29:04', '2023-06-20 01:29:04'),
(58, 14, 880, 5, NULL, 4, '2023-06-20 01:29:04', '2023-06-20 01:29:04'),
(59, 14, 17000, 0.106, NULL, 12, '2023-06-20 01:29:04', '2023-06-20 01:29:04'),
(60, 14, 1450, 1.1, NULL, 5, '2023-06-20 01:29:04', '2023-06-20 01:29:04'),
(61, 14, 2100, 0.47, NULL, 11, '2023-06-20 01:29:04', '2023-06-20 01:29:04'),
(62, 14, 2, 70, NULL, 23, '2023-06-20 01:29:04', '2023-06-20 01:29:04'),
(63, 15, 1200, 1, NULL, 3, '2023-10-08 01:15:14', '2023-10-08 01:15:14'),
(64, 15, 800, 4, NULL, 4, '2023-10-08 01:15:14', '2023-10-08 01:15:14'),
(65, 15, 2350, 0.47, NULL, 11, '2023-10-08 01:15:14', '2023-10-08 01:15:14'),
(66, 15, 1850, 0.65, NULL, 8, '2023-10-08 01:15:14', '2023-10-08 01:15:14'),
(67, 16, 1050, 1.5, NULL, 3, '2023-10-08 01:17:18', '2023-10-08 01:17:18'),
(68, 16, 740, 2.2, NULL, 4, '2023-10-08 01:17:18', '2023-10-08 01:17:18');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact_number` bigint(20) NOT NULL,
  `email` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `fullname`, `address`, `contact_number`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Ananda Dhital', 'Pokhara 14 Chauthe', 9846921808, 'anddhital@gmail.com', '2023-10-08 02:16:06', '2023-10-08 02:16:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_catagories`
--
ALTER TABLE `activity_catagories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_users`
--
ALTER TABLE `add_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment_catagories`
--
ALTER TABLE `equipment_catagories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses_from_equipment`
--
ALTER TABLE `expenses_from_equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses_staff`
--
ALTER TABLE `expenses_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `income_from_equipment`
--
ALTER TABLE `income_from_equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_categories`
--
ALTER TABLE `item_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_settings`
--
ALTER TABLE `item_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nepali_currancy_formats`
--
ALTER TABLE `nepali_currancy_formats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_activities`
--
ALTER TABLE `project_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_estimations`
--
ALTER TABLE `project_estimations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_leaders`
--
ALTER TABLE `project_leaders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_records`
--
ALTER TABLE `purchase_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_record_returns`
--
ALTER TABLE `purchase_record_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `secondary_records`
--
ALTER TABLE `secondary_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_billing_amounts`
--
ALTER TABLE `service_billing_amounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_bill_items`
--
ALTER TABLE `service_bill_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_catagories`
--
ALTER TABLE `service_catagories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_activities`
--
ALTER TABLE `sub_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `activity_catagories`
--
ALTER TABLE `activity_catagories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `add_users`
--
ALTER TABLE `add_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipment_catagories`
--
ALTER TABLE `equipment_catagories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses_from_equipment`
--
ALTER TABLE `expenses_from_equipment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses_staff`
--
ALTER TABLE `expenses_staff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `income_from_equipment`
--
ALTER TABLE `income_from_equipment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `item_settings`
--
ALTER TABLE `item_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `nepali_currancy_formats`
--
ALTER TABLE `nepali_currancy_formats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `project_activities`
--
ALTER TABLE `project_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_estimations`
--
ALTER TABLE `project_estimations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `project_leaders`
--
ALTER TABLE `project_leaders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_records`
--
ALTER TABLE `purchase_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_record_returns`
--
ALTER TABLE `purchase_record_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `secondary_records`
--
ALTER TABLE `secondary_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service_billing_amounts`
--
ALTER TABLE `service_billing_amounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service_bill_items`
--
ALTER TABLE `service_bill_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service_catagories`
--
ALTER TABLE `service_catagories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_activities`
--
ALTER TABLE `sub_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
