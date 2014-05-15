-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 15 Mai 2014 à 18:26
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `whatsup`
--
CREATE DATABASE IF NOT EXISTS `whatsup` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `whatsup`;

-- --------------------------------------------------------

--
-- Structure de la table `annotation`
--

CREATE TABLE IF NOT EXISTS `annotation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) DEFAULT NULL,
  `idArticle` int(11) DEFAULT NULL,
  `AnnotationType` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AnnotationContent` longtext COLLATE utf8_unicode_ci,
  `dateinsert` datetime DEFAULT NULL,
  `dateupdate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_61193D22FE6E88D7` (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=49 ;

--
-- Contenu de la table `annotation`
--

INSERT INTO `annotation` (`id`, `idUser`, `idArticle`, `AnnotationType`, `AnnotationContent`, `dateinsert`, `dateupdate`) VALUES
(1, 2, 18, 'signalement', 'toto', '0000-00-00 00:00:00', NULL),
(2, 2, 18, 'signalement', 'titi', '2014-04-29 21:24:01', '2014-04-29 21:24:01'),
(3, 2, 23, 'like', '', '2014-04-30 09:47:55', '2014-04-30 09:47:55'),
(4, 2, 23, 'like', '', '2014-04-30 09:52:50', '2014-04-30 09:52:50'),
(5, 2, 23, 'like', '', '2014-04-30 09:57:35', '2014-04-30 09:57:35'),
(6, 2, 23, 'like', '', '2014-04-30 09:59:10', '2014-04-30 09:59:10'),
(7, 2, 23, 'like', '', '2014-04-30 10:00:10', '2014-04-30 10:00:10'),
(8, 2, 23, 'like', '', '2014-04-30 10:01:00', '2014-04-30 10:01:00'),
(9, 2, 23, 'like', '', '2014-04-30 10:01:21', '2014-04-30 10:01:21'),
(10, 2, 23, 'like', '', '2014-04-30 10:02:19', '2014-04-30 10:02:19'),
(11, 2, 23, 'like', '', '2014-04-30 10:03:02', '2014-04-30 10:03:02'),
(12, 2, 23, 'like', '', '2014-04-30 10:05:03', '2014-04-30 10:05:03'),
(13, 2, 23, 'like', '', '2014-04-30 10:05:41', '2014-04-30 10:05:41'),
(14, 2, 23, 'like', '', '2014-04-30 10:06:32', '2014-04-30 10:06:32'),
(15, 2, 23, 'like', '', '2014-04-30 10:11:55', '2014-04-30 10:11:55'),
(16, 2, 21, 'like', '', '2014-04-30 10:40:45', '2014-04-30 10:40:45'),
(17, 2, 21, 'like', '', '2014-04-30 10:41:45', '2014-04-30 10:41:45'),
(18, 2, 23, 'like', '', '2014-04-30 11:11:42', '2014-04-30 11:11:42'),
(19, 2, 23, 'comments', 'test1 commentaire', NULL, NULL),
(20, 2, 23, 'comments', '', '2014-04-30 12:04:35', '2014-04-30 12:04:35'),
(21, 2, 23, 'comments', '', '2014-04-30 12:05:54', '2014-04-30 12:05:54'),
(22, 2, 23, 'comments', '', '2014-04-30 12:06:15', '2014-04-30 12:06:15'),
(23, 2, 23, 'comments', '', '2014-04-30 12:07:48', '2014-04-30 12:07:48'),
(24, 2, 23, 'comments', 'test2', '2014-04-30 12:08:06', '2014-04-30 12:08:06'),
(25, 2, 23, 'comments', 'dzeaeae', '2014-04-30 12:12:10', '2014-04-30 12:12:10'),
(26, 2, 23, 'like', '', '2014-04-30 13:45:25', '2014-04-30 13:45:25'),
(27, 2, 19, 'like', '', '2014-04-30 19:26:30', '2014-04-30 19:26:30'),
(28, 2, 19, 'signalement', 'k', '2014-04-30 19:26:36', '2014-04-30 19:26:36'),
(29, 2, 18, 'like', '', '2014-04-30 22:00:31', '2014-04-30 22:00:31'),
(30, 2, 23, 'like', '', '2014-04-30 22:05:55', '2014-04-30 22:05:55'),
(31, 2, 23, 'like', '', '2014-05-02 16:11:42', '2014-05-02 16:11:42'),
(32, 2, 23, 'signalement', 'pd', '2014-05-02 16:11:51', '2014-05-02 16:11:51'),
(33, 2, 23, 'like', 'pd', '2014-05-02 16:11:59', '2014-05-02 16:11:59'),
(34, 2, 23, 'comments', 'fujhblikj', '2014-05-02 16:12:17', '2014-05-02 16:12:17'),
(35, 2, 23, 'comments', 'tata', '2014-05-02 16:12:35', '2014-05-02 16:12:35'),
(36, 2, 19, 'comments', 'zazazaz', '2014-05-11 14:35:18', '2014-05-11 14:35:18'),
(37, 2, 19, 'like', '', '2014-05-11 14:37:46', '2014-05-11 14:37:46'),
(38, 2, 19, 'like', '', '2014-05-11 14:37:50', '2014-05-11 14:37:50'),
(39, 2, 19, 'comments', 'tata', '2014-05-11 14:54:27', '2014-05-11 14:54:27'),
(40, 2, 19, 'comments', 'jk', '2014-05-11 14:55:30', '2014-05-11 14:55:30'),
(41, 2, 19, 'comments', '<script> alert(''toto''); </script>', '2014-05-11 14:57:24', '2014-05-11 14:57:24'),
(42, 2, 19, 'comments', 'tata', '2014-05-11 15:07:42', '2014-05-11 15:07:42'),
(43, 2, 19, 'signalement', 'zorro', '2014-05-11 15:39:14', '2014-05-11 15:39:14'),
(44, 2, 26, 'like', '', '2014-05-14 06:57:07', '2014-05-14 06:57:07'),
(45, 2, 26, 'like', '', '2014-05-14 06:57:14', '2014-05-14 06:57:14'),
(46, 2, 26, 'like', '', '2014-05-14 06:57:14', '2014-05-14 06:57:14'),
(47, 2, 23, 'signalement', 'zzadazdazdzadzazadad', '2014-05-14 12:01:15', '2014-05-14 12:01:15'),
(48, 2, 19, 'signalement', 'popo', '2014-05-14 12:27:58', '2014-05-14 12:27:58');

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `picture` longtext COLLATE utf8_unicode_ci,
  `status` int(11) DEFAULT NULL,
  `dateinsert` datetime DEFAULT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `activate` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `push` int(255) DEFAULT NULL,
  `sandbox` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CD8737FA9B32FD3` (`categoryid`),
  KEY `IDX_CD8737FAF132696E` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `categoryid`, `userid`, `title`, `slug`, `content`, `picture`, `status`, `dateinsert`, `dateupdate`, `activate`, `views`, `file`, `path`, `push`, `sandbox`) VALUES
(17, 1, 2, 'test2', 'test2', '<p>test2</p>', NULL, 1, '2014-04-29 06:48:04', '2014-04-29 06:48:04', 0, 1, NULL, 'chat.jpg', NULL, 0),
(18, 6, 2, 'test3', 'test3', '<p>yolo</p>', NULL, 1, '2014-04-29 06:50:27', '2014-04-29 06:50:27', 1, 1, NULL, 'cochon.jpg', NULL, 0),
(19, 8, 2, 'test4', 'test4', '<p>Vestibulum viverra elementum magna ac tincidunt. Cras ac imperdiet lorem, a euismod mauris. Nunc iaculis cursus quam id commodo? Morbi lobortis convallis magna, quis ullamcorper purus egestas at. Etiam nibh elit, eleifend a ultrices a, rhoncus sit amet lorem. Cras ut massa mattis nisl congue lacinia. Donec lobortis, felis non pulvinar consequat, elit lectus placerat turpis, at sollicitudin nisi turpis ornare lectus. Fusce tellus ipsum; suscipit a euismod vitae, egestas gravida libero. Fusce ac turpis at est vulputate lacinia vitae nec turpis.\r\n\r\nSed porta semper diam ac scelerisque. Nulla ac massa viverra, aliquet justo ut, gravida est. Integer fringilla, eros nec viverra vehicula, urna lectus placerat est, eu venenatis magna nisl in dui. Nulla mollis dolor sem, a consectetur metus tincidunt vel. Duis malesuada consectetur nisl, ut tempor ipsum commodo at? Etiam ornare lobortis sapien, luctus tincidunt metus dignissim eget. Morbi non mauris a lacus sollicitudin luctus blandit et justo. Suspendisse non justo a orci sodales faucibus.\r\n\r\nAliquam ut leo sollicitudin, scelerisque quam in; viverra nibh. Nullam ac malesuada metus. Ut fringilla rutrum ipsum id bibendum. Sed rutrum purus sed metus tempor tristique! Donec vulputate dolor nec nisi elementum elementum. Sed faucibus leo sed dolor viverra gravida. Vivamus ligula mauris, consectetur vel ipsum ut, aliquam vestibulum augue.\r\n</p>', NULL, 1, '2014-04-29 06:55:00', '2014-04-29 06:55:00', 1, 1, NULL, 'chat-lion.gif', NULL, 0),
(20, 5, 2, 'test6', 'test6', '<p>test6</p>', NULL, 1, '2014-04-29 06:56:32', '2014-04-29 06:56:32', 1, 1, NULL, 'flute.jpg', NULL, 0),
(21, 5, 2, 'Musique un', 'musique-un', '<p>musique un</p>', NULL, 1, '2014-04-30 00:59:16', '2014-04-30 00:59:16', 1, 1, NULL, 'piano.jpg', NULL, 0),
(22, 5, 2, 'musique deux', 'musique-deux', '<p>musique deux</p>', NULL, 1, '2014-04-30 00:59:39', '2014-04-30 00:59:39', 1, 1, NULL, '01.jpg', NULL, 0),
(23, 5, 2, 'zaza', 'musique-quatre', 'Contrairement à une opinion répandue, le Lorem Ipsum n''est pas simplement du texte aléatoire. Il trouve ses racines dans une oeuvre de la littérature latine classique datant de 45 av. J.-C., le rendant vieux de 2000 ans. Un professeur du Hampden-Sydney College, en Virginie, s''est intéressé à un des mots latins les plus obscurs, consectetur, extrait d''un passage du Lorem Ipsum, et en étudiant tous les usages de ce mot dans la littérature classique, découvrit la source incontestable du Lorem Ipsum. Il provient en fait des sections 1.10.32 et 1.10.33 du "De Finibus Bonorum et Malorum" (Des Suprêmes Biens et des Suprêmes Maux) de Cicéron. Cet ouvrage, très populaire pendant la Renaissance, est un traité sur la théorie de l''éthique. Les premières lignes du Lorem Ipsum, "Lorem ipsum dolor sit amet...", ', NULL, 1, '2014-04-30 09:24:39', '2014-04-30 09:24:39', 1, 1, NULL, 'zoidberg_evil.jpg', NULL, 0),
(24, 6, 3, 'tata', 'zadazd', '<p>azdzadazd</p>', NULL, 1, '2014-05-02 17:09:19', '2014-05-02 17:09:19', 1, 1, NULL, '01.jpg', NULL, 0),
(26, 7, 3, 'Albert', 'albert', '<p>Nullam nec dapibus nunc. Nullam nisi mauris, ultrices ut porta et, tempus eu arcu. Integer pretium imperdiet mollis. Nullam tortor sapien; luctus nec odio et, tempor blandit dolor. Curabitur non enim in odio pulvinar consectetur id a purus. Vivamus semper commodo consectetur. Curabitur sed faucibus libero. Vestibulum vel purus sed nunc tristique hendrerit. Sed pellentesque magna at est facilisis accumsan. Quisque dictum diam vel augue bibendum aliquam. Mauris sollicitudin consequat ipsum eget ornare. Aliquam vulputate lectus mi, ac varius libero volutpat id. Donec pretium fermentum aliquam? Quisque purus justo, iaculis nec felis consectetur, vestibulum blandit diam.</p>\r\n\r\n<p>Nulla in ligula dui. Ut scelerisque justo metus, posuere tempor augue consequat eu. Aenean sed massa condimentum; bibendum leo a, adipiscing odio? Proin ultricies lorem sed dignissim volutpat. Nunc ac risus eu lacus mattis egestas? Integer nunc arcu, faucibus vel sapien ac, feugiat porttitor tellus? Curabitur interdum fermentum imperdiet. Integer sit amet elit imperdiet, euismod libero sit amet, venenatis turpis. Etiam libero turpis, luctus sit amet fringilla at; condimentum malesuada est.</p>\r\n\r\n<p>Maecenas imperdiet magna vel mi euismod, eu molestie augue lacinia. Suspendisse eget quam ut mauris tincidunt molestie sit amet a neque! Proin mollis a felis lobortis venenatis. Suspendisse porta sodales tempor. Nulla facilisi. Maecenas pretium hendrerit magna et cursus. Donec pretium elementum metus ac dictum. Donec cursus congue mi eget gravida. Nullam non mi at leo ultrices vulputate. Cras congue dolor et nisi cursus egestas.</p>\r\n\r\n<p>&nbsp;</p>', NULL, 1, '2014-05-10 13:23:48', '2014-05-10 13:23:48', 1, 1, NULL, 'bengal.jpg', 1, 1),
(27, 1, 3, 'qzd', 'qzd', '<p>qzd</p>', NULL, 1, '2014-05-10 20:47:42', '2014-05-10 20:47:42', 1, 1, NULL, '2013-09-27 14.13.12.jpg', 1, 1),
(28, 5, 2, 'HAAA', 'haaa', '<p>HAAA</p>', NULL, 1, '2014-05-11 21:30:36', '2014-05-11 21:30:36', 0, NULL, NULL, '2013-09-27 14.13.12.jpg', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activate` int(11) NOT NULL,
  `dateinsert` datetime NOT NULL,
  `dateupdate` datetime NOT NULL,
  `categoryid` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `activate`, `dateinsert`, `dateupdate`, `categoryid`) VALUES
