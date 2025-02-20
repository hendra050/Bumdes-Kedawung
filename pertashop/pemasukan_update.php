<?php 
include '../koneksi.php';

$id = $_POST['id'];
$tanggal  = $_POST['tanggal'];
$jual = floatval($_POST['jual']);

// Fetch the latest harga from hpp_pertashop
$query_harga = "SELECT harga FROM omset_pertashop WHERE output_id = '$id' ";
$result = mysqli_query($koneksi, $query_harga) or die(mysqli_error($koneksi));

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $harga = $row['harga'];

    // Calculate total
    $total = $harga * $jual;

    // Update the record in out_pertashop
    $update_query = "UPDATE omset_pertashop SET output_tanggal='$tanggal', output_jual='$jual', harga='$harga', output_total='$total' WHERE output_id='$id'";
    mysqli_query($koneksi, $update_query) or die(mysqli_error($koneksi));

    header("location:pemasukan.php");
} else {
    echo "Harga pokok tidak ditemukan. Silakan periksa data harga.";
}
?>