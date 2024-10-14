-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-10-14 05:28:36
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `db03`
--

-- --------------------------------------------------------

--
-- 資料表結構 `movie`
--

CREATE TABLE `movie` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `level` int(11) NOT NULL,
  `length` text NOT NULL,
  `ondate` date NOT NULL,
  `publish` text NOT NULL,
  `director` text NOT NULL,
  `trailer` text NOT NULL,
  `poster` text NOT NULL,
  `intro` text NOT NULL,
  `sh` int(11) NOT NULL DEFAULT 1,
  `rank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `movie`
--

INSERT INTO `movie` (`id`, `name`, `level`, `length`, `ondate`, `publish`, `director`, `trailer`, `poster`, `intro`, `sh`, `rank`) VALUES
(10, '院線片01a', 1, '1:50b', '2024-10-12', '院線片01發行商c', '院線片01導演d', '03B01v.mp4', '03B01.png', '院線片01簡介efg', 1, 8),
(11, 'TEXT_07', 2, '1:20', '2024-10-12', 'TEXT_07發行商', 'TEXT_07導演', '03B20v.mp4', '03B20.png', 'TEXT_07劇情簡介', 1, 10),
(13, '院線片02', 1, '1:50', '2024-10-14', '院線片02發行商', '院線片02導演', '03B02v.mp4', '03B02.png', '院線片02劇情簡介', 1, 11),
(14, '院線片03_TEXT', 1, '1:30', '2024-10-13', '院線片03_TEXT發行商', '院線片03_TEXT導演', '03B03v.mp4', '03B03.png', '院線片03_TEXT劇情簡介', 1, 12),
(15, '院線片10_TEXT', 4, '1:20', '2024-10-12', '院線片10_TEXT發行商', '院線片10_TEXT導演', '03B10v.mp4', '03B10.png', '院線片10_TEXT劇情簡介', 1, 14),
(19, 'a', 1, 'b', '2024-10-14', 'c', 'd', '03B12v.mp4', '03B12.png', 'abcd, efg, hijklmnopqrstuv,wxyzzz,abc,defg,hijklmnopqrstuvwxyz', 1, 15);

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `no` text NOT NULL,
  `movie` text NOT NULL,
  `date` date NOT NULL,
  `session` text NOT NULL,
  `qt` int(11) NOT NULL,
  `seat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`id`, `no`, `movie`, `date`, `session`, `qt`, `seat`) VALUES
(60, '202410140001', '院線片01a', '2024-10-14', '14:00-16:00', 0, 'N;'),
(61, '202410140002', '院線片01a', '2024-10-14', '14:00-16:00', 0, 'N;'),
(62, '202410140003', '院線片01a', '2024-10-14', '14:00-16:00', 0, 'N;'),
(63, '202410140004', '院線片01a', '2024-10-14', '14:00-16:00', 1, 'a:1:{i:0;s:2:\"20\";}');

-- --------------------------------------------------------

--
-- 資料表結構 `poster`
--

CREATE TABLE `poster` (
  `id` int(10) UNSIGNED NOT NULL,
  `img` text NOT NULL,
  `name` text NOT NULL,
  `sh` int(11) NOT NULL DEFAULT 1,
  `rank` int(11) NOT NULL,
  `ani` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `poster`
--

INSERT INTO `poster` (`id`, `img`, `name`, `sh`, `rank`, `ani`) VALUES
(27, '03A01.jpg', '01abcdefg', 1, 2, '1'),
(28, '03A02.jpg', '02hijklmnop1', 1, 1, '2'),
(29, '03A03.jpg', '03qrstuvwx', 1, 3, '3'),
(30, '03A04.jpg', '04yz', 1, 4, '2'),
(31, '03A05.jpg', '05aabcdde', 1, 5, '1'),
(32, '03A06.jpg', '06hijkklmno', 1, 6, '3');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `poster`
--
ALTER TABLE `poster`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `poster`
--
ALTER TABLE `poster`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
