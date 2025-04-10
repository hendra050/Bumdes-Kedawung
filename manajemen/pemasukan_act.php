<?php 
include '../koneksi.php';

$sumber_dana  = $_POST['sumber_dana'];
$keterangan   = $_POST['keterangan'];
$nominal = preg_replace("/[^0-9]/", "", $_POST['nominal']);

mysqli_query($koneksi, "INSERT INTO pemasukan_bumdes (tanggal, sumber_dana, keterangan, nominal) VALUES (NOW(), '$sumber_dana', '$keterangan', '$nominal')");

header("location:pemasukan.php");
?>
