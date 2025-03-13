<?php
require('../library/fpdf181/fpdf.php');
include '../koneksi.php'; 

$tgl_dari = $_GET['tanggal_dari'];
$tgl_sampai = $_GET['tanggal_sampai'];

$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(280, 7, 'BUMDES SIDOMUKTI', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(280, 7, 'LAPORAN STOK PERTASHOP', 0, 1, 'C');

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

// Header Tabel
$pdf->Cell(10, 10, 'NO', 1, 0, 'C');
$pdf->Cell(40, 10, 'TANGGAL', 1, 0, 'C');
$pdf->Cell(45, 10, 'STOK AWAL', 1, 0, 'C');
$pdf->Cell(45, 10, 'STOK MASUK', 1, 0, 'C');
$pdf->Cell(45, 10, 'STOK KELUAR', 1, 0, 'C');
$pdf->Cell(45, 10, 'STOK SISA', 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);

// Data Tabel
$no = 1;
$total_masuk = 0;
$total_keluar = 0;

$query = "SELECT tanggal_masuk AS tanggal, stok_awal, stok_masuk, stok_keluar, stok_sisa 
          FROM stok_pertashop
          WHERE DATE(tanggal_masuk) BETWEEN '$tgl_dari' AND '$tgl_sampai'
          ORDER BY tanggal DESC";

$result = mysqli_query($koneksi, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(10, 8, $no++, 1, 0, 'C');
    $pdf->Cell(40, 8, date('d-m-Y H:i:s', strtotime($row['tanggal'])), 1, 0, 'C');
    $pdf->Cell(45, 8, $row['stok_awal'], 1, 0, 'C');
    $pdf->Cell(45, 8, $row['stok_masuk'], 1, 0, 'C');
    $pdf->Cell(45, 8, $row['stok_keluar'], 1, 0, 'C');
    $pdf->Cell(45, 8, $row['stok_sisa'], 1, 1, 'C');

    $total_masuk += $row['stok_masuk'];
    $total_keluar += $row['stok_keluar'];
}

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(95, 8, 'TOTAL', 1, 0, 'R');
$pdf->Cell(45, 8, number_format($total_masuk), 1, 0, 'C');
$pdf->Cell(45, 8, number_format($total_keluar), 1, 0, 'C');
$pdf->Cell(45, 8, '', 1, 1); 

// $pdf->Cell(95, 8, 'LABA BERSIH', 1, 0, 'R');
// $pdf->Cell(90, 8, number_format($total_masuk - $total_keluar), 1, 1, 'C');

$pdf->Output();
?>
