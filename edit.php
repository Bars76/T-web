<?php
include('koneksi.php');
$id = $_GET['id'];
$stmt = $koneksi->prepare("SELECT * FROM film WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen film</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-success bg-opacity-25 min-vh-100" style="overflow: hidden;">

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
                    <h3 class="mb-4 text-center fw-bold">Edit FILM</h3>
                    <form action="update.php" method="POST">
                        <input type="hidden" name="id" value="<?= $data['id'] ?>">

                        <div class="mb-3">
                            <label class="form-label">Judul Film</label>
                            <input type="text" name="judul" class="form-control" value="<?= $data['judul'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Genre</label>
                            <select name="genre" class="form-select" required>
                                <?php
                                $genres = ['romance', 'action', 'horror', 'comedy'];
                                foreach ($genres as $g) {
                                    $sel = ($data['genre'] == $g) ? 'selected' : '';
                                    echo "<option value='$g' $sel>" . ucfirst($g) . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sutradara</label>
                            <input type="text" name="sutradara" class="form-control" value="<?= $data['sutradara'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tahun</label>
                            <input type="number" name="tahun" class="form-control" min="1888" max="2025" value="<?= $data['tahun'] ?>" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Update</button>
                        <a href="index.php" class="btn btn-secondary w-100 mt-2">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>