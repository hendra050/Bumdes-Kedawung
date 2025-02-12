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
                <i class="fa fa-plus"></i> &nbsp Tambah Pengeluaran
              </button>
            </div>
          </div>
          <div class="box-body">

            <!-- Modal -->
            <form action="pengeluaran_act.php" method="post">
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
                        <label>Tanggal</label>
                        <input type="text" name="tanggal" required="required" class="form-control datepicker2">
                      </div>

                      <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control" required="required">
                          <option value="">- Pilih -</option>
                          <?php 
                          $kategori = mysqli_query($koneksi,"SELECT * FROM kategori_pertashop ORDER BY kategori ASC");
                          while($k = mysqli_fetch_array($kategori)){
                            ?>
                            <option value="<?php echo $k['kategori_id']; ?>"><?php echo $k['kategori']; ?></option>
                            <?php 
                          }
                          ?>
                        </select>
                      </div>
                      
                      <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3"></textarea>
                      </div>

                      <div class="form-group">
                        <label>Nominal</label>
                        <input type="number" name="nominal" required="required" class="form-control" placeholder="Masukkan Nominal ..">
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