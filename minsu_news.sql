-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 24, 2024 at 06:33 AM
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `category`, `image`, `caption`, `created_at`, `updated_at`) VALUES
(5, 'Congratulations!🎉', 'academic', 'uploads/news_images/b8817599-4ced-4638-999f-d609de412b52.jpg', 'Board licensure examination for proffesional teachers!', '2024-11-12 15:53:23', '2024-11-12 23:53:23'),
(2, 'Minsu Achievements', 'academic', 'uploads/news_images/news.jpg', 'Minsu has proudly clinched 7th place in the latest overall college rankings, marking a significant achievement in academics, sports, and extracurricular activities. This accomplishment highlights the dedication and hard work of Minsu students and faculty, positioning the college among the top institutions in the country. With continuous efforts towards excellence, Minsu is set to reach even greater heights in the future.', '2024-11-10 14:56:07', '2024-11-10 22:56:07'),
(9, 'Minsu Overall 9th runner up', 'sports', 'uploads/news_images/minsuSports.jpg', 'Mindoro State University achieved Overall 9th runner up in STRASUC OLYMPICS 2024', '2024-11-17 10:38:50', '2024-11-17 18:38:50');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `post_title`, `post_caption`, `post_mediafile`, `created_at`) VALUES
(1, 4, 'dfhdfgdsg', 'sdd', 'uploads/posts/tmobile.jpg', '2024-11-18 13:24:04'),
(2, 4, 'hlkg', 'gkg', 'uploads/posts/8cc4698a-559d-414e-a891-647b29f806cb.jfif', '2024-11-18 13:26:02'),
(3, 4, 'fgfsdfg', 'ugdkfjgksdfgsd', 'uploads/posts/e5ab874a-ed1f-4a5d-b99b-567b7e829d6b.jfif', '2024-11-18 13:59:22'),
(4, 9, 'hsjkfgsjhguu', 'sfsjkfjkfjjkf', 'uploads/posts/445364759_944581374129799_2659982601769557791_n.jpg', '2024-11-18 15:09:35'),
(5, 4, 'lol', 'ulol', 'uploads/posts/FB_IMG_1606801809400.jpg', '2024-11-24 06:30:29');

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
  `token` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `created_at`, `token`, `profile_pic`) VALUES
(6, 'janine', 'janine@gmail.com', '$2y$10$83PLRqh7qR6ncTU2eIMu/uOoPGTMwwThY0NY1irRolUoh9VHnkYZq', '2024-11-06 05:36:36', NULL, NULL),
(5, 'ulip', 'ulip@gmail.com', '$2y$10$IL.w2Txm7ExmhyJCfBxEsuFfHTkH.8bTAH1/t0ydZPPZGplCsIGdu', '2024-11-06 05:34:07', NULL, NULL),
(4, 'johnray', 'johnraycarpio1404@gmail.com', '$2y$10$IytucWcxntFe.y4vTfy42efZ0jRu60n1gmnbjOvM/BGMlECHrlrhW', '2024-11-06 04:21:13', NULL, 'uploads/profile_pic/6742c7ea5fea11.04300299.jpg'),
(7, 'rjay', 'rjay@gmail.com', '$2y$10$1uTlzFF7yw1HKYyiPozR7uovp.k8AywzowwTTxQ8nmg0BZoFpcmhm', '2024-11-06 05:37:52', NULL, NULL),
(8, 'alex', 'alex@gmail.com', '$2y$10$I3sEISMhDjdb6u.015f6Tea2mGirr9hwzYilDmGQH35CJnvglzd4u', '2024-11-06 05:39:06', NULL, NULL),
(9, 'carpio', 'carpio14@gmail.com', '$2y$10$o3r5EabYdMYlGlo.33IfreJaidWftqjb4LR3CJIsUQNr8Lovt/g3K', '2024-11-10 07:26:03', NULL, 'uploads/profile_pic/FORMAL PIC.jpg'),
(10, 'kupal', 'kupal@gmail.com', '$2y$10$Eo3uOy2wKFTqxYS4God7TOuFdC4MU0DCqJBC4tcVaGxvA/qA8muku', '2024-11-24 03:01:14', NULL, 'uploads/profile_pic/67429a36df08e8.55732961.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
