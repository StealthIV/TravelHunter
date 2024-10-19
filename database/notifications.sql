-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2024 at 06:21 AM
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
  `status` enum('pending','confirmed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `name`, `booking_date`, `status`, `created_at`) VALUES
(1, 'John Doe', '2024-10-19', 'confirmed', '2024-10-19 03:07:16'),
(2, 'Jane Smith', '2024-10-20', 'pending', '2024-10-19 03:15:42'),
(3, 'Michael Johnson', '2024-10-21', '', '2024-10-19 03:15:42'),
(4, 'Emily Davis', '2024-10-22', 'confirmed', '2024-10-19 03:21:47'),
(5, 'Daniel Brown', '2024-10-23', 'confirmed', '2024-10-19 03:21:47'),
(6, 'Olivia Wilson', '2024-10-24', 'pending', '2024-10-19 03:21:47'),
(7, 'Lucas Martin', '2024-10-25', '', '2024-10-19 03:21:47'),
(8, 'Sophia Garcia', '2024-10-26', 'confirmed', '2024-10-19 03:21:47'),
(9, 'James Lee', '2024-10-27', 'pending', '2024-10-19 03:21:47'),
(10, 'Isabella Walker', '2024-10-28', 'confirmed', '2024-10-19 03:21:47'),
(11, 'John Doe', '2024-10-19', 'confirmed', '2024-10-19 03:21:47'),
(21, 'Jane Smith', '2024-10-20', 'pending', '2024-10-19 03:21:47'),
(31, 'Michael Johnson', '2024-10-21', '', '2024-10-19 03:21:47');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
