-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 25, 2020 at 03:18 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bstest`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmins`
--

CREATE TABLE `tbladmins` (
  `id` bigint(20) NOT NULL,
  `admin_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbladmins`
--

INSERT INTO `tbladmins` (`id`, `admin_id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 0, 'Admin', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', '2020-04-25 11:37:54', '2020-04-25 11:37:54'),
(2, 1, 'Mohit Verma', 'mohitverma.may@gmail.com', '202cb962ac59075b964b07152d234b70', '2020-04-25 12:36:56', '2020-04-25 12:36:56');

-- --------------------------------------------------------

--
-- Table structure for table `tblsettings`
--

CREATE TABLE `tblsettings` (
  `id` int(11) NOT NULL,
  `setting_name` varchar(255) NOT NULL,
  `setting_value` varchar(255) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblsettings`
--

INSERT INTO `tblsettings` (`id`, `setting_name`, `setting_value`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'bs_time', '5', 1, '2020-04-25 12:50:25', '2020-04-25 17:15:59');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) DEFAULT NULL,
  `token` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `name`, `email`, `password`, `token`, `created_at`, `updated_at`) VALUES
(1, 'Mohit Verma', 'mohitverma.may0@gmail.com', '202cb962ac59075b964b07152d234b70', '5ea320b423541', '2020-04-24 16:33:41', '2020-04-24 17:24:04'),
(2, 'Sandeep', 'sandeepriwebsoftindia@gmail.com', '202cb962ac59075b964b07152d234b70', '5ea3225a44c7a', '2020-04-24 17:30:58', '2020-04-24 17:31:06'),
(3, 'Manish', 'manish@man.com', '202cb962ac59075b964b07152d234b70', '5ea3da2473e54', '2020-04-25 06:34:30', '2020-04-25 06:35:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bs`
--

CREATE TABLE `tbl_bs` (
  `id` bigint(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `bs_level` decimal(20,2) NOT NULL,
  `status` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bs`
--

INSERT INTO `tbl_bs` (`id`, `user_id`, `bs_level`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '10.00', 1, '2020-04-25 13:15:43', '2020-04-25 17:02:52'),
(2, 1, '5.00', 1, '2020-04-25 17:05:17', '2020-04-25 17:16:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prescription`
--

CREATE TABLE `tbl_prescription` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `file_name` text NOT NULL,
  `file_size` text NOT NULL,
  `file` text NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_prescription`
--

INSERT INTO `tbl_prescription` (`id`, `user_id`, `file_name`, `file_size`, `file`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, '360827', '488240', '1587819974360827.jpg', 'he', '2020-04-25 18:36:14', '2020-04-25 18:36:14'),
(2, 1, '360827', '488240', '1587820313360827.jpg', 'ggghgh', '2020-04-25 18:41:53', '2020-04-25 18:41:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmins`
--
ALTER TABLE `tbladmins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tblsettings`
--
ALTER TABLE `tblsettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tbl_bs`
--
ALTER TABLE `tbl_bs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_prescription`
--
ALTER TABLE `tbl_prescription`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmins`
--
ALTER TABLE `tbladmins`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblsettings`
--
ALTER TABLE `tblsettings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_bs`
--
ALTER TABLE `tbl_bs`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_prescription`
--
ALTER TABLE `tbl_prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
