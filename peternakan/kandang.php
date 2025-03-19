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
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Tambah Stok Masuk</h4>
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
                          include '../koneksi.php';
                          $kandang = mysqli_query($koneksi,"SELECT * FROM kandang ORDER BY id_kandang ASC");
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
                      <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>

            <?php if(isset($_GET['alert']) && $_GET['alert'] == "berhasil"){ ?>
              <div class="alert alert-success">Stok masuk berhasil ditambahkan!</div>
            <?php } ?>

            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Kandang</th>
                    <th style="background-color: #187498; color:rgb(255, 255, 255);">Stok Masuk</th>
                    <th style="background-color: #eb5353; color:rgb(255, 255, 255);">Terjual (Dewasa)</th>
                    <th style="background-color: #eb5353; color:rgb(255, 255, 255);">Terjual (Anakan)</th>
                    <th style="background-color: #eb5353; color:rgb(255, 255, 255);">Terjual Matang</th>
                    <th style="background-color: #36ae7c; color:rgb(255, 255, 255);">Sisa Stok</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $kandang = mysqli_query($koneksi, "SELECT * FROM kandang ORDER BY id_kandang ASC");
                while($k = mysqli_fetch_array($kandang)) {
                  $id_kandang = $k['id_kandang'];
                  $masuk = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jumlah) AS total_masuk FROM stok_kambing_masuk WHERE kandang='$id_kandang'"))['total_masuk'] ?? 0;
                  $terjual_dewasa = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jumlah) AS total FROM omset_peternakan WHERE kandang='$id_kandang' AND omset_kategori='81'"))['total'] ?? 0;
                  $terjual_anakan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jumlah) AS total FROM omset_peternakan WHERE kandang='$id_kandang' AND omset_kategori='84'"))['total'] ?? 0;
                  $matang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jumlah) AS total FROM omset_peternakan WHERE kandang='$id_kandang' AND omset_kategori='83'"))['total'] ?? 0;
                  $sisa = $masuk - ($terjual_dewasa + $terjual_anakan + $matang);
                ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $k['nama_kandang']; ?></td>
                  <td><?= $masuk; ?></td>
                  <td><?= $terjual_dewasa; ?></td>
                  <td><?= $terjual_anakan; ?></td>
                  <td><?= $matang; ?></td>
                  <td><?= $sisa; ?></td>
                </tr>
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

<script>
  $(document).ready(function(){
    $('#table-datatable').DataTable();
  });
</script>

<?php include 'footer.php'; ?>
