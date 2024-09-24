-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-09-24 14:53:26
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
-- 資料庫： `db3`
--

-- --------------------------------------------------------

--
-- 資料表結構 `movie`
--

CREATE TABLE `movie` (
  `id` int(10) UNSIGNED NOT NULL,
  `movie` text NOT NULL,
  `level` int(11) NOT NULL DEFAULT 1,
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

INSERT INTO `movie` (`id`, `movie`, `level`, `length`, `ondate`, `publish`, `director`, `trailer`, `poster`, `intro`, `sh`, `rank`) VALUES
(2, '03B02', 2, '1:20', '2024-09-24', '03B02發行商', '03B02導演', '03B02v.mp4', '03B02.png', '03B02v.mp40/3B02.png/劇情介紹!!!', 1, 3),
(3, '03B031', 1, '1:50', '2024-09-22', '03B031發行商', '03B031導演', '03B03v.mp4', '03B03.png', '03B031v.mp40/3B031.png/劇情介紹!!!', 1, 2),
(4, '03B04', 4, '1:40', '2024-09-22', '03B04發行商', '03B04導演', '03B04v.mp4', '03B04.png', '03B04v.mp40/3B04.png/劇情介紹!!!', 1, 4),
(5, '03B05', 1, '1:50', '2024-09-23', '03B05發行商', '03B05導演', '03B05v.mp4', '03B05.png', '03B05v.mp40/3B05.png/劇情介紹!!!', 1, 5),
(6, '03B06', 2, '1:10', '2024-09-22', '03B06發行商', '03B06導演', '03B06v.mp4', '03B06.png', '03B06v.mp40/3B06.png/劇情介紹!!!', 1, 6),
(7, '03B07', 3, '1:50', '2024-09-24', '03B07發行商', '03B07導演', '03B07v.mp4', '03B07.png', '03B07v.mp40/3B07.png/劇情介紹!!!', 1, 7),
(8, '03B08', 4, '1:30', '2024-09-22', '03B08發行商', '03B08導演', '03B08v.mp4', '03B08.png', '03B08v.mp40/3B08.png/劇情介紹!!!', 1, 9),
(9, '03B25片名', 1, '1:10', '2024-09-24', '03B25導演', '03B25導演', '03B25v.mp4', '03B25.png', '03B25片名劇情介紹!!介紹!劇情', 1, 8);

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
  `seats` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`id`, `no`, `movie`, `date`, `session`, `qt`, `seats`) VALUES
(11, '202409240005', '03B04', '2024-09-24', '16:00~18:00', 4, 'a:4:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"4\";}'),
(13, '202409240007', '03B08', '2024-09-24', '16:00~18:00', 4, 'a:4:{i:0;s:1:\"4\";i:1;s:1:\"3\";i:2;s:1:\"2\";i:3;s:1:\"1\";}');

-- --------------------------------------------------------

--
-- 資料表結構 `poster`
--

CREATE TABLE `poster` (
  `id` int(10) UNSIGNED NOT NULL,
  `img` text NOT NULL,
  `text` text NOT NULL,
  `sh` int(11) NOT NULL DEFAULT 1,
  `rank` int(11) NOT NULL,
  `ani` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `poster`
--

INSERT INTO `poster` (`id`, `img`, `text`, `sh`, `rank`, `ani`) VALUES
(2, '03A02.jpg', '03A02片名', 1, 4, 3),
(3, '03A03.jpg', '03A03片名', 1, 3, 2),
(4, '03A04.jpg', '03A04片名1', 1, 2, 1),
(5, '03A05.jpg', '03A05片名', 0, 6, 2),
(6, '03A06.jpg', '03A06片名', 1, 5, 1),
(7, '03A07.jpg', '03A07片名', 1, 7, 3),
(8, '03A08.jpg', '03A08片名', 1, 8, 1),
(9, '03A09.jpg', '03A09', 1, 9, 2);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `poster`
--
ALTER TABLE `poster`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
