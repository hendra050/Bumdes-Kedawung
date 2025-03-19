<?php
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id         = $_POST['id'];
    $jumlah     = $_POST['jumlah'];
    $keterangan = $_POST['keterangan'];

    // Update data stok
    $update = mysqli_query($koneksi, "UPDATE stok_kambing_masuk SET jumlah='$jumlah', keterangan='$keterangan' WHERE id_stok='$id'");

    if ($update) {
        header("Location: riwayat_tambah_stok.php?alert=update");
    } else {
        echo "Gagal update data: " . mysqli_error($koneksi);
    }
} else {
    header("Location: riwayat_tambah_stok.php");
}
?>
