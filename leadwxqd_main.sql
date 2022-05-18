-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 11, 2022 at 02:32 AM
-- Server version: 10.3.34-MariaDB-cll-lve
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leadwxqd_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutchoose_tbl`
--

CREATE TABLE `aboutchoose_tbl` (
  `id` int(11) NOT NULL,
  `about_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `choose_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `aboutchoose_tbl`
--

INSERT INTO `aboutchoose_tbl` (`id`, `about_id`, `choose_title`, `logo`, `created_date`) VALUES
(5, 'A08S3QBC', 'Learn from experts', 'assets/uploads/abouts/c2dfd9e1734ba8f3fbfa44d39fe145be.svg', '2022-03-08 17:30:30'),
(6, 'A08S3QBC', 'Explore hundreds of free courses or get started with a free trial.', 'assets/uploads/abouts/7aa6953a9296866c5ae89eb764f0541d.svg', '2022-03-08 11:03:10'),
(7, 'A08S3QBC', 'Get on-demand lectures for desktop and mobile—on your schedule.', 'assets/uploads/abouts/1df9947f22447b2a4fc210488ea5bf8a.svg', '2022-03-08 11:03:36'),
(8, 'A08S3QBC', 'Master essential career skills based on comprehensive skills data.', 'assets/uploads/abouts/0f9247f0fbf53117eaa56714c5ba4a20.svg', '2022-03-08 11:04:04');

-- --------------------------------------------------------

--
-- Table structure for table `aboutinfo_tbl`
--

CREATE TABLE `aboutinfo_tbl` (
  `id` int(11) NOT NULL,
  `about_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `summary` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `aboutlink` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mission` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `aboutinfo_tbl`
--

INSERT INTO `aboutinfo_tbl` (`id`, `about_id`, `summary`, `aboutlink`, `mission`, `status`, `enterprise_id`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'A08S3QBC', 'We envision a world where anyone, anywhere has the power to transform their life through learning. Lead Academy partners with more than 200 leading universities and companies to bring flexible, affordable, job-relevant online learning to individuals and organizations worldwide. We offer a range of learning opportunities—from hands-on projects and courses to job-ready certificates and degree programs.', 'https://www.youtube.com/watch?v=tUP5S4YdEJo&ab_channel=Siemens', 'We believe, Learning is the source of human progress. It has the power to transform our world from illness to health, from poverty to prosperity,from conflict to peace. It has the power to transform our lives for ourselves, for our families, for our communities.\r\n\r\nNo matter who we are or where we are, learning empowers us to change and grow and redefine what’s possible. That’s why access to the best learning is a right, not a privilege.\r\n\r\nAnd that’s why Lead Academy is here. We partner with the best institutions to bring the best learning to every corner of the world.\r\n\r\nSo that anyone, anywhere has the power to transform their life through learning.', 1, '1', '1', '2022-04-11 11:36:38', '1', '2022-04-11 11:36:38');

-- --------------------------------------------------------

--
-- Table structure for table `about_service_tbl`
--

CREATE TABLE `about_service_tbl` (
  `id` int(11) NOT NULL,
  `about_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `service_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `service_subtitle` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `service_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `enterprise_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_date` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `about_service_tbl`
--

INSERT INTO `about_service_tbl` (`id`, `about_id`, `service_title`, `service_subtitle`, `service_logo`, `status`, `enterprise_id`, `created_by`, `created_date`, `updated_date`, `updated_by`) VALUES
(1, 'A08S3QBC', 'Lead Academy for Business', '[\"Lead Academy for Business is the transformative skill development solution for empowering your teams with the high-impact skills that drive innovation, competitiveness, and growth\"]', 'assets/uploads/abouts/2022-03-08/931d69443ab03e1ff3e70bea0788f592.png', 1, '1', '1', '2022-03-08 17:25:44', '2022-03-08 17:25:44', '1'),
(2, 'A08S3QBC', 'Lead Academy for Campus', '[\"Lead Academy for Campus empowers any university to offer job-relevant, credit-ready* online education to students, faculty, and staff.\"]', 'assets/uploads/abouts/2022-03-08/94500afa7981b6abfcb1275cc2f76bb1.png', 1, '1', '1', '2022-03-08 17:21:34', '2022-03-08 17:21:34', '1'),
(3, 'A08S3QBC', 'Lead Academy for Government', '[\"Lead Academy for Government helps governments and organizations provide in-demand skills and learning paths to new jobs for the entire workforce, and implements national-scale learning programs.\"]', '', 1, '1', '1', '2022-03-08 17:18:49', '2022-03-08 17:18:49', '1');

-- --------------------------------------------------------

--
-- Table structure for table `academic_ledger_tbl`
--

CREATE TABLE `academic_ledger_tbl` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'invoice id and transactionid are same',
  `course_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_subscription` int(11) NOT NULL COMMENT '0=purchase and 1=subscription',
  `subscription_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `debit` float NOT NULL,
  `credit` float NOT NULL,
  `status` int(11) NOT NULL,
  `enterprise_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `academic_ledger_tbl`
--

INSERT INTO `academic_ledger_tbl` (`id`, `transaction_id`, `course_id`, `description`, `is_subscription`, `subscription_id`, `payment_type`, `debit`, `credit`, `status`, `enterprise_id`, `created_by`, `created_date`) VALUES
(54, 'INVNKVKVUZ', '', '', 1, 'sub08RII9T', 0, 10, 0, 1, '1', 'ST09COMMOR', '2022-05-09 09:20:32');

-- --------------------------------------------------------

--
-- Table structure for table `activitylog_tbl`
--

CREATE TABLE `activitylog_tbl` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activities` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enterprise_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `activitylog_tbl`
--

INSERT INTO `activitylog_tbl` (`id`, `title`, `action`, `activities`, `enterprise_id`, `created_by`, `created_date`) VALUES
(1832, 'Login time 2022-04-18 12:49:51 Admin', 'Login', 'success', '1', '1', '2022-04-18 16:49:51'),
(1833, 'Logout time 2022-04-18 14:51:41 Akbor Hossain', 'Logout', 'success', '', 'ST1843DMLQ', '2022-04-18 18:51:41'),
(1834, 'Login time 2022-04-18 14:52:31 Admin', 'Login', 'success', '1', '1', '2022-04-18 18:52:31'),
(1835, 'Login time 2022-04-18 14:52:54 Akbor Hossain', 'Login', 'success', '', 'ST1843DMLQ', '2022-04-18 18:52:54'),
(1836, 'Logout time 2022-04-18 15:00:21 Akbor Hossain', 'Logout', 'success', '', 'ST1843DMLQ', '2022-04-18 19:00:21'),
(1837, 'Login time 2022-04-18 15:00:42 Admin', 'Login', 'success', '1', '1', '2022-04-18 19:00:42'),
(1838, 'Category Insert By Admin', 'Insert', 'success', '1', '1', '2022-04-18 19:46:01'),
(1839, 'Login time 2022-04-19 11:47:03 Admin', 'Login', 'success', '1', '1', '2022-04-19 15:47:03'),
(1840, 'Logout time 2022-04-19 11:49:28 Admin', 'Logout', 'success', '1', '1', '2022-04-19 15:49:28'),
(1841, 'Login time 2022-04-19 12:39:22 Admin', 'Login', 'success', '1', '1', '2022-04-19 16:39:22'),
(1842, 'Category Insert By Admin', 'Insert', 'success', '1', '1', '2022-04-19 16:42:12'),
(1843, 'Login time 2022-04-23 11:51:28 Admin', 'Login', 'success', '1', '1', '2022-04-23 15:51:28'),
(1844, 'Akram Hossain Faculty Insert By Admin', 'Insert', 'success', '1', '1', '2022-04-23 15:55:01'),
(1845, 'Course Insert By Admin', 'Insert', 'success', '1', '1', '2022-04-23 16:10:11'),
(1846, 'Course Insert By Admin', 'Insert', 'success', '1', '1', '2022-04-23 16:59:24'),
(1847, ' Section Insert By Admin', 'Insert', 'success', '1', '1', '2022-04-23 17:01:11'),
(1848, 'lesson one Lesson Insert By Admin', 'Insert', 'success', '1', '1', '2022-04-23 17:03:03'),
(1849, 'Logout time 2022-04-23 14:11:42 kamal hossain', 'Logout', 'success', '', 'ST23PMZNVD', '2022-04-23 18:11:42'),
(1850, 'Login time 2022-04-23 14:12:06 Admin', 'Login', 'success', '1', '1', '2022-04-23 18:12:06'),
(1851, 'Logout time 2022-04-23 14:28:09 Admin', 'Logout', 'success', '1', '1', '2022-04-23 18:28:09'),
(1852, 'Login time 2022-04-23 14:29:00 kamal hossain', 'Login', 'success', '', 'ST23PMZNVD', '2022-04-23 18:29:00'),
(1853, 'Login time 2022-04-24 13:18:29 kamal hossain', 'Login', 'success', '', 'ST23PMZNVD', '2022-04-24 17:18:29'),
(1854, 'Login time 2022-04-25 12:30:25 kamal hossain', 'Login', 'success', '', 'ST23PMZNVD', '2022-04-25 16:30:25'),
(1855, 'Logout time 2022-04-25 13:26:18 kamal hossain', 'Logout', 'success', '', 'ST23PMZNVD', '2022-04-25 17:26:18'),
(1856, 'Login time 2022-04-25 13:26:31 Admin', 'Login', 'success', '1', '1', '2022-04-25 17:26:31'),
(1857, 'Category Insert By Admin', 'Insert', 'success', '1', '1', '2022-04-25 18:01:38'),
(1858, 'Category Insert By Admin', 'Insert', 'success', '1', '1', '2022-04-25 18:02:08'),
(1859, 'Course Insert By Admin', 'Insert', 'success', '1', '1', '2022-04-25 18:07:55'),
(1860, ' Section Insert By Admin', 'Insert', 'success', '1', '1', '2022-04-25 18:08:03'),
(1861, 'lesson one Lesson Insert By Admin', 'Insert', 'success', '1', '1', '2022-04-25 18:09:00'),
(1862, 'Gardening Idea Course Updated By Admin', 'Update', 'success', '1', '1', '2022-04-25 18:09:19'),
(1863, 'Login time 2022-04-26 14:04:06 Admin', 'Login', 'success', '1', '1', '2022-04-26 18:04:06'),
(1864, 'Logout time 2022-04-26 14:15:32 Admin', 'Logout', 'success', '1', '1', '2022-04-26 18:15:32'),
(1865, 'Login time 2022-04-26 14:16:31 Admin', 'Login', 'success', '1', '1', '2022-04-26 18:16:31'),
(1866, 'Course Insert By Admin', 'Insert', 'success', '1', '1', '2022-04-26 19:21:53'),
(1867, ' Section Insert By Admin', 'Insert', 'success', '1', '1', '2022-04-26 19:24:07'),
(1868, 'lesson one Lesson Insert By Admin', 'Insert', 'success', '1', '1', '2022-04-26 19:25:05'),
(1869, 'Nature photography Course Updated By Admin', 'Update', 'success', '1', '1', '2022-04-26 19:26:09'),
(1870, 'Logout time 2022-04-26 15:58:54 Admin', 'Logout', 'success', '1', '1', '2022-04-26 19:58:54'),
(1871, 'Login time 2022-04-26 15:59:07 kamal hossain', 'Login', 'success', '', 'ST23PMZNVD', '2022-04-26 19:59:07'),
(1872, 'Logout time 2022-04-26 15:59:46 kamal hossain', 'Logout', 'success', '', 'ST23PMZNVD', '2022-04-26 19:59:46'),
(1873, 'Login time 2022-04-26 16:00:06 Admin', 'Login', 'success', '1', '1', '2022-04-26 20:00:06'),
(1874, 'Nature photography Course Updated By Admin', 'Update', 'success', '1', '1', '2022-04-26 20:01:33'),
(1875, 'Logout time 2022-04-26 16:04:46 Admin', 'Logout', 'success', '1', '1', '2022-04-26 20:04:46'),
(1876, 'Login time 2022-04-26 16:04:57 kamal hossain', 'Login', 'success', '', 'ST23PMZNVD', '2022-04-26 20:04:57'),
(1877, 'Logout time 2022-04-26 16:05:18 kamal hossain', 'Logout', 'success', '', 'ST23PMZNVD', '2022-04-26 20:05:18'),
(1878, 'Login time 2022-04-26 16:05:33 Admin', 'Login', 'success', '1', '1', '2022-04-26 20:05:33'),
(1879, 'Logout time 2022-04-26 16:06:21 Admin', 'Logout', 'success', '1', '1', '2022-04-26 20:06:21'),
(1880, 'Login time 2022-04-26 16:06:33 kamal hossain', 'Login', 'success', '', 'ST23PMZNVD', '2022-04-26 20:06:33'),
(1881, 'Login time 2022-04-26 16:07:17 Admin', 'Login', 'success', '1', '1', '2022-04-26 20:07:17'),
(1882, 'Logout time 2022-04-26 16:27:31 Admin', 'Logout', 'success', '1', '1', '2022-04-26 20:27:31'),
(1883, 'Login time 2022-04-27 12:02:19 Admin', 'Login', 'success', '1', '1', '2022-04-27 16:02:19'),
(1884, 'CO26ADET8 Course Deleted By Admin', 'Delete', 'success', '1', '1', '2022-04-27 16:03:27'),
(1885, 'CO25GXPP9 Course Deleted By Admin', 'Delete', 'success', '1', '1', '2022-04-27 16:03:32'),
(1886, 'CO23RJZNN Course Deleted By Admin', 'Delete', 'success', '1', '1', '2022-04-27 16:03:36'),
(1887, 'Category Deleted By Admin', 'Delete', 'success', '1', '1', '2022-04-27 16:04:22'),
(1888, 'Category Deleted By Admin', 'Delete', 'success', '1', '1', '2022-04-27 16:04:25'),
(1889, 'Category Deleted By Admin', 'Delete', 'success', '1', '1', '2022-04-27 16:04:30'),
(1890, 'Category Deleted By Admin', 'Delete', 'success', '1', '1', '2022-04-27 16:04:34'),
(1891, 'Category Deleted By Admin', 'Delete', 'success', '1', '1', '2022-04-27 16:04:42'),
(1892, 'Category Deleted By Admin', 'Delete', 'success', '1', '1', '2022-04-27 16:04:52'),
(1893, 'Akbar Hossain Faculty Insert By Admin', 'Insert', 'success', '1', '1', '2022-04-27 16:36:26'),
(1894, 'Logout time 2022-04-27 12:36:48 Admin', 'Logout', 'success', '1', '1', '2022-04-27 16:36:48'),
(1895, 'Logout time 2022-04-27 12:42:09 Zahid Khan', 'Logout', 'success', '', 'ST2793YBB6', '2022-04-27 16:42:09'),
(1896, 'Login time 2022-04-27 12:42:38 Admin', 'Login', 'success', '1', '1', '2022-04-27 16:42:38'),
(1897, 'Category Insert By Admin', 'Insert', 'success', '1', '1', '2022-04-27 16:43:37'),
(1898, 'Category Insert By Admin', 'Insert', 'success', '1', '1', '2022-04-27 16:44:05'),
(1899, 'Course Insert By Admin', 'Insert', 'success', '1', '1', '2022-04-27 16:52:39'),
(1900, ' Section Insert By Admin', 'Insert', 'success', '1', '1', '2022-04-27 16:52:49'),
(1901, 'lesson one Lesson Insert By Admin', 'Insert', 'success', '1', '1', '2022-04-27 16:54:12'),
(1902, 'Nature photography Course Updated By Admin', 'Update', 'success', '1', '1', '2022-04-27 16:54:41'),
(1903, 'Logout time 2022-04-27 13:03:53 Admin', 'Logout', 'success', '1', '1', '2022-04-27 17:03:53'),
(1904, 'Login time 2022-04-27 13:52:09 Zahid Khan', 'Login', 'success', '', 'ST2793YBB6', '2022-04-27 17:52:09'),
(1905, 'Logout time 2022-04-27 13:52:23 Zahid Khan', 'Logout', 'success', '', 'ST2793YBB6', '2022-04-27 17:52:23'),
(1906, 'Login time 2022-04-27 13:52:52 Admin', 'Login', 'success', '1', '1', '2022-04-27 17:52:52'),
(1907, 'Logout time 2022-04-27 13:54:06 Admin', 'Logout', 'success', '1', '1', '2022-04-27 17:54:06'),
(1908, 'Login time 2022-04-27 13:54:22 Zahid Khan', 'Login', 'success', '', 'ST2793YBB6', '2022-04-27 17:54:22'),
(1909, 'Login time 2022-04-27 13:57:12 Admin', 'Login', 'success', '1', '1', '2022-04-27 17:57:12'),
(1910, 'Logout time 2022-04-27 14:12:35 Zahid Khan', 'Logout', 'success', '', 'ST2793YBB6', '2022-04-27 18:12:35'),
(1911, 'Login time 2022-04-27 15:20:34 Admin', 'Login', 'success', '1', '1', '2022-04-27 19:20:34'),
(1912, 'Logout time 2022-04-27 16:26:15 Admin', 'Logout', 'success', '1', '1', '2022-04-27 20:26:15'),
(1913, 'Login time 2022-05-09 14:52:07 Admin', 'Login', 'success', '1', '1', '2022-05-09 18:52:07'),
(1914, 'Login time 2022-05-11 12:17:08 Admin', 'Login', 'success', '1', '1', '2022-05-11 16:17:08'),
(1915, 'Coupon Insert By Admin', 'Insert', 'success', '1', '1', '2022-05-11 16:22:39'),
(1916, 'Coupon Updated By Admin', 'Update', 'success', '1', '1', '2022-05-11 16:26:09');

-- --------------------------------------------------------

--
-- Table structure for table `assign_certificate_tbl`
--

CREATE TABLE `assign_certificate_tbl` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `certificate_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assign_courseexam_tbl`
--

CREATE TABLE `assign_courseexam_tbl` (
  `id` int(11) NOT NULL,
  `course_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lesson_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `section_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `exam_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `quiz_order` int(11) DEFAULT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_tbl`
--

CREATE TABLE `category_tbl` (
  `id` int(11) NOT NULL,
  `category_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ordering` int(11) NOT NULL,
  `category_type` int(11) NOT NULL COMMENT '1=course and 2=library',
  `is_popular` int(11) NOT NULL COMMENT '1=yes & 0=no',
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 = active, 0 = inactive and 2 = delete',
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category_tbl`
--

