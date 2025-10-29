<?php
include ('koneksi.php');

$id = $_GET['id'];
$stmt = $koneksi->prepare("DELETE FROM film WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: index.php");
exit;
?>