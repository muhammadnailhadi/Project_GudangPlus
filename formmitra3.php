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
$error_usernama="";
$error_password="";
$error_kategori="";

$usernama="";
$password="";
$kategori="";

if (empty($_POST["usernama"])) {
    $error_usernama = "Username tidak boleh kosong";
} else {
    $usernama= cek_input($_POST["usernama"]);
    if (!filter_var($usernama, FILTER_VALIDATE_EMAIL)) {
        $error_usernama = "Format usernama invalid";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["password"])) {
        $error_password = "Password tidak boleh kosong";
    } else {
        $password = cek_input($_POST["password"]);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["kategori"])) {
        $error_kategori = "Pilih salah satu kategori";
    } else {
        $kategori = cek_input($_POST["kategori"]);
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
    if (empty($_POST['usernama']) ||
        empty($_POST['password']) ||
        empty($_POST['kategori'])) {
        return false;
    }
    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan data dari form
    $usernama = $_POST['usernama'];
    $password = $_POST['password'];
    $kategori = $_POST['kategori'];

    $query_id = "SELECT MAX(id) AS id_terbaru FROM mitra";
    $result_id = mysqli_query($koneksi, $query_id);
    $row_id = mysqli_fetch_assoc($result_id);
    $id_terbaru = $row_id['id_terbaru'];

    $query = "UPDATE mitra SET
        username = '$usernama',
        password = '$password',
        kategori = '$kategori'
        WHERE id = $id_terbaru";

    if (mysqli_query($koneksi, $query)) {
        // Update berhasil
        $alert_message = "Data berhasil diupdate";
        header("Location: dashboard");
        exit();
    } else {
        // Terjadi kesalahan saat melakukan update
        $alert_message = "Terjadi kesalahan saat mengupdate data";
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
                Registrasi Dashboard
            </div>
            <div class="card-body">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group row">
                        <label for="usernama" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?php echo ($error_usernama != "" ? "is-invalid" : ""); ?>" id="usernama" name="usernama" value="<?php echo $usernama; ?>">
                            <span class="warning"><?php echo $error_usernama; ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control <?php echo ($error_password != "" ? "is-invalid" : ""); ?>" id="password" name="password" value="<?php echo $password; ?>">
                            <span class="warning"><?php echo $error_password; ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori" class="col-sm-3 col-form-label">Kategori</label>
                        <div class="col-sm-9">
                            <select class="form-control <?php echo ($error_kategori != "" ? "is-invalid" : ""); ?>" id="kategori" name="kategori">
                                <option value="">Pilih Kategori</option>
                                <option value="Food & Beverage" <?php echo ($kategori == "Food & Beverage" ? "selected" : ""); ?>>Food & Beverage</option>
                                <option value="Beauty" <?php echo ($kategori == "Beauty" ? "selected" : ""); ?>>Beauty</option>
                            </select>
                            <span class="warning"><?php echo $error_kategori; ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-9 offset-sm-3">
                            <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
