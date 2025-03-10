-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2025 at 12:16 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kote`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_status` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_name`, `updated_at`, `created_at`) VALUES
(5, 'test12', '2024-12-30 15:39:54', '2024-12-30 10:08:58'),
(6, 'Branch2', '2025-01-02 14:06:47', '2025-01-02 08:36:47'),
(7, 'Branch3', '2025-01-02 14:06:56', '2025-01-02 08:36:56');

-- --------------------------------------------------------

--
-- Table structure for table `companys`
--

CREATE TABLE `companys` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `companys`
--

INSERT INTO `companys` (`id`, `company_name`, `updated_at`, `created_at`) VALUES
(1, 'acoyd', '2025-01-18 15:53:42', '2025-01-18 10:23:34');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(255) DEFAULT NULL,
  `fp_key` longblob DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `rank_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `emp_id`, `fp_key`, `mobile`, `status`, `rank_id`, `name`, `unit_id`, `company_id`, `photo`, `updated_at`, `created_at`) VALUES
(9, '5345', 0xc4383bc93940ee7b7c8968bc3c091b4bc0ae7270dee394286832f4b558bd60ded419a0b764da0420a8b1cc6119fbb285ba016b903d685461949c84cb23a938cb7e87d79733c8cbd07444c8a5fa10d8ffa2d1da068baf1ad2aec53f21017216f93b6b6872d31de02ad271ab2e45012aa205eb6b2c62846fbb0e33c5689d85181e8944bd2040f5f696ad690acd04a20b83daf2951c424abc3c62eb370e34b781b04b1c0ebdd2e2636ab1d48947406e138e8a7ba96bfbd09ec969ac2694a200a2241b2dc9ebaf0d5f602a64ff47f06cf97c1b2dc9ebaf0d5f602a64ff47f06cf97c1b2dc9ebaf0d5f602a64ff47f06cf97c1b2dc9ebaf0d5f602a64ff47f06cf97c1b2dc9ebaf0d5f602a64ff47f06cf97c1b2dc9ebaf0d5f602a64ff47f06cf97c1b2dc9ebaf0d5f602a64ff47f06cf97c1b2dc9ebaf0d5f602a64ff47f06cf97c1b2dc9ebaf0d5f602a64ff47f06cf97c1b2dc9ebaf0d5f602a64ff47f06cf97c1b2dc9ebaf0d5f602a64ff47f06cf97c1b2dc9ebaf0d5f602a64ff47f06cf97c1b2dc9ebaf0d5f602a64ff47f06cf97c, NULL, 1, 4, 'test2', 9, 1, '/storage/images/dg63SAz57FEapc8YvMmascmf84Cpf213WlcvR6PV.jpg', '2025-02-13 15:24:29', '2025-01-20 10:27:50'),
(13, '534534', 0xf83a0d4530f00d74fee03f942dd6c8dd9fbcff6f4dc488d17a403e2471c8963d3f19840c7a63bc6924c9548ebe978d576ebd85f38db8f497e33b0cbffda172c73f964495d5e0f368e85bf6344a17ee371d54054da1baf4784c8ad36fa2e65585d6738b1f7db789a29c2df23c1c62896c62fffae42ea52b474897f0271744d53e38e3f0fe6e6f7da7aa025366133434e60474c7ed9c4946411f965385925e155d22291f65ef1051070fe30a5e3642238a4c3b38acb10333219c46f15c183ea702cec37bd1a6696e29f8a50bd943a78932c085887d8e2a872012983105e12615b2bf68db0074ec1a843148f6ca0770a643fd7acd2643011fdd3ccd91c1b7c4e6bec38fd74779c50f92b45ef73b6f3fd92f8b0e2a543f27b9af9a12ff2b09fe485cbd8872cc1ca99caa77662930da2864499db33d91a5a93031dd5b5b37d7f0325e1b2dc9ebaf0d5f602a64ff47f06cf97c1b2dc9ebaf0d5f602a64ff47f06cf97c1b2dc9ebaf0d5f602a64ff47f06cf97c1b2dc9ebaf0d5f602a64ff47f06cf97c1b2dc9ebaf0d5f602a64ff47f06cf97c, NULL, 1, 4, 'Ravi Raj', 9, 1, '/storage/images/67ab28a3402c7.jpeg', '2025-02-11 16:11:24', '2025-02-11 10:38:27');

