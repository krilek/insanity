-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 18 Cze 2017, 22:24
-- Wersja serwera: 10.1.21-MariaDB
-- Wersja PHP: 7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `ogloszenia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `emaile`
--

CREATE TABLE `emaile` (
  `ID` int(11) NOT NULL,
  `Email` varchar(250) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci ROW_FORMAT=COMPACT;

--
-- Zrzut danych tabeli `emaile`
--

INSERT INTO `emaile` (`ID`, `Email`) VALUES
(4, 'kriilek@gmail.com'),
(3, 'krilek@gmail.com'),
(5, 'ulcia6@interia.eu'),
(6, 'ulcifa6@interia.eu');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `emailtokeny`
--

CREATE TABLE `emailtokeny` (
  `ID` int(11) NOT NULL,
  `Login` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `Hash` char(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `hasla`
--

CREATE TABLE `hasla` (
  `ID` int(11) NOT NULL,
  `Hash` char(60) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci ROW_FORMAT=COMPACT;

--
-- Zrzut danych tabeli `hasla`
--

INSERT INTO `hasla` (`ID`, `Hash`) VALUES
(3, '$2y$10$ZTK24WNI3PXKhmF7kh681Oq1bGJ9edjLlNTHFyJmOzUwyHPBEup8y'),
(4, '$2y$10$0CGdiOanrgg9wrLt7xqewedCDtR./Mw/c5CwnsfvaS2L7qZLQdNNa'),
(5, '$2y$10$DqiI3ba8az.mVFA5AiZhm.yY4YgLocDZvefckBQn4AyDULf61CS8S'),
(6, '$2y$10$xgdM4FdUVC.I6kAYXXJNjeFkmeWBQw/d3/i/J5nvWBPLfBf/MtnxK');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `miasta`
--

CREATE TABLE `miasta` (
  `ID` int(11) NOT NULL,
  `Woj` int(2) NOT NULL,
  `Nazwa` varchar(100) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `miasta`
--

INSERT INTO `miasta` (`ID`, `Woj`, `Nazwa`) VALUES
(3, 12, 'Częstochowa');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `ID` int(11) NOT NULL,
  `Login` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `Imie` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `Nazwisko` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `Wojewodztwo` int(3) NOT NULL,
  `Miejscowosc` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `Plec` varchar(2) COLLATE utf8_polish_ci NOT NULL,
  `Typ` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci ROW_FORMAT=COMPACT;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`ID`, `Login`, `Imie`, `Nazwisko`, `Wojewodztwo`, `Miejscowosc`, `Plec`, `Typ`) VALUES
(3, 'krilek', 'Karol', 'Gzik', 1, 'Częstochowa', 'K', 1),
(4, 'kriilek', 'Karol', 'Gzik', 1, 'Częstochowa', 'K', 1),
(5, 'ulcia6', 'Urszula', 'Frukacz', 1, 'Częstochowa', 'K', 1),
(6, 'ulcia6f', 'Urszula', 'Frukacz', 1, 'Częstochowa', 'K', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicyrejestracja`
--

