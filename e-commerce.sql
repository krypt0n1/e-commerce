-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 22 fév. 2020 à 09:25
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `e-commerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` text NOT NULL,
  `description` text NOT NULL,
  `date_creation` date NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `categorie`, `description`, `date_creation`) VALUES
(1, 'MULTIMEDIA', 'tous les produits qui en relation avec multimedia a savoir les ordinateurs , les calbles ...', '2017-12-30'),
(2, 'IMAGES & SON', 'tous les produits qui en relation avec les images et le son a savoir les apparails photo , les amplis ...', '2017-12-30'),
(3, 'VETEMENTS', 'tous les produits qui en relation avec les vêtements a savoir les robes , les jackets , t-shirt...', '2017-12-30'),
(4, 'ELECTROMENAGER', 'tous les produits qui en relation avec la cuisin a savoir les elements de netoyages ...', '2017-12-30'),
(5, 'LAVAGE', 'tous les produits qui en relation avec lavage savoir lesMachi,es a laver  ...', '2018-01-14'),
(6, 'Cuisne', ' tout les accessoires qui ont une relation avec la cuisine\r\n', '2020-02-20');

-- --------------------------------------------------------

--
-- Structure de la table `command`
--

DROP TABLE IF EXISTS `command`;
CREATE TABLE IF NOT EXISTS `command` (
  `id_command` int(11) NOT NULL AUTO_INCREMENT,
  `date_command` date NOT NULL,
  `id_membre` int(11) NOT NULL,
  `adress_livraison` varchar(100) NOT NULL,
  `frais` int(11) NOT NULL,
  `etat` int(11) NOT NULL,
  PRIMARY KEY (`id_command`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `command`
--

INSERT INTO `command` (`id_command`, `date_command`, `id_membre`, `adress_livraison`, `frais`, `etat`) VALUES
(27, '2020-02-22', 4, 'ksar zaouia lakdima', 0, 1),
(26, '2020-02-22', 4, 'ksar zaouia lakdima', 0, 1),
(25, '2020-02-22', 1, '35 ELWAHA', 0, 1),
(24, '2020-02-21', 4, 'ksar zaouia lakdima', 0, 1),
(23, '2020-02-21', 4, 'ksar zaouia lakdima', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `description`
--

DROP TABLE IF EXISTS `description`;
CREATE TABLE IF NOT EXISTS `description` (
  `idDesc` int(11) NOT NULL AUTO_INCREMENT,
  `element` varchar(80) NOT NULL,
  `definition` text NOT NULL,
  `id_produit` int(11) NOT NULL,
  PRIMARY KEY (`idDesc`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `description`
--

INSERT INTO `description` (`idDesc`, `element`, `definition`, `id_produit`) VALUES
(1, 'RAM', 'RAM = 8GO', 1),
(2, 'disque dure', '500 Go HDD', 1),
(3, 'Carte graphique', 'intel 2Go', 1),
(4, 'Zomme', '200x', 3),
(5, 'camera', '40 mpx', 3),
(6, 'Poids', '9 KG', 4),
(7, 'Type', 'Automatique', 4);

-- --------------------------------------------------------

--
-- Structure de la table `detail`
--

DROP TABLE IF EXISTS `detail`;
CREATE TABLE IF NOT EXISTS `detail` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `quantite` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `id_command` int(11) NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `detail`
--

INSERT INTO `detail` (`id_detail`, `quantite`, `prix`, `id_produit`, `id_command`) VALUES
(24, 2, 450, 7, 0),
(23, 1, 425, 5, 0),
(22, 1, 950, 8, 0),
(21, 2, 450, 7, 0),
(20, 2, 425, 5, 0),
(19, 2, 450, 7, 0),
(18, 2, 425, 5, 0);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

DROP TABLE IF EXISTS `membres`;
CREATE TABLE IF NOT EXISTS `membres` (
  `id_membre` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(20) NOT NULL,
  `adresse` varchar(80) NOT NULL,
  `pays` varchar(15) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `avatar` varchar(80) NOT NULL,
  `qualite` int(11) NOT NULL,
  PRIMARY KEY (`id_membre`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id_membre`, `nom`, `prenom`, `email`, `password`, `adresse`, `pays`, `ville`, `zipcode`, `avatar`, `qualite`) VALUES
(1, 'abidi', 'Morad', 'droma@gmail.com', '1234', '35 ELWAHA', 'Maroc', 'ERRACHIDIA', 52000, 'DROMA.jpg', 0),
(2, 'hachimi', 'amine', 'narco@gmail.com', '12345', '12 elwaha', 'Maroc', 'errachidia', 52000, 'narco.jpg', 0),
(3, 'fatma', 'lamrani', 'fatma@gmail.com', '0000', 'errachidia', 'maroc', 'errachidia', 52000, 'avatar-2.png', 0),
(4, 'Bouziane', 'wadii', 'wadii@gmail.com', '2001', 'ksar zaouia lakdima', 'maroc', 'errachidia', 52000, 'DROMA.jpg', 1),
(6, 'moussa', 'moussaoui', 'moussa@gmail.com', '123456', 'errachidia Alwaha', 'maroc', 'errachidia', 52000, 'crypt.jpg', 0);

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE IF NOT EXISTS `photos` (
  `id_photo` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(40) NOT NULL,
  `id_produit` int(11) NOT NULL,
  PRIMARY KEY (`id_photo`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `photos`
--

INSERT INTO `photos` (`id_photo`, `image`, `id_produit`) VALUES
(1, '1.jpg', 1),
(2, '22.jpg', 1),
(3, '22.jpg', 2),
(12, '11.jpg', 2),
(13, '5.jpg', 3),
(14, '5.jpg', 3),
(15, '5.jpg', 3);

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

DROP TABLE IF EXISTS `promotion`;
CREATE TABLE IF NOT EXISTS `promotion` (
  `id_promotion` int(11) NOT NULL AUTO_INCREMENT,
  `tauxpromotion` int(11) NOT NULL,
  `datedebut` date NOT NULL,
  `datefin` date NOT NULL,
  `id_produit` int(11) NOT NULL,
  PRIMARY KEY (`id_promotion`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `promotion`
--

INSERT INTO `promotion` (`id_promotion`, `tauxpromotion`, `datedebut`, `datefin`, `id_produit`) VALUES
(1, 20, '2020-01-12', '2020-02-11', 2),
(2, 15, '2020-02-06', '2020-04-02', 5),
(3, 18, '2020-02-06', '2020-04-03', 6),
(4, 10, '2020-02-20', '2020-03-25', 7),
(5, 5, '2020-02-21', '2020-03-25', 8);

-- --------------------------------------------------------

--
-- Structure de la table `publicités`
--

DROP TABLE IF EXISTS `publicités`;
CREATE TABLE IF NOT EXISTS `publicités` (
  `id_pub` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `fichier` varchar(100) NOT NULL,
  `type_fichier` varchar(20) NOT NULL,
  `date_creation` date NOT NULL,
  PRIMARY KEY (`id_pub`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `publicités`
--

INSERT INTO `publicités` (`id_pub`, `type`, `fichier`, `type_fichier`, `date_creation`) VALUES
(1, 'sidebar', 'pub1.png', 'image', '2017-12-31'),
(2, 'aside', 'pub2.png', 'image', '2018-01-02'),
(3, 'Aside 3 ', 'pub3.PNG', 'image', '2018-01-02'),
(4, 'Aside pub', 'pub4.PNG', 'image', '2018-01-02'),
(5, 'sidebar', 'pub5.PNG', 'image', '2018-01-02');

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(80) NOT NULL,
  `description` text NOT NULL,
  `prix` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `vignette` varchar(50) NOT NULL,
  `date_creation` date NOT NULL,
  `id_categorie` int(11) NOT NULL,
  PRIMARY KEY (`id_produit`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`id_produit`, `label`, `description`, `prix`, `quantite`, `vignette`, `date_creation`, `id_categorie`) VALUES
(1, 'Asus i5', 'PC', 6000, 10, '1.jpg', '2018-01-01', 1),
(3, 'camera', 'camera bonne marque', 500, 20, '5.jpg', '2020-01-30', 2),
(4, 'machine a laver', 'machine a laver Samsung', 1500, 6, '8.jpg', '2020-01-29', 5),
(5, 'chemise', 'chemise polo 2020', 500, 11, 'product-1.jpg', '2020-05-07', 3),
(6, 't-shirt', 't-shirt celio 1ere marque', 1000, 30, 'product-2.jpg', '2020-04-08', 3),
(7, 'Casque', 'Casque Gamer 2020', 500, 40, '6.jpg', '2020-02-20', 2),
(8, 'malaxeur', 'malaxeur pour malaxer les légumes', 1000, 56, 'malx.jpg', '2020-02-21', 6);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
