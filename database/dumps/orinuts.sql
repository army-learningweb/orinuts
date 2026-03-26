-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 06, 2026 at 05:22 PM
-- Server version: 8.4.3
-- PHP Version: 8.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orinuts`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('orinuts-cache-chanhoan@gmail.com|127.0.0.1', 'i:2;', 1771077064),
('orinuts-cache-chanhoan@gmail.com|127.0.0.1:timer', 'i:1771077064;', 1771077064);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gmail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_member` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `tel`, `address`, `gmail`, `password`, `created_at`, `updated_at`, `is_member`, `deleted_at`) VALUES
(86, 'Lưu Đức Vỹ', '0782199911', 'TPHCM', 'luuvy15899@gmail.com', NULL, '2026-03-05 11:54:03', '2026-03-05 11:54:03', '1', NULL),
(87, 'Lưu Đức Vỹ', '0782199911', 'TPHCM', 'luuvy15899@gmail.com', NULL, '2026-03-05 12:06:46', '2026-03-05 12:06:46', '1', NULL),
(88, 'Nguyễn Thành Nam', '0995674231', 'TPHCM', 'thanhnam@gmail.com', NULL, '2026-03-05 12:07:38', '2026-03-05 12:07:38', '1', NULL),
(89, 'Nguyễn Thành Nam', '0991234567', 'TPHCM', 'thanhnam@gmail.com', NULL, '2026-03-05 12:28:15', '2026-03-05 12:28:15', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` int NOT NULL,
  `is_main` int NOT NULL DEFAULT '1',
  `object_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `object_id` int DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `url`, `file_name`, `file_size`, `is_main`, `object_type`, `object_id`, `user_id`, `created_at`, `updated_at`) VALUES
(236, 'uploads/product/ngu-coc-7.png', 'ngu-coc-7.png', 262727, 0, 'product', 11, 25, '2026-02-08 08:14:47', '2026-02-08 08:14:54'),
(237, 'uploads/product/ngu-coc-5.png', 'ngu-coc-5.png', 169905, 0, 'product', 12, 25, '2026-02-08 08:16:15', '2026-02-08 08:16:23'),
(238, 'uploads/product/ngu-coc-1.png', 'ngu-coc-1.png', 278333, 0, 'product', 13, 25, '2026-02-08 08:17:21', '2026-02-08 08:17:23'),
(239, 'uploads/product/ngu-coc-3.png', 'ngu-coc-3.png', 202459, 0, 'product', 14, 25, '2026-02-08 08:18:33', '2026-02-08 08:18:36'),
(240, 'uploads/product/ngu-coc-4.png', 'ngu-coc-4.png', 249311, 0, 'product', 15, 25, '2026-02-08 08:20:40', '2026-02-08 08:20:43'),
(402, 'uploads/post/164094.jpg', '164094.jpg', 485654, 0, 'post', 11, 25, '2026-02-11 08:34:09', '2026-02-11 08:34:41'),
(403, 'uploads/post/835.jpg', '835.jpg', 672690, 0, 'post', 12, 25, '2026-02-11 08:35:13', '2026-02-11 08:35:37'),
(404, 'uploads/post/75463.jpg', '75463.jpg', 877758, 0, 'post', 13, 25, '2026-02-11 08:36:02', '2026-02-11 08:36:23'),
(405, 'uploads/post/2148678161.jpg', '2148678161.jpg', 739824, 0, 'post', 14, 25, '2026-02-11 08:36:36', '2026-02-11 08:37:12'),
(407, 'uploads/post/13749309-2006sm007007realistic-nuts-frame.jpg', '13749309-2006sm007007realistic-nuts-frame.jpg', 547014, 0, 'post', 15, 25, '2026-02-11 08:37:51', '2026-02-11 08:38:27'),
(415, 'uploads/product/13749309-2006sm007007realistic-nuts-frame.jpg', '13749309-2006sm007007realistic-nuts-frame.jpg', 547014, 0, 'product', 39, 61, '2026-02-14 12:50:52', '2026-02-14 12:51:15'),
(419, 'uploads/slider/898350be2185f067f93c0835f5e2991d.jpg', '898350be2185f067f93c0835f5e2991d.jpg', 83183, 0, 'slider', 19, 25, '2026-02-21 07:06:52', '2026-02-22 05:12:46'),
(420, 'uploads/slider/5fa2b13e211bbd92f1253b90efa50479.jpg', '5fa2b13e211bbd92f1253b90efa50479.jpg', 124964, 0, 'slider', 20, 25, '2026-02-21 07:07:40', '2026-02-22 05:12:10'),
(421, 'uploads/product/a069ea590fa97248f1753ff867d0493e-removebg-preview.png', 'a069ea590fa97248f1753ff867d0493e-removebg-preview.png', 60948, 0, 'product', 40, 25, '2026-02-21 10:38:13', '2026-02-21 10:39:31'),
(422, 'uploads/product/2f1cd73629ca5bf4b814fd3a73d33ac3-removebg-preview.png', '2f1cd73629ca5bf4b814fd3a73d33ac3-removebg-preview.png', 57389, 0, 'product', 41, 25, '2026-02-21 10:39:42', '2026-02-21 10:40:21'),
(423, 'uploads/product/08d993d41dc56b09d164966b1db1438e-removebg-preview.png', '08d993d41dc56b09d164966b1db1438e-removebg-preview.png', 64711, 0, 'product', 42, 25, '2026-02-21 10:40:45', '2026-02-21 10:41:38'),
(424, 'uploads/product/8ec8d489d1e815b3eb931c28c4df34a5-removebg-preview.png', '8ec8d489d1e815b3eb931c28c4df34a5-removebg-preview.png', 66991, 0, 'product', 43, 25, '2026-02-21 10:42:03', '2026-02-21 10:42:45'),
(426, 'uploads/product/42a9a3a25886b9e0388d236c5db4d447-removebg-preview.png', '42a9a3a25886b9e0388d236c5db4d447-removebg-preview.png', 68379, 0, 'product', 44, 25, '2026-02-21 10:52:03', '2026-02-21 10:54:01'),
(427, 'uploads/product/cb22b3556c3c29e0955dea8373ba0599-removebg-preview.png', 'cb22b3556c3c29e0955dea8373ba0599-removebg-preview.png', 62840, 0, 'product', 45, 25, '2026-02-21 10:58:09', '2026-02-21 10:58:39'),
(428, 'uploads/product/cb382e420d8d0907837f1d5e59f069f0-removebg-preview.png', 'cb382e420d8d0907837f1d5e59f069f0-removebg-preview.png', 54851, 0, 'product', 46, 25, '2026-02-21 10:59:15', '2026-02-21 11:00:49'),
(429, 'uploads/product/5e95d12d0b6d8f5e9551c4702434dbd2-removebg-preview.png', '5e95d12d0b6d8f5e9551c4702434dbd2-removebg-preview.png', 80703, 0, 'product', 47, 25, '2026-02-22 03:47:38', '2026-02-22 03:49:22'),
(430, 'uploads/product/9365a7a5ad607ece47b7829afc94f75e-removebg-preview.png', '9365a7a5ad607ece47b7829afc94f75e-removebg-preview.png', 43777, 0, 'product', 48, 25, '2026-02-22 03:49:37', '2026-02-22 03:50:15'),
(431, 'uploads/product/757859eeead4019271ed9dac7d6d90ea-removebg-preview.png', '757859eeead4019271ed9dac7d6d90ea-removebg-preview.png', 54141, 0, 'product', 49, 25, '2026-02-22 03:50:46', '2026-02-22 03:51:27'),
(432, 'uploads/product/a716fdebcb3f933fc9786a7cfd5e36ca-removebg-preview.png', 'a716fdebcb3f933fc9786a7cfd5e36ca-removebg-preview.png', 40719, 0, 'product', 50, 25, '2026-02-22 03:51:43', '2026-02-22 03:52:20'),
(433, 'uploads/product/d372bbf8271a96093c355730f2a9d7bc-removebg-preview.png', 'd372bbf8271a96093c355730f2a9d7bc-removebg-preview.png', 50705, 0, 'product', 51, 25, '2026-02-22 03:52:48', '2026-02-22 03:53:32'),
(434, 'uploads/product/da92e55b0b588c23a541ee94bb421301-removebg-preview.png', 'da92e55b0b588c23a541ee94bb421301-removebg-preview.png', 56744, 0, 'product', 52, 25, '2026-02-22 03:53:39', '2026-02-22 03:54:20'),
(437, 'uploads/slider/7953a8a920c394ece1e1b31e1d525e1c.jpg', '7953a8a920c394ece1e1b31e1d525e1c.jpg', 129158, 0, 'slider', 21, 25, '2026-02-22 05:28:57', '2026-02-22 05:30:07'),
(438, 'uploads/slider/b9152104f5b23e57688c1e4094aa1c06.jpg', 'b9152104f5b23e57688c1e4094aa1c06.jpg', 54624, 0, 'slider', 22, 25, '2026-02-22 06:05:55', '2026-02-22 06:07:25'),
(439, 'uploads/product/gift-2.jpg', 'gift-2.jpg', 128148, 0, 'product', 53, 25, '2026-02-24 11:52:56', '2026-02-24 11:53:47'),
(440, 'uploads/product/gift-5.jpg', 'gift-5.jpg', 69340, 0, 'product', 54, 25, '2026-02-24 11:59:21', '2026-02-24 12:00:48'),
(441, 'uploads/product/gift-4.jpg', 'gift-4.jpg', 85239, 0, 'product', 55, 25, '2026-02-24 12:02:15', '2026-02-24 12:03:06'),
(442, 'uploads/product/gift-1.jpg', 'gift-1.jpg', 74363, 0, 'product', 56, 25, '2026-02-24 12:04:08', '2026-02-24 12:08:01'),
(443, 'uploads/product/gift-3.jpg', 'gift-3.jpg', 84600, 0, 'product', 57, 25, '2026-02-24 12:09:04', '2026-02-24 12:10:16'),
(444, 'uploads/product/sorry-access-denied-1.jpg', 'sorry-access-denied-1.jpg', 67725, 0, 'product', 58, 25, '2026-02-25 02:59:34', '2026-02-25 03:00:23'),
(445, 'uploads/product/gifting-boxes-the-roasted-nut.jpg', 'gifting-boxes-the-roasted-nut.jpg', 47517, 0, 'product', 59, 25, '2026-02-25 03:00:38', '2026-02-25 03:01:35'),
(446, 'uploads/product/download.jpg', 'download.jpg', 60055, 0, 'product', 60, 25, '2026-02-25 03:01:43', '2026-02-25 03:02:46'),
(447, 'uploads/product/orexovyi-boks.jpg', 'orexovyi-boks.jpg', 108323, 0, 'product', 61, 25, '2026-02-25 03:03:01', '2026-02-25 03:04:36'),
(448, 'uploads/product/sorry-access-denied.jpg', 'sorry-access-denied.jpg', 100090, 0, 'product', 62, 25, '2026-02-25 03:04:47', '2026-02-25 03:05:47'),
(449, 'uploads/product/cashew-pack.png', 'cashew-pack.png', 300954, 0, 'product', 63, 25, '2026-02-25 03:19:20', '2026-02-25 03:20:17'),
(450, 'uploads/product/almond-pack.png', 'almond-pack.png', 255659, 0, 'product', 64, 25, '2026-02-25 03:30:43', '2026-02-25 03:31:23'),
(451, 'uploads/product/almond-pack-2-removebg-preview.png', 'almond-pack-2-removebg-preview.png', 174482, 0, 'product', 65, 25, '2026-02-25 03:33:49', '2026-02-25 03:35:01'),
(453, 'uploads/product/mixed-nuts-packaging-design-removebg-preview.png', 'mixed-nuts-packaging-design-removebg-preview.png', 251734, 0, 'product', 66, 25, '2026-02-25 03:49:13', '2026-02-25 03:49:47'),
(454, 'uploads/product/second-nature-wholesome-medley-trail-mix-healthy-nuts-snack-blend-gluten-free-14-oz-resealable-pouch-removebg-preview.png', 'second-nature-wholesome-medley-trail-mix-healthy-nuts-snack-blend-gluten-free-14-oz-resealable-pouch-removebg-preview.png', 424146, 0, 'product', 67, 25, '2026-02-25 03:50:08', '2026-02-25 03:50:47'),
(455, 'uploads/product/download-removebg-preview.png', 'download-removebg-preview.png', 231105, 0, 'product', 68, 25, '2026-02-25 03:50:53', '2026-02-25 03:51:22'),
(456, 'uploads/product/roastery-coast-healthy-nuts-mix-bulk-3-lb-bulk-snack-mix-deluxe-assorted-original-mix-removebg-preview.png', 'roastery-coast-healthy-nuts-mix-bulk-3-lb-bulk-snack-mix-deluxe-assorted-original-mix-removebg-preview.png', 336253, 0, 'product', 69, 25, '2026-02-25 03:51:52', '2026-02-25 03:52:21'),
(457, 'uploads/product/kraft-box-w-mixed-nuts-mockup-free-download-images-high-quality-png-jpg-73374-removebg-preview.png', 'kraft-box-w-mixed-nuts-mockup-free-download-images-high-quality-png-jpg-73374-removebg-preview.png', 297687, 0, 'product', 70, 25, '2026-02-25 03:52:29', '2026-02-25 03:52:55'),
(458, 'uploads/product/download-1-removebg-preview.png', 'download-1-removebg-preview.png', 311013, 0, 'product', 71, 25, '2026-02-25 03:53:06', '2026-02-25 03:54:35'),
(459, 'uploads/product/home-removebg-preview.png', 'home-removebg-preview.png', 363490, 0, 'product', 72, 25, '2026-02-25 03:54:43', '2026-02-25 03:55:26'),
(460, 'uploads/product/pure-bars-review-organic-gluten-free-vegan-fruit-nut-snacks.jpg', 'pure-bars-review-organic-gluten-free-vegan-fruit-nut-snacks.jpg', 95290, 0, 'product', 73, 25, '2026-02-25 04:05:40', '2026-02-25 04:05:42'),
(461, 'uploads/product/top-energy-bar-packaging-designs-for-a-bold-look.jpg', 'top-energy-bar-packaging-designs-for-a-bold-look.jpg', 120233, 0, 'product', 74, 25, '2026-02-25 04:07:50', '2026-02-25 04:07:57'),
(462, 'uploads/product/10-tasty-dairy-free-snack-bars-to-buy-for-road-trips.jpg', '10-tasty-dairy-free-snack-bars-to-buy-for-road-trips.jpg', 87709, 0, 'product', 75, 25, '2026-02-25 04:08:38', '2026-02-25 04:09:17'),
(463, 'uploads/product/kliekjes-archief-simones-kitchen.jpg', 'kliekjes-archief-simones-kitchen.jpg', 130820, 0, 'product', 76, 25, '2026-02-25 04:10:01', '2026-02-25 04:10:54'),
(464, 'uploads/product/50-exquisite-packaging-design-concepts-for-inspiration-2018.jpg', '50-exquisite-packaging-design-concepts-for-inspiration-2018.jpg', 60890, 0, 'product', 77, 25, '2026-02-25 04:11:40', '2026-02-25 04:15:46'),
(467, 'uploads/product/25-budget-friendly-simple-fall-baby-shower-favors-barefoot-budgeting.jpg', '25-budget-friendly-simple-fall-baby-shower-favors-barefoot-budgeting.jpg', 132484, 0, 'product', 78, 25, '2026-02-25 04:18:41', '2026-02-25 04:21:25'),
(468, 'uploads/product/almakaru-en-felice.jpg', 'almakaru-en-felice.jpg', 150564, 0, 'product', 79, 25, '2026-02-25 04:21:51', '2026-02-25 04:22:35'),
(469, 'uploads/product/floffis.jpg', 'floffis.jpg', 39871, 0, 'product', 80, 25, '2026-02-25 04:22:40', '2026-02-25 04:23:53'),
(470, 'uploads/product/download-copy-1.jpg', 'download-copy-1.jpg', 129456, 0, 'product', 81, 25, '2026-02-25 04:24:11', '2026-02-25 04:24:56'),
(471, 'uploads/product/bolsitas-de-dulces.jpg', 'bolsitas-de-dulces.jpg', 125253, 0, 'product', 82, 25, '2026-02-25 04:25:39', '2026-02-25 04:26:59'),
(472, 'uploads/product/delicious-soft-dried-fruit-snack-needs-attractive-package-design-product-packaging-contest-removebg-preview.png', 'delicious-soft-dried-fruit-snack-needs-attractive-package-design-product-packaging-contest-removebg-preview.png', 215259, 0, 'product', 83, 25, '2026-02-25 04:33:42', '2026-02-25 04:34:07'),
(473, 'uploads/product/chiwis-instantly-recognizable-packaging-system-logoforsale-removebg-preview.png', 'chiwis-instantly-recognizable-packaging-system-logoforsale-removebg-preview.png', 294361, 0, 'product', 84, 25, '2026-02-25 04:34:12', '2026-02-25 04:34:53'),
(474, 'uploads/product/dheeraj-bhati-king-kacha-soft-dried-mango-pouch-packaging-design-removebg-preview.png', 'dheeraj-bhati-king-kacha-soft-dried-mango-pouch-packaging-design-removebg-preview.png', 193658, 0, 'product', 85, 25, '2026-02-25 04:34:59', '2026-02-25 04:35:28'),
(475, 'uploads/product/label-design-removebg-preview.png', 'label-design-removebg-preview.png', 203200, 0, 'product', 86, 25, '2026-02-25 04:35:43', '2026-02-25 04:36:10'),
(476, 'uploads/product/organic-dried-mango-slices-soft-juicy-no-artifical-added-sugar-naturally-ripened-gluten-free-vegan-non-gmo-high-in-vitamin-c-fiber-removebg-preview.png', 'organic-dried-mango-slices-soft-juicy-no-artifical-added-sugar-naturally-ripened-gluten-free-vegan-non-gmo-high-in-vitamin-c-fiber-removebg-preview.png', 299761, 0, 'product', 87, 25, '2026-02-25 04:36:16', '2026-02-25 04:36:44'),
(478, 'uploads/product/mavuno-harvest-gluten-free-organic-dried-jackfruit-fruit-snacks-1-lb-bag-mahw-jack1lb-removebg-preview.png', 'mavuno-harvest-gluten-free-organic-dried-jackfruit-fruit-snacks-1-lb-bag-mahw-jack1lb-removebg-preview.png', 256342, 0, 'product', 88, 25, '2026-02-25 04:44:05', '2026-02-25 04:44:39'),
(479, 'uploads/product/finally-an-online-store-that-loves-healthy-snacks-as-much-as-we-do-removebg-preview.png', 'finally-an-online-store-that-loves-healthy-snacks-as-much-as-we-do-removebg-preview.png', 175847, 0, 'product', 89, 25, '2026-02-25 04:44:43', '2026-02-25 04:45:07'),
(480, 'uploads/product/freeze-dried-jackfruit-crisps-10-bags-removebg-preview.png', 'freeze-dried-jackfruit-crisps-10-bags-removebg-preview.png', 194556, 0, 'product', 90, 25, '2026-02-25 04:45:12', '2026-02-25 04:45:34'),
(481, 'uploads/product/kozhikodens-jackfruit-chips-removebg-preview.png', 'kozhikodens-jackfruit-chips-removebg-preview.png', 243899, 0, 'product', 91, 25, '2026-02-25 04:45:40', '2026-02-25 04:46:04'),
(482, 'uploads/product/shopee-membership-gift-redemption-alor-freeze-dried-durian-50-g-removebg-preview.png', 'shopee-membership-gift-redemption-alor-freeze-dried-durian-50-g-removebg-preview.png', 153477, 0, 'product', 92, 25, '2026-02-25 04:46:55', '2026-02-25 04:47:40'),
(483, 'uploads/product/image-removebg-preview.png', 'image-removebg-preview.png', 182086, 0, 'product', 93, 25, '2026-02-25 05:00:55', '2026-02-25 05:01:33'),
(484, 'uploads/product/image-1-removebg-preview.png', 'image-1-removebg-preview.png', 184447, 0, 'product', 94, 25, '2026-02-25 05:02:04', '2026-02-25 05:02:39'),
(485, 'uploads/product/image-3-removebg-preview.png', 'image-3-removebg-preview.png', 173889, 0, 'product', 95, 25, '2026-02-25 05:02:57', '2026-02-25 05:03:28'),
(486, 'uploads/product/image-4-removebg-preview.png', 'image-4-removebg-preview.png', 176794, 0, 'product', 96, 25, '2026-02-25 05:03:40', '2026-02-25 05:04:02'),
(487, 'uploads/product/image-2-removebg-preview.png', 'image-2-removebg-preview.png', 168615, 0, 'product', 97, 25, '2026-02-25 05:04:26', '2026-02-25 05:04:59'),
(488, 'uploads/product/image-4-removebg-preview-copy-1.png', 'image-4-removebg-preview-copy-1.png', 321702, 0, 'product', 98, 25, '2026-02-25 05:18:38', '2026-02-25 05:19:29'),
(489, 'uploads/product/image-3-removebg-preview-copy-1.png', 'image-3-removebg-preview-copy-1.png', 306445, 0, 'product', 99, 25, '2026-02-25 05:20:18', '2026-02-25 05:20:56'),
(490, 'uploads/product/image-2-removebg-preview-copy-1.png', 'image-2-removebg-preview-copy-1.png', 301695, 0, 'product', 100, 25, '2026-02-25 05:21:03', '2026-02-25 05:21:36'),
(491, 'uploads/product/image-1-removebg-preview-copy-1.png', 'image-1-removebg-preview-copy-1.png', 299132, 0, 'product', 101, 25, '2026-02-25 05:21:41', '2026-02-25 05:22:09'),
(492, 'uploads/product/image-removebg-preview-copy-1.png', 'image-removebg-preview-copy-1.png', 296038, 0, 'product', 102, 25, '2026-02-25 05:22:13', '2026-02-25 05:22:36'),
(494, 'uploads/post/healthy-food-clean-eating-fruit-vegetable-seeds-superfood-cereals-leaf-vegetable-on-black-wood-background-with-copy-space-top-view.jpg', 'healthy-food-clean-eating-fruit-vegetable-seeds-superfood-cereals-leaf-vegetable-on-black-wood-background-with-copy-space-top-view.jpg', 84721, 0, 'post', 16, 25, '2026-02-25 06:52:37', '2026-02-25 06:53:05'),
(495, 'uploads/post/green-vegetables-photos-download-free-high-quality-pictures-freepik-1.jpg', 'green-vegetables-photos-download-free-high-quality-pictures-freepik-1.jpg', 50144, 0, 'post', 17, 25, '2026-02-25 06:55:51', '2026-02-25 06:56:51'),
(497, 'uploads/post/haferflocken-sind-gesund-alles-was-du-wissen-solltest-verival-blog.jpg', 'haferflocken-sind-gesund-alles-was-du-wissen-solltest-verival-blog.jpg', 61237, 0, 'post', 18, 25, '2026-02-25 07:06:28', '2026-02-25 07:06:49'),
(498, 'uploads/post/rolled-oats-or-oat-flakes-stock-photo-containing-oat-and-grain.jpg', 'rolled-oats-or-oat-flakes-stock-photo-containing-oat-and-grain.jpg', 89272, 0, 'post', 19, 25, '2026-02-25 07:08:10', '2026-02-25 07:08:29'),
(499, 'uploads/post/various-types-of-nuts-featuring-nuts-organic-and-raw.jpg', 'various-types-of-nuts-featuring-nuts-organic-and-raw.jpg', 97453, 0, 'post', 20, 25, '2026-02-25 07:15:13', '2026-02-25 07:15:38'),
(500, 'uploads/post/various-nuts-and-dried-fruits-featuring-above-almond-and-apricot.jpg', 'various-nuts-and-dried-fruits-featuring-above-almond-and-apricot.jpg', 143054, 0, 'post', 21, 25, '2026-02-25 07:16:01', '2026-02-25 07:16:26'),
(501, 'uploads/post/eating-foods-that-have-similar-effects-to-estrogen-and-help-to-improve-blood-flow-are-great-ways-to-naturally-combat-vaginal-dryness.jpg', 'eating-foods-that-have-similar-effects-to-estrogen-and-help-to-improve-blood-flow-are-great-ways-to-naturally-combat-vaginal-dryness.jpg', 106731, 0, 'post', 22, 25, '2026-02-25 07:16:52', '2026-02-25 07:17:10'),
(502, 'uploads/post/eating-a-handful-of-nuts-daily-may-reduce-heart-disease-risk-by-25-study.jpg', 'eating-a-handful-of-nuts-daily-may-reduce-heart-disease-risk-by-25-study.jpg', 105247, 0, 'post', 23, 25, '2026-02-25 07:18:13', '2026-02-25 07:18:31'),
(503, 'uploads/product/plant-9.jpg', 'plant-9.jpg', 85393, 1, 'product', 102, 25, '2026-02-26 08:52:24', '2026-02-26 08:52:42'),
(504, 'uploads/product/plant-7.jpg', 'plant-7.jpg', 100387, 1, 'product', 102, 25, '2026-02-26 08:52:28', '2026-02-26 08:52:42'),
(505, 'uploads/product/plant-1.jpg', 'plant-1.jpg', 41420, 1, 'product', 102, 25, '2026-02-26 09:39:14', '2026-02-26 09:39:22'),
(506, 'uploads/product/plant-4.jpg', 'plant-4.jpg', 76881, 1, 'product', 102, 25, '2026-02-26 09:39:20', '2026-02-26 09:39:22');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL,
  `status` enum('active','disable') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `object_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `slug`, `order`, `status`, `type`, `object_id`, `parent_id`, `user_id`, `created_at`, `updated_at`) VALUES
(47, 'Hạt mix dinh dưỡng', 'san-pham/hat-mix-dinh-duong', 1, 'active', 'product', 81, 46, 25, '2026-02-12 08:19:13', '2026-02-12 08:19:13'),
(54, 'Liên hệ', 'lien-he', 4, 'active', 'page', 4, 0, 25, '2026-02-12 13:54:15', '2026-03-05 12:59:27'),
(62, 'Xoài sấy', 'san-pham/xoai-say', 1, 'active', 'product', 83, 61, 25, '2026-02-21 07:46:25', '2026-02-21 07:46:33'),
(63, 'Mít sấy', 'san-pham/mit-say', 1, 'active', 'product', 84, 61, 25, '2026-02-21 07:46:48', '2026-02-21 07:46:48'),
(64, 'Hạt mix combo', 'san-pham/hat-mix-combo', 2, 'active', 'product', 82, 46, 25, '2026-02-21 07:47:04', '2026-02-21 07:47:04'),
(71, 'Giới thiệu', 'gioi-thieu', 2, 'active', 'page', 3, 0, 25, '2026-02-24 02:54:33', '2026-03-03 11:24:50'),
(72, 'Blog', 'bai-viet', 3, 'active', 'page', 10, 0, 25, '2026-02-24 05:27:20', '2026-03-03 11:24:54'),
(73, 'Trang chủ', '', 1, 'active', 'page', 2, 0, 25, '2026-02-25 05:58:45', '2026-02-28 17:36:46');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_21_133945_add_is_avtive_to_tb_users', 2),
(6, '2026_01_25_121752_add_soft_delete_to_tb_users', 3),
(7, '2026_01_28_110855_create_products_categories_table', 4),
(8, '2026_01_30_061001_add_soft_delete_to_product_categories', 5),
(9, '2026_02_01_112740_create_media', 6),
(10, '2026_02_01_115352_create_products', 7),
(11, '2026_02_01_121456_add_more_to_products', 8),
(12, '2026_02_01_123204_add_status_to_products', 9),
(13, '2026_02_06_134911_add_quantity_to_products', 10),
(14, '2026_02_06_135031_change_data_from_products', 11),
(15, '2026_02_07_092321_add_code_to_products', 12),
(16, '2026_02_07_105453_remove_img_id_from_products', 13),
(17, '2026_02_07_115847_change_media', 14),
(18, '2026_02_07_181434_add_slug_to_products', 15),
(19, '2026_02_07_192925_add_img_id_to_products', 16),
(25, '2026_02_08_152647_add_soft_delete_to_products', 17),
(26, '2026_02_09_170146_change_img_id_from_products', 17),
(28, '2026_02_10_113252_create_post_categories_table', 18),
(29, '2026_02_10_114212_create_posts_table', 19),
(30, '2026_02_10_120159_add_slug_to_posts', 20),
(31, '2026_02_10_120628_add_cat_id_to_posts', 21),
(32, '2026_02_10_200134_change_status_value_posts', 22),
(33, '2026_02_11_102319_create_sliders_table', 23),
(34, '2026_02_11_105636_create_status_img_url_title_to_sliders', 24),
(37, '2026_02_11_180635_create_pages_table', 25),
(38, '2026_02_11_192405_add_soft_delete_pages', 26),
(39, '2026_02_11_202130_create_menu_table', 27),
(40, '2026_02_11_204310_add_status_to_menu', 28),
(41, '2026_02_11_210027_add_parent_id_object_id_obejct_type_to_menu', 29),
(42, '2026_02_11_214923_rename_menu', 30),
(43, '2026_02_12_175519_create_permissions_table', 31),
(44, '2026_02_12_175832_create_roles_table', 32),
(45, '2026_02_12_180246_create_role_permissions_table', 33),
(46, '2026_02_12_181002_create_user_roles_table', 34),
(47, '2026_02_27_081539_create_shoppingcart_table', 35),
(48, '2026_02_27_163656_create_orders_table', 36),
(49, '2026_02_27_164742_create_customers_table', 37),
(50, '2026_02_27_172236_add_customer_id', 38),
(51, '2026_02_27_175516_add_note_to_orders', 39),
(52, '2026_02_28_134959_create_order_items_table', 40),
(53, '2026_02_28_204823_add_status_to_orders', 41),
(54, '2026_03_01_083213_add_is_member_to_customer', 42),
(55, '2026_03_01_112332_add_sold_count_to_products', 43),
(56, '2026_03_01_122829_change_tel_customers', 44),
(57, '2026_03_01_190231_add_soft_delete_customers', 45),
(58, '2026_03_02_154508_create_product_reviews_table', 46),
(59, '2026_03_02_170632_add_more_status_product_reviews', 47),
(60, '2026_03_05_184817_add_tel_to_orders', 48),
(61, '2026_03_05_192232_add_refund_to_status_orders', 49),
(62, '2026_03_05_203926_change_data_type_customers', 50);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` int NOT NULL,
  `total_price` int NOT NULL,
  `shipping_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` enum('cod','zalo','momo','banking') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cod',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','processing','shipped','delivered','canceled','refund') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `code`, `total_amount`, `total_price`, `shipping_address`, `payment_method`, `created_at`, `updated_at`, `customer_id`, `note`, `status`, `tel`) VALUES
