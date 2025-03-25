<?php 
include '../koneksi.php';
$id  = $_GET['id'];

mysqli_query($koneksi, "delete from kandang where id_kandang='$id'");
header("location:tambah_kandang.php");