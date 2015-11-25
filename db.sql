-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2015 at 09:58 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `slug` varchar(50) NOT NULL,
  `user_id` int(4) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `web` varchar(30) NOT NULL,
  `comment` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `slug`, `user_id`, `name`, `email`, `web`, `comment`, `time`) VALUES
(42, 'index', 0, 'Dil afroz Liza', 'liza@gmail.com', 'http://codersaiful.com', 'Developer by ELANCE TEST. My objective is to work honestly with my clients. I always focus on delivering the best quality with in the given period of time. WEB DEVELOPER from last 5 years. Now work only at Elance.(F', '2015-11-24 08:34:20'),
(43, 'sitemap.xml', 0, 'Saiful Islam', 'saiful.idb70@gmail.com', 'http://codersaiful.com', 'Welcom to all', '2015-11-24 08:39:25'),
(44, 'index', 0, 'Saiful Islam', 'saiful.idb70@gmail.com', 'http://codersaiful.com', 'ELANCE TEST. My objective is to work honestly with my clients. I always focus on delivering the best quality with in the given period of time. WEB DEVE', '2015-11-24 08:40:43');

-- --------------------------------------------------------

--
-- Table structure for table `controller`
--

CREATE TABLE IF NOT EXISTS `controller` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `slug` varchar(200) NOT NULL,
  `type` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `controller`
--

INSERT INTO `controller` (`id`, `slug`, `type`) VALUES
(1, '404', '404'),
(2, 'index', 'index'),
(54, 'about-me', 'page'),
(57, 'my-self', 'page'),
(64, 'wordpress-website-bangladesh', 'portfolio'),
(65, 'amar-portfolio-testing', 'portfolio'),
(66, 'hire-me', 'page'),
(67, 'contact', 'page'),
(69, 'blog', 'blog'),
(70, 'sitemap.xml', 'page');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `time` timestamp NOT NULL,
  `auth_user_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `json` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `json`) VALUES
(1, 'main_menu', '{\r\n"home":{"title":"Home","slug":"","attr":"Go To Home"},\r\n"contact":{"title":"Contact","slug":"contact","attr":"Contact Me"},\r\n"download":{"title":"Download","slug":"download","attr":"Downloading Here"}\r\n}'),
(2, 'footer', '{\n"5":{"title":"Top","slug":"#top","attr":"Top"},\n"2":{"title":"Download","slug":"download","attr":"Downloading Here"},\n"6":{"title":"Contact","slug":"contact","attr":"Contact Me"},\n"4":{"title":"Tops","slug":"#topd","attr":"Topd"},\n"1":{"title":"Download","slug":"download","attr":"Downloading Here"},\n"3":{"title":"Contact","slug":"contact","attr":"Contact Me"}\n}');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_key` varchar(50) NOT NULL,
  `option_name` varchar(150) DEFAULT NULL,
  `option_value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `option_key`, `option_name`, `option_value`) VALUES
(1, 'site_title', 'Site Name', 'Saiful Islam'),
(2, 'site_slogan', 'Site Slogan', 'sss'),
(3, 'site_description', 'Site Description', 'xxx'),
(4, 'list_amount', 'Post List Limit', '10'),
(6, 'post_type_portfolio', 'Portfolio Post', 'portfolio'),
(7, 'current_template', 'Current Template', 'Basic'),
(8, 'site_url', 'Site''s URL', 'http://localhost/cms/'),
(9, '404', '404 ERROR', '404 ERROR - NOTHING FOUND PAGE');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `content` text,
  `type` varchar(10) DEFAULT 'post' COMMENT 'post,page,portfolio',
  `auth_user_id` int(10) DEFAULT NULL,
  `tags` varchar(150) DEFAULT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `slug`, `content`, `type`, `auth_user_id`, `tags`, `time`, `update_time`) VALUES
(44, 'My Self', 'my-self', 'I am Certified Developer by ELANCE TEST. My objective is to work honestly with my clients. I always focus on delivering the best quality with in the given period of time. \nWEB DEVELOPER from last 5 years. Now work only at Elance.(FULL TIME FREELANCER-24HRS online available) At before I have worked few company of our Bangladesh.', 'page', 1, 'my self, saiful, codersaiful, about saiful, about codersaiful', '2015-11-19 11:40:18', NULL),
(47, 'ABOUT ME', 'about-me', 'Saiful Islam - is a great web developer in Bangladesh. More than 5 years as web designer and developer, as programmer, as OS network administrator in several IT companies. a wordpress guru + wordpress expert. It''s a simple cool man. Like science fiction creative thought, high thought. Interested to fix complex without my personal complexity.', 'page', 1, 'my self, saiful, codersaiful, about saiful, about codersaiful', '2015-11-19 11:40:18', NULL),
(54, 'WordPress Website Bangladesh', 'wordpress-website-bangladesh', 'This is portfolio website bangladesh. welcome to all. This is portfolio website bangladesh. welcome to all. This is portfolio website bangladesh. welcome to all. This is portfolio website bangladesh. welcome to all. This is portfolio website bangladesh. welcome to all. This is portfolio website bangladesh. welcome to all. This is portfolio website bangladesh. welcome to all. This is portfolio website bangladesh. welcome to all. ', 'portfolio', 1, 'bangladesh, this is, hewl, welcome, tala, etc', '2015-11-21 06:38:28', NULL),
(55, 'Saiful Islam', 'amar-portfolio-testing', 'hello, welcome to all to my personal portfolio page. hello, welcome to all to my personal portfolio page. hello, welcome to all to my personal portfolio page. hello, welcome to all to my personal portfolio page. hello, welcome to all to my personal portfolio page. hello, welcome to all to my personal portfolio page. ', 'portfolio', 1, 'portfolio, test, etc, testing', '2015-11-21 07:03:14', NULL),
(56, 'Hire Me', 'hire-me', 'Hire to me. I am Saiful Islam. I have been working from last five years.', 'page', 1, 'hire me, hire saiful, saiful hire, codersaiful', '2015-11-21 22:42:18', NULL),
(57, 'My Personal Blog', 'blog', 'sksksl dlsl ', 'page', 1, 'blog', '2015-11-24 04:57:31', NULL),
(58, 'Site map', 'sitemap.xml', 'Welcom to all', 'page', 1, '', '2015-11-24 05:33:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `auth_code` varchar(100) DEFAULT NULL,
  `active` int(11) NOT NULL COMMENT '1 equal actiove and 0 equal inactive',
  `social_info` varchar(300) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `fullname`, `password`, `auth_code`, `active`, `social_info`, `url`) VALUES
(1, 'saiful', 'saiful@gmail.com', 'Saiful Islam', 'e10adc3949ba59abbe56e057f20f883e', '', 1, '', 'http://codersaiful.com'),
(2, 'sojib', 'sojib@gmail.com', 'Ekfar Sajol', '454654564654654560546556', 'dkdkj kdjfk dkfj dkjf kdjf', 1, NULL, 'http://sojib.com'),
(3, 'alom', 'alom@gmail.com', 'Alomgir Hossain', 'e10adc3949ba59abbe56e057f20f883e', NULL, 1, NULL, 'http://google.com');

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE IF NOT EXISTS `visitor` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `post_id` int(10) NOT NULL,
  `value` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
