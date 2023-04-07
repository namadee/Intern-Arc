-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2023 at 07:14 PM
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
(76, 'Developer', 'Minima qui officiis', 'test1\r\ntest2\r\ntest3', '1992-03-17', '2010-01-08', 'remote', '3', 9, 'pending', 4),
(77, 'QA Engineers', 'Quasi nostrum eiusmo', 'test\r\ntest2\r\ntest0', '2001-08-01', '2008-09-09', 'onsite', '4', 5, 'pending', 4),
(78, 'QA Engineers', 'Natus duis harum mag', '', '1978-11-01', '1996-04-15', 'onsite', 'both', 8, 'pending', 4),
(79, 'Web Developer', 'Aliquid voluptatibus', 'Et non voluptate dolEt non voluptate dolsdcilasn', '1978-12-16', '2017-04-01', 'onsite', 'both', 8, 'pending', 4),
(80, 'Developer', 'Sit voluptatum sunt', 'Voluptate ea dolore \r\nQuis eos qui ad volu\r\nQuis', '1990-02-12', '1986-11-15', 'hybrid', '3', 8, 'pending', 4),
(81, 'DevAloper', 'edited', '', '1978-03-15', '2015-01-20', 'onsite', '4', 2, 'pending', 4),
(82, 'Software Engineer', 'second edit', '', '2010-09-26', '2022-12-13', 'remote', '3', 4, 'pending', 4),
(83, 'Web Developer', 'last edited edited', '', '2014-08-18', '1983-09-02', 'onsite', 'both', 3, 'pending', 4),
(84, 'Developer', 'Quos aliqua Est et edit', 'sxnacnsd\r\nscn lkxnc ;\r\ncx dkl ckcx\r\nedited', '1970-05-27', '2013-12-28', 'onsite', '4', 2, 'pending', 4),
(85, 'Developer', 'Quibusdam et at in i', 'requirement 1 \\n requirement 2 \\n', '2007-01-28', '2004-08-06', 'remote', '3', 6, 'pending', 4),
(86, 'DevAloper', 'Delectus culpa qui', 'Sed lorem illo volupsanxkls', '1975-05-04', '1989-03-23', 'onsite', '3', 7, 'pending', 4),
(87, 'QA Engineers', 'Non odit cillum pari', 'Reprehenderit voluptNecessitatibus minus', '1998-04-16', '2010-05-02', 'onsite', 'both', 5, 'pending', 4),
(88, 'QA Engineers', 'Dolorum quod eveniet', 'rashmina\r\nAffada\r\nRavindu', '1986-10-16', '1989-11-28', 'hybrid', '3', 5, 'pending', 4),
(89, 'Web Developer', 'Earum dolores perspi', 'sdhcosz\r\ndcbsdn', '1983-04-26', '2003-06-08', 'hybrid', '3', 1, 'pending', 4);

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
(4, 'Virtusa', '0710212133', 'Colombo', 'dhschdsnda sdkcm;s hasbl', 'https://www.virtusa.com/', '', '', '', 0, 56),
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
-- Table structure for table `experience_tbl`
--

