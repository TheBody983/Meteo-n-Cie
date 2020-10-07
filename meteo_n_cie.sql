-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 06 oct. 2020 à 04:09
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
('2020-09-20 17:07:22', 1, 'temperature', 30);

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
(1, 'projet_test', 'un projet pour tester les fonctions'),
(2, 'bla', 'bli blou');

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
(1, 1, 'adminstation public', 'public', 'Sur le toit du bâtiment F', '-22.262706 -193.596497'),
(2, 1, 'adminstation private', 'Private', 'private', '-20.558738 -193.716431'),
(3, 1, 'bla', 'public', 'La foa', '-21.710241, -194.170351'),
(4, 2, 'mk1', 'Private', 'new test', '-21.710241, -195.170351'),
(5, 2, 'oui', 'Private', 'regarde ludo', '-20.900898, -195.132843'),
(6, 2, 'yo', 'Private', 'rap', 'le'),
(7, 2, 'kouma', 'Private', 'toit de la cuisine', '-20.392906, -195.624481');

-- --------------------------------------------------------

--
-- Structure de la table `station_projet`
--

CREATE TABLE `station_projet` (
  `stationID` int(5) UNSIGNED NOT NULL,
  `projetID` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `station_projet`
--

INSERT INTO `station_projet` (`stationID`, `projetID`) VALUES
(1, 1);

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
  `date_inscription` datetime NOT NULL DEFAULT current_timestamp(),
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`userID`, `login`, `password`, `nom`, `prenom`, `mail`, `permissions`, `date_inscription`, `description`) VALUES
(1, 'admin', '$2y$10$p5axrK2lUcx05eavkjSszutakzmcq6Gx9zZOHeJgXPlPHCoZSZ0/C', NULL, NULL, NULL, 0, '2020-09-20 11:02:02', NULL),
(2, 'Aphaz', '$2y$10$yZGQvamVdjyeF2vN/N0frePhEeQ8t6Q4/5FRBv21GgEomPehyEUci', 'Damien', 'Richard', 'd@mi.en', 0, '2020-09-22 13:46:02', NULL),
(3, 'Shadouii', '$2y$10$4dMrwHOtdDhgn5JJOW5Jx.UPfLvZMWAu54s/YBOnz2Lq9AwKkT6Ou', 'albani', 'bryan', 'oui@gmail.com', 0, '2020-10-01 11:09:23', NULL),
(4, 'joris', '$2y$10$dQ3sYwnm7D1pvFOd8KK5seQLMgfuKoqfn.kQ.Mf1p5OhJc/5wqmke', 'Derquennes', 'Joris', 'joris@gmail.com', 0, '2020-10-01 11:10:45', NULL),
(5, 'mathieu', '$2y$10$TMgF1oyR6R8XifdFpHXW3.rhxuz/z3yBUzOVd3WCFQ0Y4EWe973wi', 'bisson', 'mathieu', 'm@gmail.com', 0, '2020-10-01 11:11:38', NULL),
(6, 'ludo', '$2y$10$BwROHhLCysRfa5nJ3zE53eGTX2HNwJscQMFnBYcQinHgTi28.2C5.', 'ludo', 'ludoprenom', 'ludomail', 0, '2020-10-01 11:12:31', NULL),
(7, 'ludo', '$2y$10$JhQv88DINw2gtqWaRMBSKeHLXEY33E29vksvexFyJdGeJDis/4GmK', 'ludo', 'ludoprenom', 'ludomail', 0, '2020-10-01 11:17:40', NULL);

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
(1, 1, 'creator');

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
  MODIFY `projetID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `stations`
--
ALTER TABLE `stations`
  MODIFY `stationID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

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
