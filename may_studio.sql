-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 年 04 月 12 日 22:16
-- 服务器版本: 5.5.47
-- PHP 版本: 5.6.20-1+deb.sury.org~precise+1

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
-- 表的结构 `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `post_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `story_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `content` varchar(500) DEFAULT NULL,
  `favour` int(11) DEFAULT NULL,
  `child` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `story_id` (`story_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `mood`
--

CREATE TABLE IF NOT EXISTS `mood` (
  `user_id` int(11) DEFAULT NULL,
  `post_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` varchar(500) DEFAULT NULL,
  `child` tinyint(1) DEFAULT '0',
  `favour` int(11) DEFAULT '0',
  `parent_id` int(11) DEFAULT '0',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `mood`
--

INSERT INTO `mood` (`user_id`, `post_time`, `content`, `child`, `favour`, `parent_id`, `id`) VALUES
(1, '2016-04-01 08:37:56', '心灵想要大声呼喊', 0, 0, 0, 1),
(1, '2016-04-01 08:44:25', '有时候他会迷失在那些古老的世界里，在那里人们生老病死，一切自然；在那里做出来的事覆水难收；在那里罪恶无法预防，幸福也无法规划，滑铁卢战役打输了，就真的作为败战永留史册。有一首他很喜欢的诗说道，亲手写下的字句，永远也不可能被抹去。', 1, 2, 0, 2),
(2, '2016-04-08 04:32:34', '所有人体轮廓测量都是通过把人体分为各个部分来测量的。', 1, 0, 2, 3),
(2, '2016-04-11 04:54:59', '时间都去哪了', 1, 0, 2, 4),
(1, '2016-04-11 05:17:48', '日光底下无新事，已有的事后必再有，已行的事后必再行。', 0, 0, 4, 5),
(1, '2016-04-11 06:20:08', '脱下常日的假面，奔向梦幻的疆界', 1, 0, 4, 6),
(2, '2016-04-12 02:29:39', '昨天太近明天太远', 0, 0, 6, 7),
(2, '2016-04-12 02:32:55', 'like sunday,like rain', 1, 1, 0, 16),
(1, '2016-04-12 02:34:17', '教练，我想打篮球', 0, 0, 16, 17);

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
  `comment` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `author` (`author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `stories`
--

INSERT INTO `stories` (`id`, `title`, `author`, `public_time`, `picture`, `category`, `comment`) VALUES
(1, '生活小贴士之剃须篇', 1, '2016-03-15 08:08:04', '01', '生活小贴士', 0),
(2, '实习感想', 1, '2016-03-15 08:08:31', '02', NULL, 0),
(3, '独立自强新女性必备小工具', 1, '2016-03-15 08:09:16', '03', NULL, 0),
(4, '信用卡的额外功能', 1, '2016-03-15 09:02:44', '04', NULL, 0),
(5, '人类进化新方向', 1, '2016-03-15 09:03:53', '05', NULL, 0),
(6, '讲一个故事', 1, '2016-03-15 09:03:53', '06', NULL, 0),
(7, '灰蓝牌洗衣机', 1, '2016-03-15 09:08:05', '07', NULL, 0),
(8, '续一个故事', 1, '2016-03-15 09:08:05', '08', NULL, 0),
(9, '生活小贴士之脱毛篇', 1, '2016-03-15 09:09:57', '09', '生活小贴士', 0),
(10, '动物园里的百兽之王', 1, '2016-03-15 09:09:57', '10', NULL, 0),
(11, '2035年流行趋势分析', 1, '2016-03-16 06:47:51', '11', NULL, 0),
(12, '动物园的那些事', 1, '2016-03-16 06:49:13', '12', NULL, 0),
(13, '生活小贴士之如何穿睡衣出门', 1, '2016-03-16 06:49:13', '13', '生活小贴士', 0),
(14, '灰蓝旅行社', 1, '2016-03-16 06:50:53', '14', NULL, 0),
(15, '论坐大巴时的优越感', 1, '2016-03-16 06:50:53', '15', NULL, 0),
(16, '武林盟主的速成手册', 1, '2016-03-16 06:51:32', '16', NULL, 0),
(17, '灰蓝旅行社之牧羊少年的奇幻之旅', 1, '2016-03-16 06:52:25', '17', NULL, 0),
(18, '二零一五年的最后一天，怎么办', 1, '2016-03-16 06:53:45', '18', NULL, 0),
(19, '二零一六年的第一天，怎么办', 1, '2016-03-16 06:53:45', '19', NULL, 0),
(20, '一碗鸡汤', 1, '2016-03-16 06:54:00', '20', NULL, 0);

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
(1, 'admin', '25d55ad283aa400af464c76d713c07ad', '348127304@qq.com'),
(2, 'chenshiqu', 'dbf1e5c72cc11e9df87f1ced2cd730f1', 'chenshiqu@163.com'),
(3, 'zhouzuoren', 'e10adc3949ba59abbe56e057f20f883e', 'zhouzuoren@maystudio.com');

--
-- 限制导出的表
--

--
-- 限制表 `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`);

--
-- 限制表 `mood`
--
ALTER TABLE `mood`
  ADD CONSTRAINT `mood_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- 限制表 `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `stories_ibfk_1` FOREIGN KEY (`author`) REFERENCES `admin` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
