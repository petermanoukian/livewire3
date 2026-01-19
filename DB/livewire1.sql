-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 19, 2026 at 07:02 PM
-- Server version: 5.7.40
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `livewire1`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1768843093;', 1768843093),
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab', 'i:2;', 1768843093);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cats`
--

DROP TABLE IF EXISTS `cats`;
CREATE TABLE IF NOT EXISTS `cats` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `des` text COLLATE utf8mb4_unicode_ci,
  `dess` longtext COLLATE utf8mb4_unicode_ci,
  `filer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cats_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cats`
--

INSERT INTO `cats` (`id`, `name`, `des`, `dess`, `filer`, `img`, `img2`, `created_at`, `updated_at`) VALUES
(2, 'categoryu54554', 'uiuiu', 'uuiuy', 'uploads/cats/files/categoryu54554_6969199e43b82.pdf', 'uploads/cats/img/categoryu54554-1768495517_6969199db82f5.jpg', 'uploads/cats/img/thumb/categoryu54554-1768495517_6969199db82f5.jpg', '2026-01-15 12:45:18', '2026-01-15 12:45:18'),
(3, 'category3', '', '', NULL, NULL, NULL, '2026-01-15 12:46:58', '2026-01-15 12:46:58'),
(4, 'cat555', '554', '55445', 'uploads/cats/files/cat555_69691acc606c7.pdf', 'uploads/cats/img/cat555-1768495820_69691acc0f44e.jpg', 'uploads/cats/img/thumb/cat555-1768495820_69691acc0f44e.jpg', '2026-01-15 12:50:20', '2026-01-15 12:50:20'),
(5, 'cat444', 'gf', 'hghgf', NULL, NULL, NULL, '2026-01-15 13:16:29', '2026-01-15 13:16:29'),
(6, 'cat555h', 'hghg', 'hghgfh', 'uploads/cats/files/cat555h_696920fb2e3d8.jpg', NULL, NULL, '2026-01-15 13:16:43', '2026-01-15 13:16:43'),
(7, 'cat6', '', '', NULL, NULL, NULL, '2026-01-15 13:31:02', '2026-01-15 13:31:02'),
(8, 'cat8', 'kjkj', '', NULL, NULL, NULL, '2026-01-15 13:33:01', '2026-01-15 13:33:01'),
(9, 'cat9', '', '', NULL, NULL, NULL, '2026-01-15 13:33:11', '2026-01-15 13:33:11'),
(10, 'cat10', '', '', NULL, NULL, NULL, '2026-01-15 13:33:21', '2026-01-15 13:33:21'),
(11, 'ggfgfg', 'gffdd', '', NULL, NULL, NULL, '2026-01-15 13:33:49', '2026-01-15 13:33:49'),
(15, 'new cat numb11', 'ggf', 'gfgfg', NULL, 'uploads/cats/img/new-cat-numb11-1768592072_696a92c89f9d9.jfif', 'uploads/cats/img/thumb/new-cat-numb11-1768592072_696a92c89f9d9.jfif', '2026-01-16 15:34:33', '2026-01-16 15:34:33'),
(16, '5ty5567', '77677', '76776', NULL, NULL, NULL, '2026-01-16 15:34:51', '2026-01-16 15:34:51'),
(18, 'new34tr', 'uyuy', 'uyuy', 'uploads/cats/files/new34tr_696a93a6a6206.pdf', 'uploads/cats/img/new34tr-1768592293_696a93a5dfcd2.jpg', 'uploads/cats/img/thumb/new34tr-1768592293_696a93a5dfcd2.jpg', '2026-01-16 15:38:14', '2026-01-16 15:38:14'),
(19, 'nbew6778', 'lkl', 'lklk', 'uploads/cats/files/nbew6778_696b3d04b84bd.pdf', 'uploads/cats/img/nbew6778-1768635652_696b3d04532c9.jpg', 'uploads/cats/img/thumb/nbew6778-1768635652_696b3d04532c9.jpg', '2026-01-17 03:40:52', '2026-01-17 03:40:52'),
(20, 'this si the updateddd', 'hhghh upd des 1', 'ghg large des', 'uploads/cats/files/number-20-updatedddd_696b4097bf3fa.pdf', NULL, 'uploads/cats/img/thumb/number-20-updatedddd-1768636253_696b3f5d1ff77.jpg', '2026-01-17 03:41:17', '2026-01-17 03:56:30'),
(21, 'wih imger and filerer', 'uyu', 'uyuy', 'uploads/cats/files/wih-imger-and-filerer_696b4d22746d9.docx', NULL, 'uploads/cats/img/thumb/wih-imger-and-filerer-1768639790_696b4d2e6d906.jfif', '2026-01-17 04:49:38', '2026-01-17 07:32:53'),
(22, 'ytr', 'uyuyuyt', '', NULL, NULL, NULL, '2026-01-17 04:51:38', '2026-01-17 04:51:38'),
(23, 'uuy', 'uyuy', '', NULL, NULL, NULL, '2026-01-17 04:52:20', '2026-01-17 04:52:20'),
(24, 'tytyt', 'yrt', '', NULL, NULL, NULL, '2026-01-17 04:52:32', '2026-01-17 04:52:32'),
(25, 'iuiu', 'i', '', NULL, NULL, NULL, '2026-01-17 04:54:00', '2026-01-17 04:54:00'),
(26, 'cat13', 'jjjhjhgj', 'uut', 'uploads/cats/files/cat13_696b4ef13e019.pdf', 'uploads/cats/img/cat13-1768640240_696b4ef0f257a.jfif', 'uploads/cats/img/thumb/cat13-1768640240_696b4ef0f257a.jfif', '2026-01-17 04:57:21', '2026-01-17 04:57:21'),
(27, 'with formaterrdd', 'jhjh', '<div><strong><del>jhjhjhg</del></strong></div>', 'uploads/cats/files/with-formaterrdd_696b4fcbe3582.jpg', 'uploads/cats/img/with-formaterrdd-1768640459_696b4fcba30f1.jfif', 'uploads/cats/img/thumb/with-formaterrdd-1768640459_696b4fcba30f1.jfif', '2026-01-17 05:00:59', '2026-01-17 05:00:59'),
(28, 'cat1', 'ytytyrt', '', NULL, NULL, NULL, '2026-01-17 08:33:39', '2026-01-17 08:34:11'),
(29, 'cat2', '', '', NULL, NULL, NULL, '2026-01-17 08:33:53', '2026-01-17 08:33:53'),
(30, 'cat3', '', '', NULL, NULL, NULL, '2026-01-17 08:54:43', '2026-01-17 08:54:43'),
(31, 'cat14', '', '', NULL, NULL, NULL, '2026-01-17 08:56:22', '2026-01-17 09:04:31'),
(32, 'cat16', '', '', NULL, NULL, NULL, '2026-01-17 09:04:16', '2026-01-17 09:04:16'),
(33, 'cat15', '', '', NULL, NULL, NULL, '2026-01-17 09:05:41', '2026-01-17 09:05:41'),
(34, 'cat17', 'tytty', '<div>yytr</div>', NULL, NULL, NULL, '2026-01-17 09:25:24', '2026-01-17 09:25:24'),
(35, 'cat18', '', '', NULL, NULL, NULL, '2026-01-17 09:30:26', '2026-01-17 09:30:26'),
(36, 'ytytty', '', '', NULL, NULL, NULL, '2026-01-17 09:32:12', '2026-01-17 09:32:12'),
(37, 'fromn inlkineee updddd', 'hhgghhhg', '', NULL, NULL, NULL, '2026-01-18 03:05:41', '2026-01-18 04:34:33'),
(38, 'tytryty yuuyutuy', 'tytty', '', NULL, NULL, NULL, '2026-01-18 04:28:06', '2026-01-18 04:28:32'),
(39, 'ytyyt', 'ytrytrytr', '', NULL, NULL, NULL, '2026-01-18 04:34:58', '2026-01-18 04:34:58'),
(40, 'tyytyy yty yy', 'ytyt yyty yyyuuuu', '', NULL, NULL, NULL, '2026-01-18 04:38:21', '2026-01-18 04:44:01'),
(41, 'rtrttr', 'et', '<div>yrttytr</div>', NULL, NULL, NULL, '2026-01-18 04:42:12', '2026-01-18 04:44:11'),
(42, 'rtrrtr r ttyy', 'trrttr  rgere', '', NULL, NULL, NULL, '2026-01-18 04:43:25', '2026-01-18 04:48:48'),
(43, 'rrerew', '', '', NULL, NULL, NULL, '2026-01-18 04:44:49', '2026-01-18 04:44:49'),
(44, 'rtrtrt', 'trttre', '', NULL, NULL, NULL, '2026-01-18 04:48:30', '2026-01-18 04:48:30'),
(45, 'tyyt', 'yy', '', NULL, NULL, NULL, '2026-01-18 04:49:43', '2026-01-18 04:49:43'),
(46, 'rrerreerre', '', '', NULL, NULL, NULL, '2026-01-18 04:55:05', '2026-01-18 04:55:05'),
(47, 'yytty', '', '<div><strong>ttrrt</strong></div>', NULL, NULL, NULL, '2026-01-18 04:55:35', '2026-01-18 04:55:35'),
(48, 'ytytytr', '', '', NULL, NULL, NULL, '2026-01-18 04:55:48', '2026-01-18 04:55:48'),
(49, 'rrere', '', '', NULL, NULL, NULL, '2026-01-18 05:01:04', '2026-01-18 05:01:04'),
(50, 'trtrt', '', '', NULL, NULL, NULL, '2026-01-18 05:02:33', '2026-01-18 05:02:33'),
(51, 'fgfgf upd2222', '', '', NULL, NULL, NULL, '2026-01-18 05:03:30', '2026-01-18 05:07:40'),
(52, 'trtre upddd111', '', '', NULL, NULL, NULL, '2026-01-18 05:04:20', '2026-01-18 05:07:31'),
(53, 'new cat3333', '', '', NULL, NULL, NULL, '2026-01-18 05:10:20', '2026-01-18 05:10:20'),
(54, 'erere', '', '', NULL, NULL, NULL, '2026-01-18 05:11:12', '2026-01-18 05:11:12'),
(55, 'ghghgf', '', '', NULL, NULL, NULL, '2026-01-18 05:14:12', '2026-01-18 05:14:12'),
(56, 'ffdffddf', '', '', NULL, NULL, NULL, '2026-01-18 05:34:24', '2026-01-18 05:34:24'),
(57, 'num5 upddd', '', '', NULL, NULL, NULL, '2026-01-18 05:35:43', '2026-01-18 05:35:54'),
(58, 'num6', '', '', NULL, NULL, NULL, '2026-01-18 05:42:35', '2026-01-18 05:42:35'),
(59, 'trt', 'trr', '', NULL, NULL, NULL, '2026-01-18 05:43:08', '2026-01-18 05:43:08'),
(60, 'rtrttrtreer', '', '', NULL, NULL, NULL, '2026-01-18 05:43:24', '2026-01-18 05:43:24'),
(61, 'trtrtrt', '', '', NULL, NULL, NULL, '2026-01-18 05:43:32', '2026-01-18 05:43:32'),
(62, 'new77', '', '', NULL, NULL, NULL, '2026-01-18 05:47:15', '2026-01-18 05:47:15'),
(63, 'num7', 'jjhjjhjh', '', NULL, NULL, NULL, '2026-01-18 05:51:11', '2026-01-18 05:51:11'),
(64, 'trtrttrtrtererererew', '', '', NULL, NULL, NULL, '2026-01-18 05:52:01', '2026-01-18 05:53:18'),
(65, 'trt3', '', '', NULL, NULL, NULL, '2026-01-18 05:52:22', '2026-01-18 05:52:22'),
(66, 'trtrtrtrtr', '', '', NULL, NULL, NULL, '2026-01-18 05:53:06', '2026-01-18 05:53:06'),
(67, 'trtrtretetrt', '', '', NULL, NULL, NULL, '2026-01-18 05:54:20', '2026-01-18 05:54:20'),
(68, 'rt6677 yuuu789', '', '', NULL, NULL, NULL, '2026-01-18 05:54:45', '2026-01-18 05:54:59'),
(69, 'new89', '', '', NULL, NULL, NULL, '2026-01-18 05:55:11', '2026-01-18 05:55:11'),
(70, 'trtrtertt', '', '', NULL, NULL, NULL, '2026-01-18 05:55:58', '2026-01-18 05:55:58'),
(71, 'f6778', '', '', NULL, NULL, NULL, '2026-01-18 05:56:46', '2026-01-18 05:56:46'),
(72, '8888999956777', 'yyytr', '', NULL, NULL, NULL, '2026-01-18 06:00:35', '2026-01-18 06:04:06'),
(73, 'tttrttter', '', '', NULL, NULL, NULL, '2026-01-18 06:01:12', '2026-01-18 06:01:12'),
(74, 'gh34', '', '', NULL, NULL, NULL, '2026-01-18 06:03:32', '2026-01-18 06:03:32'),
(75, 'gfgfgfg', '', '', NULL, NULL, NULL, '2026-01-18 06:03:57', '2026-01-18 06:03:57'),
(76, '4123', '', '', NULL, NULL, NULL, '2026-01-18 06:06:49', '2026-01-18 06:06:49'),
(77, '100', '', '', NULL, NULL, NULL, '2026-01-18 06:08:24', '2026-01-18 06:08:24'),
(78, '111', '', '', NULL, NULL, NULL, '2026-01-18 06:09:58', '2026-01-18 06:09:58'),
(79, 'new tilteeee', '', '', 'uploads/cats/files/new-tilteeee_696d3ef7ea8c9.jpg', 'uploads/cats/img/new-tilteeee-1768767222_696d3ef6bfc4d.jpg', 'uploads/cats/img/thumb/new-tilteeee-1768767222_696d3ef6bfc4d.jpg', '2026-01-18 06:10:46', '2026-01-18 16:13:43');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_13_181600_create_cats_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4pAxcsnIcz7DZNIY77i5ytrvdck2H5XhRYlqsqD9', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSlpmVjJ3dUd5ejR0TllkSGRKUThaVGNrOHlXT24xMlE5dlhyUkRmZiI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czo0MDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3N1YmNhdHMvdmlldyI7czo1OiJyb3V0ZSI7czoxOToiYWRtaW4uc3ViY2F0cy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1768849316);

