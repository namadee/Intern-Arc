-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2022 at 07:31 AM
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
  `working_mode` varchar(10) NOT NULL,
  `applicable_year` varchar(5) NOT NULL,
  `intern_count` int(5) NOT NULL DEFAULT 1 COMMENT 'Min count = 1',
  `status` varchar(15) NOT NULL DEFAULT 'pending' COMMENT 'initial state = pending',
  `company_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `advertisement_tbl`
--

INSERT INTO `advertisement_tbl` (`advertisement_id`, `position`, `job_description`, `requirements`, `start_date`, `end_date`, `working_mode`, `applicable_year`, `intern_count`, `status`, `company_id_fk`) VALUES
(25, 'QA Engineer', 'Optio ab ducimus a', 'Aperiam vitae magna', '2022-12-17', '2023-01-20', 'onsite', '3', 5, 'pending', 3);

-- --------------------------------------------------------

--
-- Table structure for table `company_tbl`
--

CREATE TABLE `company_tbl` (
  `company_id` int(20) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `address` varchar(255) NOT NULL,
  `profile_description` varchar(255) NOT NULL,
  `website_link` varchar(255) NOT NULL,
  `company_slogan` varchar(255) NOT NULL,
  `linkedln` varchar(255) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `blacklisted` int(2) NOT NULL DEFAULT 0 COMMENT '0 == N0 & 1 == YES',
  `user_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_tbl`
--

INSERT INTO `company_tbl` (`company_id`, `company_name`, `contact`, `address`, `profile_description`, `website_link`, `company_slogan`, `linkedln`, `company_email`, `blacklisted`, `user_id_fk`) VALUES
(3, 'Codegen', '0712016545', '', '', '', '', '', '', 0, 54);

-- --------------------------------------------------------

--
-- Table structure for table `complaint_tbl`
--

CREATE TABLE `complaint_tbl` (
  `complaint_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 == Not Reviewed and 1== Reviewed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id_fk` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complaint_tbl`
--

INSERT INTO `complaint_tbl` (`complaint_id`, `subject`, `description`, `status`, `created_at`, `user_id_fk`) VALUES
(23, 'egaf', 'asdasdasd', 0, '2022-12-17 18:52:57', 53),
(27, 'hello1123', 'asdasd', 0, '2022-12-17 18:55:59', 50);

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
(30, 'QA Engineers'),
(35, 'Web Developers'),
(46, 'Web Developer'),
(47, 'QA Engineersdaf');

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
  `contact` varchar(12) NOT NULL,
  `profile_description` varchar(255) NOT NULL,
  `stream` varchar(10) NOT NULL,
  `school` varchar(255) NOT NULL,
  `cv` varchar(255) NOT NULL,
  `github` varchar(255) NOT NULL,
  `linkedln` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 == Recruited and 0 == Pending',
  `user_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`student_id`, `index_number`, `registration_number`, `profile_name`, `personal_email`, `contact`, `profile_description`, `stream`, `school`, `cv`, `github`, `linkedln`, `status`, `user_id_fk`) VALUES
(24, 20021097, '2020/IS/109', '', '', '', '', '', '', '', '', '', 0, 53);

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `user_id` int(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL DEFAULT 'http://localhost/internarc/public/img/profile-img/profile-icon.svg',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `username`, `email`, `password`, `profile_pic`, `created_at`, `user_role`) VALUES
(49, 'Administrator', 'admin@gmail.com', '$2y$10$UhLpPq0EMKxTP37ar2VCnOxYxxVqIV21ZgcZHA02rta0p.ffvhV5m', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2022-12-17 18:39:47', 'admin'),
(50, 'Ruchira', 'ruchira@gmail.com', '$2y$10$jRD.Pd8WAItX.WeISGw.x.INvIfq6nnp6r8dHOARO4a29i8HDGVfW', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2022-12-17 17:53:28', 'pdc'),
(53, 'P.M.B.R Vimukthi', 'ruchira.bogahawatta@gmail.com', '$2y$10$Z8IU7ajU7ifb49ejCLr/9u7Nl1QuH3FMvGvZNClTIbcZmQeuQoQzK', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2022-12-17 17:59:04', 'student'),
(54, 'Ruchira', 'ruchirxv2@gmail.com', '$2y$10$MvJFOBOIZy9FsbJa1Ie2EuYjf36ung6Jx4bYKq8dxcscVUaYuu1FK', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2022-12-17 18:01:30', 'company'),
(55, 'Geeth', 'geeth@gmail.com', '$2y$10$2W9S8cmu3KJR9ttixhr4z.QgxnAHT3NJI.HQchsfpRvKihot4d8MS', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2022-12-18 04:45:31', 'student'),
(56, 'namadee', 'namadee@gmail.com', '$2y$10$rq2QTJuZQimmg5EB8uDsieoROarIuILqjYP6IueDZBeKh1ZtNkIVm', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2022-12-18 06:13:00', 'company');

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
  MODIFY `advertisement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `company_tbl`
--
ALTER TABLE `company_tbl`
  MODIFY `company_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `complaint_tbl`
--
ALTER TABLE `complaint_tbl`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `interested_area_tbl`
--
ALTER TABLE `interested_area_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobrole_tbl`
--
ALTER TABLE `jobrole_tbl`
  MODIFY `jobrole_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

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
