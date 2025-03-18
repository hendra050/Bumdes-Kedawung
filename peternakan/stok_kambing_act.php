<?php 
include '../koneksi.php';

$id_kandang  = $_POST['id_kandang'];
$jumlah      = $_POST['jumlah'];
$tanggal     = $_POST['tanggal'];
$keterangan  = $_POST['keterangan'];

// Simpan ke tabel stok_masuk
mysqli_query($koneksi, "INSERT INTO stok_masuk (id_kandang, jumlah, tanggal, keterangan) 
VALUES ('$id_kandang', '$jumlah', now(), '$keterangan')");

// Redirect kembali
header("location:kandang.php?alert=stok_masuk_sukses");
?>
