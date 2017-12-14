<?php session_start(); if (empty($_SESSION) && !isset($_SESSION['is_logged'])) header("location: signin.php");

require_once("classes/Config.php");
$Conf = new Config(); $connection = $Conf->getConnection();

include("classes/Pengaduan.php");
$Pengaduan = new Pengaduan($connection);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/assets/images/logo.jpg">
    <title>Home | Pengaduan IT</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
</head>

<body>
    <?php include_once("include/header.php"); ?>

    <!-- Begin page content -->
    <main role="main" class="container">
        <div class="list-group">
            <?php $rows = $Pengaduan->readByUser($_SESSION["id"]); while ($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?php echo $row["jenis"]; ?></h5>
                        <small><?php echo $row["tanggal"]; ?></small>
                    </div>
                    <p class="mb-1"><?php echo $row["masalah"]; ?></p>
                    <small><?php echo $row["lokasi"]; ?></small>
                </a>
            <?php endwhile; ?>
        </div>
    </main>

    <?php include_once("include/footer.php"); ?>

    <script src="assets/js/jquery-3.2.1.slim.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>