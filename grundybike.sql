-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Počítač: localhost
-- Vytvořeno: Čtv 13. dub 2017, 11:21
-- Verze serveru: 5.7.17-0ubuntu0.16.04.1
-- Verze PHP: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `grundybike`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `count_round` int(11) NOT NULL,
  `min_time` time NOT NULL,
  `start_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `category`
--

INSERT INTO `category` (`id`, `name`, `count_round`, `min_time`, `start_time`) VALUES
(1, '*******', 50, '00:00:00', '00:00:00'),
(2, 'aslfkjasldkfjasldfjalsdf', 0, '13:33:25', '13:00:00'),
(3, 'Pokus jedna', 10, '00:08:00', '00:00:00'),
(4, '////////////////////////', 0, '00:00:00', '00:00:00'),
(50, 'adsfdsfasdfsdfa', 0, '00:00:00', '00:00:00'),
(51, 'adsfdsfasdfsdfa', 0, '00:00:00', '00:00:00'),
(58, 'adsfdsfasdfsdfa', 0, '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Struktura tabulky `round`
--

CREATE TABLE `round` (
  `id` int(11) NOT NULL,
  `time` time NOT NULL,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birth_year` int(11) NOT NULL,
  `start_number` int(11) NOT NULL,
  `start_time` time DEFAULT NULL,
  `finish_time` time DEFAULT NULL,
  `countRound` int(11) NOT NULL DEFAULT '0',
  `diff` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `user`
--

INSERT INTO `user` (`id`, `category`, `first_name`, `last_name`, `birth_year`, `start_number`, `start_time`, `finish_time`, `countRound`, `diff`) VALUES
(301, 1, 'Matěj', 'Hloušek', 1667, 25, '01:08:23', '06:00:00', 50, 0),
(302, 1, 'Matěj', 'Hloušek', 1667, 25, '01:08:23', '00:25:00', 50, 0),
(303, 1, 'Pokus', 'Hloušek', 1667, 25, '01:08:23', NULL, 50, 0),
(304, 1, 'Matěj', 'Hloušek', 1667, 25, '01:08:23', '06:00:00', 50, 0),
(305, 1, 'Matěj', 'Hloušek', 1667, 25, '01:08:23', NULL, 50, 0),
(306, 1, 'Matěj', 'Hloušek', 1667, 25, '01:08:23', NULL, 50, 0);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `round`
--
ALTER TABLE `round`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C5EEEA34FE6E88D7` (`idUser`);

--
-- Klíče pro tabulku `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8D93D64964C19C1` (`category`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT pro tabulku `round`
--
ALTER TABLE `round`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=727;
--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `round`
--
ALTER TABLE `round`
  ADD CONSTRAINT `FK_C5EEEA34FE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`);

--
-- Omezení pro tabulku `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D64964C19C1` FOREIGN KEY (`category`) REFERENCES `category` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
