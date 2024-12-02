-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 02 déc. 2024 à 13:04
-- Version du serveur : 8.0.27
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_conges`
--

-- --------------------------------------------------------

--
-- Structure de la table `authentification`
--

DROP TABLE IF EXISTS `authentification`;
CREATE TABLE IF NOT EXISTS `authentification` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` char(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `authentification`
--

INSERT INTO `authentification` (`ID`, `username`, `password`, `role`) VALUES
(1, 'Cardinal', 'f34h66', 'Admin'),
(2, 'Carlos', '11az8e', 'Opérateur'),
(3, 'Claudio', '09iu3x', 'Opérateur');

-- --------------------------------------------------------

--
-- Structure de la table `conge`
--

DROP TABLE IF EXISTS `conge`;
CREATE TABLE IF NOT EXISTS `conge` (
  `ID_conge` int NOT NULL AUTO_INCREMENT,
  `Date_de_debut` date DEFAULT NULL,
  `Date_de_fin` date DEFAULT NULL,
  `Nombre_conge` int DEFAULT NULL,
  `ID_Type` int NOT NULL,
  `ID_Personnel` int NOT NULL,
  PRIMARY KEY (`ID_conge`),
  KEY `ID_Type` (`ID_Type`),
  KEY `ID_Personnel` (`ID_Personnel`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `conge`
--

INSERT INTO `conge` (`ID_conge`, `Date_de_debut`, `Date_de_fin`, `Nombre_conge`, `ID_Type`, `ID_Personnel`) VALUES
(1, '2024-01-01', '2024-01-08', 5, 1, 1),
(2, '2024-01-31', '2024-02-07', 6, 1, 2),
(3, '2024-02-16', '2024-02-23', 6, 1, 3),
(4, '2024-05-03', '2024-05-07', 3, 2, 1),
(5, '2024-03-08', '2024-03-15', 6, 3, 2),
(6, '2024-04-01', '2024-04-05', 5, 1, 1),
(7, '2024-06-07', '2024-06-10', 2, 1, 3),
(8, '2024-12-20', '2024-12-26', 4, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `direction`
--

DROP TABLE IF EXISTS `direction`;
CREATE TABLE IF NOT EXISTS `direction` (
  `ID_Direction` int NOT NULL AUTO_INCREMENT,
  `Direction` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Direction`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `direction`
--

INSERT INTO `direction` (`ID_Direction`, `Direction`) VALUES
(1, 'Direction Générale'),
(2, 'Direction Informatique'),
(3, 'Direction des Ressources Humaines'),
(4, 'Direction Financière'),
(5, 'Direction Commerciale'),
(6, 'Direction Technique'),
(7, 'Direction Marketing');

-- --------------------------------------------------------

--
-- Structure de la table `fonction`
--

DROP TABLE IF EXISTS `fonction`;
CREATE TABLE IF NOT EXISTS `fonction` (
  `ID_Fonction` int NOT NULL AUTO_INCREMENT,
  `Fonction` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Fonction`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `fonction`
--

INSERT INTO `fonction` (`ID_Fonction`, `Fonction`) VALUES
(1, 'Directeur Général'),
(2, 'Responsable RH'),
(3, 'Comptable'),
(4, 'Commercial'),
(5, 'Ingénieur'),
(6, 'Chef de Projet'),
(7, 'Développeur'),
(8, 'Analyste Financier'),
(9, 'Responsable Marketing');

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

DROP TABLE IF EXISTS `personnel`;
CREATE TABLE IF NOT EXISTS `personnel` (
  `ID_Personnel` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) DEFAULT NULL,
  `Prenom` varchar(50) DEFAULT NULL,
  `Date_de_naissance` date DEFAULT NULL,
  `Date_d_embauche` date NOT NULL,
  `Adresse` varchar(50) DEFAULT NULL,
  `Contact` varchar(50) DEFAULT NULL,
  `E_Mail` varchar(50) DEFAULT NULL,
  `Solde_Conge` int DEFAULT '30',
  `ID_Direction` int NOT NULL,
  `ID_Fonction` int NOT NULL,
  PRIMARY KEY (`ID_Personnel`),
  KEY `ID_Direction` (`ID_Direction`),
  KEY `ID_Fonction` (`ID_Fonction`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `personnel`
--

INSERT INTO `personnel` (`ID_Personnel`, `Nom`, `Prenom`, `Date_de_naissance`, `Date_d_embauche`, `Adresse`, `Contact`, `E_Mail`, `Solde_Conge`, `ID_Direction`, `ID_Fonction`) VALUES
(1, 'Dupont', 'Jean', '1985-03-12', '2010-06-15', 'Ampitatafika', '0321020304', 'jeandupont@example.com', 17, 1, 1),
(2, 'Martin', 'Marie', '1990-07-22', '2015-04-20', 'Andraharo', '0340331087', 'mariemartin@example.com', 18, 2, 7),
(3, 'Leroy', 'Pierre', '1980-01-05', '2008-09-01', 'Anosy Be', '0342334455', 'pierreleroy@example.com', 18, 4, 3),
(4, 'Rakoto', 'Charles', '2000-01-09', '2024-01-10', 'Analakely', '0323319620', 'Charles@gmail.com', 30, 4, 8),
(5, 'Razanakoto', 'Carlos', '2002-10-01', '2024-05-10', 'Ampitatafika', '0331256741', 'Carlos@gmail.com', 30, 6, 5);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `personnel_view`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `personnel_view`;
CREATE TABLE IF NOT EXISTS `personnel_view` (
`ID_Personnel` int
,`Nom` varchar(50)
,`Prenom` varchar(50)
,`Date_de_naissance` date
,`Date_d_embauche` date
,`Adresse` varchar(50)
,`Contact` varchar(50)
,`E_Mail` varchar(50)
,`ID_Direction` int
,`ID_Fonction` int
,`Fonction` varchar(50)
,`Direction` varchar(50)
,`Solde_Conge` int
,`Année_de_service` bigint
);

-- --------------------------------------------------------

--
-- Structure de la table `type_conge`
--

DROP TABLE IF EXISTS `type_conge`;
CREATE TABLE IF NOT EXISTS `type_conge` (
  `ID_Type` int NOT NULL AUTO_INCREMENT,
  `Type_Conge` varchar(50) DEFAULT NULL,
  `Description` text,
  PRIMARY KEY (`ID_Type`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `type_conge`
--

INSERT INTO `type_conge` (`ID_Type`, `Type_Conge`, `Description`) VALUES
(1, 'Congé Annuel', 'Congé pour des vacances ou des raisons personnelles.'),
(2, 'Congé Maladie', 'Congé en cas de maladie ou accident.'),
(3, 'Congé Maternité', 'Congé pour les nouvelles mères après accouchement.'),
(4, 'Congé Paternité', 'Congé pour les nouveaux pères après la naissance de leur enfant.'),
(5, 'Congé Sans Solde', 'Congé pris sans rémunération.');

-- --------------------------------------------------------

--
-- Structure de la vue `personnel_view`
--
DROP TABLE IF EXISTS `personnel_view`;

DROP VIEW IF EXISTS `personnel_view`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `personnel_view`  AS SELECT `p`.`ID_Personnel` AS `ID_Personnel`, `p`.`Nom` AS `Nom`, `p`.`Prenom` AS `Prenom`, `p`.`Date_de_naissance` AS `Date_de_naissance`, `p`.`Date_d_embauche` AS `Date_d_embauche`, `p`.`Adresse` AS `Adresse`, `p`.`Contact` AS `Contact`, `p`.`E_Mail` AS `E_Mail`, `p`.`ID_Direction` AS `ID_Direction`, `p`.`ID_Fonction` AS `ID_Fonction`, `f`.`Fonction` AS `Fonction`, `d`.`Direction` AS `Direction`, `p`.`Solde_Conge` AS `Solde_Conge`, timestampdiff(YEAR,`p`.`Date_d_embauche`,curdate()) AS `Année_de_service` FROM ((`personnel` `p` join `fonction` `f` on((`p`.`ID_Fonction` = `f`.`ID_Fonction`))) join `direction` `d` on((`p`.`ID_Direction` = `d`.`ID_Direction`))) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
