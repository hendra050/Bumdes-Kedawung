<?php 
include __DIR__ . '/../../koneksi.php';
$kategori  = $_POST['kategori'];

mysqli_query($koneksi, "insert into kategori_pertashop values (NULL,'$kategori')");
header("location:kategori.php");