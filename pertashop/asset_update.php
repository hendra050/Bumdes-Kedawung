<?php
include '../koneksi.php';

if (isset($_POST['id']) && isset($_POST['keterangan']) && isset($_POST['nominal'])) {
    $id         = $_POST['id'];
    $keterangan = $_POST['keterangan'];
    $nominal = preg_replace("/[^0-9]/", "", $_POST['nominal']);

    $query = "UPDATE opex_pertashop SET 
                opex_keterangan = '$keterangan', 
                opex_nominal = '$nominal' 
            WHERE opex_id = '$id'";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>window.location.href='asset.php?alert=update';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate data!'); window.location.href='asset.php';</script>";
    }
} else {
    echo "<script>alert('Form belum diisi!'); window.location.href='asset.php';</script>";
}
?>
