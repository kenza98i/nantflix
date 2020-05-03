-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  Dim 12 avr. 2020 à 21:09
-- Version du serveur :  5.7.29-0ubuntu0.18.04.1
-- Version de PHP :  7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `nantflix`
--

-- --------------------------------------------------------

--
-- Structure de la table `episode`
--

CREATE TABLE `episode` (
  `Numepisode` int(11) NOT NULL,
  `refserie` int(11) NOT NULL,
  `duree` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `episode`
--

INSERT INTO `episode` (`Numepisode`, `refserie`, `duree`) VALUES
(1, 1, '54.00.00'),
(1, 2, '00.54.00'),
(1, 3, '00.51.00'),
(2, 1, '01.00.00'),
(2, 2, '00.40.00'),
(2, 3, '45.00.00'),
(3, 2, '01.00.00');

-- --------------------------------------------------------

--
-- Structure de la table `regarder`
--

CREATE TABLE `regarder` (
  `refutilisateur` varchar(20) NOT NULL,
  `refepisode` int(11) NOT NULL,
  `refserie` int(11) NOT NULL,
  `duree` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `regarder`
--

INSERT INTO `regarder` (`refutilisateur`, `refepisode`, `refserie`, `duree`) VALUES
('kea@gmail.fr', 1, 1, 14),
('keaI@gmail.fr', 1, 1, 14),
('keaI@gmail.fr', 1, 2, 16),
('keaI@gmail.fr', 1, 3, 16),
('keaI@gmail.fr', 2, 1, 14),
('keaI@gmail.fr', 2, 2, 15),
('keaI@gmail.fr', 3, 2, 16);

-- --------------------------------------------------------

--
-- Structure de la table `serie`
--

CREATE TABLE `serie` (
  `idserie` int(10) NOT NULL,
  `intitule` varchar(20) CHARACTER SET utf8 NOT NULL,
  `nbepisodes` int(10) NOT NULL,
  `acteursprincipaux` varchar(50) CHARACTER SET utf8 NOT NULL,
  `realisateur` varchar(20) CHARACTER SET utf8 NOT NULL,
  `anneesortie` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `serie`
--

INSERT INTO `serie` (`idserie`, `intitule`, `nbepisodes`, `acteursprincipaux`, `realisateur`, `anneesortie`) VALUES
(1, 'freinds', 8, 'Jennifer Aniston, Julie Roberts ,', 'Robert ', 2014),
(2, 'you', 7, 'Al pacino ,Robert De Niro ', 'Robert De Niro ', 2007),
(3, 'prison break', 11, 'wentworth  Miller, Dominic Purcell ', 'Jack Nicholson ', 2010);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `prenom` varchar(25) CHARACTER SET utf8 NOT NULL,
  `nom` varchar(25) CHARACTER SET utf8 NOT NULL,
  `mail` varchar(25) CHARACTER SET utf8 NOT NULL,
  `motdepasse` varchar(25) CHARACTER SET utf8 NOT NULL,
  `phone` int(11) NOT NULL,
  `Datedenaissance` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`prenom`, `nom`, `mail`, `motdepasse`, `phone`, `Datedenaissance`) VALUES
('syrine', 'dupont', 'dupontsyrine@gmail.fr', 'Kenza1998i', 766186350, '1998-03-13'),
('toto', 'titi', 'kea@gmail.fr', 'Tototiti1', 666781457, '1997-04-23'),
('EZ', 'DE', 'keaI@gmail.fr', 'Kenza1998i', 755489643, '1998-10-13');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `episode`
--
ALTER TABLE `episode`
  ADD PRIMARY KEY (`Numepisode`,`refserie`),
  ADD KEY `cr` (`refserie`);

--
-- Index pour la table `regarder`
--
ALTER TABLE `regarder`
  ADD PRIMARY KEY (`refutilisateur`,`refepisode`,`refserie`),
  ADD KEY `crr` (`refepisode`),
  ADD KEY `rrd` (`refserie`);

--
-- Index pour la table `serie`
--
ALTER TABLE `serie`
  ADD PRIMARY KEY (`idserie`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`mail`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `serie`
--
ALTER TABLE `serie`
  MODIFY `idserie` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `episode`
--
ALTER TABLE `episode`
  ADD CONSTRAINT `cr` FOREIGN KEY (`refserie`) REFERENCES `serie` (`idserie`);

--
-- Contraintes pour la table `regarder`
--
ALTER TABLE `regarder`
  ADD CONSTRAINT `crr` FOREIGN KEY (`refepisode`) REFERENCES `episode` (`Numepisode`),
  ADD CONSTRAINT `rrd` FOREIGN KEY (`refserie`) REFERENCES `serie` (`idserie`),
  ADD CONSTRAINT `ttr` FOREIGN KEY (`refutilisateur`) REFERENCES `utilisateur` (`mail`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
