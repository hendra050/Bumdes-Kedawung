<?php 
include '../koneksi.php';

$id = $_GET['id'];

$transaksi = mysqli_query($koneksi, "SELECT * FROM stok_pertashop WHERE stok_id='$id'");
$t = mysqli_fetch_assoc($transaksi);


mysqli_query($koneksi, "DELETE FROM stok_pertashop WHERE stok_id='$id'");

header("location:stok.php");
?>