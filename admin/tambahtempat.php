<?php

session_start();

if(!isset($_SESSION["user_login"])) {
    echo "Login do he!";
    echo "<meta http-equiv='refresh' content='1; url=login.php'>";
    die();
}

// Fun_Exec
require_once 'config/fun_exec.php';

if(isset($_POST["simpan"])) {
  if( tambahTempat($_POST, $_FILES) > 0 ) {
      echo "<script>alert('Data berhasil disimpan!');</script>";
      echo "<script>

        confirm('Ingin menambah data?') ?
        window.location.href = 'tambahtempat.php' :
        window.location.href = 'index.php';

      </script>";
  } else {
      echo "<script>alert('Data gagal disimpan..');</script>";
  }
}

?>


<?php 
// Header View
require_once 'compo/header.php';
?>



<!-- Form -->
<div class="container">
  <div class="alert alert-info" role="alert">
  Tambah Data Tempat Kerja!
</div>
<br>
<form action="" method="POST" enctype="multipart/form-data">

  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="nama">Nama Tempat Kerja*</label>
      <input type="text" class="form-control" id="nama" name="nama" required>
    </div>
    <div class="col-md-6 mb-3">
      <label for="link_web">Link Website</label>
      <input type="text" class="form-control" id="link_web" placeholder="Website, Facebook, Instagram, dll." name="link_web" required>
    </div>
  </div>

  <div class="form-row">
    <div class="col-md-6 mb-3">
      
      <label for="gambar">Gambar*</label>
      <input type="file" class="form-control" id="gambar" name="gambar" required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="telp">Telepon*</label>
      <input type="number" class="form-control" id="telp" name="telp" required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="email">Email*</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>
  </div>

  <div class="form-group">
    <label for="tentang">Tentang Tempat Kerja*</label>
    <textarea class="form-control" id="tentang" rows="3" name="tentang"></textarea>
  </div>

  <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>

</form>
</div>
<!-- End Form -->

<?php require_once 'compo/footer.php'; ?>