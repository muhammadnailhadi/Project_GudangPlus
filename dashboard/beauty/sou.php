<?php
session_start();
include('../includes/koneksi.php');
// Pastikan Anda sudah memasukkan kode koneksi database di sini

// Periksa apakah ada data yang dikirimkan melalui form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Lakukan proses penyimpanan data ke database sesuai dengan kebutuhan Anda
    // Misalnya, dengan melakukan INSERT pada tabel bomfnb_accordion

    // Kode di bawah ini hanyalah contoh, Anda perlu menyesuaikan dengan struktur tabel Anda
    $query = "INSERT INTO beauty_accordion (title, content) VALUES ('$title', '$content')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Jika penyimpanan berhasil, redirect ke halaman edit_menu.php
        header('Location: manage_sou.php');
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo 'Error adding new menu. Please try again.';
    }
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
    <title>Steps Of Use</title>
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
                        <h4 class="card-title mt-5">Informasi Steps Of Use</h4>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Title</h4>
                                    <div class="form-group">
                                        <input type="text" name="title" id="title" class="form-control"
                                            placeholder="Enter Title" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8 col-lg-8 col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Content</h4>
                                    <div class="form-group">
                                        <textarea name="content" id="content" class="form-control"
                                            placeholder="Enter Content" required
                                            style="height: 300px;"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-actions">
                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                <button type="reset" class="btn btn-dark">Reset</button>
                            </div>
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
