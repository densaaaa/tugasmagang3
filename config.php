<?php
$server = "localhost";
$user = "root";
$password = "";
$nama_database = "db_obat";

$db = mysqli_connect($server, $user, $password, $nama_database, 8877);

if (!$db) {
    die("Gagal terkoneksi: ". mysqli_connect_error());
}
?>