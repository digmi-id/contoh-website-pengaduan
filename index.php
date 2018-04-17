<?php session_start(); if (empty($_SESSION) && !isset($_SESSION['is_logged'])) header("location: signin.php");

require_once("classes/Config.php");
$Conf = new Config(); $connection = $Conf->getConnection();

include("classes/Pengaduan.php");
$Pengaduan = new Pengaduan($connection);

include("classes/Penanganan.php");
$Penanganan = new Penanganan($connection);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/images/logo.png">
    <title>Home | Pengaduan IT</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <link href="assets/css/open-iconic-bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include_once("include/header.php"); ?>

    <!-- Begin page content -->
    <main role="main" class="container">
        <?php if ($Pengaduan->rowCountByUser($_SESSION["id"])): ?>
            <div class="card-deck">
                <?php $rows = $Pengaduan->readByUser($_SESSION["id"]); while ($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
                    <?php
                        if ($Penanganan->getStatus($row["id"])) {
                            $status_color = "primary";
                        } else {
                            $status_color = "danger";
                        }
                    ?>
                        <div class="card border-<?php echo $status_color; ?>">
                            <img class="card-img-top" height="230" src="assets/images/pengaduan/<?php echo $row["gambar"]; ?>">
                            <div class="card-body text-<?php echo $status_color; ?>">
                                <p class="card-text">
                                    <small class="text-muted"><?php echo $row["lokasi"]; ?> - <?php echo $row["tanggal"]; ?></small><br>
                                    <?php echo $row["masalah"]; ?>
                                </p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><?php echo $row["jenis"]; ?></li>
                            </ul>
                            <div class="card-footer text-muted">
                                <?php echo ($Penanganan->getStatus($row["id"])) ? "Disetujui"   : "Proses"; ?>
                            </div>
                        </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info" role="alert">
                Belum ada pengaduan dibuat.
            </div>
        <?php endif; ?>
    </main>

    <?php include_once("include/footer.php"); ?>

    <script src="assets/js/jquery-3.2.1.slim.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>