CREATE TABLE `experience_tbl` (
  `experience_id` int(20) NOT NULL,
  `student_id` int(20) NOT NULL,
  `title` varchar(225) NOT NULL,
  `employement_type` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `qualification_tbl`
--

CREATE TABLE `qualification_tbl` (
  `qualification_id` int(20) NOT NULL,
  `student_id` int(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `issued_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `std_interested_area_tbl`
--

CREATE TABLE `std_interested_area_tbl` (
  `id` int(20) NOT NULL,
  `interested_area_id` int(20) NOT NULL,
  `student_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_jobrole_tbl`
--

CREATE TABLE `student_jobrole_tbl` (
  `id` int(20) NOT NULL,
  `jobrole_id` int(20) NOT NULL,
  `student_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_requests_tbl`
--

CREATE TABLE `student_requests_tbl` (
  `student_request_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `advertisement_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'pending',
  `round` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_requests_tbl`
--

INSERT INTO `student_requests_tbl` (`student_request_id`, `student_id`, `advertisement_id`, `status`, `round`) VALUES
(1, 67, 76, 'pending', 0),
(8, 27, 76, 'pending', 0),
(9, 28, 76, 'pending', 0),
(10, 29, 76, 'pending', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_shortlist_tbl`
--

CREATE TABLE `student_shortlist_tbl` (
  `id` int(20) NOT NULL,
  `request_id` int(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `extracurricular` mediumtext NOT NULL,
  `cv` varchar(255) NOT NULL,
  `github` varchar(255) NOT NULL,
  `linkedln` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 == Recruited and 0 == Pending',
  `user_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`student_id`, `index_number`, `registration_number`, `profile_name`, `personal_email`, `contact`, `profile_description`, `stream`, `school`, `extracurricular`, `cv`, `github`, `linkedln`, `status`, `user_id_fk`) VALUES
(27, 705, '749', 'Namadee Kahatapitiya', 'namadee@gmail.com', '', '', '', '', '', '', '', '', 0, 78),
(28, 655, '842', 'Ruchira Bogahawatta', 'ruchira@gmail.com', '', '', '', '', '', '', '', '', 0, 79),
(29, 13, '632', 'Ravindu Viranga', 'ravindu@gmail.com', '', '', '', '', '', '', '', '', 0, 80),
(30, 753, '206', 'Sachintha Bandara', '', '', '', '', '', '', '', '', '', 0, 81),
(31, 45, '420', 'Rashmi Nirasha', '', '', '', '', '', '', '', '', '', 0, 82),
(32, 200, '930', 'Vinod Ramanayaka', '', '', '', '', '', '', '', '', '', 0, 83),
(33, 5554, '5454', 'Kivi Amarakoon', '', '', '', '', '', '', '', '', '', 0, 84),
(67, 4546477, '4546546', 'Geeth Weerasinghe', 'geeth@gmail.com', '', '', '', '', '', '', '', '', 0, 55);

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_role` varchar(255) NOT NULL,
  `verification_code` int(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `username`, `email`, `password`, `profile_pic`, `created_at`, `user_role`, `verification_code`) VALUES
(49, 'administrator', 'admin@gmail.com', '$2y$10$UhLpPq0EMKxTP37ar2VCnOxYxxVqIV21ZgcZHA02rta0p.ffvhV5m', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-02-08 09:28:31', 'admin', 0),
(50, 'Ruchira', 'ruchira@gmail.com', '$2y$10$jRD.Pd8WAItX.WeISGw.x.INvIfq6nnp6r8dHOARO4a29i8HDGVfW', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2022-12-17 17:53:28', 'pdc', 0),
(55, 'Geeth', 'geeth@gmail.com', '$2y$10$2W9S8cmu3KJR9ttixhr4z.QgxnAHT3NJI.HQchsfpRvKihot4d8MS', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2022-12-18 04:45:31', 'student', 0),
(56, 'namadee', 'namadee@gmail.com', '$2y$10$rq2QTJuZQimmg5EB8uDsieoROarIuILqjYP6IueDZBeKh1ZtNkIVm', 'img/profile-img/user56_profile_img12245.jpg', '2023-02-08 05:18:45', 'company', 0),
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
(86, 'ruchira', '99X123@gmail.com', '$2y$10$22F0qypw3rz3kSQOxfLQa.YSr1jDhsXMmCVZQlQgq.N.3eKWibkP.', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-01-31 15:05:34', 'company', 0),
(87, 'Mahinda rajapaksha', 'mahinda123@gmail.com', '12345', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-02-12 15:33:41', 'student', 0);

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
-- Indexes for table `experience_tbl`
--
ALTER TABLE `experience_tbl`
  ADD PRIMARY KEY (`experience_id`),
  ADD KEY `student_id` (`student_id`);

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
-- Indexes for table `qualification_tbl`
--
ALTER TABLE `qualification_tbl`
  ADD PRIMARY KEY (`qualification_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `std_interested_area_tbl`
--
ALTER TABLE `std_interested_area_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `interested_area_id` (`interested_area_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_jobrole_tbl`
--
ALTER TABLE `student_jobrole_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobrole_id` (`jobrole_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_requests_tbl`
--
ALTER TABLE `student_requests_tbl`
  ADD PRIMARY KEY (`student_request_id`),
  ADD KEY `student_requests_tbl_ibfk_1` (`student_id`),
  ADD KEY `advertisement_id` (`advertisement_id`);

--
-- Indexes for table `student_shortlist_tbl`
--
ALTER TABLE `student_shortlist_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_id` (`request_id`);

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
  MODIFY `advertisement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

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
-- AUTO_INCREMENT for table `experience_tbl`
--
ALTER TABLE `experience_tbl`
  MODIFY `experience_id` int(20) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `qualification_tbl`
--
ALTER TABLE `qualification_tbl`
  MODIFY `qualification_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `std_interested_area_tbl`
--
ALTER TABLE `std_interested_area_tbl`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_jobrole_tbl`
--
ALTER TABLE `student_jobrole_tbl`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_requests_tbl`
--
ALTER TABLE `student_requests_tbl`
  MODIFY `student_request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `student_shortlist_tbl`
--
ALTER TABLE `student_shortlist_tbl`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

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
-- Constraints for table `experience_tbl`
--
ALTER TABLE `experience_tbl`
  ADD CONSTRAINT `experience_tbl_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_tbl` (`student_id`);

--
-- Constraints for table `qualification_tbl`
--
ALTER TABLE `qualification_tbl`
  ADD CONSTRAINT `qualification_tbl_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_tbl` (`student_id`);

--
-- Constraints for table `std_interested_area_tbl`
--
ALTER TABLE `std_interested_area_tbl`
  ADD CONSTRAINT `std_interested_area_tbl_ibfk_1` FOREIGN KEY (`interested_area_id`) REFERENCES `interested_area_tbl` (`id`),
  ADD CONSTRAINT `std_interested_area_tbl_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student_tbl` (`student_id`);

--
-- Constraints for table `student_jobrole_tbl`
--
ALTER TABLE `student_jobrole_tbl`
  ADD CONSTRAINT `student_jobrole_tbl_ibfk_1` FOREIGN KEY (`jobrole_id`) REFERENCES `jobrole_tbl` (`jobrole_id`),
  ADD CONSTRAINT `student_jobrole_tbl_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student_tbl` (`student_id`);

--
-- Constraints for table `student_shortlist_tbl`
--
ALTER TABLE `student_shortlist_tbl`
  ADD CONSTRAINT `student_shortlist_tbl_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `student_requests_tbl` (`student_request_id`);

--
-- Constraints for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD CONSTRAINT `student_tbl_ibfk_1` FOREIGN KEY (`user_id_fk`) REFERENCES `user_tbl` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
