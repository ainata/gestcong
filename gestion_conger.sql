-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Jeu 08 Décembre 2016 à 12:33
-- Version du serveur: 5.5.8
-- Version de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `gestion_conger`
--

-- --------------------------------------------------------

--
-- Structure de la table `avoirdroit`
--

CREATE TABLE IF NOT EXISTS `avoirdroit` (
  `ID_MOIS` bigint(4) NOT NULL,
  `ID_CONTRAT` bigint(4) NOT NULL,
  PRIMARY KEY (`ID_MOIS`,`ID_CONTRAT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `avoirdroit`
--


-- --------------------------------------------------------

--
-- Structure de la table `avoirdroit2`
--

CREATE TABLE IF NOT EXISTS `avoirdroit2` (
  `ID_ANNEE` bigint(4) NOT NULL,
  `ID_CONTRAT` bigint(4) NOT NULL,
  PRIMARY KEY (`ID_ANNEE`,`ID_CONTRAT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `avoirdroit2`
--


-- --------------------------------------------------------

--
-- Structure de la table `conger_annee`
--

CREATE TABLE IF NOT EXISTS `conger_annee` (
  `ID_ANNEE` bigint(4) NOT NULL,
  `ANNEE` varchar(128) DEFAULT NULL,
  `NOMBRE_DU_JOUR` double(5,1) DEFAULT NULL,
  PRIMARY KEY (`ID_ANNEE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `conger_annee`
--


-- --------------------------------------------------------

--
-- Structure de la table `conger_du_mois`
--

CREATE TABLE IF NOT EXISTS `conger_du_mois` (
  `ID_MOIS` bigint(4) NOT NULL,
  `NOMBRE_DU_JOUR` double(5,1) DEFAULT NULL,
  `MOIS` varchar(128) DEFAULT NULL,
  `APROPOS` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_MOIS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `conger_du_mois`
--

INSERT INTO `conger_du_mois` (`ID_MOIS`, `NOMBRE_DU_JOUR`, `MOIS`, `APROPOS`) VALUES
(1, 2.5, 'Janvier', ''),
(2, 2.5, 'Fevrier', ''),
(3, 2.5, 'Mars', ''),
(4, 2.5, 'Avril', ''),
(5, 2.5, 'May', ''),
(6, 2.5, 'Juin', ''),
(7, 2.5, 'Jullet', ''),
(8, 2.5, 'Aout', ''),
(9, 2.5, 'Septembre', ''),
(10, 2.5, 'Octobre', ''),
(11, 2.5, 'Novembre', ''),
(12, 2.5, 'Decembre', '');

-- --------------------------------------------------------

--
-- Structure de la table `demande_annulation`
--

CREATE TABLE IF NOT EXISTS `demande_annulation` (
  `ID_DEMANDE_ANNULATION` bigint(4) NOT NULL,
  `ID_DEPOSITION` bigint(4) DEFAULT NULL,
  `DATE_ANNULATION` date DEFAULT NULL,
  PRIMARY KEY (`ID_DEMANDE_ANNULATION`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `demande_annulation`
--


-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE IF NOT EXISTS `departement` (
  `ID_DEPARTEMENT` bigint(4) NOT NULL AUTO_INCREMENT,
  `ID_EMPLOYER` bigint(4) NOT NULL,
  `NOM_DEPARTEMENT` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_DEPARTEMENT`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `departement`
--

INSERT INTO `departement` (`ID_DEPARTEMENT`, `ID_EMPLOYER`, `NOM_DEPARTEMENT`) VALUES
(1, 1, 'SEE EED'),
(2, 2, 'Customization & Quality'),
(3, 3, 'Marketing & Communication'),
(4, 6, 'Administration'),
(5, 7, 'Responsable du site'),
(6, 0, 'Temporaire');

-- --------------------------------------------------------

--
-- Structure de la table `deposition`
--

CREATE TABLE IF NOT EXISTS `deposition` (
  `ID_DEPOSITION` bigint(4) NOT NULL AUTO_INCREMENT,
  `ID_MOTIF` bigint(4) NOT NULL,
  `ID_EMPLOYER` bigint(4) NOT NULL,
  `DATE_DE_DEMANDE` date DEFAULT NULL,
  `DATE_DEPART` date DEFAULT NULL,
  `JOURNE_DE_DEPART` varchar(20) NOT NULL,
  `DATE_RETOUR` date DEFAULT NULL,
  `RENOUVELMENT` int(11) DEFAULT NULL,
  `JOURNE_DE_RETOUR` varchar(20) NOT NULL,
  `EXPLICATION` text,
  PRIMARY KEY (`ID_DEPOSITION`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=124 ;

--
-- Contenu de la table `deposition`
--

INSERT INTO `deposition` (`ID_DEPOSITION`, `ID_MOTIF`, `ID_EMPLOYER`, `DATE_DE_DEMANDE`, `DATE_DEPART`, `JOURNE_DE_DEPART`, `DATE_RETOUR`, `RENOUVELMENT`, `JOURNE_DE_RETOUR`, `EXPLICATION`) VALUES
(111, 4, 6, '2015-01-09', '2015-01-22', 'Matin', '2015-01-23', 0, 'Matin', 'ihu'),
(112, 4, 3, '2015-01-09', '2015-01-11', 'Matin', '2015-01-12', 0, 'Matin', 'dsd'),
(113, 1, 29, '2015-01-09', '2015-01-12', 'Matin', '2015-01-16', 0, 'Matin', 'erzfdsf'),
(114, 1, 1, '2015-01-09', '2015-01-01', 'Matin', '2015-01-07', 0, 'Matin', 'dffs'),
(115, 1, 29, '2015-01-09', '2015-03-18', 'Matin', '2015-03-25', 0, 'Matin', 'sdqdqs'),
(116, 1, 29, '2015-01-09', '2015-03-11', 'Matin', '2015-03-12', 0, 'Matin', 'sdqd'),
(117, 1, 6, '2016-10-10', '2016-10-01', 'Matin', '2016-10-03', 0, 'Matin', 'Akory'),
(118, 4, 1, '2016-12-07', '2016-12-08', 'Matin', '2016-12-09', 0, 'Matin', 'malade'),
(119, 1, 1, '2016-12-07', '2016-12-14', 'Matin', '2016-12-14', 0, 'Apres midi', 'rien'),
(120, 4, 2, '2016-12-08', '2016-12-09', 'Matin', '2016-12-10', 0, 'Matin', 'malade'),
(121, 4, 1, '2016-12-08', '2016-12-22', 'Matin', '2016-12-27', 0, 'Apres midi', 'famadihana'),
(122, 1, 7, '2016-12-08', '2016-12-09', 'Matin', '2016-12-10', 0, 'Apres midi', 'fety'),
(123, 4, 6, '2016-12-08', '2016-12-09', 'Matin', '2016-12-09', 0, 'Apres midi', 'balade');

-- --------------------------------------------------------

--
-- Structure de la table `employer`
--

CREATE TABLE IF NOT EXISTS `employer` (
  `ID_EMPLOYER` bigint(4) NOT NULL AUTO_INCREMENT,
  `ID_CONTRAT` bigint(4) NOT NULL,
  `ID_POSTE` bigint(4) NOT NULL,
  `ID_DEPARTEMENT` bigint(4) NOT NULL,
  `MATRICULE` varchar(255) NOT NULL DEFAULT '0',
  `PHOTO` varchar(255) NOT NULL DEFAULT 'comptes-utilisateurs.jpg',
  `NOM` varchar(255) DEFAULT NULL,
  `PRENOM` varchar(255) DEFAULT NULL,
  `ADRESSEMAIL` varchar(255) DEFAULT NULL,
  `DATE_D_ENTREE` date DEFAULT NULL,
  `SOLDE_CONGE` double(5,1) DEFAULT NULL,
  `SOLDE_PERMISSION` double(5,1) NOT NULL,
  `MOT_DE_PASSE` varchar(255) DEFAULT NULL,
  `MOT_SECRETE` varchar(255) NOT NULL,
  `DERNIER_DATE_AJOUT_AUTO` date NOT NULL,
  PRIMARY KEY (`ID_EMPLOYER`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Contenu de la table `employer`
--

INSERT INTO `employer` (`ID_EMPLOYER`, `ID_CONTRAT`, `ID_POSTE`, `ID_DEPARTEMENT`, `MATRICULE`, `PHOTO`, `NOM`, `PRENOM`, `ADRESSEMAIL`, `DATE_D_ENTREE`, `SOLDE_CONGE`, `SOLDE_PERMISSION`, `MOT_DE_PASSE`, `MOT_SECRETE`, `DERNIER_DATE_AJOUT_AUTO`) VALUES
(1, 2, 1, 1, 'M001', 'AlbumArt_{CC6CA72E-BFB8-4162-919D-D011E9EBA6F1}_Large.jpg', 'RANDRIANARIJAONA', 'Christian', 'crandrianarijaona@ige-xao.com', '2014-01-01', 24.5, 3.5, 'c', 'deja', '2015-01-07'),
(2, 2, 1, 2, 'M002', 'comptes-utilisateurs.jpg', 'HERINIRINA', 'toky Alain', 'therinirina@ige-xao.com', '2014-01-06', 29.0, 10.0, 't', 'deja', '2015-01-06'),
(3, 2, 1, 3, 'M003', 'index.jpg', 'RALAIVAO', 'Francis', 'fralaivao@ige-xao.com', '2013-02-06', 30.0, 10.0, 'f', 'deja', '2015-01-06'),
(6, 2, 1, 4, 'M006', 'BRUNO.jpg', 'RAKOTONANDRASANA', 'Haja Tsilavina', 'hrakotonandrasana@ige-xao.com', '2012-12-01', 29.5, 10.0, 'h', 'deja', '2015-01-01'),
(7, 2, 1, 5, 'M007', 'comptes-utilisateurs.jpg', 'YANEVA', 'Nathaliya', 'nyaneva@ige-xao.com', '2014-12-01', 0.0, 8.5, 'n', 'deja', '2015-01-01'),
(29, 2, 6, 3, 'M008', 'comptes-utilisateurs.jpg', 'RAMA', 'Diary', 'jrazafimanjato@ige-xao.com', '2015-01-09', 0.0, 9.0, '123', 'deja', '2015-01-09'),
(36, 2, 5, 5, 'M010', 'Arrested_Bean.jpg', 'rakoto', 'NIAIKO', 'niaikorakoto@yahoo.com', '2016-12-08', 30.0, 10.0, 'niaiko', 'deja', '2016-12-08');

-- --------------------------------------------------------

--
-- Structure de la table `finir`
--

CREATE TABLE IF NOT EXISTS `finir` (
  `ID_FIN_CONTRAT` int(11) NOT NULL,
  `ID_CONTRAT` bigint(4) NOT NULL,
  `ID_EMPLOYER` bigint(4) NOT NULL,
  PRIMARY KEY (`ID_FIN_CONTRAT`,`ID_CONTRAT`,`ID_EMPLOYER`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `finir`
--


-- --------------------------------------------------------

--
-- Structure de la table `fin_contrat`
--

CREATE TABLE IF NOT EXISTS `fin_contrat` (
  `ID_FIN_CONTRAT` int(11) NOT NULL AUTO_INCREMENT,
  `DATE_FIN_CONTRAT` date DEFAULT NULL,
  PRIMARY KEY (`ID_FIN_CONTRAT`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

--
-- Contenu de la table `fin_contrat`
--

INSERT INTO `fin_contrat` (`ID_FIN_CONTRAT`, `DATE_FIN_CONTRAT`) VALUES
(46, '0000-00-00'),
(47, '0000-00-00'),
(48, '0000-00-00'),
(49, '0000-00-00'),
(50, '0000-00-00'),
(51, '0000-00-00'),
(52, '0000-00-00'),
(53, '0000-00-00'),
(54, '0000-00-00'),
(55, '0000-00-00'),
(56, '0000-00-00'),
(57, '0000-00-00'),
(58, '0000-00-00'),
(59, '0000-00-00'),
(60, '0000-00-00'),
(61, '0000-00-00'),
(62, '0000-00-00'),
(63, '0000-00-00'),
(64, '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE IF NOT EXISTS `historique` (
  `ID_HISTORIQUE` bigint(20) NOT NULL AUTO_INCREMENT,
  `ID_EMPLOYER` int(11) NOT NULL,
  `HEURE` int(32) NOT NULL,
  `DATE_HISTORIQUE` date NOT NULL,
  `HISTOIRE` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_HISTORIQUE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=73 ;

--
-- Contenu de la table `historique`
--

INSERT INTO `historique` (`ID_HISTORIQUE`, `ID_EMPLOYER`, `HEURE`, `DATE_HISTORIQUE`, `HISTOIRE`) VALUES
(36, 6, 1420790739, '2015-01-09', 'Envoye de demande.Date de depart 2015-01-22 Matin,retour 2015-01-23 Matin.Cause : ihu'),
(37, 3, 1420790985, '2015-01-09', 'Envoye de demande.Date de depart 2015-01-11 Matin,retour 2015-01-12 Matin.Cause : dsd'),
(38, 7, 1420791045, '2015-01-09', 'acceptÃ©e la demande RAKOTONANDRASANA Haja Tsilavina.DÃ©patement : Administration qui est dÃ©posÃ©e le 2015-01-09'),
(39, 7, 1420791047, '2015-01-09', 'acceptÃ©e la demande RALAIVAO Francis.DÃ©patement : Marketing & Communication qui est dÃ©posÃ©e le 2015-01-09'),
(40, 29, 1420795061, '2015-01-09', 'Envoye de demande.Date de depart 2015-01-12 Matin,retour 2015-01-16 Matin.Cause : erzfdsf'),
(41, 3, 1420795446, '2015-01-09', 'acceptÃ©e la demande RAMAKA Diary.DÃ©patement : Marketing & Communication qui est dÃ©posÃ©e le 2015-01-09'),
(42, 7, 1420795515, '2015-01-09', 'acceptÃ©e la demande RAMAKA Diary.DÃ©patement : Marketing & Communication qui est dÃ©posÃ©e le 2015-01-09'),
(43, 1, 1420803314, '2015-01-09', 'Envoye de demande.Date de depart 2015-01-01 Matin,retour 2015-01-07 Matin.Cause : dffs'),
(44, 29, 1420808092, '2015-01-09', 'Envoye de demande.Date de depart 2015-03-18 Matin,retour 2015-03-25 Matin.Cause : sdqdqs'),
(45, 29, 1420808175, '2015-01-09', 'Envoye de demande.Date de depart 2015-03-11 Matin,retour 2015-03-12 Matin.Cause : sdqd'),
(46, 3, 1420808523, '2015-01-09', 'acceptÃ©e la demande RAMA Diary.DÃ©patement : Marketing & Communication qui est dÃ©posÃ©e le 2015-01-09'),
(47, 3, 1420808770, '2015-01-09', 'acceptÃ©e la demande RAMA Diary.DÃ©patement : Marketing & Communication qui est dÃ©posÃ©e le 2015-01-09'),
(48, 3, 1420808827, '2015-01-09', 'acceptÃ©e la demande RAMA Diary.DÃ©patement : Marketing & Communication qui est dÃ©posÃ©e le 2015-01-09'),
(49, 3, 1420810038, '2015-01-09', 'acceptÃ©e la demande RAMA Diary.DÃ©patement : Marketing & Communication qui est dÃ©posÃ©e le 2015-01-09'),
(50, 3, 1420810291, '2015-01-09', 'acceptÃ©e la demande RAMA Diary.DÃ©patement : Marketing & Communication qui est dÃ©posÃ©e le 2015-01-09'),
(51, 3, 1420810296, '2015-01-09', 'acceptÃ©e la demande RAMA Diary.DÃ©patement : Marketing & Communication qui est dÃ©posÃ©e le 2015-01-09'),
(52, 3, 1420810490, '2015-01-09', 'acceptÃ©e la demande RAMA Diary.DÃ©patement : Marketing & Communication qui est dÃ©posÃ©e le 2015-01-09'),
(53, 7, 1420811297, '2015-01-09', 'acceptÃ©e la demande RANDRIANARIJAONA Christian.DÃ©patement : SEE EED qui est dÃ©posÃ©e le 2015-01-09'),
(54, 7, 1420811325, '2015-01-09', 'acceptÃ©e la demande RAMA Diary.DÃ©patement : Marketing & Communication qui est dÃ©posÃ©e le 2015-01-09'),
(55, 7, 1420811647, '2015-01-09', 'acceptÃ©e la demande RAMA Diary.DÃ©patement : Marketing & Communication qui est dÃ©posÃ©e le 2015-01-09'),
(56, 7, 1420811758, '2015-01-09', 'acceptÃ©e la demande RAMA Diary.DÃ©patement : Marketing & Communication qui est dÃ©posÃ©e le 2015-01-09'),
(57, 7, 1420811822, '2015-01-09', 'acceptÃ©e la demande RAMA Diary.DÃ©patement : Marketing & Communication qui est dÃ©posÃ©e le 2015-01-09'),
(58, 6, 1476047460, '2016-10-10', 'Envoye de demande.Date de depart 2016-10-01 Matin,retour 2016-10-03 Matin.Cause : Akory'),
(59, 1, 1481093461, '2016-12-07', 'Envoye de demande.Date de depart 2016-12-08 Matin,retour 2016-12-09 Matin.Cause : malade'),
(60, 1, 1481139618, '2016-12-07', 'Envoye de demande.Date de depart 2016-12-14 Matin,retour 2016-12-14 Apres midi.Cause : rien'),
(61, 2, 1481182937, '2016-12-08', 'Envoye de demande.Date de depart 2016-12-09 Matin,retour 2016-12-10 Matin.Cause : malade'),
(62, 7, 1481183422, '2016-12-08', 'acceptÃ©e la demande HERINIRINA toky Alain.DÃ©patement : Customization & Quality qui est dÃ©posÃ©e le 2016-12-08'),
(63, 7, 1481183443, '2016-12-08', 'reffuse la demande RANDRIANARIJAONA Christian.Depatement : SEE EED qui est deposee le 2016-12-07'),
(64, 7, 1481183449, '2016-12-08', 'acceptÃ©e la demande RANDRIANARIJAONA Christian.DÃ©patement : SEE EED qui est dÃ©posÃ©e le 2016-12-07'),
(65, 7, 1481183537, '2016-12-08', 'reffuse la demande RAKOTONANDRASANA Haja Tsilavina.Depatement : Administration qui est deposee le 2016-10-10'),
(66, 7, 1481183549, '2016-12-08', 'acceptÃ©e la demande RAMA Diary.DÃ©patement : Marketing & Communication qui est dÃ©posÃ©e le 2015-01-09'),
(67, 1, 1481183735, '2016-12-08', 'Envoye de demande.Date de depart 2016-12-22 Matin,retour 2016-12-27 Apres midi.Cause : famadihana'),
(68, 7, 1481183853, '2016-12-08', 'Envoye de demande.Date de depart 2016-12-09 Matin,retour 2016-12-10 Apres midi.Cause : fety'),
(69, 7, 1481183896, '2016-12-08', 'acceptÃ©e la demande RANDRIANARIJAONA Christian.DÃ©patement : SEE EED qui est dÃ©posÃ©e le 2016-12-08'),
(70, 7, 1481183903, '2016-12-08', 'acceptÃ©e la demande YANEVA Nathaliya.DÃ©patement : Responsable du site qui est dÃ©posÃ©e le 2016-12-08'),
(71, 6, 1481187227, '2016-12-08', 'Envoye de demande.Date de depart 2016-12-09 Matin,retour 2016-12-09 Apres midi.Cause : balade'),
(72, 7, 1481187357, '2016-12-08', 'acceptÃ©e la demande RAKOTONANDRASANA Haja Tsilavina.DÃ©patement : Administration qui est dÃ©posÃ©e le 2016-12-08');

-- --------------------------------------------------------

--
-- Structure de la table `motif`
--

CREATE TABLE IF NOT EXISTS `motif` (
  `ID_MOTIF` bigint(4) NOT NULL AUTO_INCREMENT,
  `ID_TYPE_DEP` bigint(4) NOT NULL,
  `MOTIF` varchar(1000) DEFAULT NULL,
  `NOMBRE_JOUR_MAX` double(5,1) DEFAULT NULL,
  PRIMARY KEY (`ID_MOTIF`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `motif`
--

INSERT INTO `motif` (`ID_MOTIF`, `ID_TYPE_DEP`, `MOTIF`, `NOMBRE_JOUR_MAX`) VALUES
(1, 1, 'Permission', 30.0),
(4, 2, 'CongÃ©', 30.0);

-- --------------------------------------------------------

--
-- Structure de la table `poste`
--

CREATE TABLE IF NOT EXISTS `poste` (
  `ID_POSTE` bigint(4) NOT NULL AUTO_INCREMENT,
  `NOM_POSTE` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_POSTE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `poste`
--

INSERT INTO `poste` (`ID_POSTE`, `NOM_POSTE`) VALUES
(1, 'chef'),
(2, 'Webdeveloppeur'),
(3, 'Technicien superieur en Genie Electrique'),
(4, 'Administrative manager'),
(5, 'DÃ©veloppeur'),
(6, 'PAOiste'),
(7, 'Testeuse');

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `ID_CONTRAT` bigint(4) NOT NULL AUTO_INCREMENT,
  `TYPE_CONTRAT` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_CONTRAT`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `status`
--

INSERT INTO `status` (`ID_CONTRAT`, `TYPE_CONTRAT`) VALUES
(1, 'CDD'),
(2, 'CDI');

-- --------------------------------------------------------

--
-- Structure de la table `type_deposition`
--

CREATE TABLE IF NOT EXISTS `type_deposition` (
  `ID_TYPE_DEP` bigint(4) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_TYPE_DEP`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `type_deposition`
--

INSERT INTO `type_deposition` (`ID_TYPE_DEP`, `NOM`) VALUES
(1, 'Permission'),
(2, 'Conger');

-- --------------------------------------------------------

--
-- Structure de la table `valider`
--

CREATE TABLE IF NOT EXISTS `valider` (
  `ID_DEPARTEMENT` bigint(4) NOT NULL,
  `ID_DEPOSITION` bigint(4) NOT NULL,
  `ID_RESPONSABLE_SITE` bigint(4) NOT NULL,
  `VALIDE_DEPARTEMENT` varchar(20) DEFAULT NULL,
  `DATE_VALIDATION_DEP` date DEFAULT NULL,
  `VALIDE_RESPONSABLE` varchar(20) DEFAULT NULL,
  `DATE_VALIDATION_RESPONSABLE` date DEFAULT NULL,
  `VU_UTILISATEUR` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_DEPARTEMENT`,`ID_DEPOSITION`,`ID_RESPONSABLE_SITE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `valider`
--

INSERT INTO `valider` (`ID_DEPARTEMENT`, `ID_DEPOSITION`, `ID_RESPONSABLE_SITE`, `VALIDE_DEPARTEMENT`, `DATE_VALIDATION_DEP`, `VALIDE_RESPONSABLE`, `DATE_VALIDATION_RESPONSABLE`, `VU_UTILISATEUR`) VALUES
(1, 114, 5, 'oui', '2015-01-09', 'oui', '2015-01-09', 'vu'),
(1, 118, 5, 'oui', '2016-12-07', 'non', '2016-12-08', 'vu'),
(1, 119, 5, 'oui', '2016-12-07', 'oui', '2016-12-08', 'vu'),
(1, 121, 5, 'oui', '2016-12-08', 'oui', '2016-12-08', 'vu'),
(2, 120, 5, 'oui', '2016-12-08', 'oui', '2016-12-08', 'vu'),
(3, 112, 5, 'oui', '2015-01-09', 'oui', '2015-01-09', 'vu'),
(3, 113, 5, 'oui', '2015-01-09', 'oui', '2015-01-09', 'vu'),
(3, 115, 5, 'oui', '2015-01-09', 'oui', '2015-01-09', 'non vu'),
(3, 116, 5, 'oui', '2015-01-09', 'oui', '2016-12-08', 'non vu'),
(4, 111, 5, 'oui', '2015-01-09', 'oui', '2015-01-09', 'vu'),
(4, 117, 5, 'oui', '2016-10-10', 'non', '2016-12-08', 'vu'),
(4, 123, 5, 'oui', '2016-12-08', 'oui', '2016-12-08', 'vu'),
(5, 122, 5, 'oui', '2016-12-08', 'oui', '2016-12-08', 'non vu');
