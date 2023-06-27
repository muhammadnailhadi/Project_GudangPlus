<?php
session_start();
    include('../includes/koneksi.php');
    if(isset($_GET['del'])) {
        $id=intval($_GET['del']);
        $adn="DELETE from produk_beauty where id=?";
            $stmt= $koneksi->prepare($adn);
            $stmt->bind_param('i',$id);
            $stmt->execute();
            $stmt->close();	   
            echo "<script>alert('Record has been deleted');</script>" ;
    }
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/google-plus.png">
    <title>Stok Produk</title>
    <link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
     <link href="../assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="../dist/css/style.min.css" rel="stylesheet">

    <script language="javascript" type="text/javascript">
    var popUpWin=0;
    function popUpWindow(URLStr, left, top, width, height){
        if(popUpWin) {
         if(!popUpWin.closed) popUpWin.close();
            }
            popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+510+',height='+430+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
        }
    </script>

</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin6">
            <?php include 'includes2/navigation.php'?>
        </header>        
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <?php include 'includes2/sidebar.php'?>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Stok Produk</h4>
                        <div class="d-flex align-items-center">
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-subtitle">Menampilkan semua produk.</h6>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-hover table-bordered no-wrap">
                                    <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Produk</th>
                                                <th>Nama Produk</th>
                                                <th>Kuantitas</th>
                                                <th>Kategori</th>
                                                <th>Satuan</th>
                                                <th>Tanggal</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php	
                                        $ret = "SELECT m.kode_produk, m.nama_produk, (COALESCE(t.total_masuk, 0) - COALESCE(k.total_keluar, 0)) AS kuantitas, m.kategori, m.satuan, COALESCE(k.tanggal_keluar, m.tanggal_masuk) AS tanggal
                                        FROM produk_beauty_masuk AS m
                                        LEFT JOIN (
                                            SELECT kode_produk, SUM(jumlah_masuk) AS total_masuk
                                            FROM produk_beauty_masuk
                                            GROUP BY kode_produk
                                        ) AS t ON m.kode_produk = t.kode_produk
                                        LEFT JOIN (
                                            SELECT p.kode_produk, (SUM(p.jumlah_keluar) + COALESCE((SELECT SUM(jumlah_keluar) FROM produk_beauty_keluar WHERE kode_produk = p.kode_produk AND tanggal_keluar < p.tanggal_keluar), 0)) AS total_keluar, p.tanggal_keluar
                                            FROM produk_beauty_keluar AS p
                                            INNER JOIN (
                                                SELECT kode_produk, MAX(tanggal_keluar) AS max_tanggal
                                                FROM produk_beauty_keluar
                                                GROUP BY kode_produk
                                            ) AS sub ON p.kode_produk = sub.kode_produk AND p.tanggal_keluar = sub.max_tanggal
                                            GROUP BY p.kode_produk
                                        ) AS k ON m.kode_produk = k.kode_produk;
                                        
                                                                                   
                                        ";
                                        $stmt = $koneksi->prepare($ret);
                                        $stmt->execute();
                                        $res = $stmt->get_result();
                                        $cnt = 1;
                                        while ($row = $res->fetch_object()) 
                                            {
                                                ?>
                                        <tr><td><?php echo $cnt;;?></td>
                                        <td><?php echo $row->kode_produk;?></td>
                                        <td><?php echo $row->nama_produk;?></td>
                                        <td><?php echo $row->kuantitas;?></td>
                                        <td><?php echo $row->kategori;?></td>
                                        <td><?php echo $row->satuan;?></td>
                                        <td><?php echo $row->tanggal;?></td>
                                       
    
                                        </tr>
                                            <?php
                                            $check_query = "SELECT COUNT(*) as count FROM produk_beauty WHERE kode_produk = ?";
                                            $stmt_check = $koneksi->prepare($check_query);
                                            $stmt_check->bind_param("s", $row->kode_produk);
                                            $stmt_check->execute();
                                            $result = $stmt_check->get_result();
                                            $data = $result->fetch_assoc();
                                        
                                            if ($data['count'] == 0) {
                                                // Jika data belum ada dalam tabel, lakukan proses penyimpanan
                                                $insert_query = "INSERT INTO produk_beauty (kode_produk, nama_produk, kuantitas, kategori, satuan, tanggal) 
                                                                 VALUES (?, ?, ?, ?, ?, ?)";
                                                $stmt_insert = $koneksi->prepare($insert_query);
                                                $stmt_insert->bind_param("ssssss", $row->kode_produk, $row->nama_produk, $row->kuantitas, $row->kategori, $row->satuan, $row->tanggal);
                                                $stmt_insert->execute();
                                            } else {
                                                // Jika data sudah ada dalam tabel, lakukan proses pembaruan
                                                $update_query = "UPDATE produk_beauty SET nama_produk = ?, kuantitas = ?, kategori = ?, satuan = ?, tanggal = ? 
                                                                 WHERE kode_produk = ?";
                                                $stmt_update = $koneksi->prepare($update_query);
                                                $stmt_update->bind_param("ssssss", $row->nama_produk, $row->kuantitas, $row->kategori, $row->satuan, $row->tanggal, $row->kode_produk);
                                                $stmt_update->execute();
                                            }
                                            
                                        $cnt=$cnt+1;
                                            }
                                            $delete_query = "DELETE FROM produk_beauty WHERE kode_produk NOT IN (SELECT kode_produk FROM produk_beauty_masuk)";
                                            $stmt_delete = $koneksi->prepare($delete_query);
                                            $stmt_delete->execute();
                                             ?>                                         																			
									</tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
    <div class="d-flex justify-content-end">
        <button class="btn btn-primary mr-2" onclick="exportToPDF()">Export to PDF</button>
        <button class="btn btn-success" onclick="exportToExcel()">Export to Excel</button>
    </div>
</div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include '../includes/footer.php' ?>
        </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../dist/js/app-style-switcher.js"></script>
    <script src="../dist/js/feather.min.js"></script>
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../dist/js/sidebarmenu.js"></script>
    <script src="../dist/js/custom.min.js"></script>
    <script src="../assets/extra-libs/c3/d3.min.js"></script>
    <script src="../assets/extra-libs/c3/c3.min.js"></script>
    <script src="../assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="../dist/js/pages/dashboards/dashboard1.min.js"></script>
    <script src="../assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../dist/js/pages/datatable/datatable-basic.init.js"></script>
    <script>
    function exportToExcel() {
        window.location.href = "excel2.php";
    }
</script>
<script>
    function exportToPDF() {
        window.location.href = "pdf2.php";
    }
</script>

</body>

</html>