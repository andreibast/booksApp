-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: mart. 24, 2021 la 07:44 PM
-- Versiune server: 10.4.17-MariaDB
-- Versiune PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `books.app`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `books`
--

CREATE TABLE `books` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `authors` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `books`
--

INSERT INTO `books` (`id`, `title`, `authors`, `category`, `picture`, `description`, `date_added`) VALUES
(23, 'gsdgdsgdgggg', '', '', '150x212.png', '', '2021-03-23 20:30:02'),
(25, 'asfasfhh', 'tttt', '', '150x212.png', '', '2021-03-24 17:49:52'),
(26, 'fasfsfff', 'dgdgd', '', '150x212.png', '', '2021-03-24 18:15:22'),
(29, 'fff', '', '', '150x212.png', '', '2021-03-24 18:20:56');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `prenume` varchar(50) NOT NULL,
  `email` varchar(55) NOT NULL,
  `parola` varchar(255) NOT NULL,
  `data_adaugare` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `prenume`, `email`, `parola`, `data_adaugare`) VALUES
(1, 'andrei', 'andreibast@sds.com', '12345678', '2021-02-17 16:42:34'),
(2, 'test', 'test@test.com', '1234', '2021-02-17 19:54:25'),
(3, 'test2', 'test2@test.com', '4321', '2021-02-17 19:55:51'),
(11, 'fasf', 'safasfas!@fsafs.fs', '123456', '2021-02-19 13:48:26'),
(31, 'dghsfhfd', 'qwer@gdsgd.df', '$2y$10$akLUw41qAygFiosV8r0fSOJAbt3x66WPe0ZNs6/sjkOtF6OOWCvzm', '2021-02-26 16:01:31'),
(32, 'fdjhndfjd', 'drtyeryrey@gsgd.df', '$2y$10$.KEyhZh0RZHRBpcuJon5seSxvaDuhKiVeyjyghfuYpJakirV94n42', '2021-02-26 16:28:19'),
(58, 'gsdgdsg', 'dsgdsg@dfgdf.df', '$2y$10$E0QZIix6T/RjKn03Wghf/Oo7EcLJACyjPhmLccqkKirXFOS1/d3hK', '2021-03-13 18:24:51'),
(59, 'gdsagasd', 'sdgdsg@dfdf.df', '$2y$10$NK75DL7FGuY1TMFCSNno5u3LOJet2Y6nIyw4peoo.S1ULce6DS5hm', '2021-03-13 18:44:54'),
(60, 'sdgsdgsd', 'fsddsfd.sd@ddfd.df', '$2y$10$.U9LcUQpyQpxE/PTlTD71ehu7pTYp6l0uT2qBxlapn664NzvYfCOq', '2021-03-13 23:19:43'),
(61, 'dgasdfasf', 'asfsafas@dfd.df', '$2y$10$a3ZUcmpEzcCwERGQm/i4Zu3L4cfIabYiDh8Fv2qq4BGknfKqlq9Rm', '2021-03-13 23:32:07'),
(62, 'sgsdfgsdf', 'asfasf@dfs.sd', '$2y$10$IetzM8va4Cn4cIqGZlMUre29164IJOpwXm9Dc1fmgGsJH75BN3bLq', '2021-03-13 23:32:29'),
(63, 'fsafasfad', 'asds@dsdsds.ss', '$2y$10$VQDsf/alK/1HIYhbEDG8neTYdtwUCG0Nrte4YLnx7/0eykz768vum', '2021-03-13 23:57:32'),
(64, 'DSGSDGSD', 'gfdsfdsf@dffd.df', '$2y$10$3I7UAOD/RhhzmDYV1jVWI.6XTeHrbHaQfbmExFzLxti9bC85JovAK', '2021-03-14 00:08:58'),
(65, 'asfasdf', 'asfasfsa@dsfdf.df', '$2y$10$kPrFjMwGQOBZQ.IGoFKK6.0Cmq8PT7phik1s8.ChPiENPcziqTaPC', '2021-03-14 00:11:10'),
(66, 'afssafsaf', 'asfasfsa@sdff.df', '$2y$10$.fgIcCi0cdPSCzrcQEOdbeFXFKOY2r0w4496AGXWv/ZiwtAyisYHG', '2021-03-14 00:15:32'),
(67, 'sdgsdf', 'sfsdfdsf@dfdf.df', '$2y$10$.AkgEEtei6edz7YxMj5lm.PbHyatVq/c/.DmwlyTGw43zR7nINWte', '2021-03-14 00:15:47');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `books`
--
ALTER TABLE `books`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pentru tabele `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
