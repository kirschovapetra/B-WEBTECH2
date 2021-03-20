-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 17, 2020 at 01:10 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Zadanie3_DB`
--

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) COLLATE utf8_slovak_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_slovak_ci NOT NULL,
  `login` varchar(100) COLLATE utf8_slovak_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_slovak_ci NOT NULL,
  `logintype` varchar(100) COLLATE utf8_slovak_ci NOT NULL,
  `logintimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`id`, `firstname`, `lastname`, `login`, `email`, `logintype`, `logintimestamp`) VALUES
(4, 'Petra', 'Kirschová', 'petra', 'kirschovapetra@gmail.com', 'Registrácia', '2020-03-14 19:53:59'),
(5, 'Petra', 'Kirschová', 'petra', 'kirschovapetra@gmail.com', 'Registrácia', '2020-03-14 19:54:05'),
(6, 'Petra', 'Kirschová', 'petra', 'kirschovapetra@gmail.com', 'Registrácia', '2020-03-14 19:54:09'),
(7, 'Petra', 'Kirschová', 'xkirschova', 'xkirschova@stuba.sk', 'LDAP', '2020-03-14 17:49:25'),
(8, 'Petra', 'Kirschová', 'xkirschova', 'xkirschova@stuba.sk', 'Registrácia', '2020-03-14 19:54:12'),
(9, 'Petra', 'Kirschová', 'xkirschova', 'xkirschova@stuba.sk', 'Registrácia', '2020-03-14 19:54:17'),
(10, 'Petra', 'Kirschová', 'xkirschova', 'xkirschova@stuba.sk', 'LDAP', '2020-03-14 18:03:41'),
(11, 'Petra', 'Kirschová', 'kirschovapetra@gmail.com', 'kirschovapetra@gmail.com', 'Google', '2020-03-14 20:23:52'),
(12, 'Petra', 'Kirschová', 'xkirschova', 'xkirschova@stuba.sk', 'LDAP', '2020-03-14 20:29:18'),
(13, 'Petra', 'Kirschová', 'kirschovapetra@gmail.com', 'kirschovapetra@gmail.com', 'Registrácia', '2020-03-14 19:54:21'),
(14, 'Petra', 'Kirschová', 'xkirschova@stuba.sk', 'xkirschova@stuba.sk', 'Registrácia', '2020-03-14 19:54:26'),
(15, 'Petra', 'Kirschová', 'kirschovapetra@gmail.com', 'kirschovapetra@gmail.com', 'Google', '2020-03-14 21:03:52'),
(16, 'Petra', 'Kirschová', 'petra', 'kirschovapetra@gmail.com', 'Registrácia', '2020-03-14 21:46:58'),
(17, 'Petra', 'Kirschová', 'petra', 'kirschovapetra@gmail.com', 'Registrácia', '2020-03-14 21:50:55'),
(18, 'Petra', 'Kirschová', 'petra', 'kirschovapetra@gmail.com', 'Registrácia', '2020-03-14 22:03:41'),
(19, 'Petra', 'Kirschová', 'petra', 'kirschovapetra@gmail.com', 'Registrácia', '2020-03-14 22:09:24'),
(20, 'Petra', 'Kirschová', 'petra', 'kirschovapetra@gmail.com', 'Registrácia', '2020-03-14 22:10:52'),
(21, 'Petra', 'Kirschová', 'petra', 'kirschovapetra@gmail.com', 'Registrácia', '2020-03-14 22:42:03'),
(22, 'Petra', 'Kirschová', 'petra', 'kirschovapetra@gmail.com', 'Registrácia', '2020-03-14 22:50:08'),
(23, 'Petra', 'Kirschová', 'petra', 'kirschovapetra@gmail.com', 'Registrácia', '2020-03-14 22:53:31'),
(24, 'Petra', 'Kirschová', 'petra', 'kirschovapetra@gmail.com', 'Registrácia', '2020-03-14 22:54:38'),
(25, 'Petra', 'Kirschová', 'kirschovapetra@gmail.com', 'kirschovapetra@gmail.com', 'Registrácia', '2020-03-14 23:03:50'),
(26, 'Petra', 'Kirschová', 'kirschovapetra@gmail.com', 'kirschovapetra@gmail.com', 'Google', '2020-03-15 12:14:41'),
(27, 'Petra', 'Kirschová', 'kirschovapetra@gmail.com', 'kirschovapetra@gmail.com', 'Registrácia', '2020-03-15 13:07:52'),
(28, 'Petra', 'Kirschová', 'xkirschova', 'xkirschova@stuba.sk', 'LDAP', '2020-03-15 13:12:03'),
(29, 'Petra', 'Kirschová', 'xkirschova', 'xkirschova@stuba.sk', 'LDAP', '2020-03-17 13:45:09'),
(30, 'Petra', 'Kirschová', 'xkirschova', 'xkirschova@stuba.sk', 'LDAP', '2020-03-17 13:49:30'),
(31, 'Petra', 'Kirschová', 'xkirschova', 'xkirschova@stuba.sk', 'LDAP', '2020-03-17 13:50:41'),
(32, 'Petra', 'Kirschová', 'kirschovapetra@gmail.com', 'kirschovapetra@gmail.com', 'Google', '2020-03-17 14:04:33'),
(33, 'petra', 'kirschova', 'pepa.k.28@gmail.com', 'pepa.k.28@gmail.com', 'Google', '2020-03-17 14:05:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) COLLATE utf8_slovak_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_slovak_ci NOT NULL,
  `login` varchar(100) COLLATE utf8_slovak_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_slovak_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `login`, `email`, `password`) VALUES
(1, 'Petra', 'Kirschová', 'petra', 'kirschovapetra@gmail.com', '$2y$10$9hRX5aAKl0nQORBuyth4ZONFZzINwp0EqijV.4FqyZsbBH/ABog0O'),
(2, 'Petra', 'Kirschová', 'xkirschova', 'xkirschova@stuba.sk', '$2y$10$4Ts2eMS7qCESh54yCommZei5C7qeUtd/l3pv2DKOrb1px8V4HGM6W'),
(3, 'simona ', 'abc', 'abcd', '123@456.78', '$2y$10$acv8/2u68f2/tFiOgj8/sO6TVLPCLVMlXbASWW.fVdITf/tHdLXE2'),
(4, 'x', 'y', 'xyz', 'zzz@zzz', '$2y$10$40rS7.Qu8YgXbmq77JJx6efvbwTygC9hh3NS2UYQYy/rFY4CSfq/e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
