<?php
include '../koneksi.php';

// Ambil data stok masuk dari tabel in_pertashop
$query_stok_masuk = "SELECT input_jumlah FROM in_pertashop ORDER BY input_tanggal DESC LIMIT 1";
$result_stok_masuk = mysqli_query($koneksi, $query_stok_masuk) or die(mysqli_error($koneksi));
$row_stok_masuk = mysqli_fetch_assoc($result_stok_masuk);
$stok_masuk = $row_stok_masuk['input_jumlah'];

// Ambil data stok keluar dari tabel out_pertashop
$query_stok_keluar = "SELECT SUM(output_jual) AS total_keluar FROM out_pertashop WHERE output_tanggal >= (SELECT input_tanggal FROM in_pertashop ORDER BY input_tanggal DESC LIMIT 1)";
$result_stok_keluar = mysqli_query($koneksi, $query_stok_keluar) or die(mysqli_error($koneksi));
$row_stok_keluar = mysqli_fetch_assoc($result_stok_keluar);
$stok_keluar = $row_stok_keluar['total_keluar'];

// Ambil data stok sisa sebelumnya
$query_stok_sisa_sebelumnya = "SELECT stok_sisa FROM stok_pertashop ORDER BY tanggal_masuk DESC LIMIT 1";
$result_stok_sisa_sebelumnya = mysqli_query($koneksi, $query_stok_sisa_sebelumnya) or die(mysqli_error($koneksi));
$row_stok_sisa_sebelumnya = mysqli_fetch_assoc($result_stok_sisa_sebelumnya);
$stok_sisa_sebelumnya = $row_stok_sisa_sebelumnya['stok_sisa'];

// Hitung stok sisa
$sisa_baru = $stok_sisa_sebelumnya + $stok_masuk - $stok_keluar;

// Simpan data stok sisa ke tabel stok_pertashop
$insert_query = "INSERT INTO stok_pertashop (stok_masuk, tanggal_masuk, stok_keluar, stok_sisa)
VALUES ('$stok_masuk', (SELECT input_tanggal FROM in_pertashop ORDER BY input_tanggal DESC LIMIT 1), '$stok_keluar', '$sisa_baru')";
mysqli_query($koneksi, $insert_query) or die(mysqli_error($koneksi));

header("location:stok.php");
?>