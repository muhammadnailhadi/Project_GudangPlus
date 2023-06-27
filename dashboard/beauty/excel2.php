<?php
include('../includes/koneksi.php');
require('../vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Kode Produk');
$sheet->setCellValue('C1', 'Nama Produk');
$sheet->setCellValue('D1', 'Kuantitas');
$sheet->setCellValue('E1', 'Kategori');
$sheet->setCellValue('F1', 'Satuan');
$sheet->setCellValue('G1', 'Tanggal');

$query = mysqli_query($koneksi, "SELECT * FROM produk_beauty");
$i = 2;
$no = 1;
while ($row = mysqli_fetch_array($query)) {
    $sheet->setCellValue('A' . $i, $no++);
    $sheet->setCellValue('B' . $i, $row['kode_produk']);
    $sheet->setCellValue('C' . $i, $row['nama_produk']);
    $sheet->setCellValue('D' . $i, $row['kuantitas']);
    $sheet->setCellValue('E' . $i, $row['kategori']);
    $sheet->setCellValue('F' . $i, $row['satuan']);
    $sheet->setCellValue('G' . $i, $row['tanggal']);
    $i++;
}

$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];
$i = $i - 1;
$sheet->getStyle('A1:G' . $i)->applyFromArray($styleArray);
$writer = new Xlsx($spreadsheet);

$fileName = 'Report Produk Beauty.xlsx';
$writer->save($fileName);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');

echo '<script>alert("Export berhasil!");</script>';

header('Location: manage_produk2.php');
exit();
?>
