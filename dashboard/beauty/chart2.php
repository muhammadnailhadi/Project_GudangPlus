<?php
include('../includes/koneksi.php');
$sql = "SELECT nama_produk, kuantitas FROM produk_beauty";
$result = $koneksi->query($sql);

$nama_produk = array();
$kuantitas = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nama_produk[] = $row["nama_produk"];
        $kuantitas[] = $row["kuantitas"];
    }
}

// Close the database connection
$koneksi->close();
?>


