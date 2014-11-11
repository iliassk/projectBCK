-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 11 Novembre 2014 à 22:46
-- Version du serveur: 5.5.40-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `projectcdp`
--

-- --------------------------------------------------------

--
-- Structure de la table `developper`
--

CREATE TABLE IF NOT EXISTS `developper` (
  `idDev` int(11) NOT NULL AUTO_INCREMENT,
  `nameDev` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`idDev`),
  UNIQUE KEY `nameDev` (`nameDev`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `developper`
--

INSERT INTO `developper` (`idDev`, `nameDev`, `password`, `email`) VALUES
(3, 'iliass', 'c984aed014aec7623a54f0591da07a85fd4b762d', 'iliass@test.com'),
(5, 'benjamin', 'c984aed014aec7623a54f0591da07a85fd4b762d', 'benjamin@test.com');

-- --------------------------------------------------------

--
-- Structure de la table `dev_project`
--

CREATE TABLE IF NOT EXISTS `dev_project` (
  `idDev` int(11) NOT NULL,
  `idPro` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `scrumMaster` tinyint(1) NOT NULL,
  `PO` tinyint(1) NOT NULL,
  PRIMARY KEY (`idDev`,`idPro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `dev_project`
--

INSERT INTO `dev_project` (`idDev`, `idPro`, `admin`, `scrumMaster`, `PO`) VALUES
(3, 6, 1, 0, 0),
(3, 7, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `library`
--

CREATE TABLE IF NOT EXISTS `library` (
  `idLib` int(11) NOT NULL,
  `idPro` int(11) NOT NULL,
  `nameLib` text CHARACTER SET utf8 NOT NULL,
  `versionLib` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`idLib`,`idPro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `idPro` int(11) NOT NULL AUTO_INCREMENT,
  `namePro` varchar(50) CHARACTER SET utf8 NOT NULL,
  `nbSprint` int(11) DEFAULT NULL,
  `urlGit` text CHARACTER SET utf8,
  `lastCommit` date DEFAULT NULL,
  `urlJenkins` text CHARACTER SET utf8,
  PRIMARY KEY (`idPro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `project`
--

INSERT INTO `project` (`idPro`, `namePro`, `nbSprint`, `urlGit`, `lastCommit`, `urlJenkins`) VALUES
(4, 'projectAlpha', NULL, NULL, NULL, NULL),
(5, 'ppoa515', NULL, NULL, NULL, NULL),
(6, 'kfkzf', NULL, NULL, NULL, NULL),
(7, 'akkd', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `idTask` int(11) NOT NULL AUTO_INCREMENT,
  `idPro` int(11) NOT NULL,
  `idSprint` int(11) NOT NULL,
  `nameTask` text CHARACTER SET utf8 NOT NULL,
  `costTask` int(11) NOT NULL,
  `is_test` tinyint(1) NOT NULL,
  PRIMARY KEY (`idTask`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `taskdepend`
--

CREATE TABLE IF NOT EXISTS `taskdepend` (
  `idTask` int(11) NOT NULL,
  `idDepend` int(11) NOT NULL,
  PRIMARY KEY (`idTask`,`idDepend`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `idTask` int(11) NOT NULL,
  `summary` text NOT NULL,
  `idDev` int(11) NOT NULL,
  `exec_date` date NOT NULL,
  `result` tinyint(1) NOT NULL,
  PRIMARY KEY (`idTask`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `userstory`
--

CREATE TABLE IF NOT EXISTS `userstory` (
  `idUS` int(11) NOT NULL AUTO_INCREMENT,
  `idPro` int(11) NOT NULL,
  `nameUS` text CHARACTER SET utf8 NOT NULL,
  `costUS` int(11) NOT NULL,
  `idSprint` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUS`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `userstory`
--

INSERT INTO `userstory` (`idUS`, `idPro`, `nameUS`, `costUS`, `idSprint`) VALUES
(1, 1, 'Faire linterface', 5, 1),
(2, 1, 'En tant qu’administrateur du projet, je souhaite pouvoir ajouter/supprimer un sprint.', 2, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
