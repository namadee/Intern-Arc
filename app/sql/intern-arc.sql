-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2022 at 09:50 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `intern-arc`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisement_tbl`
--

CREATE TABLE `advertisement_tbl` (
  `advertisement_id` int(11) NOT NULL,
  `position` varchar(255) NOT NULL,
  `job_description` text NOT NULL,
  `requirements` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `working_mode` varchar(50) NOT NULL,
  `applicable_year` varchar(15) NOT NULL,
  `intern_count` int(5) NOT NULL DEFAULT 1 COMMENT 'Min count = 1',
  `status` varchar(15) NOT NULL DEFAULT 'pending' COMMENT 'initial state = pending',
  `company_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `company_tbl`
--

CREATE TABLE `company_tbl` (
  `company_id` int(20) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `profile_description` varchar(255) NOT NULL,
  `website_link` varchar(255) NOT NULL,
  `company_slogan` varchar(255) NOT NULL,
  `linkedln` varchar(255) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `blacklisted` int(2) NOT NULL DEFAULT 0 COMMENT '0 == N0 & 1 == YES',
  `user_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `complaint_tbl`
--

CREATE TABLE `complaint_tbl` (
  `complaint_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 == Not Reviewed and 1== Reviewed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id_fk` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `interested_area_tbl`
--

CREATE TABLE `interested_area_tbl` (
  `id` int(11) NOT NULL,
  `area_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jobrole_tbl`
--

CREATE TABLE `jobrole_tbl` (
  `jobrole_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobrole_tbl`
--

INSERT INTO `jobrole_tbl` (`jobrole_id`, `name`) VALUES
(9, 'Hello worldsdfsdasd'),
(11, 'sdf'),
(12, 'Hello worldsdfsdasd'),
(15, 'dfgdfg'),
(16, 'Hello worldsdfsdasd'),
(17, 'asdasdghggh'),
(18, ''),
(19, 'Hello worldsdfsdasd'),
(20, 'Hello worldsdfsdasd');

-- --------------------------------------------------------

--
-- Table structure for table `student_tbl`
--

CREATE TABLE `student_tbl` (
  `student_id` int(11) NOT NULL,
  `index_number` int(20) NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `profile_name` varchar(255) NOT NULL,
  `personal_email` varchar(255) NOT NULL,
  `profile_description` varchar(255) NOT NULL,
  `stream` varchar(10) NOT NULL,
  `school` varchar(255) NOT NULL,
  `cv` varchar(255) NOT NULL,
  `github` varchar(255) NOT NULL,
  `linkedln` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 == Recruited and 0 == Pending',
  `user_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `user_id` int(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` int(10) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `username`, `email`, `password`, `contact`, `profile_pic`, `created_at`, `user_role`) VALUES
(5, 'Ruchira', 'asdasd', 'asdasd', 21312, 'dfgdfg', '2022-11-29 18:19:02', 'admin'),
(6, 'Ruchira', 'ruchira@gmail.com', '$2y$10$tlmujiPYQM1qXIgGxuqbju47jhnK14vyCcMYL4uPeeIsxkE92AxOS', 713251, 'ruchira@gmail.com', '2022-11-29 18:22:40', 'pdc'),
(7, 'Ruchira', 'hello@gmail.com', '$2y$10$EUMhdsJBOaEQi3XMWmcYAOdyBubMzsV4TjNqV1y6e/ecibXFdgfZS', 0, 'hello@gmail.com', '2022-11-29 20:17:24', 'student'),
(8, 'asdasd', 'ruchira@asd.com', '$2y$10$PExMC/oGrmn.Xrv721Nv2OOTpaREbbNeK7LDMC7iusKSmHJ.8UNz2', 23213, 'ruchira@asd.com', '2022-11-30 05:07:06', 'company'),
(9, 'admin', 'admin@gmail.com', '$2y$10$pkCXwhFadu00i.V0/qlM4ObXn6F4NEU1VgyWdftPHPO4ka/bpJble', 7889456, 'admin@gmail.com', '2022-11-30 05:20:40', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisement_tbl`
--
ALTER TABLE `advertisement_tbl`
  ADD PRIMARY KEY (`advertisement_id`),
  ADD KEY `COMPANY_ID_FK` (`company_id_fk`);

--
-- Indexes for table `company_tbl`
--
ALTER TABLE `company_tbl`
  ADD PRIMARY KEY (`company_id`),
  ADD KEY `USER_ID_FK` (`user_id_fk`);

--
-- Indexes for table `complaint_tbl`
--
ALTER TABLE `complaint_tbl`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `USER_ID_FK` (`user_id_fk`),
  ADD KEY `user_id_fk_2` (`user_id_fk`);

--
-- Indexes for table `interested_area_tbl`
--
ALTER TABLE `interested_area_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobrole_tbl`
--
ALTER TABLE `jobrole_tbl`
  ADD PRIMARY KEY (`jobrole_id`);

--
-- Indexes for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `INDEX_NO` (`index_number`) USING BTREE,
  ADD UNIQUE KEY `REG_NUM` (`registration_number`) USING BTREE,
  ADD KEY `USER_ID_FK` (`user_id_fk`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `USER_EMAIL` (`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisement_tbl`
--
ALTER TABLE `advertisement_tbl`
  MODIFY `advertisement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_tbl`
--
ALTER TABLE `company_tbl`
  MODIFY `company_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complaint_tbl`
--
ALTER TABLE `complaint_tbl`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `interested_area_tbl`
--
ALTER TABLE `interested_area_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobrole_tbl`
--
ALTER TABLE `jobrole_tbl`
  MODIFY `jobrole_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advertisement_tbl`
--
ALTER TABLE `advertisement_tbl`
  ADD CONSTRAINT `advertisement_tbl_ibfk_1` FOREIGN KEY (`company_id_fk`) REFERENCES `company_tbl` (`company_id`);

--
-- Constraints for table `company_tbl`
--
ALTER TABLE `company_tbl`
  ADD CONSTRAINT `company_tbl_ibfk_1` FOREIGN KEY (`user_id_fk`) REFERENCES `user_tbl` (`user_id`);

--
-- Constraints for table `complaint_tbl`
--
ALTER TABLE `complaint_tbl`
  ADD CONSTRAINT `complaint_tbl_ibfk_1` FOREIGN KEY (`user_id_fk`) REFERENCES `user_tbl` (`user_id`);

--
-- Constraints for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD CONSTRAINT `student_tbl_ibfk_1` FOREIGN KEY (`user_id_fk`) REFERENCES `user_tbl` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
