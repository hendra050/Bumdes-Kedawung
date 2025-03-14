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
            <form action="stok_act.php" method="post">
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
                        <label>Perhitungan Manual Awal</label>
                        <input type="number" name="manual_awal" required="required" step="0.01" class="form-control" placeholder="Masukkan Nominal ..">
                      </div>
                      <div class="form-group">
                        <label>Perhitungan Manual Akhir</label>
                        <input type="number" name="manual_akhir" required="required" step="0.01" class="form-control" placeholder="Masukkan Nominal ..">
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
                    <th class="text-center" rowspan="2">Tanggal</th>
                    <th class="text-center" rowspan="2">STOK AWAL</th>
                    <th class="text-center" rowspan="2">STOK MASUK</th>
                    <th class="text-center" rowspan="2">STOK KELUAR</th>
                    <th class="text-center" rowspan="2">STOK SISA</th>
                    <th class="text-center" colspan="3">MANUAL</th>
                    <th class="text-center" rowspan="2">PENGUAPAN</th>
                    <th class="text-center" rowspan="2">OPSI</th>
                  </tr>
                  <tr>
                    <th class="text-center">AWAL</th>
                    <th class="text-center">AKHIR</th>
                    <th class="text-center">MANUAL SISA</th>
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
                      <td class="text-center" width="10%"><?php echo $d['tanggal_masuk'];?></td>
                      <td class="text-center"><?php echo ($d['stok_awal'] == "0") ? "-" : $d['stok_awal'] . " liter"; ?></td>
                      <td class="text-center"><?php echo ($d['stok_masuk'] == "0") ? "-" : $d['stok_masuk'] . " liter"; ?></td>
                      <td class="text-center"><?php echo ($d['stok_keluar'] == "0") ? "-" : $d["stok_keluar"] . " liter";?></td>
                      <td class="text-center"><?php echo $d['stok_sisa'];?> liter</td>
                      <td class="text-center"><?php echo $d['manual_awal'];?> </td>
                      <td class="text-center"><?php echo $d['manual_akhir'];?> </td>
                      <td class="text-center"><?php echo $d['manual_selisih'];?> </td>
                      <td class="text-center"><?php echo $d['penguapan'];?> </td>
                      <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_output_<?php echo $d['stok_id'] ?>">
                          <i class="fa fa-trash"></i>
                        </button>
                        
                        <!-- modal hapus -->
                        <div class="modal fade" id="hapus_output_<?php echo $d['stok_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <a href="stok_hapus.php?id=<?php echo $d['stok_id'] ?>" class="btn btn-primary">Hapus</a>
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