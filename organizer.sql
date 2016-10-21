-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2016 at 11:52 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `organizer`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `value` varchar(8) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`value`, `id`) VALUES
('EAST', 1),
('NOTRH', 2),
('SOUTH', 3),
('WEST', 4),
('Rohtak', 5),
('R', 6);

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `type` char(3) DEFAULT NULL,
  `area` char(3) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `description` text,
  `user_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `name`, `type`, `area`, `mail`, `description`, `user_id`, `time`) VALUES
(49, 'changing club', 'MUS', 'NOR', '', '						 \r\n				', 3, '2016-06-28 04:42:24'),
(51, 'casioPlayers', 'MUS', 'NOR', 'cbalhra@gmail.com', 'playMusic			 \r\n	', 5, '2016-06-28 04:42:24'),
(54, NULL, NULL, NULL, NULL, NULL, 8, '2016-06-28 04:42:24'),
(55, 'FightClub', 'COM', 'NOR', 'cbalhra@yahoo.com', 'Always ready to fight............. ;)		 \r\n	', 9, '2016-06-28 04:42:24'),
(56, 'newClub', 'MUS', 'NOR', 'newMail', 'newD						 \r\n				', 10, '2016-06-28 04:42:24'),
(57, NULL, NULL, NULL, NULL, NULL, 11, '2016-06-28 04:42:24'),
(58, NULL, NULL, NULL, NULL, NULL, 12, '2016-06-28 04:42:24'),
(59, 'poi', 'MUS', 'NOR', 'poi', 'poi						 \r\n				', 13, '2016-06-28 04:42:24'),
(60, NULL, NULL, NULL, NULL, NULL, 14, '2016-06-28 04:42:24'),
(61, 'NOCLUB', 'NEW', '1', 'adkmksd', 'mvakvd						 \r\n				', 15, '2016-07-02 07:23:06'),
(62, 'Anurag', 'MUS', 'NOR', 'anurag.1@iitj.ac.in', '', 16, '2016-06-28 04:42:24'),
(63, NULL, NULL, NULL, NULL, NULL, 17, '2016-06-28 15:04:25'),
(64, NULL, NULL, NULL, NULL, NULL, 18, '2016-07-22 00:40:42'),
(65, NULL, NULL, NULL, NULL, NULL, 19, '2016-07-22 01:14:31'),
(66, NULL, NULL, NULL, NULL, NULL, 20, '2016-07-22 01:16:19'),
(67, NULL, NULL, NULL, NULL, NULL, 21, '2016-07-24 18:40:33'),
(68, NULL, NULL, NULL, NULL, NULL, 22, '2016-07-26 18:06:46');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `description` text,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `comment_on` varchar(8) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `description`, `post_id`, `user_id`, `comment_on`, `time`) VALUES
(2, 'comment', 62, 3, 'posts', '2016-07-08 11:24:28'),
(3, 'comment', 62, 3, 'posts', '2016-07-08 11:31:05'),
(4, 'comment', 62, 3, 'posts', '2016-07-08 11:32:55'),
(5, 'comment', 62, 3, 'posts', '2016-07-08 11:34:14'),
(6, 'comment', 62, 3, 'posts', '2016-07-08 11:34:20'),
(7, 'comment', 62, 3, 'posts', '2016-07-08 11:35:11'),
(8, 'comment', 68, 3, 'posts', '2016-07-08 11:58:29'),
(9, 'comment1', 62, 3, 'posts', '2016-07-08 12:04:31'),
(10, 'comment', 41, 3, 'posts', '2016-07-19 11:45:14'),
(11, 'comment', 41, 3, 'posts', '2016-07-19 11:45:15'),
(12, 'comment', 41, 3, 'posts', '2016-07-19 11:45:15'),
(13, 'comment', 41, 3, 'posts', '2016-07-19 11:45:16'),
(14, 'comment', 41, 3, 'posts', '2016-07-19 11:45:22'),
(15, 'comment', 41, 3, 'posts', '2016-07-19 11:45:26');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `etype` char(3) DEFAULT NULL,
  `earea` char(3) DEFAULT NULL,
  `edate` int(11) DEFAULT NULL,
  `ename` varchar(100) DEFAULT NULL,
  `evenue` varchar(100) DEFAULT NULL,
  `eaddress` varchar(255) DEFAULT NULL,
  `ezip` varchar(20) DEFAULT NULL,
  `edescription` text,
  `club_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `etype`, `earea`, `edate`, `ename`, `evenue`, `eaddress`, `ezip`, `edescription`, `club_id`) VALUES
