-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Lun 22 Avril 2013 à 19:59
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
  `nom` varchar(256) NOT NULL,
  `fabriquant_id` tinyint(2) NOT NULL,
  `photo` varchar(1024) NOT NULL,
  `description` text NOT NULL,
  `lien_achat` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `accessoire`
--

INSERT INTO `accessoire` (`id`, `nom`, `fabriquant_id`, `photo`, `description`, `lien_achat`) VALUES
(1, 'access test', 1, 'photo url', '<p>\r\n	coucou</p>\r\n', 'dsqdq');

-- --------------------------------------------------------

--
-- Structure de la table `accessoire_fabriquant`
--

CREATE TABLE IF NOT EXISTS `accessoire_fabriquant` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `accessoire_fabriquant`
--

INSERT INTO `accessoire_fabriquant` (`id`, `nom`, `description`) VALUES
(1, 'test', 'xzada');

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
  `categorie_id` smallint(6) NOT NULL,
  `lien_download` varchar(1024) NOT NULL,
  `version` varchar(16) NOT NULL,
  `logo_url` varchar(1024) NOT NULL,
  `mots_cles` varchar(1024) NOT NULL,
  `est_liste` tinyint(1) NOT NULL,
  `est_partageable` tinyint(1) NOT NULL,
  `est_pro` tinyint(1) NOT NULL,
  `est_penalisee` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `application`
--

INSERT INTO `application` (`id`, `nom`, `package`, `device_id`, `titre`, `description`, `date_ajout`, `prix`, `devise`, `langue_store`, `langue_appli`, `editeur_id`, `categorie_id`, `lien_download`, `version`, `logo_url`, `mots_cles`, `est_liste`, `est_partageable`, `est_pro`, `est_penalisee`) VALUES
(2, 'Urgent Care – Doctors & Nurses Standing By 24/7. Plus, Symptom Checker and Medical Dictionary.', 'com.greatcall.LiveNurse', 1, 'Urgent Care – Doctors & Nurses Standing By 24/7. Plus, Symptom Checker and Medical Dictionary. - GreatCall, Inc.', 'Urgent Care by GreatCall – Instant access to a nurse or doctor 24/7. FREE App!\nUrgent Care lets you speak to a nurse who will triage your medical questions and if needed have a doctor call you back within 30 minutes. The doctor can give assessments, advice and diagnosis of a wide range of conditions over the phone as well as the ability to prescribe common medications.  Plus, Urgent Care features the award winning A.D.A.M. medical dictionary and medical encyclopedia as well as an interactive symptom checker for additional health information.\n\n•Access to a live, registered nurse who can escalate to a board-certified doctor around the clock\n•Get assessments, advice and diagnosis of a wide range of conditions\n•Doctors have ability to prescribe common medications\n•Spanish translators available\n•Interactive symptom checker\n•Medical Dictionary and Medical Encyclopedia', '2013-04-11', 0, 'USD', 'en', 'en', 232, -1, 'https://itunes.apple.com/us/app/urgent-care-doctors-nurses/id428263748?mt=8&uo=2', 'February 28, 201', '', '', 1, 1, 0, 0);

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
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `application_commentaire`
--

