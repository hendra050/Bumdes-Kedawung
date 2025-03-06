<?php 
include __DIR__ . '/../../koneksi.php';
$id  = $_POST['id'];
$kategori  = $_POST['kategori'];

mysqli_query($koneksi, "update kategori_omset_peternakan set kategori='$kategori' where kategori_id='$id'");
header("location:kategori_penjualan_peternakan.php");