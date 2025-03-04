<?php 
include '../koneksi.php';
$kategori  = $_POST['kategori'];

mysqli_query($koneksi, "insert into kategori_peternakan values (NULL,'$kategori')");
header("location:kategori.php");