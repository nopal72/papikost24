-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 09:48 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kuliah`
--
CREATE DATABASE IF NOT EXISTS `db_kuliah` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_kuliah`;

-- --------------------------------------------------------

--
-- Table structure for table `tb_dosen`
--

CREATE TABLE `tb_dosen` (
  `nip` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_krs`
--

CREATE TABLE `tb_krs` (
  `nim` varchar(10) DEFAULT NULL,
  `kode_matkul` varchar(10) DEFAULT NULL,
  `nilai` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_mahasiswa`
--

CREATE TABLE `tb_mahasiswa` (
  `nim` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_matkul`
--

CREATE TABLE `tb_matkul` (
  `kode_matkul` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `kode_ruang` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_ruang`
--

CREATE TABLE `tb_ruang` (
  `kode_ruang` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kapasitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_dosen`
--
ALTER TABLE `tb_dosen`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `tb_krs`
--
ALTER TABLE `tb_krs`
  ADD KEY `nim` (`nim`),
  ADD KEY `kode_matkul` (`kode_matkul`);

--
-- Indexes for table `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `tb_matkul`
--
ALTER TABLE `tb_matkul`
  ADD PRIMARY KEY (`kode_matkul`),
  ADD KEY `fk_tb_matkul_tb_dosen` (`nip`),
  ADD KEY `fk_tb_matkul_tb_ruang` (`kode_ruang`);

--
-- Indexes for table `tb_ruang`
--
ALTER TABLE `tb_ruang`
  ADD PRIMARY KEY (`kode_ruang`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_krs`
--
ALTER TABLE `tb_krs`
  ADD CONSTRAINT `tb_krs_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `tb_mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_krs_ibfk_2` FOREIGN KEY (`kode_matkul`) REFERENCES `tb_matkul` (`kode_matkul`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_matkul`
--
ALTER TABLE `tb_matkul`
  ADD CONSTRAINT `fk_tb_matkul_tb_dosen` FOREIGN KEY (`nip`) REFERENCES `tb_dosen` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_matkul_tb_ruang` FOREIGN KEY (`kode_ruang`) REFERENCES `tb_ruang` (`kode_ruang`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Database: `db_rpl`
--
CREATE DATABASE IF NOT EXISTS `db_rpl` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_rpl`;

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` varchar(255) NOT NULL,
  `body` text NOT NULL,
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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` varchar(255) NOT NULL,
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_04_29_104504_create_posts_table', 1),
(5, '2024_04_29_110150_create_likes_table', 1),
(6, '2024_04_29_110316_create_stores_table', 1),
(7, '2024_04_29_110830_create_ratings_table', 1),
(8, '2024_04_29_111607_create_reports_table', 1),
(9, '2024_04_29_112026_create_comments_table', 1),
(10, '2024_04_29_112113_create_bookmarks_table', 1);

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
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `body` text NOT NULL,
  `like` int(11) DEFAULT NULL,
  `store_id` char(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `is_store` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `body`, `like`, `store_id`, `image`, `is_store`, `created_at`, `updated_at`) VALUES
('p120240525150139', 1, 'aku bukan toko', NULL, NULL, NULL, 0, '2024-05-25 08:01:39', '2024-05-25 08:01:39'),
('p220240525150032', 2, 'tests', NULL, NULL, NULL, 0, '2024-05-25 08:00:32', '2024-05-25 08:00:32');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `rate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `body` varchar(255) NOT NULL,
  `is_post` tinyint(1) NOT NULL,
  `is_store` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('KhOHuC8j2bFXDB0dpgbTnzFRoKMKYPrH6pDDVNte', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZkVHUVQ2V210c21HTjJ4TFkxMXphaVU1eTh4bnhFR0ZoQ3NFb0tVdSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1716624171);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `is_open` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `user_id`, `name`, `image`, `description`, `address`, `is_open`, `created_at`, `updated_at`) VALUES
(1, 2, 'toko didi', NULL, 'ini adalah toko dari didi', 'patemon', NULL, '2024-05-25 08:01:03', '2024-05-25 08:01:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_store` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `is_store`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'nopal', 'nopallll', 'nopal@gmail.com', NULL, 0, '$2y$12$Bo4mwSddFDP4jH2IZN/M6Oi2dtk6BzyuBnsmvsEhOdebOrKmso2zW', NULL, '2024-05-25 07:59:57', '2024-05-25 07:59:57'),
(2, 'didi', 'didilll', 'didi@gmail.com', NULL, 1, '$2y$12$S211CcM7O98K/h6OVFMTSuI9OWUOdTUOxXfjSSWQAjXcELV1YT7li', NULL, '2024-05-25 07:59:57', '2024-05-25 08:01:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookmarks_post_id_foreign` (`post_id`),
  ADD KEY `bookmarks_user_id_foreign` (`user_id`);

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
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_post_id_foreign` (`post_id`);

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
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_user_id_foreign` (`user_id`),
  ADD KEY `likes_post_id_foreign` (`post_id`);

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
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_user_id_foreign` (`user_id`),
  ADD KEY `ratings_store_id_foreign` (`store_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_store_id_foreign` (`store_id`),
  ADD KEY `reports_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stores_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookmarks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stores`
--
ALTER TABLE `stores`
  ADD CONSTRAINT `stores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
--
-- Database: `db_smarcos`
--
CREATE DATABASE IF NOT EXISTS `db_smarcos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_smarcos`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin_tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `username`, `nama_lengkap`, `no_hp`, `email`, `password`, `admin_tanggal`) VALUES
(3, 'admin', 'administrator', '083126526292', 'admin@admin.com', 'adae5bc7af4b85e27af6682e8e1ad415572d3a211697a88c8ab7562655edfc84330f3884c9419d437a4e4ac76805e036da46', '2024-03-18 15:18:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ikan`
--

CREATE TABLE `tbl_ikan` (
  `id_ikan` int(11) NOT NULL,
  `jenis_ikan` varchar(50) NOT NULL,
  `jumlah_ikan` int(11) NOT NULL,
  `harga_ikan` int(11) NOT NULL,
  `foto_ikan` varchar(40) DEFAULT NULL,
  `tanggal_ikan` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ikan`
--

INSERT INTO `tbl_ikan` (`id_ikan`, `jenis_ikan`, `jumlah_ikan`, `harga_ikan`, `foto_ikan`, `tanggal_ikan`) VALUES
(4, 'bawal', 1000, 1000, NULL, '2024-05-24 16:51:29'),
(6, 'lele', 1000, 500, NULL, '2024-05-25 00:36:34'),
(7, 'nila', 1000, 500, NULL, '2024-05-25 00:36:44'),
(8, 'karper', 1000, 1000, NULL, '2024-05-25 00:37:00'),
(9, 'koi', 1000, 500, NULL, '2024-05-25 00:37:37'),
(10, 'gurame', 1000, 2000, NULL, '2024-05-25 00:38:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kolam`
--

CREATE TABLE `tbl_kolam` (
  `id_kolam` int(11) NOT NULL,
  `ph_kolam` float NOT NULL,
  `suhu_kolam` float NOT NULL,
  `kolam_tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pesanan`
--

CREATE TABLE `tbl_pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jenis_ikan` varchar(50) NOT NULL,
  `jumlah_ikan` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `pesanan_tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tulisan`
--

CREATE TABLE `tbl_tulisan` (
  `id` int(11) NOT NULL,
  `ucapan` varchar(500) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `whatsapp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_tulisan`
--

INSERT INTO `tbl_tulisan` (`id`, `ucapan`, `alamat`, `telepon`, `email`, `whatsapp`) VALUES
(2, 'Selamat datang di Balai Benih Ikan Mijen! Temukan ragam jenis benih ikan unggul di aplikasi kami dan mulailah perjalanan Anda dalam mendukung keberhasilan akuakultur yang berkelanjutan. Selamat mengeksplorasi!', 'Tambangan, Kec. Mijen, Kota Semarang, Jawa Tengah 50215', '(024) 3547998', 'perikanan@semarangko', '0858-6117-589015');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `no_hp` varchar(14) NOT NULL,
  `email` varchar(30) NOT NULL,
  `jenkel` enum('L','P') NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_lengkap`, `username`, `no_hp`, `email`, `jenkel`, `alamat`, `password`, `user_tanggal`) VALUES
(23, 'Tri Agus Wahyudi', 'wahyureal', '081325252154', 'wahyuaguz12@gmail.com', 'L', 'jl. tugu sumberan', 'a1796a5eec784f884ebf73742e923c6d2ffba99dc996fd7fb6f34606dbcc6ed1cf0c9715342f11bafabf3d0441ff4526ca098528abf6767385f88adfeda842f6', '2024-05-05 09:42:48'),
(34, 'nopal', 'nopall', '0856375893675', 'budi@saweria.com', 'L', 'user', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', '2024-05-06 01:06:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tbl_ikan`
--
ALTER TABLE `tbl_ikan`
  ADD PRIMARY KEY (`id_ikan`),
  ADD UNIQUE KEY `jenisikan` (`jenis_ikan`);

--
-- Indexes for table `tbl_kolam`
--
ALTER TABLE `tbl_kolam`
  ADD PRIMARY KEY (`id_kolam`);

--
-- Indexes for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `tbl_tulisan`
--
ALTER TABLE `tbl_tulisan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `no_hp` (`no_hp`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_ikan`
--
ALTER TABLE `tbl_ikan`
  MODIFY `id_ikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_kolam`
--
ALTER TABLE `tbl_kolam`
  MODIFY `id_kolam` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_tulisan`
--
ALTER TABLE `tbl_tulisan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- Database: `fullstack_db`
--
CREATE DATABASE IF NOT EXISTS `fullstack_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fullstack_db`;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `nim` int(11) DEFAULT NULL,
  `kelas` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `name`, `nim`, `kelas`, `createdAt`, `updatedAt`) VALUES
(1, 'abdul', 1101, 'A01', '2024-03-16 07:01:18', '2024-03-16 07:01:18'),
(2, 'qeqe', 1101, 'A01', '2024-03-16 07:01:34', '2024-03-16 07:01:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Database: `kuliah`
--
CREATE DATABASE IF NOT EXISTS `kuliah` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `kuliah`;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jurusan` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Database: `papikost234`
--
CREATE DATABASE IF NOT EXISTS `papikost234` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `papikost234`;

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` varchar(20) NOT NULL,
  `nama_kamar` varchar(10) NOT NULL,
  `harga` int(11) NOT NULL,
  `penghuni` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `nama_kamar`, `harga`, `penghuni`) VALUES
('KM01', 'kamar 1', 5000000, 2),
('KM02', 'kamar 2', 6000000, 1),
('KM03', 'kamar 3', 6000000, 0),
('KM04', 'kamar 4', 6000000, 0),
('KM05', 'kamar 5', 6000000, 0),
('KM06', 'kamar 6', 6000000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE `tagihan` (
  `kode_tagihan` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis_tagihan` varchar(100) NOT NULL,
  `tagihan` int(11) NOT NULL,
  `total_tagihan` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tagihan`
--

INSERT INTO `tagihan` (`kode_tagihan`, `tanggal`, `jenis_tagihan`, `tagihan`, `total_tagihan`, `id_admin`) VALUES
('ls2023120111', '2023-12-01', 'listrik', 20000, 60000, 11);

-- --------------------------------------------------------

--
-- Table structure for table `tagihan_kamar`
--

CREATE TABLE `tagihan_kamar` (
  `kode_tagihan` varchar(20) NOT NULL,
  `kode_kamar` varchar(20) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `tagihan` int(11) NOT NULL,
  `tenggat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tagihan_kamar`
--

INSERT INTO `tagihan_kamar` (`kode_tagihan`, `kode_kamar`, `id_admin`, `tagihan`, `tenggat`) VALUES
('ks20231130KM0111', 'KM01', 11, 3000000, '2023-11-30'),
('ks20231130KM0211', 'KM02', 11, 6000000, '2023-11-30');

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama`, `email`, `password`) VALUES
(8, 'asd', 'asd', '$2y$10$3RJ5H.kMYrdr6kspALGF3uBMnPlxzZ.rphIvqmDV814A/kSRw9FFu'),
(10, 'vbn', 'vbn', '$2y$10$zLaJs.vm6RNM4HzErnefS..mvsJ7lOIdPal4NbnBliCv.Jyjxs3Zu'),
(11, 'admin', 'admin', '$2y$10$T9ki3ES.7yuETZPkwrD7ZOwE5quB/KiO8S3F4lZUc.1ROKfwk.V5K'),
(12, 'sdf', 'sdf', '$2y$10$tuZPzpKdW7p30jwsm/Exn.Ckd/9bMmzj0xt32sC8E1iLdd30ZyTWu');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `kode_transaksi` varchar(30) NOT NULL,
  `kode_tagihan` varchar(20) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`kode_transaksi`, `kode_tagihan`, `id_user`, `tanggal`, `jenis`) VALUES
('15ks20231130KM0211kos20231129', 'ks20231130KM0211', 15, '2023-11-29', 'kos'),
('8ks20231130KM0111kos20231129', 'ks20231130KM0111', 8, '2023-11-29', 'kos'),
('8ls2023120111listrik20231129', 'ls2023120111', 8, '2023-11-29', 'listrik');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_kamar` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `alamat`, `tanggal_lahir`, `email`, `password`, `id_kamar`) VALUES
(8, 'qwe', 'qwe', '2023-11-24', 'qwe', '$2y$10$aqhm87s15RwWxcLsGy5AwufbgbkCOIMqTNjoTEL1Ntvc.fpSctN8G', 'KM01'),
(10, 'user', 'user', '2023-11-30', 'user', '$2y$10$0YFPyIOQNsK4sM2ZiHf1beUWSsFdi5CuuIXlKR5UNU5eY/NCcqW6q', 'KM01'),
(15, '123', '123', '2023-11-11', '123', '$2y$10$/ZV8frVlMH8KgQxEYjKAn.vLGI/cS30Q7CMYYWvYdpxibqjaNiWq6', 'KM02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`kode_tagihan`),
  ADD KEY `tagihan_ibfk_1` (`id_admin`);

--
-- Indexes for table `tagihan_kamar`
--
ALTER TABLE `tagihan_kamar`
  ADD PRIMARY KEY (`kode_tagihan`),
  ADD KEY `tagihan_kamar_ibfk_1` (`kode_kamar`),
  ADD KEY `tagihan_kamar_ibfk_2` (`id_admin`);

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`kode_transaksi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `transaksi_ibfk_2` (`kode_tagihan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_kamar` (`id_kamar`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD CONSTRAINT `tagihan_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `tb_admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tagihan_kamar`
--
ALTER TABLE `tagihan_kamar`
  ADD CONSTRAINT `tagihan_kamar_ibfk_1` FOREIGN KEY (`kode_kamar`) REFERENCES `kamar` (`id_kamar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tagihan_kamar_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `tb_admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`);
--
-- Database: `perbankan`
--
CREATE DATABASE IF NOT EXISTS `perbankan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `perbankan`;

-- --------------------------------------------------------

--
-- Table structure for table `cabang_bank`
--

CREATE TABLE `cabang_bank` (
  `kode_cabang` varchar(20) NOT NULL,
  `nama_cabang` varchar(45) NOT NULL,
  `alamat_cabang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cabang_bank`
--

INSERT INTO `cabang_bank` (`kode_cabang`, `nama_cabang`, `alamat_cabang`) VALUES
('BRUB', 'Bank Rut Unit Boyolali', 'Jl. Ahmad Yani 45'),
('BRUK', 'Bank Rut Unit Klaten', 'Jl. Suparman 23'),
('BRUS', 'Bank Rut Unit Surakarta', 'Jl. Slamet Riyadi 18'),
('BRUW', 'Bank Rut Unit Wonogiri', ' Jl. A. Yani No. 23'),
('BRUY', 'Bank Rut Unit Yogyakarta', 'Jl. Anggrek 21');

-- --------------------------------------------------------

--
-- Table structure for table `nasabah`
--

CREATE TABLE `nasabah` (
  `id_nasabah` int(11) NOT NULL,
  `nama_nasabah` varchar(45) NOT NULL,
  `alamat_nasabah` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nasabah`
--

INSERT INTO `nasabah` (`id_nasabah`, `nama_nasabah`, `alamat_nasabah`) VALUES
(1, 'Sutopo', 'Jl. Jendral Sudirman 12'),
(2, 'Maryati', 'Jl. Mt Haryono 31'),
(3, 'Suparman', 'Jl. Hasanudin 81'),
(4, 'Kartika Padmasari', 'Jl. Manggis 15'),
(5, 'Budi Eko Prayogo', 'Jl. Kantil 30'),
(6, 'Satria Eka Jaya', 'Jl. Slamet Riyadi 45'),
(8, 'Sari Murti', 'Jl. Pangandaran 11'),
(9, 'Cankan Lokananta', 'Jl. Tidar 86'),
(10, 'Budi Martono', 'Jl. Merak 22');

-- --------------------------------------------------------

--
-- Table structure for table `nasabah_has_rekening`
--

CREATE TABLE `nasabah_has_rekening` (
  `id_nasabah` int(11) NOT NULL,
  `no_rekening` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nasabah_has_rekening`
--

INSERT INTO `nasabah_has_rekening` (`id_nasabah`, `no_rekening`) VALUES
(1, 104),
(2, 103),
(3, 105),
(3, 106),
(4, 101),
(4, 107),
(5, 102),
(5, 107),
(6, 109),
(7, 109),
(8, 111),
(8, 112),
(9, 110),
(10, 108),
(10, 113);

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `no_rekening` int(11) NOT NULL,
  `kode_cabang` varchar(20) DEFAULT NULL,
  `pin` varchar(20) NOT NULL DEFAULT '1234',
  `saldo` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`no_rekening`, `kode_cabang`, `pin`, `saldo`) VALUES
(101, 'BRUS', '1111', 500000),
(102, 'BRUS', '2222', 350000),
(103, 'BRUS', '3333', 750000),
(104, 'BRUM', '4444', 900000),
(105, 'BRUM', '5555', 2000000),
(106, 'BRUS', '6666', 3000000),
(107, 'BRUS', '7777', 1000000),
(108, 'BRUB', '0000', 5000000),
(109, 'BRUB', '9999', 0),
(110, 'BRUY', '1234', 550000),
(111, 'BRUK', '4321', 150000),
(112, 'BRUK', '0123', 300000),
(113, 'BRUY', '8888', 255000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `no_transaksi` bigint(20) UNSIGNED NOT NULL,
  `id_nasabah` int(11) DEFAULT NULL,
  `no_rekening` int(11) DEFAULT NULL,
  `jenis_transaksi` varchar(20) NOT NULL DEFAULT 'debit',
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `jumlah` int(11) NOT NULL CHECK (`jumlah` >= 20000)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`no_transaksi`, `id_nasabah`, `no_rekening`, `jenis_transaksi`, `tanggal`, `jumlah`) VALUES
(1, 3, 105, 'debit', '2009-11-10 00:00:00', 50000),
(2, 2, 103, 'debit', '2009-11-10 00:00:00', 40000),
(3, 4, 101, 'kredit', '2009-11-12 00:00:00', 20000),
(4, 3, 106, 'debit', '2009-11-13 00:00:00', 50000),
(5, 5, 107, 'kredit', '2009-11-13 00:00:00', 30000),
(6, 1, 104, 'kredit', '2009-11-15 00:00:00', 200000),
(7, 9, 110, 'kredit', '2009-11-15 00:00:00', 150000),
(8, 5, 102, 'debit', '2009-11-16 00:00:00', 20000),
(9, 3, 105, 'kredit', '2009-11-18 00:00:00', 50000),
(10, 4, 107, 'debit', '2009-11-19 00:00:00', 100000),
(11, 2, 103, 'debit', '2009-11-19 00:00:00', 100000),
(12, 1, 104, 'debit', '2009-11-19 00:00:00', 50000),
(13, 4, 107, 'kredit', '2009-11-20 00:00:00', 200000),
(14, 3, 105, 'debit', '2009-11-21 00:00:00', 40000),
(15, 1, 104, 'kredit', '2009-11-22 00:00:00', 100000),
(16, 4, 101, 'kredit', '2009-11-22 00:00:00', 20000),
(17, 2, 103, 'debit', '2009-11-22 00:00:00', 50000),
(18, 5, 102, 'debit', '2009-11-25 00:00:00', 50000),
(19, 10, 108, 'debit', '2009-11-26 00:00:00', 100000),
(20, 3, 106, 'kredit', '2009-11-27 00:00:00', 50000),
(21, 2, 103, 'kredit', '2009-11-28 00:00:00', 200000),
(22, 3, 105, 'kredit', '2009-11-28 00:00:00', 100000),
(23, 5, 102, 'debit', '2009-11-30 00:00:00', 20000),
(24, 1, 104, 'debit', '2009-12-01 00:00:00', 50000),
(25, 2, 103, 'debit', '2009-12-02 00:00:00', 40000),
(26, 4, 101, 'debit', '2009-12-04 00:00:00', 50000),
(27, 2, 103, 'kredit', '2009-12-05 00:00:00', 100000),
(28, 5, 102, 'kredit', '2009-12-05 00:00:00', 200000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cabang_bank`
--
ALTER TABLE `cabang_bank`
  ADD PRIMARY KEY (`kode_cabang`),
  ADD UNIQUE KEY `nama_cabang` (`nama_cabang`);

--
-- Indexes for table `nasabah`
--
ALTER TABLE `nasabah`
  ADD PRIMARY KEY (`id_nasabah`);

--
-- Indexes for table `nasabah_has_rekening`
--
ALTER TABLE `nasabah_has_rekening`
  ADD PRIMARY KEY (`id_nasabah`,`no_rekening`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`no_rekening`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`no_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `no_transaksi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--
-- Error reading structure for table phpmyadmin.pma__bookmark: #1932 - Table &#039;phpmyadmin.pma__bookmark&#039; doesn&#039;t exist in engine
-- Error reading data for table phpmyadmin.pma__bookmark: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__bookmark`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--
-- Error reading structure for table phpmyadmin.pma__central_columns: #1932 - Table &#039;phpmyadmin.pma__central_columns&#039; doesn&#039;t exist in engine
-- Error reading data for table phpmyadmin.pma__central_columns: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__central_columns`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--
-- Error reading structure for table phpmyadmin.pma__column_info: #1932 - Table &#039;phpmyadmin.pma__column_info&#039; doesn&#039;t exist in engine
-- Error reading data for table phpmyadmin.pma__column_info: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__column_info`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--
-- Error reading structure for table phpmyadmin.pma__designer_settings: #1932 - Table &#039;phpmyadmin.pma__designer_settings&#039; doesn&#039;t exist in engine
-- Error reading data for table phpmyadmin.pma__designer_settings: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__designer_settings`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--
-- Error reading structure for table phpmyadmin.pma__export_templates: #1932 - Table &#039;phpmyadmin.pma__export_templates&#039; doesn&#039;t exist in engine
-- Error reading data for table phpmyadmin.pma__export_templates: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__export_templates`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--
-- Error reading structure for table phpmyadmin.pma__favorite: #1932 - Table &#039;phpmyadmin.pma__favorite&#039; doesn&#039;t exist in engine
-- Error reading data for table phpmyadmin.pma__favorite: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__favorite`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--
-- Error reading structure for table phpmyadmin.pma__history: #1932 - Table &#039;phpmyadmin.pma__history&#039; doesn&#039;t exist in engine
-- Error reading data for table phpmyadmin.pma__history: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__history`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--
-- Error reading structure for table phpmyadmin.pma__navigationhiding: #1932 - Table &#039;phpmyadmin.pma__navigationhiding&#039; doesn&#039;t exist in engine
-- Error reading data for table phpmyadmin.pma__navigationhiding: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__navigationhiding`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--
-- Error reading structure for table phpmyadmin.pma__pdf_pages: #1932 - Table &#039;phpmyadmin.pma__pdf_pages&#039; doesn&#039;t exist in engine
-- Error reading data for table phpmyadmin.pma__pdf_pages: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__pdf_pages`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--
-- Error reading structure for table phpmyadmin.pma__recent: #1932 - Table &#039;phpmyadmin.pma__recent&#039; doesn&#039;t exist in engine
-- Error reading data for table phpmyadmin.pma__recent: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__recent`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--
-- Error reading structure for table phpmyadmin.pma__relation: #1932 - Table &#039;phpmyadmin.pma__relation&#039; doesn&#039;t exist in engine
-- Error reading data for table phpmyadmin.pma__relation: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__relation`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--
-- Error reading structure for table phpmyadmin.pma__savedsearches: #1932 - Table &#039;phpmyadmin.pma__savedsearches&#039; doesn&#039;t exist in engine
-- Error reading data for table phpmyadmin.pma__savedsearches: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__savedsearches`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--
-- Error reading structure for table phpmyadmin.pma__table_coords: #1932 - Table &#039;phpmyadmin.pma__table_coords&#039; doesn&#039;t exist in engine
-- Error reading data for table phpmyadmin.pma__table_coords: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__table_coords`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--
-- Error reading structure for table phpmyadmin.pma__table_info: #1932 - Table &#039;phpmyadmin.pma__table_info&#039; doesn&#039;t exist in engine
-- Error reading data for table phpmyadmin.pma__table_info: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__table_info`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--
-- Error reading structure for table phpmyadmin.pma__table_uiprefs: #1932 - Table &#039;phpmyadmin.pma__table_uiprefs&#039; doesn&#039;t exist in engine
-- Error reading data for table phpmyadmin.pma__table_uiprefs: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__table_uiprefs`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--
-- Error reading structure for table phpmyadmin.pma__tracking: #1932 - Table &#039;phpmyadmin.pma__tracking&#039; doesn&#039;t exist in engine
-- Error reading data for table phpmyadmin.pma__tracking: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__tracking`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--
-- Error reading structure for table phpmyadmin.pma__userconfig: #1932 - Table &#039;phpmyadmin.pma__userconfig&#039; doesn&#039;t exist in engine
-- Error reading data for table phpmyadmin.pma__userconfig: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__userconfig`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--
-- Error reading structure for table phpmyadmin.pma__usergroups: #1932 - Table &#039;phpmyadmin.pma__usergroups&#039; doesn&#039;t exist in engine
-- Error reading data for table phpmyadmin.pma__usergroups: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__usergroups`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--
-- Error reading structure for table phpmyadmin.pma__users: #1932 - Table &#039;phpmyadmin.pma__users&#039; doesn&#039;t exist in engine
-- Error reading data for table phpmyadmin.pma__users: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `phpmyadmin`.`pma__users`&#039; at line 1
--
-- Database: `pinjeminbook_db`
--
CREATE DATABASE IF NOT EXISTS `pinjeminbook_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pinjeminbook_db`;

-- --------------------------------------------------------

--
-- Table structure for table `borrowedbook_tbs`
--

CREATE TABLE `borrowedbook_tbs` (
  `id` varchar(255) NOT NULL,
  `userId` int(11) NOT NULL,
  `bookId` int(11) NOT NULL,
  `borrowDate` datetime NOT NULL,
  `returnDate` datetime DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_books`
--

CREATE TABLE `tb_books` (
  `id_book` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `isBorrow` tinyint(1) DEFAULT 0,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_books`
--

INSERT INTO `tb_books` (`id_book`, `title`, `author`, `year`, `isBorrow`, `createdAt`, `updatedAt`) VALUES
(3, 'Pemrograman Dasar dengan Python', 'John Doe', 2020, 0, '2023-12-24 05:05:45', '2023-12-24 05:05:45');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `refresh_token` text DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id_user`, `name`, `email`, `role`, `refresh_token`, `password`, `createdAt`, `updatedAt`) VALUES
(4, 'agus', 'budi@gmail.com', 'user', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6NCwibmFtZSI6ImFndXMiLCJlbWFpbCI6ImJ1ZGlAZ21haWwuY29tIiwiaWF0IjoxNzAzODY4MDgzLCJleHAiOjE3MDM5NTQ0ODN9.vW3c_kg4X04NNZOvw_IJzJhprColJ0J0eEPPhMhocNQ', '$2b$10$vIRSdTA0JA5p5mJcqxDLqODp4dZerQZvM67OYi3pklnRtP1.v50Em', '2023-12-25 15:21:23', '2023-12-29 16:41:23'),
(5, 'didi', 'didi@gmail.com', 'user', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6NSwibmFtZSI6ImRpZGkiLCJlbWFpbCI6ImRpZGlAZ21haWwuY29tIiwiaWF0IjoxNzAzODU5NzUzLCJleHAiOjE3MDM5NDYxNTN9.AEbnom9nyxXufzgPwj89zo9AiA2RsEkghu7NpI_U0J4', '$2b$10$Il9nmwmragoF9eZzJLVDWeBn4jylMm.y6Vcg3hjeYtPKdkbs7PDra', '2023-12-25 18:58:22', '2023-12-29 14:22:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrowedbook_tbs`
--
ALTER TABLE `borrowedbook_tbs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `bookId` (`bookId`);

--
-- Indexes for table `tb_books`
--
ALTER TABLE `tb_books`
  ADD PRIMARY KEY (`id_book`),
  ADD UNIQUE KEY `id_book` (`id_book`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `id_user` (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_books`
--
ALTER TABLE `tb_books`
  MODIFY `id_book` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowedbook_tbs`
--
ALTER TABLE `borrowedbook_tbs`
  ADD CONSTRAINT `borrowedbook_tbs_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `tb_users` (`id_user`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `borrowedbook_tbs_ibfk_2` FOREIGN KEY (`bookId`) REFERENCES `tb_books` (`id_book`) ON DELETE NO ACTION ON UPDATE CASCADE;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