-- --------------------------------------------------------

--
-- Table structure for table `fund_cat`
--

CREATE TABLE `fund_cat` (
  `id` int(11) NOT NULL,
  `fund_cat_name` varchar(255) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fund_cat`
--

INSERT INTO `fund_cat` (`id`, `fund_cat_name`, `updated_at`, `created_at`) VALUES
(4, 'fund1', '2024-12-30 16:09:14', '2024-12-30 10:34:37'),
(5, 'fund2', '2024-12-30 16:09:27', '2024-12-30 10:39:27');

-- --------------------------------------------------------

--
-- Table structure for table `fund_subcat`
--

CREATE TABLE `fund_subcat` (
  `id` int(11) NOT NULL,
  `fund_subcat_name` varchar(255) DEFAULT NULL,
  `fund_cat_id` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fund_subcat`
--

INSERT INTO `fund_subcat` (`id`, `fund_subcat_name`, `fund_cat_id`, `updated_at`, `created_at`) VALUES
(1, 'abvc', 2, '2024-12-23 22:21:24', '2024-12-23 10:06:47'),
(4, 'subfund2', 5, '2024-12-30 16:53:13', '2024-12-30 11:22:59');

-- --------------------------------------------------------

--
-- Table structure for table `issued_products`
--

CREATE TABLE `issued_products` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `issued_qty` int(11) DEFAULT NULL,
  `serial_no` varchar(255) DEFAULT NULL,
  `issued_to` varchar(255) DEFAULT NULL,
  `branch_store_id` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issued_products`
--

INSERT INTO `issued_products` (`id`, `product_id`, `issued_qty`, `serial_no`, `issued_to`, `branch_store_id`, `updated_at`, `created_at`) VALUES
(1, 5, 3, NULL, 'branch', 5, '2025-01-02 14:04:44', '2025-01-02 08:34:44'),
(2, 5, 4, NULL, 'store', 5, '2025-01-02 14:05:08', '2025-01-02 08:35:08'),
(3, 3, 4, NULL, 'branch', 7, '2025-01-02 14:09:03', '2025-01-02 08:39:03'),
(5, 4, 3, NULL, 'branch', 5, '2025-01-03 13:29:14', '2025-01-03 07:59:14'),
(7, 6, 1, '[\"AJ2221554\"]', 'branch', 6, '2025-01-03 16:22:08', '2025-01-03 10:52:08'),
(8, 6, 1, '[\"AK773833\"]', 'branch', 6, '2025-01-04 11:27:31', '2025-01-04 05:57:31');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_qty` int(11) DEFAULT NULL,
  `issued_qty` int(11) DEFAULT 0,
  `having_serial` varchar(255) DEFAULT NULL,
  `serial_no` varchar(255) DEFAULT NULL,
  `product_cat_id` int(11) DEFAULT NULL,
  `product_img` varchar(255) DEFAULT NULL,
  `fund_sub_cat_id` int(11) DEFAULT NULL,
  `fund_sub_id` int(11) DEFAULT NULL,
  `crv_no` varchar(50) DEFAULT NULL,
  `crv_date` date DEFAULT NULL,
  `ledger_no` varchar(50) DEFAULT NULL,
  `ledger_page_no` varchar(255) DEFAULT NULL,
  `issue_voucher_no` varchar(255) DEFAULT NULL,
  `issue_voucher_date` date DEFAULT NULL,
  `bill_no` varchar(255) DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `warranty_yr` varchar(255) DEFAULT NULL,
  `warranty_exp_date` date DEFAULT NULL,
  `amc_due_date` date DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `annual_dep` varchar(255) DEFAULT NULL,
  `current_price` varchar(255) DEFAULT NULL,
  `scan_barcode` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_qty`, `issued_qty`, `having_serial`, `serial_no`, `product_cat_id`, `product_img`, `fund_sub_cat_id`, `fund_sub_id`, `crv_no`, `crv_date`, `ledger_no`, `ledger_page_no`, `issue_voucher_no`, `issue_voucher_date`, `bill_no`, `bill_date`, `warranty_yr`, `warranty_exp_date`, `amc_due_date`, `price`, `annual_dep`, `current_price`, `scan_barcode`, `remarks`, `updated_at`, `created_at`) VALUES
(2, 'chair', 20, 0, 'no', NULL, 3, '', 5, 1, '12', '2025-01-01', '121', '1', '2', '2025-01-01', '332', '2025-01-01', '2', '2025-01-01', '2025-01-01', '2300', '22', '2222', '434242', '2342', '2025-01-02 15:15:25', '2025-01-01 07:36:28'),
(3, 'chai', 45, 4, 'no', NULL, 3, 'images/StF0wkb7RxJG4Nowxv8bP30ir5BEXZBk1CY3SJra.png', 5, 1, '12', '2025-01-01', '121', '332', '33', '2025-01-01', '21', '2025-01-01', '2', '2025-01-01', '2025-01-01', '224', '3', '223', '332', '554', '2025-01-02 15:10:40', '2025-01-01 07:49:26'),
(4, 'edit table', 24, 6, 'no', NULL, 3, 'images/OIHZfP5nGODU3ltIALHKYFUGcKvaYiLipHtlxB2L.png', 5, 4, '12', '2025-01-01', '121', '332', '33', '2025-01-01', '21', '2025-01-01', '2', '2025-01-01', '2025-01-01', '224', '3', '223', '332', '554', '2025-01-03 13:29:14', '2025-01-01 10:47:57'),
(5, 'tables', 4, 0, 'yes', '[\"AJ2221554\",\"AK773833\",\"AG998344\",\"GF912266\"]', 3, 'images/9JXiffpwyConokZgAi6PoNfQMeQUP9MY07UZLTNF.png', 5, 1, '12', '2025-01-07', '121', '332', '33', '2025-01-02', '21', '2025-01-02', '2', '2025-01-02', '2025-01-06', '224', '3', '223', '332', '554', '2025-01-03 16:16:20', '2025-01-01 11:42:34'),
(6, 'computer', 2, 2, 'yes', '[\"AG998344\",\"GF912266\"]', 3, 'images/S9oN9s5Dp3N33rYkZGy1O9OmFQKANf20mglqaTxY.png', 4, 4, '12', '2025-01-02', '121', '332', '33', '2025-01-01', '21', '2025-01-02', '2', '2025-01-02', '2025-01-01', '224', '3', '223', '332', 'wtref', '2025-01-04 11:27:31', '2025-01-03 06:03:56');

-- --------------------------------------------------------

--
-- Table structure for table `product_cat`
--

CREATE TABLE `product_cat` (
  `id` int(11) NOT NULL,
  `p_cat_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_cat`
--

INSERT INTO `product_cat` (`id`, `p_cat_name`, `updated_at`, `created_at`) VALUES
(3, 'HeavyVd', '2024-12-30 13:22:18', '2024-12-30 07:51:02');

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `id` int(11) NOT NULL,
  `rank_name` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`id`, `rank_name`, `updated_at`, `created_at`) VALUES
(4, 'MR', '2025-02-13 15:23:38', '2025-01-18 09:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `store_name` varchar(255) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `store_name`, `updated_at`, `created_at`) VALUES
(5, 'abc', '2024-12-30 15:27:40', '2024-12-30 09:57:40'),
(6, 'store2', '2025-01-02 14:06:28', '2025-01-02 08:36:28'),
(7, 'store3', '2025-01-02 14:06:37', '2025-01-02 08:36:37');

-- --------------------------------------------------------

--
-- Table structure for table `titles`
--

CREATE TABLE `titles` (
  `id` int(11) NOT NULL,
  `title1` varchar(255) NOT NULL,
  `title2` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `titles`
--

INSERT INTO `titles` (`id`, `title1`, `title2`, `updated_at`, `created_at`) VALUES
(1, 'Wpn Inventory System', 'Subtitle', '2025-01-27 17:32:12', '2025-01-27 11:31:55');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `unit_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `unit_id` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_name`, `unit_id`, `updated_at`, `created_at`) VALUES
(9, 'A unit', 'U9', '2024-11-02 19:41:59', '2024-11-02 14:11:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL COMMENT '1 - admin\r\n2 - stage 1     \r\n3 - stage 2\r\n4 - stage 3\r\n5 -stage 4',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role_id`, `updated_at`, `created_at`) VALUES
(10, 'adminadmin', 'admin2', '$2y$10$7UyBnn12FZEVnvkWkIYfbOy6bnKUEyES5FpD0b7RuKP2SGuPOWyVO', 1, '2024-06-28 16:35:58', '2024-06-28 11:05:58'),
(12, 'ravi5', 'ravi1010', '$2y$10$ZDxb2eUGjaogT31okC94AeCFeWVgoBG/MzSS8KV4PgVw7gIKIsHjO', 4, '2024-11-30 19:56:48', '2024-11-30 11:50:18'),
(13, 'arun', 'arun112', '$2y$10$XYRGa4KuaNtqrxlQ02JzB.dt0Ve9fj9miwGX8qd9wImhYLEfdRbPq', 5, '2024-11-30 19:56:56', '2024-11-30 12:56:50'),
(14, 'gaurav', 'gaurav', '$2y$10$ks6.asQHLSITrK4iBaXWGunDRGiNaxABjxg9Rvr5jMmTN8efCCU5u', 2, '2024-11-30 19:56:18', '2024-11-30 14:26:18'),
(15, 'ankit', 'ankit', '$2y$10$v88yUjnDADLBefNspOlKyehE84.A.TyDuGBgfMOVwiR2V.38ubgZe', 3, '2024-11-30 19:56:37', '2024-11-30 14:26:37');

