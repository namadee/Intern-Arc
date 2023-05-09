-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2023 at 09:15 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advertisement_tbl`
--

INSERT INTO `advertisement_tbl` (`advertisement_id`, `position`, `job_description`, `requirements`, `start_date`, `end_date`, `working_mode`, `applicable_year`, `intern_count`, `status`, `company_id_fk`) VALUES
(29, 'QA Engineers', 'Repellendus Et aper', 'Beatae unde fuga Eo', '2023-01-19', '2013-09-21', 'remote', '3', 10, 'pending', 4),
(33, 'Web Developer', 'dndsknc;dfmv', 'dcdkn f;d f', '2023-02-10', '2024-01-01', 'remote', '3', 10, 'pending', 4),
(34, 'QA Engineers', 'dnan;ome', 'nfksdn ;aM dnciean;w', '2023-02-10', '2023-02-28', 'remote', '4', 2, 'pending', 4),
(35, 'Software Engineer', 'beoidnwqa; wehndiwqnd', 'nfcenca;oepw asdpajsoeq', '2023-02-02', '2024-10-02', 'onsite', 'both', 9, 'pending', 4),
(36, 'Software Engineer', 'ncd;elsaf wndwmdwq', 'nclksdnc cbkjzsbdca', '2023-02-27', '2025-06-19', 'remote', '4', 2, 'pending', 4),
(37, 'QA Engineers', 'wed', 'wfcAE', '2023-02-02', '2023-02-28', 'remote', '4', 2, 'pending', 4),
(38, 'QA Engineers', 'dfce', 'fce', '2023-02-02', '2023-02-28', 'remote', '3', 5, 'pending', 4),
(39, 'QA Engineers', 'sadcas', 'dsacsdaaaaaaaaaaaaaaaaa', '2023-02-10', '2023-02-28', 'remote', '3', 5, 'pending', 4),
(40, 'QA Engineers', 'dxqe', 'ewqe', '2023-02-01', '2023-02-02', 'remote', '3', 6, 'pending', 4),
(41, 'Web Developer', 'dxcdc', 'sdcsc', '2023-02-09', '2023-02-28', 'remote', 'both', 6, 'pending', 4);

-- --------------------------------------------------------

--
-- Table structure for table `company_tbl`
--

CREATE TABLE `company_tbl` (
  `company_id` int(20) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `company_description` varchar(255) NOT NULL,
  `website_link` varchar(255) NOT NULL,
  `company_slogan` varchar(255) NOT NULL,
  `linkedln` varchar(255) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `blacklisted` int(2) NOT NULL DEFAULT 0 COMMENT '0 == N0 & 1 == YES',
  `user_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_tbl`
--

INSERT INTO `company_tbl` (`company_id`, `company_name`, `contact`, `company_address`, `company_description`, `website_link`, `company_slogan`, `linkedln`, `company_email`, `blacklisted`, `user_id_fk`) VALUES
(4, 'Virtusa', '0710212133', 'Colombo', 'dhschdsnda sdkcm;s hasbl', 'https://www.virtusa.com/', 'SLOGAN', '', '', 0, 56),
(16, 'Pena and Molina LLC', '0702685520', '', '', '', '', '', '', 0, 75),
(17, '99X', '0987654321', '', '', '', '', '', '', 0, 85),
(18, '99X', '0987654321', '', '', '', '', '', '', 0, 86);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaint_tbl`
--

INSERT INTO `complaint_tbl` (`complaint_id`, `subject`, `description`, `status`, `created_at`, `user_id_fk`) VALUES
(35, 'subject1', 'description for the subject 12345', 0, '2022-12-19 04:58:59', 55),
(36, 'Student', 'hello', 0, '2022-12-19 05:25:52', 55);

-- --------------------------------------------------------

--
-- Table structure for table `interested_area_tbl`
--