(1, 'Art', 'art', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(4, 'Cinéma', 'cinoche', 1, '2014-04-28 20:20:48', '2014-04-28 20:20:48', NULL),
(5, 'Musique', 'musique', 1, '2014-04-29 23:23:53', '2014-04-29 23:23:53', NULL),
(6, 'Sortie', 'sortie', 1, '2014-04-29 23:24:18', '2014-04-29 23:24:18', NULL),
(7, 'Technologies', 'technologies', 1, '2014-04-29 23:24:35', '2014-04-29 23:24:35', NULL),
(8, 'Mode', 'mode', 1, '2014-04-29 23:25:13', '2014-04-29 23:25:13', NULL),
(9, 'tata', 'tata', 1, '2014-05-12 22:03:05', '2014-05-12 22:03:05', 4),
(10, 'titi', 'titi', 1, '2014-05-12 22:15:24', '2014-05-12 22:15:24', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `orderlink` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activate` int(11) NOT NULL,
  `datestart` date NOT NULL,
  `dateend` date NOT NULL,
  `hourstart` time NOT NULL,
  `hourend` time NOT NULL,
  `dateinsert` datetime NOT NULL,
  `dateupdate` datetime NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `categoryid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FA6F25A3F132696E` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `event`
--

INSERT INTO `event` (`id`, `title`, `description`, `place`, `address`, `orderlink`, `activate`, `datestart`, `dateend`, `hourstart`, `hourend`, `dateinsert`, `dateupdate`, `userid`, `categoryid`) VALUES
(1, 'aze', 'zae', 'zae', 'zae', 'aze', 0, '2009-01-01', '2009-01-01', '17:00:00', '00:00:00', '2014-04-09 20:07:04', '2014-04-09 20:07:04', NULL, NULL),
(2, 'azeazeaz', 'azeazeaze', 'azeaz', 'azeaze', 'azeazeaze', 1, '2009-01-01', '2009-01-01', '00:00:00', '00:00:00', '2014-05-10 21:53:42', '2014-05-10 21:53:42', NULL, 7),
(3, 'zaeaze', 'aze', 'azeaza', 'aze', 'aze', 0, '2009-01-01', '2009-01-01', '00:00:00', '03:03:00', '2014-05-11 22:12:59', '2014-05-11 22:12:59', 2, 5),
(4, 'aze', 'zae', 'aze', 'azeazeaze', 'aze', 0, '2009-01-01', '2009-01-01', '00:00:00', '00:00:00', '2014-05-11 22:14:29', '2014-05-11 22:14:29', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `lookbook`
--

CREATE TABLE IF NOT EXISTS `lookbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `activate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateinsert` datetime NOT NULL,
  `dateupdate` datetime NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9B0FB339F132696E` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `lookbook`
--

INSERT INTO `lookbook` (`id`, `userid`, `activate`, `dateinsert`, `dateupdate`, `path`, `title`) VALUES
(1, 2, '0', '2014-05-12 22:51:45', '2014-05-12 22:51:45', 'nirun.jpg', 'pepito'),
(2, 2, '0', '2014-05-12 22:52:13', '2014-05-12 22:52:13', 'nirun.jpg', 'pepito'),
(3, 2, '0', '2014-05-13 01:42:56', '2014-05-13 01:42:56', 'cochon-inde-titeuf.jpg', 'tata');

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_ABED8E08F132696E` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `organigramme`
--

CREATE TABLE IF NOT EXISTS `organigramme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userlist` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Contenu de la table `organigramme`
--

INSERT INTO `organigramme` (`id`, `name`, `userlist`) VALUES
(5, 'zaza', 'toto,zaza,titi'),
(6, 'bhabha', 'zaza,tata'),
(9, 'azeazea', 'aze'),
(10, 'bhabha ', 'zaza,tata '),
(11, 'aze', '  aze'),
(12, 'aze', 'aze');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zipcode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateinsert` datetime DEFAULT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `activate` int(11) DEFAULT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `surname`, `username`, `email`, `password`, `website`, `birthday`, `photo`, `country`, `city`, `zipcode`, `dateinsert`, `dateupdate`, `activate`, `username_canonical`, `email_canonical`, `enabled`, `salt`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `description`) VALUES
(2, 'azeaz', 'azeaze', NULL, 'toto', 'toto@toto.com', 'Th6+Xn/c6ny8bT3D3/LwWa6RCLlh9Mlib1nE3Wf8VL8tLFQs/MOkMFg7+fAmiY59/8deBKxzre2XpdsKsy9AbQ==', 'aze', '2009-01-01', '', 'aze', 'aze', 'aze', '2014-04-22 00:30:59', '2014-04-22 00:30:59', 0, 'toto', 'toto@toto.com', 1, '5ri1tu08iao0ow48cgc0kgs0o48gcog', '2014-05-15 08:12:59', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, NULL),
(3, 'eazezae', NULL, NULL, 'rara', 'aze@gas.com', 'QHYD0hLstiOWn2BQZsWV9tWYOqnSdYxHBLTZMJP2IKi5FGvRAPseo8/byUlXy0iyfh06OFnhi88nvy8ANikaDw==', NULL, NULL, NULL, NULL, NULL, NULL, '2014-05-01 17:03:15', '2014-05-01 17:03:15', 1, 'rara', 'aze@gas.com', 1, 'osgbbedo6800ocgg8ck8wog48oc4o4k', '2014-05-01 17:03:16', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, NULL),
(4, 'popo', 'popo', NULL, 'popo', 'nparamess@gmail.com', 'dE05d/w4KmP8XbmtvKydMWraOuHLUsjhcRVxyRCj202MMIQ2grKyhtm1qJP6Siv9r+B5s194JLIFyEHJde2I4A==', 'aze', '2012-03-01', '', 'aze', 'aze', 'aze', '2014-05-10 17:17:42', '2014-05-10 17:17:42', 1, 'popo', 'nparamess@gmail.com', 1, 'fwnyu521xxc00w4ggwc4ss44wc8gw08', '2014-05-10 17:17:43', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, NULL),
(5, 'trtr', 'trtr', NULL, 'azeaze', 'aze@aze.com', '6sTESAKGO+1K16GNNGQfSYxHks1rM7y29LMCbixBpSNOzaRCy7DGJzOdbQ7WgOJPggNc6CcWf2hyT3TSldc7Ig==', NULL, NULL, NULL, NULL, NULL, NULL, '2014-05-13 00:31:35', '2014-05-13 00:31:35', 1, 'azeaze', 'aze@aze.com', 1, 'rprxab8xnlcoss4owc4c4csc8sss0w8', '2014-05-13 00:31:35', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, NULL),
(6, 'rara', 'rara', NULL, 'aze', 'nparamesss@gmail.com', '/ZYiHNLKfEqy00n+6h0d5u1SlvNcYDI8PvQfoa7nt/51MCiTokK3NTi6AeaiAIRsaLawJnXfgi+S9P6BjOcTGw==', NULL, NULL, NULL, NULL, NULL, NULL, '2014-05-13 00:41:50', '2014-05-13 00:41:50', 1, 'aze', 'nparamesss@gmail.com', 1, 'ml3869oq1s00w0scwgo4g8cwog04ccc', '2014-05-13 00:41:51', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, NULL),
(7, 'tata', 'tata', NULL, 'tata', 'azeaze@aze.com', 'cR32ozRqta1ss4XiTOddIkQPJfrloQv7Dj0dbkINEi+8GDDl1aELTalSY9N9LqiniuBOLuzZeVqMSVk0DgpALg==', 'tata', '2013-07-12', 'tata', 'tata', 'tata', 'tata', '2014-05-15 10:00:44', '2014-05-15 10:00:44', 1, 'tata', 'azeaze@aze.com', 1, 'ohuavf1iz9c00sgw8gco0ogksgkwkw4', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'tata'),
(8, 'tata', 'tata', NULL, 'tatae', 'azeaze@azee.com', 'QZSAQd0canjedPtakZL1V12Hk6UYxLXE8tf7BGKglxyjcPC/v1s3Tp4YZvPoFcvsREcXoPRpJPmJFylAey2ndA==', 'tata', '2013-07-12', 'tata', 'tata', 'tata', 'tata', '2014-05-15 10:01:56', '2014-05-15 10:01:56', 1, 'tatae', 'azeaze@azee.com', 1, '6y0w9srjc10kgs8gs48c8ckcw0w4g0o', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'tata'),
(9, 'tata', 'tata', NULL, 'tataeaaa', 'aaa@azee.com', 'tMR3Dv7mGkqqONWD0DhdoZt6PQNv1m1oYmkDOmoO3EuICUydbq9vp9o3qIESMU5bSVO9cQ37xJxXtaf3KqmpLQ==', 'tata', '2013-07-12', 'tata', 'tata', 'tata', 'tata', '2014-05-15 10:02:48', '2014-05-15 10:02:48', 1, 'tataeaaa', 'aaa@azee.com', 1, '6gez0vpt04sokk0cggc8ss8g0gwk4os', '2014-05-15 10:02:48', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'tata');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `annotation`
--
ALTER TABLE `annotation`
  ADD CONSTRAINT `FK_61193D22FE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_CD8737FA9B32FD3` FOREIGN KEY (`categoryid`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_CD8737FAF132696E` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `FK_FA6F25A3F132696E` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `lookbook`
--
ALTER TABLE `lookbook`
  ADD CONSTRAINT `FK_9B0FB339F132696E` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `FK_ABED8E08F132696E` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
