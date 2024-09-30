-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2024 at 03:24 PM
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
(385, 'User logged in', 'aron@gmail.com', '2024-08-08 04:37:25'),
(386, 'User logged in', 'fee@gmail.com', '2024-09-03 21:34:20'),
(387, 'User logged out', 'fee@gmail.com', '2024-09-03 21:41:13'),
(388, 'User logged in', 'fee@gmail.com', '2024-09-03 21:41:19'),
(389, 'User logged in', 'fee@gmail.com', '2024-09-07 10:30:47'),
(390, 'User logged in', 'fee@gmail.com', '2024-09-07 22:25:12'),
(391, 'User logged out', 'fee@gmail.com', '2024-09-08 00:25:16'),
(392, 'User logged in', 'faster@gmail.com', '2024-09-08 00:28:17'),
(393, 'User logged out', 'faster@gmail.com', '2024-09-08 00:30:15'),
(394, 'User logged in', 'faster@gmail.com', '2024-09-08 00:30:26'),
(395, 'User logged out', 'faster@gmail.com', '2024-09-08 00:37:16'),
(396, 'User logged in', 'fee@gmail.com', '2024-09-08 00:51:07'),
(397, 'User logged out', 'fee@gmail.com', '2024-09-08 00:51:11'),
(398, 'User logged in', 'thet@gmail.com', '2024-09-08 00:51:15'),
(399, 'User logged in', 'fee@gmail.com', '2024-09-08 18:59:11'),
(400, 'User logged in', 'fee@gmail.com', '2024-09-08 19:07:16'),
(401, 'User logged out', 'fee@gmail.com', '2024-09-08 19:16:44'),
(402, 'User logged in', 'fee@gmail.com', '2024-09-08 19:17:34'),
(403, 'User logged out', 'fee@gmail.com', '2024-09-08 19:17:51'),
(404, 'User logged in', 'fee@gmail.com', '2024-09-08 19:25:56'),
(405, 'User logged out', 'fee@gmail.com', '2024-09-08 21:23:14'),
(406, 'User logged in', 'zxc@gmail.com', '2024-09-08 21:23:59'),
(407, 'User logged out', 'fee@gmail.com', '2024-09-08 23:22:57'),
(408, 'User logged out', 'fee@gmail.com', '2024-09-08 23:25:14'),
(409, 'User logged out', 'fee@gmail.com', '2024-09-08 23:31:37'),
(410, 'User logged out', 'fee@gmail.com', '2024-09-08 23:31:58'),
(411, 'User logged out', 'asd@gmail.com', '2024-09-08 23:46:07'),
(412, 'User logged out', 'zxc@gmail.com', '2024-09-15 19:59:32'),
(413, 'User logged out', 'zxc@gmail.com', '2024-09-15 20:00:42'),
(414, 'User Deleted', '', '2024-09-15 20:20:42'),
(415, 'User updated', 'zxc@gmail.com', '2024-09-15 21:39:22'),
(416, 'User updated', 'zxc@gmail.com', '2024-09-15 21:47:48'),
(417, 'User updated', 'zxc@gmail.com', '2024-09-15 21:49:34'),
(418, 'User updated', 'zxc@gmail.com', '2024-09-15 22:14:49'),
(419, 'User updated', 'zxc@gmail.com', '2024-09-15 22:24:10'),
(420, 'User logged out', 'fee@gmail.com', '2024-09-20 09:37:58'),
(421, 'User logged out', 'fee@gmail.com', '2024-09-21 03:51:36'),
(422, 'User logged out', 'cferdinand500@gmail.com', '2024-09-21 03:54:15'),
(423, 'User logged out', 'cferdinand500@gmail.com', '2024-09-21 08:57:08'),
(424, 'User Deleted', '', '2024-09-21 08:57:37'),
(425, 'User Deleted', '', '2024-09-21 08:58:16'),
(426, 'User Deleted', '', '2024-09-21 09:09:26'),
(427, 'User updated', 'cferdinand500@gmail.com', '2024-09-21 09:48:08'),
(428, 'User updated', 'cferdinand500@gmail.com', '2024-09-21 09:52:50'),
(429, 'User updated', 'cferdinand500@gmail.com', '2024-09-21 09:53:14'),
(430, 'User logged out', 'cferdinand500@gmail.com', '2024-09-21 10:32:44'),
(431, 'User updated', 'cferdinand500@gmail.com', '2024-09-21 10:33:07'),
(432, 'User logged out', 'cferdinand500@gmail.com', '2024-09-21 10:33:09'),
(433, 'User logged out', 'cferdinand500@gmail.com', '2024-09-21 18:20:09'),
(434, 'User logged out', 'cferdinand500@gmail.com', '2024-09-23 07:46:05'),
(435, 'User logged out', 'cferdinand500@gmail.com', '2024-09-24 02:08:38'),
(436, 'User logged out', 'catahan@gmail.com', '2024-09-24 02:14:09'),
(437, 'User logged out', 'faster@gmail.com', '2024-09-24 02:17:03'),
(438, 'User logged out', 'cferdinand500@gmail.com', '2024-09-24 02:18:16'),
(439, 'User logged out', 'lopezxam@gmail.com', '2024-09-24 02:21:33'),
(440, 'User updated', 'cferdinand500@gmail.com', '2024-09-24 02:35:55'),
(441, 'User updated', 'cferdinand500@gmail.com', '2024-09-24 02:36:12'),
(442, 'User updated', 'cferdinand500@gmail.com', '2024-09-24 02:36:31'),
(443, 'User updated', 'cferdinand500@gmail.com', '2024-09-24 02:36:42'),
(444, 'User updated', 'cferdinand500@gmail.com', '2024-09-24 02:36:46'),
(445, 'User updated', 'cferdinand500@gmail.com', '2024-09-24 02:36:49'),
(446, 'User logged out', 'cferdinand500@gmail.com', '2024-09-24 02:37:33'),
(447, 'User logged out', 'cferdinand500@gmail.com', '2024-09-24 02:37:39'),
(448, 'User updated', 'catahan@gmail.com', '2024-09-24 02:38:07'),
(449, 'User logged out', 'catahan@gmail.com', '2024-09-24 02:38:49'),
(450, 'User logged out', 'lopezxam@gmail.com', '2024-09-24 02:40:24'),
(451, 'User logged out', 'cferdinand500@gmail.com', '2024-09-24 02:42:20'),
(452, 'User logged out', 'catahan@gmail.com', '2024-09-24 03:44:23'),
(453, 'User logged out', 'jhonDatu@gmail.com', '2024-09-24 04:09:17'),
(454, 'User logged out', 'cferdinand500@gmail.com', '2024-09-24 04:15:49');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `days` int(11) DEFAULT NULL,
  `checkin` date NOT NULL,
  `package` varchar(255) NOT NULL,
  `guests` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `Reference` int(11) NOT NULL,
  `status` enum('pending','confirmed','cancelled') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `name`, `email`, `phone`, `days`, `checkin`, `package`, `guests`, `amount`, `payment`, `Reference`, `status`) VALUES
