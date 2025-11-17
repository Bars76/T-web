<?php
session_start();
require "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php?msg=belum_login");
    exit;
}

$id = $_GET['id'];
$film = mysqli_query($koneksi, "SELECT * FROM film WHERE id_film = $id");
$data = mysqli_fetch_assoc($film);

if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $sutradara = $_POST['sutradara'];
    $harga = $_POST['harga'];

    mysqli_query($koneksi, "UPDATE film SET 
        judul_film = '$judul',
        sutradara = '$sutradara',
        harga_tiket = '$harga'
        WHERE id_film = $id
    ");

    header("Location: utama.php?msg=berhasil_update");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Film</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
            padding: 40px 0;
            overflow-x: hidden;
        }

        .box-main {
            max-width: 900px;
            margin: 0 auto;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,.12);
            background: #fff;
        }

        .header-bg {
            background: #1f3a56;
            color: #fff;
            padding: 20px 30px;
        }

        .header-bg h3 {
            margin-bottom: 4px;
            font-weight: 700;
        }
    </style>
</head>

<body>

<div class="box-main">
    <div class="header-bg">
        <h3 class="fw-bold m-0">Edit Film</h3>
        <div class="small">Perbarui informasi film</div>
    </div>

    <div class="px-4 py-4">
        <form method="POST">
            <label class="mb-1 fw-semibold">ID Film</label>
            <input type="text" class="form-control mb-3" value="<?= $data['id_film']; ?>" readonly>

            <label class="mb-1 fw-semibold">Judul Film</label>
            <input type="text" name="judul" class="form-control mb-3" value="<?= $data['judul_film']; ?>" required>

            <label class="mb-1 fw-semibold">Sutradara</label>
            <input type="text" name="sutradara" class="form-control mb-3" value="<?= $data['sutradara']; ?>" required>

            <label class="mb-1 fw-semibold">Harga Tiket (Rp)</label>
            <input type="number" name="harga" class="form-control mb-4" value="<?= $data['harga_tiket']; ?>" required>

            <button type="submit" name="submit" class="btn btn-success px-4">Perbarui</button>
            <a href="utama.php" class="btn btn-secondary px-4">Kembali</a>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