CREATE TABLE `uzytkownicyrejestracja` (
  `ID` int(11) NOT NULL,
  `Login` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `Email` varchar(256) COLLATE utf8_polish_ci NOT NULL,
  `HasloHash` char(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `TokenHash` char(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Imie` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `Nazwisko` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `Wojewodztwo` int(3) NOT NULL,
  `Miejscowosc` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `Plec` varchar(2) COLLATE utf8_polish_ci NOT NULL,
  `Typ` int(2) NOT NULL,
  `Data` datetime NOT NULL,
  `Dodano` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci ROW_FORMAT=COMPACT;

--
-- Zrzut danych tabeli `uzytkownicyrejestracja`
--

INSERT INTO `uzytkownicyrejestracja` (`ID`, `Login`, `Email`, `HasloHash`, `TokenHash`, `Imie`, `Nazwisko`, `Wojewodztwo`, `Miejscowosc`, `Plec`, `Typ`, `Data`, `Dodano`) VALUES
(18, 'krilek', 'krilek@gmail.com', '$2y$10$ZTK24WNI3PXKhmF7kh681Oq1bGJ9edjLlNTHFyJmOzUwyHPBEup8y', 'dab1263d1e6a88c9ba5e7e294def5e8b', 'Karol', 'Gzik', 1, 'Częstochowa', 'K', 1, '2017-06-18 13:15:43', 1),
(19, 'kriilek', 'kriilek@gmail.com', '$2y$10$0CGdiOanrgg9wrLt7xqewedCDtR./Mw/c5CwnsfvaS2L7qZLQdNNa', 'c3c59e5f8b3e9753913f4d435b53c308', 'Karol', 'Gzik', 1, 'Częstochowa', 'K', 1, '2017-06-18 13:23:12', 1),
(20, 'ulcia6', 'ulcia6@interia.eu', '$2y$10$DqiI3ba8az.mVFA5AiZhm.yY4YgLocDZvefckBQn4AyDULf61CS8S', '72e0ac3a885b78926065a979b6a46206', 'Urszula', 'Frukacz', 1, 'Częstochowa', 'K', 1, '2017-06-18 13:53:26', 1),
(21, 'ulcia6f', 'ulcifa6@interia.eu', '$2y$10$xgdM4FdUVC.I6kAYXXJNjeFkmeWBQw/d3/i/J5nvWBPLfBf/MtnxK', 'e3b6fb0fd4df098162eede3313c54a8d', 'Urszula', 'Frukacz', 1, 'Częstochowa', 'K', 1, '2017-06-18 13:56:53', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wojewodztwa`
--

CREATE TABLE `wojewodztwa` (
  `ID` int(2) NOT NULL,
  `Nazwa` char(25) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `wojewodztwa`
--

INSERT INTO `wojewodztwa` (`ID`, `Nazwa`) VALUES
(1, 'Dolnośląskie'),
(2, 'Kujawsko-pomorskie'),
(3, 'Lubelskie'),
(4, 'Lubuskie'),
(5, 'Łódzkie'),
(6, 'Małopolskie'),
(7, 'Mazowieckie'),
(8, 'Opolskie'),
(9, 'Podkarpackie'),
(10, 'Podlaskie'),
(11, 'Pomorskie'),
(12, 'Śląskie'),
(13, 'Świętokrzyskie'),
(14, 'Warmińsko-mazurskie'),
(15, 'Wielkopolskie'),
(16, 'Zachodniopomorskie');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `emaile`
--
ALTER TABLE `emaile`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `emailtokeny`
--
ALTER TABLE `emailtokeny`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hasla`
--
ALTER TABLE `hasla`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `miasta`
--
ALTER TABLE `miasta`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `wojewodztwo` (`Woj`);

--
-- Indexes for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Login` (`Login`),
  ADD KEY `wojewodztwa` (`Wojewodztwo`),
  ADD KEY `plec` (`Plec`);

--
-- Indexes for table `uzytkownicyrejestracja`
--
ALTER TABLE `uzytkownicyrejestracja`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `wojewodztwa` (`Wojewodztwo`);

--
-- Indexes for table `wojewodztwa`
--
ALTER TABLE `wojewodztwa`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `emaile`
--
ALTER TABLE `emaile`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT dla tabeli `hasla`
--
ALTER TABLE `hasla`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT dla tabeli `miasta`
--
ALTER TABLE `miasta`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT dla tabeli `uzytkownicyrejestracja`
--
ALTER TABLE `uzytkownicyrejestracja`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT dla tabeli `wojewodztwa`
--
ALTER TABLE `wojewodztwa`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `miasta`
--
ALTER TABLE `miasta`
  ADD CONSTRAINT `miasta_ibfk_1` FOREIGN KEY (`Woj`) REFERENCES `wojewodztwa` (`ID`);

--
-- Ograniczenia dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD CONSTRAINT `emaile` FOREIGN KEY (`ID`) REFERENCES `emaile` (`ID`),
  ADD CONSTRAINT `hasla` FOREIGN KEY (`ID`) REFERENCES `hasla` (`ID`),
  ADD CONSTRAINT `wojewodztwa` FOREIGN KEY (`Wojewodztwo`) REFERENCES `wojewodztwa` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
