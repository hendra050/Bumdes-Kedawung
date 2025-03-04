<?php 
include '../koneksi.php';
$id  = $_GET['id'];

mysqli_query($koneksi, "delete from kategori_omset_peternakan where kategori_id='$id'");
header("location:kategori_penjualan_peternakan.php");