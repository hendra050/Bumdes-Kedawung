<?php include 'header.php'; ?>
<?php include '../koneksi.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      LAPORAN STOK
      <small>Data Laporan Stok</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Laporan Stok</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">Filter Laporan Stok</h3>
          </div>
          <div class="box-body">
            <form method="get" action="">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Mulai Tanggal</label>
                    <input type="date" name="tanggal_dari" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Sampai Tanggal</label>
                    <input type="date" name="tanggal_sampai" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <br/>
                    <input type="submit" value="TAMPILKAN" class="btn btn-sm btn-primary btn-block">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">Laporan Stok Pertashop</h3>
          </div>
          <div class="box-body">
            <?php 
            if(isset($_GET['tanggal_dari']) && isset($_GET['tanggal_sampai'])){
              $tgl_dari = $_GET['tanggal_dari'];
              $tgl_sampai = $_GET['tanggal_sampai'];
              ?>

              <div class="row">
                <div class="col-lg-6">
                  <table class="table table-bordered">
                    <tr>
                      <th width="30%">DARI TANGGAL</th>
                      <th width="1%">:</th>
                      <td><?php echo $tgl_dari; ?></td>
                    </tr>
                    <tr>
                      <th>SAMPAI TANGGAL</th>
                      <th>:</th>
                      <td><?php echo $tgl_sampai; ?></td>
                    </tr>
                  </table>
                </div>
              </div>

              <a href="laporan_pdf_stok.php?tanggal_dari=<?php echo $tgl_dari ?>&tanggal_sampai=<?php echo $tgl_sampai ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>

              <br/><br/>

              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">TANGGAL</th>
                      <th class="text-center">STOK AWAL</th>
                      <th class="text-center">STOK MASUK</th>
                      <th class="text-center">STOK KELUAR</th>
                      <th class="text-center">STOK SISA</th>
                      <th class="text-center">MANUAL AWAL</th>
                      <th class="text-center">MANUAL AKHIR</th>
                      <th class="text-center">MANUAL SISA</th>
                      <th class="text-center">PENGUAPAN</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $data = mysqli_query($koneksi, "SELECT * FROM stok_pertashop WHERE DATE(tanggal_masuk) BETWEEN '$tgl_dari' AND '$tgl_sampai' ORDER BY tanggal_masuk ASC");
                    while($d = mysqli_fetch_array($data)){
                    ?>
                      <tr>
                        <td class="text-center"><?php echo $d['tanggal_masuk']; ?></td>
                        <td class="text-center"><?php echo $d['stok_awal']; ?> liter</td>
                        <td class="text-center"><?php echo $d['stok_masuk']; ?> liter</td>
                        <td class="text-center"><?php echo $d['stok_keluar']; ?> liter</td>
                        <td class="text-center"><?php echo $d['stok_sisa']; ?> liter</td>
                        <td class="text-center"><?php echo $d['manual_awal']; ?></td>
                        <td class="text-center"><?php echo $d['manual_akhir']; ?></td>
                        <td class="text-center"><?php echo $d['manual_selisih']; ?></td>
                        <td class="text-center"><?php echo $d['penguapan']; ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>

              <?php
            } else {
              ?>
              <div class="alert alert-info text-center">
                Silakan filter laporan terlebih dahulu.
              </div>
              <?php
            }
            ?>
          </div>
        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>
