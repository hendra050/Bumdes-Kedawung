<?php 
include '../koneksi.php';

$id = $_GET['id'];

$transaksi = mysqli_query($koneksi, "SELECT * FROM out_pertashop WHERE output_id='$id'");
$t = mysqli_fetch_assoc($transaksi);


mysqli_query($koneksi, "DELETE FROM out_pertashop WHERE output_id='$id'");

header("location:pemasukan.php");
?>