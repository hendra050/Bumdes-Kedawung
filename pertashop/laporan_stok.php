<?php include 'header.php'; ?>
<?php include '../koneksi.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      LAPORAN
      <small>Data Laporan</small>
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
            <h3 class="box-title">Filter Laporan</h3>
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
            <h3 class="box-title">Laporan Pemasukan & Pegeluaran</h3>
          </div>
          <div class="box-body">

            <?php 
            if(isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari'])){
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

              <a href="laporan_pdf_stok.php?tanggal_dari=<?php echo $tgl_dari ?>&tanggal_sampai=<?php echo $tgl_sampai ?>&kategori=<?php echo $kategori ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <?php
                    $query =
                    "SELECT tanggal_masuk AS tanggal, stok_awal, stok_masuk, stok_keluar, stok_sisa 
                    FROM stok_pertashop
                    WHERE DATE(tanggal_masuk) BETWEEN '$tgl_dari' AND '$tgl_sampai'
                    ORDER BY tanggal ASC";
                
                    
                    $result = mysqli_query($koneksi, $query);

                    $total_pemasukan = 0;
                    $total_pengeluaran = 0;
                    $no = 1;
                    ?>
                <thead>
                  <tr> 
                      <th width="1%">NO</th>
                      <th width="20%" class="text-center">TANGGAL</th>
                      <th class="text-center" >STOK AWAL</th>
                      <th class="text-center" >STOK MASUK</th>
                      <th class="text-center" >STOK KELUAR</th>
                      <th class="text-center" >STOK SISA</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo date('d-m-Y H:i:s', strtotime($row['tanggal'])); ?></td>
                      <td class="text-center"><?php echo $row['stok_awal'] ? $row['stok_awal'] : "-"; ?></td>
                      <td class="text-center"><?php echo $row['stok_masuk'] ? $row['stok_masuk'] : "-" ; ?></td>
                      <td class="text-center"><?php echo $row['stok_keluar'] ? $row['stok_keluar'] : "-" ; ?></td>
                      <td class="text-center"><?php echo $row['stok_sisa'] ? $row['stok_sisa'] : "-" ; ?></td>
                    </tr>
                    <?php
                      $total_pemasukan += $row['stok_masuk'];
                      $total_pengeluaran += $row['stok_keluar'];
                    ?>
                  <?php endwhile; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="3" class="text-right">TOTAL</th>
                    <td class="text-center text-bold text-success">
                      <?php echo number_format($total_pemasukan); ?>
                    </td>
                    <td class="text-center text-bold text-danger">
                      <?php echo number_format($total_pengeluaran); ?>
                    </td>
                  </tr>
                </tfoot>
                </table>
              </div>
              <?php 
            }else{
              ?>

              <div class="alert alert-info text-center">
                Silahkan Filter Laporan Terlebih Dulu.
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