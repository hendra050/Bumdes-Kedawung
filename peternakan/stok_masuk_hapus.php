<?php 
include '../koneksi.php';

$id = $_GET['id'];

$transaksi = mysqli_query($koneksi, "SELECT * FROM stok_masuk WHERE id_masuk='$id'");
$t = mysqli_fetch_assoc($transaksi);


mysqli_query($koneksi, "DELETE FROM stok_masuk WHERE id_masuk='$id'");

header("location:kandang.php");
?>