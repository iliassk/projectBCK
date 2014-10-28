-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 23 Octobre 2014 à 17:00
-- Version du serveur: 5.5.40-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `projectCdP`
--

-- --------------------------------------------------------

--
-- Structure de la table `developper`
--

CREATE TABLE IF NOT EXISTS `developper` (
  `idDev` int(11) NOT NULL AUTO_INCREMENT,
  `nameDev` varchar(15) CHARACTER SET utf8 NOT NULL,
  `password` varchar(8) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`idDev`),
  UNIQUE KEY `nameDev` (`nameDev`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `idTask` int(11) NOT NULL AUTO_INCREMENT,
  `nameTask` text CHARACTER SET utf8 NOT NULL,
  `costTask` int(11) NOT NULL,
  `is_test` tinyint(1) NOT NULL,
  PRIMARY KEY (`idTask`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `taskDepend`
--

CREATE TABLE IF NOT EXISTS `taskDepend` (
  `idTask` int(11) NOT NULL,
  `idDepend` int(11) NOT NULL,
  PRIMARY KEY (`idTask`,`idDepend`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `task_US`
--

CREATE TABLE IF NOT EXISTS `task_US` (
  `idTask` int(11) NOT NULL,
  `idUS` int(11) NOT NULL,
  PRIMARY KEY (`idTask`,`idUS`)
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
-- Structure de la table `userStory`
--

CREATE TABLE IF NOT EXISTS `userStory` (
  `idUS` int(11) NOT NULL AUTO_INCREMENT,
  `idPro` int(11) NOT NULL,
  `nameUS` text CHARACTER SET utf8 NOT NULL,
  `costUS` int(11) NOT NULL,
  `idSprint` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;