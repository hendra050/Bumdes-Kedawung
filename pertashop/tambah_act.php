<?php 
include '../koneksi.php';

$tanggal  = $_POST['tanggal'];
$jumlah  = floatval($_POST['jumlah']);
$harga = preg_replace("/[^0-9]/", "", $_POST['harga']);

$total_harga = $jumlah * $harga;

$rand = rand();

$allowed =  array('png','jpg','jpeg');

$filename = $_FILES['foto']['name'];

if($filename == ""){
	mysqli_query($koneksi, "INSERT INTO do_pertashop (input_tanggal, input_jumlah, input_perliter, input_harga, input_foto) 
	VALUES (NOW(), '$jumlah', '$harga', '$total_harga', '')");
	header("location:tambah.php");
}else{
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	
	if(!in_array($ext,$allowed) ) {
		header("location:tambah.php?alert=gagal");
	}else{
		move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/user/'.$rand.'_'.$filename);

		$file_gambar = $rand.'_'.$filename;

		mysqli_query($koneksi, "INSERT INTO do_pertashop (input_tanggal, input_jumlah, input_perliter, input_harga, input_foto) VALUES (NOW(), '$jumlah', '$harga', '$total_harga', '$file_gambar')");
		header("location:tambah.php");
	}
}