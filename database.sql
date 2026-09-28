-- Database Schema for Student Security System (SSS)
-- Compatible with MySQL 5.7+, MySQL 8.0+, MariaDB

CREATE DATABASE IF NOT EXISTS `sss` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `sss`;

-- --------------------------------------------------------
-- Table structure for `tbl_admin`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT 'Administrator',
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `dor` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed admin account
INSERT INTO `tbl_admin` (`id`, `name`, `email`, `password`, `dor`) VALUES
(1, 'Admin User', 'admin@admin.com', 'admin123', CURDATE())
ON DUPLICATE KEY UPDATE `email` = VALUES(`email`);


-- --------------------------------------------------------
-- Table structure for `tbl_student`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tbl_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stu_id` varchar(50) NOT NULL UNIQUE,
  `roll` int(11) NOT NULL,
  `stu_name` varchar(100) NOT NULL,
  `class` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `f_name` varchar(100) NOT NULL,
  `m_name` varchar(100) NOT NULL,
  `aadhar_no.` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `p_file` varchar(255) DEFAULT '',
  `qr_file` varchar(255) DEFAULT '',
  `parent_id` varchar(50) NOT NULL,
  `address` text DEFAULT NULL,
  `dor` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed sample student
INSERT INTO `tbl_student` (`id`, `stu_id`, `roll`, `stu_name`, `class`, `dob`, `gender`, `f_name`, `m_name`, `aadhar_no.`, `email`, `mobile`, `p_file`, `qr_file`, `parent_id`, `address`, `dor`) VALUES
(1, 'SSS2026X1', 1, 'Rahul Sharma', 'X', '2008-05-15', 'Male', 'Rajesh Sharma', 'Sunita Sharma', '123456789012', 'rahul@student.com', '9876543210', 'photo.jpg', '../assets/qr_img/SSS2023X1.png', 'PPP2026X1', '123 Civil Lines, Lucknow', CURDATE())
ON DUPLICATE KEY UPDATE `stu_id` = VALUES(`stu_id`);


-- --------------------------------------------------------
-- Table structure for `tbl_parent`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tbl_parent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` varchar(50) NOT NULL UNIQUE,
  `f_name` varchar(100) NOT NULL,
  `m_name` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `stu_id` varchar(50) NOT NULL,
  `p_file` varchar(255) DEFAULT 'user.jpg',
  `address` text DEFAULT NULL,
  `dor` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed sample parent
INSERT INTO `tbl_parent` (`id`, `parent_id`, `f_name`, `m_name`, `mobile`, `email`, `password`, `stu_id`, `p_file`, `address`, `dor`) VALUES
(1, 'PPP2026X1', 'Rajesh Sharma', 'Sunita Sharma', '9876543210', 'parent@parent.com', 'parent123', 'SSS2026X1', 'user.jpg', '123 Civil Lines, Lucknow', CURDATE())
ON DUPLICATE KEY UPDATE `parent_id` = VALUES(`parent_id`);


-- --------------------------------------------------------
-- Table structure for `tbl_teacher`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tbl_teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` varchar(50) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `date_of_brith` varchar(50) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `dor` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed sample teacher
INSERT INTO `tbl_teacher` (`id`, `teacher_id`, `name`, `gender`, `date_of_brith`, `mobile`, `address`, `email`, `password`, `dor`) VALUES
(1, 'TCH001', 'Anjali Verma', 'Female', '1990-08-20', '9876543211', 'Sector 14, Vikas Nagar, Lucknow', 'teacher@teacher.com', 'teacher123', CURDATE())
ON DUPLICATE KEY UPDATE `email` = VALUES(`email`);


-- --------------------------------------------------------
-- Table structure for `tbl_staff`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tbl_staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` varchar(50) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `date_of_brith` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `address` text DEFAULT NULL,
  `dor` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed sample staff
INSERT INTO `tbl_staff` (`id`, `staff_id`, `name`, `date_of_brith`, `gender`, `email`, `password`, `mobile`, `address`, `dor`) VALUES
(1, 'STF001', 'Vikas Gupta', '1988-12-10', 'Male', 'staff@staff.com', 'staff123', '9876543212', 'Alambagh, Lucknow', CURDATE())
ON DUPLICATE KEY UPDATE `email` = VALUES(`email`);


-- --------------------------------------------------------
-- Table structure for `tbl_application`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tbl_application` (
  `app_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` varchar(50) NOT NULL,
  `stu_id` varchar(50) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `reason` text NOT NULL,
  `doa` date NOT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  PRIMARY KEY (`app_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed sample application
INSERT INTO `tbl_application` (`app_id`, `parent_id`, `stu_id`, `subject`, `reason`, `doa`, `status`) VALUES
(1, 'PPP2026X1', 'SSS2026X1', 'Medical Leave', 'Student is suffering from viral fever and advised 3 days rest.', CURDATE(), 'Pending');


-- --------------------------------------------------------
-- Table structure for `tbl_attendance`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tbl_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stu_id` varchar(50) NOT NULL,
  `doa` varchar(50) NOT NULL,
  `status` varchar(20) DEFAULT 'Present',
  `time` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed sample attendance (doa in Ymd format, matching the format used in parent_see_attendance.php)
INSERT INTO `tbl_attendance` (`id`, `stu_id`, `doa`, `status`, `time`) VALUES
(1, 'SSS2026X1', DATE_FORMAT(CURDATE(), '%Y%m%d'), 'Present', CURTIME());


-- --------------------------------------------------------
-- Table structure for `usertable` (OTP password reset)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `usertable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` mediumint(50) NOT NULL DEFAULT 0,
  `status` varchar(50) NOT NULL DEFAULT 'notverified',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `usertable` (`id`, `name`, `email`, `password`, `code`, `status`) VALUES
(1, 'Admin User', 'admin@admin.com', '$2y$10$wO8Xqf9.Q0tF112sU3.N7u0Rz4o2QoK9m9v5Zt9A2b3c4d5e6f7g8', 0, 'verified')
ON DUPLICATE KEY UPDATE `email` = VALUES(`email`);
