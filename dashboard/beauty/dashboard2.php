<?php
session_start();
    include('../includes/koneksi.php');
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
    <title>Beauty Dashboard</title>
    <link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="../assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                       <?php?>
                        <div class="d-flex align-items-center">
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="container-fluid">
                <div class="card-group">
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium"><?php include 'counters2/hitung.php'?></h2>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Produk</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="shopping-bag"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><?php include 'counters2/hitung2.php'?></h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Kuantitas Produk
                                    </h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="grid"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium"><?php include 'counters2/hitung3.php'?></h2>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Kategori Produk</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="box"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php include 'counters2/hitung4.php'?></h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Produk Segera Habis</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="shopping-cart"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                          
                <div class="col-12">
                        <div class="card">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <h6 class="text-capitalize text-center">Doughnut Chart</h6>
                            <p class="text-sm mb-0"style="text-align: center;">
                            <span class="font-weight-bold">Perbandingan Kategori Produk dengan Kuantitas</span>                             
                            </p>
                        </div>
                        <div class="card-body p-3">
                        <div class="chart" style="max-width: 750px; margin: 0 auto;">
                        <canvas id="chart-doughnut"></canvas>
                        </div>
                </div>
                    </div>                               
            </div>
                <div class="col-12">
                        <div class="card">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <h6 class="text-capitalize text-center">Bar Chart</h6>
                            <p class="text-sm mb-0"style="text-align: center;">
                            <span class="font-weight-bold">Perbandingan Produk dengan Kuantitas</span>                             
                            </p>
                        </div>
                        <div class="card-body p-3">
                        <div class="chart" style="max-width: 750px; margin: 0 auto;">

                        <canvas id="chart-bar"></canvas>
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
    var ctx = document.getElementById("chart-bar").getContext('2d');
    <?php
        include('../includes/koneksi.php');
        $sql = "SELECT nama_produk, kuantitas FROM produk_beauty";
        $result = $koneksi->query($sql);

        $nama_produk2 = array();
        $tokuantitas = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nama_produk2[] = $row["nama_produk"];
                $tokuantitas[] = $row["kuantitas"];
            }
        }
        $koneksi->close();
    ?>

    var barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($nama_produk2); ?>,
            datasets: [{
                label: 'Kuantitas',
                data: <?php echo json_encode($tokuantitas); ?>,
                backgroundColor: [
                    'rgba(116, 0, 184, 1)',     
                    'rgba(105, 48, 195, 1)',    
                    'rgba(94, 96, 206, 1)',     
                    'rgba(83, 144, 217, 1)',    
                    'rgba(78, 168, 222, 1)',    
                    'rgba(72, 191, 227, 1)',    
                    'rgba(86, 207, 225, 1)',    
                    'rgba(100, 223, 223, 1)',   
                    'rgba(114, 239, 221, 1)',  
                    'rgba(128, 255, 219, 1)'   
                ],
                borderColor: 'rgba(0, 0, 0, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

    
<script>
var ctx = document.getElementById("chart-doughnut").getContext('2d');
<?php
include('../includes/koneksi.php');
$sql = "SELECT kategori, SUM(kuantitas) AS total_kuantitas FROM produk_beauty GROUP BY kategori";
$result = $koneksi->query($sql);

$kategori = array();
$kuantitas = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $kategori[] = $row["kategori"];
        $kuantitas[] = $row["total_kuantitas"];
    }
}
$koneksi->close();
?>

var doughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: <?php echo json_encode($kategori); ?>,
        datasets: [{
            label: 'Kuantitas',
            data: <?php echo json_encode($kuantitas); ?>,
            backgroundColor: [
                '#0a9396', 
                '#94d2bd',
                '#e9d8a6', 
                '#005f73'
            ],
            borderColor: [
                '#0a9396',
                '#94d2bd',
                '#e9d8a6',
                '#005f73' 
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
</body>

</html>