-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2019 at 02:44 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `smarttrackerdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_methods`
--

CREATE TABLE IF NOT EXISTS `action_methods` (
  `action_method_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `action_method_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`action_method_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `action_methods`
--

INSERT INTO `action_methods` (`action_method_id`, `action_method_name`) VALUES
(1, 'In Person'),
(2, 'Phone'),
(3, 'E-mail'),
(4, 'Fax'),
(5, 'Mail'),
(6, 'Left Message'),
(7, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `deptno` int(11) NOT NULL AUTO_INCREMENT,
  `dept` varchar(256) NOT NULL,
  PRIMARY KEY (`deptno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`deptno`, `dept`) VALUES
(1, 'Accountancy'),
(2, 'Computer Science'),
(3, 'Computer Engineering'),
(4, 'ICT'),
(5, 'Bursary'),
(6, 'Rector'),
(10, 'Marketing'),
(11, 'Library Science');

-- --------------------------------------------------------

--
-- Table structure for table `edoc`
--

CREATE TABLE IF NOT EXISTS `edoc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_no` varchar(64) NOT NULL,
  `docname` varchar(256) NOT NULL,
  `attachment` varchar(64) NOT NULL,
  `remark` text NOT NULL,
  `department` varchar(64) NOT NULL,
  `owner` varchar(16) NOT NULL,
  `current_handler` varchar(64) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `edoc`
--

INSERT INTO `edoc` (`id`, `ref_no`, `docname`, `attachment`, `remark`, `department`, `owner`, `current_handler`, `datecreated`) VALUES
(1, 'ACC/19/02/123', 'ACCOUNTING', '', '$file_err', 'Accountancy', 'ss102', 'ss102', '2019-04-16 20:10:13'),
(2, 'BAM/19/02/111', 'BUSINESS MANAGEMENT', '', 'electronic', 'Accountancy', 'ss102', 'ss104', '2019-04-16 20:14:02'),
(3, 'AIFPU/CSC/SIWES/01/10', '2019 SIWES RESULT', '', 'This is for onward publishing', 'Computer Engineering', 'ss102', 'ss102', '2019-08-02 11:59:15'),
(4, 'FGN/OAGF/IPPIS/08/01', 'IPPIS ENROLLMENT', '', 'New ippis enrollment notice', 'Computer Science', 'ss103', 'ss102', '2019-08-02 14:04:21'),
(5, '1/2/3/asd', 'aaaaa', '', 'aaaaaaaa', 'Computer Engineering', 'ss103', 'ss104', '2019-08-02 15:29:43'),
(6, '1/2/3/asd', 'aaaaa', '', 'aaa', 'Accountancy', 'ss103', 'ss104', '2019-08-02 16:37:15'),
(7, '1/2/3/asd', 'aaaaa', '', 'zzzzzzzz', 'Computer Science', 'ss103', 'ss104', '2019-08-02 16:39:17'),
(8, 'ict1010', 'ictttttttt', 'CCD CIRCULAR - Creative Industry Financing.pdf', 'aaaaaa', 'Accountancy', 'ss103', 'ss103', '2019-08-02 17:46:39'),
(9, 'ict1010', 'ictttttttt', 'CCD CIRCULAR - Creative Industry Financing.pdf', 'aaaaaaaaaaa', 'Accountancy', 'ss103', 'ss103', '2019-08-02 17:47:15'),
(10, '1/2/3/asd', 'ictttttttt', 'uploads/CCD CIRCULAR - Creative Industry Financing.pdf', 'aaaaaaaaaaaaa', 'ICT', 'ss103', 'ss104', '2019-08-02 22:24:43'),
(11, 'AIFPU/EED/PRACTICAL/2019/01', 'PRACTICAL ON EED', 'uploads/EED PRACTICAL MANUAL.docx', 'eed', 'ICT', 'ss103', 'ss101', '2019-08-02 22:27:44'),
(12, 'AIFPU/EED/PRACTICAL/2019/01', 'PRACTICAL ON EED', 'uploads/CCD CIRCULAR - Creative Industry Financing.pdf', 'aaaaa', 'ICT', 'ss103', 'ss101', '2019-08-02 22:44:27'),
(13, 'FGN/OAGF/IPPIS/08/01', 'IPPIS ENROLLMENT', 'uploads/INTRANET VIRTUAL SYSTEM FOR PGM CLASSES & LAB.docx', 'aaaaaaaaaaaaaaaaaa', 'ICT', 'ss103', 'ss102', '2019-08-02 22:46:25'),
(14, 'BAM/19/02/111', 'BUSINESS MANAGEMENT', 'uploads/CCD.pdf', 'thanks', 'Accountancy', 'ss102', 'ss104', '2019-08-04 19:49:51'),
(15, 'FGN/AGF/NBTE/08/01', 'DISBURSEMENT OF 25B TO POLYTECHNICS', 'uploads/Outlook.pst', 'N/B', 'Accountancy', 'ss101', 'ss102', '2019-08-05 11:00:10');

