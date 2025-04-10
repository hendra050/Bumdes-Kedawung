<?php 
include '../koneksi.php';
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM opex_bumdes WHERE id='$id'");
header("location:pengeluaran.php");
