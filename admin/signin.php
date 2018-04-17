<?php require_once("../classes/Config.php");

$Conf = new Config();
$connection = $Conf->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once("../classes/Auth.php");
    $Login = new Auth($connection, 'admin');
    
    $Login->email = $_POST['email'];
    $Login->password = md5($_POST['password']);
    
    if ($Login->login()) {
		header('location: index.php');
    } else {
		header('location: signin.php');
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
    <title>Login Admin</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/signin.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <form class="form-signin" method="post">
        <center><img style="margin-right: 10px;" width=130 height=80 src="images/logo.png" /></center>
        <hr>
        <font color="black" size="3">Login Admin!</font>
            <hr>
            
            <label for="email" class="sr-only">Alamat Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Alamat Email" required autofocus>
            <label for="password" class="sr-only">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            <button class="btn btn-lg btn-danger btn-block" type="submit">Masuk</button>
        </form>
    </div>
</body>
</html>