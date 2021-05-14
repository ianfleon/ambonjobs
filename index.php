<?php

// Koneksi
require_once 'admin/config/koneksi.php';
require_once 'admin/config/fun_exec.php';

$btn_diss = "";

// Pagination
$halaman = 25;
$page = isset($_GET["halaman"]) ? (int) $_GET["halaman"] : 1;
$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
$result = mysqli_query($conn, "SELECT * FROM loker_tb");
$total = mysqli_num_rows($result);
$pages = ceil($total/$halaman);

// $query = ($conn, "SELECT * FROM loker_tb LIMIT '$mulai', '$halaman'");

$no = $mulai + 1;

// Query Select
  // $loker = querySelect("
  //   SELECT nama_l, gambar, alamat, nama_t, id_loker
  //   FROM loker_tb loker RIGHT JOIN tempat_tb tempat ON loker.id_tempat = tempat.id_tempat
  //   WHERE loker.id_loker IS NOT NULL ORDER BY id_loker DESC LIMIT 12
  // "); 

$loker = querySelect("
   SELECT nama_l, gambar, alamat, nama_t, id_loker
   FROM loker_tb loker RIGHT JOIN tempat_tb tempat ON loker.id_tempat = tempat.id_tempat
   WHERE loker.id_loker IS NOT NULL ORDER BY id_loker DESC LIMIT $mulai, $halaman
");

if(!$loker) {
      echo "
        <!doctype html>
        <html lang='en'>
        <head>
          <title>212 Wiro Sableng</title>
        </head>
        <body style='text-align: center'>
        <p>Halaman tidak tersedia!</p>
        <img src='nopage.png' width='32%'>
        <p>Redirect ke halaman utama. Tunggu sebentar..</p>
        <meta http-equiv='refresh' content='3; url=index.php'>
        </body>
        </html>
      ";
      die();
}

// Cari Loker
if( isset($_GET["cari"]) ) {
    $q = $_GET["q"];

    $loker = querySelect("
      SELECT nama_l, gambar, alamat, nama_t, id_loker
      FROM loker_tb loker RIGHT JOIN tempat_tb tempat ON loker.id_tempat = tempat.id_tempat
      WHERE loker.nama_l LIKE '%$q%'
      AND loker.id_loker IS NOT NULL ORDER BY id_loker DESC LIMIT 12
    ");

    if(!$loker) {
      echo "
        <!doctype html>
        <html lang='en'>
        <head>
          <title>212 Wiro Sableng</title>
        </head>
        <body style='text-align: center'>
        <p>Loker tidak tersedia atau kata kunci salah!</p>
        <img src='notfound.jpg' width='32%'>
        <p>Redirect ke halaman utama. Tunggu sebentar..</p>
        <meta http-equiv='refresh' content='3; url=index.php'>
        </body>
        </html>
      ";
      die();
    }


}


// .
// die();

?>


<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<!-- Custom CSS -->
<link rel="stylesheet" type="text/css" href="style.css">

<title>Beranda | Ambonjobs</title>
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
        <a href="index.php"><img src="logo.png" alt="logo" width="170rem"></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="" method="GET">
      <input class="form-control mr-sm-2" type="search" name="q" placeholder="Cari Pekerjaan" aria-label="Search">
      <button class="btn btn-outline-white my-2 my-sm-0" type="submit" name="cari">Cari</button>
    </form>
  </div>
</div>
</nav>
<!-- End Navbar -->
<!-- Kontener -->
<div class="container">
<br><br><br><br>
<div class="card-columns">
  <?php foreach ($loker as $l) : ?>
  <div class="card">
    <img class="card-img-top" src="img/<?= $l["gambar"] ?>" alt="Card image cap">
    <div class="card-body">
      <a href="detailjob.php?id_l=<?= $l["id_loker"] ?>" style="color: black"><h5 class="card-title"><?= $l["nama_l"] ?></a></h5>
      <p class="card-text text-muted"><?= $l["nama_t"] ?></p>
      <p class="card-text"><i class="fa fa-map-marker"></i><small> <?= $l["alamat"] ?></small></p>
    </div>
  </div>
  <?php endforeach; ?>
</div>

<nav aria-label="pagination">
  <ul class="pagination">
    <!-- <li class="page-item <?= $btn_diss ?>">
      <a class="page-link" href="" tabindex="-1">Sebelumnya</a>
    </li> -->
    <!-- <li class="page-item active"><a class="page-link" href="#">1</a></li> -->
    <?php for($i = 1; $i <= $pages; $i++) { ?>
    <li class="page-item">
      <a class="page-link" href="?halaman=<?= $i ?>"><?=$i ?> <span class="sr-only">(current)</span></a>
    </li>
  <?php } ?>
    <!-- <li class="page-item"><a class="page-link" href="#">3</a></li> -->
    <!-- <li class="page-item">
      <a class="page-link" href="?halaman=<?= $halaman ?>">Berikutnya</a>
    </li> -->
  </ul>
</nav>
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