<?php include 'header.php'; ?>
<?php include '../koneksi.php'; ?>

<div class="content-wrapper">

<section class="content-header">
    <h1>
    LAPORAN STOK
    <small>Data Laporan Stok</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Laporan Stok</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <section class="col-lg-12">
            <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Filter Laporan Stok</h3>
            </div>
            <div class="box-body">
                <form method="get" action="">
                <div class="row">
                    <div class="col-md-3">
                    <div class="form-group">
                        <label>Mulai Tanggal</label>
                        <input type="date" name="tanggal_dari" class="form-control" required>
                    </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                        <label>Sampai Tanggal</label>
                        <input type="date" name="tanggal_sampai" class="form-control" required>
                    </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                        <br/>
                        <input type="submit" value="TAMPILKAN" class="btn btn-sm btn-primary btn-block">
                    </div>
                    </div>
                </div>
                </form>
            </div>
            </div>

            <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Laporan Stok Pertashop</h3>
            </div>
                <div class="box-body">
                    <?php 
                    if(isset($_GET['tanggal_dari']) && isset($_GET['tanggal_sampai'])){
                    $tgl_dari = $_GET['tanggal_dari'];
                    $tgl_sampai = $_GET['tanggal_sampai'];
                    ?>

                    <div class="row">
                        <div class="col-lg-6">
                            <table class="table table-bordered">
                                <tr>
                                <th width="30%">DARI TANGGAL</th>
                                <th width="1%">:</th>
                                <td><?php echo $tgl_dari; ?></td>
                                </tr>
                                <tr>
                                <th>SAMPAI TANGGAL</th>
                                <th>:</th>
                                <td><?php echo $tgl_sampai; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <a href="laporan_pdf_stok.php?tanggal_dari=<?php echo $tgl_dari ?>&tanggal_sampai=<?php echo $tgl_sampai ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>

                    <br/><br/>

                    <div class="table-responsive">
                    <table class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th colspan="4">LAPORAN STOK KAMBING</th>
                            </tr>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Kandang</th>
                                
                                <th class="text-center" style="background-color: #187498; color:rgb(255, 255, 255);">Stok Masuk</th>
                                <th class="text-center" style="background-color: #eb5353; color:rgb(255, 255, 255);">Terjual (Dewasa)</th>
                                <th class="text-center" style="background-color: #eb5353; color:rgb(255, 255, 255);">Terjual (Anakan)</th>
                                <th class="text-center" style="background-color: #eb5353; color:rgb(255, 255, 255);">Terjual Matang</th>
                                <th class="text-center" style="background-color: #36ae7c; color:rgb(255, 255, 255);">Sisa Stok</th>
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
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $k['nama_kandang']; ?></td>
                                <td class="text-center"><?= $masuk . ' Ekor'; ?></td>
                                <td class="text-center"><?= $terjual_dewasa . ' Ekor'; ?></td>
                                <td class="text-center"><?= $terjual_anakan . ' Ekor'; ?></td>
                                <td class="text-center"><?= $matang . ' Ekor'; ?></td>
                                <td class="text-center"><?= $sisa . ' Ekor'; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="table-datatable">
                            <thead>
                                <tr>
                                    <th colspan="4">LAPORAN DETAIL PENJUALAN STOK KAMBING</th>
                                </tr>
                                <tr>
                                    <th class="text-center" width="1%" rowspan="2">NO</th>
                                    <th width="10%" class="text-center" rowspan="2" >TANGGAL</th>
                                    <th width="10%" class="text-center" rowspan="2" >KATEGORI</th>
                                    <th width="10%" class="text-center" rowspan="2" >KANDANG</th>
                                    <th width="25%" class="text-center" colspan="2" >JUMLAH / Ekor</th>
                                </tr>
                                <tr>
                                    <th class="text-center" style="background-color: #eb5353; color:rgb(255, 255, 255);">MASUK</th>
                                    <th class="text-center" style="background-color: #36ae7c; color:rgb(255, 255, 255);">KELUAR</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php   
                                include '../koneksi.php';
                                $no=1;
                                $stok = mysqli_query($koneksi, "
                                    SELECT 
                                        stok_kambing_masuk.tanggal AS tanggal, 
                                        NULL AS kategori, 
                                        kandang.nama_kandang AS kandang, 
                                        stok_kambing_masuk.jumlah AS pemasukan,
                                        0 AS pengeluaran 
                                    FROM stok_kambing_masuk
                                    LEFT JOIN kandang ON stok_kambing_masuk.kandang = kandang.id_kandang

                                    UNION ALL

                                    SELECT 
                                        omset_peternakan.output_tanggal AS tanggal, 
                                        kategori_omset_peternakan.kategori AS kategori, 
                                        kandang.nama_kandang AS kandang, 
                                        0 AS pemasukan,
                                        omset_peternakan.jumlah AS pengeluaran 
                                    FROM omset_peternakan
                                    LEFT JOIN kategori_omset_peternakan ON omset_peternakan.omset_kategori = kategori_omset_peternakan.kategori_id
                                    LEFT JOIN kandang ON omset_peternakan.kandang = kandang.id_kandang

                                    ORDER BY tanggal ASC
                                ");
                                while($s = mysqli_fetch_array($stok)){
                                    ?>
                                    <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td class="text-center"><?= $s['tanggal']; ?></td>
                                    <td><?= $s['kategori'] ? $s['kategori'] : '-'; ?></td>
                                    <td><?= $s['kandang']; ?></td>
                                    <td class="text-center"><?= $s['pemasukan'] ? $s['pemasukan'] . ' Ekor' : '-'; ?></td>
                                    <td class="text-center"><?= $s['pengeluaran'] ? $s['pengeluaran'] . ' Ekor': '-'; ?></td>
                                    <?php 
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    } else {
                    ?>
                    <div class="alert alert-info text-center">
                        Silakan filter laporan terlebih dahulu.
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </section>
    </div>
</section>

</div>
<?php include 'footer.php'; ?>
