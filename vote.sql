-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-07-14 18:21:57
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
(1, 1, 1, 0, '2022-06-27 21:49:00'),
(2, 1, 2, 0, '2022-06-27 21:50:00'),
(3, 1, 3, 2, '2022-06-27 21:50:00'),
(4, 1, 4, 0, '2022-06-27 21:50:00'),
(5, 1, 5, 1, '2022-06-27 21:50:00'),
(6, 5, 2, 1, '2022-06-27 22:06:00'),
(7, 5, 4, 0, '2022-06-27 22:15:00'),
(8, 5, 1, 1, '2022-06-27 22:19:00'),
(9, 5, 3, 2, '2022-06-27 22:19:00'),
(10, 5, 5, 2, '2022-06-27 22:19:00'),
(11, 2, 1, 1, '2022-06-27 22:26:00'),
(12, 2, 2, 2, '2022-06-27 22:26:00'),
(13, 2, 3, 0, '2022-06-27 22:26:00'),
(14, 2, 4, 1, '2022-06-27 22:26:00'),
(15, 2, 5, 0, '2022-06-27 22:26:00'),
(16, 3, 1, 1, '2022-06-27 22:28:00'),
(17, 3, 2, 0, '2022-06-27 22:28:00'),
(18, 3, 3, 2, '2022-06-27 22:29:00'),
(19, 3, 4, 0, '2022-06-27 22:30:00'),
(20, 3, 5, 1, '2022-06-27 22:31:00'),
(32, 3, 6, 0, '2022-06-27 23:24:00'),
(33, 3, 6, 2, '2022-06-27 23:24:00'),
(34, 3, 6, 4, '2022-06-27 23:24:00'),
(35, 3, 7, 1, '2022-06-27 23:27:00'),
(36, 5, 10, 2, '2022-07-10 23:16:00'),
(37, 5, 10, 3, '2022-07-10 23:16:00'),
(38, 5, 10, 4, '2022-07-10 23:16:00'),
(39, 5, 11, 1, '2022-07-10 23:31:00'),
(40, 5, 11, 2, '2022-07-10 23:31:00'),
(41, 5, 11, 4, '2022-07-10 23:31:00'),
(42, 11, 11, 0, '2022-07-12 22:43:00'),
(43, 11, 11, 1, '2022-07-12 22:43:00'),
(44, 11, 11, 3, '2022-07-12 22:43:00'),
(45, 1, 13, 1, '2022-07-14 03:47:00');

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
(1, '九華樓', 1, 1),
(2, '肉次方', 1, 3),
(3, '和牛涮', 1, 0),
(4, '台中', 2, 2),
(5, '宜蘭', 2, 1),
(6, '九份', 2, 1),
(7, '猴子', 3, 1),
(8, '黑熊', 3, 0),
(9, '貓頭鷹', 3, 3),
(10, 'Yes', 4, 3),
(11, 'No', 4, 1),
(12, '天空藍', 5, 1),
(13, '魔力紅', 5, 2),
(14, 'T芙妮綠', 5, 1),
(15, '垃圾袋', 6, 1),
(16, '拖把', 6, 0),
(17, '鍋子', 6, 1),
(18, '沐浴乳', 6, 0),
(19, '洗面乳', 6, 1),
(20, '乳液', 6, 0),
(23, '7-11', 7, 0),
(24, '肉羹麵', 7, 1),
(25, '八方雲集', 7, 0),
(26, '墾丁', 10, 0),
(27, '澎湖', 10, 0),
(28, '宜蘭', 10, 1),
(29, '台中', 10, 1),
(30, '花蓮', 10, 1),
(31, '小琉球', 10, 0),
(32, '打保齡球', 11, 1),
(33, '打桌遊', 11, 2),
(34, '打電動', 11, 1),
(35, '打羽球', 11, 1),
(36, '打漆彈', 11, 1),
(37, '打籃球', 11, 0),
(38, '雷神索爾', 12, 0),
(39, '咒', 12, 0),
(40, '奇異博士', 12, 0),
(41, '蜘蛛人', 12, 0),
(42, '峰迴路轉', 12, 0),
(43, '東方快車謀殺案', 12, 0),
(44, '烤肉', 13, 0),
(45, '去阿里山賞月', 13, 1),
(46, '陪家人吃飯', 13, 0),
(47, '考乙級', 13, 0);

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
(1, '7/3聚餐吃甚麼?', 3, 0, 1, '2022-06-28 05:24:00', '2022-07-01 19:01:00', 4),
(2, '7/10要去哪玩?', 6, 0, 1, '2022-06-28 05:25:00', '2022-07-03 19:00:00', 4),
(3, '假如你在森林裡，第一隻看到的動物是甚麼?', 5, 0, 1, '2022-06-28 05:27:00', '2022-06-28 18:00:00', 4),
(4, '明天要打牌嗎?', 4, 0, 1, '2022-06-28 05:45:00', '2022-06-29 12:00:00', 4),
(5, '客廳牆壁要漆甚麼顏色?', 2, 0, 1, '2022-06-28 05:49:00', '2022-07-05 00:00:00', 4),
(6, '明天去家樂福要買甚麼?', 2, 1, 3, '2022-06-28 06:37:00', '2022-06-28 19:38:00', 1),
(7, '晚餐吃甚麼?', 3, 0, 1, '2022-06-28 07:27:00', '2022-06-28 20:00:00', 1),
(10, '下個周末要去哪裡玩?', 6, 1, 3, '2022-07-11 04:45:00', '2022-07-15 21:00:00', 1),
(11, '星期日要做甚麼?', 6, 1, 3, '2022-07-11 04:49:00', '2022-07-15 21:00:00', 2),
(12, '電影要看哪一部?', 4, 1, 2, '2022-07-14 06:09:00', '2022-07-21 00:00:00', 0),
(13, '中秋節要幹嘛?', 2, 0, 1, '2022-07-14 06:11:00', '2022-07-21 00:00:00', 2);