(3, 'SOC', 'WES', NULL, 'tv_watch', 'TV_Room', NULL, NULL, 'watch tv and have fun			 \r\n	', 61),
(4, 'COM', 'NOR', NULL, 'coding_c', 'CC_Lab', NULL, NULL, 'learn and practice programming			 \r\n	', 61),
(6, 'MUS', 'EAS', NULL, 'Casio', 'MusicRoom', NULL, NULL, 'MusicMusic			 \r\n	', 61),
(7, 'COM', 'NOR', NULL, 'Hackatho', 'CC', NULL, NULL, 'compete with best programming minds from the institutes			 \r\n	', 61),
(8, 'MUS', 'NOR', NULL, 'Music Mania', 'musicRoom', NULL, NULL, '			 \r\n	', 51),
(9, 'MUS', 'NOR', NULL, 'can''t Frighten U', 'Shanti Nivash', NULL, NULL, 'Casio se Annu nhi Darega		 \r\n	', 55),
(10, 'MUS', 'NOR', NULL, 'newEvent', 'newVenue', NULL, NULL, 'newDescription ', 0),
(21, 'MUS', 'NOR', NULL, 'p', 'o', NULL, NULL, 'i ', 61),
(22, 'MUS', 'NOR', NULL, 'oiu', 'op', NULL, NULL, 'io ', 3),
(23, 'MUS', 'NOR', NULL, 'MyEvent', 'E1', NULL, NULL, ' E11', 16);

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `user1_id` int(11) DEFAULT NULL,
  `user2_id` int(11) DEFAULT NULL,
  `status` varchar(8) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`user1_id`, `user2_id`, `status`, `id`, `time`) VALUES
