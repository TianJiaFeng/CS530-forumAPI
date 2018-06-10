-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 年 06 月 06 日 08:52
-- 服务器版本: 5.5.53
-- PHP 版本: 5.4.45

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `forum`
--

-- --------------------------------------------------------

--
-- 表的结构 `administer`
--

CREATE TABLE IF NOT EXISTS `administer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(55) NOT NULL,
  `userName` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `role` int(11) NOT NULL,
  `introduce` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `administer`
--

INSERT INTO `administer` (`id`, `email`, `userName`, `password`, `role`, `introduce`, `created`, `updated`) VALUES
(1, '940880136@qq.com', 'testing', '123456', 1, '', '2018-05-22 00:00:00', '2018-05-22 00:00:00'),
(3, 'tianjiafeng@gmail.com', 'moderator', '123456', 2, '', '2018-05-22 00:00:00', '2018-05-22 00:00:00'),
(4, 'jt887@drexel.edu', 'user', '123456', 3, '12345 account testing', '2018-05-22 19:47:54', '2018-05-25 21:09:03'),
(5, 'jt887@drexel.edu', 'createTesting', '123456', 3, '12345', '2018-05-23 05:12:42', '2018-05-23 05:12:42'),
(6, '123@123.com', '123', '123', 3, '', '2018-05-23 05:20:18', '2018-05-23 05:20:18'),
(7, 'mzaizailove@gmail.com', 'miao123', '123456', 3, '', '2018-05-27 23:29:13', '2018-05-27 23:29:13'),
(8, '123456@wer.com', 'gaoshi', 'gaoshigaoshi', 3, '', '2018-05-28 15:36:31', '2018-05-28 15:36:31'),
(9, 'jt887@drexel.edu', 'Jiafeng', '123456', 3, '123', '2018-06-04 19:59:38', '2018-06-04 19:59:38'),
(10, 'jt887@drexel.edu', 'Jiafeng Demo', '123456', 3, '', '2018-06-06 04:22:14', '2018-06-06 04:22:14'),
(12, 'jt887@drexel.edu', 'JiafengTian', '123456', 3, '', '2018-06-06 04:26:15', '2018-06-06 04:26:15'),
(13, 'jt887@drexel.edu', 'usertest', '123456', 2, 'add introduction', '2018-06-06 04:30:09', '2018-06-06 04:32:57'),
(14, 'jt887@drexel.edu', 'demo', '123456', 2, 'introduction', '2018-06-06 04:38:54', '2018-06-06 04:41:29');

-- --------------------------------------------------------

--
-- 表的结构 `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(55) NOT NULL,
  `comments` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `author`, `comments`, `created`, `updated`) VALUES
(2, 'testing2', '222222', 'user', 0, '2018-05-23 00:00:00', '2018-05-23 00:00:00'),
(3, 'addtest', '<p>123123<strong>1231231<em>23123123</em></strong></p>', 'user', 0, '2018-05-23 19:16:39', '2018-05-23 19:16:39'),
(4, 'addTesting1', '<p>123123<img src="http://cdn.bootcss.com/tinymce/4.3.12/plugins/emoticons/img/smiley-sealed.gif" alt="sealed" /></p>', 'moderator', 2, '2018-05-25 21:17:48', '2018-05-25 22:19:06'),
(5, 'addTesting2', '<p>123123123</p>', 'user', 7, '2018-05-23 19:18:07', '2018-05-24 13:51:05'),
(7, 'gaoshi', '<h1 style="text-align: center;">hahaah<img src="http://cdn.bootcss.com/tinymce/4.3.12/plugins/emoticons/img/smiley-cool.gif" alt="cool" /></h1>', 'gaoshi', 1, '2018-05-28 15:37:26', '2018-05-28 15:37:53'),
(9, 'test', '<p>123</p>', 'user', 0, '2018-05-28 22:07:08', '2018-05-28 22:07:08'),
(10, 'add test', '<p>1234</p>', 'user', 1, '2018-05-28 22:07:24', '2018-06-06 04:26:57'),
(11, 'add test2', '<p>12345</p>', 'user', 3, '2018-05-28 22:07:46', '2018-06-06 04:24:19'),
(14, 'demo post', '<p>demo post content</p>', 'demo', 1, '2018-06-06 04:39:46', '2018-06-06 04:40:10'),
(13, 'let us add a post', '<p>post content</p>', 'usertest', 2, '2018-06-06 04:31:03', '2018-06-06 04:39:23');

