-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 年 03 月 16 日 15:43
-- 服务器版本: 5.5.47
-- PHP 版本: 5.6.19-1+deb.sury.org~precise+1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `may_studio`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(255) DEFAULT NULL,
  `password` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'adminstrator', '123123');

-- --------------------------------------------------------

--
-- 表的结构 `stories`
--

CREATE TABLE IF NOT EXISTS `stories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` char(255) DEFAULT NULL,
  `author` int(11) DEFAULT NULL,
  `public_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `picture` char(255) DEFAULT NULL,
  `category` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `author` (`author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `stories`
--

INSERT INTO `stories` (`id`, `title`, `author`, `public_time`, `picture`, `category`) VALUES
(1, '生活小贴士之剃须篇', 1, '2016-03-15 08:08:04', '01', '生活小贴士'),
(2, '实习感想', 1, '2016-03-15 08:08:31', '02', NULL),
(3, '独立自强新女性必备小工具', 1, '2016-03-15 08:09:16', '03', NULL),
(4, '信用卡的额外功能', 1, '2016-03-15 09:02:44', '04', NULL),
(5, '人类进化新方向', 1, '2016-03-15 09:03:53', '05', NULL),
(6, '讲一个故事', 1, '2016-03-15 09:03:53', '06', NULL),
(7, '灰蓝牌洗衣机', 1, '2016-03-15 09:08:05', '07', NULL),
(8, '续一个故事', 1, '2016-03-15 09:08:05', '08', NULL),
(9, '生活小贴士之脱毛篇', 1, '2016-03-15 09:09:57', '09', '生活小贴士'),
(10, '动物园里的百兽之王', 1, '2016-03-15 09:09:57', '10', NULL),
(11, '2035年流行趋势分析', 1, '2016-03-16 06:47:51', '11', NULL),
(12, '动物园的那些事', 1, '2016-03-16 06:49:13', '12', NULL),
(13, '生活小贴士之如何穿睡衣出门', 1, '2016-03-16 06:49:13', '13', '生活小贴士'),
(14, '灰蓝旅行社', 1, '2016-03-16 06:50:53', '14', NULL),
(15, '论坐大巴时的优越感', 1, '2016-03-16 06:50:53', '15', NULL),
(16, '武林盟主的速成手册', 1, '2016-03-16 06:51:32', '16', NULL),
(17, '灰蓝旅行社之牧羊少年的奇幻之旅', 1, '2016-03-16 06:52:25', '17', NULL),
(18, '二零一五年的最后一天，怎么办', 1, '2016-03-16 06:53:45', '18', NULL),
(19, '二零一六年的第一天，怎么办', 1, '2016-03-16 06:53:45', '19', NULL),
(20, '一碗鸡汤', 1, '2016-03-16 06:54:00', '20', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`) VALUES
(3, 'admin', '25d55ad283aa400af464c76d713c07ad', '348127304@qq.com');

--
-- 限制导出的表
--

--
-- 限制表 `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `stories_ibfk_1` FOREIGN KEY (`author`) REFERENCES `admin` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
