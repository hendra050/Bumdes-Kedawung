<?php 
include '../koneksi.php';

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Ambil data dari form
$id = $_POST['id']; // ID tambah yang akan diupdate
$tanggal  = $_POST['tanggal'];
$jumlah  = floatval($_POST['jumlah']);
$harga  = $_POST['harga'];

// Hitung total harga
$total_harga = $jumlah * $harga;

// Generate nama file random
$rand = rand();

// Definisikan ekstensi file yang diizinkan
$allowed =  array('png','jpg','jpeg');

// Ambil nama file yang diupload
$filename = $_FILES['foto']['name'];

// Cek jika file tidak diupload
if($filename == ""){
	mysqli_query($koneksi, "UPDATE do_pertashop SET input_tanggal='$tanggal', input_jumlah='$jumlah', input_perliter='$harga', input_harga='$total_harga' WHERE input_id='$id'");
	header("location:tambah.php");
}else{
	// Ambil ekstensi file yang diupload
	$ext = pathinfo($filename, PATHINFO_EXTENSION);

	// Cek jika ekstensi file tidak diizinkan
	if(!in_array($ext,$allowed) ) {
		header("location:tambah.php?alert=gagal");
	}else{
		// Upload file ke direktori gambar
		move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/user/'.$rand.'_'.$filename);

		// Simpan nama file yang diupload
		$file_gambar = $rand.'_'.$filename;

		// Simpan data ke database
		mysqli_query($koneksi, "UPDATE do_pertashop SET input_tanggal='$tanggal', input_jumlah='$jumlah', input_perliter='$harga', input_harga='$total_harga', input_foto='$file_gambar' WHERE input_id='$id'");
		header("location:tambah.php");
	}
}
?>