-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 12, 2015 at 12:13 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Saturn`
--

-- --------------------------------------------------------

--
-- Table structure for table `Country`
--

CREATE TABLE IF NOT EXISTS `Country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Country`
--

INSERT INTO `Country` (`id`, `name`) VALUES
(1, 'Egypt'),
(2, 'Brazil'),
(3, 'China'),
(4, 'Italy'),
(5, 'Mexico');

-- --------------------------------------------------------

--
-- Table structure for table `Crop`
--

CREATE TABLE IF NOT EXISTS `Crop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_bin NOT NULL,
  `soil_type` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT 'Loamy',
  `soil_ph` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT 'Acidic',
  `priority` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

--
-- Dumping data for table `Crop`
--

INSERT INTO `Crop` (`id`, `name`, `soil_type`, `soil_ph`, `priority`) VALUES
(1, 'Wheat', 'Loamy', 'Acidic', 1),
(2, 'Corn', 'Loamy', 'Neutral', 1),
(3, 'Potatoes', 'Sandy', 'Acidic', 1),
(4, 'Rice', 'Clay', 'Neutral', 1),
(5, 'Tomato', 'Loamy', 'Acidic', 2),
(6, 'Apple', 'Loamy', 'Neutral', 2),
(7, 'Onion', 'Loamy', 'Neutral', 2),
(8, 'Tobacco', 'Sandy', 'Acidic', 3),
(9, 'Tea', 'Loamy', 'Acidic', 3),
(10, 'Cocoa', 'Sandy', 'Acidic', 3);

-- --------------------------------------------------------

--
-- Table structure for table `Eliminiation`
--

CREATE TABLE IF NOT EXISTS `Eliminiation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `new_crop_id` int(11) NOT NULL,
  `old_crop_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Exchange`
--

CREATE TABLE IF NOT EXISTS `Exchange` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `crop_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Production`
--

CREATE TABLE IF NOT EXISTS `Production` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `crop_id` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `Production`
--

INSERT INTO `Production` (`id`, `country_id`, `crop_id`, `value`) VALUES
(1, 2, 1, 5738473),
(2, 2, 4, 11782549),
(3, 2, 2, 80273172),
(4, 2, 3, 3553772),
(5, 2, 5, 4187646),
(6, 2, 7, 1538929),
(7, 2, 6, 1231472),
(8, 2, 10, 256186),
(9, 2, 9, 1000763),
(10, 2, 8, 850673),
(11, 1, 1, 9460200),
(12, 1, 4, 6100000),
(13, 1, 2, 5800000),
(14, 1, 3, 4800000),
(15, 1, 5, 8533803),
(16, 1, 7, 1903000),
(17, 1, 6, 546164),
(18, 4, 1, 7277492),
(19, 4, 4, 1339000),
(20, 4, 2, 7899617),
(21, 4, 3, 1337481),
(22, 4, 5, 4932463),
(23, 4, 7, 351031),
(24, 4, 6, 2216963),
(25, 4, 8, 1049770),
(26, 5, 1, 3357307),
(27, 5, 4, 179776),
(28, 5, 2, 22663953),
(29, 5, 3, 1629938),
(30, 5, 5, 3282583),
(31, 5, 7, 1270060),
(32, 5, 6, 858608),
(33, 5, 10, 82000),
(34, 5, 8, 15145),
(35, 3, 1, 121930527),
(36, 3, 4, 205206520),
(37, 3, 2, 218623645),
(38, 3, 3, 95987500),
(39, 3, 5, 50664255),
(40, 3, 7, 22345000),
(41, 3, 6, 39684118),
(42, 3, 9, 1939457),
(43, 3, 8, 3150197);

-- --------------------------------------------------------

--
-- Table structure for table `Replant`
--

CREATE TABLE IF NOT EXISTS `Replant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `new_crop_id` int(11) NOT NULL,
  `old_crop_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Sufficiency`
--

