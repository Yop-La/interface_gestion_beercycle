-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 29, 2015 at 12:16 
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `beezfw`
--

-- --------------------------------------------------------

--
-- Table structure for table `canal_de_distribution`
--

CREATE TABLE IF NOT EXISTS `canal_de_distribution` (
`ref_canal_distrib` int(11) NOT NULL,
  `libelle` varchar(50) DEFAULT NULL,
  `pays` varchar(25) DEFAULT NULL,
  `region` varchar(25) DEFAULT NULL,
  `ville` varchar(25) DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `ref_lieu_stockage_defaut` varchar(10) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `date_heure_maj` datetime DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `canal_de_distribution`
--

INSERT INTO `canal_de_distribution` (`ref_canal_distrib`, `libelle`, `pays`, `region`, `ville`, `adresse`, `ref_lieu_stockage_defaut`, `user_id`, `date_heure_maj`) VALUES
(1, 'boutique Kinshasa1', 'RDC', 'Kin', 'Kinshasa', NULL, '01', 'JRO', '2015-04-09 00:00:00'),
(2, 'internet1', 'RDC', NULL, NULL, NULL, '01', 'JRO', '2015-04-09 00:00:00'),
(3, 'boutique BRZ', 'Congo', 'Capitale', 'Brazzaville', NULL, '02', 'JRO', '2015-04-09 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `catalogue_produit`
--

CREATE TABLE IF NOT EXISTS `catalogue_produit` (
  `date_validité` datetime NOT NULL,
  `ref_produit` varchar(25) NOT NULL,
  `ref_Canal_distrib` varchar(10) NOT NULL,
  `code_devise` varchar(3) NOT NULL,
  `Prix` double DEFAULT '0',
  `user_id` varchar(10) DEFAULT NULL,
  `date_heure_maj` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
`ref_client` int(11) NOT NULL,
  `prénom` varchar(25) DEFAULT NULL,
  `nom` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tel1` varchar(25) DEFAULT NULL,
  `tel2` varchar(25) DEFAULT NULL,
  `adresse_liv` varchar(100) DEFAULT NULL,
  `ville_liv` varchar(25) DEFAULT NULL,
  `region_liv` varchar(25) DEFAULT NULL,
  `pays_liv` varchar(25) DEFAULT NULL,
  `adresse_fac` varchar(100) DEFAULT NULL,
  `ville_fac` varchar(25) DEFAULT NULL,
  `region_fac` varchar(25) DEFAULT NULL,
  `pays_fac` varchar(25) DEFAULT NULL,
  `cumul_qté_cmdée` int(11) DEFAULT NULL,
  `date_dern_cmde` datetime DEFAULT NULL,
  `nb_cmde` int(11) DEFAULT NULL,
  `commentaire` varchar(100) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `date_heure_maj` datetime DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=232 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`ref_client`, `prénom`, `nom`, `email`, `tel1`, `tel2`, `adresse_liv`, `ville_liv`, `region_liv`, `pays_liv`, `adresse_fac`, `ville_fac`, `region_fac`, `pays_fac`, `cumul_qté_cmdée`, `date_dern_cmde`, `nb_cmde`, `commentaire`, `user_id`, `date_heure_maj`) VALUES
(1, 'MANOUBIA', 'MANSOURI', NULL, NULL, NULL, '92 AVENUE ALBERT PETIT', 'BAGNEUX', NULL, 'FR', '92 AVENUE ALBERT PETIT', 'BAGNEUX', NULL, 'FR', 1, '2014-11-12 21:19:00', 1, NULL, NULL, NULL),
(2, 'Lalla', 'Samb', NULL, NULL, NULL, '1 RUE HENRI DESGRANGE', 'PARIS', NULL, 'FRA', '1 RUE HENRI DESGRANGE', 'PARIS', NULL, 'FRA', 1, '2014-11-12 22:45:00', 1, NULL, NULL, NULL),
(3, 'André', 'DELCELIER', NULL, NULL, NULL, '14 allee du colombier', 'LONGPONT SUR ORGE', NULL, 'France', '14 allee du colombier', 'LONGPONT SUR ORGE', NULL, 'France', 1, '2014-11-13 20:44:00', 1, NULL, NULL, NULL),
(4, 'Anne', 'Balladur', NULL, NULL, NULL, '138 avenue du président wilson', 'MONTREUIL', NULL, 'France', '138 avenue du président wilson', 'MONTREUIL', NULL, 'France', 1, '2014-11-14 17:11:00', 1, NULL, NULL, NULL),
(5, 'Yannig', 'Escoffier', NULL, NULL, NULL, '1 avenue du 41 ème régiment d''infanterie', 'RENNES', NULL, 'France', '1 avenue du 41 ème régiment d''infanterie', 'RENNES', NULL, 'France', 1, '2014-11-16 18:17:00', 1, NULL, NULL, NULL),
(6, 'Bixente', 'Fouillot', NULL, NULL, NULL, '2 chemin KUTUENIA', 'Arbonne', NULL, 'FRA', '2 chemin KUTUENIA', 'Arbonne', NULL, 'FRA', 2, '2014-11-17 18:39:00', 1, NULL, NULL, NULL),
(7, 'Philippine', 'Szydlowski', NULL, NULL, NULL, '4 rue de la sole', 'LA ROCHELLE', NULL, 'FRA', '4 rue de la sole', 'LA ROCHELLE', NULL, 'FRA', 1, '2014-11-18 10:50:00', 1, NULL, NULL, NULL),
(8, 'KHALED', 'THAMEUR', NULL, NULL, NULL, '8 ALLEE ETIENNE LAURENT', 'CLICHY SOUS BOIS', NULL, 'France', '8 ALLEE ETIENNE LAURENT', 'CLICHY SOUS BOIS', NULL, 'France', 1, '2014-11-18 16:34:00', 1, NULL, NULL, NULL),
(9, 'Jessy', 'Missatou', NULL, NULL, NULL, '49  Rue Roublot', 'Fontenay sous bois', NULL, 'France', '49  Rue Roublot', 'Fontenay sous bois', NULL, 'France', 1, '2014-11-18 20:44:00', 1, NULL, NULL, NULL),
(10, 'MOSTEFA', 'ATMANE', NULL, NULL, NULL, '19 RUE DE LA CHARRONNERIE', 'SAINT-DENIS', NULL, 'France', '19 RUE DE LA CHARRONNERIE', 'SAINT-DENIS', NULL, 'France', 1, '2014-11-19 20:04:00', 1, NULL, NULL, NULL),
(11, 'marine', 'combe', NULL, NULL, NULL, '5 rue des basses crozettes', 'valence', NULL, 'France', '5 rue des basses crozettes', 'valence', NULL, 'France', 1, '2014-11-20 04:10:00', 1, NULL, NULL, NULL),
(12, 'frederic', 'demolis', NULL, NULL, NULL, '1278 route de chainaz', 'ALBY sur Cheran', NULL, 'France', '1278 route de chainaz', 'ALBY sur Cheran', NULL, 'France', 1, '2014-11-20 10:44:00', 1, NULL, NULL, NULL),
(13, 'Hélène', 'de FILIPPO', NULL, NULL, NULL, '32 route de Kerozan', 'GUERANDE', NULL, 'FRA', '32 route de Kerozan', 'GUERANDE', NULL, 'FRA', 1, '2014-11-20 23:46:00', 1, NULL, NULL, NULL),
(14, 'Rachel', 'MOUSSELIN', NULL, NULL, NULL, '20 RUE DE LA PLAINE', 'PARIS', NULL, 'FRA', '20 RUE DE LA PLAINE', 'PARIS', NULL, 'FRA', 1, '2014-11-24 19:40:00', 1, NULL, NULL, NULL),
(15, 'Louise', 'BADANA', NULL, NULL, NULL, '15 rue de la république', 'NOISY LE GRAND', NULL, 'France', '15 rue de la république', 'NOISY LE GRAND', NULL, 'France', 1, '2014-07-23 23:01:00', 1, NULL, NULL, NULL),
(16, 'gilberte', 'brun', NULL, NULL, NULL, '4 rue du 6 aout 1944', 'chateau gontier', NULL, 'France', '4 rue du 6 aout 1944', 'chateau gontier', NULL, 'France', 1, '2014-07-23 21:16:00', 1, NULL, NULL, NULL),
(17, 'Juliette', 'Branciard', NULL, NULL, NULL, '4 CITE JANDELLE', 'PARIS', NULL, 'FRA', '4 CITE JANDELLE', 'PARIS', NULL, 'FRA', 1, '2014-07-24 13:53:00', 1, NULL, NULL, NULL),
(18, 'Alexia', 'Dubois', NULL, NULL, NULL, '3 place des marguilliers', 'Chatou', NULL, 'France', '3 place des marguilliers', 'Chatou', NULL, 'France', 1, '2014-07-25 14:30:00', 1, NULL, NULL, NULL),
(19, 'MORGANE', 'FREYTAG', NULL, NULL, NULL, '4 SQUARE RODIN', 'GRIGNY', NULL, 'FRA', '4 SQUARE RODIN', 'GRIGNY', NULL, 'FRA', 1, '2014-07-26 17:34:00', 1, NULL, NULL, NULL),
(20, 'herve', 'mesenbourg', NULL, NULL, NULL, '15 RUE DE LA BIEVRE', 'Bagneux', NULL, 'FRA', '15 RUE DE LA BIEVRE', 'Bagneux', NULL, 'FRA', 1, '2014-07-27 12:02:00', 1, NULL, NULL, NULL),
(21, 'JOSE', 'reboredo', NULL, NULL, NULL, '3 RUE VICTOR HAUSSONville', 'DRANCY', NULL, 'France', '3 RUE VICTOR HAUSSONville', 'DRANCY', NULL, 'France', 1, '2014-07-27 21:06:00', 1, NULL, NULL, NULL),
(22, 'Emma', 'BERNARDINI', NULL, NULL, NULL, '27 allée des pruniers', 'FURIANI', NULL, 'France', '27 allée des pruniers', 'FURIANI', NULL, 'France', 1, '2014-07-28 02:32:00', 1, NULL, NULL, NULL),
(23, 'Lise', 'Lepicier', NULL, NULL, NULL, '14 RUE SAINT AUBIN', 'ST REMY LA VARENNE', NULL, 'FRA', '14 RUE SAINT AUBIN', 'ST REMY LA VARENNE', NULL, 'FRA', 5, '2014-07-26 22:58:00', 3, NULL, NULL, NULL),
(24, 'Alexandre', 'Meriau', NULL, NULL, NULL, '84 rue Joseph Tahet', 'Indre', NULL, 'France', '84 rue Joseph Tahet', 'Indre', NULL, 'France', 1, '2014-07-28 14:03:00', 1, NULL, NULL, NULL),
(25, 'Lucie', 'Adam', NULL, NULL, NULL, '75 rue de la mairie', 'MOISville', NULL, 'FRA', '75 rue de la mairie', 'MOISville', NULL, 'FRA', 1, '2014-07-29 14:23:00', 1, NULL, NULL, NULL),
(26, 'Jean-Yves', 'ARROU', NULL, NULL, NULL, '1 RUE DES AJETS', 'STE SOULLE', NULL, 'FRA', '1 RUE DES AJETS', 'STE SOULLE', NULL, 'FRA', 1, '2014-07-29 15:39:00', 1, NULL, NULL, NULL),
(27, 'fabrice', 'tabourier', NULL, NULL, NULL, '58 RUE LUCIEN GUILLOU', 'Epinay Sur Seine', NULL, 'FRA', '58 RUE LUCIEN GUILLOU', 'Epinay Sur Seine', NULL, 'FRA', 1, '2014-07-29 19:56:00', 1, NULL, NULL, NULL),
(28, 'STEPHANE', 'LE-THI', NULL, NULL, NULL, '19 RUE DE L INDUSTRIE', 'MULHOUSE', NULL, 'FR', '19 RUE DE L INDUSTRIE', 'MULHOUSE', NULL, 'FR', 1, '2014-07-30 10:52:00', 1, NULL, NULL, NULL),
(29, 'jean-philippe', 'marchal', NULL, NULL, NULL, '13 rue de langres', 'chalindrey', NULL, 'France', '13 rue de langres', 'chalindrey', NULL, 'France', 1, '2014-07-30 13:05:00', 1, NULL, NULL, NULL),
(30, 'Patrick', 'TREVISIOL', NULL, NULL, NULL, '2 rue des litanies', 'PIBRAC', NULL, 'France', '2 rue des litanies', 'PIBRAC', NULL, 'France', 1, '2014-07-31 11:03:00', 1, NULL, NULL, NULL),
(31, 'Jean-Charles', 'De Bastos', NULL, NULL, NULL, '40 RUE CAMILLE PELLETAN', 'HOUILLES', NULL, 'FRA', '40 RUE CAMILLE PELLETAN', 'HOUILLES', NULL, 'FRA', 1, '2014-07-30 14:22:00', 1, NULL, NULL, NULL),
(32, 'Christelle', 'Murhula', NULL, NULL, NULL, '28 route de Corbeil', 'LE PLESSIS PATE', NULL, 'FRA', '28 route de Corbeil', 'LE PLESSIS PATE', NULL, 'FRA', 1, '2014-07-30 17:48:00', 1, NULL, NULL, NULL),
(33, 'Vincent', 'Dekyndt', NULL, NULL, NULL, '10 r de l''ornette', 'Abondant', NULL, 'France', '10 r de l''ornette', 'Abondant', NULL, 'France', 1, '2014-07-31 11:03:00', 1, NULL, NULL, NULL),
(34, 'GILLES', 'MAUPOME', NULL, NULL, NULL, '4 RUE D ANJOU', 'LOIRON', NULL, 'France', '4 RUE D ANJOU', 'LOIRON', NULL, 'France', 1, '2014-08-04 07:32:00', 1, NULL, NULL, NULL),
(35, 'Mélanie', 'Chiquet', NULL, NULL, NULL, '15 la carrée de l''ile gouere', 'Pontchâteau', NULL, 'France', '15 la carrée de l''ile gouere', 'Pontchâteau', NULL, 'France', 1, '2014-08-01 13:44:00', 1, NULL, NULL, NULL),
(36, 'anne', 'fradet', NULL, NULL, NULL, 'l''  alleu', 'lion  d'' angers', NULL, 'France', 'l''  alleu', 'lion  d'' angers', NULL, 'France', 1, '2014-07-30 17:34:00', 1, NULL, NULL, NULL),
(37, 'Mickael', 'Giboyau', NULL, NULL, NULL, '40 place George Lyssandre 3 étg 2 pt droite', 'Bondy', NULL, 'France', '40 place George Lyssandre 3 étg 2 pt droite', 'Bondy', NULL, 'France', 1, '2014-08-01 17:41:00', 1, NULL, NULL, NULL),
(38, 'FRANCK', 'DESIRE', NULL, NULL, NULL, '1 rue de bretagne', 'saint etienne du rouvray', NULL, 'France', '1 rue de bretagne', 'saint etienne du rouvray', NULL, 'France', 1, '2014-08-04 07:32:00', 1, NULL, NULL, NULL),
(39, 'Christelle', 'HANESSE', NULL, NULL, NULL, '8 rue de la Poterne', 'Verdun', NULL, 'France', '8 rue de la Poterne', 'Verdun', NULL, 'France', 1, '2014-08-01 20:11:00', 1, NULL, NULL, NULL),
(40, 'mickael', 'DENAT', NULL, NULL, NULL, 'le moulin', 'terraube', NULL, 'France', 'le moulin', 'terraube', NULL, 'France', 1, '2014-08-04 07:32:00', 1, NULL, NULL, NULL),
(41, 'Genty', 'Marie', NULL, NULL, NULL, '12 rue Mesnil', 'PARIS', NULL, 'FRA', '12 rue Mesnil', 'PARIS', NULL, 'FRA', 1, '2014-08-01 23:55:00', 1, NULL, NULL, NULL),
(42, 'Patrick', 'Tramicheck', NULL, NULL, NULL, '64 rue pierre. Corneille', 'LA  ROCHELLE', NULL, 'France', '64 rue pierre. Corneille', 'LA  ROCHELLE', NULL, 'France', 1, '2014-08-02 11:44:00', 1, NULL, NULL, NULL),
(43, 'Pedro', 'Sanchez', NULL, NULL, NULL, '4 impasse des myrtes', 'Marseillan', NULL, 'France', '4 impasse des myrtes', 'Marseillan', NULL, 'France', 1, '2014-08-03 10:00:00', 1, NULL, NULL, NULL),
(44, 'ADRIEN', 'GONCALVES', NULL, NULL, NULL, '38 ROUTE DE BLOIS', 'LES MONTILS', NULL, 'FR', '38 ROUTE DE BLOIS', 'LES MONTILS', NULL, 'FR', 1, '2014-08-03 12:10:00', 1, NULL, NULL, NULL),
(45, 'Veronique', 'Metrard', NULL, NULL, NULL, '30 RUE DU PETIT BOIS', 'STE GEMMES D ANDIGNE', NULL, 'FRA', '30 RUE DU PETIT BOIS', 'STE GEMMES D ANDIGNE', NULL, 'FRA', 1, '2014-08-04 07:32:00', 1, NULL, NULL, NULL),
(46, 'aline', 'michel', NULL, NULL, NULL, '42 ROUTE DE LA JOSERIE', 'LA HOUSSAYE BERANGER', NULL, 'FRA', '42 ROUTE DE LA JOSERIE', 'LA HOUSSAYE BERANGER', NULL, 'FRA', 1, '2014-08-03 17:34:00', 1, NULL, NULL, NULL),
(47, 'Stacy', 'Chatelain', NULL, NULL, NULL, '14 rue bremontier', 'Morcenx', NULL, 'France', '14 rue bremontier', 'Morcenx', NULL, 'France', 1, '2014-08-03 18:41:00', 1, NULL, NULL, NULL),
(48, 'Olivier', 'BOUISSONNIE', NULL, NULL, NULL, '5 rue Sainte Catherine', 'LYON', NULL, 'France', '5 rue Sainte Catherine', 'LYON', NULL, 'France', 1, '2014-08-04 07:32:00', 1, NULL, NULL, NULL),
(49, 'léo', 'dumay', NULL, NULL, NULL, '2 rue edmond flamand', 'paris', NULL, 'France', '2 rue edmond flamand', 'paris', NULL, 'France', 1, '2014-08-04 16:50:00', 1, NULL, NULL, NULL),
(50, 'bruno', 'cantiniau', NULL, NULL, NULL, '8 residence Atrium', 'Bavay', NULL, 'France', '8 residence Atrium', 'Bavay', NULL, 'France', 1, '2014-08-03 17:52:00', 1, NULL, NULL, NULL),
(51, 'Carole', 'Aubier', NULL, NULL, NULL, '124 RUE DU HAUT DU MUR', 'ST OUEN D ATTEZ', NULL, 'FRA', '124 RUE DU HAUT DU MUR', 'ST OUEN D ATTEZ', NULL, 'FRA', 1, '2014-08-03 18:26:00', 1, NULL, NULL, NULL),
(52, 'mathieu', 'dézéraud', NULL, NULL, NULL, '5 RUE PAUL REBEYROLLE', 'LE PALAIS SUR VIENNE', NULL, 'FRA', '5 RUE PAUL REBEYROLLE', 'LE PALAIS SUR VIENNE', NULL, 'FRA', 1, '2014-08-01 17:24:00', 1, NULL, NULL, NULL),
(53, 'jaques - Phillipe', 'hollaender', NULL, NULL, NULL, '9 place Michel de l''Hospital', 'Clermont Frerrand', NULL, 'France', '9 place Michel de l''Hospital', 'Clermont Frerrand', NULL, 'France', 1, '2014-08-04 14:50:00', 1, NULL, NULL, NULL),
(54, 'Florent', 'DELAUNAY', NULL, NULL, NULL, '7, mail Est', 'Pithiviers', NULL, 'France', '7, mail Est', 'Pithiviers', NULL, 'France', 1, '2014-08-04 21:07:00', 1, NULL, NULL, NULL),
(55, 'VIRGINIE', 'MOURLON', NULL, NULL, NULL, 'PLACE DE L''EGLISE', 'MONCAUT', NULL, 'France', 'PLACE DE L''EGLISE', 'MONCAUT', NULL, 'France', 1, '2014-08-05 08:17:00', 1, NULL, NULL, NULL),
(56, 'Patrick', 'LE', NULL, NULL, NULL, '16 rue des Vignes Georget', 'FLAGY', NULL, 'France', '16 rue des Vignes Georget', 'FLAGY', NULL, 'France', 1, '2014-08-05 10:52:00', 1, NULL, NULL, NULL),
(57, 'philippe', 'borel', NULL, NULL, NULL, '1 rue des marronniers', 'voiron', NULL, 'France', '1 rue des marronniers', 'voiron', NULL, 'France', 1, '2014-08-05 12:35:00', 1, NULL, NULL, NULL),
(58, 'sylvie', 'dirat', NULL, NULL, NULL, 'au village', 'saint creac', NULL, 'France', 'au village', 'saint creac', NULL, 'France', 1, '2014-08-06 14:19:00', 1, NULL, NULL, NULL),
(59, 'DOMINIQUE', 'CHATELAIN', NULL, NULL, NULL, '3 RUE MIROUX', 'CLARY', NULL, 'FR', '3 RUE MIROUX', 'CLARY', NULL, 'FR', 1, '2014-08-05 13:28:00', 1, NULL, NULL, NULL),
(60, 'Marin', 'BARGAN', NULL, NULL, NULL, '24 rue Hector Berlioz', 'villeurbanne', NULL, 'France', '24 rue Hector Berlioz', 'villeurbanne', NULL, 'France', 1, '2014-08-06 14:19:00', 1, NULL, NULL, NULL),
(61, 'bénédicte', 'jecker', NULL, NULL, NULL, 'cave jean geiler', 'ingersheim', NULL, 'France', 'cave jean geiler', 'ingersheim', NULL, 'France', 1, '2014-08-05 22:21:00', 1, NULL, NULL, NULL),
(62, 'Juliette', 'Laino', NULL, NULL, NULL, '38 avenue georges clemenceau', 'Le mont dore', NULL, 'France', '38 avenue georges clemenceau', 'Le mont dore', NULL, 'France', 1, '2014-08-06 14:19:00', 1, NULL, NULL, NULL),
(63, 'PASCAL', 'GORCE', NULL, NULL, NULL, '15 RUE LA FONTAINE', 'RICHARDMENIL', NULL, 'FRA', '15 RUE LA FONTAINE', 'RICHARDMENIL', NULL, 'FRA', 1, '2014-08-05 23:28:00', 1, NULL, NULL, NULL),
(64, 'anne', 'montassier', NULL, NULL, NULL, '13 AVENUE DE LA LIBERTE', 'LOCHES', NULL, 'FRA', '13 AVENUE DE LA LIBERTE', 'LOCHES', NULL, 'FRA', 1, '2014-08-07 13:18:00', 1, NULL, NULL, NULL),
(65, 'stephanie', 'lechevestrier', NULL, NULL, NULL, '8 RUE DU RHIN', 'ROSNY SOUS BOIS', NULL, 'FRA', '8 RUE DU RHIN', 'ROSNY SOUS BOIS', NULL, 'FRA', 1, '2014-08-06 19:04:00', 1, NULL, NULL, NULL),
(66, 'Malvina', 'Martin', NULL, NULL, NULL, '1 rue du puits', 'Vercel ville dieu le camp', NULL, 'France', '1 rue du puits', 'Vercel ville dieu le camp', NULL, 'France', 1, '2014-08-06 22:47:00', 1, NULL, NULL, NULL),
(67, 'tristan', 'huet', NULL, NULL, NULL, '7 rue du clos de l''isle', 'tacoignières', NULL, 'France', '7 rue du clos de l''isle', 'tacoignières', NULL, 'France', 1, '2014-08-06 17:04:00', 1, NULL, NULL, NULL),
(68, 'Romain', 'Barrau', NULL, NULL, NULL, '6 rue des sables', 'Legé', NULL, 'France', '6 rue des sables', 'Legé', NULL, 'France', 1, '2014-08-06 21:18:00', 1, NULL, NULL, NULL),
(69, 'Alexandre', 'Besombes', NULL, NULL, NULL, '841 rte de la rosiere', 'Estrablin', NULL, 'France', '841 rte de la rosiere', 'Estrablin', NULL, 'France', 1, '2014-08-07 13:18:00', 1, NULL, NULL, NULL),
(70, 'AFIDA', 'BOUGOUFA', NULL, NULL, NULL, '1 PASSAGE FEUILLAT', 'LYON', NULL, 'FR', '1 PASSAGE FEUILLAT', 'LYON', NULL, 'FR', 1, '2014-08-07 13:13:00', 1, NULL, NULL, NULL),
(71, 'ozias', 'seda', NULL, NULL, NULL, '37 rue frederic', 'Mouy', NULL, 'France', '37 rue frederic', 'Mouy', NULL, 'France', 1, '2014-08-07 17:18:00', 1, NULL, NULL, NULL),
(72, 'Amie', 'Camara', NULL, NULL, NULL, '5 Rue Maryse hilsz', 'Paris', NULL, 'France', '5 Rue Maryse hilsz', 'Paris', NULL, 'France', 1, '2014-08-07 22:31:00', 1, NULL, NULL, NULL),
(73, 'nadine', 'pageot', NULL, NULL, NULL, '2 impasse des vergers', 'la chapelle st martin en ', NULL, 'France', '2 impasse des vergers', 'la chapelle st martin en ', NULL, 'France', 1, '2014-08-11 08:33:00', 1, NULL, NULL, NULL),
(74, 'Line', 'Autruc', NULL, NULL, NULL, '10 rue circulaire Henri Jousseaume', 'villemomble', NULL, 'France', '10 rue circulaire Henri Jousseaume', 'villemomble', NULL, 'France', 1, '2014-08-08 20:02:00', 1, NULL, NULL, NULL),
(75, 'BRUNO', 'SAUVAL', NULL, NULL, NULL, '1 RUE PRINCIPALE', 'PIENNES-ONvilleRS', NULL, 'France', '1 RUE PRINCIPALE', 'PIENNES-ONvilleRS', NULL, 'France', 1, '2014-08-11 08:33:00', 1, NULL, NULL, NULL),
(76, 'Sarl P&M', 'de PUYMORIN Richard', NULL, NULL, NULL, '41 avenue de Camargue', 'Générac', NULL, 'France', '41 avenue de Camargue', 'Générac', NULL, 'France', 1, '2014-08-09 17:38:00', 1, NULL, NULL, NULL),
(77, 'Claire', 'Muller', NULL, NULL, NULL, '78 C avenue Albert Gleizes', 'SAINT REMY DE PCE', NULL, 'France', '78 C avenue Albert Gleizes', 'SAINT REMY DE PCE', NULL, 'France', 1, '2014-08-11 08:33:00', 1, NULL, NULL, NULL),
(78, 'nicole', 'pugnetti', NULL, NULL, NULL, 'le bourg', 'VINDRAC ALAYRAC', NULL, 'FRA', 'le bourg', 'VINDRAC ALAYRAC', NULL, 'FRA', 1, '2014-08-11 08:33:00', 1, NULL, NULL, NULL),
(79, 'olivier ou sylvie', 'ropert', NULL, NULL, NULL, 'résidence des', 'MOREAC', NULL, 'France', 'résidence des', 'MOREAC', NULL, 'France', 1, '2014-08-11 09:32:00', 1, NULL, NULL, NULL),
(80, 'Julien', 'Carneiro', NULL, NULL, NULL, '69 Clos des champs', 'Saint Cyr sur Menthon', NULL, 'France', '69 Clos des champs', 'Saint Cyr sur Menthon', NULL, 'France', 1, '2014-08-11 12:34:00', 1, NULL, NULL, NULL),
(81, 'isabelle', 'madera', NULL, NULL, NULL, '1 RUE DE JUDEE', 'chef boutonne', NULL, 'France', '1 RUE DE JUDEE', 'chef boutonne', NULL, 'France', 1, '2014-08-12 08:52:00', 1, NULL, NULL, NULL),
(82, 'marc', 'walter', NULL, NULL, NULL, '30 rue de levoncourt', 'courtavon', NULL, 'France', '30 rue de levoncourt', 'courtavon', NULL, 'France', 1, '2014-08-12 16:40:00', 1, NULL, NULL, NULL),
(83, 'CHRISTINE', 'VIELFAURE', NULL, NULL, NULL, '59 BOULEVARD PIERRE MENARD', 'MARSEILLE', NULL, 'FR', '59 BOULEVARD PIERRE MENARD', 'MARSEILLE', NULL, 'FR', 1, '2014-08-12 19:46:00', 1, NULL, NULL, NULL),
(84, 'berangere', 'lecureuil', NULL, NULL, NULL, '8 rue d''afrique', 'st amand montrond', NULL, 'France', '8 rue d''afrique', 'st amand montrond', NULL, 'France', 1, '2014-08-13 16:34:00', 1, NULL, NULL, NULL),
(85, 'YOUSSEF', 'BOUAOUAM', NULL, NULL, NULL, 'LOTISSEMENT LE HUREAU', 'XEUILLEY', NULL, 'FR', 'LOTISSEMENT LE HUREAU', 'XEUILLEY', NULL, 'FR', 1, '2014-08-13 16:34:00', 1, NULL, NULL, NULL),
(86, 'Thimeo', 'Borel', NULL, NULL, NULL, '2', 'villard saint pancrace', NULL, 'France', '2', 'villard saint pancrace', NULL, 'France', 1, '2014-08-12 20:31:00', 1, NULL, NULL, NULL),
(87, 'ANNIE', 'LACHATRE', NULL, NULL, NULL, '33 RUE JASMIN', 'VOISINS LE BRETONNEUX', NULL, 'FRA', '33 RUE JASMIN', 'VOISINS LE BRETONNEUX', NULL, 'FRA', 1, '2014-08-12 19:43:00', 1, NULL, NULL, NULL),
(88, 'samuel', 'mottet', NULL, NULL, NULL, '21 AVENUE DU SAUT DU LOUP', 'La Celle St Cloud', NULL, 'FRA', '21 AVENUE DU SAUT DU LOUP', 'La Celle St Cloud', NULL, 'FRA', 1, '2014-08-13 14:49:00', 1, NULL, NULL, NULL),
(89, 'anne', 'du quellennec', NULL, NULL, NULL, '12 rue de l''Aspirant Dargent', 'Levallois', NULL, 'France', '12 rue de l''Aspirant Dargent', 'Levallois', NULL, 'France', 1, '2014-08-13 15:55:00', 1, NULL, NULL, NULL),
(90, 'francois', 'PEREZ', NULL, NULL, NULL, '2 place albert fontanieu', 'aimargues', NULL, 'France', '2 place albert fontanieu', 'aimargues', NULL, 'France', 1, '2014-08-14 13:33:00', 1, NULL, NULL, NULL),
(91, 'Mathieu', 'Chapellet Mathieu', NULL, NULL, NULL, '29 rue des grillons', 'Frontignan', NULL, 'France', '29 rue des grillons', 'Frontignan', NULL, 'France', 1, '2014-08-18 14:48:00', 1, NULL, NULL, NULL),
(92, 'benoit', 'letellier', NULL, NULL, NULL, '27 rue cornic', 'RENNES', NULL, 'France', '27 rue cornic', 'RENNES', NULL, 'France', 1, '2014-08-18 14:48:00', 1, NULL, NULL, NULL),
(93, 'Erwann', 'Le Naour', NULL, NULL, NULL, '7 rue de l''onglet', 'Cherbourg-Octeville', NULL, 'France', '7 rue de l''onglet', 'Cherbourg-Octeville', NULL, 'France', 1, '2014-08-18 14:48:00', 1, NULL, NULL, NULL),
(94, 'Francis', 'Raveau', NULL, NULL, NULL, '19 rue verte', 'Rosheim', NULL, 'France', '19 rue verte', 'Rosheim', NULL, 'France', 1, '2014-08-18 12:56:00', 1, NULL, NULL, NULL),
(95, 'Maria', 'de Mondesir', NULL, NULL, NULL, '4 charrière du commerce', 'AGON COUTAINville', NULL, 'FRA', '4 charrière du commerce', 'AGON COUTAINville', NULL, 'FRA', 1, '2014-08-19 19:17:00', 1, NULL, NULL, NULL),
(96, 'Lenae', 'Watson', NULL, NULL, NULL, '12 RUE JEAN BAPTISTE CLEMENT', 'BAGNOLET', NULL, 'FRA', '12 RUE JEAN BAPTISTE CLEMENT', 'BAGNOLET', NULL, 'FRA', 1, '2014-08-20 20:43:00', 1, NULL, NULL, NULL),
(97, 'FATIMA', 'AFELLAH', NULL, NULL, NULL, '2 RUE JOSEPH RIGAULT', 'GROSLAY', NULL, 'FR', '2 RUE JOSEPH RIGAULT', 'GROSLAY', NULL, 'FR', 1, '2014-08-21 01:19:00', 1, NULL, NULL, NULL),
(98, 'Guillaume', 'Son', NULL, NULL, NULL, '84 rue clément ader', 'bretigny sur orge', NULL, 'France', '84 rue clément ader', 'bretigny sur orge', NULL, 'France', 1, '2014-08-26 11:18:00', 1, NULL, NULL, NULL),
(99, 'BRICE', 'PASSAROTTO', NULL, NULL, NULL, 'le creux de blanzon', 'saint victor', NULL, 'FRA', 'le creux de blanzon', 'saint victor', NULL, 'FRA', 1, '2014-08-23 15:25:00', 1, NULL, NULL, NULL),
(100, 'pascal', 'broquet', NULL, NULL, NULL, '18 rue du clos des noyers', 'maisons alfort', NULL, 'France', '18 rue du clos des noyers', 'maisons alfort', NULL, 'France', 1, '2014-08-26 14:32:00', 1, NULL, NULL, NULL),
(101, 'dominique', 'ierardi', NULL, NULL, NULL, '152 route des quinsoun', 'calas', NULL, 'France', '152 route des quinsoun', 'calas', NULL, 'France', 1, '2014-08-26 17:24:00', 1, NULL, NULL, NULL),
(102, 'Marion', 'Brillault', NULL, NULL, NULL, '14 B RUE JUILLET', 'PARIS', NULL, 'FRA', '14 B RUE JUILLET', 'PARIS', NULL, 'FRA', 1, '2014-08-27 21:19:00', 1, NULL, NULL, NULL),
(103, 'ZUZANA', 'DUDASOVA', NULL, NULL, NULL, '45 CLOS DE BOSSE', 'VILLARS COLMARS', NULL, 'FR', '45 CLOS DE BOSSE', 'VILLARS COLMARS', NULL, 'FR', 1, '2014-08-27 21:19:00', 1, NULL, NULL, NULL),
(104, 'Gilles', 'cohen', NULL, NULL, NULL, '9 bd 1830', 'Narbonne', NULL, 'France', '9 bd 1830', 'Narbonne', NULL, 'France', 1, '2014-08-27 08:11:00', 1, NULL, NULL, NULL),
(105, 'camille', 'soubotine', NULL, NULL, NULL, '7 rue de l''essonne', 'Ballancourt', NULL, 'France', '7 rue de l''essonne', 'Ballancourt', NULL, 'France', 1, '2014-08-27 12:09:00', 1, NULL, NULL, NULL),
(106, 'ines', 'DE FEYDEAU', NULL, NULL, NULL, '23 rue Maréchal Foch', 'CHERBOURG OCTEville', NULL, 'FRA', '23 rue Maréchal Foch', 'CHERBOURG OCTEville', NULL, 'FRA', 1, '2014-08-27 11:12:00', 1, NULL, NULL, NULL),
(107, 'rose', 'sitrougne', NULL, NULL, NULL, '8 rue de recur', 'la force', NULL, 'France', '8 rue de recur', 'la force', NULL, 'France', 1, '2014-08-27 14:19:00', 1, NULL, NULL, NULL),
(108, 'CORNELIA', 'ZOUIOUECHE', NULL, NULL, NULL, '271 rue du quesne', 'MARCQ EN BAROEUL', NULL, 'FRA', '271 rue du quesne', 'MARCQ EN BAROEUL', NULL, 'FRA', 1, '2014-08-27 21:19:00', 1, NULL, NULL, NULL),
(109, 'sabrina', 'ledet', NULL, NULL, NULL, '19 rue toulouse lautrec', 'calais', NULL, 'France', '19 rue toulouse lautrec', 'calais', NULL, 'France', 1, '2014-08-27 21:19:00', 1, NULL, NULL, NULL),
(110, 'mohamed', 'hammich', NULL, NULL, NULL, '12 a rue du champs de mai', 'aussillon', NULL, 'France', '12 a rue du champs de mai', 'aussillon', NULL, 'France', 1, '2014-08-27 15:56:00', 1, NULL, NULL, NULL),
(111, 'Inès', 'Ksantini', NULL, NULL, NULL, '156 boulevard marceau guillot', 'ARGENTEUIL', NULL, 'FRA', '156 boulevard marceau guillot', 'ARGENTEUIL', NULL, 'FRA', 1, '2014-08-27 17:47:00', 1, NULL, NULL, NULL),
(112, 'JODDY', 'MARECHAUX', NULL, NULL, NULL, '7 PASSAGE DUBOIS', 'PARIS', NULL, 'FR', '7 PASSAGE DUBOIS', 'PARIS', NULL, 'FR', 1, '2014-09-02 11:21:00', 1, NULL, NULL, NULL),
(113, 'anthony', 'luis', NULL, NULL, NULL, '7 rue de la tuillerie', 'poigny', NULL, 'France', '7 rue de la tuillerie', 'poigny', NULL, 'France', 1, '2014-08-29 13:08:00', 1, NULL, NULL, NULL),
(114, 'benjamin', 'rouvreault', NULL, NULL, NULL, '15 rue de la periniere', 'ANTOIGNÉ', NULL, 'France', '15 rue de la periniere', 'ANTOIGNÉ', NULL, 'France', 1, '2014-09-02 11:21:00', 1, NULL, NULL, NULL),
(115, 'Mohamed', 'M''HAMDI', NULL, NULL, NULL, '14 rue de l''aunette', 'ATHIS MONS', NULL, 'France', '14 rue de l''aunette', 'ATHIS MONS', NULL, 'France', 1, '2014-08-31 19:01:00', 1, NULL, NULL, NULL),
(116, 'Fabrice', 'Carchi', NULL, NULL, NULL, '8d rue de moulin cuzieu', 'Lorette', NULL, 'FRA', '8d rue de moulin cuzieu', 'Lorette', NULL, 'FRA', 1, '2014-08-29 21:16:00', 1, NULL, NULL, NULL),
(117, 'Dana', 'Geanta', NULL, NULL, NULL, 'Le vieux moulin centuri port', 'centuri', NULL, 'FRA', 'Le vieux moulin centuri port', 'centuri', NULL, 'FRA', 1, '2014-09-02 11:21:00', 1, NULL, NULL, NULL),
(118, 'Thomas', 'Ramon', NULL, NULL, NULL, '2 place des martyrs de l''occupation', 'CLICHY', NULL, 'FRA', '2 place des martyrs de l''occupation', 'CLICHY', NULL, 'FRA', 1, '2014-08-29 18:00:00', 1, NULL, NULL, NULL),
(119, 'LUC', 'REAU', NULL, NULL, NULL, '109 RUE DU 11 OCTOBRE', 'ST JEAN DE LA RUELLE', NULL, 'FRA', '109 RUE DU 11 OCTOBRE', 'ST JEAN DE LA RUELLE', NULL, 'FRA', 1, '2014-09-02 11:21:00', 1, NULL, NULL, NULL),
(120, 'nathalie', 'ISLAHEN', NULL, NULL, NULL, '9 bd de la prairie au duc', 'NANTES', NULL, 'France', '9 bd de la prairie au duc', 'NANTES', NULL, 'France', 1, '2014-09-02 11:21:00', 1, NULL, NULL, NULL),
(121, 'claude', 'baltzli', NULL, NULL, NULL, '132a rue des chataigniers', 'ernolsheim', NULL, 'France', '132a rue des chataigniers', 'ernolsheim', NULL, 'France', 1, '2014-09-02 11:21:00', 1, NULL, NULL, NULL),
(122, 'eric', 'castaing', NULL, NULL, NULL, 'les veyrets', 'izeron', NULL, 'France', 'les veyrets', 'izeron', NULL, 'France', 1, '2014-09-01 21:43:00', 1, NULL, NULL, NULL),
(123, 'MYLENE', 'GRIESS', NULL, NULL, NULL, '6 AVENUE D IENA', 'PARIS', NULL, 'FRA', '6 AVENUE D IENA', 'PARIS', NULL, 'FRA', 1, '2014-09-02 22:03:00', 1, NULL, NULL, NULL),
(124, 'morgane', 'vivien', NULL, NULL, NULL, 'Parc de la francophonie avenue jean monnet', 'La rochelle', NULL, 'France', 'Parc de la francophonie avenue jean monnet', 'La rochelle', NULL, 'France', 1, '2014-09-05 10:03:00', 1, NULL, NULL, NULL),
(125, 'Stéphane', 'Choisie', NULL, NULL, NULL, '18 rue des robinettes', 'Eaubonne', NULL, 'France', '18 rue des robinettes', 'Eaubonne', NULL, 'France', 1, '2014-09-05 10:03:00', 1, NULL, NULL, NULL),
(126, 'STEPHANIE', 'POUTIGNAT', NULL, NULL, NULL, 'LIEU DIT AUCHERAND', 'ST VERAND', NULL, 'FRA', 'LIEU DIT AUCHERAND', 'ST VERAND', NULL, 'FRA', 1, '2014-09-04 21:58:00', 1, NULL, NULL, NULL),
(127, 'Jean-Marc', 'Hénault', NULL, NULL, NULL, '16 Route dela Briqueterie', 'Pornichet', NULL, 'France', '16 Route dela Briqueterie', 'Pornichet', NULL, 'France', 1, '2014-09-04 22:32:00', 1, NULL, NULL, NULL),
(128, 'Marjorie', 'Gilgemann', NULL, NULL, NULL, '205 rue du Puits Sainte Stéphanie', 'SCHOENECK', NULL, 'France', '205 rue du Puits Sainte Stéphanie', 'SCHOENECK', NULL, 'France', 1, '2014-09-04 22:37:00', 1, NULL, NULL, NULL),
(129, 'Sophie', 'Fernandez', NULL, NULL, NULL, '4 bis rue Guillaume Achille Vivier', 'Nogent-sur-Marne', NULL, 'France', '4 bis rue Guillaume Achille Vivier', 'Nogent-sur-Marne', NULL, 'France', 1, '2014-09-04 22:31:00', 1, NULL, NULL, NULL),
(130, 'dominique', 'casamarta', NULL, NULL, NULL, '3 marines de pietrosella', 'pietrosella', NULL, 'France', '3 marines de pietrosella', 'pietrosella', NULL, 'France', 1, '2014-09-04 22:45:00', 1, NULL, NULL, NULL),
(131, 'stéphanie', 'jaeghers', NULL, NULL, NULL, '1651 avenue de la pompignane', 'MONTPELLIER', NULL, 'France', '1651 avenue de la pompignane', 'MONTPELLIER', NULL, 'France', 1, '2014-09-05 00:13:00', 1, NULL, NULL, NULL),
(132, 'Ayoub', 'SOURY', NULL, NULL, NULL, '22 Chemin du THON', 'Valence', NULL, 'France', '22 Chemin du THON', 'Valence', NULL, 'France', 1, '2014-09-05 12:31:00', 1, NULL, NULL, NULL),
(133, 'michel', 'baudry', NULL, NULL, NULL, '14 rue de la colonne', 'LES BROUZILS', NULL, 'France', '14 rue de la colonne', 'LES BROUZILS', NULL, 'France', 1, '2014-09-05 12:57:00', 1, NULL, NULL, NULL),
(134, 'patricia', 'perrin', NULL, NULL, NULL, 'Bt C les pleiades ave Paul Giacobbi', 'Bastia', NULL, 'France', 'Bt C les pleiades ave Paul Giacobbi', 'Bastia', NULL, 'France', 1, '2014-09-05 15:56:00', 1, NULL, NULL, NULL),
(135, 'Benjamin', 'Caras', NULL, NULL, NULL, '41 rue du commerce', 'Vougy', NULL, 'France', '41 rue du commerce', 'Vougy', NULL, 'France', 1, '2014-09-05 18:50:00', 1, NULL, NULL, NULL),
(136, 'Quentin', 'FLAHAUT', NULL, NULL, NULL, '10 rue des soupirants', 'CALAIS', NULL, 'France', '10 rue des soupirants', 'CALAIS', NULL, 'France', 1, '2014-09-05 19:47:00', 1, NULL, NULL, NULL),
(137, 'laurence', 'housiaux', NULL, NULL, NULL, '51 rue beaurepaire', 'wattrelos', NULL, 'France', '51 rue beaurepaire', 'wattrelos', NULL, 'France', 1, '2014-09-07 20:34:00', 1, NULL, NULL, NULL),
(138, 'Kévin', 'PAYEN', NULL, NULL, NULL, '19 rue La Gazaie', 'La Gacilly', NULL, 'France', '19 rue La Gazaie', 'La Gacilly', NULL, 'France', 1, '2014-09-07 20:34:00', 1, NULL, NULL, NULL),
(139, 'Dominique', 'LACAVE', NULL, NULL, NULL, '475 chemin du Flamand', 'TARTAS', NULL, 'France', '475 chemin du Flamand', 'TARTAS', NULL, 'France', 1, '2014-09-05 23:38:00', 1, NULL, NULL, NULL),
(140, 'patrick', 'povolny', NULL, NULL, NULL, '2, place Eugène Thomas', 'Noisy le Grand', NULL, 'France', '2, place Eugène Thomas', 'Noisy le Grand', NULL, 'France', 1, '2014-09-06 09:40:00', 1, NULL, NULL, NULL),
(141, 'Delphine', 'Rosain', NULL, NULL, NULL, '30 rue lorenzaccio', 'Grenoble', NULL, 'France', '30 rue lorenzaccio', 'Grenoble', NULL, 'France', 1, '2014-09-06 12:27:00', 1, NULL, NULL, NULL),
(142, 'marilyne', 'meriaux', NULL, NULL, NULL, '6 rue des leups', 'vivieres', NULL, 'France', '6 rue des leups', 'vivieres', NULL, 'France', 1, '2014-09-06 15:26:00', 1, NULL, NULL, NULL),
(143, 'jean-marc', 'massenet', NULL, NULL, NULL, '1 rue des cavaliers', 'wissembourg', NULL, 'France', '1 rue des cavaliers', 'wissembourg', NULL, 'France', 1, '2014-09-07 20:34:00', 1, NULL, NULL, NULL),
(144, 'ludovic', 'DESESTRET', NULL, NULL, NULL, 'quartier villeplat', 'montvendre', NULL, 'France', 'quartier villeplat', 'montvendre', NULL, 'France', 1, '2014-09-07 20:34:00', 1, NULL, NULL, NULL),
(145, 'LUDOVIC', 'HENRY', NULL, NULL, NULL, '3 RUE DU TACOT', 'CERRE LES NOROY', NULL, 'FR', '3 RUE DU TACOT', 'CERRE LES NOROY', NULL, 'FR', 1, '2014-09-06 20:24:00', 1, NULL, NULL, NULL),
(146, 'Régine', 'Klein', NULL, NULL, NULL, '4 rue Saint-Nicolas', 'Voegtlinshoffen', NULL, 'France', '4 rue Saint-Nicolas', 'Voegtlinshoffen', NULL, 'France', 1, '2014-09-07 09:58:00', 1, NULL, NULL, NULL),
(147, 'YOKO', 'NGUYEN', NULL, NULL, NULL, '7 rue des Cottages', 'Strasbourg', NULL, 'France', '7 rue des Cottages', 'Strasbourg', NULL, 'France', 1, '2014-09-07 10:06:00', 1, NULL, NULL, NULL),
(148, 'line', 'Lebeau', NULL, NULL, NULL, 'LIEU DIT LA MENARDIERE', 'BRESSUIRE', NULL, 'FRA', 'LIEU DIT LA MENARDIERE', 'BRESSUIRE', NULL, 'FRA', 1, '2014-09-07 15:15:00', 1, NULL, NULL, NULL),
(149, 'rachid', 'tiab', NULL, NULL, NULL, '2 rue gustave courbet', 'evry', NULL, 'France', '2 rue gustave courbet', 'evry', NULL, 'France', 1, '2014-09-07 16:32:00', 1, NULL, NULL, NULL),
(150, 'Eric', 'Mugnier', NULL, NULL, NULL, 'EY - tour First', 'Courbevoie', NULL, 'France', 'EY - tour First', 'Courbevoie', NULL, 'France', 1, '2014-09-07 18:32:00', 1, NULL, NULL, NULL),
(151, 'MARIE FRANCE', 'BARREAU', NULL, NULL, NULL, '9 LES GRANDES VIGNES', 'LES PEINTURES', NULL, 'France', '9 LES GRANDES VIGNES', 'LES PEINTURES', NULL, 'France', 1, '2014-09-07 21:32:00', 1, NULL, NULL, NULL),
(152, 'ALEXANDRA', 'BAPTISTE', NULL, NULL, NULL, '7 RUE DE LA REPUBLIQUE', 'ORCHAMPS', NULL, 'FR', '7 RUE DE LA REPUBLIQUE', 'ORCHAMPS', NULL, 'FR', 1, '2014-09-07 23:00:00', 1, NULL, NULL, NULL),
(153, 'pierre', 'leveille', NULL, NULL, NULL, '15 village de l''église', 'briqueboscq', NULL, 'France', '15 village de l''église', 'briqueboscq', NULL, 'France', 1, '2014-09-07 23:55:00', 1, NULL, NULL, NULL),
(154, 'Claire', 'Lalande', NULL, NULL, NULL, '8 impasse victor schoelcher', 'Saint jean de braye', NULL, 'France', '8 impasse victor schoelcher', 'Saint jean de braye', NULL, 'France', 1, '2014-09-08 09:03:00', 1, NULL, NULL, NULL),
(155, 'Claire', 'Tallon', NULL, NULL, NULL, 'Le Haut du Jeu', 'Le Jeu', NULL, 'FRA', 'Le Haut du Jeu', 'Le Jeu', NULL, 'FRA', 1, '2014-09-08 12:04:00', 1, NULL, NULL, NULL),
(156, 'CHRISTIAN', 'CANET', NULL, NULL, NULL, '18 RUE DES GRANDS MOULINS', 'COULOUTRE', NULL, 'FRA', '18 RUE DES GRANDS MOULINS', 'COULOUTRE', NULL, 'FRA', 1, '2014-09-08 12:04:00', 1, NULL, NULL, NULL),
(157, 'CHRISTOPHE', 'LUIS', NULL, NULL, NULL, '11 RUE DE PARIS', 'BILLY MONTIGNY', NULL, 'FR', '11 RUE DE PARIS', 'BILLY MONTIGNY', NULL, 'FR', 1, '2014-09-06 17:15:00', 1, NULL, NULL, NULL),
(158, 'THIBAUT', 'MEYER', NULL, NULL, NULL, '21 RUE DES PRETRES', 'ROUFFACH', NULL, 'FR', '21 RUE DES PRETRES', 'ROUFFACH', NULL, 'FR', 1, '2014-09-07 10:58:00', 1, NULL, NULL, NULL),
(159, 'Camille', 'Galay', NULL, NULL, NULL, '1 rue du petit port', 'DURTAL', NULL, 'France', '1 rue du petit port', 'DURTAL', NULL, 'France', 1, '2014-09-07 19:27:00', 1, NULL, NULL, NULL),
(160, 'FLORIAN', 'LACHENMAIER', NULL, NULL, NULL, '6 ROUTE DE SAINTE MARIE AUX MINES', 'SELESTAT', NULL, 'FR', '6 ROUTE DE SAINTE MARIE AUX MINES', 'SELESTAT', NULL, 'FR', 1, '2014-09-07 17:46:00', 1, NULL, NULL, NULL),
(161, 'Damien', 'SARTHOU', NULL, NULL, NULL, '30 Q Rue des Petouses', 'ISTRES', NULL, 'France', '30 Q Rue des Petouses', 'ISTRES', NULL, 'France', 1, '2014-09-07 19:06:00', 1, NULL, NULL, NULL),
(162, 'BERNADETTE', 'CLAIR', NULL, NULL, NULL, '7 RESIDENCE LE NOROIT', 'LANTON', NULL, 'FR', '7 RESIDENCE LE NOROIT', 'LANTON', NULL, 'FR', 1, '2014-09-07 11:31:00', 1, NULL, NULL, NULL),
(163, 'FREDERIC', 'BOUTIN', NULL, NULL, NULL, '1989 RUE GEORGES GUYNEMERE', 'PRUNIERS EN SOLOGNE', NULL, 'FR', '1989 RUE GEORGES GUYNEMERE', 'PRUNIERS EN SOLOGNE', NULL, 'FR', 1, '2014-09-08 12:11:00', 1, NULL, NULL, NULL),
(164, 'Mélanie', 'LEGOUX', NULL, NULL, NULL, '6 B RUE SOLFERINO', 'AUBERVILLIERS', NULL, 'FRA', '6 B RUE SOLFERINO', 'AUBERVILLIERS', NULL, 'FRA', 1, '2014-09-06 18:30:00', 1, NULL, NULL, NULL),
(165, 'gael', 'castiglione', NULL, NULL, NULL, '67, boulevard des alpes', 'marseille', NULL, 'France', '67, boulevard des alpes', 'marseille', NULL, 'France', 1, '2014-09-08 11:34:00', 1, NULL, NULL, NULL),
(166, 'ASMA', 'LAOUAR', NULL, NULL, NULL, '16 RUE ALBERT CAMUS', 'ORLEANS', NULL, 'FR', '16 RUE ALBERT CAMUS', 'ORLEANS', NULL, 'FR', 1, '2014-09-08 13:53:00', 1, NULL, NULL, NULL),
(167, 'JEAN MARC', 'BERNE', NULL, NULL, NULL, '7 ALLEE DES BLEUETS', 'BEAUFORT EN VALLEE', NULL, 'FR', '7 ALLEE DES BLEUETS', 'BEAUFORT EN VALLEE', NULL, 'FR', 1, '2014-09-08 14:01:00', 1, NULL, NULL, NULL),
(168, 'py', 'de lamarliere', NULL, NULL, NULL, '3 grande rue', 'bethonsart', NULL, 'FRA', '3 grande rue', 'bethonsart', NULL, 'FRA', 1, '2014-09-08 17:04:00', 1, NULL, NULL, NULL),
(169, 'gerard', 'samblancat', NULL, NULL, NULL, '25 rue jouve', 'marseille', NULL, 'France', '25 rue jouve', 'marseille', NULL, 'France', 1, '2014-09-08 16:08:00', 1, NULL, NULL, NULL),
(170, 'NADARAJAH', 'MOHARAJAN', NULL, NULL, NULL, '3 RUE CAMILMLE DARTOIS', 'CRETEIL', NULL, 'FRA', '3 RUE CAMILMLE DARTOIS', 'CRETEIL', NULL, 'FRA', 1, '2014-09-08 17:19:00', 1, NULL, NULL, NULL),
(171, 'N deye', 'Bourlier', NULL, NULL, NULL, '1bis rue daniel le duc', 'Dampmart', NULL, 'France', '1bis rue daniel le duc', 'Dampmart', NULL, 'France', 1, '2014-09-09 11:22:00', 1, NULL, NULL, NULL),
(172, 'TANGUY', 'LOUESSART', NULL, NULL, NULL, '25 RUE AU PREVOT', 'CHATEAUGIRON', NULL, 'France', '25 RUE AU PREVOT', 'CHATEAUGIRON', NULL, 'France', 1, '2014-09-09 14:18:00', 1, NULL, NULL, NULL),
(173, 'Danielle', 'Brunet', NULL, NULL, NULL, '46 Rue Lamartine', 'Tresserve', NULL, 'France', '46 Rue Lamartine', 'Tresserve', NULL, 'France', 1, '2014-09-09 21:52:00', 1, NULL, NULL, NULL),
(174, 'Lydie', 'Letondelle', NULL, NULL, NULL, '2 rue des lilas', 'Les Plains et grands essa', NULL, 'France', '2 rue des lilas', 'Les Plains et grands essa', NULL, 'France', 1, '2014-09-10 00:56:00', 1, NULL, NULL, NULL),
(175, 'Paul-Emmanuel', 'CARO', NULL, NULL, NULL, '229 rue jean monnet', 'Riorges', NULL, 'FRA', '229 rue jean monnet', 'Riorges', NULL, 'FRA', 1, '2014-09-10 17:45:00', 1, NULL, NULL, NULL),
(176, 'Jean-Pierre', 'VAILLANT', NULL, NULL, NULL, '13', 'orry la ville', NULL, 'France', '13', 'orry la ville', NULL, 'France', 1, '2014-09-11 17:19:00', 1, NULL, NULL, NULL),
(177, 'ALPHASOULEYMANE', 'TOURE', NULL, NULL, NULL, 'PLACE DU 08 MAI 1945', 'SAINT-DENIS', NULL, 'FR', 'PLACE DU 08 MAI 1945', 'SAINT-DENIS', NULL, 'FR', 1, '2014-09-11 17:19:00', 1, NULL, NULL, NULL),
(178, 'marie-pierre', 'parra', NULL, NULL, NULL, '14 RUE PIERRE DE RONSARD', 'LE PONTET', NULL, 'FRA', '14 RUE PIERRE DE RONSARD', 'LE PONTET', NULL, 'FRA', 1, '2014-09-11 14:02:00', 1, NULL, NULL, NULL),
(179, 'Jean-Luc', 'Krebs', NULL, NULL, NULL, '8 RUE DU CHATEAU D EAU', 'ROHRBACH LES BITCHE', NULL, 'FRA', '8 RUE DU CHATEAU D EAU', 'ROHRBACH LES BITCHE', NULL, 'FRA', 1, '2014-09-11 16:32:00', 1, NULL, NULL, NULL),
(180, 'Laurie', 'Mayard', NULL, NULL, NULL, '3 allée de Albizias', 'Orange', NULL, 'France', '3 allée de Albizias', 'Orange', NULL, 'France', 1, '2014-09-11 19:52:00', 1, NULL, NULL, NULL),
(181, 'Alan', 'Gravinese', NULL, NULL, NULL, '15 rue guy maupassant', 'domérat', NULL, 'France', '15 rue guy maupassant', 'domérat', NULL, 'France', 1, '2014-09-11 21:28:00', 1, NULL, NULL, NULL),
(182, 'Mathieu', 'Zugmeyer', NULL, NULL, NULL, '8rue du schneeberg', 'Otterswiller', NULL, 'France', '8rue du schneeberg', 'Otterswiller', NULL, 'France', 1, '2014-09-12 14:30:00', 1, NULL, NULL, NULL),
(183, 'Charlotte', 'Larcher', NULL, NULL, NULL, '6 chemin de Tourteloup', 'Fains-Veel', NULL, 'France', '6 chemin de Tourteloup', 'Fains-Veel', NULL, 'France', 1, '2014-09-12 18:46:00', 1, NULL, NULL, NULL),
(184, 'FABIENNE', 'DEBAT', NULL, NULL, NULL, '13 ALLEE ERIK LE ROUGE', 'villeFONTAINE', NULL, 'FR', '13 ALLEE ERIK LE ROUGE', 'villeFONTAINE', NULL, 'FR', 1, '2014-09-15 06:46:00', 1, NULL, NULL, NULL),
(185, 'jonathan', 'thebeault', NULL, NULL, NULL, '16 RUE CAPITAINE BELMONT', 'GRENOBLE', NULL, 'FRA', '16 RUE CAPITAINE BELMONT', 'GRENOBLE', NULL, 'FRA', 1, '2014-09-19 09:32:00', 1, NULL, NULL, NULL),
(186, 'Pierre', 'HENRIET', NULL, NULL, NULL, '9 avenue de Celle', 'Meudon la Forêt', NULL, 'France', '9 avenue de Celle', 'Meudon la Forêt', NULL, 'France', 1, '2014-09-15 22:54:00', 1, NULL, NULL, NULL),
(187, 'Marie-pierre', 'TOURET', NULL, NULL, NULL, '15 ,chemin des Carrières', 'PRIGNAC MARCAMPS', NULL, 'France', '15 ,chemin des Carrières', 'PRIGNAC MARCAMPS', NULL, 'France', 1, '2014-09-16 07:07:00', 1, NULL, NULL, NULL),
(188, 'GERARD', 'MONIN', NULL, NULL, NULL, '17 AVENUE DES ILES', 'ANNECY', NULL, 'FR', '17 AVENUE DES ILES', 'ANNECY', NULL, 'FR', 1, '2014-09-19 09:32:00', 1, NULL, NULL, NULL),
(189, 'Sébastien', 'GARANS', NULL, NULL, NULL, '6 IMPASSE DES RUSSONNEES', 'LUCON', NULL, 'FRA', '6 IMPASSE DES RUSSONNEES', 'LUCON', NULL, 'FRA', 1, '2014-09-21 20:04:00', 1, NULL, NULL, NULL),
(190, 'REMY', 'WEILL', NULL, NULL, NULL, '7 route de St Genest Malifaux', 'MARLHES', NULL, 'France', '7 route de St Genest Malifaux', 'MARLHES', NULL, 'France', 1, '2014-09-23 16:20:00', 1, NULL, NULL, NULL),
(191, 'julien', 'Musialak', NULL, NULL, NULL, '70 boulevard du pre galant', 'villepinte', NULL, 'FRA', '70 boulevard du pre galant', 'villepinte', NULL, 'FRA', 1, '2014-09-24 16:06:00', 1, NULL, NULL, NULL),
(192, 'SANDRINE', 'CONAN', NULL, NULL, NULL, '1', 'RISOUL', NULL, 'FR', '1', 'RISOUL', NULL, 'FR', 1, '2014-09-24 20:27:00', 1, NULL, NULL, NULL),
(193, 'Fabienne', 'Guillon', NULL, NULL, NULL, '93 RUE LAMARCK', 'PARIS', NULL, 'FRA', '93 RUE LAMARCK', 'PARIS', NULL, 'FRA', 1, '2014-09-25 23:46:00', 1, NULL, NULL, NULL),
(194, 'Marc', 'Nkaba', NULL, NULL, NULL, '1 rue de la Galmy', 'Chessy', NULL, 'France', '1 rue de la Galmy', 'Chessy', NULL, 'France', 1, '2014-09-29 14:48:00', 1, NULL, NULL, NULL),
(195, 'pascale', 'CHARPENET', NULL, NULL, NULL, '65 rue Victor Hugo', 'LOMME', NULL, 'FRA', '65 rue Victor Hugo', 'LOMME', NULL, 'FRA', 1, '2014-09-30 14:06:00', 1, NULL, NULL, NULL),
(196, 'JOHNNY', 'BAZE', NULL, NULL, NULL, '20 RUE EDGAR QUINET', 'MARSEILLE', NULL, 'FR', '20 RUE EDGAR QUINET', 'MARSEILLE', NULL, 'FR', 1, '2014-10-01 11:19:00', 1, NULL, NULL, NULL),
(197, 'Claire', 'Garbar', NULL, NULL, NULL, '11 boulevard st Martin', 'Paris', NULL, 'France', '11 boulevard st Martin', 'Paris', NULL, 'France', 1, '2014-10-01 13:44:00', 1, NULL, NULL, NULL),
(198, 'ERIC', 'DELARBRE', NULL, NULL, NULL, 'chemin du lac', 'GIGNAC', NULL, 'France', 'chemin du lac', 'GIGNAC', NULL, 'France', 1, '2014-10-01 21:16:00', 1, NULL, NULL, NULL),
(199, 'aurélien', 'guislain', NULL, NULL, NULL, '4 rue jean-moulin', 'saint pol sur ternoise', NULL, 'France', '4 rue jean-moulin', 'saint pol sur ternoise', NULL, 'France', 1, '2014-10-05 11:33:00', 1, NULL, NULL, NULL),
(200, 'Martin', 'Tolusso', NULL, NULL, NULL, '6 rue de la charte', 'villefranche sur saône', NULL, 'France', '6 rue de la charte', 'villefranche sur saône', NULL, 'France', 1, '2014-10-05 19:26:00', 1, NULL, NULL, NULL),
(201, 'Soraya', 'Bouacha', NULL, NULL, NULL, 'Le ménage de La Mole', 'LA MOLE', NULL, 'FRA', 'Le ménage de La Mole', 'LA MOLE', NULL, 'FRA', 1, '2014-10-06 18:38:00', 1, NULL, NULL, NULL),
(202, 'jacques', 'eyheramendy', NULL, NULL, NULL, '58 av de montbrun', 'anglet', NULL, 'France', '58 av de montbrun', 'anglet', NULL, 'France', 1, '2014-10-11 13:16:00', 1, NULL, NULL, NULL),
(203, 'hervé', 'ATOL les OPTICIENS', NULL, NULL, NULL, 'centre co AUCHAN , av de verdun', 'olivet', NULL, 'France', 'centre co AUCHAN , av de verdun', 'olivet', NULL, 'France', 1, '2014-10-11 18:32:00', 1, NULL, NULL, NULL),
(204, 'Yann', 'LEVASSEUR', NULL, NULL, NULL, 'Chez Annie LEFEBVRE', 'PUYCORNET', NULL, 'France', 'Chez Annie LEFEBVRE', 'PUYCORNET', NULL, 'France', 1, '2014-10-14 07:17:00', 1, NULL, NULL, NULL),
(205, 'Philippe', 'LEFEVRE', NULL, NULL, NULL, '42 RUE DU PRESIDENT KENNEDY', 'COLOMBES', NULL, 'FRA', '42 RUE DU PRESIDENT KENNEDY', 'COLOMBES', NULL, 'FRA', 1, '2014-10-14 13:18:00', 1, NULL, NULL, NULL),
(206, 'BOLOR', 'BAYARAA', NULL, NULL, NULL, '8 ALLEE DU DANEMARK', 'RENNES', NULL, 'FR', '8 ALLEE DU DANEMARK', 'RENNES', NULL, 'FR', 1, '2014-10-14 19:19:00', 1, NULL, NULL, NULL),
(207, 'Maxime', 'Mari', NULL, NULL, NULL, 'La Blaquière Supérieur', 'Luceram', NULL, 'France', 'La Blaquière Supérieur', 'Luceram', NULL, 'France', 1, '2014-10-15 20:25:00', 1, NULL, NULL, NULL),
(208, 'Jérome', 'PIGOU', NULL, NULL, NULL, '10 PLACE VICTOR HUGO', 'PARIS', NULL, 'FRA', '10 PLACE VICTOR HUGO', 'PARIS', NULL, 'FRA', 1, '2014-10-16 12:36:00', 1, NULL, NULL, NULL),
(209, 'jourdan marie', 'Boutique Naturessence', NULL, NULL, NULL, '3 place saluste du bartas', 'auch', NULL, 'France', '3 place saluste du bartas', 'auch', NULL, 'France', 1, '2014-10-16 14:41:00', 1, NULL, NULL, NULL),
(210, 'Francis', 'Longueville', NULL, NULL, NULL, '40 Chemin de Charlemagne', 'GALGON', NULL, 'FRA', '40 Chemin de Charlemagne', 'GALGON', NULL, 'FRA', 1, '2014-10-17 08:19:00', 1, NULL, NULL, NULL),
(211, 'guillaume', 'arsac', NULL, NULL, NULL, 'QUARTIER LE CHARROND', 'CHOMERAC', NULL, 'FRA', 'QUARTIER LE CHARROND', 'CHOMERAC', NULL, 'FRA', 1, '2014-10-17 14:12:00', 1, NULL, NULL, NULL),
(212, 'Laurent', 'LCS Mr Cligny', NULL, NULL, NULL, '37 rue de la Vanne', 'Montrouge', NULL, 'France', '37 rue de la Vanne', 'Montrouge', NULL, 'France', 1, '2014-10-18 20:18:00', 1, NULL, NULL, NULL),
(213, 'pierre', 'Karciauskas', NULL, NULL, NULL, '5 rue P. Martinet', 'Chateau Gontier', NULL, 'France', '5 rue P. Martinet', 'Chateau Gontier', NULL, 'France', 1, '2014-10-19 19:01:00', 1, NULL, NULL, NULL),
(214, 'AUDREY', 'LEJARD', NULL, NULL, NULL, '4 RUE FERDINAND CHARBONNIER', 'VATAN', NULL, 'FR', '4 RUE FERDINAND CHARBONNIER', 'VATAN', NULL, 'FR', 1, '2014-10-19 19:10:00', 1, NULL, NULL, NULL),
(215, 'Julie', 'Pet', NULL, NULL, NULL, '7 cité d''Angoulême', 'Paris', NULL, 'France', '7 cité d''Angoulême', 'Paris', NULL, 'France', 1, '2014-10-20 19:37:00', 1, NULL, NULL, NULL),
(216, 'Carine', 'DAZIANO', NULL, NULL, NULL, '18 lotissement les chênes blancs', 'LAPALUD', NULL, 'France', '18 lotissement les chênes blancs', 'LAPALUD', NULL, 'France', 1, '2014-10-20 18:30:00', 1, NULL, NULL, NULL),
(217, 'David', 'Leotier', NULL, NULL, NULL, '15 rue des bons enfants', 'marseille', NULL, 'France', '15 rue des bons enfants', 'marseille', NULL, 'France', 1, '2014-10-21 15:15:00', 1, NULL, NULL, NULL),
(218, 'Adéva', 'Mouette', NULL, NULL, NULL, '972 RUE DES BRUYERES', 'NOTRE DAME DE BLIQUETUIT', NULL, 'FRA', '972 RUE DES BRUYERES', 'NOTRE DAME DE BLIQUETUIT', NULL, 'FRA', 1, '2014-10-22 16:41:00', 1, NULL, NULL, NULL),
(219, 'Laetitia', 'de La Hitte', NULL, NULL, NULL, '145 rue de Lourmel', 'PARIS', NULL, 'FRA', '145 rue de Lourmel', 'PARIS', NULL, 'FRA', 1, '2014-10-23 22:27:00', 1, NULL, NULL, NULL),
(220, 'ilia', 'Gontcharov', NULL, NULL, NULL, '28 rue du docteur Derocque', 'rouen', NULL, 'France', '28 rue du docteur Derocque', 'rouen', NULL, 'France', 1, '2014-10-24 15:46:00', 1, NULL, NULL, NULL),
(221, 'Enzo', 'Renault', NULL, NULL, NULL, '160 chemin de clarence', 'bagard', NULL, 'France', '160 chemin de clarence', 'bagard', NULL, 'France', 1, '2014-10-25 18:17:00', 1, NULL, NULL, NULL),
(222, 'Sabrina', 'Gauchier', NULL, NULL, NULL, '29 Avenue Charles De Gaulle', 'Saint-Priest', NULL, 'France', '29 Avenue Charles De Gaulle', 'Saint-Priest', NULL, 'France', 1, '2014-10-25 18:36:00', 1, NULL, NULL, NULL),
(223, 'Sylviane', 'Privat', NULL, NULL, NULL, 'Giral Bas', 'MIERS', NULL, 'France', 'Giral Bas', 'MIERS', NULL, 'France', 1, '2014-10-25 19:12:00', 1, NULL, NULL, NULL),
(224, 'barka', 'begoc', NULL, NULL, NULL, '26 rue de la haie a la dame', 'ST ERBLON', NULL, 'FRA', '26 rue de la haie a la dame', 'ST ERBLON', NULL, 'FRA', 1, '2014-11-06 20:32:00', 1, NULL, NULL, NULL),
(225, 'MOSTAFA', 'NOUINOU', NULL, NULL, NULL, '54 RUE PHILIPPE DE GIRARD', 'PARIS', NULL, 'FRA', '54 RUE PHILIPPE DE GIRARD', 'PARIS', NULL, 'FRA', 1, '2014-11-06 22:13:00', 1, NULL, NULL, NULL),
(226, 'jean louis', 'Brunet', NULL, NULL, NULL, '13 RUE HAUTE', 'CHAVENAY', NULL, 'FRA', '13 RUE HAUTE', 'CHAVENAY', NULL, 'FRA', 1, '2014-11-06 22:30:00', 1, NULL, NULL, NULL),
(227, 'Clémence', 'Prodhomme', NULL, NULL, NULL, 'LIEU DIT LA RENAISSANCE', 'PASSAIS LA CONCEPTION', NULL, 'FRA', 'LIEU DIT LA RENAISSANCE', 'PASSAIS LA CONCEPTION', NULL, 'FRA', 1, '2014-11-07 19:14:00', 1, NULL, NULL, NULL),
(228, 'Agnès', 'DARMAIS', NULL, NULL, NULL, '21 RUE LEON GAMBETTA', 'CASTRES', NULL, 'FRA', '21 RUE LEON GAMBETTA', 'CASTRES', NULL, 'FRA', 1, '2014-11-07 19:14:00', 1, NULL, NULL, NULL),
(229, 'veronique', 'Di salvatore', NULL, NULL, NULL, '1 rue des novales', 'charny', NULL, 'France', '1 rue des novales', 'charny', NULL, 'France', 1, '2014-11-08 10:54:00', 1, NULL, NULL, NULL),
(230, 'MARIAME', 'DABO', NULL, NULL, NULL, '9 RUE DU BORREGO', 'PARIS', NULL, 'FR', '9 RUE DU BORREGO', 'PARIS', NULL, 'FR', 1, '2014-11-08 12:18:00', 1, NULL, NULL, NULL),
(231, 'Jordan', 'JUTEL', NULL, NULL, NULL, '23 avenue Hoche', 'Mayenne', NULL, 'France', '23 avenue Hoche', 'Mayenne', NULL, 'France', 1, '2014-11-09 17:38:00', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cmde_client`
--

CREATE TABLE IF NOT EXISTS `cmde_client` (
`ref_cmdec` int(11) NOT NULL,
  `ref_produit` varchar(25) DEFAULT NULL,
  `ref_client` varchar(10) DEFAULT NULL,
  `ref_canal_distrib` varchar(10) DEFAULT NULL,
  `date_cmde` datetime DEFAULT NULL,
  `ref_vendeur` varchar(10) DEFAULT NULL,
  `code_devise` varchar(3) DEFAULT NULL,
  `qté` double DEFAULT NULL,
  `montant_ht` double DEFAULT NULL,
  `montant_port` double DEFAULT NULL,
  `montant_taxe` double DEFAULT NULL,
  `montant_total` double DEFAULT NULL,
  `taux_taxe` double DEFAULT NULL,
  `Flag_cmde_livrée` varchar(1) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `date_heure_maj` datetime DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=235 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cmde_client`
--

INSERT INTO `cmde_client` (`ref_cmdec`, `ref_produit`, `ref_client`, `ref_canal_distrib`, `date_cmde`, `ref_vendeur`, `code_devise`, `qté`, `montant_ht`, `montant_port`, `montant_taxe`, `montant_total`, `taux_taxe`, `Flag_cmde_livrée`, `user_id`, `date_heure_maj`) VALUES
(1, 'TEAPL1002-CNF', '5', '1', '2014-07-23 23:01:00', 'VEN1', 'XAF', 1, 97855.52, 6592.8, 19568.48, 124016.8, 20, 'O', NULL, NULL),
(2, 'TEAPL1002-CNF', '6', '1', '2014-07-23 21:16:00', 'VEN1', 'XAF', 1, 97855.52, 6199.2, 19568.48, 123623.2, 20, 'O', NULL, NULL),
(3, 'TEAPL1016-CNF', '7', '1', '2014-07-24 13:53:00', 'VEN1', 'XAF', 1, 327455.52, 7150.4, 65488.48, 400094.4, 20, 'O', NULL, NULL),
(4, 'TEAPL1002-CNF', '8', '1', '2014-07-25 14:30:00', 'VEN1', 'XAF', 1, 97855.52, 6199.2, 19568.48, 123623.2, 20, 'O', NULL, NULL),
(5, 'TEAPL1012-CNF', '9', '1', '2014-07-26 17:13:00', 'VEN1', 'XAF', 1, 218120, 7150.4, 43624, 268894.4, 20, 'N', NULL, NULL),
(6, 'TESMG1002-OCC', '10', '2', '2014-07-27 12:02:00', 'VEN1', 'XAF', 1, 70520, 6002.4, 14104, 90626.4, 20, 'O', NULL, NULL),
(7, 'TEAPL1014-CNF', '11', '1', '2014-07-27 21:06:00', 'VEN1', 'XAF', 1, 191335.52, 6199.2, 38264.48, 235799.2, 20, 'O', NULL, NULL),
(8, 'TESMG1002-CNF', '12', '2', '2014-07-28 02:12:00', 'VEN1', 'XAF', 1, 81455.52, 7150.4, 16288.48, 104894.4, 20, 'O', NULL, NULL),
(9, 'TEAPL1002-OCC', '13', '1', '2014-07-26 22:58:00', 'VEN1', 'XAF', 1, 92384.48, 6199.2, 18479.52, 117063.2, 20, 'O', NULL, NULL),
(10, 'TESMG1005-OCC', '14', '1', '2014-07-28 13:48:00', 'VEN1', 'XAF', 1, 168920, 0, 33784, 202704, 20, 'O', NULL, NULL),
(11, 'TEAPL1003-CNF', '16', '3', '2014-07-29 14:23:00', 'VEN1', 'XAF', 1, 92935.52, 0, 18584.48, 111520, 20, 'O', NULL, NULL),
(12, 'TEAPL1002-OCC', '17', '3', '2014-07-29 15:39:00', 'VEN1', 'XAF', 1, 92384.48, 0, 18479.52, 110864, 20, 'N', NULL, NULL),
(13, 'TESMG1002-OCC', '18', '1', '2014-07-29 19:56:00', 'VEN1', 'XAF', 1, 70520, 0, 14104, 84624, 20, 'N', NULL, NULL),
(14, 'TESMG1003-OCC', '20', '2', '2014-07-30 10:52:00', 'VEN1', 'XAF', 1, 70520, 0, 14104, 84624, 20, 'N', NULL, NULL),
(15, 'TEAPL1015-CNF', '21', '2', '2014-07-30 13:05:00', 'VEN1', 'XAF', 1, 327455.52, 0, 65488.48, 392944, 20, 'N', NULL, NULL),
(16, 'TEAPL1011-OCC', '22', '2', '2014-07-30 15:05:00', 'VEN1', 'XAF', 1, 168920, 0, 33784, 202704, 20, 'N', NULL, NULL),
(17, 'TESMG1003-OCC', '23', '1', '2014-07-30 14:22:00', 'VEN1', 'XAF', 1, 70520, 0, 14104, 84624, 20, 'N', NULL, NULL),
(18, 'TESMG1003-OCC', '24', '1', '2014-07-30 17:48:00', 'VEN1', 'XAF', 1, 70520, 0, 14104, 84624, 20, 'N', NULL, NULL),
(19, 'TEAPL1003-OCC', '25', '2', '2014-07-31 09:38:00', 'VEN1', 'XAF', 1, 92384.48, 0, 18479.52, 110864, 20, 'N', NULL, NULL),
(20, 'TEAPL1003-CNF', '27', '1', '2014-08-01 10:37:00', 'VEN1', 'XAF', 1, 97855.52, 0, 19568.48, 117424, 20, 'N', NULL, NULL),
(21, 'TEAPL1003-CNF', '28', '1', '2014-08-01 13:44:00', 'VEN1', 'XAF', 1, 97855.52, 0, 19568.48, 117424, 20, 'N', NULL, NULL),
(22, 'TESMG1002-CNF', '29', '1', '2014-07-30 17:34:00', 'VEN1', 'XAF', 1, 81455.52, 0, 16288.48, 97744, 20, 'N', NULL, NULL),
(23, 'TEAPL1015-OCC', '30', '1', '2014-08-01 17:41:00', 'VEN1', 'XAF', 1, 294655.52, 0, 58928.48, 353584, 20, 'N', NULL, NULL),
(24, 'TEAPL1013-OCC', '31', '3', '2014-08-01 19:48:00', 'VEN1', 'XAF', 1, 190784.48, 0, 38159.52, 228944, 20, 'N', NULL, NULL),
(25, 'TESMG1000-CNF', '32', '3', '2014-08-01 20:11:00', 'VEN1', 'XAF', 1, 125184.48, 0, 25039.52, 150224, 20, 'O', NULL, NULL),
(26, 'TESMG1000-CNF', '33', '3', '2014-08-01 23:58:00', 'VEN1', 'XAF', 1, 125184.48, 0, 25039.52, 150224, 20, 'O', NULL, NULL),
(27, 'TEAPL1003-OCC', '34', '1', '2014-08-01 23:55:00', 'VEN1', 'XAF', 1, 92384.48, 0, 18479.52, 110864, 20, 'O', NULL, NULL),
(28, 'TEAPL1012-OCC', '35', '1', '2014-08-02 11:44:00', 'VEN1', 'XAF', 1, 190784.48, 0, 38159.52, 228944, 20, 'O', NULL, NULL),
(29, 'TESMG1002-OCC', '36', '1', '2014-08-03 10:00:00', 'VEN1', 'XAF', 1, 70520, 0, 14104, 84624, 20, 'O', NULL, NULL),
(30, 'TEAPL1013-OCC', '37', '1', '2014-08-03 12:10:00', 'VEN1', 'XAF', 1, 190784.48, 0, 38159.52, 228944, 20, 'O', NULL, NULL),
(31, 'TEAPL1013-OCC', '38', '1', '2014-08-03 15:19:00', 'VEN1', 'USD', 1, 290.83, 0, 58.17, 349, 20, 'N', NULL, NULL),
(32, 'TEAPL1012-OCC', '39', '1', '2014-08-03 17:34:00', 'VEN1', 'USD', 1, 290.83, 0, 58.17, 349, 20, 'N', NULL, NULL),
(33, 'TEAPL1016-CNF', '40', '1', '2014-08-03 18:41:00', 'VEN1', 'USD', 1, 465.83, 0, 93.17, 559, 20, 'N', NULL, NULL),
(34, 'TEAPL1012-OCC', '41', '1', '2014-08-03 19:45:00', 'VEN1', 'USD', 1, 290.83, 0, 58.17, 349, 20, 'N', NULL, NULL),
(35, 'TEAPL1012-OCC', '43', '1', '2014-08-04 11:22:00', 'VEN1', 'USD', 1, 290.83, 0, 58.17, 349, 20, 'N', NULL, NULL),
(36, 'TEAPL1012-OCC', '44', '1', '2014-08-03 17:52:00', 'VEN1', 'USD', 1, 290.83, 0, 58.17, 349, 20, 'N', NULL, NULL),
(37, 'TEAPL1012-OCC', '45', '1', '2014-08-03 18:26:00', 'VEN1', 'USD', 1, 290.83, 0, 58.17, 349, 20, 'N', NULL, NULL),
(38, 'TEAPL1003-CNF', '46', '1', '2014-08-01 17:24:00', 'VEN1', 'USD', 1, 149.17, 0, 29.83, 179, 20, 'N', NULL, NULL),
(39, 'TEAPL1014-CNF', '47', '1', '2014-08-04 14:50:00', 'VEN1', 'USD', 1, 465.83, 0, 93.17, 559, 20, 'N', NULL, NULL),
(40, 'TEAPL1013-OCC', '48', '1', '2014-08-04 21:07:00', 'VEN1', 'USD', 1, 290.83, 0, 58.17, 349, 20, 'O', NULL, NULL),
(41, 'TEAPL1011-OCC', '49', '1', '2014-08-05 07:39:00', 'VEN1', 'USD', 1, 257.5, 0, 51.5, 309, 20, 'O', NULL, NULL),
(42, 'TESMG1003-CNF', '50', '1', '2014-08-05 10:52:00', 'VEN1', 'USD', 1, 124.17, 0, 24.83, 149, 20, 'O', NULL, NULL),
(43, 'TEBBL1000-OCC', '51', '1', '2014-08-05 12:35:00', 'VEN1', 'USD', 1, 157.5, 0, 31.5, 189, 20, 'O', NULL, NULL),
(44, 'TEAPL1011-OCC', '52', '1', '2014-08-05 13:27:00', 'VEN1', 'USD', 1, 257.5, 0, 51.5, 309, 20, 'O', NULL, NULL),
(45, 'TESMG1003-OCC', '53', '1', '2014-08-05 13:28:00', 'VEN1', 'USD', 1, 107.5, 0, 21.5, 129, 20, 'O', NULL, NULL),
(46, 'TEAPL1005-OCC', '54', '1', '2014-08-05 22:57:00', 'VEN1', 'USD', 1, 165.83, 0, 33.17, 199, 20, 'O', NULL, NULL),
(47, 'TEAPL1013-OCC', '55', '1', '2014-08-05 22:21:00', 'VEN1', 'USD', 1, 290.83, 0, 58.17, 349, 20, 'O', NULL, NULL),
(48, 'TEAPL1015-OCC', '56', '1', '2014-08-06 09:16:00', 'VEN1', 'USD', 1, 449.17, 0, 89.83, 539, 20, 'O', NULL, NULL),
(49, 'TESMG1005-OCC', '57', '1', '2014-08-05 23:28:00', 'VEN1', 'USD', 1, 257.5, 0, 51.5, 309, 20, 'O', NULL, NULL),
(50, 'TEAPL1009-OCC', '58', '1', '2014-08-06 18:59:00', 'VEN1', 'USD', 1, 215.83, 0, 43.17, 259, 20, 'O', NULL, NULL),
(51, 'TESMG1001-OCC', '59', '1', '2014-08-06 19:04:00', 'VEN1', 'USD', 1, 182.5, 0, 36.5, 219, 20, 'O', NULL, NULL),
(52, 'TEAPL1014-CNF', '60', '3', '2014-08-06 22:47:00', 'VEN1', 'USD', 1, 465.83, 0, 93.17, 559, 20, 'O', NULL, NULL),
(53, 'TEAPL1009-OCC', '62', '1', '2014-08-06 17:04:00', 'VEN1', 'USD', 1, 215.83, 0, 43.17, 259, 20, 'O', NULL, NULL),
(54, 'TEAPL1009-OCC', '63', '3', '2014-08-06 21:18:00', 'VEN1', 'USD', 1, 215.83, 0, 43.17, 259, 20, 'O', NULL, NULL),
(55, 'TEAPL1013-OCC', '64', '1', '2014-08-07 10:34:00', 'VEN1', 'USD', 1, 290.83, 0, 58.17, 349, 20, 'O', NULL, NULL),
(56, 'TEAPL1009-OCC', '66', '1', '2014-08-07 13:13:00', 'VEN1', 'USD', 1, 215.83, 0, 43.17, 259, 20, 'O', NULL, NULL),
(57, 'TESMG1003-OCC', '67', '1', '2014-08-07 17:18:00', 'VEN1', 'USD', 1, 107.5, 0, 21.5, 129, 20, 'O', NULL, NULL),
(58, 'TEAPL1014-CNF', '68', '1', '2014-08-07 22:31:00', 'VEN1', 'USD', 1, 465.83, 0, 93.17, 559, 20, 'O', NULL, NULL),
(59, 'TESMG1005-OCC', '69', '1', '2014-08-08 14:08:00', 'VEN1', 'USD', 1, 257.5, 0, 51.5, 309, 20, 'O', NULL, NULL),
(60, 'TESMG1008-OCC', '70', '1', '2014-08-08 20:02:00', 'VEN1', 'USD', 1, 107.5, 0, 21.5, 129, 20, 'O', NULL, NULL),
(61, 'TESMG1004-OCC', '71', '1', '2014-08-09 01:23:00', 'VEN1', 'USD', 1, 257.5, 0, 51.5, 309, 20, 'O', NULL, NULL),
(62, 'TESMG1005-OCC', '72', '1', '2014-08-09 17:38:00', 'VEN1', 'USD', 1, 257.5, 0, 51.5, 309, 20, 'O', NULL, NULL),
(63, 'TEAPL1008-OCC', '73', '2', '2014-08-10 19:20:00', 'VEN1', 'USD', 1, 215.83, 0, 43.17, 259, 20, 'O', NULL, NULL),
(64, 'TESMG1006-OCC', '74', '1', '2014-08-10 23:04:00', 'VEN1', 'USD', 1, 257.5, 0, 51.5, 309, 20, 'O', NULL, NULL),
(65, 'TEAPL1008-OCC', '75', '1', '2014-08-11 09:32:00', 'VEN1', 'USD', 1, 215.83, 0, 43.17, 259, 20, 'O', NULL, NULL),
(66, 'TESMG1004-OCC', '76', '1', '2014-08-11 12:34:00', 'VEN1', 'USD', 1, 257.5, 0, 51.5, 309, 20, 'O', NULL, NULL),
(67, 'TEAPL1016-CNF', '77', '1', '2014-08-12 08:52:00', 'VEN1', 'USD', 1, 465.83, 0, 93.17, 559, 20, 'O', NULL, NULL),
(68, 'TEAPL1008-OCC', '78', '1', '2014-08-12 16:40:00', 'VEN1', 'USD', 1, 215.83, 0, 43.17, 259, 20, 'O', NULL, NULL),
(69, 'TEAPL1003-OCC', '80', '1', '2014-08-12 19:46:00', 'VEN1', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(70, 'TEAPL1014-OCC', '81', '1', '2014-08-12 21:51:00', 'VEN1', 'USD', 1, 449.17, 0, 89.83, 539, 20, 'O', NULL, NULL),
(71, 'TESMG1005-OCC', '82', '2', '2014-08-12 21:54:00', 'VEN1', 'USD', 1, 257.5, 0, 51.5, 309, 20, 'O', NULL, NULL),
(72, 'TESMG1000-CNF', '83', '1', '2014-08-12 20:31:00', 'VEN1', 'USD', 1, 190.83, 0, 38.17, 229, 20, 'O', NULL, NULL),
(73, 'TEAPL1013-OCC', '85', '1', '2014-08-12 19:43:00', 'VEN1', 'USD', 1, 290.83, 0, 58.17, 349, 20, 'O', NULL, NULL),
(74, 'TEAPL1003-CNF', '86', '1', '2014-08-13 14:49:00', 'VEN1', 'USD', 1, 149.17, 0, 29.83, 179, 20, 'O', NULL, NULL),
(75, 'TEAPL1003-CNF', '87', '1', '2014-08-13 15:55:00', 'VEN1', 'USD', 1, 149.17, 0, 29.83, 179, 20, 'O', NULL, NULL),
(76, 'TEAPL1014-CNF', '88', '1', '2014-08-13 22:28:00', 'VEN1', 'USD', 1, 465.83, 0, 93.17, 559, 20, 'O', NULL, NULL),
(77, 'TESMG1004-OCC', '91', '1', '2014-08-14 22:21:00', 'VEN1', 'USD', 1, 257.5, 0, 51.5, 309, 20, 'O', NULL, NULL),
(78, 'TESMG1004-OCC', '93', '1', '2014-08-17 13:59:00', 'VEN1', 'USD', 1, 257.5, 0, 51.5, 309, 20, 'O', NULL, NULL),
(79, 'TESMG1005-OCC', '94', '1', '2014-08-18 11:06:00', 'VEN1', 'USD', 1, 257.5, 0, 51.5, 309, 20, 'O', NULL, NULL),
(80, 'TESMG1003-CNF', '95', '1', '2014-08-18 12:56:00', 'VEN1', 'USD', 1, 124.17, 0, 24.83, 149, 20, 'O', NULL, NULL),
(81, 'TESMG1007OCC', '97', '1', '2014-08-19 19:17:00', 'VEN1', 'USD', 1, 257.5, 0, 51.5, 309, 20, 'O', NULL, NULL),
(82, 'TEAPL1003-CNF', '98', '1', '2014-08-20 20:43:00', 'VEN1', 'USD', 1, 149.17, 0, 29.83, 179, 20, 'O', NULL, NULL),
(83, 'TEAPL1012-OCC', '101', '1', '2014-08-21 01:19:00', 'VEN1', 'USD', 1, 290.83, 0, 58.17, 349, 20, 'O', NULL, NULL),
(84, 'TEAPL1003-CNF', '103', '1', '2014-08-25 09:37:00', 'VEN1', 'USD', 1, 149.17, 0, 29.83, 179, 20, 'O', NULL, NULL),
(85, 'TEAPL1008-OCC', '104', '1', '2014-08-23 15:25:00', 'VEN1', 'USD', 1, 215.83, 0, 43.17, 259, 20, 'O', NULL, NULL),
(86, 'TESMG1001-CNF', '106', '1', '2014-08-26 14:32:00', 'VEN1', 'USD', 1, 190.83, 0, 38.17, 229, 20, 'O', NULL, NULL),
(87, 'TEAPL1008-OCC', '107', '1', '2014-08-26 17:24:00', 'VEN1', 'USD', 1, 208.33, 0, 41.67, 250, 20, 'O', NULL, NULL),
(88, 'TEAPL1008-OCC', '108', '1', '2014-08-26 20:08:00', 'VEN1', 'USD', 1, 208.33, 0, 41.67, 250, 20, 'O', NULL, NULL),
(89, 'TEAPL1009-OCC', '109', '1', '2014-08-26 21:34:00', 'VEN1', 'USD', 1, 208.33, 0, 41.67, 250, 20, 'O', NULL, NULL),
(90, 'TESMG1001-CNF', '110', '2', '2014-08-27 08:11:00', 'VEN1', 'USD', 1, 190.83, 0, 38.17, 229, 20, 'O', NULL, NULL),
(91, 'TEAPL1015-OCC', '111', '2', '2014-08-27 12:09:00', 'VEN1', 'USD', 1, 449.17, 0, 89.83, 539, 20, 'O', NULL, NULL),
(92, 'TEAPL1008-OCC', '112', '2', '2014-08-27 11:12:00', 'VEN1', 'USD', 1, 208.33, 0, 41.67, 250, 20, 'O', NULL, NULL),
(93, 'TEAPL1008-OCC', '113', '1', '2014-08-27 14:19:00', 'VEN1', 'USD', 1, 208.33, 0, 41.67, 250, 20, 'O', NULL, NULL),
(94, 'TEAPL1008-OCC', '114', '2', '2014-08-27 15:37:00', 'VEN1', 'USD', 1, 208.33, 0, 41.67, 250, 20, 'N', NULL, NULL),
(95, 'TEAPL1008-OCC', '115', '3', '2014-08-27 15:49:00', 'VEN1', 'USD', 1, 208.33, 0, 41.67, 250, 20, 'N', NULL, NULL),
(96, 'TEAPL1009-OCC', '116', '1', '2014-08-27 15:56:00', 'VEN1', 'USD', 1, 208.33, 0, 41.67, 250, 20, 'N', NULL, NULL),
(97, 'TEAPL1009-OCC', '117', '1', '2014-08-27 17:47:00', 'VEN1', 'USD', 1, 208.33, 0, 41.67, 250, 20, 'N', NULL, NULL),
(98, 'TEAPL1009-OCC', '118', '1', '2014-08-28 12:39:00', 'VEN1', 'USD', 1, 208.33, 0, 41.67, 250, 20, 'N', NULL, NULL),
(99, 'TESMG1001-OCC', '119', '1', '2014-08-29 13:08:00', 'VEN1', 'USD', 1, 182.5, 0, 36.5, 219, 20, 'N', NULL, NULL),
(100, 'TEAPL1009-OCC', '120', '1', '2014-08-29 16:30:00', 'VEN1', 'USD', 1, 208.33, 0, 41.67, 250, 20, 'N', NULL, NULL),
(101, 'TEAPL1009-OCC', '121', '1', '2014-08-31 19:01:00', 'VEN1', 'USD', 1, 208.33, 0, 41.67, 250, 20, 'N', NULL, NULL),
(102, 'TEAPL1009-OCC', '122', '1', '2014-08-29 21:16:00', 'VEN1', 'USD', 1, 208.33, 0, 41.67, 250, 20, 'N', NULL, NULL),
(103, 'TEAPL1009-OCC', '123', '1', '2014-09-01 11:46:00', 'VEN1', 'USD', 1, 208.33, 0, 41.67, 250, 20, 'N', NULL, NULL),
(104, 'TEAPL1009-OCC', '124', '1', '2014-08-29 18:00:00', 'VEN1', 'USD', 1, 208.33, 0, 41.67, 250, 20, 'N', NULL, NULL),
(105, 'TEAPL1009-OCC', '125', '1', '2014-09-01 15:14:00', 'VEN1', 'USD', 1, 208.33, 0, 41.67, 250, 20, 'N', NULL, NULL),
(106, 'TESMG1005-OCC', '126', '1', '2014-09-01 16:20:00', 'VEN1', 'USD', 1, 257.5, 0, 51.5, 309, 20, 'O', NULL, NULL),
(107, 'TEAPL1008-OCC', '127', '1', '2014-09-01 20:59:00', 'VEN1', 'USD', 1, 208.33, 0, 41.67, 250, 20, 'O', NULL, NULL),
(108, 'TEAPL1013-OCC', '128', '1', '2014-09-01 21:43:00', 'VEN1', 'USD', 1, 290.83, 0, 58.17, 349, 20, 'O', NULL, NULL),
(109, 'TEAPL1009-OCC', '129', '1', '2014-09-02 22:03:00', 'VEN1', 'USD', 1, 208.33, 0, 41.67, 250, 20, 'O', NULL, NULL),
(110, 'TEAPL1009-OCC', '130', '1', '2014-09-03 13:32:00', 'VEN1', 'USD', 1, 208.33, 0, 41.67, 250, 20, 'O', NULL, NULL),
(111, 'TEAPL1013-OCC', '131', '1', '2014-09-04 21:35:00', 'VEN1', 'USD', 1, 290.83, 0, 58.17, 349, 20, 'O', NULL, NULL),
(112, 'TEAPL1002-CNF', '132', '1', '2014-09-04 21:58:00', 'VEN1', 'USD', 1, 149.17, 0, 29.83, 179, 20, 'O', NULL, NULL),
(113, 'TEAPL1013-OCC', '133', '1', '2014-09-04 22:32:00', 'VEN1', 'USD', 1, 290.83, 0, 58.17, 349, 20, 'O', NULL, NULL),
(114, 'TEAPL1003-CNF', '134', '1', '2014-09-04 22:37:00', 'VEN1', 'USD', 1, 149.17, 0, 29.83, 179, 20, 'O', NULL, NULL),
(115, 'TEAPL1002-OCC', '135', '1', '2014-09-04 22:31:00', 'VEN1', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(116, 'TEAPL1003-OCC', '136', '1', '2014-09-04 22:45:00', 'VEN1', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(117, 'TEAPL1003-OCC', '137', '1', '2014-09-05 00:13:00', 'VEN1', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(118, 'TEAPL1002-OCC', '138', '1', '2014-09-05 12:31:00', 'VEN1', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(119, 'TEAPL1003-OCC', '139', '1', '2014-09-05 12:57:00', 'VEN1', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(120, 'TEAPL1002-CNF', '140', '1', '2014-09-05 15:56:00', 'VEN1', 'USD', 1, 149.17, 0, 29.83, 179, 20, 'O', NULL, NULL),
(121, 'TEAPL1002-CNF', '141', '1', '2014-09-05 18:50:00', 'VEN1', 'USD', 1, 149.17, 0, 29.83, 179, 20, 'O', NULL, NULL),
(122, 'TEAPL1012-OCC', '142', '1', '2014-09-05 19:47:00', 'VEN1', 'USD', 1, 290.83, 0, 58.17, 349, 20, 'O', NULL, NULL),
(123, 'TEAPL1003-OCC', '143', '1', '2014-09-05 20:59:00', 'VEN1', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(124, 'TEAPL1003-OCC', '144', '1', '2014-09-05 20:57:00', 'VEN1', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(125, 'TEAPL1002-OCC', '146', '1', '2014-09-05 23:38:00', 'VEN1', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(126, 'TEAPL1003-OCC', '147', '1', '2014-09-06 09:40:00', 'VEN1', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'N', NULL, NULL),
(127, 'TEAPL1002-OCC', '148', '1', '2014-09-06 12:27:00', 'VEN1', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(128, 'TEAPL1002-OCC', '149', '1', '2014-09-06 15:26:00', 'VEN1', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(129, 'TEAPL1003-OCC', '150', '1', '2014-09-06 17:06:00', 'VEN1', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(130, 'TEAPL1003-CNF', '151', '1', '2014-09-06 20:53:00', 'VEN1', 'USD', 1, 149.17, 0, 29.83, 179, 20, 'O', NULL, NULL),
(131, 'TEAPL1003-CNF', '152', '1', '2014-09-06 20:24:00', 'VEN1', 'USD', 1, 149.17, 0, 29.83, 179, 20, 'O', NULL, NULL),
(132, 'TEAPL1002-OCC', '153', '1', '2014-09-07 09:58:00', 'VEN1', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(133, 'TEAPL1002-CNF', '154', '1', '2014-09-07 10:06:00', 'VEN1', 'USD', 1, 149.17, 0, 29.83, 179, 20, 'O', NULL, NULL),
(134, 'TEAPL1003-OCC', '155', '2', '2014-09-07 15:15:00', 'VEN1', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(135, 'TEAPL1009-OCC', '156', '1', '2014-09-07 16:32:00', 'VEN1', 'USD', 1, 208.33, 0, 41.67, 250, 20, 'O', NULL, NULL),
(136, 'TEAPL1002-OCC', '157', '1', '2014-09-07 18:32:00', 'VEN1', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(137, 'TEAPL1002-OCC', '158', '1', '2014-09-07 21:32:00', 'VEN1', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(138, 'TEAPL1002-OCC', '159', '1', '2014-09-07 23:00:00', 'VEN1', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(139, 'TEAPL1002-OCC', '160', '1', '2014-09-07 23:55:00', 'VEN1', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(140, 'TEAPL1002-CNF', '161', '1', '2014-09-08 04:21:00', 'VEN1', 'USD', 1, 149.17, 0, 29.83, 179, 20, 'O', NULL, NULL),
(141, 'TEAPL1003-OCC', '162', '2', '2014-09-08 10:05:00', 'VEN1', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(142, 'TEAPL1003-OCC', '163', '2', '2014-09-08 10:14:00', 'VEN1', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(143, 'TEAPL1012-OCC', '164', '1', '2014-09-06 17:15:00', 'VEN1', 'USD', 1, 290.83, 0, 58.17, 349, 20, 'O', NULL, NULL),
(144, 'TEAPL1002-CNF', '165', '1', '2014-09-07 10:58:00', 'VEN1', 'USD', 1, 149.17, 0, 29.83, 179, 20, 'O', NULL, NULL),
(145, 'TEAPL1002-OCC', '166', '1', '2014-09-07 19:27:00', 'VEN1', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(146, 'TEAPL1009-OCC', '167', '1', '2014-09-07 17:46:00', 'VEN1', 'USD', 1, 208.33, 0, 41.67, 250, 20, 'O', NULL, NULL),
(147, 'TESMG1004-OCC', '168', '1', '2014-09-07 19:06:00', 'VEN1', 'USD', 1, 257.5, 0, 51.5, 309, 20, 'O', NULL, NULL),
(148, 'TEAPL1002-CNF', '169', '1', '2014-09-07 11:31:00', 'VEN1', 'USD', 1, 149.17, 0, 29.83, 179, 20, 'O', NULL, NULL),
(149, 'TEAPL1002-OCC', '170', '1', '2014-09-08 12:11:00', 'VEN1', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(150, 'TEAPL1003-OCC', '171', '1', '2014-09-06 18:30:00', 'VEN2', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(151, 'TEAPL1013-OCC', '172', '1', '2014-09-08 11:34:00', 'VEN2', 'USD', 1, 290.83, 0, 58.17, 349, 20, 'N', NULL, NULL),
(152, 'TEAPL1003-OCC', '173', '1', '2014-09-08 13:53:00', 'VEN2', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'N', NULL, NULL),
(153, 'TEAPL1002-OCC', '174', '2', '2014-09-08 14:01:00', 'VEN2', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'N', NULL, NULL),
(154, 'TEAPL1013-OCC', '175', '2', '2014-09-08 16:35:00', 'VEN2', 'USD', 1, 290.83, 0, 58.17, 349, 20, 'N', NULL, NULL),
(155, 'TEAPL1002-OCC', '176', '1', '2014-09-08 16:08:00', 'VEN2', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'N', NULL, NULL),
(156, 'TEAPL1002-CNF', '177', '1', '2014-09-08 17:19:00', 'VEN2', 'USD', 1, 149.17, 0, 29.83, 179, 20, 'N', NULL, NULL),
(157, 'TESMG1002-OCC', '179', '1', '2014-09-09 11:22:00', 'VEN2', 'USD', 1, 107.5, 0, 21.5, 129, 20, 'N', NULL, NULL),
(158, 'TESMG1002-OCC', '180', '1', '2014-09-09 14:18:00', 'VEN2', 'USD', 1, 107.5, 0, 21.5, 129, 20, 'N', NULL, NULL),
(159, 'TESMG1002-OCC', '182', '1', '2014-09-09 21:52:00', 'VEN2', 'USD', 1, 107.5, 0, 21.5, 129, 20, 'N', NULL, NULL),
(160, 'TESMG1002-OCC', '183', '1', '2014-09-10 00:56:00', 'VEN2', 'USD', 1, 107.5, 0, 21.5, 129, 20, 'N', NULL, NULL),
(161, 'TEAPL1003-CNF', '184', '1', '2014-09-10 17:45:00', 'VEN2', 'USD', 1, 149.17, 0, 29.83, 179, 20, 'N', NULL, NULL),
(162, 'TEAPL1002-CNF', '185', '1', '2014-09-10 21:30:00', 'VEN2', 'USD', 1, 149.17, 0, 29.83, 179, 20, 'N', NULL, NULL),
(163, 'TEAPL1003-OCC', '186', '1', '2014-09-11 10:21:00', 'VEN2', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'N', NULL, NULL),
(164, 'TEAPL1003-CNF', '187', '1', '2014-09-11 14:02:00', 'VEN2', 'USD', 1, 149.17, 0, 29.83, 179, 20, 'N', NULL, NULL),
(165, 'TEAPL1002-CNF', '188', '1', '2014-09-11 16:32:00', 'VEN2', 'USD', 1, 149.17, 0, 29.83, 179, 20, 'O', NULL, NULL),
(166, 'TEAPL1002-OCC', '189', '1', '2014-09-11 19:52:00', 'VEN2', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(167, 'TEAPL1002-OCC', '190', '1', '2014-09-11 21:28:00', 'VEN2', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(168, 'TESMG1001-OCC', '191', '1', '2014-09-12 14:30:00', 'VEN2', 'USD', 1, 182.5, 0, 36.5, 219, 20, 'O', NULL, NULL),
(169, 'TESMG1002-OCC', '192', '1', '2014-09-12 18:46:00', 'VEN2', 'USD', 1, 107.5, 0, 21.5, 129, 20, 'O', NULL, NULL),
(170, 'TEAPL1003-OCC', '193', '1', '2014-09-14 22:54:00', 'VEN2', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(171, 'TEAPL1003-CNF', '194', '1', '2014-09-15 09:45:00', 'VEN2', 'USD', 1, 149.17, 0, 29.83, 179, 20, 'O', NULL, NULL),
(172, 'TESMG1004-OCC', '196', '1', '2014-09-15 22:54:00', 'VEN2', 'USD', 1, 257.5, 0, 51.5, 309, 20, 'O', NULL, NULL),
(173, 'TESMG1003-OCC', '197', '1', '2014-09-16 07:07:00', 'VEN2', 'USD', 1, 107.5, 0, 21.5, 129, 20, 'O', NULL, NULL),
(174, 'TESMG1003-OCC', '198', '1', '2014-09-16 10:08:00', 'VEN2', 'USD', 1, 107.5, 0, 21.5, 129, 20, 'O', NULL, NULL),
(175, 'TESMG1002-OCC', '199', '1', '2014-09-21 20:04:00', 'VEN2', 'USD', 1, 107.5, 0, 21.5, 129, 20, 'O', NULL, NULL),
(176, 'TESMG1002-OCC', '200', '1', '2014-09-23 12:54:00', 'VEN2', 'USD', 1, 107.5, 0, 21.5, 129, 20, 'O', NULL, NULL),
(177, 'TESMG1003-OCC', '201', '1', '2014-09-24 16:06:00', 'VEN2', 'USD', 1, 99.17, 0, 19.83, 119, 20, 'O', NULL, NULL),
(178, 'TESMG1003-OCC', '202', '1', '2014-09-24 20:27:00', 'VEN2', 'USD', 1, 99.17, 0, 19.83, 119, 20, 'O', NULL, NULL),
(179, 'TESMG1001-CNF', '203', '1', '2014-09-25 23:46:00', 'VEN2', 'USD', 1, 182.5, 0, 36.5, 219, 20, 'O', NULL, NULL),
(180, 'TESMG1003-OCC', '204', '1', '2014-09-29 14:26:00', 'VEN2', 'USD', 1, 99.17, 0, 19.83, 119, 20, 'O', NULL, NULL),
(181, 'TEAPL1002-OCC', '205', '1', '2014-09-30 14:06:00', 'VEN2', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(182, 'TESMG1003-OCC', '206', '1', '2014-10-01 10:58:00', 'VEN2', 'USD', 1, 99.17, 0, 19.83, 119, 20, 'O', NULL, NULL),
(183, 'TESMG1003-OCC', '207', '1', '2014-10-01 13:44:00', 'VEN2', 'USD', 1, 99.17, 0, 19.83, 119, 20, 'O', NULL, NULL),
(184, 'TEAPL1003-OCC', '208', '1', '2014-10-01 21:16:00', 'VEN2', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(185, 'TEAPL1012-CNF', '209', '1', '2014-10-05 11:15:00', 'VEN2', 'USD', 1, 315.83, 0, 63.17, 379, 20, 'O', NULL, NULL),
(186, 'TESMG1001-OCC', '210', '1', '2014-10-05 19:26:00', 'VEN2', 'USD', 1, 182.5, 0, 36.5, 219, 20, 'O', NULL, NULL),
(187, 'TEAPL1002-OCC', '211', '1', '2014-10-06 18:38:00', 'VEN2', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(188, 'TESMG1003-OCC', '212', '1', '2014-10-11 13:16:00', 'VEN2', 'USD', 1, 99.17, 0, 19.83, 119, 20, 'O', NULL, NULL),
(189, 'TEAPL1003-OCC', '213', '1', '2014-10-11 18:13:00', 'VEN2', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(190, 'TEAPL1003-OCC', '214', '1', '2014-10-14 06:57:00', 'VEN2', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(191, 'TEAPL1003-OCC', '215', '1', '2014-10-14 13:00:00', 'VEN2', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(192, 'TEAPL1002-OCC', '216', '1', '2014-10-14 19:01:00', 'VEN2', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(193, 'TEAPL1008-OCC', '217', '1', '2014-10-15 20:25:00', 'VEN2', 'USD', 1, 208.33, 0, 41.67, 250, 20, 'O', NULL, NULL),
(194, 'TEAPL1003-OCC', '218', '1', '2014-10-16 12:36:00', 'VEN2', 'USD', 1, 125, 0, 25, 150, 20, 'O', NULL, NULL),
(195, 'TEAPL1002-OCC', '219', '1', '2014-10-16 14:41:00', 'VEN2', 'USD', 1, 125, 0, 25, 150, 20, 'O', NULL, NULL),
(196, 'TEAPL1002-OCC', '220', '1', '2014-10-17 08:19:00', 'VEN2', 'USD', 1, 125, 0, 25, 150, 20, 'O', NULL, NULL),
(197, 'TEAPL1008-OCC', '221', '1', '2014-10-17 14:12:00', 'VEN2', 'USD', 1, 187.5, 0, 37.5, 225, 20, 'O', NULL, NULL),
(198, 'TEAPL1003-OCC', '222', '1', '2014-10-18 20:06:00', 'VEN2', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(199, 'TEAPL1003-OCC', '223', '1', '2014-10-19 19:01:00', 'VEN2', 'USD', 1, 125, 0, 25, 150, 20, 'O', NULL, NULL),
(200, 'TEAPL1008-OCC', '224', '1', '2014-10-19 19:10:00', 'VEN2', 'USD', 1, 187.5, 0, 37.5, 225, 20, 'O', NULL, NULL),
(201, 'TESMG1001-OCC', '225', '1', '2014-10-20 19:37:00', 'VEN2', 'USD', 1, 164.17, 0, 32.83, 197, 20, 'O', NULL, NULL),
(202, 'TESMG1002-OCC', '226', '1', '2014-10-20 18:30:00', 'VEN2', 'USD', 1, 99.17, 0, 19.83, 119, 20, 'O', NULL, NULL),
(203, 'TEAPL1002-OCC', '227', '1', '2014-10-21 15:15:00', 'VEN2', 'USD', 1, 125, 0, 25, 150, 20, 'O', NULL, NULL),
(204, 'TEAPL1002-OCC', '228', '1', '2014-10-22 16:41:00', 'VEN2', 'USD', 1, 125, 0, 25, 150, 20, 'N', NULL, NULL),
(205, 'TESMG1003-OCC', '229', '1', '2014-10-23 22:27:00', 'VEN2', 'USD', 1, 99.17, 0, 19.83, 119, 20, 'O', NULL, NULL),
(206, 'TEAPL1002-OCC', '230', '1', '2014-10-24 15:46:00', 'VEN2', 'USD', 1, 125, 0, 25, 150, 20, 'O', NULL, NULL),
(207, 'TEAPL1002-OCC', '231', '1', '2014-10-25 18:17:00', 'VEN2', 'USD', 1, 125, 0, 25, 150, 20, 'O', NULL, NULL),
(208, 'TEAPL1002-OCC', '232', '1', '2014-10-25 18:36:00', 'VEN2', 'USD', 1, 125, 0, 25, 150, 20, 'O', NULL, NULL),
(209, 'TEAPL1003-OCC', '233', '1', '2014-10-25 19:12:00', 'VEN2', 'USD', 1, 125, 0, 25, 150, 20, 'O', NULL, NULL),
(210, 'TESMG1004-OCC', '235', '1', '2014-11-06 20:32:00', 'VEN2', 'USD', 1, 165.83, 0, 33.17, 199, 20, 'N', NULL, NULL),
(211, 'TESMG1004-OCC', '236', '1', '2014-11-06 22:13:00', 'VEN2', 'USD', 1, 165.83, 0, 33.17, 199, 20, 'O', NULL, NULL),
(212, 'TESMG1004-OCC', '237', '1', '2014-11-06 22:30:00', 'VEN2', 'USD', 1, 165.83, 0, 33.17, 199, 20, 'O', NULL, NULL),
(213, 'TESMG1003-OCC', '238', '1', '2014-11-07 19:14:00', 'VEN2', 'USD', 1, 175, 0, 35, 210, 20, 'O', NULL, NULL),
(214, 'TESMG1002-OCC', '239', '1', '2014-11-08 10:54:00', 'VEN2', 'USD', 1, 87.5, 0, 17.5, 105, 20, 'O', NULL, NULL),
(215, 'TESMG1000-OCC', '240', '1', '2014-11-08 12:18:00', 'VEN2', 'USD', 1, 165.83, 0, 33.17, 199, 20, 'O', NULL, NULL),
(216, 'TESMG1002-OCC', '241', '1', '2014-11-09 17:38:00', 'VEN2', 'USD', 1, 87.5, 0, 17.5, 105, 20, 'O', NULL, NULL),
(217, 'TESMG1001-OCC', '242', '1', '2014-11-07 17:29:00', 'VEN2', 'USD', 1, 165.83, 0, 33.17, 199, 20, 'O', NULL, NULL),
(218, 'TEAPL1002-OCC', '243', '3', '2014-11-12 12:57:00', 'VEN2', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'O', NULL, NULL),
(219, 'TESMG1002-OCC', '244', '3', '2014-11-12 21:19:00', 'VEN2', 'USD', 1, 87.5, 0, 17.5, 105, 20, 'O', NULL, NULL),
(220, 'TESMG1002-OCC', '245', '1', '2014-11-12 22:45:00', 'VEN2', 'USD', 1, 87.5, 0, 17.5, 105, 20, 'O', NULL, NULL),
(221, 'TESMG1008-OCC', '246', '3', '2014-11-13 20:44:00', 'VEN2', 'USD', 1, 87.5, 0, 17.5, 105, 20, 'O', NULL, NULL),
(222, 'TESMG1001-OCC', '247', '1', '2014-11-14 17:11:00', 'VEN2', 'USD', 1, 165.83, 0, 33.17, 199, 20, 'O', NULL, NULL),
(223, 'TESMG1003-OCC', '248', '1', '2014-11-16 18:17:00', 'VEN2', 'USD', 1, 87.5, 0, 17.5, 105, 20, 'N', NULL, NULL),
(224, 'TEAPL1012-OCC-C', '249', '1', '2014-11-17 18:39:00', 'VEN2', 'USD', 1, 249.17, 0, 49.83, 299, 20, 'N', NULL, NULL),
(225, 'TEAPL1002-OCC', '250', '1', '2014-11-18 10:25:00', 'VEN2', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'N', NULL, NULL),
(226, 'TESMG1000-OCC', '251', '1', '2014-11-18 16:34:00', 'VEN2', 'USD', 1, 165.83, 0, 33.17, 199, 20, 'N', NULL, NULL),
(227, 'TESMG1000-OCC', '252', '1', '2014-11-18 20:44:00', 'VEN2', 'USD', 1, 165.83, 0, 33.17, 199, 20, 'N', NULL, NULL),
(228, 'TEAPL1002-OCC', '253', '1', '2014-11-19 20:04:00', 'VEN2', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'N', NULL, NULL),
(229, 'TESMG1009-CNF', '254', '1', '2014-11-20 04:10:00', 'VEN2', 'USD', 1, 99.17, 0, 19.83, 119, 20, 'N', NULL, NULL),
(230, 'TEAPL1013-OCC-C', '25', '1', '2014-11-20 10:44:00', 'VEN2', 'USD', 1, 249.17, 0, 49.83, 299, 20, 'N', NULL, NULL),
(231, 'TESMG1008-OCC', '257', '1', '2014-11-20 23:46:00', 'VEN2', 'USD', 1, 87.5, 0, 17.5, 105, 20, 'N', NULL, NULL),
(232, 'TESMG1008-OCC', '258', '1', '2014-11-24 19:40:00', 'VEN2', 'USD', 1, 87.5, 0, 17.5, 105, 20, 'N', NULL, NULL),
(233, 'TEAPL1002-OCC', '243', '1', '2015-11-12 12:57:00', 'VEN2', 'USD', 1, 140.83, 0, 28.17, 169, 20, 'N', NULL, NULL),
(234, 'TEAPL1000-CNF', '111', '3', '2015-02-11 16:00:23', 'VEN2', 'USD', 1, 34, 0, 10, 44, 20, 'N', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cmde_fournisseur`
--

CREATE TABLE IF NOT EXISTS `cmde_fournisseur` (
`ref_cmdef` int(11) NOT NULL,
  `ref_fournisseur` int(11) DEFAULT NULL,
  `date_cmde` datetime DEFAULT NULL,
  `statut` varchar(25) DEFAULT NULL,
  `ref_cmde_externe` varchar(50) DEFAULT NULL,
  `commentaire` varchar(100) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `date_heure_maj` datetime DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cmde_fournisseur`
--

INSERT INTO `cmde_fournisseur` (`ref_cmdef`, `ref_fournisseur`, `date_cmde`, `statut`, `ref_cmde_externe`, `commentaire`, `user_id`, `date_heure_maj`) VALUES
(15, 1, '2015-04-28 22:18:56', 'saisie', 'ref_bidon_3_sans_demande', '', 'bidon', '2015-04-28 22:18:56'),
(12, 1, '2015-04-28 16:17:37', 'saisie', 'ref_bidon_1', '', 'bidon', '2015-04-28 16:17:37'),
(13, 2, '2015-04-28 16:21:20', 'saisie', 'ref_bidon_2_sans_demande', '', 'bidon', '2015-04-28 16:21:20'),
(14, 3, '2015-04-28 16:23:56', 'saisie', 'ref_bidon_3', '', 'bidon', '2015-04-28 16:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `demande_zfw`
--

CREATE TABLE IF NOT EXISTS `demande_zfw` (
`ref_dde_zfw` int(11) NOT NULL,
  `ref_canal_distrib` int(11) DEFAULT NULL,
  `ref_produit` varchar(25) DEFAULT NULL,
  `date_demande` datetime DEFAULT NULL,
  `qte_ddee` int(11) DEFAULT '0',
  `qte_cmdee` int(11) DEFAULT '0',
  `user_id` varchar(10) DEFAULT NULL,
  `date_dern_maj` datetime DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `demande_zfw`
--

INSERT INTO `demande_zfw` (`ref_dde_zfw`, `ref_canal_distrib`, `ref_produit`, `date_demande`, `qte_ddee`, `qte_cmdee`, `user_id`, `date_dern_maj`) VALUES
(1, 1, 'TEAPL1011-CNF', '2015-04-28 09:49:33', 45, 45, 'bidon', '2015-04-28 09:49:33'),
(2, 1, 'TEAPL1000-OCC', '2015-04-28 10:00:29', 80, 80, 'bidon', '2015-04-28 10:01:37');

-- --------------------------------------------------------

--
-- Table structure for table `devis`
--

CREATE TABLE IF NOT EXISTS `devis` (
`ref_devis` int(11) NOT NULL,
  `ref_prospect` varchar(10) DEFAULT NULL,
  `ref_produit` varchar(25) DEFAULT NULL,
  `ref_vendeur` varchar(10) DEFAULT NULL,
  `qté` int(11) DEFAULT '0',
  `montant_devis_ht` double DEFAULT '0',
  `montant_devis_total` double DEFAULT '0',
  `code_devise` varchar(3) DEFAULT NULL,
  `date_devis` datetime DEFAULT NULL,
  `durée_validité` varchar(25) DEFAULT NULL,
  `commentaire` varchar(100) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `date_heure_maj` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `devise`
--

CREATE TABLE IF NOT EXISTS `devise` (
  `code_devise` varchar(3) NOT NULL,
  `libelle` varchar(25) DEFAULT NULL,
  `sens_pivot_usd` varchar(3) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `date_cours_maj` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `devise`
--

INSERT INTO `devise` (`code_devise`, `libelle`, `sens_pivot_usd`, `user_id`, `date_cours_maj`) VALUES
('USD', 'Dollar US', '1', 'JRO', '2015-04-09 00:00:00'),
('FCO', 'Franc Congolais', '1', 'JRO', '2015-04-09 00:00:00'),
('XAF', 'Franc CFA', '1', 'JRO', '2015-04-09 00:00:00'),
('EUR', 'Euro', '2', 'JRO', '2015-04-09 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `essai`
--

CREATE TABLE IF NOT EXISTS `essai` (
  `age` int(10) NOT NULL,
  `nom` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `essai`
--

INSERT INTO `essai` (`age`, `nom`) VALUES
(10, 'alex'),
(7, 'cannelle');

-- --------------------------------------------------------

--
-- Table structure for table `expedition_bee`
--

CREATE TABLE IF NOT EXISTS `expedition_bee` (
`ref_expedition_bee` int(11) NOT NULL,
  `commentaire` varchar(100) DEFAULT NULL,
  `date_expedition` datetime DEFAULT NULL,
  `ref_prestataire` varchar(10) DEFAULT NULL,
  `ref_externe_prestataire` varchar(50) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `date_heure_maj` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `facturation_client`
--

CREATE TABLE IF NOT EXISTS `facturation_client` (
`ref_facturec` int(11) NOT NULL,
  `ref_cmdec` varchar(10) DEFAULT NULL,
  `montant_ht` double DEFAULT '0',
  `montant_ttc` double DEFAULT '0',
  `code_devise` varchar(3) DEFAULT NULL,
  `délai_reglt_prev` varchar(25) DEFAULT NULL,
  `statut` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `facturation_fournisseur`
--

CREATE TABLE IF NOT EXISTS `facturation_fournisseur` (
`ref_facturef` int(11) NOT NULL,
  `ref_cmdef` varchar(10) DEFAULT NULL,
  `montant_ht` double DEFAULT '0',
  `montant_ttc` double DEFAULT '0',
  `code_devise` varchar(3) DEFAULT NULL,
  `delai_reglt_prev` varchar(25) DEFAULT NULL,
  `date_edition` datetime DEFAULT NULL,
  `statut` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `facturation_prestataire`
--

CREATE TABLE IF NOT EXISTS `facturation_prestataire` (
`ref_facturation_prestataire` int(11) NOT NULL,
  `ref_Prestataire` varchar(10) DEFAULT NULL,
  `commentaire` varchar(100) DEFAULT NULL,
  `date_cmde` datetime DEFAULT NULL,
  `date_paiement_prev` datetime DEFAULT NULL,
  `montant_facture` double DEFAULT '0',
  `code_devise` varchar(3) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `date_heure_maj` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `facturation_zfw`
--

CREATE TABLE IF NOT EXISTS `facturation_zfw` (
  `ref_ligne_cmdef` varchar(10) NOT NULL,
  `montant_a_payer` double DEFAULT '0',
  `montant_réglé` double DEFAULT '0',
  `code_devise` varchar(3) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `flag_valide` varchar(1) DEFAULT NULL,
  `date_heure_maj` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fournisseur`
--

CREATE TABLE IF NOT EXISTS `fournisseur` (
`ref_fournisseur` int(11) NOT NULL,
  `nom` varchar(25) DEFAULT NULL,
  `contact` varchar(25) DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `ville` varchar(25) DEFAULT NULL,
  `pays` varchar(25) DEFAULT NULL,
  `tel1` varchar(25) DEFAULT NULL,
  `tel2` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `commentaire` varchar(100) DEFAULT NULL,
  `flag_expedition` varchar(1) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `date_heure_maj` datetime DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fournisseur`
--

INSERT INTO `fournisseur` (`ref_fournisseur`, `nom`, `contact`, `adresse`, `ville`, `pays`, `tel1`, `tel2`, `email`, `commentaire`, `flag_expedition`, `user_id`, `date_heure_maj`) VALUES
(1, 'BELCOM', 'René Girard', NULL, 'Bruxelles', 'Belgique', '0103445354', '3435542123', 'accueil@belcom.com', NULL, 'O', NULL, NULL),
(2, 'TELE2', 'Mr Vanderwiel', NULL, 'Anvers', 'Belqique', '454654646', '454545555', NULL, NULL, 'N', NULL, NULL),
(3, 'CELNEW', 'Germain Assis', NULL, 'Paris', 'France', '343443434', '343534553', NULL, NULL, 'O', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `habilitation`
--

CREATE TABLE IF NOT EXISTS `habilitation` (
  `code_profile` varchar(10) NOT NULL,
  `code_traitement` varchar(25) NOT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `date_heure_maj` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `imei_recu_bee`
--

CREATE TABLE IF NOT EXISTS `imei_recu_bee` (
  `code_imei` varchar(25) NOT NULL,
  `ref_cmdef` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `imei_vente`
--

CREATE TABLE IF NOT EXISTS `imei_vente` (
  `code_imei` varchar(25) NOT NULL,
  `ref_cmdec` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lieu_stockage`
--

CREATE TABLE IF NOT EXISTS `lieu_stockage` (
`ref_lieu_stockage` int(11) NOT NULL,
  `libelle` varchar(50) DEFAULT NULL,
  `pays` varchar(25) DEFAULT NULL,
  `region` varchar(25) DEFAULT NULL,
  `ville` varchar(25) DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `commentaire` varchar(100) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `date_heure_maj` datetime DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lieu_stockage`
--

INSERT INTO `lieu_stockage` (`ref_lieu_stockage`, `libelle`, `pays`, `region`, `ville`, `adresse`, `commentaire`, `user_id`, `date_heure_maj`) VALUES
(1, 'Boutique Kinshasa', 'RDC', 'Kin', 'Kinshasa', NULL, NULL, NULL, NULL),
(2, 'Entrepôt Brazzaville', 'Congo', 'Capitale', 'Brazzaville', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ligne_commande_origine`
--

CREATE TABLE IF NOT EXISTS `ligne_commande_origine` (
`ref_l_cmdef` int(11) NOT NULL,
  `ref_cmdef` int(11) DEFAULT NULL,
  `ref_demande_zfw` int(11) DEFAULT NULL,
  `ref_produit` varchar(25) DEFAULT NULL,
  `qte_cmdee` int(11) DEFAULT '0',
  `prix_unitaire` double DEFAULT '0',
  `code_devise` varchar(3) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ligne_commande_origine`
--

INSERT INTO `ligne_commande_origine` (`ref_l_cmdef`, `ref_cmdef`, `ref_demande_zfw`, `ref_produit`, `qte_cmdee`, `prix_unitaire`, `code_devise`) VALUES
(1, 12, 1, 'TEAPL1011-CNF', 45, 52, 'USD'),
(2, 13, 0, 'TEBBL1000-OCC', 8, 45, 'USD'),
(3, 13, 0, 'TEAPL1006-OCC', 80, 30, 'EUR'),
(4, 14, 2, 'TEAPL1000-OCC', 80, 87, 'FCO'),
(5, 15, 0, 'TEAPL1000-CNF', 1, 100, 'USD');

-- --------------------------------------------------------

--
-- Table structure for table `ligne_commande_retour`
--

CREATE TABLE IF NOT EXISTS `ligne_commande_retour` (
`ref_l_cmdef_ret` int(11) NOT NULL,
  `ref_l_cmdef` int(11) DEFAULT NULL,
  `origine_ligne` varchar(5) DEFAULT NULL,
  `ref_produit` varchar(25) DEFAULT NULL,
  `qte_reçue` int(11) DEFAULT '0',
  `date_validation` datetime DEFAULT NULL,
  `flag_ligne_validee` varchar(1) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `date_heure_maj` datetime DEFAULT NULL,
  `ref_l_expedition_bee` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ligne_expedition_bee`
--

CREATE TABLE IF NOT EXISTS `ligne_expedition_bee` (
`ref_l_expedition_bee` int(11) NOT NULL,
  `ref_expedition_bee` varchar(10) DEFAULT NULL,
  `ref_produit` varchar(25) DEFAULT NULL,
  `Qté_expédiée` int(11) DEFAULT '0',
  `Qté_reçue` int(11) DEFAULT '0',
  `date_réception` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `litige_client`
--

CREATE TABLE IF NOT EXISTS `litige_client` (
`ref_litige` int(11) NOT NULL,
  `ref_cmdec` varchar(10) DEFAULT NULL,
  `date_retour` datetime DEFAULT NULL,
  `commentaire` varchar(100) DEFAULT NULL,
  `statut` varchar(25) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `date_heure_maj` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `paiement_bee`
--

CREATE TABLE IF NOT EXISTS `paiement_bee` (
`ref_paiement_bee` int(11) NOT NULL,
  `ref_cmde` varchar(10) DEFAULT NULL,
  `date_paiement` datetime DEFAULT NULL,
  `montant_réglé` double DEFAULT '0',
  `code_devise` varchar(3) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `date_heure_maj` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `paiement_client`
--

CREATE TABLE IF NOT EXISTS `paiement_client` (
`ref_paiement_client` int(11) NOT NULL,
  `ref_cmdec` varchar(10) DEFAULT NULL,
  `date_paiement` datetime DEFAULT NULL,
  `montant_réglé` double DEFAULT '0',
  `user_id` varchar(10) DEFAULT NULL,
  `date_heure_maj` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `paiement_dde_zfw`
--

CREATE TABLE IF NOT EXISTS `paiement_dde_zfw` (
`ref_paiement_dde_zfw` int(11) NOT NULL,
  `ref_dde_zfw` int(11) NOT NULL,
  `date_paiement` datetime NOT NULL,
  `montant_regle` float NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `date_heure_maj` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paiement_zfw`
--

CREATE TABLE IF NOT EXISTS `paiement_zfw` (
`ref_paiement_zfw` int(11) NOT NULL,
  `ref_facturation` varchar(10) DEFAULT NULL,
  `date_paiement` datetime DEFAULT NULL,
  `montant_réglé` double DEFAULT '0',
  `user_id` varchar(10) DEFAULT NULL,
  `date_heure_maj` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `parité_devise`
--

CREATE TABLE IF NOT EXISTS `parité_devise` (
  `date_cotation` datetime NOT NULL,
  `code_devise` varchar(3) NOT NULL,
  `cours` double DEFAULT '0',
  `user_id` varchar(10) DEFAULT NULL,
  `date_heure_maj` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parité_devise`
--

INSERT INTO `parité_devise` (`date_cotation`, `code_devise`, `cours`, `user_id`, `date_heure_maj`) VALUES
('2015-04-02 00:00:00', 'EUR', 1.2, 'JRO', '2015-04-03 00:00:00'),
('2015-04-02 00:00:00', 'XAF', 656.74, 'JRO', '2015-04-03 00:00:00'),
('2015-04-02 00:00:00', 'FCO', 712.5, 'JRO', '2015-04-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `position_zfw`
--

CREATE TABLE IF NOT EXISTS `position_zfw` (
  `date_archivage` datetime NOT NULL,
  `ref_lieu_stockage` varchar(10) NOT NULL,
  `ref_produit` varchar(25) NOT NULL,
  `qte` int(11) DEFAULT '0',
  `user_id` varchar(10) DEFAULT NULL,
  `date_heure_maj` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `prestataire`
--

CREATE TABLE IF NOT EXISTS `prestataire` (
`ref_prestataire` int(11) NOT NULL,
  `nom` varchar(25) DEFAULT NULL,
  `secteur_activité` varchar(25) DEFAULT NULL,
  `commentaire` varchar(100) DEFAULT NULL,
  `tel1` varchar(25) DEFAULT NULL,
  `tel2` varchar(25) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `ville` varchar(25) DEFAULT NULL,
  `région` varchar(25) DEFAULT NULL,
  `pays` varchar(25) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `date_heure_maj` datetime DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prestataire`
--

INSERT INTO `prestataire` (`ref_prestataire`, `nom`, `secteur_activité`, `commentaire`, `tel1`, `tel2`, `email`, `adresse`, `ville`, `région`, `pays`, `user_id`, `date_heure_maj`) VALUES
(1, 'UPS', 'Transport', NULL, '0342455456', '43545353', 'contact@ups.com', NULL, 'kinshasa', 'Kin', 'RDC', NULL, NULL),
(2, 'Fedex', 'Transport', NULL, '4535455454', NULL, NULL, NULL, 'Paris', 'IDF', 'France', NULL, NULL),
(3, 'GE', 'Energie', 'Fournisseur d''electricité', '34343434', NULL, NULL, NULL, 'Kinshasa', 'Kin', 'RDC', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `ref_produit` varchar(25) NOT NULL,
  `marque` varchar(50) DEFAULT NULL,
  `modele` varchar(100) DEFAULT NULL,
  `couleur` varchar(25) DEFAULT NULL,
  `etat` varchar(25) DEFAULT NULL,
  `commentaire` varchar(100) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `date_heure_maj` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`ref_produit`, `marque`, `modele`, `couleur`, `etat`, `commentaire`, `user_id`, `date_heure_maj`) VALUES
('TEAPL1000-CNF', 'APPLE', 'Apple Iphone 3GS 8 Go - Blanc - Débloqué', 'Blanc', '1', 'En Parfait etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En Parfait état - Contrô', NULL, NULL),
('TEAPL1000-OCC', 'APPLE', 'Apple Iphone 3GS 8 Go - Blanc - Débloqué', 'Blanc', '2', 'Très Bon etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En très bon état - Contrôl', NULL, NULL),
('TEAPL1001-CNF', 'APPLE', 'Apple Iphone 3GS 8 Go - Noir - Débloqué', 'Noir', '1', 'En Parfait etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En Parfait état - Contrô', NULL, NULL),
('TEAPL1001-OCC', 'APPLE', 'Apple Iphone 3GS 8 Go - Noir - Débloqué', 'Noir', '2', 'Très Bon etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En très bon état - Contrôl', NULL, NULL),
('TEAPL1002-CNF', 'APPLE', 'Apple Iphone 4 8 Go - Blanc - Débloqué', 'Blanc', '1', 'En Parfait etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En Parfait état - Contrô', NULL, NULL),
('TEAPL1002-OCC', 'APPLE', 'Apple Iphone 4 8 Go - Blanc - Débloqué', 'Blanc', '2', 'Très Bon etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En très bon état - Contrôl', NULL, NULL),
('TEAPL1003-CNF', 'APPLE', 'Apple Iphone 4 8 Go - Noir - Débloqué', 'Noir', '1', 'En Parfait etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En Parfait état - Contrô', NULL, NULL),
('TEAPL1003-OCC', 'APPLE', 'Apple Iphone 4 8 Go - Noir - Débloqué', 'Noir', '2', 'Très Bon etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En très bon état - Contrôl', NULL, NULL),
('TEAPL1004-CNF', 'APPLE', 'Apple Iphone 4 16 Go - Blanc - Débloqué', 'Blanc', '1', 'En Parfait etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En Parfait état - Contrô', NULL, NULL),
('TEAPL1004-OCC', 'APPLE', 'Apple Iphone 4 16 Go - Blanc - Débloqué', 'Blanc', '2', 'Très Bon etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En très bon état - Contrôl', NULL, NULL),
('TEAPL1005-CNF', 'APPLE', 'Apple Iphone 4 16 Go - Noir - Débloqué', 'Noir', '1', 'En Parfait etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En Parfait état - Contrô', NULL, NULL),
('TEAPL1005-OCC', 'APPLE', 'Apple Iphone 4 16 Go - Noir - Débloqué', 'Noir', '2', 'Très Bon etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En très bon état - Contrôl', NULL, NULL),
('TEAPL1006-CNF', 'APPLE', 'Apple Iphone 4 32 Go - Blanc - Débloqué', 'Blanc', '1', 'En Parfait etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En Parfait état - Contrô', NULL, NULL),
('TEAPL1006-OCC', 'APPLE', 'Apple Iphone 4 32 Go - Blanc - Débloqué', 'Blanc', '2', 'Très Bon etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En très bon état - Contrôl', NULL, NULL),
('TEAPL1007-CNF', 'APPLE', 'Apple Iphone 4 32 Go - Noir - Débloqué', 'Noir', '1', 'En Parfait etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En Parfait état - Contrô', NULL, NULL),
('TEAPL1007-OCC', 'APPLE', 'Apple Iphone 4 32 Go - Noir - Débloqué', 'Noir', '2', 'Très Bon etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En très bon état - Contrôl', NULL, NULL),
('TEAPL1008-CNF', 'APPLE', 'Apple Iphone 4S 16 Go - Blanc - Débloqué', 'Blanc', '1', 'En Parfait etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En Parfait état - Contrô', NULL, NULL),
('TEAPL1008-OCC', 'APPLE', 'Apple Iphone 4S 16 Go - Blanc - Débloqué', 'Blanc', '2', 'Très Bon etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En très bon état - Contrôl', NULL, NULL),
('TEAPL1009-CNF', 'APPLE', 'Apple Iphone 4S 16 Go - Noir - Débloqué', 'Noir', '1', 'En Parfait etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En Parfait état - Contrô', NULL, NULL),
('TEAPL1009-OCC', 'APPLE', 'Apple Iphone 4S 16 Go - Noir - Débloqué', 'Noir', '2', 'Très Bon etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En très bon état - Contrôl', NULL, NULL),
('TEAPL1010-CNF', 'APPLE', 'Apple Iphone 4S 32 Go - Blanc - Débloqué', 'Blanc', '1', 'En Parfait etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En Parfait état - Contrô', NULL, NULL),
('TEAPL1010-OCC', 'APPLE', 'Apple Iphone 4S 32 Go - Blanc - Débloqué', 'Blanc', '2', 'Très Bon etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En très bon état - Contrôl', NULL, NULL),
('TEAPL1011-CNF', 'APPLE', 'Apple Iphone 4S 32 Go - Noir - Débloqué', 'Noir', '1', 'En Parfait etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En Parfait état - Contrô', NULL, NULL),
('TEAPL1011-OCC', 'APPLE', 'Apple Iphone 4S 32 Go - Noir - Débloqué', 'Noir', '2', 'Très Bon etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En très bon état - Contrôl', NULL, NULL),
('TEAPL1012-CNF', 'APPLE', 'Apple Iphone 5 16 Go - Blanc - Débloqué', 'Blanc', '1', 'En Parfait etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En Parfait état - Contrô', NULL, NULL),
('TEAPL1012-OCC', 'APPLE', 'Apple Iphone 5 16 Go - Blanc - Débloqué', 'Blanc', '2', 'Très Bon etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En très bon état - Contrôl', NULL, NULL),
('TEAPL1012-OCC-C', 'APPLE', 'Apple Iphone 5 16 Go - Blanc - Débloqué', 'Blanc', '3', 'Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En bon état, peut présenter des micros ray', NULL, NULL),
('TEAPL1013-CNF', 'APPLE', 'Apple Iphone 5 16 Go - Noir - Débloqué', 'Noir', '1', 'En Parfait etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En Parfait état - Contrô', NULL, NULL),
('TEAPL1013-OCC', 'APPLE', 'Apple Iphone 5 16 Go - Noir - Débloqué', 'Noir', '2', 'Très Bon etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En très bon état - Contrôl', NULL, NULL),
('TEAPL1013-OCC-C', 'APPLE', 'Apple Iphone 5 16 Go - Noir - Débloqué', 'Noir', '3', 'Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En bon état, peut présenter des micros ray', NULL, NULL),
('TEAPL1014-CNF', 'APPLE', 'Apple iPhone 5S 16 Go - Gris - Débloqué', 'Gris', '1', 'En Parfait etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En Parfait état - Contrô', NULL, NULL),
('TEAPL1014-OCC', 'APPLE', 'Apple iPhone 5S 16 Go - Gris - Débloqué', 'Gris', '2', 'Très Bon etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En très bon état - Contrôl', NULL, NULL),
('TEAPL1015-CNF', 'APPLE', 'Apple iPhone 5S 16 Go - Argent - Débloqué', 'Argent', '1', 'En Parfait etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En Parfait état - Contrô', NULL, NULL),
('TEAPL1015-OCC', 'APPLE', 'Apple iPhone 5S 16 Go - Argent - Débloqué', 'Argent', '2', 'Très Bon etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En très bon état - Contrôl', NULL, NULL),
('TEAPL1016-CNF', 'APPLE', 'Apple iPhone 5S 16 Go - Or - Débloqué', 'Or', '1', 'Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En parfait état, contrôlé et nettoyé - Fou', NULL, NULL),
('TEBBL1000-OCC', 'BLACKBERRY', 'Blackberry Q5 - 8 Go - Noir - Débloqué', 'Noir', '2', 'Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En très bon état, contrôlé et nettoyé - Po', NULL, NULL),
('TESMG1000-CNF', 'SAMSUNG', 'Samsung Galaxy S4 mini 4G 8 Go - Blanc - Débloqué', 'Blanc', '1', 'En Parfait etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En Parfait état - Contrô', NULL, NULL),
('TESMG1000-OCC', 'SAMSUNG', 'Samsung Galaxy S4 mini 4G 8 Go - Blanc - Débloqué', 'Blanc', '2', 'Très Bon etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En très bon état - Contrôl', NULL, NULL),
('TESMG1001-CNF', 'SAMSUNG', 'Samsung Galaxy S4 mini 4G 8 Go - Noir - Débloqué', 'Noir', '1', 'En Parfait etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En Parfait état - Contrô', NULL, NULL),
('TESMG1001-OCC', 'SAMSUNG', 'Samsung Galaxy S4 mini 4G 8 Go - Noir - Débloqué', 'Noir', '2', 'Très Bon etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En très bon état - Contrôl', NULL, NULL),
('TESMG1002-CNF', 'SAMSUNG', 'Samsung Galaxy S III Mini 8 Go - Blanc - Débloqué', 'Blanc', '1', 'En Parfait etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En Parfait état - Contrô', NULL, NULL),
('TESMG1002-OCC', 'SAMSUNG', 'Samsung Galaxy S III Mini 8 Go - Blanc - Débloqué', 'Blanc', '2', 'Très Bon etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En très bon état - Contrôl', NULL, NULL),
('TESMG1003-CNF', 'SAMSUNG', 'Samsung Galaxy S III Mini 8 Go - Bleu - Débloqué', 'Bleu', '1', 'En Parfait etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En Parfait état - Contrô', NULL, NULL),
('TESMG1003-OCC', 'SAMSUNG', 'Samsung Galaxy S III Mini 8 Go - Bleu - Débloqué', 'Bleu', '2', 'Très Bon etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En très bon état - Contrôl', NULL, NULL),
('TESMG1004-CNF', 'SAMSUNG', 'Samsung Galaxy S4 I9505 16 Go - Blanc - Débloqué', 'Blanc', '1', 'En Parfait etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En Parfait état - Contrô', NULL, NULL),
('TESMG1004-OCC', 'SAMSUNG', 'Samsung Galaxy S4 I9505 16 Go - Blanc - Débloqué', 'Blanc', '2', 'Très Bon etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En très bon état - Contrôl', NULL, NULL),
('TESMG1005-CNF', 'SAMSUNG', 'Samsung Galaxy S4 I9505 16 Go - Noir - Débloqué', 'Noir', '1', 'En Parfait etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En Parfait état - Contrô', NULL, NULL),
('TESMG1005-OCC', 'SAMSUNG', 'Samsung Galaxy S4 I9505 16 Go - Noir - Débloqué', 'Noir', '2', 'Très Bon etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En très bon état - Contrôl', NULL, NULL),
('TESMG1006-OCC', 'SAMSUNG', 'Samsung Galaxy S4 I9505 16 Go - Bleu - Débloqué', 'Bleu', '1', 'Très Bon etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En très bon état - Contrôl', NULL, NULL),
('TESMG1007-OCC', 'SAMSUNG', 'Samsung Galaxy S4 I9505 16 Go - Rose - Débloqué', 'Rose', '2', 'Très Bon etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En très bon état - Contrôl', NULL, NULL),
('TESMG1008-CNF', 'SAMSUNG', 'Samsung Galaxy S III Mini 8 Go - Gris - Débloqué', 'Gris', '1', 'En Parfait etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En Parfait état - Contrô', NULL, NULL),
('TESMG1008-OCC', 'SAMSUNG', 'Samsung Galaxy S III Mini 8 Go - Gris - Débloqué', 'Gris', '2', 'Très Bon etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En très bon état - Contrôl', NULL, NULL),
('TESMG1009-CNF', 'SAMSUNG', 'Samsung Galaxy S III Mini 8 Go - Ambre - Débloqué', 'Ambre', '1', 'En Parfait etat - Vendeur pro - Garantie 3 mois - Débloqué tout opérateur - En Parfait état - Contrô', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `code_profile` varchar(10) NOT NULL,
  `libellé` varchar(25) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `date_heure_maj` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`code_profile`, `libellé`, `user_id`, `date_heure_maj`) VALUES
('ADMIN', 'Administrateur du site', NULL, NULL),
('VEND', 'Vendeur', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prospect`
--

CREATE TABLE IF NOT EXISTS `prospect` (
`ref_prospect` int(11) NOT NULL,
  `prénom` varchar(25) DEFAULT NULL,
  `nom` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tel1` varchar(25) DEFAULT NULL,
  `tel2` varchar(25) DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `ville` varchar(25) DEFAULT NULL,
  `region` varchar(25) DEFAULT NULL,
  `pays` varchar(25) DEFAULT NULL,
  `date_entrée` datetime DEFAULT NULL,
  `date_première_vente` datetime DEFAULT NULL,
  `commentaire` varchar(100) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `date_heure_maj` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stock_bee`
--

CREATE TABLE IF NOT EXISTS `stock_bee` (
  `date_archivage` datetime NOT NULL,
  `ref_produit` varchar(25) NOT NULL,
  `qté` int(11) DEFAULT '0',
  `user_id` varchar(10) DEFAULT NULL,
  `date_heure_maj` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `traitement`
--

CREATE TABLE IF NOT EXISTS `traitement` (
  `code_traitement` varchar(25) NOT NULL,
  `description` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `identifiant` varchar(10) NOT NULL,
  `prenom` varchar(25) DEFAULT NULL,
  `nom` varchar(25) DEFAULT NULL,
  `code_profile` varchar(10) DEFAULT NULL,
  `fonction` varchar(50) DEFAULT NULL,
  `mot_de_passe` varchar(25) DEFAULT NULL,
  `ref_canal_distrib` varchar(10) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `date_heure_maj` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`identifiant`, `prenom`, `nom`, `code_profile`, `fonction`, `mot_de_passe`, `ref_canal_distrib`, `user_id`, `date_heure_maj`) VALUES
('JRO', 'Jose', 'Romero', 'ADMIN', 'Informaticien', 'Jose', NULL, NULL, NULL),
('VEN1', 'Michel', 'Samba', 'VEND', 'Vendeur', NULL, '1', NULL, NULL),
('VEN2', 'Laurent', 'Herzberg', 'VEND', 'Vendeur', NULL, '2', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `canal_de_distribution`
--
ALTER TABLE `canal_de_distribution`
 ADD PRIMARY KEY (`ref_canal_distrib`);

--
-- Indexes for table `catalogue_produit`
--
ALTER TABLE `catalogue_produit`
 ADD PRIMARY KEY (`date_validité`,`ref_produit`,`ref_Canal_distrib`,`code_devise`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
 ADD PRIMARY KEY (`ref_client`);

--
-- Indexes for table `cmde_client`
--
ALTER TABLE `cmde_client`
 ADD PRIMARY KEY (`ref_cmdec`), ADD KEY `code_devise` (`code_devise`);

--
-- Indexes for table `cmde_fournisseur`
--
ALTER TABLE `cmde_fournisseur`
 ADD PRIMARY KEY (`ref_cmdef`);

--
-- Indexes for table `demande_zfw`
--
ALTER TABLE `demande_zfw`
 ADD PRIMARY KEY (`ref_dde_zfw`);

--
-- Indexes for table `devis`
--
ALTER TABLE `devis`
 ADD PRIMARY KEY (`ref_devis`), ADD KEY `code_devise` (`code_devise`);

--
-- Indexes for table `devise`
--
ALTER TABLE `devise`
 ADD PRIMARY KEY (`code_devise`), ADD KEY `code_devise` (`code_devise`);

--
-- Indexes for table `essai`
--
ALTER TABLE `essai`
 ADD PRIMARY KEY (`nom`);

--
-- Indexes for table `expedition_bee`
--
ALTER TABLE `expedition_bee`
 ADD PRIMARY KEY (`ref_expedition_bee`);

--
-- Indexes for table `facturation_client`
--
ALTER TABLE `facturation_client`
 ADD PRIMARY KEY (`ref_facturec`), ADD KEY `code_devise` (`code_devise`);

--
-- Indexes for table `facturation_fournisseur`
--
ALTER TABLE `facturation_fournisseur`
 ADD PRIMARY KEY (`ref_facturef`), ADD KEY `code_devise` (`code_devise`);

--
-- Indexes for table `facturation_prestataire`
--
ALTER TABLE `facturation_prestataire`
 ADD PRIMARY KEY (`ref_facturation_prestataire`), ADD KEY `code_devise` (`code_devise`);

--
-- Indexes for table `facturation_zfw`
--
ALTER TABLE `facturation_zfw`
 ADD PRIMARY KEY (`ref_ligne_cmdef`), ADD KEY `code_devise` (`code_devise`);

--
-- Indexes for table `fournisseur`
--
ALTER TABLE `fournisseur`
 ADD PRIMARY KEY (`ref_fournisseur`);

--
-- Indexes for table `habilitation`
--
ALTER TABLE `habilitation`
 ADD PRIMARY KEY (`code_profile`,`code_traitement`), ADD KEY `code_profile` (`code_profile`), ADD KEY `code_traitement` (`code_traitement`);

--
-- Indexes for table `imei_recu_bee`
--
ALTER TABLE `imei_recu_bee`
 ADD PRIMARY KEY (`code_imei`), ADD KEY `code_imei` (`code_imei`);

--
-- Indexes for table `imei_vente`
--
ALTER TABLE `imei_vente`
 ADD PRIMARY KEY (`code_imei`), ADD KEY `code_imei` (`code_imei`);

--
-- Indexes for table `lieu_stockage`
--
ALTER TABLE `lieu_stockage`
 ADD PRIMARY KEY (`ref_lieu_stockage`);

--
-- Indexes for table `ligne_commande_origine`
--
ALTER TABLE `ligne_commande_origine`
 ADD PRIMARY KEY (`ref_l_cmdef`), ADD KEY `code_devise` (`code_devise`);

--
-- Indexes for table `ligne_commande_retour`
--
ALTER TABLE `ligne_commande_retour`
 ADD PRIMARY KEY (`ref_l_cmdef_ret`);

--
-- Indexes for table `ligne_expedition_bee`
--
ALTER TABLE `ligne_expedition_bee`
 ADD PRIMARY KEY (`ref_l_expedition_bee`);

--
-- Indexes for table `litige_client`
--
ALTER TABLE `litige_client`
 ADD PRIMARY KEY (`ref_litige`);

--
-- Indexes for table `paiement_bee`
--
ALTER TABLE `paiement_bee`
 ADD PRIMARY KEY (`ref_paiement_bee`), ADD KEY `code_devise` (`code_devise`);

--
-- Indexes for table `paiement_client`
--
ALTER TABLE `paiement_client`
 ADD PRIMARY KEY (`ref_paiement_client`);

--
-- Indexes for table `paiement_dde_zfw`
--
ALTER TABLE `paiement_dde_zfw`
 ADD PRIMARY KEY (`ref_paiement_dde_zfw`);

--
-- Indexes for table `paiement_zfw`
--
ALTER TABLE `paiement_zfw`
 ADD PRIMARY KEY (`ref_paiement_zfw`);

--
-- Indexes for table `parité_devise`
--
ALTER TABLE `parité_devise`
 ADD PRIMARY KEY (`date_cotation`,`code_devise`);

--
-- Indexes for table `position_zfw`
--
ALTER TABLE `position_zfw`
 ADD PRIMARY KEY (`date_archivage`,`ref_lieu_stockage`,`ref_produit`);

--
-- Indexes for table `prestataire`
--
ALTER TABLE `prestataire`
 ADD PRIMARY KEY (`ref_prestataire`);

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
 ADD PRIMARY KEY (`ref_produit`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
 ADD PRIMARY KEY (`code_profile`), ADD KEY `code_profile` (`code_profile`);

--
-- Indexes for table `prospect`
--
ALTER TABLE `prospect`
 ADD PRIMARY KEY (`ref_prospect`);

--
-- Indexes for table `stock_bee`
--
ALTER TABLE `stock_bee`
 ADD PRIMARY KEY (`date_archivage`,`ref_produit`);

--
-- Indexes for table `traitement`
--
ALTER TABLE `traitement`
 ADD PRIMARY KEY (`code_traitement`), ADD KEY `code_traitement` (`code_traitement`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
 ADD PRIMARY KEY (`identifiant`), ADD KEY `code_profile` (`code_profile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `canal_de_distribution`
--
ALTER TABLE `canal_de_distribution`
MODIFY `ref_canal_distrib` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
MODIFY `ref_client` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=232;
--
-- AUTO_INCREMENT for table `cmde_client`
--
ALTER TABLE `cmde_client`
MODIFY `ref_cmdec` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=235;
--
-- AUTO_INCREMENT for table `cmde_fournisseur`
--
ALTER TABLE `cmde_fournisseur`
MODIFY `ref_cmdef` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `demande_zfw`
--
ALTER TABLE `demande_zfw`
MODIFY `ref_dde_zfw` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `devis`
--
ALTER TABLE `devis`
MODIFY `ref_devis` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `expedition_bee`
--
ALTER TABLE `expedition_bee`
MODIFY `ref_expedition_bee` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `facturation_client`
--
ALTER TABLE `facturation_client`
MODIFY `ref_facturec` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `facturation_fournisseur`
--
ALTER TABLE `facturation_fournisseur`
MODIFY `ref_facturef` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `facturation_prestataire`
--
ALTER TABLE `facturation_prestataire`
MODIFY `ref_facturation_prestataire` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fournisseur`
--
ALTER TABLE `fournisseur`
MODIFY `ref_fournisseur` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lieu_stockage`
--
ALTER TABLE `lieu_stockage`
MODIFY `ref_lieu_stockage` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ligne_commande_origine`
--
ALTER TABLE `ligne_commande_origine`
MODIFY `ref_l_cmdef` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ligne_commande_retour`
--
ALTER TABLE `ligne_commande_retour`
MODIFY `ref_l_cmdef_ret` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ligne_expedition_bee`
--
ALTER TABLE `ligne_expedition_bee`
MODIFY `ref_l_expedition_bee` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `litige_client`
--
ALTER TABLE `litige_client`
MODIFY `ref_litige` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `paiement_bee`
--
ALTER TABLE `paiement_bee`
MODIFY `ref_paiement_bee` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `paiement_client`
--
ALTER TABLE `paiement_client`
MODIFY `ref_paiement_client` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `paiement_dde_zfw`
--
ALTER TABLE `paiement_dde_zfw`
MODIFY `ref_paiement_dde_zfw` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `paiement_zfw`
--
ALTER TABLE `paiement_zfw`
MODIFY `ref_paiement_zfw` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `prestataire`
--
ALTER TABLE `prestataire`
MODIFY `ref_prestataire` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `prospect`
--
ALTER TABLE `prospect`
MODIFY `ref_prospect` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
