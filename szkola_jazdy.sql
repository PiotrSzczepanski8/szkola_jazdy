-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Paź 04, 2024 at 12:11 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `szkola_jazdy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `instruktor`
--

CREATE TABLE `instruktor` (
  `id_instruktor` int(11) NOT NULL,
  `imie` varchar(30) NOT NULL,
  `nazwisko` varchar(30) NOT NULL,
  `telefon` varchar(14) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `miasto` varchar(50) NOT NULL,
  `ulica` varchar(30) NOT NULL,
  `nr_lokalu` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kurs`
--

CREATE TABLE `kurs` (
  `id_kurs` int(11) NOT NULL,
  `kategoria` enum('A','B','C','D','E') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kurs`
--

INSERT INTO `kurs` (`id_kurs`, `kategoria`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D'),
(5, 'E');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kursant`
--

CREATE TABLE `kursant` (
  `id_kursant` int(11) NOT NULL,
  `imie` varchar(30) NOT NULL,
  `nazwisko` varchar(30) NOT NULL,
  `telefon` varchar(14) NOT NULL,
  `email` varchar(100) NOT NULL,
  `hash_haslo` varchar(100) NOT NULL,
  `login` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lekcja`
--

CREATE TABLE `lekcja` (
  `id_lekcja` int(11) NOT NULL,
  `id_kursant` int(11) NOT NULL,
  `id_instruktor` int(11) NOT NULL,
  `id_kurs` int(11) NOT NULL,
  `data_odbycia` date NOT NULL,
  `godzina` time NOT NULL,
  `id_samochod` int(11) DEFAULT NULL,
  `temat_lekcji` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `samochod`
--

CREATE TABLE `samochod` (
  `id_samochod` int(11) NOT NULL,
  `marka` varchar(30) NOT NULL,
  `model` varchar(30) NOT NULL,
  `numer_rejestracyjny` varchar(8) NOT NULL,
  `stan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `transakcja`
--

CREATE TABLE `transakcja` (
  `id_transakcja` int(11) NOT NULL,
  `id_kursant` int(11) DEFAULT NULL,
  `id_kurs` int(11) DEFAULT NULL,
  `data_transakcji` date NOT NULL,
  `cena` decimal(7,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wyplata`
--

CREATE TABLE `wyplata` (
  `id_wyplata` int(11) NOT NULL,
  `kwota` decimal(7,2) NOT NULL,
  `id_instruktor` int(11) NOT NULL,
  `data_wyplaty` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `instruktor`
--
ALTER TABLE `instruktor`
  ADD PRIMARY KEY (`id_instruktor`);

--
-- Indeksy dla tabeli `kurs`
--
ALTER TABLE `kurs`
  ADD PRIMARY KEY (`id_kurs`),
  ADD KEY `id_kurs` (`id_kurs`);

--
-- Indeksy dla tabeli `kursant`
--
ALTER TABLE `kursant`
  ADD PRIMARY KEY (`id_kursant`),
  ADD KEY `id_kursant` (`id_kursant`);

--
-- Indeksy dla tabeli `lekcja`
--
ALTER TABLE `lekcja`
  ADD PRIMARY KEY (`id_lekcja`),
  ADD KEY `id_kursant` (`id_kursant`),
  ADD KEY `id_instruktor` (`id_instruktor`),
  ADD KEY `id_kurs` (`id_kurs`),
  ADD KEY `id_lekcja` (`id_lekcja`),
  ADD KEY `id_samochod` (`id_samochod`);

--
-- Indeksy dla tabeli `samochod`
--
ALTER TABLE `samochod`
  ADD PRIMARY KEY (`id_samochod`),
  ADD KEY `id_samochod` (`id_samochod`);

--
-- Indeksy dla tabeli `transakcja`
--
ALTER TABLE `transakcja`
  ADD PRIMARY KEY (`id_transakcja`),
  ADD KEY `id_kursant` (`id_kursant`),
  ADD KEY `id_kurs` (`id_kurs`);

--
-- Indeksy dla tabeli `wyplata`
--
ALTER TABLE `wyplata`
  ADD PRIMARY KEY (`id_wyplata`),
  ADD KEY `id_instruktor` (`id_instruktor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `instruktor`
--
ALTER TABLE `instruktor`
  MODIFY `id_instruktor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kurs`
--
ALTER TABLE `kurs`
  MODIFY `id_kurs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kursant`
--
ALTER TABLE `kursant`
  MODIFY `id_kursant` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lekcja`
--
ALTER TABLE `lekcja`
  MODIFY `id_lekcja` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `samochod`
--
ALTER TABLE `samochod`
  MODIFY `id_samochod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transakcja`
--
ALTER TABLE `transakcja`
  MODIFY `id_transakcja` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wyplata`
--
ALTER TABLE `wyplata`
  MODIFY `id_wyplata` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lekcja`
--
ALTER TABLE `lekcja`
  ADD CONSTRAINT `lekcja_ibfk_1` FOREIGN KEY (`id_kursant`) REFERENCES `kursant` (`id_kursant`),
  ADD CONSTRAINT `lekcja_ibfk_2` FOREIGN KEY (`id_instruktor`) REFERENCES `instruktor` (`id_instruktor`),
  ADD CONSTRAINT `lekcja_ibfk_3` FOREIGN KEY (`id_kurs`) REFERENCES `kurs` (`id_kurs`),
  ADD CONSTRAINT `lekcja_ibfk_4` FOREIGN KEY (`id_samochod`) REFERENCES `samochod` (`id_samochod`);

--
-- Constraints for table `transakcja`
--
ALTER TABLE `transakcja`
  ADD CONSTRAINT `transakcja_ibfk_1` FOREIGN KEY (`id_kursant`) REFERENCES `kursant` (`id_kursant`),
  ADD CONSTRAINT `transakcja_ibfk_2` FOREIGN KEY (`id_kurs`) REFERENCES `kurs` (`id_kurs`);

--
-- Constraints for table `wyplata`
--
ALTER TABLE `wyplata`
  ADD CONSTRAINT `wyplata_ibfk_1` FOREIGN KEY (`id_instruktor`) REFERENCES `instruktor` (`id_instruktor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
