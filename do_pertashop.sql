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
-- Struktur dari tabel `do_pertashop`
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
-- Dumping data untuk tabel `do_pertashop`
--

INSERT INTO `do_pertashop` (`input_id`, `input_tanggal`, `input_jumlah`, `input_perliter`, `input_harga`, `input_foto`) VALUES
(10, '2025-02-17 08:43:55', 2000.00, 10000, 20000000, '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `do_pertashop`
--
ALTER TABLE `do_pertashop`
  ADD PRIMARY KEY (`input_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `do_pertashop`
--
ALTER TABLE `do_pertashop`
  MODIFY `input_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
