<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Data Omset
      <small>pemasukan</small>
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
            <h3 class="box-title">Omset</h3>
            <div class="btn-group pull-right">            
              <a href="import_transaksi.php"><button type="button" class="btn btn-success btn-sm">
                <i class="fa fa-file-excel-o"></i> &nbsp Import Pemasukan
              </button></a>
              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Pemaasukan
              </button>
            </div>
          </div>
          <div class="box-body">

            <!-- Modal -->
            <form action="pemasukan_act.php" method="post" enctype="multipart/form-data">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="exampleModalLabel">Tambah Pemasukan</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Penjualan</label>
                        <input type="number" name="jual" required="required" class="form-control" placeholder="Masukkan Hasil Penjualan Hari Ini .." step="0.01" min="0">
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
                    <th width="1%" rowspan="2">NO</th>
                    <th width="10%" class="text-center" rowspan="2">TANGGAL</th>
                    <th width="20%" class="text-center" colspan="2">ODOMETER</th>
                    <th width="30%" class="text-center" colspan="3">SHIFT</th>
                    <th class="text-center" rowspan="2">HARGA</th>
                    <th class="text-center" rowspan="2">TOTAL</th>
                    <th width="10%" class="text-center" rowspan="2">OPSI</th>
                  </tr>
                  <tr>
                    <th class="text-center">MASUK</th>
                    <th class="text-center">KELUAR</th>
                    <th class="text-center">PAGI</th>
                    <th class="text-center">SIANG</th>
                    <th class="text-center">FULL DAY</th>
                  </tr>
                </thead>
                <tbody>
                  <?php   
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi, "SELECT * FROM out_pertashop order by output_tanggal desc");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo $d['output_tanggal']; ?></td>
                      <td class="text-center"><?php echo ($d['shift'] == "pagi") ? $d['output_jual'] . " liter" : "-"; ?></td>
                      <td class="text-center"><?php echo ($d['shift'] == "pagi") ? $d['output_jual'] . " liter" : "-"; ?></td>
                      <td class="text-center"><?php echo ($d['shift'] == "pagi") ? $d['output_jual'] . " liter" : "-"; ?></td>
                      <td class="text-center"><?php echo ($d['shift'] == "siang") ? $d['output_jual'] . " liter" : "-"; ?></td>
                      <td class="text-center"><?php echo ($d['shift'] == "fullday") ? $d['output_jual'] . " liter" : "-"; ?></td>

                      <td class="text-center"><?php echo "Rp. ".number_format($d['harga'])." ,-" ?></td>
                      <td class="text-center"><?php echo "Rp. ".number_format($d['output_total'])." ,-" ?></td>
                      <td class="text-center">    
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_output_<?php echo $d['output_id'] ?>">
                          <i class="fa fa-cog"></i>
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_output_<?php echo $d['output_id'] ?>">
                          <i class="fa fa-trash"></i>
                        </button>


                        <form action="pemasukan_update.php" method="post">
                          <div class="modal fade" id="edit_output_<?php echo $d['output_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="exampleModalLabel">Edit output</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Tanggal</label>
                                    <input type="hidden" name="id" value="<?php echo $d['output_id'] ?>">
                                    <input type="text" style="width:100%" name="tanggal" required="required" class="form-control datepicker2" value="<?php echo $d['output_tanggal'] ?>">
                                  </div>

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Penjualan </label>
                                    <input type="number" style="width:100%" name="jual" required="required" class="form-control" placeholder="Masukkan Hasil Penjualan hari ini .." value="<?php echo $d['output_jual']; ?>" step="0.01" min="0">
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
                        <div class="modal fade" id="hapus_output_<?php echo $d['output_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <a href="pemasukan_hapus.php?id=<?php echo $d['output_id'] ?>" class="btn btn-primary">Hapus</a>
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