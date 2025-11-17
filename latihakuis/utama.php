<?php
session_start();
require "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php?msg=belum_login");
    exit;
}

if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    mysqli_query($koneksi, "DELETE FROM film WHERE id_film = $id");
    header("Location: utama.php?msg=deleted");
    exit;
}

$rows = mysqli_query($koneksi, "SELECT * FROM film ORDER BY id_film ASC");
$total_harga = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(harga_tiket) AS total FROM film"))['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Film Bioskop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background: #f8f9fa;
        padding: 40px 0;
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
    .table th, .table td {
        vertical-align: middle !important;
        font-size: 15px;
        padding: 12px;
        
    }
    tfoot td {
        background: #eef3f7 !important;
        font-weight: 600;
    }
    .table thead th {
    background: #1f3a56 !important;
    color: #fff !important;
    border-color: #1f3a56 !important;
}

</style>
</head>

<body>

<div class="box-main bg-white border">

    <div class="header-bg">
        <h3 class="fw-bold m-0">Manajemen Film Bioskop</h3>
        <div class="small mt-2">
            Selamat datang, <b><?php echo $_SESSION['nama']; ?></b> |
            <a href="login.php" class="link-light text-decoration-underline">Logout</a>
        </div>
    </div>

    <div class="px-4 pt-4 pb-2">

        <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
            <div class="alert alert-success">Film berhasil dihapus!</div>
        <?php endif; ?>

        <a href="tambah.php" class="btn btn-success mb-3">Tambah Film</a>

        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul Film</th>
                        <th>Sutradara</th>
                        <th>Harga Tiket</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($rows as $film): ?>
                        <tr>
                            <td><?= $film['id_film']; ?></td>
                            <td><?= $film['judul_film']; ?></td>
                            <td><?= $film['sutradara']; ?></td>
                            <td>Rp <?= number_format($film['harga_tiket'], 0, ",", "."); ?></td>
                            <td>
                                <a href="edit.php?id=<?= $film['id_film']; ?>" class="text-primary text-decoration-none">Edit</a> |
                                <a href="utama.php?hapus=<?= $film['id_film']; ?>"
                                   onclick="return confirm('Apakah kamu yakin ingin menghapus film ini?')"
                                   class="text-danger text-decoration-none">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="3">Total Harga Tiket</td>
                        <td colspan="2">Rp <?= number_format($total_harga, 0, ",", "."); ?></td>
                    </tr>
                </tfoot>

            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
