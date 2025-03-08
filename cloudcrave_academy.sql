-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2025 at 10:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cloudcrave_academy`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `table_name` varchar(100) DEFAULT NULL,
  `action` enum('INSERT','UPDATE','DELETE') DEFAULT NULL,
  `description` text DEFAULT NULL,
  `action_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `certificate_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `issued_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `certificate_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages`
--

CREATE TABLE `cms_pages` (
  `page_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('Draft','Published','Archived') DEFAULT 'Draft'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_permissions`
--

CREATE TABLE `cms_permissions` (
  `permission_id` int(11) NOT NULL,
  `permission_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_roles`
--

CREATE TABLE `cms_roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_role_permissions`
--

CREATE TABLE `cms_role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_users`
--

CREATE TABLE `cms_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_user_roles`
--

CREATE TABLE `cms_user_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `discount_percentage` decimal(5,2) DEFAULT 0.00,
  `course_image_url` varchar(255) DEFAULT NULL,
  `intro_video_url` varchar(255) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `prerequisites` text DEFAULT NULL,
  `level` enum('Beginner','Intermediate','Advanced') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `home_featured` int(10) NOT NULL,
  `banner_featured` int(10) NOT NULL,
  `status` enum('Draft','Published','Approved') DEFAULT 'Draft',
  `instructor_id` int(11) DEFAULT NULL,
  `mode` enum('Virtual','Physical','Recorded') DEFAULT 'Virtual',
  `registration_deadline` date DEFAULT NULL,
  `session_duration` int(11) NOT NULL,
  `session_duration_unit` enum('minutes','hours') NOT NULL,
  `start_datetime` datetime DEFAULT NULL,
  `timezone` varchar(50) NOT NULL,
  `training_days` set('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `daily_start_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `category_id`, `description`, `price`, `discount_percentage`, `course_image_url`, `intro_video_url`, `duration`, `prerequisites`, `level`, `created_at`, `updated_at`, `home_featured`, `banner_featured`, `status`, `instructor_id`, `mode`, `registration_deadline`, `session_duration`, `session_duration_unit`, `start_datetime`, `timezone`, `training_days`, `daily_start_time`) VALUES
(1, 'Software Testing / Quality Assurance', 2, 'Software testing description and more', 0.00, 0.00, 'figma.jpg', 'image.jpg', 10, 'course prerequisites', 'Beginner', '2024-10-26 12:54:45', '2024-11-20 22:24:17', 1, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(2, 'Advance Excel and Data Analytics', 1, '\r\nThis course is aimed at people interested in Advance Excel and Data Analytics. We’ll start from the very beginning and work all the way through, step by step. If you already have some Advance Excel and Data Analytics experience but want to get up to speed using Adobe XD then this course is perfect for you too!\r\n\r\nFirst, we will go over the differences between UX and UI Design. We will look at what our brief for this real-world project is, then we will learn about low-fidelity wireframes and how to make use of existing UI design kits.\r\n<br>\r\nThis course is aimed at people interested in UI/UX Design. We’ll start from the very beginning and work all the way through, step by step. If you already have some UI/UX Design experience but want to get up to speed using Adobe XD then this course is perfect for you too!\r\n</p><p>\r\nFirst, we will go over the differences between UX and UI Design. We will look at what our brief for this real-world project is, then we will learn about low-fidelity wireframes and how to make use of existing UI design kits.\r\n<br><br>\r\nThis course is aimed at people interested in UI/UX Design. We’ll start from the very beginning and work all the way through, step by step. If you already have some UI/UX Design experience but want to get up to speed using Adobe XD then this course is perfect for you too!\r\n<br>\r\nFirst, we will go over the differences between UX and UI Design. We will look at what our brief for this real-world project is, then we will learn about low-fidelity wireframes and how to make use of existing UI design kits.', 100.00, 10.00, 'course_image.jpg', 'http://localhost/academy/course.php', 30, '<ul>\r\n                                    <li>Basic knowledge of computer.</li>\r\n                                    <li>Basic knowledge of Excel.</li>\r\n                                    <li>Learn to design websites.</li>\r\n                                    <li>Tools you need for best results.</li>\r\n                                    <li>How to plan for a video idea</li>\r\n                                    <li>How to use premade UI kits.</li>\r\n                                    <li>Differences between ads, trailers, vlogs,etc</li>\r\n                                 </ul>\r\n                                 <p>With this course, you also have access to a whole lot of resources not only for reference but\r\n                                    also free media like aerial video shots, background music, fonts, and more.</p>', 'Beginner', '2024-10-25 13:59:04', '2024-11-18 16:19:39', 1, 0, 'Published', 8, 'Virtual', '2024-10-31', 0, 'minutes', NULL, '', '', '00:00:00'),
(3, 'Software Development with PHP / MySQL', 2, 'Software Development with PHP / MySQL', 500.00, 25.00, 'ui-ux.jpg', 'https://www.youtube.com/embed/CAaMnm7NXY4', 12, 'The Current batch is already rounding up, and the next batch will be starting before the end of this month.\r\n\r\nThe Current batch is already rounding up, and the next batch will be starting before the end of this month.\r\n', 'Beginner', '2024-10-27 15:06:45', '2025-01-03 14:29:50', 1, 1, 'Approved', 8, 'Virtual', '2024-11-30', 0, 'minutes', '2025-01-25 13:15:39', 'GMT +1', 'Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday', '10:00:00'),
(4, 'Business Development and Analytics', 1, 'Business Development with PHP / MySQL', 600.00, 10.00, 'data_analytics.png', 'Software Development with PHP / MySQL', 12, 'pre', 'Beginner', '2024-10-27 15:06:45', '2024-11-17 22:50:18', 1, 0, 'Approved', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(6, 'BI Inteligence', NULL, 'BI InteligenceBI InteligenceBI Inteligence', 300.00, 10.00, NULL, '0', 5, 'BI InteligenceBI Inteligence', 'Intermediate', '2024-11-21 20:35:17', '2024-11-21 20:35:17', 0, 0, NULL, NULL, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(7, 'BI Inteligence', NULL, 'BI InteligenceBI InteligenceBI Inteligence', 300.00, 10.00, NULL, '0', 5, 'BI InteligenceBI Inteligence', 'Intermediate', '2024-11-21 20:36:46', '2024-11-21 20:36:46', 0, 0, NULL, NULL, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(8, 'BI Inteligence', NULL, 'BI InteligenceBI InteligenceBI Inteligence', 300.00, 10.00, NULL, '0', 5, 'BI InteligenceBI Inteligence', 'Intermediate', '2024-11-21 20:37:06', '2024-11-21 20:37:06', 0, 0, NULL, NULL, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(9, 'BI Inteligence', NULL, 'BI InteligenceBI InteligenceBI Inteligence', 300.00, 10.00, NULL, '0', 5, 'BI InteligenceBI Inteligence', 'Intermediate', '2024-11-21 20:38:35', '2024-11-21 20:38:35', 0, 0, NULL, NULL, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(10, 'BI Inteligence', NULL, 'BI InteligenceBI InteligenceBI Inteligence', 300.00, 10.00, NULL, '0', 5, 'BI InteligenceBI Inteligence', 'Intermediate', '2024-11-21 20:49:24', '2024-11-21 20:49:24', 0, 0, NULL, NULL, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(11, 'BI Inteligence', NULL, 'BI InteligenceBI InteligenceBI Inteligence', 300.00, 10.00, NULL, '0', 5, 'BI InteligenceBI Inteligence', 'Intermediate', '2024-11-21 20:51:06', '2024-11-21 20:51:06', 0, 0, NULL, NULL, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(12, 'BI Inteligence', NULL, 'BI InteligenceBI InteligenceBI Inteligence', 300.00, 10.00, NULL, '0', 5, 'BI InteligenceBI Inteligence', 'Intermediate', '2024-11-21 20:52:17', '2024-11-21 20:52:17', 0, 0, NULL, 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(15, 'BI Inteligence one', NULL, 'BI InteligenceBI InteligenceBI Inteligence', 300.00, 10.00, NULL, '0', 6, 'BI InteligenceBI Inteligence', 'Advanced', '2024-11-21 21:03:59', '2024-11-21 21:03:59', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(16, 'BI Inteligence one', 1, 'BI InteligenceBI InteligenceBI Inteligence', 300.00, 10.00, NULL, '0', 6, 'BI InteligenceBI Inteligence', 'Advanced', '2024-11-21 21:11:30', '2024-11-21 21:11:30', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(17, 'BI Inteligence one', 1, 'BI InteligenceBI InteligenceBI Inteligence', 300.00, 10.00, NULL, 'videos/class.mp4', 6, 'BI InteligenceBI Inteligence', 'Advanced', '2024-11-21 21:35:06', '2024-11-21 21:35:06', 0, 0, 'Draft', NULL, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(18, 'LinkedIn Optimization', 3, 'LinkedIn optimization is the process of improving your LinkedIn profile to help you achieve your professional goals.', 100.00, 5.00, 'BI_Data_Analytics.png', 'class.mp4', 2, 'LinkedIn optimization is to achieve your professional goals', 'Intermediate', '2024-11-21 21:37:46', '2024-11-21 21:42:14', 0, 0, 'Approved', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(19, 'LinkedIn Optimization', 3, 'LinkedIn optimization is the process of improving your LinkedIn profile to help you achieve your professional goals.', 100.00, 5.00, 'assets/uploads/courses/BI_Data_Analytics.png', 'videos/class.mp4', 2, 'LinkedIn optimization is to achieve your professional goals', 'Intermediate', '2024-11-21 21:45:04', '2024-11-21 21:45:04', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(20, 'Cloud Computing & DevOps', 2, 'Embark on a transformative journey into the world of cloud computing and DevOps with our Comprehensive Cloud Computing and DevOps Bootcamp. This intensive 12-week program is designed to equip you with the essential knowledge and practical skills needed to excel in today\'s rapidly evolving tech landscape.\r\n\r\nIn this bootcamp, you will delve deep into cloud computing concepts, exploring the benefits, service models, and architecture of major cloud providers such as AWS, Azure, and Google Cloud. Through hands-on exercises and real-world scenarios, you will gain proficiency in provisioning and managing cloud resources, implementing security measures, and optimizing cost management strategies.', 500.00, 10.00, '2024_03_12_014609cloud.png', 'class.mp4', 12, 'Cloud Concepts', 'Intermediate', '2024-11-21 22:11:47', '2024-11-21 22:22:53', 1, 0, 'Approved', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(21, 'Cloud Computing & DevOps with Microsoft Azure', 2, 'Cloud Computing & DevOps with Microsoft Azure', 300.00, 5.00, '673fbd2b99224_2024_03_12_014609cloud.png', '673fbd2b9903e_class.mp4', 4, 'Microsoft suite', 'Beginner', '2024-11-21 23:07:23', '2024-11-21 23:07:23', 0, 0, 'Draft', NULL, 'Virtual', '0000-00-00', 0, 'minutes', NULL, '', '', '00:00:00'),
(22, 'Cloud Computing & DevOps with Microsoft Azure', 2, 'Cloud Computing & DevOps with Microsoft Azure', 300.00, 5.00, '2024_03_12_014609cloud.png', 'class.mp4', 4, 'Microsoft suite', 'Beginner', '2024-11-21 23:11:51', '2024-11-21 23:11:51', 0, 0, 'Draft', NULL, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(23, 'Cloud Computing & DevOps with Microsoft Azure', 2, 'Cloud Computing & DevOps with Microsoft Azure', 300.00, 5.00, '2024_03_12_014609cloud.png', 'class.mp4', 4, 'Microsoft suite', 'Beginner', '2024-11-21 23:18:49', '2024-11-21 23:18:49', 0, 0, 'Draft', NULL, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(24, 'Cloud Computing & DevOps with Microsoft Azure', 2, 'Cloud Computing & DevOps with Microsoft Azure', 300.00, 5.00, '2024_03_12_014609cloud.png', 'class.mp4', 4, 'Microsoft suite', 'Beginner', '2024-11-21 23:21:15', '2024-11-21 23:21:15', 0, 0, 'Draft', NULL, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(25, 'Cloud Computing & DevOps with Microsoft Azure', 2, 'Cloud Computing & DevOps with Microsoft Azure', 300.00, 5.00, '2024_03_12_014609cloud.png', 'class.mp4', 4, 'Microsoft suite', 'Beginner', '2024-11-21 23:22:47', '2024-11-21 23:22:47', 0, 0, 'Draft', NULL, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(26, 'Cloud Computing & DevOps with Microsoft Azure', 2, 'Cloud Computing & DevOps with Microsoft Azure', 300.00, 5.00, '2024_03_12_014609cloud.png', 'class.mp4', 4, 'Microsoft suite', 'Beginner', '2024-11-21 23:25:01', '2024-11-21 23:25:01', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(27, 'LinkedIn Optimization Advance Level', 3, 'LinkedIn Optimization Advance Level', 300.00, 20.00, 'BI_Data_Analytics.png', 'ccs_vid.mp4', 2, 'LinkedIn Optimization Advance Level', 'Advanced', '2024-11-21 23:37:59', '2024-11-21 23:37:59', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(28, 'LinkedIn Optimization Advance Level', 3, 'LinkedIn Optimization Advance Level', 300.00, 20.00, 'BI_Data_Analytics.png', 'ccs_vid.mp4', 2, 'LinkedIn Optimization Advance Level', 'Advanced', '2024-11-21 23:43:12', '2024-11-21 23:43:12', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(29, 'LinkedIn Optimization Advance Level', 3, 'LinkedIn Optimization Advance Level', 300.00, 20.00, 'BI_Data_Analytics.png', 'ccs_vid.mp4', 2, 'LinkedIn Optimization Advance Level', 'Advanced', '2024-11-21 23:44:44', '2024-11-21 23:44:44', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(30, 'LinkedIn Optimization Advance Level', 3, 'LinkedIn Optimization Advance Level', 300.00, 20.00, 'BI_Data_Analytics.png', 'ccs_vid.mp4', 2, 'LinkedIn Optimization Advance Level', 'Advanced', '2024-11-21 23:46:06', '2024-11-21 23:46:06', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(31, 'LinkedIn Optimization Advance Level', 3, 'LinkedIn Optimization Advance Level', 300.00, 20.00, 'BI_Data_Analytics.png', 'ccs_vid.mp4', 2, 'LinkedIn Optimization Advance Level', 'Advanced', '2024-11-21 23:51:52', '2024-11-21 23:51:52', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(32, 'Generative Ai and ChatGPT Management', 2, 'Ai and ChatGPT Management', 120.00, 10.00, 'Generative-AI-1536x864.jpg', 'ccs_vid.mp4', 2, 'Ai and ChatGPT Management', 'Beginner', '2024-11-23 10:10:55', '2024-11-23 10:10:55', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(33, 'Generative Ai and ChatGPT Management', 2, 'Ai and ChatGPT Management', 120.00, 10.00, 'Generative-AI-1536x864.jpg', 'ccs_vid.mp4', 2, 'Ai and ChatGPT Management', 'Beginner', '2024-11-23 10:30:51', '2024-11-23 10:30:51', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(34, 'Generative Ai and ChatGPT Management', 2, 'Ai and ChatGPT Management', 120.00, 10.00, 'Generative-AI-1536x864.jpg', 'ccs_vid.mp4', 2, 'Ai and ChatGPT Management', 'Beginner', '2024-11-23 10:31:13', '2024-11-23 10:31:13', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(35, 'Generative Ai and ChatGPT Management', 2, 'Ai and ChatGPT Management', 120.00, 10.00, 'Generative-AI-1536x864.jpg', 'ccs_vid.mp4', 2, 'Ai and ChatGPT Management', 'Beginner', '2024-11-23 10:32:16', '2024-11-23 10:32:16', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(36, 'Generative Ai and ChatGPT Management', 2, 'Ai and ChatGPT Management', 120.00, 10.00, 'Generative-AI-1536x864.jpg', 'ccs_vid.mp4', 2, 'Ai and ChatGPT Management', 'Beginner', '2024-11-23 10:35:42', '2024-11-23 10:35:42', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(37, 'Generative Ai and ChatGPT Management', 2, 'Ai and ChatGPT Management', 120.00, 10.00, 'Generative-AI-1536x864.jpg', 'ccs_vid.mp4', 2, 'Ai and ChatGPT Management', 'Beginner', '2024-11-23 10:39:14', '2024-11-23 10:39:14', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(38, 'Generative Ai and ChatGPT Management', 2, 'Ai and ChatGPT Management', 120.00, 10.00, 'Generative-AI-1536x864.jpg', 'ccs_vid.mp4', 2, 'Ai and ChatGPT Management', 'Beginner', '2024-11-23 10:40:59', '2024-11-23 10:40:59', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(39, 'Generative Ai and ChatGPT Management', 2, 'Ai and ChatGPT Management', 120.00, 10.00, 'Generative-AI-1536x864.jpg', 'ccs_vid.mp4', 2, 'Ai and ChatGPT Management', 'Beginner', '2024-11-23 10:47:02', '2024-11-23 10:47:02', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(40, 'Digital Marketing and Social Media Management', 1, 'Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'Bj_Agoro.mp4', 4, 'Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 11:23:59', '2024-11-23 11:23:59', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(41, 'Digital Marketing and Social Media Management', 1, 'Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'Bj_Agoro.mp4', 4, 'Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 11:26:57', '2024-11-23 11:26:57', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(42, 'Digital Marketing and Social Media Management', 1, 'Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'Bj_Agoro.mp4', 4, 'Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 11:31:02', '2024-11-23 11:31:02', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(43, 'Digital Marketing and Social Media Management', 1, 'Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'Bj_Agoro.mp4', 4, 'Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 11:32:20', '2024-11-23 11:32:20', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(44, 'Digital Marketing and Social Media Management', 1, 'Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'Bj_Agoro.mp4', 4, 'Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 11:34:18', '2024-11-23 11:34:18', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(45, 'Digital Marketing and Social Media Management', 1, 'Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'Bj_Agoro.mp4', 4, 'Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 12:55:18', '2024-11-23 12:55:18', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(46, 'Digital Marketing and Social Media Management', 1, 'Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'Bj_Agoro.mp4', 4, 'Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 13:25:47', '2024-11-23 13:25:47', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(47, 'Digital Marketing and Social Media Management', 1, 'Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'Bj_Agoro.mp4', 4, 'Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 13:54:46', '2024-11-23 14:06:15', 1, 0, 'Approved', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(48, 'Digital Marketing and Social Media Management', 1, 'Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'Bj_Agoro.mp4', 4, 'Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 14:35:11', '2024-11-23 14:35:11', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(49, 'Digital Marketing and Social Media Management', 1, 'Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'Bj_Agoro.mp4', 4, 'Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 14:36:32', '2024-11-23 14:36:32', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(50, 'Digital Marketing and Social Media Management', 1, 'Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'Bj_Agoro.mp4', 4, 'Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 14:37:26', '2024-11-23 14:37:26', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(51, 'Digital Marketing and Social Media Management', 1, 'Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'Bj_Agoro.mp4', 4, 'Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 14:39:13', '2024-11-23 14:39:13', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(52, 'Digital Marketing and Social Media Management', 1, 'Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'Bj_Agoro.mp4', 4, 'Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 14:41:32', '2024-11-23 14:41:32', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(53, 'Digital Marketing and Social Media Management', 1, 'Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'Bj_Agoro.mp4', 4, 'Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 14:43:03', '2024-11-23 14:43:03', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(54, 'Digital Marketing and Social Media Management', 1, 'Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'Bj_Agoro.mp4', 4, 'Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 14:44:35', '2024-11-23 14:44:35', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(55, 'Digital Marketing and Social Media Management', 1, 'Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'Bj_Agoro.mp4', 4, 'Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 14:46:37', '2024-11-23 14:46:37', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(56, 'Digital Marketing and Social Media Management', 1, 'Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'Bj_Agoro.mp4', 4, 'Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 14:56:47', '2024-11-23 14:56:47', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(57, 'Digital Marketing and Social Media Management', 1, 'Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'Bj_Agoro.mp4', 4, 'Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 14:57:51', '2024-11-23 14:57:51', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(58, 'Digital Marketing and Social Media Management', 1, 'Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'Bj_Agoro.mp4', 4, 'Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 15:15:52', '2024-11-23 15:15:52', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(59, 'Digital Marketing and Social Media Management', 1, 'Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'Bj_Agoro.mp4', 4, 'Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 15:17:37', '2024-11-23 15:17:37', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(60, 'Digital Marketing and Social Media Management', 1, 'Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'Bj_Agoro.mp4', 4, 'Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 15:18:58', '2024-11-23 15:18:58', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(61, 'Digital Marketing and Social Media Management', 1, 'Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'Bj_Agoro.mp4', 4, 'Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 15:21:03', '2024-11-23 15:21:03', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(62, 'Digital Marketing and Social Media Management', 1, 'Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'Bj_Agoro.mp4', 4, 'Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 15:22:54', '2024-11-23 15:22:54', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(63, 'Q Digital Marketing and Social Media Management', 2, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'Bj_Agoro.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 15:27:41', '2024-11-23 15:27:41', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(64, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 15:45:38', '2024-11-23 15:45:38', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(65, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 15:50:25', '2024-11-23 15:50:25', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(66, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 15:57:21', '2024-11-23 15:57:21', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(67, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 15:59:08', '2024-11-23 15:59:08', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(68, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 16:00:31', '2024-11-23 16:00:31', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(69, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 16:06:30', '2024-11-23 16:06:30', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(70, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-23 16:17:47', '2024-11-23 16:17:47', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(71, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-24 13:56:03', '2024-11-24 13:56:03', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(72, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-24 13:59:40', '2024-11-24 13:59:40', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(73, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-24 14:02:04', '2024-11-24 14:02:04', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(74, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-24 14:03:59', '2024-11-24 14:03:59', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(75, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-24 14:07:44', '2024-11-24 14:07:44', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(76, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-24 14:08:43', '2024-11-24 14:08:43', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(77, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-24 14:09:45', '2024-11-24 14:09:45', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(78, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-25 22:35:17', '2024-11-25 22:35:17', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(79, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-25 22:36:38', '2024-11-25 22:36:38', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(80, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-25 22:38:46', '2024-11-25 22:38:46', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(81, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-25 22:41:01', '2024-11-25 22:41:01', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(82, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-25 22:41:25', '2024-11-25 22:41:25', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(83, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-25 23:53:04', '2024-11-25 23:53:04', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(84, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-25 23:54:21', '2024-11-25 23:54:21', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(85, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-25 23:55:15', '2024-11-25 23:55:15', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(86, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-26 00:00:49', '2024-11-26 00:00:49', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(87, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-26 00:22:02', '2024-11-26 00:22:02', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(88, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-26 00:22:08', '2024-11-26 00:22:08', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(89, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-26 00:24:05', '2024-11-26 00:24:05', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(90, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-26 00:24:32', '2024-11-26 00:24:32', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(91, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-11-26 00:27:40', '2024-11-26 00:27:40', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(92, 'Q Digital Marketing and Social Media Management', 1, 'Q Digital Marketing and Social Media Management', 120.00, 10.00, 'Digital_images.jpeg', 'class.mp4', 4, 'Q Digital Marketing and Social Media Management', 'Beginner', '2024-12-04 19:20:50', '2024-12-04 19:20:50', 0, 0, 'Draft', 8, 'Virtual', '2024-11-28', 0, 'minutes', NULL, '', '', '00:00:00'),
(93, 'Cloud Computing & DevOps', 9, 'this is the test description', 300.00, 20.00, '2024_03_12_014609cloud.png', 'class.mp4', 12, 'Azure\r\nAWS and more', 'Advanced', '2024-12-17 18:32:56', '2024-12-17 18:32:56', 0, 0, 'Draft', 8, 'Virtual', NULL, 0, 'minutes', NULL, '', '', '00:00:00'),
(94, 'Cloud Computing & DevOps', 9, 'this is the test description', 300.00, 20.00, '2024_03_12_014609cloud.png', 'class.mp4', 12, 'Azure\r\nAWS and more', 'Advanced', '2024-12-17 19:00:01', '2024-12-17 19:00:01', 0, 0, 'Draft', 8, 'Virtual', NULL, 0, 'minutes', NULL, '', '', '00:00:00'),
(95, 'DevOps Fundamentals', 2, 'this is the real deal when tLKING ABOUT dEVoPS', 120.00, 10.00, 'BI_Data_Analytics.png', 'class.mp4', 7, 'aPPRICIATION\r\nCOMPUTER SOFTWARE', 'Beginner', '2024-12-17 19:04:44', '2024-12-17 19:04:44', 0, 0, 'Draft', 8, 'Virtual', NULL, 0, 'minutes', NULL, '', '', '00:00:00'),
(96, 'Cloud Computing & DevOps', 9, 'this is the test description', 300.00, 20.00, '2024_03_12_014609cloud.png', 'class.mp4', 12, 'Azure\r\nAWS and more', 'Advanced', '2024-12-17 20:16:54', '2024-12-17 20:16:54', 0, 0, 'Draft', NULL, 'Virtual', NULL, 120, 'minutes', '2025-01-04 00:00:00', 'GMT', 'Tuesday,Thursday,Sunday', '12:30:00'),
(97, 'Machine Learning using Python', 2, 'The learner should have had about 150 hours of instructions and/or hands-on practice sessions\r\nlasting for 2 hours, to reinforce core concepts of ML and its vast applications in BigData mining, analytics, and process flow automation using Python as the\r\ninteractive language to enable interoperability between modules and frameworks. To the end that scalable solutions are delivered to client-side to\r\noptimize and improve real-time output and', 600.00, 15.00, 'MLwithPython.png', 'class.mp4', 12, 'Understanding of Computer\r\nDigital transformation\r\nother things', 'Beginner', '2024-12-17 20:30:34', '2024-12-17 20:30:34', 0, 0, 'Draft', NULL, 'Virtual', NULL, 120, 'minutes', '2025-01-04 10:00:00', 'GMT', 'Monday,Wednesday,Friday', '12:30:00'),
(98, 'Machine Learning using Python', 2, 'The learner should have had about 150 hours of instructions and/or hands-on practice sessions\r\nlasting for 2 hours, to reinforce core concepts of ML and its vast applications in BigData mining, analytics, and process flow automation using Python as the\r\ninteractive language to enable interoperability between modules and frameworks. To the end that scalable solutions are delivered to client-side to\r\noptimize and improve real-time output and', 600.00, 15.00, 'MLwithPython.png', 'class.mp4', 12, 'Understanding of Computer\r\nDigital transformation\r\nother things', 'Beginner', '2024-12-17 20:45:12', '2024-12-17 20:45:12', 0, 0, 'Draft', NULL, 'Virtual', NULL, 120, 'minutes', '2025-01-04 10:00:00', 'GMT', 'Monday,Wednesday,Friday', '12:30:00'),
(99, 'Machine Learning using Python', 2, 'The learner should have had about 150 hours of instructions and/or hands-on practice sessions\r\nlasting for 2 hours, to reinforce core concepts of ML and its vast applications in BigData mining, analytics, and process flow automation using Python as the\r\ninteractive language to enable interoperability between modules and frameworks. To the end that scalable solutions are delivered to client-side to\r\noptimize and improve real-time output and', 600.00, 15.00, 'MLwithPython.png', 'class.mp4', 12, 'Understanding of Computer\r\nDigital transformation\r\nother things', 'Beginner', '2024-12-17 20:47:40', '2024-12-17 20:47:40', 0, 0, 'Draft', 8, 'Virtual', NULL, 120, 'minutes', '2025-01-04 10:00:00', 'GMT', 'Monday,Wednesday,Friday', '12:30:00'),
(100, 'Machine Learning using Python', 2, 'The learner should have had about 150 hours of instructions and/or hands-on practice sessions\r\nlasting for 2 hours, to reinforce core concepts of ML and its vast applications in BigData mining, analytics, and process flow automation using Python as the\r\ninteractive language to enable interoperability between modules and frameworks. To the end that scalable solutions are delivered to client-side to\r\noptimize and improve real-time output and', 600.00, 15.00, 'MLwithPython.png', 'class.mp4', 12, 'Understanding of Computer\r\nDigital transformation\r\nother things', 'Beginner', '2024-12-17 20:57:09', '2024-12-17 20:57:09', 0, 0, 'Draft', 8, 'Virtual', NULL, 120, 'minutes', '2025-01-04 10:00:00', 'GMT', 'Monday,Wednesday,Friday', '12:30:00'),
(101, 'Project Management Principles', 16, 'project management course description and so much more. project management course description and so much more. project management course description and so much more. project management course description and so much more. project management course description and so much more. project management course description and so much more. project management course description and so much more. ', 120.00, 10.00, 'Digital_images.jpeg', 'ccs_vid.mp4', 12, 'Tech beginners\r\nLoad balancers and cringe\r\nthe main koko and meming song', 'Beginner', '2024-12-18 20:40:13', '2024-12-18 20:40:13', 0, 0, 'Draft', 8, 'Virtual', NULL, 40, 'minutes', '2024-12-14 10:00:00', 'GMT', 'Saturday,Sunday', '10:05:00'),
(102, 'Q Digital Marketing and Social Media Management', 2, 'From Learning Tree, this course teaches how to use Excel features to make business decisions, analyze data, and automate processes \r\n', 120.00, 10.00, 'course_image.jpg', 'class.mp4', 4, 'From Learning Tree, this course teaches how to use Excel features to make business decisions, analyze data, and automate processes \r\n', 'Intermediate', '2025-01-06 15:53:40', '2025-01-06 15:53:40', 0, 0, 'Draft', 8, 'Virtual', NULL, 8, 'minutes', '2025-01-15 16:53:00', 'GMT', 'Saturday,Sunday', '18:55:00'),
(103, 'BI Inteligence Pro', 1, 'details details', 300.00, 10.00, '1731324975_Data_Analytics.png', 'class.mp4', 4, 'Course Prerequisites Course Prerequisites', 'Intermediate', '2025-01-24 11:05:44', '2025-01-24 11:05:44', 0, 0, 'Draft', 8, 'Virtual', NULL, 60, 'minutes', '2025-02-01 14:06:00', 'GMT', 'Saturday,Sunday', '14:06:00'),
(104, 'BI Inteligence Pro', 1, 'details details', 300.00, 10.00, '1731324975_Data_Analytics.png', 'class.mp4', 4, 'Course Prerequisites Course Prerequisites', 'Intermediate', '2025-01-24 11:07:13', '2025-01-24 11:07:13', 0, 0, 'Draft', 8, 'Virtual', NULL, 60, 'minutes', '2025-02-01 14:06:00', 'GMT', 'Saturday,Sunday', '14:06:00'),
(105, 'AI for Beginner', 1, 'About AI for Beginner', 100.00, 10.00, '124669.jpg', 'futuristic smart home interior design_preview.mp4', 6, 'Course Prerequisites for AI for Beginner', 'Beginner', '2025-02-06 20:24:06', '2025-02-06 20:24:06', 0, 0, 'Draft', 8, 'Virtual', NULL, 60, 'minutes', '2025-03-01 22:00:00', 'GMT', 'Saturday,Sunday', '10:00:00'),
(106, 'AI for Beginner', 1, 'About AI for Beginner', 100.00, 10.00, '124669.jpg', 'futuristic smart home interior design_preview.mp4', 6, 'Course Prerequisites for AI for Beginner', 'Beginner', '2025-02-06 20:24:48', '2025-02-06 20:24:48', 0, 0, 'Draft', 8, 'Virtual', NULL, 60, 'minutes', '2025-03-01 22:00:00', 'GMT', 'Saturday,Sunday', '10:00:00'),
(107, 'AI for Beginner', 1, 'About AI for Beginner', 100.00, 10.00, '124669.jpg', 'futuristic smart home interior design_preview.mp4', 6, 'Course Prerequisites for AI for Beginner', 'Beginner', '2025-02-06 20:26:25', '2025-02-06 20:26:25', 0, 0, 'Draft', 8, 'Virtual', NULL, 60, 'minutes', '2025-03-01 22:00:00', 'GMT', 'Saturday,Sunday', '10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `coursex`
--

CREATE TABLE `coursex` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `level` enum('Beginner','Intermediate','Advanced') DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_categories`
--

CREATE TABLE `course_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_categories`
--

INSERT INTO `course_categories` (`category_id`, `category_name`, `description`) VALUES
(1, 'Data Managemnt', 'Data Management related Courses'),
(2, 'Development', 'Does anyone have recommendations for good online courses on different aspects of software development?'),
(3, 'Career Development', 'Career development'),
(4, 'Web Development', 'Learn to build modern, responsive websites using HTML, CSS, JavaScript, and popular frameworks like React, Angular, and Vue.'),
(5, 'Mobile App Development', 'Develop mobile applications for iOS and Android platforms using tools like Flutter, React Native, and Kotlin.'),
(6, 'Data Analytics', 'Learn data analysis techniques, visualization, and tools like Excel, SQL, Power BI, and Tableau.'),
(7, 'Data Science', 'Master data science techniques with Python, R, and machine learning libraries for real-world data solutions.'),
(8, 'Cybersecurity', 'Understand ethical hacking, network security, and protecting systems against cyber threats.'),
(9, 'Cloud Computing', 'Explore cloud services like AWS, Microsoft Azure, and Google Cloud for infrastructure and deployment.'),
(10, 'DevOps', 'Learn CI/CD, containerization with Docker, Kubernetes, and automation tools like Jenkins.'),
(11, 'UI/UX Design', 'Create user-friendly interfaces with user research, prototyping, and design tools like Figma and Adobe XD.'),
(12, 'Blockchain Development', 'Learn to build decentralized applications, smart contracts, and blockchain networks.'),
(13, 'Artificial Intelligence', 'Explore AI concepts such as machine learning, deep learning, NLP, and computer vision.'),
(14, 'Software Testing / Quality Assurance', 'Gain expertise in manual testing, automation testing, and performance testing tools.'),
(15, 'Digital Marketing', 'Master online marketing techniques including SEO, SEM, content marketing, and social media strategies.'),
(16, 'Project Management', 'Learn agile, scrum methodologies, and project management tools like Jira and Trello.'),
(17, 'Business Analysis', 'Understand business processes, requirements gathering, and tools for analysis.'),
(18, 'Game Development', 'Create engaging video games with tools like Unity, Unreal Engine, and Blender.'),
(19, 'Networking & IT Infrastructure', 'Learn network configuration, administration, and IT support techniques.');

-- --------------------------------------------------------

--
-- Table structure for table `course_curriculum`
--

CREATE TABLE `course_curriculum` (
  `curriculum_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `order_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_curriculum`
--

INSERT INTO `course_curriculum` (`curriculum_id`, `course_id`, `title`, `description`, `order_number`) VALUES
(1, 2, 'Introduction and Excel for Data Analysis', 'Introduction and Excel for Data Analysis', NULL),
(2, 2, 'Statistical Analysis and Inference', 'Statistical Analysis and Inference', NULL),
(3, 2, 'Data Visualization and EDA', 'Data Visualization and EDA', NULL),
(4, 2, 'Data Collection, Cleaning, and SQL Basics', 'Data Collection, Cleaning, and SQL Basics', NULL),
(5, 2, 'Real-World Projects and Case Studies', 'Real-World Projects and Case Studies', NULL),
(6, 2, 'Capstone Project and Final Review', 'Capstone Project and Final Review', NULL),
(7, 47, 'Interlocution to the course Gan gan', 'Interlocution to the course Gan ganInterlocution to the course Gan ganInterlocution to the course Gan ganInterlocution to the course Gan ganInterlocution to the course Gan ganInterlocution to the course Gan gan', 1),
(8, 47, 'The secont on the list Gan gan gan', 'The secont on the list Gan gan gan, The secont on the list Gan gan gan, The secont on the list Gan gan gan', 2),
(9, 47, 'The Code contains a series of statements', 'The Code contains a series of statements that taken\r\ntogether signify what good practice by nurses, midwives\r\nand nursing associates looks like. It puts the interests of\r\npatients and service users first, is safe and effective, and\r\npromotes trust through professionalism.', 3),
(10, 55, 'test title', 'test cur description', 1),
(11, 55, 'test second title', 'second description', 2),
(12, 1, 'The online introduction', 'the description og the on;ine ', NULL),
(14, 1, 'the service level manager in', 'the service level manager in, the service level manager in, the service level manager in', NULL),
(15, 1, 'qwqw', 'qeqe', NULL),
(16, 86, 'Introduvtion to the course', 'This is the first session to sturdy. it is quite interesting to learn and understand', NULL),
(18, 89, 'test ooo', 'testooo', NULL),
(19, 99, 'introduction', 'Deep Dive into the vast realm of computational thinking', NULL),
(20, 99, 'Whetting your appetite', 'BigData? What’s that?', NULL),
(21, 103, 'Test curri', 'curri details', NULL),
(22, 103, 'test curry again', 'test curry again details', NULL),
(23, 105, 'AI for Beginner', 'AI for BeginnerAI for BeginnerAI for BeginnerAI for Beginner', NULL),
(24, 105, 'AI for Beginner 2', 'AI for Beginner AI for Beginner', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_instructors`
--

CREATE TABLE `course_instructors` (
  `course_id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_lessons`
--

CREATE TABLE `course_lessons` (
  `lesson_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `curriculum_id` int(11) DEFAULT NULL,
  `lesson_title` varchar(255) NOT NULL,
  `lesson_content` text DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `lesson_order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_lessons`
--

INSERT INTO `course_lessons` (`lesson_id`, `course_id`, `curriculum_id`, `lesson_title`, `lesson_content`, `video_url`, `duration`, `created_at`, `updated_at`, `lesson_order`) VALUES
(1, 2, 1, 'Introduction to Data Analytics', 'Introduction to Data Analytics', 'Introduction to Data Analytics', 30, '2024-10-28 14:23:38', '2024-10-29 14:23:38', NULL),
(2, 2, 1, 'Overview of Data Analytics', 'Overview of Data Analytics', 'Overview of Data Analytics', 20, '2024-10-28 14:23:38', '2024-10-29 14:23:38', NULL),
(3, 2, 1, 'The Data Analytics Process', 'The Data Analytics Process', 'The Data Analytics Process', 25, '2024-10-28 14:26:16', '2024-10-29 14:26:16', NULL),
(4, 2, 1, 'Key Concepts and Terminology', 'Key Concepts and Terminology', 'Key Concepts and Terminology', 20, '2024-10-28 14:26:16', '2024-10-29 14:26:16', NULL),
(5, 2, 2, 'Introduction to Statistics', 'Introduction to Statistics', 'Introduction to Statistics', 30, '2024-10-28 14:29:08', '2024-10-29 14:29:08', NULL),
(6, 2, 2, 'Descriptive vs. Inferential Statistics', 'Descriptive vs. Inferential Statistics', 'Descriptive vs. Inferential Statistics', 40, '2024-10-28 14:29:08', '2024-10-29 14:29:08', NULL),
(7, 2, 2, 'Measures of Central Tendency and Dispersion', 'Measures of Central Tendency and Dispersion', 'Measures of Central Tendency and Dispersion', 25, '2024-10-28 14:30:34', '2024-10-29 14:30:34', NULL),
(8, 2, 2, 'Statistical Inference', 'Statistical Inference', '', 20, '2024-10-28 14:30:34', '2024-10-29 15:04:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_reviews`
--

CREATE TABLE `course_reviews` (
  `review_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL CHECK (`rating` >= 0 and `rating` <= 5),
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_reviews`
--

INSERT INTO `course_reviews` (`review_id`, `course_id`, `student_id`, `rating`, `comment`, `created_at`, `status`) VALUES
(4, 1, 1, 5.0, 'To create the course review section and fetch records from the students table and course_review table, I\'ll construct a PHP script that queries the database and populates the HTML structure with student information and their reviews.', '2024-11-26 22:57:21', 'approved'),
(5, 2, 1, 3.0, 'To create the course review section and fetch records from the students table and course_review table, I\'ll construct a PHP script that queries the database and populates the HTML structure with student information and their reviews.', '2024-11-18 22:57:21', 'approved'),
(6, 4, 2, 2.0, 'To create the course review section and fetch records from the students table and course_review table, I\'ll construct a PHP script that queries the database and populates the HTML structure with student information and their reviews.', '2024-11-19 23:00:00', 'approved'),
(7, 3, 3, 1.0, 'To create the course review section and fetch records from the students table and course_review table, I\'ll construct a PHP script that queries the database and populates the HTML structure with student information and their reviews.', '2024-11-11 23:00:00', 'approved'),
(8, 1, 4, 4.0, 'To display the course reviews using data from the course_reviews and students tables, I\'ll create a PHP code snippet that fetches review data and populates the provided HTML structure. Here’s how to query and display the data:', '2024-11-19 23:57:53', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `course_tips`
--

CREATE TABLE `course_tips` (
  `id` int(11) NOT NULL,
  `tip_number` int(11) NOT NULL,
  `tip_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_tips`
--

INSERT INTO `course_tips` (`id`, `tip_number`, `tip_text`) VALUES
(1, 1, 'Set the Course Price option or make it free.'),
(2, 2, 'Standard size for the course thumbnail is 700x430.'),
(3, 3, 'Video section controls the course overview video.'),
(4, 4, 'Course Builder is where you create & organize a course.'),
(5, 5, 'Add Topics in the Course Builder section to create lessons, quizzes, and assignments.');

-- --------------------------------------------------------

--
-- Table structure for table `earnings`
--

CREATE TABLE `earnings` (
  `earning_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `enrollment_id` int(11) NOT NULL,
  `date_earned` date NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `earnings`
--

INSERT INTO `earnings` (`earning_id`, `course_id`, `instructor_id`, `enrollment_id`, `date_earned`, `amount`) VALUES
(1, 4, 8, 7, '2024-11-13', 350.00),
(2, 1, 8, 8, '2024-11-21', 220.00);

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `enrollment_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `enrolled_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Active','Completed','Dropped') DEFAULT 'Active',
  `instructor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`enrollment_id`, `student_id`, `course_id`, `enrolled_at`, `status`, `instructor_id`) VALUES
(7, 1, 4, '2024-11-21 14:55:44', 'Active', 8),
(8, 2, 4, '2024-11-21 14:55:44', 'Active', 8),
(9, 3, 3, '2024-11-29 19:05:13', 'Active', 8),
(10, 4, 3, '2024-11-21 19:05:13', 'Active', 8),
(11, NULL, 3, '2025-01-03 18:42:14', 'Active', NULL),
(16, 9, 3, '2025-01-03 18:52:38', 'Active', NULL),
(17, 9, 3, '2025-01-03 19:09:56', 'Active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `faq_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`faq_id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 'What is Emeritus Education System?', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2024-11-28 15:37:10', '2024-11-18 15:37:10'),
(2, 'Can I get a refund for my Premium Membership payment?', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2024-11-13 15:37:10', '2024-11-29 15:37:10'),
(3, 'How does th Affiliate Program work?', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2024-11-25 15:38:32', '2024-11-26 15:38:32'),
(4, 'What is included in Standard membership plan?', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2024-11-21 15:38:32', '2024-11-19 15:38:32');

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `instructor_id` int(11) NOT NULL,
  `instructor_name` varchar(255) NOT NULL,
  `bio` text DEFAULT NULL,
  `current_role` varchar(225) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `gender` varchar(50) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `bank_account_details` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`instructor_id`, `instructor_name`, `bio`, `current_role`, `profile_picture`, `created_at`, `gender`, `location`, `status`, `email`, `password`, `phone_number`, `bank_account_details`) VALUES
(1, 'BabaT', 'Baba Tunde biography in Advance Excel and Data Analytics experience but want to get up to speed using Adobe XD then this course is perfect for you too! First, we will go over the differences between UX and UI Design. We will look at what our brief for this real-world project ', 'Data Scientist / DBA / Power BI / Tablau', 'mi.png', '2024-10-27 13:10:39', NULL, NULL, 'approved', 'babat@email.com', '$2y$10$dcLSq6f/bIJaO8MS1/ykMejup.rIm9H1Yxsq1nOaRfy4vCvh0F0gq', NULL, NULL),
(2, 'Issa Ajao', 'Experienced ICT professional with a BSc (Hons) in Mathematics, complemented by advanced skills in web/mobile architecture, project management, and cloud computing (AWS, Microsoft Azure). Proven expertise in leading cross-functional teams, delivering innovative solutions, and ensuring high-quality project outcomes across various industries. Adept at manual software testing, training management, and digital transformation initiatives, with a strong focus on business growth and client satisfaction.', 'Solution Achitect / Developer', 'mi.png', '2024-11-20 22:42:35', NULL, 'Nigeria', 'approved', 'easy4issy@gmail.com', '123456', '08033011305', '8033011305\r\nOpay'),
(3, 'Comform Oladeji', 'com bio', 'Quality Assurancce ENGR', 'mi.png', '2024-11-19 23:42:39', NULL, NULL, 'rejected', '', '', NULL, NULL),
(4, 'Adeayo Ilori', 'The Current batch is already rounding up, and the next batch will be starting before the end of this month.\r\nThe Current batch is already rounding up, and the next batch will be starting before the end of this month.\r\n', 'Full Stack Developer', '1731324975_Data_Analytics.png', '2024-11-11 11:36:15', 'Male', 'Nigeria', 'approved', 'adeayo@email.com', '$2y$10$dcLSq6f/bIJaO8MS1/ykMejup.rIm9H1Yxsq1nOaRfy4vCvh0F0gq', NULL, NULL),
(5, 'Gbanga Williams', 'Gbenga Williams holds a Bachelors\' Degree in Banking and Finance from the Lagos State University Ojo and Higher National Diploma in Insurance from the Lagos .', 'Career Coaching', '1731328100_gb.jpeg', '2024-11-11 12:28:20', 'Male', 'Nigeria', 'approved', '', '', NULL, NULL),
(6, 'Debo Aderonmu', 'May the goodness of Allah that abounds in heaven and earth occupy your home with joy and tranquility now and always. May the Almighty replace your bitterness with joy, ameenaa🙏.Juma\'ah Mubarak', 'Cybersecurity Analyst', '1731454783_debbo.png', '2024-11-12 23:39:43', 'Male', 'Nigeria', 'pending', 'debi@email.com', '$2y$10$dcLSq6f/bIJaO8MS1/ykMejup.rIm9H1Yxsq1nOaRfy4vCvh0F0gq', NULL, NULL),
(7, 'SK Ajao', 'May the goodness of Allah that abounds in heaven and earth occupy your home with joy and tranquility now and always. May the Almighty replace your bitterness with joy, ameenaa🙏.Juma\'ah Mubarak', 'Career Coaching', '1731455402_sk.png', '2024-11-12 23:50:02', 'Male', 'Nigeria', 'pending', 'sk@email.com', '$2y$10$dcLSq6f/bIJaO8MS1/ykMejup.rIm9H1Yxsq1nOaRfy4vCvh0F0gq', NULL, NULL),
(8, 'Biola Lawal Balogun', 'During the meeting, various health facilitators present reports on the existing conditions of healthcare facilities, prevalent health issues, and the resources required for improvement. During the meeting, various health facilitators present reports on the existing conditions of healthcare facilities, prevalent health issues, and the resources required for improvement. ', 'Business Analyst', '1731456510_debbo.png', '2024-11-13 00:08:30', 'Male', 'United Kingdom', 'approved', 'biola@email.com', '$2y$10$zFSrHJGECD7Vs0Xk/meBQO3cMeYf9XJOy9K/a.pyojhiKca7KuMfm', '09092968577', 'Issa Ajao\r\n00069578578\r\nGTBank\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `mailing_list`
--

CREATE TABLE `mailing_list` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mailing_list`
--

INSERT INTO `mailing_list` (`id`, `email`, `subscribed_at`) VALUES
(14, 'info@staunchtechnologies.com', '2024-11-08 10:18:12'),
(23, 'easy4issy@yahoo.com', '2024-11-08 10:27:46');

-- --------------------------------------------------------

--
-- Table structure for table `payouts`
--

CREATE TABLE `payouts` (
  `payout_id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `payout_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) DEFAULT 'Bank Transfer',
  `status` enum('Pending','Completed','Failed') DEFAULT 'Pending',
  `transaction_reference` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payouts`
--

INSERT INTO `payouts` (`payout_id`, `instructor_id`, `payout_date`, `amount`, `payment_method`, `status`, `transaction_reference`) VALUES
(1, 8, '2024-11-30', 350.00, 'Bank Transfer', 'Pending', 'g8ruguqrg89reiv8fvueri'),
(2, 8, '2024-11-29', 220.00, 'Bank Transfer', 'Completed', 'jhvkcvlkjlknvlkjvkajkl'),
(3, 8, '2024-11-21', 1250.00, 'Bank Transfer', 'Pending', 'ghgjj '),
(4, 8, '2024-11-22', 1000.00, 'Bank Transfer', 'Completed', 'yuinjkml,c vbnm,');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `student_status` enum('Prospective Student','Current Student','Alumni') NOT NULL DEFAULT 'Prospective Student',
  `picture` varchar(255) DEFAULT 'assets/img/default-avatar.png',
  `phone` varchar(20) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state_province` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `field_study` varchar(255) DEFAULT NULL,
  `current_job_title` varchar(255) DEFAULT NULL,
  `employer_name` varchar(255) DEFAULT NULL,
  `special_requirements` text DEFAULT NULL,
  `how_did_you_hear_about_us` varchar(255) DEFAULT NULL,
  `agree_to_terms` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `name`, `email`, `created_at`, `student_status`, `picture`, `phone`, `gender`, `city`, `state_province`, `country`, `education`, `field_study`, `current_job_title`, `employer_name`, `special_requirements`, `how_did_you_hear_about_us`, `agree_to_terms`) VALUES
(1, 'Issa Ajao', 'easy4issy@gmail.com', '2024-10-28 12:56:57', 'Current Student', 'issa.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(2, 'Yetty Ajao', 'yetolans@yahoo.com', '2024-11-26 22:58:35', 'Alumni', 'student.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(3, 'John Smith', 'john@smith.com', '2024-11-19 22:58:35', 'Alumni', 'john.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(4, 'Babyface Celeb', 'babyface@email.com', '2024-11-19 23:55:19', 'Alumni', 'babyface.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(9, 'Yetty Longman', 'easy4issy@mail.com', '2025-01-03 18:52:38', 'Current Student', 'assets/img/default-avatar.png', '08033011305', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(10, 'Rockie Lawal', 'qdirockie@email.com', '2025-01-03 19:52:03', 'Current Student', 'assets/img/default-avatar.png', '08033011305', '', 'Lagos', 'Lagos State', 'Nigeria', 'Associate Degree', 'Science', 'Lecturer', 'Cloud Crave Solutions', 'Special Requirements (Dietary needs, accessibility requirements, etc.)', 'friend_colleague', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`certificate_id`),
  ADD UNIQUE KEY `certificate_code` (`certificate_code`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `cms_pages`
--
ALTER TABLE `cms_pages`
  ADD PRIMARY KEY (`page_id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `cms_permissions`
--
ALTER TABLE `cms_permissions`
  ADD PRIMARY KEY (`permission_id`),
  ADD UNIQUE KEY `permission_name` (`permission_name`);

--
-- Indexes for table `cms_roles`
--
ALTER TABLE `cms_roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `cms_role_permissions`
--
ALTER TABLE `cms_role_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `permission_id` (`permission_id`);

--
-- Indexes for table `cms_users`
--
ALTER TABLE `cms_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cms_user_roles`
--
ALTER TABLE `cms_user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `fk_instructor` (`instructor_id`);

--
-- Indexes for table `coursex`
--
ALTER TABLE `coursex`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `course_categories`
--
ALTER TABLE `course_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `course_curriculum`
--
ALTER TABLE `course_curriculum`
  ADD PRIMARY KEY (`curriculum_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `course_instructors`
--
ALTER TABLE `course_instructors`
  ADD PRIMARY KEY (`course_id`,`instructor_id`),
  ADD KEY `instructor_id` (`instructor_id`);

--
-- Indexes for table `course_lessons`
--
ALTER TABLE `course_lessons`
  ADD PRIMARY KEY (`lesson_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `curriculum_id` (`curriculum_id`);

--
-- Indexes for table `course_reviews`
--
ALTER TABLE `course_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `fk_course_id` (`course_id`);

--
-- Indexes for table `course_tips`
--
ALTER TABLE `course_tips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `earnings`
--
ALTER TABLE `earnings`
  ADD PRIMARY KEY (`earning_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `instructor_id` (`instructor_id`),
  ADD KEY `enrollment_id` (`enrollment_id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`instructor_id`);

--
-- Indexes for table `mailing_list`
--
ALTER TABLE `mailing_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `payouts`
--
ALTER TABLE `payouts`
  ADD PRIMARY KEY (`payout_id`),
  ADD KEY `instructor_id` (`instructor_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `certificate_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_pages`
--
ALTER TABLE `cms_pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_permissions`
--
ALTER TABLE `cms_permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_roles`
--
ALTER TABLE `cms_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_users`
--
ALTER TABLE `cms_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `coursex`
--
ALTER TABLE `coursex`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_categories`
--
ALTER TABLE `course_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `course_curriculum`
--
ALTER TABLE `course_curriculum`
  MODIFY `curriculum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `course_lessons`
--
ALTER TABLE `course_lessons`
  MODIFY `lesson_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `course_reviews`
--
ALTER TABLE `course_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `course_tips`
--
ALTER TABLE `course_tips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `earnings`
--
ALTER TABLE `earnings`
  MODIFY `earning_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `instructor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mailing_list`
--
ALTER TABLE `mailing_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `payouts`
--
ALTER TABLE `payouts`
  MODIFY `payout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `audit_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `cms_users` (`user_id`);

--
-- Constraints for table `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `certificates_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `certificates_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `coursex` (`course_id`);

--
-- Constraints for table `cms_role_permissions`
--
ALTER TABLE `cms_role_permissions`
  ADD CONSTRAINT `cms_role_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `cms_roles` (`role_id`),
  ADD CONSTRAINT `cms_role_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `cms_permissions` (`permission_id`);

--
-- Constraints for table `cms_user_roles`
--
ALTER TABLE `cms_user_roles`
  ADD CONSTRAINT `cms_user_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `cms_users` (`user_id`),
  ADD CONSTRAINT `cms_user_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `cms_roles` (`role_id`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `course_categories` (`category_id`),
  ADD CONSTRAINT `fk_instructor` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`instructor_id`);

--
-- Constraints for table `coursex`
--
ALTER TABLE `coursex`
  ADD CONSTRAINT `coursex_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `course_categories` (`category_id`);

--
-- Constraints for table `course_curriculum`
--
ALTER TABLE `course_curriculum`
  ADD CONSTRAINT `course_curriculum_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `course_instructors`
--
ALTER TABLE `course_instructors`
  ADD CONSTRAINT `course_instructors_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `coursex` (`course_id`),
  ADD CONSTRAINT `course_instructors_ibfk_2` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`instructor_id`);

--
-- Constraints for table `course_lessons`
--
ALTER TABLE `course_lessons`
  ADD CONSTRAINT `course_lessons_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_lessons_ibfk_2` FOREIGN KEY (`curriculum_id`) REFERENCES `course_curriculum` (`curriculum_id`) ON DELETE SET NULL;

--
-- Constraints for table `course_reviews`
--
ALTER TABLE `course_reviews`
  ADD CONSTRAINT `course_reviews_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `course_reviews_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `fk_course_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `earnings`
--
ALTER TABLE `earnings`
  ADD CONSTRAINT `earnings_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `earnings_ibfk_2` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`instructor_id`),
  ADD CONSTRAINT `earnings_ibfk_3` FOREIGN KEY (`enrollment_id`) REFERENCES `enrollments` (`enrollment_id`);

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `payouts`
--
ALTER TABLE `payouts`
  ADD CONSTRAINT `payouts_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`instructor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
