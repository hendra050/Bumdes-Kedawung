<?php
include '../koneksi.php';

// Ambil data dari form
$manual_awal = floatval($_POST['manual_awal']); // Input manual awal dari form
$manual_akhir = floatval($_POST['manual_akhir']); // Input manual akhir dari form

// Hitung manual_selisih
$manual_selisih = $manual_awal - $manual_akhir;

// Ambil data stok masuk dari tabel in_pertashop
$query_stok_masuk = "SELECT input_jumlah, input_tanggal 
                    FROM do_pertashop 
                    WHERE DATE(input_tanggal) = CURDATE() 
                    ORDER BY input_tanggal DESC 
                    LIMIT 1";
$result_stok_masuk = mysqli_query($koneksi, $query_stok_masuk) or die(mysqli_error($koneksi));
$row_stok_masuk = mysqli_fetch_assoc($result_stok_masuk);
$stok_masuk = $row_stok_masuk['input_jumlah'];
$tanggal_masuk = $row_stok_masuk['input_tanggal'];

// Ambil data stok keluar dari tabel out_pertashop
$query_stok_keluar = "SELECT output_jual 
                    AS total_keluar 
                    FROM omset_pertashop 
                    WHERE output_tanggal >= '$tanggal_masuk' 
                    ORDER BY output_tanggal 
                    DESC LIMIT 1";
$result_stok_keluar = mysqli_query($koneksi, $query_stok_keluar) or die(mysqli_error($koneksi));
$row_stok_keluar = mysqli_fetch_assoc($result_stok_keluar);
$stok_keluar = $row_stok_keluar['total_keluar'];

// Ambil data stok sisa sebelumnya
$query_stok_sisa_sebelumnya = "SELECT stok_sisa 
                            FROM stok_pertashop 
                            ORDER BY tanggal_masuk 
                            DESC LIMIT 1";
$result_stok_sisa_sebelumnya = mysqli_query($koneksi, $query_stok_sisa_sebelumnya) or die(mysqli_error($koneksi));
$row_stok_sisa_sebelumnya = mysqli_fetch_assoc($result_stok_sisa_sebelumnya);
$stok_sisa_sebelumnya = $row_stok_sisa_sebelumnya['stok_sisa'];

// Cek apakah sudah ada transaksi hari ini
$tanggal_hari_ini = date('Y-m-d');
$query_cek_tanggal = "SELECT COUNT(*) 
                    AS jumlah 
                    FROM stok_pertashop 
                    WHERE DATE(tanggal_masuk) = '$tanggal_hari_ini'";
$result_cek_tanggal = mysqli_query($koneksi, $query_cek_tanggal) or die(mysqli_error($koneksi));
$row_cek_tanggal = mysqli_fetch_assoc($result_cek_tanggal);
$jumlah_data = $row_cek_tanggal['jumlah'];

// Jika sudah ada transaksi hari ini, set stok_masuk = 0
if ($jumlah_data > 0) {
    $stok_masuk = 0;
}

// Hitung stok sisa
$sisa_baru = $stok_sisa_sebelumnya + $stok_masuk - $stok_keluar;

$penguapan = $manual_selisih - $stok_keluar;

// Simpan data stok sisa ke tabel stok_pertashop
$insert_query = "INSERT INTO stok_pertashop (`stok_awal`, `stok_masuk`, `stok_keluar`, `stok_sisa`, `tanggal_masuk`, `manual_awal`, `manual_akhir`, `manual_selisih`, `penguapan`) VALUES ('$stok_sisa_sebelumnya', '$stok_masuk', '$stok_keluar', '$sisa_baru', NOW(), '$manual_awal', '$manual_akhir', '$manual_selisih', '$penguapan')";
mysqli_query($koneksi, $insert_query) or die(mysqli_error($koneksi));

header("location:stok.php");
?>