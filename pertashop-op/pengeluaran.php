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
            <div class="btn-group pull-right">
              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Pengeluaran
              </button>
            </div>

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
                        <input type="text" name="nominal" required="required" class="form-control rupiah" placeholder="Masukkan Nominal ..">
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
                    <th width="1%">NO</th>
                    <th width="10%" class="text-center">TANGGAL</th>
                    <th class="text-center">KATEGORI</th>
                    <th class="text-center">KETERANGAN</th>
                    <th class="text-center">NOMINAL</th>
                    <th width="10%" class="text-center">OPSI</th>
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
                      <td>    
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_transaksi_<?php echo $d['opex_id'] ?>">
                          <i class="fa fa-cog"></i>
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_transaksi_<?php echo $d['opex_id'] ?>">
                          <i class="fa fa-trash"></i>
                        </button>


                        <form action="pengeluaran_update.php" method="post">
                          <div class="modal fade" id="edit_transaksi_<?php echo $d['opex_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="exampleModalLabel">Edit transaksi</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Tanggal</label>
                                    <input type="hidden" name="id" value="<?php echo $d['opex_id'] ?>">
                                    <input type="text" style="width:100%" name="tanggal" required="required" class="form-control datepicker2" value="<?php echo $d['opex_tanggal'] ?>">
                                  </div>

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Kategori</label>
                                    <select name="kategori" style="width:100%" class="form-control" required="required">
                                      <option value="">- Pilih -</option>
                                      <?php 
                                      $kategori = mysqli_query($koneksi,"SELECT * FROM kategori_pertashop ORDER BY kategori ASC");
                                      while($k = mysqli_fetch_array($kategori)){
                                        ?>
                                        <option <?php if($d['opex_kategori'] == $k['kategori_id']){echo "selected='selected'";} ?> value="<?php echo $k['kategori_id']; ?>"><?php echo $k['kategori']; ?></option>
                                        <?php 
                                      }
                                      ?>
                                    </select>
                                  </div>

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Nominal</label>
                                    <input type="number" style="width:100%" name="nominal" required="required" class="form-control" placeholder="Masukkan Nominal .." value="<?php echo $d['opex_nominal'] ?>">
                                  </div>

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" style="width:100%" class="form-control" rows="4"><?php echo $d['opex_keterangan'] ?></textarea>
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

                        <!-- modal hapus -->
                        <div class="modal fade" id="hapus_transaksi_<?php echo $d['opex_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Peringatan!</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">

                                <p>Yakin ingin menghapus data ini ?</p>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <a href="pengeluaran_hapus.php?id=<?php echo $d['opex_id'] ?>" class="btn btn-primary">Hapus</a>
                              </div>
                            </div>
                          </div>
                        </div>

                      </td>
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