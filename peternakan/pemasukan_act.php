<?php 
include '../koneksi.php';

$jumlah     = $_POST['jumlah'];
$harga      = $_POST['harga'];
$kategori   = $_POST['kategori'];
$kandang   = $_POST['kandang'];

$total = $jumlah * $harga;

$insert_query = "INSERT INTO omset_peternakan (omset_kategori, output_tanggal, jumlah, harga, output_total, kandang)
VALUES ('$kategori', now(), '$jumlah', '$harga', '$total', '$kandang')";

mysqli_query($koneksi, $insert_query) or die(mysqli_error($koneksi));

header("location:pemasukan.php")
?>