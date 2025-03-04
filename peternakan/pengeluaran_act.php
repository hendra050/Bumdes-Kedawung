<?php 
include '../koneksi.php';

$kategori = $_POST['kategori'];
$keterangan = $_POST['keterangan'];
$nominal = $_POST['nominal'];

$insert_query = "INSERT INTO opex_peternakan (opex_tanggal, opex_nominal, opex_kategori, opex_keterangan)
VALUES (now(), '$nominal', '$kategori', '$keterangan')";
mysqli_query($koneksi, $insert_query) or die(mysqli_error($koneksi));

header("location:pengeluaran.php");
?>