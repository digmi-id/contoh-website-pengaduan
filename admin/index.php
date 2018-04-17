<?php session_start(); if (empty($_SESSION) && !isset($_SESSION['is_logged']) && ($_SESSION['type'] != 'admin')) header("location: signin.php");

require_once("../classes/Config.php");
$Conf = new Config(); $connection = $Conf->getConnection();

include("../classes/Pengaduan.php");
$Pengaduan = new Pengaduan($connection);

include("../classes/Penanganan.php");
$Penanganan = new Penanganan($connection);

if (isset($_GET["delete"]) AND $_GET["delete"] != "") {
    $Pengaduan->id = $_GET["delete"];
    if ($Pengaduan->delete()) {
        // handle success
    } else {
        // handle failed
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
        <table class="table">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">User</th>
                <th scope="col">Bagian</th>
                <th scope="col">Jenis Permintaan</th>
                <th scope="col">Lokasi</th>
                <th scope="col">Masalah</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; $rows = $Pengaduan->readAll(); while ($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <th scope="row"><?php echo $no++; ?></th>
                        <td><?php echo $row["user"]; ?></td>
                        <td><?php echo $row["bagian"]; ?></td>
                        <td><?php echo $row["jenis"]; ?></td>
                        <td><?php echo $row["lokasi"]; ?></td>
                        <td><?php echo $row["masalah"]; ?></td>
                        <td><?php echo $row["tanggal"]; ?></td>
                        <td><span class="badge badge-<?php echo ($Penanganan->getStatus($row["id"])) ? "success" : "danger"; ?>"><?php echo ($Penanganan->getStatus($row["id"])) ? "Disetujui" : "Prosess"; ?></span></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Opsi">
                                <a href="_penanganan.php?id=<?php echo $row["id"]; ?>" class="btn btn-secondary btn-sm <?php echo ($Penanganan->getStatus($row["id"])) ? "disabled" : ""; ?>">Proses</a>
                                <a href="?delete=<?php echo $row["id"]; ?>" class="btn btn-secondary btn-sm">Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

    <?php include_once("include/footer.php"); ?>

    <script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>