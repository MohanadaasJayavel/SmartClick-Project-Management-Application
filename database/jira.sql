-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2024 at 03:13 AM
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
-- Database: `jira`
--

-- --------------------------------------------------------

--
-- Table structure for table `mst_customers`
--

CREATE TABLE `mst_customers` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `web_link` varchar(150) NOT NULL,
  `email_address` varchar(150) NOT NULL,
  `address` varchar(250) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `contact_ph_no` varchar(20) NOT NULL,
  `cont_email` varchar(150) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `is_removed` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_customers`
--

INSERT INTO `mst_customers` (`id`, `name`, `contact_no`, `web_link`, `email_address`, `address`, `contact_name`, `contact_ph_no`, `cont_email`, `is_active`, `is_removed`, `created_at`, `updated_at`) VALUES
(1, 'Contego Safety Solutions', '425785263', 'contegotest.com', 'test@contego.test.co', 'UK, london, test ', 'Deborah Southwell', '8748454998', 'UK, london , GM', 1, 0, '2023-04-23 17:59:43', '2023-04-23 17:59:43'),
(2, 'skasc', '123', 'skasc.ac.in', 'test@skasc.ac.in', 'combatore', 'suresh', '123456789', 'copimbatore', 1, 0, '2023-04-24 10:55:53', '2023-04-24 10:55:53');

-- --------------------------------------------------------

--
-- Table structure for table `mst_designation`
--

CREATE TABLE `mst_designation` (
  `id` int(11) NOT NULL,
  `designation_name` varchar(100) NOT NULL,
  `description` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_removed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_designation`
--

