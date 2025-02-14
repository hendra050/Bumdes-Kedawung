<?php
include 'koneksi.php';
session_start();
session_unset(); // Hapus semua session sebelumnya
session_destroy(); // Hancurkan sesi lama
session_start(); // Mulai sesi baru

$username = $_POST['username'];
$password = md5($_POST['password']);

$login = mysqli_query($koneksi, "SELECT * FROM user WHERE user_username='$username' AND user_password='$password'");
$cek = mysqli_num_rows($login);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($login);

    $_SESSION['id'] = $data['user_id'];
    $_SESSION['nama'] = $data['user_nama'];
    $_SESSION['username'] = $data['user_username'];
    $_SESSION['level'] = $data['user_level'];
    $_SESSION['login_time'] = date('H:i:s'); // UPDATE waktu login

    if ($data['user_level'] == "pertashop") {
        $_SESSION['status'] = "pertashop_logedin";
        header("location:pertashop/");
    } else {
        header("location:pertashop.php?alert=gagal");
    }
} else {
    header("location:pertashop.php?alert=gagal");
}
?>