INSERT INTO `category_tbl` (`id`, `category_id`, `parent_id`, `name`, `ordering`, `category_type`, `is_popular`, `icon`, `enterprise_id`, `status`, `created_by`, `created_date`, `updated_by`, `updated_date`, `deleted_by`, `deleted_date`) VALUES
(42, 'C27MXHPF', '', 'Photography', 0, 1, 1, NULL, '1', 1, '1', '2022-04-27 16:43:37', '1', '2022-04-27 16:43:37', '', NULL),
(43, 'C27E975C', 'C27MXHPF', 'Nature', 0, 0, 0, NULL, '1', 1, '1', '2022-04-27 16:44:05', '1', '2022-04-27 16:44:05', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `certificate_mapping_tbl`
--

CREATE TABLE `certificate_mapping_tbl` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `course_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `certificate_id` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments_tbl`
--

CREATE TABLE `comments_tbl` (
  `id` int(11) NOT NULL,
  `comment_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=inactive and 1=active',
  `user_type` int(11) NOT NULL,
  `enterprise_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `communicate_tbl`
--

CREATE TABLE `communicate_tbl` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `attachment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enterprise_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `communicate_types` int(11) NOT NULL COMMENT '1=sms and 2=email',
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `communicate_tbl`
--

INSERT INTO `communicate_tbl` (`id`, `user_id`, `type`, `title`, `message`, `attachment`, `enterprise_id`, `communicate_types`, `created_by`, `created_date`) VALUES
(1, 'F16IZ2JLS', 5, 'Demo Email', '<p>dummy</p>\r\n', 'assets/uploads/attachments/2022-03-30/defceee08a4e419c3619476a9f014add.pdf', '1', 2, '1', '2022-03-30 05:34:44');

-- --------------------------------------------------------

--
-- Table structure for table `company_tbl`
--

CREATE TABLE `company_tbl` (
  `id` int(11) NOT NULL,
  `company_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ordering` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contactus_tbl`
--

CREATE TABLE `contactus_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `whoami` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `organization` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `preffered_date` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `enterprise_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_history_tbl`
--

CREATE TABLE `coupon_history_tbl` (
  `coupon_invoice_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `invoice_id` varchar(100) NOT NULL,
  `coupon_code` varchar(100) NOT NULL,
  `date_of_apply` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_tbl`
--

CREATE TABLE `coupon_tbl` (
  `id` int(11) NOT NULL,
  `coupon_id` varchar(11) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `discount_type` int(11) NOT NULL,
  `coupon_discount` decimal(10,2) NOT NULL,
  `discount_limit` decimal(10,2) NOT NULL,
  `expiry_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `enterprise_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(50) NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(50) NOT NULL,
  `deleted_by` varchar(50) NOT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coupon_tbl`
--

INSERT INTO `coupon_tbl` (`id`, `coupon_id`, `coupon_code`, `discount_type`, `coupon_discount`, `discount_limit`, `expiry_date`, `enterprise_id`, `status`, `created_date`, `created_by`, `updated_date`, `updated_by`, `deleted_by`, `deleted_date`) VALUES
(3, 'C11BIDCY', 'EID50', 2, 50.00, 0.00, '2022-05-15 16:00:00', 1, 1, '2022-05-11 06:26:09', '1', '2022-05-11 16:26:09', '1', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coursequiz_tbl`
--

CREATE TABLE `coursequiz_tbl` (
  `id` int(11) NOT NULL,
  `course_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `quiz` longtext COLLATE utf8_unicode_ci NOT NULL,
  `ans` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coursesave_tbl`
--

CREATE TABLE `coursesave_tbl` (
  `id` int(11) NOT NULL,
  `course_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `student_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=save and 0=unsave',
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_offers_tbl`
--

CREATE TABLE `course_offers_tbl` (
  `id` int(11) NOT NULL,
  `course_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `course_offerid` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_resource_tbl`
--

CREATE TABLE `course_resource_tbl` (
  `id` int(11) NOT NULL,
  `course_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `chapter_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lesson_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `files` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `course_resource_tbl`
--

INSERT INTO `course_resource_tbl` (`id`, `course_id`, `chapter_id`, `lesson_id`, `files`, `created_date`, `created_by`) VALUES
(600, 'CO27V632V', NULL, NULL, 'assets/uploads/downloadfile/27125239-f-exportTitle.pdf', '2022-04-27 06:52:39', '1'),
(601, 'CO27V632V', 'SE27YFYJS', 'LE27R76LY', 'assets/uploads/downloadfile/27125412-f-exportTitle.pdf', '2022-04-27 06:54:12', '1');

-- --------------------------------------------------------

--
-- Table structure for table `course_tbl`
--

CREATE TABLE `course_tbl` (
  `id` int(11) NOT NULL,
  `course_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `faculty_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `summary` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `subcategory_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `course_level` int(11) DEFAULT NULL COMMENT '1=beginner, 2=intermediate and 3=advanced',
  `language` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tagstatus` int(11) DEFAULT NULL COMMENT '1=recomended, 2=best seller, 3=new, 4=popular and 5=trending',
  `toexplore` int(11) NOT NULL COMMENT '1=yes and 0=no',
  `is_popular` int(11) DEFAULT NULL COMMENT '1=yes and 0 = no',
  `course_type` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '1=purchase, 2=subscription, 3=free and 4=govt	',
  `is_new` int(11) NOT NULL COMMENT '1=new and 0=default',
  `requirements` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `benifits` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `commission` decimal(10,2) DEFAULT NULL,
  `is_free` int(11) DEFAULT NULL COMMENT '1=yes and 0 = no',
  `share_percent` float DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `oldprice` decimal(10,0) DEFAULT NULL,
  `is_discount` int(11) DEFAULT NULL COMMENT '1=yes and 2 = no',
  `discount` float DEFAULT NULL,
  `discount_type` int(11) NOT NULL COMMENT '1=fixed and 2=percent',
  `is_offer` int(11) NOT NULL,
  `offer_courseprice` decimal(10,2) NOT NULL,
  `related_courseid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `course_provider` int(11) DEFAULT NULL COMMENT '1=youtube and 2 = vimeo',
  `url` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `syllabus` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `syllabus_filename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `course_material` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `course_result` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `course_isfor` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `skillsgain` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `career_outcomes` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `related_resource` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `cover_thumbnail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cover_thumbnail_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hover_thumbnail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hover_thumbnail_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `docusign` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `submit_agreement` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `agreement_status` int(11) NOT NULL COMMENT '1=pending, 2=done, 3=upload and 4=reject',
  `agreement_reason` text COLLATE utf8_unicode_ci NOT NULL,
  `welcome_msg` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `congratulation_msg` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keyword` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=active, 2 = inactive, 3 = delete and 4 reject',
  `is_draft` int(11) DEFAULT NULL COMMENT '0=complete and 1=draft',
  `is_livecourse` int(11) NOT NULL COMMENT '0=course, 1=live course and 2=live event',
  `event_date` date DEFAULT NULL,
  `is_termsagree` int(11) DEFAULT NULL,
  `sales_benefits` int(11) DEFAULT NULL,
  `subscription_benefits` int(11) DEFAULT NULL,
  `certificate_id` int(11) NOT NULL,
  `passing_grade` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `feedback` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT current_timestamp(),
  `deleted_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL,
  `published_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `published_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `course_tbl`
--

INSERT INTO `course_tbl` (`id`, `course_id`, `faculty_id`, `name`, `summary`, `description`, `category_id`, `subcategory_id`, `course_level`, `language`, `tagstatus`, `toexplore`, `is_popular`, `course_type`, `is_new`, `requirements`, `benifits`, `commission`, `is_free`, `share_percent`, `price`, `oldprice`, `is_discount`, `discount`, `discount_type`, `is_offer`, `offer_courseprice`, `related_courseid`, `course_provider`, `url`, `syllabus`, `syllabus_filename`, `course_material`, `course_result`, `course_isfor`, `skillsgain`, `career_outcomes`, `related_resource`, `cover_thumbnail`, `cover_thumbnail_name`, `hover_thumbnail`, `hover_thumbnail_name`, `docusign`, `submit_agreement`, `agreement_status`, `agreement_reason`, `welcome_msg`, `congratulation_msg`, `meta_keyword`, `meta_description`, `slug`, `status`, `is_draft`, `is_livecourse`, `event_date`, `is_termsagree`, `sales_benefits`, `subscription_benefits`, `certificate_id`, `passing_grade`, `feedback`, `enterprise_id`, `created_by`, `created_date`, `updated_by`, `updated_date`, `deleted_by`, `deleted_date`, `published_by`, `published_date`) VALUES
(118, 'CO27V632V', 'F27BEQFJ5', 'Nature photography', NULL, '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n', 'C27E975C', 'C27E975C', 2, 'english', NULL, 0, 0, '[\"2\"]', 0, '[\"Lorem ipsum dolor sit amet, consectetur \"]', '[\"Lorem ipsum dolor sit amet, consectetur \"]', NULL, 0, NULL, 0, NULL, 0, NULL, 0, 0, 0.00, '0', 2, 'https://vimeo.com/703599611', 'assets/uploads/course/2022-04-27/323f99ff63770406226abbf8c7105449.pdf', 'DHQ 2022 new English.pdf', NULL, '', '', '[\"photography basic\"]', '[\"Lorem ipsum dolor sit amet, consectetur \"]', '[\"tree.com\"]', 'assets/uploads/course/2022-04-27/c866bd58e25a89c15c7f80ed70c9a19e.jpg', '1584276101_3d_psd_background_.jpg', '', '', NULL, NULL, 0, '', NULL, NULL, 'Nature photography', NULL, 'nature-photography', 1, 0, 0, NULL, NULL, NULL, NULL, 0, '', NULL, '1', '1', '2022-04-27 16:52:39', '1', '2022-04-27 16:54:41', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `currencyid` int(11) NOT NULL,
  `currencyname` varchar(50) NOT NULL,
  `curr_icon` varchar(50) NOT NULL,
  `position` int(11) NOT NULL DEFAULT 1 COMMENT '1=left.2=right',
  `curr_rate` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` int(11) NOT NULL,
  `enterprise_id` varchar(20) NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `daily_watch_time_tbl`
--

CREATE TABLE `daily_watch_time_tbl` (
  `id` int(11) NOT NULL,
  `course_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `real_time` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `studentwatchTime` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `watchdatetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `student_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `lesson_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `daily_watch_time_tbl`
--

INSERT INTO `daily_watch_time_tbl` (`id`, `course_id`, `real_time`, `studentwatchTime`, `date`, `watchdatetime`, `student_id`, `lesson_id`, `enterprise_id`) VALUES
(57, 'CO27V632V', '599', '599.567', '2022-04-27', '2022-04-27 18:04:44', 'ST2793YBB6', 'LE27R76LY', '1'),
(58, 'CO27V632V', '64', '64.917', '2022-05-09', '2022-05-09 19:41:54', 'ST09COMMOR', 'LE27R76LY', '1');

-- --------------------------------------------------------

--
-- Table structure for table `education_tbl`
--

CREATE TABLE `education_tbl` (
  `id` int(11) NOT NULL,
  `log_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `institutename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `degree` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `passing_year` year(4) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enterprise_tbl`
--

CREATE TABLE `enterprise_tbl` (
  `id` int(11) NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `student_capacity` int(11) NOT NULL,
  `faculty_capacity` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `agree_toterms` int(11) DEFAULT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_tbl`
--

CREATE TABLE `exam_tbl` (
  `id` int(11) NOT NULL,
  `exam_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pass_mark` decimal(10,2) NOT NULL,
  `duration` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0=inactive, 1=active and 2=delete',
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `experience_tbl`
--

CREATE TABLE `experience_tbl` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `companyname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `frommonth` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fromyear` year(4) DEFAULT NULL,
  `tomonth` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `toyear` year(4) DEFAULT NULL,
  `is_now` int(11) NOT NULL COMMENT '1=now and 0=not now',
  `status` int(11) NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_certificate_tbl`
--

CREATE TABLE `faculty_certificate_tbl` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `certificatename` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `institute_logo` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `year` year(4) NOT NULL,
  `certificate` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `enterprise_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_tbl`
--

CREATE TABLE `faculty_tbl` (
  `id` int(11) NOT NULL,
  `faculty_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'faculty id = log id',
  `name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` date NOT NULL,
  `designation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_profileshow` tinyint(4) DEFAULT NULL,
  `is_resumeshow` tinyint(4) DEFAULT NULL,
  `resume` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `biography` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_biographyshow` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_skillshow` tinyint(4) DEFAULT NULL,
  `skills` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_proficiencyshow` tinyint(4) DEFAULT NULL,
  `is_featureshow` tinyint(4) NOT NULL,
  `is_experienceshow` tinyint(4) DEFAULT NULL,
  `is_educationshow` tinyint(4) DEFAULT NULL,
  `is_contactshow` tinyint(4) DEFAULT NULL,
  `is_certificateshow` int(11) DEFAULT NULL,
  `contact_text` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coverpicture` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paypal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meeting_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meeting_password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1=yes and 2=no',
  `agree_toterms` int(11) DEFAULT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `faculty_tbl`
--

INSERT INTO `faculty_tbl` (`id`, `faculty_id`, `name`, `mobile`, `email`, `birthday`, `designation`, `website`, `is_profileshow`, `is_resumeshow`, `resume`, `biography`, `is_biographyshow`, `is_skillshow`, `skills`, `is_proficiencyshow`, `is_featureshow`, `is_experienceshow`, `is_educationshow`, `is_contactshow`, `is_certificateshow`, `contact_text`, `public_email`, `coverpicture`, `address`, `language`, `paypal`, `meeting_id`, `meeting_password`, `status`, `agree_toterms`, `enterprise_id`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(33, 'F27BEQFJ5', 'Akbar Hossain', '01827928777', 'akbar22@gmail.com', '1984-07-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Mohammadpur, Dhaka', NULL, '', NULL, NULL, 1, NULL, '1', '1', '2022-04-27 16:36:26', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `faq_tbl`
--

CREATE TABLE `faq_tbl` (
  `id` int(11) NOT NULL,
  `question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `answer` text COLLATE utf8_unicode_ci NOT NULL,
  `course_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=coursefaq,2=sitefaq',
  `status` int(11) NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `faq_tbl`
--

INSERT INTO `faq_tbl` (`id`, `question`, `answer`, `course_id`, `type`, `status`, `enterprise_id`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'Who are we', 'Lead Academy is a comprehensive online learning platform', '', 2, 1, '1', '1', '2022-03-19 15:47:32', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `featuredin_tbl`
--

CREATE TABLE `featuredin_tbl` (
  `id` int(11) NOT NULL,
  `featuredin_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `summary` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `ordering` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=our features and 2=featuredin',
  `status` int(11) NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `featuredin_tbl`
--

INSERT INTO `featuredin_tbl` (`id`, `featuredin_id`, `name`, `link`, `summary`, `ordering`, `type`, `status`, `enterprise_id`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(7, 'OF12JIK', 'K5-K12', 'https://lead.academy/admin/allcourse/', ' Homework support, STEM education, and Coding', 1, 1, 0, '1', '1', '2022-01-12 08:18:13', '1', '2022-01-12 14:18:13'),
(8, 'OF12GMX', 'Social & National Interest courses', 'https://lead.academy/admin/allcourse/', 'Courses aligned with national interests and vision 2041', 2, 1, 0, '1', '1', '2022-01-12 08:18:29', '1', '2022-01-12 14:18:29'),
(9, 'OF12DHW', 'Certified professional degrees', 'https://lead.academy/admin/allcourse/', 'National and International certified courses curated by local & int industry experts', 3, 1, 0, '1', '1', '2022-01-12 08:18:41', '1', '2022-01-12 14:18:41'),
(10, 'OF12HYV', 'Skills gap based courses and skills mapping', 'https://lead.academy/admin/allcourse/', 'The diverse range of course categories based on mass-market research on the skills gap ', 4, 1, 0, '1', '1', '2022-01-12 08:18:51', '1', '2022-01-12 14:18:51'),
(11, 'CM26WIV', 'ts', '', NULL, 1, 2, 0, '1', '1', '2022-03-08 12:21:40', '1', '2022-03-08 18:21:40'),
(12, 'CM26HPQ', 'ICT DIVISION', '', NULL, 0, 2, 0, '1', '1', '2022-03-08 12:21:36', '1', '2022-03-08 18:21:36'),
(14, 'CM26SKH', 'AS', '', NULL, 0, 2, 0, '1', '1', '2022-03-08 12:21:24', '1', '2022-03-08 18:21:24'),
(21, 'CM08X44', 'CNI', '', NULL, 1, 2, 0, '1', '1', '2022-03-08 18:20:11', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `following_tbl`
--

CREATE TABLE `following_tbl` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `follower_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forum_category_tbl`
--

CREATE TABLE `forum_category_tbl` (
  `id` int(11) NOT NULL,
  `forum_category_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forum_tbl`
--

CREATE TABLE `forum_tbl` (
  `id` int(11) NOT NULL,
  `forum_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `is_front` int(11) NOT NULL COMMENT '1=yes and 0= no',
  `is_slide` int(11) NOT NULL COMMENT '1=yes and 0=no',
  `status` int(11) NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gateway_tbl`
--

CREATE TABLE `gateway_tbl` (
  `id` int(11) NOT NULL,
  `payment_gateway` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ClientID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ClientSecret` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `currency` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0' COMMENT '0=development, 1=production'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gateway_tbl`
--

INSERT INTO `gateway_tbl` (`id`, `payment_gateway`, `ClientID`, `ClientSecret`, `currency`, `enterprise_id`, `created_by`, `created_date`, `updated_by`, `updated_date`, `status`) VALUES
(1, 'paypal', 'AXKuwW4pok80L076lC-Iu7MXJv7-exmNlwjUGJMNMr2WJy-NntpD8VFtIE_fIwruH8-3WbgxjnShIFdU', 'EAob2nD46nSW13ENZyceX96KXFjvbJGYQCaERsCIe-AF6hX2kOqVI89jGa1qX5Ih4j3FmpUfZyKUKSr5', 'AUD', '1', 1, '0000-00-00', 1, '2021-08-13 18:00:00', 'sandbox');

-- --------------------------------------------------------

--
-- Table structure for table `instructor_ledger_tbl`
--

CREATE TABLE `instructor_ledger_tbl` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'invoice id and transactionid are same',
  `user_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `course_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_subscription` int(11) NOT NULL COMMENT '0=purchase and 1=subscription',
  `subscription_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `duration` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `share_percent` float DEFAULT NULL,
  `debit` float NOT NULL,
  `credit` float NOT NULL,
  `status` int(11) NOT NULL,
  `enterprise_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructor_paymentmethods_tbl`
--

CREATE TABLE `instructor_paymentmethods_tbl` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payment_type` int(11) NOT NULL COMMENT '1=bkash, 2=nogod, 3=rocket and 4=bank',
  `bank_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `branch_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_number` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0=inactive and 1=active',
  `enterprise_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interests_topics_tbl`
--

CREATE TABLE `interests_topics_tbl` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `enterprise_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` int(11) NOT NULL,
  `invoice_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_details_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `discount` float NOT NULL,
  `total_price` float NOT NULL,
  `discount_amount` float NOT NULL,
  `tax` float NOT NULL,
  `invoice_date` date NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL,
  `complete_status` int(11) NOT NULL COMMENT 'course complete =1, other wise =0',
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `is_subscription` int(11) NOT NULL COMMENT '0=purchase,\r\n1-subscription,2=free 3=gov,\r\n4=Event live and Free event'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice_id`, `customer_id`, `invoice_details_id`, `product_id`, `quantity`, `price`, `discount`, `total_price`, `discount_amount`, `tax`, `invoice_date`, `created_date`, `status`, `complete_status`, `enterprise_id`, `is_subscription`) VALUES
(496, 'INVETZ1LEX', 'ST2793YBB6', 'INVD2FUNJCUA', 'CO27V632V', 0, 0, 0, 0, 0, 0, '2022-04-27', '2022-04-27 07:50:28', 1, 0, '1', 1),
(497, 'INVNKVKVUZ', 'ST09COMMOR', 'INVDX3P9Q8UH', 'CO27V632V', 0, 0, 0, 0, 0, 0, '2022-05-09', '2022-05-09 09:17:56', 1, 0, '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_tbl`
--

CREATE TABLE `invoice_tbl` (
  `id` int(11) NOT NULL,
  `invoice_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `invoice` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `is_different` int(11) DEFAULT NULL,
  `is_inhouse` int(11) NOT NULL COMMENT '1=In and 2 = out',
  `shipping_method` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` varchar(55) COLLATE utf8_unicode_ci NOT NULL COMMENT '1=cash, 2=paypal',
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `invoice_discount` float NOT NULL,
  `total_discount` float NOT NULL,
  `total_amount` float NOT NULL,
  `paid_amount` float NOT NULL,
  `due_amount` float NOT NULL,
  `total_tax` float NOT NULL,
  `is_subscription` int(11) NOT NULL COMMENT '0=purchase,\r\n1-subscription,2=free 3=gov',
  `subscription_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 = pending, 1 = Processing and 2 = Delivered',
  `expeiredate` date DEFAULT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoice_tbl`
--

INSERT INTO `invoice_tbl` (`id`, `invoice_id`, `customer_id`, `date`, `invoice`, `is_different`, `is_inhouse`, `shipping_method`, `payment_method`, `description`, `invoice_discount`, `total_discount`, `total_amount`, `paid_amount`, `due_amount`, `total_tax`, `is_subscription`, `subscription_id`, `enterprise_id`, `status`, `expeiredate`, `created_by`, `created_at`, `updated_by`, `updated_date`) VALUES
(66, 'INVETZ1LEX', 'ST2793YBB6', '2022-04-27', '1027', 0, 2, '0', '1', '', 0, 0, 20, 20, 0, 0, 1, 'sub08RII9T', '1', 1, '2022-05-27', '', '2022-04-27 07:19:12', '', NULL),
(67, 'INVNKVKVUZ', 'ST09COMMOR', '2022-05-09', '1028', 0, 2, '0', '1', '', 0, 0, 10, 10, 0, 0, 1, 'sub08RII9T', '1', 1, '2022-06-08', '', '2022-05-09 09:19:30', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `phrase` varchar(100) NOT NULL,
  `english` varchar(255) NOT NULL,
  `bangla` text DEFAULT NULL,
  `arabic` text DEFAULT NULL,
  `urdhu` text DEFAULT NULL,
  `spanish` text DEFAULT NULL,
  `hindi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `phrase`, `english`, `bangla`, `arabic`, `urdhu`, `spanish`, `hindi`) VALUES
(1, 'email', 'Email', NULL, NULL, NULL, NULL, NULL),
(2, 'password', 'Password', NULL, NULL, NULL, NULL, NULL),
(3, 'login', 'Login', NULL, NULL, NULL, NULL, NULL),
(4, 'logout', 'Logout', NULL, NULL, NULL, NULL, NULL),
(5, 'setting', 'Setting', NULL, NULL, NULL, NULL, NULL),
(6, 'profile', 'My Profile', NULL, NULL, NULL, NULL, NULL),
(7, 'dashboard', 'Dashboard', NULL, NULL, NULL, NULL, NULL),
(8, 'role_permission', 'Role Permission', NULL, NULL, NULL, NULL, NULL),
(9, 'permission_setup', 'Permission Setup', NULL, NULL, NULL, NULL, NULL),
(10, 'add_role', 'Assign role to user', NULL, NULL, NULL, NULL, NULL),
(11, 'role_list', 'Role List', NULL, NULL, NULL, NULL, NULL),
(12, 'user_access_role', 'User Access Role List', NULL, NULL, NULL, NULL, NULL),
(13, 'add_module_permission', 'Add Module Permission', NULL, NULL, NULL, NULL, NULL),
(14, 'module_permission_list', 'Module Permission List', NULL, NULL, NULL, NULL, NULL),
(15, 'language', 'Language', NULL, NULL, NULL, NULL, NULL),
(16, 'application_setting', 'Application Setting', NULL, NULL, NULL, NULL, NULL),
(17, 'message', 'Message', NULL, NULL, NULL, NULL, NULL),
(18, 'new', 'New', NULL, NULL, NULL, NULL, NULL),
(19, 'inbox', 'inbox', NULL, NULL, NULL, NULL, NULL),
(20, 'sent', 'Sent', NULL, NULL, NULL, NULL, NULL),
(21, 'user', 'User', NULL, NULL, NULL, NULL, NULL),
(22, 'add_user', 'Add User', NULL, NULL, NULL, NULL, NULL),
(23, 'user_list', 'User List', NULL, NULL, NULL, NULL, NULL),
(24, 'reset', 'Reset', NULL, NULL, NULL, NULL, NULL),
(25, 'save', 'Save', NULL, NULL, NULL, NULL, NULL),
(26, 'status', 'Status', NULL, NULL, NULL, NULL, NULL),
(27, 'lastname', 'Last Name', NULL, NULL, NULL, NULL, NULL),
(28, 'firstname', 'First Name', NULL, NULL, NULL, NULL, NULL),
(29, 'about', 'About', NULL, NULL, NULL, NULL, NULL),
(30, 'save_successfully', 'Save Successfully', NULL, NULL, NULL, NULL, NULL),
(31, 'please_try_again', 'Please Try Again Later!!!', NULL, NULL, NULL, NULL, NULL),
(32, 'update_successfully', 'Successfully Updated', NULL, NULL, NULL, NULL, NULL),
(33, 'admin', 'Admin', NULL, NULL, NULL, NULL, NULL),
(34, 'are_you_sure', 'Are you sure ?', NULL, NULL, NULL, NULL, NULL),
(35, 'sl_no', 'SL No.', NULL, NULL, NULL, NULL, NULL),
(36, 'image', 'Image', NULL, NULL, NULL, NULL, NULL),
(37, 'username', 'Username', NULL, NULL, NULL, NULL, NULL),
(38, 'last_login', 'Last Login', NULL, NULL, NULL, NULL, NULL),
(39, 'last_logout', 'Last Logout', NULL, NULL, NULL, NULL, NULL),
(40, 'ip_address', 'Ip Address', NULL, NULL, NULL, NULL, NULL),
(41, 'action', 'Action', NULL, NULL, NULL, NULL, NULL),
(42, 'menu_item_list', ' Menu Item List', NULL, NULL, NULL, NULL, NULL),
(43, 'ins_menu_for_application', 'Ins Menu For Application', NULL, NULL, NULL, NULL, NULL),
(44, 'menu_title', ' Menu Title', NULL, NULL, NULL, NULL, NULL),
(45, 'page_url', 'Page Url', NULL, NULL, NULL, NULL, NULL),
(46, 'module', ' Module', NULL, NULL, NULL, NULL, NULL),
(47, 'parent_menu', 'Parent Menu', NULL, NULL, NULL, NULL, NULL),
(48, 'role_name', 'Role Name', NULL, NULL, NULL, NULL, NULL),
(49, 'description', 'Description', NULL, NULL, NULL, NULL, NULL),
(50, 'role', 'Role', NULL, NULL, NULL, NULL, NULL),
(51, 'add', 'Add', NULL, NULL, NULL, NULL, NULL),
(52, 'update', 'Update', NULL, NULL, NULL, NULL, NULL),
(53, 'application_title', 'Application Title', NULL, NULL, NULL, NULL, NULL),
(54, 'address', 'Address', NULL, NULL, NULL, NULL, NULL),
(55, 'phone', 'Phone', NULL, NULL, NULL, NULL, NULL),
(56, 'favicon', 'Favicon', NULL, NULL, NULL, NULL, NULL),
(57, 'logo', 'Logo', NULL, NULL, NULL, NULL, NULL),
(59, 'site_align', 'Application Alignment', NULL, NULL, NULL, NULL, NULL),
(60, 'footer_text', 'Footer Text', NULL, NULL, NULL, NULL, NULL),
(61, 'left_to_right', 'Left To Right', NULL, NULL, NULL, NULL, NULL),
(62, 'right_to_left', 'Right To Left', NULL, NULL, NULL, NULL, NULL),
(74, 'delete_successfully', 'Delete Successfully', NULL, NULL, NULL, NULL, NULL),
(75, 'find', 'Find', NULL, NULL, NULL, NULL, NULL),
(76, 'from_date', 'From Date', NULL, NULL, NULL, NULL, NULL),
(77, 'to_date', 'To Date', NULL, NULL, NULL, NULL, NULL),
(78, 'from', 'From', NULL, NULL, NULL, NULL, NULL),
(79, 'confirm', 'Confirm', NULL, NULL, NULL, NULL, NULL),
(80, 'save', 'Save', NULL, NULL, NULL, NULL, NULL),
(81, 'add_more', 'Add More', NULL, NULL, NULL, NULL, NULL),
(82, 'total', 'Total', NULL, NULL, NULL, NULL, NULL),
(83, 'create', 'Create', NULL, NULL, NULL, NULL, NULL),
(84, 'read', 'Read', NULL, NULL, NULL, NULL, NULL),
(85, 'update', 'Update', NULL, NULL, NULL, NULL, NULL),
(86, 'delete', 'Delete', NULL, NULL, NULL, NULL, NULL),
(87, 'date', 'Date', NULL, NULL, NULL, NULL, NULL),
(88, 'notice_by', 'Notice By', NULL, NULL, NULL, NULL, NULL),
(89, 'empmgt', 'Employee Management', NULL, NULL, NULL, NULL, NULL),
(90, 'state', 'State', NULL, NULL, NULL, NULL, NULL),
(91, 'city', 'City', NULL, NULL, NULL, NULL, NULL),
(92, 'zip_code', 'Zip Code', NULL, NULL, NULL, NULL, NULL),
(93, 'search', 'Search', NULL, NULL, NULL, NULL, NULL),
(94, 'dob', 'Date of Birth', NULL, NULL, NULL, NULL, NULL),
(95, 'ssn', 'SSN', NULL, NULL, NULL, NULL, NULL),
(96, 'reports', 'Reports', NULL, NULL, NULL, NULL, NULL),
(97, 'picture', 'Picture', NULL, NULL, NULL, NULL, NULL),
(98, 'ad', 'Add', NULL, NULL, NULL, NULL, NULL),
(99, 'sl', 'SL', NULL, NULL, NULL, NULL, NULL),
(100, 'name', 'Name', NULL, NULL, NULL, NULL, NULL),
(101, 'id', 'ID', NULL, NULL, NULL, NULL, NULL),
(102, 'invoice_no', 'Invoice No', NULL, NULL, NULL, NULL, NULL),
(103, 'invoice', 'Invoice', NULL, NULL, NULL, NULL, NULL),
(104, 'mobile', 'Mobile', NULL, NULL, NULL, NULL, NULL),
(105, 'title', 'Title', NULL, NULL, NULL, NULL, NULL),
(106, 'amount', 'Total Amount', NULL, NULL, NULL, NULL, NULL),
(107, 'price', 'Price', NULL, NULL, NULL, NULL, NULL),
(108, 'filter', 'Filter', NULL, NULL, NULL, NULL, NULL),
(109, 'welcome_back', 'Welcome Back', NULL, NULL, NULL, NULL, NULL),
(110, 'emplist', 'Employee List', NULL, NULL, NULL, NULL, NULL),
(111, 'manage_emp', 'Manage Employee', NULL, NULL, NULL, NULL, NULL),
(112, 'type', 'Type', NULL, NULL, NULL, NULL, NULL),
(113, 'nid', 'NID', NULL, NULL, NULL, NULL, NULL),
(114, 'department', 'Department', NULL, NULL, NULL, NULL, NULL),
(115, 'designation', 'Designation', NULL, NULL, NULL, NULL, NULL),
(116, 'emp_add', 'Add Employee', NULL, NULL, NULL, NULL, NULL),
(117, 'emp_name', 'Empployee Name', NULL, NULL, NULL, NULL, NULL),
(118, 'emp_nid', 'Employee NID', NULL, NULL, NULL, NULL, NULL),
(119, 'emp_code', 'Employee Code', NULL, NULL, NULL, NULL, NULL),
(120, 'pay_roll_type', 'Pay Roll Type', NULL, NULL, NULL, NULL, NULL),
(121, 'emp_type', 'Employee Type', NULL, NULL, NULL, NULL, NULL),
(122, 'join_date', 'Join Date', NULL, NULL, NULL, NULL, NULL),
(123, 'blood', 'Blood Group', NULL, NULL, NULL, NULL, NULL),
(124, 'working_slot_from', 'Working Slot From', NULL, NULL, NULL, NULL, NULL),
(125, 'working_slot_to', 'Working Slot To', NULL, NULL, NULL, NULL, NULL),
(126, 'fater_name', 'Father Name', NULL, NULL, NULL, NULL, NULL),
(127, 'mother_name', 'Mother Name', NULL, NULL, NULL, NULL, NULL),
(128, 'present_cont', 'Present Contact', NULL, NULL, NULL, NULL, NULL),
(129, 'present_address', 'Present Address', NULL, NULL, NULL, NULL, NULL),
(130, 'present_city', 'Present City', NULL, NULL, NULL, NULL, NULL),
(131, 'permanent_contact', 'Permanent Contact', NULL, NULL, NULL, NULL, NULL),
(132, 'permanent_address', 'Permanent Address', NULL, NULL, NULL, NULL, NULL),
(133, 'permanent_city', 'Permanent City', NULL, NULL, NULL, NULL, NULL),
(134, 'contact_person', 'Contact Person', NULL, NULL, NULL, NULL, NULL),
(135, 'contact_pmobile', 'Contact Person Mobile', NULL, NULL, NULL, NULL, NULL),
(136, 'referance', 'Reference Name', NULL, NULL, NULL, NULL, NULL),
(137, 'ref_mobile', 'Reference Mobile', NULL, NULL, NULL, NULL, NULL),
(138, 'ref_address', 'Reference Address', NULL, NULL, NULL, NULL, NULL),
(139, 'position', 'Position', NULL, NULL, NULL, NULL, NULL),
(140, 'position_name', 'Position Name', NULL, NULL, NULL, NULL, NULL),
(141, 'position_details', 'Details', NULL, NULL, NULL, NULL, NULL),
(142, 'department_name', 'Department Name', NULL, NULL, NULL, NULL, NULL),
(143, 'add_new_dept', 'Add New Department', NULL, NULL, NULL, NULL, NULL),
(144, 'manage_dept', 'Manage Department', NULL, NULL, NULL, NULL, NULL),
(145, 'update_emp', 'Update Employee', NULL, NULL, NULL, NULL, NULL),
(146, 'search_area', 'Search Area', NULL, NULL, NULL, NULL, NULL),
(147, 'joining_d_fr', 'Joining Date From', NULL, NULL, NULL, NULL, NULL),
(148, 'joining_d_to', 'Joining Date To', NULL, NULL, NULL, NULL, NULL),
(149, 'driver_list', 'Driver List', NULL, NULL, NULL, NULL, NULL),
(150, 'add_driver', 'Add Driver', NULL, NULL, NULL, NULL, NULL),
(151, 'update_driver', 'Update Driver', NULL, NULL, NULL, NULL, NULL),
(152, 'license_type', 'License Type', NULL, NULL, NULL, NULL, NULL),
(153, 'license_number', 'License Number', NULL, NULL, NULL, NULL, NULL),
(154, 'driver_name', 'Driver Name', NULL, NULL, NULL, NULL, NULL),
(155, 'national_id', 'National ID', NULL, NULL, NULL, NULL, NULL),
(156, 'license_issue_date', 'License Issue Date', NULL, NULL, NULL, NULL, NULL),
(157, 'is_active', 'Is Active', NULL, NULL, NULL, NULL, NULL),
(158, 'authorization_code', 'Authorization Code', NULL, NULL, NULL, NULL, NULL),
(159, 'add_license_type', 'Add License Type', NULL, NULL, NULL, NULL, NULL),
(160, 'license_name', 'License Name', NULL, NULL, NULL, NULL, NULL),
(161, 'vehiclemgt', 'Vehicle Management', NULL, NULL, NULL, NULL, NULL),
(162, 'vehiclelist', 'Vehicle List', NULL, NULL, NULL, NULL, NULL),
(163, 'insurance_list', 'Insurance List', NULL, NULL, NULL, NULL, NULL),
(164, 'manage_legal_document', 'Manage Legal Document', NULL, NULL, NULL, NULL, NULL),
(165, 'manage_reminder', 'Manage Reminder', NULL, NULL, NULL, NULL, NULL),
(166, 'vehiclereq', 'Vehicle Requisition', NULL, NULL, NULL, NULL, NULL),
(167, 'vehiclereqlist', 'Vehicle Requisition List', NULL, NULL, NULL, NULL, NULL),
(168, 'track_vehicle_req_list', 'Track Vehicle Requisition List', NULL, NULL, NULL, NULL, NULL),
(169, 'approve_authority_list', 'Approval Authority List', NULL, NULL, NULL, NULL, NULL),
(170, 'vehicle_route_list', 'Vehicle Route List', NULL, NULL, NULL, NULL, NULL),
(171, 'pick_drop_requi_list', 'Pick & Drop Requisition List', NULL, NULL, NULL, NULL, NULL),
(172, 'maintenance', 'Maintenance', NULL, NULL, NULL, NULL, NULL),
(173, 'maintenance_req_list', 'Maintenance Req. List', NULL, NULL, NULL, NULL, NULL),
(174, 'maintainance_service_list', 'Maintenance Service List', NULL, NULL, NULL, NULL, NULL),
(175, 'pm_service_list', 'PM Service List', NULL, NULL, NULL, NULL, NULL),
(176, 'costinventory', 'Cost & Inventory', NULL, NULL, NULL, NULL, NULL),
(177, 'expence_type_list', 'Expence Type List', NULL, NULL, NULL, NULL, NULL),
(178, 'inventory_stock_list', 'Inventory Stock List', NULL, NULL, NULL, NULL, NULL),
(179, 'stock_dispatch', 'Stock Dispatch List', NULL, NULL, NULL, NULL, NULL),
(180, 'parts_list', 'Parts List', NULL, NULL, NULL, NULL, NULL),
(181, 'refueling', 'Refueling', NULL, NULL, NULL, NULL, NULL),
(182, 'refuel_setting_list', 'Refuel Setting List', NULL, NULL, NULL, NULL, NULL),
(183, 'fuel_station_list', 'Fuel Station List', NULL, NULL, NULL, NULL, NULL),
(184, 'refuel_requisition_list', 'Refuel Requisition List', NULL, NULL, NULL, NULL, NULL),
(185, 'refuel_requisitiontrack_list', 'Refuel Requisition Track List', NULL, NULL, NULL, NULL, NULL),
(186, 'renewal_report', 'Renewal Report', NULL, NULL, NULL, NULL, NULL),
(187, 'reports', 'Reports', NULL, NULL, NULL, NULL, NULL),
(188, 'pick_drop_req_list', 'Pick & Drop Req. List', NULL, NULL, NULL, NULL, NULL),
(189, 'milage_list', 'Milage List', NULL, NULL, NULL, NULL, NULL),
(190, 'expense_list', 'Expense List', NULL, NULL, NULL, NULL, NULL),
(191, 'track_vehicle_list', 'Track Vehicle List', NULL, NULL, NULL, NULL, NULL),
(192, 'license_list', 'License List', NULL, NULL, NULL, NULL, NULL),
(193, 'update_license', 'Update License', NULL, NULL, NULL, NULL, NULL),
(194, 'vehicle_setting_list', 'Vehicle Setting List', NULL, NULL, NULL, NULL, NULL),
(195, 'vehicle_name', 'Vehicle Name', NULL, NULL, NULL, NULL, NULL),
(196, 'vin_sn', 'VIN/SN', NULL, NULL, NULL, NULL, NULL),
(197, 'registration_date', 'Registration Date', NULL, NULL, NULL, NULL, NULL),
(198, 'license_plate', 'License Plate', NULL, NULL, NULL, NULL, NULL),
(199, 'al_cell_no', 'Alert Cell No', NULL, NULL, NULL, NULL, NULL),
(200, 'al_email', 'Alert Email', NULL, NULL, NULL, NULL, NULL),
(201, 'ownership', 'Ownership', NULL, NULL, NULL, NULL, NULL),
(202, 'vehicle_type', 'Vehicle Type', NULL, NULL, NULL, NULL, NULL),
(203, 'vehicle_division', 'Vehicle Division', NULL, NULL, NULL, NULL, NULL),
(204, 'brta_office', 'BRTA Circle Office', NULL, NULL, NULL, NULL, NULL),
(205, 'driver', 'Driver', NULL, NULL, NULL, NULL, NULL),
(206, 'vendor', 'Vendor', NULL, NULL, NULL, NULL, NULL),
(207, 'seat_capicity', 'Seat Capacity (With Driver)', NULL, NULL, NULL, NULL, NULL),
(208, 'add_vehicle', 'Add Vehicle', NULL, NULL, NULL, NULL, NULL),
(209, 'update_vehicle', 'Update Vehicle', NULL, NULL, NULL, NULL, NULL),
(210, 'vehicle', 'Vehicle', NULL, NULL, NULL, NULL, NULL),
(211, 'registration_date_fr', 'Registration Date From', NULL, NULL, NULL, NULL, NULL),
(212, 'registration_date_to', 'Registration Date To', NULL, NULL, NULL, NULL, NULL),
(213, 'reg_no', 'Registration No.', NULL, NULL, NULL, NULL, NULL),
(214, 'insurance_list', 'Insurance List', NULL, NULL, NULL, NULL, NULL),
(215, 'add_insurance', 'Add Insurance', NULL, NULL, NULL, NULL, NULL),
(216, 'company_name', 'Company Name', NULL, NULL, NULL, NULL, NULL),
(217, 'policy_number', 'Policy Number', NULL, NULL, NULL, NULL, NULL),
(218, 'start_date', 'Start Date', NULL, NULL, NULL, NULL, NULL),
(219, 'recurring_period', 'Recurring Period', NULL, NULL, NULL, NULL, NULL),
(220, 'add_remiender', 'Add Reminder', NULL, NULL, NULL, NULL, NULL),
(221, 'remarks', 'Remarks', NULL, NULL, NULL, NULL, NULL),
(222, 'charge_payable', 'Charge Payable', NULL, NULL, NULL, NULL, NULL),
(223, 'end_date', 'End Date', NULL, NULL, NULL, NULL, NULL),
(224, 'recurring_date', 'Recurring Date', NULL, NULL, NULL, NULL, NULL),
(225, 'deductible', 'Deductible', NULL, NULL, NULL, NULL, NULL),
(226, 'policy_document', 'Policy Document', NULL, NULL, NULL, NULL, NULL),
(227, 'date_fr', 'Date From', NULL, NULL, NULL, NULL, NULL),
(228, 'date_to', 'Date To', NULL, NULL, NULL, NULL, NULL),
(229, 'insurance_company', 'Insurance Company', NULL, NULL, NULL, NULL, NULL),
(230, 'legal_document_list', 'Legal Documentation List', NULL, NULL, NULL, NULL, NULL),
(231, 'add_legal_documentation', 'Add Legal Documentation', NULL, NULL, NULL, NULL, NULL),
(232, 'update_legal_documentation', 'Update Legal Documentation', NULL, NULL, NULL, NULL, NULL),
(233, 'document_type', 'Document Type', NULL, NULL, NULL, NULL, NULL),
(234, 'last_issue_date', 'Last Issue Date', NULL, NULL, NULL, NULL, NULL),
(235, 'expire_date', 'Expire Date', NULL, NULL, NULL, NULL, NULL),
(236, 'charge_paid', 'Charge Paid', NULL, NULL, NULL, NULL, NULL),
(237, 'commission', 'Commission', NULL, NULL, NULL, NULL, NULL),
(238, 'notification_before', 'Notification Before', NULL, NULL, NULL, NULL, NULL),
(239, 'sms', 'SMS', NULL, NULL, NULL, NULL, NULL),
(240, 'document_attachment', 'Document Attachment', NULL, NULL, NULL, NULL, NULL),
(241, 'search_legal_doc', 'Search Legal Documentation', NULL, NULL, NULL, NULL, NULL),
(242, 'exp_date_fr', 'Expire Date From', NULL, NULL, NULL, NULL, NULL),
(243, 'exp_date_to', 'Expire Date To', NULL, NULL, NULL, NULL, NULL),
(244, 'add_reminder', 'Add Reminder', NULL, NULL, NULL, NULL, NULL),
(245, 'update_reminder', 'Update Reminder', NULL, NULL, NULL, NULL, NULL),
(246, 'serach_reminder', 'Search Reminder', NULL, NULL, NULL, NULL, NULL),
(247, 'reminder_list', 'Reminder List', NULL, NULL, NULL, NULL, NULL),
(248, 'alert_type', 'Alert Type', NULL, NULL, NULL, NULL, NULL),
(249, 'remaining_days', 'Remaining Days', NULL, NULL, NULL, NULL, NULL),
(250, 'req_for', 'Requisition For', NULL, NULL, NULL, NULL, NULL),
(251, 'where_fr', 'Where From', NULL, NULL, NULL, NULL, NULL),
(252, 'where_to', 'Where To', NULL, NULL, NULL, NULL, NULL),
(253, 'pickup', 'Pick Up', NULL, NULL, NULL, NULL, NULL),
(254, 'req_date', 'Requisition Date', NULL, NULL, NULL, NULL, NULL),
(255, 'time_fr', 'Time From', NULL, NULL, NULL, NULL, NULL),
(256, 'time_to', 'Time To', NULL, NULL, NULL, NULL, NULL),
(257, 'tolerance', 'Tolerance Duration', NULL, NULL, NULL, NULL, NULL),
(258, 'nunpassenger', 'No of Passenger', NULL, NULL, NULL, NULL, NULL),
(259, 'drivenby', 'Driven By', NULL, NULL, NULL, NULL, NULL),
(260, 'purpose', 'Purpose', NULL, NULL, NULL, NULL, NULL),
(261, 'details', 'Details', NULL, NULL, NULL, NULL, NULL),
(262, 'req_list', 'Requisition List', NULL, NULL, NULL, NULL, NULL),
(263, 'add_req', 'Add Requisition', NULL, NULL, NULL, NULL, NULL),
(264, 'requiest_by', 'Requested By ', NULL, NULL, NULL, NULL, NULL),
(265, 'from', 'From', NULL, NULL, NULL, NULL, NULL),
(266, 'to', 'To', NULL, NULL, NULL, NULL, NULL),
(267, 'vehicle_route_list', 'Vehicle Route List', NULL, NULL, NULL, NULL, NULL),
(268, 'add_route', 'Add Route', NULL, NULL, NULL, NULL, NULL),
(269, 'update_route', 'Update Route', NULL, NULL, NULL, NULL, NULL),
(270, 'route_name', 'Route Name', NULL, NULL, NULL, NULL, NULL),
(271, 'destination', 'Destination', NULL, NULL, NULL, NULL, NULL),
(272, 'start_p', 'Start Point', NULL, NULL, NULL, NULL, NULL),
(273, 'descrip', 'Description', NULL, NULL, NULL, NULL, NULL),
(274, 'create_pickdrop_point', 'Create Pick and Drop Point', NULL, NULL, NULL, NULL, NULL),
(275, 'approval_auht_list', 'Approval Authority List', NULL, NULL, NULL, NULL, NULL),
(276, 'add_aprov_auth', 'Add Approval Authority ', NULL, NULL, NULL, NULL, NULL),
(277, 'req_type', 'Requisition Type', NULL, NULL, NULL, NULL, NULL),
(278, 'req_phase', 'Requisition Phase', NULL, NULL, NULL, NULL, NULL),
(279, 'department', 'Department', NULL, NULL, NULL, NULL, NULL),
(280, 'employee', 'Employee', NULL, NULL, NULL, NULL, NULL),
(281, 'pickdropreq_list', 'Pick & Drop Requisition', NULL, NULL, NULL, NULL, NULL),
(282, 'add_pick_drop', 'Add Pick and Drop Requisition', NULL, NULL, NULL, NULL, NULL),
(283, 'route', 'Route', NULL, NULL, NULL, NULL, NULL),
(284, 'request_date', 'Request Date', NULL, NULL, NULL, NULL, NULL),
(285, 'end_p', 'End Point', NULL, NULL, NULL, NULL, NULL),
(286, 'request_type', 'Request Type', NULL, NULL, NULL, NULL, NULL),
(287, 'regular', 'Regular', NULL, NULL, NULL, NULL, NULL),
(288, 'specificday', 'Specific Day', NULL, NULL, NULL, NULL, NULL),
(289, 'pickup', 'Pick Up', NULL, NULL, NULL, NULL, NULL),
(290, 'dropoff', 'Drop Off', NULL, NULL, NULL, NULL, NULL),
(291, 'pickdropoff', 'Pick Up & Drop Off', NULL, NULL, NULL, NULL, NULL),
(292, 'effective_date', 'Effective Date', NULL, NULL, NULL, NULL, NULL),
(293, 'new_expense', 'Add New Expense', NULL, NULL, NULL, NULL, NULL),
(294, 'add_expense', 'Add Expense', NULL, NULL, NULL, NULL, NULL),
(295, 'expense_group', 'Expense Group', NULL, NULL, NULL, NULL, NULL),
(296, 'expense_name', 'Expense Name', NULL, NULL, NULL, NULL, NULL),
(297, 'expence_cat', 'Expense category', NULL, NULL, NULL, NULL, NULL),
(298, 'fuel', 'Fuel', NULL, NULL, NULL, NULL, NULL),
(299, 'maintenance', 'Maintaenance', NULL, NULL, NULL, NULL, NULL),
(301, 'other', 'Other', NULL, NULL, NULL, NULL, NULL),
(302, 'trip_type', 'Trip Type', NULL, NULL, NULL, NULL, NULL),
(303, 'odomitter_millage', 'Odometer/Mileage', NULL, NULL, NULL, NULL, NULL),
(304, 'invoice', 'Invoice No.', NULL, NULL, NULL, NULL, NULL),
(305, 'expense_date', 'Expense Date', NULL, NULL, NULL, NULL, NULL),
(306, 'trip_number', 'Trip Number', NULL, NULL, NULL, NULL, NULL),
(307, 'by_whom', 'By Whom', NULL, NULL, NULL, NULL, NULL),
(308, 'measurement', 'Measurement Unit', NULL, NULL, NULL, NULL, NULL),
(309, 'unit_price', 'Unit Price', NULL, NULL, NULL, NULL, NULL),
(311, 'm_req_list', 'Maintenance Requisition List', NULL, NULL, NULL, NULL, NULL),
(312, 'add_maintenance', 'Add Maintenance', NULL, NULL, NULL, NULL, NULL),
(313, 'mainte_type', 'Maintenance Type', NULL, NULL, NULL, NULL, NULL),
(314, 'service_fr', 'Service From', NULL, NULL, NULL, NULL, NULL),
(315, 'general', 'General', NULL, NULL, NULL, NULL, NULL),
(317, 'main_ser_name', 'Maintenance Service Name', NULL, NULL, NULL, NULL, NULL),
(318, 'service_data', 'Service Data', NULL, NULL, NULL, NULL, NULL),
(319, 'charge', 'Charge', NULL, NULL, NULL, NULL, NULL),
(320, 'charge_bear_by', 'Charge Bear By', NULL, NULL, NULL, NULL, NULL),
(321, 'piority', 'Priority', NULL, NULL, NULL, NULL, NULL),
(322, 'is_add_schedule', 'Is Add Schedule', NULL, NULL, NULL, NULL, NULL),
(323, 'req_item_info', 'Requisition Item Information', NULL, NULL, NULL, NULL, NULL),
(324, 'item_type_name', 'Item Type Name', NULL, NULL, NULL, NULL, NULL),
(325, 'item_name', 'Item Name', NULL, NULL, NULL, NULL, NULL),
(326, 'item_unit', 'Item Unit', NULL, NULL, NULL, NULL, NULL),
(327, 'maint_ser_list', 'Maintenance Service List', NULL, NULL, NULL, NULL, NULL),
(328, 'add_main_ser', 'Add Maintenance Service', NULL, NULL, NULL, NULL, NULL),
(329, 'ser_name', 'Service Name', NULL, NULL, NULL, NULL, NULL),
(330, 'serv_type', 'Service Type', NULL, NULL, NULL, NULL, NULL),
(331, 'track_bydate', 'Track By Date', NULL, NULL, NULL, NULL, NULL),
(332, 'fuel_traking', 'Fuel Traking', NULL, NULL, NULL, NULL, NULL),
(333, 'milage_traking', 'Milage Traking', NULL, NULL, NULL, NULL, NULL),
(334, 'pmservicelist', 'PM Service List', NULL, NULL, NULL, NULL, NULL),
(335, 'pmservice', 'PM Service', NULL, NULL, NULL, NULL, NULL),
(336, 'traling_type', 'Traking Type', NULL, NULL, NULL, NULL, NULL),
(337, 'base_date', 'Base Date', NULL, NULL, NULL, NULL, NULL),
(338, 'recurring_value', 'Recurring Value', NULL, NULL, NULL, NULL, NULL),
(339, 'notifycell', 'Notification Cell', NULL, NULL, NULL, NULL, NULL),
(340, 'notify_email', 'Notification Email', NULL, NULL, NULL, NULL, NULL),
(341, 'add_pm', 'Add PM Service', NULL, NULL, NULL, NULL, NULL),
(342, 'refuel_setting', 'Refueling Setting List', NULL, NULL, NULL, NULL, NULL),
(343, 'add_refuel', 'Add Refuel Setting', NULL, NULL, NULL, NULL, NULL),
(344, 'last_reading', 'Last Reading', NULL, NULL, NULL, NULL, NULL),
(345, 'consumption', 'Consumption', NULL, NULL, NULL, NULL, NULL),
(346, 'strict_policy', 'Strict Policy', NULL, NULL, NULL, NULL, NULL),
(347, 'driver_mobile', 'Driver Mobile', NULL, NULL, NULL, NULL, NULL),
(348, 'fuel_type', 'Fuel Type', NULL, NULL, NULL, NULL, NULL),
(349, 'refuel_limit', 'Refuel Limit', NULL, NULL, NULL, NULL, NULL),
(350, 'kilometer_per_unit', 'Kilometer Per Unit', NULL, NULL, NULL, NULL, NULL),
(351, 'last_unit', 'Last Unit', NULL, NULL, NULL, NULL, NULL),
(352, 'refuel_limit_type', 'Refuel Limit Type', NULL, NULL, NULL, NULL, NULL),
(353, 'max_unit', 'Max Unit', NULL, NULL, NULL, NULL, NULL),
(354, 'consumption_percent', 'Consumption Percent', NULL, NULL, NULL, NULL, NULL),
(355, 'stict_consump', 'Strict Consumption Apply', NULL, NULL, NULL, NULL, NULL),
(356, 'fuel_station_list', 'Fuel Station List', NULL, NULL, NULL, NULL, NULL),
(357, 'add_fuel_station', 'Add Fuel Station', NULL, NULL, NULL, NULL, NULL),
(358, 'station_name', 'Station Name', NULL, NULL, NULL, NULL, NULL),
(359, 'station_code', 'Station Code', NULL, NULL, NULL, NULL, NULL),
(360, 'authorize_person', 'Authorize Person', NULL, NULL, NULL, NULL, NULL),
(361, 'contact_num', 'Contact Number', NULL, NULL, NULL, NULL, NULL),
(362, 'is_authrize', 'Is Authorize', NULL, NULL, NULL, NULL, NULL),
(363, 'vendor_name', 'Vendor Name', NULL, NULL, NULL, NULL, NULL),
(364, 'refuel_req_list', 'Refuel Requisition List', NULL, NULL, NULL, NULL, NULL),
(365, 'add_refuel_req', 'Add Refueling Requisition ', NULL, NULL, NULL, NULL, NULL),
(366, 'req_no', 'Requisition Number', NULL, NULL, NULL, NULL, NULL),
(367, 'req_from', 'Requisition From', NULL, NULL, NULL, NULL, NULL),
(368, 'odomiter', 'Odomiter', NULL, NULL, NULL, NULL, NULL),
(369, 'application', 'Application', NULL, NULL, NULL, NULL, NULL),
(370, 'p_qty', 'P.Qty', NULL, NULL, NULL, NULL, NULL),
(371, 'f_qty', 'F.Qty', NULL, NULL, NULL, NULL, NULL),
(372, 'process_status', 'Process Status', NULL, NULL, NULL, NULL, NULL),
(373, 'fuel_station', 'Fuel Station', NULL, NULL, NULL, NULL, NULL),
(374, 'qty', 'Quantity', NULL, NULL, NULL, NULL, NULL),
(375, 'current_odometer', 'Current Odometer', NULL, NULL, NULL, NULL, NULL),
(376, 'refuel_req_track_list', 'Refuel Requisition Track List', NULL, NULL, NULL, NULL, NULL),
(377, 'policy_vendor_name', 'Policy Vendor Name', NULL, NULL, NULL, NULL, NULL),
(378, 'update_insurance', 'Update Insurance', NULL, NULL, NULL, NULL, NULL),
(379, 'setting', 'System Setting', NULL, NULL, NULL, NULL, NULL),
(380, 'company_list', 'Company List', NULL, NULL, NULL, NULL, NULL),
(381, 'add_company', 'Add Company', NULL, NULL, NULL, NULL, NULL),
(382, 'update_company', 'Update Company', NULL, NULL, NULL, NULL, NULL),
(383, 'recurring_periode_name', 'Recurring Period Name', NULL, NULL, NULL, NULL, NULL),
(384, 'recurring_periode_list', 'Recurring Period List', NULL, NULL, NULL, NULL, NULL),
(385, 'add_recurring_period', 'Add Recurring Period', NULL, NULL, NULL, NULL, NULL),
(386, 'update_period', 'Update Recurring Period', NULL, NULL, NULL, NULL, NULL),
(387, 'insur_update', 'Update Insurance', NULL, NULL, NULL, NULL, NULL),
(388, 'vendor_name', 'Vendor Name', NULL, NULL, NULL, NULL, NULL),
(389, 'vendor_add', 'Add Vendor', NULL, NULL, NULL, NULL, NULL),
(390, 'update_notification', 'Update Notification', NULL, NULL, NULL, NULL, NULL),
(391, 'notification_list', 'Notification List', NULL, NULL, NULL, NULL, NULL),
(392, 'add_notification', 'Add Notification', NULL, NULL, NULL, NULL, NULL),
(393, 'notification_name', 'Notification Name', NULL, NULL, NULL, NULL, NULL),
(394, 'update_vendor', 'Update Vendor', NULL, NULL, NULL, NULL, NULL),
(395, 'vendor_list', 'Vendor List', NULL, NULL, NULL, NULL, NULL),
(396, 'document_type', 'Documentation Type', NULL, NULL, NULL, NULL, NULL),
(397, 'add_documentation_type', 'Add Document Type', NULL, NULL, NULL, NULL, NULL),
(398, 'update_document_Type', 'Update Document Type', NULL, NULL, NULL, NULL, NULL),
(399, 'document_name', 'Document Name', NULL, NULL, NULL, NULL, NULL),
(400, 'add_vehicletype', 'Add Vehicle Type', NULL, NULL, NULL, NULL, NULL),
(401, 'update_vehicletype', 'Update Vehicle Type', NULL, NULL, NULL, NULL, NULL),
(402, 'vehicletype_name', 'Vehicle Type Name', NULL, NULL, NULL, NULL, NULL),
(403, 'add_purpose', 'Add purpose', NULL, NULL, NULL, NULL, NULL),
(404, 'update_purpose', 'Update Purpose', NULL, NULL, NULL, NULL, NULL),
(405, 'req_purpose', 'Requisition Purpose', NULL, NULL, NULL, NULL, NULL),
(406, 'update_req', 'Update Requisition', NULL, NULL, NULL, NULL, NULL),
(407, 'add_req_type', 'Add Requisition Type', NULL, NULL, NULL, NULL, NULL),
(408, 'update_req_type', 'Update Requisition Type', NULL, NULL, NULL, NULL, NULL),
(409, 'type_name', 'Type Name', NULL, NULL, NULL, NULL, NULL),
(410, 'add_phase', 'Add Phase', NULL, NULL, NULL, NULL, NULL),
(411, 'update_phase', 'Update Phase', NULL, NULL, NULL, NULL, NULL),
(412, 'phase_list', 'Phase List', NULL, NULL, NULL, NULL, NULL),
(413, 'phase_name', 'Phase Name', NULL, NULL, NULL, NULL, NULL),
(414, 'update_app_auth', 'Update Approval Authority', NULL, NULL, NULL, NULL, NULL),
(415, 'updatepickdrof', 'Update Pick & Drop off', NULL, NULL, NULL, NULL, NULL),
(416, 'add_maintenance_type', 'Add Maintenance Type', NULL, NULL, NULL, NULL, NULL),
(417, 'update_mainten_type', 'Update Maintenance Type', NULL, NULL, NULL, NULL, NULL),
(418, 'mainten_type_list', 'Maintenance Type List', NULL, NULL, NULL, NULL, NULL),
(419, 'mainten_name', 'Maintenance Type Name', NULL, NULL, NULL, NULL, NULL),
(420, 'add_priority', 'Add Priority', NULL, NULL, NULL, NULL, NULL),
(421, 'update_priority', 'Update Priority', NULL, NULL, NULL, NULL, NULL),
(422, 'priority_list', 'Priority List', NULL, NULL, NULL, NULL, NULL),
(423, 'priority_name', 'Priority Name', NULL, NULL, NULL, NULL, NULL),
(424, 'add_service_type', 'Add Service Type', NULL, NULL, NULL, NULL, NULL),
(425, 'update_service_type', 'Update Service TYpe', NULL, NULL, NULL, NULL, NULL),
(426, 'service_type_name', 'Service Type Name', NULL, NULL, NULL, NULL, NULL),
(427, 'service_type_list', 'Service Type List', NULL, NULL, NULL, NULL, NULL),
(428, 'add_fuel_type', 'Add Fuel Type', NULL, NULL, NULL, NULL, NULL),
(429, 'update_ftype', 'Update Fuel Type', NULL, NULL, NULL, NULL, NULL),
(430, 'fueltype_list', 'Fuel Type List', NULL, NULL, NULL, NULL, NULL),
(431, 'fuel_type_name', 'Fuel Type Name', NULL, NULL, NULL, NULL, NULL),
(432, 'tript_add', 'Add Trip Type', NULL, NULL, NULL, NULL, NULL),
(433, 'update_tript', 'Update Trip Type', NULL, NULL, NULL, NULL, NULL),
(434, 'trip_typelist', 'Trip Type List', NULL, NULL, NULL, NULL, NULL),
(435, 'trip_type_name', 'Trip Type Name', NULL, NULL, NULL, NULL, NULL),
(436, 'update_exptype', 'Update Expense Type', NULL, NULL, NULL, NULL, NULL),
(437, 'add_expense_type', 'Add Expense Type', NULL, NULL, NULL, NULL, NULL),
(438, 'expence_list', 'Expense List', NULL, NULL, NULL, NULL, NULL),
(439, 'details', 'Details', NULL, NULL, NULL, NULL, NULL),
(440, 'update_expense', 'Update Expense', NULL, NULL, NULL, NULL, NULL),
(441, 'parts_list', 'Parts List', NULL, NULL, NULL, NULL, NULL),
(442, 'add_parts', 'Add Parts', NULL, NULL, NULL, NULL, NULL),
(443, 'update_parts', 'Update Parts', NULL, NULL, NULL, NULL, NULL),
(444, 'parts_name', 'Parts Name', NULL, NULL, NULL, NULL, NULL),
(445, 'add_category', 'Add Category', NULL, NULL, NULL, NULL, NULL),
(446, 'update_category', 'Update Category', NULL, NULL, NULL, NULL, NULL),
(447, 'category_list', 'Category List', NULL, NULL, NULL, NULL, NULL),
(448, 'category_name', 'Category Name', NULL, NULL, NULL, NULL, NULL),
(449, 'location_add', 'Add Location', NULL, NULL, NULL, NULL, NULL),
(450, 'update_location', 'Update Location', NULL, NULL, NULL, NULL, NULL),
(451, 'location_name', 'Location Name', NULL, NULL, NULL, NULL, NULL),
(452, 'location_list', 'Location List', NULL, NULL, NULL, NULL, NULL),
(453, 'room', 'Room', NULL, NULL, NULL, NULL, NULL),
(454, 'self', 'Self', NULL, NULL, NULL, NULL, NULL),
(455, 'drawer', 'Drawer', NULL, NULL, NULL, NULL, NULL),
(456, 'capacity', 'Capacity', NULL, NULL, NULL, NULL, NULL),
(457, 'dimension', 'Dimension', NULL, NULL, NULL, NULL, NULL),
(458, 'yes', 'Yes', NULL, NULL, NULL, NULL, NULL),
(459, 'no', 'No', NULL, NULL, NULL, NULL, NULL),
(460, 'description', 'Description', NULL, NULL, NULL, NULL, NULL),
(461, 'stock_limit', 'Stock Limit', NULL, NULL, NULL, NULL, NULL),
(462, 'remarks', 'Remark', NULL, NULL, NULL, NULL, NULL),
(463, 'nearest_vehicle', 'Nearest Vehicle', NULL, NULL, NULL, NULL, NULL),
(464, 'vehicle_location', 'Vehicle Location', NULL, NULL, NULL, NULL, NULL),
(465, 'track_history', 'Track History', NULL, NULL, NULL, NULL, NULL),
(466, 'travel_distance', 'Travel Distance ', NULL, NULL, NULL, NULL, NULL),
(467, 'vtstracker', 'VTS Tracker', NULL, NULL, NULL, NULL, NULL),
(468, 'model', 'Model', NULL, NULL, NULL, NULL, NULL),
(469, 'vehiclenumber', 'Vehicle Number', NULL, NULL, NULL, NULL, NULL),
(470, 'vehEnginStat', 'Vehicle Engine State', NULL, NULL, NULL, NULL, NULL),
(471, 'lat', 'Latitude', NULL, NULL, NULL, NULL, NULL),
(472, 'long', 'Longitude', NULL, NULL, NULL, NULL, NULL),
(473, 'numberOfVehicle', 'No. of Vehicle', NULL, NULL, NULL, NULL, NULL),
(474, 'totalFaceVehicles', 'Total Face Vehicle', NULL, NULL, NULL, NULL, NULL),
(475, 'vehTimeStamp', 'Vehicle TimeStamp', NULL, NULL, NULL, NULL, NULL),
(476, 'vehicleid', 'Vehicle ID', NULL, NULL, NULL, NULL, NULL),
(477, 'distance', 'Distance', NULL, NULL, NULL, NULL, NULL),
(478, 'speed', 'Speed', NULL, NULL, NULL, NULL, NULL),
(479, 'enginStat', 'Engine Stat', NULL, NULL, NULL, NULL, NULL),
(480, 'vendorName', 'Vendor Name', NULL, NULL, NULL, NULL, NULL),
(481, 'numberOfLocation', 'No. of Location', NULL, NULL, NULL, NULL, NULL),
(482, 'totalFaceLocations', 'Total Face Location', NULL, NULL, NULL, NULL, NULL),
(483, 'distanceTraveled', 'Distance Traveled', NULL, NULL, NULL, NULL, NULL),
(484, 'update_refuel_setting', 'Update Refuel Setting', NULL, NULL, NULL, NULL, NULL),
(485, 'update_fuel_station', 'Update Fuel Station', NULL, NULL, NULL, NULL, NULL),
(486, 'update_refuel_req', 'Update Refuel Requisition', NULL, NULL, NULL, NULL, NULL),
(487, 'update_maintenance', 'Update Maintenance', NULL, NULL, NULL, NULL, NULL),
(488, 'upt_maint_serv', 'Update Maintenance Service ', NULL, NULL, NULL, NULL, NULL),
(489, 'emp_report', 'Employee Report', NULL, NULL, NULL, NULL, NULL),
(490, 'expense_report', 'Expense Report', NULL, NULL, NULL, NULL, NULL),
(491, 'exp_date_fr', 'Expense Date From', NULL, NULL, NULL, NULL, NULL),
(492, 'exp_date_to', 'Expense Date To', NULL, NULL, NULL, NULL, NULL),
(493, 'grandt', 'Grand Total', NULL, NULL, NULL, NULL, NULL),
(494, 'm_req_report', 'Maintenance Requisition Report', NULL, NULL, NULL, NULL, NULL),
(495, 'service_fr', 'Service From', NULL, NULL, NULL, NULL, NULL),
(496, 'milage_rpt', 'Mileage Report ', NULL, NULL, NULL, NULL, NULL),
(497, 'division_list', 'Division List', NULL, NULL, NULL, NULL, NULL),
(498, 'brtaoffice_list', 'BRTA Office List', NULL, NULL, NULL, NULL, NULL),
(499, 'ownershiplist', 'Ownership List', NULL, NULL, NULL, NULL, NULL),
(500, 'add_division', 'Add Division', NULL, NULL, NULL, NULL, NULL),
(501, 'update_division', 'Division Update ', NULL, NULL, NULL, NULL, NULL),
(502, 'division_name', 'Division Name', NULL, NULL, NULL, NULL, NULL),
(503, 'office_location', 'Office Location', NULL, NULL, NULL, NULL, NULL),
(504, 'add_brtaOffice', 'Add BRTA Office', NULL, NULL, NULL, NULL, NULL),
(505, 'upt_brta', 'Update BRTA Office', NULL, NULL, NULL, NULL, NULL),
(506, 'add_ownership', 'Add Ownership', NULL, NULL, NULL, NULL, NULL),
(507, 'ownerupt', 'Ownership Update', NULL, NULL, NULL, NULL, NULL),
(508, 'ownertype', 'Ownership Type', NULL, NULL, NULL, NULL, NULL),
(509, 'purchase', 'Purchase', NULL, NULL, NULL, NULL, NULL),
(510, 'purchase_list', 'Purchase List', NULL, NULL, NULL, NULL, NULL),
(511, 'partsuse_list', 'Parts Usages List', NULL, NULL, NULL, NULL, NULL),
(512, 'add_purchase', 'Add Purchase', NULL, NULL, NULL, NULL, NULL),
(513, 'add_usages', 'Add Parts Usage', NULL, NULL, NULL, NULL, NULL),
(514, 'purchase_dade', 'Purchase Date', NULL, NULL, NULL, NULL, NULL),
(515, 'update_purchase', 'Update Purchase', NULL, NULL, NULL, NULL, NULL),
(516, 'category', 'Category', NULL, NULL, NULL, NULL, NULL),
(517, 'parent_category', 'Parent Category', NULL, NULL, NULL, NULL, NULL),
(518, 'parent', 'Parent', NULL, NULL, NULL, NULL, NULL),
(519, 'icon', 'Icon', NULL, NULL, NULL, NULL, NULL),
(520, 'course', 'Course', NULL, NULL, NULL, NULL, NULL),
(521, 'add_course', 'Add Course', NULL, NULL, NULL, NULL, NULL),
(522, 'course_list', 'Course List', NULL, NULL, NULL, NULL, NULL),
(523, 'total_course', 'Total Course', NULL, NULL, NULL, NULL, NULL),
(524, 'active_course', 'Active Course', NULL, NULL, NULL, NULL, NULL),
(525, 'pending_course', 'Pending Course', NULL, NULL, NULL, NULL, NULL),
(526, 'free_course', 'Free Course', NULL, NULL, NULL, NULL, NULL),
(527, 'paid_course', 'Paid Course', NULL, NULL, NULL, NULL, NULL),
(528, 'basic_info', 'Basic Info', NULL, NULL, NULL, NULL, NULL),
(529, 'submit', 'Submit', NULL, NULL, NULL, NULL, NULL),
(530, 'course_requirements', 'Course Requirement', NULL, NULL, NULL, NULL, NULL),
(531, 'price', 'Price', NULL, NULL, NULL, NULL, NULL),
(532, 'course_benifit', 'Course Benifit', NULL, NULL, NULL, NULL, NULL),
(533, 'course_pricing', 'Course Pricing', NULL, NULL, NULL, NULL, NULL),
(534, 'course_media', 'Course Media', NULL, NULL, NULL, NULL, NULL),
(535, 'course_seo', 'Course SEO', NULL, NULL, NULL, NULL, NULL),
(536, 'summary', 'Summary', NULL, NULL, NULL, NULL, NULL),
(537, 'course_level', 'Course Level', NULL, NULL, NULL, NULL, NULL),
(538, 'select_one', '-- select one --', NULL, NULL, NULL, NULL, NULL),
(539, 'enter_requirements', 'Enter Requirements', NULL, NULL, NULL, NULL, NULL),
(540, 'requirements', 'Requirements', NULL, NULL, NULL, NULL, NULL),
(541, 'discount', 'Discount', NULL, NULL, NULL, NULL, NULL),
(542, 'security_character', '@!#$%^&*()_+[]{}?;|\'`/><', NULL, NULL, NULL, NULL, NULL),
(543, 'onlynumber_allow', '@!#$%^&*()_+[]{}?:;|\\/~`-=abcdefghijklmnopqrstuvwxyz><', NULL, NULL, NULL, NULL, NULL),
(544, 'course_provider', 'Course Provider', NULL, NULL, NULL, NULL, NULL),
(545, 'url', 'URL', NULL, NULL, NULL, NULL, NULL),
(546, 'thumbnail', 'Thumbnail', NULL, NULL, NULL, NULL, NULL),
(547, 'meta_keyword', 'Meta Keyword', NULL, NULL, NULL, NULL, NULL),
(548, 'meta_description', 'Meta Description', NULL, NULL, NULL, NULL, NULL),
(549, 'finish', 'Finish', NULL, NULL, NULL, NULL, NULL),
(550, 'course_name', 'Course Name', NULL, NULL, NULL, NULL, NULL),
(551, 'section_lesson', 'Lesson and Section', NULL, NULL, NULL, NULL, NULL),
(552, 'edit_course', 'Edit Course', NULL, NULL, NULL, NULL, NULL),
(553, 'add_section', 'Add Section', NULL, NULL, NULL, NULL, NULL),
(554, 'add_lesson', 'Add Lesson', NULL, NULL, NULL, NULL, NULL),
(555, 'course_edit', 'Course Edit', NULL, NULL, NULL, NULL, NULL),
(556, 'curriculum', 'Curriculum', NULL, NULL, NULL, NULL, NULL),
(557, 'section_info', 'Section Information', NULL, NULL, NULL, NULL, NULL),
(558, 'section_name', 'Section Name', NULL, NULL, NULL, NULL, NULL),
(559, 'lesson_name', 'Lesson Name', NULL, NULL, NULL, NULL, NULL),
(560, 'lesson_info', 'Lesson Information', NULL, NULL, NULL, NULL, NULL),
(561, 'lesson_type', 'Lesson Type', NULL, NULL, NULL, NULL, NULL),
(562, 'youtube', 'Youtube', NULL, NULL, NULL, NULL, NULL),
(563, 'text_file', 'Text File', NULL, NULL, NULL, NULL, NULL),
(564, 'video', 'Video', NULL, NULL, NULL, NULL, NULL),
(565, 'lesson_provider', 'Lesson Provider', NULL, NULL, NULL, NULL, NULL),
(566, 'attachment', 'Attachment', NULL, NULL, NULL, NULL, NULL),
(567, 'vimeo', 'Vimeo', NULL, NULL, NULL, NULL, NULL),
(568, 'provider_url', 'Provider Url', NULL, NULL, NULL, NULL, NULL),
(569, 'duration', 'Duration', NULL, NULL, NULL, NULL, NULL),
(570, 'section_update', 'Section Update', NULL, NULL, NULL, NULL, NULL),
(571, 'lesson_update', 'Lesson Update', NULL, NULL, NULL, NULL, NULL),
(572, 'students', 'Students', NULL, NULL, NULL, NULL, NULL),
(573, 'add_student', 'Add Student', NULL, NULL, NULL, NULL, NULL),
(574, 'student_list', 'Student List', NULL, NULL, NULL, NULL, NULL),
(575, 'biography', 'Biography', NULL, NULL, NULL, NULL, NULL),
(576, 'credentials_info', 'Credentials Info', NULL, NULL, NULL, NULL, NULL),
(577, 'social_info', 'Social Info', NULL, NULL, NULL, NULL, NULL),
(578, 'payment_info', 'Payment Info', NULL, NULL, NULL, NULL, NULL),
(579, 'facebook', 'Facebook', NULL, NULL, NULL, NULL, NULL),
(580, 'twitter', 'Twitter', NULL, NULL, NULL, NULL, NULL),
(581, 'linkedin', 'Linkedin', NULL, NULL, NULL, NULL, NULL),
(582, 'instagram', 'Instagram', NULL, NULL, NULL, NULL, NULL),
(583, 'bitcoin', 'Bitcoin', NULL, NULL, NULL, NULL, NULL),
(584, 'paypal', 'Paypal', NULL, NULL, NULL, NULL, NULL),
(585, 'simbcoin', 'Simbcoin', NULL, NULL, NULL, NULL, NULL),
(586, 'total_student', 'Total Student', NULL, NULL, NULL, NULL, NULL),
(587, 'enrolled_course', 'Enrolled Course', NULL, NULL, NULL, NULL, NULL),
(588, 'edit_student', 'Edit Student', NULL, NULL, NULL, NULL, NULL),
(589, 'faculty', 'Faculty', NULL, NULL, NULL, NULL, NULL),
(590, 'add_faculty', 'Add Faculty', NULL, NULL, NULL, NULL, NULL),
(591, 'faculty_list', 'Faculty List', NULL, NULL, NULL, NULL, NULL),
(592, 'education', 'Education', NULL, NULL, NULL, NULL, NULL),
(593, 'work_experience', 'Work Experience', NULL, NULL, NULL, NULL, NULL),
(594, 'birthday', 'Birthday', NULL, NULL, NULL, NULL, NULL),
(595, 'web_site', 'Web Site', NULL, NULL, NULL, NULL, NULL),
(596, 'organization', 'Organization', NULL, NULL, NULL, NULL, NULL),
(597, 'skills', 'Skills', NULL, NULL, NULL, NULL, NULL),
(598, 'location', 'Location', NULL, NULL, NULL, NULL, NULL),
(599, 'degree_name', 'Degree Name', NULL, NULL, NULL, NULL, NULL),
(600, 'institute', 'Institute', NULL, NULL, NULL, NULL, NULL),
(601, 'passing_year', 'Passing Year', NULL, NULL, NULL, NULL, NULL),
(602, 'responsibility', 'Responsibility', NULL, NULL, NULL, NULL, NULL),
(603, 'total_faculty', 'Total Faculty', NULL, NULL, NULL, NULL, NULL),
(604, 'edit_faculty', 'Edit Faculty', NULL, NULL, NULL, NULL, NULL),
(605, 'question', 'Question', NULL, NULL, NULL, NULL, NULL),
(606, 'add_question', 'Add Question', NULL, NULL, NULL, NULL, NULL),
(607, 'question_list', 'Question List', NULL, NULL, NULL, NULL, NULL),
(608, 'answer_type', 'Answer Type', NULL, NULL, NULL, NULL, NULL),
(609, 'radio', 'Radio', NULL, NULL, NULL, NULL, NULL),
(610, 'checkbox', 'checkbox', NULL, NULL, NULL, NULL, NULL),
(611, 'text', 'Text', NULL, NULL, NULL, NULL, NULL),
(612, 'is_answer', 'Is Answer', NULL, NULL, NULL, NULL, NULL),
(613, 'exam', 'Exam', NULL, NULL, NULL, NULL, NULL),
(614, 'add_exam', 'Add Exam', NULL, NULL, NULL, NULL, NULL),
(615, 'exam_list', 'Exam List', NULL, NULL, NULL, NULL, NULL),
(616, 'exam_name', 'Exam Name', NULL, NULL, NULL, NULL, NULL),
(617, 'time_duration', 'Time Duration', NULL, NULL, NULL, NULL, NULL),
(618, 'choose_file', 'Choose a file', NULL, NULL, NULL, NULL, NULL),
(619, 'time', 'Time', NULL, NULL, NULL, NULL, NULL),
(620, 'total_question', 'Total Question', NULL, NULL, NULL, NULL, NULL),
(621, 'instruction', 'Instruction', NULL, NULL, NULL, NULL, NULL),
(622, 'exam_edit', 'Exam Edit', NULL, NULL, NULL, NULL, NULL),
(623, 'total_course', 'Total Course', NULL, NULL, NULL, NULL, NULL),
(624, 'get_more', 'Get More', NULL, NULL, NULL, NULL, NULL),
(625, 'total_exam', 'Total Exam', NULL, NULL, NULL, NULL, NULL),
(626, 'category_edit', 'Category Edit', NULL, NULL, NULL, NULL, NULL),
(627, 'settings', 'Settings', NULL, NULL, NULL, NULL, NULL),
(628, 'assign_user_role', 'Assign User Role', NULL, NULL, NULL, NULL, NULL),
(629, 'assign_user_role_list', 'Assign User Role List', NULL, NULL, NULL, NULL, NULL),
(630, 'add_language', 'Add Language', NULL, NULL, NULL, NULL, NULL),
(631, 'add_phrase', 'Add Phrase', NULL, NULL, NULL, NULL, NULL),
(632, 'language_name', 'Language Name', NULL, NULL, NULL, NULL, NULL),
(633, 'phrase', 'Phrase', NULL, NULL, NULL, NULL, NULL),
(634, 'english', 'English', NULL, NULL, NULL, NULL, NULL),
(635, 'already_exists', 'Already Exists', NULL, NULL, NULL, NULL, NULL),
(636, 'phrase_added_successfully', 'Phrase Added Successfully', NULL, NULL, NULL, NULL, NULL),
(637, 'this_field_must_be_required', 'This field must be required', NULL, NULL, NULL, NULL, NULL),
(638, 'language_added_successfully', 'Language Added Successfully', NULL, NULL, NULL, NULL, NULL),
(639, 'currency', 'Currency', NULL, NULL, NULL, NULL, NULL),
(640, 'invalid_favicon', 'Invalid Favicon', NULL, NULL, NULL, NULL, NULL),
(641, 'add_menu', 'Add Menu', NULL, NULL, NULL, NULL, NULL),
(642, 'menu_list', 'Menu List', NULL, NULL, NULL, NULL, NULL),
(643, 'user_info', 'User Info', NULL, NULL, NULL, NULL, NULL),
(644, 'menu_save_successfully', 'Menu Save Successfully', NULL, NULL, NULL, NULL, NULL),
(645, 'menu_info', 'Menu Information', NULL, NULL, NULL, NULL, NULL),
(646, 'menu_updated_successfully', 'Menu updated successfully', NULL, NULL, NULL, NULL, NULL),
(647, 'can_create', 'Can Create', NULL, NULL, NULL, NULL, NULL),
(648, 'can_read', 'Can Read', NULL, NULL, NULL, NULL, NULL),
(649, 'can_edit', 'Can Edit', NULL, NULL, NULL, NULL, NULL),
(650, 'can_delete', 'Can Delete', NULL, NULL, NULL, NULL, NULL),
(651, 'role_edit', 'Role Edit', NULL, NULL, NULL, NULL, NULL),
(652, 'record_not_found', 'Record not found', NULL, NULL, NULL, NULL, NULL),
(653, 'assigned_role', 'Assigned Role', NULL, NULL, NULL, NULL, NULL),
(654, 'not_found', 'Not Found', NULL, NULL, NULL, NULL, NULL),
(655, 'inactive_successfully', 'Inactive Successfully', NULL, NULL, NULL, NULL, NULL),
(656, 'active_successfully', 'Active Successfully', NULL, NULL, NULL, NULL, NULL),
(657, 'demo', '', NULL, NULL, NULL, NULL, NULL),
(658, 'mail_config', 'Mail Config', NULL, NULL, NULL, NULL, NULL),
(659, 'protocol', 'Protocol', NULL, NULL, NULL, NULL, NULL),
(660, 'smtp_host', 'SMTP Host', NULL, NULL, NULL, NULL, NULL),
(661, 'smtp_port', 'SMTP Port', NULL, NULL, NULL, NULL, NULL),
(662, 'sender_mail', 'Sender Mail', NULL, NULL, NULL, NULL, NULL),
(663, 'mail_type', 'Mail Type', NULL, NULL, NULL, NULL, NULL),
(664, 'customer_receive', 'Customer Receive', NULL, NULL, NULL, NULL, NULL),
(665, 'html', 'HTML', NULL, NULL, NULL, NULL, NULL),
(666, 'sms_config', 'SMS Config', NULL, NULL, NULL, NULL, NULL),
(667, 'provider_name', 'Provider Name', NULL, NULL, NULL, NULL, NULL),
(668, 'sender_name', 'Sender Name', NULL, NULL, NULL, NULL, NULL),
(669, 'paypal_config', 'Paypal Config', NULL, NULL, NULL, NULL, NULL),
(670, 'development', 'Development', NULL, NULL, NULL, NULL, NULL),
(671, 'production', 'Production', NULL, NULL, NULL, NULL, NULL),
(672, 'mode', 'Mode', NULL, NULL, NULL, NULL, NULL),
(673, 'payment_gateway', 'Payment Gateway', NULL, NULL, NULL, NULL, NULL),
(674, 'paypal_configuration', 'Paypal Configuration', NULL, NULL, NULL, NULL, NULL),
(675, 'course_details', 'Course Details', NULL, NULL, NULL, NULL, NULL),
(676, 'blog', 'Blog', NULL, NULL, NULL, NULL, NULL),
(677, 'blog_details', 'Blog Details', NULL, NULL, NULL, NULL, NULL),
(678, 'exam_course_details', 'Exam Course Details', NULL, NULL, NULL, NULL, NULL),
(679, 'faculty_info', 'Faculty Info', NULL, NULL, NULL, NULL, NULL),
(680, 'cart', 'Cart', NULL, NULL, NULL, NULL, NULL),
(681, 'checkout', 'Checkout', NULL, NULL, NULL, NULL, NULL),
(682, 'last_name', 'Last Name', NULL, NULL, NULL, NULL, NULL),
(683, 'first_name', 'First Name', NULL, NULL, NULL, NULL, NULL),
(684, 'preview', 'Preview', NULL, NULL, NULL, NULL, NULL),
(685, 'is_popular', 'Is Popular', NULL, NULL, NULL, NULL, NULL),
(686, 'category_save_successfully', 'Category save successfully', NULL, NULL, NULL, NULL, NULL),
(687, 'category_update_successfully', 'Category updated successfully', NULL, NULL, NULL, NULL, NULL),
(688, 'is_free_course', 'Is Free Course', NULL, NULL, NULL, NULL, NULL),
(689, 'section_added_successfully', 'Section added successfully', NULL, NULL, NULL, NULL, NULL),
(690, 'youtube_api_key', 'Youtube API Key', NULL, NULL, NULL, NULL, NULL),
(691, 'vimeo_api_key', 'Vimeo API Key', NULL, NULL, NULL, NULL, NULL),
(692, 'checking_url', 'Checking URL', NULL, NULL, NULL, NULL, NULL),
(693, 'invalid_url', 'Invalid URL', NULL, NULL, NULL, NULL, NULL),
(694, 'your_video_link_has_to_be_either_youtube_or_vimeo', 'Your video link has to be either youtube or vimeo', NULL, NULL, NULL, NULL, NULL),
(695, 'lesson_added_successfully', 'Lesson added successfully', NULL, NULL, NULL, NULL, NULL),
(696, 'section', 'Section', NULL, NULL, NULL, NULL, NULL),
(697, 'section_updated_successfully', 'Section updated successfully', NULL, NULL, NULL, NULL, NULL),
(698, 'lesson_updated_successfully', 'Lesson updated successfully', NULL, NULL, NULL, NULL, NULL),
(699, 'lesson', 'Lesson', NULL, NULL, NULL, NULL, NULL),
(700, 'course_curriculum', 'Course Curriculum', NULL, NULL, NULL, NULL, NULL),
(701, 'cart_added_successfully', 'Cart added successfully', NULL, NULL, NULL, NULL, NULL),
(702, 'cart_updated_successfully', 'Cart updated successfully', NULL, NULL, NULL, NULL, NULL),
(703, 'deleted_successfully', 'Deleted successfully', NULL, NULL, NULL, NULL, NULL),
(704, 'subtotal', 'Subtotal', NULL, NULL, NULL, NULL, NULL),
(705, 'grand_total', 'Grand Total', NULL, NULL, NULL, NULL, NULL),
(706, 'shipping', 'Shipping', NULL, NULL, NULL, NULL, NULL),
(707, 'tax', 'Tax', NULL, NULL, NULL, NULL, NULL),
(708, 'quantity', 'Quantity', NULL, NULL, NULL, NULL, NULL),
(709, 'go_to_cart', 'Go to cart', NULL, NULL, NULL, NULL, NULL),
(710, 'login_info', 'Login Info', NULL, NULL, NULL, NULL, NULL),
(711, 'sign_in_to_your_account', 'Sign in to your account', NULL, NULL, NULL, NULL, NULL),
(712, 'my_course', 'My Course', NULL, NULL, NULL, NULL, NULL),
(713, 'order_id', 'Order ID', NULL, NULL, NULL, NULL, NULL),
(714, 'total_amount', 'Total Amount', NULL, NULL, NULL, NULL, NULL),
(715, 'currency_position', 'Currency Position', NULL, NULL, NULL, NULL, NULL),
(716, 'enrolled', 'Enrolled', NULL, NULL, NULL, NULL, NULL),
(717, 'sessions', 'Sessions', NULL, NULL, NULL, NULL, NULL),
(718, 'lessons', 'Lessons', NULL, NULL, NULL, NULL, NULL),
(719, 'designation', 'Designation', NULL, NULL, NULL, NULL, NULL),
(720, 'subscriber_list', 'Subscriber List', NULL, NULL, NULL, NULL, NULL),
(721, 'is_receive', 'Is Receive', NULL, NULL, NULL, NULL, NULL),
(722, 'payment_type', 'Payment Type', NULL, NULL, NULL, NULL, NULL),
(723, 'rate', 'Rate', NULL, NULL, NULL, NULL, NULL),
(724, 'paid_amount', 'Paid Amount', NULL, NULL, NULL, NULL, NULL),
(725, 'due_amount', 'Due Amount', NULL, NULL, NULL, NULL, NULL),
(726, 'enroll_course', 'Enroll Course', NULL, NULL, NULL, NULL, NULL),
(727, 'is_preview', 'Is Preview', NULL, NULL, NULL, NULL, NULL),
(728, 'oldprice', 'Old Price', NULL, NULL, NULL, NULL, NULL),
(729, 'register', 'Register', NULL, NULL, NULL, NULL, NULL),
(730, 'create_an_account', 'Create an account', NULL, NULL, NULL, NULL, NULL),
(731, 'student', 'Student', NULL, NULL, NULL, NULL, NULL),
(732, 'mail_already_exists', 'Mail already exists', NULL, NULL, NULL, NULL, NULL),
(733, 'username_already_exists', 'Username already exists', NULL, NULL, NULL, NULL, NULL),
(734, 'registration_successfully', 'Registration successfully', NULL, NULL, NULL, NULL, NULL),
(735, 'about_us', 'About Us', NULL, NULL, NULL, NULL, NULL),
(736, 'privacy_policy', 'Privacy Policy', NULL, NULL, NULL, NULL, NULL),
(737, 'terms_condition', 'Terms & Conditions', NULL, NULL, NULL, NULL, NULL),
(738, 'model_test', 'Model Test', NULL, NULL, NULL, NULL, NULL),
(739, 'popular_course', 'Popular Course', NULL, NULL, NULL, NULL, NULL),
(740, 'free_course', 'Free Course', NULL, NULL, NULL, NULL, NULL),
(741, 'signup', 'Signup', NULL, NULL, NULL, NULL, NULL),
(742, 'sign_up', 'Sign Up', NULL, NULL, NULL, NULL, NULL),
(743, 'faculties', 'Faculties', NULL, NULL, NULL, NULL, NULL),
(744, 'team_of_members', 'Team of Members', NULL, NULL, NULL, NULL, NULL),
(745, 'list_of_faculties', 'List of Faculties', NULL, NULL, NULL, NULL, NULL),
(746, 'our_courses', 'Our Courses', NULL, NULL, NULL, NULL, NULL),
(747, 'popular_courses', 'Popular Courses', NULL, NULL, NULL, NULL, NULL),
(748, 'free_courses', 'Free Courses', NULL, NULL, NULL, NULL, NULL),
(749, 'get_update_exclusiv_offers', 'Get updates & exclusive offers', NULL, NULL, NULL, NULL, NULL),
(750, 'enter_email_here', 'Enter email here...', NULL, NULL, NULL, NULL, NULL),
(751, 'aboutus_form', 'Aboutus Form', NULL, NULL, NULL, NULL, NULL),
(752, 'companies', 'Companies logo', NULL, NULL, NULL, NULL, NULL),
(753, 'aboutus_updated_successfully', 'Aboutus updated successfully', NULL, NULL, NULL, NULL, NULL),
(754, 'company_added_successfully', 'Company added successfully', NULL, NULL, NULL, NULL, NULL),
(755, 'updated_successfully', 'Updated successfully', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `bangla`, `arabic`, `urdhu`, `spanish`, `hindi`) VALUES
(756, 'team_members', 'Team Members', NULL, NULL, NULL, NULL, NULL),
(757, 'teammember_added_successfully', 'Team member added successfully', NULL, NULL, NULL, NULL, NULL),
(758, 'member_name', 'Member Name', NULL, NULL, NULL, NULL, NULL),
(759, 'trusted_by_companies', 'Trusted by companies', NULL, NULL, NULL, NULL, NULL),
(760, 'by_subscribing_to_our_newsletter', 'By subscribing to our newsletter you agree to receive emails from us.', NULL, NULL, NULL, NULL, NULL),
(761, 'signup_to_be_the_first_to_hear', 'Signup to our newsletter to be the first hear about new openings, offers.', NULL, NULL, NULL, NULL, NULL),
(762, 'courses', 'Courses', NULL, NULL, NULL, NULL, NULL),
(763, 'our_popular', 'Our Popular', NULL, NULL, NULL, NULL, NULL),
(764, 'popular', 'Popular', NULL, NULL, NULL, NULL, NULL),
(765, 'register_now', 'Register Now', NULL, NULL, NULL, NULL, NULL),
(766, 'meet_the_faculties', 'Meet the faculties', NULL, NULL, NULL, NULL, NULL),
(767, 'your_review', 'Your Review', NULL, NULL, NULL, NULL, NULL),
(768, 'email_address', 'Email Address', NULL, NULL, NULL, NULL, NULL),
(769, 'your_name', 'Your Name', NULL, NULL, NULL, NULL, NULL),
(770, 'your_rating', 'Your Rating', NULL, NULL, NULL, NULL, NULL),
(771, 'get_your_review', 'Get Your Review', NULL, NULL, NULL, NULL, NULL),
(772, 'average_rating', 'Average Rating', NULL, NULL, NULL, NULL, NULL),
(773, 'student_feedback', 'Student feedback', NULL, NULL, NULL, NULL, NULL),
(774, 'ratings', 'Ratings', NULL, NULL, NULL, NULL, NULL),
(775, 'reviews', 'Reviews', NULL, NULL, NULL, NULL, NULL),
(776, 'rating_breakdown', 'Rating breakdown', NULL, NULL, NULL, NULL, NULL),
(777, 'created_by', 'Created By', NULL, NULL, NULL, NULL, NULL),
(778, 'last_updated', 'Last updated', NULL, NULL, NULL, NULL, NULL),
(779, 'add_to_cart', 'Add To Cart', NULL, NULL, NULL, NULL, NULL),
(780, 'enroll_now', 'Enroll Now', NULL, NULL, NULL, NULL, NULL),
(781, 'this_course_includes', 'This course includes', NULL, NULL, NULL, NULL, NULL),
(782, 'course_features', 'Course Features', NULL, NULL, NULL, NULL, NULL),
(783, 'duration', 'Duration', NULL, NULL, NULL, NULL, NULL),
(784, 'sliders', 'Sliders', NULL, NULL, NULL, NULL, NULL),
(785, 'sub_title', 'Sub Title', NULL, NULL, NULL, NULL, NULL),
(786, 'tags', 'Tags', NULL, NULL, NULL, NULL, NULL),
(787, 'apps_logo', 'Apps Logo', NULL, NULL, NULL, NULL, NULL),
(788, 'apps_url', 'Apps URL', NULL, NULL, NULL, NULL, NULL),
(789, 'related_course', 'Related Course', NULL, NULL, NULL, NULL, NULL),
(790, 'my_courses', 'My Courses', NULL, NULL, NULL, NULL, NULL),
(791, 'categories', 'Categories', NULL, NULL, NULL, NULL, NULL),
(792, 'news_event', 'News & Events', NULL, NULL, NULL, NULL, NULL),
(793, 'add_event', 'Add Event', NULL, NULL, NULL, NULL, NULL),
(794, 'event_category', 'Event Category', NULL, NULL, NULL, NULL, NULL),
(795, 'add_event_category', 'Add Event Category', NULL, NULL, NULL, NULL, NULL),
(796, 'news', 'News', NULL, NULL, NULL, NULL, NULL),
(797, 'events', 'Events', NULL, NULL, NULL, NULL, NULL),
(798, 'event_list', 'Event List', NULL, NULL, NULL, NULL, NULL),
(799, 'is_front', 'Is Front', NULL, NULL, NULL, NULL, NULL),
(800, 'is_slide', 'Is Slide', NULL, NULL, NULL, NULL, NULL),
(801, 'event_details', 'Event Details', NULL, NULL, NULL, NULL, NULL),
(802, 'related_events', 'Related Events', NULL, NULL, NULL, NULL, NULL),
(803, 'comments', 'Comments', NULL, NULL, NULL, NULL, NULL),
(804, 'send', 'Send', NULL, NULL, NULL, NULL, NULL),
(805, 'commented_successfully', 'Commented Successfully', NULL, NULL, NULL, NULL, NULL),
(806, 'comment_list', 'Comment List', NULL, NULL, NULL, NULL, NULL),
(807, 'activated_successfully', 'Activated Successfully', NULL, NULL, NULL, NULL, NULL),
(808, 'inactivated_successfully', 'Inactivated Successfully', NULL, NULL, NULL, NULL, NULL),
(809, 'some_text', 'Some Text', NULL, NULL, NULL, NULL, NULL),
(810, 'please_write_your_comment', 'Please write your comment', NULL, NULL, NULL, NULL, NULL),
(811, 'post', 'Post', NULL, NULL, NULL, NULL, NULL),
(812, 'profiles', 'Profiles', NULL, NULL, NULL, NULL, NULL),
(813, 'your_profile', 'Your Profile', NULL, NULL, NULL, NULL, NULL),
(814, 'photo', 'Photo', NULL, NULL, NULL, NULL, NULL),
(815, 'change_password', 'Change Password', NULL, NULL, NULL, NULL, NULL),
(816, 'change_profile_picture', 'Change Profile Picture', NULL, NULL, NULL, NULL, NULL),
(817, 'current_password', 'Current Password', NULL, NULL, NULL, NULL, NULL),
(818, 'new_password', 'New Password', NULL, NULL, NULL, NULL, NULL),
(819, 'retype_password', 'Retype Password', NULL, NULL, NULL, NULL, NULL),
(820, 'current_password_does_not_match', 'Current password does not match', NULL, NULL, NULL, NULL, NULL),
(821, 'social_profiles', 'Social Profiles', NULL, NULL, NULL, NULL, NULL),
(822, 'members', 'Members', NULL, NULL, NULL, NULL, NULL),
(823, 'joined_in', 'Joined in', NULL, NULL, NULL, NULL, NULL),
(824, 'pro', 'Pro', NULL, NULL, NULL, NULL, NULL),
(825, 'web_page', 'Web page', NULL, NULL, NULL, NULL, NULL),
(826, 'phone_number', 'Phone number', NULL, NULL, NULL, NULL, NULL),
(827, 'back', 'Back', NULL, NULL, NULL, NULL, NULL),
(828, 'total_sales', 'Total Sales', NULL, NULL, NULL, NULL, NULL),
(829, 'student_sales_course', 'Student sales course', NULL, NULL, NULL, NULL, NULL),
(830, 'faculty_sales_course', 'Faculty sales course', NULL, NULL, NULL, NULL, NULL),
(831, 'students_name', 'Student Name', NULL, NULL, NULL, NULL, NULL),
(832, 'faculty_name', 'Faculty Name', NULL, NULL, NULL, NULL, NULL),
(833, 'event_name', 'Event Name', NULL, NULL, NULL, NULL, NULL),
(834, 'subscribe', 'Subscribe', NULL, NULL, NULL, NULL, NULL),
(835, 'subscribed', 'Subscribed', NULL, NULL, NULL, NULL, NULL),
(836, 'mail_specialcharacter_remove', '!#$%^&*()_+[]{}?:;|\'`/><', NULL, NULL, NULL, NULL, NULL),
(837, 'confirm_password', 'Confirm Password', NULL, NULL, NULL, NULL, NULL),
(838, 'remember_me', 'Remember Me', NULL, NULL, NULL, NULL, NULL),
(839, 'forgot_password', 'Forgot Password', NULL, NULL, NULL, NULL, NULL),
(840, 'add_commission', 'Add Commission', NULL, NULL, NULL, NULL, NULL),
(841, 'commission_list', 'Commission List', NULL, NULL, NULL, NULL, NULL),
(842, 'generated_successfully', 'Generated Successfully', NULL, NULL, NULL, NULL, NULL),
(843, 'faculty_commission', 'Faculty Commission', NULL, NULL, NULL, NULL, NULL),
(844, 'comming_soon', 'Comming Soon', NULL, NULL, NULL, NULL, NULL),
(845, 'faculty_course_commission', 'Faculty Course Commission', NULL, NULL, NULL, NULL, NULL),
(846, 'faculty_revenue', 'Faculty Revenue', NULL, NULL, NULL, NULL, NULL),
(847, 'pay_with_paypal', 'Pay with paypal', NULL, NULL, NULL, NULL, NULL),
(848, 'faculty_course_revenue', 'Faculty course revenue', NULL, NULL, NULL, NULL, NULL),
(849, 'payment', 'Payment', NULL, NULL, NULL, NULL, NULL),
(850, 'pay_with_paypal', 'Pay with paypal', NULL, NULL, NULL, NULL, NULL),
(851, 'payment_amount', 'Payment Amount', NULL, NULL, NULL, NULL, NULL),
(852, 'paypal_account', 'Paypal Account', NULL, NULL, NULL, NULL, NULL),
(853, 'balance', 'Balance', NULL, NULL, NULL, NULL, NULL),
(854, 'admin_revenue', 'Admin Revenue', NULL, NULL, NULL, NULL, NULL),
(855, 'revenue', 'Revenue', NULL, NULL, NULL, NULL, NULL),
(856, 'commission_rate', 'Commission Rate', NULL, NULL, NULL, NULL, NULL),
(857, 'total_revenue', 'Total Revenue', NULL, NULL, NULL, NULL, NULL),
(858, 'total_balance', 'Total Balance', NULL, NULL, NULL, NULL, NULL),
(859, 'total_event', 'Total Event', NULL, NULL, NULL, NULL, NULL),
(860, 'home', 'Home', NULL, NULL, NULL, NULL, NULL),
(861, 'course_benefit', 'Course Benefit', NULL, NULL, NULL, NULL, NULL),
(862, 'total_earning', 'Total Earning', NULL, NULL, NULL, NULL, NULL),
(863, 'pending_amount', 'Pending Amount', NULL, NULL, NULL, NULL, NULL),
(864, 'pay_now', 'Pay Now', NULL, NULL, NULL, NULL, NULL),
(865, 'payment_method', 'Payment Method', NULL, NULL, NULL, NULL, NULL),
(866, 'enter_phrase_name', 'Enter Phrase Name', NULL, NULL, NULL, NULL, NULL),
(867, 'what_you_are_going_to_learn', 'What you are going to learn', NULL, NULL, NULL, NULL, NULL),
(868, 'request_send_pls_waitfor_confirmation', 'Your registration request is send to admin please wait for conformation', NULL, NULL, NULL, NULL, NULL),
(869, 'timezone', 'Timezone', NULL, NULL, NULL, NULL, NULL),
(870, 'link', 'Link', NULL, NULL, NULL, NULL, NULL),
(871, 'payment_method_not_set_yet', 'Payment method not set yet', NULL, NULL, NULL, NULL, NULL),
(872, 'already_purchased', 'Already Purchased', NULL, NULL, NULL, NULL, NULL),
(873, 'purchased_course_list', 'Purchased course list', NULL, NULL, NULL, NULL, NULL),
(874, 'course_header_image', 'Course Header Image', NULL, NULL, NULL, NULL, NULL),
(875, 'faculty_header_image', 'Faculty Header Image', NULL, NULL, NULL, NULL, NULL),
(876, 'cart_header_image', 'Cart Header Image', NULL, NULL, NULL, NULL, NULL),
(877, 'checkout_header_image', 'Checkout Header Image', NULL, NULL, NULL, NULL, NULL),
(878, 'profile_header_image', 'Profile Header Image', NULL, NULL, NULL, NULL, NULL),
(879, 'news_and_events', 'News & Events', NULL, NULL, NULL, NULL, NULL),
(880, 'ordering', 'Ordering', NULL, NULL, NULL, NULL, NULL),
(881, 'library', 'Library', NULL, NULL, NULL, NULL, NULL),
(882, 'bootstrap_icon', 'Bootstrap Icon', NULL, NULL, NULL, NULL, NULL),
(883, 'wishlist', 'Wishlist', NULL, NULL, NULL, NULL, NULL),
(884, 'wishes', 'Wishes', NULL, NULL, NULL, NULL, NULL),
(885, 'sales', 'Sales', NULL, NULL, NULL, NULL, NULL),
(886, 'free', 'Free', NULL, NULL, NULL, NULL, NULL),
(887, 'add_to_mycourse', 'Add to my course', NULL, NULL, NULL, NULL, NULL),
(888, 'added_to_my_course', 'Added to my course', NULL, NULL, NULL, NULL, NULL),
(889, 'verified', 'Verified', NULL, NULL, NULL, NULL, NULL),
(890, 'create_an_account', 'Create an account', NULL, NULL, NULL, NULL, NULL),
(891, 'postcode', 'Postcode', NULL, NULL, NULL, NULL, NULL),
(892, 'zip', 'Zip', NULL, NULL, NULL, NULL, NULL),
(893, 'town', 'Town', NULL, NULL, NULL, NULL, NULL),
(894, 'country', 'Country', NULL, NULL, NULL, NULL, NULL),
(895, 'billing_info', 'Billing Information', NULL, NULL, NULL, NULL, NULL),
(896, 'revenue_report', 'Revenue Report', NULL, NULL, NULL, NULL, NULL),
(897, 'course_overview', 'Course Overview', NULL, NULL, NULL, NULL, NULL),
(898, 'faculty_unpaid_revenue', 'Faculty unpaid revenue', NULL, NULL, NULL, NULL, NULL),
(899, 'monthly_sales_amount', 'Monthly sales amount', NULL, NULL, NULL, NULL, NULL),
(900, 'due_payment', 'Due Payment', NULL, NULL, NULL, NULL, NULL),
(901, 'todays_sales_report', 'Todays sales report', NULL, NULL, NULL, NULL, NULL),
(903, 'sales_amount', 'Sales Amount', NULL, NULL, NULL, NULL, NULL),
(904, 'my_revenue', 'My Revenue', NULL, NULL, NULL, NULL, NULL),
(905, 'approve', 'Approve', NULL, NULL, NULL, NULL, NULL),
(906, 'disapprove', 'Disapprove', NULL, NULL, NULL, NULL, NULL),
(907, 'admin_commission', 'Admin Commission', NULL, NULL, NULL, NULL, NULL),
(908, 'please_wait_for_admin_approval', 'Please wait for admin approval', NULL, NULL, NULL, NULL, NULL),
(909, 'incorrect_email_or_password', 'Incorrect email or password', NULL, NULL, NULL, NULL, NULL),
(910, 'pusher_config', 'Pusher Config', NULL, NULL, NULL, NULL, NULL),
(911, 'api_id', 'API ID', NULL, NULL, NULL, NULL, NULL),
(912, 'api_key', 'API Key', NULL, NULL, NULL, NULL, NULL),
(913, 'secret_key', 'Secret Key', NULL, NULL, NULL, NULL, NULL),
(914, 'cluster', 'Cluster', NULL, NULL, NULL, NULL, NULL),
(915, 'pusher_configuration', 'Pusher Configuration', NULL, NULL, NULL, NULL, NULL),
(917, 'phrase_name', 'Phrase Name', NULL, NULL, NULL, NULL, NULL),
(918, 'label', 'Label', NULL, NULL, NULL, NULL, NULL),
(919, 'coursespecial_character', '@$^*_[]{}`><', NULL, NULL, NULL, NULL, NULL),
(920, 'unpaid_revenue', 'Unpaid Revenue', NULL, NULL, NULL, NULL, NULL),
(922, 'check', '', NULL, NULL, NULL, NULL, NULL),
(924, 'demo_blog', '', NULL, NULL, NULL, NULL, NULL),
(925, 'close', 'Close', NULL, NULL, NULL, NULL, NULL),
(926, 'sms_configuration', 'SMS Configuration', NULL, NULL, NULL, NULL, NULL),
(927, 'mail_configuration', 'Mail Configuration', NULL, NULL, NULL, NULL, NULL),
(928, 'slider', 'Slider', NULL, NULL, NULL, NULL, NULL),
(929, 'next', 'Next', NULL, NULL, NULL, NULL, NULL),
(930, 'active', 'Active', NULL, NULL, NULL, NULL, NULL),
(931, 'inactive', 'Inactive', NULL, NULL, NULL, NULL, NULL),
(932, 'previous', 'Previous', NULL, NULL, NULL, NULL, NULL),
(933, 'counted_as', 'Counted as', NULL, NULL, NULL, NULL, NULL),
(934, 'items', 'Items', NULL, NULL, NULL, NULL, NULL),
(935, 'date_format', 'Date Format', NULL, NULL, NULL, NULL, NULL),
(936, 'powered_by_text', 'Powered by text', NULL, NULL, NULL, NULL, NULL),
(937, 'api_secret', 'API Secret', NULL, NULL, NULL, NULL, NULL),
(938, 'language_list', 'Language List', NULL, NULL, NULL, NULL, NULL),
(939, 'shopping_cart', 'Shopping Cart', NULL, NULL, NULL, NULL, NULL),
(940, 'proced_to_checkout', 'Proced to checkout', NULL, NULL, NULL, NULL, NULL),
(941, 'you_might_also_like', 'You might also like', NULL, NULL, NULL, NULL, NULL),
(942, 'cart_totals', 'Cart Totals', NULL, NULL, NULL, NULL, NULL),
(943, 'place_order', 'Place Order', NULL, NULL, NULL, NULL, NULL),
(944, 'sandbox', 'Sandbox', NULL, NULL, NULL, NULL, NULL),
(945, 'hey', 'Hey', NULL, NULL, NULL, NULL, NULL),
(946, 'i_am', 'I am', NULL, NULL, NULL, NULL, NULL),
(947, 'what_do_you_want_to_learn', 'What do you want yo learn?', NULL, NULL, NULL, NULL, NULL),
(948, 'join_for_free', 'Join for Free', NULL, NULL, NULL, NULL, NULL),
(949, 'categories', 'Categories', NULL, NULL, NULL, NULL, NULL),
(950, 'backend_logo', 'Backend Logo', NULL, NULL, NULL, NULL, NULL),
(951, 'website_logo', 'Website Logo', NULL, NULL, NULL, NULL, NULL),
(952, 'sign_into_your_account', 'Sign into your account!', NULL, NULL, NULL, NULL, NULL),
(953, 'remember_password', 'Remember password', NULL, NULL, NULL, NULL, NULL),
(954, 'see_all', 'See All', NULL, NULL, NULL, NULL, NULL),
(955, 'left', 'Left', NULL, NULL, NULL, NULL, NULL),
(956, 'right', 'Right', NULL, NULL, NULL, NULL, NULL),
(957, 'currency_rate', 'Currency Rate', NULL, NULL, NULL, NULL, NULL),
(958, 'thememinister', 'Thememinister', NULL, NULL, NULL, NULL, NULL),
(959, 'designed_by', 'Designed By', NULL, NULL, NULL, NULL, NULL),
(960, 'your_order', 'Your Order', NULL, NULL, NULL, NULL, NULL),
(961, '[removed]alert&#40;\"I am an alert box!\"&#41;;[removed]', '', NULL, NULL, NULL, NULL, NULL),
(962, 'course_info', 'Course Information', NULL, NULL, NULL, NULL, NULL),
(963, 'short_description', 'Short Description', NULL, NULL, NULL, NULL, NULL),
(964, 'source', 'Source', NULL, NULL, NULL, NULL, NULL),
(965, 'featured_image', 'Featured Image', NULL, NULL, NULL, NULL, NULL),
(966, 'what_you_will_learn', 'What you will learn', NULL, NULL, NULL, NULL, NULL),
(967, 'current_price', 'Current Price', NULL, NULL, NULL, NULL, NULL),
(968, 'current', 'Current', NULL, NULL, NULL, NULL, NULL),
(969, 'course_quiz', 'Course Quiz', NULL, NULL, NULL, NULL, NULL),
(970, 'resize', 'Resize', NULL, NULL, NULL, NULL, NULL),
(971, 'course_image_resize', 'Course Image Resize', NULL, NULL, NULL, NULL, NULL),
(972, 'image_height', 'Image Height', NULL, NULL, NULL, NULL, NULL),
(973, 'image_width', 'Image Width', NULL, NULL, NULL, NULL, NULL),
(974, 'meta_title', 'Meta Title', NULL, NULL, NULL, NULL, NULL),
(975, 'image_path', 'Image Path', NULL, NULL, NULL, NULL, NULL),
(976, 'quiz', 'Quiz', NULL, NULL, NULL, NULL, NULL),
(977, 'login_logo', 'Login Logo', NULL, NULL, NULL, NULL, NULL),
(978, 'quiz_test', 'Quiz Test', NULL, NULL, NULL, NULL, NULL),
(979, 'choose_your_course', 'Choose Your Course', NULL, NULL, NULL, NULL, NULL),
(980, 'show', 'Show', NULL, NULL, NULL, NULL, NULL),
(981, 'quiz_result', 'Quiz Result', NULL, NULL, NULL, NULL, NULL),
(982, 'choose_your_course_for_result', 'Choose your course for result', NULL, NULL, NULL, NULL, NULL),
(983, 'total_quiz', 'Total Quiz', NULL, NULL, NULL, NULL, NULL),
(984, 'correct_ans', 'Correct Ans', NULL, NULL, NULL, NULL, NULL),
(985, 'wrong_ans', 'Wrong Ans', NULL, NULL, NULL, NULL, NULL),
(986, 'answer', 'Answer', NULL, NULL, NULL, NULL, NULL),
(987, 'no_course_available_here', '', 'No course available here!', NULL, NULL, NULL, NULL),
(988, 'owner_name', 'Bdtask ltd', NULL, NULL, NULL, NULL, NULL),
(989, 'currencyname', 'Cuurency Name', NULL, NULL, NULL, NULL, NULL),
(990, 'currency_icon', 'Cuurency Icon', NULL, NULL, NULL, NULL, NULL),
(991, 'currency_added_successfully', 'Currency Added Successfully', NULL, NULL, NULL, NULL, NULL),
(992, 'currency_info', 'Currency Information', NULL, NULL, NULL, NULL, NULL),
(993, 'currency_update_successfully', 'Currency updated successfully', NULL, NULL, NULL, NULL, NULL),
(994, 'currency_deleted_successfully', 'Currency deleted successfully', NULL, NULL, NULL, NULL, NULL),
(995, 'stripe_config', 'Stripe Config', NULL, NULL, NULL, NULL, NULL),
(996, 'payeer_config', 'Payeer Config', NULL, NULL, NULL, NULL, NULL),
(997, 'payu_config', 'PayU Config', NULL, NULL, NULL, NULL, NULL),
(998, 'payeer_configuration', 'Payeer Configuration', NULL, NULL, NULL, NULL, NULL),
(999, 'payment_method_name', 'Payment method name', NULL, NULL, NULL, NULL, NULL),
(1000, 'marchant_id', 'Marchant ID\r\n', NULL, NULL, NULL, NULL, NULL),
(1001, 'live', 'Live', NULL, NULL, NULL, NULL, NULL),
(1002, 'is_live', 'Is Live', NULL, NULL, NULL, NULL, NULL),
(1003, 'test', 'Test', NULL, NULL, NULL, NULL, NULL),
(1004, 'payu_configuration', 'PayU Configuration', NULL, NULL, NULL, NULL, NULL),
(1005, 'stripe_configuration', 'Stripe Configuration', NULL, NULL, NULL, NULL, NULL),
(1006, 'payeer_payment', 'Payeer Payment', NULL, NULL, NULL, NULL, NULL),
(1007, 'customer_id', 'Customer ID', NULL, NULL, NULL, NULL, NULL),
(1008, 'order_no', 'Order No', NULL, NULL, NULL, NULL, NULL),
(1009, 'cancel', 'Cancel', NULL, NULL, NULL, NULL, NULL),
(1010, 'payment_method_list', 'Payment Method List', NULL, NULL, NULL, NULL, NULL),
(1011, 'add_ons', 'Add-ons', NULL, NULL, NULL, NULL, NULL),
(1012, 'download', 'Download', NULL, NULL, NULL, NULL, NULL),
(1013, 'module_list', 'Module List', NULL, NULL, NULL, NULL, NULL),
(1014, 'purchase_key', 'Purchase Key', NULL, NULL, NULL, NULL, NULL),
(1015, 'success', 'Success', NULL, NULL, NULL, NULL, NULL),
(1016, 'you_got_a_purchase_key', 'You got a purchase key after purchasing this item', NULL, NULL, NULL, NULL, NULL),
(1017, 'almost_done_it', 'Almost done it.', NULL, NULL, NULL, NULL, NULL),
(1018, 'verify', 'Verify', NULL, NULL, NULL, NULL, NULL),
(1019, 'install_now', 'Install Now', NULL, NULL, NULL, NULL, NULL),
(1020, 'purchase_verification', 'Purchase Verification', NULL, NULL, NULL, NULL, NULL),
(1021, 'install', 'Install', NULL, NULL, NULL, NULL, NULL),
(1023, 'uninstall', 'Uninstall', NULL, NULL, NULL, NULL, NULL),
(1024, 'add_meeting', 'Add Meeting', NULL, NULL, NULL, NULL, NULL),
(1025, 'meeting_list', 'Meeting List', NULL, NULL, NULL, NULL, NULL),
(1026, 'meeting_id', 'Meeting ID', NULL, NULL, NULL, NULL, NULL),
(1027, 'start_time', 'Start Time', NULL, NULL, NULL, NULL, NULL),
(1028, 'end_time', 'End Time', NULL, NULL, NULL, NULL, NULL),
(1029, 'meeting_password', 'Meeting Password', NULL, NULL, NULL, NULL, NULL),
(1030, 'host', 'Host', NULL, NULL, NULL, NULL, NULL),
(1031, 'by', 'By', NULL, NULL, NULL, NULL, NULL),
(1032, 'waiting', 'Waiting', NULL, NULL, NULL, NULL, NULL),
(1033, 'expired', 'Expired', NULL, NULL, NULL, NULL, NULL),
(1034, 'host_live_meeting', 'Host Live Meeting', NULL, NULL, NULL, NULL, NULL),
(1037, 'join_live_meeting', 'Join Live Meeting', NULL, NULL, NULL, NULL, NULL),
(1038, 'meeting_date', 'Meeting Date', NULL, NULL, NULL, NULL, NULL),
(1050, 'module_added_successfully', 'Module added successfully', NULL, NULL, NULL, NULL, NULL),
(1057, 'sq', 'sq', NULL, NULL, NULL, NULL, NULL),
(1063, 'one', 'One', NULL, NULL, NULL, NULL, NULL),
(1064, 'paystack', 'Paystack', NULL, NULL, NULL, NULL, NULL),
(1065, 'paystack_configuration', 'Paystack Configuration', NULL, NULL, NULL, NULL, NULL),
(1066, 'paystack_config', 'Paystack Config', NULL, NULL, NULL, NULL, NULL),
(1070, 'paystack', 'Paystack', NULL, NULL, NULL, NULL, NULL),
(1071, 'paystack_configuration', 'Paystack Configuration', NULL, NULL, NULL, NULL, NULL),
(1072, 'paystack_config', 'Paystack Config', NULL, NULL, NULL, NULL, NULL),
(1073, 'paystack', 'Paystack', NULL, NULL, NULL, NULL, NULL),
(1074, 'paystack_configuration', 'Paystack Configuration', NULL, NULL, NULL, NULL, NULL),
(1075, 'paystack_config', 'Paystack Config', NULL, NULL, NULL, NULL, NULL),
(1076, 'paystack', 'Paystack', NULL, NULL, NULL, NULL, NULL),
(1077, 'paystack_configuration', 'Paystack Configuration', NULL, NULL, NULL, NULL, NULL),
(1078, 'paystack_config', 'Paystack Config', NULL, NULL, NULL, NULL, NULL),
(1079, 'paystack', 'Paystack', NULL, NULL, NULL, NULL, NULL),
(1080, 'paystack_configuration', 'Paystack Configuration', NULL, NULL, NULL, NULL, NULL),
(1081, 'paystack_config', 'Paystack Config', NULL, NULL, NULL, NULL, NULL),
(1103, 'live_course_update', 'Live Course Update', NULL, NULL, NULL, NULL, NULL),
(1104, 'live_course', 'Live Course', NULL, NULL, NULL, NULL, NULL),
(1105, 'join_zoom_meeting', 'Join Zoom Meeting', NULL, NULL, NULL, NULL, NULL),
(1106, 'zoom_config', 'Zoom Config', NULL, NULL, NULL, NULL, NULL),
(1107, 'zoom_configuration', 'Zoom Configuration', NULL, NULL, NULL, NULL, NULL),
(1108, 'zoom_api_key', 'Zoom API Key', NULL, NULL, NULL, NULL, NULL),
(1109, 'zoom_api_secret', 'Zoom API Secret', NULL, NULL, NULL, NULL, NULL),
(1110, 'zoom_meeting', 'Zoom Meeting', NULL, NULL, NULL, NULL, NULL),
(1111, 'add_live_course', 'Add Live Course', NULL, NULL, NULL, NULL, NULL),
(1112, 'enterprise', 'Enterprise', NULL, NULL, NULL, NULL, NULL),
(1113, 'add_enterprise', 'Add Enterprise', NULL, NULL, NULL, NULL, NULL),
(1114, 'enterprise_list', 'Enterprise List', NULL, NULL, NULL, NULL, NULL),
(1115, 'role_assign', 'Role Assign', NULL, NULL, NULL, NULL, NULL),
(1116, 'student_capacity', 'Student Capacity', NULL, NULL, NULL, NULL, NULL),
(1117, 'instructor_capacity', 'Instructor Capacity', NULL, NULL, NULL, NULL, NULL),
(1118, 'date_of_birth', 'Date of Birth', NULL, NULL, NULL, NULL, NULL),
(1119, 'added_successfully', 'Added successfully', NULL, NULL, NULL, NULL, NULL),
(1120, 'interprise_info', 'Enterprise Info', NULL, NULL, NULL, NULL, NULL),
(1121, 'subscription', 'Subscription', NULL, NULL, NULL, NULL, NULL),
(1122, 'govt', 'Govt', NULL, NULL, NULL, NULL, NULL),
(1123, 'course_type', 'Course Type', NULL, NULL, NULL, NULL, NULL),
(1124, 'is_new', 'Is New', NULL, NULL, NULL, NULL, NULL),
(1125, 'offer', 'Offer', NULL, NULL, NULL, NULL, NULL),
(1126, 'is_discount', 'Is Discount', NULL, NULL, NULL, NULL, NULL),
(1127, 'menu_setup', 'Menu Setup', NULL, NULL, NULL, NULL, NULL),
(1128, 'is_settings', 'Is Settings', NULL, NULL, NULL, NULL, NULL),
(1129, 'is_role', 'Is Role', NULL, NULL, NULL, NULL, NULL),
(1130, 'menusetup_list', 'Menusetup List', NULL, NULL, NULL, NULL, NULL),
(1131, 'companies_logo', 'Companies Logo', NULL, NULL, NULL, NULL, NULL),
(1132, 'ready_subscription_area', 'Ready Subscription Area', NULL, NULL, NULL, NULL, NULL),
(1133, 'is_ready', 'Is Ready', NULL, NULL, NULL, NULL, NULL),
(1134, 'subscription_list', 'Subscription List', NULL, NULL, NULL, NULL, NULL),
(1135, 'add_subscription', 'Add Subscription', NULL, NULL, NULL, NULL, NULL),
(1136, 'template', 'Template', NULL, NULL, NULL, NULL, NULL),
(1137, 'template_body', 'Template Body', NULL, NULL, NULL, NULL, NULL),
(1138, 'certificate', 'Certificate', NULL, NULL, NULL, NULL, NULL),
(1139, 'template_type', 'Template Type', NULL, NULL, NULL, NULL, NULL),
(1140, 'data_synchronizer', 'Data Synchronizer', NULL, NULL, NULL, NULL, NULL),
(1141, 'restore', 'Restore', NULL, NULL, NULL, NULL, NULL),
(1142, 'db_import', 'Import', NULL, NULL, NULL, NULL, NULL),
(1143, 'backup', 'Back Up', NULL, NULL, NULL, NULL, NULL),
(1144, 'assign_certificate', 'Assign Certificate', NULL, NULL, NULL, NULL, NULL),
(1145, 'student_name', 'Student Name', NULL, NULL, NULL, NULL, NULL),
(1146, 'certificate_name', 'Certificate Name', NULL, NULL, NULL, NULL, NULL),
(1147, 'assign', 'Assign', NULL, NULL, NULL, NULL, NULL),
(1148, 'short_answer', 'Short Answer', NULL, NULL, NULL, NULL, NULL),
(1149, 'question_type', 'Question Type', NULL, NULL, NULL, NULL, NULL),
(1150, 'question_mark', 'Question Mark', NULL, NULL, NULL, NULL, NULL),
(1151, 'mark', 'Mark', NULL, NULL, NULL, NULL, NULL),
(1152, 'edit_exam', 'Edit Exam', NULL, NULL, NULL, NULL, NULL),
(1153, 'exam_information', 'Exam Information', NULL, NULL, NULL, NULL, NULL),
(1154, 'select_one', '-- select one --', NULL, NULL, NULL, NULL, NULL),
(1155, 'question_name', 'Question Name', NULL, NULL, NULL, NULL, NULL),
(1156, 'library_content_list', 'Library Content List', NULL, NULL, NULL, NULL, NULL),
(1157, 'correct_answer', 'Correct Answer', NULL, NULL, NULL, NULL, NULL),
(1158, 'assign_exam', 'Assign Exam', NULL, NULL, NULL, NULL, NULL),
(1159, 'assigned_successfully', 'Assigned successfully', NULL, NULL, NULL, NULL, NULL),
(1160, 'library', 'Library', NULL, NULL, NULL, NULL, NULL),
(1161, 'library_information', 'Library Information', NULL, NULL, NULL, NULL, NULL),
(1162, 'library_pricing', 'Library Pricing', NULL, NULL, NULL, NULL, NULL),
(1163, 'level', 'Level', NULL, NULL, NULL, NULL, NULL),
(1164, 'file_type', 'File Type', NULL, NULL, NULL, NULL, NULL),
(1165, 'file_upload', 'File Upload', NULL, NULL, NULL, NULL, NULL),
(1166, 'is_free', 'Is Free', NULL, NULL, NULL, NULL, NULL),
(1167, 'library_content_edit', 'Library Content Edit', NULL, NULL, NULL, NULL, NULL),
(1168, 'header_color', 'Header Color', NULL, NULL, NULL, NULL, NULL),
(1169, 'sidebar_color', 'Sidebar Color', NULL, NULL, NULL, NULL, NULL),
(1170, 'sidebar_active_color', 'Sidebar Active Color', NULL, NULL, NULL, NULL, NULL),
(1171, 'footer_color', 'Footer Color', NULL, NULL, NULL, NULL, NULL),
(1172, 'pptx', 'Power Point (PPTX)', NULL, NULL, NULL, NULL, NULL),
(1173, 'button_color', 'Button Color', NULL, NULL, NULL, NULL, NULL),
(1174, 'instructor', 'Instructor', NULL, NULL, NULL, NULL, NULL),
(1175, 'add_instructor', 'Add Instructor', NULL, NULL, NULL, NULL, NULL),
(1176, 'instructor_list', 'Instructor List', NULL, NULL, NULL, NULL, NULL),
(1177, 'edit', 'Edit', NULL, NULL, NULL, NULL, NULL),
(1178, 'instructor_unpaid_revenue', 'Instructor Unpaid Revenue', NULL, NULL, NULL, NULL, NULL),
(1179, 'instructor_name', 'Instructor Name', NULL, NULL, NULL, NULL, NULL),
(1180, 'total_instructor', 'Total Instructor', NULL, NULL, NULL, NULL, NULL),
(1181, 'instructor_commission', 'Instructor Commission', NULL, NULL, NULL, NULL, NULL),
(1182, 'created_date', 'Created Date', NULL, NULL, NULL, NULL, NULL),
(1183, 'updated_date', 'Updated Date', NULL, NULL, NULL, NULL, NULL),
(1184, 'updated_by', 'Updated By', NULL, NULL, NULL, NULL, NULL),
(1185, 'exam_archives', 'Exam Archives', NULL, NULL, NULL, NULL, NULL),
(1186, 'exam_archives_list', 'Exam Archives List', NULL, NULL, NULL, NULL, NULL),
(1187, 'created_date', 'Created Date', NULL, NULL, NULL, NULL, NULL),
(1188, 'updated_date', 'Updated Date', NULL, NULL, NULL, NULL, NULL),
(1189, 'updated_by', 'Updated By', NULL, NULL, NULL, NULL, NULL),
(1190, 'deleted_by', 'Deleted By', NULL, NULL, NULL, NULL, NULL),
(1191, 'deleted_date', 'Deleted Date', NULL, NULL, NULL, NULL, NULL),
(1192, 'archives', 'Archives', NULL, NULL, NULL, NULL, NULL),
(1193, 'category_archives', 'Category Archives', NULL, NULL, NULL, NULL, NULL),
(1194, 'course_archives', 'Course Archives', NULL, NULL, NULL, NULL, NULL),
(1195, 'show_category', 'Show Category', NULL, NULL, NULL, NULL, NULL),
(1196, 'coupon', 'Coupon', NULL, NULL, NULL, NULL, NULL),
(1197, 'add_coupon', 'Add Coupon', NULL, NULL, NULL, NULL, NULL),
(1198, 'coupon_list', 'Coupon List', NULL, NULL, NULL, NULL, NULL),
(1199, 'edit_coupon', 'Edit Coupon', NULL, NULL, NULL, NULL, NULL),
(1200, 'coupon_discount', 'Coupon Discount', NULL, NULL, NULL, NULL, NULL),
(1201, 'discount_type', 'Discount Type', NULL, NULL, NULL, NULL, NULL),
(1202, 'pdf', 'PDF', NULL, NULL, NULL, NULL, NULL),
(1203, 'frontend', 'Frontend', NULL, NULL, NULL, NULL, NULL),
(1204, 'activities_log', 'Activities Log', NULL, NULL, NULL, NULL, NULL),
(1205, 'background_video_url', 'Background video url', NULL, NULL, NULL, NULL, NULL),
(1206, 'short_video_url', 'Short video url', NULL, NULL, NULL, NULL, NULL),
(1207, 'slider_point_one', 'Point One', NULL, NULL, NULL, NULL, NULL),
(1208, 'slider_point_two', 'Point Two', NULL, NULL, NULL, NULL, NULL),
(1209, 'slider_point_three', 'Point Three', NULL, NULL, NULL, NULL, NULL),
(1210, 'we_collaborate_with', 'We Collaborate with', NULL, NULL, NULL, NULL, NULL),
(1211, 'testimonials', 'Testimonials', NULL, NULL, NULL, NULL, NULL),
(1212, 'testimonials_list', 'Testimonials List', NULL, NULL, NULL, NULL, NULL),
(1213, 'add_testimonial', 'Add Testimonial', NULL, NULL, NULL, NULL, NULL),
(1214, 'testimonials', 'Testimonials', NULL, NULL, NULL, NULL, NULL),
(1218, 'getfeaturedin', 'Featured In', NULL, NULL, NULL, NULL, NULL),
(1220, 'featured_in', 'Featured in', NULL, NULL, NULL, NULL, NULL),
(1221, 'featured_in_added_successfully', 'Featured in added successfully', NULL, NULL, NULL, NULL, NULL),
(1222, 'pre_requisites', 'Pre Requisites', NULL, NULL, NULL, NULL, NULL),
(1223, 'what_will_i_learn', 'What Will I Learn?', NULL, NULL, NULL, NULL, NULL),
(1224, 'topics_for_this_course', 'Topics for this course', NULL, NULL, NULL, NULL, NULL),
(1225, 'meet_your_instructor', 'Meet Your Instructor', NULL, NULL, NULL, NULL, NULL),
(1226, 'for_enterprise', 'For Enterprise', NULL, NULL, NULL, NULL, NULL),
(1227, 'for_instructor', 'For Instructor', NULL, NULL, NULL, NULL, NULL),
(1228, 'secured_with_SSL', 'Secured with SSL', NULL, NULL, NULL, NULL, NULL),
(1229, 'facebook_link', 'Facebook Link', NULL, NULL, NULL, NULL, NULL),
(1230, 'twitter_link', 'Twitter Link', NULL, NULL, NULL, NULL, NULL),
(1231, 'youtube_link', 'Youtube Link', NULL, NULL, NULL, NULL, NULL),
(1232, 'instagram_link', 'Instagram Link', NULL, NULL, NULL, NULL, NULL),
(1233, 'sign_in', 'Sign in', NULL, NULL, NULL, NULL, NULL),
(1234, 'pre_requisites', 'Pre Requisites', NULL, NULL, NULL, NULL, NULL),
(1235, 'what_will_i_learn', 'What Will I Learn?', NULL, NULL, NULL, NULL, NULL),
(1236, 'topics_for_this_course', 'Topics for this course', NULL, NULL, NULL, NULL, NULL),
(1237, 'meet_your_instructor', 'Meet Your Instructor', NULL, NULL, NULL, NULL, NULL),
(1238, 'for_enterprise', 'For Enterprise', NULL, NULL, NULL, NULL, NULL),
(1239, 'for_instructor', 'For Instructor', NULL, NULL, NULL, NULL, NULL),
(1240, 'website_footer_logo', 'Website Footer Logo', NULL, NULL, NULL, NULL, NULL),
(1241, 'lectures', 'Lectures', NULL, NULL, NULL, NULL, NULL),
(1242, 'faq', 'FAQ', NULL, NULL, NULL, NULL, NULL),
(1243, 'add_faq', 'Add FAQ', NULL, NULL, NULL, NULL, NULL),
(1244, 'frequently_asked_questions', 'Frequently Asked Questions', NULL, NULL, NULL, NULL, NULL),
(1245, 'notes', 'Notes', NULL, NULL, NULL, NULL, NULL),
(1246, 'item', 'Item', NULL, NULL, NULL, NULL, NULL),
(1247, 'proficiency', 'Proficiency', NULL, NULL, NULL, NULL, NULL),
(1248, 'syllabus', 'Syllabus', NULL, NULL, NULL, NULL, NULL),
(1249, 'pass_mark', 'Pass Mark', NULL, NULL, NULL, NULL, NULL),
(1250, 'forums', 'Forums', NULL, NULL, NULL, NULL, NULL),
(1251, 'add_forum', 'Add Forum', NULL, NULL, NULL, NULL, NULL),
(1252, 'forum_list', 'Forum List', NULL, NULL, NULL, NULL, NULL),
(1253, 'forum_edit', 'Forum Edit', NULL, NULL, NULL, NULL, NULL),
(1254, 'forum_save', 'Forum Save', NULL, NULL, NULL, NULL, NULL),
(1255, 'forum_update', 'Forum Update', NULL, NULL, NULL, NULL, NULL),
(1256, 'forum_category', 'Forum Category', NULL, NULL, NULL, NULL, NULL),
(1257, 'add_forum_category', 'Add Forum Category', NULL, NULL, NULL, NULL, NULL),
(1258, 'forum', 'Forum', NULL, NULL, NULL, NULL, NULL),
(1259, 'event_id', 'Event ID', NULL, NULL, NULL, NULL, NULL),
(1260, 'event_password', 'Event Password', NULL, NULL, NULL, NULL, NULL),
(1261, 'event_level', 'Event Level', NULL, NULL, NULL, NULL, NULL),
(1262, 'event', 'Event', NULL, NULL, NULL, NULL, NULL),
(1263, 'live_event_update', 'Live Event Update', NULL, NULL, NULL, NULL, NULL),
(1264, 'degree', 'Degree', NULL, NULL, NULL, NULL, NULL),
(1265, 'is_offer', 'Is Offer', NULL, NULL, NULL, NULL, NULL),
(1266, 'sub', 'Sub', NULL, NULL, NULL, NULL, NULL),
(1267, 'events_or_live', 'Events Or Live', NULL, NULL, NULL, NULL, NULL),
(1268, 'events_or_live', 'Events Or Live', NULL, NULL, NULL, NULL, NULL),
(1269, 'add_certificate', 'Add Certificate', NULL, NULL, NULL, NULL, NULL),
(1270, 'certificate_list', 'Certificate List', NULL, NULL, NULL, NULL, NULL),
(1271, 'share_percent', 'Share Percent', NULL, NULL, NULL, NULL, NULL),
(1272, 'rating', 'Ratings', NULL, NULL, NULL, NULL, NULL),
(1273, 'add_certificate', 'Add Certificate', NULL, NULL, NULL, NULL, NULL),
(1274, 'certificate_list', 'Certificate List', NULL, NULL, NULL, NULL, NULL),
(1275, 'certificate_archives', 'Certificate Archives', NULL, NULL, NULL, NULL, NULL),
(1276, 'events_or_live', 'Events Or Live', NULL, NULL, NULL, NULL, NULL),
(1277, 'share_percent', 'Share Percent', NULL, NULL, NULL, NULL, NULL),
(1278, 'subscription_instructor_pricing', 'Subscription Instructor Pricing', NULL, NULL, NULL, NULL, NULL),
(1279, 'subscription_pricing', 'Subscription Pricing', NULL, NULL, NULL, NULL, NULL),
(1280, 'lead_featured_image', 'Lead featured image', NULL, NULL, NULL, NULL, NULL),
(1282, 'docusign_sample', 'Docusign sample', NULL, NULL, NULL, NULL, NULL),
(1283, 'socail_auth', 'Social Auth', NULL, NULL, NULL, NULL, NULL),
(1284, 'google_login_config', 'Google login config', NULL, NULL, NULL, NULL, NULL),
(1285, 'facebook_login_config', 'Facebook login config', NULL, NULL, NULL, NULL, NULL),
(1289, 'site_faq', 'Site FAQ', NULL, NULL, NULL, NULL, NULL),
(1290, 'course_faq', 'Course FAQ', NULL, NULL, NULL, NULL, NULL),
(1291, 'communicate', 'Communicate', NULL, NULL, NULL, NULL, NULL),
(1292, 'notice_board', 'Notice Board', NULL, NULL, NULL, NULL, NULL),
(1293, 'send_email', 'Send Email', NULL, NULL, NULL, NULL, NULL),
(1294, 'send_sms', 'Send SMS', NULL, NULL, NULL, NULL, NULL),
(1295, 'course_faq', 'Course FAQ', NULL, NULL, NULL, NULL, NULL),
(1300, 'site_faq', 'Site FAQ', NULL, NULL, NULL, NULL, NULL),
(1301, 'course_faq', 'Course FAQ', NULL, NULL, NULL, NULL, NULL),
(1302, 'email_sms_list', 'Email or Sms list', NULL, NULL, NULL, NULL, NULL),
(1303, 'notice_board_list', 'Notice Board list', NULL, NULL, NULL, NULL, NULL),
(1304, 'subcategory', 'Subcategory', NULL, NULL, NULL, NULL, NULL),
(1305, 'docusign', 'Docusign', NULL, NULL, NULL, NULL, NULL),
(1306, 'social_auth', 'Social Auth', NULL, NULL, NULL, NULL, NULL),
(1307, 'vimeo_config', 'Vimeo Config', NULL, NULL, NULL, NULL, NULL),
(1308, 'projects', 'Projects', NULL, NULL, NULL, NULL, NULL),
(1309, 'instructor_reports', 'Instructor Reports', NULL, NULL, NULL, NULL, NULL),
(1310, 'home_page_setting', 'Home Page Setting', NULL, NULL, NULL, NULL, NULL),
(1311, 'our_features', 'Our Features', NULL, NULL, NULL, NULL, NULL),
(1312, 'collaborate', 'Collaborate', NULL, NULL, NULL, NULL, NULL),
(1313, 'website_settngs', 'Website Settngs', NULL, NULL, NULL, NULL, NULL),
(1314, 'any_question', 'Any Question', NULL, NULL, NULL, NULL, NULL),
(1315, 'any_questions', 'Any Questions', NULL, NULL, NULL, NULL, NULL),
(1316, 'any_questions', 'Any Questions', NULL, NULL, NULL, NULL, NULL),
(1317, 'need_a_consultation', 'Need a consultation', NULL, NULL, NULL, NULL, NULL),
(1318, 'strength_number', 'Strength Number', NULL, NULL, NULL, NULL, NULL),
(1319, 'need_consultation', 'Need Consultaion', NULL, NULL, NULL, NULL, NULL),
(1320, 'newsletter', 'Newsletter', NULL, NULL, NULL, NULL, NULL),
(1321, 'professional_proficiency', 'Professional Proficiency', NULL, NULL, NULL, NULL, NULL),
(1322, 'communication', 'Communication', NULL, NULL, NULL, NULL, NULL),
(1323, 'email_list', 'Email List', NULL, NULL, NULL, NULL, NULL),
(1324, 'sms_list', 'SMS List', NULL, NULL, NULL, NULL, NULL),
(1325, 'mobileno_already_exists', 'Mobile no already exists', NULL, NULL, NULL, NULL, NULL),
(1326, 'edit_testimonial', 'Edit Testimonial', NULL, NULL, NULL, NULL, NULL),
(1327, 'aboutus', 'Aboutus', NULL, NULL, NULL, NULL, NULL),
(1328, 'paywith', 'Paywith', NULL, NULL, NULL, NULL, NULL),
(1329, 'refund_policy', 'Refund Policy', NULL, NULL, NULL, NULL, NULL),
(1330, 'quiz_list', 'Quiz List', NULL, NULL, NULL, NULL, NULL),
(1331, 'watchtime_list', 'Watchtime List', NULL, NULL, NULL, NULL, NULL),
(1332, 'payment_disbursement', 'Payment Disbursement', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ledger_tbl`
--

CREATE TABLE `ledger_tbl` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ledger_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_category` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '3 = faculty and 4 student',
  `invoice_no` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `receipt_no` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_type` int(11) NOT NULL COMMENT '1=paypal',
  `amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `d_c` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lesson_tbl`
--

CREATE TABLE `lesson_tbl` (
  `id` int(11) NOT NULL,
  `lesson_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `course_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lesson_name` text COLLATE utf8_unicode_ci NOT NULL,
  `section_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lesson_type` int(11) NOT NULL COMMENT '1=video, 2=text file, 3 = picture, 4 = ppt and 5 = pdf',
  `lesson_provider` int(11) DEFAULT NULL COMMENT '1=youtube and 2=viemo',
  `provider_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `duration` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `summary` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_preview` int(11) DEFAULT 0 COMMENT '0=no and 1= yes',
  `lesson_order` int(11) DEFAULT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lesson_tbl`
--

INSERT INTO `lesson_tbl` (`id`, `lesson_id`, `course_id`, `lesson_name`, `section_id`, `lesson_type`, `lesson_provider`, `provider_url`, `duration`, `summary`, `description`, `is_preview`, `lesson_order`, `enterprise_id`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(268, 'LE27R76LY', 'CO27V632V', 'lesson one', 'SE27YFYJS', 1, 2, 'https://vimeo.com/703600132', '00:09:59', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n', 1, 1, '1', '1', '2022-04-27 16:54:12', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `library_tbl`
--

CREATE TABLE `library_tbl` (
  `id` int(11) NOT NULL,
  `library_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `faculty_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL COMMENT '1=basic & 2=premium',
  `offer_courseid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8_unicode_ci NOT NULL,
  `is_free` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `oldprice` decimal(10,2) NOT NULL,
  `is_discount` int(11) NOT NULL,
  `discount` decimal(10,0) NOT NULL,
  `content_provider` varchar(2) COLLATE utf8_unicode_ci NOT NULL COMMENT '1=youtube and 2 = vimeo',
  `source` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes_tbl`
--

CREATE TABLE `likes_tbl` (
  `likes_id` int(11) NOT NULL,
  `project_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `likestatus` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'True = Yes and False = No',
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `enterprise_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loginfo_tbl`
--

CREATE TABLE `loginfo_tbl` (
  `id` int(11) NOT NULL,
  `log_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shortname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_types` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '1 = Superadmin, 2 = Enterprise Admin, 3 = Users, 4 = Student and 5 = Teacher',
  `is_admin` int(11) NOT NULL COMMENT '1 = Superadmin, 2 = Enterprise Admin, 3 = Users, 4 = Student and 5 = Teacher',
  `random_key` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_logout` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=inactive and 1 = active',
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `loginfo_tbl`
--

INSERT INTO `loginfo_tbl` (`id`, `log_id`, `name`, `shortname`, `mobile`, `email`, `username`, `password`, `user_types`, `is_admin`, `random_key`, `last_login`, `last_logout`, `ip_address`, `status`, `enterprise_id`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(67, '1', 'Admin', 'admin', '7879879834', 'admin@gmail.com', 'admin@gmail.com', '8aa2a80d18bbcb99144a906706e96c1f', '1', 1, NULL, '2022-05-11 12:17:08', '2022-04-27 16:26:15', '202.40.180.94', 1, '1', 1, '2020-05-09 10:34:43', 1, '0000-00-00 00:00:00'),
(433, 'F27BEQFJ5', 'Akbar Hossain', NULL, '01827928777', 'akbar22@gmail.com', 'akbar22@gmail.com', '21bd89b698b12c490f478216749425f8', '5', 5, NULL, '', '', '', 1, '1', 1, '2022-04-27 12:36:26', 0, NULL),
(434, 'ST2793YBB6', 'Zahid Khan', '', '01521310229', 'zahid22@gmail.com', 'zahid22@gmail.com', '21bd89b698b12c490f478216749425f8', '4', 4, '7954', '2022-04-27 13:54:22', '2022-04-27 14:12:35', '202.40.180.94', 1, '1', 1, '2022-04-27 12:39:01', 0, NULL),
(435, 'ST09COMMOR', 'Md. Shahab uddin', '', '01684964913', 'shahabuddinp91@gmail.com', 'shahabuddinp91@gmail.com', '7367cc4cee061a476290d18978830414', '4', 4, '6034', '', '', '', 1, '1', 1, '2022-05-09 15:15:26', 0, '2022-05-09 15:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `mail_config_tbl`
--

CREATE TABLE `mail_config_tbl` (
  `id` int(11) NOT NULL,
  `protocol` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `smtp_host` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `smtp_port` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `smtp_user` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `smtp_pass` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mailtype` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_invoice` int(11) NOT NULL,
  `is_purchase` int(11) NOT NULL,
  `is_receive` int(11) NOT NULL,
  `is_payment` int(11) NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mail_config_tbl`
--

INSERT INTO `mail_config_tbl` (`id`, `protocol`, `smtp_host`, `smtp_port`, `smtp_user`, `smtp_pass`, `mailtype`, `is_invoice`, `is_purchase`, `is_receive`, `is_payment`, `enterprise_id`, `updated_by`, `updated_date`, `status`) VALUES
(1, 'smtp', 'mail.lead.academy', '587', 'noreply@lead.academy', 'J8FPw_uWyL', 'html', 1, 0, 1, 0, '1', 1, '2019-07-08 22:50:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `meeting_participant_tbl`
--

CREATE TABLE `meeting_participant_tbl` (
  `id` int(11) NOT NULL,
  `event_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `live_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meeting_tbl`
--

CREATE TABLE `meeting_tbl` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `course_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `meeting_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meeting_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meeting_date` date NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `end_time` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `identity` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `directory` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `name`, `identity`, `description`, `image`, `directory`, `status`) VALUES
(4, 'Square', 'square', 'Simple Square', 'application/modules/square/assets/images/thumbnail.jpg', 'square', 1),
(7, 'SSLCommerz', 'sslcommerz', 'Simple sslcommerz', 'application/modules/sslcommerz/assets/images/thumbnail.jpg', 'sslcommerz', 1),
(8, 'Paystack', 'paystack', 'Simple Paystack', 'application/modules/paystack/assets/images/thumbnail.jpg', 'paystack', 1),
(12, 'Zoom Meeting', 'zoom', 'Simple zoom live meeting', 'application/modules/zoom/assets/images/thumbnail.jpg', 'zoom', 1);

-- --------------------------------------------------------

--
-- Table structure for table `module_permission`
--

CREATE TABLE `module_permission` (
  `id` int(11) NOT NULL,
  `fk_module_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `create` tinyint(1) DEFAULT NULL,
  `read` tinyint(1) DEFAULT NULL,
  `update` tinyint(1) DEFAULT NULL,
  `delete` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notes_tbl`
--

CREATE TABLE `notes_tbl` (
  `id` int(11) NOT NULL,
  `course_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'student_id that means user id(entry student id & instructor id)',
  `lesson_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=notes, 2=student sticky note and 3=instructor sticky note',
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications_tbl`
--

CREATE TABLE `notifications_tbl` (
  `id` int(11) NOT NULL,
  `notification_id` varchar(20) NOT NULL,
  `student_id` varchar(20) NOT NULL COMMENT 'student_id = student and teacher',
  `notification_type` int(11) NOT NULL COMMENT '1=course,2=event,3 =forum,4=offer_course,\r\n5=community,\r\n6=project,\r\n7=quiz,\r\n8=purchase,\r\n9=subscription_expire\r\n',
  `type` int(11) DEFAULT NULL COMMENT '1=approved , 2=reject',
  `isNotify` tinyint(4) NOT NULL COMMENT '1=unread,0=read',
  `message` varchar(255) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `enterprise_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notification_config_tbl`
--

CREATE TABLE `notification_config_tbl` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `courses_site` int(11) NOT NULL,
  `courses_email` int(11) NOT NULL,
  `courses_sms` int(11) NOT NULL,
  `offerupdates_site` int(11) NOT NULL,
  `offerupdates_email` int(11) NOT NULL,
  `offerupdates_sms` int(11) NOT NULL,
  `blog_site` int(11) NOT NULL,
  `blog_email` int(11) NOT NULL,
  `blog_sms` int(11) NOT NULL,
  `events_site` int(11) NOT NULL,
  `events_email` int(11) NOT NULL,
  `events_sms` int(11) NOT NULL,
  `community_site` int(11) NOT NULL,
  `community_email` int(11) NOT NULL,
  `community_sms` int(11) NOT NULL,
  `soundnoti_site` int(11) NOT NULL,
  `soundnoti_email` int(11) NOT NULL,
  `soundnoti_sms` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=student and 2=instructor',
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notification_config_tbl`
--

INSERT INTO `notification_config_tbl` (`id`, `user_id`, `courses_site`, `courses_email`, `courses_sms`, `offerupdates_site`, `offerupdates_email`, `offerupdates_sms`, `blog_site`, `blog_email`, `blog_sms`, `events_site`, `events_email`, `events_sms`, `community_site`, `community_email`, `community_sms`, `soundnoti_site`, `soundnoti_email`, `soundnoti_sms`, `type`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(51, 'ST2793YBB6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'ST2793YBB6', '2022-04-27 16:39:01', 'ST2793YBB6', '2022-04-27 16:39:01'),
(52, 'ST09COMMOR', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'ST09COMMOR', '2022-05-09 19:15:27', 'ST09COMMOR', '2022-05-09 19:15:27');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `page_id` int(11) NOT NULL,
  `page_title` text NOT NULL,
  `page_url` text NOT NULL,
  `page_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payeer_config`
--

CREATE TABLE `payeer_config` (
  `id` int(11) NOT NULL,
  `payment_method_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `marchant_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_live` int(11) NOT NULL COMMENT '1=live and 0= test',
  `status` int(11) NOT NULL COMMENT '1=active and 0=inactive',
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method_tbl`
--

CREATE TABLE `payment_method_tbl` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` int(11) NOT NULL,
  `marchant_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_live` int(11) NOT NULL COMMENT '1=live and 0= test',
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL COMMENT '1=active and 0=inactive',
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment_method_tbl`
--

INSERT INTO `payment_method_tbl` (`id`, `title`, `value`, `marchant_id`, `password`, `email`, `currency`, `is_live`, `created_by`, `created_at`, `status`, `enterprise_id`) VALUES
(1, 'SSLCOMMERZ', 1, 'leadacademylive', '6214A3337EA8D80928', 'style@gmail.com', 'BDT', 1, '1', '2022-03-04 05:42:24', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `payment_withdrawrequst_tbl`
--

CREATE TABLE `payment_withdrawrequst_tbl` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `user_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payment_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` float(10,3) NOT NULL,
  `status` int(11) NOT NULL COMMENT '4=pending, 1=paid, 2=onhold and 3=cancelled',
  `remarks` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `paid_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_date` timestamp NULL DEFAULT NULL,
  `enterprise_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payu_config`
--

CREATE TABLE `payu_config` (
  `id` int(11) NOT NULL,
  `payment_method_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `marchant_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_live` int(11) NOT NULL COMMENT '1=live and 0= test',
  `status` int(11) NOT NULL COMMENT '1=active and 0=inactive',
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payu_config`
--

INSERT INTO `payu_config` (`id`, `payment_method_name`, `marchant_id`, `password`, `email`, `currency`, `is_live`, `status`, `enterprise_id`) VALUES
(1, 'PayU', 'gtKFFx', 'eCwWELxi', 'test@gmail.com', 'USD', 0, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `paywith_tbl`
--

CREATE TABLE `paywith_tbl` (
  `id` int(11) NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `enterprise_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `paywith_tbl`
--

INSERT INTO `paywith_tbl` (`id`, `logo`, `status`, `enterprise_id`, `created_by`, `created_date`) VALUES
(33, 'assets/uploads/paywith/2022-03-08/4202f62c20e32186e48bb9bd81caa4ac.png', 1, '1', '1', '2022-03-08 16:11:38'),
(34, 'assets/uploads/paywith/2022-03-08/e77506933bbbf39c9f801a0735c307de.png', 1, '1', '1', '2022-03-08 16:11:55'),
(35, 'assets/uploads/paywith/2022-03-08/d4bc18884cd2275a6b8e4bae2415eddd.png', 1, '1', '1', '2022-03-08 16:11:59'),
(36, 'assets/uploads/paywith/2022-03-08/fbb601f269dc4b56b0551e1358931889.png', 1, '1', '1', '2022-03-08 16:12:04'),
(37, 'assets/uploads/paywith/2022-03-08/98659aee2658d5422ef6a49a5a9d7079.png', 1, '1', '1', '2022-03-08 16:12:09'),
(38, 'assets/uploads/paywith/2022-03-08/4f29d19000c29b6a2d764148567d5d56.png', 1, '1', '1', '2022-03-08 16:12:15'),
(39, 'assets/uploads/paywith/2022-03-08/4ace84ca71d9b5caf1116efe208d51fc.png', 1, '1', '1', '2022-03-08 16:12:18'),
(40, 'assets/uploads/paywith/2022-03-08/ae830367310b54da66613c0486ea62de.png', 1, '1', '1', '2022-03-08 16:13:12'),
(41, 'assets/uploads/paywith/2022-03-08/ed2624f746b64ccb5ef8b91887973760.png', 1, '1', '1', '2022-03-08 16:13:16'),
(42, 'assets/uploads/paywith/2022-03-08/fa88e463dadd69ff8c252a22a60ddc62.png', 1, '1', '1', '2022-03-08 16:13:21'),
(43, 'assets/uploads/paywith/2022-03-08/54330eabec3e06fa0c3404a2ccbfc919.png', 1, '1', '1', '2022-03-08 16:13:29'),
(44, 'assets/uploads/paywith/2022-03-08/b3e2612ef1258954809761869acb1319.png', 1, '1', '1', '2022-03-08 16:13:32'),
(45, 'assets/uploads/paywith/2022-03-08/ee319ec322dd3a652247b3f3a0fda070.png', 1, '1', '1', '2022-03-08 16:13:35'),
(46, 'assets/uploads/paywith/2022-03-08/39b10776a247780332febdc50cb591fa.png', 1, '1', '1', '2022-03-08 16:13:39'),
(47, 'assets/uploads/paywith/2022-03-08/31bf2b4ce063e99c77af23c967fd9180.png', 1, '1', '1', '2022-03-08 16:13:43'),
(48, 'assets/uploads/paywith/2022-03-08/61a66cc509414f5e4a062589c1db84a4.png', 1, '1', '1', '2022-03-08 16:13:46'),
(49, 'assets/uploads/paywith/2022-03-08/01ec4d80cc7d93bbd1a8a736112997dc.png', 1, '1', '1', '2022-03-08 16:13:49'),
(50, 'assets/uploads/paywith/2022-03-08/642abc6c2afacf6b14c355cef9af7ac9.png', 1, '1', '1', '2022-03-08 16:13:53'),
(51, 'assets/uploads/paywith/2022-03-08/9ffa90ef9d656941de6b432117196266.png', 1, '1', '1', '2022-03-08 16:13:57'),
(52, 'assets/uploads/paywith/2022-03-08/d945e8af79c2f996f2181a585a0ff208.png', 1, '1', '1', '2022-03-08 16:14:00'),
(53, 'assets/uploads/paywith/2022-03-08/aa5fd4485e7c79c037dc4b9eb70db4f7.png', 1, '1', '1', '2022-03-08 16:14:05'),
(54, 'assets/uploads/paywith/2022-03-08/b327839211545286b70ef32282395fd7.png', 1, '1', '1', '2022-03-08 16:14:08'),
(55, 'assets/uploads/paywith/2022-03-08/6c51f0ca369104a695b8625e7c575716.png', 1, '1', '1', '2022-03-08 16:14:12'),
(56, 'assets/uploads/paywith/2022-03-08/d7d7887c7fd693a6eadad50ac2891804.png', 1, '1', '1', '2022-03-08 16:14:17'),
(57, 'assets/uploads/paywith/2022-03-08/cbff4361d72559a906eae9cd0aa88975.png', 1, '1', '1', '2022-03-08 16:14:20'),
(58, 'assets/uploads/paywith/2022-03-08/b96d58453b7fb151827703e3fe91c1a6.png', 1, '1', '1', '2022-03-08 16:14:23'),
(59, 'assets/uploads/paywith/2022-03-08/f95cf153fc24e078d58274b6c3784a10.png', 1, '1', '1', '2022-03-08 16:14:26'),
(60, 'assets/uploads/paywith/2022-03-08/21e9aa4ae7b63a6f1df7b13f2e26e523.png', 1, '1', '1', '2022-03-08 16:14:30'),
(61, 'assets/uploads/paywith/2022-03-08/15dfd30ca61169064173546a0f792850.png', 1, '1', '1', '2022-03-08 16:14:34'),
(62, 'assets/uploads/paywith/2022-03-08/1dbf20776805ca589a3f8d8e90b79dbd.png', 1, '1', '1', '2022-03-08 16:14:38'),
(63, 'assets/uploads/paywith/2022-03-08/20c1aa2c2d5fc2939785dd0aaabec2c5.png', 1, '1', '1', '2022-03-08 16:14:42');

-- --------------------------------------------------------

--
-- Table structure for table `picture_tbl`
--

CREATE TABLE `picture_tbl` (
  `id` int(11) NOT NULL,
  `from_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `picture_tbl`
--

INSERT INTO `picture_tbl` (`id`, `from_id`, `picture`, `filename`, `picture_type`, `created_by`, `created_date`, `updated_by`, `updated_date`, `status`) VALUES
(544, 'F27BEQFJ5', 'assets/uploads/faculty/2022-04-27/9bc910986f5eefe2031865917c86c6a4.jpg', NULL, 'faculty', '1', '2022-04-27 16:36:26', '', NULL, 1),
(545, 'ST2793YBB6', 'assets/uploads/students/2022-04-27/f0c036ea7bd9b541becaa3dc15003808.jpg', NULL, 'Student Profile', '1', '2022-04-27 16:41:01', '1', '2022-04-27 16:41:01', 1),
(546, 'C27MXHPF', 'assets/uploads/categories/2022-04-27/2e12236b80dcfac3b43381a15fa1b420.jpg', NULL, 'categories', '1', '2022-04-27 16:43:37', '', NULL, 1),
(547, 'C27E975C', 'assets/uploads/categories/2022-04-27/196e0126f61e3490941659514b0c9cfe.png', NULL, 'categories', '1', '2022-04-27 16:44:05', '', NULL, 1),
(548, 'CO27V632V', 'assets/uploads/course/2022-04-27/e2da837e19bc7076835b72490f1fe39e.jpg', 'R.jpg', 'course', '1', '2022-04-27 16:52:39', '', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policy_tbl`
--

CREATE TABLE `privacy_policy_tbl` (
  `id` int(11) NOT NULL,
  `privacy_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proficiency_tbl`
--

CREATE TABLE `proficiency_tbl` (
  `id` int(11) NOT NULL,
  `proficiency_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_assingment`
--

CREATE TABLE `project_assingment` (
  `id` int(11) NOT NULL,
  `assignment_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `course_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chapter_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `category` int(11) DEFAULT NULL COMMENT '1=chapter project and 2=final project',
  `pass_score` float DEFAULT NULL,
  `project_mark` float DEFAULT NULL,
  `tips` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `project_reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `project_order` int(11) DEFAULT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `create_by` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_details_tbl`
--

CREATE TABLE `project_details_tbl` (
  `id` int(11) NOT NULL,
  `project_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '1=text, 2=image and 3=video',
  `content_sl` int(11) NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_mark_details`
--

CREATE TABLE `project_mark_details` (
  `id` int(11) NOT NULL,
  `assignment_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `markes_title` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `marks` float DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_tbl`
--

CREATE TABLE `project_tbl` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `assignment_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '1=course project,\r\n2=personal project and\r\n4=client project',
  `publishdate` date DEFAULT NULL,
  `skills` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `software_used` text COLLATE utf8_unicode_ci NOT NULL,
  `tags` text COLLATE utf8_unicode_ci NOT NULL,
  `is_visibility` int(11) NOT NULL COMMENT '1=show and 0=hide',
  `course_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `section_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lesson_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `getfeatured` int(11) NOT NULL COMMENT '1=yes and 0=no',
  `type` int(11) NOT NULL COMMENT '1=student and 2=instructor',
  `chapter_source` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lesson_source` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `submit_status` int(11) NOT NULL COMMENT '0=not submit and 1= submit',
  `publish_status` int(11) NOT NULL COMMENT '0=not publish and 1=publish',
  `project_status` int(11) NOT NULL COMMENT '0=project in review,\r\n1=Project approved and\r\n2=Project not approved',
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `coverpic` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coursetype` int(11) DEFAULT NULL COMMENT '1=chapter project and 2=final project',
  `client_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clientproject_year` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clientwebsite_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `project_topic` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `personal_projectyear` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `personal_websiteurl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `viewcount` int(11) DEFAULT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pusherconfig_tbl`
--

CREATE TABLE `pusherconfig_tbl` (
  `id` int(11) NOT NULL,
  `api_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `api_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secret_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cluster` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_exam_tbl`
--

CREATE TABLE `question_exam_tbl` (
  `id` int(11) NOT NULL,
  `questionexam_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `student_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `course_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `exam_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_question` int(11) NOT NULL,
  `total_answered` int(11) NOT NULL,
  `mcq_answered` int(11) NOT NULL,
  `shortqst_answered` int(11) NOT NULL,
  `marks` decimal(10,2) NOT NULL,
  `exam_set` longtext COLLATE utf8_unicode_ci NOT NULL,
  `correctans_count` int(11) NOT NULL,
  `questionmarks` longtext COLLATE utf8_unicode_ci NOT NULL,
  `totalmark` decimal(10,2) NOT NULL,
  `is_done` int(11) NOT NULL COMMENT '1=done and 0 = Not Done',
  `examstarttime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `examendtime` timestamp NULL DEFAULT NULL,
  `is_result` int(11) NOT NULL COMMENT '1=complete and 0=incomplete',
  `is_published` int(11) NOT NULL COMMENT '1=published and 0=unpublished',
  `status` int(11) NOT NULL DEFAULT 1,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_option_tbl`
--

CREATE TABLE `question_option_tbl` (
  `id` int(11) NOT NULL,
  `option_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `question_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `option_type` int(11) NOT NULL COMMENT '1=text and 2 = image',
  `option_name` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_answer` int(11) DEFAULT NULL COMMENT '1=yes and 0=no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_tbl`
--

CREATE TABLE `question_tbl` (
  `id` int(11) NOT NULL,
  `question_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `exam_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `question_type` int(11) NOT NULL COMMENT '1=radio, 2=checkbox and 3=short question',
  `question_mark` int(11) NOT NULL,
  `shortanswer` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `correct_ans_explanation` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rating_tbl`
--

CREATE TABLE `rating_tbl` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `course_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rating` float NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refund_policy_tbl`
--

CREATE TABLE `refund_policy_tbl` (
  `id` int(11) NOT NULL,
  `refund_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `refund_policy_tbl`
--

INSERT INTO `refund_policy_tbl` (`id`, `refund_id`, `title`, `description`, `enterprise_id`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'RP19SMX', 'THE LEAD ACADEMY PRIVACY NOTICE', '<p>Thank You for joining LEAD ACADEMY.<br>\nThis page informs you of our policies regarding the collection, use, and disclosure of Personal Information<br>\nwe receive from users of the Site. The Privacy Policy is prepared to explain how your personal information<br>\nis used as part of the EdTech Program and explain your legal rights.<br>\nWe use your Personal Information only for providing and improving the Site. By using the Site, you agree<br>\nto the collection and use of information following this policy.</p>\n\n<p><br>\n<strong>Information Collection and Use</strong><br>\nWhile using our Site, we may ask you to provide us with certain personally identifiable information that<br>\nwe may use to contact or identify you. The identifiable information may include but is not limited to your<br>\nname (\"Personal Information, \"Address, \"Email ID\").<br>\nCookies<br>\nCookies are files with a small amount of data, which may include an anonymous and unique identifier.<br>\nLike many sites, we use \"cookies\" to collect information. These are sent to your browser from our website<br>\nand stored on your computer&#39;s hard drive. You can instruct your browser to refuse all cookies or to notify<br>\nwhen a cookie is permitted. However, if you do not accept cookies, you may not access some portions of<br>\nour Site.</p>\n\n<p><br>\n<strong>Communication</strong><br>\nWe may use your Personal Information to contact you with newsletters, marketing or promotional<br>\nmaterials, and other information that promotes and are related to our business.<br>\nLog Data<br>\nLike many site operators, we collect information that your browser sends whenever you visit our Site. This<br>\nLog Data may include information such as the computer&#39;s Internet Protocol or IP address, browser type,<br>\nand browser version. Including the pages of our Site you visit, the time and date of your visit, the time<br>\nspent on those pages, and other statistics. In addition, we may use third-party services such as Google<br>\nAnalytics that collect, monitor, and analyze this data.</p>\n\n<p><br>\n<strong>Collection of Information by Third-Party Sites</strong></p>\n\n<p><br>\nWe may provide links to sites operated by organizations other than Lead Academy that we believe may<br>\nbe of interest to you. We do not disclose your Data to these Third-Party Sites unless we have a lawful basis on which to do so. We do not endorse and are not responsible for the privacy practices of these Third-<br>\nParty Sites. If you choose to click on a link to one of these Third-Party Sites, you should review the privacy policy posted on the other site to understand how that Third Party Site collects and uses your Personal<br>\nData.</p>\n\n<p><br>\n<strong>Security</strong></p>\n\n<p><br>\nThe security of your Personal Information is important to us. It is important to note that no method of<br>\ntransmission over the Internet or method of electronic storage can guarantee absolute security. While we<br>\nstrive to use the best commercially acceptable means to protect your Personal Information, we cannot<br>\nguarantee its absolute security.</p>\n\n<p><strong>Children Information Security</strong></p>\n\n<p><br>\nFor child-directed products, parental consent is required before the collection or use of any information.<br>\nFor example, a service that teaches STEM activity practices would be a child-directed product.</p>\n\n<p><br>\n<strong>Changes to the Privacy Policy</strong></p>\n\n<p><br>\nThis Privacy Policy is effective as of (date) and will remain effective except concerning any changes in its<br>\nprovisions in the future. Those will be in effect immediately after being posted on this page. We reserve<br>\nthe right to update or change our Privacy Policy at any time, and to learn about the changes, please check<br>\nthe Privacy Policy periodically. Your continuing use of the Service after we post any modifications to the<br>\nPrivacy Policy on this page will constitute your acknowledgment of the modifications and your consent to<br>\nabide by the modified Privacy Policy. If we make any material changes to this Privacy Policy, we will notify<br>\nyou through your email address. Or we will place a prominent notice on our website.</p>\n', '1', '1', '2022-03-19 10:05:16', '1', '2022-03-19 16:05:16');

-- --------------------------------------------------------

--
-- Table structure for table `section_tbl`
--

CREATE TABLE `section_tbl` (
  `id` int(11) NOT NULL,
  `section_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `section_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `course_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `section_tbl`
--

INSERT INTO `section_tbl` (`id`, `section_id`, `section_name`, `course_id`, `enterprise_id`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(119, 'SE23RIMVP', 'New Section', 'CO23RJZNN', '1', '1', '2022-04-23 17:01:11', '', NULL),
(120, 'SE251STKI', 'New Section', 'CO25GXPP9', '1', '1', '2022-04-25 18:08:03', '', NULL),
(121, 'SE26X75Q9', 'New Section', 'CO26ADET8', '1', '1', '2022-04-26 19:24:07', '', NULL),
(122, 'SE27YFYJS', 'New Section', 'CO27V632V', '1', '1', '2022-04-27 16:52:49', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sec_menu_item`
--

CREATE TABLE `sec_menu_item` (
  `menu_id` int(11) NOT NULL,
  `menu_title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page_url` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `module` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ordering` int(11) NOT NULL,
  `parent_menu` int(11) DEFAULT NULL,
  `icon` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_settings` int(11) NOT NULL DEFAULT 0 COMMENT '1=yes and 0=no',
  `is_homesetting` int(11) NOT NULL COMMENT '1=yes and 0=no',
  `is_role` int(11) NOT NULL DEFAULT 0 COMMENT '1=yes and 0=no',
  `is_report` tinyint(1) DEFAULT NULL,
  `is_frontend` int(11) NOT NULL DEFAULT 0 COMMENT '1=active and 0=inactive',
  `status` int(11) NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `createby` int(11) NOT NULL,
  `createdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sec_menu_item`
--

INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `ordering`, `parent_menu`, `icon`, `is_settings`, `is_homesetting`, `is_role`, `is_report`, `is_frontend`, `status`, `enterprise_id`, `createby`, `createdate`) VALUES
(7, 'categories', '', 'categories', 0, 0, 'hvr-buzz-out fa fa-microchip', 0, 0, 1, 0, 0, 1, '1', 1, '2019-11-30 00:00:00'),
(8, 'course', 'course', 'course', 3, 0, 'glyphicon glyphicon-book', 0, 0, 0, 0, 0, 1, '1', 1, '2019-11-30 00:00:00'),
(9, 'add_course', 'add-course', 'course', 1, 8, '', 0, 0, 0, 0, 0, 1, '1', 1, '2019-11-30 00:00:00'),
(11, 'course_list', 'course-list', 'course', 3, 8, '', 0, 0, 0, 0, 0, 1, '1', 1, '2019-12-22 00:00:00'),
(12, 'students', '', 'students', 4, 0, 'hvr-buzz-out fa fa-user-circle', 0, 0, 0, 0, 0, 1, '1', 1, '2019-12-22 00:00:00'),
(13, 'add_student', 'add-student', 'students', 0, 12, '', 0, 0, 0, 0, 0, 0, '1', 1, '2019-12-22 00:00:00'),
(14, 'student_list', 'student-list', 'students', 0, 12, '', 0, 0, 0, 0, 0, 1, '1', 1, '2019-12-22 00:00:00'),
(15, 'faculty_revenue', 'faculty-revenue', 'course', 4, 8, '', 0, 0, 0, 0, 0, 0, '1', 1, '2020-01-02 00:00:00'),
(17, 'purchased_course_list', 'purchased-course-list', 'course', 5, 8, '', 0, 0, 0, 0, 0, 1, '1', 1, '2020-02-04 00:00:00'),
(18, 'faculty_commission', 'faculty-commission', 'course', 0, 8, '', 0, 0, 0, 0, 0, 0, '1', 1, '2020-02-05 00:00:00'),
(19, 'instructor', '', 'instructor', 5, 0, 'hvr-buzz-out fa fa-users mr-2', 0, 0, 1, 0, 0, 1, '1', 1, '2020-02-16 00:00:00'),
(20, 'commission_list', 'commission-list', 'course', 6, 8, '', 0, 0, 0, 0, 0, 0, '1', 1, '2020-02-17 00:00:00'),
(21, 'admin_revenue', 'admin-revenue', 'course', 7, 8, '', 0, 0, 0, 0, 0, 0, '1', 1, '2020-02-17 00:00:00'),
(22, 'faculty_sales_course', 'faculty-sales-course', 'course', 8, 8, '', 0, 0, 0, 0, 0, 0, '1', 1, '2020-02-17 00:00:00'),
(23, 'add_instructor', 'add-faculty', 'instructor', 0, 19, '', 0, 0, 1, 0, 0, 1, '1', 1, '2020-02-17 00:00:00'),
(24, 'instructor_list', 'faculty-list', 'instructor', 0, 19, '', 0, 0, 1, 0, 0, 1, '1', 1, '2020-02-17 00:00:00'),
(25, 'forums', '', 'forums', 6, 0, 'fab fa-forumbee', 0, 0, 1, 0, 0, 1, '1', 1, '2020-02-17 00:00:00'),
(26, 'forum_category', 'forum-category', 'forums', 0, 25, '', 0, 0, 1, 0, 0, 1, '1', 1, '2020-02-17 00:00:00'),
(27, 'add_forum', 'add-forum', 'forums', 0, 25, '', 0, 0, 1, 0, 0, 1, '1', 1, '2020-02-17 00:00:00'),
(28, 'forum_list', 'forum-list', 'forums', 0, 25, '', 0, 0, 1, 0, 0, 1, '1', 1, '2020-02-17 00:00:00'),
(29, 'comment_list', 'comment-list', 'forums', 0, 25, '', 0, 0, 1, 0, 0, 0, '1', 1, '2020-02-17 00:00:00'),
(30, 'settings', 'settings', 'settings', 7, 0, 'glyphicon glyphicon-cog', 0, 0, 0, 0, 0, 1, '1', 1, '2020-02-17 00:00:00'),
(31, 'add_ons', 'add-ons', 'add_ons', 8, 0, 'fab fa-adn', 0, 0, 0, 0, 0, 0, '1', 1, '2021-04-05 18:28:38'),
(35, 'frontend', '', 'frontend', 1, 0, '', 0, 0, 1, 0, 1, 1, '1', 1, '2021-04-10 18:54:07'),
(36, 'my_course', 'my-course', 'frontend', 2, 94, '', 0, 0, 1, 0, 1, 1, '1', 1, '2021-04-10 18:54:07'),
(37, 'quiz_test', 'quiz-test-form', 'frontend', 3, 94, '', 0, 0, 1, 0, 1, 1, '1', 1, '2021-04-10 18:54:07'),
(38, 'quiz_result', 'quiz-result', 'frontend', 4, 94, '', 0, 0, 1, 0, 1, 1, '1', 1, '2021-04-10 18:54:07'),
(39, 'wishlist', 'enroll-course', 'frontend', 5, 94, '', 0, 0, 1, 0, 1, 1, '1', 1, '2021-04-10 18:54:07'),
(41, 'photo', 'change-student-picture', 'frontend', 7, 94, '', 0, 0, 1, 0, 1, 1, '1', 1, '2021-04-10 18:54:07'),
(42, 'payment_info', 'student-payment-info', 'frontend', 8, 94, '', 0, 0, 1, 0, 1, 1, '1', 1, '2021-04-10 18:54:07'),
(43, 'change_password', 'student-change-password', 'frontend', 9, 94, '', 0, 0, 1, 0, 1, 1, '1', 1, '2021-04-10 18:54:07'),
(51, 'events_or_live', '', 'events_or_live', 0, 0, 'hvr-buzz-out fa fa-podcast', 0, 0, 1, 0, 0, 1, '1', 1, '2021-04-10 17:26:55'),
(52, 'join_zoom_meeting', 'join-zoom-meeting', 'frontend', 6, 94, '', 0, 0, 1, 0, 1, 1, '1', 1, '2021-04-10 18:54:07'),
(53, 'add_live_course', 'add-live-course', 'course', 2, 8, '', 0, 0, 0, 0, 0, 0, '1', 1, '2021-04-12 17:31:46'),
(54, 'enterprise', NULL, 'enterprise', 1, 0, 'glyphicon glyphicon-book mr-2', 0, 0, 0, 0, 0, 1, '1', 1, '2021-06-05 13:32:05'),
(55, 'add_enterprise', 'add-enterprise', 'enterprise', 1, 54, '', 0, 0, 0, 0, 0, 1, '1', 1, '2021-06-05 13:34:00'),
(56, 'enterprise_list', 'enterprise-list', 'enterprise', 2, 54, '', 0, 0, 0, 0, 0, 1, '1', 1, '2021-06-05 11:42:44'),
(57, 'add_user', 'get_adduser', 'settings', 1, 30, '', 1, 0, 0, 0, 0, 1, '1', 1, '2021-06-08 17:35:13'),
(58, 'user_list', 'getuserlist', 'settings', 2, 30, '', 1, 0, 0, 0, 0, 1, '1', 1, '2021-06-08 15:36:40'),
(59, 'menu_setup', 'getmenuform', 'settings', 3, 30, '', 1, 0, 0, 0, 0, 1, '1', 1, '2021-06-08 15:59:43'),
(60, 'menusetup_list', 'getmenulist', 'settings', 4, 30, '', 1, 0, 1, 0, 0, 1, '1', 1, '2021-06-08 00:00:00'),
(62, 'role_permission', 'getrolepermission_form', 'settings', 5, 30, '', 1, 0, 1, 0, 0, 1, '1', 1, '2021-06-08 00:00:00'),
(63, 'role_list', 'getrolepermission_list', 'settings', 6, 30, '', 1, 0, 1, 0, 0, 1, '1', 1, '2021-06-08 00:00:00'),
(64, 'assign_user_role', 'getassignuserrole', 'settings', 7, 30, '', 1, 0, 1, 0, 0, 1, '1', 1, '2021-06-08 00:00:00'),
(65, 'assign_user_role_list', 'getassignuserrolelist', 'settings', 8, 30, '', 1, 0, 1, 0, 0, 1, '1', 1, '2021-06-08 00:00:00'),
(66, 'add_language', 'getlanguage', 'settings', 9, 30, '', 1, 0, 1, 0, 0, 1, '1', 1, '2021-06-08 00:00:00'),
(67, 'add_phrase', 'getphrase', 'settings', 10, 30, '', 1, 0, 1, 0, 0, 1, '1', 1, '2021-06-08 00:00:00'),
(68, 'mail_config', 'getmailconfig', 'settings', 11, 30, '', 1, 0, 1, 0, 0, 1, '1', 1, '2021-06-08 00:00:00'),
(69, 'sms_config', 'getsmsconfig', 'settings', 12, 30, '', 1, 0, 1, 0, 0, 1, '1', 1, '2021-06-08 00:00:00'),
(70, 'payment_method_list', 'getpaymentmethodlist', 'settings', 13, 30, '', 1, 0, 1, 0, 0, 1, '1', 1, '2021-06-08 00:00:00'),
(71, 'paypal_config', 'getpaypalconfig', 'settings', 14, 30, '', 1, 0, 1, 0, 0, 0, '1', 1, '2021-06-08 00:00:00'),
(72, 'stripe_config', 'getstripeconfig', 'settings', 15, 30, '', 1, 0, 1, 0, 0, 0, '1', 1, '2021-06-08 00:00:00'),
(73, 'payeer_config', 'getpayeerconfig', 'settings', 16, 30, '', 1, 0, 1, 0, 0, 0, '1', 1, '2021-06-08 00:00:00'),
(74, 'payu_config', 'getpayuconfig', 'settings', 17, 30, '', 1, 0, 1, 0, 0, 0, '1', 1, '2021-06-08 00:00:00'),
(75, 'pusher_config', 'getpusherconfig', 'settings', 18, 30, '', 1, 0, 1, 0, 0, 1, '1', 1, '2021-06-09 00:00:00'),
(76, 'home_page_setting', 'home-page-setting', 'home_page_setting', 0, 0, 'hvr-buzz-out fa fa-adjust', 0, 0, 1, 0, 0, 1, '1', 1, '2021-06-09 00:00:00'),
(77, 'newsletter', 'getsubscriberlist', 'home_page_setting', 6, 76, '', 0, 1, 1, 0, 0, 1, '1', 1, '2021-06-09 00:00:00'),
(78, 'team_members', 'getteammembers', 'settings', 21, 30, '', 1, 0, 1, 0, 0, 1, '1', 1, '2021-06-09 00:00:00'),
(79, 'about_us', 'getaboutus', 'settings', 22, 30, '', 1, 0, 1, 0, 0, 0, '1', 1, '2021-06-09 00:00:00'),
(80, 'privacy_policy', 'getprivacypolicy', 'settings', 23, 30, '', 1, 0, 1, 0, 0, 1, '1', 1, '2021-06-09 00:00:00'),
(81, 'terms_condition', 'gettermscondition', 'settings', 24, 30, '', 1, 0, 1, 0, 0, 1, '1', 1, '2021-06-09 00:00:00'),
(82, 'sliders', 'getslider', 'home_page_setting', 4, 76, '', 0, 1, 1, 0, 0, 1, '1', 1, '2021-06-09 00:00:00'),
(83, 'currency', 'getcurrency', 'settings', 26, 30, '', 1, 0, 1, 0, 0, 1, '1', 1, '2021-06-09 00:00:00'),
(84, 'application_setting', 'getappsetting', 'settings', 28, 30, '', 1, 0, 1, 0, 0, 1, '1', 1, '2021-06-09 00:00:00'),
(85, 'subscription_list', 'subscription-list', 'course', 9, 8, '', 0, 0, 1, 0, 0, 1, '1', 1, '2021-06-13 00:00:00'),
(86, 'template', 'gettemplateinfo', 'settings', 21, 30, '', 1, 0, 1, 0, 0, 1, '1', 1, '2021-06-13 00:00:00'),
(87, 'data_synchronizer', 'data_synchronizer', 'data_synchronizer', 11, 0, 'glyphicon glyphicon-tag', 0, 0, 0, 0, 0, 1, '1', 1, '0000-00-00 00:00:00'),
(88, 'restore', 'restore', 'data_synchronizer', 1, 87, '', 0, 0, 0, 0, 0, 1, '1', 1, '0000-00-00 00:00:00'),
(89, 'db_import', 'db_import', 'data_synchronizer', 2, 87, '', 0, 0, 0, 0, 0, 1, '1', 1, '0000-00-00 00:00:00'),
(90, 'backup', 'backup', 'data_synchronizer', 2, 87, '', 0, 0, 1, 0, 0, 1, '1', 1, '0000-00-00 00:00:00'),
(91, 'certificate', '', 'certificate', 0, 0, 'hvr-buzz-out fa fa-certificate', 0, 0, 1, 0, 0, 1, '1', 1, '2021-06-14 00:00:00'),
(92, 'add_exam', 'add-exam', 'course', 4, 8, '', 0, 0, 1, 0, 0, 0, '1', 1, '2021-06-16 00:00:00'),
(93, 'library_content_list', 'library-content-list', 'course', 3, 8, '', 0, 0, 1, NULL, 0, 0, '1', 1, '2021-06-21 08:35:18'),
(94, 'profile', 'student-dashboard', 'frontend', 7, 35, '', 0, 0, 1, 0, 1, 1, '1', 1, '2021-07-04 00:00:00'),
(95, 'quiz_list', 'exam-list', 'course', 4, 8, '', 0, 0, 1, 0, 0, 0, '1', 1, '2021-07-05 00:00:00'),
(96, 'archives', '', 'archives', 0, 0, 'fas fa-archive', 0, 0, 1, 0, 0, 1, '1', 1, '2021-07-06 00:00:00'),
(97, 'category_archives', 'category-archives', 'archives', 1, 96, '', 0, 0, 1, 0, 0, 1, '1', 1, '2021-07-06 00:00:00'),
(98, 'course_archives', 'course-archive', 'archives', 2, 96, '', 0, 0, 1, 0, 0, 1, '1', 1, '2021-07-06 00:00:00'),
(99, 'exam_archives', 'exam-archives', 'archives', 3, 96, '', 0, 0, 1, 0, 0, 1, '1', 1, '2021-07-06 00:00:00'),
(100, 'coupon', '', 'coupon', 0, 0, 'hvr-buzz-out fa fa-bomb', 0, 0, 1, 0, 0, 1, '1', 1, '2021-07-06 00:00:00'),
(101, 'add_coupon', 'add-coupon', 'coupon', 1, 100, '', 0, 0, 1, 0, 0, 1, '1', 1, '2021-07-06 00:00:00'),
(102, 'coupon_list', 'coupon-list', 'coupon', 2, 100, '', 0, 0, 1, 0, 0, 1, '1', 1, '2021-07-06 00:00:00'),
(103, 'activities_log', 'activitieslog', 'settings', 27, 30, '', 1, 0, 1, 0, 0, 1, '1', 1, '2021-07-10 00:00:00'),
(104, 'testimonials', 'testimonials', 'testimonials', 8, 0, 'hvr-buzz-out fa fa-thermometer', 0, 0, 1, NULL, 0, 1, '1', 1, '2021-06-21 08:35:18'),
(105, 'testimonials_list', 'testimonials-list', 'testimonials', 2, 104, '', 0, 0, 1, NULL, 0, 1, '1', 1, '2021-06-21 08:35:18'),
(106, 'add_testimonial', 'add-testimonial', 'testimonials', 1, 104, '', 0, 0, 1, NULL, 0, 1, '1', 1, '2021-06-21 08:35:18'),
(112, 'getfeaturedin', 'getfeaturedin', 'home_page_setting', 2, 76, '', 0, 1, 1, 0, 0, 1, '1', 1, '2021-06-21 08:35:18'),
(113, 'site_faq', 'faq', 'site_faq', 8, 0, 'hvr-buzz-out fa fa-podcast', 0, 0, 1, 0, 0, 1, '1', 1, '2021-07-28 00:00:00'),
(114, 'professional_proficiency', 'get_proficiency', 'settings', 21, 30, '', 1, 0, 1, 0, 0, 1, '1', 1, '2021-08-16 00:00:00'),
(115, 'add_event', 'add-event', 'events_or_live', 1, 51, '', 0, 0, 1, 0, 0, 1, '1', 1, '2021-09-05 00:00:00'),
(116, 'zoom_meeting', 'zoom-meeting', 'events_or_live', 3, 51, '', 0, 0, 1, 0, 0, 1, '1', 1, '2021-09-28 00:00:00'),
(117, 'event_list', 'event-list', 'events_or_live', 2, 51, '', 0, 0, 1, 0, 0, 1, '1', 1, '2021-09-28 00:00:00'),
(118, 'assign_certificate', 'assign-certificate', 'certificate', 3, 91, '', 0, 0, 1, 0, 0, 1, '1', 1, '2021-09-29 00:00:00'),
(119, 'add_certificate', 'add-certificate', 'certificate', 1, 91, '', 0, 0, 1, 0, 0, 0, '1', 1, '2021-09-29 00:00:00'),
(120, 'certificate_list', 'certificate-list', 'certificate', 2, 91, '', 0, 0, 1, 0, 0, 1, '1', 1, '2021-09-29 00:00:00'),
(121, 'certificate_archives', 'certificate-archives', 'certificate', 4, 91, '', 0, 0, 1, 0, 0, 1, '1', 1, '2021-09-29 00:00:00'),
(122, 'subscription_pricing', 'subscription-pricing', 'course', 9, 8, '', 0, 0, 1, 0, 0, 1, '1', 1, '2021-10-05 00:00:00'),
(123, 'communication', '', 'communication', 0, 0, 'hvr-buzz-out fa fa-industry mr-2', 0, 0, 1, 0, 0, 1, '1', 1, '2021-10-11 00:00:00'),
(124, 'notice_board', 'notice-board', 'communication', 1, 123, '', 0, 0, 1, 0, 0, 0, '1', 1, '2021-10-11 00:00:00'),
(125, 'send_email', 'send-emailform', 'communication', 1, 123, '', 0, 0, 1, 0, 0, 1, '1', 1, '2021-10-11 00:00:00'),
(126, 'send_sms', 'send-smsform', 'communication', 3, 123, '', 0, 0, 1, 0, 0, 1, '1', 1, '2021-10-11 00:00:00'),
(127, 'social_auth', '', 'social_auth', 0, 0, 'hvr-buzz-out fa fa-credit-card', 0, 0, 1, 0, 0, 1, '1', 1, '2021-10-14 00:00:00'),
(128, 'google_login_config', 'google-login-config', 'social_auth', 1, 127, '', 0, 0, 1, 0, 0, 1, '1', 1, '2021-10-14 00:00:00'),
(129, 'facebook_login_config', 'facebook-login-config', 'social_auth', 2, 127, '', 0, 0, 1, 0, 0, 1, '1', 1, '2021-10-14 00:00:00'),
(130, 'course_faq', 'course-faq', 'course', 8, 8, '', 0, 0, 1, 0, 0, 1, '1', 1, '2021-10-19 00:00:00'),
(131, 'email_list', 'email-list', 'communication', 2, 123, '', 0, 0, 1, 0, 0, 1, '1', 1, '2021-10-21 00:00:00'),
(132, 'category', 'category', 'categories', 1, 7, '', 0, 0, 1, 0, 0, 1, '1', 1, '2021-10-26 00:00:00'),
(133, 'subcategory', 'subcategory', 'categories', 2, 7, '', 0, 0, 1, 0, 0, 1, '1', 1, '2021-10-26 00:00:00'),
(134, 'vimeo_config', 'vimeo-config', 'social_auth', 3, 127, '', 0, 0, 1, 0, 0, 1, '1', 1, '2021-10-30 00:00:00'),
(135, 'instructor_reports', 'instructor-report', 'instructor', 3, 19, '', 0, 0, 1, 0, 0, 1, '1', 1, '2021-11-04 00:00:00'),
(136, 'collaborate', 'getcompanies', 'home_page_setting', 3, 76, '', 0, 1, 1, 0, 0, 1, '1', 1, '2021-11-14 00:00:00'),
(137, 'our_features', 'our-features', 'home_page_setting', 1, 76, '', 0, 1, 1, 0, 0, 1, '1', 1, '2021-11-14 00:00:00'),
(138, 'website_settngs', 'website_settingform', 'home_page_setting', 10, 76, '', 0, 1, 1, 0, 0, 1, '1', 1, '2021-11-18 00:00:00'),
(139, 'strength_number', 'strength_number', 'home_page_setting', 5, 76, '', 0, 1, 1, 0, 0, 1, '1', 1, '2021-11-20 00:00:00'),
(140, 'need_consultation', 'need_consultation', 'home_page_setting', 7, 76, '', 0, 1, 1, 0, 0, 1, '1', 1, '2021-11-28 00:00:00'),
(141, 'sms_list', 'sms-list', 'communication', 4, 123, '', 0, 0, 1, 0, 0, 1, '1', 1, '2021-12-28 00:00:00'),
(142, 'aboutus', 'aboutus', 'aboutus', 0, 0, 'hvr-buzz-out fa fa-tablet', 0, 0, 1, 0, 0, 1, '1', 1, '2022-01-13 00:00:00'),
(143, 'paywith', 'paywith', 'home_page_setting', 8, 76, '', 0, 1, 1, 0, 0, 1, '1', 1, '2022-01-20 00:00:00'),
(144, 'refund_policy', 'get_refundpolicy', 'settings', 24, 30, '', 1, 0, 1, 0, 0, 1, '1', 1, '2022-01-25 00:00:00'),
(145, 'reports', 'reports', 'reports', 0, 0, 'hvr-buzz-out fa fa-window-restore', 0, 0, 1, 0, 0, 1, '1', 1, '2022-02-14 00:00:00'),
(146, 'watchtime_list', 'watchtime-list', 'reports', 1, 145, '', 0, 0, 1, 0, 0, 1, '1', 1, '2022-02-14 00:00:00'),
(147, 'payment_disbursement', 'payment-disbursement', 'reports', 2, 145, '', 0, 0, 1, 0, 0, 1, '1', 1, '2022-03-02 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sec_role_permission`
--

CREATE TABLE `sec_role_permission` (
  `id` bigint(20) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `can_access` tinyint(1) NOT NULL,
  `can_create` tinyint(1) NOT NULL,
  `can_edit` tinyint(1) NOT NULL,
  `can_delete` tinyint(1) NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `createby` int(11) NOT NULL,
  `createdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sec_role_permission`
--

INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `enterprise_id`, `createby`, `createdate`) VALUES
(284, 7, 7, 1, 1, 1, 1, '', 0, '2020-03-11 11:24:16'),
(285, 7, 8, 0, 0, 0, 0, '', 0, '2020-03-11 11:24:16'),
(286, 7, 9, 0, 0, 0, 0, '', 0, '2020-03-11 11:24:16'),
(287, 7, 11, 0, 0, 0, 0, '', 0, '2020-03-11 11:24:16'),
(288, 7, 15, 0, 0, 0, 0, '', 0, '2020-03-11 11:24:16'),
(289, 7, 17, 0, 0, 0, 0, '', 0, '2020-03-11 11:24:16'),
(290, 7, 18, 0, 0, 0, 0, '', 0, '2020-03-11 11:24:16'),
(291, 7, 20, 0, 0, 0, 0, '', 0, '2020-03-11 11:24:16'),
(292, 7, 21, 0, 0, 0, 0, '', 0, '2020-03-11 11:24:16'),
(293, 7, 22, 0, 0, 0, 0, '', 0, '2020-03-11 11:24:16'),
(294, 7, 34, 0, 0, 0, 0, '', 0, '2020-03-11 11:24:16'),
(295, 7, 35, 0, 0, 0, 0, '', 0, '2020-03-11 11:24:16'),
(296, 7, 36, 0, 0, 0, 0, '', 0, '2020-03-11 11:24:16'),
(297, 7, 19, 1, 1, 1, 1, '', 0, '2020-03-11 11:24:16'),
(298, 7, 23, 1, 1, 1, 1, '', 0, '2020-03-11 11:24:16'),
(299, 7, 24, 1, 1, 1, 1, '', 0, '2020-03-11 11:24:16'),
(300, 7, 25, 0, 0, 0, 0, '', 0, '2020-03-11 11:24:16'),
(301, 7, 26, 0, 0, 0, 0, '', 0, '2020-03-11 11:24:16'),
(302, 7, 27, 0, 0, 0, 0, '', 0, '2020-03-11 11:24:16'),
(303, 7, 28, 0, 0, 0, 0, '', 0, '2020-03-11 11:24:16'),
(304, 7, 29, 0, 0, 0, 0, '', 0, '2020-03-11 11:24:16'),
(305, 7, 31, 0, 0, 0, 0, '', 0, '2020-03-11 11:24:16'),
(306, 7, 32, 0, 0, 0, 0, '', 0, '2020-03-11 11:24:16'),
(307, 7, 33, 0, 0, 0, 0, '', 0, '2020-03-11 11:24:16'),
(308, 7, 30, 0, 0, 0, 0, '', 0, '2020-03-11 11:24:16'),
(309, 7, 12, 0, 0, 0, 0, '', 0, '2020-03-11 11:24:16'),
(310, 7, 13, 0, 0, 0, 0, '', 0, '2020-03-11 11:24:16'),
(311, 7, 14, 0, 0, 0, 0, '', 0, '2020-03-11 11:24:16'),
(334, 2, 7, 0, 0, 0, 0, '', 0, '2020-03-31 05:36:32'),
(335, 2, 8, 0, 1, 0, 0, '', 0, '2020-03-31 05:36:32'),
(336, 2, 9, 0, 1, 0, 0, '', 0, '2020-03-31 05:36:32'),
(337, 2, 11, 0, 1, 0, 0, '', 0, '2020-03-31 05:36:32'),
(338, 2, 15, 0, 1, 0, 0, '', 0, '2020-03-31 05:36:32'),
(339, 2, 17, 0, 1, 0, 0, '', 0, '2020-03-31 05:36:32'),
(340, 2, 18, 0, 1, 0, 0, '', 0, '2020-03-31 05:36:32'),
(341, 2, 20, 0, 1, 0, 0, '', 0, '2020-03-31 05:36:32'),
(342, 2, 21, 0, 0, 0, 0, '', 0, '2020-03-31 05:36:32'),
(343, 2, 22, 0, 0, 0, 0, '', 0, '2020-03-31 05:36:32'),
(344, 2, 19, 0, 0, 0, 0, '', 0, '2020-03-31 05:36:32'),
(345, 2, 23, 0, 0, 0, 0, '', 0, '2020-03-31 05:36:32'),
(346, 2, 24, 0, 0, 0, 0, '', 0, '2020-03-31 05:36:32'),
(347, 2, 25, 0, 0, 0, 0, '', 0, '2020-03-31 05:36:32'),
(348, 2, 26, 0, 0, 0, 0, '', 0, '2020-03-31 05:36:32'),
(349, 2, 27, 0, 0, 0, 0, '', 0, '2020-03-31 05:36:32'),
(350, 2, 28, 0, 0, 0, 0, '', 0, '2020-03-31 05:36:32'),
(351, 2, 29, 0, 0, 0, 0, '', 0, '2020-03-31 05:36:32'),
(352, 2, 30, 0, 0, 0, 0, '', 0, '2020-03-31 05:36:32'),
(353, 2, 12, 0, 0, 0, 0, '', 0, '2020-03-31 05:36:32'),
(354, 2, 13, 0, 0, 0, 0, '', 0, '2020-03-31 05:36:32'),
(355, 2, 14, 0, 0, 0, 0, '', 0, '2020-03-31 05:36:32'),
(714, 63, 31, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(715, 63, 7, 0, 1, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(716, 63, 8, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(717, 63, 9, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(718, 63, 11, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(719, 63, 15, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(720, 63, 17, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(721, 63, 18, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(722, 63, 20, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(723, 63, 21, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(724, 63, 22, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(725, 63, 53, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(726, 63, 54, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(727, 63, 55, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(728, 63, 56, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(729, 63, 19, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(730, 63, 23, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(731, 63, 24, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(732, 63, 25, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(733, 63, 26, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(734, 63, 27, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(735, 63, 28, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(736, 63, 29, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(737, 63, 69, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(738, 63, 30, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(739, 63, 57, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(740, 63, 58, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(741, 63, 59, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(742, 63, 60, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(743, 63, 62, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(744, 63, 63, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(745, 63, 64, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(746, 63, 65, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(747, 63, 66, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(748, 63, 67, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(749, 63, 68, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(750, 63, 70, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(751, 63, 71, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(752, 63, 72, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(753, 63, 73, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(754, 63, 74, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(755, 63, 75, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(756, 63, 76, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(757, 63, 77, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(758, 63, 78, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(759, 63, 79, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(760, 63, 80, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(761, 63, 81, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(762, 63, 82, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(763, 63, 83, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(764, 63, 84, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(765, 63, 35, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(766, 63, 36, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(767, 63, 37, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(768, 63, 38, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(769, 63, 39, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(770, 63, 41, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(771, 63, 42, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(772, 63, 43, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(773, 63, 52, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(774, 63, 12, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(775, 63, 13, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(776, 63, 14, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(777, 63, 51, 0, 0, 0, 0, '1', 0, '2021-06-10 15:11:24'),
(778, 68, 31, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(779, 68, 7, 0, 1, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(780, 68, 8, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(781, 68, 9, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(782, 68, 11, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(783, 68, 15, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(784, 68, 17, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(785, 68, 18, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(786, 68, 20, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(787, 68, 21, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(788, 68, 22, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(789, 68, 53, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(790, 68, 54, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(791, 68, 55, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(792, 68, 56, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(793, 68, 19, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(794, 68, 23, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(795, 68, 24, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(796, 68, 25, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(797, 68, 26, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(798, 68, 27, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(799, 68, 28, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(800, 68, 29, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(801, 68, 69, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(802, 68, 30, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(803, 68, 57, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(804, 68, 58, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(805, 68, 59, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(806, 68, 60, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(807, 68, 62, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(808, 68, 63, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(809, 68, 64, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(810, 68, 65, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(811, 68, 66, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(812, 68, 67, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(813, 68, 68, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(814, 68, 70, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(815, 68, 71, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(816, 68, 72, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(817, 68, 73, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(818, 68, 74, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(819, 68, 75, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(820, 68, 76, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(821, 68, 77, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(822, 68, 78, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(823, 68, 79, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(824, 68, 80, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(825, 68, 81, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(826, 68, 82, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(827, 68, 83, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(828, 68, 84, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(829, 68, 35, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(830, 68, 36, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(831, 68, 37, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(832, 68, 38, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(833, 68, 39, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(834, 68, 41, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(835, 68, 42, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(836, 68, 43, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(837, 68, 52, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(838, 68, 12, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(839, 68, 13, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(840, 68, 14, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(841, 68, 51, 0, 0, 0, 0, '1', 0, '2021-06-10 15:14:51'),
(906, 1, 31, 0, 0, 0, 0, '1', 0, '2021-06-29 19:37:13'),
(907, 1, 7, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(908, 1, 8, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(909, 1, 9, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(910, 1, 11, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(911, 1, 15, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(912, 1, 17, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(913, 1, 18, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(914, 1, 20, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(915, 1, 21, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(916, 1, 22, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(917, 1, 53, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(918, 1, 85, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(919, 1, 92, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(920, 1, 93, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(921, 1, 87, 0, 0, 0, 0, '1', 0, '2021-06-29 19:37:13'),
(922, 1, 88, 0, 0, 0, 0, '1', 0, '2021-06-29 19:37:13'),
(923, 1, 89, 0, 0, 0, 0, '1', 0, '2021-06-29 19:37:13'),
(924, 1, 90, 0, 0, 0, 0, '1', 0, '2021-06-29 19:37:13'),
(925, 1, 54, 0, 0, 0, 0, '1', 0, '2021-06-29 19:37:13'),
(926, 1, 55, 0, 0, 0, 0, '1', 0, '2021-06-29 19:37:13'),
(927, 1, 56, 0, 0, 0, 0, '1', 0, '2021-06-29 19:37:13'),
(928, 1, 19, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(929, 1, 23, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(930, 1, 24, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(931, 1, 35, 0, 0, 0, 0, '1', 0, '2021-06-29 19:37:13'),
(932, 1, 25, 1, 0, 0, 0, '1', 0, '2021-06-29 19:37:13'),
(933, 1, 26, 1, 0, 1, 0, '1', 0, '2021-06-29 19:37:13'),
(934, 1, 27, 0, 0, 0, 0, '1', 0, '2021-06-29 19:37:13'),
(935, 1, 28, 1, 0, 0, 0, '1', 0, '2021-06-29 19:37:13'),
(936, 1, 29, 1, 0, 0, 0, '1', 0, '2021-06-29 19:37:13'),
(937, 1, 30, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(938, 1, 57, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(939, 1, 58, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(940, 1, 59, 0, 0, 0, 0, '1', 0, '2021-06-29 19:37:13'),
(941, 1, 60, 0, 0, 0, 0, '1', 0, '2021-06-29 19:37:13'),
(942, 1, 62, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(943, 1, 63, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(944, 1, 64, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(945, 1, 65, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(946, 1, 66, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(947, 1, 67, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(948, 1, 68, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(949, 1, 69, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(950, 1, 70, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(951, 1, 71, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(952, 1, 72, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(953, 1, 73, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(954, 1, 74, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(955, 1, 75, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(956, 1, 76, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(957, 1, 77, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(958, 1, 78, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(959, 1, 79, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(960, 1, 80, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(961, 1, 81, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(962, 1, 82, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(963, 1, 83, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(964, 1, 84, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(965, 1, 86, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(966, 1, 36, 0, 0, 0, 0, '1', 0, '2021-06-29 19:37:13'),
(967, 1, 37, 0, 0, 0, 0, '1', 0, '2021-06-29 19:37:13'),
(968, 1, 38, 0, 0, 0, 0, '1', 0, '2021-06-29 19:37:13'),
(969, 1, 39, 0, 0, 0, 0, '1', 0, '2021-06-29 19:37:13'),
(970, 1, 41, 0, 0, 0, 0, '1', 0, '2021-06-29 19:37:13'),
(971, 1, 42, 0, 0, 0, 0, '1', 0, '2021-06-29 19:37:13'),
(972, 1, 43, 0, 0, 0, 0, '1', 0, '2021-06-29 19:37:13'),
(973, 1, 52, 0, 0, 0, 0, '1', 0, '2021-06-29 19:37:13'),
(974, 1, 12, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(975, 1, 13, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(976, 1, 14, 1, 1, 1, 1, '1', 0, '2021-06-29 19:37:13'),
(977, 1, 91, 0, 0, 0, 0, '1', 0, '2021-06-29 19:37:13'),
(978, 1, 51, 0, 0, 0, 0, '1', 0, '2021-06-29 19:37:13'),
(979, 169, 31, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(980, 169, 7, 1, 1, 1, 1, '1', 0, '2021-07-06 13:43:28'),
(981, 169, 8, 1, 1, 1, 1, '1', 0, '2021-07-06 13:43:28'),
(982, 169, 9, 1, 1, 1, 1, '1', 0, '2021-07-06 13:43:28'),
(983, 169, 11, 1, 1, 1, 1, '1', 0, '2021-07-06 13:43:28'),
(984, 169, 15, 1, 1, 1, 1, '1', 0, '2021-07-06 13:43:28'),
(985, 169, 17, 1, 1, 1, 1, '1', 0, '2021-07-06 13:43:28'),
(986, 169, 18, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(987, 169, 20, 1, 1, 1, 1, '1', 0, '2021-07-06 13:43:28'),
(988, 169, 21, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(989, 169, 22, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(990, 169, 53, 1, 1, 1, 1, '1', 0, '2021-07-06 13:43:28'),
(991, 169, 85, 1, 1, 1, 1, '1', 0, '2021-07-06 13:43:28'),
(992, 169, 92, 1, 1, 1, 1, '1', 0, '2021-07-06 13:43:28'),
(993, 169, 93, 1, 1, 1, 1, '1', 0, '2021-07-06 13:43:28'),
(994, 169, 95, 1, 1, 1, 1, '1', 0, '2021-07-06 13:43:28'),
(995, 169, 87, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(996, 169, 88, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(997, 169, 89, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(998, 169, 90, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(999, 169, 54, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1000, 169, 55, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1001, 169, 56, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1002, 169, 35, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1003, 169, 94, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1004, 169, 19, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1005, 169, 23, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1006, 169, 24, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1007, 169, 25, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1008, 169, 26, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1009, 169, 27, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1010, 169, 28, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1011, 169, 29, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1012, 169, 30, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1013, 169, 57, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1014, 169, 58, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1015, 169, 59, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1016, 169, 60, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1017, 169, 62, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1018, 169, 63, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1019, 169, 64, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1020, 169, 65, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1021, 169, 66, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1022, 169, 67, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1023, 169, 68, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1024, 169, 69, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1025, 169, 70, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1026, 169, 71, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1027, 169, 72, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1028, 169, 73, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1029, 169, 74, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1030, 169, 75, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1031, 169, 76, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1032, 169, 77, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1033, 169, 78, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1034, 169, 79, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1035, 169, 80, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1036, 169, 81, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1037, 169, 82, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1038, 169, 83, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1039, 169, 84, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1040, 169, 86, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1041, 169, 36, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1042, 169, 37, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1043, 169, 38, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1044, 169, 39, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1045, 169, 41, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1046, 169, 42, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1047, 169, 43, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1048, 169, 52, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1049, 169, 12, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1050, 169, 13, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1051, 169, 14, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1052, 169, 91, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1053, 169, 51, 0, 0, 0, 0, '1', 0, '2021-07-06 13:43:28'),
(1054, 172, 31, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1055, 172, 7, 1, 1, 1, 1, '1', 0, '2021-07-06 14:50:47'),
(1056, 172, 8, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1057, 172, 9, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1058, 172, 11, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1059, 172, 15, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1060, 172, 17, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1061, 172, 18, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1062, 172, 20, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1063, 172, 21, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1064, 172, 22, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1065, 172, 53, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1066, 172, 85, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1067, 172, 92, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1068, 172, 93, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1069, 172, 95, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1070, 172, 87, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1071, 172, 88, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1072, 172, 89, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1073, 172, 90, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1074, 172, 54, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1075, 172, 55, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1076, 172, 56, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1077, 172, 35, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1078, 172, 94, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1079, 172, 19, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1080, 172, 23, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1081, 172, 24, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1082, 172, 25, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1083, 172, 26, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1084, 172, 27, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1085, 172, 28, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1086, 172, 29, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1087, 172, 30, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1088, 172, 57, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1089, 172, 58, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1090, 172, 59, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1091, 172, 60, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1092, 172, 62, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1093, 172, 63, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1094, 172, 64, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1095, 172, 65, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1096, 172, 66, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1097, 172, 67, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1098, 172, 68, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1099, 172, 69, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1100, 172, 70, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1101, 172, 71, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1102, 172, 72, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1103, 172, 73, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1104, 172, 74, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1105, 172, 75, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1106, 172, 76, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1107, 172, 77, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1108, 172, 78, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1109, 172, 79, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1110, 172, 80, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1111, 172, 81, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1112, 172, 82, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1113, 172, 83, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1114, 172, 84, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1115, 172, 86, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1116, 172, 36, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1117, 172, 37, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1118, 172, 38, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1119, 172, 39, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1120, 172, 41, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1121, 172, 42, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1122, 172, 43, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1123, 172, 52, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1124, 172, 12, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1125, 172, 13, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1126, 172, 14, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1127, 172, 91, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1128, 172, 51, 0, 0, 0, 0, '1', 0, '2021-07-06 14:50:47'),
(1129, 12, 31, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1130, 12, 7, 1, 1, 1, 1, '1', 0, '2021-07-06 14:56:05'),
(1131, 12, 8, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1132, 12, 9, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1133, 12, 11, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1134, 12, 15, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1135, 12, 17, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1136, 12, 18, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1137, 12, 20, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1138, 12, 21, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1139, 12, 22, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1140, 12, 53, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1141, 12, 85, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1142, 12, 92, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1143, 12, 93, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1144, 12, 95, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1145, 12, 87, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1146, 12, 88, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1147, 12, 89, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1148, 12, 90, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1149, 12, 54, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1150, 12, 55, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1151, 12, 56, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1152, 12, 35, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1153, 12, 94, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1154, 12, 19, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1155, 12, 23, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1156, 12, 24, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1157, 12, 25, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1158, 12, 26, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1159, 12, 27, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1160, 12, 28, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1161, 12, 29, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1162, 12, 30, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1163, 12, 57, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1164, 12, 58, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1165, 12, 59, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1166, 12, 60, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1167, 12, 62, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1168, 12, 63, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1169, 12, 64, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1170, 12, 65, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1171, 12, 66, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1172, 12, 67, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1173, 12, 68, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1174, 12, 69, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1175, 12, 70, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1176, 12, 71, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1177, 12, 72, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1178, 12, 73, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1179, 12, 74, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1180, 12, 75, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1181, 12, 76, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1182, 12, 77, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1183, 12, 78, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1184, 12, 79, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1185, 12, 80, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1186, 12, 81, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1187, 12, 82, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1188, 12, 83, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1189, 12, 84, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1190, 12, 86, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1191, 12, 36, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1192, 12, 37, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1193, 12, 38, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1194, 12, 39, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1195, 12, 41, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1196, 12, 42, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1197, 12, 43, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1198, 12, 52, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1199, 12, 12, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1200, 12, 13, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1201, 12, 14, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1202, 12, 91, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05'),
(1203, 12, 51, 0, 0, 0, 0, '1', 0, '2021-07-06 14:56:05');

-- --------------------------------------------------------

--
-- Table structure for table `sec_role_tbl`
--

CREATE TABLE `sec_role_tbl` (
  `role_id` int(11) NOT NULL,
  `role_name` text NOT NULL,
  `role_description` text NOT NULL,
  `create_by` int(11) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `role_status` int(11) NOT NULL DEFAULT 1,
  `enterprise_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sec_role_tbl`
--

INSERT INTO `sec_role_tbl` (`role_id`, `role_name`, `role_description`, `create_by`, `date_time`, `role_status`, `enterprise_id`) VALUES
(1, 'Enterprise Role', 'Test', 1, '2019-11-30 02:27:43', 1, '1'),
(2, 'Faculty', 'demo', 1, '2019-12-01 05:27:24', 1, ''),
(5, 'Administrator', 'demo', 1, '2019-12-01 06:21:08', 1, ''),
(6, 'Students Role', 'demo', 1, '2019-12-22 10:00:48', 1, ''),
(7, 'Assistant Manager', '', NULL, '2020-03-11 11:24:16', 1, ''),
(12, 'User Role ', '', NULL, '2021-07-06 14:56:05', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `sec_user_access_tbl`
--

CREATE TABLE `sec_user_access_tbl` (
  `role_acc_id` int(11) NOT NULL,
  `fk_role_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fk_user_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `enterprise_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sec_user_access_tbl`
--

INSERT INTO `sec_user_access_tbl` (`role_acc_id`, `fk_role_id`, `fk_user_id`, `enterprise_id`) VALUES
(127, '1', 'F2366D9BB', ''),
(128, '1', 'F27BEQFJ5', '');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `storename` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `logoTwo` varchar(255) DEFAULT NULL,
  `logoThree` varchar(255) DEFAULT NULL,
  `splash_logo` varchar(255) NOT NULL,
  `favicon` varchar(100) DEFAULT NULL,
  `vat` int(11) NOT NULL DEFAULT 0,
  `servicecharge` int(11) NOT NULL DEFAULT 0,
  `country` varchar(100) DEFAULT NULL,
  `is_ready_subscription` int(11) NOT NULL COMMENT '1=yes and 0=no',
  `currency` varchar(11) DEFAULT NULL,
  `currency_rate` varchar(20) NOT NULL,
  `currency_position` int(11) NOT NULL,
  `language` varchar(100) DEFAULT NULL,
  `timezone` varchar(150) NOT NULL,
  `checkouttime` time NOT NULL,
  `dateformat` text NOT NULL,
  `site_align` varchar(50) DEFAULT NULL,
  `youtube_api_key` varchar(255) NOT NULL,
  `vimeo_api_key` varchar(255) NOT NULL,
  `apps_logo` varchar(255) DEFAULT NULL,
  `apps_url` varchar(255) DEFAULT NULL,
  `header_color` varchar(10) DEFAULT NULL,
  `sidebar_color` varchar(10) DEFAULT NULL,
  `sidebar_activecolor` varchar(10) DEFAULT NULL,
  `button_color` varchar(20) NOT NULL,
  `footer_color` varchar(10) DEFAULT NULL,
  `course_header_image` varchar(255) NOT NULL,
  `lead_featured_image` varchar(255) DEFAULT NULL,
  `cart_header_image` varchar(255) NOT NULL,
  `checkout_header_image` varchar(255) NOT NULL,
  `profile_header_image` varchar(255) NOT NULL,
  `faq_header_image` varchar(255) DEFAULT NULL,
  `project_header_image` varchar(255) DEFAULT NULL,
  `event_header_image` varchar(255) DEFAULT NULL,
  `contactus_header_image` varchar(255) DEFAULT NULL,
  `forum_header_image` varchar(255) DEFAULT NULL,
  `docusign_sample` varchar(255) DEFAULT NULL,
  `powerbytxt` text DEFAULT NULL,
  `footer_text` varchar(255) DEFAULT NULL,
  `facebook_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `youtube_link` varchar(255) DEFAULT NULL,
  `instagram_link` varchar(255) DEFAULT NULL,
  `footer_logo` varchar(255) DEFAULT NULL,
  `signin_picture` varchar(255) DEFAULT NULL,
  `signup_picture` varchar(255) DEFAULT NULL,
  `footer_about` varchar(255) DEFAULT NULL,
  `subscription_savetitle` varchar(255) DEFAULT NULL,
  `anyquestion_title` varchar(255) DEFAULT NULL,
  `anyquestion_picture` varchar(255) DEFAULT NULL,
  `learner_count` int(11) DEFAULT NULL,
  `total_course` int(11) DEFAULT NULL,
  `language_count` int(11) DEFAULT NULL,
  `successfully_students` int(11) DEFAULT NULL,
  `enterprise_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `title`, `storename`, `address`, `email`, `phone`, `logo`, `logoTwo`, `logoThree`, `splash_logo`, `favicon`, `vat`, `servicecharge`, `country`, `is_ready_subscription`, `currency`, `currency_rate`, `currency_position`, `language`, `timezone`, `checkouttime`, `dateformat`, `site_align`, `youtube_api_key`, `vimeo_api_key`, `apps_logo`, `apps_url`, `header_color`, `sidebar_color`, `sidebar_activecolor`, `button_color`, `footer_color`, `course_header_image`, `lead_featured_image`, `cart_header_image`, `checkout_header_image`, `profile_header_image`, `faq_header_image`, `project_header_image`, `event_header_image`, `contactus_header_image`, `forum_header_image`, `docusign_sample`, `powerbytxt`, `footer_text`, `facebook_link`, `twitter_link`, `youtube_link`, `instagram_link`, `footer_logo`, `signin_picture`, `signup_picture`, `footer_about`, `subscription_savetitle`, `anyquestion_title`, `anyquestion_picture`, `learner_count`, `total_course`, `language_count`, `successfully_students`, `enterprise_id`) VALUES
(2, 'Lead Academy', 'undefined', '', 'demo@gmail.com', '0123456789', 'assets/uploads/logo/2022-01-10/899fb0fd8b5358a907fb10d963b03a6a.svg', 'assets/uploads/logo/2022-01-10/602b520cd70a054bd7a0cdffa8ba0345.svg', 'assets/uploads/logo/2022-01-10/e15308ff9f0613c5d730b920f1fa2fc4.svg', 'assets/img/icons/2019-07-01/l.png', 'assets/img/icons/2020-05-01/b42282ca7ba4d42f050cd31ea075ad5b.png', 0, 12, 'Bangladesh', 1, '', '', 1, 'english', 'Asia/Dhaka', '12:00:00', 'd/m/Y', 'undefined', 'AIzaSyA5-5P5B-qWQkTFdyAgAPuo4CtrbxKBzKA', '9934bd59f90bb90c5b4b3526cdfa78c9', 'undefined', 'undefined', '#ffffff', '#000000', '#1b5fa0', '[object HTMLInputEle', '#ffffff', 'assets/img/icons/2021-10-06/28abe401e51c030fa170d78502f8544e.jpg', '', 'undefined', 'undefined', 'assets/img/icons/2020-06-27/2a33fbff872409638af2c72b0c1c3a04.jpg', '', '', '', 'assets/img/icons/2021-11-24/65652bc808ce76439c8d918e578ccab8.jpg', '', 'assets/img/icons/2020-06-27/f430b33df8a45b9aef2678582b066501.jpg', 'Powered By: LEAD, www.lead.academy', '', 'https://www.facebook.com/', 'https://twitter.com/?lang=en', 'https://www.youtube.com/', 'https://www.instagram.com/', 'assets/uploads/logo/2021-10-06/2f5b93ccf352717677e689025517a384.png', 'assets/uploads/logo/2022-01-15/3f582a09b42f35a045ff95948309bc7e.png', NULL, 'We support programs that create advancement opportunities for people. ', 'Save 30% with our Annual Plan. ', 'Leave your name, e-mail & phone number, we will get back to you soon..', 'assets/uploads/settings/2022-01-18/5485150699d6318b4f0843ffa647ddf9.png', 300, 80, 2, 250, '1'),
(4, 'Enterprise Three', '', '', 'three@gmail.com', '123456', 'assets/uploads/logo/2021-06-30/c29734c5c6605516cc5574a68a063220.png', '', 'assets/uploads/logo/2021-06-30/26d9d6aed14437f5e9789bd834d4cbbb.gif', '', '', 0, 0, NULL, 1, 'BDT', '', 0, 'english', 'Asia/Dhaka', '00:00:00', 'Y-m-d', 'LTR', '', '', '', '', '#fcfcfc', '#3a1818', '#dea0a0', '#1b5fa0', '#dac8c8', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ENT0765QACC');

-- --------------------------------------------------------

--
-- Table structure for table `slide_tbl`
--

CREATE TABLE `slide_tbl` (
  `id` int(11) NOT NULL,
  `slider_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `slider_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `background_video_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_video_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slider_point_one` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slider_point_two` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slider_point_three` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slide_tbl`
--

INSERT INTO `slide_tbl` (`id`, `slider_id`, `slider_logo`, `title`, `subtitle`, `tags`, `description`, `background_video_url`, `short_video_url`, `slider_point_one`, `slider_point_two`, `slider_point_three`, `subtitle_image`, `enterprise_id`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'SL106OM', './assets/uploads/sliders/2022-03-09/e9c64da761441f25c933ef4aa65098ae.png', 'INSPIRING KNOWLEDGE, EDUCATING MINDS', 'Unlimited Access To World Class Online Learning ', '', '', 'assets/uploads/sliders/2022-01-10/b84022e079eb1fad75cb8b6e3dd306d3.mp4', 'https://youtu.be/4MmHRQPoLjE', 'undefined', 'undefined', 'undefined', 'assets/uploads/sliders/2022-03-09/ed35ac906966cf6bbbd858f362854685.jpg', '1', '', '2022-03-09 07:01:15', '1', '2022-03-09 13:01:15');

-- --------------------------------------------------------

--
-- Table structure for table `sms_gateway`
--

CREATE TABLE `sms_gateway` (
  `gateway_id` int(11) NOT NULL,
  `provider_name` text NOT NULL,
  `user` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `authentication` text NOT NULL,
  `link` text NOT NULL,
  `default_status` int(11) NOT NULL DEFAULT 0,
  `is_invoice` int(11) NOT NULL,
  `is_purchase` int(11) NOT NULL,
  `is_receive` int(11) NOT NULL,
  `is_payment` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `enterprise_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms_gateway`
--

INSERT INTO `sms_gateway` (`gateway_id`, `provider_name`, `user`, `password`, `phone`, `authentication`, `link`, `default_status`, `is_invoice`, `is_purchase`, `is_receive`, `is_payment`, `status`, `enterprise_id`) VALUES
(1, 'NEXMO', '8a980366 ', 'sdfsd', '8801703136868', 'Md. Shahab udin', '', 0, 1, 0, 1, 0, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `socialauth_config_tbl`
--

CREATE TABLE `socialauth_config_tbl` (
  `id` int(11) NOT NULL,
  `appid_clientid` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `secret_key` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `access_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `redirect_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(11) NOT NULL COMMENT '1=google, 2=facebook, 3=vimeo',
  `enterprise_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL COMMENT '1=active and 0=inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `socialauth_config_tbl`
--

INSERT INTO `socialauth_config_tbl` (`id`, `appid_clientid`, `secret_key`, `access_token`, `redirect_url`, `type`, `enterprise_id`, `created_by`, `created_date`, `status`) VALUES
(1, '827829191471-b5taif1smnq89ovvoccleg2cpma3rq1o.apps.googleusercontent.com', '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', NULL, 'https://lead.academy/admin/signin', 1, '1', '1', '2021-11-03 15:46:38', 1),
(2, '3561578210626193', 'd62f798d179146ecb7e37ab06f2cd2c3', NULL, 'https://soft6.bdtask.com/leadacademy/admin/signin', 2, '1', '1', '2021-11-03 15:59:52', 1),
(3, '0f720dfa8d2c4386a254313712b7fb9da5a8281b', '9934bd59f90bb90c5b4b3526cdfa78c9', 'jp2uzQbxNrlXONacXTz63/vrolXjCBWkIB0zaHokCC8mlCEVsTOwuFtrwpAKUWjX1ROzJzV+pynWZannfbDZ9qkpalbjh5kQURPDfFHEgiBbg69/S/35fkzt4rUvTMpz', NULL, 3, '1', '1', '2021-11-16 17:13:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` int(11) NOT NULL,
  `user_id` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link_type` tinyint(4) DEFAULT NULL COMMENT '1=facebook, 2=twitter, 3=linkedin, 4=github, 5=instagram, 6=youtube, 7=vimeo and 8=world',
  `link` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stripe_config`
--

CREATE TABLE `stripe_config` (
  `id` int(11) NOT NULL,
  `payment_method_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `marchant_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_live` int(11) NOT NULL COMMENT '1=live and 0= test',
  `status` int(11) NOT NULL COMMENT '1=active and 0=inactive',
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stripe_config`
--

INSERT INTO `stripe_config` (`id`, `payment_method_name`, `marchant_id`, `password`, `email`, `currency`, `is_live`, `status`, `enterprise_id`) VALUES
(1, 'Stripe Gateway', 'sk_test_ol4WUcbGsqxNJItpeOi1ecDT00k5mDyC2G', 'pk_test_TrVFpmZBkgasCE6WTPkZgMPr00UzVVOqgp', 'test@gmail.com', 'BDT', 1, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `students_tbl`
--

CREATE TABLE `students_tbl` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `biography` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_skillshow` int(11) NOT NULL COMMENT '1=show and 0=hide',
  `skills` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_contactshow` int(11) NOT NULL COMMENT '1=show and 0=hide',
  `is_contacttitle` int(11) NOT NULL COMMENT '1=show and 0=hide',
  `contacttitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zipcode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_hiringshow` int(11) NOT NULL,
  `hiring_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hiring_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_educationshow` int(11) NOT NULL COMMENT '1=show and 0=hide',
  `is_experienceshow` int(11) NOT NULL COMMENT '1=show and 0=hide',
  `is_proficiencyshow` int(11) NOT NULL COMMENT '1=show and 0=hide',
  `is_featureshow` tinyint(4) NOT NULL,
  `is_biographyshow` int(11) NOT NULL COMMENT '1=yes and 0=no',
  `is_profileshow` int(11) NOT NULL COMMENT '1=yes and 0=no',
  `is_resumeshow` int(11) NOT NULL COMMENT '1=yes and 0=no',
  `resume` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coverpicture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_certificateshow` int(11) NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1=active and 0=inactive',
  `agree_toterms` int(11) NOT NULL,
  `last_activity` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `last_lesson` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students_tbl`
--

INSERT INTO `students_tbl` (`id`, `student_id`, `name`, `mobile`, `email`, `address`, `designation`, `biography`, `website`, `is_skillshow`, `skills`, `language`, `is_contactshow`, `is_contacttitle`, `contacttitle`, `public_email`, `country`, `city`, `state`, `zipcode`, `is_hiringshow`, `hiring_title`, `hiring_type`, `is_educationshow`, `is_experienceshow`, `is_proficiencyshow`, `is_featureshow`, `is_biographyshow`, `is_profileshow`, `is_resumeshow`, `resume`, `coverpicture`, `is_certificateshow`, `enterprise_id`, `status`, `agree_toterms`, `last_activity`, `last_lesson`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(45, 'ST2793YBB6', 'Zahid Khan', '01521310229', 'zahid22@gmail.com', '', NULL, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, 'assets/uploads/students/2022-04-27/0818011359063b30acba8db277ac8fa9.jpg', 0, '1', 1, 1, 'CO27V632V', 'LE27R76LY', '1', '2022-04-27 07:54:35', '', NULL),
(46, 'ST09COMMOR', 'Md. Shahab uddin', '01684964913', 'shahabuddinp91@gmail.com', 'Dhaka', NULL, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, NULL, '19', 'Dhaka', 'Dhaka', '1229', 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '1', 1, 1, 'CO27V632V', 'LE27R76LY', '1', '2022-05-09 09:20:59', '', '2022-05-09 19:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `subscribes_tbl`
--

CREATE TABLE `subscribes_tbl` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_receive` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_course_tbl`
--

CREATE TABLE `subscription_course_tbl` (
  `id` int(11) NOT NULL,
  `subscription_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `course_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_pricing_tbl`
--

CREATE TABLE `subscription_pricing_tbl` (
  `id` int(11) NOT NULL,
  `max_percentage` float NOT NULL,
  `max_payable` float NOT NULL,
  `cronjob_time` time NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subscription_pricing_tbl`
--

INSERT INTO `subscription_pricing_tbl` (`id`, `max_percentage`, `max_payable`, `cronjob_time`, `enterprise_id`, `created_by`, `created_date`) VALUES
(1, 120, 26.7, '16:45:00', '1', '1', '2022-05-09 20:40:08'),
(2, 120, 26.7, '14:10:00', '', '', '2022-04-23 18:03:42');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_tbl`
--

CREATE TABLE `subscription_tbl` (
  `id` int(11) NOT NULL,
  `subscription_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '1=monthly, 2=yearly, 3=free and 4=enterprise package',
  `price` int(11) NOT NULL,
  `oldprice` int(11) NOT NULL,
  `course_sub_content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_free` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subscription_tbl`
--

INSERT INTO `subscription_tbl` (`id`, `subscription_id`, `title`, `start_time`, `end_time`, `description`, `duration`, `price`, `oldprice`, `course_sub_content`, `is_free`, `status`, `enterprise_id`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'sub08RII9T', 'Beginner', NULL, NULL, '', '1', 10, 0, '[\"All subscription courses\",\"No Course materials\",\"No Certificate\"]', NULL, 1, '1', '1', '2022-03-14 11:14:37', '', NULL),
(4, 'sub08YQZKA', 'Advanced', NULL, NULL, '', '2', 20, 0, '[\"All subscription courses\",\"Access Course Materials\",\"Get Certificates\"]', NULL, 1, '1', '1', '2022-03-14 12:58:31', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `synchronizer_setting`
--

CREATE TABLE `synchronizer_setting` (
  `id` int(11) NOT NULL,
  `hostname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `port` varchar(10) NOT NULL,
  `debug` varchar(10) NOT NULL,
  `project_root` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_countries`
--

CREATE TABLE `tbl_countries` (
  `CountryID` int(11) NOT NULL,
  `CountryName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TwoCharCountryCode` char(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ThreeCharCountryCode` char(3) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_countries`
--

INSERT INTO `tbl_countries` (`CountryID`, `CountryName`, `TwoCharCountryCode`, `ThreeCharCountryCode`) VALUES
(1, 'Afghanistan', 'AF', 'AFG'),
(2, 'Aland Islands', 'AX', 'ALA'),
(3, 'Albania', 'AL', 'ALB'),
(4, 'Algeria', 'DZ', 'DZA'),
(5, 'American Samoa', 'AS', 'ASM'),
(6, 'Andorra', 'AD', 'AND'),
(7, 'Angola', 'AO', 'AGO'),
(8, 'Anguilla', 'AI', 'AIA'),
(9, 'Antarctica', 'AQ', 'ATA'),
(10, 'Antigua and Barbuda', 'AG', 'ATG'),
(11, 'Argentina', 'AR', 'ARG'),
(12, 'Armenia', 'AM', 'ARM'),
(13, 'Aruba', 'AW', 'ABW'),
(14, 'Australia', 'AU', 'AUS'),
(15, 'Austria', 'AT', 'AUT'),
(16, 'Azerbaijan', 'AZ', 'AZE'),
(17, 'Bahamas', 'BS', 'BHS'),
(18, 'Bahrain', 'BH', 'BHR'),
(19, 'Bangladesh', 'BD', 'BGD'),
(20, 'Barbados', 'BB', 'BRB'),
(21, 'Belarus', 'BY', 'BLR'),
(22, 'Belgium', 'BE', 'BEL'),
(23, 'Belize', 'BZ', 'BLZ'),
(24, 'Benin', 'BJ', 'BEN'),
(25, 'Bermuda', 'BM', 'BMU'),
(26, 'Bhutan', 'BT', 'BTN'),
(27, 'Bolivia', 'BO', 'BOL'),
(28, 'Bonaire, Sint Eustatius and Saba', 'BQ', 'BES'),
(29, 'Bosnia and Herzegovina', 'BA', 'BIH'),
(30, 'Botswana', 'BW', 'BWA'),
(31, 'Bouvet Island', 'BV', 'BVT'),
(32, 'Brazil', 'BR', 'BRA'),
(33, 'British Indian Ocean Territory', 'IO', 'IOT'),
(34, 'Brunei', 'BN', 'BRN'),
(35, 'Bulgaria', 'BG', 'BGR'),
(36, 'Burkina Faso', 'BF', 'BFA'),
(37, 'Burundi', 'BI', 'BDI'),
(38, 'Cambodia', 'KH', 'KHM'),
(39, 'Cameroon', 'CM', 'CMR'),
(40, 'Canada', 'CA', 'CAN'),
(41, 'Cape Verde', 'CV', 'CPV'),
(42, 'Cayman Islands', 'KY', 'CYM'),
(43, 'Central African Republic', 'CF', 'CAF'),
(44, 'Chad', 'TD', 'TCD'),
(45, 'Chile', 'CL', 'CHL'),
(46, 'China', 'CN', 'CHN'),
(47, 'Christmas Island', 'CX', 'CXR'),
(48, 'Cocos (Keeling) Islands', 'CC', 'CCK'),
(49, 'Colombia', 'CO', 'COL'),
(50, 'Comoros', 'KM', 'COM'),
(51, 'Congo', 'CG', 'COG'),
(52, 'Cook Islands', 'CK', 'COK'),
(53, 'Costa Rica', 'CR', 'CRI'),
(54, 'Ivory Coast', 'CI', 'CIV'),
(55, 'Croatia', 'HR', 'HRV'),
(56, 'Cuba', 'CU', 'CUB'),
(57, 'Curacao', 'CW', 'CUW'),
(58, 'Cyprus', 'CY', 'CYP'),
(59, 'Czech Republic', 'CZ', 'CZE'),
(60, 'Democratic Republic of the Congo', 'CD', 'COD'),
(61, 'Denmark', 'DK', 'DNK'),
(62, 'Djibouti', 'DJ', 'DJI'),
(63, 'Dominica', 'DM', 'DMA'),
(64, 'Dominican Republic', 'DO', 'DOM'),
(65, 'Ecuador', 'EC', 'ECU'),
(66, 'Egypt', 'EG', 'EGY'),
(67, 'El Salvador', 'SV', 'SLV'),
(68, 'Equatorial Guinea', 'GQ', 'GNQ'),
(69, 'Eritrea', 'ER', 'ERI'),
(70, 'Estonia', 'EE', 'EST'),
(71, 'Ethiopia', 'ET', 'ETH'),
(72, 'Falkland Islands (Malvinas)', 'FK', 'FLK'),
(73, 'Faroe Islands', 'FO', 'FRO'),
(74, 'Fiji', 'FJ', 'FJI'),
(75, 'Finland', 'FI', 'FIN'),
(76, 'France', 'FR', 'FRA'),
(77, 'French Guiana', 'GF', 'GUF'),
(78, 'French Polynesia', 'PF', 'PYF'),
(79, 'French Southern Territories', 'TF', 'ATF'),
(80, 'Gabon', 'GA', 'GAB'),
(81, 'Gambia', 'GM', 'GMB'),
(82, 'Georgia', 'GE', 'GEO'),
(83, 'Germany', 'DE', 'DEU'),
(84, 'Ghana', 'GH', 'GHA'),
(85, 'Gibraltar', 'GI', 'GIB'),
(86, 'Greece', 'GR', 'GRC'),
(87, 'Greenland', 'GL', 'GRL'),
(88, 'Grenada', 'GD', 'GRD'),
(89, 'Guadaloupe', 'GP', 'GLP'),
(90, 'Guam', 'GU', 'GUM'),
(91, 'Guatemala', 'GT', 'GTM'),
(92, 'Guernsey', 'GG', 'GGY'),
(93, 'Guinea', 'GN', 'GIN'),
(94, 'Guinea-Bissau', 'GW', 'GNB'),
(95, 'Guyana', 'GY', 'GUY'),
(96, 'Haiti', 'HT', 'HTI'),
(97, 'Heard Island and McDonald Islands', 'HM', 'HMD'),
(98, 'Honduras', 'HN', 'HND'),
(99, 'Hong Kong', 'HK', 'HKG'),
(100, 'Hungary', 'HU', 'HUN'),
(101, 'Iceland', 'IS', 'ISL'),
(102, 'India', 'IN', 'IND'),
(103, 'Indonesia', 'ID', 'IDN'),
(104, 'Iran', 'IR', 'IRN'),
(105, 'Iraq', 'IQ', 'IRQ'),
(106, 'Ireland', 'IE', 'IRL'),
(107, 'Isle of Man', 'IM', 'IMN'),
(108, 'Israel', 'IL', 'ISR'),
(109, 'Italy', 'IT', 'ITA'),
(110, 'Jamaica', 'JM', 'JAM'),
(111, 'Japan', 'JP', 'JPN'),
(112, 'Jersey', 'JE', 'JEY'),
(113, 'Jordan', 'JO', 'JOR'),
(114, 'Kazakhstan', 'KZ', 'KAZ'),
(115, 'Kenya', 'KE', 'KEN'),
(116, 'Kiribati', 'KI', 'KIR'),
(117, 'Kosovo', 'XK', '---'),
(118, 'Kuwait', 'KW', 'KWT'),
(119, 'Kyrgyzstan', 'KG', 'KGZ'),
(120, 'Laos', 'LA', 'LAO'),
(121, 'Latvia', 'LV', 'LVA'),
(122, 'Lebanon', 'LB', 'LBN'),
(123, 'Lesotho', 'LS', 'LSO'),
(124, 'Liberia', 'LR', 'LBR'),
(125, 'Libya', 'LY', 'LBY'),
(126, 'Liechtenstein', 'LI', 'LIE'),
(127, 'Lithuania', 'LT', 'LTU'),
(128, 'Luxembourg', 'LU', 'LUX'),
(129, 'Macao', 'MO', 'MAC'),
(130, 'Macedonia', 'MK', 'MKD'),
(131, 'Madagascar', 'MG', 'MDG'),
(132, 'Malawi', 'MW', 'MWI'),
(133, 'Malaysia', 'MY', 'MYS'),
(134, 'Maldives', 'MV', 'MDV'),
(135, 'Mali', 'ML', 'MLI'),
(136, 'Malta', 'MT', 'MLT'),
(137, 'Marshall Islands', 'MH', 'MHL'),
(138, 'Martinique', 'MQ', 'MTQ'),
(139, 'Mauritania', 'MR', 'MRT'),
(140, 'Mauritius', 'MU', 'MUS'),
(141, 'Mayotte', 'YT', 'MYT'),
(142, 'Mexico', 'MX', 'MEX'),
(143, 'Micronesia', 'FM', 'FSM'),
(144, 'Moldava', 'MD', 'MDA'),
(145, 'Monaco', 'MC', 'MCO'),
(146, 'Mongolia', 'MN', 'MNG'),
(147, 'Montenegro', 'ME', 'MNE'),
(148, 'Montserrat', 'MS', 'MSR'),
(149, 'Morocco', 'MA', 'MAR'),
(150, 'Mozambique', 'MZ', 'MOZ'),
(151, 'Myanmar (Burma)', 'MM', 'MMR'),
(152, 'Namibia', 'NA', 'NAM'),
(153, 'Nauru', 'NR', 'NRU'),
(154, 'Nepal', 'NP', 'NPL'),
(155, 'Netherlands', 'NL', 'NLD'),
(156, 'New Caledonia', 'NC', 'NCL'),
(157, 'New Zealand', 'NZ', 'NZL'),
(158, 'Nicaragua', 'NI', 'NIC'),
(159, 'Niger', 'NE', 'NER'),
(160, 'Nigeria', 'NG', 'NGA'),
(161, 'Niue', 'NU', 'NIU'),
(162, 'Norfolk Island', 'NF', 'NFK'),
(163, 'North Korea', 'KP', 'PRK'),
(164, 'Northern Mariana Islands', 'MP', 'MNP'),
(165, 'Norway', 'NO', 'NOR'),
(166, 'Oman', 'OM', 'OMN'),
(167, 'Pakistan', 'PK', 'PAK'),
(168, 'Palau', 'PW', 'PLW'),
(169, 'Palestine', 'PS', 'PSE'),
(170, 'Panama', 'PA', 'PAN'),
(171, 'Papua New Guinea', 'PG', 'PNG'),
(172, 'Paraguay', 'PY', 'PRY'),
(173, 'Peru', 'PE', 'PER'),
(174, 'Phillipines', 'PH', 'PHL'),
(175, 'Pitcairn', 'PN', 'PCN'),
(176, 'Poland', 'PL', 'POL'),
(177, 'Portugal', 'PT', 'PRT'),
(178, 'Puerto Rico', 'PR', 'PRI'),
(179, 'Qatar', 'QA', 'QAT'),
(180, 'Reunion', 'RE', 'REU'),
(181, 'Romania', 'RO', 'ROU'),
(182, 'Russia', 'RU', 'RUS'),
(183, 'Rwanda', 'RW', 'RWA'),
(184, 'Saint Barthelemy', 'BL', 'BLM'),
(185, 'Saint Helena', 'SH', 'SHN'),
(186, 'Saint Kitts and Nevis', 'KN', 'KNA'),
(187, 'Saint Lucia', 'LC', 'LCA'),
(188, 'Saint Martin', 'MF', 'MAF'),
(189, 'Saint Pierre and Miquelon', 'PM', 'SPM'),
(190, 'Saint Vincent and the Grenadines', 'VC', 'VCT'),
(191, 'Samoa', 'WS', 'WSM'),
(192, 'San Marino', 'SM', 'SMR'),
(193, 'Sao Tome and Principe', 'ST', 'STP'),
(194, 'Saudi Arabia', 'SA', 'SAU'),
(195, 'Senegal', 'SN', 'SEN'),
(196, 'Serbia', 'RS', 'SRB'),
(197, 'Seychelles', 'SC', 'SYC'),
(198, 'Sierra Leone', 'SL', 'SLE'),
(199, 'Singapore', 'SG', 'SGP'),
(200, 'Sint Maarten', 'SX', 'SXM'),
(201, 'Slovakia', 'SK', 'SVK'),
(202, 'Slovenia', 'SI', 'SVN'),
(203, 'Solomon Islands', 'SB', 'SLB'),
(204, 'Somalia', 'SO', 'SOM'),
(205, 'South Africa', 'ZA', 'ZAF'),
(206, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS'),
(207, 'South Korea', 'KR', 'KOR'),
(208, 'South Sudan', 'SS', 'SSD'),
(209, 'Spain', 'ES', 'ESP'),
(210, 'Sri Lanka', 'LK', 'LKA'),
(211, 'Sudan', 'SD', 'SDN'),
(212, 'Suriname', 'SR', 'SUR'),
(213, 'Svalbard and Jan Mayen', 'SJ', 'SJM'),
(214, 'Swaziland', 'SZ', 'SWZ'),
(215, 'Sweden', 'SE', 'SWE'),
(216, 'Switzerland', 'CH', 'CHE'),
(217, 'Syria', 'SY', 'SYR'),
(218, 'Taiwan', 'TW', 'TWN'),
(219, 'Tajikistan', 'TJ', 'TJK'),
(220, 'Tanzania', 'TZ', 'TZA'),
(221, 'Thailand', 'TH', 'THA'),
(222, 'Timor-Leste (East Timor)', 'TL', 'TLS'),
(223, 'Togo', 'TG', 'TGO'),
(224, 'Tokelau', 'TK', 'TKL'),
(225, 'Tonga', 'TO', 'TON'),
(226, 'Trinidad and Tobago', 'TT', 'TTO'),
(227, 'Tunisia', 'TN', 'TUN'),
(228, 'Turkey', 'TR', 'TUR'),
(229, 'Turkmenistan', 'TM', 'TKM'),
(230, 'Turks and Caicos Islands', 'TC', 'TCA'),
(231, 'Tuvalu', 'TV', 'TUV'),
(232, 'Uganda', 'UG', 'UGA'),
(233, 'Ukraine', 'UA', 'UKR'),
(234, 'United Arab Emirates', 'AE', 'ARE'),
(235, 'United Kingdom', 'GB', 'GBR'),
(236, 'United States', 'US', 'USA'),
(237, 'United States Minor Outlying Islands', 'UM', 'UMI'),
(238, 'Uruguay', 'UY', 'URY'),
(239, 'Uzbekistan', 'UZ', 'UZB'),
(240, 'Vanuatu', 'VU', 'VUT'),
(241, 'Vatican City', 'VA', 'VAT'),
(242, 'Venezuela', 'VE', 'VEN'),
(243, 'Vietnam', 'VN', 'VNM'),
(244, 'Virgin Islands, British', 'VG', 'VGB'),
(245, 'Virgin Islands, US', 'VI', 'VIR'),
(246, 'Wallis and Futuna', 'WF', 'WLF'),
(247, 'Western Sahara', 'EH', 'ESH'),
(248, 'Yemen', 'YE', 'YEM'),
(249, 'Zambia', 'ZM', 'ZMB'),
(250, 'Zimbabwe', 'ZW', 'ZWE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state`
--

CREATE TABLE `tbl_state` (
  `stateid` int(11) NOT NULL,
  `countryid` int(11) NOT NULL,
  `statename` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_state`
--

INSERT INTO `tbl_state` (`stateid`, `countryid`, `statename`, `status`) VALUES
(1, 2, 'Alabama', 1),
(2, 2, 'Alaska', 1),
(3, 2, 'Arizona', 1),
(4, 2, 'Arkansas', 1),
(5, 2, 'California', 1),
(6, 2, 'Florida', 1),
(7, 2, 'New Mexico', 1),
(8, 2, 'New York', 1),
(9, 2, 'Oklahoma', 1),
(10, 2, 'Texas', 1),
(11, 2, 'Virginia', 1),
(12, 1, 'Dhaka', 1),
(13, 1, 'Chittagong', 1),
(14, 1, 'Rajshahi', 1),
(15, 1, 'Khulna', 1),
(16, 1, 'Sylhet', 1),
(17, 1, 'Barishal', 1),
(18, 1, 'Rangpur', 1),
(19, 1, 'Mymensingh', 1),
(20, 4, 'West Bengal', 1),
(21, 4, 'Uttar Pradesh', 1),
(22, 4, 'Tripura', 1),
(23, 4, 'Telangana', 1),
(24, 4, 'Tamil Nadu', 1),
(25, 4, 'Sikkim', 1),
(26, 4, 'Rajasthan', 1),
(27, 4, 'Punjab', 1),
(28, 4, 'Odisha', 1),
(29, 4, 'Nagaland', 1),
(30, 4, 'Kerala', 1),
(31, 4, 'Haryana', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teammembers_tbl`
--

CREATE TABLE `teammembers_tbl` (
  `id` int(11) NOT NULL,
  `teammember_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `template_tbl`
--

CREATE TABLE `template_tbl` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `template_body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `template_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'sms, email & certificate',
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `template_tbl`
--

INSERT INTO `template_tbl` (`id`, `title`, `template_body`, `template_type`, `logo`, `signature`, `status`, `enterprise_id`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'Template 1', 'Body 1', 'sms', NULL, NULL, 1, '1', '1', '2021-06-23 05:50:21', '', NULL),
(2, 'Template 2', 'Body 2', 'email', NULL, NULL, 1, '1', '1', '2021-06-23 05:50:23', '', NULL),
(3, 'Certificate One', '<h1>[certificate_name]&nbsp; tester 2bd</h1>\r\n\r\n<p><img alt=\"\" src=\"&lt;?php echo base_url(\'application/modules/frontend/views/themes/default/assets/img/badge2.png\'); ?&gt;\" /></p>\r\n\r\n<p>[summary]</p>\r\n\r\n<h3>[name]</h3>\r\n\r\n<p>This is notified that <strong>[name]</strong> has been abled to gether knowledge of <strong>Corporate Administration</strong> fully, So we have no hesitation about him/her as a professional on <strong>12th December 2020</strong> in advernturer like as possible lorem ipsum.</p>\r\n\r\n<div class=\"pt-5 row\">\r\n<div class=\"col-md-4\">\r\n<p>[date]</p>\r\n\r\n<p>Date</p>\r\n</div>\r\n\r\n<div class=\"col-md-4 offset-md-4\">\r\n<h6>Director</h6>\r\n</div>\r\n</div>\r\n', 'certificate', 'assets/uploads/template/2022-01-12/3c6e0584c9ffa7e2ccb1931d109a9f37.png', 'assets/uploads/template/2022-01-12/f494692580a57ec998a1aa0ee8feae61.jpg', 1, '1', '1', '2022-03-27 16:05:40', '', NULL),
(5, 'Certificate Two', '<p><img alt=\"\" class=\"logocls\" src=\"[baseurl][logo]\" /></p>\r\n\r\n<h1>[certificate_name]</h1>\r\n\r\n<p>[summary]</p>\r\n\r\n<h3>[name]</h3>\r\n\r\n<p>This is notified that <strong>[name]</strong> has been abled to gether knowledge of <strong>Corporate Administration</strong> fully, So we have no hesitation about him/her as a professional on <strong>12th December 2020</strong> in advernturer like as possible lorem ipsum.</p>\r\n\r\n<div class=\"pt-5 row\">\r\n<div class=\"col-md-4\">\r\n<p>[date]</p>\r\n\r\n<p>Date</p>\r\n</div>\r\n\r\n<div class=\"col-md-4 offset-md-4\">\r\n<h6>Director</h6>\r\n</div>\r\n</div>\r\n', 'certificate', 'assets/uploads/template/certificate-logo-bg.png', 'assets/uploads/template/2022-01-03/04cde8af790425fa14caa164b1ec3b2c.png', 1, '1', '1', '2022-03-27 16:05:34', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `termscondition_tbl`
--

CREATE TABLE `termscondition_tbl` (
  `id` int(11) NOT NULL,
  `terms_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials_tbl`
--

CREATE TABLE `testimonials_tbl` (
  `id` int(11) NOT NULL,
  `testimonials_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `rating_number` int(11) NOT NULL,
  `user_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `designation` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `company_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `enterprise_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `testimonials_tbl`
--

INSERT INTO `testimonials_tbl` (`id`, `testimonials_id`, `title`, `description`, `rating_number`, `user_id`, `designation`, `company_image`, `status`, `enterprise_id`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'TS189BIJZ', 'Start streaming on-demand', 'Start streaming on-demand video lectures today from top level instructors Attention heatmaps.Start streaming on-demand video lectures today from top level instructors Attention heatmaps.', 5, 'ST1524Y1SN', 'Designation', '', 1, '1', '1', '2022-01-18 17:32:55', NULL, '2022-01-18 11:32:55');

-- --------------------------------------------------------

--
-- Table structure for table `themes_tbl`
--

CREATE TABLE `themes_tbl` (
  `id` int(11) NOT NULL,
  `theme_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `themes_tbl`
--

INSERT INTO `themes_tbl` (`id`, `theme_id`, `name`, `status`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'TH14DS', 'default', 1, '2019-12-13 17:00:00', '1', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `log_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `log_id`, `name`, `email`, `mobile_no`, `date_of_birth`, `address`, `image`, `status`, `is_admin`, `enterprise_id`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(17, '1', 'Admin', 'admin@gmail.com', '7879879834', '0000-00-00', 'Dhaka', 'assets/uploads/users/2022-01-03/d18c914018d20bc089fc61c60f9ac123.png', 1, 1, '', '', '2022-03-28 05:17:57', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_proficiency_tbl`
--

CREATE TABLE `user_proficiency_tbl` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `proficiency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `watch_time_tbl`
--

CREATE TABLE `watch_time_tbl` (
  `id` int(11) NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `real_time` varchar(200) DEFAULT NULL,
  `is_complete` int(11) DEFAULT NULL,
  `student_id` varchar(200) NOT NULL,
  `file_type` tinyint(4) DEFAULT NULL COMMENT '1=video ,0=textfile',
  `lesson_id` varchar(20) NOT NULL,
  `enterprise_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `watch_time_tbl`
--

INSERT INTO `watch_time_tbl` (`id`, `course_id`, `real_time`, `is_complete`, `student_id`, `file_type`, `lesson_id`, `enterprise_id`) VALUES
(46, 'CO27V632V', '600', 1, 'ST2793YBB6', 1, 'LE27R76LY', '1'),
(47, 'CO27V632V', '64.917', 0, 'ST09COMMOR', 1, 'LE27R76LY', '1');

-- --------------------------------------------------------

--
-- Table structure for table `zoomconfig_tbl`
--

CREATE TABLE `zoomconfig_tbl` (
  `id` int(11) NOT NULL,
  `zoom_api_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zoom_api_secret` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meetingid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meeting_password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `enterprise_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zoomconfig_tbl`
--

INSERT INTO `zoomconfig_tbl` (`id`, `zoom_api_key`, `zoom_api_secret`, `meetingid`, `meeting_password`, `status`, `enterprise_id`) VALUES
(1, 'PF_cFDVlS_ijX1ekIj1qAA', '4rU0FPREuY3zvwTes8oenfUTweHltj6ZYXfp', NULL, NULL, 1, ''),
(2, 'DGn_0JCfTA6sDS6W6-NS-Q', 'uabmS9lzuZ4loaOO3301dDgS8GomVyXHeQEW', NULL, NULL, 1, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutchoose_tbl`
--
ALTER TABLE `aboutchoose_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aboutinfo_tbl`
--
ALTER TABLE `aboutinfo_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `about_service_tbl`
--
ALTER TABLE `about_service_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `academic_ledger_tbl`
--
ALTER TABLE `academic_ledger_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activitylog_tbl`
--
ALTER TABLE `activitylog_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_certificate_tbl`
--
ALTER TABLE `assign_certificate_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_courseexam_tbl`
--
ALTER TABLE `assign_courseexam_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_tbl`
--
ALTER TABLE `category_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `certificate_mapping_tbl`
--
ALTER TABLE `certificate_mapping_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments_tbl`
--
ALTER TABLE `comments_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `communicate_tbl`
--
ALTER TABLE `communicate_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_tbl`
--
ALTER TABLE `company_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactus_tbl`
--
ALTER TABLE `contactus_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_history_tbl`
--
ALTER TABLE `coupon_history_tbl`
  ADD PRIMARY KEY (`coupon_invoice_id`);

--
-- Indexes for table `coupon_tbl`
--
ALTER TABLE `coupon_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coursequiz_tbl`
--
ALTER TABLE `coursequiz_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coursesave_tbl`
--
ALTER TABLE `coursesave_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_offers_tbl`
--
ALTER TABLE `course_offers_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_resource_tbl`
--
ALTER TABLE `course_resource_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_tbl`
--
ALTER TABLE `course_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`currencyid`);

--
-- Indexes for table `daily_watch_time_tbl`
--
ALTER TABLE `daily_watch_time_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education_tbl`
--
ALTER TABLE `education_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enterprise_tbl`
--
ALTER TABLE `enterprise_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_tbl`
--
ALTER TABLE `exam_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experience_tbl`
--
ALTER TABLE `experience_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_certificate_tbl`
--
ALTER TABLE `faculty_certificate_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_tbl`
--
ALTER TABLE `faculty_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_tbl`
--
ALTER TABLE `faq_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `featuredin_tbl`
--
ALTER TABLE `featuredin_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `following_tbl`
--
ALTER TABLE `following_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_category_tbl`
--
ALTER TABLE `forum_category_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_tbl`
--
ALTER TABLE `forum_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`forum_id`);

--
-- Indexes for table `gateway_tbl`
--
ALTER TABLE `gateway_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructor_ledger_tbl`
--
ALTER TABLE `instructor_ledger_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructor_paymentmethods_tbl`
--
ALTER TABLE `instructor_paymentmethods_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests_topics_tbl`
--
ALTER TABLE `interests_topics_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_tbl`
--
ALTER TABLE `invoice_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledger_tbl`
--
ALTER TABLE `ledger_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lesson_tbl`
--
ALTER TABLE `lesson_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_id` (`lesson_id`);

--
-- Indexes for table `library_tbl`
--
ALTER TABLE `library_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes_tbl`
--
ALTER TABLE `likes_tbl`
  ADD PRIMARY KEY (`likes_id`);

--
-- Indexes for table `loginfo_tbl`
--
ALTER TABLE `loginfo_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_config_tbl`
--
ALTER TABLE `mail_config_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting_participant_tbl`
--
ALTER TABLE `meeting_participant_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting_tbl`
--
ALTER TABLE `meeting_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_permission`
--
ALTER TABLE `module_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_module_id` (`fk_module_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indexes for table `notes_tbl`
--
ALTER TABLE `notes_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications_tbl`
--
ALTER TABLE `notifications_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_config_tbl`
--
ALTER TABLE `notification_config_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `payeer_config`
--
ALTER TABLE `payeer_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_method_tbl`
--
ALTER TABLE `payment_method_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_withdrawrequst_tbl`
--
ALTER TABLE `payment_withdrawrequst_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payu_config`
--
ALTER TABLE `payu_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paywith_tbl`
--
ALTER TABLE `paywith_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `picture_tbl`
--
ALTER TABLE `picture_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_id` (`from_id`);

--
-- Indexes for table `privacy_policy_tbl`
--
ALTER TABLE `privacy_policy_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proficiency_tbl`
--
ALTER TABLE `proficiency_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_assingment`
--
ALTER TABLE `project_assingment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_details_tbl`
--
ALTER TABLE `project_details_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_mark_details`
--
ALTER TABLE `project_mark_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_tbl`
--
ALTER TABLE `project_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pusherconfig_tbl`
--
ALTER TABLE `pusherconfig_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_exam_tbl`
--
ALTER TABLE `question_exam_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_option_tbl`
--
ALTER TABLE `question_option_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_tbl`
--
ALTER TABLE `question_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating_tbl`
--
ALTER TABLE `rating_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refund_policy_tbl`
--
ALTER TABLE `refund_policy_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section_tbl`
--
ALTER TABLE `section_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `sec_menu_item`
--
ALTER TABLE `sec_menu_item`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `sec_role_permission`
--
ALTER TABLE `sec_role_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sec_role_tbl`
--
ALTER TABLE `sec_role_tbl`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `sec_user_access_tbl`
--
ALTER TABLE `sec_user_access_tbl`
  ADD PRIMARY KEY (`role_acc_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slide_tbl`
--
ALTER TABLE `slide_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_gateway`
--
ALTER TABLE `sms_gateway`
  ADD PRIMARY KEY (`gateway_id`);

--
-- Indexes for table `socialauth_config_tbl`
--
ALTER TABLE `socialauth_config_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stripe_config`
--
ALTER TABLE `stripe_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_tbl`
--
ALTER TABLE `students_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribes_tbl`
--
ALTER TABLE `subscribes_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_course_tbl`
--
ALTER TABLE `subscription_course_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_pricing_tbl`
--
ALTER TABLE `subscription_pricing_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_tbl`
--
ALTER TABLE `subscription_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `synchronizer_setting`
--
ALTER TABLE `synchronizer_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_countries`
--
ALTER TABLE `tbl_countries`
  ADD PRIMARY KEY (`CountryID`);

--
-- Indexes for table `tbl_state`
--
ALTER TABLE `tbl_state`
  ADD PRIMARY KEY (`stateid`);

--
-- Indexes for table `teammembers_tbl`
--
ALTER TABLE `teammembers_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_tbl`
--
ALTER TABLE `template_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `termscondition_tbl`
--
ALTER TABLE `termscondition_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials_tbl`
--
ALTER TABLE `testimonials_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `themes_tbl`
--
ALTER TABLE `themes_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_proficiency_tbl`
--
ALTER TABLE `user_proficiency_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `watch_time_tbl`
--
ALTER TABLE `watch_time_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zoomconfig_tbl`
--
ALTER TABLE `zoomconfig_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutchoose_tbl`
--
ALTER TABLE `aboutchoose_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `aboutinfo_tbl`
--
ALTER TABLE `aboutinfo_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `about_service_tbl`
--
ALTER TABLE `about_service_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `academic_ledger_tbl`
--
ALTER TABLE `academic_ledger_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `activitylog_tbl`
--
ALTER TABLE `activitylog_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1917;

--
-- AUTO_INCREMENT for table `assign_certificate_tbl`
--
ALTER TABLE `assign_certificate_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assign_courseexam_tbl`
--
ALTER TABLE `assign_courseexam_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `category_tbl`
--
ALTER TABLE `category_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `certificate_mapping_tbl`
--
ALTER TABLE `certificate_mapping_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments_tbl`
--
ALTER TABLE `comments_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `communicate_tbl`
--
ALTER TABLE `communicate_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_tbl`
--
ALTER TABLE `company_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `contactus_tbl`
--
ALTER TABLE `contactus_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coupon_history_tbl`
--
ALTER TABLE `coupon_history_tbl`
  MODIFY `coupon_invoice_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupon_tbl`
--
ALTER TABLE `coupon_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coursequiz_tbl`
--
ALTER TABLE `coursequiz_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coursesave_tbl`
--
ALTER TABLE `coursesave_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `course_offers_tbl`
--
ALTER TABLE `course_offers_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_resource_tbl`
--
ALTER TABLE `course_resource_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=602;

--
-- AUTO_INCREMENT for table `course_tbl`
--
ALTER TABLE `course_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `currencyid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daily_watch_time_tbl`
--
ALTER TABLE `daily_watch_time_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `education_tbl`
--
ALTER TABLE `education_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `enterprise_tbl`
--
ALTER TABLE `enterprise_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_tbl`
--
ALTER TABLE `exam_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `experience_tbl`
--
ALTER TABLE `experience_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faculty_certificate_tbl`
--
ALTER TABLE `faculty_certificate_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faculty_tbl`
--
ALTER TABLE `faculty_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `faq_tbl`
--
ALTER TABLE `faq_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `featuredin_tbl`
--
ALTER TABLE `featuredin_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `following_tbl`
--
ALTER TABLE `following_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `forum_category_tbl`
--
ALTER TABLE `forum_category_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `forum_tbl`
--
ALTER TABLE `forum_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gateway_tbl`
--
ALTER TABLE `gateway_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `instructor_ledger_tbl`
--
ALTER TABLE `instructor_ledger_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructor_paymentmethods_tbl`
--
ALTER TABLE `instructor_paymentmethods_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `interests_topics_tbl`
--
ALTER TABLE `interests_topics_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=498;

--
-- AUTO_INCREMENT for table `invoice_tbl`
--
ALTER TABLE `invoice_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1333;

--
-- AUTO_INCREMENT for table `ledger_tbl`
--
ALTER TABLE `ledger_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lesson_tbl`
--
ALTER TABLE `lesson_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

--
-- AUTO_INCREMENT for table `library_tbl`
--
ALTER TABLE `library_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes_tbl`
--
ALTER TABLE `likes_tbl`
  MODIFY `likes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loginfo_tbl`
--
ALTER TABLE `loginfo_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=436;

--
-- AUTO_INCREMENT for table `mail_config_tbl`
--
ALTER TABLE `mail_config_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `meeting_participant_tbl`
--
ALTER TABLE `meeting_participant_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `meeting_tbl`
--
ALTER TABLE `meeting_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `module_permission`
--
ALTER TABLE `module_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notes_tbl`
--
ALTER TABLE `notes_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `notifications_tbl`
--
ALTER TABLE `notifications_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=795;

--
-- AUTO_INCREMENT for table `notification_config_tbl`
--
ALTER TABLE `notification_config_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payeer_config`
--
ALTER TABLE `payeer_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_method_tbl`
--
ALTER TABLE `payment_method_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payment_withdrawrequst_tbl`
--
ALTER TABLE `payment_withdrawrequst_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payu_config`
--
ALTER TABLE `payu_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paywith_tbl`
--
ALTER TABLE `paywith_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `picture_tbl`
--
ALTER TABLE `picture_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=549;

--
-- AUTO_INCREMENT for table `privacy_policy_tbl`
--
ALTER TABLE `privacy_policy_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proficiency_tbl`
--
ALTER TABLE `proficiency_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `project_assingment`
--
ALTER TABLE `project_assingment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `project_details_tbl`
--
ALTER TABLE `project_details_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `project_mark_details`
--
ALTER TABLE `project_mark_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `project_tbl`
--
ALTER TABLE `project_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pusherconfig_tbl`
--
ALTER TABLE `pusherconfig_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_exam_tbl`
--
ALTER TABLE `question_exam_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `question_option_tbl`
--
ALTER TABLE `question_option_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `question_tbl`
--
ALTER TABLE `question_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `rating_tbl`
--
ALTER TABLE `rating_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `refund_policy_tbl`
--
ALTER TABLE `refund_policy_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `section_tbl`
--
ALTER TABLE `section_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `sec_menu_item`
--
ALTER TABLE `sec_menu_item`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `sec_role_permission`
--
ALTER TABLE `sec_role_permission`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1204;

--
-- AUTO_INCREMENT for table `sec_role_tbl`
--
ALTER TABLE `sec_role_tbl`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sec_user_access_tbl`
--
ALTER TABLE `sec_user_access_tbl`
  MODIFY `role_acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `slide_tbl`
--
ALTER TABLE `slide_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms_gateway`
--
ALTER TABLE `sms_gateway`
  MODIFY `gateway_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `socialauth_config_tbl`
--
ALTER TABLE `socialauth_config_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stripe_config`
--
ALTER TABLE `stripe_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students_tbl`
--
ALTER TABLE `students_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `subscribes_tbl`
--
ALTER TABLE `subscribes_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subscription_course_tbl`
--
ALTER TABLE `subscription_course_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_pricing_tbl`
--
ALTER TABLE `subscription_pricing_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscription_tbl`
--
ALTER TABLE `subscription_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `synchronizer_setting`
--
ALTER TABLE `synchronizer_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_state`
--
ALTER TABLE `tbl_state`
  MODIFY `stateid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `teammembers_tbl`
--
ALTER TABLE `teammembers_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_tbl`
--
ALTER TABLE `template_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `termscondition_tbl`
--
ALTER TABLE `termscondition_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials_tbl`
--
ALTER TABLE `testimonials_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `themes_tbl`
--
ALTER TABLE `themes_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user_proficiency_tbl`
--
ALTER TABLE `user_proficiency_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `watch_time_tbl`
--
ALTER TABLE `watch_time_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `zoomconfig_tbl`
--
ALTER TABLE `zoomconfig_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
