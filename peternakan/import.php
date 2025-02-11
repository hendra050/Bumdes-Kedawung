<?php
// Load file koneksi.php
include('../koneksi.php');
if(isset($_POST['import'])){ // Jika user mengklik tombol Import
	$nama_file_baru = 'data_transaksi.xlsx';
	
	// Load librari PHPExcel nya
	require_once '../library/PHPExcel/PHPExcel.php';
	
	$excelreader = new PHPExcel_Reader_Excel2007();
	$loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file excel yang tadi diupload ke folder tmp
	$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
	
	// Buat query Insert
	//$sql = $connection->prepare("INSERT INTO transaksi (transaksi_id, transaksi_tanggal, transaksi_jenis, transaksi_kategori, transaksi_nominal, transaksi_keterangan, transaksi_bank) 
	//VALUES (:id, :tanggal, :jenis, :kategori, :nominal, :keterangan, :bank)");
	
	$numrow = 1;
	
	foreach($sheet as $row){	
		if($numrow > 1){			
		// Cek jika semua data tidak diisi
			if(empty($row['B']))
					continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
			$tgl=$row['B'];
			$jenis=$row['C'];
			$kategori=$row['D'];
			$nominal=$row['E'];
			$keterangan=$row['F'];
			$bank=$row['G'];
			// Proses simpan ke Database			
			mysqli_query($koneksi, "insert into transaksi values (NULL,'$tgl','$jenis','$kategori','$nominal','$keterangan','$bank')")or die(mysqli_error($koneksi));
		}
$numrow++; // Tambah 1 setiap kali looping
}
}
header('location: transaksi.php'); // Redirect ke halaman awal
?>
