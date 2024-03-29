-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 27, 2014 at 02:29 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gbdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE IF NOT EXISTS `business` (
  `business_id` int(255) NOT NULL AUTO_INCREMENT,
  `owner_id` int(255) NOT NULL,
  `link_id` int(255) NOT NULL,
  `rating` double NOT NULL,
  `num_users` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `customer_id` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `branding_url` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `organization` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `connection_id` int(255) NOT NULL,
  `subscription_plan` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `address` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `business_latitude` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `business_longitude` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `question_array` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`business_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`business_id`, `owner_id`, `link_id`, `rating`, `num_users`, `customer_id`, `branding_url`, `organization`, `connection_id`, `subscription_plan`, `address`, `business_latitude`, `business_longitude`, `question_array`) VALUES
(1, 1, 1, 0, '', '', 'branding/logo with type-01.png', 'GetBack', 1, 'le', '102 Country Club Road, 172B Graham, Chapel Hill, NC 27514', '35.9133756', '-79.0463324', '5,3,4,2,1'),
(2, 4, 2, 0, '', '', 'branding/tinani.jpg', 'Tina''s Pigs', 2, 'smb', '515 Hinton James Drive, Hinton James #906D, Chapel Hill, NC 27514', '35.9023903', '-79.0431799', '1,2,3,4,5');

-- --------------------------------------------------------

--
-- Table structure for table `connections`
--

CREATE TABLE IF NOT EXISTS `connections` (
  `connection_id` int(255) NOT NULL AUTO_INCREMENT,
  `business_id` int(255) NOT NULL,
  `state` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `city` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `company_type` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `industry_type` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `business_size` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`connection_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `connections`
--

INSERT INTO `connections` (`connection_id`, `business_id`, `state`, `city`, `company_type`, `industry_type`, `business_size`) VALUES
(1, 1, 'NC', 'Chapel Hill', '', 'TECHNOLOGY', 'le'),
(2, 2, 'NC', 'Chapel Hill', '', 'FARMING', 'smb');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(255) NOT NULL AUTO_INCREMENT,
  `business_id` int(255) NOT NULL,
  `user_latitude` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `user_longitude` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `user_date` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `user_time` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `response_id` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=92 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `business_id`, `user_latitude`, `user_longitude`, `user_date`, `user_time`, `response_id`) VALUES
