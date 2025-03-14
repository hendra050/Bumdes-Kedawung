<?php 
include '../koneksi.php';

$tanggal  = $_POST['tanggal'];
$harga = preg_replace("/[^0-9]/", "", $_POST['harga']);

$insert_query = "INSERT INTO hj_pertashop (harga_tanggal,  harga) VALUES ( now(), '$harga')";
mysqli_query($koneksi, $insert_query) or die(mysqli_error($koneksi));

header("location:harga.php");
?>
