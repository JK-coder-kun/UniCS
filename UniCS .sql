-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 06, 2023 at 09:38 AM
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
  `roomNo` int(11) NOT NULL,
  `period` int(11) NOT NULL,
  `day` varchar(11) NOT NULL,
  `date` date NOT NULL,
  `reason` varchar(30) DEFAULT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `notiText` text NOT NULL,
  `status` int(11) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `userid`, `notiText`, `status`, `time`) VALUES
(1, 4, 'Your request has been approved!\nRoom No:223\nTime :friday, 1', 1, '2023-01-31 00:00:00'),
(2, 4, 'Your request has been approved!\nRoom No:231\nTime :thursday, 1', 1, '2023-01-31 00:00:00'),
(3, 4, 'Your request has been approved!\nRoom No:231\nTime :friday, 1', 1, '2023-01-31 00:00:00'),
(4, 4, 'Your request has been approved!\nRoom No:221\nTime :friday, 1', 1, '2023-01-31 00:00:00'),
(5, 4, 'Your request has been approved!\nRoom No:222\nTime :friday, 1', 1, '2023-01-31 00:00:00'),
(6, 4, 'Your request has been approved!\nRoom No:222\nTime :friday, 1', 1, '2023-01-31 00:00:00'),
(7, 4, 'Your request has been approved!\nRoom No:222\nTime :friday, 1', 1, '2023-01-31 00:00:00'),
(8, 4, 'Your request has been approved!\nRoom No:223\nTime :wednesday, 4', 1, '2023-02-01 00:00:00'),
(9, 4, 'Your request has been approved!\nRoom No:213\nTime :wednesday, 4', 1, '2023-02-01 00:00:00'),
(10, 5, 'This is test message', 1, '2023-02-16 00:00:00'),
(11, 5, 'Your request has been approved!\nRoom No:213\nTime :thursday, 1', 1, '2023-02-02 09:00:00'),
(12, 5, 'Your request has been approved!\nRoom No:212\nTime :thursday, 3', 1, '2023-02-02 09:18:00'),
(13, 5, 'Your request has been approved!\nRoom No:211\nTime :thursday, 5', 1, '2023-02-02 12:08:00'),
(14, 5, 'Your request has been approved!\nRoom No:212\nTime :thursday, 6', 1, '2023-02-02 12:34:00'),
(15, 5, 'Your request has been rejected!\nFor room No:211\nAt :monday, period 1', 1, '2023-02-03 02:54:00'),
(17, 5, 'Your request has been rejected!\nFor room No:211\nAt :monday, period 1', 1, '2023-02-03 03:35:00'),
(18, 5, 'Your request has been rejected!\nFor room No:211\nAt :monday, period 1', 1, '2023-02-03 03:35:00'),
(19, 5, 'Your request has been rejected!\nFor room No:211\nAt :monday, period 1', 1, '2023-02-03 03:35:00'),
(20, 5, 'Your request has been approved!\nRoom No:211\nTime :monday, period 1', 1, '2023-02-03 03:35:00'),
(21, 5, 'Your request has been approved!\nRoom No:211\nTime :monday, period 1', 1, '2023-02-03 05:22:00'),
(22, 5, 'Your request has been approved!\nRoom No:332\nTime :friday, period 5', 1, '2023-02-03 11:10:00'),
(23, 5, 'Your request has been approved!\nRoom No:316\nTime :friday, period 5', 1, '2023-02-03 01:17:00'),
(24, 5, 'Your request has been approved!\nRoom No:316\nTime :friday, period 5', 1, '2023-02-03 01:17:00'),
(25, 5, 'Your request has been approved!\nRoom No:214\nTime :friday, period 6', 1, '2023-02-03 02:26:00'),
(26, 5, 'Your request has been approved!\nRoom No:214\nTime :friday, period 6', 1, '2023-02-03 02:28:00'),
(27, 5, 'Your request has been approved!\nRoom No:214\nTime :friday, period 6', 1, '2023-02-03 02:29:00'),
(28, 5, 'Your request has been approved!\nRoom No:214\nTime :friday, period 6', 1, '2023-02-03 02:30:00'),
(29, 5, 'Your request has been approved!\nRoom No:214\nTime :friday, period 6', 1, '2023-02-03 02:31:00'),
(30, 5, 'Your request has been approved!\nRoom No:214\nTime :friday, period 6', 1, '2023-02-03 02:34:00'),
(31, 5, 'Your request has been approved!\nRoom No:214\nTime :friday, period 6', 1, '2023-02-03 02:34:00'),
(32, 5, 'Your request has been approved!\nRoom No:216\nTime :friday, period 6', 1, '2023-02-03 03:03:00'),
(33, 7, 'Your request has been approved!\nRoom No:223\nTime :monday, period 3', 1, '2023-02-06 09:35:00'),
(34, 4, 'Your request has been approved!</br>Room No:213</br>Time :monday, period 3', 1, '2023-02-06 09:42:00'),
(35, 4, 'Your request has been approved!</br>Room No:214,  Time :monday, period 3', 1, '2023-02-06 09:45:00'),
(36, 4, 'Your request has been approved!</br>Room No:215,  Time :monday, period 5', 1, '2023-02-06 12:33:00'),
(37, 4, 'Your request has been approved!</br>Room No:215,  Time :monday, period 4', 1, '2023-02-06 12:35:00'),
(38, 4, 'Your request has been approved!</br>Room No:216,  Time :monday, period 5', 1, '2023-02-06 12:40:00'),
(39, 4, 'Your request has been approved!</br>Room No:226,  Time :monday, period 5', 1, '2023-02-06 01:27:00');

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
('club activity', 2),
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
  `date` datetime NOT NULL,
  `reason` varchar(30) DEFAULT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `roomNo`, `period`, `day`, `date`, `reason`, `userId`) VALUES
