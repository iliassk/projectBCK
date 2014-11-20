-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
<<<<<<< HEAD:dev/projectcdp.sql
-- Client: localhost
-- Généré le: Ven 14 Novembre 2014 à 14:17
-- Version du serveur: 5.5.40-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.5
=======
-- Client :  127.0.0.1
-- Généré le :  Mar 28 Octobre 2014 à 19:24
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12
>>>>>>> master:dev/projectCdP.sql

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
<<<<<<< HEAD:dev/projectcdp.sql
-- Base de données: `projectcdp`
=======
-- Base de données :  `projectcdp`
>>>>>>> master:dev/projectCdP.sql
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
<<<<<<< HEAD:dev/projectcdp.sql
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;
=======
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;
>>>>>>> master:dev/projectCdP.sql

--
-- Contenu de la table `developper`
--

INSERT INTO `developper` (`idDev`, `nameDev`, `password`, `email`) VALUES
<<<<<<< HEAD:dev/projectcdp.sql
(3, 'iliass', 'c984aed014aec7623a54f0591da07a85fd4b762d', 'iliass@test.com'),
(7, 'tristan', 'c984aed014aec7623a54f0591da07a85fd4b762d', 'tristan@test.com'),
(8, 'benjamin', 'fe09bc2ef2737a3258f978e26226dcbac1b3f948', 'benjamin@test.com');
=======
(3, 'iliass', 'c984aed014aec7623a54f0591da07a85fd4b762d', 'iliass@test.com');
>>>>>>> master:dev/projectCdP.sql

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
(3, 7, 1, 0, 0),
(7, 8, 1, 0, 0),
(8, 9, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `gantt`
--

CREATE TABLE IF NOT EXISTS `gantt` (
  `idDev` int(11) NOT NULL,
  `date` date NOT NULL,
  `idTask` int(11) NOT NULL,
  PRIMARY KEY (`idDev`,`date`,`idTask`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `kanban`
--

CREATE TABLE IF NOT EXISTS `kanban` (
  `idDev` int(11) NOT NULL,
  `idTask` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`idDev`,`idTask`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `project`
--

INSERT INTO `project` (`idPro`, `namePro`, `nbSprint`, `urlGit`, `lastCommit`, `urlJenkins`) VALUES
(4, 'projectAlpha', NULL, NULL, NULL, NULL),
(8, 'projecttest', NULL, NULL, NULL, NULL),
(9, 'projectScrum', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `idTask` int(11) NOT NULL AUTO_INCREMENT,
  `idPro` int(11) NOT NULL,
  `idSprint` int(11) NOT NULL,
  `nameTask` text CHARACTER SET utf8 NOT NULL,
  `descriptionTask` text CHARACTER SET utf8 NOT NULL,
  `costTask` int(11) NOT NULL,
  `is_test` tinyint(1) NOT NULL,
  PRIMARY KEY (`idTask`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `task`
--

INSERT INTO `task` (`idTask`, `idPro`, `idSprint`, `nameTask`, `descriptionTask`, `costTask`, `is_test`) VALUES
(1, 8, 1, 'BD', 'implémentation de la bd', 1, 0),
(2, 8, 1, 'page_accueuil', 'impl conection inscription', 3, 0);

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
-- Structure de la table `task_us`
--

CREATE TABLE IF NOT EXISTS `task_us` (
  `idTask` int(11) NOT NULL,
  `idUS` int(11) NOT NULL,
  PRIMARY KEY (`idTask`,`idUS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `task_us`
--

INSERT INTO `task_us` (`idTask`, `idUS`) VALUES
(1, 3),
(1, 4),
(2, 1),
(2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `idTask` int(11) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `userstory`
--

INSERT INTO `userstory` (`idUS`, `idPro`, `nameUS`, `costUS`, `idSprint`) VALUES
(1, 1, 'Faire linterface', 5, 1),
(2, 1, 'En tant qu’administrateur du projet, je souhaite pouvoir ajouter/supprimer un sprint.', 2, 1),
(3, 8, 'connection', 2, 1),
(4, 8, 'ajouter un projet', 3, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
