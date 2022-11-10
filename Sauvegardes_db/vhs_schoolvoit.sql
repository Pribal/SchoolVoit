-- phpMyAdmin SQL Dump
-- version 5.1.4
-- https://www.phpmyadmin.net/
--
-- Host: mysql-vhs.alwaysdata.net
-- Generation Time: Oct 14, 2022 at 02:01 PM
-- Server version: 10.6.7-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vhs_schoolvoit`
--

-- --------------------------------------------------------

--
-- Table structure for table `RESERVATION`
--

CREATE TABLE `RESERVATION` (
  `id_reservation` int(11) NOT NULL,
  `reserve` tinyint(1) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_trajet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `TRAJET`
--

CREATE TABLE `TRAJET` (
  `id_trajet` int(11) NOT NULL,
  `depart` datetime NOT NULL,
  `lieu_depart` varchar(155) NOT NULL,
  `lieu_arrivee` varchar(155) NOT NULL,
  `nb_place` int(11) NOT NULL,
  `fumeur` tinyint(1) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_car` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `USER`
--

CREATE TABLE `USER` (
  `id_user` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `VEHICULE`
--

CREATE TABLE `VEHICULE` (
  `id_car` int(11) NOT NULL,
  `matricule` varchar(10) NOT NULL,
  `marque` varchar(30) NOT NULL,
  `modele` varchar(30) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `RESERVATION`
--
ALTER TABLE `RESERVATION`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_trajet` (`id_trajet`);

--
-- Indexes for table `TRAJET`
--
ALTER TABLE `TRAJET`
  ADD PRIMARY KEY (`id_trajet`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_car` (`id_car`);

--
-- Indexes for table `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `VEHICULE`
--
ALTER TABLE `VEHICULE`
  ADD PRIMARY KEY (`id_car`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `RESERVATION`
--
ALTER TABLE `RESERVATION`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `TRAJET`
--
ALTER TABLE `TRAJET`
  MODIFY `id_trajet` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `USER`
--
ALTER TABLE `USER`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `VEHICULE`
--
ALTER TABLE `VEHICULE`
  MODIFY `id_car` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `RESERVATION`
--
ALTER TABLE `RESERVATION`
  ADD CONSTRAINT `RESERVATION_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `USER` (`id_user`),
  ADD CONSTRAINT `RESERVATION_ibfk_2` FOREIGN KEY (`id_trajet`) REFERENCES `TRAJET` (`id_trajet`);

--
-- Constraints for table `TRAJET`
--
ALTER TABLE `TRAJET`
  ADD CONSTRAINT `TRAJET_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `USER` (`id_user`),
  ADD CONSTRAINT `TRAJET_ibfk_2` FOREIGN KEY (`id_car`) REFERENCES `VEHICULE` (`id_car`);

--
-- Constraints for table `VEHICULE`
--
ALTER TABLE `VEHICULE`
  ADD CONSTRAINT `VEHICULE_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `USER` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
