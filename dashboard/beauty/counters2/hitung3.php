<?php
    include '../includes/koneksi.php';

    $sql = "SELECT COUNT(DISTINCT kategori) AS total_kategori FROM produk_beauty";
$query = $koneksi->query($sql);
$row = $query->fetch_assoc();
$total_kategori = $row['total_kategori'];
echo $total_kategori;

    
?>