<?php session_start(); if (empty($_SESSION) && !isset($_SESSION['is_logged']) && ($_SESSION['type'] != 'admin')) header("location: signin.php");

require_once("../classes/Config.php");
$Conf = new Config(); $connection = $Conf->getConnection();

include("../classes/Bagian.php");
$Bagian = new Bagian($connection);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Bagian->nama = $_POST["nama"];
    if ($Bagian->insert()) {
        // Tampilkan alert success
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
    <main role="main" class="container" style="margin-top: 20px;">
        <form class="form-inline" method="post">
            <div class="form-group mx-sm-3">
                <label for="nama" class="sr-only">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Bagian">
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
        <table class="table" style="margin-top: 20px;">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; $rows = $Bagian->readAll(); while ($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <th scope="row"><?php echo $no++; ?></th>
                        <td><?php echo $row["nama"]; ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Opsi">
                                <a href="edit_bagian.php" class="btn btn-secondary btn-sm">Edit</a>
                                <a href="delete_bagian.php" class="btn btn-secondary btn-sm">Delete</a>
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