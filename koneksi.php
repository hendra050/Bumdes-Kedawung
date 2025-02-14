<?php 

date_default_timezone_set('Asia/Jakarta');

$koneksi = mysqli_connect("localhost", "root", "" ,"bumdes_db");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

?>