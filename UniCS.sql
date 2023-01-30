-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 30, 2023 at 08:33 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `UniCS`
--

-- --------------------------------------------------------

--
-- Table structure for table `approval`
--

CREATE TABLE `approval` (
  `id` int(11) NOT NULL,
  `period` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `roomNo` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `subjectCode` int(11) NOT NULL,
  `reason` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `notiText` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

CREATE TABLE `priority` (
  `reason` varchar(30) NOT NULL,
  `priority` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `priority`
--

INSERT INTO `priority` (`reason`, `priority`) VALUES
('club', 2),
('lecture', 3),
('other', 1),
('seminar', 4);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `roomNo` int(11) NOT NULL,
  `period` int(11) NOT NULL,
  `day` varchar(10) NOT NULL,
  `section` varchar(1) DEFAULT NULL,
  `subjectCode` int(11) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `roomNo`, `period`, `day`, `section`, `subjectCode`, `reason`, `userId`) VALUES
(1, 332, 1, 'monday', NULL, NULL, 'lecture', 6),
(2, 332, 1, 'monday', NULL, NULL, 'seminer', 6),
(3, 236, 3, 'tuesday', NULL, NULL, 'seminer', 4),
(4, 236, 3, 'tuesday', NULL, NULL, 'lecture', 4),
(5, 236, 3, 'tuesday', NULL, NULL, 'lecture', 4),
(6, 236, 3, 'tuesday', NULL, NULL, 'lecture', 4),
(7, 236, 3, 'tuesday', NULL, NULL, 'lecture', 4),
(8, 236, 1, 'friday', NULL, NULL, 'club activity', 4),
(9, 236, 1, 'friday', NULL, NULL, 'club activity', 4),
(10, 236, 1, 'friday', NULL, NULL, 'club activity', 4),
(11, 236, 1, 'friday', NULL, NULL, 'club activity', 4),
(12, 236, 1, 'friday', NULL, NULL, 'club activity', 4),
(13, 236, 1, 'friday', NULL, NULL, 'club activity', 4),
(14, 236, 1, 'friday', NULL, NULL, 'club activity', 4),
(15, 236, 1, 'friday', NULL, NULL, 'club activity', 4),
(16, 236, 1, 'friday', NULL, NULL, 'club activity', 4),
(17, 236, 1, 'friday', NULL, NULL, 'club activity', 4),
(18, 236, 1, 'friday', NULL, NULL, 'club activity', 4),
(19, 236, 1, 'friday', NULL, NULL, 'club activity', 4),
(20, 236, 1, 'friday', NULL, NULL, 'club activity', 4),
(21, 236, 1, 'friday', NULL, NULL, 'club activity', 4),
(22, 236, 1, 'friday', NULL, NULL, 'club activity', 4),
(23, 236, 1, 'friday', NULL, NULL, 'club activity', 4),
(24, 236, 1, 'friday', NULL, NULL, 'club activity', 4),
(25, 236, 1, 'friday', NULL, NULL, 'club activity', 4),
(26, 236, 1, 'friday', NULL, NULL, 'club activity', 4),
(27, 236, 1, 'friday', NULL, NULL, 'club activity', 4),
(28, 236, 1, 'friday', NULL, NULL, 'club activity', 4),
(29, 236, 1, 'friday', NULL, NULL, 'club activity', 4),
(30, 236, 1, 'friday', NULL, NULL, 'club activity', 4),
(31, 236, 1, 'sunday', NULL, NULL, 'club activity', 4),
(32, 236, 1, 'sunday', NULL, NULL, 'club activity', 4),
(33, 236, 1, 'sunday', NULL, NULL, 'club activity', 4),
(34, 236, 1, 'sunday', NULL, NULL, 'club activity', 4),
(35, 236, 1, 'sunday', NULL, NULL, 'club activity', 4),
(36, 236, 1, 'sunday', NULL, NULL, 'club activity', 4),
(37, 236, 1, 'sunday', NULL, NULL, 'club activity', 4),
(38, 236, 1, 'sunday', NULL, NULL, 'club activity', 4),
(39, 236, 1, 'sunday', NULL, NULL, 'club activity', 4),
(40, 236, 1, 'sunday', NULL, NULL, 'club activity', 4),
(41, 236, 1, 'sunday', NULL, NULL, 'club activity', 4),
(42, 236, 1, 'sunday', NULL, NULL, 'club activity', 4),
(43, 236, 1, 'sunday', NULL, NULL, 'club activity', 4),
(44, 236, 1, 'sunday', NULL, NULL, 'club activity', 4),
(45, 236, 1, 'sunday', NULL, NULL, 'club activity', 4),
(46, 236, 3, 'wednesday', NULL, NULL, 'club activity', 4),
(47, 245, 2, 'friday', NULL, NULL, 'club activity', 4);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomNo` int(11) NOT NULL,
  `building` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `period` int(11) NOT NULL,
  `day` varchar(10) NOT NULL,
  `roomNo` int(11) NOT NULL,
  `section` varchar(1) NOT NULL,
  `subjectCode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`period`, `day`, `roomNo`, `section`, `subjectCode`) VALUES