-- --------------------------------------------------------

--
-- Table structure for table `subcats`
--

DROP TABLE IF EXISTS `subcats`;
CREATE TABLE IF NOT EXISTS `subcats` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `catid` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `des` text COLLATE utf8mb4_unicode_ci,
  `dess` longtext COLLATE utf8mb4_unicode_ci,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcats`
--

INSERT INTO `subcats` (`id`, `catid`, `name`, `des`, `dess`, `img`, `img2`, `filer`, `created_at`, `updated_at`) VALUES
(1, 76, 'sub11', 'gfgfgf', '<div>ggf</div>', 'uploads/subcats/img/sub11-1768762583_696d2cd78b93b.jfif', 'uploads/subcats/img/thumb/sub11-1768762583_696d2cd78b93b.jfif', 'uploads/subcats/files/sub11_696d2cd7d1f7f.pdf', '2026-01-18 14:35:40', '2026-01-18 14:56:23'),
(2, 78, 'ggh', 'hghgh', '', 'uploads/subcats/img/ggh-1768762122_696d2b0a99ebd.jpg', 'uploads/subcats/img/thumb/ggh-1768762122_696d2b0a99ebd.jpg', 'uploads/subcats/files/ggh_696d2b0be7a7c.jpg', '2026-01-18 14:48:43', '2026-01-18 14:48:43'),
(3, 34, 'fgf', 'ggfgf', '<div>ggf</div>', NULL, NULL, NULL, '2026-01-18 15:03:00', '2026-01-18 15:03:00'),
(4, 26, 'ytyt', '', '', NULL, NULL, NULL, '2026-01-18 15:04:01', '2026-01-18 15:04:01'),
(5, 31, 'hghgh', 'ghgh', '', NULL, NULL, NULL, '2026-01-18 15:04:08', '2026-01-18 15:04:08'),
(6, 10, 'ryyt', 'tytyt', '', NULL, NULL, NULL, '2026-01-18 15:58:18', '2026-01-18 15:58:18'),
(7, 10, 'fgfg', '', '', NULL, NULL, NULL, '2026-01-18 15:58:43', '2026-01-18 15:58:43'),
(8, 77, 'fgfgfd', 'fgggf', '', NULL, NULL, NULL, '2026-01-18 15:59:06', '2026-01-18 15:59:06'),
(9, 79, 'ttytgjjhjh', 'yyttyyt', '', NULL, NULL, NULL, '2026-01-18 16:16:48', '2026-01-18 16:17:23'),
(10, 72, 'uy', 'yuu', '', NULL, NULL, NULL, '2026-01-18 16:17:10', '2026-01-19 13:13:25'),
(11, 28, 'trtrt', 'trtrtr', '<div>ttrert</div>', 'uploads/subcats/img/trtrt-1768842850_696e66626b7e1.jpg', 'uploads/subcats/img/thumb/trtrt-1768842850_696e66626b7e1.jpg', NULL, '2026-01-19 13:14:10', '2026-01-19 13:14:10'),
(12, 34, 'newset 5555', '', '', NULL, NULL, NULL, '2026-01-19 13:14:43', '2026-01-19 13:14:43'),
(13, 35, 'newest 6', 'yyu', '', NULL, NULL, NULL, '2026-01-19 13:15:58', '2026-01-19 13:37:27'),
(14, 31, 'newest 6', 'ttt', '', 'uploads/subcats/img/newest-6-1768843047_696e6727ee2e3.jpg', 'uploads/subcats/img/thumb/newest-6-1768843047_696e6727ee2e3.jpg', 'uploads/subcats/files/newest-6_696e672859765.jpg', '2026-01-19 13:16:48', '2026-01-19 13:17:28'),
(15, 28, 'newest 6', 'htytrey', '', NULL, NULL, NULL, '2026-01-19 13:18:39', '2026-01-19 13:18:39'),
(16, 33, 'newest 6', '7767667', '', NULL, NULL, NULL, '2026-01-19 13:37:07', '2026-01-19 13:37:07'),
(17, 76, 'ttrtrtr', '', '', NULL, NULL, NULL, '2026-01-19 13:48:16', '2026-01-19 13:48:16'),
(18, 77, 'the 100', '', '', NULL, NULL, NULL, '2026-01-19 14:53:06', '2026-01-19 14:53:06'),
(19, 10, 'uuyy', 'yuyty', '', NULL, NULL, NULL, '2026-01-19 15:01:36', '2026-01-19 15:01:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', NULL, '$2y$12$aQAFiHRAitLbME5vhf55quUOKq7s/Mwf29584GlANL3lZiFJDsawO', 'SxSlziAphSSRTVCCSVggKNN23STz3h8jKx0inO6nYtsU8FSErh8PZtmEaLgE', '2026-01-12 11:58:55', '2026-01-12 11:58:55');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