(45, 'Ryu Jin', 'cferdinand500@gmail.com', 2147483647, 3, '2024-09-21', 'Gold', 2, 5, 'Gcash', 454365, 'confirmed'),
(46, 'Ryu Jin', 'cferdinand500@gmail.com', 2147483647, 3, '2024-09-21', 'Gold', 2, 5, 'Gcash', 454365, 'confirmed'),
(47, 'Ferrr', 'cferdinand500@gmail.com', 123123211, 3, '2024-09-21', 'Bronze', 2, 23232, 'Gcash', 435435, 'confirmed'),
(88, 'Ryu', 'cferdinand500@gmail.com', 2147483647, 5, '2024-09-22', 'Gold', 23, 532533, 'Gcash', 0, 'pending'),
(89, 'Ferrr', 'cferdinand500@gmail.com', 0, 12, '2024-09-29', 'Silver', 23, 23, 'Maya', 634463, 'pending'),
(90, 'Ferrr', 'cferdinand500@gmail.com', 0, 12, '2024-09-29', 'Silver', 23, 23, 'Maya', 634463, 'pending'),
(91, 'Ferrr', 'cferdinand500@gmail.com', 0, 12, '2024-09-29', 'Silver', 23, 23, 'Maya', 634463, 'pending'),
(92, 'Ryu', 'cferdinand500@gmail.com', 213412421, 12, '2024-09-22', 'Silver', 23, 4354, 'Gcash', 0, 'pending'),
(93, 'Ryu', 'cferdinand500@gmail.com', 213412421, 12, '2024-09-22', 'Silver', 23, 4354, 'Gcash', 0, 'pending'),
(94, 'zxcxzc', 'cferdinand500@gmail.com', 2147483647, 23, '2024-09-29', 'Gold', 23, 52345233, 'Gcash', 0, 'pending'),
(95, 'Ryu', 'cferdinand500@gmail.com', 414121, 23, '2024-09-22', 'Gold', 23, 432432, 'Gcash', 0, 'pending'),
(96, 'Ryujin', 'cferdinand500@gmail.com', 545435, 23, '2024-09-22', 'Gold', 23, 432432, 'Gcash', 0, 'pending'),
(97, 'Ryu Jin', 'cashier@gmail.com', 2147483647, 213, '2024-09-14', 'Gold', 3, 213123, 'Payment Method', 23, 'pending'),
(98, 'zxcxz', 'cferdinand500@gmail.com', 89765432, 2, '2024-09-21', 'Silver', 23, 75475, 'Gcash', 3421, 'pending'),
(99, 'Ryu Jin', 'Admin@gmail.com', 43345, 32, '2024-09-28', 'Gold', 2, 32423, 'Gcash', 435435, 'pending'),
(100, 'rdbtdxdrtxd', 'cferdinand500@gmail.com', 4565, 12, '2024-09-28', 'Gold', 20, 0, 'Payment Method', 57, 'pending'),
(101, 'Ryu Jin', 'cferdinand500@gmail.com', 2147483647, 3, '2024-09-29', 'Platinum', 3, 23232, 'Gcash', 0, 'pending'),
(102, 'Ryu Jin', 'cferdinand500@gmail.com', 2147483647, 3, '2024-09-29', 'Platinum', 3, 23232, 'Gcash', 0, 'pending'),
(103, 'Ryu Jin', 'cferdinand500@gmail.com', 2147483647, 2, '2024-09-29', 'Gold', 2, 2131232, 'Gcash', 4533, 'pending'),
(104, 'Ryu Jin', 'cferdinand0604@gmail.com', 2147483647, 5, '2024-09-28', 'Gold', 3, 45, 'gcash', 32423, 'pending'),
(105, 'Ryu Jin', 'cferdinand0604@gmail.com', 2147483647, 5, '2024-09-28', 'Gold', 3, 45, 'gcash', 32423, 'pending'),
(106, 'xam lalic', 'lopezxam@gmail.com', 2147483647, 3, '2024-09-29', 'Gold', 1, 500, 'Gcash', 123, 'pending'),
(107, 'Ryu Jin', 'cferdinand500@gmail.com', 2147483647, 9, '2024-09-20', 'Gold', 10, 2000, 'Gcash', 454365, 'pending'),
(108, 'Ryu Jin', 'cferdinand500@gmail.com', 2147483647, 3, '2024-09-12', 'Choose Package', 3, 3213, 'Maya', 2131, 'pending'),
(109, 'asdasdsdsd', 'cferdinand500@gmail.com', 2147483647, 4, '2024-09-05', 'Gold', 3, 5, 'Maya', 435435, 'pending'),
(110, 'sa;lmasd;l', 'cferdinand500@gmail.com', 2147483647, 3, '2024-09-20', 'Platinum', 2, 30000, 'Gcash', 200, 'pending'),
(111, 'JhonDatu', 'jhonDatu@gmail.com', 2147483647, 5, '2024-09-14', 'Gold', 10, 1, 'Gcash', 454365, 'confirmed'),
(112, 'ewtaestbb', 'cferdinand500@gmail.com', 2147483647, 4, '2024-09-14', 'Choose Package', 20, 42421, 'Maya', 454365, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `boracaymarket`
--

CREATE TABLE `boracaymarket` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Product` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `payments` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `reference` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `boracaymarket`
--

INSERT INTO `boracaymarket` (`id`, `name`, `email`, `phone`, `address`, `Product`, `amount`, `payments`, `reference`) VALUES
(1, 'marvic dizon', 'catahanrachel@gmail.com', '09663174570', 'san pedro floridablanca pampanga', 'pukashell', 500, 'gcash', 890485);

-- --------------------------------------------------------

--
-- Table structure for table `cancelbook`
--

CREATE TABLE `cancelbook` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `request_type` varchar(100) NOT NULL,
  `reason` text NOT NULL,
  `booking_id` int(11) NOT NULL,
  `refund_method` varchar(100) NOT NULL,
  `receiver_number` varchar(50) NOT NULL,
  `rebooking_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cancelbook`
--

INSERT INTO `cancelbook` (`id`, `name`, `email`, `phone`, `request_type`, `reason`, `booking_id`, `refund_method`, `receiver_number`, `rebooking_date`, `created_at`, `status`) VALUES
(2, 'asd', 'cferdinand500@gmail.com', 'asd', 'Re-booking', 'asd', 3, 'Refund Method', 'asdas', '2024-10-04', '2024-09-21 06:03:42', 'approved'),
(3, 'Ryu Jin', 'cferdinand500@gmail.com', '9485738493', 'Choose Request', 'sad', 100, 'Refund Method', 'adssd', '2024-10-05', '2024-09-21 06:04:00', 'pending'),
(4, 'Ryu Jin', 'cferdinand500@gmail.com', '9485738493', 'Choose Request', 'sd', 5, 'Gcash', '35345421321', '2024-09-20', '2024-09-23 11:08:12', 'pending'),
(5, 'Ryu Jin', 'cferdinand500@gmail.com', '9485738493', 'Re-booking', 'resyhs6she6s5', 20, 'Paypal', '35345421321', '2024-09-21', '2024-09-23 11:12:51', 'pending'),
(6, 'Ryu Jin', 'cferdinand500@gmail.com', '09363128716', 'Cancel Book', 'change pay method', 90, 'Gcash', '09385739683', '2024-09-19', '2024-09-23 11:37:40', 'pending'),
(7, 'sample', 'cferdinand500@gmail.com', '9485738493', 'Re-booking', 'gwergeewr', 90, 'Gcash', '35345421321', '2024-09-20', '2024-09-24 00:50:21', 'pending'),
(8, 'Ryu Jin', 'cferdinand500@gmail.com', '9485738493', 'Cancel Book', 'resyhs6she6s5', 23, 'Gcash', '35345421321', '2024-09-27', '2024-09-24 00:56:36', 'pending'),
(9, 'vbvcb', 'cferdinand500@gmail.com', '9485738493', 'Re-booking', 'resyhs6she6s5', 22, 'Paypal', '35345421321', '2024-09-28', '2024-09-24 01:00:42', 'pending'),
(10, 'Ryu Jin', 'cferdinand500@gmail.com', '9485738493', 'Cancel Book', 'resyhs6she6s5', 100, 'Gcash', '35345421321', '2024-09-28', '2024-09-24 01:11:30', 'pending'),
(11, 'Ryu Jin', 'cferdinand500@gmail.com', '9485738493', 'Re-booking', 'resyhs6she6s5', 100, 'Refund Method', '09385739683', '2024-10-04', '2024-09-24 01:21:01', 'pending'),
(12, 'qweqwe', 'cferdinand500@gmail.com', '9485738493', 'Cancel Book', 'gwergeewr', 100, 'Paypal', '09385739683', '2024-09-21', '2024-09-24 01:22:11', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `user_id`, `comment_text`, `created_at`) VALUES
(11, 46, 91, 'wow', '2024-09-24 02:12:47'),
(12, 47, 91, 'nice view', '2024-09-24 02:13:12'),
(13, 49, 93, 'peaceful place', '2024-09-24 02:17:01'),
(14, 54, 101, 'cool place', '2024-09-24 02:20:29'),
(15, 55, 102, 'nice', '2024-09-24 04:03:37');

-- --------------------------------------------------------

--
-- Table structure for table `historybookings`
--

CREATE TABLE `historybookings` (
  `history_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `days` int(11) NOT NULL,
  `checkin` date NOT NULL,
  `package` varchar(255) NOT NULL,
  `guests` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `Reference` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `historybookings`
--

INSERT INTO `historybookings` (`history_id`, `id`, `name`, `email`, `phone`, `days`, `checkin`, `package`, `guests`, `amount`, `payment`, `Reference`) VALUES
(1, 0, 'marvic', 'dizon_marvic@yahoo.com', '2147483647', 7, '2024-07-25', 'super set', 10, 20000, 'gcash', '2147483647'),
(2, 0, 'Rachel', 'catahanrachel@gmail.com', '2147483647', 7, '2024-07-17', 'set 4', 3, 10000, 'gcash', '53326'),
(3, 0, 'kurtney clarin', 'clarinkurtney@gmail.com', '2147483647', 7, '2024-07-17', 'set 4', 3, 10000, 'gcash', '53326'),
(4, 0, 'Rachel', 'catahanrachel@gmail.com', '2147483647', 3, '2024-07-09', 'set 4', 10, 10000, 'gcash', '2147483647'),
(5, 0, 'Rachel', 'catahanrachel@gmail.com', '2147483647', 3, '2024-07-09', 'set 4', 10, 10000, 'gcash', '2147483647'),
(6, 0, 'marvic', 'dizon_marvic@yahoo.com', '2147483647', 3, '2024-07-09', 'platinum', 8, 20000, 'gcash', '5476343'),
(7, 0, 'marvic', 'dizon_marvic@yahoo.com', '2147483647', 7, '2024-07-10', 'super set', 3, 10000, 'gcash', '2147483647'),
(9, 0, 'marvic dizon', 'catahanrachel@gmail.com', '2147483647', 7, '2024-08-13', 'set 4', 4, 13000, 'gcash', '657345632'),
(10, 88, 'fee', 'cserbszrzs@gmail.com', '98765432', 20, '2024-08-21', 'hrtyndr', 5, 54333, 'mode', '0'),
(11, 88, 'marvic', 'Dizonmarvic6@gmail.com', '2147483647', 3, '2024-08-20', 'platinum', 5, 1000, 'gcash', '2147483647'),
(12, 0, 'marvic dizon', 'Dizonmarvic6@gmail.com', '09663174570', 7, '2024-09-19', 'super set', 3, 1000, 'gcash', '2147483647'),
(13, 0, 'Rachel', 'catahanrachel@gmail.com', '09663174570', 7, '2024-09-19', 'set 4', 7, 1000, 'gcash', '5476343'),
(14, 0, 'martin', 'Bacaniprincess@gmail.com', '09663174570', 7, '2024-09-17', 'set 4', 5, 1000, 'gcash', '2147483647'),
(15, 0, 'marvic123', 'Bacaniprincess@gmail.com', '09663174570', 4, '2024-09-19', 'Platinum', 2, 10000, 'Gcash', '2147483647'),
(16, 0, 'marvic dizon', 'Bacaniprincess@gmail.com', '09663174570', 5, '2024-09-25', 'Platinum', 5, 10000, 'Gcash', '2147483647'),
(17, 0, 'bgdgfdg', 'catahanrachel@gmail.com', '09663174570', 5, '2024-09-13', 'Platinum', 5, 5, 'Gcash', '53326'),
(18, 0, 'marvic dizon', 'Dizonmarvic6@gmail.com', '09663174570', 5, '2024-09-26', 'Platinum', 5, 1, 'Gcash', '2147483647');

-- --------------------------------------------------------

--
-- Table structure for table `itinerary`
--

CREATE TABLE `itinerary` (
  `Itinerary_id` int(11) NOT NULL,
  `Activity` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Location` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `itinerary`
--

INSERT INTO `itinerary` (`Itinerary_id`, `Activity`, `Date`, `Time`, `Location`, `id`) VALUES
(1, 'asdasd', '2024-09-11', '16:40:00', 'rbren', 88),
(2, 'asdasd', '2024-09-12', '19:38:00', 'sadagfgs', 89),
(3, 'WEW', '2024-09-19', '16:51:00', 'sadagfgs', 88),
(4, 'swimming', '2024-09-25', '12:08:00', 'pampanga', 102);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `post_id`, `user_id`) VALUES
(94, 44, 91),
(95, 47, 91),
(96, 45, 91),
(97, 46, 91),
(99, 44, 93),
(100, 45, 93),
(101, 48, 93),
(103, 47, 93),
(104, 52, 93),
(105, 46, 93),
(106, 49, 93),
(107, 48, 101),
(108, 52, 101),
(109, 51, 101),
(110, 50, 101),
(111, 53, 101),
(112, 55, 101),
(113, 46, 101),
(114, 55, 102);

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `map_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `name`, `description`, `image_url`, `location`, `map_link`) VALUES
(1, 'Bangkung Malapad', 'Located in: Sasmuan, Pampanga.', '../spot/sasmuan/bangkung malapad.jpg', 'Sasmuan, Pampanga', 'https://maps.app.goo.gl/znPdJ1uHg1GLC7Hs8'),
(2, 'Sta Rosario Parish Church', 'Located in: Sta Rosario Sasmuan, Pampanga.', '../spot/sasmuan/starosario.JPG', 'Sta Rosario Sasmuan, Pampanga', 'https://maps.app.goo.gl/Bu1k4v6mSDMSoHUw8'),
(3, 'Banqueruan Places', 'Located in: Banqueruan Sasmuan, Pampanga.', '../spot/sasmuan/banqueruan.jpg', 'Banqueruan Sasmuan, Pampanga', 'https://maps.app.goo.gl/m3Y9hJbV5C2SRo8k7'),
(4, 'Sta Lucia Parish Church', 'Located in: Sta Lucia Sasmuan, Pampanga.', '../spot/sasmuan/stalucia.jpg', 'Sta Lucia Sasmuan, Pampanga', 'https://maps.app.goo.gl/sxwN7b6h2tC4qEvK7'),
(5, 'Pampanga Pottery', 'Located in: Santo Tomas, Pampanga.', '../spot/santo tomas/pottery.jpg', 'Santo Tomas, Pampanga', 'https://maps.app.goo.gl/ABcXy3JK9pT4CV3U6'),
(6, 'Santo Tomas', 'Located in: Santo Tomas, Pampanga.', '../spot/santo tomas/stotomas.jpg', 'Santo Tomas, Pampanga', 'https://maps.app.goo.gl/Fv8qT3zLmW2QRzFY8'),
(7, 'Mula De Victoria Hidden Farm Resort', 'Located in: Santo Tomas, Pampanga.', '../spot/santo tomas/mula.jpeg', 'Santo Tomas, Pampanga', 'https://maps.app.goo.gl/N2QPxS6JuZqR2UwJ9'),
(8, 'Sanrise Private Resort', 'Located in: Santo Tomas, Pampanga.', '../spot/santo tomas/sanrise.jpg', 'Santo Tomas, Pampanga', 'https://maps.app.goo.gl/Gz8Hv6FwA7RVzUW89'),
(9, 'Sta Rita Parish Church', 'Located in: Sta Rita, Pampanga.', '../spot/starita/church.jpg', 'Sta Rita, Pampanga', 'https://maps.app.goo.gl/ABcXy3JK9pT4CV3U6'),
(10, 'Saint Rita of Cascia Ecopark', 'Located in: Sta Rita, Pampanga.', '../spot/starita/Ecopark/3.jpg', 'Sta Rita, Pampanga', 'https://maps.app.goo.gl/Fv8qT3zLmW2QRzFY8'),
(11, 'Ocampo Private Resort', 'Located in: Sta Rita, Pampanga.', '../spot/starita/res.jpg', 'Sta Rita, Pampanga', 'https://maps.app.goo.gl/N2QPxS6JuZqR2UwJ9'),
(12, 'Alviz Farm', 'Located in: Sta Rita, Pampanga.', '../spot/starita/alviz.jpg', 'Sta Rita, Pampanga', 'https://maps.app.goo.gl/Gz8Hv6FwA7RVzUW89'),
(13, 'Boracandaba Resort', 'Located in: Santa Ana, Pampanga.', '../spot/santa ana/Boracandaba.jpeg', 'Santa Ana, Pampanga', 'https://maps.app.goo.gl/ABcXy3JK9pT4CV3U6'),
(14, 'Sawali Garden Resort', 'Located in: Santa Ana, Pampanga.', '../spot/santa ana/sawali.jpg', 'Santa Ana, Pampanga', 'https://maps.app.goo.gl/Fv8qT3zLmW2QRzFY8'),
(15, 'Barok\'s Resort', 'Located in: Santa Ana, Pampanga.', '../spot/santa ana/barok.jpg', 'Santa Ana, Pampanga', 'https://maps.app.goo.gl/N2QPxS6JuZqR2UwJ9'),
(16, 'Santa Ana Parish Church', 'Located in: Santa Ana, Pampanga.', '../spot/santa ana/church.jpg', 'Santa Ana, Pampanga', 'https://maps.app.goo.gl/Gz8Hv6FwA7RVzUW89'),
(17, 'San Simon Parish Church', 'Located in: San Simon, Pampanga.', '../spot/san simon/sansimonchurch.jpg', 'San Simon, Pampanga', 'https://maps.app.goo.gl/Fv8qT3zLmW2QRzFY8'),
(18, 'Hacienda Galea Resort', 'Located in: San Simon, Pampanga.', '../spot/san simon/aerostop.png', 'San Simon, Pampanga', 'https://maps.app.goo.gl/N2QPxS6JuZqR2UwJ9'),
(19, 'Villa Teresa Resort', 'Located in: San Simon, Pampanga.', '../spot/san simon/villa.jpg', 'San Simon, Pampanga', 'https://maps.app.goo.gl/Gz8Hv6FwA7RVzUW89'),
(20, 'Del Mar Resort', 'Located in: San Simon, Pampanga.', '../spot/san simon/del.jpg', 'San Simon, Pampanga', 'https://maps.app.goo.gl/ABcXy3JK9pT4CV3U6'),
(21, 'Luis Taruc Monument', 'Located in: San Luis, Pampanga.', '../spot/Sanluiss/IMG_20221127_085503.jpg', 'San Luis, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7'),
(22, 'Lot-Gar Farm Resort', 'Located in: San Luis, Pampanga.', '../spot/Sanluiss/lotgar.jpg', 'San Luis, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7'),
(23, 'Idol Tiktok', 'Located in: San Luis, Pampanga.', '../spot/Sanluiss/idol.jpg', 'San Luis, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7'),
(24, 'San Luis Gonzaga Parish Church', 'Located in: San Luis, Pampanga.', '../spot/Sanluiss/church.jpg', 'San Luis, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7'),
(25, 'San Fernando Train Station', 'Located in: San Fernando, Pampanga.', '../spot/san fernando/train.jpg', 'San Fernando, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7'),
(26, 'Heroes Hall', 'Located in: San Fernando, Pampanga.', '../spot/san fernando/heroeshall.jpg', 'San Fernando, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7'),
(27, 'Lazatin House', 'Located in: San Fernando, Pampanga.', '../spot/san fernando/lazatin.jpg', 'San Fernando, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7'),
(28, 'Death March Marker', 'Located in: San Fernando, Pampanga.', '../spot/san fernando/deathmarch.jpg', 'San Fernando, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7'),
(29, 'Miyamit Falls', 'Located in: Porac, Pampanga.', '../spot/porac/Miyamit/3.jpg', 'Porac, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7'),
(30, 'SandBox Alviera', 'Located in: Porac, Pampanga.', '../spot/porac/sandbox.png', 'Porac, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7'),
(31, 'Haduan Falls', 'Located in: Porac, Pampanga.', '../spot/porac/haduan-falls.jpg', 'Porac, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7'),
(32, 'Inararo Ecotour', 'Located in: Porac, Pampanga.', '../spot/porac/inararo.jpg', 'Porac, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7'),
(33, 'Sunset Park', 'Located in: Minalin, Pampanga.', '../spot/minalin/sunset.jpg', 'Minalin, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7'),
(34, 'Sta. Monica Parish Church', 'Located in: Sta Monica Minalin, Pampanga.', '../spot/minalin/stamonica.jpg', 'Sta Monica Minalin, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7'),
(35, 'Riverside Monument Santa Rita', 'Located in: Santo Tomas Minalin, Pampanga.', '../spot/minalin/riverside.jpg', 'Santo Tomas Minalin, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7'),
(36, 'Minalin River', 'Located in: Minalin, Pampanga.', '../spot/minalin/river.jpg', 'Minalin, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7'),
(37, 'Lakeshore', 'Located in: Mexico, Pampanga.', '../spot/mexico/lake.jpg', 'Mexico, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7'),
(38, 'Skyranch Pampanga', 'Located in: Mexico, Pampanga.', '../spot/mexico/skyranch.jpg', 'Mexico, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7'),
(39, 'Villa Alfredos', 'Located in: Mexico, Pampanga.', '../spot/mexico/villa.jpg', 'Mexico, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7'),
(40, 'Oval', 'Located in: Santo Domingo Mexico, Pampanga.', '../spot/mexico/santodomingo.JPG', 'Santo Domingo Mexico, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7'),
(41, 'San Miguel Arcangel Parish Church', 'Located in: Masantol, Pampanga.', '../spot/masantol/Sanmiguel/3.jpg', 'Masantol, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7'),
(42, 'King Arthur\'s Private Resort', 'Located in: Masantol, Pampanga.', '../spot/masantol/king.jpg', 'Masantol, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG8'),
(43, 'Ashleys Villa', 'Located in: Masantol, Pampanga.', '../spot/masantol/ashley.jpg', 'Masantol, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG9'),
(44, 'Malauli', 'Located in: Masantol, Pampanga.', '../spot/masantol/malauli.jpg', 'Masantol, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG10'),
(45, 'San Bartolome', 'Located in: San Bartolome Magalang, Pampanga.', '../spot/magalang/Facade_of_San_Bartolome_Church_(Magalang).jpg', 'San Bartolome Magalang, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7'),
(46, 'Magalang Plaza', 'Located in: Plaza Magalang, Pampanga.', '../spot/magalang/plaza.jpg', 'Plaza Magalang, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG8'),
(47, 'Elevation Magalang', 'Located in: Elevation Magalang, Pampanga.', '../spot/magalang/Elevation.jpg', 'Elevation Magalang, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG9'),
(48, 'Gueco House', 'Located in: Magalang, Pampanga.', '../spot/magalang/gueco.jpg', 'Magalang, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG10'),
(49, 'Consuelo Beach', 'Located in: Consuelo Macabebe, Pampanga.', '../spot/macabebe/consuelo.jpg', 'Consuelo Macabebe, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG11'),
(50, 'Cabalen', 'Located in: Cabalen Macabebe, Pampanga.', '../spot/macabebe/cabalen.jpg', 'Cabalen Macabebe, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG12'),
(51, 'Casa Palmera', 'Located in: Macabebe, Pampanga.', '../spot/macabebe/casa.jpeg', 'Macabebe, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG13'),
(52, 'Cabalen Church', 'Located in: Cabalen Macabebe, Pampanga.', '../spot/macabebe/cabalenchirch.jpg', 'Cabalen Macabebe, Pampanga', 'https://maps.app.goo.gl/Qhup1U9BVeDRVBCG14'),
(53, 'Bamboo Park', 'Located in: Lubao, Pampanga.', '../spot/lubao/bamboo.jpg', 'Lubao, Pampanga', 'https://maps.app.goo.gl/ZiCewXAeF5i8RJS18'),
(54, 'San Agustin Church', 'Located in: Lubao, Pampanga.', '../spot/lubao/sanagus.jpg', 'Lubao, Pampanga', 'https://maps.app.goo.gl/ZHZRkUYNZypc9kcu6'),
(55, 'Museo at Aklatan ni Diosdado Macapagal', 'Located in: Lubao, Pampanga.', '../spot/lubao/museum.jpg', 'Lubao, Pampanga', 'https://maps.app.goo.gl/T9FqSTCrVJcUio3e8'),
(56, 'San Antonio De Padua Parish', 'Located in: San Antonio Lubao, Pampanga.', '../spot/lubao/Sanan.jpg', 'San Antonio Lubao, Pampanga', 'https://maps.app.goo.gl/GKNc5Rpkrjj9Aau86'),
(57, 'The Venta Suites Pampanga', 'Located in: Guagua, Pampanga.', '../spot/guagua/venta.jpg', 'Guagua, Pampanga', 'https://maps.app.goo.gl/R3XDBH8rsKj15RDH7'),
(58, 'Angela\'s Private Resort', 'Located in: Guagua, Pampanga.', '../spot/guagua/angela.jpg', 'Guagua, Pampanga', 'https://maps.app.goo.gl/NDcWQ4zHav4QEQca9'),
(59, 'Villa Priscilla Resort & Pavilion', 'Located in: Guagua, Pampanga.', '../spot/guagua/pricilla.jpg', 'Guagua, Pampanga', 'https://maps.app.goo.gl/35jWgoLrZ1Lk9ucq9'),
(60, 'St James the Apostol Parish', 'Located in: Betis Guagua, Pampanga.', '../spot/guagua/church.jpg', 'Betis Guagua, Pampanga', 'https://maps.app.goo.gl/kHe5CkxPRxn2rNDD9'),
(61, 'Tungab', 'Located in: San Ramon Floridablanca, Pampanga.', '../Places/Places/florida/tungab.jpg', 'San Ramon Floridablanca, Pampanga', 'https://maps.app.goo.gl/1i3YJFPuyFLxyxg8A'),
(62, 'Palakol Summer Place', 'Located in: San Jose Floridablanca, Pampanga.', '../spot/florida/summer.jpg', 'San Jose Floridablanca, Pampanga', 'https://maps.app.goo.gl/gikc2UWzdbw21EzFA'),
(63, 'Sumuclab Lagoon', 'Located in: Mawacat Floridablanca, Pampanga.', '../spot/florida/sumuclab.png', 'Mawacat Floridablanca, Pampanga', 'https://maps.app.goo.gl/R5VxmwHucQFycbaDA'),
(64, 'Nabuclod Mountain View', 'Located in: Nabuclod Floridablanca, Pampanga.', '../spot/florida/nabuclod.jpg', 'Nabuclod Floridablanca, Pampanga', 'https://maps.app.goo.gl/KZA6kvjvXo6Z1PXAA'),
(65, 'Dara Water Falls', 'Located in: Porac, Pampanga, Philippines.', '../Places/Pampanga/Travel Hunter - 10.png', 'Porac, Pampanga, Philippines', 'https://maps.app.goo.gl/SiJdrqdmVc4xLimj9'),
(66, 'Miyamit Falls', 'Located in: Porac, Pampanga, Philippines.', '../Places/Pampanga/Travel Hunter - 6.png', 'Porac, Pampanga, Philippines', 'https://maps.app.goo.gl/Krvvrh9ujVq3h9SY9'),
(67, 'Puning Hotspring', 'Located in: Porac, Pampanga, Philippines.', '../Places/Pampanga/Travel Hunter - 7.png', 'Porac, Pampanga, Philippines', 'https://maps.app.goo.gl/MNxStiHvahBYBRMd6'),
(68, 'Mount Arayat', 'Located in: Arayat, Pampanga, Philippines.', '../Places/Pampanga/Travel Hunter - 8.png', 'Arayat, Pampanga, Philippines', 'https://maps.app.goo.gl/c2WQsnuEjzJAJo5x8'),
(69, 'Puerto Princesa Underground River', 'Located in: Palawan, Philippines.', '../Places/palawan/Travel Hunter - 1.png', 'Palawan, Philippines', 'https://maps.app.goo.gl/rFrST9msuLAtSKrc6'),
(70, 'El Nido', 'Located in: Palawan, Philippines.', '../Places/palawan/Travel Hunter - 2.png', 'Palawan, Philippines', 'https://maps.app.goo.gl/gBFhN3ac9BSaNfE56'),
(71, 'Coron Island', 'Located in: Palawan, Philippines.', '../Places/palawan/Travel Hunter - 3.png', 'Palawan, Philippines', 'https://maps.app.goo.gl/UodgkfEcCnQVyBej8'),
(72, 'Kayangan Lake', 'Located in: Palawan, Philippines.', '../Places/palawan/Travel Hunter - 4.png', 'Palawan, Philippines', 'https://maps.app.goo.gl/uJkQ4kH1b7RXVSp86'),
(73, 'Taal Volcano and Lake', 'Located in: Batangas, Philippines.', '../Places/batangas/Travel Hunter - 11.png', 'Batangas, Philippines', 'https://maps.app.goo.gl/6uK6ehdNt5CpvUof9'),
(74, 'Masasa Beach', 'Located in: Batangas, Philippines.', '../Places/batangas/Travel Hunter - 12.png', 'Batangas, Philippines', 'https://maps.app.goo.gl/vQKFMWt3Ahveig4A9'),
(75, 'Nasugbu Beach', 'Located in: Batangas, Philippines.', '../Places/batangas/Travel Hunter - 13.png', 'Batangas, Philippines', 'https://maps.app.goo.gl/hzeoANFaYv8EKRp96'),
(76, 'Mount Batulao', 'Located in: Batangas, Philippines.', '../Places/batangas/Travel Hunter - 14.png', 'Batangas, Philippines', 'https://maps.app.goo.gl/Pcz5h3oqTdwZ194b6'),
(77, 'Basco Light House', 'Located in: Batanes, Philippines.', '../Places/batanes/Travel Hunter - 16.png', 'Batanes, Philippines', 'https://maps.app.goo.gl/YMWPR79wJx1DA26R7'),
(78, 'Rakuha Payaman', 'Located in: Batanes, Philippines.', '../Places/batanes/Travel Hunter - 17.png', 'Batanes, Philippines', 'https://maps.app.goo.gl/UtAkF3fFRnBhhA5j8'),
(79, 'Valugan Boulder Beach', 'Located in: Batanes, Philippines.', '../Places/batanes/Travel Hunter - 18.png', 'Batanes, Philippines', 'https://maps.app.goo.gl/ikJJVp9vnemZqGxe7'),
(80, 'Morong Beach', 'Located in: Batanes, Philippines.', '../Places/batanes/Travel Hunter - 19.png', 'Batanes, Philippines', 'https://maps.app.goo.gl/qxHdQGFANw3HXrHU8'),
(81, 'Boracay Islands', 'Located in: Aklan, Philippines', '../Places/Aklan/Travel Hunter - 21.png', 'Aklan, Philippines', 'https://maps.app.goo.gl/ofmcxU8KQYVrpBxy9'),
(82, 'Ariel\'s Point', 'Located in: Aklan, Philippines', '../Places/Aklan/Travel Hunter - 22.png', 'Aklan, Philippines', 'https://maps.app.goo.gl/XoVfS425knwXfUV99'),
(83, 'Willy\'s Rock', 'Located in: Aklan, Philippines', '../Places/Aklan/Travel Hunter - 23.png', 'Aklan, Philippines', 'https://maps.app.goo.gl/LdtP8HRbbkFKmfgk8'),
(84, 'Puka Shell Beach', 'Located in: Aklan, Philippines', '../Places/Aklan/Travel Hunter - 24.png', 'Aklan, Philippines', 'https://maps.app.goo.gl/Ehms89Z8pZfytvVu8'),
(85, 'Ryu Jin', 'e6se6rhxtex', '../uploads/download (1).jfif', 'sadagfgs', 'w4wynexyenexy');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_text` text NOT NULL,
  `post_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_text`, `post_image`, `created_at`) VALUES
(44, 88, 'WONDERFUL', '../uploads/66f21ecf87c0d3.39080804.jpg', '2024-09-24 02:07:11'),
(45, 88, 'refreshing', '../uploads/66f21ef5236981.07397267.jpg', '2024-09-24 02:07:49'),
(46, 88, 'highly recommend', '../uploads/66f21f095536a6.22271291.png', '2024-09-24 02:08:09'),
(47, 91, 'cool place', '../uploads/66f21f9b332225.76191420.jpg', '2024-09-24 02:10:35'),
(48, 91, 'perfect spot for summer', '../uploads/66f21fb9921372.23912682.jpg', '2024-09-24 02:11:05'),
(49, 91, 'beautiful place', '../uploads/66f21fde37b549.00579532.jpg', '2024-09-24 02:11:42'),
(50, 93, 'refreshing view', '../uploads/66f220c55654a4.53523277.jpg', '2024-09-24 02:15:33'),
(51, 93, 'beautiful church', '../uploads/66f220da774e60.39809503.jpg', '2024-09-24 02:15:54'),
(52, 93, 'perfect for friends or family bonding', '../uploads/66f220f49de809.39021635.jpg', '2024-09-24 02:16:20'),
(53, 101, 'perfect for vacation', '../uploads/66f22198856f82.02460110.jpg', '2024-09-24 02:19:04'),
(54, 101, 'perfect place', '../uploads/66f221bc42ebb9.52199693.jpg', '2024-09-24 02:19:40'),
(55, 101, 'antique church', '../uploads/66f221d530c004.56324984.jpg', '2024-09-24 02:20:05');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `UserName` varchar(45) NOT NULL,
  `PassWord` varchar(255) NOT NULL,
  `FullName` varchar(45) NOT NULL,
  `image` varchar(100) NOT NULL,
  `UserRole` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `UserName`, `PassWord`, `FullName`, `image`, `UserRole`) VALUES
(88, 'cferdinand500@gmail.com', '$2y$10$mjv.pT76cocDV44ZRMBnwek4jrIFz9El0gAdaV6qmYzh2AR7wmF0.', 'FerdinandCastillo', '../uploads/abstract-colorful-low-poly-triangle-shapes_361591-3178.avif', 'manager'),
(89, 'catahanrachel@gmail.com', '$2y$10$pRxMyqzjUUh75t2KZIAbHe.XsAXqBK9NkxynwV5kAUtZntdhX209G', 'Rachel Catahan', 'f5d225ed6fca5f6ba426e50c2b8ed3a4d7334ef4ece291b27f26b815cbc29dd3.jpg', 'admin'),
(90, 'Marvicdizon@gmail.com', '$2y$10$G/M.JSij2AENqUrgOZMt5Odi249sr.Sz36iM2nW5/npFa8hUF7mL2', 'Marvic Dizon', '66adf50dc93b9.jpg', 'manager'),
(91, 'catahan@gmail.com', '$2y$10$GrwELa6j40tlTL5yoRMEWOP2TOQQRVYcpKOSOIXouUt4wlhkj3qTm', 'Rachel Catahan', '66af7bf6860cd.png', 'admin'),
(92, 'aron@gmail.com', '$2y$10$Tr/R1oK3SrRc18k33PKu1e/fxGaJn3F0aYHX61rg02bQCbPDZYHcy', 'marvic dizon', '66b4449c05424.png', ''),
(93, 'faster@gmail.com', '$2y$10$F3qiWAQ/11Nv50fNhM6Kh.2/KnslFs/0Dx8KcqaN.Bm2LcmLEytoy', 'Ralph pogs', '66dcef7a71f6e.png', ''),
(94, 'rcvx@gmail.com', '$2y$10$G8y3rbcIOKgIzIuo7Va60OvzuM6wAw7HTCALExtGsv4Rv.oQcsxEy', 'fasfaaasaf', 'default_profile.jpg', ''),
(101, 'lopezxam@gmail.com', '$2y$10$mjv.pT76cocDV44ZRMBnwek4jrIFz9El0gAdaV6qmYzh2AR7wmF0.', 'xam lalic', '../uploads/Screenshot 2024-06-05 135212.png', ''),
(102, 'jhonDatu@gmail.com', '$2y$10$bSll28Y8vAItmdhvtHaeguwwTV6EGwCOYQ8SnWg8H5KEwwRbnVS4y', 'Jhon Datu', '../uploads/gueco.jpg', ''),
(103, 'rapskile@gmail.com', '$2y$10$BMiwUivep8xEm2E7IgSNaOPXQ6BE2gVbk7NFaH7ov4HWx77ll3/Fy', 'rapskilers', '../uploads/default.jpg', '');

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
-- Indexes for table `cancelbook`
--
ALTER TABLE `cancelbook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `historybookings`
--
ALTER TABLE `historybookings`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `itinerary`
--
ALTER TABLE `itinerary`
  ADD PRIMARY KEY (`Itinerary_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=455;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `cancelbook`
--
ALTER TABLE `cancelbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `historybookings`
--
ALTER TABLE `historybookings`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `itinerary`
--
ALTER TABLE `itinerary`
  MODIFY `Itinerary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
