-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 
-- 伺服器版本： 10.4.8-MariaDB
-- PHP 版本： 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `is`
--

-- --------------------------------------------------------

--
-- 資料表結構 `lottery_list`
--

CREATE TABLE `lottery_list` (
  `period` int(10) NOT NULL,
  `startTime` datetime(1) NOT NULL,
  `endTime` datetime(1) NOT NULL,
  `showDate` datetime(1) NOT NULL,
  `winNum` int(5) NOT NULL,
  `bonus` int(5) NOT NULL,
  `count` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `lottery_list`
--

INSERT INTO `lottery_list` (`period`, `startTime`, `endTime`, `showDate`, `winNum`, `bonus`, `count`) VALUES
(1, '2020-11-30 00:00:00.0', '2020-12-02 23:59:59.0', '2020-12-03 20:00:00.0', 33, 1500, 0),
(2, '2020-12-03 00:00:00.0', '2020-12-05 23:59:59.0', '2020-12-06 20:00:00.0', 20, 2600, 2),
(3, '2020-12-17 00:00:00.0', '2020-12-19 23:59:59.0', '2020-12-20 18:00:00.0', 0, 3762, 0),
(4, '2020-12-20 00:00:00.0', '2020-12-21 00:00:00.0', '2020-12-21 00:00:00.0', 0, 900, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `record`
--

CREATE TABLE `record` (
  `id` int(10) NOT NULL,
  `account` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `period` int(10) NOT NULL,
  `num` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `salt` int(10) NOT NULL,
  `sign` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hash` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `record`
--

INSERT INTO `record` (`id`, `account`, `period`, `num`, `price`, `salt`, `sign`, `hash`, `status`) VALUES
(1, 'test', 0, 15, 100, 0, '', '', 0),
(2, 'test', 0, 15, 100, 0, '', '', 0),
(3, 'test', 0, 15, 100, 0, '', '', 0),
(4, 'test', 0, 16, 100, 0, '', '', 0),
(5, 'test', 0, 16, 100, 0, '', '', 0),
(6, 'test', 0, 16, 100, 0, '', '', 0),
(7, 'test', 3, 1, 50, 0, '', '', 0),
(8, 'test', 3, 41, 1000, 0, '', '', 0),
(9, 'test', 3, 41, 1000, 0, '', '', 0),
(10, 'test', 3, 34, 1000, 0, '', '', 0),
(11, 'test', 3, 34, 10, 0, '', '', 0),
(12, 'test', 3, 16, 100, 0, '', '', 0),
(13, 'test', 3, 16, 100, 0, '', '', 0),
(14, 'test', 3, 18, 100, 0, '', '', 0),
(15, 'test', 3, 40, 100, 0, '', '', 0),
(16, 'test', 3, 21, 1, 0, '', '', 0),
(17, 'test', 3, 21, 1, 0, '', '', 0),
(18, 'test', 3, 43, 100, 0, '', '', 0),
(19, 'test', 3, 43, 100, 0, '', '', 0),
(20, 'test', 3, 43, 100, 0, '', '', 0),
(21, 'test', 4, 15, 100, 0, '', '', 0),
(22, 'test', 4, 16, 100, 0, '', '', 0),
(23, 'yo', 4, 16, 100, 0, '', '', 0),
(24, 'yo', 4, 1, 500, 0, '', '', 1),
(25, 'yo', 4, 9, 100, 805, '', '', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `uid` int(10) NOT NULL,
  `name` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `account` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `public key` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `private key` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`uid`, `name`, `account`, `password`, `phone`, `public key`, `private key`) VALUES
(1, 'yoyo', 'test', 'test', '0977323123', '', ''),
(2, '陳侑萱', 'yo', '123', '0912345633', '', ''),
(3, '章羲元', 'circle', '123', '0933475666', '', ''),
(4, '李', 'lee', '123', '0988788778', '', ''),
(5, '汪', 'wang', '123', '0933448449', '', ''),
(6, '張', 'HI', '123', '0977888888', '', ''),
(7, '陳', 'chen', '123', '0988763833', '', ''),
(8, '林', 'lin', '123', '0983733849', '', '');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `lottery_list`
--
ALTER TABLE `lottery_list`
  ADD PRIMARY KEY (`period`);

--
-- 資料表索引 `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `lottery_list`
--
ALTER TABLE `lottery_list`
  MODIFY `period` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `record`
--
ALTER TABLE `record`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
