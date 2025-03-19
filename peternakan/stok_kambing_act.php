<?php 
include '../koneksi.php';

// Tangkap data dari form
$id_kandang = $_POST['id_kandang'];
$jumlah     = $_POST['jumlah'];
$keterangan = $_POST['keterangan'];

// Simpan ke tabel stok_kambing_masuk
mysqli_query($koneksi, "INSERT INTO stok_kambing_masuk (kandang, jumlah, keterangan, tanggal) VALUES ('$id_kandang', '$jumlah', '$keterangan', NOW())");

// Redirect kembali ke halaman kandang.php
header("location:kandang.php?alert=berhasil");
