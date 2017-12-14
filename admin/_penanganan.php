<?php session_start(); if (empty($_SESSION) && !isset($_SESSION['is_logged']) && ($_SESSION['type'] != 'admin')) header("location: signin.php");

if (!isset($_GET["id"]) OR $_GET["id"] == "") header("location: index.php");

require_once("../classes/Config.php");
$Conf = new Config(); $connection = $Conf->getConnection();

include("../classes/Penanganan.php");
$Penanganan = new Penanganan($connection);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Penanganan->id_aduan = $_GET["id"];
	$Penanganan->id_admin = $_SESSION["id"];
	$Penanganan->status = $_POST["status"];
	$Penanganan->stok = $_POST["stok"];
	$Penanganan->tanggal_pengerjaan = $_POST["tanggal_pengerjaan"];
    $Penanganan->catatan = $_POST["catatan"];
    if ($Penanganan->insert()) {
        header("location: index.php");
    } else {
        // Tampilkan alert failed
    }
}
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
    <?php include_once("include/header.php"); ?>

    <!-- Begin page content -->
    <main role="main" class="container">
        <form method="post">
            <div class="form-group">
                <label for="tanggal_pengerjaan">Tanggal pengerjaan</label>
                <input type="date" class="form-control" name="tanggal_pengerjaan" placeholder="Hari/Bulan/Tanggal">
            </div>
            <div class="form-group">
                <label for="catatan">Catatan</label>
                <textarea name="catatan" class="form-control" id="catatan" rows="3"></textarea>
            </div>
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-secondary">
                    <input type="radio" name="status" value="disetujui" autocomplete="off" checked> Disetujui
                </label>
                <label class="btn btn-secondary">
                    <input type="radio" name="status" value="tidak disetujui" autocomplete="off"> Tidak disetujui
                </label>
            </div>
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-secondary">
                    <input type="radio" name="stok" value="tersedia" autocomplete="off" checked> Tersedia
                </label>
                <label class="btn btn-secondary">
                    <input type="radio" name="stok" value="tidak tersedia" autocomplete="off"> Tidak Tersedia
                </label>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </main>

    <?php include_once("include/footer.php"); ?>

    <script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>