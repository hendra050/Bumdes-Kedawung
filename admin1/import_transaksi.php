<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      TRANSAKSI
      <small>Import Transaksi</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">Form Import Transaksi</h3>
          </div>
          <div class="box-body">
          <form method="post" action="" enctype="multipart/form-data">
          <a href="tmp/template.xlsx" class="btn btn-default">
					<span class="glyphicon glyphicon-download"></span>
					Download Format
				</a><br><br>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>File Data Excel</label>
                    <input autocomplete="off" type="file" name="file" placeholder="file" required="required">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <br/>
                    <input type="submit" name="preview" value="PREVIEW" class="btn btn-sm btn-primary btn-block">
                  </div>
                </div>
              </div>
              </form>
          </div>
        </div>
      
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">Preview Import Transaksi</h3>
          </div>
          <div class="box-body">
              <div class="row">
                <div class="col-lg-6">
                  	<!-- Buat Preview Data -->
			<?php
			// Jika user telah mengklik tombol Preview
			if(isset($_POST['preview'])){
				//$ip = ; // Ambil IP Address dari User
				$nama_file_baru = 'data_transaksi.xlsx';
				
				// Cek apakah terdapat file data.xlsx pada folder tmp
				if(is_file('tmp/'.$nama_file_baru)) // Jika file tersebut ada
					unlink('tmp/'.$nama_file_baru); // Hapus file tersebut
				
				$tipe_file = $_FILES['file']['type']; // Ambil tipe file yang akan diupload
				$tmp_file = $_FILES['file']['tmp_name'];
				
				// Cek apakah file yang diupload adalah file Excel 2007 (.xlsx)
				if($tipe_file == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){
					// Upload file yang dipilih ke folder tmp
					// dan rename file tersebut menjadi data{ip_address}.xlsx
					// {ip_address} diganti jadi ip address user yang ada di variabel $ip
					// Contoh nama file setelah di rename : data127.0.0.1.xlsx
					move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);
					
					// Load librari PHPExcel nya
					require_once '../library/PHPExcel/PHPExcel.php';
					
					$excelreader = new PHPExcel_Reader_Excel2007();
					$loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file yang tadi diupload ke folder tmp
					$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
					
					// Buat sebuah tag form untuk proses import data ke database
					echo "<form method='post' action='import.php'>";
					
					// Buat sebuah div untuk alert validasi kosong
					//echo "<div class='alert alert-danger' id='kosong'>
					//Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
					//</div>";
					
					echo " <div class='table-responsive'>
					<table class='table table-bordered table-striped'>
					<thead>
					<tr>
					  <th>No.</th>
						<th>Tanggal Transaksi</th>
						<th>Jenis Transaksi</th>
						<th>Kategori</th>
						<th>Nominal</th>
						<th>Keterangan</th>
						<th>Bank</th>
					</tr>
					</thead>";
					
					$numrow = 1;
					$kosong = 0;
					$no = 0;
					foreach($sheet as $row){ // Lakukan perulangan dari data yang ada di excel
						// Ambil data pada excel sesuai Kolom						
						$tgl = $row['B']; // Ambil data no Pelanggan
						$jenis = $row['C']; // Ambil data Nama Pelanggan						
						$kategori = $row['D'];
						$nominal = $row['E'];
						$keterangan = $row['F'];
						$bank = $row['G'];
						// Cek jika semua data tidak diisi
						if(empty($tgl))
							continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
						
						// Cek $numrow apakah lebih dari 1
						// Artinya karena baris pertama adalah nama-nama kolom
						// Jadi dilewat saja, tidak usah diimport
						if($numrow > 1){
							// Validasi apakah semua data telah diisi
							$tgl_td = ( ! empty($tgl))? "" : " style='background: #E07171;'"; // Jika Tanggal kosong, beri warna merah Company kosong, beri warna merah
							$jenis_td = ( ! empty($jenis))? "" : " style='background: #E07171;'"; // Jika Jenis kosong, beri warna merah
							$kategori_td = ( ! empty($kategori))? "" : " style='background: #E07171;'"; // Jika Kategori kosong, beri warna merah
							$nominal_td = ( ! empty($nominal))? "" : " style='background: #E07171;'"; // Jika Nominal kosong, beri warna merah
							$keterangan_td = ( ! empty($keterangan))? "" : " style='background: #E07171;'"; // Jika Keterangan kosong, beri warna merah
							$bank_td = ( ! empty($bank))? "" : " style='background: #E07171;'"; // Jika Bank kosong, beri warna merah
							
							// Jika salah satu data ada yang kosong
							if(empty($tgl) && empty($kategori)){
								$kosong++; // Tambah 1 variabel $kosong
							}
							
							echo "<tbody>";
							echo "<tr>";
							echo "<td>".$no."</td>";
							echo "<td".$tgl_td.">".$tgl."</td>";
							echo "<td".$jenis_td.">".$jenis."</td>";
							echo "<td".$kategori_td.">".$kategori."</td>";
							echo "<td".$nominal_td.">".$nominal."</td>";
							echo "<td".$keterangan_td.">".$keterangan."</td>";
							echo "<td".$bank_td.">".$bank."</td>";
							echo "</tr>";
							echo "</tbody>";
						}
						
						$numrow++;
						$no++;// Tambah 1 setiap kali looping
					}
					
					echo "</table></div>";
					
					// Cek apakah variabel kosong lebih dari 1
					// Jika lebih dari 1, berarti ada data yang masih kosong
					if($kosong > 1){
					?>	
						<script>
						$(document).ready(function(){
							// Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
							$("#jumlah_kosong").html('<?php echo $kosong; ?>');
							
							$("#kosong").show(); // Munculkan alert validasi kosong
						});
						</script>
					<?php
					}else{ // Jika semua data sudah diisi
						echo "<hr>";
						
						// Buat sebuah tombol untuk mengimport data ke database
						echo "<button type='submit' name='import' class='btn btn-primary'><span class='glyphicon glyphicon-upload'></span> Import</button>";
					}
					
					echo "</form>";
				}else{ // Jika file yang diupload bukan File Excel 2007 (.xlsx)
					// Munculkan pesan validasi
					echo "<div class='alert alert-danger'>
					Hanya File Excel 2007 (.xlsx) yang diperbolehkan
					</div>";
				}
			}
			?>
          </div>
        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>