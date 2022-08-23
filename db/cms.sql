-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2022 at 08:55 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_fine`
--

CREATE TABLE `assign_fine` (
  `assignid` int(200) NOT NULL,
  `fine_id` int(200) DEFAULT NULL,
  `assign_stu_id` int(200) DEFAULT NULL,
  `fine_date` varchar(200) DEFAULT NULL,
  `assign_status` int(200) DEFAULT NULL,
  `collected_fine` int(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attandance`
--

CREATE TABLE `attandance` (
  `id` int(200) NOT NULL,
  `student_id` int(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `attandance_status` varchar(200) NOT NULL,
  `time_to_show` datetime NOT NULL,
  `create_on` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

CREATE TABLE `balance` (
  `balid` int(200) NOT NULL,
  `stu_id` int(200) DEFAULT NULL,
  `create_on` varchar(200) DEFAULT NULL,
  `bal_disc` text DEFAULT NULL,
  `stu_balance` int(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `classid` int(100) NOT NULL,
  `class_name` varchar(100) NOT NULL,
  `code_name` varchar(200) DEFAULT NULL,
  `class_fee` int(200) NOT NULL,
  `teacher_id` int(100) NOT NULL,
  `class_status` varchar(200) NOT NULL,
  `running_status` varchar(200) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`classid`, `class_name`, `code_name`, `class_fee`, `teacher_id`, `class_status`, `running_status`, `Date`) VALUES
(1, '2nd Year (F.A)', '2nd Year (F.A)', 0, 3, 'Semester', 'Active', '2022-03-26 00:28:06'),
(2, '2nd Year (ICS)', '2nd Year (ICS)', 0, 2, 'Semester', 'Active', '2022-03-26 00:28:48'),
(3, '2nd Year (Eng)', '2nd Year (Eng)', 0, 2, 'Semester', 'Active', '2022-03-26 00:29:26'),
(4, '2nd Year (Med)', '2nd Year (Med)', 0, 1, 'Semester', 'Active', '2022-03-26 00:30:17'),
(5, '1st Year (Ayesha)', '1st Year (Ayesha)', 0, 13, 'Semester', 'Active', '2022-03-26 00:31:27'),
(6, '1st Year (Khadija)', '1st Year (Khadija)', 0, 2, 'Semester', 'Active', '2022-03-26 00:33:14'),
(7, '1st Year (Javaria)', '1st Year (Javaria)', 0, 2, 'Semester', 'Active', '2022-03-26 00:34:16'),
(8, '1st Year (zainab)', '1st Year (zainab)', 0, 1, 'Semester', 'Active', '2022-03-26 00:34:42'),
(9, '1st Year (Haleema)', '1st Year (Haleema)', 0, 1, 'Semester', 'Active', '2022-03-26 00:35:23'),
(10, '1st Year (Safia)', '1st Year (Safia)', 0, 1, 'Semester', 'Active', '2022-03-26 00:36:01'),
(11, 'Matric Girls', 'Matric Girls', 0, 1, 'Monthly', 'Active', '2022-03-26 00:36:22');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `designation_id` int(100) NOT NULL,
  `designation_title` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`designation_id`, `designation_title`) VALUES
(3, 'Rank1'),
(4, 'Rank2'),
(5, 'rank3');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `discid` int(200) NOT NULL,
  `disc_name` varchar(200) DEFAULT NULL,
  `disc_per` int(200) DEFAULT NULL,
  `disc_desc` text DEFAULT NULL,
  `disc_status` int(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`discid`, `disc_name`, `disc_per`, `disc_desc`, `disc_status`) VALUES
(1, 'No Discount', 0, 'zero discount', 1);

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `examid` int(100) NOT NULL,
  `exam_name` varchar(100) NOT NULL,
  `exam_date` date NOT NULL,
  `exam_comment` text NOT NULL,
  `exam_status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fee_assign`
--

CREATE TABLE `fee_assign` (
  `feeid` int(200) NOT NULL,
  `ft_id` int(200) DEFAULT NULL,
  `class_id` int(200) DEFAULT NULL,
  `stu_id` int(200) DEFAULT NULL,
  `disc` int(200) DEFAULT NULL,
  `balance` int(200) DEFAULT NULL,
  `fee_status` varchar(200) DEFAULT NULL,
  `submit_on` varchar(200) DEFAULT NULL,
  `issue_date` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fee_assign`
--

INSERT INTO `fee_assign` (`feeid`, `ft_id`, `class_id`, `stu_id`, `disc`, `balance`, `fee_status`, `submit_on`, `issue_date`) VALUES
(1, 1, 2, 200073, NULL, 0, 'Not Paid', NULL, '10-04-2022'),
(2, 1, 2, 200074, NULL, 0, 'Not Paid', NULL, '10-04-2022'),
(3, 1, 2, 200075, NULL, 0, 'Not Paid', NULL, '10-04-2022'),
(4, 1, 2, 200076, NULL, 0, 'Not Paid', NULL, '10-04-2022'),
(5, 1, 2, 200077, NULL, 0, 'Not Paid', NULL, '10-04-2022'),
(6, 1, 2, 200078, NULL, 0, 'Not Paid', NULL, '10-04-2022'),
(7, 1, 2, 200079, NULL, 0, 'Not Paid', NULL, '10-04-2022'),
(8, 1, 2, 200080, NULL, 0, 'Not Paid', NULL, '10-04-2022');

-- --------------------------------------------------------

--
-- Table structure for table `fee_type`
--

CREATE TABLE `fee_type` (
  `ftid` int(200) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `v_title` varchar(200) DEFAULT NULL,
  `due_date` varchar(200) DEFAULT NULL,
  `fine` int(200) DEFAULT NULL,
  `install_id` int(200) DEFAULT NULL,
  `ft_createon` text DEFAULT NULL,
  `ft_kind` varchar(200) DEFAULT NULL,
  `def_fee` int(200) DEFAULT NULL,
  `running_status` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fee_type`
--

INSERT INTO `fee_type` (`ftid`, `title`, `v_title`, `due_date`, `fine`, `install_id`, `ft_createon`, `ft_kind`, `def_fee`, `running_status`) VALUES
(1, 'testing fee', 'title', '2022-01-01', 100, 1, '10-04-2022', '0', 10000, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `fines`
--

CREATE TABLE `fines` (
  `fineid` int(200) NOT NULL,
  `fine_name` varchar(200) DEFAULT NULL,
  `fine_amount` int(200) DEFAULT NULL,
  `fine_desc` text DEFAULT NULL,
  `fine_status` int(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guest_student`
--

CREATE TABLE `guest_student` (
  `id` int(255) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `father_business` varchar(255) NOT NULL,
  `previous_institute` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `source_info` varchar(255) NOT NULL,
  `Add_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `installments`
--

CREATE TABLE `installments` (
  `instaid` int(200) NOT NULL,
  `insta_name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `installments`
--

INSERT INTO `installments` (`instaid`, `insta_name`) VALUES
(1, '12 installments (per month System)');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `loginid` int(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_pass` varchar(200) NOT NULL,
  `create_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`loginid`, `type`, `user_name`, `user_pass`, `create_on`) VALUES
(1, 'Principal/Director', 'principal', '@pri$tmpcg', '2019-03-10 13:37:47'),
(2, 'General Manager', 'general', 'vcg@gen', '2019-03-10 13:37:47'),
(3, 'Finance Manager', 'finance', '@fen', '2019-03-10 13:38:21');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `markid` int(200) NOT NULL,
  `student_id` int(200) NOT NULL,
  `class_id` int(200) NOT NULL,
  `subject_id` int(200) NOT NULL,
  `exam_id` int(200) NOT NULL,
  `mark_obt` float NOT NULL,
  `total_mark` int(200) NOT NULL,
  `comment` text NOT NULL,
  `msg_status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `misc_discounts`
--

CREATE TABLE `misc_discounts` (
  `miscdiscid` int(200) NOT NULL,
  `misc_disc_name` varchar(200) DEFAULT NULL,
  `misc_disc_per` int(200) DEFAULT NULL,
  `misc_disc_desc` text DEFAULT NULL,
  `misc_disc_status` int(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `misc_discounts`
--

INSERT INTO `misc_discounts` (`miscdiscid`, `misc_disc_name`, `misc_disc_per`, `misc_disc_desc`, `misc_disc_status`) VALUES
(1, 'No discount', 0, 'zero discount', 1);

-- --------------------------------------------------------

--
-- Table structure for table `raw_data`
--

CREATE TABLE `raw_data` (
  `id` int(11) NOT NULL,
  `machineNo` varchar(100) DEFAULT NULL,
  `enrollmentNo` varchar(100) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `entryDate` varchar(100) DEFAULT NULL,
  `entryTime` varchar(100) DEFAULT NULL,
  `entryDateTime` varchar(200) DEFAULT NULL,
  `createdDateTime` datetime DEFAULT NULL,
  `att_status` int(200) DEFAULT NULL,
  `att_msg_status` int(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `raw_data`
--

INSERT INTO `raw_data` (`id`, `machineNo`, `enrollmentNo`, `name`, `entryDate`, `entryTime`, `entryDateTime`, `createdDateTime`, `att_status`, `att_msg_status`) VALUES
(3, '0', '200000', NULL, '2022-04-04', '09:04:00', '2022-04-04 09:08:00', '2022-04-04 09:08:00', 1, 1),
(4, '0', '200000', NULL, '2022-04-10', '11:04:54', '2022-04-10 11:00:54', '2022-04-10 11:00:54', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `raw_string`
--

CREATE TABLE `raw_string` (
  `mystring` text NOT NULL,
  `id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `raw_string`
--

INSERT INTO `raw_string` (`mystring`, `id`) VALUES
('1|200000||2022-3-26|11:25:6|2022-3-26 11:25:6', 1),
('1|200000||2022-3-26|11:33:3|2022-3-26 11:33:3', 2),
('=1001|256|Atif Khan|2022-02-01|09:20:23|2022-02-01 09:20:23', 3),
('1|200000||2022-3-26|11:33:48|2022-3-26 11:33:48', 4),
('=1001|256|Atif Khan|2022-02-01|09:20:23|2022-02-01 09:20:23', 5),
('1|200000||2022-3-26|11:52:57|2022-3-26 11:52:57', 6),
('1|200000||2022-3-26|11:55:25|2022-3-26 11:55:25', 7),
('1|200000||2022-3-26|11:56:57|2022-3-26 11:56:57', 8),
('1|200000||2022-3-26|12:28:24|2022-3-26 12:28:24', 9),
('=1001|200000|Atif Khan|2022-02-01|09:20:23|2022-02-01 09:20:23', 10),
('1001|200000|Atif Khan|2022-02-01|09:20:23|2022-02-01 09:20:23', 11),
('1001|200000|Atif Khan|2022-02-01|09:20:23|2022-02-01 09:20:23', 12),
('1001|200000444444|Atif Khan|2022-02-01|09:20:23|2022-02-01 09:20:23', 13),
('1001|200000|Atif Khan|2022-02-01|09:20:23|2022-02-01 09:20:23', 14),
('1001|200000|Atif Khan|2022-02-01|09:20:23|2022-02-01 09:20:23', 15),
('1001|200000|Atif Khan|2022-02-01|09:20:23|2022-02-01 09:20:23', 16),
('1001|200000|Atif Khan|2022-02-01|09:20:23|2022-02-01 09:20:23', 17),
('1001|200000|Atif Khan|2022-02-01|09:20:23|2022-02-01 09:20:23', 18),
('1001|200000333333|Atif Khan|2022-02-01|09:20:23|2022-02-01 09:20:23', 19),
('1001|200000333333|Atif Khan|2022-02-01|09:20:23|2022-02-01 09:20:23', 20),
('1001|200000333333|Atif Khan|2022-02-01|09:20:23|2022-02-01 09:20:23', 21),
('1|200000||2022-3-26|13:6:16|2022-3-26 13:6:16', 22);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `settingid` int(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `user_pass` varchar(200) NOT NULL,
  `admin_login` varchar(200) NOT NULL,
  `absent_sms` text NOT NULL,
  `leave_sms` text NOT NULL,
  `normal_sms` text NOT NULL,
  `late_sms` text NOT NULL,
  `early_sms` text DEFAULT NULL,
  `late_n_early_sms` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settingid`, `username`, `user_pass`, `admin_login`, `absent_sms`, `leave_sms`, `normal_sms`, `late_sms`, `early_sms`, `late_n_early_sms`) VALUES
(1, 'aisc', 'aisc$User1', 'aisc@Admin', 'testing sms for absentÂ ', 'testing sms for leave', 'testing normal sms', 'testing sms for late', 'testing early sms', 'testing late and early sms');

-- --------------------------------------------------------

--
-- Table structure for table `sms_to_all`
--

CREATE TABLE `sms_to_all` (
  `smsid` int(100) NOT NULL,
  `sms_title` varchar(200) NOT NULL,
  `sms_details` text NOT NULL,
  `status` varchar(200) NOT NULL,
  `create_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_to_class`
--

CREATE TABLE `sms_to_class` (
  `smsid` int(200) NOT NULL,
  `class_id` int(200) NOT NULL,
  `sms_title` varchar(200) NOT NULL,
  `sms_details` text NOT NULL,
  `status` varchar(200) NOT NULL,
  `create_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studentid` int(200) NOT NULL,
  `stu_first_name` varchar(200) NOT NULL,
  `stu_last_name` varchar(200) NOT NULL,
  `stu_reg_no` varchar(200) NOT NULL,
  `birthday` varchar(200) NOT NULL,
  `sex` varchar(200) NOT NULL,
  `religion` varchar(200) NOT NULL,
  `blood_group` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `class_id` varchar(200) NOT NULL,
  `create_on` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `student_fee` int(200) DEFAULT NULL,
  `discount_category` varchar(200) NOT NULL,
  `misc_disc_cat` int(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studentid`, `stu_first_name`, `stu_last_name`, `stu_reg_no`, `birthday`, `sex`, `religion`, `blood_group`, `address`, `phone`, `class_id`, `create_on`, `image`, `student_fee`, `discount_category`, `misc_disc_cat`) VALUES
(200000, 'Laiba Aslam ', 'M. Aslam Shahid ', '1001', '0', '0', '0', '0', '0', '03028394021', '4', '0000-00-00', '0', 1, '1', 1),
(200001, 'Shahal Farooq ', 'Farooq Ahmad ', '1002', '0', '0', '0', '0', '0', '03250888021', '4', '0000-00-00', '0', 1, '1', 1),
(200002, 'Esha Faiz ', 'Faiz Ahmad ', '1003', '0', '0', '0', '0', '0', '03430867782\n', '4', '0000-00-00', '0', 1, '1', 1),
(200003, 'Aliha Maqsood ', 'Maqsood Alam ', '1004', '0', '0', '0', '0', '0', '03006550542\n', '4', '0000-00-00', '0', 1, '1', 1),
(200004, 'Umme Abeeha ', 'M. Zulfiqar ', '1005', '0', '0', '0', '0', '0', '03017109697\n', '4', '0000-00-00', '0', 1, '1', 1),
(200005, 'Laiba Sarwar ', 'M. Sarwar ', '1006', '0', '0', '0', '0', '0', '03008663903\n', '4', '0000-00-00', '0', 1, '1', 1),
(200006, 'Zainab Ateeq', 'M. Ateeq ', '1007', '0', '0', '0', '0', '0', '03046875193\n', '4', '0000-00-00', '0', 1, '1', 1),
(200007, 'Ayesha Rani ', 'M. Ashraf ', '1008', '0', '0', '0', '0', '0', '03006564280\n', '4', '0000-00-00', '0', 1, '1', 1),
(200008, 'Amina Zia', 'M. Zia ul Haq', '1010', '0', '0', '0', '0', '0', '03068477910\n', '4', '0000-00-00', '0', 1, '1', 1),
(200009, 'Rabia Ramzan ', 'M. Ramzan ', '1011', '0', '0', '0', '0', '0', '03006552312\n', '4', '0000-00-00', '0', 1, '1', 1),
(200010, 'Adeeba Naz ', 'Tariq Saleem ', '1012', '0', '0', '0', '0', '0', '03046779674\n', '4', '0000-00-00', '0', 1, '1', 1),
(200011, 'Fizza Fayyaz ', 'M. Fayyaz ', '1013', '0', '0', '0', '0', '0', '03411935524\n', '4', '0000-00-00', '0', 1, '1', 1),
(200012, 'Alishba ', 'Asif Naeem ', '1014', '0', '0', '0', '0', '0', '03317597871\n', '4', '0000-00-00', '0', 1, '1', 1),
(200013, 'Sibgha Noor ', 'M. Shahid Raza ', '1015', '0', '0', '0', '0', '0', '03006550278\n', '4', '0000-00-00', '0', 1, '1', 1),
(200014, 'Saher Afaq Chaudhry', 'M. Afaq Chaudhry', '1016', '0', '0', '0', '0', '0', '03400797709\n', '4', '0000-00-00', '0', 1, '1', 1),
(200015, 'Aimen Sajid ', 'Sajid Ali ', '1017', '0', '0', '0', '0', '0', '03013115112\n', '4', '0000-00-00', '0', 1, '1', 1),
(200016, 'Ayesha Iftikhar ', 'Iftikhar Ahmad ', '1019', '0', '0', '0', '0', '0', '03006558097\n', '4', '0000-00-00', '0', 1, '1', 1),
(200017, 'Uswa Rehman ', 'Saif ur Rehman ', '1020', '0', '0', '0', '0', '0', '03007983364\n', '4', '0000-00-00', '0', 1, '1', 1),
(200018, 'Afifa Imtiaz ', 'Imtiaz Ahmad ', '1023', '0', '0', '0', '0', '0', '03464847183\n', '4', '0000-00-00', '0', 1, '1', 1),
(200019, 'Malyka Hassan ', 'M. Younis ', '1024', '0', '0', '0', '0', '0', '03417872104\n', '4', '0000-00-00', '0', 1, '1', 1),
(200020, 'Aaima Esha ', 'Sarfraz Khan ', '1025', '0', '0', '0', '0', '0', '03018228339\n', '4', '0000-00-00', '0', 1, '1', 1),
(200021, 'Ayesha Iftikhar ', 'M. Iftikhar ud Din ', '1026', '0', '0', '0', '0', '0', '03006553718\n', '4', '0000-00-00', '0', 1, '1', 1),
(200022, 'Nabia Asif ', 'M. Asif ', '1027', '0', '0', '0', '0', '0', '03452010283\n', '4', '0000-00-00', '0', 1, '1', 1),
(200023, 'Samar ', 'M. Shafiq ', '1028', '0', '0', '0', '0', '0', '03037414573\n', '4', '0000-00-00', '0', 1, '1', 1),
(200024, 'Saira Bibi', 'Saeed Ahmad', '1029', '0', '0', '0', '0', '0', '03337728212', '4', '0000-00-00', '0', 1, '1', 1),
(200025, 'Zainab Razzaq', 'M. Razzaq', '1030', '0', '0', '0', '0', '0', '03039200726', '4', '0000-00-00', '0', 1, '1', 1),
(200026, 'Ayesha Amir ', 'M. Amir Iqbal ', '1031', '0', '0', '0', '0', '0', '03017082831\n', '4', '0000-00-00', '0', 1, '1', 1),
(200027, 'Rubab Fatima ', 'Tanveer Hussain ', '1032', '0', '0', '0', '0', '0', '03074089952', '4', '0000-00-00', '0', 1, '1', 1),
(200028, 'Shamza Asghar', 'Asghar Ali', '1034', '0', '0', '0', '0', '0', '03006557110\n', '4', '0000-00-00', '0', 1, '1', 1),
(200029, 'Ghulam Fatima ', 'Dost Muhammad ', '1051', '0', '0', '0', '0', '0', '03477736282\n', '4', '0000-00-00', '0', 1, '1', 1),
(200030, 'Nida Saleem ', 'M. Saleem Khan ', '1052', '0', '0', '0', '0', '0', '03455345313\n', '4', '0000-00-00', '0', 1, '1', 1),
(200031, 'Ayesha Manzoor ', 'M. Manzoor ', '1053', '0', '0', '0', '0', '0', '03468719031\n', '4', '0000-00-00', '0', 1, '1', 1),
(200032, 'Ammara Fatima ', 'Haider Ali ', '1054', '0', '0', '0', '0', '0', '03017232621\n', '4', '0000-00-00', '0', 1, '1', 1),
(200033, 'Zainab', 'Fazal Kareem ', '1055', '0', '0', '0', '0', '0', '03346287365\n', '4', '0000-00-00', '0', 1, '1', 1),
(200034, 'Ayesha Asghar ', 'Hizber Hussain', '1056', '0', '0', '0', '0', '0', '03016031391\n', '4', '0000-00-00', '0', 1, '1', 1),
(200035, 'Hamna Fatima ', 'M. Akram ', '1057', '0', '0', '0', '0', '0', '03067041092\n', '4', '0000-00-00', '0', 1, '1', 1),
(200036, 'Aiza Aslam ', 'M. Aslam ', '1058', '0', '0', '0', '0', '0', '03004091697\n', '4', '0000-00-00', '0', 1, '1', 1),
(200037, 'Rafia Arshad', 'Arshad Ali ', '1059', '0', '0', '0', '0', '0', '03467564366\n', '4', '0000-00-00', '0', 1, '1', 1),
(200038, 'Huda Qasim ', 'Qasim Hussain', '1060', '0', '0', '0', '0', '0', '03187970159\n', '4', '0000-00-00', '0', 1, '1', 1),
(200039, 'Aqsa Anwar', 'Anwar ul Haq Zafar', '1061', '0', '0', '0', '0', '0', '03070689189\n', '4', '0000-00-00', '0', 1, '1', 1),
(200040, 'Minahil Ishfaq ', 'M.Ishfaq ', '1062', '0', '0', '0', '0', '0', '03016513122\n', '4', '0000-00-00', '0', 1, '1', 1),
(200041, 'Minahil Fatima ', 'M. Imran', '1063', '0', '0', '0', '0', '0', '03402836754\n', '4', '0000-00-00', '0', 1, '1', 1),
(200042, 'Aleesha Fiaz', 'M. Fiaz', '1065', '0', '0', '0', '0', '0', '03407419138\n', '4', '0000-00-00', '0', 1, '1', 1),
(200043, 'Sufia Rahat ', 'Malik Yaqoob ', '1066', '0', '0', '0', '0', '0', '03006550134', '4', '0000-00-00', '0', 1, '1', 1),
(200044, 'Ayesha Parvin', 'Ghulam Rasool', '1067', '0', '0', '0', '0', '0', '03467371357\n', '4', '0000-00-00', '0', 1, '1', 1),
(200045, 'Ammara ', 'Abdul Raheem ', '1068', '0', '0', '0', '0', '0', '03068470399\n', '4', '0000-00-00', '0', 1, '1', 1),
(200046, 'Afaf Fatima ', 'M. Younas ', '1070', '0', '0', '0', '0', '0', '03067676025\n', '4', '0000-00-00', '0', 1, '1', 1),
(200047, 'Khadija Sajjad ', 'Sajjad Ahmad ', '1071', '0', '0', '0', '0', '0', '03428443275\n', '4', '0000-00-00', '0', 1, '1', 1),
(200048, 'Rabia Razzaq', 'Abdul Razzaq', '1072', '0', '0', '0', '0', '0', '03425830880', '4', '0000-00-00', '0', 1, '1', 1),
(200049, 'Anum Fatima ', 'Abdul Sattar ', '1073', '0', '0', '0', '0', '0', '03007710087\n', '4', '0000-00-00', '0', 1, '1', 1),
(200050, 'Ayesha Dildar ', 'Dildar Ahmad ', '1076', '0', '0', '0', '0', '0', '03487894461\n', '4', '0000-00-00', '0', 1, '1', 1),
(200051, 'Aneeza Anwar ', 'Anwar Hussain', '1077', '0', '0', '0', '0', '0', '03060188139\n', '4', '0000-00-00', '0', 1, '1', 1),
(200052, 'Madiha Javed ', 'Javed Iqbal ', '1101', '0', '0', '0', '0', '0', '03464858321\n', '3', '0000-00-00', '0', 1, '1', 1),
(200053, 'Tayyaba Ramzan ', 'M. Ramzan ', '1102', '0', '0', '0', '0', '0', '03157392294\n', '3', '0000-00-00', '0', 1, '1', 1),
(200054, 'Ayesha Saleem ', 'M. Saleem ', '1103', '0', '0', '0', '0', '0', '03008231296', '3', '0000-00-00', '0', 1, '1', 1),
(200055, 'Laiba Ubaid ur Rehman ', 'Ubaid ur Rehman', '1104', '0', '0', '0', '0', '0', '03317595690\n', '3', '0000-00-00', '0', 1, '1', 1),
(200056, 'Alisha Fatima', 'Abdul Jabbar ', '1105', '0', '0', '0', '0', '0', '03036388730\n', '3', '0000-00-00', '0', 1, '1', 1),
(200057, 'Rabia Qudrat Ullah ', 'Qudrat Ullah ', '1106', '0', '0', '0', '0', '0', '03045310171\n', '3', '0000-00-00', '0', 1, '1', 1),
(200058, 'Aqsa Perveen Ashiq ', 'Ashiq ', '1108', '0', '0', '0', '0', '0', '03424433276\n', '3', '0000-00-00', '0', 1, '1', 1),
(200059, 'Raiha Saeed ', 'M. Saeed ', '1109', '0', '0', '0', '0', '0', '03226315285\n', '3', '0000-00-00', '0', 1, '1', 1),
(200060, 'Samra Yasin ', 'M. Yasin ', '1110', '0', '0', '0', '0', '0', '03027236022\n', '3', '0000-00-00', '0', 1, '1', 1),
(200061, 'Areeba Shehzadi', 'Akhtar Ali ', '1111', '0', '0', '0', '0', '0', '3157573943', '3', '0000-00-00', '0', 1, '1', 1),
(200062, 'Maryam ', 'Mujahid Ali ', '1112', '0', '0', '0', '0', '0', '03046690342\n', '3', '0000-00-00', '0', 1, '1', 1),
(200063, 'Minahil Shahzadi', 'Abdul Ghani Sabri ', '1113', '0', '0', '0', '0', '0', '03428391948', '3', '0000-00-00', '0', 1, '1', 1),
(200064, 'Nisha Yaqoob', 'M. Yaqoob', '1114', '0', '0', '0', '0', '0', '03024105909', '3', '0000-00-00', '0', 1, '1', 1),
(200065, 'Hefza Shamas ', 'Shamas Ali', '1115', '0', '0', '0', '0', '0', '3027143626', '3', '0000-00-00', '0', 1, '1', 1),
(200066, 'Hira Eman ', 'M. Taj ', '1116', '0', '0', '0', '0', '0', '03327480856\n', '3', '0000-00-00', '0', 1, '1', 1),
(200067, 'Eman Afzal ', 'M. Afzal Saleem ', '1118', '0', '0', '0', '0', '0', '03084970958\n', '3', '0000-00-00', '0', 1, '1', 1),
(200068, 'Huma Shahid ', 'Shahid Hussain ', '1119', '0', '0', '0', '0', '0', '03407773708\n.', '3', '0000-00-00', '0', 1, '1', 1),
(200069, 'Maria ', 'Abdul Shakoor ', '1120', '0', '0', '0', '0', '0', '03491845073\n', '3', '0000-00-00', '0', 1, '1', 1),
(200070, 'Hafsa Hafeez ', 'M. Hafeez ', '1122', '0', '0', '0', '0', '0', '03017236606\n', '3', '0000-00-00', '0', 1, '1', 1),
(200071, 'Khansa ', 'Abdul Haleem', '1123', '0', '0', '0', '0', '0', '03017220094', '3', '0000-00-00', '0', 1, '1', 1),
(200072, 'Alishba Maqsood ', 'Maqsood Ahmad', '1124', '0', '0', '0', '0', '0', '', '3', '0000-00-00', '0', 1, '1', 1),
(200073, 'Sadia Amin ', 'M. Amin ', '1201', '0', '0', '0', '0', '0', '03437910286\n', '2', '0000-00-00', '0', 1, '1', 1),
(200074, 'Saira Farooq ', 'Umar Farooq ', '1202', '0', '0', '0', '0', '0', '03457483418\n', '2', '0000-00-00', '0', 1, '1', 1),
(200075, 'Aqsa Munawar ', 'M. Munawar ', '1203', '0', '0', '0', '0', '0', '03068464347\n', '2', '0000-00-00', '0', 1, '1', 1),
(200076, 'Amna Shahid', 'Sahid Mehmood', '1204', '0', '0', '0', '0', '0', '03017230387', '2', '0000-00-00', '0', 1, '1', 1),
(200077, 'Zainab Naseem ', 'M. Naseem ', '1205', '0', '0', '0', '0', '0', '03332278746\n', '2', '0000-00-00', '0', 1, '1', 1),
(200078, 'Irtqa Shahid ', 'M.Shahid Ali', '1206', '0', '0', '0', '0', '0', '03006624304\n', '2', '0000-00-00', '0', 1, '1', 1),
(200079, 'Maryam Shafiq ', 'M. Shafiq Sajid ', '1208', '0', '0', '0', '0', '0', '03454248109\n', '2', '0000-00-00', '0', 1, '1', 1),
(200080, 'Laiba Arooj', 'Amjad Pervaiz', '1209', '0', '0', '0', '0', '0', '3068471733', '2', '0000-00-00', '0', 1, '1', 1),
(200081, 'Rabia Sharif', 'M.Sharif', '1301', '0', '0', '0', '0', '0', '03076066679', '1', '0000-00-00', '0', 1, '1', 1),
(200082, 'Alisha Tariq', 'Tariq Mehmood', '1302', '0', '0', '0', '0', '0', '03007645263', '1', '0000-00-00', '0', 1, '1', 1),
(200083, 'Hina Mustafa', 'Ghulam Mustafa', '1303', '0', '0', '0', '0', '0', '03092281360', '1', '0000-00-00', '0', 1, '1', 1),
(200084, 'Khadija Rizwan ', 'Rizwan Anwar ', '1306', '0', '0', '0', '0', '0', '03066979432', '1', '0000-00-00', '0', 1, '1', 1),
(200085, 'Saneela Kanwal ', 'Ghulam Mustafa', '1309', '0', '0', '0', '0', '0', '03471730995\n', '1', '0000-00-00', '0', 1, '1', 1),
(200086, 'Laiba Yasin', 'Muhammad Yasin', '2001', '0', '0', '0', '0', '0', '03014327767', '5', '0000-00-00', '0', 1, '1', 1),
(200087, 'Asima ', 'M.Mushtaq', '2002', '0', '0', '0', '0', '0', '3084940362', '5', '0000-00-00', '0', 1, '1', 1),
(200088, 'Areeza Nasir', 'Abdul Nasir', '2003', '0', '0', '0', '0', '0', '3068472218', '5', '0000-00-00', '0', 1, '1', 1),
(200089, 'Ayesha Javed', 'M.Javed', '2004', '0', '0', '0', '0', '0', '03006550880', '5', '0000-00-00', '0', 1, '1', 1),
(200090, 'Ayesha Siddique', 'M.Siddique', '2005', '0', '0', '0', '0', '0', '03004600367', '5', '0000-00-00', '0', 1, '1', 1),
(200091, 'Suhera Saqib', 'M.Saqib', '2006', '0', '0', '0', '0', '0', '03049199791', '5', '0000-00-00', '0', 1, '1', 1),
(200092, 'Ayesha Imtiaz', 'M.Imtiaz', '2007', '0', '0', '0', '0', '0', '03016229225\n', '5', '0000-00-00', '0', 1, '1', 1),
(200093, 'Hira Sameen', 'M.Saeed', '2008', '0', '0', '0', '0', '0', '03458181574\n', '5', '0000-00-00', '0', 1, '1', 1),
(200094, 'Zainab Ashraf', 'M.Ashraf', '2009', '0', '0', '0', '0', '0', '03457991673\n', '5', '0000-00-00', '0', 1, '1', 1),
(200095, 'Tayyaba Charagh', 'M.Charagh', '2010', '0', '0', '0', '0', '0', '3039812711', '5', '0000-00-00', '0', 1, '1', 1),
(200096, 'Tahreem Aamir', 'M.Aamir Hussain', '2011', '0', '0', '0', '0', '0', '3027163094', '5', '0000-00-00', '0', 1, '1', 1),
(200097, 'Maryam Sumair', 'M.Sumair', '2012', '0', '0', '0', '0', '0', '3074894191', '5', '0000-00-00', '0', 1, '1', 1),
(200098, 'Ayesha ', 'Abdul Rehman', '2013', '0', '0', '0', '0', '0', '3326905892', '5', '0000-00-00', '0', 1, '1', 1),
(200099, 'Nimra Akram', 'M.Akram', '2014', '0', '0', '0', '0', '0', '03448762422\n', '5', '0000-00-00', '0', 1, '1', 1),
(200100, 'Noor Fatima', 'Hussain Javed', '2015', '0', '0', '0', '0', '0', '03477922061\n', '5', '0000-00-00', '0', 1, '1', 1),
(200101, 'Rabia Riaz', 'Riaz Ahmad', '2016', '0', '0', '0', '0', '0', '03007936195\n', '5', '0000-00-00', '0', 1, '1', 1),
(200102, 'Anam Ijaz', 'M.Ijaz', '2017', '0', '0', '0', '0', '0', '3457890430', '5', '0000-00-00', '0', 1, '1', 1),
(200103, 'Minahil Naeem', 'Naeem Ahmad', '2018', '0', '0', '0', '0', '0', '3017015298', '5', '0000-00-00', '0', 1, '1', 1),
(200104, 'Rafia Sajid', 'M.Sajid', '2019', '0', '0', '0', '0', '0', '03002456211\n', '5', '0000-00-00', '0', 1, '1', 1),
(200105, 'Aleeha noor', 'Dildar Ahmad', '2020', '0', '0', '0', '0', '0', '03028158089\n', '5', '0000-00-00', '0', 1, '1', 1),
(200106, 'Hifza Hanif', 'M.Hanif', '2022', '0', '0', '0', '0', '0', '03017231084', '5', '0000-00-00', '0', 1, '1', 1),
(200107, 'Roohamma', 'Anwar ul Haq', '2023', '0', '0', '0', '0', '0', '03006511248\n', '5', '0000-00-00', '0', 1, '1', 1),
(200108, 'Ayesha Shahid', 'M.Shahid', '2024', '0', '0', '0', '0', '0', '03005179225\n', '5', '0000-00-00', '0', 1, '1', 1),
(200109, 'Hira Ajaz', 'M.Ajaz', '2025', '0', '0', '0', '0', '0', '03177839785\n', '5', '0000-00-00', '0', 1, '1', 1),
(200110, 'Laiba', 'Nawaz Ahmad', '2026', '0', '0', '0', '0', '0', '\n03007652843', '5', '0000-00-00', '0', 1, '1', 1),
(200111, 'Hadia', 'M.Akram', '2027', '0', '0', '0', '0', '0', '03069046917\n', '5', '0000-00-00', '0', 1, '1', 1),
(200112, 'Mnawish Fatima', 'M.Rasheed', '2028', '0', '0', '0', '0', '0', '3013202591', '5', '0000-00-00', '0', 1, '1', 1),
(200113, 'Saman', 'Ashiq Ali', '2029', '0', '0', '0', '0', '0', '03424583244\n', '5', '0000-00-00', '0', 1, '1', 1),
(200114, 'Khadija Noor', 'Zubar Pervaz', '2030', '0', '0', '0', '0', '0', '3079236091', '5', '0000-00-00', '0', 1, '1', 1),
(200115, 'Fatima Irfan', 'M.Irfan', '2031', '0', '0', '0', '0', '0', '3017231567', '5', '0000-00-00', '0', 1, '1', 1),
(200116, 'Urwah Mehmood', 'Mehmood Alam', '2032', '0', '0', '0', '0', '0', '3017895765', '5', '0000-00-00', '0', 1, '1', 1),
(200117, 'Aqsa ', 'Faqeer Hussain', '2033', '0', '0', '0', '0', '0', '03081323367\n', '5', '0000-00-00', '0', 1, '1', 1),
(200118, 'Khansa Fatima', 'M.Ashfaq', '2034', '0', '0', '0', '0', '0', '03017236431\n', '5', '0000-00-00', '0', 1, '1', 1),
(200119, 'Tayyaba  Shafique', 'M.Shafique', '2035', '0', '0', '0', '0', '0', '3054392036', '5', '0000-00-00', '0', 1, '1', 1),
(200120, 'Ayesha Ayub', 'M.Ayub', '2036', '0', '0', '0', '0', '0', '3336851558', '5', '0000-00-00', '0', 1, '1', 1),
(200121, 'Amina Suleman', 'M.Suleman', '2037', '0', '0', '0', '0', '0', '03061867047\n', '5', '0000-00-00', '0', 1, '1', 1),
(200122, 'Ribaha Noor', 'Tariq Ali', '2038', '0', '0', '0', '0', '0', '03447844060\n', '5', '0000-00-00', '0', 1, '1', 1),
(200123, 'Manahil Ashfaq', 'M.Ashfaq', '2040', '0', '0', '0', '0', '0', '3061966000', '5', '0000-00-00', '0', 1, '1', 1),
(200124, 'Mah Noor Tariq', 'Traiq Mehmood', '2041', '0', '0', '0', '0', '0', '03014373002\n', '5', '0000-00-00', '0', 1, '1', 1),
(200125, 'Hamna', 'Amir Husain', '2042', '0', '0', '0', '0', '0', '03227806834\n', '5', '0000-00-00', '0', 1, '1', 1),
(200126, 'Mah Noor ', 'M.Shahzad', '2043', '0', '0', '0', '0', '0', '3334538536', '5', '0000-00-00', '0', 1, '1', 1),
(200127, 'Zarnain Afzal', 'M.Afzal', '2044', '0', '0', '0', '0', '0', '03046412283\n', '5', '0000-00-00', '0', 1, '1', 1),
(200128, 'Hiba Ashfaq', 'M.Ashfaq', '2045', '0', '0', '0', '0', '0', '3061966000', '5', '0000-00-00', '0', 1, '1', 1),
(200129, 'Alishba Naveed', 'M.Naveed', '2046', '0', '0', '0', '0', '0', '3016034051', '5', '0000-00-00', '0', 1, '1', 1),
(200130, 'Fatima Arshad', 'M.Arshad', '2047', '0', '0', '0', '0', '0', '03006557037\n', '5', '0000-00-00', '0', 1, '1', 1),
(200131, 'Amman Fatima', 'M.Hafeez', '2048', '0', '0', '0', '0', '0', '03007931169\n', '5', '0000-00-00', '0', 1, '1', 1),
(200132, 'Abeera Fatima', 'Zulfiqar Ali', '2049', '0', '0', '0', '0', '0', '03187411599\n', '5', '0000-00-00', '0', 1, '1', 1),
(200133, 'Arooj Fatima ', 'M.Anwar', '2050', '0', '0', '0', '0', '0', '3406687418', '5', '0000-00-00', '0', 1, '1', 1),
(200134, 'Rimsha Zaman', 'Khaliq uz Zaman', '2101', '0', '0', '0', '0', '0', '3041552014', '6', '0000-00-00', '0', 1, '1', 1),
(200135, 'Manahil Maqsood', 'Maqsood Ahmad', '2102', '0', '0', '0', '0', '0', '03015460242\n', '6', '0000-00-00', '0', 1, '1', 1),
(200136, 'Ayesha ', 'Ghulam Nabi', '2103', '0', '0', '0', '0', '0', '3011242790', '6', '0000-00-00', '0', 1, '1', 1),
(200137, 'Ishmal Fatima', 'M.Shafiq', '2104', '0', '0', '0', '0', '0', '03027956692\n', '6', '0000-00-00', '0', 1, '1', 1),
(200138, 'Maliha Fatima', 'Munir Ahmad', '2105', '0', '0', '0', '0', '0', '03143175899\n', '6', '0000-00-00', '0', 1, '1', 1),
(200139, 'Areeba Noreen', 'M.Arif', '2106', '0', '0', '0', '0', '0', '3447710263', '6', '0000-00-00', '0', 1, '1', 1),
(200140, 'Romaisa', 'Qari Abdullah', '2108', '0', '0', '0', '0', '0', '3421370385', '6', '0000-00-00', '0', 1, '1', 1),
(200141, 'Saira Ashraf', 'M.Ashraf', '2109', '0', '0', '0', '0', '0', '3013208608', '6', '0000-00-00', '0', 1, '1', 1),
(200142, 'Ayesha Irfan', 'M.Arfan', '2110', '0', '0', '0', '0', '0', '3006557910', '6', '0000-00-00', '0', 1, '1', 1),
(200143, 'Muneeba Shahid', 'M.Shahid ', '2111', '0', '0', '0', '0', '0', '3451460428', '6', '0000-00-00', '0', 1, '1', 1),
(200144, 'Kashmala Noor', 'M.Shahid Raza', '2112', '0', '0', '0', '0', '0', '03006550278\n', '6', '0000-00-00', '0', 1, '1', 1),
(200145, 'Rabia Zaheer', 'Zaheer Ahmad', '2113', '0', '0', '0', '0', '0', '03188666266\n', '6', '0000-00-00', '0', 1, '1', 1),
(200146, 'Jawaria Saif', 'Saif ur Rehman', '2114', '0', '0', '0', '0', '0', '3463280297', '6', '0000-00-00', '0', 1, '1', 1),
(200147, 'Ishmal Khalid', 'Khalid Tanveer', '2116', '0', '0', '0', '0', '0', '03017231476\n', '6', '0000-00-00', '0', 1, '1', 1),
(200148, 'Arooj Minahil', 'Zafar Iqbal', '2117', '0', '0', '0', '0', '0', '03107469843\n', '6', '0000-00-00', '0', 1, '1', 1),
(200149, 'Abeera Ahmed', 'Ahmed Yar Khan', '2118', '0', '0', '0', '0', '0', '03014413540\n', '6', '0000-00-00', '0', 1, '1', 1),
(200150, 'Sara Waseem', 'M.Waseem', '2119', '0', '0', '0', '0', '0', '03464697567\n', '6', '0000-00-00', '0', 1, '1', 1),
(200151, 'Malaika Imtiaz', 'Imtiaz Hassan', '2120', '0', '0', '0', '0', '0', '3035977075', '6', '0000-00-00', '0', 1, '1', 1),
(200152, 'Ammara Khalid', 'Khalid Husain', '2121', '0', '0', '0', '0', '0', '3074555915', '6', '0000-00-00', '0', 1, '1', 1),
(200153, 'Huzaifa Saeed', 'Saeed Ahmad', '2122', '0', '0', '0', '0', '0', '03041386314\n', '6', '0000-00-00', '0', 1, '1', 1),
(200154, 'Eman Saif', 'Saif ullah', '2123', '0', '0', '0', '0', '0', '03424854978\n', '6', '0000-00-00', '0', 1, '1', 1),
(200155, 'Zainab Bibi', 'Azam Ali', '2124', '0', '0', '0', '0', '0', '3006557463', '6', '0000-00-00', '0', 1, '1', 1),
(200156, 'Muqadas Ashraf', 'M.Ashraf', '2125', '0', '0', '0', '0', '0', '03447482309\n', '6', '0000-00-00', '0', 1, '1', 1),
(200157, 'Kashaf Tariq', 'M.Tariq Saeed', '2126', '0', '0', '0', '0', '0', '03447843543\n', '6', '0000-00-00', '0', 1, '1', 1),
(200158, 'Um-e-Fiza ', 'Khushnood Ahmad', '2127', '0', '0', '0', '0', '0', '03240039215\n', '6', '0000-00-00', '0', 1, '1', 1),
(200159, 'Bint e Zaineb', 'Hamid ullah', '2128', '0', '0', '0', '0', '0', '3306392650', '6', '0000-00-00', '0', 1, '1', 1),
(200160, 'Shamsa Iram', 'M.Zunnurain', '2129', '0', '0', '0', '0', '0', '3457551840', '6', '0000-00-00', '0', 1, '1', 1),
(200161, 'Sania Riaz', 'Riaz Ahmad', '2131', '0', '0', '0', '0', '0', '', '6', '0000-00-00', '0', 1, '1', 1),
(200162, 'Minahil Yaqoob', 'M.Yaqoob', '2132', '0', '0', '0', '0', '0', '3017693826', '6', '0000-00-00', '0', 1, '1', 1),
(200163, 'Farwa Fatima', 'Saeed Nwaz', '2133', '0', '0', '0', '0', '0', '3075769907', '6', '0000-00-00', '0', 1, '1', 1),
(200164, 'Wajiha', 'M.Ramzan', '2134', '0', '0', '0', '0', '0', '03007977389\n', '6', '0000-00-00', '0', 1, '1', 1),
(200165, 'Rida Hafeez', 'M.Hafeez', '2135', '0', '0', '0', '0', '0', '03495858211\n', '6', '0000-00-00', '0', 1, '1', 1),
(200166, 'Esha Ishtiyaq', 'Ishtiaq Ahmad', '2136', '0', '0', '0', '0', '0', '03023424489\n', '6', '0000-00-00', '0', 1, '1', 1),
(200167, 'Nigha Chaudhary', 'M.Farooq', '2137', '0', '0', '0', '0', '0', '03016743976\n', '6', '0000-00-00', '0', 1, '1', 1),
(200168, 'Eman Bashir', 'M.Bashir', '2138', '0', '0', '0', '0', '0', '3061430548', '6', '0000-00-00', '0', 1, '1', 1),
(200169, 'Basma Ali', 'Salamat Ali', '2139', '0', '0', '0', '0', '0', '03346468779\n', '6', '0000-00-00', '0', 1, '1', 1),
(200170, 'Jasika Qazi', 'Shehzad Qazi', '2201', '0', '0', '0', '0', '0', '03137856424\n', '7', '0000-00-00', '0', 1, '1', 1),
(200171, 'Meerab Fatima', 'M.Yousaf', '2202', '0', '0', '0', '0', '0', '3206611975', '7', '0000-00-00', '0', 1, '1', 1),
(200172, 'Maira Abdul Sattar', 'Abdul Sattar', '2203', '0', '0', '0', '0', '0', '3051280406', '7', '0000-00-00', '0', 1, '1', 1),
(200173, 'Ritma Amjad', 'Amjad Mashi', '2204', '0', '0', '0', '0', '0', '03022443126\n', '7', '0000-00-00', '0', 1, '1', 1),
(200174, 'Noor Fatima', 'M.Arshad', '2205', '0', '0', '0', '0', '0', '3015452093', '7', '0000-00-00', '0', 1, '1', 1),
(200175, 'Isra Iftikhar', 'M.Iftikhar', '2206', '0', '0', '0', '0', '0', '3023447311', '7', '0000-00-00', '0', 1, '1', 1),
(200176, 'Muqadas Rafiq', 'M.Rafiq', '2208', '0', '0', '0', '0', '0', '03086512011\n', '7', '0000-00-00', '0', 1, '1', 1),
(200177, 'Laiba Arshad', 'Arshad Mehmood', '2209', '0', '0', '0', '0', '0', '03405608491\n\n', '7', '0000-00-00', '0', 1, '1', 1),
(200178, 'Aman Shahid', 'Shahid Iqbal', '2210', '0', '0', '0', '0', '0', '3028065553', '7', '0000-00-00', '0', 1, '1', 1),
(200179, 'Amna Amir', 'M.Amir Shafique', '2211', '0', '0', '0', '0', '0', '3027296370', '7', '0000-00-00', '0', 1, '1', 1),
(200180, 'Jasika Gill', 'Amir Shahzad', '2212', '0', '0', '0', '0', '0', '03444155997\n', '7', '0000-00-00', '0', 1, '1', 1),
(200181, 'Irha Waheed', 'Abdul Waheed', '2214', '0', '0', '0', '0', '0', '0463510878\n\n', '7', '0000-00-00', '0', 1, '1', 1),
(200182, 'Areesha Maryam', 'Akhtar Ali', '2215', '0', '0', '0', '0', '0', '3406768305', '7', '0000-00-00', '0', 1, '1', 1),
(200183, 'Gharida Ghazal', 'Irfan Ghani', '2216', '0', '0', '0', '0', '0', '03155570345\n', '7', '0000-00-00', '0', 1, '1', 1),
(200184, 'Fatima', 'Akbar Ali', '2217', '0', '0', '0', '0', '0', '03054147305\n', '7', '0000-00-00', '0', 1, '1', 1),
(200185, 'Carrol Naz', 'M.Shahbaz', '2218', '0', '0', '0', '0', '0', '03448751046\n', '7', '0000-00-00', '0', 1, '1', 1),
(200186, 'Rimsha Rafique', 'M.Rafique', '2219', '0', '0', '0', '0', '0', '3457551424', '7', '0000-00-00', '0', 1, '1', 1),
(200187, 'Mahak Fatima', 'Shahzad husain', '2220', '0', '0', '0', '0', '0', '3059097237', '7', '0000-00-00', '0', 1, '1', 1),
(200188, 'Rida Batool', 'Nadeem Shahzad', '2221', '0', '0', '0', '0', '0', '3028603813', '7', '0000-00-00', '0', 1, '1', 1),
(200189, 'Khadija Saleem', 'M.Saleem', '2222', '0', '0', '0', '0', '0', '3464858363', '7', '0000-00-00', '0', 1, '1', 1),
(200190, 'Rimsha Hazoor ', 'M.Hazoor', '2223', '0', '0', '0', '0', '0', '3421170649', '7', '0000-00-00', '0', 1, '1', 1),
(200191, 'Atiqa Farooq', 'M.Farooq', '2224', '0', '0', '0', '0', '0', '3431790260', '7', '0000-00-00', '0', 1, '1', 1),
(200192, 'Eman Arif', 'M.Arif', '2225', '0', '0', '0', '0', '0', '3447070307', '7', '0000-00-00', '0', 1, '1', 1),
(200193, 'Javeria Tariq', 'M.Tariq', '2226', '0', '0', '0', '0', '0', '03471699560\n', '7', '0000-00-00', '0', 1, '1', 1),
(200194, 'Amna ', 'Abdul Razaq', '2227', '0', '0', '0', '0', '0', '03464847614\n', '7', '0000-00-00', '0', 1, '1', 1),
(200195, 'Namra Ashfaq', 'M.Ashfaq', '2228', '0', '0', '0', '0', '0', '03410141979\n', '7', '0000-00-00', '0', 1, '1', 1),
(200196, 'Amna Aleem', 'M.Aleem', '2301', '0', '0', '0', '0', '0', '03076651716\n', '8', '0000-00-00', '0', 1, '1', 1),
(200197, 'Aliza Farooq', 'Farooq Ahmad', '2302', '0', '0', '0', '0', '0', '3457555670', '8', '0000-00-00', '0', 1, '1', 1),
(200198, 'Zara Eman', 'M.Zaman', '2303', '0', '0', '0', '0', '0', '3037934206', '8', '0000-00-00', '0', 1, '1', 1),
(200199, 'Aman Asghar', 'Asghar Ali', '2304', '0', '0', '0', '0', '0', '3241897578', '8', '0000-00-00', '0', 1, '1', 1),
(200200, 'Aiman Saleem', 'M.Saleem', '2305', '0', '0', '0', '0', '0', '03326531385\n', '8', '0000-00-00', '0', 1, '1', 1),
(200201, 'Lariab Fatima', 'Anwar Ahmed', '2306', '0', '0', '0', '0', '0', '03099116716\n', '8', '0000-00-00', '0', 1, '1', 1),
(200202, 'Hadia Zahid', 'Zahid Iqbal', '2307', '0', '0', '0', '0', '0', '03007285173\n', '8', '0000-00-00', '0', 1, '1', 1),
(200203, 'Amna Shahid', 'M.Shahid', '2308', '0', '0', '0', '0', '0', '3447868348', '8', '0000-00-00', '0', 1, '1', 1),
(200204, 'Lubaina Farooq', 'M.Farooq', '2309', '0', '0', '0', '0', '0', '03233603497\n', '8', '0000-00-00', '0', 1, '1', 1),
(200205, 'Ayesha', 'Abdul Gaffar', '2310', '0', '0', '0', '0', '0', '03404264936\n', '8', '0000-00-00', '0', 1, '1', 1),
(200206, 'Ayesha', 'M.Shahbaz', '2311', '0', '0', '0', '0', '0', '03335985186\n', '8', '0000-00-00', '0', 1, '1', 1),
(200207, 'Esha Razia', 'Farman Ali', '2312', '0', '0', '0', '0', '0', '3076552486', '8', '0000-00-00', '0', 1, '1', 1),
(200208, 'Sana Amjad', 'Amjad Ali', '2313', '0', '0', '0', '0', '0', '03414815049', '8', '0000-00-00', '0', 1, '1', 1),
(200209, 'Hadia ', 'Umair Qadir', '2314', '0', '0', '0', '0', '0', '03027049361\n', '8', '0000-00-00', '0', 1, '1', 1),
(200210, 'Arooba Dastgeer', 'Ghulam Dastgeer', '2315', '0', '0', '0', '0', '0', '03035703479\n', '8', '0000-00-00', '0', 1, '1', 1),
(200211, 'Malaika Afzal', 'M.Afzal', '2316', '0', '0', '0', '0', '0', '3036074094', '8', '0000-00-00', '0', 1, '1', 1),
(200212, 'Amama Toheed', 'M.Toheed', '2317', '0', '0', '0', '0', '0', '03034973101\n\n', '8', '0000-00-00', '0', 1, '1', 1),
(200213, 'Aliza Iftikar', 'Iftikar Ahmad', '2318', '0', '0', '0', '0', '0', '3048684047', '8', '0000-00-00', '0', 1, '1', 1),
(200214, 'Rimsha iftikhar', 'Iftikhar Ahmed', '2319', '0', '0', '0', '0', '0', '03036341395\n', '8', '0000-00-00', '0', 1, '1', 1),
(200215, 'Malaika Shafique', 'M.Shafique', '2320', '0', '0', '0', '0', '0', '03447624369\n', '8', '0000-00-00', '0', 1, '1', 1),
(200216, 'Amna Bibi', 'M.Azam', '2321', '0', '0', '0', '0', '0', '3026049979', '8', '0000-00-00', '0', 1, '1', 1),
(200217, 'Maira Khalid', 'Khalid Mehmood', '2322', '0', '0', '0', '0', '0', '03336627239\n', '8', '0000-00-00', '0', 1, '1', 1),
(200218, 'Malaika ', 'Allah Rakha', '2323', '0', '0', '0', '0', '0', '03076323704\n', '8', '0000-00-00', '0', 1, '1', 1),
(200219, 'Meezab Fatima', 'M.Anwar', '2324', '0', '0', '0', '0', '0', '3099116716\n', '8', '0000-00-00', '0', 1, '1', 1),
(200220, 'Zunaira ', 'Abdul Haleem', '2325', '0', '0', '0', '0', '0', '3017220094', '8', '0000-00-00', '0', 1, '1', 1),
(200221, 'Fatima Abid', 'M.Abid', '2326', '0', '0', '0', '0', '0', '3467184367', '8', '0000-00-00', '0', 1, '1', 1),
(200222, 'Hafsa Ambreen', 'Javed Iqbal', '2327', '0', '0', '0', '0', '0', '03003855287\n', '8', '0000-00-00', '0', 1, '1', 1),
(200223, 'Ayesha Rehab', 'Javed Iqbal', '2328', '0', '0', '0', '0', '0', '03003855287\n', '8', '0000-00-00', '0', 1, '1', 1),
(200224, 'Sodah Karamat', 'Molvi Kramat', '2329', '0', '0', '0', '0', '0', '03211569416\n', '8', '0000-00-00', '0', 1, '1', 1),
(200225, 'Hamina Ahsan', 'M.Ahsan', '2401', '0', '0', '0', '0', '0', '03006606042\n', '9', '0000-00-00', '0', 1, '1', 1),
(200226, 'Tahira Mehmood', 'Khalid Mehmood', '2402', '0', '0', '0', '0', '0', '3007256705', '9', '0000-00-00', '0', 1, '1', 1),
(200227, 'Zainab Fayyaz', 'M.Fayyaz', '2403', '0', '0', '0', '0', '0', '3006555761', '9', '0000-00-00', '0', 1, '1', 1),
(200228, 'Sania Mirza', 'Yaseen Sultani', '2404', '0', '0', '0', '0', '0', '3007002534', '9', '0000-00-00', '0', 1, '1', 1),
(200229, 'Laiba Manzoor', 'Manzoor Ahmad', '2405', '0', '0', '0', '0', '0', '03045095092\n', '9', '0000-00-00', '0', 1, '1', 1),
(200230, 'Merab Khalid', 'Khalid Mehmood', '2406', '0', '0', '0', '0', '0', '03016992229\n', '9', '0000-00-00', '0', 1, '1', 1),
(200231, 'Taiba Waheed', 'Abdul Waheed', '2407', '0', '0', '0', '0', '0', '03039188644\n', '9', '0000-00-00', '0', 1, '1', 1),
(200232, 'Alvia Zahid', 'M.Zahid', '2409', '0', '0', '0', '0', '0', '03007669847\n', '9', '0000-00-00', '0', 1, '1', 1),
(200233, 'Maryam Tariq', 'Tariq Naeem', '2410', '0', '0', '0', '0', '0', '3090450179', '9', '0000-00-00', '0', 1, '1', 1),
(200234, 'Hamna', 'M.Latif', '2411', '0', '0', '0', '0', '0', '3447556327', '9', '0000-00-00', '0', 1, '1', 1),
(200235, 'Aleena Tayyab', 'M.Tayyab', '2412', '0', '0', '0', '0', '0', '3014327884', '9', '0000-00-00', '0', 1, '1', 1),
(200236, 'Taiba Shahzadi', 'M.Imtiaz', '2413', '0', '0', '0', '0', '0', '3037797299', '9', '0000-00-00', '0', 1, '1', 1),
(200237, 'Farwa Arooj', 'M.Aslam', '2414', '0', '0', '0', '0', '0', '3442295361', '9', '0000-00-00', '0', 1, '1', 1),
(200238, 'Vazuha', 'Saeed Ahmad', '2415', '0', '0', '0', '0', '0', '3006557907', '9', '0000-00-00', '0', 1, '1', 1),
(200239, 'Subha Tab', 'M.Aslam', '2416', '0', '0', '0', '0', '0', '03006552840\n\n', '9', '0000-00-00', '0', 1, '1', 1),
(200240, 'Amna Azam', 'M.Azam', '2418', '0', '0', '0', '0', '0', '03217803760\n', '9', '0000-00-00', '0', 1, '1', 1),
(200241, 'Iram Naz', 'M.Riaz', '2419', '0', '0', '0', '0', '0', '', '9', '0000-00-00', '0', 1, '1', 1),
(200242, 'Laiba Zulfiqar', 'Zulfiqar Ahmad', '2420', '0', '0', '0', '0', '0', '3005693370', '9', '0000-00-00', '0', 1, '1', 1),
(200243, 'Aliza Akhtar', 'Akhtar Ali', '2501', '0', '0', '0', '0', '0', '3077708731', '10', '0000-00-00', '0', 1, '1', 1),
(200244, 'Tania Sarwar', 'Sarwar Hussain', '2502', '0', '0', '0', '0', '0', '03030286784\n', '10', '0000-00-00', '0', 1, '1', 1),
(200245, 'Shabana Afzal', 'M.Afzal', '2503', '0', '0', '0', '0', '0', '3008797721', '10', '0000-00-00', '0', 1, '1', 1),
(200246, 'Shumaila Azam', 'Azam Ali', '2504', '0', '0', '0', '0', '0', '3336851833', '10', '0000-00-00', '0', 1, '1', 1),
(200247, 'Fatima ', 'Ali Akhtar', '2505', '0', '0', '0', '0', '0', '03366818665\n\n', '10', '0000-00-00', '0', 1, '1', 1),
(200248, 'Ayesha Riaz', 'Muhammad Riaz', '9001', '0', '0', '0', '0', '0', '3017232495', '11', '0000-00-00', '0', 1, '1', 1),
(200249, 'Khadija Zahid ', 'Zahid Ghani ', '9002', '0', '0', '0', '0', '0', '3063064438', '11', '0000-00-00', '0', 1, '1', 1),
(200250, 'Eman Fatima', 'Muhammad Ilyas', '9003', '0', '0', '0', '0', '0', '03017236923\n', '11', '0000-00-00', '0', 1, '1', 1),
(200251, 'Areeba Farooq', 'Umer Farooq', '9004', '0', '0', '0', '0', '0', '3039200951', '11', '0000-00-00', '0', 1, '1', 1),
(200252, 'Muntaha Riaz ', 'Riaz ul Haq ', '9005', '0', '0', '0', '0', '0', '03057101549\n', '11', '0000-00-00', '0', 1, '1', 1),
(200253, 'Minahil Mehboob', 'Mehboob Ahmad', '9007', '0', '0', '0', '0', '0', '03313020221\n', '11', '0000-00-00', '0', 1, '1', 1),
(200254, 'Aleezy Toheed', 'M.Toheed', '9008', '0', '0', '0', '0', '0', '3481981153', '11', '0000-00-00', '0', 1, '1', 1),
(200255, 'Fatima Rehan', 'M. Rehan Safdar', '9009', '0', '0', '0', '0', '0', '3124596496', '11', '0000-00-00', '0', 1, '1', 1),
(200256, 'Noor ul Huda', 'khalid Mehmood', '9010', '0', '0', '0', '0', '0', '3337743770', '11', '0000-00-00', '0', 1, '1', 1),
(200257, 'Anum Nasir', 'Farrukh Hussain Nasir', '9011', '0', '0', '0', '0', '0', '03347503078\n', '11', '0000-00-00', '0', 1, '1', 1),
(200258, 'Salwa Yasir', 'Shiekh Muhammad Yasir', '9012', '0', '0', '0', '0', '0', '03347503078\n', '11', '0000-00-00', '0', 1, '1', 1),
(200259, 'Fabiayyai Yasir', 'Muhammad Yasir', '9013', '0', '0', '0', '0', '0', '03090461226\n', '11', '0000-00-00', '0', 1, '1', 1),
(200260, 'Alisha Mubashar', 'Mubashar Iqbal Ranjha', '9014', '0', '0', '0', '0', '0', '3317500795', '11', '0000-00-00', '0', 1, '1', 1),
(200261, 'Mah Noor ', 'Ashiq Ali', '9015', '0', '0', '0', '0', '0', '03217855678\n', '11', '0000-00-00', '0', 1, '1', 1),
(200262, 'Saman Gull', 'Muhammad Ramzan', '9016', '0', '0', '0', '0', '0', '3126552312', '11', '0000-00-00', '0', 1, '1', 1),
(200263, 'Samar Rafiq', 'M. Rafiq Ahmad', '9017', '0', '0', '0', '0', '0', '3086777104', '11', '0000-00-00', '0', 1, '1', 1),
(200264, 'Meerub Imran', 'Hafiz Muhammad Imran', '9018', '0', '0', '0', '0', '0', '3027009717', '11', '0000-00-00', '0', 1, '1', 1),
(200265, 'Amna Kousar', 'Abid Hussain', '9031', '0', '0', '0', '0', '0', '03207959113\n', '11', '0000-00-00', '0', 1, '1', 1),
(200266, 'Arooj Fatima', 'Tariq Ali', '9032', '0', '0', '0', '0', '0', '3016292205', '11', '0000-00-00', '0', 1, '1', 1),
(200267, 'Laiba Shakeel', 'Muhammad Shakeel', '9033', '0', '0', '0', '0', '0', '03103073206\n', '11', '0000-00-00', '0', 1, '1', 1),
(200268, 'Haleema Sadia', 'Muhammad Riaz', '9034', '0', '0', '0', '0', '0', '3011813476', '11', '0000-00-00', '0', 1, '1', 1),
(200269, 'Amna Akram', 'Muhammad Akram', '9035', '0', '0', '0', '0', '0', '3054982307', '11', '0000-00-00', '0', 1, '1', 1),
(200270, 'Zainab Munir', 'M. Munir Saleem', '9036', '0', '0', '0', '0', '0', '03332008357\n', '11', '0000-00-00', '0', 1, '1', 1),
(200271, 'Zoha Afzal', 'Muhammad Afzal', '9037', '0', '0', '0', '0', '0', '03057315062\n', '11', '0000-00-00', '0', 1, '1', 1),
(200272, 'Hajra Anjum Sohail', 'Anjum Sohail', '9039', '0', '0', '0', '0', '0', '03437620439\n', '11', '0000-00-00', '0', 1, '1', 1),
(200273, 'Nimra Amjad', 'Muhammad Amjad', '9040', '0', '0', '0', '0', '0', '3075632284', '11', '0000-00-00', '0', 1, '1', 1),
(200274, 'Zanib Zia', 'Muhammad Zia ul Haq', '9041', '0', '0', '0', '0', '0', '03317474955\n', '11', '0000-00-00', '0', 1, '1', 1),
(200275, 'Noor Fatima', 'Talat Mehmood', '9042', '0', '0', '0', '0', '0', '03086699462\n', '11', '0000-00-00', '0', 1, '1', 1),
(200276, 'Aleeza Mahfooz', 'Mahfooz Ahmad', '9043', '0', '0', '0', '0', '0', '03217946312\n', '11', '0000-00-00', '0', 1, '1', 1),
(200277, 'Momina ', 'Fiaz Ahmad', '9044', '0', '0', '0', '0', '0', '3446251304', '11', '0000-00-00', '0', 1, '1', 1),
(200278, 'Minahil Shahzad ', 'M.Shahzad Ghazanfer', '9045', '0', '0', '0', '0', '0', '03334538536\n', '11', '0000-00-00', '0', 1, '1', 1),
(200279, 'Ayesha Asif', 'Rana Asif Mahmood', '9046', '0', '0', '0', '0', '0', '3217760363', '11', '0000-00-00', '0', 1, '1', 1),
(200280, 'Momina Sajid', 'M. Rafiq Ahmad', '9047', '0', '0', '0', '0', '0', '3361410132', '11', '0000-00-00', '0', 1, '1', 1),
(200281, 'Fiza Muzamal', 'Muzamal Iqbal Nasir', '9048', '0', '0', '0', '0', '0', '3022054363', '11', '0000-00-00', '0', 1, '1', 1),
(200282, 'Maryam ', 'Muhammad Aslam', '9049', '0', '0', '0', '0', '0', '3247500916', '11', '0000-00-00', '0', 1, '1', 1),
(200283, 'Areeba', 'M. Ashraf', '9050', '0', '0', '0', '0', '0', '03377852549\n', '11', '0000-00-00', '0', 1, '1', 1),
(200284, 'Wajiha Bari', 'Ghulam Bari', '9051', '0', '0', '0', '0', '0', '3241897365', '11', '0000-00-00', '0', 1, '1', 1),
(200285, 'Faiza Naseer', 'M.Naseer', '9052', '0', '0', '0', '0', '0', '3336850622', '11', '0000-00-00', '0', 1, '1', 1),
(200286, 'Khadija Ghaffar', 'M.Abdul Ghaffar', '9053', '0', '0', '0', '0', '0', '3010650070', '11', '0000-00-00', '0', 1, '1', 1),
(200287, 'Azka Ashfaq', 'M.Ashfaq', '9054', '0', '0', '0', '0', '0', '3017070284', '11', '0000-00-00', '0', 1, '1', 1),
(200288, 'Hajra Qamar', 'Qamar', '9055', '0', '0', '0', '0', '0', '03026090364\n', '11', '0000-00-00', '0', 1, '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_fee`
--

CREATE TABLE `student_fee` (
  `feeid` int(200) NOT NULL,
  `student_id` int(200) NOT NULL,
  `submit_on` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(200) NOT NULL,
  `student_fee` int(200) NOT NULL,
  `due_fee` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subjectid` int(150) NOT NULL,
  `sub_name` varchar(150) NOT NULL,
  `sub_tec_id` int(150) NOT NULL,
  `class_id` int(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subjectid`, `sub_name`, `sub_tec_id`, `class_id`) VALUES
(1, 'English', 1, 9),
(2, 'Islamiyat', 1, 9),
(3, 'Urdu', 2, 9),
(6, 'English', 2, 10),
(7, 'Islamiyat', 3, 10),
(8, 'Urdu', 3, 10),
(9, 'English', 3, 11),
(10, 'Urdu', 8, 11),
(11, 'Islamiyat', 2, 11),
(12, 'English', 11, 12),
(13, 'Urdu', 7, 12),
(14, 'Islamiyat', 6, 12),
(15, 'English', 2, 13),
(16, 'Islamiyat', 6, 13),
(17, 'Urdu', 1, 13),
(18, 'English', 2, 14),
(19, 'Islamiyat', 1, 14),
(20, 'Urdu', 8, 14),
(22, 'Urdu', 5, 15),
(24, 'English', 2, 15),
(25, 'Islamiyat', 11, 15),
(26, 'English', 3, 7),
(27, 'Urdu', 9, 7),
(28, 'Islamiyat', 1, 7),
(29, 'PAK STUDY', 5, 7),
(30, 'English', 1, 8),
(31, 'Islamiyat', 4, 8),
(32, 'Urdu', 7, 8),
(33, 'PAK STUDY', 1, 8),
(34, 'English', 9, 6),
(35, 'Islamiyat', 18, 6),
(36, 'Urdu', 13, 6),
(37, 'PAK STUDY', 8, 6),
(38, 'English', 2, 4),
(39, 'PAK STUDY', 8, 4),
(40, 'Urdu', 12, 4),
(41, 'Math', 7, 4),
(42, 'Computer Science', 3, 4),
(43, 'English', 8, 5),
(44, 'Urdu', 4, 5),
(45, 'PAK STUDY', 7, 5),
(46, 'Computer Science', 6, 5),
(47, 'Geography', 13, 5),
(48, 'English', 2, 3),
(49, 'Urdu', 7, 3),
(50, 'PAK STUDY', 4, 3),
(51, 'Math', 2, 3),
(52, 'Physics', 14, 3),
(53, 'Chemistry', 8, 3),
(54, 'Math', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacherid` int(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `sex` varchar(100) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `blood_group` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL,
  `desig_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacherid`, `firstname`, `lastname`, `birthday`, `sex`, `religion`, `blood_group`, `address`, `phone`, `image`, `desig_id`) VALUES
(1, 'Mr.Naseem Hassan', '0', '0000-00-00', '0', '0', '0', 'Address', '923007938687', '0', 0),
(2, 'Mr.Ahsan Alam', '0', '0000-00-00', '0', '0', '0', 'Address', '923020000298', '0', 0),
(3, 'Mr.Abu Bakar  ', '0', '0000-00-00', '0', '0', '0', 'Address', '923350800214', '0', 0),
(4, 'Mr.Shafa ', '0', '0000-00-00', '0', '0', '0', 'Address', '923219689456', '0', 0),
(5, 'Mr.Mirza Luqman', '0', '0000-00-00', '0', '0', '0', 'Address', '923337728212', '0', 0),
(6, 'Mr.Hafiz Farhan', '0', '0000-00-00', '0', '0', '0', 'Address', '923016022346', '0', 0),
(7, 'Mr.Samran ', '0', '0000-00-00', '0', '0', '0', 'Address', '923428301013', '0', 0),
(8, 'Mr. Saqib Ali', '0', '0000-00-00', '0', '0', '0', 'Address', '923117216831', '0', 0),
(9, 'Mr.Akhtar Butt', '0', '0000-00-00', '0', '0', '0', 'Address', '923346277544', '0', 0),
(10, 'Mr.Adnan Sadiq', '0', '0000-00-00', '0', '0', '0', 'Address', '923326736501', '0', 0),
(11, 'Mr.Ali Gill', '0', '0000-00-00', '0', '0', '0', 'Address', '923015115920', '0', 0),
(12, 'Mr.Dildar Ali', '0', '0000-00-00', '0', '0', '0', 'Address', '923042886016', '0', 0),
(13, 'Mam Fozia', '0', '0000-00-00', '0', '0', '0', 'Address', '923018567958', '0', 0),
(14, 'Mr.Saud Ali', '0', '0000-00-00', '0', '0', '0', 'Address', '923046877181', '0', 0),
(15, 'Mr.Faiz Ur Rasool ', '0', '0000-00-00', '0', '0', '0', 'Address', '923432810414', '0', 0),
(16, 'Mr.Rashid Minhas', '0', '0000-00-00', '0', '0', '0', 'Address', '923049551687', '0', 0),
(17, 'Mam Sehar', '0', '0000-00-00', '0', '0', '0', 'Address', '923082825319', '0', 0),
(18, 'Mr.Ismail', '0', '0000-00-00', '0', '0', '0', 'Address', '923088720384', '0', 0),
(19, 'Mr.Bilal Asif', '0', '0000-00-00', '0', '0', '0', 'Address', '923063065494', '0', 0),
(20, 'Mr.Waseem', '0', '0000-00-00', '0', '0', '0', 'Address', '923013202024', '0', 0),
(21, 'Mr. Zaman Baig', '0', '0000-00-00', '0', '0', '0', 'Address', '923400074418', '0', 0),
(22, 'Mam Fareeha', '0', '0000-00-00', '0', '0', '0', 'Address', '923058431305', '0', 0),
(23, 'Mr.Waqas Aslam', '0', '0000-00-00', '0', '0', '0', 'Address', '923317416516', '0', 0),
(24, 'Mr.Ahsan', '0', '0000-00-00', '0', '0', '0', 'Address', '923157250158', '0', 0),
(25, 'Mr.Usman Akram', '0', '0000-00-00', '0', '0', '0', 'Address', '923320694357', '0', 0),
(26, 'Mr.Asad Masood', '0', '0000-00-00', '0', '0', '0', 'Address', '923080097298', '0', 0),
(27, 'Mr Aziz', '0', '0000-00-00', '0', '0', '0', 'Address', '923064884158', '0', 0),
(28, 'Mr.Toseef Ahmed', '0', '0000-00-00', '0', '0', '0', 'Address', '923410776377', '0', 0),
(29, 'Mr.Aamir Shahzad', '0', '0000-00-00', '0', '0', '0', 'Address', '923006632438', '0', 0),
(30, 'Mr.Ifrahim Gondal', '0', '0000-00-00', '0', '0', '0', 'Address', '923326576176', '0', 0),
(31, 'Mr.Moazam Mirza', '0', '0000-00-00', '0', '0', '0', 'Address', '923061316013', '0', 0),
(32, 'Mam Rabia', '0', '0000-00-00', '0', '0', '0', 'Address', '923415585140', '0', 0),
(33, 'Mr.Shahzad ', '0', '0000-00-00', '0', '0', '0', 'Address', '923006557300', '0', 0),
(34, 'Mr.Talha Farooq', '0', '0000-00-00', '0', '0', '0', 'Address', '923177677492', '0', 0),
(35, 'Mr.Naeem Khalid', '0', '0000-00-00', '0', '0', '0', 'Address', '923334551290', '0', 0),
(36, 'Mr. Imran', '0', '0000-00-00', '0', '0', '0', 'Address', '923217935143', '0', 0),
(37, 'Mr.Raheem Alvi ', '0', '0000-00-00', '0', '0', '0', 'Address', '923007295840', '0', 0),
(38, 'Mam Anam', '0', '0000-00-00', '0', '0', '0', 'Address', '923327442297', '0', 0),
(39, 'Mam Natasha', '0', '0000-00-00', '0', '0', '0', 'Address', '923096189145', '0', 0),
(40, 'Mr.Arslan   ', '0', '0000-00-00', '0', '0', '0', 'Address', '923086510341', '0', 0),
(41, 'Mam  Faiza', '0', '0000-00-00', '0', '0', '0', 'Address', '923027049361', '0', 0),
(42, 'Mr.Rashid', '0', '0000-00-00', '0', '0', '0', 'Address', '923403425846', '0', 0),
(43, 'Mr.Tahir', '0', '0000-00-00', '0', '0', '0', 'Address', '923463561158', '0', 0),
(44, 'Mr.Saqib Ali', '0', '0000-00-00', '0', '0', '0', 'Address', '923498663415', '0', 0),
(45, 'Mr.Ahmed Naseer', '0', '0000-00-00', '0', '0', '0', 'Address', '923045306771', '0', 0),
(46, 'Mr.Umer Zaman', '0', '0000-00-00', '0', '0', '0', 'Address', '923038064115', '0', 0),
(47, 'Mam Akifa', '0', '0000-00-00', '0', '0', '0', 'Address', '923009888311', '0', 0),
(48, 'Mr.Waqas Bhatii', '0', '0000-00-00', '0', '0', '0', 'Address', '923017164641', '0', 0),
(49, 'Mr.Irfan', '0', '0000-00-00', '0', '0', '0', 'Address', '923046284984', '0', 0),
(50, 'Mr.Toseef Ahmed', '0', '0000-00-00', '0', '0', '0', 'Address', '923410776377', '0', 0),
(51, 'Mr.Raza Hussain', '0', '0000-00-00', '0', '0', '0', 'Address', '923232456652', '0', 0),
(52, 'Mr. Usman Chohan', '0', '0000-00-00', '0', '0', '0', 'Address', '923157567850', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `yearly_fee`
--

CREATE TABLE `yearly_fee` (
  `yfeeid` int(200) NOT NULL,
  `student_id` int(200) NOT NULL,
  `class_id` int(200) NOT NULL,
  `bise_reg_fee` int(200) NOT NULL,
  `bise_exam_fee` int(200) NOT NULL,
  `paper_fund` int(200) NOT NULL,
  `fine` int(200) NOT NULL,
  `party_fund` int(200) NOT NULL,
  `miscellaneous` int(200) NOT NULL,
  `submit_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_fine`
--
ALTER TABLE `assign_fine`
  ADD PRIMARY KEY (`assignid`);

--
-- Indexes for table `attandance`
--
ALTER TABLE `attandance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `balance`
--
ALTER TABLE `balance`
  ADD PRIMARY KEY (`balid`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`classid`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`discid`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`examid`);

--
-- Indexes for table `fee_assign`
--
ALTER TABLE `fee_assign`
  ADD PRIMARY KEY (`feeid`);

--
-- Indexes for table `fee_type`
--
ALTER TABLE `fee_type`
  ADD PRIMARY KEY (`ftid`);

--
-- Indexes for table `fines`
--
ALTER TABLE `fines`
  ADD PRIMARY KEY (`fineid`);

--
-- Indexes for table `guest_student`
--
ALTER TABLE `guest_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `installments`
--
ALTER TABLE `installments`
  ADD PRIMARY KEY (`instaid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`loginid`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`markid`);

--
-- Indexes for table `misc_discounts`
--
ALTER TABLE `misc_discounts`
  ADD PRIMARY KEY (`miscdiscid`);

--
-- Indexes for table `raw_data`
--
ALTER TABLE `raw_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_string`
--
ALTER TABLE `raw_string`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`settingid`);

--
-- Indexes for table `sms_to_all`
--
ALTER TABLE `sms_to_all`
  ADD PRIMARY KEY (`smsid`);

--
-- Indexes for table `sms_to_class`
--
ALTER TABLE `sms_to_class`
  ADD PRIMARY KEY (`smsid`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studentid`);

--
-- Indexes for table `student_fee`
--
ALTER TABLE `student_fee`
  ADD PRIMARY KEY (`feeid`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subjectid`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacherid`);

--
-- Indexes for table `yearly_fee`
--
ALTER TABLE `yearly_fee`
  ADD PRIMARY KEY (`yfeeid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign_fine`
--
ALTER TABLE `assign_fine`
  MODIFY `assignid` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attandance`
--
ALTER TABLE `attandance`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `balance`
--
ALTER TABLE `balance`
  MODIFY `balid` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `classid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `designation_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `discid` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `examid` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_assign`
--
ALTER TABLE `fee_assign`
  MODIFY `feeid` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `fee_type`
--
ALTER TABLE `fee_type`
  MODIFY `ftid` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fines`
--
ALTER TABLE `fines`
  MODIFY `fineid` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guest_student`
--
ALTER TABLE `guest_student`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `installments`
--
ALTER TABLE `installments`
  MODIFY `instaid` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `loginid` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `markid` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `misc_discounts`
--
ALTER TABLE `misc_discounts`
  MODIFY `miscdiscid` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `raw_data`
--
ALTER TABLE `raw_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `raw_string`
--
ALTER TABLE `raw_string`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `settingid` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms_to_all`
--
ALTER TABLE `sms_to_all`
  MODIFY `smsid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sms_to_class`
--
ALTER TABLE `sms_to_class`
  MODIFY `smsid` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `studentid` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200289;

--
-- AUTO_INCREMENT for table `student_fee`
--
ALTER TABLE `student_fee`
  MODIFY `feeid` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subjectid` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacherid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `yearly_fee`
--
ALTER TABLE `yearly_fee`
  MODIFY `yfeeid` int(200) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
