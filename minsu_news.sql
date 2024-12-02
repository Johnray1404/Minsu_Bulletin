-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 02, 2024 at 06:33 AM
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
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `category`, `image`, `caption`, `created_at`, `updated_at`, `video`) VALUES
(5, 'Congratulations!🎉', 'academic', 'uploads/news_images/b8817599-4ced-4638-999f-d609de412b52.jpg', 'Board licensure examination for proffesional teachers!', '2024-11-12 15:53:23', '2024-11-12 23:53:23', NULL),
(2, 'Minsu Achievements', 'academic', 'uploads/news_images/news.jpg', 'Minsu has proudly clinched 7th place in the latest overall college rankings, marking a significant achievement in academics, sports, and extracurricular activities. This accomplishment highlights the dedication and hard work of Minsu students and faculty, positioning the college among the top institutions in the country. With continuous efforts towards excellence, Minsu is set to reach even greater heights in the future.', '2024-11-10 14:56:07', '2024-11-10 22:56:07', NULL),
(9, 'Minsu Overall 9th runner up', 'sports', 'uploads/news_images/minsuSports.jpg', 'Mindoro State University achieved Overall 9th runner up in STRASUC OLYMPICS 2024', '2024-11-17 10:38:50', '2024-11-17 18:38:50', NULL),
(21, 'Testing', 'academic', NULL, 'lang ', '2024-12-01 11:28:44', '2024-12-01 19:28:44', 'uploads/news_videos/Realtime Colors and 5 more pages - Personal - Microsoft​ Edge 2023-12-13 22-35-28.mp4'),
(20, 'John Ray', 'academic', 'uploads/news_images/FB_IMG_1606801809400.jpg', 'test', '2024-12-01 11:07:17', '2024-12-01 19:07:17', 'uploads/news_videos/how to screen record on windows - Search and 5 more pages - Personal - Microsoft​ Edge 2023-12-13 22-34-29.mp4');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(7, 21, 'test', 'try', 'uploads/posts/gin.jpg', '2024-12-02 06:30:17');

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
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `created_at`, `profile_pic`, `verification_token`, `verified`, `verification_sent_at`) VALUES
(22, 'wako', 'wako@gmail.com', '$2y$10$mMTkNRfPUTetjc5XEKa46ur1IupfAvOOYUs/.oXXThdA772VIZxXu', '2024-12-01 11:23:46', 'uploads/profile_pic/674c4768b551b9.53465277.jpg', NULL, 0, '2024-12-01 11:23:46'),
(21, 'john ray', 'johnraycarpio1404@gmail.com', '$2y$10$TCq8Tzof2ugE95tApYprnu.w4YbCd/BZZXR5Tf86itQWN7NYvz60e', '2024-11-25 16:49:01', 'uploads/profile_pic/674c2c6b0a6fb2.77797517.jpg', NULL, 0, '2024-11-25 16:49:01');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
