-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 28 Paź 2024, 17:22
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `szkola_jazdy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kurs`
--

CREATE TABLE `kurs` (
  `id_kurs` int(11) NOT NULL,
  `kategoria` enum('A','B','C','D','E') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kursant`
--

CREATE TABLE `kursant` (
  `id_kursant` int(11) NOT NULL,
  `imie` varchar(30) NOT NULL,
  `nazwisko` varchar(30) NOT NULL,
  `telefon` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `haslo` varchar(100) NOT NULL,
  `login` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pracownik`
--

CREATE TABLE `pracownik` (
  `id_pracownik` int(11) NOT NULL,
  `imie` varchar(30) NOT NULL,
  `nazwisko` varchar(30) NOT NULL,
  `telefon` varchar(15) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `miasto` varchar(50) NOT NULL,
  `ulica` varchar(30) NOT NULL,
  `nr_lokalu` varchar(10) NOT NULL,
  `login` varchar(50) NOT NULL,
  `haslo` varchar(100) NOT NULL,
  `typ_pracownika` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wyplata`
--

CREATE TABLE `wyplata` (
  `id_wyplata` int(11) NOT NULL,
  `kwota` decimal(7,2) NOT NULL,
  `id_instruktor` int(11) NOT NULL,
  `data_wyplaty` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

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
-- Indeksy dla tabeli `pracownik`
--
ALTER TABLE `pracownik`
  ADD PRIMARY KEY (`id_pracownik`);

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
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `kurs`
--
ALTER TABLE `kurs`
  MODIFY `id_kurs` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `kursant`
--
ALTER TABLE `kursant`
  MODIFY `id_kursant` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `lekcja`
--
ALTER TABLE `lekcja`
  MODIFY `id_lekcja` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `pracownik`
--
ALTER TABLE `pracownik`
  MODIFY `id_pracownik` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `samochod`
--
ALTER TABLE `samochod`
  MODIFY `id_samochod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `transakcja`
--
ALTER TABLE `transakcja`
  MODIFY `id_transakcja` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `wyplata`
--
ALTER TABLE `wyplata`
  MODIFY `id_wyplata` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `lekcja`
--
ALTER TABLE `lekcja`
  ADD CONSTRAINT `lekcja_ibfk_1` FOREIGN KEY (`id_kursant`) REFERENCES `kursant` (`id_kursant`),
  ADD CONSTRAINT `lekcja_ibfk_2` FOREIGN KEY (`id_instruktor`) REFERENCES `pracownik` (`id_pracownik`),
  ADD CONSTRAINT `lekcja_ibfk_3` FOREIGN KEY (`id_kurs`) REFERENCES `kurs` (`id_kurs`),
  ADD CONSTRAINT `lekcja_ibfk_4` FOREIGN KEY (`id_samochod`) REFERENCES `samochod` (`id_samochod`);

--
-- Ograniczenia dla tabeli `transakcja`
--
ALTER TABLE `transakcja`
  ADD CONSTRAINT `transakcja_ibfk_1` FOREIGN KEY (`id_kursant`) REFERENCES `kursant` (`id_kursant`),
  ADD CONSTRAINT `transakcja_ibfk_2` FOREIGN KEY (`id_kurs`) REFERENCES `kurs` (`id_kurs`);

--
-- Ograniczenia dla tabeli `wyplata`
--
ALTER TABLE `wyplata`
  ADD CONSTRAINT `wyplata_ibfk_1` FOREIGN KEY (`id_instruktor`) REFERENCES `pracownik` (`id_pracownik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
