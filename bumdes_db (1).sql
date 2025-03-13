-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2025 at 04:46 AM
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
-- Table structure for table `do_pertashop`
--

CREATE TABLE `do_pertashop` (
  `input_id` int(11) NOT NULL,
  `input_tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `input_jumlah` decimal(11,2) NOT NULL,
  `input_perliter` int(11) NOT NULL,
  `input_harga` int(11) NOT NULL,
  `input_foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `do_pertashop`
--

INSERT INTO `do_pertashop` (`input_id`, `input_tanggal`, `input_jumlah`, `input_perliter`, `input_harga`, `input_foto`) VALUES
(20, '2025-02-25 03:27:07', 2000.00, 20000, 40000000, '862847656_istockphoto-1043496908-612x612.jpg'),
(21, '2025-03-12 03:10:11', 10.00, 500000, 5000000, '');

-- --------------------------------------------------------

--
-- Table structure for table `gaji_karyawan`
--

CREATE TABLE `gaji_karyawan` (
  `gaji_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `penjualan` int(11) NOT NULL,
  `gaji` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(20, '2025-02-19 12:14:48', 12000),
(21, '2025-03-12 03:11:34', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_omset_peternakan`
--

CREATE TABLE `kategori_omset_peternakan` (
  `kategori_id` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_omset_peternakan`
--

INSERT INTO `kategori_omset_peternakan` (`kategori_id`, `kategori`) VALUES
(81, 'Kambing'),
(82, 'Daging Mentah'),
(83, 'Daging Matang'),
(84, 'Anakan Kambing');

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
(1, 'Asset'),
(14, 'Tagihan Air'),
(15, 'Tagihan Listrik'),
(16, 'Tagihan Wifi'),
(17, 'Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_peternakan`
--

CREATE TABLE `kategori_peternakan` (
  `kategori_id` int(11) NOT NULL,
  `kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_peternakan`
--

INSERT INTO `kategori_peternakan` (`kategori_id`, `kategori`) VALUES
(1, 'air'),
(14, 'Listrikk'),
(15, 'Pakan'),
(16, 'Obat');

-- --------------------------------------------------------

--
-- Table structure for table `kode_kambing`
--

CREATE TABLE `kode_kambing` (
  `id` int(11) NOT NULL,
  `tanggal_lahir` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `umur` int(11) NOT NULL,
  `jenis_kambing` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `omset_pertashop`
--

CREATE TABLE `omset_pertashop` (
  `output_id` int(11) NOT NULL,
  `output_kode` varchar(11) NOT NULL,
  `output_tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `odo_masuk` decimal(11,2) NOT NULL,
  `odo_keluar` decimal(11,2) NOT NULL,
  `output_jual` decimal(10,2) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `output_total` int(15) NOT NULL,
  `shift` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `omset_pertashop`
--

INSERT INTO `omset_pertashop` (`output_id`, `output_kode`, `output_tanggal`, `odo_masuk`, `odo_keluar`, `output_jual`, `harga`, `output_total`, `shift`) VALUES
(68, 'MSK-2829245', '2025-02-20 05:39:28', 0.00, 150.00, 150.00, 12000, 1800000, 'pagi'),
(69, 'MSK-0257622', '2025-02-20 05:41:05', 150.00, 200.00, 50.00, 12000, 600000, 'pagi'),
(70, 'MSK-1186240', '2025-02-21 03:52:27', 200.00, 300.00, 100.00, 12000, 1200000, 'pagi'),
(71, '401_2841717', '2025-02-24 06:09:35', 300.00, 500.00, 200.00, 12000, 2400000, 'pagi'),
(72, 'sfdaef', '2025-01-01 09:23:35', 10.00, 20.00, NULL, 12000, 120000, 'pagi'),
(73, '401-1489433', '2025-02-25 03:27:47', 500.00, 1000.00, 500.00, 12000, 6000000, 'pagi');

-- --------------------------------------------------------

--
-- Table structure for table `omset_peternakan`
--

CREATE TABLE `omset_peternakan` (
  `output_id` int(11) NOT NULL,
  `output_kode` varchar(11) NOT NULL,
  `omset_kategori` varchar(50) NOT NULL,
  `output_tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `output_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `omset_peternakan`
--

INSERT INTO `omset_peternakan` (`output_id`, `output_kode`, `omset_kategori`, `output_tanggal`, `harga`, `jumlah`, `output_total`) VALUES
(82, '', '84', '2025-03-04 17:25:57', 500000, 10, 5000000),
(83, '', '81', '2025-03-05 04:29:54', 14000000, 3, 42000000);

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
(24, '2025-02-20 01:09:24', '1', 'meja', 100000),
(25, '2025-02-20 01:09:42', '16', '', 200000),
(26, '2025-02-20 01:10:09', '15', '', 120000),
(27, '2025-02-20 01:10:31', '14', '', 80000),
(28, '2025-02-20 01:11:19', '17', 'uang bensin', 100000),
(29, '2025-02-20 01:11:37', '1', 'kursi', 35000),
(30, '2025-02-24 12:57:24', '14', 'aa', 10000),
(31, '2025-03-03 08:52:52', '1', 'lemari', 650000),
(32, '2025-03-12 03:12:00', '15', '', 200000),
(33, '2025-03-12 03:12:25', '16', '', 200000),
(34, '2025-03-12 03:12:36', '16', '', 200000),
(36, '2025-03-13 02:59:27', '1', 'kulkas', 500000);

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
(12, '2025-02-26 04:56:37', 100, '15', ''),
(13, '2025-03-10 03:44:42', 150000, '16', ''),
(14, '2025-03-10 03:45:10', 25000000, '15', '');

-- --------------------------------------------------------

--
-- Table structure for table `stok_kambing`
--

CREATE TABLE `stok_kambing` (
  `id_kandang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stok_pertashop`
--

CREATE TABLE `stok_pertashop` (
  `stok_id` int(11) NOT NULL,
  `tanggal_masuk` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `stok_awal` decimal(11,2) DEFAULT NULL,
  `stok_masuk` decimal(11,2) DEFAULT NULL,
  `stok_keluar` decimal(11,2) NOT NULL,
  `stok_sisa` decimal(11,2) NOT NULL,
  `manual_awal` decimal(11,2) NOT NULL,
  `manual_akhir` decimal(11,2) NOT NULL,
  `manual_selisih` decimal(11,2) NOT NULL,
  `penguapan` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stok_pertashop`
--

INSERT INTO `stok_pertashop` (`stok_id`, `tanggal_masuk`, `stok_awal`, `stok_masuk`, `stok_keluar`, `stok_sisa`, `manual_awal`, `manual_akhir`, `manual_selisih`, `penguapan`) VALUES
(54, '2025-02-19 13:46:55', 1850.00, 0.00, 175.00, 1675.00, 1800.00, 1600.00, 200.00, 25.00),
(56, '2025-02-24 03:26:42', 1675.00, 0.00, 100.00, 1575.00, 1600.00, 1300.00, 300.00, 200.00),
(58, '2025-02-25 03:41:03', 1575.00, 1000.00, 500.00, 2075.00, 2300.00, 1750.00, 550.00, 50.00);

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
(12, 'Admin Peternakan', 'peternakan', '202cb962ac59075b964b07152d234b70', '', 'peternakan'),
(15, 'admin', 'admin', '0192023a7bbd73250516f069df18b500', '847055110_centang.png', 'manajemen'),
(16, 'hendra', 'hendra', '202cb962ac59075b964b07152d234b70', '', 'pertashop-op');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `do_pertashop`
--
ALTER TABLE `do_pertashop`
  ADD PRIMARY KEY (`input_id`);

--
-- Indexes for table `gaji_karyawan`
--
ALTER TABLE `gaji_karyawan`
  ADD PRIMARY KEY (`gaji_id`);

--
-- Indexes for table `hj_pertashop`
--
ALTER TABLE `hj_pertashop`
  ADD PRIMARY KEY (`harga_id`);

--
-- Indexes for table `kategori_omset_peternakan`
--
ALTER TABLE `kategori_omset_peternakan`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `kategori_pertashop`
--
ALTER TABLE `kategori_pertashop`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `kategori_peternakan`
--
ALTER TABLE `kategori_peternakan`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `kode_kambing`
--
ALTER TABLE `kode_kambing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `omset_pertashop`
--
ALTER TABLE `omset_pertashop`
  ADD PRIMARY KEY (`output_id`);

--
-- Indexes for table `omset_peternakan`
--
ALTER TABLE `omset_peternakan`
  ADD PRIMARY KEY (`output_id`);

--
-- Indexes for table `opex_pertashop`
--
ALTER TABLE `opex_pertashop`
  ADD PRIMARY KEY (`opex_id`);

--
-- Indexes for table `opex_peternakan`
--
ALTER TABLE `opex_peternakan`
  ADD PRIMARY KEY (`opex_id`);

--
-- Indexes for table `stok_pertashop`
--
ALTER TABLE `stok_pertashop`
  ADD PRIMARY KEY (`stok_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `do_pertashop`
--
ALTER TABLE `do_pertashop`
  MODIFY `input_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `gaji_karyawan`
--
ALTER TABLE `gaji_karyawan`
  MODIFY `gaji_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hj_pertashop`
--
ALTER TABLE `hj_pertashop`
  MODIFY `harga_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `kategori_omset_peternakan`
--
ALTER TABLE `kategori_omset_peternakan`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `kategori_pertashop`
--
ALTER TABLE `kategori_pertashop`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kategori_peternakan`
--
ALTER TABLE `kategori_peternakan`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kode_kambing`
--
ALTER TABLE `kode_kambing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `omset_pertashop`
--
ALTER TABLE `omset_pertashop`
  MODIFY `output_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `omset_peternakan`
--
ALTER TABLE `omset_peternakan`
  MODIFY `output_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `opex_pertashop`
--
ALTER TABLE `opex_pertashop`
  MODIFY `opex_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `opex_peternakan`
--
ALTER TABLE `opex_peternakan`
  MODIFY `opex_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `stok_pertashop`
--
ALTER TABLE `stok_pertashop`
  MODIFY `stok_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
