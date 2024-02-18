-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 18, 2024 at 10:25 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `osiguranko`
--
CREATE DATABASE IF NOT EXISTS `osiguranko` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `osiguranko`;

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

DROP TABLE IF EXISTS `korisnici`;
CREATE TABLE IF NOT EXISTS `korisnici` (
  `id_korisnik` int NOT NULL AUTO_INCREMENT,
  `korisnik_ime` varchar(355) NOT NULL,
  `korisnik_sifra` varchar(355) NOT NULL,
  PRIMARY KEY (`id_korisnik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `polise_`
--

DROP TABLE IF EXISTS `polise_`;
CREATE TABLE IF NOT EXISTS `polise_` (
  `id_polise` int NOT NULL AUTO_INCREMENT,
  `id_korisnika` int NOT NULL,
  `polisa_br_pasosa` varchar(10) NOT NULL,
  `polisa_br_telefona` varchar(20) NOT NULL,
  `polisa_datum_rodjenja` date NOT NULL,
  `polisa_od` date NOT NULL,
  `polisa_do` date NOT NULL,
  `polisa_ime` varchar(150) NOT NULL,
  `polisa_tip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `polisa_email` varchar(200) NOT NULL,
  `polisa_dodatni_osiguranici` varchar(800) NOT NULL,
  `datum_prijave` varchar(60) NOT NULL,
  PRIMARY KEY (`id_polise`),
  KEY `id_korisnika` (`id_korisnika`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `polise_`
--
ALTER TABLE `polise_`
  ADD CONSTRAINT `polise__ibfk_1` FOREIGN KEY (`id_korisnika`) REFERENCES `korisnici` (`id_korisnik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
