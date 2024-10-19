-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-10-19 19:19:03
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
  `ondate` date NOT NULL,
  `length` text NOT NULL,
  `level` int(11) NOT NULL DEFAULT 1,
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

INSERT INTO `movie` (`id`, `name`, `ondate`, `length`, `level`, `publish`, `director`, `poster`, `trailer`, `intro`, `sh`, `rank`) VALUES
(2, '電影02', '2024-10-20', '1:20', 1, '03B02發行商A', '03B02導演B', '03B10.png', '03B10v.mp4', '03B02劇情介紹...ABC', 1, 2),
(4, '03B04ABC', '2024-10-18', '1:10', 4, '03B04發行商', '03B04導演', '03B04.png', '03B04v.mp4', '03B04劇情介紹...', 1, 4),
(5, '03B05ABC', '2024-10-18', '1:30', 1, '03B05發行商', '03B05導演', '03B05.png', '03B05v.mp4', '03B05劇情介紹...', 1, 6),
(8, '電影07', '2024-10-20', '1:40', 3, '03B07Publish', '03B07Director', '03B07.png', '03B07v.mp4', 'sfsdf sfs dfsdf sdfsdf d f', 1, 5);

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `date` date NOT NULL,
  `session` text NOT NULL,
  `qt` int(11) NOT NULL,
  `seats` text NOT NULL,
  `no` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `poster`
--

CREATE TABLE `poster` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `img` text NOT NULL,
  `ani` int(11) NOT NULL DEFAULT 1,
  `sh` int(11) NOT NULL DEFAULT 1,
  `rank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `poster`
--

INSERT INTO `poster` (`id`, `name`, `img`, `ani`, `sh`, `rank`) VALUES
(1, '03A01預告片', '03A01.jpg', 3, 1, 3),
(3, '03A03預告片1', '03A03.jpg', 1, 1, 2),
(4, '03A04預告片', '03A04.jpg', 1, 1, 4),
(5, '03A05預告片', '03A05.jpg', 2, 1, 5),
(6, '03A06預告片', '03A06.jpg', 3, 1, 6),
(7, '03A02預告片', '03A02.jpg', 2, 1, 7);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `poster`
--
ALTER TABLE `poster`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
