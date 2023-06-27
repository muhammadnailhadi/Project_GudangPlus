<!DOCTYPE HTML>
<html>
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" 
  integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  <style>
    .warning {color: #FF0000;}
  </style>
</head>
<body>
<?php
$error_nama_mitra = "";
$error_alamat_mitra = "";
$error_kode_pos = "";
$error_nomortelp = "";
$error_email_mitra = "";

$nama_mitra = "";
$alamat_mitra = "";
$kode_pos = "";
$nomortelp = "";
$email_mitra = "";
$alert_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nama_mitra"])) {
        $error_nama_mitra = "Nama Mitra tidak boleh kosong";
    } else {
        $nama_mitra = cek_input($_POST["nama_mitra"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $nama_mitra)) {
            $error_nama_mitra = "Inputan Hanya boleh huruf dan spasi";
        }
    }

    if (empty($_POST["alamat_mitra"])) {
        $error_alamat_mitra = "Alamat Mitra tidak boleh kosong";
    } else {
        $alamat_mitra = cek_input($_POST["alamat_mitra"]);
    }

    if (empty($_POST["kode_pos"])) {
        $error_kode_pos = "Kode Pos tidak boleh kosong";
    } else {
        $kode_pos = cek_input($_POST["kode_pos"]);
        if (!is_numeric($kode_pos)) {
            $error_kode_pos = "Kode Pos hanya boleh angka";
        }
    }

    if (empty($_POST["nomor_telp"])) {
        $error_nomortelp = "Nomor Telepon tidak boleh kosong";
    } else {
        $nomortelp = cek_input($_POST["nomor_telp"]);
        if (!is_numeric($nomortelp)) {
            $error_nomortelp = "Nomor Telepon hanya boleh angka";
        }
    }

    if (empty($_POST["email_mitra"])) {
        $error_email_mitra = "Email tidak boleh kosong";
    } else {
        $email_mitra = cek_input($_POST["email_mitra"]);
        if (!filter_var($email_mitra, FILTER_VALIDATE_EMAIL)) {
            $error_email_mitra = "Format email invalid";
        }
    }

    
}

function cek_input($data) {
    $data = trim($data);
    $data = stripslashes($data); 
    $data = htmlspecialchars($data); 
    return $data;
}

include 'koneksi.php'; // file yang berisi koneksi ke database

function semua_valid() {
    if (empty($_POST['nama_mitra']) ||
        empty($_POST['alamat_mitra']) ||
        empty($_POST['kode_pos']) ||
        empty($_POST['nomor_telp']) ||
        empty($_POST['email_mitra'])) {
        return false;
    }
  
    return true;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Proses validasi dan penyimpanan data
    $nama_mitra = $_POST['nama_mitra'];
    $alamat_mitra = $_POST['alamat_mitra'];
    $kode_pos = $_POST['kode_pos'];
    $nomortelp = $_POST['nomor_telp'];
    $email_mitra =$_POST['email_mitra'];

    if (semua_valid()) {
        // Query SQL untuk insert data
        $query = "INSERT INTO mitra (nama_mitra, alamat_mitra, kode_pos, nomor_telp, email_mitra) 
        VALUES ('$nama_mitra', '$alamat_mitra', '$kode_pos', '$nomortelp', '$email_mitra')";

        // Jalankan query SQL
        if (mysqli_query($koneksi, $query)) {
            // Data berhasil disimpan
            $alert_message = "Data berhasil disimpan";

            // Redirect ke halaman lain setelah penyimpanan
            header("Location: formmitra2.php");
            exit();
        } else {
            // Terjadi kesalahan saat menyimpan data
            $alert_message = "Terjadi kesalahan saat menyimpan data";
        }
    }
}
?>

<!-- Tampilan inputan form peserta didik part 1 -->
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header text-black text-center">
                <h3 class="mb-0">FORMULIR</h3>
                <br>
                <div class="text-right">
                    <?php
                    $tanggal = date('d F Y');
                    echo "Tanggal: " . $tanggal;
                    ?>
                </div>
            </div>
            <div class="card-header bg-dark text-white text-center">
                Registrasi Mitra
            </div>
            <div class="card-body">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                    <div class="form-group row"> 
                        <label for="nama_mitra" class="col-sm-2 col-form-label">Nama Mitra</label>
                        <div class="col-sm-10">
                        <input type="text" name="nama_mitra" class="form-control <?php echo (!empty($error_nama_mitra) ? 'is-invalid' : ''); ?>" id="nama_mitra" placeholder="Nama Mitra" value="<?php echo $nama_mitra; ?>">

                            <?php if (!empty($error_nama_mitra)): ?>
                                <div class="invalid-feedback"><?php echo $error_nama_mitra; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row"> 
                        <label for="alamat_mitra" class="col-sm-2 col-form-label">Alamat Mitra</label>
                        <div class="col-sm-10">
                            <input type="text" name="alamat_mitra" class="form-control <?php echo (!empty($error_alamat_mitra) ? 'is-invalid' : ''); ?>" id="alamat_mitra" placeholder="Alamat Mitra" value="<?php echo $alamat_mitra; ?>">
                            <?php if (!empty($error_alamat_mitra)): ?>
                                <div class="invalid-feedback"><?php echo $error_alamat_mitra; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row"> 
                        <label for="kode_pos" class="col-sm-2 col-form-label">Kode Pos</label>
                        <div class="col-sm-10">
                            <input type="text" name="kode_pos" class="form-control <?php echo (!empty($error_kode_pos) ? 'is-invalid' : ''); ?>" id="kode_pos" placeholder="Kode Pos" value="<?php echo $kode_pos; ?>">
                            <?php if (!empty($error_kode_pos)): ?>
                                <div class="invalid-feedback"><?php echo $error_kode_pos; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row"> 
                        <label for="nomor_telp" class="col-sm-2 col-form-label">Nomor Telepon</label>
                        <div class="col-sm-10">
                            <input type="text" name="nomor_telp" class="form-control <?php echo (!empty($error_nomortelp) ? 'is-invalid' : ''); ?>" id="nomor_telp" placeholder="Nomor Telepon" value="<?php echo $nomortelp; ?>">
                            <?php if (!empty($error_nomortelp)): ?>
                                <div class="invalid-feedback"><?php echo $error_nomortelp; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row"> 
                        <label for="email_mitra" class="col-sm-2 col-form-label">Email Mitra</label>
                        <div class="col-sm-10">
                            <input type="email" name="email_mitra" class="form-control <?php echo (!empty($error_email_mitra) ? 'is-invalid' : ''); ?>" id="email_mitra" placeholder="Email Mitra" value="<?php echo $email_mitra; ?>">
                            <?php if (!empty($error_email_mitra)): ?>
                                <div class="invalid-feedback"><?php echo $error_email_mitra; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
    
                    <!-- Add other form fields here -->
    
                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary">Next</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
