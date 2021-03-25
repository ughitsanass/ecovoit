-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 03, 2021 at 07:39 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecovoit`


-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id_utilisateur` int(11) NOT NULL,
  `id_trajet` int(11) NOT NULL,
  PRIMARY KEY (`id_utilisateur`,`id_trajet`),
  KEY `FK_RESERVATIONS_id_trajet` (`id_trajet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trajets`
--

DROP TABLE IF EXISTS `trajets`;
CREATE TABLE IF NOT EXISTS `trajets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_conducteur` int(11) NOT NULL,
  `id_ville_depart` int(11) NOT NULL,
  `id_ville_arrive` int(11) NOT NULL,
  `date_aller` date NOT NULL,
  `date_retout` date NOT NULL,
  `heure_depart` time NOT NULL,
  `heure_arrive` time NOT NULL,
  `nombre_places` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_conducteur` (`id_conducteur`,`id_ville_depart`,`id_ville_arrive`),
  KEY `FK_TRAJETS_id_ville_depart` (`id_ville_depart`),
  KEY `FK_TRAJETS_id_ville_arrive` (`id_ville_arrive`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifiant` varchar(6) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `age` tinyint(4) NOT NULL,
  `telephone` varchar(40) NOT NULL,
  `grade` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `identifiant`, `prenom`, `nom`, `mot_de_passe`, `age`, `telephone`, `grade`) VALUES
(16, 'aminag', 'amina', 'gadioux', '$2y$10$CU9UgqH4d6zHUyK1mwmd5Okgt5JguJMQ.HXBw3A.o4D6Ma42NvYCO', 28, '123', NULL),
(17, 'alexig', 'alexis', 'gadioux', '$2y$10$sb8a9QWOePufl3.tiXkCkuH0aMbD6Wk.YtfviUpH8soBLmi0xtg9q', 30, '777', NULL),
(18, 'norabo', 'nora', 'bouallegue', '$2y$10$K0i2lib7h5uOmeYFFpQHDuA2ZfLKQ3/sXeREclc.6Q8ylifgW6yfi', 36, '777', NULL),
(19, 'admin', 'anass', 'igli', '$2y$10$JEGApghgXwy6zoGdFn9e.ecqgQamDk5RkDO9bKsThpfV.hJieClhK', 18, '666', NULL),
(20, 'admine', 'adminer', 'adminer', '$2y$10$DSYhuhmRgiIPP6FFAdAeOOFQIVb53S90GvbjJX.on2JH2XV13kVMi', 12, '5555555555', NULL),
(21, 'admine', 'adminer', 'adminer', '$2y$10$bUrpLgK6u9o3P6BBLYs5g.ilxj0E5nnUeLd.SaxVhYTqFbxWN/Hza', 12, '5555555555', NULL),
(22, 'cyrilb', 'cyril', 'Bouallegue', '$2y$10$y8MqCnsBWlx.MS8WOQNLqej6Pl0WccBZviUZRDstJJYW59OVuvl76', 44, '0000', NULL),
(23, 'aiglid', 'dslkfs', 'dfjk', '$2y$10$qBbkTXo1Rk.7k0NnfEaxMeCi5b8lFZChUPLh245MNcP5lczFQCb1e', 9, '0671420322', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `villes`
--

DROP TABLE IF EXISTS `villes`;
CREATE TABLE IF NOT EXISTS `villes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `FK_RESERVATIONS_id_trajet` FOREIGN KEY (`id_trajet`) REFERENCES `trajets` (`id`),
  ADD CONSTRAINT `FK_RESERVATIONS_id_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id`);

--
-- Constraints for table `trajets`
--
ALTER TABLE `trajets`
  ADD CONSTRAINT `FK_TRAJETS_id_conducteur` FOREIGN KEY (`id_conducteur`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `FK_TRAJETS_id_ville_arrive` FOREIGN KEY (`id_ville_arrive`) REFERENCES `villes` (`id`),
  ADD CONSTRAINT `FK_TRAJETS_id_ville_depart` FOREIGN KEY (`id_ville_depart`) REFERENCES `villes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
