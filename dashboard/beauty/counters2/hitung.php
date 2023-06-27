<?php
    include '../includes/koneksi.php';

    $sql = "SELECT COUNT(DISTINCT kode_produk) AS jumlah_produk FROM produk_beauty";
$query = $koneksi->query($sql);
$row = $query->fetch_assoc();
$jumlah_produk = $row['jumlah_produk'];
echo $jumlah_produk;
?>