CREATE TABLE IF NOT EXISTS `Sufficiency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `crop_id` int(11) NOT NULL,
  `value` float NOT NULL,
  `current` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=59 ;

--
-- Dumping data for table `Sufficiency`
--

INSERT INTO `Sufficiency` (`id`, `country_id`, `crop_id`, `value`, `current`) VALUES
(1, 1, 1, 0.491177, 1),
(2, 1, 4, 0.984868, 1),
(3, 1, 2, 0.451437, 1),
(4, 1, 3, 0.970945, 1),
(5, 1, 5, 0.999375, 1),
(6, 1, 7, 0.999884, 1),
(7, 1, 6, 0.764269, 1),
(8, 2, 1, 0.499914, 1),
(9, 2, 4, 0.953038, 1),
(10, 2, 2, 0.99189, 1),
(11, 2, 3, 0.998512, 1),
(12, 2, 5, 0.999813, 1),
(13, 2, 7, 1, 1),
(14, 2, 6, 0.927287, 1),
(15, 2, 10, 0.887372, 1),
(16, 2, 9, 0.999302, 1),
(17, 2, 8, 0.987982, 1),
(18, 3, 1, 0.979025, 1),
(19, 3, 4, 0.994864, 1),
(20, 3, 2, 0.973592, 1),
(21, 3, 3, 0.999763, 1),
(22, 3, 5, 0.999813, 1),
(23, 3, 7, 0.997927, 1),
(24, 3, 6, 0.991231, 1),
(25, 3, 9, 0.971979, 1),
(26, 3, 8, 0.951816, 1),
(27, 4, 1, 0.498508, 1),
(28, 4, 4, 0.925646, 1),
(29, 4, 2, 0.745082, 1),
(30, 4, 3, 0.68806, 1),
(31, 4, 5, 0.974337, 1),
(32, 4, 7, 0.850189, 1),
(33, 4, 6, 0.983579, 1),
(34, 4, 8, 0.99267, 1),
(35, 5, 1, 0.453375, 1),
(36, 5, 4, 0.212349, 1),
(37, 5, 2, 0.705161, 1),
(38, 5, 3, 0.946735, 1),
(39, 5, 5, 0.992824, 1),
(40, 5, 7, 0.974039, 1),
(41, 5, 6, 0.812238, 1),
(42, 5, 10, 0.812509, 1),
(43, 5, 8, 0.38243, 1),
(44, 1, 1, 0.999718, 0),
(45, 1, 2, 0.999611, 0),
(46, 1, 3, 0.882769, 0),
(47, 2, 1, 0.7094, 0),
(48, 2, 2, 0.894308, 0),
(49, 2, 3, 0.999159, 0),
(50, 3, 1, 0.999674, 0),
(51, 3, 2, 0.999378, 0),
(52, 3, 3, 0.996088, 0),
(53, 4, 1, 0.927364, 0),
(54, 4, 2, 0.983456, 0),
(55, 4, 3, 0.902202, 0),
(56, 5, 1, 0.800652, 0),
(57, 5, 2, 0.995563, 0),
(58, 5, 3, 0.999067, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Trade`
--

CREATE TABLE IF NOT EXISTS `Trade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `type` int(1) NOT NULL,
  `crop_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=137 ;

--
-- Dumping data for table `Trade`
--

