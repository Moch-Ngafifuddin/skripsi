-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 20, 2026 at 06:45 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_posyandu_v2`
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
('laravel-cache-livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3', 'i:1;', 1771569231),
('laravel-cache-livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3:timer', 'i:1771569231;', 1771569231);

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
(4, '2026_02_19_041607_create_posyandu_tables', 1),
(5, '2026_02_19_055342_add_akses_menu_to_users_table', 2),
(6, '2026_02_19_071657_add_detail_kartu_to_posyandu_tables', 3),
(7, '2026_02_19_160315_ubah_pengukuran_jadi_nullable', 4),
(8, '2026_02_19_163233_add_meja_tugas_to_users_table', 5),
(9, '2026_02_20_062207_add_kolom_baru_to_pemeriksaan_bayi_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` bigint UNSIGNED NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_kk` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik_ayah` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendidikan_pekerjaan_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik_ibu` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendidikan_pekerjaan_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anak_ke` int DEFAULT NULL,
  `berat_lahir` decimal(6,2) DEFAULT NULL COMMENT 'BBL dalam gram/kg',
  `panjang_lahir` decimal(5,2) DEFAULT NULL COMMENT 'PBL dalam cm',
  `imd` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Inisiasi Menyusu Dini',
  `riwayat_asi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'E1, E2, E3, E4, E5, E6',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `nik`, `no_kk`, `nama`, `jenis_kelamin`, `tgl_lahir`, `tempat_lahir`, `alamat`, `no_hp`, `nama_wali`, `nama_ayah`, `nik_ayah`, `pendidikan_pekerjaan_ayah`, `nama_ibu`, `nik_ibu`, `pendidikan_pekerjaan_ibu`, `anak_ke`, `berat_lahir`, `panjang_lahir`, `imd`, `riwayat_asi`, `created_at`, `updated_at`) VALUES
(1, '3306181802990002', '3306181802990002', 'Abdila Adi Tama', 'L', '2026-02-01', 'Banyumas', 'JL.SOKANEGARA NO.33', '085393805550', NULL, 'Darso', '3306181802990001', 'S1 / BUMN', 'Sulis', '3306181802990008', 'S1 / PNS', 1, 2953.00, 60.00, 1, 'E1', '2026-02-19 00:48:41', '2026-02-19 00:48:41');

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
-- Table structure for table `pemeriksaan_bayi`
--

CREATE TABLE `pemeriksaan_bayi` (
  `id` bigint UNSIGNED NOT NULL,
  `pasien_id` bigint UNSIGNED NOT NULL,
  `tgl_periksa` date NOT NULL,
  `keterangan_umur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usia_bulan` int DEFAULT NULL,
  `berat_badan` decimal(5,2) DEFAULT NULL,
  `tinggi_badan` decimal(5,2) DEFAULT NULL,
  `rambu_gizi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'N / T / O',
  `titik_pertumbuhan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Hijau / Kuning / BGM',
  `lingkar_kepala` decimal(5,2) DEFAULT NULL,
  `lingkar_lengan` decimal(5,2) DEFAULT NULL COMMENT 'LILA cm',
  `vitamin_a` tinyint(1) NOT NULL DEFAULT '0',
  `obat_cacing` tinyint(1) NOT NULL DEFAULT '0',
  `sdidtk_pmba_asi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SDIDTK/PMBA/ASI Eksklusif',
  `jenis_imunisasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deteksi_tbc` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'S.TBC',
  `kie` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Konseling/KIE',
  `rujuk` tinyint(1) NOT NULL DEFAULT '0',
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `status_gizi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_stunting` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `asi_eksklusif` tinyint(1) DEFAULT '0',
  `pmba` tinyint(1) DEFAULT '0',
  `sdidtk` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemeriksaan_bayi`
--

INSERT INTO `pemeriksaan_bayi` (`id`, `pasien_id`, `tgl_periksa`, `keterangan_umur`, `usia_bulan`, `berat_badan`, `tinggi_badan`, `rambu_gizi`, `titik_pertumbuhan`, `lingkar_kepala`, `lingkar_lengan`, `vitamin_a`, `obat_cacing`, `sdidtk_pmba_asi`, `jenis_imunisasi`, `deteksi_tbc`, `kie`, `rujuk`, `catatan`, `status_gizi`, `status_stunting`, `created_at`, `updated_at`, `asi_eksklusif`, `pmba`, `sdidtk`) VALUES
(1, 1, '2026-02-19', NULL, NULL, 30.00, 110.00, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2026-02-19 09:04:21', '2026-02-19 09:47:40', 0, 0, 0),
(2, 1, '2026-02-20', NULL, NULL, 20.00, 135.00, 'N', 'H', 15.00, 20.00, 1, 1, NULL, 'Campak', 1, 1, 1, 'test 1', NULL, NULL, '2026-02-19 21:01:42', '2026-02-19 23:12:46', 0, 0, 0),
(3, 1, '2026-02-14', '13 Hari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, '2026-02-19 23:33:50', '2026-02-19 23:34:14', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pemeriksaan_lansia`
--

