-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2024 at 02:14 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `server`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `user_type` enum('attendee','host') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `email`, `password`, `phone_number`, `city`, `country`, `user_type`, `created_at`) VALUES
('Akash', 'akashgupta@gmail.com', '$2y$10$KJ3TScvqjTAKPhmGWfAzYOTQduvTCRQ3DKmQpgnUSGgjgJruWcdD6', '7715433654', 'Delhi', 'India', 'host', '2024-11-04 00:29:48'),
('Aman', 'aman@gmail.com', '$2y$10$S5YRnUoaQrkZ.OJqqpdEwuNW8QX6W25yVLdt5VNu1s6PNrOQYg2nS', '8874556321', 'Vasco', 'India', 'attendee', '2024-11-04 00:24:19'),
('Atreya', 'atreya@gmail.com', '$2y$10$dvLoudgNPd8EiWMs7wiRI.qa6BvFyH0lrmKIMx2JVBbJCGyuo9NPK', '9987665412', 'Panjim', 'India', 'attendee', '2024-11-04 00:20:40'),
('Chinmayi', 'chinmayi@gmail.com', '$2y$10$MtbxqhTrW1OLSE650CJI2eByA5rnzy./zQmd1BfITCCq4.X2Vq7Wm', '8296615786', 'Mapusa', 'India', 'attendee', '2024-11-04 00:25:16'),
('Naman', 'naman@gmail.com', '$2y$10$Ae8Msm5urZr6JwdnhpsQ7u9OWi9e60PeA5GDCxpWZ/xyjeaz6970a', '8874522365', 'Mumbai', 'India', 'host', '2024-11-04 00:26:35'),
('Shubham', 'shubham@gmail.com', '$2y$10$yUgSb6jkjCZLVyqjPgxohe1WwCRM6uoEVOpi1qEG9yJAa8hAB1/TK', '7745699854', 'Ujjain', 'India', 'host', '2024-11-04 00:28:27');

-- --------------------------------------------------------

--
-- Table structure for table `attendee`
--

CREATE TABLE `attendee` (
  `attendee_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `interest` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendee`
--

INSERT INTO `attendee` (`attendee_id`, `username`, `interest`) VALUES
(5, 'Atreya', '[\"Music\",\"Art\",\"Technology\"]'),
(6, 'Aman', '[\"Music\",\"Art\",\"Technology\"]'),
(7, 'Chinmayi', '[\"Technology\",\"Food\",\"Sports\"]');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_description` text NOT NULL,
  `event_date` datetime NOT NULL,
  `event_location` varchar(255) NOT NULL,
  `host_username` varchar(255) NOT NULL,
  `event_image` varchar(255) DEFAULT NULL,
  `event_fee` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_description`, `event_date`, `event_location`, `host_username`, `event_image`, `event_fee`) VALUES
(8, 'Play: Clue', ' A fast-paced, comedic murder mystery inspired by the classic board game. Set in a lavish mansion, the story follows a group of quirky characters as they uncover secrets, reveal hidden agendas, and ultimately solve a murder before time runs out. With twists, turns, and plenty of humor, \"CLUE\" keeps the audience guessing until the final curtain.', '2024-11-13 09:00:00', 'Kala Academy, Panaji', 'Naman', 'uploads/6.png', 0.00),
(9, 'Play: Into the Woods', 'A groundbreaking musical that intertwines the plots of several fairy tales, including \"Cinderella,\" \"Jack and the Beanstalk,\" \"Little Red Riding Hood,\" and others. This imaginative story explores the characters\' desires, fears, and the consequences of their wishes. As they journey into the woods, they discover that the path to their dreams is fraught with challenges and moral dilemmas, leading to poignant lessons about life and responsibility.', '2024-11-21 10:30:00', ' Sao Joao Festival Grounds, Bardez', 'Naman', 'uploads/5.png', 50.00),
(10, 'Play: Don Juan', ' A daring and provocative retelling of the legendary seducer Don Juan, this play delves into themes of love, betrayal, and moral ambiguity. As Don Juan navigates his way through a series of romantic entanglements, he challenges societal norms and ultimately confronts the consequences of his actions. A timeless exploration of passion and consequence, this rendition captivates with its wit and depth.', '2024-11-28 11:30:00', 'Goa International Film Festival Venue, Panaji', 'Naman', 'uploads/4.png', 500.00),
(11, 'Bhai Khush Raha Kar - Stand Up', 'Join Akash Gupta for an evening of laughter in \"Bhai Khush Raha Kar,\" where he takes you through hilarious observations about life, relationships, and the quirks of everyday situations. His relatable humor and charming storytelling will leave you in splits, making it a must-attend event for comedy lovers!', '2024-11-21 21:30:00', 'Panjim Theatre, Panaji', 'Akash', 'uploads/1.png', 400.00),
(12, 'Gold Coast - Stand Up', ' \"Gold Coast\" is a vibrant stand-up comedy show where Akash Gupta explores the highs and lows of life, love, and aspirations. Expect a blend of observational humor and personal anecdotes that resonate with audiences, making it an entertaining night out!\r\n', '2024-11-25 22:00:00', 'Hanuman Natyagraha, Mapusa', 'Akash', 'uploads/2.png', 1000.00),
(13, 'Couple Goals - Short Film', '\"Couple Goals\" is a witty short film by Akash Gupta that delves into the dynamics of modern relationships. Through humor and relatable scenarios, it portrays the joys and challenges couples face today. This light-hearted film is sure to strike a chord with anyone who has ever been in love!', '2024-12-11 11:30:00', ' Goa International Film Festival Venue, Panaji', 'Akash', 'uploads/3.png', 350.00),
(14, 'Unbound Bengaluru Tech', 'Unbound Bengaluru Tech is a premier tech event that brings together innovators, startups, and industry leaders to explore the latest trends in technology and entrepreneurship. The event features keynote speeches, panel discussions, and networking opportunities that foster collaboration and inspire new ideas. Whether you\'re a tech enthusiast, an entrepreneur, or a professional, this event offers valuable insights and connections in the tech ecosystem.', '2024-11-20 11:00:00', ' Bangalore International Exhibition Centre (BIEC), Bengaluru', 'Shubham', 'uploads/7.png', 2500.00),
(15, 'TechCrunch Disrupt', 'TechCrunch Disrupt is an annual technology conference that showcases startups and emerging technologies. Attendees can expect insightful discussions with industry leaders, startup competitions, and opportunities to network with investors and entrepreneurs. This event is a hub for innovation, making it a must-attend for anyone in the tech space.', '2024-11-27 09:30:00', 'International Centre Goa', 'Shubham', 'uploads/9.png', 1000.00),
(16, ' NASSCOM Product Conclave', 'The NASSCOM Product Conclave is a platform for tech entrepreneurs and product leaders to share insights and discuss the future of technology and innovation. With a focus on product development, this event features expert talks, workshops, and networking opportunities aimed at helping startups thrive in the competitive tech landscape.', '2024-11-18 10:30:00', 'Taj West End, Bengaluru', 'Shubham', 'uploads/8.png', 3500.00);

