SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS _bookmarks (
  id int(11) NOT NULL AUTO_INCREMENT,
  idUser int(11) NOT NULL,
  idItem int(11) NOT NULL,
  created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enable` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

INSERT INTO _bookmarks (id, idUser, idItem, created, enable) VALUES
(1, 2, 11, '0000-00-00 00:00:00', 1),
(2, 1, 9, '0000-00-00 00:00:00', 1),
(3, 1, 8, '0000-00-00 00:00:00', 1),
(4, 1, 14, '0000-00-00 00:00:00', 1),
(5, 2, 14, '0000-00-00 00:00:00', 1),
(6, 1, 1, '2015-01-29 20:38:49', 1),
(7, 1, 6, '2015-01-29 20:39:13', 1);

CREATE TABLE IF NOT EXISTS _categories (
  id int(11) NOT NULL AUTO_INCREMENT,
  parent int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  color varchar(8) NOT NULL,
  icon varchar(100) NOT NULL,
  created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enable` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

INSERT INTO _categories (id, parent, name, color, icon, created, enable) VALUES
(1, 0, '_LNG_ADD_REF_', '#000000', '', '2014-10-20 15:25:19', 1),
(2, 1, '_LNG_ADD_REF_BAR_', '#636393', 'bar.png', '2014-10-20 15:25:19', 1),
(3, 1, '_LNG_ADD_REF_DISCO_', '#B5222D', 'disco.png', '2014-10-20 15:27:56', 1),
(4, 1, '_LNG_ADD_REF_RESTAURANT_', '#D4953C', 'restaurant.png', '2014-10-20 15:27:56', 1),
(5, 1, '_LNG_ADD_REF_MUSEUM_', '#609491', 'museum.png', '2014-10-20 15:28:53', 1),
(6, 1, '_LNG_ADD_REF_OTHER_', '#87A248', 'other.png', '2014-10-20 15:28:53', 1),
(7, 0, '_LNG_ADD_NOTE_', '#000000', '', '2014-10-20 15:29:38', 1),
(8, 7, '_LNG_ADD_NOTE_PUBLIC_', '#e6dd31', 'note.png', '2014-10-20 15:30:42', 1),
(9, 7, '_LNG_ADD_NOTE_PRIVATE_', '#fa8932', 'note2.png', '2014-10-20 15:30:42', 1),
(10, 0, '_LNG_ADD_EVENT_', '#000000', '', '2014-10-20 15:31:52', 1),
(11, 10, '_LNG_ADD_EVENT_EPHEMERE_', '#FF0000', 'event.png', '2014-10-20 15:31:52', 1);

CREATE TABLE IF NOT EXISTS _comments (
  id int(11) NOT NULL AUTO_INCREMENT,
  idUser int(11) NOT NULL,
  idItem int(11) NOT NULL,
  created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enable` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS _items (
  id int(11) NOT NULL AUTO_INCREMENT,
  idUser int(11) NOT NULL,
  idCategorie int(11) NOT NULL,
  title varchar(100) NOT NULL,
  description longtext NOT NULL,
  latitude varchar(200) NOT NULL,
  longitude varchar(200) NOT NULL,
  created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enable` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

INSERT INTO _items (id, idUser, idCategorie, title, description, latitude, longitude, created, enable) VALUES
(1, 1, 2, 'New Team', 'Encore une victoire de canard !', '48.9259803', '2.1857479999999896', '2014-10-20 15:21:44', 1),
(2, 1, 3, 'Mon nouveau test', 'Encore un commentaire de canard !', '48.889958', '2.219405', '2014-10-20 15:25:33', 1),
(3, 1, 4, 'Mon restaurant', 'Encore une victoire de canard !', '48.892323', '2.2153309999999522', '2014-10-21 10:42:50', 1),
(5, 2, 2, 'Au bureau', 'Pub brasserie ,une jolie décoration bonne ambiance on y mange très bien et les plats sont très  consistants', 'undefined', 'undefined', '2014-11-02 17:07:57', 1),
(6, 1, 4, 'El Kima', 'Super bon fast food\nGrec,burger,panini,salade', '48.925411000000004', '2.2118030199999903', '2014-11-05 13:46:50', 1),
(7, 1, 2, '', '', '48.930252688051134', '2.1814000234028152', '2014-11-05 19:15:57', 1),
(8, 1, 2, 'Cafe leffe', 'restaurant, bar lounge ambiance trÃ¨s cosy on \\''y mange bien voir copieux \nLe staff est au petit soins\nLe jeudi soir happy Hours trÃ¨s animÃ© avec Dj \nBonne ambiance idÃ©al pour se dÃ©contractÃ© en fin de journÃ©e', '48.875808763464185', '2.182890078615451', '2014-11-05 21:01:11', 1),
(9, 1, 2, 'test', 'test', '48.941106', '2.1584309999999998', '2014-11-11 16:10:04', 1),
(10, 2, 2, 'Bureau', 'super pub', '48.99101562586794', '2.207632985999228', '2014-11-20 22:26:41', 1),
(11, 2, 2, '', '', '48.99565998935047', '2.172860540451643', '2014-11-25 21:28:45', 1),
(12, 2, 4, 'Pedra alta', 'super restaurant\nLa viande est de trÃ¨s bon choix ,\nLe plateau de fruit de mer, un rÃ©gal, je ne viens que pour sa!', '', '', '2014-11-30 20:04:16', 1),
(13, 2, 4, 'Schwartz\\''s deli', 'super bon restaurant\nSpÃ©cialiste des humbergers\nLa viande est trÃ¨s bonne', '48.85513099000925', '2.295861353586509', '2014-12-03 21:42:27', 1),
(14, 2, 2, 'triplettes', 'Bar super sympa. Bonne ambiance et des serveurs accueillant et agrÃ©able. CÃ´tÃ© restauration on y trouve des plats avec des produits frais uniquement. Viandes et poissons excellents. Je recommande vivement.', '48.870473289907785', '2.378914207222293', '2014-12-05 23:49:18', 1);

CREATE TABLE IF NOT EXISTS _links (
  lID int(11) NOT NULL AUTO_INCREMENT,
  lUserID int(11) NOT NULL,
  lReferenceID int(11) NOT NULL,
  lTitle varchar(100) NOT NULL,
  lComment longtext NOT NULL,
  lFavorite tinyint(1) NOT NULL,
  lNote enum('0','1','2','3','4','5') NOT NULL,
  lCreated timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  lEnable tinyint(1) NOT NULL,
  PRIMARY KEY (lID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS _medias (
  id int(11) NOT NULL AUTO_INCREMENT,
  idUser int(11) NOT NULL,
  idItem int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enable` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS _notes (
  id int(11) NOT NULL AUTO_INCREMENT,
  idUser int(11) NOT NULL,
  idItem int(11) NOT NULL,
  note int(11) NOT NULL,
  created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enable` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS _users (
  id int(11) NOT NULL AUTO_INCREMENT,
  login varchar(100) NOT NULL,
  passwd varchar(100) NOT NULL,
  mail varchar(100) NOT NULL,
  categories varchar(256) DEFAULT NULL,
  traffic tinyint(1) NOT NULL DEFAULT '0',
  maptype varchar(10) NOT NULL DEFAULT 'ROADMAP',
  created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enable` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO _users (id, login, passwd, mail, categories, traffic, maptype, created, enable) VALUES
(0, 'invite', 'f52bc44a34340cbf4c1aae1eb32e351160858b0d', 'invite@letsgo.com', '2,3,4,5,6,8,9,11', 0, 'ROADMAP', '2014-11-10 19:20:32', 1),
(1, 'pripaux', '5b379562e80f90d041a5829b88098b3afcf0f483', 'pripaux@gmail.com', '3,4,5,6,8,9,11', 1, 'ROADMAP', '2014-10-20 17:22:14', 1),
(2, 'davv03', 'e8994daf4c0e777a2768035de1d7497f067e26d2', 'davv03@hotmail.com', '2,3,4,5,6,8,9,11', 1, 'ROADMAP', '2014-11-03 19:38:18', 1),
(3, 'pchartoi', '1036888c1763a30e6a782c60a96487829b6de179', 'cpascal4@gmail.com', '2,3,4,5,6,8,9,11', 1, 'ROADMAP', '2014-11-27 09:30:57', 1),
(4, 'Cincoboy', '55fcbf06db4069188faa19c5834a56e0e0cc381c', 'hocinebouhi@gmail.com', '2,3,4,5,6,8,9,11', 0, 'ROADMAP', '2015-01-01 03:42:53', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
