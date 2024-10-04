-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-10-04 21:49:16
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
  `name` text NOT NULL,
  `trailer` text NOT NULL,
  `poster` text NOT NULL,
  `length` text NOT NULL,
  `level` int(11) NOT NULL DEFAULT 1,
  `ondate` date NOT NULL,
  `publish` text NOT NULL,
  `director` text NOT NULL,
  `intro` text NOT NULL,
  `sh` int(11) NOT NULL DEFAULT 1,
  `rank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `movie`
--

INSERT INTO `movie` (`id`, `name`, `trailer`, `poster`, `length`, `level`, `ondate`, `publish`, `director`, `intro`, `sh`, `rank`) VALUES
(4, '院線片04', '03B04v.mp4', '03B04.png', '1:50', 4, '2024-10-02', '03B04發行商', '03B04導演', '03B04劇情介紹', 1, 7),
(5, '院線片05', '03B05v.mp4', '03B05.png', '1:10', 1, '2024-10-04', '03B05發行商', '03B05導演', '03B05劇情介紹', 1, 8),
(6, '院線片06', '03B06v.mp4', '03B06.png', '1:20', 2, '2024-10-03', '03B06發行商', '03B06導演', '03B06劇情介紹', 1, 9),
(7, '01院線片01', '03B01v.mp4', '03B01.png', '1:10', 4, '2024-10-03', '01院線片01發行商', '01院線片01導演', '01院線片01劇情介紹', 1, 4),
(8, '院線片02', '03B02v.mp4', '03B02.png', '1:10', 3, '2024-10-05', '院線片02發行商', '院線片02導演', '院線片02劇情介', 1, 5),
(9, '院線片03', '03B03v.mp4', '03B03.png', '1:20', 2, '2024-10-03', '院線片03發行商', '院線片03導演', '院線片03劇情介紹', 1, 6),
(10, '院線片07', '03B07v.mp4', '03B07.png', '1:30', 2, '2024-10-04', '院線片07發行商', '院線片07導演', '院線片07劇情介紹', 1, 10);

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

-- --------------------------------------------------------

--
-- 資料表結構 `poster`
--

CREATE TABLE `poster` (
  `id` int(10) UNSIGNED NOT NULL,
  `img` text NOT NULL,
  `text` text NOT NULL,
  `ani` int(11) NOT NULL DEFAULT 1,
  `sh` int(11) NOT NULL DEFAULT 1,
  `rank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `poster`
--

INSERT INTO `poster` (`id`, `img`, `text`, `ani`, `sh`, `rank`) VALUES
(2, '03A02.jpg', '預告片02', 2, 1, 4),
(3, '03A03.jpg', '預告片03', 3, 1, 3),
(4, '03A04.jpg', '預告片04', 1, 1, 2),
(5, '03A05.jpg', '預告片05', 2, 1, 5),
(6, '03A06.jpg', '預告片06', 3, 1, 6),
(7, '03A07.jpg', '預告片07', 3, 1, 7),
(8, '03A08.jpg', '預告片08', 3, 1, 8),
(9, '03A09.jpg', '預告片09', 2, 1, 9);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `poster`
--
ALTER TABLE `poster`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
