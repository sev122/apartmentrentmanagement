-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2020 at 11:10 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ellapartment`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(6) UNSIGNED NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `bday` date DEFAULT NULL,
  `hometown` varchar(255) NOT NULL,
  `contact_no` varchar(11) NOT NULL,
  `work` varchar(255) NOT NULL,
  `workplace` varchar(255) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(6) NOT NULL,
  `unit_no` varchar(5) DEFAULT NULL,
  `date_first_payment` date NOT NULL,
  `eName` varchar(100) NOT NULL,
  `eContact` varchar(11) NOT NULL,
  `relationship` varchar(150) NOT NULL,
  `account_status` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `firstname`, `lastname`, `gender`, `bday`, `hometown`, `contact_no`, `work`, `workplace`, `username`, `email`, `password`, `role`, `unit_no`, `date_first_payment`, `eName`, `eContact`, `relationship`, `account_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'sofia', 'vergara', '', '0000-00-00', '', '09152221111', '', '', 'sofiavergara', 'sofiavergara@gmail.com', 'sofiavergara', 'admin', '', '0000-00-00', '', '', '', '', '2020-07-28 08:54:07', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'John', 'Doe', '', '0000-00-00', '', '09151112222', '', '', 'johndoe', 'johndoe@gmail.com', 'johndoe_', 'tenant', '1', '0000-00-00', '', '', '', '', '2020-07-28 08:58:50', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(6) UNSIGNED NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `unit_no` varchar(5) NOT NULL,
  `eTotalAmountDue` varchar(20) NOT NULL,
  `totalkwh` varchar(250) NOT NULL,
  `unitkwh` varchar(250) NOT NULL,
  `prevkwh` varchar(250) NOT NULL,
  `wTotalAmountDue` varchar(250) NOT NULL,
  `totalm3` varchar(250) NOT NULL,
  `unitm3` varchar(250) NOT NULL,
  `prevm3` varchar(250) NOT NULL,
  `deposit` varchar(250) NOT NULL,
  `electricTotal` varchar(250) NOT NULL,
  `waterTotal` varchar(250) NOT NULL,
  `rentalTotal` varchar(250) NOT NULL,
  `totalBill` varchar(250) NOT NULL,
  `notes` text NOT NULL,
  `dueDate` varchar(250) NOT NULL,
  `readingDate` varchar(250) NOT NULL,
  `status` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `firstname`, `lastname`, `unit_no`, `eTotalAmountDue`, `totalkwh`, `unitkwh`, `prevkwh`, `wTotalAmountDue`, `totalm3`, `unitm3`, `prevm3`, `deposit`, `electricTotal`, `waterTotal`, `rentalTotal`, `totalBill`, `notes`, `dueDate`, `readingDate`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'John', 'Doe', '1', '', '', '10', '', '', '', '10', '', '1', '', '', '16000', '16000', 'First Reading', '', '2020-06-28', '', '2020-07-28 09:06:05', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'John', 'Doe', '1', '5000', '500', '100', '10', '4000', '400', '80', '10', '', '900', '700', '8000', '9600', '', '2020-07-28', '', '', '2020-07-28 09:07:04', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `webcontents`
--

CREATE TABLE `webcontents` (
  `id` int(6) UNSIGNED NOT NULL,
  `artTitle` text,
  `artLink` text,
  `artBody` text,
  `artImgs` text,
  `unitImgs` text,
  `date_uploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webcontents`
--

INSERT INTO `webcontents` (`id`, `artTitle`, `artLink`, `artBody`, `artImgs`, `unitImgs`, `date_uploaded`, `updated_at`, `deleted_at`) VALUES
(1, 'EllApartment', 'https://www.facebook.com/media/set/?set=a.10210587360148724&type=3', 'EllApartment was built in 2018, located at 28 A Ortigas Avenue, Rosario, Pasig City. It is a type of studio type/apartment, each unit is 18 sqm.\r\nThe apartment is flood-free, the compound is safe and it has CCTV.\r\nThe apartment is close to Church, Wet Market, Supermarket, and Rosario Arcade.', '1595926865_apartment.jpg', NULL, '2020-07-28 09:01:05', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'GUIDELINES NG GENERAL COMMUNITY QUARANTINE (SIMULA JUNE 1, 2020) BASED ON IATF GUIDELINES', 'https://www.facebook.com/PasigPIO/photos/a.881450725347380/1719522868206824/', 'Pinapaalalahanan ang lahat na laging mag suot ng Face mask at sundin ang tamang social distancing.', '1595926906_gcq-guidelines.jpg', NULL, '2020-07-28 09:01:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'PASIG MEGA MARKET SCHEDULE PER BARANGAY', 'https://www.facebook.com/PasigPIO/photos/a.881450725347380/1678460792313032/', '10 Barangays per day, upang panatilihin ang SOCIAL DISTANCING, hinihikayat ang bawat barangay na sumunod sa bagong schedule ng pagpunta sa Pasig Mega Market:', '1595927023_pasig-market-schedule.jpg', NULL, '2020-07-28 09:03:43', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'PASIG CITY ORDINANCE NO.12 SERIES OF 2020', 'https://www.facebook.com/BRGY.RosarioPIO/photos/a.113842570304963/173393064349913/', 'Sec.3 and Sec. 4 \r\nSapilitang pagsusuot ng FACEMASK \r\nMulta 500\r\nPagkakakulong ng 2 buwan\r\nPasig city ordinance no.14 series of 2020 \r\nSec.4 and Sec.8 \r\nMahigpit na pag papatupad ng Social Distancing\r\nMulta 5,000\r\nPagkakakulong ng 6 buwan\r\nsee picture for reference\r\nDahil sa dami ng Kaso ng Covid-19 sa ating brgy minabuti ng ating KAPITAN ELY DELA CRUZ na mag pagawa ng tarpaulin na meron paalala sa lahat na kung hindi niyo susundin ang ating batas ay maaring maharap kayo sa asunto. \r\nAng laging bilin sa atin ng ating Barangay mag tulong tulong tayo na labanan ang COVID19.\r\n#BrgyRosarioPIO\r\n', '1595927094_113034623_173393067683246_6616038215132433657_o.jpg', NULL, '2020-07-28 09:04:54', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `webcontents`
--
ALTER TABLE `webcontents`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `webcontents`
--
ALTER TABLE `webcontents`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
