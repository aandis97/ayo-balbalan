-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2020 at 11:00 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sepak_bola`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pertandingan`
--

CREATE TABLE `detail_pertandingan` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_pertandingan` int(10) UNSIGNED NOT NULL,
  `id_tim` int(11) NOT NULL,
  `id_pemain` int(10) UNSIGNED NOT NULL,
  `menit` int(5) NOT NULL,
  `jenis_gol` tinyint(2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_pertandingan`
--

INSERT INTO `detail_pertandingan` (`id`, `id_pertandingan`, `id_tim`, `id_pemain`, `menit`, `jenis_gol`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 3, 2, 1, '2020-06-01 09:31:28', '2020-06-01 09:31:28', NULL),
(2, 1, 1, 4, 10, 2, '2020-06-01 09:31:28', '2020-06-01 09:31:28', NULL),
(3, 1, 2, 1, 40, 1, '2020-06-01 09:31:28', '2020-06-01 09:31:28', NULL),
(4, 1, 2, 2, 70, 1, '2020-06-01 09:31:28', '2020-06-01 09:31:28', NULL),
(5, 2, 4, 7, 35, 1, '2020-06-01 12:48:38', '2020-06-01 12:48:38', NULL),
(6, 7, 6, 12, 12, 1, '2020-06-02 01:33:00', '2020-06-02 01:34:14', '2020-06-02 01:34:14');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_05_30_023913_create_posisi_pemain_table', 1),
(5, '2020_05_30_024129_create_pemain_table', 1),
(6, '2020_05_30_025112_create_tim_table', 1),
(7, '2020_05_30_181901_create_tim_pemain_table', 1),
(8, '2020_05_31_194939_create_pertandingan_table', 1),
(9, '2020_06_01_022626_create_detail_pertandingan_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemain`
--

CREATE TABLE `pemain` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_posisi` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tinggi` decimal(8,2) NOT NULL,
  `berat` decimal(8,2) NOT NULL,
  `bermain` tinyint(2) DEFAULT 0,
  `foto_pemain` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemain`
--

INSERT INTO `pemain` (`id`, `id_posisi`, `nama`, `tempat_lahir`, `tanggal_lahir`, `tinggi`, `berat`, `bermain`, `foto_pemain`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 'Achmad Andi S', 'Sidoarjo', '1998-11-28', '180.00', '75.00', 1, '1_010620-121809.jpg', '2020-06-01 05:18:09', '2020-06-01 05:18:09', NULL),
(2, 1, 'Azzam', 'Sidoarjo', '2004-11-29', '190.00', '80.00', 1, '2_010620-122924.jpg', '2020-06-01 05:20:19', '2020-06-01 05:29:24', NULL),
(3, 2, 'Febri S', 'Jombang', '2002-10-29', '180.00', '70.00', 0, '3_010620-122659.jpg', '2020-06-01 05:26:59', '2020-06-01 05:26:59', NULL),
(4, 1, 'Makruf', 'Kediri', '1999-03-02', '182.00', '70.00', 1, '4_010620-122950.jpg', '2020-06-01 05:28:00', '2020-06-01 05:29:50', NULL),
(5, 1, 'Deni A', 'Surabaya', '2000-11-29', '178.00', '75.00', 0, '5_010620-122859.png', '2020-06-01 05:28:59', '2020-06-01 05:28:59', NULL),
(6, 3, 'Kholil R', 'Surabaya', '1998-11-30', '189.00', '80.00', 0, '6_010620-123113.png', '2020-06-01 05:31:13', '2020-06-01 05:31:13', NULL),
(7, 1, 'Waffi M', 'Riau', '1998-10-27', '185.00', '78.00', 0, '7_010620-184156.PNG', '2020-06-01 11:41:56', '2020-06-01 11:41:56', NULL),
(8, 4, 'M Dayat', 'Bojonegoro', '1999-09-23', '179.00', '74.00', 0, '8_010620-184250.PNG', '2020-06-01 11:42:50', '2020-06-01 11:42:50', NULL),
(11, 1, 'Bot ABC', 'Mars', '9999-12-30', '100.00', '90.00', 1, NULL, '2020-06-01 14:13:08', '2020-06-02 01:47:32', NULL),
(12, 5, 'Deni A', 'Jombang', '2018-10-29', '123.00', '75.00', 1, NULL, '2020-06-01 14:15:17', '2020-06-02 01:34:14', '2020-06-02 01:34:14'),
(13, 4, 'BOT XYZ', 'Mars', '9999-12-31', '123.00', '100.00', 1, NULL, '2020-06-01 15:03:43', '2020-06-02 01:48:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pertandingan`
--

CREATE TABLE `pertandingan` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_tim_rumah` int(10) UNSIGNED NOT NULL,
  `id_tim_tamu` int(10) UNSIGNED NOT NULL,
  `jadwal_pertandingan` date NOT NULL,
  `waktu_mulai` time NOT NULL,
  `gol_rumah` tinyint(4) DEFAULT NULL,
  `gol_tamu` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pertandingan`
--

INSERT INTO `pertandingan` (`id`, `id_tim_rumah`, `id_tim_tamu`, `jadwal_pertandingan`, `waktu_mulai`, `gol_rumah`, `gol_tamu`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, '2020-05-15', '14:30:00', 3, 1, 1, '2020-06-01 05:32:21', '2020-06-01 09:31:28', NULL),
(2, 4, 3, '2020-06-01', '16:45:00', 1, 0, 1, '2020-06-01 11:44:30', '2020-06-01 12:48:38', NULL),
(3, 2, 4, '2020-06-08', '16:00:00', NULL, NULL, NULL, '2020-06-01 12:39:58', '2020-06-01 13:00:23', NULL),
(4, 3, 1, '2020-06-01', '14:45:00', 0, 0, 1, '2020-06-01 12:41:12', '2020-06-01 12:56:21', NULL),
(5, 1, 4, '2020-06-04', '16:45:00', NULL, NULL, NULL, '2020-06-01 12:57:36', '2020-06-01 13:00:00', NULL),
(6, 3, 1, '2020-06-01', '16:15:00', NULL, NULL, NULL, '2020-06-01 12:59:37', '2020-06-01 12:59:37', NULL),
(7, 6, 1, '2020-05-28', '16:00:00', 1, 0, 1, '2020-06-02 00:39:03', '2020-06-02 01:33:00', NULL),
(8, 3, 6, '2020-06-26', '16:00:00', NULL, NULL, NULL, '2020-06-02 00:52:07', '2020-06-02 01:13:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posisi_pemain`
--

CREATE TABLE `posisi_pemain` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_posisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan_posisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posisi_pemain`
--

INSERT INTO `posisi_pemain` (`id`, `nama_posisi`, `keterangan_posisi`) VALUES
(1, 'Kiper', '-'),
(2, 'Bek', ''),
(3, 'Gelandang', ''),
(4, 'Penyerang', ''),
(5, 'okokok', '');

-- --------------------------------------------------------

--
-- Table structure for table `tim`
--

CREATE TABLE `tim` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_tim` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan_tim` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_tim` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_berdiri` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tim`
--

INSERT INTO `tim` (`id`, `nama_tim`, `keterangan_tim`, `alamat_tim`, `kota`, `logo`, `tahun_berdiri`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Persebaya FC', 'The club was founded on June 18, 1927 under the name of the Soerabhaisasche Indonesische Voetbal Bond (SIVB). Paijo and M. Pamoedji, the founders of SIVB, intend to make this bond to house indigenous players.\r\nPreviously, in 1910, stood Sorabaiasche Voetbal Bond (SVB). But, this bond was established to be a representation of the Dutch community living in Surabaya. This club also had closeness with the Dutch East Indies government.\r\nBoth of them clearly have different policies. SIVB, which consists of indigenous people, was actively involved in the Indonesian independence movement.', 'Semampir Gang III, RUngkut', 'Surabaya', '1_010620-120551.png', '1927', '2020-06-01 05:05:51', '2020-06-01 05:15:04', NULL),
(2, 'Deltras FC', 'Founded in 1989 by a businessman named H.M. Mislan as Gelora Dewata \'89 with home base in Bali, they moved to Sidoarjo in 2001 and changed their name to Gelora Putra Delta after playing some matches in the early 2001–2002 season. Some time later, still in 2001, the club renamed as Deltras, an acronym to Delta Putra Sidoarjo.', 'Jalan Ponti 100', 'Sidoarjo', '2_010620-120638.png', '1989', '2020-06-01 05:06:38', '2020-06-01 05:13:17', NULL),
(3, 'Persela Fc', '-', 'Jalan Pahlawan no 991', 'Lamongan', '3_010620-120717.png', '1979', '2020-06-01 05:07:17', '2020-06-01 05:07:17', NULL),
(4, 'Arema Fc', '-', 'Jalan Pahlawan no 1283', 'Malang', '4_010620-120834.png', '1970', '2020-06-01 05:08:34', '2020-06-01 05:08:35', NULL),
(6, 'Robot FC', '-', 'the Universe', 'Mars', '6_010620-211156.jpg', '9999', '2020-06-01 14:11:56', '2020-06-02 01:46:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tim_pemain`
--

CREATE TABLE `tim_pemain` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_tim` int(10) UNSIGNED NOT NULL,
  `id_pemain` int(10) UNSIGNED NOT NULL,
  `nomor_punggung` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_gabung` date NOT NULL,
  `tanggal_pindah` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tim_pemain`
--

INSERT INTO `tim_pemain` (`id`, `id_tim`, `id_pemain`, `nomor_punggung`, `tanggal_gabung`, `tanggal_pindah`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, '7', '2020-06-01', NULL, 1, '2020-06-01 05:18:09', '2020-06-01 05:18:09', NULL),
(2, 2, 2, '2', '2020-06-01', NULL, 1, '2020-06-01 05:20:19', '2020-06-01 05:20:19', NULL),
(3, 1, 3, '71', '2020-06-01', NULL, 1, '2020-06-01 05:26:59', '2020-06-01 05:26:59', NULL),
(4, 1, 4, '2', '2020-06-01', NULL, 1, '2020-06-01 05:28:00', '2020-06-01 05:28:00', NULL),
(5, 3, 5, '2', '2020-06-01', NULL, 1, '2020-06-01 05:28:59', '2020-06-01 05:28:59', NULL),
(6, 3, 6, '7', '2020-06-01', NULL, 1, '2020-06-01 05:31:13', '2020-06-01 05:31:13', NULL),
(7, 4, 7, '3', '2020-06-01', NULL, 1, '2020-06-01 11:41:56', '2020-06-01 11:41:56', NULL),
(8, 4, 8, '7', '2020-06-01', NULL, 1, '2020-06-01 11:42:50', '2020-06-01 11:42:50', NULL),
(11, 6, 11, '15', '2020-06-02', NULL, 1, '2020-06-02 00:35:54', '2020-06-02 00:37:20', NULL),
(12, 6, 12, '12', '2020-06-02', NULL, 1, '2020-06-02 00:36:16', '2020-06-02 01:33:39', '2020-06-02 01:33:39'),
(13, 6, 13, '19', '2020-06-02', NULL, 1, '2020-06-02 01:48:14', '2020-06-02 01:48:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pertandingan`
--
ALTER TABLE `detail_pertandingan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_pertandingan_id_pertandingan_foreign` (`id_pertandingan`),
  ADD KEY `detail_pertandingan_id_pemain_foreign` (`id_pemain`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pemain`
--
ALTER TABLE `pemain`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemain_id_posisi_foreign` (`id_posisi`);

--
-- Indexes for table `pertandingan`
--
ALTER TABLE `pertandingan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pertandingan_id_tim_rumah_foreign` (`id_tim_rumah`),
  ADD KEY `pertandingan_id_tim_tamu_foreign` (`id_tim_tamu`);

--
-- Indexes for table `posisi_pemain`
--
ALTER TABLE `posisi_pemain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tim`
--
ALTER TABLE `tim`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tim_pemain`
--
ALTER TABLE `tim_pemain`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tim_pemain_id_tim_foreign` (`id_tim`),
  ADD KEY `tim_pemain_id_pemain_foreign` (`id_pemain`);

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
-- AUTO_INCREMENT for table `detail_pertandingan`
--
ALTER TABLE `detail_pertandingan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pemain`
--
ALTER TABLE `pemain`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pertandingan`
--
ALTER TABLE `pertandingan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posisi_pemain`
--
ALTER TABLE `posisi_pemain`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tim`
--
ALTER TABLE `tim`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tim_pemain`
--
ALTER TABLE `tim_pemain`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pertandingan`
--
ALTER TABLE `detail_pertandingan`
  ADD CONSTRAINT `detail_pertandingan_id_pemain_foreign` FOREIGN KEY (`id_pemain`) REFERENCES `pemain` (`id`),
  ADD CONSTRAINT `detail_pertandingan_id_pertandingan_foreign` FOREIGN KEY (`id_pertandingan`) REFERENCES `pertandingan` (`id`);

--
-- Constraints for table `pemain`
--
ALTER TABLE `pemain`
  ADD CONSTRAINT `pemain_id_posisi_foreign` FOREIGN KEY (`id_posisi`) REFERENCES `posisi_pemain` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pertandingan`
--
ALTER TABLE `pertandingan`
  ADD CONSTRAINT `pertandingan_id_tim_rumah_foreign` FOREIGN KEY (`id_tim_rumah`) REFERENCES `tim` (`id`),
  ADD CONSTRAINT `pertandingan_id_tim_tamu_foreign` FOREIGN KEY (`id_tim_tamu`) REFERENCES `tim` (`id`);

--
-- Constraints for table `tim_pemain`
--
ALTER TABLE `tim_pemain`
  ADD CONSTRAINT `tim_pemain_id_pemain_foreign` FOREIGN KEY (`id_pemain`) REFERENCES `pemain` (`id`),
  ADD CONSTRAINT `tim_pemain_id_tim_foreign` FOREIGN KEY (`id_tim`) REFERENCES `tim` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
