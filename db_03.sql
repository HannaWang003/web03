-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-09-23 14:51:03
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
-- 資料庫： `db_03`
--

-- --------------------------------------------------------

--
-- 資料表結構 `movie`
--

CREATE TABLE `movie` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `length` text NOT NULL,
  `level` int(11) NOT NULL DEFAULT 1,
  `ondate` date NOT NULL,
  `publish` text NOT NULL,
  `director` text NOT NULL,
  `poster` text NOT NULL,
  `trailer` text NOT NULL,
  `intro` text NOT NULL,
  `sh` int(11) NOT NULL DEFAULT 1,
  `rank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `movie`
--

INSERT INTO `movie` (`id`, `name`, `length`, `level`, `ondate`, `publish`, `director`, `poster`, `trailer`, `intro`, `sh`, `rank`) VALUES
(1, '03B01', '1:20', 1, '2024-09-22', '03B01發行商', '03B01導演', '03B01.png', '03B01v.mp4', '03B01劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹', 1, 9),
(5, '03B051', '1:30', 1, '2024-09-21', '03B05發行商', '03B05導演', '03B05.png', '03B05v.mp4', '03B05劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹', 1, 14),
(6, '03B0611', '1:50', 1, '2024-09-23', '03B0611發行商', '03B0611導演', '03B06.png', '03B06v.mp4', '03B0611劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹', 1, 15),
(7, '03B07', '1:20', 3, '2024-09-21', '03B07發行商', '03B07導演', '03B07.png', '03B07v.mp4', '03B07劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹', 1, 16),
(8, '03B12', '1:10', 2, '2024-09-22', '03B12發行商', '03B12導演', '03B12.png', '03B12v.mp4', '03B12劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹', 1, 7),
(9, '03B09', '1:50', 3, '2024-09-23', '03B09發行商', '03B09導演', '03B09.png', '03B09v.mp4', '03B09劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹', 1, 8),
(10, '03B10', '1:20', 2, '2024-09-21', '03B10發行商', '03B10導演', '03B10.png', '03B10v.mp4', '03B10劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹', 0, 11),
(11, '03B11', '1:30', 1, '2024-09-22', '03B11發行商', '03B11導演', '03B11.png', '03B11v.mp4', '03B11劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹，劇情介紹', 1, 10),
(12, '03B25', '1:40', 1, '2024-09-23', '03B25發行商', '03B25導演', '03B25.png', '03B25v.mp4', '03B25劇情介紹/03B25劇情介紹/03B25劇情介紹/03B25劇情介紹/03B25劇情介紹/03B25劇情介紹/03B25劇情介紹/03B25劇情介紹/03B25劇情介紹', 1, 12);

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
  `seats` text NOT NULL,
  `qt` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`id`, `no`, `movie`, `date`, `session`, `seats`, `qt`) VALUES
(19, '202409230004', '03B04', '2024-09-23', '16:00~18:00', 'a:4:{i:0;s:1:\"1\";i:1;s:1:\"6\";i:2;s:2:\"11\";i:3;s:2:\"16\";}', 4);

-- --------------------------------------------------------

--
-- 資料表結構 `poster`
--

CREATE TABLE `poster` (
  `id` int(10) UNSIGNED NOT NULL,
  `img` text NOT NULL,
  `text` text NOT NULL,
  `ani` int(11) NOT NULL DEFAULT 1,
  `rank` int(11) NOT NULL,
  `sh` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `poster`
--

INSERT INTO `poster` (`id`, `img`, `text`, `ani`, `rank`, `sh`) VALUES
(1, '03A01.jpg', '預告片01', 3, 2, 1),
(3, '03A03.jpg', '預告片03', 2, 3, 1),
(4, '03A04.jpg', '預告片04', 3, 4, 1),
(5, '03A05.jpg', '預告片05', 2, 5, 1),
(6, '03A06.jpg', '預告片06', 3, 7, 1),
(7, '03A07.jpg', '預告片07', 2, 9, 1),
(11, '03B15.png', '03B15', 2, 6, 1),
(12, '03A06.jpg', '03A06', 2, 8, 1);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `poster`
--
ALTER TABLE `poster`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
