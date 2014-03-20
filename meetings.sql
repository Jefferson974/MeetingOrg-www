-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 20, 2014 at 10:23 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE IF NOT EXISTS `meetings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `startDate` date NOT NULL,
  `finishDate` date NOT NULL,
  `startTime` time NOT NULL,
  `stopTime` time NOT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `organizer_id` int(11) NOT NULL,
  `duration` time NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `title`, `startDate`, `finishDate`, `startTime`, `stopTime`, `place`, `organizer_id`, `duration`, `description`) VALUES
(1, 'isdjfsdjif', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 'PAris', 0, '00:00:20', 'Te faire chier'),
(2, 'Dentiste', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 'Wheatley', 0, '00:00:30', 'Une carrie a retirer'),
(3, 'Dentiste', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 'Wheatley', 0, '00:00:30', 'Une carrie a retirer'),
(4, 'Dentiste', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 'Wheatley', 0, '00:00:30', 'Une carrie a retirer'),
(6, 'Dentiste', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 'Wheatley', 0, '00:00:30', 'Une carrie a retirer'),
(7, 'Dentiste', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 'Wheatley', 0, '00:00:30', 'Une carrie a retirer'),
(8, 'Dentiste', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 'Wheatley', 0, '00:00:30', 'Une carrie a retirer'),
(9, 'Dentiste', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 'Wheatley', 0, '00:00:30', 'Une carrie a retirer');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
