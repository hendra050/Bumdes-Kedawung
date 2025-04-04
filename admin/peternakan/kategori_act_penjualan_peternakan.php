<?php 
include __DIR__ . '/../../koneksi.php';
$kategori  = $_POST['kategori'];

mysqli_query($koneksi, "insert into kategori_omset_peternakan values (NULL,'$kategori')");
header("location:kategori_penjualan_peternakan.php");