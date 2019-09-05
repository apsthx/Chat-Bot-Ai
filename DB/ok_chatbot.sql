-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 05, 2019 at 03:09 PM
-- Server version: 10.1.41-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_chatbot`
--

-- --------------------------------------------------------

--
-- Table structure for table `ac_group_menu`
--

CREATE TABLE `ac_group_menu` (
  `group_menu_id` tinyint(3) UNSIGNED NOT NULL,
  `group_menu_name` varchar(100) DEFAULT NULL,
  `group_menu_icon` varchar(50) DEFAULT NULL,
  `group_menu_sort` tinyint(3) UNSIGNED DEFAULT NULL,
  `group_menu_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ac_group_menu`
--

INSERT INTO `ac_group_menu` (`group_menu_id`, `group_menu_name`, `group_menu_icon`, `group_menu_sort`, `group_menu_update`) VALUES
(1, 'ระบบ Chatbot', 'fa fa-comments', 1, '2019-01-29 20:48:35'),
(2, 'รายงานข้อมูล', 'icon-chart', 2, '2019-01-29 20:48:35'),
(3, 'ตั้งค่า', 'icon-settings', 3, '2019-02-21 22:30:28');

-- --------------------------------------------------------

--
-- Table structure for table `ac_map_menu_package`
--

CREATE TABLE `ac_map_menu_package` (
  `menu_package_id` int(10) UNSIGNED NOT NULL,
  `package_id` int(11) NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ac_map_menu_role`
--

