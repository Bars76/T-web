<?php include('koneksi.php'); ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen film</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-success bg-opacity-25 min-vh-100" style="overflow: hidden;">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <div class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #146c43;">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <a class="navbar-brand fw-bold me-4">Manajemen Film</a>
                    <div class="navbar-nav flex-row">
                        <a class="nav-link px-2" href="index.php">Home</a>
                        <a class="nav-link active px-2" href="tambah.php">Tambah Film</a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="flex-grow-1 d-flex justify-content-center align-items-center">
            <div class="card shadow" style="max-width: 500px; width: 80%;">
                <div class="card-body">
                    <h3 class="mb-4 text-center fw-bold">Tambah FILM</h3>
                    <form action="create.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Judul Film</label>
                            <input type="text" name="judul" class="form-control" placeholder="Judul Film" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Genre</label>
                            <select name="genre" class="form-select" required>
                                <option value="">Pilih Genre</option>
                                <option value="romance">Romance</option>
                                <option value="action">Action</option>
                                <option value="horror">Horror</option>
                                <option value="comedy">Comedy</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sutradara</label>
                            <input type="text" name="sutradara" class="form-control" placeholder="Sutradara" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tahun</label>
                            <input type="number" name="tahun" class="form-control" placeholder="Tahun" min="1888" max="2025" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>