<?php 
include '../../koneksi.php';

$jumlah = $_POST['jumlah'];
$harga = $_POST['harga'];
$kategori = $_POST['kategori'];

$total = $jumlah * $harga;

$insert_query = "INSERT INTO omset_peternakan (omset_kategori, output_tanggal, jumlah, harga, output_total) VALUES ('$kategori', now(), '$jumlah', '$harga', '$total')";
mysqli_query($koneksi, $insert_query) or die(mysqli_error($koneksi));

header("location:pemasukan.php")
?>