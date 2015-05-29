-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 29 Mai 2015 à 16:06
-- Version du serveur :  5.6.24
-- Version de PHP :  5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `alexandraabeezfw`
--

-- --------------------------------------------------------

--
-- Structure de la table `position_zfw_reelle`
--

CREATE TABLE IF NOT EXISTS `position_zfw_reelle` (
  `date_archivage` datetime NOT NULL,
  `ref_lieu_stockage` varchar(10) NOT NULL,
  `ref_produit` varchar(25) NOT NULL,
  `qte` int(11) DEFAULT '0',
  `user_id` varchar(10) DEFAULT NULL,
  `date_heure_maj` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `position_zfw_reelle`
--

INSERT INTO `position_zfw_reelle` (`date_archivage`, `ref_lieu_stockage`, `ref_produit`, `qte`, `user_id`, `date_heure_maj`) VALUES
('2015-05-26 11:57:43', '1', 'TEBBL1000-OCC', 10, 'bidon', '2015-05-26 11:57:43'),
('2015-05-26 11:57:43', '2', 'TEBBL1000-OCC', 15, 'bidon', '2015-05-26 11:57:43'),
('2015-05-26 13:29:35', '1', 'TEAPL1004-OCC', 78, 'bidon', '2015-05-26 13:29:35'),
('2015-05-26 13:46:14', '1', 'TEAPL1000-CNF', 45, 'bidon', '2015-05-26 13:46:14'),
('2015-05-26 13:51:38', '1', 'TEBBL1000-OCC', 20, 'bidon', '2015-05-26 13:51:38'),
('2015-05-26 13:51:38', '2', 'TEBBL1000-OCC', 17, 'bidon', '2015-05-26 13:51:38'),
('2015-05-26 13:58:16', '1', 'TEAPL1000-CNF', 55, 'bidon', '2015-05-26 13:58:16'),
('2015-05-26 13:58:16', '2', 'TEAPL1000-CNF', 2, 'bidon', '2015-05-26 13:58:16'),
('2015-05-26 23:26:10', '1', 'TEAPL1004-OCC', 98, 'bidon', '2015-05-26 23:26:10'),
('2015-05-27 02:01:04', '1', 'TEAPL1000-CNF', 65, 'bidon', '2015-05-27 02:01:04'),
('2015-05-27 02:01:04', '2', 'TEAPL1000-CNF', 4, 'bidon', '2015-05-27 02:01:04'),
('2015-05-27 02:01:04', '1', 'TEBBL1000-OCC', 43, 'bidon', '2015-05-27 02:01:04'),
('2015-05-27 02:03:45', '1', 'TEAPL1000-CNF', 67, 'bidon', '2015-05-27 02:03:45'),
('2015-05-27 02:03:45', '2', 'TEAPL1000-CNF', 14, 'bidon', '2015-05-27 02:03:45'),
('2015-05-27 02:03:45', '1', 'TEBBL1000-OCC', 66, 'bidon', '2015-05-27 02:03:45'),
('2015-05-27 02:12:13', '1', 'TEAPL1000-CNF', 77, 'bidon', '2015-05-27 02:12:13'),
('2015-05-27 02:12:13', '2', 'TEAPL1000-CNF', 16, 'bidon', '2015-05-27 02:12:13'),
('2015-05-27 02:12:13', '1', 'TEBBL1000-OCC', 89, 'bidon', '2015-05-27 02:12:13'),
('2015-05-27 02:17:56', '1', 'TEAPL1000-CNF', 89, 'bidon', '2015-05-27 02:17:56'),
('2015-05-27 02:17:56', '1', 'TEBBL1000-OCC', 109, 'bidon', '2015-05-27 02:17:56'),
('2015-05-27 02:17:56', '2', 'TEBBL1000-OCC', 20, 'bidon', '2015-05-27 02:17:56'),
('2015-05-27 02:28:11', '1', 'TEAPL1000-CNF', 102, 'bidon', '2015-05-27 02:28:11'),
('2015-05-27 02:28:11', '1', 'TEBBL1000-OCC', 130, 'bidon', '2015-05-27 02:28:11'),
('2015-05-27 02:28:11', '2', 'TEBBL1000-OCC', 21, 'bidon', '2015-05-27 02:28:11'),
('2015-05-27 02:29:32', '1', 'TEAPL1000-CNF', 115, 'bidon', '2015-05-27 02:29:32'),
('2015-05-27 02:29:32', '1', 'TEBBL1000-OCC', 142, 'bidon', '2015-05-27 02:29:32'),
('2015-05-27 02:29:32', '2', 'TEBBL1000-OCC', 31, 'bidon', '2015-05-27 02:29:32'),
('2015-05-27 02:35:12', '1', 'TEBBL1000-OCC', 155, 'bidon', '2015-05-27 02:35:12'),
('2015-05-27 02:35:12', '1', 'TEAPL1000-CNF', 125, 'bidon', '2015-05-27 02:35:12'),
('2015-05-27 02:35:12', '2', 'TEAPL1000-CNF', 25, 'bidon', '2015-05-27 02:35:12'),
('2015-05-27 02:50:50', '1', 'TEAPL1000-CNF', 138, 'bidon', '2015-05-27 02:50:50'),
('2015-05-27 02:50:50', '1', 'TEBBL1000-OCC', 165, 'bidon', '2015-05-27 02:50:50'),
('2015-05-27 02:50:50', '2', 'TEBBL1000-OCC', 43, 'bidon', '2015-05-27 02:50:50'),
('2015-05-27 02:52:56', '1', 'TEAPL1000-CNF', 152, 'bidon', '2015-05-27 02:52:56'),
('2015-05-27 02:52:56', '1', 'TEBBL1000-OCC', 177, 'bidon', '2015-05-27 02:52:56'),
('2015-05-27 02:52:56', '2', 'TEBBL1000-OCC', 62, 'bidon', '2015-05-27 02:52:56'),
('2015-05-27 02:54:34', '1', 'TEAPL1000-CNF', 165, 'bidon', '2015-05-27 02:54:34'),
('2015-05-27 02:54:34', '1', 'TEBBL1000-OCC', 187, 'bidon', '2015-05-27 02:54:34'),
('2015-05-27 02:54:34', '2', 'TEBBL1000-OCC', 71, 'bidon', '2015-05-27 02:54:34'),
('2015-05-27 02:56:36', '1', 'TEAPL1000-CNF', 178, 'bidon', '2015-05-27 02:56:36'),
('2015-05-27 02:56:36', '1', 'TEBBL1000-OCC', 197, 'bidon', '2015-05-27 02:56:36'),
('2015-05-27 02:56:36', '2', 'TEBBL1000-OCC', 80, 'bidon', '2015-05-27 02:56:36'),
('2015-05-27 12:36:12', '1', 'TEBBL1000-OCC', 196, 'bidon', '2015-05-27 12:36:12'),
('2015-05-28 01:21:31', '1', 'TEBBL1000-OCC', 195, 'bidon', '2015-05-28 01:21:31'),
('2015-05-28 01:27:24', '1', 'TEBBL1000-OCC', 194, 'bidon', '2015-05-28 01:27:24'),
('2015-05-29 15:54:01', '1', 'TEBBL1000-OCC', 188, 'bidon', '2015-05-29 15:54:01'),
('2015-05-29 15:54:31', '1', 'TEBBL1000-OCC', 186, 'bidon', '2015-05-29 15:54:31');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `position_zfw_reelle`
--
ALTER TABLE `position_zfw_reelle`
  ADD PRIMARY KEY (`date_archivage`,`ref_lieu_stockage`,`ref_produit`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
