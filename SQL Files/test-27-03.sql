-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 27, 2014 at 01:12 PM
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
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `invitation_awnser` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `meetings_id` (`meeting_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=112 ;

--
-- Dumping data for table `jnct_users_meetings`
--

INSERT INTO `jnct_users_meetings` (`id`, `meeting_id`, `user_email`, `invitation_awnser`) VALUES
(90, 114, '0000000@brookes.ac.uk', 0),
(91, 114, 'p3333333333333@brookes.ac.uk', 0),
(92, 115, '0000000@brookes.ac.uk', 0),
(93, 115, 'p11111111111@brookes.ac.uk', 0),
(94, 116, '0000000@brookes.ac.uk', 0),
(95, 116, 'p11111111111@brookes.ac.uk', 0),
(96, 117, '0000000@brookes.ac.uk', 0),
(97, 117, 'p11111111111@brookes.ac.uk', 0),
(98, 118, '0000000@brookes.ac.uk', 0),
(99, 118, 'p11111111111@brookes.ac.uk', 0),
(100, 119, '0000000@brookes.ac.uk', 0),
(101, 119, 'p11111111111@brookes.ac.uk', 0),
(102, 120, '0000000@brookes.ac.uk', 0),
(103, 120, 'p44444444@brookes.ac.uk', 0),
(104, 121, '0000000@brookes.ac.uk', 0),
(105, 121, 'p44444444@brookes.ac.uk', 0),
(106, 122, '0000000@brookes.ac.uk', 0),
(107, 122, 'p44444444@brookes.ac.uk', 0),
(108, 123, '0000000@brookes.ac.uk', 0),
(109, 123, 'p44444444@brookes.ac.uk', 0),
(110, 124, '0000000@brookes.ac.uk', 0),
(111, 124, 'p44444444@brookes.ac.uk', 0);

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE IF NOT EXISTS `meetings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `startDate` date NOT NULL,
  `finishDate` datetime DEFAULT NULL,
  `startTime` time DEFAULT NULL,
  `allDay` tinyint(1) DEFAULT NULL,
  `place` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `organizerId` int(11) NOT NULL,
  `duration` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `repeatM` enum('None','Daily','Weekly','Monthly') COLLATE utf8_unicode_ci NOT NULL,
  `colorM` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `organizer_id` (`organizerId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=125 ;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `title`, `startDate`, `finishDate`, `startTime`, `allDay`, `place`, `organizerId`, `duration`, `description`, `repeatM`, `colorM`) VALUES
(114, 'MeetingRaph', '2014-03-27', '2014-03-27 21:00:00', '17:00:00', NULL, 'Clive', 18, '4', 'wwwwwwwwwww      ', 'None', '00FF00'),
(115, 'Software Production', '2014-03-26', '2014-03-26 17:00:00', '13:00:00', NULL, 'Wheatley - EL17', 17, '4', '      wwwwwwwwwww', 'Weekly', '00FF00'),
(116, 'Software Production', '2014-04-02', '2014-04-02 17:00:00', '13:00:00', NULL, 'Wheatley - EL17', 17, '4', '      wwwwwwwwwww', 'Weekly', '00FF00'),
(117, 'Software Production', '2014-04-09', '2014-04-09 17:00:00', '13:00:00', NULL, 'Wheatley - EL17', 17, '4', '      wwwwwwwwwww', 'Weekly', '00FF00'),
(118, 'Software Production', '2014-04-16', '2014-04-16 17:00:00', '13:00:00', NULL, 'Wheatley - EL17', 17, '4', '      wwwwwwwwwww', 'Weekly', '00FF00'),
(119, 'Software Production', '2014-04-23', '2014-04-23 17:00:00', '13:00:00', NULL, 'Wheatley - EL17', 17, '4', '      wwwwwwwwwww', 'Weekly', '00FF00'),
(120, 'MinuMeeting', '2014-03-28', '2014-03-28 12:00:00', '11:00:00', NULL, 'wheatley - T2-21', 16, '1', '      ddddddddd', 'Weekly', 'FFFF00'),
(121, 'MinuMeeting', '2014-04-04', '2014-04-04 12:00:00', '11:00:00', NULL, 'wheatley - T2-21', 16, '1', '      ddddddddd', 'Weekly', 'FFFF00'),
(122, 'MinuMeeting', '2014-04-11', '2014-04-11 12:00:00', '11:00:00', NULL, 'wheatley - T2-21', 16, '1', '      ddddddddd', 'Weekly', 'FFFF00'),
(123, 'MinuMeeting', '2014-04-18', '2014-04-18 12:00:00', '11:00:00', NULL, 'wheatley - T2-21', 16, '1', '      ddddddddd', 'Weekly', 'FFFF00'),
(124, 'MinuMeeting', '2014-04-25', '2014-04-25 12:00:00', '11:00:00', NULL, 'wheatley - T2-21', 16, '1', '      ddddddddd', 'Weekly', 'FFFF00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
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
  `user_credential` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data' AUTO_INCREMENT=20 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password_hash`, `user_email`, `user_active`, `user_activation_hash`, `user_password_reset_hash`, `user_password_reset_timestamp`, `user_rememberme_token`, `user_failed_logins`, `user_last_failed_login`, `user_registration_datetime`, `user_registration_ip`, `user_credential`) VALUES
(15, 'Yannis', '$2y$10$rdA90M0ZUGBHRrNxxtrCdefQ37woD3.SGIpQcr2t5/SWWTKDqL/Ba', 'p11111111111@brookes.ac.uk', 1, 'a3ea33735fe18f893c4c3114ff73866a019c66bf', NULL, NULL, NULL, 0, NULL, '2014-03-27 11:50:41', '::1', 1),
(16, 'Minu', '$2y$10$tzPp7tPKaxY8D58fGDfiD.Czjw7uhb0Ea8.o3mjU3Jx2z7Rkg.eVa', 'p2222222@brookes.ac.uk', 1, '2fa9c29656f147b62e416f43afb99bc493c66322', NULL, NULL, NULL, 0, NULL, '2014-03-27 11:51:16', '::1', 1),
(17, 'Jeff', '$2y$10$yXjTlNnSzvXBqLDYAwCNTOoHaJeqZVkC0yR4tvWMnlr5KvgKCIG.m', 'p3333333333333@brookes.ac.uk', 1, '35cb90fe3032890f9ff6c2409dd9dd281b06b8bc', NULL, NULL, NULL, 0, NULL, '2014-03-27 11:53:26', '::1', 1),
(18, 'Raph', '$2y$10$3F65C2Ix5/imVBf6m.9DJ.H.IppUtn81gvHOfWCjG3GjGavlfNvOS', 'p44444444@brookes.ac.uk', 1, 'd0368d3cf83a46e619ffad45f073d7525d569c1a', NULL, NULL, NULL, 0, NULL, '2014-03-27 11:54:59', '::1', 1),
(19, 'test', '$2y$10$nzelitK4vJJ3v2IVtNKHI.Rr/4AepCxz7/Dj1sFzNf0d.ZI58/Xy6', '0000000@brookes.ac.uk', 1, '571fec06faf6036415698dc2e9fc244cc4ced4cc', NULL, NULL, NULL, 0, NULL, '2014-03-27 11:56:01', '::1', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jnct_users_meetings`
--
ALTER TABLE `jnct_users_meetings`
  ADD CONSTRAINT `Meeting_FK` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meetings`
--
ALTER TABLE `meetings`
  ADD CONSTRAINT `UserID_FK` FOREIGN KEY (`organizerId`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
