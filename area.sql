-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2024 at 12:43 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unievere_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `area` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `state_id`, `city_id`, `area`, `created_at`, `updated_at`) VALUES
(3, 31, 31, 'مصباح', NULL, NULL),
(4, 31, 31, 'قلمستان', NULL, NULL),
(5, 31, 31, 'بلوار امام زاده حسن', NULL, NULL),
(6, 31, 31, 'مصلای کرج', NULL, NULL),
(7, 31, 31, 'کارخانه قند', NULL, NULL),
(8, 31, 31, 'شهرک فهمیده', NULL, NULL),
(9, 31, 31, 'بلوار هفت تیر', NULL, NULL),
(10, 31, 31, 'عظیمیه', NULL, NULL),
(11, 31, 31, 'خلج آباد', NULL, NULL),
(12, 31, 31, 'خیابان بهار', NULL, NULL),
(13, 31, 31, 'خیابان برغان', NULL, NULL),
(14, 31, 31, 'اسلام آباد (زورآباد)', NULL, NULL),
(15, 31, 31, 'کیانمهر', NULL, NULL),
(16, 31, 31, 'قزلحصار', NULL, NULL),
(17, 31, 31, 'کوی مهر', NULL, NULL),
(18, 31, 31, 'آق تپه', NULL, NULL),
(19, 31, 31, 'اراضی ساماندهی', NULL, NULL),
(20, 31, 31, 'سهرابیه', NULL, NULL),
(21, 31, 31, 'مهرشهر', NULL, NULL),
(22, 31, 31, 'فاز 1 تا 5 مهرشهر', NULL, NULL),
(23, 31, 31, 'احدآباد', NULL, NULL),
(24, 31, 31, 'اسدآباد', NULL, NULL),
(25, 31, 31, 'شهرک ولی عصر', NULL, NULL),
(26, 31, 31, 'گلشهر', NULL, NULL),
(27, 31, 31, 'درختی', NULL, NULL),
(28, 31, 31, 'گلزار', NULL, NULL),
(29, 31, 31, 'حصارک پایین', NULL, NULL),
(30, 31, 31, 'المهدی', NULL, NULL),
(31, 31, 31, 'میانجاده', NULL, NULL),
(32, 31, 31, 'حیدرآباد', NULL, NULL),
(33, 31, 31, 'باغستان غربی', NULL, NULL),
(34, 31, 31, 'حصارک بالا', NULL, NULL),
(35, 31, 31, 'شاهین ویلا', NULL, NULL),
(36, 31, 31, 'صوفی آباد', NULL, NULL),
(37, 31, 31, 'شهرک ظفر', NULL, NULL),
(38, 31, 31, 'گوهردشت (رجایی شهر)', NULL, NULL),
(39, 31, 31, 'شهرک اوج', NULL, NULL),
(40, 31, 31, 'شهرک جهازیها', NULL, NULL),
(41, 31, 31, 'کوی امامیه', NULL, NULL),
(42, 31, 31, 'کوی قائم', NULL, NULL),
(43, 31, 31, 'بلوار رستاخیز', NULL, NULL),
(44, 31, 31, 'بلوار انقلاب', NULL, NULL),
(45, 31, 31, 'برغان', NULL, NULL),
(46, 31, 31, 'خیابان بهار', NULL, NULL),
(47, 31, 31, 'خیابان چالوس', NULL, NULL),
(48, 31, 31, 'اسلام آباد', NULL, NULL),
(49, 31, 31, 'چهارصد دستگاه', NULL, NULL),
(50, 31, 31, 'مهرویلا', NULL, NULL),
(51, 31, 31, 'آسیاب برجی', NULL, NULL),
(52, 31, 31, 'دولت آباد', NULL, NULL),
(53, 31, 31, 'دانشکده کشاورزی', NULL, NULL),
(54, 31, 31, 'سیمین دشت', NULL, NULL),
(55, 31, 31, 'رزکان', NULL, NULL),
(56, 31, 31, 'منظریه', NULL, NULL),
(57, 31, 31, 'شهرک وحدت', NULL, NULL),
(58, 31, 31, 'واریان شهر', NULL, NULL),
(59, 31, 31, 'کلاک بالا', NULL, NULL),
(60, 31, 31, 'کلاک پایین', NULL, NULL),
(61, 31, 31, 'حصار', NULL, NULL),
(62, 31, 31, 'شهرک جهان نما', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
