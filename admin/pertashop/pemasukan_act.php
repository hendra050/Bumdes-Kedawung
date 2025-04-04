<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include __DIR__ . '/../../koneksi.php';

// Ambil data dari form
$odo_masuk = floatval($_POST['odomasuk']);
$odo_keluar = floatval($_POST['odokeluar']);

// Hitung output_jual berdasarkan ODO
$output_jual = $odo_keluar - $odo_masuk;

// Ambil harga terbaru
$query_harga = "SELECT harga FROM hj_pertashop ORDER BY harga_tanggal DESC LIMIT 1";
$result = mysqli_query($koneksi, $query_harga) or die(mysqli_error($koneksi));

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $harga = $row['harga'];

    // Hitung total
    $total = $harga * $output_jual;

    // Simpan waktu login saat user login (hanya jika belum ada di sesi)
    if (!isset($_SESSION['login_time'])) {
        $_SESSION['login_time'] = date('H:i:s'); // Simpan waktu login dalam format jam
    }

    // Ambil waktu login dari sesi
    $waktu_login = $_SESSION['login_time'];
    $waktu_input = date('H:i:s');

    // Konversi waktu login dan input ke timestamp
    $time_login = strtotime($waktu_login);
    $time_input = strtotime($waktu_input);
    $selisih_jam = ($time_input - $time_login) / 3600; // Konversi ke jam

    // **PERBAIKAN LOGIKA SHIFT**
    if ($selisih_jam >= 8) {
        $shift = "fullday"; 
    } else {
        $jam_login = (int) date('H', $time_login);
        $jam_input = (int) date('H', $time_input);

        if ($jam_login >= 7 && $jam_login < 15) {
            if ($jam_input < 15) {
                $shift = "pagi";
            } else {
                $shift = "fullday";
            }
        } elseif ($jam_login >= 15 && $jam_login < 22) {
            if ($jam_input < 22) {
                $shift = "siang";
            } else {
                $shift = "fullday";
            }
        } else {
            $shift = "fullday";
        }
    }

    // Generate kode otomatis (401 + 7 angka random)
    $kode = "401-" . str_pad(mt_rand(0, 9999999), 7, '0', STR_PAD_LEFT);

    // Insert data ke database
    $insert_query = "INSERT INTO omset_pertashop (output_kode, output_tanggal, odo_masuk, odo_keluar, output_jual, harga, output_total, shift)
                    VALUES ('$kode', NOW(),'$odo_masuk', '$odo_keluar', '$output_jual',  '$harga', '$total', '$shift')";
    
    mysqli_query($koneksi, $insert_query) or die(mysqli_error($koneksi));

    // Redirect ke halaman pemasukan
    header("location:pemasukan.php");
    exit;
} else {
    echo "Harga pokok tidak ditemukan. Silakan periksa data harga.";
}
?>
