-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 12 Janvier 2015 à 16:57
-- Version du serveur: 5.5.28
-- Version de PHP: 5.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `citybook`
--
CREATE DATABASE IF NOT EXISTS `citybook` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `citybook`;

-- --------------------------------------------------------

--
-- Structure de la table `_bookmarks`
--

DROP TABLE IF EXISTS `_bookmarks`;
CREATE TABLE IF NOT EXISTS `_bookmarks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idItem` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enable` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `_categories`
--

DROP TABLE IF EXISTS `_categories`;
CREATE TABLE IF NOT EXISTS `_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `color` varchar(8) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enable` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `_categories`
--

INSERT INTO `_categories` (`id`, `parent`, `name`, `color`, `icon`, `created`, `enable`) VALUES
(1, 0, '_LNG_ADD_REF_', '#000000', '', '2014-10-20 13:25:19', 1),
(2, 1, '_LNG_ADD_REF_BAR_', '#636393', 'bar.png', '2014-10-20 13:25:19', 1),
(3, 1, '_LNG_ADD_REF_DISCO_', '#B5222D', 'disco.png', '2014-10-20 13:27:56', 1),
(4, 1, '_LNG_ADD_REF_RESTAURANT_', '#D4953C', 'restaurant.png', '2014-10-20 13:27:56', 1),
(5, 1, '_LNG_ADD_REF_MUSEUM_', '#609491', 'museum.png', '2014-10-20 13:28:53', 1),
(6, 1, '_LNG_ADD_REF_OTHER_', '#87A248', 'other.png', '2014-10-20 13:28:53', 1),
(7, 0, '_LNG_ADD_NOTE_', '#000000', '', '2014-10-20 13:29:38', 1),
(8, 7, '_LNG_ADD_NOTE_PUBLIC_', '#e6dd31', 'note.png', '2014-10-20 13:30:42', 1),
(9, 7, '_LNG_ADD_NOTE_PRIVATE_', '#fa8932', 'note2.png', '2014-10-20 13:30:42', 1),
(10, 0, '_LNG_ADD_EVENT_', '#000000', '', '2014-10-20 13:31:52', 1),
(11, 10, '_LNG_ADD_EVENT_EPHEMERE_', '#FF0000', 'event.png', '2014-10-20 13:31:52', 1);

-- --------------------------------------------------------

--
-- Structure de la table `_comments`
--

DROP TABLE IF EXISTS `_comments`;
CREATE TABLE IF NOT EXISTS `_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `idItem` int(11) NOT NULL,
  `comment` varchar(1024) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enable` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `_items`
--

DROP TABLE IF EXISTS `_items`;
CREATE TABLE IF NOT EXISTS `_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `idCategorie` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `comment` longtext NOT NULL,
  `latitude` varchar(200) NOT NULL,
  `longitude` varchar(200) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enable` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `_items`
--

INSERT INTO `_items` (`id`, `idUser`, `idCategorie`, `title`, `comment`, `latitude`, `longitude`, `created`, `enable`) VALUES
(1, 1, 2, 'New Team', 'Encore une victoire de canard !', '48.9259803', '2.1857479999999896', '2014-10-20 15:21:44', 1),
(2, 1, 3, 'Mon nouveau test', 'Encore un commentaire de canard !', '48.889958', '2.219405', '2014-10-20 15:25:33', 1),
(3, 1, 4, 'Mon restaurant', 'Encore que ca marche moyen !', '48.892323', '2.2153309999999522', '2014-10-21 10:42:50', 1),
(4, 1, 4, 'qsdf', 'xcvc', '48.892423', '2.215331', '2014-11-24 15:16:16', 1),
(5, 1, 8, 'poup', 'poulpe', '48.892423', '2.215331', '2014-11-24 15:16:35', 1),
(6, 1, 2, '123', '123456', '48.892423', '2.215331', '2014-12-26 14:17:06', 1),
(7, 1, 2, '12356', '789456', '48.892423', '2.215331', '2014-12-26 14:17:35', 1),
(8, 1, 3, 'fdgfd', 'gfd', '48.892423', '2.215331', '2014-12-26 14:18:32', 1),
(9, 1, 6, 'fdg', 'fdg', '48.892423', '2.215331', '2014-12-26 14:19:21', 1),
(10, 1, 3, 'kjlkjl', 'kjkjlkjl', '48.892423', '2.215331', '2014-12-26 14:20:08', 1),
(11, 1, 11, 'jlklkjl', 'kjlkj', '48.892423', '2.215331', '2014-12-26 14:22:03', 1),
(12, 1, 2, 'hkjl', 'lkjhl', '48.892423', '2.215331', '2014-12-26 14:27:59', 1),
(13, 1, 6, 'fsdf', 'fdsdsf', '48.892423', '2.215331', '2014-12-26 14:29:36', 1),
(14, 1, 2, 'yttrrr', 'yytj', '48.892423', '2.215331', '2014-12-26 14:58:26', 1);

-- --------------------------------------------------------

--
-- Structure de la table `_links`
--

DROP TABLE IF EXISTS `_links`;
CREATE TABLE IF NOT EXISTS `_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `idItem` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `comment` longtext NOT NULL,
  `favorite` tinyint(1) NOT NULL,
  `note` enum('0','1','2','3','4','5') NOT NULL,
  `lCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lEnable` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `_medias`
--

DROP TABLE IF EXISTS `_medias`;
CREATE TABLE IF NOT EXISTS `_medias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `idItem` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enable` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `_notes`
--

DROP TABLE IF EXISTS `_notes`;
CREATE TABLE IF NOT EXISTS `_notes` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idItem` int(11) NOT NULL,
  `note` tinyint(5) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enable` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `_users`
--

DROP TABLE IF EXISTS `_users`;
CREATE TABLE IF NOT EXISTS `_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `categories` varchar(256) DEFAULT NULL,
  `traffic` tinyint(1) NOT NULL DEFAULT '0',
  `maptype` varchar(10) NOT NULL DEFAULT 'ROADMAP',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enable` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `_users`
--

INSERT INTO `_users` (`id`, `login`, `passwd`, `mail`, `categories`, `traffic`, `maptype`, `created`, `enable`) VALUES
(0, 'invite', 'f52bc44a34340cbf4c1aae1eb32e351160858b0d', 'nellsy@free.fr', '2,3,4,5,6,8,9,11', 0, 'ROADMAP', '2014-11-10 08:59:02', 1),
(1, 'pripaux', '5b379562e80f90d041a5829b88098b3afcf0f483', 'pripaux@gmail.com', '2,3,4,5,6,8,9,11', 0, 'ROADMAP', '2014-10-20 15:22:14', 1),
(3, 'toto', '0b9c2625dc21ef05f6ad4ddf47c5f203837aa32c', 'toto@gmail.com', '2,3,4,5,6,8,9,11', 0, 'ROADMAP', '2014-11-10 13:18:39', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
