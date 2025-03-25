<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$nama_kandang  = $_POST['nama_kandang'];

mysqli_query($koneksi, "update kandang set nama_kandang='$nama_kandang' where id_kandang='$id'");
header("location:tambah_kandang.php");