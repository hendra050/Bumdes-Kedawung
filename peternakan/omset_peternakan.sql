-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Feb 2025 pada 10.00
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `omset_peternakan`
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
-- Dumping data untuk tabel `omset_peternakan`
--

INSERT INTO `omset_peternakan` (`output_id`, `output_kode`, `omset_kategori`, `output_tanggal`, `harga`, `jumlah`, `output_total`) VALUES
(68, 'MSK-2829245', '', '2025-02-20 05:39:28', 12000, 0, 0),
(69, 'MSK-0257622', '', '2025-02-20 05:41:05', 12000, 0, 0),
(70, '', '', '2025-02-26 04:12:56', 12000, 0, 0),
(71, '', '', '2025-02-26 04:13:12', 12000, 0, 0),
(72, '', '', '2025-02-26 04:59:59', 12000, 0, 0),
(73, '', '', '2025-02-26 05:00:25', 12000, 0, 0),
(74, '', '', '2025-02-26 05:00:32', 12000, 0, 0),
(75, '', '', '2025-02-26 05:04:39', 12000, 0, 0),
(76, '', '', '2025-02-26 05:05:15', 12000, 0, 0),
(77, '', '', '2025-02-26 05:13:59', 12000, 0, 0),
(79, '', '77', '2025-02-26 17:00:00', 20000000, 2, 40000000),
(80, '', '79', '2025-02-27 06:27:48', 1000000, 3, 3000000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `omset_peternakan`
--
ALTER TABLE `omset_peternakan`
  ADD PRIMARY KEY (`output_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `omset_peternakan`
--
ALTER TABLE `omset_peternakan`
  MODIFY `output_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