(16, 5, 'success', 12, '2016-06-28 04:43:11'),
(16, 3, 'success', 13, '2016-06-28 04:43:11'),
(9, 5, 'success', 17, '2016-06-28 04:43:11'),
(9, 3, 'success', 18, '2016-06-28 04:43:11'),
(9, 15, 'success', 19, '2016-06-28 04:43:11'),
(9, 16, 'success', 20, '2016-06-28 04:43:11'),
(16, 15, 'success', 22, '2016-06-28 04:43:11'),
(5, 15, 'pending', 25, '2016-06-28 04:43:11'),
(15, 3, 'success', 26, '2016-07-07 01:31:37'),
(15, 17, 'success', 27, '2016-07-07 01:34:59'),
(3, 17, 'success', 28, '2016-07-07 01:34:51'),
(21, 3, 'success', 29, '2016-07-24 18:41:03');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `IsShare` int(11) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `time`, `IsShare`) VALUES
(22, 3, 63, '2016-06-28 17:11:12', 3),
(23, 3, 67, '2016-06-29 09:41:37', 3),
(24, 3, 69, '2016-07-02 06:51:30', 3),
(26, 17, 42, '2016-07-07 09:35:56', 3),
(169, 3, 70, '2016-07-08 06:53:31', 3),
(172, 3, 68, '2016-07-13 13:16:17', 3),
(175, 3, 62, '2016-07-18 09:15:22', 3),
(176, 3, 41, '2016-07-18 09:47:30', 3);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `login` varchar(8) NOT NULL,
  `password` varchar(8) NOT NULL,
  `DP` text,
  `sess_id` text NOT NULL,
  `firstname` varchar(8) NOT NULL,
  `lastname` varchar(8) NOT NULL,
  `dob` date NOT NULL,
  `online` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sess_ip` text NOT NULL,
  `area_id` int(11) NOT NULL,
  `CP` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `login`, `password`, `DP`, `sess_id`, `firstname`, `lastname`, `dob`, `online`, `time`, `sess_ip`, `area_id`, `CP`) VALUES
(3, 'Anurag', 'windows8', 'uploads/1467219631IMG_20160514_145715.jpg', '9ipoqs9lovd9re2taamve19dt6', 'anurag', 'Balhra', '1998-01-20', 1, '2016-10-20 05:19:27', '::1', 5, 'uploads/1467219631IMG_20160514_145715.jpg'),
(5, 'chiki', 'chiki', 'uploads/28025_411424468926341_2004730299_n.jpg', 'm7bkv7u1e4vi0mpmprccqpcd56', 'chirag', 'Balhra', '1996-01-16', 0, '2016-06-28 19:40:32', '::1', 0, ''),
(9, 'chirag', '2940', 'uploads/FB_IMG_1428346773398.jpg', '0lphg34l9jlfb3gndu5dae9ds7', 'Chirag', 'Balhra', '1996-01-16', 0, '2016-06-29 09:55:38', '::1', 0, ''),
(15, 'poi', 'poi', 'uploads/IMG_20160511_153143.jpg', '3l0ijvirvba1156imgggrjk641', 'poi', 'poi', '1996-01-16', 0, '2016-08-21 05:25:57', '::1', 0, ''),
(16, 'anuragB', 'anuragB', 'uploads/146721975720160304_161200.jpg', 'l4objr8cgcdd2b2aauh4ddre40', 'anu', 'Balhra', '1998-01-20', 0, '2016-07-08 09:52:26', '::1', 0, ''),
(17, 'signup', 'signup', 'uploads/146721931828025_411424468926341_2004730299_n.jpg', 'l4objr8cgcdd2b2aauh4ddre40', 'sign', 'up', '2016-01-10', 1, '2016-07-18 11:01:12', '::1', 0, ''),
(18, 'test', 'test', NULL, 'l4objr8cgcdd2b2aauh4ddre40', '', '', '0000-00-00', 0, '2016-07-22 00:43:58', '::1', 0, ''),
(19, 'nolimit@', 'nolimit', NULL, '', '', '', '0000-00-00', 0, '2016-07-22 01:14:31', '', 0, ''),
(20, 'check', 'check', NULL, 'l4objr8cgcdd2b2aauh4ddre40', '', '', '0000-00-00', 0, '2016-07-24 18:39:39', '::1', 0, ''),
(21, 'akshat', 'asd', NULL, 'in3ah3ahse01rpgbhtfrbjt8j6', 'akshat', 'agrawal', '0000-00-00', 1, '2016-07-24 18:41:54', '::1', 0, ''),
(22, 'asgupta9', '1234', NULL, '6v4c45de3jm5n75ubsgn1f2sg0', '', '', '0000-00-00', 0, '2016-07-26 18:11:36', '10.2.27.152', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `msg` text,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `msg`, `sender_id`, `receiver_id`, `status`, `time`) VALUES
(12, 'msg1 ', 5, 16, 1, '2016-06-28 15:00:18'),
(13, 'msg2 ', 5, 16, 1, '2016-06-28 15:00:18'),
(14, 'msg3 ', 5, 16, 1, '2016-06-28 15:00:18'),
(15, 'new msg ', 15, 9, 1, '2016-06-28 19:47:18'),
(16, ' basic chatting ', 3, 9, 1, '2016-06-28 19:47:20'),
(17, 'cool ', 9, 3, 1, '2016-06-28 19:47:50'),
(18, 'newChat ', 3, 9, 1, '2016-06-29 12:05:32'),
(21, 'poi ', 3, 9, 1, '2016-06-29 12:05:32'),
(22, 'one more poi ', 3, 9, 1, '2016-06-29 12:05:32'),
(23, '1\r\n ', 3, 3, 0, '2016-06-29 09:20:54'),
(24, '1 ', 3, 9, 1, '2016-06-29 12:05:32'),
(25, '2 ', 3, 9, 1, '2016-06-29 12:05:32'),
(26, '123 ', 3, 3, 0, '2016-06-29 09:45:03'),
(28, '1 ', 15, 9, 0, '2016-06-29 09:54:03'),
(29, '123 ', 9, 15, 1, '2016-06-29 12:05:32'),
(30, '321 ', 15, 9, 0, '2016-06-29 09:56:35'),
(31, ' 15 ', 9, 15, 1, '2016-06-29 12:05:32'),
(32, ' 3 ', 9, 3, 1, '2016-06-29 12:17:38'),
(33, ' 5 ', 9, 5, 0, '2016-06-29 11:52:38'),
(34, ' 16 ', 15, 16, 1, '2016-06-29 17:20:37'),
(35, ' 9 ', 3, 9, 1, '2016-06-29 12:19:50'),
(36, ' 9asdfasf ', 3, 9, 0, '2016-06-29 16:24:26'),
(37, 'sadfkldsjs ', 3, 9, 0, '2016-06-29 16:24:42'),
(38, 'sdkvjspid ', 3, 9, 0, '2016-06-29 16:24:53'),
(39, ' 5 ', 16, 5, 0, '2016-06-29 17:28:09'),
(40, ' fdhgf ', 16, 5, 0, '2016-06-29 17:48:32'),
(41, 'argrgfd ', 16, 5, 0, '2016-06-29 17:48:39'),
(42, ' lkjnmk ', 16, 5, 0, '2016-06-29 17:58:08'),
(45, ' 123 ', 15, 16, 0, '2016-07-07 00:45:46'),
(46, '456 ', 15, 16, 0, '2016-07-07 00:45:57'),
(47, ' 9143758 ', 15, 9, 0, '2016-07-07 01:12:18'),
(48, ' 911 ', 15, 9, 0, '2016-07-07 01:18:49'),
(49, ' 1624 ', 15, 16, 0, '2016-07-07 01:19:09'),
(50, 'ping ', 15, 3, 1, '2016-07-07 02:11:47'),
(51, ' 9 ', 3, 9, 0, '2016-07-07 02:50:44'),
(52, ' 9 ', 3, 9, 0, '2016-07-07 02:53:40'),
(53, ' asdfg ', 3, 9, 0, '2016-07-08 09:36:22'),
(54, 'lkjh ', 3, 9, 0, '2016-07-08 09:36:33'),
(55, ' hey aB ', 3, 16, 0, '2016-07-18 09:27:13'),
(56, ' new msg ', 17, 15, 1, '2016-07-18 11:01:21'),
(57, ' 2 msg kyu  ', 15, 17, 0, '2016-07-18 11:02:13'),
(58, ' abhi bhi 2 msg ', 15, 9, 0, '2016-07-18 11:02:29'),
(59, 'yahan bhi ', 15, 16, 0, '2016-07-18 11:04:16'),
(60, ' new test msg ', 3, 16, 0, '2016-07-19 11:59:24'),
(61, '123 ', 3, 16, 0, '2016-07-19 12:00:10'),
(62, 'asd ', 3, 16, 0, '2016-07-20 13:30:05'),
(63, 'asd ', 3, 9, 0, '2016-07-20 13:30:15'),
(64, 'dynamics is fun ', 3, 16, 0, '2016-07-20 13:34:15'),
(65, 'hey dynamo ', 3, 17, 0, '2016-07-20 13:35:04'),
(66, 'hey ping pong! ', 3, 15, 1, '2016-07-20 15:24:12');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `notification` text,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(8) DEFAULT NULL,
  `request_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `notification`, `user_id`, `status`, `request_id`, `time`) VALUES
