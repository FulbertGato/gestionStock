-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 04 juil. 2021 à 08:18
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestionstock`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `ref` varchar(100) NOT NULL,
  `libelle_categorie` varchar(255) NOT NULL,
  PRIMARY KEY (`id_categorie`),
  UNIQUE KEY `libelle` (`libelle_categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `ref`, `libelle_categorie`) VALUES
(1, 'REF001', 'Vetements'),
(2, 'REF002', 'Produits Cosmétiques'),
(3, 'REF003', 'Produits pour bébé'),
(4, 'REF004', 'Parfums'),
(5, 'REF005', 'Pommades'),
(6, 'REF006', 'Pommades enfants'),
(7, 'REF007', 'Parfums Homme'),
(8, 'REF008', 'Parfums Femmes'),
(9, 'REF009', 'cartes cadeaux');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_produit` varchar(255) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `type` varchar(30) NOT NULL,
  `ref_produit` varchar(255) DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_produit`),
  UNIQUE KEY `produit_libelle_uindex` (`libelle_produit`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `libelle_produit`, `stock`, `categorie_id`, `type`, `ref_produit`, `prix`) VALUES
(1, 'Pacorabane', 500, 7, 'physique', 'PROD001', 50000),
(2, 'zorba', 10, 5, 'physique', 'PROD002', 500),
(4, 'zorbo', 0, 3, 'physique', 'PROD003', 540),
(5, 'carte google', 1, 9, 'virtuelle', 'PROD004', 500),
(6, 'Rose nuit', 0, 4, 'physique', 'PROD006', 50000);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `nom`, `prenom`) VALUES
(1, 'gator@admin.com', '$2y$10$zK1VIkzR2In5kizaXD9rae/0iO/yZPHUKCKGFo0tl7YCt2gt1bOQS', 'Gator', 'junior'),
(2, 'jacques@admin.com', '$2y$10$ICezfh6hT9YdzsQYkjfdieuAoOiTWImNJrp6nOUzdnAlwNkh2T8DS', 'dansomon', 'jacques'),
(3, 'julien@admin.com', '$2y$10$crlQO9NFHXLzFEg5Mkhgd.x0VqAS1d7G1WioJyJwSsPF5WBKy6XOa', 'kalipe', 'julien'),
(4, 'stephane@gmail.com', '$2y$10$NT0T6jVy/S7MnFNQK8czsuT18JmVC9SHfH3972gBuv8hEZQL7iYXm', 'stephane', 'komla'),
(5, 'jordanwiniga@gmail.com', '$2y$10$0k5YZgwtecJ1GkfqPdY0YeqKxgmKAvOCCA5STfaGqkxx8oF4STcUK', 'winiga', 'jordan'),
(6, 'pape5@gmail.com', '$2y$10$IHKpsiEjj.QNShDPgbzAduvW12qMGp1lJJVU2wpD6GUa/jZsSzbxC', 'demba', 'pape');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