INSERT INTO `mst_designation` (`id`, `designation_name`, `description`, `created_at`, `updated_at`, `is_active`, `is_removed`) VALUES
(1, 'CEO', 'Cheif Executive Officer', '2021-05-27 11:19:52', '2021-05-27 11:19:52', 1, 0),
(2, 'CTO', 'Chief Technical Officer', '2021-06-03 19:23:03', '2021-06-03 19:23:03', 1, 0),
(3, 'COO', 'Chief Operating Officer', '2021-10-04 03:06:49', '2021-10-04 03:06:49', 1, 0),
(4, 'TL', 'Technical Lead', '2021-10-04 03:09:54', '2021-10-04 03:09:54', 1, 0),
(5, 'SE', 'Software Engineer', '2021-10-04 03:17:12', '2021-10-04 03:17:12', 1, 0),
(6, 'ASE', 'Associate Software Engineer', '2021-10-04 03:24:13', '2021-10-04 03:24:13', 1, 0),
(7, 'QAE', 'Quality Assurance Engineer', '2021-10-15 07:17:38', '2021-10-15 07:17:38', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mst_employee`
--

CREATE TABLE `mst_employee` (
  `id` int(11) NOT NULL,
  `emp_name` varchar(100) NOT NULL,
  `emp_last_name` varchar(100) NOT NULL,
  `emp_gender` varchar(10) NOT NULL,
  `emp_date_of_birth` date NOT NULL,
  `emp_date_of_joining` date NOT NULL,
  `emp_blood_group` varchar(10) NOT NULL,
  `emp_contact_no` varchar(15) NOT NULL,
  `emp_emergency_contact_no` varchar(15) NOT NULL,
  `emp_address` varchar(150) NOT NULL,
  `emp_profile_pic` varchar(250) NOT NULL,
  `emp_role_id` int(11) DEFAULT NULL,
  `emp_designation_id` int(11) NOT NULL,
  `emp_email` varchar(100) NOT NULL,
  `emp_username` varchar(100) NOT NULL,
  `emp_password` varchar(200) NOT NULL,
  `emp_is_login_user` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL,
  `is_removed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_employee`
--

INSERT INTO `mst_employee` (`id`, `emp_name`, `emp_last_name`, `emp_gender`, `emp_date_of_birth`, `emp_date_of_joining`, `emp_blood_group`, `emp_contact_no`, `emp_emergency_contact_no`, `emp_address`, `emp_profile_pic`, `emp_role_id`, `emp_designation_id`, `emp_email`, `emp_username`, `emp_password`, `emp_is_login_user`, `created_at`, `updated_at`, `is_active`, `is_removed`) VALUES
(1, 'Mohanadaas', 'jayavel', 'male', '2000-11-20', '2022-04-18', 'O+', '6379284499', '9443560104', 'cbe , pnp', 'uploads/employee_photos/Mohanadaas_20230319111528.jpg', 1, 5, 'daas20112000@gmail.com', 'test', '1', 1, '2023-03-19 15:45:28', '2023-03-19 15:45:28', 1, 0),
(2, 'Karthik ', 'Veluswamy', '', '2023-03-09', '2023-03-19', 'Select You', '1234567890', '86354525', 'london', 'uploads/employee_photos/Karthik_20230319112003.jpg', 1, 1, 'karthik@konnectify.co', 'test', '1', 1, '2023-03-19 15:50:03', '2023-03-19 15:50:03', 1, 0),
(3, 'sarnith kumar', 'balan', 'male', '0000-00-00', '0000-00-00', 'B+', '123457889', '2345678', 'pollachi , cbe', 'uploads/employee_photos/sarnithkumar_20230319112154.jpg', 2, 4, 'sarnith@konnectify.co', 'test', '1', 1, '2023-03-19 15:51:54', '2023-03-19 15:51:54', 1, 0),
(4, 'pradeepsaravana', 'u', 'male', '2023-03-23', '2023-03-09', 'O+', '12345678', '12345678i', 'r.v.nagar  , periyanickenpalayam ,', 'uploads/employee_photos/pradeepsaravana_20230319114115.jpg', 2, 6, 'test@gmail.com', 'test', '1', 1, '2023-03-19 16:11:15', '2023-03-19 16:11:15', 0, 1),
(5, 'mohanadaas', 'J', 'male', '2024-02-21', '2024-02-14', 'A+', '908765432', '', 'sample data', 'uploads/employee_photos/mohanadaas_20240223160047.', 1, 1, 'daas20112000@gmail.com', 'testuser', '1', 1, '2024-02-23 20:30:47', '2024-02-23 20:30:47', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mst_permissions`
--

CREATE TABLE `mst_permissions` (
  `id` int(50) NOT NULL,
  `permission_name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_removed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_permissions`
--

INSERT INTO `mst_permissions` (`id`, `permission_name`, `description`, `created_at`, `updated_at`, `is_active`, `is_removed`) VALUES
(1, 'can_view_dashboard', 'can_view_dashboard', '2023-02-26 06:16:36', '2023-02-26 06:16:36', 1, 0),
(2, 'can_view_employee_list', 'can_view_employee_list', '2023-02-26 06:16:36', '2023-02-26 06:16:36', 1, 0),
(3, 'can_view_employee', 'can_view_employee', '2023-02-26 06:16:36', '2023-02-26 06:16:36', 1, 0),
(4, 'can_create_employee', 'can_create_employee', '2023-02-26 06:16:36', '2023-02-26 06:16:36', 1, 0),
(5, 'can_edit_employee', 'can_edit_employee', '2023-02-26 06:16:36', '2023-02-26 06:16:36', 1, 0),
(6, 'can_delete_employee', 'can_delete_employee', '2023-02-26 06:16:36', '2023-02-26 06:16:36', 1, 0),
(7, 'can_view_customer_list', 'can_view_customer_list', '2023-02-26 07:53:01', '2023-02-26 07:53:01', 1, 0),
(8, 'can_view_customer', 'can_view_customer', '2023-02-26 07:53:01', '2023-02-26 07:53:01', 1, 0),
(9, 'can_create_customer', 'can_create_customer', '2023-02-26 07:53:01', '2023-02-26 07:53:01', 1, 0),
(10, 'can_edit_customer', 'can_edit_customer', '2023-02-26 07:53:01', '2023-02-26 07:53:01', 1, 0),
(11, 'can_delete_customer', 'can_delete_customer', '2023-02-26 07:53:01', '2023-02-26 07:53:01', 1, 0),
(12, 'can_view_project_list', 'can_view_project_list', '2023-02-26 11:05:18', '2023-02-26 11:05:18', 1, 0),
(13, 'can_view_projects', 'can_view_projects', '2023-02-26 11:05:18', '2023-02-26 11:05:18', 1, 0),
(14, 'can_create_projects', 'can_create_projects', '2023-02-26 11:05:18', '2023-02-26 11:05:18', 1, 0),
(15, 'can_edit_projects', 'can_edit_projects', '2023-02-26 11:05:18', '2023-02-26 11:05:18', 1, 0),
(16, 'can_delete_projects', 'can_delete_projects', '2023-02-26 11:05:18', '2023-02-26 11:05:18', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mst_productivity`
--

CREATE TABLE `mst_productivity` (
  `id` int(11) NOT NULL,
  `project_id` int(30) NOT NULL,
  `task_id` int(30) NOT NULL,
  `comment` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `user_id` int(30) NOT NULL,
  `time_rendered` float NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mst_projects`
--

CREATE TABLE `mst_projects` (
  `id` int(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `status` varchar(25) NOT NULL,
  `start_date` text NOT NULL,
  `end_date` text NOT NULL,
  `manager_id` int(30) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `user_ids` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(4) NOT NULL,
  `is_removed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_projects`
--

INSERT INTO `mst_projects` (`id`, `name`, `description`, `status`, `start_date`, `end_date`, `manager_id`, `customer_id`, `user_ids`, `created_at`, `updated_at`, `is_active`, `is_removed`) VALUES
(1, 'Freshsales orderwise Integration', '', 'Started', '2023-04-12', '2023-04-20', 0, 1, '1', '2023-04-23 18:00:34', '2023-04-23 18:00:34', 1, 0),
(2, 'sample project 2', '', 'Blocked/Pending', '2023-04-11', '2023-04-27', 0, 1, '2', '2023-04-23 21:16:24', '2023-04-23 21:16:24', 1, 0),
(3, 'project skasc', '', 'Started', '2023-04-05', '2023-04-20', 0, 2, '3', '2023-04-24 10:56:45', '2023-04-24 10:56:45', 1, 0),
(4, 'Test project Bullet.so', '', 'Yet to Kick Off', '2024-02-19', '2024-02-19', 0, 1, '2', '2024-02-23 20:32:16', '2024-02-23 20:32:16', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mst_roles`
--

CREATE TABLE `mst_roles` (
  `id` int(50) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_removed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_roles`
--

INSERT INTO `mst_roles` (`id`, `role_name`, `description`, `created_at`, `updated_at`, `is_active`, `is_removed`) VALUES
(1, 'Super admin', 'super admin', '2021-05-27 11:23:38', '2021-05-27 11:23:38', 1, 0),
(2, 'admin', 'admin', '2021-06-03 19:22:27', '2021-06-03 19:22:27', 1, 0),
(4, 'special_admin', 'special_admin', '2021-11-17 15:21:55', '2021-11-17 15:21:55', 1, 0),
(5, 'special_admin_2', 'special_admin_2', '2021-11-17 15:24:00', '2021-11-17 15:24:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mst_tasks`
--

CREATE TABLE `mst_tasks` (
  `id` int(11) NOT NULL,
  `project_id` int(30) NOT NULL,
  `employee_id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_active` int(11) NOT NULL,
  `is_removed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_tasks`
--

INSERT INTO `mst_tasks` (`id`, `project_id`, `employee_id`, `name`, `description`, `status`, `created_at`, `updated_at`, `is_active`, `is_removed`) VALUES
(1, 1, '1', 'Export Definiton sync', 'Sync form orderwise to frershsales', 'To Do', '2023-04-23 18:01:33', '2023-04-23 18:01:33', 1, 0),
(2, 1, '3', 'Middleware for export sync', 'Middleware for export sync', 'QA Testing', '2023-04-23 18:06:50', '2023-04-23 18:06:50', 1, 0),
(3, 3, '1', 'sample task 1', 'sample task 1', 'QA Testing', '2023-04-24 10:57:58', '2023-04-24 10:57:58', 1, 0),
(4, 4, '2', 'sample 1', 'asdfghjhgf', 'Code Review', '2024-02-23 20:33:12', '2024-02-23 20:33:12', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `trn_roles_permissions`
--

CREATE TABLE `trn_roles_permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL,
  `is_removed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trn_roles_permissions`
--

INSERT INTO `trn_roles_permissions` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`, `is_active`, `is_removed`) VALUES
(1, 1, 1, '2023-02-26 10:55:54', '2023-02-26 10:55:54', 1, 0),
(2, 1, 2, '2023-02-26 10:55:54', '2023-02-26 10:55:54', 1, 0),
(3, 1, 3, '2023-02-26 10:55:54', '2023-02-26 10:55:54', 1, 0),
(4, 1, 4, '2023-02-26 10:55:54', '2023-02-26 10:55:54', 1, 0),
(5, 1, 5, '2023-02-26 10:55:54', '2023-02-26 10:55:54', 1, 0),
(6, 1, 6, '2023-02-26 10:55:54', '2023-02-26 10:55:54', 1, 0),
(7, 1, 7, '2023-02-26 12:30:53', '2023-02-26 12:30:53', 1, 0),
(8, 1, 8, '2023-02-26 12:30:53', '2023-02-26 12:30:53', 1, 0),
(9, 1, 9, '2023-02-26 12:30:53', '2023-02-26 12:30:53', 1, 0),
(10, 1, 10, '2023-02-26 12:30:53', '2023-02-26 12:30:53', 1, 0),
(11, 1, 11, '2023-02-26 12:30:53', '2023-02-26 12:30:53', 1, 0),
(12, 1, 12, '2023-02-26 15:37:44', '2023-02-26 15:37:44', 1, 0),
(13, 1, 13, '2023-02-26 15:37:44', '2023-02-26 15:37:44', 1, 0),
(14, 1, 14, '2023-02-26 15:37:44', '2023-02-26 15:37:44', 1, 0),
(15, 1, 15, '2023-02-26 15:37:44', '2023-02-26 15:37:44', 1, 0),
(16, 1, 16, '2023-02-26 15:37:44', '2023-02-26 15:37:44', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_customers`
--
ALTER TABLE `mst_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_designation`
--
ALTER TABLE `mst_designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_employee`
--
ALTER TABLE `mst_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_permissions`
--
ALTER TABLE `mst_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_productivity`
--
ALTER TABLE `mst_productivity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_projects`
--
ALTER TABLE `mst_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_roles`
--
ALTER TABLE `mst_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_tasks`
--
ALTER TABLE `mst_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trn_roles_permissions`
--
ALTER TABLE `trn_roles_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_id` (`role_id`,`permission_id`),
  ADD KEY `trn_roles_permissions_permission_id_ref` (`permission_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mst_customers`
--
ALTER TABLE `mst_customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mst_designation`
--
ALTER TABLE `mst_designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mst_employee`
--
ALTER TABLE `mst_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mst_permissions`
--
ALTER TABLE `mst_permissions`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `mst_productivity`
--
ALTER TABLE `mst_productivity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_projects`
--
ALTER TABLE `mst_projects`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mst_roles`
--
ALTER TABLE `mst_roles`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mst_tasks`
--
ALTER TABLE `mst_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trn_roles_permissions`
--
ALTER TABLE `trn_roles_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mst_roles`
--
ALTER TABLE `mst_roles`
  ADD CONSTRAINT `mst_roles_id_ref` FOREIGN KEY (`id`) REFERENCES `mst_employee` (`id`);

--
-- Constraints for table `trn_roles_permissions`
--
ALTER TABLE `trn_roles_permissions`
  ADD CONSTRAINT `trn_roles_permissions_permission_id_ref` FOREIGN KEY (`permission_id`) REFERENCES `mst_permissions` (`id`),
  ADD CONSTRAINT `trn_roles_permissions_role_id_ref` FOREIGN KEY (`role_id`) REFERENCES `mst_roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
