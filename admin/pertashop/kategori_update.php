<?php 
include __DIR__ . '/../../koneksi.php';
$id  = $_POST['id'];
$kategori  = $_POST['kategori'];

mysqli_query($koneksi, "update kategori_pertashop set kategori='$kategori' where kategori_id='$id'");
header("location:kategori.php");