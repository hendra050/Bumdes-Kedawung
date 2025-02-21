<?php
// Memanggil library FPDF
require('../library/fpdf181/fpdf.php');
include '../koneksi.php'; 

$tgl_dari = $_GET['tanggal_dari'];
$tgl_sampai = $_GET['tanggal_sampai'];

// Instance object dan pengaturan halaman PDF
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(280, 7, 'BUMDES SIDOMUKTI', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(280, 7, 'LAPORAN LABA RUGI', 0, 1, 'C');

// Space kebawah
$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(35, 6, 'DARI TANGGAL', 0, 0);
$pdf->Cell(5, 6, ':', 0, 0);
$pdf->Cell(35, 6, date('d-m-Y', strtotime($tgl_dari)), 0, 0);
$pdf->Cell(10, 7, '', 0, 1);
$pdf->Cell(35, 6, 'SAMPAI TANGGAL', 0, 0);
$pdf->Cell(5, 6, ':', 0, 0);
$pdf->Cell(35, 6, date('d-m-Y', strtotime($tgl_sampai)), 0, 1);

$pdf->Cell(10, 10, '', 0, 1);
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(10, 14, 'NO', 1, 0, 'C');
$pdf->Cell(35, 14, 'TANGGAL', 1, 0, 'C');
$pdf->Cell(45, 14, 'KATEGORI', 1, 0, 'C');
$pdf->Cell(80, 14, 'KETERANGAN', 1, 0, 'C');

$pdf->Cell(82, 7, 'JENIS', 1, 0, 'C');
$pdf->Cell(1, 7, '', 0, 1);
$pdf->Cell(170, 7, '', 0, 0);
$pdf->Cell(41, 7, 'PEMASUKAN', 1, 0, 'C');
$pdf->Cell(41, 7, 'PENGELUARAN', 1, 1, 'C');

$pdf->Cell(10, 0, '', 0, 1);
$pdf->SetFont('Arial', '', 10);

$no = 1;
$total_pemasukan = 0;
$total_pengeluaran = 0;

$query = "
    SELECT output_tanggal AS tanggal, NULL AS kategori, NULL AS keterangan, output_total AS pemasukan, 0 AS pengeluaran
    FROM omset_pertashop
    WHERE output_tanggal BETWEEN '$tgl_dari' AND '$tgl_sampai'
    UNION ALL
    SELECT opex_pertashop.opex_tanggal AS tanggal, kategori_pertashop.kategori AS kategori, 
        opex_pertashop.opex_keterangan AS keterangan, 0 AS pemasukan, opex_pertashop.opex_nominal AS pengeluaran
    FROM opex_pertashop
    JOIN kategori_pertashop ON opex_pertashop.opex_kategori = kategori_pertashop.kategori_id
    WHERE opex_pertashop.opex_tanggal BETWEEN '$tgl_dari' AND '$tgl_sampai'
    ORDER BY tanggal ASC;
";
$result = mysqli_query($koneksi, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(10, 7, $no++, 1, 0, 'C');
    $pdf->Cell(35, 7, date('d-m-Y', strtotime($row['tanggal'])), 1, 0, 'C');
    $pdf->Cell(45, 7, ($row['kategori'] ?? '-'), 1, 0, 'L');
    $pdf->Cell(80, 7, ($row['keterangan'] ?? '-'), 1, 0, 'L');

    $pemasukan = $row['pemasukan'] > 0 ? "Rp. " . number_format($row['pemasukan']) . " ,-" : "-";
    $pengeluaran = $row['pengeluaran'] > 0 ? "Rp. " . number_format($row['pengeluaran']) . " ,-" : "-";

    $pdf->Cell(41, 7, $pemasukan, 1, 0, 'R');
    $pdf->Cell(41, 7, $pengeluaran, 1, 1, 'R');

    $total_pemasukan += $row['pemasukan'];
    $total_pengeluaran += $row['pengeluaran'];
}

$saldo = $total_pemasukan - $total_pengeluaran;

$pdf->Cell(170, 7, 'TOTAL', 1, 0, 'R');
$pdf->Cell(41, 7, "Rp. " . number_format($total_pemasukan) . " ,-", 1, 0, 'R');
$pdf->Cell(41, 7, "Rp. " . number_format($total_pengeluaran) . " ,-", 1, 1, 'R');

$pdf->Cell(170, 7, 'SALDO', 1, 0, 'R');
$pdf->Cell(82, 7, "Rp. " . number_format($saldo) . " ,-", 1, 0, 'C');

$pdf->Output(); 
?>