CREATE TABLE `pemeriksaan_lansia` (
  `id` bigint UNSIGNED NOT NULL,
  `pasien_id` bigint UNSIGNED NOT NULL,
  `tgl_periksa` date NOT NULL,
  `berat_badan` decimal(5,2) DEFAULT NULL,
  `tinggi_badan` decimal(5,2) DEFAULT NULL,
  `lingkar_perut` decimal(5,2) DEFAULT NULL,
  `sistole` int DEFAULT NULL,
  `diastole` int DEFAULT NULL,
  `gula_darah` int DEFAULT NULL,
  `kolesterol` decimal(5,2) DEFAULT NULL,
  `asam_urat` decimal(4,2) DEFAULT NULL,
  `riwayat_penyakit` text COLLATE utf8mb4_unicode_ci,
  `tindakan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemeriksaan_remaja`
--

CREATE TABLE `pemeriksaan_remaja` (
  `id` bigint UNSIGNED NOT NULL,
  `pasien_id` bigint UNSIGNED NOT NULL,
  `tgl_periksa` date NOT NULL,
  `berat_badan` decimal(5,2) DEFAULT NULL,
  `tinggi_badan` decimal(5,2) DEFAULT NULL,
  `sistole` int DEFAULT NULL,
  `diastole` int DEFAULT NULL,
  `kadar_hb` decimal(4,1) DEFAULT NULL,
  `lingkar_lengan` decimal(5,2) DEFAULT NULL,
  `minum_ttd` tinyint(1) NOT NULL DEFAULT '0',
  `keluhan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('1weQb6NeAoeEDjP5jf7wTCfJ3nagraYntUCUrLj3', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiYnZ2ZjNuQkU4YWU1NEo3cWFWRXR2S2ZFUlp4T3JoZHJVVEpxOEp4ZyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wZW1lcmlrc2Fhbi1iYXlpcy8zL2VkaXQiO3M6NToicm91dGUiO3M6NDc6ImZpbGFtZW50LmFkbWluLnJlc291cmNlcy5wZW1lcmlrc2Fhbi1iYXlpcy5lZGl0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2NDoiZTVkNjZmYWQ3NWRlYmVjYWQ1NjhiYmUzOWMwYTY4Nzg3YTljZDUzNmM5Y2Q2MDU5YjY0N2Y4OGU1ZTJlYzg3MiI7czo4OiJmaWxhbWVudCI7YTowOnt9fQ==', 1771569240),
('KyMt3rtKLy8bVCFudcgCyL9GtPJKxnrrBZM43lAE', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiczhkZEoycWJIVks4Z2E3MUxJcFR6UEtwTDRlVUF2VlFlNlJoZXJJdyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi91c2Vycy8yL2VkaXQiO3M6NToicm91dGUiO3M6MzU6ImZpbGFtZW50LmFkbWluLnJlc291cmNlcy51c2Vycy5lZGl0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2NDoiNDFjNDVjNDdlZGJjMmY1MDRhNjYwOWUwZjc5NmE5MDlhZDdjMzViNDdmOGFkMTIwYmQ5MjA3Nzk3Yzg1NzY0NyI7czo4OiJmaWxhbWVudCI7YTowOnt9fQ==', 1771567143),
('MxR051cI37GvYAnEpO5FeMntFyzwUJjOOy8xi2jC', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiU2NjM1BraGNCdER1ZVJBcjRvN1pxbmNpY1NoSHBSMjZkam85VGNCSCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wYW50YXUiO3M6NToicm91dGUiO3M6MTI6InBhbnRhdS5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjY7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjQ6IjVhNTRjZmNhNjNmNTQ0N2VlYjk1Njc3MWIzOWU4NmQxMmMzNWIyNDY1YzcyMmY1ZWZmMTRmNmM1MjcyNWQ4NzAiO3M6ODoiZmlsYW1lbnQiO2E6MDp7fX0=', 1771569901);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meja_tugas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `akses_menu` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `meja_tugas`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `akses_menu`) VALUES
(1, 'Admin', 'admin@posyandu.com', 'superadmin', NULL, '$2y$12$tQ4oPii4JZCkPEdFtkHoBOiiSGDcYPIBMTy7bG31zmlv87rZbzMzW', NULL, '2026-02-18 21:21:27', '2026-02-19 20:20:48', '[\"bayi\", \"lansia\", \"remaja\", \"user\"]'),
(2, 'admin1', 'admin1@posyandu.com', 'meja_1', NULL, '$2y$12$gDQ1XO2P3kWaRRHBwcSiSuQp2vcjSUHf8cfOAtuqnqJe6.vxRkey6', 'b8zpi218nYRxgsCPeRIV9wNSoueK1dBXAioDqlJUNKUYmGjt40QcXUgA9qHF', '2026-02-18 22:25:50', '2026-02-19 22:58:53', '[\"bayi\", \"lansia\", \"remaja\", \"pasien\"]'),
(3, 'admin2', 'admin2@posyandu.com', 'meja_2', NULL, '$2y$12$WLlv4atRQUb/kH9fIgnDA.lTcMZIWe.Kloq.r48jzj4ECMk9lK9B2', NULL, '2026-02-18 22:26:09', '2026-02-19 20:21:31', '[\"bayi\", \"lansia\", \"remaja\"]'),
(4, 'admin3', 'admin3@posyandu.com', 'meja_3', NULL, '$2y$12$OgDGE.xR.iRNdxDkY7WiSOC2fz.TorIQYqfKeS2YpLcABcVSQvCMq', NULL, '2026-02-18 22:26:26', '2026-02-19 20:21:46', '[\"bayi\", \"lansia\", \"remaja\"]'),
(5, 'admin4', 'admin4@posyandu.com', 'meja_4', NULL, '$2y$12$u1CE.p6VcF5YnrIjniLE6Ona1/ZIsRbg94P1jqa96zg.xroBNLvly', NULL, '2026-02-18 22:26:47', '2026-02-19 20:22:29', '[\"bayi\", \"lansia\", \"remaja\"]'),
(6, 'admin5', 'admin5@posyandu.com', 'meja_5', NULL, '$2y$12$6rZQvQEnhvGQtJNI6Poh...qnB9ZsItaxDcXUFDTA7f4BXFZObqhe', 'Ca0b8jAwTAfyidrT6LE1FZK6aktmBNP9G862eNWaBVm0lU8Eyj5y2DmpXajp', '2026-02-19 21:28:11', '2026-02-19 21:28:11', '[\"remaja\", \"bayi\", \"lansia\"]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pasien_nik_unique` (`nik`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pemeriksaan_bayi`
--
ALTER TABLE `pemeriksaan_bayi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemeriksaan_bayi_pasien_id_foreign` (`pasien_id`);

--
-- Indexes for table `pemeriksaan_lansia`
--
ALTER TABLE `pemeriksaan_lansia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemeriksaan_lansia_pasien_id_foreign` (`pasien_id`);

--
-- Indexes for table `pemeriksaan_remaja`
--
ALTER TABLE `pemeriksaan_remaja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemeriksaan_remaja_pasien_id_foreign` (`pasien_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pemeriksaan_bayi`
--
ALTER TABLE `pemeriksaan_bayi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pemeriksaan_lansia`
--
ALTER TABLE `pemeriksaan_lansia`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemeriksaan_remaja`
--
ALTER TABLE `pemeriksaan_remaja`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pemeriksaan_bayi`
--
ALTER TABLE `pemeriksaan_bayi`
  ADD CONSTRAINT `pemeriksaan_bayi_pasien_id_foreign` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pemeriksaan_lansia`
--
ALTER TABLE `pemeriksaan_lansia`
  ADD CONSTRAINT `pemeriksaan_lansia_pasien_id_foreign` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pemeriksaan_remaja`
--
ALTER TABLE `pemeriksaan_remaja`
  ADD CONSTRAINT `pemeriksaan_remaja_pasien_id_foreign` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
