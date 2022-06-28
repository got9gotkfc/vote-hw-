-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-06-28 06:12:41
-- 伺服器版本： 10.4.24-MariaDB
-- PHP 版本： 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `vote`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admins`
--

CREATE TABLE `admins` (
  `id` int(11) UNSIGNED NOT NULL,
  `acc` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pw` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '帳號',
  `name` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `log`
--

CREATE TABLE `log` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL COMMENT '投票者',
  `subject_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `vote_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `log`
--

INSERT INTO `log` (`id`, `user_id`, `subject_id`, `option_id`, `vote_time`) VALUES
(1, 1, 2, 2, '2022-06-26 20:50:00'),
(5, 1, 1, 2, '2022-06-26 22:09:00'),
(7, 1, 3, 2, '2022-06-26 22:38:00'),
(8, 1, 4, 1, '2022-06-26 22:39:00'),
(11, 4, 2, 2, '2022-06-27 03:27:00'),
(12, 4, 3, 1, '2022-06-27 03:49:00');

-- --------------------------------------------------------

--
-- 資料表結構 `options`
--

CREATE TABLE `options` (
  `id` int(11) UNSIGNED NOT NULL,
  `option` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '選項描述',
  `subject_id` int(11) NOT NULL,
  `total` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `options`
--

INSERT INTO `options` (`id`, `option`, `subject_id`, `total`) VALUES
(1, '牛排', 1, 0),
(2, '麥當勞', 1, 0),
(3, '肯德基', 1, 3),
(4, '周杰倫', 2, 0),
(5, '蔡依林', 2, 0),
(6, 'A-Lin', 2, 4),
(7, '牛排', 3, 0),
(8, '乾麵', 3, 2),
(9, '八方雲集', 3, 5),
(10, 'OK', 4, 0),
(11, 'NO', 4, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) UNSIGNED NOT NULL,
  `subject` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '主題描述',
  `type_id` int(11) NOT NULL,
  `multiple` tinyint(1) NOT NULL DEFAULT 0 COMMENT '單/複選',
  `mulit_limit` tinyint(2) NOT NULL DEFAULT 1 COMMENT '單/複選項目數',
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `total` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `subjects`
--

INSERT INTO `subjects` (`id`, `subject`, `type_id`, `multiple`, `mulit_limit`, `start`, `end`, `total`) VALUES
(1, '今天中午吃甚麼?', 0, 0, 1, '2022-06-27 04:45:00', '2022-06-27 12:45:00', 1),
(2, '要聽誰的演唱會?', 0, 0, 1, '2022-06-27 04:46:00', '2022-07-04 00:00:00', 2),
(3, '晚餐吃甚麼?', 0, 0, 1, '2022-06-27 06:10:00', '2022-06-28 18:10:00', 2),
(4, '晚上要打麻講嗎?', 0, 0, 1, '2022-06-27 06:39:00', '2022-06-29 18:01:00', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `type`
--

CREATE TABLE `type` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `acc` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pw` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密碼',
  `name` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(1) UNSIGNED NOT NULL,
  `birthday` date NOT NULL,
  `eduction` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addr` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idcard` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `e-mail` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passnote` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reg_date` datetime NOT NULL,
  `update_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `acc`, `pw`, `name`, `gender`, `birthday`, `eduction`, `addr`, `idcard`, `e-mail`, `phone`, `passnote`, `reg_date`, `update_date`) VALUES
(1, 'tom', '81dc9bdb52d04dc20036dbd8313ed055', '阿咪', 0, '2022-06-21', '彰化師範大學', '台北市', 'A123456789', 'got9got@yahoo.com.tw', '0966678326', '1234', '2022-06-21 17:18:45', '2022-06-27'),
(2, 'justin', 'e10adc3949ba59abbe56e057f20f883e', '阿勳', 0, '1991-09-10', '彰化師範大學', '台北市', 'A123456789', '123456@yahoo.com.tw', '0900123456', '123456', '2022-06-27 21:48:12', '0000-00-00'),
(3, 'tarnway', 'e10adc3949ba59abbe56e057f20f883e', '小瑋', 1, '1989-04-29', '科技大學', '台北市', 'A123456789', '123456@yahoo.com.tw', '0900123456', '123456', '2022-06-27 21:53:38', '0000-00-00'),
(4, 'test', 'e10adc3949ba59abbe56e057f20f883e', 'T', 0, '2022-06-27', '台灣長大', '台北市', 'A123456789', '123456@yahoo.com.tw', '0900123456', '123456', '2022-06-27 21:55:24', '0000-00-00');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
