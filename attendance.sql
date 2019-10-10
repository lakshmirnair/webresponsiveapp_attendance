-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2019 at 10:20 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `assigned_subjects`
--

CREATE TABLE `assigned_subjects` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_posts`
--

CREATE TABLE `attendance_posts` (
  `id` int(11) NOT NULL,
  `attendance_status_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `attendance_value` int(11) NOT NULL,
  `created_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_status`
--

CREATE TABLE `attendance_status` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `att_date` varchar(255) NOT NULL,
  `total_students` int(11) NOT NULL,
  `total_present` int(11) NOT NULL,
  `total_absent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `branch_code` varchar(255) NOT NULL,
  `hod` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `branch_name`, `branch_code`, `hod`, `status`, `created_date`) VALUES
(1, 'Computer Science And Engineering', 'cse', 'Ravinder', 0, '2019-09-11 07:08:55'),
(2, 'Mechanical Engineering', 'me', 'ashok', 1, '2019-09-10 07:18:09'),
(12, 'Computer Science And Engineering', 'CSE', '', 1, '2019-09-17 15:37:57');

-- --------------------------------------------------------

--
-- Table structure for table `login_user`
--

CREATE TABLE `login_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `user_status` int(11) DEFAULT NULL,
  `created_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_user`
--

INSERT INTO `login_user` (`id`, `username`, `password`, `status`, `user_status`, `created_date`) VALUES
(2, 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(11) NOT NULL,
  `semester_code` varchar(255) DEFAULT NULL,
  `semester_name` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `semester_code`, `semester_name`, `created_date`) VALUES
(1, '1', 'Semester 1', '2019-09-23 17:17:38'),
(2, '2', 'Semester 2', '2019-09-23 17:18:28'),
(3, '3', 'Semester 3', '2019-09-23 17:18:23'),
(4, '4', 'Semester 4', '2019-09-23 17:18:17'),
(5, '5', 'Semester 5', '2019-09-23 17:18:31'),
(6, '6', 'Semester 6', '2019-09-23 17:18:34'),
(7, '7', 'Semester 7', '2019-09-23 17:18:37'),
(8, '8', 'Semester 8', '2019-09-23 17:18:40');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `sem_code` varchar(50) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `roll_number` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `sub_name` varchar(255) NOT NULL,
  `sub_code` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `teacher_email` varchar(100) DEFAULT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `teacher_code` varchar(11) DEFAULT NULL,
  `position` int(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assigned_subjects`
--
ALTER TABLE `assigned_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_posts`
--
ALTER TABLE `attendance_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_status`
--
ALTER TABLE `attendance_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_user`
--
ALTER TABLE `login_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assigned_subjects`
--
ALTER TABLE `assigned_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `attendance_posts`
--
ALTER TABLE `attendance_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `attendance_status`
--
ALTER TABLE `attendance_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `login_user`
--
ALTER TABLE `login_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
