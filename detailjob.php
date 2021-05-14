<?php

// Req Data
require_once 'admin/config/fun_exec.php';

// Checking Data Valid
if( isset($_GET["id_l"]) ) {

    $id = $_GET["id_l"];

    $cek = mysqli_query($conn, "SELECT * FROM loker_tb WHERE id_loker = '$id'");

    if( $result = mysqli_num_rows($cek) <= 0 ){
        header("Location: 404.php");
    }

} elseif( !isset($_GET["id_l"]) ) {
    header("Location: 404.php"); 
}

$loker = querySelect("
  SELECT * FROM loker_tb loker
  RIGHT JOIN tempat_tb tempat ON loker.id_tempat = tempat.id_tempat
  WHERE id_loker = '$id'
")[0];

$loker["waktu_buka"] = ubahWaktu($loker["waktu_buka"]);
$loker["waktu_tutup"] = ubahWaktu($loker["waktu_tutup"]);


?>

<!doctype html>
<html lang="id">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<!-- Custom CSS -->
<link rel="stylesheet" href="style.css">

<title>Detail Pekerjaan | Ambonjobs</title>

</head>
<body class="w-silver">

<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark w-biru">
  <div class="container">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item mr-3">
        <!-- <a class="navbar-brand t-putih" href="index.html"><i class="fa fa-angle-right"></i> AMBONJOBS</a> -->
        <a href="index.php"><img src="logo.png" alt="logo" width="170rem"></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="index.php" method="GET">
      <input class="form-control mr-sm-2" type="search" placeholder="Cari Pekerjaan" aria-label="Search" name="q">
      <button class="btn btn-outline-white my-2 my-sm-0" type="submit" name="cari">Cari</button>
    </form>
  </div>
  </div>
</nav>
<!-- End Navbar -->

<br>

<!-- Kontener -->
<div class="container">
<br><br><br>
<div class="row">

  <div class="col-md-4">

    <div class="card mb-3">
      <img class="card-img-top" src="img/<?= $loker["gambar"] ?>" alt="Card image cap" width="">
      <div class="card-body">
        <h5 class="card-title"><i class="fa fa-home"></i> <?= $loker["nama_t"] ?></h5>
        <p class="card-text"><?= $loker["tentang"] ?></p>
        <p class="card-text"><small class="text-muted"><i class="fa fa-map-marker"></i> <?= $loker["alamat"] ?></small></p>
      </div>
      <a href="<?= $loker["lokasi"] ?>" class="btn btn-primary" target="_blank">Lihat Lokasi</a>
    </div>

    <!-- Waktu Lowongan -->
    <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title"><i class="fa fa-history"></i> Waktu Lowongan</h5>
          <div class="card-text text-muted">
            <p><i class="fa fa-hourglass-start"></i> Buka :<br><?= $loker["waktu_buka"] ?></p>
            <p><i class="fa fa-hourglass-end"></i> Tutup :<br><?= $loker["waktu_tutup"] ?></p>
          </div>
        </div>
    </div>

    <!-- Catatan Lowongan -->
    <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title"><i class="fa fa-sticky-note"></i> Catatan</h5>
          <div class="card-text text-muted">
            <p><?= $loker["catatan"] ?></p>
          </div>
        </div>
    </div>

  </div>

  <div class="col-md-8">

    <!-- Bidang Pekerjaan -->
    <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title"><i class="fa fa-briefcase"></i> <?= $loker["nama_l"] ?></h5>
          <small class="text-muted"><?= ucfirst($loker["tipe_pekerjaan"]) ?></small>
          <hr>
          <div class="card-text">
            <p class="text-muted">Bidang Pekerjaan :</p>
            <h6><?= ucfirst($loker["bidang"]) ?></h6>
            <hr>
            <p class="text-muted">Gaji :</p>
            <h6><?= $loker["gaji"] ?></h6>
          </div>
        </div>
    </div>

    <!-- Deskripsi Pekerjaan -->
    <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title"><i class="fa fa-coffee"></i> Deskripsi Pekerjaan</h5>
          <div class="card-text text-muted">
            <p><?= $loker["deskripsi"] ?></p>
          </div>
          <p class="card-text"><small class="text-muted">Pekerjaan <?= ucfirst($loker["waktu_pekerjaan"]) ?></small></p>
        </div>
    </div>

    <!-- Persyaratan -->
    <div class="card mb-3">
       <div class="card-body">
         <h5 class="card-title"><i class="fa fa-align-center"></i> Persyaratan</h5>
         <div class="card-text text-muted">
           <p><?= $loker["persyaratan"] ?></p>
         </div>
       </div>
    </div>

    <!-- Kontak -->
    <div class="card mb-3">
       <div class="card-body">
         <h5 class="card-title"><i class="fa fa-address-card"></i> Kontak</h5>
         <div class="card-text text-muted">
           <p><i class="fa fa-at"></i> Email : <br><?= $loker["email"] ?></p>
           <p><i class="fa fa-phone"></i> Telp : <br><?= $loker["telepon"] ?></p>
           <p><i class="fa fa-cloud"></i> Website : <br><?= $loker["link_web"] ?></p>
         </div>
       </div>
    </div>

    </div>
  </div>

</div>
</div>



<!-- Footer -->
<footer class="w-footer">
  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">
    <p class="t-putih">© 2020 Copyright : VMBXNJXBS. Made with <i class="fa fa-heart"></i></p>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>