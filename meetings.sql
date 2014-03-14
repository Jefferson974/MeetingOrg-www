-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 13 Mars 2014 à 15:08
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `test`
--

-- --------------------------------------------------------

--
-- Structure de la table `meetings`
--

CREATE TABLE IF NOT EXISTS `meetings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `datemeeting` datetime NOT NULL,
  `place` varchar(255) NOT NULL,
  `organizer` text NOT NULL,
  `duration` time NOT NULL,
  `description` text NOT NULL,
  `attendees` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `meetings`
--

INSERT INTO `meetings` (`id`, `title`, `datemeeting`, `place`, `organizer`, `duration`, `description`, `attendees`) VALUES
(1, 'isdjfsdjif', '2014-03-12 00:00:00', 'PAris', 'Tamere', '00:00:20', 'Te faire chier', 'gfuhdfijosdijf@gmail.com'),
(2, 'Dentiste', '0000-00-00 00:00:00', 'Wheatley', 'JF ROCOCO', '00:00:30', 'Une carrie a retirer', 'a:4:{i:0;s:22:"13103897@brookes.ac.uk";i:1;s:14:"minu@gmaul.com";i:2;s:28:"testpurpose@purposegmail.com";i:3;s:28:"jeanfrancoisROCOCO@gmail.com";}'),
(3, 'Dentiste', '0000-00-00 00:00:00', 'Wheatley', 'JF ROCOCO', '00:00:30', 'Une carrie a retirer', 'Bonjour'),
(4, 'Dentiste', '0000-00-00 00:00:00', 'Wheatley', 'JF ROCOCO', '00:00:30', 'Une carrie a retirer', 'Jean francois himself'),
(6, 'Dentiste', '0000-00-00 00:00:00', 'Wheatley', 'JF ROCOCO', '00:00:30', 'Une carrie a retirer', 'a:4:{i:0;s:7:"Bonjour";i:1;s:5:"salut";i:2;s:5:"cava?";i:3;s:28:"jeanfrancoisROCOCO@gmail.com";}'),
(7, 'Dentiste', '0000-00-00 00:00:00', 'Wheatley', 'JF ROCOCO', '00:00:30', 'Une carrie a retirer', 'Jean francois himself'),
(8, 'Dentiste', '0000-00-00 00:00:00', 'Wheatley', 'JF ROCOCO', '00:00:30', 'Une carrie a retirer', 'Jean francois himself'),
(9, 'Dentiste', '0000-00-00 00:00:00', 'Wheatley', 'JF ROCOCO', '00:00:30', 'Une carrie a retirer', 'Jean francois himself');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
