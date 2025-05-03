-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2025 at 09:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_posts`
--

CREATE TABLE `admin_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_review` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_posts`
--

INSERT INTO `admin_posts` (`id`, `title`, `image`, `content`, `created_at`, `is_review`) VALUES
(1, 'Ronaldo, Al Nassr lose semifinal to Kawasaki in Asian Champions League', 'AFP__20250430__444M4T3__v1__HighRes__FblAsiaC1NassrKawasaki-.jpg', 'Kawasaki Frontale’s Tatsuya Ito has compared lining up beside Cristiano Ronaldo before their Asian Champions League Elite semifinal to being in “a video game” as the J-League outfit handed the Saudi club a 3-2 defeat to progress to the final.\r\n\r\nIto shrugged off any sense of being starstruck to open the scoring in spectacular fashion in the 10th minute at Jeddah’s King Abdullah Sports City Stadium to send Kawasaki on their way to a place in Saturday’s final against Al-Ahli.', '2025-05-01 17:05:48', 0),
(2, 'Ronaldo, Al Nassr lose semifinal to Kawasaki in Asian Champions League', 'AFP__20250430__444M4T3__v1__HighRes__FblAsiaC1NassrKawasaki-.jpg', 'Kawasaki Frontale’s Tatsuya Ito has compared lining up beside Cristiano Ronaldo before their Asian Champions League Elite semifinal to being in “a video game” as the J-League outfit handed the Saudi club a 3-2 defeat to progress to the final.\r\n\r\nIto shrugged off any sense of being starstruck to open the scoring in spectacular fashion in the 10th minute at Jeddah’s King Abdullah Sports City Stadium to send Kawasaki on their way to a place in Saturday’s final against Al-Ahli.', '2025-05-01 17:06:37', 0),
(3, 'J-League side Kawasaki Frontale beat the star-studded Saudi club 3-2 in Jeddah to enter the Champions League final.', 'AFP__20250430__444T7WG__v1__HighRes__FblAsiaC1NassrKawasaki-.jpg', '“Al Nassr have Cristiano Ronaldo, Sadio Mane and such big names and in that game at some moments there were difficulties for us to play against them,” said Ito.\r\n\r\n“They were attacking well but I was happy to be on the pitch with them tonight.\r\n\r\n“There were some big names playing here. Before we went on the pitch they were next to me. It felt like it was a video game.”\r\nKawasaki were unfancied before the game having needed extra time to defeat Qatar’s Al Sadd on Sunday to progress to the semifinals, but Ito’s perfectly struck first-time volley from the edge of the penalty area gave his side the ideal start.', '2025-05-01 17:07:13', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `email`, `password`, `profile_image`) VALUES
(1, 'Topadmin', 'admin@mail.com', '$2y$10$GtIEa/3tnaHz9VtDyVXdbONF6E.DHpVKOyTIi5pppkvZaBAgmjjmO', 'img.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `parent_id`, `name`, `email`, `comment`, `created_at`) VALUES
(1, 8, NULL, 'Akpaka Rapheal o', 'akpakar8@gmail.com', 'yes', '2025-05-01 00:46:00'),
(2, 8, NULL, 'Akpaka Rapheal o', 'akpakar8@gmail.com', 'i support that', '2025-05-01 00:46:34'),
(3, 8, NULL, 'davisdd', 'davies9288@gmail.com', 'wow', '2025-05-01 00:47:56'),
(4, 7, NULL, 'Akpaka Rapheal o', 'akpakar8@gmail.com', 'very good', '2025-05-01 21:55:51');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `top_content` text DEFAULT NULL,
  `content` text NOT NULL,
  `top_image` varchar(255) DEFAULT NULL,
  `body_image` varchar(255) DEFAULT NULL,
  `category` enum('Latest News','Headline News','Sport News','Music/ Entertainment','Social News','Politics','Business') NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('pending','published','declined') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `top_content`, `content`, `top_image`, `body_image`, `category`, `user_id`, `status`, `created_at`) VALUES
