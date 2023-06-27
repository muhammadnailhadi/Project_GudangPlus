<?php
    include '../includes/koneksi.php';

    $sql = "SELECT SUM(kuantitas) AS total_quantity FROM produk_beauty";
$query = $koneksi->query($sql);
$row = $query->fetch_assoc();
$total_quantity = $row['total_quantity'];
echo $total_quantity;

?>