-- --------------------------------------------------------

--
-- 資料表結構 `type`
--

CREATE TABLE `type` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(2, '生活'),
(3, '吃喝'),
(4, '娛樂'),
(5, '心理'),
(6, '旅遊'),
(7, '政治'),
(8, '兩性'),
(10, '政治');

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
(2, 'justin', 'e10adc3949ba59abbe56e057f20f883e', '阿勳', 0, '1992-09-10', '彰化師範大學', '台北市', 'A123456789', '123456@yahoo.com.tw', '0900123456', '123456', '2022-06-27 21:48:12', '2022-06-28'),
(3, 'tarnway', 'e10adc3949ba59abbe56e057f20f883e', '小瑋', 1, '1989-04-29', '科技大學', '台北市', 'A123456789', '123456@yahoo.com.tw', '0900123456', '123456', '2022-06-27 21:53:38', '0000-00-00'),
(4, 'test', 'd41d8cd98f00b204e9800998ecf8427e', 'T', 0, '2022-06-27', '台灣長大', '台北市', 'A123456789', '123456@yahoo.com.tw', '0900123456', '123456', '2022-06-27 21:55:24', '2022-06-28'),
(5, 'test2', 'e10adc3949ba59abbe56e057f20f883e', 'aaa', 0, '2022-06-28', '彰化師範大學', '台北市', 'A123456789', '123456@yahoo.com.tw', 'bbb', '123456', '2022-06-28 12:47:05', '2022-06-28'),
(11, 'apple', '1f3870be274f6c49b3e31a0c6728957f', 'apple', 1, '2022-07-11', '城市科技大學', '台北市', 'F123456789', '123456@yahoo.com.tw', '0900123456', 'apple', '2022-07-11 17:48:38', '2022-07-14'),
(12, 'banana', '72b302bf297a228a75730123efef7c41', 'banana', 0, '2022-07-14', '輔仁大學', '台北市', 'A123456789', '123456@yahoo.com.tw', '0900123456', 'banana', '2022-07-14 12:12:43', '0000-00-00');

--
-- 已傾印資料表的索引
--

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
-- 使用資料表自動遞增(AUTO_INCREMENT) `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
