-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2019 at 09:52 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ev_ue_nr__db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesses`
--

CREATE TABLE `accesses` (
  `id` int(32) NOT NULL,
  `student_id` text NOT NULL,
  `one_access` text NOT NULL,
  `two_access` text NOT NULL,
  `voted` varchar(3) NOT NULL DEFAULT 'no',
  `has_voted_which` text NOT NULL,
  `one_acc_time` text NOT NULL,
  `two_acc_time` text NOT NULL,
  `voted_time` text NOT NULL,
  `added_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `two_acc_gen_by` text NOT NULL,
  `two_acc_generator_priority` text NOT NULL,
  `active` varchar(3) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accesses`
--

INSERT INTO `accesses` (`id`, `student_id`, `one_access`, `two_access`, `voted`, `has_voted_which`, `one_acc_time`, `two_acc_time`, `voted_time`, `added_time`, `two_acc_gen_by`, `two_acc_generator_priority`, `active`) VALUES
(1, '1', '3ed80171b1f4ab825f2038fc203c887c', '5Rym5', 'no', 'none', '2019-10-29 23:53:00', '2019-10-30 01:14:49', '', '2019-10-29 23:53:00', '1', 'sys_3', 'yes'),
(2, '2', '1111112', '3gSib', 'no', 'none', '2019-10-29 23:57:53', '2019-10-30 01:15:26', '', '2019-10-29 23:57:53', '1', 'sys_3', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `campuses`
--

CREATE TABLE `campuses` (
  `id` int(11) NOT NULL,
  `campus_name` text NOT NULL,
  `campus_loc` text NOT NULL,
  `active` varchar(3) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campuses`
--

INSERT INTO `campuses` (`id`, `campus_name`, `campus_loc`, `active`) VALUES
(1, 'Main Campus', 'Fiapre - Sunyani', 'no'),
(2, 'Dormaa Campus', 'Dormaa', 'no'),
(3, 'Kenyasi Campus', 'Kenyasi', 'no'),
(4, 'Dormaa Campus', 'Dormaa', 'no'),
(5, 'Main Campus', 'Fiapre - Sunyani', 'no'),
(6, 'Dormaa Campus', 'Dormaa', 'no'),
(7, 'Main Campus', 'Sunyani, Fiapre', 'no'),
(8, 'Kenyasi Campus', 'Kenyasi', 'no'),
(9, 'Dormaa Campus', 'Dormaa', 'yes'),
(10, 'Main Campus', 'Sunyani, Fiapre', 'yes'),
(11, 'Kenyasi Campus', 'Kenyasi', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `section` text NOT NULL,
  `designation` text NOT NULL,
  `department_if` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `login_pass` text NOT NULL,
  `reset_pass` text DEFAULT NULL,
  `vote_of_tanks` text NOT NULL,
  `active` varchar(3) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `student_id`, `image`, `section`, `designation`, `department_if`, `date_added`, `login_pass`, `reset_pass`, `vote_of_tanks`, `active`) VALUES
