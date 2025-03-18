<?php 
include '../koneksi.php';

$id_kandang   = $_POST['id_kandang'];
$jumlah       = $_POST['jumlah'];
$jenis_keluar = $_POST['jenis_keluar'];
$tanggal      = $_POST['tanggal'];
$keterangan   = $_POST['keterangan'];

// Simpan ke tabel stok_keluar
mysqli_query($koneksi, "INSERT INTO stok_keluar (id_kandang, jumlah, jenis_keluar, tanggal, keterangan) 
VALUES ('$id_kandang', '$jumlah', '$jenis_keluar', now(), '$keterangan')");

// Redirect kembali
header("location:kandang.php?alert=stok_keluar_sukses");
?>