-- --------------------------------------------------------

--
-- Table structure for table `host`
--

CREATE TABLE `host` (
  `host_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `organization_name` varchar(100) DEFAULT NULL,
  `role_in_organization` varchar(50) DEFAULT NULL,
  `event_specialization` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `host`
--

INSERT INTO `host` (`host_id`, `username`, `organization_name`, `role_in_organization`, `event_specialization`) VALUES
(2, 'Naman', 'Nexus Plays', 'Manager', 'Play, Concert, Comedy Events'),
(3, 'Shubham', 'Nixon IT', 'Software Developer', 'Technology, AI, Future Gen AI'),
(4, 'Akash', 'Habitat', 'Stand-up Comedian', 'Comedy, Roles, Fun Events');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `event_id`, `username`, `registration_date`) VALUES
(1, 13, 'Atreya', '2024-11-04 00:55:27'),
(2, 15, 'Atreya', '2024-11-04 00:55:31'),
(3, 14, 'Atreya', '2024-11-04 00:55:36'),
(4, 10, 'Chinmayi', '2024-11-04 00:55:53'),
(5, 15, 'Chinmayi', '2024-11-04 00:55:56'),
(6, 11, 'Chinmayi', '2024-11-04 00:55:59'),
(7, 12, 'Chinmayi', '2024-11-04 00:56:02'),
(8, 14, 'Chinmayi', '2024-11-04 00:56:07'),
(9, 9, 'Aman', '2024-11-04 00:56:36'),
(10, 11, 'Aman', '2024-11-04 00:56:39'),
(11, 12, 'Aman', '2024-11-04 00:56:41'),
(12, 10, 'Aman', '2024-11-04 00:56:44'),
(13, 13, 'Aman', '2024-11-04 00:56:47'),
(14, 15, 'Aman', '2024-11-04 00:56:49');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--
-- Error reading structure for table server.user_profiles: #1932 - Table 'server.user_profiles' doesn't exist in engine
-- Error reading data for table server.user_profiles: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `server`.`user_profiles`' at line 1

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `attendee`
--
ALTER TABLE `attendee`
  ADD PRIMARY KEY (`attendee_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `host_username` (`host_username`);

--
-- Indexes for table `host`
--
ALTER TABLE `host`
  ADD PRIMARY KEY (`host_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendee`
--
ALTER TABLE `attendee`
  MODIFY `attendee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `host`
--
ALTER TABLE `host`
  MODIFY `host_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendee`
--
ALTER TABLE `attendee`
  ADD CONSTRAINT `attendee_ibfk_1` FOREIGN KEY (`username`) REFERENCES `admin` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`host_username`) REFERENCES `admin` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `host`
--
ALTER TABLE `host`
  ADD CONSTRAINT `host_ibfk_1` FOREIGN KEY (`username`) REFERENCES `admin` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
