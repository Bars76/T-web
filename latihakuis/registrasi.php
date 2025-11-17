<?php
session_start();
require "koneksi.php";

$pesan = "";

if(isset($_GET['msg'])){
    if($_GET['msg'] == "konfirmasi_salah") $pesan = "Konfirmasi password tidak sama!";
    if($_GET['msg'] == "username_sudah_ada") $pesan = "Username sudah digunakan!";
    if($_GET['msg'] == "gagal") $pesan = "Registrasi gagal! Coba lagi.";
}

if(isset($_POST['register'])){
    $nama = $_POST['nama'];
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $conf = $_POST['konfirmasi_password'];

    if($pass !== $conf){
        header("Location: registrasi.php?msg=konfirmasi_salah");
        exit;
    }

    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$user'");
    if(mysqli_num_rows($cek) > 0){
        header("Location: registrasi.php?msg=username_sudah_ada");
        exit;
    }

    $simpan = mysqli_query($koneksi, "
        INSERT INTO users (username, password, nama_lengkap)
        VALUES ('$user', '$pass', '$nama')
    ");

    if($simpan){
        header("Location: login.php?msg=register_sukses");
        exit;
    } else {
        header("Location: registrasi.php?msg=gagal");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body{
        background: #f8f9fa;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 40px;
        overflow: hidden;
    }
    .card-custom{
        max-width: 1100px;   
        width: 100%;
        min-height: 520px;  
    }
    .image-section img{
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

        <div class="col-md-6 p-5 d-flex flex-column justify-content-center">

            <?php if($pesan != ""): ?>
                <?php
                    $warna = "secondary";
                    if(isset($_GET['msg'])){
                        if($_GET['msg']=="konfirmasi_salah") $warna = "warning";
                        if($_GET['msg']=="username_sudah_ada") $warna = "danger";
                        if($_GET['msg']=="gagal") $warna = "danger";
                    }
                ?>
                <div class="alert alert-<?= $warna ?> alert-dismissible fade show" role="alert">
                    <?= $pesan ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <h3 class="fw-bold mb-1">Register</h3>
            <small class="text-muted mb-4">Masukkan data registrasi dengan benar</small>

            <form method="POST" action="registrasi.php">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control mb-3" required>

                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control mb-3" required>

                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control mb-3" required>

                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="konfirmasi_password" class="form-control mb-4" required>

                <button class="btn btn-dark px-4 w-100" name="register">Register</button>
            </form>

            <p class="mt-4 mb-0 small text-muted">
                Sudah punya akun?
                <a href="login.php" class="text-primary">Login di sini</a>
            </p>

        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
