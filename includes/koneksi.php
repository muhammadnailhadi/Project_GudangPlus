<?php
    // Konfigurasi database
    $host = "localhost:3307";
    $username = "root";
    $password = "";
    $database = "gudangplus";

    $koneksi = mysqli_connect($host, $username, $password, $database);

if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}
?>