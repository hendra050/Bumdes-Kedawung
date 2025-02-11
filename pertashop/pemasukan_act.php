<?php 
include '../koneksi.php';

$tanggal  = $_POST['tanggal'];
$jual     = $_POST['jual'];

$query_harga = "SELECT harga FROM hj_pertashop ORDER BY harga_tanggal DESC LIMIT 1";
$result = mysqli_query($koneksi, $query_harga) or die(mysqli_error($koneksi));

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $harga = $row['harga'];

    $total = $harga * $jual;

    $insert_query = "INSERT INTO out_pertashop (output_tanggal, output_jual, harga, output_total) VALUES ( '$tanggal', '$jual', '$harga', '$total')";
    mysqli_query($koneksi, $insert_query) or die(mysqli_error($koneksi));

    header("location:pemasukan.php");
} else {
    echo "Harga pokok tidak ditemukan. Silakan periksa data harga.";
}
?>