CREATE TABLE `ac_map_menu_role` (
  `map_role_menu_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `role_id` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ac_map_menu_role`
--

INSERT INTO `ac_map_menu_role` (`map_role_menu_id`, `menu_id`, `role_id`) VALUES
(2, 2, 1),
(5, 5, 1),
(6, 6, 1),
(8, 8, 1),
(9, 9, 1),
(11, 2, 2),
(14, 5, 2),
(15, 6, 2),
(17, 10, 1),
(18, 11, 1),
(19, 12, 1),
(20, 12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ac_menu`
--

CREATE TABLE `ac_menu` (
  `menu_id` int(10) UNSIGNED NOT NULL,
  `group_menu_id` tinyint(3) UNSIGNED NOT NULL,
  `menu_name` varchar(100) DEFAULT NULL,
  `menu_link` varchar(100) DEFAULT NULL,
  `menu_status_id` tinyint(4) DEFAULT NULL COMMENT '1=เปิด,   2=ปิด,  3=แสดงไม่ให้คลิก',
  `menu_openlink` tinyint(4) DEFAULT NULL COMMENT '0= หน้าเดิม , 1= หน้าใหม่',
  `menu_sort` int(10) UNSIGNED DEFAULT NULL,
  `menu_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ac_menu`
--

INSERT INTO `ac_menu` (`menu_id`, `group_menu_id`, `menu_name`, `menu_link`, `menu_status_id`, `menu_openlink`, `menu_sort`, `menu_update`) VALUES
(2, 3, 'Agent', 'agent', 2, 0, 2, '2019-01-29 21:00:23'),
(5, 2, 'รายงานการใช้งาน', 'reportbot', 1, 0, 1, '2019-02-17 11:21:55'),
(6, 2, 'รายงานสถิติ', 'reportstatistic', 1, 0, 2, '2019-02-19 13:15:41'),
(8, 3, 'ผู้ใช้งาน', 'user', 1, 0, 1, '2019-01-29 21:05:54'),
(9, 3, 'ตั้งค่าทีม', 'setting', 1, 0, 2, '2019-01-29 21:25:55'),
(10, 3, 'แพ็กเกจ', 'package', 1, 0, 3, '2019-01-29 21:26:21'),
(11, 3, 'ชำระเงิน', 'payment', 1, 0, 4, '2019-01-29 21:26:28'),
(12, 3, 'อัพโหลดรูปภาพ', 'uploads', 2, 0, 3, '2019-02-22 14:28:42');

-- --------------------------------------------------------

--
-- Table structure for table `ac_role`
--

CREATE TABLE `ac_role` (
  `role_id` tinyint(3) UNSIGNED NOT NULL,
  `role_name` varchar(100) DEFAULT NULL,
  `role_name_en` varchar(100) DEFAULT NULL,
  `role_sort` tinyint(3) UNSIGNED DEFAULT NULL,
  `role_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ac_role`
--

INSERT INTO `ac_role` (`role_id`, `role_name`, `role_name_en`, `role_sort`, `role_update`) VALUES
(1, 'เจ้าของทีม Chatbot', 'Chatbot Owner', 1, '2019-01-17 15:54:30'),
(2, 'ผู้ร่วมทีม Chatbot', 'Chatbot Team', 2, '2019-01-17 15:54:30');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `admin_username` varchar(50) DEFAULT NULL,
  `admin_password` varchar(100) DEFAULT NULL,
  `admin_fullname` varchar(100) DEFAULT NULL,
  `admin_image` varchar(255) DEFAULT NULL,
  `role_id` tinyint(3) UNSIGNED NOT NULL,
  `user_status_id` tinyint(4) NOT NULL,
  `admin_style` varchar(50) DEFAULT 'default',
  `admin_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_password`, `admin_fullname`, `admin_image`, `role_id`, `user_status_id`, `admin_style`, `admin_modify`) VALUES
(1, 'admin', 'ac9689e2272427085e35b9d3e3e8bed88cb3434828b43b86fc0596cad4c6e270', 'Admin APSTH', 'none.png', 1, 1, 'purple-dark', '2019-04-25 21:36:42');

-- --------------------------------------------------------

--
-- Table structure for table `admin_check_login`
--

CREATE TABLE `admin_check_login` (
  `login_id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `regenerate_login` varchar(255) DEFAULT NULL,
  `login_last_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `agent_id` int(10) UNSIGNED NOT NULL,
  `teams_id` int(10) UNSIGNED NOT NULL,
  `agent_name` varchar(255) DEFAULT NULL,
  `agent_description` text,
  `agent_project_id` varchar(255) DEFAULT NULL,
  `agent_service_account` varchar(255) DEFAULT NULL,
  `agent_file` text,
  `agent_client_access_token` varchar(100) DEFAULT NULL,
  `agent_developer_access_token` varchar(100) DEFAULT NULL,
  `agent_type_id` tinyint(4) UNSIGNED DEFAULT '1',
  `agent_active_id` tinyint(4) DEFAULT '0' COMMENT '0 unactive 1 active',
  `agent_status_id` tinyint(4) DEFAULT '1' COMMENT '0 = รอตรวจ ,1 = ปกติ, 2 = แจ้งลบ, 3 = ลบแล้ว',
  `agent_fb_active_id` tinyint(4) DEFAULT '0' COMMENT '0 unactive 1 active',
  `agent_fb_status_id` tinyint(4) DEFAULT '2' COMMENT '1 เปิดใช้งาน 2 ปิดใช้งาน',
  `agent_fb_name` varchar(255) DEFAULT NULL,
  `agent_fb_app` varchar(100) DEFAULT NULL,
  `agent_fb_callback_url` varchar(255) DEFAULT NULL,
  `agent_fb_verify_token` varchar(255) DEFAULT NULL,
  `agent_fb_access_token` varchar(255) DEFAULT NULL,
  `agent_line_active_id` tinyint(4) DEFAULT '0' COMMENT '0 unactive 1 active',
  `agent_line_status_id` tinyint(4) DEFAULT '2' COMMENT '1 เปิดใช้งาน 2 ปิดใช้งาน',
  `agent_line_name` varchar(255) DEFAULT NULL,
  `agent_line_channel_id` varchar(255) DEFAULT NULL,
  `agent_line_channel_secret` varchar(255) DEFAULT NULL,
  `agent_line_access_token` varchar(255) DEFAULT NULL,
  `agent_line_webhook_url` varchar(255) DEFAULT NULL,
  `agent_create` datetime DEFAULT NULL,
  `agent_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ai_apsth_session`
--

CREATE TABLE `ai_apsth_session` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_facebook`
--

CREATE TABLE `app_facebook` (
  `app_facebook_id_pri` int(11) UNSIGNED NOT NULL,
  `app_facebook_id` varchar(100) DEFAULT NULL,
  `app_facebook_name` varchar(255) DEFAULT NULL,
  `app_facebook_use` tinyint(4) DEFAULT '0' COMMENT '0 = ว่าง , 1 = ใช้เเล้ว',
  `app_facebook_create` datetime DEFAULT NULL,
  `app_facebook_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `a_group_menu`
--

CREATE TABLE `a_group_menu` (
  `group_menu_id` tinyint(3) UNSIGNED NOT NULL,
  `group_menu_name` varchar(100) DEFAULT NULL,
  `group_menu_icon` varchar(50) DEFAULT NULL,
  `group_menu_sort` tinyint(3) UNSIGNED DEFAULT NULL,
  `group_menu_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `a_group_menu`
--

INSERT INTO `a_group_menu` (`group_menu_id`, `group_menu_name`, `group_menu_icon`, `group_menu_sort`, `group_menu_update`) VALUES
(1, 'ระบบ ChatBot', 'fa fa-comments-o', 1, '2019-03-11 21:03:10'),
(2, 'แพคเกจผู้ใช้', 'fa fa-thumb-tack', 2, '2019-01-14 21:14:53'),
(3, 'ควมคุมระบบผู้ใช้', 'fa fa-cog', 4, '2019-01-17 15:08:32'),
(4, 'รายงานข้อมูล', 'fa fa-bar-chart', 3, '2019-01-14 21:14:53'),
(5, 'ประวัติการใช้งาน', 'fa fa-bars', 6, '2019-01-14 21:14:53'),
(6, 'ควมคุมระบบผู้ดูแล', 'fa fa-cogs', 5, '2019-01-17 15:08:44');

-- --------------------------------------------------------

--
-- Table structure for table `a_map_menu_role`
--

CREATE TABLE `a_map_menu_role` (
  `map_role_menu_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `role_id` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `a_map_menu_role`
--

INSERT INTO `a_map_menu_role` (`map_role_menu_id`, `menu_id`, `role_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1),
(11, 12, 1),
(12, 13, 1),
(13, 14, 1),
(14, 15, 1),
(15, 16, 1),
(16, 17, 1),
(17, 18, 1),
(18, 19, 1),
(19, 1, 2),
(20, 2, 2),
(21, 15, 2),
(22, 3, 2),
(23, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `a_menu`
--

CREATE TABLE `a_menu` (
  `menu_id` int(10) UNSIGNED NOT NULL,
  `group_menu_id` tinyint(3) UNSIGNED NOT NULL,
  `menu_name` varchar(100) DEFAULT NULL,
  `menu_link` varchar(100) DEFAULT NULL,
  `menu_status_id` tinyint(4) DEFAULT NULL COMMENT '1=เปิด,   2=ปิด,  3=แสดงไม่ให้คลิก',
  `menu_openlink` tinyint(4) DEFAULT NULL COMMENT '0= หน้าเดิม , 1= หน้าใหม่',
  `menu_sort` int(10) UNSIGNED DEFAULT NULL,
  `menu_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `a_menu`
--

INSERT INTO `a_menu` (`menu_id`, `group_menu_id`, `menu_name`, `menu_link`, `menu_status_id`, `menu_openlink`, `menu_sort`, `menu_update`) VALUES
(1, 1, 'Dashboard', 'dashboard', 1, 0, 1, '2019-01-14 21:21:48'),
(2, 1, 'ChatBot', 'agent', 1, 0, 2, '2019-01-14 21:21:48'),
(3, 2, 'จัดการผู้ใช้งาน', 'user', 1, 0, 1, '2019-01-14 21:21:48'),
(4, 2, 'จัดการแพคเกจ', 'package', 1, 0, 2, '2019-01-14 21:21:48'),
(5, 2, 'จัดการการแจ้งโอน', 'payment', 1, 0, 3, '2019-01-14 21:21:48'),
(6, 3, 'จัดการสิทธิ์ผู้ใช้งาน', 'acrole', 1, 0, 1, '2019-01-14 21:25:41'),
(7, 3, 'จัดการกลุ่มเมนูผู้ใช้งาน', 'acgroupmenu', 1, 0, 2, '2019-01-14 21:25:41'),
(8, 6, 'จัดการผู้ดูแล', 'administrator', 1, 0, 1, '2019-01-14 21:25:41'),
(9, 6, 'จัดการสิทธิ์ผู้ดูแล', 'role', 1, 0, 2, '2019-01-14 21:25:41'),
(10, 6, 'จัดการกลุ่มเมนูผู้ดูแล', 'groupmenu', 1, 0, 3, '2019-01-14 21:25:41'),
(12, 5, 'ประวัติการเข้าระบบผู้ใช้งาน', 'loguserlogin', 1, 0, 1, '2019-01-17 14:37:12'),
(13, 5, 'ประวัติการเข้าระบบผู้ดูแล', 'logadminlogin', 1, 0, 2, '2019-01-17 14:37:12'),
(14, 6, 'ตั้งค่าร้านระบบ', 'setting', 1, 0, 4, '2019-01-17 15:08:05'),
(15, 1, 'Teams', 'teams', 1, 0, 3, '2019-01-17 15:46:28'),
(16, 5, 'ประวัติการส่ง SMS', 'logsendsms', 1, 0, 3, '2019-02-20 20:32:56'),
(17, 5, 'ประวัติการจัดการ Agent', 'logagent', 1, 0, 4, '2019-02-20 20:35:32'),
(18, 1, 'Facebook App', 'facebookapp', 1, 0, 4, '2019-03-11 21:03:36'),
(19, 1, 'ประเภท Chatbot', 'chatbottype', 1, 0, 5, '2019-03-25 14:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `a_role`
--

CREATE TABLE `a_role` (
  `role_id` tinyint(3) UNSIGNED NOT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  `role_sort` tinyint(3) UNSIGNED DEFAULT NULL,
  `role_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `a_role`
--

INSERT INTO `a_role` (`role_id`, `role_name`, `role_sort`, `role_update`) VALUES
(1, 'Admin', 1, '2019-01-14 20:55:20'),
(2, 'ผู้ช่วย Admin', 2, '2019-03-26 21:33:20');

-- --------------------------------------------------------

--
-- Table structure for table `chatbot_admin_session`
--

CREATE TABLE `chatbot_admin_session` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hook`
--

CREATE TABLE `hook` (
  `hook_id` int(10) UNSIGNED NOT NULL,
  `hook_project_id` varchar(255) DEFAULT NULL,
  `hook_intents_id` varchar(100) DEFAULT NULL,
  `hook_intents_name` varchar(255) DEFAULT NULL,
  `hook_platforms` varchar(255) DEFAULT NULL,
  `hook_text` text,
  `hook_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `image_id` bigint(20) UNSIGNED NOT NULL,
  `teams_id` int(10) UNSIGNED DEFAULT NULL,
  `image_url` text,
  `image_name` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `image_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `log_admin_login`
--

CREATE TABLE `log_admin_login` (
  `log_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL,
  `log_text` varchar(255) DEFAULT NULL,
  `log_ip_address` varchar(255) DEFAULT NULL,
  `log_browser` varchar(255) DEFAULT NULL,
  `log_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `log_admin_login`
--

INSERT INTO `log_admin_login` (`log_id`, `admin_id`, `log_text`, `log_ip_address`, `log_browser`, `log_time`) VALUES
(1, 1, 'Login', '124.122.21.253', 'Chrome/73.0.3683.103 Windows 10 ', '2019-04-25 21:41:30'),
(2, 1, 'Login', '2403:6200:8837:4afc:b556:1055:a08d:f8b', 'Chrome/76.0.3809.132 Windows 10 ', '2019-09-05 15:07:19'),
(3, 1, 'Loout', '2403:6200:8837:4afc:b556:1055:a08d:f8b', 'Chrome/76.0.3809.132 Windows 10 ', '2019-09-05 15:07:47');

-- --------------------------------------------------------

--
-- Table structure for table `log_agent`
--

CREATE TABLE `log_agent` (
  `log_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `log_text` text,
  `log_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `log_package`
--

CREATE TABLE `log_package` (
  `log_id` int(10) UNSIGNED NOT NULL,
  `package_id` int(11) DEFAULT NULL,
  `teams_id` int(10) UNSIGNED DEFAULT NULL,
  `log_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `log_send_sms`
--

CREATE TABLE `log_send_sms` (
  `log_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `log_text` text,
  `log_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `log_user_login`
--

CREATE TABLE `log_user_login` (
  `log_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `log_text` varchar(255) DEFAULT NULL,
  `log_ip_address` varchar(255) DEFAULT NULL,
  `log_browser` varchar(255) DEFAULT NULL,
  `log_token` text,
  `log_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `package_id` int(11) NOT NULL,
  `package_name` varchar(100) DEFAULT NULL,
  `package_cost` int(11) UNSIGNED DEFAULT NULL,
  `package_agent` int(11) UNSIGNED DEFAULT NULL,
  `package_user` int(11) UNSIGNED DEFAULT NULL,
  `package_date` int(11) UNSIGNED DEFAULT NULL,
  `package_check` tinyint(4) DEFAULT NULL,
  `package_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`package_id`, `package_name`, `package_cost`, `package_agent`, `package_user`, `package_date`, `package_check`, `package_modify`) VALUES
(1, 'Free', 0, 1, 2, 30, 1, '2019-09-04 15:01:02');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(10) UNSIGNED NOT NULL,
  `package_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `payment_number` varchar(50) DEFAULT NULL,
  `payment_by` varchar(255) DEFAULT NULL,
  `payment_cost` decimal(20,2) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_time` varchar(20) DEFAULT NULL,
  `payment_evidence` varchar(255) DEFAULT NULL,
  `payment_status_id` int(11) NOT NULL,
  `payment_create` datetime DEFAULT NULL,
  `payment_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ref_agent_status`
--

CREATE TABLE `ref_agent_status` (
  `agent_status_id` tinyint(4) NOT NULL,
  `agent_status_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_agent_status`
--

INSERT INTO `ref_agent_status` (`agent_status_id`, `agent_status_name`) VALUES
(0, 'รอตรวจ'),
(1, 'พร้อมใช้งาน'),
(2, 'แจ้งลบ'),
(3, 'ลบแล้ว');

-- --------------------------------------------------------

--
-- Table structure for table `ref_agent_type`
--

CREATE TABLE `ref_agent_type` (
  `agent_type_id` tinyint(4) UNSIGNED NOT NULL,
  `agent_type_name` varchar(50) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_agent_type`
--

INSERT INTO `ref_agent_type` (`agent_type_id`, `agent_type_name`) VALUES
(1, 'ขายสินค้าออนไลน์'),
(2, 'ตอบคำถามทั่วไป'),
(3, 'ธุรกิจ SME');

-- --------------------------------------------------------

--
-- Table structure for table `ref_bank`
--

CREATE TABLE `ref_bank` (
  `bank_id` int(11) NOT NULL,
  `bank_icon_id` int(11) NOT NULL,
  `bank_name` varchar(50) DEFAULT NULL,
  `bank_branch` varchar(100) DEFAULT NULL,
  `bank_account_name` varchar(100) DEFAULT NULL,
  `bank_account_number` varchar(50) DEFAULT NULL,
  `bank_check` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 = ปิด, 1 = เปิด',
  `bank_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_bank`
--

INSERT INTO `ref_bank` (`bank_id`, `bank_icon_id`, `bank_name`, `bank_branch`, `bank_account_name`, `bank_account_number`, `bank_check`, `bank_modify`) VALUES
(1, 1, 'ธ.กรุงเทพ', 'สาขา ธ.กรุงเทพ', '1 ธ.กรุงเทพ', '1 ธ.กรุงเทพ', 0, '2018-08-09 18:45:23'),
(2, 2, 'ธ.กสิกรไทย', 'เซ็นทรัลพลาซา ขอนแก่น', 'นายประสาน ศรีโสภา', '0048830900', 1, '2018-08-09 18:48:57'),
(3, 3, 'ธ.กรุงไทย', 'สาขา ธ.กรุงไทย', '3 ธ.กรุงไทย', '3 ธ.กรุงไทย', 0, '2018-08-09 18:45:28'),
(4, 4, 'ธ.ไทยพาณิชย์', 'สาขา ธ.ไทยพาณิชย์', '4 ธ.ไทยพาณิชย์', '4 ธ.ไทยพาณิชย์', 0, '2018-08-09 18:45:31'),
(5, 5, 'ธ.ออมสิน', 'เซ็นทรัลพลาซา ขอนแก่น', 'นายประสาน ศรีโสภา', '020247080250', 1, '2018-08-09 18:47:57'),
(6, 6, 'ธ.ก.ส.', 'สาขา ธ.ก.ส.', '6 ธ.ก.ส.', '6 ธ.ก.ส.', 0, '2018-08-09 18:45:34'),
(7, 7, 'ธ.กรุงศรีอยุธยา', 'สาขา ธ.กรุงศรีอยุธยา', '7 ธ.กรุงศรีอยุธยา', '7 ธ.กรุงศรีอยุธยา', 0, '2018-08-09 18:45:36'),
(8, 8, 'ธ.ธนชาต', 'สาขา ธ.ธนชาต', '8 ธ.ธนชาต', '8 ธ.ธนชาต', 0, '2018-08-09 18:45:38'),
(9, 9, 'ธ.ทหารไทย', 'สาขา ธ.ทหารไทย', '9 ธ.ทหารไทย', '9 ธ.ทหารไทย', 0, '2018-08-09 18:45:40');

-- --------------------------------------------------------

--
-- Table structure for table `ref_bank_icon`
--

CREATE TABLE `ref_bank_icon` (
  `bank_icon_id` int(11) NOT NULL,
  `bank_icon` varchar(50) DEFAULT NULL,
  `bank_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_bank_icon`
--

INSERT INTO `ref_bank_icon` (`bank_icon_id`, `bank_icon`, `bank_name`) VALUES
(0, 'Cash', 'เงินสด'),
(1, 'thbanks thbanks-bbl', 'ธ.กรุงเทพ'),
(2, 'thbanks thbanks-kbank', 'ธ.กสิกรไทย'),
(3, 'thbanks thbanks-ktb', 'ธ.กรุงไทย'),
(4, 'thbanks thbanks-scb', 'ธ.ไทยพาณิชย์'),
(5, 'thbanks thbanks-gsb', 'ธ.ออมสิน'),
(6, 'thbanks thbanks-baac', 'ธ.ก.ส.'),
(7, 'thbanks thbanks-bay', 'ธ.กรุงศรีอยุธยา'),
(8, 'thbanks thbanks-tbank', 'ธ.ธนชาต'),
(9, 'thbanks thbanks-tmb', 'ธ.ทหารไทย');

-- --------------------------------------------------------

--
-- Table structure for table `ref_payment_status`
--

CREATE TABLE `ref_payment_status` (
  `payment_status_id` int(11) NOT NULL,
  `payment_status_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_payment_status`
--

INSERT INTO `ref_payment_status` (`payment_status_id`, `payment_status_name`) VALUES
(1, 'รอตรวจสอบ'),
(2, 'ยืนยันการชำระ'),
(3, 'ไม่ยืนยันการชำระ');

-- --------------------------------------------------------

--
-- Table structure for table `ref_user_status`
--

CREATE TABLE `ref_user_status` (
  `user_status_id` tinyint(4) NOT NULL,
  `user_status_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_user_status`
--

INSERT INTO `ref_user_status` (`user_status_id`, `user_status_name`) VALUES
(1, 'ปกติ'),
(2, 'ระงับ'),
(3, 'ลบ');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `from_email` varchar(100) DEFAULT NULL,
  `from_name` varchar(255) DEFAULT NULL,
  `smtp_host` varchar(100) DEFAULT NULL,
  `smtp_user` varchar(100) DEFAULT NULL,
  `smtp_password` varchar(100) DEFAULT NULL,
  `smtp_port` int(11) DEFAULT NULL,
  `smtp_secure` varchar(50) DEFAULT NULL,
  `smtp_status` int(11) DEFAULT NULL,
  `sms_tel` varchar(50) DEFAULT NULL,
  `sms_username` varchar(50) DEFAULT NULL,
  `sms_password` varchar(50) DEFAULT NULL,
  `sms_credit` decimal(10,2) DEFAULT NULL,
  `line_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`from_email`, `from_name`, `smtp_host`, `smtp_user`, `smtp_password`, `smtp_port`, `smtp_secure`, `smtp_status`, `sms_tel`, `sms_username`, `sms_password`, `sms_credit`, `line_token`) VALUES
('apsth456en@gmail.com', 'AI-APS ChatBot', 'smtp.gmail.com', 'apsth456en@gmail.com', '44444', 587, 'tls', 1, '0000', 'apsth2', '555555555555', '0.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `teams_id` int(10) UNSIGNED NOT NULL,
  `teams_code` varchar(45) DEFAULT NULL,
  `teams_name` varchar(255) DEFAULT NULL,
  `teams_status_id` tinyint(4) DEFAULT '1' COMMENT '1 = ปกติ, 2 = ระงับ',
  `package_id` int(11) NOT NULL,
  `teams_package_date` date DEFAULT NULL,
  `teams_package_expire` date DEFAULT NULL,
  `teams_create` datetime DEFAULT NULL,
  `teams_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE `training` (
  `training_id` int(10) UNSIGNED NOT NULL,
  `hook_id` int(10) UNSIGNED DEFAULT NULL,
  `training_text` varchar(255) DEFAULT NULL,
  `training_intents_id` varchar(100) DEFAULT NULL,
  `training_intents_name` varchar(255) DEFAULT NULL,
  `training_status` tinyint(4) DEFAULT '1' COMMENT '1 ยังไม่ได้เพิ่ม, 2 เพิ่มแล้ว',
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `training_create` datetime DEFAULT NULL,
  `training_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_fullname` varchar(255) DEFAULT NULL,
  `user_tel` varchar(20) DEFAULT NULL,
  `user_image` varchar(255) DEFAULT 'none.png',
  `teams_id` int(10) UNSIGNED NOT NULL,
  `role_id` tinyint(4) UNSIGNED NOT NULL,
  `user_status_id` tinyint(4) NOT NULL,
  `user_address` text,
  `user_comment` text,
  `user_style` varchar(50) DEFAULT 'purple-dark',
  `user_create` datetime DEFAULT NULL,
  `user_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_check_login`
--

CREATE TABLE `user_check_login` (
  `login_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `regenerate_login` varchar(255) DEFAULT NULL,
  `login_last_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ac_group_menu`
--
ALTER TABLE `ac_group_menu`
  ADD PRIMARY KEY (`group_menu_id`);

--
-- Indexes for table `ac_map_menu_package`
--
ALTER TABLE `ac_map_menu_package`
  ADD PRIMARY KEY (`menu_package_id`),
  ADD KEY `fk_ac_map_menu_package_shop_package1_idx` (`package_id`),
  ADD KEY `fk_ac_map_menu_package_ac_menu1_idx` (`menu_id`);

--
-- Indexes for table `ac_map_menu_role`
--
ALTER TABLE `ac_map_menu_role`
  ADD PRIMARY KEY (`map_role_menu_id`),
  ADD KEY `fk_map_role_menu_menu1_idx` (`menu_id`),
  ADD KEY `fk_map_role_menu_role1_idx` (`role_id`);

--
-- Indexes for table `ac_menu`
--
ALTER TABLE `ac_menu`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `fk_ac_menu_ac_group_menu1_idx` (`group_menu_id`);

--
-- Indexes for table `ac_role`
--
ALTER TABLE `ac_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `fk_admin_a_role1_idx` (`role_id`),
  ADD KEY `fk_admin_ref_user_status1_idx` (`user_status_id`);

--
-- Indexes for table `admin_check_login`
--
ALTER TABLE `admin_check_login`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `fk_login_check_admin_admin1_idx` (`admin_id`);

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`agent_id`),
  ADD KEY `fk_agent_teams1_idx` (`teams_id`),
  ADD KEY `fk_agent_status_id12` (`agent_status_id`),
  ADD KEY `fk_agent_type_id12` (`agent_type_id`);

--
-- Indexes for table `ai_apsth_session`
--
ALTER TABLE `ai_apsth_session`
  ADD PRIMARY KEY (`id`,`ip_address`);

--
-- Indexes for table `app_facebook`
--
ALTER TABLE `app_facebook`
  ADD PRIMARY KEY (`app_facebook_id_pri`);

--
-- Indexes for table `a_group_menu`
--
ALTER TABLE `a_group_menu`
  ADD PRIMARY KEY (`group_menu_id`);

--
-- Indexes for table `a_map_menu_role`
--
ALTER TABLE `a_map_menu_role`
  ADD PRIMARY KEY (`map_role_menu_id`),
  ADD KEY `fk_map_role_menu_menu1_idx` (`menu_id`),
  ADD KEY `fk_map_role_menu_role1_idx` (`role_id`);

--
-- Indexes for table `a_menu`
--
ALTER TABLE `a_menu`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `fk_menu_group_menu1_idx` (`group_menu_id`);

--
-- Indexes for table `a_role`
--
ALTER TABLE `a_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `chatbot_admin_session`
--
ALTER TABLE `chatbot_admin_session`
  ADD PRIMARY KEY (`id`,`ip_address`);

--
-- Indexes for table `hook`
--
ALTER TABLE `hook`
  ADD PRIMARY KEY (`hook_id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `fk_image_teams2_idx` (`teams_id`);

--
-- Indexes for table `log_admin_login`
--
ALTER TABLE `log_admin_login`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_log_admin_login_admin1_idx` (`admin_id`);

--
-- Indexes for table `log_agent`
--
ALTER TABLE `log_agent`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_log_agent_user1_idx` (`user_id`);

--
-- Indexes for table `log_package`
--
ALTER TABLE `log_package`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_log_package_package1_idx` (`package_id`),
  ADD KEY `fk_log_package_teams1_idx` (`teams_id`);

--
-- Indexes for table `log_send_sms`
--
ALTER TABLE `log_send_sms`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fa_send_sms_user_id` (`user_id`);

--
-- Indexes for table `log_user_login`
--
ALTER TABLE `log_user_login`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_log_user_login_user1_idx1` (`user_id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `fk_payment_package1_idx` (`package_id`),
  ADD KEY `fk_payment_user1_idx` (`user_id`),
  ADD KEY `fk_payment_ref_bank1_idx` (`bank_id`),
  ADD KEY `fk_payment_ref_payment_status1_idx` (`payment_status_id`);

--
-- Indexes for table `ref_agent_status`
--
ALTER TABLE `ref_agent_status`
  ADD PRIMARY KEY (`agent_status_id`);

--
-- Indexes for table `ref_agent_type`
--
ALTER TABLE `ref_agent_type`
  ADD PRIMARY KEY (`agent_type_id`);

--
-- Indexes for table `ref_bank`
--
ALTER TABLE `ref_bank`
  ADD PRIMARY KEY (`bank_id`),
  ADD KEY `fk_ref_bank_ref_bank_icon1_idx` (`bank_icon_id`);

--
-- Indexes for table `ref_bank_icon`
--
ALTER TABLE `ref_bank_icon`
  ADD PRIMARY KEY (`bank_icon_id`);

--
-- Indexes for table `ref_payment_status`
--
ALTER TABLE `ref_payment_status`
  ADD PRIMARY KEY (`payment_status_id`);

--
-- Indexes for table `ref_user_status`
--
ALTER TABLE `ref_user_status`
  ADD PRIMARY KEY (`user_status_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`teams_id`),
  ADD KEY `fk_teams_package1_idx` (`package_id`);

--
-- Indexes for table `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`training_id`),
  ADD KEY `fk_training_user1_idx` (`user_id`),
  ADD KEY `fk_training_hook1_idx` (`hook_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_user_role1_idx` (`role_id`),
  ADD KEY `fk_user_ref_user_status1_idx1` (`user_status_id`),
  ADD KEY `fk_user_teams1_idx` (`teams_id`);

--
-- Indexes for table `user_check_login`
--
ALTER TABLE `user_check_login`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `fk_user_check_login_user1_idx` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ac_group_menu`
--
ALTER TABLE `ac_group_menu`
  MODIFY `group_menu_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ac_map_menu_package`
--
ALTER TABLE `ac_map_menu_package`
  MODIFY `menu_package_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ac_map_menu_role`
--
ALTER TABLE `ac_map_menu_role`
  MODIFY `map_role_menu_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ac_menu`
--
ALTER TABLE `ac_menu`
  MODIFY `menu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ac_role`
--
ALTER TABLE `ac_role`
  MODIFY `role_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_check_login`
--
ALTER TABLE `admin_check_login`
  MODIFY `login_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agent`
--
ALTER TABLE `agent`
  MODIFY `agent_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_facebook`
--
ALTER TABLE `app_facebook`
  MODIFY `app_facebook_id_pri` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `a_group_menu`
--
ALTER TABLE `a_group_menu`
  MODIFY `group_menu_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `a_map_menu_role`
--
ALTER TABLE `a_map_menu_role`
  MODIFY `map_role_menu_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `a_menu`
--
ALTER TABLE `a_menu`
  MODIFY `menu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `a_role`
--
ALTER TABLE `a_role`
  MODIFY `role_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hook`
--
ALTER TABLE `hook`
  MODIFY `hook_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `image_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_admin_login`
--
ALTER TABLE `log_admin_login`
  MODIFY `log_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `log_agent`
--
ALTER TABLE `log_agent`
  MODIFY `log_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_package`
--
ALTER TABLE `log_package`
  MODIFY `log_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_send_sms`
--
ALTER TABLE `log_send_sms`
  MODIFY `log_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_user_login`
--
ALTER TABLE `log_user_login`
  MODIFY `log_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ref_agent_type`
--
ALTER TABLE `ref_agent_type`
  MODIFY `agent_type_id` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ref_bank`
--
ALTER TABLE `ref_bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ref_user_status`
--
ALTER TABLE `ref_user_status`
  MODIFY `user_status_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `teams_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `training`
--
ALTER TABLE `training`
  MODIFY `training_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_check_login`
--
ALTER TABLE `user_check_login`
  MODIFY `login_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ac_map_menu_package`
--
ALTER TABLE `ac_map_menu_package`
  ADD CONSTRAINT `fk_ac_map_menu_package_ac_menu1` FOREIGN KEY (`menu_id`) REFERENCES `ac_menu` (`menu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ac_map_menu_package_shop_package1` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ac_map_menu_role`
--
ALTER TABLE `ac_map_menu_role`
  ADD CONSTRAINT `fk_map_role_menu_menu1` FOREIGN KEY (`menu_id`) REFERENCES `ac_menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_map_role_menu_role1` FOREIGN KEY (`role_id`) REFERENCES `ac_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ac_menu`
--
ALTER TABLE `ac_menu`
  ADD CONSTRAINT `fk_ac_menu_ac_group_menu1` FOREIGN KEY (`group_menu_id`) REFERENCES `ac_group_menu` (`group_menu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_admin_a_role1` FOREIGN KEY (`role_id`) REFERENCES `a_role` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_admin_ref_user_status1` FOREIGN KEY (`user_status_id`) REFERENCES `ref_user_status` (`user_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `admin_check_login`
--
ALTER TABLE `admin_check_login`
  ADD CONSTRAINT `fk_login_check_admin_admin1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `agent`
--
ALTER TABLE `agent`
  ADD CONSTRAINT `fk_agent_status_id12` FOREIGN KEY (`agent_status_id`) REFERENCES `ref_agent_status` (`agent_status_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_agent_teams1` FOREIGN KEY (`teams_id`) REFERENCES `teams` (`teams_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_agent_type_id12` FOREIGN KEY (`agent_type_id`) REFERENCES `ref_agent_type` (`agent_type_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `a_map_menu_role`
--
ALTER TABLE `a_map_menu_role`
  ADD CONSTRAINT `fk_map_role_menu_menu10` FOREIGN KEY (`menu_id`) REFERENCES `a_menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_map_role_menu_role10` FOREIGN KEY (`role_id`) REFERENCES `a_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `a_menu`
--
ALTER TABLE `a_menu`
  ADD CONSTRAINT `fk_menu_group_menu10` FOREIGN KEY (`group_menu_id`) REFERENCES `a_group_menu` (`group_menu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_image_teams2` FOREIGN KEY (`teams_id`) REFERENCES `teams` (`teams_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `log_admin_login`
--
ALTER TABLE `log_admin_login`
  ADD CONSTRAINT `fk_log_admin_login_admin1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `log_agent`
--
ALTER TABLE `log_agent`
  ADD CONSTRAINT `fk_log_agent_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log_package`
--
ALTER TABLE `log_package`
  ADD CONSTRAINT `fk_log_package_package1` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_log_package_teams1` FOREIGN KEY (`teams_id`) REFERENCES `teams` (`teams_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log_send_sms`
--
ALTER TABLE `log_send_sms`
  ADD CONSTRAINT `fa_send_sms_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `log_user_login`
--
ALTER TABLE `log_user_login`
  ADD CONSTRAINT `fk_log_user_login_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_payment_package1` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_payment_ref_bank1` FOREIGN KEY (`bank_id`) REFERENCES `ref_bank` (`bank_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_payment_ref_payment_status1` FOREIGN KEY (`payment_status_id`) REFERENCES `ref_payment_status` (`payment_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ref_bank`
--
ALTER TABLE `ref_bank`
  ADD CONSTRAINT `fk_ref_bank_ref_bank_icon1` FOREIGN KEY (`bank_icon_id`) REFERENCES `ref_bank_icon` (`bank_icon_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `fk_teams_package1` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `training`
--
ALTER TABLE `training`
  ADD CONSTRAINT `fk_training_hook1` FOREIGN KEY (`hook_id`) REFERENCES `hook` (`hook_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_training_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_ref_user_status1` FOREIGN KEY (`user_status_id`) REFERENCES `ref_user_status` (`user_status_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_role1` FOREIGN KEY (`role_id`) REFERENCES `ac_role` (`role_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_teams1` FOREIGN KEY (`teams_id`) REFERENCES `teams` (`teams_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_check_login`
--
ALTER TABLE `user_check_login`
  ADD CONSTRAINT `fk_user_check_login_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
