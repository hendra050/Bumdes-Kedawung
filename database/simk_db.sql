-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2025 at 05:37 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simk_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `bank_id` int(11) NOT NULL,
  `bank_nama` varchar(255) NOT NULL,
  `bank_nomor` varchar(255) NOT NULL,
  `bank_pemilik` varchar(255) NOT NULL,
  `bank_saldo` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`bank_id`, `bank_nama`, `bank_nomor`, `bank_pemilik`, `bank_saldo`) VALUES
(1, 'BANK BRI', 'Adi Prihananto', '0933-3393', 14400000),
(3, 'BANK BCA', 'Adi Prihananto', '18280-232-23', 1700000),
(5, 'Tunai', 'BUMDes Sugeng Abadi Mulur', '000000000', 1000000);

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

--
-- Dumping data for table `hutang`
--

INSERT INTO `hutang` (`hutang_id`, `hutang_tanggal`, `hutang_nominal`, `hutang_keterangan`) VALUES
(2, '2019-06-01', 10000, 'Setor\r\n\r\n');

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
(1, 'Lainnya'),
(5, 'Gaji Karyawan'),
(6, 'Keperluan Unit Usaha'),
(8, 'Keperluan Kantor'),
(9, 'Maintenance'),
(10, 'Biaya Tak Terduga'),
(11, 'Biaya Bandwith'),
(13, 'Tunjangan Karyawan'),
(14, 'Biaya Hosting Website'),
(17, 'Pendapatan Unit');

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

--
-- Dumping data for table `piutang`
--

INSERT INTO `piutang` (`piutang_id`, `piutang_tanggal`, `piutang_nominal`, `piutang_keterangan`) VALUES
(1, '2019-06-22', 1000000, 'Hutang oleh Wahyu Arsandi'),
(3, '2019-06-23', 70000, 'Hutang oleh Arnisya untuk beli pulsa');

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
  `transaksi_bank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `transaksi_tanggal`, `transaksi_jenis`, `transaksi_kategori`, `transaksi_nominal`, `transaksi_keterangan`, `transaksi_bank`) VALUES
(1, '2019-06-21', 'Pemasukan', 1, 1000000, 'Kiki\r\n', 1),
(4, '2019-06-21', 'Pengeluaran', 8, 50000, 'Beli Alat Kantor', 1),
(5, '2019-06-20', 'Pemasukan', 1, 1500000, '', 1),
(6, '2024-09-06', 'Pemasukan', 1, 13570000, 'Pembayaran Project', 1),
(8, '2024-09-14', 'Pemasukan', 1, 20000000, 'Pembayaran pelanggan internet desa', 1),
(9, '2024-09-22', 'Pengeluaran', 13, 200000, 'Biaya Berobat Pak Lilik', 1),
(10, '2024-09-22', 'Pemasukan', 1, 4000000, 'Penjualan kursi daur ulang', 3),
(11, '2024-10-14', 'Pemasukan', 1, 1000000, '', 1),
(12, '2024-10-21', 'Pengeluaran', 10, 32000000, 'Biaya pengembangan internet desa', 3),
(13, '2024-10-23', 'Pengeluaran', 14, 300000, 'Hosting Tahunan', 1),
(15, '2024-10-23', 'Pengeluaran', 14, 300000, 'Biaya Hosting tahun Depan', 3),
(16, '2024-10-23', 'Pemasukan', 1, 2000000, 'Penjualan produk daur ulang', 1),
(17, '2024-10-23', 'Pemasukan', 1, 2000000, 'Penjualan beras mulur', 1);

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
(1, 'Admin BUMDes', 'admin', '0192023a7bbd73250516f069df18b500', '2075570673_user.png', 'administrator'),
(6, 'Adi Prihananto', 'manajemen', '7839a6a91b6a99d4c29852a0beaa18c8', '', 'manajemen');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `hutang`
--
ALTER TABLE `hutang`
  ADD PRIMARY KEY (`hutang_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `piutang`
--
ALTER TABLE `piutang`
  ADD PRIMARY KEY (`piutang_id`);

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
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hutang`
--
ALTER TABLE `hutang`
  MODIFY `hutang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `piutang`
--
ALTER TABLE `piutang`
  MODIFY `piutang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
