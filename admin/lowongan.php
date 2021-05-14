<?php

session_start();

if(!isset($_SESSION["user_login"])) {
    echo "Login do he!";
    echo "<meta http-equiv='refresh' content='1; url=login.php'>";
    die();
}

// Import Method
require_once 'config/fun_exec.php';

if( isset($_GET["id_t"]) ) {

    $id = $_GET["id_t"];

    $cek = mysqli_query($conn, "SELECT * FROM tempat_tb WHERE id_tempat = '$id' ");

    if($result = mysqli_num_rows($cek) <= 0){
        header("Location: 404.php");
    } else {
        $tempat = querySelect("SELECT * FROM  tempat_tb WHERE id_tempat = '$id' ")[0];
        $lowongan = querySelect(" SELECT * FROM loker_tb WHERE id_tempat = '$id' ");

        // var_dump($tempat);
        // die();
    }

} elseif( !isset($_GET["id_t"]) ) {
    header("Location: 404.php");
}


?>

<!-- Header View -->
<?php require_once 'compo/header.php'; ?>

<!-- Tabel -->
<div class="container">
<div class="alert alert-success" role="alert">
  Daftar Lowongan! <i class="fa fa-heart"> <?= $_GET["n_tempat"] ?></i>
</div>
<br>
  <a href="tambahlowongan.php?id_t=<?= $_GET["id_t"] ?>&&n_tempat=<?= $_GET["n_tempat"] ?>" target="_blank" class="btn w-biru2"><i class="fa fa-plus"></i> Tambah Lowongan</a>
  <br>
  <br>
  <table class="table">
  <!-- <caption><i class="fa fa-shopping-bag"></i> Daftar Lowongan</caption> -->
  <thead class="thead-dark">
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama Pekerjaan</th>
      <th scope="col">Alamat</th>
      <th scope="col">Bidang</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($lowongan as $l) : ?>
    <tr>
      <th scope="row"><?= $l["id_loker"]; ?></th>
      <td><?= $l["nama_l"] ?></td>
      <td><?= $l["alamat"] ?></td>
      <td><?= $l["bidang"] ?></td>
      <td>
        <a href="../detailjob.php?id_l=<?= $l["id_loker"] ?>" class="btn btn-info" target="_blank"><i class="fa fa-eye"></i></a>
        <a href="editloker.php?id_l=<?= $l["id_loker"] ?>&&n_l=<?= $l["nama_l"] ?>&&id_t=<?= $l["id_tempat"] ?>&&n_t=<?= $tempat["nama_t"] ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
        <button class="btn btn-danger" onclick="return confirm('Ingin menghapus data ini?') ? window.location.replace('hapus.php?l=<?= $l["id_loker"]; ?>&&id_t=<?= $l["id_tempat"];?>&&n_t=<?= $_GET["n_tempat"] ?>') : alert('Data tidak dihapus..');">
          <i class="fa fa-trash-o"></i>
        </button>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

</div>
<!-- End Tabel -->

<?php require_once 'compo/footer.php'; ?>