-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 11, 2020 at 07:27 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Zadanie2_DB`
--

-- --------------------------------------------------------

--
-- Table structure for table `osoby`
--

CREATE TABLE `osoby` (
  `id` int(11) NOT NULL,
  `id_vlady` int(11) NOT NULL,
  `id_utvary` int(11) NOT NULL,
  `meno` varchar(150) COLLATE utf8_slovak_ci NOT NULL,
  `id_strany` int(11) DEFAULT NULL,
  `datumOD` date NOT NULL,
  `datumDO` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `osoby`
--

INSERT INTO `osoby` (`id`, `id_vlady`, `id_utvary`, `meno`, `id_strany`, `datumOD`, `datumDO`) VALUES
(1, 1, 60, 'Milan Čič', NULL, '1989-12-12', '1990-06-26'),
(2, 1, 61, 'Vladimír Lexa', NULL, '1989-12-12', '1990-06-26'),
(3, 1, 46, 'Jozef Markuš', NULL, '1989-12-12', '1990-06-26'),
(4, 1, 46, 'Vladimír Ondruš', 26, '1989-12-12', '1990-06-26'),
(5, 1, 46, 'Alexander Varga', 26, '1989-12-12', '1990-06-26'),
(6, 1, 8, 'Michal Kováč', NULL, '1989-12-12', '1990-06-26'),
(7, 1, 11, 'Ladislav Chudík', NULL, '1989-12-12', '1990-03-29'),
(8, 1, 11, 'Ladislav Snopko', 26, '1990-03-29', '1990-06-26'),
(9, 1, 13, 'Ivan Veselý', NULL, '1989-12-12', '1990-06-26'),
(10, 1, 15, 'Matej Roľko', NULL, '1989-12-12', '1990-06-26'),
(11, 1, 20, 'Miroslav Belanský', NULL, '1989-12-12', '1990-06-26'),
(12, 1, 21, 'Kazimir Nagy', NULL, '1989-12-12', '1990-06-26'),
(13, 1, 26, 'Ján Ducký', NULL, '1989-12-12', '1990-06-26'),
(14, 1, 30, 'Ladislav Kováč', NULL, '1989-12-12', '1990-06-26'),
(15, 1, 33, 'Ladislav Košťa', 26, '1989-12-12', '1990-06-26'),
(16, 1, 35, 'Milan Čič', NULL, '1989-12-12', '1990-01-11'),
(17, 1, 35, 'Vladimír Mečiar', NULL, '1990-01-11', '1990-06-26'),
(18, 1, 38, 'Ivan Šteis', NULL, '1989-12-12', '1990-06-26'),
(19, 1, 44, 'Jozef Markuš', NULL, '1989-12-12', '1990-01-11'),
(20, 1, 44, 'Stanislav Novák', NULL, '1990-01-11', '1990-06-26'),
(21, 1, 62, 'Vladimir Lexa', NULL, '1989-12-12', '1990-06-26'),
(22, 1, 65, 'Mária Kolaříková', NULL, '1989-12-12', '1990-01-11'),
(23, 1, 65, 'Silvester Minarovič', NULL, '1990-01-11', '1990-06-26'),
(24, 2, 60, 'Vladimír Mečiar', NULL, '1990-06-27', '1991-04-22'),
(25, 2, 61, 'Ján Čarnogurský', 9, '1990-06-27', '1991-04-22'),
(26, 2, 46, 'Jozef Kučerák', NULL, '1990-06-27', '1991-04-22'),
(27, 2, 46, 'Vladimír Ondruš', 26, '1990-06-27', '1991-04-22'),
(28, 2, 46, 'Gábor Zászlós', 26, '1990-06-27', '1991-04-22'),
(29, 2, 1, 'Milan Kňažko', NULL, '1990-06-27', '1990-10-06'),
(30, 2, 8, 'Michal Kováč', NULL, '1990-06-27', '1991-04-22'),
(31, 2, 9, 'Jozef Belcák', NULL, '1990-06-27', '1991-04-22'),
(32, 2, 10, 'Martin Hvozdík', NULL, '1990-10-06', '1991-04-22'),
(33, 2, 11, 'Ladislav Snopko', 26, '1990-06-27', '1991-04-22'),
(34, 2, 12, 'Viliam Oberhauser', 9, '1990-06-27', '1991-04-22'),
(35, 2, 14, 'Milan Kňažko', NULL, '1990-10-06', '1991-04-22'),
(36, 2, 15, 'Jozef Chren', NULL, '1990-06-27', '1991-04-22'),
(37, 2, 17, 'Rudolf Filkus', NULL, '1990-06-27', '1990-10-06'),
(38, 2, 20, 'Michal Džatko', NULL, '1990-06-27', '1991-04-22'),
(39, 2, 22, 'Stanislav Novák', NULL, '1990-06-27', '1991-04-22'),
(40, 2, 24, 'Rudolf Filkus', NULL, '1990-10-06', '1991-04-22'),
(41, 2, 26, 'Ján Holčík', NULL, '1990-06-27', '1991-04-22'),
(42, 2, 31, 'Ladislav Kováč', NULL, '1990-06-27', '1990-09-06'),
(43, 2, 31, 'Ján Pišút', NULL, '1990-09-06', '1991-04-22'),
(44, 2, 33, 'Ladislav Košťa', 26, '1990-06-27', '1991-04-22'),
(45, 2, 34, 'Anton Andráš', 9, '1990-06-27', '1990-11-22'),
(46, 2, 34, 'Ladislav Pittner', NULL, '1990-11-22', '1991-04-22'),
(47, 2, 38, 'Jozef Dubníček', NULL, '1990-06-27', '1991-04-22'),
(48, 2, 43, 'Alojz Rakús', NULL, '1990-06-27', '1991-04-22'),
(49, 2, 63, 'Ivan Tirpák', NULL, '1990-06-27', '1991-04-22'),
(50, 2, 64, 'Augustín Marián Húska', NULL, '1990-06-27', '1991-04-22'),
(51, 2, 65, 'Martin Hvozdík', NULL, '1990-06-27', '1990-10-06'),
(52, 3, 60, 'Ján Čarnogurský', 9, '1991-04-23', '1992-06-24'),
(53, 3, 61, 'Martin Porubjak', NULL, '1991-08-28', '1992-06-24'),
(54, 3, 46, 'Gábor Zászlós', 26, '1991-04-23', '1992-06-24'),
(55, 3, 46, 'Anton Vavro', NULL, '1991-04-23', '1992-06-24'),
(56, 3, 3, 'Vladimír Pavle', NULL, '1991-04-23', '1992-06-24'),
(57, 3, 7, 'Michal Kováč', NULL, '1991-04-23', '1991-06-14'),
(58, 3, 7, 'Jozef Dančo', NULL, '1991-06-14', '1992-06-24'),
(59, 3, 9, 'Jozef Belcák', NULL, '1991-04-23', '1992-06-24'),
(60, 3, 10, 'Martin Hvozdík', NULL, '1991-04-23', '1992-06-24'),
(61, 3, 11, 'Ladislav Snopko', 26, '1991-04-23', '1992-06-24'),
(62, 3, 12, 'Viliam Oberhauser', 9, '1991-04-23', '1992-06-24'),
(63, 3, 14, 'Ján Čarnogurský', 9, '1991-04-23', '1991-05-06'),
(64, 3, 14, 'Pavol Demeš', NULL, '1991-05-06', '1992-06-24'),
(65, 3, 15, 'Jozef Chren', NULL, '1991-04-23', '1992-02-18'),
(66, 3, 15, 'Jana Kotová', NULL, '1992-02-18', '1992-06-24'),
(67, 3, 20, 'Viliam Oberhauser', 9, '1991-04-23', '1991-08-28'),
(68, 3, 20, 'Jozef Kršek', NULL, '1991-08-28', '1992-06-24'),
(69, 3, 22, 'Helena Woleková', NULL, '1991-04-23', '1992-06-24'),
(70, 3, 24, 'Rudolf Filkus', NULL, '1991-04-23', '1991-08-01'),
(71, 3, 25, 'Ivan Mikloš', NULL, '1991-04-23', '1992-06-24'),
(72, 3, 26, 'Ján Holčík', NULL, '1991-04-23', '1992-06-24'),
(73, 3, 29, 'Ján Pišút', NULL, '1991-04-23', '1992-06-24'),
(74, 3, 33, 'Marian Posluch', NULL, '1991-04-23', '1992-06-24'),
(75, 3, 34, 'Ladislav Pittner', NULL, '1991-04-23', '1992-06-24'),
(76, 3, 38, 'Jozef Belcák', NULL, '1991-04-23', '1991-08-28'),
(77, 3, 38, 'Jozef Bútora', NULL, '1991-08-28', '1992-06-24'),
(78, 3, 43, 'Alojz Rakús', NULL, '1991-04-23', '1992-06-24'),
(79, 3, 63, 'Jozef Zlocha', NULL, '1991-04-23', '1992-06-24'),
(80, 4, 60, 'Vladimír Mečiar ', 10, '1992-06-24', '1994-03-15'),
(81, 4, 61, 'Roman Kováč ', 10, '1992-06-24', '1994-03-15'),
(82, 4, 46, 'Milan Kňažko ', 10, '1992-06-24', '1994-02-25'),
(83, 4, 46, 'Marián Andel ', 18, '1993-11-10', '1994-03-15'),
(84, 4, 46, 'Sergej Kozlík ', 10, '1993-11-10', '1994-03-15'),
(85, 4, 46, 'Jozef Prokeš ', 18, '1993-11-10', '1994-03-15'),
(86, 4, 9, 'Ľudovít Černák ', 18, '1992-06-24', '1993-03-19'),
(87, 4, 9, 'Jaroslav Kubečka ', 10, '1993-03-19', '1993-11-10'),
(88, 4, 3, 'Roman Hofbauer ', 10, '1992-06-24', '1994-03-15'),
(89, 4, 7, 'Július Tóth ', 10, '1992-06-24', '1994-03-15'),
(90, 4, 9, 'Ján Ducký ', 10, '1993-11-10', '1994-03-15'),
(91, 4, 10, 'Roman Kováč ', 10, '1992-06-24', '1993-02-15'),
(92, 4, 11, 'Dušan Slobodník ', 10, '1992-06-24', '1994-03-15'),
(93, 4, 14, 'Milan Kňažko ', 10, '1992-06-24', '1993-03-19'),
(94, 4, 14, 'Jozef Moravčík ', 10, '1993-03-19', '1994-03-15'),
(95, 4, 16, 'Imrich Andrejčák ', 10, '1993-03-16', '1994-03-15'),
(96, 4, 20, 'Peter Baco ', 10, '1992-06-24', '1994-03-15'),
(97, 4, 22, 'Oľga Keltošová ', 10, '1992-06-24', '1994-03-15'),
(98, 4, 25, 'Ľubomír Dolgoš ', 10, '1992-06-24', '1994-03-15'),
(99, 4, 25, 'Vladimír Mečiar ', 10, '1993-06-22', '1994-03-15'),
(100, 4, 27, 'Dušan Slobodník ', 10, '1992-06-24', '1992-09-26'),
(101, 4, 27, 'Matúš Kučera ', 10, '1992-09-26', '1993-06-22'),
(102, 4, 27, 'Roman Kováč ', 10, '1993-06-22', '1993-11-10'),
(103, 4, 27, 'Jaroslav Paška ', 18, '1993-11-10', '1994-03-15'),
(104, 4, 33, 'Katarína Tóthová ', 10, '1992-06-24', '1994-03-15'),
(105, 4, 34, 'Jozef Tuchyňa ', 10, '1992-06-24', '1994-03-15'),
(106, 4, 43, 'Viliam Soboňa ', 10, '1992-06-24', '1993-11-24'),
(107, 4, 43, 'Irena Belohorská ', 10, '1993-11-24', '1994-03-15'),
(108, 4, 63, 'Jozef Zlocha ', 10, '1992-06-24', '1994-03-15'),
(109, 5, 60, 'Jozef Moravčík ', 4, '1994-03-15', '1994-12-13'),
(110, 5, 54, 'Ivan Šimko ', 9, '1994-03-15', '1994-12-13'),
(111, 5, 57, 'Roman Kováč ', 4, '1994-03-15', '1994-12-13'),
(112, 5, 51, 'Brigita Schmögnerová ', 22, '1994-03-15', '1994-12-13'),
(113, 5, 5, 'Mikuláš Dzurinda ', 9, '1994-03-15', '1994-12-13'),
(114, 5, 7, 'Rudolf Filkus ', 4, '1994-03-15', '1994-12-13'),
(115, 5, 9, 'Peter Magvaši ', 22, '1994-03-15', '1994-12-13'),
(116, 5, 11, 'Ľubomír Roman ', 9, '1994-03-15', '1994-12-13'),
(117, 5, 16, 'Pavol Kanis ', 22, '1994-03-15', '1994-12-13'),
(118, 5, 18, 'Pavel Koncoš ', 22, '1994-03-15', '1994-12-13'),
(119, 5, 23, 'Július Brocka ', 9, '1994-03-15', '1994-12-13'),
(120, 5, 25, 'Milan Janičina ', 29, '1994-03-15', '1994-12-13'),
(121, 5, 28, 'Ľubomír Harach ', 22, '1994-03-15', '1994-12-13'),
(122, 5, 33, 'Milan Hanzel ', 22, '1994-03-15', '1994-12-13'),
(123, 5, 34, 'Ladislav Pittner ', 9, '1994-03-15', '1994-12-13'),
(124, 5, 41, 'Eduard Kukan ', 4, '1994-03-15', '1994-12-13'),
(125, 5, 43, 'Tibor Šagát ', 4, '1994-03-15', '1994-12-13'),
(126, 5, 45, 'Juraj Hraško ', 22, '1994-03-15', '1994-12-13'),
(127, 6, 60, ' Vladimír Mečiar ', 10, '1994-12-13', '1998-10-30'),
(128, 6, 54, ' Katarína Tóthová ', 10, '1994-12-13', '1998-10-30'),
(129, 6, 47, ' Sergej Kozlík ', 10, '1994-12-13', '1998-10-30'),
(130, 6, 58, ' Jozef Kalman ', 27, '1994-12-13', '1998-10-30'),
(131, 6, 4, 'Alexander Rezeš ', 10, '1994-12-13', '1997-04-15'),
(132, 6, 4, 'Ján Jasovský ', 10, '1997-04-16', '1998-10-30'),
(133, 6, 7, 'Sergej Kozlík ', 10, '1994-12-13', '1998-01-14'),
(134, 6, 7, 'Miroslav Maxon ', 28, '1998-01-14', '1998-10-30'),
(135, 6, 9, 'Ján Ducký ', 10, '1994-12-13', '1996-08-27'),
(136, 6, 9, 'Karol Česnek ', 10, '1996-08-27', '1998-02-27'),
(137, 6, 9, 'Milan Cagala ', 10, '1998-02-27', '1998-10-30'),
(138, 6, 11, 'Ivan Hudec ', 10, '1994-12-13', '1998-10-30'),
(139, 6, 16, 'Ján Sitek ', 18, '1994-12-13', '1998-10-30'),
(140, 6, 18, 'Peter Baco ', 10, '1994-12-13', '1998-10-30'),
(141, 6, 23, 'Oľga Keltošová ', 10, '1994-12-13', '1998-02-27'),
(142, 6, 23, 'Vojtech Tkáč ', 10, '1998-02-27', '1998-10-30'),
(143, 6, 25, 'Peter Bisák ', 27, '1994-12-13', '1998-10-30'),
(144, 6, 27, 'Eva Slavkovská ', 18, '1994-12-13', '1998-10-30'),
(145, 6, 33, 'Jozef Liščák ', 27, '1994-12-13', '1998-10-30'),
(146, 6, 34, 'Ľudovít Hudek ', 10, '1994-12-13', '1996-08-27'),
(147, 6, 34, 'Gustáv Krajči ', 10, '1996-08-27', '1998-10-30'),
(148, 6, 39, 'Ján Mráz ', 27, '1994-12-13', '1998-10-30'),
(149, 6, 41, 'Juraj Schenk ', 10, '1994-12-13', '1996-08-27'),
(150, 6, 41, 'Pavol Hamžík ', 10, '1996-08-27', '1997-06-11'),
(151, 6, 41, 'Zdenka Kramplová ', 10, '1997-06-11', '1998-10-06'),
(152, 6, 41, 'Jozef Kalman ', 27, '1998-10-06', '1998-10-30'),
(153, 6, 43, 'Ľubomír Javorský ', 10, '1994-12-13', '1998-10-30'),
(154, 6, 45, 'Jozef Zlocha ', 10, '1994-12-13', '1998-10-30'),
(155, 7, 60, 'Mikuláš Dzurinda', 17, '1998-10-30', '2002-10-15'),
(156, 7, 48, 'Ivan Mikloš', 17, '1998-10-30', '2002-10-15'),
(157, 7, 54, 'Ľubomír Fogaš', 22, '1998-10-30', '2002-10-15'),
(158, 7, 47, 'Mária Kadlečíková', 24, '1998-10-30', '2001-05-04'),
(159, 7, 47, 'Pavol Hamžík', 24, '2001-05-30', '2002-10-15'),
(160, 7, 55, 'Pál Csáky', 23, '1998-10-30', '2002-10-15'),
(161, 7, 41, 'Eduard Kukan', 17, '1998-10-30', '2002-10-15'),
(162, 7, 9, 'Ľudovít Černák', 17, '1998-10-30', '1999-10-20'),
(163, 7, 9, 'Ľubomír Harach', 17, '1999-10-21', '2002-10-15'),
(164, 7, 16, 'Pavol Kanis', 22, '1998-10-30', '2001-01-02'),
(165, 7, 16, 'Jozef Stank', 22, '2001-01-02', '2002-10-15'),
(166, 7, 34, 'Ladislav Pittner', 17, '1998-10-30', '2001-05-14'),
(167, 7, 34, 'Ivan Šimko', 17, '2001-05-14', '2002-10-15'),
(168, 7, 7, 'Brigita Schmögnerová', 22, '1998-10-30', '2002-01-29'),
(169, 7, 7, 'František Hajnovič', 22, '2002-01-29', '2002-10-15'),
(170, 7, 11, 'Milan Kňažko', 17, '1998-10-30', '2002-10-15'),
(171, 7, 25, 'Mária Machová', 24, '1998-10-30', '2002-10-15'),
(172, 7, 43, 'Tibor Šagát', 17, '1998-10-30', '2000-07-10'),
(173, 7, 43, 'Roman Kováč', 17, '2000-07-10', '2002-10-15'),
(174, 7, 27, 'Milan Ftáčnik', 22, '1998-10-30', '2002-04-18'),
(175, 7, 27, 'Peter Ponický', 22, '2002-04-18', '2002-10-15'),
(176, 7, 33, 'Ján Čarnogurský', 17, '1998-10-30', '2002-10-15'),
(177, 7, 23, 'Peter Magvaši', 22, '1998-10-30', '2002-10-15'),
(178, 7, 45, 'László Miklós', 23, '1998-10-30', '2002-10-15'),
(179, 7, 68, 'Pavel Koncoš', 22, '1998-10-30', '2002-10-15'),
(180, 7, 4, 'Gabriel Palacka', 17, '1998-10-30', '1999-08-11'),
(181, 7, 4, 'Jozef Macejko', 17, '1999-08-12', '2002-06-22'),
(182, 7, 4, 'Ivan Mikloš', 17, '2002-06-22', '2002-10-15'),
(183, 7, 37, 'István Harna', 23, '1998-10-30', '2000-10-15'),
(184, 8, 60, 'Mikuláš Dzurinda', 16, '2002-10-16', '2006-07-04'),
(185, 8, 49, 'Pál Csáky', 23, '2002-10-16', '2006-07-04'),
(186, 8, 46, 'Ivan Mikloš', 16, '2002-10-16', '2006-07-04'),
(187, 8, 46, 'Daniel Lipšic', 9, '2002-10-16', '2006-02-08'),
(188, 8, 46, 'Lucia Žitňanská', 16, '2006-02-08', '2006-07-04'),
(189, 8, 46, 'Robert Nemcsics', 2, '2002-10-16', '2003-09-09'),
(190, 8, 46, 'Pavol Rusko', 2, '2003-09-23', '2005-08-24'),
(191, 8, 46, 'Jirko Malchárek', NULL, '2005-10-04', '2006-07-04'),
(192, 8, 9, 'Robert Nemcsics', 2, '2002-10-16', '2003-09-09'),
(193, 8, 9, 'Pavol Prokopovič', 16, '2003-09-10', '2003-09-23'),
(194, 8, 9, 'Pavol Rusko', 2, '2003-09-23', '2005-08-24'),
(195, 8, 9, 'Ivan Mikloš', 16, '2005-08-24', '2005-10-04'),
(196, 8, 9, 'Jirko Malchárek', NULL, '2005-10-04', '2006-07-04'),
(197, 8, 7, 'Ivan Mikloš', 16, '2002-10-16', '2006-07-04'),
(198, 8, 2, 'Pavol Prokopovič', 16, '2002-10-16', '2006-07-04'),
(199, 8, 18, 'Zsolt Simon', 23, '2002-10-16', '2006-07-04'),
(200, 8, 36, 'László Gyurovszky', 23, '2002-10-16', '2006-07-04'),
(201, 8, 34, 'Vladimír Palko', 9, '2002-10-16', '2006-02-08'),
(202, 8, 34, 'Martin Pado', 16, '2006-02-08', '2006-07-04'),
(203, 8, 16, 'Ivan Šimko', 16, '2002-10-16', '2003-09-24'),
(204, 8, 16, 'Eduard Kukan', 16, '2003-09-24', '2003-10-10'),
(205, 8, 16, 'Juraj Liška', 16, '2003-10-10', '2006-02-01'),
(206, 8, 16, 'Martin Fedor', 16, '2006-02-01', '2006-07-04'),
(207, 8, 33, 'Daniel Lipšic', 9, '2002-10-16', '2006-02-08'),
(208, 8, 33, 'Lucia Žitňanská', 16, '2006-02-08', '2006-07-04'),
(209, 8, 40, 'Eduard Kukan', 16, '2002-10-16', '2006-07-04'),
(210, 8, 32, 'Ľudovít Kaník', 16, '2002-10-16', '2005-10-17'),
(211, 8, 32, 'Iveta Radičová', 16, '2005-10-17', '2006-07-04'),
(212, 8, 45, 'László Miklós', 23, '2002-10-16', '2006-07-04'),
(213, 8, 27, 'Martin Fronc', 9, '2002-10-16', '2006-02-08'),
(214, 8, 27, 'László Szigeti', 23, '2006-02-08', '2006-07-04'),
(215, 8, 11, 'Rudolf Chmel', 2, '2002-10-16', '2005-05-24'),
(216, 8, 11, 'František Tóth', 2, '2005-05-24', '2006-04-05'),
(217, 8, 11, 'Rudolf Chmel', 2, '2006-04-05', '2006-07-04'),
(218, 8, 43, 'Rudolf Zajac', 2, '2002-10-16', '2006-07-04'),
(219, 9, 60, 'Robert Fico', 20, '2006-07-04', '2010-07-08'),
(220, 9, 59, 'Dušan Čaplovič', 20, '2006-07-04', '2010-07-08'),
(221, 9, 46, 'Robert Kaliňák', 20, '2006-07-04', '2010-07-08'),
(222, 9, 34, 'Robert Kaliňák', 20, '2006-07-04', '2010-07-08'),
(223, 9, 46, 'Ján Mikolaj', 18, '2006-07-04', '2010-07-08'),
(224, 9, 27, 'Ján Mikolaj', 18, '2006-07-04', '2010-07-08'),
(225, 9, 46, 'Štefan Harabin', NULL, '2006-07-04', '2009-06-23'),
(226, 9, 46, 'Viera Petríková', 10, '2009-07-03', '2010-07-08'),
(227, 9, 33, 'Štefan Harabin', NULL, '2006-07-04', '2009-06-23'),
(228, 9, 33, 'Robert Fico', 20, '2009-03-26', '2009-07-03'),
(229, 9, 33, 'Viera Petríková', 10, '2009-07-03', '2010-07-08'),
(230, 9, 9, 'Ľubomír Jahnátek', 20, '2006-07-04', '2010-07-08'),
(231, 9, 7, 'Ján Počiatek', 20, '2006-07-04', '2010-07-08'),
(232, 9, 4, 'Ľubomír Vážny', 20, '2006-07-04', '2010-07-08'),
(233, 9, 68, 'Miroslav Jureňa', 10, '2006-07-04', '2007-11-28'),
(234, 9, 68, 'Zdenka Kramplová', 10, '2007-11-28', '2008-10-18'),
(235, 9, 68, 'Stanislav Becík', 10, '2008-10-18', '2009-09-16'),
(236, 9, 68, 'Vladimír Chovan', 10, '2009-09-16', '2010-07-08'),
(237, 9, 37, 'Marian Janušek', 18, '2006-07-04', '2009-04-15'),
(238, 9, 37, 'Igor Štefanov', 18, '2009-04-15', '2010-03-11'),
(239, 9, 37, 'Ján Mikolaj', 18, '2010-03-11', '2010-07-08'),
(240, 9, 16, 'František Kašický', 20, '2006-07-04', '2008-01-30'),
(241, 9, 16, 'Jaroslav Baška', 20, '2008-01-30', '2010-07-08'),
(242, 9, 41, 'Ján Kubiš', 20, '2006-07-04', '2009-01-26'),
(243, 9, 41, 'Miroslav Lajčák', 20, '2009-01-26', '2010-07-08'),
(244, 9, 23, 'Viera Tomanová', 20, '2006-07-04', '2010-07-08'),
(245, 9, 45, 'Jaroslav Izák', 18, '2006-07-04', '2008-08-18'),
(246, 9, 45, 'Ján Chrbet', 18, '2008-08-18', '2009-05-05'),
(247, 9, 45, 'Ján Mikolaj', 18, '2009-05-06', '2009-05-20'),
(248, 9, 45, 'Viliam Turský', 18, '2009-05-20', '2009-08-28'),
(249, 9, 45, 'Dušan Čaplovič', 20, '2009-08-28', '2009-10-28'),
(250, 9, 45, 'Jozef Medveď', 20, '2009-10-29', '2010-06-30'),
(251, 9, 11, 'Marek Maďarič', 20, '2006-07-04', '2010-07-08'),
(252, 9, 43, 'Ivan Valentovič', 20, '2006-07-04', '2008-06-03'),
(253, 9, 43, 'Richard Raši', 20, '2008-06-03', '2010-07-08'),
(254, 10, 60, 'Iveta Radičová', 16, '2010-07-08', '2012-04-04'),
(255, 10, 46, 'Ján Figeľ', 9, '2010-07-08', '2012-04-04'),
(256, 10, 6, 'Ján Figeľ', 9, '2010-07-08', '2012-04-04'),
(257, 10, 56, 'Rudolf Chmel', 13, '2010-07-08', '2012-04-04'),
(258, 10, 46, 'Jozef Mihál', 15, '2010-07-08', '2012-04-04'),
(259, 10, 46, 'Ivan Mikloš', 16, '2010-07-08', '2012-04-04'),
(260, 10, 23, 'Jozef Mihál', 15, '2010-07-08', '2012-04-04'),
(261, 10, 7, 'Ivan Mikloš', 16, '2010-07-08', '2012-04-04'),
(262, 10, 9, 'Juraj Miškov', 15, '2010-07-08', '2012-04-04'),
(263, 10, 67, 'Zsolt Simon', 13, '2010-07-08', '2012-04-04'),
(264, 10, 34, 'Daniel Lipšic', 9, '2010-07-08', '2012-04-04'),
(265, 10, 16, 'Ľubomír Galko', 15, '2010-07-08', '2011-11-23'),
(266, 10, 16, 'Iveta Radičová', 16, '2011-11-28', '2012-04-04'),
(267, 10, 33, 'Lucia Žitňanská', 16, '2010-07-08', '2012-04-04'),
(268, 10, 41, 'Mikuláš Dzurinda', 16, '2010-07-08', '2012-04-04'),
(269, 10, 66, 'Eugen Jurzyca', 16, '2010-07-08', '2012-04-04'),
(270, 10, 11, 'Daniel Krajcer', 15, '2010-07-08', '2012-04-04'),
(271, 10, 43, 'Ivan Uhliarik', 9, '2010-07-08', '2012-04-04'),
(272, 10, 45, 'József Nagy', 13, '2010-11-02', '2012-04-04'),
(273, 11, 60, 'Robert Fico', 20, '2012-04-04', '2016-03-23'),
(274, 11, 46, 'Robert Kaliňák', 20, '2012-04-04', '2016-03-23'),
(275, 11, 46, 'Miroslav Lajčák', NULL, '2012-04-04', '2016-03-23'),
(276, 11, 46, 'Peter Kažimír', 20, '2012-04-04', '2016-03-23'),
(277, 11, 34, 'Robert Kaliňák', 20, '2012-04-04', '2016-03-23'),
(278, 11, 41, 'Miroslav Lajčák', NULL, '2012-04-04', '2016-03-23'),
(279, 11, 7, 'Peter Kažimír', 20, '2012-04-04', '2016-03-23'),
(280, 11, 52, 'Ľubomír Vážny', 20, '2012-11-26', '2016-03-23'),
(281, 11, 16, 'Martin Glváč', 20, '2012-04-04', '2016-03-22'),
(282, 11, 16, 'Robert Fico', 20, '2016-03-22', '2016-03-23'),
(283, 11, 6, 'Ján Počiatek', 20, '2012-04-04', '2016-03-23'),
(284, 11, 33, 'Tomáš Borec', NULL, '2012-04-04', '2016-03-23'),
(285, 11, 23, 'Ján Richter', 20, '2012-04-04', '2016-03-23'),
(286, 11, 43, 'Zuzana Zvolenská', NULL, '2012-04-04', '2014-11-06'),
(287, 11, 43, 'Viliam Čislák', NULL, '2014-11-06', '2016-03-23'),
(288, 11, 9, 'Tomáš Malatinský', NULL, '2012-04-04', '2014-07-03'),
(289, 11, 9, 'Pavol Pavlis', 20, '2014-07-03', '2015-05-06'),
(290, 11, 9, 'Peter Kažimír', 20, '2015-05-06', '2015-06-16'),
(291, 11, 9, 'Vazil Hudák', NULL, '2015-06-16', '2016-03-23'),
(292, 11, 67, 'Ľubomír Jahnátek', 20, '2012-04-04', '2016-03-23'),
(293, 11, 45, 'Peter Žiga', 20, '2012-04-04', '2016-03-23'),
(294, 11, 66, 'Dušan Čaplovič', 20, '2012-04-04', '2014-07-03'),
(295, 11, 66, 'Peter Pellegrini', 20, '2014-07-03', '2014-11-25'),
(296, 11, 66, 'Juraj Draxler', NULL, '2014-11-25', '2016-03-23'),
(297, 11, 11, 'Marek Maďarič', 20, '2012-04-04', '2016-03-23'),
(298, 12, 60, 'Robert Fico', 20, '2016-03-23', '2018-03-22'),
(299, 12, 53, 'Peter Pellegrini', 20, '2016-03-23', '2018-03-22'),
(300, 12, 46, 'Robert Kaliňák', 20, '2016-03-23', '2018-03-22'),
(301, 12, 46, 'Lucia Žitňanská', 13, '2016-03-23', '2018-03-22'),
(302, 12, 34, 'Robert Kaliňák', 20, '2016-03-23', '2018-03-22'),
(303, 12, 33, 'Lucia Žitňanská', 13, '2016-03-23', '2018-03-22'),
(304, 12, 7, 'Peter Kažimír', 20, '2016-03-23', '2018-03-22'),
(305, 12, 42, 'Miroslav Lajčák', NULL, '2016-03-23', '2018-03-22'),
(306, 12, 9, 'Peter Žiga', 20, '2016-03-23', '2018-03-22'),
(307, 12, 6, 'Roman Brecely', 1, '2016-03-23', '2016-08-31'),
(308, 12, 6, 'Árpád Érsek', 13, '2016-08-31', '2018-03-22'),
(309, 12, 67, 'Gabriela Matečná', NULL, '2016-03-23', '2018-03-22'),
(310, 12, 16, 'Peter Gajdoš', NULL, '2016-03-23', '2018-03-22'),
(311, 12, 23, 'Ján Richter', 20, '2016-03-23', '2018-03-22'),
(312, 12, 45, 'László Sólymos', 13, '2016-03-23', '2018-03-22'),
(313, 12, 66, 'Peter Plavčan', NULL, '2016-03-23', '2017-08-31'),
(314, 12, 66, 'Gabriela Matečná', NULL, '2017-08-31', '2017-09-13'),
(315, 12, 66, 'Martina Lubyová', NULL, '2017-09-13', '2018-03-22'),
(316, 12, 11, 'Marek Maďarič', 20, '2016-03-23', '2018-03-07'),
(317, 12, 11, 'Peter Pellegrini', 20, '2018-03-07', '2018-03-22'),
(318, 12, 43, 'Tomáš Drucker', NULL, '2016-03-23', '2018-03-22'),
(319, 13, 60, 'Peter Pellegrini', 20, '2018-03-22', NULL),
(320, 13, 46, 'Peter Kažimír', 20, '2018-03-22', '2019-04-11'),
(321, 13, 46, 'Ladislav Kamenický', 20, '2019-05-07', NULL),
(322, 13, 7, 'Peter Pellegrini', 20, '2019-04-11', '2019-05-07'),
(323, 13, 7, 'Peter Kažimír', 20, '2018-03-22', '2019-04-11'),
(324, 13, 7, 'Ladislav Kamenický', 20, '2019-05-07', NULL),
(325, 13, 46, 'Gabriela Matečná', 18, '2018-03-22', NULL),
(326, 13, 19, 'Gabriela Matečná', 18, '2018-03-22', NULL),
(327, 13, 46, 'László Sólymos', 13, '2018-03-22', '2020-01-28'),
(328, 13, 46, 'Árpád Érsek', 13, '2020-01-28', NULL),
(329, 13, 45, 'László Sólymos', 13, '2018-03-22', '2020-01-28'),
(330, 13, 45, 'Árpád Érsek', 13, '2020-01-28', NULL),
(331, 13, 53, 'Richard Raši', 20, '2018-03-22', NULL),
(332, 13, 42, 'Miroslav Lajčák', NULL, '2018-03-22', NULL),
(333, 13, 16, 'Peter Gajdoš', 18, '2018-03-22', NULL),
(334, 13, 34, 'Tomáš Drucker', NULL, '2018-03-22', '2018-04-17'),
(335, 13, 34, 'Peter Pellegrini', 20, '2018-04-17', '2018-04-26'),
(336, 13, 34, 'Denisa Saková', 20, '2018-04-26', NULL),
(337, 13, 9, 'Peter Žiga', 20, '2018-03-22', NULL),
(338, 13, 6, 'Árpád Érsek', 13, '2018-03-22', NULL),
(339, 13, 33, 'Gábor Gál', 13, '2018-03-22', NULL),
(340, 13, 23, 'Ján Richter', 20, '2018-03-22', NULL),
(341, 13, 66, 'Martina Lubyová', NULL, '2018-03-22', NULL),
(342, 13, 11, 'Ľubica Laššáková', 20, '2018-03-22', NULL),
(343, 13, 43, 'Andrea Kalavská', NULL, '2018-03-22', '2019-12-17'),
(344, 13, 43, 'Peter Pellegrini', 20, '2019-12-17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `strany`
--

CREATE TABLE `strany` (
  `id` int(11) NOT NULL,
  `nazov` varchar(150) COLLATE utf8_slovak_ci NOT NULL,
  `skratka` varchar(50) COLLATE utf8_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `strany`
--

INSERT INTO `strany` (`id`, `nazov`, `skratka`) VALUES
(1, '#SIEŤ', '#SIEŤ'),
(2, 'Aliancia nového občana', 'ANO'),
(3, 'Demokratická strana', 'DS'),
(4, 'Demokratická únia Slovenska', 'DÚ'),
(5, 'Hnutie za demokratické Slovensko a Roľnícka strana Slovenska', 'HZDS-RSS'),
(6, 'Komunistická strana Československa', 'KSČ'),
(7, 'Komunistická strana Slovenska', 'KSS'),
(8, 'Kotlebovci - Ľudová strana Naše Slovensko', 'ĽS Naše Slovensko'),
(9, 'Kresťanskodemokratické hnutie', 'KDH'),
(10, 'Ľudová strana - Hnutie za demokratické Slovensko', 'ĽS-HZDS'),
(11, 'Maďarská koalícia', 'MK'),
(12, 'Maďarské kresťanskodemokratické hnutie, Együttélés - Spolužitie', 'MKM - EGY'),
(13, 'MOST - HÍD', 'MOST-HÍD'),
(14, 'OBYČAJNÍ ĽUDIA a nezávislé osobnosti', 'OĽaNO'),
(15, 'Sloboda a Solidarita', 'SaS'),
(16, 'Slovenská demokratická a kresťanská únia - Demokratická strana', 'SDKÚ-DS'),
(17, 'Slovenská demokratická koalícia', 'SDK'),
(18, 'Slovenská národná strana', 'SNS'),
(19, 'SME RODINA - Boris Kollár', 'SME RODINA '),
(20, 'SMER - sociálna demokracia', 'SMER-SD'),
(21, 'Spoločná voľba', 'SV'),
(22, 'Strana demokratickej ľavice', 'SDĽ'),
(23, 'Strana maďarskej komunity - Magyar Közösség Pártja', 'SMK-MKP'),
(24, 'Strana občianskeho porozumenia', 'SOP'),
(25, 'Strana zelených', 'SZ'),
(26, 'Verejenosť proti násiliu', 'VPN'),
(27, 'Združenie robotníkov Slovenska', 'ZRS'),
(28, ' Nová agrárna strana', 'NAS'),
(29, 'Národno-demokratická strana', 'NDS'),
(30, 'Za ľudí', 'Za ľudí');

-- --------------------------------------------------------

--
-- Table structure for table `utvary`
--

CREATE TABLE `utvary` (
  `id` int(11) NOT NULL,
  `nazov` varchar(150) COLLATE utf8_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `utvary`
--

INSERT INTO `utvary` (`id`, `nazov`) VALUES
(1, 'Minister bez kresla'),
(2, 'Ministerstvo dopravy'),
(3, 'Ministerstvo dopravy a spojov'),
(4, 'Ministerstvo dopravy, pôšt a telekomunikácií'),
(5, 'Ministerstvo dopravy, spojov a verejných prác'),
(6, 'Ministerstvo dopravy, výstavby a regionálneho rozvoja'),
(7, 'Ministerstvo financií'),
(8, 'Ministerstvo financií, cien a miezd'),
(9, 'Ministerstvo hospodárstva'),
(10, 'Ministerstvo kontroly'),
(11, 'Ministerstvo kultúry'),
(12, 'Ministerstvo lesného a vodného hospodárstva'),
(13, 'Ministerstvo lesného a vodného hospodárstva a drevospracujúceho priemyslu'),
(14, 'Ministerstvo medzinárodných vzťahov'),
(15, 'Ministerstvo obchodu a cestovného ruchu'),
(16, 'Ministerstvo obrany'),
(17, 'Ministerstvo plánovania'),
(18, 'Ministerstvo pôdohospodárstva'),
(19, 'Ministerstvo pôdohospodárstva a rozvoja vidieka'),
(20, 'Ministerstvo poľnohospodárstva a výživy'),
(21, 'Ministerstvo práce'),
(22, 'Ministerstvo práce a sociálnych vecí'),
(23, 'Ministerstvo práce, sociálnych vecí a rodiny'),
(24, 'Ministerstvo pre hospodársku stratégiu'),
(25, 'Ministerstvo pre správu a privatizáciu národného majetku'),
(26, 'Ministerstvo priemyslu'),
(27, 'Ministerstvo školstva'),
(28, 'Ministerstvo školstva a vedy'),
(29, 'Ministerstvo školstva, mládeže a športu'),
(30, 'Ministerstvo školstva, mládeže a telesnej výchovy'),
(31, 'Ministerstvo školstva, vedy, mládeže a športu'),
(32, 'Ministerstvo sociálnych vecí'),
(33, 'Ministerstvo spravodlivosti'),
(34, 'Ministerstvo vnútra'),
(35, 'Ministerstvo vnútra a životného prostredia'),
(36, 'Ministerstvo výstavby'),
(37, 'Ministerstvo výstavby a regionálneho rozvoja'),
(38, 'Ministerstvo výstavby a stavebníctva'),
(39, 'Ministerstvo výstavby a verejných prác'),
(40, 'Ministerstvo zahraničia'),
(41, 'Ministerstvo zahraničných vecí'),
(42, 'Ministerstvo zahraničných vecí a európskych záležitostí'),
(43, 'Ministerstvo zdravotníctva'),
(44, 'Ministerstvo zdravotníctva a sociálnych vecí'),
(45, 'Ministerstvo životného prostredia'),
(46, 'Podpredseda vlády'),
(47, 'Podpredseda vlády pre ekonomickú integráciu '),
(48, 'Podpredseda vlády pre ekonomiku'),
(49, 'Podpredseda vlády pre európske záležitosti, ľudské práva a menšiny'),
(50, 'Podpredseda vlády pre európsku integráciu'),
(51, 'Podpredseda vlády pre hospodárstvo'),
(52, 'Podpredseda vlády pre investície'),
(53, 'Podpredseda vlády pre investície a informatizáciu'),
(54, 'Podpredseda vlády pre legistalitvu'),
(55, 'Podpredseda vlády pre ľudské a menšinové práva a regionálny rozvoj'),
(56, 'Podpredseda vlády pre ľudské práva a menšiny'),
(57, 'Podpredseda vlády pre neekonomické rezorty'),
(58, 'Podpredseda vlády pre sociálny a duchovný rozvoj '),
(59, 'Podpredseda vlády pre vedomostnú spoločnosť, európske záležitosti, ľudské práva a menšiny'),
(60, 'Predseda vlády'),
(61, 'Prvý podpredseda vlády'),
(62, 'Slovenská komisia pre plánovanie a vedecko-technický rozvoj'),
(63, 'Slovenská komisia pre životné prostredie'),
(64, 'Úrad pre privatizáciu a správu národného majetku'),
(65, 'Výbor ľudovej kontroly'),
(66, 'Ministerstvo školstva, vedy, výskumu a športu'),
(67, 'Ministerstvo poľnohospodárstva a rozvoja vidieka'),
(68, 'Ministerstvo poľnohospodárstva');

-- --------------------------------------------------------

--
-- Table structure for table `vlady`
--

CREATE TABLE `vlady` (
  `id` int(11) NOT NULL,
  `id_volby` int(11) NOT NULL,
  `datumOD` date NOT NULL,
  `datumDO` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `vlady`
--

INSERT INTO `vlady` (`id`, `id_volby`, `datumOD`, `datumDO`) VALUES
(1, 1, '1989-12-12', '1990-06-26'),
(2, 1, '1990-06-27', '1991-04-22'),
(3, 1, '1991-04-23', '1992-06-24'),
(4, 2, '1992-06-24', '1994-03-15'),
(5, 2, '1994-03-15', '1994-12-13'),
(6, 3, '1994-12-13', '1998-10-30'),
(7, 4, '1998-10-30', '2002-10-15'),
(8, 5, '2002-10-16', '2006-07-04'),
(9, 6, '2006-07-04', '2010-07-08'),
(10, 7, '2010-07-08', '2012-04-04'),
(11, 8, '2012-04-04', '2016-03-23'),
(12, 9, '2016-03-23', '2018-03-22'),
(13, 9, '2018-03-22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `volby`
--

CREATE TABLE `volby` (
  `id` int(11) NOT NULL,
  `den1` date DEFAULT NULL,
  `den2` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `volby`
--

INSERT INTO `volby` (`id`, `den1`, `den2`) VALUES
(1, '1990-06-08', '1990-06-09'),
(2, '1992-06-05', '1992-06-06'),
(3, '1994-09-30', '1994-10-01'),
(4, '1998-09-25', '1998-09-26'),
(5, '2002-09-20', '2002-09-21'),
(6, '2006-06-17', NULL),
(7, '2010-06-12', NULL),
(8, '2012-03-10', NULL),
(9, '2016-03-05', NULL),
(10, '2020-02-29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vysledky`
--

