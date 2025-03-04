<?php 
session_start();
session_unset(); // Hapus semua session sebelumnya
session_destroy(); // Hancurkan sesi lama

header("location:../index.php?alert=logout");
exit();
?>