INSERT INTO `application_commentaire` (`id`, `membre_id`, `application_id`, `contenu`, `est_suspendu`, `date`) VALUES
(3, 1, 1, '<p>\r\n	test</p>\r\n', 0, '2013-03-28 10:35:44');

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
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `membre_id` (`membre_id`,`application_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `application_note`
--

INSERT INTO `application_note` (`id`, `membre_id`, `application_id`, `note`, `commentaire`, `date`) VALUES
(1, 1, 1, 2, '<p>\r\n	coucou</p>\r\n', '2013-03-28 10:45:30');

-- --------------------------------------------------------

--
-- Structure de la table `application_screenshot`
--

CREATE TABLE IF NOT EXISTS `application_screenshot` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(1024) NOT NULL,
  `application_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `application_screenshot`
--

INSERT INTO `application_screenshot` (`id`, `url`, `application_id`) VALUES
(1, 'http://a5.mzstatic.com/us/r1000/067/Purple/v4/21/13/71/211371d1-2bb7-ff76-6ebc-225ed16be712/mzl.klylghqu.320x480-75.jpg', 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `titre`, `contenu`, `date_creation`, `date_modification`, `categorie_id`, `device_id`) VALUES
(2, 'article', '<p>\r\n	dsq</p>\r\n', '2013-03-27', '2013-03-27', -1, -1);

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
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `article_commentaire`
--

INSERT INTO `article_commentaire` (`id`, `membre_id`, `article_id`, `contenu`, `est_suspendu`, `date`) VALUES
(1, 1, 2, '<p>\r\n	&nbsp;</p>\r\n<div>\r\n	azertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiop</div>\r\n<div>\r\n	azertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiop</div>\r\n<div>\r\n	azertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiop</div>\r\n<div>\r\n	azertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiop</div>\r\n<div>\r\n	azertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiop</div>\r\n<div>\r\n	azertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiop</div>\r\n<div>\r\n	azertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiop</div>\r\n<div>\r\n	azertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiop</div>\r\n<div>\r\n	azertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiop', 1, '0000-00-00 00:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `parent_id`, `logo_url`, `est_pro`, `poids`) VALUES
(1, 'categorie test', 0, 'http://d328ce9sgcu5lp.cloudfront.net/themes/default/images/logo.png', 1, 0),
(2, 'sous catégorie', 1, 'http://d328ce9sgcu5lp.cloudfront.net/themes/default/images/logo.png', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `device`
--

CREATE TABLE IF NOT EXISTS `device` (
  `id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(256) NOT NULL,
  `logo` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `device`
--

INSERT INTO `device` (`id`, `nom`, `logo`) VALUES
(1, 'apple', 'http://cdn3.iconfinder.com/data/icons/picons-social/57/16-apple-128.png'),
(2, 'android', 'http://cdn1.iconfinder.com/data/icons/WPZOOM_Social_Networking_Icon_Set/64/android.png');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=396 ;

--
-- Contenu de la table `editeur`
--

INSERT INTO `editeur` (`id`, `nom`, `lien_contact`, `description`, `est_premium`) VALUES
(4, 'l''Assurance Maladie', 'https://itunes.apple.com/fr/artist/lassurance-maladie/id620447176?mt=8&uo=2', '', 0),
(5, 'Association RMC / BFM', 'https://itunes.apple.com/fr/artist/association-rmc-bfm/id403117519?mt=8&uo=2', '', 0),
(6, 'Brouard Benoit', 'https://itunes.apple.com/fr/artist/brouard-benoit/id572305271?mt=8&uo=2', '', 0),
(7, 'VIDAL', 'https://itunes.apple.com/fr/artist/vidal/id331731194?mt=8&uo=2', '', 0),
(8, 'Rebellion Media', 'https://itunes.apple.com/fr/artist/rebellion-media/id557186155?mt=8&uo=2', '', 0),
(9, 'witiz', 'https://itunes.apple.com/fr/artist/witiz/id429396635?mt=8&uo=2', '', 0),
(10, 'SBW', 'https://itunes.apple.com/fr/artist/sbw/id311171147?mt=8&uo=2', '', 0),
(11, 'Pharmagest Interactive', 'https://itunes.apple.com/fr/artist/pharmagest-interactive/id416091742?mt=8&uo=2', '', 0),
(12, 'Fat Divers Development', 'https://itunes.apple.com/fr/artist/fat-divers-development/id422564410?mt=8&uo=2', '', 0),
(13, 'INSYNCAPP', 'https://itunes.apple.com/fr/artist/insyncapp/id427611574?mt=8&uo=2', '', 0),
(14, 'Palmisphère', 'https://itunes.apple.com/fr/artist/palmisphere/id359030918?mt=8&uo=2', '', 0),
(15, 'Tsavo', 'https://itunes.apple.com/fr/artist/tsavo/id305813346?mt=8&uo=2', '', 0),
(16, 'Darmell Studio', 'https://itunes.apple.com/fr/artist/darmell-studio/id326111287?mt=8&uo=2', '', 0),
(17, 'iVenus', 'https://itunes.apple.com/fr/artist/ivenus/id310089820?mt=8&uo=2', '', 0),
(18, 'J. Verchere', 'https://itunes.apple.com/fr/artist/j.-verchere/id430169280?mt=8&uo=2', '', 0),
(19, 'Doctoralia', 'https://itunes.apple.com/fr/artist/doctoralia/id483398381?mt=8&uo=2', '', 0),
(20, 'Agent S', 'https://itunes.apple.com/fr/artist/agent-s/id578563190?mt=8&uo=2', '', 0),
(21, 'Vauban Humanis', 'https://itunes.apple.com/fr/artist/vauban-humanis/id376618588?mt=8&uo=2', '', 0),
(22, 'Etablissement Français du Sang', 'https://itunes.apple.com/fr/artist/etablissement-francais-du/id427771055?mt=8&uo=2', '', 0),
(23, 'app''Ocrate', 'https://itunes.apple.com/fr/artist/appocrate/id525392068?mt=8&uo=2', '', 0),
(24, '3 Sided Cube', 'https://itunes.apple.com/fr/artist/3-sided-cube/id380288417?mt=8&uo=2', '', 0),
(25, 'Evolve Medical Systems, LLC', 'https://itunes.apple.com/fr/artist/evolve-medical-systems-llc/id519076561?mt=8&uo=2', '', 0),
(26, 'DevelopmentSquared', 'https://itunes.apple.com/fr/artist/developmentsquared/id373286197?mt=8&uo=2', '', 0),
(27, 'Stéphane QUERAUD', 'https://itunes.apple.com/fr/artist/stephane-queraud/id329504689?mt=8&uo=2', '', 0),
(28, 'Elsevier Masson SAS', 'https://itunes.apple.com/fr/artist/elsevier-masson-sas/id354141382?mt=8&uo=2', '', 0),
(29, 'Sogiphar', 'https://itunes.apple.com/fr/artist/sogiphar/id392675836?mt=8&uo=2', '', 0),
(30, 'IMAIOS', 'https://itunes.apple.com/fr/artist/imaios/id334876406?mt=8&uo=2', '', 0),
(31, 'PocketBooster', 'https://itunes.apple.com/fr/artist/pocketbooster/id509805316?mt=8&uo=2', '', 0),
(32, 'Citec-b', 'https://itunes.apple.com/fr/artist/citec-b/id499218169?mt=8&uo=2', '', 0),
(33, 'Croix-Rouge française', 'https://itunes.apple.com/fr/artist/croix-rouge-francaise/id407785635?mt=8&uo=2', '', 0),
(34, 'AGFA Healthcare Entreprise Solutions', 'https://itunes.apple.com/fr/artist/agfa-healthcare-entreprise/id511268520?mt=8&uo=2', '', 0),
(35, 'SNAL (Société Nouvelle des Ateliers Logiques)', 'https://itunes.apple.com/fr/artist/snal-societe-nouvelle-des/id500693432?mt=8&uo=2', '', 0),
(36, 'Bristol Myers Squibb', 'https://itunes.apple.com/fr/artist/bristol-myers-squibb/id499869937?mt=8&uo=2', '', 0),
(37, 'QA International', 'https://itunes.apple.com/fr/artist/qa-international/id433638720?mt=8&uo=2', '', 0),
(38, 'Univers Pharmacie', 'https://itunes.apple.com/fr/artist/univers-pharmacie/id578202711?mt=8&uo=2', '', 0),
(39, 'njin', 'https://itunes.apple.com/fr/artist/njin/id469805199?mt=8&uo=2', '', 0),
(40, 'D2 INVEST', 'https://itunes.apple.com/fr/artist/d2-invest/id571442044?mt=8&uo=2', '', 0),
(41, 'O''Peppers', 'https://itunes.apple.com/fr/artist/opeppers/id359876570?mt=8&uo=2', '', 0),
(42, 'Boiron', 'https://itunes.apple.com/fr/artist/boiron/id496840747?mt=8&uo=2', '', 0),
(43, 'ModiFace', 'https://itunes.apple.com/fr/artist/modiface/id308030250?mt=8&uo=2', '', 0),
(44, 'Le Public Système PCO', 'https://itunes.apple.com/fr/artist/le-public-systeme-pco/id429909375?mt=8&uo=2', '', 0),
(45, 'Systeme Polaire', 'https://itunes.apple.com/fr/artist/systeme-polaire/id357010758?mt=8&uo=2', '', 0),
(46, 'Laboratoires PAUL HARTMANN', 'https://itunes.apple.com/fr/artist/laboratoires-paul-hartmann/id529061913?mt=8&uo=2', '', 0),
(47, 'pierre Le Mignant', 'https://itunes.apple.com/fr/artist/pierre-le-mignant/id587799096?mt=8&uo=2', '', 0),
(48, 'Euthérapie', 'https://itunes.apple.com/fr/artist/eutherapie/id589792175?mt=8&uo=2', '', 0),
(49, 'Digitaran', 'https://itunes.apple.com/fr/artist/digitaran/id444739708?mt=8&uo=2', '', 0),
(50, 'Resip BCB', 'https://itunes.apple.com/fr/artist/resip-bcb/id307106717?mt=8&uo=2', '', 0),
(51, 'Loic Portales', 'https://itunes.apple.com/fr/artist/loic-portales/id591037436?mt=8&uo=2', '', 0),
(52, 'Roche Diagnostics France', 'https://itunes.apple.com/fr/artist/roche-diagnostics-france/id349918810?mt=8&uo=2', '', 0),
(53, 'Parsys Telemedecine', 'https://itunes.apple.com/fr/artist/parsys-telemedecine/id495589539?mt=8&uo=2', '', 0),
(54, 'Mike Steinbach', 'https://itunes.apple.com/fr/artist/mike-steinbach/id451121102?mt=8&uo=2', '', 0),
(55, 'Clafou Apps', 'https://itunes.apple.com/fr/artist/clafou-apps/id424537553?mt=8&uo=2', '', 0),
(56, 'Wooden Apps Production', 'https://itunes.apple.com/fr/artist/wooden-apps-production/id372271646?mt=8&uo=2', '', 0),
(57, 'ProCom Media', 'https://itunes.apple.com/fr/artist/procom-media/id396772473?mt=8&uo=2', '', 0),
(58, 'michael heinz', 'https://itunes.apple.com/fr/artist/michael-heinz/id292745639?mt=8&uo=2', '', 0),
(59, 'MOBILE HEALTH', 'https://itunes.apple.com/fr/artist/mobile-health/id334651083?mt=8&uo=2', '', 0),
(60, 'Medicon Apps', 'https://itunes.apple.com/fr/artist/medicon-apps/id307829597?mt=8&uo=2', '', 0),
(61, 'Institut UPSA de la douleur', 'https://itunes.apple.com/fr/artist/institut-upsa-de-la-douleur/id472663976?mt=8&uo=2', '', 0),
(62, 'Nutrimedia technologies', 'https://itunes.apple.com/fr/artist/nutrimedia-technologies/id493230306?mt=8&uo=2', '', 0),
(63, 'MIM Software Inc.', 'https://itunes.apple.com/fr/artist/mim-software-inc./id281922772?mt=8&uo=2', '', 0),
(64, 'Saooti', 'https://itunes.apple.com/fr/artist/saooti/id386931454?mt=8&uo=2', '', 0),
(65, 'GLOBAL MÉDIA SANTÉ', 'https://itunes.apple.com/fr/artist/global-media-sante/id416450625?mt=8&uo=2', '', 0),
(66, 'Cité Amérique', 'https://itunes.apple.com/fr/artist/cite-amerique/id477052304?mt=8&uo=2', '', 0),
(67, 'Annonces Medicales', 'https://itunes.apple.com/fr/artist/annonces-medicales/id540326875?mt=8&uo=2', '', 0),
(68, 'TEKNEO', 'https://itunes.apple.com/fr/artist/tekneo/id339724052?mt=8&uo=2', '', 0),
(69, 'AGM Multimédia', 'https://itunes.apple.com/fr/artist/agm-multimedia/id422056586?mt=8&uo=2', '', 0),
(70, 'VIRBAC', 'https://itunes.apple.com/fr/artist/virbac/id533804437?mt=8&uo=2', '', 0),
(71, 'F. Hoffmann-La Roche', 'https://itunes.apple.com/fr/artist/f.-hoffmann-la-roche/id451131453?mt=8&uo=2', '', 0),
(72, 'Great Plains Enterprises, Inc.', 'https://itunes.apple.com/fr/artist/great-plains-enterprises-inc./id326685082?mt=8&uo=2', '', 0),
(73, 'VISIONARY MEN SOFTWARE', 'https://itunes.apple.com/fr/artist/visionary-men-software/id478613883?mt=8&uo=2', '', 0),
(74, 'honggang li', 'https://itunes.apple.com/fr/artist/honggang-li/id421380734?mt=8&uo=2', '', 0),
(75, 'ecoTouchMedia.com', 'https://itunes.apple.com/fr/artist/ecotouchmedia.com/id395317930?mt=8&uo=2', '', 0),
(76, 'Taconic System LLC', 'https://itunes.apple.com/fr/artist/taconic-system-llc/id423175336?mt=8&uo=2', '', 0),
(77, 'Janssen EMEA', 'https://itunes.apple.com/fr/artist/janssen-emea/id460370372?mt=8&uo=2', '', 0),
(78, 'Callimedia', 'https://itunes.apple.com/fr/artist/callimedia/id475557836?mt=8&uo=2', '', 0),
(79, 'Forecomm', 'https://itunes.apple.com/fr/artist/forecomm/id335566025?mt=8&uo=2', '', 0),
(80, 'Monster Minds Media SAS', 'https://itunes.apple.com/fr/artist/monster-minds-media-sas/id358915267?mt=8&uo=2', '', 0),
(81, 'HAPPYneuron', 'https://itunes.apple.com/fr/artist/happyneuron/id322303023?mt=8&uo=2', '', 0),
(82, 'Ruben BELOGIC-Fernandez', 'https://itunes.apple.com/fr/artist/ruben-belogic-fernandez/id290571265?mt=8&uo=2', '', 0),
(83, 'Wolters Kluwer France', 'https://itunes.apple.com/fr/artist/wolters-kluwer-france/id371677696?mt=8&uo=2', '', 0),
(84, 'Eduardo Torres', 'https://itunes.apple.com/fr/artist/eduardo-torres/id502886916?mt=8&uo=2', '', 0),
(85, 'IRCAD', 'https://itunes.apple.com/fr/artist/ircad/id422029307?mt=8&uo=2', '', 0),
(86, 'Carlo Bendinelli', 'https://itunes.apple.com/fr/artist/carlo-bendinelli/id507904241?mt=8&uo=2', '', 0),
(87, 'Manuel Posadas', 'https://itunes.apple.com/fr/artist/manuel-posadas/id528175386?mt=8&uo=2', '', 0),
(88, 'Sebastien Clement', 'https://itunes.apple.com/fr/artist/sebastien-clement/id343788572?mt=8&uo=2', '', 0),
(89, 'iPear', 'https://itunes.apple.com/fr/artist/ipear/id437804331?mt=8&uo=2', '', 0),
(90, 'mySugr', 'https://itunes.apple.com/fr/artist/mysugr/id516509214?mt=8&uo=2', '', 0),
(91, 'WiThings, S.A.S.', 'https://itunes.apple.com/fr/artist/withings-s.a.s./id298933045?mt=8&uo=2', '', 0),
(92, 'ExSilent B.V.', 'https://itunes.apple.com/fr/artist/exsilent-b.v./id569522477?mt=8&uo=2', '', 0),
(93, 'S Editions', 'https://itunes.apple.com/fr/artist/s-editions/id428934287?mt=8&uo=2', '', 0),
(94, 'Omnicia Mobile', 'https://itunes.apple.com/fr/artist/omnicia-mobile/id533081329?mt=8&uo=2', '', 0),
(95, 'Samuel Bezerra Gomes', 'https://itunes.apple.com/fr/artist/samuel-bezerra-gomes/id618340588?mt=8&uo=2', '', 0),
(96, 'Eli Lilly and Company', 'https://itunes.apple.com/fr/artist/eli-lilly-and-company/id429410727?mt=8&uo=2', '', 0),
(97, 'Sylvain Sanson', 'https://itunes.apple.com/fr/artist/sylvain-sanson/id564141530?mt=8&uo=2', '', 0),
(98, 'Medicilline', 'https://itunes.apple.com/fr/artist/medicilline/id356181545?mt=8&uo=2', '', 0),
(99, 'Big Blue Apps', 'https://itunes.apple.com/fr/artist/big-blue-apps/id320248328?mt=8&uo=2', '', 0),
(100, 'ReferencesOnTap', 'https://itunes.apple.com/fr/artist/referencesontap/id301316543?mt=8&uo=2', '', 0),
(101, 'Immanens', 'https://itunes.apple.com/fr/artist/immanens/id331291567?mt=8&uo=2', '', 0),
(102, 'WebMD', 'https://itunes.apple.com/fr/artist/webmd/id295076332?mt=8&uo=2', '', 0),
(103, 'The New England Journal of Medicine', 'https://itunes.apple.com/fr/artist/new-england-journal-medicine/id373156257?mt=8&uo=2', '', 0),
(104, 'ALK Abello - France', 'https://itunes.apple.com/fr/artist/alk-abello-france/id561687088?mt=8&uo=2', '', 0),
(105, 'Montuno Software, LLC', 'https://itunes.apple.com/fr/artist/montuno-software-llc/id365191647?mt=8&uo=2', '', 0),
(106, 'LVDG SARL', 'https://itunes.apple.com/fr/artist/lvdg-sarl/id409878776?mt=8&uo=2', '', 0),
(107, 'Le Guide Santé SAS', 'https://itunes.apple.com/fr/artist/le-guide-sante-sas/id569232234?mt=8&uo=2', '', 0),
(108, 'Cybersimple', 'https://itunes.apple.com/fr/artist/cybersimple/id311230746?mt=8&uo=2', '', 0),
(109, 'SEDAP', 'https://itunes.apple.com/fr/artist/sedap/id562172390?mt=8&uo=2', '', 0),
(110, '3M Company', 'https://itunes.apple.com/fr/artist/3m-company/id396772465?mt=8&uo=2', '', 0),
(111, 'Paul-Henri KOECK', 'https://itunes.apple.com/fr/artist/paul-henri-koeck/id571258722?mt=8&uo=2', '', 0),
(112, 'G.H.T. srl', 'https://itunes.apple.com/fr/artist/g.h.t.-srl/id439304730?mt=8&uo=2', '', 0),
(113, 'Comparatel', 'https://itunes.apple.com/fr/artist/comparatel/id394254218?mt=8&uo=2', '', 0),
(114, '74 monkeys', 'https://itunes.apple.com/fr/artist/74-monkeys/id331935695?mt=8&uo=2', '', 0),
(115, 'Smart In Media', 'https://itunes.apple.com/fr/artist/smart-in-media/id613186460?mt=8&uo=2', '', 0),
(116, 'USABCD A/S', 'https://itunes.apple.com/fr/artist/usabcd-a-s/id413628615?mt=8&uo=2', '', 0),
(117, 'Unitron Hearing Limited', 'https://itunes.apple.com/fr/artist/unitron-hearing-limited/id309811825?mt=8&uo=2', '', 0),
(118, 'Groupe PHR', 'https://itunes.apple.com/fr/artist/groupe-phr/id380372687?mt=8&uo=2', '', 0),
(119, 'BULKY-APPS', 'https://itunes.apple.com/fr/artist/bulky-apps/id359612415?mt=8&uo=2', '', 0),
(120, 'Tr3polar LLC', 'https://itunes.apple.com/fr/artist/tr3polar-llc/id402619009?mt=8&uo=2', '', 0),
(121, 'SNLM', 'https://itunes.apple.com/fr/artist/snlm/id442928048?mt=8&uo=2', '', 0),
(122, 'MindValley LLC', 'https://itunes.apple.com/fr/artist/mindvalley-llc/id365715934?mt=8&uo=2', '', 0),
(123, 'MediPlanet-PharmaPlanet', 'https://itunes.apple.com/fr/artist/mediplanet-pharmaplanet/id556819241?mt=8&uo=2', '', 0),
(124, 'Education Mobile', 'https://itunes.apple.com/fr/artist/education-mobile/id519530928?mt=8&uo=2', '', 0),
(125, 'Logicmax Technologie', 'https://itunes.apple.com/fr/artist/logicmax-technologie/id350379715?mt=8&uo=2', '', 0),
(126, 'L''information Dentaire SAS', 'https://itunes.apple.com/fr/artist/linformation-dentaire-sas/id467605987?mt=8&uo=2', '', 0),
(127, 'AirStrip Technologies, LLC', 'https://itunes.apple.com/fr/artist/airstrip-technologies-llc/id309381243?mt=8&uo=2', '', 0),
(128, 'Cegedim Logiciels Médicaux', 'https://itunes.apple.com/fr/artist/cegedim-logiciels-medicaux/id475747594?mt=8&uo=2', '', 0),
(129, 'Mead Johnson & Company, LLC', 'https://itunes.apple.com/fr/artist/mead-johnson-company-llc/id437488079?mt=8&uo=2', '', 0),
(130, 'Agence Teaser', 'https://itunes.apple.com/fr/artist/agence-teaser/id406477264?mt=8&uo=2', '', 0),
(131, 'Laboratoires Genévrier', 'https://itunes.apple.com/fr/artist/laboratoires-genevrier/id513340947?mt=8&uo=2', '', 0),
(132, 'APRIL Sante Prevoyance', 'https://itunes.apple.com/fr/artist/april-sante-prevoyance/id368207919?mt=8&uo=2', '', 0),
(133, 'Asteria Solutions', 'https://itunes.apple.com/fr/artist/asteria-solutions/id501647312?mt=8&uo=2', '', 0),
(134, 'didier Mennecier', 'https://itunes.apple.com/fr/artist/didier-mennecier/id429505235?mt=8&uo=2', '', 0),
(135, 'Elaine Heney', 'https://itunes.apple.com/fr/artist/elaine-heney/id532878323?mt=8&uo=2', '', 0),
(136, 'ORCA MD', 'https://itunes.apple.com/fr/artist/orca-md/id388760828?mt=8&uo=2', '', 0),
(137, 'iPetBrand Co.,Ltd.', 'https://itunes.apple.com/fr/artist/ipetbrand-co.-ltd./id462659273?mt=8&uo=2', '', 0),
(138, 'AppAnnex, LLC', 'https://itunes.apple.com/fr/artist/appannex-llc/id405239910?mt=8&uo=2', '', 0),
(139, 'Sylmaprod', 'https://itunes.apple.com/fr/artist/sylmaprod/id384674898?mt=8&uo=2', '', 0),
(140, 'Appengo', 'https://itunes.apple.com/fr/artist/appengo/id367379973?mt=8&uo=2', '', 0),
(141, 'mConfs', 'https://itunes.apple.com/fr/artist/mconfs/id429014351?mt=8&uo=2', '', 0),
(142, 'SII Nantes', 'https://itunes.apple.com/fr/artist/sii-nantes/id451756870?mt=8&uo=2', '', 0),
(143, 'Len Medical', 'https://itunes.apple.com/fr/artist/len-medical/id494121483?mt=8&uo=2', '', 0),
(144, 'Depil Tech', 'https://itunes.apple.com/fr/artist/depil-tech/id498191172?mt=8&uo=2', '', 0),
(145, 'MobileMed Sarl', 'https://itunes.apple.com/fr/artist/mobilemed-sarl/id376858373?mt=8&uo=2', '', 0),
(146, 'Fresenius Kabi France', 'https://itunes.apple.com/fr/artist/fresenius-kabi-france/id523018133?mt=8&uo=2', '', 0),
(147, 'AO Foundation', 'https://itunes.apple.com/fr/artist/ao-foundation/id399757056?mt=8&uo=2', '', 0),
(148, 'Masimo Corporation', 'https://itunes.apple.com/fr/artist/masimo-corporation/id568979269?mt=8&uo=2', '', 0),
(149, 'Groupe Synox', 'https://itunes.apple.com/fr/artist/groupe-synox/id470837300?mt=8&uo=2', '', 0),
(150, 'Novartis Pharma S.A.S.', 'https://itunes.apple.com/fr/artist/novartis-pharma-s.a.s./id527924405?mt=8&uo=2', '', 0),
(151, 'DDL Médias', 'https://itunes.apple.com/fr/artist/ddl-medias/id601326938?mt=8&uo=2', '', 0),
(152, 'Herbal Care LLC', 'https://itunes.apple.com/fr/artist/herbal-care-llc/id457072456?mt=8&uo=2', '', 0),
(153, 'Antadir', 'https://itunes.apple.com/fr/artist/antadir/id497357428?mt=8&uo=2', '', 0),
(154, 'National Library of Medicine', 'https://itunes.apple.com/fr/artist/national-library-of-medicine/id352646071?mt=8&uo=2', '', 0),
(155, 'Expanded Apps', 'https://itunes.apple.com/fr/artist/expanded-apps/id313709778?mt=8&uo=2', '', 0),
(156, 'Cardiac Designs', 'https://itunes.apple.com/fr/artist/cardiac-designs/id616190894?mt=8&uo=2', '', 0),
(157, 'John Brownstein', 'https://itunes.apple.com/fr/artist/john-brownstein/id328358696?mt=8&uo=2', '', 0),
(158, 'Europa Organisation', 'https://itunes.apple.com/fr/artist/europa-organisation/id369661696?mt=8&uo=2', '', 0),
(159, 'Aperture Mobile', 'https://itunes.apple.com/fr/artist/aperture-mobile/id595926447?mt=8&uo=2', '', 0),
(160, 'Elsevier srl', 'https://itunes.apple.com/fr/artist/elsevier-srl/id410025589?mt=8&uo=2', '', 0),
(161, 'EDITIEL LTEE', 'https://itunes.apple.com/fr/artist/editiel-ltee/id490955174?mt=8&uo=2', '', 0),
(162, 'L.A. Louizos, MD', 'https://itunes.apple.com/fr/artist/l.a.-louizos-md/id553197810?mt=8&uo=2', '', 0),
(163, 'Pocketmednotes.com', 'https://itunes.apple.com/fr/artist/pocketmednotes.com/id429773995?mt=8&uo=2', '', 0),
(164, 'Smith & Nephew', 'https://itunes.apple.com/fr/artist/smith-nephew/id549124657?mt=8&uo=2', '', 0),
(165, 'Elsevier, Inc', 'https://itunes.apple.com/fr/artist/elsevier-inc/id367031326?mt=8&uo=2', '', 0),
(166, 'Idealistic Future Ltd.', 'https://itunes.apple.com/fr/artist/idealistic-future-ltd./id409849453?mt=8&uo=2', '', 0),
(167, 'Air Capital Media LLC', 'https://itunes.apple.com/fr/artist/air-capital-media-llc/id549395534?mt=8&uo=2', '', 0),
(168, 'Coloplast', 'https://itunes.apple.com/fr/artist/coloplast/id515277810?mt=8&uo=2', '', 0),
(169, 'Stroika', 'https://itunes.apple.com/fr/artist/stroika/id302579414?mt=8&uo=2', '', 0),
(170, 'iGrez LLC', 'https://itunes.apple.com/fr/artist/igrez-llc/id315129971?mt=8&uo=2', '', 0),
(171, 'AppQuartz ™', 'https://itunes.apple.com/fr/artist/appquartz/id402470134?mt=8&uo=2', '', 0),
(172, 'Max Soderstrom', 'https://itunes.apple.com/fr/artist/max-soderstrom/id311497961?mt=8&uo=2', '', 0),
(173, 'Aerende, Inc.', 'https://itunes.apple.com/fr/artist/aerende-inc./id312124392?mt=8&uo=2', '', 0),
(174, 'TOMATO Co.,Ltd', 'https://itunes.apple.com/fr/artist/tomato-co.-ltd/id327967689?mt=8&uo=2', '', 0),
(175, 'Dr François Petit', 'https://itunes.apple.com/fr/artist/dr-francois-petit/id411897989?mt=8&uo=2', '', 0),
(176, 'Benoit Essiambre', 'https://itunes.apple.com/fr/artist/benoit-essiambre/id310943988?mt=8&uo=2', '', 0),
(177, 'Dok LLC', 'https://itunes.apple.com/fr/artist/dok-llc/id293163442?mt=8&uo=2', '', 0),
(178, 'Boom Mobile SA', 'https://itunes.apple.com/fr/artist/boom-mobile-sa/id294635519?mt=8&uo=2', '', 0),
(179, 'MIND POWER', 'https://itunes.apple.com/fr/artist/mind-power/id389233701?mt=8&uo=2', '', 0),
(180, 'undercover scientist software', 'https://itunes.apple.com/fr/artist/undercover-scientist-software/id293807023?mt=8&uo=2', '', 0),
(181, 'Curve Technologies Inc.', 'https://itunes.apple.com/fr/artist/curve-technologies-inc./id307184191?mt=8&uo=2', '', 0),
(182, 'Epocrates', 'https://itunes.apple.com/fr/artist/epocrates/id281935791?mt=8&uo=2', '', 0),
(183, 'Cube Of M', 'https://itunes.apple.com/fr/artist/cube-of-m/id356153270?mt=8&uo=2', '', 0),
(184, 'Andrei Zaharia', 'https://itunes.apple.com/fr/artist/andrei-zaharia/id326168003?mt=8&uo=2', '', 0),
(185, 'JPL', 'https://itunes.apple.com/fr/artist/jpl/id354949819?mt=8&uo=2', '', 0),
(186, 'Michael Quach', 'https://itunes.apple.com/fr/artist/michael-quach/id320947560?mt=8&uo=2', '', 0),
(187, 'Cassiopeia Information Technologies', 'https://itunes.apple.com/fr/artist/cassiopeia-information-technologies/id315123663?mt=8&uo=2', '', 0),
(188, 'University of Maryland Medical System', 'https://itunes.apple.com/fr/artist/university-maryland-medical/id313696787?mt=8&uo=2', '', 0),
(189, '3D4Medical.com, LLC', 'https://itunes.apple.com/fr/artist/3d4medical.com-llc/id315902958?mt=8&uo=2', '', 0),
(190, 'Kreativität & Wissen Verlag und Buchhandel GmbH', 'https://itunes.apple.com/fr/artist/kreativitat-wissen-verlag/id361390981?mt=8&uo=2', '', 0),
(191, 'Gregor Czempiel', 'https://itunes.apple.com/fr/artist/gregor-czempiel/id291862282?mt=8&uo=2', '', 0),
(192, 'Zenkko', 'https://itunes.apple.com/fr/artist/zenkko/id369339028?mt=8&uo=2', '', 0),
(193, 'WeedMaps', 'https://itunes.apple.com/fr/artist/weedmaps/id350189838?mt=8&uo=2', '', 0),
(194, 'Clinique New Vision', 'https://itunes.apple.com/fr/artist/clinique-new-vision/id393299830?mt=8&uo=2', '', 0),
(195, 'QxMD Medical Software', 'https://itunes.apple.com/fr/artist/qxmd-medical-software/id299841206?mt=8&uo=2', '', 0),
(196, 'Skyscape', 'https://itunes.apple.com/fr/artist/skyscape/id293170171?mt=8&uo=2', '', 0),
(197, 'AtomX', 'https://itunes.apple.com/fr/artist/atomx/id469341742?mt=8&uo=2', '', 0),
(198, 'Smart Valley Software Ltd', 'https://itunes.apple.com/fr/artist/smart-valley-software-ltd/id309530701?mt=8&uo=2', '', 0),
(199, 'Ary Tebeka', 'https://itunes.apple.com/fr/artist/ary-tebeka/id375595955?mt=8&uo=2', '', 0),
(200, 'Austin Physician Productivity, LLC', 'https://itunes.apple.com/fr/artist/austin-physician-productivity/id290806832?mt=8&uo=2', '', 0),
(201, 'Tulips Sarl', 'https://itunes.apple.com/fr/artist/tulips-sarl/id336472655?mt=8&uo=2', '', 0),
(202, 'AppZap', 'https://itunes.apple.com/fr/artist/appzap/id288503237?mt=8&uo=2', '', 0),
(203, 'Georg Thieme Verlag KG', 'https://itunes.apple.com/fr/artist/georg-thieme-verlag-kg/id392272730?mt=8&uo=2', '', 0),
(204, 'Groupe Plus Pharmacie', 'https://itunes.apple.com/fr/artist/groupe-plus-pharmacie/id400461236?mt=8&uo=2', '', 0),
(205, 'SoftwareX', 'https://itunes.apple.com/fr/artist/softwarex/id301174594?mt=8&uo=2', '', 0),
(206, 'Epsilog', 'https://itunes.apple.com/fr/artist/epsilog/id442378026?mt=8&uo=2', '', 0),
(207, 'WENLONG SUN', 'https://itunes.apple.com/fr/artist/wenlong-sun/id454086703?mt=8&uo=2', '', 0),
(208, 'New Media Plus', 'https://itunes.apple.com/fr/artist/new-media-plus/id333216256?mt=8&uo=2', '', 0),
(209, 'Ossus GmbH', 'https://itunes.apple.com/fr/artist/ossus-gmbh/id286022405?mt=8&uo=2', '', 0),
(210, 'Global EyeVentures, LLC', 'https://itunes.apple.com/fr/artist/global-eyeventures-llc/id348803707?mt=8&uo=2', '', 0),
(211, 'Wuonm', 'https://itunes.apple.com/fr/artist/wuonm/id290447779?mt=8&uo=2', '', 0),
(212, 'Michael Schneider', 'https://itunes.apple.com/fr/artist/michael-schneider/id287925639?mt=8&uo=2', '', 0),
(213, 'Kickoo', 'https://itunes.apple.com/fr/artist/kickoo/id297710319?mt=8&uo=2', '', 0),
(214, 'Darren Marks', 'https://itunes.apple.com/fr/artist/darren-marks/id342563234?mt=8&uo=2', '', 0),
(215, 'Out Fit 7 Ltd.', 'https://itunes.apple.com/fr/artist/out-fit-7-ltd./id351110111?mt=8&uo=2', '', 0),
(216, 'George Talusan', 'https://itunes.apple.com/fr/artist/george-talusan/id289224719?mt=8&uo=2', '', 0),
(217, 'Wang Lixiang', 'https://itunes.apple.com/fr/artist/wang-lixiang/id302670576?mt=8&uo=2', '', 0),
(218, 'Body Scientific International, LLC.', 'https://itunes.apple.com/fr/artist/body-scientific-international/id404454300?mt=8&uo=2', '', 0),
(219, 'Goomeo', 'https://itunes.apple.com/fr/artist/goomeo/id407530320?mt=8&uo=2', '', 0),
(220, 'Pacific Spirit Media', 'https://itunes.apple.com/fr/artist/pacific-spirit-media/id324529664?mt=8&uo=2', '', 0),
(221, 'CASH Telecom', 'https://itunes.apple.com/fr/artist/cash-telecom/id376343563?mt=8&uo=2', '', 0),
(222, 'i-com', 'https://itunes.apple.com/fr/artist/i-com/id368173826?mt=8&uo=2', '', 0),
(223, 'Seema Verma', 'https://itunes.apple.com/fr/artist/seema-verma/id478672331?mt=8&uo=2', '', 0),
(224, 'Anatoly Butko', 'https://itunes.apple.com/fr/artist/anatoly-butko/id300289656?mt=8&uo=2', '', 0),
(225, 'Hipposoft, LLC', 'https://itunes.apple.com/fr/artist/hipposoft-llc/id314644548?mt=8&uo=2', '', 0),
(226, 'Azumio Inc.', 'https://itunes.apple.com/fr/artist/azumio-inc./id439290207?mt=8&uo=2', '', 0),
(227, 'Biomnis', 'https://itunes.apple.com/fr/artist/biomnis/id483521675?mt=8&uo=2', '', 0),
(228, 'Mindifi LLC', 'https://itunes.apple.com/fr/artist/mindifi-llc/id570601283?mt=8&uo=2', '', 0),
(229, 'iLearning', 'https://itunes.apple.com/fr/artist/ilearning/id487957348?mt=8&uo=2', '', 0),
(230, 'Poulet Maison Ptd Ltd', 'https://itunes.apple.com/fr/artist/poulet-maison-ptd-ltd/id291824239?mt=8&uo=2', '', 0),
(231, 'NEAD', 'https://itunes.apple.com/fr/artist/nead/id412813940?mt=8&uo=2', '', 0),
(232, 'GreatCall, Inc.', 'https://itunes.apple.com/us/artist/greatcall-inc./id428263751?mt=8&uo=2', '', 0),
(233, 'Epic', 'https://itunes.apple.com/us/artist/epic/id348308666?mt=8&uo=2', '', 0),
(234, '1-800 CONTACTS, Inc.', 'https://itunes.apple.com/us/artist/1-800-contacts-inc./id362333049?mt=8&uo=2', '', 0),
(235, 'Health & Parenting Ltd', 'https://itunes.apple.com/us/artist/health-parenting-ltd/id505862557?mt=8&uo=2', '', 0),
(236, 'Truven Health Analytics Inc.', 'https://itunes.apple.com/us/artist/truven-health-analytics-inc./id385093956?mt=8&uo=2', '', 0),
(237, 'ZocDoc', 'https://itunes.apple.com/us/artist/zocdoc/id391062222?mt=8&uo=2', '', 0),
(238, 'InfoCures', 'https://itunes.apple.com/us/artist/infocures/id424591547?mt=8&uo=2', '', 0),
(239, 'Quest Diagnostics, Inc.', 'https://itunes.apple.com/us/artist/quest-diagnostics-inc./id300300771?mt=8&uo=2', '', 0),
(240, 'Lost Ego Studios Limited', 'https://itunes.apple.com/us/artist/lost-ego-studios-limited/id301051757?mt=8&uo=2', '', 0),
(241, 'Ian Donaldson', 'https://itunes.apple.com/us/artist/ian-donaldson/id382536836?mt=8&uo=2', '', 0),
(242, 'SigmaPhone LLC', 'https://itunes.apple.com/us/artist/sigmaphone-llc/id328145667?mt=8&uo=2', '', 0),
(243, 'GoodRx', 'https://itunes.apple.com/us/artist/goodrx/id485357020?mt=8&uo=2', '', 0),
(244, 'Palanati Group, LLC', 'https://itunes.apple.com/us/artist/palanati-group-llc/id373033635?mt=8&uo=2', '', 0),
(245, 'Sevenlogics, Inc.', 'https://itunes.apple.com/us/artist/sevenlogics-inc./id346249545?mt=8&uo=2', '', 0),
(246, 'RxmindMe, LLC', 'https://itunes.apple.com/us/artist/rxmindme-llc/id332665816?mt=8&uo=2', '', 0),
(247, 'Kindara, Inc.', 'https://itunes.apple.com/us/artist/kindara-inc./id522674375?mt=8&uo=2', '', 0),
(248, 'About The Kids Foundation', 'https://itunes.apple.com/us/artist/about-the-kids-foundation/id412786823?mt=8&uo=2', '', 0),
(249, 'WellPoint Inc.', 'https://itunes.apple.com/us/artist/wellpoint-inc./id589441256?mt=8&uo=2', '', 0),
(250, 'Human Progress', 'https://itunes.apple.com/us/artist/human-progress/id327538175?mt=8&uo=2', '', 0),
(251, 'McNeil-PPC, Inc', 'https://itunes.apple.com/us/artist/mcneil-ppc-inc/id320298023?mt=8&uo=2', '', 0),
(252, 'Med ART Studios', 'https://itunes.apple.com/us/artist/med-art-studios/id369577478?mt=8&uo=2', '', 0),
(253, 'Free Style', 'https://itunes.apple.com/us/artist/free-style/id417373765?mt=8&uo=2', '', 0),
(254, 'Unbound Medicine, Inc.', 'https://itunes.apple.com/us/artist/unbound-medicine-inc./id300420400?mt=8&uo=2', '', 0),
(255, 'Medical Joyworks', 'https://itunes.apple.com/us/artist/medical-joyworks/id392489857?mt=8&uo=2', '', 0),
(256, 'Drugs.com', 'https://itunes.apple.com/us/artist/drugs.com/id389479628?mt=8&uo=2', '', 0),
(257, 'Lexi-Comp', 'https://itunes.apple.com/us/artist/lexi-comp/id295207927?mt=8&uo=2', '', 0),
(258, 'Wolters Kluwer Health', 'https://itunes.apple.com/us/artist/wolters-kluwer-health/id378587365?mt=8&uo=2', '', 0),
(259, 'Focus Medica', 'https://itunes.apple.com/us/artist/focus-medica/id508294531?mt=8&uo=2', '', 0),
(260, 'Evan Schoenberg', 'https://itunes.apple.com/us/artist/evan-schoenberg/id289039917?mt=8&uo=2', '', 0),
(261, 'BitMethod', 'https://itunes.apple.com/us/artist/bitmethod/id324536986?mt=8&uo=2', '', 0),
(262, 'Jardogs, LLC', 'https://itunes.apple.com/us/artist/jardogs-llc/id455417898?mt=8&uo=2', '', 0),
(263, 'Ion Citadel, LLC', 'https://itunes.apple.com/us/artist/ion-citadel-llc/id496111267?mt=8&uo=2', '', 0),
(264, 'Maxwell Software', 'https://itunes.apple.com/us/artist/maxwell-software/id376557917?mt=8&uo=2', '', 0),
(265, 'relaxiapps', 'https://itunes.apple.com/us/artist/relaxiapps/id552797520?mt=8&uo=2', '', 0),
(266, 'Medwhat.com Inc.', 'https://itunes.apple.com/us/artist/medwhat.com-inc./id618592693?mt=8&uo=2', '', 0),
(267, 'Doximity', 'https://itunes.apple.com/us/artist/doximity/id391582379?mt=8&uo=2', '', 0),
(268, 'EM Gladiators LLC', 'https://itunes.apple.com/us/artist/em-gladiators-llc/id370838186?mt=8&uo=2', '', 0),
(269, 'Joseph Clough', 'https://itunes.apple.com/us/artist/joseph-clough/id371116794?mt=8&uo=2', '', 0),
(270, 'Dyess Software', 'https://itunes.apple.com/us/artist/dyess-software/id354925406?mt=8&uo=2', '', 0),
(271, 'BetterDoctor.com', 'https://itunes.apple.com/us/artist/betterdoctor.com/id588931418?mt=8&uo=2', '', 0),
(272, 'UpToDate, Inc.', 'https://itunes.apple.com/us/artist/uptodate-inc./id334265348?mt=8&uo=2', '', 0),
(273, 'BHI Technologies, Inc.', 'https://itunes.apple.com/us/artist/bhi-technologies-inc./id337011504?mt=8&uo=2', '', 0),
(274, 'Sheldon Technology & Design', 'https://itunes.apple.com/us/artist/sheldon-technology-design/id584405672?mt=8&uo=2', '', 0),
(275, 'RealCME, Inc.', 'https://itunes.apple.com/us/artist/realcme-inc./id399842589?mt=8&uo=2', '', 0),
(276, 'PulsePoint Foundation', 'https://itunes.apple.com/us/artist/pulsepoint-foundation/id500772137?mt=8&uo=2', '', 0),
(277, 'Symple Health, LLC', 'https://itunes.apple.com/us/artist/symple-health-llc/id479818118?mt=8&uo=2', '', 0),
(278, 'U.S. Department of Health & Human Services-AHRQ', 'https://itunes.apple.com/us/artist/u.s.-department-health-human/id311852563?mt=8&uo=2', '', 0),
(279, 'Dreamz Technologies', 'https://itunes.apple.com/us/artist/dreamz-technologies/id519565305?mt=8&uo=2', '', 0),
(280, 'Mayo Clinic', 'https://itunes.apple.com/us/artist/mayo-clinic/id350350016?mt=8&uo=2', '', 0),
(281, 'BetterQOL.com', 'https://itunes.apple.com/us/artist/betterqol.com/id319801273?mt=8&uo=2', '', 0),
(282, 'Guardian Life Insurance Company of America', 'https://itunes.apple.com/us/artist/guardian-life-insurance-company/id532827052?mt=8&uo=2', '', 0),
(283, 'sanofi-aventis U.S. LLC', 'https://itunes.apple.com/us/artist/sanofi-aventis-u.s.-llc/id336651142?mt=8&uo=2', '', 0),
(284, 'Minute Apps LLC', 'https://itunes.apple.com/us/artist/minute-apps-llc/id380234190?mt=8&uo=2', '', 0),
(285, 'iMed Studios', 'https://itunes.apple.com/us/artist/imed-studios/id334452365?mt=8&uo=2', '', 0),
(286, 'smallnest, inc.', 'https://itunes.apple.com/us/artist/smallnest-inc./id491236388?mt=8&uo=2', '', 0),
(287, 'Dave Cheng', 'https://itunes.apple.com/us/artist/dave-cheng/id387308223?mt=8&uo=2', '', 0),
(288, 'Antimicrobial Therapy, Inc.', 'https://itunes.apple.com/us/artist/antimicrobial-therapy-inc./id443442554?mt=8&uo=2', '', 0),
(289, 'USMLEWorld, LLC', 'https://itunes.apple.com/us/artist/usmleworld-llc/id340946910?mt=8&uo=2', '', 0),
(290, 'eClinicalWorks', 'https://itunes.apple.com/us/artist/eclinicalworks/id542028798?mt=8&uo=2', '', 0),
(291, 'Group on Immunization Education of the Society of Teachers of Family Medicine', 'https://itunes.apple.com/us/artist/group-on-immunization-education/id386248110?mt=8&uo=2', '', 0),
(292, 'Simone Morellato', 'https://itunes.apple.com/us/artist/simone-morellato/id335493228?mt=8&uo=2', '', 0),
(293, 'National Council of the State Boards of Nursing', 'https://itunes.apple.com/us/artist/national-council-state-boards/id520154323?mt=8&uo=2', '', 0),
(294, 'eBroselow LLC', 'https://itunes.apple.com/us/artist/ebroselow-llc/id352867378?mt=8&uo=2', '', 0),
(295, 'Michele Ballard', 'https://itunes.apple.com/us/artist/michele-ballard/id327006162?mt=8&uo=2', '', 0),
(296, 'American College of Physicians', 'https://itunes.apple.com/us/artist/american-college-physicians/id371090673?mt=8&uo=2', '', 0),
(297, 'CareNow', 'https://itunes.apple.com/us/artist/carenow/id420372294?mt=8&uo=2', '', 0),
(298, 'Logical Images', 'https://itunes.apple.com/us/artist/logical-images/id348177524?mt=8&uo=2', '', 0),
(299, 'Michael Kale', 'https://itunes.apple.com/us/artist/michael-kale/id315692416?mt=8&uo=2', '', 0),
(300, 'Fingertip Formulary, Inc.', 'https://itunes.apple.com/us/artist/fingertip-formulary-inc./id390171036?mt=8&uo=2', '', 0),
(301, 'Memorial Sloan-Kettering Cancer Center', 'https://itunes.apple.com/us/artist/memorial-sloan-kettering-cancer/id554267165?mt=8&uo=2', '', 0),
(302, 'MyGreenz, LLC', 'https://itunes.apple.com/us/artist/mygreenz-llc/id443222912?mt=8&uo=2', '', 0),
(303, 'ThatsMyStapler Inc.', 'https://itunes.apple.com/us/artist/thatsmystapler-inc./id337472637?mt=8&uo=2', '', 0),
(304, 'Channel 4', 'https://itunes.apple.com/us/artist/channel-4/id385532930?mt=8&uo=2', '', 0),
(305, 'Vendormate, Inc.', 'https://itunes.apple.com/us/artist/vendormate-inc./id441759927?mt=8&uo=2', '', 0),
(306, 'Script Relief LLC', 'https://itunes.apple.com/us/artist/script-relief-llc/id595706554?mt=8&uo=2', '', 0),
(307, 'mobiStine', 'https://itunes.apple.com/us/artist/mobistine/id454063407?mt=8&uo=2', '', 0),
(308, 'Nicholas Clark', 'https://itunes.apple.com/us/artist/nicholas-clark/id577764719?mt=8&uo=2', '', 0),
(309, 'Remedica Medical Education and Publishing', 'https://itunes.apple.com/us/artist/remedica-medical-education/id388774153?mt=8&uo=2', '', 0),
(310, 'Idan Sheetrit', 'https://itunes.apple.com/us/artist/idan-sheetrit/id473431804?mt=8&uo=2', '', 0),
(311, 'yongming zhao', 'https://itunes.apple.com/us/artist/yongming-zhao/id585919766?mt=8&uo=2', '', 0),
(312, 'Therapeutic Research Center', 'https://itunes.apple.com/us/artist/therapeutic-research-center/id352389185?mt=8&uo=2', '', 0),
(313, 'AliveCor, Inc.', 'https://itunes.apple.com/us/artist/alivecor-inc./id546535893?mt=8&uo=2', '', 0),
(314, '3ight LLC', 'https://itunes.apple.com/us/artist/3ight-llc/id358084845?mt=8&uo=2', '', 0),
(315, 'M-3 Information, LLC', 'https://itunes.apple.com/us/artist/m-3-information-llc/id366238556?mt=8&uo=2', '', 0),
(316, 'gWhiz, LLC', 'https://itunes.apple.com/us/artist/gwhiz-llc/id286531712?mt=8&uo=2', '', 0),
(317, 'Allogy Interactive', 'https://itunes.apple.com/us/artist/allogy-interactive/id357433598?mt=8&uo=2', '', 0),
(318, 'jordan Lamberton', 'https://itunes.apple.com/us/artist/jordan-lamberton/id590365720?mt=8&uo=2', '', 0),
(319, 'OmniPress', 'https://itunes.apple.com/us/artist/omnipress/id548099124?mt=8&uo=2', '', 0),
(320, 'Deltaworks', 'https://itunes.apple.com/us/artist/deltaworks/id361115219?mt=8&uo=2', '', 0),
(321, 'Code 3 Apps', 'https://itunes.apple.com/us/artist/code-3-apps/id427516925?mt=8&uo=2', '', 0),
(322, 'American Academy of Family Physicians', 'https://itunes.apple.com/us/artist/american-academy-family-physicians/id427802126?mt=8&uo=2', '', 0),
(323, 'Yangwoo Park', 'https://itunes.apple.com/us/artist/yangwoo-park/id482889027?mt=8&uo=2', '', 0),
(324, 'Limmer Creative', 'https://itunes.apple.com/us/artist/limmer-creative/id387423724?mt=8&uo=2', '', 0),
(325, 'Ajay Vanumu', 'https://itunes.apple.com/us/artist/ajay-vanumu/id442713454?mt=8&uo=2', '', 0),
(326, 'Phonak', 'https://itunes.apple.com/us/artist/phonak/id621383955?mt=8&uo=2', '', 0),
(327, 'Mavro Inc', 'https://itunes.apple.com/us/artist/mavro-inc/id297917904?mt=8&uo=2', '', 0),
(328, 'USBMIS, Inc', 'https://itunes.apple.com/us/artist/usbmis-inc/id334077424?mt=8&uo=2', '', 0),
(329, 'SunshineApps GmbH', 'https://itunes.apple.com/us/artist/sunshineapps-gmbh/id332703888?mt=8&uo=2', '', 0),
(330, 'Weed Finder', 'https://itunes.apple.com/us/artist/weed-finder/id568965355?mt=8&uo=2', '', 0),
(331, 'Olson Applications Limited', 'https://itunes.apple.com/us/artist/olson-applications-limited/id362093407?mt=8&uo=2', '', 0),
(332, 'Crohn’s & Colitis Foundation of America (CCFA)', 'https://itunes.apple.com/us/artist/crohns-colitis-foundation/id579320418?mt=8&uo=2', '', 0),
(333, 'Andrew Yu', 'https://itunes.apple.com/us/artist/andrew-yu/id328693314?mt=8&uo=2', '', 0),
(334, 'Projects In Knowledge, Inc.', 'https://itunes.apple.com/us/artist/projects-in-knowledge-inc./id368515956?mt=8&uo=2', '', 0),
(335, 'christopher kim', 'https://itunes.apple.com/us/artist/christopher-kim/id576405452?mt=8&uo=2', '', 0),
(336, 'AIIR Consulting LLC', 'https://itunes.apple.com/us/artist/aiir-consulting-llc/id329954206?mt=8&uo=2', '', 0),
(337, 'Mobomo LLC', 'https://itunes.apple.com/us/artist/mobomo-llc/id318596178?mt=8&uo=2', '', 0),
(338, 'iTech Developers', 'https://itunes.apple.com/us/artist/itech-developers/id382627238?mt=8&uo=2', '', 0),
(339, 'J & H MedSoft Limited', 'https://itunes.apple.com/us/artist/j-h-medsoft-limited/id301558276?mt=8&uo=2', '', 0),
(340, 'Hesperian Health Guides', 'https://itunes.apple.com/us/artist/hesperian-health-guides/id496919738?mt=8&uo=2', '', 0),
(341, 'American Heart Association', 'https://itunes.apple.com/us/artist/american-heart-association/id441987817?mt=8&uo=2', '', 0),
(342, 'Joseph Fichera', 'https://itunes.apple.com/us/artist/joseph-fichera/id625676665?mt=8&uo=2', '', 0),
(343, 'American Thoracic Society Inc.', 'https://itunes.apple.com/us/artist/american-thoracic-society/id626126034?mt=8&uo=2', '', 0),
(344, 'Books of Discovery', 'https://itunes.apple.com/us/artist/books-of-discovery/id510119610?mt=8&uo=2', '', 0),
(345, 'MPL Enterprises', 'https://itunes.apple.com/us/artist/mpl-enterprises/id301052427?mt=8&uo=2', '', 0),
(346, 'arizonamedicalmarijuanacard.info', 'https://itunes.apple.com/us/artist/arizonamedicalmarijuanacard.info/id443355925?mt=8&uo=2', '', 0),
(347, 'LUMC Leiden', 'https://itunes.apple.com/us/artist/lumc-leiden/id534193927?mt=8&uo=2', '', 0),
(348, 'Laboratory Corporation of America® Holdings', 'https://itunes.apple.com/us/artist/laboratory-corporation-america/id401125609?mt=8&uo=2', '', 0),
(349, 'Damon Lynn', 'https://itunes.apple.com/us/artist/damon-lynn/id338627859?mt=8&uo=2', '', 0),
(350, 'Anupam Pathak', 'https://itunes.apple.com/us/artist/anupam-pathak/id580997557?mt=8&uo=2', '', 0),
(351, 'EBSCO Publishing', 'https://itunes.apple.com/us/artist/ebsco-publishing/id433269590?mt=8&uo=2', '', 0),
(352, 'Yi Ding', 'https://itunes.apple.com/us/artist/yi-ding/id580551898?mt=8&uo=2', '', 0),
(353, 'Computer Rx', 'https://itunes.apple.com/us/artist/computer-rx/id432194917?mt=8&uo=2', '', 0),
(354, 'International Guidelines Center', 'https://itunes.apple.com/us/artist/international-guidelines-center/id451486344?mt=8&uo=2', '', 0),
(355, 'Bass Jobsen', 'https://itunes.apple.com/us/artist/bass-jobsen/id454966781?mt=8&uo=2', '', 0),
(356, 'Robert Freeman, RN', 'https://itunes.apple.com/us/artist/robert-freeman-rn/id477632234?mt=8&uo=2', '', 0),
(357, 'NiteFloat, Inc.', 'https://itunes.apple.com/us/artist/nitefloat-inc./id355398883?mt=8&uo=2', '', 0),
(358, 'Archibald Industries', 'https://itunes.apple.com/us/artist/archibald-industries/id351524434?mt=8&uo=2', '', 0),
(359, 'Cookie Jar Development', 'https://itunes.apple.com/us/artist/cookie-jar-development/id496138296?mt=8&uo=2', '', 0),
(360, 'Shiv Verma', 'https://itunes.apple.com/us/artist/shiv-verma/id446631430?mt=8&uo=2', '', 0),
(361, 'SpotCheck Applications, Inc.', 'https://itunes.apple.com/us/artist/spotcheck-applications-inc./id455985443?mt=8&uo=2', '', 0),
(362, 'National Library of Medicine LHC', 'https://itunes.apple.com/us/artist/national-library-medicine/id544354430?mt=8&uo=2', '', 0),
(363, 'Imago LLC', 'https://itunes.apple.com/us/artist/imago-llc/id495860559?mt=8&uo=2', '', 0),
(364, 'Transaction Data Systems, Inc.', 'https://itunes.apple.com/us/artist/transaction-data-systems-inc./id464056079?mt=8&uo=2', '', 0),
(365, 'Imprivata, Inc.', 'https://itunes.apple.com/us/artist/imprivata-inc./id525559194?mt=8&uo=2', '', 0),
(366, 'Himanshu Tatariya', 'https://itunes.apple.com/us/artist/himanshu-tatariya/id577131052?mt=8&uo=2', '', 0),
(367, 'DrChrono.com Inc.', 'https://itunes.apple.com/us/artist/drchrono.com-inc./id363897226?mt=8&uo=2', '', 0),
(368, 'Novartis Consumer Health', 'https://itunes.apple.com/us/artist/novartis-consumer-health/id560516775?mt=8&uo=2', '', 0),
(369, 'TiAu Engineering UG (haftungsbeschränkt)', 'https://itunes.apple.com/us/artist/tiau-engineering-ug-haftungsbeschrankt/id384087141?mt=8&uo=2', '', 0),
(370, 'Sharp HealthCare', 'https://itunes.apple.com/us/artist/sharp-healthcare/id524389830?mt=8&uo=2', '', 0),
(371, 'Carolinas HealthCare System', 'https://itunes.apple.com/us/artist/carolinas-healthcare-system/id451927340?mt=8&uo=2', '', 0),
(372, 'Medpreps LLC', 'https://itunes.apple.com/us/artist/medpreps-llc/id537568868?mt=8&uo=2', '', 0),
(373, 'Abbott', 'https://itunes.apple.com/us/artist/abbott/id402314324?mt=8&uo=2', '', 0),
(374, 'Dr Bloggs Limited', 'https://itunes.apple.com/us/artist/dr-bloggs-limited/id444471397?mt=8&uo=2', '', 0),
(375, 'PEPID, LLC', 'https://itunes.apple.com/us/artist/pepid-llc/id306091996?mt=8&uo=2', '', 0),
(376, 'Glassenberg', 'https://itunes.apple.com/us/artist/glassenberg/id396637173?mt=8&uo=2', '', 0),
(377, 'BestApps', 'https://itunes.apple.com/us/artist/bestapps/id329677410?mt=8&uo=2', '', 0),
(378, 'Yodel Code', 'https://itunes.apple.com/us/artist/yodel-code/id300913140?mt=8&uo=2', '', 0),
(379, 'Gianluca Musumeci', 'https://itunes.apple.com/us/artist/gianluca-musumeci/id304095949?mt=8&uo=2', '', 0),
(380, 'puffbirds.tv', 'https://itunes.apple.com/us/artist/puffbirds.tv/id414277448?mt=8&uo=2', '', 0),
(381, 'Primal Pictures Ltd', 'https://itunes.apple.com/us/artist/primal-pictures-ltd/id347571839?mt=8&uo=2', '', 0),
(382, 'The University of Michigan', 'https://itunes.apple.com/us/artist/the-university-of-michigan/id380339599?mt=8&uo=2', '', 0),
(383, 'Stone Meadow Development LLC', 'https://itunes.apple.com/us/artist/stone-meadow-development-llc/id286506401?mt=8&uo=2', '', 0),
(384, 'Medical Apps', 'https://itunes.apple.com/us/artist/medical-apps/id403373933?mt=8&uo=2', '', 0),
(385, 'Cengage Learning', 'https://itunes.apple.com/us/artist/cengage-learning/id371168145?mt=8&uo=2', '', 0),
(386, 'American Medical Association', 'https://itunes.apple.com/us/artist/american-medical-association/id397241809?mt=8&uo=2', '', 0),
(387, 'Night Owl Apps', 'https://itunes.apple.com/us/artist/night-owl-apps/id452764395?mt=8&uo=2', '', 0),
(388, 'Chris Marcellino', 'https://itunes.apple.com/us/artist/chris-marcellino/id382383906?mt=8&uo=2', '', 0),
(389, 'LowestMed', 'https://itunes.apple.com/us/artist/lowestmed/id468593656?mt=8&uo=2', '', 0),
(390, 'Pixineers Inc.', 'https://itunes.apple.com/us/artist/pixineers-inc./id379400376?mt=8&uo=2', '', 0),
(391, 'SvmSoft.', 'https://itunes.apple.com/us/artist/svmsoft./id303601843?mt=8&uo=2', '', 0),
(392, 'Crescendo Bioscience, Inc.', 'https://itunes.apple.com/us/artist/crescendo-bioscience-inc./id563338982?mt=8&uo=2', '', 0),
(393, 'American Academy of Neurology', 'https://itunes.apple.com/us/artist/american-academy-neurology/id613178636?mt=8&uo=2', '', 0),
(394, 'Informed Publishing', 'https://itunes.apple.com/us/artist/informed-publishing/id351739093?mt=8&uo=2', '', 0),
(395, 'Modality Inc.', 'https://itunes.apple.com/us/artist/modality-inc./id281962104?mt=8&uo=2', '', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id`, `nom`, `prenom`, `sexe`, `date_naissance`, `photo_url`, `email`, `pays`, `device_id`, `cgu_valid`, `cgv_valid`, `est_pro`, `newsletter`) VALUES
(1, 'Berard', 'Nicolas', 'M', '1986-01-15', '', 'berard.nicolas@gmail.com', 'AR', 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `date_modification` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `page`
--

INSERT INTO `page` (`id`, `nom`, `contenu`, `date_modification`) VALUES
(1, 'page test', '<p>\r\n	<strong>Hello </strong><u>coucou </u><em>tralala</em></p>\r\n', '2013-03-26 19:00:31'),
(2, 'totofze', '', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `selection`
--

INSERT INTO `selection` (`id`, `nom`, `date_debut`, `date_fin`, `evennement`, `description`, `categorie_id`, `poids`) VALUES
(1, 'sélection 1', '2013-03-14 00:00:00', '2013-03-30 00:00:00', 1, '<p>\r\n	dsqdsq</p>\r\n', -1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `selection_application`
--

CREATE TABLE IF NOT EXISTS `selection_application` (
  `selection_id` smallint(10) NOT NULL,
  `application_id` int(10) NOT NULL,
  UNIQUE KEY `selection_id` (`selection_id`,`application_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `selection_application`
--

INSERT INTO `selection_application` (`selection_id`, `application_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `spool_crawl_application`
--

CREATE TABLE IF NOT EXISTS `spool_crawl_application` (
  `package` varchar(256) NOT NULL,
  `device_id` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `spool_crawl_application`
--

INSERT INTO `spool_crawl_application` (`package`, `device_id`, `status`) VALUES
('com.guillaumegranger.mc.key', 2, 0),
('com.iSOS', 2, 0),
('com.tremend.respiroguide', 2, 0),
('com.ammobile.acupressure', 2, 0),
('com.pierrerobinsondebut.constantes', 2, 0),
('com.palmisphere.iGrossesse', 2, 0),
('com.appventive.ice', 2, 0),
('org.bicou.grossessepaid', 2, 0),
('com.agents.pansement', 2, 0),
('com.insyncapp.homeobaby', 2, 0),
('fr.app.morph.mapilule', 2, 0),
('com.argosy.vbandroid', 2, 0),
('com.urgencepratique', 2, 0),
('fr.elevate.ipansement', 2, 0),
('com.hssn.anatomy', 2, 0),
('com.emourgues.ketusoftware.homeopathie', 2, 0),
('com.hachette.homeopathie', 2, 0),
('com.scoresbmp.AudidierE', 2, 0),
('com.baviux.pillreminderwidget', 2, 0),
('com.mh.urgences1clic', 2, 0),
('fr.resip.fu.bcbdexther', 2, 0),
('com.sly.pharmacis', 2, 0),
('com.delayr.diary', 2, 0),
('com.unbound.android.ubfd', 2, 0),
('com.real.bodywork.muscle.trigger.points', 2, 0),
('com.GoodwillEnterpriseDevelopment.AnatronicaPro', 2, 0),
('com.alexyu.android.iceplus', 2, 0),
('com.bessiambre.speedBones', 2, 0),
('com.hp.pregnancy', 2, 0),
('com.matrix.emergency', 2, 0),
('air.Concours.Infirmier', 2, 0),
('air.com.dyteq.medicawoordenboekFR', 2, 0),
('com.lanthier', 2, 0),
('com.wr.acurhythm.proplugin', 2, 0),
('com.bessiambre.speedMuscles', 2, 0),
('fr.ibou.agginet', 2, 0),
('com.VetApps.VetCalcPlus', 2, 0),
('mcECN.cethyworks.com', 2, 0),
('com.androiddevelopermx.blogspot.bone', 2, 0),
('com.bessiambre.speedAngiology', 2, 0),
('com.mobisystems.msdict.embedded.wireless.elsevier.dorlandsmedical.full', 2, 0),
('com.whisperarts.kids.breastfeeding.key', 2, 0),
('com.thermodoc.feveralert', 2, 0),
('com.thedoctorsays.predicktor', 2, 0),
('com.whichman.calculators.medicalc', 2, 0),
('com.leadingedgeapps.ibp', 2, 0),
('org.pedisafe', 2, 0),
('nl.bsl.pinkhof', 2, 0),
('com.tapouillo.lapilule', 2, 0),
('fr.nghs.android.cbs.enhancer', 2, 0),
('com.colakey.K21.chimed', 2, 0),
('sagemilk.com.medical.anatomy.spanish', 2, 0),
('air.CultureG', 2, 0),
('air.com.drugsoft.Drug.interactions.Android.FR', 2, 0),
('com.qxmd.ecgguide', 2, 0),
('simo.mycure', 2, 0),
('com.hssn.muscle', 2, 0),
('com.irtza.abginterpreterpro', 2, 0),
('com.usbmis.reader.gant', 2, 0),
('com.siyami.apps.antwo', 2, 0),
('com.sleeping', 2, 0),
('com.odysys.dicomedical', 2, 0),
('com.hssn.bone', 2, 0),
('com.androidappheads.medclock', 2, 0),
('nl.pluut.zakkaartjes', 2, 0),
('com.planquart.insulinecalcul', 2, 0),
('air.TESTS.APTITUDE', 2, 0),
('com.infectioguide2013', 2, 0),
('net.webpatient.KegelExercises', 2, 0),
('com.fjbelchi.glucosemeter2', 2, 0),
('fr.resip.scanpharma', 2, 0),
('com.siyami.apps.prtwo', 2, 0),
('com.app.easyweightloss', 2, 0),
('com.dml.biohazard.green', 2, 0),
('com.artefactsoft.daf', 2, 0),
('com.ammobile.anatomyquiz', 2, 0),
('com.mediquations.mediquations', 2, 0),
('com.qxmd.pedistat', 2, 0),
('com.whodunnit.medicalphysics.dosecalculator', 2, 0),
('com.antisnorepro', 2, 0),
('it.bropatapps.PillReminder', 2, 0),
('com.medplusapps.pocketlabvalues', 2, 0),
('com.luckyxmobile.babycareplus', 2, 0),
('org.felixsoftware.boluswizard.pro', 2, 0),
('com.gynobst', 2, 0),
('com.hiyh.scoliotrack', 2, 0),
('com.garland.medminder', 2, 0),
('org.sympto.android.sympto', 2, 0),
('air.com.bluetreepublishing.soundID', 2, 0),
('com.dml.firefighter', 2, 0),
('com.intimity', 2, 0),
('com.instamedic.dermatomes', 2, 0),
('air.com.bebeosante.bebeosante', 2, 0),
('com.akalom.dtmf', 2, 0),
('com.glen.apps.maternity', 2, 0),
('com.avivonet.medcalc', 2, 0),
('com.skyscape.packagenetteranfivektwokgdata.android.voucher.ui', 2, 0),
('com.unbound.android.cqdz', 2, 0),
('es.ida.babynotebook', 2, 0),
('com.mobilehealth.cardiac', 2, 0),
('com.ldf.grossesse.view', 2, 0),
('com.mobicrea.vidal', 2, 0),
('com.guillaumegranger.mc', 2, 0),
('com.insyncapp.guidehomeo', 2, 0),
('com.speedAnatomy.speedAnatomyLite', 2, 0),
('com.tkm.crf', 2, 0),
('com.capinformatique.cappharma', 2, 0),
('org.bicou.grossesse', 2, 0),
('pregnancyMy.res', 2, 0),
('ciginfo.iGrossesse', 2, 0),
('com.jsolutionssp.pill', 2, 0),
('com.szyk.myheart', 2, 0),
('com.sbs.enceinte', 2, 0),
('com.TruApps.antimosquito', 2, 0),
('com.hp.pregnancy.lite', 2, 0),
('com.hssn.anatomyfree', 2, 0),
('free.wk.mybodymass', 2, 0),
('com.entreprise.homeo', 2, 0),
('com.luckyxmobile.babycare', 2, 0),
('com.pocketbooster.smartfiches.cardiologie.free', 2, 0),
('com.remind4u2.sounds.of.rain', 2, 0),
('com.baviux.pillreminder', 2, 0),
('com.dopamine.HelpIDE', 2, 0),
('com.thepandasteam.criteresdiagnostiques', 2, 0),
('com.tsavo.amipregnant', 2, 0),
('eu.ipix.NativeMedAbbrevFR', 2, 0),
('com.mostafiz.ovulation', 2, 0),
('com.pharmagest.application', 2, 0),
('com.chloro.hartmannpansements', 2, 0),
('mon.calculateur.menstruel', 2, 0),
('com.remind4u2.sounds.of.ocean', 2, 0),
('com.pocketbooster.smartfiches.orthopedie.free', 2, 0),
('mss.micromega.pmignard.medicalcul', 2, 0),
('surebaby.pregnancy.calculator', 2, 0),
('com.mobilehealth.Infirmiers', 2, 0),
('com.doctoralia', 2, 0),
('com.androiddevelopermx.blogspot.bonefree', 2, 0),
('fr.resip.free.version.bcbdexther', 2, 0),
('com.palmisphere.iGrossesseAdBB', 2, 0),
('com.mixmezcla.repelente', 2, 0),
('ch.schacherinformatik.pillreminder', 2, 0),
('com.cherryCode.daltonismo', 2, 0),
('com.assistech.monpharmacien', 2, 0),
('com.emc.activity', 2, 0),
('pl.extremedia.diagnozer', 2, 0),
('com.androiddevelopermx.blogspot.muscle', 2, 0),
('com.universpharmacie.homeo', 2, 0),
('com.gep.controller', 2, 0),
('com.aitype.android.theme.ezreader', 2, 0),
('net.imaios.eanatomy', 2, 0),
('com.pocketbooster.smartfiches.hge.free', 2, 0),
('com.hrfy', 2, 0),
('com.pocketbooster.smartfiches.orl.free', 2, 0),
('com.alexyu.android.ice', 2, 0),
('com.antisnore', 2, 0),
('com.szyk.diabetes', 2, 0),
('com.indhay.menstrualcalendar', 2, 0),
('com.mystic.center.meditation2.radio', 2, 0),
('com.whisperarts.kids.breastfeeding', 2, 0),
('quizAnatomy.res', 2, 0),
('com.pocketbooster.smartfiches.hds.free', 2, 0),
('fr.albus.albusmobile', 2, 0),
('com.pocketbooster.smartfiches.ophtalmologie.free', 2, 0),
('com.wolterskluwer.espaceinfirmier', 2, 0),
('com.GoodwillEnterpriseDevelopment.Anatronica', 2, 0),
('com.siu.android.dondusang', 2, 0),
('com.tobeamaster.mypillbox', 2, 0),
('com.agfa', 2, 0),
('com.remind4u2.sounds.babies.bedtime.lullaby', 2, 0),
('com.examobile.bubblewrap', 2, 0),
('com.Netter', 2, 0),
('com.palmisphere.iGrossesseNBB', 2, 0),
('com.youdroid.bmi', 2, 0),
('si.matejpikovnik.menstrual', 2, 0),
('net.feathertech.pregnancystages', 2, 0),
('com.modiface.virtualdentist', 2, 0),
('com.myprograms.glasgow', 2, 0),
('com.shahlab.anesthesiologist', 2, 0),
('com.goomeoevents.jnlf', 2, 0),
('com.vone.annonces.medicales', 2, 0),
('com.ircad.VisiblePatient.full', 2, 0),
('net.epsilonzero.hearingtest', 2, 0),
('com.qxmd.calculate', 2, 0),
('com.diablo.dentistpro', 2, 0),
('air.com.bebesante.bebesantelight', 2, 0),
('com.mediamatis.android.IMediaSante', 2, 0),
('com.fullcool.sexsounds', 2, 0),
('PsiquiatriaFree.Doctor', 2, 0),
('com.epsilog.vega', 2, 0),
('com.cogipix.fichedesincarceration', 2, 0),
('com.ianhanniballake.contractiontimer', 2, 0),
('com.skill.manHypnosisLiveWallpaper', 2, 0),
('droid.pr.emergencytoolsfree', 2, 0),
('DOCECG2.doctor', 2, 0),
('bb.CalculImc', 2, 0),
('com.guerriatj.cigarette', 2, 0),
('com.systeme.polaire', 2, 0),
('fr.resip.free.scanpharma', 2, 0),
('com.pregnancy.android', 2, 0),
('com.delayr.diary.lite', 2, 0),
('com.sleepinglite', 2, 0),
('com.babyplaning', 2, 0),
('com.sidiary.app', 2, 0),
('com.medscape.android', 2, 0),
('com.weedseedss', 2, 0),
('com.developica.contracker', 2, 0),
('com.bim.pubmed', 2, 0),
('pub.med', 2, 0),
('com.focusmedica.essentail.atlas', 2, 0),
('com.wolterskluwer.wkpharma', 2, 0),
('com.zodinplex.river.sounds.relax.and.sleep', 2, 0),
('com.phonegap.getpregnant', 2, 0),
('com.ecare.ovulationcalculator', 2, 0),
('com.alk.allergik', 2, 0),
('fr.appsolute.prepECN', 2, 0),
('org.tonee.teeth', 2, 0),
('air.rogeh', 2, 0),
('grk.scorespediatria', 2, 0),
('inutilsoft.ColorBlindnessTest', 2, 0),
('hot.nurses61', 2, 0),
('es.copanonga.glasgowfree', 2, 0),
('com.freshware.dbees', 2, 0),
('com.planquart.insulinecalculfree', 2, 0),
('com.clusor.ice', 2, 0),
('com.zodinplex.forest.sounds.relax.and.sleep', 2, 0),
('com.max.Anatomy', 2, 0),
('com.diablo.psychiatry', 2, 0),
('com.duoapps.android.actukine', 2, 0),
('com.ubm.politimobile.free', 2, 0),
('com.gexperts.ontrack', 2, 0),
('com.pt.antimosquito', 2, 0),
('com.dm3photo52', 2, 0),
('mobi.thinkchange.android.qrcode', 2, 0),
('women.hairstyles.darwin', 2, 0),
('com.sam.results', 2, 0),
('com.dmhealth1', 2, 0),
('com.toone.allcallSounds', 2, 0),
('com.er.antimosquito', 2, 0),
('com.skill.manSperm', 2, 0),
('an.HeartX', 2, 0),
('com.ecare.menstrualdiary', 2, 0),
('com.zodinplex.thunder.sounds.relax.and.sleep', 2, 0),
('com.hawahome.roqya', 2, 0),
('plants.com', 2, 0),
('it.bropatapps.PillReminderLite', 2, 0),
('com.cokroftmdrd', 2, 0),
('com.odysys.netterquiz', 2, 0),
('org.fruct.yar.bloodpressurediary', 2, 0),
('lu.midori.reagis', 2, 0),
('com.dungelin.heartrate', 2, 0),
('com.konnect.epa2013', 2, 0),
('com.shahlab.opioidconverter', 2, 0),
('com.source.pilulier', 2, 0),
('com.lab78.BabySootherSEALFree', 2, 0),
('org.sympto.android.symptofree', 2, 0),
('fr.aphp.mobile.android', 2, 0),
('com.oliseo.vaccins', 2, 0),
('dk.appbusters.android.BloodGasHandbook', 2, 0),
('com.myprograms.dopamine', 2, 0),
('com.lamire.inserm', 2, 0),
('com.thcfinder.dispensary.screen', 2, 0),
('com.a8100976750f7fecbef5f97a.a77445456a', 2, 0),
('pharmacie.faida.com', 2, 0),
('com.synox.vygon', 2, 0),
('fr.a2zi.leguidesante', 2, 0),
('org.bowapp.android.diabeteslogfree', 2, 0),
('cz.alfamedimedia.bonapill', 2, 0),
('air.AnatomyStarBrain', 2, 0),
('com.heliceum.oncobook', 2, 0),
('fr.nghs.android.cbs', 2, 0),
('fr.matelli.protocole', 2, 0),
('com.softetic.bap.free', 2, 0),
('com.usa.health.ifitness.firstaid', 2, 0),
('com.epocrates', 2, 0),
('Pedcall.Calculator', 2, 0),
('com.froggyware.froggysnooze.lite', 2, 0),
('com.jsolutionssp.ring', 2, 0),
('GinecologiaFree.Doctor', 2, 0),
('air.com.mondeinfirmier.memoplaie', 2, 0),
('fr.microconcept.android.equinox', 2, 0),
('eu.ipix.NativeMedAbbrevEN', 2, 0),
('com.smartinmedia.smartHistologyLite', 2, 0),
('com.focusmedica.jaaenglish', 2, 0),
('es.copanonga.filtrado.glomerular.free', 2, 0),
('com.focusmedica.md.cardiology', 2, 0),
('com.noldar.paramedic.quebec', 2, 0),
('com.tsa', 2, 0),
('com.phonegap.biomnis', 2, 0),
('fr.melody.stallergene.allergytrack', 2, 0),
('air.com.littleboydesign.A2012pro', 2, 0),
('com.ircad.VisiblePatientLite', 2, 0),
('blackdroid.anatomy', 2, 0),
('fr.sylvain.maucourt.babyonboard', 2, 0),
('com.zephir.activity', 2, 0),
('it.parisi.heartsounds', 2, 0),
('com.cannapediaapps.cannapedia', 2, 0),
('com.earthflare.android.medhelper.lite', 2, 0),
('com.foracare.ifora', 2, 0),
('alessandro.it.cardio', 2, 0),
('com.mycompany.medallight', 2, 0),
('com.proGen', 2, 0),
('com.solwarelife.easytab.ethome', 2, 0),
('com.drchernj.four', 2, 0),
('com.celuga.lamedicale', 2, 0),
('com.rimel.glasgownowfree', 2, 0),
('com.heliceum.lymphome', 2, 0),
('air.Glasgow', 2, 0),
('air.com.littleboydesign.ronquidos', 2, 0),
('com.skyscape.android.ui', 2, 0),
('an.DentalEbook', 2, 0),
('com.youdroid.bmi.legacy', 2, 0),
('com.milibris.standalone.app.revuedupraticien', 2, 0),
('an.InternalEbook', 2, 0),
('com.diab.test', 2, 0),
('com.skyhealth.glucosebuddyfree', 2, 0),
('ru.neurosoft.psmobile', 2, 0),
('an.NurseBook', 2, 0),
('fontes.trial.horadoremedio', 2, 0),
('com.socratica.mobile.bones', 2, 0),
('com.appsvision.dermatologuepeauxnoire', 2, 0),
('com.zodinplex.jungle.sounds.relax.and.sleep', 2, 0),
('net.feathertech.eyeexercises', 2, 0),
('com.ecare.android.womenhealthdiary', 2, 0),
('mobi.vetfinder', 2, 0),
('com.abimed.ecg', 2, 0),
('an.BMI', 2, 0),
('com.glucatrends.android.activities', 2, 0),
('com.medicaljoyworks.prognosis', 2, 0),
('com.wolterskluwer.wkvet', 2, 0),
('com.phonegap.EntorseBenigne', 2, 0),
('com.sigmaphone.topmedfree', 2, 0),
('com.ispiron.visioncheckup', 2, 0),
('com.dmhealth2', 2, 0),
('oucare.ou8001an', 2, 0),
('com.cardioneurology.af', 2, 0),
('com.toone.amxw', 2, 0),
('NadSoft.CleanNoiseFREE', 2, 0),
('com.squaremed.diabetesplus.typ1', 2, 0),
('an.MedEbook', 2, 0),
('com.appsvision.dermatologueesth', 2, 0),
('com.uqu.ophthalmology', 2, 0),
('com.unbound.android.cqhm', 2, 0),
('com.icare.visiontestapp', 2, 0),
('net.klier.bmi2free', 2, 0),
('mindex.med', 2, 0),
('com.goomeoevents.bestofvet', 2, 0),
('org.homphysiology.neuroslice', 2, 0),
('ch.pezz.pg01', 2, 0),
('com.diablo.clinicalhistory', 2, 0),
('com.dmhealth3', 2, 0),
('ROM.goniometry', 2, 0),
('com.afamici', 2, 0),
('com.focusmedica.md.ophthalmology', 2, 0),
('com.medcom.abstractvet', 2, 0),
('com.revuemedicament', 2, 0),
('fr.supralog.topaze', 2, 0),
('com.medicaljoyworks.prognosis.cardiology', 2, 0),
('com.agmmultimedia.oncoscale', 2, 0),
('com.liftlabsdesign.liftpulse', 2, 0),
('ch.heigvd.iict.muchacha.anatomicalimagesgame', 2, 0),
('com.myprograms.nihss', 2, 0),
('net.instantanatomy.ankle', 2, 0),
('fr.omnicia.secourslite', 2, 0),
('com.irtza.pulmtools', 2, 0),
('af.org.aofoundation.AOSR', 2, 0),
('com.ipcrea.synergie', 2, 0),
('com.ashwin.apnea', 2, 0),
('an.AnatomyEbook', 2, 0),
('com.dmphoto29', 2, 0),
('rib.hump', 2, 0),
('cruzi.android', 2, 0),
('com.steptoapps.content.haircare', 2, 0),
('com.eventpilot.aacr13', 2, 0),
('com.appbuilder.u33189p115487', 2, 0),
('com.czajnik.bmicalculator', 2, 0),
('com.clinical.quicklabreference', 2, 0),
('com.eziktek.sekerolcumappwifi', 2, 0),
('de.gerfeldersoftware.headachediary', 2, 0),
('bif.widgetFA', 2, 0),
('com.focusmedica.md.hematology', 2, 0),
('health.body.exercise.m', 2, 0),
('com.consilienthealth.pillreminder.android', 2, 0),
('com.VetApps.VetCalc', 2, 0),
('com.ls.soundamplifier', 2, 0),
('com.doctor.radiog', 2, 0),
('com.iDoc24', 2, 0),
('com.wonggordon.bgmonitor', 2, 0),
('org.altervista.Glyconverter', 2, 0),
('com.freerange360.mpp.uog', 2, 0),
('com.quartertone.medcalc.obwheel', 2, 0),
('com.biologycalculator', 2, 0),
('an.PodEbook', 2, 0),
('com.sunsetapps.ChecklistUrgenceFR', 2, 0),
('com.focusmedica.md.dermatology', 2, 0),
('com.thomson.druginfo', 2, 0),
('com.mobisystems.msdict.embedded.wireless.elsevier.paa', 2, 0),
('com.appcom.sydneyohana', 2, 0),
('an.VetmedBook', 2, 0),
('com.CLB.OncogeriatrieG8', 2, 0),
('com.altibbi.directory', 2, 0),
('com.hrfy.immunityboosters', 2, 0),
('com.milibris.standalone.app.concoursmedical', 2, 0),
('es.copanonga.apgar', 2, 0),
('com.sheridan.ash', 2, 0),
('com.hiddenbrains.dispensary.screen', 2, 0),
('com.anatomyskeletalsystem.rays', 2, 0),
('com.FertiLog', 2, 0),
('com.revsoft.doctormole', 2, 0),
('com.lcs.mmp.lite', 2, 0),
('com.rekesh.cardio3.free', 2, 0),
('appsingularity.pillsonthegofree', 2, 0),
('com.jonsap.ivinfusioncalc', 2, 0),
('com.heva.android.t2a2012', 2, 0),
('your.BlutdruckMonitoring', 2, 0),
('com.barcelonamedia.lv2.CarriereSystem', 2, 0),
('com.mobisystems.msdict.embedded.wireless.elsevier.muscularsystem', 2, 0),
('com.wr.acurhythm', 2, 0),
('edu.mcg.android.dentistryproceduresconsult', 2, 0),
('com.vigimedis.cutanet', 2, 0),
('Dardiries.HAMD.HAMD17', 2, 0),
('com.appcolliders.doctordiagnose', 2, 0),
('ro.raduturcas.facetrackingexample', 2, 0),
('com.rekesh.cardio3.invasive', 2, 0),
('com.unbound.android.medl', 2, 0),
('org.percentiles', 2, 0),
('com.steptoapps.content.skincare', 2, 0),
('gov.nih.nlm.sis.lactmed', 2, 0),
('net.instantanatomy.heart', 2, 0),
('com.antadir.dblocsard', 2, 0),
('com.mobisystems.msdict.embedded.wireless.mcgrawhill.cmdt2013', 2, 0),
('an.HealthCalc', 2, 0),
('altibbi.symptom.checker', 2, 0),
('com.jto.grays', 2, 0),
('com.drchernj.echocardiography', 2, 0),
('com.mycompany.medgfrlight', 2, 0),
('an.MedicalEbooks', 2, 0),
('com.sekos.dosagecalc', 2, 0),
('com.obstetriclight', 2, 0),
('no.gih.urimicro', 2, 0),
('nz.co.ljholmes73', 2, 0),
('ReumatologiaFree.Doctor', 2, 0),
('fr.eugena', 2, 0),
('com.sccm.guidelines', 2, 0),
('com.remind4u2.office.workout.exercises', 2, 0),
('com.rekesh.cardio3.echo3D', 2, 0),
('independent.android.medicine.heartsounds', 2, 0),
('com.appbuilder.u65301p140052', 2, 0),
('com.ge.centricitymobile', 2, 0),
('ee.girf.walter.android', 2, 0),
('com.focusmedica.md.neurologyandpsychiatry', 2, 0),
('com.a1373617662501724610f5f65a.a55440909a', 2, 0),
('com.isolutionsmobiles.radeos', 2, 0),
('com.focusmedica.jaaspanish', 2, 0),
('com.focusmedica.md.medicalhealthdictionary', 2, 0),
('com.incollables.residanat', 2, 0),
('com.earlybirdsoftware.contractiontimer', 2, 0),
('home.activity', 2, 0),
('com.jeschuaschang.diabetesdiary', 2, 0),
('com.thomasperraudin.cockroft', 2, 0),
('it.bropatapps.PillReminder.Themes.Black', 2, 0),
('org.nkf.calculators', 2, 0),
('com.medicaljoyworks.prognosis.diabetes', 2, 0),
('uk.co.pocketapp.pocketdoctor.lite', 2, 0),
('men.hairstyles.darwin', 2, 0),
('com.mobisystems.msdict.embedded.wireless.elsevier.dorlandsillustrated', 2, 0),
('TraumatologiaFree.Doctor', 2, 0),
('medication.clock', 2, 0),
('com.cellavision.cellatlas', 2, 0),
('com.winterchery.apps.ayurcare.activity', 2, 0),
('com.snorlax', 2, 0),
('com.ringful.avidnurse', 2, 0),
('handbookDrugs.res', 2, 0),
('com.mobisystems.msdict.embedded.wireless.mcgrawhill.handbookofpediatrics', 2, 0),
('www.tgw.net.abisonline', 2, 0),
('standard.android.app.BabyApps', 2, 0),
('com.CloudNineDevelopement.EyeHandbook', 2, 0),
('com.consulog.almapro', 2, 0),
('com.egoclean.amipregnant', 2, 0),
('com.genetics4m', 2, 0),
('za.co.leegeertshuis.gpac', 2, 0),
('com.dummies.android.osteopathe', 2, 0),
('com.mobily.diabetestest', 2, 0),
('ru.lopotun.android.laborContractionsCalc', 2, 0),
('jp.hideki.diabeteslite', 2, 0),
('an.NatmedBook', 2, 0),
('com.appquartz.mediel', 2, 0),
('com.appsmentor.healthadivsor', 2, 0),
('mobi.dotit.dotmedical', 2, 0),
('co.uk.devjet.biochem', 2, 0),
('com.Nervewhiz', 2, 0),
('com.socialbraingymlite', 2, 0),
('com.wolterskluwer.editionscdp', 2, 0),
('org.epstudios.epmobile', 2, 0),
('siriade1.jeb.com', 2, 0),
('kr.co.soulring.h2o', 2, 0),
('com.appyzz.android.esmo', 2, 0),
('com.auscultation', 2, 0),
('com.hippoandfriends.helpdiabetes', 2, 0),
('com.rememberme', 2, 0),
('eu.ipix.LexMedEN', 2, 0),
('it.visiant.farmacia.turno', 2, 0),
('rateInfusion.res', 2, 0),
('com.sigmaphone.orangebookfree', 2, 0),
('com.iphonedroid.vademecum.mobile2', 2, 0),
('com.lexi.android', 2, 0),
('com.ubm.pt.app.clinicalscalesv2', 2, 0),
('com.jensu.AlertorwithMe', 2, 0),
('com.sanofi.fr.diabeo', 2, 0),
('com.smartmedicalapps.checklist', 2, 0),
('com.mobileapploader.aid218220', 2, 0),
('lam.momsapps.fetalultrasound', 2, 0),
('com.stepic.ess', 2, 0),
('ilq.jeb.com', 2, 0),
('org.aofoundation.traumaline', 2, 0),
('com.asteria.PharmaGuide', 2, 0),
('net.klier.blutdruck', 2, 0),
('alzariane.filharmonie', 2, 0),
('com.goomeoevents.medtecfr', 2, 0),
('jeb.siriade4.com', 2, 0),
('com.librotecstar.plantas.AOTUZCBHNVPBUHGW', 2, 0),
('paratv.wallpaper.Ladybug', 2, 0),
('com.hssn.anaquizlite', 2, 0),
('com.mobisystems.msdict.embedded.wireless.elsevier.dorlandsmedical', 2, 0),
('com.esd.drugsdictionary', 2, 0),
('com.medimagingcase', 2, 0),
('com.socialdiabetes.android', 2, 0),
('com.freshware.bpresso', 2, 0),
('com.myprograms.barthel', 2, 0),
('al.burbulis.julius.diabetical', 2, 0),
('com.siderakis.heartrate', 2, 0),
('com.mubaloo.android.emed.hiv', 2, 0),
('com.lcsm.horizonhemato', 2, 0),
('com.graphilos.babylog', 2, 0),
('com.pediatric.ecgtrial', 2, 0),
('com.ani.apps.phobia.names', 2, 0),
('com.appliphone.ritchaardsante', 2, 0),
('com.mobisystems.msdict.embedded.wireless.mcgrawhill.ems', 2, 0),
('com.optraandroid.pregnancycalculator', 2, 0),
('com.cookiejardevelopment.emsguidebook', 2, 0),
('com.suderman.pillpopper', 2, 0),
('com.publicishealthware.pm.glossario', 2, 0),
('com.it4u.virtualatlas.android.client', 2, 0),
('com.eziktek.sekerappv3', 2, 0),
('com.mozinc.experiencepeace', 2, 0),
('nl.partout.allerfre', 2, 0),
('com.nice.android', 2, 0),
('org.bsava.formulary', 2, 0),
('com.cco.android.inpractice.oncology', 2, 0),
('com.mozinc.astralserenity', 2, 0),
('com.capr.rc.gratis', 2, 0),
('com.a22neko.dtadn', 2, 0),
('com.leolandau.YogaNidraFree', 2, 0),
('com.envisionmobile.hc1505', 2, 0),
('com.libroscience.www.ctmri.light', 2, 0),
('rxkinetics.abpk', 2, 0),
('an.PharmEbook', 2, 0),
('atclic.android.en.babycounter.free', 2, 0),
('com.alemocni.cml.zhongchuntang', 2, 0),
('com.MedecineTraditionnelChinoiseMarseille', 2, 0),
('com.duoapps.android.echoloco', 2, 0),
('com.anna.sent.soft.childbirthdate', 2, 0),
('com.goomeoevents.pharmapack', 2, 0),
('com.matt.android.apps.psych', 2, 0),
('com.apps.parkinsons', 2, 0),
('net.ipix.disposix.icd', 2, 0),
('it.newsigndesign.acucyclelt', 2, 0),
('org.tsing.prescription', 2, 0),
('org.escardio.esc2012', 2, 0),
('fr.intuitiv.traumatosport', 2, 0),
('com.esd.diseasedictionary', 2, 0),
('me.ldp', 2, 0),
('com.marcelopazzo.android.glasgow', 2, 0),
('au.com.myphysioapp', 2, 0),
('br.com.domm.meld', 2, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
