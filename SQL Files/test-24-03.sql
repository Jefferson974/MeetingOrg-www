-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 24, 2014 at 07:24 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Dumping data for table `jnct_users_meetings`
--

INSERT INTO `jnct_users_meetings` (`id`, `meeting_id`, `user_email`, `invitation_awnser`) VALUES
(10, 10, 'dadad@dad.com', 0),
(11, 12, 'test@test.com', 0),
(12, 12, 'taest@test.com', 0),
(13, 12, 'test@test.com', 0),
(14, 12, 'taest@test.com', 0),
(15, 13, 'test@test.com', 0),
(16, 13, 'test@test.com', 0),
(17, 14, 'test@test.com', 0),
(18, 14, 'bebe@test.com', 0),
(19, 15, 'test@test.com', 0),
(20, 15, ' test@test.com', 0),
(21, 16, 'ddd@acc.ca', 0),
(22, 16, ' ddaw@hot.uk', 0),
(23, 16, 'adad@da.com', 0),
(24, 16, 'test@test.com', 0),
(25, 16, ' test@test.com', 0),
(26, 16, 'ddd@acc.ca', 0),
(27, 16, ' ddaw@hot.uk', 0),
(28, 16, 'adad@da.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE IF NOT EXISTS `meetings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `startDate` date NOT NULL,
  `finishDate` date NOT NULL,
  `startTime` time NOT NULL,
  `finishTime` time NOT NULL,
  `allDay` tinyint(1) NOT NULL DEFAULT '0',
  `place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `organizer_id` int(11) NOT NULL,
  `duration` time DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `repeatM` enum('None','Daily','Weekly','Monthly') COLLATE utf8_unicode_ci NOT NULL,
  `colorM` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `organizer_id` (`organizer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `title`, `startDate`, `finishDate`, `startTime`, `finishTime`, `allDay`, `place`, `organizer_id`, `duration`, `description`, `repeatM`, `colorM`) VALUES
(1, 'TestMeeting', '2014-03-25', '2014-03-26', '00:00:00', '01:00:00', 0, 'sdadad', 10, NULL, 'qqdqdqd', 'None', 'none'),
(10, 'test22', '2014-03-27', '2014-03-28', '23:00:00', '00:00:00', 0, 'lllllkk', 10, NULL, '', 'None', 'none'),
(11, 'Reunion', '2014-03-28', '2014-03-30', '01:01:00', '01:01:00', 0, 'hththth', 10, NULL, '', 'None', 'none'),
(12, 'Reunion', '2014-03-28', '2014-03-30', '01:01:00', '01:01:00', 0, 'hththth', 10, NULL, '', 'None', 'none'),
(13, 'test22', '2014-03-27', '2014-03-28', '23:00:00', '00:00:00', 0, 'lllllkk', 10, NULL, '', 'None', 'none'),
(14, 'Reunion', '2014-03-28', '2014-03-30', '01:01:00', '01:01:00', 0, 'hththth', 10, NULL, '', 'None', 'none'),
(15, 'Reunion', '2014-03-28', '2014-03-30', '01:01:00', '01:01:00', 0, 'hththth', 10, NULL, '', 'None', 'none'),
(16, 'Reunion', '2014-03-28', '2014-03-30', '01:01:00', '01:01:00', 0, 'hththth', 10, NULL, '', 'None', 'none'),
(17, 'test22', '2014-03-27', '2014-03-28', '23:00:00', '00:00:00', 0, 'lllllkk', 10, NULL, '', 'None', 'none');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data' AUTO_INCREMENT=14 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password_hash`, `user_email`, `user_active`, `user_activation_hash`, `user_password_reset_hash`, `user_password_reset_timestamp`, `user_rememberme_token`, `user_failed_logins`, `user_last_failed_login`, `user_registration_datetime`, `user_registration_ip`, `user_credential`) VALUES
(9, 'test1', '$2y$10$04IFmmPcp40V8j3YKOUNGuazBiiQZHl7CPuArzBdWTsyJANCISYyO', '231313131312@brookes.ac.uk', 0, '946bd7efa03e5c1a3d6387e05b3b5fe3b662d8e7', NULL, NULL, NULL, 0, NULL, '2014-03-22 20:09:19', '::1', 0),
(10, 'Jeff', '$2y$10$7HeTnLMUr.QST4S8ffX.feUb4NtOX0xqzkyzjFlrZvApBYVo.NGeS', '13012556@brookes.ac.uk', 1, NULL, NULL, NULL, NULL, 0, NULL, '2014-03-23 00:32:30', '::1', 1),
(11, 'test12', '$2y$10$txfX9MtoOcVTAU3w4OCrj.NE0whuJiHhLfueJ3In8XzWv5oy/UDci', '12123131@brookes.ac.uk', 0, '09008b37e4c6e44fa2e12728cf599dbd2d9d8676', NULL, NULL, NULL, 0, NULL, '2014-03-24 02:38:19', '::1', 0),
(12, 'eqeqeqeqe', '$2y$10$nybNZPIzwKBY.b6xRNIQ/OeEopX4pvGF5UzpY.592ji8SVjgwfMbi', '2222222213@brookes.ac.uk', 0, '64a585b6ede90ff91b60182305ded1d59c8876f3', NULL, NULL, NULL, 0, NULL, '2014-03-24 02:40:50', '::1', 0),
(13, 'rrrrrrrrrrrrrr', '$2y$10$wwwU23CFduEAsEy.Px6V1.Aam4mgyyky1xXeJ8vGoy33ihDHUglsC', '3333333333333@brookes.ac.uk', 0, 'd52e6632209eb582533114ee8d9cd49e3a0b029e', NULL, NULL, NULL, 0, NULL, '2014-03-24 02:42:00', '::1', 0);

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
  ADD CONSTRAINT `UserID_FK` FOREIGN KEY (`organizer_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
