-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2024 at 04:21 PM
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
-- Table structure for table `coursetb`
--

CREATE TABLE `coursetb` (
  `CourseID` int(11) NOT NULL,
  `CourseName` varchar(50) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Credits` varchar(50) DEFAULT NULL,
  `Level` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enrollmenttb`
--

CREATE TABLE `enrollmenttb` (
  `EnrollmentID` int(11) NOT NULL,
  `EnrollmentDate` datetime DEFAULT current_timestamp(),
  `SectionID` int(11) DEFAULT NULL,
  `SectionName` varchar(100) DEFAULT NULL,
  `CoursePrice` int(11) DEFAULT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `StudentName` varchar(50) DEFAULT NULL,
  `PaymentID` int(11) DEFAULT NULL,
  `PaymentName` varchar(100) DEFAULT NULL,
  `PaymentType` varchar(50) DEFAULT NULL,
  `StaffID` int(11) DEFAULT NULL,
  `StaffName` varchar(50) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `created_at`) VALUES
(3, 'Update-testing', '2024-12-25 05:17:58'),
(4, 'testing-4', '2024-12-25 05:18:15'),
(5, 'testing-4', '2024-12-25 05:34:23');

-- --------------------------------------------------------

--
-- Table structure for table `paymentb`
--

CREATE TABLE `paymentb` (
  `PaymentID` int(11) NOT NULL,
  `PaymentName` varchar(100) DEFAULT NULL,
  `PyamentTypeID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paymentypetb`
--

CREATE TABLE `paymentypetb` (
  `PyamentTypeID` int(11) NOT NULL,
  `PaymentType` varchar(50) DEFAULT NULL,
  `Img` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sectiontb`
--

CREATE TABLE `sectiontb` (
  `SectionID` int(11) NOT NULL,
  `SectionName` int(100) NOT NULL,
  `CoursePrice` int(11) NOT NULL,
  `StartDate` varchar(50) DEFAULT NULL,
  `EndDate` varchar(100) DEFAULT NULL,
  `Duration` varchar(100) DEFAULT NULL,
  `Totalenrollments` int(11) DEFAULT NULL,
  `EnrollmentStudents` int(11) DEFAULT NULL,
  `Discount` int(11) DEFAULT NULL,
  `CourseID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staffroletb`
--

CREATE TABLE `staffroletb` (
  `RoleID` int(11) NOT NULL,
  `Rolename` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staffroletb`
--

INSERT INTO `staffroletb` (`RoleID`, `Rolename`) VALUES
(1, 'Admin'),
(2, 'Sales'),
(3, 'Enrollment'),
(4, 'Project manager');

-- --------------------------------------------------------

--
-- Table structure for table `stafftb`
--

CREATE TABLE `stafftb` (
  `StaffID` int(11) NOT NULL,
  `StaffName` varchar(50) DEFAULT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `PhoneNo` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `StaffPicture` varchar(100) DEFAULT NULL,
  `RoleID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studenttb`
--

CREATE TABLE `studenttb` (
  `StudentID` int(11) NOT NULL,
  `StudentName` varchar(50) DEFAULT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `PhoneNo` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `StudentPicture` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjecttb`
--

CREATE TABLE `subjecttb` (
  `SubjectID` int(11) NOT NULL,
  `SubjectName` varchar(100) DEFAULT NULL,
  `TotalTopics` varchar(100) DEFAULT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `TeacherID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachertb`
--

CREATE TABLE `teachertb` (
  `TeacherID` int(11) NOT NULL,
  `TeacherName` varchar(50) DEFAULT NULL,
  `TeacherDegree` varchar(100) DEFAULT NULL,
  `TeacherEmail` varchar(50) DEFAULT NULL,
  `TeacherAddress` varchar(200) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coursetb`
--
ALTER TABLE `coursetb`
  ADD PRIMARY KEY (`CourseID`);

--
-- Indexes for table `enrollmenttb`
--
ALTER TABLE `enrollmenttb`
  ADD PRIMARY KEY (`EnrollmentID`),
  ADD KEY `StaffID` (`StaffID`),
  ADD KEY `SectionID` (`SectionID`),
  ADD KEY `StudentID` (`StudentID`),
  ADD KEY `PaymentID` (`PaymentID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentb`
--
ALTER TABLE `paymentb`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `PyamentTypeID` (`PyamentTypeID`);

--
-- Indexes for table `paymentypetb`
--
ALTER TABLE `paymentypetb`
  ADD PRIMARY KEY (`PyamentTypeID`);

--
-- Indexes for table `sectiontb`
--
ALTER TABLE `sectiontb`
  ADD PRIMARY KEY (`SectionID`),
  ADD KEY `CourseID` (`CourseID`);

--
-- Indexes for table `staffroletb`
--
ALTER TABLE `staffroletb`
  ADD PRIMARY KEY (`RoleID`);

--
-- Indexes for table `stafftb`
--
ALTER TABLE `stafftb`
  ADD PRIMARY KEY (`StaffID`),
  ADD KEY `RoleID` (`RoleID`);

--
-- Indexes for table `studenttb`
--
ALTER TABLE `studenttb`
  ADD PRIMARY KEY (`StudentID`);

--
-- Indexes for table `subjecttb`
--
ALTER TABLE `subjecttb`
  ADD PRIMARY KEY (`SubjectID`),
  ADD KEY `CourseID` (`CourseID`),
  ADD KEY `TeacherID` (`TeacherID`);

--
-- Indexes for table `teachertb`
--
ALTER TABLE `teachertb`
  ADD PRIMARY KEY (`TeacherID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coursetb`
--
ALTER TABLE `coursetb`
  MODIFY `CourseID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enrollmenttb`
--
ALTER TABLE `enrollmenttb`
  MODIFY `EnrollmentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `paymentb`
--
ALTER TABLE `paymentb`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymentypetb`
--
ALTER TABLE `paymentypetb`
  MODIFY `PyamentTypeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sectiontb`
--
ALTER TABLE `sectiontb`
  MODIFY `SectionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staffroletb`
--
ALTER TABLE `staffroletb`
  MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stafftb`
--
ALTER TABLE `stafftb`
  MODIFY `StaffID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studenttb`
--
ALTER TABLE `studenttb`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjecttb`
--
ALTER TABLE `subjecttb`
  MODIFY `SubjectID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachertb`
--
ALTER TABLE `teachertb`
  MODIFY `TeacherID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrollmenttb`
--
ALTER TABLE `enrollmenttb`
  ADD CONSTRAINT `enrollmenttb_ibfk_1` FOREIGN KEY (`StaffID`) REFERENCES `stafftb` (`StaffID`),
  ADD CONSTRAINT `enrollmenttb_ibfk_2` FOREIGN KEY (`SectionID`) REFERENCES `sectiontb` (`SectionID`),
  ADD CONSTRAINT `enrollmenttb_ibfk_3` FOREIGN KEY (`StudentID`) REFERENCES `studenttb` (`StudentID`),
  ADD CONSTRAINT `enrollmenttb_ibfk_4` FOREIGN KEY (`PaymentID`) REFERENCES `paymentb` (`PaymentID`);

--
-- Constraints for table `paymentb`
--
ALTER TABLE `paymentb`
  ADD CONSTRAINT `paymentb_ibfk_1` FOREIGN KEY (`PyamentTypeID`) REFERENCES `paymentypetb` (`PyamentTypeID`);

--
-- Constraints for table `sectiontb`
--
ALTER TABLE `sectiontb`
  ADD CONSTRAINT `sectiontb_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `coursetb` (`CourseID`);

--
-- Constraints for table `stafftb`
--
ALTER TABLE `stafftb`
  ADD CONSTRAINT `stafftb_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `staffroletb` (`RoleID`);

--
-- Constraints for table `subjecttb`
--
ALTER TABLE `subjecttb`
  ADD CONSTRAINT `subjecttb_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `coursetb` (`CourseID`),
  ADD CONSTRAINT `subjecttb_ibfk_2` FOREIGN KEY (`TeacherID`) REFERENCES `teachertb` (`TeacherID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
