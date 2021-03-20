-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 24, 2020 at 11:26 AM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Zadanie7_DB`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `ip` varchar(20) COLLATE utf32_slovak_ci NOT NULL,
  `state` varchar(100) COLLATE utf32_slovak_ci NOT NULL,
  `code` varchar(10) COLLATE utf32_slovak_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf32_slovak_ci NOT NULL,
  `lat` varchar(50) COLLATE utf32_slovak_ci NOT NULL,
  `lon` varchar(50) COLLATE utf32_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_slovak_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip`, `state`, `code`, `city`, `lat`, `lon`) VALUES
(18, '198.50.155.77', 'United States', 'US', 'Newark', '40.735500335693', '-74.1728515625'),
(19, '217.182.175.63', 'France', 'FR', 'Roubaix', '50.691268920898', '3.1732099056244'),
(20, '176.31.227.198', 'France', 'FR', 'Roubaix', '50.691268920898', '3.1732099056244'),
(21, '68.235.61.78', 'United States', 'US', 'Chicago', '41.864669799805', '-87.619987487793'),
(22, '68.235.60.213', 'United States', 'US', 'Chicago', '41.864669799805', '-87.619987487793'),
(23, '68.235.60.205', 'United States', 'US', 'Chicago', '41.864669799805', '-87.619987487793'),
(24, '68.235.60.198', 'United States', 'US', 'Chicago', '41.864669799805', '-87.619987487793'),
(25, '68.235.52.123', 'United States', 'US', 'Chicago', '41.864669799805', '-87.619987487793'),
(26, '217.182.175.75', 'France', 'FR', 'Roubaix', '50.691268920898', '3.1732099056244'),
(27, '217.182.175.122', 'France', 'FR', 'Roubaix', '50.691268920898', '3.1732099056244'),
(28, '37.48.125.46', 'Netherlands', 'NL', 'Diemen', '52.309051513672', '4.9401898384094'),
(29, '195.168.20.5', 'Slovakia', 'SK', 'Galanta', '48.266998291016', '17.75'),
(30, '81.92.254.37', 'Slovakia', 'SK', 'Pezinok', '48.298099517822', '17.345500946045'),
(31, '84.245.120.117', 'Slovakia', 'SK', 'Nitra', '48.309898376465', '18.085899353027');

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `id` int(11) NOT NULL,
  `page_name` varchar(100) COLLATE utf32_slovak_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_slovak_ci;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`id`, `page_name`, `date`, `time`, `user_id`) VALUES
(39, 'PREDPOVEĎ POČASIA', '2020-04-24', '00:52:32', 18),
(40, 'POLOHA', '2020-04-24', '00:52:54', 18),
(41, 'NÁVŠTEVY', '2020-04-24', '00:52:58', 18),
(42, 'PREDPOVEĎ POČASIA', '2020-04-24', '00:53:17', 19),
(43, 'PREDPOVEĎ POČASIA', '2020-04-24', '00:53:31', 20),
(44, 'NÁVŠTEVY', '2020-04-24', '00:53:40', 20),
(45, 'PREDPOVEĎ POČASIA', '2020-04-24', '00:54:02', 21),
(46, 'POLOHA', '2020-04-24', '00:54:09', 21),
(47, 'NÁVŠTEVY', '2020-04-24', '00:54:13', 21),
(48, 'PREDPOVEĎ POČASIA', '2020-04-24', '00:54:29', 22),
(49, 'PREDPOVEĎ POČASIA', '2020-04-24', '00:54:50', 23),
(50, 'PREDPOVEĎ POČASIA', '2020-04-24', '00:55:02', 24),
(51, 'NÁVŠTEVY', '2020-04-24', '00:55:10', 24),
(52, 'PREDPOVEĎ POČASIA', '2020-04-24', '00:58:14', 25),
(53, 'PREDPOVEĎ POČASIA', '2020-04-24', '01:02:27', 26),
(54, 'POLOHA', '2020-04-24', '01:02:29', 26),
(55, 'NÁVŠTEVY', '2020-04-24', '01:02:31', 26),
(56, 'PREDPOVEĎ POČASIA', '2020-04-24', '01:13:11', 27),
(57, 'POLOHA', '2020-04-24', '01:13:15', 27),
(58, 'NÁVŠTEVY', '2020-04-24', '01:13:17', 27),
(59, 'PREDPOVEĎ POČASIA', '2020-04-24', '01:16:32', 28),
(60, 'POLOHA', '2020-04-24', '01:16:37', 28),
(61, 'NÁVŠTEVY', '2020-04-24', '01:16:41', 28),
(62, 'PREDPOVEĎ POČASIA', '2020-04-24', '08:55:41', 29),
(63, 'POLOHA', '2020-04-24', '08:56:07', 29),
(64, 'NÁVŠTEVY', '2020-04-24', '08:56:17', 29),
(65, 'PREDPOVEĎ POČASIA', '2020-04-24', '11:23:38', 30),
(66, 'POLOHA', '2020-04-24', '11:23:44', 30),
(67, 'NÁVŠTEVY', '2020-04-24', '11:24:31', 30),
(68, 'PREDPOVEĎ POČASIA', '2020-04-24', '13:01:14', 31),
(69, 'POLOHA', '2020-04-24', '13:01:16', 31),
(70, 'NÁVŠTEVY', '2020-04-24', '13:01:19', 31);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `visits`
--
ALTER TABLE `visits`
  ADD CONSTRAINT `visits_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
