-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
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
CREATE DATABASE IF NOT EXISTS `szkola_jazdy` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `szkola_jazdy`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kurs`
--

CREATE TABLE `kurs` (
  `id_kurs` int(11) NOT NULL,
  `kategoria` varchar(4) DEFAULT NULL,
  `opis` text NOT NULL,
  `cena` decimal(6,2) NOT NULL,
  `h_praktyka` int(11) DEFAULT NULL,
  `h_teoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `kurs`
--

INSERT INTO `kurs` (`id_kurs`, `kategoria`, `opis`, `cena`, `h_praktyka`, `h_teoria`) VALUES
(1, 'A', 'Dzięki temu rodzajowi prawa jazdy będziesz mógł poruszać się każdym jednośladem bez względu na pojemność czy moc silnika', '2999.99', 20, 30),
(2, 'B', 'Prawo jazdy kategorii B pozwoli Ci prowadzić samochody osobowe, minibusy i kempingi.', '2499.99', 30, 30),
(3, 'C', 'Kategoria C jest dla Ciebie jeśli chcesz prowadzić samochody ciężarowe', '5499.99', 25, 20),
(4, 'D', 'Dzieki kategorii D będziesz mógł prowadzić autobusy.', '7499.99', 60, 20),
(5, 'B+E', 'B+E to rozszerzenie kategorii B, które pozwala na prowadzenie pojazdów o większej ładowności.', '1999.99', 15, 0),
(6, 'C+E', 'Kategoria C+E to rozszerzenie kategorii C, które pozwala Ci prowadzić zespół pojazdów bez żadnych limitów wagowych.', '6499.99', 25, 0),
(7, 'D+E', 'Dzięki temu rozszerzeniu kategorii D, możesz prowadzić autobusy z przyczepą bez ograniczeń tonażowych.', '8999.99', 30, 0),
(8, 'A1', 'Dzięki temu rodzajowi prawa jazdy będziesz mógł prowadzić jednoślad, jednak o mniejszej mocy i pojemności silnika niż w kategorii A.', '2499.99', 15, 30),
(9, 'B1', 'Kategoria B1 uprawnia Cię do kierowania małym samochodem osobowym rozpędzającym się do 100km/h.', '1999.99', 20, 30),
(10, 'C1', 'Prawo jazdy kategorii C1 uprawnia Cię do kierowania pojazdami ciężarowymi, których waga nie przekracza 7,5 tony.', '3999.99', 20, 20),
(11, 'D1', 'Prawo jazdy ketegorii D1 pozwala Ci prowadzić autobusy o długości do 8 metrów', '5999.99', 40, 20),
(12, 'C1+E', 'Kategoria C1+E uprawnia Cię do kierowania mniejszymi ciężarówkami z przyczepą.', '4499.99', 20, 0),
(13, 'D1+E', 'Kategoria D1+E uprawnia Cię do kierowania zespołem pojazdów (pojazd ciągnący i przyczepa) o wadze nie przekraczającej 12t.', '5999.99', 25, 0),
(14, 'T', 'Kategoria T uprawnia Cię do kierowania traktorem.', '2999.99', 20, 20);

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

--
-- Zrzut danych tabeli `kursant`
--

INSERT INTO `kursant` (`id_kursant`, `imie`, `nazwisko`, `telefon`, `email`, `haslo`, `login`) VALUES
(1, 'Marek', 'Rurka', '+48 517 899 345', 'marek@rurka.pl', 'Marek123', 'marekrurka'),
(2, 'Karolina', 'Fryderyk', '+90 000 000 000', 'karolinka@chopin.pl', 'Karolina12345678!', 'aaaa'),
(3, 'Marcin', 'Ciężczak', '+48 788 788 999', 'marcinekuwu123@p.pl', 'Marcin123#', 'marcinek'),
(4, 'Pan', 'Piotr', '+48 696 696 696', 'panpiotr@piotr.pl', 'PanPiotr678190%$', 'panpiotr1'),
(5, 'Krzysztof', 'Szorek', '+48 789 456 190', 'krzysiu@s.pl', 'SZorkowniscy678345', 'krzysiu');

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
  `typ_lekcji` enum('teoria','praktyka') NOT NULL
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

--
-- Zrzut danych tabeli `pracownik`
--

INSERT INTO `pracownik` (`id_pracownik`, `imie`, `nazwisko`, `telefon`, `email`, `miasto`, `ulica`, `nr_lokalu`, `login`, `haslo`, `typ_pracownika`) VALUES
(1, 'Karol', 'Robak', '48+ 667 887 123', 'karolrobak112@rak.pl', 'Kraków', 'Wodna', '7', 'admin', 'trudneHaslo123#', 'admin'),
(2, 'Marta', 'Koralowa', '48+ 567 874 123', 'martakoralowa@koral.pl', 'Poznań', 'Rolnicza', '9', 'in_marta.k', 'kochamPieskiUwU', 'instruktor'),
(3, 'Kamil', 'Ślimak', '+48 934 567 999', 'kamil@slimak.palindrom.pl', 'Rybnik', 'Koziołkowska', '37', 'kamilślimak', 'jestemWolny!', 'instruktor'),
(4, 'Barbara', 'Grom', '+48 567 321 123', 'basiagrom@gmail.com', 'Warszawa', 'Długa', '19/4', 'baśkaInstruktorka', 'Pimpuś2019!', 'instruktor'),
(5, 'Krzysztof', 'Rączka', '+48 876 871 002', 'pan@krzysztof.pl', 'Mikołów', 'Robotnicza', '7/8', 'krzy88', 'krzysiuMisiu88', 'instruktor');

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

--
-- Zrzut danych tabeli `samochod`
--

INSERT INTO `samochod` (`id_samochod`, `marka`, `model`, `numer_rejestracyjny`, `stan`) VALUES
(1, 'Toyota', 'Yaris', 'SG9978A', 'dostępny');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `transakcja`
--

CREATE TABLE `transakcja` (
  `id_transakcja` int(11) NOT NULL,
  `id_kursant` int(11) DEFAULT NULL,
  `id_kurs` int(11) DEFAULT NULL,
  `data_transakcji` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `transakcja`
--

INSERT INTO `transakcja` (`id_transakcja`, `id_kursant`, `id_kurs`, `data_transakcji`) VALUES
(1, 1, 3, '2024-10-31'),
(2, 1, 4, '2024-11-07');

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
  MODIFY `id_kurs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `kursant`
--
ALTER TABLE `kursant`
  MODIFY `id_kursant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `lekcja`
--
ALTER TABLE `lekcja`
  MODIFY `id_lekcja` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `pracownik`
--
ALTER TABLE `pracownik`
  MODIFY `id_pracownik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `samochod`
--
ALTER TABLE `samochod`
  MODIFY `id_samochod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `transakcja`
--
ALTER TABLE `transakcja`
  MODIFY `id_transakcja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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