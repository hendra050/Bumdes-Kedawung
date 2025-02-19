<?php 
include '../koneksi.php';
$id  = $_GET['id'];

mysqli_query($koneksi, "delete from opex_pertashop where opex_id='$id'");
header("location:asset.php");