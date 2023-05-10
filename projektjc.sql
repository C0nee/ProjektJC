-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 10 Maj 2023, 15:00
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `projektjc`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dislike`
--

CREATE TABLE `dislike` (
  `user_id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `dislike`
--

INSERT INTO `dislike` (`user_id`, `post_id`) VALUES
(14, 45),
(14, 45),
(14, 45);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `liked`
--

CREATE TABLE `liked` (
  `user_id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `liked`
--

INSERT INTO `liked` (`user_id`, `post_id`) VALUES
(12, 44),
(12, 45);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `post`
--

CREATE TABLE `post` (
  `ID` int(11) NOT NULL,
  `TimeStamp` datetime NOT NULL,
  `FileName` varchar(96) NOT NULL,
  `Tytuł` text NOT NULL,
  `userId` int(11) NOT NULL,
  `removed` tinyint(1) NOT NULL DEFAULT 0,
  `likes` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `post`
--

INSERT INTO `post` (`ID`, `TimeStamp`, `FileName`, `Tytuł`, `userId`, `removed`, `likes`) VALUES
(43, '2023-03-29 15:53:32', 'img/d8d81a38f30333af195c1c013bf43f6de6af1383266ab3fc47c002ba65eb805f.webp', '1', 11, 1, 0),
(44, '2023-04-19 14:11:01', 'img/adf5134a9953c05c9603dfe9e0e2921ac9e3c287aa0eef6ed528e5c3805265b2.webp', 'jaja', 12, 0, 1),
(45, '2023-04-19 14:54:06', 'img/b3de9836d613b3565c6a9b4d25343b285b4df79c116be85419e43a850dbf0bd4.webp', '123', 12, 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(11, 'penis@wp.pl', '$argon2i$v=19$m=65536,t=4,p=1$elJPNU96by4vekhwMnEvLw$sNRrAA6EzGiRjCHIoImT2KEjpz0TD6fTy2vMuLTz6p0'),
(12, 'jaja@wp.pl', '$argon2i$v=19$m=65536,t=4,p=1$SGNuTXc5aUZIM1NNcHBQYg$Z1A2f+DLsbVbuixNWIYJY7EjGSBQNdLQwx5z2/LXyqI'),
(13, '1@w.pl', '$argon2i$v=19$m=65536,t=4,p=1$VjJlTzRsSW9jNnN0Y1FPRg$RhZB9mVc046c3w2JXJ6BejY8gQiBF1pwB6FdHIItb0Q'),
(14, 'op@odtylu', '$argon2i$v=19$m=65536,t=4,p=1$R1gwd29kWnJ0N1FsanYueA$c/PIUDW6a/P/31jZICiUoWXjwr3dZkFCs9SPTf/rn6A'),
(15, 'u@wp.pl', '$argon2i$v=19$m=65536,t=4,p=1$UEFPOEMvUmJwTDRQdHdnSw$oMzIyDTvLP5h0IxXptXVxkis7hrPivmcqbclX5yQjhk'),
(16, 'upo@wp.pl', '$argon2i$v=19$m=65536,t=4,p=1$UlNvWS92Qm05RXVBOTVKYw$pbOIKvfaEsvJlj0pqF5zae1g+rlDC2EBTfVXoSKOHVM');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `post`
--
ALTER TABLE `post`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
