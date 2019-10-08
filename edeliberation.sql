-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1:3306
-- 生成日期： 2019-09-17 11:42:41
-- 服务器版本： 5.7.26
-- PHP 版本： 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `edeliberation`
--

-- --------------------------------------------------------

--
-- 表的结构 `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `consultation_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `ancestor_id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `text` varchar(10000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `comments`
--

INSERT INTO `comments` (`consultation_id`, `thread_id`, `comment_id`, `parent_id`, `ancestor_id`, `user`, `date_time`, `text`) VALUES
(1, 1, 1, 0, 0, 'Dimitar', '2019-08-23 10:46:09', 'general comment 1'),
(1, 1, 2, 0, 0, 'Dimitar', '2019-08-23 10:46:27', 'general comment 2'),
(1, 2, 3, 0, 0, 'Dimitar', '2019-08-23 10:46:52', 'technical comment 1'),
(1, 2, 4, 0, 0, 'Dimitar', '2019-08-23 10:47:32', 'technical comment 2'),
(1, 3, 5, 0, 0, 'Dimitar', '2019-08-23 10:47:48', 'environmental comment 1'),
(1, 3, 6, 0, 0, 'Dimitar', '2019-08-23 10:48:11', 'environmental comment 2'),
(1, 4, 7, 0, 0, 'Dimitar', '2019-08-23 10:57:35', 'industry comment 1'),
(1, 4, 8, 0, 0, 'Dimitar', '2019-08-23 10:57:54', 'industry comment 2'),
(1, 5, 9, 0, 0, 'Dimitar', '2019-08-23 10:58:13', 'social comment 1'),
(1, 5, 10, 0, 0, 'Dimitar', '2019-08-23 10:58:28', 'social comment 2'),
(1, 6, 11, 0, 0, 'Dimitar', '2019-08-23 10:58:40', 'employment comment 1'),
(1, 6, 12, 0, 0, 'Dimitar', '2019-08-23 10:58:56', 'employment comment 2'),
(1, 1, 13, 1, 1, 'Dimitar1', '2019-08-24 12:24:14', 'general comment 1 reply'),
(1, 1, 14, 2, 2, 'Dimitar1', '2019-08-24 12:24:32', 'general comment 2 reply'),
(1, 1, 15, 1, 1, 'Dimitar1', '2019-08-24 21:22:43', 'general comment 1 reply 2'),
(1, 1, 16, 13, 1, 'Dimitar2', '2019-08-24 22:15:19', 'general comment 1 reply reply1'),
(1, 1, 17, 14, 2, 'Dimitar2', '2019-08-25 13:42:44', 'general comment 2 reply reply');

-- --------------------------------------------------------

--
-- 表的结构 `consultation_detail`
--

DROP TABLE IF EXISTS `consultation_detail`;
CREATE TABLE IF NOT EXISTS `consultation_detail` (
  `consultation_id` int(11) NOT NULL,
  `link_id` varchar(100) NOT NULL,
  `target_audience` varchar(10000) NOT NULL,
  `reasons` varchar(10000) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `email` varchar(100) NOT NULL,
  `threads_id` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `consultation_detail`
--

INSERT INTO `consultation_detail` (`consultation_id`, `link_id`, `target_audience`, `reasons`, `address`, `email`, `threads_id`) VALUES
(1, '1', 'target content', 'reasons content', 'address content', 'email_address@abc.com', '1;2;3;4;5;6'),
(2, '1', 'target content', 'reasons content', 'address content', 'email_address@abc.com', '1;2;3;4;5;6'),
(3, '1', 'target content', 'reasons content', 'address content', 'email_address@abc.com', '1;2;3;4;5;6'),
(4, '1', 'target content', 'reasons content', 'address content', 'email_address@abc.com', '1;2;3;4;5;6');

-- --------------------------------------------------------

--
-- 表的结构 `consultation_main`
--

DROP TABLE IF EXISTS `consultation_main`;
CREATE TABLE IF NOT EXISTS `consultation_main` (
  `consultation_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `open_date` date NOT NULL,
  `close_date` date NOT NULL,
  `status` int(100) NOT NULL,
  PRIMARY KEY (`consultation_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `consultation_main`
--

INSERT INTO `consultation_main` (`consultation_id`, `title`, `topic_id`, `open_date`, `close_date`, `status`) VALUES
(1, 'Consultation on the list of candidate Projects of Common Interest in smart grids', 1, '2019-08-01', '2019-08-02', 1),
(2, 'Consultation on the list of candidate Projects of Common Interest in smart grids', 1, '2019-08-03', '2019-08-04', 0),
(3, 'Consultation on the list of candidate Projects of Common Interest in smart grids', 1, '2019-08-05', '2019-08-06', 0),
(4, 'Consultation on the list of candidate Projects of Common Interest in smart grids', 1, '2019-08-07', '2019-08-08', 1);

-- --------------------------------------------------------

--
-- 表的结构 `links`
--

DROP TABLE IF EXISTS `links`;
CREATE TABLE IF NOT EXISTS `links` (
  `link_id` int(11) NOT NULL,
  `link` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `links`
--

INSERT INTO `links` (`link_id`, `link`) VALUES
(1, 'https://www.computing.dcu.ie/~dshterionov/presentations/me.pdf');

-- --------------------------------------------------------

--
-- 表的结构 `threads`
--

DROP TABLE IF EXISTS `threads`;
CREATE TABLE IF NOT EXISTS `threads` (
  `thread_id` int(11) NOT NULL,
  `thread` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `threads`
--

INSERT INTO `threads` (`thread_id`, `thread`) VALUES
(1, 'general'),
(2, 'technical'),
(3, 'environmental'),
(4, 'industry'),
(5, 'social'),
(6, 'employment');

-- --------------------------------------------------------

--
-- 表的结构 `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `topic_id` int(11) NOT NULL,
  `topic` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `topics`
--

INSERT INTO `topics` (`topic_id`, `topic`) VALUES
(1, 'Energy');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
