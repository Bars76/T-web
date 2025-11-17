<?php
session_start();
require "koneksi.php";

$pesan = "";

if(isset($_GET['msg'])){
    if($_GET['msg'] == "register_sukses") $pesan = "Registrasi berhasil. Silakan login.";
    if($_GET['msg'] == "belum_login") $pesan = "Belum login!";
    if($_GET['msg'] == "gagal") $pesan = "Login gagal! Username atau password salah.";
    if($_GET['msg'] == "logout") $pesan = "Anda telah logout.";
}

if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $cek = mysqli_query($koneksi,
        "SELECT * FROM users WHERE username='$user' AND password='$pass'"
    );

    if(mysqli_num_rows($cek) == 1){
        $data = mysqli_fetch_assoc($cek);

        $_SESSION['login']     = true;
        $_SESSION['nama']      = $data['nama_lengkap'];
        $_SESSION['user']      = $data['username'];
        $_SESSION['id_user']   = $data['id_user'];
        $_SESSION['level']     = $data['level'];

        header("Location: utama.php");
        exit;
    } else {
        header("Location: login.php?msg=gagal");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 40px;
            overflow: hidden;
        }

        .card-custom {
            max-width: 1100px;
            width: 100%;
            min-height: 520px;
        }

        .image-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="card card-custom shadow-sm border rounded overflow-hidden">
        <div class="row g-0">
            <div class="col-md-6 d-none d-md-block">
                <div class="image-section h-100">
                    <img src="film.jpg" alt="foto roll">
                </div>
            </div>

            <div class="col-md-6 p-5 d-flex flex-column">

                <?php if($pesan != ""): ?>
                    <?php
                        $warna = "secondary";
                        if(isset($_GET['msg'])){
                            if($_GET['msg'] == "register_sukses") $warna = "success";
                            if($_GET['msg'] == "belum_login") $warna = "warning";
                            if($_GET['msg'] == "gagal") $warna = "danger";
                            if($_GET['msg'] == "logout") $warna = "info";
                        }
                    ?>
                    <div class="alert alert-<?= $warna ?> alert-dismissible fade show" role="alert">
                        <?= $pesan ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <h3 class="fw-bold mb-1">Login</h3>
                <small class="text-muted mb-4">Masukkan username dan password</small>

                <form method="POST" action="login.php">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control mb-3">

                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control mb-3">

                    <button class="btn btn-dark px-4 w-100 mb-2" name="login">Login</button>
                </form>

                <p class="mt-2 mb-0 small text-muted">
                    Belum punya akun?
                    <a href="registrasi.php" class="text-primary text-decoration-none">Daftar di sini</a>
                </p>
                <small class="text-muted">Default: admin / admin</small>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
