<?php
include ('koneksi.php');

$judul = $_POST['judul'];
$genre = $_POST['genre'];
$sutradara = $_POST['sutradara'];
$tahun = $_POST['tahun'];

$stmt = $koneksi->prepare("INSERT INTO film (judul, genre, sutradara, tahun) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $judul, $genre, $sutradara, $tahun);
$stmt->execute();

header("Location: index.php");
exit;
?>
