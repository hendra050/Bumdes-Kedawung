<?php 
include '../koneksi.php';

$kategori = $_POST['kategori'];
$keterangan = $_POST['keterangan'];
$nominal = preg_replace("/[^0-9]/", "", $_POST['nominal']);

$insert_query = "INSERT INTO opex_pertashop (opex_tanggal, opex_kategori, opex_keterangan, opex_nominal)
VALUES (now(), '$kategori', '$keterangan', '$nominal')";
mysqli_query($koneksi, $insert_query) or die(mysqli_error($koneksi));

header("location:pengeluaran.php");
?>