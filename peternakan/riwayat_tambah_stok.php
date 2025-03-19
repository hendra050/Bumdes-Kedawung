<?php include 'header.php'; ?>

<div class="content-wrapper">

<section class="content-header">
    <h1>
    Data Stok
    <small>Riwayat Stok Kambing</small>
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
            <h3 class="box-title">Tambah Stok</h3>
            <div class="btn-group pull-right">            
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
            <div class="table-responsive">
            <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                    <tr>
                        <th width="1%" rowspan="2">NO</th>
                        <th width="10%" class="text-center" >TANGGAL</th>
                        <th width="10%" class="text-center" >KANDANG</th>
                        <th width="10%" class="text-center" >JUMLAH / Ekor</th>
                        <th width="20%" class="text-center" >KETERANGAN</th>
                        <th width="5%" class="text-center">OPSI</th>
                    </tr>
                </thead>
                <tbody>
                <?php   
                include '../koneksi.php';
                $no=1;
                $stok = mysqli_query($koneksi, "SELECT stok_kambing_masuk.*, kandang.nama_kandang 
                        FROM stok_kambing_masuk 
                        JOIN kandang ON stok_kambing_masuk.kandang = kandang.id_kandang
                        ORDER BY stok_kambing_masuk.tanggal DESC");
                while($s = mysqli_fetch_array($stok)){
                    ?>
                    <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $s['tanggal']; ?></td>
                    <td><?= $s['nama_kandang']; ?></td>
                    <td><?= $s['jumlah']; ?></td>
                    <td><?= $s['keterangan']; ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEdit<?= $s['id_stok']; ?>"><i class="fa fa-pencil"></i></button>
                        <a href="stok_kambing_hapus.php?id=<?= $s['id_stok']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')"><i class="fa fa-trash"></i></a>
                    </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit<?= $s['id_stok']; ?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <form action="stok_kambing_edit.php" method="post">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Edit Stok Masuk</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $s['id_stok']; ?>">
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
                                <label>Jumlah</label>
                                <input type="number" class="form-control" name="jumlah" value="<?= $s['jumlah']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea class="form-control" name="keterangan"><?= $s['keterangan']; ?></textarea>
                            </div>
                            </div>
                            <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    </div>
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