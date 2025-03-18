<?php 
include '../koneksi.php';

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$id = $_POST['id']; 
$now = date('Y-m-d H:i:s');
$jumlah  = floatval($_POST['jumlah']);
$harga = preg_replace("/[^0-9]/", "", $_POST['harga']);

$total_harga = $jumlah * $harga;

$rand = rand();

$allowed =  array('png','jpg','jpeg');

$filename = $_FILES['foto']['name'];

if($filename == ""){
	mysqli_query($koneksi, "UPDATE do_pertashop SET input_edit='$now', input_jumlah='$jumlah', input_perliter='$harga', input_harga='$total_harga' WHERE input_id='$id'");
	header("location:tambah.php");
}else{
	$ext = pathinfo($filename, PATHINFO_EXTENSION);

	if(!in_array($ext,$allowed) ) {
		header("location:tambah.php?alert=gagal");
	}else{
		move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/user/'.$rand.'_'.$filename);

		$file_gambar = $rand.'_'.$filename;

		mysqli_query($koneksi, "UPDATE do_pertashop SET input_edit='$now', input_jumlah='$jumlah', input_perliter='$harga', input_harga='$total_harga', input_foto='$file_gambar' WHERE input_id='$id'");
		header("location:tambah.php");
	}
}
?>