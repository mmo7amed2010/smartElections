-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2019 at 12:24 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ip`
--

-- --------------------------------------------------------

--
-- Table structure for table `elections`
--

CREATE TABLE `elections` (
  `id` int(11) NOT NULL,
  `national_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elections`
--

INSERT INTO `elections` (`id`, `national_id`, `name`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, '29604160103517', 'وليد عمادالدين عزت مصطفى', '  ٣٥٥ ش رمسيس -العباسية -الوايلى -القاهرة', 'yes', '2019-05-01 14:23:26', '2019-05-04 08:32:51'),
(2, '29601250101557', 'محمد جمال عباس نصير', 'المنطقة العاشرة -ق3 -ب23 -مدينة نصر اول', 'yes', '2019-05-01 14:23:26', '2019-05-04 08:33:09'),
(3, '29603260103135', 'محمد عادل محمد شندى محمد', '917 زهراء مدينة نصر- مدينة نصر اول القاهرة', 'no', '2019-05-01 14:23:26', '2019-05-04 02:34:46'),
(4, '29509302106311', 'كريم محمد فرج  محمد احمد اللبودى', 'بلوك 46-قطعة 6-الحى الثامن -منطقة 9', 'yes', '2019-05-01 14:23:26', '2019-05-04 09:54:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `elections`
--
ALTER TABLE `elections`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `elections`
--
ALTER TABLE `elections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
