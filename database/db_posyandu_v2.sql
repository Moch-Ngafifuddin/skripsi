-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 07, 2026 at 07:51 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

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
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-livewire-rate-limiter:75a036ac0fdcb20b35ac6fd6a3875ea2dbe60af1', 'i:1;', 1780810352),
('laravel-cache-livewire-rate-limiter:75a036ac0fdcb20b35ac6fd6a3875ea2dbe60af1:timer', 'i:1780810352;', 1780810352),
('laravel-cache-master_bbtb_all', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:20:{i:0;O:21:\"App\\Models\\MasterBbtb\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:11:\"master_bbtb\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:1;s:13:\"jenis_kelamin\";s:1:\"L\";s:15:\"tinggi_badan_cm\";s:4:\"45.0\";s:10:\"minus_3_sd\";s:3:\"1.9\";s:10:\"minus_2_sd\";s:3:\"2.0\";s:10:\"minus_1_sd\";s:3:\"2.2\";s:6:\"median\";s:3:\"2.4\";s:9:\"plus_1_sd\";s:3:\"2.7\";s:9:\"plus_2_sd\";s:3:\"2.9\";s:9:\"plus_3_sd\";s:3:\"3.2\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:1;s:13:\"jenis_kelamin\";s:1:\"L\";s:15:\"tinggi_badan_cm\";s:4:\"45.0\";s:10:\"minus_3_sd\";s:3:\"1.9\";s:10:\"minus_2_sd\";s:3:\"2.0\";s:10:\"minus_1_sd\";s:3:\"2.2\";s:6:\"median\";s:3:\"2.4\";s:9:\"plus_1_sd\";s:3:\"2.7\";s:9:\"plus_2_sd\";s:3:\"2.9\";s:9:\"plus_3_sd\";s:3:\"3.2\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:21:\"App\\Models\\MasterBbtb\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:11:\"master_bbtb\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:2;s:13:\"jenis_kelamin\";s:1:\"L\";s:15:\"tinggi_badan_cm\";s:4:\"46.0\";s:10:\"minus_3_sd\";s:3:\"2.0\";s:10:\"minus_2_sd\";s:3:\"2.2\";s:10:\"minus_1_sd\";s:3:\"2.4\";s:6:\"median\";s:3:\"2.6\";s:9:\"plus_1_sd\";s:3:\"2.9\";s:9:\"plus_2_sd\";s:3:\"3.1\";s:9:\"plus_3_sd\";s:3:\"3.5\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:2;s:13:\"jenis_kelamin\";s:1:\"L\";s:15:\"tinggi_badan_cm\";s:4:\"46.0\";s:10:\"minus_3_sd\";s:3:\"2.0\";s:10:\"minus_2_sd\";s:3:\"2.2\";s:10:\"minus_1_sd\";s:3:\"2.4\";s:6:\"median\";s:3:\"2.6\";s:9:\"plus_1_sd\";s:3:\"2.9\";s:9:\"plus_2_sd\";s:3:\"3.1\";s:9:\"plus_3_sd\";s:3:\"3.5\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:21:\"App\\Models\\MasterBbtb\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:11:\"master_bbtb\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:3;s:13:\"jenis_kelamin\";s:1:\"L\";s:15:\"tinggi_badan_cm\";s:4:\"47.0\";s:10:\"minus_3_sd\";s:3:\"2.2\";s:10:\"minus_2_sd\";s:3:\"2.4\";s:10:\"minus_1_sd\";s:3:\"2.6\";s:6:\"median\";s:3:\"2.8\";s:9:\"plus_1_sd\";s:3:\"3.1\";s:9:\"plus_2_sd\";s:3:\"3.4\";s:9:\"plus_3_sd\";s:3:\"3.7\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:3;s:13:\"jenis_kelamin\";s:1:\"L\";s:15:\"tinggi_badan_cm\";s:4:\"47.0\";s:10:\"minus_3_sd\";s:3:\"2.2\";s:10:\"minus_2_sd\";s:3:\"2.4\";s:10:\"minus_1_sd\";s:3:\"2.6\";s:6:\"median\";s:3:\"2.8\";s:9:\"plus_1_sd\";s:3:\"3.1\";s:9:\"plus_2_sd\";s:3:\"3.4\";s:9:\"plus_3_sd\";s:3:\"3.7\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:21:\"App\\Models\\MasterBbtb\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:11:\"master_bbtb\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:4;s:13:\"jenis_kelamin\";s:1:\"L\";s:15:\"tinggi_badan_cm\";s:4:\"48.0\";s:10:\"minus_3_sd\";s:3:\"2.4\";s:10:\"minus_2_sd\";s:3:\"2.5\";s:10:\"minus_1_sd\";s:3:\"2.8\";s:6:\"median\";s:3:\"3.0\";s:9:\"plus_1_sd\";s:3:\"3.3\";s:9:\"plus_2_sd\";s:3:\"3.6\";s:9:\"plus_3_sd\";s:3:\"4.0\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:4;s:13:\"jenis_kelamin\";s:1:\"L\";s:15:\"tinggi_badan_cm\";s:4:\"48.0\";s:10:\"minus_3_sd\";s:3:\"2.4\";s:10:\"minus_2_sd\";s:3:\"2.5\";s:10:\"minus_1_sd\";s:3:\"2.8\";s:6:\"median\";s:3:\"3.0\";s:9:\"plus_1_sd\";s:3:\"3.3\";s:9:\"plus_2_sd\";s:3:\"3.6\";s:9:\"plus_3_sd\";s:3:\"4.0\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:4;O:21:\"App\\Models\\MasterBbtb\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:11:\"master_bbtb\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:5;s:13:\"jenis_kelamin\";s:1:\"L\";s:15:\"tinggi_badan_cm\";s:4:\"49.0\";s:10:\"minus_3_sd\";s:3:\"2.5\";s:10:\"minus_2_sd\";s:3:\"2.7\";s:10:\"minus_1_sd\";s:3:\"3.0\";s:6:\"median\";s:3:\"3.2\";s:9:\"plus_1_sd\";s:3:\"3.5\";s:9:\"plus_2_sd\";s:3:\"3.9\";s:9:\"plus_3_sd\";s:3:\"4.3\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:5;s:13:\"jenis_kelamin\";s:1:\"L\";s:15:\"tinggi_badan_cm\";s:4:\"49.0\";s:10:\"minus_3_sd\";s:3:\"2.5\";s:10:\"minus_2_sd\";s:3:\"2.7\";s:10:\"minus_1_sd\";s:3:\"3.0\";s:6:\"median\";s:3:\"3.2\";s:9:\"plus_1_sd\";s:3:\"3.5\";s:9:\"plus_2_sd\";s:3:\"3.9\";s:9:\"plus_3_sd\";s:3:\"4.3\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:5;O:21:\"App\\Models\\MasterBbtb\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:11:\"master_bbtb\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:6;s:13:\"jenis_kelamin\";s:1:\"L\";s:15:\"tinggi_badan_cm\";s:4:\"50.0\";s:10:\"minus_3_sd\";s:3:\"2.7\";s:10:\"minus_2_sd\";s:3:\"2.9\";s:10:\"minus_1_sd\";s:3:\"3.2\";s:6:\"median\";s:3:\"3.4\";s:9:\"plus_1_sd\";s:3:\"3.8\";s:9:\"plus_2_sd\";s:3:\"4.1\";s:9:\"plus_3_sd\";s:3:\"4.5\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:6;s:13:\"jenis_kelamin\";s:1:\"L\";s:15:\"tinggi_badan_cm\";s:4:\"50.0\";s:10:\"minus_3_sd\";s:3:\"2.7\";s:10:\"minus_2_sd\";s:3:\"2.9\";s:10:\"minus_1_sd\";s:3:\"3.2\";s:6:\"median\";s:3:\"3.4\";s:9:\"plus_1_sd\";s:3:\"3.8\";s:9:\"plus_2_sd\";s:3:\"4.1\";s:9:\"plus_3_sd\";s:3:\"4.5\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:6;O:21:\"App\\Models\\MasterBbtb\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:11:\"master_bbtb\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:7;s:13:\"jenis_kelamin\";s:1:\"L\";s:15:\"tinggi_badan_cm\";s:4:\"55.0\";s:10:\"minus_3_sd\";s:3:\"3.6\";s:10:\"minus_2_sd\";s:3:\"3.9\";s:10:\"minus_1_sd\";s:3:\"4.3\";s:6:\"median\";s:3:\"4.7\";s:9:\"plus_1_sd\";s:3:\"5.1\";s:9:\"plus_2_sd\";s:3:\"5.6\";s:9:\"plus_3_sd\";s:3:\"6.2\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:7;s:13:\"jenis_kelamin\";s:1:\"L\";s:15:\"tinggi_badan_cm\";s:4:\"55.0\";s:10:\"minus_3_sd\";s:3:\"3.6\";s:10:\"minus_2_sd\";s:3:\"3.9\";s:10:\"minus_1_sd\";s:3:\"4.3\";s:6:\"median\";s:3:\"4.7\";s:9:\"plus_1_sd\";s:3:\"5.1\";s:9:\"plus_2_sd\";s:3:\"5.6\";s:9:\"plus_3_sd\";s:3:\"6.2\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:7;O:21:\"App\\Models\\MasterBbtb\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:11:\"master_bbtb\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:8;s:13:\"jenis_kelamin\";s:1:\"L\";s:15:\"tinggi_badan_cm\";s:4:\"60.0\";s:10:\"minus_3_sd\";s:3:\"4.7\";s:10:\"minus_2_sd\";s:3:\"5.1\";s:10:\"minus_1_sd\";s:3:\"5.5\";s:6:\"median\";s:3:\"6.0\";s:9:\"plus_1_sd\";s:3:\"6.6\";s:9:\"plus_2_sd\";s:3:\"7.2\";s:9:\"plus_3_sd\";s:3:\"7.9\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:8;s:13:\"jenis_kelamin\";s:1:\"L\";s:15:\"tinggi_badan_cm\";s:4:\"60.0\";s:10:\"minus_3_sd\";s:3:\"4.7\";s:10:\"minus_2_sd\";s:3:\"5.1\";s:10:\"minus_1_sd\";s:3:\"5.5\";s:6:\"median\";s:3:\"6.0\";s:9:\"plus_1_sd\";s:3:\"6.6\";s:9:\"plus_2_sd\";s:3:\"7.2\";s:9:\"plus_3_sd\";s:3:\"7.9\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:8;O:21:\"App\\Models\\MasterBbtb\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:11:\"master_bbtb\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:9;s:13:\"jenis_kelamin\";s:1:\"L\";s:15:\"tinggi_badan_cm\";s:4:\"65.0\";s:10:\"minus_3_sd\";s:3:\"5.9\";s:10:\"minus_2_sd\";s:3:\"6.3\";s:10:\"minus_1_sd\";s:3:\"6.9\";s:6:\"median\";s:3:\"7.5\";s:9:\"plus_1_sd\";s:3:\"8.2\";s:9:\"plus_2_sd\";s:3:\"8.9\";s:9:\"plus_3_sd\";s:3:\"9.8\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:9;s:13:\"jenis_kelamin\";s:1:\"L\";s:15:\"tinggi_badan_cm\";s:4:\"65.0\";s:10:\"minus_3_sd\";s:3:\"5.9\";s:10:\"minus_2_sd\";s:3:\"6.3\";s:10:\"minus_1_sd\";s:3:\"6.9\";s:6:\"median\";s:3:\"7.5\";s:9:\"plus_1_sd\";s:3:\"8.2\";s:9:\"plus_2_sd\";s:3:\"8.9\";s:9:\"plus_3_sd\";s:3:\"9.8\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:9;O:21:\"App\\Models\\MasterBbtb\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:11:\"master_bbtb\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:10;s:13:\"jenis_kelamin\";s:1:\"L\";s:15:\"tinggi_badan_cm\";s:4:\"70.0\";s:10:\"minus_3_sd\";s:3:\"7.0\";s:10:\"minus_2_sd\";s:3:\"7.6\";s:10:\"minus_1_sd\";s:3:\"8.3\";s:6:\"median\";s:3:\"9.0\";s:9:\"plus_1_sd\";s:3:\"9.8\";s:9:\"plus_2_sd\";s:4:\"10.7\";s:9:\"plus_3_sd\";s:4:\"11.7\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:10;s:13:\"jenis_kelamin\";s:1:\"L\";s:15:\"tinggi_badan_cm\";s:4:\"70.0\";s:10:\"minus_3_sd\";s:3:\"7.0\";s:10:\"minus_2_sd\";s:3:\"7.6\";s:10:\"minus_1_sd\";s:3:\"8.3\";s:6:\"median\";s:3:\"9.0\";s:9:\"plus_1_sd\";s:3:\"9.8\";s:9:\"plus_2_sd\";s:4:\"10.7\";s:9:\"plus_3_sd\";s:4:\"11.7\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:10;O:21:\"App\\Models\\MasterBbtb\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:11:\"master_bbtb\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:11;s:13:\"jenis_kelamin\";s:1:\"P\";s:15:\"tinggi_badan_cm\";s:4:\"45.0\";s:10:\"minus_3_sd\";s:3:\"1.9\";s:10:\"minus_2_sd\";s:3:\"2.0\";s:10:\"minus_1_sd\";s:3:\"2.2\";s:6:\"median\";s:3:\"2.5\";s:9:\"plus_1_sd\";s:3:\"2.7\";s:9:\"plus_2_sd\";s:3:\"3.0\";s:9:\"plus_3_sd\";s:3:\"3.3\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:11;s:13:\"jenis_kelamin\";s:1:\"P\";s:15:\"tinggi_badan_cm\";s:4:\"45.0\";s:10:\"minus_3_sd\";s:3:\"1.9\";s:10:\"minus_2_sd\";s:3:\"2.0\";s:10:\"minus_1_sd\";s:3:\"2.2\";s:6:\"median\";s:3:\"2.5\";s:9:\"plus_1_sd\";s:3:\"2.7\";s:9:\"plus_2_sd\";s:3:\"3.0\";s:9:\"plus_3_sd\";s:3:\"3.3\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:11;O:21:\"App\\Models\\MasterBbtb\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:11:\"master_bbtb\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:12;s:13:\"jenis_kelamin\";s:1:\"P\";s:15:\"tinggi_badan_cm\";s:4:\"46.0\";s:10:\"minus_3_sd\";s:3:\"2.0\";s:10:\"minus_2_sd\";s:3:\"2.2\";s:10:\"minus_1_sd\";s:3:\"2.4\";s:6:\"median\";s:3:\"2.6\";s:9:\"plus_1_sd\";s:3:\"2.9\";s:9:\"plus_2_sd\";s:3:\"3.2\";s:9:\"plus_3_sd\";s:3:\"3.5\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:12;s:13:\"jenis_kelamin\";s:1:\"P\";s:15:\"tinggi_badan_cm\";s:4:\"46.0\";s:10:\"minus_3_sd\";s:3:\"2.0\";s:10:\"minus_2_sd\";s:3:\"2.2\";s:10:\"minus_1_sd\";s:3:\"2.4\";s:6:\"median\";s:3:\"2.6\";s:9:\"plus_1_sd\";s:3:\"2.9\";s:9:\"plus_2_sd\";s:3:\"3.2\";s:9:\"plus_3_sd\";s:3:\"3.5\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:12;O:21:\"App\\Models\\MasterBbtb\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:11:\"master_bbtb\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:13;s:13:\"jenis_kelamin\";s:1:\"P\";s:15:\"tinggi_badan_cm\";s:4:\"47.0\";s:10:\"minus_3_sd\";s:3:\"2.2\";s:10:\"minus_2_sd\";s:3:\"2.4\";s:10:\"minus_1_sd\";s:3:\"2.6\";s:6:\"median\";s:3:\"2.8\";s:9:\"plus_1_sd\";s:3:\"3.1\";s:9:\"plus_2_sd\";s:3:\"3.4\";s:9:\"plus_3_sd\";s:3:\"3.7\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:13;s:13:\"jenis_kelamin\";s:1:\"P\";s:15:\"tinggi_badan_cm\";s:4:\"47.0\";s:10:\"minus_3_sd\";s:3:\"2.2\";s:10:\"minus_2_sd\";s:3:\"2.4\";s:10:\"minus_1_sd\";s:3:\"2.6\";s:6:\"median\";s:3:\"2.8\";s:9:\"plus_1_sd\";s:3:\"3.1\";s:9:\"plus_2_sd\";s:3:\"3.4\";s:9:\"plus_3_sd\";s:3:\"3.7\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:13;O:21:\"App\\Models\\MasterBbtb\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:11:\"master_bbtb\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:14;s:13:\"jenis_kelamin\";s:1:\"P\";s:15:\"tinggi_badan_cm\";s:4:\"48.0\";s:10:\"minus_3_sd\";s:3:\"2.3\";s:10:\"minus_2_sd\";s:3:\"2.5\";s:10:\"minus_1_sd\";s:3:\"2.7\";s:6:\"median\";s:3:\"3.0\";s:9:\"plus_1_sd\";s:3:\"3.3\";s:9:\"plus_2_sd\";s:3:\"3.6\";s:9:\"plus_3_sd\";s:3:\"4.0\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:14;s:13:\"jenis_kelamin\";s:1:\"P\";s:15:\"tinggi_badan_cm\";s:4:\"48.0\";s:10:\"minus_3_sd\";s:3:\"2.3\";s:10:\"minus_2_sd\";s:3:\"2.5\";s:10:\"minus_1_sd\";s:3:\"2.7\";s:6:\"median\";s:3:\"3.0\";s:9:\"plus_1_sd\";s:3:\"3.3\";s:9:\"plus_2_sd\";s:3:\"3.6\";s:9:\"plus_3_sd\";s:3:\"4.0\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:14;O:21:\"App\\Models\\MasterBbtb\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:11:\"master_bbtb\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:15;s:13:\"jenis_kelamin\";s:1:\"P\";s:15:\"tinggi_badan_cm\";s:4:\"49.0\";s:10:\"minus_3_sd\";s:3:\"2.5\";s:10:\"minus_2_sd\";s:3:\"2.7\";s:10:\"minus_1_sd\";s:3:\"2.9\";s:6:\"median\";s:3:\"3.2\";s:9:\"plus_1_sd\";s:3:\"3.5\";s:9:\"plus_2_sd\";s:3:\"3.8\";s:9:\"plus_3_sd\";s:3:\"4.2\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:15;s:13:\"jenis_kelamin\";s:1:\"P\";s:15:\"tinggi_badan_cm\";s:4:\"49.0\";s:10:\"minus_3_sd\";s:3:\"2.5\";s:10:\"minus_2_sd\";s:3:\"2.7\";s:10:\"minus_1_sd\";s:3:\"2.9\";s:6:\"median\";s:3:\"3.2\";s:9:\"plus_1_sd\";s:3:\"3.5\";s:9:\"plus_2_sd\";s:3:\"3.8\";s:9:\"plus_3_sd\";s:3:\"4.2\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:15;O:21:\"App\\Models\\MasterBbtb\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:11:\"master_bbtb\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:16;s:13:\"jenis_kelamin\";s:1:\"P\";s:15:\"tinggi_badan_cm\";s:4:\"50.0\";s:10:\"minus_3_sd\";s:3:\"2.6\";s:10:\"minus_2_sd\";s:3:\"2.8\";s:10:\"minus_1_sd\";s:3:\"3.1\";s:6:\"median\";s:3:\"3.4\";s:9:\"plus_1_sd\";s:3:\"3.7\";s:9:\"plus_2_sd\";s:3:\"4.1\";s:9:\"plus_3_sd\";s:3:\"4.5\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:16;s:13:\"jenis_kelamin\";s:1:\"P\";s:15:\"tinggi_badan_cm\";s:4:\"50.0\";s:10:\"minus_3_sd\";s:3:\"2.6\";s:10:\"minus_2_sd\";s:3:\"2.8\";s:10:\"minus_1_sd\";s:3:\"3.1\";s:6:\"median\";s:3:\"3.4\";s:9:\"plus_1_sd\";s:3:\"3.7\";s:9:\"plus_2_sd\";s:3:\"4.1\";s:9:\"plus_3_sd\";s:3:\"4.5\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:16;O:21:\"App\\Models\\MasterBbtb\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:11:\"master_bbtb\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:17;s:13:\"jenis_kelamin\";s:1:\"P\";s:15:\"tinggi_badan_cm\";s:4:\"55.0\";s:10:\"minus_3_sd\";s:3:\"3.5\";s:10:\"minus_2_sd\";s:3:\"3.8\";s:10:\"minus_1_sd\";s:3:\"4.2\";s:6:\"median\";s:3:\"4.5\";s:9:\"plus_1_sd\";s:3:\"5.0\";s:9:\"plus_2_sd\";s:3:\"5.5\";s:9:\"plus_3_sd\";s:3:\"6.1\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:17;s:13:\"jenis_kelamin\";s:1:\"P\";s:15:\"tinggi_badan_cm\";s:4:\"55.0\";s:10:\"minus_3_sd\";s:3:\"3.5\";s:10:\"minus_2_sd\";s:3:\"3.8\";s:10:\"minus_1_sd\";s:3:\"4.2\";s:6:\"median\";s:3:\"4.5\";s:9:\"plus_1_sd\";s:3:\"5.0\";s:9:\"plus_2_sd\";s:3:\"5.5\";s:9:\"plus_3_sd\";s:3:\"6.1\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:17;O:21:\"App\\Models\\MasterBbtb\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:11:\"master_bbtb\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:18;s:13:\"jenis_kelamin\";s:1:\"P\";s:15:\"tinggi_badan_cm\";s:4:\"60.0\";s:10:\"minus_3_sd\";s:3:\"4.5\";s:10:\"minus_2_sd\";s:3:\"4.9\";s:10:\"minus_1_sd\";s:3:\"5.3\";s:6:\"median\";s:3:\"5.8\";s:9:\"plus_1_sd\";s:3:\"6.4\";s:9:\"plus_2_sd\";s:3:\"7.0\";s:9:\"plus_3_sd\";s:3:\"7.7\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:18;s:13:\"jenis_kelamin\";s:1:\"P\";s:15:\"tinggi_badan_cm\";s:4:\"60.0\";s:10:\"minus_3_sd\";s:3:\"4.5\";s:10:\"minus_2_sd\";s:3:\"4.9\";s:10:\"minus_1_sd\";s:3:\"5.3\";s:6:\"median\";s:3:\"5.8\";s:9:\"plus_1_sd\";s:3:\"6.4\";s:9:\"plus_2_sd\";s:3:\"7.0\";s:9:\"plus_3_sd\";s:3:\"7.7\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:18;O:21:\"App\\Models\\MasterBbtb\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:11:\"master_bbtb\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:19;s:13:\"jenis_kelamin\";s:1:\"P\";s:15:\"tinggi_badan_cm\";s:4:\"65.0\";s:10:\"minus_3_sd\";s:3:\"5.6\";s:10:\"minus_2_sd\";s:3:\"6.1\";s:10:\"minus_1_sd\";s:3:\"6.6\";s:6:\"median\";s:3:\"7.2\";s:9:\"plus_1_sd\";s:3:\"7.9\";s:9:\"plus_2_sd\";s:3:\"8.7\";s:9:\"plus_3_sd\";s:3:\"9.5\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:19;s:13:\"jenis_kelamin\";s:1:\"P\";s:15:\"tinggi_badan_cm\";s:4:\"65.0\";s:10:\"minus_3_sd\";s:3:\"5.6\";s:10:\"minus_2_sd\";s:3:\"6.1\";s:10:\"minus_1_sd\";s:3:\"6.6\";s:6:\"median\";s:3:\"7.2\";s:9:\"plus_1_sd\";s:3:\"7.9\";s:9:\"plus_2_sd\";s:3:\"8.7\";s:9:\"plus_3_sd\";s:3:\"9.5\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:19;O:21:\"App\\Models\\MasterBbtb\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:11:\"master_bbtb\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:20;s:13:\"jenis_kelamin\";s:1:\"P\";s:15:\"tinggi_badan_cm\";s:4:\"70.0\";s:10:\"minus_3_sd\";s:3:\"6.7\";s:10:\"minus_2_sd\";s:3:\"7.2\";s:10:\"minus_1_sd\";s:3:\"7.9\";s:6:\"median\";s:3:\"8.6\";s:9:\"plus_1_sd\";s:3:\"9.4\";s:9:\"plus_2_sd\";s:4:\"10.3\";s:9:\"plus_3_sd\";s:4:\"11.3\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:20;s:13:\"jenis_kelamin\";s:1:\"P\";s:15:\"tinggi_badan_cm\";s:4:\"70.0\";s:10:\"minus_3_sd\";s:3:\"6.7\";s:10:\"minus_2_sd\";s:3:\"7.2\";s:10:\"minus_1_sd\";s:3:\"7.9\";s:6:\"median\";s:3:\"8.6\";s:9:\"plus_1_sd\";s:3:\"9.4\";s:9:\"plus_2_sd\";s:4:\"10.3\";s:9:\"plus_3_sd\";s:4:\"11.3\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 2095908116);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-master_bbu_all', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:26:{i:0;O:20:\"App\\Models\\MasterBbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_bbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:1;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:0;s:10:\"minus_3_sd\";s:3:\"2.1\";s:10:\"minus_2_sd\";s:3:\"2.5\";s:10:\"minus_1_sd\";s:3:\"2.9\";s:6:\"median\";s:3:\"3.3\";s:9:\"plus_1_sd\";s:3:\"3.9\";s:9:\"plus_2_sd\";s:3:\"4.4\";s:9:\"plus_3_sd\";s:3:\"5.0\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:1;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:0;s:10:\"minus_3_sd\";s:3:\"2.1\";s:10:\"minus_2_sd\";s:3:\"2.5\";s:10:\"minus_1_sd\";s:3:\"2.9\";s:6:\"median\";s:3:\"3.3\";s:9:\"plus_1_sd\";s:3:\"3.9\";s:9:\"plus_2_sd\";s:3:\"4.4\";s:9:\"plus_3_sd\";s:3:\"5.0\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:20:\"App\\Models\\MasterBbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_bbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:2;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:1;s:10:\"minus_3_sd\";s:3:\"2.9\";s:10:\"minus_2_sd\";s:3:\"3.4\";s:10:\"minus_1_sd\";s:3:\"3.9\";s:6:\"median\";s:3:\"4.5\";s:9:\"plus_1_sd\";s:3:\"5.1\";s:9:\"plus_2_sd\";s:3:\"5.8\";s:9:\"plus_3_sd\";s:3:\"6.6\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:2;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:1;s:10:\"minus_3_sd\";s:3:\"2.9\";s:10:\"minus_2_sd\";s:3:\"3.4\";s:10:\"minus_1_sd\";s:3:\"3.9\";s:6:\"median\";s:3:\"4.5\";s:9:\"plus_1_sd\";s:3:\"5.1\";s:9:\"plus_2_sd\";s:3:\"5.8\";s:9:\"plus_3_sd\";s:3:\"6.6\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:20:\"App\\Models\\MasterBbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_bbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:3;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:2;s:10:\"minus_3_sd\";s:3:\"3.8\";s:10:\"minus_2_sd\";s:3:\"4.3\";s:10:\"minus_1_sd\";s:3:\"4.9\";s:6:\"median\";s:3:\"5.6\";s:9:\"plus_1_sd\";s:3:\"6.3\";s:9:\"plus_2_sd\";s:3:\"7.1\";s:9:\"plus_3_sd\";s:3:\"8.0\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:3;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:2;s:10:\"minus_3_sd\";s:3:\"3.8\";s:10:\"minus_2_sd\";s:3:\"4.3\";s:10:\"minus_1_sd\";s:3:\"4.9\";s:6:\"median\";s:3:\"5.6\";s:9:\"plus_1_sd\";s:3:\"6.3\";s:9:\"plus_2_sd\";s:3:\"7.1\";s:9:\"plus_3_sd\";s:3:\"8.0\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:20:\"App\\Models\\MasterBbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_bbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:4;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:3;s:10:\"minus_3_sd\";s:3:\"4.4\";s:10:\"minus_2_sd\";s:3:\"5.0\";s:10:\"minus_1_sd\";s:3:\"5.7\";s:6:\"median\";s:3:\"6.4\";s:9:\"plus_1_sd\";s:3:\"7.2\";s:9:\"plus_2_sd\";s:3:\"8.0\";s:9:\"plus_3_sd\";s:3:\"9.0\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:4;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:3;s:10:\"minus_3_sd\";s:3:\"4.4\";s:10:\"minus_2_sd\";s:3:\"5.0\";s:10:\"minus_1_sd\";s:3:\"5.7\";s:6:\"median\";s:3:\"6.4\";s:9:\"plus_1_sd\";s:3:\"7.2\";s:9:\"plus_2_sd\";s:3:\"8.0\";s:9:\"plus_3_sd\";s:3:\"9.0\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:4;O:20:\"App\\Models\\MasterBbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_bbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:5;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:4;s:10:\"minus_3_sd\";s:3:\"4.9\";s:10:\"minus_2_sd\";s:3:\"5.6\";s:10:\"minus_1_sd\";s:3:\"6.3\";s:6:\"median\";s:3:\"7.0\";s:9:\"plus_1_sd\";s:3:\"7.8\";s:9:\"plus_2_sd\";s:3:\"8.7\";s:9:\"plus_3_sd\";s:3:\"9.7\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:5;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:4;s:10:\"minus_3_sd\";s:3:\"4.9\";s:10:\"minus_2_sd\";s:3:\"5.6\";s:10:\"minus_1_sd\";s:3:\"6.3\";s:6:\"median\";s:3:\"7.0\";s:9:\"plus_1_sd\";s:3:\"7.8\";s:9:\"plus_2_sd\";s:3:\"8.7\";s:9:\"plus_3_sd\";s:3:\"9.7\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:5;O:20:\"App\\Models\\MasterBbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_bbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:6;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:5;s:10:\"minus_3_sd\";s:3:\"5.3\";s:10:\"minus_2_sd\";s:3:\"6.0\";s:10:\"minus_1_sd\";s:3:\"6.7\";s:6:\"median\";s:3:\"7.5\";s:9:\"plus_1_sd\";s:3:\"8.4\";s:9:\"plus_2_sd\";s:3:\"9.3\";s:9:\"plus_3_sd\";s:4:\"10.4\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:6;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:5;s:10:\"minus_3_sd\";s:3:\"5.3\";s:10:\"minus_2_sd\";s:3:\"6.0\";s:10:\"minus_1_sd\";s:3:\"6.7\";s:6:\"median\";s:3:\"7.5\";s:9:\"plus_1_sd\";s:3:\"8.4\";s:9:\"plus_2_sd\";s:3:\"9.3\";s:9:\"plus_3_sd\";s:4:\"10.4\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:6;O:20:\"App\\Models\\MasterBbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_bbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:7;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:6;s:10:\"minus_3_sd\";s:3:\"5.7\";s:10:\"minus_2_sd\";s:3:\"6.4\";s:10:\"minus_1_sd\";s:3:\"7.1\";s:6:\"median\";s:3:\"7.9\";s:9:\"plus_1_sd\";s:3:\"8.8\";s:9:\"plus_2_sd\";s:3:\"9.8\";s:9:\"plus_3_sd\";s:4:\"10.9\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:7;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:6;s:10:\"minus_3_sd\";s:3:\"5.7\";s:10:\"minus_2_sd\";s:3:\"6.4\";s:10:\"minus_1_sd\";s:3:\"7.1\";s:6:\"median\";s:3:\"7.9\";s:9:\"plus_1_sd\";s:3:\"8.8\";s:9:\"plus_2_sd\";s:3:\"9.8\";s:9:\"plus_3_sd\";s:4:\"10.9\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:7;O:20:\"App\\Models\\MasterBbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_bbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:8;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:7;s:10:\"minus_3_sd\";s:3:\"5.9\";s:10:\"minus_2_sd\";s:3:\"6.7\";s:10:\"minus_1_sd\";s:3:\"7.4\";s:6:\"median\";s:3:\"8.3\";s:9:\"plus_1_sd\";s:3:\"9.2\";s:9:\"plus_2_sd\";s:4:\"10.3\";s:9:\"plus_3_sd\";s:4:\"11.4\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:8;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:7;s:10:\"minus_3_sd\";s:3:\"5.9\";s:10:\"minus_2_sd\";s:3:\"6.7\";s:10:\"minus_1_sd\";s:3:\"7.4\";s:6:\"median\";s:3:\"8.3\";s:9:\"plus_1_sd\";s:3:\"9.2\";s:9:\"plus_2_sd\";s:4:\"10.3\";s:9:\"plus_3_sd\";s:4:\"11.4\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:8;O:20:\"App\\Models\\MasterBbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_bbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:9;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:8;s:10:\"minus_3_sd\";s:3:\"6.2\";s:10:\"minus_2_sd\";s:3:\"6.9\";s:10:\"minus_1_sd\";s:3:\"7.7\";s:6:\"median\";s:3:\"8.6\";s:9:\"plus_1_sd\";s:3:\"9.6\";s:9:\"plus_2_sd\";s:4:\"10.7\";s:9:\"plus_3_sd\";s:4:\"11.9\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:9;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:8;s:10:\"minus_3_sd\";s:3:\"6.2\";s:10:\"minus_2_sd\";s:3:\"6.9\";s:10:\"minus_1_sd\";s:3:\"7.7\";s:6:\"median\";s:3:\"8.6\";s:9:\"plus_1_sd\";s:3:\"9.6\";s:9:\"plus_2_sd\";s:4:\"10.7\";s:9:\"plus_3_sd\";s:4:\"11.9\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:9;O:20:\"App\\Models\\MasterBbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_bbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:10;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:9;s:10:\"minus_3_sd\";s:3:\"6.4\";s:10:\"minus_2_sd\";s:3:\"7.1\";s:10:\"minus_1_sd\";s:3:\"8.0\";s:6:\"median\";s:3:\"8.9\";s:9:\"plus_1_sd\";s:3:\"9.9\";s:9:\"plus_2_sd\";s:4:\"11.0\";s:9:\"plus_3_sd\";s:4:\"12.3\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:10;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:9;s:10:\"minus_3_sd\";s:3:\"6.4\";s:10:\"minus_2_sd\";s:3:\"7.1\";s:10:\"minus_1_sd\";s:3:\"8.0\";s:6:\"median\";s:3:\"8.9\";s:9:\"plus_1_sd\";s:3:\"9.9\";s:9:\"plus_2_sd\";s:4:\"11.0\";s:9:\"plus_3_sd\";s:4:\"12.3\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:10;O:20:\"App\\Models\\MasterBbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_bbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:11;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:10;s:10:\"minus_3_sd\";s:3:\"6.6\";s:10:\"minus_2_sd\";s:3:\"7.4\";s:10:\"minus_1_sd\";s:3:\"8.2\";s:6:\"median\";s:3:\"9.2\";s:9:\"plus_1_sd\";s:4:\"10.2\";s:9:\"plus_2_sd\";s:4:\"11.4\";s:9:\"plus_3_sd\";s:4:\"12.7\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:11;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:10;s:10:\"minus_3_sd\";s:3:\"6.6\";s:10:\"minus_2_sd\";s:3:\"7.4\";s:10:\"minus_1_sd\";s:3:\"8.2\";s:6:\"median\";s:3:\"9.2\";s:9:\"plus_1_sd\";s:4:\"10.2\";s:9:\"plus_2_sd\";s:4:\"11.4\";s:9:\"plus_3_sd\";s:4:\"12.7\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:11;O:20:\"App\\Models\\MasterBbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_bbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:12;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:11;s:10:\"minus_3_sd\";s:3:\"6.8\";s:10:\"minus_2_sd\";s:3:\"7.6\";s:10:\"minus_1_sd\";s:3:\"8.4\";s:6:\"median\";s:3:\"9.4\";s:9:\"plus_1_sd\";s:4:\"10.5\";s:9:\"plus_2_sd\";s:4:\"11.7\";s:9:\"plus_3_sd\";s:4:\"13.0\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:12;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:11;s:10:\"minus_3_sd\";s:3:\"6.8\";s:10:\"minus_2_sd\";s:3:\"7.6\";s:10:\"minus_1_sd\";s:3:\"8.4\";s:6:\"median\";s:3:\"9.4\";s:9:\"plus_1_sd\";s:4:\"10.5\";s:9:\"plus_2_sd\";s:4:\"11.7\";s:9:\"plus_3_sd\";s:4:\"13.0\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:12;O:20:\"App\\Models\\MasterBbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_bbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:13;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:12;s:10:\"minus_3_sd\";s:3:\"6.9\";s:10:\"minus_2_sd\";s:3:\"7.7\";s:10:\"minus_1_sd\";s:3:\"8.6\";s:6:\"median\";s:3:\"9.6\";s:9:\"plus_1_sd\";s:4:\"10.8\";s:9:\"plus_2_sd\";s:4:\"12.0\";s:9:\"plus_3_sd\";s:4:\"13.3\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:13;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:12;s:10:\"minus_3_sd\";s:3:\"6.9\";s:10:\"minus_2_sd\";s:3:\"7.7\";s:10:\"minus_1_sd\";s:3:\"8.6\";s:6:\"median\";s:3:\"9.6\";s:9:\"plus_1_sd\";s:4:\"10.8\";s:9:\"plus_2_sd\";s:4:\"12.0\";s:9:\"plus_3_sd\";s:4:\"13.3\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:13;O:20:\"App\\Models\\MasterBbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_bbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:14;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:0;s:10:\"minus_3_sd\";s:3:\"2.0\";s:10:\"minus_2_sd\";s:3:\"2.4\";s:10:\"minus_1_sd\";s:3:\"2.8\";s:6:\"median\";s:3:\"3.2\";s:9:\"plus_1_sd\";s:3:\"3.7\";s:9:\"plus_2_sd\";s:3:\"4.2\";s:9:\"plus_3_sd\";s:3:\"4.8\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:14;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:0;s:10:\"minus_3_sd\";s:3:\"2.0\";s:10:\"minus_2_sd\";s:3:\"2.4\";s:10:\"minus_1_sd\";s:3:\"2.8\";s:6:\"median\";s:3:\"3.2\";s:9:\"plus_1_sd\";s:3:\"3.7\";s:9:\"plus_2_sd\";s:3:\"4.2\";s:9:\"plus_3_sd\";s:3:\"4.8\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:14;O:20:\"App\\Models\\MasterBbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_bbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:15;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:1;s:10:\"minus_3_sd\";s:3:\"2.7\";s:10:\"minus_2_sd\";s:3:\"3.2\";s:10:\"minus_1_sd\";s:3:\"3.6\";s:6:\"median\";s:3:\"4.2\";s:9:\"plus_1_sd\";s:3:\"4.8\";s:9:\"plus_2_sd\";s:3:\"5.5\";s:9:\"plus_3_sd\";s:3:\"6.2\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:15;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:1;s:10:\"minus_3_sd\";s:3:\"2.7\";s:10:\"minus_2_sd\";s:3:\"3.2\";s:10:\"minus_1_sd\";s:3:\"3.6\";s:6:\"median\";s:3:\"4.2\";s:9:\"plus_1_sd\";s:3:\"4.8\";s:9:\"plus_2_sd\";s:3:\"5.5\";s:9:\"plus_3_sd\";s:3:\"6.2\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:15;O:20:\"App\\Models\\MasterBbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_bbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:16;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:2;s:10:\"minus_3_sd\";s:3:\"3.4\";s:10:\"minus_2_sd\";s:3:\"3.9\";s:10:\"minus_1_sd\";s:3:\"4.5\";s:6:\"median\";s:3:\"5.1\";s:9:\"plus_1_sd\";s:3:\"5.8\";s:9:\"plus_2_sd\";s:3:\"6.6\";s:9:\"plus_3_sd\";s:3:\"7.5\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:16;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:2;s:10:\"minus_3_sd\";s:3:\"3.4\";s:10:\"minus_2_sd\";s:3:\"3.9\";s:10:\"minus_1_sd\";s:3:\"4.5\";s:6:\"median\";s:3:\"5.1\";s:9:\"plus_1_sd\";s:3:\"5.8\";s:9:\"plus_2_sd\";s:3:\"6.6\";s:9:\"plus_3_sd\";s:3:\"7.5\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:16;O:20:\"App\\Models\\MasterBbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_bbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:17;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:3;s:10:\"minus_3_sd\";s:3:\"4.0\";s:10:\"minus_2_sd\";s:3:\"4.5\";s:10:\"minus_1_sd\";s:3:\"5.1\";s:6:\"median\";s:3:\"5.8\";s:9:\"plus_1_sd\";s:3:\"6.6\";s:9:\"plus_2_sd\";s:3:\"7.5\";s:9:\"plus_3_sd\";s:3:\"8.5\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:17;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:3;s:10:\"minus_3_sd\";s:3:\"4.0\";s:10:\"minus_2_sd\";s:3:\"4.5\";s:10:\"minus_1_sd\";s:3:\"5.1\";s:6:\"median\";s:3:\"5.8\";s:9:\"plus_1_sd\";s:3:\"6.6\";s:9:\"plus_2_sd\";s:3:\"7.5\";s:9:\"plus_3_sd\";s:3:\"8.5\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:17;O:20:\"App\\Models\\MasterBbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_bbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:18;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:4;s:10:\"minus_3_sd\";s:3:\"4.4\";s:10:\"minus_2_sd\";s:3:\"5.0\";s:10:\"minus_1_sd\";s:3:\"5.7\";s:6:\"median\";s:3:\"6.4\";s:9:\"plus_1_sd\";s:3:\"7.3\";s:9:\"plus_2_sd\";s:3:\"8.2\";s:9:\"plus_3_sd\";s:3:\"9.3\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:18;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:4;s:10:\"minus_3_sd\";s:3:\"4.4\";s:10:\"minus_2_sd\";s:3:\"5.0\";s:10:\"minus_1_sd\";s:3:\"5.7\";s:6:\"median\";s:3:\"6.4\";s:9:\"plus_1_sd\";s:3:\"7.3\";s:9:\"plus_2_sd\";s:3:\"8.2\";s:9:\"plus_3_sd\";s:3:\"9.3\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:18;O:20:\"App\\Models\\MasterBbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_bbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:19;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:5;s:10:\"minus_3_sd\";s:3:\"4.8\";s:10:\"minus_2_sd\";s:3:\"5.4\";s:10:\"minus_1_sd\";s:3:\"6.1\";s:6:\"median\";s:3:\"6.9\";s:9:\"plus_1_sd\";s:3:\"7.8\";s:9:\"plus_2_sd\";s:3:\"8.8\";s:9:\"plus_3_sd\";s:4:\"10.0\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:19;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:5;s:10:\"minus_3_sd\";s:3:\"4.8\";s:10:\"minus_2_sd\";s:3:\"5.4\";s:10:\"minus_1_sd\";s:3:\"6.1\";s:6:\"median\";s:3:\"6.9\";s:9:\"plus_1_sd\";s:3:\"7.8\";s:9:\"plus_2_sd\";s:3:\"8.8\";s:9:\"plus_3_sd\";s:4:\"10.0\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:19;O:20:\"App\\Models\\MasterBbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_bbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:20;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:6;s:10:\"minus_3_sd\";s:3:\"5.1\";s:10:\"minus_2_sd\";s:3:\"5.7\";s:10:\"minus_1_sd\";s:3:\"6.5\";s:6:\"median\";s:3:\"7.3\";s:9:\"plus_1_sd\";s:3:\"8.2\";s:9:\"plus_2_sd\";s:3:\"9.3\";s:9:\"plus_3_sd\";s:4:\"10.5\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:20;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:6;s:10:\"minus_3_sd\";s:3:\"5.1\";s:10:\"minus_2_sd\";s:3:\"5.7\";s:10:\"minus_1_sd\";s:3:\"6.5\";s:6:\"median\";s:3:\"7.3\";s:9:\"plus_1_sd\";s:3:\"8.2\";s:9:\"plus_2_sd\";s:3:\"9.3\";s:9:\"plus_3_sd\";s:4:\"10.5\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:20;O:20:\"App\\Models\\MasterBbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_bbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:21;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:7;s:10:\"minus_3_sd\";s:3:\"5.3\";s:10:\"minus_2_sd\";s:3:\"6.0\";s:10:\"minus_1_sd\";s:3:\"6.8\";s:6:\"median\";s:3:\"7.6\";s:9:\"plus_1_sd\";s:3:\"8.6\";s:9:\"plus_2_sd\";s:3:\"9.8\";s:9:\"plus_3_sd\";s:4:\"11.1\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:21;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:7;s:10:\"minus_3_sd\";s:3:\"5.3\";s:10:\"minus_2_sd\";s:3:\"6.0\";s:10:\"minus_1_sd\";s:3:\"6.8\";s:6:\"median\";s:3:\"7.6\";s:9:\"plus_1_sd\";s:3:\"8.6\";s:9:\"plus_2_sd\";s:3:\"9.8\";s:9:\"plus_3_sd\";s:4:\"11.1\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:21;O:20:\"App\\Models\\MasterBbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_bbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:22;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:8;s:10:\"minus_3_sd\";s:3:\"5.6\";s:10:\"minus_2_sd\";s:3:\"6.3\";s:10:\"minus_1_sd\";s:3:\"7.0\";s:6:\"median\";s:3:\"7.9\";s:9:\"plus_1_sd\";s:3:\"9.0\";s:9:\"plus_2_sd\";s:4:\"10.2\";s:9:\"plus_3_sd\";s:4:\"11.6\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:22;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:8;s:10:\"minus_3_sd\";s:3:\"5.6\";s:10:\"minus_2_sd\";s:3:\"6.3\";s:10:\"minus_1_sd\";s:3:\"7.0\";s:6:\"median\";s:3:\"7.9\";s:9:\"plus_1_sd\";s:3:\"9.0\";s:9:\"plus_2_sd\";s:4:\"10.2\";s:9:\"plus_3_sd\";s:4:\"11.6\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:22;O:20:\"App\\Models\\MasterBbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_bbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:23;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:9;s:10:\"minus_3_sd\";s:3:\"5.8\";s:10:\"minus_2_sd\";s:3:\"6.5\";s:10:\"minus_1_sd\";s:3:\"7.3\";s:6:\"median\";s:3:\"8.2\";s:9:\"plus_1_sd\";s:3:\"9.3\";s:9:\"plus_2_sd\";s:4:\"10.6\";s:9:\"plus_3_sd\";s:4:\"12.1\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:23;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:9;s:10:\"minus_3_sd\";s:3:\"5.8\";s:10:\"minus_2_sd\";s:3:\"6.5\";s:10:\"minus_1_sd\";s:3:\"7.3\";s:6:\"median\";s:3:\"8.2\";s:9:\"plus_1_sd\";s:3:\"9.3\";s:9:\"plus_2_sd\";s:4:\"10.6\";s:9:\"plus_3_sd\";s:4:\"12.1\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:23;O:20:\"App\\Models\\MasterBbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_bbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:24;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:10;s:10:\"minus_3_sd\";s:3:\"5.9\";s:10:\"minus_2_sd\";s:3:\"6.7\";s:10:\"minus_1_sd\";s:3:\"7.5\";s:6:\"median\";s:3:\"8.5\";s:9:\"plus_1_sd\";s:3:\"9.6\";s:9:\"plus_2_sd\";s:4:\"10.9\";s:9:\"plus_3_sd\";s:4:\"12.4\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:24;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:10;s:10:\"minus_3_sd\";s:3:\"5.9\";s:10:\"minus_2_sd\";s:3:\"6.7\";s:10:\"minus_1_sd\";s:3:\"7.5\";s:6:\"median\";s:3:\"8.5\";s:9:\"plus_1_sd\";s:3:\"9.6\";s:9:\"plus_2_sd\";s:4:\"10.9\";s:9:\"plus_3_sd\";s:4:\"12.4\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:24;O:20:\"App\\Models\\MasterBbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_bbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:25;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:11;s:10:\"minus_3_sd\";s:3:\"6.1\";s:10:\"minus_2_sd\";s:3:\"6.9\";s:10:\"minus_1_sd\";s:3:\"7.7\";s:6:\"median\";s:3:\"8.7\";s:9:\"plus_1_sd\";s:3:\"9.9\";s:9:\"plus_2_sd\";s:4:\"11.2\";s:9:\"plus_3_sd\";s:4:\"12.8\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:25;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:11;s:10:\"minus_3_sd\";s:3:\"6.1\";s:10:\"minus_2_sd\";s:3:\"6.9\";s:10:\"minus_1_sd\";s:3:\"7.7\";s:6:\"median\";s:3:\"8.7\";s:9:\"plus_1_sd\";s:3:\"9.9\";s:9:\"plus_2_sd\";s:4:\"11.2\";s:9:\"plus_3_sd\";s:4:\"12.8\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:25;O:20:\"App\\Models\\MasterBbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_bbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:26;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:12;s:10:\"minus_3_sd\";s:3:\"6.3\";s:10:\"minus_2_sd\";s:3:\"7.0\";s:10:\"minus_1_sd\";s:3:\"7.9\";s:6:\"median\";s:3:\"8.9\";s:9:\"plus_1_sd\";s:4:\"10.1\";s:9:\"plus_2_sd\";s:4:\"11.5\";s:9:\"plus_3_sd\";s:4:\"13.1\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:26;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:12;s:10:\"minus_3_sd\";s:3:\"6.3\";s:10:\"minus_2_sd\";s:3:\"7.0\";s:10:\"minus_1_sd\";s:3:\"7.9\";s:6:\"median\";s:3:\"8.9\";s:9:\"plus_1_sd\";s:4:\"10.1\";s:9:\"plus_2_sd\";s:4:\"11.5\";s:9:\"plus_3_sd\";s:4:\"13.1\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 2095908107);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-master_tbu_all', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:26:{i:0;O:20:\"App\\Models\\MasterTbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_tbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:1;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:0;s:10:\"minus_3_sd\";s:4:\"44.2\";s:10:\"minus_2_sd\";s:4:\"46.1\";s:10:\"minus_1_sd\";s:4:\"48.0\";s:6:\"median\";s:4:\"49.9\";s:9:\"plus_1_sd\";s:4:\"51.8\";s:9:\"plus_2_sd\";s:4:\"53.7\";s:9:\"plus_3_sd\";s:4:\"55.6\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:1;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:0;s:10:\"minus_3_sd\";s:4:\"44.2\";s:10:\"minus_2_sd\";s:4:\"46.1\";s:10:\"minus_1_sd\";s:4:\"48.0\";s:6:\"median\";s:4:\"49.9\";s:9:\"plus_1_sd\";s:4:\"51.8\";s:9:\"plus_2_sd\";s:4:\"53.7\";s:9:\"plus_3_sd\";s:4:\"55.6\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:20:\"App\\Models\\MasterTbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_tbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:2;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:1;s:10:\"minus_3_sd\";s:4:\"48.9\";s:10:\"minus_2_sd\";s:4:\"50.8\";s:10:\"minus_1_sd\";s:4:\"52.8\";s:6:\"median\";s:4:\"54.7\";s:9:\"plus_1_sd\";s:4:\"56.7\";s:9:\"plus_2_sd\";s:4:\"58.6\";s:9:\"plus_3_sd\";s:4:\"60.6\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:2;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:1;s:10:\"minus_3_sd\";s:4:\"48.9\";s:10:\"minus_2_sd\";s:4:\"50.8\";s:10:\"minus_1_sd\";s:4:\"52.8\";s:6:\"median\";s:4:\"54.7\";s:9:\"plus_1_sd\";s:4:\"56.7\";s:9:\"plus_2_sd\";s:4:\"58.6\";s:9:\"plus_3_sd\";s:4:\"60.6\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:20:\"App\\Models\\MasterTbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_tbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:3;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:2;s:10:\"minus_3_sd\";s:4:\"52.4\";s:10:\"minus_2_sd\";s:4:\"54.4\";s:10:\"minus_1_sd\";s:4:\"56.4\";s:6:\"median\";s:4:\"58.4\";s:9:\"plus_1_sd\";s:4:\"60.4\";s:9:\"plus_2_sd\";s:4:\"62.4\";s:9:\"plus_3_sd\";s:4:\"64.4\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:3;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:2;s:10:\"minus_3_sd\";s:4:\"52.4\";s:10:\"minus_2_sd\";s:4:\"54.4\";s:10:\"minus_1_sd\";s:4:\"56.4\";s:6:\"median\";s:4:\"58.4\";s:9:\"plus_1_sd\";s:4:\"60.4\";s:9:\"plus_2_sd\";s:4:\"62.4\";s:9:\"plus_3_sd\";s:4:\"64.4\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:20:\"App\\Models\\MasterTbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_tbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:4;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:3;s:10:\"minus_3_sd\";s:4:\"55.3\";s:10:\"minus_2_sd\";s:4:\"57.3\";s:10:\"minus_1_sd\";s:4:\"59.4\";s:6:\"median\";s:4:\"61.4\";s:9:\"plus_1_sd\";s:4:\"63.5\";s:9:\"plus_2_sd\";s:4:\"65.5\";s:9:\"plus_3_sd\";s:4:\"67.6\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:4;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:3;s:10:\"minus_3_sd\";s:4:\"55.3\";s:10:\"minus_2_sd\";s:4:\"57.3\";s:10:\"minus_1_sd\";s:4:\"59.4\";s:6:\"median\";s:4:\"61.4\";s:9:\"plus_1_sd\";s:4:\"63.5\";s:9:\"plus_2_sd\";s:4:\"65.5\";s:9:\"plus_3_sd\";s:4:\"67.6\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:4;O:20:\"App\\Models\\MasterTbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_tbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:5;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:4;s:10:\"minus_3_sd\";s:4:\"57.6\";s:10:\"minus_2_sd\";s:4:\"59.7\";s:10:\"minus_1_sd\";s:4:\"61.8\";s:6:\"median\";s:4:\"63.9\";s:9:\"plus_1_sd\";s:4:\"66.0\";s:9:\"plus_2_sd\";s:4:\"68.0\";s:9:\"plus_3_sd\";s:4:\"70.1\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:5;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:4;s:10:\"minus_3_sd\";s:4:\"57.6\";s:10:\"minus_2_sd\";s:4:\"59.7\";s:10:\"minus_1_sd\";s:4:\"61.8\";s:6:\"median\";s:4:\"63.9\";s:9:\"plus_1_sd\";s:4:\"66.0\";s:9:\"plus_2_sd\";s:4:\"68.0\";s:9:\"plus_3_sd\";s:4:\"70.1\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:5;O:20:\"App\\Models\\MasterTbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_tbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:6;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:5;s:10:\"minus_3_sd\";s:4:\"59.6\";s:10:\"minus_2_sd\";s:4:\"61.7\";s:10:\"minus_1_sd\";s:4:\"63.8\";s:6:\"median\";s:4:\"65.9\";s:9:\"plus_1_sd\";s:4:\"68.0\";s:9:\"plus_2_sd\";s:4:\"70.1\";s:9:\"plus_3_sd\";s:4:\"72.2\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:6;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:5;s:10:\"minus_3_sd\";s:4:\"59.6\";s:10:\"minus_2_sd\";s:4:\"61.7\";s:10:\"minus_1_sd\";s:4:\"63.8\";s:6:\"median\";s:4:\"65.9\";s:9:\"plus_1_sd\";s:4:\"68.0\";s:9:\"plus_2_sd\";s:4:\"70.1\";s:9:\"plus_3_sd\";s:4:\"72.2\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:6;O:20:\"App\\Models\\MasterTbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_tbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:7;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:6;s:10:\"minus_3_sd\";s:4:\"61.2\";s:10:\"minus_2_sd\";s:4:\"63.3\";s:10:\"minus_1_sd\";s:4:\"65.5\";s:6:\"median\";s:4:\"67.6\";s:9:\"plus_1_sd\";s:4:\"69.8\";s:9:\"plus_2_sd\";s:4:\"71.9\";s:9:\"plus_3_sd\";s:4:\"74.0\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:7;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:6;s:10:\"minus_3_sd\";s:4:\"61.2\";s:10:\"minus_2_sd\";s:4:\"63.3\";s:10:\"minus_1_sd\";s:4:\"65.5\";s:6:\"median\";s:4:\"67.6\";s:9:\"plus_1_sd\";s:4:\"69.8\";s:9:\"plus_2_sd\";s:4:\"71.9\";s:9:\"plus_3_sd\";s:4:\"74.0\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:7;O:20:\"App\\Models\\MasterTbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_tbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:8;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:7;s:10:\"minus_3_sd\";s:4:\"62.7\";s:10:\"minus_2_sd\";s:4:\"64.8\";s:10:\"minus_1_sd\";s:4:\"67.0\";s:6:\"median\";s:4:\"69.2\";s:9:\"plus_1_sd\";s:4:\"71.3\";s:9:\"plus_2_sd\";s:4:\"73.5\";s:9:\"plus_3_sd\";s:4:\"75.7\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:8;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:7;s:10:\"minus_3_sd\";s:4:\"62.7\";s:10:\"minus_2_sd\";s:4:\"64.8\";s:10:\"minus_1_sd\";s:4:\"67.0\";s:6:\"median\";s:4:\"69.2\";s:9:\"plus_1_sd\";s:4:\"71.3\";s:9:\"plus_2_sd\";s:4:\"73.5\";s:9:\"plus_3_sd\";s:4:\"75.7\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:8;O:20:\"App\\Models\\MasterTbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_tbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:9;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:8;s:10:\"minus_3_sd\";s:4:\"64.0\";s:10:\"minus_2_sd\";s:4:\"66.2\";s:10:\"minus_1_sd\";s:4:\"68.4\";s:6:\"median\";s:4:\"70.6\";s:9:\"plus_1_sd\";s:4:\"72.8\";s:9:\"plus_2_sd\";s:4:\"75.0\";s:9:\"plus_3_sd\";s:4:\"77.2\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:9;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:8;s:10:\"minus_3_sd\";s:4:\"64.0\";s:10:\"minus_2_sd\";s:4:\"66.2\";s:10:\"minus_1_sd\";s:4:\"68.4\";s:6:\"median\";s:4:\"70.6\";s:9:\"plus_1_sd\";s:4:\"72.8\";s:9:\"plus_2_sd\";s:4:\"75.0\";s:9:\"plus_3_sd\";s:4:\"77.2\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:9;O:20:\"App\\Models\\MasterTbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_tbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:10;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:9;s:10:\"minus_3_sd\";s:4:\"65.2\";s:10:\"minus_2_sd\";s:4:\"67.5\";s:10:\"minus_1_sd\";s:4:\"69.7\";s:6:\"median\";s:4:\"72.0\";s:9:\"plus_1_sd\";s:4:\"74.2\";s:9:\"plus_2_sd\";s:4:\"76.5\";s:9:\"plus_3_sd\";s:4:\"78.7\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:10;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:9;s:10:\"minus_3_sd\";s:4:\"65.2\";s:10:\"minus_2_sd\";s:4:\"67.5\";s:10:\"minus_1_sd\";s:4:\"69.7\";s:6:\"median\";s:4:\"72.0\";s:9:\"plus_1_sd\";s:4:\"74.2\";s:9:\"plus_2_sd\";s:4:\"76.5\";s:9:\"plus_3_sd\";s:4:\"78.7\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:10;O:20:\"App\\Models\\MasterTbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_tbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:11;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:10;s:10:\"minus_3_sd\";s:4:\"66.4\";s:10:\"minus_2_sd\";s:4:\"68.7\";s:10:\"minus_1_sd\";s:4:\"71.0\";s:6:\"median\";s:4:\"73.3\";s:9:\"plus_1_sd\";s:4:\"75.6\";s:9:\"plus_2_sd\";s:4:\"77.9\";s:9:\"plus_3_sd\";s:4:\"80.1\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:11;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:10;s:10:\"minus_3_sd\";s:4:\"66.4\";s:10:\"minus_2_sd\";s:4:\"68.7\";s:10:\"minus_1_sd\";s:4:\"71.0\";s:6:\"median\";s:4:\"73.3\";s:9:\"plus_1_sd\";s:4:\"75.6\";s:9:\"plus_2_sd\";s:4:\"77.9\";s:9:\"plus_3_sd\";s:4:\"80.1\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:11;O:20:\"App\\Models\\MasterTbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_tbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:12;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:11;s:10:\"minus_3_sd\";s:4:\"67.6\";s:10:\"minus_2_sd\";s:4:\"69.9\";s:10:\"minus_1_sd\";s:4:\"72.2\";s:6:\"median\";s:4:\"74.5\";s:9:\"plus_1_sd\";s:4:\"76.9\";s:9:\"plus_2_sd\";s:4:\"79.2\";s:9:\"plus_3_sd\";s:4:\"81.5\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:12;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:11;s:10:\"minus_3_sd\";s:4:\"67.6\";s:10:\"minus_2_sd\";s:4:\"69.9\";s:10:\"minus_1_sd\";s:4:\"72.2\";s:6:\"median\";s:4:\"74.5\";s:9:\"plus_1_sd\";s:4:\"76.9\";s:9:\"plus_2_sd\";s:4:\"79.2\";s:9:\"plus_3_sd\";s:4:\"81.5\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:12;O:20:\"App\\Models\\MasterTbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_tbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:13;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:12;s:10:\"minus_3_sd\";s:4:\"68.6\";s:10:\"minus_2_sd\";s:4:\"71.0\";s:10:\"minus_1_sd\";s:4:\"73.4\";s:6:\"median\";s:4:\"75.7\";s:9:\"plus_1_sd\";s:4:\"78.1\";s:9:\"plus_2_sd\";s:4:\"80.5\";s:9:\"plus_3_sd\";s:4:\"82.9\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:13;s:13:\"jenis_kelamin\";s:1:\"L\";s:10:\"umur_bulan\";i:12;s:10:\"minus_3_sd\";s:4:\"68.6\";s:10:\"minus_2_sd\";s:4:\"71.0\";s:10:\"minus_1_sd\";s:4:\"73.4\";s:6:\"median\";s:4:\"75.7\";s:9:\"plus_1_sd\";s:4:\"78.1\";s:9:\"plus_2_sd\";s:4:\"80.5\";s:9:\"plus_3_sd\";s:4:\"82.9\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:13;O:20:\"App\\Models\\MasterTbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_tbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:14;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:0;s:10:\"minus_3_sd\";s:4:\"43.6\";s:10:\"minus_2_sd\";s:4:\"45.4\";s:10:\"minus_1_sd\";s:4:\"47.3\";s:6:\"median\";s:4:\"49.1\";s:9:\"plus_1_sd\";s:4:\"51.0\";s:9:\"plus_2_sd\";s:4:\"52.9\";s:9:\"plus_3_sd\";s:4:\"54.7\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:14;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:0;s:10:\"minus_3_sd\";s:4:\"43.6\";s:10:\"minus_2_sd\";s:4:\"45.4\";s:10:\"minus_1_sd\";s:4:\"47.3\";s:6:\"median\";s:4:\"49.1\";s:9:\"plus_1_sd\";s:4:\"51.0\";s:9:\"plus_2_sd\";s:4:\"52.9\";s:9:\"plus_3_sd\";s:4:\"54.7\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:14;O:20:\"App\\Models\\MasterTbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_tbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:15;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:1;s:10:\"minus_3_sd\";s:4:\"47.8\";s:10:\"minus_2_sd\";s:4:\"49.8\";s:10:\"minus_1_sd\";s:4:\"51.7\";s:6:\"median\";s:4:\"53.7\";s:9:\"plus_1_sd\";s:4:\"55.6\";s:9:\"plus_2_sd\";s:4:\"57.6\";s:9:\"plus_3_sd\";s:4:\"59.5\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:15;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:1;s:10:\"minus_3_sd\";s:4:\"47.8\";s:10:\"minus_2_sd\";s:4:\"49.8\";s:10:\"minus_1_sd\";s:4:\"51.7\";s:6:\"median\";s:4:\"53.7\";s:9:\"plus_1_sd\";s:4:\"55.6\";s:9:\"plus_2_sd\";s:4:\"57.6\";s:9:\"plus_3_sd\";s:4:\"59.5\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:15;O:20:\"App\\Models\\MasterTbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_tbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:16;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:2;s:10:\"minus_3_sd\";s:4:\"51.0\";s:10:\"minus_2_sd\";s:4:\"53.0\";s:10:\"minus_1_sd\";s:4:\"55.0\";s:6:\"median\";s:4:\"57.1\";s:9:\"plus_1_sd\";s:4:\"59.1\";s:9:\"plus_2_sd\";s:4:\"61.1\";s:9:\"plus_3_sd\";s:4:\"63.2\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:16;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:2;s:10:\"minus_3_sd\";s:4:\"51.0\";s:10:\"minus_2_sd\";s:4:\"53.0\";s:10:\"minus_1_sd\";s:4:\"55.0\";s:6:\"median\";s:4:\"57.1\";s:9:\"plus_1_sd\";s:4:\"59.1\";s:9:\"plus_2_sd\";s:4:\"61.1\";s:9:\"plus_3_sd\";s:4:\"63.2\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:16;O:20:\"App\\Models\\MasterTbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_tbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:17;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:3;s:10:\"minus_3_sd\";s:4:\"53.5\";s:10:\"minus_2_sd\";s:4:\"55.6\";s:10:\"minus_1_sd\";s:4:\"57.7\";s:6:\"median\";s:4:\"59.8\";s:9:\"plus_1_sd\";s:4:\"61.9\";s:9:\"plus_2_sd\";s:4:\"64.0\";s:9:\"plus_3_sd\";s:4:\"66.1\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:17;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:3;s:10:\"minus_3_sd\";s:4:\"53.5\";s:10:\"minus_2_sd\";s:4:\"55.6\";s:10:\"minus_1_sd\";s:4:\"57.7\";s:6:\"median\";s:4:\"59.8\";s:9:\"plus_1_sd\";s:4:\"61.9\";s:9:\"plus_2_sd\";s:4:\"64.0\";s:9:\"plus_3_sd\";s:4:\"66.1\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:17;O:20:\"App\\Models\\MasterTbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_tbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:18;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:4;s:10:\"minus_3_sd\";s:4:\"55.6\";s:10:\"minus_2_sd\";s:4:\"57.8\";s:10:\"minus_1_sd\";s:4:\"59.9\";s:6:\"median\";s:4:\"62.1\";s:9:\"plus_1_sd\";s:4:\"64.3\";s:9:\"plus_2_sd\";s:4:\"66.4\";s:9:\"plus_3_sd\";s:4:\"68.6\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:18;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:4;s:10:\"minus_3_sd\";s:4:\"55.6\";s:10:\"minus_2_sd\";s:4:\"57.8\";s:10:\"minus_1_sd\";s:4:\"59.9\";s:6:\"median\";s:4:\"62.1\";s:9:\"plus_1_sd\";s:4:\"64.3\";s:9:\"plus_2_sd\";s:4:\"66.4\";s:9:\"plus_3_sd\";s:4:\"68.6\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:18;O:20:\"App\\Models\\MasterTbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_tbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:19;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:5;s:10:\"minus_3_sd\";s:4:\"57.4\";s:10:\"minus_2_sd\";s:4:\"59.6\";s:10:\"minus_1_sd\";s:4:\"61.8\";s:6:\"median\";s:4:\"64.0\";s:9:\"plus_1_sd\";s:4:\"66.2\";s:9:\"plus_2_sd\";s:4:\"68.5\";s:9:\"plus_3_sd\";s:4:\"70.7\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:19;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:5;s:10:\"minus_3_sd\";s:4:\"57.4\";s:10:\"minus_2_sd\";s:4:\"59.6\";s:10:\"minus_1_sd\";s:4:\"61.8\";s:6:\"median\";s:4:\"64.0\";s:9:\"plus_1_sd\";s:4:\"66.2\";s:9:\"plus_2_sd\";s:4:\"68.5\";s:9:\"plus_3_sd\";s:4:\"70.7\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:19;O:20:\"App\\Models\\MasterTbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_tbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:20;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:6;s:10:\"minus_3_sd\";s:4:\"58.9\";s:10:\"minus_2_sd\";s:4:\"61.2\";s:10:\"minus_1_sd\";s:4:\"63.5\";s:6:\"median\";s:4:\"65.7\";s:9:\"plus_1_sd\";s:4:\"68.0\";s:9:\"plus_2_sd\";s:4:\"70.3\";s:9:\"plus_3_sd\";s:4:\"72.5\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:20;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:6;s:10:\"minus_3_sd\";s:4:\"58.9\";s:10:\"minus_2_sd\";s:4:\"61.2\";s:10:\"minus_1_sd\";s:4:\"63.5\";s:6:\"median\";s:4:\"65.7\";s:9:\"plus_1_sd\";s:4:\"68.0\";s:9:\"plus_2_sd\";s:4:\"70.3\";s:9:\"plus_3_sd\";s:4:\"72.5\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:20;O:20:\"App\\Models\\MasterTbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_tbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:21;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:7;s:10:\"minus_3_sd\";s:4:\"60.3\";s:10:\"minus_2_sd\";s:4:\"62.7\";s:10:\"minus_1_sd\";s:4:\"65.0\";s:6:\"median\";s:4:\"67.3\";s:9:\"plus_1_sd\";s:4:\"69.6\";s:9:\"plus_2_sd\";s:4:\"71.9\";s:9:\"plus_3_sd\";s:4:\"74.2\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:21;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:7;s:10:\"minus_3_sd\";s:4:\"60.3\";s:10:\"minus_2_sd\";s:4:\"62.7\";s:10:\"minus_1_sd\";s:4:\"65.0\";s:6:\"median\";s:4:\"67.3\";s:9:\"plus_1_sd\";s:4:\"69.6\";s:9:\"plus_2_sd\";s:4:\"71.9\";s:9:\"plus_3_sd\";s:4:\"74.2\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:21;O:20:\"App\\Models\\MasterTbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_tbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:22;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:8;s:10:\"minus_3_sd\";s:4:\"61.7\";s:10:\"minus_2_sd\";s:4:\"64.0\";s:10:\"minus_1_sd\";s:4:\"66.4\";s:6:\"median\";s:4:\"68.7\";s:9:\"plus_1_sd\";s:4:\"71.1\";s:9:\"plus_2_sd\";s:4:\"73.4\";s:9:\"plus_3_sd\";s:4:\"75.8\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:22;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:8;s:10:\"minus_3_sd\";s:4:\"61.7\";s:10:\"minus_2_sd\";s:4:\"64.0\";s:10:\"minus_1_sd\";s:4:\"66.4\";s:6:\"median\";s:4:\"68.7\";s:9:\"plus_1_sd\";s:4:\"71.1\";s:9:\"plus_2_sd\";s:4:\"73.4\";s:9:\"plus_3_sd\";s:4:\"75.8\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:22;O:20:\"App\\Models\\MasterTbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_tbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:23;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:9;s:10:\"minus_3_sd\";s:4:\"62.9\";s:10:\"minus_2_sd\";s:4:\"65.3\";s:10:\"minus_1_sd\";s:4:\"67.7\";s:6:\"median\";s:4:\"70.1\";s:9:\"plus_1_sd\";s:4:\"72.6\";s:9:\"plus_2_sd\";s:4:\"75.0\";s:9:\"plus_3_sd\";s:4:\"77.4\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:23;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:9;s:10:\"minus_3_sd\";s:4:\"62.9\";s:10:\"minus_2_sd\";s:4:\"65.3\";s:10:\"minus_1_sd\";s:4:\"67.7\";s:6:\"median\";s:4:\"70.1\";s:9:\"plus_1_sd\";s:4:\"72.6\";s:9:\"plus_2_sd\";s:4:\"75.0\";s:9:\"plus_3_sd\";s:4:\"77.4\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:23;O:20:\"App\\Models\\MasterTbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_tbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:24;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:10;s:10:\"minus_3_sd\";s:4:\"64.1\";s:10:\"minus_2_sd\";s:4:\"66.5\";s:10:\"minus_1_sd\";s:4:\"69.0\";s:6:\"median\";s:4:\"71.5\";s:9:\"plus_1_sd\";s:4:\"73.9\";s:9:\"plus_2_sd\";s:4:\"76.4\";s:9:\"plus_3_sd\";s:4:\"78.9\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:24;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:10;s:10:\"minus_3_sd\";s:4:\"64.1\";s:10:\"minus_2_sd\";s:4:\"66.5\";s:10:\"minus_1_sd\";s:4:\"69.0\";s:6:\"median\";s:4:\"71.5\";s:9:\"plus_1_sd\";s:4:\"73.9\";s:9:\"plus_2_sd\";s:4:\"76.4\";s:9:\"plus_3_sd\";s:4:\"78.9\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:24;O:20:\"App\\Models\\MasterTbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_tbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:25;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:11;s:10:\"minus_3_sd\";s:4:\"65.2\";s:10:\"minus_2_sd\";s:4:\"67.7\";s:10:\"minus_1_sd\";s:4:\"70.3\";s:6:\"median\";s:4:\"72.8\";s:9:\"plus_1_sd\";s:4:\"75.3\";s:9:\"plus_2_sd\";s:4:\"77.8\";s:9:\"plus_3_sd\";s:4:\"80.3\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:25;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:11;s:10:\"minus_3_sd\";s:4:\"65.2\";s:10:\"minus_2_sd\";s:4:\"67.7\";s:10:\"minus_1_sd\";s:4:\"70.3\";s:6:\"median\";s:4:\"72.8\";s:9:\"plus_1_sd\";s:4:\"75.3\";s:9:\"plus_2_sd\";s:4:\"77.8\";s:9:\"plus_3_sd\";s:4:\"80.3\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:25;O:20:\"App\\Models\\MasterTbu\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"master_tbu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:26;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:12;s:10:\"minus_3_sd\";s:4:\"66.3\";s:10:\"minus_2_sd\";s:4:\"68.9\";s:10:\"minus_1_sd\";s:4:\"71.4\";s:6:\"median\";s:4:\"74.0\";s:9:\"plus_1_sd\";s:4:\"76.6\";s:9:\"plus_2_sd\";s:4:\"79.2\";s:9:\"plus_3_sd\";s:4:\"81.7\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:26;s:13:\"jenis_kelamin\";s:1:\"P\";s:10:\"umur_bulan\";i:12;s:10:\"minus_3_sd\";s:4:\"66.3\";s:10:\"minus_2_sd\";s:4:\"68.9\";s:10:\"minus_1_sd\";s:4:\"71.4\";s:6:\"median\";s:4:\"74.0\";s:9:\"plus_1_sd\";s:4:\"76.6\";s:9:\"plus_2_sd\";s:4:\"79.2\";s:9:\"plus_3_sd\";s:4:\"81.7\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 2095908116);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_posyandu`
--

CREATE TABLE `jadwal_posyandu` (
  `id` bigint UNSIGNED NOT NULL,
  `judul_agenda` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_acara` date NOT NULL,
  `waktu_acara` time NOT NULL,
  `tempat_acara` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_kirim_pesan` time NOT NULL DEFAULT '08:00:00',
  `kategori_target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_pesan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal_posyandu`
--

INSERT INTO `jadwal_posyandu` (`id`, `judul_agenda`, `tanggal_acara`, `waktu_acara`, `tempat_acara`, `jam_kirim_pesan`, `kategori_target`, `isi_pesan`, `is_aktif`, `created_at`, `updated_at`) VALUES
(1, 'Imunisasi Balita', '2026-06-03', '08:00:00', 'Desa Tambak sari', '22:51:00', 'balita', 'Gunakan {nama}, {tanggal}, {waktu}, dan {tempat} untuk memanggil data secara dinamis.', 1, '2026-06-02 08:37:29', '2026-06-02 08:49:56');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_bbtb`
--

CREATE TABLE `master_bbtb` (
  `id` bigint UNSIGNED NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tinggi_badan_cm` decimal(4,1) NOT NULL,
  `minus_3_sd` decimal(4,1) NOT NULL,
  `minus_2_sd` decimal(4,1) NOT NULL,
  `minus_1_sd` decimal(4,1) NOT NULL,
  `median` decimal(4,1) NOT NULL,
  `plus_1_sd` decimal(4,1) NOT NULL,
  `plus_2_sd` decimal(4,1) NOT NULL,
  `plus_3_sd` decimal(4,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_bbtb`
--

INSERT INTO `master_bbtb` (`id`, `jenis_kelamin`, `tinggi_badan_cm`, `minus_3_sd`, `minus_2_sd`, `minus_1_sd`, `median`, `plus_1_sd`, `plus_2_sd`, `plus_3_sd`) VALUES
(1, 'L', 45.0, 1.9, 2.0, 2.2, 2.4, 2.7, 2.9, 3.2),
(2, 'L', 46.0, 2.0, 2.2, 2.4, 2.6, 2.9, 3.1, 3.5),
(3, 'L', 47.0, 2.2, 2.4, 2.6, 2.8, 3.1, 3.4, 3.7),
(4, 'L', 48.0, 2.4, 2.5, 2.8, 3.0, 3.3, 3.6, 4.0),
(5, 'L', 49.0, 2.5, 2.7, 3.0, 3.2, 3.5, 3.9, 4.3),
(6, 'L', 50.0, 2.7, 2.9, 3.2, 3.4, 3.8, 4.1, 4.5),
(7, 'L', 55.0, 3.6, 3.9, 4.3, 4.7, 5.1, 5.6, 6.2),
(8, 'L', 60.0, 4.7, 5.1, 5.5, 6.0, 6.6, 7.2, 7.9),
(9, 'L', 65.0, 5.9, 6.3, 6.9, 7.5, 8.2, 8.9, 9.8),
(10, 'L', 70.0, 7.0, 7.6, 8.3, 9.0, 9.8, 10.7, 11.7),
(11, 'P', 45.0, 1.9, 2.0, 2.2, 2.5, 2.7, 3.0, 3.3),
(12, 'P', 46.0, 2.0, 2.2, 2.4, 2.6, 2.9, 3.2, 3.5),
(13, 'P', 47.0, 2.2, 2.4, 2.6, 2.8, 3.1, 3.4, 3.7),
(14, 'P', 48.0, 2.3, 2.5, 2.7, 3.0, 3.3, 3.6, 4.0),
(15, 'P', 49.0, 2.5, 2.7, 2.9, 3.2, 3.5, 3.8, 4.2),
(16, 'P', 50.0, 2.6, 2.8, 3.1, 3.4, 3.7, 4.1, 4.5),
(17, 'P', 55.0, 3.5, 3.8, 4.2, 4.5, 5.0, 5.5, 6.1),
(18, 'P', 60.0, 4.5, 4.9, 5.3, 5.8, 6.4, 7.0, 7.7),
(19, 'P', 65.0, 5.6, 6.1, 6.6, 7.2, 7.9, 8.7, 9.5),
(20, 'P', 70.0, 6.7, 7.2, 7.9, 8.6, 9.4, 10.3, 11.3);

-- --------------------------------------------------------

--
-- Table structure for table `master_bbu`
--

CREATE TABLE `master_bbu` (
  `id` bigint UNSIGNED NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `umur_bulan` int NOT NULL,
  `minus_3_sd` decimal(4,1) NOT NULL,
  `minus_2_sd` decimal(4,1) NOT NULL,
  `minus_1_sd` decimal(4,1) NOT NULL,
  `median` decimal(4,1) NOT NULL,
  `plus_1_sd` decimal(4,1) NOT NULL,
  `plus_2_sd` decimal(4,1) NOT NULL,
  `plus_3_sd` decimal(4,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_bbu`
--

INSERT INTO `master_bbu` (`id`, `jenis_kelamin`, `umur_bulan`, `minus_3_sd`, `minus_2_sd`, `minus_1_sd`, `median`, `plus_1_sd`, `plus_2_sd`, `plus_3_sd`) VALUES
(1, 'L', 0, 2.1, 2.5, 2.9, 3.3, 3.9, 4.4, 5.0),
(2, 'L', 1, 2.9, 3.4, 3.9, 4.5, 5.1, 5.8, 6.6),
(3, 'L', 2, 3.8, 4.3, 4.9, 5.6, 6.3, 7.1, 8.0),
(4, 'L', 3, 4.4, 5.0, 5.7, 6.4, 7.2, 8.0, 9.0),
(5, 'L', 4, 4.9, 5.6, 6.3, 7.0, 7.8, 8.7, 9.7),
(6, 'L', 5, 5.3, 6.0, 6.7, 7.5, 8.4, 9.3, 10.4),
(7, 'L', 6, 5.7, 6.4, 7.1, 7.9, 8.8, 9.8, 10.9),
(8, 'L', 7, 5.9, 6.7, 7.4, 8.3, 9.2, 10.3, 11.4),
(9, 'L', 8, 6.2, 6.9, 7.7, 8.6, 9.6, 10.7, 11.9),
(10, 'L', 9, 6.4, 7.1, 8.0, 8.9, 9.9, 11.0, 12.3),
(11, 'L', 10, 6.6, 7.4, 8.2, 9.2, 10.2, 11.4, 12.7),
(12, 'L', 11, 6.8, 7.6, 8.4, 9.4, 10.5, 11.7, 13.0),
(13, 'L', 12, 6.9, 7.7, 8.6, 9.6, 10.8, 12.0, 13.3),
(14, 'P', 0, 2.0, 2.4, 2.8, 3.2, 3.7, 4.2, 4.8),
(15, 'P', 1, 2.7, 3.2, 3.6, 4.2, 4.8, 5.5, 6.2),
(16, 'P', 2, 3.4, 3.9, 4.5, 5.1, 5.8, 6.6, 7.5),
(17, 'P', 3, 4.0, 4.5, 5.1, 5.8, 6.6, 7.5, 8.5),
(18, 'P', 4, 4.4, 5.0, 5.7, 6.4, 7.3, 8.2, 9.3),
(19, 'P', 5, 4.8, 5.4, 6.1, 6.9, 7.8, 8.8, 10.0),
(20, 'P', 6, 5.1, 5.7, 6.5, 7.3, 8.2, 9.3, 10.5),
(21, 'P', 7, 5.3, 6.0, 6.8, 7.6, 8.6, 9.8, 11.1),
(22, 'P', 8, 5.6, 6.3, 7.0, 7.9, 9.0, 10.2, 11.6),
(23, 'P', 9, 5.8, 6.5, 7.3, 8.2, 9.3, 10.6, 12.1),
(24, 'P', 10, 5.9, 6.7, 7.5, 8.5, 9.6, 10.9, 12.4),
(25, 'P', 11, 6.1, 6.9, 7.7, 8.7, 9.9, 11.2, 12.8),
(26, 'P', 12, 6.3, 7.0, 7.9, 8.9, 10.1, 11.5, 13.1);

-- --------------------------------------------------------

--
-- Table structure for table `master_tbu`
--

CREATE TABLE `master_tbu` (
  `id` bigint UNSIGNED NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `umur_bulan` int NOT NULL,
  `minus_3_sd` decimal(4,1) NOT NULL,
  `minus_2_sd` decimal(4,1) NOT NULL,
  `minus_1_sd` decimal(4,1) NOT NULL,
  `median` decimal(4,1) NOT NULL,
  `plus_1_sd` decimal(4,1) NOT NULL,
  `plus_2_sd` decimal(4,1) NOT NULL,
  `plus_3_sd` decimal(4,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_tbu`
--

INSERT INTO `master_tbu` (`id`, `jenis_kelamin`, `umur_bulan`, `minus_3_sd`, `minus_2_sd`, `minus_1_sd`, `median`, `plus_1_sd`, `plus_2_sd`, `plus_3_sd`) VALUES
(1, 'L', 0, 44.2, 46.1, 48.0, 49.9, 51.8, 53.7, 55.6),
(2, 'L', 1, 48.9, 50.8, 52.8, 54.7, 56.7, 58.6, 60.6),
(3, 'L', 2, 52.4, 54.4, 56.4, 58.4, 60.4, 62.4, 64.4),
(4, 'L', 3, 55.3, 57.3, 59.4, 61.4, 63.5, 65.5, 67.6),
(5, 'L', 4, 57.6, 59.7, 61.8, 63.9, 66.0, 68.0, 70.1),
(6, 'L', 5, 59.6, 61.7, 63.8, 65.9, 68.0, 70.1, 72.2),
(7, 'L', 6, 61.2, 63.3, 65.5, 67.6, 69.8, 71.9, 74.0),
(8, 'L', 7, 62.7, 64.8, 67.0, 69.2, 71.3, 73.5, 75.7),
(9, 'L', 8, 64.0, 66.2, 68.4, 70.6, 72.8, 75.0, 77.2),
(10, 'L', 9, 65.2, 67.5, 69.7, 72.0, 74.2, 76.5, 78.7),
(11, 'L', 10, 66.4, 68.7, 71.0, 73.3, 75.6, 77.9, 80.1),
(12, 'L', 11, 67.6, 69.9, 72.2, 74.5, 76.9, 79.2, 81.5),
(13, 'L', 12, 68.6, 71.0, 73.4, 75.7, 78.1, 80.5, 82.9),
(14, 'P', 0, 43.6, 45.4, 47.3, 49.1, 51.0, 52.9, 54.7),
(15, 'P', 1, 47.8, 49.8, 51.7, 53.7, 55.6, 57.6, 59.5),
(16, 'P', 2, 51.0, 53.0, 55.0, 57.1, 59.1, 61.1, 63.2),
(17, 'P', 3, 53.5, 55.6, 57.7, 59.8, 61.9, 64.0, 66.1),
(18, 'P', 4, 55.6, 57.8, 59.9, 62.1, 64.3, 66.4, 68.6),
(19, 'P', 5, 57.4, 59.6, 61.8, 64.0, 66.2, 68.5, 70.7),
(20, 'P', 6, 58.9, 61.2, 63.5, 65.7, 68.0, 70.3, 72.5),
(21, 'P', 7, 60.3, 62.7, 65.0, 67.3, 69.6, 71.9, 74.2),
(22, 'P', 8, 61.7, 64.0, 66.4, 68.7, 71.1, 73.4, 75.8),
(23, 'P', 9, 62.9, 65.3, 67.7, 70.1, 72.6, 75.0, 77.4),
(24, 'P', 10, 64.1, 66.5, 69.0, 71.5, 73.9, 76.4, 78.9),
(25, 'P', 11, 65.2, 67.7, 70.3, 72.8, 75.3, 77.8, 80.3),
(26, 'P', 12, 66.3, 68.9, 71.4, 74.0, 76.6, 79.2, 81.7);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
(9, '2026_02_20_062207_add_kolom_baru_to_pemeriksaan_bayi_table', 6),
(11, '2026_05_24_095317_create_template_pesans_table', 8),
(12, '2026_05_24_113700_create_notifications_table', 9),
(13, '2026_05_29_154833_create_pengaturans_table', 10),
(14, '2026_06_01_172938_add_logos_to_pengaturan_table', 11),
(17, '2026_05_24_091253_create_jadwal_posyandu_table', 12),
(19, '2026_06_02_141712_create_jadwal_posyandu_table', 13),
(20, '2026_06_03_173916_add_kolom_eppgbm_to_pemeriksaan_bayi_table', 14),
(21, '2026_06_03_180426_add_zscore_to_pemeriksaan_bayi_table', 15),
(22, '2026_06_03_184729_add_bbtb_to_pemeriksaan_bayi_table', 16),
(23, '2026_06_03_192514_add_cara_ukur_and_bbtb_to_pemeriksaan_bayi_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` bigint UNSIGNED NOT NULL,
  `nik` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_kk` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tempat_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_wali` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ayah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik_ayah` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendidikan_pekerjaan_ayah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ibu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik_ibu` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendidikan_pekerjaan_ibu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anak_ke` int DEFAULT NULL,
  `berat_lahir` decimal(6,2) DEFAULT NULL COMMENT 'BBL dalam gram/kg',
  `panjang_lahir` decimal(5,2) DEFAULT NULL COMMENT 'PBL dalam cm',
  `imd` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Inisiasi Menyusu Dini',
  `riwayat_asi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'E1, E2, E3, E4, E5, E6',
  `is_arsip` tinyint(1) NOT NULL DEFAULT '0',
  `keterangan_pindah` text COLLATE utf8mb4_unicode_ci,
  `tgl_meninggal` date DEFAULT NULL,
  `penyebab_meninggal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_pemakaman` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `nik`, `no_kk`, `nama`, `jenis_kelamin`, `tgl_lahir`, `tempat_lahir`, `alamat`, `no_hp`, `nama_wali`, `nama_ayah`, `nik_ayah`, `pendidikan_pekerjaan_ayah`, `nama_ibu`, `nik_ibu`, `pendidikan_pekerjaan_ibu`, `anak_ke`, `berat_lahir`, `panjang_lahir`, `imd`, `riwayat_asi`, `is_arsip`, `keterangan_pindah`, `tgl_meninggal`, `penyebab_meninggal`, `tempat_pemakaman`, `created_at`, `updated_at`) VALUES
(59, '3302201010240034', '3302201010240012', 'Adela Hazah', 'P', '2026-06-01', 'Banyumas', 'mjnyhtgrfed', '089660939173', NULL, 'Bagas Abdulah', NULL, NULL, 'Siti Rahma', NULL, NULL, 1, 12.00, 12.00, 0, NULL, 0, NULL, NULL, NULL, NULL, '2026-06-03 21:09:11', '2026-06-03 21:09:11');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `keterangan_umur` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usia_bulan` int DEFAULT NULL,
  `berat_badan` decimal(5,2) DEFAULT NULL,
  `tinggi_badan` decimal(5,2) DEFAULT NULL,
  `cara_ukur` enum('berdiri','terlentang') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rambu_gizi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'N / T / O',
  `titik_pertumbuhan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Hijau / Kuning / BGM',
  `lingkar_kepala` decimal(5,2) DEFAULT NULL,
  `lila` decimal(5,2) DEFAULT NULL,
  `lingkar_lengan` decimal(5,2) DEFAULT NULL COMMENT 'LILA cm',
  `vitamin_a` tinyint(1) NOT NULL DEFAULT '0',
  `obat_cacing` tinyint(1) NOT NULL DEFAULT '0',
  `sdidtk_pmba_asi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SDIDTK/PMBA/ASI Eksklusif',
  `jenis_imunisasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deteksi_tbc` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'S.TBC',
  `kie` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Konseling/KIE',
  `rujuk` tinyint(1) NOT NULL DEFAULT '0',
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status_gizi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_stunting` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_bbtb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `asi_eksklusif` tinyint(1) DEFAULT '0',
  `pmba` tinyint(1) DEFAULT '0',
  `sdidtk` tinyint(1) DEFAULT '0',
  `pitting_edema` enum('derajat +1','derajat +2','derajat +3','tidak ada') COLLATE utf8mb4_unicode_ci DEFAULT 'tidak ada',
  `kelas_ibu` tinyint(1) DEFAULT '0',
  `menerima_mbg` tinyint(1) DEFAULT '0',
  `zscore_bbu` decimal(5,2) DEFAULT NULL,
  `zscore_tbu` decimal(5,2) DEFAULT NULL,
  `zscore_bbtb` decimal(5,2) DEFAULT NULL,
  `kenaikan_bb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan_bb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `riwayat_penyakit` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tindakan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `keluhan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_puskesmas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Puskesmas Tambak Sari Kidul',
  `teks_login` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Selamat datang di sistem informasi balita puskesmas tambak sari kidul',
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background_login` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logos` json DEFAULT NULL,
  `warna_tema` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#ec4899',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tinggi_logo_utama` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '2.5rem',
  `posisi_form_login` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'tengah'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `nama_puskesmas`, `teks_login`, `logo`, `background_login`, `logos`, `warna_tema`, `created_at`, `updated_at`, `tinggi_logo_utama`, `posisi_form_login`) VALUES
(1, 'Tambak Sari Kidul', 'Selamat Datang Di Sistem Informasi Balita Desa Tambaksari Kidul', 'branding-logo/01KT3DYFT1W30TDCA1ZBWX92N7.png', 'branding-bg/01KT3F9062J6PQ8CBG2QADKYPZ.avif', '[{\"path_logo\": \"system-logos/01KT3CT8HK8NYQ0HFDKVQ35C9G.png\", \"tinggi_logo\": \"h-16\"}, {\"path_logo\": \"system-logos/01KT3CT8KDQPFK2XSRYWQ1X77F.png\", \"tinggi_logo\": \"h-16\"}, {\"path_logo\": \"system-logos/01KT3CT8KMTETYV5VTK7Y5N6DJ.png\", \"tinggi_logo\": \"h-16\"}]', '#28b54f', '2026-05-29 08:58:54', '2026-06-01 23:34:23', '3.5rem', 'tengah');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('dqn3qcfMhhJMThLcUyYIVANDlfPjoH1lMh2ycTHy', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiQXFSWlpNbjBBemNKQ3UzRGRhVmRNVmgxS2NreXRpelZPQUFYdXZ3SyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjUyOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcGFzaWVucy9jcmVhdGU/a2F0ZWdvcmk9YmFsaXRhIjtzOjU6InJvdXRlIjtzOjM5OiJmaWxhbWVudC5hZG1pbi5yZXNvdXJjZXMucGFzaWVucy5jcmVhdGUiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjY0OiI0MWM0NWM0N2VkYmMyZjUwNGE2NjA5ZTBmNzk2YTkwOWFkN2MzNWI0N2Y4YWQxMjBiZDkyMDc3OTdjODU3NjQ3Ijt9', 1780818618);

-- --------------------------------------------------------

--
-- Table structure for table `template_pesan`
--

CREATE TABLE `template_pesan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_template` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_pesan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `template_pesan`
--

INSERT INTO `template_pesan` (`id`, `nama_template`, `isi_pesan`, `created_at`, `updated_at`) VALUES
(1, 'POSYANDU BALITA', '📢 *UNDANGAN POSYANDU BALITA* 📢\n\nSelamat pagi Bapak/Ibu Orang Tua dari *{nama}*,\n\nMengingatkan bahwa akan dilaksanakan kegiatan Posyandu Balita rutin untuk pemantauan tumbuh kembang anak, imunisasi, serta pemberian vitamin yang akan dilaksanakan pada:\n\n📅 Hari/Tanggal: {tanggal}\n⏰ Waktu: 08.00 WIB s/d Selesai\n📍 Lokasi: {lokasi}\n\nMohon kehadiran Bapak/Ibu dengan membawa berkas Buku KIA / KMS anak. Terima kasih.', '2026-05-24 03:04:54', '2026-05-24 03:08:54'),
(2, 'POSYANDU REMAJA', '📢 *YUK KE POSYANDU REMAJA!* 📢\n\nHalo Teman-teman, terkhusus *{nama}* ✨\n\nJangan lupa luangkan waktu kamu untuk ikut serta dalam kegiatan Posyandu Remaja bulan ini ya! Akan ada pemeriksaan kesehatan berkala, cek tensi darah, screening gizi, dan pembagian suplemen gratis yang diadakan pada:\n\n📅 Hari/Tanggal: {tanggal}\n⏰ Waktu: 08.00 WIB s/d Selesai\n📍 Lokasi: {lokasi}\n\nYuk, mari jaga masa muda kita agar tetap sehat dan produktif! Ditunggu kedatangannya ya.', '2026-05-24 03:05:26', '2026-05-24 03:09:26'),
(3, 'POSYANDU LANSIA', '📢 *UNDANGAN KESEHATAN POSYANDU LANSIA* 📢\n\nHormat kami Bapak/Ibu/Eyang *{nama}*,\n\nKami mengundang kehadiran Bapak/Ibu sekalian untuk mengikuti kegiatan pemeriksaan kesehatan berkala rutin Lansia (Cek Tensi Darah, Gula Darah, Kolesterol, dan Asam Urat) yang akan diselenggarakan pada:\n\n📅 Hari/Tanggal: {tanggal}\n⏰ Waktu: 08.00 WIB s/d Selesai\n📍 Lokasi: {lokasi}\n\nKesehatan Bapak dan Ibu adalah prioritas kami. Mohon kehadirannya tepat waktu, terima kasih banyak.', '2026-05-24 03:05:51', '2026-05-24 03:09:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meja_tugas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `provinsi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kabupaten_kota` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desa_kelurahan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_puskesmas` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_posyandu` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `akses_menu` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `meja_tugas`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `provinsi`, `kabupaten_kota`, `kecamatan`, `desa_kelurahan`, `nama_puskesmas`, `nama_posyandu`, `akses_menu`) VALUES
(1, 'Admin', 'admin@posyandu.com', 'superadmin', NULL, '$2y$12$tQ4oPii4JZCkPEdFtkHoBOiiSGDcYPIBMTy7bG31zmlv87rZbzMzW', 'wP26bRdsJH8HLZTOhnEGMLmSrYKAY1e5npWQQlHxiZi2EWtp5AVWVHnTybff', '2026-02-18 21:21:27', '2026-06-03 08:59:10', 'Jawa Tengah', 'Kabupaten Banyumas', 'Kembaran', 'Tambaksari Kidul', 'Kembaran I', 'Anyelir', '[\"bayi\", \"lansia\", \"remaja\", \"user\", \"arsip-pasiens\", \"pemeriksaan-lansias\", \"pengaturan-sistem\", \"jadwal-posyandus\", \"pemeriksaan-remajas\", \"kontak-pasiens\", \"riwayats\", \"pasiens\", \"template-pesans\", \"pemeriksaan-bayis\", \"users\"]'),
(2, 'admin1', 'admin1@posyandu.com', 'meja_1', NULL, '$2y$12$gDQ1XO2P3kWaRRHBwcSiSuQp2vcjSUHf8cfOAtuqnqJe6.vxRkey6', 'ah0SoQ2wcaUBDXhX3NPMjLSKBAxYvK2n88KxNWtItDYTsNyXBcuN9gFFiTas', '2026-02-18 22:25:50', '2026-05-23 18:17:37', NULL, NULL, NULL, NULL, NULL, NULL, '[\"bayi\", \"pasien\"]'),
(3, 'admin2', 'admin2@posyandu.com', 'meja_2', NULL, '$2y$12$WLlv4atRQUb/kH9fIgnDA.lTcMZIWe.Kloq.r48jzj4ECMk9lK9B2', NULL, '2026-02-18 22:26:09', '2026-02-19 20:21:31', NULL, NULL, NULL, NULL, NULL, NULL, '[\"bayi\", \"lansia\", \"remaja\"]'),
(4, 'admin3', 'admin3@posyandu.com', 'meja_3', NULL, '$2y$12$OgDGE.xR.iRNdxDkY7WiSOC2fz.TorIQYqfKeS2YpLcABcVSQvCMq', NULL, '2026-02-18 22:26:26', '2026-02-19 20:21:46', NULL, NULL, NULL, NULL, NULL, NULL, '[\"bayi\", \"lansia\", \"remaja\"]'),
(5, 'admin4', 'admin4@posyandu.com', 'meja_4', NULL, '$2y$12$u1CE.p6VcF5YnrIjniLE6Ona1/ZIsRbg94P1jqa96zg.xroBNLvly', NULL, '2026-02-18 22:26:47', '2026-02-19 20:22:29', NULL, NULL, NULL, NULL, NULL, NULL, '[\"bayi\", \"lansia\", \"remaja\"]'),
(6, 'admin5', 'admin5@posyandu.com', 'meja_5', NULL, '$2y$12$6rZQvQEnhvGQtJNI6Poh...qnB9ZsItaxDcXUFDTA7f4BXFZObqhe', 'Ca0b8jAwTAfyidrT6LE1FZK6aktmBNP9G862eNWaBVm0lU8Eyj5y2DmpXajp', '2026-02-19 21:28:11', '2026-02-19 21:28:11', NULL, NULL, NULL, NULL, NULL, NULL, '[\"remaja\", \"bayi\", \"lansia\"]');

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
-- Indexes for table `jadwal_posyandu`
--
ALTER TABLE `jadwal_posyandu`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `master_bbtb`
--
ALTER TABLE `master_bbtb`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_bbtb_jk_tb` (`jenis_kelamin`,`tinggi_badan_cm`);

--
-- Indexes for table `master_bbu`
--
ALTER TABLE `master_bbu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_bbu_jk_umur` (`jenis_kelamin`,`umur_bulan`);

--
-- Indexes for table `master_tbu`
--
ALTER TABLE `master_tbu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_tbu_jk_umur` (`jenis_kelamin`,`umur_bulan`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

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
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `template_pesan`
--
ALTER TABLE `template_pesan`
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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_posyandu`
--
ALTER TABLE `jadwal_posyandu`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_bbtb`
--
ALTER TABLE `master_bbtb`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `master_bbu`
--
ALTER TABLE `master_bbu`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `master_tbu`
--
ALTER TABLE `master_tbu`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `pemeriksaan_bayi`
--
ALTER TABLE `pemeriksaan_bayi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `pemeriksaan_lansia`
--
ALTER TABLE `pemeriksaan_lansia`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pemeriksaan_remaja`
--
ALTER TABLE `pemeriksaan_remaja`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `template_pesan`
--
ALTER TABLE `template_pesan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
