-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2025 at 10:25 AM
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
-- Database: `bumdes_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `opex_peternakan`
--

CREATE TABLE `opex_peternakan` (
  `opex_id` int(11) NOT NULL,
  `opex_tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `opex_nominal` int(11) NOT NULL,
  `opex_kategori` varchar(150) NOT NULL,
  `opex_keterangan` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `opex_peternakan`
--

INSERT INTO `opex_peternakan` (`opex_id`, `opex_tanggal`, `opex_nominal`, `opex_kategori`, `opex_keterangan`) VALUES
(8, '2025-02-24 06:50:20', 1000, '1', ''),
(10, '2025-02-24 07:04:59', 100000, '5', ''),
(11, '2025-02-24 07:07:01', 128, '6', ''),
(12, '2025-02-26 04:56:37', 100, '15', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `opex_peternakan`
--
ALTER TABLE `opex_peternakan`
  ADD PRIMARY KEY (`opex_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `opex_peternakan`
--
ALTER TABLE `opex_peternakan`
  MODIFY `opex_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
