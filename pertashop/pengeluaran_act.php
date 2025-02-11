<?php
include '../koneksi.php';

if (isset($_POST['tanggal']) && isset($_POST['kategori']) && isset($_POST['keterangan']) && isset($_POST['nominal'])) {
  $tanggal = $_POST['tanggal'];
  $kategori = $_POST['kategori'];
  $keterangan = $_POST['keterangan'];
  $nominal = $_POST['nominal'];

  $query = "INSERT INTO opex_pertashop (opex_tanggal, opex_kategori, opex_keterangan, opex_nominal) VALUES ('$tanggal', '$kategori', '$keterangan', '$nominal')";

  $result = mysqli_query($koneksi, $query);

  if ($result) {
    echo "<script> window.location.href='pengeluaran.php';</script>";
  } else {
    echo "<script>alert('Gagal menambahkan transaksi!'); window.location.href='pengeluaran.php';</script>";
  }
} else {
  echo "<script>alert('Form belum diisi!'); window.location.href='pengeluaran.php';</script>";
}
?>