(1, 1, '', 'SRC', 'President', 'ELEESA', '2019-11-01 04:44:20', '00e3a488223860358e75a9ab24bc6596', 'b72bF5', '', 'no'),
(2, 2, '', 'Department', 'President', 'ELEESA', '2019-11-01 04:45:48', '10f8bcbe9c1bc7b2af63435371baffc1', 'a4oRbV', '', 'no'),
(3, 1, '', 'Department', 'President', '16', '2019-11-01 23:51:43', 'c8714f903e0b24274242b2d96617a5ab', 'Uf87RC', '', 'no'),
(4, 2, '', 'Department', 'Vice President', '14', '2019-11-01 23:53:35', '8298f40305751d2d2b40c2ad6b31ed74', 'ifizid', '', 'no'),
(5, 3, 'https://regmedia.co.uk/2019/10/03/black_person_facial_recognition.jpg?x=442&y=293&crop=1https://www.google.com/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&ved=2ahUKEwiax6-9ycrlAhWI2hQKHZW4BHMQjRx6BAgBEAQ&url=https%3A%2F%2Fbespokeunit.com%2Fface-shapes%2Fsquare%2F&psig=AOvVaw1gxksI-KxGi3H6nRqA0xNH&ust=1572751344502292', 'SRC', 'President', '', '2019-11-02 02:17:17', 'c42b107e992594fd36cd65ef38f52b3d', '1Vwe7d', '', 'no'),
(6, 4, 'https://2x1dks3q6aoj44bz1r1tr92f-wpengine.netdna-ssl.com/wp-content/uploads/2017/05/Square-face-shape-bespke-unit-Bordered-700x700.png', 'SRC', 'Secretary', '', '2019-11-02 02:17:54', '6f70d89b5901090a90d731bfb738b3a7', 'YaIKDC', '', 'no'),
(7, 6, 'https://www.sunglasshut.com/wcsstore/SGH/experiences/US/evergreen/face-shape/images/face_square_female_static.gif?01AD=3JRX3JaZOJBcPPIpY5lCiLwGExKuNvGTXiy007i8RbH1AN8ZRGDV0YA&01RI=8E87C241B4B7091&01NA=', 'SRC', 'President', '', '2019-11-02 02:18:07', '0e2765823b4cdaff2c2047bb499479e1', 'C7AeSj', '', 'no'),
(8, 5, '', 'SRC', 'Secretary', '', '2019-11-02 02:18:24', '5e514fa8f5411b1b78fa89435291c2a5', '7KoJwP', '', 'no'),
(9, 1, 'https://pbs.twimg.com/profile_images/998555245826355200/PkFwgyGU.jpg', 'SRC', 'Secretary', '', '2019-11-02 03:28:37', '7281bfe89a1355bc41b19cb446bd8a58', 'JeRdVd', '', 'no'),
(10, 1, 'https://pbs.twimg.com/profile_images/998555245826355200/PkFwgyGU.jpg', 'SRC', 'Financial Secretary', '', '2019-11-02 03:40:08', '9247bea5f5debe2d2d70f5adfd792545', '58Eiu0', '', 'no'),
(11, 2, '', 'Department', 'President', '13', '2019-11-03 16:46:29', 'e18433321881fa26fc6db0b15bd94d58', 'UoFhRk', '', 'yes'),
(12, 1, '', 'Department', 'President', '13', '2019-11-03 16:59:19', '9deaa0a72e2d0e0f0d22143a30531d50', '0TPYPK', '', 'yes'),
(13, 3, 'https://beardoholic.com/wp-content/uploads/2016/09/1.png', 'Department', 'Secretary', '13', '2019-11-03 16:59:37', '6bd35256ee9adb6e37483002be25bafe', 'uihzw3', '', 'yes'),
(14, 4, '', 'Department', 'Secretary', '13', '2019-11-03 17:00:51', '1586d1025ca9eb0ac8938587c900ad20', 'Onzs9o', '', 'yes'),
(15, 5, '', 'Department', 'Secretary', '13', '2019-11-03 17:01:04', '805fa2f7c85ff7d2805ca9c09d657cbc', 'T9r1P2', '', 'yes'),
(16, 6, '', 'Department', 'Financial Secretary', '13', '2019-11-03 17:01:19', '54a9b785c299c2fae7a022c74a885195', 'URR9Js', '', 'yes'),
(17, 7, '', 'Department', 'General Organizer', '13', '2019-11-03 17:01:36', '77f80245d3ea2034fbc2f5a9316f2116', 'U4Sj6z', '', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `contestants`
--

CREATE TABLE `contestants` (
  `id` int(11) NOT NULL,
  `cand_id` text NOT NULL,
  `previous_percentages` text NOT NULL,
  `current_percentage` text NOT NULL,
  `votes` int(11) NOT NULL,
  `active` varchar(3) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contestants`
--

INSERT INTO `contestants` (`id`, `cand_id`, `previous_percentages`, `current_percentage`, `votes`, `active`) VALUES
(1, '3', '0', '0', 0, 'yes'),
(2, '4', '0', '0', 0, 'yes'),
(3, '5', '0', '0', 10, 'yes'),
(4, '6', '0', '0', 10, 'yes'),
(5, '7', '0', '0', 2, 'yes'),
(6, '8', '0', '0', 2, 'yes'),
(7, '10', '0', '0', 11, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `campus` text NOT NULL,
  `active` varchar(3) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `campus`, `active`) VALUES
(1, 'ELEESA', '4', 'no'),
(2, 'ELEESA', '4', 'no'),
(7, 'ELEESA', '6', 'no'),
(8, 'ELEESA', '6', 'no'),
(9, 'ELEESA', '7', 'no'),
(10, 'AGRIC', '6', 'no'),
(11, 'ELEESA', '8', 'no'),
(12, 'ELEESA', '6', 'no'),
(13, 'ELECTRICAL AND ELECTRONIC ENGINEERING', '9', 'yes'),
(14, 'AGRICUTURAL ENGINEERING', '11', 'yes'),
(15, 'ELECTRICAL AND ELECTRONIC ENGINEERING', '10', 'yes'),
(16, 'PETROL ENG', '11', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `campus` text NOT NULL,
  `department` text NOT NULL,
  `active` varchar(3) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `name`, `campus`, `department`, `active`) VALUES
(1, 'AGRICULTURE', '3', '10', 'no'),
(2, 'CE', '2', '8', 'no'),
(3, 'AGRICULTURE', '2', '10', 'no'),
(4, 'Elect', '2', '9', 'no'),
(5, 'CE', '3', '9', 'no'),
(6, 'sss', '2', '9', 'no'),
(7, 'Computer Engineering', '11', '16', 'no'),
(8, 'Computer Engineering', '9', '14', 'no'),
(9, 'Computer Engineering', '10', '15', 'no'),
(10, 'Computer Engineering', '10', '15', 'yes'),
(11, 'Electrical Engineering', '10', '15', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `id` int(32) NOT NULL,
  `name` text NOT NULL,
  `staff_id` text NOT NULL,
  `priority` text NOT NULL,
  `access_code` text NOT NULL,
  `reset_code` text NOT NULL,
  `num_gen_codes` int(11) NOT NULL DEFAULT 0,
  `num_added_stdnts` int(11) NOT NULL DEFAULT 0,
  `added_by` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `active` varchar(3) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`id`, `name`, `staff_id`, `priority`, `access_code`, `reset_code`, `num_gen_codes`, `num_added_stdnts`, `added_by`, `date_added`, `active`) VALUES
(1, 'Nana Dedrick', 'V_UE0001', 'role_3', 'e22bb20655021649274f93550ff69d0a', 'AR76rw', 0, 5, '2', '2019-10-29 11:20:35', 'yes'),
(2, 'Samuel Annin', 'V_UE0002', 'role_2', '4fd9adc503817b2df63caed844402440', 'mB7kn8', 0, 0, '2', '2019-10-29 12:27:45', 'yes'),
(3, 'Prince Akomeah Taky', 'V_UE0003', 'role_1', '284b16ff3d4a7bbc7ca813115158e653', '7mC57S', 0, 0, '2', '2019-10-29 12:28:05', 'yes'),
(4, 'Samuel Annin Yeboah', 'V_UE0004', 'role_2', '568ae2a704fb0043a3af3cca10f4c8c1', 'KrKrzu', 0, 0, '1', '2019-10-29 18:01:51', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `surname` text NOT NULL,
  `lastname` text NOT NULL,
  `image` text NOT NULL,
  `index_number` text NOT NULL,
  `email` text NOT NULL,
  `program` text NOT NULL,
  `department` text NOT NULL,
  `current_level` text NOT NULL,
  `registered_level` text NOT NULL,
  `campus` text NOT NULL,
  `student_type` text NOT NULL,
  `registered_by` text NOT NULL,
  `registerer_power` varchar(6) NOT NULL,
  `date_registered` datetime NOT NULL DEFAULT current_timestamp(),
  `active` varchar(3) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `firstname`, `surname`, `lastname`, `image`, `index_number`, `email`, `program`, `department`, `current_level`, `registered_level`, `campus`, `student_type`, `registered_by`, `registerer_power`, `date_registered`, `active`) VALUES
(1, 'Samuel', 'Annin', 'Yeboah', '', 'UEB1101718', 'saytoonz05@gmail.com', '10', '15', 'Level 200', 'Level 200', '10', 'Regular', ' 2', 'sys_4', '2019-10-29 05:13:59', 'yes'),
(2, 'Simi', 'Samson', '', '', 'UEB1102718', 'email@email.email', '11', '15', 'Level 200', 'Level 200', '10', 'Sanwitch', ' 3', 'sys_1', '2019-10-29 17:20:51', 'yes'),
(3, 'Solomon', 'Kram', 'Ayeh Dimah', '', 'UEB1100918', 'ss@say.com', '10', '15', 'Level 200', 'Level 200', '10', 'Regular', ' 1', 'sys_3', '2019-10-30 01:22:11', 'yes'),
(4, 'Nana', 'Ama', 'Kwame', '', 'UEB1100118', 'ss@say.co', '10', '15', 'Level 200', 'Level 200', '10', 'Regular', ' 1', 'sys_3', '2019-11-02 02:13:47', 'yes'),
(5, 'Nana', 'Kram', 'Ayeh Dimah', '', 'UEB1101018', 'ss@say.cow', '10', '15', 'Level 200', 'Level 200', '10', 'Regular', ' 1', 'sys_3', '2019-11-02 02:14:16', 'yes'),
(6, 'Nana', 'Ama', 'Ayeh Dimah', '', 'UEB1101218', 'ss@say.col', '10', '15', 'Level 200', 'Level 200', '10', 'Regular', ' 1', 'sys_3', '2019-11-02 02:14:37', 'yes'),
(7, 'Benjanmin', 'Osei', 'Agyei', '', 'UEB1103718', 'ss@sasy.cow', '11', '15', 'Level 300', 'Level 300', '10', 'Regular', ' 1', 'sys_3', '2019-11-03 02:45:07', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `student_type`
--

CREATE TABLE `student_type` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `campus` int(11) NOT NULL,
  `active` varchar(3) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_type`
--

INSERT INTO `student_type` (`id`, `name`, `campus`, `active`) VALUES
(1, 'hello', 1, 'no'),
(2, 'hi', 2, 'no'),
(3, 'hy', 4, 'no'),
(4, 'hi', 3, 'no'),
(5, 'hi', 4, 'no'),
(6, 'hit', 3, 'no'),
(7, 'hit', 6, 'no'),
(8, 'halle', 6, 'no'),
(9, 'Regular', 0, 'no'),
(10, 'Sanwitch', 0, 'no'),
(11, 'Regular', 0, 'no'),
(12, 'Regular', 0, 'no'),
(13, 'Regular', 0, 'no'),
(14, 'Regular', 0, 'no'),
(15, 'Regular', 0, 'no'),
(16, 'Regular', 0, 'no'),
(17, 'Regular', 0, 'yes'),
(18, 'Sanwitch', 0, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `system_admin`
--

CREATE TABLE `system_admin` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `s_key` text NOT NULL COMMENT 'secret key generated by us',
  `username` text NOT NULL,
  `password` text NOT NULL,
  `active` varchar(3) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_admin`
--

INSERT INTO `system_admin` (`id`, `name`, `s_key`, `username`, `password`, `active`) VALUES
(1, 'Samuel Annin Yeboah', 'd0b6bee142', 'sayt', '5c7b03479ac858e30ed797d084f4e631', 'yes'),
(2, 'Nana Yaw Dedrick', '111111', 'say', '5c7b03479ac858e30ed797d084f4e631', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `total_voters`
--

CREATE TABLE `total_voters` (
  `id` int(11) NOT NULL,
  `section` text NOT NULL,
  `designation` text NOT NULL,
  `total_votes` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `active` varchar(3) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `total_voters`
--

INSERT INTO `total_voters` (`id`, `section`, `designation`, `total_votes`, `date_added`, `active`) VALUES
(1, 'SRC', 'President', 7, '2019-11-03 00:16:31', 'yes'),
(2, 'SRC', 'Secretary', 7, '2019-11-03 00:16:31', 'yes'),
(3, 'SRC', 'Financial Secretary', 6, '2019-11-03 00:16:31', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `index_number` text NOT NULL,
  `src_prez_gs_fs` text NOT NULL,
  `departmental_prez_gs_fs_org_pro_mp` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `active` varchar(3) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `index_number`, `src_prez_gs_fs`, `departmental_prez_gs_fs_org_pro_mp`, `date_added`, `active`) VALUES
(10, 'UEB1101718', 'novote,novote,novote', '', '2019-11-03 00:41:01', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `who_can_login_now`
--

CREATE TABLE `who_can_login_now` (
  `id` int(11) NOT NULL,
  `who` text NOT NULL,
  `can_logine` varchar(3) NOT NULL DEFAULT 'no',
  `active` varchar(3) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `who_can_login_now`
--

INSERT INTO `who_can_login_now` (`id`, `who`, `can_logine`, `active`) VALUES
(1, 'admin', 'yes', 'yes'),
(2, 'staff', 'yes', 'yes'),
(3, 'student', 'yes', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesses`
--
ALTER TABLE `accesses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campuses`
--
ALTER TABLE `campuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contestants`
--
ALTER TABLE `contestants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_type`
--
ALTER TABLE `student_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_admin`
--
ALTER TABLE `system_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `total_voters`
--
ALTER TABLE `total_voters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `who_can_login_now`
--
ALTER TABLE `who_can_login_now`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesses`
--
ALTER TABLE `accesses`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `campuses`
--
ALTER TABLE `campuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `contestants`
--
ALTER TABLE `contestants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student_type`
--
ALTER TABLE `student_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `system_admin`
--
ALTER TABLE `system_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `total_voters`
--
ALTER TABLE `total_voters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `who_can_login_now`
--
ALTER TABLE `who_can_login_now`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
