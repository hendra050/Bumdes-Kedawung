<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Stok
      <small>Data Stok</small>
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
            <h3 class="box-title">Total Stok Yang Dimiliki</h3>
            <div class="btn-group pull-right">            
              <a href="stok_act.php"><button type="button" class="btn btn-success btn-sm">
                <i class="fa fa-file-excel-o"></i> &nbsp Update Data Stok
              </button></a>
            </div>
          </div>
          <div class="box-body">

            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%" class="text-center" rowspan="2">NO</th>
                    <th class="text-center" rowspan="2">Tanggal</th>
                    <th class="text-center" rowspan="2">STOK AWAL</th>
                    <th class="text-center" rowspan="2">STOK MASUK</th>
                    <th class="text-center" rowspan="2">STOK KELUAR</th>
                    <th class="text-center" rowspan="2">STOK SISA</th>
                    <th class="text-center" colspan="2">ODOMETER</th>
                    <th class="text-center" rowspan="2">PENGUAPAN</th>
                  </tr>
                  <tr>
                    <th class="text-center">MASUK</th>
                    <th class="text-center">KELUAR</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi, "SELECT * FROM stok_pertashop ");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center" width="10%" ><?php echo $d['tanggal_masuk'];?></td>
                      <td class="text-center"><?php echo $d['stok_awal'];?> liter</td>
                      <td class="text-center"><?php echo $d['stok_masuk'];?> liter</td>
                      <td class="text-center"><?php echo $d['stok_keluar'];?> liter</td>
                      <td class="text-center"><?php echo $d['stok_sisa'];?> liter</td>
                      <td class="text-center"><?php echo $d['odo_masuk'];?> liter</td>
                      <td class="text-center"><?php echo $d['odo_keluar'];?> liter</td>
                      <td class="text-center"><?php echo $d['penguapan'];?> liter</td>
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