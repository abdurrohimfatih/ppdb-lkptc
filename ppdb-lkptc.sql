-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2022 at 05:55 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppdb-lkptc`
--

-- --------------------------------------------------------

--
-- Table structure for table `biodata`
--

CREATE TABLE `biodata` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT 'L',
  `status_perkawinan` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anak_ke` smallint(6) DEFAULT NULL,
  `jumlah_saudara` smallint(6) DEFAULT NULL,
  `alamat_lengkap` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jalur_tes` smallint(6) NOT NULL DEFAULT 1,
  `konfirmasi` smallint(6) NOT NULL DEFAULT 0,
  `status` smallint(6) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `biodata`
--

INSERT INTO `biodata` (`id`, `user_id`, `nama_lengkap`, `no_telp`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `status_perkawinan`, `agama`, `anak_ke`, `jumlah_saudara`, `alamat_lengkap`, `img_user`, `jalur_tes`, `konfirmasi`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'Abdurrohim', '08111111111111', 'Cirebon', '2022-11-04', 'L', 'Belum Kawin', 'Islam', 9, 8, 'Cirebon', '', 1, 0, 1, '2022-11-04 09:44:11', '2022-11-04 09:45:03');

-- --------------------------------------------------------

--
-- Table structure for table `data_keluarga`
--

CREATE TABLE `data_keluarga` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama_ayah` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_ibu` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan_ayah` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_ibu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usia_ayah` smallint(6) DEFAULT NULL,
  `usia_ibu` smallint(6) DEFAULT NULL,
  `alamat_ayah` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_ibu` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telp_ayah` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telp_ibu` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_keluarga`
--

INSERT INTO `data_keluarga` (`id`, `user_id`, `nama_ayah`, `nama_ibu`, `pekerjaan_ayah`, `pekerjaan_ibu`, `usia_ayah`, `usia_ibu`, `alamat_ayah`, `alamat_ibu`, `no_telp_ayah`, `no_telp_ibu`, `created_at`, `updated_at`) VALUES
(2, 4, 'Abc', 'Abc', 'Abc', 'Abc', 10, 10, 'Abc', 'Abc', '081111111111', '08111111111111', '2022-11-03 00:30:27', '2022-11-03 00:30:27');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jurusan_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan_prodi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jurusan_bidstudi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `jurusan_name`, `jurusan_prodi`, `jurusan_bidstudi`, `created_at`, `updated_at`) VALUES
(1, 'Teknik Informatika', 'Teknik', 'Teknik', '2022-10-31 22:23:36', '2022-10-31 22:23:36'),
(2, 'Teknik Elektro', 'Teknik', 'Teknik', '2022-10-31 22:23:36', '2022-10-31 22:23:36'),
(3, 'Teknik Mesin', 'Teknik', 'Teknik', '2022-10-31 22:23:36', '2022-10-31 22:23:36');

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_10_31_212945_create_biodatas_table', 2),
(6, '2022_10_31_221522_create_jurusans_table', 3),
(7, '2022_10_31_222120_create_post_jurusan_table', 4),
(8, '2022_10_31_222704_create_nilais_table', 5),
(9, '2022_10_31_222951_create_post_nilai', 6),
(10, '2022_10_31_223806_create_prestasis_table', 7),
(11, '2022_10_31_231840_create_data_keluargas_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nilai_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_kkm` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `nilai_name`, `nilai_kkm`, `created_at`, `updated_at`) VALUES
(1, 'Matematika', 60.00, '2022-10-31 23:08:16', '2022-10-31 23:08:16'),
(2, 'Bahasa Inggris', 60.00, '2022-10-31 23:08:16', '2022-10-31 23:08:16');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_jurusan`
--

CREATE TABLE `post_jurusan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `jurusan_id` bigint(20) UNSIGNED NOT NULL,
  `kat` smallint(6) NOT NULL COMMENT '1=Pilihan 1, 2=Pilihan 2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_jurusan`
--

INSERT INTO `post_jurusan` (`id`, `user_id`, `jurusan_id`, `kat`, `created_at`, `updated_at`) VALUES
(3, 4, 3, 1, '2022-11-03 00:33:22', '2022-11-03 19:08:31'),
(4, 4, 1, 2, '2022-11-03 00:33:22', '2022-11-03 19:08:31'),
(5, 5, 3, 1, '2022-11-04 00:42:11', '2022-11-04 00:42:11'),
(6, 5, 1, 2, '2022-11-04 00:42:11', '2022-11-04 00:42:11');

-- --------------------------------------------------------

--
-- Table structure for table `post_nilai`
--

