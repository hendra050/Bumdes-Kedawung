<?php include 'header.php'; ?>
<?php include '../koneksi.php'; ?>

<div class="content-wrapper">

<section class="content-header">
    <h1>
    LAPORAN PETERNAKAN
    <small>Laba Rugi & Stok</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Laporan Peternakan</li>
    </ol>
</section>

<section class="content">
    <div class="row">
    <section class="col-lg-12">
        <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">Filter Laporan</h3>
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
            <h3 class="box-title">Laporan Laba Rugi & Stok</h3>
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
                    <tr><th width="30%">DARI TANGGAL</th><th>:</th><td><?php echo $tgl_dari; ?></td></tr>
                    <tr><th>SAMPAI TANGGAL</th><th>:</th><td><?php echo $tgl_sampai; ?></td></tr>
                </table>
                </div>
            </div>

            <a href="laporan_peternakan_pdf.php?tanggal_dari=<?php echo $tgl_dari ?>&tanggal_sampai=<?php echo $tgl_sampai ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                <thead>
                    <tr><th colspan="5">LAPORAN LABA RUGI</th></tr>
                    <tr><th>No</th><th>Tanggal</th><th>Keterangan</th><th>Pemasukan</th><th>Pengeluaran</th></tr>
                </thead>
                <tbody>
                    <?php
                    $no=1;
                    $total_pemasukan=0;
                    $total_pengeluaran=0;
                    $query="
SELECT output_tanggal AS tanggal, NULL as keterangan, output_total AS pemasukan, 0 AS pengeluaran FROM omset_peternakan 
WHERE DATE(output_tanggal) BETWEEN '$tgl_dari' AND '$tgl_sampai'
UNION ALL
SELECT opex_tanggal AS tanggal, opex_keterangan AS keterangan, 0 AS pemasukan, opex_nominal AS pengeluaran FROM opex_peternakan 
WHERE DATE(opex_tanggal) BETWEEN '$tgl_dari' AND '$tgl_sampai'
ORDER BY tanggal ASC
";

                    $data=mysqli_query($koneksi, $query);
                    while($d=mysqli_fetch_array($data)){
                    echo "<tr>
                        <td>$no</td>
                        <td>".date('d-m-Y',strtotime($d['tanggal']))."</td>
                        <td>{$d['keterangan']}</td>
                        <td class='text-success text-right'>".($d['pemasukan'] ? "Rp. ".number_format($d['pemasukan']) : "-")."</td>
                        <td class='text-danger text-right'>".($d['pengeluaran'] ? "Rp. ".number_format($d['pengeluaran']) : "-")."</td>
                    </tr>";
                    $total_pemasukan += $d['pemasukan'];
                    $total_pengeluaran += $d['pengeluaran'];
                    $no++;
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr><th colspan="3">TOTAL</th>
                    <th class="text-success text-right">Rp. <?php echo number_format($total_pemasukan); ?></th>
                    <th class="text-danger text-right">Rp. <?php echo number_format($total_pengeluaran); ?></th></tr>
                    <tr><th colspan="3">LABA BERSIH</th>
                    <th colspan="2" class="text-center bg-primary text-white">Rp. <?php echo number_format($total_pemasukan - $total_pengeluaran); ?></th></tr>
                </tfoot>
                </table>
            </div>

            <!-- <div class="table-responsive">
                <table class="table table-bordered table-striped">
                <thead>
                    <tr><th colspan="4">LAPORAN STOK KAMBING</th></tr>
                    <tr><th>No</th><th>Jenis</th><th>Total Masuk</th><th>Total Keluar</th></tr>
                </thead>
                <tbody>
                    <?php
                    $jenis_kambing = ["Dewasa" => 81, "Anakan" => 84, "Matang" => 83];
                    $no=1;
                    foreach($jenis_kambing as $nama=>$id){
                    $masuk = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT SUM(jumlah) as total FROM stok_kambing_masuk WHERE kandang=$id AND tanggal BETWEEN '$tgl_dari' AND '$tgl_sampai'"));
                    $keluar = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT SUM(jumlah) as total FROM omset_peternakan WHERE omset_kategori=$id AND output_tanggal BETWEEN '$tgl_dari' AND '$tgl_sampai'"));
                    echo "<tr>
                        <td>$no</td>
                        <td>$nama</td>
                        <td>{$masuk['total']}</td>
                        <td>{$keluar['total']}</td>
                    </tr>";
                    $no++;
                    }
                    ?>
                </tbody>
                </table>
            </div> -->
            <?php } else { ?>
            <div class="alert alert-info text-center">Silahkan Filter Laporan Terlebih Dulu.</div>
            <?php } ?>
        </div>
        </div>
    </section>
    </div>
</section>
</div>
<?php include 'footer.php'; ?>
