<?php include('koneksi.php'); ?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Film</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <a class="navbar-brand fw-bold me-4">Manajemen Film</a>
                <div class="navbar-nav flex-row">
                    <a class="nav-link active px-2" href="index.php">Home</a>
                    <a class="nav-link px-2" href="tambah.php">Tambah Film</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row g-4 align-items-start">
            <div class="col-md-8">
                <h3 class="fw-semibold">Selamat Datang di Manajemen Film</h3>
                <p class="fw-bold text-dark">Ini adalah daftar film Anda.</p>
                <table class="table table-light table-bordered text-center mt-4">
                    <thead class="table-success">
                        <tr>
                            <th>No</th>
                            <th>Judul Film</th>
                            <th>Genre</th>
                            <th>Tahun Rilis</th>
                            <th>Sutradara</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $koneksi->query("SELECT * FROM film");
                        if ($result->num_rows > 0):
                            $no = 1;
                            while ($row = $result->fetch_assoc()):
                        ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['judul']); ?></td>
                                    <td><?= ucfirst($row['genre']); ?></td>
                                    <td><?= $row['tahun']; ?></td>
                                    <td><?= htmlspecialchars($row['sutradara']); ?></td>
                                    <td class="d-flex flex-column gap-2 align-items-center">
                                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-sm w-75">Edit</a>
                                        <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm w-75"
                                            onclick="return confirm('Yakin ingin menghapus film ini?')">Delete</a>
                                    </td>

                                </tr>
                            <?php endwhile;
                        else: ?>
                            <tr>
                                <td colspan="6" class="text-muted">Tidak ada data film.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-4 text-center">
                <img src="https://admin.tvrijakartanews.com/uploads/Sore_Official_Poster_IG_29ae6d0f6d.jpg"
                    alt="Film sore"
                    class="img-fluid rounded shadow-sm w-75">
            </div>

</body>

</html>