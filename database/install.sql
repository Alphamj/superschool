-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 21, 2018 at 07:00 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `superschool`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_syllabus`
--

CREATE TABLE IF NOT EXISTS `academic_syllabus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `academic_syllabus_code` longtext NOT NULL,
  `title` longtext NOT NULL,
  `description` longtext NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `uploader_type` longtext NOT NULL,
  `uploader_id` int(11) NOT NULL,
  `session` longtext NOT NULL,
  `timestamp` longtext NOT NULL,
  `file_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `accountant`
--

CREATE TABLE IF NOT EXISTS `accountant` (
  `accountant_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `birthday` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `religion` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `authentication_key` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`accountant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `accountant`
--

INSERT INTO `accountant` (`accountant_id`, `name`, `birthday`, `sex`, `religion`, `blood_group`, `address`, `phone`, `email`, `password`, `authentication_key`) VALUES
(3, 'John Walex Xue', '06/10/2014', 'male', '', '', 'FEDERAL COLLEGE OF EDUCATION, OSIELE ABEOKUTA OGUN STATE', '08033527716', 'accountant@account.com', 'accountant', '');

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE IF NOT EXISTS `actions` (
  `action_id` int(11) NOT NULL AUTO_INCREMENT,
  `action_name` varchar(255) NOT NULL,
  `display` varchar(255) NOT NULL,
  `parent_name` varchar(255) DEFAULT NULL,
  `parent_key` int(5) DEFAULT NULL,
  PRIMARY KEY (`action_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=145 ;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`action_id`, `action_name`, `display`, `parent_name`, `parent_key`) VALUES
(66, 'session', 'Manage Session', 'Academics', 1),
(67, 'enquiry_setting', 'Enquiry Category', 'Academics', 1),
(68, 'enquiry', 'View Enquiries', 'Academics', 1),
(69, 'club', 'School Clubs', 'Academics', 1),
(70, 'circular', 'Manage Circular', 'Academics', 1),
(71, 'task_manager', 'Task Manager', 'Academics', 1),
(72, 'holiday', 'Manage Holiday', 'Academics', 1),
(73, 'todays_thought', 'Moral Talk', 'Academics', 1),
(74, 'academic_syllabus', 'Academic Syllabus', 'Academics', 1),
(75, 'help_link', 'Manage Help Link', 'Academics', 1),
(76, 'help_desk', 'Manage Help Desks', 'Academics', 1),
(78, 'teacher', 'Teachers', 'Manage Staff', 2),
(79, 'librarian', 'Librarians', 'Manage Staff', 2),
(80, 'accountant', 'Accountants', 'Manage Staff', 2),
(81, 'hostel', 'Hostel Manager', 'Manage Staff', 2),
(82, 'student_add', 'Admission Form', 'Manage Students', 3),
(84, 'student_information', 'List Students', 'Manage Students', 3),
(85, 'student_promotion', 'Promote Students', 'Manage Students', 3),
(86, 'manage_attendance', 'Student Attendance', 'Manage Attendance', 4),
(87, 'attendance_report', 'Attendance Report', 'Manage Attendance', 4),
(88, 'assignment', 'Assignments', 'Download Page', 5),
(89, 'study_material', 'Study Materials', 'Download Page', 5),
(90, 'parent', 'Manage Parents', '', 0),
(91, 'alumni', 'Manage Alumni', '', 0),
(92, 'media', 'Manage Media', '', 0),
(93, 'loan_applicant', 'Loan Applicant', 'Manage Loan', 6),
(94, 'loan_approval', 'Loan Approval', 'Manage Loan', 6),
(95, 'teacher_id_card', 'Teacher ID Card', 'Generate ID Cards', 7),
(96, 'id_card', 'Student ID Card', 'Generate ID Cards', 7),
(97, 'hostel_id_card', 'Hostel ID Card', 'Generate ID Cards', 7),
(98, 'accountant_id_card', 'Accountant ID Card', 'Generate ID Cards', 7),
(99, 'librarian_id_card', 'Librarian ID Card', 'Generate ID Cards', 7),
(100, 'classes', 'Manage Classes', 'Class Information', 8),
(101, 'section', 'Manage Sections', 'Class Information', 8),
(102, 'class_routine', 'Class Timetable', 'Class Information', 8),
(103, 'subject', 'subject', 'Manage Subjects', 0),
(104, 'exam_add', 'Add Exams', 'Manage CBT', 10),
(105, 'exam_list', 'List Exams', 'Manage CBT', 10),
(106, 'exam_result_list', 'View Result', 'Manage CBT', 10),
(107, 'examquestion', 'Exam Questions', 'Manage Exams', 11),
(108, 'exam', 'List Exams', 'Manage Exams', 11),
(109, 'grade', 'Exam Grades', 'Manage Exams', 11),
(110, 'marks', 'Enter Student Score', 'Report Cards', 12),
(111, 'exam_marks_sms', 'Send Scores by Sms', 'Report Cards', 12),
(112, 'tabulation_sheet', 'Generate Report Card', 'Report Cards', 12),
(113, 'student_payment', 'Collect Fees', 'Fee Collection', 13),
(114, 'income', 'Fees Payment', 'Fee Collection', 13),
(115, 'invoice', 'Manage Invoice', 'Fee Collection', 13),
(116, 'expense', 'Expense', 'Expenses', 14),
(117, 'expense_category', 'Expense Category', 'Expenses', 14),
(118, 'book', 'Master Data', 'Manage Library', 15),
(119, 'publisher', 'Book Publisher', 'Manage Library', 15),
(120, 'book_category', 'Book Category', 'Manage Library', 15),
(121, 'author', 'Book Author', 'Manage Library', 15),
(122, 'search_student', 'Register Student', 'Manage Library', 15),
(123, 'dormitory', 'Manage Hostel', 'Hostel Information', 16),
(124, 'hostel_category', 'Hostel Category', 'Hostel Information', 16),
(125, 'room_type', 'Room Type', 'Hostel Information', 16),
(126, 'hostel_room', 'Hostel Room', 'Hostel Information', 16),
(127, 'noticeboard', 'Manage Events', 'Communications', 17),
(128, 'message', 'Private Messages', 'Communications', 17),
(129, 'transport', 'Transports', 'Transportations', 18),
(130, 'transport_route', 'Transport Route', 'Transportations', 18),
(131, 'vehicle', 'Manage Vehicle', 'Transportations', 18),
(132, 'system_settings', 'General Settings', 'System Setting', 19),
(133, 'actions', 'Manage Sidebar', 'System Setting', 19),
(134, 'sms_settings', 'Manage Sms Api', 'System Setting', 19),
(135, 'email_template', 'Email Template', 'System Setting', 19),
(136, 'manage_language', 'Languages', 'System Setting', 19),
(137, 'manage_report', 'Manage Reports', 'Generate Reports', 20),
(138, 'documentation', 'View Documentation', 'Generate Reports', 20),
(139, 'banar', 'Manage Banners', 'Front End Settings', 21),
(140, 'front_end', 'System Information', 'Front End Settings', 21),
(141, 'news', 'News Settings', 'Front End Settings', 21),
(142, 'manage_profile', 'Personal Details', '', 0),
(143, 'admin_list', 'Admin List', 'Role Managements', 22),
(144, 'admin_add', 'New Admin', 'Role Managements', 22);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `level` longtext COLLATE utf8_unicode_ci NOT NULL,
  `authentication_key` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `level`, `authentication_key`) VALUES
(3, 'Admininstrator', 'admin@admin.com', 'admin', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `admin_permission`
--

CREATE TABLE IF NOT EXISTS `admin_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

CREATE TABLE IF NOT EXISTS `alumni` (
  `alumni_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `profession` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `marital_status` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `g_year` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `club` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `interest` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`alumni_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `alumni`
--

INSERT INTO `alumni` (`alumni_id`, `name`, `sex`, `phone`, `email`, `address`, `profession`, `marital_status`, `g_year`, `club`, `interest`) VALUES
(5, 'WALE', 'female', '08033527716', 'segtism@gmail.com', 'THIS IS THE ADDRESS OF THE ALUMNI, IT WORTH SHARING THANKS', 'SOFTWARE DEVELOPER', 'MARRIED', '2012', 'SCIENCE', 'READING');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `label` varchar(10) NOT NULL DEFAULT 'A',
  `content` text NOT NULL,
  PRIMARY KEY (`answer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=316 ;

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE IF NOT EXISTS `assignment` (
  `assignment_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `class_id` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `timestamp` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`assignment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `attendance_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL COMMENT '0 undefined , 1 present , 2  absent, 3 holiday, 4 half day, 5 late',
  `student_id` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`attendance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext NOT NULL,
  `description` longtext NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `name`, `description`) VALUES
(2, 'Optimum Linkup', 'Developed by Optimum Linkup Computers. All Right Reserved (2017) ');

-- --------------------------------------------------------

--
-- Table structure for table `backup`
--

CREATE TABLE IF NOT EXISTS `backup` (
  `backup_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext NOT NULL,
  PRIMARY KEY (`backup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `banar`
--

CREATE TABLE IF NOT EXISTS `banar` (
  `banar_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_text_one` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `b_text_two` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`banar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `banar`
--

INSERT INTO `banar` (`banar_id`, `b_text_one`, `b_text_two`, `file_name`) VALUES
(9, 'Enroll now and enjoy what others enjoy ! ', 'WE ARE THE BEST IN Online EDUCATION', 'banner-01.jpg'),
(10, 'We teach to become a creative thinker', 'TRY US TODAY, YOU WILL SURELY BE CONVINCE', 'banner-02.jpg'),
(11, 'We have mould lives!!!', 'LET YOUR CHILDREN ENJOY THE BENEFITS OF EDUCATION', 'banner-03.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `author_id` int(11) NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `book_category_id` int(11) NOT NULL,
  `isbn` longtext COLLATE utf8_unicode_ci NOT NULL,
  `edition` longtext COLLATE utf8_unicode_ci NOT NULL,
  `subject` longtext COLLATE utf8_unicode_ci NOT NULL,
  `quantity` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` longtext COLLATE utf8_unicode_ci NOT NULL,
  `class_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext COLLATE utf8_unicode_ci NOT NULL,
  `price` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `name`, `description`, `author_id`, `publisher_id`, `book_category_id`, `isbn`, `edition`, `subject`, `quantity`, `date`, `class_id`, `status`, `price`) VALUES
(3, 'Codeigniter', 'Science and Technology', 2, 6, 2, 'ISBN2017', '1ST', 'Prohramming(PHP)', '200', 'Fri, 03 November 2017', '4', 'available', '2000'),
(4, 'PHP', 'Developed by Optimum Linkup Computers. All Right Reserved (2017) ', 2, 6, 2, 'ISBN20172', '1ST', 'Prohramming(PHP)', '200', 'Fri, 03 November 2017', '2', 'unavailable', '4000');

-- --------------------------------------------------------

--
-- Table structure for table `book_category`
--

CREATE TABLE IF NOT EXISTS `book_category` (
  `book_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext NOT NULL,
  `description` longtext NOT NULL,
  PRIMARY KEY (`book_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `book_category`
--

INSERT INTO `book_category` (`book_category_id`, `name`, `description`) VALUES
(2, 'Sciences', 'The book is under science category');

-- --------------------------------------------------------

--
-- Table structure for table `circular`
--

CREATE TABLE IF NOT EXISTS `circular` (
  `circular_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ref` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`circular_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('0ac982dbca448ce8ee3c00a71895fa5624dec310', '127.0.0.1', 1516553500, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535333530303b),
('0fbdd4427f3c8e51164e90d68c3a1d1bbd61e0d4', '127.0.0.1', 1516468596, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363436383334373b),
('0fe1f2183afed3debc6aab2857e2d315d58d5dcc', '127.0.0.1', 1516464845, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363436343834303b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2233223b6c6f67696e5f757365725f69647c733a313a2233223b6e616d657c733a31343a2241646d696e696e73747261746f72223b6c6f67696e5f747970657c733a353a2261646d696e223b666c6173685f6d6573736167657c733a32333a2244617461204164646564205375636365737366756c6c79223b5f5f63695f766172737c613a313a7b733a31333a22666c6173685f6d657373616765223b733a333a226f6c64223b7d),
('1053d6ffc60406be582209e48f2b768fa82c2f2f', '127.0.0.1', 1516464006, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363436333735393b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2233223b6c6f67696e5f757365725f69647c733a313a2233223b6e616d657c733a31343a2241646d696e696e73747261746f72223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('10d9e061869af1363313692dfad21dd1a4462071', '127.0.0.1', 1516552789, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535323439363b),
('14b8bcacd2c4ff7d3faa568a9dc1d47f2dc81c9f', '127.0.0.1', 1516555117, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535343835393b),
('17314f04a317f0a2836af76cc5aac65da405779b', '127.0.0.1', 1516466691, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363436363438383b),
('1b16d400e7d107c0c8307ce15e56d56b198e9627', '127.0.0.1', 1516469327, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363436393237333b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2233223b6c6f67696e5f757365725f69647c733a313a2233223b6e616d657c733a31343a2241646d696e696e73747261746f72223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('20efe6c2349dad03fc80a82f047629accc3841c4', '127.0.0.1', 1516553251, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535333136333b),
('21d7d153bf076accd346426c2e51daf99181137a', '127.0.0.1', 1516554666, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535343436373b),
('24f042ad108ff4956299ff0b68f57531f71d7000', '127.0.0.1', 1516470522, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363437303330313b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2233223b6c6f67696e5f757365725f69647c733a313a2233223b6e616d657c733a31343a2241646d696e696e73747261746f72223b6c6f67696e5f747970657c733a353a2261646d696e223b666c6173685f6d6573736167657c733a31323a22446174612055706461746564223b5f5f63695f766172737c613a313a7b733a31333a22666c6173685f6d657373616765223b733a333a226f6c64223b7d),
('2889d0d2231e10f9a1c2f4b41a0c3025c209e375', '127.0.0.1', 1516472204, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363437313934373b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2233223b6c6f67696e5f757365725f69647c733a313a2233223b6e616d657c733a31343a2241646d696e696e73747261746f72223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('2fbb5e78067de8d5a0ec69d57b1eaec225eb7bb8', '127.0.0.1', 1516554056, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535343035363b),
('307b42d9653328899b5f8d7619afd044ac385768', '127.0.0.1', 1516465384, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363436353338343b),
('3ee489372266004e6ba39b97814365cd093e155e', '127.0.0.1', 1516559908, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535393637313b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2233223b6c6f67696e5f757365725f69647c733a313a2233223b6e616d657c733a31343a2241646d696e696e73747261746f72223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('45f4ba66be2ac41eba1f1b1ee7ba3babbe4fc5b7', '127.0.0.1', 1516472689, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363437323539313b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2233223b6c6f67696e5f757365725f69647c733a313a2233223b6e616d657c733a31343a2241646d696e696e73747261746f72223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('4fbf756ff2435c228d29fd217dc7301aeeabf2fb', '127.0.0.1', 1516551030, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535303937303b),
('5e320336f5c54f15040264efb89da931fb16e565', '127.0.0.1', 1516473722, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363437333435353b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2233223b6c6f67696e5f757365725f69647c733a313a2233223b6e616d657c733a31343a2241646d696e696e73747261746f72223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('5f86d661293a0a4ed0dd96c42dd20f854304469a', '127.0.0.1', 1516471252, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363437303937373b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2233223b6c6f67696e5f757365725f69647c733a313a2233223b6e616d657c733a31343a2241646d696e696e73747261746f72223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('64d589a06495563bcf7dc0e7637bcd9f20b4f5f3', '127.0.0.1', 1516558244, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535373934373b),
('6cb7b563f3dc403f550e0131e229c858ca68817b', '127.0.0.1', 1516552077, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535313834313b),
('6ef643a65186fa8da457e340c0a65f30360a89fd', '127.0.0.1', 1516462030, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363436313736303b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2233223b6c6f67696e5f757365725f69647c733a313a2233223b6e616d657c733a31343a2241646d696e696e73747261746f72223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('7791dc9ca8123fe81aeaa00af0f89b06363e72ef', '127.0.0.1', 1516463378, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363436333130393b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2233223b6c6f67696e5f757365725f69647c733a313a2233223b6e616d657c733a31343a2241646d696e696e73747261746f72223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('7b684ba2d23d6c6c957fd116c5e353623f59a460', '127.0.0.1', 1516557372, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535373337323b),
('7e96014b9bb08fbaa33f0041676d5053c98eeb1f', '127.0.0.1', 1516468911, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363436383931313b),
('80048965ff1d7a047cf9daa6eddfd896f71c54d5', '127.0.0.1', 1516550645, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535303335303b),
('8670b8c700eff7d48b8122bcc78ac8d32c960d7f', '127.0.0.1', 1516474058, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363437333830313b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2233223b6c6f67696e5f757365725f69647c733a313a2233223b6e616d657c733a31343a2241646d696e696e73747261746f72223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('8980195c9a3fdb23e397c7c92459d61c12c8b5f2', '127.0.0.1', 1516468249, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363436383030303b),
('9360a1fe58dfa58a48f062263ca6b771047c4516', '127.0.0.1', 1516461106, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363436303830363b),
('9f22645ac2d08e55d6b38a62551af09bdf6bc410', '127.0.0.1', 1516471910, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363437313633353b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2233223b6c6f67696e5f757365725f69647c733a313a2233223b6e616d657c733a31343a2241646d696e696e73747261746f72223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('abbcce010b2dadeca5d01a7e9b39a25f0b9a9303', '127.0.0.1', 1516559019, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535383538353b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2233223b6c6f67696e5f757365725f69647c733a313a2233223b6e616d657c733a31343a2241646d696e696e73747261746f72223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('b2b3054b0405316c4cb37669d04d99fda0475812', '127.0.0.1', 1516550325, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535303034323b),
('b795b002324f9a26d83fbe214f38850cbe3c3893', '127.0.0.1', 1516459619, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363435393433393b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2233223b6c6f67696e5f757365725f69647c733a313a2233223b6e616d657c733a31343a2241646d696e696e73747261746f72223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('b975ce090bd41dafafaf8e9a1dad7c69c50044d3', '127.0.0.1', 1516549491, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363534393239363b),
('ba82e026b6b748cc04c038cca0459c8d44ae302d', '127.0.0.1', 1516474243, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363437343138333b),
('bb1f54b8704b8258b4d3e74dbaf12d73b4455e10', '127.0.0.1', 1516470908, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363437303634383b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2233223b6c6f67696e5f757365725f69647c733a313a2233223b6e616d657c733a31343a2241646d696e696e73747261746f72223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('be59b23660e0f20172ff4ef9933229e636a49b3a', '127.0.0.1', 1516462466, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363436323436353b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2233223b6c6f67696e5f757365725f69647c733a313a2233223b6e616d657c733a31343a2241646d696e696e73747261746f72223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('c713c1dc1ba4f2ea75eab70e3ccfc1a74974649a', '127.0.0.1', 1516559572, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535393332373b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2233223b6c6f67696e5f757365725f69647c733a313a2233223b6e616d657c733a31343a2241646d696e696e73747261746f72223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('cae8b5f63a7c828dd849ae421444384e2a8abdfc', '127.0.0.1', 1516462380, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363436323130323b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2233223b6c6f67696e5f757365725f69647c733a313a2233223b6e616d657c733a31343a2241646d696e696e73747261746f72223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('d34d9261beace91efd61b50237f93840169b6f00', '127.0.0.1', 1516550949, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535303635313b),
('d8cae34b390ea8128627f082a81f1cf018b86708', '127.0.0.1', 1516472536, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363437323236343b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2233223b6c6f67696e5f757365725f69647c733a313a2233223b6e616d657c733a31343a2241646d696e696e73747261746f72223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('d9da9083222899416c9581ec10a2a01dc749515c', '127.0.0.1', 1516549904, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363534393733353b),
('de21b40705e819e493674256cf94988833fdbf07', '127.0.0.1', 1516463741, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363436333435323b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2233223b6c6f67696e5f757365725f69647c733a313a2233223b6e616d657c733a31343a2241646d696e696e73747261746f72223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('e4a5f973e30f370fbb342017d6ed519f92cbb29c', '127.0.0.1', 1516464477, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363436343136393b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2233223b6c6f67696e5f757365725f69647c733a313a2233223b6e616d657c733a31343a2241646d696e696e73747261746f72223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('e76c3252f574dab7258e0290675f6e33f465cd01', '127.0.0.1', 1516471580, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363437313238383b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2233223b6c6f67696e5f757365725f69647c733a313a2233223b6e616d657c733a31343a2241646d696e696e73747261746f72223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('ec8fd4fe74d3eef6e6853b4a25a95c1653163274', '127.0.0.1', 1516553013, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535323830333b),
('f36b1365a813db70adc5d5ae45bad5136ec9f2ed', '127.0.0.1', 1516466889, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363436363838393b),
('f399b3aaa94144549d47f25e153f2c20ff7a2a53', '127.0.0.1', 1516552261, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535323134373b),
('f69f4c476f8cb914b4710a7d3bb44427a61bd5cb', '127.0.0.1', 1516557674, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535373337323b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2233223b6c6f67696e5f757365725f69647c733a313a2233223b6e616d657c733a31343a2241646d696e696e73747261746f72223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('fdefd70e27f96fa5838ca08c92838ca51a11fff2', '127.0.0.1', 1516464766, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363436343530313b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2233223b6c6f67696e5f757365725f69647c733a313a2233223b6e616d657c733a31343a2241646d696e696e73747261746f72223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('fe67215dc3deaa7b57eee1351c88554a907ef5f6', '127.0.0.1', 1516466332, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363436363134383b),
('ff817fe3e0f1cba21d1f2ebf681acf621182f08a', '127.0.0.1', 1516473361, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363437333131393b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2233223b6c6f67696e5f757365725f69647c733a313a2233223b6e616d657c733a31343a2241646d696e696e73747261746f72223b6c6f67696e5f747970657c733a353a2261646d696e223b);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `name_numeric` longtext COLLATE utf8_unicode_ci NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `name`, `name_numeric`, `teacher_id`) VALUES
(1, 'Primary One', 'Pry 1', 2),
(2, 'Primary Two', 'Pry 2', 3);

-- --------------------------------------------------------

--
-- Table structure for table `class_routine`
--

CREATE TABLE IF NOT EXISTS `class_routine` (
  `class_routine_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `time_start` int(11) NOT NULL,
  `time_end` int(11) NOT NULL,
  `time_start_min` int(11) NOT NULL,
  `time_end_min` int(11) NOT NULL,
  `day` longtext COLLATE utf8_unicode_ci NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `room` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`class_routine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE IF NOT EXISTS `club` (
  `club_id` int(11) NOT NULL AUTO_INCREMENT,
  `club_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `desc` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`club_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `document_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `file_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `file_type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `class_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`document_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `dormitory`
--

CREATE TABLE IF NOT EXISTS `dormitory` (
  `dormitory_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `hostel_room_id` int(11) NOT NULL,
  `hostel_category_id` int(11) NOT NULL,
  `capacity` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`dormitory_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

CREATE TABLE IF NOT EXISTS `email_template` (
  `email_template_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_type` longtext NOT NULL,
  `subject` longtext NOT NULL,
  `from_email` longtext NOT NULL,
  `from_name` longtext NOT NULL,
  `email_content` longtext NOT NULL,
  `date` longtext NOT NULL,
  PRIMARY KEY (`email_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE IF NOT EXISTS `enquiry` (
  `enquiry_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mobile` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `purpose` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `whom_to_meet` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`enquiry_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_category`
--

CREATE TABLE IF NOT EXISTS `enquiry_category` (
  `enquirycat_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `purpose` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `whom` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`enquirycat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `enquiry_category`
--

INSERT INTO `enquiry_category` (`enquirycat_id`, `category`, `purpose`, `whom`) VALUES
(1, 'Parent', 'For Admission', 'Teacher'),
(2, 'Vendors', 'Admission Enquiry', 'Principal'),
(3, 'School Staff', 'Payment Collection', 'Director'),
(4, 'Visitors', 'Student Performance', 'Administrative Office'),
(5, 'Service Man', 'Complaints by Parent', 'Reception'),
(6, 'Others', 'Student Leave Early', 'Student'),
(7, 'Book', 'Confidential', 'Registrar'),
(8, 'Payment', 'Invoice ', 'Others'),
(9, 'Event', 'Others', 'Fee Office');

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE IF NOT EXISTS `enroll` (
  `enroll_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `from_class_id` int(11) NOT NULL,
  `to_class_id` int(11) NOT NULL,
  PRIMARY KEY (`enroll_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE IF NOT EXISTS `exam` (
  `exam_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` longtext COLLATE utf8_unicode_ci NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`exam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `examquestion`
--

CREATE TABLE IF NOT EXISTS `examquestion` (
  `examquestion_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `class_id` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext NOT NULL,
  PRIMARY KEY (`examquestion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exam_result`
--

CREATE TABLE IF NOT EXISTS `exam_result` (
  `result_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`result_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=224 ;

-- --------------------------------------------------------

--
-- Table structure for table `expense_category`
--

CREATE TABLE IF NOT EXISTS `expense_category` (
  `expense_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`expense_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `front_end`
--

CREATE TABLE IF NOT EXISTS `front_end` (
  `front_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`front_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `front_end`
--

INSERT INTO `front_end` (`front_id`, `type`, `description`) VALUES
(3, 'about_us', 'Our ultimate goal is our customer satisfaction to the extent to which customers are happy with the products & services provided by us. We also converts clients business ideas into new products & application for their increased productivity & efficiency of the office/ management staff. \r\n<br><br>\r\nOur ultimate goal is our customer satisfaction to the extent to which customers are happy with the products & services provided by us. We also converts clients business ideas into new products & application for their increased productivity & efficiency of the office/ management staff. '),
(4, 'vission', 'VISSION The first stage is to have you fund your wallet instantly and invest in Bank Emerald1'),
(5, 'mission', 'MISSION The first stage is to have you fund your wallet instantly and invest in Bank Emerald1'),
(6, 'goal', 'GOAL The first stage is to have you fund your wallet instantly and invest in Bank Emerald1'),
(7, 'services', 'SERVICES At Bank Emerald, our range of services are as below with description. Services we render are reliable and profitable.'),
(8, 'youtube', '<iframe width="560" height="315" src="https://www.youtube.com/embed/568gmKtpe7k" frameborder="0" allowfullscreen></iframe>'),
(9, 'news', 'Please take your time to know more about us by reading our articles/news all the time. This will enable you to know more about our activities. '),
(10, 'teacher', 'Meet our able, gallant and most competent teachers that will help your children/child to attain higher success in life. We teach to become a creative thinker and to be useful to the society.'),
(11, 'event', 'Please take your time to go through or view all our event and or activities that take place in our school. We give first hand informatino to our various students and the entire school management staff.'),
(12, 'testimonies', 'Hear what people are saying about us. You will surely be convince about our school.'),
(13, 'map', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.38305199714!2d3.4514324141631905!3d7.19706151696447!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103a365ade21ec59%3A0xbd837c80b563d9e8!2sFederal+College+of+Education!5e0!3m2!1sen!2sng!4v1502022972559" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>		'),
(14, 'facebook', 'https://facebook.com/optimumlinkup'),
(15, 'twitter', 'https://twitter.com/optimumlinkup'),
(16, 'linkedin', 'https://linkedin.com/optimumlinkup'),
(17, 'instagram', 'https://pinterest.com/optimumlinkup'),
(18, 'full_about', 'Our ultimate goal is our customer satisfaction to the extent to which customers are happy with the products & services provided by us. We also converts clients business ideas into new products & application for their increased productivity & efficiency of the office/ management staff. \r\nOur ultimate goal is our customer satisfaction to the extent to which customers are happy with the products & services provided by us. We also converts clients business ideas into new products & application for their increased productivity & efficiency of the office/ management staff. '),
(19, 'footer_text', 'Meet our able, gallant and most competent teachers that will help your children/child to attain higher success in life. We teach to become a creative thinker and to be useful to the society.'),
(20, 'reg', 'Register here to get online access to your account. Hurry Short Time Offer!!!');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `gallery_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`gallery_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`gallery_id`, `title`, `content`, `file_name`, `date`) VALUES
(1, 'This is the end of the year party', 'This is the end of the year party. The programme was so wonderful.', 'team-03.jpg', '0000-00-00 00:00:00'),
(2, 'Commission of the new buildiing ', 'The new building was commissioned by the state commissional.', 'images.jpg', '07/26/2017');

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE IF NOT EXISTS `grade` (
  `grade_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `grade_point` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mark_from` int(11) NOT NULL,
  `mark_upto` int(11) NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`grade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `help_desk`
--

CREATE TABLE IF NOT EXISTS `help_desk` (
  `helpdesk_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `purpose` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`helpdesk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `help_link`
--

CREATE TABLE IF NOT EXISTS `help_link` (
  `helplink_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `link` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `class_id` int(11) NOT NULL,
  PRIMARY KEY (`helplink_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE IF NOT EXISTS `holiday` (
  `holiday_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `holiday` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`holiday_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hostel`
--

CREATE TABLE IF NOT EXISTS `hostel` (
  `hostel_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `birthday` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `religion` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `authentication_key` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`hostel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hostel_category`
--

CREATE TABLE IF NOT EXISTS `hostel_category` (
  `hostel_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext NOT NULL,
  `description` longtext NOT NULL,
  PRIMARY KEY (`hostel_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hostel_room`
--

CREATE TABLE IF NOT EXISTS `hostel_room` (
  `hostel_room_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `num_bed` longtext NOT NULL,
  `cost_bed` longtext NOT NULL,
  `description` longtext NOT NULL,
  PRIMARY KEY (`hostel_room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `amount_paid` longtext COLLATE utf8_unicode_ci NOT NULL,
  `due` longtext COLLATE utf8_unicode_ci NOT NULL,
  `creation_timestamp` int(11) NOT NULL,
  `payment_timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` longtext COLLATE utf8_unicode_ci NOT NULL,
  `payment_details` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'paid or unpaid',
  PRIMARY KEY (`invoice_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `phrase_id` int(11) NOT NULL AUTO_INCREMENT,
  `phrase` longtext COLLATE utf8_unicode_ci NOT NULL,
  `english` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bengali` longtext COLLATE utf8_unicode_ci NOT NULL,
  `spanish` longtext COLLATE utf8_unicode_ci NOT NULL,
  `arabic` longtext COLLATE utf8_unicode_ci NOT NULL,
  `dutch` longtext COLLATE utf8_unicode_ci NOT NULL,
  `russian` longtext COLLATE utf8_unicode_ci NOT NULL,
  `chinese` longtext COLLATE utf8_unicode_ci NOT NULL,
  `turkish` longtext COLLATE utf8_unicode_ci NOT NULL,
  `portuguese` longtext COLLATE utf8_unicode_ci NOT NULL,
  `hungarian` longtext COLLATE utf8_unicode_ci NOT NULL,
  `french` longtext COLLATE utf8_unicode_ci NOT NULL,
  `greek` longtext COLLATE utf8_unicode_ci NOT NULL,
  `german` longtext COLLATE utf8_unicode_ci NOT NULL,
  `italian` longtext COLLATE utf8_unicode_ci NOT NULL,
  `thai` longtext COLLATE utf8_unicode_ci NOT NULL,
  `urdu` longtext COLLATE utf8_unicode_ci NOT NULL,
  `hindi` longtext COLLATE utf8_unicode_ci NOT NULL,
  `latin` longtext COLLATE utf8_unicode_ci NOT NULL,
  `indonesian` longtext COLLATE utf8_unicode_ci NOT NULL,
  `japanese` longtext COLLATE utf8_unicode_ci NOT NULL,
  `korean` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`phrase_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18743 ;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `bengali`, `spanish`, `arabic`, `dutch`, `russian`, `chinese`, `turkish`, `portuguese`, `hungarian`, `french`, `greek`, `german`, `italian`, `thai`, `urdu`, `hindi`, `latin`, `indonesian`, `japanese`, `korean`) VALUES
(1, 'login', 'login', '', 'login', 'تسجيل الدخول', 'login', 'Ãâ€™ÃÂ¾ÃÂ¹Ã‘â€šÃÂ¸', 'login', 'giriÃ…Å¸', 'login', 'bejelentkezÃƒÂ©s', 'Connexion', 'ÃÆ’ÃÂÃŽÂ½ÃŽÂ´ÃŽÂµÃÆ’ÃŽÂ·', 'Login', 'login', 'Ã Â¹â‚¬Ã Â¸â€šÃ Â¹â€°Ã Â¸Â²Ã Â¸ÂªÃ Â¸Â¹Ã Â¹Ë†Ã Â¸Â£Ã Â¸Â°Ã Â¸Å¡Ã Â¸Å¡', 'Ã™â€žÃ˜Â§ÃšÂ¯ Ã˜Â§Ã™â€ ', 'Ã Â¤Â²Ã Â¥â€°Ã Â¤â€”Ã Â¤Â¿Ã Â¤Â¨', 'login', 'login', 'Ã£Æ’Â­Ã£â€šÂ°Ã£â€šÂ¤Ã£Æ’Â³', 'Ã«Â¡Å“ÃªÂ·Â¸Ã¬ÂÂ¸'),
(2, 'account_type', 'account type', '', 'tipo de cuenta', 'نوع الحساب', 'type account', 'Ã‘â€šÃÂ¸ÃÂ¿ Ã‘ÂÃ‘â€¡ÃÂµÃ‘â€šÃÂ°', 'Ã¨Â´Â¦Ã¦Ë†Â·Ã§Â±Â»Ã¥Å¾â€¹', 'hesap tÃƒÂ¼rÃƒÂ¼', 'tipo de conta', 'fiÃƒÂ³k tÃƒÂ­pusÃƒÂ¡t', 'Type de compte', 'Ãâ€žÃŽÂ¿ÃŽÂ½ Ãâ€žÃÂÃâ‚¬ÃŽÂ¿ Ãâ€žÃŽÂ¿Ãâ€¦ ÃŽÂ»ÃŽÂ¿ÃŽÂ³ÃŽÂ±ÃÂÃŽÂ¹ÃŽÂ±ÃÆ’ÃŽÂ¼ÃŽÂ¿ÃÂ', 'Kontotyp', 'tipo di account', 'Ã Â¸â€ºÃ Â¸Â£Ã Â¸Â°Ã Â¹â‚¬Ã Â¸Â Ã Â¸â€”Ã Â¸Å¡Ã Â¸Â±Ã Â¸ÂÃ Â¸Å Ã Â¸Âµ', 'Ã˜Â§ÃšÂ©Ã˜Â§Ã˜Â¤Ã™â€ Ã™Â¹ ÃšÂ©Ã›Å’ Ã™â€šÃ˜Â³Ã™â€¦', 'Ã Â¤â€“Ã Â¤Â¾Ã Â¤Â¤Ã Â¤Â¾ Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¤â€¢Ã Â¤Â¾Ã Â¤Â°', 'propter speciem', 'Jenis akun', 'Ã¥ÂÂ£Ã¥ÂºÂ§Ã£ÂÂ®Ã§Â¨Â®Ã©Â¡Å¾', 'ÃªÂ³â€žÃ¬Â â€¢ Ã¬Å“Â Ã­Ëœâ€¢'),
(3, 'admin', 'admin', '', 'administraciÃƒÂ³n', 'مشرف', 'admin', 'ÃÂ°ÃÂ´ÃÂ¼ÃÂ¸ÃÂ½', 'Ã§Â®Â¡Ã§Ââ€ ', 'yÃƒÂ¶netim', 'administrador', 'admin', 'administrateur', 'Ãâ€žÃŽÂ¿ admin', 'Admin', 'Admin', 'Ã Â¸Å“Ã Â¸Â¹Ã Â¹â€°Ã Â¸â€Ã Â¸Â¹Ã Â¹ÂÃ Â¸Â¥Ã Â¸Â£Ã Â¸Â°Ã Â¸Å¡Ã Â¸Å¡', 'Ã™â€¦Ã™â€ Ã˜ÂªÃ˜Â¸Ã™â€¦', 'Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¤Â¶Ã Â¤Â¾Ã Â¤Â¸Ã Â¤Â¨', 'Lorem ipsum dolor sit', 'admin', 'Ã§Â®Â¡Ã§Ââ€ Ã¨â‚¬â€¦', 'ÃªÂ´â‚¬Ã«Â¦Â¬Ã¬Å¾Â'),
(4, 'teacher', 'teacher', '', 'profesor', 'مدرس', 'leraar', 'Ã‘Æ’Ã‘â€¡ÃÂ¸Ã‘â€šÃÂµÃÂ»Ã‘Å’', 'Ã¨â‚¬ÂÃ¥Â¸Ë†', 'ÃƒÂ¶Ã„Å¸retmen', 'professor', 'tanÃƒÂ¡r', 'professeur', 'ÃŽÂ´ÃŽÂ¬ÃÆ’ÃŽÂºÃŽÂ±ÃŽÂ»ÃŽÂ¿Ãâ€š', 'Lehrer', 'insegnante', 'Ã Â¸â€žÃ Â¸Â£Ã Â¸Â¹', 'Ã˜Â§Ã˜Â³Ã˜ÂªÃ˜Â§Ã˜Â¯', 'Ã Â¤Â¶Ã Â¤Â¿Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â·Ã Â¤â€¢', 'Magister', 'guru', 'Ã¦â€¢â„¢Ã¥Â¸Â«', 'Ã¬â€žÂ Ã¬Æ’Â'),
(5, 'student', 'student', '', 'estudiante', 'طالب علم', 'student', 'Ã‘ÂÃ‘â€šÃ‘Æ’ÃÂ´ÃÂµÃÂ½Ã‘â€š', 'Ã¥Â­Â¦Ã§â€Å¸', 'ÃƒÂ¶Ã„Å¸renci', 'estudante', 'diÃƒÂ¡k', 'ÃƒÂ©tudiant', 'Ãâ€ ÃŽÂ¿ÃŽÂ¹Ãâ€žÃŽÂ·Ãâ€žÃŽÂ®Ãâ€š', 'SchÃƒÂ¼ler', 'studente', 'Ã Â¸â„¢Ã Â¸Â±Ã Â¸ÂÃ Â¹â‚¬Ã Â¸Â£Ã Â¸ÂµÃ Â¸Â¢Ã Â¸â„¢', 'Ã˜Â·Ã˜Â§Ã™â€žÃ˜Â¨ Ã˜Â¹Ã™â€žÃ™â€¦', 'Ã Â¤â€ºÃ Â¤Â¾Ã Â¤Â¤Ã Â¥ÂÃ Â¤Â°', 'discipulo', 'mahasiswa', 'Ã¥Â­Â¦Ã§â€Å¸', 'Ã­â€¢â„¢Ã¬Æ’Â'),
(6, 'parent', 'parent', '', 'padre', 'الأبوين', 'ouder', 'Ã‘â‚¬ÃÂ¾ÃÂ´ÃÂ¸Ã‘â€šÃÂµÃÂ»Ã‘Å’', 'Ã¤ÂºÂ²', 'ebeveyn', 'parente', 'szÃƒÂ¼lÃ…â€˜', 'mÃƒÂ¨re', 'ÃŽÂ¼ÃŽÂ·Ãâ€žÃÂÃŽÂ¹ÃŽÂºÃŽÂ® ÃŽÂµÃâ€žÃŽÂ±ÃŽÂ¹ÃÂÃŽÂµÃŽÂ¯ÃŽÂ±', 'Elternteil', 'genitore', 'Ã Â¸Å“Ã Â¸Â¹Ã Â¹â€°Ã Â¸â€ºÃ Â¸ÂÃ Â¸â€žÃ Â¸Â£Ã Â¸Â­Ã Â¸â€¡', 'Ã™Ë†Ã˜Â§Ã™â€žÃ˜Â¯Ã›Å’Ã™â€ ', 'Ã Â¤Â®Ã Â¤Â¾Ã Â¤Â¤Ã Â¤Â¾ - Ã Â¤ÂªÃ Â¤Â¿Ã Â¤Â¤Ã Â¤Â¾', 'parente', 'induk', 'Ã¨Â¦Âª', 'Ã«Â¶â‚¬Ã«ÂªÂ¨Ã¬ÂËœ'),
(7, 'email', 'email', '', 'email', 'البريد الإلكتروني', 'e-mail', 'ÃÂ¿ÃÂ¾ Ã‘ÂÃÂ»ÃÂµÃÂºÃ‘â€šÃ‘â‚¬ÃÂ¾ÃÂ½ÃÂ½ÃÂ¾ÃÂ¹ ÃÂ¿ÃÂ¾Ã‘â€¡Ã‘â€šÃÂµ', 'Ã§â€ÂµÃ¥Â­ÂÃ©â€šÂ®Ã¤Â»Â¶', 'E-posta', 'e-mail', 'E-mail', 'email', 'e-mail', 'E-Mail-', 'e-mail', 'Ã Â¸Â­Ã Â¸ÂµÃ Â¹â‚¬Ã Â¸Â¡Ã Â¸Â¥Ã Â¹Å’', 'Ã˜Â§Ã›Å’ Ã™â€¦Ã›Å’Ã™â€ž', 'Ã Â¤Ë†Ã Â¤Â®Ã Â¥â€¡Ã Â¤Â²', 'email', 'email', 'Ã£Æ’Â¡Ã£Æ’Â¼Ã£Æ’Â«', 'Ã¬ÂÂ´Ã«Â©â€Ã¬ÂÂ¼'),
(8, 'password', 'password', '', 'contraseÃƒÂ±a', 'كلمه السر', 'wachtwoord', 'ÃÂ¿ÃÂ°Ã‘â‚¬ÃÂ¾ÃÂ»Ã‘Å’', 'Ã¥Â¯â€ Ã§Â Â', 'Ã…Å¸ifre', 'senha', 'jelszÃƒÂ³', 'mot de passe', 'Ãâ€žÃŽÂ¿ÃŽÂ½ ÃŽÂºÃâ€°ÃŽÂ´ÃŽÂ¹ÃŽÂºÃÅ’', 'Passwort', 'password', 'Ã Â¸Â£Ã Â¸Â«Ã Â¸Â±Ã Â¸ÂªÃ Â¸Å“Ã Â¹Ë†Ã Â¸Â²Ã Â¸â„¢', 'Ã™Â¾Ã˜Â§Ã˜Â³', 'Ã Â¤ÂªÃ Â¤Â¾Ã Â¤Â¸Ã Â¤ÂµÃ Â¤Â°Ã Â¥ÂÃ Â¤Â¡', 'Signum', 'kata sandi', 'Ã£Æ’â€˜Ã£â€šÂ¹Ã£Æ’Â¯Ã£Æ’Â¼Ã£Æ’â€°', 'Ã¬â€¢â€Ã­ËœÂ¸'),
(9, 'forgot_password ?', 'forgot password ?', '', 'Ã‚Â¿OlvidÃƒÂ³ su contraseÃƒÂ±a?', 'هل نسيت كلمة المرور ؟', 'wachtwoord vergeten?', 'ÃÂ·ÃÂ°ÃÂ±Ã‘â€¹ÃÂ»ÃÂ¸ ÃÂ¿ÃÂ°Ã‘â‚¬ÃÂ¾ÃÂ»Ã‘Å’?', 'Ã¥Â¿ËœÃ¨Â®Â°Ã¥Â¯â€ Ã§Â ÂÃ¯Â¼Å¸', 'Ã…Å¾ifremi unuttum?', 'Esqueceu a senha?', 'Elfelejtett jelszÃƒÂ³?', 'Mot de passe oubliÃƒÂ©?', 'ÃŽÅ¾ÃŽÂµÃâ€¡ÃŽÂ¬ÃÆ’ÃŽÂ±Ãâ€žÃŽÂµ Ãâ€žÃŽÂ¿ÃŽÂ½ ÃŽÂºÃâ€°ÃŽÂ´ÃŽÂ¹ÃŽÂºÃÅ’;', 'Passwort vergessen?', 'dimenticato la password?', 'Ã Â¸Â¥Ã Â¸Â·Ã Â¸Â¡Ã Â¸Â£Ã Â¸Â«Ã Â¸Â±Ã Â¸ÂªÃ Â¸Å“Ã Â¹Ë†Ã Â¸Â²Ã Â¸â„¢', 'Ã™Â¾Ã˜Â§Ã˜Â³ Ã™Ë†Ã˜Â±ÃšË† Ã˜Â¨ÃšÂ¾Ã™Ë†Ã™â€ž ÃšÂ¯Ã›Å’Ã˜Â§Ã˜Å¸', 'Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â¯Ã Â¤Â¾ Ã Â¤Â¸Ã Â¤â€šÃ Â¤Â­Ã Â¤Â¾Ã Â¤ÂµÃ Â¤Â¨Ã Â¤Â¾Ã Â¤ÂÃ Â¤â€š Ã Â¤Â¹Ã Â¥Ë†Ã Â¤â€š?', 'oblitus esne verbi?', 'lupa password?', 'Ã£Æ’â€˜Ã£â€šÂ¹Ã£Æ’Â¯Ã£Æ’Â¼Ã£Æ’â€°Ã£â€šâ€™Ã¥Â¿ËœÃ£â€šÅ’Ã£ÂÅ¸Ã¯Â¼Å¸', 'Ã«Â¹â€žÃ«Â°â‚¬Ã«Â²Ë†Ã­ËœÂ¸Ã«Â¥Â¼ Ã¬Å¾Å Ã¬Å“Â¼ Ã¬â€¦Â¨Ã«â€šËœÃ¬Å¡â€?'),
(10, 'reset_password', 'reset password', '', 'restablecer la contraseÃƒÂ±a', 'إعادة تعيين', 'reset wachtwoord', 'Ã‘ÂÃÂ±Ã‘â‚¬ÃÂ¾Ã‘ÂÃÂ¸Ã‘â€šÃ‘Å’ ÃÂ¿ÃÂ°Ã‘â‚¬ÃÂ¾ÃÂ»Ã‘Å’', 'Ã©â€¡ÂÃ¨Â®Â¾Ã¥Â¯â€ Ã§Â Â', 'Ã…Å¸ifrenizi sÃ„Â±fÃ„Â±rlamak', 'redefinir a senha', 'JelszÃƒÂ³ visszaÃƒÂ¡llÃƒÂ­tÃƒÂ¡sa', 'rÃƒÂ©initialiser le mot de passe', 'ÃŽÂµÃâ‚¬ÃŽÂ±ÃŽÂ½ÃŽÂ±Ãâ€ ÃŽÂ­ÃÂÃŽÂµÃâ€žÃŽÂµ Ãâ€žÃŽÂ¿ÃŽÂ½ ÃŽÂºÃâ€°ÃŽÂ´ÃŽÂ¹ÃŽÂºÃÅ’ Ãâ‚¬ÃÂÃÅ’ÃÆ’ÃŽÂ²ÃŽÂ±ÃÆ’ÃŽÂ·Ãâ€š', 'Kennwort zurÃƒÂ¼cksetzen', 'reimpostare la password', 'Ã Â¸â€¢Ã Â¸Â±Ã Â¹â€°Ã Â¸â€¡Ã Â¸â€žÃ Â¹Ë†Ã Â¸Â²Ã Â¸Â£Ã Â¸Â«Ã Â¸Â±Ã Â¸ÂªÃ Â¸Å“Ã Â¹Ë†Ã Â¸Â²Ã Â¸â„¢', 'Ã™Â¾Ã˜Â§Ã˜Â³ Ã™Ë†Ã˜Â±ÃšË† Ã˜Â±Ã›Å’ Ã˜Â³Ã›Å’Ã™Â¹', 'Ã Â¤ÂªÃ Â¤Â¾Ã Â¤Â¸Ã Â¤ÂµÃ Â¤Â°Ã Â¥ÂÃ Â¤Â¡ Ã Â¤Â°Ã Â¥â‚¬Ã Â¤Â¸Ã Â¥â€¡Ã Â¤Å¸', 'Duis adipiscing', 'reset password', 'Ã£Æ’â€˜Ã£â€šÂ¹Ã£Æ’Â¯Ã£Æ’Â¼Ã£Æ’â€°Ã£â€šâ€™Ã¥â€ ÂÃ¨Â¨Â­Ã¥Â®Å¡Ã£Ââ„¢Ã£â€šâ€¹', 'Ã¬â€¢â€Ã­ËœÂ¸Ã«Â¥Â¼ Ã¬Å¾Â¬Ã¬â€žÂ¤Ã¬Â â€¢'),
(11, 'reset', 'reset', '', 'reajustar', 'إعادة تعيين', 'reset', 'Ã‘ÂÃÂ±Ã‘â‚¬ÃÂ¾Ã‘Â', 'Ã©â€¡ÂÃ§Â½Â®', 'ayarlamak', 'restabelecer', 'vissza', 'remettre', 'ÃŽÂµÃâ‚¬ÃŽÂ±ÃŽÂ½ÃŽÂ±Ãâ€ ÃŽÂ¿ÃÂÃŽÂ¬', 'rÃƒÂ¼cksetzen', 'reset', 'Ã Â¸â€¢Ã Â¸Â±Ã Â¹â€°Ã Â¸â€¡Ã Â¹Æ’Ã Â¸Â«Ã Â¸Â¡Ã Â¹Ë†', 'Ã˜Â±Ã›Å’ Ã˜Â³Ã›Å’Ã™Â¹', 'Ã Â¤Â°Ã Â¥â‚¬Ã Â¤Â¸Ã Â¥â€¡Ã Â¤Å¸ Ã Â¤â€¢Ã Â¤Â°Ã Â¥â€¡Ã Â¤â€š', 'Duis', 'ulang', 'Ã£Æ’ÂªÃ£â€šÂ»Ã£Æ’Æ’Ã£Æ’Ë†', 'Ã¬Å¾Â¬Ã¬â€žÂ¤Ã¬Â â€¢'),
(17843, 'manage_media', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(12, 'admin_dashboard', 'admin dashboard', '', 'administrador salpicadero', 'لوحة القيادة', 'admin dashboard', 'ÃÂ°ÃÂ´ÃÂ¼ÃÂ¸ÃÂ½ ÃÂ¿ÃÂ°ÃÂ½ÃÂµÃÂ»Ã‘Å’', 'Ã§Â®Â¡Ã§Ââ€ Ã©ÂÂ¢Ã¦ÂÂ¿', 'Admin paneli', 'Admin Dashboard', 'admin mÃ…Â±szerfal', 'administrateur tableau de bord', 'Ãâ‚¬ÃŽÂ¯ÃŽÂ½ÃŽÂ±ÃŽÂºÃŽÂ± ÃŽÂµÃŽÂ»ÃŽÂ­ÃŽÂ³Ãâ€¡ÃŽÂ¿Ãâ€¦ Ãâ€žÃŽÂ¿Ãâ€¦ ÃŽÂ´ÃŽÂ¹ÃŽÂ±Ãâ€¡ÃŽÂµÃŽÂ¹ÃÂÃŽÂ¹ÃÆ’Ãâ€žÃŽÂ®', 'Admin-Dashboard', 'Admin Dashboard', 'Ã Â¹ÂÃ Â¸Å“Ã Â¸â€¡Ã Â¸â€žÃ Â¸Â§Ã Â¸Å¡Ã Â¸â€žÃ Â¸Â¸Ã Â¸Â¡Ã Â¸â€šÃ Â¸Â­Ã Â¸â€¡Ã Â¸Å“Ã Â¸Â¹Ã Â¹â€°Ã Â¸â€Ã Â¸Â¹Ã Â¹ÂÃ Â¸Â¥Ã Â¸Â£Ã Â¸Â°Ã Â¸Å¡Ã Â¸Å¡', 'Ã˜Â§Ã›Å’ÃšË†Ã™â€¦Ã™â€  ÃšË†Ã›Å’Ã˜Â´ Ã˜Â¨Ã™Ë†Ã˜Â±ÃšË†', 'Ã Â¤ÂµÃ Â¥ÂÃ Â¤Â¯Ã Â¤ÂµÃ Â¤Â¸Ã Â¥ÂÃ Â¤Â¥Ã Â¤Â¾Ã Â¤ÂªÃ Â¤â€¢ Ã Â¤Â¡Ã Â¥Ë†Ã Â¤Â¶Ã Â¤Â¬Ã Â¥â€¹Ã Â¤Â°Ã Â¥ÂÃ Â¤Â¡', 'Lorem ipsum dolor sit Dashboard', 'admin dashboard', 'Ã§Â®Â¡Ã§Ââ€ Ã£Æ’â‚¬Ã£Æ’Æ’Ã£â€šÂ·Ã£Æ’Â¥Ã£Æ’Å“Ã£Æ’Â¼Ã£Æ’â€°', 'ÃªÂ´â‚¬Ã«Â¦Â¬Ã¬Å¾Â Ã«Å’â‚¬Ã¬â€¹Å“ Ã«Â³Â´Ã«â€œÅ“'),
(13, 'account', 'account', '', 'cuenta', 'الحساب', 'rekening', 'Ã‘ÂÃ‘â€¡ÃÂµÃ‘â€š', 'Ã¥Â¸ÂÃ¦Ë†Â·', 'hesap', 'conta', 'szÃƒÂ¡mla', 'compte', 'ÃŽÂ»ÃŽÂ¿ÃŽÂ³ÃŽÂ±ÃÂÃŽÂ¹ÃŽÂ±ÃÆ’ÃŽÂ¼ÃÅ’Ãâ€š', 'Konto', 'conto', 'Ã Â¸Å¡Ã Â¸Â±Ã Â¸ÂÃ Â¸Å Ã Â¸Âµ', 'Ã˜Â§ÃšÂ©Ã˜Â§Ã˜Â¤Ã™â€ Ã™Â¹', 'Ã Â¤â€“Ã Â¤Â¾Ã Â¤Â¤Ã Â¤Â¾', 'propter', 'rekening', 'Ã£â€šÂ¢Ã£â€šÂ«Ã£â€šÂ¦Ã£Æ’Â³Ã£Æ’Ë†', 'ÃªÂ³â€žÃ¬Â â€¢'),
(14, 'profile', 'profile', '', 'perfil', 'الملف الشخصي', 'profiel', 'ÃÂ¿Ã‘â‚¬ÃÂ¾Ã‘â€žÃÂ¸ÃÂ»Ã‘Å’', 'Ã¨Â½Â®Ã¥Â»â€œ', 'profil', 'perfil', 'profil', 'profil', 'Ãâ‚¬ÃÂÃŽÂ¿Ãâ€ ÃŽÂ¯ÃŽÂ»', 'Profil', 'profilo', 'Ã Â¹â€šÃ Â¸â€ºÃ Â¸Â£Ã Â¹â€žÃ Â¸Å¸Ã Â¸Â¥Ã Â¹Å’', 'Ã™Â¾Ã˜Â±Ã™Ë†Ã™ÂÃ˜Â§Ã˜Â¦Ã™â€ž', 'Ã Â¤Â°Ã Â¥â€šÃ Â¤ÂªÃ Â¤Â°Ã Â¥â€¡Ã Â¤â€“Ã Â¤Â¾', 'profile', 'profil', 'Ã£Æ’â€”Ã£Æ’Â­Ã£Æ’â€¢Ã£â€šÂ£Ã£Æ’Â¼Ã£Æ’Â«', 'Ã­â€â€žÃ«Â¡Å“Ã­â€¢â€ž'),
(15, 'change_password', 'change password', '', 'cambiar la contraseÃƒÂ±a', 'تغيير كلمة السر', 'wachtwoord wijzigen', 'ÃÂ¸ÃÂ·ÃÂ¼ÃÂµÃÂ½ÃÂ¸Ã‘â€šÃ‘Å’ ÃÂ¿ÃÂ°Ã‘â‚¬ÃÂ¾ÃÂ»Ã‘Å’', 'Ã¦â€ºÂ´Ã¦â€Â¹Ã¥Â¯â€ Ã§Â Â', 'Ã…Å¸ifresini deÃ„Å¸iÃ…Å¸tirmek', 'alterar a senha', 'jelszÃƒÂ³ megvÃƒÂ¡ltoztatÃƒÂ¡sa', 'changer le mot de passe', 'ÃŽÂ±ÃŽÂ»ÃŽÂ»ÃŽÂ¬ÃŽÂ¾ÃŽÂµÃâ€žÃŽÂµ Ãâ€žÃŽÂ¿ÃŽÂ½ ÃŽÂºÃâ€°ÃŽÂ´ÃŽÂ¹ÃŽÂºÃÅ’ Ãâ‚¬ÃÂÃÅ’ÃÆ’ÃŽÂ²ÃŽÂ±ÃÆ’ÃŽÂ·Ãâ€š', 'Kennwort ÃƒÂ¤ndern', 'cambiare la password', 'Ã Â¹â‚¬Ã Â¸â€ºÃ Â¸Â¥Ã Â¸ÂµÃ Â¹Ë†Ã Â¸Â¢Ã Â¸â„¢Ã Â¸Â£Ã Â¸Â«Ã Â¸Â±Ã Â¸ÂªÃ Â¸Å“Ã Â¹Ë†Ã Â¸Â²Ã Â¸â„¢', 'Ã™Â¾Ã˜Â§Ã˜Â³ Ã™Ë†Ã˜Â±ÃšË† Ã˜ÂªÃ˜Â¨Ã˜Â¯Ã›Å’Ã™â€ž', 'Ã Â¤ÂªÃ Â¤Â¾Ã Â¤Â¸Ã Â¤ÂµÃ Â¤Â°Ã Â¥ÂÃ Â¤Â¡ Ã Â¤ÂªÃ Â¤Â°Ã Â¤Â¿Ã Â¤ÂµÃ Â¤Â°Ã Â¥ÂÃ Â¤Â¤Ã Â¤Â¿Ã Â¤Â¤', 'mutare password', 'mengubah password', 'Ã£Æ’â€˜Ã£â€šÂ¹Ã£Æ’Â¯Ã£Æ’Â¼Ã£Æ’â€°Ã£â€šâ€™Ã¥Â¤â€°Ã¦â€ºÂ´Ã£Ââ„¢Ã£â€šâ€¹', 'Ã¬â€¢â€Ã­ËœÂ¸Ã«Â¥Â¼ Ã«Â³â‚¬ÃªÂ²Â½'),
(16, 'logout', 'logout', '', 'logout', 'الخروج', 'logout', 'ÃÂ²Ã‘â€¹Ã‘â€¦ÃÂ¾ÃÂ´', 'Ã¦Â³Â¨Ã©â€â‚¬', 'logout', 'Sair', 'logout', 'DÃƒÂ©connexion', 'ÃŽÂ±Ãâ‚¬ÃŽÂ¿ÃÆ’ÃÂÃŽÂ½ÃŽÂ´ÃŽÂµÃÆ’ÃŽÂ·', 'logout', 'Esci', 'Ã Â¸Â­Ã Â¸Â­Ã Â¸ÂÃ Â¸Ë†Ã Â¸Â²Ã Â¸ÂÃ Â¸Â£Ã Â¸Â°Ã Â¸Å¡Ã Â¸Å¡', 'Ã™â€žÃ˜Â§ÃšÂ¯ Ã˜Â¢Ã˜Â¤Ã™Â¹ ÃšÂ©Ã˜Â±Ã›Å’ÃšÂº', 'Ã Â¤Â²Ã Â¥â€°Ã Â¤â€”Ã Â¤â€ Ã Â¤â€°Ã Â¤Å¸', 'logout', 'logout', 'Ã£Æ’Â­Ã£â€šÂ°Ã£â€šÂ¢Ã£â€šÂ¦Ã£Æ’Ë†', 'Ã«Â¡Å“ÃªÂ·Â¸ Ã¬â€¢â€žÃ¬â€ºÆ’'),
(17, 'panel', 'panel', '', 'panel', 'فريق', 'paneel', 'ÃÂ¿ÃÂ°ÃÂ½ÃÂµÃÂ»Ã‘Å’', 'Ã©ÂÂ¢Ã¦ÂÂ¿', 'panel', 'painel', 'bizottsÃƒÂ¡g', 'panneau', 'Ãâ‚¬ÃŽÂ¯ÃŽÂ½ÃŽÂ±ÃŽÂºÃŽÂ±Ãâ€š', 'Platte', 'pannello', 'Ã Â¹ÂÃ Â¸Å“Ã Â¸â€¡Ã Â¸Â«Ã Â¸â„¢Ã Â¹â€°Ã Â¸Â²Ã Â¸â€ºÃ Â¸Â±Ã Â¸â€', 'Ã™Â¾Ã›Å’Ã™â€ Ã™â€ž', 'Ã Â¤ÂªÃ Â¥Ë†Ã Â¤Â¨Ã Â¤Â²', 'panel', 'panel', 'Ã£Æ’â€˜Ã£Æ’ÂÃ£Æ’Â«', 'Ã­Å’Â¨Ã«â€žÂ'),
(18, 'dashboard_help', 'dashboard help', '', 'salpicadero ayuda', 'مساعدة لوحة القيادة', 'dashboard hulp', 'ÃÅ¸Ã‘â‚¬ÃÂ¸ÃÂ±ÃÂ¾Ã‘â‚¬ÃÂ½ÃÂ°Ã‘Â ÃÂ¿ÃÂ°ÃÂ½ÃÂµÃÂ»Ã‘Å’ ÃÂ¿ÃÂ¾ÃÂ¼ÃÂ¾Ã‘â€°Ã‘Å’', 'Ã¤Â»ÂªÃ¨Â¡Â¨Ã¦ÂÂ¿Ã¥Â¸Â®Ã¥Å Â©', 'pano yardÃ„Â±m', 'dashboard ajuda', 'mÃ…Â±szerfal help', 'tableau de bord aide', 'Ãâ€žÃŽÂ±ÃŽÂ¼Ãâ‚¬ÃŽÂ»ÃÅ’ ÃŽÂ²ÃŽÂ¿ÃŽÂ®ÃŽÂ¸ÃŽÂµÃŽÂ¹ÃŽÂ±', 'Dashboard-Hilfe', 'dashboard aiuto', 'Ã Â¹ÂÃ Â¸Å“Ã Â¸â€¡Ã Â¸â€žÃ Â¸Â§Ã Â¸Å¡Ã Â¸â€žÃ Â¸Â¸Ã Â¸Â¡Ã Â¸â€žÃ Â¸Â§Ã Â¸Â²Ã Â¸Â¡Ã Â¸Å Ã Â¹Ë†Ã Â¸Â§Ã Â¸Â¢Ã Â¹â‚¬Ã Â¸Â«Ã Â¸Â¥Ã Â¸Â·Ã Â¸Â­', 'ÃšË†Ã›Å’Ã˜Â´ Ã˜Â¨Ã™Ë†Ã˜Â±ÃšË† Ã™â€¦Ã˜Â¯Ã˜Â¯', 'Ã Â¤Â¡Ã Â¥Ë†Ã Â¤Â¶Ã Â¤Â¬Ã Â¥â€¹Ã Â¤Â°Ã Â¥ÂÃ Â¤Â¡ Ã Â¤Â®Ã Â¤Â¦Ã Â¤Â¦', 'Dashboard auxilium', 'dashboard bantuan', 'Ã£Æ’â‚¬Ã£Æ’Æ’Ã£â€šÂ·Ã£Æ’Â¥Ã£Æ’Å“Ã£Æ’Â¼Ã£Æ’â€°Ã£Æ’ËœÃ£Æ’Â«Ã£Æ’â€”', 'Ã«Å’â‚¬Ã¬â€¹Å“ Ã«Â³Â´Ã«â€œÅ“ Ã«Ââ€žÃ¬â€ºâ‚¬Ã«Â§Â'),
(19, 'dashboard', 'dashboard', '', 'salpicadero', 'لوحة القيادة', 'dashboard', 'ÃÂ¿Ã‘â‚¬ÃÂ¸ÃÂ±ÃÂ¾Ã‘â‚¬ÃÂ½ÃÂ°Ã‘Â ÃÂ¿ÃÂ°ÃÂ½ÃÂµÃÂ»Ã‘Å’', 'Ã¤Â»ÂªÃ¨Â¡Â¨Ã§â€ºËœ', 'gÃƒÂ¶sterge paneli', 'painel de instrumentos', 'mÃ…Â±szerfal', 'tableau de bord', 'Ãâ€žÃŽÂ±ÃŽÂ¼Ãâ‚¬ÃŽÂ»ÃÅ’', 'Armaturenbrett', 'cruscotto', 'Ã Â¸Â«Ã Â¸â„¢Ã Â¹â€°Ã Â¸Â²Ã Â¸â€ºÃ Â¸Â±Ã Â¸â€', 'ÃšË†Ã›Å’Ã˜Â´ Ã˜Â¨Ã™Ë†Ã˜Â±ÃšË†', 'Ã Â¤Â¡Ã Â¥Ë†Ã Â¤Â¶Ã Â¤Â¬Ã Â¥â€¹Ã Â¤Â°Ã Â¥ÂÃ Â¤Â¡', 'Dashboard', 'dasbor', 'Ã£Æ’â‚¬Ã£Æ’Æ’Ã£â€šÂ·Ã£Æ’Â¥Ã£Æ’Å“Ã£Æ’Â¼Ã£Æ’â€°', 'ÃªÂ³â€žÃªÂ¸Â°Ã­Å’Â'),
(20, 'student_help', 'student help', '', 'ayuda estudiantil', 'مساعدة الطالب', 'student hulp', 'Ã‘ÂÃ‘â€šÃ‘Æ’ÃÂ´ÃÂµÃÂ½Ã‘â€š ÃÂ¿ÃÂ¾ÃÂ¼ÃÂ¾Ã‘â€°Ã‘Å’', 'Ã¥Â­Â¦Ã§â€Å¸Ã§Å¡â€žÃ¥Â¸Â®Ã¥Å Â©', 'Ãƒâ€“Ã„Å¸renci yardÃ„Â±m', 'ajuda estudante', 'diÃƒÂ¡k segÃƒÂ­tsÃƒÂ©gÃƒÂ©vel', 'aide aux ÃƒÂ©tudiants', 'Ãâ€ ÃŽÂ¿ÃŽÂ¹Ãâ€žÃŽÂ·Ãâ€žÃŽÂ®Ãâ€š ÃŽÂ²ÃŽÂ¿ÃŽÂ®ÃŽÂ¸ÃŽÂµÃŽÂ¹ÃŽÂ±', 'SchÃƒÂ¼ler-Hilfe', 'help studente', 'Ã Â¸Å Ã Â¹Ë†Ã Â¸Â§Ã Â¸Â¢Ã Â¹â‚¬Ã Â¸Â«Ã Â¸Â¥Ã Â¸Â·Ã Â¸Â­Ã Â¸â„¢Ã Â¸Â±Ã Â¸ÂÃ Â¹â‚¬Ã Â¸Â£Ã Â¸ÂµÃ Â¸Â¢Ã Â¸â„¢', 'Ã˜Â·Ã˜Â§Ã™â€žÃ˜Â¨ Ã˜Â¹Ã™â€žÃ™â€¦ ÃšÂ©Ã›Å’ Ã™â€¦Ã˜Â¯Ã˜Â¯', 'Ã Â¤â€ºÃ Â¤Â¾Ã Â¤Â¤Ã Â¥ÂÃ Â¤Â° Ã Â¤Â®Ã Â¤Â¦Ã Â¤Â¦', 'Discipulus auxilium', 'membantu siswa', 'Ã¥Â­Â¦Ã§â€Å¸Ã£ÂÂ®Ã£Æ’ËœÃ£Æ’Â«Ã£Æ’â€”', 'Ã­â€¢â„¢Ã¬Æ’Â Ã«Ââ€žÃ¬â€ºâ‚¬Ã«Â§Â'),
(21, 'teacher_help', 'teacher help', '', 'ayuda del maestro', 'مساعدة', 'leraar hulp', 'ÃÂ£Ã‘â€¡ÃÂ¸Ã‘â€šÃÂµÃÂ»Ã‘Å’ ÃÂ¿ÃÂ¾ÃÂ¼ÃÂ¾Ã‘â€°Ã‘Å’', 'Ã¨â‚¬ÂÃ¥Â¸Ë†Ã§Å¡â€žÃ¥Â¸Â®Ã¥Å Â©', 'ÃƒÂ¶Ã„Å¸retmen yardÃ„Â±m', 'ajuda de professores', 'tanÃƒÂ¡r segÃƒÂ­tsÃƒÂ©gÃƒÂ©vel', 'aide de l''enseignant', 'ÃŽÂ²ÃŽÂ¿ÃŽÂ®ÃŽÂ¸ÃŽÂµÃŽÂ¹ÃŽÂ± Ãâ€žÃâ€°ÃŽÂ½ ÃŽÂµÃŽÂºÃâ‚¬ÃŽÂ±ÃŽÂ¹ÃŽÂ´ÃŽÂµÃâ€¦Ãâ€žÃŽÂ¹ÃŽÂºÃÅ½ÃŽÂ½', 'Lehrer-Hilfe', 'aiuto dell''insegnante', 'Ã Â¸â€žÃ Â¸Â£Ã Â¸Â¹Ã Â¸Å Ã Â¹Ë†Ã Â¸Â§Ã Â¸Â¢Ã Â¹â‚¬Ã Â¸Â«Ã Â¸Â¥Ã Â¸Â·Ã Â¸Â­', 'Ã˜Â§Ã˜Â³Ã˜ÂªÃ˜Â§Ã˜Â¯ ÃšÂ©Ã›Å’ Ã™â€¦Ã˜Â¯Ã˜Â¯', 'Ã Â¤Â¶Ã Â¤Â¿Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â·Ã Â¤â€¢ Ã Â¤Â®Ã Â¤Â¦Ã Â¤Â¦', 'doctor auxilium', 'bantuan guru', 'Ã¦â€¢â„¢Ã¥Â¸Â«Ã£ÂÂ®Ã£Æ’ËœÃ£Æ’Â«Ã£Æ’â€”', 'ÃªÂµÂÃ¬â€šÂ¬Ã¬ÂËœ Ã«Ââ€žÃ¬â€ºâ‚¬'),
(22, 'subject_help', 'subject help', '', 'ayuda sujeto', 'مساعدة الطالب', 'Onderwerp hulp', 'Ãâ€”ÃÂ°ÃÂ³ÃÂ¾ÃÂ»ÃÂ¾ÃÂ²ÃÂ¾ÃÂº ÃÂ¿ÃÂ¾ÃÂ¼ÃÂ¾Ã‘â€°Ã‘Å’', 'Ã¤Â¸Â»Ã©Â¢ËœÃ¥Â¸Â®Ã¥Å Â©', 'konusu yardÃ„Â±m', 'ajuda assunto', 'tÃƒÂ¡rgy segÃƒÂ­tsÃƒÂ©gÃƒÂ©vel', 'l''objet de l''aide', 'Ãâ€¦Ãâ‚¬ÃÅ’ÃŽÂºÃŽÂµÃŽÂ¹ÃŽÂ½Ãâ€žÃŽÂ±ÃŽÂ¹ ÃŽÂ²ÃŽÂ¿ÃŽÂ®ÃŽÂ¸ÃŽÂµÃŽÂ¹ÃŽÂ±', 'Thema Hilfe', 'Aiuto Subject', 'Ã Â¸â€žÃ Â¸Â§Ã Â¸Â²Ã Â¸Â¡Ã Â¸Å Ã Â¹Ë†Ã Â¸Â§Ã Â¸Â¢Ã Â¹â‚¬Ã Â¸Â«Ã Â¸Â¥Ã Â¸Â·Ã Â¸Â­Ã Â¹â‚¬Ã Â¸Â£Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸â€¡', 'Ã™â€¦Ã™Ë†Ã˜Â¶Ã™Ë†Ã˜Â¹ Ã™â€¦Ã˜Â¯Ã˜Â¯', 'Ã Â¤ÂµÃ Â¤Â¿Ã Â¤Â·Ã Â¤Â¯ Ã Â¤Â®Ã Â¤Â¦Ã Â¤Â¦', 'agitur salus', 'bantuan subjek', 'Ã¤Â»Â¶Ã¥ÂÂÃ£Æ’ËœÃ£Æ’Â«Ã£Æ’â€”', 'Ã¬Â£Â¼Ã¬Â Å“ Ã«Ââ€žÃ¬â€ºâ‚¬'),
(23, 'subject', 'subject', '', 'sujeto', 'موضوع', 'onderwerp', 'Ã‘â€šÃÂµÃÂ¼ÃÂ°', 'Ã¤Â¸Â»Ã©Â¢Ëœ', 'konu', 'assunto', 'tÃƒÂ¡rgy', 'sujet', 'ÃŽÂ¸ÃŽÂ­ÃŽÂ¼ÃŽÂ±', 'Thema', 'soggetto', 'Ã Â¹â‚¬Ã Â¸Â£Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸â€¡', 'Ã™â€¦Ã™Ë†Ã˜Â¶Ã™Ë†Ã˜Â¹', 'Ã Â¤ÂµÃ Â¤Â¿Ã Â¤Â·Ã Â¤Â¯', 'agitur', 'subyek', 'Ã£Æ’â€ Ã£Æ’Â¼Ã£Æ’Å¾', 'Ã¬Â Å“Ã«ÂªÂ©'),
(24, 'class_help', 'class help', '', 'clase de ayuda', 'صف دراسي', 'klasse hulp', 'ÃÅ¡ÃÂ»ÃÂ°Ã‘ÂÃ‘Â ÃÂ¿ÃÂ¾ÃÂ¼ÃÂ¾Ã‘â€°Ã‘Å’', 'Ã§Â±Â»Ã§Å¡â€žÃ¥Â¸Â®Ã¥Å Â©', 'sÃ„Â±nÃ„Â±f yardÃ„Â±m', 'classe ajuda', 'osztÃƒÂ¡ly segÃƒÂ­tsÃƒÂ©gÃƒÂ©vel', 'aide de la classe', 'ÃŽÅ¡ÃŽÂ±Ãâ€žÃŽÂ·ÃŽÂ³ÃŽÂ¿ÃÂÃŽÂ¯ÃŽÂ± ÃŽÂ²ÃŽÂ¿ÃŽÂ®ÃŽÂ¸ÃŽÂµÃŽÂ¹ÃŽÂ±', 'Klasse Hilfe', 'help classe', 'Ã Â¸â€žÃ Â¸Â§Ã Â¸Â²Ã Â¸Â¡Ã Â¸Å Ã Â¹Ë†Ã Â¸Â§Ã Â¸Â¢Ã Â¹â‚¬Ã Â¸Â«Ã Â¸Â¥Ã Â¸Â·Ã Â¸Â­Ã Â¹Æ’Ã Â¸â„¢Ã Â¸Å Ã Â¸Â±Ã Â¹â€°Ã Â¸â„¢Ã Â¹â‚¬Ã Â¸Â£Ã Â¸ÂµÃ Â¸Â¢Ã Â¸â„¢', 'ÃšÂ©Ã™â€žÃ˜Â§Ã˜Â³ Ã™â€¦Ã˜Â¯Ã˜Â¯', 'Ã Â¤â€¢Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â·Ã Â¤Â¾ Ã Â¤Â®Ã Â¤Â¦Ã Â¤Â¦', 'genus auxilii', 'kelas bantuan', 'Ã£â€šÂ¯Ã£Æ’Â©Ã£â€šÂ¹Ã£ÂÂ®Ã£Æ’ËœÃ£Æ’Â«Ã£Æ’â€”', 'Ã­ÂÂ´Ã«Å¾ËœÃ¬Å Â¤ Ã«Ââ€žÃ¬â€ºâ‚¬'),
(18502, 'system_footer', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18501, 'running_session', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(25, 'class', 'class', '', 'clase', 'صف دراسي', 'klasse', 'ÃÂºÃÂ»ÃÂ°Ã‘ÂÃ‘Â', 'Ã§Â±Â»', 'sÃ„Â±nÃ„Â±f', 'classe', 'osztÃƒÂ¡ly', 'classe', 'ÃŽÂºÃŽÂ±Ãâ€žÃŽÂ·ÃŽÂ³ÃŽÂ¿ÃÂÃŽÂ¯ÃŽÂ±', 'Klasse', 'classe', 'Ã Â¸Å Ã Â¸Â±Ã Â¹â€°Ã Â¸â„¢', 'ÃšÂ©Ã™â€žÃ˜Â§Ã˜Â³', 'Ã Â¤ÂµÃ Â¤Â°Ã Â¥ÂÃ Â¤â€”', 'class', 'kelas', 'Ã£â€šÂ¯Ã£Æ’Â©Ã£â€šÂ¹', 'Ã­ÂÂ´Ã«Å¾ËœÃ¬Å Â¤'),
(26, 'exam_help', 'exam help', '', 'ayuda examen', 'مساعدة الامتحان', 'examen hulp', 'ÃÂ­ÃÂºÃÂ·ÃÂ°ÃÂ¼ÃÂµÃÂ½ ÃÂ¿ÃÂ¾ÃÂ¼ÃÂ¾Ã‘â€°Ã‘Å’', 'Ã¨â‚¬Æ’Ã¨Â¯â€¢Ã¥Â¸Â®Ã¥Å Â©', 'sÃ„Â±nav yardÃ„Â±m', 'exame ajuda', 'vizsga help', 'aide ÃƒÂ  l''examen', 'ÃŽÂµÃŽÂ¾ÃŽÂµÃâ€žÃŽÂ¬ÃÆ’ÃŽÂµÃŽÂ¹Ãâ€š ÃŽÂ²ÃŽÂ¿ÃŽÂ®ÃŽÂ¸ÃŽÂµÃŽÂ¹ÃŽÂ±', 'PrÃƒÂ¼fung Hilfe', 'esame di guida', 'Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸ÂªÃ Â¸Â­Ã Â¸Å¡Ã Â¸â€žÃ Â¸Â§Ã Â¸Â²Ã Â¸Â¡Ã Â¸Å Ã Â¹Ë†Ã Â¸Â§Ã Â¸Â¢Ã Â¹â‚¬Ã Â¸Â«Ã Â¸Â¥Ã Â¸Â·Ã Â¸Â­', 'Ã˜Â§Ã™â€¦Ã˜ÂªÃ˜Â­Ã˜Â§Ã™â€  Ã™â€¦Ã˜Â¯Ã˜Â¯', 'Ã Â¤ÂªÃ Â¤Â°Ã Â¥â‚¬Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â·Ã Â¤Â¾ Ã Â¤Â®Ã Â¤Â¦Ã Â¤Â¦', 'ipsum Auxilium', 'ujian bantuan', 'Ã¨Â©Â¦Ã©Â¨â€œÃ£Æ’ËœÃ£Æ’Â«Ã£Æ’â€”', 'Ã¬â€¹Å“Ã­â€”ËœÃ¬â€”Â Ã«Ââ€žÃ¬â€ºâ‚¬'),
(17840, 'study_materials', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(27, 'exam', 'exam', '', 'examen', 'امتحان', 'tentamen', 'Ã‘ÂÃÂºÃÂ·ÃÂ°ÃÂ¼ÃÂµÃÂ½', 'Ã¨â‚¬Æ’Ã¨Â¯â€¢', 'sÃ„Â±nav', 'exame', 'vizsgÃƒÂ¡lat', 'exam', 'ÃŽÂµÃŽÂ¾ÃŽÂ­Ãâ€žÃŽÂ±ÃÆ’ÃŽÂ·', 'PrÃƒÂ¼fung', 'esame', 'Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸ÂªÃ Â¸Â­Ã Â¸Å¡', 'Ã˜Â§Ã™â€¦Ã˜ÂªÃ˜Â­Ã˜Â§Ã™â€ ', 'Ã Â¤ÂªÃ Â¤Â°Ã Â¥â‚¬Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â·Ã Â¤Â¾', 'Lorem ipsum', 'ujian', 'Ã¨Â©Â¦Ã©Â¨â€œ', 'Ã¬â€¹Å“Ã­â€”Ëœ'),
(28, 'marks_help', 'marks help', '', 'marcas ayudan', 'علامات', 'markeringen helpen', 'ÃÂ¼ÃÂµÃ‘â€šÃÂºÃÂ¸ ÃÂ¿ÃÂ¾ÃÂ¼ÃÂ¾ÃÂ³ÃÂ°Ã‘Å½Ã‘â€š', 'Ã¦Â â€¡Ã¨Â®Â°Ã¥Â¸Â®Ã¥Å Â©', 'iÃ…Å¸aretleri yardÃ„Â±m', 'marcas ajudar', 'jelek segÃƒÂ­tenek', 'marques aident', 'ÃÆ’ÃŽÂ®ÃŽÂ¼ÃŽÂ±Ãâ€žÃŽÂ± ÃŽÂ²ÃŽÂ¿ÃŽÂ·ÃŽÂ¸ÃŽÂ®ÃÆ’ÃŽÂµÃŽÂ¹', 'Markierungen helfen', 'segni aiutano', 'Ã Â¹â‚¬Ã Â¸â€žÃ Â¸Â£Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸â€¡Ã Â¸Â«Ã Â¸Â¡Ã Â¸Â²Ã Â¸Â¢Ã Â¸Å Ã Â¹Ë†Ã Â¸Â§Ã Â¸Â¢', 'Ã™â€ Ã™â€¦Ã˜Â¨Ã˜Â± Ã™â€¦Ã˜Â¯Ã˜Â¯', 'Ã Â¤Â¨Ã Â¤Â¿Ã Â¤Â¶Ã Â¤Â¾Ã Â¤Â¨ Ã Â¤Â®Ã Â¤Â¦Ã Â¤Â¦', 'notas auxilio', 'tanda membantu', 'Ã£Æ’Å¾Ã£Æ’Â¼Ã£â€šÂ¯Ã£ÂÂ®Ã£Æ’ËœÃ£Æ’Â«Ã£Æ’â€”', 'Ã«Â§Ë†Ã­ÂÂ¬Ã«Å â€ Ã«ÂÂ° Ã«Ââ€žÃ¬â€ºâ‚¬Ã¬ÂÂ´'),
(29, 'marks-attendance', 'marks-attendance', '', 'marcas-asistencia', 'علامات-الحضور', 'merken-deelname', 'ÃÂ·ÃÂ½ÃÂ°ÃÂºÃÂ¸-ÃÂ¿ÃÂ¾Ã‘ÂÃÂµÃ‘â€°ÃÂ°ÃÂµÃÂ¼ÃÂ¾Ã‘ÂÃ‘â€šÃÂ¸', 'Ã¦Â â€¡Ã¨Â®Â°Ã§Â¼ÂºÃ¥Â¸Â­', 'iÃ…Å¸aretleri-katÃ„Â±lÃ„Â±m', 'marcas de comparecimento', 'jelek-ellÃƒÂ¡tÃƒÂ¡s', 'marques-participation', 'ÃÆ’ÃŽÂ®ÃŽÂ¼ÃŽÂ±Ãâ€žÃŽÂ± Ãâ‚¬ÃÂÃŽÂ¿ÃÆ’ÃŽÂ­ÃŽÂ»ÃŽÂµÃâ€¦ÃÆ’ÃŽÂ·', 'Marken-Teilnahme', 'marchi-presenze', 'Ã Â¹â‚¬Ã Â¸â€žÃ Â¸Â£Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸â€¡Ã Â¸Â«Ã Â¸Â¡Ã Â¸Â²Ã Â¸Â¢Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¹â‚¬Ã Â¸â€šÃ Â¹â€°Ã Â¸Â²Ã Â¸Â£Ã Â¹Ë†Ã Â¸Â§Ã Â¸Â¡', 'Ã™â€ Ã™â€¦Ã˜Â¨Ã˜Â± Ã˜Â­Ã˜Â§Ã˜Â¶Ã˜Â±Ã›Å’', 'Ã Â¤Â¨Ã Â¤Â¿Ã Â¤Â¶Ã Â¤Â¾Ã Â¤Â¨ Ã Â¤â€°Ã Â¤ÂªÃ Â¤Â¸Ã Â¥ÂÃ Â¤Â¥Ã Â¤Â¿Ã Â¤Â¤Ã Â¤Â¿', 'signa eius ministrabant,', 'tanda-pertemuan', 'Ã£Æ’Å¾Ã£Æ’Â¼Ã£â€šÂ¯Ã‚Â·Ã¥â€¡ÂºÃ¥Â¸Â­', 'Ã«Â§Ë†Ã­ÂÂ¬ Ã¬Â¶Å“Ã¬â€žÂ'),
(30, 'grade_help', 'grade help', '', 'ayuda de grado', 'درجة', 'leerjaar hulp', 'ÃÂ¾Ã‘â€ ÃÂµÃÂ½ÃÂºÃÂ° ÃÂ¿ÃÂ¾ÃÂ¼ÃÂ¾Ã‘â€°Ã‘Å’', 'Ã§ÂºÂ§Ã¥Â¸Â®Ã¥Å Â©', 'sÃ„Â±nÃ„Â±f yardÃ„Â±m', 'ajuda grau', 'fokozat help', 'aide de qualitÃƒÂ©', 'ÃŽÂ²ÃŽÂ±ÃŽÂ¸ÃŽÂ¼ÃŽÂ¿ÃÂ ÃŽÂ²ÃŽÂ¿ÃŽÂ®ÃŽÂ¸ÃŽÂµÃŽÂ¹ÃŽÂ±', 'Grade-Hilfe', 'aiuto grade', 'Ã Â¸Å Ã Â¹Ë†Ã Â¸Â§Ã Â¸Â¢Ã Â¹â‚¬Ã Â¸Â«Ã Â¸Â¥Ã Â¸Â·Ã Â¸Â­Ã Â¹â‚¬Ã Â¸ÂÃ Â¸Â£Ã Â¸â€', 'ÃšÂ¯Ã˜Â±Ã›Å’ÃšË† Ã™â€¦Ã˜Â¯Ã˜Â¯', 'Ã Â¤â€”Ã Â¥ÂÃ Â¤Â°Ã Â¥â€¡Ã Â¤Â¡ Ã Â¤Â®Ã Â¤Â¦Ã Â¤Â¦', 'gradus ope', 'kelas bantuan', 'Ã£â€šÂ°Ã£Æ’Â¬Ã£Æ’Â¼Ã£Æ’â€°Ã£ÂÂ®Ã£Æ’ËœÃ£Æ’Â«Ã£Æ’â€”', 'ÃªÂ¸â€° Ã«Ââ€žÃ¬â€ºâ‚¬'),
(31, 'exam-grade', 'exam-grade', '', 'examen de grado', 'امتحان الصف', 'examen-grade', 'Ã‘ÂÃÂºÃÂ·ÃÂ°ÃÂ¼ÃÂµÃÂ½ ÃÂºÃÂ»ÃÂ°Ã‘ÂÃ‘ÂÃÂ°', 'Ã¨â‚¬Æ’Ã¨Â¯â€¢Ã§ÂºÂ§Ã¥Ë†Â«', 'sÃ„Â±nav notu', 'exame de grau', 'vizsga-grade', 'examen de qualitÃƒÂ©', 'ÃŽÂµÃŽÂ¾ÃŽÂµÃâ€žÃŽÂ¬ÃÆ’ÃŽÂµÃŽÂ¹Ãâ€š Ãâ‚¬ÃŽÂ¿ÃŽÂ¹ÃÅ’Ãâ€žÃŽÂ·Ãâ€žÃŽÂ±Ãâ€š', 'PrÃƒÂ¼fung-Grade', 'esami-grade', 'Ã Â¸ÂªÃ Â¸Â­Ã Â¸Å¡Ã Â¹â‚¬Ã Â¸ÂÃ Â¸Â£Ã Â¸â€', 'Ã˜Â§Ã™â€¦Ã˜ÂªÃ˜Â­Ã˜Â§Ã™â€  ÃšÂ¯Ã˜Â±Ã›Å’ÃšË†', 'Ã Â¤ÂªÃ Â¤Â°Ã Â¥â‚¬Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â·Ã Â¤Â¾ Ã Â¤â€”Ã Â¥ÂÃ Â¤Â°Ã Â¥â€¡Ã Â¤Â¡', 'ipsum turpis,', 'ujian-grade', 'Ã¨Â©Â¦Ã©Â¨â€œÃ£â€šÂ°Ã£Æ’Â¬Ã£Æ’Â¼Ã£Æ’â€°', 'Ã¬â€¹Å“Ã­â€”Ëœ Ã«â€œÂ±ÃªÂ¸â€°'),
(32, 'class_routine_help', 'class routine help', '', 'clase ayuda rutina', 'مساعدة روتينية رفيعة المستوى', 'klasroutine hulp', 'ÃÂºÃÂ»ÃÂ°Ã‘ÂÃ‘Â Ã‘â‚¬Ã‘Æ’Ã‘â€šÃÂ¸ÃÂ½ÃÂ° ÃÂ¿ÃÂ¾ÃÂ¼ÃÂ¾Ã‘â€°Ã‘Å’', 'Ã§Â±Â»Ã¥Â¸Â¸Ã¨Â§â€žÃ¥Â¸Â®Ã¥Å Â©', 'sÃ„Â±nÃ„Â±f rutin yardÃ„Â±m', 'classe ajuda rotina', 'osztÃƒÂ¡ly rutin segÃƒÂ­t', 'classe aide routine', 'ÃŽÂºÃŽÂ±Ãâ€žÃŽÂ·ÃŽÂ³ÃŽÂ¿ÃÂÃŽÂ¯ÃŽÂ± ÃÂÃŽÂ¿Ãâ€¦Ãâ€žÃŽÂ¯ÃŽÂ½ÃŽÂ±Ãâ€š ÃŽÂ²ÃŽÂ¿ÃŽÂ®ÃŽÂ¸ÃŽÂµÃŽÂ¹ÃŽÂ±', 'Klasse Routine Hilfe', 'Classe aiuto di routine', 'Ã Â¸Â£Ã Â¸Â°Ã Â¸â€Ã Â¸Â±Ã Â¸Å¡Ã Â¸â€žÃ Â¸Â§Ã Â¸Â²Ã Â¸Â¡Ã Â¸Å Ã Â¹Ë†Ã Â¸Â§Ã Â¸Â¢Ã Â¹â‚¬Ã Â¸Â«Ã Â¸Â¥Ã Â¸Â·Ã Â¸Â­Ã Â¸â€¢Ã Â¸Â²Ã Â¸Â¡Ã Â¸â€ºÃ Â¸ÂÃ Â¸â€¢Ã Â¸Â´', 'ÃšÂ©Ã™â€žÃ˜Â§Ã˜Â³ Ã™â€¦Ã˜Â¹Ã™â€¦Ã™Ë†Ã™â€ž Ã™â€¦Ã˜Â¯Ã˜Â¯', 'Ã Â¤ÂµÃ Â¤Â°Ã Â¥ÂÃ Â¤â€” Ã Â¤Â¦Ã Â¤Â¿Ã Â¤Â¨Ã Â¤Å¡Ã Â¤Â°Ã Â¥ÂÃ Â¤Â¯Ã Â¤Â¾ Ã Â¤Â®Ã Â¤Â¦Ã Â¤Â¦', 'uno genere auxilium', 'kelas bantuan rutin', 'Ã£â€šÂ¯Ã£Æ’Â©Ã£â€šÂ¹Ã£Æ’Â«Ã£Æ’Â¼Ã£Æ’ÂÃ£Æ’Â³Ã£ÂÂ®Ã£Æ’ËœÃ£Æ’Â«Ã£Æ’â€”', 'Ã­ÂÂ´Ã«Å¾ËœÃ¬Å Â¤ Ã«Â£Â¨Ã­â€¹Â´ Ã«Ââ€žÃ¬â€ºâ‚¬'),
(33, 'class_routine', 'class routine', '', 'rutina de la clase', 'روتين الطبقة', 'klasroutine', 'ÃÂºÃÂ»ÃÂ°Ã‘ÂÃ‘Â ÃÂ¿ÃÂ¾ÃÂ´ÃÂ¿Ã‘â‚¬ÃÂ¾ÃÂ³Ã‘â‚¬ÃÂ°ÃÂ¼ÃÂ¼', 'Ã¥Â¸Â¸Ã¨Â§â€žÃ§Â±Â»', 'sÃ„Â±nÃ„Â±f rutin', 'rotina classe', 'osztÃƒÂ¡ly rutin', 'routine de classe', 'ÃŽÅ¡ÃŽÂ±Ãâ€žÃŽÂ·ÃŽÂ³ÃŽÂ¿ÃÂÃŽÂ¯ÃŽÂ± ÃÂÃŽÂ¿Ãâ€¦Ãâ€žÃŽÂ¯ÃŽÂ½ÃŽÂ±', 'Klasse Routine', 'classe di routine', 'Ã Â¸â€ºÃ Â¸Â£Ã Â¸Â°Ã Â¸Ë†Ã Â¸Â³Ã Â¸Å Ã Â¸Â±Ã Â¹â€°Ã Â¸â„¢', 'ÃšÂ©Ã™â€žÃ˜Â§Ã˜Â³ Ã™â€¦Ã˜Â¹Ã™â€¦Ã™Ë†Ã™â€ž', 'Ã Â¤ÂµÃ Â¤Â°Ã Â¥ÂÃ Â¤â€” Ã Â¤Â¦Ã Â¤Â¿Ã Â¤Â¨Ã Â¤Å¡Ã Â¤Â°Ã Â¥ÂÃ Â¤Â¯Ã Â¤Â¾', 'in genere uno,', 'rutin kelas', 'Ã£â€šÂ¯Ã£Æ’Â©Ã£â€šÂ¹Ã‚Â·Ã£Æ’Â«Ã£Æ’Â¼Ã£Æ’ÂÃ£Æ’Â³', 'Ã­ÂÂ´Ã«Å¾ËœÃ¬Å Â¤ Ã«Â£Â¨Ã­â€¹Â´'),
(34, 'invoice_help', 'invoice help', '', 'ayuda factura', 'مساعدة الفاتورة', 'factuur hulp', 'Ã‘ÂÃ‘â€¡ÃÂµÃ‘â€š-Ã‘â€žÃÂ°ÃÂºÃ‘â€šÃ‘Æ’Ã‘â‚¬ÃÂ° ÃÂ¿ÃÂ¾ÃÂ¼ÃÂ¾Ã‘â€°Ã‘Å’', 'Ã¥Ââ€˜Ã§Â¥Â¨Ã¥Â¸Â®Ã¥Å Â©', 'fatura yardÃ„Â±m', 'ajuda factura', 'szÃƒÂ¡mla segÃƒÂ­tsÃƒÂ©gÃƒÂ©vel', 'aide facture', 'Ãâ€žÃŽÂ¹ÃŽÂ¼ÃŽÂ¿ÃŽÂ»ÃÅ’ÃŽÂ³ÃŽÂ¹ÃŽÂ¿ ÃŽÂ²ÃŽÂ¿ÃŽÂ®ÃŽÂ¸ÃŽÂµÃŽÂ¹ÃŽÂ±', 'Rechnungs Hilfe', 'help fattura', 'Ã Â¸Å Ã Â¹Ë†Ã Â¸Â§Ã Â¸Â¢Ã Â¹â‚¬Ã Â¸Â«Ã Â¸Â¥Ã Â¸Â·Ã Â¸Â­Ã Â¹Æ’Ã Â¸Å¡Ã Â¹ÂÃ Â¸Ë†Ã Â¹â€°Ã Â¸â€¡Ã Â¸Â«Ã Â¸â„¢Ã Â¸ÂµÃ Â¹â€°', 'Ã˜Â§Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¦Ã˜Â³ Ã™â€¦Ã˜Â¯Ã˜Â¯', 'Ã Â¤Å¡Ã Â¤Â¾Ã Â¤Â²Ã Â¤Â¾Ã Â¤Â¨ Ã Â¤Â¸Ã Â¤Â¹Ã Â¤Â¾Ã Â¤Â¯Ã Â¤Â¤Ã Â¤Â¾', 'auxilium cautionem', 'bantuan faktur', 'Ã©â‚¬ÂÃ£â€šÅ Ã§Å Â¶Ã£Æ’ËœÃ£Æ’Â«Ã£Æ’â€”', 'Ã¬â€ Â¡Ã¬Å¾Â¥ Ã«Ââ€žÃ¬â€ºâ‚¬'),
(35, 'payment', 'payment', '', 'pago', 'دفع', 'betaling', 'ÃÂ¾ÃÂ¿ÃÂ»ÃÂ°Ã‘â€šÃÂ°', 'Ã¤Â»ËœÃ¦Â¬Â¾', 'ÃƒÂ¶deme', 'pagamento', 'fizetÃƒÂ©s', 'paiement', 'Ãâ‚¬ÃŽÂ»ÃŽÂ·ÃÂÃâ€°ÃŽÂ¼ÃŽÂ®', 'Zahlung', 'pagamento', 'Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸Å Ã Â¸Â³Ã Â¸Â£Ã Â¸Â°Ã Â¹â‚¬Ã Â¸â€¡Ã Â¸Â´Ã Â¸â„¢', 'Ã˜Â§Ã˜Â¯Ã˜Â§Ã˜Â¦Ã›Å’ÃšÂ¯Ã›Å’', 'Ã Â¤Â­Ã Â¥ÂÃ Â¤â€”Ã Â¤Â¤Ã Â¤Â¾Ã Â¤Â¨', 'pecunia', 'pembayaran', 'Ã¦â€Â¯Ã¦â€°â€¢Ã£Ââ€ž', 'Ã¬Â§â‚¬Ã«Â¶Ë†'),
(36, 'book_help', 'book help', '', 'libro de ayuda', 'كتاب', 'boek hulp', 'ÃÅ¡ÃÂ½ÃÂ¸ÃÂ³ÃÂ° ÃÂ¿ÃÂ¾ÃÂ¼ÃÂ¾Ã‘â€°Ã‘Å’', 'Ã¦Å“Â¬Ã¤Â¹Â¦Ã¥Â¸Â®Ã¥Å Â©', 'kitap yardÃ„Â±mÃ„Â±', 'livro ajuda', 'kÃƒÂ¶nyv segÃƒÂ­t', 'livre aide', 'ÃŽÂ²ÃŽÂ¿ÃŽÂ®ÃŽÂ¸ÃŽÂµÃŽÂ¹ÃŽÂ± Ãâ€žÃŽÂ¿Ãâ€¦ ÃŽÂ²ÃŽÂ¹ÃŽÂ²ÃŽÂ»ÃŽÂ¯ÃŽÂ¿Ãâ€¦', 'Buch-Hilfe', 'della guida', 'Ã Â¸Å Ã Â¹Ë†Ã Â¸Â§Ã Â¸Â¢Ã Â¹â‚¬Ã Â¸Â«Ã Â¸Â¥Ã Â¸Â·Ã Â¸Â­Ã Â¸Â«Ã Â¸â„¢Ã Â¸Â±Ã Â¸â€¡Ã Â¸ÂªÃ Â¸Â·Ã Â¸Â­', 'ÃšÂ©Ã˜ÂªÃ˜Â§Ã˜Â¨ Ã™â€¦Ã˜Â¯Ã˜Â¯', 'Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â¸Ã Â¥ÂÃ Â¤Â¤Ã Â¤â€¢ Ã Â¤Â®Ã Â¤Â¦Ã Â¤Â¦', 'auxilium libro,', 'Buku bantuan', 'Ã£Æ’â€“Ã£Æ’Æ’Ã£â€šÂ¯Ã£ÂÂ®Ã£Æ’ËœÃ£Æ’Â«Ã£Æ’â€”', 'Ã¬Â±â€¦ Ã«Ââ€žÃ¬â€ºâ‚¬Ã«Â§Â'),
(37, 'library', 'library', '', 'biblioteca', 'مكتبة', 'bibliotheek', 'ÃÂ±ÃÂ¸ÃÂ±ÃÂ»ÃÂ¸ÃÂ¾Ã‘â€šÃÂµÃÂºÃÂ°', 'Ã¦â€“â€¡Ã¥Âºâ€œ', 'kÃƒÂ¼tÃƒÂ¼phane', 'biblioteca', 'kÃƒÂ¶nyvtÃƒÂ¡r', 'bibliothÃƒÂ¨que', 'ÃŽÂ²ÃŽÂ¹ÃŽÂ²ÃŽÂ»ÃŽÂ¹ÃŽÂ¿ÃŽÂ¸ÃŽÂ®ÃŽÂºÃŽÂ·', 'Bibliothek', 'biblioteca', 'Ã Â¸Â«Ã Â¹â€°Ã Â¸Â­Ã Â¸â€¡Ã Â¸ÂªÃ Â¸Â¡Ã Â¸Â¸Ã Â¸â€', 'Ã™â€žÃ˜Â§Ã˜Â¦Ã˜Â¨Ã˜Â±Ã›Å’Ã˜Â±Ã›Å’', 'Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â¸Ã Â¥ÂÃ Â¤Â¤Ã Â¤â€¢Ã Â¤Â¾Ã Â¤Â²Ã Â¤Â¯', 'library', 'perpustakaan', 'Ã¥â€ºÂ³Ã¦â€ºÂ¸Ã©Â¤Â¨', 'Ã«Ââ€žÃ¬â€žÅ“ÃªÂ´â‚¬'),
(38, 'transport_help', 'transport help', '', 'ayuda de transporte', 'مساعدة النقل', 'vervoer help', 'Ã‘â€šÃ‘â‚¬ÃÂ°ÃÂ½Ã‘ÂÃÂ¿ÃÂ¾Ã‘â‚¬Ã‘â€š ÃÂ¿ÃÂ¾ÃÂ¼ÃÂ¾Ã‘â€°Ã‘Å’', 'Ã¨Â¿ÂÃ¨Â¾â€œÃ¥Â¸Â®Ã¥Å Â©', 'ulaÃ…Å¸Ã„Â±m yardÃ„Â±m', 'ajuda de transporte', 'szÃƒÂ¡llÃƒÂ­tÃƒÂ¡s SÃƒÂºgÃƒÂ³', 'le transport de l''aide', 'ÃŽÂ²ÃŽÂ¿ÃŽÂ·ÃŽÂ¸ÃŽÂ¿ÃÂÃŽÂ½ Ãâ€žÃŽÂ· ÃŽÂ¼ÃŽÂµÃâ€žÃŽÂ±Ãâ€ ÃŽÂ¿ÃÂÃŽÂ¬', 'Transport Hilfe', 'help trasporti', 'Ã Â¸Å Ã Â¹Ë†Ã Â¸Â§Ã Â¸Â¢Ã Â¹â‚¬Ã Â¸Â«Ã Â¸Â¥Ã Â¸Â·Ã Â¸Â­Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸â€šÃ Â¸â„¢Ã Â¸ÂªÃ Â¹Ë†Ã Â¸â€¡', 'Ã™â€ Ã™â€šÃ™â€ž Ã™Ë† Ã˜Â­Ã™â€¦Ã™â€ž Ã™â€¦Ã˜Â¯Ã˜Â¯', 'Ã Â¤ÂªÃ Â¤Â°Ã Â¤Â¿Ã Â¤ÂµÃ Â¤Â¹Ã Â¤Â¨ Ã Â¤Â®Ã Â¤Â¦Ã Â¤Â¦', 'auxilium onerariis', 'transportasi bantuan', 'Ã¨Â¼Â¸Ã©â‚¬ÂÃ£ÂÂ®Ã£Æ’ËœÃ£Æ’Â«Ã£Æ’â€”', 'Ã¬Â â€žÃ¬â€ Â¡ Ã«Ââ€žÃ¬â€ºâ‚¬'),
(39, 'transport', 'transport', '', 'transporte', 'المواصلات', 'vervoer', 'Ã‘â€šÃ‘â‚¬ÃÂ°ÃÂ½Ã‘ÂÃÂ¿ÃÂ¾Ã‘â‚¬Ã‘â€š', 'Ã¨Â¿ÂÃ¨Â¾â€œ', 'taÃ…Å¸Ã„Â±ma', 'transporte', 'szÃƒÂ¡llÃƒÂ­tÃƒÂ¡s', 'transport', 'ÃŽÂ¼ÃŽÂµÃâ€žÃŽÂ±Ãâ€ ÃŽÂ¿ÃÂÃŽÂ¬', 'Transport', 'trasporto', 'Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸â€šÃ Â¸â„¢Ã Â¸ÂªÃ Â¹Ë†Ã Â¸â€¡', 'Ã™â€ Ã™â€šÃ™â€ž Ã™Ë† Ã˜Â­Ã™â€¦Ã™â€ž', 'Ã Â¤ÂªÃ Â¤Â°Ã Â¤Â¿Ã Â¤ÂµÃ Â¤Â¹Ã Â¤Â¨', 'onerariis', 'angkutan', 'Ã¨Â¼Â¸Ã©â‚¬Â', 'Ã¬Ë†ËœÃ¬â€ Â¡'),
(40, 'dormitory_help', 'dormitory help', '', 'dormitorio de ayuda', 'مساعدة المهجع', 'slaapzaal hulp', 'ÃÂ¾ÃÂ±Ã‘â€°ÃÂµÃÂ¶ÃÂ¸Ã‘â€šÃÂ¸ÃÂµ ÃÂ¿ÃÂ¾ÃÂ¼ÃÂ¾Ã‘â€°Ã‘Å’', 'Ã¥Â®Â¿Ã¨Ë†ÂÃ¥Â¸Â®Ã¥Å Â©', 'yatakhane yardÃ„Â±m', 'dormitÃƒÂ³rio ajuda', 'kollÃƒÂ©giumi help', 'dortoir aide', 'ÃŽÂºÃŽÂ¿ÃŽÂ¹Ãâ€žÃÅ½ÃŽÂ½ÃŽÂ± ÃŽÂ²ÃŽÂ¿ÃŽÂ®ÃŽÂ¸ÃŽÂµÃŽÂ¹ÃŽÂ±', 'Wohnheim Hilfe', 'dormitorio aiuto', 'Ã Â¸Â«Ã Â¸Â­Ã Â¸Å¾Ã Â¸Â±Ã Â¸ÂÃ Â¸Å Ã Â¹Ë†Ã Â¸Â§Ã Â¸Â¢Ã Â¹â‚¬Ã Â¸Â«Ã Â¸Â¥Ã Â¸Â·Ã Â¸Â­', 'Ã˜Â´Ã›Å’Ã™â€ Ã˜Â§ÃšÂ¯Ã˜Â§Ã˜Â± Ã™â€¦Ã˜Â¯Ã˜Â¯', 'Ã Â¤â€ºÃ Â¤Â¾Ã Â¤Â¤Ã Â¥ÂÃ Â¤Â°Ã Â¤Â¾Ã Â¤ÂµÃ Â¤Â¾Ã Â¤Â¸ Ã Â¤Â®Ã Â¤Â¦Ã Â¤Â¦', 'dormitorium auxilium', 'asrama bantuan', 'Ã¥Â¯Â®Ã£ÂÂ®Ã£Æ’ËœÃ£Æ’Â«Ã£Æ’â€”', 'ÃªÂ¸Â°Ã¬Ë†â„¢Ã¬â€šÂ¬ Ã«Ââ€žÃ¬â€ºâ‚¬Ã«Â§Â'),
(41, 'dormitory', 'dormitory', '', 'dormitorio', 'سكن', 'slaapzaal', 'Ã‘ÂÃÂ¿ÃÂ°ÃÂ»Ã‘Å’ÃÂ½Ã‘Â', 'Ã¥Â®Â¿Ã¨Ë†Â', 'yatakhane', 'dormitÃƒÂ³rio', 'hÃƒÂ¡lÃƒÂ³terem', 'dortoir', 'ÃŽÂºÃŽÂ¿ÃŽÂ¹Ãâ€žÃÅ½ÃŽÂ½ÃŽÂ±', 'Wohnheim', 'dormitorio', 'Ã Â¸Â«Ã Â¸Â­Ã Â¸Å¾Ã Â¸Â±Ã Â¸Â', 'Ã˜Â´Ã›Å’Ã™â€ Ã˜Â§ÃšÂ¯Ã˜Â§Ã˜Â±', 'Ã Â¤â€ºÃ Â¤Â¾Ã Â¤Â¤Ã Â¥ÂÃ Â¤Â°Ã Â¤Â¾Ã Â¤ÂµÃ Â¤Â¾Ã Â¤Â¸', 'dormitorium', 'asrama mahasiswa', 'Ã¥Â¯Â®', 'ÃªÂ¸Â°Ã¬Ë†â„¢Ã¬â€šÂ¬'),
(42, 'noticeboard_help', 'noticeboard help', '', 'tablÃƒÂ³n de anuncios de la ayuda', 'مساعدة نوتيسيبود', 'prikbord hulp', 'ÃÂ´ÃÂ¾Ã‘ÂÃÂºÃÂ° ÃÂ´ÃÂ»Ã‘Â ÃÂ¾ÃÂ±Ã‘Å Ã‘ÂÃÂ²ÃÂ»ÃÂµÃÂ½ÃÂ¸ÃÂ¹ ÃÂ¿ÃÂ¾ÃÂ¼ÃÂ¾Ã‘â€°Ã‘Å’', 'Ã¥Â¸Æ’Ã¥â€˜Å Ã¥Â¸Â®Ã¥Å Â©', 'noticeboard yardÃ„Â±m', 'avisos ajuda', 'ÃƒÂ¼zenÃ…â€˜falÃƒÂ¡n help', 'panneau d''aide', 'ÃŽÂ±ÃŽÂ½ÃŽÂ±ÃŽÂºÃŽÂ¿ÃŽÂ¹ÃŽÂ½ÃÅ½ÃÆ’ÃŽÂµÃâ€°ÃŽÂ½ ÃŽÂ²ÃŽÂ¿ÃŽÂ®ÃŽÂ¸ÃŽÂµÃŽÂ¹ÃŽÂ±', 'Brett-Hilfe', 'bacheca aiuto', 'Ã Â¸â€ºÃ Â¹â€°Ã Â¸Â²Ã Â¸Â¢Ã Â¸â€ºÃ Â¸Â£Ã Â¸Â°Ã Â¸ÂÃ Â¸Â²Ã Â¸Â¨Ã Â¸â€žÃ Â¸Â§Ã Â¸Â²Ã Â¸Â¡Ã Â¸Å Ã Â¹Ë†Ã Â¸Â§Ã Â¸Â¢Ã Â¹â‚¬Ã Â¸Â«Ã Â¸Â¥Ã Â¸Â·Ã Â¸Â­', 'noticeboard Ã™â€¦Ã˜Â¯Ã˜Â¯', 'Noticeboard Ã Â¤Â®Ã Â¤Â¦Ã Â¤Â¦', 'auxilium noticeboard', 'pengumuman bantuan', 'Ã¤Â¼ÂÃ¨Â¨â‚¬Ã¦ÂÂ¿Ã£ÂÂ®Ã£Æ’ËœÃ£Æ’Â«Ã£Æ’â€”', 'Ã¬ÂËœ noticeboard Ã«Ââ€žÃ¬â€ºâ‚¬Ã«Â§Â'),
(43, 'noticeboard-event', 'noticeboard-event', '', 'tablÃƒÂ³n de anuncios de eventos', 'اللافتة الحدث', 'prikbord-event', 'ÃÂ´ÃÂ¾Ã‘ÂÃÂºÃÂ° ÃÂ´ÃÂ»Ã‘Â ÃÂ¾ÃÂ±Ã‘Å Ã‘ÂÃÂ²ÃÂ»ÃÂµÃÂ½ÃÂ¸ÃÂ¹-Ã‘ÂÃÂ¾ÃÂ±Ã‘â€¹Ã‘â€šÃÂ¸ÃÂµ', 'Ã¥Â¸Æ’Ã¥â€˜Å Ã§â€°Å’Ã¤Âºâ€¹Ã¤Â»Â¶', 'noticeboard olay', 'avisos de eventos', 'ÃƒÂ¼zenÃ…â€˜falÃƒÂ¡n esemÃƒÂ©ny', 'panneau d''ÃƒÂ©vÃƒÂ©nement', 'ÃŽÂ±ÃŽÂ½ÃŽÂ±ÃŽÂºÃŽÂ¿ÃŽÂ¹ÃŽÂ½ÃÅ½ÃÆ’ÃŽÂµÃâ€°ÃŽÂ½ ÃŽÂµÃŽÂºÃŽÂ´ÃŽÂ®ÃŽÂ»Ãâ€°ÃÆ’ÃŽÂ·', 'Brett-Ereignis', 'bacheca-evento', 'Ã Â¸â€ºÃ Â¹â€°Ã Â¸Â²Ã Â¸Â¢Ã Â¸â€ºÃ Â¸Â£Ã Â¸Â°Ã Â¸ÂÃ Â¸Â²Ã Â¸Â¨Ã Â¸â€šÃ Â¸Â­Ã Â¸â€¡Ã Â¹â‚¬Ã Â¸Â«Ã Â¸â€¢Ã Â¸Â¸Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸â€œÃ Â¹Å’', 'noticeboard Ã˜Â§Ã›Å’Ã™Ë†Ã™â€ Ã™Â¹', 'Noticeboard Ã Â¤ËœÃ Â¤Å¸Ã Â¤Â¨Ã Â¤Â¾', 'noticeboard eventus,', 'pengumuman-acara', 'Ã¤Â¼ÂÃ¨Â¨â‚¬Ã¦ÂÂ¿Ã£â€šÂ¤Ã£Æ’â„¢Ã£Æ’Â³Ã£Æ’Ë†', 'Ã¬ÂËœ noticeboard Ã¬ÂÂ´Ã«Â²Â¤Ã­Å Â¸'),
(44, 'bed_ward_help', 'bed ward help', '', 'cama ward ayuda', 'سرير وارد مساعدة', 'bed ward hulp', 'ÃÂºÃ‘â‚¬ÃÂ¾ÃÂ²ÃÂ°Ã‘â€šÃ‘Å’ ÃÂ¿ÃÂ¾ÃÂ´ÃÂ¾ÃÂ¿ÃÂµÃ‘â€¡ÃÂ½Ã‘â€¹ÃÂ¹ ÃÂ¿ÃÂ¾ÃÂ¼ÃÂ¾Ã‘â€°Ã‘Å’', 'Ã¥ÂºÅ Ã§â€”â€¦Ã¦Ë†Â¿Ã§Å¡â€žÃ¥Â¸Â®Ã¥Å Â©', 'yatak koÃ„Å¸uÃ…Å¸ yardÃ„Â±m', 'ajuda cama enfermaria', 'ÃƒÂ¡gy Ward help', 'lit salle de l''aide', 'ÃŽÂºÃÂÃŽÂµÃŽÂ²ÃŽÂ¬Ãâ€žÃŽÂ¹ Ãâ‚¬Ãâ€žÃŽÂ­ÃÂÃâ€¦ÃŽÂ³ÃŽÂ± ÃŽÂ²ÃŽÂ¿ÃŽÂ®ÃŽÂ¸ÃŽÂµÃŽÂ¹ÃŽÂ±', 'Betten-Station Hilfe', 'Letto reparto aiuto', 'Ã Â¸Â§Ã Â¸Â­Ã Â¸Â£Ã Â¹Å’Ã Â¸â€Ã Â¹â‚¬Ã Â¸â€¢Ã Â¸ÂµÃ Â¸Â¢Ã Â¸â€¡Ã Â¸Å Ã Â¹Ë†Ã Â¸Â§Ã Â¸Â¢Ã Â¹â‚¬Ã Â¸Â«Ã Â¸Â¥Ã Â¸Â·Ã Â¸Â­', 'Ã˜Â¨Ã˜Â³Ã˜ÂªÃ˜Â± Ã™Ë†Ã˜Â§Ã˜Â±ÃšË† Ã™â€¦Ã˜Â¯Ã˜Â¯', 'Ã Â¤Â¬Ã Â¤Â¿Ã Â¤Â¸Ã Â¥ÂÃ Â¤Â¤Ã Â¤Â° Ã Â¤ÂµÃ Â¤Â¾Ã Â¤Â°Ã Â¥ÂÃ Â¤Â¡ Ã Â¤Â®Ã Â¤Â¦Ã Â¤Â¦', 'lectum stans auxilium', 'tidur bangsal bantuan', 'Ã£Æ’â„¢Ã£Æ’Æ’Ã£Æ’â€°Ã§â€”â€¦Ã¦Â£Å¸Ã£ÂÂ®Ã£Æ’ËœÃ£Æ’Â«Ã£Æ’â€”', 'Ã¬Â¹Â¨Ã«Å’â‚¬ Ã«Â³â€˜Ã«Ââ„¢ Ã«Ââ€žÃ¬â€ºâ‚¬'),
(45, 'settings', 'settings', '', 'configuraciÃƒÂ³n', 'اعدادات النظام', 'instellingen', 'ÃÂ½ÃÂ°Ã‘ÂÃ‘â€šÃ‘â‚¬ÃÂ¾ÃÂ¹ÃÂºÃÂ¸', 'Ã¨Â®Â¾Ã§Â½Â®', 'ayarlarÃ„Â±', 'definiÃƒÂ§ÃƒÂµes', 'beÃƒÂ¡llÃƒÂ­tÃƒÂ¡sok', 'paramÃƒÂ¨tres', 'ÃŽÂ¡Ãâ€¦ÃŽÂ¸ÃŽÂ¼ÃŽÂ¯ÃÆ’ÃŽÂµÃŽÂ¹Ãâ€š', 'Einstellungen', 'Impostazioni', 'Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸â€¢Ã Â¸Â±Ã Â¹â€°Ã Â¸â€¡Ã Â¸â€žÃ Â¹Ë†Ã Â¸Â²', 'Ã˜ÂªÃ˜Â±Ã˜ÂªÃ›Å’Ã˜Â¨Ã˜Â§Ã˜Âª', 'Ã Â¤Â¸Ã Â¥â€¡Ã Â¤Å¸Ã Â¤Â¿Ã Â¤â€šÃ Â¤â€”Ã Â¥ÂÃ Â¤Â¸', 'occasus', 'Pengaturan', 'Ã¨Â¨Â­Ã¥Â®Å¡', 'Ã¬â€žÂ¤Ã¬Â â€¢'),
(18511, 'click_to_change_theme', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18510, 'select_theme', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18509, 'default', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18508, 'select_themes', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18507, 'Logo Image', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18506, 'upload_system_logo', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18505, 'install_update', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18504, 'file', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18503, 'update_product', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(47, 'manage_language', 'manage language', '', 'gestionar idioma', 'إدارة اللغة', 'beheren taal', 'Ã‘Æ’ÃÂ¿Ã‘â‚¬ÃÂ°ÃÂ²ÃÂ»Ã‘ÂÃ‘â€šÃ‘Å’ Ã‘ÂÃÂ·Ã‘â€¹ÃÂº', 'Ã§Â®Â¡Ã§Ââ€ Ã¨Â¯Â­Ã¨Â¨â‚¬', 'dil yÃƒÂ¶netmek', 'gerenciar lÃƒÂ­ngua', 'kezelni nyelv', 'gÃƒÂ©rer langue', 'ÃŽÂ´ÃŽÂ¹ÃŽÂ±Ãâ€¡ÃŽÂµÃŽÂ¯ÃÂÃŽÂ¹ÃÆ’ÃŽÂ· ÃŽÂ³ÃŽÂ»ÃÅ½ÃÆ’ÃÆ’ÃŽÂ±', 'verwalten Sprache', 'gestire lingua', 'Ã Â¸Ë†Ã Â¸Â±Ã Â¸â€Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸Â Ã Â¸Â²Ã Â¸Â©Ã Â¸Â²', 'Ã˜Â²Ã˜Â¨Ã˜Â§Ã™â€  ÃšÂ©Ã˜Â§ Ã˜Â§Ã™â€ Ã˜ÂªÃ˜Â¸Ã˜Â§Ã™â€¦', 'Ã Â¤Â­Ã Â¤Â¾Ã Â¤Â·Ã Â¤Â¾ Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¤Â¬Ã Â¤â€šÃ Â¤Â§Ã Â¤Â¨', 'moderari linguam,', 'mengelola bahasa', 'Ã¨Â¨â‚¬Ã¨ÂªÅ¾Ã£â€šâ€™Ã§Â®Â¡Ã§Ââ€ ', 'Ã¬â€“Â¸Ã¬â€“Â´Ã«Â¥Â¼ ÃªÂ´â‚¬Ã«Â¦Â¬');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `bengali`, `spanish`, `arabic`, `dutch`, `russian`, `chinese`, `turkish`, `portuguese`, `hungarian`, `french`, `greek`, `german`, `italian`, `thai`, `urdu`, `hindi`, `latin`, `indonesian`, `japanese`, `korean`) VALUES
(48, 'backup_restore', 'backup restore', '', 'copia de seguridad a restaurar', 'اسنرجاع البيانات', 'backup terugzetten', 'ÃÂ²ÃÂ¾Ã‘ÂÃ‘ÂÃ‘â€šÃÂ°ÃÂ½ÃÂ¾ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ Ã‘â‚¬ÃÂµÃÂ·ÃÂµÃ‘â‚¬ÃÂ²ÃÂ½ÃÂ¾ÃÂ³ÃÂ¾ ÃÂºÃÂ¾ÃÂ¿ÃÂ¸Ã‘â‚¬ÃÂ¾ÃÂ²ÃÂ°ÃÂ½ÃÂ¸Ã‘Â', 'Ã¥Â¤â€¡Ã¤Â»Â½Ã¨Â¿ËœÃ¥Å½Å¸', 'yedekleme geri', 'de backup restaurar', 'Backup Restore', 'restauration de sauvegarde', 'ÃŽÂµÃâ‚¬ÃŽÂ±ÃŽÂ½ÃŽÂ±Ãâ€ ÃŽÂ¿ÃÂÃŽÂ¬Ãâ€š ÃŽÂ±ÃŽÂ½Ãâ€žÃŽÂ¹ÃŽÂ³ÃÂÃŽÂ¬Ãâ€ Ãâ€°ÃŽÂ½ ÃŽÂ±ÃÆ’Ãâ€ ÃŽÂ±ÃŽÂ»ÃŽÂµÃŽÂ¯ÃŽÂ±Ãâ€š', 'Backup wiederherstellen', 'ripristino di backup', 'Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸ÂªÃ Â¸Â³Ã Â¸Â£Ã Â¸Â­Ã Â¸â€¡Ã Â¸â€šÃ Â¹â€°Ã Â¸Â­Ã Â¸Â¡Ã Â¸Â¹Ã Â¸Â¥Ã Â¹â‚¬Ã Â¸Â£Ã Â¸ÂµÃ Â¸Â¢Ã Â¸ÂÃ Â¸â€žÃ Â¸Â·Ã Â¸â„¢', 'Ã˜Â¨Ã›Å’ÃšÂ© Ã˜Â§Ã™Â¾ Ã˜Â¨Ã˜Â­Ã˜Â§Ã™â€ž', 'Ã Â¤Â¬Ã Â¥Ë†Ã Â¤â€¢Ã Â¤â€¦Ã Â¤Âª Ã Â¤Â¬Ã Â¤Â¹Ã Â¤Â¾Ã Â¤Â²', 'tergum restituunt', 'backup restore', 'Ã£Æ’ÂÃ£Æ’Æ’Ã£â€šÂ¯Ã£â€šÂ¢Ã£Æ’Æ’Ã£Æ’â€”Ã£ÂÂ¯Ã£â‚¬ÂÃ£Æ’ÂªÃ£â€šÂ¹Ã£Æ’Ë†Ã£â€šÂ¢', 'Ã«Â°Â±Ã¬â€”â€¦ Ã«Â³ÂµÃ¬â€ºÂ'),
(49, 'profile_help', 'profile help', '', 'Perfil Ayuda', 'الملف الشخصي', 'profile hulp', 'ÃÂ°ÃÂ½ÃÂºÃÂµÃ‘â€šÃÂ° ÃÂ¿ÃÂ¾ÃÂ¼ÃÂ¾Ã‘â€°Ã‘Å’', 'Ã§Â®â‚¬Ã¤Â»â€¹Ã¥Â¸Â®Ã¥Å Â©', 'yardÃ„Â±m profile', 'Perfil ajuda', 'profile help', 'profil aide', 'Ãâ‚¬ÃÂÃŽÂ¿Ãâ€ ÃŽÂ¯ÃŽÂ» ÃŽÂ²ÃŽÂ¿ÃŽÂ®ÃŽÂ¸ÃŽÂµÃŽÂ¹ÃŽÂ±', 'Profil Hilfe', 'profilo di aiuto', 'Ã Â¹â€šÃ Â¸â€ºÃ Â¸Â£Ã Â¹â€žÃ Â¸Å¸Ã Â¸Â¥Ã Â¹Å’Ã Â¸â€žÃ Â¸Â§Ã Â¸Â²Ã Â¸Â¡Ã Â¸Å Ã Â¹Ë†Ã Â¸Â§Ã Â¸Â¢Ã Â¹â‚¬Ã Â¸Â«Ã Â¸Â¥Ã Â¸Â·Ã Â¸Â­', 'Ã™â€¦Ã˜Â¯Ã˜Â¯ Ã™Â¾Ã˜Â±Ã™Ë†Ã™ÂÃ˜Â§Ã˜Â¦Ã™â€ž', 'Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¥â€¹Ã Â¤Â«Ã Â¤Â¾Ã Â¤â€¡Ã Â¤Â² Ã Â¤Â®Ã Â¥â€¡Ã Â¤â€š', 'Auctor nullam opem', 'Profil bantuan', 'Ã£Æ’â€”Ã£Æ’Â­Ã£Æ’â€¢Ã£â€šÂ£Ã£Æ’Â¼Ã£Æ’Â«Ã£Æ’ËœÃ£Æ’Â«Ã£Æ’â€”', 'Ã«Ââ€žÃ¬â€ºâ‚¬ Ã­â€â€žÃ«Â¡Å“Ã­â€¢â€ž'),
(50, 'manage_student', 'manage student', '', 'gestionar estudiante', 'إدارة الطالب', 'beheren student', 'Ã‘Æ’ÃÂ¿Ã‘â‚¬ÃÂ°ÃÂ²ÃÂ»Ã‘ÂÃ‘â€šÃ‘Å’ Ã‘ÂÃ‘â€šÃ‘Æ’ÃÂ´ÃÂµÃÂ½Ã‘â€šÃÂ°', 'Ã§Â®Â¡Ã§Ââ€ Ã¥Â­Â¦Ã§â€Å¸', 'ÃƒÂ¶Ã„Å¸renci yÃƒÂ¶netmek', 'gerenciar estudante', 'kezelni diÃƒÂ¡k', 'gÃƒÂ©rer ÃƒÂ©tudiant', 'ÃŽÂ´ÃŽÂ¹ÃŽÂ±Ãâ€¡ÃŽÂµÃŽÂ¯ÃÂÃŽÂ¹ÃÆ’ÃŽÂ· Ãâ€žÃâ€°ÃŽÂ½ Ãâ€ ÃŽÂ¿ÃŽÂ¹Ãâ€žÃŽÂ·Ãâ€žÃÅ½ÃŽÂ½', 'SchÃƒÂ¼ler verwalten', 'gestire studente', 'Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸Ë†Ã Â¸Â±Ã Â¸â€Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸Â¨Ã Â¸Â¶Ã Â¸ÂÃ Â¸Â©Ã Â¸Â²', 'Ã˜Â·Ã˜Â§Ã™â€žÃ˜Â¨ Ã˜Â¹Ã™â€žÃ™â€¦ ÃšÂ©Ã˜Â§ Ã˜Â§Ã™â€ Ã˜ÂªÃ˜Â¸Ã˜Â§Ã™â€¦', 'Ã Â¤â€ºÃ Â¤Â¾Ã Â¤Â¤Ã Â¥ÂÃ Â¤Â° Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¤Â¬Ã Â¤â€šÃ Â¤Â§Ã Â¤Â¨', 'curo alumnorum', 'mengelola siswa', 'Ã§â€Å¸Ã¥Â¾â€™Ã£â€šâ€™Ã§Â®Â¡Ã§Ââ€ ', 'Ã­â€¢â„¢Ã¬Æ’Â ÃªÂ´â‚¬Ã«Â¦Â¬'),
(51, 'manage_teacher', 'manage teacher', '', 'gestionar maestro', 'إدارة المعلم', 'beheren leraar', 'Ã‘Æ’ÃÂ¿Ã‘â‚¬ÃÂ°ÃÂ²ÃÂ»Ã‘ÂÃ‘â€šÃ‘Å’ Ã‘Æ’Ã‘â€¡ÃÂ¸Ã‘â€šÃÂµÃÂ»Ã‘Â', 'Ã§Â®Â¡Ã§Ââ€ Ã¨â‚¬ÂÃ¥Â¸Ë†', 'ÃƒÂ¶Ã„Å¸retmen yÃƒÂ¶netmek', 'gerenciar professor', 'kezelni tanÃƒÂ¡r', 'gÃƒÂ©rer enseignant', 'ÃŽÂ´ÃŽÂ¹ÃŽÂ±Ãâ€¡ÃŽÂµÃŽÂ¯ÃÂÃŽÂ¹ÃÆ’ÃŽÂ· Ãâ€žÃâ€°ÃŽÂ½ ÃŽÂµÃŽÂºÃâ‚¬ÃŽÂ±ÃŽÂ¹ÃŽÂ´ÃŽÂµÃâ€¦Ãâ€žÃŽÂ¹ÃŽÂºÃÅ½ÃŽÂ½', 'Lehrer verwalten', 'gestire insegnante', 'Ã Â¸Ë†Ã Â¸Â±Ã Â¸â€Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸â€žÃ Â¸Â£Ã Â¸Â¹', 'Ã™Â¹Ã›Å’Ãšâ€ Ã˜Â± ÃšÂ©Ã˜Â§ Ã˜Â§Ã™â€ Ã˜ÂªÃ˜Â¸Ã˜Â§Ã™â€¦', 'Ã Â¤Â¶Ã Â¤Â¿Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â·Ã Â¤â€¢ Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¤Â¬Ã Â¤â€šÃ Â¤Â§Ã Â¤Â¨', 'magister curo', 'mengelola guru', 'Ã¦â€¢â„¢Ã¥Â¸Â«Ã£â€šâ€™Ã§Â®Â¡Ã§Ââ€ ', 'ÃªÂµÂÃ¬â€šÂ¬ ÃªÂ´â‚¬Ã«Â¦Â¬'),
(52, 'noticeboard', 'noticeboard', '', 'tablÃƒÂ³n de anuncios', 'لوح الإعلانات', 'prikbord', 'ÃÂ´ÃÂ¾Ã‘ÂÃÂºÃÂ° ÃÂ´ÃÂ»Ã‘Â ÃÂ¾ÃÂ±Ã‘Å Ã‘ÂÃÂ²ÃÂ»ÃÂµÃÂ½ÃÂ¸ÃÂ¹', 'Ã¥Â¸Æ’Ã¥â€˜Å ', 'noticeboard', 'quadro de avisos', 'ÃƒÂ¼zenÃ…â€˜falÃƒÂ¡n', 'panneau d''affichage', 'ÃŽÂ±ÃŽÂ½ÃŽÂ±ÃŽÂºÃŽÂ¿ÃŽÂ¹ÃŽÂ½ÃÅ½ÃÆ’ÃŽÂµÃâ€°ÃŽÂ½', 'Brett', 'bacheca', 'Ã Â¸â€ºÃ Â¹â€°Ã Â¸Â²Ã Â¸Â¢Ã Â¸â€ºÃ Â¸Â£Ã Â¸Â°Ã Â¸ÂÃ Â¸Â²Ã Â¸Â¨', 'noticeboard', 'Noticeboard', 'noticeboard', 'pengumuman', 'Ã¤Â¼ÂÃ¨Â¨â‚¬Ã¦ÂÂ¿', 'Ã¬ÂËœ noticeboard'),
(53, 'language', 'language', '', 'idioma', 'لغة', 'taal', 'Ã‘ÂÃÂ·Ã‘â€¹ÃÂº', 'Ã¨Â¯Â­', 'dil', 'lÃƒÂ­ngua', 'nyelv', 'langue', 'ÃŽÂ³ÃŽÂ»ÃÅ½ÃÆ’ÃÆ’ÃŽÂ±', 'Sprache', 'lingua', 'Ã Â¸Â Ã Â¸Â²Ã Â¸Â©Ã Â¸Â²', 'Ã˜Â²Ã˜Â¨Ã˜Â§Ã™â€ ', 'Ã Â¤Â­Ã Â¤Â¾Ã Â¤Â·Ã Â¤Â¾', 'Lingua', 'bahasa', 'Ã¨Â¨â‚¬Ã¨ÂªÅ¾', 'Ã¬â€“Â¸Ã¬â€“Â´'),
(54, 'backup', 'backup', '', 'reserva', 'دعم', 'reservekopie', 'Ã‘â‚¬ÃÂµÃÂ·ÃÂµÃ‘â‚¬ÃÂ²ÃÂ½Ã‘â€¹ÃÂ¹', 'Ã¥Â¤â€¡Ã§â€Â¨', 'yedek', 'backup', 'mentÃƒÂ©s', 'sauvegarde', 'ÃŽÂµÃâ€ ÃŽÂµÃŽÂ´ÃÂÃŽÂ¹ÃŽÂºÃÅ’Ãâ€š', 'Sicherungskopie', 'di riserva', 'Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸ÂªÃ Â¸Â³Ã Â¸Â£Ã Â¸Â­Ã Â¸â€¡Ã Â¸â€šÃ Â¹â€°Ã Â¸Â­Ã Â¸Â¡Ã Â¸Â¹Ã Â¸Â¥', 'Ã˜Â¨Ã›Å’ÃšÂ© Ã˜Â§Ã™Â¾', 'Ã Â¤Â¬Ã Â¥Ë†Ã Â¤â€¢Ã Â¤â€¦Ã Â¤Âª', 'tergum', 'backup', 'Ã£Æ’ÂÃ£Æ’Æ’Ã£â€šÂ¯Ã£â€šÂ¢Ã£Æ’Æ’Ã£Æ’â€”', 'Ã¬Â§â‚¬Ã¬â€ºÂ'),
(55, 'calendar_schedule', 'calendar schedule', '', 'horario de calendario', 'جدول التقويم', 'kalender schema', 'ÃÅ¡ÃÂ°ÃÂ»ÃÂµÃÂ½ÃÂ´ÃÂ°Ã‘â‚¬Ã‘Å’ ÃÂ ÃÂ°Ã‘ÂÃÂ¿ÃÂ¸Ã‘ÂÃÂ°ÃÂ½ÃÂ¸ÃÂµ', 'Ã¦â€”Â¥Ã¥Å½â€ Ã¦â€”Â¥Ã§Â¨â€¹', 'takvim programÃ„Â±', 'agenda calendÃƒÂ¡rio', 'naptÃƒÂ¡ri ÃƒÂ¼temezÃƒÂ©s', 'calendrier calendrier', 'Ãâ€¡ÃÂÃŽÂ¿ÃŽÂ½ÃŽÂ¿ÃŽÂ´ÃŽÂ¹ÃŽÂ±ÃŽÂ³ÃÂÃŽÂ¬ÃŽÂ¼ÃŽÂ¼ÃŽÂ±Ãâ€žÃŽÂ¿Ãâ€š Ãâ€žÃŽÂ¿Ãâ€¦ ÃŽÂ·ÃŽÂ¼ÃŽÂµÃÂÃŽÂ¿ÃŽÂ»ÃŽÂ¿ÃŽÂ³ÃŽÂ¯ÃŽÂ¿Ãâ€¦', 'Kalender Zeitplan', 'programma di calendario', 'Ã Â¸â€ºÃ Â¸ÂÃ Â¸Â´Ã Â¸â€”Ã Â¸Â´Ã Â¸â„¢Ã Â¸â€¢Ã Â¸Â²Ã Â¸Â£Ã Â¸Â²Ã Â¸â€¡Ã Â¸â„¢Ã Â¸Â±Ã Â¸â€Ã Â¸Â«Ã Â¸Â¡Ã Â¸Â²Ã Â¸Â¢', 'ÃšÂ©Ã›Å’Ã™â€žÃ™â€ ÃšË†Ã˜Â± Ã˜Â´Ã›Å’ÃšË†Ã™Ë†Ã™â€ž', 'Ã Â¤â€¢Ã Â¥Ë†Ã Â¤Â²Ã Â¥â€¡Ã Â¤â€šÃ Â¤Â¡Ã Â¤Â° Ã Â¤â€¦Ã Â¤Â¨Ã Â¥ÂÃ Â¤Â¸Ã Â¥â€šÃ Â¤Å¡Ã Â¥â‚¬', 'kalendarium ipsum', 'jadwal kalender', 'Ã£â€šÂ«Ã£Æ’Â¬Ã£Æ’Â³Ã£Æ’â‚¬Ã£Æ’Â¼Ã£ÂÂ®Ã£â€šÂ¹Ã£â€šÂ±Ã£â€šÂ¸Ã£Æ’Â¥Ã£Æ’Â¼Ã£Æ’Â«', 'Ã¬ÂºËœÃ«Â¦Â°Ã«Ââ€ Ã¬ÂÂ¼Ã¬Â â€¢'),
(56, 'select_a_class', 'select a class', '', 'seleccionar una clase', 'حدد فئة', 'selecteer een class', 'ÃÂ²Ã‘â€¹ÃÂ±ÃÂµÃ‘â‚¬ÃÂ¸Ã‘â€šÃÂµ ÃÂºÃÂ»ÃÂ°Ã‘ÂÃ‘Â', 'Ã©â‚¬â€°Ã¦â€¹Â©Ã¤Â¸â‚¬Ã¤Â¸ÂªÃ§Â±Â»', 'bir sÃ„Â±nÃ„Â±f seÃƒÂ§in', 'selecionar uma classe', 'vÃƒÂ¡lasszon ki egy osztÃƒÂ¡lyt', 'sÃƒÂ©lectionner une classe', 'ÃŽÂµÃâ‚¬ÃŽÂ¹ÃŽÂ»ÃŽÂ­ÃŽÂ¾Ãâ€žÃŽÂµ ÃŽÂ¼ÃŽÂ¹ÃŽÂ± ÃŽÂºÃŽÂ±Ãâ€žÃŽÂ·ÃŽÂ³ÃŽÂ¿ÃÂÃŽÂ¯ÃŽÂ±', 'WÃƒÂ¤hlen Sie eine Klasse', 'selezionare una classe', 'Ã Â¹â‚¬Ã Â¸Â¥Ã Â¸Â·Ã Â¸Â­Ã Â¸ÂÃ Â¸Å Ã Â¸Â±Ã Â¹â€°Ã Â¸â„¢', 'Ã˜Â§Ã›Å’ÃšÂ© ÃšÂ©Ã™â€žÃ˜Â§Ã˜Â³ Ã™â€¦Ã™â€ Ã˜ÂªÃ˜Â®Ã˜Â¨ ÃšÂ©Ã˜Â±Ã›Å’ÃšÂº', 'Ã Â¤ÂÃ Â¤â€¢ Ã Â¤ÂµÃ Â¤Â°Ã Â¥ÂÃ Â¤â€” Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤Å¡Ã Â¤Â¯Ã Â¤Â¨ Ã Â¤â€¢Ã Â¤Â°Ã Â¥â€¡Ã Â¤â€š', 'eligere genus', 'pilih kelas', 'Ã£â€šÂ¯Ã£Æ’Â©Ã£â€šÂ¹Ã£â€šâ€™Ã©ÂÂ¸Ã¦Å Å¾', 'Ã­ÂÂ´Ã«Å¾ËœÃ¬Å Â¤Ã«Â¥Â¼ Ã¬â€žÂ Ã­Æ’Â'),
(57, 'student_list', 'student list', '', 'lista de alumnos', 'قائمة الطلاب', 'student lijst', 'ÃÂ¡ÃÂ¿ÃÂ¸Ã‘ÂÃÂ¾ÃÂº Ã‘ÂÃ‘â€šÃ‘Æ’ÃÂ´ÃÂµÃÂ½Ã‘â€š', 'Ã¥Â­Â¦Ã§â€Å¸Ã¥ÂÂÃ¥Ââ€¢', 'ÃƒÂ¶Ã„Å¸renci listesi', 'lista de alunos', 'diÃƒÂ¡k lista', 'liste des ÃƒÂ©tudiants', 'ÃŽÂºÃŽÂ±Ãâ€žÃŽÂ¬ÃŽÂ»ÃŽÂ¿ÃŽÂ³ÃŽÂ¿ Ãâ€žÃâ€°ÃŽÂ½ Ãâ€ ÃŽÂ¿ÃŽÂ¹Ãâ€žÃŽÂ·Ãâ€žÃÅ½ÃŽÂ½', 'SchÃƒÂ¼lerliste', 'elenco degli studenti', 'Ã Â¸Â£Ã Â¸Â²Ã Â¸Â¢Ã Â¸Å Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸â„¢Ã Â¸Â±Ã Â¸ÂÃ Â¹â‚¬Ã Â¸Â£Ã Â¸ÂµÃ Â¸Â¢Ã Â¸â„¢', 'Ã˜Â·Ã˜Â§Ã™â€žÃ˜Â¨ Ã˜Â¹Ã™â€žÃ™â€¦ ÃšÂ©Ã›Å’ Ã™ÂÃ›ÂÃ˜Â±Ã˜Â³Ã˜Âª', 'Ã Â¤â€ºÃ Â¤Â¾Ã Â¤Â¤Ã Â¥ÂÃ Â¤Â° Ã Â¤Â¸Ã Â¥â€šÃ Â¤Å¡Ã Â¥â‚¬', 'Discipulus album', 'daftar mahasiswa', 'Ã¥Â­Â¦Ã§â€Å¸Ã£ÂÂ®Ã£Æ’ÂªÃ£â€šÂ¹Ã£Æ’Ë†', 'Ã­â€¢â„¢Ã¬Æ’Â Ã«ÂªÂ©Ã«Â¡Â'),
(58, 'add_student', 'add student', '', 'aÃƒÂ±adir estudiante', 'إضافة طالب', 'voeg student', 'ÃÂ´ÃÂ¾ÃÂ±ÃÂ°ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ Ã‘ÂÃ‘â€šÃ‘Æ’ÃÂ´ÃÂµÃÂ½Ã‘â€šÃÂ°', 'Ã¦â€“Â°Ã¥Â¢Å¾Ã¥Â­Â¦Ã§â€Å¸', 'ÃƒÂ¶Ã„Å¸renci eklemek', 'adicionar estudante', 'hozzÃƒÂ¡ hallgatÃƒÂ³', 'ajouter ÃƒÂ©tudiant', 'Ãâ‚¬ÃÂÃŽÂ¿ÃÆ’ÃŽÂ¸ÃŽÂ­ÃÆ’Ãâ€žÃŽÂµ Ãâ€ ÃŽÂ¿ÃŽÂ¹Ãâ€žÃŽÂ·Ãâ€žÃŽÂ®Ãâ€š', 'Student hinzufÃƒÂ¼gen', 'aggiungere studente', 'Ã Â¹â‚¬Ã Â¸Å¾Ã Â¸Â´Ã Â¹Ë†Ã Â¸Â¡Ã Â¸â„¢Ã Â¸Â±Ã Â¸ÂÃ Â¹â‚¬Ã Â¸Â£Ã Â¸ÂµÃ Â¸Â¢Ã Â¸â„¢', 'Ã˜Â·Ã˜Â§Ã™â€žÃ˜Â¨ Ã˜Â¹Ã™â€žÃ™â€¦ Ã˜Â´Ã˜Â§Ã™â€¦Ã™â€ž', 'Ã Â¤â€ºÃ Â¤Â¾Ã Â¤Â¤Ã Â¥ÂÃ Â¤Â° Ã Â¤Å“Ã Â¥â€¹Ã Â¤Â¡Ã Â¤Â¼', 'adde elit', 'menambahkan mahasiswa', 'Ã¥Â­Â¦Ã§â€Å¸Ã£â€šâ€™Ã¨Â¿Â½Ã¥Å Â ', 'Ã­â€¢â„¢Ã¬Æ’ÂÃ¬Ââ€ž Ã¬Â¶â€ÃªÂ°â‚¬'),
(59, 'roll', 'roll', '', 'rollo', 'تدحرج', 'broodje', 'Ã‘â‚¬Ã‘Æ’ÃÂ»ÃÂ¾ÃÂ½', 'Ã¦Â»Å¡', 'rulo', 'rolo', 'tekercs', 'rouleau', 'ÃÂÃŽÂ¿ÃŽÂ»ÃÅ’', 'Rolle', 'rotolo', 'Ã Â¸Â¡Ã Â¹â€°Ã Â¸Â§Ã Â¸â„¢', 'Ã˜Â±Ã™Ë†Ã™â€ž', 'Ã Â¤Â°Ã Â¥â€¹Ã Â¤Â²', 'volumen', 'gulungan', 'Ã£Æ’Â­Ã£Æ’Â¼Ã£Æ’Â«', 'Ã«Â¡Â¤'),
(60, 'photo', 'photo', '', 'foto', 'صورة فوتوغرافية', 'foto', 'Ã‘â€žÃÂ¾Ã‘â€šÃÂ¾', 'Ã§â€¦Â§Ã§â€°â€¡', 'fotoÃ„Å¸raf', 'foto', 'fÃƒÂ©nykÃƒÂ©p', 'photo', 'Ãâ€ Ãâ€°Ãâ€žÃŽÂ¿ÃŽÂ³ÃÂÃŽÂ±Ãâ€ ÃŽÂ¯ÃŽÂ±', 'Foto', 'foto', 'Ã Â¸Â Ã Â¸Â²Ã Â¸Å¾Ã Â¸â€“Ã Â¹Ë†Ã Â¸Â²Ã Â¸Â¢', 'Ã˜ÂªÃ˜ÂµÃ™Ë†Ã›Å’Ã˜Â±', 'Ã Â¤Â«Ã Â¤Â¼Ã Â¥â€¹Ã Â¤Å¸Ã Â¥â€¹', 'Lorem ipsum', 'foto', 'Ã¥â€ â„¢Ã§Å“Å¸', 'Ã¬â€šÂ¬Ã¬Â§â€ž'),
(61, 'student_name', 'student name', '', 'Nombre del estudiante', 'أسم الطالب', 'naam van de leerling', 'ÃËœÃÂ¼Ã‘Â Ã‘ÂÃ‘â€šÃ‘Æ’ÃÂ´ÃÂµÃÂ½Ã‘â€šÃÂ°', 'Ã¥Â­Â¦Ã§â€Å¸Ã¥Â§â€œÃ¥ÂÂ', 'Ãƒâ€“Ã„Å¸renci adÃ„Â±', 'nome do aluno', 'tanulÃƒÂ³ nevÃƒÂ©t', 'nom de l''ÃƒÂ©tudiant', 'Ãâ€žÃŽÂ¿ ÃÅ’ÃŽÂ½ÃŽÂ¿ÃŽÂ¼ÃŽÂ± Ãâ€žÃŽÂ¿Ãâ€¦ ÃŽÂ¼ÃŽÂ±ÃŽÂ¸ÃŽÂ·Ãâ€žÃŽÂ®', 'Studentennamen', 'nome dello studente', 'Ã Â¸Å Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸â„¢Ã Â¸Â±Ã Â¸ÂÃ Â¹â‚¬Ã Â¸Â£Ã Â¸ÂµÃ Â¸Â¢Ã Â¸â„¢', 'Ã˜Â·Ã˜Â§Ã™â€žÃ˜Â¨ Ã˜Â¹Ã™â€žÃ™â€¦ ÃšÂ©Ã›â€™ Ã™â€ Ã˜Â§Ã™â€¦', 'Ã Â¤â€ºÃ Â¤Â¾Ã Â¤Â¤Ã Â¥ÂÃ Â¤Â° Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤Â¨Ã Â¤Â¾Ã Â¤Â®', 'ipsum est nomen', 'nama siswa', 'Ã¥Â­Â¦Ã§â€Å¸Ã£ÂÂ®Ã¥ÂÂÃ¥â€°Â', 'Ã­â€¢â„¢Ã¬Æ’ÂÃ¬ÂËœ Ã¬ÂÂ´Ã«Â¦â€ž'),
(62, 'address', 'address', '', 'direcciÃƒÂ³n', 'عنوان', 'adres', 'ÃÂ°ÃÂ´Ã‘â‚¬ÃÂµÃ‘Â', 'Ã¥Å“Â°Ã¥Ââ‚¬', 'adres', 'endereÃƒÂ§o', 'cÃƒÂ­m', 'adresse', 'ÃŽÂ´ÃŽÂ¹ÃŽÂµÃÂÃŽÂ¸Ãâ€¦ÃŽÂ½ÃÆ’ÃŽÂ·', 'Adresse', 'indirizzo', 'Ã Â¸â€”Ã Â¸ÂµÃ Â¹Ë†Ã Â¸Â­Ã Â¸Â¢Ã Â¸Â¹Ã Â¹Ë†', 'Ã˜Â§Ã›Å’ÃšË†Ã˜Â±Ã›Å’Ã˜Â³', 'Ã Â¤ÂªÃ Â¤Â¤Ã Â¤Â¾', 'Oratio', 'alamat', 'Ã£â€šÂ¢Ã£Æ’â€°Ã£Æ’Â¬Ã£â€šÂ¹', 'Ã¬Â£Â¼Ã¬â€ Å’'),
(63, 'options', 'options', '', 'Opciones', 'خيارات', 'opties', 'ÃÂ¾ÃÂ¿Ã‘â€ ÃÂ¸ÃÂ¸', 'Ã©â‚¬â€°Ã©Â¡Â¹', 'seÃƒÂ§enekleri', 'opÃƒÂ§ÃƒÂµes', 'lehetÃ…â€˜sÃƒÂ©gek', 'les options', 'ÃŽâ€¢Ãâ‚¬ÃŽÂ¹ÃŽÂ»ÃŽÂ¿ÃŽÂ³ÃŽÂ­Ãâ€š', 'Optionen', 'Opzioni', 'Ã Â¸â€¢Ã Â¸Â±Ã Â¸Â§Ã Â¹â‚¬Ã Â¸Â¥Ã Â¸Â·Ã Â¸Â­Ã Â¸Â', 'Ã˜Â§Ã˜Â®Ã˜ÂªÃ›Å’Ã˜Â§Ã˜Â±Ã˜Â§Ã˜Âª', 'Ã Â¤ÂµÃ Â¤Â¿Ã Â¤â€¢Ã Â¤Â²Ã Â¥ÂÃ Â¤Âª', 'options', 'Pilihan', 'Ã£â€šÂªÃ£Æ’â€”Ã£â€šÂ·Ã£Æ’Â§Ã£Æ’Â³', 'Ã¬ËœÂµÃ¬â€¦Ëœ'),
(64, 'marksheet', 'marksheet', '', 'marksheet', 'وضع علامة على الورقة', 'Marksheet', 'marksheet', 'marksheet', 'Marksheet', 'marksheet', 'Marksheet', 'relevÃƒÂ© de notes', 'Marksheet', 'marksheet', 'Marksheet', 'marksheet', 'marksheet', 'Ã Â¤â€¦Ã Â¤â€šÃ Â¤â€¢Ã Â¤ÂªÃ Â¤Â¤Ã Â¥ÂÃ Â¤Â°', 'marksheet', 'marksheet', 'marksheet', 'marksheet'),
(65, 'id_card', 'id card', '', 'carnet de identidad', 'بطاقة التعريف', 'id-kaart', 'Ã‘Æ’ÃÂ´ÃÂ¾Ã‘ÂÃ‘â€šÃÂ¾ÃÂ²ÃÂµÃ‘â‚¬ÃÂµÃÂ½ÃÂ¸ÃÂµ ÃÂ»ÃÂ¸Ã‘â€¡ÃÂ½ÃÂ¾Ã‘ÂÃ‘â€šÃÂ¸', 'Ã¨ÂºÂ«Ã¤Â»Â½Ã¨Â¯Â', 'kimlik kartÃ„Â±', 'carteira de identidade', 'szemÃƒÂ©lyi igazolvÃƒÂ¡ny', 'carte d''identitÃƒÂ©', 'id ÃŽÂºÃŽÂ¬ÃÂÃâ€žÃŽÂ±', 'Ausweis', 'carta d''identitÃƒÂ ', 'Ã Â¸Å¡Ã Â¸Â±Ã Â¸â€¢Ã Â¸Â£Ã Â¸â€ºÃ Â¸Â£Ã Â¸Â°Ã Â¸Å Ã Â¸Â²Ã Â¸Å Ã Â¸â„¢', 'Ã˜Â´Ã™â€ Ã˜Â§Ã˜Â®Ã˜ÂªÃ›Å’ ÃšÂ©Ã˜Â§Ã˜Â±ÃšË†', 'Ã Â¤â€ Ã Â¤Â¡Ã Â¥â‚¬ Ã Â¤â€¢Ã Â¤Â¾Ã Â¤Â°Ã Â¥ÂÃ Â¤Â¡', 'id ipsum', 'id card', 'IDÃ£â€šÂ«Ã£Æ’Â¼Ã£Æ’â€°', 'Ã¬â€¹Â Ã«Â¶â€žÃ¬Â¦Â'),
(66, 'edit', 'edit', '', 'editar', 'تصحيح', 'uitgeven', 'Ã‘â‚¬ÃÂµÃÂ´ÃÂ°ÃÂºÃ‘â€šÃÂ¸Ã‘â‚¬ÃÂ¾ÃÂ²ÃÂ°Ã‘â€šÃ‘Å’', 'Ã§Â¼â€“Ã¨Â¾â€˜', 'dÃƒÂ¼zenleme', 'editar', 'szerkeszt', 'modifier', 'edit', 'bearbeiten', 'modifica', 'Ã Â¹ÂÃ Â¸ÂÃ Â¹â€°Ã Â¹â€žÃ Â¸â€š', 'Ã™â€¦Ã›Å’ÃšÂº Ã˜ÂªÃ˜Â±Ã™â€¦Ã›Å’Ã™â€¦ ÃšÂ©Ã˜Â±Ã›Å’ÃšÂº', 'Ã Â¤Â¸Ã Â¤â€šÃ Â¤ÂªÃ Â¤Â¾Ã Â¤Â¦Ã Â¤Â¿Ã Â¤Â¤ Ã Â¤â€¢Ã Â¤Â°Ã Â¥â€¡Ã Â¤â€š', 'edit', 'mengedit', 'Ã§Â·Â¨Ã©â€ºâ€ ', 'Ã­Å½Â¸Ã¬Â§â€˜'),
(67, 'delete', 'delete', '', 'borrar', 'حذف', 'verwijderen', 'Ã‘Æ’ÃÂ´ÃÂ°ÃÂ»Ã‘ÂÃ‘â€šÃ‘Å’', 'Ã¥Ë†Â Ã©â„¢Â¤', 'silmek', 'excluir', 'tÃƒÂ¶rÃƒÂ¶l', 'effacer', 'ÃŽÂ´ÃŽÂ¹ÃŽÂ±ÃŽÂ³ÃÂÃŽÂ±Ãâ€ ÃŽÂ®', 'lÃƒÂ¶schen', 'cancellare', 'Ã Â¸Â¥Ã Â¸Å¡', 'Ã˜Â®Ã˜Â§Ã˜Â±Ã˜Â¬', 'Ã Â¤Â¹Ã Â¤Å¸Ã Â¤Â¾Ã Â¤Â¨Ã Â¤Â¾', 'vel deleri,', 'menghapus', 'Ã¥â€°Å Ã©â„¢Â¤Ã£Ââ„¢Ã£â€šâ€¹', 'Ã¬â€šÂ­Ã¬Â Å“'),
(68, 'personal_profile', 'personal profile', '', 'perfil personal', 'الملف الشخصي', 'persoonlijk profiel', 'ÃÂ»ÃÂ¸Ã‘â€¡ÃÂ½Ã‘â€¹ÃÂ¹ ÃÂ¿Ã‘â‚¬ÃÂ¾Ã‘â€žÃÂ¸ÃÂ»Ã‘Å’', 'Ã¤Â¸ÂªÃ¤ÂºÂºÃ§Â®â‚¬Ã¤Â»â€¹', 'kiÃ…Å¸isel profil', 'perfil pessoal', 'szemÃƒÂ©lyes profil', 'profil personnel', 'Ãâ‚¬ÃÂÃŽÂ¿ÃÆ’Ãâ€°Ãâ‚¬ÃŽÂ¹ÃŽÂºÃÅ’ Ãâ‚¬ÃÂÃŽÂ¿Ãâ€ ÃŽÂ¯ÃŽÂ»', 'persÃƒÂ¶nliches Profil', 'profilo personale', 'Ã Â¸Â£Ã Â¸Â²Ã Â¸Â¢Ã Â¸Â¥Ã Â¸Â°Ã Â¹â‚¬Ã Â¸Â­Ã Â¸ÂµÃ Â¸Â¢Ã Â¸â€Ã Â¸â€šÃ Â¹â€°Ã Â¸Â­Ã Â¸Â¡Ã Â¸Â¹Ã Â¸Â¥Ã Â¸ÂªÃ Â¹Ë†Ã Â¸Â§Ã Â¸â„¢Ã Â¸â€¢Ã Â¸Â±Ã Â¸Â§', 'Ã˜Â°Ã˜Â§Ã˜ÂªÃ›Å’ Ã™Â¾Ã˜Â±Ã™Ë†Ã™ÂÃ˜Â§Ã˜Â¦Ã™â€ž', 'Ã Â¤ÂµÃ Â¥ÂÃ Â¤Â¯Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â¤Ã Â¤Â¿Ã Â¤â€”Ã Â¤Â¤ Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¥â€¹Ã Â¤Â«Ã Â¤Â¾Ã Â¤â€¡Ã Â¤Â²', 'personal profile', 'profil pribadi', 'Ã¤ÂºÂºÃ§â€°Â©Ã§â€šÂ¹Ã¦ÂÂ', 'ÃªÂ°Å“Ã¬ÂÂ¸ Ã­â€â€žÃ«Â¡Å“Ã­â€¢â€ž'),
(69, 'academic_result', 'academic result', '', 'resultado acadÃƒÂ©mico', 'نتيجة أكادمية', 'academische resultaat', 'ÃÂ°ÃÂºÃÂ°ÃÂ´ÃÂµÃÂ¼ÃÂ¸Ã‘â€¡ÃÂµÃ‘ÂÃÂºÃÂ¸ÃÂ¹ Ã‘â‚¬ÃÂµÃÂ·Ã‘Æ’ÃÂ»Ã‘Å’Ã‘â€šÃÂ°Ã‘â€š', 'Ã¥Â­Â¦Ã¦Å“Â¯Ã¦Ë†ÂÃ¦Å¾Å“', 'akademik sonuÃƒÂ§', 'resultado acadÃƒÂªmico', 'tudomÃƒÂ¡nyos eredmÃƒÂ©ny', 'rÃƒÂ©sultat acadÃƒÂ©mique', 'ÃŽÂ±ÃŽÂºÃŽÂ±ÃŽÂ´ÃŽÂ·ÃŽÂ¼ÃŽÂ±ÃÅ ÃŽÂºÃŽÂ® ÃŽÂ±Ãâ‚¬ÃŽÂ¿Ãâ€žÃŽÂ­ÃŽÂ»ÃŽÂµÃÆ’ÃŽÂ¼ÃŽÂ±', 'Studienergebnis', 'risultato accademico', 'Ã Â¸Å“Ã Â¸Â¥Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸Â¨Ã Â¸Â¶Ã Â¸ÂÃ Â¸Â©Ã Â¸Â²', 'Ã˜ÂªÃ˜Â¹Ã™â€žÃ›Å’Ã™â€¦Ã›Å’ Ã™â€ Ã˜ÂªÃ›Å’Ã˜Â¬Ã›Â', 'Ã Â¤Â¶Ã Â¥Ë†Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â·Ã Â¤Â¿Ã Â¤â€¢ Ã Â¤ÂªÃ Â¤Â°Ã Â¤Â¿Ã Â¤Â£Ã Â¤Â¾Ã Â¤Â®', 'Ex academicis', 'Hasil akademik', 'Ã¥Â­Â¦Ã¨Â¡â€œÃ§ÂµÂÃ¦Å¾Å“', 'Ã­â€¢â„¢Ã¬Å Âµ ÃªÂ²Â°Ã¢â‚¬â€¹Ã¢â‚¬â€¹ÃªÂ³Â¼'),
(70, 'name', 'name', '', 'nombre', 'اسم', 'naam', 'ÃÂ½ÃÂ°ÃÂ·ÃÂ²ÃÂ°ÃÂ½ÃÂ¸ÃÂµ', 'Ã¥ÂÂÃ§Â§Â°', 'isim', 'nome', 'nÃƒÂ©v', 'nom', 'ÃÅ’ÃŽÂ½ÃŽÂ¿ÃŽÂ¼ÃŽÂ±', 'Name', 'nome', 'Ã Â¸Å Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­', 'Ã™â€ Ã˜Â§Ã™â€¦', 'Ã Â¤Â¨Ã Â¤Â¾Ã Â¤Â®', 'nomen,', 'nama', 'Ã¥ÂÂÃ¥â€°Â', 'Ã¬ÂÂ´Ã«Â¦â€ž'),
(71, 'birthday', 'birthday', '', 'cumpleaÃƒÂ±os', 'عيد الميلاد', 'verjaardag', 'ÃÂ´ÃÂµÃÂ½Ã‘Å’ Ã‘â‚¬ÃÂ¾ÃÂ¶ÃÂ´ÃÂµÃÂ½ÃÂ¸Ã‘Â', 'Ã§â€Å¸Ã¦â€”Â¥', 'doÃ„Å¸um gÃƒÂ¼nÃƒÂ¼', 'aniversÃƒÂ¡rio', 'szÃƒÂ¼letÃƒÂ©snap', 'anniversaire', 'ÃŽÂ³ÃŽÂµÃŽÂ½ÃŽÂ­ÃŽÂ¸ÃŽÂ»ÃŽÂ¹ÃŽÂ±', 'Geburtstag', 'compleanno', 'Ã Â¸Â§Ã Â¸Â±Ã Â¸â„¢Ã Â¹â‚¬Ã Â¸ÂÃ Â¸Â´Ã Â¸â€', 'Ã˜Â³Ã˜Â§Ã™â€žÃšÂ¯Ã˜Â±Ã›Â', 'Ã Â¤Å“Ã Â¤Â¨Ã Â¥ÂÃ Â¤Â®Ã Â¤Â¦Ã Â¤Â¿Ã Â¤Â¨', 'natalis', 'ulang tahun', 'Ã¨Âªâ€¢Ã§â€Å¸Ã¦â€”Â¥', 'Ã¬Æ’ÂÃ¬ÂÂ¼'),
(72, 'sex', 'sex', '', 'sexo', 'جنس', 'seks', 'Ã‘ÂÃÂµÃÂºÃ‘Â', 'Ã¦â‚¬Â§Ã¥Ë†Â«', 'seks', 'sexo', 'szex', 'sexe', 'Ãâ€ ÃÂÃŽÂ»ÃŽÂ¿', 'Sex', 'sesso', 'Ã Â¹â‚¬Ã Â¸Å¾Ã Â¸Â¨', 'Ã˜Â¬Ã™â€ Ã˜Â³Ã›Å’', 'Ã Â¤Â²Ã Â¤Â¿Ã Â¤â€šÃ Â¤â€”', 'sex', 'seks', 'Ã£â€šÂ»Ã£Æ’Æ’Ã£â€šÂ¯Ã£â€šÂ¹', 'Ã¬â€žÂ¹Ã¬Å Â¤'),
(73, 'male', 'male', '', 'masculino', 'الذكر', 'mannelijk', 'ÃÂ¼Ã‘Æ’ÃÂ¶Ã‘ÂÃÂºÃÂ¾ÃÂ¹', 'Ã§â€Â·Ã¦â‚¬Â§', 'erkek', 'masculino', 'fÃƒÂ©rfi', 'mÃƒÂ¢le', 'ÃŽÂ±ÃÂÃÆ’ÃŽÂµÃŽÂ½ÃŽÂ¹ÃŽÂºÃÅ’Ãâ€š', 'mÃƒÂ¤nnlich', 'maschio', 'Ã Â¹â‚¬Ã Â¸Å¾Ã Â¸Â¨Ã Â¸Å Ã Â¸Â²Ã Â¸Â¢', 'Ã™Â¾Ã˜Â±Ã™Ë†Ã™ÂÃ˜Â§Ã˜Â¦Ã™â€ž', 'Ã Â¤Â¨Ã Â¤Â°', 'masculus', 'laki-laki', 'Ã§â€Â·Ã¦â‚¬Â§', 'Ã«â€šÂ¨Ã¬â€žÂ±'),
(74, 'female', 'female', '', 'femenino', 'إناثا', 'vrouw', 'ÃÂ¶ÃÂµÃÂ½Ã‘ÂÃÂºÃÂ¸ÃÂ¹', 'Ã¥Â¥Â³', 'kadÃ„Â±n', 'feminino', 'nÃ…â€˜i', 'femelle', 'ÃŽÂ¸ÃŽÂ·ÃŽÂ»Ãâ€¦ÃŽÂºÃÅ’Ãâ€š', 'weiblich', 'femminile', 'Ã Â¹â‚¬Ã Â¸Å¾Ã Â¸Â¨Ã Â¸Â«Ã Â¸ÂÃ Â¸Â´Ã Â¸â€¡', 'Ã˜Â®Ã™Ë†Ã˜Â§Ã˜ÂªÃ›Å’Ã™â€ ', 'Ã Â¤Â®Ã Â¤Â¹Ã Â¤Â¿Ã Â¤Â²Ã Â¤Â¾', 'femina,', 'perempuan', 'Ã¥Â¥Â³Ã¦â‚¬Â§', 'Ã¬â€”Â¬Ã¬â€žÂ±'),
(75, 'religion', 'religion', '', 'religiÃƒÂ³n', 'دين', 'religie', 'Ã‘â‚¬ÃÂµÃÂ»ÃÂ¸ÃÂ³ÃÂ¸Ã‘Â', 'Ã¥Â®â€”Ã¦â€¢â„¢', 'din', 'religiÃƒÂ£o', 'vallÃƒÂ¡s', 'religion', 'ÃŽÂ¸ÃÂÃŽÂ·ÃÆ’ÃŽÂºÃŽÂµÃŽÂ¯ÃŽÂ±', 'Religion', 'religione', 'Ã Â¸Â¨Ã Â¸Â²Ã Â¸ÂªÃ Â¸â„¢Ã Â¸Â²', 'Ã™â€¦Ã˜Â°Ã›ÂÃ˜Â¨', 'Ã Â¤Â§Ã Â¤Â°Ã Â¥ÂÃ Â¤Â®', 'religionis,', 'agama', 'Ã¥Â®â€”Ã¦â€¢â„¢', 'Ã¬Â¢â€¦ÃªÂµÂ'),
(76, 'blood_group', 'blood group', '', 'grupo sanguÃƒÂ­neo', 'فصيلة الدم', 'bloedgroep', 'ÃÂ³Ã‘â‚¬Ã‘Æ’ÃÂ¿ÃÂ¿ÃÂ° ÃÂºÃ‘â‚¬ÃÂ¾ÃÂ²ÃÂ¸', 'Ã¨Â¡â‚¬Ã¥Å¾â€¹', 'kan grubu', 'grupo sanguÃƒÂ­neo', 'vÃƒÂ©rcsoport', 'groupe sanguin', 'ÃŽÂ¿ÃŽÂ¼ÃŽÂ¬ÃŽÂ´ÃŽÂ± ÃŽÂ±ÃŽÂ¯ÃŽÂ¼ÃŽÂ±Ãâ€žÃŽÂ¿Ãâ€š', 'Blutgruppe', 'gruppo sanguigno', 'Ã Â¸ÂÃ Â¸Â£Ã Â¸Â¸Ã Â¹Å Ã Â¸â€ºÃ Â¹â‚¬Ã Â¸Â¥Ã Â¸Â·Ã Â¸Â­Ã Â¸â€', 'Ã˜Â®Ã™Ë†Ã™â€  ÃšÂ©Ã›â€™ ÃšÂ¯Ã˜Â±Ã™Ë†Ã™Â¾', 'Ã Â¤Â°Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â¤ Ã Â¤ÂµÃ Â¤Â°Ã Â¥ÂÃ Â¤â€”', 'sanguine coetus', 'golongan darah', 'Ã¨Â¡â‚¬Ã¦Â¶Â²Ã¥Å¾â€¹', 'Ã­ËœË†Ã¬â€¢Â¡Ã­Ëœâ€¢'),
(77, 'phone', 'phone', '', 'telÃƒÂ©fono', 'هاتف', 'telefoon', 'Ã‘â€šÃÂµÃÂ»ÃÂµÃ‘â€žÃÂ¾ÃÂ½', 'Ã§â€ÂµÃ¨Â¯Â', 'telefon', 'telefone', 'telefon', 'tÃƒÂ©lÃƒÂ©phone', 'Ãâ€žÃŽÂ·ÃŽÂ»ÃŽÂ­Ãâ€ Ãâ€°ÃŽÂ½ÃŽÂ¿', 'Telefon', 'telefono', 'Ã Â¹â€šÃ Â¸â€”Ã Â¸Â£Ã Â¸Â¨Ã Â¸Â±Ã Â¸Å¾Ã Â¸â€”Ã Â¹Å’', 'Ã™ÂÃ™Ë†Ã™â€ ', 'Ã Â¤Â«Ã Â¤Â¼Ã Â¥â€¹Ã Â¤Â¨', 'Praesent', 'telepon', 'Ã©â€ºÂ»Ã¨Â©Â±', 'Ã¬Â â€žÃ­â„¢â€'),
(78, 'father_name', 'father name', '', 'Nombre del padre', 'اسم الأب', 'naam van de vader', 'ÃÂ¾Ã‘â€šÃ‘â€¡ÃÂµÃ‘ÂÃ‘â€šÃÂ²ÃÂ¾', 'Ã§Ë†Â¶Ã¤ÂºÂ²Ã¥Â§â€œÃ¥ÂÂ', 'baba adÃ„Â±', 'nome pai', 'apa nÃƒÂ©v', 'nom de pÃƒÂ¨re', 'ÃŽÂ¤ÃŽÂ¿ ÃÅ’ÃŽÂ½ÃŽÂ¿ÃŽÂ¼ÃŽÂ± Ãâ€žÃŽÂ¿Ãâ€¦ Ãâ‚¬ÃŽÂ±Ãâ€žÃŽÂ­ÃÂÃŽÂ±', 'Der Name des Vaters', 'nome del padre', 'Ã Â¸Å Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸Å¾Ã Â¹Ë†Ã Â¸Â­', 'Ã™Ë†Ã˜Â§Ã™â€žÃ˜Â¯ ÃšÂ©Ã˜Â§ Ã™â€ Ã˜Â§Ã™â€¦', 'Ã Â¤ÂªÃ Â¤Â¿Ã Â¤Â¤Ã Â¤Â¾ Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤Â¨Ã Â¤Â¾Ã Â¤Â®', 'nomine Patris,', 'Nama ayah', 'Ã§Ë†Â¶Ã¨Â¦ÂªÃ£ÂÂ®Ã¥ÂÂÃ¥â€°Â', 'Ã¬â€¢â€žÃ«Â²â€žÃ¬Â§â‚¬Ã¬ÂËœ Ã¬ÂÂ´Ã«Â¦â€ž'),
(79, 'mother_name', 'mother name', '', 'Nombre de la madre', 'اسم الأم', 'moeder naam', 'ÃËœÃÂ¼Ã‘Â ÃÂ¼ÃÂ°Ã‘â€šÃÂµÃ‘â‚¬ÃÂ¸', 'Ã¦Â¯ÂÃ¤ÂºÂ²Ã§Å¡â€žÃ¥ÂÂÃ¥Â­â€”', 'anne adÃ„Â±', 'Nome mÃƒÂ£e', 'anyja nÃƒÂ©v', 'nom de la mÃƒÂ¨re', 'Ãâ€žÃŽÂ¿ ÃÅ’ÃŽÂ½ÃŽÂ¿ÃŽÂ¼ÃŽÂ± Ãâ€žÃŽÂ·Ãâ€š ÃŽÂ¼ÃŽÂ·Ãâ€žÃŽÂ­ÃÂÃŽÂ±Ãâ€š', 'Name der Mutter', 'Nome madre', 'Ã Â¸Å Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¹ÂÃ Â¸Â¡Ã Â¹Ë†', 'Ã™â€¦Ã˜Â§ÃšÂº ÃšÂ©Ã˜Â§ Ã™â€ Ã˜Â§Ã™â€¦', 'Ã Â¤Â®Ã Â¤Â¾Ã Â¤Â¤Ã Â¤Â¾ Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤Â¨Ã Â¤Â¾Ã Â¤Â®', 'matris nomen,', 'Nama ibu', 'Ã¦Â¯ÂÃ£ÂÂ®Ã¥ÂÂÃ¥â€°Â', 'Ã¬â€“Â´Ã«Â¨Â¸Ã«â€¹Ë† Ã¬ÂÂ´Ã«Â¦â€ž'),
(80, 'edit_student', 'edit student', '', 'edit estudiante', 'تحرير الطالب', 'bewerk student', 'Ã‘â‚¬ÃÂµÃÂ´ÃÂ°ÃÂºÃ‘â€šÃÂ¸Ã‘â‚¬ÃÂ¾ÃÂ²ÃÂ°ÃÂ½ÃÂ¸Ã‘Â Ã‘ÂÃ‘â€šÃ‘Æ’ÃÂ´ÃÂµÃÂ½Ã‘â€š', 'Ã§Â¼â€“Ã¨Â¾â€˜Ã¥Â­Â¦Ã§â€Å¸', 'edit ÃƒÂ¶Ã„Å¸renci', 'ediÃƒÂ§ÃƒÂ£o aluno', 'szerkesztÃƒÂ©s diÃƒÂ¡k', 'modifier ÃƒÂ©tudiant', 'ÃŽÂµÃâ‚¬ÃŽÂµÃŽÂ¾ÃŽÂµÃÂÃŽÂ³ÃŽÂ±ÃÆ’ÃŽÂ¯ÃŽÂ± Ãâ€žÃâ€°ÃŽÂ½ Ãâ€ ÃŽÂ¿ÃŽÂ¹Ãâ€žÃŽÂ·Ãâ€žÃÅ½ÃŽÂ½', 'SchÃƒÂ¼ler bearbeiten', 'modifica dello studente', 'Ã Â¹ÂÃ Â¸ÂÃ Â¹â€°Ã Â¹â€žÃ Â¸â€šÃ Â¸â„¢Ã Â¸Â±Ã Â¸ÂÃ Â¹â‚¬Ã Â¸Â£Ã Â¸ÂµÃ Â¸Â¢Ã Â¸â„¢', 'Ã˜ÂªÃ˜Â±Ã™â€¦Ã›Å’Ã™â€¦ ÃšÂ©Ã›â€™ Ã˜Â·Ã˜Â§Ã™â€žÃ˜Â¨ Ã˜Â¹Ã™â€žÃ™â€¦', 'Ã Â¤Â¸Ã Â¤â€šÃ Â¤ÂªÃ Â¤Â¾Ã Â¤Â¦Ã Â¤Â¿Ã Â¤Â¤ Ã Â¤â€ºÃ Â¤Â¾Ã Â¤Â¤Ã Â¥ÂÃ Â¤Â°', 'edit studiosum', 'mengedit siswa', 'Ã§Â·Â¨Ã©â€ºâ€ Ã¥Â­Â¦Ã§â€Å¸', 'Ã­Å½Â¸Ã¬Â§â€˜ Ã­â€¢â„¢Ã¬Æ’Â'),
(18500, 'text_align', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(81, 'teacher_list', 'teacher list', '', 'lista maestra', 'قائمة المعلمين', 'leraar lijst', 'ÃÂ¡ÃÂ¿ÃÂ¸Ã‘ÂÃÂ¾ÃÂº Ã‘Æ’Ã‘â€¡ÃÂ¸Ã‘â€šÃÂµÃÂ»ÃÂµÃÂ¹', 'Ã¨â‚¬ÂÃ¥Â¸Ë†Ã¥ÂÂÃ¥Ââ€¢', 'ÃƒÂ¶Ã„Å¸retmen listesi', 'lista de professores', 'tanÃƒÂ¡r lista', 'Liste des enseignants', 'ÃŽâ€ºÃŽÂ¯ÃÆ’Ãâ€žÃŽÂ± Ãâ€žÃâ€°ÃŽÂ½ ÃŽÂµÃŽÂºÃâ‚¬ÃŽÂ±ÃŽÂ¹ÃŽÂ´ÃŽÂµÃâ€¦Ãâ€žÃŽÂ¹ÃŽÂºÃÅ½ÃŽÂ½', 'Lehrer-Liste', 'elenco degli insegnanti', 'Ã Â¸Â£Ã Â¸Â²Ã Â¸Â¢Ã Â¸Å Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸â€žÃ Â¸Â£Ã Â¸Â¹', 'Ã˜Â§Ã˜Â³Ã˜ÂªÃ˜Â§Ã˜Â¯ Ã™ÂÃ›ÂÃ˜Â±Ã˜Â³Ã˜Âª', 'Ã Â¤Â¶Ã Â¤Â¿Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â·Ã Â¤â€¢ Ã Â¤Â¸Ã Â¥â€šÃ Â¤Å¡Ã Â¥â‚¬', 'magister album', 'daftar guru', 'Ã¦â€¢â„¢Ã¥â€œÂ¡Ã£Æ’ÂªÃ£â€šÂ¹Ã£Æ’Ë†', 'ÃªÂµÂÃ¬â€šÂ¬Ã¬ÂËœ Ã«ÂªÂ©Ã«Â¡Â'),
(82, 'add_teacher', 'add teacher', '', 'aÃƒÂ±adir profesor', 'إضافة معلم', 'voeg leraar', 'ÃÂ´ÃÂ¾ÃÂ±ÃÂ°ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ Ã‘Æ’Ã‘â€¡ÃÂ¸Ã‘â€šÃÂµÃÂ»Ã‘Â', 'Ã¥Å Â Ã¤Â¸Å Ã¨â‚¬ÂÃ¥Â¸Ë†', 'ÃƒÂ¶Ã„Å¸retmen ekle', 'adicionar professor', 'hozzÃƒÂ¡ tanÃƒÂ¡r', 'ajouter enseignant', 'Ãâ‚¬ÃÂÃŽÂ¿ÃÆ’ÃŽÂ¸ÃŽÂ­ÃÆ’Ãâ€žÃŽÂµ ÃŽÂ´ÃŽÂ¬ÃÆ’ÃŽÂºÃŽÂ±ÃŽÂ»ÃŽÂ¿Ãâ€š', 'Lehrer hinzufÃƒÂ¼gen', 'aggiungere insegnante', 'Ã Â¹â‚¬Ã Â¸Å¾Ã Â¸Â´Ã Â¹Ë†Ã Â¸Â¡Ã Â¸â€žÃ Â¸Â£Ã Â¸Â¹', 'Ã˜Â§Ã˜Â³Ã˜ÂªÃ˜Â§Ã˜Â¯ Ã˜Â´Ã˜Â§Ã™â€¦Ã™â€ž', 'Ã Â¤Â¶Ã Â¤Â¿Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â·Ã Â¤â€¢ Ã Â¤Å“Ã Â¥â€¹Ã Â¤Â¡Ã Â¤Â¼', 'Magister addit', 'menambah guru', 'Ã¥â€¦Ë†Ã§â€Å¸Ã£â€šâ€™Ã¨Â¿Â½Ã¥Å Â ', 'ÃªÂµÂÃ¬â€šÂ¬Ã«Â¥Â¼ Ã¬Â¶â€ÃªÂ°â‚¬'),
(83, 'teacher_name', 'teacher name', '', 'Nombre del profesor', 'اسم المعلم', 'leraarsnaam', 'ÃËœÃÂ¼Ã‘Â Ã‘Æ’Ã‘â€¡ÃÂ¸Ã‘â€šÃÂµÃÂ»Ã‘Â', 'Ã¨â‚¬ÂÃ¥Â¸Ë†Ã¥Â§â€œÃ¥ÂÂ', 'ÃƒÂ¶Ã„Å¸retmen adÃ„Â±', 'nome professor', 'tanÃƒÂ¡r nÃƒÂ©v', 'nom des enseignants', 'ÃÅ’ÃŽÂ½ÃŽÂ¿ÃŽÂ¼ÃŽÂ± Ãâ€žÃâ€°ÃŽÂ½ ÃŽÂµÃŽÂºÃâ‚¬ÃŽÂ±ÃŽÂ¹ÃŽÂ´ÃŽÂµÃâ€¦Ãâ€žÃŽÂ¹ÃŽÂºÃÅ½ÃŽÂ½', 'Lehrer Name', 'Nome del docente', 'Ã Â¸Å Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸â€žÃ Â¸Â£Ã Â¸Â¹', 'Ã˜Â§Ã˜Â³Ã˜ÂªÃ˜Â§Ã˜Â¯ ÃšÂ©Ã˜Â§ Ã™â€ Ã˜Â§Ã™â€¦', 'Ã Â¤Â¶Ã Â¤Â¿Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â·Ã Â¤â€¢ Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤Â¨Ã Â¤Â¾Ã Â¤Â®', 'magister nomine', 'nama guru', 'Ã¦â€¢â„¢Ã¥â€œÂ¡Ã¥ÂÂ', 'ÃªÂµÂÃ¬â€šÂ¬ Ã¬ÂÂ´Ã«Â¦â€ž'),
(84, 'edit_teacher', 'edit teacher', '', 'edit maestro', 'تحرير المعلم', 'leraar bewerken', 'ÃÂ¿Ã‘â‚¬ÃÂ°ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ Ã‘Æ’Ã‘â€¡ÃÂ¸Ã‘â€šÃÂµÃÂ»Ã‘Å’', 'Ã§Â¼â€“Ã¨Â¾â€˜Ã¨â‚¬ÂÃ¥Â¸Ë†', 'edit ÃƒÂ¶Ã„Å¸retmen', 'editar professor', 'szerkesztÃƒÂ©s tanÃƒÂ¡r', 'modifier enseignant', 'edit ÃŽÂµÃŽÂºÃâ‚¬ÃŽÂ±ÃŽÂ¹ÃŽÂ´ÃŽÂµÃâ€¦Ãâ€žÃŽÂ¹ÃŽÂºÃÅ½ÃŽÂ½', 'edit Lehrer', 'modifica insegnante', 'Ã Â¹ÂÃ Â¸ÂÃ Â¹â€°Ã Â¹â€žÃ Â¸â€šÃ Â¸â€žÃ Â¸Â£Ã Â¸Â¹', 'Ã˜ÂªÃ˜Â±Ã™â€¦Ã›Å’Ã™â€¦ Ã˜Â§Ã˜Â³Ã˜ÂªÃ˜Â§Ã˜Â¯', 'Ã Â¤Â¸Ã Â¤â€šÃ Â¤ÂªÃ Â¤Â¾Ã Â¤Â¦Ã Â¤Â¿Ã Â¤Â¤ Ã Â¤â€¢Ã Â¤Â°Ã Â¥â€¡Ã Â¤â€š Ã Â¤Â¶Ã Â¤Â¿Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â·Ã Â¤â€¢', 'edit magister', 'mengedit guru', 'Ã§Â·Â¨Ã©â€ºâ€ Ã£ÂÂ®Ã¥â€¦Ë†Ã§â€Å¸', 'Ã­Å½Â¸Ã¬Â§â€˜ ÃªÂµÂÃ¬â€šÂ¬'),
(85, 'manage_parent', 'manage parent', '', 'gestionar los padres', 'إدارة الأم', 'beheren ouder', 'Ã‘Æ’ÃÂ¿Ã‘â‚¬ÃÂ°ÃÂ²ÃÂ»Ã‘ÂÃ‘â€šÃ‘Å’ Ã‘â‚¬ÃÂ¾ÃÂ´ÃÂ¸Ã‘â€šÃÂµÃÂ»ÃÂµÃÂ¹', 'Ã¦Â¯ÂÃ¥â€¦Â¬Ã¥ÂÂ¸Ã§Â®Â¡Ã§Ââ€ ', 'ebeveyn yÃƒÂ¶netmek', 'gerenciar pai', 'kezelni szÃƒÂ¼lÃ…â€˜', 'gÃƒÂ©rer parent', 'ÃŽÂ´ÃŽÂ¹ÃŽÂ±Ãâ€¡ÃŽÂµÃŽÂ¯ÃÂÃŽÂ¹ÃÆ’ÃŽÂ· ÃŽÂ¼ÃŽÂ·Ãâ€žÃÂÃŽÂ¹ÃŽÂºÃŽÂ®', 'verwalten Mutter', 'gestione genitore', 'Ã Â¸Ë†Ã Â¸Â±Ã Â¸â€Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸â€ºÃ Â¸ÂÃ Â¸â€žÃ Â¸Â£Ã Â¸Â­Ã Â¸â€¡', 'Ã™Ë†Ã˜Â§Ã™â€žÃ˜Â¯Ã›Å’Ã™â€  ÃšÂ©Ã˜Â§ Ã˜Â§Ã™â€ Ã˜ÂªÃ˜Â¸Ã˜Â§Ã™â€¦', 'Ã Â¤Â®Ã Â¤Â¾Ã Â¤Â¤Ã Â¤Â¾ - Ã Â¤ÂªÃ Â¤Â¿Ã Â¤Â¤Ã Â¤Â¾ Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¤Â¬Ã Â¤â€šÃ Â¤Â§Ã Â¤Â¨', 'curo parent', 'mengelola orang tua', 'Ã¨Â¦ÂªÃ£â€šâ€™Ã§Â®Â¡Ã§Ââ€ ', 'Ã«Â¶â‚¬Ã«ÂªÂ¨ ÃªÂ´â‚¬Ã«Â¦Â¬'),
(86, 'parent_list', 'parent list', '', 'lista primaria', 'قائمة الوالدين', 'ouder lijst', 'Ã‘â‚¬ÃÂ¾ÃÂ´ÃÂ¸Ã‘â€šÃÂµÃÂ»Ã‘Å’Ã‘ÂÃÂºÃÂ¾ÃÂ³ÃÂ¾ Ã‘ÂÃÂ¿ÃÂ¸Ã‘ÂÃÂºÃÂ°', 'Ã§Ë†Â¶Ã¥Ë†â€”Ã¨Â¡Â¨', 'ebeveyn listesi', 'lista pai', 'szÃƒÂ¼lÃ…â€˜ lista', 'liste parent', 'ÃŽÂ¼ÃŽÂ·Ãâ€žÃÂÃŽÂ¹ÃŽÂºÃŽÂ® ÃŽÂ»ÃŽÂ¯ÃÆ’Ãâ€žÃŽÂ±', 'geordneten Liste', 'elenco padre', 'Ã Â¸Â£Ã Â¸Â²Ã Â¸Â¢Ã Â¸Å Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸Å“Ã Â¸Â¹Ã Â¹â€°Ã Â¸â€ºÃ Â¸ÂÃ Â¸â€žÃ Â¸Â£Ã Â¸Â­Ã Â¸â€¡', 'Ã™Ë†Ã˜Â§Ã™â€žÃ˜Â¯Ã›Å’Ã™â€  ÃšÂ©Ã›Å’ Ã™ÂÃ›ÂÃ˜Â±Ã˜Â³Ã˜Âª', 'Ã Â¤Â®Ã Â¤Â¾Ã Â¤Â¤Ã Â¤Â¾ - Ã Â¤ÂªÃ Â¤Â¿Ã Â¤Â¤Ã Â¤Â¾ Ã Â¤Â¸Ã Â¥â€šÃ Â¤Å¡Ã Â¥â‚¬', 'parente album', 'daftar induk', 'Ã¨Â¦ÂªÃ£Æ’ÂªÃ£â€šÂ¹Ã£Æ’Ë†', 'Ã¬Æ’ÂÃ¬Å“â€ž Ã«ÂªÂ©Ã«Â¡Â'),
(87, 'parent_name', 'parent name', '', 'Nombre del padre', 'اسم الوالدين', 'oudernaam', 'Ã‘â‚¬ÃÂ¾ÃÂ´ÃÂ¸Ã‘â€šÃÂµÃÂ»Ã‘Å’ ÃÂ½ÃÂ°ÃÂ·ÃÂ²ÃÂ°ÃÂ½ÃÂ¸ÃÂµ', 'Ã§Ë†Â¶Ã¥ÂÂ', 'ebeveyn isim', 'nome do pai', 'szÃƒÂ¼lÃ…â€˜ nÃƒÂ©v', 'nom du parent', 'ÃŽÂ¼ÃŽÂ·Ãâ€žÃÂÃŽÂ¹ÃŽÂºÃÅ’ ÃÅ’ÃŽÂ½ÃŽÂ¿ÃŽÂ¼ÃŽÂ±', 'Mutternamen', 'nome del padre', 'Ã Â¸Å Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸Å“Ã Â¸Â¹Ã Â¹â€°Ã Â¸â€ºÃ Â¸ÂÃ Â¸â€žÃ Â¸Â£Ã Â¸Â­Ã Â¸â€¡', 'Ã™Ë†Ã˜Â§Ã™â€žÃ˜Â¯Ã›Å’Ã™â€  ÃšÂ©Ã›â€™ Ã™â€ Ã˜Â§Ã™â€¦', 'Ã Â¤Â®Ã Â¤Â¾Ã Â¤Â¤Ã Â¤Â¾ - Ã Â¤ÂªÃ Â¤Â¿Ã Â¤Â¤Ã Â¤Â¾ Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤Â¨Ã Â¤Â¾Ã Â¤Â®', 'Nomen parentis,', 'nama orang tua', 'Ã¨Â¦ÂªÃ£ÂÂ®Ã¥ÂÂÃ¥â€°Â', 'Ã«Â¶â‚¬Ã«ÂªÂ¨ Ã¬ÂÂ´Ã«Â¦â€ž'),
(88, 'relation_with_student', 'relation with student', '', 'relaciÃƒÂ³n con el estudiante', 'العلاقة مع الطالب', 'relatie met student', 'ÃÂ¾Ã‘â€šÃÂ½ÃÂ¾Ã‘Ë†ÃÂµÃÂ½ÃÂ¸Ã‘Â Ã‘Â Ã‘Æ’Ã‘â€¡ÃÂµÃÂ½ÃÂ¸ÃÂºÃÂ¾ÃÂ¼', 'Ã¤Â¸Å½Ã¥Â­Â¦Ã§â€Å¸Ã¥â€¦Â³Ã§Â³Â»', 'ÃƒÂ¶Ã„Å¸renci ile iliÃ…Å¸kisi', 'relaÃƒÂ§ÃƒÂ£o com o aluno', 'kapcsolatban diÃƒÂ¡k', 'relation avec l''ÃƒÂ©lÃƒÂ¨ve', 'ÃÆ’Ãâ€¡ÃŽÂ­ÃÆ’ÃŽÂ· ÃŽÂ¼ÃŽÂµ Ãâ€žÃŽÂ¿ÃŽÂ½ ÃŽÂ¼ÃŽÂ±ÃŽÂ¸ÃŽÂ·Ãâ€žÃŽÂ®', 'Zusammenhang mit Studenten', 'rapporto con lo studente', 'Ã Â¸â€žÃ Â¸Â§Ã Â¸Â²Ã Â¸Â¡Ã Â¸ÂªÃ Â¸Â±Ã Â¸Â¡Ã Â¸Å¾Ã Â¸Â±Ã Â¸â„¢Ã Â¸ËœÃ Â¹Å’Ã Â¸ÂÃ Â¸Â±Ã Â¸Å¡Ã Â¸â„¢Ã Â¸Â±Ã Â¸ÂÃ Â¹â‚¬Ã Â¸Â£Ã Â¸ÂµÃ Â¸Â¢Ã Â¸â„¢', 'Ã˜Â·Ã˜Â§Ã™â€žÃ˜Â¨ Ã˜Â¹Ã™â€žÃ™â€¦ ÃšÂ©Ã›â€™ Ã˜Â³Ã˜Â§Ã˜ÂªÃšÂ¾ Ã˜ÂªÃ˜Â¹Ã™â€žÃ™â€š', 'Ã Â¤â€ºÃ Â¤Â¾Ã Â¤Â¤Ã Â¥ÂÃ Â¤Â°Ã Â¤Â¾ Ã Â¤â€¢Ã Â¥â€¡ Ã Â¤Â¸Ã Â¤Â¾Ã Â¤Â¥ Ã Â¤Â¸Ã Â¤â€šÃ Â¤Â¬Ã Â¤â€šÃ Â¤Â§', 'cum inter ipsum', 'hubungan dengan siswa', 'Ã¥Â­Â¦Ã§â€Å¸Ã£ÂÂ¨Ã£ÂÂ®Ã©â€“Â¢Ã¤Â¿â€š', 'Ã­â€¢â„¢Ã¬Æ’ÂÃªÂ³Â¼Ã¬ÂËœ ÃªÂ´â‚¬ÃªÂ³â€ž'),
(89, 'parent_email', 'parent email', '', 'correo electrÃƒÂ³nico de los padres', 'البريد الإلكتروني الأم', 'ouder email', 'Ã‘â‚¬ÃÂ¾ÃÂ´ÃÂ¸Ã‘â€šÃÂµÃÂ»Ã‘Å’ ÃÂ¿ÃÂ¸Ã‘ÂÃ‘Å’ÃÂ¼ÃÂ¾', 'Ã§Ë†Â¶Ã¦Â¯ÂÃ§Å¡â€žÃ§â€ÂµÃ¥Â­ÂÃ©â€šÂ®Ã¤Â»Â¶', 'ebeveyn email', 'e-mail dos pais', 'szÃƒÂ¼lÃ…â€˜ e-mail', 'parent email', 'email Ãâ€žÃŽÂ¿Ãâ€¦ ÃŽÂ³ÃŽÂ¿ÃŽÂ½ÃŽÂ­ÃŽÂ±', 'Eltern per E-Mail', 'email genitore', 'Ã Â¸Â­Ã Â¸ÂµÃ Â¹â‚¬Ã Â¸Â¡Ã Â¸Â¥Ã Â¹Å’Ã Â¸Å“Ã Â¸Â¹Ã Â¹â€°Ã Â¸â€ºÃ Â¸ÂÃ Â¸â€žÃ Â¸Â£Ã Â¸Â­Ã Â¸â€¡', 'Ã™Ë†Ã˜Â§Ã™â€žÃ˜Â¯Ã›Å’Ã™â€  ÃšÂ©Ã˜Â§ Ã˜Â§Ã›Å’ Ã™â€¦Ã›Å’Ã™â€ž', 'Ã Â¤Â®Ã Â¤Â¾Ã Â¤Â¤Ã Â¤Â¾ - Ã Â¤ÂªÃ Â¤Â¿Ã Â¤Â¤Ã Â¤Â¾ Ã Â¤Ë†Ã Â¤Â®Ã Â¥â€¡Ã Â¤Â²', 'parente email', 'email induk', 'Ã¨Â¦ÂªÃ©â€ºÂ»Ã¥Â­ÂÃ£Æ’Â¡Ã£Æ’Â¼Ã£Æ’Â«', 'Ã«Â¶â‚¬Ã«ÂªÂ¨Ã¬ÂËœ Ã¬ÂÂ´Ã«Â©â€Ã¬ÂÂ¼'),
(90, 'parent_phone', 'parent phone', '', 'telÃƒÂ©fono de los padres', 'الهاتف الأم', 'ouder telefoon', 'Ã‘â‚¬ÃÂ¾ÃÂ´ÃÂ¸Ã‘â€šÃÂµÃÂ»Ã‘Å’ Ã‘â€šÃÂµÃÂ»ÃÂµÃ‘â€žÃÂ¾ÃÂ½', 'Ã¥Â®Â¶Ã©â€¢Â¿Ã§â€ÂµÃ¨Â¯Â', 'ebeveyn telefon', 'telefone dos pais', 'szÃƒÂ¼lÃ…â€˜ telefon', 'mÃƒÂ¨re de tÃƒÂ©lÃƒÂ©phone', 'ÃŽÂ¼ÃŽÂ·Ãâ€žÃÂÃŽÂ¹ÃŽÂºÃŽÂ® Ãâ€žÃŽÂ·ÃŽÂ»ÃŽÂ­Ãâ€ Ãâ€°ÃŽÂ½ÃŽÂ¿', 'Elterntelefon', 'telefono genitore', 'Ã Â¹â€šÃ Â¸â€”Ã Â¸Â£Ã Â¸Â¨Ã Â¸Â±Ã Â¸Å¾Ã Â¸â€”Ã Â¹Å’Ã Â¸â€šÃ Â¸Â­Ã Â¸â€¡Ã Â¸Å“Ã Â¸Â¹Ã Â¹â€°Ã Â¸â€ºÃ Â¸ÂÃ Â¸â€žÃ Â¸Â£Ã Â¸Â­Ã Â¸â€¡', 'Ã™Ë†Ã˜Â§Ã™â€žÃ˜Â¯Ã›Å’Ã™â€  Ã™ÂÃ™Ë†Ã™â€ ', 'Ã Â¤Â®Ã Â¤Â¾Ã Â¤Â¤Ã Â¤Â¾ - Ã Â¤ÂªÃ Â¤Â¿Ã Â¤Â¤Ã Â¤Â¾ Ã Â¤â€¢Ã Â¥â€¹ Ã Â¤Â«Ã Â¥â€¹Ã Â¤Â¨', 'parentis phone', 'telepon orang tua', 'Ã¨Â¦ÂªÃ£ÂÂ®Ã¦ÂÂºÃ¥Â¸Â¯Ã©â€ºÂ»Ã¨Â©Â±', 'Ã«Â¶â‚¬Ã«ÂªÂ¨ Ã¬Â â€žÃ­â„¢â€'),
(91, 'parrent_address', 'parrent address', '', 'DirecciÃƒÂ³n Parrent', 'عنوان بارنت', 'parrent adres', 'Parrent ÃÂ°ÃÂ´Ã‘â‚¬ÃÂµÃ‘Â', 'parrentÃ¥Å“Â°Ã¥Ââ‚¬', 'parrent adresi', 'endereÃƒÂ§o Parrent', 'parrent cÃƒÂ­m', 'adresse Parrent', 'parrent ÃŽÂ´ÃŽÂ¹ÃŽÂµÃÂÃŽÂ¸Ãâ€¦ÃŽÂ½ÃÆ’ÃŽÂ·', 'parrent Adresse', 'Indirizzo parrent', 'Ã Â¸â€”Ã Â¸ÂµÃ Â¹Ë†Ã Â¸Â­Ã Â¸Â¢Ã Â¸Â¹Ã Â¹Ë† parrent', 'parrent Ã˜Â§Ã›Å’ÃšË†Ã˜Â±Ã›Å’Ã˜Â³', 'parrent Ã Â¤ÂªÃ Â¤Â¤Ã Â¤Â¾', 'oratio parrent', 'alamat parrent', 'parrentÃ£â€šÂ¢Ã£Æ’â€°Ã£Æ’Â¬Ã£â€šÂ¹', 'parrent Ã¬Â£Â¼Ã¬â€ Å’'),
(92, 'parrent_occupation', 'parrent occupation', '', 'ocupaciÃƒÂ³n Parrent', 'الاحتلال الأم', 'parrent bezetting', 'Parrent ÃÂ¾ÃÂºÃÂºÃ‘Æ’ÃÂ¿ÃÂ°Ã‘â€ ÃÂ¸Ã‘Â', 'parrentÃ¨ÂÅ’Ã¤Â¸Å¡', 'parrent iÃ…Å¸gal', 'ocupaÃƒÂ§ÃƒÂ£o Parrent', 'parrent FoglalkozÃƒÂ¡s', 'occupation Parrent', 'parrent ÃŽÂµÃâ‚¬ÃŽÂ¬ÃŽÂ³ÃŽÂ³ÃŽÂµÃŽÂ»ÃŽÂ¼ÃŽÂ±', 'parrent Beruf', 'occupazione parrent', 'Ã Â¸Â­Ã Â¸Â²Ã Â¸Å Ã Â¸ÂµÃ Â¸Å¾ parrent', 'parrent Ã™â€šÃ˜Â¨Ã˜Â¶Ã›â€™', 'parrent Ã Â¤â€¢Ã Â¤Â¬Ã Â¥ÂÃ Â¤Å“Ã Â¥â€¡', 'opus parrent', 'pendudukan parrent', 'parrentÃ¨ÂÂ·Ã¦Â¥Â­', 'parrent Ã¬Â§ÂÃ¬â€”â€¦'),
(93, 'add', 'add', '', 'aÃƒÂ±adir', 'إضافة', 'toevoegen', 'ÃÂ´ÃÂ¾ÃÂ±ÃÂ°ÃÂ²ÃÂ»Ã‘ÂÃ‘â€šÃ‘Å’', 'Ã¥Å Â ', 'eklemek', 'adicionar', 'hozzÃƒÂ¡ad', 'ajouter', 'Ãâ‚¬ÃÂÃŽÂ¿ÃÆ’ÃŽÂ¸ÃŽÂ®ÃŽÂºÃŽÂ·', 'hinzufÃƒÂ¼gen', 'aggiungere', 'Ã Â¹â‚¬Ã Â¸Å¾Ã Â¸Â´Ã Â¹Ë†Ã Â¸Â¡', 'Ã˜Â´Ã˜Â§Ã™â€¦Ã™â€ž', 'Ã Â¤Å“Ã Â¥â€¹Ã Â¤Â¡Ã Â¤Â¼Ã Â¤Â¨Ã Â¤Â¾', 'Adde', 'menambahkan', 'Ã¥Å Â Ã£ÂË†Ã£â€šâ€¹', 'Ã¬Â¶â€ÃªÂ°â‚¬'),
(94, 'parent_of', 'parent of', '', 'matriz de', 'إدارة الموضوع', 'ouder van', 'Ã‘â‚¬ÃÂ¾ÃÂ´ÃÂ¸Ã‘â€šÃÂµÃÂ»Ã‘Å’', 'Ã§Ë†Â¶', 'ebeveyn', 'pai', 'szÃƒÂ¼lÃ…â€˜', 'parent d''', 'ÃŽÂ³ÃŽÂ¿ÃŽÂ½ÃŽÂ­ÃŽÂ±Ãâ€š', 'Muttergesellschaft der', 'madre di', 'Ã Â¸Å“Ã Â¸Â¹Ã Â¹â€°Ã Â¸â€ºÃ Â¸ÂÃ Â¸â€žÃ Â¸Â£Ã Â¸Â­Ã Â¸â€¡Ã Â¸â€šÃ Â¸Â­Ã Â¸â€¡', 'Ã™Ë†Ã˜Â§Ã™â€žÃ˜Â¯Ã›Å’Ã™â€ ', 'Ã Â¤â€¢Ã Â¥â€¡ Ã Â¤Â®Ã Â¤Â¾Ã Â¤Â¤Ã Â¤Â¾ - Ã Â¤ÂªÃ Â¤Â¿Ã Â¤Â¤Ã Â¤Â¾', 'parentem,', 'induk dari', 'Ã£ÂÂ®Ã¨Â¦Âª', 'Ã¬ÂËœ Ã«Â¶â‚¬Ã«ÂªÂ¨'),
(95, 'profession', 'profession', '', 'profesiÃƒÂ³n', 'مهنة', 'beroep', 'ÃÂ¿Ã‘â‚¬ÃÂ¾Ã‘â€žÃÂµÃ‘ÂÃ‘ÂÃÂ¸Ã‘Â', 'Ã¨ÂÅ’Ã¤Â¸Å¡', 'meslek', 'profissÃƒÂ£o', 'szakma', 'profession', 'ÃŽÂµÃâ‚¬ÃŽÂ¬ÃŽÂ³ÃŽÂ³ÃŽÂµÃŽÂ»ÃŽÂ¼ÃŽÂ±', 'Beruf', 'professione', 'Ã Â¸Â­Ã Â¸Â²Ã Â¸Å Ã Â¸ÂµÃ Â¸Å¾', 'Ã™Â¾Ã›Å’Ã˜Â´Ã›Â', 'Ã Â¤ÂµÃ Â¥ÂÃ Â¤Â¯Ã Â¤ÂµÃ Â¤Â¸Ã Â¤Â¾Ã Â¤Â¯', 'professio', 'profesi', 'Ã¨ÂÂ·Ã¦Â¥Â­', 'Ã¬Â§ÂÃ¬â€”â€¦'),
(96, 'edit_parent', 'edit parent', '', 'edit padres', 'تحرير الأم', 'bewerk ouder', 'ÃÂ¿Ã‘â‚¬ÃÂ°ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ Ã‘â‚¬ÃÂ¾ÃÂ´ÃÂ¸Ã‘â€šÃÂµÃÂ»Ã‘Å’', 'Ã§Â¼â€“Ã¨Â¾â€˜Ã§Ë†Â¶', 'edit ebeveyn', 'ediÃƒÂ§ÃƒÂ£o pai', 'szerkesztÃƒÂ©s szÃƒÂ¼lÃ…â€˜', 'modifier parent', 'edit ÃŽÂ³ÃŽÂ¿ÃŽÂ½ÃŽÂ­ÃŽÂ±', 'edit Mutter', 'modifica genitore', 'Ã Â¹ÂÃ Â¸ÂÃ Â¹â€°Ã Â¹â€žÃ Â¸â€šÃ Â¸Å“Ã Â¸Â¹Ã Â¹â€°Ã Â¸â€ºÃ Â¸ÂÃ Â¸â€žÃ Â¸Â£Ã Â¸Â­Ã Â¸â€¡', 'Ã™â€¦Ã›Å’ÃšÂº Ã˜ÂªÃ˜Â±Ã™â€¦Ã›Å’Ã™â€¦ ÃšÂ©Ã˜Â±Ã›Å’ÃšÂº Ã™Ë†Ã˜Â§Ã™â€žÃ˜Â¯Ã›Å’Ã™â€ ', 'Ã Â¤Â¸Ã Â¤â€šÃ Â¤ÂªÃ Â¤Â¾Ã Â¤Â¦Ã Â¤Â¿Ã Â¤Â¤ Ã Â¤Å“Ã Â¤Â¨Ã Â¤â€¢', 'edit parent', 'mengedit induk', 'Ã§Â·Â¨Ã©â€ºâ€ Ã¨Â¦Âª', 'Ã­Å½Â¸Ã¬Â§â€˜ Ã«Â¶â‚¬Ã«ÂªÂ¨'),
(97, 'add_parent', 'add parent', '', 'aÃƒÂ±adir los padres', 'إضافة الوالد', 'Voeg een ouder', 'ÃÂ´ÃÂ¾ÃÂ±ÃÂ°ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ Ã‘â‚¬ÃÂ¾ÃÂ´ÃÂ¸Ã‘â€šÃÂµÃÂ»Ã‘Â', 'Ã¦Â·Â»Ã¥Å Â Ã§Ë†Â¶', 'ebeveyn ekle', 'adicionar pai', 'hozzÃƒÂ¡ szÃƒÂ¼lÃ…â€˜', 'ajouter parent', 'Ãâ‚¬ÃÂÃŽÂ¿ÃÆ’ÃŽÂ¸ÃŽÂ­ÃÆ’Ãâ€žÃŽÂµ ÃŽÂ¼ÃŽÂ·Ãâ€žÃÂÃŽÂ¹ÃŽÂºÃŽÂ®', 'Mutter hinzufÃƒÂ¼gen', 'aggiungere genitore', 'Ã Â¹â‚¬Ã Â¸Å¾Ã Â¸Â´Ã Â¹Ë†Ã Â¸Â¡Ã Â¸Å“Ã Â¸Â¹Ã Â¹â€°Ã Â¸â€ºÃ Â¸ÂÃ Â¸â€žÃ Â¸Â£Ã Â¸Â­Ã Â¸â€¡', 'Ã™Ë†Ã˜Â§Ã™â€žÃ˜Â¯Ã›Å’Ã™â€  Ã˜Â´Ã˜Â§Ã™â€¦Ã™â€ž', 'Ã Â¤Â®Ã Â¤Â¾Ã Â¤Â¤Ã Â¤Â¾ - Ã Â¤ÂªÃ Â¤Â¿Ã Â¤Â¤Ã Â¤Â¾ Ã Â¤Å“Ã Â¥â€¹Ã Â¤Â¡Ã Â¤Â¼', 'adde parent', 'menambahkan orang tua', 'Ã¨Â¦ÂªÃ£â€šâ€™Ã¨Â¿Â½Ã¥Å Â ', 'Ã«Â¶â‚¬Ã«ÂªÂ¨Ã«Â¥Â¼ Ã¬Â¶â€ÃªÂ°â‚¬');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `bengali`, `spanish`, `arabic`, `dutch`, `russian`, `chinese`, `turkish`, `portuguese`, `hungarian`, `french`, `greek`, `german`, `italian`, `thai`, `urdu`, `hindi`, `latin`, `indonesian`, `japanese`, `korean`) VALUES
(98, 'manage_subject', 'manage subject', '', 'gestionar sujeto', 'إدارة الموضوع', 'beheren onderwerp', 'Ã‘Æ’ÃÂ¿Ã‘â‚¬ÃÂ°ÃÂ²ÃÂ»Ã‘ÂÃ‘â€šÃ‘Å’ Ã‘â€šÃÂµÃÂ¼Ã‘Æ’', 'Ã§Â®Â¡Ã§Ââ€ Ã¤Â¸Â»Ã©Â¢Ëœ', 'konuyu yÃƒÂ¶netmek', 'gerenciar assunto', 'kezelni tÃƒÂ¡rgy', 'gÃƒÂ©rer sujet', 'ÃŽÂ´ÃŽÂ¹ÃŽÂ±Ãâ€¡ÃŽÂµÃŽÂ¯ÃÂÃŽÂ¹ÃÆ’ÃŽÂ· Ãâ€¦Ãâ‚¬ÃÅ’ÃŽÂºÃŽÂµÃŽÂ¹Ãâ€žÃŽÂ±ÃŽÂ¹', 'Thema verwalten', 'gestire i soggetti', 'Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸Ë†Ã Â¸Â±Ã Â¸â€Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¹â‚¬Ã Â¸Â£Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸â€¡', 'Ã™â€¦Ã™Ë†Ã˜Â¶Ã™Ë†Ã˜Â¹ ÃšÂ©Ã˜Â§ Ã˜Â§Ã™â€ Ã˜ÂªÃ˜Â¸Ã˜Â§Ã™â€¦', 'Ã Â¤ÂµÃ Â¤Â¿Ã Â¤Â·Ã Â¤Â¯ Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¤Â¬Ã Â¤â€šÃ Â¤Â§Ã Â¤Â¨', 'subiectum disponat', 'mengelola subjek', 'Ã¥Â¯Â¾Ã¨Â±Â¡Ã£â€šâ€™Ã§Â®Â¡Ã§Ââ€ ', 'Ã«Å’â‚¬Ã¬Æ’Â ÃªÂ´â‚¬Ã«Â¦Â¬'),
(99, 'subject_list', 'subject list', '', 'lista por materia', 'قائمة المواضيع', 'Onderwerp lijst', 'ÃÂ¡ÃÂ¿ÃÂ¸Ã‘ÂÃÂ¾ÃÂº ÃÂ¿ÃÂ¾ÃÂ´ÃÂ»ÃÂµÃÂ¶ÃÂ¸Ã‘â€š', 'Ã¤Â¸Â»Ã©Â¢ËœÃ¥Ë†â€”Ã¨Â¡Â¨', 'konu listesi', 'lista por assunto', 'tÃƒÂ©ma lista', 'liste de sujets', 'Ãâ€¦Ãâ‚¬ÃÅ’ÃŽÂºÃŽÂµÃŽÂ¹ÃŽÂ½Ãâ€žÃŽÂ±ÃŽÂ¹ ÃŽÂ»ÃŽÂ¯ÃÆ’Ãâ€žÃŽÂ±', 'Themenliste', 'lista soggetto', 'Ã Â¸Â£Ã Â¸Â²Ã Â¸Â¢Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¹â‚¬Ã Â¸Â£Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸â€¡', 'Ã™â€¦Ã™Ë†Ã˜Â¶Ã™Ë†Ã˜Â¹ ÃšÂ©Ã›Å’ Ã™ÂÃ›ÂÃ˜Â±Ã˜Â³Ã˜Âª', 'Ã Â¤ÂµÃ Â¤Â¿Ã Â¤Â·Ã Â¤Â¯ Ã Â¤Â¸Ã Â¥â€šÃ Â¤Å¡Ã Â¥â‚¬', 'subiectum album', 'daftar subjek', 'Ã£â€šÂµÃ£Æ’â€“Ã£â€šÂ¸Ã£â€šÂ§Ã£â€šÂ¯Ã£Æ’Ë†Ã£Æ’ÂªÃ£â€šÂ¹Ã£Æ’Ë†', 'Ã¬Â£Â¼Ã¬Â Å“ Ã«ÂªÂ©Ã«Â¡Â'),
(100, 'add_subject', 'add subject', '', 'AÃƒÂ±adir asunto', 'إضافة الموضوع', 'Onderwerp toevoegen', 'ÃÂ´ÃÂ¾ÃÂ±ÃÂ°ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ Ã‘â€šÃÂµÃÂ¼Ã‘Æ’', 'Ã¦â€“Â°Ã¥Â¢Å¾Ã¤Â¸Â»Ã©Â¢Ëœ', 'konu ekle', 'adicionar assunto', 'TÃƒÂ¡rgy hozzÃƒÂ¡adÃƒÂ¡sa', 'ajouter l''objet', 'ÃŽÂ ÃÂÃŽÂ¿ÃÆ’ÃŽÂ¸ÃŽÂ®ÃŽÂºÃŽÂ· ÃŽÂ¸ÃŽÂ­ÃŽÂ¼ÃŽÂ±Ãâ€žÃŽÂ¿Ãâ€š', 'Thema hinzufÃƒÂ¼gen', 'aggiungere soggetto', 'Ã Â¹â‚¬Ã Â¸Å¾Ã Â¸Â´Ã Â¹Ë†Ã Â¸Â¡Ã Â¹â‚¬Ã Â¸Â£Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸â€¡', 'Ã™â€¦Ã™Ë†Ã˜Â¶Ã™Ë†Ã˜Â¹', 'Ã Â¤Å“Ã Â¥â€¹Ã Â¤Â¡Ã Â¤Â¼Ã Â¥â€¡Ã Â¤â€š Ã Â¤ÂµÃ Â¤Â¿Ã Â¤Â·Ã Â¤Â¯', 're addere', 'menambahkan subjek', 'Ã¤Â»Â¶Ã¥ÂÂÃ£â€šâ€™Ã¨Â¿Â½Ã¥Å Â ', 'Ã¬Â Å“Ã«ÂªÂ©Ã¬Ââ€ž Ã¬Â¶â€ÃªÂ°â‚¬'),
(101, 'subject_name', 'subject name', '', 'nombre del sujeto', 'اسم الموضوع', 'Onderwerp naam', 'ÃÂ¸ÃÂ¼Ã‘Â Ã‘ÂÃ‘Æ’ÃÂ±Ã‘Å ÃÂµÃÂºÃ‘â€šÃÂ°', 'Ã¤Â¸Â»Ã©Â¢ËœÃ¥ÂÂÃ§Â§Â°', 'konu adÃ„Â±', 'nome do assunto', 'tÃƒÂ¡rgy megnevezÃƒÂ©se', 'nom du sujet', 'Ãâ€¦Ãâ‚¬ÃÅ’ÃŽÂºÃŽÂµÃŽÂ¹ÃŽÂ½Ãâ€žÃŽÂ±ÃŽÂ¹ ÃÅ’ÃŽÂ½ÃŽÂ¿ÃŽÂ¼ÃŽÂ±', 'Thema Namen', 'nome del soggetto', 'Ã Â¸Å Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¹â‚¬Ã Â¸Â£Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸â€¡', 'Ã™â€¦Ã™Ë†Ã˜Â¶Ã™Ë†Ã˜Â¹ ÃšÂ©Ã›â€™ Ã™â€ Ã˜Â§Ã™â€¦', 'Ã Â¤ÂµÃ Â¤Â¿Ã Â¤Â·Ã Â¤Â¯ Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤Â¨Ã Â¤Â¾Ã Â¤Â®', 'agitur nomine', 'nama subjek', 'Ã£â€šÂµÃ£Æ’â€“Ã£â€šÂ¸Ã£â€šÂ§Ã£â€šÂ¯Ã£Æ’Ë†Ã¥ÂÂ', 'Ã¬Â£Â¼Ã¬Â²Â´ Ã¬ÂÂ´Ã«Â¦â€ž'),
(102, 'edit_subject', 'edit subject', '', 'Editar asunto', 'تحرير الموضوع', 'Onderwerp bewerken', 'ÃËœÃÂ·ÃÂ¼ÃÂµÃÂ½ÃÂ¸Ã‘â€šÃ‘Å’ Ã‘â€šÃÂµÃÂ¼Ã‘Æ’', 'Ã§Â¼â€“Ã¨Â¾â€˜Ã¤Â¸Â»Ã©Â¢Ëœ', 'dÃƒÂ¼zenleme konusu', 'Editar assunto', 'TÃƒÂ¡rgy szerkesztÃƒÂ©se', 'modifier l''objet', 'edit ÃŽÂ¸ÃŽÂ­ÃŽÂ¼ÃŽÂ±', 'Betreff bearbeiten', 'Modifica oggetto', 'Ã Â¹ÂÃ Â¸ÂÃ Â¹â€°Ã Â¹â€žÃ Â¸â€šÃ Â¹â‚¬Ã Â¸Â£Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸â€¡', 'Ã™â€¦Ã™Ë†Ã˜Â¶Ã™Ë†Ã˜Â¹ Ã™â€¦Ã›Å’ÃšÂº Ã˜ÂªÃ˜Â±Ã™â€¦Ã›Å’Ã™â€¦ ÃšÂ©Ã˜Â±Ã›Å’ÃšÂº', 'Ã Â¤ÂµÃ Â¤Â¿Ã Â¤Â·Ã Â¤Â¯ Ã Â¤Â¸Ã Â¤â€šÃ Â¤ÂªÃ Â¤Â¾Ã Â¤Â¦Ã Â¤Â¿Ã Â¤Â¤ Ã Â¤â€¢Ã Â¤Â°Ã Â¥â€¡Ã Â¤â€š', 'edit subiecto', 'mengedit subjek', 'Ã§Â·Â¨Ã©â€ºâ€ Ã¥Â¯Â¾Ã¨Â±Â¡', 'Ã¬Â Å“Ã«ÂªÂ© Ã¬Ë†ËœÃ¬Â â€¢'),
(103, 'manage_class', 'manage class', '', 'gestionar clase', 'إدارة الصف', 'beheren klasse', 'Ã‘Æ’ÃÂ¿Ã‘â‚¬ÃÂ°ÃÂ²ÃÂ»Ã‘ÂÃ‘â€šÃ‘Å’ ÃÂºÃÂ»ÃÂ°Ã‘ÂÃ‘Â', 'Ã§Â®Â¡Ã§Ââ€ Ã§Â±Â»', 'sÃ„Â±nÃ„Â±f yÃƒÂ¶netmek', 'gerenciar classe', 'kezelni osztÃƒÂ¡ly', 'gÃƒÂ©rer classe', 'ÃŽÂ´ÃŽÂ¹ÃŽÂ±Ãâ€¡ÃŽÂµÃŽÂ¯ÃÂÃŽÂ¹ÃÆ’ÃŽÂ· Ãâ€žÃŽÂ¬ÃŽÂ¾ÃŽÂ·Ãâ€š', 'Klasse verwalten', 'gestione della classe', 'Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸Ë†Ã Â¸Â±Ã Â¸â€Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸Å Ã Â¸Â±Ã Â¹â€°Ã Â¸â„¢Ã Â¹â‚¬Ã Â¸Â£Ã Â¸ÂµÃ Â¸Â¢Ã Â¸â„¢', 'ÃšÂ©Ã™â€žÃ˜Â§Ã˜Â³ ÃšÂ©Ã˜Â§ Ã˜Â§Ã™â€ Ã˜ÂªÃ˜Â¸Ã˜Â§Ã™â€¦', 'Ã Â¤ÂµÃ Â¤Â°Ã Â¥ÂÃ Â¤â€” Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¤Â¬Ã Â¤â€šÃ Â¤Â§Ã Â¤Â¨', 'genus regendi', 'mengelola kelas', 'Ã£â€šÂ¯Ã£Æ’Â©Ã£â€šÂ¹Ã£â€šâ€™Ã§Â®Â¡Ã§Ââ€ ', 'Ã­ÂÂ´Ã«Å¾ËœÃ¬Å Â¤Ã¬â€”ÂÃªÂ²Å’ ÃªÂ´â‚¬Ã«Â¦Â¬'),
(104, 'class_list', 'class list', '', 'lista de la clase', 'قائمة الطبقة', 'klasse lijst', 'ÃÂ¡ÃÂ¿ÃÂ¸Ã‘ÂÃÂ¾ÃÂº ÃÂºÃÂ»ÃÂ°Ã‘ÂÃ‘Â', 'Ã§Â±Â»Ã¥Ë†â€”Ã¨Â¡Â¨', 'sÃ„Â±nÃ„Â±f listesi', 'lista de classe', 'class lista', 'liste de classe', 'Ãâ‚¬ÃŽÂ¯ÃŽÂ½ÃŽÂ±ÃŽÂºÃŽÂ±Ãâ€š ÃŽÂ±Ãâ‚¬ÃŽÂ¿Ãâ€žÃŽÂµÃŽÂ»ÃŽÂµÃÆ’ÃŽÂ¼ÃŽÂ¬Ãâ€žÃâ€°ÃŽÂ½', 'Klassenliste', 'elenco di classe', 'Ã Â¸Â£Ã Â¸Â²Ã Â¸Â¢Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸Å Ã Â¸Â±Ã Â¹â€°Ã Â¸â„¢', 'ÃšÂ©Ã™â€žÃ˜Â§Ã˜Â³ Ã™ÂÃ›ÂÃ˜Â±Ã˜Â³Ã˜Âª', 'Ã Â¤â€¢Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â·Ã Â¤Â¾ Ã Â¤Â¸Ã Â¥â€šÃ Â¤Å¡Ã Â¥â‚¬', 'genus album', 'daftar kelas', 'Ã£â€šÂ¯Ã£Æ’Â©Ã£â€šÂ¹Ã£Æ’ÂªÃ£â€šÂ¹Ã£Æ’Ë†', 'Ã­ÂÂ´Ã«Å¾ËœÃ¬Å Â¤ Ã«ÂªÂ©Ã«Â¡Â'),
(105, 'add_class', 'add class', '', 'agregar la clase', 'إضافة فئة', 'voeg klasse', 'ÃÂ´ÃÂ¾ÃÂ±ÃÂ°ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ ÃÂºÃÂ»ÃÂ°Ã‘ÂÃ‘Â', 'Ã¦Â·Â»Ã¥Å Â Ã§Â±Â»', 'sÃ„Â±nÃ„Â±f eklemek', 'adicionar classe', 'hozzÃƒÂ¡ osztÃƒÂ¡ly', 'ajouter la classe', 'Ãâ‚¬ÃÂÃŽÂ¿ÃÆ’ÃŽÂ¸ÃŽÂ­ÃÆ’ÃŽÂµÃâ€žÃŽÂµ Ãâ€žÃŽÂ¬ÃŽÂ¾ÃŽÂ·', 'Klasse hinzufÃƒÂ¼gen', 'aggiungere classe', 'Ã Â¹â‚¬Ã Â¸Å¾Ã Â¸Â´Ã Â¹Ë†Ã Â¸Â¡Ã Â¸Â£Ã Â¸Â°Ã Â¸â€Ã Â¸Â±Ã Â¸Å¡', 'ÃšÂ©Ã™â€žÃ˜Â§Ã˜Â³ Ã˜Â´Ã˜Â§Ã™â€¦Ã™â€ž ÃšÂ©Ã˜Â±Ã›Å’ÃšÂº', 'Ã Â¤ÂµÃ Â¤Â°Ã Â¥ÂÃ Â¤â€” Ã Â¤Å“Ã Â¥â€¹Ã Â¤Â¡Ã Â¤Â¼', 'adde genus', 'menambahkan kelas', 'Ã£â€šÂ¯Ã£Æ’Â©Ã£â€šÂ¹Ã£â€šâ€™Ã¨Â¿Â½Ã¥Å Â ', 'Ã­ÂÂ´Ã«Å¾ËœÃ¬Å Â¤Ã«Â¥Â¼ Ã¬Â¶â€ÃªÂ°â‚¬'),
(106, 'class_name', 'class name', '', 'nombre de la clase', 'اسم الفئة', 'class naam', 'ÃËœÃÂ¼Ã‘Â ÃÂºÃÂ»ÃÂ°Ã‘ÂÃ‘ÂÃÂ°', 'Ã§Â±Â»Ã¥ÂÂ', 'sÃ„Â±nÃ„Â±f adÃ„Â±', 'nome da classe', 'osztÃƒÂ¡ly neve', 'nom de la classe', 'ÃÅ’ÃŽÂ½ÃŽÂ¿ÃŽÂ¼ÃŽÂ± Ãâ€žÃŽÂ·Ãâ€š ÃŽÂºÃŽÂ»ÃŽÂ¬ÃÆ’ÃŽÂ·Ãâ€š', 'Klassennamen', 'nome della classe', 'Ã Â¸Å Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸Å Ã Â¸Â±Ã Â¹â€°Ã Â¸â„¢', 'ÃšÂ©Ã™â€žÃ˜Â§Ã˜Â³ Ã™â€ Ã˜Â§Ã™â€¦', 'Ã Â¤ÂµÃ Â¤Â°Ã Â¥ÂÃ Â¤â€” Ã Â¤â€¢Ã Â¥â€¡ Ã Â¤Â¨Ã Â¤Â¾Ã Â¤Â®', 'Classis nomine', 'nama kelas', 'Ã£â€šÂ¯Ã£Æ’Â©Ã£â€šÂ¹Ã¥ÂÂ', 'Ã­ÂÂ´Ã«Å¾ËœÃ¬Å Â¤ Ã¬ÂÂ´Ã«Â¦â€ž'),
(107, 'numeric_name', 'numeric name', '', 'nombre numÃƒÂ©rico', 'اسم رقمي', 'numerieke naam', 'Ã‘â€¡ÃÂ¸Ã‘ÂÃÂ»ÃÂ¾ÃÂ²ÃÂ¾ÃÂµ ÃÂ¸ÃÂ¼Ã‘Â', 'Ã¦â€¢Â°Ã¥Â­â€”Ã¥ÂÂÃ§Â§Â°', 'SayÃ„Â±sal isim', 'nome numÃƒÂ©rico', 'numerikus nÃƒÂ©v', 'nom numÃƒÂ©rique', 'ÃŽÂ±ÃÂÃŽÂ¹ÃŽÂ¸ÃŽÂ¼ÃŽÂ·Ãâ€žÃŽÂ¹ÃŽÂºÃÅ’ ÃÅ’ÃŽÂ½ÃŽÂ¿ÃŽÂ¼ÃŽÂ±', 'numerischen Namen', 'nome numerico', 'Ã Â¸Å Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸â€¢Ã Â¸Â±Ã Â¸Â§Ã Â¹â‚¬Ã Â¸Â¥Ã Â¸â€š', 'Ã˜Â¹Ã˜Â¯Ã˜Â¯Ã›Å’ Ã™â€ Ã˜Â§Ã™â€¦', 'Ã Â¤Â¸Ã Â¤Â¾Ã Â¤â€šÃ Â¤â€“Ã Â¥ÂÃ Â¤Â¯Ã Â¤Â¿Ã Â¤â€¢ Ã Â¤Â¨Ã Â¤Â¾Ã Â¤Â®', 'secundum numerum est secundum nomen,', 'Nama numerik', 'Ã¦â€¢Â°Ã¥â‚¬Â¤Ã£ÂÂ®Ã¥ÂÂÃ¥â€°Â', 'Ã¬Ë†Â«Ã¬Å¾Â Ã¬ÂÂ´Ã«Â¦â€ž'),
(108, 'name_numeric', 'name numeric', '', 'nombre numÃƒÂ©rico', 'اسم رقمي', 'naam numerieke', 'ÃÂ½ÃÂ°ÃÂ·ÃÂ²ÃÂ°Ã‘â€šÃ‘Å’ Ã‘â€¡ÃÂ¸Ã‘ÂÃÂ»ÃÂ¾ÃÂ²ÃÂ¾ÃÂ¹', 'Ã¦â€¢Â°Ã¥Â­â€”Ã¥â€˜Â½Ã¥ÂÂ', 'sayÃ„Â±sal isim', 'nome numÃƒÂ©rico', 'nÃƒÂ©v numerikus', 'nommer numÃƒÂ©rique', 'ÃÅ’ÃŽÂ½ÃŽÂ¿ÃŽÂ¼ÃŽÂ± ÃŽÂ±ÃÂÃŽÂ¹ÃŽÂ¸ÃŽÂ¼ÃŽÂ·Ãâ€žÃŽÂ¹ÃŽÂºÃÅ’', 'nennen numerischen', 'nome numerico', 'Ã Â¸Å Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸â€¢Ã Â¸Â±Ã Â¸Â§Ã Â¹â‚¬Ã Â¸Â¥Ã Â¸â€š', 'Ã˜Â¹Ã˜Â¯Ã˜Â¯Ã›Å’ Ã™â€ Ã˜Â§Ã™â€¦', 'Ã Â¤Â¸Ã Â¤Â¾Ã Â¤â€šÃ Â¤â€“Ã Â¥ÂÃ Â¤Â¯Ã Â¤Â¿Ã Â¤â€¢ Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤Â¨Ã Â¤Â¾Ã Â¤Â®', 'secundum numerum est secundum nomen,', 'nama numerik', 'Ã¦â€¢Â°Ã¥â‚¬Â¤Ã£ÂÂ«Ã¥ÂÂÃ¥â€°ÂÃ£â€šâ€™Ã¤Â»ËœÃ£Ââ€˜Ã£â€šâ€¹', 'Ã¬Ë†Â«Ã¬Å¾Â Ã¬ÂÂ´Ã«Â¦â€žÃ¬Ââ€ž'),
(109, 'edit_class', 'edit class', '', 'clase de ediciÃƒÂ³n', 'تحرير الطبقة', 'bewerken klasse', 'ÃÂ¿Ã‘â‚¬ÃÂ°ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ ÃÂºÃÂ»ÃÂ°Ã‘ÂÃ‘Â', 'Ã§Â¼â€“Ã¨Â¾â€˜Ã§Â±Â»', 'sÃ„Â±nÃ„Â±f dÃƒÂ¼zenle', 'ediÃƒÂ§ÃƒÂ£o classe', 'szerkesztÃƒÂ©s osztÃƒÂ¡ly', 'modifier la classe', 'edit ÃŽÂºÃŽÂ±Ãâ€žÃŽÂ·ÃŽÂ³ÃŽÂ¿ÃÂÃŽÂ¯ÃŽÂ±', 'Klasse bearbeiten', 'modifica della classe', 'Ã Â¹ÂÃ Â¸ÂÃ Â¹â€°Ã Â¹â€žÃ Â¸â€šÃ Â¸Â£Ã Â¸Â°Ã Â¸â€Ã Â¸Â±Ã Â¸Å¡', 'Ã˜ÂªÃ˜Â±Ã™â€¦Ã›Å’Ã™â€¦ ÃšÂ©Ã™â€žÃ˜Â§Ã˜Â³', 'Ã Â¤Â¸Ã Â¤â€šÃ Â¤ÂªÃ Â¤Â¾Ã Â¤Â¦Ã Â¤Â¿Ã Â¤Â¤ Ã Â¤ÂµÃ Â¤Â°Ã Â¥ÂÃ Â¤â€”', 'edit genere', 'mengedit kelas', 'Ã§Â·Â¨Ã©â€ºâ€ Ã£â€šÂ¯Ã£Æ’Â©Ã£â€šÂ¹', 'Ã­Å½Â¸Ã¬Â§â€˜ Ã­ÂÂ´Ã«Å¾ËœÃ¬Å Â¤'),
(110, 'manage_exam', 'manage exam', '', 'gestionar examen', 'إدارة الامتحان', 'beheren examen', 'Ã‘Æ’ÃÂ¿Ã‘â‚¬ÃÂ°ÃÂ²ÃÂ»Ã‘ÂÃ‘â€šÃ‘Å’ Ã‘ÂÃÂºÃÂ·ÃÂ°ÃÂ¼ÃÂµÃÂ½', 'Ã¨â‚¬Æ’Ã¨Â¯â€¢Ã§Â®Â¡Ã§Ââ€ ', 'sÃ„Â±navÃ„Â± yÃƒÂ¶netmek', 'gerenciar exame', 'kezelni vizsga', 'gÃƒÂ©rer examen', 'ÃŽÂ´ÃŽÂ¹ÃŽÂ±Ãâ€¡ÃŽÂµÃŽÂ¯ÃÂÃŽÂ¹ÃÆ’ÃŽÂ· ÃŽÂµÃŽÂ¾ÃŽÂµÃâ€žÃŽÂ¬ÃÆ’ÃŽÂµÃŽÂ¹Ãâ€š', 'PrÃƒÂ¼fung verwalten', 'gestire esame', 'Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸Ë†Ã Â¸Â±Ã Â¸â€Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸ÂªÃ Â¸Â­Ã Â¸Å¡', 'Ã˜Â§Ã™â€¦Ã˜ÂªÃ˜Â­Ã˜Â§Ã™â€  ÃšÂ©Ã˜Â§ Ã˜Â§Ã™â€ Ã˜ÂªÃ˜Â¸Ã˜Â§Ã™â€¦', 'Ã Â¤ÂªÃ Â¤Â°Ã Â¥â‚¬Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â·Ã Â¤Â¾ Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¤Â¬Ã Â¤â€šÃ Â¤Â§Ã Â¤Â¨', 'curo ipsum', 'mengelola ujian', 'Ã¨Â©Â¦Ã©Â¨â€œÃ£â€šâ€™Ã§Â®Â¡Ã§Ââ€ ', 'Ã¬â€¹Å“Ã­â€”Ëœ ÃªÂ´â‚¬Ã«Â¦Â¬'),
(111, 'exam_list', 'exam list', '', 'lista de exÃƒÂ¡menes', 'قائمة الامتحانات', 'examen lijst', 'ÃÂ¡ÃÂ¿ÃÂ¸Ã‘ÂÃÂ¾ÃÂº Ã‘ÂÃÂºÃÂ·ÃÂ°ÃÂ¼ÃÂµÃÂ½', 'Ã¨â‚¬Æ’Ã¨Â¯â€¢Ã¥ÂÂÃ¥Ââ€¢', 'sÃ„Â±nav listesi', 'lista de exames', 'vizsga lista', 'liste d''examen', 'ÃŽâ€ºÃŽÂ¯ÃÆ’Ãâ€žÃŽÂ± ÃŽÂµÃŽÂ¾ÃŽÂµÃâ€žÃŽÂ¬ÃÆ’ÃŽÂµÃŽÂ¹Ãâ€š', 'PrÃƒÂ¼fungsliste', 'elenco esami', 'Ã Â¸Â£Ã Â¸Â²Ã Â¸Â¢Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸ÂªÃ Â¸Â­Ã Â¸Å¡', 'Ã˜Â§Ã™â€¦Ã˜ÂªÃ˜Â­Ã˜Â§Ã™â€  Ã™ÂÃ›ÂÃ˜Â±Ã˜Â³Ã˜Âª', 'Ã Â¤ÂªÃ Â¤Â°Ã Â¥â‚¬Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â·Ã Â¤Â¾ Ã Â¤Â¸Ã Â¥â€šÃ Â¤Å¡Ã Â¥â‚¬', 'Lorem ipsum album', 'daftar ujian', 'Ã¨Â©Â¦Ã©Â¨â€œÃ£ÂÂ®Ã£Æ’ÂªÃ£â€šÂ¹Ã£Æ’Ë†', 'Ã¬â€¹Å“Ã­â€”Ëœ Ã«ÂªÂ©Ã«Â¡Â'),
(112, 'add_exam', 'add exam', '', 'agregar examen', 'إضافة امتحان', 'voeg examen', 'ÃÂ´ÃÂ¾ÃÂ±ÃÂ°ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ Ã‘ÂÃÂºÃÂ·ÃÂ°ÃÂ¼ÃÂµÃÂ½', 'Ã¦â€“Â°Ã¥Â¢Å¾Ã¨â‚¬Æ’Ã¨Â¯â€¢', 'sÃ„Â±nav eklemek', 'adicionar exame', 'hozzÃƒÂ¡ vizsga', 'ajouter examen', 'Ãâ‚¬ÃÂÃŽÂ¿ÃÆ’ÃŽÂ¸ÃŽÂ­ÃÆ’ÃŽÂµÃâ€žÃŽÂµ ÃŽÂµÃŽÂ¾ÃŽÂµÃâ€žÃŽÂ¬ÃÆ’ÃŽÂµÃŽÂ¹Ãâ€š', 'PrÃƒÂ¼fung hinzufÃƒÂ¼gen', 'aggiungere esame', 'Ã Â¹â‚¬Ã Â¸Å¾Ã Â¸Â´Ã Â¹Ë†Ã Â¸Â¡Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸ÂªÃ Â¸Â­Ã Â¸Å¡', 'Ã˜Â§Ã™â€¦Ã˜ÂªÃ˜Â­Ã˜Â§Ã™â€  Ã™â€¦Ã›Å’ÃšÂº Ã˜Â´Ã˜Â§Ã™â€¦Ã™â€ž ÃšÂ©Ã˜Â±Ã›Å’ÃšÂº', 'Ã Â¤ÂªÃ Â¤Â°Ã Â¥â‚¬Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â·Ã Â¤Â¾ Ã Â¤Å“Ã Â¥â€¹Ã Â¤Â¡Ã Â¤Â¼', 'adde ipsum', 'menambahkan ujian', 'Ã¨Â©Â¦Ã©Â¨â€œÃ£â€šâ€™Ã¨Â¿Â½Ã¥Å Â ', 'Ã¬â€¹Å“Ã­â€”ËœÃ¬â€”Â Ã¬Â¶â€ÃªÂ°â‚¬'),
(113, 'exam_name', 'exam name', '', 'nombre del examen', 'اسم الامتحان', 'examen naam', 'ÃÂÃÂ°ÃÂ·ÃÂ²ÃÂ°ÃÂ½ÃÂ¸ÃÂµ Ã‘ÂÃÂºÃÂ·ÃÂ°ÃÂ¼ÃÂµÃÂ½', 'Ã¨â‚¬Æ’Ã¨Â¯â€¢Ã¥ÂÂÃ§Â§Â°', 'sÃ„Â±nav adÃ„Â±', 'nome do exame', 'Vizsga neve', 'nom de l''examen', 'ÃŽÂ¤ÃŽÂ¿ ÃÅ’ÃŽÂ½ÃŽÂ¿ÃŽÂ¼ÃŽÂ¬ ÃŽÂµÃŽÂ¾ÃŽÂµÃâ€žÃŽÂ¬ÃÆ’ÃŽÂµÃŽÂ¹Ãâ€š', 'PrÃƒÂ¼fungsnamen', 'nome dell''esame', 'Ã Â¸Å Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸ÂªÃ Â¸Â­Ã Â¸Å¡', 'Ã˜Â§Ã™â€¦Ã˜ÂªÃ˜Â­Ã˜Â§Ã™â€  ÃšÂ©Ã›â€™ Ã™â€ Ã˜Â§Ã™â€¦', 'Ã Â¤ÂªÃ Â¤Â°Ã Â¥â‚¬Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â·Ã Â¤Â¾ Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤Â¨Ã Â¤Â¾Ã Â¤Â®', 'ipsum nomen,', 'Nama ujian', 'Ã¨Â©Â¦Ã©Â¨â€œÃ¥ÂÂ', 'Ã¬â€¹Å“Ã­â€”Ëœ Ã¬ÂÂ´Ã«Â¦â€ž'),
(114, 'date', 'date', '', 'fecha', 'تاريخ', 'datum', 'ÃÂ´ÃÂ°Ã‘â€šÃÂ°', 'Ã¦â€”Â¥Ã¦Å“Å¸', 'tarih', 'data', 'dÃƒÂ¡tum', 'date', 'ÃŽÂ·ÃŽÂ¼ÃŽÂµÃÂÃŽÂ¿ÃŽÂ¼ÃŽÂ·ÃŽÂ½ÃŽÂ¯ÃŽÂ±', 'Datum', 'data', 'Ã Â¸Â§Ã Â¸Â±Ã Â¸â„¢Ã Â¸â€”Ã Â¸ÂµÃ Â¹Ë†', 'Ã˜ÂªÃ˜Â§Ã˜Â±Ã›Å’Ã˜Â®', 'Ã Â¤Â¤Ã Â¤Â¾Ã Â¤Â°Ã Â¥â‚¬Ã Â¤â€“', 'date', 'tanggal', 'Ã¦â€”Â¥Ã¤Â»Ëœ', 'Ã«â€šÂ Ã¬Â§Å“'),
(115, 'comment', 'comment', '', 'comentario', 'تعليق', 'commentaar', 'ÃÂºÃÂ¾ÃÂ¼ÃÂ¼ÃÂµÃÂ½Ã‘â€šÃÂ°Ã‘â‚¬ÃÂ¸ÃÂ¹', 'Ã¨Â¯â€žÃ¨Â®Âº', 'yorum', 'comentÃƒÂ¡rio', 'megjegyzÃƒÂ©s', 'commentaire', 'ÃÆ’Ãâ€¡ÃÅ’ÃŽÂ»ÃŽÂ¹ÃŽÂ¿', 'Kommentar', 'commento', 'Ã Â¸â€žÃ Â¸Â§Ã Â¸Â²Ã Â¸Â¡Ã Â¹â‚¬Ã Â¸Â«Ã Â¹â€¡Ã Â¸â„¢', 'Ã˜ÂªÃ˜Â¨Ã˜ÂµÃ˜Â±Ã›Â', 'Ã Â¤Å¸Ã Â¤Â¿Ã Â¤ÂªÃ Â¥ÂÃ Â¤ÂªÃ Â¤Â£Ã Â¥â‚¬', 'comment', 'komentar', 'Ã£â€šÂ³Ã£Æ’Â¡Ã£Æ’Â³Ã£Æ’Ë†', 'Ã«â€¦Â¼Ã­Ââ€°'),
(116, 'edit_exam', 'edit exam', '', 'examen de ediciÃƒÂ³n', 'تحرير الامتحان', 'bewerk examen', 'ÃÂ¿Ã‘â‚¬ÃÂ°ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ Ã‘ÂÃÂºÃÂ·ÃÂ°ÃÂ¼ÃÂµÃÂ½', 'Ã§Â¼â€“Ã¨Â¾â€˜Ã¨â‚¬Æ’Ã¨Â¯â€¢', 'edit sÃ„Â±navÃ„Â±', 'ediÃƒÂ§ÃƒÂ£o do exame', 'szerkesztÃƒÂ©s vizsga', 'modifier examen', 'edit ÃŽÂµÃŽÂ¾ÃŽÂµÃâ€žÃŽÂ¬ÃÆ’ÃŽÂµÃŽÂ¹Ãâ€š', 'edit PrÃƒÂ¼fung', 'modifica esame', 'Ã Â¹ÂÃ Â¸ÂÃ Â¹â€°Ã Â¹â€žÃ Â¸â€šÃ Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸ÂªÃ Â¸Â­Ã Â¸Å¡', 'Ã˜ÂªÃ˜Â±Ã™â€¦Ã›Å’Ã™â€¦ Ã˜Â§Ã™â€¦Ã˜ÂªÃ˜Â­Ã˜Â§Ã™â€ ', 'Ã Â¤Â¸Ã Â¤â€šÃ Â¤ÂªÃ Â¤Â¾Ã Â¤Â¦Ã Â¤Â¿Ã Â¤Â¤ Ã Â¤ÂªÃ Â¤Â°Ã Â¥â‚¬Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â·Ã Â¤Â¾', 'edit ipsum', 'mengedit ujian', 'Ã§Â·Â¨Ã©â€ºâ€ Ã¨Â©Â¦Ã©Â¨â€œ', 'Ã­Å½Â¸Ã¬Â§â€˜ Ã¬â€¹Å“Ã­â€”Ëœ'),
(117, 'manage_exam_marks', 'manage exam marks', '', 'gestionar marcas de examen', 'إدارة علامات الامتحان', 'beheren examencijfers', 'Ã‘Æ’ÃÂ¿Ã‘â‚¬ÃÂ°ÃÂ²ÃÂ»Ã‘ÂÃ‘â€šÃ‘Å’ Ã‘ÂÃÂºÃÂ·ÃÂ°ÃÂ¼ÃÂµÃÂ½ÃÂ°Ã‘â€ ÃÂ¸ÃÂ¾ÃÂ½ÃÂ½Ã‘â€¹ÃÂµ ÃÂ¾Ã‘â€šÃÂ¼ÃÂµÃ‘â€šÃÂºÃÂ¸', 'Ã§Â®Â¡Ã§Ââ€ Ã¨â‚¬Æ’Ã¨Â¯â€¢Ã§â€”â€¢', 'sÃ„Â±nav iÃ…Å¸aretleri yÃƒÂ¶netmek', 'gerenciar marcas exame', 'kezelni vizsga jelek', 'gÃƒÂ©rer les marques d''examen', 'ÃŽÂ´ÃŽÂ¹ÃŽÂ±Ãâ€¡ÃŽÂµÃŽÂ¯ÃÂÃŽÂ¹ÃÆ’ÃŽÂ· Ãâ€žÃâ€°ÃŽÂ½ ÃÆ’ÃŽÂ·ÃŽÂ¼ÃŽÂ¬Ãâ€žÃâ€°ÃŽÂ½ ÃŽÂµÃŽÂ¾ÃŽÂµÃâ€žÃŽÂ¬ÃÆ’ÃŽÂµÃŽÂ¹Ãâ€š', 'PrÃƒÂ¼fungsnoten verwalten', 'gestire i voti degli esami', 'Ã Â¸Ë†Ã Â¸Â±Ã Â¸â€Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸ÂªÃ Â¸Â­Ã Â¸Å¡Ã Â¹â‚¬Ã Â¸â€žÃ Â¸Â£Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸â€¡Ã Â¸Â«Ã Â¸Â¡Ã Â¸Â²Ã Â¸Â¢', 'Ã˜Â§Ã™â€¦Ã˜ÂªÃ˜Â­Ã˜Â§Ã™â€  ÃšÂ©Ã›â€™ Ã™â€ Ã˜Â´Ã˜Â§Ã™â€ Ã˜Â§Ã˜Âª ÃšÂ©Ã˜Â§ Ã˜Â§Ã™â€ Ã˜ÂªÃ˜Â¸Ã˜Â§Ã™â€¦', 'Ã Â¤ÂªÃ Â¤Â°Ã Â¥â‚¬Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â·Ã Â¤Â¾ Ã Â¤â€¢Ã Â¥â€¡ Ã Â¤Â¨Ã Â¤Â¿Ã Â¤Â¶Ã Â¤Â¾Ã Â¤Â¨ Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¤Â¬Ã Â¤â€šÃ Â¤Â§Ã Â¤Â¨', 'ipsum curo indicia', 'mengelola nilai ujian', 'Ã¨Â©Â¦Ã©Â¨â€œÃ£Æ’Å¾Ã£Æ’Â¼Ã£â€šÂ¯Ã£â€šâ€™Ã§Â®Â¡Ã§Ââ€ ', 'Ã¬â€¹Å“Ã­â€”Ëœ Ã¬Â ÂÃ¬Ë†ËœÃ«Â¥Â¼ ÃªÂ´â‚¬Ã«Â¦Â¬'),
(118, 'manage_marks', 'manage marks', '', 'gestionar marcas', 'إدارة العلامات', 'beheren merken', 'Ã‘Æ’ÃÂ¿Ã‘â‚¬ÃÂ°ÃÂ²ÃÂ»Ã‘ÂÃ‘â€šÃ‘Å’ ÃÂ·ÃÂ½ÃÂ°ÃÂºÃÂ¸', 'Ã¥â€¢â€ Ã¦Â â€¡Ã§Â®Â¡Ã§Ââ€ ', 'iÃ…Å¸aretleri yÃƒÂ¶netmek', 'gerenciar marcas', 'kezelni jelek', 'gÃƒÂ©rer les marques', 'ÃŽÂ´ÃŽÂ¹ÃŽÂ±Ãâ€¡ÃŽÂµÃŽÂ¯ÃÂÃŽÂ¹ÃÆ’ÃŽÂ· Ãâ€žÃâ€°ÃŽÂ½ ÃÆ’ÃŽÂ·ÃŽÂ¼ÃŽÂ¬Ãâ€žÃâ€°ÃŽÂ½', 'Markierungen verwalten', 'gestire i marchi', 'Ã Â¸Ë†Ã Â¸Â±Ã Â¸â€Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¹â‚¬Ã Â¸â€žÃ Â¸Â£Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸â€¡Ã Â¸Â«Ã Â¸Â¡Ã Â¸Â²Ã Â¸Â¢', 'Ã™â€ Ã™â€¦Ã˜Â¨Ã˜Â±Ã™Ë†ÃšÂº ÃšÂ©Ã˜Â§ Ã˜Â§Ã™â€ Ã˜ÂªÃ˜Â¸Ã˜Â§Ã™â€¦', 'Ã Â¤Â¨Ã Â¤Â¿Ã Â¤Â¶Ã Â¤Â¾Ã Â¤Â¨ Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¤Â¬Ã Â¤â€šÃ Â¤Â§Ã Â¤Â¨', 'curo indicia', 'mengelola tanda', 'Ã£Æ’Å¾Ã£Æ’Â¼Ã£â€šÂ¯Ã£â€šâ€™Ã§Â®Â¡Ã§Ââ€ ', 'Ã«Â§Ë†Ã­ÂÂ¬Ã«Â¥Â¼ ÃªÂ´â‚¬Ã«Â¦Â¬'),
(119, 'select_exam', 'select exam', '', 'seleccione examen', 'حدد الامتحان', 'selecteer examen', 'ÃÂ²Ã‘â€¹ÃÂ±Ã‘â‚¬ÃÂ°Ã‘â€šÃ‘Å’ Ã‘ÂÃÂºÃÂ·ÃÂ°ÃÂ¼ÃÂµÃÂ½', 'Ã©â‚¬â€°Ã¦â€¹Â©Ã¨â‚¬Æ’Ã¨Â¯â€¢', 'sÃ„Â±navÃ„Â± seÃƒÂ§in', 'selecionar exame', 'vÃƒÂ¡lassza ki a vizsga', 'sÃƒÂ©lectionnez examen', 'ÃŽÂµÃâ‚¬ÃŽÂ¹ÃŽÂ»ÃŽÂ­ÃŽÂ¾Ãâ€žÃŽÂµ ÃŽÂµÃŽÂ¾ÃŽÂµÃâ€žÃŽÂ¬ÃÆ’ÃŽÂµÃŽÂ¹Ãâ€š', 'PrÃƒÂ¼fung wÃƒÂ¤hlen', 'seleziona esame', 'Ã Â¹â‚¬Ã Â¸Â¥Ã Â¸Â·Ã Â¸Â­Ã Â¸ÂÃ Â¸ÂªÃ Â¸Â­Ã Â¸Å¡', 'Ã˜Â§Ã™â€¦Ã˜ÂªÃ˜Â­Ã˜Â§Ã™â€  Ã™â€¦Ã™â€ Ã˜ÂªÃ˜Â®Ã˜Â¨ ÃšÂ©Ã˜Â±Ã›Å’ÃšÂº', 'Ã Â¤ÂªÃ Â¤Â°Ã Â¥â‚¬Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â·Ã Â¤Â¾ Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤Å¡Ã Â¤Â¯Ã Â¤Â¨', 'velit ipsum', 'pilih ujian', 'Ã¥Ââ€”Ã©Â¨â€œÃ£â€šâ€™Ã©ÂÂ¸Ã¦Å Å¾', 'Ã¬â€¹Å“Ã­â€”ËœÃ¬Ââ€ž Ã¬â€žÂ Ã­Æ’Â'),
(120, 'select_class', 'select class', '', 'seleccione clase', 'حدد الفئة', 'selecteren klasse', 'ÃÂ²Ã‘â€¹ÃÂ±Ã‘â‚¬ÃÂ°Ã‘â€šÃ‘Å’ ÃÂºÃÂ»ÃÂ°Ã‘ÂÃ‘Â', 'Ã©â‚¬â€°Ã¦â€¹Â©Ã¤ÂºÂ§Ã¥â€œÂÃ§Â±Â»Ã¥Ë†Â«', 'sÃ„Â±nÃ„Â±f seÃƒÂ§in', 'selecionar classe', 'vÃƒÂ¡lassza osztÃƒÂ¡ly', 'sÃƒÂ©lectionnez classe', 'ÃŽâ€¢Ãâ‚¬ÃŽÂ¹ÃŽÂ»ÃŽÂ­ÃŽÂ¾Ãâ€žÃŽÂµ ÃŽÂºÃŽÂ±Ãâ€žÃŽÂ·ÃŽÂ³ÃŽÂ¿ÃÂÃŽÂ¯ÃŽÂ±', 'Klasse wÃƒÂ¤hlen', 'seleziona classe', 'Ã Â¹â‚¬Ã Â¸Â¥Ã Â¸Â·Ã Â¸Â­Ã Â¸ÂÃ Â¸Å Ã Â¸Â±Ã Â¹â€°Ã Â¸â„¢', 'ÃšÂ©Ã™â€žÃ˜Â§Ã˜Â³ Ã™â€¦Ã™â€ Ã˜ÂªÃ˜Â®Ã˜Â¨ ÃšÂ©Ã˜Â±Ã›Å’ÃšÂº', 'Ã Â¤ÂµÃ Â¤Â°Ã Â¥ÂÃ Â¤â€” Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤Å¡Ã Â¤Â¯Ã Â¤Â¨ Ã Â¤â€¢Ã Â¤Â°Ã Â¥â€¡Ã Â¤â€š', 'genus eligere,', 'pilih kelas', 'Ã£â€šÂ¯Ã£Æ’Â©Ã£â€šÂ¹Ã£â€šâ€™Ã©ÂÂ¸Ã¦Å Å¾', 'Ã­ÂÂ´Ã«Å¾ËœÃ¬Å Â¤Ã«Â¥Â¼ Ã¬â€žÂ Ã­Æ’Â'),
(121, 'select_subject', 'select subject', '', 'seleccione tema', 'حدد الموضوع', 'Selecteer onderwerp', 'ÃÂ²Ã‘â€¹ÃÂ±ÃÂµÃ‘â‚¬ÃÂ¸Ã‘â€šÃÂµ Ã‘â€šÃÂµÃÂ¼Ã‘Æ’', 'Ã©â‚¬â€°Ã¦â€¹Â©Ã¤Â¸Â»Ã©Â¢Ëœ', 'konu seÃƒÂ§in', 'selecionar assunto', 'VÃƒÂ¡lassza a TÃƒÂ¡rgy', 'sÃƒÂ©lectionner le sujet', 'ÃŽÂµÃâ‚¬ÃŽÂ¹ÃŽÂ»ÃŽÂ­ÃŽÂ¾Ãâ€žÃŽÂµ ÃŽÂ¸ÃŽÂ­ÃŽÂ¼ÃŽÂ±', 'Thema wÃƒÂ¤hlen', 'seleziona argomento', 'Ã Â¹â‚¬Ã Â¸Â¥Ã Â¸Â·Ã Â¸Â­Ã Â¸ÂÃ Â¹â‚¬Ã Â¸Â£Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸â€¡', 'Ã™â€¦Ã™Ë†Ã˜Â¶Ã™Ë†Ã˜Â¹ Ã™â€¦Ã™â€ Ã˜ÂªÃ˜Â®Ã˜Â¨ ÃšÂ©Ã˜Â±Ã›Å’ÃšÂº', 'Ã Â¤ÂµÃ Â¤Â¿Ã Â¤Â·Ã Â¤Â¯ Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤Å¡Ã Â¤Â¯Ã Â¤Â¨', 'eligere subditos', 'pilih subjek', 'Ã¤Â»Â¶Ã¥ÂÂÃ£â€šâ€™Ã©ÂÂ¸Ã¦Å Å¾', 'Ã¬Â£Â¼Ã¬Â Å“Ã«Â¥Â¼ Ã¬â€žÂ Ã­Æ’Â'),
(18499, 'system_settings', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18498, 'preview', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18494, 'HOSTEL MANAGERS ID CARD', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18495, 'ACCOUNTANTS ID CARD', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18496, 'LIBRARIANS ID CARD', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18497, 'ID_card', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(122, 'select_an_exam', 'select an exam', '', 'seleccione un examen', 'حدد امتحانا', 'selecteer een examen', 'ÃÂ²Ã‘â€¹ÃÂ±Ã‘â‚¬ÃÂ°Ã‘â€šÃ‘Å’ Ã‘ÂÃÂºÃÂ·ÃÂ°ÃÂ¼ÃÂµÃÂ½', 'Ã©â‚¬â€°Ã¦â€¹Â©Ã¨â‚¬Æ’Ã¨Â¯â€¢', 'Bir sÃ„Â±nav seÃƒÂ§in', 'selecionar um exame', 'vÃƒÂ¡lasszon ki egy vizsga', 'sÃƒÂ©lectionner un examen', 'ÃŽÂµÃâ‚¬ÃŽÂ¹ÃŽÂ»ÃŽÂ­ÃŽÂ¾Ãâ€žÃŽÂµ ÃŽÂ¼ÃŽÂ¹ÃŽÂ± ÃŽÂµÃŽÂ¾ÃŽÂ­Ãâ€žÃŽÂ±ÃÆ’ÃŽÂ·', 'WÃƒÂ¤hlen Sie eine PrÃƒÂ¼fung', 'selezionare un esame', 'Ã Â¹â‚¬Ã Â¸Â¥Ã Â¸Â·Ã Â¸Â­Ã Â¸ÂÃ Â¸ÂªÃ Â¸Â­Ã Â¸Å¡', 'Ã˜Â§Ã™â€¦Ã˜ÂªÃ˜Â­Ã˜Â§Ã™â€  Ã™â€¦Ã™â€ Ã˜ÂªÃ˜Â®Ã˜Â¨ ÃšÂ©Ã˜Â±Ã›Å’ÃšÂº', 'Ã Â¤ÂÃ Â¤â€¢ Ã Â¤ÂªÃ Â¤Â°Ã Â¥â‚¬Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â·Ã Â¤Â¾ Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤Å¡Ã Â¤Â¯Ã Â¤Â¨', 'Eligebatur autem ipsum', 'pilih ujian', 'Ã¥Ââ€”Ã©Â¨â€œÃ£â€šâ€™Ã©ÂÂ¸Ã¦Å Å¾', 'Ã¬â€¹Å“Ã­â€”ËœÃ¬Ââ€ž Ã¬â€žÂ Ã­Æ’Â'),
(18493, 'STUDENTS ID CARD', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18492, 'Submit', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18491, 'select', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18490, 'TEACHERS ID CARD', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18489, 'no', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18488, 'yes', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18487, 'transportations', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(123, 'mark_obtained', 'mark obtained', '', 'calificaciÃƒÂ³n obtenida', 'علامة تم الحصول عليها', 'markeren verkregen', 'ÃÂ¾Ã‘â€šÃÂ¼ÃÂµÃ‘â€šÃÂ¸Ã‘â€šÃ‘Å’ ÃÂ¿ÃÂ¾ÃÂ»Ã‘Æ’Ã‘â€¡ÃÂµÃÂ½Ã‘â€¹', 'Ã¨Å½Â·Ã¥Â¾â€”Ã¦Â â€¡', 'iÃ…Å¸aretlemek elde', 'marca obtida', 'jelÃƒÂ¶lje kapott', 'marquer obtenu', 'ÃÆ’ÃŽÂ®ÃŽÂ¼ÃŽÂ± Ãâ‚¬ÃŽÂ¿Ãâ€¦ ÃŽÂ»ÃŽÂ±ÃŽÂ¼ÃŽÂ²ÃŽÂ¬ÃŽÂ½ÃŽÂµÃâ€žÃŽÂ±ÃŽÂ¹', 'Markieren Sie erhalten', 'contrassegnare ottenuto', 'Ã Â¸â€”Ã Â¸Â³Ã Â¹â‚¬Ã Â¸â€žÃ Â¸Â£Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸â€¡Ã Â¸Â«Ã Â¸Â¡Ã Â¸Â²Ã Â¸Â¢Ã Â¸â€”Ã Â¸ÂµÃ Â¹Ë†Ã Â¹â€žÃ Â¸â€Ã Â¹â€°Ã Â¸Â£Ã Â¸Â±Ã Â¸Å¡', 'Ã™â€ Ã˜Â´Ã˜Â§Ã™â€  Ã˜Â²Ã˜Â¯ Ã˜Â­Ã˜Â§Ã˜ÂµÃ™â€ž', 'Ã Â¤â€¦Ã Â¤â€šÃ Â¤â€¢ Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¤Â¾Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â¤', 'attende obtinuit', 'menandai diperoleh', 'Ã£Æ’Å¾Ã£Æ’Â¼Ã£â€šÂ¯Ã£ÂÅ’Ã¥Â¾â€”', 'Ã«Â§Ë†Ã­ÂÂ¬ Ã­Å¡ÂÃ«â€œÂ'),
(18486, 'section', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18485, 'students_information', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18484, 'list_classes', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18483, 'New_Students', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18482, 'Charts', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18481, 'all_message', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(124, 'attendance', 'attendance', '', 'asistencia', 'الحضور', 'opkomst', 'ÃÂ¿ÃÂ¾Ã‘ÂÃÂµÃ‘â€°ÃÂ°ÃÂµÃÂ¼ÃÂ¾Ã‘ÂÃ‘â€šÃ‘Å’', 'Ã¦Å Â¤Ã§Ââ€ ', 'katÃ„Â±lÃ„Â±m', 'comparecimento', 'rÃƒÂ©szvÃƒÂ©tel', 'prÃƒÂ©sence', 'Ãâ‚¬ÃŽÂ±ÃÂÃŽÂ¿Ãâ€¦ÃÆ’ÃŽÂ¯ÃŽÂ±', 'Teilnahme', 'partecipazione', 'Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸â€Ã Â¸Â¹Ã Â¹ÂÃ Â¸Â¥Ã Â¸Â£Ã Â¸Â±Ã Â¸ÂÃ Â¸Â©Ã Â¸Â²', 'Ã˜Â­Ã˜Â§Ã˜Â¶Ã˜Â±Ã›Å’', 'Ã Â¤â€°Ã Â¤ÂªÃ Â¤Â¸Ã Â¥ÂÃ Â¤Â¥Ã Â¤Â¿Ã Â¤Â¤Ã Â¤Â¿', 'auscultant', 'kehadiran', 'Ã¥â€¡ÂºÃ¥Â¸Â­', 'Ã¬Â¶Å“Ã¬â€žÂ'),
(18480, 'all_enquiry', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18479, 'Accountant', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18478, 'all_enquiries', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(125, 'manage_grade', 'manage grade', '', 'gestiÃƒÂ³n de calidad', 'إدارة الصف', 'beheren leerjaar', 'Ã‘Æ’ÃÂ¿Ã‘â‚¬ÃÂ°ÃÂ²ÃÂ»Ã‘ÂÃ‘â€šÃ‘Å’ ÃÂºÃÂ»ÃÂ°Ã‘ÂÃ‘Â', 'Ã§Â®Â¡Ã§Ââ€ Ã§ÂºÂ§', 'notu yÃƒÂ¶netmek', 'gerenciar grau', 'kezelni fokozat', 'gÃƒÂ©rer de qualitÃƒÂ©', 'ÃŽÂ´ÃŽÂ¹ÃŽÂ±Ãâ€¡ÃŽÂµÃŽÂ¯ÃÂÃŽÂ¹ÃÆ’ÃŽÂ· Ãâ‚¬ÃŽÂ¿ÃŽÂ¹ÃÅ’Ãâ€žÃŽÂ·Ãâ€žÃŽÂ±Ãâ€š', 'Klasse verwalten', 'gestione grade', 'Ã Â¸Ë†Ã Â¸Â±Ã Â¸â€Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¹â‚¬Ã Â¸ÂÃ Â¸Â£Ã Â¸â€', 'ÃšÂ¯Ã˜Â±Ã›Å’ÃšË† ÃšÂ©Ã˜Â§ Ã˜Â§Ã™â€ Ã˜ÂªÃ˜Â¸Ã˜Â§Ã™â€¦', 'Ã Â¤â€”Ã Â¥ÂÃ Â¤Â°Ã Â¥â€¡Ã Â¤Â¡ Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¤Â¬Ã Â¤â€šÃ Â¤Â§Ã Â¤Â¨', 'moderari gradu', 'mengelola kelas', 'Ã£â€šÂ°Ã£Æ’Â¬Ã£Æ’Â¼Ã£Æ’â€°Ã£â€šâ€™Ã§Â®Â¡Ã§Ââ€ ', 'Ã«â€œÂ±ÃªÂ¸â€° ÃªÂ´â‚¬Ã«Â¦Â¬'),
(18477, 'admin_users', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18476, 'librarian', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18475, 'parent_users', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18474, 'student_users', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18473, 'new_admin', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(126, 'grade_list', 'grade list', '', 'Lista de grado', 'الصف', 'cijferlijst', 'ÃÂ¡ÃÂ¿ÃÂ¸Ã‘ÂÃÂ¾ÃÂº ÃÂºÃÂ»ÃÂ°Ã‘ÂÃ‘ÂÃÂ°', 'Ã§Â­â€°Ã§ÂºÂ§Ã¥Ë†â€”Ã¨Â¡Â¨', 'sÃ„Â±nÃ„Â±f listesi', 'lista grau', 'fokozat lista', 'liste de qualitÃƒÂ©', 'ÃŽâ€ºÃŽÂ¯ÃÆ’Ãâ€žÃŽÂ± ÃŽÂ²ÃŽÂ±ÃŽÂ¸ÃŽÂ¼ÃŽÂ¿ÃÂ', 'Notenliste', 'elenco grade', 'Ã Â¸Â£Ã Â¸Â²Ã Â¸Â¢Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¹â‚¬Ã Â¸ÂÃ Â¸Â£Ã Â¸â€', 'ÃšÂ¯Ã˜Â±Ã›Å’ÃšË† Ã™ÂÃ›ÂÃ˜Â±Ã˜Â³Ã˜Âª', 'Ã Â¤â€”Ã Â¥ÂÃ Â¤Â°Ã Â¥â€¡Ã Â¤Â¡ Ã Â¤â€¢Ã Â¥â‚¬ Ã Â¤Â¸Ã Â¥â€šÃ Â¤Å¡Ã Â¥â‚¬', 'gradus album', 'daftar kelas', 'Ã£â€šÂ°Ã£Æ’Â¬Ã£Æ’Â¼Ã£Æ’â€°Ã¤Â¸â‚¬Ã¨Â¦Â§', 'Ã«â€œÂ±ÃªÂ¸â€° Ã«ÂªÂ©Ã«Â¡Â'),
(18472, 'admin_list', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18471, 'role_managements', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18470, 'personal_details', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18469, 'news_settings', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18468, 'system_information', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(127, 'add_grade', 'add grade', '', 'aÃƒÂ±adir grado', 'إضافة الصف', 'voeg leerjaar', 'ÃÂ´ÃÂ¾ÃÂ±ÃÂ°ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ ÃÂºÃÂ»ÃÂ°Ã‘ÂÃ‘Â', 'Ã¦Â·Â»Ã¥Å Â Ã§ÂºÂ§', 'not eklemek', 'adicionar grau', 'hozzÃƒÂ¡ fokozat', 'ajouter note', 'Ãâ‚¬ÃÂÃŽÂ¿ÃÆ’ÃŽÂ¸ÃŽÂ®ÃŽÂºÃŽÂ· ÃŽÂ²ÃŽÂ±ÃŽÂ¸ÃŽÂ¼ÃŽÂ¿ÃÂ', 'Klasse hinzufÃƒÂ¼gen', 'aggiungere grade', 'Ã Â¹â‚¬Ã Â¸Å¾Ã Â¸Â´Ã Â¹Ë†Ã Â¸Â¡Ã Â¹â‚¬Ã Â¸ÂÃ Â¸Â£Ã Â¸â€', 'ÃšÂ¯Ã˜Â±Ã›Å’ÃšË† Ã™â€¦Ã›Å’ÃšÂº Ã˜Â´Ã˜Â§Ã™â€¦Ã™â€ž ÃšÂ©Ã˜Â±Ã›Å’ÃšÂº', 'Ã Â¤â€”Ã Â¥ÂÃ Â¤Â°Ã Â¥â€¡Ã Â¤Â¡ Ã Â¤Å“Ã Â¥â€¹Ã Â¤Â¡Ã Â¤Â¼', 'adde gradum,', 'menambahkan kelas', 'Ã£â€šÂ°Ã£Æ’Â¬Ã£Æ’Â¼Ã£Æ’â€°Ã£â€šâ€™Ã¨Â¿Â½Ã¥Å Â ', 'Ã«â€œÂ±ÃªÂ¸â€°Ã¬Ââ€ž Ã¬Â¶â€ÃªÂ°â‚¬'),
(18467, 'manage_banners', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18466, 'front_end_settings', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18465, 'view_documentation', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18464, 'manage_reports', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18463, 'generate_reports', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(128, 'grade_name', 'grade name', '', 'Nombre de grado', 'اسم الصف', 'rangnaam', 'ÃÂÃÂ°ÃÂ·ÃÂ²ÃÂ°ÃÂ½ÃÂ¸ÃÂµ Ã‘ÂÃÂ¾Ã‘â‚¬Ã‘â€šÃÂ°', 'Ã§Â­â€°Ã§ÂºÂ§Ã¥ÂÂÃ§Â§Â°', 'sÃ„Â±nÃ„Â±f adÃ„Â±', 'nome da classe', 'fokozat nÃƒÂ©v', 'nom de la catÃƒÂ©gorie', 'ÃŽÅ’ÃŽÂ½ÃŽÂ¿ÃŽÂ¼ÃŽÂ± ÃŽÂ²ÃŽÂ±ÃŽÂ¸ÃŽÂ¼ÃŽÂ¿ÃÂ', 'Klasse Name', 'nome del grado', 'Ã Â¸Å Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸Å Ã Â¸Â±Ã Â¹â€°Ã Â¸â„¢', 'ÃšÂ¯Ã˜Â±Ã›Å’ÃšË† Ã™â€ Ã˜Â§Ã™â€¦', 'Ã Â¤â€”Ã Â¥ÂÃ Â¤Â°Ã Â¥â€¡Ã Â¤Â¡ Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤Â¨Ã Â¤Â¾Ã Â¤Â®', 'nomen, gradus,', 'nama kelas', 'Ã£â€šÂ°Ã£Æ’Â¬Ã£Æ’Â¼Ã£Æ’â€°Ã¥ÂÂ', 'Ã«â€œÂ±ÃªÂ¸â€° Ã¬ÂÂ´Ã«Â¦â€ž'),
(18462, 'languages', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18461, 'email_template', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18460, 'manage_database', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(129, 'grade_point', 'grade point', '', 'de calificaciones', 'تراكمي', 'rangpunt', 'ÃÂ±ÃÂ°ÃÂ»ÃÂ»', 'Ã¦Ë†ÂÃ§Â»Â©', 'not', 'ponto de classe', 'fokozatÃƒÂº pont', 'cumulative', 'ÃŽÂ²ÃŽÂ±ÃŽÂ¸ÃŽÂ¼ÃÅ½ÃŽÂ½', 'Noten', 'punto di grado', 'Ã Â¸Ë†Ã Â¸Â¸Ã Â¸â€Ã Â¹â‚¬Ã Â¸ÂÃ Â¸Â£Ã Â¸â€', 'ÃšÂ¯Ã˜Â±Ã›Å’ÃšË† Ã™Â¾Ã™Ë†Ã˜Â§Ã˜Â¦Ã™â€ Ã™Â¹', 'Ã Â¤â€”Ã Â¥ÂÃ Â¤Â°Ã Â¥â€¡Ã Â¤Â¡ Ã Â¤Â¬Ã Â¤Â¿Ã Â¤â€šÃ Â¤Â¦Ã Â¥Â', 'gradus punctum', 'indeks prestasi', 'Ã¦Ë†ÂÃ§Â¸Â¾Ã¨Â©â€¢Ã¤Â¾Â¡Ã§â€šÂ¹', 'Ã­â€¢â„¢Ã¬Â Â'),
(18459, 'manage_sms_api', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18458, 'manage_sidebar', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18457, 'general_settings', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18456, 'system_setting', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18455, 'manage_vehicle', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(130, 'mark_from', 'mark from', '', 'marca de', 'علامة من', 'mark uit', 'ÃÂ·ÃÂ½ÃÂ°ÃÂº ÃÂ¾Ã‘â€š', 'Ã¤Â»Å½Ã¥â€¢â€ Ã¦Â â€¡', 'mark dan', 'marca de', 'jelÃƒÂ¶lÃƒÂ©st', 'marque de', 'ÃÆ’ÃŽÂ®ÃŽÂ¼ÃŽÂ± ÃŽÂ±Ãâ‚¬ÃÅ’', 'Marke aus', 'segno da', 'Ã Â¹â‚¬Ã Â¸â€žÃ Â¸Â£Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸â€¡Ã Â¸Â«Ã Â¸Â¡Ã Â¸Â²Ã Â¸Â¢Ã Â¸Ë†Ã Â¸Â²Ã Â¸Â', 'Ã™â€ Ã˜Â´Ã˜Â§Ã™â€  Ã˜Â³Ã›â€™', 'Ã Â¤Â®Ã Â¤Â¾Ã Â¤Â°Ã Â¥ÂÃ Â¤â€¢ Ã Â¤Â¸Ã Â¥â€¡', 'marcam', 'mark dari', 'Ã£Æ’Å¾Ã£Æ’Â¼Ã£â€šÂ¯Ã£Ââ€¹Ã£â€šâ€°', 'Ã­â€˜Å“Ã¬â€”ÂÃ¬â€žÅ“'),
(18454, 'transport_route', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18453, 'transports', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18452, 'transportation', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18451, 'private_messages', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(131, 'mark_upto', 'mark upto', '', 'marcar hasta', 'علامة تصل إلى', 'mark tot', 'ÃÂ¾Ã‘â€šÃÂ¼ÃÂµÃ‘â€šÃÂ¸Ã‘â€šÃ‘Å’ Ãâ€ÃÅ¾', 'Ã©Â«ËœÃ¨Â¾Â¾Ã¦Â â€¡Ã¨Â®Â°', 'kadar iÃ…Å¸aretlemek', 'marcar atÃƒÂ©', 'jelÃƒÂ¶lje upto', 'marquer jusqu''ÃƒÂ ', 'ÃÆ’ÃŽÂ®ÃŽÂ¼ÃŽÂ± ÃŽÂ¼ÃŽÂ­Ãâ€¡ÃÂÃŽÂ¹', 'Markieren Sie bis zu', 'contrassegnare fino a', 'Ã Â¸â€”Ã Â¸Â³Ã Â¹â‚¬Ã Â¸â€žÃ Â¸Â£Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸â€¡Ã Â¸Â«Ã Â¸Â¡Ã Â¸Â²Ã Â¸Â¢Ã Â¹â‚¬Ã Â¸ÂÃ Â¸Â´Ã Â¸â„¢', 'Ã˜ÂªÃšÂ© ÃšÂ©Ã›â€™ Ã™â€¦Ã™Ë†Ã™â€šÃ˜Â¹', 'Ã Â¤Â¤Ã Â¤â€¢ Ã Â¤Å¡Ã Â¤Â¿Ã Â¤Â¹Ã Â¥ÂÃ Â¤Â¨Ã Â¤Â¿Ã Â¤Â¤', 'Genitus est notare', 'menandai upto', 'Ã§â€šÂ¹Ã£ÂÂ§Ã¦Å“â‚¬Ã¥Â¤Â§Ã£Æ’Å¾Ã£Æ’Â¼Ã£â€šÂ¯', 'Ã­â€˜Å“ÃªÂ¹Å’Ã¬Â§â‚¬'),
(18450, 'manage_events', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18449, 'communications', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18448, 'hostel_room', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18326, 'upload', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18447, 'room_type', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(132, 'edit_grade', 'edit grade', '', 'edit grado', 'تحرير الصف', 'Cijfer bewerken', 'ÃÂ¿Ã‘â‚¬ÃÂ°ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ ÃÂºÃÂ»ÃÂ°Ã‘ÂÃ‘ÂÃÂ°', 'Ã§Â¼â€“Ã¨Â¾â€˜Ã§Â­â€°Ã§ÂºÂ§', 'edit notu', 'ediÃƒÂ§ÃƒÂ£o grau', 'szerkesztÃƒÂ©s fokozat', 'edit qualitÃƒÂ©', 'edit ÃŽÂ²ÃŽÂ±ÃŽÂ¸ÃŽÂ¼ÃŽÂ¿ÃÂ', 'edit Grad', 'modifica grade', 'Ã Â¹ÂÃ Â¸ÂÃ Â¹â€°Ã Â¹â€žÃ Â¸â€šÃ Â¹â‚¬Ã Â¸ÂÃ Â¸Â£Ã Â¸â€', 'Ã˜ÂªÃ˜Â±Ã™â€¦Ã›Å’Ã™â€¦ ÃšÂ¯Ã˜Â±Ã›Å’ÃšË†', 'Ã Â¤Â¸Ã Â¤â€šÃ Â¤ÂªÃ Â¤Â¾Ã Â¤Â¦Ã Â¤Â¿Ã Â¤Â¤ Ã Â¤â€”Ã Â¥ÂÃ Â¤Â°Ã Â¥â€¡Ã Â¤Â¡', 'edit gradu', 'mengedit kelas', 'Ã§Â·Â¨Ã©â€ºâ€ Ã£â€šÂ°Ã£Æ’Â¬Ã£Æ’Â¼Ã£Æ’â€°', 'Ã­Å½Â¸Ã¬Â§â€˜ Ã«â€œÂ±ÃªÂ¸â€°'),
(18446, 'hostel_category', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18445, 'manage_hostel', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18444, 'hostel_information', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18443, 'register_student', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(133, 'manage_class_routine', 'manage class routine', '', 'gestionar rutina de la clase', 'إدارة روتين الطبقة', 'beheren klasroutine', 'Ã‘Æ’ÃÂ¿Ã‘â‚¬ÃÂ°ÃÂ²ÃÂ»Ã‘ÂÃ‘â€šÃ‘Å’ Ã‘â‚¬Ã‘Æ’Ã‘â€šÃÂ¸ÃÂ½Ã‘Æ’ ÃÂºÃÂ»ÃÂ°Ã‘ÂÃ‘ÂÃÂ°', 'Ã§Â®Â¡Ã§Ââ€ Ã§Â±Â»Ã¥Â¸Â¸Ã¨Â§â€ž', 'sÃ„Â±nÃ„Â±f rutin yÃƒÂ¶netmek', 'gerenciar rotina classe', 'kezelni class rutin', 'gÃƒÂ©rer la routine de classe', 'ÃŽÂ´ÃŽÂ¹ÃŽÂ±Ãâ€¡ÃŽÂµÃŽÂ¹ÃÂÃŽÂ¯ÃŽÂ¶ÃŽÂ¿ÃŽÂ½Ãâ€žÃŽÂ±ÃŽÂ¹ Ãâ€žÃŽÂ¬ÃŽÂ¾ÃŽÂ· ÃÂÃŽÂ¿Ãâ€¦Ãâ€žÃŽÂ¯ÃŽÂ½ÃŽÂ±', 'verwalten Klasse Routine', 'gestione classe di routine', 'Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸Ë†Ã Â¸Â±Ã Â¸â€Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸Å Ã Â¸Â±Ã Â¹â€°Ã Â¸â„¢Ã Â¹â‚¬Ã Â¸Â£Ã Â¸ÂµÃ Â¸Â¢Ã Â¸â„¢Ã Â¸â€¢Ã Â¸Â²Ã Â¸Â¡Ã Â¸â€ºÃ Â¸ÂÃ Â¸â€¢Ã Â¸Â´', 'ÃšÂ©Ã™â€žÃ˜Â§Ã˜Â³ Ã™â€¦Ã˜Â¹Ã™â€¦Ã™Ë†Ã™â€ž ÃšÂ©Ã˜Â§ Ã˜Â§Ã™â€ Ã˜ÂªÃ˜Â¸Ã˜Â§Ã™â€¦', 'Ã Â¤ÂµÃ Â¤Â°Ã Â¥ÂÃ Â¤â€” Ã Â¤Â¦Ã Â¤Â¿Ã Â¤Â¨Ã Â¤Å¡Ã Â¤Â°Ã Â¥ÂÃ Â¤Â¯Ã Â¤Â¾ Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¤Â¬Ã Â¤â€šÃ Â¤Â§Ã Â¤Â¨', 'uno in genere tractare', 'mengelola rutinitas kelas', 'Ã£â€šÂ¯Ã£Æ’Â©Ã£â€šÂ¹Ã£Æ’Â«Ã£Æ’Â¼Ã£Æ’ÂÃ£Æ’Â³Ã£â€šâ€™Ã§Â®Â¡Ã§Ââ€ ', 'Ã¬Ë†ËœÃ¬Â¤â‚¬Ã¬ÂËœ Ã¬ÂÂ¼Ã¬Æ’ÂÃ¬Â ÂÃ¬ÂÂ¸ ÃªÂ´â‚¬Ã«Â¦Â¬'),
(18442, 'book_author', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18441, 'book_category', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18440, 'book_publisher', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18439, 'master_data', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18314, 'the_address', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18438, 'manage_library', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18437, 'expense_category', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18436, 'expense', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18435, 'expenses', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `bengali`, `spanish`, `arabic`, `dutch`, `russian`, `chinese`, `turkish`, `portuguese`, `hungarian`, `french`, `greek`, `german`, `italian`, `thai`, `urdu`, `hindi`, `latin`, `indonesian`, `japanese`, `korean`) VALUES
(134, 'class_routine_list', 'class routine list', '', 'clase de lista de rutina', 'قائمة روتينية رفيعة المستوى', 'klasroutine lijst', 'ÃÂºÃÂ»ÃÂ°Ã‘ÂÃ‘Â Ã‘â‚¬Ã‘Æ’Ã‘â€šÃÂ¸ÃÂ½ÃÂ° Ã‘ÂÃÂ¿ÃÂ¸Ã‘ÂÃÂ¾ÃÂº', 'Ã§ÂÂ­Ã§ÂºÂ§Ã¥Â¸Â¸Ã¨Â§â€žÃ¥Ë†â€”Ã¨Â¡Â¨', 'sÃ„Â±nÃ„Â±f rutin listesi', 'classe de lista de rotina', 'osztÃƒÂ¡ly rutin lista', 'classe liste routine', 'ÃŽÂºÃŽÂ»ÃŽÂ¬ÃÆ’ÃŽÂ· list ÃÂÃŽÂ¿Ãâ€¦Ãâ€žÃŽÂ¯ÃŽÂ½ÃŽÂ±Ãâ€š', 'Klasse Routine Liste', 'classe lista di routine', 'Ã Â¸Â£Ã Â¸Â²Ã Â¸Â¢Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸â€ºÃ Â¸Â£Ã Â¸Â°Ã Â¸Ë†Ã Â¸Â³Ã Â¸Å Ã Â¸Â±Ã Â¹â€°Ã Â¸â„¢', 'ÃšÂ©Ã™â€žÃ˜Â§Ã˜Â³ Ã™â€¦Ã˜Â¹Ã™â€¦Ã™Ë†Ã™â€ž ÃšÂ©Ã›â€™ Ã™â€¦Ã˜Â·Ã˜Â§Ã˜Â¨Ã™â€š Ã™ÂÃ›ÂÃ˜Â±Ã˜Â³Ã˜Âª', 'Ã Â¤ÂµÃ Â¤Â°Ã Â¥ÂÃ Â¤â€” Ã Â¤Â¦Ã Â¤Â¿Ã Â¤Â¨Ã Â¤Å¡Ã Â¤Â°Ã Â¥ÂÃ Â¤Â¯Ã Â¤Â¾ Ã Â¤Â¸Ã Â¥â€šÃ Â¤Å¡Ã Â¥â‚¬', 'uno genere album', 'Daftar rutin kelas', 'Ã£â€šÂ¯Ã£Æ’Â©Ã£â€šÂ¹Ã£Æ’Â«Ã£Æ’Â¼Ã£Æ’ÂÃ£Æ’Â³Ã¤Â¸â‚¬Ã¨Â¦Â§', 'Ã­ÂÂ´Ã«Å¾ËœÃ¬Å Â¤ Ã«Â£Â¨Ã­â€¹Â´ Ã«ÂªÂ©Ã«Â¡Â'),
(18434, 'manage_invoice', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18433, 'fees_payments', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18432, 'collect_fees', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18431, 'fee_collection', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18430, 'generate_report_card', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18429, 'send_scores_by_sms', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18428, 'enter_student_scores', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18427, 'report_cards', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(135, 'add_class_routine', 'add class routine', '', 'aÃƒÂ±adir rutina de la clase', 'إضافة روتين الطبقة', 'voeg klasroutine', 'ÃÂ´ÃÂ¾ÃÂ±ÃÂ°ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ ÃÂ¿ÃÂ¾ÃÂ´ÃÂ¿Ã‘â‚¬ÃÂ¾ÃÂ³Ã‘â‚¬ÃÂ°ÃÂ¼ÃÂ¼Ã‘Æ’ ÃÂºÃÂ»ÃÂ°Ã‘ÂÃ‘ÂÃÂ°', 'Ã¦Â·Â»Ã¥Å Â Ã§Â±Â»Ã¥Â¸Â¸Ã¨Â§â€ž', 'sÃ„Â±nÃ„Â±f rutin eklemek', 'adicionar rotina classe', 'hozzÃƒÂ¡ class rutin', 'ajouter routine de classe', 'Ãâ‚¬ÃÂÃŽÂ¿ÃÆ’ÃŽÂ¸ÃŽÂ­ÃÆ’ÃŽÂµÃâ€žÃŽÂµ Ãâ€žÃŽÂ¬ÃŽÂ¾ÃŽÂ· ÃÂÃŽÂ¿Ãâ€¦Ãâ€žÃŽÂ¯ÃŽÂ½ÃŽÂ±', 'Klasse hinzufÃƒÂ¼gen Routine', 'aggiungere classe di routine', 'Ã Â¹â‚¬Ã Â¸Å¾Ã Â¸Â´Ã Â¹Ë†Ã Â¸Â¡Ã Â¸Â£Ã Â¸Â°Ã Â¸â€Ã Â¸Â±Ã Â¸Å¡Ã Â¸â€¢Ã Â¸Â²Ã Â¸Â¡Ã Â¸â€ºÃ Â¸ÂÃ Â¸â€¢Ã Â¸Â´', 'ÃšÂ©Ã™â€žÃ˜Â§Ã˜Â³ Ã™â€¦Ã˜Â¹Ã™â€¦Ã™Ë†Ã™â€ž Ã™â€¦Ã›Å’ÃšÂº Ã˜Â´Ã˜Â§Ã™â€¦Ã™â€ž ÃšÂ©Ã˜Â±Ã›Å’ÃšÂº', 'Ã Â¤ÂµÃ Â¤Â°Ã Â¥ÂÃ Â¤â€” Ã Â¤Â¦Ã Â¤Â¿Ã Â¤Â¨Ã Â¤Å¡Ã Â¤Â°Ã Â¥ÂÃ Â¤Â¯Ã Â¤Â¾ Ã Â¤Å“Ã Â¥â€¹Ã Â¤Â¡Ã Â¤Â¼', 'adde genus moris', 'menambahkan rutin kelas', 'Ã£â€šÂ¯Ã£Æ’Â©Ã£â€šÂ¹Ã‚Â·Ã£Æ’Â«Ã£Æ’Â¼Ã£Æ’ÂÃ£Æ’Â³Ã£â€šâ€™Ã¨Â¿Â½Ã¥Å Â ', 'Ã­ÂÂ´Ã«Å¾ËœÃ¬Å Â¤ Ã«Â£Â¨Ã­â€¹Â´Ã¬Ââ€ž Ã¬Â¶â€ÃªÂ°â‚¬'),
(18426, 'exam_grades', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18425, 'exam_questions', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18424, 'manage_exams', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18423, 'view_result', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18422, 'list_exams', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18421, 'add_exams', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18420, 'manage_CBT', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(136, 'day', 'day', '', 'dÃƒÂ­a', 'يوم', 'dag', 'ÃÂ´ÃÂµÃÂ½Ã‘Å’', 'Ã¦â€”Â¥', 'gÃƒÂ¼n', 'dia', 'nap', 'jour', 'ÃŽÂ·ÃŽÂ¼ÃŽÂ­ÃÂÃŽÂ±', 'Tag', 'giorno', 'Ã Â¸Â§Ã Â¸Â±Ã Â¸â„¢', 'Ã˜Â¯Ã™â€ ', 'Ã Â¤Â¦Ã Â¤Â¿Ã Â¤Â¨', 'die,', 'hari', 'Ã¦â€”Â¥', 'Ã¬ÂÂ¼'),
(18419, 'daily_attendances', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(137, 'starting_time', 'starting time', '', 'tiempo de inicio', 'وقت البدء', 'starttijd', 'ÃÂ²Ã‘â‚¬ÃÂµÃÂ¼Ã‘Â ÃÂ½ÃÂ°Ã‘â€¡ÃÂ°ÃÂ»ÃÂ°', 'Ã¥Â¼â‚¬Ã¥Â§â€¹Ã¦â€”Â¶Ã©â€”Â´', 'baÃ…Å¸langÃ„Â±ÃƒÂ§ Ã¢â‚¬â€¹Ã¢â‚¬â€¹zamanÃ„Â±', 'tempo comeÃƒÂ§ando', 'indÃƒÂ­tÃƒÂ¡si idÃ…â€˜', 'temps de dÃƒÂ©marrage', 'ÃÅ½ÃÂÃŽÂ± ÃŽÂ­ÃŽÂ½ÃŽÂ±ÃÂÃŽÂ¾ÃŽÂ·Ãâ€š', 'Startzeit', 'tempo di avviamento', 'Ã Â¹â‚¬Ã Â¸Â§Ã Â¸Â¥Ã Â¸Â²Ã Â¹â‚¬Ã Â¸Â£Ã Â¸Â´Ã Â¹Ë†Ã Â¸Â¡Ã Â¸â€¢Ã Â¹â€°Ã Â¸â„¢', 'Ã™Ë†Ã™â€šÃ˜Âª Ã˜Â´Ã˜Â±Ã™Ë†Ã˜Â¹ Ã›ÂÃ™Ë†Ã™â€ Ã›â€™', 'Ã Â¤Â¸Ã Â¤Â®Ã Â¤Â¯ Ã Â¤â€¢Ã Â¥â‚¬ Ã Â¤Â¶Ã Â¥ÂÃ Â¤Â°Ã Â¥ÂÃ Â¤â€ Ã Â¤Â¤ Ã Â¤â€¢Ã Â¥â€¡', 'tum satus', 'waktu mulai', 'Ã¨ÂµÂ·Ã¥â€¹â€¢Ã¦â„¢â€šÃ©â€“â€œ', 'Ã¬â€¹Å“Ã¬Å¾â€˜ Ã¬â€¹Å“ÃªÂ°â€ž'),
(18418, 'manage_subjects', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18417, 'class_timetable', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18416, 'manage_sections', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18415, 'manage_classes', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(138, 'ending_time', 'ending time', '', 'hora de finalizaciÃƒÂ³n', 'نهاية الوقت', 'eindtijd', 'ÃÂ²Ã‘â‚¬ÃÂµÃÂ¼Ã‘Â ÃÂ¾ÃÂºÃÂ¾ÃÂ½Ã‘â€¡ÃÂ°ÃÂ½ÃÂ¸Ã‘Â', 'Ã§Â»â€œÃ¦ÂÅ¸Ã¦â€”Â¶Ã©â€”Â´', 'bitiÃ…Å¸ zamanÃ„Â±nÃ„Â±', 'tempo final', 'befejezÃƒÂ©si idÃ…â€˜pont', 'heure de fin', 'ÃÅ½ÃÂÃŽÂ± ÃŽÂ»ÃŽÂ®ÃŽÂ¾ÃŽÂ·Ãâ€š', 'Endzeit', 'ora finale', 'Ã Â¸ÂªÃ Â¸Â´Ã Â¹â€°Ã Â¸â„¢Ã Â¸ÂªÃ Â¸Â¸Ã Â¸â€Ã Â¹â‚¬Ã Â¸Â§Ã Â¸Â¥Ã Â¸Â²', 'Ã™Ë†Ã™â€šÃ˜Âª Ã˜Â®Ã˜ÂªÃ™â€¦', 'Ã Â¤Â¸Ã Â¤Â®Ã Â¤Â¯ Ã Â¤Â¸Ã Â¤Â®Ã Â¤Â¾Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â¤ Ã Â¤Â¹Ã Â¥â€¹Ã Â¤Â¨Ã Â¥â€¡ Ã Â¤â€¢Ã Â¥â€¡', 'et finis temporis,', 'akhir waktu', 'Ã§Âµâ€šÃ¤Âºâ€ Ã¦â„¢â€šÃ¥Ë†Â»', 'Ã¬Â¢â€¦Ã«Â£Å’ Ã¬â€¹Å“ÃªÂ°â€ž'),
(18414, 'class_information', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18413, 'librarian_ID_card', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18412, 'accountant_ID_card', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18411, 'hostel_ID_card', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(139, 'edit_class_routine', 'edit class routine', '', 'rutina de la clase de ediciÃƒÂ³n', 'تحرير الطبقة الروتينية', 'bewerk klasroutine', 'ÃÅ¸Ã‘â‚¬ÃÂ¾Ã‘â€ ÃÂµÃÂ´Ã‘Æ’Ã‘â‚¬ÃÂ° Ã‘â‚¬ÃÂµÃÂ´ÃÂ°ÃÂºÃ‘â€šÃÂ¸Ã‘â‚¬ÃÂ¾ÃÂ²ÃÂ°ÃÂ½ÃÂ¸Ã‘Â ÃÂºÃÂ»ÃÂ°Ã‘ÂÃ‘Â', 'Ã§Â¼â€“Ã¨Â¾â€˜Ã§Â±Â»Ã¥Â¸Â¸Ã¨Â§â€ž', 'sÃ„Â±nÃ„Â±f dÃƒÂ¼zenle rutin', 'rotina de ediÃƒÂ§ÃƒÂ£o de classe', 'szerkesztÃƒÂ©s osztÃƒÂ¡ly rutin', 'routine modifier de classe', 'edit Ãâ€žÃŽÂ¬ÃŽÂ¾ÃŽÂ· ÃÂÃŽÂ¿Ãâ€¦Ãâ€žÃŽÂ¯ÃŽÂ½ÃŽÂ±', 'edit Klasse Routine', 'modifica della classe di routine', 'Ã Â¹ÂÃ Â¸ÂÃ Â¹â€°Ã Â¹â€žÃ Â¸â€šÃ Â¸Å Ã Â¸Â±Ã Â¹â€°Ã Â¸â„¢Ã Â¹â‚¬Ã Â¸Â£Ã Â¸ÂµÃ Â¸Â¢Ã Â¸â„¢Ã Â¸â€¢Ã Â¸Â²Ã Â¸Â¡Ã Â¸â€ºÃ Â¸ÂÃ Â¸â€¢Ã Â¸Â´', 'Ã˜ÂªÃ˜Â±Ã™â€¦Ã›Å’Ã™â€¦ ÃšÂ©Ã™â€žÃ˜Â§Ã˜Â³ Ã™â€¦Ã˜Â¹Ã™â€¦Ã™Ë†Ã™â€ž', 'Ã Â¤Â¸Ã Â¤â€šÃ Â¤ÂªÃ Â¤Â¾Ã Â¤Â¦Ã Â¤Â¿Ã Â¤Â¤ Ã Â¤ÂµÃ Â¤Â°Ã Â¥ÂÃ Â¤â€” Ã Â¤Â¦Ã Â¤Â¿Ã Â¤Â¨Ã Â¤Å¡Ã Â¤Â°Ã Â¥ÂÃ Â¤Â¯Ã Â¤Â¾', 'edit uno genere', 'rutin mengedit kelas', 'Ã§Â·Â¨Ã©â€ºâ€ Ã£â€šÂ¯Ã£Æ’Â©Ã£â€šÂ¹Ã£ÂÂ®Ã£Æ’Â«Ã£Æ’Â¼Ã£Æ’ÂÃ£Æ’Â³', 'Ã­Å½Â¸Ã¬Â§â€˜ Ã­ÂÂ´Ã«Å¾ËœÃ¬Å Â¤ Ã«Â£Â¨Ã­â€¹Â´'),
(18410, 'student_ID_card', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18409, 'teacher_ID_card', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18408, 'generate_ID_cards', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18407, 'loan_approval', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18406, 'loan_applicant', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18405, 'manage_loan', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18403, 'manage_parents', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18404, 'manage_alumni', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(140, 'manage_invoice/payment', 'manage invoice/payment', '', 'gestionar factura / pago', 'إدارة الفاتورة / الدفع', 'beheren factuur / betaling', 'Ã‘Æ’ÃÂ¿Ã‘â‚¬ÃÂ°ÃÂ²ÃÂ»Ã‘ÂÃ‘â€šÃ‘Å’ Ã‘ÂÃ‘â€¡ÃÂµÃ‘â€šÃÂ° / ÃÂ¾ÃÂ¿ÃÂ»ÃÂ°Ã‘â€šÃÂ°', 'Ã§Â®Â¡Ã§Ââ€ Ã¥Ââ€˜Ã§Â¥Â¨/Ã¤Â»ËœÃ¦Â¬Â¾', 'fatura / ÃƒÂ¶deme yÃƒÂ¶netmek', 'gerenciar fatura / pagamento', 'kezelni szÃƒÂ¡mla / fizetÃƒÂ©si', 'gÃƒÂ©rer facture / paiement', 'ÃŽÂ´ÃŽÂ¹ÃŽÂ±Ãâ€¡ÃŽÂµÃŽÂ¯ÃÂÃŽÂ¹ÃÆ’ÃŽÂ· Ãâ€žÃŽÂ¹ÃŽÂ¼ÃŽÂ¿ÃŽÂ»ÃŽÂ¿ÃŽÂ³ÃŽÂ¯ÃŽÂ¿Ãâ€¦ / Ãâ‚¬ÃŽÂ»ÃŽÂ·ÃÂÃâ€°ÃŽÂ¼ÃŽÂ®Ãâ€š', 'Verwaltung Rechnung / Zahlung', 'gestione fattura / pagamento', 'Ã Â¸Ë†Ã Â¸Â±Ã Â¸â€Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¹Æ’Ã Â¸Å¡Ã Â¹ÂÃ Â¸Ë†Ã Â¹â€°Ã Â¸â€¡Ã Â¸Â«Ã Â¸â„¢Ã Â¸ÂµÃ Â¹â€° / Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸Å Ã Â¸Â³Ã Â¸Â£Ã Â¸Â°Ã Â¹â‚¬Ã Â¸â€¡Ã Â¸Â´Ã Â¸â„¢', 'Ã˜Â§Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¦Ã˜Â³ / Ã˜Â§Ã˜Â¯Ã˜Â§Ã˜Â¦Ã›Å’ÃšÂ¯Ã›Å’ ÃšÂ©Ã˜Â§ Ã˜Â§Ã™â€ Ã˜ÂªÃ˜Â¸Ã˜Â§Ã™â€¦', 'Ã Â¤Å¡Ã Â¤Â¾Ã Â¤Â²Ã Â¤Â¾Ã Â¤Â¨ / Ã Â¤Â­Ã Â¥ÂÃ Â¤â€”Ã Â¤Â¤Ã Â¤Â¾Ã Â¤Â¨ Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¤Â¬Ã Â¤â€šÃ Â¤Â§Ã Â¤Â¨', 'curo cautionem / solutionem', 'mengelola tagihan / pembayaran', 'Ã¨Â«â€¹Ã¦Â±â€šÃ¦â€ºÂ¸/Ã¦â€Â¯Ã¦â€°â€¢Ã§Â®Â¡Ã§Ââ€ ', 'Ã¬ÂÂ¸Ã«Â³Â´Ã¬ÂÂ´Ã¬Å Â¤ / ÃªÂ²Â°Ã¬Â Å“ ÃªÂ´â‚¬Ã«Â¦Â¬'),
(18402, 'assignments', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18401, 'download_page', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18400, 'attendance_report', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18399, 'student_attendance', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18398, 'manage_attendance', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18397, 'promote_students', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18396, 'student_details', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18395, 'list_students', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(141, 'invoice/payment_list', 'invoice/payment list', '', 'lista de facturas / pagos', 'الفاتورة / قائمة الدفع', 'factuur / betaling lijst', 'ÃÂ¡ÃÂ¿ÃÂ¸Ã‘ÂÃÂ¾ÃÂº Ã‘ÂÃ‘â€¡ÃÂµÃ‘â€šÃÂ° / ÃÂ¾ÃÂ¿ÃÂ»ÃÂ°Ã‘â€šÃÂ°', 'Ã¥Ââ€˜Ã§Â¥Â¨/Ã¤Â»ËœÃ¦Â¬Â¾Ã¦Â¸â€¦Ã¥Ââ€¢', 'fatura / ÃƒÂ¶deme listesi', 'lista de fatura / pagamento', 'szÃƒÂ¡mla / fizetÃƒÂ©si lista', 'liste facture / paiement', 'ÃŽâ€ºÃŽÂ¯ÃÆ’Ãâ€žÃŽÂ± Ãâ€žÃŽÂ¹ÃŽÂ¼ÃŽÂ¿ÃŽÂ»ÃŽÂ¿ÃŽÂ³ÃŽÂ¯ÃŽÂ¿Ãâ€¦ / Ãâ‚¬ÃŽÂ»ÃŽÂ·ÃÂÃâ€°ÃŽÂ¼ÃŽÂ®Ãâ€š', 'Rechnung / Zahlungsliste', 'elenco fattura / pagamento', 'Ã Â¸Â£Ã Â¸Â²Ã Â¸Â¢Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¹Æ’Ã Â¸Å¡Ã Â¹ÂÃ Â¸Ë†Ã Â¹â€°Ã Â¸â€¡Ã Â¸Â«Ã Â¸â„¢Ã Â¸ÂµÃ Â¹â€° / Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸Å Ã Â¸Â³Ã Â¸Â£Ã Â¸Â°Ã Â¹â‚¬Ã Â¸â€¡Ã Â¸Â´Ã Â¸â„¢', 'Ã˜Â§Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¦Ã˜Â³ / Ã˜Â§Ã˜Â¯Ã˜Â§Ã˜Â¦Ã›Å’ÃšÂ¯Ã›Å’ ÃšÂ©Ã›Å’ Ã™ÂÃ›ÂÃ˜Â±Ã˜Â³Ã˜Âª', 'Ã Â¤Å¡Ã Â¤Â¾Ã Â¤Â²Ã Â¤Â¾Ã Â¤Â¨ / Ã Â¤Â­Ã Â¥ÂÃ Â¤â€”Ã Â¤Â¤Ã Â¤Â¾Ã Â¤Â¨ Ã Â¤Â¸Ã Â¥â€šÃ Â¤Å¡Ã Â¥â‚¬', 'cautionem / list pretium', 'daftar tagihan / pembayaran', 'Ã¨Â«â€¹Ã¦Â±â€šÃ¦â€ºÂ¸/Ã¦â€Â¯Ã¦â€°â€¢Ã¤Â¸â‚¬Ã¨Â¦Â§', 'Ã¬ÂÂ¸Ã«Â³Â´Ã¬ÂÂ´Ã¬Å Â¤ / ÃªÂ²Â°Ã¬Â Å“Ã«Â¦Â¬Ã¬Å Â¤Ã­Å Â¸'),
(18394, 'admission_form', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18393, 'manage_students', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18392, 'hostel_manager', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18391, 'accountants', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18390, 'librarians', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18389, 'teachers', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18388, 'manage_staff', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(142, 'add_invoice/payment', 'add invoice/payment', '', 'aÃƒÂ±adir factura / pago', 'إضافة الفاتورة / الدفع', 'voeg factuur / betaling', 'ÃÂ´ÃÂ¾ÃÂ±ÃÂ°ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ Ã‘ÂÃ‘â€¡ÃÂµÃ‘â€šÃÂ° / ÃÂ¾ÃÂ¿ÃÂ»ÃÂ°Ã‘â€šÃÂ°', 'Ã¦Â·Â»Ã¥Å Â Ã¥Ââ€˜Ã§Â¥Â¨/Ã¤Â»ËœÃ¦Â¬Â¾', 'fatura / ÃƒÂ¶deme eklemek', 'adicionar factura / pagamento', 'hozzÃƒÂ¡ szÃƒÂ¡mla / fizetÃƒÂ©si', 'ajouter facture / paiement', 'Ãâ‚¬ÃÂÃŽÂ¿ÃÆ’ÃŽÂ¸ÃŽÂ®ÃŽÂºÃŽÂ· Ãâ€žÃŽÂ¹ÃŽÂ¼ÃŽÂ¿ÃŽÂ»ÃŽÂ¿ÃŽÂ³ÃŽÂ¯ÃŽÂ¿Ãâ€¦ / Ãâ‚¬ÃŽÂ»ÃŽÂ·ÃÂÃâ€°ÃŽÂ¼ÃŽÂ®Ãâ€š', 'hinzufÃƒÂ¼gen Rechnung / Zahlung', 'aggiungere fatturazione / pagamento', 'Ã Â¹â‚¬Ã Â¸Å¾Ã Â¸Â´Ã Â¹Ë†Ã Â¸Â¡Ã Â¹Æ’Ã Â¸Å¡Ã Â¹ÂÃ Â¸Ë†Ã Â¹â€°Ã Â¸â€¡Ã Â¸Â«Ã Â¸â„¢Ã Â¸ÂµÃ Â¹â€° / Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸Å Ã Â¸Â³Ã Â¸Â£Ã Â¸Â°Ã Â¹â‚¬Ã Â¸â€¡Ã Â¸Â´Ã Â¸â„¢', 'Ã˜Â§Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¦Ã˜Â³ / Ã˜Â§Ã˜Â¯Ã˜Â§Ã˜Â¦Ã›Å’ÃšÂ¯Ã›Å’ Ã˜Â´Ã˜Â§Ã™â€¦Ã™â€ž', 'Ã Â¤Å¡Ã Â¤Â¾Ã Â¤Â²Ã Â¤Â¾Ã Â¤Â¨ / Ã Â¤Â­Ã Â¥ÂÃ Â¤â€”Ã Â¤Â¤Ã Â¤Â¾Ã Â¤Â¨ Ã Â¤Å“Ã Â¥â€¹Ã Â¤Â¡Ã Â¤Â¼Ã Â¥â€¡Ã Â¤â€š', 'add cautionem / solutionem', 'menambahkan tagihan / pembayaran', 'Ã¨Â«â€¹Ã¦Â±â€šÃ¦â€ºÂ¸/Ã¦â€Â¯Ã¦â€°â€¢Ã£â€šâ€™Ã¨Â¿Â½Ã¥Å Â ', 'Ã¬â€ Â¡Ã¬Å¾Â¥ / Ã¬Â§â‚¬Ã«Â¶Ë†Ã¬Ââ€ž Ã¬Â¶â€ÃªÂ°â‚¬'),
(18387, 'manage_help_desks', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18386, 'manage_help_link', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18385, 'academic_syllabus', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18384, 'moral_talk', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18383, 'manage_holiday', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18382, 'task_manager', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(143, 'title', 'title', '', 'tÃƒÂ­tulo', 'عنوان', 'titel', 'ÃÂ½ÃÂ°ÃÂ·ÃÂ²ÃÂ°ÃÂ½ÃÂ¸ÃÂµ', 'Ã¦Â â€¡Ã©Â¢Ëœ', 'baÃ…Å¸lÃ„Â±k', 'tÃƒÂ­tulo', 'cÃƒÂ­m', 'titre', 'Ãâ€žÃŽÂ¯Ãâ€žÃŽÂ»ÃŽÂ¿Ãâ€š', 'Titel', 'titolo', 'Ã Â¸Å Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¹â‚¬Ã Â¸Â£Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸â€¡', 'Ã˜Â¹Ã™â€ Ã™Ë†Ã˜Â§Ã™â€ ', 'Ã Â¤Â¶Ã Â¥â‚¬Ã Â¤Â°Ã Â¥ÂÃ Â¤Â·Ã Â¤â€¢', 'title', 'judul', 'Ã£â€šÂ¿Ã£â€šÂ¤Ã£Æ’Ë†Ã£Æ’Â«', 'Ã­â€˜Å“Ã¬Â Å“'),
(18381, 'manage_circular', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18380, 'school_clubs', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(144, 'description', 'description', '', 'descripciÃƒÂ³n', 'وصف', 'beschrijving', 'ÃÂ¾ÃÂ¿ÃÂ¸Ã‘ÂÃÂ°ÃÂ½ÃÂ¸ÃÂµ', 'Ã¦ÂÂÃ¨Â¿Â°', 'tanÃ„Â±m', 'descriÃƒÂ§ÃƒÂ£o', 'leÃƒÂ­rÃƒÂ¡s', 'description', 'Ãâ‚¬ÃŽÂµÃÂÃŽÂ¹ÃŽÂ³ÃÂÃŽÂ±Ãâ€ ÃŽÂ®', 'Beschreibung', 'descrizione', 'Ã Â¸Â¥Ã Â¸Â±Ã Â¸ÂÃ Â¸Â©Ã Â¸â€œÃ Â¸Â°', 'Ã˜ÂªÃ™ÂÃ˜ÂµÃ›Å’Ã™â€ž', 'Ã Â¤ÂµÃ Â¤Â¿Ã Â¤ÂµÃ Â¤Â°Ã Â¤Â£', 'description', 'deskripsi', 'Ã¨ÂªÂ¬Ã¦ËœÅ½', 'ÃªÂ¸Â°Ã¬Ë†Â '),
(18379, 'view_enquiries', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18378, 'enquiry_category', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(145, 'amount', 'amount', '', 'cantidad', 'كمية', 'bedrag', 'ÃÂºÃÂ¾ÃÂ»ÃÂ¸Ã‘â€¡ÃÂµÃ‘ÂÃ‘â€šÃÂ²ÃÂ¾', 'Ã©â€¡Â', 'miktar', 'quantidade', 'mennyisÃƒÂ©g', 'montant', 'Ãâ‚¬ÃŽÂ¿ÃÆ’ÃÅ’', 'Menge', 'importo', 'Ã Â¸Ë†Ã Â¸Â³Ã Â¸â„¢Ã Â¸Â§Ã Â¸â„¢', 'Ã˜Â±Ã™â€šÃ™â€¦', 'Ã Â¤Â°Ã Â¤Â¾Ã Â¤Â¶Ã Â¤Â¿', 'tantum', 'jumlah', 'Ã©Â¡Â', 'Ã¬â€“â€˜'),
(18377, 'manage_session', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18376, 'academics', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(146, 'status', 'status', '', 'estado', 'الحالة', 'toestand', 'Ã‘ÂÃ‘â€šÃÂ°Ã‘â€šÃ‘Æ’Ã‘Â', 'Ã§Å Â¶Ã¦â‚¬Â', 'durum', 'estado', 'ÃƒÂ¡llapot', 'statut', 'ÃŽÂºÃŽÂ±Ãâ€žÃŽÂ¬ÃÆ’Ãâ€žÃŽÂ±ÃÆ’ÃŽÂ·', 'Status', 'stato', 'Ã Â¸ÂªÃ Â¸â€“Ã Â¸Â²Ã Â¸â„¢Ã Â¸Â°', 'Ã˜Â¯Ã˜Â±Ã˜Â¬Ã›Â', 'Ã Â¤Â¹Ã Â¥Ë†Ã Â¤Â¸Ã Â¤Â¿Ã Â¤Â¯Ã Â¤Â¤', 'status', 'status', 'Ã£â€šÂ¹Ã£Æ’â€ Ã£Æ’Â¼Ã£â€šÂ¿Ã£â€šÂ¹', 'Ã¬Â§â‚¬Ã¬Å“â€ž'),
(18374, 'forgot_your_password', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18375, 'home', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(147, 'view_invoice', 'view invoice', '', 'vista de la factura', 'عرض الفاتورة', 'view factuur', 'ÃÂ²ÃÂ¸ÃÂ´ Ã‘ÂÃ‘â€¡ÃÂµÃ‘â€šÃÂ°-Ã‘â€žÃÂ°ÃÂºÃ‘â€šÃ‘Æ’Ã‘â‚¬Ã‘â€¹', 'Ã¦Å¸Â¥Ã§Å“â€¹Ã¥Ââ€˜Ã§Â¥Â¨', 'view fatura', 'vista da fatura', 'view szÃƒÂ¡mla', 'vue facture', 'Ãâ‚¬ÃÂÃŽÂ¿ÃŽÂ²ÃŽÂ¿ÃŽÂ»ÃŽÂ® Ãâ€žÃŽÂ¹ÃŽÂ¼ÃŽÂ¿ÃŽÂ»ÃÅ’ÃŽÂ³ÃŽÂ¹ÃŽÂ¿', 'Ansicht Rechnung', 'vista fattura', 'Ã Â¸â€Ã Â¸Â¹Ã Â¹Æ’Ã Â¸Å¡Ã Â¹ÂÃ Â¸Ë†Ã Â¹â€°Ã Â¸â€¡Ã Â¸Â«Ã Â¸â„¢Ã Â¸ÂµÃ Â¹â€°', 'Ã˜Â¯Ã›Å’ÃšÂ©ÃšÂ¾Ã›Å’ÃšÂº Ã˜Â§Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¦Ã˜Â³', 'Ã Â¤Â¦Ã Â¥â€¡Ã Â¤â€“Ã Â¥â€¡Ã Â¤â€š Ã Â¤Å¡Ã Â¤Â¾Ã Â¤Â²Ã Â¤Â¾Ã Â¤Â¨', 'propter cautionem', 'lihat faktur', 'Ã£Æ’â€œÃ£Æ’Â¥Ã£Æ’Â¼Ã¨Â«â€¹Ã¦Â±â€šÃ¦â€ºÂ¸', 'Ã«Â³Â´ÃªÂ¸Â° Ã¬â€ Â¡Ã¬Å¾Â¥'),
(148, 'paid', 'paid', '', 'pagado', 'دفع', 'betaald', 'ÃÂ¾ÃÂ¿ÃÂ»ÃÂ°Ã‘â€¡ÃÂµÃÂ½ÃÂ½Ã‘â€¹ÃÂ¹', 'Ã¦â€Â¯Ã¤Â»Ëœ', 'ÃƒÂ¼cretli', 'pago', 'fizetett', 'payÃƒÂ©', 'ÃŽÂºÃŽÂ±Ãâ€žÃŽÂ±ÃŽÂ²ÃŽÂ»ÃŽÂ·ÃŽÂ¸ÃŽÂµÃŽÂ¯', 'bezahlt', 'pagato', 'Ã Â¸â€¢Ã Â¹â€°Ã Â¸Â­Ã Â¸â€¡Ã Â¸Ë†Ã Â¹Ë†Ã Â¸Â²Ã Â¸Â¢', 'Ã˜Â§Ã˜Â¯Ã˜Â§ ÃšÂ©Ã›Å’Ã˜Â§', 'Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¤Â¦Ã Â¤Â¤Ã Â¥ÂÃ Â¤Â¤', 'solutis', 'dibayar', 'Ã¦â€Â¯Ã¦â€°â€¢Ã£â€šÂÃ£â€šÅ’Ã£ÂÅ¸', 'Ã¬Â§â‚¬ÃªÂ¸â€°'),
(149, 'unpaid', 'unpaid', '', 'no pagado', 'غير مدفوع', 'onbetaald', 'ÃÂ½ÃÂµÃÂ¾ÃÂ¿ÃÂ»ÃÂ°Ã‘â€¡ÃÂµÃÂ½ÃÂ½Ã‘â€¹ÃÂ¹', 'Ã¦Å“ÂªÃ¤Â»Ëœ', 'ÃƒÂ¶denmemiÃ…Å¸', 'nÃƒÂ£o remunerado', 'kifizetetlen', 'non rÃƒÂ©munÃƒÂ©rÃƒÂ©', 'ÃŽÂ±Ãâ‚¬ÃŽÂ»ÃŽÂ®ÃÂÃâ€°Ãâ€žÃŽÂ·', 'unbezahlt', 'non pagato', 'Ã Â¸Â¢Ã Â¸Â±Ã Â¸â€¡Ã Â¹â€žÃ Â¸Â¡Ã Â¹Ë†Ã Â¹â€žÃ Â¸â€Ã Â¹â€°Ã Â¸Å Ã Â¸Â³Ã Â¸Â£Ã Â¸Â°', 'Ã˜Â¨Ã™â€žÃ˜Â§ Ã™â€¦Ã˜Â¹Ã˜Â§Ã™Ë†Ã˜Â¶Ã›Â', 'Ã Â¤â€¦Ã Â¤ÂµÃ Â¥Ë†Ã Â¤Â¤Ã Â¤Â¨Ã Â¤Â¿Ã Â¤â€¢', 'non est constitutus,', 'dibayar', 'Ã¦Å“ÂªÃ¦â€°â€¢Ã£Ââ€ž', 'Ã¬Â§â‚¬Ã«Â¶Ë†Ã­â€¢ËœÃ¬Â§â‚¬ Ã¬â€¢Å Ã¬Ââ‚¬'),
(150, 'add_invoice', 'add invoice', '', 'aÃƒÂ±adir factura', 'إضافة الفاتورة', 'voeg factuur', 'ÃÂ´ÃÂ¾ÃÂ±ÃÂ°ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ Ã‘ÂÃ‘â€¡ÃÂµÃ‘â€š', 'Ã¦Â·Â»Ã¥Å Â Ã¥Ââ€˜Ã§Â¥Â¨', 'faturayÃ„Â± eklemek', 'adicionar fatura', 'hozzÃƒÂ¡ szÃƒÂ¡mla', 'ajouter facture', 'Ãâ‚¬ÃÂÃŽÂ¿ÃÆ’ÃŽÂ¸ÃŽÂ­ÃÆ’Ãâ€žÃŽÂµ Ãâ€žÃŽÂ¹ÃŽÂ¼ÃŽÂ¿ÃŽÂ»ÃÅ’ÃŽÂ³ÃŽÂ¹ÃŽÂ¿', 'Rechnung hinzufÃƒÂ¼gen', 'aggiungere fattura', 'Ã Â¹â‚¬Ã Â¸Å¾Ã Â¸Â´Ã Â¹Ë†Ã Â¸Â¡Ã Â¹Æ’Ã Â¸Å¡Ã Â¹ÂÃ Â¸Ë†Ã Â¹â€°Ã Â¸â€¡Ã Â¸Â«Ã Â¸â„¢Ã Â¸ÂµÃ Â¹â€°', 'Ã˜Â§Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¦Ã˜Â³ Ã™â€¦Ã›Å’ÃšÂº Ã˜Â´Ã˜Â§Ã™â€¦Ã™â€ž', 'Ã Â¤Å¡Ã Â¤Â¾Ã Â¤Â²Ã Â¤Â¾Ã Â¤Â¨ Ã Â¤Å“Ã Â¥â€¹Ã Â¤Â¡Ã Â¤Â¼', 'add cautionem', 'menambahkan faktur', 'Ã¨Â«â€¹Ã¦Â±â€šÃ¦â€ºÂ¸Ã£â€šâ€™Ã¨Â¿Â½Ã¥Å Â ', 'Ã¬â€ Â¡Ã¬Å¾Â¥Ã¬Ââ€ž Ã¬Â¶â€ÃªÂ°â‚¬'),
(151, 'payment_to', 'payment to', '', 'pago a', 'دفع ل', 'betaling aan', 'ÃÂ¾ÃÂ¿ÃÂ»ÃÂ°Ã‘â€šÃÂ°', 'Ã¦â€Â¯Ã¤Â»Ëœ', 'iÃƒÂ§in ÃƒÂ¶deme', 'pagamento', 'fizetÃƒÂ©s', 'paiement', 'Ãâ‚¬ÃŽÂ»ÃŽÂ·ÃÂÃâ€°ÃŽÂ¼ÃŽÂ®', 'Zahlung an', 'pagamento', 'Ã Â¸Å Ã Â¸Â³Ã Â¸Â£Ã Â¸Â°Ã Â¹â‚¬Ã Â¸â€¡Ã Â¸Â´Ã Â¸â„¢Ã Â¹Æ’Ã Â¸Â«Ã Â¹â€°Ã Â¸ÂÃ Â¸Â±Ã Â¸Å¡', 'Ã˜Â§Ã˜Â¯Ã˜Â§Ã˜Â¦Ã›Å’ÃšÂ¯Ã›Å’', 'Ã Â¤â€¢Ã Â¥â€¹ Ã Â¤Â­Ã Â¥ÂÃ Â¤â€”Ã Â¤Â¤Ã Â¤Â¾Ã Â¤Â¨', 'pecunia', 'pembayaran kepada', 'Ã£ÂÂ¸Ã£ÂÂ®Ã¦â€Â¯Ã¦â€°â€¢Ã£Ââ€ž', 'Ã¬â€”Â Ã¬Â§â‚¬Ã«Â¶Ë†'),
(152, 'bill_to', 'bill to', '', 'proyecto de ley para', 'فاتورة الى', 'wetsvoorstel om', 'Ãâ€”ÃÂ°ÃÂºÃÂ¾ÃÂ½ÃÂ¾ÃÂ¿Ã‘â‚¬ÃÂ¾ÃÂµÃÂºÃ‘â€š ÃÂ¾', 'Ã¦Â³â€¢Ã¦Â¡Ë†', 'bill', 'projeto de lei para', 'tÃƒÂ¶rvÃƒÂ©nyjavaslat', 'projet de loi', 'ÃŽÂ½ÃŽÂ¿ÃŽÂ¼ÃŽÂ¿ÃÆ’Ãâ€¡ÃŽÂ­ÃŽÂ´ÃŽÂ¹ÃŽÂ¿ ÃŽÂ³ÃŽÂ¹ÃŽÂ± Ãâ€žÃŽÂ·ÃŽÂ½', 'Gesetzentwurf zur', 'disegno di legge per', 'Ã Â¸Å¡Ã Â¸Â´Ã Â¸Â¥', 'Ã˜Â¨Ã™â€ž', 'Ã Â¤Â¬Ã Â¤Â¿Ã Â¤Â² Ã Â¤â€¢Ã Â¥â€¡ Ã Â¤Â²Ã Â¤Â¿Ã Â¤Â', 'latumque', 'RUU untuk', 'Ã¨Â«â€¹Ã¦Â±â€šÃ£Ââ„¢Ã£â€šâ€¹', 'Ã«Â²â€¢Ã¬â€¢Ë†'),
(153, 'invoice_title', 'invoice title', '', 'TÃƒÂ­tulo de la factura', 'عنوان الفاتورة', 'factuur titel', 'ÃÂÃÂ°ÃÂ·ÃÂ²ÃÂ°ÃÂ½ÃÂ¸ÃÂµ Ã‘ÂÃ‘â€¡ÃÂµÃ‘â€šÃÂ°', 'Ã¥Ââ€˜Ã§Â¥Â¨Ã¦Å Â¬Ã¥Â¤Â´', 'fatura baÃ…Å¸lÃ„Â±k', 'tÃƒÂ­tulo fatura', 'szÃƒÂ¡mla cÃƒÂ­m', 'titre de la facture', 'ÃŽÂ¤ÃŽÂ¯Ãâ€žÃŽÂ»ÃŽÂ¿Ãâ€š Ãâ€žÃŽÂ¹ÃŽÂ¼ÃŽÂ¿ÃŽÂ»ÃÅ’ÃŽÂ³ÃŽÂ¹ÃŽÂ¿', 'Rechnungs Titel', 'title fattura', 'Ã Â¸Å Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¹Æ’Ã Â¸Å¡Ã Â¹ÂÃ Â¸Ë†Ã Â¹â€°Ã Â¸â€¡Ã Â¸Â«Ã Â¸â„¢Ã Â¸ÂµÃ Â¹â€°', 'Ã˜Â§Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¦Ã˜Â³ Ã˜Â¹Ã™â€ Ã™Ë†Ã˜Â§Ã™â€ ', 'Ã Â¤Å¡Ã Â¤Â¾Ã Â¤Â²Ã Â¤Â¾Ã Â¤Â¨ Ã Â¤Â¶Ã Â¥â‚¬Ã Â¤Â°Ã Â¥ÂÃ Â¤Â·Ã Â¤â€¢', 'title cautionem', 'judul faktur', 'Ã¨Â«â€¹Ã¦Â±â€šÃ¦â€ºÂ¸Ã£ÂÂ®Ã£â€šÂ¿Ã£â€šÂ¤Ã£Æ’Ë†Ã£Æ’Â«', 'Ã¬â€ Â¡Ã¬Å¾Â¥ Ã¬Â Å“Ã«ÂªÂ©'),
(154, 'invoice_id', 'invoice id', '', 'IdentificaciÃƒÂ³n de la factura', 'هوية صوتية', 'factuur id', 'Ã‘ÂÃ‘â€¡ÃÂµÃ‘â€š-Ã‘â€žÃÂ°ÃÂºÃ‘â€šÃ‘Æ’Ã‘â‚¬ÃÂ° ID', 'Ã¥Ââ€˜Ã§Â¥Â¨Ã§Â¼â€“Ã¥ÂÂ·', 'fatura id', 'id fatura', 'szÃƒÂ¡mla id', 'Identifiant facture', 'id Ãâ€žÃŽÂ¹ÃŽÂ¼ÃŽÂ¿ÃŽÂ»ÃÅ’ÃŽÂ³ÃŽÂ¹ÃŽÂ¿', 'Rechnung-ID', 'fattura id', 'Ã Â¹Æ’Ã Â¸Å¡Ã Â¹ÂÃ Â¸Ë†Ã Â¹â€°Ã Â¸â€¡Ã Â¸Â«Ã Â¸â„¢Ã Â¸ÂµÃ Â¹â€°Ã Â¸Â«Ã Â¸Â¡Ã Â¸Â²Ã Â¸Â¢Ã Â¹â‚¬Ã Â¸Â¥Ã Â¸â€š', 'Ã˜Â§Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¦Ã˜Â³ ID', 'Ã Â¤Å¡Ã Â¤Â¾Ã Â¤Â²Ã Â¤Â¾Ã Â¤Â¨ Ã Â¤â€ Ã Â¤Ë†Ã Â¤Â¡Ã Â¥â‚¬', 'id cautionem', 'faktur id', 'Ã¨Â«â€¹Ã¦Â±â€šÃ¦â€ºÂ¸ID', 'Ã¬â€ Â¡Ã¬Å¾Â¥ ID'),
(155, 'edit_invoice', 'edit invoice', '', 'edit factura', 'تحرير الفاتورة', 'bewerk factuur', 'Ã‘â‚¬ÃÂµÃÂ´ÃÂ°ÃÂºÃ‘â€šÃÂ¸Ã‘â‚¬ÃÂ¾ÃÂ²ÃÂ°ÃÂ½ÃÂ¸Ã‘Â Ã‘ÂÃ‘â€¡ÃÂµÃ‘â€šÃÂ°-Ã‘â€žÃÂ°ÃÂºÃ‘â€šÃ‘Æ’Ã‘â‚¬Ã‘â€¹', 'Ã§Â¼â€“Ã¨Â¾â€˜Ã¥Ââ€˜Ã§Â¥Â¨', 'edit fatura', 'ediÃƒÂ§ÃƒÂ£o fatura', 'szerkesztÃƒÂ©s szÃƒÂ¡mla', 'modifier la facture', 'edit Ãâ€žÃŽÂ¹ÃŽÂ¼ÃŽÂ¿ÃŽÂ»ÃÅ’ÃŽÂ³ÃŽÂ¹ÃŽÂ¿', 'edit Rechnung', 'modifica fattura', 'Ã Â¹ÂÃ Â¸ÂÃ Â¹â€°Ã Â¹â€žÃ Â¸â€šÃ Â¹Æ’Ã Â¸Å¡Ã Â¹ÂÃ Â¸Ë†Ã Â¹â€°Ã Â¸â€¡Ã Â¸Â«Ã Â¸â„¢Ã Â¸ÂµÃ Â¹â€°', 'Ã˜ÂªÃ˜Â±Ã™â€¦Ã›Å’Ã™â€¦ Ã˜Â§Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¦Ã˜Â³', 'Ã Â¤Â¸Ã Â¤â€šÃ Â¤ÂªÃ Â¤Â¾Ã Â¤Â¦Ã Â¤Â¿Ã Â¤Â¤ Ã Â¤Å¡Ã Â¤Â¾Ã Â¤Â²Ã Â¤Â¾Ã Â¤Â¨', 'edit cautionem', 'mengedit faktur', 'Ã§Â·Â¨Ã©â€ºâ€ Ã©â‚¬ÂÃ£â€šÅ Ã§Å Â¶', 'Ã­Å½Â¸Ã¬Â§â€˜ Ã¬â€ Â¡Ã¬Å¾Â¥'),
(156, 'manage_library_books', 'manage library books', '', 'gestionar libros de la biblioteca', 'فاتورة الى', 'beheren bibliotheekboeken', 'Ã‘Æ’ÃÂ¿Ã‘â‚¬ÃÂ°ÃÂ²ÃÂ»Ã‘ÂÃ‘â€šÃ‘Å’ ÃÂ±ÃÂ¸ÃÂ±ÃÂ»ÃÂ¸ÃÂ¾Ã‘â€šÃÂµÃ‘â€¡ÃÂ½Ã‘â€¹ÃÂµ ÃÂºÃÂ½ÃÂ¸ÃÂ³ÃÂ¸', 'Ã§Â®Â¡Ã§Ââ€ Ã¥â€ºÂ¾Ã¤Â¹Â¦', 'kitaplarÃ„Â± kÃƒÂ¼tÃƒÂ¼phane yÃƒÂ¶netmek', 'gerenciar os livros da biblioteca', 'kezelni kÃƒÂ¶nyvtÃƒÂ¡ri kÃƒÂ¶nyvek', 'gÃƒÂ©rer des livres de bibliothÃƒÂ¨que', 'ÃŽÂ´ÃŽÂ¹ÃŽÂ±Ãâ€¡ÃŽÂµÃŽÂ¹ÃÂÃŽÂ¹ÃÆ’Ãâ€žÃŽÂµÃŽÂ¯Ãâ€žÃŽÂµ Ãâ€žÃŽÂ± ÃŽÂ²ÃŽÂ¹ÃŽÂ²ÃŽÂ»ÃŽÂ¯ÃŽÂ± Ãâ€žÃŽÂ·Ãâ€š ÃŽÂ²ÃŽÂ¹ÃŽÂ²ÃŽÂ»ÃŽÂ¹ÃŽÂ¿ÃŽÂ¸ÃŽÂ®ÃŽÂºÃŽÂ·Ãâ€š', 'BÃƒÂ¼cher aus der Bibliothek verwalten', 'gestire i libri della biblioteca', 'Ã Â¸Ë†Ã Â¸Â±Ã Â¸â€Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸Â«Ã Â¸â„¢Ã Â¸Â±Ã¢â‚¬â€¹Ã¢â‚¬â€¹Ã Â¸â€¡Ã Â¸ÂªÃ Â¸Â·Ã Â¸Â­Ã Â¸Â«Ã Â¹â€°Ã Â¸Â­Ã Â¸â€¡Ã Â¸ÂªÃ Â¸Â¡Ã Â¸Â¸Ã Â¸â€', 'ÃšÂ©Ã˜ÂªÃ˜Â¨ Ã˜Â®Ã˜Â§Ã™â€ Ã›â€™ ÃšÂ©Ã›Å’ ÃšÂ©Ã˜ÂªÃ˜Â§Ã˜Â¨Ã›Å’ÃšÂº Ã™â€¦Ã™â€ Ã˜Â¸Ã™â€¦', 'Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â¸Ã Â¥ÂÃ Â¤Â¤Ã Â¤â€¢Ã Â¤Â¾Ã Â¤Â²Ã Â¤Â¯ Ã Â¤â€¢Ã Â¥â‚¬ Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â¸Ã Â¥ÂÃ Â¤Â¤Ã Â¤â€¢Ã Â¥â€¹Ã Â¤â€š Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¤Â¬Ã Â¤â€šÃ Â¤Â§Ã Â¤Â¨', 'curo bibliotheca librorum,', 'mengelola buku perpustakaan', 'Ã¥â€ºÂ³Ã¦â€ºÂ¸Ã©Â¤Â¨Ã£ÂÂ®Ã¦Å“Â¬Ã£â€šâ€™Ã§Â®Â¡Ã§Ââ€ ', 'Ã«Ââ€žÃ¬â€žÅ“ÃªÂ´â‚¬ Ã¬Â±â€¦ ÃªÂ´â‚¬Ã«Â¦Â¬'),
(157, 'book_list', 'book list', '', 'lista de libros', 'قائمة الكتب', 'boekenlijst', 'ÃÂ¡ÃÂ¿ÃÂ¸Ã‘ÂÃÂ¾ÃÂº ÃÂºÃÂ½ÃÂ¸ÃÂ³', 'Ã¤Â¹Â¦Ã¥Ââ€¢', 'kitap listesi', 'lista de livros', 'book lista', 'liste de livres', 'ÃŽÂ»ÃŽÂ¯ÃÆ’Ãâ€žÃŽÂ± ÃŽÂ²ÃŽÂ¹ÃŽÂ²ÃŽÂ»ÃŽÂ¯Ãâ€°ÃŽÂ½', 'Buchliste', 'elenco libri', 'Ã Â¸Â£Ã Â¸Â²Ã Â¸Â¢Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸Â«Ã Â¸â„¢Ã Â¸Â±Ã¢â‚¬â€¹Ã¢â‚¬â€¹Ã Â¸â€¡Ã Â¸ÂªÃ Â¸Â·Ã Â¸Â­', 'ÃšÂ©Ã˜ÂªÃ˜Â§Ã˜Â¨ ÃšÂ©Ã›Å’ Ã™ÂÃ›ÂÃ˜Â±Ã˜Â³Ã˜Âª', 'Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â¸Ã Â¥ÂÃ Â¤Â¤Ã Â¤â€¢ Ã Â¤Â¸Ã Â¥â€šÃ Â¤Å¡Ã Â¥â‚¬', 'album', 'daftar buku', 'Ã£Æ’â€“Ã£Æ’Æ’Ã£â€šÂ¯Ã£Æ’ÂªÃ£â€šÂ¹Ã£Æ’Ë†', 'Ã«Ââ€žÃ¬â€žÅ“ Ã«ÂªÂ©Ã«Â¡Â'),
(158, 'add_book', 'add book', '', 'AÃƒÂ±adir libro', 'إضافة كتاب', 'boek toevoegen', 'ÃÂ´ÃÂ¾ÃÂ±ÃÂ°ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ ÃÂºÃÂ½ÃÂ¸ÃÂ³Ã‘Æ’', 'Ã¥Å Â Ã¥â€¦Â¥Ã¤Â¹Â¦', 'kitap eklemek', 'adicionar livro', 'KÃƒÂ¶nyv hozzÃƒÂ¡adÃƒÂ¡sa', 'ajouter livre', 'Ãâ‚¬ÃÂÃŽÂ¿ÃÆ’ÃŽÂ¸ÃŽÂ­ÃÆ’Ãâ€žÃŽÂµ Ãâ€žÃŽÂ¿ ÃŽÂ²ÃŽÂ¹ÃŽÂ²ÃŽÂ»ÃŽÂ¯ÃŽÂ¿', 'Buch hinzufÃƒÂ¼gen', 'aggiungere il libro', 'Ã Â¹â‚¬Ã Â¸Å¾Ã Â¸Â´Ã Â¹Ë†Ã Â¸Â¡Ã Â¸Â«Ã Â¸â„¢Ã Â¸Â±Ã Â¸â€¡Ã Â¸ÂªÃ Â¸Â·Ã Â¸Â­', 'ÃšÂ©Ã˜ÂªÃ˜Â§Ã˜Â¨ Ã˜Â´Ã˜Â§Ã™â€¦Ã™â€ž', 'Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â¸Ã Â¥ÂÃ Â¤Â¤Ã Â¤â€¢ Ã Â¤Å“Ã Â¥â€¹Ã Â¤Â¡Ã Â¤Â¼', 'adde libri', 'menambahkan buku', 'Ã¦Å“Â¬Ã£â€šâ€™Ã¨Â¿Â½Ã¥Å Â ', 'Ã¬Â±â€¦Ã¬Ââ€ž Ã¬Â¶â€ÃªÂ°â‚¬'),
(159, 'book_name', 'book name', '', 'Nombre del libro', 'اسم الكتاب', 'boeknaam', 'ÃÂÃÂ°ÃÂ·ÃÂ²ÃÂ°ÃÂ½ÃÂ¸ÃÂµ ÃÂºÃÂ½ÃÂ¸ÃÂ³ÃÂ¸', 'Ã¤Â¹Â¦Ã¥ÂÂ', 'kitap adÃ„Â±', 'nome livro', 'book nÃƒÂ©v', 'nom de livre', 'Ãâ€žÃŽÂ¿ ÃÅ’ÃŽÂ½ÃŽÂ¿ÃŽÂ¼ÃŽÂ± Ãâ€žÃŽÂ¿Ãâ€¦ ÃŽÂ²ÃŽÂ¹ÃŽÂ²ÃŽÂ»ÃŽÂ¯ÃŽÂ¿Ãâ€¦', 'Buchnamen', 'nome del libro', 'Ã Â¸Å Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸Â«Ã Â¸â„¢Ã Â¸Â±Ã Â¸â€¡Ã Â¸ÂªÃ Â¸Â·Ã Â¸Â­', 'ÃšÂ©Ã˜ÂªÃ˜Â§Ã˜Â¨ ÃšÂ©Ã˜Â§ Ã™â€ Ã˜Â§Ã™â€¦', 'Ã Â¤â€¢Ã Â¤Â¿Ã Â¤Â¤Ã Â¤Â¾Ã Â¤Â¬ Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤Â¨Ã Â¤Â¾Ã Â¤Â®', 'librum nomine', 'nama buku', 'Ã£Æ’â€“Ã£Æ’Æ’Ã£â€šÂ¯Ã¥ÂÂ', 'Ã¬Â±â€¦ Ã¬ÂÂ´Ã«Â¦â€ž'),
(160, 'author', 'author', '', 'autor', 'مؤلف', 'auteur', 'ÃÂ°ÃÂ²Ã‘â€šÃÂ¾Ã‘â‚¬', 'Ã¤Â½Å“Ã¨â‚¬â€¦', 'yazar', 'autor', 'szerzÃ…â€˜', 'auteur', 'ÃÆ’Ãâ€¦ÃŽÂ³ÃŽÂ³ÃÂÃŽÂ±Ãâ€ ÃŽÂ­ÃŽÂ±Ãâ€š', 'Autor', 'autore', 'Ã Â¸Å“Ã Â¸Â¹Ã Â¹â€°Ã Â¹â‚¬Ã Â¸â€šÃ Â¸ÂµÃ Â¸Â¢Ã Â¸â„¢', 'Ã™â€¦Ã˜ÂµÃ™â€ Ã™Â', 'Ã Â¤Â²Ã Â¥â€¡Ã Â¤â€“Ã Â¤â€¢', 'auctor', 'penulis', 'Ã¨â€˜â€”Ã¨â‚¬â€¦', 'Ã¬Â â‚¬Ã¬Å¾Â'),
(161, 'price', 'price', '', 'precio', 'السعر', 'prijs', 'Ã‘â€ ÃÂµÃÂ½ÃÂ°', 'Ã¤Â»Â·Ã¦Â Â¼', 'fiyat', 'preÃƒÂ§o', 'ÃƒÂ¡r', 'prix', 'Ãâ€žÃŽÂ¹ÃŽÂ¼ÃŽÂ®', 'Preis', 'prezzo', 'Ã Â¸Â£Ã Â¸Â²Ã Â¸â€žÃ Â¸Â²', 'Ã™â€šÃ›Å’Ã™â€¦Ã˜Âª', 'Ã Â¤â€¢Ã Â¥â‚¬Ã Â¤Â®Ã Â¤Â¤', 'price', 'harga', 'Ã¤Â¾Â¡Ã¦Â Â¼', 'ÃªÂ°â‚¬ÃªÂ²Â©'),
(162, 'available', 'available', '', 'disponible', 'متاح', 'beschikbaar', 'ÃÂ´ÃÂ¾Ã‘ÂÃ‘â€šÃ‘Æ’ÃÂ¿ÃÂ½Ã‘â€¹ÃÂ¹', 'Ã¥ÂÂ¯Ã§â€Â¨Ã§Å¡â€ž', 'mevcut', 'disponÃƒÂ­vel', 'rendelkezÃƒÂ©sre ÃƒÂ¡llÃƒÂ³', 'disponible', 'ÃŽÂ´ÃŽÂ¹ÃŽÂ±ÃŽÂ¸ÃŽÂ­ÃÆ’ÃŽÂ¹ÃŽÂ¼ÃŽÂ¿Ãâ€š', 'verfÃƒÂ¼gbar', 'disponibile', 'Ã Â¸ÂªÃ Â¸Â²Ã Â¸Â¡Ã Â¸Â²Ã Â¸Â£Ã Â¸â€“Ã Â¹Æ’Ã Â¸Å Ã Â¹â€°Ã Â¹â€žÃ Â¸â€Ã Â¹â€°', 'Ã˜Â¯Ã˜Â³Ã˜ÂªÃ›Å’Ã˜Â§Ã˜Â¨', 'Ã Â¤â€°Ã Â¤ÂªÃ Â¤Â²Ã Â¤Â¬Ã Â¥ÂÃ Â¤Â§', 'available', 'tersedia', 'Ã¥Ë†Â©Ã§â€Â¨Ã£ÂÂ§Ã£ÂÂÃ£â€šâ€¹', 'Ã¬Å“Â Ã­Å¡Â¨Ã­â€¢Å“'),
(163, 'unavailable', 'unavailable', '', 'indisponible', 'غير متوفره', 'niet beschikbaar', 'ÃÂ½ÃÂµÃÂ´ÃÂ¾Ã‘ÂÃ‘â€šÃ‘Æ’ÃÂ¿ÃÂµÃÂ½', 'Ã¤Â¸ÂÃ¥ÂÂ¯Ã§â€Â¨', 'yok', 'indisponÃƒÂ­vel', 'ÃƒÂ©rhetÃ…â€˜ el', 'indisponible', 'ÃŽÂ´ÃŽÂ¹ÃŽÂ±ÃŽÂ¸ÃŽÂ­ÃÆ’ÃŽÂ¹ÃŽÂ¼ÃŽÂ¿', 'nicht verfÃƒÂ¼gbar', 'non disponibile', 'Ã Â¹â€žÃ Â¸Â¡Ã Â¹Ë†Ã Â¸Â¡Ã Â¸Âµ', 'Ã˜Â¯Ã˜Â³Ã˜ÂªÃ›Å’Ã˜Â§Ã˜Â¨ Ã™â€ Ã›ÂÃ›Å’ÃšÂº', 'Ã Â¤â€¦Ã Â¤Â¨Ã Â¥ÂÃ Â¤ÂªÃ Â¤Â²Ã Â¤Â¬Ã Â¥ÂÃ Â¤Â§', 'unavailable', 'tidak tersedia', 'Ã¥Ë†Â©Ã§â€Â¨Ã£ÂÂ§Ã£ÂÂÃ£ÂÂªÃ£Ââ€ž', 'Ã¬â€”â€ Ã«Å â€'),
(164, 'edit_book', 'edit book', '', 'libro de ediciÃƒÂ³n', 'تحرير الكتاب', 'bewerk boek', 'ÃÂ¿Ã‘â‚¬ÃÂ°ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ ÃÂºÃÂ½ÃÂ¸ÃÂ³ÃÂ°', 'Ã§Â¼â€“Ã¨Â¾â€˜Ã¦Å“Â¬Ã¤Â¹Â¦', 'edit kitap', 'ediÃƒÂ§ÃƒÂ£o do livro', 'edit kÃƒÂ¶nyv', 'edit livre', 'ÃŽÂµÃâ‚¬ÃŽÂµÃŽÂ¾ÃŽÂµÃÂÃŽÂ³ÃŽÂ±ÃÆ’Ãâ€žÃŽÂµÃŽÂ¯Ãâ€žÃŽÂµ Ãâ€žÃŽÂ¿ ÃŽÂ²ÃŽÂ¹ÃŽÂ²ÃŽÂ»ÃŽÂ¯ÃŽÂ¿', 'edit Buch', 'modifica book', 'Ã Â¹ÂÃ Â¸ÂÃ Â¹â€°Ã Â¹â€žÃ Â¸â€šÃ Â¸Â«Ã Â¸â„¢Ã Â¸Â±Ã Â¸â€¡Ã Â¸ÂªÃ Â¸Â·Ã Â¸Â­', 'Ã˜ÂªÃ˜Â±Ã™â€¦Ã›Å’Ã™â€¦ ÃšÂ©Ã˜ÂªÃ˜Â§Ã˜Â¨', 'Ã Â¤Â¸Ã Â¤â€šÃ Â¤ÂªÃ Â¤Â¾Ã Â¤Â¦Ã Â¤Â¿Ã Â¤Â¤ Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â¸Ã Â¥ÂÃ Â¤Â¤Ã Â¤â€¢', 'edit Liber', 'mengedit buku', 'Ã§Â·Â¨Ã©â€ºâ€ Ã£ÂÂ®Ã¦Å“Â¬', 'Ã­Å½Â¸Ã¬Â§â€˜ Ã¬Â±â€¦'),
(165, 'manage_transport', 'manage transport', '', 'gestionar el transporte', 'السعر', 'beheren van vervoerssystemen', 'Ã‘Æ’ÃÂ¿Ã‘â‚¬ÃÂ°ÃÂ²ÃÂ»Ã‘ÂÃ‘â€šÃ‘Å’ Ã‘â€šÃ‘â‚¬ÃÂ°ÃÂ½Ã‘ÂÃÂ¿ÃÂ¾Ã‘â‚¬Ã‘â€šÃÂ¾ÃÂ¼', 'Ã¨Â¿ÂÃ¨Â¾â€œÃ§Â®Â¡Ã§Ââ€ ', 'ulaÃ…Å¸Ã„Â±m yÃƒÂ¶netmek', 'gerenciar o transporte', 'kezelni a kÃƒÂ¶zlekedÃƒÂ©s', 'la gestion du transport', 'ÃŽÂ´ÃŽÂ¹ÃŽÂ±Ãâ€¡ÃŽÂµÃŽÂ¯ÃÂÃŽÂ¹ÃÆ’ÃŽÂ· Ãâ€žÃâ€°ÃŽÂ½ ÃŽÂ¼ÃŽÂµÃâ€žÃŽÂ±Ãâ€ ÃŽÂ¿ÃÂÃÅ½ÃŽÂ½', 'Transport verwalten', 'gestire i trasporti', 'Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸Ë†Ã Â¸Â±Ã Â¸â€Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸â€šÃ Â¸â„¢Ã Â¸ÂªÃ Â¹Ë†Ã Â¸â€¡', 'Ã™â€ Ã™â€šÃ™â€ž Ã™Ë† Ã˜Â­Ã™â€¦Ã™â€ž ÃšÂ©Ã›â€™ Ã˜Â§Ã™â€ Ã˜ÂªÃ˜Â¸Ã˜Â§Ã™â€¦', 'Ã Â¤ÂªÃ Â¤Â°Ã Â¤Â¿Ã Â¤ÂµÃ Â¤Â¹Ã Â¤Â¨ Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¤Â¬Ã Â¤â€šÃ Â¤Â§Ã Â¤Â¨', 'curo onerariis', 'mengelola transportasi', 'Ã¨Â¼Â¸Ã©â‚¬ÂÃ£â€šâ€™Ã§Â®Â¡Ã§Ââ€ ', 'ÃªÂµÂÃ­â€ Âµ ÃªÂ´â‚¬Ã«Â¦Â¬'),
(166, 'transport_list', 'transport list', '', 'Lista de transportes', 'قائمة النقل', 'lijst vervoer', 'ÃÂ»ÃÂ¸Ã‘ÂÃ‘â€š Ã‘â€šÃ‘â‚¬ÃÂ°ÃÂ½Ã‘ÂÃÂ¿ÃÂ¾Ã‘â‚¬Ã‘â€š', 'Ã¨Â¿ÂÃ¨Â¾â€œÃ¥ÂÂÃ¥Ââ€¢', 'taÃ…Å¸Ã„Â±ma listesi', 'Lista de transportes', 'szÃƒÂ¡llÃƒÂ­tÃƒÂ¡s lista', 'liste de transport', 'ÃŽâ€ºÃŽÂ¯ÃÆ’Ãâ€žÃŽÂ± Ãâ€žÃâ€°ÃŽÂ½ ÃŽÂ¼ÃŽÂµÃâ€žÃŽÂ±Ãâ€ ÃŽÂ¿ÃÂÃÅ½ÃŽÂ½', 'Transportliste', 'elenco trasporti', 'Ã Â¸Â£Ã Â¸Â²Ã Â¸Â¢Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸â€šÃ Â¸â„¢Ã Â¸ÂªÃ Â¹Ë†Ã Â¸â€¡', 'Ã™â€ Ã™â€šÃ™â€ž Ã™Ë† Ã˜Â­Ã™â€¦Ã™â€ž ÃšÂ©Ã›Å’ Ã™ÂÃ›ÂÃ˜Â±Ã˜Â³Ã˜Âª', 'Ã Â¤ÂªÃ Â¤Â°Ã Â¤Â¿Ã Â¤ÂµÃ Â¤Â¹Ã Â¤Â¨ Ã Â¤Â¸Ã Â¥â€šÃ Â¤Å¡Ã Â¥â‚¬', 'turpis album', 'daftar transport', 'Ã¨Â¼Â¸Ã©â‚¬ÂÃ¤Â¸â‚¬Ã¨Â¦Â§', 'Ã¬Â â€žÃ¬â€ Â¡ Ã«ÂªÂ©Ã«Â¡Â'),
(167, 'add_transport', 'add transport', '', 'aÃƒÂ±adir el transporte', 'إضافة النقل', 'voeg vervoer', 'ÃÂ´ÃÂ¾ÃÂ±ÃÂ°ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ Ã‘â€šÃ‘â‚¬ÃÂ°ÃÂ½Ã‘ÂÃÂ¿ÃÂ¾Ã‘â‚¬Ã‘â€š', 'Ã¥Å Â Ã¤Â¸Å Ã¨Â¿ÂÃ¨Â¾â€œ', 'taÃ…Å¸Ã„Â±ma ekle', 'adicionar transporte', 'hozzÃƒÂ¡ a kÃƒÂ¶zlekedÃƒÂ©s', 'ajouter transports', 'Ãâ‚¬ÃÂÃŽÂ¿ÃÆ’ÃŽÂ¸ÃŽÂ­ÃÆ’Ãâ€žÃŽÂµ ÃŽÂ¼ÃŽÂµÃâ€žÃŽÂ±Ãâ€ ÃŽÂ¿ÃÂÃÅ½ÃŽÂ½', 'add-Transport', 'aggiungere il trasporto', 'Ã Â¹â‚¬Ã Â¸Å¾Ã Â¸Â´Ã Â¹Ë†Ã Â¸Â¡Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸â€šÃ Â¸â„¢Ã Â¸ÂªÃ Â¹Ë†Ã Â¸â€¡', 'Ã™â€ Ã™â€šÃ™â€ž Ã™Ë† Ã˜Â­Ã™â€¦Ã™â€ž Ã˜Â´Ã˜Â§Ã™â€¦Ã™â€ž', 'Ã Â¤ÂªÃ Â¤Â°Ã Â¤Â¿Ã Â¤ÂµÃ Â¤Â¹Ã Â¤Â¨ Ã Â¤Å“Ã Â¥â€¹Ã Â¤Â¡Ã Â¤Â¼', 'adde onerariis', 'tambahkan transportasi', 'Ã£Æ’Ë†Ã£Æ’Â©Ã£Æ’Â³Ã£â€šÂ¹Ã£Æ’ÂÃ£Æ’Â¼Ã£Æ’Ë†Ã£â€šâ€™Ã¨Â¿Â½Ã¥Å Â ', 'Ã¬Â â€žÃ¬â€ Â¡Ã¬Ââ€ž Ã¬Â¶â€ÃªÂ°â‚¬'),
(168, 'route_name', 'route name', '', 'nombre de la ruta', 'اسم المسار', 'naam van de route', 'ÃËœÃÂ¼Ã‘Â ÃÂ¼ÃÂ°Ã‘â‚¬Ã‘Ë†Ã‘â‚¬Ã‘Æ’Ã‘â€š', 'Ã¨Â·Â¯Ã§â€Â±Ã¥ÂÂÃ§Â§Â°', 'rota ismi', 'nome da rota', 'ÃƒÂºtvonal nevÃƒÂ©t', 'nom de la route', 'ÃŽÅ’ÃŽÂ½ÃŽÂ¿ÃŽÂ¼ÃŽÂ± ÃŽÂ´ÃŽÂ¹ÃŽÂ±ÃŽÂ´ÃÂÃŽÂ¿ÃŽÂ¼ÃŽÂ®Ãâ€š', 'Routennamen', 'nome del percorso', 'Ã Â¸Å Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¹â‚¬Ã Â¸ÂªÃ Â¹â€°Ã Â¸â„¢Ã Â¸â€”Ã Â¸Â²Ã Â¸â€¡', 'Ã˜Â±Ã˜Â§Ã˜Â³Ã˜ÂªÃ›â€™ Ã™â€ Ã˜Â§Ã™â€¦', 'Ã Â¤Â®Ã Â¤Â¾Ã Â¤Â°Ã Â¥ÂÃ Â¤â€” Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤Â¨Ã Â¤Â¾Ã Â¤Â®', 'iter nomine', 'Nama rute', 'Ã£Æ’Â«Ã£Æ’Â¼Ã£Æ’Ë†Ã£ÂÂ®Ã¥ÂÂÃ¥â€°Â', 'ÃªÂ²Â½Ã«Â¡Å“ Ã¬ÂÂ´Ã«Â¦â€ž'),
(169, 'number_of_vehicle', 'number of vehicle', '', 'nÃƒÂºmero de vehÃƒÂ­culo', 'عدد المركبات', 'aantal voertuigkilometers', 'ÃÂºÃÂ¾ÃÂ»ÃÂ¸Ã‘â€¡ÃÂµÃ‘ÂÃ‘â€šÃÂ²ÃÂ¾ ÃÂ°ÃÂ²Ã‘â€šÃÂ¾ÃÂ¼ÃÂ¾ÃÂ±ÃÂ¸ÃÂ»Ã‘Â', 'Ã¨Â½Â¦Ã¨Â¾â€ Ã§Å¡â€žÃ¦â€¢Â°Ã©â€¡Â', 'AracÃ„Â±n sayÃ„Â±sÃ„Â±', 'nÃƒÂºmero de veÃƒÂ­culo', 'szÃƒÂ¡mÃƒÂº gÃƒÂ©pjÃƒÂ¡rmÃ…Â±', 'nombre de vÃƒÂ©hicules', 'ÃŽÂ±ÃÂÃŽÂ¹ÃŽÂ¸ÃŽÂ¼ÃÅ’Ãâ€š Ãâ€žÃâ€°ÃŽÂ½ ÃŽÂ¿Ãâ€¡ÃŽÂ·ÃŽÂ¼ÃŽÂ¬Ãâ€žÃâ€°ÃŽÂ½', 'Anzahl der Fahrzeug', 'numero di veicolo', 'Ã Â¸Ë†Ã Â¸Â³Ã Â¸â„¢Ã Â¸Â§Ã Â¸â„¢Ã Â¸â€šÃ Â¸Â­Ã Â¸â€¡Ã Â¸Â¢Ã Â¸Â²Ã Â¸â„¢Ã Â¸Å¾Ã Â¸Â²Ã Â¸Â«Ã Â¸â„¢Ã Â¸Â°', 'ÃšÂ¯Ã˜Â§Ãšâ€˜Ã›Å’ ÃšÂ©Ã›Å’ Ã˜ÂªÃ˜Â¹Ã˜Â¯Ã˜Â§Ã˜Â¯', 'Ã Â¤ÂµÃ Â¤Â¾Ã Â¤Â¹Ã Â¤Â¨ Ã Â¤â€¢Ã Â¥â‚¬ Ã Â¤Â¸Ã Â¤â€šÃ Â¤â€“Ã Â¥ÂÃ Â¤Â¯Ã Â¤Â¾', 'de numero scilicet vehiculum', 'jumlah kendaraan', 'Ã¨Â»Å Ã¤Â¸Â¡Ã£ÂÂ®Ã¦â€¢Â°', 'Ã¬Â°Â¨Ã«Å¸â€°Ã¬ÂËœ Ã¬Ë†Ëœ'),
(170, 'route_fare', 'route fare', '', 'ruta hacer', 'الطريق الأجرة', 'route doen', 'ÃÂ¼ÃÂ°Ã‘â‚¬Ã‘Ë†Ã‘â‚¬Ã‘Æ’Ã‘â€š ÃÂ´ÃÂµÃÂ»ÃÂ°Ã‘â€šÃ‘Å’', 'Ã¨Â·Â¯Ã§ÂºÂ¿Ã¥ÂÅ¡', 'yol yapmak', 'rota fazer', 'ÃƒÂºtvonal do', 'itinÃƒÂ©raire faire', 'ÃŽÂ´ÃŽÂ¹ÃŽÂ±ÃŽÂ´ÃÂÃŽÂ¿ÃŽÂ¼ÃŽÂ® ÃŽÂºÃŽÂ¬ÃŽÂ½ÃŽÂµÃŽÂ¹', 'Route zu tun', 'r', 'Ã Â¹â‚¬Ã Â¸ÂªÃ Â¹â€°Ã Â¸â„¢Ã Â¸â€”Ã Â¸Â²Ã Â¸â€¡Ã Â¸â€”Ã Â¸Â³', 'Ã˜Â±Ã˜Â§Ã˜Â³Ã˜ÂªÃ›â€™ ÃšÂ©Ã˜Â±Ã˜ÂªÃ›â€™', 'Ã Â¤Â®Ã Â¤Â¾Ã Â¤Â°Ã Â¥ÂÃ Â¤â€” Ã Â¤â€¢Ã Â¤Â°Ã Â¤Â¨Ã Â¤Â¾', 'iter faciunt,', 'rute lakukan', 'Ã£Æ’Â«Ã£Æ’Â¼Ã£Æ’Ë†Ã£Ââ€¹', 'ÃªÂ²Â½Ã«Â¡Å“Ã«Å â€ Ã­â€¢Â ');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `bengali`, `spanish`, `arabic`, `dutch`, `russian`, `chinese`, `turkish`, `portuguese`, `hungarian`, `french`, `greek`, `german`, `italian`, `thai`, `urdu`, `hindi`, `latin`, `indonesian`, `japanese`, `korean`) VALUES
(171, 'edit_transport', 'edit transport', '', 'transporte de ediciÃƒÂ³n', 'تحرير النقل', 'vervoer bewerken', 'ÃÂ¿Ã‘â‚¬ÃÂ°ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ Ã‘â€šÃ‘â‚¬ÃÂ°ÃÂ½Ã‘ÂÃÂ¿ÃÂ¾Ã‘â‚¬Ã‘â€š', 'Ã§Â¼â€“Ã¨Â¾â€˜Ã¨Â¿ÂÃ¨Â¾â€œ', 'edit ulaÃ…Å¸Ã„Â±m', 'ediÃƒÂ§ÃƒÂ£o transporte', 'szerkesztÃƒÂ©s szÃƒÂ¡llÃƒÂ­tÃƒÂ¡s', 'transport modifier', 'edit ÃŽÂ¼ÃŽÂµÃâ€žÃŽÂ±Ãâ€ ÃŽÂ¿ÃÂÃÅ½ÃŽÂ½', 'edit Transport', 'modifica dei trasporti', 'Ã Â¹ÂÃ Â¸ÂÃ Â¹â€°Ã Â¹â€žÃ Â¸â€šÃ Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸â€šÃ Â¸â„¢Ã Â¸ÂªÃ Â¹Ë†Ã Â¸â€¡', 'Ã˜ÂªÃ˜Â±Ã™â€¦Ã›Å’Ã™â€¦ Ã™â€ Ã™â€šÃ™â€ž Ã™Ë† Ã˜Â­Ã™â€¦Ã™â€ž', 'Ã Â¤Â¸Ã Â¤â€šÃ Â¤ÂªÃ Â¤Â¾Ã Â¤Â¦Ã Â¤Â¿Ã Â¤Â¤ Ã Â¤ÂªÃ Â¤Â°Ã Â¤Â¿Ã Â¤ÂµÃ Â¤Â¹Ã Â¤Â¨', 'edit onerariis', 'mengedit transportasi', 'Ã§Â·Â¨Ã©â€ºâ€ Ã¨Â¼Â¸Ã©â‚¬Â', 'Ã­Å½Â¸Ã¬Â§â€˜ Ã¬Â â€žÃ¬â€ Â¡'),
(172, 'manage_dormitory', 'manage dormitory', '', 'gestionar dormitorio', 'إدارة المهجع', 'beheren slaapzaal', 'Ã‘Æ’ÃÂ¿Ã‘â‚¬ÃÂ°ÃÂ²ÃÂ»Ã‘ÂÃ‘â€šÃ‘Å’ ÃÂ¾ÃÂ±Ã‘â€°ÃÂµÃÂ¶ÃÂ¸Ã‘â€šÃÂ¸ÃÂµ', 'Ã¥Â®Â¿Ã¨Ë†ÂÃ§Â®Â¡Ã§Ââ€ ', 'yurt yÃƒÂ¶netmek', 'gerenciar dormitÃƒÂ³rio', 'kezelni kollÃƒÂ©giumi', 'gÃƒÂ©rer dortoir', 'ÃŽÂ´ÃŽÂ¹ÃŽÂ±Ãâ€¡ÃŽÂµÃŽÂ¯ÃÂÃŽÂ¹ÃÆ’ÃŽÂ· ÃŽÂºÃŽÂ¿ÃŽÂ¹Ãâ€žÃÅ½ÃŽÂ½ÃŽÂ±', 'Schlafsaal verwalten', 'gestione dormitorio', 'Ã Â¸Ë†Ã Â¸Â±Ã Â¸â€Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸Â«Ã Â¸Â­Ã Â¸Å¾Ã Â¸Â±Ã Â¸Â', 'Ã˜Â´Ã›Å’Ã™â€ Ã˜Â§ÃšÂ¯Ã˜Â§Ã˜Â± ÃšÂ©Ã˜Â§ Ã˜Â§Ã™â€ Ã˜ÂªÃ˜Â¸Ã˜Â§Ã™â€¦', 'Ã Â¤â€ºÃ Â¤Â¾Ã Â¤Â¤Ã Â¥ÂÃ Â¤Â°Ã Â¤Â¾Ã Â¤ÂµÃ Â¤Â¾Ã Â¤Â¸ Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¤Â¬Ã Â¤â€šÃ Â¤Â§Ã Â¤Â¨', 'curo dormitorio', 'mengelola asrama', 'Ã¥Â¯Â®Ã£â€šâ€™Ã§Â®Â¡Ã§Ââ€ ', 'ÃªÂ¸Â°Ã¬Ë†â„¢Ã¬â€šÂ¬Ã«Â¥Â¼ ÃªÂ´â‚¬Ã«Â¦Â¬'),
(173, 'dormitory_list', 'dormitory list', '', 'lista dormitorio', 'قائمة المهجع', 'slaapzaal lijst', 'ÃÂ¡ÃÂ¿ÃÂ¸Ã‘ÂÃÂ¾ÃÂº ÃÂ¾ÃÂ±Ã‘â€°ÃÂµÃÂ¶ÃÂ¸Ã‘â€šÃÂ¸ÃÂµ', 'Ã¥Â®Â¿Ã¨Ë†ÂÃ¥ÂÂÃ¥Ââ€¢', 'yurt listesi', 'lista dormitÃƒÂ³rio', 'kollÃƒÂ©giumi lista', 'liste de dortoir', 'ÃŽâ€ºÃŽÂ¯ÃÆ’Ãâ€žÃŽÂ± ÃŽÂºÃŽÂ¿ÃŽÂ¹Ãâ€žÃÅ½ÃŽÂ½ÃŽÂ±', 'Schlafsaal Liste', 'elenco dormitorio', 'Ã Â¸Â£Ã Â¸Â²Ã Â¸Â¢Ã Â¸Å Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸Â«Ã Â¸Â­Ã Â¸Å¾Ã Â¸Â±Ã Â¸Â', 'Ã˜Â´Ã›Å’Ã™â€ Ã˜Â§ÃšÂ¯Ã˜Â§Ã˜Â± Ã™ÂÃ›ÂÃ˜Â±Ã˜Â³Ã˜Âª', 'Ã Â¤â€ºÃ Â¤Â¾Ã Â¤Â¤Ã Â¥ÂÃ Â¤Â°Ã Â¤Â¾Ã Â¤ÂµÃ Â¤Â¾Ã Â¤Â¸ Ã Â¤Â¸Ã Â¥â€šÃ Â¤Å¡Ã Â¥â‚¬', 'dormitorium album', 'daftar asrama', 'Ã¥Â¯Â®Ã£ÂÂ®Ã£Æ’ÂªÃ£â€šÂ¹Ã£Æ’Ë†', 'ÃªÂ¸Â°Ã¬Ë†â„¢Ã¬â€šÂ¬ Ã«ÂªÂ©Ã«Â¡Â'),
(174, 'add_dormitory', 'add dormitory', '', 'aÃƒÂ±adir dormitorio', 'إضافة عنبر', 'voeg slaapzaal', 'ÃÂ´ÃÂ¾ÃÂ±ÃÂ°ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ ÃÂ¾ÃÂ±Ã‘â€°ÃÂµÃÂ¶ÃÂ¸Ã‘â€šÃÂ¸ÃÂµ', 'Ã¦Â·Â»Ã¥Å Â Ã¥Â®Â¿Ã¨Ë†Â', 'yurt ekle', 'adicionar dormitÃƒÂ³rio', 'hozzÃƒÂ¡ kollÃƒÂ©giumi', 'ajouter dortoir', 'Ãâ‚¬ÃÂÃŽÂ¿ÃÆ’ÃŽÂ¸ÃŽÂ®ÃŽÂºÃŽÂ· ÃŽÂºÃŽÂ¿ÃŽÂ¹Ãâ€žÃÅ½ÃŽÂ½ÃŽÂ±', 'Schlaf hinzufÃƒÂ¼gen', 'aggiungere dormitorio', 'Ã Â¹â‚¬Ã Â¸Å¾Ã Â¸Â´Ã Â¹Ë†Ã Â¸Â¡Ã Â¸Â«Ã Â¸Â­Ã Â¸Å¾Ã Â¸Â±Ã Â¸Â', 'Ã˜Â´Ã›Å’Ã™â€ Ã˜Â§ÃšÂ¯Ã˜Â§Ã˜Â± Ã˜Â´Ã˜Â§Ã™â€¦Ã™â€ž', 'Ã Â¤â€ºÃ Â¤Â¾Ã Â¤Â¤Ã Â¥ÂÃ Â¤Â°Ã Â¤Â¾Ã Â¤ÂµÃ Â¤Â¾Ã Â¤Â¸ Ã Â¤Å“Ã Â¥â€¹Ã Â¤Â¡Ã Â¤Â¼', 'adde dormitorio', 'menambahkan asrama', 'Ã¥Â¯Â®Ã£â€šâ€™Ã¨Â¿Â½Ã¥Å Â ', 'ÃªÂ¸Â°Ã¬Ë†â„¢Ã¬â€šÂ¬Ã«Â¥Â¼ Ã¬Â¶â€ÃªÂ°â‚¬'),
(175, 'dormitory_name', 'dormitory name', '', 'Nombre del dormitorio', 'اسم المهجع', 'slaapzaal naam', 'ÃËœÃÂ¼Ã‘Â ÃÂ¾ÃÂ±Ã‘â€°ÃÂµÃÂ¶ÃÂ¸Ã‘â€šÃÂ¸ÃÂµ', 'Ã¥Â®Â¿Ã¨Ë†ÂÃ¥ÂÂ', 'yurt adÃ„Â±', 'nome dormitÃƒÂ³rio', 'kollÃƒÂ©giumi nÃƒÂ©v', 'nom de dortoir', 'ÃŽÅ’ÃŽÂ½ÃŽÂ¿ÃŽÂ¼ÃŽÂ± ÃŽÂºÃŽÂ¿ÃŽÂ¹Ãâ€žÃÅ½ÃŽÂ½ÃŽÂ±', 'Schlaf Namen', 'Nome dormitorio', 'Ã Â¸Å Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸Â«Ã Â¸Â­Ã Â¸Å¾Ã Â¸Â±Ã Â¸Â', 'Ã˜Â´Ã›Å’Ã™â€ Ã˜Â§ÃšÂ¯Ã˜Â§Ã˜Â± Ã™â€ Ã˜Â§Ã™â€¦', 'Ã Â¤â€ºÃ Â¤Â¾Ã Â¤Â¤Ã Â¥ÂÃ Â¤Â°Ã Â¤Â¾Ã Â¤ÂµÃ Â¤Â¾Ã Â¤Â¸ Ã Â¤Â¨Ã Â¤Â¾Ã Â¤Â®', 'dormitorium nomine', 'Nama asrama', 'Ã¥Â¯Â®Ã¥ÂÂ', 'ÃªÂ¸Â°Ã¬Ë†â„¢Ã¬â€šÂ¬ Ã¬ÂÂ´Ã«Â¦â€ž'),
(176, 'number_of_room', 'number of room', '', 'nÃƒÂºmero de habitaciÃƒÂ³n', 'عدد الغرف', 'aantal kamer', 'Ã‘â€¡ÃÂ¸Ã‘ÂÃÂ»ÃÂ¾ ÃÂºÃÂ¾ÃÂ¼ÃÂ½ÃÂ°Ã‘â€šÃÂµ', 'Ã¦Ë†Â¿Ã©â€”Â´Ã¦â€¢Â°Ã©â€¡Â', 'oda sayÃ„Â±sÃ„Â±', 'nÃƒÂºmero de quarto', 'szÃƒÂ¡ma szobÃƒÂ¡ban', 'nombre de salle', 'Ãâ€žÃŽÂ¿ÃŽÂ½ ÃŽÂ±ÃÂÃŽÂ¹ÃŽÂ¸ÃŽÂ¼ÃÅ’ Ãâ€žÃâ€°ÃŽÂ½ ÃŽÂ´Ãâ€°ÃŽÂ¼ÃŽÂ±Ãâ€žÃŽÂ¯Ãâ€°ÃŽÂ½', 'Anzahl der Zimmer', 'numero delle camera', 'Ã Â¸Ë†Ã Â¸Â³Ã Â¸â„¢Ã Â¸Â§Ã Â¸â„¢Ã Â¸Â«Ã Â¹â€°Ã Â¸Â­Ã Â¸â€¡Ã Â¸Å¾Ã Â¸Â±Ã Â¸Â', 'ÃšÂ©Ã™â€¦Ã˜Â±Ã›â€™ ÃšÂ©Ã›Å’ Ã˜ÂªÃ˜Â¹Ã˜Â¯Ã˜Â§Ã˜Â¯', 'Ã Â¤â€¢Ã Â¤Â®Ã Â¤Â°Ã Â¥â€¡ Ã Â¤â€¢Ã Â¥â‚¬ Ã Â¤Â¸Ã Â¤â€šÃ Â¤â€“Ã Â¥ÂÃ Â¤Â¯Ã Â¤Â¾', 'numerus locus', 'Jumlah kamar', 'Ã£ÂÅ Ã©Æ’Â¨Ã¥Â±â€¹Ã¦â€¢Â°', 'ÃªÂ°ÂÃ¬â€¹Â¤ Ã¬Ë†Ëœ'),
(177, 'manage_noticeboard', 'manage noticeboard', '', 'gestionar tablÃƒÂ³n de anuncios', 'إدارة لوحة الإعلانات', 'beheren prikbord', 'Ã‘Æ’ÃÂ¿Ã‘â‚¬ÃÂ°ÃÂ²ÃÂ»Ã‘ÂÃ‘â€šÃ‘Å’ ÃÂ´ÃÂ¾Ã‘ÂÃÂºÃÂµ ÃÂ¾ÃÂ±Ã‘Å Ã‘ÂÃÂ²ÃÂ»ÃÂµÃÂ½ÃÂ¸ÃÂ¹', 'Ã§Â®Â¡Ã§Ââ€ Ã¥Â¸Æ’Ã¥â€˜Å ', 'Noticeboard yÃƒÂ¶netmek', 'gerenciar avisos', 'kezelni ÃƒÂ¼zenÃ…â€˜falÃƒÂ¡n', 'gÃƒÂ©rer panneau d''affichage', 'ÃŽÂ´ÃŽÂ¹ÃŽÂ±Ãâ€¡ÃŽÂµÃŽÂ¯ÃÂÃŽÂ¹ÃÆ’ÃŽÂ· ÃŽÂ±ÃŽÂ½ÃŽÂ±ÃŽÂºÃŽÂ¿ÃŽÂ¹ÃŽÂ½ÃÅ½ÃÆ’ÃŽÂµÃâ€°ÃŽÂ½', 'Brett verwalten', 'gestione bacheca', 'Ã Â¸Ë†Ã Â¸Â±Ã Â¸â€Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸â€ºÃ Â¹â€°Ã Â¸Â²Ã Â¸Â¢Ã Â¸â€ºÃ Â¸Â£Ã Â¸Â°Ã Â¸ÂÃ Â¸Â²Ã Â¸Â¨', 'noticeboard ÃšÂ©Ã˜Â§ Ã˜Â§Ã™â€ Ã˜ÂªÃ˜Â¸Ã˜Â§Ã™â€¦', 'Noticeboard Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¤Â¬Ã Â¤â€šÃ Â¤Â§Ã Â¤Â¨', 'curo noticeboard', 'mengelola pengumuman', 'Ã¤Â¼ÂÃ¨Â¨â‚¬Ã¦ÂÂ¿Ã£â€šâ€™Ã§Â®Â¡Ã§Ââ€ ', 'Ã¬ÂËœ noticeboard ÃªÂ´â‚¬Ã«Â¦Â¬'),
(178, 'noticeboard_list', 'noticeboard list', '', 'tablÃƒÂ³n de anuncios de la lista', 'قائمة لوحة الإعلانات', 'prikbord lijst', 'ÃÂ¡ÃÂ¿ÃÂ¸Ã‘ÂÃÂ¾ÃÂº ÃÂ´ÃÂ¾Ã‘ÂÃÂºÃÂ° ÃÂ´ÃÂ»Ã‘Â ÃÂ¾ÃÂ±Ã‘Å Ã‘ÂÃÂ²ÃÂ»ÃÂµÃÂ½ÃÂ¸ÃÂ¹', 'Ã¥Â¸Æ’Ã¥â€˜Å Ã¥ÂÂÃ¥Ââ€¢', 'noticeboard listesi', 'lista de avisos', 'ÃƒÂ¼zenÃ…â€˜falÃƒÂ¡n lista', 'liste de panneau d''affichage', 'ÃŽÂ»ÃŽÂ¯ÃÆ’Ãâ€žÃŽÂ± ÃŽÂ±ÃŽÂ½ÃŽÂ±ÃŽÂºÃŽÂ¿ÃŽÂ¹ÃŽÂ½ÃÅ½ÃÆ’ÃŽÂµÃâ€°ÃŽÂ½', 'Brett-Liste', 'elenco bacheca', 'Ã Â¸Â£Ã Â¸Â²Ã Â¸Â¢Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸â€ºÃ Â¹â€°Ã Â¸Â²Ã Â¸Â¢Ã Â¸â€ºÃ Â¸Â£Ã Â¸Â°Ã Â¸ÂÃ Â¸Â²Ã Â¸Â¨', 'noticeboard Ã™ÂÃ›ÂÃ˜Â±Ã˜Â³Ã˜Âª', 'Noticeboard Ã Â¤Â¸Ã Â¥â€šÃ Â¤Å¡Ã Â¥â‚¬', 'noticeboard album', 'daftar pengumuman', 'Ã¤Â¼ÂÃ¨Â¨â‚¬Ã¦ÂÂ¿Ã¤Â¸â‚¬Ã¨Â¦Â§', 'Ã¬ÂËœ noticeboard Ã«ÂªÂ©Ã«Â¡Â'),
(179, 'add_noticeboard', 'add noticeboard', '', 'aÃƒÂ±adir tablÃƒÂ³n de anuncios', 'إضافة لوحة الإعلانات', 'voeg prikbord', 'ÃÂ´ÃÂ¾ÃÂ±ÃÂ°ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ ÃÂ´ÃÂ¾Ã‘ÂÃÂºÃÂµ ÃÂ¾ÃÂ±Ã‘Å Ã‘ÂÃÂ²ÃÂ»ÃÂµÃÂ½ÃÂ¸ÃÂ¹', 'Ã¦Â·Â»Ã¥Å Â Ã¥Â¸Æ’Ã¥â€˜Å ', 'Noticeboard ekle', 'adicionar avisos', 'hozzÃƒÂ¡ ÃƒÂ¼zenÃ…â€˜falÃƒÂ¡n', 'ajouter panneau d''affichage', 'Ãâ‚¬ÃÂÃŽÂ¿ÃÆ’ÃŽÂ¸ÃŽÂ®ÃŽÂºÃŽÂ· ÃŽÂ±ÃŽÂ½ÃŽÂ±ÃŽÂºÃŽÂ¿ÃŽÂ¹ÃŽÂ½ÃÅ½ÃÆ’ÃŽÂµÃâ€°ÃŽÂ½', 'Brett hinzufÃƒÂ¼gen', 'aggiungere bacheca', 'Ã Â¹â‚¬Ã Â¸Å¾Ã Â¸Â´Ã Â¹Ë†Ã Â¸Â¡Ã Â¸â€ºÃ Â¹â€°Ã Â¸Â²Ã Â¸Â¢Ã Â¸â€ºÃ Â¸Â£Ã Â¸Â°Ã Â¸ÂÃ Â¸Â²Ã Â¸Â¨', 'noticeboard Ã˜Â´Ã˜Â§Ã™â€¦Ã™â€ž', 'Noticeboard Ã Â¤Å“Ã Â¥â€¹Ã Â¤Â¡Ã Â¤Â¼', 'adde noticeboard', 'menambahkan pengumuman', 'Ã¤Â¼ÂÃ¨Â¨â‚¬Ã¦ÂÂ¿Ã£â€šâ€™Ã¨Â¿Â½Ã¥Å Â ', 'Ã¬ÂËœ noticeboard Ã¬Â¶â€ÃªÂ°â‚¬'),
(180, 'notice', 'notice', '', 'aviso', 'تنويه', 'kennisgeving', 'Ã‘Æ’ÃÂ²ÃÂµÃÂ´ÃÂ¾ÃÂ¼ÃÂ»ÃÂµÃÂ½ÃÂ¸ÃÂµ', 'Ã©â‚¬Å¡Ã§Å¸Â¥', 'uyarÃ„Â±', 'aviso', 'ÃƒÂ©rtesÃƒÂ­tÃƒÂ©s', 'dÃƒÂ©lai', 'ÃŽÂµÃŽÂ¹ÃŽÂ´ÃŽÂ¿Ãâ‚¬ÃŽÂ¿ÃŽÂ¯ÃŽÂ·ÃÆ’ÃŽÂ·', 'Bekanntmachung', 'avviso', 'Ã Â¹ÂÃ Â¸Ë†Ã Â¹â€°Ã Â¸â€¡Ã Â¹Æ’Ã Â¸Â«Ã Â¹â€°Ã Â¸â€”Ã Â¸Â£Ã Â¸Â²Ã Â¸Å¡', 'Ã™â€ Ã™Ë†Ã™Â¹Ã˜Â³', 'Ã Â¤Â¨Ã Â¥â€¹Ã Â¤Å¸Ã Â¤Â¿Ã Â¤Â¸', 'Observa', 'pemberitahuan', 'Ã¤ÂºË†Ã¥â€˜Å ', 'Ã­â€ ÂµÃ¬Â§â‚¬'),
(181, 'add_notice', 'add notice', '', 'aÃƒÂ±adir aviso', 'إضافة إشعار', 'voeg bericht', 'ÃÂ´ÃÂ¾ÃÂ±ÃÂ°ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ Ã‘Æ’ÃÂ²ÃÂµÃÂ´ÃÂ¾ÃÂ¼ÃÂ»ÃÂµÃÂ½ÃÂ¸ÃÂµ', 'Ã¦Â·Â»Ã¥Å Â Ã©â‚¬Å¡Ã§Å¸Â¥', 'haber ekle', 'adicionar aviso', 'hozzÃƒÂ¡ ÃƒÂ©rtesÃƒÂ­tÃƒÂ©s', 'ajouter un avis', 'Ãâ‚¬ÃÂÃŽÂ¿ÃÆ’ÃŽÂ¸ÃŽÂ­ÃÆ’Ãâ€žÃŽÂµ ÃŽÂ±ÃŽÂ½ÃŽÂ±ÃŽÂºÃŽÂ¿ÃŽÂ¯ÃŽÂ½Ãâ€°ÃÆ’ÃŽÂ·', 'Hinweis hinzufÃƒÂ¼gen', 'aggiungere preavviso', 'Ã Â¹â‚¬Ã Â¸Å¾Ã Â¸Â´Ã Â¹Ë†Ã Â¸Â¡Ã Â¹ÂÃ Â¸Ë†Ã Â¹â€°Ã Â¸â€¡Ã Â¹Æ’Ã Â¸Â«Ã Â¹â€°Ã Â¸â€”Ã Â¸Â£Ã Â¸Â²Ã Â¸Å¡Ã Â¸Â¥Ã Â¹Ë†Ã Â¸Â§Ã Â¸â€¡Ã Â¸Â«Ã Â¸â„¢Ã Â¹â€°Ã Â¸Â²', 'Ã™â€ Ã™Ë†Ã™Â¹Ã˜Â³ ÃšÂ©Ã˜Â§ Ã˜Â§Ã˜Â¶Ã˜Â§Ã™ÂÃ›Â ÃšÂ©Ã˜Â±Ã›Å’ÃšÂº', 'Ã Â¤Â¨Ã Â¥â€¹Ã Â¤Å¸Ã Â¤Â¿Ã Â¤Â¸ Ã Â¤Å“Ã Â¥â€¹Ã Â¤Â¡Ã Â¤Â¼', 'addunt et titulum', 'tambahkan pemberitahuan', 'Ã©â‚¬Å¡Ã§Å¸Â¥Ã£â€šâ€™Ã¨Â¿Â½Ã¥Å Â ', 'Ã­â€ ÂµÃ¬Â§â‚¬Ã«Â¥Â¼ Ã¬Â¶â€ÃªÂ°â‚¬'),
(182, 'edit_noticeboard', 'edit noticeboard', '', 'edit tablÃƒÂ³n de anuncios', 'تحرير لوحة الإعلانات', 'bewerk prikbord', 'ÃÂ¿Ã‘â‚¬ÃÂ°ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ ÃÂ´ÃÂ¾Ã‘ÂÃÂºÃÂ° ÃÂ´ÃÂ»Ã‘Â ÃÂ¾ÃÂ±Ã‘Å Ã‘ÂÃÂ²ÃÂ»ÃÂµÃÂ½ÃÂ¸ÃÂ¹', 'Ã§Â¼â€“Ã¨Â¾â€˜Ã¥Â¸Æ’Ã¥â€˜Å ', 'edit noticeboard', 'ediÃƒÂ§ÃƒÂ£o de avisos', 'szerkesztÃƒÂ©s ÃƒÂ¼zenÃ…â€˜falÃƒÂ¡n', 'modifier panneau d''affichage', 'edit ÃŽÂ±ÃŽÂ½ÃŽÂ±ÃŽÂºÃŽÂ¿ÃŽÂ¹ÃŽÂ½ÃÅ½ÃÆ’ÃŽÂµÃâ€°ÃŽÂ½', 'Brett bearbeiten', 'modifica bacheca', 'Ã Â¹ÂÃ Â¸ÂÃ Â¹â€°Ã Â¹â€žÃ Â¸â€šÃ Â¸â€ºÃ Â¹â€°Ã Â¸Â²Ã Â¸Â¢Ã Â¸â€ºÃ Â¸Â£Ã Â¸Â°Ã Â¸ÂÃ Â¸Â²Ã Â¸Â¨', 'Ã™â€¦Ã›Å’ÃšÂº Ã˜ÂªÃ˜Â±Ã™â€¦Ã›Å’Ã™â€¦ ÃšÂ©Ã˜Â±Ã›Å’ÃšÂº noticeboard', 'Ã Â¤Â¸Ã Â¤â€šÃ Â¤ÂªÃ Â¤Â¾Ã Â¤Â¦Ã Â¤Â¿Ã Â¤Â¤ Noticeboard', 'edit noticeboard', 'mengedit pengumuman', 'Ã§Â·Â¨Ã©â€ºâ€ Ã¤Â¼ÂÃ¨Â¨â‚¬Ã¦ÂÂ¿', 'Ã­Å½Â¸Ã¬Â§â€˜Ã¬ÂËœ noticeboard'),
(183, 'system_name', 'system name', '', 'Nombre del sistema', 'اسم النظام', 'Name System', 'ÃËœÃÂ¼Ã‘Â Ã‘ÂÃÂ¸Ã‘ÂÃ‘â€šÃÂµÃÂ¼Ã‘â€¹', 'Ã§Â³Â»Ã§Â»Å¸Ã¥ÂÂÃ§Â§Â°', 'sistemi adÃ„Â±', 'nome do sistema', 'rendszer neve', 'nom du systÃƒÂ¨me', 'ÃÅ’ÃŽÂ½ÃŽÂ¿ÃŽÂ¼ÃŽÂ± Ãâ€žÃŽÂ¿Ãâ€¦ ÃÆ’Ãâ€¦ÃÆ’Ãâ€žÃŽÂ®ÃŽÂ¼ÃŽÂ±Ãâ€žÃŽÂ¿Ãâ€š', 'Systemnamen', 'nome del sistema', 'Ã Â¸Å Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸Â£Ã Â¸Â°Ã Â¸Å¡Ã Â¸Å¡', 'Ã™â€ Ã˜Â¸Ã˜Â§Ã™â€¦ ÃšÂ©Ã˜Â§ Ã™â€ Ã˜Â§Ã™â€¦', 'Ã Â¤Â¸Ã Â¤Â¿Ã Â¤Â¸Ã Â¥ÂÃ Â¤Å¸Ã Â¤Â® Ã Â¤Â¨Ã Â¤Â¾Ã Â¤Â®', 'ratio nominis', 'Nama sistem', 'Ã£â€šÂ·Ã£â€šÂ¹Ã£Æ’â€ Ã£Æ’Â Ã¥ÂÂ', 'Ã¬â€¹Å“Ã¬Å Â¤Ã­â€¦Å“ Ã¬ÂÂ´Ã«Â¦â€ž'),
(184, 'save', 'save', '', 'guardar', 'حفظ', 'besparen', 'Ã‘ÂÃÂºÃÂ¾ÃÂ½ÃÂ¾ÃÂ¼ÃÂ¸Ã‘â€šÃ‘Å’', 'Ã¨Å â€šÃ§Å“Â', 'kurtarmak', 'salvar', 'kivÃƒÂ©ve', 'sauver', 'ÃŽÂµÃŽÂºÃâ€žÃÅ’Ãâ€š', 'sparen', 'salvare', 'Ã Â¸â€ºÃ Â¸Â£Ã Â¸Â°Ã Â¸Â«Ã Â¸Â¢Ã Â¸Â±Ã Â¸â€', 'ÃšÂ©Ã™Ë† Ã˜Â¨Ãšâ€ Ã˜Â§Ã™â€ Ã›â€™ ÃšÂ©Ã›â€™', 'Ã Â¤Â¬Ã Â¤Å¡Ã Â¤Â¾Ã Â¤Â¨Ã Â¤Â¾', 'salvum', 'menyimpan', 'Ã¤Â¿ÂÃ¥Â­Ëœ', 'Ã¬Â â‚¬Ã¬Å¾Â¥'),
(185, 'system_title', 'system title', '', 'TÃƒÂ­tulo de sistema', 'عنوان النظام', 'systeem titel', 'ÃÂÃÂ°ÃÂ·ÃÂ²ÃÂ°ÃÂ½ÃÂ¸ÃÂµ Ã‘ÂÃÂ¸Ã‘ÂÃ‘â€šÃÂµÃÂ¼Ã‘â€¹', 'Ã§Â³Â»Ã§Â»Å¸Ã¦Â â€¡Ã©Â¢Ëœ', 'Sistem baÃ…Å¸lÃ„Â±k', 'tÃƒÂ­tulo sistema', 'rendszer cÃƒÂ­m', 'titre du systÃƒÂ¨me', 'ÃŽÂ¤ÃŽÂ¯Ãâ€žÃŽÂ»ÃŽÂ¿Ãâ€š Ãâ€žÃŽÂ¿Ãâ€¦ ÃÆ’Ãâ€¦ÃÆ’Ãâ€žÃŽÂ®ÃŽÂ¼ÃŽÂ±Ãâ€žÃŽÂ¿Ãâ€š', 'System-Titel', 'titolo di sistema', 'Ã Â¸Å Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸Â£Ã Â¸Â°Ã Â¸Å¡Ã Â¸Å¡', 'Ã™â€ Ã˜Â¸Ã˜Â§Ã™â€¦ Ã˜Â¹Ã™â€ Ã™Ë†Ã˜Â§Ã™â€ ', 'Ã Â¤Â¸Ã Â¤Â¿Ã Â¤Â¸Ã Â¥ÂÃ Â¤Å¸Ã Â¤Â® Ã Â¤Â¶Ã Â¥â‚¬Ã Â¤Â°Ã Â¥ÂÃ Â¤Â·Ã Â¤â€¢', 'ratio title', 'title sistem', 'Ã£â€šÂ·Ã£â€šÂ¹Ã£Æ’â€ Ã£Æ’Â Ã£ÂÂ®Ã£â€šÂ¿Ã£â€šÂ¤Ã£Æ’Ë†Ã£Æ’Â«', 'Ã¬â€¹Å“Ã¬Å Â¤Ã­â€¦Å“ Ã¬Â Å“Ã«ÂªÂ©'),
(186, 'paypal_email', 'paypal email', '', 'paypal email', 'بريد باي بال', 'paypal e-mail', 'PayPal ÃÂ¿ÃÂ¾ Ã‘ÂÃÂ»ÃÂµÃÂºÃ‘â€šÃ‘â‚¬ÃÂ¾ÃÂ½ÃÂ½ÃÂ¾ÃÂ¹ ÃÂ¿ÃÂ¾Ã‘â€¡Ã‘â€šÃÂµ', 'PayPalÃ§â€ÂµÃ¥Â­ÂÃ©â€šÂ®Ã¤Â»Â¶', 'paypal e-posta', 'paypal e-mail', 'paypal email', 'paypal email', 'paypal ÃŽÂ·ÃŽÂ»ÃŽÂµÃŽÂºÃâ€žÃÂÃŽÂ¿ÃŽÂ½ÃŽÂ¹ÃŽÂºÃÅ’ Ãâ€žÃŽÂ±Ãâ€¡Ãâ€¦ÃŽÂ´ÃÂÃŽÂ¿ÃŽÂ¼ÃŽÂµÃŽÂ¯ÃŽÂ¿', 'paypal E-Mail', 'paypal-mail', 'paypal Ã Â¸Â­Ã Â¸ÂµÃ Â¹â‚¬Ã Â¸Â¡Ã Â¸Â¥Ã Â¹Å’', 'Ã™Â¾Ã›â€™ Ã™Â¾Ã˜Â§Ã™â€ž Ã˜Â§Ã›Å’ Ã™â€¦Ã›Å’Ã™â€ž', 'Ã Â¤ÂªÃ Â¥â€¡Ã Â¤ÂªÃ Â¥Ë†Ã Â¤Â² Ã Â¤Ë†Ã Â¤Â®Ã Â¥â€¡Ã Â¤Â²', 'Paypal email', 'email paypal', 'PaypalÃ£ÂÂ®Ã£Æ’Â¡Ã£Æ’Â¼Ã£Æ’Â«', 'Ã­Å½ËœÃ¬ÂÂ´Ã­Å’â€ Ã¬ÂÂ´Ã«Â©â€Ã¬ÂÂ¼'),
(187, 'currency', 'currency', '', 'moneda', 'دقة', 'valuta', 'ÃÂ²ÃÂ°ÃÂ»Ã‘Å½Ã‘â€šÃÂ°', 'Ã¨Â´Â§Ã¥Â¸Â', 'para', 'moeda', 'valuta', 'monnaie', 'ÃŽÂ½ÃÅ’ÃŽÂ¼ÃŽÂ¹ÃÆ’ÃŽÂ¼ÃŽÂ±', 'WÃƒÂ¤hrung', 'valuta', 'Ã Â¹â‚¬Ã Â¸â€¡Ã Â¸Â´Ã Â¸â„¢Ã Â¸â€¢Ã Â¸Â£Ã Â¸Â²', 'ÃšÂ©Ã˜Â±Ã™â€ Ã˜Â³Ã›Å’', 'Ã Â¤Â®Ã Â¥ÂÃ Â¤Â¦Ã Â¥ÂÃ Â¤Â°Ã Â¤Â¾', 'currency', 'mata uang', 'Ã©â‚¬Å¡Ã¨Â²Â¨', 'Ã­â€ ÂµÃ­â„¢â€'),
(188, 'phrase_list', 'phrase list', '', 'lista de frases', 'قائمة العبارات', 'zinnenlijst', 'ÃÂ¡ÃÂ¿ÃÂ¸Ã‘ÂÃÂ¾ÃÂº Ã‘â€žÃ‘â‚¬ÃÂ°ÃÂ·ÃÂ°', 'Ã§Å¸Â­Ã¨Â¯Â­Ã¥Ë†â€”Ã¨Â¡Â¨', 'ifade listesi', 'lista de frases', 'kifejezÃƒÂ©s lista', 'liste de phrase', 'ÃŽâ€ºÃŽÂ¯ÃÆ’Ãâ€žÃŽÂ± Ãâ€ ÃÂÃŽÂ¬ÃÆ’ÃŽÂ·', 'Phrasenliste', 'elenco frasi', 'Ã Â¸Â£Ã Â¸Â²Ã Â¸Â¢Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸Â§Ã Â¸Â¥Ã Â¸Âµ', 'Ã˜Â¬Ã™â€¦Ã™â€žÃ›Â Ã™ÂÃ›ÂÃ˜Â±Ã˜Â³Ã˜Âª', 'Ã Â¤ÂµÃ Â¤Â¾Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â¯Ã Â¤Â¾Ã Â¤â€šÃ Â¤Â¶ Ã Â¤Â¸Ã Â¥â€šÃ Â¤Å¡Ã Â¥â‚¬', 'dicitur album', 'Daftar frase', 'Ã£Æ’â€¢Ã£Æ’Â¬Ã£Æ’Â¼Ã£â€šÂºÃ£Æ’ÂªÃ£â€šÂ¹Ã£Æ’Ë†', 'Ã«Â¬Â¸ÃªÂµÂ¬ Ã«ÂªÂ©Ã«Â¡Â'),
(189, 'add_phrase', 'add phrase', '', 'aÃƒÂ±adir la frase', 'إضافة عبارة', 'voeg zin', 'ÃÂ´ÃÂ¾ÃÂ±ÃÂ°ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ Ã‘â€žÃ‘â‚¬ÃÂ°ÃÂ·Ã‘Æ’', 'Ã¦Â·Â»Ã¥Å Â Ã¨Â¯ÂÃ§Â»â€ž', 'ifade eklemek', 'adicionar frase', 'adjunk kifejezÃƒÂ©st', 'ajouter la phrase', 'Ãâ‚¬ÃÂÃŽÂ¿ÃÆ’ÃŽÂ¸ÃŽÂ­ÃÆ’Ãâ€žÃŽÂµ Ãâ€ ÃÂÃŽÂ¬ÃÆ’ÃŽÂ·', 'Begriff hinzufÃƒÂ¼gen', 'aggiungere la frase', 'Ã Â¹â‚¬Ã Â¸Å¾Ã Â¸Â´Ã Â¹Ë†Ã Â¸Â¡Ã Â¸Â§Ã Â¸Â¥Ã Â¸Âµ', 'Ã˜Â¬Ã™â€¦Ã™â€žÃ›Â Ã˜Â´Ã˜Â§Ã™â€¦Ã™â€ž', 'Ã Â¤ÂµÃ Â¤Â¾Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â¯Ã Â¤Â¾Ã Â¤â€šÃ Â¤Â¶ Ã Â¤Å“Ã Â¥â€¹Ã Â¤Â¡Ã Â¤Â¼Ã Â¤Â¨Ã Â¤Â¾', 'addere phrase', 'menambahkan frase', 'Ã£Æ’â€¢Ã£Æ’Â¬Ã£Æ’Â¼Ã£â€šÂºÃ£â€šâ€™Ã¨Â¿Â½Ã¥Å Â ', 'Ã«Â¬Â¸ÃªÂµÂ¬Ã«Â¥Â¼ Ã¬Â¶â€ÃªÂ°â‚¬'),
(190, 'add_language', 'add language', '', 'aÃƒÂ±adir idioma', 'إضافة لغة', 'add taal', 'ÃÂ´ÃÂ¾ÃÂ±ÃÂ°ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ Ã‘ÂÃÂ·Ã‘â€¹ÃÂº', 'Ã¦â€“Â°Ã¥Â¢Å¾Ã¨Â¯Â­Ã¨Â¨â‚¬', 'dil ekle', 'adicionar lÃƒÂ­ngua', 'nyelv hozzÃƒÂ¡adÃƒÂ¡sa', 'ajouter la langue', 'Ãâ‚¬ÃÂÃŽÂ¿ÃÆ’ÃŽÂ¸ÃŽÂ­ÃÆ’Ãâ€žÃŽÂµ ÃŽÂ³ÃŽÂ»ÃÅ½ÃÆ’ÃÆ’ÃŽÂ±', 'Sprache hinzufÃƒÂ¼gen', 'aggiungere la lingua', 'Ã Â¹â‚¬Ã Â¸Å¾Ã Â¸Â´Ã Â¹Ë†Ã Â¸Â¡Ã Â¸Â Ã Â¸Â²Ã Â¸Â©Ã Â¸Â²', 'Ã˜Â²Ã˜Â¨Ã˜Â§Ã™â€  ÃšÂ©Ã™Ë† Ã˜Â´Ã˜Â§Ã™â€¦Ã™â€ž', 'Ã Â¤Â­Ã Â¤Â¾Ã Â¤Â·Ã Â¤Â¾ Ã Â¤Å“Ã Â¥â€¹Ã Â¤Â¡Ã Â¤Â¼Ã Â¤Â¨Ã Â¤Â¾', 'addere verbis', 'menambahkan bahasa', 'Ã¨Â¨â‚¬Ã¨ÂªÅ¾Ã£â€šâ€™Ã¨Â¿Â½Ã¥Å Â ', 'Ã¬â€“Â¸Ã¬â€“Â´Ã«Â¥Â¼ Ã¬Â¶â€ÃªÂ°â‚¬'),
(191, 'phrase', 'phrase', '', 'frase', 'العبارة', 'frase', 'Ã‘â€žÃ‘â‚¬ÃÂ°ÃÂ·ÃÂ°', 'Ã§Å¸Â­Ã¨Â¯Â­', 'ifade', 'frase', 'kifejezÃƒÂ©s', 'phrase', 'Ãâ€ ÃÂÃŽÂ¬ÃÆ’ÃŽÂ·', 'Ausdruck', 'frase', 'Ã Â¸Â§Ã Â¸Â¥Ã Â¸Âµ', 'Ã˜Â¬Ã™â€¦Ã™â€žÃ›Â', 'Ã Â¤ÂµÃ Â¤Â¾Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â¯Ã Â¤Â¾Ã Â¤â€šÃ Â¤Â¶', 'phrase', 'frasa', 'Ã£Æ’â€¢Ã£Æ’Â¬Ã£Æ’Â¼Ã£â€šÂº', 'ÃªÂµÂ¬'),
(192, 'manage_backup_restore', 'manage backup restore', '', 'gestionar copias de seguridad a restaurar', 'إدارة استعادة النسخ الاحتياطي', 'beheer van back-up herstellen', 'Ã‘Æ’ÃÂ¿Ã‘â‚¬ÃÂ°ÃÂ²ÃÂ»Ã‘ÂÃ‘â€šÃ‘Å’ ÃÂ²ÃÂ¾Ã‘ÂÃ‘ÂÃ‘â€šÃÂ°ÃÂ½ÃÂ¾ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ Ã‘â‚¬ÃÂµÃÂ·ÃÂµÃ‘â‚¬ÃÂ²ÃÂ½ÃÂ¾ÃÂ³ÃÂ¾ ÃÂºÃÂ¾ÃÂ¿ÃÂ¸Ã‘â‚¬ÃÂ¾ÃÂ²ÃÂ°ÃÂ½ÃÂ¸Ã‘Â', 'Ã§Â®Â¡Ã§Ââ€ Ã¥Â¤â€¡Ã¤Â»Â½Ã¦ÂÂ¢Ã¥Â¤Â', 'yedekleme geri yÃƒÂ¶netmek', 'gerenciar o backup de restauraÃƒÂ§ÃƒÂ£o', 'kezelni a biztonsÃƒÂ¡gi mentÃƒÂ©s visszaÃƒÂ¡llÃƒÂ­tÃƒÂ¡sa', 'gÃƒÂ©rer de restauration de sauvegarde', 'ÃŽÂ´ÃŽÂ¹ÃŽÂ±Ãâ€¡ÃŽÂµÃŽÂ¯ÃÂÃŽÂ¹ÃÆ’ÃŽÂ· ÃŽÂµÃâ‚¬ÃŽÂ±ÃŽÂ½ÃŽÂ±Ãâ€ ÃŽÂ¿ÃÂÃŽÂ¬Ãâ€š ÃŽÂ±ÃŽÂ½Ãâ€žÃŽÂ¹ÃŽÂ³ÃÂÃŽÂ¬Ãâ€ Ãâ€°ÃŽÂ½ ÃŽÂ±ÃÆ’Ãâ€ ÃŽÂ±ÃŽÂ»ÃŽÂµÃŽÂ¯ÃŽÂ±Ãâ€š', 'verwalten Backup wiederherstellen', 'gestire il ripristino di backup', 'Ã Â¸Ë†Ã Â¸Â±Ã Â¸â€Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸ÂªÃ Â¸Â³Ã Â¸Â£Ã Â¸Â­Ã Â¸â€¡Ã Â¸â€šÃ Â¹â€°Ã Â¸Â­Ã Â¸Â¡Ã Â¸Â¹Ã Â¸Â¥Ã Â¹â‚¬Ã Â¸Â£Ã Â¸ÂµÃ Â¸Â¢Ã Â¸ÂÃ Â¸â€žÃ Â¸Â·Ã Â¸â„¢', 'Ã˜Â¨Ã›Å’ÃšÂ© Ã˜Â§Ã™Â¾ Ã˜Â¨Ã˜Â­Ã˜Â§Ã™â€ž Ã˜Â§Ã™â€ Ã˜ÂªÃ˜Â¸Ã˜Â§Ã™â€¦', 'Ã Â¤Â¬Ã Â¥Ë†Ã Â¤â€¢Ã Â¤â€¦Ã Â¤Âª Ã Â¤Â¬Ã Â¤Â¹Ã Â¤Â¾Ã Â¤Â² Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¤Â¬Ã Â¤â€šÃ Â¤Â§Ã Â¤Â¨', 'curo tergum restituunt', 'mengelola backup restore', 'Ã£Æ’ÂÃ£Æ’Æ’Ã£â€šÂ¯Ã£â€šÂ¢Ã£Æ’Æ’Ã£Æ’â€”Ã£â‚¬ÂÃ£Æ’ÂªÃ£â€šÂ¹Ã£Æ’Ë†Ã£â€šÂ¢Ã£â€šâ€™Ã§Â®Â¡Ã§Ââ€ ', 'Ã«Â°Â±Ã¬â€”â€¦ Ã«Â³ÂµÃ¬â€ºÂ ÃªÂ´â‚¬Ã«Â¦Â¬'),
(193, 'restore', 'restore', '', 'restaurar', 'استعادة', 'herstellen', 'ÃÂ²ÃÂ¾Ã‘ÂÃ‘ÂÃ‘â€šÃÂ°ÃÂ½ÃÂ¾ÃÂ²ÃÂ»ÃÂµÃÂ½ÃÂ¸ÃÂµ', 'Ã¦ÂÂ¢Ã¥Â¤Â', 'geri', 'restaurar', 'visszaad', 'restaurer', 'ÃŽÂµÃâ‚¬ÃŽÂ±ÃŽÂ½ÃŽÂ±Ãâ€ ÃŽÂ­ÃÂÃŽÂµÃâ€žÃŽÂµ', 'wiederherstellen', 'ripristinare', 'Ã Â¸Å¸Ã Â¸Â·Ã Â¹â€°Ã Â¸â„¢Ã Â¸Å¸Ã Â¸Â¹', 'Ã˜Â¨Ã˜Â­Ã˜Â§Ã™â€ž', 'Ã Â¤Â¬Ã Â¤Â¹Ã Â¤Â¾Ã Â¤Â²', 'reddite', 'mengembalikan', 'Ã¥Â¾Â©Ã¥â€¦Æ’Ã£Ââ„¢Ã£â€šâ€¹', 'Ã«Â³ÂµÃ¬â€ºÂ'),
(194, 'mark', 'mark', '', 'marca', 'علامة', 'mark', 'ÃÂ·ÃÂ½ÃÂ°ÃÂº', 'Ã¦Â â€¡Ã¥Â¿â€”', 'iÃ…Å¸aret', 'marca', 'jel', 'marque', 'ÃÆ’ÃŽÂ·ÃŽÂ¼ÃŽÂ¬ÃŽÂ´ÃŽÂ¹', 'Marke', 'marchio', 'Ã Â¹â‚¬Ã Â¸â€žÃ Â¸Â£Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸â€¡Ã Â¸Â«Ã Â¸Â¡Ã Â¸Â²Ã Â¸Â¢', 'Ã™â€ Ã˜Â´Ã˜Â§Ã™â€ ', 'Ã Â¤Â¨Ã Â¤Â¿Ã Â¤Â¶Ã Â¤Â¾Ã Â¤Â¨', 'Marcus', 'tanda', 'Ã£Æ’Å¾Ã£Æ’Â¼Ã£â€šÂ¯', 'Ã­â€˜Å“'),
(195, 'grade', 'grade', '', 'grado', 'درجة', 'graad', 'ÃÂºÃÂ»ÃÂ°Ã‘ÂÃ‘Â', 'Ã§Â­â€°Ã§ÂºÂ§', 'sÃ„Â±nÃ„Â±f', 'grau', 'fokozat', 'grade', 'ÃŽÂ²ÃŽÂ±ÃŽÂ¸ÃŽÂ¼ÃÅ’Ãâ€š', 'Klasse', 'grado', 'Ã Â¹â‚¬Ã Â¸ÂÃ Â¸Â£Ã Â¸â€', 'ÃšÂ¯Ã˜Â±Ã›Å’ÃšË†', 'Ã Â¤â€”Ã Â¥ÂÃ Â¤Â°Ã Â¥â€¡Ã Â¤Â¡', 'gradus,', 'kelas', 'Ã£â€šÂ°Ã£Æ’Â¬Ã£Æ’Â¼Ã£Æ’â€°', 'Ã­â€¢â„¢Ã«â€¦â€ž'),
(196, 'invoice', 'invoice', '', 'factura', 'فاتورة', 'factuur', 'Ã‘ÂÃ‘â€¡ÃÂµÃ‘â€š-Ã‘â€žÃÂ°ÃÂºÃ‘â€šÃ‘Æ’Ã‘â‚¬ÃÂ°', 'Ã¥Ââ€˜Ã§Â¥Â¨', 'fatura', 'fatura', 'szÃƒÂ¡mla', 'facture', 'Ãâ€žÃŽÂ¹ÃŽÂ¼ÃŽÂ¿ÃŽÂ»ÃÅ’ÃŽÂ³ÃŽÂ¹ÃŽÂ¿', 'Rechnung', 'fattura', 'Ã Â¹Æ’Ã Â¸Å¡Ã Â¸ÂÃ Â¸Â³Ã Â¸ÂÃ Â¸Â±Ã Â¸Å¡Ã Â¸ÂªÃ Â¸Â´Ã Â¸â„¢Ã Â¸â€žÃ Â¹â€°Ã Â¸Â²', 'Ã˜Â§Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¦Ã˜Â³', 'Ã Â¤Â¬Ã Â¥â‚¬Ã Â¤Å“Ã Â¤â€¢', 'cautionem', 'faktur', 'Ã£â€šÂ¤Ã£Æ’Â³Ã£Æ’Å“Ã£â€šÂ¤Ã£â€šÂ¹', 'Ã¬â€ Â¡Ã¬Å¾Â¥'),
(197, 'book', 'book', '', 'libro', 'فاتورة', 'boek', 'ÃÂºÃÂ½ÃÂ¸ÃÂ³ÃÂ°', 'Ã¤Â¹Â¦', 'kitap', 'livro', 'kÃƒÂ¶nyv', 'livre', 'ÃŽÂ²ÃŽÂ¹ÃŽÂ²ÃŽÂ»ÃŽÂ¯ÃŽÂ¿', 'Buch', 'libro', 'Ã Â¸Â«Ã Â¸â„¢Ã Â¸Â±Ã Â¸â€¡Ã Â¸ÂªÃ Â¸Â·Ã Â¸Â­', 'ÃšÂ©Ã˜ÂªÃ˜Â§Ã˜Â¨', 'Ã Â¤â€¢Ã Â¤Â¿Ã Â¤Â¤Ã Â¤Â¾Ã Â¤Â¬', 'Liber', 'buku', 'Ã¦Å“Â¬', 'Ã¬Â±â€¦'),
(198, 'all', 'all', '', 'todo', 'الكل', 'alle', 'ÃÂ²Ã‘ÂÃÂµ', 'Ã¦â€°â‚¬Ã¦Å“â€°', 'tÃƒÂ¼m', 'tudo', 'minden', 'tout', 'ÃÅ’ÃŽÂ»ÃŽÂ±', 'alle', 'tutto', 'Ã Â¸â€”Ã Â¸Â±Ã Â¹â€°Ã Â¸â€¡Ã Â¸Â«Ã Â¸Â¡Ã Â¸â€', 'Ã˜ÂªÃ™â€¦Ã˜Â§Ã™â€¦', 'Ã Â¤Â¸Ã Â¤Â¬', 'omnes', 'semua', 'Ã£Ââ„¢Ã£ÂÂ¹Ã£ÂÂ¦', 'Ã«ÂªÂ¨Ã«â€œÂ '),
(199, 'upload_&_restore_from_backup', 'upload & restore from backup', '', 'cargar y restaurar copia de seguridad', 'تحميل واستعادة من النسخ الاحتياطي', 'uploaden en terugzetten van een backup', 'ÃÂ·ÃÂ°ÃÂ³Ã‘â‚¬Ã‘Æ’ÃÂ·ÃÂ¸Ã‘â€šÃ‘Å’ ÃÂ¸ ÃÂ²ÃÂ¾Ã‘ÂÃ‘ÂÃ‘â€šÃÂ°ÃÂ½ÃÂ¾ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ ÃÂ¸ÃÂ· Ã‘â‚¬ÃÂµÃÂ·ÃÂµÃ‘â‚¬ÃÂ²ÃÂ½ÃÂ¾ÃÂ¹ ÃÂºÃÂ¾ÃÂ¿ÃÂ¸ÃÂ¸', 'Ã¤Â¸Å Ã¤Â¼Â Ã¥ÂÅ Ã¤Â»Å½Ã¥Â¤â€¡Ã¤Â»Â½Ã¤Â¸Â­Ã¦ÂÂ¢Ã¥Â¤Â', 'yÃƒÂ¼kleyebilir ve yedekten geri yÃƒÂ¼kleme', 'fazer upload e restauraÃƒÂ§ÃƒÂ£o de backup', 'feltÃƒÂ¶lteni ÃƒÂ©s visszaÃƒÂ¡llÃƒÂ­tani backup', 'tÃƒÂ©lÃƒÂ©charger et restauration de la sauvegarde', 'ÃŽÂ±ÃŽÂ½ÃŽÂµÃŽÂ²ÃŽÂ¬ÃÆ’ÃŽÂµÃâ€žÃŽÂµ ÃŽÂºÃŽÂ±ÃŽÂ¹ ÃŽÂµÃâ‚¬ÃŽÂ±ÃŽÂ½ÃŽÂ±Ãâ€ ÃŽÂ¿ÃÂÃŽÂ¬ ÃŽÂ±Ãâ‚¬ÃÅ’ backup', 'Upload &amp; Wiederherstellung von Backups', 'caricare e ripristinare dal backup', 'Ã Â¸Â­Ã Â¸Â±Ã Â¸â€ºÃ Â¹â€šÃ Â¸Â«Ã Â¸Â¥Ã Â¸â€Ã Â¹ÂÃ Â¸Â¥Ã Â¸Â°Ã Â¹â‚¬Ã Â¸Â£Ã Â¸ÂµÃ Â¸Â¢Ã Â¸ÂÃ Â¸â€žÃ Â¸Â·Ã Â¸â„¢Ã Â¸Ë†Ã Â¸Â²Ã Â¸ÂÃ Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸ÂªÃ Â¸Â³Ã Â¸Â£Ã Â¸Â­Ã Â¸â€¡Ã Â¸â€šÃ Â¹â€°Ã Â¸Â­Ã Â¸Â¡Ã Â¸Â¹Ã Â¸Â¥', 'Ã˜Â§Ã™Â¾ Ã™â€žÃ™Ë†ÃšË† ÃšÂ©Ã˜Â±Ã›Å’ÃšÂº Ã˜Â§Ã™Ë†Ã˜Â± Ã˜Â¨Ã›Å’ÃšÂ© Ã˜Â§Ã™Â¾ Ã˜Â³Ã›â€™ Ã˜Â¨Ã˜Â­Ã˜Â§Ã™â€ž', 'Ã Â¤â€¦Ã Â¤ÂªÃ Â¤Â²Ã Â¥â€¹Ã Â¤Â¡ Ã Â¤â€Ã Â¤Â° Ã Â¤Â¬Ã Â¥Ë†Ã Â¤â€¢Ã Â¤â€¦Ã Â¤Âª Ã Â¤Â¸Ã Â¥â€¡ Ã Â¤Â¬Ã Â¤Â¹Ã Â¤Â¾Ã Â¤Â²', 'restituo ex tergum upload,', 'meng-upload &amp; restore dari backup', 'Ã£â€šÂ¢Ã£Æ’Æ’Ã£Æ’â€”Ã£Æ’Â­Ã£Æ’Â¼Ã£Æ’â€°Ã¯Â¼â€ Ã£Æ’ÂÃ£Æ’Æ’Ã£â€šÂ¯Ã£â€šÂ¢Ã£Æ’Æ’Ã£Æ’â€”Ã£Ââ€¹Ã£â€šâ€°Ã¥Â¾Â©Ã¥â€¦Æ’', 'Ã¬â€”â€¦Ã«Â¡Å“Ã«â€œÅ“ Ã«Â°Â Ã«Â°Â±Ã¬â€”â€¦Ã¬â€”ÂÃ¬â€žÅ“ Ã«Â³ÂµÃ¬â€ºÂ'),
(200, 'manage_profile', 'manage profile', '', 'gestionar el perfil', 'إدارة الملف الشخصي', 'te beheren!', 'Ã‘Æ’ÃÂ¿Ã‘â‚¬ÃÂ°ÃÂ²ÃÂ»Ã‘ÂÃ‘â€šÃ‘Å’ ÃÂ¿Ã‘â‚¬ÃÂ¾Ã‘â€žÃÂ¸ÃÂ»ÃÂµÃÂ¼', 'Ã§Â®Â¡Ã§Ââ€ Ã©â€¦ÂÃ§Â½Â®Ã¦â€“â€¡Ã¤Â»Â¶', 'profilini yÃƒÂ¶netmek', 'gerenciar o perfil', 'Profil kezelÃƒÂ©se', 'gÃƒÂ©rer le profil', 'ÃŽÂ´ÃŽÂ¹ÃŽÂ±Ãâ€¡ÃŽÂµÃŽÂ¹ÃÂÃŽÂ¹ÃÆ’Ãâ€žÃŽÂµÃŽÂ¯Ãâ€žÃŽÂµ Ãâ€žÃŽÂ¿ Ãâ‚¬ÃÂÃŽÂ¿Ãâ€ ÃŽÂ¯ÃŽÂ»', 'Profil verwalten', 'gestire il profilo', 'Ã Â¸Ë†Ã Â¸Â±Ã Â¸â€Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸Â£Ã Â¸Â²Ã Â¸Â¢Ã Â¸Â¥Ã Â¸Â°Ã Â¹â‚¬Ã Â¸Â­Ã Â¸ÂµÃ Â¸Â¢Ã Â¸â€', 'Ã™Â¾Ã˜Â±Ã™Ë†Ã™ÂÃ˜Â§Ã˜Â¦Ã™â€ž ÃšÂ©Ã˜Â§ Ã™â€ Ã˜Â¸Ã™â€¦ ÃšÂ©Ã˜Â±Ã›Å’ÃšÂº', 'Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¥â€¹Ã Â¤Â«Ã Â¤Â¾Ã Â¤â€¡Ã Â¤Â² Ã Â¤â€¢Ã Â¤Â¾ Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¤Â¬Ã Â¤â€šÃ Â¤Â§Ã Â¤Â¨', 'curo profile', 'mengelola profil', 'Ã£Æ’â€”Ã£Æ’Â­Ã£Æ’â€¢Ã£â€šÂ¡Ã£â€šÂ¤Ã£Æ’Â«Ã¯Â¼Ë†Ã¥â‚¬â€¹Ã¤ÂºÂºÃ¦Æ’â€¦Ã¥Â Â±Ã¯Â¼â€°Ã£ÂÂ®Ã§Â®Â¡Ã§Ââ€ ', 'Ã­â€â€žÃ«Â¡Å“Ã­â€¢â€ž (Ã«â€šÂ´ Ã¬Â â€¢Ã«Â³Â´) ÃªÂ´â‚¬Ã«Â¦Â¬'),
(201, 'update_profile', 'update profile', '', 'actualizar el perfil', 'تحديث الملف', 'Profiel bijwerken', 'ÃÂ¾ÃÂ±ÃÂ½ÃÂ¾ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ ÃÂ¿Ã‘â‚¬ÃÂ¾Ã‘â€žÃÂ¸ÃÂ»Ã‘Å’', 'Ã¦â€ºÂ´Ã¦â€“Â°Ã¤Â¸ÂªÃ¤ÂºÂºÃ¨Âµâ€žÃ¦â€“â„¢', 'profilinizi gÃƒÂ¼ncelleyin', 'atualizar o perfil', 'frissÃƒÂ­teni profil', 'mettre ÃƒÂ  jour le profil', 'ÃŽÂµÃŽÂ½ÃŽÂ·ÃŽÂ¼ÃŽÂµÃÂÃÅ½ÃÆ’ÃŽÂµÃâ€žÃŽÂµ Ãâ€žÃŽÂ¿ Ãâ‚¬ÃÂÃŽÂ¿Ãâ€ ÃŽÂ¯ÃŽÂ»', 'Profil aktualisieren', 'aggiornare il profilo', 'Ã Â¸Â­Ã Â¸Â±Ã Â¸â€ºÃ Â¹â‚¬Ã Â¸â€Ã Â¸â€¢Ã Â¹â€šÃ Â¸â€ºÃ Â¸Â£Ã Â¹â€žÃ Â¸Å¸Ã Â¸Â¥Ã Â¹Å’', 'Ã™Â¾Ã˜Â±Ã™Ë†Ã™ÂÃ˜Â§Ã˜Â¦Ã™â€ž ÃšÂ©Ã™Ë† Ã˜Â§Ã™Â¾ ÃšË†Ã›Å’Ã™Â¹', 'Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¥â€¹Ã Â¤Â«Ã Â¤Â¼Ã Â¤Â¾Ã Â¤â€¡Ã Â¤Â² Ã Â¤â€¦Ã Â¤ÂªÃ Â¤Â¡Ã Â¥â€¡Ã Â¤Å¸', 'magna eget ipsum', 'memperbarui profil', 'Ã£Æ’â€”Ã£Æ’Â­Ã£Æ’â€¢Ã£â€šÂ¡Ã£â€šÂ¤Ã£Æ’Â«Ã£â€šâ€™Ã¦â€ºÂ´Ã¦â€“Â°', 'Ã­â€â€žÃ«Â¡Å“Ã­â€¢â€žÃ¬Ââ€ž Ã¬â€”â€¦Ã«ÂÂ°Ã¬ÂÂ´Ã­Å Â¸'),
(202, 'new_password', 'new password', '', 'nueva contraseÃƒÂ±a', 'كلمة السر الجديدة', 'nieuw wachtwoord', 'ÃÂ½ÃÂ¾ÃÂ²Ã‘â€¹ÃÂ¹ ÃÂ¿ÃÂ°Ã‘â‚¬ÃÂ¾ÃÂ»Ã‘Å’', 'Ã¦â€“Â°Ã¥Â¯â€ Ã§Â Â', 'Yeni Ã…Å¸ifre', 'nova senha', 'ÃƒÅ¡j jelszÃƒÂ³', 'nouveau mot de passe', 'ÃŽÂ½ÃŽÂ­ÃŽÂ¿ ÃŽÂºÃâ€°ÃŽÂ´ÃŽÂ¹ÃŽÂºÃÅ’', 'Neues Passwort', 'nuova password', 'Ã Â¸Â£Ã Â¸Â«Ã Â¸Â±Ã Â¸ÂªÃ Â¸Å“Ã Â¹Ë†Ã Â¸Â²Ã Â¸â„¢Ã Â¹Æ’Ã Â¸Â«Ã Â¸Â¡Ã Â¹Ë†', 'Ã™â€ Ã›Å’Ã˜Â§ Ã™Â¾Ã˜Â§Ã˜Â³ Ã™Ë†Ã˜Â±ÃšË†', 'Ã Â¤Â¨Ã Â¤Â¯Ã Â¤Â¾ Ã Â¤ÂªÃ Â¤Â¾Ã Â¤Â¸Ã Â¤ÂµÃ Â¤Â°Ã Â¥ÂÃ Â¤Â¡', 'novum password', 'kata sandi baru', 'Ã¦â€“Â°Ã£Ââ€”Ã£Ââ€žÃ£Æ’â€˜Ã£â€šÂ¹Ã£Æ’Â¯Ã£Æ’Â¼Ã£Æ’â€°', 'Ã¬Æ’Ë† Ã¬â€¢â€Ã­ËœÂ¸'),
(203, 'confirm_new_password', 'confirm new password', '', 'confirmar nueva contraseÃƒÂ±a', 'تأكيد كلمة المرور الجديدة', 'Bevestig nieuw wachtwoord', 'ÃÂ¿ÃÂ¾ÃÂ´Ã‘â€šÃÂ²ÃÂµÃ‘â‚¬ÃÂ´ÃÂ¸Ã‘â€šÃ‘Å’ ÃÂ½ÃÂ¾ÃÂ²Ã‘â€¹ÃÂ¹ ÃÂ¿ÃÂ°Ã‘â‚¬ÃÂ¾ÃÂ»Ã‘Å’', 'Ã§Â¡Â®Ã¨Â®Â¤Ã¦â€“Â°Ã¥Â¯â€ Ã§Â Â', 'yeni parolayÃ„Â± onaylayÃ„Â±n', 'confirmar nova senha', 'erÃ…â€˜sÃƒÂ­tse meg az ÃƒÂºj jelszÃƒÂ³t', 'confirmer le nouveau mot de passe', 'ÃŽÂµÃâ‚¬ÃŽÂ¹ÃŽÂ²ÃŽÂµÃŽÂ²ÃŽÂ±ÃŽÂ¹ÃÅ½ÃÆ’ÃŽÂµÃâ€žÃŽÂµ Ãâ€žÃŽÂ¿ ÃŽÂ½ÃŽÂ­ÃŽÂ¿ ÃŽÂºÃâ€°ÃŽÂ´ÃŽÂ¹ÃŽÂºÃÅ’', 'BestÃƒÂ¤tigen eines neuen Kennwortes', 'conferma la nuova password', 'Ã Â¸Â¢Ã Â¸Â·Ã Â¸â„¢Ã Â¸Â¢Ã Â¸Â±Ã Â¸â„¢Ã Â¸Â£Ã Â¸Â«Ã Â¸Â±Ã Â¸ÂªÃ Â¸Å“Ã Â¹Ë†Ã Â¸Â²Ã Â¸â„¢Ã Â¹Æ’Ã Â¸Â«Ã Â¸Â¡Ã Â¹Ë†', 'Ã™â€ Ã˜Â¦Ã›â€™ Ã™Â¾Ã˜Â§Ã˜Â³ Ã™Ë†Ã˜Â±ÃšË† ÃšÂ©Ã›Å’ Ã˜ÂªÃ™Ë†Ã˜Â«Ã›Å’Ã™â€š', 'Ã Â¤Â¨Ã Â¤Â Ã Â¤ÂªÃ Â¤Â¾Ã Â¤Â¸Ã Â¤ÂµÃ Â¤Â°Ã Â¥ÂÃ Â¤Â¡ Ã Â¤â€¢Ã Â¥â‚¬ Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â·Ã Â¥ÂÃ Â¤Å¸Ã Â¤Â¿', 'confirma novum password', 'konfirmasi password baru', 'Ã¦â€“Â°Ã£Ââ€”Ã£Ââ€žÃ£Æ’â€˜Ã£â€šÂ¹Ã£Æ’Â¯Ã£Æ’Â¼Ã£Æ’â€°Ã£â€šâ€™Ã§Â¢ÂºÃ¨ÂªÂ', 'Ã¬Æ’Ë† Ã¬â€¢â€Ã­ËœÂ¸Ã«Â¥Â¼ Ã­â„¢â€¢Ã¬ÂÂ¸Ã­â€¢Â©Ã«â€¹Ë†Ã«â€¹Â¤'),
(204, 'update_password', 'update password', '', 'actualizar la contraseÃƒÂ±a', 'تحديث كلمة المرور', 'updaten wachtwoord', 'ÃÂ¾ÃÂ±ÃÂ½ÃÂ¾ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ ÃÂ¿ÃÂ°Ã‘â‚¬ÃÂ¾ÃÂ»Ã‘Å’', 'Ã¦â€ºÂ´Ã¦â€“Â°Ã¥Â¯â€ Ã§Â Â', 'ParolanÃ„Â±zÃ„Â± gÃƒÂ¼ncellemek', 'atualizar senha', 'frissÃƒÂ­ti jelszÃƒÂ³', 'mettre ÃƒÂ  jour le mot de passe', 'ÃŽÂµÃŽÂ½ÃŽÂ·ÃŽÂ¼ÃŽÂµÃÂÃÅ½ÃÆ’ÃŽÂµÃâ€žÃŽÂµ Ãâ€žÃŽÂ¿ÃŽÂ½ ÃŽÂºÃâ€°ÃŽÂ´ÃŽÂ¹ÃŽÂºÃÅ’ Ãâ‚¬ÃÂÃÅ’ÃÆ’ÃŽÂ²ÃŽÂ±ÃÆ’ÃŽÂ·Ãâ€š', 'Kennwort aktualisieren', 'aggiornare la password', 'Ã Â¸â€ºÃ Â¸Â£Ã Â¸Â±Ã Â¸Å¡Ã Â¸â€ºÃ Â¸Â£Ã Â¸Â¸Ã Â¸â€¡Ã Â¸Â£Ã Â¸Â«Ã Â¸Â±Ã Â¸ÂªÃ Â¸Å“Ã Â¹Ë†Ã Â¸Â²Ã Â¸â„¢', 'Ã™Â¾Ã˜Â§Ã˜Â³ Ã˜Â§Ã™Â¾ ÃšË†Ã›Å’Ã™Â¹', 'Ã Â¤ÂªÃ Â¤Â¾Ã Â¤Â¸Ã Â¤ÂµÃ Â¤Â°Ã Â¥ÂÃ Â¤Â¡ Ã Â¤â€¦Ã Â¤Â¦Ã Â¥ÂÃ Â¤Â¯Ã Â¤Â¤Ã Â¤Â¨', 'scelerisque eget', 'memperbarui sandi', 'Ã£Æ’â€˜Ã£â€šÂ¹Ã£Æ’Â¯Ã£Æ’Â¼Ã£Æ’â€°Ã£â€šâ€™Ã¦â€ºÂ´Ã¦â€“Â°', 'Ã¬â€¢â€Ã­ËœÂ¸Ã«Â¥Â¼ Ã¬â€”â€¦Ã«ÂÂ°Ã¬ÂÂ´Ã­Å Â¸'),
(205, 'teacher_dashboard', 'teacher dashboard', '', 'tablero maestro', 'المعلم، داشبوارد', 'leraar dashboard', 'Ã‘Æ’Ã‘â€¡ÃÂ¸Ã‘â€šÃÂµÃÂ»Ã‘Å’ ÃÂ¿Ã‘â‚¬ÃÂ¸ÃÂ±ÃÂ¾Ã‘â‚¬ÃÂ½ÃÂ¾ÃÂ¹ ÃÂ¿ÃÂ°ÃÂ½ÃÂµÃÂ»ÃÂ¸', 'Ã¨â‚¬ÂÃ¥Â¸Ë†Ã¤Â»ÂªÃ¨Â¡Â¨Ã¦ÂÂ¿', 'ÃƒÂ¶Ã„Å¸retmen pano', 'dashboard professor', 'tanÃƒÂ¡r mÃ…Â±szerfal', 'enseignant tableau de bord', 'Ãâ€žÃŽÂ±ÃŽÂ¼Ãâ‚¬ÃŽÂ»ÃÅ’ Ãâ€žÃâ€°ÃŽÂ½ ÃŽÂµÃŽÂºÃâ‚¬ÃŽÂ±ÃŽÂ¹ÃŽÂ´ÃŽÂµÃâ€¦Ãâ€žÃŽÂ¹ÃŽÂºÃÅ½ÃŽÂ½', 'Lehrer-Dashboard', 'dashboard insegnante', 'Ã Â¸ÂÃ Â¸Â£Ã Â¸Â°Ã Â¸â€Ã Â¸Â²Ã Â¸â„¢Ã Â¸â€žÃ Â¸Â£Ã Â¸Â¹', 'Ã˜Â§Ã˜Â³Ã˜ÂªÃ˜Â§Ã˜Â¯ ÃšË†Ã›Å’Ã˜Â´ Ã˜Â¨Ã™Ë†Ã˜Â±ÃšË†', 'Ã Â¤Â¶Ã Â¤Â¿Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â·Ã Â¤â€¢ Ã Â¤Â¡Ã Â¥Ë†Ã Â¤Â¶Ã Â¤Â¬Ã Â¥â€¹Ã Â¤Â°Ã Â¥ÂÃ Â¤Â¡', 'magister Dashboard', 'dashboard guru', 'Ã¦â€¢â„¢Ã¥Â¸Â«Ã£ÂÂ®Ã£Æ’â‚¬Ã£Æ’Æ’Ã£â€šÂ·Ã£Æ’Â¥Ã£Æ’Å“Ã£Æ’Â¼Ã£Æ’â€°', 'ÃªÂµÂÃ¬â€šÂ¬ Ã«Å’â‚¬Ã¬â€¹Å“ Ã«Â³Â´Ã«â€œÅ“'),
(206, 'backup_restore_help', 'backup restore help', '', 'copia de seguridad restaurar ayuda', 'النسخ الاحتياطي استعادة المساعدة', 'backup helpen herstellen', 'ÃÂ²ÃÂ¾Ã‘ÂÃ‘ÂÃ‘â€šÃÂ°ÃÂ½ÃÂ¾ÃÂ²ÃÂ¸Ã‘â€šÃ‘Å’ Ã‘â‚¬ÃÂµÃÂ·ÃÂµÃ‘â‚¬ÃÂ²ÃÂ½Ã‘Æ’Ã‘Å½ ÃÂºÃÂ¾ÃÂ¿ÃÂ¸Ã‘Å½ ÃÂ¿ÃÂ¾ÃÂ¼ÃÂ¾Ã‘â€°Ã‘Å’', 'Ã¥Â¤â€¡Ã¤Â»Â½Ã¦ÂÂ¢Ã¥Â¤ÂÃ§Å¡â€žÃ¥Â¸Â®Ã¥Å Â©', 'yedekleme yardÃ„Â±m geri', 'de backup restaurar ajuda', 'Backup Restore segÃƒÂ­tsÃƒÂ©gÃƒÂ©vel', 'restauration de sauvegarde de l''aide', 'ÃŽÂµÃâ‚¬ÃŽÂ±ÃŽÂ½ÃŽÂ±Ãâ€ ÃŽÂ¿ÃÂÃŽÂ¬Ãâ€š ÃŽÂ±ÃŽÂ½Ãâ€žÃŽÂ¹ÃŽÂ³ÃÂÃŽÂ¬Ãâ€ Ãâ€°ÃŽÂ½ ÃŽÂ±ÃÆ’Ãâ€ ÃŽÂ±ÃŽÂ»ÃŽÂµÃŽÂ¯ÃŽÂ±Ãâ€š ÃŽÂ²ÃŽÂ¿ÃŽÂ®ÃŽÂ¸ÃŽÂµÃŽÂ¹ÃŽÂ±', 'Backup wiederherstellen Hilfe', 'Backup Restore aiuto', 'Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸ÂªÃ Â¸Â³Ã Â¸Â£Ã Â¸Â­Ã Â¸â€¡Ã Â¸â€šÃ Â¹â€°Ã Â¸Â­Ã Â¸Â¡Ã Â¸Â¹Ã Â¸Â¥Ã Â¹â‚¬Ã Â¸Â£Ã Â¸ÂµÃ Â¸Â¢Ã Â¸ÂÃ Â¸â€žÃ Â¸Â·Ã Â¸â„¢Ã Â¸â€žÃ Â¸Â§Ã Â¸Â²Ã Â¸Â¡Ã Â¸Å Ã Â¹Ë†Ã Â¸Â§Ã Â¸Â¢Ã Â¹â‚¬Ã Â¸Â«Ã Â¸Â¥Ã Â¸Â·Ã Â¸Â­', 'Ã˜Â¨Ã›Å’ÃšÂ© Ã˜Â§Ã™Â¾ ÃšÂ©Ã›Å’ Ã™â€¦Ã˜Â¯Ã˜Â¯ Ã˜Â¨Ã˜Â­Ã˜Â§Ã™â€ž', 'Ã Â¤Â¬Ã Â¥Ë†Ã Â¤â€¢Ã Â¤â€¦Ã Â¤Âª Ã Â¤Â®Ã Â¤Â¦Ã Â¤Â¦ Ã Â¤Â¬Ã Â¤Â¹Ã Â¤Â¾Ã Â¤Â²', 'auxilium tergum restituunt', 'backup restore bantuan', 'Ã£Æ’ÂÃ£Æ’Æ’Ã£â€šÂ¯Ã£â€šÂ¢Ã£Æ’Æ’Ã£Æ’â€”Ã£Æ’ËœÃ£Æ’Â«Ã£Æ’â€”Ã£â€šâ€™Ã¥Â¾Â©Ã¥â€¦Æ’', 'Ã«Â°Â±Ã¬â€”â€¦ Ã«Ââ€žÃ¬â€ºâ‚¬Ã¬Ââ€ž Ã«Â³ÂµÃ¬â€ºÂ'),
(207, 'student_dashboard', 'student dashboard', '', 'salpicadero estudiante', 'لوحة القيادة الطالب', 'student dashboard', 'Ã‘ÂÃ‘â€šÃ‘Æ’ÃÂ´ÃÂµÃÂ½Ã‘â€š ÃÂ¿Ã‘â‚¬ÃÂ¸ÃÂ±ÃÂ¾Ã‘â‚¬ÃÂ½ÃÂ¾ÃÂ¹ ÃÂ¿ÃÂ°ÃÂ½ÃÂµÃÂ»ÃÂ¸', 'Ã¥Â­Â¦Ã§â€Å¸Ã§Å¡â€žÃ¤Â»ÂªÃ¨Â¡Â¨Ã¦ÂÂ¿', 'Ãƒâ€“Ã„Å¸renci paneli', 'dashboard estudante', 'tanulÃƒÂ³ mÃ…Â±szerfal', 'tableau de bord de l''ÃƒÂ©lÃƒÂ¨ve', 'Ãâ€žÃŽÂ±ÃŽÂ¼Ãâ‚¬ÃŽÂ»ÃÅ’ Ãâ€žÃâ€°ÃŽÂ½ Ãâ€ ÃŽÂ¿ÃŽÂ¹Ãâ€žÃŽÂ·Ãâ€žÃÅ½ÃŽÂ½', 'SchÃƒÂ¼ler Armaturenbrett', 'studente dashboard', 'Ã Â¹ÂÃ Â¸Å“Ã Â¸â€¡Ã Â¸â€žÃ Â¸Â§Ã Â¸Å¡Ã Â¸â€žÃ Â¸Â¸Ã Â¸Â¡Ã Â¸â„¢Ã Â¸Â±Ã Â¸ÂÃ Â¹â‚¬Ã Â¸Â£Ã Â¸ÂµÃ Â¸Â¢Ã Â¸â„¢', 'Ã˜Â·Ã˜Â§Ã™â€žÃ˜Â¨ Ã˜Â¹Ã™â€žÃ™â€¦ ÃšÂ©Ã›â€™ ÃšË†Ã›Å’Ã˜Â´ Ã˜Â¨Ã™Ë†Ã˜Â±ÃšË†', 'Ã Â¤â€ºÃ Â¤Â¾Ã Â¤Â¤Ã Â¥ÂÃ Â¤Â° Ã Â¤Â¡Ã Â¥Ë†Ã Â¤Â¶Ã Â¤Â¬Ã Â¥â€¹Ã Â¤Â°Ã Â¥ÂÃ Â¤Â¡', 'Discipulus Dashboard', 'dashboard mahasiswa', 'Ã¥Â­Â¦Ã§â€Å¸Ã£ÂÂ®Ã£Æ’â‚¬Ã£Æ’Æ’Ã£â€šÂ·Ã£Æ’Â¥Ã£Æ’Å“Ã£Æ’Â¼Ã£Æ’â€°', 'Ã­â€¢â„¢Ã¬Æ’Â Ã«Å’â‚¬Ã¬â€¹Å“ Ã«Â³Â´Ã«â€œÅ“'),
(208, 'parent_dashboard', 'parent dashboard', '', 'salpicadero padres', 'لوحة الأم', 'ouder dashboard', 'Ã‘â‚¬ÃÂ¾ÃÂ´ÃÂ¸Ã‘â€šÃÂµÃÂ»Ã‘Å’ ÃÂ¿Ã‘â‚¬ÃÂ¸ÃÂ±ÃÂ¾Ã‘â‚¬ÃÂ½ÃÂ¾ÃÂ¹ ÃÂ¿ÃÂ°ÃÂ½ÃÂµÃÂ»ÃÂ¸', 'Ã¥Â®Â¶Ã©â€¢Â¿Ã¤Â»ÂªÃ¨Â¡Â¨Ã¦ÂÂ¿', 'ebeveyn kontrol paneli', 'dashboard pai', 'szÃƒÂ¼lÃ…â€˜ mÃ…Â±szerfal', 'parent tableau de bord', 'ÃŽÂ¼ÃŽÂ·Ãâ€žÃÂÃŽÂ¹ÃŽÂºÃŽÂ® Ãâ€žÃŽÂ±ÃŽÂ¼Ãâ‚¬ÃŽÂ»ÃÅ’', 'Mutter Armaturenbrett', 'dashboard genitore', 'Ã Â¹ÂÃ Â¸Å“Ã Â¸â€¡Ã Â¸â€žÃ Â¸Â§Ã Â¸Å¡Ã Â¸â€žÃ Â¸Â¸Ã Â¸Â¡Ã Â¸â€šÃ Â¸Â­Ã Â¸â€¡Ã Â¸Å“Ã Â¸Â¹Ã Â¹â€°Ã Â¸â€ºÃ Â¸ÂÃ Â¸â€žÃ Â¸Â£Ã Â¸Â­Ã Â¸â€¡', 'Ã™Ë†Ã˜Â§Ã™â€žÃ˜Â¯Ã›Å’Ã™â€  ÃšÂ©Ã›â€™ ÃšË†Ã›Å’Ã˜Â´ Ã˜Â¨Ã™Ë†Ã˜Â±ÃšË†', 'Ã Â¤Â®Ã Â¤Â¾Ã Â¤Â¤Ã Â¤Â¾ - Ã Â¤ÂªÃ Â¤Â¿Ã Â¤Â¤Ã Â¤Â¾ Ã Â¤Â¡Ã Â¥Ë†Ã Â¤Â¶Ã Â¤Â¬Ã Â¥â€¹Ã Â¤Â°Ã Â¥ÂÃ Â¤Â¡', 'Dashboard parent', 'orangtua dashboard', 'Ã¨Â¦ÂªÃ£Æ’â‚¬Ã£Æ’Æ’Ã£â€šÂ·Ã£Æ’Â¥', 'Ã«Â¶â‚¬Ã«ÂªÂ¨ Ã«Å’â‚¬Ã¬â€¹Å“ Ã«Â³Â´Ã«â€œÅ“'),
(209, 'view_marks', 'view marks', '', 'Vista marcas', 'عرض علامات', 'view merken', 'ÃÂ²ÃÂ¸ÃÂ´ ÃÂ·ÃÂ½ÃÂ°ÃÂºÃÂ¸', 'Ã©â€°Â´Ã¤ÂºÅ½Ã¥â€¢â€ Ã¦Â â€¡', 'gÃƒÂ¶rÃƒÂ¼nÃƒÂ¼mÃƒÂ¼ iÃ…Å¸aretleri', 'vista marcas', 'view jelek', 'Vue marques', 'ÃÆ’ÃŽÂ®ÃŽÂ¼ÃŽÂ±Ãâ€žÃŽÂ± ÃŽÂ¬Ãâ‚¬ÃŽÂ¿ÃË†ÃŽÂ·', 'Ansicht Marken', 'Vista marchi', 'Ã Â¹â‚¬Ã Â¸â€žÃ Â¸Â£Ã Â¸Â·Ã Â¹Ë†Ã Â¸Â­Ã Â¸â€¡Ã Â¸Â«Ã Â¸Â¡Ã Â¸Â²Ã Â¸Â¢Ã Â¸Â¡Ã Â¸Â¸Ã Â¸Â¡Ã Â¸Â¡Ã Â¸Â­Ã Â¸â€¡', 'Ã˜Â¯Ã›Å’ÃšÂ©ÃšÂ¾Ã›Å’ÃšÂº Ã™â€ Ã˜Â´Ã˜Â§Ã™â€ Ã˜Â§Ã˜Âª', 'Ã Â¤Â¦Ã Â¥â€¡Ã Â¤â€“Ã Â¤Â¨Ã Â¥â€¡ Ã Â¤â€¢Ã Â¥â€¡ Ã Â¤Â¨Ã Â¤Â¿Ã Â¤Â¶Ã Â¤Â¾Ã Â¤Â¨', 'propter signa', 'lihat tanda', 'Ã£Æ’â€œÃ£Æ’Â¥Ã£Æ’Â¼Ã£Æ’Å¾Ã£Æ’Â¼Ã£â€šÂ¯', 'Ã«Â³Â´ÃªÂ¸Â° Ã«Â§Ë†Ã­ÂÂ¬'),
(210, 'delete_language', 'delete language', '', 'eliminar el lenguaje', 'حذف اللغة', 'verwijderen taal', 'Ã‘Æ’ÃÂ´ÃÂ°ÃÂ»ÃÂ¸Ã‘â€šÃ‘Å’ Ã‘ÂÃÂ·Ã‘â€¹ÃÂº', 'Ã¥Ë†Â Ã©â„¢Â¤Ã¨Â¯Â­Ã¨Â¨â‚¬', 'dili silme', 'excluir lÃƒÂ­ngua', 'tÃƒÂ¶rlÃƒÂ©se nyelv', 'supprimer la langue', 'ÃŽÂ´ÃŽÂ¹ÃŽÂ±ÃŽÂ³ÃÂÃŽÂ±Ãâ€ ÃŽÂ® ÃŽÂ³ÃŽÂ»ÃÅ½ÃÆ’ÃÆ’ÃŽÂ±', 'Sprache lÃƒÂ¶schen', 'eliminare lingua', 'Ã Â¸Â¥Ã Â¸Å¡Ã Â¸Â Ã Â¸Â²Ã Â¸Â©Ã Â¸Â²', 'Ã˜Â²Ã˜Â¨Ã˜Â§Ã™â€  ÃšÂ©Ã™Ë† Ã˜Â®Ã˜Â§Ã˜Â±Ã˜Â¬ ÃšÂ©Ã˜Â± Ã˜Â¯Ã›Å’ÃšÂº', 'Ã Â¤Â­Ã Â¤Â¾Ã Â¤Â·Ã Â¤Â¾ Ã Â¤â€¢Ã Â¥â€¹ Ã Â¤Â¹Ã Â¤Å¸Ã Â¤Â¾Ã Â¤Â¨Ã Â¤Â¾', 'linguam turpis', 'menghapus bahasa', 'Ã¨Â¨â‚¬Ã¨ÂªÅ¾Ã£â€šâ€™Ã¥â€°Å Ã©â„¢Â¤Ã£Ââ„¢Ã£â€šâ€¹', 'Ã¬â€“Â¸Ã¬â€“Â´Ã«Â¥Â¼ Ã¬â€šÂ­Ã¬Â Å“');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `bengali`, `spanish`, `arabic`, `dutch`, `russian`, `chinese`, `turkish`, `portuguese`, `hungarian`, `french`, `greek`, `german`, `italian`, `thai`, `urdu`, `hindi`, `latin`, `indonesian`, `japanese`, `korean`) VALUES
(211, 'settings_updated', 'settings updated', '', 'configuraciÃƒÂ³n actualizado', 'تم تحديث الإعدادات', 'instellingen bijgewerkt', 'ÃÂÃÂ°Ã‘ÂÃ‘â€šÃ‘â‚¬ÃÂ¾ÃÂ¹ÃÂºÃÂ¸ ÃÂ¾ÃÂ±ÃÂ½ÃÂ¾ÃÂ²ÃÂ»ÃÂµÃÂ½Ã‘â€¹', 'Ã¨Â®Â¾Ã§Â½Â®Ã¦â€ºÂ´Ã¦â€“Â°', 'ayarlarÃ„Â± gÃƒÂ¼ncellendi', 'definiÃƒÂ§ÃƒÂµes atualizadas', 'beÃƒÂ¡llÃƒÂ­tÃƒÂ¡sok frissÃƒÂ­tve', 'paramÃƒÂ¨tres mis ÃƒÂ  jour', 'ÃŽÂ¡Ãâ€¦ÃŽÂ¸ÃŽÂ¼ÃŽÂ¯ÃÆ’ÃŽÂµÃŽÂ¹Ãâ€š ÃŽÂµÃŽÂ½ÃŽÂ·ÃŽÂ¼ÃŽÂ­ÃÂÃâ€°ÃÆ’ÃŽÂ·', 'Einstellungen aktualisiert', 'impostazioni aggiornate', 'Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸â€¢Ã Â¸Â±Ã Â¹â€°Ã Â¸â€¡Ã Â¸â€žÃ Â¹Ë†Ã Â¸Â²Ã Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸â€ºÃ Â¸Â£Ã Â¸Â±Ã Â¸Å¡Ã Â¸â€ºÃ Â¸Â£Ã Â¸Â¸Ã Â¸â€¡', 'Ã˜ÂªÃ˜Â±Ã˜ÂªÃ›Å’Ã˜Â¨Ã˜Â§Ã˜Âª ÃšÂ©Ã›Å’ Ã˜ÂªÃ˜Â§Ã˜Â²Ã›Â ÃšÂ©Ã˜Â§Ã˜Â±Ã›Å’', 'Ã Â¤Â¸Ã Â¥â€¡Ã Â¤Å¸Ã Â¤Â¿Ã Â¤â€šÃ Â¤â€”Ã Â¥ÂÃ Â¤Â¸ Ã Â¤â€¦Ã Â¤Â¦Ã Â¥ÂÃ Â¤Â¯Ã Â¤Â¤Ã Â¤Â¨', 'venenatis eu', 'pengaturan diperbarui', 'Ã¨Â¨Â­Ã¥Â®Å¡Ã£ÂÅ’Ã¦â€ºÂ´Ã¦â€“Â°', 'Ã¬â€žÂ¤Ã¬Â â€¢Ã¬ÂÂ´ Ã¬â€”â€¦Ã«ÂÂ°Ã¬ÂÂ´Ã­Å Â¸'),
(212, 'update_phrase', 'update phrase', '', 'actualizaciÃƒÂ³n de la frase', 'تحديث العبارة', 'Update zin', 'ÃÂ¾ÃÂ±ÃÂ½ÃÂ¾ÃÂ²ÃÂ»ÃÂµÃÂ½ÃÂ¸ÃÂµ Ã‘â€žÃ‘â‚¬ÃÂ°ÃÂ·ÃÂ°', 'Ã¦â€ºÂ´Ã¦â€“Â°Ã§Å¸Â­Ã¨Â¯Â­', 'gÃƒÂ¼ncelleme ifade', 'atualizaÃƒÂ§ÃƒÂ£o frase', 'frissÃƒÂ­tÃƒÂ©st kifejezÃƒÂ©s', 'mise ÃƒÂ  jour phrase', 'ÃŽÂµÃŽÂ½ÃŽÂ·ÃŽÂ¼ÃŽÂ­ÃÂÃâ€°ÃÆ’ÃŽÂ· Ãâ€ ÃÂÃŽÂ¬ÃÆ’ÃŽÂ·', 'Update Begriff', 'aggiornamento frase', 'Ã Â¸â€ºÃ Â¸Â£Ã Â¸Â±Ã Â¸Å¡Ã Â¸â€ºÃ Â¸Â£Ã Â¸Â¸Ã Â¸â€¡Ã Â¸Â§Ã Â¸Â¥Ã Â¸Âµ', 'Ã˜Â§Ã™Â¾ ÃšË†Ã›Å’Ã™Â¹ Ã˜Â¬Ã™â€¦Ã™â€žÃ›Â', 'Ã Â¤â€¦Ã Â¤Â¦Ã Â¥ÂÃ Â¤Â¯Ã Â¤Â¤Ã Â¤Â¨ Ã Â¤ÂµÃ Â¤Â¾Ã Â¤â€¢Ã Â¥ÂÃ Â¤Â¯Ã Â¤Â¾Ã Â¤â€šÃ Â¤Â¶', 'eget dictum', 'frase pembaruan', 'Ã¦â€ºÂ´Ã¦â€“Â°Ã£Æ’â€¢Ã£Æ’Â¬Ã£Æ’Â¼Ã£â€šÂº', 'Ã¬â€”â€¦Ã«ÂÂ°Ã¬ÂÂ´Ã­Å Â¸ ÃªÂµÂ¬Ã«Â¬Â¸'),
(213, 'login_failed', 'login failed', '', 'Error de acceso', 'فشل تسجيل الدخول', 'inloggen is mislukt', 'ÃÅ¾Ã‘Ë†ÃÂ¸ÃÂ±ÃÂºÃÂ° ÃÂ²Ã‘â€¦ÃÂ¾ÃÂ´ÃÂ°', 'Ã§â„¢Â»Ã¥Â½â€¢Ã¥Â¤Â±Ã¨Â´Â¥', 'giriÃ…Å¸ baÃ…Å¸arÃ„Â±sÃ„Â±z oldu', 'Falha no login', 'bejelentkezÃƒÂ©s sikertelen', 'Ãƒâ€°chec de la connexion', 'ÃŽâ€¢ÃŽÂ¯ÃÆ’ÃŽÂ¿ÃŽÂ´ÃŽÂ¿Ãâ€š ÃŽÂ±Ãâ‚¬ÃŽÂ­Ãâ€žÃâ€¦Ãâ€¡ÃŽÂµ', 'Fehler bei der Anmeldung', 'Accesso non riuscito', 'Ã Â¹â‚¬Ã Â¸â€šÃ Â¹â€°Ã Â¸Â²Ã Â¸ÂªÃ Â¸Â¹Ã Â¹Ë†Ã Â¸Â£Ã Â¸Â°Ã Â¸Å¡Ã Â¸Å¡Ã Â¸Â¥Ã Â¹â€°Ã Â¸Â¡Ã Â¹â‚¬Ã Â¸Â«Ã Â¸Â¥Ã Â¸Â§', 'Ã™â€žÃ˜Â§ÃšÂ¯ Ã˜Â§Ã™â€  Ã™â€ Ã˜Â§ÃšÂ©Ã˜Â§Ã™â€¦', 'Ã Â¤Â²Ã Â¥â€°Ã Â¤â€”Ã Â¤Â¿Ã Â¤Â¨ Ã Â¤ÂµÃ Â¤Â¿Ã Â¤Â«Ã Â¤Â²', 'tincidunt defecit', 'Login gagal', 'Ã£Æ’Â­Ã£â€šÂ°Ã£â€šÂ¤Ã£Æ’Â³Ã£ÂÂ«Ã¥Â¤Â±Ã¦â€¢â€”Ã£Ââ€”Ã£ÂÂ¾Ã£Ââ€”Ã£ÂÅ¸', 'Ã«Â¡Å“ÃªÂ·Â¸Ã¬ÂÂ¸ Ã¬â€¹Â¤Ã­Å’Â¨'),
(214, 'live_chat', 'live chat', '', 'chat en vivo', 'دردشة مباشرة', 'live chat', 'ÃÅ¾ÃÂ½ÃÂ»ÃÂ°ÃÂ¹ÃÂ½-Ã‘â€¡ÃÂ°Ã‘â€š', 'Ã¥ÂÂ³Ã¦â€”Â¶Ã¨ÂÅ Ã¥Â¤Â©', 'canlÃ„Â± sohbet', 'chat ao vivo', 'ÃƒÂ©lÃ…â€˜ chat', 'chat en direct', 'live chat', 'Live-Chat', 'live chat', 'Ã Â¸Â­Ã Â¸Â¢Ã Â¸Â¹Ã Â¹Ë†Ã Â¸ÂªÃ Â¸â„¢Ã Â¸â€”Ã Â¸â„¢Ã Â¸Â²', 'Ã™â€žÃ˜Â§Ã˜Â¦Ã›Å’Ã™Ë† Ãšâ€ Ã›Å’Ã™Â¹', 'Ã Â¤Â²Ã Â¤Â¾Ã Â¤â€¡Ã Â¤Âµ Ã Â¤Å¡Ã Â¥Ë†Ã Â¤Å¸', 'Vivamus nibh', 'live chat', 'Ã£Æ’Â©Ã£â€šÂ¤Ã£Æ’â€“Ã£Æ’ÂÃ£Æ’Â£Ã£Æ’Æ’Ã£Æ’Ë†', 'Ã«ÂÂ¼Ã¬ÂÂ´Ã«Â¸Å’ Ã¬Â±â€žÃ­Å’â€¦'),
(215, 'client 1', 'client 1', '', 'cliente 1', 'العميل ', 'client 1', 'ÃÅ¡ÃÂ»ÃÂ¸ÃÂµÃÂ½Ã‘â€š 1', 'Ã¥Â®Â¢Ã¦Ë†Â·Ã§Â«Â¯1', 'istemcisi 1', 'cliente 1', 'ÃƒÂ¼gyfÃƒÂ©l 1', 'client 1', 'Ãâ‚¬ÃŽÂµÃŽÂ»ÃŽÂ¬Ãâ€žÃŽÂ· 1', 'Client 1', 'client 1', 'Ã Â¸Â¥Ã Â¸Â¹Ã Â¸ÂÃ Â¸â€žÃ Â¹â€°Ã Â¸Â² 1', 'ÃšÂ©Ã™â€žÃ˜Â§Ã˜Â¦Ã™â€ Ã™Â¹ 1', 'Ã Â¤â€”Ã Â¥ÂÃ Â¤Â°Ã Â¤Â¾Ã Â¤Â¹Ã Â¤â€¢ 1', 'I huius', 'client 1', 'Ã£â€šÂ¯Ã£Æ’Â©Ã£â€šÂ¤Ã£â€šÂ¢Ã£Æ’Â³Ã£Æ’Ë†1', 'Ã­ÂÂ´Ã«ÂÂ¼Ã¬ÂÂ´Ã¬â€“Â¸Ã­Å Â¸ 1'),
(216, 'buyer', 'buyer', '', 'comprador', 'مشتر', 'koper', 'ÃÂ¿ÃÂ¾ÃÂºÃ‘Æ’ÃÂ¿ÃÂ°Ã‘â€šÃÂµÃÂ»Ã‘Å’', 'Ã¤Â¹Â°Ã¦â€“Â¹', 'alÃ„Â±cÃ„Â±', 'comprador', 'vevÃ…â€˜', 'acheteur', 'ÃŽÂ±ÃŽÂ³ÃŽÂ¿ÃÂÃŽÂ±ÃÆ’Ãâ€žÃŽÂ®Ãâ€š', 'KÃƒÂ¤ufer', 'compratore', 'Ã Â¸Å“Ã Â¸Â¹Ã Â¹â€°Ã Â¸â€¹Ã Â¸Â·Ã Â¹â€°Ã Â¸Â­', 'Ã˜Â®Ã˜Â±Ã›Å’Ã˜Â¯Ã˜Â§Ã˜Â±', 'Ã Â¤â€“Ã Â¤Â°Ã Â¥â‚¬Ã Â¤Â¦Ã Â¤Â¦Ã Â¤Â¾Ã Â¤Â°', 'qui emit,', 'pembeli', 'Ã£Æ’ÂÃ£â€šÂ¤Ã£Æ’Â¤Ã£Æ’Â¼', 'ÃªÂµÂ¬Ã«Â§Â¤Ã¬Å¾Â'),
(217, 'purchase_code', 'purchase code', '', 'cÃƒÂ³digo de compra', 'كود شراء', 'aankoop code', 'ÃÂ¿ÃÂ¾ÃÂºÃ‘Æ’ÃÂ¿ÃÂºÃÂ° ÃÂºÃÂ¾ÃÂ´', 'Ã§â€Â³Ã¨Â´Â­Ã¤Â»Â£Ã§Â Â', 'satÃ„Â±n alma kodu', 'cÃƒÂ³digo de compra', 'vÃƒÂ¡sÃƒÂ¡rlÃƒÂ¡si kÃƒÂ³dot', 'code d''achat', 'ÃŽÅ¡Ãâ€°ÃŽÂ´ÃŽÂ¹ÃŽÂºÃÅ’Ãâ€š ÃŽÂ±ÃŽÂ³ÃŽÂ¿ÃÂÃŽÂ¬', 'Kauf-Code', 'codice di acquisto', 'Ã Â¸Â£Ã Â¸Â«Ã Â¸Â±Ã Â¸ÂªÃ Â¸ÂÃ Â¸Â²Ã Â¸Â£Ã Â¸ÂªÃ Â¸Â±Ã Â¹Ë†Ã Â¸â€¡Ã Â¸â€¹Ã Â¸Â·Ã Â¹â€°Ã Â¸Â­', 'Ã˜Â®Ã˜Â±Ã›Å’Ã˜Â¯Ã˜Â§Ã˜Â±Ã›Å’ ÃšÂ©Ã›â€™ ÃšÂ©Ã™Ë†ÃšË†', 'Ã Â¤â€“Ã Â¤Â°Ã Â¥â‚¬Ã Â¤Â¦ Ã Â¤â€¢Ã Â¥â€¹Ã Â¤Â¡', 'Mauris euismod', 'kode pembelian', 'Ã¨Â³Â¼Ã¥â€¦Â¥Ã£â€šÂ³Ã£Æ’Â¼Ã£Æ’â€°', 'ÃªÂµÂ¬Ã«Â§Â¤ Ã¬Â½â€Ã«â€œÅ“'),
(218, 'system_email', 'system email', '', 'correo electrÃƒÂ³nico del sistema', 'نظام البريد الإلكتروني', 'systeem e-mail', 'Ã‘ÂÃÂ¸Ã‘ÂÃ‘â€šÃÂµÃÂ¼ÃÂ° Ã‘ÂÃÂ»ÃÂµÃÂºÃ‘â€šÃ‘â‚¬ÃÂ¾ÃÂ½ÃÂ½ÃÂ¾ÃÂ¹ ÃÂ¿ÃÂ¾Ã‘â€¡Ã‘â€šÃ‘â€¹', 'Ã©â€šÂ®Ã¤Â»Â¶Ã§Â³Â»Ã§Â»Å¸', 'sistem e-posta', 'e-mail do sistema', 'a rendszer az e-mail', 'email de systÃƒÂ¨me', 'e-mail ÃÆ’Ãâ€¦ÃÆ’Ãâ€žÃŽÂ®ÃŽÂ¼ÃŽÂ±Ãâ€žÃŽÂ¿Ãâ€š', 'E-Mail-System', 'email sistema', 'Ã Â¸Â­Ã Â¸ÂµÃ Â¹â‚¬Ã Â¸Â¡Ã Â¸Â¥Ã Â¹Å’Ã Â¸Â£Ã Â¸Â°Ã Â¸Å¡Ã Â¸Å¡', 'Ã™â€ Ã˜Â¸Ã˜Â§Ã™â€¦ ÃšÂ©Ã›Å’ Ã˜Â§Ã›Å’ Ã™â€¦Ã›Å’Ã™â€ž', 'Ã Â¤ÂªÃ Â¥ÂÃ Â¤Â°Ã Â¤Â£Ã Â¤Â¾Ã Â¤Â²Ã Â¥â‚¬ Ã Â¤Ë†Ã Â¤Â®Ã Â¥â€¡Ã Â¤Â²', 'Praesent sit amet', 'email sistem', 'Ã£â€šÂ·Ã£â€šÂ¹Ã£Æ’â€ Ã£Æ’Â Ã£ÂÂ®Ã©â€ºÂ»Ã¥Â­ÂÃ£Æ’Â¡Ã£Æ’Â¼Ã£Æ’Â«', 'Ã¬â€¹Å“Ã¬Å Â¤Ã­â€¦Å“ Ã¬Â â€žÃ¬Å¾Â Ã«Â©â€Ã¬ÂÂ¼'),
(18512, 'welcome', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18513, 'manage_banar', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18514, 'bannar_information_page', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18515, 'add_new_bannar', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18516, 'front_end_banar', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18517, 'b_text_one', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18518, 'b_text_two', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18519, 'front_ends', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18520, 'supply_front_end_information', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18521, 'about_us', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18522, 'vision', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18523, 'mission', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18524, 'goal', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18525, 'services', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18526, 'add_banar', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18527, 'banner_text_1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18528, 'value_required', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18529, 'banner_text_2', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18530, 'save_bannar', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18531, 'image', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18532, 'data_added_successfully', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18533, 'edit_bannar', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18534, 'update_bannar', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18535, 'data_updated', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18536, 'tawk_to_code', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18537, 'youtube', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18538, 'gender', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18539, 'list_teachers', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18540, 'clickatell_activated', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18541, 'sms_to_all_users', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18542, 'list_notice', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18543, 'qualification', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18544, 'facebok', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18545, 'twitter', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18546, 'googleplus', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18547, 'linkedin', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18548, 'Document', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18549, 'facebook', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18550, 'update_teacher', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18551, 'section_information', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18552, 'add_new_section', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18553, 'section_name', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18554, 'nick_name', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18555, 'add_section', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18556, 'select_teacher', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18557, 'classs', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18558, 'add_subjects', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18559, 'list_subjects', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18560, 'list_media', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18561, 'add_media', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18562, 'add_hostel', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18563, 'capacity', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18564, 'list_hostels', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18565, 'hostel_name', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18566, 'category', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18567, 'manage_news', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18568, 'add_news', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18569, 'news_title', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18570, 'news_content', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18571, 'list_news', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18572, 'location', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18573, 'send_sms_to_all', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18574, 'activated', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18575, 'edit_notice', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18576, 'Image', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18577, 'Image', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18578, 'Image', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18579, 'data_deleted', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18580, 'edit_news', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18581, 'update_news', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18582, 'short_content', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18583, 'full_content', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18584, 'uploader', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18585, 'news_intro', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18586, 'teacher_intro', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18587, 'event_intro', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18588, 'testimonies_intro', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18589, 'add_transport_route', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18590, 'backup_now', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18591, 'list_transport_route', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18592, 'manage_email_template', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18593, 'add_email_template', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18594, 'email_type', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18595, 'from_email', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18596, 'from_name', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18597, 'email_content', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18598, 'date_added', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18599, 'list_email_templates', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18600, 'actions', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18601, 'language_information_page', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18602, 'active_language', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18603, 'all_languages', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18604, 'manage_testimony', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18605, 'manage_enquiries', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18606, 'enquiry_information_page', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18607, 'mobile', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18608, 'purpose', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18609, 'who_to_visit', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18610, 'date_submitted', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18611, 'manage_club', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18612, 'add_club', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18613, 'club_name', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18614, 'list_club', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18615, 'position', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18616, 'content', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18617, 'add_testimony', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18618, 'list_testimony', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18619, 'system_map', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18620, 'index.php?welcome', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18621, 'news', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18622, 'contact', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18623, 'manage_enquiry_category', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18624, 'list_enquiries', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18625, 'add_category', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18626, 'add_enquiry_setting', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18627, 'whom', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18628, 'save_enquiry', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18629, 'edit_enquiry_category', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18630, 'update_enquiry', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18631, 'add_loan_page', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18632, 'add_loan', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18633, 'date_application', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18634, 'applicant_id', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18635, 'select_a_user', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18636, 'accountant', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18637, 'hostel', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18638, 'applicant_name', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18639, 'accountant', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18640, 'loan_amount', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18641, 'loan_duration', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18642, 'payment_mode', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18643, 'guarantor_name', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18644, 'relationship', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18645, 'guarantor_number', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18646, 'guarantor_address', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18647, 'guanrator_country', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18648, 'collaral_name', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18649, 'collaral_type', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18650, 'collaral_model', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18651, 'collaral_make', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18652, 'serial_number', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18653, 'collateral_value', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18654, 'condition', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18655, 'collateral_documents', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18656, 'save_loan', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18657, 'list_alumni', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18658, 'add-alumni', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18659, 'graduation_year', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18660, 'school_club', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18661, 'add_alumni', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18662, 'marital_status', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18663, 'graduation_date', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18664, 'hobbies', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18665, 'publisher', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18666, 'ISBN_number', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18667, 'book_edition', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18668, 'book_subject', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18669, 'book_quantity', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18670, 'book_image', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18671, 'list_books', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18672, 'instagram', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18673, 'pinterest', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18674, 'student_information', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18675, 'get_students', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18676, 'select_class_first', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18677, 'get_student_list', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18678, 'other_student', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18679, 'all_students', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18680, 'mother_tongue', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18681, 'age', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18682, 'all_parents', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18683, 'list_parents', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18684, 'view_teacher', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18685, 'exam_marks', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18686, 'time_table', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18687, 'view_news', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18688, 'student_payments', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18689, 'helpful_links', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18690, 'help_desks', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18691, 'view_library', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18692, 'view_holidays', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18693, 'view_moral_talk', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18694, 'Update_details', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18695, 'my_children_information', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18696, 'short_about', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18697, 'full_about_us', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18698, 'student_admission_form', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18699, 'multiple_students', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18700, 'full_name', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18701, 'admission_no', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18702, 'place_birth', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18703, 'city', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18704, 'state', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18705, 'nationality', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18706, 'previous_school_name', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18707, 'purpose_of_leaving', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18708, 'class_in_which_was_studying', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18709, 'date_of_leaving', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18710, 'admission_date', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18711, 'transfer_certificate', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18712, 'birth_certificate', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18713, 'any_given_marksheet', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18714, 'physical_handicap', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18715, 'save_student', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18716, 'manage_gallery', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18717, 'add_gallery', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18718, 'list_gallery', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18719, 'gallery_name', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18720, 'Preview Image', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18721, 'media_link', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18722, 'file_type', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18723, 'select_file_type', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18724, 'Video', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18725, 'footer_text', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18726, 'register_content', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18727, 'add_session', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18728, 'list_session', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18729, 'session_name', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18730, 'manage_task_manager', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18731, 'list_tasks', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18732, 'add_task', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18733, 'task_name', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18734, 'priority', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18735, 'date_assign', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18736, 'assign_to', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18737, 'task_status', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18738, 'manage_todays_thought', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18739, 'add_thoughts', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18740, 'thought', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18741, 'add_thought', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18742, 'list_thoughts', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `librarian`
--

CREATE TABLE IF NOT EXISTS `librarian` (
  `librarian_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `birthday` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `religion` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `authentication_key` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`librarian_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `librarian`
--

INSERT INTO `librarian` (`librarian_id`, `name`, `birthday`, `sex`, `religion`, `blood_group`, `address`, `phone`, `email`, `password`, `authentication_key`) VALUES
(2, 'Kunlex Brown Xue', '07/09/2018', 'male', '', '', 'federal college of education', '08033527716', 'librarian@librarian.com', 'librarian', '');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE IF NOT EXISTS `loan` (
  `loan_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` longtext NOT NULL,
  `amount` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `purpose` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `l_duration` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mop` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `g_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `g_relationship` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `g_number` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `g_address` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `g_country` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `c_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `c_type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `model` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `make` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `serial_number` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `condition` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`loan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mark`
--

CREATE TABLE IF NOT EXISTS `mark` (
  `mark_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `mark_obtained` int(11) NOT NULL DEFAULT '0',
  `mark_total` int(11) NOT NULL DEFAULT '100',
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  `class_score` int(11) NOT NULL DEFAULT '0',
  `class_score2` int(11) NOT NULL,
  `class_score3` int(11) NOT NULL,
  `class_score4` int(11) NOT NULL,
  PRIMARY KEY (`mark_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `media_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mlink` longtext NOT NULL,
  `class_id` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `teacher_id` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`media_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_thread_code` longtext NOT NULL,
  `message` longtext NOT NULL,
  `sender` longtext NOT NULL,
  `timestamp` longtext NOT NULL,
  `read_status` int(11) NOT NULL DEFAULT '0' COMMENT '0 unread 1 read',
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- Table structure for table `message_thread`
--

CREATE TABLE IF NOT EXISTS `message_thread` (
  `message_thread_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_thread_code` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sender` longtext COLLATE utf8_unicode_ci NOT NULL,
  `reciever` longtext COLLATE utf8_unicode_ci NOT NULL,
  `last_message_timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`message_thread_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_title` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `short_content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `news_content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `uploader` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news_title`, `date`, `short_content`, `news_content`, `uploader`, `file_name`) VALUES
(14, 'BRIEF INFORMATION HOW TO ENROLL TO OUR SCHOOL', '01/18/2018', 'Responsive interface became necessity for various devices: All our sofrware are powered by a team of technical engineers proactively ensure smooth, standard and responsive software development. ', 'Like what you’re learning GET STARTED TODAY!\r\n\r\nWe are home to 1,500 students (aged 12 to 16) and 100 expert faculty and staff community representing over 40 different nations. We are proud of our international and multi-cultural ethos, the way our community collaborates to make a difference. Our world-renowned curriculum is built on the best.\r\n\r\nGlobal and US standards.We are home to 1,500 students (aged 12 to 16) and 100 expert faculty and staff.Community representing over 40 different nations. We are proud of our international.', 'Administrator', 'banner-01.jpg'),
(15, 'WHAT YOU NEED TO KNOW ABOUT OPRIMUM LINKUO', '01/15/2018', 'Responsive interface became necessity for various devices: All our sofrware are powered by a team of technical engineers proactively ensure smooth, standard and responsive software development. ', 'Responsive interface became necessity for various devices: All our sofrware are powered by a team of technical engineers proactively ensure smooth, standard and responsive software development. \r\n<br>\r\nResponsive interface became necessity for various devices: All our sofrware are powered by a team of technical engineers proactively ensure smooth, standard and responsive software development. ', 'Administrator', 'banner-03.jpg'),
(16, 'BRIEF INFORMATION HOW TO ENROLL TO OUR SCHOOL TWO', '01/15/2018', 'Responsive interface became necessity for various devices: All our sofrware are powered by a team of technical engineers proactively ensure smooth, standard and responsive software development. ', 'Responsive interface became necessity for various devices: All our sofrware are powered by a team of technical engineers proactively ensure smooth, standard and responsive software development. ', 'Administrator', 'banner-02.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `noticeboard`
--

CREATE TABLE IF NOT EXISTS `noticeboard` (
  `notice_id` int(11) NOT NULL AUTO_INCREMENT,
  `notice_title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `notice` longtext COLLATE utf8_unicode_ci NOT NULL,
  `location` longtext COLLATE utf8_unicode_ci NOT NULL,
  `create_timestamp` int(11) NOT NULL,
  PRIMARY KEY (`notice_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `noticeboard`
--

INSERT INTO `noticeboard` (`notice_id`, `notice_title`, `notice`, `location`, `create_timestamp`) VALUES
(9, 'General Meeting', 'There is going to be general PTA meeting. Please endeavour to me', 'School Campus', 1515888000);

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE IF NOT EXISTS `parent` (
  `parent_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `profession` longtext COLLATE utf8_unicode_ci NOT NULL,
  `authentication_key` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`parent_id`, `name`, `email`, `password`, `phone`, `address`, `profession`, `authentication_key`) VALUES
(1, 'Parent Saxin Xue', 'parent@parent.com', 'parent', '08033527716', 'federal college of education', 'Lecturer', '');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_category_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `payment_type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `method` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `amount` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE IF NOT EXISTS `publisher` (
  `publisher_id` int(11) NOT NULL AUTO_INCREMENT,
  `publisher_name` longtext NOT NULL,
  `description` longtext NOT NULL,
  PRIMARY KEY (`publisher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`publisher_id`, `publisher_name`, `description`) VALUES
(6, 'Optimum Developer', 'Developed by Optimum Linkup Computers. All Right Reserved (2017) '),
(7, 'Optimum Developer', 'Developed by Optimum Linkup Computers. All Right Reserved (2017) ');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `session` varchar(255) DEFAULT NULL,
  `question_count` int(11) DEFAULT NULL,
  `duration` int(5) DEFAULT NULL,
  `question` text,
  `correct_answers` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE IF NOT EXISTS `room_type` (
  `room_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext NOT NULL,
  `description` longtext NOT NULL,
  PRIMARY KEY (`room_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`room_type_id`, `name`, `description`) VALUES
(2, 'One Bed', 'This room is for one bed and one person'),
(3, 'Two Beds', 'This room is for two beds and two persons');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `section_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `nick_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`section_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `name`, `nick_name`, `class_id`, `teacher_id`) VALUES
(1, 'First Term', '1', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `session_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`session_id`, `name`) VALUES
(3, '2016-2017'),
(4, '2017-2018'),
(5, '2018-2019'),
(6, '2019-2020'),
(7, '2020-2021'),
(8, '2021-2022'),
(9, '2022-2023'),
(10, '2023-2024'),
(11, '2024-2025'),
(12, '2025-2026'),
(13, '2026-2027'),
(14, '2027-2028'),
(15, '2028-2029'),
(16, '2029-2030');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES
(1, 'system_name', 'OPTIMUM LINKUP SCHOOL SYSTEMS'),
(2, 'system_title', 'OPTIMUM SCHOOL SYSTEM'),
(3, 'address', '546, SILICON VALLEY TORONTO, CANADA'),
(4, 'phone', '+1564783934'),
(5, 'paypal_email', 'optimumproblemsolver@gmail.com'),
(6, 'currency', '$'),
(7, 'system_email', 'optimumproblemsolver@gmail.com'),
(20, 'active_sms_service', 'clickatell'),
(11, 'language', 'english'),
(12, 'text_align', 'left-to-right'),
(13, 'clickatell_user', ''),
(14, 'clickatell_password', ''),
(15, 'clickatell_api_id', ''),
(16, 'skin_colour', 'default'),
(17, 'twilio_account_sid', ''),
(18, 'twilio_auth_token', ''),
(19, 'twilio_sender_phone_number', ''),
(21, 'session', '2016-2017'),
(22, 'footer', 'Developed by Optimum Linkup Computers. All Right Reserved (2017)'),
(23, 'smsteams_user', ''),
(24, 'smsteams_password', ''),
(25, 'smsteams_api_id', ''),
(26, 'tawkto', '<script type="text/javascript">\r\nvar Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n(function(){\r\nvar s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];\r\ns1.async=true;\r\ns1.src=''https://embed.tawk.to/588e0fa6af9fa11e7aa44047/default'';\r\ns1.charset=''UTF-8'';\r\ns1.setAttribute(''crossorigin'',''*'');\r\ns0.parentNode.insertBefore(s1,s0);\r\n})();\r\n</script>');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `birthday` longtext COLLATE utf8_unicode_ci NOT NULL,
  `age` longtext COLLATE utf8_unicode_ci NOT NULL,
  `place_birth` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext COLLATE utf8_unicode_ci NOT NULL,
  `m_tongue` longtext COLLATE utf8_unicode_ci NOT NULL,
  `religion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `city` longtext COLLATE utf8_unicode_ci NOT NULL,
  `state` longtext COLLATE utf8_unicode_ci NOT NULL,
  `nationality` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `ps_attend` longtext COLLATE utf8_unicode_ci NOT NULL,
  `ps_address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `ps_purpose` longtext COLLATE utf8_unicode_ci NOT NULL,
  `class_study` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date_of_leaving` longtext COLLATE utf8_unicode_ci NOT NULL,
  `am_date` longtext COLLATE utf8_unicode_ci NOT NULL,
  `tran_cert` longtext COLLATE utf8_unicode_ci NOT NULL,
  `dob_cert` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mark_join` longtext COLLATE utf8_unicode_ci NOT NULL,
  `physical_h` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `father_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mother_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `class_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `section_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `roll` longtext COLLATE utf8_unicode_ci NOT NULL,
  `transport_id` int(11) NOT NULL,
  `dormitory_id` int(11) NOT NULL,
  `session` longtext COLLATE utf8_unicode_ci NOT NULL,
  `card_number` longtext COLLATE utf8_unicode_ci NOT NULL,
  `issue_date` longtext COLLATE utf8_unicode_ci NOT NULL,
  `expire_date` longtext COLLATE utf8_unicode_ci NOT NULL,
  `dormitory_room_number` longtext COLLATE utf8_unicode_ci NOT NULL,
  `authentication_key` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `name`, `class_id`, `teacher_id`) VALUES
(1, 'Mathematics', 1, 2),
(2, 'English', 2, 3),
(3, 'Economics', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `task_manager`
--

CREATE TABLE IF NOT EXISTS `task_manager` (
  `task_manager_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `priority` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`task_manager_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `birthday` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext COLLATE utf8_unicode_ci NOT NULL,
  `religion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `facebook` longtext COLLATE utf8_unicode_ci NOT NULL,
  `twitter` longtext COLLATE utf8_unicode_ci NOT NULL,
  `googleplus` longtext COLLATE utf8_unicode_ci NOT NULL,
  `linkedin` longtext COLLATE utf8_unicode_ci NOT NULL,
  `qualification` longtext COLLATE utf8_unicode_ci NOT NULL,
  `file_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `authentication_key` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `name`, `birthday`, `sex`, `religion`, `blood_group`, `address`, `phone`, `email`, `facebook`, `twitter`, `googleplus`, `linkedin`, `qualification`, `file_name`, `password`, `authentication_key`) VALUES
(2, 'Teacher', '06/16/1960', 'male', 'Christianity', 'O+', 'Address of teacher here all the tme', '+2348033527716', 'teacher@teacher.com', 'www.facebook.com/optimumlinkup', 'www.twitter.com/optimumlinkup', 'www.googleplus.com/optimumlinkup', 'www.linkedin.com/optimumlinkup', 'PhD', 'mr kina.docx', 'teacher', ''),
(3, 'Kelly Xue', '04/26/2015', 'female', 'Christianity', 'A+', 'Adrress Here', '+23445465576', 'myteacher@yahoo.com', 'www.facebook.com/optimumlinkup', 'www.facebook.com/optimumlinkup', 'www.facebook.com/optimumlinkup', 'www.facebook.com/optimumlinkup', 'Master', 'barimage.bmp', 'myteacher', '');

-- --------------------------------------------------------

--
-- Table structure for table `testimony`
--

CREATE TABLE IF NOT EXISTS `testimony` (
  `testimony_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `position` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`testimony_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `testimony`
--

INSERT INTO `testimony` (`testimony_id`, `name`, `position`, `content`) VALUES
(2, 'Kunlex Xue Lee', 'Teacher', 'I really love this school. It has been one of the best school so far. We love working with you. Thanks and God bless all of us. Amen'),
(3, 'Optimum', 'Admin', 'We really love this school. It has been one of the best school so far. We love working with you. Thanks and God bless all of us. Amen');

-- --------------------------------------------------------

--
-- Table structure for table `todays_thought`
--

CREATE TABLE IF NOT EXISTS `todays_thought` (
  `tthought_id` int(11) NOT NULL AUTO_INCREMENT,
  `thought` longtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tthought_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `transport`
--

CREATE TABLE IF NOT EXISTS `transport` (
  `transport_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `transport_route_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `number_of_vehicle` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `route_fare` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`transport_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `transport_route`
--

CREATE TABLE IF NOT EXISTS `transport_route` (
  `transport_route_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext NOT NULL,
  `description` longtext NOT NULL,
  PRIMARY KEY (`transport_route_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE IF NOT EXISTS `vehicle` (
  `vehicle_id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_no` longtext NOT NULL,
  `vehicle_model` longtext NOT NULL,
  `year_made` longtext NOT NULL,
  `driver_name` longtext NOT NULL,
  `driver_license` longtext NOT NULL,
  `driver_contact` longtext NOT NULL,
  `status` longtext NOT NULL,
  `description` longtext NOT NULL,
  `name` longtext NOT NULL,
  PRIMARY KEY (`vehicle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
