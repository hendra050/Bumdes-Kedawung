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
                <i class="fa fa-plus"></i> &nbsp Tambah Stok Masuk
              </button>
            </div>
          </div>
          <div class="box-body">

            <!-- Modal Tambah Stok -->
            <form action="stok_kambing_act.php" method="post">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="exampleModalLabel">Tambah Stok Masuk</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      
                      <div class="form-group">
                        <label>Kandang</label>
                        <select name="id_kandang" class="form-control" required>
                          <option value="">-- Pilih Kandang --</option>
                          <?php 
                          $kandang = mysqli_query($koneksi,"SELECT * FROM kandang");
                          while($k = mysqli_fetch_array($kandang)){
                          ?>
                            <option value="<?php echo $k['id_kandang'] ?>"><?php echo $k['nama_kandang'] ?></option>
                          <?php } ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Jumlah Masuk</label>
                        <input type="number" name="jumlah" class="form-control" required placeholder="Jumlah kambing masuk...">
                      </div>

                      <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" placeholder="Opsional..."></textarea>
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
                    <th class="text-center" width="5%">No.</th>
                    <th class="text-center" >Nama Kandang</th>
                    <th class="text-center" >Kapasitas</th>
                    <th class="text-center" >OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

                  $no=1;
                  $data = mysqli_query($koneksi, "SELECT * FROM kandang order by id_kandang asc");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo $d['nama_kandang'];?></td>
                      <?php 
                        // Hitung stok masuk per kandang
                        $id_kandang = $d['id_kandang'];

                        $q_masuk = mysqli_query($koneksi, "SELECT SUM(jumlah) as total_masuk FROM peternakan_stok_masuk WHERE id_kandang='$id_kandang'");
                        $masuk = mysqli_fetch_assoc($q_masuk);
                        $total_masuk = $masuk['total_masuk'] ?? 0;

                        // Hitung stok keluar per kandang
                        $q_keluar = mysqli_query($koneksi, "SELECT SUM(jumlah) as total_keluar FROM omset_peternakan WHERE kandang='$id_kandang'");
                        $keluar = mysqli_fetch_assoc($q_keluar);
                        $total_keluar = $keluar['total_keluar'] ?? 0;

                        // Hitung kapasitas terpakai
                        $kapasitas_terpakai = $total_masuk - $total_keluar;
                      ?>
                      <td class="text-center">
                        <?php echo $kapasitas_terpakai . " ekor"; ?>
                      </td>

                      <td class="text-center">
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_output_<?php echo $d['id_kandang'] ?>">
                              <i class="fa fa-eye"></i>
                        </button>
                          <!-- Modal Detail Kandang -->
                          <div class="modal fade" id="edit_output_<?php echo $d['id_kandang'] ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel_<?php echo $d['id_kandang'] ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="detailModalLabel_<?php echo $d['id_kandang'] ?>">Detail Kandang</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <h4>Data Stok Masuk</h4>
                                  <table class="table table-bordered">
                                    <thead class="bg-info text-white">
                                      <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah Masuk</th>
                                        <th>Keterangan</th>
                                        <th>Opsi</th>
                                      </tr>
                                    </thead>
                                    <?php
                                    $id_kandang = $d['id_kandang'];
                                    $masuk = mysqli_query($koneksi, "SELECT * FROM stok_masuk WHERE id_kandang='$id_kandang' ORDER BY tanggal DESC");
                                    $no=1;
                                    while($m = mysqli_fetch_array($masuk)){
                                    ?>
                                    <tr>
                                      <td><?= $no++; ?></td>
                                      <td><?= date('d-m-Y', strtotime($m['tanggal'])); ?></td>
                                      <td><?= $m['jumlah']; ?></td>
                                      <td><?= $m['keterangan']; ?></td>
                                      <td>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_output_<?php echo $m['id_masuk'] ?>">
                                          <i class="fa fa-trash"></i>
                                        </button>
                                        <!-- modal hapus -->
                                        <div class="modal fade" id="hapus_output_<?php echo $m['id_masuk'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <a href="stok_masuk_hapus.php?id=<?php echo $m['id_masuk'] ?>" class="btn btn-primary">Hapus</a>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </td>
                                    </tr>
                                    <?php } ?>
                                  </table>

                                  <h4>Data Stok Keluar</h4>
                                  <table class="table table-bordered">
                                    <thead class="bg-danger text-dark">
                                      <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah Keluar</th>
                                        <th>Jenis</th>
                                        <th>Keterangan</th>
                                        <th>Opsi</th>
                                      </tr>
                                    </thead>
                                    <?php
                                    $keluar = mysqli_query($koneksi, "SELECT * FROM stok_keluar WHERE id_kandang='$id_kandang' ORDER BY tanggal DESC");
                                    $no=1;
                                    while($k = mysqli_fetch_array($keluar)){
                                    ?>
                                    <tr>
                                      <td><?= $no++; ?></td>
                                      <td><?= date('d-m-Y', strtotime($k['tanggal'])); ?></td>
                                      <td><?= $k['jumlah']; ?></td>
                                      <td><?= $k['jenis_keluar']; ?></td>
                                      <td><?= $k['keterangan']; ?></td>
                                      <td>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_output_<?php echo $k['id_keluar'] ?>">
                                          <i class="fa fa-trash"></i>
                                        </button>
                                        <!-- modal hapus -->
                                        <div class="modal fade" id="hapus_output_<?php echo $k['id_keluar'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <a href="stok_keluar_hapus.php?id=<?php echo $k['id_keluar'] ?>" class="btn btn-primary">Hapus</a>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </td>
                                    </tr>
                                    <?php } ?>
                                  </table>
                                </div>
                                </div>
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