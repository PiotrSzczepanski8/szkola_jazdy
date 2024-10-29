-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Paź 29, 2024 at 09:26 AM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.1.17

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
-- Struktura tabeli dla tabeli `kurs`
--

CREATE TABLE `kurs` (
  `id_kurs` int(11) NOT NULL,
  `kategoria` varchar(4) DEFAULT NULL,
  `opis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kurs`
--

INSERT INTO `kurs` (`id_kurs`, `kategoria`, `opis`) VALUES
(1, 'A', 'Dzięki temu rodzajowi prawa jazdy będziesz mógł poruszać się każdym jednośladem bez względu na pojemność czy moc silnika'),
(2, 'B', 'Prawo jazdy kategorii B pozwoli Ci prowadzić samochody osobowe, minibusy i kempingi.'),
(3, 'C', 'Kategoria C jest dla Ciebie jeśli chcesz prowadzić samochody ciężarowe'),
(4, 'D', 'Dzieki kategorii D będziesz mógł prowadzić autobusy.'),
(5, 'B+E', 'B+E to rozszerzenie kategorii B, które pozwala na prowadzenie pojazdów o większej ładowności.'),
(6, 'C+E', 'Kategoria C+E to rozszerzenie kategorii C, które pozwala Ci prowadzić zespół pojazdów bez żadnych limitów wagowych.'),
(7, 'D+E', 'Dzięki temu rozszerzeniu kategorii D, możesz prowadzić autobusy z przyczepą bez ograniczeń tonażowych.'),
(8, 'A1', 'Dzięki temu rodzajowi prawa jazdy będziesz mógł prowadzić jednoślad, jednak o mniejszej mocy i pojemności silnika niż w kategorii A.'),
(9, 'B1', 'Kategoria B1 uprawnia Cię do kierowania małym samochodem osobowym rozpędzającym się do 100km/h.'),
(10, 'C1', 'Prawo jazdy kategorii C1 uprawnia Cię do kierowania pojazdami ciężarowymi, których waga nie przekracza 7,5 tony.'),
(11, 'D1', 'Prawo jazdy ketegorii D1 pozwala Ci prowadzić autobusy o długości do 8 metrów'),
(12, 'C1+E', 'Kategoria C1+E uprawnia Cię do kierowania mniejszymi ciężarówkami z przyczepą.'),
(13, 'D1+E', 'Kategoria D1+E uprawnia Cię do kierowania zespołem pojazdów (pojazd ciągnący i przyczepa) o wadze nie przekraczającej 12t.'),
(14, 'T', 'Kategoria T uprawnia Cię do kierowania traktorem.');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kurs`
--
ALTER TABLE `kurs`
  MODIFY `id_kurs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
-- AUTO_INCREMENT for table `pracownik`
--
ALTER TABLE `pracownik`
  MODIFY `id_pracownik` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `lekcja_ibfk_2` FOREIGN KEY (`id_instruktor`) REFERENCES `pracownik` (`id_pracownik`),
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
  ADD CONSTRAINT `wyplata_ibfk_1` FOREIGN KEY (`id_instruktor`) REFERENCES `pracownik` (`id_pracownik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
