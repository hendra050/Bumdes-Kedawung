-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Feb 2025 pada 06.35
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
-- Struktur dari tabel `stok_pertashop`
--

CREATE TABLE `stok_pertashop` (
  `stok_id` int(11) NOT NULL,
  `stok_awal` decimal(11,2) DEFAULT NULL,
  `stok_masuk` decimal(11,2) DEFAULT NULL,
  `stok_keluar` decimal(11,2) NOT NULL,
  `stok_sisa` decimal(11,2) NOT NULL,
  `tanggal_masuk` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `manual_awal` decimal(11,2) NOT NULL,
  `manual_akhir` decimal(11,2) NOT NULL,
  `manual_selisih` decimal(11,2) NOT NULL,
  `manual` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stok_pertashop`
--

INSERT INTO `stok_pertashop` (`stok_id`, `stok_awal`, `stok_masuk`, `stok_keluar`, `stok_sisa`, `tanggal_masuk`, `manual_awal`, `manual_akhir`, `manual_selisih`, `manual`) VALUES
(43, 2000.00, 0.00, 100.00, 1900.00, '2025-02-17 09:03:56', 0.00, 150.00, 50.00, 150.00);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `stok_pertashop`
--
ALTER TABLE `stok_pertashop`
  ADD PRIMARY KEY (`stok_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `stok_pertashop`
--
ALTER TABLE `stok_pertashop`
  MODIFY `stok_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
