-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 10, 2024 at 04:28 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minsu_news`
--

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `category` enum('academic','sports','events') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `caption` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `video` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `category`, `image`, `caption`, `created_at`, `updated_at`, `video`) VALUES
(5, 'Congratulations!🎉', 'academic', 'uploads/news_images/b8817599-4ced-4638-999f-d609de412b52.jpg', 'Board licensure examination for proffesional teachers!', '2024-11-12 15:53:23', '2024-11-12 23:53:23', NULL),
(2, 'Minsu Achievements', 'academic', 'uploads/news_images/news.jpg', 'Minsu has proudly clinched 7th place in the latest overall college rankings, marking a significant achievement in academics, sports, and extracurricular activities. This accomplishment highlights the dedication and hard work of Minsu students and faculty, positioning the college among the top institutions in the country. With continuous efforts towards excellence, Minsu is set to reach even greater heights in the future.', '2024-11-10 14:56:07', '2024-11-10 22:56:07', NULL),
(9, 'Minsu Overall 9th runner up', 'sports', 'uploads/news_images/minsuSports.jpg', 'Mindoro State University achieved Overall 9th runner up in STRASUC OLYMPICS 2024', '2024-11-17 10:38:50', '2024-11-17 18:38:50', NULL),
(22, 'gising', 'sports', 'uploads/news_images/gin.jpg', 'gising', '2024-12-08 17:37:47', '2024-12-09 01:37:47', NULL),
(21, 'Testing', 'academic', NULL, 'lang ', '2024-12-01 11:28:44', '2024-12-01 19:28:44', 'uploads/news_videos/Realtime Colors and 5 more pages - Personal - Microsoft​ Edge 2023-12-13 22-35-28.mp4'),
(20, 'John Ray', 'academic', 'uploads/news_images/FB_IMG_1606801809400.jpg', 'test', '2024-12-01 11:07:17', '2024-12-01 19:07:17', 'uploads/news_videos/how to screen record on windows - Search and 5 more pages - Personal - Microsoft​ Edge 2023-12-13 22-34-29.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `news_comment`
--

DROP TABLE IF EXISTS `news_comment`;
CREATE TABLE IF NOT EXISTS `news_comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `news_id` int NOT NULL,
  `user_id` int NOT NULL,
  `comment` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `news_id` (`news_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_comment`
--

INSERT INTO `news_comment` (`id`, `news_id`, `user_id`, `comment`, `created_at`) VALUES
(1, 22, 21, 'ey', '2024-12-10 06:19:39'),
(2, 22, 21, 'shot puno', '2024-12-10 06:25:47'),
(3, 22, 22, 'higu', '2024-12-10 06:31:31'),
(4, 22, 21, 'sarap ng gin', '2024-12-10 06:46:41'),
(5, 21, 21, 'thank you☺', '2024-12-10 07:06:00'),
(6, 9, 21, 'congrats', '2024-12-10 07:08:54'),
(7, 22, 23, 'sfsfs', '2024-12-10 08:26:41');

-- --------------------------------------------------------

--
-- Table structure for table `news_likes`
--

DROP TABLE IF EXISTS `news_likes`;
CREATE TABLE IF NOT EXISTS `news_likes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `news_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `news_id` (`news_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_likes`
--

INSERT INTO `news_likes` (`id`, `news_id`, `user_id`, `created_at`) VALUES
(27, 21, 21, '2024-12-09 06:55:29'),
(2, 21, 22, '2024-12-06 08:28:05'),
(3, 20, 21, '2024-12-06 08:31:44'),
(4, 20, 22, '2024-12-06 08:31:59'),
(6, 9, 22, '2024-12-06 08:32:04'),
(13, 9, 21, '2024-12-06 23:17:50'),
(25, 5, 21, '2024-12-09 06:54:03'),
(15, 2, 21, '2024-12-06 23:17:56'),
(18, 21, 23, '2024-12-08 06:52:48'),
(32, 22, 21, '2024-12-10 07:08:09'),
(28, 22, 23, '2024-12-09 09:16:45'),
(29, 20, 23, '2024-12-09 09:16:49'),
(31, 22, 22, '2024-12-10 06:31:23');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `post_title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `post_caption` text COLLATE utf8mb4_general_ci,
  `post_mediafile` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `post_title`, `post_caption`, `post_mediafile`, `created_at`) VALUES
(1, 4, 'dfhdfgdsg', 'sdd', 'uploads/posts/tmobile.jpg', '2024-11-18 13:24:04'),
(2, 4, 'hlkg', 'gkg', 'uploads/posts/8cc4698a-559d-414e-a891-647b29f806cb.jfif', '2024-11-18 13:26:02'),
(3, 4, 'fgfsdfg', 'ugdkfjgksdfgsd', 'uploads/posts/e5ab874a-ed1f-4a5d-b99b-567b7e829d6b.jfif', '2024-11-18 13:59:22'),
(4, 9, 'hsjkfgsjhguu', 'sfsjkfjkfjjkf', 'uploads/posts/445364759_944581374129799_2659982601769557791_n.jpg', '2024-11-18 15:09:35'),
(5, 4, 'lol', 'ulol', 'uploads/posts/FB_IMG_1606801809400.jpg', '2024-11-24 06:30:29'),
(6, 21, 'asaasa', 'jsgjah', 'uploads/posts/johnray.jpg', '2024-11-27 05:48:19'),
(7, 21, 'test', 'try', 'uploads/posts/gin.jpg', '2024-12-02 06:30:17'),
(8, 22, 'owshie', 'minecraft', 'uploads/posts/Untitled_design__1_-removebg-preview (4).png', '2024-12-07 07:12:47'),
(9, 21, 'try lang', 'po', 'uploads/posts/redhorse.jpg', '2024-12-07 07:17:36'),
(10, 23, 'test', 'peborit', 'uploads/posts/alfonso.jpg', '2024-12-08 14:51:39'),
(11, 21, 'shot ', 'puno', 'uploads/posts/empi.jpg', '2024-12-10 14:40:03');

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

DROP TABLE IF EXISTS `post_likes`;
CREATE TABLE IF NOT EXISTS `post_likes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`id`, `post_id`, `user_id`, `created_at`) VALUES
(26, 7, 21, '2024-12-10 05:07:03'),
(3, 6, 21, '2024-12-06 22:29:30'),
(7, 7, 22, '2024-12-06 22:35:53'),
(8, 6, 22, '2024-12-06 22:36:00'),
(15, 8, 22, '2024-12-06 23:13:16'),
(16, 8, 21, '2024-12-06 23:13:27'),
(24, 9, 21, '2024-12-10 04:42:53'),
(18, 9, 23, '2024-12-08 06:50:55'),
(19, 8, 23, '2024-12-08 06:51:07'),
(21, 10, 23, '2024-12-08 06:51:58'),
(22, 6, 23, '2024-12-08 06:52:21'),
(23, 10, 21, '2024-12-09 06:44:15'),
(27, 11, 21, '2024-12-10 06:40:07');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `profile_pic` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `verification_token` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `verified` tinyint(1) DEFAULT '0',
  `verification_sent_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `created_at`, `profile_pic`, `verification_token`, `verified`, `verification_sent_at`) VALUES
(23, 'john', 'john@gmail.com', '$2y$10$j.PI6xG2Wc0Tx98mpifQNeYMP/5pRobX4TtL/20zIrNmZ8gk/2fju', '2024-12-08 14:50:22', 'uploads/profile_pic/6755b2483535b4.38253910.jpg', NULL, 0, '2024-12-08 14:50:22'),
(22, 'wako', 'wako@gmail.com', '$2y$10$mMTkNRfPUTetjc5XEKa46ur1IupfAvOOYUs/.oXXThdA772VIZxXu', '2024-12-01 11:23:46', 'uploads/profile_pic/674c4768b551b9.53465277.jpg', NULL, 0, '2024-12-01 11:23:46'),
(21, 'john ray', 'johnraycarpio1404@gmail.com', '$2y$10$TCq8Tzof2ugE95tApYprnu.w4YbCd/BZZXR5Tf86itQWN7NYvz60e', '2024-11-25 16:49:01', 'uploads/profile_pic/6753f636e98355.78478176.jpg', NULL, 0, '2024-11-25 16:49:01');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
