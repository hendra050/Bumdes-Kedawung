<?php 
include '../koneksi.php';

// Ambil ID transaksi yang akan dihapus
$id = $_GET['id'];

// Ambil data transaksi untuk mendapatkan informasi foto (jika ada)
$transaksi = mysqli_query($koneksi, "SELECT * FROM do_pertashop WHERE input_id='$id'");
$t = mysqli_fetch_assoc($transaksi);

// Hapus foto dari folder jika ada
if ($t['foto'] != "") {
    $file_path = '../gambar/user/' . $t['foto'];
    if (file_exists($file_path)) {
        unlink($file_path); // Hapus file foto dari folder
    }
}

// Hapus data transaksi dari database
mysqli_query($koneksi, "DELETE FROM do_pertashop WHERE input_id='$id'");

// Redirect ke halaman transaksi
header("location:tambah.php");
?>