-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2024 at 07:09 AM
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
-- Database: `tugas_intern_001_type02`
--

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
-- Table structure for table `master_customers`
--

CREATE TABLE `master_customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_customer` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telepon` varchar(255) NOT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_customers`
--

INSERT INTO `master_customers` (`id`, `user_id`, `nama_customer`, `email`, `telepon`, `alamat`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Budiono Siregar', 'kapallawd@gmail.com', '08123456789', 'Bougenville Boulevard', NULL, NULL),
(2, NULL, 'Farhan Kebab', 'farhankebab@xyz.com', '08123456789', 'Jl. Haji Bingung', NULL, NULL),
(3, NULL, 'Zaki Indomie', 'zaki@xyz.com', '08123456789', 'Jl. Haji Sakit', NULL, NULL),
(4, NULL, 'Anggrek Mekar Pontianak', 'anggrekmekar@xyz.com', '08123456789', 'Jl. Haji 2 Bulan', NULL, NULL),
(5, NULL, 'Pablo Emilio Escobar Gaviria', 'pablitonarco@xyz.com', '08123456789', 'Medellin, Colombia', NULL, NULL),
(6, NULL, 'kuk', 'kikuk@xyz.com', '08123456789', 'Solo', NULL, NULL),
(7, NULL, 'Agus Kopling', 'agus@xyz.com', '08123456789', 'Ciamis', NULL, NULL),
(8, NULL, 'Pablo Escobar', 'pablo@example.com', '08123456789', 'Medellin', NULL, NULL),
(9, 2, 'Customer', 'customer@xyz.com', '08123456789', 'test', NULL, NULL),
(10, 2, 'Customer', 'customer@xyz.com', '08123456789', 'test', NULL, NULL),
(11, 2, 'Customer', 'customer@xyz.com', '08123456789', 'test', NULL, NULL),
(12, 2, 'Customer', 'customer@xyz.com', '08123456789', 'test', NULL, NULL),
(13, 2, 'Customer', 'customer@xyz.com', '081216409029', 'Jelidro', NULL, NULL),
(14, 2, 'Customer', 'customer@xyz.com', '08123456789', 'test', NULL, NULL),
(15, 2, 'Customer', 'customer@xyz.com', '08123456789', 'test', NULL, NULL),
(16, 2, 'Customer', 'customer@xyz.com', '08123456789', 'test', NULL, NULL),
(17, 2, 'Customer', 'customer@xyz.com', '081216409029', 'Jelidro', NULL, NULL),
(18, 2, 'Customer', 'customer@xyz.com', '081216409029', 'Jelidro', NULL, NULL),
(19, 2, 'Customer', 'customer@xyz.com', '081216409029', 'Jelidro', NULL, NULL),
(20, 2, 'Customer', 'customer@xyz.com', '081216409029', 'Jelidro', NULL, NULL),
(21, 2, 'Customer', 'customer@xyz.com', '081216409029', 'Jelidro', NULL, NULL),
(22, 2, 'Customer', 'customer@xyz.com', '081216409029', 'Jelidro', NULL, NULL),
(23, 2, 'Customer', 'customer@xyz.com', '08123456789', 'Jl. Bougenville', NULL, NULL),
(24, 2, 'Customer', 'customer@xyz.com', '08123456789', 'q', NULL, NULL),
(25, 2, 'Customer', 'customer@xyz.com', '081216409029', 'Jelidro', NULL, NULL),
(26, 2, 'Customer', 'customer@xyz.com', '081216409029', 'Jelidro', NULL, NULL),
(27, 2, 'Customer', 'customer@xyz.com', '081216409029', 'Jelidro', NULL, NULL),
(28, 2, 'Customer', 'customer@xyz.com', '081216409029', 'Jelidro', NULL, NULL),
(29, 2, 'Customer', 'customer@xyz.com', '081216409029', 'Jelidro', NULL, NULL),
(30, 2, 'Customer', 'customer@xyz.com', '081216409029', 'Jelidro', NULL, NULL),
(31, 2, 'Customer', 'customer@xyz.com', '081216409029', 'Jelidro', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_layanans`
--

CREATE TABLE `master_layanans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_layanan` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1:active; 2:inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_layanans`
--

INSERT INTO `master_layanans` (`id`, `nama_layanan`, `deskripsi`, `harga`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Service HP\r\n', 'test', NULL, 1, NULL, NULL),
(4, 'Service AC', 'pe', NULL, 0, NULL, NULL),
(6, 'Rakit PC', 'pe', NULL, 1, NULL, NULL),
(7, 'Perbaikan Sound System', 'hfdshohod', NULL, 1, NULL, NULL);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_08_14_003336_add_user_type_to_users_table', 1),
(6, '2024_08_28_125309_add_is_delete_to_users_table', 1),
(7, '2024_09_09_045555_create_services_table', 1),
(8, '2024_09_09_052400_create_layanans_table', 1),
(9, '2024_09_09_052713_create_customers_table', 1),
(10, '2024_09_09_052817_create_serviceins_table', 1),
(11, '2024_09_09_053254_create_serviceouts_table', 1),
(12, '2024_09_09_081601_add_created_by_to_master_layanans_table', 2),
(13, '2024_09_14_055622_add_estimasi_to_service_ins_table', 3),
(14, '2024_09_14_091113_add_pihak_ketiga_to_service_ins_table', 4),
(15, '2024_09_14_091348_add_pihak_ketiga_to_service_ins_table', 5),
(16, '2024_09_14_095213_add_harga_to_service_ins_table', 6),
(17, '2024_09_14_095436_add_harga_to_service_ins_table', 7),
(18, '2024_09_17_043401_add_catatan_to_service_ins_table', 8),
(19, '2024_09_17_050016_create_serviceouts_table', 9),
(20, '2024_09_17_052400_add_vendor_to_service_outs_table', 10),
(21, '2024_09_24_040555_add_user_id_to_master_customers_table', 11),
(22, '2024_09_30_023439_add_user_id_to_service_outs_table', 12),
(23, '2024_09_30_023930_add_customer_id_to_service_outs_table', 13),
(24, '2024_09_30_024157_add_layanan_id_to_service_outs_table', 14),
(25, '2024_10_09_012519_add_order_id_to_service_ins_table', 15),
(26, '2024_10_20_191953_add_total_harga_to_service_ins_table', 16),
(27, '2024_10_20_194908_add_status_payment_to_service_ins_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
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
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `cust_name` varchar(200) NOT NULL,
  `cust_address` varchar(500) NOT NULL,
  `cust_contact` varchar(500) NOT NULL,
  `item_name` varchar(900) NOT NULL,
  `item_brand` varchar(100) NOT NULL,
  `problem` varchar(900) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:waiting..., 1:rejected; 2:accepted; 3:finished;',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_ins`
--

CREATE TABLE `service_ins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `layanan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal_masuk` datetime DEFAULT NULL,
  `deskripsi_masalah` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0:waiting..., 1:rejected; 2:accepted; 3:in progress; 4:finished',
  `perbaikan_pihak_ketiga` int(11) NOT NULL DEFAULT 0 COMMENT '0:waiting, 1:yes, 2:no',
  `tanggal_estimasi` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `harga` decimal(20,2) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `total_harga` decimal(15,2) DEFAULT NULL,
  `status_payment` enum('Unpaid','Paid') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_ins`
--

INSERT INTO `service_ins` (`id`, `order_id`, `customer_id`, `layanan_id`, `tanggal_masuk`, `deskripsi_masalah`, `status`, `perbaikan_pihak_ketiga`, `tanggal_estimasi`, `created_at`, `updated_at`, `harga`, `catatan`, `total_harga`, `status_payment`) VALUES
(6, 'ORDER-4VWSFMJC', 5, 2, '2024-09-10 13:15:09', 'Saya memiliki masalah pada HP saya, diantaranya :\r\n\r\n1. LCD meledak\r\n2. HP hancur dilindes truk\r\n3. Habis tenggelem di WC\r\n4. Bau sangit\r\n5. gaada yg ngechat\r\n6. bukan iPhone\r\n7. Baterai bukan pake baterai HP malah pake baterai ABC \r\n8. Layar pecah jatuh dari lantai 11\r\n9. HP habis ditabrak tank Leopard', 4, 1, '2024-09-11 00:00:00', NULL, '2024-09-17 06:33:27', 9000000.00, 'Beli HP baru lohh', NULL, 'Unpaid'),
(9, 'ORDER-MTGTGNLR', 1, 4, '2024-09-17 06:09:26', 'AC saya tidak dingin', 4, 1, NULL, NULL, '2024-10-05 02:34:30', 250000.00, 'Membersihkan filter AC', NULL, 'Unpaid'),
(10, 'ORDER-Q1BKORXN', 3, 2, '2024-09-17 15:26:06', 'LCD rusak', 3, 1, '2024-09-20 00:00:00', NULL, '2024-09-17 06:59:38', 500000.00, 'Jasa pemasangan LCD baru', NULL, 'Unpaid'),
(11, 'ORDER-ODKAINBQ', 4, 2, '2024-09-17 16:16:56', 'Baterai kembung', 3, 1, '2024-09-18 00:00:00', NULL, '2024-09-17 07:18:17', 100000.00, 'Jasa pemasangan baterai baru', NULL, 'Unpaid'),
(12, 'ORDER-HCKSBX06', 6, 4, '2024-09-17 16:21:55', 'Blower AC terbakar', 3, 1, NULL, NULL, '2024-09-17 07:23:52', 100000.00, 'Biaya pemasangan kabel yang terbakar', NULL, 'Unpaid'),
(18, 'ORDER-SQEKK0JQ', 15, 2, '2024-09-27 03:30:58', 'HP meledak', 3, 1, '2024-09-30 00:00:00', NULL, '2024-10-06 21:38:36', 800000.00, 'Perbaikan dalam', NULL, 'Unpaid'),
(29, 'ORDER-KWL1OO74', 27, 6, '2024-10-09 01:34:00', 'q', 2, 1, '2024-10-18 00:00:00', NULL, '2024-10-20 12:34:38', 2000000.00, '1', 2000000.00, 'Unpaid'),
(30, 'ORDER-7I7VUAYG', 28, 2, '2024-10-20 19:36:34', 'q', 4, 1, '2024-10-23 00:00:00', NULL, '2024-10-20 12:46:44', 500000.00, 'q', 600000.00, 'Unpaid'),
(38, 'ORDER-SKVYFMYS', 30, 7, '2024-10-22 04:22:39', 'test 1', 4, 2, '2024-10-27 12:43:25', NULL, NULL, 120000.00, 'q', 120000.00, 'Unpaid'),
(39, 'ORDER-123', 31, 2, '2024-10-22 04:23:57', 'q', 4, 2, '2024-10-25 00:00:00', NULL, '2024-10-23 21:45:05', 200000.00, 'q', 200000.00, 'Unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `service_outs`
--

CREATE TABLE `service_outs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `layanan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `service_in_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_name` varchar(255) NOT NULL,
  `tanggal_keluar` datetime NOT NULL,
  `tanggal_diterima` datetime DEFAULT NULL,
  `biaya` decimal(10,2) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_outs`
--

INSERT INTO `service_outs` (`id`, `customer_id`, `layanan_id`, `service_in_id`, `vendor_name`, `tanggal_keluar`, `tanggal_diterima`, `biaya`, `catatan`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 6, 'Phone Kingzz', '2024-09-17 07:22:57', '2024-09-18 00:00:00', 8000000.00, 'Beli HP Baru', 2, NULL, '2024-09-17 05:34:31'),
(4, NULL, NULL, 10, 'CV. Sukses Isi 2', '2024-09-18 00:00:00', NULL, 2000000.00, 'Pembelian LCD baru', 1, '2024-09-18 03:28:24', '2024-09-18 04:13:51'),
(5, NULL, NULL, 18, 'PT. Nigga', '2024-09-28 00:00:00', '2024-09-29 00:00:00', 400000.00, 'Perbaikan luar', 1, '2024-09-26 20:38:52', '2024-09-26 20:38:52'),
(6, NULL, NULL, 12, 'PT. Sejahtera', '2024-10-05 00:00:00', '2024-10-05 00:00:00', 250000.00, 'Perbaikan kabel', 1, '2024-10-05 02:35:55', '2024-10-07 20:57:43'),
(8, NULL, NULL, 11, 'CV. Sukses Isi 2', '2024-10-10 00:00:00', '2024-10-10 00:00:00', 100000.00, '1', 1, '2024-10-08 23:31:20', '2024-10-20 12:23:28'),
(9, NULL, NULL, 30, 'CV. Sukses Isi 2', '2024-10-21 00:00:00', '2024-10-22 00:00:00', 100000.00, 'q', 1, '2024-10-20 12:38:27', '2024-10-20 12:38:27');

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
  `user_type` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1:admin, 2:teacher, 3:student, 4:parent',
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `user_type`, `is_delete`, `created_at`, `updated_at`) VALUES
(2, 'Customer', 'customer@xyz.com', NULL, '$2y$10$dlLUsh.UwP.TTq.Mvz8Z8efJ2X51UcDBHrue7tbWucAHB/8Colle6', 'Z86ACBQOFvUFKMNQ6be3xPq1sxWm3sne6UlH3dcW0WatQ1UOS3qTFUimNPKE', 2, 1, NULL, '2024-09-09 02:31:52'),
(3, 'Admin', 'admin@xyz.com', NULL, '$2y$10$dlLUsh.UwP.TTq.Mvz8Z8efJ2X51UcDBHrue7tbWucAHB/8Colle6', 'lYztSp8YQMgpRvHhXgfo5XKNqOZaQCsZplYqDOKaW3HlHpHVDyX5Huib5m2E', 1, 0, NULL, '2024-10-03 19:57:53'),
(8, 'Ariq', 'ariqburhanuddins2007@gmail.com', NULL, '$2y$10$oGG1X8hx26sdcqqrIidyIePQf675wJEZU2DiWhHra08wQqxo..Qeq', 'dnhA5kknQwaEVaRWAhlKZNlOixa2BlNO3dWNIpKMxoSXuTkSCkI5T6ZJQB30', 1, 1, '2024-09-23 00:59:15', '2024-10-05 02:44:41'),
(9, 'user', 'user@xyz.com', NULL, '$2y$10$M.iHHbLOhA5jKDDyWv6sm.hfrLeGBoHwvGHSLkC6OPyGCn56qu8zC', 'zZV6Lr7GEdUkDeiv2hfeIIaFLWQNoUm0RY5u8YxEcwuD28w1bOmfOFBBfrMl', 2, 0, '2024-09-23 01:34:43', '2024-09-23 01:34:43'),
(10, 'Customer404', 'customer404@xyz.com', NULL, '$2y$10$hr73mC3p1nRGG5chuXXrj.2yynCwgFGwsa6lvArAZ7TCgJ8lcOGae', 'ZwGHVQWxeL6WK3KpiWf8u9Q450UgoaIDCu4VHuq4V2nBnr3ohcqSBMcfNhbr', 2, 0, '2024-10-05 02:41:55', '2024-10-05 02:41:55'),
(11, 'admin02', 'admin02@xyz.com', NULL, '$2y$10$A47sT0M86odhKvTADOHjd.2Lrero3xoeQburcpZmJlQBAWKyi2yV.', 'WTBYGdq6JalzJlRUi7LElq68SWxux98G9ffPO1rcAzNZb1EVj79Rnt94mEvs', 1, 0, '2024-10-05 02:43:09', '2024-10-05 02:43:09'),
(12, 'Admin00', 'admin00@xyz.com', NULL, '$2y$10$bVGJGAOZFciVfYk7.LEkl.VbB3UZoX6CJ8j4Ov21w8f4m2nwMX6ta', 'X76nNU9fFGesvupntmhzwYWW5AkhYfc9ePyogJi4moxc0ESnKgrvD9aAEjox', 1, 0, '2024-10-08 23:24:59', '2024-10-08 23:46:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `master_customers`
--
ALTER TABLE `master_customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `master_customers_user_id_foreign` (`user_id`);

--
-- Indexes for table `master_layanans`
--
ALTER TABLE `master_layanans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `service_ins`
--
ALTER TABLE `service_ins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_ins_order_id_unique` (`order_id`),
  ADD KEY `service_ins_customer_id_foreign` (`customer_id`),
  ADD KEY `service_ins_layanan_id_foreign` (`layanan_id`);

--
-- Indexes for table `service_outs`
--
ALTER TABLE `service_outs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_outs_service_in_id_foreign` (`service_in_id`),
  ADD KEY `service_outs_customer_id_foreign` (`customer_id`),
  ADD KEY `service_outs_layanan_id_foreign` (`layanan_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_customers`
--
ALTER TABLE `master_customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `master_layanans`
--
ALTER TABLE `master_layanans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_ins`
--
ALTER TABLE `service_ins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `service_outs`
--
ALTER TABLE `service_outs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `master_customers`
--
ALTER TABLE `master_customers`
  ADD CONSTRAINT `master_customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_ins`
--
ALTER TABLE `service_ins`
  ADD CONSTRAINT `service_ins_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `master_customers` (`id`),
  ADD CONSTRAINT `service_ins_layanan_id_foreign` FOREIGN KEY (`layanan_id`) REFERENCES `master_layanans` (`id`);

--
-- Constraints for table `service_outs`
--
ALTER TABLE `service_outs`
  ADD CONSTRAINT `service_outs_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `master_customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_outs_layanan_id_foreign` FOREIGN KEY (`layanan_id`) REFERENCES `master_layanans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_outs_service_in_id_foreign` FOREIGN KEY (`service_in_id`) REFERENCES `service_ins` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
