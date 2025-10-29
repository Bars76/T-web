<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_film";

$koneksi = new mysqli($hostname,$username,$password,$database);
if($koneksi->connect_error){
    die("koneksi gagal".$koneksi -> connect_error);
}

?>