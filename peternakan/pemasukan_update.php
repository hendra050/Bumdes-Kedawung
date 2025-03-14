<?php
include '../koneksi.php';

$id       = $_POST['id'];
$jumlah   = $_POST['jumlah'];
$harga    = $_POST['harga'];
$kategori = $_POST['kategori'];
$total    = $jumlah * $harga;

mysqli_query($koneksi, "UPDATE omset_peternakan SET 
  jumlah='$jumlah', 
  harga='$harga', 
  output_total='$total', 
  omset_kategori='$kategori' 
  WHERE output_id='$id'");

header("location:pemasukan.php");