(79, 'ori#GsEJV', 5, 706000, 'TPHCM', 'cod', '2026-03-05 11:54:04', '2026-03-05 13:44:49', 86, NULL, 'pending', '0782199911'),
(80, 'ori#tjmtb', 1, 110000, 'TPHCM', 'cod', '2026-02-17 12:06:46', '2026-03-05 13:41:07', 87, NULL, 'refund', '0782199911'),
(81, 'ori#oDvAm', 1, 110000, 'TPHCM', 'cod', '2026-03-05 12:07:38', '2026-03-05 13:44:48', 88, NULL, 'pending', '0995674231'),
(82, 'ori#7q6Mp', 1, 110000, 'TPHCM', 'cod', '2026-03-05 12:28:15', '2026-03-05 12:45:27', 89, NULL, 'canceled', '0991234567');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(147, 79, 101, 1, 80000, '2026-03-05 11:54:04', '2026-03-05 11:54:04'),
(148, 79, 100, 1, 80000, '2026-03-05 11:54:04', '2026-03-05 11:54:04'),
(149, 79, 99, 1, 80000, '2026-03-05 11:54:04', '2026-03-05 11:54:04'),
(150, 79, 43, 1, 270000, '2026-03-05 11:54:04', '2026-03-05 11:54:04'),
(151, 79, 45, 1, 196000, '2026-03-05 11:54:04', '2026-03-05 11:54:04'),
(152, 80, 101, 1, 80000, '2026-03-05 12:06:46', '2026-03-05 12:06:46'),
(153, 81, 101, 1, 80000, '2026-03-05 12:07:38', '2026-03-05 12:07:38'),
(154, 82, 101, 1, 80000, '2026-03-05 12:28:15', '2026-03-05 12:28:15');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('publish','draft','disable') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `content`, `slug`, `status`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Trang chủ', '<p>/</p>', '', 'publish', 25, '2026-02-11 12:07:29', '2026-03-02 13:52:33', NULL),
(3, 'Giới thiệu', '<p style=\"text-align: center;\"><span style=\"font-size: 36pt;\"><strong>Giới thiệu</strong></span></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\" data-path-to-node=\"1\">Ch&agrave;o mừng bạn đến với Orinuts &ndash; Tinh hoa hạt dinh dưỡng từ thi&ecirc;n nhi&ecirc;n! Tại Orinuts, ch&uacute;ng t&ocirc;i tin rằng sức khỏe bắt đầu từ những g&igrave; bạn ăn mỗi ng&agrave;y. Với sứ mệnh mang đến nguồn năng lượng sạch, l&agrave;nh mạnh tr&agrave;n đầy sức sống, Orinuts chuy&ecirc;n cung cấp c&aacute;c d&ograve;ng hạt dinh dưỡng cao cấp, được tuyển chọn khắt khe từ những v&ugrave;ng nguy&ecirc;n liệu sạch nhất.Ra đời từ niềm đam m&ecirc; với lối sống l&agrave;nh mạnh (healthy lifestyle). Ch&uacute;ng t&ocirc;i hiểu rằng trong nhịp sống hiện đại hối hả, việc t&igrave;m kiếm một m&oacute;n ăn nhẹ vừa ngon miệng, vừa bổ dưỡng l&agrave; điều v&ocirc; c&ugrave;ng quan trọng. Đ&oacute; l&agrave; l&yacute; do Orinuts tập trung v&agrave;o việc giữ trọn hương vị tự nhi&ecirc;n v&agrave; gi&aacute; trị dinh dưỡng trong từng hạt sản phẩm.</p>\r\n<p style=\"text-align: center;\" data-path-to-node=\"3\">&nbsp;</p>\r\n<p style=\"text-align: center;\" data-path-to-node=\"3\">&nbsp;</p>\r\n<p style=\"text-align: center;\" data-path-to-node=\"3\">&nbsp;</p>\r\n<hr data-path-to-node=\"1\">\r\n<p style=\"text-align: center;\" data-path-to-node=\"4\">&nbsp;</p>\r\n<p style=\"text-align: center;\" data-path-to-node=\"4\">&nbsp;</p>\r\n<p style=\"text-align: center;\" data-path-to-node=\"4\"><span style=\"font-size: 36pt;\"><strong>Cốt l&otilde;i</strong></span></p>\r\n<p style=\"text-align: center;\" data-path-to-node=\"4\">&nbsp;</p>\r\n<p style=\"text-align: center;\" data-path-to-node=\"4\">&nbsp;</p>\r\n<h3 style=\"line-height: 1.5; text-align: center;\" data-path-to-node=\"9\"><span style=\"font-size: 18pt;\"><strong>Chất lượng từ t&acirc;m</strong></span></h3>\r\n<table style=\"border-collapse: collapse; width: 100%; height: 80.8px;\" border=\"1\"><colgroup><col style=\"width: 16.5929%;\"><col style=\"width: 66.8814%;\"><col style=\"width: 16.5086%;\"></colgroup>\r\n<tbody>\r\n<tr style=\"height: 80.8px;\">\r\n<td>&nbsp;</td>\r\n<td style=\"text-align: center;\">Ch&uacute;ng t&ocirc;i kh&ocirc;ng thỏa hiệp với chất lượng. Mỗi hạt dinh dưỡng tại Orinuts đều trải qua quy tr&igrave;nh tuyển chọn khắt khe, đảm bảo giữ trọn vẹn hương vị tự nhi&ecirc;n v&agrave; h&agrave;m lượng chất cao nhất.</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p style=\"line-height: 1.5; text-align: center;\" data-path-to-node=\"10\">&nbsp;</p>\r\n<p style=\"line-height: 1.5; text-align: center;\" data-path-to-node=\"10\">&nbsp;</p>\r\n<h3 style=\"line-height: 1.5; text-align: center;\" data-path-to-node=\"11\"><span style=\"font-size: 18pt;\"><strong>Minh bạch &amp; An to&agrave;n</strong></span></h3>\r\n<table style=\"border-collapse: collapse; width: 100%; height: 58.4px;\" border=\"1\"><colgroup><col style=\"width: 16.2526%;\"><col style=\"width: 67.051%;\"><col style=\"width: 16.6795%;\"></colgroup>\r\n<tbody>\r\n<tr style=\"height: 58.4px;\">\r\n<td>&nbsp;</td>\r\n<td style=\"text-align: center;\">Sự tin tưởng của kh&aacute;ch h&agrave;ng l&agrave; t&agrave;i sản lớn nhất. Orinuts cam kết nguồn gốc xuất xứ r&otilde; r&agrave;ng, quy tr&igrave;nh đ&oacute;ng g&oacute;i đạt chuẩn vệ sinh an to&agrave;n thực phẩm, n&oacute;i kh&ocirc;ng với chất bảo quản độc hại.</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p style=\"line-height: 1.5; text-align: center;\" data-path-to-node=\"12\">&nbsp;</p>\r\n<p style=\"line-height: 1.5; text-align: center;\" data-path-to-node=\"12\">&nbsp;</p>\r\n<h3 style=\"line-height: 1.5; text-align: center;\" data-path-to-node=\"13\"><strong><span style=\"font-size: 18pt;\">Lan tỏa lối sống xanh</span></strong></h3>\r\n<table style=\"border-collapse: collapse; width: 100%;\" border=\"1\"><colgroup><col style=\"width: 16.1675%;\"><col style=\"width: 67.646%;\"><col style=\"width: 16.1695%;\"></colgroup>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td style=\"text-align: center;\">Orinuts kh&ocirc;ng chỉ b&aacute;n hạt, ch&uacute;ng t&ocirc;i truyền cảm hứng về một chế độ ăn uống th&ocirc;ng minh. Ch&uacute;ng t&ocirc;i đồng h&agrave;nh c&ugrave;ng cộng đồng trong h&agrave;nh tr&igrave;nh chăm s&oacute;c sức khỏe chủ động v&agrave; bảo vệ m&ocirc;i trường th&ocirc;ng qua c&aacute;c giải ph&aacute;p bao b&igrave; th&acirc;n thiện.</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p style=\"line-height: 1.5; text-align: center;\" data-path-to-node=\"14\">&nbsp;</p>\r\n<p style=\"text-align: center;\">&nbsp;</p>', 'gioi-thieu', 'publish', 25, '2026-02-11 12:07:44', '2026-03-02 15:38:08', NULL),
(4, 'Liên hệ', '<p style=\"text-align: center;\"><span style=\"font-size: 36pt;\"><strong>Li&ecirc;n hệ&nbsp;</strong></span></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"line-height: 1.5; text-align: center;\">Bạn c&oacute; c&acirc;u hỏi hoặc cần hỗ trợ về sản phẩm? Đừng ngần ngại kết nối với ch&uacute;ng t&ocirc;i!</p>\r\n<p style=\"line-height: 1.5; text-align: center;\">&nbsp;</p>\r\n<p style=\"line-height: 1.5; text-align: center;\">Tại <strong data-path-to-node=\"4\" data-index-in-node=\"4\">Orinuts</strong>, mỗi &yacute; kiến đ&oacute;ng g&oacute;p v&agrave; thắc mắc của kh&aacute;ch h&agrave;ng đều l&agrave; động lực để ch&uacute;ng t&ocirc;i ho&agrave;n thiện hơn mỗi ng&agrave;y. D&ugrave; bạn cần tư vấn về chế độ dinh dưỡng, th&ocirc;ng tin sỉ lẻ hay hỗ trợ đơn h&agrave;ng, đội ngũ Orinuts lu&ocirc;n sẵn s&agrave;ng lắng nghe.</p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<ul style=\"text-align: center;\" data-path-to-node=\"7\">\r\n<li>\r\n<p style=\"line-height: 2;\" data-path-to-node=\"7,0,0\">Địa chỉ trụ sở: Th&agrave;nh phố Hồ Ch&iacute; Minh</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"7,1,0\">Hotline hỗ trợ (24/7): 0782 3456 789</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"7,2,0\">Email chăm s&oacute;c kh&aacute;ch h&agrave;ng: supportOrinuts@gmail.com</p>\r\n</li>\r\n<li>\r\n<p style=\"line-height: 2;\" data-path-to-node=\"7,3,0\">Thời gian l&agrave;m việc: 08:00 &ndash; 21:00 (Tất cả c&aacute;c ng&agrave;y trong tuần)</p>\r\n</li>\r\n</ul>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<hr data-path-to-node=\"1\">\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\"><span style=\"font-size: 18pt;\">\"Orinuts &ndash; Trao sức khỏe v&agrave;ng, gửi trọn y&ecirc;u thương.\"</span></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>', 'lien-he', 'publish', 25, '2026-02-11 12:07:52', '2026-03-02 07:53:16', NULL),
(7, 'Sản phẩm', '<p>/</p>', 'san-pham', 'publish', 25, '2026-02-11 12:08:58', '2026-03-02 13:53:08', '2026-03-02 13:53:08'),
(10, 'Blog', '<p>/</p>', 'bai-viet', 'publish', 25, '2026-02-12 06:38:28', '2026-03-02 13:52:52', NULL),
(13, 'test', NULL, 'test', 'publish', 25, '2026-03-02 13:47:45', '2026-03-02 13:48:45', '2026-03-02 13:48:45'),
(14, 'Chủ để', NULL, 'chu-de', 'publish', 25, '2026-03-02 13:48:39', '2026-03-02 13:56:28', '2026-03-02 13:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `desc`, `slug`, `created_at`, `updated_at`) VALUES
(20, 'User Manager', 'Quản lí thành viên', 'user.manager', '2026-02-14 11:40:58', '2026-02-14 11:40:58'),
(21, 'User Create', 'Thêm thành viên', 'user.create', '2026-02-14 11:41:24', '2026-02-14 11:41:24'),
(22, 'User Edit', 'Cập nhật thông tin thành viên', 'user.edit', '2026-02-14 11:41:43', '2026-02-14 11:45:58'),
(23, 'User Destroy', 'Xóa thành viên', 'user.destroy', '2026-02-14 11:42:17', '2026-02-14 11:42:17'),
(24, 'User View', 'Xem danh sách thành viên', 'user.view', '2026-02-14 11:44:34', '2026-02-14 11:44:34'),
(25, 'Product Manager', 'Quản lí sản phẩm', 'product.manager', '2026-02-14 11:45:11', '2026-02-14 11:45:11'),
(26, 'Product Create', 'Thêm sản phẩm', 'product.create', '2026-02-14 11:45:27', '2026-02-14 11:45:27'),
(27, 'Product Edit', 'Cập nhật sản phẩm', 'product.edit', '2026-02-14 11:45:48', '2026-02-14 11:45:48'),
(28, 'Product Destroy', 'Xóa sản phẩm', 'product.destroy', '2026-02-14 11:46:29', '2026-02-14 11:46:29'),
(29, 'Product View', 'Xem danh sách sản phẩm', 'product.view', '2026-02-14 11:46:42', '2026-02-14 11:46:42'),
(30, 'Post Manager', 'Quản lí bài viết', 'post.manager', '2026-02-14 11:47:25', '2026-02-14 11:47:25'),
(31, 'Post Create', 'Thêm bài viết', 'post.create', '2026-02-14 11:47:37', '2026-02-14 11:47:37'),
(32, 'Post Edit', 'Chỉnh sửa bài viết', 'post.edit', '2026-02-14 11:48:00', '2026-02-14 11:48:00'),
(33, 'Post Destroy', 'Xóa bài viết', 'post.destroy', '2026-02-14 11:48:16', '2026-02-14 11:48:16'),
(34, 'Post View', 'Xem danh sách bài viết', 'post.view', '2026-02-14 11:48:40', '2026-02-14 11:48:40'),
(35, 'Page Manager', 'Quản lí trang', 'page.manager', '2026-02-14 11:49:11', '2026-02-14 11:49:11'),
(36, 'Page Create', 'Thêm trang', 'page.create', '2026-02-14 11:49:50', '2026-02-14 11:49:50'),
(37, 'Page Edit', 'Chỉnh sửa trang', 'page.edit', '2026-02-14 11:49:59', '2026-02-14 11:49:59'),
(38, 'Page Destroy', 'Xóa trang', 'page.destroy', '2026-02-14 11:50:13', '2026-02-14 11:50:13'),
(39, 'Page View', 'Xem danh sách trang', 'page.view', '2026-02-14 11:50:22', '2026-02-14 11:50:22'),
(40, 'Slider Manager', 'Quản lí slider', 'slider.manager', '2026-02-14 11:51:10', '2026-02-14 11:51:10'),
(41, 'Slider Create', 'Thêm slider', 'slider.create', '2026-02-14 11:51:28', '2026-02-14 11:51:28'),
(42, 'Slider Edit', 'Chỉnh sửa slider', 'slider.edit', '2026-02-14 11:51:47', '2026-02-14 11:51:47'),
(43, 'Slider Destroy', 'Xóa slider', 'slider.destroy', '2026-02-14 11:52:03', '2026-02-14 11:52:03'),
(44, 'Menu Manager', 'Quản lí Menu', 'menu.manager', '2026-02-14 11:52:42', '2026-02-14 11:52:42'),
(45, 'Menu Create', 'Thêm Menu', 'menu.create', '2026-02-14 11:52:59', '2026-02-14 11:52:59'),
(46, 'Menu Destroy', 'Xóa menu', 'menu.destroy', '2026-02-14 11:54:19', '2026-02-14 11:54:19'),
(47, 'Permission Manager', 'Quản lí quyền', 'permission.manager', '2026-02-14 11:54:58', '2026-02-14 11:55:53'),
(48, 'Role Manager', 'Quản lí vai trò', 'role.manager', '2026-02-14 11:56:24', '2026-02-14 11:56:24'),
(49, 'Admin', 'Quản lí toàn bộ hệ thống', 'admin.manager', '2026-02-14 13:24:22', '2026-02-14 13:25:03'),
(50, 'Website Manager', 'Quản lí giao diện website', 'website.manager', '2026-02-14 13:26:54', '2026-02-14 13:26:54');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `status` enum('publish','draft','pending','disable') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `user_id` bigint UNSIGNED NOT NULL,
  `img_id` bigint UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cat_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `desc`, `details`, `status`, `user_id`, `img_id`, `deleted_at`, `created_at`, `updated_at`, `slug`, `cat_id`) VALUES
