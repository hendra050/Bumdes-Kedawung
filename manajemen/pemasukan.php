<?php include 'header.php'; ?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Data Pemasukan <small>BUMDes</small></h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Pemasukan</h3>
            <div class="btn-group pull-right">
              <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Pemasukan
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
                  <a href="pemasukan.php" class="btn btn-danger"><i class="fa fa-refresh"></i> Reset</a>
                </div>
              </div>
            </form>
          </div>
          <div class="box-body">

            <!-- Modal Tambah -->
            <form action="pemasukan_act.php" method="post">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Tambah Pemasukan</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Sumber Dana</label>
                        <input type="text" name="sumber_dana" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3"></textarea>
                      </div>
                      <div class="form-group">
                        <label>Nominal</label>
                        <input type="text" name="nominal" class="form-control rupiah" required placeholder="Masukkan Nominal ..">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>

            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th>NO</th>
                    <th>TANGGAL</th>
                    <th>SUMBER DANA</th>
                    <th>KETERANGAN</th>
                    <th>NOMINAL</th>
                    <th>OPSI</th>
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
                      if ($filter == "minggu") $src = "AND tanggal >= DATE_SUB('$current_date', INTERVAL 1 WEEK)";
                      elseif ($filter == "bulan") $src = "AND tanggal >= DATE_SUB('$current_date', INTERVAL 1 MONTH)";
                      elseif ($filter == "semester") $src = "AND tanggal >= DATE_SUB('$current_date', INTERVAL 6 MONTH)";
                      elseif ($filter == "tahun") $src = "AND tanggal >= DATE_SUB('$current_date', INTERVAL 1 YEAR)";
                  }

                  if (isset($_GET['tanggal']) && !empty($_GET['tanggal'])) {
                      $tanggal = $_GET['tanggal'];
                      $src = "AND DATE(tanggal) = '$tanggal'";
                  }

                  $data = mysqli_query($koneksi, "SELECT * FROM pemasukan_bumdes WHERE 1=1 $src ORDER BY tanggal DESC");
                  while($d = mysqli_fetch_array($data)) {
                  ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $d['tanggal']; ?></td>
                    <td><?php echo $d['sumber_dana']; ?></td>
                    <td><?php echo $d['keterangan']; ?></td>
                    <td><?php echo "Rp. ".number_format($d['nominal'])." ,-"; ?></td>
                    <td>
                      <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_<?php echo $d['id'] ?>"><i class="fa fa-edit"></i></button>
                      <a href="pemasukan_hapus.php?id=<?php echo $d['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>

                  <!-- Modal Edit -->
                  <form action="pemasukan_update.php" method="post">
                    <div class="modal fade" id="edit_<?php echo $d['id'] ?>" tabindex="-1" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Pemasukan</h4>
                          </div>
                          <div class="modal-body">
                            <input type="hidden" name="id" value="<?php echo $d['id'] ?>">
                            <div class="form-group">
                              <label>Sumber Dana</label>
                              <input type="text" name="sumber_dana" class="form-control" value="<?php echo $d['sumber_dana'] ?>" required>
                            </div>
                            <div class="form-group">
                              <label>Keterangan</label>
                              <textarea name="keterangan" class="form-control"><?php echo $d['keterangan'] ?></textarea>
                            </div>
                            <div class="form-group">
                              <label>Nominal</label>
                              <input type="number" name="nominal" class="form-control" value="<?php echo $d['nominal'] ?>" required>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-success">Update</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <?php } ?>
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
