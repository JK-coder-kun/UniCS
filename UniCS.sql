-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 16, 2023 at 04:45 PM
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
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `roomNo` int(11) NOT NULL,
  `period` int(11) NOT NULL,
  `day` varchar(10) NOT NULL,
  `section` varchar(1) DEFAULT NULL,
  `subjectCode` int(11) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'thursday', 236, 'a', 31308),
(1, 'tuesday', 236, 'a', 31404),
(1, 'wednesday', 236, 'a', 31405),
(2, 'friday', 332, 'a', 31105),
(2, 'monday', 332, 'a', 31203),
(2, 'thursday', 332, 'a', 31405),
(2, 'tuesday', 236, 'a', 31308),
(2, 'wednesday', 236, 'a', 31306),
(3, 'friday', 332, 'a', 31404),
(3, 'monday', 236, 'a', 31306),
(3, 'thursday', 332, 'a', 31404),
(3, 'tuesday', 332, 'a', 31306),
(3, 'wednesday', 332, 'a', 31105),
(4, 'friday', 332, 'a', 31306),
(4, 'monday', 236, 'a', 31308),
(4, 'thursday', 236, 'a', 31105),
(4, 'tuesday', 332, 'a', 31203),
(4, 'wednesday', 332, 'a', 31404),
(5, 'friday', 236, 'a', 31105),
(5, 'monday', 236, 'a', 31308),
(5, 'thursday', 332, 'a', 31203),
(5, 'tuesday', 236, 'a', 31405),
(5, 'wednesday', 332, 'a', 31203),
(6, 'tuesday', 236, 'a', 31405);

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
(1, 'abc', 'abc@gmail.com', 'abc', NULL, NULL),
(3, 'aaa', 'aaa@gmail.com', '$2y$10$cqwB2uKJ3dO19qoyDoKSa.36PkgP7Wdaz3VX/CRf5h/ZpvUdiFlf6', NULL, NULL),
(4, 'b', 'b@gmail.com', '$2y$10$ND5UH.O5CAsbrHOBkOTGTO1WuD8guwOojxEcILqqQUvLHtGfUUZmK', NULL, NULL),
(5, 'c', 'c@gmail.com', '$2y$10$w3K8gG9HVhdzyg11YLM8e.7xQvNZkGnH5eaDcR3VUG/NNvBilXWea', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`roomNo`,`period`,`day`);

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
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
