<?php
    $kode='';
    $kategori='';
    
    include('../includes/koneksi.php');
    if (isset($_POST['submit'])) {
        $kode = $_POST['kode'];
        $nama = $_POST['nama_produk'];
        $jumlah = $_POST['jumlah'];
        $kategori = $_POST['kategori'];
        $satuan = $_POST['satuan'];
        $tanggal_keluar = $_POST['tanggal_keluar'];
    
        // Periksa jika kategori dipilih atau tidak
        if (empty($kategori)) {
            $kategori = null; // Atur nilai default jika kategori tidak dipilih
        }
        // Jalankan query untuk mendapatkan ID terakhir
        $getLastIdQuery = "SELECT id_keluar FROM produk_beauty_keluar ORDER BY id_keluar DESC LIMIT 1";
        $result = $koneksi->query($getLastIdQuery);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $lastId = $row['id_keluar'];
            $newId = $lastId + 1;
        } else {
            // Jika tabel kosong, mulai dari ID 1
            $newId = 1;
        }
    
        // Persiapkan dan jalankan query INSERT
        $query = "INSERT INTO produk_beauty_keluar (id_keluar, kode_produk, nama_produk, jumlah_keluar, kategori, satuan, tanggal_keluar) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param('issssss', $newId, $kode, $nama, $jumlah, $kategori, $satuan, $tanggal_keluar);
        $stmt->execute();
    
        echo "<script>alert('Success: Data Berhasil Ditambahkan!');</script>";
    echo "<script>window.location.href='manage_produk_keluar2.php';</script>";

    
    
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
    <title>Update Stok Keluar</title>
    <link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="../dist/css/style.min.css" rel="stylesheet">

    
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
            <div class="container-fluid">
            <form method="POST">               
                <div class="row">
                    <h4 class="card-title mt-5">Informasi Produk Keluar</h4>

<div class="row">
<div class="col-sm-12 col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Kode Produk</h4>
                <div class="form-group">
                    <input type="text" name="kode" id="kode" class="form-control" placeholder="Enter Product Code" required>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Nama Produk</h4>
                <div class="form-group">
                    <input type="text" name="nama_produk" id="nama_produk" class="form-control" placeholder="Enter Product Name" required>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Jumlah Keluar</h4>
                <div class="form-group">
                    <input type="text" name="jumlah" id="jumlah" class="form-control" placeholder="Enter Quantity" required>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Kategori</h4>
                <div class="form-group">
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option value="">Select Category</option>
                        <option value="Perawatan Kulit" <?php echo ($kategori == "Perawatan Kulit" ? "selected" : ""); ?>>Perawatan Kulit</option>
                                            <option value="Rambut" <?php echo ($kategori == "Rambut" ? "selected" : ""); ?>>Rambut</option>
                                            <option value="Kosmetik" <?php echo ($kategori == "Kosmetik" ? "selected" : ""); ?>>Kosmetik</option>
                                            <option value="Perawatan Tubuh" <?php echo ($kategori == "Perawatan Tubuh" ? "selected" : ""); ?>>Perawatan Tubuh</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Satuan</h4>
                <div class="form-group">
                    <input type="text" name="satuan" id="satuan" class="form-control" placeholder="Enter Unit" required>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tanggal Keluar</h4>
                <div class="form-group">
                    <input type="date" name="tanggal_keluar" id="tanggal_keluar" class="form-control" placeholder="Enter Exit Date" required>
                </div>
            </div>
        </div>
    </div>
</div>

                    <div class="form-actions">
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-dark">Reset</button>
                        </div>
                    </div>

                
                </form>

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
    <script type="text/javascript">

    </script>

</body>

</html>