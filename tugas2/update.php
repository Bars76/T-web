<?php
include ('koneksi.php');

$id = $_POST['id'];
$judul = $_POST['judul'];
$genre = $_POST['genre'];
$sutradara = $_POST['sutradara'];
$tahun = $_POST['tahun'];

$stmt = $koneksi->prepare("UPDATE film SET judul=?, genre=?, sutradara=?, tahun=? WHERE id=?");
$stmt->bind_param("ssssi", $judul, $genre, $sutradara, $tahun, $id);
$stmt->execute();

header("Location: index.php");
exit;
?>
