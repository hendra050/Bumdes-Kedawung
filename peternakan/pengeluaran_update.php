<?php
include '../koneksi.php';

if (isset($_POST['id']) && isset($_POST['kategori']) && isset($_POST['keterangan']) && isset($_POST['nominal'])) {
    $id = $_POST['id'];
    $kategori = $_POST['kategori'];
    $keterangan = $_POST['keterangan'];
    $nominal = $_POST['nominal'];

    $query = "UPDATE opex_peternakan SET opex_tanggal = now(), opex_kategori = '$kategori', opex_keterangan = '$keterangan', opex_nominal = '$nominal' WHERE opex_id = '$id'";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
    echo "<script> window.location.href='pengeluaran.php';</script>";
    } else {
    echo "<script>alert('Gagal mengupdate transaksi!'); window.location.href='pengeluaran.php';</script>";
    }
} else {
    echo "<script>alert('Form belum diisi!'); window.location.href='pengeluaran.php';</script>";
}
?>