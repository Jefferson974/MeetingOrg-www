-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 20, 2014 at 11:27 PM
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
-- Table structure for table `jnct_users_meetings`
--

CREATE TABLE IF NOT EXISTS `jnct_users_meetings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meeting_id` int(11) NOT NULL,
  `user_email` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `meetings_id` (`meeting_id`),
  KEY `users_email` (`user_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `jnct_users_meetings`
--

INSERT INTO `jnct_users_meetings` (`id`, `meeting_id`, `user_email`) VALUES
(1, 6, 'j-f.luciano@hotmail.com'),
(2, 1, 'j-f.luciano@hotmail.com'),
(7, 3, 'j-f.luciano@hotmail.com');

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL COMMENT 'auto incrementing user_id of each user, unique index',
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `user_active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s activation status',
  `user_activation_hash` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s email verification hash string',
  `user_password_reset_hash` char(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s password reset code',
  `user_password_reset_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the password reset request',
  `user_rememberme_token` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s remember-me cookie token',
  `user_failed_logins` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s failed login attemps',
  `user_last_failed_login` int(10) DEFAULT NULL COMMENT 'unix timestamp of last failed login attempt',
  `user_registration_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_registration_ip` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password_hash`, `user_email`, `user_active`, `user_activation_hash`, `user_password_reset_hash`, `user_password_reset_timestamp`, `user_rememberme_token`, `user_failed_logins`, `user_last_failed_login`, `user_registration_datetime`, `user_registration_ip`) VALUES
(0, 'Jeff', '$2y$10$Cl//XTlVqQNPo.iTJD2x3OAXBRtXz7V.VAmkB6hde2nbN3rrxR4VO', 'j-f.luciano@hotmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2014-03-20 19:18:58', '::1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jnct_users_meetings`
--
ALTER TABLE `jnct_users_meetings`
  ADD CONSTRAINT `Email_FK` FOREIGN KEY (`user_email`) REFERENCES `users` (`user_email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Meetings_FK` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
