<?php
require_once("classes/Config.php");
$Conf = new Config();
$connection = $Conf->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once("classes/User.php");
    $User = new User($connection);
    
    $User->nama = $_POST['nama'];
    $User->nohp = $_POST['nohp'];
    $User->email = $_POST['email'];
    $User->password = md5($_POST['password']);
    
    if ($User->insert()) {
		header('location: signin.php');
    } else {
		header('location: signup.php');
    }
}
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
    <title>Registrasi User</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/signup.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <form class="form-signin" method="post">
            <h2 class="form-signin-heading text-center">Registrasi User</h2>
            <hr>
            <label for="nama" class="sr-only">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap" required autofocus>

            <label for="email" class="sr-only">No Hp</label>
            <input type="text" name="nohp" id="nohp" class="form-control" placeholder="Nomor Handphone" required>
            
            <label for="email" class="sr-only">Alamat Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Alamat Email" required>
            
            <label for="password" class="sr-only">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            
            <button class="btn btn-lg btn-primary btn-block" type="submit">Daftar</button>
        </form>
    </div>
</body>
</html>