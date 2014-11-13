-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 13 Novembre 2014 à 16:04
-- Version du serveur :  5.5.39-MariaDB
-- Version de PHP :  5.5.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `projectcdp`
--

-- --------------------------------------------------------

--
-- Structure de la table `developper`
--

CREATE TABLE IF NOT EXISTS `developper` (
`idDev` int(11) NOT NULL,
  `nameDev` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `developper`
--

INSERT INTO `developper` (`idDev`, `nameDev`, `password`, `email`) VALUES
(3, 'iliass', 'c984aed014aec7623a54f0591da07a85fd4b762d', 'iliass@test.com'),
(5, 'benjamin', 'c984aed014aec7623a54f0591da07a85fd4b762d', 'benjamin@test.com'),
(7, 'tristan', 'c984aed014aec7623a54f0591da07a85fd4b762d', 'tristan@test.com');

-- --------------------------------------------------------

--
-- Structure de la table `dev_project`
--

CREATE TABLE IF NOT EXISTS `dev_project` (
  `idDev` int(11) NOT NULL,
  `idPro` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `scrumMaster` tinyint(1) NOT NULL,
  `PO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `dev_project`
--

INSERT INTO `dev_project` (`idDev`, `idPro`, `admin`, `scrumMaster`, `PO`) VALUES
(3, 6, 1, 0, 0),
(3, 7, 1, 0, 0),
(7, 8, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `library`
--

CREATE TABLE IF NOT EXISTS `library` (
  `idLib` int(11) NOT NULL,
  `idPro` int(11) NOT NULL,
  `nameLib` text CHARACTER SET utf8 NOT NULL,
  `versionLib` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
`idPro` int(11) NOT NULL,
  `namePro` varchar(50) CHARACTER SET utf8 NOT NULL,
  `nbSprint` int(11) DEFAULT NULL,
  `urlGit` text CHARACTER SET utf8,
  `lastCommit` date DEFAULT NULL,
  `urlJenkins` text CHARACTER SET utf8
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `project`
--

INSERT INTO `project` (`idPro`, `namePro`, `nbSprint`, `urlGit`, `lastCommit`, `urlJenkins`) VALUES
(4, 'projectAlpha', NULL, NULL, NULL, NULL),
(5, 'ppoa515', NULL, NULL, NULL, NULL),
(6, 'kfkzf', NULL, NULL, NULL, NULL),
(7, 'akkd', NULL, NULL, NULL, NULL),
(8, 'projecttest', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
`idTask` int(11) NOT NULL,
  `idPro` int(11) NOT NULL,
  `idSprint` int(11) NOT NULL,
  `nameTask` text CHARACTER SET utf8 NOT NULL,
  `descriptionTask` text CHARACTER SET utf8 NOT NULL,
  `costTask` int(11) NOT NULL,
  `is_test` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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
  `idDepend` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `task_us`
--

CREATE TABLE IF NOT EXISTS `task_us` (
  `idTask` int(11) NOT NULL,
  `idUS` int(11) NOT NULL
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
  `result` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `userstory`
--

CREATE TABLE IF NOT EXISTS `userstory` (
`idUS` int(11) NOT NULL,
  `idPro` int(11) NOT NULL,
  `nameUS` text CHARACTER SET utf8 NOT NULL,
  `costUS` int(11) NOT NULL,
  `idSprint` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `userstory`
--

INSERT INTO `userstory` (`idUS`, `idPro`, `nameUS`, `costUS`, `idSprint`) VALUES
(1, 1, 'Faire linterface', 5, 1),
(2, 1, 'En tant qu’administrateur du projet, je souhaite pouvoir ajouter/supprimer un sprint.', 2, 1),
(3, 8, 'connection', 2, 1),
(4, 8, 'ajouter un projet', 3, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `developper`
--
ALTER TABLE `developper`
 ADD PRIMARY KEY (`idDev`), ADD UNIQUE KEY `nameDev` (`nameDev`);

--
-- Index pour la table `dev_project`
--
ALTER TABLE `dev_project`
 ADD PRIMARY KEY (`idDev`,`idPro`);

--
-- Index pour la table `library`
--
ALTER TABLE `library`
 ADD PRIMARY KEY (`idLib`,`idPro`);

--
-- Index pour la table `project`
--
ALTER TABLE `project`
 ADD PRIMARY KEY (`idPro`);

--
-- Index pour la table `task`
--
ALTER TABLE `task`
 ADD PRIMARY KEY (`idTask`);

--
-- Index pour la table `taskdepend`
--
ALTER TABLE `taskdepend`
 ADD PRIMARY KEY (`idTask`,`idDepend`);

--
-- Index pour la table `task_us`
--
ALTER TABLE `task_us`
 ADD PRIMARY KEY (`idTask`,`idUS`);

--
-- Index pour la table `test`
--
ALTER TABLE `test`
 ADD PRIMARY KEY (`idTask`);

--
-- Index pour la table `userstory`
--
ALTER TABLE `userstory`
 ADD PRIMARY KEY (`idUS`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `developper`
--
ALTER TABLE `developper`
MODIFY `idDev` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `project`
--
ALTER TABLE `project`
MODIFY `idPro` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `task`
--
ALTER TABLE `task`
MODIFY `idTask` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `userstory`
--
ALTER TABLE `userstory`
MODIFY `idUS` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