(11, 'Ngũ cốc nguyên hạt – Cuộc cách mạng dinh dưỡng và \"Chìa khóa\" cho sức khỏe bền vững', 'Phân tích toàn diện về cấu trúc, lợi ích khoa học và cách xây dựng thực đơn với ngũ cốc nguyên hạt để phòng chống bệnh mãn tính.', 'Trong kỷ nguyên của thực phẩm chế biến sẵn, ngũ cốc nguyên hạt (Whole Grains) nổi lên như một vị cứu tinh cho sức khỏe hiện đại. Khác với ngũ cốc tinh chế đã bị tước bỏ lớp vỏ và mầm trong quá trình xay xát, ngũ cốc nguyên hạt giữ trọn vẹn giá trị sinh học của hạt giống.\r\n\r\nCấu trúc \"vàng\" của hạt ngũ cốc\r\nĐể hiểu tại sao chúng tốt, ta cần nhìn vào cấu tạo ba lớp:\r\n\r\nLớp Cám (Bran): Lớp vỏ ngoài cùng giàu chất xơ, chứa các khoáng chất như sắt, kẽm, đồng, magie và các vitamin nhóm B.\r\n\r\nMầm (Germ): Phần lõi nảy mầm, nơi tập trung các chất béo lành mạnh, Vitamin E, phytochemical và chất chống oxy hóa.\r\n\r\nNội nhũ (Endosperm): Phần chiếm diện tích lớn nhất, cung cấp tinh bột (năng lượng) và một lượng nhỏ protein.\r\n\r\nLợi ích đã được khoa học chứng minh\r\nViệc tiêu thụ 48-80g ngũ cốc nguyên hạt mỗi ngày giúp giảm 22% nguy cơ mắc bệnh tim mạch. Chất xơ hòa tan (đặc biệt là Beta-glucan trong yến mạch) tạo thành một lớp gel trong ruột, ngăn chặn sự hấp thụ cholesterol xấu (LDL) vào máu.\r\n\r\nBên cạnh đó, ngũ cốc nguyên hạt có chỉ số đường huyết (GI) thấp. Thay vì gây ra sự tăng vọt insulin như bánh mì trắng, chúng giải phóng năng lượng từ từ, giúp tuyến tụy hoạt động ổn định và ngăn ngừa tiểu đường tuýp 2. Đối với hệ tiêu hóa, chất xơ đóng vai trò là \"prebiotics\" – thức ăn cho lợi khuẩn, giúp duy trì hệ vi sinh đường ruột khỏe mạnh, ngăn ngừa ung thư đại trực tràng.\r\n\r\nCách đưa ngũ cốc nguyên hạt vào thực đơn\r\nThay đổi thói quen không khó nếu bạn bắt đầu từng bước:\r\n\r\nBữa sáng: Thay bánh mì trắng bằng yến mạch cán dẹt nấu với sữa hoặc làm \"Overnight oats\" (yến mạch ngâm qua đêm).\r\n\r\nBữa chính: Trộn gạo lứt, hạt kê hoặc hạt Diêm mạch (Quinoa) vào cơm trắng theo tỷ lệ 1:3 rồi tăng dần.\r\n\r\nBữa phụ: Sử dụng bỏng ngô nguyên hạt (ít muối đường) hoặc bánh quy lúa mạch nguyên cám.', 'publish', 25, 402, NULL, '2026-02-11 08:34:41', '2026-03-04 00:45:23', 'bai-viet/ngu-coc-nguyen-hat-cuoc-cach-mang-dinh-duong-va-chia-khoa-cho-suc-khoe-ben-vung', 7),
(12, 'Ngũ cốc và chỉ số đường huyết (GI): Bí mật đằng sau năng lượng bền bỉ', 'Giải thích cơ chế chuyển hóa năng lượng của ngũ cốc trong máu và cách lựa chọn các loại hạt giúp ổn định đường huyết, đặc biệt quan trọng cho người tập luyện và bệnh nhân tiểu đường.', 'Khám phá giá trị dinh dưỡng, lợi ích tuyệt vời và cách sử dụng hạt ngũ cốc, hạt sấy khô trong chế độ ăn uống hằng ngày để nâng cao sức khỏe toàn diện.\r\nTrong xu hướng sống lành mạnh ngày càng được quan tâm, hạt ngũ cốc và hạt sấy khô đã trở thành lựa chọn ưu tiên của nhiều gia đình nhờ hàm lượng dinh dưỡng cao, tiện lợi và phù hợp với nhiều chế độ ăn khác nhau. Hạt ngũ cốc bao gồm các loại như yến mạch, gạo lứt, lúa mạch, hạt chia, hạt quinoa và nhiều loại đậu giàu protein, trong đó yến mạch nổi bật nhờ khả năng hỗ trợ giảm cholesterol và cải thiện hệ tiêu hóa, còn gạo lứt lại chứa nhiều chất xơ và vitamin nhóm B giúp duy trì năng lượng bền vững. Một loại hạt khác được yêu thích trên toàn cầu là hạt chia, vốn giàu omega-3, chất chống oxy hóa và có khả năng hỗ trợ kiểm soát cân nặng hiệu quả. Bên cạnh đó, quinoa được xem là “siêu thực phẩm” vì chứa đầy đủ 9 axit amin thiết yếu, phù hợp cho cả người ăn chay lẫn người tập luyện thể thao. Không chỉ dừng lại ở ngũ cốc nguyên hạt, các loại hạt sấy khô như hạnh nhân, óc chó, hạt điều, macca hay nho khô cũng mang lại nguồn năng lượng dồi dào và chất béo tốt cho tim mạch; ví dụ hạnh nhân giàu vitamin E giúp làm đẹp da và chống lão hóa, trong khi óc chó lại nổi tiếng nhờ hàm lượng omega-3 cao hỗ trợ phát triển trí não và tăng cường trí nhớ. Ngoài ra, hạt điều cung cấp sắt, kẽm và magie giúp cải thiện sức khỏe xương khớp, còn macca được mệnh danh là “nữ hoàng của các loại hạt” nhờ lượng chất béo không bão hòa đơn cao, tốt cho hệ tim mạch. Điểm chung của hạt ngũ cốc và hạt sấy khô là giàu chất xơ, protein thực vật, vitamin và khoáng chất, đồng thời ít cholesterol, phù hợp với xu hướng ăn sạch, eat clean hay thực dưỡng. Việc bổ sung ngũ cốc nguyên hạt vào khẩu phần ăn hằng ngày có thể giúp ổn định đường huyết, hỗ trợ hệ tiêu hóa hoạt động trơn tru, giảm nguy cơ mắc bệnh tim mạch và tiểu đường type 2; chất xơ hòa tan trong yến mạch và lúa mạch giúp tạo cảm giác no lâu, hạn chế ăn vặt, từ đó hỗ trợ kiểm soát cân nặng hiệu quả. Trong khi đó, các loại hạt sấy khô tuy giàu năng lượng nhưng nếu sử dụng với lượng hợp lý sẽ cung cấp nguồn chất béo tốt, giúp giảm cholesterol xấu LDL và tăng cholesterol tốt HDL, đồng thời cung cấp chất chống oxy hóa bảo vệ tế bào khỏi tác động của gốc tự do. Không chỉ mang lại lợi ích về mặt thể chất, việc sử dụng hạt trong chế độ ăn còn góp phần nâng cao chất lượng cuộc sống khi người dùng cảm thấy cơ thể nhẹ nhàng, ít mệt mỏi và duy trì năng lượng ổn định suốt ngày dài. Ngày nay, hạt ngũ cốc và hạt sấy khô được ứng dụng đa dạng trong ẩm thực như làm sữa hạt, granola, thanh năng lượng, bánh healthy, salad hoặc đơn giản là dùng trực tiếp như món ăn vặt lành mạnh thay thế bánh kẹo nhiều đường; sữa từ yến mạch hoặc hạnh nhân đang trở thành lựa chọn thay thế sữa động vật cho người không dung nạp lactose hoặc theo chế độ thuần chay. Tuy nhiên, để tận dụng tối đa lợi ích dinh dưỡng, người tiêu dùng nên chọn sản phẩm nguyên chất, ít tẩm ướp gia vị, không thêm đường hoặc muối, đồng thời bảo quản nơi khô ráo, tránh ẩm mốc vì hạt chứa nhiều dầu tự nhiên dễ bị oxy hóa nếu tiếp xúc với không khí và nhiệt độ cao. Bên cạnh đó, cần lưu ý khẩu phần hợp lý, trung bình khoảng một nắm tay hạt mỗi ngày là đủ cung cấp dưỡng chất cần thiết mà không gây dư thừa năng lượng. Đối với trẻ em, người cao tuổi hay phụ nữ mang thai, việc bổ sung hạt trong thực đơn cần cân đối và tham khảo ý kiến chuyên gia dinh dưỡng để đảm bảo phù hợp với nhu cầu cơ thể. Có thể nói, trong bối cảnh con người ngày càng quan tâm đến sức khỏe và phòng ngừa bệnh tật từ sớm, hạt ngũ cốc và hạt sấy khô chính là giải pháp dinh dưỡng tự nhiên, tiện lợi và bền vững, không chỉ giúp cải thiện thể chất mà còn góp phần xây dựng lối sống tích cực, khoa học; việc duy trì thói quen sử dụng các loại hạt mỗi ngày, kết hợp cùng chế độ vận động hợp lý và nghỉ ngơi điều độ, sẽ tạo nên nền tảng vững chắc cho một cơ thể khỏe mạnh, tinh thần minh mẫn và chất lượng cuộc sống lâu dài.', 'publish', 25, 403, NULL, '2026-02-11 08:35:37', '2026-03-04 00:48:29', 'bai-viet/ngu-coc-va-chi-so-duong-huyet-gi-bi-mat-dang-sau-nang-luong-ben-bi', 7),
(13, 'Kích hoạt hạt ngũ cốc: Tại sao ngâm hạt là bước không thể bỏ qua?', 'Phân tích dưới góc độ sinh hóa về axit phytic và các enzyme trong hạt, hướng dẫn cách &amp;amp;amp;quot;đánh thức&amp;amp;amp;quot; giá trị dinh dưỡng tối đa trước khi chế biến.', 'Tự nhiên rất kỳ diệu, mỗi hạt ngũ cốc đều có một \"hệ thống tự vệ\" để ngăn nó không bị tiêu hóa bởi động vật trước khi có cơ hội nảy mầm. Hệ thống đó chính là Axit Phytic (chất kháng dinh dưỡng) và các chất ức chế enzyme. Nếu chúng ta ăn hạt trực tiếp mà không qua xử lý, Axit Phytic sẽ liên kết với canxi, magie, sắt và kẽm trong ruột, tạo thành các hợp chất khó tan và đào thải ra ngoài, khiến cơ thể bị thiếu hụt khoáng chất dù ăn rất nhiều.\r\n\r\nQuá trình ngâm hạt (soaking) chính là mô phỏng lại hiện tượng mưa trong tự nhiên, gửi tín hiệu \"đã đến lúc nảy mầm\" cho hạt. Lúc này, enzyme phytase được kích hoạt sẽ phá vỡ axit phytic, giải phóng các khoáng chất bị khóa chặt. Đồng thời, các protein phức tạp cũng được cắt nhỏ thành các axit amin dễ hấp thụ hơn. Việc ngâm hạt từ 6-12 tiếng (tùy loại) không chỉ giúp hạt nhanh chín, thơm ngon hơn mà còn giúp những người có hệ tiêu hóa nhạy cảm không còn bị đầy bụng, khó tiêu khi ăn các loại đậu hay hạt cứng.', 'publish', 25, 404, NULL, '2026-02-11 08:36:23', '2026-02-25 06:36:15', 'bai-viet/kich-hoat-hat-ngu-coc-tai-sao-ngam-hat-la-buoc-khong-the-bo-qua', 7),
(14, 'Thực đơn từ ngũ cốc: Giải pháp thay thế đạm động vật hoàn hảo', 'Bài viết tập trung vào hàm lượng protein trong các loại hạt ngũ cốc và đậu, cách kết hợp chúng để tạo ra nguồn đạm hoàn chỉnh cho người ăn chay hoặc muốn giảm thịt.', 'Một trong những hiểu lầm lớn nhất là cho rằng ngũ cốc chỉ cung cấp tinh bột. Thực tế, nhiều loại hạt là những kho chứa protein khổng lồ. Tuy nhiên, hầu hết ngũ cốc là \"protein không hoàn chỉnh\" vì thiếu một vài axit amin thiết yếu (như lysine). Bí quyết của những người ăn chay trường khỏe mạnh chính là quy tắc \"Ngũ cốc + Đậu = Protein hoàn chỉnh\".\r\n\r\nVí dụ, gạo thiếu lysine nhưng giàu methionine, trong khi các loại đậu thì ngược lại. Khi kết hợp gạo lứt với đậu đen, hoặc bánh mì nguyên cám với bơ đậu phộng, bạn sẽ nhận được một hồ sơ axit amin tương đương với thịt bò hay trứng. Hạt Quinoa (Diêm mạch) là một ngoại lệ hiếm hoi khi bản thân nó đã là một protein hoàn chỉnh. Việc chuyển dịch từ đạm động vật sang đạm thực vật từ ngũ cốc giúp giảm lượng chất béo bão hòa và kháng sinh tồn dư, đồng thời cung cấp thêm các hóa chất thực vật (phytonutrients) mà thịt không bao giờ có. Đây là xu hướng sống xanh bền vững cho cả cơ thể và môi trường.', 'publish', 25, 405, NULL, '2026-02-11 08:36:59', '2026-02-25 06:36:03', 'bai-viet/thuc-don-xanh-tu-ngu-coc-giai-phap-thay-the-dam-dong-vat-hoan-hao', 7),
(16, '5 Phút Thiền Mỗi Sáng Để Khởi Đầu Ngày Mới Tràn Đầy Năng Lượng', 'Bạn cảm thấy uể oải và căng thẳng khi vừa thức dậy? Chỉ với 5 phút thiền định đơn giản, bạn có thể tái tạo năng lượng và giữ tâm trí tỉnh táo suốt cả ngày dài.', 'Hạt dinh dưỡng giúp cung cấp protein và axit béo thiết yếu cho người theo đuổi lối sống thực vật.\r\nĐối với những người theo chế độ ăn chay hoặc thuần chay, việc đảm bảo đủ protein và dưỡng chất thiết yếu là điều vô cùng quan trọng, và các loại hạt chính là nguồn bổ sung lý tưởng. quinoa nổi bật vì chứa đầy đủ 9 axit amin thiết yếu, trong khi hạt chia lại giàu omega-3 hỗ trợ sức khỏe tim mạch và trí não. Bên cạnh đó, hạnh nhân và hạt điều cung cấp protein thực vật và khoáng chất quan trọng giúp duy trì khối cơ và tăng cường miễn dịch. Khi kết hợp đa dạng các loại hạt với rau củ, trái cây và ngũ cốc nguyên hạt, người ăn chay có thể xây dựng thực đơn cân bằng, giàu dinh dưỡng mà vẫn đảm bảo năng lượng cho hoạt động hàng ngày. Sự linh hoạt trong chế biến như làm sữa hạt, bơ hạt hay thêm vào món salad và sinh tố càng làm tăng tính hấp dẫn của nhóm thực phẩm này trong đời sống hiện đại.', 'publish', 25, 494, NULL, '2026-02-25 06:53:05', '2026-03-04 00:54:02', 'bai-viet/5-phut-thien-moi-sang-de-khoi-dau-ngay-moi-tran-day-nang-luong', 23),
(17, 'Sức Mạnh Từ Rau Củ', 'Tổng hợp các bí quyết giảm cân tự nhiên và lành mạnh thông qua chế độ ăn nhiều chất xơ.', 'Lựa chọn hạt sấy khô giúp bạn bổ sung năng lượng và dưỡng chất mà không lo dư thừa đường tinh luyện.\r\nThay vì tiêu thụ bánh kẹo hay đồ ăn nhanh nhiều đường và chất béo bão hòa, ngày càng nhiều người chuyển sang sử dụng hạt sấy khô như một giải pháp ăn vặt lành mạnh và tiện lợi. Các loại hạt như hạnh nhân, óc chó, hạt điều và macca cung cấp nguồn chất béo không bão hòa tốt cho tim mạch, đồng thời giàu protein thực vật và khoáng chất quan trọng như magie, kẽm và sắt. Nhờ hàm lượng chất xơ cao, hạt giúp tạo cảm giác no lâu, hạn chế cơn thèm ăn và hỗ trợ kiểm soát cân nặng. Đặc biệt, các chất chống oxy hóa trong hạnh nhân và óc chó còn giúp làm chậm quá trình lão hóa, bảo vệ làn da và tăng cường sức đề kháng. Tuy nhiên, để đạt hiệu quả tốt nhất, người dùng nên chọn sản phẩm không tẩm muối hoặc đường và sử dụng với lượng vừa phải, khoảng một nắm tay mỗi ngày, nhằm đảm bảo cân bằng năng lượng và dinh dưỡng.', 'publish', 25, 495, NULL, '2026-02-25 06:56:51', '2026-03-04 00:53:52', 'bai-viet/suc-manh-tu-rau-cu', 23),
(18, 'Bánh Quy Yến Mạch Chuối – Món Ăn Vặt &quot;Không Calo Dư Thừa&quot;', 'Chỉ với 2 nguyên liệu chính và không cần dùng đến đường hay bột mì, đây là công thức bánh quy hoàn hảo cho những ai đang thực hiện chế độ Eat Clean.', 'Trong bối cảnh con người ngày càng chú trọng đến sức khỏe và phòng ngừa bệnh tật từ sớm, hạt ngũ cốc đang dần khẳng định vai trò quan trọng trong khẩu phần ăn hàng ngày nhờ hàm lượng dinh dưỡng dồi dào và lợi ích lâu dài đối với cơ thể. Các loại ngũ cốc nguyên hạt như yến mạch, gạo lứt, lúa mạch và quinoa đều chứa lượng chất xơ cao giúp hỗ trợ tiêu hóa, ổn định đường huyết và kéo dài cảm giác no, từ đó góp phần kiểm soát cân nặng hiệu quả. Không chỉ giàu carbohydrate phức hợp cung cấp năng lượng bền vững, ngũ cốc nguyên hạt còn bổ sung vitamin nhóm B, sắt, magie và các chất chống oxy hóa giúp bảo vệ tế bào khỏi tác hại của gốc tự do. Khi duy trì thói quen sử dụng ngũ cốc thay cho tinh bột tinh chế, cơ thể sẽ giảm nguy cơ mắc bệnh tim mạch, tiểu đường type 2 và béo phì. Ngoài ra, việc chế biến ngũ cốc rất linh hoạt, có thể nấu cháo, làm cơm, trộn salad hoặc kết hợp cùng sữa chua và trái cây để tạo nên bữa ăn đầy đủ dưỡng chất, phù hợp với nhiều độ tuổi và phong cách ăn uống khác nhau, từ thực dưỡng đến eat clean.', 'publish', 25, 497, NULL, '2026-02-25 07:06:49', '2026-03-04 00:53:39', 'bai-viet/banh-quy-yen-mach-chuoi-mon-an-vat-khong-calo-du-thua', 15),
(19, 'Bánh Muffin Yến Mạch Sữa Chua – Bữa Sáng Tiện Lợi Cho Người Bận Rộn', 'Một món bánh mềm mịn, thơm ngon nhưng lại cực kỳ lành mạnh. Bạn có thể làm sẵn vào cuối tuần để chuẩn bị cho bữa sáng nhanh gọn suốt cả tuần.', 'Vì sao các sản phẩm từ hạt ngày càng phổ biến và được ưa chuộng trong cộng đồng sống xanh?\r\nCùng với sự phát triển của xu hướng sống xanh và ăn uống bền vững, các sản phẩm từ hạt như sữa hạt, bơ hạt và thanh năng lượng ngày càng được ưa chuộng. Sữa làm từ hạnh nhân, yến mạch hay macca không chỉ thơm ngon mà còn phù hợp với người không dung nạp lactose và người ăn chay. Bên cạnh đó, các loại ngũ cốc như quinoa và lúa mạch được ứng dụng rộng rãi trong chế biến thực phẩm chức năng và bữa ăn tiện lợi. Sự kết hợp giữa dinh dưỡng tự nhiên và tính tiện dụng đã giúp các sản phẩm từ hạt trở thành lựa chọn lý tưởng cho gia đình hiện đại. Khi người tiêu dùng ngày càng quan tâm đến sức khỏe lâu dài và nguồn gốc thực phẩm, hạt và ngũ cốc không chỉ đơn thuần là nguyên liệu mà còn đại diện cho phong cách sống khoa học, cân bằng và bền vững.', 'publish', 25, 498, NULL, '2026-02-25 07:08:29', '2026-03-04 00:53:00', 'bai-viet/banh-muffin-yen-mach-sua-chua-bua-sang-tien-loi-cho-nguoi-ban-ron', 15),
(20, 'Bánh Thanh Ngũ Cốc (Granola Bars) - Bữa Phụ Năng Lượng', 'Giải pháp hoàn hảo cho những lúc bận rộn, giúp bạn bổ sung năng lượng nhanh chóng mà không lo tăng cân.', 'Cách sử dụng hạt và ngũ cốc để giảm cân an toàn mà vẫn đảm bảo đủ chất dinh dưỡng.\r\nGiảm cân không đồng nghĩa với việc cắt giảm hoàn toàn tinh bột hay chất béo, mà quan trọng là lựa chọn nguồn thực phẩm phù hợp, và ngũ cốc nguyên hạt cùng hạt dinh dưỡng chính là giải pháp lý tưởng. Các loại như yến mạch và quinoa cung cấp carbohydrate phức hợp giúp giải phóng năng lượng chậm, duy trì cảm giác no lâu và hạn chế ăn quá mức. Trong khi đó, chất béo tốt từ macca hay hạt điều giúp cơ thể hấp thụ vitamin tan trong dầu và hỗ trợ chuyển hóa hiệu quả. Khi xây dựng thực đơn giảm cân, có thể thay cơm trắng bằng gạo lứt hoặc quinoa, bổ sung một ít hạt vào bữa phụ để tránh đói và giảm cảm giác thèm đồ ngọt. Điều quan trọng là cân đối khẩu phần và kết hợp vận động thường xuyên để đạt được kết quả bền vững, thay vì áp dụng chế độ ăn kiêng quá khắt khe gây thiếu hụt dinh dưỡng.', 'publish', 25, 499, NULL, '2026-02-25 07:15:38', '2026-03-04 00:52:27', 'bai-viet/banh-thanh-ngu-coc-granola-bars-bua-phu-nang-luong', 24),
(21, 'Bánh Mì Đen Nguyên Cám Từ Ngũ Cốc Đức', 'Loại bánh mì &quot;vàng&quot; cho người tiểu đường và ăn kiêng với kết cấu đặc biệt và hương vị đậm đà.', 'Ngày càng nhiều người nhận ra rằng vẻ đẹp bền vững bắt nguồn từ chế độ dinh dưỡng khoa học, và các loại hạt chính là “trợ thủ” đắc lực trong hành trình chăm sóc cơ thể từ bên trong. Những loại như hạt chia giàu omega-3 giúp giảm viêm và giữ ẩm cho da, hạnh nhân chứa nhiều vitamin E chống oxy hóa mạnh mẽ, hay óc chó hỗ trợ cải thiện độ đàn hồi của da đều đóng vai trò quan trọng trong việc duy trì làn da khỏe mạnh. Bên cạnh đó, các khoáng chất như kẽm và selen có trong hạt giúp tóc chắc khỏe và giảm gãy rụng, trong khi protein thực vật hỗ trợ tái tạo tế bào mới. Khi kết hợp hạt dinh dưỡng với chế độ uống đủ nước và ngủ nghỉ hợp lý, cơ thể sẽ được cung cấp nền tảng dưỡng chất cần thiết để tái tạo và phục hồi tự nhiên. Thay vì tìm kiếm các giải pháp làm đẹp tốn kém, việc duy trì thói quen sử dụng hạt mỗi ngày có thể mang lại hiệu quả lâu dài và an toàn cho sức khỏe tổng thể.', 'publish', 25, 500, NULL, '2026-02-25 07:16:26', '2026-03-04 00:52:19', 'bai-viet/banh-mi-den-nguyen-cam-tu-ngu-coc-duc', 24),
(22, 'Bánh Crepe Ngũ Cốc Mix Hoa Quả Tươi', 'Món bánh ăn sáng đẹp mắt, tinh tế và cực kỳ dễ làm từ bột ngũ cốc hỗn hợp.', 'Hạt sấy khô từ lâu đã được xem là món ăn vặt bổ dưỡng, cung cấp nguồn năng lượng tự nhiên và nhiều dưỡng chất thiết yếu cho cơ thể. Các loại hạt như hạnh nhân, óc chó, hạt điều và macca đều chứa hàm lượng chất béo không bão hòa cao, giúp bảo vệ tim mạch và giảm cholesterol xấu trong máu. Không chỉ vậy, chúng còn giàu protein thực vật, vitamin E, magie, kẽm và các chất chống oxy hóa, góp phần tăng cường hệ miễn dịch và làm chậm quá trình lão hóa. Đối với những người thường xuyên vận động hoặc làm việc trí óc căng thẳng, một nắm hạt sấy khô mỗi ngày có thể giúp bổ sung năng lượng nhanh chóng mà không gây tăng đường huyết đột ngột như bánh kẹo ngọt. Ngoài việc ăn trực tiếp, hạt sấy khô còn được sử dụng để làm sữa hạt, xay thành bơ hạt hoặc kết hợp trong các món bánh healthy, salad và granola. Tuy nhiên, để đảm bảo lợi ích tối đa, người tiêu dùng nên lựa chọn sản phẩm không tẩm ướp muối hoặc đường, đồng thời kiểm soát khẩu phần hợp lý để tránh dư thừa calo.', 'publish', 25, 501, NULL, '2026-02-25 07:17:10', '2026-03-04 00:52:08', 'bai-viet/banh-crepe-ngu-coc-mix-hoa-qua-tuoi', 24),
(23, 'Ngũ Cốc Nguyên Hạt – Nền Tảng Vàng Cho Chế Độ Ăn Lành Mạnh Hiện Đại', 'Khám phá vai trò của ngũ cốc nguyên hạt trong việc bảo vệ sức khỏe tim mạch, kiểm soát cân nặng và duy trì năng lượng bền vững mỗi ngày.', 'Trong nhịp sống bận rộn ngày nay, việc xây dựng một chế độ ăn uống cân bằng và giàu dinh dưỡng trở thành ưu tiên hàng đầu của nhiều người, và ngũ cốc nguyên hạt chính là một trong những nhóm thực phẩm quan trọng giúp đáp ứng nhu cầu đó. Không giống như ngũ cốc tinh chế đã bị loại bỏ lớp cám và mầm, ngũ cốc nguyên hạt giữ lại trọn vẹn giá trị dinh dưỡng tự nhiên bao gồm chất xơ, vitamin, khoáng chất và các hợp chất chống oxy hóa có lợi cho cơ thể. Những loại phổ biến có thể kể đến như yến mạch, gạo lứt, lúa mạch và quinoa, mỗi loại đều mang lại lợi ích riêng biệt nhưng cùng chung đặc điểm là giàu chất xơ hỗ trợ tiêu hóa và giúp duy trì cảm giác no lâu. Khi bổ sung ngũ cốc nguyên hạt vào bữa sáng hoặc bữa phụ, cơ thể sẽ được cung cấp nguồn năng lượng ổn định, tránh tình trạng tăng giảm đường huyết đột ngột, từ đó hạn chế cảm giác mệt mỏi và thèm ăn. Ngoài ra, các nghiên cứu dinh dưỡng đã chỉ ra rằng chế độ ăn giàu ngũ cốc nguyên hạt có thể làm giảm nguy cơ mắc bệnh tim mạch, tiểu đường type 2 và béo phì nhờ khả năng cải thiện cholesterol và hỗ trợ kiểm soát cân nặng hiệu quả. Việc chế biến ngũ cốc cũng vô cùng linh hoạt, có thể nấu cháo, làm cơm, trộn salad hoặc kết hợp với sữa chua và trái cây để tạo nên bữa ăn đầy đủ dưỡng chất. Chính nhờ sự tiện lợi và giá trị lâu dài đối với sức khỏe mà ngũ cốc nguyên hạt ngày càng được ưa chuộng trong cộng đồng những người theo đuổi lối sống eat clean và thực dưỡng.Tìm hiểu lợi ích của các loại hạt sấy khô đối với tim mạch, trí não và sắc đẹp trong chế độ ăn hàng ngày.', 'publish', 25, 502, NULL, '2026-02-25 07:18:31', '2026-03-04 00:52:38', 'bai-viet/ngu-coc-nguyen-hat-nen-tang-vang-cho-che-do-an-lanh-manh-hien-dai', 24);

-- --------------------------------------------------------

--
-- Table structure for table `post_categories`
--

CREATE TABLE `post_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','unactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_categories`
--