CREATE TABLE `post_nilai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nilai_id` bigint(20) UNSIGNED NOT NULL,
  `score_s1` double(8,2) NOT NULL DEFAULT 0.00,
  `score_s2` double(8,2) NOT NULL DEFAULT 0.00,
  `score_s3` double(8,2) NOT NULL DEFAULT 0.00,
  `score_s4` double(8,2) NOT NULL DEFAULT 0.00,
  `score_s5` double(8,2) NOT NULL DEFAULT 0.00,
  `score_un` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_nilai`
--

INSERT INTO `post_nilai` (`id`, `user_id`, `nilai_id`, `score_s1`, `score_s2`, `score_s3`, `score_s4`, `score_s5`, `score_un`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 70.00, 75.00, 80.00, 85.00, 90.00, 95.00, '2022-11-03 18:57:21', '2022-11-03 18:57:21'),
(2, 4, 2, 60.00, 65.00, 70.00, 75.00, 80.00, 85.00, '2022-11-03 18:57:21', '2022-11-03 18:57:21'),
(5, 5, 1, 50.00, 50.00, 50.00, 50.00, 50.00, 50.00, '2022-11-04 05:08:28', '2022-11-04 05:08:28'),
(6, 5, 2, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2022-11-04 05:08:28', '2022-11-04 05:08:28');

-- --------------------------------------------------------

--
-- Table structure for table `prestasi`
--

CREATE TABLE `prestasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `prestasi` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tingkat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` smallint(6) NOT NULL COMMENT '1=user, 2=pengawas, 3=admin',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$eDqzVg19aCMCFMt0epIs5.hNyQ.KHAAu8hnnxkx1Bte5fQncIkNUK', 3, 'ndyFZOKCSiOFgYIR7WXlciMgw6HLDWW7D2bY8DtKeM6nMBR59C69Rmiay9GC', '2022-10-31 14:50:22', NULL),
(2, 'pengawas', 'pengawas@gmail.com', '$2y$10$mYMobBv4JWy.KTBLiKA/jeCHDsK9iKfbWoJb1PWO55navVY195HYi', 2, 'IxYHJ9vIBngT4BKS5sUnHOjCt9u4dePAnQJksyGuZXff00TzuzSMXa1Eehsk', '2022-10-31 14:50:22', NULL),
(4, 'Abdurrohim', 'abdurrohim130201@gmail.com', '$2y$10$cw6vtGYBMNpnWf9azpIqKu/ChkaQgT/AVv8IJDY0qL3wzaa/OczR6', 1, 'PtItw4iJx9tvpgVOa1B9syRFBNeyOGyTGCCl9kUU8ebuUmVxscQQuLJGKglK', '2022-11-03 00:29:58', '2022-11-03 00:29:58'),
(5, 'Budi', 'budi@gmail.com', '$2y$10$SiAzzheGvkTg1reUkloxV.VTi.sbtaRnCxSXMb5cRnoDMXG0EOb4e', 1, 'K7VSICAh2Hg4Mzp57tkdrLJeBzAprsYzm3LlGY7GzWlxDKTyx5StqOwy4mz7', '2022-11-04 00:41:27', '2022-11-04 00:41:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biodata`
--
ALTER TABLE `biodata`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `biodata_no_telp_unique` (`no_telp`),
  ADD KEY `biodata_user_id_foreign` (`user_id`);

--
-- Indexes for table `data_keluarga`
--
ALTER TABLE `data_keluarga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_keluarga_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jurusan_jurusan_name_unique` (`jurusan_name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
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
-- Indexes for table `post_jurusan`
--
ALTER TABLE `post_jurusan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_jurusan_user_id_foreign` (`user_id`),
  ADD KEY `post_jurusan_jurusan_id_foreign` (`jurusan_id`);

--
-- Indexes for table `post_nilai`
--
ALTER TABLE `post_nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_nilai_user_id_foreign` (`user_id`),
  ADD KEY `post_nilai_nilai_id_foreign` (`nilai_id`);

--
-- Indexes for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prestasi_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `biodata`
--
ALTER TABLE `biodata`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_keluarga`
--
ALTER TABLE `data_keluarga`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_jurusan`
--
ALTER TABLE `post_jurusan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `post_nilai`
--
ALTER TABLE `post_nilai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `prestasi`
--
ALTER TABLE `prestasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `biodata`
--
ALTER TABLE `biodata`
  ADD CONSTRAINT `biodata_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_keluarga`
--
ALTER TABLE `data_keluarga`
  ADD CONSTRAINT `data_keluarga_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_jurusan`
--
ALTER TABLE `post_jurusan`
  ADD CONSTRAINT `post_jurusan_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_jurusan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_nilai`
--
ALTER TABLE `post_nilai`
  ADD CONSTRAINT `post_nilai_nilai_id_foreign` FOREIGN KEY (`nilai_id`) REFERENCES `nilai` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_nilai_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD CONSTRAINT `prestasi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
