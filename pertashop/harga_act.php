<?php 
include '../koneksi.php';

$tanggal  = $_POST['tanggal'];
$harga     = $_POST['harga'];

$insert_query = "INSERT INTO hj_pertashop (harga_tanggal,  harga) VALUES ( '$tanggal', '$harga')";
mysqli_query($koneksi, $insert_query) or die(mysqli_error($koneksi));

header("location:harga.php");
?>
