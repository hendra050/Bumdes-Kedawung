<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data stok
    $hapus = mysqli_query($koneksi, "DELETE FROM stok_kambing_masuk WHERE id_stok='$id'");

    if ($hapus) {
        header("Location: riwayat_tambah_stok.php?alert=hapus");
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    header("Location: riwayat_tambah_stok.php");
}
?>
