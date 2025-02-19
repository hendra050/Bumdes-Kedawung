-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2025 at 05:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `hj_pertashop`
--

CREATE TABLE `hj_pertashop` (
  `harga_id` int(11) NOT NULL,
  `harga_tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hj_pertashop`
--

INSERT INTO `hj_pertashop` (`harga_id`, `harga_tanggal`, `harga`) VALUES
(12, '2025-02-13 12:28:45', 11000);

-- --------------------------------------------------------

--
-- Table structure for table `hutang`
--

CREATE TABLE `hutang` (
  `hutang_id` int(11) NOT NULL,
  `hutang_tanggal` date NOT NULL,
  `hutang_nominal` int(11) NOT NULL,
  `hutang_keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `in_pertashop`
--

CREATE TABLE `in_pertashop` (
  `input_id` int(11) NOT NULL,
  `input_tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `input_jumlah` decimal(11,2) NOT NULL,
  `input_perliter` int(11) NOT NULL,
  `input_harga` int(11) NOT NULL,
  `input_foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `in_pertashop`
--

INSERT INTO `in_pertashop` (`input_id`, `input_tanggal`, `input_jumlah`, `input_perliter`, `input_harga`, `input_foto`) VALUES
(10, '2025-02-17 08:43:55', 2000.00, 10000, 20000000, '');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori`) VALUES
(18, 'Pertashop'),
(19, 'Peternakan');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_pertashop`
--

CREATE TABLE `kategori_pertashop` (
  `kategori_id` int(11) NOT NULL,
  `kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_pertashop`
--

INSERT INTO `kategori_pertashop` (`kategori_id`, `kategori`) VALUES
(1, 'listrik'),
(2, 'Tagihan Air'),
(3, 'Tagihan Wifi'),
(6, 'Asset');

-- --------------------------------------------------------

--
-- Table structure for table `opex_pertashop`
--

CREATE TABLE `opex_pertashop` (
  `opex_id` int(11) NOT NULL,
  `opex_tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `opex_kategori` varchar(50) NOT NULL,
  `opex_keterangan` varchar(150) NOT NULL,
  `opex_nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `opex_pertashop`
--

INSERT INTO `opex_pertashop` (`opex_id`, `opex_tanggal`, `opex_kategori`, `opex_keterangan`, `opex_nominal`) VALUES
(14, '2025-02-17 09:46:12', '6', 'kursi', 15000),
(15, '2025-02-17 10:12:44', '6', 'meja', 20000),
(16, '2025-02-18 08:26:18', '6', 'meja', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `out_pertashop`
--

CREATE TABLE `out_pertashop` (
  `output_id` int(11) NOT NULL,
  `output_tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `output_jual` decimal(10,2) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `output_total` int(15) NOT NULL,
  `shift` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `out_pertashop`
--

INSERT INTO `out_pertashop` (`output_id`, `output_tanggal`, `output_jual`, `harga`, `output_total`, `shift`) VALUES
(42, '2025-02-17 09:00:06', 100.00, 11000, 1100000, 'siang');

-- --------------------------------------------------------

--
-- Table structure for table `piutang`
--

CREATE TABLE `piutang` (
  `piutang_id` int(11) NOT NULL,
  `piutang_tanggal` date NOT NULL,
  `piutang_nominal` int(11) NOT NULL,
  `piutang_keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stok_pertashop`
--

CREATE TABLE `stok_pertashop` (
  `stok_id` int(11) NOT NULL,
  `stok_awal` decimal(11,2) DEFAULT NULL,
  `stok_masuk` decimal(11,2) DEFAULT NULL,
  `stok_keluar` decimal(11,2) NOT NULL,
  `stok_sisa` decimal(11,2) NOT NULL,
  `tanggal_masuk` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `odo_masuk` decimal(11,2) NOT NULL,
  `odo_keluar` decimal(11,2) NOT NULL,
  `penguapan` decimal(11,2) NOT NULL,
  `odo` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stok_pertashop`
--

INSERT INTO `stok_pertashop` (`stok_id`, `stok_awal`, `stok_masuk`, `stok_keluar`, `stok_sisa`, `tanggal_masuk`, `odo_masuk`, `odo_keluar`, `penguapan`, `odo`) VALUES
(43, 2000.00, 0.00, 100.00, 1900.00, '2025-02-17 09:03:56', 0.00, 150.00, 50.00, 150.00);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `transaksi_tanggal` date NOT NULL,
  `transaksi_jenis` enum('Pengeluaran','Pemasukan') NOT NULL,
  `transaksi_kategori` int(11) NOT NULL,
  `transaksi_nominal` int(11) NOT NULL,
  `transaksi_keterangan` text NOT NULL,
  `transaksi_bank` int(11) NOT NULL,
  `p` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `transaksi_tanggal`, `transaksi_jenis`, `transaksi_kategori`, `transaksi_nominal`, `transaksi_keterangan`, `transaksi_bank`, `p`) VALUES
(26, '2025-01-20', 'Pemasukan', 18, 20000, 'p', 0, '2025-02-10 14:49:18'),
(31, '2025-01-20', 'Pemasukan', 18, 50000, 'y', 0, '2025-02-10 14:49:18'),
(32, '2025-01-20', 'Pemasukan', 19, 30000, 't', 0, '2025-02-10 14:49:18'),
(33, '2025-01-20', 'Pemasukan', 18, 50000, 't', 0, '2025-02-10 14:49:18');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_foto` varchar(100) DEFAULT NULL,
  `user_level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_nama`, `user_username`, `user_password`, `user_foto`, `user_level`) VALUES
(1, 'Direktur BUMDes', 'direktur', 'e56c0d6857d7acbd5bce85e1ffa28e34', '2075570673_user.png', 'administrator'),
(10, 'Admin Pertashop', 'pertashop', '3d67b0c364915c491d0f16de714d5bc3', '', 'pertashop'),
(11, 'Manajemen', 'manajemen', 'df5e49405432e48fe5f6c9bff62f1a64', '', 'manajemen'),
(12, 'Admin Peternakan', 'peternakan', '66e34d93e638d9a13290adb4c6ec797f', '', 'peternakan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hj_pertashop`
--
ALTER TABLE `hj_pertashop`
  ADD PRIMARY KEY (`harga_id`);

--
-- Indexes for table `hutang`
--
ALTER TABLE `hutang`
  ADD PRIMARY KEY (`hutang_id`);

--
-- Indexes for table `in_pertashop`
--
ALTER TABLE `in_pertashop`
  ADD PRIMARY KEY (`input_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `kategori_pertashop`
--
ALTER TABLE `kategori_pertashop`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `opex_pertashop`
--
ALTER TABLE `opex_pertashop`
  ADD PRIMARY KEY (`opex_id`);

--
-- Indexes for table `out_pertashop`
--
ALTER TABLE `out_pertashop`
  ADD PRIMARY KEY (`output_id`);

--
-- Indexes for table `piutang`
--
ALTER TABLE `piutang`
  ADD PRIMARY KEY (`piutang_id`);

--
-- Indexes for table `stok_pertashop`
--
ALTER TABLE `stok_pertashop`
  ADD PRIMARY KEY (`stok_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hj_pertashop`
--
ALTER TABLE `hj_pertashop`
  MODIFY `harga_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `hutang`
--
ALTER TABLE `hutang`
  MODIFY `hutang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `in_pertashop`
--
ALTER TABLE `in_pertashop`
  MODIFY `input_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kategori_pertashop`
--
ALTER TABLE `kategori_pertashop`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `opex_pertashop`
--
ALTER TABLE `opex_pertashop`
  MODIFY `opex_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `out_pertashop`
--
ALTER TABLE `out_pertashop`
  MODIFY `output_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `piutang`
--
ALTER TABLE `piutang`
  MODIFY `piutang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stok_pertashop`
--
ALTER TABLE `stok_pertashop`
  MODIFY `stok_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