-- --------------------------------------------------------

--
-- Table structure for table `wpn_allot`
--

CREATE TABLE `wpn_allot` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(255) DEFAULT NULL,
  `wpn_id` int(11) DEFAULT NULL,
  `assign_type` varchar(50) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wpn_allot`
--

INSERT INTO `wpn_allot` (`id`, `emp_id`, `wpn_id`, `assign_type`, `updated_at`, `created_at`) VALUES
(10, '5345', 3, 'Primary', '2025-02-11 16:20:28', '2025-01-23 10:59:30'),
(11, '5345', 4, 'Secondary', '2025-02-11 16:17:04', '2025-02-11 10:47:04'),
(13, '5345', 6, 'Secondary', '2025-02-11 16:20:21', '2025-02-11 10:50:21');

-- --------------------------------------------------------

--
-- Table structure for table `wpn_issue_rec`
--

CREATE TABLE `wpn_issue_rec` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(255) DEFAULT NULL,
  `wpn_id` int(11) DEFAULT NULL,
  `nature` int(11) DEFAULT NULL COMMENT '0 = Less Than 24hr,        1 = More Than 24hr',
  `purpose` varchar(255) DEFAULT NULL,
  `megazins` int(11) DEFAULT NULL,
  `slings` int(11) DEFAULT NULL,
  `bayonet` int(11) DEFAULT NULL,
  `return_date` datetime DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `remark` varchar(255) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wpn_issue_rec`
