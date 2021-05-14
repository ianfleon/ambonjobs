<?php

session_start();

if(!isset($_SESSION["user_login"])) {
    echo "Login do he!";
    echo "<meta http-equiv='refresh' content='1; url=login.php'>";
    die();
}

// Import Method
require_once 'config/fun_exec.php';

// Checking Data Valid
if( isset($_GET["id_t"]) ) {

    $id = $_GET["id_t"];

    $cek = mysqli_query($conn, "SELECT * FROM tempat_tb WHERE id_tempat = '$id' ");

    if($result = mysqli_num_rows($cek) <= 0){
        header("Location: 404.php");
    } else {
        $lowongan = querySelect(" SELECT * FROM loker_tb WHERE id_tempat = '$id' ");
    }

} elseif( !isset($_POST["id_t"]) ) {
    header("Location: 404.php");
}


// Simpan Data
if(isset($_POST["simpan"])) {

    if(tambahLoker($_POST) > 0) {
      echo "<script>alert('Data berhasil disimpan!');</script>";
      echo "<script>

        confirm('Ingin menambah data?') ?
        window.location.href = 'tambahlowongan.php' :
        window.location.href = 'index.php';

      </script>";
    } else {
      echo "<script>alert('Data gagal disimpan..');</script>";
    }

}


?>

<?php require_once 'compo/header.php'; ?>

<!-- Form -->
<div class="container">

<div class="alert alert-primary" role="alert">
  Tambah Data Lowongan Pekerjaan! <i class="fa fa-heart"> <?= $_GET["n_tempat"] ?></i>
</div>

<br>

<form action="" method="POST">
  <input type="hidden" name="id_t" value="<?= $id ?>">
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="nama">Nama Pekerjaan*</label>
      <input type="text" class="form-control" id="nama" name="nama" required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="bidang">Bidang Pekerjaan*</label>
      <input type="text" class="form-control" id="bidang" name="bidang" placeholder="IT, Marketing, Pegawai, dll." required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="gaji">Gaji /bulan*</label>
      <input type="text" class="form-control" id="gaji" name="gaji" placeholder="Rp. Jumlah / Min. - Max." required>
    </div>
  </div>

  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="alamat">Alamat Tempat Kerja*</label>
      <input type="text" class="form-control" id="alamat" name="alamat" required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="buka">Buka Lowongan*</label>
      <input class="form-control" type="date" value="2020-09-25" name="buka" id="buka" required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="tutup">Tutup Lowongan*</label>
      <input class="form-control" type="date" value="2020-10-25" name="tutup" id="tutup" required>
    </div>
  </div>

  <div class="form-group">
  <label for="">Waktu Pekerjaan*</label>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="waktu" id="tetap" value="tetap" required>
    <label class="form-check-label" for="tetap">
      Pekerjaan Tetap
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="waktu" id="sementara" value="sementara" required>
    <label class="form-check-label" for="sementara">
      Pekerjaan Sementara
    </label>
  </div>
  </div>

  <div class="form-group">
  <label for="">Tipe Pekerjaan*</label>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="tipe" id="online" value="online" required>
    <label class="form-check-label" for="online">
      Remote (Online)
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="tipe" id="onsite" value="onsite" required>
    <label class="form-check-label" for="onsite">
      Ditempat (Onsite)
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="tipe" id="random" value="random" required>
    <label class="form-check-label" for="random">
      Random (Online & Onsite)
    </label>
  </div>
  </div>
  
  <div class="form-group">
    <label for="lokasi">Lokasi*</label>
    <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Link Google Map" required>
  </div>

  <div class="form-group">
    <label for="deskripsi">Deskripsi Pekerjaan*</label>
    <textarea class="form-control ckeditor" id="ckeditor" name="deskripsi" rows="3" required></textarea>
  </div>

  <div class="form-group">
    <label for="persyaratan">Persyaratan*</label>
    <textarea class="form-control ckeditor" id="ckeditor" name="persyaratan" rows="3" required></textarea>
  </div>

  <div class="form-group">
    <label for="catatan">Catatan*</label>
    <textarea class="form-control" id="catatan" rows="3" name="catatan" required></textarea>
  </div>

  <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>

</form>
</div>
<!-- End Form -->

<?php require_once 'compo/footer.php'; ?>