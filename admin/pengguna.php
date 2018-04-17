<?php session_start(); if (empty($_SESSION) && !isset($_SESSION['is_logged']) && ($_SESSION['type'] != 'admin')) header("location: signin.php");

require_once("../classes/Config.php");
$Conf = new Config(); $connection = $Conf->getConnection();

include("../classes/Admin.php");
$Admin = new Admin($connection);

if ($_POST) {
    $Admin->jenis = $_POST['jenis'];
    $Admin->username = strtolower($_POST['username']);
    $Admin->nama = ucwords($_POST['nama']);
    $Admin->password = md5($_POST['password']);

    if ($Admin->insert()) {
        // die("ok");
    } else {
        die("Failed");
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
    <link rel="icon" href="../../../../favicon.ico">
    <title>Admin | Web Pengaduan</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="../assets/css/custom.css" rel="stylesheet">
</head>

<body>
    <?php include_once("include/header.php"); ?>

    <main role="main" class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col-md-4">
                <form method="post">
                    <div class="form-group">
                        <label for="jenis">Jenis</label>
                        <select name="jenis" id="jenis" class="form-control">
                            <option value="Direktur">Direktur</option>
                            <option value="Tim IT">Tim IT</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-md-8">
                <h4 class="form-signin-heading text-center">Daftar Pengguna</h4>
                <table class="table table-hovered table-condensed" style="margin-top: 20px;">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Username</th>
                        <th scope="col">Nama</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; $rows = $Admin->readAll(); while ($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <th scope="row"><?php echo $no++; ?></th>
                                <td><?php echo $row["jenis"]; ?></td>
                                <td><?php echo $row["username"]; ?></td>
                                <td><?php echo $row["nama"]; ?></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Opsi">
                                        <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <?php include_once("include/footer.php"); ?>

    <script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>