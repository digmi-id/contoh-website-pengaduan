<?php session_start(); if (empty($_SESSION) && !isset($_SESSION['is_logged']) && ($_SESSION['type'] != 'admin')) header("location: signin.php");

if (!isset($_GET["id"]) OR $_GET["id"] == "") header("location: index.php");

require_once("../classes/Config.php");
$Conf = new Config(); $connection = $Conf->getConnection();

include("../classes/Penanganan.php");
$Penanganan = new Penanganan($connection);

include("../classes/Pengaduan.php");
$Pengaduan = new Pengaduan($connection);

if ($_POST) {
    if ($Penanganan->rowCountById($_GET['id'])) {
        $Penanganan->id_aduan = $_GET["id"];
        $Penanganan->id_admin = $_SESSION["id"];
        $Penanganan->status = $_POST["status"];
        $Penanganan->stok = $_POST["stok"];
        $Penanganan->tanggal_pengerjaan = $_POST["tanggal_pengerjaan"];
        $Penanganan->catatan = $_POST["catatan"];
        $s = $Penanganan->update();
    } else {
        $Penanganan->id_aduan = $_GET["id"];
        $Penanganan->id_admin = $_SESSION["id"];
        $Penanganan->status = $_POST["status"];
        $Penanganan->stok = NULL;
        $Penanganan->tanggal_pengerjaan = NULL;
        $Penanganan->catatan = NULL;
        $s = $Penanganan->insert();
    }
    
    if ($s) {
        header("location: index.php");
    } else {
        die("Gagal!");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../assets/images/logo.png">
    <title>Admin | Web Pengaduan</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="../assets/css/custom.css" rel="stylesheet">
</head>

<body>
    <?php include_once("include/header.php"); ?>

    <!-- Begin page content -->
    <main role="main" class="container">
        <table class="table table-striped">
            <tbody>
                <?php $rows = $Pengaduan->readOne($_GET['id']); while ($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <th>Pengadu</th>
                        <th>:</th>
                        <td><?php echo $row['user']; ?></td>
                    </tr>
                    <tr>
                        <th>Jenis</th>
                        <th>:</th>
                        <td><?php echo $row['jenis']; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <th>:</th>
                        <td><?php echo $row['tanggal']; ?></td>
                    </tr>
                    <tr>
                        <th>Bagian</th>
                        <th>:</th>
                        <td><?php echo $row['bagian']; ?></td>
                    </tr>
                    <tr>
                        <th>Lokasi</th>
                        <th>:</th>
                        <td><?php echo $row['lokasi']; ?></td>
                    </tr>
                    <tr>
                        <th>Masalah</th>
                        <th>:</th>
                        <td><?php echo $row['masalah']; ?></td>
                    </tr>
                    <tr>
                        <th>Gambar</th>
                        <th>:</th>
                        <td><img src="../assets/images/pengaduan/<?php echo $row['gambar']; ?>"></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <hr>
        <form method="post">
            <?php if (($_SESSION['jenis'] != "Direktur") AND ($Penanganan->getStatus($_GET["id"]) != "Menunggu Persetujuan")) : ?>
                <?php $rows = $Penanganan->readOne($_GET['id']); while ($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
                    <div class="form-group">
                        <label for="tanggal_pengerjaan">Tanggal pengerjaan</label>
                        <input type="date" class="form-control" name="tanggal_pengerjaan" placeholder="Hari/Bulan/Tanggal" value="<?php echo $row['tanggal_pengerjaan']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <textarea name="catatan" class="form-control" id="catatan" rows="3"><?php echo $row['catatan']; ?></textarea>
                    </div>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-<?php echo ($Penanganan->getStatus($_GET["id"]) === "Sedang Dikerjakan") ? 'primary':'secondary'; ?>">
                            <input type="radio" name="status" value="Sedang Dikerjakan" autocomplete="off" <?php echo ($row['status'] == 'Sedang Dikerjakan') ? 'checked' : ''; ?>> Sedang Dikerjakan
                        </label>
                        <label class="btn btn-<?php echo ($Penanganan->getStatus($_GET["id"]) === "Selesai") ? 'primary':'secondary'; ?>">
                            <input type="radio" name="status" value="Selesai" autocomplete="off" <?php echo ($row['status'] == 'Selesai') ? 'checked' : ''; ?>> Selesai
                        </label>
                    </div>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-<?php echo ($Penanganan->getStok($_GET["id"]) === "Tersedia") ? 'primary':'secondary'; ?>">
                            <input type="radio" name="stok" value="Tersedia" autocomplete="off" <?php echo ($row['stok'] == 'Tersedia') ? 'checked' : ''; ?>> Tersedia
                        </label>
                        <label class="btn btn-<?php echo ($Penanganan->getStok($_GET["id"]) === "Tidak Tersedia") ? 'primary':'secondary'; ?>">
                            <input type="radio" name="stok" value="Tidak Tersedia" autocomplete="off" <?php echo ($row['stok'] == 'Tidak Tersedia') ? 'checked' : ''; ?>> Tidak Tersedia
                        </label>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                <?php endwhile; ?>
            <?php endif; ?>
            <?php if (($_SESSION['jenis'] == "Direktur") AND ($Penanganan->getStatus($_GET["id"]) != "Selesai")) : ?>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-<?php echo ($Penanganan->getStatus($_GET["id"]) === "Disetujui") ? 'primary':'secondary'; ?>">
                        <input type="radio" name="status" value="Disetujui" autocomplete="off" <?php echo ($Penanganan->getStatus($_GET["id"]) === "Disetujui") ? 'checked' : ''; ?>> Disetujui
                    </label>
                    <label class="btn btn-<?php echo ($Penanganan->getStatus($_GET["id"]) === "Ditolak") ? 'danger' : 'secondary'; ?>">
                        <input type="radio" name="status" value="Ditolak" autocomplete="off" <?php echo ($Penanganan->getStatus($_GET["id"]) === "Ditolak") ? 'checked' : ''; ?>> Ditolak
                    </label>
                </div>
                <hr>
                <?php if (!$Penanganan->rowCountById($_GET['id'])) : ?>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                <?php endif; ?>
            <?php endif; ?>
        </form>
        <br>
    </main>

    <?php include_once("include/footer.php"); ?>

    <script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>