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
$error_nama="";
$error_tanggal_lahir="";
$error_tempat_lahir="";
$error_jabatan="";
$error_nomorhp="";
$error_email="";

$nama="";
$tanggal_lahir="";
$tempat_lahir="";
$jabatan="";
$nomorhp="";
$email="";
$alert_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nama"])) {
        $error_nama = "Nama tidak boleh kosong";
    } else {
        $nama = cek_input($_POST["nama"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
            $error_nama = "Inputan Hanya boleh huruf dan spasi";
        }
    }
}
if (empty($_POST["tanggal_lahir"])) {
    $error_tanggal_lahir = "Tanggal Lahir tidak boleh kosong";
  } else {
    $tanggal_lahir = cek_input($_POST["tanggal_lahir"]);
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["tempat_lahir"])) {
        $error_tempat_lahir = "Tempat Lahir tidak boleh kosong";
    } else {
        $tempat_lahir = cek_input($_POST["tempat_lahir"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $tempat_lahir)) {
            $error_tempat_lahir = "Inputan Hanya boleh huruf dan spasi";
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["jabatan"])) {
        $error_jabatan = "Jabatan tidak boleh kosong";
    } else {
        $jabatan = cek_input($_POST["jabatan"]);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["hp"])) {
        $error_nomorhp = "Nomor hp tidak boleh kosong";
    } else {
        $nomorhp = cek_input($_POST["hp"]);
        if (!is_numeric($nomorhp)) {
            $error_nomorhp = "Nomor hp hanya boleh angka";
        }
    }
}
if (empty($_POST["email"])) {
    $error_email = "Email tidak boleh kosong";
  } else {
    $email= cek_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error_email = "Format email invalid";
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
    if (empty($_POST['nama']) ||
        empty($_POST['tanggal_lahir']) ||
        empty($_POST['tempat_lahir']) ||
        empty($_POST['jabatan']) ||
        empty($_POST['hp']) ||
        empty($_POST['email'])) {
        return false;
    }

  
    return true;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan data dari form
    $nama=$_POST['nama'];
    $tanggal_lahir=$_POST['tanggal_lahir'];
    $tempat_lahir=$_POST['tempat_lahir'];
    $jabatan=$_POST['jabatan'];
    $nomorhp=$_POST['hp'];
    $email=$_POST['email'];

    $query_id = "SELECT MAX(id) AS id_terbaru FROM mitra";
    $result_id = mysqli_query($koneksi, $query_id);
    $row_id = mysqli_fetch_assoc($result_id);
    $id_terbaru = $row_id['id_terbaru'];

    $query = "UPDATE mitra SET
    nama = '$nama',
    tanggal_lahir = '$tanggal_lahir',
    tempat_lahir = '$tempat_lahir',
    jabatan = '$jabatan',
    nomor_hp = '$nomorhp',
    email = '$email'
    WHERE id = $id_terbaru";

if (mysqli_query($koneksi, $query)) {
    // Update berhasil
    $alert_message = "Data berhasil diupdate";
    header("Location: formmitra3.php");
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
Registrasi Perwakilan Mitra
</div>
<div class="card-body">
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-group row">
      <label for="nama" class="col-sm-2 col-form-label">Nama</label>
      <div class="col-sm-10">
        <input type="text" name="nama" class="form-control <?php echo (!empty($error_nama) ? 'is-invalid' : ''); ?>" id="nama" placeholder="Nama" value="<?php echo $nama; ?>">
        <?php if (!empty($error_nama)): ?>
          <div class="invalid-feedback"><?php echo $error_nama; ?></div>
        <?php endif; ?>
      </div>
    </div>
    <div class="form-group row">
      <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
      <div class="col-sm-10">
        <input type="date" name="tanggal_lahir" class="form-control <?php echo (!empty($error_tanggal_lahir) ? 'is-invalid' : ''); ?>" id="tanggal_lahir" placeholder="Tanggal Lahir" value="<?php echo $tanggal_lahir; ?>">
        <?php if (!empty($error_tanggal_lahir)): ?>
          <div class="invalid-feedback"><?php echo $error_tanggal_lahir; ?></div>
        <?php endif; ?>
      </div>
    </div>
    <div class="form-group row">
      <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
      <div class="col-sm-10">
        <input type="text" name="tempat_lahir" class="form-control <?php echo (!empty($error_tempat_lahir) ? 'is-invalid' : ''); ?>" id="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $tempat_lahir; ?>">
        <?php if (!empty($error_tempat_lahir)): ?>
          <div class="invalid-feedback"><?php echo $error_tempat_lahir; ?></div>
        <?php endif; ?>
      </div>
    </div>
    <div class="form-group row">
      <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
      <div class="col-sm-10">
        <input type="text" name="jabatan" class="form-control <?php echo (!empty($error_jabatan) ? 'is-invalid' : ''); ?>" id="jabatan" placeholder="Jabatan" value="<?php echo $jabatan; ?>">
        <?php if (!empty($error_jabatan)): ?>
          <div class="invalid-feedback"><?php echo $error_jabatan; ?></div>
        <?php endif; ?>
      </div>
    </div>
    <div class="form-group row">
      <label for="hp" class="col-sm-2 col-form-label">Nomor HP</label>
      <div class="col-sm-10">
        <input type="text" name="hp" class="form-control <?php echo (!empty($error_nomorhp) ? 'is-invalid' : ''); ?>" id="hp" placeholder="Nomor HP" value="<?php echo $nomorhp; ?>">
        <?php if (!empty($error_nomorhp)): ?>
          <div class="invalid-feedback"><?php echo $error_nomorhp; ?></div>
        <?php endif; ?>
      </div>
    </div>
    <div class="form-group row">
      <label for="email" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="email" name="email" class="form-control <?php echo (!empty($error_email) ? 'is-invalid' : ''); ?>" id="email" placeholder="Email" value="<?php echo $email; ?>">
        <?php if (!empty($error_email)): ?>
          <div class="invalid-feedback"><?php echo $error_email; ?></div>
        <?php endif; ?>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">Next</button>
      </div>
    </div>
  </form>
</div>
</div>

</form>
</div>
</div> 
</div>
</div>

</body>
 </html>