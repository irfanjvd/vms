-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 29, 2016 at 02:57 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vms`
--

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
`id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `is_deleted` int(2) NOT NULL,
  `created_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location`, `is_deleted`, `created_datetime`) VALUES
(1, 'Main Gate', 0, '2016-01-28 08:22:21'),
(2, 'Reception', 0, '2016-01-28 08:22:32'),
(3, 'Reception 2', 0, '2016-01-29 09:59:30'),
(4, 'Reception 3', 0, '2016-01-29 09:59:41'),
(5, 'test location', 0, '2016-01-29 12:35:21');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `created_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` enum('SUPER','NORMAL') NOT NULL DEFAULT 'NORMAL',
  `image_file` varchar(200) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `username`, `password`, `is_deleted`, `status`, `created_datetime`, `type`, `image_file`) VALUES
(1, 'Super', 'admin', 'super', 'zahid.nadeem@pitb.gov.pk', '21232f297a57a5a743894a0e4a801fc3', 0, '1', '2015-11-13 07:34:19', 'SUPER', ''),
(2, 'Zahid', 'Nadeem', 'zahid', '', 'c651148415ab2a260e6c506075c12ae3', 0, '0', '2016-01-28 08:23:24', 'NORMAL', '1453969404visitor_3120202528011.png');

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE IF NOT EXISTS `visit` (
`visit_id` int(20) NOT NULL,
  `visit_visitor_id_fk` int(20) DEFAULT NULL,
  `location_id` int(12) NOT NULL,
  `next_location_id` int(12) NOT NULL,
  `visit_reason` varchar(255) DEFAULT NULL,
  `visit_checkin` varchar(200) DEFAULT NULL,
  `visit_checkout` varchar(200) DEFAULT NULL,
  `visit_from_company` varchar(255) DEFAULT NULL,
  `visit_transport_mode` varchar(50) DEFAULT NULL,
  `visit_transport_registration_no` varchar(255) DEFAULT NULL,
  `visit_to_tenant` varchar(200) DEFAULT NULL,
  `visit_to_employee` varchar(200) DEFAULT NULL,
  `visit_issued_card` varchar(255) DEFAULT NULL,
  `identity_type` varchar(255) NOT NULL,
  `visit_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `visit`
--

INSERT INTO `visit` (`visit_id`, `visit_visitor_id_fk`, `location_id`, `next_location_id`, `visit_reason`, `visit_checkin`, `visit_checkout`, `visit_from_company`, `visit_transport_mode`, `visit_transport_registration_no`, `visit_to_tenant`, `visit_to_employee`, `visit_issued_card`, `identity_type`, `visit_date`) VALUES
(2, 1, 1, 0, 'TESTING', '02/19/2016 17:07:00', '02/19/2016 14:34:04', 'PITB', 'Car', '23423', 'Apex Consulting Pakistan', 'Sardar Ali Syed', '343', 'visitor_identity_no', '2016-02-19 12:07:38'),
(3, 1, 1, 0, 'TESTING', '02/22/2016 9:48 AM', '02/22/2016 08:26:29', 'PITB', 'Car', '23423', 'Apex Consulting Pakistan', 'Sardar Ali Syed', '3434', 'visitor_identity_no', '2016-02-22 04:48:43');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_profile`
--

CREATE TABLE IF NOT EXISTS `visitor_profile` (
`visitor_id` int(20) NOT NULL,
  `visitor_identity_no` varchar(255) DEFAULT NULL,
  `visitor_employee_card` varchar(255) NOT NULL,
  `visitor_driving_license` varchar(255) NOT NULL,
  `visitor_passport_id` varchar(255) NOT NULL,
  `visitor_family_no` varchar(100) DEFAULT NULL,
  `visitor_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `visitor_father_name` varchar(255) DEFAULT NULL,
  `visitor_address` text,
  `visitor_cell_no` varchar(200) DEFAULT NULL,
  `visitor_district` varchar(255) DEFAULT NULL,
  `visitor_city` varchar(255) DEFAULT NULL,
  `visitor_registration_mode` enum('nadra','manual') DEFAULT NULL,
  `visitor_picture` varchar(255) DEFAULT NULL,
  `created_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `visitor_profile`
--

INSERT INTO `visitor_profile` (`visitor_id`, `visitor_identity_no`, `visitor_employee_card`, `visitor_driving_license`, `visitor_passport_id`, `visitor_family_no`, `visitor_name`, `visitor_father_name`, `visitor_address`, `visitor_cell_no`, `visitor_district`, `visitor_city`, `visitor_registration_mode`, `visitor_picture`, `created_datetime`) VALUES
(1, '3520143160985', 'abc123', 'dd123', 'pp123', NULL, 'irfan javed', NULL, 'javed', '987987', NULL, NULL, NULL, 'http://localhost/vms/assets/data/visitor_profile/no_image.png', '2016-02-04 11:29:08'),
(2, '1234', '', '', '', NULL, 'kamran javed', NULL, 'slkjfd', '987897', NULL, NULL, NULL, 'http://localhost/vms/assets/data/visitor_profile/no_image.png', '2016-02-10 05:15:19'),
(3, '2345', '', '', '', 'FM123', 'hello testings', 'Test', 'slkdj', '97987', 'Lahore', 'Lahore', '', 'http://localhost/vms/assets/data/visitor_profile/visitor_2345.png', '2016-02-10 07:21:37'),
(6, NULL, '', '', 'ppp123', NULL, 'passport user', NULL, 'ksdflkj', '987897', NULL, NULL, NULL, 'http://localhost/vms/assets/data/visitor_profile/no_image.png', '2016-02-17 11:51:30');

-- --------------------------------------------------------

--
-- Table structure for table `visit_track`
--

CREATE TABLE IF NOT EXISTS `visit_track` (
`id` int(20) NOT NULL,
  `visit_id_fk` int(20) DEFAULT NULL,
  `user_id` int(20) DEFAULT NULL,
  `location_id` int(20) DEFAULT NULL,
  `location_title` varchar(255) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `created_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `visit_track`
--

INSERT INTO `visit_track` (`id`, `visit_id_fk`, `user_id`, `location_id`, `location_title`, `action`, `created_datetime`) VALUES
(2, 2, 2, 1, 'Main Gate', 'CHECK_IN', '2016-02-19 12:07:38'),
(3, 2, 2, 1, 'Main Gate', 'CHECK_OUT', '2016-02-19 13:34:04'),
(4, 3, 2, 1, 'Main Gate', 'CHECK_IN', '2016-02-22 04:48:44'),
(5, 3, 2, 1, 'Main Gate', 'CHECK_OUT', '2016-02-22 07:26:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `visit`
--
ALTER TABLE `visit`
 ADD PRIMARY KEY (`visit_id`);

--
-- Indexes for table `visitor_profile`
--
ALTER TABLE `visitor_profile`
 ADD PRIMARY KEY (`visitor_id`), ADD UNIQUE KEY `visitor_identity_no` (`visitor_identity_no`);

--
-- Indexes for table `visit_track`
--
ALTER TABLE `visit_track`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `visit`
--
ALTER TABLE `visit`
MODIFY `visit_id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `visitor_profile`
--
ALTER TABLE `visitor_profile`
MODIFY `visitor_id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `visit_track`
--
ALTER TABLE `visit_track`
MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
