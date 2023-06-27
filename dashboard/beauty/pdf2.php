<?php
include('../includes/koneksi.php');
require_once('../dompdf/autoload.inc.php');;
use Dompdf\Dompdf;

$dompdf = new Dompdf();
$query = mysqli_query($koneksi, "SELECT * FROM produk_beauty");

$html = '<center><h3>Produk</h3></center><hr/><br/>'; 
$html .= '<table border="1" width="100%">
<tr>
<th>No</th>
<th>Kode Produk</th>
<th>Nama Produk</th>
<th>Kuantitas</th>
<th>Kategori</th>
<th>Satuan</th>
<th>Tanggal</th>
</tr>';

$no = 1;
while($row = mysqli_fetch_array($query)) {
    $html .= "<tr>
    <td>".$no."</td>
    <td>".$row['kode_produk']."</td>
    <td>".$row['nama_produk']."</td> 
    <td>".$row['kuantitas']."</td>
    <td>".$row['kategori']."</td>
    <td>".$row['satuan']."</td>
    <td>".$row['tanggal']."</td>
    </tr>";
    $no++;
}

$html .= "</table>";

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('Laporan Produk Beauty.pdf');
?>