INSERT INTO `Trade` (`id`, `country_id`, `type`, `crop_id`, `amount`) VALUES
(1, 2, 1, 1, 5740453),
(2, 2, 1, 4, 580594),
(3, 2, 1, 2, 656336),
(4, 2, 1, 3, 5295),
(5, 2, 1, 5, 785),
(6, 2, 1, 7, 0),
(7, 2, 1, 6, 96565),
(8, 2, 1, 10, 32516),
(9, 2, 1, 9, 699),
(10, 2, 1, 8, 10348),
(11, 2, 0, 1, 2350720),
(12, 2, 0, 4, 1291598),
(13, 2, 0, 2, 9486914),
(14, 2, 0, 3, 2992),
(15, 2, 0, 5, 79),
(16, 2, 0, 7, 0),
(17, 2, 0, 6, 48666),
(18, 2, 0, 10, 724),
(19, 2, 0, 9, 1965),
(20, 2, 0, 8, 533579),
(21, 1, 1, 1, 9800061),
(22, 1, 1, 4, 93721),
(23, 1, 1, 2, 7047864),
(24, 1, 1, 3, 143638),
(25, 1, 1, 5, 5341),
(26, 1, 1, 7, 221),
(27, 1, 1, 6, 168459),
(28, 1, 1, 10, 2),
(29, 1, 1, 9, 100423),
(30, 1, 1, 8, 10334),
(31, 1, 0, 1, 2665),
(32, 1, 0, 4, 39972),
(33, 1, 0, 2, 2255),
(34, 1, 0, 3, 637434),
(35, 1, 0, 5, 62248),
(36, 1, 0, 7, 490922),
(37, 1, 0, 6, 388),
(38, 1, 0, 10, 8),
(39, 1, 0, 9, 4722),
(40, 1, 0, 8, 1801),
(41, 4, 1, 1, 7321062),
(42, 4, 1, 4, 107557),
(43, 4, 1, 2, 2702734),
(44, 4, 1, 3, 606362),
(45, 4, 1, 5, 129916),
(46, 4, 1, 7, 61855),
(47, 4, 1, 6, 37013),
(48, 4, 1, 10, 91870),
(49, 4, 1, 9, 6975),
(50, 4, 1, 8, 7752),
(51, 4, 0, 1, 570009),
(52, 4, 0, 4, 722136),
(53, 4, 0, 2, 132892),
(54, 4, 0, 3, 144982),
(55, 4, 0, 5, 105638),
(56, 4, 0, 7, 43292),
(57, 4, 0, 6, 976131),
(58, 4, 0, 10, 426),
(59, 4, 0, 9, 1297),
(60, 4, 0, 8, 61232),
(61, 5, 1, 1, 4047832),
(62, 5, 1, 4, 666830),
(63, 5, 1, 2, 9476171),
(64, 5, 1, 3, 91703),
(65, 5, 1, 5, 23726),
(66, 5, 1, 7, 33851),
(67, 5, 1, 6, 198481),
(68, 5, 1, 10, 18922),
(69, 5, 1, 9, 726),
(70, 5, 1, 8, 24457),
(71, 5, 0, 1, 835908),
(72, 5, 0, 4, 1843),
(73, 5, 0, 2, 101019),
(74, 5, 0, 3, 1522),
(75, 5, 0, 5, 1493316),
(76, 5, 0, 7, 370135),
(77, 5, 0, 6, 613),
(78, 5, 0, 10, 238),
(79, 5, 0, 9, 283),
(80, 5, 0, 8, 7018),
(81, 3, 1, 1, 2612288),
(82, 3, 1, 4, 1059294),
(83, 3, 1, 2, 5930095),
(84, 3, 1, 3, 22723),
(85, 3, 1, 5, 9489),
(86, 3, 1, 7, 46407),
(87, 3, 1, 6, 351071),
(88, 3, 1, 10, 38952),
(89, 3, 1, 9, 55912),
(90, 3, 1, 8, 159472),
(91, 3, 0, 1, 39808),
(92, 3, 0, 4, 501073),
(93, 3, 0, 2, 136123),
(94, 3, 0, 3, 376995),
(95, 3, 0, 5, 130273),
(96, 3, 0, 7, 745027),
(97, 3, 0, 6, 1107918),
(98, 3, 0, 10, 0),
(99, 3, 0, 9, 327650),
(100, 3, 0, 8, 225966),
(101, 1, 0, 1, 0),
(102, 1, 1, 1, 9797396),
(103, 1, 0, 2, 0),
(104, 1, 1, 2, 7045609),
(105, 1, 0, 3, 493796),
(106, 1, 1, 3, 0),
(107, 2, 0, 1, 0),
(108, 2, 1, 1, 3389733),
(109, 2, 0, 2, 8830578),
(110, 2, 1, 2, 0),
(111, 2, 0, 3, 0),
(112, 2, 1, 3, 2303),
(113, 3, 0, 1, 0),
(114, 3, 1, 1, 2572480),
(115, 3, 0, 2, 0),
(116, 3, 1, 2, 5793972),
(117, 3, 0, 3, 354272),
(118, 3, 1, 3, 0),
(119, 4, 0, 1, 0),
(120, 4, 1, 1, 6751053),
(121, 4, 0, 2, 0),
(122, 4, 1, 2, 2569842),
(123, 4, 0, 3, 0),
(124, 4, 1, 3, 461380),
(125, 5, 0, 1, 0),
(126, 5, 1, 1, 3211924),
(127, 5, 0, 2, 0),
(128, 5, 1, 2, 9375152),
(129, 5, 0, 3, 0),
(130, 5, 1, 3, 90181),
(131, 1, 0, 3, 143638),
(132, 1, 1, 3, 0),
(133, 2, 0, 2, 656336),
(134, 2, 1, 2, 0),
(135, 3, 0, 3, 22723),
(136, 3, 1, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) COLLATE utf8_bin NOT NULL,
  `email` varchar(200) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
