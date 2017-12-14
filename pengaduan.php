<?php session_start(); if (empty($_SESSION) && !isset($_SESSION['is_logged'])) header("location: signin.php");

require_once("classes/Config.php");
$Conf = new Config(); $connection = $Conf->getConnection();

include("classes/Pengaduan.php");
$Pengaduan = new Pengaduan($connection);

include("classes/Bagian.php");
$Bagian = new Bagian($connection);

include("classes/Jenis.php");
$Jenis = new Jenis($connection);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Pengaduan->id_bagian = $_POST["bagian"];
	$Pengaduan->id_jenis = $_POST["jenis"];
	$Pengaduan->id_user = $_SESSION["id"];
	$Pengaduan->lokasi = $_POST["lokasi"];
	$Pengaduan->masalah = $_POST["masalah"];
    if ($Pengaduan->insert()) {
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
    <link rel="icon" href="/assets/images/logo.jpg">
    <title>Pengaduan | Pengaduan IT</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
</head>

<body>
    <?php include_once("include/header.php"); ?>

    <!-- Begin page content -->
    <main role="main" class="container">
        <form method="post">
            <div class="form-group">
                <label for="bagian">Bagian</label>
                <select name="bagian" class="form-control" id="bagian">
                    <option selected="on">-- Pilih Bagian --</option>
                    <?php $rows = $Bagian->readAll(); while ($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?php echo $row["id"]; ?>"><?php echo $row["nama"]; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="jenis">Jenis Perbaikan</label>
                <select name="jenis" class="form-control" id="jenis">
                    <option selected="on">-- Pilih Jenis Perbaikan --</option>
                    <?php $rows = $Jenis->readAll(); while ($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?php echo $row["id"]; ?>"><?php echo $row["nama"]; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="lokasi">Lokasi</label>
                <input name="lokasi" type="text" class="form-control" id="lokasi" placeholder="Lokasi">
            </div>
            <div class="form-group">
                <label for="masalah">Masalah</label>
                <textarea name="masalah" class="form-control" id="masalah" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
    </main>

    <?php include_once("include/footer.php"); ?>

    <script src="assets/js/jquery-3.2.1.slim.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>