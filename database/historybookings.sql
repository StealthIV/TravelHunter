-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2024 at 02:13 PM
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
-- Database: `tourist1`
--

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
(10, 0, 'fee', 'cserbszrzs@gmail.com', '98765432', 20, '2024-08-21', 'hrtyndr', 5, 54333, 'mode', '0'),
(11, 0, 'marvic', 'Dizonmarvic6@gmail.com', '2147483647', 3, '2024-08-20', 'platinum', 5, 1000, 'gcash', '2147483647'),
(12, 0, 'marvic dizon', 'Dizonmarvic6@gmail.com', '09663174570', 7, '2024-09-19', 'super set', 3, 1000, 'gcash', '2147483647'),
(13, 0, 'Rachel', 'catahanrachel@gmail.com', '09663174570', 7, '2024-09-19', 'set 4', 7, 1000, 'gcash', '5476343'),
(14, 0, 'martin', 'Bacaniprincess@gmail.com', '09663174570', 7, '2024-09-17', 'set 4', 5, 1000, 'gcash', '2147483647'),
(15, 0, 'marvic123', 'Bacaniprincess@gmail.com', '09663174570', 4, '2024-09-19', 'Platinum', 2, 10000, 'Gcash', '2147483647'),
(16, 0, 'marvic dizon', 'Bacaniprincess@gmail.com', '09663174570', 5, '2024-09-25', 'Platinum', 5, 10000, 'Gcash', '2147483647'),
(17, 0, 'bgdgfdg', 'catahanrachel@gmail.com', '09663174570', 5, '2024-09-13', 'Platinum', 5, 5, 'Gcash', '53326'),
(18, 0, 'marvic dizon', 'Dizonmarvic6@gmail.com', '09663174570', 5, '2024-09-26', 'Platinum', 5, 1, 'Gcash', '2147483647');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `historybookings`
--
ALTER TABLE `historybookings`
  ADD PRIMARY KEY (`history_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `historybookings`
--
ALTER TABLE `historybookings`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
