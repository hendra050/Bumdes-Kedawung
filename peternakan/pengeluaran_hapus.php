<?php 
include '../koneksi.php';

$id = $_GET['id'];

$transaksi = mysqli_query($koneksi, "SELECT * FROM opex_pertashop WHERE opex_id='$id'");
$t = mysqli_fetch_assoc($transaksi);


mysqli_query($koneksi, "DELETE FROM opex_pertashop WHERE opex_id='$id'");

header("location:pengeluaran.php");
?>