<?php session_start(); if (empty($_SESSION) && !isset($_SESSION['is_logged']) && ($_SESSION['type'] != 'admin')) header("location: signin.php");

require_once("../classes/Config.php");
$Conf = new Config(); $connection = $Conf->getConnection();

include("../classes/Pengaduan.php");
$Pengaduan = new Pengaduan($connection);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
    <title>Admin | Web Pengaduan</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="../assets/css/custom.css" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark justify-content-between">
            <div class="container">
            
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item ">
                            <a class="nav-link" href="index.php">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="bagian.php">Bagian</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="Penanganan.php">Penanganan</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle btn btn-danger" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Profil</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="signout.php">Keluar</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main role="main" class="container" style="margin-top: 50px;">
        <form>
     <div class="form-group col-md-6">
    <label for="">Status</label>
    <div class="form-group col-md-6">
    <label class="custom-control custom-checkbox">
    <input id="checkbox" name="radio" type="radio" class="custom-control-input">
    <span class="custom-control-indicator"></span>
    <span class="custom-control-description">Disetujui</span>
  </label>
  <label class="custom-control custom-checkbox">
    <input id="checkbox" name="radio" type="radio" class="custom-control-input">
    <span class="custom-control-indicator"></span>
    <span class="custom-control-description">Tidak disetujui</span>
  </label>
  </div>
    </div>
  <fieldset class="form-group">
    <div class="row">
    <div class="form-group col-md-7">
      <legend class="col-form-legend col-sm-2">Stok</legend>
      <div class="col-sm-10">
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
            Tersedia
          </label>
        </div>
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
            Tidak tersedia
          </label>
        </div>
        
        </div>
      </div>
    </div>
   </div>
    <div class="form-group col-md-6">
      <label for="">Tanggal pengerjaan</label>
      <input type="date" class="form-control" id="" placeholder="Hari,Bulan,Tanggal">
    </div>
    <div class="form-group">
      <div class="form-group col-md-6">
        <label for="">Catatan</label>
        <textarea class="form-control" id="" rows="3"></textarea>
    </div>
    <div class="form-group col-md-6">
    <button type="submit" class="btn btn-primary">Kirim</button>
    </div>
    </form>
    </body>
    </html>