-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 23, 2017 at 12:01 PM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `grundybike`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `count_round` int(11) NOT NULL,
  `min_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `count_round`, `min_time`) VALUES
(1, 'senioři', 5, '00:00:01'),
(2, 'Junioři', 6, '00:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `name` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `date` date NOT NULL,
  `adress` varchar(150) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`name`, `date`, `adress`) VALUES
('Grundy Bike', '2017-07-02', 'Grundy v neplachovicích');

-- --------------------------------------------------------

--
-- Table structure for table `round`
--

CREATE TABLE `round` (
  `id` int(11) NOT NULL,
  `time` time NOT NULL,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `round`
--

INSERT INTO `round` (`id`, `time`, `idUser`) VALUES
(143, '00:00:06', 308),
(144, '00:00:07', 307),
(145, '00:00:09', 309),
(146, '00:00:06', 308),
(147, '00:00:08', 307),
(148, '00:00:09', 309),
(149, '00:00:03', 309),
(150, '00:00:12', 308),
(151, '00:00:12', 307),
(152, '00:00:09', 309),
(153, '00:00:07', 308),
(154, '00:00:05', 307),
(155, '00:00:03', 309),
(156, '00:00:03', 308),
(157, '00:00:03', 307);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birth_year` int(11) NOT NULL,
  `start_number` int(11) NOT NULL,
  `start_time` time DEFAULT NULL,
  `round_time` time DEFAULT NULL,
  `finish_time` time DEFAULT NULL,
  `countRound` int(11) NOT NULL DEFAULT '0',
  `chacked` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `category`, `first_name`, `last_name`, `birth_year`, `start_number`, `start_time`, `round_time`, `finish_time`, `countRound`, `chacked`) VALUES
(307, 1, 'Ondra', 'Čech', 2000, 6, '21:09:25', '21:10:00', '21:10:00', 0, 1),
(308, 1, 'Honza', 'Malý', 1972, 9, '21:09:25', '21:09:59', '21:09:59', 0, 0),
(309, 1, 'Ferda', 'Wertich', 1986, 666, '21:09:25', '21:09:58', '21:09:58', 0, 1),
(399, 2, 'Matěj', 'Hlousek', 1998, 25, NULL, NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `userRegistrated`
--

CREATE TABLE `userRegistrated` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_czech_ci NOT NULL,
  `password` varchar(150) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `userRegistrated`
--

INSERT INTO `userRegistrated` (`id`, `name`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'pokus', 'pokus'),
(3, 'pokusdva', 'pokusdva');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`name`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `round`
--
ALTER TABLE `round`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C5EEEA34FE6E88D7` (`idUser`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8D93D64964C19C1` (`category`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `userRegistrated`
--
ALTER TABLE `userRegistrated`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `round`
--
ALTER TABLE `round`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=400;
--
-- AUTO_INCREMENT for table `userRegistrated`
--
ALTER TABLE `userRegistrated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `round`
--
ALTER TABLE `round`
  ADD CONSTRAINT `FK_C5EEEA34FE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D64964C19C1` FOREIGN KEY (`category`) REFERENCES `category` (`id`);