INSERT INTO `post_categories` (`id`, `parent_id`, `name`, `slug`, `status`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 'Ăn kiêng và giảm cân', 'bai-viet/an-kieng-va-giam-can', 'active', 25, '2026-02-10 04:37:40', '2026-02-28 17:45:55', NULL),
(5, 0, 'Món ngon với ngũ cốc', 'bai-viet/mon-ngon-voi-ngu-coc', 'active', 25, '2026-02-10 04:38:35', '2026-02-28 17:45:54', NULL),
(7, 1, 'Thực đơn Eat Clean với ngũ cốc', 'bai-viet/thuc-don-eat-clean-voi-ngu-coc', 'active', 25, '2026-02-10 04:39:04', '2026-02-25 06:48:28', NULL),
(8, NULL, 'Cách tính calo trong các loại hạt', 'bai-viet/cach-tinh-calo-trong-cac-loai-hat', 'unactive', 25, '2026-02-10 04:39:12', '2026-02-24 07:28:30', '2026-02-24 07:28:30'),
(15, 5, 'Làm bánh từ yến mạch', 'bai-viet/lam-banh-tu-yen-mach', 'active', 25, '2026-02-10 04:40:20', '2026-02-12 03:58:49', NULL),
(16, NULL, 'Salad trộn hạt dinh dưỡng', 'bai-viet/salad-tron-hat-dinh-duong', 'unactive', 25, '2026-02-10 04:40:29', '2026-02-24 07:28:26', '2026-02-24 07:28:26'),
(19, 0, 'Kiến thức về dinh dưỡng', 'bai-viet/kien-thuc-ve-dinh-duong', 'active', 25, '2026-02-25 06:15:31', '2026-02-25 06:18:50', NULL),
(20, 0, 'Chế độ luyện tập', 'bai-viet/che-do-luyen-tap', 'active', 25, '2026-02-25 06:16:12', '2026-02-25 06:18:57', NULL),
(21, 0, 'Review thực phẩm sạch', 'bai-viet/review-thuc-pham-sach', 'active', 25, '2026-02-25 06:16:26', '2026-02-25 06:19:04', NULL),
(22, 0, 'Sống khỏe', 'bai-viet/song-khoe', 'active', 25, '2026-02-25 06:16:35', '2026-02-25 06:19:10', NULL),
(23, 1, 'Sức khỏe tinh thần', 'bai-viet/suc-khoe-tinh-than', 'active', 25, '2026-02-25 06:50:55', '2026-02-25 06:50:55', NULL),
(24, 5, 'Làm bánh từ ngũ cốc', 'bai-viet/lam-banh-tu-ngu-coc', 'active', 25, '2026-02-25 06:58:08', '2026-02-25 06:58:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `up_sale` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `status` enum('active','unactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `disscount` int DEFAULT '0',
  `details` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint UNSIGNED NOT NULL,
  `cat_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `img_id` bigint UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `sold_count` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `desc`, `price`, `quantity`, `slug`, `up_sale`, `status`, `disscount`, `details`, `user_id`, `cat_id`, `created_at`, `updated_at`, `img_id`, `deleted_at`, `sold_count`) VALUES
(11, 'ori#001', 'Hạt Điều Rang Muối Vỏ Lụa', 'Giòn tan vị đậm đà tự nhiên', 150000, 92, 'san-pham/hat-dieu-rang-muoi-vo-lua', 'no', 'active', 20, 'Thông tin chi tiết sản phẩm...', 25, 95, '2026-02-08 08:14:54', '2026-03-01 13:19:49', 236, NULL, 1),
(12, 'ori#002', 'Hạnh Nhân Rang Bơ Mỹ', 'Hạnh nhân nhập khẩu Mỹ', 185000, 44, 'san-pham/hanh-nhan-rang-bo-my', 'no', 'active', 30, 'Thông tin chi tiết sản phẩm...', 25, 77, '2026-02-08 08:16:23', '2026-03-04 12:29:38', 237, NULL, 1),
(13, 'ori#003', 'Hạt Dẻ Cười Hy Lạp', 'Hạt dẻ cười không tẩy trắng', 220000, 76, 'san-pham/hat-de-cuoi-khong-tay-trang', 'no', 'active', 10, 'Thông tin chi tiết sản phẩm...', 25, 78, '2026-02-08 08:17:23', '2026-03-01 13:19:05', 238, NULL, 1),
(14, 'ori#004', 'Hạt Dẻ Nứt Vỏ Tây Nguyên', 'Nữ hoàng các loại hạt', 195000, 91, 'san-pham/hat-macca-nut-vo-tay-nguyen', 'no', 'active', 15, 'Thông tin chi tiết sản phẩm...', 25, 78, '2026-02-08 08:18:36', '2026-03-01 13:19:49', 239, NULL, 1),
(15, 'ori#005', 'Hạt Nhân Bóc Vỏ', 'Hạt bí xanh nguyên vị', 135000, 50, 'san-pham/hat-nhan-boc-vo', 'yes', 'active', 0, 'Thông tin chi tiết sản phẩm...', 25, 77, '2026-02-08 08:20:43', '2026-02-25 03:24:11', 240, NULL, NULL),
(39, 'ori#123456', 'aaaaaaaaa', 'aaaaaaaaa', 1990000, 1000, 'san-pham/aaaaaaaaa', 'no', 'unactive', NULL, 'Thông tin chi tiết sản phẩm...', 61, 79, '2026-02-14 12:51:15', '2026-02-15 04:55:41', 415, '2026-02-15 04:55:41', NULL),
(40, 'ori#6454', 'Nho khô xanh Green Raisins', 'Gói màu xanh lá mạ toàn phần, nho khô dài, vị ngọt thanh.', 150000, 100, 'san-pham/nho-kho-xanh-green-raisins', 'no', 'unactive', NULL, 'Thông tin chi tiết sản phẩm...', 25, 81, '2026-02-21 10:39:31', '2026-02-25 04:28:18', 421, NULL, NULL),
(41, 'ori#123489', 'Hạt điều rang muối', 'Gói màu xanh dương đậm phối trắng, hạt điều nguyên hạt cỡ lớn.', 280000, 100, 'san-pham/hat-dieu-rang-muoi', 'yes', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 95, '2026-02-21 10:40:21', '2026-02-25 03:14:03', 422, NULL, NULL),
(42, 'ori#4846', 'Hạt Dẻ Pislachios', 'Gói màu trắng, nhãn vàng/xanh. Hạt dẻ cười rang muối còn vỏ.', 140000, 94, 'san-pham/hat-de-pislachios', 'yes', 'active', 0, 'Thông tin chi tiết sản phẩm...', 25, 78, '2026-02-21 10:41:38', '2026-03-01 14:12:48', 423, NULL, 1),
(43, 'ori#54654', 'Hạt điều vị tỏi ớt phô mai', 'Gói màu tím trắng, thường là dòng hạt điều đã qua tẩm ướp gia vị.', 270000, 82, 'san-pham/hat-dieu-vi-toi-ot-pho-mai', 'yes', 'active', 0, 'Thông tin chi tiết sản phẩm...', 25, 95, '2026-02-21 10:42:45', '2026-03-05 13:44:49', 424, NULL, 1),
(44, 'ori#54568', 'Hạt dẻ Okini', 'Gói thường có xanh rực rỡ. Quả mọng sấy khô, vị chua ngọt, rất tốt cho hệ tiêu hóa và làm đẹp da.', 250000, 100, 'san-pham/hat-de-okini', 'yes', 'active', 0, 'Thông tin chi tiết sản phẩm...', 25, 78, '2026-02-21 10:54:01', '2026-02-25 03:28:02', 426, NULL, NULL),
(45, 'ori#4268', 'Hạt hỗn hợp cao cấp', 'Gói thường có màu đen hoặc vàng kim. Kết hợp giữa hạt điều, hạnh nhân, óc chó và đôi khi có thêm macca.', 280000, 74, 'san-pham/hat-hon-hop-cao-cap', 'yes', 'active', 30, 'Thông tin chi tiết sản phẩm...', 25, 81, '2026-02-21 10:58:39', '2026-03-05 13:44:49', 427, NULL, 1),
(46, 'ori#5682', 'Hạt điều sữa', 'Dòng hạt điều cao cấp nhất trong bộ sưu tập', 280000, 95, 'san-pham/hat-dieu-sua', 'no', 'active', 50, 'Thông tin chi tiết sản phẩm...', 25, 95, '2026-02-21 11:00:49', '2026-03-01 13:19:49', 428, NULL, 1),
(47, 'ori#54465', 'Hạt Óc Chó Nguyên Vị', 'Hạt óc chó tách vỏ giàu Omega 3 hỗ trợ sức khỏe não bộ', 180000, 100, 'san-pham/hat-oc-cho-nguyen-vi', 'no', 'unactive', NULL, 'Thông tin chi tiết sản phẩm...', 25, 78, '2026-02-22 03:49:22', '2026-02-25 03:26:30', 429, '2026-02-25 03:26:30', NULL),
(48, 'ori#54684', 'Nhân Hạt Óc Chó Vàng', 'Phần nhân óc chó đã được làm sạch, tiện lợi để ăn ngay hoặc làm sữa.', 140000, 8, 'san-pham/nhan-hat-oc-cho-vang', 'no', 'unactive', NULL, 'Thông tin chi tiết sản phẩm...', 25, 78, '2026-02-22 03:50:15', '2026-02-25 03:26:30', 430, '2026-02-25 03:26:30', NULL),
(49, 'ori#546412', 'Mixed Nuts hỗn hợp', 'Sự kết hợp của hạnh nhân, hạt điều, óc chó và hạt bí.', 220000, 100, 'san-pham/mixed-nuts-hon-hop', 'no', 'active', NULL, '<p>Th&ocirc;ng tin chi tiết sản phẩm...</p>', 25, 81, '2026-02-22 03:51:27', '2026-03-04 01:40:32', 431, NULL, 1),
(50, 'ori#6423', 'Hạnh Nhân Tách Vỏ', 'Hạnh nhân nguyên chất, không gia vị, phù hợp cho người ăn kiêng.', 190000, 100, 'san-pham/hanh-nhan-tach-vo', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 77, '2026-02-22 03:52:20', '2026-02-25 03:15:18', 432, NULL, NULL),
(51, 'ori#44444', 'Granola Ngũ Cốc', 'Hỗn hợp yến mạch, hạt và trái cây khô dùng cho bữa sáng.', 150000, 0, 'san-pham/granola-ngu-coc', 'no', 'active', NULL, '<p>Th&ocirc;ng tin chi tiết sản phẩm...</p>', 25, 81, '2026-02-22 03:53:32', '2026-03-05 11:34:46', 433, NULL, 1),
(52, 'ori#549856', 'Hạnh Nhân Rang Muối', 'Hạnh nhân California giòn rụm, vị mặn nhẹ đặc trưng.', 160000, 9, 'san-pham/hanh-nhan-rang-muoi', 'no', 'active', NULL, '<p>Th&ocirc;ng tin chi tiết sản phẩm...</p>', 25, 77, '2026-02-22 03:54:20', '2026-03-02 11:20:24', 434, NULL, NULL),
(53, 'ori#0054', 'Hộp Quà Sweet Berry Dry Fruit Cao Cấp', 'Hộp quà Sweet Berry Dry Fruit cao cấp gồm các loại hạt và trái cây sấy tự nhiên, được tuyển chọn kỹ lưỡng.  Sản phẩm được đóng gói sang trọng, thích hợp làm quà tặng lễ Tết, sinh nhật hoặc biếu tặng đối tác.', 599000, 7, 'san-pham/hop-qua-sweet-berry-dry-fruit-cao-cap', 'no', 'active', NULL, '<p>Th&ocirc;ng tin chi tiết sản phẩm...</p>', 25, 79, '2026-02-24 11:53:47', '2026-03-01 05:41:34', 439, NULL, NULL),
(54, 'ori#5645623', 'Hộp Quà Hạt Dinh Dưỡng Luxury Box', 'Hộp quà hạt dinh dưỡng cao cấp, thiết kế sang trọng, phù hợp làm quà biếu đối tác và người thân.', 399000, 50, 'san-pham/hop-qua-hat-dinh-duong-luxury-box', 'no', 'active', 0, 'Thông tin chi tiết sản phẩm...', 25, 79, '2026-02-24 12:00:48', '2026-02-24 12:36:12', 440, NULL, NULL),
(55, 'ori#59645', 'Hộp Quà Tết Hạt Trái Cây Sấy Gold', 'Hộp quà Tết cao cấp kết hợp hạt và trái cây sấy, thiết kế hộp sang trọng tông vàng đỏ may mắn.', 899000, 9, 'san-pham/hop-qua-tet-hat-trai-cay-say-gold', 'no', 'active', NULL, '<p>Th&ocirc;ng tin chi tiết sản phẩm...</p>', 25, 79, '2026-02-24 12:03:06', '2026-03-01 05:41:18', 441, NULL, NULL),
(56, 'ori#4855', 'Hộp Quà Sweet Mix Premium Selection', 'Hộp quà Sweet Mix kết hợp bánh kẹo nhập khẩu và hạt dinh dưỡng, thiết kế hiện đại, thích hợp làm quà tặng dịp lễ.', 749000, 45, 'san-pham/hop-qua-sweet-mix-premium-selection', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 79, '2026-02-24 12:08:01', '2026-02-24 12:08:01', 442, NULL, NULL),
(57, 'ori#8888', 'Hộp Quà Hạnh Phúc Phiên Bản Giới Hạn', 'Hộp quà hạt dinh dưỡng cao cấp nhập khẩu, tuyển chọn kỹ lưỡng, giữ nguyên hương vị tự nhiên, không phẩm màu, không chất bảo quản.', 499000, 5, 'san-pham/hop-qua-hanh-phuc', 'no', 'active', 0, '<p>Th&ocirc;ng tin chi tiết sản phẩm...</p>', 25, 79, '2026-02-24 12:10:16', '2026-03-01 05:41:04', 443, NULL, NULL),
(58, 'ori#96542', 'Set Quà Ngũ Phúc Lâm Môn', 'Hộp quà hình chữ nhật chia làm 5 ngăn tượng trưng cho sự may mắn và trọn vẹn. Thường đi kèm thiệp chúc mừng và túi giấy đồng bộ.', 600000, 20, 'san-pham/set-qua-ngu-phuc-lam-mon', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 94, '2026-02-25 03:00:23', '2026-02-25 03:09:07', 444, NULL, NULL),
(59, 'ori#65428', 'Quà Sức Khỏe Xanh', 'Thiết kế hộp giấy kraft thân thiện với môi trường. Bên trong gồm các loại hạt cơ bản, đóng gói trong hũ thủy tinh nhỏ xinh.', 350000, 30, 'san-pham/qua-suc-khoe-xanh', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 94, '2026-02-25 03:01:35', '2026-02-25 03:09:12', 445, NULL, NULL),
(60, 'ori#654833', 'Set Quà Vị Tết Đoàn Viên', 'Phù hợp để biếu tặng đối tác hoặc trưng bày phòng khách.', 700000, 20, 'san-pham/set-qua-vi-tet-doan-vien', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 94, '2026-02-25 03:02:46', '2026-02-25 03:07:44', 446, NULL, NULL),
(61, 'ori#85641', 'Hộp Quà Hạt Tẩm Vị Gourment', 'Phù hợp để tặng người thân vào các dịp lễ', 499000, 20, 'san-pham/hop-qua-hat-tam-vi-gourment', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 94, '2026-02-25 03:04:36', '2026-02-25 03:07:39', 447, NULL, NULL),
(62, 'ori#45863223', 'Giỏ Quà Luxury Nut', 'Hạt dinh dưỡng, phù hợp tặng cho người thân vào các dịp Lễ', 700000, 30, 'san-pham/gio-qua-luxury-nut', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 94, '2026-02-25 03:05:47', '2026-02-25 03:07:32', 448, NULL, NULL),
(63, 'ori#456489', 'Hạt Điều Rang Muối Đã Lột Vỏ', 'Đây là dòng sản phẩm giữ được hương vị nguyên bản nhất. Lớp vỏ lụa giúp hạt điều giữ được độ giòn lâu và vị ngọt bùi tự nhiên, không bị quá mặn.', 120000, 40, 'san-pham/hat-dieu-rang-muoi-da-lot-vo', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 95, '2026-02-25 03:20:17', '2026-02-25 03:20:17', 449, NULL, NULL),
(64, 'ori#8422', 'Hạnh Nhân Rang Bơ', 'Hạt hạnh nhân còn lớp vỏ mỏng bên ngoài, được rang cùng bơ thơm lừng. Khi ăn có vị béo ngậy, ngọt nhẹ', 220000, 57, 'san-pham/hanh-nhan-rang-bo', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 77, '2026-02-25 03:31:23', '2026-03-01 13:19:05', 450, NULL, 1),
(65, 'ori#85423', 'Hạt Dẻ Rang Muối', 'Hạt giàu dinh dưỡng kết hợp chút vị mặn nhẹ', 240000, 40, 'san-pham/hat-de-rang-muoi', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 78, '2026-02-25 03:35:01', '2026-02-25 03:35:01', 451, NULL, NULL),
(66, 'ori#842684', 'Mixed Nuts Siêu Hạt', 'Sự kết hợp của các loại hạt cao cấp đã bóc vỏ, không gia vị hoặc rang mộc. Thường xuất hiện trong các bao bì tối màu', 210000, 12, 'san-pham/mixed-nuts-sieu-hat', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 81, '2026-02-25 03:49:47', '2026-03-01 07:24:42', 453, NULL, 1),
(67, 'ori#5215', 'Fruit And Nut Mix', 'Dòng sản phẩm phổ biến nhất (giống các gói màu hồng và trắng trong hình), cân bằng giữa vị bùi của hạt và vị chua ngọt của trái cây.', 180000, 60, 'san-pham/fruit-and-nut-mix', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 82, '2026-02-25 03:50:47', '2026-02-25 03:50:47', 454, NULL, NULL),
(68, 'ori#52326', 'Original Mix', 'hường đóng gói trong túi giấy kraft hoặc bao bì xanh lá (giống gói ở giữa hình). Đây là hỗn hợp dành cho người đi dã ngoại hoặc ăn vặt văn phòng.', 80000, 50, 'san-pham/original-mix', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 82, '2026-02-25 03:51:22', '2026-02-25 03:51:22', 455, NULL, NULL),
(69, 'ori#87456', 'Hộp Quà Mix Hạt Tự Nhiên', 'Sản phẩm được đóng trong hộp giấy có cửa sổ kính (giống mẫu thứ 3 từ trái sang), nhìn thấy rõ các loại hạt xếp lớp bên trong.', 300000, 37, 'san-pham/hop-qua-mix-hat-tu-nhien', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 82, '2026-02-25 03:52:21', '2026-03-01 07:24:42', 456, NULL, 1),
(70, 'ori#42258', 'Gourmet Medley', 'Các dòng túi đứng (stand-up pouch) với thiết kế rực rỡ, thường là hạt nhập khẩu được tuyển chọn kỹ về kích cỡ.', 350000, 60, 'san-pham/gourmet-medley', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 82, '2026-02-25 03:52:55', '2026-02-25 03:52:55', 457, NULL, NULL),
(71, 'ori#65425', 'Hạt Mix Hạt Dinh Dưỡng', 'Sự kết hợp hoàn hảo giữa hạt điều, hạnh nhân, óc chó, macca, hạt bí, nho khô và nam việt quất', 250000, 37, 'san-pham/hat-mix-hat-dinh-duong', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 81, '2026-02-25 03:54:35', '2026-03-01 07:24:41', 458, NULL, 1),
(72, 'ori#8452', 'Hạt Mix Vị Ngọt Tự Nhiên', 'Gồm các loại hạt mix cùng chà là Thái Lan và sung sấy Thổ Nhĩ Kỳ', 480000, 50, 'san-pham/hat-mix-vi-ngot-tu-nhien', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 82, '2026-02-25 03:55:26', '2026-02-25 03:55:26', 459, NULL, NULL),
(73, 'ori#965428', 'Thanh Hạt Dinh Dưỡng Socola Bar', 'Hỗn hợp các loại hạt như hạnh nhân, đậu phộng, hạt điều được kết hợp với mật ong hoặc socola, nén thành thanh tiện lợi cho một lần sử dụng', 30000, 47, 'san-pham/thanh-hat-dinh-duong-energy-bar', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 96, '2026-02-25 04:05:42', '2026-03-01 12:42:54', 460, NULL, 1),
(74, 'ori#52379', 'Snack Hạt Mix Trái Cây Đóng Túi Nhỏ', 'Các loại hạt (hạnh nhân, óc chó, bí xanh) mix cùng trái cây khô (nho, việt quất) được chia sẵn vào từng túi nhỏ 25g - 30g', 25000, 47, 'san-pham/snack-hat-mix-trai-cay-dong-tui-nho', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 96, '2026-02-25 04:07:57', '2026-03-01 12:42:54', 461, NULL, 1),
(75, 'ori#86521', 'Thanh Hạt Ngũ Cốc Nhiều Vị Trong Một', 'Nếu bạn không thích ngọt, đây là lựa chọn tuyệt vời với các loại hạt giòn tan kết hợp cùng gạo lứt huyết rồng và chà bông (ruốc) đậm đà. Ăn rất cuốn và không bị ngán.', 20000, 50, 'san-pham/thanh-hat-ngu-coc-nhieu-vi', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 96, '2026-02-25 04:09:17', '2026-02-25 04:09:36', 462, NULL, NULL),
(76, 'ori#69752', 'Thạnh Hạt Ngũ Cốc Vị Nguyên Bản', 'Dòng snack hạt tổng hợp (giống các túi màu hồng/đen trong hình) bao gồm các loại hạt thượng hạng đã bóc vỏ lụa, rang mộc để giữ độ giòn tự nhiên và vị béo ngậy nguyên bản.', 40000, 47, 'san-pham/trail-mix-gourmet-bar', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 96, '2026-02-25 04:10:54', '2026-03-01 12:42:54', 463, NULL, 1),
(77, 'ori#846949', 'Thanh Hạt Nhiều Vị Trái Cây Trong Một', 'Thanh hạt nhiều vị trái cây thích hợp cho các chuyến đi nhỏ', 50000, 50, 'san-pham/thanh-hat-nhieu-vi-trai-cay', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 96, '2026-02-25 04:13:04', '2026-02-25 04:15:46', 464, NULL, NULL),
(78, 'ori#745659', 'Túi Hạt Tẩm Vị Nhỏ Hỗn Hợp', 'Sản phẩm được chia sẵn thành từng túi nhỏ theo khẩu phần hàng ngày', 35000, 20, 'san-pham/tui-hat-tam-vi-nho-hon-hop', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 97, '2026-02-25 04:21:25', '2026-02-25 04:21:25', 467, NULL, NULL),
(79, 'ori#745852', 'Túi Mixed Nuts Túi Zip', 'Hỗn hợp các loại hạt thượng hạng đã bóc vỏ (Macca, hạt dẻ cười, óc chó) đựng trong túi zip sang trọng có cửa sổ bóng kính', 70000, 57, 'san-pham/tui-mixed-nuts-tui-zip', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 97, '2026-02-25 04:22:35', '2026-03-01 12:42:54', 468, NULL, 1),
(80, 'ori#741656', 'Túi Hạt Sấy Khô Theo Loại', 'Túi hạt được đóng trong túi zip đảm bảo kín khí, bảo quản tốt, để lâu ngày', 50000, 47, 'san-pham/tui-hat-say-kho-theo-loai', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 97, '2026-02-25 04:23:53', '2026-03-01 12:42:54', 469, NULL, 1),
(81, 'ori#74156', 'Túi Hạt Và Trái Cấy Mix Tiện Lợi', 'Sản phẩm được chia sẵn thành từng túi nhỏ theo khẩu phần hàng ngày', 45000, 40, 'san-pham/tui-hat-va-trai-cay-mix-tien-loi', 'no', 'active', NULL, '<p>Th&ocirc;ng tin chi tiết sản phẩm...</p>', 25, 97, '2026-02-25 04:24:56', '2026-03-01 06:11:08', 470, NULL, NULL),
(82, 'ori#485743', 'Túi Hạt Macca Sữa Chua Sấy Đóng Gói', 'Một sự kết hợp thú vị giữa các loại hạt sấy giòn và các viên sữa chua sấy thăng hoa cùng dâu tây dẻo. Sản phẩm có vị chua nhẹ', 60000, 50, 'san-pham/tui-hat-macca-sua-chua-say-dong-goi', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 97, '2026-02-25 04:26:59', '2026-02-25 04:26:59', 471, NULL, NULL),
(83, 'ori#865423', 'Xoài Sấy Dẻo Thượng Hạng', 'Được làm từ những quả xoài cát chín cây, sấy dẻo theo công nghệ hiện đại giữ trọn vị ngọt thanh và hương thơm tự nhiên. Miếng xoài dày, dẻo, không xơ, bao bì túi giấy kraft thân thiện với môi trường.', 120000, 50, 'san-pham/xoai-say-deo-thuong-hang', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 98, '2026-02-25 04:34:07', '2026-02-25 04:34:07', 472, NULL, NULL),
(84, 'ori#748945', 'Xoài Sấy Giòn Tan Rồm Rộp', 'Khác với dòng sấy dẻo, đây là xoài được sấy thăng hoa giúp miếng xoài giòn tan như snack nhưng vẫn giữ được màu vàng tươi và vitamin. Vị chua ngọt bùng nổ ngay khi chạm vào đầu lưỡi.', 65000, 50, 'san-pham/xoai-say-gion-tan', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 98, '2026-02-25 04:34:53', '2026-02-25 04:34:53', 473, NULL, NULL),
(85, 'ori#74562', 'Xoài Cắt Lát Xuất Khẩu', 'Sản phẩm tuyển chọn những lát xoài đẹp nhất, kích thước đồng đều, đạt tiêu chuẩn xuất khẩu. Bao bì thiết kế tối giản, tinh tế, rất phù hợp để đưa vào các set quà tặng cao cấp.', 130000, 50, 'san-pham/mango-slices-xoai-cat-lat-xuat-khau', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 98, '2026-02-25 04:35:28', '2026-02-25 04:37:07', 474, NULL, NULL),
(86, 'ori#644725', 'Xoài Sấy Dẻo Không Đường', 'Dòng sản phẩm dành riêng cho người ăn kiêng hoặc thích vị nguyên bản. Xoài được sấy tự nhiên 100%, hoàn toàn không thêm đường hay chất bảo quản, giữ nguyên vị chua nhẹ đặc trưng của xoài tự nhiên.', 95000, 50, 'san-pham/xoai-say-deo-natural-khong-duong', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 98, '2026-02-25 04:36:10', '2026-02-25 04:37:18', 475, NULL, NULL),
(87, 'ori#748942', 'Snack Xoài Sấy Dẻo Vị Muối Ớt', 'Một sự kết hợp độc đáo giữa vị ngọt của xoài sấy và vị cay mặn của muối ớt chuẩn vị Việt Nam. Đây là món snack cực kỳ \"bắt miệng\", phù hợp cho giới trẻ và dân văn phòng.', 45000, 50, 'san-pham/snack-xoai-say-deo-vi-muoi-ot', 'no', 'active', NULL, 'Thông tin chi tiết sản phẩm...', 25, 98, '2026-02-25 04:36:44', '2026-02-25 04:36:44', 476, NULL, NULL),
(88, 'ori#748232', 'Mít Thái Sấy Giòn', 'Được làm từ những múi mít Thái chín vàng, sấy chân không giúp giữ nguyên màu sắc tự nhiên và độ giòn tan. Vị ngọt đậm đà, thơm lừng đặc trưng, không chứa chất bảo quản.', 65000, 50, 'san-pham/mit-thai-say-gion', 'no', 'active', NULL, '<div class=\"container\">\r\n<div id=\"model-response-message-contentr_c67addcc28564745\" class=\"markdown markdown-main-panel stronger enable-updated-hr-color preserve-whitespaces-in-response\" dir=\"ltr\" style=\"line-height: 2;\" aria-live=\"polite\" aria-busy=\"false\">\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"2\"><strong>1. Th&agrave;nh phần</strong></h3>\r\n<ul data-path-to-node=\"3\">\r\n<li>\r\n<p data-path-to-node=\"3,0,0\">Cỏ ngọt nguy&ecirc;n chất (100%): Được chiết xuất từ l&aacute; c&acirc;y cỏ ngọt (<em data-path-to-node=\"3,0,0\" data-index-in-node=\"63\">Stevia rebaudiana</em>) tự nhi&ecirc;n, kh&ocirc;ng pha trộn đường k&iacute;nh hay tạp chất.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,1,0\">Đặc điểm: Chứa hoạt chất Stevioside tạo vị ngọt tự nhi&ecirc;n gấp 300 lần đường saccarose nhưng <strong data-path-to-node=\"3,1,0\" data-index-in-node=\"91\">kh&ocirc;ng chứa calo</strong>.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,2,0\">Cam kết: Kh&ocirc;ng chất bảo quản, kh&ocirc;ng hương liệu nh&acirc;n tạo v&agrave; kh&ocirc;ng phẩm m&agrave;u.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"4\"><strong>2. C&ocirc;ng dụng nổi bật</strong></h3>\r\n<ul data-path-to-node=\"5\">\r\n<li>\r\n<p data-path-to-node=\"5,0,0\">Hỗ trợ người tiểu đường &amp; cao huyết &aacute;p: Gi&uacute;p thỏa m&atilde;n cơn th&egrave;m ngọt m&agrave; kh&ocirc;ng l&agrave;m tăng chỉ số đường huyết, hỗ trợ ổn định huyết &aacute;p.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,1,0\">Hỗ trợ giảm c&acirc;n: L&agrave; lựa chọn thay thế đường ho&agrave;n hảo cho người đang trong chế độ Eat Clean, Keto hoặc người muốn cắt giảm năng lượng dư thừa.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,2,0\">Thanh nhiệt &amp; Giải độc: Gi&uacute;p l&agrave;m m&aacute;t gan, giảm mụn nhọt v&agrave; hỗ trợ hệ ti&ecirc;u h&oacute;a hoạt động trơn tru hơn.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,3,0\">Chống oxy h&oacute;a: Gi&uacute;p tăng cường sức đề kh&aacute;ng tự nhi&ecirc;n cho cơ thể nhờ c&aacute;c hợp chất thảo mộc.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"6\"><strong>3. C&aacute;ch sử dụng</strong></h3>\r\n<ul data-path-to-node=\"7\">\r\n<li>\r\n<p data-path-to-node=\"7,0,0\">Pha tr&agrave; nguy&ecirc;n chất: Cho 1 t&uacute;i lọc v&agrave;o t&aacute;ch, r&oacute;t khoảng 150ml - 200ml nước s&ocirc;i (<span class=\"katex-html\" aria-hidden=\"true\"><span class=\"base\"><span class=\"mord\">90</span><span class=\"mbin\">&minus;</span></span><span class=\"base\"><span class=\"mord\">10</span><span class=\"mord\">0<span class=\"mbin mtight\">∘</span></span><span class=\"mord mathnormal\">C</span></span></span>). Chờ từ 3 - 5 ph&uacute;t để tr&agrave; ngấm vị ngọt rồi thưởng thức.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,1,0\">Pha tr&agrave; hỗn hợp: D&ugrave;ng 1 t&uacute;i tr&agrave; cỏ ngọt pha chung với c&aacute;c loại tr&agrave; kh&aacute;c (như Tr&agrave; Hoa C&uacute;c, Tr&agrave; Artiso, Tr&agrave; Xanh) để tạo vị ngọt thanh tự nhi&ecirc;n thay thế cho đường hoặc mật ong.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,2,0\">Thưởng thức: C&oacute; thể uống n&oacute;ng hoặc th&ecirc;m đ&aacute; t&ugrave;y sở th&iacute;ch. Sử dụng từ 1-3 t&uacute;i mỗi ng&agrave;y để đạt hiệu quả sức khỏe tốt nhất.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"8\"><strong>4. C&aacute;ch bảo quản</strong></h3>\r\n<ul data-path-to-node=\"9\">\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,0,0\">M&ocirc;i trường: Để nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh những nơi c&oacute; độ ẩm cao hoặc c&oacute; m&ugrave;i mạnh (như bếp, nh&agrave; tắm).</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,1,0\">&Aacute;nh s&aacute;ng: Tr&aacute;nh tiếp x&uacute;c trực tiếp với &aacute;nh nắng mặt trời v&igrave; nhiệt độ cao c&oacute; thể l&agrave;m biến đổi dược t&iacute;nh của cỏ ngọt.</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,2,0\">Đ&oacute;ng g&oacute;i: Lu&ocirc;n đ&oacute;ng k&iacute;n miệng t&uacute;i hoặc cho v&agrave;o hũ thủy tinh đậy nắp chặt sau khi mở hộp để giữ trọn hương thơm v&agrave; vị ngọt đặc trưng.</p>\r\n</li>\r\n<li>\r\n<p style=\"line-height: 2;\" data-path-to-node=\"9,3,0\">Lưu &yacute;: Kh&ocirc;ng sử dụng sản phẩm nếu thấy t&uacute;i tr&agrave; c&oacute; dấu hiệu ẩm mốc hoặc qu&aacute; hạn sử dụng (thường l&agrave; 24 th&aacute;ng kể từ ng&agrave;y sản xuất).</p>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>', 25, 99, '2026-02-25 04:44:39', '2026-03-04 01:43:32', 478, NULL, NULL),
(89, 'ori#84561', 'Mít Sấy Dẻo Natural', 'Múi mít được sấy nhiệt độ thấp để giữ được độ dẻo dai, mềm mại và vị ngọt thanh tự nhiên (giống mẫu Jackfruit Chews trong hình). Sản phẩm giàu chất xơ và vitamin, phù hợp cho người thích ăn vặt lành mạnh.', 80000, 49, 'san-pham/mit-say-deo-natural', 'no', 'active', NULL, '<div class=\"container\">\r\n<div id=\"model-response-message-contentr_c67addcc28564745\" class=\"markdown markdown-main-panel stronger enable-updated-hr-color preserve-whitespaces-in-response\" dir=\"ltr\" style=\"line-height: 2;\" aria-live=\"polite\" aria-busy=\"false\">\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"2\"><strong>1. Th&agrave;nh phần</strong></h3>\r\n<ul data-path-to-node=\"3\">\r\n<li>\r\n<p data-path-to-node=\"3,0,0\">Cỏ ngọt nguy&ecirc;n chất (100%): Được chiết xuất từ l&aacute; c&acirc;y cỏ ngọt (<em data-path-to-node=\"3,0,0\" data-index-in-node=\"63\">Stevia rebaudiana</em>) tự nhi&ecirc;n, kh&ocirc;ng pha trộn đường k&iacute;nh hay tạp chất.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,1,0\">Đặc điểm: Chứa hoạt chất Stevioside tạo vị ngọt tự nhi&ecirc;n gấp 300 lần đường saccarose nhưng <strong data-path-to-node=\"3,1,0\" data-index-in-node=\"91\">kh&ocirc;ng chứa calo</strong>.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,2,0\">Cam kết: Kh&ocirc;ng chất bảo quản, kh&ocirc;ng hương liệu nh&acirc;n tạo v&agrave; kh&ocirc;ng phẩm m&agrave;u.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"4\"><strong>2. C&ocirc;ng dụng nổi bật</strong></h3>\r\n<ul data-path-to-node=\"5\">\r\n<li>\r\n<p data-path-to-node=\"5,0,0\">Hỗ trợ người tiểu đường &amp; cao huyết &aacute;p: Gi&uacute;p thỏa m&atilde;n cơn th&egrave;m ngọt m&agrave; kh&ocirc;ng l&agrave;m tăng chỉ số đường huyết, hỗ trợ ổn định huyết &aacute;p.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,1,0\">Hỗ trợ giảm c&acirc;n: L&agrave; lựa chọn thay thế đường ho&agrave;n hảo cho người đang trong chế độ Eat Clean, Keto hoặc người muốn cắt giảm năng lượng dư thừa.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,2,0\">Thanh nhiệt &amp; Giải độc: Gi&uacute;p l&agrave;m m&aacute;t gan, giảm mụn nhọt v&agrave; hỗ trợ hệ ti&ecirc;u h&oacute;a hoạt động trơn tru hơn.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,3,0\">Chống oxy h&oacute;a: Gi&uacute;p tăng cường sức đề kh&aacute;ng tự nhi&ecirc;n cho cơ thể nhờ c&aacute;c hợp chất thảo mộc.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"6\"><strong>3. C&aacute;ch sử dụng</strong></h3>\r\n<ul data-path-to-node=\"7\">\r\n<li>\r\n<p data-path-to-node=\"7,0,0\">Pha tr&agrave; nguy&ecirc;n chất: Cho 1 t&uacute;i lọc v&agrave;o t&aacute;ch, r&oacute;t khoảng 150ml - 200ml nước s&ocirc;i (<span class=\"katex-html\" aria-hidden=\"true\"><span class=\"base\"><span class=\"mord\">90</span><span class=\"mbin\">&minus;</span></span><span class=\"base\"><span class=\"mord\">10</span><span class=\"mord\">0<span class=\"mbin mtight\">∘</span></span><span class=\"mord mathnormal\">C</span></span></span>). Chờ từ 3 - 5 ph&uacute;t để tr&agrave; ngấm vị ngọt rồi thưởng thức.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,1,0\">Pha tr&agrave; hỗn hợp: D&ugrave;ng 1 t&uacute;i tr&agrave; cỏ ngọt pha chung với c&aacute;c loại tr&agrave; kh&aacute;c (như Tr&agrave; Hoa C&uacute;c, Tr&agrave; Artiso, Tr&agrave; Xanh) để tạo vị ngọt thanh tự nhi&ecirc;n thay thế cho đường hoặc mật ong.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,2,0\">Thưởng thức: C&oacute; thể uống n&oacute;ng hoặc th&ecirc;m đ&aacute; t&ugrave;y sở th&iacute;ch. Sử dụng từ 1-3 t&uacute;i mỗi ng&agrave;y để đạt hiệu quả sức khỏe tốt nhất.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"8\"><strong>4. C&aacute;ch bảo quản</strong></h3>\r\n<ul data-path-to-node=\"9\">\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,0,0\">M&ocirc;i trường: Để nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh những nơi c&oacute; độ ẩm cao hoặc c&oacute; m&ugrave;i mạnh (như bếp, nh&agrave; tắm).</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,1,0\">&Aacute;nh s&aacute;ng: Tr&aacute;nh tiếp x&uacute;c trực tiếp với &aacute;nh nắng mặt trời v&igrave; nhiệt độ cao c&oacute; thể l&agrave;m biến đổi dược t&iacute;nh của cỏ ngọt.</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,2,0\">Đ&oacute;ng g&oacute;i: Lu&ocirc;n đ&oacute;ng k&iacute;n miệng t&uacute;i hoặc cho v&agrave;o hũ thủy tinh đậy nắp chặt sau khi mở hộp để giữ trọn hương thơm v&agrave; vị ngọt đặc trưng.</p>\r\n</li>\r\n<li>\r\n<p style=\"line-height: 2;\" data-path-to-node=\"9,3,0\">Lưu &yacute;: Kh&ocirc;ng sử dụng sản phẩm nếu thấy t&uacute;i tr&agrave; c&oacute; dấu hiệu ẩm mốc hoặc qu&aacute; hạn sử dụng (thường l&agrave; 24 th&aacute;ng kể từ ng&agrave;y sản xuất).</p>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>', 25, 99, '2026-02-25 04:45:07', '2026-03-04 01:43:26', 479, NULL, 1),
(90, 'ori#748923', 'Mít Sấy Xuất Khẩu Organic', 'Dòng sản phẩm cao cấp sử dụng nguồn nguyên liệu mít hữu cơ (như mẫu túi xanh cuối cùng trong hình). Quy trình chế biến nghiêm ngặt, bao bì túi zip dày dặn, sang trọng, đạt tiêu chuẩn quốc tế.', 140000, 50, 'san-pham/mit-say-xuat-khau-organic', 'no', 'active', NULL, '<div class=\"container\">\r\n<div id=\"model-response-message-contentr_c67addcc28564745\" class=\"markdown markdown-main-panel stronger enable-updated-hr-color preserve-whitespaces-in-response\" dir=\"ltr\" style=\"line-height: 2;\" aria-live=\"polite\" aria-busy=\"false\">\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"2\"><strong>1. Th&agrave;nh phần</strong></h3>\r\n<ul data-path-to-node=\"3\">\r\n<li>\r\n<p data-path-to-node=\"3,0,0\">Cỏ ngọt nguy&ecirc;n chất (100%): Được chiết xuất từ l&aacute; c&acirc;y cỏ ngọt (<em data-path-to-node=\"3,0,0\" data-index-in-node=\"63\">Stevia rebaudiana</em>) tự nhi&ecirc;n, kh&ocirc;ng pha trộn đường k&iacute;nh hay tạp chất.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,1,0\">Đặc điểm: Chứa hoạt chất Stevioside tạo vị ngọt tự nhi&ecirc;n gấp 300 lần đường saccarose nhưng <strong data-path-to-node=\"3,1,0\" data-index-in-node=\"91\">kh&ocirc;ng chứa calo</strong>.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,2,0\">Cam kết: Kh&ocirc;ng chất bảo quản, kh&ocirc;ng hương liệu nh&acirc;n tạo v&agrave; kh&ocirc;ng phẩm m&agrave;u.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"4\"><strong>2. C&ocirc;ng dụng nổi bật</strong></h3>\r\n<ul data-path-to-node=\"5\">\r\n<li>\r\n<p data-path-to-node=\"5,0,0\">Hỗ trợ người tiểu đường &amp; cao huyết &aacute;p: Gi&uacute;p thỏa m&atilde;n cơn th&egrave;m ngọt m&agrave; kh&ocirc;ng l&agrave;m tăng chỉ số đường huyết, hỗ trợ ổn định huyết &aacute;p.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,1,0\">Hỗ trợ giảm c&acirc;n: L&agrave; lựa chọn thay thế đường ho&agrave;n hảo cho người đang trong chế độ Eat Clean, Keto hoặc người muốn cắt giảm năng lượng dư thừa.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,2,0\">Thanh nhiệt &amp; Giải độc: Gi&uacute;p l&agrave;m m&aacute;t gan, giảm mụn nhọt v&agrave; hỗ trợ hệ ti&ecirc;u h&oacute;a hoạt động trơn tru hơn.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,3,0\">Chống oxy h&oacute;a: Gi&uacute;p tăng cường sức đề kh&aacute;ng tự nhi&ecirc;n cho cơ thể nhờ c&aacute;c hợp chất thảo mộc.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"6\"><strong>3. C&aacute;ch sử dụng</strong></h3>\r\n<ul data-path-to-node=\"7\">\r\n<li>\r\n<p data-path-to-node=\"7,0,0\">Pha tr&agrave; nguy&ecirc;n chất: Cho 1 t&uacute;i lọc v&agrave;o t&aacute;ch, r&oacute;t khoảng 150ml - 200ml nước s&ocirc;i (<span class=\"katex-html\" aria-hidden=\"true\"><span class=\"base\"><span class=\"mord\">90</span><span class=\"mbin\">&minus;</span></span><span class=\"base\"><span class=\"mord\">10</span><span class=\"mord\">0<span class=\"mbin mtight\">∘</span></span><span class=\"mord mathnormal\">C</span></span></span>). Chờ từ 3 - 5 ph&uacute;t để tr&agrave; ngấm vị ngọt rồi thưởng thức.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,1,0\">Pha tr&agrave; hỗn hợp: D&ugrave;ng 1 t&uacute;i tr&agrave; cỏ ngọt pha chung với c&aacute;c loại tr&agrave; kh&aacute;c (như Tr&agrave; Hoa C&uacute;c, Tr&agrave; Artiso, Tr&agrave; Xanh) để tạo vị ngọt thanh tự nhi&ecirc;n thay thế cho đường hoặc mật ong.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,2,0\">Thưởng thức: C&oacute; thể uống n&oacute;ng hoặc th&ecirc;m đ&aacute; t&ugrave;y sở th&iacute;ch. Sử dụng từ 1-3 t&uacute;i mỗi ng&agrave;y để đạt hiệu quả sức khỏe tốt nhất.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"8\"><strong>4. C&aacute;ch bảo quản</strong></h3>\r\n<ul data-path-to-node=\"9\">\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,0,0\">M&ocirc;i trường: Để nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh những nơi c&oacute; độ ẩm cao hoặc c&oacute; m&ugrave;i mạnh (như bếp, nh&agrave; tắm).</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,1,0\">&Aacute;nh s&aacute;ng: Tr&aacute;nh tiếp x&uacute;c trực tiếp với &aacute;nh nắng mặt trời v&igrave; nhiệt độ cao c&oacute; thể l&agrave;m biến đổi dược t&iacute;nh của cỏ ngọt.</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,2,0\">Đ&oacute;ng g&oacute;i: Lu&ocirc;n đ&oacute;ng k&iacute;n miệng t&uacute;i hoặc cho v&agrave;o hũ thủy tinh đậy nắp chặt sau khi mở hộp để giữ trọn hương thơm v&agrave; vị ngọt đặc trưng.</p>\r\n</li>\r\n<li>\r\n<p style=\"line-height: 2;\" data-path-to-node=\"9,3,0\">Lưu &yacute;: Kh&ocirc;ng sử dụng sản phẩm nếu thấy t&uacute;i tr&agrave; c&oacute; dấu hiệu ẩm mốc hoặc qu&aacute; hạn sử dụng (thường l&agrave; 24 th&aacute;ng kể từ ng&agrave;y sản xuất).</p>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>', 25, 99, '2026-02-25 04:45:34', '2026-03-04 01:43:15', 480, NULL, NULL),
(91, 'ori#89423', 'Snack Mít Sấy Vị Muối Ớt', 'Mít sấy giòn được tẩm thêm một lớp muối ớt cay mặn nhẹ nhàng, tạo nên hương vị mới lạ, kích thích vị giác. Rất phù hợp làm món ăn vặt văn phòng hoặc đồ nhắm.', 45000, 50, 'san-pham/snack-mit-say-vi-muoi-ot', 'no', 'active', NULL, '<div class=\"container\">\r\n<div id=\"model-response-message-contentr_c67addcc28564745\" class=\"markdown markdown-main-panel stronger enable-updated-hr-color preserve-whitespaces-in-response\" dir=\"ltr\" style=\"line-height: 2;\" aria-live=\"polite\" aria-busy=\"false\">\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"2\"><strong>1. Th&agrave;nh phần</strong></h3>\r\n<ul data-path-to-node=\"3\">\r\n<li>\r\n<p data-path-to-node=\"3,0,0\">Cỏ ngọt nguy&ecirc;n chất (100%): Được chiết xuất từ l&aacute; c&acirc;y cỏ ngọt (<em data-path-to-node=\"3,0,0\" data-index-in-node=\"63\">Stevia rebaudiana</em>) tự nhi&ecirc;n, kh&ocirc;ng pha trộn đường k&iacute;nh hay tạp chất.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,1,0\">Đặc điểm: Chứa hoạt chất Stevioside tạo vị ngọt tự nhi&ecirc;n gấp 300 lần đường saccarose nhưng <strong data-path-to-node=\"3,1,0\" data-index-in-node=\"91\">kh&ocirc;ng chứa calo</strong>.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,2,0\">Cam kết: Kh&ocirc;ng chất bảo quản, kh&ocirc;ng hương liệu nh&acirc;n tạo v&agrave; kh&ocirc;ng phẩm m&agrave;u.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"4\"><strong>2. C&ocirc;ng dụng nổi bật</strong></h3>\r\n<ul data-path-to-node=\"5\">\r\n<li>\r\n<p data-path-to-node=\"5,0,0\">Hỗ trợ người tiểu đường &amp; cao huyết &aacute;p: Gi&uacute;p thỏa m&atilde;n cơn th&egrave;m ngọt m&agrave; kh&ocirc;ng l&agrave;m tăng chỉ số đường huyết, hỗ trợ ổn định huyết &aacute;p.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,1,0\">Hỗ trợ giảm c&acirc;n: L&agrave; lựa chọn thay thế đường ho&agrave;n hảo cho người đang trong chế độ Eat Clean, Keto hoặc người muốn cắt giảm năng lượng dư thừa.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,2,0\">Thanh nhiệt &amp; Giải độc: Gi&uacute;p l&agrave;m m&aacute;t gan, giảm mụn nhọt v&agrave; hỗ trợ hệ ti&ecirc;u h&oacute;a hoạt động trơn tru hơn.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,3,0\">Chống oxy h&oacute;a: Gi&uacute;p tăng cường sức đề kh&aacute;ng tự nhi&ecirc;n cho cơ thể nhờ c&aacute;c hợp chất thảo mộc.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"6\"><strong>3. C&aacute;ch sử dụng</strong></h3>\r\n<ul data-path-to-node=\"7\">\r\n<li>\r\n<p data-path-to-node=\"7,0,0\">Pha tr&agrave; nguy&ecirc;n chất: Cho 1 t&uacute;i lọc v&agrave;o t&aacute;ch, r&oacute;t khoảng 150ml - 200ml nước s&ocirc;i (<span class=\"katex-html\" aria-hidden=\"true\"><span class=\"base\"><span class=\"mord\">90</span><span class=\"mbin\">&minus;</span></span><span class=\"base\"><span class=\"mord\">10</span><span class=\"mord\">0<span class=\"mbin mtight\">∘</span></span><span class=\"mord mathnormal\">C</span></span></span>). Chờ từ 3 - 5 ph&uacute;t để tr&agrave; ngấm vị ngọt rồi thưởng thức.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,1,0\">Pha tr&agrave; hỗn hợp: D&ugrave;ng 1 t&uacute;i tr&agrave; cỏ ngọt pha chung với c&aacute;c loại tr&agrave; kh&aacute;c (như Tr&agrave; Hoa C&uacute;c, Tr&agrave; Artiso, Tr&agrave; Xanh) để tạo vị ngọt thanh tự nhi&ecirc;n thay thế cho đường hoặc mật ong.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,2,0\">Thưởng thức: C&oacute; thể uống n&oacute;ng hoặc th&ecirc;m đ&aacute; t&ugrave;y sở th&iacute;ch. Sử dụng từ 1-3 t&uacute;i mỗi ng&agrave;y để đạt hiệu quả sức khỏe tốt nhất.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"8\"><strong>4. C&aacute;ch bảo quản</strong></h3>\r\n<ul data-path-to-node=\"9\">\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,0,0\">M&ocirc;i trường: Để nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh những nơi c&oacute; độ ẩm cao hoặc c&oacute; m&ugrave;i mạnh (như bếp, nh&agrave; tắm).</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,1,0\">&Aacute;nh s&aacute;ng: Tr&aacute;nh tiếp x&uacute;c trực tiếp với &aacute;nh nắng mặt trời v&igrave; nhiệt độ cao c&oacute; thể l&agrave;m biến đổi dược t&iacute;nh của cỏ ngọt.</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,2,0\">Đ&oacute;ng g&oacute;i: Lu&ocirc;n đ&oacute;ng k&iacute;n miệng t&uacute;i hoặc cho v&agrave;o hũ thủy tinh đậy nắp chặt sau khi mở hộp để giữ trọn hương thơm v&agrave; vị ngọt đặc trưng.</p>\r\n</li>\r\n<li>\r\n<p style=\"line-height: 2;\" data-path-to-node=\"9,3,0\">Lưu &yacute;: Kh&ocirc;ng sử dụng sản phẩm nếu thấy t&uacute;i tr&agrave; c&oacute; dấu hiệu ẩm mốc hoặc qu&aacute; hạn sử dụng (thường l&agrave; 24 th&aacute;ng kể từ ng&agrave;y sản xuất).</p>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>', 25, 99, '2026-02-25 04:46:04', '2026-03-04 01:37:36', 481, NULL, NULL),
(92, 'ori#89451', 'Mít Trái Cây Nhiệt Đới Sấy', 'Hỗn hợp mít sấy cùng các loại trái cây nhiệt đới khác như chuối, khoai lang và khổ qua. Đây là dòng snack tiện lợi, đa dạng hương vị trong cùng một bao bì (giống phong cách các túi mix trong hình).', 85000, 50, 'san-pham/mit-trai-cay-nhiet-doi-say', 'no', 'active', 0, '<div class=\"container\">\r\n<div id=\"model-response-message-contentr_c67addcc28564745\" class=\"markdown markdown-main-panel stronger enable-updated-hr-color preserve-whitespaces-in-response\" dir=\"ltr\" style=\"line-height: 2;\" aria-live=\"polite\" aria-busy=\"false\">\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"2\"><strong>1. Th&agrave;nh phần</strong></h3>\r\n<ul data-path-to-node=\"3\">\r\n<li>\r\n<p data-path-to-node=\"3,0,0\">Cỏ ngọt nguy&ecirc;n chất (100%): Được chiết xuất từ l&aacute; c&acirc;y cỏ ngọt (<em data-path-to-node=\"3,0,0\" data-index-in-node=\"63\">Stevia rebaudiana</em>) tự nhi&ecirc;n, kh&ocirc;ng pha trộn đường k&iacute;nh hay tạp chất.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,1,0\">Đặc điểm: Chứa hoạt chất Stevioside tạo vị ngọt tự nhi&ecirc;n gấp 300 lần đường saccarose nhưng <strong data-path-to-node=\"3,1,0\" data-index-in-node=\"91\">kh&ocirc;ng chứa calo</strong>.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,2,0\">Cam kết: Kh&ocirc;ng chất bảo quản, kh&ocirc;ng hương liệu nh&acirc;n tạo v&agrave; kh&ocirc;ng phẩm m&agrave;u.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"4\"><strong>2. C&ocirc;ng dụng nổi bật</strong></h3>\r\n<ul data-path-to-node=\"5\">\r\n<li>\r\n<p data-path-to-node=\"5,0,0\">Hỗ trợ người tiểu đường &amp; cao huyết &aacute;p: Gi&uacute;p thỏa m&atilde;n cơn th&egrave;m ngọt m&agrave; kh&ocirc;ng l&agrave;m tăng chỉ số đường huyết, hỗ trợ ổn định huyết &aacute;p.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,1,0\">Hỗ trợ giảm c&acirc;n: L&agrave; lựa chọn thay thế đường ho&agrave;n hảo cho người đang trong chế độ Eat Clean, Keto hoặc người muốn cắt giảm năng lượng dư thừa.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,2,0\">Thanh nhiệt &amp; Giải độc: Gi&uacute;p l&agrave;m m&aacute;t gan, giảm mụn nhọt v&agrave; hỗ trợ hệ ti&ecirc;u h&oacute;a hoạt động trơn tru hơn.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,3,0\">Chống oxy h&oacute;a: Gi&uacute;p tăng cường sức đề kh&aacute;ng tự nhi&ecirc;n cho cơ thể nhờ c&aacute;c hợp chất thảo mộc.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"6\"><strong>3. C&aacute;ch sử dụng</strong></h3>\r\n<ul data-path-to-node=\"7\">\r\n<li>\r\n<p data-path-to-node=\"7,0,0\">Pha tr&agrave; nguy&ecirc;n chất: Cho 1 t&uacute;i lọc v&agrave;o t&aacute;ch, r&oacute;t khoảng 150ml - 200ml nước s&ocirc;i (<span class=\"katex-html\" aria-hidden=\"true\"><span class=\"base\"><span class=\"mord\">90</span><span class=\"mbin\">&minus;</span></span><span class=\"base\"><span class=\"mord\">10</span><span class=\"mord\">0<span class=\"mbin mtight\">∘</span></span><span class=\"mord mathnormal\">C</span></span></span>). Chờ từ 3 - 5 ph&uacute;t để tr&agrave; ngấm vị ngọt rồi thưởng thức.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,1,0\">Pha tr&agrave; hỗn hợp: D&ugrave;ng 1 t&uacute;i tr&agrave; cỏ ngọt pha chung với c&aacute;c loại tr&agrave; kh&aacute;c (như Tr&agrave; Hoa C&uacute;c, Tr&agrave; Artiso, Tr&agrave; Xanh) để tạo vị ngọt thanh tự nhi&ecirc;n thay thế cho đường hoặc mật ong.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,2,0\">Thưởng thức: C&oacute; thể uống n&oacute;ng hoặc th&ecirc;m đ&aacute; t&ugrave;y sở th&iacute;ch. Sử dụng từ 1-3 t&uacute;i mỗi ng&agrave;y để đạt hiệu quả sức khỏe tốt nhất.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"8\"><strong>4. C&aacute;ch bảo quản</strong></h3>\r\n<ul data-path-to-node=\"9\">\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,0,0\">M&ocirc;i trường: Để nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh những nơi c&oacute; độ ẩm cao hoặc c&oacute; m&ugrave;i mạnh (như bếp, nh&agrave; tắm).</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,1,0\">&Aacute;nh s&aacute;ng: Tr&aacute;nh tiếp x&uacute;c trực tiếp với &aacute;nh nắng mặt trời v&igrave; nhiệt độ cao c&oacute; thể l&agrave;m biến đổi dược t&iacute;nh của cỏ ngọt.</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,2,0\">Đ&oacute;ng g&oacute;i: Lu&ocirc;n đ&oacute;ng k&iacute;n miệng t&uacute;i hoặc cho v&agrave;o hũ thủy tinh đậy nắp chặt sau khi mở hộp để giữ trọn hương thơm v&agrave; vị ngọt đặc trưng.</p>\r\n</li>\r\n<li>\r\n<p style=\"line-height: 2;\" data-path-to-node=\"9,3,0\">Lưu &yacute;: Kh&ocirc;ng sử dụng sản phẩm nếu thấy t&uacute;i tr&agrave; c&oacute; dấu hiệu ẩm mốc hoặc qu&aacute; hạn sử dụng (thường l&agrave; 24 th&aacute;ng kể từ ng&agrave;y sản xuất).</p>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>', 25, 99, '2026-02-25 04:47:40', '2026-03-04 01:37:26', 482, NULL, NULL),
(93, 'ori#845615', 'Bột Bồ Công Anh', 'Bột nguyên chất, công nghệ sấy nhiệt độ thấp, xay chậm siêu mịn', 150000, 15, 'san-pham/bot-bo-cong-anh', 'no', 'active', NULL, '<div class=\"container\">\r\n<div id=\"model-response-message-contentr_c67addcc28564745\" class=\"markdown markdown-main-panel stronger enable-updated-hr-color preserve-whitespaces-in-response\" dir=\"ltr\" style=\"line-height: 2;\" aria-live=\"polite\" aria-busy=\"false\">\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"2\"><strong>1. Th&agrave;nh phần</strong></h3>\r\n<ul data-path-to-node=\"3\">\r\n<li>\r\n<p data-path-to-node=\"3,0,0\">Cỏ ngọt nguy&ecirc;n chất (100%): Được chiết xuất từ l&aacute; c&acirc;y cỏ ngọt (<em data-path-to-node=\"3,0,0\" data-index-in-node=\"63\">Stevia rebaudiana</em>) tự nhi&ecirc;n, kh&ocirc;ng pha trộn đường k&iacute;nh hay tạp chất.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,1,0\">Đặc điểm: Chứa hoạt chất Stevioside tạo vị ngọt tự nhi&ecirc;n gấp 300 lần đường saccarose nhưng <strong data-path-to-node=\"3,1,0\" data-index-in-node=\"91\">kh&ocirc;ng chứa calo</strong>.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,2,0\">Cam kết: Kh&ocirc;ng chất bảo quản, kh&ocirc;ng hương liệu nh&acirc;n tạo v&agrave; kh&ocirc;ng phẩm m&agrave;u.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"4\"><strong>2. C&ocirc;ng dụng nổi bật</strong></h3>\r\n<ul data-path-to-node=\"5\">\r\n<li>\r\n<p data-path-to-node=\"5,0,0\">Hỗ trợ người tiểu đường &amp; cao huyết &aacute;p: Gi&uacute;p thỏa m&atilde;n cơn th&egrave;m ngọt m&agrave; kh&ocirc;ng l&agrave;m tăng chỉ số đường huyết, hỗ trợ ổn định huyết &aacute;p.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,1,0\">Hỗ trợ giảm c&acirc;n: L&agrave; lựa chọn thay thế đường ho&agrave;n hảo cho người đang trong chế độ Eat Clean, Keto hoặc người muốn cắt giảm năng lượng dư thừa.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,2,0\">Thanh nhiệt &amp; Giải độc: Gi&uacute;p l&agrave;m m&aacute;t gan, giảm mụn nhọt v&agrave; hỗ trợ hệ ti&ecirc;u h&oacute;a hoạt động trơn tru hơn.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,3,0\">Chống oxy h&oacute;a: Gi&uacute;p tăng cường sức đề kh&aacute;ng tự nhi&ecirc;n cho cơ thể nhờ c&aacute;c hợp chất thảo mộc.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"6\"><strong>3. C&aacute;ch sử dụng</strong></h3>\r\n<ul data-path-to-node=\"7\">\r\n<li>\r\n<p data-path-to-node=\"7,0,0\">Pha tr&agrave; nguy&ecirc;n chất: Cho 1 t&uacute;i lọc v&agrave;o t&aacute;ch, r&oacute;t khoảng 150ml - 200ml nước s&ocirc;i (<span class=\"katex-html\" aria-hidden=\"true\"><span class=\"base\"><span class=\"mord\">90</span><span class=\"mbin\">&minus;</span></span><span class=\"base\"><span class=\"mord\">10</span><span class=\"mord\">0<span class=\"mbin mtight\">∘</span></span><span class=\"mord mathnormal\">C</span></span></span>). Chờ từ 3 - 5 ph&uacute;t để tr&agrave; ngấm vị ngọt rồi thưởng thức.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,1,0\">Pha tr&agrave; hỗn hợp: D&ugrave;ng 1 t&uacute;i tr&agrave; cỏ ngọt pha chung với c&aacute;c loại tr&agrave; kh&aacute;c (như Tr&agrave; Hoa C&uacute;c, Tr&agrave; Artiso, Tr&agrave; Xanh) để tạo vị ngọt thanh tự nhi&ecirc;n thay thế cho đường hoặc mật ong.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,2,0\">Thưởng thức: C&oacute; thể uống n&oacute;ng hoặc th&ecirc;m đ&aacute; t&ugrave;y sở th&iacute;ch. Sử dụng từ 1-3 t&uacute;i mỗi ng&agrave;y để đạt hiệu quả sức khỏe tốt nhất.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"8\"><strong>4. C&aacute;ch bảo quản</strong></h3>\r\n<ul data-path-to-node=\"9\">\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,0,0\">M&ocirc;i trường: Để nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh những nơi c&oacute; độ ẩm cao hoặc c&oacute; m&ugrave;i mạnh (như bếp, nh&agrave; tắm).</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,1,0\">&Aacute;nh s&aacute;ng: Tr&aacute;nh tiếp x&uacute;c trực tiếp với &aacute;nh nắng mặt trời v&igrave; nhiệt độ cao c&oacute; thể l&agrave;m biến đổi dược t&iacute;nh của cỏ ngọt.</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,2,0\">Đ&oacute;ng g&oacute;i: Lu&ocirc;n đ&oacute;ng k&iacute;n miệng t&uacute;i hoặc cho v&agrave;o hũ thủy tinh đậy nắp chặt sau khi mở hộp để giữ trọn hương thơm v&agrave; vị ngọt đặc trưng.</p>\r\n</li>\r\n<li>\r\n<p style=\"line-height: 2;\" data-path-to-node=\"9,3,0\">Lưu &yacute;: Kh&ocirc;ng sử dụng sản phẩm nếu thấy t&uacute;i tr&agrave; c&oacute; dấu hiệu ẩm mốc hoặc qu&aacute; hạn sử dụng (thường l&agrave; 24 th&aacute;ng kể từ ng&agrave;y sản xuất).</p>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>', 25, 100, '2026-02-25 05:01:33', '2026-03-04 01:37:04', 483, NULL, NULL);
INSERT INTO `products` (`id`, `code`, `name`, `desc`, `price`, `quantity`, `slug`, `up_sale`, `status`, `disscount`, `details`, `user_id`, `cat_id`, `created_at`, `updated_at`, `img_id`, `deleted_at`, `sold_count`) VALUES
(94, 'ori#8420', 'Bột Cải Xoăn Kale', 'Bột nguyên chất, công nghệ sấy nhiệt độ thấp, xay chậm siêu mịn', 180000, 50, 'san-pham/bot-cai-xoan-kale', 'no', 'active', NULL, '<div class=\"container\">\r\n<div id=\"model-response-message-contentr_c67addcc28564745\" class=\"markdown markdown-main-panel stronger enable-updated-hr-color preserve-whitespaces-in-response\" dir=\"ltr\" style=\"line-height: 2;\" aria-live=\"polite\" aria-busy=\"false\">\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"2\"><strong>1. Th&agrave;nh phần</strong></h3>\r\n<ul data-path-to-node=\"3\">\r\n<li>\r\n<p data-path-to-node=\"3,0,0\">Cỏ ngọt nguy&ecirc;n chất (100%): Được chiết xuất từ l&aacute; c&acirc;y cỏ ngọt (<em data-path-to-node=\"3,0,0\" data-index-in-node=\"63\">Stevia rebaudiana</em>) tự nhi&ecirc;n, kh&ocirc;ng pha trộn đường k&iacute;nh hay tạp chất.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,1,0\">Đặc điểm: Chứa hoạt chất Stevioside tạo vị ngọt tự nhi&ecirc;n gấp 300 lần đường saccarose nhưng <strong data-path-to-node=\"3,1,0\" data-index-in-node=\"91\">kh&ocirc;ng chứa calo</strong>.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,2,0\">Cam kết: Kh&ocirc;ng chất bảo quản, kh&ocirc;ng hương liệu nh&acirc;n tạo v&agrave; kh&ocirc;ng phẩm m&agrave;u.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"4\"><strong>2. C&ocirc;ng dụng nổi bật</strong></h3>\r\n<ul data-path-to-node=\"5\">\r\n<li>\r\n<p data-path-to-node=\"5,0,0\">Hỗ trợ người tiểu đường &amp; cao huyết &aacute;p: Gi&uacute;p thỏa m&atilde;n cơn th&egrave;m ngọt m&agrave; kh&ocirc;ng l&agrave;m tăng chỉ số đường huyết, hỗ trợ ổn định huyết &aacute;p.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,1,0\">Hỗ trợ giảm c&acirc;n: L&agrave; lựa chọn thay thế đường ho&agrave;n hảo cho người đang trong chế độ Eat Clean, Keto hoặc người muốn cắt giảm năng lượng dư thừa.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,2,0\">Thanh nhiệt &amp; Giải độc: Gi&uacute;p l&agrave;m m&aacute;t gan, giảm mụn nhọt v&agrave; hỗ trợ hệ ti&ecirc;u h&oacute;a hoạt động trơn tru hơn.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,3,0\">Chống oxy h&oacute;a: Gi&uacute;p tăng cường sức đề kh&aacute;ng tự nhi&ecirc;n cho cơ thể nhờ c&aacute;c hợp chất thảo mộc.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"6\"><strong>3. C&aacute;ch sử dụng</strong></h3>\r\n<ul data-path-to-node=\"7\">\r\n<li>\r\n<p data-path-to-node=\"7,0,0\">Pha tr&agrave; nguy&ecirc;n chất: Cho 1 t&uacute;i lọc v&agrave;o t&aacute;ch, r&oacute;t khoảng 150ml - 200ml nước s&ocirc;i (<span class=\"katex-html\" aria-hidden=\"true\"><span class=\"base\"><span class=\"mord\">90</span><span class=\"mbin\">&minus;</span></span><span class=\"base\"><span class=\"mord\">10</span><span class=\"mord\">0<span class=\"mbin mtight\">∘</span></span><span class=\"mord mathnormal\">C</span></span></span>). Chờ từ 3 - 5 ph&uacute;t để tr&agrave; ngấm vị ngọt rồi thưởng thức.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,1,0\">Pha tr&agrave; hỗn hợp: D&ugrave;ng 1 t&uacute;i tr&agrave; cỏ ngọt pha chung với c&aacute;c loại tr&agrave; kh&aacute;c (như Tr&agrave; Hoa C&uacute;c, Tr&agrave; Artiso, Tr&agrave; Xanh) để tạo vị ngọt thanh tự nhi&ecirc;n thay thế cho đường hoặc mật ong.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,2,0\">Thưởng thức: C&oacute; thể uống n&oacute;ng hoặc th&ecirc;m đ&aacute; t&ugrave;y sở th&iacute;ch. Sử dụng từ 1-3 t&uacute;i mỗi ng&agrave;y để đạt hiệu quả sức khỏe tốt nhất.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"8\"><strong>4. C&aacute;ch bảo quản</strong></h3>\r\n<ul data-path-to-node=\"9\">\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,0,0\">M&ocirc;i trường: Để nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh những nơi c&oacute; độ ẩm cao hoặc c&oacute; m&ugrave;i mạnh (như bếp, nh&agrave; tắm).</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,1,0\">&Aacute;nh s&aacute;ng: Tr&aacute;nh tiếp x&uacute;c trực tiếp với &aacute;nh nắng mặt trời v&igrave; nhiệt độ cao c&oacute; thể l&agrave;m biến đổi dược t&iacute;nh của cỏ ngọt.</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,2,0\">Đ&oacute;ng g&oacute;i: Lu&ocirc;n đ&oacute;ng k&iacute;n miệng t&uacute;i hoặc cho v&agrave;o hũ thủy tinh đậy nắp chặt sau khi mở hộp để giữ trọn hương thơm v&agrave; vị ngọt đặc trưng.</p>\r\n</li>\r\n<li>\r\n<p style=\"line-height: 2;\" data-path-to-node=\"9,3,0\">Lưu &yacute;: Kh&ocirc;ng sử dụng sản phẩm nếu thấy t&uacute;i tr&agrave; c&oacute; dấu hiệu ẩm mốc hoặc qu&aacute; hạn sử dụng (thường l&agrave; 24 th&aacute;ng kể từ ng&agrave;y sản xuất).</p>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>', 25, 100, '2026-02-25 05:02:39', '2026-03-04 01:36:43', 484, NULL, NULL),
(95, 'ori#84526', 'Bột Diếp Cá', 'Bột nguyên chất, công nghệ sấy nhiệt độ thấp, xay chậm siêu mịn', 180000, 50, 'san-pham/bot-diep-ca', 'no', 'active', NULL, '<div class=\"container\">\r\n<div id=\"model-response-message-contentr_c67addcc28564745\" class=\"markdown markdown-main-panel stronger enable-updated-hr-color preserve-whitespaces-in-response\" dir=\"ltr\" style=\"line-height: 2;\" aria-live=\"polite\" aria-busy=\"false\">\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"2\"><strong>1. Th&agrave;nh phần</strong></h3>\r\n<ul data-path-to-node=\"3\">\r\n<li>\r\n<p data-path-to-node=\"3,0,0\">Cỏ ngọt nguy&ecirc;n chất (100%): Được chiết xuất từ l&aacute; c&acirc;y cỏ ngọt (<em data-path-to-node=\"3,0,0\" data-index-in-node=\"63\">Stevia rebaudiana</em>) tự nhi&ecirc;n, kh&ocirc;ng pha trộn đường k&iacute;nh hay tạp chất.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,1,0\">Đặc điểm: Chứa hoạt chất Stevioside tạo vị ngọt tự nhi&ecirc;n gấp 300 lần đường saccarose nhưng <strong data-path-to-node=\"3,1,0\" data-index-in-node=\"91\">kh&ocirc;ng chứa calo</strong>.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,2,0\">Cam kết: Kh&ocirc;ng chất bảo quản, kh&ocirc;ng hương liệu nh&acirc;n tạo v&agrave; kh&ocirc;ng phẩm m&agrave;u.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"4\"><strong>2. C&ocirc;ng dụng nổi bật</strong></h3>\r\n<ul data-path-to-node=\"5\">\r\n<li>\r\n<p data-path-to-node=\"5,0,0\">Hỗ trợ người tiểu đường &amp; cao huyết &aacute;p: Gi&uacute;p thỏa m&atilde;n cơn th&egrave;m ngọt m&agrave; kh&ocirc;ng l&agrave;m tăng chỉ số đường huyết, hỗ trợ ổn định huyết &aacute;p.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,1,0\">Hỗ trợ giảm c&acirc;n: L&agrave; lựa chọn thay thế đường ho&agrave;n hảo cho người đang trong chế độ Eat Clean, Keto hoặc người muốn cắt giảm năng lượng dư thừa.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,2,0\">Thanh nhiệt &amp; Giải độc: Gi&uacute;p l&agrave;m m&aacute;t gan, giảm mụn nhọt v&agrave; hỗ trợ hệ ti&ecirc;u h&oacute;a hoạt động trơn tru hơn.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,3,0\">Chống oxy h&oacute;a: Gi&uacute;p tăng cường sức đề kh&aacute;ng tự nhi&ecirc;n cho cơ thể nhờ c&aacute;c hợp chất thảo mộc.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"6\"><strong>3. C&aacute;ch sử dụng</strong></h3>\r\n<ul data-path-to-node=\"7\">\r\n<li>\r\n<p data-path-to-node=\"7,0,0\">Pha tr&agrave; nguy&ecirc;n chất: Cho 1 t&uacute;i lọc v&agrave;o t&aacute;ch, r&oacute;t khoảng 150ml - 200ml nước s&ocirc;i (<span class=\"katex-html\" aria-hidden=\"true\"><span class=\"base\"><span class=\"mord\">90</span><span class=\"mbin\">&minus;</span></span><span class=\"base\"><span class=\"mord\">10</span><span class=\"mord\">0<span class=\"mbin mtight\">∘</span></span><span class=\"mord mathnormal\">C</span></span></span>). Chờ từ 3 - 5 ph&uacute;t để tr&agrave; ngấm vị ngọt rồi thưởng thức.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,1,0\">Pha tr&agrave; hỗn hợp: D&ugrave;ng 1 t&uacute;i tr&agrave; cỏ ngọt pha chung với c&aacute;c loại tr&agrave; kh&aacute;c (như Tr&agrave; Hoa C&uacute;c, Tr&agrave; Artiso, Tr&agrave; Xanh) để tạo vị ngọt thanh tự nhi&ecirc;n thay thế cho đường hoặc mật ong.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,2,0\">Thưởng thức: C&oacute; thể uống n&oacute;ng hoặc th&ecirc;m đ&aacute; t&ugrave;y sở th&iacute;ch. Sử dụng từ 1-3 t&uacute;i mỗi ng&agrave;y để đạt hiệu quả sức khỏe tốt nhất.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"8\"><strong>4. C&aacute;ch bảo quản</strong></h3>\r\n<ul data-path-to-node=\"9\">\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,0,0\">M&ocirc;i trường: Để nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh những nơi c&oacute; độ ẩm cao hoặc c&oacute; m&ugrave;i mạnh (như bếp, nh&agrave; tắm).</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,1,0\">&Aacute;nh s&aacute;ng: Tr&aacute;nh tiếp x&uacute;c trực tiếp với &aacute;nh nắng mặt trời v&igrave; nhiệt độ cao c&oacute; thể l&agrave;m biến đổi dược t&iacute;nh của cỏ ngọt.</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,2,0\">Đ&oacute;ng g&oacute;i: Lu&ocirc;n đ&oacute;ng k&iacute;n miệng t&uacute;i hoặc cho v&agrave;o hũ thủy tinh đậy nắp chặt sau khi mở hộp để giữ trọn hương thơm v&agrave; vị ngọt đặc trưng.</p>\r\n</li>\r\n<li>\r\n<p style=\"line-height: 2;\" data-path-to-node=\"9,3,0\">Lưu &yacute;: Kh&ocirc;ng sử dụng sản phẩm nếu thấy t&uacute;i tr&agrave; c&oacute; dấu hiệu ẩm mốc hoặc qu&aacute; hạn sử dụng (thường l&agrave; 24 th&aacute;ng kể từ ng&agrave;y sản xuất).</p>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>', 25, 100, '2026-02-25 05:03:28', '2026-03-04 01:36:37', 485, NULL, NULL),
(96, 'ori#99556', 'Bột rau má', 'Bột nguyên chất, công nghệ sấy nhiệt độ thấp, xay chậm siêu mịn', 180000, 50, 'san-pham/bot-rau-ma', 'no', 'active', NULL, '<div class=\"container\">\r\n<div id=\"model-response-message-contentr_c67addcc28564745\" class=\"markdown markdown-main-panel stronger enable-updated-hr-color preserve-whitespaces-in-response\" dir=\"ltr\" style=\"line-height: 2;\" aria-live=\"polite\" aria-busy=\"false\">\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"2\"><strong>1. Th&agrave;nh phần</strong></h3>\r\n<ul data-path-to-node=\"3\">\r\n<li>\r\n<p data-path-to-node=\"3,0,0\">Cỏ ngọt nguy&ecirc;n chất (100%): Được chiết xuất từ l&aacute; c&acirc;y cỏ ngọt (<em data-path-to-node=\"3,0,0\" data-index-in-node=\"63\">Stevia rebaudiana</em>) tự nhi&ecirc;n, kh&ocirc;ng pha trộn đường k&iacute;nh hay tạp chất.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,1,0\">Đặc điểm: Chứa hoạt chất Stevioside tạo vị ngọt tự nhi&ecirc;n gấp 300 lần đường saccarose nhưng <strong data-path-to-node=\"3,1,0\" data-index-in-node=\"91\">kh&ocirc;ng chứa calo</strong>.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,2,0\">Cam kết: Kh&ocirc;ng chất bảo quản, kh&ocirc;ng hương liệu nh&acirc;n tạo v&agrave; kh&ocirc;ng phẩm m&agrave;u.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"4\"><strong>2. C&ocirc;ng dụng nổi bật</strong></h3>\r\n<ul data-path-to-node=\"5\">\r\n<li>\r\n<p data-path-to-node=\"5,0,0\">Hỗ trợ người tiểu đường &amp; cao huyết &aacute;p: Gi&uacute;p thỏa m&atilde;n cơn th&egrave;m ngọt m&agrave; kh&ocirc;ng l&agrave;m tăng chỉ số đường huyết, hỗ trợ ổn định huyết &aacute;p.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,1,0\">Hỗ trợ giảm c&acirc;n: L&agrave; lựa chọn thay thế đường ho&agrave;n hảo cho người đang trong chế độ Eat Clean, Keto hoặc người muốn cắt giảm năng lượng dư thừa.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,2,0\">Thanh nhiệt &amp; Giải độc: Gi&uacute;p l&agrave;m m&aacute;t gan, giảm mụn nhọt v&agrave; hỗ trợ hệ ti&ecirc;u h&oacute;a hoạt động trơn tru hơn.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,3,0\">Chống oxy h&oacute;a: Gi&uacute;p tăng cường sức đề kh&aacute;ng tự nhi&ecirc;n cho cơ thể nhờ c&aacute;c hợp chất thảo mộc.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"6\"><strong>3. C&aacute;ch sử dụng</strong></h3>\r\n<ul data-path-to-node=\"7\">\r\n<li>\r\n<p data-path-to-node=\"7,0,0\">Pha tr&agrave; nguy&ecirc;n chất: Cho 1 t&uacute;i lọc v&agrave;o t&aacute;ch, r&oacute;t khoảng 150ml - 200ml nước s&ocirc;i (<span class=\"katex-html\" aria-hidden=\"true\"><span class=\"base\"><span class=\"mord\">90</span><span class=\"mbin\">&minus;</span></span><span class=\"base\"><span class=\"mord\">10</span><span class=\"mord\">0<span class=\"mbin mtight\">∘</span></span><span class=\"mord mathnormal\">C</span></span></span>). Chờ từ 3 - 5 ph&uacute;t để tr&agrave; ngấm vị ngọt rồi thưởng thức.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,1,0\">Pha tr&agrave; hỗn hợp: D&ugrave;ng 1 t&uacute;i tr&agrave; cỏ ngọt pha chung với c&aacute;c loại tr&agrave; kh&aacute;c (như Tr&agrave; Hoa C&uacute;c, Tr&agrave; Artiso, Tr&agrave; Xanh) để tạo vị ngọt thanh tự nhi&ecirc;n thay thế cho đường hoặc mật ong.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,2,0\">Thưởng thức: C&oacute; thể uống n&oacute;ng hoặc th&ecirc;m đ&aacute; t&ugrave;y sở th&iacute;ch. Sử dụng từ 1-3 t&uacute;i mỗi ng&agrave;y để đạt hiệu quả sức khỏe tốt nhất.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"8\"><strong>4. C&aacute;ch bảo quản</strong></h3>\r\n<ul data-path-to-node=\"9\">\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,0,0\">M&ocirc;i trường: Để nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh những nơi c&oacute; độ ẩm cao hoặc c&oacute; m&ugrave;i mạnh (như bếp, nh&agrave; tắm).</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,1,0\">&Aacute;nh s&aacute;ng: Tr&aacute;nh tiếp x&uacute;c trực tiếp với &aacute;nh nắng mặt trời v&igrave; nhiệt độ cao c&oacute; thể l&agrave;m biến đổi dược t&iacute;nh của cỏ ngọt.</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,2,0\">Đ&oacute;ng g&oacute;i: Lu&ocirc;n đ&oacute;ng k&iacute;n miệng t&uacute;i hoặc cho v&agrave;o hũ thủy tinh đậy nắp chặt sau khi mở hộp để giữ trọn hương thơm v&agrave; vị ngọt đặc trưng.</p>\r\n</li>\r\n<li>\r\n<p style=\"line-height: 2;\" data-path-to-node=\"9,3,0\">Lưu &yacute;: Kh&ocirc;ng sử dụng sản phẩm nếu thấy t&uacute;i tr&agrave; c&oacute; dấu hiệu ẩm mốc hoặc qu&aacute; hạn sử dụng (thường l&agrave; 24 th&aacute;ng kể từ ng&agrave;y sản xuất).</p>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>', 25, 100, '2026-02-25 05:04:02', '2026-03-04 01:36:29', 486, NULL, NULL),
(97, 'ori#95216', 'Bột Cần Tây', 'Bột nguyên chất, công nghệ sấy nhiệt độ thấp, xay chậm siêu mịn', 150000, 40, 'san-pham/bot-can-tay', 'no', 'active', NULL, '<div class=\"container\">\r\n<div id=\"model-response-message-contentr_c67addcc28564745\" class=\"markdown markdown-main-panel stronger enable-updated-hr-color preserve-whitespaces-in-response\" dir=\"ltr\" style=\"line-height: 2;\" aria-live=\"polite\" aria-busy=\"false\">\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"2\"><strong>1. Th&agrave;nh phần</strong></h3>\r\n<ul data-path-to-node=\"3\">\r\n<li>\r\n<p data-path-to-node=\"3,0,0\">Cỏ ngọt nguy&ecirc;n chất (100%): Được chiết xuất từ l&aacute; c&acirc;y cỏ ngọt (<em data-path-to-node=\"3,0,0\" data-index-in-node=\"63\">Stevia rebaudiana</em>) tự nhi&ecirc;n, kh&ocirc;ng pha trộn đường k&iacute;nh hay tạp chất.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,1,0\">Đặc điểm: Chứa hoạt chất Stevioside tạo vị ngọt tự nhi&ecirc;n gấp 300 lần đường saccarose nhưng <strong data-path-to-node=\"3,1,0\" data-index-in-node=\"91\">kh&ocirc;ng chứa calo</strong>.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,2,0\">Cam kết: Kh&ocirc;ng chất bảo quản, kh&ocirc;ng hương liệu nh&acirc;n tạo v&agrave; kh&ocirc;ng phẩm m&agrave;u.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"4\"><strong>2. C&ocirc;ng dụng nổi bật</strong></h3>\r\n<ul data-path-to-node=\"5\">\r\n<li>\r\n<p data-path-to-node=\"5,0,0\">Hỗ trợ người tiểu đường &amp; cao huyết &aacute;p: Gi&uacute;p thỏa m&atilde;n cơn th&egrave;m ngọt m&agrave; kh&ocirc;ng l&agrave;m tăng chỉ số đường huyết, hỗ trợ ổn định huyết &aacute;p.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,1,0\">Hỗ trợ giảm c&acirc;n: L&agrave; lựa chọn thay thế đường ho&agrave;n hảo cho người đang trong chế độ Eat Clean, Keto hoặc người muốn cắt giảm năng lượng dư thừa.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,2,0\">Thanh nhiệt &amp; Giải độc: Gi&uacute;p l&agrave;m m&aacute;t gan, giảm mụn nhọt v&agrave; hỗ trợ hệ ti&ecirc;u h&oacute;a hoạt động trơn tru hơn.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,3,0\">Chống oxy h&oacute;a: Gi&uacute;p tăng cường sức đề kh&aacute;ng tự nhi&ecirc;n cho cơ thể nhờ c&aacute;c hợp chất thảo mộc.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"6\"><strong>3. C&aacute;ch sử dụng</strong></h3>\r\n<ul data-path-to-node=\"7\">\r\n<li>\r\n<p data-path-to-node=\"7,0,0\">Pha tr&agrave; nguy&ecirc;n chất: Cho 1 t&uacute;i lọc v&agrave;o t&aacute;ch, r&oacute;t khoảng 150ml - 200ml nước s&ocirc;i (<span class=\"katex-html\" aria-hidden=\"true\"><span class=\"base\"><span class=\"mord\">90</span><span class=\"mbin\">&minus;</span></span><span class=\"base\"><span class=\"mord\">10</span><span class=\"mord\">0<span class=\"mbin mtight\">∘</span></span><span class=\"mord mathnormal\">C</span></span></span>). Chờ từ 3 - 5 ph&uacute;t để tr&agrave; ngấm vị ngọt rồi thưởng thức.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,1,0\">Pha tr&agrave; hỗn hợp: D&ugrave;ng 1 t&uacute;i tr&agrave; cỏ ngọt pha chung với c&aacute;c loại tr&agrave; kh&aacute;c (như Tr&agrave; Hoa C&uacute;c, Tr&agrave; Artiso, Tr&agrave; Xanh) để tạo vị ngọt thanh tự nhi&ecirc;n thay thế cho đường hoặc mật ong.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,2,0\">Thưởng thức: C&oacute; thể uống n&oacute;ng hoặc th&ecirc;m đ&aacute; t&ugrave;y sở th&iacute;ch. Sử dụng từ 1-3 t&uacute;i mỗi ng&agrave;y để đạt hiệu quả sức khỏe tốt nhất.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"8\"><strong>4. C&aacute;ch bảo quản</strong></h3>\r\n<ul data-path-to-node=\"9\">\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,0,0\">M&ocirc;i trường: Để nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh những nơi c&oacute; độ ẩm cao hoặc c&oacute; m&ugrave;i mạnh (như bếp, nh&agrave; tắm).</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,1,0\">&Aacute;nh s&aacute;ng: Tr&aacute;nh tiếp x&uacute;c trực tiếp với &aacute;nh nắng mặt trời v&igrave; nhiệt độ cao c&oacute; thể l&agrave;m biến đổi dược t&iacute;nh của cỏ ngọt.</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,2,0\">Đ&oacute;ng g&oacute;i: Lu&ocirc;n đ&oacute;ng k&iacute;n miệng t&uacute;i hoặc cho v&agrave;o hũ thủy tinh đậy nắp chặt sau khi mở hộp để giữ trọn hương thơm v&agrave; vị ngọt đặc trưng.</p>\r\n</li>\r\n<li>\r\n<p style=\"line-height: 2;\" data-path-to-node=\"9,3,0\">Lưu &yacute;: Kh&ocirc;ng sử dụng sản phẩm nếu thấy t&uacute;i tr&agrave; c&oacute; dấu hiệu ẩm mốc hoặc qu&aacute; hạn sử dụng (thường l&agrave; 24 th&aacute;ng kể từ ng&agrave;y sản xuất).</p>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>', 25, 100, '2026-02-25 05:04:59', '2026-03-04 01:36:22', 487, NULL, 10),
(98, 'ori#954462', 'Trà hà thủ ô túi lọc', 'Thảo mộc cho sức khoẻ, thơm dịu vị thiên nhiên', 70000, 50, 'san-pham/tra-ha-thu-o-tui-loc', 'no', 'active', NULL, '<div class=\"container\">\r\n<div id=\"model-response-message-contentr_c67addcc28564745\" class=\"markdown markdown-main-panel stronger enable-updated-hr-color preserve-whitespaces-in-response\" dir=\"ltr\" style=\"line-height: 2;\" aria-live=\"polite\" aria-busy=\"false\">\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"2\"><strong>1. Th&agrave;nh phần</strong></h3>\r\n<ul data-path-to-node=\"3\">\r\n<li>\r\n<p data-path-to-node=\"3,0,0\">Cỏ ngọt nguy&ecirc;n chất (100%): Được chiết xuất từ l&aacute; c&acirc;y cỏ ngọt (<em data-path-to-node=\"3,0,0\" data-index-in-node=\"63\">Stevia rebaudiana</em>) tự nhi&ecirc;n, kh&ocirc;ng pha trộn đường k&iacute;nh hay tạp chất.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,1,0\">Đặc điểm: Chứa hoạt chất Stevioside tạo vị ngọt tự nhi&ecirc;n gấp 300 lần đường saccarose nhưng <strong data-path-to-node=\"3,1,0\" data-index-in-node=\"91\">kh&ocirc;ng chứa calo</strong>.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,2,0\">Cam kết: Kh&ocirc;ng chất bảo quản, kh&ocirc;ng hương liệu nh&acirc;n tạo v&agrave; kh&ocirc;ng phẩm m&agrave;u.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"4\"><strong>2. C&ocirc;ng dụng nổi bật</strong></h3>\r\n<ul data-path-to-node=\"5\">\r\n<li>\r\n<p data-path-to-node=\"5,0,0\">Hỗ trợ người tiểu đường &amp; cao huyết &aacute;p: Gi&uacute;p thỏa m&atilde;n cơn th&egrave;m ngọt m&agrave; kh&ocirc;ng l&agrave;m tăng chỉ số đường huyết, hỗ trợ ổn định huyết &aacute;p.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,1,0\">Hỗ trợ giảm c&acirc;n: L&agrave; lựa chọn thay thế đường ho&agrave;n hảo cho người đang trong chế độ Eat Clean, Keto hoặc người muốn cắt giảm năng lượng dư thừa.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,2,0\">Thanh nhiệt &amp; Giải độc: Gi&uacute;p l&agrave;m m&aacute;t gan, giảm mụn nhọt v&agrave; hỗ trợ hệ ti&ecirc;u h&oacute;a hoạt động trơn tru hơn.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,3,0\">Chống oxy h&oacute;a: Gi&uacute;p tăng cường sức đề kh&aacute;ng tự nhi&ecirc;n cho cơ thể nhờ c&aacute;c hợp chất thảo mộc.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"6\"><strong>3. C&aacute;ch sử dụng</strong></h3>\r\n<ul data-path-to-node=\"7\">\r\n<li>\r\n<p data-path-to-node=\"7,0,0\">Pha tr&agrave; nguy&ecirc;n chất: Cho 1 t&uacute;i lọc v&agrave;o t&aacute;ch, r&oacute;t khoảng 150ml - 200ml nước s&ocirc;i (<span class=\"katex-html\" aria-hidden=\"true\"><span class=\"base\"><span class=\"mord\">90</span><span class=\"mbin\">&minus;</span></span><span class=\"base\"><span class=\"mord\">10</span><span class=\"mord\">0<span class=\"mbin mtight\">∘</span></span><span class=\"mord mathnormal\">C</span></span></span>). Chờ từ 3 - 5 ph&uacute;t để tr&agrave; ngấm vị ngọt rồi thưởng thức.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,1,0\">Pha tr&agrave; hỗn hợp: D&ugrave;ng 1 t&uacute;i tr&agrave; cỏ ngọt pha chung với c&aacute;c loại tr&agrave; kh&aacute;c (như Tr&agrave; Hoa C&uacute;c, Tr&agrave; Artiso, Tr&agrave; Xanh) để tạo vị ngọt thanh tự nhi&ecirc;n thay thế cho đường hoặc mật ong.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,2,0\">Thưởng thức: C&oacute; thể uống n&oacute;ng hoặc th&ecirc;m đ&aacute; t&ugrave;y sở th&iacute;ch. Sử dụng từ 1-3 t&uacute;i mỗi ng&agrave;y để đạt hiệu quả sức khỏe tốt nhất.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"8\"><strong>4. C&aacute;ch bảo quản</strong></h3>\r\n<ul data-path-to-node=\"9\">\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,0,0\">M&ocirc;i trường: Để nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh những nơi c&oacute; độ ẩm cao hoặc c&oacute; m&ugrave;i mạnh (như bếp, nh&agrave; tắm).</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,1,0\">&Aacute;nh s&aacute;ng: Tr&aacute;nh tiếp x&uacute;c trực tiếp với &aacute;nh nắng mặt trời v&igrave; nhiệt độ cao c&oacute; thể l&agrave;m biến đổi dược t&iacute;nh của cỏ ngọt.</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,2,0\">Đ&oacute;ng g&oacute;i: Lu&ocirc;n đ&oacute;ng k&iacute;n miệng t&uacute;i hoặc cho v&agrave;o hũ thủy tinh đậy nắp chặt sau khi mở hộp để giữ trọn hương thơm v&agrave; vị ngọt đặc trưng.</p>\r\n</li>\r\n<li>\r\n<p style=\"line-height: 2;\" data-path-to-node=\"9,3,0\">Lưu &yacute;: Kh&ocirc;ng sử dụng sản phẩm nếu thấy t&uacute;i tr&agrave; c&oacute; dấu hiệu ẩm mốc hoặc qu&aacute; hạn sử dụng (thường l&agrave; 24 th&aacute;ng kể từ ng&agrave;y sản xuất).</p>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>', 25, 101, '2026-02-25 05:19:29', '2026-03-04 12:32:52', 488, NULL, NULL),
(99, 'ori#84923', 'Trà Gừng Túi Lọc', 'Trà thảo mộc cho sức khoẻ, thơm dịu vị thiên nhiên', 80000, 35, 'san-pham/tra-gung-tui-loc', 'no', 'active', NULL, '<div class=\"container\">\r\n<div id=\"model-response-message-contentr_c67addcc28564745\" class=\"markdown markdown-main-panel stronger enable-updated-hr-color preserve-whitespaces-in-response\" dir=\"ltr\" style=\"line-height: 2;\" aria-live=\"polite\" aria-busy=\"false\">\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"2\"><strong>1. Th&agrave;nh phần</strong></h3>\r\n<ul data-path-to-node=\"3\">\r\n<li>\r\n<p data-path-to-node=\"3,0,0\">Cỏ ngọt nguy&ecirc;n chất (100%): Được chiết xuất từ l&aacute; c&acirc;y cỏ ngọt (<em data-path-to-node=\"3,0,0\" data-index-in-node=\"63\">Stevia rebaudiana</em>) tự nhi&ecirc;n, kh&ocirc;ng pha trộn đường k&iacute;nh hay tạp chất.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,1,0\">Đặc điểm: Chứa hoạt chất Stevioside tạo vị ngọt tự nhi&ecirc;n gấp 300 lần đường saccarose nhưng <strong data-path-to-node=\"3,1,0\" data-index-in-node=\"91\">kh&ocirc;ng chứa calo</strong>.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,2,0\">Cam kết: Kh&ocirc;ng chất bảo quản, kh&ocirc;ng hương liệu nh&acirc;n tạo v&agrave; kh&ocirc;ng phẩm m&agrave;u.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"4\"><strong>2. C&ocirc;ng dụng nổi bật</strong></h3>\r\n<ul data-path-to-node=\"5\">\r\n<li>\r\n<p data-path-to-node=\"5,0,0\">Hỗ trợ người tiểu đường &amp; cao huyết &aacute;p: Gi&uacute;p thỏa m&atilde;n cơn th&egrave;m ngọt m&agrave; kh&ocirc;ng l&agrave;m tăng chỉ số đường huyết, hỗ trợ ổn định huyết &aacute;p.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,1,0\">Hỗ trợ giảm c&acirc;n: L&agrave; lựa chọn thay thế đường ho&agrave;n hảo cho người đang trong chế độ Eat Clean, Keto hoặc người muốn cắt giảm năng lượng dư thừa.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,2,0\">Thanh nhiệt &amp; Giải độc: Gi&uacute;p l&agrave;m m&aacute;t gan, giảm mụn nhọt v&agrave; hỗ trợ hệ ti&ecirc;u h&oacute;a hoạt động trơn tru hơn.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,3,0\">Chống oxy h&oacute;a: Gi&uacute;p tăng cường sức đề kh&aacute;ng tự nhi&ecirc;n cho cơ thể nhờ c&aacute;c hợp chất thảo mộc.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"6\"><strong>3. C&aacute;ch sử dụng</strong></h3>\r\n<ul data-path-to-node=\"7\">\r\n<li>\r\n<p data-path-to-node=\"7,0,0\">Pha tr&agrave; nguy&ecirc;n chất: Cho 1 t&uacute;i lọc v&agrave;o t&aacute;ch, r&oacute;t khoảng 150ml - 200ml nước s&ocirc;i (<span class=\"katex-html\" aria-hidden=\"true\"><span class=\"base\"><span class=\"mord\">90</span><span class=\"mbin\">&minus;</span></span><span class=\"base\"><span class=\"mord\">10</span><span class=\"mord\">0<span class=\"mbin mtight\">∘</span></span><span class=\"mord mathnormal\">C</span></span></span>). Chờ từ 3 - 5 ph&uacute;t để tr&agrave; ngấm vị ngọt rồi thưởng thức.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,1,0\">Pha tr&agrave; hỗn hợp: D&ugrave;ng 1 t&uacute;i tr&agrave; cỏ ngọt pha chung với c&aacute;c loại tr&agrave; kh&aacute;c (như Tr&agrave; Hoa C&uacute;c, Tr&agrave; Artiso, Tr&agrave; Xanh) để tạo vị ngọt thanh tự nhi&ecirc;n thay thế cho đường hoặc mật ong.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,2,0\">Thưởng thức: C&oacute; thể uống n&oacute;ng hoặc th&ecirc;m đ&aacute; t&ugrave;y sở th&iacute;ch. Sử dụng từ 1-3 t&uacute;i mỗi ng&agrave;y để đạt hiệu quả sức khỏe tốt nhất.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"8\"><strong>4. C&aacute;ch bảo quản</strong></h3>\r\n<ul data-path-to-node=\"9\">\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,0,0\">M&ocirc;i trường: Để nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh những nơi c&oacute; độ ẩm cao hoặc c&oacute; m&ugrave;i mạnh (như bếp, nh&agrave; tắm).</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,1,0\">&Aacute;nh s&aacute;ng: Tr&aacute;nh tiếp x&uacute;c trực tiếp với &aacute;nh nắng mặt trời v&igrave; nhiệt độ cao c&oacute; thể l&agrave;m biến đổi dược t&iacute;nh của cỏ ngọt.</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,2,0\">Đ&oacute;ng g&oacute;i: Lu&ocirc;n đ&oacute;ng k&iacute;n miệng t&uacute;i hoặc cho v&agrave;o hũ thủy tinh đậy nắp chặt sau khi mở hộp để giữ trọn hương thơm v&agrave; vị ngọt đặc trưng.</p>\r\n</li>\r\n<li>\r\n<p style=\"line-height: 2;\" data-path-to-node=\"9,3,0\">Lưu &yacute;: Kh&ocirc;ng sử dụng sản phẩm nếu thấy t&uacute;i tr&agrave; c&oacute; dấu hiệu ẩm mốc hoặc qu&aacute; hạn sử dụng (thường l&agrave; 24 th&aacute;ng kể từ ng&agrave;y sản xuất).</p>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>', 25, 101, '2026-02-25 05:20:56', '2026-03-05 13:44:49', 489, NULL, 1),
(100, 'ori#844563', 'Trà Diệp Hạ Châu Túi Lọc', 'Thảo mộc cho sức khoẻ, thơm dịu vị thiên nhiên', 80000, 23, 'san-pham/tra-diep-ha-chau-tui-loc', 'no', 'active', NULL, '<div class=\"container\">\r\n<div id=\"model-response-message-contentr_c67addcc28564745\" class=\"markdown markdown-main-panel stronger enable-updated-hr-color preserve-whitespaces-in-response\" dir=\"ltr\" style=\"line-height: 2;\" aria-live=\"polite\" aria-busy=\"false\">\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"2\"><strong>1. Th&agrave;nh phần</strong></h3>\r\n<ul data-path-to-node=\"3\">\r\n<li>\r\n<p data-path-to-node=\"3,0,0\">Cỏ ngọt nguy&ecirc;n chất (100%): Được chiết xuất từ l&aacute; c&acirc;y cỏ ngọt (<em data-path-to-node=\"3,0,0\" data-index-in-node=\"63\">Stevia rebaudiana</em>) tự nhi&ecirc;n, kh&ocirc;ng pha trộn đường k&iacute;nh hay tạp chất.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,1,0\">Đặc điểm: Chứa hoạt chất Stevioside tạo vị ngọt tự nhi&ecirc;n gấp 300 lần đường saccarose nhưng <strong data-path-to-node=\"3,1,0\" data-index-in-node=\"91\">kh&ocirc;ng chứa calo</strong>.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,2,0\">Cam kết: Kh&ocirc;ng chất bảo quản, kh&ocirc;ng hương liệu nh&acirc;n tạo v&agrave; kh&ocirc;ng phẩm m&agrave;u.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"4\"><strong>2. C&ocirc;ng dụng nổi bật</strong></h3>\r\n<ul data-path-to-node=\"5\">\r\n<li>\r\n<p data-path-to-node=\"5,0,0\">Hỗ trợ người tiểu đường &amp; cao huyết &aacute;p: Gi&uacute;p thỏa m&atilde;n cơn th&egrave;m ngọt m&agrave; kh&ocirc;ng l&agrave;m tăng chỉ số đường huyết, hỗ trợ ổn định huyết &aacute;p.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,1,0\">Hỗ trợ giảm c&acirc;n: L&agrave; lựa chọn thay thế đường ho&agrave;n hảo cho người đang trong chế độ Eat Clean, Keto hoặc người muốn cắt giảm năng lượng dư thừa.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,2,0\">Thanh nhiệt &amp; Giải độc: Gi&uacute;p l&agrave;m m&aacute;t gan, giảm mụn nhọt v&agrave; hỗ trợ hệ ti&ecirc;u h&oacute;a hoạt động trơn tru hơn.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,3,0\">Chống oxy h&oacute;a: Gi&uacute;p tăng cường sức đề kh&aacute;ng tự nhi&ecirc;n cho cơ thể nhờ c&aacute;c hợp chất thảo mộc.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"6\"><strong>3. C&aacute;ch sử dụng</strong></h3>\r\n<ul data-path-to-node=\"7\">\r\n<li>\r\n<p data-path-to-node=\"7,0,0\">Pha tr&agrave; nguy&ecirc;n chất: Cho 1 t&uacute;i lọc v&agrave;o t&aacute;ch, r&oacute;t khoảng 150ml - 200ml nước s&ocirc;i (<span class=\"katex-html\" aria-hidden=\"true\"><span class=\"base\"><span class=\"mord\">90</span><span class=\"mbin\">&minus;</span></span><span class=\"base\"><span class=\"mord\">10</span><span class=\"mord\">0<span class=\"mbin mtight\">∘</span></span><span class=\"mord mathnormal\">C</span></span></span>). Chờ từ 3 - 5 ph&uacute;t để tr&agrave; ngấm vị ngọt rồi thưởng thức.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,1,0\">Pha tr&agrave; hỗn hợp: D&ugrave;ng 1 t&uacute;i tr&agrave; cỏ ngọt pha chung với c&aacute;c loại tr&agrave; kh&aacute;c (như Tr&agrave; Hoa C&uacute;c, Tr&agrave; Artiso, Tr&agrave; Xanh) để tạo vị ngọt thanh tự nhi&ecirc;n thay thế cho đường hoặc mật ong.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,2,0\">Thưởng thức: C&oacute; thể uống n&oacute;ng hoặc th&ecirc;m đ&aacute; t&ugrave;y sở th&iacute;ch. Sử dụng từ 1-3 t&uacute;i mỗi ng&agrave;y để đạt hiệu quả sức khỏe tốt nhất.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"8\"><strong>4. C&aacute;ch bảo quản</strong></h3>\r\n<ul data-path-to-node=\"9\">\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,0,0\">M&ocirc;i trường: Để nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh những nơi c&oacute; độ ẩm cao hoặc c&oacute; m&ugrave;i mạnh (như bếp, nh&agrave; tắm).</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,1,0\">&Aacute;nh s&aacute;ng: Tr&aacute;nh tiếp x&uacute;c trực tiếp với &aacute;nh nắng mặt trời v&igrave; nhiệt độ cao c&oacute; thể l&agrave;m biến đổi dược t&iacute;nh của cỏ ngọt.</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,2,0\">Đ&oacute;ng g&oacute;i: Lu&ocirc;n đ&oacute;ng k&iacute;n miệng t&uacute;i hoặc cho v&agrave;o hũ thủy tinh đậy nắp chặt sau khi mở hộp để giữ trọn hương thơm v&agrave; vị ngọt đặc trưng.</p>\r\n</li>\r\n<li>\r\n<p style=\"line-height: 2;\" data-path-to-node=\"9,3,0\">Lưu &yacute;: Kh&ocirc;ng sử dụng sản phẩm nếu thấy t&uacute;i tr&agrave; c&oacute; dấu hiệu ẩm mốc hoặc qu&aacute; hạn sử dụng (thường l&agrave; 24 th&aacute;ng kể từ ng&agrave;y sản xuất).</p>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>', 25, 101, '2026-02-25 05:21:36', '2026-03-05 13:44:49', 490, NULL, 1),
(101, 'ori#648923', 'Trà Đắng Túi Lọc', 'Thảo mộc cho sức khoẻ, thơm dịu vị thiên nhiên', 80000, -49, 'san-pham/tra-dang-tui-loc', 'no', 'active', NULL, '<div class=\"container\">\r\n<div id=\"model-response-message-contentr_c67addcc28564745\" class=\"markdown markdown-main-panel stronger enable-updated-hr-color preserve-whitespaces-in-response\" dir=\"ltr\" style=\"line-height: 2;\" aria-live=\"polite\" aria-busy=\"false\">\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"2\"><strong>1. Th&agrave;nh phần</strong></h3>\r\n<ul data-path-to-node=\"3\">\r\n<li>\r\n<p data-path-to-node=\"3,0,0\">Cỏ ngọt nguy&ecirc;n chất (100%): Được chiết xuất từ l&aacute; c&acirc;y cỏ ngọt (<em data-path-to-node=\"3,0,0\" data-index-in-node=\"63\">Stevia rebaudiana</em>) tự nhi&ecirc;n, kh&ocirc;ng pha trộn đường k&iacute;nh hay tạp chất.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,1,0\">Đặc điểm: Chứa hoạt chất Stevioside tạo vị ngọt tự nhi&ecirc;n gấp 300 lần đường saccarose nhưng <strong data-path-to-node=\"3,1,0\" data-index-in-node=\"91\">kh&ocirc;ng chứa calo</strong>.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,2,0\">Cam kết: Kh&ocirc;ng chất bảo quản, kh&ocirc;ng hương liệu nh&acirc;n tạo v&agrave; kh&ocirc;ng phẩm m&agrave;u.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"4\"><strong>2. C&ocirc;ng dụng nổi bật</strong></h3>\r\n<ul data-path-to-node=\"5\">\r\n<li>\r\n<p data-path-to-node=\"5,0,0\">Hỗ trợ người tiểu đường &amp; cao huyết &aacute;p: Gi&uacute;p thỏa m&atilde;n cơn th&egrave;m ngọt m&agrave; kh&ocirc;ng l&agrave;m tăng chỉ số đường huyết, hỗ trợ ổn định huyết &aacute;p.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,1,0\">Hỗ trợ giảm c&acirc;n: L&agrave; lựa chọn thay thế đường ho&agrave;n hảo cho người đang trong chế độ Eat Clean, Keto hoặc người muốn cắt giảm năng lượng dư thừa.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,2,0\">Thanh nhiệt &amp; Giải độc: Gi&uacute;p l&agrave;m m&aacute;t gan, giảm mụn nhọt v&agrave; hỗ trợ hệ ti&ecirc;u h&oacute;a hoạt động trơn tru hơn.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,3,0\">Chống oxy h&oacute;a: Gi&uacute;p tăng cường sức đề kh&aacute;ng tự nhi&ecirc;n cho cơ thể nhờ c&aacute;c hợp chất thảo mộc.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"6\"><strong>3. C&aacute;ch sử dụng</strong></h3>\r\n<ul data-path-to-node=\"7\">\r\n<li>\r\n<p data-path-to-node=\"7,0,0\">Pha tr&agrave; nguy&ecirc;n chất: Cho 1 t&uacute;i lọc v&agrave;o t&aacute;ch, r&oacute;t khoảng 150ml - 200ml nước s&ocirc;i (<span class=\"katex-html\" aria-hidden=\"true\"><span class=\"base\"><span class=\"mord\">90</span><span class=\"mbin\">&minus;</span></span><span class=\"base\"><span class=\"mord\">10</span><span class=\"mord\">0<span class=\"mbin mtight\">∘</span></span><span class=\"mord mathnormal\">C</span></span></span>). Chờ từ 3 - 5 ph&uacute;t để tr&agrave; ngấm vị ngọt rồi thưởng thức.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,1,0\">Pha tr&agrave; hỗn hợp: D&ugrave;ng 1 t&uacute;i tr&agrave; cỏ ngọt pha chung với c&aacute;c loại tr&agrave; kh&aacute;c (như Tr&agrave; Hoa C&uacute;c, Tr&agrave; Artiso, Tr&agrave; Xanh) để tạo vị ngọt thanh tự nhi&ecirc;n thay thế cho đường hoặc mật ong.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,2,0\">Thưởng thức: C&oacute; thể uống n&oacute;ng hoặc th&ecirc;m đ&aacute; t&ugrave;y sở th&iacute;ch. Sử dụng từ 1-3 t&uacute;i mỗi ng&agrave;y để đạt hiệu quả sức khỏe tốt nhất.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"8\"><strong>4. C&aacute;ch bảo quản</strong></h3>\r\n<ul data-path-to-node=\"9\">\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,0,0\">M&ocirc;i trường: Để nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh những nơi c&oacute; độ ẩm cao hoặc c&oacute; m&ugrave;i mạnh (như bếp, nh&agrave; tắm).</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,1,0\">&Aacute;nh s&aacute;ng: Tr&aacute;nh tiếp x&uacute;c trực tiếp với &aacute;nh nắng mặt trời v&igrave; nhiệt độ cao c&oacute; thể l&agrave;m biến đổi dược t&iacute;nh của cỏ ngọt.</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,2,0\">Đ&oacute;ng g&oacute;i: Lu&ocirc;n đ&oacute;ng k&iacute;n miệng t&uacute;i hoặc cho v&agrave;o hũ thủy tinh đậy nắp chặt sau khi mở hộp để giữ trọn hương thơm v&agrave; vị ngọt đặc trưng.</p>\r\n</li>\r\n<li>\r\n<p style=\"line-height: 2;\" data-path-to-node=\"9,3,0\">Lưu &yacute;: Kh&ocirc;ng sử dụng sản phẩm nếu thấy t&uacute;i tr&agrave; c&oacute; dấu hiệu ẩm mốc hoặc qu&aacute; hạn sử dụng (thường l&agrave; 24 th&aacute;ng kể từ ng&agrave;y sản xuất).</p>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>', 25, 101, '2026-02-25 05:22:09', '2026-03-05 13:44:49', 491, NULL, 1),
(102, 'ori#545643', 'Trà Cỏ Ngọt Túi Lọc', 'Thảo mộc cho sức khoẻ, thơm dịu vị thiên nhiên', 80000, 10, 'san-pham/tra-co-ngot-tui-loc', 'no', 'active', NULL, '<div class=\"container\">\r\n<div id=\"model-response-message-contentr_c67addcc28564745\" class=\"markdown markdown-main-panel stronger enable-updated-hr-color preserve-whitespaces-in-response\" dir=\"ltr\" style=\"line-height: 2;\" aria-live=\"polite\" aria-busy=\"false\">\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"2\"><strong>1. Th&agrave;nh phần</strong></h3>\r\n<ul data-path-to-node=\"3\">\r\n<li>\r\n<p data-path-to-node=\"3,0,0\">Cỏ ngọt nguy&ecirc;n chất (100%): Được chiết xuất từ l&aacute; c&acirc;y cỏ ngọt (<em data-path-to-node=\"3,0,0\" data-index-in-node=\"63\">Stevia rebaudiana</em>) tự nhi&ecirc;n, kh&ocirc;ng pha trộn đường k&iacute;nh hay tạp chất.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,1,0\">Đặc điểm: Chứa hoạt chất Stevioside tạo vị ngọt tự nhi&ecirc;n gấp 300 lần đường saccarose nhưng <strong data-path-to-node=\"3,1,0\" data-index-in-node=\"91\">kh&ocirc;ng chứa calo</strong>.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"3,2,0\">Cam kết: Kh&ocirc;ng chất bảo quản, kh&ocirc;ng hương liệu nh&acirc;n tạo v&agrave; kh&ocirc;ng phẩm m&agrave;u.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"4\"><strong>2. C&ocirc;ng dụng nổi bật</strong></h3>\r\n<ul data-path-to-node=\"5\">\r\n<li>\r\n<p data-path-to-node=\"5,0,0\">Hỗ trợ người tiểu đường &amp; cao huyết &aacute;p: Gi&uacute;p thỏa m&atilde;n cơn th&egrave;m ngọt m&agrave; kh&ocirc;ng l&agrave;m tăng chỉ số đường huyết, hỗ trợ ổn định huyết &aacute;p.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,1,0\">Hỗ trợ giảm c&acirc;n: L&agrave; lựa chọn thay thế đường ho&agrave;n hảo cho người đang trong chế độ Eat Clean, Keto hoặc người muốn cắt giảm năng lượng dư thừa.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,2,0\">Thanh nhiệt &amp; Giải độc: Gi&uacute;p l&agrave;m m&aacute;t gan, giảm mụn nhọt v&agrave; hỗ trợ hệ ti&ecirc;u h&oacute;a hoạt động trơn tru hơn.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"5,3,0\">Chống oxy h&oacute;a: Gi&uacute;p tăng cường sức đề kh&aacute;ng tự nhi&ecirc;n cho cơ thể nhờ c&aacute;c hợp chất thảo mộc.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"6\"><strong>3. C&aacute;ch sử dụng</strong></h3>\r\n<ul data-path-to-node=\"7\">\r\n<li>\r\n<p data-path-to-node=\"7,0,0\">Pha tr&agrave; nguy&ecirc;n chất: Cho 1 t&uacute;i lọc v&agrave;o t&aacute;ch, r&oacute;t khoảng 150ml - 200ml nước s&ocirc;i (<span class=\"katex-html\" aria-hidden=\"true\"><span class=\"base\"><span class=\"mord\">90</span><span class=\"mbin\">&minus;</span></span><span class=\"base\"><span class=\"mord\">10</span><span class=\"mord\">0<span class=\"mbin mtight\">∘</span></span><span class=\"mord mathnormal\">C</span></span></span>). Chờ từ 3 - 5 ph&uacute;t để tr&agrave; ngấm vị ngọt rồi thưởng thức.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,1,0\">Pha tr&agrave; hỗn hợp: D&ugrave;ng 1 t&uacute;i tr&agrave; cỏ ngọt pha chung với c&aacute;c loại tr&agrave; kh&aacute;c (như Tr&agrave; Hoa C&uacute;c, Tr&agrave; Artiso, Tr&agrave; Xanh) để tạo vị ngọt thanh tự nhi&ecirc;n thay thế cho đường hoặc mật ong.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node=\"7,2,0\">Thưởng thức: C&oacute; thể uống n&oacute;ng hoặc th&ecirc;m đ&aacute; t&ugrave;y sở th&iacute;ch. Sử dụng từ 1-3 t&uacute;i mỗi ng&agrave;y để đạt hiệu quả sức khỏe tốt nhất.</p>\r\n</li>\r\n</ul>\r\n<h3 style=\"line-height: 2;\" data-path-to-node=\"8\"><strong>4. C&aacute;ch bảo quản</strong></h3>\r\n<ul data-path-to-node=\"9\">\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,0,0\">M&ocirc;i trường: Để nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh những nơi c&oacute; độ ẩm cao hoặc c&oacute; m&ugrave;i mạnh (như bếp, nh&agrave; tắm).</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,1,0\">&Aacute;nh s&aacute;ng: Tr&aacute;nh tiếp x&uacute;c trực tiếp với &aacute;nh nắng mặt trời v&igrave; nhiệt độ cao c&oacute; thể l&agrave;m biến đổi dược t&iacute;nh của cỏ ngọt.</p>\r\n</li>\r\n<li style=\"line-height: 2;\">\r\n<p data-path-to-node=\"9,2,0\">Đ&oacute;ng g&oacute;i: Lu&ocirc;n đ&oacute;ng k&iacute;n miệng t&uacute;i hoặc cho v&agrave;o hũ thủy tinh đậy nắp chặt sau khi mở hộp để giữ trọn hương thơm v&agrave; vị ngọt đặc trưng.</p>\r\n</li>\r\n<li>\r\n<p style=\"line-height: 2;\" data-path-to-node=\"9,3,0\">Lưu &yacute;: Kh&ocirc;ng sử dụng sản phẩm nếu thấy t&uacute;i tr&agrave; c&oacute; dấu hiệu ẩm mốc hoặc qu&aacute; hạn sử dụng (thường l&agrave; 24 th&aacute;ng kể từ ng&agrave;y sản xuất).</p>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>', 25, 101, '2026-02-25 05:22:36', '2026-03-04 12:32:52', 492, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','unactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `parent_id`, `name`, `slug`, `status`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(52, 0, 'Gói quà tặng', 'san-pham/goi-qua-tang', 'active', 25, '2026-01-30 19:09:38', '2026-02-28 17:45:41', NULL),
(61, 0, 'Hạt dinh dưỡng', 'san-pham/hat-dinh-duong', 'active', 25, '2026-01-30 19:57:45', '2026-02-28 17:34:20', NULL),
(62, 0, 'Hạt mix', 'san-pham/hat-mix', 'active', 25, '2026-01-30 19:58:44', '2026-02-28 17:33:51', NULL),
(74, 0, 'Trái cây sấy', 'san-pham/trai-cay-say', 'unactive', 25, '2026-02-01 05:48:21', '2026-02-22 04:07:21', '2026-02-22 04:07:21'),
(75, 0, 'Thực phẩm Healthy', 'san-pham/thuc-pham-healthy', 'unactive', 25, '2026-02-01 05:49:01', '2026-02-21 07:43:49', '2026-02-21 07:43:49'),
(76, 0, 'Hạt Fitness', 'san-pham/hat-fitness', 'unactive', 25, '2026-02-01 05:49:50', '2026-02-15 04:56:39', '2026-02-15 04:56:39'),
(77, 61, 'Hạt hạnh nhân', 'san-pham/hat-hanh-nhan', 'active', 25, '2026-02-01 05:50:25', '2026-02-10 01:58:37', NULL),
(78, 61, 'Hạt dẻ', 'san-pham/hat-de', 'active', 25, '2026-02-01 05:50:35', '2026-02-25 03:26:57', NULL),
(79, 52, 'Quà tặng người thân', 'san-pham/qua-tang-nguoi-than', 'active', 25, '2026-02-01 05:51:26', '2026-02-24 11:45:45', NULL),
(80, NULL, 'Quà sức khỏe cho người lớn tuổi', 'san-pham/qua-suc-khoe-cho-nguoi-lon-tuoi', 'unactive', 25, '2026-02-01 05:51:38', '2026-02-24 11:45:03', '2026-02-24 11:45:03'),
(81, 62, 'Hạt mix dinh dưỡng', 'san-pham/hat-mix-dinh-duong', 'active', 25, '2026-02-01 05:52:26', '2026-02-10 01:58:37', NULL),
(82, 62, 'Hạt mix original', 'san-pham/hat-mix-combo', 'active', 25, '2026-02-01 05:52:41', '2026-02-25 03:56:24', NULL),
(83, 74, 'Xoài sấy', 'san-pham/xoai-say', 'unactive', 25, '2026-02-01 05:53:27', '2026-02-22 04:07:21', '2026-02-22 04:07:21'),
(84, 74, 'Mít sấy', 'san-pham/mit-say', 'unactive', 25, '2026-02-01 05:53:37', '2026-02-22 04:07:21', '2026-02-22 04:07:21'),
(85, 0, 'Ăn vặt lành mạnh', 'san-pham/an-vat-lanh-manh', 'unactive', 25, '2026-02-01 05:54:37', '2026-02-07 02:42:38', '2026-02-07 02:42:38'),
(90, 0, 'Ăn vặt lành mạnh', 'san-pham/an-vat-lanh-manh', 'active', 25, '2026-02-22 04:09:07', '2026-02-28 17:33:54', NULL),
(91, 0, 'Trái cây sấy khô', 'san-pham/trai-cay-say-kho', 'active', 25, '2026-02-22 04:10:58', '2026-02-25 06:17:58', NULL),
(92, 0, 'Trà cà phê', 'san-pham/tra-ca-phe', 'unactive', 25, '2026-02-22 04:12:13', '2026-02-25 04:28:36', '2026-02-25 04:28:36'),
(93, 0, 'Sản phẩm khác', 'san-pham/san-pham-khac', 'active', 25, '2026-02-22 04:12:24', '2026-02-28 17:33:57', NULL),
(94, 52, 'Quà tặng dịp lễ', 'san-pham/qua-tang-dip-le', 'active', 25, '2026-02-25 03:07:15', '2026-02-25 03:07:15', NULL),
(95, 61, 'Hạt điều', 'san-pham/hat-dieu', 'active', 25, '2026-02-25 03:13:30', '2026-02-25 03:13:30', NULL),
(96, 90, 'Thanh Hạt Dinh Dưỡng', 'san-pham/thanh-hat-dinh-duong', 'active', 25, '2026-02-25 03:58:26', '2026-02-25 04:06:35', NULL),
(97, 90, 'Snack', 'san-pham/fruit-snack', 'active', 25, '2026-02-25 03:59:00', '2026-02-25 04:21:33', NULL),
(98, 91, 'Xoài Sấy', 'san-pham/xoai-say', 'active', 25, '2026-02-25 04:29:45', '2026-02-25 04:29:45', NULL),
(99, 91, 'Mít Sấy', 'san-pham/mit-say', 'active', 25, '2026-02-25 04:29:52', '2026-02-25 04:29:52', NULL),
(100, 93, 'Bột lá', 'san-pham/bot-la', 'active', 25, '2026-02-25 04:55:52', '2026-02-25 04:55:52', NULL),
(101, 93, 'Trà', 'san-pham/tra', 'active', 25, '2026-02-25 05:19:42', '2026-02-25 05:19:42', NULL),
(102, 52, 'test', 'san-pham/test', 'active', 25, '2026-03-04 12:33:27', '2026-03-04 12:33:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `review` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vote_star` int NOT NULL,
  `status` enum('pending','publish','canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `name`, `review`, `vote_star`, `status`, `product_id`, `created_at`, `updated_at`) VALUES
(2, 'Minh Hạnh', 'Hạt hạnh nhân rang bơ rất thơm, giòn tan và không bị gắt dầu. Đóng gói túi zip chắc chắn, tiện bảo quản. Sẽ ủng hộ shop tiếp!', 5, 'publish', 42, '2026-03-02 09:19:52', '2026-03-02 13:17:34'),
(3, 'Quốc Bảo', 'Mình mua hạt điều rang muối, hạt to đều, tỷ lệ hạt vỡ rất ít. Vị mặn vừa phải, ăn rất cuốn. Giao hàng nhanh, đóng gói cẩn thận.', 5, 'publish', 43, '2026-03-02 09:20:14', '2026-03-02 13:17:34'),
(4, 'Thanh Trúc', 'Granola siêu nhiều hạt và trái cây sấy, không bị quá ngọt nên rất hợp với người đang ăn kiêng như mình. Ăn kèm sữa chua rất ngon.', 5, 'publish', 51, '2026-03-02 09:20:48', '2026-03-02 13:17:34'),
(5, 'Hoàng Nam', 'Hạt macca nứt vỏ sẵn nên rất dễ tách, nhân béo ngậy. Tuy nhiên phí ship hơi cao một chút, bù lại chất lượng hạt rất xứng đáng.', 5, 'publish', 82, '2026-03-02 09:21:32', '2026-03-02 13:17:41'),
(6, 'Lan Anh', 'Mix các loại hạt dinh dưỡng rất tiện lợi cho dân văn phòng ăn vặt lành mạnh. Hạt nào cũng tươi, không có mùi hôi cũ. 10 điểm chất lượng!', 5, 'publish', 49, '2026-03-02 09:22:15', '2026-03-02 13:17:41'),
(7, 'Thu Hà', 'Granola socola vị đậm đà, giòn rụm, nhiều yến mạch và hạt hạnh nhân.', 5, 'publish', 51, '2026-03-02 09:24:15', '2026-03-02 13:17:41'),
(8, 'Quang Huy', 'Hạt điều nguyên hạt, không bị vỡ vụn, vị muối rất thanh. Giao hàng cực nhanh', 5, 'publish', 11, '2026-03-02 09:24:52', '2026-03-02 13:17:41'),
(9, 'Bảo Ngọc', 'Mix hạt dinh dưỡng loại cao cấp rất đáng tiền, nhiều macca và hạnh nhân.', 5, 'publish', 45, '2026-03-02 09:25:58', '2026-03-02 13:17:41'),
(10, 'Khánh Linh', 'Hạnh nhân lát mỏng, giòn, dùng làm bánh hay rắc lên smoothie đều ngon.', 5, 'publish', 52, '2026-03-02 09:27:03', '2026-03-02 13:17:41'),
(11, 'Phương Thảo', 'Ngũ cốc lợi sữa rất dễ uống, thơm mùi các loại đậu, mình thấy rất hiệu quả.', 5, 'publish', 51, '2026-03-02 09:27:43', '2026-03-02 13:17:41'),
(12, 'Granola test', 'Sản phẩm trên cả tuyệt vời', 5, 'publish', 51, '2026-03-02 13:18:21', '2026-03-02 13:18:29'),
(13, 'Lưu Đức Vỹ', 'Sản phẩm đúng chất lượng', 5, 'publish', 102, '2026-03-04 11:23:33', '2026-03-04 11:47:53'),
(14, 'Lưu Đức Vỹ', 'Sản phẩm tốt, ngon', 5, 'publish', 102, '2026-03-04 12:37:51', '2026-03-04 12:38:34');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `desc`, `created_at`, `updated_at`) VALUES
(21, 'Admin', 'Quản lí toàn bộ hệ thống', '2026-02-14 12:26:59', '2026-02-14 13:28:46'),
(22, 'Post Manager', 'Quản lí bài viết', '2026-02-14 12:30:21', '2026-02-14 12:30:21'),
(23, 'Website Manager', 'Quản trị viên website', '2026-02-14 12:31:10', '2026-02-14 13:28:26'),
(24, 'Product Manager', 'Quản lí sản phẩm', '2026-02-14 12:31:33', '2026-02-14 12:31:33'),
(25, 'User Manager', 'Quản lí thành viên', '2026-02-14 12:38:21', '2026-02-14 12:38:21');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(55, 21, 20, NULL, NULL),
(56, 21, 21, NULL, NULL),
(57, 21, 22, NULL, NULL),
(58, 21, 23, NULL, NULL),
(59, 21, 24, NULL, NULL),
(60, 21, 25, NULL, NULL),
(61, 21, 26, NULL, NULL),
(62, 21, 27, NULL, NULL),
(63, 21, 28, NULL, NULL),
(64, 21, 29, NULL, NULL),
(65, 21, 30, NULL, NULL),
(66, 21, 31, NULL, NULL),
(67, 21, 32, NULL, NULL),
(68, 21, 33, NULL, NULL),
(69, 21, 34, NULL, NULL),
(70, 21, 35, NULL, NULL),
(71, 21, 36, NULL, NULL),
(72, 21, 37, NULL, NULL),
(73, 21, 38, NULL, NULL),
(74, 21, 39, NULL, NULL),
(75, 21, 40, NULL, NULL),
(76, 21, 41, NULL, NULL),
(77, 21, 42, NULL, NULL),
(78, 21, 43, NULL, NULL),
(79, 21, 44, NULL, NULL),
(80, 21, 45, NULL, NULL),
(81, 21, 46, NULL, NULL),
(82, 21, 47, NULL, NULL),
(83, 21, 48, NULL, NULL),
(84, 22, 30, NULL, NULL),
(85, 22, 31, NULL, NULL),
(86, 22, 32, NULL, NULL),
(87, 22, 33, NULL, NULL),
(88, 22, 34, NULL, NULL),
(89, 23, 35, NULL, NULL),
(90, 23, 36, NULL, NULL),
(91, 23, 37, NULL, NULL),
(92, 23, 38, NULL, NULL),
(93, 23, 39, NULL, NULL),
(94, 23, 40, NULL, NULL),
(95, 23, 41, NULL, NULL),
(96, 23, 42, NULL, NULL),
(97, 23, 43, NULL, NULL),
(98, 23, 44, NULL, NULL),
(99, 23, 45, NULL, NULL),
(100, 23, 46, NULL, NULL),
(101, 24, 25, NULL, NULL),
(102, 24, 26, NULL, NULL),
(103, 24, 27, NULL, NULL),
(104, 24, 28, NULL, NULL),
(105, 24, 29, NULL, NULL),
(106, 25, 20, NULL, NULL),
(107, 25, 21, NULL, NULL),
(108, 25, 22, NULL, NULL),
(109, 25, 23, NULL, NULL),
(110, 25, 24, NULL, NULL),
(111, 21, 49, NULL, NULL),
(112, 23, 50, NULL, NULL),
(113, 21, 50, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('JkaIksKeYysdIpVh5qPKeJkgFzTmyNkhQQxDSvmk', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiYTRHN2NKbllTdUFTV1FrSjl1b3VXVlhwaVBRSFprcjQ3YU9raFZ2aiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1772717667),
('k29GmGQ0MavAJe6HElsGbGfj0dJ5Cnik4jMsKaSQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiOUtWTUNyd3ZTQ0wyZHlEWTZUQm9tY3doWjZSNGNHTk81c0RLTktjVCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1772711104),
('spLPO2uCYdXsiI5saF49Pb2pQ3NSmSFusJxur4l4', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiSTVVVU1ocW9HQ1N4ZGR3ZUlDVDhOdnZJVWw0S2pQRTRDcE1qaG4xUCI7czoxMzoibW9kdWxlX2FjdGl2ZSI7TjtzOjE3OiJzdWJfbW9kdWxlX2FjdGl2ZSI7TjtzOjk6InNlZ21lbnRfNCI7TjtzOjExOiJwYWdlX2FjdGl2ZSI7TjtzOjE1OiJjYXRlZ29yeV9hY3RpdmUiO047czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly9vcmludXRzLnRlc3QiO3M6NToicm91dGUiO3M6MToiLyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1772815283),
('xN1MmVudic7shYRWGORliCLw14fF7TKzThpBFHEO', 25, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'YToxMDp7czo2OiJfdG9rZW4iO3M6NDA6InQwVlhQdDhUcUh3RW8yZmZEbWtjMzhyQTZsVE5NM0ZtOWNSR2hRUEMiO3M6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MTM6Im1vZHVsZV9hY3RpdmUiO3M6OToiZGFzaGJvYXJkIjtzOjE3OiJzdWJfbW9kdWxlX2FjdGl2ZSI7czoxMToiZ2V0TmV3T3JkZXIiO3M6OToic2VnbWVudF80IjtOO3M6MTE6InBhZ2VfYWN0aXZlIjtzOjU6ImFkbWluIjtzOjE1OiJjYXRlZ29yeV9hY3RpdmUiO3M6OToiZGFzaGJvYXJkIjtzOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czozNToiaHR0cDovL29yaW51dHMudGVzdC9hZG1pbi9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTU6ImFkbWluLmRhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI1O3M6NDoiY2FydCI7YTowOnt9fQ==', 1772718379);

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `identifier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `img_id` bigint UNSIGNED NOT NULL,
  `redirect_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL,
  `status` enum('publish','disable') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `img_id`, `redirect_url`, `title`, `desc`, `order`, `status`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(19, 419, NULL, 'Năng lượng xanh từ hạt tự nhiên', 'Tuyển chọn những loại hạt cao cấp nhất, giữ trọn hương vị nguyên bản và giá trị dinh dưỡng cho sức khỏe gia đình bạn.', 1, 'publish', 25, '2026-02-21 07:06:56', '2026-02-28 17:46:04', NULL),
(20, 420, NULL, 'Trao sức khỏe – Gửi tâm giao', 'Những gói quà tặng sang trọng từ hạt dinh dưỡng Orinuts là lời chúc sức khỏe tinh tế nhất dành cho người thân yêu.', 2, 'publish', 25, '2026-02-21 07:07:42', '2026-02-22 05:12:10', NULL),
(21, 437, NULL, 'Khởi Đầu Sự Sống Từ Những Mầm Xanh', 'Cung cấp hạt giống chất lượng cao, tỉ Tỉ lệ nảy mầm vượt trội. Biến không gian sống của bạn thành vườn ươm đầy sức sống.', 3, 'publish', 25, '2026-02-22 05:30:07', '2026-02-22 05:30:07', NULL),
(22, 438, NULL, 'Combo Hạt Giống Cỏ Ba Lá Xanh', 'Hạt giống chất lượng cao, dễ nảy mầm trong mọi điều kiện thời tiết. Tặng kèm hướng dẫn gieo trồng chi tiết.', 4, 'publish', 25, '2026-02-22 06:07:25', '2026-02-22 06:07:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` enum('unactive','active','subpended') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unactive',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_active`, `deleted_at`) VALUES
(25, 'Lưu Đức Vỹ', 'luuvy15899@gmail.com', '2026-01-26 04:29:08', '$2y$12$Dj.YY3fXJ6mEnQESC54XvOzbWiR1bhLmpzraZBepQRaHcrH9noOZy', '5L6N1P26JfZBkY2Og90TDQX5HN8hp8wouUwDJ9tHwJNgHsoFgYMRjkn2GZoI', '2026-01-25 05:37:24', '2026-02-04 11:22:54', 'active', NULL),
(59, 'Thành Nam', 'thanhnam123@gmail.com', '2026-02-28 17:37:10', '$2y$12$lEvHO96HZ7zI5n8wZxfGoecG9yRVtBVB62FveXTss5zkZKegFTtoS', NULL, '2026-02-14 12:42:10', '2026-02-28 17:37:10', 'active', NULL),
(60, 'Hằng Nga', 'hangnga123@gmail.com', '2026-02-14 12:44:21', '$2y$12$I4kIY0stFS8WCpkTTbEMou9sP4A.C1NcrNkPPwTAkIDWRRnfuexoe', NULL, '2026-02-14 12:44:21', '2026-02-21 06:14:58', 'active', NULL),
(61, 'Chân Hoàn', 'chanhoan123@gmail.com', '2026-02-14 12:45:17', '$2y$12$Bfuu1O0jUJhKM4FhiE9MKua/k/C3JVQjk60JFbKBbJoX1m/Ud/9fe', NULL, '2026-02-14 12:45:17', '2026-02-21 06:14:58', 'active', NULL),
(62, 'Tứ Lang', 'tulang123@gmail.com', '2026-02-14 12:45:56', '$2y$12$PDbJo4yEAqyeIFOFh6bbAOrzzNiq/x28MSGMn5i77dDxg3oxdJ2M6', NULL, '2026-02-14 12:45:56', '2026-02-21 06:14:58', 'active', NULL),
(63, 'test', 'test@gmail.com', '2026-02-15 05:11:48', '$2y$12$AduXKz/esH9pNSkiLw8Ow.mMqPltMy85xB3P1u6V.9h5/VS0Tqu/m', NULL, '2026-02-15 05:11:48', '2026-02-15 05:11:53', 'active', '2026-02-15 05:11:53');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(8, 59, 23, NULL, NULL),
(9, 25, 21, NULL, NULL),
(10, 60, 22, NULL, NULL),
(11, 61, 24, NULL, NULL),
(12, 62, 25, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_user_id_foreign` (`user_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`),
  ADD KEY `posts_img_id_foreign` (`img_id`),
  ADD KEY `posts_cat_id_foreign` (`cat_id`);

--
-- Indexes for table `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_user_id_foreign` (`user_id`),
  ADD KEY `products_cat_id_foreign` (`cat_id`),
  ADD KEY `products_img_id_foreign` (`img_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_reviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_permissions_role_id_foreign` (`role_id`),
  ADD KEY `role_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`identifier`,`instance`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sliders_img_id_foreign` (`img_id`),
  ADD KEY `sliders_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_roles_user_id_foreign` (`user_id`),
  ADD KEY `user_roles_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=507;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menu_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `post_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_img_id_foreign` FOREIGN KEY (`img_id`) REFERENCES `media` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_categories`
--
ALTER TABLE `post_categories`
  ADD CONSTRAINT `post_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_img_id_foreign` FOREIGN KEY (`img_id`) REFERENCES `media` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `products_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sliders`
--
ALTER TABLE `sliders`
  ADD CONSTRAINT `sliders_img_id_foreign` FOREIGN KEY (`img_id`) REFERENCES `media` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sliders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
