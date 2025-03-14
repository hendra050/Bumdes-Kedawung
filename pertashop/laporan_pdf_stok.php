<?php
require('../library/fpdf181/fpdf.php');
include '../koneksi.php';

// Ambil parameter tanggal
$tgl_dari = $_GET['tanggal_dari'];
$tgl_sampai = $_GET['tanggal_sampai'];

// Buat objek PDF
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();

// Header
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(280, 7, 'BUMDES SIDOMUKTI', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'LAPORAN STOK PERTASHOP', 0, 1, 'C');

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, "Periode: " . date('d-m-Y', strtotime($tgl_dari)) . " s/d " . date('d-m-Y', strtotime($tgl_sampai)), 0, 1, 'C');
$pdf->Ln(5);

// Table Header
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(200, 220, 255);

$pdf->Cell(30, 10, 'Tanggal', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Stok Awal', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Stok Masuk', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Stok Keluar', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Stok Sisa', 1, 0, 'C', true);
$pdf->Cell(25, 10, 'Manual Awal', 1, 0, 'C', true);
$pdf->Cell(25, 10, 'Manual Akhir', 1, 0, 'C', true);
$pdf->Cell(25, 10, 'Manual Sisa', 1, 0, 'C', true);
$pdf->Cell(25, 10, 'Penguapan', 1, 1, 'C', true);

// Isi Data
$pdf->SetFont('Arial', '', 10);
$query = mysqli_query($koneksi, "SELECT * FROM stok_pertashop WHERE DATE(tanggal_masuk) BETWEEN '$tgl_dari' AND '$tgl_sampai' ORDER BY tanggal_masuk ASC");

while($d = mysqli_fetch_array($query)){
    $pdf->Cell(30, 10, date('d-m-Y', strtotime($d['tanggal_masuk'])), 1, 0, 'C');
    $pdf->Cell(30, 10, $d['stok_awal']." L", 1, 0, 'C');
    $pdf->Cell(30, 10, $d['stok_masuk']." L", 1, 0, 'C');
    $pdf->Cell(30, 10, $d['stok_keluar']." L", 1, 0, 'C');
    $pdf->Cell(30, 10, $d['stok_sisa']." L", 1, 0, 'C');
    $pdf->Cell(25, 10, $d['manual_awal'], 1, 0, 'C');
    $pdf->Cell(25, 10, $d['manual_akhir'], 1, 0, 'C');
    $pdf->Cell(25, 10, $d['manual_selisih'], 1, 0, 'C');
    $pdf->Cell(25, 10, $d['penguapan'], 1, 1, 'C');
}

$pdf->Output('I', 'laporan_stok_pertashop.pdf');
?>
