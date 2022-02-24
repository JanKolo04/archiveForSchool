-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 24 Lut 2022, 17:25
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
-- Struktura tabeli dla tabeli `user_works`
--

CREATE TABLE `user_works` (
  `id` int(255) NOT NULL,
  `Imie` varchar(255) DEFAULT NULL,
  `Nazwisko` varchar(255) DEFAULT NULL,
  `Klasa` varchar(2) DEFAULT NULL,
  `id_user` int(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `Profil` varchar(255) DEFAULT NULL,
  `work_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `user_works`
--

INSERT INTO `user_works` (`id`, `Imie`, `Nazwisko`, `Klasa`, `id_user`, `file_name`, `Profil`, `work_name`, `description`) VALUES
(17, 'Jan', 'Kolodziej', '3b', 1, 'msbhv.jpg', 'Grafika', 'msbhv', 'diamenty na bluze'),
(22, 'Wiktor', 'Kusztykiewicz', '3b', 2, 'msbhv.jpg', 'Grafika', 'msbhv', 'nadruk na bluze'),
(37, 'Jan', 'Kolodziej', '3b', 1, 'BiedoMockup Wyszukiwarek.png', 'Grafika', 'test', 'test2'),
(39, 'Ola', 'Kelner', '3b', 14, 'mockup podglad.png', 'Grafika', 'podglad', 'podglad opis'),
(40, 'Antoni', 'Walburg', '3a', 20, 'BiedoMockup Wyszukiwarek.png', 'Informatyka', 'wyszukiwarka', 'mockup wyszukiwarki'),
(41, 'Ola', 'Kelner', '3b', 14, 'mockup strony glownej.png', 'Grafika', 'strona glowna', 'mockup strony glownej'),
(42, 'Borys', 'Spulikowski', '3b', 19, 'uploadFile.png', 'Informatyka', 'przesylanie plikow', 'mockup przesylania plikow');

--
-- Indeksy dla zrzutów tabel
--

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
-- AUTO_INCREMENT dla tabeli `user_works`
--
ALTER TABLE `user_works`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

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
