-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2024 at 07:05 AM
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
-- Database: `travelbooking`
--

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
(1, 'marvic', 'dizon_marvic@yahoo.com', 2147483647, 7, '2024-07-25', 'super set', 10, 20000, 'gcash', 2147483647),
(2, 'Rachel', 'catahanrachel@gmail.com', 2147483647, 7, '2024-07-17', 'set 4', 3, 10000, 'gcash', 53326),
(3, 'kurtney clarin', 'clarinkurtney@gmail.com', 2147483647, 7, '2024-07-17', 'set 4', 3, 10000, 'gcash', 53326),
(4, 'Rachel', 'catahanrachel@gmail.com', 2147483647, 3, '2024-07-09', 'set 4', 10, 10000, 'gcash', 2147483647),
(5, 'Rachel', 'catahanrachel@gmail.com', 2147483647, 3, '2024-07-09', 'set 4', 10, 10000, 'gcash', 2147483647),
(6, 'marvic', 'dizon_marvic@yahoo.com', 2147483647, 3, '2024-07-09', 'platinum', 8, 20000, 'gcash', 5476343),
(7, 'marvic', 'dizon_marvic@yahoo.com', 2147483647, 7, '2024-07-10', 'super set', 3, 10000, 'gcash', 2147483647),
(9, 'marvic dizon', 'catahanrachel@gmail.com', 2147483647, 7, '2024-08-13', 'set 4', 4, 13000, 'gcash', 657345632);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