(8, 211, 1, 'tuesday', '2023-02-06 01:39:00', 'club activity', 4),
(9, 211, 1, 'tuesday', '2023-02-06 01:39:00', 'lecture', 4);

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
  `id` int(11) NOT NULL,
  `period` int(11) NOT NULL,
  `day` varchar(10) NOT NULL,
  `roomNo` varchar(10) NOT NULL,
  `section` varchar(1) NOT NULL,
  `subjectCode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `period`, `day`, `roomNo`, `section`, `subjectCode`) VALUES
(1, 1, 'thursday', '214', 'c', '11701'),
(2, 1, 'thursday', '236', 'a', '31308'),
(3, 1, 'thursday', '322', 'b', '11601'),
(4, 1, 'tuesday', '214', 'c', '11201'),
(5, 1, 'tuesday', '236', 'a', '31404'),
(6, 1, 'tuesday', '324', 'b', '11501'),
(7, 1, 'wednesday', '236', 'a', '31405'),
(8, 1, 'wednesday', '323', 'c', '11401'),
(9, 1, 'wednesday', '332', 'b', '11201'),
(10, 2, 'Firday', '323', 'c', '11101'),
(11, 2, 'friday', '326', 'b', '11401'),
(12, 2, 'friday', '332', 'a', '31105'),
(13, 2, 'monday', '323', 'c', '11101'),
(14, 2, 'monday', '324', 'b', '11501'),
(15, 2, 'monday', '332', 'a', '31203'),
(16, 2, 'thursday', '214', 'c', '11501'),
(17, 2, 'thursday', '322', 'b', '11701'),
(18, 2, 'thursday', '332', 'a', '31405'),
(19, 2, 'tuesday', '236', 'a', '31308'),
(20, 2, 'tuesday', '322', 'b', '11101'),
(21, 2, 'tuesday', '323', 'c', '11401'),
(22, 2, 'wednesday', '214', 'c', '11601'),
(23, 2, 'wednesday', '236', 'a', '31306'),
(24, 2, 'wednesday', '322', 'b', '11101'),
(25, 3, 'friday', '215', 'c', '11701'),
(26, 3, 'friday', '332', 'a', '31404'),
(27, 3, 'monday', '234', 'c', '11401'),
(28, 3, 'monday', '236', 'a', '31306'),
(29, 3, 'monday', '324', 'b', '11201'),
(30, 3, 'thursday', '323', 'b', '11601'),
(31, 3, 'thursday', '326', 'c', '11201'),
(32, 3, 'thursday', '332', 'a', '31404'),
(33, 3, 'tuesday', '322', 'b', '11201'),
(34, 3, 'tuesday', '323', 'c', '11101'),
(35, 3, 'tuesday', '332', 'a', '31306'),
(36, 3, 'wednesday', '214', 'c', '11201'),
(37, 3, 'wednesday', '322', 'b', '11701'),
(38, 3, 'wednesday', '332', 'a', '31105'),
(39, 4, 'friday', '244', 'b', '11501'),
(40, 4, 'friday', '245', 'c', '11701'),
(41, 4, 'friday', '332', 'a', '31306'),
(42, 4, 'monday', '234', 'c', '11401'),
(43, 4, 'monday', '236', 'a', '31308'),
(44, 4, 'monday', '322', 'b', '11101'),
(45, 4, 'thursday', '214', 'c', '11601'),
(46, 4, 'thursday', '236', 'a', '31105'),
(47, 4, 'thursday', '322', 'b', '11401'),
(48, 4, 'tuesday', '245', 'b', '11701'),
(49, 4, 'tuesday', '323', 'c', '11201'),
(50, 4, 'tuesday', '332', 'a', '31203'),
(51, 4, 'wednesday', '214', 'c', '11501'),
(52, 4, 'wednesday', '322', 'b', '11401'),
(53, 4, 'wednesday', '332', 'a', '31404'),
(54, 5, 'friday', '236', 'a', '31105'),
(55, 5, 'friday', '245', 'c', '11701'),
(56, 5, 'friday', '322', 'b', '11101'),
(57, 5, 'monday', '214', 'c', '11601'),
(58, 5, 'monday', '232', 'b', '11401'),
(59, 5, 'monday', '236', 'a', '31308'),
(60, 5, 'thursday', '323', 'c', '11101'),
(61, 5, 'thursday', '332', 'a', '31203'),
(62, 5, 'tuesday', '236', 'a', '31405'),
(63, 5, 'tuesday', '245', 'b', '11701'),
(64, 5, 'wednesday', '332', 'a', '31203'),
(65, 6, 'friday', '332', 'b', '11501'),
(66, 6, 'monday', '215', 'b', '11601'),
(67, 6, 'thursday', '322', 'c', '11501'),
(68, 6, 'thursday', '324', 'b', '11201'),
(69, 6, 'tuesday', '236', 'a', '31405'),
(70, 6, 'tuesday', '244', 'c', '11501');

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
(6, 'teacher1', 'teacher1@gmail.com', '$2y$10$3m6RQYS0vk6bRe7Z4Zx8ue5JdBh2m5a8uyllaHzyIggORywMw/yA.', NULL, 7),
(7, 'admin', 'admin@gmail.com', '$2y$10$.baq5Ulgb6toIrvbWSm4V.Dl5OFkkVTDVr4gOZYm7B3ccgCz6s9zC', 'teacher', 7);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