(1, 'thursday', 214, 'c', 11701),
(1, 'thursday', 236, 'a', 31308),
(1, 'thursday', 322, 'b', 11601),
(1, 'tuesday', 214, 'c', 11201),
(1, 'tuesday', 236, 'a', 31404),
(1, 'tuesday', 324, 'b', 11501),
(1, 'wednesday', 236, 'a', 31405),
(1, 'wednesday', 323, 'c', 11401),
(1, 'wednesday', 332, 'b', 11201),
(2, 'Firday', 323, 'c', 11101),
(2, 'friday', 326, 'b', 11401),
(2, 'friday', 332, 'a', 31105),
(2, 'monday', 323, 'c', 11101),
(2, 'monday', 324, 'b', 11501),
(2, 'monday', 332, 'a', 31203),
(2, 'thursday', 214, 'c', 11501),
(2, 'thursday', 322, 'b', 11701),
(2, 'thursday', 332, 'a', 31405),
(2, 'tuesday', 236, 'a', 31308),
(2, 'tuesday', 322, 'b', 11101),
(2, 'tuesday', 323, 'c', 11401),
(2, 'wednesday', 214, 'c', 11601),
(2, 'wednesday', 236, 'a', 31306),
(2, 'wednesday', 322, 'b', 11101),
(3, 'friday', 215, 'c', 11701),
(3, 'friday', 332, 'a', 31404),
(3, 'monday', 234, 'c', 11401),
(3, 'monday', 236, 'a', 31306),
(3, 'monday', 324, 'b', 11201),
(3, 'thursday', 323, 'b', 11601),
(3, 'thursday', 326, 'c', 11201),
(3, 'thursday', 332, 'a', 31404),
(3, 'tuesday', 322, 'b', 11201),
(3, 'tuesday', 323, 'c', 11101),
(3, 'tuesday', 332, 'a', 31306),
(3, 'wednesday', 214, 'c', 11201),
(3, 'wednesday', 322, 'b', 11701),
(3, 'wednesday', 332, 'a', 31105),
(4, 'friday', 244, 'b', 11501),
(4, 'friday', 245, 'c', 11701),
(4, 'friday', 332, 'a', 31306),
(4, 'monday', 234, 'c', 11401),
(4, 'monday', 236, 'a', 31308),
(4, 'monday', 322, 'b', 11101),
(4, 'thursday', 214, 'c', 11601),
(4, 'thursday', 236, 'a', 31105),
(4, 'thursday', 322, 'b', 11401),
(4, 'tuesday', 245, 'b', 11701),
(4, 'tuesday', 323, 'c', 11201),
(4, 'tuesday', 332, 'a', 31203),
(4, 'wednesday', 214, 'c', 11501),
(4, 'wednesday', 322, 'b', 11401),
(4, 'wednesday', 332, 'a', 31404),
(5, 'friday', 236, 'a', 31105),
(5, 'friday', 245, 'c', 11701),
(5, 'friday', 322, 'b', 11101),
(5, 'monday', 214, 'c', 11601),
(5, 'monday', 232, 'b', 11401),
(5, 'monday', 236, 'a', 31308),
(5, 'thursday', 323, 'c', 11101),
(5, 'thursday', 332, 'a', 31203),
(5, 'tuesday', 236, 'a', 31405),
(5, 'tuesday', 245, 'b', 11701),
(5, 'wednesday', 332, 'a', 31203),
(6, 'friday', 332, 'b', 11501),
(6, 'monday', 215, 'b', 11601),
(6, 'thursday', 322, 'c', 11501),
(6, 'thursday', 324, 'b', 11201),
(6, 'tuesday', 236, 'a', 31405),
(6, 'tuesday', 244, 'c', 11501);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `section` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subjectCode` int(11) NOT NULL,
  `section` varchar(1) NOT NULL,
  `teacherId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subject_name`
--

CREATE TABLE `subject_name` (
  `subjectCode` int(11) NOT NULL,
  `subjectName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject_name`
--

INSERT INTO `subject_name` (`subjectCode`, `subjectName`) VALUES
(31105, 'Artificial Intelligence'),
(31203, 'Engineering Mathematics'),
(31306, 'Software Requirement Engineering'),
(31308, 'Advanced Web Technology'),
(31404, 'Advanced Networking'),
(31405, 'Computer Architecture');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `department` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(15) DEFAULT NULL,
  `permissions` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`, `permissions`) VALUES
(3, 'aaa', 'aaa@gmail.com', '$2y$10$cqwB2uKJ3dO19qoyDoKSa.36PkgP7Wdaz3VX/CRf5h/ZpvUdiFlf6', NULL, 0),
(4, 'b', 'b@gmail.com', '$2y$10$ND5UH.O5CAsbrHOBkOTGTO1WuD8guwOojxEcILqqQUvLHtGfUUZmK', NULL, 1),
(5, 'c', 'c@gmail.com', '$2y$10$w3K8gG9HVhdzyg11YLM8e.7xQvNZkGnH5eaDcR3VUG/NNvBilXWea', NULL, 1),
(6, 'teacher1', 'teacher1@gmail.com', '$2y$10$3m6RQYS0vk6bRe7Z4Zx8ue5JdBh2m5a8uyllaHzyIggORywMw/yA.', NULL, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approval`
--
ALTER TABLE `approval`
  ADD PRIMARY KEY (`id`),
  ADD KEY `period` (`period`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `priority`
--
ALTER TABLE `priority`
  ADD PRIMARY KEY (`reason`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomNo`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`period`,`day`,`roomNo`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subjectCode`);

--
-- Indexes for table `subject_name`
--
ALTER TABLE `subject_name`
  ADD PRIMARY KEY (`subjectCode`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approval`
--
ALTER TABLE `approval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
