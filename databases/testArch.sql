-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 10 Mar 2022, 19:24
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `testArch`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `admin`
--

INSERT INTO `admin` (`id`, `login`, `password`) VALUES
(1, 'admin', 'root123');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `Imie` varchar(255) NOT NULL,
  `Nazwisko` varchar(255) NOT NULL,
  `Klasa` varchar(2) NOT NULL,
  `Profil` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `Imie`, `Nazwisko`, `Klasa`, `Profil`) VALUES
(2, 'Wiktor', 'Kusztykiewicz', '3b', 'Grafika'),
(3, 'Michał', 'Śmieszniak', '3b', 'Grafika'),
(14, 'Ola', 'Kelner', '3b', 'Grafika'),
(19, 'Borys', 'Spulikowski', '3b', 'Informatyka'),
(20, 'Antoni', 'Walburg', '3a', 'Informatyka'),
(21, 'Stefan', 'Szymanowski', '3b', 'Grafika'),
(23, 'Piotr', 'Kolodziej', '3b', 'Grafika'),
(24, 'Igor', 'Jaworski', '3b', 'Grafika komputerowa'),
(26, 'Jan', 'Kolodziej', '3b', 'Informatyka'),
(27, 'Jan', 'Nowak', '3b', 'Informatyka');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_works`
--

CREATE TABLE `user_works` (
  `id` int(255) NOT NULL,
  `id_user` int(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `work_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `user_works`
--

INSERT INTO `user_works` (`id`, `id_user`, `file_name`, `work_name`, `category`, `description`, `date`) VALUES
(69, 20, 'msbhv.jpg', 'test', 'Grafika', 'test opis', '2022-03-09 15:19:14'),
(70, 3, 'Zrzut ekranu 2022-02-28 o 14.19.38.png', 'test', 'Animacja', 'test', '2022-03-10 09:35:56'),
(76, 26, 'msbhv.jpg', 'msbhv', 'Inne', 'msbhv', '2022-03-10 17:16:13'),
(77, 26, 'Zrzut ekranu 2022-03-10 o 15.14.06.png', 'test', 'Inne', 'test opis', '2022-03-10 17:18:30');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `user_works`
--
ALTER TABLE `user_works`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT dla tabeli `user_works`
--
ALTER TABLE `user_works`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `user_works`
--
ALTER TABLE `user_works`
  ADD CONSTRAINT `user_works_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
