-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 12, 2024 at 03:46 PM
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
  `content` enum('academic','sports','events') COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `caption` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `image`, `caption`, `created_at`, `updated_at`) VALUES
(2, 'Minsu Achievements', 'academic', 'uploads/news_images/news.jpg', 'Minsu has proudly clinched 7th place in the latest overall college rankings, marking a significant achievement in academics, sports, and extracurricular activities. This accomplishment highlights the dedication and hard work of Minsu students and faculty, positioning the college among the top institutions in the country. With continuous efforts towards excellence, Minsu is set to reach even greater heights in the future.', '2024-11-10 14:56:07', '2024-11-10 22:56:07');

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `created_at`, `token`) VALUES
(6, 'janine', 'janine@gmail.com', '$2y$10$83PLRqh7qR6ncTU2eIMu/uOoPGTMwwThY0NY1irRolUoh9VHnkYZq', '2024-11-06 05:36:36', NULL),
(5, 'ulip', 'ulip@gmail.com', '$2y$10$IL.w2Txm7ExmhyJCfBxEsuFfHTkH.8bTAH1/t0ydZPPZGplCsIGdu', '2024-11-06 05:34:07', NULL),
(4, 'johnray', 'johnraycarpio1404@gmail.com', '$2y$10$IytucWcxntFe.y4vTfy42efZ0jRu60n1gmnbjOvM/BGMlECHrlrhW', '2024-11-06 04:21:13', NULL),
(7, 'rjay', 'rjay@gmail.com', '$2y$10$1uTlzFF7yw1HKYyiPozR7uovp.k8AywzowwTTxQ8nmg0BZoFpcmhm', '2024-11-06 05:37:52', NULL),
(8, 'alex', 'alex@gmail.com', '$2y$10$I3sEISMhDjdb6u.015f6Tea2mGirr9hwzYilDmGQH35CJnvglzd4u', '2024-11-06 05:39:06', NULL),
(9, 'carpio', 'carpio14@gmail.com', '$2y$10$o3r5EabYdMYlGlo.33IfreJaidWftqjb4LR3CJIsUQNr8Lovt/g3K', '2024-11-10 07:26:03', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
