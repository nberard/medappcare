-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Mar 26 Mars 2013 à 18:18
-- Version du serveur: 5.5.27-log
-- Version de PHP: 5.4.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `medappcare`
--

-- --------------------------------------------------------

--
-- Structure de la table `accessoire`
--

CREATE TABLE IF NOT EXISTS `accessoire` (
  `id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `fabriquant_id` tinyint(2) NOT NULL,
  `photo` varchar(1024) NOT NULL,
  `description` text NOT NULL,
  `lien_achat` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `accessoire_fabriquant`
--

CREATE TABLE IF NOT EXISTS `accessoire_fabriquant` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `application`
--

CREATE TABLE IF NOT EXISTS `application` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(1024) NOT NULL,
  `package` varchar(1024) NOT NULL,
  `device_id` tinyint(1) NOT NULL,
  `titre` varchar(1024) NOT NULL,
  `description` text NOT NULL,
  `date_ajout` date NOT NULL,
  `prix` float NOT NULL,
  `devise` varchar(16) NOT NULL,
  `langue_store` char(2) NOT NULL,
  `langue_appli` char(2) NOT NULL,
  `editeur_id` smallint(4) NOT NULL,
  `lien_download` varchar(1024) NOT NULL,
  `version` varchar(16) NOT NULL,
  `mots_cles` varchar(1024) NOT NULL,
  `est_liste` tinyint(1) NOT NULL,
  `est_partageable` tinyint(1) NOT NULL,
  `est_pro` tinyint(1) NOT NULL,
  `est_penalisee` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `application_commentaire`
--

CREATE TABLE IF NOT EXISTS `application_commentaire` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `membre_id` int(10) NOT NULL,
  `application_id` int(10) NOT NULL,
  `contenu` varchar(1024) NOT NULL,
  `est_suspendu` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `application_critere_note`
--

CREATE TABLE IF NOT EXISTS `application_critere_note` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `membre_id` int(10) NOT NULL,
  `application_id` int(10) NOT NULL,
  `critere_id` smallint(4) NOT NULL,
  `note` tinyint(2) unsigned NOT NULL,
  `commentaire` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `membre_id` (`membre_id`,`application_id`,`critere_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `application_note`
--

CREATE TABLE IF NOT EXISTS `application_note` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `membre_id` int(10) NOT NULL,
  `application_id` int(10) NOT NULL,
  `note` tinyint(2) unsigned NOT NULL,
  `commentaire` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `membre_id` (`membre_id`,`application_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(1024) NOT NULL,
  `contenu` text NOT NULL,
  `date_creation` date NOT NULL,
  `date_modification` date NOT NULL,
  `categorie_id` smallint(4) NOT NULL,
  `device_id` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `article_commentaire`
--

CREATE TABLE IF NOT EXISTS `article_commentaire` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `membre_id` int(10) NOT NULL,
  `article_id` int(10) NOT NULL,
  `contenu` varchar(1024) NOT NULL,
  `est_suspendu` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(256) NOT NULL,
  `parent_id` smallint(4) NOT NULL COMMENT '-1 == pas de parent',
  `logo_url` varchar(1024) NOT NULL,
  `est_pro` tinyint(1) NOT NULL,
  `poids` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `device`
--

CREATE TABLE IF NOT EXISTS `device` (
  `id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(256) NOT NULL,
  `logo` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `editeur`
--

CREATE TABLE IF NOT EXISTS `editeur` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `lien_contact` varchar(1024) NOT NULL,
  `description` text NOT NULL,
  `est_premium` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE IF NOT EXISTS `membre` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(256) NOT NULL,
  `prenom` varchar(256) NOT NULL,
  `sexe` char(1) NOT NULL,
  `date_naissance` date NOT NULL,
  `photo_url` varchar(1024) NOT NULL,
  `email` varchar(256) NOT NULL,
  `pays` char(2) NOT NULL,
  `device_id` tinyint(1) NOT NULL,
  `cgu_valid` tinyint(1) NOT NULL,
  `cgv_valid` tinyint(1) NOT NULL,
  `est_pro` tinyint(1) NOT NULL,
  `newsletter` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `nom` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `date_modification` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `publicite`
--

CREATE TABLE IF NOT EXISTS `publicite` (
  `nom_symbolique` varchar(128) NOT NULL,
  `lien` varchar(1024) NOT NULL,
  `image_url` varchar(1024) NOT NULL,
  PRIMARY KEY (`nom_symbolique`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `selection`
--

CREATE TABLE IF NOT EXISTS `selection` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(256) NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `evennement` tinyint(1) NOT NULL,
  `description` text NOT NULL,
  `categorie_id` smallint(4) NOT NULL COMMENT '-1 == pas de categorie',
  `poids` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `selection_application`
--

CREATE TABLE IF NOT EXISTS `selection_application` (
  `selection_id` smallint(10) NOT NULL,
  `application_id` int(10) NOT NULL,
  UNIQUE KEY `selection_id` (`selection_id`,`application_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
