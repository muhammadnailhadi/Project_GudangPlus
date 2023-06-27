<?php

include('../includes/koneksi.php');

// Pengecekan koneksi database
if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}
?>

<nav class="navbar top-navbar navbar-expand-md">
    <div class="navbar-header" data-logobg="skin6">
        <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                class="ti-menu ti-close"></i></a>
        <div class="navbar-brand">
            <a href="dashboard.php">
                <b class="logo-icon">
                    <img src="../assets/images/fnb2.png" alt="homepage" class="dark-logo" />
                    <img src="../assets/images/fnb2.png" alt="homepage" class="light-logo" />
                </b>
                <span class="logo-text">
                    <img src="../assets/images/fnb.png" alt="homepage" class="dark-logo" />
                    <img src="../assets/images/fnb.png" class="light-logo" alt="homepage" />
                </span>
            </a>
        </div>
        <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
            data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                class="ti-more"></i></a>
    </div>
    <div class="navbar-collapse collapse" id="navbarSupportedContent">
        <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
        </ul>
        <ul class="navbar-nav float-right">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img src="../assets/images/users/admin-icn.png" alt="user" class="rounded-circle" width="35">
                    <?php
                if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
                    $username = $_SESSION['username'];
                    $password = $_SESSION['password'];

                    // Persiapkan pernyataan SQL untuk memperoleh data mitra berdasarkan username dan password
                    $stmt = $koneksi->prepare("SELECT * FROM mitra WHERE username = ? AND password = ?");
                    $stmt->bind_param('ss', $username, $password);
                    $stmt->execute();

                    // Dapatkan hasil dari pernyataan SQL
                    $res = $stmt->get_result();

                    // Pengecekan apakah sesi valid
                    if ($res->num_rows > 0) {
                        // Tampilkan hasil
                        $row = $res->fetch_object();
                        echo '<span class="ml-2 d-none d-lg-inline-block"><span>Welcome,</span> <span class="text-dark">' . $row->nama_mitra . '</span></span>';
                    } else {
                        echo 'Data mitra tidak ditemukan.';
                    }

                    // Tutup pernyataan
                    $stmt->close();
                } else {
                    echo 'Sesi tidak diatur atau username/password tidak tersedia.';
                }
                ?>
                    <i data-feather="chevron-down" class="svg-icon"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">              
                    <a class="dropdown-item" href="logout.php"><i data-feather="power" class="svg-icon mr-2 ml-1"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
