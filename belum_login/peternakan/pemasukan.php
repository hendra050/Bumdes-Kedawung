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
              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Pemaasukan
              </button>
            </div><br>
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
                              <label>BELUM LOGIN !!!r</label>
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
                  </tr>
                  
                </thead>
                <tbody>
                <?php   
                  include __DIR__ . '/../../koneksi.php';
                  $no = 1;
                  $src = "WHERE kategori_id = omset_kategori";
                    if (!empty($filter)) {
                        $current_date = date("Y-m-d");
                        if ($filter == "minggu") {
                            $src .= " AND output_tanggal >= DATE_SUB('$current_date', INTERVAL 1 WEEK)";
                        } elseif ($filter == "bulan") {
                            $src .= " AND output_tanggal >= DATE_SUB('$current_date', INTERVAL 1 MONTH)";
                        } elseif ($filter == "semester") {
                            $src .= " AND output_tanggal >= DATE_SUB('$current_date', INTERVAL 6 MONTH)";
                        } elseif ($filter == "tahun") {
                            $src .= " AND output_tanggal >= DATE_SUB('$current_date', INTERVAL 1 YEAR)";
                        }
                    }

                    if (isset($_GET['tanggal']) && !empty($_GET['tanggal'])) {
                        $tanggal = $_GET['tanggal'];
                        $src = "WHERE kategori_id = omset_kategori AND DATE(output_tanggal) = '$tanggal'";
                    }
                  
                    $data = mysqli_query($koneksi, "SELECT * FROM omset_peternakan, kategori_omset_peternakan $src ORDER BY output_tanggal DESC");
                    while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo $d['output_tanggal']; ?></td> 
                      <td class="text-center"><?php echo $d['kategori']; ?></td> 
                      <td class="text-center"><?php echo $d['jumlah']; ?></td>
                      <td class="text-center"><?php echo "Rp. " . number_format($d['harga']) . " ,-"; ?></td>
                      <td class="text-center"><?php echo "Rp. ".number_format($d['output_total'])." ,-" ?></td>
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