(14, 'Anurag has sent you a friend request ', 5, 'read', 12, '2016-06-28 04:40:29'),
(15, 'Anurag has sent you a friend request ', 3, 'read', 13, '2016-06-29 09:41:02'),
(16, 'Anurag has sent you a friend request ', 5, 'read', 14, '2016-06-28 04:40:29'),
(17, 'Anurag has sent you a friend request ', 16, 'read', 15, '2016-06-28 04:40:29'),
(18, 'chirag Balhra has accepted your friend request ', 16, 'read', 0, '2016-06-28 04:40:29'),
(19, 'Anurag Balhra has accepted your friend request ', 16, 'read', 0, '2016-06-28 04:40:29'),
(20, 'Anurag has sent you a friend request ', 16, 'read', 16, '2016-06-28 04:40:29'),
(21, 'Anurag Balhra has accepted your friend request ', 3, 'read', 0, '2016-06-28 04:40:29'),
(22, 'Chirag has sent you a friend request ', 5, 'read', 17, '2016-06-28 04:40:29'),
(23, 'Chirag has sent you a friend request ', 3, 'read', 18, '2016-06-28 04:40:29'),
(24, 'Chirag has sent you a friend request ', 15, 'read', 19, '2016-06-28 04:40:29'),
(25, 'Chirag has sent you a friend request ', 16, 'read', 20, '2016-06-28 04:40:29'),
(26, 'Anurag Balhra has accepted your friend request ', 9, 'unread', 0, '2016-06-28 04:40:29'),
(27, 'Anurag Balhra has accepted your friend request ', 9, 'unread', 0, '2016-06-28 04:40:29'),
(28, 'Anurag has sent you a friend request ', 9, 'unread', 21, '2016-06-28 04:40:29'),
(29, 'Anurag has sent you a friend request ', 15, 'read', 22, '2016-06-28 04:40:29'),
(30, 'poi poi has accepted your friend request ', 9, 'unread', 0, '2016-06-28 04:40:29'),
(31, 'poi poi has accepted your friend request ', 16, 'unread', 0, '2016-06-28 04:40:29'),
(32, 'chirag Balhra has accepted your friend request ', 9, 'unread', 0, '2016-06-28 04:40:29'),
(33, 'chirag has sent you a friend request ', 3, 'read', 23, '2016-06-28 04:40:29'),
(34, 'chirag has sent you a friend request ', 9, 'unread', 24, '2016-06-28 04:40:29'),
(35, 'chirag has sent you a friend request ', 15, 'unread', 25, '2016-06-28 04:40:29'),
(36, 'chirag has sent you a friend request ', 16, 'unread', 26, '2016-06-28 04:40:29'),
(37, 'Anurag Balhra has accepted your friend request ', 5, 'read', 0, '2016-06-28 04:40:29'),
(38, 'poi has sent you a friend request ', 3, 'read', 26, '2016-07-07 01:31:35'),
(39, 'poi has sent you a friend request ', 17, 'read', 27, '2016-07-07 01:34:58'),
(40, 'anurag Balhra has accepted your friend request ', 15, 'unread', 0, '2016-07-07 01:31:37'),
(41, 'anurag has sent you a friend request ', 17, 'read', 28, '2016-07-07 01:34:50'),
(42, 'sign up has accepted your friend request ', 3, 'unread', 0, '2016-07-07 01:34:51'),
(43, 'sign up has accepted your friend request ', 15, 'unread', 0, '2016-07-07 01:35:00'),
(44, ' has sent you a friend request ', 3, 'read', 29, '2016-07-24 18:41:00'),
(45, 'anurag Balhra has accepted your friend request ', 21, 'unread', 0, '2016-07-24 18:41:03');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `photoADDR` text,
  `post_id` int(11) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `IsShare` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `photoADDR`, `post_id`, `time`, `IsShare`) VALUES
