-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Már 09. 11:39
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
(2331, 1293, '2022-02-14 09:18:43'),
(2331, 1306, '2022-02-14 10:07:41'),
(2330, 1306, '2022-02-14 11:38:00'),
(2331, 1332, '2022-02-24 10:23:21'),
(2331, 1326, '2022-02-24 10:23:26'),
(2331, 1325, '2022-02-24 10:23:31'),
(2331, 1329, '2022-02-24 10:23:58'),
(2331, 1324, '2022-02-24 10:44:45'),
(2330, 1333, '2022-03-07 10:26:07'),
(2331, 1334, '2022-03-07 10:31:08');

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

--
-- A tábla adatainak kiíratása `comment`
--

INSERT INTO `comment` (`comment_id`, `uid`, `post_id`, `text`, `time_commented`) VALUES
(427, 2331, 1293, 'asdwd', '2022-02-14'),
(428, 2331, 1293, 'asd', '2022-02-14'),
(429, 2331, 1293, 'asf', '2022-02-14'),
(430, 2331, 1293, 'ad', '2022-02-14'),
(431, 2331, 1293, 'awgegh', '2022-02-14'),
(432, 2331, 1293, 't', '2022-02-14'),
(433, 2331, 1293, 'asd', '2022-02-14'),
(435, 2331, 1329, '&lt;b&gt;Test&lt;/b&gt;', '2022-02-24'),
(436, 2331, 1329, '&lt;a href=&quot;index.php&quot;&gt;Test&lt;/a&gt;', '2022-02-24');

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
(1293, 2330, 'roka', 1, 7, '2022-02-03 08:26:29', 1, 'image/jpg'),
(1306, 2331, 'first video test', 2, 0, '2022-02-14 08:45:06', 1, 'video/mp4'),
(1324, 2331, 'athen2', 1, 0, '2022-02-16 10:11:52', 1, 'image/jpg'),
(1325, 2331, 'Athen6', 1, 0, '2022-02-16 10:12:02', 1, 'image/jpg'),
(1326, 2331, 'delfinek', 1, 0, '2022-02-22 07:50:51', 1, 'image/jpg'),
(1329, 2331, 'TV', 1, 2, '2022-02-22 07:51:25', 1, 'image/jpg'),
(1332, 2330, 'delfin', 1, 0, '2022-02-23 09:32:58', 1, 'image/jpg'),
(1333, 2330, 'private post', 1, 0, '2022-02-23 09:53:19', 0, 'image/png'),
(1334, 2331, 'private post 2', 1, 0, '2022-03-07 09:09:51', 0, 'image/png');

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
(2331, 'normal', 'normal@fake.com', '81dc9bdb52d04dc20036dbd8313ed055', 1);

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
  MODIFY `comment_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=437;

--
-- AUTO_INCREMENT a táblához `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1335;

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
