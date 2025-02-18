<?php 
include '../koneksi.php';

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM hj_pertashop WHERE harga_id='$id'");

header("location:harga.php");
?>