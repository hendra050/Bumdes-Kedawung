<?php require_once 'belum_login/header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <?php 
    function get_total($koneksi, $column, $table1, $table2, $condition) {
        $query = "SELECT 
            (SELECT SUM($column) FROM $table1 WHERE $condition) +
            (SELECT SUM($column) FROM $table2 WHERE $condition) 
            AS total";
        $result = mysqli_query($koneksi, $query);
        $data = mysqli_fetch_assoc($result);
        return $data['total'] ?? 0;
    }

    $pemasukan_minggu_ini = get_total($koneksi, 'output_total', 'omset_pertashop', 'omset_peternakan', 'YEARWEEK(output_tanggal, 1) = YEARWEEK(CURDATE(), 1)');
    $pengeluaran_minggu_ini = get_total($koneksi, 'opex_nominal', 'opex_pertashop', 'opex_peternakan', 'YEARWEEK(opex_tanggal, 1) = YEARWEEK(CURDATE(), 1)');
    
    $pemasukan_bulan_ini = get_total($koneksi, 'output_total', 'omset_pertashop', 'omset_peternakan', 'YEAR(output_tanggal) = YEAR(CURDATE()) AND MONTH(output_tanggal) = MONTH(CURDATE())');
    $pengeluaran_bulan_ini = get_total($koneksi, 'opex_nominal', 'opex_pertashop', 'opex_peternakan', 'YEAR(opex_tanggal) = YEAR(CURDATE()) AND MONTH(opex_tanggal) = MONTH(CURDATE())');
    
    $pemasukan_semester_ini = get_total($koneksi, 'output_total', 'omset_pertashop', 'omset_peternakan', 'YEAR(output_tanggal) = YEAR(CURDATE()) AND ((MONTH(output_tanggal) BETWEEN 1 AND 6 AND MONTH(CURDATE()) BETWEEN 1 AND 6) OR (MONTH(output_tanggal) BETWEEN 7 AND 12 AND MONTH(CURDATE()) BETWEEN 7 AND 12))');
    $pengeluaran_semester_ini = get_total($koneksi, 'opex_nominal', 'opex_pertashop', 'opex_peternakan', 'YEAR(opex_tanggal) = YEAR(CURDATE()) AND ((MONTH(opex_tanggal) BETWEEN 1 AND 6 AND MONTH(CURDATE()) BETWEEN 1 AND 6) OR (MONTH(opex_tanggal) BETWEEN 7 AND 12 AND MONTH(CURDATE()) BETWEEN 7 AND 12))');
    
    $pemasukan_tahun_ini = get_total($koneksi, 'output_total', 'omset_pertashop', 'omset_peternakan', 'YEAR(output_tanggal) = YEAR(CURDATE())');
    $pengeluaran_tahun_ini = get_total($koneksi, 'opex_nominal', 'opex_pertashop', 'opex_peternakan', 'YEAR(opex_tanggal) = YEAR(CURDATE())');
  ?>

  <section class="content">
    
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h4 style="font-weight: bolder"><?php echo "Rp. " . number_format($pemasukan_minggu_ini ?? 0) . " ,-" ?></h4>
            <p>Penjualan Minggu Ini</p>
          </div>
          <div class="icon">
              <i class="ion ion-stats-bars"></i>
          </div>
          <a href="pemasukan.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-blue">
          <div class="inner">
            <h4 style="font-weight: bolder"><?php echo "Rp. " . number_format($pemasukan_bulan_ini ?? 0) . " ,-" ?></h4>
            <p>Penjualan Bulan Ini</p>
          </div>
          <div class="icon">
              <i class="ion ion-stats-bars"></i>
          </div>
          <a href="pemasukan.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
          <div class="inner">
            <h4 style="font-weight: bolder"><?php echo "Rp. " . number_format($pemasukan_semester_ini ?? 0) . " ,-" ?></h4>
            <p>Penjualan Semester Ini</p>
          </div>
          <div class="icon">
              <i class="ion ion-stats-bars"></i>
          </div>
          <a href="pemasukan.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-black">
            <div class="inner">
                <h4 style="font-weight: bolder"><?php echo "Rp. " . number_format($pemasukan_tahun_ini ?? 0) . " ,-" ?></h4>
                <p>Penjualan Tahun Ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="pemasukan.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>


<!-- pengeluaran -->


      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h4 style="font-weight: bolder"><?php echo "Rp. " . number_format($pengeluaran_minggu_ini ?? 0) . " ,-" ?></h4>
            <p>Pengeluaran Minggu Ini</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="pengeluaran.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-blue">
          <div class="inner">
            <h4 style="font-weight: bolder"><?php echo "Rp. " . number_format($pengeluaran_bulan_ini ?? 0) . " ,-" ?></h4>
            <p>Pengeluaran Bulan Ini</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="pengeluaran.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
          <div class="inner">
            <h4 style="font-weight: bolder"><?php echo "Rp. " . number_format($pengeluaran_semester_ini ?? 0) . " ,-" ?></h4>
            <p>Penjualan Semester Ini</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="pengeluaran.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-black">
          <div class="inner">
            <h4 style="font-weight: bolder"><?php echo "Rp. " . number_format($pengeluaran_tahun_ini ?? 0) . " ,-" ?></h4>
            <p>Penjualan Tahun Ini</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="pengeluaran.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

    </div>

    <!-- /.row -->
    <!-- Main row -->
    <div class="row">

      <!-- Left col -->
      <section class="col-lg-8">

        <div class="nav-tabs-custom">

          <ul class="nav nav-tabs pull-right">
            <li class="active"><a href="#tab1" data-toggle="tab">Pemasukan & Pengeluaran</a></li>
            <li class="pull-left header">Grafik</li>
          </ul>

          <div class="tab-content" style="padding: 20px">

            <div class="chart tab-pane active" id="tab1">             
              <h4 class="text-center">Grafik Data Pemasukan & Pengeluaran Per <b>Bulan</b></h4>
              <canvas id="grafik1" style="position: relative; height: 300px;"></canvas>
              <br/>
              <br/>
              <br/>

              <h4 class="text-center">Grafik Data Pemasukan & Pengeluaran Per <b>Tahun</b></h4>
              <canvas id="grafik2" style="position: relative; height: 300px;"></canvas>

            </div>
            <div class="chart tab-pane" id="tab2" style="position: relative; height: 300px;">
            </div>
          </div>

        </div>

      </section>
      <!-- /.Left col -->


      <section class="col-lg-4">


        <!-- Calendar -->
        <div class="box box-solid bg-green-gradient">
          <div class="box-header">
            <i class="fa fa-calendar"></i>
            <h3 class="box-title">Kalender</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body no-padding">
            <!--The calendar -->
            <div id="calendar" style="width: 100%"></div>
          </div>
          <!-- /.box-body -->
        </div>

      </section>
      <!-- right col -->
    </div>
    <!-- /.row (main row) -->
  </section>

</div>
<?php include 'belum_login/footer.php'; ?>