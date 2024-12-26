-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 26, 2024 at 10:54 AM
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
-- Database: `enrollment_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_tokens`
--

CREATE TABLE `access_tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expires_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `access_tokens`
--

INSERT INTO `access_tokens` (`id`, `user_id`, `token`, `created_at`, `expires_at`) VALUES
(1, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUxODY5OTYsImV4cCI6MTczNTI3MzM5NiwidXNlcklkIjoiMSJ9.QIPfmZyg24becS9rK7mr6KG_FcTzQZTubnCmcuqRiwg', '2024-12-26 04:23:16', '0000-00-00 00:00:00'),
(2, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUxOTA1NjEsImV4cCI6MTczNTI3Njk2MSwidXNlcklkIjoiNCJ9.zjax3FFuT1KJECEvQp1kmBBnhhfLt--UcRRnmtgP6s0', '2024-12-26 05:22:41', '0000-00-00 00:00:00'),
(5, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUxOTY4MTAsImV4cCI6MTczNTI4MzIxMCwidXNlcklkIjoxfQ.uDyxCsZM7t_Izjb6PSQLh2EtCZVZw4on8etybRumdoM', '2024-12-26 07:06:50', '0000-00-00 00:00:00'),
(6, 9, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUxOTg2MjYsImV4cCI6MTczNTI4NTAyNiwidXNlcklkIjoiOSJ9._70MpusgnIR9NOf9BYN4gDdCWZkPgoQCWvLUKWLrbA0', '2024-12-26 07:37:06', '0000-00-00 00:00:00'),
(7, 9, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUxOTg2NTAsImV4cCI6MTczNTI4NTA1MCwidXNlcklkIjo5fQ.4qkVZucYXXtYOaPGOgGnPgcEdwgRaxXEb1LGYDpM-Cg', '2024-12-26 07:37:30', '0000-00-00 00:00:00'),
(8, 5, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUyMDE3MzQsImV4cCI6MTczNTI4ODEzNCwidXNlcklkIjo1fQ.xoMYofAWv2PIGZtwOWxlcuskjCklamjN45a6fGjRjfg', '2024-12-26 08:28:54', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `teacher_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `evidence_image` varchar(255) DEFAULT NULL,
  `status` enum('pending','confirmed','rejected') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `section_id`, `student_id`, `amount`, `evidence_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 3000.00, 'staff_676d23ef9f2ae.png', 'confirmed', '2024-12-26 09:37:51', '2024-12-26 09:50:03');

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

CREATE TABLE `payment_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `course_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`course_ids`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `nrc_id` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `guardian_name` varchar(255) DEFAULT NULL,
  `guardian_contact` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `nrc_id`, `date_of_birth`, `gender`, `phone_number`, `address`, `guardian_name`, `guardian_contact`, `user_id`, `created_at`, `updated_at`) VALUES
(2, '8/asf(N)12222', '2000-02-19', 'male', '0911111111', 'Yangon', 'HT', 'ABC', 5, '2024-12-26 05:23:58', '2024-12-26 05:23:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','teacher','student') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$oauBHOznGAVTNwmCgcgRcueXNtU4izgEmpRUGqWVC3e66VCNcxcq.', 'admin', '2024-12-26 04:23:16', '2024-12-26 04:23:16'),
(5, 'Student2', 'stu2@gmail.com', '$2y$10$fNEPlT5q8pUIfjjJBiMPB.lO8uT0QQGRteNfmjNtDC6SNVJDqTIyC', 'student', '2024-12-26 05:23:58', '2024-12-26 05:23:58'),
(7, 'Teacher1', 'teacher1@gmail.com', '$2y$10$uHn/RURbuBnrRwwbeY1SVeLGHzlvr3Z8F9xT1iA.dsCzk76L2KM4.', 'teacher', '2024-12-26 07:25:52', '2024-12-26 07:25:52'),
(8, 'Teacher2', 'teacher2@gmail.com', '$2y$10$PA55MT657WIiTCkvQ/6Qg.YdZ69hG1x0Epl8O9v1Qqa4Owt/xfujy', 'teacher', '2024-12-26 07:26:02', '2024-12-26 07:26:02'),
(10, 'Teacher3', 'teacher3@gmail.com', '$2y$10$Q11MQ4qi43IP/.YFJ6i1kukaEUxT0YVPr1tKPDJXEu6e9QOqtaHzS', 'teacher', '2024-12-26 07:38:27', '2024-12-26 07:38:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_tokens`
--
ALTER TABLE `access_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_tokens`
--
ALTER TABLE `access_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