-- --------------------------------------------------------

--
-- Table structure for table `emovement`
--

CREATE TABLE IF NOT EXISTS `emovement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_no` varchar(32) NOT NULL,
  `owner` varchar(64) NOT NULL,
  `sender` varchar(64) NOT NULL,
  `recipient` varchar(64) NOT NULL,
  `location` varchar(32) NOT NULL,
  `doctype` varchar(32) NOT NULL,
  `file` varchar(64) NOT NULL,
  `status` varchar(32) NOT NULL,
  `remark` varchar(64) NOT NULL,
  `date_sent` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `emovement`
--

INSERT INTO `emovement` (`id`, `ref_no`, `owner`, `sender`, `recipient`, `location`, `doctype`, `file`, `status`, `remark`, `date_sent`) VALUES
(1, 'FGN/OAGF/IPPIS/08/01', 'ss103', 'ss103', 'ss102', '0', '0', '', '0', '0', '2019-08-02 22:59:54'),
(2, '1/2/3/asd', 'ss103', 'ss103', 'ss104', 'ICT', 'electronic', '', 'Not Recieved', 'aaaaaaaaa', '2019-08-02 23:08:09'),
(3, 'AIFPU/EED/PRACTICAL/2019/01', 'ss103', 'ss103', 'ss101', 'Computer Science', 'electronic', 'uploads/CCD CIRCULAR - Creative Industry Financing.pdf', 'Not Recieved', 'aaaaaaaaaa', '2019-08-02 23:34:40'),
(4, 'BAM/19/02/111', 'ss102', 'ss102', 'ss104', 'ICT', 'electronic', 'uploads/CCD.pdf', 'Not Recieved', 'aaaaaaaa', '2019-08-04 19:52:30'),
(5, 'FGN/AGF/NBTE/08/01', 'ss101', 'ss101', 'ss102', 'Bursary', 'electronic', 'uploads/Outlook.pst', 'Not Recieved', 'Plse, bring to the notice of all staff', '2019-08-05 11:00:52');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `location` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location`) VALUES
('Bursary Unit'),
('ICT Unit'),
('Maths/Statistic'),
('Computer Sceince Dept'),
('Enterprenuership'),
('Civil Engineering'),
('Accountancy');

-- --------------------------------------------------------

--
-- Table structure for table `movement`
--

CREATE TABLE IF NOT EXISTS `movement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_no` varchar(32) NOT NULL,
  `docname` varchar(64) NOT NULL,
  `owner` varchar(64) NOT NULL,
  `sender` varchar(64) NOT NULL,
  `recipient` varchar(64) NOT NULL,
  `location` varchar(32) NOT NULL,
  `doctype` varchar(32) NOT NULL,
  `status` varchar(32) NOT NULL,
  `remark` varchar(64) NOT NULL,
  `date_sent` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `movement`
--

INSERT INTO `movement` (`id`, `ref_no`, `docname`, `owner`, `sender`, `recipient`, `location`, `doctype`, `status`, `remark`, `date_sent`) VALUES
(1, 'EED/2019/02/101', 'ENTERPRENUESHIP SKILL ACQUISITION FOR STUDENTS', '', 'ss102', '', 'Bursary', 'Paper', 'Not Recieved', 'Warning: mysqli_stmt_close() expects parameter 1 to be mysqli_st', '2019-04-15 17:25:17'),
(2, 'EED/2019/02/101', 'ENTERPRENUESHIP SKILL ACQUISITION FOR STUDENTS', 'ss102 (Chukwu, Nkechi)', 'ss102', 'ss103 (Umeh, Zita)', 'Bursary', 'Paper', 'Not Recieved', 'recipient', '2019-04-15 17:33:26'),
(3, 'ICT/2019/03/041', '', '', 'ss102', 'ss101', '', 'Paper', 'Not Recieved', 'recipient', '2019-04-16 16:18:07'),
(4, 'ICT/2019/03/041', 'Computer Training', 'ss102', 'ss102', 'ss104', 'ICT', 'Paper', 'Not Recieved', '$_SESSION[''location'']', '2019-04-16 18:00:21'),
(5, 'ICT/2019/03/041', 'Computer Training', 'ss102', 'ss102', 'ss101', 'Computer Science', 'Paper', 'Not Recieved', 'echo "<script type=''text/javascript''>location.href = ''index.php''', '2019-04-16 19:12:55'),
(6, 'ACC/19/02/123', 'ACCOUNTING', 'ss102', 'ss102', 'ss101', 'Computer Science', 'Paper', 'Not Recieved', '_e', '2019-04-16 20:43:32'),
(7, 'ACC/19/02/123', 'ACCOUNTING', 'ss102', 'ss102', 'ss101', 'Computer Science', 'Paper', 'Not Recieved', '_e_e_e_e_e_e_e_e_e_e_e', '2019-04-16 20:44:59'),
(8, 'ACC/19/02/123', 'ACCOUNTING', 'ss102', 'ss102', 'ss101', 'Computer Science', 'Paper', 'Not Recieved', 'plse, advice', '2019-04-16 23:25:14'),
(9, 'ACC/19/02/123', 'ACCOUNTING', 'ss102', 'ss102', 'ss101', 'Computer Science', 'Paper', 'Not Recieved', 'plse, advice the Rector', '2019-04-16 23:31:33'),
(10, 'ICT/2019/03/041', 'Computer Training', 'ss102', 'ss102', 'ss104', 'ICT', 'Paper', 'Not Recieved', 'Please, advice', '2019-08-02 11:57:14'),
(11, 'AIFPU/EED/PRACTICAL/2019/01', 'PRACTICAL ON EED', 'ss102', 'ss102', 'ss104', 'ICT', 'Paper', 'Not Recieved', 'REMEMBER TO FORWARD TO THE DEPUTY RECTOR', '2019-08-02 12:18:14'),
(12, 'AIFPU/EED/PRACTICAL/2019/01', 'PRACTICAL ON EED', 'ss102', 'ss102', 'ss104', 'ICT', 'Paper', 'Not Recieved', 'URGENT', '2019-08-02 12:35:29'),
(13, 'AIFPU/EED/PRACTICAL/2019/01', 'PRACTICAL ON EED', 'ss102', 'ss102', 'ss104', 'ICT', 'Paper', 'Not Recieved', 'emergency', '2019-08-02 13:02:34'),
(14, 'AIFPU/EED/PRACTICAL/2019/01', 'PRACTICAL ON EED', 'ss102', 'ss102', 'ss104', 'ICT', 'Paper', 'Not Recieved', 'testing', '2019-08-02 13:08:51'),
(15, 'AIFPU/EED/PRACTICAL/2019/01', 'PRACTICAL ON EED', 'ss102', 'ss103', 'ss102', 'Bursary', 'Paper', 'Not Recieved', 'kiv', '2019-08-02 13:56:14'),
(16, 'FGN/OAGF/IPPIS/08/01', 'IPPIS ENROLLMENT', 'ss103', 'ss103', 'ss102', 'Bursary', 'Paper', 'Not Recieved', 'ippis reminder', '2019-08-02 14:05:18'),
(17, 'ICT/2019/03/041', 'Computer Training', 'ss102', 'ss102', 'ss103', 'Bursary', 'Paper', 'Not Recieved', 'take care', '2019-08-05 12:25:34'),
(18, 'AIFPU/EED/PRACTICAL/2019/01', 'PRACTICAL ON EED', 'ss102', 'ss102', 'ss104', 'ICT', 'Paper', 'Not Recieved', 'take acre', '2019-08-05 12:26:46'),
(19, 'BUR/2019/04/10', 'Payment of Promotion Arrears', 'ss102', 'ss102', 'ss104', 'ICT', 'Paper', 'Not Recieved', 'asddd', '2019-08-05 13:03:29'),
(20, 'ICT/2019/03/041', 'Computer Training', 'ss102', 'ss103', 'ss104', 'ICT', 'Paper', 'Not Recieved', 'kiv', '2019-08-05 13:19:40'),
(24, 'csc111', 'computer science project', 'ss101', 'ss101', 'ss103', 'Bursary', 'Paper', 'Not Recieved', 'teeeeeeeeeeeeeeeeeeeeeting', '2019-08-12 11:37:19'),
(25, 'EED/2019/02/101', 'ENTERPRENUESHIP SKILL ACQUISITION FOR STUDENTS', 'ss102', 'ss101', 'ss103', 'Bursary', 'Paper', 'Not Recieved', 'testttttttttttttttttttt', '2019-08-12 11:54:53'),
(26, 'EED/2019/02/101', 'ENTERPRENUESHIP SKILL ACQUISITION FOR STUDENTS', 'ss102', 'ss101', 'ss104', 'ICT', 'Paper', 'Not Recieved', 'ttttttttttt', '2019-08-12 12:05:35'),
(27, 'EED/2019/02/101', 'ENTERPRENUESHIP SKILL ACQUISITION FOR STUDENTS', 'ss102', 'ss101', 'ss103', 'Bursary', 'Paper', 'Not Recieved', 'ttttttttttt', '2019-08-12 12:19:00'),
(28, 'EED/2019/02/101', 'ENTERPRENUESHIP SKILL ACQUISITION FOR STUDENTS', 'ss102', 'ss101', 'ss103', 'Bursary', 'Paper', 'Not Recieved', 'ttttttttttt', '2019-08-12 12:21:25'),
(29, 'EED/2019/02/101', 'ENTERPRENUESHIP SKILL ACQUISITION FOR STUDENTS', 'ss102', 'ss101', 'ss103', 'Bursary', 'Paper', 'Not Recieved', 'ttttttttttt', '2019-08-12 12:26:06'),
(30, 'EED/2019/02/101', 'ENTERPRENUESHIP SKILL ACQUISITION FOR STUDENTS', 'ss102', 'ss101', 'ss104', 'ICT', 'Paper', 'Not Recieved', 'tttttttttttttt', '2019-08-12 12:26:30'),
(31, 'EED/2019/02/101', 'ENTERPRENUESHIP SKILL ACQUISITION FOR STUDENTS', 'ss102', 'ss101', 'ss104', 'ICT', 'Paper', 'Not Recieved', 'aaaaaaaaaaa', '2019-08-12 12:47:07'),
(32, 'EED/2019/02/101', 'ENTERPRENUESHIP SKILL ACQUISITION FOR STUDENTS', 'ss102', 'ss101', 'ss103', 'Bursary', 'Paper', 'Not Recieved', 'ssssssssssss', '2019-08-12 13:26:19'),
(33, 'EED/2019/02/101', 'ENTERPRENUESHIP SKILL ACQUISITION FOR STUDENTS', 'ss102', 'ss101', 'ss103', 'Bursary', 'Paper', 'Not Recieved', 'ssssssssssssssssss', '2019-08-12 13:30:07'),
(34, 'EED/2019/02/101', 'ENTERPRENUESHIP SKILL ACQUISITION FOR STUDENTS', 'ss102', 'ss101', 'ss102', 'Bursary', 'Paper', 'Not Recieved', 'ssssssssssssssss', '2019-08-12 13:32:29'),
(35, 'EED/2019/02/101', 'ENTERPRENUESHIP SKILL ACQUISITION FOR STUDENTS', 'ss102', 'ss101', 'ss102', 'Bursary', 'Paper', 'Not Recieved', 'ddddddddddddddd', '2019-08-12 13:33:58'),
(36, 'EED/2019/02/101', 'ENTERPRENUESHIP SKILL ACQUISITION FOR STUDENTS', 'ss102', 'ss101', 'ss104', 'ICT', 'Paper', 'Not Recieved', 'ddddddddddddd', '2019-08-12 14:19:03'),
(37, 'EED/2019/02/101', 'ENTERPRENUESHIP SKILL ACQUISITION FOR STUDENTS', 'ss102', 'ss101', 'ss104', 'ICT', 'Paper', 'Not Recieved', 'eeeeeeeeeeeeeeeee', '2019-08-12 14:32:20'),
(38, 'EED/2019/02/101', 'ENTERPRENUESHIP SKILL ACQUISITION FOR STUDENTS', 'ss102', 'ss101', 'ss104', 'ICT', 'Paper', 'Not Recieved', 'eeeeeeeeeeeeeeeee', '2019-08-12 14:34:26'),
(39, 'EED/2019/02/101', 'ENTERPRENUESHIP SKILL ACQUISITION FOR STUDENTS', 'ss102', 'ss101', 'ss104', 'ICT', 'Paper', 'Not Recieved', 'ggggggggggggggg', '2019-08-12 14:43:02');

-- --------------------------------------------------------

--
-- Table structure for table `paper`
--

CREATE TABLE IF NOT EXISTS `paper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_no` varchar(64) NOT NULL,
  `docname` varchar(256) NOT NULL,
  `remark` text NOT NULL,
  `department` varchar(64) NOT NULL,
  `owner` varchar(16) NOT NULL,
  `current_handler` varchar(64) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `paper`
--

INSERT INTO `paper` (`id`, `ref_no`, `docname`, `remark`, `department`, `owner`, `current_handler`, `datecreated`) VALUES
(1, 'csc111', 'computer science project', 'for all project supervisors', 'Computer Science', 'ss101', 'ss103', '2019-04-02 21:56:32'),
(2, 'EED/2019/02/101', 'ENTERPRENUESHIP SKILL ACQUISITION FOR STUDENTS', 'Based Enterprenuership center want the HOD''s to bring this to the notice of all students', 'ICT', 'ss102', 'ss101', '2019-04-15 01:40:29'),
(3, 'ICT/2019/03/041', 'Computer Training', 'For All interested Staff', 'ICT', 'ss102', 'ss104', '2019-04-15 01:43:35'),
(4, 'BUR/2019/04/10', 'Payment of Promotion Arrears', 'Bring to the notice of all those promoted', 'Bursary', 'ss102', 'ss104', '2019-04-16 09:01:38'),
(5, 'AIFPU/EED/PRACTICAL/2019/01', 'PRACTICAL ON EED', 'PLEASE ATTEND IMMEDIATELY', 'ICT', 'ss102', 'ss104', '2019-08-02 12:15:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `staff_no` varchar(12) NOT NULL,
  `surname` varchar(256) NOT NULL,
  `othernames` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `dept` varchar(256) NOT NULL,
  `role` varchar(256) NOT NULL DEFAULT 'user',
  `phone` varchar(256) NOT NULL,
  `date_reg` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`staff_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`staff_no`, `surname`, `othernames`, `email`, `password`, `dept`, `role`, `phone`, `date_reg`) VALUES
