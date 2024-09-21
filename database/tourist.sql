-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2024 at 07:04 AM
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
-- Database: `tourist`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `activity_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `time_loged` time NOT NULL,
  `date_loged` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`activity_id`, `user_id`, `time_loged`, `date_loged`) VALUES
(59, 10, '08:28:50', '2023-10-11'),
(60, 10, '08:33:16', '2023-10-11'),
(61, 10, '08:42:42', '2023-10-11'),
(62, 12, '09:06:56', '2023-10-11'),
(63, 12, '09:07:01', '2023-10-11'),
(64, 10, '09:07:09', '2023-10-11'),
(65, 10, '10:39:37', '2023-10-13'),
(66, 12, '10:42:49', '2023-10-13'),
(67, 10, '10:44:35', '2023-10-13'),
(68, 10, '11:39:05', '2023-10-13'),
(69, 10, '11:40:25', '2023-10-13'),
(70, 10, '11:43:16', '2023-10-13'),
(71, 10, '11:44:37', '2023-10-13'),
(72, 10, '11:46:24', '2023-10-13'),
(73, 10, '11:50:21', '2023-10-13'),
(74, 10, '11:50:57', '2023-10-13'),
(75, 10, '11:52:01', '2023-10-13'),
(76, 10, '11:52:33', '2023-10-13'),
(77, 10, '12:02:53', '2023-10-13'),
(78, 10, '12:02:59', '2023-10-13'),
(79, 10, '15:35:34', '2023-10-17'),
(80, 10, '15:59:12', '2023-10-17'),
(81, 10, '16:00:50', '2023-10-17'),
(82, 10, '16:02:07', '2023-10-17'),
(83, 10, '16:07:18', '2023-10-17'),
(84, 10, '18:41:34', '2023-10-31'),
(85, 10, '18:55:48', '2023-10-31');

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

CREATE TABLE `audit_trail` (
  `id` int(11) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `user` varchar(45) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `audit_trail`
--

INSERT INTO `audit_trail` (`id`, `action`, `user`, `timestamp`) VALUES
(39, 'User logged out', 'fer', '2023-11-01 03:34:01'),
(40, 'User logged in', 'fer', '2023-11-01 03:39:09'),
(41, 'User logged out', 'fer', '2023-11-01 03:39:10'),
(42, 'User logged in', 'fer', '2023-11-01 03:40:54'),
(43, 'User logged out', 'fer', '2023-11-01 03:40:55'),
(44, 'User logged in', 'fer', '2023-11-01 03:42:57'),
(45, 'User logged out', 'fer', '2023-11-01 03:43:31'),
(46, 'User logged in', 'fer', '2023-11-01 03:43:35'),
(47, 'User logged out', 'fer', '2023-11-01 04:06:40'),
(48, 'User logged in', 'fer', '2023-11-01 06:59:42'),
(49, 'User logged out', 'fer', '2023-11-01 07:05:53'),
(50, 'User logged in', 'fer', '2023-11-01 07:05:57'),
(51, 'User logged in', 'fer', '2023-11-02 01:11:41'),
(52, 'User created', '', '2023-11-02 01:17:53'),
(53, 'User created', '', '2023-11-02 01:17:58'),
(54, 'User logged out', 'fer', '2023-11-02 01:19:31'),
(55, 'User logged in', 'bruh', '2023-11-02 01:21:19'),
(56, 'User logged out', 'bruh', '2023-11-02 01:24:20'),
(57, 'User logged in', 'fer', '2023-11-02 01:48:58'),
(58, 'User logged out', 'fer', '2023-11-02 01:49:37'),
(59, 'User logged in', 'fer', '2023-11-03 01:46:46'),
(60, 'User logged out', 'fer', '2023-11-03 02:33:09'),
(61, 'User logged in', 'xam', '2023-11-03 02:33:25'),
(62, 'User logged out', 'xam', '2023-11-03 02:33:37'),
(63, 'User logged in', 'fer', '2023-11-03 02:33:57'),
(64, 'User logged out', 'fer', '2023-11-03 02:38:45'),
(65, 'User logged in', 'yow', '2023-11-03 02:42:11'),
(66, 'User logged out', 'yow', '2023-11-03 02:50:27'),
(67, 'User logged in', 'pop', '2023-11-03 02:57:54'),
(68, 'User logged out', 'pop', '2023-11-03 03:08:50'),
(69, 'User logged in', 'pop', '2023-11-03 03:08:55'),
(70, 'User logged out', 'pop', '2023-11-03 03:12:36'),
(71, 'User logged in', 'fer', '2023-11-03 03:12:39'),
(72, 'User logged out', 'fer', '2023-11-03 03:14:30'),
(73, 'User logged in', 'pop', '2023-11-03 03:14:35'),
(74, 'User logged in', 'pop', '2023-11-03 04:25:26'),
(75, 'User logged out', 'pop', '2023-11-03 04:28:19'),
(76, 'User logged in', 'pop', '2023-11-03 05:00:58'),
(77, 'User logged out', 'pop', '2023-11-03 05:06:00'),
(78, 'User logged in', 'pop', '2023-11-03 05:06:04'),
(79, 'User logged in', 'asd', '2023-11-03 05:08:00'),
(80, 'User logged in', 'asd', '2023-11-03 06:20:58'),
(81, 'User logged out', 'asd', '2023-11-03 06:21:00'),
(82, 'User logged in', 'zxc', '2023-11-03 06:21:18'),
(83, 'User logged out', 'zxc', '2023-11-03 06:52:41'),
(84, 'User logged in', 'ror', '2023-11-03 06:53:09'),
(85, 'User logged out', 'ror', '2023-11-03 07:13:57'),
(86, 'User logged in', '12', '2023-11-03 07:16:02'),
(87, 'User logged out', '12', '2023-11-03 07:19:02'),
(88, 'User logged in', 'fer', '2023-11-03 08:33:23'),
(89, 'User created', '', '2023-11-03 09:00:33'),
(90, 'User logged in', 'fer', '2023-11-06 11:54:49'),
(91, 'User logged out', 'fer', '2023-11-06 12:25:42'),
(92, 'User logged in', 'zxc', '2023-11-06 12:26:10'),
(93, 'User logged in', 'fer', '2023-11-06 12:57:29'),
(94, 'User logged out', 'fer', '2023-11-06 13:11:45'),
(95, 'User logged in', 'zxc', '2023-11-06 13:11:47'),
(96, 'User logged in', 'fer', '2023-11-12 12:31:29'),
(97, 'User logged in', 'fer', '2023-11-12 12:37:34'),
(98, 'User logged in', 'fer', '2023-11-13 03:24:44'),
(99, 'User logged out', 'fer', '2023-11-13 03:59:24'),
(100, 'User logged in', 'zxc', '2023-11-13 03:59:32'),
(101, 'User logged in', 'fer', '2023-11-13 10:07:41'),
(102, 'User logged out', 'fer', '2023-11-13 10:36:55'),
(103, 'User logged in', 'zxc', '2023-11-13 10:36:58'),
(104, 'User logged out', 'zxc', '2023-11-13 12:30:49'),
(105, 'User logged in', 'fer', '2023-11-13 12:30:51'),
(106, 'User logged out', 'fer', '2023-11-13 12:33:52'),
(107, 'User logged in', 'fer', '2023-11-13 12:34:14'),
(108, 'User logged out', 'fer', '2023-11-13 12:34:19'),
(109, 'User logged in', 'fer', '2023-11-13 12:34:57'),
(110, 'User logged in', 'fer', '2023-11-14 12:33:59'),
(111, 'User logged in', 'fer', '2023-11-16 09:46:22'),
(112, 'User logged in', 'fer', '2023-11-16 10:13:29'),
(113, 'User logged out', 'fer', '2023-11-16 11:03:23'),
(114, 'User logged in', 'zxc', '2023-11-16 11:03:25'),
(115, 'User logged in', 'zxc', '2023-11-17 01:59:32'),
(116, 'User logged out', 'zxc', '2023-11-17 02:38:03'),
(117, 'User logged in', 'fer', '2023-11-17 02:39:54'),
(118, 'User logged out', 'fer', '2023-11-17 02:41:52'),
(119, 'User logged in', 'fer', '2023-11-17 02:47:48'),
(120, 'User logged out', 'fer', '2023-11-17 02:47:51'),
(121, 'User logged in', 'zxc', '2023-11-17 02:47:54'),
(122, 'User logged in', 'zxc', '2023-11-17 02:48:25'),
(123, 'User logged out', 'zxc', '2023-11-17 02:51:29'),
(124, 'User logged in', 'zxc', '2023-11-17 02:51:32'),
(125, 'User logged in', 'fer', '2023-11-17 02:51:51'),
(126, 'User logged out', 'fer', '2023-11-17 02:53:15'),
(127, 'User logged in', 'asd', '2023-11-17 02:53:17'),
(128, 'User logged in', 'fer', '2023-11-17 02:56:24'),
(129, 'User logged out', 'fer', '2023-11-17 02:56:27'),
(130, 'User logged in', 'zxc', '2023-11-17 02:57:09'),
(131, 'User logged out', 'zxc', '2023-11-17 02:59:03'),
(132, 'User logged in', 'zxc', '2023-11-17 02:59:07'),
(133, 'User created', '', '2023-11-17 03:31:46'),
(134, 'User created', '', '2023-11-17 03:32:21'),
(135, 'User created', '', '2023-11-17 03:43:05'),
(136, 'User created', '', '2023-11-17 03:43:11'),
(137, 'User updated', '', '2023-11-17 03:43:39'),
(138, 'User created', '', '2023-11-17 03:45:29'),
(139, 'User created', '', '2023-11-17 03:57:47'),
(140, 'User created', '', '2023-11-17 03:58:42'),
(141, 'User Deleted', '', '2023-11-17 03:59:33'),
(142, 'User logged out', 'zxc', '2023-11-17 04:07:11'),
(143, 'User logged in', 'zxc', '2023-11-17 04:07:27'),
(144, 'User logged out', 'zxc', '2023-11-17 04:07:47'),
(145, 'User logged in', 'dog', '2023-11-17 04:07:50'),
(146, 'User logged out', 'dog', '2023-11-17 04:07:52'),
(147, 'User logged in', 'zxc', '2023-11-17 04:07:54'),
(148, 'User logged out', 'zxc', '2023-11-17 04:08:21'),
(149, 'User logged in', 'fer', '2023-11-17 04:11:21'),
(150, 'User logged out', 'fer', '2023-11-17 04:11:37'),
(151, 'User logged in', 'bnm', '2023-11-17 04:13:23'),
(152, 'User logged out', 'bnm', '2023-11-17 04:41:50'),
(153, 'User logged in', 'zxc', '2023-11-17 04:41:52'),
(154, 'User logged in', 'zxc', '2023-11-17 04:41:54'),
(155, 'User logged out', 'zxc', '2023-11-17 04:42:14'),
(156, 'User logged in', 'fer', '2023-11-17 04:42:16'),
(157, 'User logged in', 'fffee', '2024-06-17 12:38:31'),
(158, 'User logged in', 'fffee', '2024-06-17 12:51:34'),
(159, 'User logged in', 'fffee', '2024-06-17 23:50:11'),
(160, 'User logged in', 'fffee', '2024-06-18 01:53:28'),
(161, 'User logged in', 'fffee', '2024-06-18 10:18:57'),
(162, 'User logged out', 'fffee', '2024-06-18 10:19:59'),
(163, 'User logged in', 'fffee', '2024-06-18 11:22:00'),
(164, 'User logged in', 'fffee', '2024-06-18 12:35:46'),
(165, 'User logged in', 'fffee', '2024-06-18 12:37:09'),
(166, 'User logged out', 'fffee', '2024-06-21 11:33:45'),
(167, 'User logged in', 'fffee', '2024-06-21 11:38:41'),
(168, 'User logged out', 'fffee', '2024-06-21 11:38:48'),
(169, 'User logged in', 'fffee', '2024-06-21 11:39:49'),
(170, 'User logged out', 'fffee', '2024-06-21 11:41:18'),
(171, 'User logged in', 'fff', '2024-06-21 11:45:22'),
(172, 'User logged out', 'fff', '2024-06-21 11:47:58'),
(173, 'User logged in', 'fffee', '2024-06-21 11:48:10'),
(174, 'User logged out', 'fffee', '2024-06-21 11:48:50'),
(175, 'User logged in', 'fffee', '2024-06-21 11:56:56'),
(176, 'User logged out', 'fffee', '2024-06-21 11:57:18'),
(177, 'User logged in', 'fffee', '2024-06-21 12:02:52'),
(178, 'User logged out', 'fffee', '2024-06-21 12:04:07'),
(179, 'User logged in', 'ddd', '2024-06-21 12:13:41'),
(180, 'User logged in', 'ddd', '2024-06-21 12:13:50'),
(181, 'User logged in', 'ddd', '2024-06-21 12:14:49'),
(182, 'User logged out', 'ddd', '2024-06-21 12:33:40'),
(183, 'User logged in', 'ddd', '2024-06-21 12:35:49'),
(184, 'User logged in', 'ddd', '2024-06-21 12:38:08'),
(185, 'User logged in', 'ddd', '2024-06-21 12:39:53'),
(186, 'User logged out', 'ddd', '2024-06-22 11:48:36'),
(187, 'User logged in', 'fffee', '2024-06-23 04:04:41'),
(188, 'User logged in', 'fffee', '2024-06-23 04:04:53'),
(189, 'User logged in', 'fffee', '2024-06-23 04:05:33'),
(190, 'User logged in', 'fffee', '2024-06-23 04:06:06'),
(191, 'User logged out', 'fffee', '2024-06-23 04:06:23'),
(192, 'User logged in', 'fffee', '2024-06-23 04:06:32'),
(193, 'User logged out', 'fffee', '2024-06-23 04:07:27'),
(194, 'User logged in', 'ddd', '2024-06-23 04:09:27'),
(195, 'User logged out', 'ddd', '2024-06-23 04:11:04'),
(196, 'User logged in', 'ddff', '2024-06-23 04:11:53'),
(197, 'User logged out', 'ddff', '2024-06-23 04:12:38'),
(198, 'User logged in', 'ddff', '2024-06-23 04:13:18'),
(199, 'User logged out', 'ddff', '2024-06-23 04:17:16'),
(200, 'User logged in', 'ddff', '2024-06-23 04:17:32'),
(201, 'User logged in', 'fffee', '2024-06-23 04:23:19'),
(202, 'User logged in', 'ddff', '2024-06-23 04:23:35'),
(203, 'User logged in', 'hhh', '2024-06-23 04:27:43'),
(204, 'User logged out', 'hhh', '2024-06-23 04:27:49'),
(205, 'User logged in', 'hhh', '2024-06-23 04:28:32'),
(206, 'User logged in', 'hhh', '2024-06-23 04:32:04'),
(207, 'User logged out', 'hhh', '2024-06-26 06:38:32'),
(208, 'User logged in', 'fdsgffs', '2024-07-07 11:09:37'),
(209, 'User logged in', 'fdsgffs', '2024-07-07 12:05:42'),
(210, 'User logged out', 'fdsgffs', '2024-07-07 12:06:01'),
(211, 'User logged in', 'sss', '2024-07-07 12:06:19'),
(212, 'User logged out', 'sss', '2024-07-08 10:38:55'),
(213, 'User logged in', 'sss', '2024-07-08 11:01:45'),
(214, 'User logged out', 'sss', '2024-07-08 11:02:42'),
(215, 'User logged in', 'sss', '2024-07-08 11:02:47'),
(216, 'User logged out', 'sss', '2024-07-08 11:02:57'),
(217, 'User logged in', 'sss', '2024-07-08 11:03:24'),
(218, 'User logged out', 'sss', '2024-07-08 11:04:03'),
(219, 'User logged in', 'sss', '2024-07-08 11:04:10'),
(220, 'User logged out', 'sss', '2024-07-08 11:04:15'),
(221, 'User logged in', 'sss', '2024-07-08 11:04:35'),
(222, 'User logged out', 'sss', '2024-07-08 11:04:42'),
(223, 'User logged in', 'ffff', '2024-07-08 11:05:47'),
(224, 'User logged in', 'sss', '2024-07-08 11:17:59'),
(225, 'User logged out', 'sss', '2024-07-08 11:18:03'),
(226, 'User logged in', 'ffff', '2024-07-08 11:18:29'),
(227, 'User updated', '', '2024-07-08 11:20:11'),
(228, 'User logged out', 'ffff', '2024-07-08 11:22:42'),
(229, 'User logged in', 'ffff', '2024-07-08 11:24:59'),
(230, 'User logged in', 'ffff', '2024-07-08 11:25:46'),
(231, 'User logged out', 'ffff', '2024-07-08 11:26:57'),
(232, 'User logged in', 'ffff', '2024-07-08 11:27:15'),
(233, 'User logged out', 'ffff', '2024-07-08 11:36:44'),
(234, 'User logged in', 'ffff', '2024-07-08 11:36:52'),
(235, 'User updated', '', '2024-07-08 11:37:31'),
(236, 'User Deleted', '', '2024-07-08 11:38:22'),
(237, 'User logged out', 'ffff', '2024-07-08 11:40:12'),
(238, 'User logged in', 'ffff', '2024-07-10 00:04:14'),
(239, 'User logged out', 'ffff', '2024-07-10 00:16:15'),
(240, 'User logged in', 'Marvic', '2024-07-10 00:17:35'),
(241, 'User logged in', 'ffff', '2024-07-10 02:28:50'),
(242, 'User logged out', 'ffff', '2024-07-10 02:30:34'),
(243, 'User logged in', 'Mmm', '2024-07-10 02:31:30'),
(244, 'User logged out', 'Mmm', '2024-07-10 02:35:46'),
(245, 'User logged in', 'Mmm', '2024-07-10 02:46:21'),
(246, 'User logged out', 'Mmm', '2024-07-10 02:48:59'),
(247, 'User logged in', 'ffff', '2024-07-10 23:16:44'),
(248, 'User logged out', 'ffff', '2024-07-10 23:17:37'),
(249, 'User logged in', 'Mmm', '2024-07-10 23:17:53'),
(250, 'User logged in', 'Mmm', '2024-07-10 23:31:07'),
(251, 'User logged out', 'Mmm', '2024-07-10 23:47:04'),
(252, 'User logged in', 'ggg', '2024-07-10 23:47:42'),
(253, 'User logged out', 'ggg', '2024-07-12 01:07:32'),
(254, 'User logged in', 'ffff', '2024-07-12 04:15:56'),
(255, 'User logged out', 'ffff', '2024-07-12 23:30:04'),
(256, 'User logged in', 'Mmm', '2024-07-12 23:31:50'),
(257, 'User logged in', 'Mmm', '2024-07-13 05:44:24'),
(258, 'User logged out', 'Mmm', '2024-07-13 05:49:33'),
(259, 'User logged in', 'Mmm', '2024-07-13 05:50:30'),
(260, 'User logged in', 'Mmm', '2024-07-13 06:12:55'),
(261, 'User logged in', 'ffff', '2024-07-14 10:11:53'),
(262, 'User logged out', 'ffff', '2024-07-14 10:12:04'),
(263, 'User logged in', 'Mmm', '2024-07-14 10:12:18'),
(264, 'User logged in', 'Mmm', '2024-07-14 10:30:58'),
(265, 'User logged in', 'Mmm', '2024-07-14 13:28:45'),
(266, 'User logged out', 'Mmm', '2024-07-14 13:32:41'),
(267, 'User logged in', 'Mmm', '2024-07-14 13:48:19'),
(268, 'User logged out', 'Mmm', '2024-07-14 13:48:25'),
(269, 'User logged in', 'hhh', '2024-07-14 14:12:02'),
(270, 'User logged out', 'hhh', '2024-07-14 14:12:49'),
(271, 'User logged in', 'Dizonmarvic@gmail.com', '2024-07-14 14:18:35'),
(272, 'User logged out', 'Dizonmarvic@gmail.com', '2024-07-15 02:34:07'),
(273, 'User logged in', 'Dizonmarvic@gmail.com', '2024-07-15 02:34:35'),
(274, 'User logged in', 'Mmm', '2024-07-16 10:44:08'),
(275, 'User logged in', 'Dizonmarvic@gmail.com', '2024-07-16 10:46:05'),
(276, 'User logged out', 'Dizonmarvic@gmail.com', '2024-07-16 14:04:48'),
(277, 'User logged in', 'Dizonmarvic@gmail.com', '2024-07-18 04:08:52'),
(278, 'User logged out', 'Dizonmarvic@gmail.com', '2024-07-18 05:17:46'),
(279, 'User logged in', 'Dizonmarvic@gmail.com', '2024-07-18 05:18:07'),
(280, 'User logged out', 'Dizonmarvic@gmail.com', '2024-07-18 08:36:27'),
(281, 'User logged in', 'Dizonmarvic@gmail.com', '2024-07-18 08:36:38'),
(282, 'User logged out', 'Dizonmarvic@gmail.com', '2024-07-18 13:10:35'),
(283, 'User logged in', 'Dizonmarvic@gmail.com', '2024-07-18 13:10:53'),
(284, 'User updated', '', '2024-07-18 13:17:41'),
(285, 'User updated', '', '2024-07-18 13:18:06'),
(286, 'User updated', '', '2024-07-18 13:18:45'),
(287, 'User updated', '', '2024-07-18 13:19:41'),
(288, 'User updated', '', '2024-07-18 13:27:16'),
(289, 'User updated', '', '2024-07-18 13:27:30'),
(290, 'User logged in', 'catahanrachel@gmail.com', '2024-07-18 13:34:05'),
(291, 'User logged out', 'catahanrachel@gmail.com', '2024-07-18 13:38:05'),
(292, 'User logged in', 'catahanrachel@gmail.com', '2024-07-18 14:04:35'),
(293, 'User logged out', 'catahanrachel@gmail.com', '2024-07-18 14:06:02'),
(294, 'User logged in', 'catahanrachel@gmail.com', '2024-07-18 14:07:46'),
(295, 'User logged in', 'catahanrachel@gmail.com', '2024-07-18 14:08:23'),
(296, 'User logged out', 'catahanrachel@gmail.com', '2024-07-18 14:08:47'),
(297, 'User logged in', 'leynesaron@gmail.com', '2024-07-18 14:09:50'),
(298, 'User logged out', 'catahanrachel@gmail.com', '2024-07-18 14:16:38'),
(299, 'User logged in', 'catahanrachel@gmail.com', '2024-07-18 23:00:28'),
(300, 'User logged in', 'Mmm', '2024-07-19 01:17:57'),
(301, 'User logged in', 'dizonedna@gmail.com', '2024-07-20 01:14:55'),
(302, 'User logged in', 'catahanrachel@gmail.com', '2024-07-20 10:56:31'),
(303, 'User Deleted', '', '2024-07-20 10:58:28'),
(304, 'User Deleted', '', '2024-07-20 11:00:05'),
(305, 'User Deleted', '', '2024-07-20 11:01:07'),
(306, 'User Deleted', '', '2024-07-20 11:01:10'),
(307, 'User Deleted', '', '2024-07-20 11:01:17'),
(308, 'User Deleted', '', '2024-07-20 11:01:19'),
(309, 'User Deleted', '', '2024-07-20 11:01:22'),
(310, 'User Deleted', '', '2024-07-20 11:01:25'),
(311, 'User updated', '', '2024-07-20 11:01:41'),
(312, 'User logged in', 'mmm', '2024-07-20 11:39:58'),
(313, 'User logged out', 'mmm', '2024-07-20 11:40:29'),
(314, 'User logged in', 'mmm', '2024-07-20 11:41:50'),
(315, 'User logged out', 'marvic', '2024-07-20 11:49:18'),
(316, 'User logged in', 'leynesaron@gmail.com', '2024-07-20 11:50:38'),
(317, 'User logged out', 'leynesaron@gmail.com', '2024-07-20 11:51:20'),
(318, 'User logged in', 'leynesaron@gmail.com', '2024-07-20 11:51:34'),
(319, 'User logged in', 'leynesaron@gmail.com', '2024-07-20 11:55:50'),
(320, 'User logged in', 'leynesaron@gmail.com', '2024-07-20 11:56:24'),
(321, 'User Deleted', '', '2024-07-20 12:05:24'),
(322, 'User Deleted', '', '2024-07-20 12:05:28'),
(323, 'User logged in', 'leynesaron@gmail.com', '2024-07-24 12:30:45'),
(324, 'User logged out', 'leynesaron@gmail.com', '2024-07-24 12:31:26'),
(325, 'User logged in', 'dizonmartin@gmail.com', '2024-07-24 13:02:47'),
(326, 'User logged in', 'dizonmartin@gmail.com', '2024-07-25 05:39:25'),
(327, 'User Deleted', '', '2024-07-29 13:36:31'),
(328, 'User Deleted', '', '2024-07-29 13:40:16'),
(329, 'User Deleted', '', '2024-07-29 13:41:14'),
(330, 'User Deleted', '', '2024-07-29 13:41:16'),
(331, 'User logged out', 'dizonmartin@gmail.com', '2024-07-29 13:48:49'),
(332, 'User logged in', 'leynesaron@gmail.com', '2024-07-29 13:49:15'),
(333, 'User updated', '', '2024-07-29 13:49:37'),
(334, 'User logged out', 'leynesaron@gmail.com', '2024-07-29 13:49:42'),
(335, 'User logged in', 'catahanrachel@gmail.com', '2024-07-29 13:51:25'),
(336, 'User logged out', 'catahanrachel@gmail.com', '2024-07-29 13:51:34'),
(337, 'User logged in', 'leynesaron@gmail.com', '2024-07-29 13:51:50'),
(338, 'User updated', '', '2024-07-29 13:52:06'),
(339, 'User logged out', 'leynesaron@gmail.com', '2024-07-29 13:52:08'),
(340, 'User logged in', 'leynesaron@gmail.com', '2024-07-29 13:53:11'),
(341, 'User updated', '', '2024-07-29 13:53:25'),
(342, 'User logged out', 'leynesaron@gmail.com', '2024-07-29 13:53:31'),
(343, 'User logged in', 'leynesaron@gmail.com', '2024-07-29 13:58:09'),
(344, 'User Deleted', '', '2024-07-29 13:58:16'),
(345, 'User updated', '', '2024-07-29 13:58:27'),
(346, 'User logged out', 'leynesaron@gmail.com', '2024-07-29 13:58:39'),
(347, 'User logged in', 'leynesaron@gmail.com', '2024-07-29 13:59:08'),
(348, 'User updated', '', '2024-07-29 13:59:32'),
(349, 'User logged out', 'leynesaron@gmail.com', '2024-07-29 13:59:35'),
(350, 'User logged in', 'catahanrachel@gmail.com', '2024-07-29 13:59:46'),
(351, 'User Deleted', '', '2024-07-29 14:07:32'),
(352, 'User Deleted', '', '2024-07-29 14:08:14'),
(353, 'User Deleted', '', '2024-07-29 14:08:45'),
(354, 'User Deleted', '', '2024-07-29 14:11:01'),
(355, 'User Deleted', '', '2024-07-29 14:11:44'),
(356, 'User Deleted', '', '2024-07-29 14:17:00'),
(357, 'User Created', 'catahanrachel@gmail.com', '2024-07-29 14:21:01'),
(358, 'User Deleted', '', '2024-07-29 14:21:28'),
(359, 'User Created', 'catahanrachel@gmail.com', '2024-07-29 14:24:52'),
(360, 'User Deleted', '', '2024-07-29 14:28:39'),
(361, 'User Created', 'catahanrachel@gmail.com', '2024-07-29 14:30:47'),
(362, 'User Created', 'catahanrachel@gmail.com', '2024-07-29 14:34:54'),
(363, 'User Deleted', '85', '2024-07-29 14:35:43'),
(364, 'User Created', 'catahanrachel@gmail.com', '2024-07-29 14:40:49'),
(365, 'User Deleted', '86', '2024-07-29 14:43:51'),
(366, 'User Created', 'catahanrachel@gmail.com', '2024-07-29 14:44:25'),
(367, 'User Deleted', '', '2024-07-29 14:57:14'),
(368, 'User Created', 'catahanrachel@gmail.com', '2024-07-29 15:02:14'),
(369, 'User Deleted', 'catahanrachel@gmail.com', '2024-07-29 15:02:51'),
(370, 'User Deleted', 'catahanrachel@gmail.com', '2024-07-29 15:03:02'),
(371, 'User Deleted', 'catahanrachel@gmail.com', '2024-07-29 15:04:57'),
(372, 'User logged in', 'catahanrachel@gmail.com', '2024-07-29 23:58:51'),
(373, 'User logged in', 'Marvicdizon@gmail.com', '2024-08-03 09:15:14'),
(374, 'User logged out', 'Marvicdizon@gmail.com', '2024-08-04 12:58:36'),
(375, 'User logged in', 'leynesaron@gmail.com', '2024-08-04 12:58:50'),
(376, 'User updated', '', '2024-08-04 12:59:20'),
(377, 'User logged out', 'leynesaron@gmail.com', '2024-08-04 12:59:24'),
(378, 'User logged in', 'catahan@gmail.com', '2024-08-04 13:03:05'),
(379, 'User logged out', 'catahan@gmail.com', '2024-08-04 13:04:07'),
(380, 'User logged in', 'catahan@gmail.com', '2024-08-04 13:04:21'),
(381, 'User logged in', 'catahan@gmail.com', '2024-08-04 13:06:44'),
(382, 'User logged out', 'catahan@gmail.com', '2024-08-04 13:09:39'),
(383, 'User logged in', 'catahan@gmail.com', '2024-08-04 13:09:50'),
(384, 'User logged in', 'aron@gmail.com', '2024-08-08 04:08:13'),
(385, 'User logged in', 'aron@gmail.com', '2024-08-08 04:37:25');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(100) NOT NULL,
  `days` int(11) NOT NULL,
  `checkin` date NOT NULL,
  `package` varchar(255) NOT NULL,
  `guests` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `Reference` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `name`, `email`, `phone`, `days`, `checkin`, `package`, `guests`, `amount`, `payment`, `Reference`) VALUES
(4, 'Rachel', 'catahanrachel@gmail.com', 2147483647, 3, '2024-07-09', 'set 4', 10, 10000, 'gcash', 2147483647),
(5, 'Rachel', 'catahanrachel@gmail.com', 2147483647, 3, '2024-07-09', 'set 4', 10, 10000, 'gcash', 2147483647),
(6, 'marvic', 'dizon_marvic@yahoo.com', 2147483647, 3, '2024-07-09', 'platinum', 8, 20000, 'gcash', 5476343),
(7, 'marvic', 'dizon_marvic@yahoo.com', 2147483647, 7, '2024-07-10', 'super set', 3, 10000, 'gcash', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE `tbuser` (
  `id` int(10) UNSIGNED NOT NULL,
  `UserName` varchar(45) NOT NULL,
  `PassWord` varchar(255) NOT NULL,
  `FullName` varchar(45) NOT NULL,
  `image` varchar(100) NOT NULL,
  `UserRole` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`id`, `UserName`, `PassWord`, `FullName`, `image`, `UserRole`) VALUES
(77, 'leynesaron@gmail.com', '$2y$10$cdpd.MNSkpDvkKOIc8IheergzMiw5/he1TrSelfsFSdTbFIIGb9QK', 'Aron Leynes', 'ed5c4bc88dad59afc48b9d56c8e1ee3b6d47e4a78bd4b9e51d0be0581cc53fea.jpg', 'admin'),
(88, 'dsfds', '$2y$10$WoQvJrHxv2fbIgLBG4WRGegxhKl/N4LEC8BhOF0zs9hu81mU15U/K', 'saads', '66a7aef634f95.jpg', ''),
(89, 'catahanrachel@gmail.com', '$2y$10$pRxMyqzjUUh75t2KZIAbHe.XsAXqBK9NkxynwV5kAUtZntdhX209G', 'Rachel Catahan', 'f5d225ed6fca5f6ba426e50c2b8ed3a4d7334ef4ece291b27f26b815cbc29dd3.jpg', ''),
(90, 'Marvicdizon@gmail.com', '$2y$10$G/M.JSij2AENqUrgOZMt5Odi249sr.Sz36iM2nW5/npFa8hUF7mL2', 'Marvic Dizon', '66adf50dc93b9.jpg', 'boracay'),
(91, 'catahan@gmail.com', '$2y$10$bh2iKSTquUuWE31WZ9EkHeZjP1wQUligK/sswozIsYpzyinPnktEy', 'Marvic', '66af7bf6860cd.png', 'boracay'),
(92, 'aron@gmail.com', '$2y$10$Tr/R1oK3SrRc18k33PKu1e/fxGaJn3F0aYHX61rg02bQCbPDZYHcy', 'marvic dizon', '66b4449c05424.png', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `audit_trail`
--
ALTER TABLE `audit_trail`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=386;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbuser`
--
ALTER TABLE `tbuser`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