--

INSERT INTO `wpn_issue_rec` (`id`, `emp_id`, `wpn_id`, `nature`, `purpose`, `megazins`, `slings`, `bayonet`, `return_date`, `status`, `remark`, `updated_at`, `created_at`) VALUES
(1, '5345', 4, 0, 'maintainance', 2, 2, 2, '2025-01-25 23:37:43', 1, 'dsf', '2025-02-11 17:26:36', '2025-01-24 05:24:39'),
(4, '5345', 5, 0, 'maintainance', 4, 4, 4, '2025-01-25 23:41:01', 1, '4', '2025-02-11 17:26:39', '2025-01-24 06:16:54'),
(5, '5345', 3, 0, 'maintainance', 10, 10, 10, '2025-01-25 23:44:03', 1, 'wef', '2025-02-11 17:26:41', '2025-01-25 18:13:21'),
(6, '5345', 4, 0, 'maintainance', 4, 5, 55, '2025-01-25 23:53:26', 1, 'jhgh', '2025-02-11 17:26:43', '2025-01-25 18:21:38'),
(7, '5345', 4, 0, 'maintainance', 10, 10, 109, '2025-01-27 14:08:31', 1, 'hfhfh', '2025-02-11 17:27:57', '2025-01-27 08:36:26'),
(8, '5345', 5, 0, 'maintainance', 5, 5, 55, '2025-02-11 17:34:48', 1, 'gh', '2025-02-11 17:34:48', '2025-01-27 10:13:10'),
(9, '5345', 4, 0, 'maintainance', 1, 1, 1, '2025-02-11 16:37:28', 1, '1', '2025-02-11 17:28:04', '2025-02-11 11:06:07'),
(10, '5345', 4, 0, 'maintainance', 1, 1, 1, '2025-02-11 17:50:56', 1, 'test', '2025-02-11 17:50:56', '2025-02-11 11:36:06'),
(11, '5345', 3, 0, 'maintainance', 1, 1, 1, '2025-02-11 17:44:48', 1, 'trs', '2025-02-11 17:44:48', '2025-02-11 12:04:00'),
(12, '5345', 5, 0, 'maintainance', NULL, NULL, NULL, '2025-02-11 17:44:48', 1, NULL, '2025-02-11 17:44:48', '2025-02-11 12:09:55'),
(13, '5345', 6, 0, 'maintainance', 1, 1, 1, '2025-02-11 17:49:43', 1, 'dad', '2025-02-11 17:49:43', '2025-02-11 12:13:41'),
(14, '5345', 3, 0, 'maintainance', 1, 1, 1, '2025-02-11 17:49:43', 1, 'arere', '2025-02-11 17:49:43', '2025-02-11 12:15:47'),
(15, '5345', 5, 0, 'maintainance', 1, 1, 1, '2025-02-11 17:49:43', 1, '1', '2025-02-11 17:49:43', '2025-02-11 12:18:24'),
(16, '5345', 5, 0, 'maintainance', 1, 1, 1, NULL, 0, '1', '2025-02-11 17:50:08', '2025-02-11 12:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `wpn_list`
--

CREATE TABLE `wpn_list` (
  `id` int(11) NOT NULL,
  `wpn_tag` varchar(255) DEFAULT NULL,
  `wpn_type` int(11) DEFAULT NULL,
  `regd_no` varchar(255) DEFAULT NULL,
  `butt_no` varchar(255) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `servicability` varchar(50) DEFAULT NULL COMMENT '\r\n',
  `emp_id` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 0 COMMENT '0 - IN, 1- Out',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wpn_list`
--

INSERT INTO `wpn_list` (`id`, `wpn_tag`, `wpn_type`, `regd_no`, `butt_no`, `company_id`, `remarks`, `servicability`, `emp_id`, `status`, `updated_at`, `created_at`) VALUES
(3, '54465', 3, '6677', '7765', 1, 'yggjk', 'Yes', NULL, 0, '2025-02-11 17:49:43', '2025-01-20 12:28:51'),
(4, '123', 3, '653', '343', 1, 'sf', 'Yes', NULL, 0, '2025-02-11 17:50:56', '2025-01-23 18:41:29'),
(5, '55', 3, '543', '23', 1, '6y', 'Yes', NULL, 1, '2025-02-11 17:50:08', '2025-01-23 18:41:47'),
(6, '44334', 4, '56544', '334', 1, 'ewrew', 'Yes', NULL, 0, '2025-02-11 17:49:43', '2025-02-11 10:43:49');

-- --------------------------------------------------------

--
-- Table structure for table `wpn_ret_mag_history`
--

CREATE TABLE `wpn_ret_mag_history` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(255) DEFAULT NULL,
  `wpn_id` int(11) DEFAULT NULL,
  `issue_id` int(11) DEFAULT NULL,
  `ret_megazins` int(11) DEFAULT NULL,
  `ret_slings` int(11) DEFAULT NULL,
  `ret_bayonet` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wpn_ret_mag_history`
--

INSERT INTO `wpn_ret_mag_history` (`id`, `emp_id`, `wpn_id`, `issue_id`, `ret_megazins`, `ret_slings`, `ret_bayonet`, `updated_at`, `created_at`) VALUES
(1, '5345', 4, 1, 2, 2, 2, '2025-01-25 23:37:43', '2025-01-25 18:07:43'),
(2, '5345', 5, 4, 44, 4, 4, '2025-01-25 23:41:01', '2025-01-25 18:11:01'),
(3, '5345', 3, 5, 10, 10, 10, '2025-01-25 23:44:03', '2025-01-25 18:14:03'),
(4, '5345', 4, 6, 4, 4, 4, '2025-01-25 23:53:26', '2025-01-25 18:23:26'),
(5, '5345', 4, 7, 10, 10, 3, '2025-01-27 14:08:31', '2025-01-27 08:38:31'),
(6, '5345', 4, 9, 1, 1, 1, '2025-02-11 16:37:28', '2025-02-11 11:07:28'),
(7, '5345', 5, 8, 5, 5, 5, '2025-02-11 17:34:48', '2025-02-11 12:04:48'),
(8, '5345', 5, 12, 1, 1, 1, '2025-02-11 17:44:48', '2025-02-11 12:14:48'),
(9, '5345', 3, 11, 1, 1, 1, '2025-02-11 17:44:48', '2025-02-11 12:14:48'),
(10, '5345', 5, 15, NULL, NULL, NULL, '2025-02-11 17:49:43', '2025-02-11 12:19:43'),
(11, '5345', 6, 13, NULL, NULL, NULL, '2025-02-11 17:49:43', '2025-02-11 12:19:43'),
(12, '5345', 3, 14, NULL, NULL, NULL, '2025-02-11 17:49:43', '2025-02-11 12:19:43'),
(13, '5345', 4, 10, NULL, NULL, NULL, '2025-02-11 17:50:56', '2025-02-11 12:20:56');

-- --------------------------------------------------------

--
-- Table structure for table `wpn_types`
--

CREATE TABLE `wpn_types` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wpn_types`
--

INSERT INTO `wpn_types` (`id`, `type`, `qty`, `updated_at`, `created_at`) VALUES
(3, 'shotgun', 10, '2025-01-21 23:59:25', '2025-01-21 18:29:25'),
(4, 'sniper', 10, '2025-02-11 16:13:27', '2025-02-11 10:43:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companys`
--
ALTER TABLE `companys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emp_code` (`emp_id`);

--
-- Indexes for table `fund_cat`
--
ALTER TABLE `fund_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fund_subcat`
--
ALTER TABLE `fund_subcat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issued_products`
--
ALTER TABLE `issued_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_cat`
--
ALTER TABLE `product_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rank`
--
ALTER TABLE `rank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `titles`
--
ALTER TABLE `titles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wpn_allot`
--
ALTER TABLE `wpn_allot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wpn_issue_rec`
--
ALTER TABLE `wpn_issue_rec`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wpn_list`
--
ALTER TABLE `wpn_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wpn_ret_mag_history`
--
ALTER TABLE `wpn_ret_mag_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wpn_types`
--
ALTER TABLE `wpn_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `companys`
--
ALTER TABLE `companys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `fund_cat`
--
ALTER TABLE `fund_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fund_subcat`
--
ALTER TABLE `fund_subcat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `issued_products`
--
ALTER TABLE `issued_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_cat`
--
ALTER TABLE `product_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rank`
--
ALTER TABLE `rank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `titles`
--
ALTER TABLE `titles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `wpn_allot`
--
ALTER TABLE `wpn_allot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `wpn_issue_rec`
--
ALTER TABLE `wpn_issue_rec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `wpn_list`
--
ALTER TABLE `wpn_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wpn_ret_mag_history`
--
ALTER TABLE `wpn_ret_mag_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `wpn_types`
--
ALTER TABLE `wpn_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
