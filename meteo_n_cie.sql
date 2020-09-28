-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 26 sep. 2020 à 07:27
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `meteo_n_cie`
--

-- --------------------------------------------------------

--
-- Structure de la table `mesures`
--

CREATE TABLE `mesures` (
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `stationID` int(5) NOT NULL,
  `mesure_name` varchar(50) DEFAULT NULL,
  `mesure_value` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `mesures`
--

INSERT INTO `mesures` (`date`, `stationID`, `mesure_name`, `mesure_value`) VALUES
('2020-09-20 09:58:38', 1, 'temperature', 25),
('2020-09-20 13:08:11', 1, 'humidite', 0.8),
('2020-09-20 17:07:22', 1, 'temperature', 30),
('2020-09-21 09:20:23', 1, 'test', 1231350);

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE `projets` (
  `projetID` int(5) NOT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `projets`
--

INSERT INTO `projets` (`projetID`, `nom`, `description`) VALUES
(1, 'premier projet', 'un premier projet test');

-- --------------------------------------------------------

--
-- Structure de la table `stations`
--

CREATE TABLE `stations` (
  `stationID` int(5) UNSIGNED NOT NULL,
  `userID` int(5) UNSIGNED DEFAULT NULL,
  `model` varchar(20) DEFAULT NULL,
  `visibility` varchar(20) DEFAULT 'private',
  `description` varchar(255) DEFAULT NULL,
  `localisation` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `stations`
--

INSERT INTO `stations` (`stationID`, `userID`, `model`, `visibility`, `description`, `localisation`) VALUES
(23, 1, '123', 'Private', 'test', 'par là');

-- --------------------------------------------------------

--
-- Structure de la table `station_projet`
--

CREATE TABLE `station_projet` (
  `stationID` int(5) UNSIGNED NOT NULL,
  `projetID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `station_projet`
--

INSERT INTO `station_projet` (`stationID`, `projetID`) VALUES
(23, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `userID` int(5) UNSIGNED NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `permissions` int(1) DEFAULT 0,
  `date_inscription` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`userID`, `login`, `password`, `nom`, `prenom`, `mail`, `permissions`, `date_inscription`) VALUES
(1, 'admin', '$2y$10$p5axrK2lUcx05eavkjSszutakzmcq6Gx9zZOHeJgXPlPHCoZSZ0/C', NULL, NULL, NULL, 0, '2020-09-20 11:02:02'),
(5, 'Aphaz', '$2y$10$yZGQvamVdjyeF2vN/N0frePhEeQ8t6Q4/5FRBv21GgEomPehyEUci', 'Damien', 'Richard', 'd@mi.en', 0, '2020-09-22 13:46:02');

-- --------------------------------------------------------

--
-- Structure de la table `user_projet`
--

CREATE TABLE `user_projet` (
  `userID` int(5) UNSIGNED NOT NULL,
  `projetID` int(5) NOT NULL,
  `privileges` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user_projet`
--

INSERT INTO `user_projet` (`userID`, `projetID`, `privileges`) VALUES
(1, 1, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `mesures`
--
ALTER TABLE `mesures`
  ADD PRIMARY KEY (`date`,`stationID`);

--
-- Index pour la table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`projetID`);

--
-- Index pour la table `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`stationID`);

--
-- Index pour la table `station_projet`
--
ALTER TABLE `station_projet`
  ADD KEY `station` (`stationID`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- Index pour la table `user_projet`
--
ALTER TABLE `user_projet`
  ADD KEY `projet` (`projetID`),
  ADD KEY `user` (`userID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `projets`
--
ALTER TABLE `projets`
  MODIFY `projetID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `stations`
--
ALTER TABLE `stations`
  MODIFY `stationID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `station_projet`
--
ALTER TABLE `station_projet`
  ADD CONSTRAINT `station` FOREIGN KEY (`stationID`) REFERENCES `stations` (`stationID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user_projet`
--
ALTER TABLE `user_projet`
  ADD CONSTRAINT `projet` FOREIGN KEY (`projetID`) REFERENCES `projets` (`projetID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
