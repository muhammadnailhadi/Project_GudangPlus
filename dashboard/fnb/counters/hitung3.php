<?php
    include '../includes/koneksi.php';

    $sql = "SELECT COUNT(DISTINCT kode) AS total_raw_materials FROM bahan_baku_fb";
    $query = $koneksi->query($sql);
    $row = $query->fetch_assoc();
    $total_raw_materials = $row['total_raw_materials'];
    echo $total_raw_materials;
    
?>