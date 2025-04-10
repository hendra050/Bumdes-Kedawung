<?php 
include '../koneksi.php';

$kategori    = $_POST['kategori'];
$katerangan  = $_POST['katerangan'];
$total = preg_replace("/[^0-9]/", "", $_POST['total']);

mysqli_query($koneksi, "INSERT INTO opex_bumdes (tanggal, kategori, katerangan, total) VALUES (NOW(), '$kategori', '$katerangan', '$total')");

header("location:pengeluaran.php");
