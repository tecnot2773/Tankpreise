-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 22. Feb 2018 um 22:37
-- Server-Version: 5.7.21-0ubuntu0.16.04.1
-- PHP-Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `gas`
--
CREATE DATABASE IF NOT EXISTS `gas` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gas`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE `cars` (
  `ID` int(2) NOT NULL,
  `userID` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `volume` float NOT NULL,
  `consumption` float NOT NULL,
  `type` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE `city` (
  `ID` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gasstation`
--

DROP TABLE IF EXISTS `gasstation`;
CREATE TABLE `gasstation` (
  `ID` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `street` varchar(40) NOT NULL,
  `place` varchar(20) NOT NULL,
  `lat` float NOT NULL,
  `lon` float NOT NULL,
  `UUID` varchar(50) NOT NULL COMMENT 'Unique id from provider'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `stats`
--

DROP TABLE IF EXISTS `stats`;
CREATE TABLE `stats` (
  `ID` int(11) NOT NULL,
  `diesel` varchar(6) DEFAULT NULL,
  `E5` varchar(6) DEFAULT NULL,
  `E10` varchar(6) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `gasStationID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `hashed_password` varchar(100) NOT NULL,
  `cityID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `gasstation`
--
ALTER TABLE `gasstation`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `stats`
--
ALTER TABLE `stats`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `cars`
--
ALTER TABLE `cars`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `city`
--
ALTER TABLE `city`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `gasstation`
--
ALTER TABLE `gasstation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `stats`
--
ALTER TABLE `stats`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