(1, 'Stunning Visuals with Dynamic Island', 'Stunning Visuals with Dynamic Island', 'Battery life is always a key consideration when upgrading a smartphone, and the iPhone 15 Pro Max doesn’t disappoint. Despite its power-packed features, Apple has managed to improve battery efficiency, allowing for up to 29 hours of video playback, making it one of the longest-lasting iPhones on the market. With moderate use, most users can expect to get through an entire day without needing a charge, and when it’s time to top up, the fast charging feature will get you back to full power quickly.\r\n\r\nApple has finally switched to USB-C on the iPhone 15 Pro Max, a change that has been long overdue. The new port offers faster charging and data transfer speeds compared to the Lightning port. It also means that users with USB-C cables can now use the same cables for their iPhone, MacBook, and other devices, simplifying the charging and syncing process across the Apple ecosystem.\r\n\r\nApple continues to offer a wide range of storage options with the iPhone 15 Pro Max. Starting at 256GB, the device goes all the way up to 1TB, making it an excellent choice for users who need a lot of space for photos, videos, and apps. The increased storage options allow for more flexibility, especially for content creators or those who use their phone as their primary device for work.', '1746043495_content_img.jpg', '1746043495_pexels-osamanaser-4075416.jpg', 'Latest News', 5, 'published', '2025-04-30 20:04:55'),
(5, 'Spurs captain Son out of first leg of Europa League semifinal', 'Spurs captain Son out of first leg of Europa League semifinal', 'Spurs captain Son out of first leg of Europa League semifinal', '1746053833_son-heung-min-.jpg', '1746053833_son-heung-min-.jpg', 'Sport News', 5, 'published', '2025-04-30 22:57:13'),
(6, 'Bilbao will give \'soul\' to beat Man United - Nico Williams', 'Bilbao will give \'soul\' to beat Man United - Nico Williams', 'Athletic Bilbao winger Nico Williams said his team will give their \"soul\" to beat Manchester United on Thursday and reach the Europa League final.', '1746053903_nico-williams-.jpg', '1746053903_nico-williams-.jpg', 'Sport News', 5, 'published', '2025-04-30 22:58:23'),
(7, 'FBI, CIA, DEA, Others Reveal Date To Release Tinubu US Investigation Reports', 'FBI, CIA, DEA, Others Reveal Date To Release Tinubu US Investigation Reports', 'Several United States government agencies are expected to release investigation reports related to an alleged drug-related case involving President Bola Ahmed Tinubu on Friday, May 2, 2025, in compliance with a U.S. District Court order.\r\nThe agencies involved include the Federal Bureau of Investigation (FBI), the Internal Revenue Service (IRS), the Drug Enforcement Administration (DEA), the Department of State, U.S. Attorneys, and the Central Intelligence Agency (CIA).', '1746053964_Bola-Tinubu-2.jpg', '1746053964_Bola-Tinubu-2.jpg', 'Latest News', 5, 'published', '2025-04-30 22:59:24'),
(8, 'Several killed in sectarian clashes near Damascus, Syria', 'Several killed in sectarian clashes near Damascus, Syria', 'Syrian security forces have been sent to restore calm after fighting broke out near Damascus. More than 20 people were killed in gunfights in the predominantly Druze town of Jaramana. The fighting started after reports that an audio recording had been circulated that insulted the Prophet Muhammad.', '1746054109_image-.jpg', '1746054109_image-.jpg', 'Headline News', 5, 'published', '2025-04-30 23:01:49'),
(9, 'An application that uses artificial ', 'An application that uses artificial intelligence to make money has been launched to the public', 'AI technologies like ChatGPT and Midjourney are making waves across the world. What most people don\'t know, however, is that AI technology isn\'t new; in fact, it has been around for years.\r\n\r\nIt wasn\'t until recently that programmers discovered that if the average person could use AI technology to make money on their behalf, eliminating human error, the profit potential is huge. And that\'s exactly what \"NairaTrader AI\" does while you sleep.', '1746056373_robotnoqueen.jpeg', '1746056373_robotnoqueen.jpeg', 'Social News', 5, 'published', '2025-04-30 23:39:33'),
(10, 'FBI, CIA, DEA, Others Reveal Date To Release Tinubu US Investigation Reports', 'FBI, CIA, DEA, Others Reveal Date To Release Tinubu US Investigation Reports', 'Several United States government agencies are expected to release investigation reports related to an alleged drug-related case involving President Bola Ahmed Tinubu on Friday, May 2, 2025, in compliance with a U.S. District Court order.\r\nThe agencies involved include the Federal Bureau of Investigation (FBI), the Internal Revenue Service (IRS), the Drug Enforcement Administration (DEA), the Department of State, U.S. Attorneys, and the Central Intelligence Agency (CIA).', '1746056928_Bola-Tinubu-2.jpg', '1746056928_Bola-Tinubu-2.jpg', 'Politics', 5, 'published', '2025-04-30 23:48:48');

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` enum('open','answered','closed') DEFAULT 'open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `support_tickets`
--

INSERT INTO `support_tickets` (`id`, `user_id`, `subject`, `message`, `status`, `created_at`) VALUES
(1, 5, 'investment', 'hello', 'open', '2025-05-01 20:22:36'),
(2, 5, 'investment', 'hello', 'answered', '2025-05-01 20:22:50');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_replies`
--

CREATE TABLE `ticket_replies` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `sender_type` enum('user','admin') NOT NULL,
  `sender_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_replies`
--

INSERT INTO `ticket_replies` (`id`, `ticket_id`, `sender_type`, `sender_id`, `message`, `created_at`) VALUES
(1, 2, 'admin', 1, 'no prblem', '2025-05-01 20:53:01'),
(2, 2, 'admin', 1, 'we will help out', '2025-05-01 20:53:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` enum('active','suspended') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `number`, `address`, `profile_image`, `email`, `username`, `password`, `status`, `created_at`) VALUES
(5, 'Akpaka Rapheal O', '08139104972', 'Umudike', 'b9a84ce1-5114-4bfe-820f-43f5374b5b66.jpg', 'akpakar8@gmail.com', 'Codewithraph', '$2y$10$wOrT9ao6czLQ/j9KLmXdUe67G1yU9/NrGmRqSvQjvpW.CMQvgYmF2', 'active', '2025-04-29 18:48:19'),
(6, 'Davice Pakins', '2345678234', 'Bende Rd Umuahia Abia State', 'IMG_2899.PNG', 'davies9288@gmail.com', 'Davis', '$2y$10$6Y5OewuXciQqvGSDKKt5GOIBEoD4Oc3Buh6MkjslRemLSVmMfjpLq', 'active', '2025-04-29 23:14:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_posts`
--
ALTER TABLE `admin_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_replies`
--
ALTER TABLE `ticket_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_posts`
--
ALTER TABLE `admin_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ticket_replies`
--
ALTER TABLE `ticket_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
