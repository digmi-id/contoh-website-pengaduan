<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark justify-content-between">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="bagian.php">Bagian</a>
                    </li>
                    <?php if ($_SESSION['jenis'] == 'root'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="pengguna.php">Pengguna</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-danger" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['nama']; ?></a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="profil.php">Profil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="signout.php">Keluar</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>