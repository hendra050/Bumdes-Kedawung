<?php include __DIR__ . '/../header.php'; ?>

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
                              <!-- Input jumlah penjualan -->
                              <div class="form-group">
                                  <label>Jumlah /Ekor</label>
                                  <input type="number" name="jumlah" required="required" class="form-control" 
                                        placeholder="Masukkan Jumlah Penjualan Hari Ini .." step="0.01" min="0">
                              </div>

                              <div class="form-group">
                                  <label>Harga</label>
                                  <input type="number" name="harga" required="required" class="form-control" 
                                        placeholder="Masukkan Hasil Penjualan Hari Ini .." step="0.01" min="0">
                              </div>

                              <!-- Input kategori dengan select dropdown -->
                              <div class="form-group">
                                  <label>Kategori</label>
                                  <select name="kategori" class="form-control" required>
                                      <option value="">-- Pilih Kategori --</option>
                                      <?php
                                      include '../../koneksi.php';
                                      $kategori_query = mysqli_query($koneksi, "SELECT * FROM kategori_omset_peternakan ORDER BY kategori asc");
                                      while ($row = mysqli_fetch_assoc($kategori_query)) {
                                          echo "<option value='".$row['kategori_id']."'>".$row['kategori']."</option>";
                                      }
                                      ?>
                                  </select>
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
                    <th width="10%" class="text-center" >TANGGAL</th>
                    <th width="20%" class="text-center" >KATEGORI</th>
                    <th width="10%" class="text-center" >JUMLAH</th>
                    <th width="20%" class="text-center" >HARGA</th>
                    <th width="20%" class="text-center" >TOTAL HARGA</th>
                    <th width="5%" class="text-center">OPSI</th>
                  </tr>
                  
                </thead>
                <tbody>
                  <?php   
                  include '../../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi, "SELECT * FROM omset_peternakan, kategori_omset_peternakan WHERE kategori_id= omset_kategori order by output_tanggal desc");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo $d['output_tanggal']; ?></td> 
                      <td class="text-center"><?php echo $d['kategori']; ?></td> 
                      <td class="text-center"><?php echo $d['jumlah']; ?></td>
                      <td class="text-center"><?php echo "Rp. " . number_format($d['harga']) . " ,-"; ?></td>
                      <td class="text-center">
                                              <?php echo isset($d['output_total']) ? "Rp. " . number_format($d['output_total']) . " ,-"
                                                  : "Data tidak tersedia";
                                              ?>
                                          </td>
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
                                    <input type="number" style="width:100%" name="jual" required="required" class="form-control" placeholder="Masukkan Hasil Penjualan hari ini .." value="<?php echo $d['output_total']; ?>" step="0.01" min="0">
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
<?php include __DIR__ . '/../footer.php'; ?>