CREATE TABLE `interested_area_tbl` (
  `id` int(11) NOT NULL,
  `area_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobrole_tbl`
--

CREATE TABLE `jobrole_tbl` (
  `jobrole_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobrole_tbl`
--

INSERT INTO `jobrole_tbl` (`jobrole_id`, `name`) VALUES
(30, 'QA Engineers'),
(46, 'Web Developer'),
(52, 'Software Engineer'),
(56, 'Developer'),
(57, 'DevAloper');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`student_id`, `index_number`, `registration_number`, `profile_name`, `personal_email`, `contact`, `profile_description`, `stream`, `school`, `cv`, `github`, `linkedln`, `status`, `user_id_fk`) VALUES
(27, 705, '749', '', '', '', '', '', '', '', '', '', 0, 78),
(28, 655, '842', '', '', '', '', '', '', '', '', '', 0, 79),
(29, 13, '632', '', '', '', '', '', '', '', '', '', 0, 80),
(30, 753, '206', '', '', '', '', '', '', '', '', '', 0, 81),
(31, 45, '420', '', '', '', '', '', '', '', '', '', 0, 82),
(32, 200, '930', '', '', '', '', '', '', '', '', '', 0, 83),
(33, 5554, '5454', '', '', '', '', '', '', '', '', '', 0, 84);

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
  `user_role` varchar(255) NOT NULL,
  `verification_code` int(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `username`, `email`, `password`, `profile_pic`, `created_at`, `user_role`, `verification_code`) VALUES
(49, 'administrator', 'admin@gmail.com', '$2y$10$UhLpPq0EMKxTP37ar2VCnOxYxxVqIV21ZgcZHA02rta0p.ffvhV5m', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2022-12-19 06:56:19', 'admin', 0),
(50, 'Ruchira', 'ruchira@gmail.com', '$2y$10$jRD.Pd8WAItX.WeISGw.x.INvIfq6nnp6r8dHOARO4a29i8HDGVfW', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2022-12-17 17:53:28', 'pdc', 0),
(55, 'Geeth', 'geeth@gmail.com', '$2y$10$2W9S8cmu3KJR9ttixhr4z.QgxnAHT3NJI.HQchsfpRvKihot4d8MS', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2022-12-18 04:45:31', 'student', 0),
(56, 'namadee', 'namadee@gmail.com', '$2y$10$rq2QTJuZQimmg5EB8uDsieoROarIuILqjYP6IueDZBeKh1ZtNkIVm', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2022-12-18 06:13:00', 'company', 0),
(57, 'Ravindu', 'ravinduviranga20@gmail.com', '$2y$10$Byn2XIRHfN54p1ySKvvMYO4EoDbqmwa17NgtVYVZFaE8HcNt3NVf2', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2022-12-19 04:35:10', 'company', 0),
(59, 'James', 'ruchirxv2@gmail.com', '$2y$10$wgFr7W5mvbCmKecSZYwOU.fggpdIwDWn8oWHK4qpCesRpNFM3SGLG', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-01-31 14:55:20', 'company', 0),
(60, 'Ruchira', 'ruchira.bogahawatta@gmail.com', '$2y$10$k.X1rH1TqjcXMjBHyZT49OSmAXJ8vgl3uTzNGA2XrOf09ir6ej4dq', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-01-28 16:30:55', 'company', 0),
(69, 'pipidiru', 'helloRuchira@gmail.com', '$2y$10$ax5HNTdYxOkd16vddmcHYe7ZXS1JsGV.8JKBlxRjw6U4gMRZVrwcm', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-01-28 19:21:36', 'company', 0),
(70, 'segeroxyko', 'sisuza@mailinator.com', '$2y$10$PtVTkcjX36/Cyz/Svu0fVuzE4XsJn9p4Qa797WrWrBjC0rv7uinvK', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-01-28 19:23:33', 'company', 0),
(74, 'newub', 'janefojy@mailinator.com', '$2y$10$5c3mCQ236241b/WonJHrNO4LRoqWqIXU0unBbjdD9tFLCzWc4rD4i', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-01-28 19:24:48', 'company', 0),
(75, 'bydebadyv', 'siqerynomo@mailinator.com', '$2y$10$YzUilzZNBRsdIDOiTsnHO.4kpfwqElU6AdE8MbhLoiRBZZAWF6N3a', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-01-28 19:26:01', 'company', 0),
(76, 'jevohev', 'cekoxofyzu@mailinator.com', '$2y$10$GO2k7c1I6vHZSxY0Z0MJie9rYmVKPJ9eUWJkaXyJhC8NySJQmTVye', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-01-28 20:13:32', 'student', 0),
(77, 'mocynici', 'qojikavome@mailinator.com', '$2y$10$HdAxhHwhGmkyaJNc6S8nNeLC4LzJThOwkQBwdDsjJombKcHFBOG3u', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-01-28 20:13:41', 'student', 0),
(78, 'tisyqyraji', 'vyxah@mailinator.com', '$2y$10$MDpnDN/d8Gwwd.wqCN6NfOOXa6Jce1.igLHTgjYyq5RYhYImzQXAq', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-01-28 20:13:58', 'student', 0),
(79, 'kacub', 'jybiky@mailinator.com', '$2y$10$oUxVfuOLeNQb7k2w.QzDber6IcDW7VlGiYJu.EZkzu0Hgt4gyGxDS', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-01-28 20:39:09', 'student', 0),
(80, 'wowidisygo', 'ruchirxv2@gmail.comasddsfsdf', '$2y$10$1l4qPRBjRXog9hDie3qsNePGEFUflYU/5JyPciTTSv10Kurv5nGbC', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-01-28 20:39:28', 'student', 0),
(81, 'bylicak', 'wowynul@mailinator.com', '$2y$10$DNyU3p.aznFkK5jSZY7ikeXNUVstHd8DZ3h8C9sJWV2fXuVFGN2j6', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-01-28 20:40:52', 'student', 0),
(82, 'bohygywyso', 'pesymow@mailinator.com', '$2y$10$H/4Lb.xeAmhKuKzT7N94lOwltxC6fEpUonlkuV.w3XcQMudFf8QqS', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-01-28 20:43:02', 'student', 0),
(83, 'vygeralej', 'kuny@mailinator.com', '$2y$10$uauJaeHE5Xi1g6oUOmafVOueou.my7TwF2.a3gkRAIf5CiP3X9u4G', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-01-28 20:50:11', 'student', 0),
(84, 'qynor', 'ruchirxv2@gmail.comasdasdas', '$2y$10$cxGXllF36cC7h9AW8P8TAuSf4a5xPQfaMDIAD8ELkQjOml7rgkPre', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-01-28 20:51:48', 'student', 0),
(85, 'ruchira', '99X@gmail.com', '$2y$10$EJhd74HXSmPZIdp.bUgKd.h8XgHa8n7TJSU/TZiY6JNzX0yplRDwy', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-01-31 15:05:22', 'company', 0),
(86, 'ruchira', '99X123@gmail.com', '$2y$10$22F0qypw3rz3kSQOxfLQa.YSr1jDhsXMmCVZQlQgq.N.3eKWibkP.', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-01-31 15:05:34', 'company', 0);

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
  MODIFY `advertisement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `company_tbl`
--
ALTER TABLE `company_tbl`
  MODIFY `company_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `complaint_tbl`
--
ALTER TABLE `complaint_tbl`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `interested_area_tbl`
--
ALTER TABLE `interested_area_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobrole_tbl`
--
ALTER TABLE `jobrole_tbl`
  MODIFY `jobrole_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

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