CREATE TABLE `vysledky` (
  `id` int(11) NOT NULL,
  `id_volby` int(11) NOT NULL,
  `id_strany` int(11) NOT NULL,
  `kresla` int(11) NOT NULL,
  `koalicia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `vysledky`
--

INSERT INTO `vysledky` (`id`, `id_volby`, `id_strany`, `kresla`, `koalicia`) VALUES
(1, 1, 26, 48, 1),
(2, 1, 9, 31, 1),
(3, 1, 18, 22, 0),
(4, 1, 6, 22, 0),
(5, 1, 12, 14, 1),
(6, 1, 4, 7, 1),
(7, 1, 25, 6, 0),
(8, 2, 10, 74, 1),
(9, 2, 22, 29, 0),
(10, 2, 9, 18, 0),
(11, 2, 18, 15, 1),
(12, 2, 12, 14, 0),
(13, 3, 5, 61, 1),
(14, 3, 21, 18, 0),
(15, 3, 11, 17, 0),
(16, 3, 9, 17, 0),
(17, 3, 4, 15, 0),
(18, 3, 27, 13, 1),
(19, 3, 18, 9, 1),
(20, 4, 10, 43, 0),
(21, 4, 17, 42, 1),
(22, 4, 22, 23, 1),
(23, 4, 23, 15, 1),
(24, 4, 18, 14, 0),
(25, 4, 24, 13, 1),
(26, 5, 10, 36, 0),
(27, 5, 16, 28, 1),
(28, 5, 20, 25, 0),
(29, 5, 23, 20, 1),
(30, 5, 9, 15, 1),
(31, 5, 2, 15, 1),
(32, 5, 7, 11, 0),
(33, 6, 20, 50, 1),
(34, 6, 16, 31, 0),
(35, 6, 18, 20, 1),
(36, 6, 23, 20, 0),
(37, 6, 10, 15, 1),
(38, 6, 9, 14, 0),
(39, 7, 20, 62, 0),
(40, 7, 16, 28, 1),
(41, 7, 15, 22, 1),
(42, 7, 9, 15, 1),
(43, 7, 13, 14, 1),
(44, 7, 18, 9, 0),
(45, 8, 20, 83, 1),
(46, 8, 9, 16, 0),
(47, 8, 14, 16, 0),
(48, 8, 13, 13, 0),
(49, 8, 16, 11, 0),
(50, 8, 15, 11, 0),
(51, 9, 20, 49, 1),
(52, 9, 15, 21, 0),
(53, 9, 14, 19, 0),
(54, 9, 18, 15, 1),
(55, 9, 8, 14, 0),
(56, 9, 19, 11, 0),
(57, 9, 13, 11, 1),
(58, 9, 1, 10, 1),
(59, 10, 14, 53, 0),
(60, 10, 20, 38, 0),
(61, 10, 19, 17, 0),
(62, 10, 8, 17, 0),
(63, 10, 15, 13, 0),
(64, 10, 30, 12, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `osoby`
--
ALTER TABLE `osoby`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `strany`
--
ALTER TABLE `strany`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `utvary`
--
ALTER TABLE `utvary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `vlady`
--
ALTER TABLE `vlady`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `volby`
--
ALTER TABLE `volby`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `vysledky`
--
ALTER TABLE `vysledky`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `osoby`
--
ALTER TABLE `osoby`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=350;
--
-- AUTO_INCREMENT for table `strany`
--
ALTER TABLE `strany`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `utvary`
--
ALTER TABLE `utvary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `vlady`
--
ALTER TABLE `vlady`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `volby`
--
ALTER TABLE `volby`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `vysledky`
--
ALTER TABLE `vysledky`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
