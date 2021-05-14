<?php

session_start();

if(!isset($_SESSION["user_login"])) {
    echo "Login do he!";
    echo "<meta http-equiv='refresh' content='1; url=login.php'>";
    die();
}

// Req. Header View
require_once 'compo/header.php';

// Req. Func_Exec
require_once 'config/fun_exec.php';

$hasil = querySelect("SELECT * FROM tempat_tb");


?>

<!-- Tabel -->
<div class="container">
<div class="jumbotron card card-image" style="background-image: url(https://i.pinimg.com/originals/9d/29/e3/9d29e321b90715dcc1c2e3d5a78f320f.jpg);">
  <div class="text-white text-center py-5 px-4">
    <div>
      <h2 class="card-title h1-responsive pt-3 mb-5 font-bold"><strong>Selamat Datang Admin!</strong></h2>
      <a class="btn btn-outline-white btn-md text-white" href="../index.php"><i class="fa fa-home"></i> Ambonjobs | Home</a>
    </div>
  </div>
</div>


  <a href="tambahtempat.php" class="btn w-ijo"><i class="fa fa-plus"></i> Tambah Tempat</a>
  <br>
  <br>
  <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Tempat Kerja</th>
      <th scope="col">Email</th>
      <th scope="col">Gambar</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($hasil as $h) : ?>
    <tr>
      <th scope="row"><?= $h["id_tempat"] ?></th>
      <td><?= $h["nama_t"] ?></td>
      <td><?= $h["email"] ?></td>
      <td>
        <img src="../img/<?= $h["gambar"] ?>" alt="" width="100px" class="img-thumbnail">
      </td>
      <td>
        <a href="lowongan.php?id_t=<?= $h["id_tempat"] ?>&&n_tempat=<?= $h["nama_t"] ?>" class="btn btn-info"><i class="fa fa-eye"></i></a>
        <a href="edittempat.php?id_t=<?= $h["id_tempat"] ?>&&n_t=<?= $h["nama_t"] ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
        <!-- Button trigger modal -->
        <button class="btn btn-danger" onclick="return confirm('Ingin menghapus data ini?') ? window.location.replace('hapus.php?t=<?= $h["id_tempat"] ?>') : alert('Data tidak dihapus..');">
          <i class="fa fa-trash-o"></i>
        </button>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
<!-- End Tabel -->

<!-- Req. Footer View -->
<?php require_once 'compo/footer.php'; ?>