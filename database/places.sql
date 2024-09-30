-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2024 at 02:13 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
