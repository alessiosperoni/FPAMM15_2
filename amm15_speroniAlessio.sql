-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Giu 03, 2016 alle 17:33
-- Versione del server: 5.5.41-0ubuntu0.14.04.1
-- Versione PHP: 5.5.9-1ubuntu4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `easyparking`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `developer`
--

CREATE TABLE IF NOT EXISTS `developer` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `via` char(15) NOT NULL,
  `CAP` int(5) NOT NULL,
  `provincia` char(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `developer`
--

INSERT INTO `developer` (`id`, `via`, `CAP`, `provincia`) VALUES
(1, 'Piave', 9044, 'Cagliari');

-- --------------------------------------------------------

--
-- Struttura della tabella `Prodotto`
--

CREATE TABLE IF NOT EXISTS `Prodotto` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nome` char(15) NOT NULL,
  `modello` char(15) NOT NULL,
  `data` date NOT NULL,
  `produttore_id` int(3) NOT NULL,
  `descrizione` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `Prodotto`
--

INSERT INTO `Prodotto` (`id`, `nome`, `modello`, `data`, `produttore_id`, `descrizione`) VALUES
(1, 'EasyParking', 'Beta1', '2016-05-26', 1, 'Il sistema assiste l''utente durante le manovre di parcheggio. 8 sensori, una centralina e un display.');

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` char(10) NOT NULL,
  `password` char(16) NOT NULL,
  `nome` char(20) NOT NULL,
  `cognome` char(20) NOT NULL,
  `email` char(30) NOT NULL,
  `citta` char(15) NOT NULL,
  `id` int(5) NOT NULL,
  `ruolo` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`username`, `password`, `nome`, `cognome`, `email`, `citta`, `id`, `ruolo`) VALUES
('AleSperoni', 'Alessio', 'Alessio', 'Speroni', 'alessio@speroni.it', 'Quartucciu', 1, 2),
('Asperoni', 'Alessio', 'Alessio', 'Speroni', 'alessio.speroni@icloud.it', 'Quartucciu', 2, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