('admin', 'OKORO', 'Steven', 'admin@admin.com', '$2y$10$lKrwd9js1Oswr66LaLOAs.t2c5SVbl3CEjxBdcMMA/t8akkAllbXq', 'ICT', 'admin', '08014521452', '2019-08-19 12:29:40'),
('ss100', 'Emereonye', 'Kingsley', 'ikechukwuchinenye@gmail.com', '$2y$10$TTrZxpgM6mcDoTNJnaUeT.7KaB/LStohn18qEi7uGp7BPLQMKv2L2', 'Marketing', 'user', '08061111070', '2019-08-20 13:05:13'),
('ss101', 'Nwachukwu', 'Joseph', 'holyaustin@yahoo.com', '$2y$10$oXkYuD1lnP0cY6DbbUj.n.Z5B.oskaMtolC344d.lIeLRznrdFbze', 'Computer Science', 'user', '07036947457', '2019-04-02 14:41:58'),
('ss102', 'Chukwu', 'Nkechi', 'holyaustin@gmail.com', '$2y$10$oXkYuD1lnP0cY6DbbUj.n.Z5B.oskaMtolC344d.lIeLRznrdFbze', 'Bursary', 'user', '08036160991', '2019-04-02 14:47:04'),
('ss103', 'Umeh', 'Zita', 'holyaustin@gmail.com', '$2y$10$nCqHbh2wxRYj/KVF8ptA1Owr88bGk0m6CMqLlp3EdT4QtjKM5ifVq', 'Bursary', 'user', '08036160991', '2019-04-02 14:50:05'),
('ss104', 'OKORO', 'Stanley', 'holyaustin@gmail.com', '$2y$10$IXLXe6AExR2SJQFoIuAD1.R8XJk99tZ3IMq6ZZH4QPc.tH2KO5SR2', 'ICT', 'user', '08036160991', '2019-04-02 14:51:46'),
('ss111', 'joseph', 'jacob', 'ikechukwuchinenye@gmail.com', '$2y$10$p3LEIXok22lV2MnH209OdezFnqPRM1mG6jaNyKiDmkCL2nt.XbtlG', 'Library Science', 'user', '08061111070', '2019-08-20 13:13:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
