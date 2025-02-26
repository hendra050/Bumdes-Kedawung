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

              <a href="laporan_pdf.php?tanggal_dari=<?php echo $tgl_dari ?>&tanggal_sampai=<?php echo $tgl_sampai ?>&kategori=<?php echo $kategori ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <?php
                    $query = "
                    SELECT output_tanggal AS tanggal, NULL AS kategori, NULL AS keterangan, output_total AS pemasukan, 0 AS pengeluaran
                    FROM omset_pertashop
                    WHERE DATE(output_tanggal) BETWEEN '$tgl_dari' AND '$tgl_sampai'
                    
                    UNION ALL
                    
                    SELECT opex_pertashop.opex_tanggal AS tanggal, kategori_pertashop.kategori AS kategori, 
                          opex_pertashop.opex_keterangan AS keterangan, 0 AS pemasukan, opex_pertashop.opex_nominal AS pengeluaran
                    FROM opex_pertashop
                    JOIN kategori_pertashop ON opex_pertashop.opex_kategori = kategori_pertashop.kategori_id
                    WHERE DATE(opex_pertashop.opex_tanggal) BETWEEN '$tgl_dari' AND '$tgl_sampai'
                    
                    ORDER BY tanggal ASC";
                
                    
                    $result = mysqli_query($koneksi, $query);

                    $total_pemasukan = 0;
                    $total_pengeluaran = 0;
                    $no = 1;
                    ?>
                <thead>
                  <tr> 
                      <th width="1%" rowspan="2">NO</th>
                      <th width="20%" rowspan="2" class="text-center">TANGGAL</th>
                      <th rowspan="2" class="text-center" width="20%">KATEGORI</th>
                      <th rowspan="2" class="text-center" width="30%">KETERANGAN</th>
                      <th colspan="2" class="text-center" width="30%">JENIS</th>
                  </tr>
                  <tr>
                      <th class="text-center" width="15%">PEMASUKAN</th>
                      <th class="text-center" width="15%">PENGELUARAN</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo date('d-m-Y H:i:s', strtotime($row['tanggal'])); ?></td>
                      <td><?php echo $row['kategori'] ? $row['kategori'] : "Pemasukan"; ?></td>
                      <td><?php echo $row['keterangan']; ?></td>
                      <td class="text-center text-success" width="15%">
                        <?php echo $row['pemasukan'] ? "Rp. " . number_format($row['pemasukan']) . " ,-": "-"; ?>
                      </td>
                      <td class="text-center text-danger" width="15%">
                        <?php echo $row['pengeluaran'] ? "Rp. " . number_format($row['pengeluaran']) . " ,-": "-"; ?>
                      </td>
                    </tr>
                    <?php
                      $total_pemasukan += $row['pemasukan'];
                      $total_pengeluaran += $row['pengeluaran'];
                    ?>
                  <?php endwhile; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="4" class="text-right">TOTAL</th>
                    <td class="text-center text-bold text-success">
                      <?php echo "Rp. " . number_format($total_pemasukan) . " ,-"; ?>
                    </td>
                    <td class="text-center text-bold text-danger">
                      <?php echo "Rp. " . number_format($total_pengeluaran) . " ,-"; ?>
                    </td>
                  </tr>
                  <tr>
                    <th colspan="4" class="text-right">LABA BERSIH</th>
                    <td colspan="2" class="text-center text-bold text-white bg-primary">
                      <?php echo "Rp. " . number_format($total_pemasukan - $total_pengeluaran) . " ,-"; ?>
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