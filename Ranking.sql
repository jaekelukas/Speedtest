-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: database-5002588222.webspace-host.com:3306
-- Erstellungszeit: 14. Jun 2021 um 12:42
-- Server-Version: 5.7.33-log
-- PHP-Version: 7.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `dbs2051515`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Ranking`
--

CREATE TABLE `Ranking` (
  `Nr` int(5) NOT NULL,
  `IP` varchar(32) NOT NULL,
  `Download` varchar(20) NOT NULL,
  `Upload` varchar(20) NOT NULL,
  `Ping` varchar(20) NOT NULL,
  `Time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `Ranking`
--

INSERT INTO `Ranking` (`Nr`, `IP`, `Download`, `Upload`, `Ping`, `Time`) VALUES
(5, '192.168.1.1', '50 MBits', '50 MBits', '10', '2021-05-27 07:39:31'),
(6, '79.226.26.165', '11.23 MBit/s', '8.93 MBit/s', '34 ms', '2021-06-14 02:20:39'),
(7, '2003:ed:9f09:2c00:84', '9.64 MBit/s', '13.83 MBit/s', '27 ms', '2021-06-14 02:20:53'),
(8, '2003:e6:2f40:2200:c0a7:122f:3232', '22.71 MBit/s', '18.1 MBit/s', '44 ms', '2021-06-14 02:23:39'),
(9, '2003:ed:9f09:2c00:84a3:b645:6beb', '22.02 MBit/s', '15.8 MBit/s', '38 ms', '2021-06-14 02:24:26'),
(10, '79.226.26.165', '10.36 MBit/s', '9.06 MBit/s', '59 ms', '2021-06-14 02:24:36'),
(11, '2003:ed:9f09:2c00:84a3:b645:6beb', '21.71 MBit/s', '16.34 MBit/s', '34 ms', '2021-06-14 02:26:42');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `Ranking`
--
ALTER TABLE `Ranking`
  ADD PRIMARY KEY (`Nr`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `Ranking`
--
ALTER TABLE `Ranking`
  MODIFY `Nr` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
