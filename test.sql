-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 21, 2014 at 10:28 PM
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
  `allDay` tinyint(1) NOT NULL DEFAULT '0',
  `place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `organizer_id` int(11) NOT NULL,
  `duration` time NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `repeat` enum('None','Daily','Weekly','Monthly') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `title`, `startDate`, `finishDate`, `startTime`, `stopTime`, `allDay`, `place`, `organizer_id`, `duration`, `description`, `repeat`) VALUES
(1, 'isdjfsdjif', '0000-00-00', '2014-03-05', '00:00:00', '00:00:00', 0, 'PAris', 0, '00:00:20', 'Te faire chier', 'None'),
(2, 'Dentiste', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 0, 'Wheatley', 0, '00:00:30', 'Une carrie a retirer', 'None'),
(3, 'Dentiste', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 0, 'Wheatley', 0, '00:00:30', 'Une carrie a retirer', 'None'),
(4, 'Dentiste', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 0, 'Wheatley', 0, '00:00:30', 'Une carrie a retirer', 'None'),
(6, 'Dentiste', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 0, 'Wheatley', 0, '00:00:30', 'Une carrie a retirer', 'None'),
(7, 'Dentiste', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 0, 'Wheatley', 0, '00:00:30', 'Une carrie a retirer', 'None'),
(8, 'Dentiste', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 0, 'Wheatley', 0, '00:00:30', 'Une carrie a retirer', 'None'),
(9, 'Dentiste', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 0, 'Wheatley', 0, '00:00:30', 'Une carrie a retirer', 'None');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data' AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password_hash`, `user_email`, `user_active`, `user_activation_hash`, `user_password_reset_hash`, `user_password_reset_timestamp`, `user_rememberme_token`, `user_failed_logins`, `user_last_failed_login`, `user_registration_datetime`, `user_registration_ip`, `user_credential`) VALUES
(1, 'gggege', '$2y$10$skOjFvYq4pBljNhIPp7CuOw43iCMFMhLxvr0Y/NRZb5ix3K2CKD/6', 'fegeasgga@adaddad.mu', 0, 'bf927afb9c996b5c922a65467477680756507ecc', NULL, NULL, NULL, 0, NULL, '2014-03-21 22:09:26', '::1', 0),
(2, 'testsss', '$2y$10$ZkUN6qOuOiR6eyvs20r6Y.fiSsW06QJhcFZBGE7EQVUtDGJ0rEU66', 'qweqe@dqdq.cor', 0, 'a9ce61f1c3782df064a8fa2063a9c8a22c570e1e', NULL, NULL, NULL, 0, NULL, '2014-03-21 22:10:33', '::1', 0),
(3, 'teadad', '$2y$10$dVz4C1pHcCMn7kdvZRoo8uWNS3U0.hweVIzD8D5.yGm.zvvMyajmm', '1231@brookes.ac.uk', 0, '04bf08abfa461ebff09da5c10ef5487d2bd48a78', NULL, NULL, NULL, 0, NULL, '2014-03-21 22:12:46', '::1', 0),
(4, 'qweqxqxqx', '$2y$10$D9ijtm.s76kJKqzZofmOp.vgQq2ZQhrqMoxBGQL5iTKXHUUuRPJPO', '121121@brookes.ac.uk', 0, '78459a280c032b00e7c13aec24c9bb853c5d93c7', NULL, NULL, NULL, 0, NULL, '2014-03-21 22:14:44', '::1', 0),
(5, 'dqdqddqqd', '$2y$10$hKXCzf5LuSGN.JycT4ODIO7RnNQHkPtpkufUWhXQRJXFUSW7a70sK', '2222222213@brookes.ac.uk', 0, '2c3e441e68f6ad85245b65f814d31cd5b6c3cf9d', NULL, NULL, NULL, 0, NULL, '2014-03-21 22:18:13', '::1', 0),
(6, 'qrqrqrqrq', '$2y$10$vMPF5e7JQY..D8TZccJOB.asef.GPySd8s48QtM1RdHJy4Rp2ucHC', '5555555555555@brookes.ac.uk', 0, '2b8cab5138b1a7f3193ba90e1937508f66c1379a', NULL, NULL, NULL, 0, NULL, '2014-03-21 22:21:33', '::1', 1),
(7, 'qrqrqrqrqww', '$2y$10$uWShWM0Ci/PogR150fFUfugumn05pdZ2Q.zH1lmDNcUL9Ftnwioli', 'p5555555555555@brookes.ac.uk', 0, '5af34c849072339bb98c063a7e724c4cc1782c8b', NULL, NULL, NULL, 0, NULL, '2014-03-21 22:22:31', '::1', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
