-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2025 at 06:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `umurinzi`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) NOT NULL DEFAULT 'N/A',
  `details` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `user_id`, `action`, `details`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'N/A', NULL, 'active', '2025-08-20 03:18:45', '2025-08-20 03:18:45'),
(2, NULL, 'N/A', NULL, 'active', '2025-08-20 03:19:32', '2025-08-20 03:19:32'),
(3, NULL, 'N/A', NULL, 'active', '2025-08-20 03:29:47', '2025-08-20 03:29:47'),
(4, NULL, 'N/A', NULL, 'active', '2025-08-20 05:46:02', '2025-08-20 05:46:02'),
(5, NULL, 'N/A', NULL, 'active', '2025-08-20 05:48:05', '2025-08-20 05:48:05'),
(6, NULL, 'N/A', NULL, 'active', '2025-08-20 05:55:57', '2025-08-20 05:55:57'),
(7, NULL, 'N/A', NULL, 'active', '2025-08-20 06:30:52', '2025-08-20 06:30:52'),
(8, NULL, 'N/A', NULL, 'active', '2025-08-20 06:31:22', '2025-08-20 06:31:22'),
(9, NULL, 'N/A', NULL, 'active', '2025-08-20 06:31:34', '2025-08-20 06:31:34'),
(10, NULL, 'N/A', NULL, 'active', '2025-08-20 06:55:13', '2025-08-20 06:55:13'),
(11, NULL, 'N/A', NULL, 'active', '2025-08-20 06:58:50', '2025-08-20 06:58:50'),
(12, NULL, 'N/A', NULL, 'active', '2025-08-20 20:26:24', '2025-08-20 20:26:24'),
(13, NULL, 'N/A', NULL, 'active', '2025-08-20 20:26:35', '2025-08-20 20:26:35'),
(14, NULL, 'N/A', NULL, 'active', '2025-08-21 00:08:13', '2025-08-21 00:08:13'),
(15, NULL, 'N/A', NULL, 'active', '2025-08-21 00:08:17', '2025-08-21 00:08:17'),
(16, NULL, 'N/A', NULL, 'active', '2025-08-21 00:08:17', '2025-08-21 00:08:17'),
(17, NULL, 'N/A', NULL, 'active', '2025-08-21 00:08:29', '2025-08-21 00:08:29'),
(18, NULL, 'N/A', NULL, 'active', '2025-08-21 00:08:29', '2025-08-21 00:08:29'),
(19, NULL, 'N/A', NULL, 'active', '2025-08-21 00:08:34', '2025-08-21 00:08:34'),
(20, NULL, 'N/A', NULL, 'active', '2025-08-21 00:08:45', '2025-08-21 00:08:45'),
(21, NULL, 'N/A', NULL, 'active', '2025-08-21 00:08:45', '2025-08-21 00:08:45'),
(22, NULL, 'N/A', NULL, 'active', '2025-08-21 00:08:45', '2025-08-21 00:08:45'),
(23, NULL, 'N/A', NULL, 'active', '2025-08-21 00:09:03', '2025-08-21 00:09:03'),
(24, NULL, 'N/A', NULL, 'active', '2025-08-21 00:09:05', '2025-08-21 00:09:05'),
(25, NULL, 'N/A', NULL, 'active', '2025-08-21 00:09:08', '2025-08-21 00:09:08'),
(26, NULL, 'N/A', NULL, 'active', '2025-08-21 00:09:11', '2025-08-21 00:09:11'),
(27, NULL, 'N/A', NULL, 'active', '2025-08-21 00:31:27', '2025-08-21 00:31:27'),
(28, NULL, 'N/A', NULL, 'active', '2025-08-21 00:32:20', '2025-08-21 00:32:20'),
(29, NULL, 'N/A', NULL, 'active', '2025-08-21 00:32:20', '2025-08-21 00:32:20'),
(30, NULL, 'N/A', NULL, 'active', '2025-08-21 00:32:21', '2025-08-21 00:32:21'),
(31, NULL, 'N/A', NULL, 'active', '2025-08-21 00:32:22', '2025-08-21 00:32:22'),
(32, NULL, 'N/A', NULL, 'active', '2025-08-21 00:32:22', '2025-08-21 00:32:22'),
(33, NULL, 'N/A', NULL, 'active', '2025-08-21 00:32:23', '2025-08-21 00:32:23'),
(34, NULL, 'N/A', NULL, 'active', '2025-08-21 00:32:29', '2025-08-21 00:32:29'),
(35, NULL, 'N/A', NULL, 'active', '2025-08-21 00:32:36', '2025-08-21 00:32:36'),
(36, NULL, 'N/A', NULL, 'active', '2025-08-21 00:32:37', '2025-08-21 00:32:37'),
(37, NULL, 'N/A', NULL, 'active', '2025-08-21 00:32:40', '2025-08-21 00:32:40'),
(38, NULL, 'N/A', NULL, 'active', '2025-08-21 00:32:40', '2025-08-21 00:32:40'),
(39, NULL, 'N/A', NULL, 'active', '2025-08-21 00:32:45', '2025-08-21 00:32:45'),
(40, NULL, 'N/A', NULL, 'active', '2025-08-21 00:32:46', '2025-08-21 00:32:46'),
(41, NULL, 'N/A', NULL, 'active', '2025-08-21 00:33:43', '2025-08-21 00:33:43'),
(42, NULL, 'N/A', NULL, 'active', '2025-08-21 00:34:17', '2025-08-21 00:34:17'),
(43, NULL, 'N/A', NULL, 'active', '2025-08-21 00:38:46', '2025-08-21 00:38:46'),
(44, NULL, 'N/A', NULL, 'active', '2025-08-21 00:44:23', '2025-08-21 00:44:23'),
(45, NULL, 'N/A', NULL, 'active', '2025-08-21 00:45:59', '2025-08-21 00:45:59'),
(46, NULL, 'N/A', NULL, 'active', '2025-08-21 00:47:29', '2025-08-21 00:47:29'),
(47, NULL, 'N/A', NULL, 'active', '2025-08-21 00:49:09', '2025-08-21 00:49:09'),
(48, NULL, 'N/A', NULL, 'active', '2025-08-22 01:02:14', '2025-08-22 01:02:14'),
(49, NULL, 'N/A', NULL, 'active', '2025-08-22 01:10:10', '2025-08-22 01:10:10'),
(50, NULL, 'N/A', NULL, 'active', '2025-08-22 01:10:19', '2025-08-22 01:10:19'),
(51, NULL, 'N/A', NULL, 'active', '2025-08-22 01:10:46', '2025-08-22 01:10:46'),
(52, NULL, 'N/A', NULL, 'active', '2025-08-22 01:12:39', '2025-08-22 01:12:39'),
(53, NULL, 'N/A', NULL, 'active', '2025-08-22 01:12:39', '2025-08-22 01:12:39'),
(54, NULL, 'N/A', NULL, 'active', '2025-08-22 01:20:04', '2025-08-22 01:20:04'),
(55, NULL, 'N/A', NULL, 'active', '2025-08-22 01:20:18', '2025-08-22 01:20:18'),
(56, NULL, 'N/A', NULL, 'active', '2025-08-22 01:20:30', '2025-08-22 01:20:30'),
(57, NULL, 'N/A', NULL, 'active', '2025-08-22 01:37:25', '2025-08-22 01:37:25'),
(58, NULL, 'N/A', NULL, 'active', '2025-08-22 01:38:04', '2025-08-22 01:38:04'),
(59, NULL, 'N/A', NULL, 'active', '2025-08-22 06:31:15', '2025-08-22 06:31:15'),
(60, NULL, 'N/A', NULL, 'active', '2025-08-22 12:22:43', '2025-08-22 12:22:43'),
(61, NULL, 'N/A', NULL, 'active', '2025-08-22 13:39:03', '2025-08-22 13:39:03'),
(62, NULL, 'N/A', NULL, 'active', '2025-08-22 13:42:01', '2025-08-22 13:42:01'),
(63, NULL, 'N/A', NULL, 'active', '2025-08-22 13:42:13', '2025-08-22 13:42:13'),
(64, NULL, 'N/A', NULL, 'active', '2025-08-22 13:42:57', '2025-08-22 13:42:57'),
(65, NULL, 'N/A', NULL, 'active', '2025-08-22 13:43:46', '2025-08-22 13:43:46'),
(66, NULL, 'N/A', NULL, 'active', '2025-08-22 13:44:07', '2025-08-22 13:44:07'),
(67, NULL, 'N/A', NULL, 'active', '2025-08-22 13:44:15', '2025-08-22 13:44:15'),
(68, NULL, 'N/A', NULL, 'active', '2025-08-22 13:44:25', '2025-08-22 13:44:25'),
(69, NULL, 'N/A', NULL, 'active', '2025-08-22 13:45:37', '2025-08-22 13:45:37'),
(70, NULL, 'N/A', NULL, 'active', '2025-08-22 13:46:05', '2025-08-22 13:46:05'),
(71, NULL, 'N/A', NULL, 'active', '2025-08-22 13:46:13', '2025-08-22 13:46:13'),
(72, NULL, 'N/A', NULL, 'active', '2025-08-22 13:46:32', '2025-08-22 13:46:32'),
(73, NULL, 'N/A', NULL, 'active', '2025-08-22 13:46:53', '2025-08-22 13:46:53'),
(74, NULL, 'N/A', NULL, 'active', '2025-08-22 13:48:03', '2025-08-22 13:48:03'),
(75, NULL, 'N/A', NULL, 'active', '2025-08-22 13:50:32', '2025-08-22 13:50:32'),
(76, NULL, 'N/A', NULL, 'active', '2025-08-22 13:51:03', '2025-08-22 13:51:03'),
(77, NULL, 'N/A', NULL, 'active', '2025-08-22 13:52:45', '2025-08-22 13:52:45'),
(78, NULL, 'N/A', NULL, 'active', '2025-08-22 13:53:34', '2025-08-22 13:53:34'),
(79, NULL, 'N/A', NULL, 'active', '2025-08-22 13:54:36', '2025-08-22 13:54:36'),
(80, NULL, 'N/A', NULL, 'active', '2025-08-22 13:54:41', '2025-08-22 13:54:41'),
(81, NULL, 'N/A', NULL, 'active', '2025-08-22 13:55:47', '2025-08-22 13:55:47'),
(82, NULL, 'N/A', NULL, 'active', '2025-08-22 14:04:53', '2025-08-22 14:04:53'),
(83, NULL, 'N/A', NULL, 'active', '2025-08-22 14:05:49', '2025-08-22 14:05:49'),
(84, NULL, 'N/A', NULL, 'active', '2025-08-22 14:06:14', '2025-08-22 14:06:14'),
(85, NULL, 'N/A', NULL, 'active', '2025-08-22 14:06:50', '2025-08-22 14:06:50'),
(86, NULL, 'N/A', NULL, 'active', '2025-08-22 14:07:29', '2025-08-22 14:07:29'),
(87, NULL, 'N/A', NULL, 'active', '2025-08-22 14:07:45', '2025-08-22 14:07:45'),
(88, NULL, 'N/A', NULL, 'active', '2025-08-22 14:08:34', '2025-08-22 14:08:34'),
(89, NULL, 'N/A', NULL, 'active', '2025-08-22 14:09:45', '2025-08-22 14:09:45'),
(90, NULL, 'N/A', NULL, 'active', '2025-08-22 14:10:54', '2025-08-22 14:10:54'),
(91, NULL, 'N/A', NULL, 'active', '2025-08-22 14:11:06', '2025-08-22 14:11:06'),
(92, NULL, 'N/A', NULL, 'active', '2025-08-22 15:23:22', '2025-08-22 15:23:22'),
(93, NULL, 'N/A', NULL, 'active', '2025-08-22 15:24:59', '2025-08-22 15:24:59'),
(94, NULL, 'N/A', NULL, 'active', '2025-08-22 15:25:47', '2025-08-22 15:25:47'),
(95, NULL, 'N/A', NULL, 'active', '2025-08-22 15:26:11', '2025-08-22 15:26:11'),
(96, NULL, 'N/A', NULL, 'active', '2025-08-22 15:26:31', '2025-08-22 15:26:31'),
(97, NULL, 'N/A', NULL, 'active', '2025-08-22 15:27:09', '2025-08-22 15:27:09'),
(98, NULL, 'N/A', NULL, 'active', '2025-08-22 15:27:44', '2025-08-22 15:27:44'),
(99, NULL, 'N/A', NULL, 'active', '2025-08-22 15:28:14', '2025-08-22 15:28:14'),
(100, NULL, 'N/A', NULL, 'active', '2025-08-22 15:29:34', '2025-08-22 15:29:34'),
(101, NULL, 'N/A', NULL, 'active', '2025-08-22 15:29:38', '2025-08-22 15:29:38'),
(102, NULL, 'N/A', NULL, 'active', '2025-08-22 15:38:35', '2025-08-22 15:38:35'),
(103, NULL, 'N/A', NULL, 'active', '2025-08-22 15:39:29', '2025-08-22 15:39:29'),
(104, NULL, 'N/A', NULL, 'active', '2025-08-22 15:40:23', '2025-08-22 15:40:23'),
(105, NULL, 'N/A', NULL, 'active', '2025-08-22 15:40:36', '2025-08-22 15:40:36'),
(106, NULL, 'N/A', NULL, 'active', '2025-08-22 15:40:52', '2025-08-22 15:40:52'),
(107, NULL, 'N/A', NULL, 'active', '2025-08-22 15:41:01', '2025-08-22 15:41:01'),
(108, NULL, 'N/A', NULL, 'active', '2025-08-22 15:41:20', '2025-08-22 15:41:20'),
(109, NULL, 'N/A', NULL, 'active', '2025-08-22 15:41:32', '2025-08-22 15:41:32'),
(110, NULL, 'N/A', NULL, 'active', '2025-08-22 16:01:22', '2025-08-22 16:01:22'),
(111, NULL, 'N/A', NULL, 'active', '2025-08-22 16:01:27', '2025-08-22 16:01:27'),
(112, NULL, 'N/A', NULL, 'active', '2025-08-22 16:02:26', '2025-08-22 16:02:26'),
(113, NULL, 'N/A', NULL, 'active', '2025-08-22 16:13:02', '2025-08-22 16:13:02'),
(114, NULL, 'N/A', NULL, 'active', '2025-08-22 16:22:57', '2025-08-22 16:22:57'),
(115, NULL, 'N/A', NULL, 'active', '2025-08-22 16:23:17', '2025-08-22 16:23:17'),
(116, NULL, 'N/A', NULL, 'active', '2025-08-22 16:24:47', '2025-08-22 16:24:47'),
(117, NULL, 'N/A', NULL, 'active', '2025-08-22 16:25:42', '2025-08-22 16:25:42'),
(118, NULL, 'N/A', NULL, 'active', '2025-08-22 17:01:16', '2025-08-22 17:01:16'),
(119, NULL, 'N/A', NULL, 'active', '2025-08-22 17:01:35', '2025-08-22 17:01:35'),
(120, NULL, 'N/A', NULL, 'active', '2025-08-22 17:01:41', '2025-08-22 17:01:41'),
(121, NULL, 'N/A', NULL, 'active', '2025-08-22 17:01:46', '2025-08-22 17:01:46'),
(122, NULL, 'N/A', NULL, 'active', '2025-08-22 17:02:44', '2025-08-22 17:02:44'),
(123, NULL, 'N/A', NULL, 'active', '2025-08-22 17:04:57', '2025-08-22 17:04:57'),
(124, NULL, 'N/A', NULL, 'active', '2025-08-22 17:06:43', '2025-08-22 17:06:43'),
(125, NULL, 'N/A', NULL, 'active', '2025-08-22 17:11:06', '2025-08-22 17:11:06'),
(126, NULL, 'N/A', NULL, 'active', '2025-08-22 17:12:00', '2025-08-22 17:12:00'),
(127, NULL, 'N/A', NULL, 'active', '2025-08-22 17:14:24', '2025-08-22 17:14:24'),
(128, NULL, 'N/A', NULL, 'active', '2025-08-22 17:14:26', '2025-08-22 17:14:26'),
(129, NULL, 'N/A', NULL, 'active', '2025-08-22 17:17:21', '2025-08-22 17:17:21'),
(130, NULL, 'N/A', NULL, 'active', '2025-08-22 17:18:21', '2025-08-22 17:18:21'),
(131, NULL, 'N/A', NULL, 'active', '2025-08-24 09:49:39', '2025-08-24 09:49:39'),
(132, NULL, 'N/A', NULL, 'active', '2025-08-24 09:49:56', '2025-08-24 09:49:56'),
(133, NULL, 'N/A', NULL, 'active', '2025-08-24 09:50:17', '2025-08-24 09:50:17'),
(134, NULL, 'N/A', NULL, 'active', '2025-08-24 09:50:48', '2025-08-24 09:50:48'),
(135, NULL, 'N/A', NULL, 'active', '2025-08-24 10:33:54', '2025-08-24 10:33:54'),
(136, NULL, 'N/A', NULL, 'active', '2025-08-24 10:34:49', '2025-08-24 10:34:49'),
(137, NULL, 'N/A', NULL, 'active', '2025-08-24 10:38:03', '2025-08-24 10:38:03'),
(138, NULL, 'N/A', NULL, 'active', '2025-08-24 15:18:11', '2025-08-24 15:18:11'),
(139, NULL, 'N/A', NULL, 'active', '2025-08-26 09:30:15', '2025-08-26 09:30:15'),
(140, NULL, 'N/A', NULL, 'active', '2025-08-26 09:30:40', '2025-08-26 09:30:40'),
(141, NULL, 'N/A', NULL, 'active', '2025-08-26 09:30:53', '2025-08-26 09:30:53'),
(142, NULL, 'N/A', NULL, 'active', '2025-08-26 09:32:56', '2025-08-26 09:32:56'),
(143, NULL, 'N/A', NULL, 'active', '2025-08-26 09:38:39', '2025-08-26 09:38:39'),
(144, NULL, 'N/A', NULL, 'active', '2025-08-26 09:46:04', '2025-08-26 09:46:04'),
(145, NULL, 'N/A', NULL, 'active', '2025-08-26 09:51:02', '2025-08-26 09:51:02'),
(146, NULL, 'N/A', NULL, 'active', '2025-08-26 10:10:57', '2025-08-26 10:10:57'),
(147, NULL, 'N/A', NULL, 'active', '2025-08-26 10:20:24', '2025-08-26 10:20:24'),
(148, NULL, 'N/A', NULL, 'active', '2025-08-26 10:20:24', '2025-08-26 10:20:24'),
(149, NULL, 'N/A', NULL, 'active', '2025-08-26 10:20:33', '2025-08-26 10:20:33'),
(150, NULL, 'N/A', NULL, 'active', '2025-08-26 10:20:33', '2025-08-26 10:20:33'),
(151, NULL, 'N/A', NULL, 'active', '2025-08-26 10:20:41', '2025-08-26 10:20:41'),
(152, NULL, 'N/A', NULL, 'active', '2025-08-26 10:20:41', '2025-08-26 10:20:41'),
(153, NULL, 'N/A', NULL, 'active', '2025-08-26 10:24:00', '2025-08-26 10:24:00'),
(154, NULL, 'N/A', NULL, 'active', '2025-08-26 10:24:01', '2025-08-26 10:24:01'),
(155, NULL, 'N/A', NULL, 'active', '2025-08-26 10:24:14', '2025-08-26 10:24:14'),
(156, NULL, 'N/A', NULL, 'active', '2025-08-26 10:24:15', '2025-08-26 10:24:15'),
(157, NULL, 'N/A', NULL, 'active', '2025-08-26 10:27:27', '2025-08-26 10:27:27'),
(158, NULL, 'N/A', NULL, 'active', '2025-08-26 10:27:27', '2025-08-26 10:27:27'),
(159, NULL, 'N/A', NULL, 'active', '2025-08-26 10:31:01', '2025-08-26 10:31:01'),
(160, NULL, 'N/A', NULL, 'active', '2025-08-26 10:31:01', '2025-08-26 10:31:01'),
(161, NULL, 'N/A', NULL, 'active', '2025-08-26 10:31:33', '2025-08-26 10:31:33'),
(162, NULL, 'N/A', NULL, 'active', '2025-08-26 10:31:33', '2025-08-26 10:31:33'),
(163, NULL, 'N/A', NULL, 'active', '2025-08-26 10:32:39', '2025-08-26 10:32:39'),
(164, NULL, 'N/A', NULL, 'active', '2025-08-26 10:32:39', '2025-08-26 10:32:39'),
(165, NULL, 'N/A', NULL, 'active', '2025-08-26 10:32:39', '2025-08-26 10:32:39'),
(166, NULL, 'N/A', NULL, 'active', '2025-08-26 10:32:40', '2025-08-26 10:32:40'),
(167, NULL, 'N/A', NULL, 'active', '2025-08-26 10:34:34', '2025-08-26 10:34:34'),
(168, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:02', '2025-08-26 10:35:02'),
(169, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:04', '2025-08-26 10:35:04'),
(170, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:06', '2025-08-26 10:35:06'),
(171, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:09', '2025-08-26 10:35:09'),
(172, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:17', '2025-08-26 10:35:17'),
(173, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:18', '2025-08-26 10:35:18'),
(174, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:20', '2025-08-26 10:35:20'),
(175, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:21', '2025-08-26 10:35:21'),
(176, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:23', '2025-08-26 10:35:23'),
(177, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:24', '2025-08-26 10:35:24'),
(178, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:26', '2025-08-26 10:35:26'),
(179, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:26', '2025-08-26 10:35:26'),
(180, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:28', '2025-08-26 10:35:28'),
(181, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:28', '2025-08-26 10:35:28'),
(182, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:30', '2025-08-26 10:35:30'),
(183, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:31', '2025-08-26 10:35:31'),
(184, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:33', '2025-08-26 10:35:33'),
(185, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:34', '2025-08-26 10:35:34'),
(186, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:36', '2025-08-26 10:35:36'),
(187, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:36', '2025-08-26 10:35:36'),
(188, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:38', '2025-08-26 10:35:38'),
(189, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:39', '2025-08-26 10:35:39'),
(190, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:41', '2025-08-26 10:35:41'),
(191, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:41', '2025-08-26 10:35:41'),
(192, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:43', '2025-08-26 10:35:43'),
(193, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:44', '2025-08-26 10:35:44'),
(194, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:45', '2025-08-26 10:35:45'),
(195, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:46', '2025-08-26 10:35:46'),
(196, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:48', '2025-08-26 10:35:48'),
(197, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:48', '2025-08-26 10:35:48'),
(198, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:50', '2025-08-26 10:35:50'),
(199, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:51', '2025-08-26 10:35:51'),
(200, NULL, 'N/A', NULL, 'active', '2025-08-26 10:35:59', '2025-08-26 10:35:59'),
(201, NULL, 'N/A', NULL, 'active', '2025-08-26 10:36:16', '2025-08-26 10:36:16'),
(202, NULL, 'N/A', NULL, 'active', '2025-08-26 10:36:18', '2025-08-26 10:36:18'),
(203, NULL, 'N/A', NULL, 'active', '2025-08-26 10:42:19', '2025-08-26 10:42:19'),
(204, NULL, 'N/A', NULL, 'active', '2025-08-26 10:42:28', '2025-08-26 10:42:28'),
(205, NULL, 'N/A', NULL, 'active', '2025-08-26 10:42:43', '2025-08-26 10:42:43'),
(206, NULL, 'N/A', NULL, 'active', '2025-08-26 10:42:50', '2025-08-26 10:42:50'),
(207, NULL, 'N/A', NULL, 'active', '2025-08-26 10:43:12', '2025-08-26 10:43:12'),
(208, NULL, 'N/A', NULL, 'active', '2025-08-26 10:43:29', '2025-08-26 10:43:29'),
(209, NULL, 'N/A', NULL, 'active', '2025-08-26 10:43:30', '2025-08-26 10:43:30'),
(210, NULL, 'N/A', NULL, 'active', '2025-08-26 10:43:33', '2025-08-26 10:43:33'),
(211, NULL, 'N/A', NULL, 'active', '2025-08-26 10:43:37', '2025-08-26 10:43:37'),
(212, NULL, 'N/A', NULL, 'active', '2025-08-26 10:43:37', '2025-08-26 10:43:37'),
(213, NULL, 'N/A', NULL, 'active', '2025-08-26 10:43:40', '2025-08-26 10:43:40'),
(214, NULL, 'N/A', NULL, 'active', '2025-08-26 10:43:41', '2025-08-26 10:43:41'),
(215, NULL, 'N/A', NULL, 'active', '2025-08-26 10:43:43', '2025-08-26 10:43:43'),
(216, NULL, 'N/A', NULL, 'active', '2025-08-26 10:43:44', '2025-08-26 10:43:44'),
(217, NULL, 'N/A', NULL, 'active', '2025-08-26 10:43:47', '2025-08-26 10:43:47'),
(218, NULL, 'N/A', NULL, 'active', '2025-08-26 10:43:47', '2025-08-26 10:43:47'),
(219, NULL, 'N/A', NULL, 'active', '2025-08-26 10:43:51', '2025-08-26 10:43:51'),
(220, NULL, 'N/A', NULL, 'active', '2025-08-26 10:43:51', '2025-08-26 10:43:51'),
(221, NULL, 'N/A', NULL, 'active', '2025-08-26 10:43:51', '2025-08-26 10:43:51'),
(222, NULL, 'N/A', NULL, 'active', '2025-08-26 10:43:52', '2025-08-26 10:43:52'),
(223, NULL, 'N/A', NULL, 'active', '2025-08-26 10:43:55', '2025-08-26 10:43:55'),
(224, NULL, 'N/A', NULL, 'active', '2025-08-26 10:46:49', '2025-08-26 10:46:49'),
(225, NULL, 'N/A', NULL, 'active', '2025-08-26 10:47:19', '2025-08-26 10:47:19'),
(226, NULL, 'N/A', NULL, 'active', '2025-08-26 10:47:25', '2025-08-26 10:47:25'),
(227, NULL, 'N/A', NULL, 'active', '2025-08-26 10:47:32', '2025-08-26 10:47:32'),
(228, NULL, 'N/A', NULL, 'active', '2025-08-26 10:47:35', '2025-08-26 10:47:35'),
(229, NULL, 'N/A', NULL, 'active', '2025-08-26 10:47:56', '2025-08-26 10:47:56'),
(230, NULL, 'N/A', NULL, 'active', '2025-08-26 10:47:56', '2025-08-26 10:47:56'),
(231, NULL, 'N/A', NULL, 'active', '2025-08-26 10:47:56', '2025-08-26 10:47:56'),
(232, NULL, 'N/A', NULL, 'active', '2025-08-26 10:47:56', '2025-08-26 10:47:56'),
(233, NULL, 'N/A', NULL, 'active', '2025-08-26 10:52:38', '2025-08-26 10:52:38'),
(234, NULL, 'N/A', NULL, 'active', '2025-08-26 10:52:42', '2025-08-26 10:52:42'),
(235, NULL, 'N/A', NULL, 'active', '2025-08-26 10:52:51', '2025-08-26 10:52:51'),
(236, NULL, 'N/A', NULL, 'active', '2025-08-26 10:52:56', '2025-08-26 10:52:56'),
(237, NULL, 'N/A', NULL, 'active', '2025-08-26 10:53:00', '2025-08-26 10:53:00'),
(238, NULL, 'N/A', NULL, 'active', '2025-08-26 10:53:00', '2025-08-26 10:53:00'),
(239, NULL, 'N/A', NULL, 'active', '2025-08-26 11:00:12', '2025-08-26 11:00:12'),
(240, NULL, 'N/A', NULL, 'active', '2025-08-26 11:00:18', '2025-08-26 11:00:18'),
(241, NULL, 'N/A', NULL, 'active', '2025-08-26 11:00:27', '2025-08-26 11:00:27'),
(242, NULL, 'N/A', NULL, 'active', '2025-08-26 11:00:31', '2025-08-26 11:00:31'),
(243, NULL, 'N/A', NULL, 'active', '2025-08-26 11:00:34', '2025-08-26 11:00:34'),
(244, NULL, 'N/A', NULL, 'active', '2025-08-26 11:00:43', '2025-08-26 11:00:43'),
(245, NULL, 'N/A', NULL, 'active', '2025-08-26 11:04:10', '2025-08-26 11:04:10'),
(246, NULL, 'N/A', NULL, 'active', '2025-08-26 11:05:16', '2025-08-26 11:05:16'),
(247, NULL, 'N/A', NULL, 'active', '2025-08-26 11:05:20', '2025-08-26 11:05:20'),
(248, NULL, 'N/A', NULL, 'active', '2025-08-26 11:05:24', '2025-08-26 11:05:24'),
(249, NULL, 'N/A', NULL, 'active', '2025-08-26 11:07:12', '2025-08-26 11:07:12'),
(250, NULL, 'N/A', NULL, 'active', '2025-08-26 11:07:18', '2025-08-26 11:07:18'),
(251, NULL, 'N/A', NULL, 'active', '2025-08-26 11:07:20', '2025-08-26 11:07:20'),
(252, NULL, 'N/A', NULL, 'active', '2025-08-26 11:07:20', '2025-08-26 11:07:20'),
(253, NULL, 'N/A', NULL, 'active', '2025-08-26 11:07:23', '2025-08-26 11:07:23'),
(254, NULL, 'N/A', NULL, 'active', '2025-08-26 11:07:28', '2025-08-26 11:07:28'),
(255, NULL, 'N/A', NULL, 'active', '2025-08-26 11:07:28', '2025-08-26 11:07:28'),
(256, NULL, 'N/A', NULL, 'active', '2025-08-26 11:07:28', '2025-08-26 11:07:28'),
(257, NULL, 'N/A', NULL, 'active', '2025-08-26 11:08:23', '2025-08-26 11:08:23'),
(258, NULL, 'N/A', NULL, 'active', '2025-08-26 11:08:29', '2025-08-26 11:08:29'),
(259, NULL, 'N/A', NULL, 'active', '2025-08-26 11:08:33', '2025-08-26 11:08:33'),
(260, NULL, 'N/A', NULL, 'active', '2025-08-26 11:08:36', '2025-08-26 11:08:36'),
(261, NULL, 'N/A', NULL, 'active', '2025-08-26 11:12:13', '2025-08-26 11:12:13'),
(262, NULL, 'N/A', NULL, 'active', '2025-08-26 11:12:36', '2025-08-26 11:12:36'),
(263, NULL, 'N/A', NULL, 'active', '2025-08-26 11:12:39', '2025-08-26 11:12:39'),
(264, NULL, 'N/A', NULL, 'active', '2025-08-26 11:12:45', '2025-08-26 11:12:45'),
(265, NULL, 'N/A', NULL, 'active', '2025-08-26 14:06:40', '2025-08-26 14:06:40'),
(266, NULL, 'N/A', NULL, 'active', '2025-08-26 14:06:57', '2025-08-26 14:06:57'),
(267, NULL, 'N/A', NULL, 'active', '2025-08-26 14:07:00', '2025-08-26 14:07:00'),
(268, NULL, 'N/A', NULL, 'active', '2025-08-26 14:07:12', '2025-08-26 14:07:12'),
(269, NULL, 'N/A', NULL, 'active', '2025-08-26 14:08:38', '2025-08-26 14:08:38'),
(270, NULL, 'N/A', NULL, 'active', '2025-08-26 14:36:38', '2025-08-26 14:36:38'),
(271, NULL, 'N/A', NULL, 'active', '2025-08-26 14:37:05', '2025-08-26 14:37:05'),
(272, NULL, 'N/A', NULL, 'active', '2025-08-26 14:39:07', '2025-08-26 14:39:07'),
(273, NULL, 'N/A', NULL, 'active', '2025-08-26 14:39:56', '2025-08-26 14:39:56'),
(274, NULL, 'N/A', NULL, 'active', '2025-08-26 14:41:22', '2025-08-26 14:41:22'),
(275, NULL, 'N/A', NULL, 'active', '2025-08-26 14:50:22', '2025-08-26 14:50:22'),
(276, NULL, 'N/A', NULL, 'active', '2025-08-30 16:57:22', '2025-08-30 16:57:22'),
(277, NULL, 'N/A', NULL, 'active', '2025-08-30 16:57:36', '2025-08-30 16:57:36'),
(278, NULL, 'N/A', NULL, 'active', '2025-08-30 16:59:40', '2025-08-30 16:59:40'),
(279, NULL, 'N/A', NULL, 'active', '2025-08-30 16:59:48', '2025-08-30 16:59:48'),
(280, NULL, 'N/A', NULL, 'active', '2025-08-30 17:00:23', '2025-08-30 17:00:23'),
(281, NULL, 'N/A', NULL, 'active', '2025-08-31 00:53:50', '2025-08-31 00:53:50'),
(282, NULL, 'N/A', NULL, 'active', '2025-08-31 00:54:11', '2025-08-31 00:54:11'),
(283, NULL, 'N/A', NULL, 'active', '2025-09-05 13:27:26', '2025-09-05 13:27:26'),
(284, NULL, 'N/A', NULL, 'active', '2025-09-05 13:31:04', '2025-09-05 13:31:04'),
(285, NULL, 'N/A', NULL, 'active', '2025-09-05 20:43:50', '2025-09-05 20:43:50'),
(286, NULL, 'N/A', NULL, 'active', '2025-09-06 01:40:36', '2025-09-06 01:40:36'),
(287, NULL, 'N/A', NULL, 'active', '2025-09-06 01:42:41', '2025-09-06 01:42:41'),
(288, NULL, 'N/A', NULL, 'active', '2025-09-06 01:42:59', '2025-09-06 01:42:59'),
(289, NULL, 'N/A', NULL, 'active', '2025-09-06 01:43:00', '2025-09-06 01:43:00'),
(290, NULL, 'N/A', NULL, 'active', '2025-09-06 01:43:09', '2025-09-06 01:43:09'),
(291, NULL, 'N/A', NULL, 'active', '2025-09-06 01:48:15', '2025-09-06 01:48:15'),
(292, NULL, 'N/A', NULL, 'active', '2025-09-06 01:48:16', '2025-09-06 01:48:16'),
(293, NULL, 'N/A', NULL, 'active', '2025-09-06 01:48:16', '2025-09-06 01:48:16'),
(294, NULL, 'N/A', NULL, 'active', '2025-09-06 01:48:37', '2025-09-06 01:48:37'),
(295, NULL, 'N/A', NULL, 'active', '2025-09-06 01:49:22', '2025-09-06 01:49:22'),
(296, NULL, 'N/A', NULL, 'active', '2025-09-06 01:51:52', '2025-09-06 01:51:52'),
(297, NULL, 'N/A', NULL, 'active', '2025-09-06 01:51:57', '2025-09-06 01:51:57'),
(298, NULL, 'N/A', NULL, 'active', '2025-09-06 01:52:27', '2025-09-06 01:52:27'),
(299, NULL, 'N/A', NULL, 'active', '2025-09-06 01:52:31', '2025-09-06 01:52:31'),
(300, NULL, 'N/A', NULL, 'active', '2025-09-06 01:52:45', '2025-09-06 01:52:45'),
(301, NULL, 'N/A', NULL, 'active', '2025-09-06 01:55:45', '2025-09-06 01:55:45'),
(302, NULL, 'N/A', NULL, 'active', '2025-09-08 18:04:23', '2025-09-08 18:04:23'),
(303, NULL, 'N/A', NULL, 'active', '2025-09-08 18:15:29', '2025-09-08 18:15:29'),
(304, NULL, 'N/A', NULL, 'active', '2025-09-10 14:16:02', '2025-09-10 14:16:02'),
(305, NULL, 'N/A', NULL, 'active', '2025-09-10 14:16:07', '2025-09-10 14:16:07'),
(306, NULL, 'N/A', NULL, 'active', '2025-09-10 14:16:12', '2025-09-10 14:16:12'),
(307, NULL, 'N/A', NULL, 'active', '2025-09-10 14:35:43', '2025-09-10 14:35:43'),
(308, NULL, 'N/A', NULL, 'active', '2025-09-10 14:36:02', '2025-09-10 14:36:02'),
(309, NULL, 'N/A', NULL, 'active', '2025-09-10 14:36:05', '2025-09-10 14:36:05'),
(310, NULL, 'N/A', NULL, 'active', '2025-09-10 14:36:45', '2025-09-10 14:36:45'),
(311, NULL, 'N/A', NULL, 'active', '2025-09-10 14:37:12', '2025-09-10 14:37:12'),
(312, NULL, 'N/A', NULL, 'active', '2025-09-10 14:38:08', '2025-09-10 14:38:08'),
(313, NULL, 'N/A', NULL, 'active', '2025-09-10 14:38:12', '2025-09-10 14:38:12'),
(314, NULL, 'N/A', NULL, 'active', '2025-09-10 14:40:06', '2025-09-10 14:40:06'),
(315, NULL, 'N/A', NULL, 'active', '2025-09-10 14:40:15', '2025-09-10 14:40:15'),
(316, NULL, 'N/A', NULL, 'active', '2025-09-10 14:41:31', '2025-09-10 14:41:31'),
(317, NULL, 'N/A', NULL, 'active', '2025-09-10 14:44:01', '2025-09-10 14:44:01'),
(318, NULL, 'N/A', NULL, 'active', '2025-09-11 00:18:17', '2025-09-11 00:18:17'),
(319, NULL, 'N/A', NULL, 'active', '2025-09-11 00:32:22', '2025-09-11 00:32:22'),
(321, NULL, 'N/A', NULL, 'active', '2025-09-18 04:17:09', '2025-09-18 04:17:09'),
(322, NULL, 'N/A', NULL, 'active', '2025-09-19 14:47:16', '2025-09-19 14:47:16'),
(323, NULL, 'N/A', NULL, 'active', '2025-09-19 14:47:20', '2025-09-19 14:47:20'),
(324, NULL, 'N/A', NULL, 'active', '2025-09-21 18:52:34', '2025-09-21 18:52:34'),
(325, NULL, 'N/A', NULL, 'active', '2025-10-01 21:56:20', '2025-10-01 21:56:20'),
(326, NULL, 'N/A', NULL, 'active', '2025-10-01 21:57:37', '2025-10-01 21:57:37'),
(327, NULL, 'N/A', NULL, 'active', '2025-10-01 21:57:44', '2025-10-01 21:57:44'),
(328, NULL, 'N/A', NULL, 'active', '2025-10-04 22:35:40', '2025-10-04 22:35:40'),
(329, NULL, 'N/A', NULL, 'active', '2025-10-04 22:44:18', '2025-10-04 22:44:18'),
(330, NULL, 'N/A', NULL, 'active', '2025-10-04 22:44:24', '2025-10-04 22:44:24'),
(331, NULL, 'N/A', NULL, 'active', '2025-10-05 02:15:38', '2025-10-05 02:15:38'),
(332, NULL, 'N/A', NULL, 'active', '2025-10-05 02:15:46', '2025-10-05 02:15:46'),
(333, NULL, 'N/A', NULL, 'active', '2025-10-05 14:44:30', '2025-10-05 14:44:30'),
(334, NULL, 'N/A', NULL, 'active', '2025-10-05 15:38:18', '2025-10-05 15:38:18'),
(335, NULL, 'N/A', NULL, 'active', '2025-10-05 15:44:12', '2025-10-05 15:44:12'),
(336, NULL, 'N/A', NULL, 'active', '2025-10-05 15:51:44', '2025-10-05 15:51:44'),
(337, NULL, 'N/A', NULL, 'active', '2025-10-05 17:31:20', '2025-10-05 17:31:20'),
(338, NULL, 'N/A', NULL, 'active', '2025-10-05 17:34:03', '2025-10-05 17:34:03'),
(339, NULL, 'N/A', NULL, 'active', '2025-10-05 19:20:48', '2025-10-05 19:20:48'),
(340, NULL, 'N/A', NULL, 'active', '2025-10-05 19:20:58', '2025-10-05 19:20:58'),
(341, NULL, 'N/A', NULL, 'active', '2025-10-05 19:22:08', '2025-10-05 19:22:08'),
(342, NULL, 'N/A', NULL, 'active', '2025-10-05 19:22:36', '2025-10-05 19:22:36'),
(343, NULL, 'N/A', NULL, 'active', '2025-10-05 19:22:57', '2025-10-05 19:22:57'),
(344, NULL, 'N/A', NULL, 'active', '2025-10-05 19:26:03', '2025-10-05 19:26:03'),
(345, NULL, 'N/A', NULL, 'active', '2025-10-05 19:26:16', '2025-10-05 19:26:16'),
(346, NULL, 'N/A', NULL, 'active', '2025-10-05 19:29:12', '2025-10-05 19:29:12'),
(347, NULL, 'N/A', NULL, 'active', '2025-10-05 19:32:01', '2025-10-05 19:32:01'),
(348, NULL, 'N/A', NULL, 'active', '2025-10-05 19:36:01', '2025-10-05 19:36:01'),
(349, NULL, 'N/A', NULL, 'active', '2025-10-05 19:36:26', '2025-10-05 19:36:26'),
(350, NULL, 'N/A', NULL, 'active', '2025-10-05 19:38:26', '2025-10-05 19:38:26'),
(351, NULL, 'N/A', NULL, 'active', '2025-10-05 19:39:02', '2025-10-05 19:39:02'),
(352, NULL, 'N/A', NULL, 'active', '2025-10-05 19:39:23', '2025-10-05 19:39:23'),
(353, 22, 'N/A', NULL, 'active', '2025-10-05 19:41:25', '2025-10-05 19:41:25'),
(354, 22, 'N/A', NULL, 'active', '2025-10-06 00:45:35', '2025-10-06 00:45:35'),
(355, NULL, 'N/A', NULL, 'active', '2025-10-06 01:01:12', '2025-10-06 01:01:12'),
(356, NULL, 'N/A', NULL, 'active', '2025-10-06 14:28:08', '2025-10-06 14:28:08'),
(357, NULL, 'N/A', NULL, 'active', '2025-10-06 22:21:36', '2025-10-06 22:21:36'),
(358, NULL, 'N/A', NULL, 'active', '2025-10-07 02:36:24', '2025-10-07 02:36:24'),
(359, NULL, 'N/A', NULL, 'active', '2025-10-07 09:54:39', '2025-10-07 09:54:39'),
(360, NULL, 'N/A', NULL, 'active', '2025-10-20 21:07:59', '2025-10-20 21:07:59'),
(361, NULL, 'N/A', NULL, 'active', '2025-10-20 22:03:29', '2025-10-20 22:03:29'),
(362, NULL, 'N/A', NULL, 'active', '2025-10-20 22:03:32', '2025-10-20 22:03:32'),
(363, NULL, 'N/A', NULL, 'active', '2025-10-20 22:07:33', '2025-10-20 22:07:33'),
(364, NULL, 'N/A', NULL, 'active', '2025-10-20 22:09:20', '2025-10-20 22:09:20'),
(365, NULL, 'N/A', NULL, 'active', '2025-10-20 22:20:54', '2025-10-20 22:20:54'),
(366, NULL, 'N/A', NULL, 'active', '2025-10-20 22:21:59', '2025-10-20 22:21:59'),
(367, NULL, 'N/A', NULL, 'active', '2025-10-20 22:29:23', '2025-10-20 22:29:23'),
(368, NULL, 'N/A', NULL, 'active', '2025-10-20 22:36:54', '2025-10-20 22:36:54'),
(369, NULL, 'N/A', NULL, 'active', '2025-10-20 22:37:13', '2025-10-20 22:37:13'),
(370, NULL, 'N/A', NULL, 'active', '2025-10-20 22:38:48', '2025-10-20 22:38:48'),
(371, NULL, 'N/A', NULL, 'active', '2025-10-20 22:48:29', '2025-10-20 22:48:29'),
(372, NULL, 'N/A', NULL, 'active', '2025-10-20 22:49:23', '2025-10-20 22:49:23'),
(373, NULL, 'N/A', NULL, 'active', '2025-10-28 02:59:15', '2025-10-28 02:59:15'),
(374, NULL, 'N/A', NULL, 'active', '2025-10-28 03:12:15', '2025-10-28 03:12:15'),
(375, NULL, 'N/A', NULL, 'active', '2025-10-28 03:34:10', '2025-10-28 03:34:10'),
(376, NULL, 'N/A', NULL, 'active', '2025-10-28 13:03:24', '2025-10-28 13:03:24'),
(377, NULL, 'N/A', NULL, 'active', '2025-10-28 13:03:48', '2025-10-28 13:03:48'),
(378, NULL, 'N/A', NULL, 'active', '2025-10-29 20:07:01', '2025-10-29 20:07:01'),
(379, NULL, 'N/A', NULL, 'active', '2025-10-29 20:16:21', '2025-10-29 20:16:21'),
(380, NULL, 'N/A', NULL, 'active', '2025-10-29 20:19:19', '2025-10-29 20:19:19'),
(381, NULL, 'N/A', NULL, 'active', '2025-10-29 20:21:18', '2025-10-29 20:21:18'),
(382, NULL, 'N/A', NULL, 'active', '2025-12-16 20:44:59', '2025-12-16 20:44:59');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `answer_text` text NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `technician_id` int(255) DEFAULT NULL,
  `assigned_type` varchar(255) DEFAULT NULL,
  `assigned_id` bigint(20) UNSIGNED DEFAULT NULL,
  `assigned_name` varchar(255) DEFAULT NULL,
  `preferred_date` date DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `notes` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `client_id`, `service_id`, `technician_id`, `assigned_type`, `assigned_id`, `assigned_name`, `preferred_date`, `status`, `notes`, `price`, `duration`, `created_at`, `updated_at`) VALUES
(8, 19, 2, 0, 'team', 3, 'Clarisse IRADUKUNDA', '2025-10-09', 'canceled', NULL, NULL, NULL, '2025-09-09 05:46:20', '2025-10-07 10:29:58'),
(12, 19, 4, 18, NULL, NULL, NULL, '2025-10-08', 'completed', NULL, NULL, NULL, '2025-09-14 22:30:28', '2025-10-07 10:29:48'),
(13, 19, 28, 27, NULL, NULL, NULL, NULL, 'cancelled', NULL, NULL, NULL, '2025-09-14 22:33:41', '2025-10-20 22:20:33'),
(14, 19, 6, NULL, NULL, NULL, NULL, NULL, 'Confirmed', NULL, NULL, NULL, '2025-10-20 23:21:31', '2025-10-20 23:21:31');

-- --------------------------------------------------------

--
-- Table structure for table `businessperson_products`
--

CREATE TABLE `businessperson_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `quantity` decimal(10,2) NOT NULL DEFAULT 0.00,
  `unit` varchar(50) NOT NULL,
  `status` enum('Available','Out of Stock','Unavailable') NOT NULL DEFAULT 'Available',
  `total_value` decimal(12,2) GENERATED ALWAYS AS (`price` * `quantity`) STORED,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `businessperson_products`
--

INSERT INTO `businessperson_products` (`id`, `name`, `category`, `price`, `quantity`, `unit`, `status`, `image`, `created_at`, `updated_at`) VALUES
(1, 'trading', 'Vehicle', 6666.00, 66.00, '6666', 'Available', 'products/0BHiRJsbAGU1jl4kSBmYnqUA7QuK7jWK6CCN8XWk.webp', '2025-10-02 02:29:02', '2025-10-20 23:58:07'),
(2, 'Carabash', 'Vehicle', 3000.00, 2222.00, '2', 'Available', 'products/ccHdVjVwtJN3HdlchJ4tyqgHDAqlISIXxXYcryul.jpg', '2025-10-02 15:16:18', '2025-10-20 23:58:32'),
(3, 'Carabash', 'Carabash', 2322.00, 2.00, '111', 'Available', 'products/Qd2da47bkMpdGUl6tRT2Czy2z8FcEJI6zJ3wbyVg.jpg', '2025-10-02 15:16:50', '2025-10-20 23:58:35');

-- --------------------------------------------------------

--
-- Table structure for table `business_registers`
--

CREATE TABLE `business_registers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `business_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_registers`
--

INSERT INTO `business_registers` (`id`, `business_id`, `type`, `name`, `serial_number`, `description`, `category`, `quantity`, `location`, `status`, `created_at`, `updated_at`) VALUES
(1, 22, 'Mobile', 'Umwiza Umwali', NULL, 'Enouph', 'Vehicle', 2002, NULL, 'active', '2025-10-01 23:36:30', '2025-10-02 00:12:52');

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
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(3, 22, 7, 1, '2025-10-20 23:50:37', '2025-10-20 23:50:37');

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sender` enum('user','bot') NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mediator_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT 'Rwanda',
  `national_id` varchar(255) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('active','inactive','pending') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `mediator_id`, `user_id`, `name`, `phone`, `email`, `address`, `city`, `country`, `national_id`, `gender`, `date_of_birth`, `notes`, `created_at`, `updated_at`, `status`) VALUES
(13, NULL, NULL, 'Umuhoza Dianne', '787832490', 'umuhoza@gmail.com', 'Kigali-Nyamirambo', 'Kigali', 'Rwanda', '111122233322211111', 'Female', '2022-06-09', 'Phone repair', '2025-08-12 19:30:00', '2025-09-08 17:58:33', 'inactive'),
(19, NULL, 22, 'Admin', '78783244', NULL, NULL, NULL, 'Rwanda', NULL, NULL, NULL, NULL, '2025-09-09 00:44:12', '2025-09-09 00:44:12', 'active'),
(20, NULL, NULL, 'Umwiza Umwali', '0787832490', 'inonecdreams@gmail.com', 'Kigali Nyamirambo', 'Kigali, Kigali City, Rwanda', 'Rwanda', '122000035336633', 'Male', '2025-09-19', 'None', '2025-09-17 23:42:50', '2025-09-17 23:42:50', 'active'),
(26, NULL, NULL, 'Client Name', '', NULL, NULL, NULL, 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-07 03:39:31', '2025-10-07 03:39:31', 'active'),
(112, NULL, NULL, 'Kambanda Jonas', '07878324932', 'kambanda@gmail.com', NULL, 'Entebbe', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-06 18:19:55', '2025-10-06 18:19:55', 'active'),
(115, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:46:39', '2025-10-20 23:46:39', 'active'),
(116, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:46:42', '2025-10-20 23:46:42', 'active'),
(117, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:46:56', '2025-10-20 23:46:56', 'active'),
(118, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:46:57', '2025-10-20 23:46:57', 'active'),
(119, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:46:58', '2025-10-20 23:46:58', 'active'),
(120, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:46:58', '2025-10-20 23:46:58', 'active'),
(121, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:46:59', '2025-10-20 23:46:59', 'active'),
(122, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:00', '2025-10-20 23:47:00', 'active'),
(123, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:01', '2025-10-20 23:47:01', 'active'),
(124, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:01', '2025-10-20 23:47:01', 'active'),
(125, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:02', '2025-10-20 23:47:02', 'active'),
(126, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:02', '2025-10-20 23:47:02', 'active'),
(127, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:03', '2025-10-20 23:47:03', 'active'),
(128, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:03', '2025-10-20 23:47:03', 'active'),
(129, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:04', '2025-10-20 23:47:04', 'active'),
(130, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:05', '2025-10-20 23:47:05', 'active'),
(131, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:05', '2025-10-20 23:47:05', 'active'),
(132, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:06', '2025-10-20 23:47:06', 'active'),
(133, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:06', '2025-10-20 23:47:06', 'active'),
(134, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:06', '2025-10-20 23:47:06', 'active'),
(135, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:07', '2025-10-20 23:47:07', 'active'),
(136, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:07', '2025-10-20 23:47:07', 'active'),
(137, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:08', '2025-10-20 23:47:08', 'active'),
(138, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:08', '2025-10-20 23:47:08', 'active'),
(139, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:09', '2025-10-20 23:47:09', 'active'),
(140, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:09', '2025-10-20 23:47:09', 'active'),
(141, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:10', '2025-10-20 23:47:10', 'active'),
(142, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:10', '2025-10-20 23:47:10', 'active'),
(143, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:11', '2025-10-20 23:47:11', 'active'),
(144, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:12', '2025-10-20 23:47:12', 'active'),
(145, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:12', '2025-10-20 23:47:12', 'active'),
(146, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:13', '2025-10-20 23:47:13', 'active'),
(147, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:13', '2025-10-20 23:47:13', 'active'),
(148, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:14', '2025-10-20 23:47:14', 'active'),
(149, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:14', '2025-10-20 23:47:14', 'active'),
(150, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:15', '2025-10-20 23:47:15', 'active'),
(151, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:15', '2025-10-20 23:47:15', 'active'),
(152, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:15', '2025-10-20 23:47:15', 'active'),
(153, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:16', '2025-10-20 23:47:16', 'active'),
(154, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:16', '2025-10-20 23:47:16', 'active'),
(155, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:17', '2025-10-20 23:47:17', 'active'),
(156, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:17', '2025-10-20 23:47:17', 'active'),
(157, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:18', '2025-10-20 23:47:18', 'active'),
(158, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:19', '2025-10-20 23:47:19', 'active'),
(159, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:19', '2025-10-20 23:47:19', 'active'),
(160, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:20', '2025-10-20 23:47:20', 'active'),
(161, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:20', '2025-10-20 23:47:20', 'active'),
(162, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:21', '2025-10-20 23:47:21', 'active'),
(163, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:21', '2025-10-20 23:47:21', 'active'),
(164, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:22', '2025-10-20 23:47:22', 'active'),
(165, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:22', '2025-10-20 23:47:22', 'active'),
(166, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:23', '2025-10-20 23:47:23', 'active'),
(167, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:23', '2025-10-20 23:47:23', 'active'),
(168, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:24', '2025-10-20 23:47:24', 'active'),
(169, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:24', '2025-10-20 23:47:24', 'active'),
(170, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:25', '2025-10-20 23:47:25', 'active'),
(171, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:25', '2025-10-20 23:47:25', 'active'),
(172, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:26', '2025-10-20 23:47:26', 'active'),
(173, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:26', '2025-10-20 23:47:26', 'active'),
(174, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:47:27', '2025-10-20 23:47:27', 'active'),
(175, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:35', '2025-10-20 23:48:35', 'active'),
(176, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:36', '2025-10-20 23:48:36', 'active'),
(177, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:37', '2025-10-20 23:48:37', 'active'),
(178, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:37', '2025-10-20 23:48:37', 'active'),
(179, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:38', '2025-10-20 23:48:38', 'active'),
(180, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:38', '2025-10-20 23:48:38', 'active'),
(181, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:39', '2025-10-20 23:48:39', 'active'),
(182, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:40', '2025-10-20 23:48:40', 'active'),
(183, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:40', '2025-10-20 23:48:40', 'active'),
(184, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:40', '2025-10-20 23:48:40', 'active'),
(185, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:41', '2025-10-20 23:48:41', 'active'),
(186, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:41', '2025-10-20 23:48:41', 'active'),
(187, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:42', '2025-10-20 23:48:42', 'active'),
(188, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:42', '2025-10-20 23:48:42', 'active'),
(189, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:43', '2025-10-20 23:48:43', 'active'),
(190, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:44', '2025-10-20 23:48:44', 'active'),
(191, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:44', '2025-10-20 23:48:44', 'active'),
(192, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:45', '2025-10-20 23:48:45', 'active'),
(193, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:45', '2025-10-20 23:48:45', 'active'),
(194, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:46', '2025-10-20 23:48:46', 'active'),
(195, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:46', '2025-10-20 23:48:46', 'active'),
(196, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:47', '2025-10-20 23:48:47', 'active'),
(197, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:47', '2025-10-20 23:48:47', 'active'),
(198, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:48', '2025-10-20 23:48:48', 'active'),
(199, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:48', '2025-10-20 23:48:48', 'active'),
(200, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:49', '2025-10-20 23:48:49', 'active'),
(201, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:49', '2025-10-20 23:48:49', 'active'),
(202, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:50', '2025-10-20 23:48:50', 'active'),
(203, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:50', '2025-10-20 23:48:50', 'active'),
(204, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:51', '2025-10-20 23:48:51', 'active'),
(205, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:51', '2025-10-20 23:48:51', 'active'),
(206, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:52', '2025-10-20 23:48:52', 'active'),
(207, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:52', '2025-10-20 23:48:52', 'active'),
(208, 1, NULL, 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', NULL, 'Kigali, Kigali City, Rwanda', 'Rwanda', NULL, NULL, NULL, NULL, '2025-10-20 23:48:53', '2025-10-20 23:48:53', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `client_product`
--

CREATE TABLE `client_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `price` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_services`
--

CREATE TABLE `client_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','in_progress','completed','cancelled') NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `assigned_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `completions`
--

CREATE TABLE `completions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `enrollment_id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `connected_devices`
--

CREATE TABLE `connected_devices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `last_active` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `connections`
--

CREATE TABLE `connections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `connected_user_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `technician_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_method` enum('cash','mtn_momo','airtel_money','card','bank') DEFAULT 'cash'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country_code` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `country_code`, `phone`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Umuhoza Dianne', 'umuhoza@gmail.com', '+250', '787832490', 'Request for Job Recommendation', 'Dear Manager,\r\n\r\nI hope this message finds you well. I am reaching out to kindly request your recommendation for a position I am applying for as an ICT Manager. Your endorsement would greatly strengthen my application, given your knowledge of my skills and professional background.\r\n\r\nThank you in advance for your consideration and support.\r\n\r\nBest regards,\r\nInnocent Ntakirutimana', '2025-08-12 23:25:30', '2025-08-12 23:25:30'),
(2, 'Innocent NTAKIRUTIMANA', 'innocentntakir@gmail.com', '+250', '787832490', 'Request', 'I need Recommendation Letter from IVARA Company!', '2025-08-13 21:27:38', '2025-08-13 21:27:38'),
(3, 'Adam', 'adam@gmail.com', '+254', '7880000000', 'Welcome', 'I need you', '2025-10-05 19:22:08', '2025-10-05 19:22:08'),
(4, 'Innocent NTAKIRUTIMANA', 'innocentntakir@gmail.com', '+250', '787832490', 'Request', 'Support me', '2025-10-20 21:07:59', '2025-10-20 21:07:59');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `role_target` varchar(255) DEFAULT NULL,
  `is_mandatory` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `craftsperson_products`
--

CREATE TABLE `craftsperson_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `craftsperson_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `unit` varchar(50) NOT NULL DEFAULT 'pcs',
  `status` enum('Available','Out of Stock','Discontinued') NOT NULL DEFAULT 'Available',
  `image` varchar(255) DEFAULT NULL,
  `total_value` decimal(12,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `craftsperson_products`
--

INSERT INTO `craftsperson_products` (`id`, `craftsperson_id`, `name`, `category`, `price`, `quantity`, `unit`, `status`, `image`, `total_value`, `created_at`, `updated_at`) VALUES
(1, 22, 'Carabash', 'Carabash', 44444.00, 44, '4000', 'Discontinued', 'products/VpGjMbPJt4PTcXgKsKwhrrZRCvmvmpI39xQSG4in.webp', 1955536.00, '2025-09-30 10:31:40', '2025-10-29 19:40:48'),
(2, 22, 'Drawings', 'Crafts', 20000.00, 20, '20000', 'Available', 'products/K5kdgtq7oyEhnc4RXr97IEh0FIVRnQzETZ5zjqgy.jpg', 400000.00, '2025-10-01 13:02:48', '2025-10-29 19:40:58');

-- --------------------------------------------------------

--
-- Table structure for table `craftsperson_register_repair`
--

CREATE TABLE `craftsperson_register_repair` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `craftsperson_name` varchar(255) NOT NULL,
  `craft_type` varchar(255) NOT NULL,
  `repair_item` varchar(255) NOT NULL,
  `repair_description` text DEFAULT NULL,
  `repair_date` date NOT NULL,
  `repair_cost` decimal(10,2) DEFAULT NULL,
  `status` enum('Pending','In Progress','Completed') NOT NULL DEFAULT 'Pending',
  `client_name` varchar(255) DEFAULT NULL,
  `client_contact` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `craftsperson_register_repair`
--

INSERT INTO `craftsperson_register_repair` (`id`, `craftsperson_name`, `craft_type`, `repair_item`, `repair_description`, `repair_date`, `repair_cost`, `status`, `client_name`, `client_contact`, `created_at`, `updated_at`) VALUES
(1, 'Kabera', 'Carabash', 'New', 'New', '2025-09-03', 50000.00, 'Completed', NULL, NULL, '2025-09-28 09:49:10', '2025-09-29 17:23:48'),
(2, 'Kwizera John', 'Carabash', 'New', 'New Brands To buy', '2025-09-25', 40000.00, 'Completed', 'James', '07878543443', '2025-09-29 16:55:21', '2025-09-29 17:39:45'),
(3, 'Kwizera John', 'Carabash', 'New', 'sd', '2025-09-05', 43443.00, 'Completed', 'James', '07878543443', '2025-09-29 17:29:37', '2025-10-21 00:17:40');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `imei_1` varchar(255) DEFAULT NULL,
  `imei_2` varchar(255) DEFAULT NULL,
  `imei_3_or_mac_or_plate` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `os` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `purchase_date` date DEFAULT NULL,
  `warranty_expiry` date DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `last_seen_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `assigned_technician_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `problem_description` text DEFAULT NULL,
  `solved_problems` text DEFAULT NULL,
  `recommendations` text DEFAULT NULL,
  `technician` varchar(255) DEFAULT NULL,
  `repair_status` varchar(255) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `user_id`, `brand`, `model`, `serial_number`, `imei_1`, `imei_2`, `imei_3_or_mac_or_plate`, `type`, `os`, `status`, `purchase_date`, `warranty_expiry`, `location`, `last_seen_at`, `notes`, `client_id`, `assigned_technician_id`, `created_at`, `updated_at`, `problem_description`, `solved_problems`, `recommendations`, `technician`, `repair_status`) VALUES
(15, 1, 'iPhone', 'New Model', '21322d21qq', '123213', '123213', '1234333', 'New Model', 'Android', 'repair', '2025-10-17', '2025-10-28', 'Kibagabaga', NULL, '333', NULL, NULL, '2025-10-05 11:46:13', '2025-10-20 21:42:18', NULL, NULL, NULL, NULL, 'Pending'),
(17, NULL, 'tablet', 'New Model', '21322d21sss', '12321', 'sss22', '123432', 'New Model', 'Android', 'repair', '2025-10-16', '2025-10-25', 'Kigali City', NULL, 'yes', NULL, NULL, '2025-10-05 11:56:08', '2025-10-05 12:14:50', NULL, NULL, NULL, NULL, 'Pending'),
(18, NULL, 'Maraphone', 'New Model', '21322d21122', '123212', '22222', '1234333', 'New Model', 'Android', 'pending', '2025-10-23', '2025-10-30', 'Kigali City', NULL, '333', NULL, NULL, '2025-10-05 12:00:31', '2025-10-05 13:37:21', NULL, NULL, NULL, NULL, 'Pending'),
(21, 22, 'SAMSUNG', 'SAMSUNG', 'q123rTsc', '4egewaw', NULL, NULL, 'Computer', 'android', 'repaired', NULL, NULL, 'Remeraa', NULL, NULL, NULL, NULL, '2025-10-21 00:03:50', '2025-10-26 09:13:38', NULL, NULL, NULL, NULL, 'Pending'),
(22, 22, 'SAMSUNG S15', 'RAN', 'BBDrsta', '4egewaws', NULL, NULL, 'Phone', 'android', 'repaired', NULL, NULL, 'Kimironko', NULL, NULL, NULL, NULL, '2025-10-26 09:14:42', '2025-10-26 13:22:36', 'Screeen Broken, Charging problems and no Calling', 'Calling problems and screen', 'Dont expose to the sun for along time', 'Innocent ', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
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
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `module` varchar(255) NOT NULL,
  `urgency` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('Unread','Read') DEFAULT 'Unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `stock_level` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_items`
--

CREATE TABLE `inventory_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `stock_level` int(11) NOT NULL,
  `status` enum('In Stock','Low Stock','Critical') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `craftsperson_id` bigint(20) UNSIGNED DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `issued_at` timestamp NULL DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL DEFAULT 0.00,
  `discount_total` decimal(12,2) NOT NULL DEFAULT 0.00,
  `tax_total` decimal(12,2) NOT NULL DEFAULT 0.00,
  `grand_total` decimal(12,2) NOT NULL DEFAULT 0.00,
  `amount_due` decimal(12,2) NOT NULL DEFAULT 0.00,
  `due_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `client_id`, `craftsperson_id`, `number`, `issued_at`, `status`, `subtotal`, `discount_total`, `tax_total`, `grand_total`, `amount_due`, `due_date`, `created_at`, `updated_at`, `user_id`) VALUES
(12, 10, 0, 'INV-20250815-0001', NULL, '', 11200.00, 0.00, 2016.00, 13216.00, 13216.00, NULL, '2025-08-15 14:00:05', '2025-08-15 14:00:05', NULL),
(13, 11, 0, 'INV-20250815-0002', NULL, '', 15900.00, 0.00, 2862.00, 18762.00, 18762.00, NULL, '2025-08-16 02:31:59', '2025-08-16 02:31:59', NULL),
(14, NULL, 0, 'INV-20250818-0003', NULL, '', 700.00, 0.00, 126.00, 826.00, 826.00, NULL, '2025-08-19 06:43:58', '2025-08-19 06:43:58', NULL),
(15, 10, 0, 'INV-20250818-0004', NULL, '', 700.00, 0.00, 126.00, 826.00, 826.00, NULL, '2025-08-19 06:56:34', '2025-08-19 06:56:34', NULL),
(16, 10, 0, 'INV-20250818-0005', NULL, '', 800.00, 0.00, 144.00, 944.00, 944.00, NULL, '2025-08-19 06:56:53', '2025-08-19 06:56:53', NULL),
(17, 11, 0, 'INV-20250818-0006', NULL, '', 800.00, 0.00, 144.00, 944.00, 944.00, NULL, '2025-08-19 06:58:22', '2025-08-19 06:58:22', NULL),
(19, 11, 0, 'INV-20250820-0007', NULL, '', 1005300.00, 0.00, 180954.00, 1186254.00, 1186254.00, NULL, '2025-08-21 00:44:23', '2025-08-21 00:44:23', NULL),
(20, 11, 0, 'INV-20250822-0008', NULL, '', 1600.00, 0.00, 288.00, 1888.00, 1888.00, NULL, '2025-08-22 13:50:32', '2025-08-22 13:50:32', NULL),
(21, 11, 0, 'INV-20250822-0009', NULL, '', 700.00, 0.00, 126.00, 826.00, 826.00, NULL, '2025-08-22 13:51:03', '2025-08-22 13:51:03', NULL),
(22, 3, 0, 'INV-1756137032', NULL, '', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, '2025-08-25 22:50:32', '2025-08-25 22:50:32', NULL),
(23, 15, 0, 'INV-1756137048', NULL, '', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, '2025-08-25 22:50:48', '2025-08-25 22:50:48', NULL),
(24, 3, 0, 'INV-1756138472', NULL, '', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, '2025-08-25 23:14:32', '2025-08-25 23:14:32', NULL),
(25, 16, 0, 'INV-1756167713', NULL, '', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, '2025-08-26 07:21:53', '2025-08-26 07:21:53', NULL),
(27, 16, 0, 'INV-1756167987', NULL, '', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, '2025-08-26 07:26:27', '2025-08-26 07:26:27', NULL),
(28, 3, 0, 'INV-1756168001', NULL, '', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, '2025-08-26 07:26:41', '2025-08-26 07:26:41', NULL),
(29, 10, 0, NULL, NULL, '', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, '2025-08-26 08:05:49', '2025-08-26 08:05:49', NULL),
(30, 10, 0, 'INV-000030', '2025-08-26 08:06:47', '', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, '2025-08-26 08:06:47', '2025-08-26 08:06:47', NULL),
(31, 10, 0, 'INV-000031', '2025-08-26 08:06:59', '', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, '2025-08-26 08:06:59', '2025-08-26 08:06:59', NULL),
(32, 13, 0, 'INV-20250905-0019', NULL, '', 700.00, 0.00, 126.00, 826.00, 826.00, NULL, '2025-09-05 13:31:04', '2025-09-05 13:31:04', NULL),
(33, 12, 0, 'INV-20250905-0020', NULL, '', 62600.00, 0.00, 11268.00, 73868.00, 73868.00, NULL, '2025-09-06 01:48:15', '2025-09-06 01:48:15', NULL),
(34, 12, 0, 'INV-20250905-0021', NULL, '', 62600.00, 0.00, 11268.00, 73868.00, 73868.00, NULL, '2025-09-06 01:48:16', '2025-09-06 01:48:16', NULL),
(35, 12, 0, 'INV-20250905-0022', NULL, '', 62600.00, 0.00, 11268.00, 73868.00, 73868.00, NULL, '2025-09-06 01:48:16', '2025-09-06 01:48:16', NULL),
(36, 12, 0, 'INV-20250905-0023', NULL, '', 800.00, 0.00, 144.00, 944.00, 944.00, NULL, '2025-09-06 01:48:37', '2025-09-06 01:48:37', NULL),
(37, 12, 0, 'INV-000037', '2025-09-08 17:50:59', 'unpaid', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, '2025-09-08 17:50:59', '2025-09-08 17:50:59', NULL),
(43, 19, NULL, 'INV-20251027-0025', NULL, 'issued', 1008500.00, 0.00, 181530.00, 1190030.00, 1190030.00, NULL, '2025-10-28 02:59:15', '2025-10-28 02:59:15', NULL),
(44, 13, NULL, 'INV-20251029-0026', NULL, 'issued', 10008100.00, 0.00, 1801458.00, 11809558.00, 11809558.00, NULL, '2025-10-29 20:19:18', '2025-10-29 20:19:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `qty` decimal(10,2) NOT NULL DEFAULT 1.00,
  `unit_price` decimal(12,2) NOT NULL,
  `line_total` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `invoice_id`, `product_id`, `description`, `qty`, `unit_price`, `line_total`, `created_at`, `updated_at`) VALUES
(44, 12, 3, 'New Bland', 1.00, 700.00, 700.00, '2025-08-15 14:00:05', '2025-08-15 14:00:05'),
(45, 12, 4, 'Laptop', 1.00, 10000.00, 10000.00, '2025-08-15 14:00:05', '2025-08-15 14:00:05'),
(46, 12, 6, 'Phone', 1.00, 500.00, 500.00, '2025-08-15 14:00:05', '2025-08-15 14:00:05'),
(47, 13, 2, 'iPhone', 4.00, 800.00, 3200.00, '2025-08-16 02:31:59', '2025-08-16 02:31:59'),
(48, 13, 3, 'New Bland', 8.00, 700.00, 5600.00, '2025-08-16 02:31:59', '2025-08-16 02:31:59'),
(49, 13, 7, 'Desktop Computers', 1.00, 600.00, 600.00, '2025-08-16 02:31:59', '2025-08-16 02:31:59'),
(50, 13, 5, 'Electric Iron', 13.00, 500.00, 6500.00, '2025-08-16 02:31:59', '2025-08-16 02:31:59'),
(51, 14, 3, 'New Bland', 1.00, 700.00, 700.00, '2025-08-19 06:43:58', '2025-08-19 06:43:58'),
(52, 15, 3, 'New Bland', 1.00, 700.00, 700.00, '2025-08-19 06:56:34', '2025-08-19 06:56:34'),
(53, 16, 2, 'iPhone', 1.00, 800.00, 800.00, '2025-08-19 06:56:53', '2025-08-19 06:56:53'),
(54, 17, 2, 'iPhone', 1.00, 800.00, 800.00, '2025-08-19 06:58:22', '2025-08-19 06:58:22'),
(59, 19, 2, 'iPhone', 4.00, 800.00, 3200.00, '2025-08-21 00:44:23', '2025-08-21 00:44:23'),
(60, 19, 3, 'New Bland', 3.00, 700.00, 2100.00, '2025-08-21 00:44:23', '2025-08-21 00:44:23'),
(61, 19, 8, 'Pianno', 1.00, 1000000.00, 1000000.00, '2025-08-21 00:44:23', '2025-08-21 00:44:23'),
(62, 20, 2, 'iPhone', 2.00, 800.00, 1600.00, '2025-08-22 13:50:32', '2025-08-22 13:50:32'),
(63, 21, 3, 'New Bland', 1.00, 700.00, 700.00, '2025-08-22 13:51:03', '2025-08-22 13:51:03'),
(64, 32, 3, 'New Bland', 1.00, 700.00, 700.00, '2025-09-05 13:31:04', '2025-09-05 13:31:04'),
(65, 33, 4, 'Laptop', 6.00, 10000.00, 60000.00, '2025-09-06 01:48:15', '2025-09-06 01:48:15'),
(66, 33, 5, 'Electric Iron', 4.00, 500.00, 2000.00, '2025-09-06 01:48:15', '2025-09-06 01:48:15'),
(67, 33, 7, 'Desktop Computers', 1.00, 600.00, 600.00, '2025-09-06 01:48:15', '2025-09-06 01:48:15'),
(68, 34, 4, 'Laptop', 6.00, 10000.00, 60000.00, '2025-09-06 01:48:16', '2025-09-06 01:48:16'),
(69, 34, 5, 'Electric Iron', 4.00, 500.00, 2000.00, '2025-09-06 01:48:16', '2025-09-06 01:48:16'),
(70, 34, 7, 'Desktop Computers', 1.00, 600.00, 600.00, '2025-09-06 01:48:16', '2025-09-06 01:48:16'),
(71, 35, 4, 'Laptop', 6.00, 10000.00, 60000.00, '2025-09-06 01:48:16', '2025-09-06 01:48:16'),
(72, 35, 5, 'Electric Iron', 4.00, 500.00, 2000.00, '2025-09-06 01:48:16', '2025-09-06 01:48:16'),
(73, 35, 7, 'Desktop Computers', 1.00, 600.00, 600.00, '2025-09-06 01:48:16', '2025-09-06 01:48:16'),
(74, 36, 2, 'iPhone', 1.00, 800.00, 800.00, '2025-09-06 01:48:37', '2025-09-06 01:48:37'),
(83, 43, 4, 'Laptop', 1.00, 8000.00, 8000.00, '2025-10-28 02:59:15', '2025-10-28 02:59:15'),
(84, 43, 6, 'Phone', 1.00, 500.00, 500.00, '2025-10-28 02:59:15', '2025-10-28 02:59:15'),
(85, 43, 8, 'Pianno', 1.00, 1000000.00, 1000000.00, '2025-10-28 02:59:15', '2025-10-28 02:59:15'),
(86, 44, 2, 'iPhones', 1.00, 10000000.00, 10000000.00, '2025-10-29 20:19:19', '2025-10-29 20:19:19'),
(87, 44, 4, 'Laptop', 1.00, 8000.00, 8000.00, '2025-10-29 20:19:19', '2025-10-29 20:19:19'),
(88, 44, 5, 'Electric Iron', 1.00, 100.00, 100.00, '2025-10-29 20:19:19', '2025-10-29 20:19:19');

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

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"09ef3d32-920a-485b-920a-89016e823ec1\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755634727,\"delay\":null}', 0, NULL, 1755634727, 1755634727),
(2, 'default', '{\"uuid\":\"5b7990dc-3153-4edf-8112-219937833de3\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755634772,\"delay\":null}', 0, NULL, 1755634772, 1755634772),
(3, 'default', '{\"uuid\":\"b56d2d1b-0eb7-4dbc-af80-ce10a725ae05\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755635387,\"delay\":null}', 0, NULL, 1755635387, 1755635387),
(4, 'default', '{\"uuid\":\"1bb11dac-abe9-4d6f-8bc3-fcc7916c891f\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:4;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755643562,\"delay\":null}', 0, NULL, 1755643562, 1755643562),
(5, 'default', '{\"uuid\":\"47f5939b-f07f-454f-be77-6a57ded0c722\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:5;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755643685,\"delay\":null}', 0, NULL, 1755643685, 1755643685),
(6, 'default', '{\"uuid\":\"5735fc29-73b1-4d01-995f-4c1f0f8aa754\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:6;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755644157,\"delay\":null}', 0, NULL, 1755644157, 1755644157),
(7, 'default', '{\"uuid\":\"52c38a44-c47c-4315-b508-d7ce9e785dbb\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:7;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755646252,\"delay\":null}', 0, NULL, 1755646252, 1755646252),
(8, 'default', '{\"uuid\":\"f6149053-b0f0-41e0-a0fa-e6f400134197\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:8;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755646282,\"delay\":null}', 0, NULL, 1755646282, 1755646282),
(9, 'default', '{\"uuid\":\"389d0ba1-2b4a-495f-8a44-85d152998331\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:9;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755646294,\"delay\":null}', 0, NULL, 1755646294, 1755646294),
(10, 'default', '{\"uuid\":\"eb9813ff-ce8f-43f9-8205-eac2633a3b84\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755647713,\"delay\":null}', 0, NULL, 1755647713, 1755647713),
(11, 'default', '{\"uuid\":\"d78adf85-157f-43d4-b10d-1e8fd51f2f37\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:11;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755647930,\"delay\":null}', 0, NULL, 1755647930, 1755647930),
(12, 'default', '{\"uuid\":\"64b66a7f-c140-4d03-a8cf-59fdd8b6928c\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:12;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755696386,\"delay\":null}', 0, NULL, 1755696386, 1755696386),
(13, 'default', '{\"uuid\":\"753eecb0-0cf2-4f28-9adf-d12f952f5fe1\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:13;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755696396,\"delay\":null}', 0, NULL, 1755696396, 1755696396),
(14, 'default', '{\"uuid\":\"907c06bc-66e3-4216-9dc0-0d0fac14b79b\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:14;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755709696,\"delay\":null}', 0, NULL, 1755709696, 1755709696),
(15, 'default', '{\"uuid\":\"fab716cf-a727-472f-b312-795f2d040de8\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:15;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755709697,\"delay\":null}', 0, NULL, 1755709697, 1755709697),
(16, 'default', '{\"uuid\":\"03e7b829-922c-4863-b0a6-8f07c6a6beb5\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:16;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755709697,\"delay\":null}', 0, NULL, 1755709697, 1755709697),
(17, 'default', '{\"uuid\":\"d77acad8-9353-49b1-9e1d-3ec2ca721029\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:17;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755709709,\"delay\":null}', 0, NULL, 1755709709, 1755709709),
(18, 'default', '{\"uuid\":\"43f0cb64-ded5-4249-b6ac-3c69276cbc14\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:18;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755709709,\"delay\":null}', 0, NULL, 1755709709, 1755709709),
(19, 'default', '{\"uuid\":\"465d00b6-2ffd-41e9-8205-19c39d24c125\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:19;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755709714,\"delay\":null}', 0, NULL, 1755709714, 1755709714),
(20, 'default', '{\"uuid\":\"ceea0e17-88f4-446b-aef4-04fcea3d206d\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:20;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755709725,\"delay\":null}', 0, NULL, 1755709725, 1755709725),
(21, 'default', '{\"uuid\":\"4447031a-fd7a-4697-83ee-c0864f394fef\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:21;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755709725,\"delay\":null}', 0, NULL, 1755709725, 1755709725),
(22, 'default', '{\"uuid\":\"5625f5aa-77ad-4b34-baeb-fe4c5f54d68c\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:22;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755709725,\"delay\":null}', 0, NULL, 1755709725, 1755709725),
(23, 'default', '{\"uuid\":\"414b0cfd-64e5-4752-9944-d4c6a6d4948f\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:23;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755709743,\"delay\":null}', 0, NULL, 1755709743, 1755709743),
(24, 'default', '{\"uuid\":\"ed92d0bf-297f-4e22-afa7-87238a59829e\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:24;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755709745,\"delay\":null}', 0, NULL, 1755709745, 1755709745),
(25, 'default', '{\"uuid\":\"5265205d-469a-4768-9d7f-617bcd2105f6\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:25;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755709748,\"delay\":null}', 0, NULL, 1755709748, 1755709748),
(26, 'default', '{\"uuid\":\"1a48623f-ff71-4ecc-88f7-e8b8fdaff250\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:26;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755709751,\"delay\":null}', 0, NULL, 1755709751, 1755709751),
(27, 'default', '{\"uuid\":\"96a78233-ff51-4666-ba0c-cc55e3dd7b3a\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755711087,\"delay\":null}', 0, NULL, 1755711087, 1755711087),
(28, 'default', '{\"uuid\":\"178296bb-24de-4101-b525-9f9b0ec913b3\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:28;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755711140,\"delay\":null}', 0, NULL, 1755711140, 1755711140),
(29, 'default', '{\"uuid\":\"03cdccfb-bb87-49d3-8215-800f7292db4b\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:29;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755711140,\"delay\":null}', 0, NULL, 1755711140, 1755711140),
(30, 'default', '{\"uuid\":\"9d1dbeff-1696-468d-b5c6-d441e1c4f803\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:30;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755711141,\"delay\":null}', 0, NULL, 1755711141, 1755711141),
(31, 'default', '{\"uuid\":\"35b92da5-8a50-4053-b9cb-cb06f6642dac\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:31;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755711142,\"delay\":null}', 0, NULL, 1755711142, 1755711142),
(32, 'default', '{\"uuid\":\"195d72cc-c3d2-4161-86ba-3300e9e08126\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:32;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755711142,\"delay\":null}', 0, NULL, 1755711142, 1755711142),
(33, 'default', '{\"uuid\":\"91609ad6-6361-45da-8eab-1a16942cf5e0\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:33;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755711143,\"delay\":null}', 0, NULL, 1755711143, 1755711143),
(34, 'default', '{\"uuid\":\"0bd8ac3f-00c4-4c21-a160-de3c96bb3264\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:34;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755711149,\"delay\":null}', 0, NULL, 1755711149, 1755711149),
(35, 'default', '{\"uuid\":\"643526b7-32cc-49fd-a5f3-870ba57a9839\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:35;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755711156,\"delay\":null}', 0, NULL, 1755711156, 1755711156),
(36, 'default', '{\"uuid\":\"9280c332-5aee-4e47-92ff-41ead1e3231b\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:36;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755711157,\"delay\":null}', 0, NULL, 1755711157, 1755711157),
(37, 'default', '{\"uuid\":\"f8313d70-a3bf-4312-a3ba-c423c2e4c35f\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:37;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755711160,\"delay\":null}', 0, NULL, 1755711160, 1755711160),
(38, 'default', '{\"uuid\":\"b96338e6-3e3e-41db-80d0-7290bfd504d4\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:38;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755711160,\"delay\":null}', 0, NULL, 1755711160, 1755711160),
(39, 'default', '{\"uuid\":\"7349a4ee-6c07-4aa8-9722-a3f32ca5f551\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:39;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755711165,\"delay\":null}', 0, NULL, 1755711165, 1755711165),
(40, 'default', '{\"uuid\":\"72a4853f-a43b-4499-97fd-a52b5712d554\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:40;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755711166,\"delay\":null}', 0, NULL, 1755711166, 1755711166),
(41, 'default', '{\"uuid\":\"9208b4c1-6611-472e-bc61-d3cb97dcb8f6\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:41;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755711223,\"delay\":null}', 0, NULL, 1755711223, 1755711223);
INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(42, 'default', '{\"uuid\":\"4b6082e9-7217-486c-b547-4c7e1f7c836d\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:42;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755711257,\"delay\":null}', 0, NULL, 1755711257, 1755711257),
(43, 'default', '{\"uuid\":\"722c2da3-7e45-4dc2-8176-ec89a8532a96\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:43;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755711526,\"delay\":null}', 0, NULL, 1755711526, 1755711526),
(44, 'default', '{\"uuid\":\"d57deb63-0c44-4588-9dee-6de3c2beb2a3\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:44;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755711863,\"delay\":null}', 0, NULL, 1755711863, 1755711863),
(45, 'default', '{\"uuid\":\"72737ca2-c083-4718-b07b-fdf44b18ed0d\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:45;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755711959,\"delay\":null}', 0, NULL, 1755711959, 1755711959),
(46, 'default', '{\"uuid\":\"cef874f4-c7c3-4960-b6f7-5dc948e6b097\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:46;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755712049,\"delay\":null}', 0, NULL, 1755712049, 1755712049),
(47, 'default', '{\"uuid\":\"d1010b13-9327-430e-92cd-2f2cb67aaf65\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:47;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755712149,\"delay\":null}', 0, NULL, 1755712149, 1755712149),
(48, 'default', '{\"uuid\":\"b1109095-9d1f-4e36-b3be-056c8a3ab417\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:48;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755799335,\"delay\":null}', 0, NULL, 1755799335, 1755799335),
(49, 'default', '{\"uuid\":\"346197fd-1070-417e-be49-24fa120c2b98\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:49;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755799810,\"delay\":null}', 0, NULL, 1755799810, 1755799810),
(50, 'default', '{\"uuid\":\"30946cdd-fb8a-4284-9c75-1da91668211f\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:50;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755799819,\"delay\":null}', 0, NULL, 1755799819, 1755799819),
(51, 'default', '{\"uuid\":\"5dbb68ad-194a-48ca-9431-4b5066aea761\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:51;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755799846,\"delay\":null}', 0, NULL, 1755799846, 1755799846),
(52, 'default', '{\"uuid\":\"a53d13b9-dc8b-4316-95ef-d8a0d453d943\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:52;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755799959,\"delay\":null}', 0, NULL, 1755799959, 1755799959),
(53, 'default', '{\"uuid\":\"1da6d9a1-3067-4764-91fa-456ebb093bdf\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:53;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755799959,\"delay\":null}', 0, NULL, 1755799959, 1755799959),
(54, 'default', '{\"uuid\":\"7f6277fe-0eb6-4b67-a1bd-6fe3101ba706\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:54;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755800404,\"delay\":null}', 0, NULL, 1755800404, 1755800404),
(55, 'default', '{\"uuid\":\"b97e2b71-19c2-4c6f-a416-53c47930c2ec\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:55;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755800418,\"delay\":null}', 0, NULL, 1755800418, 1755800418),
(56, 'default', '{\"uuid\":\"516cf468-26cc-4d81-8e8e-efcef285de84\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:56;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755800430,\"delay\":null}', 0, NULL, 1755800430, 1755800430),
(57, 'default', '{\"uuid\":\"3e32da32-9a6c-48c7-a5b4-4e55bb3f80d8\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:57;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755801445,\"delay\":null}', 0, NULL, 1755801445, 1755801445),
(58, 'default', '{\"uuid\":\"9d7060e4-8712-4d81-974c-f22527688b58\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:58;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755801484,\"delay\":null}', 0, NULL, 1755801484, 1755801484),
(59, 'default', '{\"uuid\":\"a62e4598-6ca0-4dda-bedb-473f0c05ad87\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:59;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755819076,\"delay\":null}', 0, NULL, 1755819076, 1755819076),
(60, 'default', '{\"uuid\":\"9fa33d12-2b9f-4dfc-8506-edd24c0178a3\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:60;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755840163,\"delay\":null}', 0, NULL, 1755840163, 1755840163),
(61, 'default', '{\"uuid\":\"16eee465-3ac5-4274-8948-af77da65e0c4\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:61;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755844743,\"delay\":null}', 0, NULL, 1755844743, 1755844743),
(62, 'default', '{\"uuid\":\"06ce27e4-b059-4433-aea7-4f36e1e827eb\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:62;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755844921,\"delay\":null}', 0, NULL, 1755844921, 1755844921),
(63, 'default', '{\"uuid\":\"2088de99-2189-4b62-b07e-b5f8ce9d9eeb\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:63;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755844933,\"delay\":null}', 0, NULL, 1755844933, 1755844933),
(64, 'default', '{\"uuid\":\"bf3f9e10-4d68-4272-91f2-f374375c803b\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:64;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755844977,\"delay\":null}', 0, NULL, 1755844977, 1755844977),
(65, 'default', '{\"uuid\":\"4a74afa9-c0c0-4b20-b97c-72a3a9361b9b\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:65;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755845026,\"delay\":null}', 0, NULL, 1755845026, 1755845026),
(66, 'default', '{\"uuid\":\"05d41b96-1158-48a5-9834-77b738303f54\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:66;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755845047,\"delay\":null}', 0, NULL, 1755845047, 1755845047),
(67, 'default', '{\"uuid\":\"1b359210-99c4-4a9c-a888-06d93261feac\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:67;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755845055,\"delay\":null}', 0, NULL, 1755845055, 1755845055),
(68, 'default', '{\"uuid\":\"7b0a61c5-68a7-4df8-96d9-5b8e96e82f14\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:68;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755845065,\"delay\":null}', 0, NULL, 1755845065, 1755845065),
(69, 'default', '{\"uuid\":\"123ee952-dc74-47bb-9f1b-f399ea087c09\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:69;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755845137,\"delay\":null}', 0, NULL, 1755845137, 1755845137),
(70, 'default', '{\"uuid\":\"effdf6f3-c30e-4ac6-8213-76b37943738e\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:70;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755845165,\"delay\":null}', 0, NULL, 1755845165, 1755845165),
(71, 'default', '{\"uuid\":\"1d0b9d6f-2917-488b-8e1a-1e0d21b4aff7\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:71;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755845173,\"delay\":null}', 0, NULL, 1755845173, 1755845173),
(72, 'default', '{\"uuid\":\"ab614341-b69b-4453-80c6-2ab5b4fe37ea\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:72;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755845192,\"delay\":null}', 0, NULL, 1755845192, 1755845192),
(73, 'default', '{\"uuid\":\"090208fa-a9db-495b-a10f-33a4d9ecd70f\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:73;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755845213,\"delay\":null}', 0, NULL, 1755845213, 1755845213),
(74, 'default', '{\"uuid\":\"eafde0a9-25da-48dc-90ca-7aecf542b6da\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:74;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755845283,\"delay\":null}', 0, NULL, 1755845283, 1755845283),
(75, 'default', '{\"uuid\":\"d38c9a31-d40b-4a95-862f-8f0c4f3e7d30\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:75;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755845432,\"delay\":null}', 0, NULL, 1755845432, 1755845432),
(76, 'default', '{\"uuid\":\"e62dbe10-a142-49e6-9f8f-00400eed15c5\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:76;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755845463,\"delay\":null}', 0, NULL, 1755845463, 1755845463),
(77, 'default', '{\"uuid\":\"eb4b53f5-8d3d-46a6-8eb6-73fbefbba020\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:77;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755845565,\"delay\":null}', 0, NULL, 1755845565, 1755845565),
(78, 'default', '{\"uuid\":\"00f22daf-42d4-486c-b781-234ae7d7716a\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:78;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755845614,\"delay\":null}', 0, NULL, 1755845614, 1755845614),
(79, 'default', '{\"uuid\":\"393842d1-cd82-48be-bc64-dc81d5b6df66\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:79;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755845676,\"delay\":null}', 0, NULL, 1755845676, 1755845676),
(80, 'default', '{\"uuid\":\"5d534210-b9a4-49a5-a774-5f0f790ee191\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:80;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755845681,\"delay\":null}', 0, NULL, 1755845681, 1755845681),
(81, 'default', '{\"uuid\":\"80b72705-9a05-485d-9acb-461670593a8a\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:81;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755845747,\"delay\":null}', 0, NULL, 1755845747, 1755845747),
(82, 'default', '{\"uuid\":\"caa333ee-f234-4d03-9e0b-7db63feb9a85\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:82;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755846293,\"delay\":null}', 0, NULL, 1755846293, 1755846293);
INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(83, 'default', '{\"uuid\":\"96e5f212-ce82-4472-a7ce-a0a0850306f8\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:83;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755846349,\"delay\":null}', 0, NULL, 1755846349, 1755846349),
(84, 'default', '{\"uuid\":\"ff25b62c-e72a-48fe-9cba-e9427fea4445\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:84;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755846375,\"delay\":null}', 0, NULL, 1755846375, 1755846375),
(85, 'default', '{\"uuid\":\"fad0d22d-8b4c-4d96-be41-537c07fd23f7\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:85;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755846410,\"delay\":null}', 0, NULL, 1755846410, 1755846410),
(86, 'default', '{\"uuid\":\"c16873be-d31c-4e7d-9f95-221407a2f02f\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:86;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755846449,\"delay\":null}', 0, NULL, 1755846449, 1755846449),
(87, 'default', '{\"uuid\":\"0b9b45b5-4d7a-4b1c-9f6f-d193bf448bd8\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:87;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755846465,\"delay\":null}', 0, NULL, 1755846465, 1755846465),
(88, 'default', '{\"uuid\":\"5e9476fb-b2fb-4e6a-88c7-e6435099f960\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:88;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755846514,\"delay\":null}', 0, NULL, 1755846514, 1755846514),
(89, 'default', '{\"uuid\":\"93d2edf1-d60e-4425-802d-21e9dad8b329\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:89;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755846585,\"delay\":null}', 0, NULL, 1755846585, 1755846585),
(90, 'default', '{\"uuid\":\"005d7c46-09c2-4520-9c8d-d8ee8d73211c\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:90;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755846654,\"delay\":null}', 0, NULL, 1755846654, 1755846654),
(91, 'default', '{\"uuid\":\"7457df61-24a3-47c5-9f59-b8198ff81f06\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:91;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755846666,\"delay\":null}', 0, NULL, 1755846666, 1755846666),
(92, 'default', '{\"uuid\":\"7b7a50dc-5c2c-4906-830c-23608ef68b7c\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:92;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755851002,\"delay\":null}', 0, NULL, 1755851002, 1755851002),
(93, 'default', '{\"uuid\":\"ad30873c-e85a-4bc1-9b05-21d914a50e33\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:93;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755851099,\"delay\":null}', 0, NULL, 1755851099, 1755851099),
(94, 'default', '{\"uuid\":\"a8208242-70c9-4e51-be5a-a423a9240ed6\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:94;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755851147,\"delay\":null}', 0, NULL, 1755851147, 1755851147),
(95, 'default', '{\"uuid\":\"b7de87f4-c06d-403a-8013-8ab6c7ffee15\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:95;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755851171,\"delay\":null}', 0, NULL, 1755851171, 1755851171),
(96, 'default', '{\"uuid\":\"dc644f39-6dee-4c10-8542-93029a7b7874\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:96;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755851191,\"delay\":null}', 0, NULL, 1755851191, 1755851191),
(97, 'default', '{\"uuid\":\"8becd2eb-a1ae-4084-84d9-e98d83b729eb\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:97;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755851229,\"delay\":null}', 0, NULL, 1755851229, 1755851229),
(98, 'default', '{\"uuid\":\"a5b64eaf-94e1-4851-8253-64fe0152007b\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:98;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755851264,\"delay\":null}', 0, NULL, 1755851264, 1755851264),
(99, 'default', '{\"uuid\":\"506f3c87-7b2a-4e08-b2d4-d289aea5a17b\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:99;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755851295,\"delay\":null}', 0, NULL, 1755851295, 1755851295),
(100, 'default', '{\"uuid\":\"977bfb6f-5ab6-494b-a63b-221dfbe2b93e\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:100;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755851374,\"delay\":null}', 0, NULL, 1755851374, 1755851374),
(101, 'default', '{\"uuid\":\"5b40cdce-5cd7-4171-8079-1ddb68fb58ce\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:101;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755851378,\"delay\":null}', 0, NULL, 1755851378, 1755851378),
(102, 'default', '{\"uuid\":\"3637d4c7-1f0a-4fb0-ae81-dade8835791f\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:102;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755851915,\"delay\":null}', 0, NULL, 1755851915, 1755851915),
(103, 'default', '{\"uuid\":\"37bedd4a-84bb-439d-8399-a3ab0d7c5d9a\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:103;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755851969,\"delay\":null}', 0, NULL, 1755851969, 1755851969),
(104, 'default', '{\"uuid\":\"72400242-6a60-40f5-aeca-afdfa3560013\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:104;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755852023,\"delay\":null}', 0, NULL, 1755852023, 1755852023),
(105, 'default', '{\"uuid\":\"6580f245-0aba-4e13-b966-6eae2928d342\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:105;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755852036,\"delay\":null}', 0, NULL, 1755852036, 1755852036),
(106, 'default', '{\"uuid\":\"9e9a256f-91f8-47b7-abfa-640caa2b4847\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:106;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755852052,\"delay\":null}', 0, NULL, 1755852052, 1755852052),
(107, 'default', '{\"uuid\":\"43c87de8-ce36-4944-accc-5020be0fca72\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:107;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755852061,\"delay\":null}', 0, NULL, 1755852061, 1755852061),
(108, 'default', '{\"uuid\":\"87cae873-a032-4922-b259-6992a98a9403\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:108;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755852080,\"delay\":null}', 0, NULL, 1755852080, 1755852080),
(109, 'default', '{\"uuid\":\"8ca9863e-da6e-4806-afe3-293a4fc55e5a\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:109;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755852092,\"delay\":null}', 0, NULL, 1755852092, 1755852092),
(110, 'default', '{\"uuid\":\"d23cf406-55ff-41bd-b8dc-350a2151fc40\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:110;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755853282,\"delay\":null}', 0, NULL, 1755853282, 1755853282),
(111, 'default', '{\"uuid\":\"3887e02b-d3a7-46fc-9c13-f70145284f34\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:111;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755853287,\"delay\":null}', 0, NULL, 1755853287, 1755853287),
(112, 'default', '{\"uuid\":\"c1836d10-6f33-4c5c-b98f-d836a1880a2e\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:112;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755853346,\"delay\":null}', 0, NULL, 1755853346, 1755853346),
(113, 'default', '{\"uuid\":\"2792ca42-7aa8-4c60-b52d-08ce7335d553\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:113;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755853982,\"delay\":null}', 0, NULL, 1755853982, 1755853982),
(114, 'default', '{\"uuid\":\"309f3245-fffc-47b3-b3b1-d718d644c5d9\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:114;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755854577,\"delay\":null}', 0, NULL, 1755854577, 1755854577),
(115, 'default', '{\"uuid\":\"138bde75-6820-436a-b3fb-f582e18c4f7f\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:115;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755854597,\"delay\":null}', 0, NULL, 1755854597, 1755854597),
(116, 'default', '{\"uuid\":\"d0aebe08-3271-4f6a-ae80-23fe21b5df79\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:116;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755854687,\"delay\":null}', 0, NULL, 1755854687, 1755854687),
(117, 'default', '{\"uuid\":\"449db9ff-f955-403d-a174-fa83d92643ce\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:117;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755854743,\"delay\":null}', 0, NULL, 1755854743, 1755854743),
(118, 'default', '{\"uuid\":\"2e2d6887-3992-41e7-b802-e748e7e39a21\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:118;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755856878,\"delay\":null}', 0, NULL, 1755856878, 1755856878),
(119, 'default', '{\"uuid\":\"27649d8f-eb48-445b-a78d-d272e7ed8cad\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:119;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755856895,\"delay\":null}', 0, NULL, 1755856895, 1755856895),
(120, 'default', '{\"uuid\":\"a640f6ca-a4aa-4af6-ac92-93325b47d028\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:120;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755856901,\"delay\":null}', 0, NULL, 1755856901, 1755856901),
(121, 'default', '{\"uuid\":\"7d0bfdd9-25ca-4cb7-8887-7c0649d83ebe\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:121;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755856906,\"delay\":null}', 0, NULL, 1755856906, 1755856906),
(122, 'default', '{\"uuid\":\"8769c25f-4cd1-4b86-8daf-7350d89660a7\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:122;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755856964,\"delay\":null}', 0, NULL, 1755856964, 1755856964),
(123, 'default', '{\"uuid\":\"7f28065a-3916-489f-9ac3-e530790fdf98\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:123;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755857097,\"delay\":null}', 0, NULL, 1755857097, 1755857097);
INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(124, 'default', '{\"uuid\":\"276541f3-e79e-47a3-af46-4c149e30477a\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:124;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755857203,\"delay\":null}', 0, NULL, 1755857203, 1755857203),
(125, 'default', '{\"uuid\":\"18f8eb98-0571-4656-a565-a31195d7709d\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:125;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755857466,\"delay\":null}', 0, NULL, 1755857466, 1755857466),
(126, 'default', '{\"uuid\":\"33cc3e70-5d0c-40cc-be91-08067e2a9392\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:126;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755857520,\"delay\":null}', 0, NULL, 1755857520, 1755857520),
(127, 'default', '{\"uuid\":\"95ca02db-ef11-4a7c-8138-09d933bb06b1\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:127;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755857664,\"delay\":null}', 0, NULL, 1755857664, 1755857664),
(128, 'default', '{\"uuid\":\"b9840a72-df8f-42c7-856e-cd22e2326cd1\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:128;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755857666,\"delay\":null}', 0, NULL, 1755857666, 1755857666),
(129, 'default', '{\"uuid\":\"681070e0-b217-42ee-a32a-9c26fc070e53\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:129;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755857841,\"delay\":null}', 0, NULL, 1755857841, 1755857841),
(130, 'default', '{\"uuid\":\"bbfb664d-f855-479f-8010-fe4aa02f37c8\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:130;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1755857901,\"delay\":null}', 0, NULL, 1755857901, 1755857901),
(131, 'default', '{\"uuid\":\"d8180146-01fa-4163-87e1-4aafd08ec9b8\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:131;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756003781,\"delay\":null}', 0, NULL, 1756003781, 1756003781),
(132, 'default', '{\"uuid\":\"beeacdcf-833f-4deb-9622-4af18c6c5f68\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:132;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756003796,\"delay\":null}', 0, NULL, 1756003796, 1756003796),
(133, 'default', '{\"uuid\":\"e9349a69-e78a-4b19-8283-4ccaf953b019\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:133;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756003817,\"delay\":null}', 0, NULL, 1756003817, 1756003817),
(134, 'default', '{\"uuid\":\"60bc0c9e-3774-4000-9613-311d45809178\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:134;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756003848,\"delay\":null}', 0, NULL, 1756003848, 1756003848),
(135, 'default', '{\"uuid\":\"5b118792-83a4-41cc-b83c-d34e3fd50358\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:135;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756006434,\"delay\":null}', 0, NULL, 1756006435, 1756006435),
(136, 'default', '{\"uuid\":\"e0e9bfff-17ad-482d-84d4-91c67d6f2edb\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:136;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756006489,\"delay\":null}', 0, NULL, 1756006489, 1756006489),
(137, 'default', '{\"uuid\":\"4e02bfa5-3223-442b-bf47-8379e4378c25\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:137;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756006683,\"delay\":null}', 0, NULL, 1756006683, 1756006683),
(138, 'default', '{\"uuid\":\"8da63b2b-4361-4637-8588-810b1310f689\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:138;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756023493,\"delay\":null}', 0, NULL, 1756023493, 1756023493),
(139, 'default', '{\"uuid\":\"51ee7f63-d88a-4fa3-b1fa-420dd62cb3f1\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:139;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756175417,\"delay\":null}', 0, NULL, 1756175417, 1756175417),
(140, 'default', '{\"uuid\":\"25b5dc90-7230-48a3-a759-a39f5a7a3fb6\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:140;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756175440,\"delay\":null}', 0, NULL, 1756175440, 1756175440),
(141, 'default', '{\"uuid\":\"8476305d-42e7-4a38-a9d0-3621892c70c7\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:141;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756175453,\"delay\":null}', 0, NULL, 1756175453, 1756175453),
(142, 'default', '{\"uuid\":\"06761085-3c1c-42ca-8d81-0000f9bd3aae\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:142;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756175576,\"delay\":null}', 0, NULL, 1756175576, 1756175576),
(143, 'default', '{\"uuid\":\"fca272aa-64aa-4183-9953-06e1da7b0bb7\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:143;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756175919,\"delay\":null}', 0, NULL, 1756175919, 1756175919),
(144, 'default', '{\"uuid\":\"cafa599f-042b-4a4a-8ea3-ec59a10b7527\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:144;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756176364,\"delay\":null}', 0, NULL, 1756176364, 1756176364),
(145, 'default', '{\"uuid\":\"a69c35df-64f5-41d2-862a-22f6ad1e2856\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:145;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756176662,\"delay\":null}', 0, NULL, 1756176662, 1756176662),
(146, 'default', '{\"uuid\":\"9adf13aa-c0bc-421e-92ce-2bb0b4848442\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:146;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756177857,\"delay\":null}', 0, NULL, 1756177857, 1756177857),
(147, 'default', '{\"uuid\":\"d0565c20-a340-422a-b6a4-0f095fc8b3c0\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:147;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756178424,\"delay\":null}', 0, NULL, 1756178424, 1756178424),
(148, 'default', '{\"uuid\":\"5ab0b761-6644-41e6-9b21-824e326a22b3\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:148;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756178424,\"delay\":null}', 0, NULL, 1756178424, 1756178424),
(149, 'default', '{\"uuid\":\"30393b17-3c61-462d-9ebe-ffe9c6af731c\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:149;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756178433,\"delay\":null}', 0, NULL, 1756178433, 1756178433),
(150, 'default', '{\"uuid\":\"002f32c4-c9c8-48ec-8469-f4b59d25c9f4\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:150;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756178433,\"delay\":null}', 0, NULL, 1756178433, 1756178433),
(151, 'default', '{\"uuid\":\"f8c3e9b2-0d97-4b60-b2bc-59b12810a1b1\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:151;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756178441,\"delay\":null}', 0, NULL, 1756178441, 1756178441),
(152, 'default', '{\"uuid\":\"9d075efd-e48b-447c-94c8-d6a5eea0f3b1\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:152;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756178441,\"delay\":null}', 0, NULL, 1756178441, 1756178441),
(153, 'default', '{\"uuid\":\"d662d1e0-a579-415a-875a-470446a88345\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:153;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756178640,\"delay\":null}', 0, NULL, 1756178640, 1756178640),
(154, 'default', '{\"uuid\":\"c2eff8fb-058d-4c2b-8660-3a8603079a23\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:154;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756178641,\"delay\":null}', 0, NULL, 1756178641, 1756178641),
(155, 'default', '{\"uuid\":\"3a539d52-e573-4e4a-bccf-509e581c949a\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:155;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756178654,\"delay\":null}', 0, NULL, 1756178654, 1756178654),
(156, 'default', '{\"uuid\":\"e3355e45-c29b-42dd-816e-8bdde6e5fb18\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:156;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756178655,\"delay\":null}', 0, NULL, 1756178655, 1756178655),
(157, 'default', '{\"uuid\":\"24182863-dba1-488e-a092-275ae2b94cc9\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:157;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756178847,\"delay\":null}', 0, NULL, 1756178847, 1756178847),
(158, 'default', '{\"uuid\":\"b6ecfdb1-4b37-4368-a5df-c33e30777481\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:158;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756178847,\"delay\":null}', 0, NULL, 1756178847, 1756178847),
(159, 'default', '{\"uuid\":\"f5e3129e-bff1-4afb-9b20-a414dfd76019\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:159;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179061,\"delay\":null}', 0, NULL, 1756179061, 1756179061),
(160, 'default', '{\"uuid\":\"e99f1d45-bc25-41fa-894e-466d9fa76a82\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:160;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179061,\"delay\":null}', 0, NULL, 1756179061, 1756179061),
(161, 'default', '{\"uuid\":\"aa04f930-7cb1-4dd6-9b71-1dd4c363fe14\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:161;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179093,\"delay\":null}', 0, NULL, 1756179093, 1756179093),
(162, 'default', '{\"uuid\":\"bda35f81-6047-44b4-bfc8-0c270d5f60f5\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:162;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179093,\"delay\":null}', 0, NULL, 1756179093, 1756179093),
(163, 'default', '{\"uuid\":\"4ee5e788-373e-45ec-b7ae-4cadaace5c16\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:163;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179159,\"delay\":null}', 0, NULL, 1756179159, 1756179159),
(164, 'default', '{\"uuid\":\"822678ba-4dfd-4cd2-9028-1b2434c46dfb\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:164;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179159,\"delay\":null}', 0, NULL, 1756179159, 1756179159);
INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(165, 'default', '{\"uuid\":\"98a4265c-3e8f-4b92-9b7e-43dccb5977c1\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:165;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179159,\"delay\":null}', 0, NULL, 1756179159, 1756179159),
(166, 'default', '{\"uuid\":\"b08f9f14-a16d-4b6f-940b-b51f5e3001b1\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:166;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179160,\"delay\":null}', 0, NULL, 1756179160, 1756179160),
(167, 'default', '{\"uuid\":\"63118f07-b044-49e8-92d8-db5a94cbcd56\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:167;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179274,\"delay\":null}', 0, NULL, 1756179274, 1756179274),
(168, 'default', '{\"uuid\":\"e38e3600-c89b-4354-9652-927c06e62330\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:168;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179302,\"delay\":null}', 0, NULL, 1756179302, 1756179302),
(169, 'default', '{\"uuid\":\"a78da65f-7c63-4e91-8840-66102bbdac09\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:169;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179304,\"delay\":null}', 0, NULL, 1756179304, 1756179304),
(170, 'default', '{\"uuid\":\"546fe76a-2892-4f49-bd0c-c28d617b29c3\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:170;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179306,\"delay\":null}', 0, NULL, 1756179306, 1756179306),
(171, 'default', '{\"uuid\":\"b8bc38c9-9096-4f4b-a8ed-1baee5ad6ebd\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:171;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179309,\"delay\":null}', 0, NULL, 1756179309, 1756179309),
(172, 'default', '{\"uuid\":\"309c9436-84c1-4cdf-ac68-b7aae0ace611\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:172;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179317,\"delay\":null}', 0, NULL, 1756179317, 1756179317),
(173, 'default', '{\"uuid\":\"c64e154f-b825-4149-960e-3717b08509de\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:173;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179318,\"delay\":null}', 0, NULL, 1756179318, 1756179318),
(174, 'default', '{\"uuid\":\"1e830915-7512-4d19-ac07-4d11a909f8a6\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:174;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179320,\"delay\":null}', 0, NULL, 1756179320, 1756179320),
(175, 'default', '{\"uuid\":\"d3e152cb-7f61-499d-af7e-a9111d0aed97\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:175;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179321,\"delay\":null}', 0, NULL, 1756179321, 1756179321),
(176, 'default', '{\"uuid\":\"6fba0865-0699-4082-b15d-d762dc0a3200\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:176;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179323,\"delay\":null}', 0, NULL, 1756179323, 1756179323),
(177, 'default', '{\"uuid\":\"80eea092-84d5-4443-80fc-bd4ce59508e1\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:177;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179324,\"delay\":null}', 0, NULL, 1756179324, 1756179324),
(178, 'default', '{\"uuid\":\"98d97d41-cf51-4d25-a801-43e1386e49ab\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:178;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179326,\"delay\":null}', 0, NULL, 1756179326, 1756179326),
(179, 'default', '{\"uuid\":\"71767a40-0210-4867-86d6-3639744ca6fc\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:179;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179326,\"delay\":null}', 0, NULL, 1756179326, 1756179326),
(180, 'default', '{\"uuid\":\"e01dbec0-3c0d-4647-9d71-82960e5a377b\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:180;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179328,\"delay\":null}', 0, NULL, 1756179328, 1756179328),
(181, 'default', '{\"uuid\":\"1c659bdd-827c-4f34-9030-0af21e785087\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:181;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179329,\"delay\":null}', 0, NULL, 1756179329, 1756179329),
(182, 'default', '{\"uuid\":\"6aa87af6-a99a-4e44-9ec3-1290b97f8dc3\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:182;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179330,\"delay\":null}', 0, NULL, 1756179330, 1756179330),
(183, 'default', '{\"uuid\":\"b0b36bc7-ac5c-4d45-b154-12cac64f3aca\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:183;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179331,\"delay\":null}', 0, NULL, 1756179331, 1756179331),
(184, 'default', '{\"uuid\":\"02c4569f-b921-49b6-b223-36d1d9e5e408\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:184;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179333,\"delay\":null}', 0, NULL, 1756179333, 1756179333),
(185, 'default', '{\"uuid\":\"9517853e-cdbb-4007-9c1b-8bdb2d41f684\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:185;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179334,\"delay\":null}', 0, NULL, 1756179334, 1756179334),
(186, 'default', '{\"uuid\":\"989281e3-3ded-4392-a385-49c98f10e108\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:186;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179336,\"delay\":null}', 0, NULL, 1756179336, 1756179336),
(187, 'default', '{\"uuid\":\"a7febe21-4256-4e6a-9072-01fa7e0cc85b\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:187;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179336,\"delay\":null}', 0, NULL, 1756179336, 1756179336),
(188, 'default', '{\"uuid\":\"7eeefb35-6a6f-4c93-976c-9c6ff0e6f7cc\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:188;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179338,\"delay\":null}', 0, NULL, 1756179338, 1756179338),
(189, 'default', '{\"uuid\":\"88faccc7-e48d-46f6-bf64-ebed852609e3\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:189;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179339,\"delay\":null}', 0, NULL, 1756179339, 1756179339),
(190, 'default', '{\"uuid\":\"9f50697b-755b-4521-be7a-94ba710b0040\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:190;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179341,\"delay\":null}', 0, NULL, 1756179341, 1756179341),
(191, 'default', '{\"uuid\":\"7550151c-5be7-43d1-8446-22ac40511763\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:191;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179341,\"delay\":null}', 0, NULL, 1756179341, 1756179341),
(192, 'default', '{\"uuid\":\"96a8a843-3cd8-44c4-b900-5f1bf1aa5a21\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:192;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179343,\"delay\":null}', 0, NULL, 1756179343, 1756179343),
(193, 'default', '{\"uuid\":\"0497b6ba-0889-4323-a9f1-2e12659dd620\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:193;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179344,\"delay\":null}', 0, NULL, 1756179344, 1756179344),
(194, 'default', '{\"uuid\":\"1a8cb585-3701-42b1-81db-4b35a3319b93\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:194;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179345,\"delay\":null}', 0, NULL, 1756179345, 1756179345),
(195, 'default', '{\"uuid\":\"bd8dec68-d7bf-4496-a194-7bfb2e8bbf6b\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:195;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179346,\"delay\":null}', 0, NULL, 1756179346, 1756179346),
(196, 'default', '{\"uuid\":\"a7c501aa-876a-4f4a-9358-a2c014484de9\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:196;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179348,\"delay\":null}', 0, NULL, 1756179348, 1756179348),
(197, 'default', '{\"uuid\":\"597bdeff-28eb-492e-ad33-1b2e732b923f\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:197;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179348,\"delay\":null}', 0, NULL, 1756179348, 1756179348),
(198, 'default', '{\"uuid\":\"0494709e-47fa-491a-bf74-0f125ada99ac\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:198;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179351,\"delay\":null}', 0, NULL, 1756179351, 1756179351),
(199, 'default', '{\"uuid\":\"c100e574-9151-43ca-abf6-78e38bb0676a\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:199;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179351,\"delay\":null}', 0, NULL, 1756179351, 1756179351),
(200, 'default', '{\"uuid\":\"be2ffb91-d5f2-44db-a73e-afcbb76a5fa7\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:200;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179359,\"delay\":null}', 0, NULL, 1756179359, 1756179359),
(201, 'default', '{\"uuid\":\"996676b7-2a90-4f9e-afd5-65ecee7e1320\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:201;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179376,\"delay\":null}', 0, NULL, 1756179376, 1756179376),
(202, 'default', '{\"uuid\":\"885b948f-9d08-4a75-9bd8-1f5f32f7a319\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:202;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179379,\"delay\":null}', 0, NULL, 1756179379, 1756179379),
(203, 'default', '{\"uuid\":\"503f5057-ddbf-4219-b382-cb68edcf9985\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:203;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179739,\"delay\":null}', 0, NULL, 1756179739, 1756179739),
(204, 'default', '{\"uuid\":\"1fe98c22-79cb-4106-8afc-79135e1b6407\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:204;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179748,\"delay\":null}', 0, NULL, 1756179748, 1756179748),
(205, 'default', '{\"uuid\":\"d5780039-123b-4dd4-b85c-656fee6cae4f\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:205;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179763,\"delay\":null}', 0, NULL, 1756179763, 1756179763);
INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(206, 'default', '{\"uuid\":\"66e2ae2e-209c-467e-adcc-f8e1f05db1d6\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:206;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179770,\"delay\":null}', 0, NULL, 1756179770, 1756179770),
(207, 'default', '{\"uuid\":\"3971d478-1dc2-4e54-9e39-624d2c7711e8\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:207;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179792,\"delay\":null}', 0, NULL, 1756179792, 1756179792),
(208, 'default', '{\"uuid\":\"77a07a55-dcef-4316-825e-5f8b7341397a\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:208;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179809,\"delay\":null}', 0, NULL, 1756179809, 1756179809),
(209, 'default', '{\"uuid\":\"a7b88b50-5c3c-4154-8038-77164c98c74c\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:209;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179810,\"delay\":null}', 0, NULL, 1756179810, 1756179810),
(210, 'default', '{\"uuid\":\"29d38e52-9ca9-4274-8208-be0adc24f3f0\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:210;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179813,\"delay\":null}', 0, NULL, 1756179813, 1756179813),
(211, 'default', '{\"uuid\":\"66f8aad8-53c3-422c-975e-497402eef723\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:211;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179817,\"delay\":null}', 0, NULL, 1756179817, 1756179817),
(212, 'default', '{\"uuid\":\"43132b61-f5fb-4653-9b19-c116d5a7b6c4\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:212;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179817,\"delay\":null}', 0, NULL, 1756179817, 1756179817),
(213, 'default', '{\"uuid\":\"f9c4011d-83c2-43ca-aeb9-cf59220734ad\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:213;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179820,\"delay\":null}', 0, NULL, 1756179820, 1756179820),
(214, 'default', '{\"uuid\":\"11ae744e-6145-4e56-9307-7e5de3321f73\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:214;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179821,\"delay\":null}', 0, NULL, 1756179821, 1756179821),
(215, 'default', '{\"uuid\":\"9a65fbed-6e46-4fc8-95a9-34f80b4cebfe\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:215;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179823,\"delay\":null}', 0, NULL, 1756179823, 1756179823),
(216, 'default', '{\"uuid\":\"42a3e867-508a-4983-b8d9-034be2c3402a\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:216;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179824,\"delay\":null}', 0, NULL, 1756179824, 1756179824),
(217, 'default', '{\"uuid\":\"337278ff-ccbe-4372-aaa1-16fcfeb80cf1\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:217;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179827,\"delay\":null}', 0, NULL, 1756179827, 1756179827),
(218, 'default', '{\"uuid\":\"0eca48ad-9e10-4fad-8dcb-e664a94f485a\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:218;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179827,\"delay\":null}', 0, NULL, 1756179827, 1756179827),
(219, 'default', '{\"uuid\":\"6df6b6cf-4bb6-462e-8e5a-c154345d5f6e\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:219;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179831,\"delay\":null}', 0, NULL, 1756179831, 1756179831),
(220, 'default', '{\"uuid\":\"5302f71f-634e-4898-93ae-8cfce7c7fbb4\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:220;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179831,\"delay\":null}', 0, NULL, 1756179831, 1756179831),
(221, 'default', '{\"uuid\":\"54e97f6e-b031-4726-9685-e5345a6850ec\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:221;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179831,\"delay\":null}', 0, NULL, 1756179831, 1756179831),
(222, 'default', '{\"uuid\":\"e5bf9226-c046-4105-83f2-a964b48f671d\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:222;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179832,\"delay\":null}', 0, NULL, 1756179832, 1756179832),
(223, 'default', '{\"uuid\":\"344a3a9b-3e73-48c0-a706-45bf3016ea1c\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:223;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756179835,\"delay\":null}', 0, NULL, 1756179835, 1756179835),
(224, 'default', '{\"uuid\":\"7bd043f8-ddcc-4a74-a9ed-60dd0c4f48aa\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:224;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756180009,\"delay\":null}', 0, NULL, 1756180009, 1756180009),
(225, 'default', '{\"uuid\":\"f1455195-9faf-483b-9fa3-7c82b2af6583\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:225;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756180039,\"delay\":null}', 0, NULL, 1756180039, 1756180039),
(226, 'default', '{\"uuid\":\"1ba0e717-5753-4692-b060-6087a18a1edd\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:226;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756180045,\"delay\":null}', 0, NULL, 1756180045, 1756180045),
(227, 'default', '{\"uuid\":\"786022ed-8239-418e-a272-ad63af001bcb\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:227;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756180052,\"delay\":null}', 0, NULL, 1756180052, 1756180052),
(228, 'default', '{\"uuid\":\"0ce404b0-16d8-4167-a628-56fb973ffe33\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:228;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756180055,\"delay\":null}', 0, NULL, 1756180055, 1756180055),
(229, 'default', '{\"uuid\":\"b4dc71fe-2636-440b-8758-32ee5c0a1abb\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:229;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756180076,\"delay\":null}', 0, NULL, 1756180076, 1756180076),
(230, 'default', '{\"uuid\":\"7e7448a5-bdc3-4708-a302-40ed2190a383\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:230;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756180076,\"delay\":null}', 0, NULL, 1756180076, 1756180076),
(231, 'default', '{\"uuid\":\"d39bd5d2-e7fb-44c1-a7aa-83992537b4d3\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:231;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756180076,\"delay\":null}', 0, NULL, 1756180076, 1756180076),
(232, 'default', '{\"uuid\":\"06ab9285-f6b3-4d88-8bd7-12b01a6fbc84\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:232;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756180076,\"delay\":null}', 0, NULL, 1756180076, 1756180076),
(233, 'default', '{\"uuid\":\"bc69c5d8-3fb1-4d35-8f62-42d9fbabe6c3\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:233;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756180358,\"delay\":null}', 0, NULL, 1756180358, 1756180358),
(234, 'default', '{\"uuid\":\"c89d44d6-7a3c-4eff-9983-9aeed8a6c3bd\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:234;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756180362,\"delay\":null}', 0, NULL, 1756180362, 1756180362),
(235, 'default', '{\"uuid\":\"36fe76e4-a077-41ce-bae8-197995a0b026\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:235;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756180371,\"delay\":null}', 0, NULL, 1756180371, 1756180371),
(236, 'default', '{\"uuid\":\"ebd9f29e-3363-41aa-b133-cacdee8c11d9\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:236;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756180376,\"delay\":null}', 0, NULL, 1756180376, 1756180376),
(237, 'default', '{\"uuid\":\"93f6c3cb-dc30-4c5d-ad23-0935bbc83fa3\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:237;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756180380,\"delay\":null}', 0, NULL, 1756180380, 1756180380),
(238, 'default', '{\"uuid\":\"7246b309-4a01-4323-a0d9-a687091787a4\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:238;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756180380,\"delay\":null}', 0, NULL, 1756180380, 1756180380),
(239, 'default', '{\"uuid\":\"8a6f9dab-8a22-4048-a51d-aca4cb0fe1c2\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:239;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756180812,\"delay\":null}', 0, NULL, 1756180812, 1756180812),
(240, 'default', '{\"uuid\":\"15425efe-6697-480f-9edf-a83d5cb42adf\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:240;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756180818,\"delay\":null}', 0, NULL, 1756180818, 1756180818),
(241, 'default', '{\"uuid\":\"709b9332-ae2e-473c-8b8c-a0616550f8b2\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:241;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756180827,\"delay\":null}', 0, NULL, 1756180827, 1756180827),
(242, 'default', '{\"uuid\":\"04f10f0c-67e3-41ff-bbb6-87c72eb63ec4\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:242;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756180831,\"delay\":null}', 0, NULL, 1756180831, 1756180831),
(243, 'default', '{\"uuid\":\"5e4131ac-9201-4d1c-9353-9317cc77ca9e\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:243;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756180834,\"delay\":null}', 0, NULL, 1756180834, 1756180834),
(244, 'default', '{\"uuid\":\"7e66bb79-c012-40f0-ab3a-a45c02ceb965\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:244;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756180843,\"delay\":null}', 0, NULL, 1756180843, 1756180843),
(245, 'default', '{\"uuid\":\"c8fc1afa-471f-43e2-9f6f-039a9cb8f211\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:245;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756181050,\"delay\":null}', 0, NULL, 1756181051, 1756181051),
(246, 'default', '{\"uuid\":\"57af1119-1404-4674-93fa-4bbda4eb912d\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:246;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756181116,\"delay\":null}', 0, NULL, 1756181116, 1756181116);
INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(247, 'default', '{\"uuid\":\"654de8e9-ab7e-4c5b-ab82-4d6eb6d02134\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:247;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756181120,\"delay\":null}', 0, NULL, 1756181120, 1756181120),
(248, 'default', '{\"uuid\":\"b554ba16-b4ca-4e83-bf76-50b22616129e\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:248;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756181124,\"delay\":null}', 0, NULL, 1756181124, 1756181124),
(249, 'default', '{\"uuid\":\"9f80f898-9cef-42e7-a4db-dafe271753fc\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:249;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756181232,\"delay\":null}', 0, NULL, 1756181232, 1756181232),
(250, 'default', '{\"uuid\":\"5634183a-56ff-4129-bc09-e31e1624a89f\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:250;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756181238,\"delay\":null}', 0, NULL, 1756181238, 1756181238),
(251, 'default', '{\"uuid\":\"b69703af-5b4c-4dc8-9e78-35235b1319d6\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:251;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756181240,\"delay\":null}', 0, NULL, 1756181240, 1756181240),
(252, 'default', '{\"uuid\":\"e32dd08c-ae39-4171-b377-d5898f48f5fc\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:252;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756181240,\"delay\":null}', 0, NULL, 1756181240, 1756181240),
(253, 'default', '{\"uuid\":\"1e8011db-a26a-4a47-a734-446593b7ac24\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:253;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756181243,\"delay\":null}', 0, NULL, 1756181243, 1756181243),
(254, 'default', '{\"uuid\":\"be9e0787-eaff-4b34-ab96-677a1978abec\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:254;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756181248,\"delay\":null}', 0, NULL, 1756181248, 1756181248),
(255, 'default', '{\"uuid\":\"a7186b71-d1f4-417f-9d51-882c7b650761\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:255;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756181248,\"delay\":null}', 0, NULL, 1756181248, 1756181248),
(256, 'default', '{\"uuid\":\"417b1e55-66de-4186-b51a-5e8215462694\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:256;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756181248,\"delay\":null}', 0, NULL, 1756181248, 1756181248),
(257, 'default', '{\"uuid\":\"8209b869-1129-44db-943d-9605d2a2c99f\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:257;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756181303,\"delay\":null}', 0, NULL, 1756181303, 1756181303),
(258, 'default', '{\"uuid\":\"80f38b3d-e3d0-4a0e-9a1c-7c3bf78fe5b6\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:258;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756181309,\"delay\":null}', 0, NULL, 1756181309, 1756181309),
(259, 'default', '{\"uuid\":\"b50e9f35-022d-4bbb-9387-b70ccf9dd00a\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:259;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756181313,\"delay\":null}', 0, NULL, 1756181313, 1756181313),
(260, 'default', '{\"uuid\":\"41f03389-016a-4668-9b10-7dfb802c3b0d\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:260;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756181316,\"delay\":null}', 0, NULL, 1756181316, 1756181316),
(261, 'default', '{\"uuid\":\"8e0cefaf-1237-4ca3-af90-3a9eb9240720\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:261;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756181533,\"delay\":null}', 0, NULL, 1756181533, 1756181533),
(262, 'default', '{\"uuid\":\"41d1115d-d191-4c33-8c87-f0d725a9c9d0\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:262;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756181556,\"delay\":null}', 0, NULL, 1756181556, 1756181556),
(263, 'default', '{\"uuid\":\"372c73a2-29ee-40ae-8992-764368dc6ec9\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:263;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756181559,\"delay\":null}', 0, NULL, 1756181559, 1756181559),
(264, 'default', '{\"uuid\":\"9eae42e9-6bf2-486c-804e-c712c7c33c4f\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:264;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756181565,\"delay\":null}', 0, NULL, 1756181565, 1756181565),
(265, 'default', '{\"uuid\":\"ee09a7e7-ec4b-4978-a3ab-a3e2ce6d7bf7\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:265;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756192000,\"delay\":null}', 0, NULL, 1756192000, 1756192000),
(266, 'default', '{\"uuid\":\"f39d6364-6b6f-4ba1-9a6d-9741f99bd6fa\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:266;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756192017,\"delay\":null}', 0, NULL, 1756192017, 1756192017),
(267, 'default', '{\"uuid\":\"a763c3b0-f65b-4421-8848-65a6913d9dc1\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:267;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756192020,\"delay\":null}', 0, NULL, 1756192020, 1756192020),
(268, 'default', '{\"uuid\":\"a2ec8053-4ee4-41b4-8e2b-5fec5da88b21\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:268;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756192032,\"delay\":null}', 0, NULL, 1756192032, 1756192032),
(269, 'default', '{\"uuid\":\"f50e7d8a-ced5-4227-b8f0-353f5f193029\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:269;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756192118,\"delay\":null}', 0, NULL, 1756192118, 1756192118),
(270, 'default', '{\"uuid\":\"f718a03e-113d-403e-9e15-d8f5333b8d6a\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:270;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756193798,\"delay\":null}', 0, NULL, 1756193798, 1756193798),
(271, 'default', '{\"uuid\":\"ac0ccfa5-aba3-47c2-b3e6-c05daa5d370d\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:271;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756193825,\"delay\":null}', 0, NULL, 1756193825, 1756193825),
(272, 'default', '{\"uuid\":\"5aa71f4f-c8e6-477c-9ed6-8f1acb4c2a1a\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:272;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756193947,\"delay\":null}', 0, NULL, 1756193947, 1756193947),
(273, 'default', '{\"uuid\":\"ddfb499a-68e6-4b3d-b7b0-7c486219a8f7\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:273;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756193996,\"delay\":null}', 0, NULL, 1756193996, 1756193996),
(274, 'default', '{\"uuid\":\"b4b08a35-0b28-4491-911e-4ca0e7148b03\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:274;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756194082,\"delay\":null}', 0, NULL, 1756194082, 1756194082),
(275, 'default', '{\"uuid\":\"a1c9731c-6f48-4ed0-bc25-3799c16cf61d\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:275;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756194622,\"delay\":null}', 0, NULL, 1756194622, 1756194622),
(276, 'default', '{\"uuid\":\"02ba47ed-7c65-48fd-bc6b-f0ab49534168\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:276;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756547843,\"delay\":null}', 0, NULL, 1756547843, 1756547843),
(277, 'default', '{\"uuid\":\"592d318d-21fe-4727-99b9-94e967619218\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:277;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756547856,\"delay\":null}', 0, NULL, 1756547856, 1756547856),
(278, 'default', '{\"uuid\":\"26853ec2-7c3a-40bb-b802-759c300de1ba\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:278;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756547980,\"delay\":null}', 0, NULL, 1756547980, 1756547980),
(279, 'default', '{\"uuid\":\"558dbd55-9ead-4b7c-ad29-68a5b23e42d1\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:279;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756547988,\"delay\":null}', 0, NULL, 1756547988, 1756547988),
(280, 'default', '{\"uuid\":\"9d8c25b5-e311-43f6-9703-8add0a1cdfb9\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:280;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1756548023,\"delay\":null}', 0, NULL, 1756548023, 1756548023),
(281, 'default', '{\"uuid\":\"802ade86-82cb-4c32-8a35-a13583a63eaa\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:283;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757053649,\"delay\":null}', 0, NULL, 1757053649, 1757053649),
(282, 'default', '{\"uuid\":\"35210490-34cc-486f-91fd-0624f4111a8a\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:284;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757053864,\"delay\":null}', 0, NULL, 1757053864, 1757053864),
(283, 'default', '{\"uuid\":\"1d527233-e749-459e-a836-5717e4302955\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:285;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757079831,\"delay\":null}', 0, NULL, 1757079831, 1757079831),
(284, 'default', '{\"uuid\":\"bdb6f563-48b6-4a75-ac23-0e9dd597fdb3\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:286;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757097636,\"delay\":null}', 0, NULL, 1757097636, 1757097636),
(285, 'default', '{\"uuid\":\"9661733d-1bf8-436f-bbb9-4a7af42073ca\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:287;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757097762,\"delay\":null}', 0, NULL, 1757097762, 1757097762),
(286, 'default', '{\"uuid\":\"c1565df8-ae1d-485f-8197-10ec421db723\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:288;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757097779,\"delay\":null}', 0, NULL, 1757097779, 1757097779),
(287, 'default', '{\"uuid\":\"077937a5-6377-4231-9680-0b39f99d2a96\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:289;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757097780,\"delay\":null}', 0, NULL, 1757097780, 1757097780);
INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(288, 'default', '{\"uuid\":\"94aeb62c-c1d7-415c-904f-3eaff2ea9753\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:290;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757097789,\"delay\":null}', 0, NULL, 1757097789, 1757097789),
(289, 'default', '{\"uuid\":\"0339ca7c-3492-4bb0-9266-92fef4af3893\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:291;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757098095,\"delay\":null}', 0, NULL, 1757098095, 1757098095),
(290, 'default', '{\"uuid\":\"953076c4-4798-47c0-b3f5-d9915b0a6f49\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:292;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757098096,\"delay\":null}', 0, NULL, 1757098096, 1757098096),
(291, 'default', '{\"uuid\":\"a72f23e6-c0fd-4e3b-b6a8-7134995e5d08\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:293;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757098096,\"delay\":null}', 0, NULL, 1757098096, 1757098096),
(292, 'default', '{\"uuid\":\"592097b2-5fca-4df3-8872-2d5d953469c0\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:294;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757098117,\"delay\":null}', 0, NULL, 1757098117, 1757098117),
(293, 'default', '{\"uuid\":\"ace2a836-3f60-4313-9de2-f908ddb9214d\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:295;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757098162,\"delay\":null}', 0, NULL, 1757098162, 1757098162),
(294, 'default', '{\"uuid\":\"12cd9095-350a-4ab4-9d90-aeb819b909f7\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:296;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757098312,\"delay\":null}', 0, NULL, 1757098312, 1757098312),
(295, 'default', '{\"uuid\":\"deee8c60-8d2d-4a86-980d-fd2eadd99782\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:297;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757098317,\"delay\":null}', 0, NULL, 1757098317, 1757098317),
(296, 'default', '{\"uuid\":\"fd190920-1826-46c4-826f-bcd7711bd1f1\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:298;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757098347,\"delay\":null}', 0, NULL, 1757098347, 1757098347),
(297, 'default', '{\"uuid\":\"5f6ec6b5-ef82-4ae6-a4df-402e212a2216\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:299;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757098351,\"delay\":null}', 0, NULL, 1757098351, 1757098351),
(298, 'default', '{\"uuid\":\"57cba810-38ed-4743-9846-5dc933692b8f\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:300;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757098365,\"delay\":null}', 0, NULL, 1757098365, 1757098365),
(299, 'default', '{\"uuid\":\"d21fb70b-3bc8-4af4-8b12-46559060045b\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:301;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757098545,\"delay\":null}', 0, NULL, 1757098545, 1757098545),
(300, 'default', '{\"uuid\":\"dcdb7725-fb42-46f5-b531-d9ad0f394913\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:302;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757329464,\"delay\":null}', 0, NULL, 1757329464, 1757329464),
(301, 'default', '{\"uuid\":\"f76eaa75-aae7-48ac-aba8-27118f1964a3\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:303;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757330129,\"delay\":null}', 0, NULL, 1757330129, 1757330129),
(302, 'default', '{\"uuid\":\"242e3d40-d40a-4583-b2fb-d98a67b3425a\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:304;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757488564,\"delay\":null}', 0, NULL, 1757488564, 1757488564),
(303, 'default', '{\"uuid\":\"c71bd5c3-6b70-4e44-8dca-d1e87c88b008\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:305;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757488567,\"delay\":null}', 0, NULL, 1757488567, 1757488567),
(304, 'default', '{\"uuid\":\"3e3ee79b-f0ad-469c-a16b-888ee05b8a0e\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:306;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757488573,\"delay\":null}', 0, NULL, 1757488573, 1757488573),
(305, 'default', '{\"uuid\":\"216559e8-29ec-4c03-a822-6b9c2d982ca1\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:307;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757489743,\"delay\":null}', 0, NULL, 1757489743, 1757489743),
(306, 'default', '{\"uuid\":\"1092f94c-0436-4897-b41f-b5b1123f410e\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:308;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757489762,\"delay\":null}', 0, NULL, 1757489762, 1757489762),
(307, 'default', '{\"uuid\":\"591fb2cd-b939-44db-9bf8-74ad8ad922bf\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:309;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757489765,\"delay\":null}', 0, NULL, 1757489765, 1757489765),
(308, 'default', '{\"uuid\":\"839998bd-2ba6-44e2-a601-80298e065def\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:310;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757489805,\"delay\":null}', 0, NULL, 1757489805, 1757489805),
(309, 'default', '{\"uuid\":\"3113f6f5-57d0-43bc-a568-19424917687d\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:311;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757489832,\"delay\":null}', 0, NULL, 1757489832, 1757489832),
(310, 'default', '{\"uuid\":\"c15521f7-7e9f-4b7b-b64d-bb8668461f31\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:312;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757489889,\"delay\":null}', 0, NULL, 1757489889, 1757489889),
(311, 'default', '{\"uuid\":\"d9884a84-d989-4647-a449-9f50d61218dc\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:313;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757489892,\"delay\":null}', 0, NULL, 1757489892, 1757489892),
(312, 'default', '{\"uuid\":\"8b225e7f-6afa-419f-aa75-48332b304a88\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:314;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757490006,\"delay\":null}', 0, NULL, 1757490006, 1757490006),
(313, 'default', '{\"uuid\":\"b65cb4ea-7069-42a8-95dd-cf053eeacde5\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:315;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757490015,\"delay\":null}', 0, NULL, 1757490015, 1757490015),
(314, 'default', '{\"uuid\":\"6648a415-8f60-4515-9bdf-9cca636a34a3\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:316;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757490091,\"delay\":null}', 0, NULL, 1757490091, 1757490091),
(315, 'default', '{\"uuid\":\"b4fea48f-5890-4a4e-aef4-ad9331168826\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:317;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757490241,\"delay\":null}', 0, NULL, 1757490241, 1757490241),
(316, 'default', '{\"uuid\":\"47690a9f-c6d5-409f-bbf6-0ee68547685b\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:318;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757524697,\"delay\":null}', 0, NULL, 1757524697, 1757524697),
(317, 'default', '{\"uuid\":\"955e11dd-9589-4166-8892-0a8a73cf8017\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:319;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1757525542,\"delay\":null}', 0, NULL, 1757525542, 1757525542),
(318, 'default', '{\"uuid\":\"16f1d157-b9c5-4f0e-8b7f-b6326f5b8f39\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:321;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1758143831,\"delay\":null}', 0, NULL, 1758143831, 1758143831),
(319, 'default', '{\"uuid\":\"ad9d555a-92e1-4bed-af10-7ab382366db7\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:322;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1758268039,\"delay\":null}', 0, NULL, 1758268039, 1758268039),
(320, 'default', '{\"uuid\":\"eb28ba56-88d1-4b7f-b3a3-c4ef9e50a8c0\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:323;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1758268040,\"delay\":null}', 0, NULL, 1758268040, 1758268040),
(321, 'default', '{\"uuid\":\"95d5aa03-ccc1-4a4e-a522-72e724de626b\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:324;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1758455556,\"delay\":null}', 0, NULL, 1758455556, 1758455556),
(322, 'default', '{\"uuid\":\"d0bc1635-de31-4c6b-9105-0a6cbac40269\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:325;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759330581,\"delay\":null}', 0, NULL, 1759330582, 1759330582),
(323, 'default', '{\"uuid\":\"de9535ee-7c9f-4533-bcfc-8e8d2822ba4b\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:326;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759330657,\"delay\":null}', 0, NULL, 1759330657, 1759330657),
(324, 'default', '{\"uuid\":\"19e805c6-2968-4b3e-8c05-efae4057e8a5\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:327;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759330664,\"delay\":null}', 0, NULL, 1759330664, 1759330664),
(325, 'default', '{\"uuid\":\"6569a0c0-0028-41e5-89e8-75579ff99685\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:328;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759592142,\"delay\":null}', 0, NULL, 1759592142, 1759592142),
(326, 'default', '{\"uuid\":\"9c1793c9-1156-426e-9cf6-a87cb1ad68c7\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:329;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759592658,\"delay\":null}', 0, NULL, 1759592658, 1759592658),
(327, 'default', '{\"uuid\":\"b76ca2aa-49ff-42f6-aa04-737afee08d94\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:330;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759592665,\"delay\":null}', 0, NULL, 1759592665, 1759592665),
(328, 'default', '{\"uuid\":\"baea0e8c-d1f3-48c6-b577-231d208d0b0f\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:331;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759605339,\"delay\":null}', 0, NULL, 1759605339, 1759605339);
INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(329, 'default', '{\"uuid\":\"d3aa122f-fa14-4f93-8ef2-c1c85f073448\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:332;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759605346,\"delay\":null}', 0, NULL, 1759605346, 1759605346),
(330, 'default', '{\"uuid\":\"e8afff45-7625-4905-85e9-ec7c6b5fa807\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:333;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759650271,\"delay\":null}', 0, NULL, 1759650271, 1759650271),
(331, 'default', '{\"uuid\":\"c1c71a80-b8d9-4242-8e88-015ed9db33ff\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:334;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759653498,\"delay\":null}', 0, NULL, 1759653498, 1759653498),
(332, 'default', '{\"uuid\":\"1b3a1b2e-9063-4cdc-9b0f-340c6502e906\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:335;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759653852,\"delay\":null}', 0, NULL, 1759653852, 1759653852),
(333, 'default', '{\"uuid\":\"92e6016b-1ce1-4a8c-b882-9c0b3638f8b4\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:336;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759654304,\"delay\":null}', 0, NULL, 1759654304, 1759654304),
(334, 'default', '{\"uuid\":\"545e9b98-8374-43c0-8093-038d21adc732\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:337;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759660280,\"delay\":null}', 0, NULL, 1759660280, 1759660280),
(335, 'default', '{\"uuid\":\"f8d804fd-9006-45cc-87d3-bdbabd885a4c\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:338;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759660443,\"delay\":null}', 0, NULL, 1759660443, 1759660443),
(336, 'default', '{\"uuid\":\"8e90134a-7e20-448b-9d57-7e73a74771cd\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:339;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759666850,\"delay\":null}', 0, NULL, 1759666850, 1759666850),
(337, 'default', '{\"uuid\":\"b75fc8eb-8f42-4b0c-ae76-43b7759fa917\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:340;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759666858,\"delay\":null}', 0, NULL, 1759666858, 1759666858),
(338, 'default', '{\"uuid\":\"bb433f8c-f60a-4541-a246-176543da2040\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:341;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759666928,\"delay\":null}', 0, NULL, 1759666928, 1759666928),
(339, 'default', '{\"uuid\":\"6f51f59e-15ae-4dcc-876f-158967b5d3f2\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:342;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759666956,\"delay\":null}', 0, NULL, 1759666956, 1759666956),
(340, 'default', '{\"uuid\":\"ae5fa666-7adf-4c88-b5fa-4804758dbef6\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:343;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759666977,\"delay\":null}', 0, NULL, 1759666977, 1759666977),
(341, 'default', '{\"uuid\":\"fe008076-4b03-4b29-b302-3cc970cbf534\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:344;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759667165,\"delay\":null}', 0, NULL, 1759667165, 1759667165),
(342, 'default', '{\"uuid\":\"3d9a4d53-4dd2-43a0-9b4e-6ad46062f805\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:345;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759667176,\"delay\":null}', 0, NULL, 1759667176, 1759667176),
(343, 'default', '{\"uuid\":\"b45a8af5-4f1b-458a-ac2b-0743c9ea8d8c\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:346;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759667352,\"delay\":null}', 0, NULL, 1759667352, 1759667352),
(344, 'default', '{\"uuid\":\"5fdee664-6265-4073-ba93-7eac59b54af8\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:347;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759667521,\"delay\":null}', 0, NULL, 1759667521, 1759667521),
(345, 'default', '{\"uuid\":\"313ca3da-0b8f-42fb-a89d-0fdf27eb87a2\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:348;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759667761,\"delay\":null}', 0, NULL, 1759667761, 1759667761),
(346, 'default', '{\"uuid\":\"82e32948-eb25-45cd-941d-1621af7c3c57\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:349;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759667786,\"delay\":null}', 0, NULL, 1759667786, 1759667786),
(347, 'default', '{\"uuid\":\"de868852-0c23-4240-88ec-34fa92b626d2\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:350;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759667906,\"delay\":null}', 0, NULL, 1759667906, 1759667906),
(348, 'default', '{\"uuid\":\"7d7e9d67-c1ce-4933-b2cc-1fe3b3433bb8\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:351;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759667942,\"delay\":null}', 0, NULL, 1759667942, 1759667942),
(349, 'default', '{\"uuid\":\"a6ad6c66-2470-4e53-9a0d-0dddf7639ebf\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:352;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759667963,\"delay\":null}', 0, NULL, 1759667963, 1759667963),
(350, 'default', '{\"uuid\":\"99ee11f0-1cd3-44e6-9b2f-f38b1d3f8c00\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:355;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759687272,\"delay\":null}', 0, NULL, 1759687272, 1759687272),
(351, 'default', '{\"uuid\":\"66c194a8-b9b3-4656-9073-0ac1d44da3e0\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:356;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759735690,\"delay\":null}', 0, NULL, 1759735690, 1759735690),
(352, 'default', '{\"uuid\":\"f5f541ee-ea19-4b3e-bf53-c05b189e44f1\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:357;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759764098,\"delay\":null}', 0, NULL, 1759764098, 1759764098),
(353, 'default', '{\"uuid\":\"5f19d732-55dc-439a-a3fa-d0ac876f98bf\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:358;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759779385,\"delay\":null}', 0, NULL, 1759779385, 1759779385),
(354, 'default', '{\"uuid\":\"2cdd8a6a-5847-4215-b6d1-67748b4c6121\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:359;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1759805681,\"delay\":null}', 0, NULL, 1759805681, 1759805681),
(355, 'default', '{\"uuid\":\"beab318a-a6dc-4acd-940c-a2af961df37b\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:360;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1760969281,\"delay\":null}', 0, NULL, 1760969282, 1760969282),
(356, 'default', '{\"uuid\":\"bbf7716a-4b14-469c-b6b8-715839bb76d1\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:361;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1760972609,\"delay\":null}', 0, NULL, 1760972609, 1760972609),
(357, 'default', '{\"uuid\":\"9c8af65b-d829-4b0d-bdca-47968deb5866\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:362;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1760972612,\"delay\":null}', 0, NULL, 1760972612, 1760972612),
(358, 'default', '{\"uuid\":\"10c0a906-bd00-4939-8a84-7ad79e3356e8\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:363;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1760972853,\"delay\":null}', 0, NULL, 1760972853, 1760972853),
(359, 'default', '{\"uuid\":\"514d4100-0061-4768-8826-2f81326ab399\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:364;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1760972961,\"delay\":null}', 0, NULL, 1760972961, 1760972961),
(360, 'default', '{\"uuid\":\"b95c4fd7-8313-461f-ba2e-628f53a08b93\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:365;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1760973654,\"delay\":null}', 0, NULL, 1760973654, 1760973654),
(361, 'default', '{\"uuid\":\"975238e2-74e5-4516-ac18-69339feb4d53\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:366;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1760973720,\"delay\":null}', 0, NULL, 1760973720, 1760973720),
(362, 'default', '{\"uuid\":\"28170e05-d32e-4704-9490-091d4060644f\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:367;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1760974163,\"delay\":null}', 0, NULL, 1760974163, 1760974163),
(363, 'default', '{\"uuid\":\"3f8784d7-d6ee-48de-a7aa-89e84dc76f61\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:368;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1760974614,\"delay\":null}', 0, NULL, 1760974614, 1760974614),
(364, 'default', '{\"uuid\":\"835ad08c-214c-4b17-b230-317dc6e5aaae\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:369;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1760974634,\"delay\":null}', 0, NULL, 1760974634, 1760974634),
(365, 'default', '{\"uuid\":\"08b82b41-be5f-4f66-aa2c-c3654531040b\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:370;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1760974729,\"delay\":null}', 0, NULL, 1760974729, 1760974729),
(366, 'default', '{\"uuid\":\"44362a97-0a0c-4dcd-a3c8-394f7f0c4e51\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:371;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1760975309,\"delay\":null}', 0, NULL, 1760975309, 1760975309),
(367, 'default', '{\"uuid\":\"50f690d0-7a24-4f2b-8e7a-5d31d5cf7a46\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:372;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1760975363,\"delay\":null}', 0, NULL, 1760975363, 1760975363),
(368, 'default', '{\"uuid\":\"b96950f5-50a3-4e96-8ade-2b2c6c833f26\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:373;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1761595157,\"delay\":null}', 0, NULL, 1761595157, 1761595157),
(369, 'default', '{\"uuid\":\"2bcbd808-1463-4765-8d00-c1014236e52d\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:374;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1761595935,\"delay\":null}', 0, NULL, 1761595935, 1761595935);
INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(370, 'default', '{\"uuid\":\"c2b55992-b0f4-4532-b647-a98973f0207e\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:375;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1761597250,\"delay\":null}', 0, NULL, 1761597250, 1761597250),
(371, 'default', '{\"uuid\":\"fc6e6fa8-2392-4ef7-b1b5-64dce548cd7a\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:376;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1761631404,\"delay\":null}', 0, NULL, 1761631404, 1761631404),
(372, 'default', '{\"uuid\":\"f5daf280-ab7a-4c00-9f50-1b67c0b05d1e\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:377;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1761631428,\"delay\":null}', 0, NULL, 1761631428, 1761631428),
(373, 'default', '{\"uuid\":\"878d7d65-7c4a-487e-a9ba-b11cd0239f4e\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:378;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1761743224,\"delay\":null}', 0, NULL, 1761743225, 1761743225),
(374, 'default', '{\"uuid\":\"ec599183-ae60-4a3e-be4e-8cd37523c4c4\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:379;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1761743781,\"delay\":null}', 0, NULL, 1761743781, 1761743781),
(375, 'default', '{\"uuid\":\"079d4754-1419-47c5-8e61-80cc6424689e\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:380;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1761743959,\"delay\":null}', 0, NULL, 1761743959, 1761743959),
(376, 'default', '{\"uuid\":\"f9124080-be99-4799-9aed-7c0ea226ce98\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:381;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1761744078,\"delay\":null}', 0, NULL, 1761744078, 1761744078),
(377, 'default', '{\"uuid\":\"ae541a75-3459-4a6e-be36-4e11e680a65e\",\"displayName\":\"App\\\\Events\\\\ActivityCreated\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:26:\\\"App\\\\Events\\\\ActivityCreated\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:382;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1765889102,\"delay\":null}', 0, NULL, 1765889102, 1765889102);

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
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` enum('video','text','quiz','pdf') NOT NULL,
  `content` text DEFAULT NULL,
  `media_url` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_histories`
--

CREATE TABLE `login_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `device` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mechanic_products`
--

CREATE TABLE `mechanic_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `stock` int(11) NOT NULL DEFAULT 0,
  `brand` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'product',
  `image` varchar(255) DEFAULT NULL,
  `mechanic_id` bigint(20) UNSIGNED NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mechanic_products`
--

INSERT INTO `mechanic_products` (`id`, `name`, `description`, `price`, `stock`, `brand`, `category`, `type`, `image`, `mechanic_id`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 'Car', 'Toyota', 5000.00, 1, NULL, 'Vehicle', 'product', 'mechanic_products/N1kckMs8V1cT6eAY4UK7w4vTRemOwaEEUEH9BZ0H.webp', 22, 1, '2025-09-27 15:40:44', '2025-10-21 00:11:38'),
(2, 'Car  Spare Parts', 'Motor', 700000.00, 80, NULL, 'Vehicle  Yundai', 'service', 'mechanic_products/QhRWBBdZcS2OIYkGpH8i372s478lVCP8hyiJ6xH9.jpg', 22, 1, '2025-09-27 17:36:02', '2025-09-28 14:47:16');

-- --------------------------------------------------------

--
-- Table structure for table `mediators`
--

CREATE TABLE `mediators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mediator_id` bigint(20) DEFAULT NULL,
  `total_clients` int(11) NOT NULL DEFAULT 0,
  `total_transactions` int(11) NOT NULL DEFAULT 0,
  `level` varchar(255) NOT NULL DEFAULT 'basic',
  `approved_by_admin` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `craftsperson_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mediators`
--

INSERT INTO `mediators` (`id`, `fullname`, `email`, `phone`, `location`, `user_id`, `mediator_id`, `total_clients`, `total_transactions`, `level`, `approved_by_admin`, `status`, `created_at`, `updated_at`, `craftsperson_id`) VALUES
(1, '', '', '', '', 22, 0, 0, 0, 'basic', 1, 'active', NULL, '2025-09-17 13:31:14', NULL),
(3, 'Umwiza Umwali', 'umu@gmail.com', '0787832490', 'Remera', NULL, NULL, 0, 0, 'advanced', 1, 'active', '2025-09-17 13:49:27', '2025-10-05 19:40:39', NULL),
(4, NULL, NULL, NULL, NULL, 25, NULL, 0, 0, 'basic', 1, 'active', '2025-09-19 00:25:02', '2025-10-05 19:40:29', NULL),
(5, 'John Doe', 'john@example.com', '0000000000', 'Kigali', NULL, NULL, 0, 0, 'basic', 1, 'active', '2025-09-21 16:48:16', '2025-10-05 19:40:34', NULL),
(22, 'Default Mediator', 'mediator22@example.com', NULL, NULL, NULL, NULL, 0, 0, 'basic', 1, 'active', '2025-09-21 17:11:55', '2025-10-05 19:40:43', NULL),
(23, 'Adam', 'adam@gmail.com', '07880000000', 'Kigali City', NULL, NULL, 0, 0, 'advanced', 1, 'active', '2025-10-05 19:41:25', '2025-10-06 00:59:41', NULL),
(24, 'Adams', 'adams@gmail.com', '0787832490', 'Remera', NULL, NULL, 0, 0, 'basic', 1, 'active', '2025-10-06 00:45:35', '2025-10-20 22:26:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mediator_commissions`
--

CREATE TABLE `mediator_commissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mediator_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `activity_type` varchar(100) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `commission_amount` decimal(12,2) NOT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mediator_commissions`
--

INSERT INTO `mediator_commissions` (`id`, `mediator_id`, `client_id`, `activity_type`, `amount`, `commission_amount`, `paid_at`, `created_at`, `updated_at`) VALUES
(5, 22, 22, 'Product', 444.00, 44.40, '2025-09-22 00:12:26', '2025-09-22 00:12:26', '2025-09-22 00:12:26'),
(6, 22, 22, 'Product', 444.00, 44.40, '2025-09-22 00:13:57', '2025-09-22 00:13:57', '2025-09-22 00:13:57'),
(7, 22, 22, 'Product', 444.00, 44.40, '2025-09-22 01:08:19', '2025-09-22 01:08:19', '2025-09-22 01:08:19'),
(8, 22, 26, 'Product', 2222.00, 222.20, '2025-10-20 23:49:31', '2025-10-20 23:49:31', '2025-10-20 23:49:31'),
(9, 22, 26, 'Product', 2222.00, 222.20, '2025-10-20 23:50:01', '2025-10-20 23:50:01', '2025-10-20 23:50:01');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `time` time NOT NULL,
  `link` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Published','Unpublished') DEFAULT 'Unpublished',
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`roles`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `client_id`, `time`, `link`, `description`, `status`, `roles`, `created_at`, `updated_at`) VALUES
(1, NULL, '19:29:00', 'https://meet.google.com/new', 'Meet you tomorrow!,Come on time.', 'Unpublished', NULL, '2025-08-22 09:28:59', '2025-10-28 04:19:54'),
(3, NULL, '02:09:00', 'https://zoom.us/start/videomeeting', 'Please you need to atted today', 'Unpublished', NULL, '2025-09-10 14:08:24', '2025-10-28 04:50:21'),
(4, NULL, '00:44:00', 'https://zoom.us/start/videomeeting', 'Lets use Zoom Now', 'Unpublished', NULL, '2025-10-05 14:41:34', '2025-10-28 05:08:18'),
(5, NULL, '10:01:00', 'https://meet.google.com/new', 'meeting', 'Published', NULL, '2025-10-20 21:59:01', '2025-10-27 22:57:30'),
(6, NULL, '05:37:00', 'https://zoom.us/start/videomeeting', 'Meeting Today', 'Published', '[\"craftsperson\"]', '2025-10-29 19:36:26', '2025-10-29 19:37:19');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_role`
--

CREATE TABLE `menu_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `created_at`, `updated_at`) VALUES
(3, 22, 3, 'Yes man', '2025-10-05 19:36:00', '2025-10-05 19:36:00'),
(4, 22, 3, 'Now', '2025-10-05 19:36:25', '2025-10-05 19:36:25'),
(5, 22, 4, 'Yes We are ready', '2025-10-20 22:38:42', '2025-10-20 22:38:42');

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
(4, '2025_08_01_101727_create_permission_tables', 2),
(5, '2025_08_01_111641_add_status_to_feedback_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(14, 'App\\Models\\User', 27),
(20, 'App\\Models\\User', 26);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `related_id` bigint(20) UNSIGNED DEFAULT NULL,
  `related_type` varchar(100) DEFAULT NULL,
  `notifiable_id` int(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `data` longtext DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `sent_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `booking_id`, `client_id`, `type`, `message`, `user_id`, `related_id`, `related_type`, `notifiable_id`, `notifiable_type`, `data`, `is_read`, `sent_at`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'manager_message', 'Hello!', NULL, NULL, NULL, 0, '', NULL, 0, '2025-08-25 21:36:01', '2025-08-25 21:36:01', '2025-08-25 21:36:01'),
(2, NULL, NULL, 'manager_message', 'Hello!', NULL, NULL, NULL, 0, '', NULL, 0, '2025-08-25 21:36:02', '2025-08-25 21:36:02', '2025-08-25 21:36:02'),
(3, NULL, NULL, 'manager_message', 'Hi', NULL, NULL, NULL, 0, '', NULL, 0, '2025-08-25 23:14:21', '2025-08-25 23:14:21', '2025-08-25 23:14:21'),
(4, NULL, NULL, 'manager_message', 'Hi', NULL, NULL, NULL, 0, '', NULL, 0, '2025-08-25 23:14:21', '2025-08-25 23:14:21', '2025-08-25 23:14:21'),
(5, NULL, NULL, 'manager_message', 'Hi', NULL, NULL, NULL, 0, '', NULL, 0, '2025-08-26 07:11:29', '2025-08-26 07:11:29', '2025-08-26 07:11:29'),
(6, NULL, NULL, 'manager_message', 'Hi', NULL, NULL, NULL, 0, '', NULL, 0, '2025-08-26 08:05:03', '2025-08-26 08:05:03', '2025-08-26 08:05:03'),
(7, NULL, NULL, 'manager_message', 'yes', NULL, NULL, NULL, 0, '', NULL, 0, '2025-09-08 17:58:50', '2025-09-08 17:58:50', '2025-09-08 17:58:50'),
(8, NULL, NULL, 'Booking Update', 'Do the work', NULL, NULL, NULL, 0, '', NULL, 0, NULL, '2025-09-09 06:13:30', '2025-09-09 06:13:30'),
(9, NULL, NULL, 'Booking Update', 'Do the work', NULL, NULL, NULL, 0, '', NULL, 0, NULL, '2025-09-09 06:34:01', '2025-09-09 06:34:01'),
(10, NULL, NULL, 'Booking Update', 'Do the work', NULL, NULL, NULL, 0, '', NULL, 0, NULL, '2025-09-09 06:34:01', '2025-09-09 06:34:01'),
(11, NULL, NULL, 'Booking Update', 'Do the work', NULL, NULL, NULL, 0, '', NULL, 0, NULL, '2025-09-09 07:00:22', '2025-09-09 07:00:22'),
(12, NULL, NULL, 'Booking Update', 'Do the work', NULL, NULL, NULL, 0, '', NULL, 0, NULL, '2025-09-09 07:00:39', '2025-09-09 07:00:39'),
(13, NULL, NULL, 'Booking Update', 'Do the work', NULL, NULL, NULL, 0, '', NULL, 0, NULL, '2025-09-09 07:00:39', '2025-09-09 07:00:39'),
(14, NULL, NULL, 'Booking Update', 'Do the work', NULL, NULL, NULL, 0, '', NULL, 0, NULL, '2025-09-09 07:03:37', '2025-09-09 07:03:37'),
(15, NULL, NULL, 'Booking Update', 'Do the work', NULL, NULL, NULL, 0, '', NULL, 0, NULL, '2025-09-09 07:24:10', '2025-09-09 07:24:10'),
(16, NULL, NULL, 'Booking Update', 'Do the work', NULL, NULL, NULL, 0, '', NULL, 0, NULL, '2025-09-09 07:24:24', '2025-09-09 07:24:24'),
(17, NULL, NULL, 'Booking Update', 'Do the work', NULL, NULL, NULL, 0, '', NULL, 0, NULL, '2025-09-09 07:35:18', '2025-09-09 07:35:18'),
(18, NULL, NULL, 'Booking Update', 'Do the work', NULL, NULL, NULL, 0, '', NULL, 0, NULL, '2025-09-09 15:35:01', '2025-09-09 15:35:01'),
(24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27, 'App\\Models\\User', '{\"message\":\"yes\"}', 0, NULL, '2025-10-06 22:09:24', '2025-10-06 22:09:24'),
(25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, 'App\\Models\\User', '{\"message\":\"Okey\"}', 0, NULL, '2025-10-06 22:09:38', '2025-10-06 22:09:38'),
(26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27, 'App\\Models\\User', '{\"message\":\"Client status changed to: inactive\"}', 0, NULL, '2025-10-06 22:11:24', '2025-10-06 22:11:24');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_method` varchar(50) NOT NULL,
  `status` enum('Pending','Approved','Delivered','Confirmed') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

CREATE TABLE `otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `code` char(6) NOT NULL,
  `expires_at` datetime NOT NULL,
  `used` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `plan` varchar(255) DEFAULT NULL,
  `method` enum('cash','mtn_momo','airtel_money','card','bank','other') NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `payment_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `invoice_path` varchar(255) DEFAULT NULL,
  `status` enum('pending','success','failed','refunded') NOT NULL DEFAULT 'pending',
  `paid_at` timestamp NULL DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `invoice_id`, `client_id`, `plan`, `method`, `transaction_id`, `payment_amount`, `invoice_path`, `status`, `paid_at`, `meta`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, '0', 'airtel_money', '', 5310.00, '', 'success', '2025-08-15 11:15:15', NULL, '2025-08-15 11:15:15', '2025-08-15 11:15:15'),
(2, NULL, NULL, '0', 'mtn_momo', '', 1770.00, '', 'success', '2025-08-15 11:17:57', NULL, '2025-08-15 11:17:57', '2025-08-15 11:17:57'),
(3, NULL, NULL, '0', 'mtn_momo', '', 2006.00, '', 'success', '2025-08-15 11:25:03', NULL, '2025-08-15 11:25:03', '2025-08-15 11:25:03'),
(4, NULL, NULL, '0', 'bank', '', 6372.00, '', 'success', '2025-08-15 11:25:50', NULL, '2025-08-15 11:25:50', '2025-08-15 11:25:50'),
(5, NULL, NULL, '0', 'airtel_money', '', 5782.00, '', 'success', '2025-08-15 11:29:28', NULL, '2025-08-15 11:29:28', '2025-08-15 11:29:28'),
(6, NULL, NULL, '0', 'bank', '', 15222.00, '', 'success', '2025-08-15 11:44:12', NULL, '2025-08-15 11:44:12', '2025-08-15 11:44:12'),
(7, NULL, NULL, '0', 'airtel_money', '', 19470.00, '', 'success', '2025-08-15 11:51:27', NULL, '2025-08-15 11:51:27', '2025-08-15 11:51:27'),
(8, NULL, NULL, '0', 'cash', '', 15930.00, '', 'success', '2025-08-15 12:18:48', NULL, '2025-08-15 12:18:48', '2025-08-15 12:18:48'),
(9, NULL, NULL, '0', 'cash', '', 9676.00, '', 'success', '2025-08-15 12:55:17', NULL, '2025-08-15 12:55:17', '2025-08-15 12:55:17'),
(10, NULL, NULL, '0', 'bank', '', 72216.00, '', 'success', '2025-08-15 13:03:12', NULL, '2025-08-15 13:03:12', '2025-08-15 13:03:12'),
(11, NULL, NULL, '0', 'bank', '', 11800.00, '', 'success', '2025-08-15 13:52:12', NULL, '2025-08-15 13:52:12', '2025-08-15 13:52:12'),
(12, 12, NULL, '0', 'airtel_money', '', 13216.00, '', 'success', '2025-08-15 14:00:05', NULL, '2025-08-15 14:00:05', '2025-08-15 14:00:05'),
(13, 13, NULL, '0', 'airtel_money', '', 18762.00, '', 'success', '2025-08-16 02:31:59', NULL, '2025-08-16 02:31:59', '2025-08-16 02:31:59'),
(14, 14, NULL, '0', 'airtel_money', '', 826.00, '', 'success', '2025-08-19 06:43:58', NULL, '2025-08-19 06:43:58', '2025-08-19 06:43:58'),
(15, 15, NULL, '0', 'card', '', 826.00, '', 'success', '2025-08-19 06:56:34', NULL, '2025-08-19 06:56:34', '2025-08-19 06:56:34'),
(16, 16, NULL, '0', 'card', '', 944.00, '', 'success', '2025-08-19 06:56:53', NULL, '2025-08-19 06:56:53', '2025-08-19 06:56:53'),
(17, 17, NULL, '0', 'card', '', 944.00, '', 'success', '2025-08-19 06:58:22', NULL, '2025-08-19 06:58:22', '2025-08-19 06:58:22'),
(19, 19, NULL, '0', 'bank', '', 1186254.00, '', 'success', '2025-08-21 00:44:23', NULL, '2025-08-21 00:44:23', '2025-08-21 00:44:23'),
(20, 20, NULL, '0', 'mtn_momo', '', 1888.00, '', 'success', '2025-08-22 13:50:32', NULL, '2025-08-22 13:50:32', '2025-08-22 13:50:32'),
(21, 21, NULL, '0', 'mtn_momo', '', 826.00, '', 'success', '2025-08-22 13:51:03', NULL, '2025-08-22 13:51:03', '2025-08-22 13:51:03'),
(22, 32, NULL, '0', 'airtel_money', '', 826.00, '', 'success', '2025-09-05 13:31:04', NULL, '2025-09-05 13:31:04', '2025-09-05 13:31:04'),
(23, 33, NULL, '0', 'bank', '', 73868.00, '', 'success', '2025-09-06 01:48:15', NULL, '2025-09-06 01:48:15', '2025-09-06 01:48:15'),
(24, 34, NULL, '0', 'bank', '', 73868.00, '', 'success', '2025-09-06 01:48:16', NULL, '2025-09-06 01:48:16', '2025-09-06 01:48:16'),
(25, 35, NULL, '0', 'bank', '', 73868.00, '', 'success', '2025-09-06 01:48:16', NULL, '2025-09-06 01:48:16', '2025-09-06 01:48:16'),
(26, 36, NULL, '0', 'mtn_momo', '', 944.00, '', 'success', '2025-09-06 01:48:37', NULL, '2025-09-06 01:48:37', '2025-09-06 01:48:37'),
(28, NULL, 22, '0', 'cash', 'TXN1758052045', 9300.00, NULL, 'success', '2025-09-17 02:47:25', NULL, '2025-09-17 02:47:25', '2025-09-17 02:47:25'),
(29, NULL, 22, '0', 'mtn_momo', 'TXN1758052094', 800.00, NULL, 'success', '2025-09-17 02:48:14', NULL, '2025-09-17 02:48:14', '2025-09-17 02:48:14'),
(30, NULL, 22, '0', 'mtn_momo', 'TXN1758052567', 11500.00, NULL, 'success', '2025-09-17 02:56:07', NULL, '2025-09-17 02:56:07', '2025-09-17 02:56:07'),
(31, NULL, 22, '0', 'mtn_momo', 'TXN1758080106', 5300.00, NULL, 'success', '2025-09-17 10:35:06', NULL, '2025-09-17 10:35:06', '2025-09-17 10:35:06'),
(32, NULL, 22, '0', 'cash', 'TXN1758080542', 4600.00, NULL, 'success', '2025-09-17 10:42:22', NULL, '2025-09-17 10:42:22', '2025-09-17 10:42:22'),
(33, NULL, 22, '0', 'card', 'TXN1758080608', 800.00, NULL, 'success', '2025-09-17 10:43:28', NULL, '2025-09-17 10:43:28', '2025-09-17 10:43:28'),
(34, NULL, 22, '0', 'mtn_momo', 'TXN1758080695', 700.00, NULL, 'success', '2025-09-17 10:44:55', NULL, '2025-09-17 10:44:55', '2025-09-17 10:44:55'),
(35, NULL, 24, '0', 'mtn_momo', 'TXN1758145100', 1600.00, NULL, 'success', '2025-09-18 04:38:20', NULL, '2025-09-18 04:38:20', '2025-09-18 04:38:20'),
(36, NULL, 44, '5', 'mtn_momo', '123', 5000.00, NULL, 'success', NULL, NULL, '2025-09-19 01:28:34', '2025-09-19 01:28:34'),
(37, NULL, 44, '5', 'mtn_momo', '123', 5000.00, NULL, 'success', NULL, NULL, '2025-09-19 01:28:37', '2025-09-19 01:28:37'),
(38, NULL, 44, '2', 'mtn_momo', '123', 10000.00, NULL, 'success', NULL, NULL, '2025-09-19 01:36:26', '2025-09-19 01:36:26'),
(39, NULL, 44, '3', 'cash', '123', 80000.00, NULL, 'success', NULL, NULL, '2025-09-19 01:41:18', '2025-09-19 01:41:18'),
(40, NULL, 44, '1', 'mtn_momo', '23', 25000.00, NULL, 'success', NULL, NULL, '2025-09-19 01:52:10', '2025-09-19 01:52:10'),
(41, NULL, 76, '28', 'cash', '123', 100000.00, NULL, 'success', NULL, NULL, '2025-09-19 01:57:53', '2025-09-19 01:57:53'),
(42, NULL, 76, '2', 'cash', '123', 10000.00, NULL, 'success', NULL, NULL, '2025-09-19 02:04:37', '2025-09-19 02:04:37'),
(43, NULL, 49, '2', 'mtn_momo', '123', 10000.00, NULL, 'success', NULL, NULL, '2025-09-19 13:28:00', '2025-09-19 13:28:00'),
(44, NULL, 53, '2', 'cash', '123', 10000.00, NULL, 'success', NULL, NULL, '2025-09-19 14:16:18', '2025-09-19 14:16:18'),
(45, NULL, 22, '1', 'airtel_money', '68d88e571dbb5', 80000.00, NULL, 'pending', '2025-09-28 08:24:39', NULL, '2025-09-28 08:24:39', '2025-09-28 08:24:39'),
(46, NULL, NULL, '1', 'cash', NULL, 50000.00, NULL, 'success', '2025-09-29 17:23:48', NULL, '2025-09-29 17:23:48', '2025-09-29 17:23:48'),
(47, NULL, NULL, '1', 'cash', NULL, 40000.00, NULL, 'success', '2025-09-29 17:24:00', NULL, '2025-09-29 17:24:00', '2025-09-29 17:24:00'),
(48, NULL, NULL, '1', 'cash', NULL, 40000.00, NULL, 'success', '2025-09-29 17:39:27', NULL, '2025-09-29 17:39:27', '2025-09-29 17:39:27'),
(49, NULL, NULL, '1', 'cash', NULL, 40000.00, NULL, 'success', '2025-09-29 22:33:06', NULL, '2025-09-29 22:33:06', '2025-09-29 22:33:06'),
(50, NULL, NULL, '1', 'bank', NULL, 43443.00, NULL, 'success', '2025-10-21 00:17:40', NULL, '2025-10-21 00:17:40', '2025-10-21 00:17:40'),
(51, NULL, NULL, 'Repair Payment', 'mtn_momo', NULL, 30000.00, NULL, 'success', '2025-10-27 00:19:12', NULL, '2025-10-27 00:19:12', '2025-10-27 00:19:12'),
(52, NULL, NULL, 'Repair Payment', 'airtel_money', NULL, 30000.00, NULL, 'success', '2025-10-27 00:19:21', NULL, '2025-10-27 00:19:21', '2025-10-27 00:19:21'),
(53, NULL, NULL, 'Repair Payment', 'mtn_momo', NULL, 60000.00, NULL, 'success', '2025-10-27 01:15:22', NULL, '2025-10-27 01:15:22', '2025-10-27 01:15:22'),
(54, NULL, NULL, 'Repair Payment', 'mtn_momo', NULL, 60000.00, NULL, 'success', '2025-10-27 02:25:16', NULL, '2025-10-27 02:25:16', '2025-10-27 02:25:16'),
(55, NULL, NULL, 'Repair Payment', 'cash', NULL, 20000.00, NULL, 'success', '2025-10-27 02:27:31', NULL, '2025-10-27 02:27:31', '2025-10-27 02:27:31'),
(56, NULL, NULL, 'Repair Payment', 'mtn_momo', NULL, 20000.00, NULL, 'success', '2025-10-27 02:27:46', NULL, '2025-10-27 02:27:46', '2025-10-27 02:27:46'),
(57, NULL, NULL, 'Repair Payment', 'cash', NULL, 60000.00, NULL, 'success', '2025-10-27 12:04:12', NULL, '2025-10-27 12:04:12', '2025-10-27 12:04:12'),
(58, NULL, NULL, 'Repair Payment', 'mtn_momo', NULL, 20000.00, NULL, 'success', '2025-10-27 12:12:49', NULL, '2025-10-27 12:12:49', '2025-10-27 12:12:49'),
(59, NULL, NULL, 'Repair Payment', 'airtel_money', NULL, 20000.00, NULL, 'success', '2025-10-27 12:19:49', NULL, '2025-10-27 12:19:49', '2025-10-27 12:19:49'),
(60, NULL, NULL, 'Repair Payment', 'airtel_money', NULL, 20000.00, NULL, 'success', '2025-10-27 12:19:49', NULL, '2025-10-27 12:19:49', '2025-10-27 12:19:49'),
(61, NULL, NULL, 'Repair Payment', 'airtel_money', NULL, 2222.00, NULL, 'success', '2025-10-27 12:22:25', NULL, '2025-10-27 12:22:25', '2025-10-27 12:22:25'),
(62, NULL, NULL, NULL, 'mtn_momo', NULL, 0.00, NULL, 'success', '2025-10-28 02:59:15', NULL, '2025-10-28 02:59:15', '2025-10-28 02:59:15'),
(63, NULL, NULL, NULL, 'bank', NULL, 0.00, NULL, 'success', '2025-10-29 20:19:19', NULL, '2025-10-29 20:19:19', '2025-10-29 20:19:19');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `craftsperson_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `last_four` varchar(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('Draft','Published') NOT NULL DEFAULT 'Draft',
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `published` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `status`, `image`, `created_at`, `updated_at`, `stock`, `published`) VALUES
(2, 'iPhones', '“New iPhone 15 with 256GB storage and advanced camera features.”', 10000000.00, 'Published', 'products/GkDYxz7bautGaqtUhvjaWjWhViD9RMQUAqNYbtYm.png', '2025-08-13 16:35:09', '2025-10-28 03:45:59', 0, 0),
(3, 'New Bland', 'Old red telephone isolated on whiteLargest size:\r\n4752 x 3168 px (15.8', 700.00, 'Published', 'products/R90sjkKwoRGCDhp46iIaSAMbmaXuOD0qoOcifhys.jpg', '2025-08-13 16:54:21', '2025-08-13 16:54:35', 0, 0),
(4, 'Laptop', 'The 3 Best Apple Laptops And MacBooks of 2025: Reviews ...', 8000.00, 'Published', 'products/ASnq2VDFKpniQvAvLenAfMCOrejjf15x16HWbRHR.jpg', '2025-08-13 16:56:58', '2025-10-07 10:11:56', 0, 0),
(5, 'Electric Iron', '\"Compact electric iron for quick and efficient wrinkle removal, with adjustable temperature settings for all fabrics.\"', 100.00, 'Published', 'products/s6Y1lmlfJJ6SSEOfmDhcVFN8XzCCkGxKKXUitEDd.png', '2025-08-13 19:31:47', '2025-10-07 10:12:06', 0, 1),
(6, 'Phone', 'A new bland phone is comming soon! Please Come to our shop!', 500.00, 'Published', 'products/08GcA0q3qGw5SvSsvKw1F5w3Rro48e5A4zKSBNIK.png', '2025-08-13 21:56:26', '2025-10-07 10:11:45', 0, 1),
(7, 'Desktop Computers', 'We have bland new desktop computers , multi-purpose and with high capacity in performance RAM,processor,Screen/Monitor', 600.00, 'Published', 'products/MzyxYHG9Yb2pLpGHTtfw9GgsxnaWbtHAvnmYgxY7.png', '2025-08-13 22:20:02', '2025-10-05 15:32:47', 0, 0),
(8, 'Pianno', 'Grand Piano', 1000000.00, 'Published', 'products/KYkmrN2l4yRWynr5CRno3Fk7ZhCiqxPHiyp9aoeG.png', '2025-08-21 00:31:27', '2025-10-07 10:12:15', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products_services`
--

CREATE TABLE `products_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('product','service') NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `image` varchar(255) DEFAULT NULL COMMENT 'Optional product/service image',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_services`
--

INSERT INTO `products_services` (`id`, `client_id`, `type`, `published`, `title`, `description`, `price`, `status`, `image`, `created_at`, `updated_at`) VALUES
(7, 26, 'service', 1, 'Coco', 'New Model', 2222.00, 'Active', NULL, '2025-10-07 10:39:58', '2025-10-07 10:40:43');

-- --------------------------------------------------------

--
-- Table structure for table `product_likes`
--

CREATE TABLE `product_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_service_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `subscription_plan` varchar(255) DEFAULT NULL,
  `next_billing_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `question_text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `register_repairs`
--

CREATE TABLE `register_repairs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `device_name` varchar(255) NOT NULL,
  `device_model` varchar(255) DEFAULT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `issue_description` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_contact` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `date_received` date DEFAULT NULL,
  `expected_completion_date` date DEFAULT NULL,
  `diagnosis` text DEFAULT NULL,
  `repair_actions` text DEFAULT NULL,
  `repair_status` varchar(255) NOT NULL DEFAULT 'pending',
  `repair_cost` decimal(10,2) DEFAULT NULL,
  `technician` varchar(255) DEFAULT NULL,
  `warranty_status` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `register_repairs`
--

INSERT INTO `register_repairs` (`id`, `device_name`, `device_model`, `serial_number`, `issue_description`, `customer_name`, `customer_contact`, `customer_email`, `date_received`, `expected_completion_date`, `diagnosis`, `repair_actions`, `repair_status`, `repair_cost`, `technician`, `warranty_status`, `notes`, `created_at`, `updated_at`) VALUES
(2, 'Mobile Phone', 'iPhone', 'HT123UTC', 'Clear', 'Innocent NTAKIRUTIMANA', '0787832490', 'innocentntakir@gmail.com', '2025-07-30', '2025-08-02', 'Kept Clean', 'Screen Repair', 'completed', 30000.00, 'James', NULL, NULL, '2025-08-02 19:27:29', '2025-08-02 19:27:29');

-- --------------------------------------------------------

--
-- Table structure for table `repairs`
--

CREATE TABLE `repairs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `device_type` varchar(255) DEFAULT NULL,
  `device_name` varchar(255) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `operating_system` varchar(255) DEFAULT NULL,
  `device_owner` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `received_date` date NOT NULL,
  `warranty_status` enum('Under Warranty','Out of Warranty') NOT NULL,
  `problem_description` text NOT NULL,
  `solved_problems` text DEFAULT NULL,
  `recommendations` text DEFAULT NULL,
  `technician` varchar(255) DEFAULT NULL,
  `estimated_cost` decimal(10,2) DEFAULT NULL,
  `repair_status` enum('Pending','In Progress','Completed') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `repairs`
--

INSERT INTO `repairs` (`id`, `device_type`, `device_name`, `serial_number`, `brand`, `model`, `operating_system`, `device_owner`, `contact_number`, `received_date`, `warranty_status`, `problem_description`, `solved_problems`, `recommendations`, `technician`, `estimated_cost`, `repair_status`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Desktop', 'SAMSUNG', 'HTc454VT', 'lexic', '12Px', 'Android', 'Clementine', '0787832490', '2025-08-15', 'Under Warranty', 'The screen', NULL, NULL, 'Kalisa Tec', 30000.00, 'Pending', '2025-08-04 00:03:19', '2025-08-04 00:03:19', 'pending'),
(2, 'Television', 'T71', 'q123rTsc', 'SAMSUNG', 'SAMSUNG', 'Android', 'Joseph', '0787843533', '2025-08-03', 'Out of Warranty', 'Screen Problems', NULL, NULL, 'Claude Kayumba', 50000.00, 'Pending', '2025-08-04 13:38:51', '2025-09-08 16:53:27', 'pending'),
(3, 'Desktop', 'Pc', '345gtH', 'Phone', 'iPhone', 'a', 'Karekezi', '078787878787', '2025-08-20', 'Out of Warranty', 'Reapair', NULL, NULL, 'Kayumaba', 70000.00, 'In Progress', '2025-08-20 05:26:57', '2025-08-20 05:26:57', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '', NULL, NULL),
(2, 'manager', '', NULL, NULL),
(3, 'supervisor', '', NULL, NULL),
(4, 'technician', '', NULL, NULL),
(5, 'mechanic', '', NULL, NULL),
(6, 'craftsperson', '', NULL, NULL),
(7, 'businessperson', '', NULL, NULL),
(8, 'tailor', '', NULL, NULL),
(9, 'mediator', '', NULL, NULL),
(10, 'client', '', NULL, NULL),
(11, 'admin', 'web', '2025-09-14 21:03:53', '2025-09-14 21:03:53'),
(12, 'manager', 'web', '2025-09-14 21:03:53', '2025-09-14 21:03:53'),
(13, 'supervisor', 'web', '2025-09-14 21:03:53', '2025-09-14 21:03:53'),
(14, 'technician', 'web', '2025-09-14 21:03:53', '2025-09-14 21:03:53'),
(15, 'mechanician', 'web', '2025-09-14 21:03:53', '2025-09-14 21:03:53'),
(16, 'businessperson', 'web', '2025-09-14 21:03:53', '2025-09-14 21:03:53'),
(17, 'craftsperson', 'web', '2025-09-14 21:03:53', '2025-09-14 21:03:53'),
(18, 'mediator', 'web', '2025-09-14 21:03:53', '2025-09-14 21:03:53'),
(19, 'tailor', 'web', '2025-09-14 21:03:53', '2025-09-14 21:03:53'),
(20, 'client', 'web', '2025-09-14 21:03:53', '2025-09-14 21:03:53');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `units_sold` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `revenue` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `available_time` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `category` varchar(255) DEFAULT NULL,
  `client_id` bigint(20) NOT NULL DEFAULT 1,
  `technician_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `price`, `duration`, `available_time`, `is_active`, `category`, `client_id`, `technician_id`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 'Repair', 'Computer', 10000.00, '20 Min', '5:00 Am', 1, 'Service', 0, 5, 22, '2025-09-09 04:13:32', '2025-09-17 14:04:29'),
(3, 'Driving', 'I need a car for my wedding', 80000.00, '24 hrs', '5:00 Am', 1, 'Service', 0, 21, 22, '2025-09-09 04:15:21', '2025-09-17 14:04:40'),
(4, 'E-Learning Access', 'Online training for technicians, managers, and business owners', 20000.00, 'I month', '3', 1, 'Learning & Training', 0, 23, 22, '2025-09-09 05:28:59', '2025-09-17 18:49:13'),
(5, 'Meetings Management', 'Organize and manage online/offline meetings with reminders and notifications', 5000.00, 'Per meeting', '5:00 Am', 1, 'Productivity Tools', 0, 14, 22, '2025-09-09 05:30:12', '2025-09-17 17:36:52'),
(6, 'Invoicing & Payments', 'Generate invoices, manage payments, and track transactions', 8000.00, '45 min', '12:12', 1, 'Subscription', 0, 0, 22, '2025-09-09 05:31:17', '2025-09-09 05:31:17'),
(28, 'Transport', 'Taxi', 100000.00, '20 Min', '6:00 AM', 1, 'Service', 0, 20, NULL, '2025-09-09 15:29:12', '2025-09-17 14:04:46'),
(36, 'Marketing', 'We help you for advertisement to your products.', 100000.00, '30', '5:00 Am', 1, 'Service', 0, 0, NULL, '2025-09-10 13:42:14', '2025-09-10 13:42:14'),
(37, 'Innocent', 'dfgh', 8888.00, '10', '12:00 AM', 1, 'fruits', 1, NULL, NULL, '2025-10-05 18:58:51', '2025-10-05 18:58:51'),
(38, 'Reparation', 'fccgcvd', 400000.00, '2', 'morning', 1, 'Electronics', 1, NULL, NULL, '2025-10-21 00:13:23', '2025-10-21 00:13:23');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('oZixHQTAfxIdg9yo88cuyETcD8L0UyIU0penE2Zi', 22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUHRHUjJNb2pHcmZKem00Z0I2Y2NrMUl5NnU3NFlOM2ZzRHc1THZrSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jcmVhdGVfdXBkYXRlcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjIyO30=', 1765890668);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'language', 'en', '2025-08-16 05:50:47', '2025-08-16 05:50:47'),
(2, 'direction', 'ltr', '2025-08-16 05:50:47', '2025-08-16 05:50:47');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `plan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `plan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('active','inactive','cancelled') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `client_id`, `start_date`, `end_date`, `email`, `user_id`, `plan_id`, `price`, `plan`, `created_at`, `updated_at`, `status`) VALUES
(1, NULL, NULL, '0000-00-00', 'innocentntakir@gmail.com', 0, NULL, 50.00, 'Premium', '2025-08-13 02:51:58', '2025-09-16 22:15:38', 'active'),
(2, NULL, NULL, '0000-00-00', 'inonecdreams@gmail.com', 0, NULL, 10.00, 'Basic', '2025-08-13 21:30:16', '2025-09-16 20:17:19', 'active'),
(3, NULL, NULL, '2025-10-16', '', 22, 1, 25.00, 'Standard', '2025-09-16 19:23:26', '2025-09-16 22:48:18', 'inactive'),
(4, NULL, NULL, NULL, 'lolombe@gmail.com', NULL, NULL, NULL, NULL, '2025-10-03 10:06:04', '2025-10-03 10:06:04', 'active'),
(5, NULL, NULL, NULL, 'kellia@gmail.com', NULL, NULL, NULL, NULL, '2025-10-03 10:08:51', '2025-10-03 10:08:51', 'active'),
(6, NULL, NULL, NULL, 'kamana@gmail.com', NULL, NULL, NULL, NULL, '2025-10-03 10:09:25', '2025-10-03 10:09:25', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tailor_products`
--

CREATE TABLE `tailor_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tailor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `quantity` decimal(10,2) NOT NULL DEFAULT 0.00,
  `unit` varchar(50) NOT NULL,
  `status` enum('Available','Out of Stock','Unavailable') NOT NULL DEFAULT 'Available',
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tailor_products`
--

INSERT INTO `tailor_products` (`id`, `tailor_id`, `name`, `category`, `price`, `quantity`, `unit`, `status`, `image`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Needles', 'Tools', 300.00, 15.00, '300', 'Out of Stock', 'products/e9FlaM5k1HcWIRMmNEfootvOwSyCSIZvrBZN5wws.jpg', '2025-10-02 18:16:07', '2025-10-02 18:16:07'),
(2, 22, 'Needles', 'Tools', 290.00, 15.00, '240', 'Unavailable', 'products/n85Zl41MoET5bpmBojd7aOAWwQAmOT38vkTquUcO.jpg', '2025-10-02 18:20:12', '2025-10-02 18:26:41'),
(3, 22, 'Clothes', 'Clothes', 10000.00, 10.00, '10000', 'Unavailable', 'products/Kbp4s0LQddyObzMhDDWp5p3mTp2HX6oxXmozyV2U.webp', '2025-10-02 18:27:56', '2025-10-02 18:30:20'),
(4, 22, 'Vithusha Stores', 'Stores', 100000.00, 70.00, '10000', 'Unavailable', 'products/L8Cc4YKkmaXDJcHtX6PK217kSpISP5XgJOQkqmBD.jpg', '2025-10-02 18:29:57', '2025-10-02 18:31:02'),
(5, 22, 'Vithusha Stores', 'Stores', 100000.00, 70.00, '10000', 'Unavailable', 'products/yQ3BbWNDpB23gxNoCyWNdceFpoaZHE32B8IHVbzP.jpg', '2025-10-02 18:29:58', '2025-10-02 18:31:04');

-- --------------------------------------------------------

--
-- Table structure for table `tailor_repairs`
--

CREATE TABLE `tailor_repairs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_contact` varchar(50) DEFAULT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_model` varchar(255) DEFAULT NULL,
  `repair_details` text NOT NULL,
  `repair_status` enum('Pending','In Progress','Completed','Collected') DEFAULT 'Pending',
  `price` decimal(10,2) DEFAULT 0.00,
  `date_received` date NOT NULL,
  `expected_completion_date` date DEFAULT NULL,
  `date_completed` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tailor_repairs`
--

INSERT INTO `tailor_repairs` (`id`, `customer_name`, `customer_contact`, `item_name`, `item_model`, `repair_details`, `repair_status`, `price`, `date_received`, `expected_completion_date`, `date_completed`, `created_at`, `updated_at`) VALUES
(1, 'Kabera', '078783534262', 'Umwenda', 'Pantalon', 'Umukara numuhondo nicyatsi', 'Completed', 2000.00, '2025-10-30', '2025-10-17', NULL, '2025-10-02 16:01:09', '2025-10-02 16:41:03');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('pending','in_progress','completed') NOT NULL DEFAULT 'pending',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Reparation', 'We need you to support in Repair of my Laptop', 'in_progress', NULL, '2025-09-08 15:24:53', '2025-09-08 17:24:39'),
(2, 'Consultation', 'Reception', 'completed', NULL, '2025-09-08 15:41:05', '2025-09-08 16:55:23'),
(5, 'Driving', 'Taxi', 'pending', 21, '2025-09-08 17:33:26', '2025-09-08 17:33:26'),
(6, 'Renting', 'Laptop', 'in_progress', 16, '2025-09-08 17:33:53', '2025-09-08 17:35:32'),
(7, 'Marketing', 'Housing', 'pending', 15, '2025-09-08 17:34:25', '2025-09-08 17:34:25'),
(8, 'Relocation', 'Nyabyondo', 'in_progress', NULL, '2025-09-08 17:35:00', '2025-09-09 19:31:36'),
(9, 'Driving', 'today', 'in_progress', 18, '2025-10-20 23:00:48', '2025-10-20 23:01:43');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('published','unpublished') NOT NULL DEFAULT 'unpublished'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `full_name`, `position`, `contact`, `email`, `image`, `facebook`, `twitter`, `linkedin`, `instagram`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Mr. Girbert', 'Founder (CEO)', '+250 788 446 936', 'info@ivara.rw', 'team/HeK6qy0kh0eqWvQB51lHYVuws1Bt7iYbKzY1YAvy.jpg', NULL, NULL, NULL, NULL, '2025-08-13 20:21:06', '2025-10-20 22:02:04', 'published'),
(2, 'Basile NDUWAYEZU', 'Technical & Digital Entrepreneurship Manager', '+250 788 446 936', 'basile@gmail.com', 'team/LUvtOZUzaXvoGJBfxphRmAWR95OPzMEr0mJSS70Z.jpg', NULL, NULL, NULL, NULL, '2025-08-13 20:36:47', '2025-10-20 22:02:05', 'published'),
(3, 'Clarisse IRADUKUNDA', 'Finance & Administration Manager', '+250 788 446 936', 'clarisse@gmail.com', 'team/QZf9kp5v9AjtfW86UOSx4RJGK8EumEWSLxxYEY2f.jpg', NULL, NULL, NULL, NULL, '2025-08-13 20:39:33', '2025-10-20 22:02:08', 'published'),
(4, 'Edmond TURASA', 'Marketing Manager', '+250 788 446 936', 'edmod@gmail.com', 'team/lX8heK5IPuRCFMTE057TxHZGwYon032KUAEimLCN.png', NULL, NULL, NULL, NULL, '2025-08-13 20:40:31', '2025-10-20 22:02:09', 'published');

-- --------------------------------------------------------

--
-- Table structure for table `technicians`
--

CREATE TABLE `technicians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `expertise` varchar(255) NOT NULL,
  `experience_years` int(11) DEFAULT NULL,
  `certifications` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive','on_leave') DEFAULT 'active',
  `location` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `registered_on` date DEFAULT NULL,
  `received_by` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `technicians`
--

INSERT INTO `technicians` (`id`, `name`, `email`, `phone`, `expertise`, `experience_years`, `certifications`, `status`, `location`, `notes`, `registered_on`, `received_by`, `position`, `created_at`, `updated_at`) VALUES
(2, 'Girbert GB', 'gilbert@gmail.com', '+25078782323', 'Hardware Maintenence', 3, '23', 'inactive', 'Kivugizaa', 'Good', '2025-08-16', 'James', 'IT', '2025-08-03 12:13:36', '2025-08-20 05:47:39'),
(3, 'Innocent NTAKIRUTIMANA', 'innocentntakir@gmail.com', '+250787832490', 'Hardware Maintenence', 3, '23', 'active', 'Kivugiza/Nyamirambo', 'Work all Days', '2025-08-06', 'James', 'IT', '2025-08-03 16:40:04', '2025-08-03 16:40:04'),
(4, 'Umwiza Umwali', 'umu@gmail.com', '+250787832490', 'Hardware Maintenence', 2, 'Maintenance', 'on_leave', 'Remera', 'Keeep it safe', '2025-08-22', 'Kabera', 'Technician team leader', '2025-08-10 16:28:58', '2025-08-10 16:28:58'),
(5, 'Babindigili', 'kabindigili@gmail.com', '787832490', 'Screen Repair', 5, 'Get Certified', 'inactive', 'Kigali City', 'Tue', '2025-09-12', 'Kenny', 'Manager', '2025-08-12 19:33:34', '2025-08-12 19:33:34'),
(10, 'Innocent NTAKIRUTIMANA', 'innocentntakirs@gmail.com', '787832490', 'Hardware Maintenence', 3, 'Maintenance', 'on_leave', 'Remera', 'Good', '2025-08-22', 'Kabera', 'Marketing Manager', '2025-08-20 03:29:47', '2025-08-20 03:29:47'),
(11, 'Innocent James', 'innocentntak@gmail.com', '0787832490', 'Hardware Maintenence', NULL, NULL, 'inactive', 'Remera', NULL, NULL, NULL, NULL, '2025-08-20 05:48:05', '2025-08-20 05:48:05');

-- --------------------------------------------------------

--
-- Table structure for table `technician_products`
--

CREATE TABLE `technician_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `technician_id` bigint(20) UNSIGNED NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `technician_products`
--

INSERT INTO `technician_products` (`id`, `name`, `description`, `price`, `stock`, `image`, `brand`, `category`, `technician_id`, `is_published`, `created_at`, `updated_at`) VALUES
(3, 'Adam', 'ss', 233.00, 3, 'products/FnSrEUWzfS6DPZVIQiCaq9621nrbhPPCJF2MbHsT.jpg', 'New', 'Men', 4, 0, '2025-09-27 06:35:57', '2025-10-21 00:04:50'),
(5, 'Radio', 'SONITEC', 20000.00, 20, 'products/gIWk8cajvz1rxbKSo0jX9f0SxdS4S9UOYYkOImY2.jpg', 'Radio', 'Radio', 4, 0, '2025-09-28 00:47:34', '2025-09-28 00:47:34'),
(7, 'Radio', 'SONITEC', 20000.00, 20, 'products/WhtuQP6D1CYxXW6CibUFioo9kYeJrBOTWr0IAPEi.jpg', 'Radio', 'Radio', 4, 1, '2025-09-28 00:49:54', '2025-09-28 00:50:57'),
(8, 'Ecouteur', 'Ecouteur', 15000.00, 50, 'products/UQXGf8H9HtoPCDyn4vTJs8ZNhm8SPVmC8aEEHa2R.jpg', 'New', 'Ecouteur', 4, 1, '2025-09-28 00:50:51', '2025-09-28 00:51:01');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mediator_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `activity_type` varchar(255) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `commission_percentage` decimal(5,2) NOT NULL DEFAULT 10.00,
  `commission_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','paid') NOT NULL DEFAULT 'pending',
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `updates`
--

CREATE TABLE `updates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `updates`
--

INSERT INTO `updates` (`id`, `event_name`, `date`, `location`, `image`, `description`, `created_at`, `updated_at`) VALUES
(5, 'EXPO', '2025-08-07', 'Kibagabaga', 'updates_images/oSC3hPeSzCyNpHUwgPrdnbzoSIoDtZlhslkWlhKT.png', 'Join us at the IVARA Tech & Innovation Expo 2025, a premier gathering of technology enthusiasts, innovators, and industry leaders. This three-day event showcases the latest advancements in IT, digital solutions, startups, and local innovations.', '2025-08-13 21:19:43', '2025-08-13 21:19:43'),
(9, 'EXPO2', '2025-10-09', 'Kivugizaa', NULL, 'Happy to see you!', '2025-10-06 22:21:36', '2025-10-06 22:21:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `country_code` varchar(10) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'client',
  `password` varchar(255) NOT NULL,
  `two_factor_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `2fa_enabled` tinyint(1) DEFAULT 0,
  `2fa_secret` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `country_code`, `phone`, `email`, `location`, `role`, `password`, `two_factor_enabled`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `status`, `2fa_enabled`, `2fa_secret`) VALUES
(14, 'Athanase Mudaheranwa', 'Athanase Papa', NULL, '07878324901', 'athanase1@gmail.com', 'Matare', 'technician', '$2y$12$P/ZKLX8rAE6ur6rIZ9yt4u3TUW.4z1T5tGqpkFa9fpGdE6UFAU4oO', 0, NULL, NULL, '2025-08-04 04:36:51', '2025-10-26 21:38:44', 'inactive', 0, NULL),
(15, 'Kayumba Nyamwasa', 'Nyamwasa', 'RW - 250', '078783249111', 'nyamwasa@gmail.com', 'Karuruma', 'technician', '$2y$12$WHTjCQQ9L12yKjgpFNtIuObGiplJQePdxmzouKGjR6VF5u16Kjwku', 0, NULL, NULL, '2025-08-04 04:45:32', '2025-10-05 13:53:40', 'active', 0, NULL),
(16, 'Kwizera Emille', 'Emille', 'US - 1', '78782323111', 'gilbert@gmail.com', 'Kabeza', 'mechanician', '$2y$12$MlUMiZ6VZKj7FqHlZEZASek6ppK62dtTjLrXr6.5W3KetXjtA158q', 0, NULL, NULL, '2025-08-04 04:48:21', '2025-08-26 07:27:33', 'active', 0, NULL),
(18, 'Muhunde', 'Muhunde', 'US - 1', '78782323122', 'muh@gmail.com', '', 'client', '$2y$12$8Q2Hi7X9mTaZUJidTxQde.IAe7Ow/7KZ7Gej5d1kQyC70UYYwtEv6', 0, NULL, NULL, '2025-08-04 04:57:14', '2025-08-04 04:57:14', 'active', 0, NULL),
(21, 'Lavie James', 'James', 'RW - 250', '7878324565', 'james@gmail.com', 'Karuruma', 'technician', '$2y$12$Uxl4z1FRkTD.U8DWPp/BB.4kc6wRfuh6w.5IElEE79P6jS2Rt7Vse', 0, NULL, NULL, '2025-08-04 13:19:44', '2025-08-04 13:19:44', 'active', 0, NULL),
(22, 'Innocent ', 'Kalori', 'RW - 250', '78783244', 'admin@gmail.com', '', 'admin', '$2y$12$fy4bFAbJZ8pdOsjorLAC2usF.w2TkrXwczkOx37ZLyLnpk02xfXDS', 0, NULL, 'B3ICuNqMmaOf4B1L1PufVta0c6TeIZ65AR2VTPtpwyknyzYor2c7Pe8mteVU', '2025-08-07 01:32:08', '2025-10-29 19:44:42', 'inactive', 0, NULL),
(25, 'Innocent NTAKIRUTIMANA', 'Innocent NTAK', '250', '787832490', 'inonecdreams@gmail.com', 'Unknown', 'mediator', '$2y$12$hOz6dpJRPPmueL2bSOsp6Oj7IHtRXUObPJLXNDEjFeoUCKiTrhw36', 0, NULL, NULL, '2025-09-18 08:59:51', '2025-09-18 08:59:51', 'active', 0, NULL),
(26, 'Simon Peter', 'Simon', NULL, '0787832490', 'simonpeter@gmail.com', NULL, 'client', '$2y$12$pTC/sJrg0Q63v7BSaK/20OMg/HcPHgDEdRJo6VtwUzmUc5O3/.rPC', 0, NULL, NULL, '2025-10-04 22:48:28', '2025-10-05 14:38:30', 'active', 0, NULL),
(27, 'Kabera Jimmy', 'Kabera', NULL, '0780001111111', 'kabera@gmail.com', NULL, 'client', '$2y$12$3YvDED8.HvFxOSH4a3apL.kW1NVRH9yKGODklBUVhZX72fgmx5n9K', 0, NULL, NULL, '2025-10-05 14:19:34', '2025-10-06 22:11:24', 'inactive', 0, NULL),
(28, 'lavie Gianni', 'Gianni', '250', '0787832491', 'gianni@gmail.com', NULL, 'mechanic', '$2y$12$JG7IvPqHFRO6Lm85iMjZBembD30DVoMjTBsyTOgpAHMitSz1aapY.', 0, NULL, NULL, '2025-10-23 11:42:43', '2025-10-25 21:45:55', 'active', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_scores`
--

CREATE TABLE `user_scores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `enrollment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `completion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `score` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `make` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `vehicle_type` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `registration_number`, `make`, `model`, `year`, `color`, `vehicle_type`, `status`, `created_at`, `updated_at`) VALUES
(1, '1234', 'USA', 'Bronze', 2332, 'Black', 'Toyota', 'inactive', '2025-09-27 22:27:00', '2025-09-27 22:27:00'),
(2, '12345', 'USA', 'Laptop', 2025, 'Red', 'Toyota Collora', 'scrapped', '2025-09-28 02:27:53', '2025-09-28 02:27:53'),
(3, '12344', 'USA', 'Laptop', 4444, '333', '444', 'inactive', '2025-09-28 07:10:51', '2025-09-28 07:10:51');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_repairs`
--

CREATE TABLE `vehicle_repairs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `technician` varchar(255) DEFAULT NULL,
  `problem_description` text DEFAULT NULL,
  `solved_problems` text DEFAULT NULL,
  `recommendations` text DEFAULT NULL,
  `repair_status` enum('Pending','In Progress','Completed') DEFAULT 'Pending',
  `repair_price` decimal(12,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_repairs`
--

INSERT INTO `vehicle_repairs` (`id`, `vehicle_id`, `technician`, `problem_description`, `solved_problems`, `recommendations`, `repair_status`, `repair_price`, `created_at`, `updated_at`) VALUES
(1, 1, 'Claude Kayumba', 'Motor', 'Motor Problems', 'Small Speed', 'In Progress', 60000.00, '2025-10-26 23:30:43', '2025-10-27 00:19:47'),
(3, 3, 'Claude Kayumba', 'None', 'Today', 'Far from rain fall', 'In Progress', 20000.00, '2025-10-27 01:41:28', '2025-10-27 02:31:49'),
(4, 1, 'Claude Kayumba', 'ss', '222', '2222', 'Completed', 2222.00, '2025-10-27 12:22:01', '2025-10-27 12:22:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activities_user_id_index` (`user_id`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_client_id_foreign` (`client_id`),
  ADD KEY `bookings_service_id_foreign` (`service_id`);

--
-- Indexes for table `businessperson_products`
--
ALTER TABLE `businessperson_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_registers`
--
ALTER TABLE `business_registers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_business_registers_business` (`business_id`);

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
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_product_unique` (`user_id`,`product_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_user_id_foreign` (`user_id`),
  ADD KEY `clients_mediator_id_foreign` (`mediator_id`);

--
-- Indexes for table `client_product`
--
ALTER TABLE `client_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_product_id` (`product_id`),
  ADD KEY `fk_client` (`client_id`);

--
-- Indexes for table `client_services`
--
ALTER TABLE `client_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_services_client_id_foreign` (`client_id`),
  ADD KEY `client_services_service_id_foreign` (`service_id`);

--
-- Indexes for table `completions`
--
ALTER TABLE `completions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrollment_id` (`enrollment_id`),
  ADD KEY `lesson_id` (`lesson_id`);

--
-- Indexes for table `connected_devices`
--
ALTER TABLE `connected_devices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indexes for table `connections`
--
ALTER TABLE `connections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `connections_user_id_foreign` (`user_id`),
  ADD KEY `connections_connected_user_id_foreign` (`connected_user_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `craftsperson_products`
--
ALTER TABLE `craftsperson_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `craftsperson_id` (`craftsperson_id`);

--
-- Indexes for table `craftsperson_register_repair`
--
ALTER TABLE `craftsperson_register_repair`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serial_number` (`serial_number`),
  ADD KEY `fk_device_client` (`client_id`),
  ADD KEY `fk_device_technician` (`assigned_technician_id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_items`
--
ALTER TABLE `inventory_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_items_invoice_id_foreign` (`invoice_id`);

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
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `login_histories`
--
ALTER TABLE `login_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_login` (`user_id`);

--
-- Indexes for table `mechanic_products`
--
ALTER TABLE `mechanic_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mechanic_products_mechanic_id_foreign` (`mechanic_id`);

--
-- Indexes for table `mediators`
--
ALTER TABLE `mediators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_unique` (`user_id`);

--
-- Indexes for table `mediator_commissions`
--
ALTER TABLE `mediator_commissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mediator_id` (`mediator_id`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meetings_client_id_foreign` (`client_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `menus_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `menu_role`
--
ALTER TABLE `menu_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menu_role_unique` (`menu_id`,`role_id`),
  ADD KEY `menu_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`),
  ADD KEY `messages_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`),
  ADD KEY `notifications_booking_id_foreign` (`booking_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_product_id_foreign` (`product_id`),
  ADD KEY `orders_client_id_foreign` (`client_id`);

--
-- Indexes for table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_otps_user` (`user_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_menu_id_foreign` (`menu_id`),
  ADD KEY `pages_created_by_foreign` (`created_by`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_invoice_id_foreign` (`invoice_id`),
  ADD KEY `payments_client_id_foreign` (`client_id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_methods_user_id_foreign` (`user_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_services`
--
ALTER TABLE `products_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_client` (`client_id`);

--
-- Indexes for table `product_likes`
--
ALTER TABLE `product_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_user_unique` (`product_id`,`user_id`),
  ADD KEY `product_likes_user_id_foreign` (`user_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_id` (`lesson_id`);

--
-- Indexes for table `register_repairs`
--
ALTER TABLE `register_repairs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repairs`
--
ALTER TABLE `repairs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serial_number` (`serial_number`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_created_by_fk` (`created_by`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`key`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_subscriptions_client` (`client_id`);

--
-- Indexes for table `tailor_products`
--
ALTER TABLE `tailor_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tailor_repairs`
--
ALTER TABLE `tailor_repairs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_user_id_foreign` (`user_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `technicians`
--
ALTER TABLE `technicians`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `technician_products`
--
ALTER TABLE `technician_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `technician_products_technician_id_foreign` (`technician_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_mediator_id_foreign` (`mediator_id`),
  ADD KEY `transactions_client_id_foreign` (`client_id`);

--
-- Indexes for table `updates`
--
ALTER TABLE `updates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `users_country_code_phone_unique` (`country_code`,`phone`);

--
-- Indexes for table `user_scores`
--
ALTER TABLE `user_scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `quiz_id` (`quiz_id`),
  ADD KEY `enrollment_id` (`enrollment_id`),
  ADD KEY `completion_id` (`completion_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `registration_number` (`registration_number`);

--
-- Indexes for table `vehicle_repairs`
--
ALTER TABLE `vehicle_repairs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_vehicle` (`vehicle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=383;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `businessperson_products`
--
ALTER TABLE `businessperson_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `business_registers`
--
ALTER TABLE `business_registers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `client_product`
--
ALTER TABLE `client_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_services`
--
ALTER TABLE `client_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `completions`
--
ALTER TABLE `completions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `connected_devices`
--
ALTER TABLE `connected_devices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `connections`
--
ALTER TABLE `connections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `craftsperson_products`
--
ALTER TABLE `craftsperson_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `craftsperson_register_repair`
--
ALTER TABLE `craftsperson_register_repair`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_items`
--
ALTER TABLE `inventory_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=378;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_histories`
--
ALTER TABLE `login_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mechanic_products`
--
ALTER TABLE `mechanic_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mediators`
--
ALTER TABLE `mediators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `mediator_commissions`
--
ALTER TABLE `mediator_commissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_role`
--
ALTER TABLE `menu_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products_services`
--
ALTER TABLE `products_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_likes`
--
ALTER TABLE `product_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `register_repairs`
--
ALTER TABLE `register_repairs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `repairs`
--
ALTER TABLE `repairs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tailor_products`
--
ALTER TABLE `tailor_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tailor_repairs`
--
ALTER TABLE `tailor_repairs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `technicians`
--
ALTER TABLE `technicians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `technician_products`
--
ALTER TABLE `technician_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `updates`
--
ALTER TABLE `updates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_scores`
--
ALTER TABLE `user_scores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicle_repairs`
--
ALTER TABLE `vehicle_repairs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `business_registers`
--
ALTER TABLE `business_registers`
  ADD CONSTRAINT `fk_business_registers_business` FOREIGN KEY (`business_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products_services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD CONSTRAINT `chat_messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_mediator_id_foreign` FOREIGN KEY (`mediator_id`) REFERENCES `mediators` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `clients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `client_product`
--
ALTER TABLE `client_product`
  ADD CONSTRAINT `fk_client` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_client_product_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_client_product_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `client_services`
--
ALTER TABLE `client_services`
  ADD CONSTRAINT `client_services_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_services_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `completions`
--
ALTER TABLE `completions`
  ADD CONSTRAINT `completions_ibfk_1` FOREIGN KEY (`enrollment_id`) REFERENCES `enrollments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `completions_ibfk_2` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `connected_devices`
--
ALTER TABLE `connected_devices`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `connections`
--
ALTER TABLE `connections`
  ADD CONSTRAINT `connections_connected_user_id_foreign` FOREIGN KEY (`connected_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `connections_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `devices`
--
ALTER TABLE `devices`
  ADD CONSTRAINT `fk_device_client` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_device_technician` FOREIGN KEY (`assigned_technician_id`) REFERENCES `technicians` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `invoice_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `login_histories`
--
ALTER TABLE `login_histories`
  ADD CONSTRAINT `fk_user_login` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mechanic_products`
--
ALTER TABLE `mechanic_products`
  ADD CONSTRAINT `mechanic_products_mechanic_id_foreign` FOREIGN KEY (`mechanic_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mediators`
--
ALTER TABLE `mediators`
  ADD CONSTRAINT `fk_mediators_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mediator_commissions`
--
ALTER TABLE `mediator_commissions`
  ADD CONSTRAINT `mediator_commissions_ibfk_1` FOREIGN KEY (`mediator_id`) REFERENCES `mediators` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meetings`
--
ALTER TABLE `meetings`
  ADD CONSTRAINT `meetings_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `menu_role`
--
ALTER TABLE `menu_role`
  ADD CONSTRAINT `menu_role_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `otps`
--
ALTER TABLE `otps`
  ADD CONSTRAINT `fk_otps_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pages_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD CONSTRAINT `payment_methods_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products_services`
--
ALTER TABLE `products_services`
  ADD CONSTRAINT `fk_products_client` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_likes`
--
ALTER TABLE `product_likes`
  ADD CONSTRAINT `product_likes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products_services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `fk_profiles_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quizzes_ibfk_1` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `fk_subscriptions_client` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `technician_products`
--
ALTER TABLE `technician_products`
  ADD CONSTRAINT `technician_products_technician_id_foreign` FOREIGN KEY (`technician_id`) REFERENCES `technicians` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_mediator_id_foreign` FOREIGN KEY (`mediator_id`) REFERENCES `mediators` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_scores`
--
ALTER TABLE `user_scores`
  ADD CONSTRAINT `user_scores_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_scores_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_scores_ibfk_3` FOREIGN KEY (`enrollment_id`) REFERENCES `enrollments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `user_scores_ibfk_4` FOREIGN KEY (`completion_id`) REFERENCES `completions` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `vehicle_repairs`
--
ALTER TABLE `vehicle_repairs`
  ADD CONSTRAINT `fk_vehicle` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
