-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Feb 11. 08:08
-- Kiszolgáló verziója: 10.4.14-MariaDB
-- PHP verzió: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `c31h202121`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `admin`
--

CREATE TABLE `admin` (
  `uid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `admin`
--

INSERT INTO `admin` (`uid`) VALUES
(2330);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `bookmarks`
--

CREATE TABLE `bookmarks` (
  `uid` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `time_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `bookmarks`
--

INSERT INTO `bookmarks` (`uid`, `post_id`, `time_added`) VALUES
(2331, 1293, '2022-02-10 11:32:20');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(255) NOT NULL,
  `uid` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `text` text COLLATE utf8_hungarian_ci NOT NULL,
  `time_commented` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `post`
--

CREATE TABLE `post` (
  `post_id` int(255) NOT NULL,
  `uid` int(255) NOT NULL,
  `title` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `bookmark_count` int(255) NOT NULL DEFAULT 0,
  `comment_count` int(255) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `visible` tinyint(1) NOT NULL DEFAULT 1,
  `type` varchar(15) COLLATE utf8_hungarian_ci NOT NULL DEFAULT 'image/png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `post`
--

INSERT INTO `post` (`post_id`, `uid`, `title`, `bookmark_count`, `comment_count`, `timestamp`, `visible`, `type`) VALUES
(1291, 2330, 'athen', 0, 0, '2022-02-03 07:09:19', 1, 'image/jpg'),
(1292, 2330, 'Athen1', 0, 0, '2022-02-03 08:04:24', 1, 'image/jpg'),
(1293, 2330, 'roka', 1, 0, '2022-02-03 08:26:29', 1, 'image/jpg'),
(1294, 2330, 'Athen3', 0, 0, '2022-02-03 10:05:57', 1, 'image/jpg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE `user` (
  `uid` int(255) NOT NULL,
  `username` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_hungarian_ci NOT NULL,
  `level` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`uid`, `username`, `email`, `password`, `level`) VALUES
(2330, 'test', 'test@fake.com', '202cb962ac59075b964b07152d234b70', 1),
(2331, 'random', 'random@fake.com', '250cf8b51c773f3f8dc8b4be867a9a02', 1);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `admin`
--
ALTER TABLE `admin`
  ADD KEY `uid` (`uid`);

--
-- A tábla indexei `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD KEY `uid` (`uid`),
  ADD KEY `post_id` (`post_id`);

--
-- A tábla indexei `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `post_id` (`post_id`);

--
-- A tábla indexei `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `uid` (`uid`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=424;

--
-- AUTO_INCREMENT a táblához `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1304;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2332;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookmarks_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;