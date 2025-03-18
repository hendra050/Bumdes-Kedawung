<?php 
include '../koneksi.php';

$id = $_GET['id'];

$transaksi = mysqli_query($koneksi, "SELECT * FROM stok_keluar WHERE id_keluar='$id'");
$t = mysqli_fetch_assoc($transaksi);


mysqli_query($koneksi, "DELETE FROM stok_keluar WHERE id_keluar='$id'");

header("location:kandang.php");
?>