<?php 
include '../koneksi.php';

$id          = $_POST['id'];
$kategori    = $_POST['kategori'];
$katerangan  = $_POST['katerangan'];
$total = preg_replace("/[^0-9]/", "", $_POST['total']);

mysqli_query($koneksi, "UPDATE opex_bumdes SET tanggal=NOW(), kategori='$kategori', katerangan='$katerangan', total='$total' WHERE id='$id'");

header("location:pengeluaran.php");
