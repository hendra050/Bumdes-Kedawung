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
              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Stok
              </button>
            </div>
          </div>
          <div class="box-body">

            <!-- Modal -->
            <form action="stok_kambing_act.php" method="post">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="exampleModalLabel">Tambah Transaksi</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Odo Masuk</label>
                        <input type="number" name="odomasuk" required="required" class="form-control" placeholder="Masukkan Nominal ..">
                      </div>
                      <div class="form-group">
                        <label>Odo Keluar</label>
                        <input type="number" name="odokeluar" required="required" class="form-control" placeholder="Masukkan Nominal ..">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>

            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th class="text-center" rowspan="2">No Kandang</th>
                    <th class="text-center" colspan="3">Jumlah Kambing/Kandang</th>
                    <th class="text-center" rowspan="2">Keterangan</th>
                    <!-- <th class="text-center" rowspan="2">PENGUAPAN</th> -->
                  </tr>
                  <tr>
                    <th class="text-center">Indukan</th>
                    <th class="text-center">Anakan</th>
                    <th class="text-center">Jumlah Kambing</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi, "SELECT * FROM stok_pertashop order by tanggal_masuk desc");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td class="text-center">Kandang <?php echo $no++; ?></td>
                      <td class="text-center">1</td>
                      <td class="text-center">2</td>
                      <td class="text-center">3</td>
                      <td class="text-center">pengambilan umur melalui kode id kambing</td>
                      <!-- <td class="text-center" width="10%" ><?php echo $d['tanggal_masuk'];?></td>
                      <td class="text-center">
                      <?php echo ($d['stok_awal'] == "0") ? "-" : $d['stok_awal'] . " liter"; ?>
                      </td>
                      <td class="text-center">
                        <?php echo ($d['stok_masuk'] == "0") ? "-" : $d['stok_masuk'] . " liter"; ?>
                      </td>
                      <td class="text-center"><?php echo $d['stok_keluar'];?> liter</td>
                      <td class="text-center"><?php echo $d['stok_sisa'];?> liter</td>
                      <td class="text-center"><?php echo $d['odo_masuk'];?> liter</td>
                      <td class="text-center"><?php echo $d['odo_keluar'];?> liter</td>
                      <td class="text-center"><?php echo $d['odo'];?> liter</td>
                      <td class="text-center"><?php echo $d['penguapan'];?> liter</td> -->
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