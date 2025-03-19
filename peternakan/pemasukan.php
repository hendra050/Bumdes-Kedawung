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

              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Pemaasukan
              </button>
            </div><br><br>
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

                              <div class="form-group">
                                  <label>Kategori</label>
                                  <select name="kategori" class="form-control" required>
                                      <option value="">-- Pilih Kategori --</option>
                                      <?php
                                      include '../koneksi.php';
                                      $kategori_query = mysqli_query($koneksi, "SELECT * FROM kategori_omset_peternakan ORDER BY kategori asc");
                                      while ($row = mysqli_fetch_assoc($kategori_query)) {
                                          echo "<option value='".$row['kategori_id']."'>".$row['kategori']."</option>";
                                      }
                                      ?>
                                  </select>
                              </div>

                              <div class="form-group">
                                  <label>Dari Kandang</label>
                                  <select name="kandang" class="form-control" required>
                                      <option value="">-- Pilih Kandang --</option>
                                      <?php
                                      include '../koneksi.php';
                                      $kandang_query = mysqli_query($koneksi, "SELECT * FROM kandang ORDER BY id_kandang asc");
                                      while ($row = mysqli_fetch_assoc($kandang_query)) {
                                          echo "<option value='".$row['id_kandang']."'>".$row['nama_kandang']."</option>";
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
                    <th width="10%" class="text-center" >JUMLAH / Ekor</th>
                    <th width="20%" class="text-center" >HARGA / Ekor</th>
                    <th width="20%" class="text-center" >TOTAL HARGA</th>
                    <th width="10%" class="text-center" >KANDANG</th>
                    <th width="10%" class="text-center">OPSI</th>
                  </tr>
                  
                </thead>
                <tbody>
                  <?php   
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi, "SELECT * FROM omset_peternakan 
                  LEFT JOIN kategori_omset_peternakan ON kategori_id = omset_kategori 
                  LEFT JOIN kandang ON kandang.id_kandang = omset_peternakan.kandang 
                  ORDER BY output_tanggal DESC");
                  
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo $d['output_tanggal']; ?></td> 
                      <td class="text-center"><?php echo $d['kategori']; ?></td> 
                      <td class="text-center"><?php echo $d['jumlah']; ?></td>
                      <td class="text-center"><?php echo "Rp. " . number_format($d['harga']) . " ,-"; ?></td>
                      <td class="text-center"><?php echo isset($d['output_total']) ? "Rp. " . number_format($d['output_total']) . " ,-": "Data tidak tersedia";?></td>
                      <td class="text-center"><?php echo $d['nama_kandang']; ?></td>
                      <td class="text-center">    
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_output_<?php echo $d['output_id'] ?>">
                              <i class="fa fa-cog"></i>
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_output_<?php echo $d['output_id'] ?>">
                          <i class="fa fa-trash"></i>
                        </button>
                        
                        <!-- Modal Edit -->
                        <form action="pemasukan_update.php" method="post">
                          <div class="modal fade" id="edit_output_<?php echo $d['output_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="exampleModalLabel">Edit Pemasukan</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <input type="hidden" name="id" value="<?php echo $d['output_id']; ?>">

                                  <!-- Input Jumlah -->
                                  <div class="form-group">
                                    <label>Jumlah /Ekor</label>
                                    <input type="number" name="jumlah" required class="form-control" step="0.01" min="0" value="<?php echo $d['jumlah']; ?>">
                                  </div>

                                  <!-- Input Harga -->
                                  <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" name="harga" required class="form-control" step="0.01" min="0" value="<?php echo $d['harga']; ?>">
                                  </div>

                                  <!-- Select Kategori -->
                                  <div class="form-group">
                                    <label>Kategori</label>
                                    <select name="kategori" class="form-control" required>
                                      <option value="">-- Pilih Kategori --</option>
                                      <?php
                                      $kategori_query = mysqli_query($koneksi, "SELECT * FROM kategori_omset_peternakan ORDER BY kategori asc");
                                      while ($k = mysqli_fetch_assoc($kategori_query)) {
                                        $selected = $k['kategori_id'] == $d['omset_kategori'] ? "selected" : "";
                                        echo "<option value='".$k['kategori_id']."' $selected>".$k['kategori']."</option>";
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