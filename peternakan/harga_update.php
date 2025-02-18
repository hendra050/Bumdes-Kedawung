<?php
include '../koneksi.php';


$tanggal  = $_POST['tanggal'];
$harga    = $_POST['harga'];
$id       = $_POST['id'];

$update_query = "UPDATE hj_pertashop SET harga_tanggal='$tanggal', harga='$harga' WHERE harga_id='$id'";
mysqli_query($koneksi, $update_query) or die(mysqli_error($koneksi));

header("location:harga.php");
?>