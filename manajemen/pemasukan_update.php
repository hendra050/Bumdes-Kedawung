<?php 
include '../koneksi.php';

$id           = $_POST['id'];
$sumber_dana  = $_POST['sumber_dana'];
$keterangan   = $_POST['keterangan'];
$nominal = preg_replace("/[^0-9]/", "", $_POST['nominal']);

mysqli_query($koneksi, "UPDATE pemasukan_bumdes SET tanggal=NOW(), sumber_dana='$sumber_dana', keterangan='$keterangan', nominal='$nominal' WHERE id='$id'");

header("location:pemasukan.php");
