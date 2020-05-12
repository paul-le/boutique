-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 03 mai 2020 à 16:26
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `achats`
--

DROP TABLE IF EXISTS `achats`;
CREATE TABLE IF NOT EXISTS `achats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `achats`
--

INSERT INTO `achats` (`id`, `id_utilisateur`, `id_article`, `quantite`, `prix`) VALUES
(15, 13, 25, 1, 25),
(14, 13, 25, 1, 25),
(13, 13, 24, 1, 35);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(19, 'Console'),
(18, 'PC');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `commentaire` varchar(255) NOT NULL,
  `note` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `id_utilisateur`, `id_produit`, `commentaire`, `note`, `date`) VALUES
(29, 1, 8, 'Adadad', 2, '2020-04-15 12:32:27'),
(28, 1, 8, 'Toast', 4, '2020-04-15 12:32:00'),
(27, 1, 8, 'Mouais mouais', 4, '2020-04-15 12:30:51'),
(26, 1, 8, 'Mouais', 3, '2020-04-15 12:30:44'),
(25, 1, 8, 'Pas fou fou', 2, '2020-04-15 12:30:31'),
(24, 1, 8, 'sss', 1, '2020-04-15 12:10:31');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_article` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categorie` int(11) NOT NULL,
  `id_sous_categorie` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `prix` varchar(255) NOT NULL,
  `quantite` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `vente` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `id_categorie`, `id_sous_categorie`, `nom`, `description`, `prix`, `quantite`, `img`, `vente`) VALUES
(21, 18, 27, 'Green Hell', 'Toast PC FPS', '20', '500', 'Green Hell.jpg', '0'),
(20, 19, 26, 'XenoBlade', 'Toast 16', '30', '100', 'XenoBlade.jpg', '0'),
(19, 19, 25, 'CYBERPUNK 2077', 'Toasty', '50', '500', 'CYBERPUNK 2077.jpg', '0'),
(18, 19, 24, 'Animal Crossing', 'Yikes', '1', '1000', 'Animal Crossing.jpg', '0'),
(17, 19, 25, 'Grand Theft Auto', 'Toast', '25', '50', 'Grand Theft Auto.jpg', '0'),
(16, 18, 28, 'Death Stranding', 'Running simulator', '25', '50', 'Death Stranding.jpg', '0'),
(22, 18, 29, 'The ElderScroll Online', 'Toast RPG PC', '30', '500', 'The ElderScroll Online.jpg', '0'),
(23, 19, 24, 'God Of War', 'Toast Console Aventure', '50', '5000', 'God Of War.jpg', '0'),
(24, 19, 30, 'FIFA 20', 'Toast Console Sport', '35', '496', 'FIFA 20.jpg', '1'),
(25, 19, 31, 'DBZ Fighter Z', 'Toast Console Combat', '45', '500', 'DBZ Fighter Z.jpg', '2');

-- --------------------------------------------------------

--
-- Structure de la table `sous_categorie`
--

DROP TABLE IF EXISTS `sous_categorie`;
CREATE TABLE IF NOT EXISTS `sous_categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categorie` int(11) NOT NULL,
  `nom` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sous_categorie`
--

INSERT INTO `sous_categorie` (`id`, `id_categorie`, `nom`) VALUES
(31, 19, 'Combat(console)'),
(30, 19, 'Sport(console)'),
(29, 18, 'RPG(pc)'),
(27, 18, 'FPS(pc)'),
(28, 18, 'Aventure(pc)'),
(26, 19, 'RPG(console)'),
(25, 19, 'FPS(console)'),
(24, 19, 'Aventure(console)');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `rank` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`, `mail`, `adresse`, `rank`) VALUES
(13, 'smoladmin', '$2y$10$VGlZMlgCrPgFcx8wx2oJ1Oh80DfbzTmugp8zl8YoFjkPb5H3lgdS2', 'smoladmin@gmail.com', 'smoladmin land', 'ADMIN'),
(12, 'Paul', '$2y$10$zCkdn64qzXMtgxJ4ZWMEQenYhcFTA5p2Tr.Jy85ZLoGsUS5aUMonS', 'Paul@gmail.com', 'Paulooooo', 'ADMIN'),
(1, 'BigAdminToast', '$2y$12$63ZeYqRhlJJWV4Y2sLTGL.ScW6TNZDP7Aj0HExw5SDUOw63UXXJki', 'bigadmin@gmail.com', 'bigadmin adresse', 'ADMIN');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
