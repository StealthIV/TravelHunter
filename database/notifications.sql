-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2024 at 06:42 AM
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
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `booking_date` date NOT NULL,
  `status` varchar(99) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `like_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `user_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `name`, `booking_date`, `status`, `created_at`, `like_id`, `post_id`, `comment_id`, `user_id`) VALUES
(1, 'John Doe', '2024-10-19', 'confirmed', '2024-10-19 03:07:16', 2, NULL, 0, 0),
(2, 'Jane Smith', '2024-10-20', 'pending', '2024-10-19 03:15:42', 2, NULL, 0, 0),
(3, 'Michael Johnson', '2024-10-21', '', '2024-10-19 03:15:42', 2, NULL, 0, 0),
(4, 'Emily Davis', '2024-10-22', 'confirmed', '2024-10-19 03:21:47', 2, NULL, 0, 0),
(5, 'Daniel Brown', '2024-10-23', 'confirmed', '2024-10-19 03:21:47', 2, NULL, 0, 0),
(6, 'Olivia Wilson', '2024-10-24', 'pending', '2024-10-19 03:21:47', 2, NULL, 0, 0),
(7, 'Lucas Martin', '2024-10-25', '', '2024-10-19 03:21:47', 2, NULL, 0, 0),
(8, 'Sophia Garcia', '2024-10-26', 'confirmed', '2024-10-19 03:21:47', 2, NULL, 0, 0),
(9, 'James Lee', '2024-10-27', 'pending', '2024-10-19 03:21:47', 2, NULL, 0, 0),
(10, 'Isabella Walker', '2024-10-28', 'confirmed', '2024-10-19 03:21:47', 2, NULL, 0, 0),
(11, 'John Doe', '2024-10-19', 'confirmed', '2024-10-19 03:21:47', 2, NULL, 0, 0),
(21, 'Jane Smith', '2024-10-20', 'pending', '2024-10-19 03:21:47', 2, NULL, 0, 0),
(31, 'Michael Johnson', '2024-10-21', '', '2024-10-19 03:21:47', 2, NULL, 0, 0),
(32, 'cferdinand500@gmail.com liked your post', '0000-00-00', '', '2024-10-19 13:51:58', NULL, 58, NULL, 0),
(106, 'cferdinand500@gmail.com commented on your post', '0000-00-00', 'pending', '2024-10-19 14:30:07', NULL, 56, NULL, 0),
(107, 'cferdinand500@gmail.com commented on your post', '0000-00-00', 'read', '2024-10-19 14:39:46', NULL, 57, NULL, 106),
(108, 'cferdinand500@gmail.com commented on your post', '0000-00-00', 'read', '2024-10-19 14:39:49', NULL, 57, NULL, 106),
(109, 'cferdinand500@gmail.com liked your post', '0000-00-00', 'pending', '2024-10-19 14:40:15', NULL, 59, NULL, 0),
(110, 'cferdinand500@gmail.com liked your post', '0000-00-00', 'read', '2024-10-19 14:41:07', NULL, 60, NULL, 106),
(111, 'cferdinand500@gmail.com created a new post', '0000-00-00', 'read', '2024-10-19 14:42:36', NULL, 61, NULL, 106),
(112, 'cferdinand500@gmail.com commented on your post', '0000-00-00', 'read', '2024-10-19 14:56:21', NULL, 59, NULL, 106),
(113, 'cferdinand500@gmail.com commented on your post', '0000-00-00', 'read', '2024-10-19 14:56:25', NULL, 56, NULL, 106),
(114, 'Your booking is accepted for check-in on 2024-11-25', '2024-11-25', NULL, '2024-10-27 05:40:32', NULL, NULL, NULL, 106);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
