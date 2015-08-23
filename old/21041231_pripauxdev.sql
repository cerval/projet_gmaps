-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Client :  mysql51-83.perso
-- Généré le :  Mer 31 Décembre 2014 à 11:49
-- Version du serveur :  5.1.73-2+squeeze+build1+1-log
-- Version de PHP :  5.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `pripauxdev`
--
CREATE DATABASE IF NOT EXISTS `pripauxdev` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pripauxdev`;

-- --------------------------------------------------------

--
-- Structure de la table `_bookmarks`
--

CREATE TABLE IF NOT EXISTS `_bookmarks` (
  `bID` int(11) NOT NULL AUTO_INCREMENT,
  `bItemID` int(11) NOT NULL,
  `bUserID` int(11) NOT NULL,
  PRIMARY KEY (`bID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `_bookmarks`
--

INSERT INTO `_bookmarks` (`bID`, `bItemID`, `bUserID`) VALUES
(1, 11, 2),
(2, 9, 1),
(3, 8, 1),
(4, 14, 1);

-- --------------------------------------------------------

--
-- Structure de la table `_comments`
--

CREATE TABLE IF NOT EXISTS `_comments` (
  `cID` int(11) NOT NULL AUTO_INCREMENT,
  `cUserID` int(11) NOT NULL,
  `cComment` varchar(256) NOT NULL,
  `cEnable` tinyint(1) NOT NULL,
  PRIMARY KEY (`cID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `_items`
--

CREATE TABLE IF NOT EXISTS `_items` (
  `iID` int(11) NOT NULL AUTO_INCREMENT,
  `iUserID` int(11) NOT NULL,
  `iTypeID` int(11) NOT NULL,
  `iTitle` varchar(100) NOT NULL,
  `iComment` longtext NOT NULL,
  `iLatitude` varchar(200) NOT NULL,
  `iLongitude` varchar(200) NOT NULL,
  `iCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `iEnable` tinyint(1) NOT NULL,
  PRIMARY KEY (`iID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `_items`
--

INSERT INTO `_items` (`iID`, `iUserID`, `iTypeID`, `iTitle`, `iComment`, `iLatitude`, `iLongitude`, `iCreated`, `iEnable`) VALUES
(1, 1, 2, 'New Team', 'Encore une victoire de canard !', '48.9259803', '2.1857479999999896', '2014-10-20 13:21:44', 1),
(2, 1, 3, 'Mon nouveau test', 'Encore un commentaire de canard !', '48.889958', '2.219405', '2014-10-20 13:25:33', 1),
(3, 1, 4, 'Mon restaurant', 'Encore une victoire de canard !', '48.892323', '2.2153309999999522', '2014-10-21 08:42:50', 1),
(5, 2, 2, 'Au bureau', 'Pub brasserie ,une jolie décoration bonne ambiance on y mange très bien et les plats sont très  consistants', 'undefined', 'undefined', '2014-11-02 16:07:57', 1),
(6, 1, 4, 'El Kima', 'Super bon fast food\nGrec,burger,panini,salade', '48.925411000000004', '2.2118030199999903', '2014-11-05 12:46:50', 1),
(7, 1, 2, '', '', '48.930252688051134', '2.1814000234028152', '2014-11-05 18:15:57', 1),
(8, 1, 2, 'Cafe leffe', 'restaurant, bar lounge ambiance trÃ¨s cosy on \\''y mange bien voir copieux \nLe staff est au petit soins\nLe jeudi soir happy Hours trÃ¨s animÃ© avec Dj \nBonne ambiance idÃ©al pour se dÃ©contractÃ© en fin de journÃ©e', '48.875808763464185', '2.182890078615451', '2014-11-05 20:01:11', 1),
(9, 1, 2, 'test', 'test', '48.941106', '2.1584309999999998', '2014-11-11 15:10:04', 1),
(10, 2, 2, 'Bureau', 'super pub', '48.99101562586794', '2.207632985999228', '2014-11-20 21:26:41', 1),
(11, 2, 2, '', '', '48.99565998935047', '2.172860540451643', '2014-11-25 20:28:45', 1),
(12, 2, 4, 'Pedra alta', 'super restaurant\nLa viande est de trÃ¨s bon choix ,\nLe plateau de fruit de mer, un rÃ©gal, je ne viens que pour sa!', '', '', '2014-11-30 19:04:16', 1),
(13, 2, 4, 'Schwartz\\''s deli', 'super bon restaurant\nSpÃ©cialiste des humbergers\nLa viande est trÃ¨s bonne', '48.85513099000925', '2.295861353586509', '2014-12-03 20:42:27', 1),
(14, 2, 2, 'triplettes', 'Bar super sympa. Bonne ambiance et des serveurs accueillant et agrÃ©able. CÃ´tÃ© restauration on y trouve des plats avec des produits frais uniquement. Viandes et poissons excellents. Je recommande vivement.', '48.870473289907785', '2.378914207222293', '2014-12-05 22:49:18', 1);

-- --------------------------------------------------------

--
-- Structure de la table `_links`
--

CREATE TABLE IF NOT EXISTS `_links` (
  `lID` int(11) NOT NULL AUTO_INCREMENT,
  `lUserID` int(11) NOT NULL,
  `lReferenceID` int(11) NOT NULL,
  `lTitle` varchar(100) NOT NULL,
  `lComment` longtext NOT NULL,
  `lFavorite` tinyint(1) NOT NULL,
  `lNote` enum('0','1','2','3','4','5') NOT NULL,
  `lCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lEnable` tinyint(1) NOT NULL,
  PRIMARY KEY (`lID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `_medias`
--

CREATE TABLE IF NOT EXISTS `_medias` (
  `mID` int(11) NOT NULL AUTO_INCREMENT,
  `mUserID` int(11) NOT NULL,
  `mReferenceID` int(11) NOT NULL,
  `mName` varchar(100) NOT NULL,
  `mCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mEnable` tinyint(1) NOT NULL,
  PRIMARY KEY (`mID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `_notes`
--

CREATE TABLE IF NOT EXISTS `_notes` (
  `nID` int(11) NOT NULL AUTO_INCREMENT,
  `nItemID` int(11) NOT NULL,
  `nUserID` int(11) NOT NULL,
  `nNote` int(11) NOT NULL,
  PRIMARY KEY (`nID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `_types`
--

CREATE TABLE IF NOT EXISTS `_types` (
  `tID` int(11) NOT NULL AUTO_INCREMENT,
  `tParent` int(11) NOT NULL,
  `tName` varchar(100) NOT NULL,
  `tColor` varchar(8) NOT NULL,
  `tIcon` varchar(100) NOT NULL,
  `tCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tEnable` tinyint(1) NOT NULL,
  PRIMARY KEY (`tID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `_types`
--

INSERT INTO `_types` (`tID`, `tParent`, `tName`, `tColor`, `tIcon`, `tCreated`, `tEnable`) VALUES
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
-- Structure de la table `_users`
--

CREATE TABLE IF NOT EXISTS `_users` (
  `uID` int(11) NOT NULL AUTO_INCREMENT,
  `uLogin` varchar(100) NOT NULL,
  `uPasswd` varchar(100) NOT NULL,
  `uMail` varchar(100) NOT NULL,
  `uTypes` varchar(256) DEFAULT NULL,
  `uTraffic` tinyint(1) NOT NULL DEFAULT '0',
  `uMapType` varchar(10) NOT NULL DEFAULT 'ROADMAP',
  `uCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `uEnable` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `_users`
--

INSERT INTO `_users` (`uID`, `uLogin`, `uPasswd`, `uMail`, `uTypes`, `uTraffic`, `uMapType`, `uCreated`, `uEnable`) VALUES
(0, 'invite', 'f52bc44a34340cbf4c1aae1eb32e351160858b0d', 'invite@letsgo.com', '2,3,4,5,6,8,9,11', 0, 'ROADMAP', '2014-11-10 18:20:32', 1),
(1, 'pripaux', '5b379562e80f90d041a5829b88098b3afcf0f483', 'pripaux@gmail.com', '2,3,4,5,6,8,9,11', 1, 'ROADMAP', '2014-10-20 15:22:14', 1),
(2, 'davv03', 'e8994daf4c0e777a2768035de1d7497f067e26d2', 'davv03@hotmail.com', '2,3,4,5,6,8,9,11', 1, 'ROADMAP', '2014-11-03 18:38:18', 1),
(3, 'pchartoi', '1036888c1763a30e6a782c60a96487829b6de179', 'cpascal4@gmail.com', '2,3,4,5,6,8,9,11', 1, 'ROADMAP', '2014-11-27 08:30:57', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
