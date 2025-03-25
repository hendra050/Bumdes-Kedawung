<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pertashop - Sistem Informasi Manajemen Keuangan</title>
  <link rel="shortcut icon" href="/simk/gambar/sistem/logo-bumdes.png" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="../assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../assets/bower_components/morris.js/morris.css">
  <link rel="stylesheet" href="../assets/bower_components/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="../assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="../assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <?php
  include '../koneksi.php';
  session_start();
  if ($_SESSION['status'] != "peternakan_logedin") {
    header("location:../index.php?alert=belum_login");
  }
  ?>

</head>

<body class="hold-transition skin-blue sidebar-mini">

  <style>
    #table-datatable {
      width: 100% !important;
    }

    #table-datatable .sorting_disabled {
      border: 1px solid #f4f4f4;
    }

    .skin-blue .main-header .navbar {
      background-color:#5cb85c;
    }

    .skin-blue .main-header .logo {
      background-color:#4cae4c;
      color: #fff;
      border-bottom: 0 solid transparent;
    }
  </style>
  <div class="wrapper">

    <header class="main-header">
      <a href="index.php" class="logo">
        <span class="logo-mini"><b><i class="fa fa-money"></i></b> </span>
        <span class="logo-lg"><b>SIMK Peternakan</b></span>
      </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php
                $id_user = $_SESSION['id'];
                $profil = mysqli_query($koneksi, "select * from user where user_id='$id_user'");
                $profil = mysqli_fetch_assoc($profil);
                if ($profil['user_foto'] == "") {
                ?>
                  <img src="../gambar/sistem/user.png" class="user-image">
                <?php } else { ?>
                  <img src="../gambar/user/<?php echo $profil['user_foto'] ?>" class="user-image">
                <?php } ?>
                <span class="hidden-xs"><?php echo $_SESSION['nama']; ?> - <?php echo $_SESSION['level']; ?></span>
              </a>
            </li>
            <li>
              <a href="logout.php" onclick="return confirm('Apakah Anda yakin untuk logout?')">
                <i class="fa fa-sign-out"></i> LOGOUT
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <aside class="main-sidebar">
      <section class="sidebar">
        <div class="user-panel">
          <div class="pull-left image">
            <?php
            $id_user = $_SESSION['id'];
            $profil = mysqli_query($koneksi, "select * from user where user_id='$id_user'");
            $profil = mysqli_fetch_assoc($profil);
            if ($profil['user_foto'] == "") {
            ?>
              <img src="../gambar/sistem/user.png" class="img-circle">
            <?php } else { ?>
              <img src="../gambar/user/<?php echo $profil['user_foto'] ?>" class="img-circle" style="max-height:45px">
            <?php } ?>
          </div>
          <div class="pull-left info">
            <p><?php echo $_SESSION['nama']; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <li>
            <a href="index.php">
              <i class="fa fa-dashboard"></i> <span>DASHBOARD</span>
            </a>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-database"></i>
              <span>Stok Kambing</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="display: none;">
              <li>
                <a href="kandang.php">
                  <i class="fa fa-circle-o"> </i> <span>Stok Kambing</span>
                </a>
              </li>
              <li>
                <a href="riwayat_tambah_stok.php">
                  <i class="fa fa-circle-o"> </i> <span>Riwayat Tambah Stok</span>
                </a>
              </li>
              <li>
                <a href="tambah_kandang.php">
                  <i class="fa fa-circle-o"> </i> <span>Tambah Kandang</span>
                </a>
              </li>
            </ul>
          </li>

          <li>
            <a href="pemasukan.php">
              <i class="fa fa-circle-o"> </i> <span>Pemasukan</span>
            </a>
          </li>

          <li>
            <a href="pengeluaran.php">
              <i class="fa fa-circle-o"> </i> <span>Pengeluaran</span>
            </a>
          </li>
          
          <li>
            <a href="laporan_labarugi.php">
              <i class="fa fa-file"> </i> <span>Laporan Laba/Rugi</span>
            </a>
          </li>

          <li>
            <a href="laporan_stok.php">
              <i class="fa fa-file"> </i> <span>Laporan Stok</span>
            </a>
          </li>
          
          <li>
            <a href="gantipassword.php">
              <i class="fa fa-lock"></i> <span>Ganti Password</span>
            </a>
          </li>

        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>