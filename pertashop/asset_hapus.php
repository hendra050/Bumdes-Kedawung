<?php
include '../koneksi.php';
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM opex_pertashop WHERE opex_id='$id'");
header("location:asset.php?alert=hapus");
?>