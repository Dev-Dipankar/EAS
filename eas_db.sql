-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2023 at 11:03 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eas_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(15) NOT NULL,
  `dept_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`) VALUES
(1, 'IT'),
(2, 'Management'),
(3, 'Sales');

-- --------------------------------------------------------

--
-- Table structure for table `emp_info`
--

CREATE TABLE `emp_info` (
  `emp_id` int(15) NOT NULL,
  `dept_id` int(15) NOT NULL,
  `atten_id` int(15) NOT NULL,
  `emp_name` varchar(60) NOT NULL,
  `emp_address` varchar(120) NOT NULL,
  `emp_phone` varchar(20) NOT NULL,
  `emp_email` varchar(60) NOT NULL,
  `department` int(15) NOT NULL,
  `qr_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_info`
--

INSERT INTO `emp_info` (`emp_id`, `dept_id`, `atten_id`, `emp_name`, `emp_address`, `emp_phone`, `emp_email`, `department`, `qr_code`) VALUES
(2, 1, 0, 'Aagya Shrestha ', 'Lubhu', '9860125475', 'aayga@gmail.com', 1, '23f09c602bac5be1b22ffe538222fd9ef84130898bc7204b80666536ee4242c8'),
(3, 3, 0, 'Alan Khanal', 'jhapa', '9825461254', 'alan@gmail.com', 3, '798d312ac0cbf32995c4f36ee4040b20f77793315d01d0a14037c40747a747cc'),
(4, 2, 0, 'Riya Shrestha', 'Naikap', '9865412574', 'riya@gmail.com', 2, '3b37fda9d126027aa1fed217e12626d85367b6127d7c17308c58afd002dbbef3');

-- --------------------------------------------------------

--
-- Table structure for table `scan_records`
--

CREATE TABLE `scan_records` (
  `atten_id` int(11) NOT NULL,
  `emp_id` int(15) NOT NULL,
  `qr_code` varchar(250) NOT NULL,
  `time_in` varchar(250) NOT NULL,
  `time_out` varchar(250) DEFAULT NULL,
  `logdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scan_records`
--

INSERT INTO `scan_records` (`atten_id`, `emp_id`, `qr_code`, `time_in`, `time_out`, `logdate`) VALUES
(8, 0, '798d312ac0cbf32995c4f36ee4040b20f77793315d01d0a14037c40747a747cc', '10:01:24', '10:22:28', '2023-09-21'),
(9, 0, '798d312ac0cbf32995c4f36ee4040b20f77793315d01d0a14037c40747a747cc', '10:22:36', '11:02:35', '2023-09-21');

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `admin_id` int(15) NOT NULL,
  `admin_name` varchar(60) NOT NULL,
  `admin_address` varchar(30) NOT NULL,
  `admin_email` varchar(60) NOT NULL,
  `admin_phone` bigint(10) NOT NULL,
  `admin_passwd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `super_admin`
--

INSERT INTO `super_admin` (`admin_id`, `admin_name`, `admin_address`, `admin_email`, `admin_phone`, `admin_passwd`) VALUES
(1, 'Dipankar Joshi', 'Satungal', 'dipankar@gmail.com', 9860325648, 'root@123'),
(2, 'Aagya Shrestha', 'Lubhu', 'aagya@gmail.com', 9856125412, 'root123'),
(3, 'riya', 'naikap', 'riya@gmail.com', 9856125412, 'riya123'),
(4, 'Alan Khanal', 'Jhapa', 'alan@gmail.com', 9851246571, 'alan@123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `emp_info`
--
ALTER TABLE `emp_info`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `scan_records`
--
ALTER TABLE `scan_records`
  ADD PRIMARY KEY (`atten_id`);

--
-- Indexes for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `emp_info`
--
ALTER TABLE `emp_info`
  MODIFY `emp_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `scan_records`
--
ALTER TABLE `scan_records`
  MODIFY `atten_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `super_admin`
--
ALTER TABLE `super_admin`
  MODIFY `admin_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
