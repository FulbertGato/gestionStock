-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 05 juil. 2021 à 22:34
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
  `status_categorie` varchar(100) NOT NULL,
  PRIMARY KEY (`id_categorie`),
  UNIQUE KEY `libelle` (`libelle_categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `ref`, `libelle_categorie`, `status_categorie`) VALUES
(1, 'REF001', 'Vetements', 'active'),
(3, 'REF003', 'Produits pour bébé', 'active'),
(4, 'REF004', 'Parfums', 'active'),
(5, 'REF005', 'Pommades', 'active'),
(7, 'REF007', 'Parfums Homme', 'active'),
(8, 'REF008', 'Parfums Femmes', 'active'),
(9, 'REF009', 'cartes cadeaux', 'active');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_commande` varchar(200) NOT NULL,
  `produit_id` int(10) NOT NULL,
  `quantite` int(10) NOT NULL,
  `total` int(20) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `ref_commande`, `produit_id`, `quantite`, `total`, `date`) VALUES
(11, 'COM0011', 8, 1, 5000, '2021-07-06 05:58:40'),
(10, 'COM0010', 2, 8, 4000, '2021-07-06 02:32:09'),
(9, 'COM009', 4, 2, 1080, '2021-07-06 02:31:09'),
(8, 'COM001', 7, 1, 500, '2021-07-06 02:31:09');

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `libelle_produit`, `stock`, `categorie_id`, `type`, `ref_produit`, `prix`) VALUES
(1, 'Pacorabane', 500, 7, 'physique', 'PROD001', 50000),
(2, 'zorba', 10, 5, 'physique', 'PROD002', 500),
(4, 'zorbo', 0, 3, 'physique', 'PROD003', 540),
(5, 'carte google', 1, 9, 'virtuelle', 'PROD004', 500),
(6, 'Rose nuit', 0, 4, 'physique', 'PROD006', 50000),
(7, 'carte apple', 10, 9, 'virtuelle', 'PROD007', 500),
(8, 'Tshirt brazzers', 9, 1, 'physique', 'PROD008', 5000);

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
  `role` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `nom`, `prenom`, `role`) VALUES
(1, 'gator@admin.com', '$2y$10$zK1VIkzR2In5kizaXD9rae/0iO/yZPHUKCKGFo0tl7YCt2gt1bOQS', 'Gator', 'junior', 'admin'),
(2, 'jacques@admin.com', '$2y$10$ICezfh6hT9YdzsQYkjfdieuAoOiTWImNJrp6nOUzdnAlwNkh2T8DS', 'dansomon', 'jacques', 'vendeur'),
(3, 'julien@admin.com', '$2y$10$crlQO9NFHXLzFEg5Mkhgd.x0VqAS1d7G1WioJyJwSsPF5WBKy6XOa', 'kalipe', 'julien', 'vendeur'),
(4, 'stephane@gmail.com', '$2y$10$NT0T6jVy/S7MnFNQK8czsuT18JmVC9SHfH3972gBuv8hEZQL7iYXm', 'stephane', 'komla', 'vendeur'),
(5, 'jordanwiniga@gmail.com', '$2y$10$0k5YZgwtecJ1GkfqPdY0YeqKxgmKAvOCCA5STfaGqkxx8oF4STcUK', 'winiga', 'jordan', 'vendeur'),
(6, 'pape5@gmail.com', '$2y$10$IHKpsiEjj.QNShDPgbzAduvW12qMGp1lJJVU2wpD6GUa/jZsSzbxC', 'demba', 'pape', 'vendeur'),
(7, 'bolzider@gmail.com', '$2y$10$hhuieTs685Um5Ld09WD2xuKPb98O1AdL1NZ5CWzS.V.MyMfgSp1pW', 'bozilde', 'maltador', 'vendeur');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
