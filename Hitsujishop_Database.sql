-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-07-16 02:31:01
-- 伺服器版本： 10.4.17-MariaDB
-- PHP 版本： 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `shop`
--

-- --------------------------------------------------------

--
-- 資料表結構 `account`
--

CREATE TABLE `account` (
  `id` smallint(3) UNSIGNED ZEROFILL NOT NULL COMMENT '會員id',
  `level` enum('administrator','member') COLLATE utf8mb4_bin NOT NULL DEFAULT 'member' COMMENT '會員層級',
  `name` varchar(20) COLLATE utf8mb4_bin NOT NULL COMMENT '會員名稱',
  `password` varchar(20) COLLATE utf8mb4_bin NOT NULL COMMENT '會員密碼',
  `gender` enum('M','F') COLLATE utf8mb4_bin NOT NULL DEFAULT 'M' COMMENT '會員性別',
  `email` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL COMMENT '會員信箱',
  `phone` int(50) DEFAULT NULL COMMENT '會員電話',
  `address` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL COMMENT '會員地址',
  `status` enum('i','o') COLLATE utf8mb4_bin NOT NULL DEFAULT 'o' COMMENT '會員狀態',
  `time_login` datetime(6) NOT NULL DEFAULT current_timestamp(6) COMMENT '登入時間',
  `time_logout` datetime(6) NOT NULL DEFAULT current_timestamp(6) COMMENT '登出時間',
  `time_signup` datetime NOT NULL DEFAULT current_timestamp() COMMENT '註冊時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `account`
--

INSERT INTO `account` (`id`, `level`, `name`, `password`, `gender`, `email`, `phone`, `address`, `status`, `time_login`, `time_logout`, `time_signup`) VALUES
(002, 'administrator', 'admin', 'jojo', 'M', 'ruidorui@gmail.com', 13456789, '111', 'o', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000', '2021-06-16 15:14:00'),
(003, 'member', '123', '12', 'F', '11@qq', 123, '123', 'o', '2021-06-16 22:52:08.354641', '2021-06-16 22:52:08.354641', '2021-06-16 22:52:08'),
(004, 'member', 'JOJO', '12', 'F', '11@qq', 123, '123', 'o', '2021-06-16 22:54:32.213051', '2021-06-16 22:54:32.213051', '2021-06-16 22:54:32'),
(005, 'member', 'er', '12', 'F', '11@ff', 41, '41)', 'o', '2021-06-16 23:02:18.295630', '2021-06-16 23:02:18.295630', '2021-06-16 23:02:18'),
(006, 'member', 'qq', '111', 'M', '222@33', 1, '1)', 'o', '2021-06-17 09:42:22.758071', '2021-06-17 09:42:22.758071', '2021-06-17 09:42:22'),
(007, 'member', 'mm', '11', 'F', '11@ff', 2, '3)', 'o', '2021-06-17 09:47:11.886215', '2021-06-17 09:47:11.886215', '2021-06-17 09:47:11'),
(008, 'member', '11', '22', 'M', '44@55', 22, '11', 'o', '2021-06-18 00:30:59.014570', '2021-06-18 00:30:59.014570', '2021-06-18 00:30:59'),
(009, 'member', '14', 'we', 'F', '222@33', 44, '33', 'o', '2021-06-18 01:44:55.000630', '2021-06-18 01:44:55.000630', '2021-06-18 01:44:55'),
(010, 'member', '66', '11', 'F', '222@33', 44, '33', 'o', '2021-06-18 01:48:30.204230', '2021-06-18 01:48:30.204230', '2021-06-18 01:48:30'),
(011, 'member', 'POPO', 'QQ', 'M', 'qq@11', 8888, '1236', 'o', '2021-06-18 01:56:06.793139', '2021-06-18 01:56:06.793139', '2021-06-18 01:56:06'),
(012, 'member', 'TTY', '123', 'F', '11@ff', 33, '222', 'o', '2021-06-20 22:10:27.657259', '2021-06-20 22:10:27.657259', '2021-06-20 22:10:27'),
(013, 'member', '666', '56', 'F', '222@33', 44, '345', 'o', '2021-06-20 22:11:18.188383', '2021-06-20 22:11:18.188383', '2021-06-20 22:11:18'),
(014, 'member', 'LOLO', '345', 'M', 'qq@11', 123432, '22', 'o', '2021-06-24 09:11:58.383927', '2021-06-24 09:11:58.383927', '2021-06-24 09:11:58'),
(015, 'member', 'pqwoie', '123', 'F', 'w@w', 123, '123', 'o', '2021-06-24 13:52:52.703345', '2021-06-24 13:52:52.703345', '2021-06-24 13:52:52'),
(016, 'member', 'IOIO', '123', 'F', '23@rr', 13, 'qe', 'o', '2021-07-16 03:34:56.417977', '2021-07-16 03:34:56.417977', '2021-07-16 03:34:56'),
(017, 'member', 'UIO', '123', 'F', '23@rr', 13, 'qe', 'o', '2021-07-16 03:35:08.295388', '2021-07-16 03:35:08.295388', '2021-07-16 03:35:08'),
(018, 'member', 'wweee', 'qqq', 'F', 'qq@11', 123, '123', 'o', '2021-07-16 03:37:30.220662', '2021-07-16 03:37:30.220662', '2021-07-16 03:37:30'),
(019, 'member', 'TTYttt', 'qwe', 'M', '222@33', 45, 'qe', 'o', '2021-07-16 03:40:12.265577', '2021-07-16 03:40:12.265577', '2021-07-16 03:40:12'),
(020, 'member', 'ertgg', '1234', 'M', 'w@w', 567, '123', 'o', '2021-07-16 03:43:50.605151', '2021-07-16 03:43:50.605151', '2021-07-16 03:43:50'),
(021, 'member', 'ppplll', '123', 'F', 'w@w', 678, '123', 'o', '2021-07-16 03:45:45.969004', '2021-07-16 03:45:45.969004', '2021-07-16 03:45:45'),
(022, 'member', '567uuu', '111', 'F', '222@33', 12, '33', 'o', '2021-07-16 03:47:42.162585', '2021-07-16 03:47:42.162585', '2021-07-16 03:47:42');

-- --------------------------------------------------------

--
-- 資料表結構 `goods`
--

CREATE TABLE `goods` (
  `id` smallint(5) UNSIGNED ZEROFILL NOT NULL COMMENT '商品id',
  `category` enum('cloth','lifestyle') COLLATE utf8mb4_bin NOT NULL DEFAULT 'lifestyle' COMMENT '商品類別',
  `title` varchar(50) COLLATE utf8mb4_bin NOT NULL COMMENT '商品名稱',
  `information` text COLLATE utf8mb4_bin DEFAULT NULL COMMENT '商品描述',
  `stock_s` int(100) DEFAULT 0 COMMENT 's庫存',
  `stock_m` int(100) DEFAULT 0 COMMENT 'm庫存',
  `stock_l` int(100) DEFAULT 0 COMMENT 'l庫存',
  `stock_xl` int(100) DEFAULT 0 COMMENT 'xl庫存',
  `stock_total` int(100) NOT NULL DEFAULT 0 COMMENT '總庫存',
  `price` int(11) NOT NULL COMMENT '商品價錢',
  `img_num` int(11) NOT NULL COMMENT '圖片數量',
  `time` datetime NOT NULL DEFAULT current_timestamp() COMMENT '建立時間',
  `img_Locate` varchar(200) COLLATE utf8mb4_bin NOT NULL COMMENT '圖片位置'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `goods`
--

INSERT INTO `goods` (`id`, `category`, `title`, `information`, `stock_s`, `stock_m`, `stock_l`, `stock_xl`, `stock_total`, `price`, `img_num`, `time`, `img_Locate`) VALUES
(00001, 'cloth', 'Petal T-shirts(White)', '\r\nInspired form single \"砂漠のきみへ/Girls\"<br>\r\n■素材 綿100%', 20, 20, 20, 20, 80, 790, 5, '2021-06-28 00:00:00', 'D:\\xampp\\htdocs\\shopTest\\shopImg\\Item1'),
(00002, 'cloth', 'Petal T-shirts(Black)', 'Inspired form single \"砂漠のきみへ/Girls\"\r\n<br>\r\n■素材 綿100%', 20, 20, 20, 20, 80, 790, 5, '0000-00-00 00:00:00', 'D:\\xampp\\htdocs\\shopTest\\shopImg\\Item2'),
(00005, 'cloth', 'Ghost Hoddie(White)', 'Inspired form single \"ghosts\"<br>\r\n■素材 綿100%', 20, 20, 20, 20, 80, 1790, 5, '2021-06-27 14:01:11', 'D:\\xampp\\htdocs\\shopTest\\shopImg\\Item3'),
(00006, 'cloth', 'Ghost Hoddie(Black)', 'Inspired form single \"ghosts\"<br>\r\n■素材 綿100%', 20, 20, 20, 20, 80, 1790, 5, '2021-06-27 14:01:11', 'D:\\xampp\\htdocs\\shopTest\\shopImg\\Item4'),
(00007, 'lifestyle', 'powers Bag', 'Inspired form album \"powers\"<br>\r\n■Size<br>\r\nBag：360×370×110(mm)\r\nGrip：25×470(ｍｍ)<br>\r\n■material<br>\r\ncotton', 0, 0, 0, 0, 30, 390, 4, '2021-06-27 14:21:42', 'D:\\xampp\\htdocs\\shopTest\\shopImg\\Item5'),
(00008, 'lifestyle', 'Ruler', '■Size<br>\r\nW230×H30mm<br>\r\n■material<br>\r\npolyvinyl chloride(PVC)', 0, 0, 0, 0, 30, 300, 5, '2021-06-27 14:21:42', 'D:\\xampp\\htdocs\\shopTest\\shopImg\\Item6'),
(00009, 'lifestyle', 'Mask', 'Inspired form single \"変身\"<br>\r\n■Material<br>\r\n IceSilk', 0, 0, 0, 0, 30, 200, 5, '2021-06-27 16:03:11', 'D:\\xampp\\htdocs\\shopTest\\shopImg\\Item7'),
(00010, 'cloth', 'Tender Eye T-shirt', '■素材<br>\r\n綿100%', 20, 20, 20, 20, 80, 790, 5, '2021-06-27 16:03:11', 'D:\\xampp\\htdocs\\shopTest\\shopImg\\Item8'),
(00012, 'cloth', 'K.O. T-shirt', '■素材<br>\r\n綿100%', 20, 20, 20, 20, 80, 790, 5, '2021-06-27 16:26:44', 'D:\\xampp\\htdocs\\shopTest\\shopImg\\Item9'),
(00013, 'lifestyle', 'Tender Little Bag', '■Size<br>\r\n175×260（mm)<br>\r\n\r\n■素材<br>\r\nCotton', 0, 0, 0, 0, 30, 550, 2, '2021-06-27 16:26:44', 'D:\\xampp\\htdocs\\shopTest\\shopImg\\Item10'),
(00014, 'lifestyle', 'Hitsuji Mug', '■Size<br>\r\n約φ81×93(mm)<br>\r\n\r\n■Capacity<br>\r\n260ml<br>\r\n\r\n■Material<br>\r\nStoneware', 0, 0, 0, 0, 30, 350, 3, '2021-06-27 16:32:47', 'D:\\xampp\\htdocs\\shopTest\\shopImg\\Item11'),
(00015, 'lifestyle', 'Hitsuji Notebook', '■Size<br>\r\nW145×H215×D12mm<br>\r\n\r\n■Material<br>\r\npaper,polyester', 0, 0, 0, 0, 30, 500, 1, '2021-06-27 16:32:47', 'D:\\xampp\\htdocs\\shopTest\\shopImg\\Item12');

-- --------------------------------------------------------

--
-- 資料表結構 `order_list`
--

CREATE TABLE `order_list` (
  `id` int(100) NOT NULL COMMENT '訂單id',
  `serial` varchar(100) COLLATE utf8mb4_bin NOT NULL COMMENT '訂單編號',
  `member_Sender_Id` longtext COLLATE utf8mb4_bin NOT NULL COMMENT '會員&寄件姓名',
  `item` longtext COLLATE utf8mb4_bin NOT NULL COMMENT '訂單商品' CHECK (json_valid(`item`)),
  `phone` int(50) NOT NULL COMMENT '訂單電話',
  `email` varchar(100) COLLATE utf8mb4_bin NOT NULL COMMENT '訂單信箱',
  `address` varchar(255) COLLATE utf8mb4_bin NOT NULL COMMENT '訂單地址',
  `payment` enum('Cash','Card') COLLATE utf8mb4_bin NOT NULL DEFAULT 'Cash',
  `status` enum('shipped','nonshipped') COLLATE utf8mb4_bin NOT NULL DEFAULT 'nonshipped' COMMENT '訂單狀況',
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '訂單日期'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `order_list`
--

INSERT INTO `order_list` (`id`, `serial`, `member_Sender_Id`, `item`, `phone`, `email`, `address`, `payment`, `status`, `time`) VALUES
(51, 'c202107140039', '{\"account_Id\":\"011\",\"sender_Name\":\"POPO\"}', '[{\"item\":\"00007\",\"size_Qty\":{\"nan\":\"1\"}},{\"item\":\"00001\",\"size_Qty\":{\"M\":\"1\",\"XL\":\"3\"}}]', 8888, 'qq@11', '1236999', 'Card', 'nonshipped', '2021-07-14 03:28:35'),
(52, 'c202107140040', '{\"account_Id\":\"011\",\"sender_Name\":\"POPO\"}', '[{\"item\":\"00007\",\"size_Qty\":{\"nan\":\"1\"}},{\"item\":\"00001\",\"size_Qty\":{\"M\":\"1\",\"XL\":\"3\"}}]', 8888, 'qq@11222', '1236', 'Cash', 'nonshipped', '2021-07-14 03:29:47'),
(53, 'c202107140041', '{\"account_Id\":\"011\",\"sender_Name\":\"POPO\"}', '[{\"item\":\"00007\",\"size_Qty\":{\"nan\":\"1\"}},{\"item\":\"00001\",\"size_Qty\":{\"M\":\"1\",\"XL\":\"3\"}}]', 8888, 'qq@11222', '1236', 'Cash', 'nonshipped', '2021-07-14 03:29:47'),
(54, 'c202107140042', '{\"account_Id\":\"011\",\"sender_Name\":\"POPO\"}', '[{\"item\":\"00007\",\"size_Qty\":{\"nan\":\"1\"}},{\"item\":\"00001\",\"size_Qty\":{\"M\":\"1\",\"XL\":\"3\"}}]', 8888, 'qq@11', '1236', 'Cash', 'shipped', '2021-07-15 04:26:33'),
(55, 'c202107140043', '{\"account_Id\":\"011\",\"sender_Name\":\"POPO\"}', '[{\"item\":\"00007\",\"size_Qty\":{\"nan\":\"1\"}},{\"item\":\"00001\",\"size_Qty\":{\"M\":\"1\",\"XL\":\"3\"}}]', 8888, 'qq@11', '1236', 'Cash', 'shipped', '2021-07-15 04:26:33'),
(56, 'c202107140044', '{\"account_Id\":\"011\",\"sender_Name\":\"POPO\"}', '[{\"item\":\"00007\",\"size_Qty\":{\"nan\":\"1\"}},{\"item\":\"00001\",\"size_Qty\":{\"M\":\"1\",\"XL\":\"3\"}}]', 8888, 'qq@11', '1236', 'Cash', 'shipped', '2021-07-15 04:26:33'),
(57, 'c202107140045', '{\"account_Id\":\"011\",\"sender_Name\":\"POPO\"}', '[{\"item\":\"00007\",\"size_Qty\":{\"nan\":\"1\"}},{\"item\":\"00001\",\"size_Qty\":{\"M\":\"1\",\"XL\":\"3\"}}]', 8888, 'qq@11', '1236', 'Card', 'shipped', '2021-07-15 04:26:33'),
(58, 'c202107140046', '{\"account_Id\":\"011\",\"sender_Name\":\"LOLO\"}', '[{\"item\":\"00007\",\"size_Qty\":{\"nan\":\"1\"}},{\"item\":\"00001\",\"size_Qty\":{\"M\":\"1\",\"XL\":\"3\"}}]', 123456789, 'qq@11', '1236', 'Cash', 'shipped', '2021-07-15 04:26:33'),
(59, 'c202107140047', '{\"account_Id\":\"011\",\"sender_Name\":\"POPO23\"}', '[{\"item\":\"00007\",\"size_Qty\":{\"nan\":\"1\"}},{\"item\":\"00001\",\"size_Qty\":{\"M\":\"1\",\"XL\":\"3\"}}]', 8888, 'qq@11', '1236', 'Cash', 'nonshipped', '2021-07-14 03:53:16'),
(60, 'c202107140048', '{\"account_Id\":\"011\",\"sender_Name\":\"POPO\"}', '[{\"item\":\"00007\",\"size_Qty\":{\"nan\":\"1\"}},{\"item\":\"00001\",\"size_Qty\":{\"M\":\"1\",\"XL\":\"3\"}}]', 8888, 'qq@11', '1236', 'Card', 'nonshipped', '2021-07-14 05:58:25'),
(61, 'c202107140049', '{\"account_Id\":\"011\",\"sender_Name\":\"POPO\"}', '[{\"item\":\"00007\",\"size_Qty\":{\"nan\":\"1\"}},{\"item\":\"00001\",\"size_Qty\":{\"M\":\"1\",\"XL\":\"3\"}}]', 8888, 'qq@11', '1236', 'Cash', 'nonshipped', '2021-07-14 06:30:42'),
(62, 'c202107140050', '{\"account_Id\":\"011\",\"sender_Name\":\"POPO\"}', '[{\"item\":\"00002\",\"size_Qty\":{\"M\":\"2\"}},{\"item\":\"00008\",\"size_Qty\":{\"nan\":\"1\"}},{\"item\":\"00007\",\"size_Qty\":{\"nan\":\"1\"}}]', 8888, 'qq@11', '1236', 'Card', 'nonshipped', '2021-07-14 08:25:59'),
(63, 'c202107140051', '{\"account_Id\":\"011\",\"sender_Name\":\"POPO\"}', '[{\"item\":\"00002\",\"size_Qty\":{\"M\":\"2\"}},{\"item\":\"00008\",\"size_Qty\":{\"nan\":\"1\"}},{\"item\":\"00007\",\"size_Qty\":{\"nan\":\"1\"}}]', 8888, '333@88', '32144', 'Card', 'nonshipped', '2021-07-15 04:13:47'),
(64, 'c202107150001', '{\"account_Id\":\"011\",\"sender_Name\":\"POPO\"}', '[{\"item\":\"00002\",\"size_Qty\":{\"M\":\"2\"}},{\"item\":\"00008\",\"size_Qty\":{\"nan\":\"2\"}},{\"item\":\"00007\",\"size_Qty\":{\"nan\":\"1\"}}]', 8888, 'qq@11', '1236', 'Card', 'nonshipped', '2021-07-15 04:36:59'),
(65, 'c202107160001', '{\"account_Id\":\"011\",\"sender_Name\":\"POPO\"}', '[{\"item\":\"00001\",\"size_Qty\":{\"M\":\"1\"}}]', 8888, 'qq@11', '1236', 'Cash', 'nonshipped', '2021-07-15 20:00:30'),
(66, 'c202107160002', '{\"account_Id\":\"011\",\"sender_Name\":\"POPO\"}', '[]', 8888, 'qq@11', '1236', 'Card', 'nonshipped', '2021-07-15 20:03:11');

--
-- 觸發器 `order_list`
--
DELIMITER $$
CREATE TRIGGER `serial_Trigger` BEFORE INSERT ON `order_list` FOR EACH ROW BEGIN
SET @HEAD_WORD = 'c';
SET @LENG = 4;
SET @YMD = LEFT(REPLACE(NOW(),'-',''),8);
SET @NUM = 1;
SET @FIND_OLD = CONCAT(@HEAD_WORD,@YMD,'%');
IF EXISTS(SELECT * FROM order_list WHERE serial LIKE @FIND_OLD)
THEN
    SET @FIND_OLD = (SELECT serial FROM order_list WHERE serial LIKE @FIND_OLD ORDER BY serial DESC LIMIT 1);
    SET @NUM = CONVERT(RIGHT(@FIND_OLD,@LENG),SIGNED) + 1;
END IF;
SET @NUM = RIGHT(CONCAT(REPEAT('0',@LENG),CONVERT(@NUM,CHAR)),@LENG);
SET NEW.serial = CONCAT(@HEAD_WORD,@YMD,@NUM);
SET NEW.time = NOW();
END
$$
DELIMITER ;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `account`
--
ALTER TABLE `account`
  MODIFY `id` smallint(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT '會員id', AUTO_INCREMENT=23;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `goods`
--
ALTER TABLE `goods`
  MODIFY `id` smallint(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT '商品id', AUTO_INCREMENT=16;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT COMMENT '訂單id', AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