-- --------------------------------------------------------

--
-- 表的结构 `postcomments`
--

CREATE TABLE IF NOT EXISTS `postcomments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postID` int(11) NOT NULL,
  `author` varchar(55) NOT NULL,
  `content` text NOT NULL,
  `like` int(11) NOT NULL,
  `dislike` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `postcomments`
--

INSERT INTO `postcomments` (`id`, `postID`, `author`, `content`, `like`, `dislike`, `created`, `updated`) VALUES
(1, 5, 'user', 'comments test', 4, 1, '2018-05-24 02:00:00', '2018-05-25 20:44:21'),
(2, 5, 'user', 'comments test2', 3, 1, '2018-05-24 07:00:00', '2018-05-24 00:00:00'),
(3, 5, 'user', '<p>add comment test1</p>', 0, 0, '2018-05-24 17:07:34', '2018-05-24 17:07:34'),
(4, 5, 'user', '<p>number test</p>', 0, 0, '2018-05-24 17:23:30', '2018-05-24 17:23:30'),
(5, 5, 'user', '<p>number test 2</p>', 0, 0, '2018-05-24 17:24:05', '2018-05-24 17:24:05'),
(6, 5, 'user', '<p>number test 6</p>', 0, 0, '2018-05-24 17:26:21', '2018-05-24 17:26:21'),
(7, 5, 'moderator', '<p>moderator reply</p>', 0, 0, '2018-05-24 13:51:05', '2018-05-24 13:51:05'),
(8, 4, 'user', 'testing', 1, 0, '2018-05-25 00:00:00', '2018-05-25 00:00:00'),
(9, 4, 'moderator', '<p>comment testing</p>', 0, 0, '2018-05-25 22:19:06', '2018-05-25 22:19:06'),
(10, 6, 'miao123', '<p>6666</p>', 22, 7, '2018-05-27 23:30:52', '2018-05-28 15:27:24'),
(11, 7, 'gaoshi', '<p>xixi</p>', 10, 5, '2018-05-28 15:37:53', '2018-05-28 16:00:50'),
(12, 11, 'user', '<p>comments test</p>', 0, 0, '2018-06-04 18:36:11', '2018-06-04 18:36:11'),
(13, 11, 'Jiafeng', '<p>application123</p>', 0, 0, '2018-06-04 20:00:08', '2018-06-04 20:00:08'),
(14, 11, 'Jiafeng', '<p>add comment</p>', 0, 0, '2018-06-04 20:00:26', '2018-06-04 20:00:26'),
(16, 10, 'JiafengTian', '<p>Jiafeng Comment</p>', 0, 0, '2018-06-06 04:26:57', '2018-06-06 04:26:57'),
(17, 12, 'JiafengTian', '<p>let us add a comment</p>', 0, 0, '2018-06-06 04:27:48', '2018-06-06 04:27:48'),
(18, 12, 'usertest', '<p>let us add a comment</p>', 0, 0, '2018-06-06 04:30:43', '2018-06-06 04:30:43'),
(19, 13, 'usertest', '<p>add comment</p>', 0, 0, '2018-06-06 04:31:22', '2018-06-06 04:31:22'),
(20, 13, 'demo', '<p>let add a comment by demo</p>', 0, 0, '2018-06-06 04:39:23', '2018-06-06 04:39:23'),
(21, 14, 'demo', '<p>let us add acomment</p>', 3, 2, '2018-06-06 04:40:10', '2018-06-06 04:40:21');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
