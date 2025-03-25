<?php 
include '../koneksi.php';
$nama_kandang  = $_POST['nama_kandang'];

mysqli_query($koneksi, "insert into kandang values (NULL,'$nama_kandang')");
header("location:tambah_kandang.php");