(1, 1, '36.1606737', '-79.81004469999999', '2013-12-01', '09:37:18 am', '1,2,3,4,5'),
(2, 1, '36.1607007', '-79.8099663', '2013-12-01', '09:38:52 am', '6,7,8,9,10'),
(3, 1, '35.9131742', '-79.0465241', '2013-12-02', '06:21:23 am', '11,12,13,14,15'),
(4, 1, '35.7781614', '-78.6386168', '2013-12-08', '07:11:29 pm', '16,17,18,19,20'),
(5, 1, '35.7781635', '-78.638629', '2013-12-08', '07:49:15 pm', '21,22,23,24,25'),
(6, 1, '', '', '2013-12-08', '07:49:43 pm', '26,27,28,29,30'),
(7, 1, '', '', '2013-12-11', '10:41:56 pm', '31,32,33,34,35'),
(8, 1, '', '', '2013-12-11', '10:42:03 pm', '36,37,38,39,40'),
(9, 1, '', '', '2013-12-12', '12:13:22 am', '41,42,43,44,45'),
(10, 1, '', '', '2013-12-12', '01:34:58 am', '46,47,48,49,50'),
(11, 1, '', '', '2013-12-12', '01:35:07 am', '51,52,53,54,55'),
(12, 1, '', '', '2013-12-12', '01:35:15 am', '56,57,58,59,60'),
(13, 1, '', '', '2013-12-12', '02:09:22 am', '61,62,63,64,65'),
(14, 1, '', '', '2013-12-12', '04:05:09 am', '66,67,68,69,70'),
(15, 1, '', '', '2013-12-12', '04:05:22 am', '71,72,73,74,75'),
(16, 1, '', '', '2013-12-12', '04:06:49 am', '76,77,78,79,80'),
(17, 1, '', '', '2013-12-12', '04:07:13 am', '81,82,83,84,85'),
(18, 1, '', '', '2013-12-12', '04:08:50 am', '86,87,88,89,90'),
(19, 1, '', '', '2014-03-10', '01:52:45 am', '91,92,93,94,95'),
(20, 2, '', '', '2014-03-10', '08:02:17 am', '96,97,98,99,100'),
(21, 2, '', '', '2014-03-10', '08:02:41 am', '101,102,103,104,105'),
(22, 1, '', '', '2014-03-10', '02:38:04 pm', '106,107,108,109,110'),
(23, 1, '', '', '2014-03-09', '03:05:27 pm', '111,112,113,114,115'),
(24, 1, '', '', '2014-03-09', '03:05:35 pm', '116,117,118,119,120'),
(25, 1, '', '', '2014-03-09', '03:05:44 pm', '121,122,123,124,125'),
(26, 1, '', '', '2014-03-08', '04:06:29 pm', '126,127,128,129,130'),
(27, 1, '', '', '2014-03-08', '04:06:31 pm', '131,132,133,134,135'),
(28, 1, '', '', '2014-03-08', '04:06:40 pm', '136,137,138,139,140'),
(29, 1, '', '', '2014-03-08', '04:06:51 pm', '141,142,143,144,145'),
(30, 1, '', '', '2014-03-08', '04:07:01 pm', '146,147,148,149,150'),
(31, 1, '', '', '2014-03-07', '04:07:25 pm', '151,152,153,154,155'),
(32, 1, '', '', '2014-03-10', '03:20:26 pm', '156,157,158,159,160'),
(33, 1, '', '', '2014-03-10', '03:22:33 pm', '161,162,163,164,165'),
(34, 1, '', '', '2014-03-11', '04:43:40 am', '166,167,168,169,170'),
(35, 1, '', '', '2014-03-11', '05:25:54 am', '171,172,173,174,175'),
(36, 1, '', '', '2014-03-11', '06:33:47 am', '176,177,178,179,180'),
(37, 1, '', '', '2014-03-11', '06:36:37 am', '181,182,183,184,185'),
(38, 1, '', '', '2014-03-11', '06:37:08 am', '186,187,188,189,190'),
(39, 1, '', '', '2014-03-11', '06:45:54 am', '191,192,193,194,195'),
(40, 1, '', '', '2014-03-11', '07:51:02 am', '196,197,198,199,200'),
(41, 1, '', '', '2014-03-11', '08:28:01 am', '201,202,203,204,205'),
(42, 1, '', '', '2014-03-11', '08:28:37 am', '206,207,208,209,210'),
(43, 1, '', '', '2014-03-11', '08:35:28 am', '211,212,213,214,215'),
(44, 1, '', '', '2014-03-11', '08:37:43 am', '216,217,218,219,220'),
(45, 1, '', '', '2014-03-11', '08:42:05 am', '221,222,223,224,225'),
(46, 1, '', '', '2014-03-11', '05:25:49 pm', '226,227,228,229,230'),
(47, 1, '', '', '2014-03-12', '03:53:18 am', '231,232,233,234,235'),
(48, 2, '', '', '2014-03-12', '09:21:21 pm', '236,237,238,239,240'),
(49, 2, '', '', '2014-03-12', '09:21:41 pm', '241,242,243,244,245'),
(50, 1, '', '', '2014-03-13', '08:59:33 am', '246,247,248,249,250'),
(51, 2, '', '', '2014-03-13', '09:03:43 am', '251,252,253,254,255'),
(52, 1, '', '', '2014-03-15', '06:04:12 am', '256,257,258,259,260'),
(53, 1, '', '', '2014-03-15', '06:04:37 am', '261,262,263,264,265'),
(54, 1, '', '', '2014-03-15', '06:04:41 am', '266,267,268,269,270'),
(55, 1, '', '', '2014-03-15', '06:04:56 am', '271,272,273,274,275'),
(56, 1, '', '', '2014-03-15', '06:05:58 am', '276,277,278,279,280'),
(57, 1, '', '', '2014-03-15', '06:06:10 am', '281,282,283,284,285'),
(58, 1, '', '', '2014-03-15', '06:06:22 am', '286,287,288,289,290'),
(59, 1, '', '', '2014-03-15', '06:06:36 am', '291,292,293,294,295'),
(60, 1, '', '', '2014-03-15', '06:06:48 am', '296,297,298,299,300'),
(61, 1, '', '', '2014-03-14', '06:07:48 am', '301,302,303,304,305'),
(62, 1, '', '', '2014-03-14', '06:07:57 am', '306,307,308,309,310'),
(63, 1, '', '', '2014-03-14', '06:08:05 am', '311,312,313,314,315'),
(64, 1, '', '', '2014-03-14', '06:08:13 am', '316,317,318,319,320'),
(65, 1, '', '', '2014-03-14', '06:08:24 am', '321,322,323,324,325'),
(66, 1, '', '', '2014-03-15', '10:34:03 pm', '326,327,328,329,330'),
(67, 2, '', '', '2014-03-16', '12:37:59 am', '331,332,333,334,335'),
(68, 1, '', '', '2014-03-16', '02:43:56 am', '336,337,338,339,340'),
(69, 1, '', '', '2014-03-21', '04:01:41 am', '341,342,343,344,345'),
(70, 1, '', '', '2014-03-25', '02:12:16 pm', '346,347,348,349,350'),
(71, 1, '', '', '2014-03-25', '02:12:44 pm', '351,352,353,354,355'),
(72, 1, '', '', '2014-03-25', '02:13:42 pm', '356,357,358,359,360'),
(73, 1, '', '', '2014-03-25', '02:21:59 pm', '361,362,363,364,365'),
(74, 1, '', '', '2014-03-26', '04:54:32 pm', '366,367,368,369,370'),
(75, 1, '', '', '2014-03-26', '04:54:46 pm', '371,372,373,374,375'),
(76, 1, '', '', '2014-03-24', '04:56:22 pm', '376,377,378,379,380'),
(77, 1, '', '', '2014-03-24', '04:56:46 pm', '381,382,383,384,385'),
(78, 1, '', '', '2014-03-24', '04:56:56 pm', '386,387,388,389,390'),
(79, 1, '', '', '2014-03-23', '04:57:40 pm', '391,392,393,394,395'),
(80, 1, '', '', '2014-03-23', '04:57:57 pm', '396,397,398,399,400'),
(81, 1, '', '', '2014-03-22', '04:58:39 pm', '401,402,403,404,405'),
(82, 1, '', '', '2014-03-22', '04:58:48 pm', '406,407,408,409,410'),
(83, 1, '', '', '2014-03-22', '04:58:57 pm', '411,412,413,414,415'),
(84, 1, '', '', '2014-03-22', '04:59:06 pm', '416,417,418,419,420'),
(85, 1, '', '', '2014-03-22', '04:59:17 pm', '421,422,423,424,425'),
(86, 1, '', '', '2014-03-21', '05:00:05 pm', '426,427,428,429,430'),
(87, 1, '', '', '2014-03-21', '05:00:14 pm', '431,432,433,434,435'),
(88, 1, '', '', '2014-03-21', '05:00:23 pm', '436,437,438,439,440'),
(89, 1, '', '', '2014-03-21', '05:00:33 pm', '441,442,443,444,445'),
(90, 1, '', '', '2014-03-21', '05:00:49 pm', '446,447,448,449,450'),
(91, 1, '', '', '2014-03-20', '05:01:49 pm', '451,452,453,454,455');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `link_id` int(255) NOT NULL AUTO_INCREMENT,
  `link` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `business_id` int(255) NOT NULL,
  `page_hits` int(255) NOT NULL,
  `surveys_taken` int(255) NOT NULL,
  PRIMARY KEY (`link_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`link_id`, `link`, `business_id`, `page_hits`, `surveys_taken`) VALUES
(1, 'YWKiEd4Fmh', 1, 399, 85),
(2, 'qxDDLYkU3y', 2, 13, 6);

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE IF NOT EXISTS `owners` (
  `owner_id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `first_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `last_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `business_id` int(255) NOT NULL,
  PRIMARY KEY (`owner_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`owner_id`, `username`, `password`, `first_name`, `last_name`, `email`, `business_id`) VALUES
(1, 'aditya', '265719f4e7ee032fe4a0c5ed5735a0530545e4f35c8648155dc5450330327e2a', 'Aditya', 'Badve', 'badvead@gmail.com', 1),
(2, 'andrew', 'd979885447a413abb6d606a5d0f45c3b7809e6fde2c83f0df3426f1fc9bfed97', 'Andrew', 'Plotnikov', 'aplotnikov95@gmail.com', 0),
(3, 'adhish', '4d7836286e8ac94ca57eabfc3f467892c8ae22c2a9fd6ad53b3293c8f20918d9', 'Adhish', 'Pendharkar', 'admin@adhimarg.com', 0),
(4, 'tina', 'd148bfa1bbe1ce4635f6bc654de582708d6efff9815b4ed28bd49b688830d194', 'Tina', 'Ni', 'nit@live.unc.edu', 2);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` int(255) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `frequency` int(255) NOT NULL,
  `industry_type` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `question`, `frequency`, `industry_type`, `date_created`) VALUES
(1, 'Was our staff helpful?', 91, 'STAFF', '2014-03-07'),
(2, 'Did you get what you needed?', 91, 'FACILITIES', '2014-03-07'),
(3, 'Were our facilities clean?', 91, 'FACILITIES', '2014-03-07'),
(4, 'Would you come back?', 91, 'AQUISITION', '2014-03-07'),
(5, 'Would you recommend this place?', 91, 'AQUISITION', '2014-03-07');

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE IF NOT EXISTS `responses` (
  `response_id` int(255) NOT NULL AUTO_INCREMENT,
  `question_id` int(255) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `business_id` int(255) NOT NULL,
  `answer` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `response_date` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `response_time` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`response_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=456 ;

--
-- Dumping data for table `responses`
--

INSERT INTO `responses` (`response_id`, `question_id`, `customer_id`, `business_id`, `answer`, `response_date`, `response_time`) VALUES
(1, 1, 1, 1, 'yes', '2013-12-01', '09:37:18 am'),
(2, 2, 1, 1, 'yes', '2013-12-01', '09:37:18 am'),
(3, 3, 1, 1, 'yes', '2013-12-01', '09:37:18 am'),
(4, 4, 1, 1, 'yes', '2013-12-01', '09:37:18 am'),
(5, 5, 1, 1, 'yes', '2013-12-01', '09:37:18 am'),
(6, 1, 2, 1, 'yes', '2013-12-01', '09:38:52 am'),
(7, 2, 2, 1, 'yes', '2013-12-01', '09:38:52 am'),
(8, 3, 2, 1, 'yes', '2013-12-01', '09:38:52 am'),
(9, 4, 2, 1, 'yes', '2013-12-01', '09:38:52 am'),
(10, 5, 2, 1, 'yes', '2013-12-01', '09:38:52 am'),
(11, 1, 3, 1, 'yes', '2013-12-02', '06:21:23 am'),
(12, 2, 3, 1, 'yes', '2013-12-02', '06:21:23 am'),
(13, 3, 3, 1, 'yes', '2013-12-02', '06:21:23 am'),
(14, 4, 3, 1, 'yes', '2013-12-02', '06:21:23 am'),
(15, 5, 3, 1, 'yes', '2013-12-02', '06:21:23 am'),
(16, 1, 4, 1, 'yes', '2013-12-08', '07:11:29 pm'),
(17, 2, 4, 1, 'no', '2013-12-08', '07:11:29 pm'),
(18, 3, 4, 1, 'yes', '2013-12-08', '07:11:29 pm'),
(19, 4, 4, 1, 'yes', '2013-12-08', '07:11:29 pm'),
(20, 5, 4, 1, 'yes', '2013-12-08', '07:11:29 pm'),
(21, 5, 5, 1, 'yes', '2013-12-08', '07:49:15 pm'),
(22, 3, 5, 1, 'yes', '2013-12-08', '07:49:15 pm'),
(23, 4, 5, 1, 'yes', '2013-12-08', '07:49:15 pm'),
(24, 2, 5, 1, 'yes', '2013-12-08', '07:49:15 pm'),
(25, 1, 5, 1, 'yes', '2013-12-08', '07:49:15 pm'),
(26, 5, 6, 1, 'yes', '2013-12-08', '07:49:43 pm'),
(27, 3, 6, 1, 'yes', '2013-12-08', '07:49:43 pm'),
(28, 4, 6, 1, 'yes', '2013-12-08', '07:49:43 pm'),
(29, 2, 6, 1, 'yes', '2013-12-08', '07:49:43 pm'),
(30, 1, 6, 1, 'yes', '2013-12-08', '07:49:43 pm'),
(31, 5, 7, 1, 'yes', '2013-12-11', '10:41:56 pm'),
(32, 3, 7, 1, 'yes', '2013-12-11', '10:41:56 pm'),
(33, 4, 7, 1, 'yes', '2013-12-11', '10:41:56 pm'),
(34, 2, 7, 1, 'yes', '2013-12-11', '10:41:56 pm'),
(35, 1, 7, 1, 'yes', '2013-12-11', '10:41:56 pm'),
(36, 5, 8, 1, 'yes', '2013-12-11', '10:42:03 pm'),
(37, 3, 8, 1, 'yes', '2013-12-11', '10:42:03 pm'),
(38, 4, 8, 1, 'yes', '2013-12-11', '10:42:03 pm'),
(39, 2, 8, 1, 'yes', '2013-12-11', '10:42:03 pm'),
(40, 1, 8, 1, 'yes', '2013-12-11', '10:42:03 pm'),
(41, 5, 9, 1, 'no', '2013-12-12', '12:13:22 am'),
(42, 3, 9, 1, 'no', '2013-12-12', '12:13:22 am'),
(43, 4, 9, 1, 'no', '2013-12-12', '12:13:22 am'),
(44, 2, 9, 1, 'no', '2013-12-12', '12:13:22 am'),
(45, 1, 9, 1, 'no', '2013-12-12', '12:13:22 am'),
(46, 5, 10, 1, 'no', '2013-12-12', '01:34:58 am'),
(47, 3, 10, 1, 'no', '2013-12-12', '01:34:58 am'),
(48, 4, 10, 1, 'no', '2013-12-12', '01:34:58 am'),
(49, 2, 10, 1, 'no', '2013-12-12', '01:34:58 am'),
(50, 1, 10, 1, 'no', '2013-12-12', '01:34:58 am'),
(51, 5, 11, 1, 'no', '2013-12-12', '01:35:07 am'),
(52, 3, 11, 1, 'no', '2013-12-12', '01:35:07 am'),
(53, 4, 11, 1, 'no', '2013-12-12', '01:35:07 am'),
(54, 2, 11, 1, 'no', '2013-12-12', '01:35:07 am'),
(55, 1, 11, 1, 'no', '2013-12-12', '01:35:07 am'),
(56, 5, 12, 1, 'no', '2013-12-12', '01:35:15 am'),
(57, 3, 12, 1, 'no', '2013-12-12', '01:35:15 am'),
(58, 4, 12, 1, 'no', '2013-12-12', '01:35:15 am'),
(59, 2, 12, 1, 'no', '2013-12-12', '01:35:15 am'),
(60, 1, 12, 1, 'no', '2013-12-12', '01:35:15 am'),
(61, 5, 13, 1, 'yes', '2013-12-12', '02:09:22 am'),
(62, 3, 13, 1, 'yes', '2013-12-12', '02:09:22 am'),
(63, 4, 13, 1, 'yes', '2013-12-12', '02:09:22 am'),
(64, 2, 13, 1, 'yes', '2013-12-12', '02:09:22 am'),
(65, 1, 13, 1, 'yes', '2013-12-12', '02:09:22 am'),
(66, 5, 14, 1, 'yes', '2013-12-12', '04:05:09 am'),
(67, 3, 14, 1, '', '2013-12-12', '04:05:09 am'),
(68, 4, 14, 1, '', '2013-12-12', '04:05:09 am'),
(69, 2, 14, 1, '', '2013-12-12', '04:05:09 am'),
(70, 1, 14, 1, '', '2013-12-12', '04:05:09 am'),
(71, 5, 15, 1, 'yes', '2013-12-12', '04:05:22 am'),
(72, 3, 15, 1, 'yes', '2013-12-12', '04:05:22 am'),
(73, 4, 15, 1, 'yes', '2013-12-12', '04:05:22 am'),
(74, 2, 15, 1, 'yes', '2013-12-12', '04:05:22 am'),
(75, 1, 15, 1, 'yes', '2013-12-12', '04:05:22 am'),
(76, 5, 16, 1, 'yes', '2013-12-12', '04:06:49 am'),
(77, 3, 16, 1, 'yes', '2013-12-12', '04:06:49 am'),
(78, 4, 16, 1, 'yes', '2013-12-12', '04:06:49 am'),
(79, 2, 16, 1, 'yes', '2013-12-12', '04:06:49 am'),
(80, 1, 16, 1, 'yes', '2013-12-12', '04:06:49 am'),
(81, 5, 17, 1, 'yes', '2013-12-12', '04:07:13 am'),
(82, 3, 17, 1, 'yes', '2013-12-12', '04:07:13 am'),
(83, 4, 17, 1, 'yes', '2013-12-12', '04:07:13 am'),
(84, 2, 17, 1, 'yes', '2013-12-12', '04:07:13 am'),
(85, 1, 17, 1, 'yes', '2013-12-12', '04:07:13 am'),
(86, 5, 18, 1, 'yes', '2013-12-12', '04:08:50 am'),
(87, 3, 18, 1, 'yes', '2013-12-12', '04:08:50 am'),
(88, 4, 18, 1, 'yes', '2013-12-12', '04:08:50 am'),
(89, 2, 18, 1, 'yes', '2013-12-12', '04:08:50 am'),
(90, 1, 18, 1, 'yes', '2013-12-12', '04:08:50 am'),
(91, 5, 19, 1, 'yes', '2014-03-10', '01:52:45 am'),
(92, 3, 19, 1, 'no', '2014-03-10', '01:52:45 am'),
(93, 4, 19, 1, 'yes', '2014-03-10', '01:52:45 am'),
(94, 2, 19, 1, 'yes', '2014-03-10', '01:52:45 am'),
(95, 1, 19, 1, 'yes', '2014-03-10', '01:52:45 am'),
(96, 1, 20, 2, 'yes', '2014-03-10', '08:02:17 am'),
(97, 2, 20, 2, 'yes', '2014-03-10', '08:02:17 am'),
(98, 3, 20, 2, 'yes', '2014-03-10', '08:02:17 am'),
(99, 4, 20, 2, 'yes', '2014-03-10', '08:02:17 am'),
(100, 5, 20, 2, 'yes', '2014-03-10', '08:02:17 am'),
(101, 1, 21, 2, 'no', '2014-03-10', '08:02:41 am'),
(102, 2, 21, 2, 'yes', '2014-03-10', '08:02:41 am'),
(103, 3, 21, 2, 'no', '2014-03-10', '08:02:41 am'),
(104, 4, 21, 2, 'yes', '2014-03-10', '08:02:41 am'),
(105, 5, 21, 2, 'yes', '2014-03-10', '08:02:41 am'),
(106, 5, 22, 1, 'no', '2014-03-10', '02:38:04 pm'),
(107, 3, 22, 1, 'yes', '2014-03-10', '02:38:04 pm'),
(108, 4, 22, 1, 'no', '2014-03-10', '02:38:04 pm'),
(109, 2, 22, 1, 'yes', '2014-03-10', '02:38:04 pm'),
(110, 1, 22, 1, 'no', '2014-03-10', '02:38:04 pm'),
(111, 5, 23, 1, 'yes', '2014-03-09', '03:05:27 pm'),
(112, 3, 23, 1, 'yes', '2014-03-09', '03:05:27 pm'),
(113, 4, 23, 1, 'no', '2014-03-09', '03:05:27 pm'),
(114, 2, 23, 1, 'yes', '2014-03-09', '03:05:27 pm'),
(115, 1, 23, 1, 'yes', '2014-03-09', '03:05:27 pm'),
(116, 5, 24, 1, 'no', '2014-03-09', '03:05:35 pm'),
(117, 3, 24, 1, 'no', '2014-03-09', '03:05:35 pm'),
(118, 4, 24, 1, 'no', '2014-03-09', '03:05:35 pm'),
(119, 2, 24, 1, 'no', '2014-03-09', '03:05:35 pm'),
(120, 1, 24, 1, 'no', '2014-03-09', '03:05:35 pm'),
(121, 5, 25, 1, 'no', '2014-03-09', '03:05:44 pm'),
(122, 3, 25, 1, 'yes', '2014-03-09', '03:05:44 pm'),
(123, 4, 25, 1, 'yes', '2014-03-09', '03:05:44 pm'),
(124, 2, 25, 1, 'no', '2014-03-09', '03:05:44 pm'),
(125, 1, 25, 1, 'yes', '2014-03-09', '03:05:44 pm'),
(126, 5, 26, 1, 'yes', '2014-03-08', '04:06:29 pm'),
(127, 3, 26, 1, 'yes', '2014-03-08', '04:06:29 pm'),
(128, 4, 26, 1, 'yes', '2014-03-08', '04:06:29 pm'),
(129, 2, 26, 1, 'yes', '2014-03-08', '04:06:29 pm'),
(130, 1, 26, 1, 'yes', '2014-03-08', '04:06:29 pm'),
(131, 5, 27, 1, 'yes', '2014-03-08', '04:06:31 pm'),
(132, 3, 27, 1, 'yes', '2014-03-08', '04:06:31 pm'),
(133, 4, 27, 1, 'yes', '2014-03-08', '04:06:31 pm'),
(134, 2, 27, 1, 'yes', '2014-03-08', '04:06:31 pm'),
(135, 1, 27, 1, 'yes', '2014-03-08', '04:06:31 pm'),
(136, 5, 28, 1, 'yes', '2014-03-08', '04:06:40 pm'),
(137, 3, 28, 1, 'yes', '2014-03-08', '04:06:40 pm'),
(138, 4, 28, 1, 'no', '2014-03-08', '04:06:40 pm'),
(139, 2, 28, 1, 'yes', '2014-03-08', '04:06:40 pm'),
(140, 1, 28, 1, 'yes', '2014-03-08', '04:06:40 pm'),
(141, 5, 29, 1, 'no', '2014-03-08', '04:06:51 pm'),
(142, 3, 29, 1, 'yes', '2014-03-08', '04:06:51 pm'),
(143, 4, 29, 1, 'yes', '2014-03-08', '04:06:51 pm'),
(144, 2, 29, 1, 'no', '2014-03-08', '04:06:51 pm'),
(145, 1, 29, 1, 'no', '2014-03-08', '04:06:51 pm'),
(146, 5, 30, 1, 'no', '2014-03-08', '04:07:01 pm'),
(147, 3, 30, 1, 'yes', '2014-03-08', '04:07:01 pm'),
(148, 4, 30, 1, 'no', '2014-03-08', '04:07:01 pm'),
(149, 2, 30, 1, 'yes', '2014-03-08', '04:07:01 pm'),
(150, 1, 30, 1, 'no', '2014-03-08', '04:07:01 pm'),
(151, 5, 31, 1, 'yes', '2014-03-07', '04:07:25 pm'),
(152, 3, 31, 1, 'yes', '2014-03-07', '04:07:25 pm'),
(153, 4, 31, 1, 'yes', '2014-03-07', '04:07:25 pm'),
(154, 2, 31, 1, 'yes', '2014-03-07', '04:07:25 pm'),
(155, 1, 31, 1, 'yes', '2014-03-07', '04:07:25 pm'),
(156, 5, 32, 1, 'yes', '2014-03-10', '03:20:26 pm'),
(157, 3, 32, 1, 'yes', '2014-03-10', '03:20:26 pm'),
(158, 4, 32, 1, 'yes', '2014-03-10', '03:20:26 pm'),
(159, 2, 32, 1, 'yes', '2014-03-10', '03:20:26 pm'),
(160, 1, 32, 1, 'yes', '2014-03-10', '03:20:26 pm'),
(161, 5, 33, 1, 'no', '2014-03-10', '03:22:33 pm'),
(162, 3, 33, 1, 'yes', '2014-03-10', '03:22:33 pm'),
(163, 4, 33, 1, 'no', '2014-03-10', '03:22:33 pm'),
(164, 2, 33, 1, 'yes', '2014-03-10', '03:22:33 pm'),
(165, 1, 33, 1, 'yes', '2014-03-10', '03:22:33 pm'),
(166, 5, 34, 1, 'yes', '2014-03-11', '04:43:40 am'),
(167, 3, 34, 1, 'yes', '2014-03-11', '04:43:40 am'),
(168, 4, 34, 1, 'yes', '2014-03-11', '04:43:40 am'),
(169, 2, 34, 1, 'yes', '2014-03-11', '04:43:40 am'),
(170, 1, 34, 1, 'yes', '2014-03-11', '04:43:40 am'),
(171, 5, 35, 1, '', '2014-03-11', '05:25:54 am'),
(172, 3, 35, 1, '', '2014-03-11', '05:25:54 am'),
(173, 4, 35, 1, '', '2014-03-11', '05:25:54 am'),
(174, 2, 35, 1, '', '2014-03-11', '05:25:54 am'),
(175, 1, 35, 1, '', '2014-03-11', '05:25:54 am'),
(176, 5, 36, 1, 'yes', '2014-03-11', '06:33:47 am'),
(177, 3, 36, 1, 'yes', '2014-03-11', '06:33:47 am'),
(178, 4, 36, 1, 'no', '2014-03-11', '06:33:47 am'),
(179, 2, 36, 1, 'yes', '2014-03-11', '06:33:47 am'),
(180, 1, 36, 1, 'no', '2014-03-11', '06:33:47 am'),
(181, 5, 37, 1, 'yes', '2014-03-11', '06:36:37 am'),
(182, 3, 37, 1, 'no', '2014-03-11', '06:36:37 am'),
(183, 4, 37, 1, 'yes', '2014-03-11', '06:36:37 am'),
(184, 2, 37, 1, 'yes', '2014-03-11', '06:36:37 am'),
(185, 1, 37, 1, 'yes', '2014-03-11', '06:36:37 am'),
(186, 5, 38, 1, 'yes', '2014-03-11', '06:37:08 am'),
(187, 3, 38, 1, 'yes', '2014-03-11', '06:37:08 am'),
(188, 4, 38, 1, 'yes', '2014-03-11', '06:37:08 am'),
(189, 2, 38, 1, 'yes', '2014-03-11', '06:37:08 am'),
(190, 1, 38, 1, 'yes', '2014-03-11', '06:37:08 am'),
(191, 5, 39, 1, 'yes', '2014-03-11', '06:45:54 am'),
(192, 3, 39, 1, 'no', '2014-03-11', '06:45:54 am'),
(193, 4, 39, 1, 'yes', '2014-03-11', '06:45:54 am'),
(194, 2, 39, 1, 'no', '2014-03-11', '06:45:54 am'),
(195, 1, 39, 1, 'yes', '2014-03-11', '06:45:54 am'),
(196, 5, 40, 1, 'yes', '2014-03-11', '07:51:02 am'),
(197, 3, 40, 1, 'yes', '2014-03-11', '07:51:02 am'),
(198, 4, 40, 1, 'yes', '2014-03-11', '07:51:02 am'),
(199, 2, 40, 1, 'yes', '2014-03-11', '07:51:02 am'),
(200, 1, 40, 1, 'yes', '2014-03-11', '07:51:02 am'),
(201, 5, 41, 1, 'yes', '2014-03-11', '08:28:01 am'),
(202, 3, 41, 1, 'yes', '2014-03-11', '08:28:01 am'),
(203, 4, 41, 1, 'yes', '2014-03-11', '08:28:01 am'),
(204, 2, 41, 1, 'yes', '2014-03-11', '08:28:01 am'),
(205, 1, 41, 1, 'yes', '2014-03-11', '08:28:01 am'),
(206, 5, 42, 1, 'yes', '2014-03-11', '08:28:37 am'),
(207, 3, 42, 1, 'no', '2014-03-11', '08:28:37 am'),
(208, 4, 42, 1, 'yes', '2014-03-11', '08:28:37 am'),
(209, 2, 42, 1, 'no', '2014-03-11', '08:28:37 am'),
(210, 1, 42, 1, 'yes', '2014-03-11', '08:28:37 am'),
(211, 5, 43, 1, 'yes', '2014-03-11', '08:35:28 am'),
(212, 3, 43, 1, 'yes', '2014-03-11', '08:35:28 am'),
(213, 4, 43, 1, 'yes', '2014-03-11', '08:35:28 am'),
(214, 2, 43, 1, 'yes', '2014-03-11', '08:35:28 am'),
(215, 1, 43, 1, 'yes', '2014-03-11', '08:35:28 am'),
(216, 5, 44, 1, 'no', '2014-03-11', '08:37:43 am'),
(217, 3, 44, 1, 'yes', '2014-03-11', '08:37:43 am'),
(218, 4, 44, 1, 'yes', '2014-03-11', '08:37:43 am'),
(219, 2, 44, 1, 'no', '2014-03-11', '08:37:43 am'),
(220, 1, 44, 1, 'yes', '2014-03-11', '08:37:43 am'),
(221, 5, 45, 1, 'yes', '2014-03-11', '08:42:05 am'),
(222, 3, 45, 1, 'yes', '2014-03-11', '08:42:05 am'),
(223, 4, 45, 1, 'yes', '2014-03-11', '08:42:05 am'),
(224, 2, 45, 1, 'yes', '2014-03-11', '08:42:05 am'),
(225, 1, 45, 1, 'yes', '2014-03-11', '08:42:05 am'),
(226, 5, 46, 1, 'yes', '2014-03-11', '05:25:49 pm'),
(227, 3, 46, 1, 'yes', '2014-03-11', '05:25:49 pm'),
(228, 4, 46, 1, 'yes', '2014-03-11', '05:25:49 pm'),
(229, 2, 46, 1, 'yes', '2014-03-11', '05:25:49 pm'),
(230, 1, 46, 1, 'yes', '2014-03-11', '05:25:49 pm'),
(231, 5, 47, 1, 'yes', '2014-03-12', '03:53:18 am'),
(232, 3, 47, 1, 'yes', '2014-03-12', '03:53:18 am'),
(233, 4, 47, 1, 'yes', '2014-03-12', '03:53:18 am'),
(234, 2, 47, 1, 'yes', '2014-03-12', '03:53:18 am'),
(235, 1, 47, 1, 'yes', '2014-03-12', '03:53:18 am'),
(236, 1, 48, 2, 'yes', '2014-03-12', '09:21:21 pm'),
(237, 2, 48, 2, 'no', '2014-03-12', '09:21:21 pm'),
(238, 3, 48, 2, 'yes', '2014-03-12', '09:21:21 pm'),
(239, 4, 48, 2, 'yes', '2014-03-12', '09:21:21 pm'),
(240, 5, 48, 2, 'yes', '2014-03-12', '09:21:21 pm'),
(241, 1, 49, 2, 'yes', '2014-03-12', '09:21:41 pm'),
(242, 2, 49, 2, 'no', '2014-03-12', '09:21:41 pm'),
(243, 3, 49, 2, 'no', '2014-03-12', '09:21:41 pm'),
(244, 4, 49, 2, 'yes', '2014-03-12', '09:21:41 pm'),
(245, 5, 49, 2, 'no', '2014-03-12', '09:21:41 pm'),
(246, 5, 50, 1, 'yes', '2014-03-13', '08:59:33 am'),
(247, 3, 50, 1, 'yes', '2014-03-13', '08:59:33 am'),
(248, 4, 50, 1, 'yes', '2014-03-13', '08:59:33 am'),
(249, 2, 50, 1, 'yes', '2014-03-13', '08:59:33 am'),
(250, 1, 50, 1, 'yes', '2014-03-13', '08:59:33 am'),
(251, 1, 51, 2, 'yes', '2014-03-13', '09:03:43 am'),
(252, 2, 51, 2, 'yes', '2014-03-13', '09:03:43 am'),
(253, 3, 51, 2, 'yes', '2014-03-13', '09:03:43 am'),
(254, 4, 51, 2, 'yes', '2014-03-13', '09:03:43 am'),
(255, 5, 51, 2, 'yes', '2014-03-13', '09:03:43 am'),
(256, 5, 52, 1, 'yes', '2014-03-15', '06:04:12 am'),
(257, 3, 52, 1, 'yes', '2014-03-15', '06:04:12 am'),
(258, 4, 52, 1, 'yes', '2014-03-15', '06:04:12 am'),
(259, 2, 52, 1, 'no', '2014-03-15', '06:04:12 am'),
(260, 1, 52, 1, 'yes', '2014-03-15', '06:04:12 am'),
(261, 5, 53, 1, 'yes', '2014-03-15', '06:04:37 am'),
(262, 3, 53, 1, 'yes', '2014-03-15', '06:04:37 am'),
(263, 4, 53, 1, 'yes', '2014-03-15', '06:04:37 am'),
(264, 2, 53, 1, 'yes', '2014-03-15', '06:04:37 am'),
(265, 1, 53, 1, 'yes', '2014-03-15', '06:04:37 am'),
(266, 5, 54, 1, 'yes', '2014-03-15', '06:04:41 am'),
(267, 3, 54, 1, 'yes', '2014-03-15', '06:04:41 am'),
(268, 4, 54, 1, 'yes', '2014-03-15', '06:04:41 am'),
(269, 2, 54, 1, 'yes', '2014-03-15', '06:04:41 am'),
(270, 1, 54, 1, 'yes', '2014-03-15', '06:04:41 am'),
(271, 5, 55, 1, 'no', '2014-03-15', '06:04:56 am'),
(272, 3, 55, 1, 'yes', '2014-03-15', '06:04:56 am'),
(273, 4, 55, 1, 'yes', '2014-03-15', '06:04:56 am'),
(274, 2, 55, 1, 'no', '2014-03-15', '06:04:56 am'),
(275, 1, 55, 1, 'yes', '2014-03-15', '06:04:56 am'),
(276, 5, 56, 1, 'yes', '2014-03-15', '06:05:58 am'),
(277, 3, 56, 1, 'yes', '2014-03-15', '06:05:58 am'),
(278, 4, 56, 1, 'yes', '2014-03-15', '06:05:58 am'),
(279, 2, 56, 1, 'yes', '2014-03-15', '06:05:58 am'),
(280, 1, 56, 1, 'yes', '2014-03-15', '06:05:58 am'),
(281, 5, 57, 1, 'yes', '2014-03-15', '06:06:10 am'),
(282, 3, 57, 1, 'no', '2014-03-15', '06:06:10 am'),
(283, 4, 57, 1, 'yes', '2014-03-15', '06:06:10 am'),
(284, 2, 57, 1, 'yes', '2014-03-15', '06:06:10 am'),
(285, 1, 57, 1, 'no', '2014-03-15', '06:06:10 am'),
(286, 5, 58, 1, 'yes', '2014-03-15', '06:06:22 am'),
(287, 3, 58, 1, 'yes', '2014-03-15', '06:06:22 am'),
(288, 4, 58, 1, 'yes', '2014-03-15', '06:06:22 am'),
(289, 2, 58, 1, 'no', '2014-03-15', '06:06:22 am'),
(290, 1, 58, 1, 'yes', '2014-03-15', '06:06:22 am'),
(291, 5, 59, 1, 'yes', '2014-03-15', '06:06:36 am'),
(292, 3, 59, 1, 'yes', '2014-03-15', '06:06:36 am'),
(293, 4, 59, 1, 'yes', '2014-03-15', '06:06:36 am'),
(294, 2, 59, 1, 'yes', '2014-03-15', '06:06:36 am'),
(295, 1, 59, 1, 'yes', '2014-03-15', '06:06:36 am'),
(296, 5, 60, 1, 'no', '2014-03-15', '06:06:48 am'),
(297, 3, 60, 1, 'yes', '2014-03-15', '06:06:48 am'),
(298, 4, 60, 1, 'no', '2014-03-15', '06:06:48 am'),
(299, 2, 60, 1, 'yes', '2014-03-15', '06:06:48 am'),
(300, 1, 60, 1, 'no', '2014-03-15', '06:06:48 am'),
(301, 5, 61, 1, 'yes', '2014-03-14', '06:07:48 am'),
(302, 3, 61, 1, 'no', '2014-03-14', '06:07:48 am'),
(303, 4, 61, 1, 'yes', '2014-03-14', '06:07:48 am'),
(304, 2, 61, 1, 'no', '2014-03-14', '06:07:48 am'),
(305, 1, 61, 1, 'yes', '2014-03-14', '06:07:48 am'),
(306, 5, 62, 1, 'no', '2014-03-14', '06:07:57 am'),
(307, 3, 62, 1, 'no', '2014-03-14', '06:07:57 am'),
(308, 4, 62, 1, 'yes', '2014-03-14', '06:07:57 am'),
(309, 2, 62, 1, 'yes', '2014-03-14', '06:07:57 am'),
(310, 1, 62, 1, 'yes', '2014-03-14', '06:07:57 am'),
(311, 5, 63, 1, 'no', '2014-03-14', '06:08:05 am'),
(312, 3, 63, 1, 'no', '2014-03-14', '06:08:05 am'),
(313, 4, 63, 1, 'yes', '2014-03-14', '06:08:05 am'),
(314, 2, 63, 1, 'yes', '2014-03-14', '06:08:05 am'),
(315, 1, 63, 1, 'yes', '2014-03-14', '06:08:05 am'),
(316, 5, 64, 1, 'no', '2014-03-14', '06:08:13 am'),
(317, 3, 64, 1, 'yes', '2014-03-14', '06:08:13 am'),
(318, 4, 64, 1, 'no', '2014-03-14', '06:08:13 am'),
(319, 2, 64, 1, 'yes', '2014-03-14', '06:08:13 am'),
(320, 1, 64, 1, 'no', '2014-03-14', '06:08:13 am'),
(321, 5, 65, 1, 'yes', '2014-03-14', '06:08:24 am'),
(322, 3, 65, 1, 'yes', '2014-03-14', '06:08:24 am'),
(323, 4, 65, 1, 'yes', '2014-03-14', '06:08:24 am'),
(324, 2, 65, 1, 'yes', '2014-03-14', '06:08:24 am'),
(325, 1, 65, 1, 'yes', '2014-03-14', '06:08:24 am'),
(326, 5, 66, 1, 'yes', '2014-03-15', '10:34:03 pm'),
(327, 3, 66, 1, 'no', '2014-03-15', '10:34:03 pm'),
(328, 4, 66, 1, 'yes', '2014-03-15', '10:34:03 pm'),
(329, 2, 66, 1, 'no', '2014-03-15', '10:34:03 pm'),
(330, 1, 66, 1, 'yes', '2014-03-15', '10:34:03 pm'),
(331, 1, 67, 2, 'yes', '2014-03-16', '12:37:59 am'),
(332, 2, 67, 2, 'yes', '2014-03-16', '12:37:59 am'),
(333, 3, 67, 2, 'yes', '2014-03-16', '12:37:59 am'),
(334, 4, 67, 2, 'yes', '2014-03-16', '12:37:59 am'),
(335, 5, 67, 2, 'yes', '2014-03-16', '12:37:59 am'),
(336, 5, 68, 1, 'yes', '2014-03-16', '02:43:56 am'),
(337, 3, 68, 1, 'yes', '2014-03-16', '02:43:56 am'),
(338, 4, 68, 1, 'yes', '2014-03-16', '02:43:56 am'),
(339, 2, 68, 1, 'yes', '2014-03-16', '02:43:56 am'),
(340, 1, 68, 1, 'yes', '2014-03-16', '02:43:56 am'),
(341, 5, 69, 1, 'yes', '2014-03-21', '04:01:41 am'),
(342, 3, 69, 1, 'no', '2014-03-21', '04:01:41 am'),
(343, 4, 69, 1, 'yes', '2014-03-21', '04:01:41 am'),
(344, 2, 69, 1, 'no', '2014-03-21', '04:01:41 am'),
(345, 1, 69, 1, 'yes', '2014-03-21', '04:01:41 am'),
(346, 5, 70, 1, 'yes', '2014-03-25', '02:12:16 pm'),
(347, 3, 70, 1, 'yes', '2014-03-25', '02:12:16 pm'),
(348, 4, 70, 1, 'yes', '2014-03-25', '02:12:16 pm'),
(349, 2, 70, 1, 'yes', '2014-03-25', '02:12:16 pm'),
(350, 1, 70, 1, 'yes', '2014-03-25', '02:12:16 pm'),
(351, 5, 71, 1, 'yes', '2014-03-25', '02:12:44 pm'),
(352, 3, 71, 1, 'no', '2014-03-25', '02:12:44 pm'),
(353, 4, 71, 1, 'yes', '2014-03-25', '02:12:44 pm'),
(354, 2, 71, 1, 'no', '2014-03-25', '02:12:44 pm'),
(355, 1, 71, 1, 'yes', '2014-03-25', '02:12:44 pm'),
(356, 5, 72, 1, 'yes', '2014-03-25', '02:13:42 pm'),
(357, 3, 72, 1, 'yes', '2014-03-25', '02:13:42 pm'),
(358, 4, 72, 1, 'yes', '2014-03-25', '02:13:42 pm'),
(359, 2, 72, 1, 'yes', '2014-03-25', '02:13:42 pm'),
(360, 1, 72, 1, 'yes', '2014-03-25', '02:13:42 pm'),
(361, 5, 73, 1, 'yes', '2014-03-25', '02:21:59 pm'),
(362, 3, 73, 1, 'no', '2014-03-25', '02:21:59 pm'),
(363, 4, 73, 1, 'yes', '2014-03-25', '02:21:59 pm'),
(364, 2, 73, 1, 'no', '2014-03-25', '02:21:59 pm'),
(365, 1, 73, 1, 'no', '2014-03-25', '02:21:59 pm'),
(366, 5, 74, 1, 'yes', '2014-03-26', '04:54:32 pm'),
(367, 3, 74, 1, 'yes', '2014-03-26', '04:54:32 pm'),
(368, 4, 74, 1, 'yes', '2014-03-26', '04:54:32 pm'),
(369, 2, 74, 1, 'yes', '2014-03-26', '04:54:32 pm'),
(370, 1, 74, 1, 'yes', '2014-03-26', '04:54:32 pm'),
(371, 5, 75, 1, 'yes', '2014-03-26', '04:54:46 pm'),
(372, 3, 75, 1, 'no', '2014-03-26', '04:54:46 pm'),
(373, 4, 75, 1, 'yes', '2014-03-26', '04:54:46 pm'),
(374, 2, 75, 1, 'no', '2014-03-26', '04:54:46 pm'),
(375, 1, 75, 1, 'yes', '2014-03-26', '04:54:46 pm'),
(376, 5, 76, 1, 'yes', '2014-03-24', '04:56:22 pm'),
(377, 3, 76, 1, 'no', '2014-03-24', '04:56:22 pm'),
(378, 4, 76, 1, 'yes', '2014-03-24', '04:56:22 pm'),
(379, 2, 76, 1, 'yes', '2014-03-24', '04:56:22 pm'),
(380, 1, 76, 1, 'yes', '2014-03-24', '04:56:22 pm'),
(381, 5, 77, 1, 'yes', '2014-03-24', '04:56:46 pm'),
(382, 3, 77, 1, 'yes', '2014-03-24', '04:56:46 pm'),
(383, 4, 77, 1, 'yes', '2014-03-24', '04:56:46 pm'),
(384, 2, 77, 1, 'yes', '2014-03-24', '04:56:46 pm'),
(385, 1, 77, 1, 'yes', '2014-03-24', '04:56:46 pm'),
(386, 5, 78, 1, 'no', '2014-03-24', '04:56:56 pm'),
(387, 3, 78, 1, 'yes', '2014-03-24', '04:56:56 pm'),
(388, 4, 78, 1, 'no', '2014-03-24', '04:56:56 pm'),
(389, 2, 78, 1, 'yes', '2014-03-24', '04:56:56 pm'),
(390, 1, 78, 1, 'no', '2014-03-24', '04:56:56 pm'),
(391, 5, 79, 1, 'yes', '2014-03-23', '04:57:40 pm'),
(392, 3, 79, 1, 'no', '2014-03-23', '04:57:40 pm'),
(393, 4, 79, 1, 'no', '2014-03-23', '04:57:40 pm'),
(394, 2, 79, 1, 'yes', '2014-03-23', '04:57:40 pm'),
(395, 1, 79, 1, 'yes', '2014-03-23', '04:57:40 pm'),
(396, 5, 80, 1, 'yes', '2014-03-23', '04:57:57 pm'),
(397, 3, 80, 1, 'yes', '2014-03-23', '04:57:57 pm'),
(398, 4, 80, 1, 'no', '2014-03-23', '04:57:57 pm'),
(399, 2, 80, 1, 'yes', '2014-03-23', '04:57:57 pm'),
(400, 1, 80, 1, 'yes', '2014-03-23', '04:57:57 pm'),
(401, 5, 81, 1, 'yes', '2014-03-22', '04:58:39 pm'),
(402, 3, 81, 1, 'yes', '2014-03-22', '04:58:39 pm'),
(403, 4, 81, 1, 'yes', '2014-03-22', '04:58:39 pm'),
(404, 2, 81, 1, 'yes', '2014-03-22', '04:58:39 pm'),
(405, 1, 81, 1, 'yes', '2014-03-22', '04:58:39 pm'),
(406, 5, 82, 1, 'yes', '2014-03-22', '04:58:48 pm'),
(407, 3, 82, 1, 'no', '2014-03-22', '04:58:48 pm'),
(408, 4, 82, 1, 'no', '2014-03-22', '04:58:48 pm'),
(409, 2, 82, 1, 'yes', '2014-03-22', '04:58:48 pm'),
(410, 1, 82, 1, 'yes', '2014-03-22', '04:58:48 pm'),
(411, 5, 83, 1, 'no', '2014-03-22', '04:58:57 pm'),
(412, 3, 83, 1, 'no', '2014-03-22', '04:58:57 pm'),
(413, 4, 83, 1, 'yes', '2014-03-22', '04:58:57 pm'),
(414, 2, 83, 1, 'yes', '2014-03-22', '04:58:57 pm'),
(415, 1, 83, 1, 'yes', '2014-03-22', '04:58:57 pm'),
(416, 5, 84, 1, 'no', '2014-03-22', '04:59:06 pm'),
(417, 3, 84, 1, 'no', '2014-03-22', '04:59:06 pm'),
(418, 4, 84, 1, 'no', '2014-03-22', '04:59:06 pm'),
(419, 2, 84, 1, 'yes', '2014-03-22', '04:59:06 pm'),
(420, 1, 84, 1, 'yes', '2014-03-22', '04:59:06 pm'),
(421, 5, 85, 1, 'no', '2014-03-22', '04:59:17 pm'),
(422, 3, 85, 1, 'yes', '2014-03-22', '04:59:17 pm'),
(423, 4, 85, 1, 'yes', '2014-03-22', '04:59:17 pm'),
(424, 2, 85, 1, 'yes', '2014-03-22', '04:59:17 pm'),
(425, 1, 85, 1, 'yes', '2014-03-22', '04:59:17 pm'),
(426, 5, 86, 1, 'yes', '2014-03-21', '05:00:05 pm'),
(427, 3, 86, 1, 'yes', '2014-03-21', '05:00:05 pm'),
(428, 4, 86, 1, 'yes', '2014-03-21', '05:00:05 pm'),
(429, 2, 86, 1, 'yes', '2014-03-21', '05:00:05 pm'),
(430, 1, 86, 1, 'yes', '2014-03-21', '05:00:05 pm'),
(431, 5, 87, 1, 'yes', '2014-03-21', '05:00:14 pm'),
(432, 3, 87, 1, 'yes', '2014-03-21', '05:00:14 pm'),
(433, 4, 87, 1, 'yes', '2014-03-21', '05:00:14 pm'),
(434, 2, 87, 1, 'yes', '2014-03-21', '05:00:14 pm'),
(435, 1, 87, 1, 'yes', '2014-03-21', '05:00:14 pm'),
(436, 5, 88, 1, 'yes', '2014-03-21', '05:00:23 pm'),
(437, 3, 88, 1, 'yes', '2014-03-21', '05:00:23 pm'),
(438, 4, 88, 1, 'yes', '2014-03-21', '05:00:23 pm'),
(439, 2, 88, 1, 'yes', '2014-03-21', '05:00:23 pm'),
(440, 1, 88, 1, 'yes', '2014-03-21', '05:00:23 pm'),
(441, 5, 89, 1, 'yes', '2014-03-21', '05:00:33 pm'),
(442, 3, 89, 1, 'yes', '2014-03-21', '05:00:33 pm'),
(443, 4, 89, 1, 'yes', '2014-03-21', '05:00:33 pm'),
(444, 2, 89, 1, 'yes', '2014-03-21', '05:00:33 pm'),
(445, 1, 89, 1, 'yes', '2014-03-21', '05:00:33 pm'),
(446, 5, 90, 1, 'yes', '2014-03-21', '05:00:49 pm'),
(447, 3, 90, 1, 'yes', '2014-03-21', '05:00:49 pm'),
(448, 4, 90, 1, 'yes', '2014-03-21', '05:00:49 pm'),
(449, 2, 90, 1, 'yes', '2014-03-21', '05:00:49 pm'),
(450, 1, 90, 1, 'yes', '2014-03-21', '05:00:49 pm'),
(451, 5, 91, 1, 'yes', '2014-03-20', '05:01:49 pm'),
(452, 3, 91, 1, 'yes', '2014-03-20', '05:01:49 pm'),
(453, 4, 91, 1, 'yes', '2014-03-20', '05:01:49 pm'),
(454, 2, 91, 1, 'no', '2014-03-20', '05:01:49 pm'),
(455, 1, 91, 1, 'yes', '2014-03-20', '05:01:49 pm');
