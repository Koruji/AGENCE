-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 24 nov. 2024 à 15:31
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `agence`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id_commentaire` int NOT NULL AUTO_INCREMENT,
  `commentaire` text,
  `dateCommentaire` datetime DEFAULT CURRENT_TIMESTAMP,
  `note` int DEFAULT NULL,
  `id_reservation` int NOT NULL,
  `id_vehicule` int NOT NULL,
  `id_personne` int NOT NULL,
  PRIMARY KEY (`id_commentaire`),
  KEY `id_vehicule` (`id_vehicule`),
  KEY `id_personne` (`id_personne`),
  KEY `id_reservation` (`id_reservation`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

DROP TABLE IF EXISTS `personne`;
CREATE TABLE IF NOT EXISTS `personne` (
  `id_personne` int NOT NULL AUTO_INCREMENT,
  `civilite` varchar(25) DEFAULT NULL,
  `prenom` varchar(25) DEFAULT NULL,
  `nom` varchar(25) DEFAULT NULL,
  `login` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `role` varchar(15) DEFAULT 'CLIENT',
  `date_inscription` datetime DEFAULT CURRENT_TIMESTAMP,
  `tel` varchar(20) DEFAULT NULL,
  `mdp` varchar(100) DEFAULT NULL,
  `depenses` int DEFAULT NULL,
  PRIMARY KEY (`id_personne`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`id_personne`, `civilite`, `prenom`, `nom`, `login`, `email`, `role`, `date_inscription`, `tel`, `mdp`, `depenses`) VALUES
(39, 'Mr', 'Paul', 'Administrateur', 'admin1', 'test@gmail.com', 'ADMIN', '2024-11-24 16:23:36', '0612345678', '$2y$10$kzTLAjsGhoNb.vRdLK3YFutzFNjwW7Fw0vZ/A.Yq9JYA63RH2wnF.', 0),
(40, 'Mme', 'Claire', 'Client', 'client1', 'test@gmail.com', 'CLIENT', '2024-11-24 16:25:14', '0698765432', '$2y$10$gIDGLM.hsfEq5IRLLNhVUOYcHRpz7pyhd.H6fee8hORiHaUs5YH5m', 0);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id_reservation` int NOT NULL AUTO_INCREMENT,
  `date_reservation` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `prix_total` int DEFAULT NULL,
  `id_vehicule` int NOT NULL,
  `id_personne` int NOT NULL,
  PRIMARY KEY (`id_reservation`),
  KEY `id_vehicule` (`id_vehicule`),
  KEY `id_personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

DROP TABLE IF EXISTS `vehicule`;
CREATE TABLE IF NOT EXISTS `vehicule` (
  `id_vehicule` int NOT NULL AUTO_INCREMENT,
  `marque` varchar(25) DEFAULT NULL,
  `modele` varchar(25) DEFAULT NULL,
  `matricule` varchar(25) DEFAULT NULL,
  `prix_journalier` decimal(7,2) DEFAULT NULL,
  `type_vehicule` varchar(25) DEFAULT NULL,
  `statut_dispo` int DEFAULT '1',
  `photo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_vehicule`),
  UNIQUE KEY `matricule` (`matricule`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`id_vehicule`, `marque`, `modele`, `matricule`, `prix_journalier`, `type_vehicule`, `statut_dispo`, `photo`) VALUES
(47, 'PEUGEOT', '206+', 'KL-YUI-FG', 100.00, 'voiture', 1, 'image/206.png'),
(48, 'Toyota', 'Corolla', '23-FGH-45', 160.00, 'voiture', 1, 'image/toyota-corolla.png'),
(49, 'Honda', 'Civic', 'SQ-909-FG', 100.00, 'voiture', 1, 'image/honda-civic.png'),
(50, 'Ford', 'Mustang', 'GH-345-BN', 230.00, 'voiture', 1, 'image/mustang-voiture.png'),
(51, 'Ford', 'F-150', 'FL-789-WX', 120.00, 'camion', 0, 'image/f-150.png'),
(52, 'Ram', '1500', 'JK-890-ER', 346.00, 'camion', 1, 'image/ram-camion.png'),
(53, 'Volvo', 'FH16', 'OP-123-TY', 210.00, 'camion', 1, 'image/volvo-camion.png'),
(61, 'Honda', 'PCX 125', 'QS-890-OL', 120.00, '2_roues', 1, 'image/scooter-honda.png'),
(62, 'Yamaha', 'NMAX 125', 'HJ-345-QS', 120.00, '2_roues', 1, 'image/yamaha-scooter.png');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicule` (`id_vehicule`),
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`),
  ADD CONSTRAINT `commentaire_ibfk_3` FOREIGN KEY (`id_reservation`) REFERENCES `reservation` (`id_reservation`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicule` (`id_vehicule`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
