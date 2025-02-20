-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Feb 2025 pada 06.34
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
-- Struktur dari tabel `omset_pertashop`
--

CREATE TABLE `omset_pertashop` (
  `output_id` int(11) NOT NULL,
  `output_tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `odo_masuk` decimal(11,2) NOT NULL,
  `odo_keluar` decimal(11,2) NOT NULL,
  `penguapan` decimal(11,2) NOT NULL,
  `odo` decimal(11,2) NOT NULL,
  `output_jual` decimal(10,2) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `output_total` int(15) NOT NULL,
  `shift` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `omset_pertashop`
--

INSERT INTO `omset_pertashop` (`output_id`, `output_tanggal`, `odo_masuk`, `odo_keluar`, `penguapan`, `odo`, `output_jual`, `harga`, `output_total`, `shift`) VALUES
(42, '2025-02-17 09:00:06', 0.00, 0.00, 0.00, 0.00, 100.00, 11000, 1100000, 'siang');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `omset_pertashop`
--
ALTER TABLE `omset_pertashop`
  ADD PRIMARY KEY (`output_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `omset_pertashop`
--
ALTER TABLE `omset_pertashop`
  MODIFY `output_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
