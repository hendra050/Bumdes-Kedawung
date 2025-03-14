<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Data Pengeluaran
      <small>Opex</small>
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
            <h3 class="box-title">Pengeluaran</h3>
            <form method="GET" action="">
              <div class="row">
                <div class="col-md-3">
                  <label for="tanggal">Cari berdasarkan Tanggal:</label>
                  <input type="date" name="tanggal" class="form-control" value="<?php echo isset($_GET['tanggal']) ? $_GET['tanggal'] : ''; ?>">
                </div>

                <div class="col-md-3">
                  <label for="filter">Filter berdasarkan Waktu:</label>
                  <select name="filter" class="form-control">
                    <option value="">-- Pilih Filter --</option>
                    <option value="minggu">Minggu Ini</option>
                    <option value="bulan">Bulan Ini</option>
                    <option value="semester">Semester Ini</option>
                    <option value="tahun">Tahun Ini</option>
                  </select>
                </div>
                
                <div class="col-md-2">
                  <br>
                  <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
                  <a href="pengeluaran.php" class="btn btn-danger"><i class="fa fa-refresh"></i> Reset</a>
                </div>
              </div>
            </form>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th width="10%" class="text-center">TANGGAL</th>
                    <th>KATEGORI</th>
                    <th>KETERANGAN</th>
                    <th>NOMINAL</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no = 1;
                  $src = "";
                  $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
                
                  if (!empty($filter)) {
                      $current_date = date("Y-m-d");
                      if ($filter == "minggu") {
                          $src = "AND opex_tanggal >= DATE_SUB('$current_date', INTERVAL 1 WEEK)";
                      } elseif ($filter == "bulan") {
                          $src = "AND opex_tanggal >= DATE_SUB('$current_date', INTERVAL 1 MONTH)";
                      } elseif ($filter == "semester") {
                          $src = "AND opex_tanggal >= DATE_SUB('$current_date', INTERVAL 6 MONTH)";
                      } elseif ($filter == "tahun") {
                          $src = "AND opex_tanggal >= DATE_SUB('$current_date', INTERVAL 1 YEAR)";
                      }
                  }
                  
                  if (isset($_GET['tanggal']) && !empty($_GET['tanggal'])) {
                      $tanggal = $_GET['tanggal'];
                      $src = "AND DATE(opex_tanggal) = '$tanggal'";
                  }
                  
                  $data = mysqli_query($koneksi, "SELECT * FROM opex_pertashop, kategori_pertashop WHERE kategori_id = opex_kategori $src ORDER BY opex_tanggal DESC");
                  
                  while($d = mysqli_fetch_array($data)) {
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo $d['opex_tanggal']; ?></td>
                      <td><?php echo $d['kategori']; ?></td>
                      <td><?php echo $d['opex_keterangan']; ?></td>
                      <td><?php echo "Rp. ".number_format($d['opex_nominal'])." ,-" ?></td>
                    </tr>
                    <?php 
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>