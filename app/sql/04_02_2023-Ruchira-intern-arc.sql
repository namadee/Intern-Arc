-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2023 at 07:59 PM
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
(29, 'QA Engineers', 'Repellendus Et aper', 'Beatae unde fuga Eo', '2023-01-19', '2013-09-21', 'remote', '3', 10, 'pending', 4);

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
(4, 'Virtusa', '0710212133', 'Colombo', '', '', '', '', '', 0, 56);

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
(35, 'subject1', 'description for the subject 12345', 0, '2022-12-19 04:58:59', 55),
(36, 'Student', 'hello', 0, '2022-12-19 05:25:52', 55);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`student_id`, `index_number`, `registration_number`, `profile_name`, `personal_email`, `contact`, `profile_description`, `stream`, `school`, `cv`, `github`, `linkedln`, `status`, `user_id_fk`) VALUES
(37, 267, '233', '', '', '', '', '', '', '', '', '', 0, 143),
(38, 824, '492', '', '', '', '', '', '', '', '', '', 0, 144),
(40, 20021455, '2020/is/223', '', '', '', '', '', '', '', '', '', 0, 146),
(41, 225, '434', '', '', '', '', '', '', '', '', '', 0, 147);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `username`, `email`, `password`, `profile_pic`, `created_at`, `user_role`, `verification_code`) VALUES
(49, 'administrator', 'admin@gmail.com', '$2y$10$UhLpPq0EMKxTP37ar2VCnOxYxxVqIV21ZgcZHA02rta0p.ffvhV5m', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2022-12-19 06:56:19', 'admin', 0),
(50, 'Ruchira', 'ruchira@gmail.com', '$2y$10$jRD.Pd8WAItX.WeISGw.x.INvIfq6nnp6r8dHOARO4a29i8HDGVfW', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2022-12-17 17:53:28', 'pdc', 0),
(55, 'Geeth', 'geeth@gmail.com', '$2y$10$2W9S8cmu3KJR9ttixhr4z.QgxnAHT3NJI.HQchsfpRvKihot4d8MS', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2022-12-18 04:45:31', 'student', 0),
(56, 'namadee', 'namadee@gmail.com', '$2y$10$rq2QTJuZQimmg5EB8uDsieoROarIuILqjYP6IueDZBeKh1ZtNkIVm', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2022-12-18 06:13:00', 'company', 0),
(57, 'Ravindu', 'ravinduviranga20@gmail.com', '$2y$10$Byn2XIRHfN54p1ySKvvMYO4EoDbqmwa17NgtVYVZFaE8HcNt3NVf2', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2022-12-19 04:35:10', 'company', 0),
(59, 'James', 'ruchirxv2@gmail.com', '$2y$10$oEdpwSR7Mq4jh7d1juMEOeR3jAW59FTNC1VFewt36/QtPEn.r/UV2', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-01-31 18:51:36', 'company', 0),
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
(139, 'letomaxux', 'fatiq@mailinator.com', '$2y$10$IzJAKJnksM0DdOysEvq5leq032jSfNjoq3aMsTtxH7bIn3Va0tO5C', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-02-03 08:11:39', 'company', 0),
(140, 'hehivefuge', 'cevywacim@mailinator.com', '$2y$10$Q2TPXSCALUYwk4Ly15UqfeiUOSyDvDphIZ24Qbcw/uLiymneo8vvG', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-02-03 08:15:55', 'company', 0),
(141, 'laqonyg', 'zirana@mailinator.com', '$2y$10$h7HrbP2DPACSO8FLkcXI8u992885uYleLowjnpHBg1kPrTMISEnhG', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-02-03 08:21:54', 'company', 0),
(143, 'degyf', 'zewuhi@mailinator.com', '$2y$10$yF5Mg./0rlNKgG6Q5ckV..NOU01AT466wP9LsdiMxdRVeyxihpNFy', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-02-03 08:29:29', 'student', 0),
(144, 'kyfumoku', 'gosimiwu@mailinator.com', '$2y$10$dLIdoSxNWdGmrdDPUYSvd.FrKdtTfrt1vYe6ZBLmO0nnH1oGISdkG', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-02-03 08:29:58', 'student', 0),
(146, 'PMBR Vimukthi', 'ruchira.bogahawatta@gmail.com', '$2y$10$c7Tlr7mLpZdVFu/eCqtsheepf3wQ4DMeJn10n0q8dwFnKH1q3mSe.', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-02-03 08:32:02', 'student', 0),
(147, 'ximoxeke', 'lidokofup@mailinator.com', '$2y$10$/owZlc0bL.L86QWfAltYNuCHgVHIwciW8.N8AOQiEab7bVmy2hLvq', 'http://localhost/internarc/public/img/profile-img/profile-icon.svg', '2023-02-03 08:35:28', 'student', 0);

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
  MODIFY `advertisement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `company_tbl`
--
ALTER TABLE `company_tbl`
  MODIFY `company_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

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
