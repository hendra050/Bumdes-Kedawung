<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include '../koneksi.php';

// Ambil data dari form
$kode = $_POST['output_kode']; // Ambil kode unik
$odo_masuk = floatval($_POST['odomasuk']);
$odo_keluar = floatval($_POST['odokeluar']);

// Pastikan `output_kode` tidak kosong
if (empty($kode)) {
    die("Error: output_kode tidak ditemukan.");
}

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

    // Ambil waktu login dari sesi
    if (!isset($_SESSION['login_time'])) {
        $_SESSION['login_time'] = date('H:i:s');
    }
    
    $waktu_login = $_SESSION['login_time'];
    $waktu_input = date('H:i:s');
    
    // Konversi waktu login dan input ke timestamp
    $time_login = strtotime($waktu_login);
    $time_input = strtotime($waktu_input);
    $selisih_jam = ($time_input - $time_login) / 3600;

    // **LOGIKA SHIFT**
    if ($selisih_jam >= 8) {
        $shift = "fullday"; 
    } else {
        $jam_login = (int) date('H', $time_login);
        $jam_input = (int) date('H', $time_input);

        if ($jam_login >= 7 && $jam_login < 15) {
            $shift = ($jam_input < 15) ? "pagi" : "fullday";
        } elseif ($jam_login >= 15 && $jam_login < 22) {
            $shift = ($jam_input < 22) ? "siang" : "fullday";
        } else {
            $shift = "fullday";
        }
    }

    // Update data di database
    $update_query = "UPDATE omset_pertashop SET 
                        odo_masuk = '$odo_masuk', 
                        odo_keluar = '$odo_keluar', 
                        output_jual = '$output_jual', 
                        harga = '$harga', 
                        output_total = '$total', 
                        shift = '$shift' 
                    WHERE output_kode = '$kode'";
    
    mysqli_query($koneksi, $update_query) or die(mysqli_error($koneksi));
    
    // Redirect ke halaman pemasukan
    header("location:pemasukan.php");
    exit;
} else {
    echo "Harga pokok tidak ditemukan. Silakan periksa data harga.";
}
?>
