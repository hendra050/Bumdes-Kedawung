<?php 
include '../koneksi.php';

// Ambil data dari form input
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
	mysqli_query($koneksi, "INSERT INTO do_pertashop (input_tanggal, input_jumlah, input_perliter, input_harga, input_foto) 
	VALUES (NOW(), '$jumlah', '$harga', '$total_harga', '')");
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
		mysqli_query($koneksi, "INSERT INTO do_pertashop (input_tanggal, input_jumlah, input_perliter, input_harga, input_foto) VALUES (NOW(), '$jumlah', '$harga', '$total_harga', '$file_gambar')");
		header("location:tambah.php");
	}
}