(15, 'uploads/28025_411424468926341_2004730299_n.jpg', 41, '2016-06-28 14:10:15', 2),
(16, 'uploads/20160304_115832.jpg', 42, '2016-06-28 14:46:01', 2),
(21, 'uploads/20160304_160229.jpg', 62, '2016-06-28 16:08:46', 2),
(22, 'uploads/28025_411424468926341_2004730299_n.jpg', 63, '2016-06-28 16:10:51', 2),
(23, 'uploads/20160304_161222.jpg', 64, '2016-06-28 16:11:44', 2),
(24, 'uploads/146713526720160304_183944.jpg', 65, '2016-06-28 17:34:27', 2),
(25, 'uploads/1467138098IMG_20160514_150017.jpg', 66, '2016-06-28 18:21:38', 2),
(26, 'uploads/146720381774701_411424122259709_743233978_n.jpg', 68, '2016-06-29 12:36:57', 2),
(27, 'uploads/146721970520160304_161222.jpg', 69, '2016-06-29 17:01:45', 2),
(28, 'uploads/146721970520160304_161222.jpg', 41, '2016-07-18 09:43:01', 2),
(29, 'uploads/146721970520160304_161222.jpg', 62, '2016-07-18 09:43:01', 2);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `post` text,
  `user_id` int(11) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `shares` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `IsShare` int(11) NOT NULL,
  `comments` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post`, `user_id`, `time`, `shares`, `likes`, `IsShare`, `comments`) VALUES
(38, 'post1', 15, '2016-06-28 13:59:37', 0, 0, 0, 0),
(39, 'post1', 15, '2016-06-28 14:01:05', 0, 0, 0, 0),
(40, 'post1', 15, '2016-06-28 14:04:04', 0, 0, 0, 0),
(41, 'photo post1', 15, '2016-07-19 11:45:27', 4, 1, 0, 6),
(42, 'photo post 2', 15, '2016-07-08 06:54:20', 0, 2, 0, 0),
(43, 'again text field', 15, '2016-06-28 14:47:00', 0, 0, 0, 0),
(44, 'eithout pic', 15, '2016-06-28 14:49:26', 0, 0, 0, 0),
(45, '*srry without pic', 15, '2016-06-28 14:51:44', 0, 0, 0, 0),
(46, 'p1', 0, '2016-06-28 15:47:11', 0, 0, 0, 0),
(47, 'p1', 0, '2016-06-28 15:47:27', 0, 0, 0, 0),
(48, 'p1', 0, '2016-06-28 15:54:54', 0, 0, 0, 0),
(49, 'p1', 3, '2016-06-28 15:55:53', 0, 0, 0, 0),
(50, 'p2', 3, '2016-06-28 16:00:15', 0, 0, 0, 0),
(51, 'p3', 3, '2016-06-28 16:00:35', 0, 0, 0, 0),
(52, 'p4', 3, '2016-06-28 16:01:05', 0, 0, 0, 0),
(53, 'p4', 0, '2016-06-28 16:01:20', 0, 0, 0, 0),
(54, 'p4', 0, '2016-06-28 16:02:24', 0, 0, 0, 0),
(55, 'e3', 3, '2016-06-28 16:03:51', 0, 0, 0, 0),
(56, 'e3', 3, '2016-06-28 16:04:47', 0, 0, 0, 0),
(57, 'e3', 3, '2016-06-28 16:05:55', 0, 0, 0, 0),
(58, 'e3', 3, '2016-06-28 16:06:28', 0, 0, 0, 0),
(59, 'e3', 3, '2016-06-28 16:06:46', 0, 0, 0, 0),
(60, 'e3', 3, '2016-06-28 16:07:01', 0, 0, 0, 0),
(61, 'e3', 3, '2016-06-28 16:07:48', 0, 0, 0, 0),
(62, 'photo post#1', 3, '2016-07-18 09:15:23', 6, 78, 0, 7),
(63, 'random pics', 3, '2016-06-28 17:11:12', 0, 1, 0, 0),
(64, 'one more pic', 3, '2016-06-28 16:11:50', 0, 1, 0, 0),
(65, 'asdfg', 3, '2016-06-29 09:42:12', 1, 0, 0, 0),
(66, 'ffkghgjbjn', 3, '2016-06-28 18:21:38', 0, 0, 0, 0),
(67, 'new', 3, '2016-06-29 09:42:00', 2, 1, 0, 0),
(68, 'm;jkjk', 3, '2016-07-13 13:16:17', 0, 1, 0, 1),
(69, 'a', 3, '2016-07-02 06:51:30', 0, 1, 0, 0),
(70, '1', 3, '2016-07-08 06:53:31', 0, 1, 0, 0),
(71, '1', 15, '2016-07-02 06:53:33', 0, 0, 0, 0),
(72, '1', 15, '2016-07-02 07:06:52', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shares`
--

