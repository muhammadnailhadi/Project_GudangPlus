<?php
    include '../includes/koneksi.php';

    $sql = "SELECT nama_produk FROM produk ORDER BY kuantitas ASC LIMIT 1";
    $query = $koneksi->query($sql);
    $row = $query->fetch_assoc();
    $nama_produk_min = $row['nama_produk'];
    echo $nama_produk_min;
    
?>