<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Tambah Stok
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
            <h3 class="box-title">Penambahan Stok</h3>
            <div class="btn-group pull-right">            
              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Transaksi
              </button>
            </div>
          </div>
          <div class="box-body">

            <!-- Modal -->
            <form action="tambah_act.php" method="post" enctype="multipart/form-data">
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
                        <label>Jumlah</label>
                        <input type="number" name="jumlah" required="required" class="form-control" placeholder="Masukkan Jumlah .." step="0.01" min="0">
                      </div>

                      <div class="form-group">
                        <label>Harga/liter</label>
                        <input type="number" name="harga" required="required" class="form-control" placeholder="Masukkan Harga ..">
                      </div>

                      <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="foto" accept="image/">
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
                    <th class="text-center">JUMLAH</th>
                    <th class="text-center">HARGA POKOK PENJUALAN</th>
                    <th class="text-center">TOTAL HARGA</th>
                    <th class="text-center">FOTO</th>
                    <th width="10%" class="text-center">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi, "SELECT * FROM do_pertashop ");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo $d['input_tanggal']; ?></td>
                      <td><?php echo $d['input_jumlah']; ?></td>
                      <td><?php echo "Rp. ".number_format($d['input_perliter'])." ,-" ?></td>
                      <td><?php echo "Rp. ".number_format($d['input_harga'])." ,-" ?></td>
                      <td>
                      <?php if($d['input_foto'] == ""){ ?>
                            <img src="../gambar/sistem/user.png" style="width: 80px;height: auto">
                          <?php }else{ ?>
                            <img src="../gambar/user/<?php echo $d['input_foto'] ?>" style="width: 80px;height: auto">
                          <?php } ?>
                      </td>
                      <td>    
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_transaksi_<?php echo $d['input_id'] ?>">
                          <i class="fa fa-cog"></i>
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_transaksi_<?php echo $d['input_id'] ?>">
                          <i class="fa fa-trash"></i>
                        </button>


                        <form action="tambah_update.php" method="post">
                          <div class="modal fade" id="edit_transaksi_<?php echo $d['input_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <label>Jumlah</label>
                                    <input type="number" style="width:100%" name="jumlah" required="required" class="form-control" placeholder="Masukkan Jumlah .." value="<?php echo $d['input_jumlah'] ?>" step="0.01" min="0">
                                  </div>

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Harga/liter</label>
                                    <input type="number" style="width:100%" name="harga" required="required" class="form-control" placeholder="Masukkan Harga .." value="<?php echo $d['input_perliter'] ?>">
                                  </div>

                                  <label>Foto</label>
                                    <input type="file" name="foto" accept="image/">
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
                        <div class="modal fade" id="hapus_transaksi_<?php echo $d['input_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <a href="tambah_hapus.php?id=<?php echo $d['input_id'] ?>" class="btn btn-primary">Hapus</a>
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