CREATE TABLE `shares` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `IsShare` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shares`
--

INSERT INTO `shares` (`id`, `user_id`, `post_id`, `time`, `IsShare`) VALUES
(5, 15, 37, '2016-06-28 14:08:42', 1),
(6, 3, 67, '2016-06-29 09:41:41', 1),
(7, 3, 67, '2016-06-29 09:42:00', 1),
(8, 3, 65, '2016-06-29 09:42:12', 1),
(9, 3, 62, '2016-07-08 09:59:00', 1),
(10, 3, 62, '2016-07-08 10:13:17', 1),
(11, 3, 62, '2016-07-08 10:13:18', 1),
(12, 3, 62, '2016-07-08 10:13:19', 1),
(13, 3, 62, '2016-07-08 10:13:24', 1),
(14, 3, 62, '2016-07-08 10:14:27', 1),
(15, 3, 41, '2016-07-18 09:47:26', 1),
(16, 3, 41, '2016-07-18 09:51:36', 1),
(17, 3, 41, '2016-07-18 09:51:36', 1),
(18, 3, 41, '2016-07-19 07:59:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `value` text,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`value`, `id`) VALUES
('NEW TYPE', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user1_id` (`sender_id`),
  ADD KEY `user2_id` (`receiver_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shares`
--
ALTER TABLE `shares`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `shares`
--
ALTER TABLE `shares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
