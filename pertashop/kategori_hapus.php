<?php 
include '../koneksi.php';
$id  = $_GET['id'];

mysqli_query($koneksi, "update transaksi set opex_kategori='1' where opex_kategori='$id'");

mysqli_query($koneksi, "delete from kategori_pertashop where kategori_id='$id'");
header("location:kategori.php");